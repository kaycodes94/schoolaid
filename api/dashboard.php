<?php
/**
 * School Aid Management System
 * Dashboard Stats API
 * GET /api/dashboard.php?role=principal|unit_head|teacher|student
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
try { $db = new Database(); } catch (Exception $e) { ApiResponse::error('DB error', 500); }

$token = getBearerToken();
if (!$token) ApiResponse::error('Authentication required', 401);
$staff = getAuthStaff($db, $token);
// Also allow student token
$student = null;
if (!$staff) {
    $student = getAuthStudent($db, $token);
    if (!$student) ApiResponse::error('Invalid session', 401);
}

try {
    $role = $staff ? $staff['role'] : 'student';
    switch ($role) {
        case 'principal': case 'admin': principalStats($db); break;
        case 'unit_head':  headUnitStats($db, $staff);       break;
        case 'teacher':    teacherStats($db, $staff);        break;
        case 'student':    studentStats($db, $student);      break;
        default: ApiResponse::error('Unknown role', 400);
    }
} catch (Exception $e) {
    ApiResponse::error('Error: ' . $e->getMessage(), 500);
}

// -------------------------------------------------------
// PRINCIPAL STATS
// -------------------------------------------------------
function principalStats($db) {
    $session = getCurrentSession($db);

    $totalStudents   = $db->fetch("SELECT COUNT(*) as c FROM students WHERE deleted_at IS NULL")['c'];
    $activeStudents  = $db->fetch("SELECT COUNT(*) as c FROM students WHERE status='active' AND deleted_at IS NULL")['c'];
    $pendingStudents = $db->fetch("SELECT COUNT(*) as c FROM student_registrations WHERE status='pending' AND deleted_at IS NULL")['c'];
    $totalTeachers   = $db->fetch("SELECT COUNT(*) as c FROM staff WHERE role='teacher' AND deleted_at IS NULL")['c'];
    $activeTeachers  = $db->fetch("SELECT COUNT(*) as c FROM staff WHERE role='teacher' AND status='active' AND deleted_at IS NULL")['c'];
    $pendingTeachers = $db->fetch("SELECT COUNT(*) as c FROM teacher_registrations WHERE status='pending' AND deleted_at IS NULL")['c'];
    $totalDepts      = $db->fetch("SELECT COUNT(*) as c FROM departments WHERE is_active=1 AND deleted_at IS NULL")['c'];
    $totalClasses    = $db->fetch("SELECT COUNT(*) as c FROM classes")['c'];

    // Attendance today
    $today = date('Y-m-d');
    $presentToday = $db->fetch("SELECT COUNT(*) as c FROM attendance WHERE attendance_date = ? AND status='present'", [$today])['c'];
    $absentToday  = $db->fetch("SELECT COUNT(*) as c FROM attendance WHERE attendance_date = ? AND status='absent'", [$today])['c'];

    // Recent registrations (last 7 days)
    $recentStudReg = $db->fetchAll(
        "SELECT full_name, email, class_name, created_at FROM student_registrations WHERE status='pending' AND deleted_at IS NULL ORDER BY created_at DESC LIMIT 5"
    );
    $recentTeachReg = $db->fetchAll(
        "SELECT full_name, email, qualification, created_at FROM teacher_registrations WHERE status='pending' AND deleted_at IS NULL ORDER BY created_at DESC LIMIT 5"
    );

    // Monthly enrollment trend (last 6 months)
    $enrollmentTrend = $db->fetchAll("
        SELECT DATE_FORMAT(created_at,'%Y-%m') as month, COUNT(*) as count
        FROM student_registrations
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
        GROUP BY month ORDER BY month ASC
    ");

    // Recent announcements
    $announcements = $db->fetchAll("
        SELECT a.title, a.created_at, CONCAT(s.first_name,' ',s.last_name) as author
        FROM announcements a JOIN staff s ON a.posted_by = s.id
        WHERE a.deleted_at IS NULL
        ORDER BY a.created_at DESC LIMIT 5
    ");

    ApiResponse::success([
        'stats' => [
            'total_students'   => (int)$totalStudents,
            'active_students'  => (int)$activeStudents,
            'pending_students' => (int)$pendingStudents,
            'total_teachers'   => (int)$totalTeachers,
            'active_teachers'  => (int)$activeTeachers,
            'pending_teachers' => (int)$pendingTeachers,
            'departments'      => (int)$totalDepts,
            'classes'          => (int)$totalClasses,
            'present_today'    => (int)$presentToday,
            'absent_today'     => (int)$absentToday,
        ],
        'recent_student_registrations' => $recentStudReg,
        'recent_teacher_registrations' => $recentTeachReg,
        'enrollment_trend'             => $enrollmentTrend,
        'recent_announcements'         => $announcements,
        'current_session'              => $session,
    ]);
}

// -------------------------------------------------------
// HEAD UNIT STATS
// -------------------------------------------------------
function headUnitStats($db, $staff) {
    $totalTeachers   = $db->fetch("SELECT COUNT(*) as c FROM staff WHERE role='teacher' AND deleted_at IS NULL")['c'];
    $activeTeachers  = $db->fetch("SELECT COUNT(*) as c FROM staff WHERE role='teacher' AND status='active' AND deleted_at IS NULL")['c'];
    $pendingTeachers = $db->fetch("SELECT COUNT(*) as c FROM teacher_registrations WHERE status='pending' AND deleted_at IS NULL")['c'];
    $totalDepts      = $db->fetch("SELECT COUNT(*) as c FROM departments WHERE is_active=1 AND deleted_at IS NULL")['c'];

    $recentTeachReg = $db->fetchAll(
        "SELECT id, full_name, email, qualification, department_name, created_at FROM teacher_registrations WHERE status='pending' AND deleted_at IS NULL ORDER BY created_at DESC LIMIT 10"
    );

    $approvalHistory = $db->fetchAll("
        SELECT a.applicant_type, a.approval_status, a.approval_date,
               CONCAT(s.first_name,' ',s.last_name) as approver_name
        FROM approvals a JOIN staff s ON a.approver_id = s.id
        ORDER BY a.created_at DESC LIMIT 10
    ");

    // Teacher by dept
    $teachersByDept = $db->fetchAll("
        SELECT d.name as dept, COUNT(st.id) as count
        FROM departments d
        LEFT JOIN staff st ON st.department_id = d.id AND st.role='teacher' AND st.deleted_at IS NULL
        WHERE d.is_active=1
        GROUP BY d.id
    ");

    ApiResponse::success([
        'stats' => [
            'total_teachers'   => (int)$totalTeachers,
            'active_teachers'  => (int)$activeTeachers,
            'pending_teachers' => (int)$pendingTeachers,
            'departments'      => (int)$totalDepts,
        ],
        'pending_teacher_applications' => $recentTeachReg,
        'recent_approval_history'      => $approvalHistory,
        'teachers_by_department'       => $teachersByDept,
    ]);
}

// -------------------------------------------------------
// TEACHER STATS
// -------------------------------------------------------
function teacherStats($db, $staff) {
    $session = getCurrentSession($db);

    // Classes assigned to this teacher
    $myClasses = $db->fetchAll("SELECT id, name FROM classes WHERE teacher_id = ?", [$staff['id']]);
    $classIds  = array_column($myClasses, 'id');
    $totalStudentsInClasses = 0;

    if (!empty($classIds)) {
        $inClause = implode(',', array_fill(0, count($classIds), '?'));
        $row = $db->fetch("SELECT COUNT(DISTINCT student_id) as c FROM class_enrollment WHERE class_id IN ($inClause)", $classIds);
        $totalStudentsInClasses = (int)($row['c'] ?? 0);
    }

    // Pending assignment grading
    $pendingGrading = $db->fetch("
        SELECT COUNT(*) as c FROM assignment_submissions asub
        JOIN assignments asn ON asub.assignment_id = asn.id
        WHERE asn.teacher_id = ? AND asub.status='submitted'
    ", [$staff['id']])['c'];

    // Assignments created
    $totalAssignments = $db->fetch("SELECT COUNT(*) as c FROM assignments WHERE teacher_id = ? AND deleted_at IS NULL", [$staff['id']])['c'];

    // Today's attendance marked
    $today = date('Y-m-d');
    $markedToday = $db->fetch("SELECT COUNT(*) as c FROM attendance WHERE marked_by = ? AND attendance_date = ?", [$staff['id'], $today])['c'];

    // Unread messages
    $unreadMessages = $db->fetch("SELECT COUNT(*) as c FROM messages WHERE recipient_staff_id = ? AND is_read = 0 AND deleted_at IS NULL", [$staff['id']])['c'];

    // Recent results entered
    $recentResults = $db->fetchAll("
        SELECT r.*, st.first_name, st.last_name, sub.name as subject_name
        FROM results r
        JOIN students st ON r.student_id = st.id
        JOIN subjects sub ON r.subject_id = sub.id
        WHERE r.entered_by = ?
        ORDER BY r.entered_at DESC LIMIT 5
    ", [$staff['id']]);

    ApiResponse::success([
        'stats' => [
            'my_classes'            => count($myClasses),
            'total_students'        => $totalStudentsInClasses,
            'total_assignments'     => (int)$totalAssignments,
            'pending_grading'       => (int)$pendingGrading,
            'attendance_marked_today'=> (int)$markedToday,
            'unread_messages'       => (int)$unreadMessages,
        ],
        'my_classes'          => $myClasses,
        'recent_results'      => $recentResults,
        'current_session'     => $session,
    ]);
}

// -------------------------------------------------------
// STUDENT STATS
// -------------------------------------------------------
function studentStats($db, $student) {
    $session = getCurrentSession($db);

    // Attendance percentage
    $totalDays    = $db->fetch("SELECT COUNT(*) as c FROM attendance WHERE student_id = ?", [$student['id']])['c'];
    $presentDays  = $db->fetch("SELECT COUNT(*) as c FROM attendance WHERE student_id = ? AND status='present'", [$student['id']])['c'];
    $attendancePct = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 0;

    // Results summary latest term
    $results = $db->fetchAll("
        SELECT r.total_score, r.grade, sub.name as subject_name
        FROM results r JOIN subjects sub ON r.subject_id = sub.id
        WHERE r.student_id = ?
        ORDER BY r.entered_at DESC LIMIT 10
    ", [$student['id']]);

    $avgScore = 0;
    if (!empty($results)) {
        $avgScore = round(array_sum(array_column($results, 'total_score')) / count($results), 1);
    }

    // Pending assignments
    $pendingAssignments = $db->fetchAll("
        SELECT asn.id, asn.title, asn.due_date, sub.name as subject
        FROM assignments asn
        JOIN subjects sub ON asn.subject_id = sub.id
        LEFT JOIN assignment_submissions asub ON asub.assignment_id = asn.id AND asub.student_id = ?
        JOIN class_enrollment ce ON ce.class_id = asn.class_id AND ce.student_id = ?
        WHERE asub.id IS NULL AND asn.due_date >= CURDATE() AND asn.deleted_at IS NULL
        ORDER BY asn.due_date ASC LIMIT 5
    ", [$student['id'], $student['id']]);

    // Unread notifications
    $unreadNotifs = $db->fetch("SELECT COUNT(*) as c FROM notifications WHERE recipient_student_id = ? AND is_read = 0", [$student['id']])['c'];

    // Unread messages
    $unreadMessages = $db->fetch("SELECT COUNT(*) as c FROM messages WHERE recipient_student_id = ? AND is_read = 0 AND deleted_at IS NULL", [$student['id']])['c'];

    // Recent announcements
    $announcements = $db->fetchAll("
        SELECT a.title, a.body, a.created_at
        FROM announcements a
        WHERE a.deleted_at IS NULL AND (a.target_role = 'all' OR a.target_role = 'student')
        ORDER BY a.is_pinned DESC, a.created_at DESC LIMIT 5
    ");

    ApiResponse::success([
        'stats' => [
            'attendance_pct'     => $attendancePct,
            'present_days'       => (int)$presentDays,
            'total_days'         => (int)$totalDays,
            'average_score'      => $avgScore,
            'unread_notifications'=> (int)$unreadNotifs,
            'unread_messages'    => (int)$unreadMessages,
            'pending_assignments'=> count($pendingAssignments),
        ],
        'recent_results'         => $results,
        'pending_assignments'    => $pendingAssignments,
        'recent_announcements'   => $announcements,
        'current_session'        => $session,
    ]);
}

// -------------------------------------------------------
// Helpers
// -------------------------------------------------------
function getCurrentSession($db) {
    $row = $db->fetch("SELECT setting_value FROM school_settings WHERE setting_key = 'current_academic_session'");
    $term = $db->fetch("SELECT setting_value FROM school_settings WHERE setting_key = 'current_term'");
    return [
        'session' => $row['setting_value'] ?? '2025/2026',
        'term'    => $term['setting_value'] ?? '1st',
    ];
}

function getBearerToken() {
    $headers = getallheaders();
    $auth = $headers['Authorization'] ?? $headers['authorization'] ?? ($_GET['token'] ?? '');
    return str_replace('Bearer ', '', $auth) ?: null;
}

function getAuthStaff($db, $token) {
    $session = $db->fetch(
        "SELECT ls.*, s.id, s.staff_id, s.first_name, s.last_name, s.role, s.unit_id, s.status
         FROM login_sessions ls JOIN staff s ON ls.staff_id = s.id
         WHERE ls.session_token = ? AND ls.logout_time IS NULL LIMIT 1",
        [$token]
    );
    if (!$session) return null;
    if (time() - strtotime($session['login_time']) > 86400) return null;
    return $session;
}

function getAuthStudent($db, $token) {
    $session = $db->fetch(
        "SELECT sls.*, s.id, s.student_id_number, s.first_name, s.last_name, s.status
         FROM student_login_sessions sls JOIN students s ON sls.student_id = s.id
         WHERE sls.session_token = ? AND sls.logout_time IS NULL LIMIT 1",
        [$token]
    );
    if (!$session) return null;
    if (time() - strtotime($session['login_time']) > 86400) return null;
    return $session;
}
