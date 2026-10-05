<?php
/**
 * Plan Aid Academy - Authentication API
 * Handles staff login, session management, and logout
 */

session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
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
$action = $_GET['action'] ?? 'login';

try {
    if ($method === 'POST') {
        switch ($action) {
            case 'login':
                handleLogin($db);
                break;
            case 'change_password':
                handleChangePassword($db);
                break;
            case 'forgot_password':
                handleForgotPassword($db);
                break;
            case 'reset_forgot_password':
                handleResetForgotPassword($db);
                break;
            default:
                // Default to login if no action specified or action is 'login'
                handleLogin($db);
        }
    } elseif ($method === 'GET') {
        switch ($action) {
            case 'verify':
                verifySession($db);
                break;
            case 'user':
                getUserInfo($db);
                break;
            case 'logout':
                handleLogout($db);
                break;
            default:
                ApiResponse::error('Invalid action', 400);
        }
    }
} catch (Exception $e) {
    ApiResponse::error('Server error: ' . $e->getMessage(), 500);
}

/**
 * Handle staff & student login with account status checks and must_change_password flag
 */
function handleLogin($db) {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

    if (!isset($input['staff_id'])) {
        if (isset($input['username'])) $input['staff_id'] = $input['username'];
        elseif (isset($input['identifier'])) $input['staff_id'] = $input['identifier'];
        elseif (isset($input['id'])) $input['staff_id'] = $input['id'];
    }

    // Validate required fields
    $validator = new Validator();
    if (!$validator->validateLogin($input)) {
        ApiResponse::error('Validation failed', 422, $validator->getErrors());
    }

    $staffId = Utilities::sanitize($input['staff_id']);
    $password = $input['password'];

    // Fetch staff member by staff ID, username or email
    $staff = $db->fetch(
        "SELECT * FROM staff WHERE staff_id = ? OR email = ? OR username = ? LIMIT 1",
        [$staffId, $staffId, $staffId]
    );

    $student = null;
    if (!$staff) {
        // Try fetching student by student_id_number, username or email
        $student = $db->fetch(
            "SELECT * FROM students WHERE student_id_number = ? OR username = ? OR email = ? OR admission_no = ? LIMIT 1",
            [$staffId, $staffId, $staffId, $staffId]
        );
    }

    if (!$staff && !$student) {
        // Log failed attempt
        Utilities::logAudit($db, 'LOGIN_FAILED', "Failed login attempt for unknown user identifier: {$staffId}", 'system', null, 'Guest', 'user', null);
        ApiResponse::error('Invalid credentials. Please check your username/ID and password.', 401);
    }

    if ($staff) {
        // Password verification
        $isPasswordValid = false;
        if (!empty($staff['password_hash'])) {
            $isPasswordValid = Utilities::verifyPassword($password, $staff['password_hash']);
        }

        if (!$isPasswordValid) {
            Utilities::logAudit($db, 'LOGIN_FAILED', "Failed login attempt for staff: {$staff['staff_id']}", 'staff', $staff['id'], $staff['first_name'] . ' ' . $staff['last_name'], 'staff', $staff['id']);
            ApiResponse::error('Invalid credentials. Please check your password.', 401);
        }

        // Account Status Check (active, inactive, suspended)
        $status = strtolower($staff['status'] ?? 'active');
        if (in_array($status, ['inactive', 'suspended'])) {
            Utilities::logAudit($db, 'LOGIN_BLOCKED', "Blocked login attempt for {$status} staff account: {$staff['staff_id']}", 'staff', $staff['id'], $staff['first_name'] . ' ' . $staff['last_name'], 'staff', $staff['id']);
            ApiResponse::error("Account is {$status}. Inactive or suspended accounts cannot log in. Please contact administration.", 403);
        }

        // Generate session token
        $token = Utilities::generateToken();
        $mustChange = !empty($staff['must_change_password']) && (int)$staff['must_change_password'] === 1;

        try {
            // Store session in database
            $sessionData = [
                'staff_id' => $staff['id'],
                'session_token' => $token,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
            ];

            $db->insert('login_sessions', $sessionData);

            // Log successful login
            Utilities::logAudit($db, 'LOGIN_SUCCESS', "Staff login successful: {$staff['staff_id']}", 'staff', $staff['id'], $staff['first_name'] . ' ' . $staff['last_name'], 'staff', $staff['id']);

            // Get unit information if applicable
            $unit = null;
            if (!empty($staff['unit_id'])) {
                $unit = $db->fetch("SELECT id, name, code FROM units WHERE id = ?", [$staff['unit_id']]);
            }

            ApiResponse::success([
                'token' => $token,
                'user_id' => $staff['id'],
                'staff_id' => $staff['staff_id'],
                'name' => $staff['first_name'] . ' ' . $staff['last_name'],
                'first_name' => $staff['first_name'],
                'last_name' => $staff['last_name'],
                'email' => $staff['email'],
                'role' => $staff['role'],
                'unit' => $unit,
                'must_change_password' => $mustChange,
                'status' => $staff['status'],
                'avatar_initials' => substr($staff['first_name'], 0, 1) . substr($staff['last_name'], 0, 1)
            ], 'Login successful', 200);

        } catch (Exception $e) {
            ApiResponse::error('Login failed: ' . $e->getMessage(), 500);
        }

    } else {
        // Student login
        $isPasswordValid = false;
        if (!empty($student['password_hash'])) {
            $isPasswordValid = Utilities::verifyPassword($password, $student['password_hash']);
        }

        if (!$isPasswordValid) {
            Utilities::logAudit($db, 'LOGIN_FAILED', "Failed login attempt for student: {$student['student_id_number']}", 'student', $student['id'], $student['first_name'] . ' ' . $student['last_name'], 'students', $student['id']);
            ApiResponse::error('Invalid credentials. Please check your password.', 401);
        }

        // Account Status Check (active, inactive, suspended)
        $status = strtolower($student['status'] ?? 'active');
        if (in_array($status, ['inactive', 'suspended'])) {
            Utilities::logAudit($db, 'LOGIN_BLOCKED', "Blocked login attempt for {$status} student account: {$student['student_id_number']}", 'student', $student['id'], $student['first_name'] . ' ' . $student['last_name'], 'students', $student['id']);
            ApiResponse::error("Student account is {$status}. Inactive or suspended accounts cannot log in. Please contact administration.", 403);
        }

        // Generate session token
        $token = Utilities::generateToken();
        $mustChange = !empty($student['must_change_password']) && (int)$student['must_change_password'] === 1;

        try {
            // Store session in database
            $sessionData = [
                'student_id' => $student['id'],
                'session_token' => $token,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
            ];

            $db->insert('student_login_sessions', $sessionData);

            // Log successful login
            Utilities::logAudit($db, 'LOGIN_SUCCESS', "Student login successful: {$student['student_id_number']}", 'student', $student['id'], $student['first_name'] . ' ' . $student['last_name'], 'students', $student['id']);

            ApiResponse::success([
                'token' => $token,
                'user_id' => $student['id'],
                'student_id' => $student['student_id_number'] ?: $student['admission_no'],
                'name' => $student['first_name'] . ' ' . $student['last_name'],
                'first_name' => $student['first_name'],
                'last_name' => $student['last_name'],
                'email' => $student['email'],
                'role' => 'student',
                'must_change_password' => $mustChange,
                'status' => $student['status'],
                'avatar_initials' => substr($student['first_name'], 0, 1) . substr($student['last_name'], 0, 1)
            ], 'Login successful', 200);

        } catch (Exception $e) {
            ApiResponse::error('Login failed: ' . $e->getMessage(), 500);
        }
    }
}

/**
 * Mandatory or voluntary password change (first login or profile reset)
 */
function handleChangePassword($db) {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $newPassword = $input['new_password'] ?? $input['password'] ?? null;
    $confirmPassword = $input['confirm_password'] ?? $newPassword;

    if (empty($newPassword) || strlen($newPassword) < 6) {
        ApiResponse::error('New password must be at least 6 characters long.', 422);
    }

    if ($newPassword !== $confirmPassword) {
        ApiResponse::error('New password and confirmation password do not match.', 422);
    }

    $token = $_GET['token'] ?? $input['token'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? null;
    if ($token) $token = str_replace('Bearer ', '', $token);

    if (!$token) {
        ApiResponse::error('Authentication session token is required to change password.', 401);
    }

    $hash = Utilities::hashPassword($newPassword);

    // Try finding staff session
    $staffSession = $db->fetch(
        "SELECT ls.*, s.id as staff_db_id, s.staff_id, s.first_name, s.last_name FROM login_sessions ls JOIN staff s ON ls.staff_id = s.id WHERE ls.session_token = ? AND ls.logout_time IS NULL LIMIT 1",
        [$token]
    );

    if ($staffSession) {
        $db->update('staff', [
            'password_hash' => $hash,
            'must_change_password' => 0
        ], ['id' => $staffSession['staff_db_id']]);

        Utilities::logAudit($db, 'CHANGE_PASSWORD', "Staff {$staffSession['staff_id']} successfully changed temporary password.", 'staff', $staffSession['staff_db_id'], $staffSession['first_name'] . ' ' . $staffSession['last_name'], 'staff', $staffSession['staff_db_id']);

        ApiResponse::success([
            'must_change_password' => false
        ], 'Password successfully updated! Your temporary password is no longer valid.');
    }

    // Try finding student session
    $studentSession = $db->fetch(
        "SELECT sls.*, s.id as student_db_id, s.student_id_number, s.first_name, s.last_name FROM student_login_sessions sls JOIN students s ON sls.student_id = s.id WHERE sls.session_token = ? AND sls.logout_time IS NULL LIMIT 1",
        [$token]
    );

    if ($studentSession) {
        $db->update('students', [
            'password_hash' => $hash,
            'must_change_password' => 0
        ], ['id' => $studentSession['student_db_id']]);

        Utilities::logAudit($db, 'CHANGE_PASSWORD', "Student {$studentSession['student_id_number']} successfully changed temporary password.", 'student', $studentSession['student_db_id'], $studentSession['first_name'] . ' ' . $studentSession['last_name'], 'students', $studentSession['student_db_id']);

        ApiResponse::success([
            'must_change_password' => false
        ], 'Password successfully updated! Your temporary password is no longer valid.');
    }

    ApiResponse::error('Session expired or invalid token.', 401);
}

/**
 * Handle Forgot Password recovery request
 */
function handleForgotPassword($db) {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $identifier = Utilities::sanitize($input['identifier'] ?? $input['email'] ?? '');

    if (empty($identifier)) {
        ApiResponse::error('Please enter your Staff ID, Student ID, or registered Email address.', 422);
    }

    // Look up staff
    $staff = $db->fetch(
        "SELECT id, staff_id, first_name, last_name, email, status FROM staff WHERE email = ? OR staff_id = ? OR username = ? LIMIT 1",
        [$identifier, $identifier, $identifier]
    );

    // Look up student
    $student = null;
    if (!$staff) {
        $student = $db->fetch(
            "SELECT id, student_id_number, admission_no, first_name, last_name, email, parent_email, status FROM students WHERE email = ? OR student_id_number = ? OR username = ? OR admission_no = ? LIMIT 1",
            [$identifier, $identifier, $identifier, $identifier]
        );
    }

    if (!$staff && !$student) {
        // Return a generic friendly response to avoid user enumeration while giving feedback
        ApiResponse::success([
            'sent' => true
        ], 'If an account matches the provided information, password recovery details have been processed.');
    }

    $token = Utilities::generateToken(16);
    $otpCode = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
    $expires = date('Y-m-d H:i:s', time() + 3600); // 1 hour expiry

    if ($staff) {
        if (in_array(strtolower($staff['status']), ['inactive', 'suspended'])) {
            ApiResponse::error('Account is inactive or suspended. Please contact the Principal.', 403);
        }

        try {
            $db->insert('password_resets', [
                'email_or_id' => $staff['email'] ?: $staff['staff_id'],
                'user_type'   => 'staff',
                'user_id'     => $staff['id'],
                'token'       => $token,
                'otp_code'    => $otpCode,
                'expires_at'  => $expires,
                'used'        => 0
            ]);
        } catch (Exception $e) {
            // Ignore if table not created
        }

        Utilities::logAudit($db, 'FORGOT_PASSWORD_REQUEST', "Forgot password request initiated for staff {$staff['staff_id']}", 'staff', $staff['id'], $staff['first_name'] . ' ' . $staff['last_name'], 'staff', $staff['id']);

        ApiResponse::success([
            'sent' => true,
            'user_type' => 'staff',
            'token' => $token,
            'otp_code' => $otpCode,
            'email' => $staff['email'] ? (substr($staff['email'], 0, 3) . '***@' . explode('@', $staff['email'])[1]) : 'registered email'
        ], 'Password recovery instructions have been initiated. You may use your OTP reset code or contact administration.');

    } else {
        if (in_array(strtolower($student['status']), ['inactive', 'suspended'])) {
            ApiResponse::error('Student account is inactive or suspended. Please contact administration.', 403);
        }

        try {
            $db->insert('password_resets', [
                'email_or_id' => $student['email'] ?: $student['student_id_number'],
                'user_type'   => 'student',
                'user_id'     => $student['id'],
                'token'       => $token,
                'otp_code'    => $otpCode,
                'expires_at'  => $expires,
                'used'        => 0
            ]);
        } catch (Exception $e) {
            // Ignore if table not created
        }

        Utilities::logAudit($db, 'FORGOT_PASSWORD_REQUEST', "Forgot password request initiated for student {$student['student_id_number']}", 'student', $student['id'], $student['first_name'] . ' ' . $student['last_name'], 'students', $student['id']);

        ApiResponse::success([
            'sent' => true,
            'user_type' => 'student',
            'token' => $token,
            'otp_code' => $otpCode,
            'email' => $student['email'] ? (substr($student['email'], 0, 3) . '***@' . explode('@', $student['email'])[1]) : 'registered email'
        ], 'Password recovery instructions have been initiated. You may use your OTP reset code or contact administration.');
    }
}

/**
 * Handle Reset Password via recovery token / OTP code
 */
function handleResetForgotPassword($db) {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $token = $input['token'] ?? null;
    $otpCode = $input['otp_code'] ?? null;
    $newPassword = $input['new_password'] ?? $input['password'] ?? null;

    if (empty($newPassword) || strlen($newPassword) < 6) {
        ApiResponse::error('Password must be at least 6 characters long.', 422);
    }

    $hash = Utilities::hashPassword($newPassword);

    $resetRecord = null;
    if ($token || $otpCode) {
        $resetRecord = $db->fetch(
            "SELECT * FROM password_resets WHERE (token = ? OR otp_code = ?) AND used = 0 AND expires_at > NOW() ORDER BY id DESC LIMIT 1",
            [$token ?: '', $otpCode ?: '']
        );
    }

    if ($resetRecord) {
        $table = ($resetRecord['user_type'] === 'student') ? 'students' : 'staff';
        $db->update($table, [
            'password_hash' => $hash,
            'must_change_password' => 0
        ], ['id' => $resetRecord['user_id']]);

        $db->update('password_resets', ['used' => 1], ['id' => $resetRecord['id']]);

        Utilities::logAudit($db, 'RESET_PASSWORD_RECOVERY', "Password successfully reset via recovery token for {$resetRecord['user_type']} ID {$resetRecord['user_id']}", $resetRecord['user_type'], $resetRecord['user_id'], 'User', $table, $resetRecord['user_id']);

        ApiResponse::success([], 'Password has been reset successfully! You can now log in with your new password.');
    }

    // Fallback: direct identifier reset if valid token/OTP is simulated in mock environment
    ApiResponse::error('Invalid or expired password reset token/code. Please request a new link or contact the Principal.', 400);
}

/**
 * Verify current session
 */
function verifySession($db) {
    $token = $_GET['token'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? null;

    if (!$token) {
        ApiResponse::error('Token required', 401);
    }

    // Remove 'Bearer ' prefix if present
    $token = str_replace('Bearer ', '', $token);

    // Find session in login_sessions (staff)
    $session = $db->fetch(
        "SELECT ls.*, s.id as staff_db_id, s.staff_id, s.first_name, s.last_name, s.role, s.unit_id 
         FROM login_sessions ls 
         JOIN staff s ON ls.staff_id = s.id 
         WHERE ls.session_token = ? AND ls.logout_time IS NULL 
         LIMIT 1",
        [$token]
    );

    if ($session) {
        // Check session expiry (24 hours)
        $loginTime = strtotime($session['login_time']);
        if (time() - $loginTime > 86400) {
            ApiResponse::error('Session expired', 401);
        }

        ApiResponse::success([
            'valid' => true,
            'staff_id' => $session['staff_id'],
            'name' => $session['first_name'] . ' ' . $session['last_name'],
            'role' => $session['role'],
            'unit_id' => $session['unit_id']
        ]);
    }

    // Try student sessions
    $studentSession = $db->fetch(
        "SELECT sls.*, s.id as student_db_id, s.student_id_number, s.first_name, s.last_name 
         FROM student_login_sessions sls 
         JOIN students s ON sls.student_id = s.id 
         WHERE sls.session_token = ? AND sls.logout_time IS NULL 
         LIMIT 1",
        [$token]
    );

    if (!$studentSession) {
        ApiResponse::error('Invalid or expired token', 401);
    }

    // Check session expiry (24 hours)
    $loginTime = strtotime($studentSession['login_time']);
    if (time() - $loginTime > 86400) {
        ApiResponse::error('Session expired', 401);
    }

    ApiResponse::success([
        'valid' => true,
        'student_id' => $studentSession['student_id_number'],
        'name' => $studentSession['first_name'] . ' ' . $studentSession['last_name'],
        'role' => 'student'
    ]);
}

/**
 * Get current user information
 */
function getUserInfo($db) {
    $token = $_GET['token'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? null;

    if (!$token) {
        ApiResponse::error('Token required', 401);
    }

    $token = str_replace('Bearer ', '', $token);

    // Try staff
    $user = $db->fetch(
        "SELECT s.*, ls.login_time 
         FROM staff s 
         JOIN login_sessions ls ON ls.staff_id = s.id 
         WHERE ls.session_token = ? AND ls.logout_time IS NULL 
         LIMIT 1",
        [$token]
    );

    if ($user) {
        // Get unit details if applicable
        $unit = null;
        if ($user['unit_id']) {
            $unit = $db->fetch("SELECT id, name, code FROM units WHERE id = ?", [$user['unit_id']]);
        }

        ApiResponse::success([
            'staff_id' => $user['staff_id'],
            'name' => $user['first_name'] . ' ' . $user['last_name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'role' => $user['role'],
            'unit' => $unit,
            'subject' => $user['subject'],
            'status' => $user['status'],
            'login_time' => $user['login_time']
        ]);
    }

    // Try student
    $student = $db->fetch(
        "SELECT s.*, sls.login_time 
         FROM students s 
         JOIN student_login_sessions sls ON sls.student_id = s.id 
         WHERE sls.session_token = ? AND sls.logout_time IS NULL 
         LIMIT 1",
        [$token]
    );

    if (!$student) {
        ApiResponse::error('User not found', 404);
    }

    ApiResponse::success([
        'student_id' => $student['student_id_number'],
        'name' => $student['first_name'] . ' ' . $student['last_name'],
        'email' => $student['email'],
        'phone' => $student['phone'],
        'role' => 'student',
        'status' => $student['status'],
        'login_time' => $student['login_time']
    ]);
}

/**
 * Handle logout
 */
function handleLogout($db) {
    $token = $_GET['token'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? null;

    if (!$token) {
        ApiResponse::error('Token required', 400);
    }

    $token = str_replace('Bearer ', '', $token);

    try {
        // Try staff session update
        $db->update(
            'login_sessions',
            ['logout_time' => date('Y-m-d H:i:s')],
            ['session_token' => $token]
        );

        // Try student session update
        $db->update(
            'student_login_sessions',
            ['logout_time' => date('Y-m-d H:i:s')],
            ['session_token' => $token]
        );

        // Get staff info for logging
        $session = $db->fetch("SELECT staff_id FROM login_sessions WHERE session_token = ?", [$token]);
        if ($session) {
            $staff = $db->fetch("SELECT staff_id FROM staff WHERE id = ?", [$session['staff_id']]);
            Utilities::logActivity("Logout: {$staff['staff_id']}", $session['staff_id'], $_SERVER['REMOTE_ADDR']);
        } else {
            $studentSession = $db->fetch("SELECT student_id FROM student_login_sessions WHERE session_token = ?", [$token]);
            if ($studentSession) {
                $student = $db->fetch("SELECT student_id_number FROM students WHERE id = ?", [$studentSession['student_id']]);
                Utilities::logActivity("Student Logout: {$student['student_id_number']}", null, $_SERVER['REMOTE_ADDR']);
            }
        }

        ApiResponse::success([], 'Logged out successfully');

    } catch (Exception $e) {
        ApiResponse::error('Logout failed: ' . $e->getMessage(), 500);
    }
}

/**
 * Middleware to verify token in requests
 */
function verifyToken($db, $token) {
    $session = $db->fetch(
        "SELECT * FROM login_sessions 
         WHERE session_token = ? AND logout_time IS NULL",
        [$token]
    );

    if ($session !== null) return true;

    $studentSession = $db->fetch(
        "SELECT * FROM student_login_sessions 
         WHERE session_token = ? AND logout_time IS NULL",
        [$token]
    );

    return $studentSession !== null;
}
