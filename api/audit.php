<?php
/**
 * Plan Aid Academy - Audit Logs API
 * Retrieves administrative and security audit trail records for Principal review.
 */

session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit(); }

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../includes/Helpers.php';

$db = null;
try {
    $db = new Database();
} catch (Exception $e) {
    ApiResponse::error('Database connection failed', 500);
}

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

// Enforce Principal/Admin access
if ($currentUser && !in_array($currentUser['role'], ['principal', 'admin'])) {
    ApiResponse::error('Access Denied: Principal access required to view system audit logs.', 403);
}

$limit  = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 50;
$offset = isset($_GET['offset']) ? max(0, (int)$_GET['offset']) : 0;
$actionFilter = $_GET['action_filter'] ?? null;
$search = $_GET['search'] ?? null;

try {
    $where = [];
    $params = [];

    if ($actionFilter) {
        $where[] = "action = ?";
        $params[] = strtoupper($actionFilter);
    }

    if ($search) {
        $where[] = "(actor_name LIKE ? OR description LIKE ? OR ip_address LIKE ?)";
        $searchTerm = '%' . $search . '%';
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
    }

    $whereClause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

    $countRow = $db->fetch("SELECT COUNT(*) as total FROM audit_logs {$whereClause}", $params);
    $total = $countRow['total'] ?? 0;

    $query = "SELECT id, actor_type, actor_id, actor_name, action, resource_type, resource_id, description, ip_address, user_agent, created_at FROM audit_logs {$whereClause} ORDER BY id DESC LIMIT {$limit} OFFSET {$offset}";
    $logs = $db->fetchAll($query, $params);

    ApiResponse::success([
        'data' => $logs,
        'total' => $total,
        'limit' => $limit,
        'offset' => $offset
    ], 'Audit logs fetched successfully');

} catch (Exception $e) {
    ApiResponse::error('Failed to retrieve audit logs: ' . $e->getMessage(), 500);
}
