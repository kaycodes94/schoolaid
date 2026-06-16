<?php
/**
 * Plan Aid Academy - Finance API
 * Handles fee management, payment processing and financial reporting
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
            case 'payments':
                getPayments($db);
                break;
            case 'student':
                getStudentPayments($db);
                break;
            case 'outstanding':
                getOutstandingFees($db);
                break;
            case 'summary':
                getFinanceSummary($db);
                break;
            case 'report':
                generateFinanceReport($db);
                break;
            default:
                ApiResponse::error('Invalid action', 400);
        }
    } elseif ($method === 'POST') {
        recordPayment($db);
    } elseif ($method === 'PUT') {
        updatePayment($db);
    }
} catch (Exception $e) {
    ApiResponse::error('Server error: ' . $e->getMessage(), 500);
}

/**
 * Get all payments with filters
 */
function getPayments($db) {
    $limit = (int)($_GET['limit'] ?? 50);
    $offset = (int)($_GET['offset'] ?? 0);
    $session = $_GET['session'] ?? null;
    $term = $_GET['term'] ?? null;
    $status = $_GET['status'] ?? null;

    $query = "SELECT p.*, s.admission_no, s.first_name, s.last_name, c.name as class_name 
             FROM payments p 
             JOIN students s ON p.student_id = s.id 
             LEFT JOIN class_enrollment ce ON s.id = ce.student_id 
             LEFT JOIN classes c ON ce.class_id = c.id 
             WHERE 1=1";
    $params = [];

    if ($session) {
        $query .= " AND p.academic_session = ?";
        $params[] = $session;
    }

    if ($term) {
        $query .= " AND p.term = ?";
        $params[] = $term;
    }

    if ($status) {
        $query .= " AND p.status = ?";
        $params[] = $status;
    }

    $query .= " ORDER BY p.payment_date DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;

    $payments = $db->fetchAll($query, $params);

    // Get total count
    $countQuery = "SELECT COUNT(*) as total FROM payments WHERE 1=1";
    if ($session) {
        $countQuery .= " AND academic_session = ?";
    }
    if ($term) {
        $countQuery .= " AND term = ?";
    }
    if ($status) {
        $countQuery .= " AND status = ?";
    }

    $countParams = array_slice($params, 0, count($params) - 2);
    $countResult = $db->fetch($countQuery, $countParams);

    ApiResponse::success([
        'payments' => $payments,
        'total' => $countResult['total'] ?? 0,
        'limit' => $limit,
        'offset' => $offset
    ]);
}

/**
 * Get payments for specific student
 */
function getStudentPayments($db) {
    $admissionNo = $_GET['admission_no'] ?? $_GET['student_id'] ?? null;
    $session = $_GET['session'] ?? null;

    if (!$admissionNo) {
        ApiResponse::error('Student ID/admission number required', 400);
    }

    // Get student
    $student = $db->fetch(
        "SELECT id, admission_no, first_name, last_name FROM students WHERE admission_no = ? LIMIT 1",
        [$admissionNo]
    );

    if (!$student) {
        ApiResponse::error('Student not found', 404);
    }

    // Get payments
    $query = "SELECT * FROM payments WHERE student_id = ?";
    $params = [$student['id']];

    if ($session) {
        $query .= " AND academic_session = ?";
        $params[] = $session;
    }

    $query .= " ORDER BY payment_date DESC";
    $payments = $db->fetchAll($query, $params);

    // Calculate totals
    $totalPaid = 0;
    foreach ($payments as $payment) {
        if ($payment['status'] === 'confirmed') {
            $totalPaid += $payment['amount_paid'];
        }
    }

    ApiResponse::success([
        'student' => $student,
        'payments' => $payments,
        'total_paid' => $totalPaid
    ]);
}

/**
 * Get outstanding fees (defaulters)
 */
function getOutstandingFees($db) {
    $limit = (int)($_GET['limit'] ?? 100);
    $offset = (int)($_GET['offset'] ?? 0);
    $session = $_GET['session'] ?? date('Y') . '/' . (date('Y') + 1);

    // This is a simplified calculation
    // In real scenario, you'd need to calculate total fees per student per session
    // and compare with payments made

    $query = "SELECT s.id, s.admission_no, s.first_name, s.last_name, c.name as class_name, 
             COALESCE(SUM(CASE WHEN p.status = 'confirmed' THEN p.amount_paid ELSE 0 END), 0) as total_paid,
             0 as total_expected
             FROM students s 
             LEFT JOIN class_enrollment ce ON s.id = ce.student_id 
             LEFT JOIN classes c ON ce.class_id = c.id 
             LEFT JOIN payments p ON s.id = p.student_id AND p.academic_session = ?
             WHERE s.status = 'active' AND ce.academic_session = ?
             GROUP BY s.id
             HAVING total_paid < total_expected OR total_expected = 0
             ORDER BY s.last_name ASC
             LIMIT ? OFFSET ?";

    $params = [$session, $session, $limit, $offset];
    $defaulters = $db->fetchAll($query, $params);

    ApiResponse::success([
        'session' => $session,
        'defaulters' => $defaulters,
        'count' => count($defaulters),
        'limit' => $limit,
        'offset' => $offset
    ]);
}

/**
 * Record a payment
 */
function recordPayment($db) {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

    // Validate
    $validator = new Validator();
    if (!$validator->validatePayment($input)) {
        ApiResponse::error('Validation failed', 422, $validator->getErrors());
    }

    try {
        $db->beginTransaction();

        // Generate receipt number
        $receiptNo = Utilities::generateReceiptNo();

        // Ensure receipt is unique
        while ($db->fetch("SELECT id FROM payments WHERE receipt_no = ?", [$receiptNo])) {
            $receiptNo = Utilities::generateReceiptNo();
        }

        $paymentData = [
            'receipt_no' => $receiptNo,
            'student_id' => $input['student_id'],
            'amount_paid' => floatval($input['amount_paid']),
            'payment_date' => $input['payment_date'],
            'academic_session' => $input['academic_session'] ?? date('Y') . '/' . (date('Y') + 1),
            'term' => $input['term'] ?? '1st',
            'payment_method' => $input['payment_method'] ?? 'cash',
            'reference' => $input['reference'] ?? null,
            'recorded_by' => $input['staff_id'] ?? null,
            'status' => $input['status'] ?? 'confirmed',
            'remarks' => $input['remarks'] ?? null
        ];

        $paymentId = $db->insert('payments', $paymentData);

        Utilities::logActivity(
            "Payment recorded: Receipt {$receiptNo} - Student {$input['student_id']} - Amount: {$paymentData['amount_paid']}",
            $input['staff_id'] ?? null,
            $_SERVER['REMOTE_ADDR'] ?? 'Unknown'
        );

        $db->commit();

        ApiResponse::success([
            'payment_id' => $paymentId,
            'receipt_no' => $receiptNo,
            'amount_paid' => $paymentData['amount_paid'],
            'payment_date' => $paymentData['payment_date'],
            'status' => $paymentData['status']
        ], 'Payment recorded successfully', 201);

    } catch (Exception $e) {
        $db->rollBack();
        ApiResponse::error('Payment recording failed: ' . $e->getMessage(), 500);
    }
}

/**
 * Update payment status
 */
function updatePayment($db) {
    $input = json_decode(file_get_contents('php://input'), true);
    $paymentId = $_GET['id'] ?? null;

    if (!$paymentId) {
        ApiResponse::error('Payment ID required', 400);
    }

    try {
        $updateData = [];

        if (isset($input['status'])) {
            $updateData['status'] = $input['status'];
        }
        if (isset($input['remarks'])) {
            $updateData['remarks'] = $input['remarks'];
        }

        if (empty($updateData)) {
            ApiResponse::error('No fields to update', 400);
        }

        $db->update('payments', $updateData, ['id' => $paymentId]);

        ApiResponse::success([], 'Payment updated successfully');

    } catch (Exception $e) {
        ApiResponse::error('Update failed: ' . $e->getMessage(), 500);
    }
}

/**
 * Get finance summary
 */
function getFinanceSummary($db) {
    $session = $_GET['session'] ?? date('Y') . '/' . (date('Y') + 1);

    // Total revenue
    $totalRevenue = $db->fetch(
        "SELECT COALESCE(SUM(amount_paid), 0) as total FROM payments 
         WHERE academic_session = ? AND status = 'confirmed'",
        [$session]
    );

    // Revenue by unit
    $revenueByUnit = $db->fetchAll(
        "SELECT u.name, COALESCE(SUM(p.amount_paid), 0) as total FROM payments p 
         JOIN students s ON p.student_id = s.id 
         JOIN units u ON s.unit_id = u.id 
         WHERE p.academic_session = ? AND p.status = 'confirmed'
         GROUP BY u.id, u.name",
        [$session]
    );

    // Revenue by term
    $RevenueByTerm = $db->fetchAll(
        "SELECT term, COALESCE(SUM(amount_paid), 0) as total FROM payments 
         WHERE academic_session = ? AND status = 'confirmed'
         GROUP BY term",
        [$session]
    );

    // Outstanding fees
    $outstanding = $db->fetch(
        "SELECT COALESCE(COUNT(DISTINCT student_id), 0) as student_count FROM students 
         WHERE status = 'active'",
        []
    );

    ApiResponse::success([
        'academic_session' => $session,
        'total_revenue' => $totalRevenue['total'] ?? 0,
        'revenue_by_unit' => $revenueByUnit,
        'revenue_by_term' => $RevenueByTerm,
        'active_students' => $outstanding['student_count'] ?? 0,
        'currency' => '₦'
    ]);
}

/**
 * Generate comprehensive finance report
 */
function generateFinanceReport($db) {
    $session = $_GET['session'] ?? date('Y') . '/' . (date('Y') + 1);
    $format = $_GET['format'] ?? 'json'; // json, csv, pdf

    $summary = getFinanceSummary($db);
    
    ApiResponse::success([
        'report_title' => 'Finance Report - ' . $session,
        'report_date' => date('Y-m-d'),
        'summary' => $summary
    ]);
}
