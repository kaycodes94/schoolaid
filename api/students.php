<?php
/**
 * Plan Aid Academy - Students API
 * Handles student records, enrollment and management
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
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
$action = $_GET['action'] ?? 'list';

try {
    if ($method === 'GET') {
        switch ($action) {
            case 'get':
                getStudent($db);
                break;
            case 'list':
                listStudents($db);
                break;
            case 'class':
                getClassStudents($db);
                break;
            default:
                ApiResponse::error('Invalid action', 400);
        }
    } elseif ($method === 'POST') {
        if (isset($_GET['id']) || isset($_GET['admission_no'])) {
            updateStudent($db);
        } else {
            createStudent($db);
        }
    } elseif ($method === 'PUT') {
        updateStudent($db);
    }
} catch (Exception $e) {
    ApiResponse::error('Server error: ' . $e->getMessage(), 500);
}

/**
 * Get single student record
 */
function getStudent($db) {
    $admissionNo = $_GET['admission_no'] ?? $_GET['id'] ?? null;
    $studentId = $_GET['student_id'] ?? null;

    if (!$admissionNo && !$studentId) {
        ApiResponse::error('Student ID or admission number required', 400);
    }

    if ($studentId) {
        $student = $db->fetch("SELECT * FROM students WHERE id = ?", [$studentId]);
    } else {
        $student = $db->fetch("SELECT * FROM students WHERE admission_no = ?", [$admissionNo]);
    }

    if (!$student) {
        ApiResponse::error('Student not found', 404);
    }

    // Get enrollment info
    $enrollment = $db->fetch(
        "SELECT c.* FROM classes c 
         JOIN class_enrollment ce ON c.id = ce.class_id 
         WHERE ce.student_id = ? AND ce.academic_session = ?
         ORDER BY ce.enrolled_date DESC LIMIT 1",
        [$student['id'], date('Y') . '/' . (date('Y') + 1)]
    );

    // Get payment info
    $payments = $db->fetch(
        "SELECT COALESCE(SUM(amount_paid), 0) as total_paid FROM payments 
         WHERE student_id = ? AND status = 'confirmed'",
        [$student['id']]
    );

    ApiResponse::success([
        'student' => $student,
        'current_class' => $enrollment,
        'financial' => $payments
    ]);
}

/**
 * List students with filters
 */
function listStudents($db) {
    $unit = $_GET['unit'] ?? null;
    $status = $_GET['status'] ?? 'active';
    $limit = (int)($_GET['limit'] ?? 50);
    $offset = (int)($_GET['offset'] ?? 0);
    $search = $_GET['search'] ?? null;

    $query = "SELECT * FROM students WHERE 1=1";
    $params = [];

    if ($status) {
        $query .= " AND status = ?";
        $params[] = $status;
    }

    if ($unit) {
        $query .= " AND unit_id = ?";
        $params[] = $unit;
    }

    if ($search) {
        $query .= " AND (admission_no LIKE ? OR first_name LIKE ? OR last_name LIKE ?)";
        $searchTerm = '%' . $search . '%';
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
    }

    $query .= " ORDER BY last_name ASC, first_name ASC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;

    $students = $db->fetchAll($query, $params);

    // Get total count
    $countQuery = "SELECT COUNT(*) as total FROM students WHERE 1=1";
    if ($status) {
        $countQuery .= " AND status = ?";
    }
    if ($unit) {
        $countQuery .= " AND unit_id = ?";
    }
    if ($search) {
        $countQuery .= " AND (admission_no LIKE ? OR first_name LIKE ? OR last_name LIKE ?)";
    }

    $countParams = array_slice($params, 0, count($params) - 2);
    $countResult = $db->fetch($countQuery, $countParams);

    ApiResponse::success([
        'students' => $students,
        'total' => $countResult['total'] ?? 0,
        'limit' => $limit,
        'offset' => $offset
    ]);
}

/**
 * Get students in a class
 */
function getClassStudents($db) {
    $classId = $_GET['class_id'] ?? null;
    $session = $_GET['session'] ?? date('Y') . '/' . (date('Y') + 1);

    if (!$classId) {
        ApiResponse::error('Class ID required', 400);
    }

    $students = $db->fetchAll(
        "SELECT s.* FROM students s 
         JOIN class_enrollment ce ON s.id = ce.student_id 
         WHERE ce.class_id = ? AND ce.academic_session = ?
         ORDER BY s.last_name ASC",
        [$classId, $session]
    );

    ApiResponse::success([
        'class_id' => $classId,
        'session' => $session,
        'students' => $students,
        'count' => count($students)
    ]);
}

/**
 * Create student from approved admission
 */
function createStudent($db) {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

    // If creating from admission application
    $admissionId = $input['admission_id'] ?? null;

    if ($admissionId) {
        $admission = $db->fetch("SELECT * FROM admissions WHERE id = ?", [$admissionId]);
        if (!$admission) {
            ApiResponse::error('Admission record not found', 404);
        }
        if ($admission['status'] !== 'approved') {
            ApiResponse::error('Admission must be approved first', 400);
        }

        // Create admission number
        $admissionNo = $admission['application_no'];

        $studentData = [
            'admission_no' => $admissionNo,
            'first_name' => $admission['first_name'],
            'last_name' => $admission['last_name'],
            'date_of_birth' => $admission['date_of_birth'],
            'gender' => $admission['gender'],
            'state_of_origin' => $admission['state_of_origin'],
            'religion' => $admission['religion'],
            'unit_id' => $input['unit_id'] ?? 3,
            'current_class' => $input['class'] ?? null,
            'parent_name' => $admission['parent_name'],
            'parent_phone' => $admission['parent_phone'],
            'parent_email' => $admission['parent_email'],
            'home_address' => $admission['home_address'],
            'previous_school' => $admission['previous_school'],
            'class_last_attended' => $admission['class_last_attended'],
            'admission_date' => date('Y-m-d'),
            'application_status' => 'approved',
            'status' => 'active'
        ];
    } else {
        // Generate student_id_number if missing
        $countRow = $db->fetch("SELECT COUNT(*) as total FROM students");
        $num = ($countRow['total'] ?? 0) + 1;
        $studentIdNum = 'PAA-' . date('Y') . '-' . str_pad($num, 4, '0', STR_PAD_LEFT);
        $rawPassword = !empty($input['password']) ? $input['password'] : Utilities::generateTempPassword(10);
        $passwordHash = Utilities::hashPassword($rawPassword);

        $studentData = [
            'admission_no'         => $admissionNo,
            'student_id_number'    => $studentIdNum,
            'username'             => strtolower(Utilities::sanitize($input['first_name']) . '.' . Utilities::sanitize($input['last_name'])),
            'password_hash'        => $passwordHash,
            'must_change_password' => 1,
            'first_name'           => Utilities::sanitize($input['first_name']),
            'last_name'            => Utilities::sanitize($input['last_name']),
            'date_of_birth'        => $input['date_of_birth'] ?? null,
            'gender'               => $input['gender'] ?? null,
            'state_of_origin'      => $input['state_of_origin'] ?? null,
            'religion'             => $input['religion'] ?? null,
            'unit_id'              => $input['unit_id'],
            'current_class'        => $input['current_class'] ?? $input['class'] ?? null,
            'parent_name'          => Utilities::sanitize($input['parent_name'] ?? ''),
            'parent_phone'         => $input['parent_phone'] ?? null,
            'parent_email'         => $input['parent_email'] ?? null,
            'home_address'         => Utilities::sanitize($input['home_address'] ?? ''),
            'previous_school'      => $input['previous_school'] ?? null,
            'class_last_attended'  => $input['class_last_attended'] ?? null,
            'admission_date'       => date('Y-m-d'),
            'application_status'   => 'approved',
            'status'               => !empty($input['status']) && in_array($input['status'], ['active', 'inactive', 'suspended']) ? $input['status'] : 'active'
        ];
    }

    try {
        $db->beginTransaction();

        $studentId = $db->insert('students', $studentData);

        // If there's a class assignment
        if ($input['class_id'] ?? null) {
            $db->insert('class_enrollment', [
                'student_id' => $studentId,
                'class_id' => $input['class_id'],
                'academic_session' => date('Y') . '/' . (date('Y') + 1),
                'enrolled_date' => date('Y-m-d')
            ]);
        }

        Utilities::logAudit(
            $db,
            'CREATE_STUDENT_ACCOUNT',
            "Created student record & login account: {$studentData['admission_no']} / {$studentData['student_id_number']} ({$studentData['first_name']} {$studentData['last_name']})",
            'staff',
            $input['staff_id'] ?? null,
            'Principal',
            'students',
            $studentId
        );

        $db->commit();

        ApiResponse::success([
            'id' => $studentId,
            'student_id' => $studentId,
            'user_id' => $studentData['student_id_number'],
            'staff_id' => $studentData['student_id_number'],
            'student_id_number' => $studentData['student_id_number'],
            'admission_no' => $studentData['admission_no'],
            'user_code' => $studentData['student_id_number'],
            'role' => 'student',
            'name' => $studentData['first_name'] . ' ' . $studentData['last_name'],
            'first_name' => $studentData['first_name'],
            'last_name' => $studentData['last_name'],
            'email' => $studentData['parent_email'] ?? '',
            'temporary_password' => $rawPassword ?? '123456',
            'must_change_password' => true,
            'status' => $studentData['status'],
            'login_url' => (isset($_SERVER['HTTP_HOST']) ? (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}/aidstudent/index.html" : "/aidstudent/index.html")
        ], 'Student record and login account created successfully', 201);

    } catch (Exception $e) {
        $db->rollBack();
        ApiResponse::error('Failed to create student: ' . $e->getMessage(), 500);
    }
}

/**
 * Update student record
 */
function updateStudent($db) {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $studentId = $_GET['id'] ?? null;
    $admissionNo = $_GET['admission_no'] ?? null;

    if (!$studentId && !$admissionNo) {
        ApiResponse::error('Student ID or admission number required', 400);
    }

    if (!$studentId && $admissionNo) {
        $student = $db->fetch("SELECT id FROM students WHERE admission_no = ?", [$admissionNo]);
        if ($student) {
            $studentId = $student['id'];
        }
    }

    $where = $studentId ? ['id' => $studentId] : ['admission_no' => $admissionNo];

    try {
        $updateData = [];

        $allowedFields = ['current_class', 'parent_name', 'parent_phone', 'parent_email', 'home_address', 'status', 'username'];
        foreach ($allowedFields as $field) {
            if (isset($input[$field])) {
                $updateData[$field] = $input[$field];
            }
        }

        // Validate username uniqueness
        if (isset($input['username'])) {
            $username = trim($input['username']);
            if (empty($username)) {
                ApiResponse::error('Username cannot be empty', 400);
            }
            if ($studentId) {
                $existing = $db->fetch("SELECT id FROM students WHERE username = ? AND id != ?", [$username, $studentId]);
                if ($existing) {
                    ApiResponse::error('Username is already taken by another student', 409);
                }
            }
            $updateData['username'] = $username;
        }

        // Hash and save password if provided
        if (!empty($input['password'])) {
            if (strlen($input['password']) < 8) {
                ApiResponse::error('Password must be at least 8 characters long', 400);
            }
            $updateData['password_hash'] = Utilities::hashPassword($input['password']);
        }

        if (empty($updateData)) {
            ApiResponse::error('No fields to update', 400);
        }

        $db->update('students', $updateData, $where);

        ApiResponse::success([], 'Student record updated successfully');

    } catch (Exception $e) {
        ApiResponse::error('Update failed: ' . $e->getMessage(), 500);
    }
}
