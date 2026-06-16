<?php
/**
 * School Aid Management System
 * Approvals API — approve/reject teacher & student applications
 * Requires: staff session token + appropriate role
 *
 * POST /api/approvals.php?action=approve|reject|request_correction
 * GET  /api/approvals.php?action=list&type=teacher|student&status=pending
 * GET  /api/approvals.php?action=get&id=1&type=teacher|student
 */

session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit(); }

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../includes/Helpers.php';

$db = null;
try { $db = new Database(); } catch (Exception $e) {
    ApiResponse::error('Database connection failed', 500);
}

// Authenticate staff
$token = getBearerToken();
if (!$token) ApiResponse::error('Authentication required', 401);
$staff = getAuthStaff($db, $token);
if (!$staff) ApiResponse::error('Invalid or expired session', 401);

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'list';

try {
    if ($method === 'GET') {
        switch ($action) {
            case 'list': listApplications($db, $staff); break;
            case 'get':  getApplication($db, $staff);  break;
            case 'history': listApprovalHistory($db, $staff); break;
            default: ApiResponse::error('Invalid action', 400);
        }
    } elseif ($method === 'POST') {
        switch ($action) {
            case 'approve':             approveApplication($db, $staff);           break;
            case 'reject':              rejectApplication($db, $staff);            break;
            case 'request_correction':  requestCorrection($db, $staff);            break;
            default: ApiResponse::error('Invalid action', 400);
        }
    }
} catch (Exception $e) {
    ApiResponse::error('Error: ' . $e->getMessage(), 500);
}

// -------------------------------------------------------
// LIST APPLICATIONS
// -------------------------------------------------------
function listApplications($db, $staff) {
    $type   = $_GET['type']   ?? null;
    $status = $_GET['status'] ?? 'pending';
    $limit  = min((int)($_GET['limit'] ?? 50), 200);
    $offset = (int)($_GET['offset'] ?? 0);
    $search = $_GET['search'] ?? '';

    // Role-based access: head_unit manages teachers, principal manages students
    if ($type === 'teacher' && !in_array($staff['role'], ['principal','unit_head','admin'])) {
        ApiResponse::error('Insufficient permissions to view teacher applications', 403);
    }
    if ($type === 'student' && !in_array($staff['role'], ['principal','admin'])) {
        ApiResponse::error('Insufficient permissions to view student applications', 403);
    }

    if (!$type) {
        // Return both based on role
        $results = [];
        if (in_array($staff['role'], ['principal','admin'])) {
            $results['teachers'] = fetchApplicationList($db, 'teacher', $status, $limit, $offset, $search);
            $results['students'] = fetchApplicationList($db, 'student', $status, $limit, $offset, $search);
        } elseif ($staff['role'] === 'unit_head') {
            $results['teachers'] = fetchApplicationList($db, 'teacher', $status, $limit, $offset, $search);
        }
        ApiResponse::success($results, 'Applications retrieved');
    }

    $results = fetchApplicationList($db, $type, $status, $limit, $offset, $search);
    ApiResponse::success($results, ucfirst($type) . ' applications retrieved');
}

function fetchApplicationList($db, $type, $status, $limit, $offset, $search) {
    $table = ($type === 'teacher') ? 'teacher_registrations' : 'student_registrations';
    $params = [];
    $where = ['r.deleted_at IS NULL'];

    if ($status !== 'all') {
        $where[] = 'r.status = ?';
        $params[] = $status;
    }
    if (!empty($search)) {
        $where[] = '(r.full_name LIKE ? OR r.email LIKE ?)';
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    $whereSQL = 'WHERE ' . implode(' AND ', $where);

    $countRow = $db->fetch("SELECT COUNT(*) as total FROM {$table} r {$whereSQL}", $params);
    $total = $countRow['total'] ?? 0;

    $params[] = $limit;
    $params[] = $offset;

    $approverJoin = ($type === 'teacher') ? 'LEFT JOIN staff app ON r.approved_by = app.id' : 'LEFT JOIN staff app ON r.approved_by = app.id';
    $rows = $db->fetchAll("
        SELECT r.*, 
               d.name as department_name_db,
               CONCAT(app.first_name,' ',app.last_name) as approver_name
        FROM {$table} r
        LEFT JOIN departments d ON r.department_id = d.id
        {$approverJoin}
        {$whereSQL}
        ORDER BY r.created_at DESC
        LIMIT ? OFFSET ?
    ", $params);

    return [
        'total'  => (int)$total,
        'limit'  => $limit,
        'offset' => $offset,
        'data'   => $rows
    ];
}

// -------------------------------------------------------
// GET SINGLE APPLICATION
// -------------------------------------------------------
function getApplication($db, $staff) {
    $id   = (int)($_GET['id']   ?? 0);
    $type = $_GET['type'] ?? '';

    if (!$id || !in_array($type, ['teacher','student'])) {
        ApiResponse::error('id and type are required', 400);
    }

    $table = ($type === 'teacher') ? 'teacher_registrations' : 'student_registrations';
    $row = $db->fetch("SELECT * FROM {$table} WHERE id = ? AND deleted_at IS NULL", [$id]);

    if (!$row) ApiResponse::error('Application not found', 404);
    // Remove password hash
    unset($row['password_hash']);

    ApiResponse::success($row, 'Application retrieved');
}

// -------------------------------------------------------
// APPROVE APPLICATION
// -------------------------------------------------------
function approveApplication($db, $staff) {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $id    = (int)($input['id']   ?? 0);
    $type  = $input['type'] ?? '';

    if (!$id || !in_array($type, ['teacher','student'])) {
        ApiResponse::error('id and type are required', 400);
    }

    // Role check
    if ($type === 'teacher' && !in_array($staff['role'], ['principal','unit_head','admin'])) {
        ApiResponse::error('Only Head Unit can approve teacher applications', 403);
    }
    if ($type === 'student' && !in_array($staff['role'], ['principal','admin'])) {
        ApiResponse::error('Only Principal can approve student applications', 403);
    }

    $table = ($type === 'teacher') ? 'teacher_registrations' : 'student_registrations';
    $reg = $db->fetch("SELECT * FROM {$table} WHERE id = ? AND deleted_at IS NULL", [$id]);
    if (!$reg) ApiResponse::error('Application not found', 404);
    if ($reg['status'] !== 'pending' && $reg['status'] !== 'correction_requested') {
        ApiResponse::error('Application has already been processed', 409);
    }

    $db->beginTransaction();
    try {
        $year      = date('Y');
        $approvedAt = date('Y-m-d H:i:s');

        if ($type === 'teacher') {
            // Generate Employee ID: TEA-YYYY-XXXX
            $countRow  = $db->fetch("SELECT COUNT(*) as cnt FROM staff WHERE staff_id LIKE ?", ["TEA-{$year}-%"]);
            $seq       = str_pad(($countRow['cnt'] ?? 0) + 1, 4, '0', STR_PAD_LEFT);
            $employeeId = "TEA-{$year}-{$seq}";

            // Generate username from name
            $nameParts = explode(' ', strtolower($reg['full_name']));
            $baseUser  = preg_replace('/[^a-z0-9]/', '', ($nameParts[0] ?? '') . '.' . ($nameParts[1] ?? ''));
            $username  = generateUniqueUsername($db, $baseUser, 'staff');

            // Create staff record
            $staffId = $db->insert('staff', [
                'staff_id'      => $employeeId,
                'first_name'    => explode(' ', $reg['full_name'])[0],
                'last_name'     => implode(' ', array_slice(explode(' ', $reg['full_name']), 1)) ?: '-',
                'email'         => $reg['email'],
                'username'      => $username,
                'phone'         => $reg['phone'],
                'date_of_birth' => $reg['date_of_birth'],
                'qualification' => $reg['qualification'],
                'department_id' => $reg['department_id'],
                'passport_photo'=> $reg['passport_photo'],
                'password_hash' => $reg['password_hash'],
                'role'          => 'teacher',
                'status'        => 'active',
                'hire_date'     => date('Y-m-d'),
            ]);

            // Update registration record
            $db->update($table, [
                'status'      => 'approved',
                'employee_id' => $employeeId,
                'username'    => $username,
                'approved_by' => $staff['id'],
                'approved_at' => $approvedAt,
                'staff_id'    => $staffId,
            ], ['id' => $id]);

            $resultData = ['employee_id' => $employeeId, 'username' => $username, 'staff_db_id' => $staffId];

        } else {
            // Generate Student ID: STD-YYYY-XXXX
            $countRow  = $db->fetch("SELECT COUNT(*) as cnt FROM students WHERE student_id_number LIKE ?", ["STD-{$year}-%"]);
            $seq       = str_pad(($countRow['cnt'] ?? 0) + 1, 4, '0', STR_PAD_LEFT);
            $studentIdNum = "STD-{$year}-{$seq}";

            // Get a unit (default to first available)
            $unit = $db->fetch("SELECT id FROM units LIMIT 1");
            $unitId = $unit['id'] ?? 1;

            // Username
            $nameParts = explode(' ', strtolower($reg['full_name']));
            $baseUser  = preg_replace('/[^a-z0-9]/', '', ($nameParts[0] ?? '') . '.' . ($nameParts[1] ?? ''));
            $username  = generateUniqueUsername($db, $baseUser, 'student');

            // Admission number (re-use existing format)
            $admNo = 'PAA-' . $year . '-' . str_pad(rand(1000,9999), 4, '0', STR_PAD_LEFT);

            $studentDbId = $db->insert('students', [
                'admission_no'       => $admNo,
                'student_id_number'  => $studentIdNum,
                'first_name'         => explode(' ', $reg['full_name'])[0],
                'last_name'          => implode(' ', array_slice(explode(' ', $reg['full_name']), 1)) ?: '-',
                'date_of_birth'      => $reg['date_of_birth'],
                'email'              => $reg['email'],
                'username'           => $username,
                'phone'              => $reg['phone'],
                'department_id'      => $reg['department_id'],
                'current_class'      => $reg['class_name'],
                'passport_photo'     => $reg['passport_photo'],
                'password_hash'      => $reg['password_hash'],
                'unit_id'            => $unitId,
                'admission_date'     => date('Y-m-d'),
                'application_status' => 'approved',
                'portal_access_status' => 'approved',
                'status'             => 'active',
            ]);

            $db->update($table, [
                'status'              => 'approved',
                'student_id_generated'=> $studentIdNum,
                'username'            => $username,
                'approved_by'         => $staff['id'],
                'approved_at'         => $approvedAt,
                'db_student_id'       => $studentDbId,
            ], ['id' => $id]);

            $resultData = ['student_id' => $studentIdNum, 'username' => $username, 'admission_no' => $admNo];
        }

        // Write approval history
        $db->insert('approvals', [
            'applicant_id'    => $id,
            'applicant_type'  => $type,
            'approver_id'     => $staff['id'],
            'approval_status' => 'approved',
            'comments'        => $input['comments'] ?? null,
            'approval_date'   => $approvedAt,
        ]);

        // Notification for the applicant (stored)
        // In a real system, trigger email here

        // Audit
        auditLog($db, 'staff', $staff['id'], $staff['first_name'].' '.$staff['last_name'],
            'APPROVE_' . strtoupper($type), $table, $id,
            "Approved {$type} application ID {$id}: {$reg['full_name']}", $_SERVER['REMOTE_ADDR'] ?? null);

        $db->commit();

        ApiResponse::success($resultData, ucfirst($type) . ' application approved successfully', 200);

    } catch (Exception $e) {
        $db->rollBack();
        throw $e;
    }
}

// -------------------------------------------------------
// REJECT APPLICATION
// -------------------------------------------------------
function rejectApplication($db, $staff) {
    $input  = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $id     = (int)($input['id']   ?? 0);
    $type   = $input['type'] ?? '';
    $reason = trim($input['reason'] ?? '');

    if (!$id || !in_array($type, ['teacher','student'])) ApiResponse::error('id and type required', 400);
    if (empty($reason)) ApiResponse::error('Rejection reason is required', 422);

    if ($type === 'teacher' && !in_array($staff['role'], ['principal','unit_head','admin'])) {
        ApiResponse::error('Insufficient permissions', 403);
    }
    if ($type === 'student' && !in_array($staff['role'], ['principal','admin'])) {
        ApiResponse::error('Insufficient permissions', 403);
    }

    $table = ($type === 'teacher') ? 'teacher_registrations' : 'student_registrations';
    $reg = $db->fetch("SELECT * FROM {$table} WHERE id = ? AND deleted_at IS NULL", [$id]);
    if (!$reg) ApiResponse::error('Application not found', 404);

    $db->update($table, [
        'status'           => 'rejected',
        'rejection_reason' => $reason,
        'approved_by'      => $staff['id'],
        'approved_at'      => date('Y-m-d H:i:s'),
    ], ['id' => $id]);

    $db->insert('approvals', [
        'applicant_id'    => $id,
        'applicant_type'  => $type,
        'approver_id'     => $staff['id'],
        'approval_status' => 'rejected',
        'rejection_reason'=> $reason,
        'approval_date'   => date('Y-m-d H:i:s'),
    ]);

    auditLog($db, 'staff', $staff['id'], $staff['first_name'].' '.$staff['last_name'],
        'REJECT_' . strtoupper($type), $table, $id,
        "Rejected {$type} application ID {$id}: {$reg['full_name']}. Reason: {$reason}", $_SERVER['REMOTE_ADDR'] ?? null);

    ApiResponse::success(['id' => $id], ucfirst($type) . ' application rejected');
}

// -------------------------------------------------------
// REQUEST CORRECTION
// -------------------------------------------------------
function requestCorrection($db, $staff) {
    $input    = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $id       = (int)($input['id']   ?? 0);
    $type     = $input['type'] ?? '';
    $comments = trim($input['comments'] ?? '');

    if (!$id || !in_array($type, ['teacher','student'])) ApiResponse::error('id and type required', 400);
    if (empty($comments)) ApiResponse::error('Correction comments are required', 422);

    $table = ($type === 'teacher') ? 'teacher_registrations' : 'student_registrations';
    $reg = $db->fetch("SELECT * FROM {$table} WHERE id = ? AND deleted_at IS NULL", [$id]);
    if (!$reg) ApiResponse::error('Application not found', 404);

    $db->update($table, [
        'status'              => 'correction_requested',
        'correction_comments' => $comments,
        'approved_by'         => $staff['id'],
        'approved_at'         => date('Y-m-d H:i:s'),
    ], ['id' => $id]);

    $db->insert('approvals', [
        'applicant_id'    => $id,
        'applicant_type'  => $type,
        'approver_id'     => $staff['id'],
        'approval_status' => 'correction_requested',
        'comments'        => $comments,
        'approval_date'   => date('Y-m-d H:i:s'),
    ]);

    auditLog($db, 'staff', $staff['id'], $staff['first_name'].' '.$staff['last_name'],
        'CORRECTION_REQUESTED', $table, $id,
        "Correction requested for {$type} ID {$id}: {$reg['full_name']}", $_SERVER['REMOTE_ADDR'] ?? null);

    ApiResponse::success(['id' => $id], 'Correction request sent');
}

// -------------------------------------------------------
// APPROVAL HISTORY
// -------------------------------------------------------
function listApprovalHistory($db, $staff) {
    if (!in_array($staff['role'], ['principal','unit_head','admin'])) {
        ApiResponse::error('Insufficient permissions', 403);
    }
    $limit  = min((int)($_GET['limit'] ?? 50), 200);
    $offset = (int)($_GET['offset'] ?? 0);

    $rows = $db->fetchAll("
        SELECT a.*,
               CONCAT(s.first_name,' ',s.last_name) as approver_name,
               s.role as approver_role
        FROM approvals a
        JOIN staff s ON a.approver_id = s.id
        ORDER BY a.created_at DESC
        LIMIT ? OFFSET ?
    ", [$limit, $offset]);

    $total = $db->fetch("SELECT COUNT(*) as cnt FROM approvals");
    ApiResponse::success(['total' => (int)$total['cnt'], 'data' => $rows]);
}

// -------------------------------------------------------
// Helpers
// -------------------------------------------------------
function getBearerToken() {
    $headers = getallheaders();
    $auth = $headers['Authorization'] ?? $headers['authorization'] ?? ($_GET['token'] ?? '');
    return str_replace('Bearer ', '', $auth) ?: null;
}

function getAuthStaff($db, $token) {
    $session = $db->fetch(
        "SELECT ls.*, s.id, s.staff_id, s.first_name, s.last_name, s.role, s.unit_id, s.status
         FROM login_sessions ls
         JOIN staff s ON ls.staff_id = s.id
         WHERE ls.session_token = ? AND ls.logout_time IS NULL
         LIMIT 1",
        [$token]
    );
    if (!$session) return null;
    if (time() - strtotime($session['login_time']) > 86400) return null;
    if ($session['status'] !== 'active') return null;
    return $session;
}

function generateUniqueUsername($db, $base, $table) {
    $candidate = $base;
    $i = 1;
    while (true) {
        $exists = $db->fetch("SELECT id FROM {$table} WHERE username = ?", [$candidate]);
        if (!$exists) return $candidate;
        $candidate = $base . $i++;
    }
}

function auditLog($db, $actorType, $actorId, $actorName, $action, $resourceType, $resourceId, $description, $ip) {
    try {
        $db->insert('audit_logs', [
            'actor_type'    => $actorType,
            'actor_id'      => $actorId,
            'actor_name'    => $actorName,
            'action'        => $action,
            'resource_type' => $resourceType,
            'resource_id'   => $resourceId,
            'description'   => $description,
            'ip_address'    => $ip,
        ]);
    } catch (Exception $e) { /* fail silently */ }
}
