-- ============================================================
-- School Aid Management System — Database Extensions
-- Run AFTER importing database.sql
-- ============================================================

-- -------------------------------------------------------
-- 1. DEPARTMENTS TABLE
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `departments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `code` VARCHAR(30) UNIQUE NOT NULL,
  `description` TEXT,
  `head_staff_id` INT NULL,
  `unit_id` INT NULL,
  `is_active` TINYINT(1) DEFAULT 1,
  `deleted_at` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`head_staff_id`) REFERENCES `staff`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL,
  INDEX `idx_dept_unit` (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 2. TEACHER REGISTRATIONS (pending applications)
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `teacher_registrations` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(200) NOT NULL,
  `email` VARCHAR(150) UNIQUE NOT NULL,
  `phone` VARCHAR(25) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `qualification` VARCHAR(255) NOT NULL,
  `department_id` INT NULL,
  `department_name` VARCHAR(150),
  `passport_photo` VARCHAR(500) NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `status` ENUM('pending','approved','rejected','correction_requested') DEFAULT 'pending',
  `employee_id` VARCHAR(30) NULL COMMENT 'TEA-YYYY-XXXX — set on approval',
  `username` VARCHAR(100) NULL COMMENT 'Set on approval',
  `rejection_reason` TEXT NULL,
  `correction_comments` TEXT NULL,
  `approved_by` INT NULL,
  `approved_at` DATETIME NULL,
  `staff_id` INT NULL COMMENT 'References staff.id after account creation',
  `deleted_at` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`department_id`) REFERENCES `departments`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`approved_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL,
  INDEX `idx_tr_status` (`status`),
  INDEX `idx_tr_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 3. STUDENT REGISTRATIONS (pending applications)
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `student_registrations` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(200) NOT NULL,
  `email` VARCHAR(150) UNIQUE NOT NULL,
  `phone` VARCHAR(25) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `class_name` VARCHAR(100) NOT NULL,
  `department_id` INT NULL,
  `department_name` VARCHAR(150),
  `passport_photo` VARCHAR(500) NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `status` ENUM('pending','approved','rejected','correction_requested') DEFAULT 'pending',
  `student_id_generated` VARCHAR(30) NULL COMMENT 'STD-YYYY-XXXX — set on approval',
  `username` VARCHAR(100) NULL COMMENT 'Set on approval',
  `rejection_reason` TEXT NULL,
  `correction_comments` TEXT NULL,
  `approved_by` INT NULL,
  `approved_at` DATETIME NULL,
  `db_student_id` INT NULL COMMENT 'References students.id after account creation',
  `deleted_at` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`department_id`) REFERENCES `departments`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`approved_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL,
  INDEX `idx_sr_status` (`status`),
  INDEX `idx_sr_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 4. APPROVALS HISTORY LOG
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `approvals` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `applicant_id` INT NOT NULL,
  `applicant_type` ENUM('teacher','student') NOT NULL,
  `approver_id` INT NOT NULL,
  `approval_status` ENUM('approved','rejected','correction_requested') NOT NULL,
  `rejection_reason` TEXT NULL,
  `comments` TEXT NULL,
  `approval_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`approver_id`) REFERENCES `staff`(`id`),
  INDEX `idx_app_type` (`applicant_type`),
  INDEX `idx_app_status` (`approval_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 5. ANNOUNCEMENTS
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NOT NULL,
  `target_role` ENUM('all','teacher','student','principal','head_unit') DEFAULT 'all',
  `is_pinned` TINYINT(1) DEFAULT 0,
  `posted_by` INT NOT NULL,
  `expires_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`posted_by`) REFERENCES `staff`(`id`),
  INDEX `idx_ann_role` (`target_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 6. MESSAGES
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `sender_type` ENUM('staff','student') NOT NULL,
  `sender_staff_id` INT NULL,
  `sender_student_id` INT NULL,
  `recipient_type` ENUM('staff','student') NOT NULL,
  `recipient_staff_id` INT NULL,
  `recipient_student_id` INT NULL,
  `subject` VARCHAR(255) NOT NULL,
  `body` TEXT NOT NULL,
  `is_read` TINYINT(1) DEFAULT 0,
  `read_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`sender_staff_id`) REFERENCES `staff`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`sender_student_id`) REFERENCES `students`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`recipient_staff_id`) REFERENCES `staff`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`recipient_student_id`) REFERENCES `students`(`id`) ON DELETE SET NULL,
  INDEX `idx_msg_sender` (`sender_type`, `sender_staff_id`),
  INDEX `idx_msg_recipient` (`recipient_type`, `recipient_staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 7. NOTIFICATIONS
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `recipient_type` ENUM('staff','student') NOT NULL,
  `recipient_staff_id` INT NULL,
  `recipient_student_id` INT NULL,
  `type` VARCHAR(50) NOT NULL COMMENT 'e.g. approval, rejection, message, result',
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NOT NULL,
  `is_read` TINYINT(1) DEFAULT 0,
  `read_at` DATETIME NULL,
  `link` VARCHAR(500) NULL COMMENT 'Optional URL to navigate to',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`recipient_staff_id`) REFERENCES `staff`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`recipient_student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE,
  INDEX `idx_notif_staff` (`recipient_staff_id`, `is_read`),
  INDEX `idx_notif_student` (`recipient_student_id`, `is_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 8. AUDIT LOGS
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `actor_type` ENUM('staff','student','system') NOT NULL,
  `actor_id` INT NULL,
  `actor_name` VARCHAR(200) NULL,
  `action` VARCHAR(100) NOT NULL COMMENT 'e.g. LOGIN, APPROVE_TEACHER, CREATE_STUDENT',
  `resource_type` VARCHAR(100) NULL COMMENT 'e.g. teacher_registration, student',
  `resource_id` INT NULL,
  `description` TEXT NOT NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_audit_actor` (`actor_type`, `actor_id`),
  INDEX `idx_audit_action` (`action`),
  INDEX `idx_audit_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 9. ASSIGNMENTS
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `subject_id` INT NOT NULL,
  `class_id` INT NOT NULL,
  `teacher_id` INT NOT NULL,
  `due_date` DATE NOT NULL,
  `academic_session` VARCHAR(20),
  `term` ENUM('1st','2nd','3rd') DEFAULT '1st',
  `max_score` DECIMAL(5,2) DEFAULT 100,
  `attachment_path` VARCHAR(500) NULL,
  `deleted_at` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`),
  FOREIGN KEY (`class_id`) REFERENCES `classes`(`id`),
  FOREIGN KEY (`teacher_id`) REFERENCES `staff`(`id`),
  INDEX `idx_asgn_class` (`class_id`),
  INDEX `idx_asgn_teacher` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 10. ASSIGNMENT SUBMISSIONS
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `assignment_submissions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `assignment_id` INT NOT NULL,
  `student_id` INT NOT NULL,
  `submission_text` TEXT NULL,
  `attachment_path` VARCHAR(500) NULL,
  `submitted_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `score` DECIMAL(5,2) NULL,
  `graded_by` INT NULL,
  `graded_at` DATETIME NULL,
  `feedback` TEXT NULL,
  `status` ENUM('submitted','graded','late') DEFAULT 'submitted',
  UNIQUE KEY `unique_submission` (`assignment_id`, `student_id`),
  FOREIGN KEY (`assignment_id`) REFERENCES `assignments`(`id`),
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`),
  FOREIGN KEY (`graded_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 11. SCHOOL SETTINGS
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS `school_settings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `setting_key` VARCHAR(100) UNIQUE NOT NULL,
  `setting_value` TEXT,
  `setting_group` VARCHAR(50) DEFAULT 'general',
  `updated_by` INT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`updated_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- 12. Add columns to existing staff table
-- -------------------------------------------------------
ALTER TABLE `staff`
  ADD COLUMN IF NOT EXISTS `username` VARCHAR(100) UNIQUE NULL AFTER `email`,
  ADD COLUMN IF NOT EXISTS `date_of_birth` DATE NULL AFTER `phone`,
  ADD COLUMN IF NOT EXISTS `department_id` INT NULL AFTER `unit_id`,
  ADD COLUMN IF NOT EXISTS `passport_photo` VARCHAR(500) NULL AFTER `address`,
  ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME NULL AFTER `updated_at`;

-- -------------------------------------------------------
-- 13. Add columns to existing students table
-- -------------------------------------------------------
ALTER TABLE `students`
  ADD COLUMN IF NOT EXISTS `username` VARCHAR(100) UNIQUE NULL AFTER `email`,
  ADD COLUMN IF NOT EXISTS `student_id_number` VARCHAR(30) UNIQUE NULL COMMENT 'STD-YYYY-XXXX' AFTER `admission_no`,
  ADD COLUMN IF NOT EXISTS `password_hash` VARCHAR(255) NULL AFTER `parent_email`,
  ADD COLUMN IF NOT EXISTS `department_id` INT NULL AFTER `unit_id`,
  ADD COLUMN IF NOT EXISTS `passport_photo` VARCHAR(500) NULL AFTER `home_address`,
  ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME NULL AFTER `updated_at`;

-- -------------------------------------------------------
-- 14. Seed default departments
-- -------------------------------------------------------
INSERT IGNORE INTO `departments` (`name`, `code`, `description`, `unit_id`) VALUES
('Science Department', 'SCI', 'Biology, Chemistry, Physics, Mathematics', 3),
('Arts Department', 'ARTS', 'Literature, Fine Art, Music, CRK/IRK', 3),
('Commercial Department', 'COM', 'Economics, Accounting, Commerce', 3),
('Vocational Department', 'VOC', 'Technical, Home Economics, Agricultural Science', 3),
('Primary Department', 'PRI', 'Primary 1–6 general subjects', 2),
('Nursery Department', 'NUR', 'Pre-nursery and Nursery classes', 1),
('Islamic Studies Department', 'ISL', 'Quran, Hadith, Fiqh, Arabic', 4);

-- -------------------------------------------------------
-- 15. Seed default school settings
-- -------------------------------------------------------
INSERT IGNORE INTO `school_settings` (`setting_key`, `setting_value`, `setting_group`) VALUES
('school_name', 'Plan Aid Academy', 'general'),
('school_email', 'info@paa.edu.ng', 'general'),
('school_phone', '+234 800 000 0000', 'general'),
('school_address', 'Jos, Plateau State, Nigeria', 'general'),
('current_academic_session', '2025/2026', 'academic'),
('current_term', '1st', 'academic'),
('registration_open', '1', 'registration'),
('teacher_registration_open', '1', 'registration'),
('student_registration_open', '1', 'registration');

-- -------------------------------------------------------
-- 16. Upload directory marker (runtime: ensure folder exists)
-- -------------------------------------------------------
-- Run from PHP: mkdir('uploads/passports', 0755, true);
-- -------------------------------------------------------
