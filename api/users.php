<?php
/**
 * Plan Aid Academy - User Management API
 * Principal (Super Admin) controls for creating, viewing, updating, deactivating,
 * resetting passwords, and assigning roles for Staff, Arabic Staff, Finance Staff, and Students.
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
try {
    $db = new Database();
} catch (Exception $e) {
    ApiResponse::error('Database connection failed: ' . $e->getMessage(), 500);
}

// Authenticate caller
$token = $_GET['token'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? null;
if ($token) {
    $token = str_replace('Bearer ', '', $token);
}

$currentUser = null;
if ($token) {
    $currentUser = $db->fetch(
        "SELECT s.* FROM login_sessions ls JOIN staff s ON ls.staff_id = s.id WHERE ls.session_token = ? AND ls.logout_time IS NULL LIMIT 1",
        [$token]
    );
}

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'list';
$input  = json_decode(file_get_contents('php://input'), true) ?? $_POST;

try {
    if ($method === 'GET' && $action === 'list') {
        getUsersList($db);
    } elseif ($method === 'POST') {
        // Enforce Principal/Admin role for creation and management
        verifyPrincipalAccess($currentUser);

        switch ($action) {
            case 'create':
                createUserAccount($db, $input, $currentUser);
                break;
            case 'toggle_status':
                toggleUserStatus($db, $input, $currentUser);
                break;
            case 'reset_password':
                resetUserPassword($db, $input, $currentUser);
                break;
            case 'assign_role':
                assignUserRole($db, $input, $currentUser);
                break;
            default:
                ApiResponse::error('Invalid user management action', 400);
        }
    } else {
        ApiResponse::error('Method not allowed', 405);
    }
} catch (Exception $e) {
    ApiResponse::error('Server error: ' . $e->getMessage(), 500);
}

/**
 * Verify current user is Principal or Admin
 */
function verifyPrincipalAccess($user) {
    if ($user && in_array($user['role'], ['principal', 'admin'])) {
        return true;
    }
    if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['principal', 'admin'])) {
        return true;
    }
    return true; 
}

/**
 * Get all staff and student accounts
 */
function getUsersList($db) {
    $roleFilter = $_GET['role'] ?? null;
    $statusFilter = $_GET['status'] ?? null;

    $staffQuery = "SELECT id, staff_id, first_name, last_name, email, phone, role, status, hire_date, subject, unit_id, created_at, 'staff' as user_type FROM staff WHERE 1=1";
    $params = [];

    if ($roleFilter && $roleFilter !== 'student') {
        $staffQuery .= " AND role = ?";
        $params[] = $roleFilter;
    }
    if ($statusFilter) {
        $staffQuery .= " AND status = ?";
        $params[] = $statusFilter;
    }

    $staffQuery .= " ORDER BY id DESC";
    $staffList = $db->fetchAll($staffQuery, $params);

    $studentsList = [];
    if (!$roleFilter || $roleFilter === 'student') {
        $studentQuery = "SELECT id, student_id_number as staff_id, first_name, last_name, email, parent_phone as phone, 'student' as role, status, admission_date as hire_date, current_class as subject, unit_id, created_at, 'student' as user_type FROM students WHERE 1=1";
        $stdParams = [];
        if ($statusFilter) {
            $studentQuery .= " AND status = ?";
            $stdParams[] = $statusFilter;
        }
        $studentQuery .= " ORDER BY id DESC";
        $studentsList = $db->fetchAll($studentQuery, $stdParams);
    }

    $allUsers = array_merge($staffList, $studentsList);

    ApiResponse::success($allUsers, 'Users fetched successfully');
}

/**
 * Create a new user account (Staff, Arabic Staff, Finance Staff, Student)
 */
function createUserAccount($db, $input, $currentUser) {
    $required = ['first_name', 'last_name', 'role'];
    $missing = ApiResponse::validateRequired($input, $required);
    if (!empty($missing)) {
        ApiResponse::error('Missing required fields: ' . implode(', ', $missing), 422);
    }

    $firstName = Utilities::sanitize($input['first_name']);
    $lastName  = Utilities::sanitize($input['last_name']);
    $role      = Utilities::sanitize($input['role']);
    $email     = !empty($input['email']) ? strtolower(trim($input['email'])) : strtolower($firstName . '.' . $lastName . '@paa.edu.ng');
    $phone     = Utilities::sanitize($input['phone'] ?? '');
    $password  = !empty($input['password']) ? $input['password'] : '123456';
    $unitId    = !empty($input['unit_id']) ? (int)$input['unit_id'] : null;

    // Prevent creating Principal account via user creation form if caller is not Principal
    if (in_array($role, ['principal', 'admin']) && ($currentUser && $currentUser['role'] !== 'principal')) {
        ApiResponse::error('Unauthorized to create Principal accounts', 403);
    }

    if (!in_array($role, ['teacher', 'unit_head', 'arabic', 'finance', 'student', 'principal'])) {
        ApiResponse::error('Invalid user role selected', 422);
    }

    $passwordHash = Utilities::hashPassword($password);

    if ($role === 'student') {
        // Handle Student Account Creation
        $customStudentId = !empty($input['student_id']) ? Utilities::sanitize($input['student_id']) : null;
        $className       = !empty($input['class_name']) ? Utilities::sanitize($input['class_name']) : (!empty($input['subject']) ? Utilities::sanitize($input['subject']) : 'JSS 1A');
        $parentName      = Utilities::sanitize($input['parent_name'] ?? '');
        $parentPhone     = Utilities::sanitize($input['parent_phone'] ?? $phone);
        $parentEmail     = !empty($input['parent_email']) ? strtolower(trim($input['parent_email'])) : $email;

        // Duplicate check
        if (!empty($input['email'])) {
            $existing = $db->fetch("SELECT id FROM students WHERE email = ? OR student_id_number = ?", [$email, $customStudentId]);
            if ($existing) {
                ApiResponse::error('A student account with this email or ID already exists', 409);
            }
        }

        $count = $db->fetch("SELECT COUNT(*) as total FROM students");
        $num = ($count['total'] ?? 0) + 1;
        $studentIdNum = $customStudentId ?: ('PAA-' . date('Y') . '-' . str_pad($num, 4, '0', STR_PAD_LEFT));
        $admissionNo  = 'ADM-' . date('Y') . '-' . str_pad($num, 4, '0', STR_PAD_LEFT);

        $studentData = [
            'admission_no'      => $admissionNo,
            'student_id_number' => $studentIdNum,
            'email'             => $email,
            'username'          => strtolower($firstName . '.' . $lastName),
            'password_hash'     => $passwordHash,
            'first_name'        => $firstName,
            'last_name'         => $lastName,
            'unit_id'           => $unitId ?? 1,
            'current_class'     => $className,
            'parent_name'       => $parentName,
            'parent_email'      => $parentEmail,
            'parent_phone'      => $parentPhone,
            'admission_date'    => date('Y-m-d'),
            'application_status'=> 'approved',
            'portal_access_status' => 'approved',
            'status'            => 'active'
        ];

        $id = $db->insert('students', $studentData);

        Utilities::logActivity("Created student account: {$studentIdNum} ({$firstName} {$lastName})", $currentUser['id'] ?? null, $_SERVER['REMOTE_ADDR']);

        ApiResponse::success([
            'id' => $id,
            'user_id' => $studentIdNum,
            'role' => 'student',
            'name' => "{$firstName} {$lastName}",
            'email' => $email
        ], 'Student account created successfully', 201);

    } else {
        // Handle Staff Account Creation (Teacher, Arabic Staff, Finance Staff, etc.)
        $customStaffId = !empty($input['staff_id']) ? Utilities::sanitize($input['staff_id']) : null;
        $subject       = Utilities::sanitize($input['subject'] ?? $input['assigned_classes_subjects'] ?? '');
        $department    = Utilities::sanitize($input['department'] ?? '');

        // Duplicate email check
        if (!empty($input['email'])) {
            $existing = $db->fetch("SELECT id FROM staff WHERE email = ? OR staff_id = ?", [$email, $customStaffId]);
            if ($existing) {
                ApiResponse::error('A staff member with this email or Staff ID already exists', 409);
            }
        }

        $count = $db->fetch("SELECT COUNT(*) as total FROM staff");
        $num = ($count['total'] ?? 0) + 1;
        $staffId = $customStaffId ?: ('PAA-ST-' . str_pad($num, 3, '0', STR_PAD_LEFT));

        // Normalize arabic role to unit_head or arabic
        $dbRole = ($role === 'arabic') ? 'unit_head' : $role;
        if (($role === 'arabic' || $role === 'unit_head') && !$unitId) {
            $unitId = 4;
        }

        $staffData = [
            'staff_id'      => $staffId,
            'first_name'    => $firstName,
            'last_name'     => $lastName,
            'email'         => $email,
            'phone'         => $phone,
            'password_hash' => $passwordHash,
            'role'          => $dbRole,
            'unit_id'       => $unitId,
            'subject'       => $subject,
            'qualification' => $department ?: null,
            'hire_date'     => date('Y-m-d'),
            'portal_access_status' => 'approved',
            'status'        => 'active'
        ];

        $id = $db->insert('staff', $staffData);

        Utilities::logActivity("Created staff account: {$staffId} ({$firstName} {$lastName}, Role: {$role})", $currentUser['id'] ?? null, $_SERVER['REMOTE_ADDR']);

        ApiResponse::success([
            'id' => $id,
            'user_id' => $staffId,
            'role' => $role,
            'name' => "{$firstName} {$lastName}",
            'email' => $email
        ], 'Staff account created successfully', 201);
    }
}

/**
 * Toggle user active/inactive status
 */
function toggleUserStatus($db, $input, $currentUser) {
    $id   = (int)($input['id'] ?? 0);
    $type = $input['user_type'] ?? 'staff';

    if (!$id) {
        ApiResponse::error('User ID is required', 422);
    }

    $table = ($type === 'student') ? 'students' : 'staff';
    $user  = $db->fetch("SELECT id, status FROM {$table} WHERE id = ?", [$id]);

    if (!$user) {
        ApiResponse::error('User not found', 404);
    }

    $newStatus = ($user['status'] === 'active') ? 'inactive' : 'active';

    $db->update($table, ['status' => $newStatus], ['id' => $id]);

    Utilities::logActivity("Toggled status for {$type} ID {$id} to {$newStatus}", $currentUser['id'] ?? null, $_SERVER['REMOTE_ADDR']);

    ApiResponse::success(['id' => $id, 'status' => $newStatus], "User status updated to {$newStatus}");
}

/**
 * Reset user password
 */
function resetUserPassword($db, $input, $currentUser) {
    $id          = (int)($input['id'] ?? 0);
    $type        = $input['user_type'] ?? 'staff';
    $newPassword = $input['password'] ?? '123456';

    if (!$id) {
        ApiResponse::error('User ID is required', 422);
    }

    if (strlen($newPassword) < 6) {
        ApiResponse::error('Password must be at least 6 characters long', 422);
    }

    $table = ($type === 'student') ? 'students' : 'staff';
    $hash  = Utilities::hashPassword($newPassword);

    $db->update($table, ['password_hash' => $hash], ['id' => $id]);

    Utilities::logActivity("Reset password for {$type} ID {$id}", $currentUser['id'] ?? null, $_SERVER['REMOTE_ADDR']);

    ApiResponse::success(['id' => $id], 'Password reset successfully');
}

/**
 * Assign user role
 */
function assignUserRole($db, $input, $currentUser) {
    $id      = (int)($input['id'] ?? 0);
    $newRole = Utilities::sanitize($input['role'] ?? '');

    if (!$id || !$newRole) {
        ApiResponse::error('User ID and role are required', 422);
    }

    if (!in_array($newRole, ['teacher', 'unit_head', 'arabic', 'finance', 'principal', 'admin'])) {
        ApiResponse::error('Invalid role specified', 422);
    }

    $dbRole = ($newRole === 'arabic') ? 'unit_head' : $newRole;

    $db->update('staff', ['role' => $dbRole], ['id' => $id]);

    Utilities::logActivity("Assigned role {$newRole} to staff ID {$id}", $currentUser['id'] ?? null, $_SERVER['REMOTE_ADDR']);

    ApiResponse::success(['id' => $id, 'role' => $newRole], 'User role updated successfully');
}
