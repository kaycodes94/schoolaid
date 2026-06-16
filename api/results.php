<?php
/**
 * Plan Aid Academy - Results API
 * Handles student result entry, retrieval and report generation
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../includes/Helpers.php';

$db = null;
try {
    $db = new Database();
} catch (Exception $e) {
    ApiResponse::error('Database connection failed', 500);
}

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'get';

try {
    if ($method === 'GET') {
        switch ($action) {
            case 'get':
                getStudentResults($db);
                break;
            case 'class':
                getClassResults($db);
                break;
            case 'report':
                generateResultReport($db);
                break;
            case 'statistics':
                getResultStatistics($db);
                break;
            default:
                ApiResponse::error('Invalid action', 400);
        }
    } elseif ($method === 'POST') {
        enterResults($db);
    } elseif ($method === 'PUT') {
        updateResults($db);
    }
} catch (Exception $e) {
    ApiResponse::error('Server error: ' . $e->getMessage(), 500);
}

/**
 * Get student results by admission number
 */
function getStudentResults($db) {
    $admissionNo = $_GET['admission_no'] ?? $_GET['student_id'] ?? null;
    $session = $_GET['session'] ?? date('Y') . '/' . (date('Y') + 1);
    $term = $_GET['term'] ?? null;

    if (!$admissionNo) {
        ApiResponse::error('Student ID/admission number required', 400);
    }

    // Get student
    $student = $db->fetch(
        "SELECT s.*, c.name as class_name FROM students s 
         LEFT JOIN class_enrollment ce ON s.id = ce.student_id 
         LEFT JOIN classes c ON ce.class_id = c.id 
         WHERE s.admission_no = ? LIMIT 1",
        [$admissionNo]
    );

    if (!$student) {
        ApiResponse::error('Student not found', 404);
    }

    // Build query for results
    $query = "SELECT r.*, sub.name as subject_name, c.name as class_name 
             FROM results r 
             JOIN subjects sub ON r.subject_id = sub.id 
             JOIN classes c ON r.class_id = c.id 
             WHERE r.student_id = ? AND r.academic_session = ?";
    $params = [$student['id'], $session];

    if ($term) {
        $query .= " AND r.term = ?";
        $params[] = $term;
    }

    $query .= " ORDER BY r.term, sub.name";

    $results = $db->fetchAll($query, $params);

    // Calculate statistics
    $stats = calculateResultStats($results);

    ApiResponse::success([
        'student' => [
            'admission_no' => $student['admission_no'],
            'name' => $student['first_name'] . ' ' . $student['last_name'],
            'class' => $student['class_name'],
            'unit' => $student['unit_id']
        ],
        'academic_session' => $session,
        'results' => $results,
        'statistics' => $stats
    ]);
}

/**
 * Get all results for a class
 */
function getClassResults($db) {
    $classId = $_GET['class_id'] ?? null;
    $session = $_GET['session'] ?? date('Y') . '/' . (date('Y') + 1);
    $term = $_GET['term'] ?? null;

    if (!$classId) {
        ApiResponse::error('Class ID required', 400);
    }

    // Get class info
    $class = $db->fetch(
        "SELECT c.*, u.name as unit_name FROM classes c 
         JOIN units u ON c.unit_id = u.id 
         WHERE c.id = ?",
        [$classId]
    );

    if (!$class) {
        ApiResponse::error('Class not found', 404);
    }

    // Get all students in class
    $query = "SELECT DISTINCT s.id, s.admission_no, s.first_name, s.last_name 
             FROM students s 
             JOIN class_enrollment ce ON s.id = ce.student_id 
             WHERE ce.class_id = ? AND ce.academic_session = ?";
    $params = [$classId, $session];

    $students = $db->fetchAll($query, $params);

    // Get results for each student
    $classResults = [];
    foreach ($students as $student) {
        $resultQuery = "SELECT r.*, sub.name as subject_name 
                       FROM results r 
                       JOIN subjects sub ON r.subject_id = sub.id 
                       WHERE r.student_id = ? AND r.academic_session = ?";
        $resultParams = [$student['id'], $session];

        if ($term) {
            $resultQuery .= " AND r.term = ?";
            $resultParams[] = $term;
        }

        $studentResults = $db->fetchAll($resultQuery, $resultParams);
        
        $classResults[] = [
            'student' => $student,
            'results' => $studentResults,
            'stats' => calculateResultStats($studentResults)
        ];
    }

    ApiResponse::success([
        'class' => $class,
        'academic_session' => $session,
        'term' => $term,
        'student_count' => count($students),
        'results' => $classResults
    ]);
}

/**
 * Enter results for students
 */
function enterResults($db) {
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate
    $validator = new Validator();
    if (!$validator->validateResult($input)) {
        ApiResponse::error('Validation failed', 422, $validator->getErrors());
    }

    $token = $_GET['token'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? null;
    if (!$token) {
        ApiResponse::error('Authentication required', 401);
    }

    try {
        // Calculate total score
        $ca = floatval($input['continuous_assessment']);
        $exam = floatval($input['exam_score']);
        $total = $ca + $exam;
        $grade = Utilities::calculateGrade($total);
        $remark = Utilities::getGradeRemark($total);

        // Check if result already exists
        $existingResult = $db->fetch(
            "SELECT id FROM results 
             WHERE student_id = ? AND subject_id = ? AND class_id = ? 
             AND academic_session = ? AND term = ?",
            [
                $input['student_id'],
                $input['subject_id'],
                $input['class_id'],
                $input['academic_session'] ?? date('Y') . '/' . (date('Y') + 1),
                $input['term'] ?? '1st'
            ]
        );

        $resultData = [
            'student_id' => $input['student_id'],
            'subject_id' => $input['subject_id'],
            'class_id' => $input['class_id'],
            'academic_session' => $input['academic_session'] ?? date('Y') . '/' . (date('Y') + 1),
            'term' => $input['term'] ?? '1st',
            'continuous_assessment' => $ca,
            'exam_score' => $exam,
            'total_score' => $total,
            'grade' => $grade,
            'remark' => $remark,
            'entered_by' => $input['staff_id'] ?? null
        ];

        if ($existingResult) {
            // Update existing result
            $db->update('results', $resultData, ['id' => $existingResult['id']]);
            $resultId = $existingResult['id'];
            $message = 'Result updated successfully';
        } else {
            // Insert new result
            $resultId = $db->insert('results', $resultData);
            $message = 'Result entered successfully';
        }

        Utilities::logActivity("Result entered for student {$input['student_id']}", $input['staff_id'] ?? null, $_SERVER['REMOTE_ADDR']);

        ApiResponse::success([
            'result_id' => $resultId,
            'total_score' => $total,
            'grade' => $grade,
            'remark' => $remark
        ], $message, 201);

    } catch (Exception $e) {
        ApiResponse::error('Failed to enter result: ' . $e->getMessage(), 500);
    }
}

/**
 * Update existing results
 */
function updateResults($db) {
    $input = json_decode(file_get_contents('php://input'), true);
    $resultId = $_GET['id'] ?? null;

    if (!$resultId) {
        ApiResponse::error('Result ID required', 400);
    }

    try {
        $ca = floatval($input['continuous_assessment'] ?? 0);
        $exam = floatval($input['exam_score'] ?? 0);
        $total = $ca + $exam;
        $grade = Utilities::calculateGrade($total);
        $remark = Utilities::getGradeRemark($total);

        $updateData = [
            'continuous_assessment' => $ca,
            'exam_score' => $exam,
            'total_score' => $total,
            'grade' => $grade,
            'remark' => $remark
        ];

        $db->update('results', $updateData, ['id' => $resultId]);

        ApiResponse::success([
            'result_id' => $resultId,
            'total_score' => $total,
            'grade' => $grade
        ], 'Result updated successfully');

    } catch (Exception $e) {
        ApiResponse::error('Update failed: ' . $e->getMessage(), 500);
    }
}

/**
 * Generate result report
 */
function generateResultReport($db) {
    $classId = $_GET['class_id'] ?? null;
    $session = $_GET['session'] ?? date('Y') . '/' . (date('Y') + 1);
    $term = $_GET['term'] ?? null;

    if (!$classId) {
        ApiResponse::error('Class ID required', 400);
    }

    // Similar to getClassResults but formatted as report
    $results = getClassResults($db);
    
    ApiResponse::success($results);
}

/**
 * Get result statistics
 */
function getResultStatistics($db) {
    $classId = $_GET['class_id'] ?? null;
    $session = $_GET['session'] ?? date('Y') . '/' . (date('Y') + 1);

    if (!$classId) {
        ApiResponse::error('Class ID required', 400);
    }

    // Get grade distribution
    $gradeDistribution = $db->fetchAll(
        "SELECT r.grade, COUNT(*) as count 
         FROM results r 
         JOIN class_enrollment ce ON r.student_id = ce.student_id 
         WHERE ce.class_id = ? AND r.academic_session = ? 
         GROUP BY r.grade",
        [$classId, $session]
    );

    // Get subject performance
    $subjectPerformance = $db->fetchAll(
        "SELECT sub.name, AVG(r.total_score) as average, MIN(r.total_score) as minimum, MAX(r.total_score) as maximum 
         FROM results r 
         JOIN subjects sub ON r.subject_id = sub.id 
         JOIN class_enrollment ce ON r.student_id = ce.student_id 
         WHERE ce.class_id = ? AND r.academic_session = ? 
         GROUP BY sub.name",
        [$classId, $session]
    );

    ApiResponse::success([
        'grade_distribution' => $gradeDistribution,
        'subject_performance' => $subjectPerformance
    ]);
}

/**
 * Calculate result statistics
 */
function calculateResultStats($results) {
    if (empty($results)) {
        return [
            'total_subjects' => 0,
            'total_score' => 0,
            'average' => 0,
            'highest' => 0,
            'grade_a' => 0,
            'grade_b' => 0,
            'grade_c' => 0
        ];
    }

    $totalScore = 0;
    $highestScore = 0;
    $gradeCount = ['A' => 0, 'B' => 0, 'C' => 0];

    foreach ($results as $result) {
        $totalScore += $result['total_score'];
        if ($result['total_score'] > $highestScore) {
            $highestScore = $result['total_score'];
        }
        if (isset($gradeCount[$result['grade']])) {
            $gradeCount[$result['grade']]++;
        }
    }

    $average = round($totalScore / count($results), 2);

    return [
        'total_subjects' => count($results),
        'total_score' => $totalScore,
        'average' => $average,
        'highest' => $highestScore,
        'grade_a' => $gradeCount['A'],
        'grade_b' => $gradeCount['B'],
        'grade_c' => $gradeCount['C']
    ];
}
