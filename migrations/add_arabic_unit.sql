-- ============================================================
-- Plan Aid Academy - Migration: Dedicated Arabic/Islamic Unit Portal
-- Run against database to set up Arabic Unit tables & defaults
-- ============================================================

-- 1. ARABIC SUBJECTS TABLE
CREATE TABLE IF NOT EXISTS `arabic_subjects` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `arabic_name` VARCHAR(150) NULL,
  `code` VARCHAR(30) UNIQUE NOT NULL,
  `description` TEXT NULL,
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default Arabic subjects if table is empty
INSERT IGNORE INTO `arabic_subjects` (`id`, `name`, `arabic_name`, `code`, `description`, `is_active`) VALUES
(1, 'Arabic Language', 'اللغة العربية', 'ARB-101', 'Reading, writing, grammar, and spoken Arabic literacy.', 1),
(2, 'Qur\'an Studies', 'القرآن الكريم', 'QRN-102', 'Memorization (Hifz), recitation, and commentary (Tafseer).', 1),
(3, 'Hadith Studies', 'الحديث النبوي', 'HDT-103', 'Prophetic traditions, memorization of Hadith, and moral lessons.', 1),
(4, 'Islamic Studies', 'الدراسات الإسلامية', 'ISL-104', 'General Islamic history, culture, values, and ethics.', 1),
(5, 'Tajweed Rules', 'التجويد', 'TJW-105', 'Art of Qur\'anic pronunciation and recitation rules.', 1),
(6, 'Fiqh (Jurisprudence)', 'الفقه الإسلامي', 'FQH-106', 'Practical Islamic jurisprudence, worship, and social dealings.', 1);

-- 2. ARABIC CLASSES TABLE
CREATE TABLE IF NOT EXISTS `arabic_classes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `arabic_name` VARCHAR(100) NULL,
  `code` VARCHAR(30) UNIQUE NOT NULL,
  `level` VARCHAR(50) DEFAULT 'Intermediate',
  `teacher_id` INT NULL,
  `capacity` INT DEFAULT 30,
  `academic_session` VARCHAR(20) DEFAULT '2025/2026',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`teacher_id`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default Arabic classes
INSERT IGNORE INTO `arabic_classes` (`id`, `name`, `arabic_name`, `code`, `level`, `capacity`) VALUES
(1, 'Arabic Foundation Class', 'المستوى التمهيدي', 'ARC-101', 'Foundation', 35),
(2, 'Arabic Intermediate Class', 'المستوى المتوسط', 'ARC-102', 'Intermediate', 35),
(3, 'Arabic Advanced Class', 'المستوى المتقدم', 'ARC-103', 'Advanced', 30),
(4, 'Hifz & Tajweed Circle', 'فصل الحفظ والتجويد', 'ARC-104', 'Specialized', 25);

-- 3. ARABIC STUDENT CLASS ASSIGNMENTS
CREATE TABLE IF NOT EXISTS `arabic_class_assignments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_id` INT NOT NULL,
  `arabic_class_id` INT NOT NULL,
  `academic_session` VARCHAR(20) DEFAULT '2025/2026',
  `assigned_by` INT NULL,
  `assigned_date` DATE NOT NULL,
  UNIQUE KEY `unique_arabic_assignment` (`student_id`, `arabic_class_id`, `academic_session`),
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`arabic_class_id`) REFERENCES `arabic_classes`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`assigned_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. ARABIC ATTENDANCE TABLE
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
  UNIQUE KEY `unique_arabic_attendance` (`student_id`, `arabic_class_id`, `attendance_date`),
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`arabic_class_id`) REFERENCES `arabic_classes`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`marked_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. ARABIC RESULTS TABLE
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
  UNIQUE KEY `unique_arabic_result` (`student_id`, `arabic_subject_id`, `arabic_class_id`, `academic_session`, `term`),
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`arabic_subject_id`) REFERENCES `arabic_subjects`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`arabic_class_id`) REFERENCES `arabic_classes`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`submitted_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`approved_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. ARABIC ANNOUNCEMENTS TABLE
CREATE TABLE IF NOT EXISTS `arabic_announcements` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `title_ar` VARCHAR(255) NULL,
  `content` TEXT NOT NULL,
  `published_by` INT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`published_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default sample announcement
INSERT IGNORE INTO `arabic_announcements` (`id`, `title`, `title_ar`, `content`) VALUES
(1, '1st Term Qur\'an Competition Registration', 'التسجيل لفي مسابقة حفظ القرآن الكريم', 'Registration for the 1st term Hifz and Tajweed competition is now open for all Arabic Unit students. Submissions close next Friday.');
