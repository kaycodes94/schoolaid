<?php
/**
 * Plan Aid Academy - System Initial Setup API
 * Secure initialization of the Principal (Super Admin) account and core defaults.
 */

session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit(); }

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../includes/Helpers.php';

try {
    $db = new Database();
} catch (Exception $e) {
    ApiResponse::error('Database connection failed: ' . $e->getMessage(), 500);
}

// Check if setup parameter or action is passed
$action = $_GET['action'] ?? $_POST['action'] ?? 'status';

if ($action === 'status') {
    // Check if Principal exists
    $principal = $db->fetch("SELECT id, staff_id, first_name, last_name, email, status FROM staff WHERE role = 'principal' LIMIT 1");
    ApiResponse::success([
        'setup_complete' => !empty($principal),
        'principal' => $principal ? [
            'staff_id' => $principal['staff_id'],
            'name' => $principal['first_name'] . ' ' . $principal['last_name'],
            'email' => $principal['email'],
            'status' => $principal['status']
        ] : null
    ], 'System setup status');
}

if ($action === 'init') {
    // Check if principal already exists
    $existing = $db->fetch("SELECT id FROM staff WHERE role = 'principal' LIMIT 1");
    
    if ($existing) {
        ApiResponse::error('Principal account already exists. Secure initial setup has already been completed.', 400);
    }

    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    
    $firstName = Utilities::sanitize($input['first_name'] ?? 'Plan Aid');
    $lastName  = Utilities::sanitize($input['last_name'] ?? 'Principal');
    $email     = strtolower(trim($input['email'] ?? 'principal@paa.edu.ng'));
    $phone     = Utilities::sanitize($input['phone'] ?? '+2348030459595');
    $password  = $input['password'] ?? '123456';

    if (strlen($password) < 6) {
        ApiResponse::error('Password must be at least 6 characters.', 422);
    }

    $staffId = 'PAA-ST-001';
    $passwordHash = Utilities::hashPassword($password);

    try {
        $db->insert('staff', [
            'staff_id' => $staffId,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'password_hash' => $passwordHash,
            'role' => 'principal',
            'hire_date' => date('Y-m-d'),
            'portal_access_status' => 'approved',
            'status' => 'active'
        ]);

        Utilities::logActivity("Initial setup completed. Principal account created: {$staffId}", null, $_SERVER['REMOTE_ADDR']);

        ApiResponse::success([
            'staff_id' => $staffId,
            'email' => $email,
            'role' => 'principal',
            'message' => 'Principal account successfully created via secure initial setup.'
        ], 'Initial setup successful', 201);
    } catch (Exception $e) {
        ApiResponse::error('Setup failed: ' . $e->getMessage(), 500);
    }
}
