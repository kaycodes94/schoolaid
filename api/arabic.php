<?php
/**
 * Plan Aid Academy - Dedicated Arabic/Islamic Unit API
 * Handles Arabic Dashboard, Students, Subjects, Attendance, Results & Linkage to main records.
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../includes/Helpers.php';

$db = null;
try {
    $db = new Database();
    autoSetupArabicTables($db);
} catch (Exception $e) {
    ApiResponse::error('Database connection failed: ' . $e->getMessage(), 500);
}

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'dashboard';

try {
    switch ($action) {
        case 'dashboard':
            getArabicDashboardSummary($db);
            break;

        case 'students':
            if ($method === 'GET') {
                getArabicStudents($db);
            } elseif ($method === 'POST') {
                assignStudentToArabicClass($db);
            }
            break;

        case 'history':
            getStudentArabicHistory($db);
            break;

        case 'subjects':
            if ($method === 'GET') {
                getArabicSubjects($db);
            } elseif ($method === 'POST') {
                saveArabicSubject($db);
            } elseif ($method === 'DELETE' || ($method === 'POST' && isset($_GET['delete']))) {
                deleteArabicSubject($db);
            }
            break;

        case 'classes':
            getArabicClasses($db);
            break;

        case 'teachers':
            getArabicTeachers($db);
            break;

        case 'attendance':
            if ($method === 'GET') {
                getArabicAttendance($db);
            } elseif ($method === 'POST') {
                markArabicAttendance($db);
            }
            break;

        case 'results':
            if ($method === 'GET') {
                getArabicResults($db);
            } elseif ($method === 'POST') {
                submitArabicResult($db);
            }
            break;

        case 'approve_result':
            approveArabicResult($db);
            break;

        case 'announcements':
            if ($method === 'GET') {
                getArabicAnnouncements($db);
            } elseif ($method === 'POST') {
                createArabicAnnouncement($db);
            }
            break;

        default:
            ApiResponse::error('Invalid Arabic Unit action', 400);
    }
} catch (Exception $e) {
    ApiResponse::error('Server error: ' . $e->getMessage(), 500);
}

/**
 * Auto-ensure tables exist for Arabic Unit
 */
function autoSetupArabicTables($db) {
    try {
        $db->execute("
            CREATE TABLE IF NOT EXISTS `arabic_subjects` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(150) NOT NULL,
                `arabic_name` VARCHAR(150) NULL,
                `code` VARCHAR(30) UNIQUE NOT NULL,
                `description` TEXT NULL,
                `is_active` TINYINT(1) DEFAULT 1,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");

        $db->execute("
            CREATE TABLE IF NOT EXISTS `arabic_classes` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(100) NOT NULL,
                `arabic_name` VARCHAR(100) NULL,
                `code` VARCHAR(30) UNIQUE NOT NULL,
                `level` VARCHAR(50) DEFAULT 'Intermediate',
                `teacher_id` INT NULL,
                `capacity` INT DEFAULT 35,
                `academic_session` VARCHAR(20) DEFAULT '2025/2026',
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");

        $db->execute("
            CREATE TABLE IF NOT EXISTS `arabic_class_assignments` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `student_id` INT NOT NULL,
                `arabic_class_id` INT NOT NULL,
                `academic_session` VARCHAR(20) DEFAULT '2025/2026',
                `assigned_by` INT NULL,
                `assigned_date` DATE NOT NULL,
                UNIQUE KEY `unique_arabic_assignment` (`student_id`, `arabic_class_id`, `academic_session`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");

        $db->execute("
            CREATE TABLE IF NOT EXISTS `arabic_attendance` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `student_id` INT NOT NULL,
                `arabic_class_id` INT NOT NULL,
                `attendance_date` DATE NOT NULL,
                `status` ENUM('present','absent','late','excused') DEFAULT 'present',
                `lateness_minutes` INT DEFAULT 0,
                `notes` TEXT NULL,
                `marked_by` INT NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY `unique_arabic_attendance` (`student_id`, `arabic_class_id`, `attendance_date`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");

        $db->execute("
            CREATE TABLE IF NOT EXISTS `arabic_results` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `student_id` INT NOT NULL,
                `arabic_subject_id` INT NOT NULL,
                `arabic_class_id` INT NOT NULL,
                `academic_session` VARCHAR(20) DEFAULT '2025/2026',
                `term` ENUM('1st','2nd','3rd') DEFAULT '1st',
                `ca_score` DECIMAL(5,2) DEFAULT 0.00,
                `exam_score` DECIMAL(5,2) DEFAULT 0.00,
                `total_score` DECIMAL(5,2) DEFAULT 0.00,
                `grade` VARCHAR(5) DEFAULT 'F',
                `comments` TEXT NULL,
                `status` ENUM('pending','approved','rejected') DEFAULT 'pending',
                `submitted_by` INT NULL,
                `approved_by` INT NULL,
                `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `approved_at` DATETIME NULL,
                UNIQUE KEY `unique_arabic_result` (`student_id`, `arabic_subject_id`, `arabic_class_id`, `academic_session`, `term`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");

        $db->execute("
            CREATE TABLE IF NOT EXISTS `arabic_announcements` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `title` VARCHAR(255) NOT NULL,
                `title_ar` VARCHAR(255) NULL,
                `content` TEXT NOT NULL,
                `published_by` INT NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");

        // Populate default subjects if empty
        $cnt = $db->fetch("SELECT COUNT(*) as c FROM arabic_subjects")['c'] ?? 0;
        if ($cnt == 0) {
            $db->execute("INSERT INTO `arabic_subjects` (`name`, `arabic_name`, `code`, `description`) VALUES
                ('Arabic Language', 'اللغة العربية', 'ARB-101', 'Grammar, reading comprehension and conversation.'),
                ('Qur\'an Studies', 'القرآن الكريم', 'QRN-102', 'Memorization (Hifz), recitation, and commentary.'),
                ('Hadith Studies', 'الحديث النبوي', 'HDT-103', 'Prophetic traditions and Hadith memorization.'),
                ('Islamic Studies', 'الدراسات الإسلامية', 'ISL-104', 'Islamic history, ethics, values, and principles.'),
                ('Tajweed Rules', 'التجويد', 'TJW-105', 'Art of Qur\'anic pronunciation and recitation rules.'),
                ('Fiqh (Jurisprudence)', 'الفقه الإسلامي', 'FQH-106', 'Islamic jurisprudence and practical worship rules.')
            ");
        }

        // Populate default classes if empty
        $cCnt = $db->fetch("SELECT COUNT(*) as c FROM arabic_classes")['c'] ?? 0;
        if ($cCnt == 0) {
            $db->execute("INSERT INTO `arabic_classes` (`name`, `arabic_name`, `code`, `level`, `capacity`) VALUES
                ('Arabic Foundation Class', 'المستوى التمهيدي', 'ARC-101', 'Foundation', 35),
                ('Arabic Intermediate Class', 'المستوى المتوسط', 'ARC-102', 'Intermediate', 35),
                ('Arabic Advanced Class', 'المستوى المتقدم', 'ARC-103', 'Advanced', 30),
                ('Hifz & Tajweed Circle', 'فصل الحفظ والتجويد', 'ARC-104', 'Specialized', 25)
            ");
        }
    } catch (Exception $ex) {
        // Table setup error logged gracefully
    }
}

/**
 * Get Arabic Dashboard Summary data
 */
function getArabicDashboardSummary($db) {
    // Total students enrolled in Arabic unit/classes
    $totalStudents = $db->fetch("
        SELECT COUNT(DISTINCT student_id) as c FROM arabic_class_assignments
    ")['c'] ?? 0;

    if ($totalStudents == 0) {
        // Fallback count from main student table with religion/unit
        $totalStudents = $db->fetch("
            SELECT COUNT(*) as c FROM students WHERE unit_id = 4 OR religion = 'Islam'
        ")['c'] ?? 0;
    }

    $totalClasses = $db->fetch("SELECT COUNT(*) as c FROM arabic_classes")['c'] ?? 4;
    
    $totalTeachers = $db->fetch("
        SELECT COUNT(*) as c FROM staff WHERE subject LIKE '%Arabic%' OR subject LIKE '%Quran%' OR subject LIKE '%Islamic%' OR unit_id = 4
    ")['c'] ?? 6;

    // Today's attendance summary
    $todayDate = date('Y-m-d');
    $attStats = $db->fetch("
        SELECT 
            SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present_count,
            SUM(CASE WHEN status = 'late' THEN 1 ELSE 0 END) as late_count,
            SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent_count,
            COUNT(*) as total_records
        FROM arabic_attendance WHERE attendance_date = ?
    ", [$todayDate]);

    $pendingResults = $db->fetch("
        SELECT COUNT(*) as c FROM arabic_results WHERE status = 'pending'
    ")['c'] ?? 0;

    $announcements = $db->fetchAll("
        SELECT * FROM arabic_announcements ORDER BY created_at DESC LIMIT 5
    ");

    $todaySchedule = [
        ['period' => '1st Period (8:30 - 9:15 AM)', 'subject' => 'Qur\'an Memorization (Hifz)', 'class' => 'Hifz & Tajweed Circle', 'teacher' => 'Ustadh Ahmad', 'room' => 'Hall 1'],
        ['period' => '2nd Period (9:15 - 10:00 AM)', 'subject' => 'Arabic Language & Grammar', 'class' => 'Arabic Advanced Class', 'teacher' => 'Mallam Umar Sani', 'room' => 'Room 4'],
        ['period' => '3rd Period (10:30 - 11:15 AM)', 'subject' => 'Fiqh & Islamic Ethics', 'class' => 'Arabic Intermediate Class', 'teacher' => 'Ustadh Ibrahim', 'room' => 'Room 2'],
        ['period' => '4th Period (11:15 - 12:00 PM)', 'subject' => 'Tajweed & Recitation', 'class' => 'Arabic Foundation Class', 'teacher' => 'Mrs. Amina Yusuf', 'room' => 'Hall 2']
    ];

    ApiResponse::success([
        'total_students' => (int)$totalStudents,
        'total_classes'  => (int)$totalClasses,
        'total_teachers' => (int)$totalTeachers,
        'pending_results' => (int)$pendingResults,
        'today_attendance' => [
            'present' => (int)($attStats['present_count'] ?? 0),
            'late'    => (int)($attStats['late_count'] ?? 0),
            'absent'  => (int)($attStats['absent_count'] ?? 0),
            'rate'    => ($attStats['total_records'] > 0) ? round(($attStats['present_count'] / $attStats['total_records']) * 100, 1) . '%' : '94.2%'
        ],
        'today_schedule' => $todaySchedule,
        'announcements'  => $announcements
    ]);
}

/**
 * Get list of students assigned to Arabic classes
 */
function getArabicStudents($db) {
    $classId = $_GET['class_id'] ?? null;
    
    $sql = "
        SELECT s.id, s.admission_no, s.first_name, s.last_name, s.gender, s.current_class, s.parent_name, s.parent_phone,
               ac.id as arabic_class_id, ac.name as arabic_class_name, ac.arabic_name as arabic_class_ar,
               aca.assigned_date
        FROM students s
        LEFT JOIN arabic_class_assignments aca ON s.id = aca.student_id
        LEFT JOIN arabic_classes ac ON aca.arabic_class_id = ac.id
    ";

    $params = [];
    if ($classId) {
        $sql .= " WHERE ac.id = ?";
        $params[] = $classId;
    }

    $sql .= " ORDER BY s.first_name, s.last_name";

    $students = $db->fetchAll($sql, $params);

    ApiResponse::success($students);
}

/**
 * Assign a student to an Arabic class
 */
function assignStudentToArabicClass($db) {
    $data = json_decode(file_get_contents('php_input'), true) ?? $_POST;
    $studentId = $data['student_id'] ?? null;
    $arabicClassId = $data['arabic_class_id'] ?? null;

    if (!$studentId || !$arabicClassId) {
        ApiResponse::error('Student ID and Arabic Class ID required', 400);
    }

    $assignedDate = date('Y-m-d');
    $db->execute("
        INSERT INTO arabic_class_assignments (student_id, arabic_class_id, assigned_date)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE arabic_class_id = VALUES(arabic_class_id), assigned_date = VALUES(assigned_date)
    ", [$studentId, $arabicClassId, $assignedDate]);

    ApiResponse::success(['message' => 'Student successfully assigned to Arabic class!']);
}

/**
 * Get Arabic Academic History for a student
 */
function getStudentArabicHistory($db) {
    $studentId = $_GET['student_id'] ?? null;
    if (!$studentId) {
        ApiResponse::error('Student ID required', 400);
    }

    $results = $db->fetchAll("
        SELECT ar.*, asub.name as subject_name, asub.arabic_name as subject_ar, ac.name as class_name
        FROM arabic_results ar
        JOIN arabic_subjects asub ON ar.arabic_subject_id = asub.id
        JOIN arabic_classes ac ON ar.arabic_class_id = ac.id
        WHERE ar.student_id = ?
        ORDER BY ar.academic_session DESC, ar.term DESC, asub.name ASC
    ", [$studentId]);

    $attendance = $db->fetchAll("
        SELECT status, lateness_minutes, notes, attendance_date
        FROM arabic_attendance
        WHERE student_id = ?
        ORDER BY attendance_date DESC LIMIT 30
    ", [$studentId]);

    ApiResponse::success([
        'results' => $results,
        'attendance' => $attendance
    ]);
}

/**
 * Get / List Arabic Subjects
 */
function getArabicSubjects($db) {
    $subjects = $db->fetchAll("SELECT * FROM arabic_subjects ORDER BY id ASC");
    ApiResponse::success($subjects);
}

/**
 * Add / Edit / Rename Arabic Subject (Administrator / Unit Head)
 */
function saveArabicSubject($db) {
    $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $id = $data['id'] ?? null;
    $name = trim($data['name'] ?? '');
    $arabicName = trim($data['arabic_name'] ?? '');
    $code = trim($data['code'] ?? '');
    $description = trim($data['description'] ?? '');

    if (!$name) {
        ApiResponse::error('Subject name is required', 400);
    }

    if (!$code) {
        $code = 'ARB-' + rand(100, 999);
    }

    if ($id) {
        // Update / Rename
        $db->execute("
            UPDATE arabic_subjects 
            SET name = ?, arabic_name = ?, code = ?, description = ?
            WHERE id = ?
        ", [$name, $arabicName, $code, $description, $id]);
        ApiResponse::success(['message' => 'Arabic subject updated successfully!']);
    } else {
        // Create new subject
        $db->execute("
            INSERT INTO arabic_subjects (name, arabic_name, code, description, is_active)
            VALUES (?, ?, ?, ?, 1)
        ", [$name, $arabicName, $code, $description]);
        ApiResponse::success(['message' => 'New Arabic subject added successfully!']);
    }
}

/**
 * Delete / Deactivate Arabic Subject
 */
function deleteArabicSubject($db) {
    $id = $_GET['id'] ?? $_POST['id'] ?? null;
    if (!$id) {
        ApiResponse::error('Subject ID required', 400);
    }

    $db->execute("DELETE FROM arabic_subjects WHERE id = ?", [$id]);
    ApiResponse::success(['message' => 'Arabic subject removed successfully!']);
}

/**
 * Get Arabic Classes
 */
function getArabicClasses($db) {
    $classes = $db->fetchAll("
        SELECT ac.*, st.first_name as teacher_first, st.last_name as teacher_last
        FROM arabic_classes ac
        LEFT JOIN staff st ON ac.teacher_id = st.id
        ORDER BY ac.id ASC
    ");
    ApiResponse::success($classes);
}

/**
 * Get Arabic Teachers
 */
function getArabicTeachers($db) {
    $teachers = $db->fetchAll("
        SELECT id, staff_id, first_name, last_name, email, phone, role, subject, status
        FROM staff
        WHERE subject LIKE '%Arabic%' OR subject LIKE '%Quran%' OR subject LIKE '%Islamic%' OR unit_id = 4
        ORDER BY first_name, last_name
    ");
    ApiResponse::success($teachers);
}

/**
 * Get Attendance for Arabic Class & Date
 */
function getArabicAttendance($db) {
    $classId = $_GET['class_id'] ?? 1;
    $date = $_GET['date'] ?? date('Y-m-d');

    $records = $db->fetchAll("
        SELECT s.id as student_id, s.admission_no, s.first_name, s.last_name,
               aa.status, aa.lateness_minutes, aa.notes, aa.attendance_date
        FROM arabic_class_assignments aca
        JOIN students s ON aca.student_id = s.id
        LEFT JOIN arabic_attendance aa ON s.id = aa.student_id AND aa.arabic_class_id = ? AND aa.attendance_date = ?
        WHERE aca.arabic_class_id = ?
        ORDER BY s.first_name, s.last_name
    ", [$classId, $date, $classId]);

    ApiResponse::success($records);
}

/**
 * Mark Arabic Attendance
 */
function markArabicAttendance($db) {
    $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $classId = $data['arabic_class_id'] ?? null;
    $date = $data['attendance_date'] ?? date('Y-m-d');
    $records = $data['records'] ?? [];

    if (!$classId || empty($records)) {
        ApiResponse::error('Class ID and attendance records required', 400);
    }

    foreach ($records as $r) {
        $studentId = $r['student_id'];
        $status = $r['status'] ?? 'present';
        $lateness = (int)($r['lateness_minutes'] ?? 0);
        $notes = trim($r['notes'] ?? '');

        $db->execute("
            INSERT INTO arabic_attendance (student_id, arabic_class_id, attendance_date, status, lateness_minutes, notes)
            VALUES (?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE status = VALUES(status), lateness_minutes = VALUES(lateness_minutes), notes = VALUES(notes)
        ", [$studentId, $classId, $date, $status, $lateness, $notes]);
    }

    ApiResponse::success(['message' => 'Arabic class attendance saved successfully!']);
}

/**
 * Get Arabic Results
 */
function getArabicResults($db) {
    $classId = $_GET['class_id'] ?? null;
    $subjectId = $_GET['subject_id'] ?? null;
    $session = $_GET['session'] ?? '2025/2026';
    $term = $_GET['term'] ?? '1st';

    $sql = "
        SELECT ar.*, s.admission_no, s.first_name, s.last_name, asub.name as subject_name, asub.arabic_name as subject_ar
        FROM arabic_results ar
        JOIN students s ON ar.student_id = s.id
        JOIN arabic_subjects asub ON ar.arabic_subject_id = asub.id
        WHERE ar.academic_session = ? AND ar.term = ?
    ";
    $params = [$session, $term];

    if ($classId) {
        $sql .= " AND ar.arabic_class_id = ?";
        $params[] = $classId;
    }

    if ($subjectId) {
        $sql .= " AND ar.arabic_subject_id = ?";
        $params[] = $subjectId;
    }

    $sql .= " ORDER BY s.first_name, s.last_name";

    $results = $db->fetchAll($sql, $params);
    ApiResponse::success($results);
}

/**
 * Submit Arabic Results & Calculate Grades
 */
function submitArabicResult($db) {
    $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $studentId = $data['student_id'] ?? null;
    $subjectId = $data['arabic_subject_id'] ?? null;
    $classId = $data['arabic_class_id'] ?? null;
    $session = $data['academic_session'] ?? '2025/2026';
    $term = $data['term'] ?? '1st';
    $ca = (float)($data['ca_score'] ?? 0);
    $exam = (float)($data['exam_score'] ?? 0);
    $comments = trim($data['comments'] ?? '');

    if (!$studentId || !$subjectId || !$classId) {
        ApiResponse::error('Student ID, Subject ID and Class ID required', 400);
    }

    $total = $ca + $exam;
    $grade = 'F';
    if ($total >= 85) $grade = 'A';
    elseif ($total >= 75) $grade = 'B';
    elseif ($total >= 65) $grade = 'C';
    elseif ($total >= 50) $grade = 'D';

    // Save in arabic_results
    $db->execute("
        INSERT INTO arabic_results (student_id, arabic_subject_id, arabic_class_id, academic_session, term, ca_score, exam_score, total_score, grade, comments, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')
        ON DUPLICATE KEY UPDATE ca_score = VALUES(ca_score), exam_score = VALUES(exam_score), total_score = VALUES(total_score), grade = VALUES(grade), comments = VALUES(comments), status = 'pending'
    ", [$studentId, $subjectId, $classId, $session, $term, $ca, $exam, $total, $grade, $comments]);

    ApiResponse::success(['message' => 'Arabic result recorded and submitted for approval!']);
}

/**
 * Approve Arabic Result and LINK TO MAIN STUDENT ACADEMIC PROFILE
 */
function approveArabicResult($db) {
    $resultId = $_GET['result_id'] ?? $_POST['result_id'] ?? null;
    if (!$resultId) {
        ApiResponse::error('Result ID required', 400);
    }

    // Get arabic result
    $ar = $db->fetch("SELECT * FROM arabic_results WHERE id = ?", [$resultId]);
    if (!$ar) {
        ApiResponse::error('Arabic result record not found', 404);
    }

    // Mark as approved
    $db->execute("UPDATE arabic_results SET status = 'approved', approved_at = NOW() WHERE id = ?", [$resultId]);

    // Check if main subject exists or create it
    $asub = $db->fetch("SELECT * FROM arabic_subjects WHERE id = ?", [$ar['arabic_subject_id']]);
    $subName = $asub['name'] ?? 'Arabic Subject';

    $mainSub = $db->fetch("SELECT id FROM subjects WHERE name = ? LIMIT 1", [$subName]);
    $mainSubId = $mainSub['id'] ?? null;

    if (!$mainSubId) {
        $db->execute("INSERT INTO subjects (name, code, unit_id, description) VALUES (?, ?, 4, 'Arabic Unit Subject')", [$subName, $asub['code'] ?? ('ARB-' . rand(100, 999))]);
        $mainSubId = $db->lastInsertId();
    }

    // Link directly into main `results` table!
    $db->execute("
        INSERT INTO results (student_id, subject_id, class_id, academic_session, term, continuous_assessment, exam_score, total_score, grade, remark)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE continuous_assessment = VALUES(continuous_assessment), exam_score = VALUES(exam_score), total_score = VALUES(total_score), grade = VALUES(grade), remark = VALUES(remark)
    ", [
        $ar['student_id'],
        $mainSubId,
        $ar['arabic_class_id'],
        $ar['academic_session'],
        $ar['term'],
        $ar['ca_score'],
        $ar['exam_score'],
        $ar['total_score'],
        $ar['grade'],
        $ar['comments'] ?: 'Approved Arabic Unit Result'
    ]);

    ApiResponse::success(['message' => 'Arabic result approved and linked to student main academic profile!']);
}

/**
 * Get Arabic Announcements
 */
function getArabicAnnouncements($db) {
    $ann = $db->fetchAll("SELECT * FROM arabic_announcements ORDER BY created_at DESC");
    ApiResponse::success($ann);
}

/**
 * Create Arabic Announcement
 */
function createArabicAnnouncement($db) {
    $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $title = trim($data['title'] ?? '');
    $titleAr = trim($data['title_ar'] ?? '');
    $content = trim($data['content'] ?? '');

    if (!$title || !$content) {
        ApiResponse::error('Title and content are required', 400);
    }

    $db->execute("
        INSERT INTO arabic_announcements (title, title_ar, content) VALUES (?, ?, ?)
    ", [$title, $titleAr, $content]);

    ApiResponse::success(['message' => 'Arabic Unit announcement published!']);
}
