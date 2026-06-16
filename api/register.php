<?php
/**
 * School Aid Management System
 * Registration API — Teacher & Student public self-registration
 * POST /api/register.php?type=teacher|student
 */

session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit(); }

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../includes/Helpers.php';

$db = null;
try { $db = new Database(); } catch (Exception $e) {
    ApiResponse::error('Database connection failed', 500);
}

$type = $_GET['type'] ?? '';
if (!in_array($type, ['teacher', 'student'])) {
    ApiResponse::error('Invalid registration type. Use ?type=teacher or ?type=student', 400);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ApiResponse::error('POST method required', 405);
}

// Check if registration is open
$regKey = ($type === 'teacher') ? 'teacher_registration_open' : 'student_registration_open';
$setting = $db->fetch("SELECT setting_value FROM school_settings WHERE setting_key = ?", [$regKey]);
if ($setting && $setting['setting_value'] === '0') {
    ApiResponse::error('Registration is currently closed. Please contact the school.', 403);
}

// Parse multipart or JSON input
$input = [];
if (!empty($_POST)) {
    $input = $_POST;
} else {
    $body = file_get_contents('php://input');
    $input = json_decode($body, true) ?? [];
}

try {
    if ($type === 'teacher') {
        handleTeacherRegistration($db, $input);
    } else {
        handleStudentRegistration($db, $input);
    }
} catch (Exception $e) {
    ApiResponse::error('Registration failed: ' . $e->getMessage(), 500);
}

// -------------------------------------------------------
// Teacher Registration
// -------------------------------------------------------
function handleTeacherRegistration($db, $input) {
    $required = ['full_name','email','phone','date_of_birth','qualification','password'];
    $missing = ApiResponse::validateRequired($input, $required);
    if (!empty($missing)) {
        ApiResponse::error('Missing required fields: ' . implode(', ', $missing), 422);
    }

    if (!Utilities::validateEmail($input['email'])) {
        ApiResponse::error('Invalid email address', 422);
    }

    // Check duplicate email
    $existing = $db->fetch("SELECT id FROM teacher_registrations WHERE email = ? AND deleted_at IS NULL", [strtolower(trim($input['email']))]);
    if ($existing) {
        ApiResponse::error('An application with this email already exists.', 409);
    }
    $existingStaff = $db->fetch("SELECT id FROM staff WHERE email = ?", [strtolower(trim($input['email']))]);
    if ($existingStaff) {
        ApiResponse::error('An account with this email already exists.', 409);
    }

    if (strlen($input['password']) < 8) {
        ApiResponse::error('Password must be at least 8 characters', 422);
    }

    // Handle photo upload
    $photoPath = null;
    if (!empty($_FILES['passport_photo']) && $_FILES['passport_photo']['error'] === UPLOAD_ERR_OK) {
        $photoPath = handlePhotoUpload($_FILES['passport_photo']);
    }

    $data = [
        'full_name'       => Utilities::sanitize($input['full_name']),
        'email'           => strtolower(trim($input['email'])),
        'phone'           => Utilities::sanitize($input['phone']),
        'date_of_birth'   => $input['date_of_birth'],
        'qualification'   => Utilities::sanitize($input['qualification']),
        'department_id'   => !empty($input['department_id']) ? (int)$input['department_id'] : null,
        'department_name' => !empty($input['department_name']) ? Utilities::sanitize($input['department_name']) : null,
        'passport_photo'  => $photoPath,
        'password_hash'   => Utilities::hashPassword($input['password']),
        'status'          => 'pending',
    ];

    $id = $db->insert('teacher_registrations', $data);

    // Audit log
    auditLog($db, 'system', null, 'System', 'TEACHER_REGISTRATION', 'teacher_registrations', $id,
        "New teacher registration: {$data['full_name']} ({$data['email']})", $_SERVER['REMOTE_ADDR'] ?? null);

    ApiResponse::success([
        'registration_id' => $id,
        'status'          => 'pending',
        'message'         => 'Your application has been submitted and is awaiting approval from the Head Unit.'
    ], 'Registration submitted successfully', 201);
}

// -------------------------------------------------------
// Student Registration
// -------------------------------------------------------
function handleStudentRegistration($db, $input) {
    $required = ['full_name','email','phone','date_of_birth','class_name','password'];
    $missing = ApiResponse::validateRequired($input, $required);
    if (!empty($missing)) {
        ApiResponse::error('Missing required fields: ' . implode(', ', $missing), 422);
    }

    if (!Utilities::validateEmail($input['email'])) {
        ApiResponse::error('Invalid email address', 422);
    }

    $existing = $db->fetch("SELECT id FROM student_registrations WHERE email = ? AND deleted_at IS NULL", [strtolower(trim($input['email']))]);
    if ($existing) {
        ApiResponse::error('An application with this email already exists.', 409);
    }
    $existingStd = $db->fetch("SELECT id FROM students WHERE parent_email = ?", [strtolower(trim($input['email']))]);
    if ($existingStd) {
        ApiResponse::error('An account with this email already exists.', 409);
    }

    if (strlen($input['password']) < 8) {
        ApiResponse::error('Password must be at least 8 characters', 422);
    }

    $photoPath = null;
    if (!empty($_FILES['passport_photo']) && $_FILES['passport_photo']['error'] === UPLOAD_ERR_OK) {
        $photoPath = handlePhotoUpload($_FILES['passport_photo']);
    }

    $data = [
        'full_name'       => Utilities::sanitize($input['full_name']),
        'email'           => strtolower(trim($input['email'])),
        'phone'           => Utilities::sanitize($input['phone']),
        'date_of_birth'   => $input['date_of_birth'],
        'class_name'      => Utilities::sanitize($input['class_name']),
        'department_id'   => !empty($input['department_id']) ? (int)$input['department_id'] : null,
        'department_name' => !empty($input['department_name']) ? Utilities::sanitize($input['department_name']) : null,
        'passport_photo'  => $photoPath,
        'password_hash'   => Utilities::hashPassword($input['password']),
        'status'          => 'pending',
    ];

    $id = $db->insert('student_registrations', $data);

    auditLog($db, 'system', null, 'System', 'STUDENT_REGISTRATION', 'student_registrations', $id,
        "New student registration: {$data['full_name']} ({$data['email']})", $_SERVER['REMOTE_ADDR'] ?? null);

    ApiResponse::success([
        'registration_id' => $id,
        'status'          => 'pending',
        'message'         => 'Your application has been submitted and is awaiting approval from the Principal.'
    ], 'Registration submitted successfully', 201);
}

// -------------------------------------------------------
// Photo Upload Handler
// -------------------------------------------------------
function handlePhotoUpload($file) {
    $uploadDir = __DIR__ . '/../uploads/passports/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mimeType, $allowedTypes)) {
        ApiResponse::error('Invalid file type. Only JPG, PNG, WEBP allowed.', 422);
    }

    if ($file['size'] > 2 * 1024 * 1024) { // 2MB max
        ApiResponse::error('File too large. Maximum 2MB allowed.', 422);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = 'photo_' . uniqid() . '_' . time() . '.' . strtolower($ext);
    $destination = $uploadDir . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        ApiResponse::error('Failed to save uploaded photo.', 500);
    }

    return 'uploads/passports/' . $filename;
}

// -------------------------------------------------------
// Audit helper (local)
// -------------------------------------------------------
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
