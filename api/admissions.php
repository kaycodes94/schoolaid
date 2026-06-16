<?php
/**
 * Plan Aid Academy - Admissions API
 * Handles admission applications and submissions
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

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
    if ($method === 'POST') {
        handleAdmissionSubmission($db);
    } elseif ($method === 'GET') {
        switch ($action) {
            case 'get':
                getAdmission($db);
                break;
            case 'list':
                listAdmissions($db);
                break;
            case 'pending':
                getPendingAdmissions($db);
                break;
            default:
                ApiResponse::error('Invalid action', 400);
        }
    }
} catch (Exception $e) {
    ApiResponse::error('Server error: ' . $e->getMessage(), 500);
}

/**
 * Handle new admission submission
 */
function handleAdmissionSubmission($db) {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

    // Validate required fields
    $validator = new Validator();
    if (!$validator->validateAdmission($input)) {
        ApiResponse::error('Validation failed', 422, $validator->getErrors());
    }

    // Check for duplicate application by parent info
    $existing = $db->fetch(
        "SELECT id FROM admissions WHERE parent_phone = ? AND last_name = ?",
        [$input['parent_phone'] ?? '', $input['last_name']]
    );

    if ($existing && isset($input['parent_phone']) && $input['parent_phone']) {
        ApiResponse::error('Application already submitted with this contact info', 400);
    }

    // Generate unique application number
    $applicationNo = Utilities::generateApplicationNo();
    
    // Ensure application number is unique
    while ($db->fetch("SELECT id FROM admissions WHERE application_no = ?", [$applicationNo])) {
        $applicationNo = Utilities::generateApplicationNo();
    }

    // Prepare admission data
    $admissionData = [
        'application_no' => $applicationNo,
        'first_name' => Utilities::sanitize($input['first_name']),
        'last_name' => Utilities::sanitize($input['last_name']),
        'date_of_birth' => $input['date_of_birth'] ?? null,
        'gender' => $input['gender'] ?? null,
        'state_of_origin' => Utilities::sanitize($input['state_of_origin'] ?? ''),
        'religion' => $input['religion'] ?? null,
        'unit_applied' => Utilities::sanitize($input['unit_applied']),
        'parent_name' => Utilities::sanitize($input['parent_name'] ?? ''),
        'parent_phone' => $input['parent_phone'] ?? null,
        'parent_email' => $input['parent_email'] ?? null,
        'home_address' => Utilities::sanitize($input['home_address'] ?? ''),
        'previous_school' => Utilities::sanitize($input['previous_school'] ?? ''),
        'class_last_attended' => Utilities::sanitize($input['class_last_attended'] ?? ''),
        'application_date' => date('Y-m-d'),
        'status' => 'pending'
    ];

    try {
        $db->beginTransaction();
        
        // Insert admission record
        $admissionId = $db->insert('admissions', $admissionData);

        // Log activity
        Utilities::logActivity(
            "New admission application: {$applicationNo}",
            null,
            $_SERVER['REMOTE_ADDR'] ?? 'Unknown'
        );

        $db->commit();

        ApiResponse::success([
            'admission_id' => $admissionId,
            'application_no' => $applicationNo,
            'full_name' => $admissionData['first_name'] . ' ' . $admissionData['last_name'],
            'unit_applied' => $admissionData['unit_applied'],
            'application_date' => $admissionData['application_date'],
            'status' => $admissionData['status']
        ], 'Admission application submitted successfully', 201);

    } catch (Exception $e) {
        $db->rollBack();
        ApiResponse::error('Failed to submit application: ' . $e->getMessage(), 500);
    }
}

/**
 * Get single admission record
 */
function getAdmission($db) {
    $applicationNo = $_GET['id'] ?? null;

    if (!$applicationNo) {
        ApiResponse::error('Application number required', 400);
    }

    $admission = $db->fetch(
        "SELECT * FROM admissions WHERE application_no = ?",
        [$applicationNo]
    );

    if (!$admission) {
        ApiResponse::error('Admission record not found', 404);
    }

    ApiResponse::success($admission);
}

/**
 * List all admissions with filters
 */
function listAdmissions($db) {
    $status = $_GET['status'] ?? null;
    $unit = $_GET['unit'] ?? null;
    $limit = (int)($_GET['limit'] ?? 50);
    $offset = (int)($_GET['offset'] ?? 0);

    $query = "SELECT * FROM admissions WHERE 1=1";
    $params = [];

    if ($status) {
        $query .= " AND status = ?";
        $params[] = $status;
    }

    if ($unit) {
        $query .= " AND unit_applied LIKE ?";
        $params[] = '%' . $unit . '%';
    }

    $query .= " ORDER BY application_date DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;

    $admissions = $db->fetchAll($query, $params);

    // Get total count
    $countQuery = "SELECT COUNT(*) as total FROM admissions WHERE 1=1";
    if ($status) {
        $countQuery .= " AND status = ?";
    }
    if ($unit) {
        $countQuery .= " AND unit_applied LIKE ?";
    }

    $countResult = $db->fetch($countQuery, array_slice($params, 0, count($params) - 2));
    $total = $countResult['total'] ?? 0;

    ApiResponse::success([
        'admissions' => $admissions,
        'total' => $total,
        'limit' => $limit,
        'offset' => $offset
    ]);
}

/**
 * Get pending admissions (for staff approval)
 */
function getPendingAdmissions($db) {
    $admissions = $db->fetchAll(
        "SELECT * FROM admissions WHERE status = 'pending' ORDER BY application_date DESC LIMIT 100"
    );

    ApiResponse::success([
        'count' => count($admissions),
        'admissions' => $admissions
    ]);
}

/**
 * Approve/Reject admission (accessible to principal/unit heads)
 */
function updateAdmissionStatus($db) {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        ApiResponse::error('POST method required', 405);
    }

    // This would be called by authenticated staff
    $input = json_decode(file_get_contents('php://input'), true);

    $applicationNo = $input['application_no'] ?? null;
    $status = $input['status'] ?? null;
    $staffId = $input['staff_id'] ?? null; // Would come from session

    if (!$applicationNo || !in_array($status, ['approved', 'rejected'])) {
        ApiResponse::error('Invalid parameters', 400);
    }

    // Check if staff is authorized (principal or unit head)
    // This check would be done in actual implementation

    try {
        $db->update(
            'admissions',
            [
                'status' => $status,
                'approved_by' => $staffId,
                'approval_date' => date('Y-m-d')
            ],
            ['application_no' => $applicationNo]
        );

        ApiResponse::success([], "Admission {$status} successfully");

    } catch (Exception $e) {
        ApiResponse::error('Update failed: ' . $e->getMessage(), 500);
    }
}
