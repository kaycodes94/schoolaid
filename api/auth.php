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
        handleLogin($db);
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
 * Handle staff login
 */
function handleLogin($db) {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

    // Validate required fields
    $validator = new Validator();
    if (!$validator->validateLogin($input)) {
        ApiResponse::error('Validation failed', 422, $validator->getErrors());
    }

    $staffId = Utilities::sanitize($input['staff_id']);
    $password = $input['password'];

    // Fetch staff member by staff ID or email
    $staff = $db->fetch(
        "SELECT * FROM staff WHERE staff_id = ? OR email = ? LIMIT 1",
        [$staffId, $staffId]
    );

    $student = null;
    if (!$staff) {
        // Try fetching student by student_id_number, username or email
        $student = $db->fetch(
            "SELECT * FROM students WHERE student_id_number = ? OR username = ? OR email = ? LIMIT 1",
            [$staffId, $staffId, $staffId]
        );
    }

    if (!$staff && !$student) {
        // Log failed attempt
        Utilities::logActivity("Failed login attempt: {$staffId}", null, $_SERVER['REMOTE_ADDR']);
        ApiResponse::error('Invalid credentials', 401);
    }

    if ($staff) {
        // Verify password
        if (!Utilities::verifyPassword($password, $staff['password_hash'])) {
            Utilities::logActivity("Failed login attempt for {$staff['staff_id']}", $staff['id'], $_SERVER['REMOTE_ADDR']);
            ApiResponse::error('Invalid credentials', 401);
        }

        // Check if staff is active
        if ($staff['status'] !== 'active') {
            ApiResponse::error('Account is inactive. Please contact the principal.', 403);
        }

        // Generate session token
        $token = Utilities::generateToken();

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
            Utilities::logActivity("Login successful: {$staff['staff_id']}", $staff['id'], $_SERVER['REMOTE_ADDR']);

            // Get unit information if user is unit head
            $unit = null;
            if ($staff['unit_id']) {
                $unit = $db->fetch("SELECT id, name, code FROM units WHERE id = ?", [$staff['unit_id']]);
            }

            ApiResponse::success([
                'token' => $token,
                'staff_id' => $staff['staff_id'],
                'name' => $staff['first_name'] . ' ' . $staff['last_name'],
                'email' => $staff['email'],
                'role' => $staff['role'],
                'unit' => $unit,
                'avatar_initials' => substr($staff['first_name'], 0, 1) . substr($staff['last_name'], 0, 1)
            ], 'Login successful', 200);

        } catch (Exception $e) {
            ApiResponse::error('Login failed: ' . $e->getMessage(), 500);
        }
    } else {
        // Verify student password
        if (!Utilities::verifyPassword($password, $student['password_hash'])) {
            Utilities::logActivity("Failed student login attempt for {$student['student_id_number']}", null, $_SERVER['REMOTE_ADDR']);
            ApiResponse::error('Invalid credentials', 401);
        }

        // Check if student is active
        if ($student['status'] !== 'active') {
            ApiResponse::error('Student account is inactive. Please contact administration.', 403);
        }

        // Generate session token
        $token = Utilities::generateToken();

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
            Utilities::logActivity("Student login successful: {$student['student_id_number']}", null, $_SERVER['REMOTE_ADDR']);

            ApiResponse::success([
                'token' => $token,
                'student_id' => $student['student_id_number'],
                'name' => $student['first_name'] . ' ' . $student['last_name'],
                'email' => $student['email'],
                'role' => 'student',
                'avatar_initials' => substr($student['first_name'], 0, 1) . substr($student['last_name'], 0, 1)
            ], 'Login successful', 200);

        } catch (Exception $e) {
            ApiResponse::error('Login failed: ' . $e->getMessage(), 500);
        }
    }
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
