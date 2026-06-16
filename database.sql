-- Plan Aid Academy - Database Schema
-- Created for school management system
-- Using PDO for database operations

CREATE TABLE IF NOT EXISTS `units` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `code` VARCHAR(20) UNIQUE,
  `head_id` INT,
  `description` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `staff` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `staff_id` VARCHAR(50) UNIQUE NOT NULL,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) UNIQUE,
  `phone` VARCHAR(20),
  `password_hash` VARCHAR(255) NOT NULL,
  `role` ENUM('principal','finance','unit_head','teacher','admin') NOT NULL,
  `unit_id` INT,
  `subject` VARCHAR(100),
  `qualification` VARCHAR(255),
  `hire_date` DATE,
  `portal_access_status` ENUM('pending','approved','rejected') DEFAULT 'pending',
  `approval_code_hash` VARCHAR(255),
  `portal_approved_by` INT,
  `portal_approved_at` DATETIME,
  `status` ENUM('active','on_leave','inactive') DEFAULT 'active',
  `address` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`),
  FOREIGN KEY (`portal_approved_by`) REFERENCES `staff`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `students` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `admission_no` VARCHAR(50) UNIQUE NOT NULL,
  `student_id_number` VARCHAR(50) UNIQUE,
  `email` VARCHAR(100) UNIQUE,
  `username` VARCHAR(100) UNIQUE,
  `password_hash` VARCHAR(255),
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `date_of_birth` DATE,
  `gender` ENUM('Male','Female','Other'),
  `state_of_origin` VARCHAR(100),
  `religion` ENUM('Christianity','Islam','Other'),
  `unit_id` INT NOT NULL,
  `current_class` VARCHAR(50),
  `parent_name` VARCHAR(150),
  `parent_phone` VARCHAR(20),
  `parent_email` VARCHAR(100),
  `home_address` TEXT,
  `previous_school` VARCHAR(150),
  `class_last_attended` VARCHAR(50),
  `admission_date` DATE,
  `application_status` ENUM('pending','approved','rejected') DEFAULT 'approved',
  `portal_access_status` ENUM('pending','approved','rejected') DEFAULT 'pending',
  `approval_code_hash` VARCHAR(255),
  `portal_approved_by` INT,
  `portal_approved_at` DATETIME,
  `status` ENUM('active','graduated','withdrawn') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`),
  FOREIGN KEY (`portal_approved_by`) REFERENCES `staff`(`id`),
  INDEX `idx_admission_no` (`admission_no`),
  INDEX `idx_unit_id` (`unit_id`),
  INDEX `idx_student_login` (`student_id_number`, `username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `classes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `class_code` VARCHAR(20) UNIQUE,
  `unit_id` INT NOT NULL,
  `teacher_id` INT,
  `capacity` INT,
  `academic_session` VARCHAR(20),
  `term` ENUM('1st','2nd','3rd') DEFAULT '1st',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`),
  FOREIGN KEY (`teacher_id`) REFERENCES `staff`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `class_enrollment` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_id` INT NOT NULL,
  `class_id` INT NOT NULL,
  `academic_session` VARCHAR(20),
  `enrolled_date` DATE,
  UNIQUE KEY `unique_enrollment` (`student_id`, `class_id`, `academic_session`),
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`),
  FOREIGN KEY (`class_id`) REFERENCES `classes`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `code` VARCHAR(20) UNIQUE,
  `unit_id` INT,
  `description` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `results` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_id` INT NOT NULL,
  `subject_id` INT NOT NULL,
  `class_id` INT NOT NULL,
  `academic_session` VARCHAR(20),
  `term` ENUM('1st','2nd','3rd') NOT NULL,
  `continuous_assessment` DECIMAL(5,2),
  `exam_score` DECIMAL(5,2),
  `total_score` DECIMAL(5,2),
  `grade` VARCHAR(5),
  `remark` VARCHAR(100),
  `entered_by` INT,
  `entered_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `unique_result` (`student_id`, `subject_id`, `class_id`, `academic_session`, `term`),
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`),
  FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`),
  FOREIGN KEY (`class_id`) REFERENCES `classes`(`id`),
  FOREIGN KEY (`entered_by`) REFERENCES `staff`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_id` INT NOT NULL,
  `class_id` INT NOT NULL,
  `attendance_date` DATE NOT NULL,
  `status` ENUM('present','absent','late','excused') DEFAULT 'present',
  `marked_by` INT,
  `remarks` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `unique_attendance` (`student_id`, `class_id`, `attendance_date`),
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`),
  FOREIGN KEY (`class_id`) REFERENCES `classes`(`id`),
  FOREIGN KEY (`marked_by`) REFERENCES `staff`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `fees` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fee_name` VARCHAR(100) NOT NULL,
  `fee_code` VARCHAR(20) UNIQUE,
  `unit_id` INT,
  `amount` DECIMAL(12,2) NOT NULL,
  `academic_session` VARCHAR(20),
  `term` ENUM('1st','2nd','3rd','full_year'),
  `class` VARCHAR(50),
  `description` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `payments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `receipt_no` VARCHAR(50) UNIQUE NOT NULL,
  `student_id` INT NOT NULL,
  `amount_paid` DECIMAL(12,2) NOT NULL,
  `payment_date` DATE NOT NULL,
  `academic_session` VARCHAR(20),
  `term` ENUM('1st','2nd','3rd'),
  `payment_method` ENUM('cash','bank_transfer','cheque','online') DEFAULT 'cash',
  `reference` VARCHAR(100),
  `recorded_by` INT,
  `status` ENUM('confirmed','pending','failed') DEFAULT 'confirmed',
  `remarks` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`),
  FOREIGN KEY (`recorded_by`) REFERENCES `staff`(`id`),
  INDEX `student_id` (`student_id`),
  INDEX `payment_date` (`payment_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `admissions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `application_no` VARCHAR(50) UNIQUE NOT NULL,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `date_of_birth` DATE,
  `gender` ENUM('Male','Female','Other'),
  `state_of_origin` VARCHAR(100),
  `religion` ENUM('Christianity','Islam','Other'),
  `unit_applied` VARCHAR(100),
  `parent_name` VARCHAR(150),
  `parent_phone` VARCHAR(20),
  `parent_email` VARCHAR(100),
  `home_address` TEXT,
  `previous_school` VARCHAR(150),
  `class_last_attended` VARCHAR(50),
  `application_date` DATE NOT NULL,
  `status` ENUM('pending','approved','rejected') DEFAULT 'pending',
  `approved_by` INT,
  `approval_date` DATE,
  `approval_code_hash` VARCHAR(255),
  `approval_code_generated_at` DATETIME,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`approved_by`) REFERENCES `staff`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `timetables` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `class_id` INT NOT NULL,
  `day_of_week` ENUM('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
  `period` INT NOT NULL,
  `start_time` TIME,
  `end_time` TIME,
  `subject_id` INT,
  `teacher_id` INT,
  `venue` VARCHAR(100),
  `academic_session` VARCHAR(20),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `unique_timetable` (`class_id`, `day_of_week`, `period`, `academic_session`),
  FOREIGN KEY (`class_id`) REFERENCES `classes`(`id`),
  FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`),
  FOREIGN KEY (`teacher_id`) REFERENCES `staff`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `login_sessions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `staff_id` INT NOT NULL,
  `session_token` VARCHAR(255) UNIQUE,
  `ip_address` VARCHAR(45),
  `user_agent` TEXT,
  `login_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `last_activity` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `logout_time` TIMESTAMP NULL,
  FOREIGN KEY (`staff_id`) REFERENCES `staff`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `student_login_sessions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_id` INT NOT NULL,
  `session_token` VARCHAR(255) UNIQUE,
  `ip_address` VARCHAR(45),
  `user_agent` TEXT,
  `login_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `last_activity` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `logout_time` TIMESTAMP NULL,
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data for units
INSERT INTO `units` (`name`, `code`, `description`) VALUES
('Nursery School', 'NUR', 'Nursery, Pre-Nursery and foundation classes'),
('Primary School', 'PRI', 'Primary 1 to Primary 6'),
('Secondary School', 'SEC', 'Junior and Senior Secondary School'),
('Arabic / Islamic Unit', 'ARA', 'Quranic and Islamic Studies');

-- Insert sample staff data
INSERT INTO `staff` (`staff_id`, `first_name`, `last_name`, `email`, `phone`, `password_hash`, `role`, `unit_id`, `subject`, `qualification`, `hire_date`, `status`, `address`) VALUES
('PAA-ST-001', 'Samuel', 'Dung', 'samuel.dung@paa.edu.ng', '+234 800 000 0001', '$2y$10$abcdef1234567890abcdef1234567890abcdef', 'principal', NULL, NULL, 'B.Sc Education, M.A Leadership', '2005-01-15', 'active', 'Jos, Plateau State'),
('PAA-ST-002', 'Amaka', 'Uche', 'amaka.uche@paa.edu.ng', '+234 800 000 0002', '$2y$10$abcdef1234567890abcdef1234567890abcdef', 'unit_head', 3, 'English Language', 'B.Sc English, PGDE', '2010-09-01', 'active', 'Jos'),
('PAA-ST-003', 'Elisha', 'Pwol', 'elisha.pwol@paa.edu.ng', '+234 800 000 0003', '$2y$10$abcdef1234567890abcdef1234567890abcdef', 'unit_head', 2, 'Mathematics', 'B.Sc Mathematics, PGDE', '2010-01-15', 'active', 'Jos'),
('PAA-ST-004', 'Grace', 'Longs', 'grace.longs@paa.edu.ng', '+234 800 000 0004', '$2y$10$abcdef1234567890abcdef1234567890abcdef', 'unit_head', 1, 'Early Childhood', 'Diploma in Early Childhood', '2012-06-01', 'active', 'Jos'),
('PAA-ST-005', 'Umar', 'Sani', 'umar.sani@paa.edu.ng', '+234 800 000 0005', '$2y$10$abcdef1234567890abcdef1234567890abcdef', 'unit_head', 4, 'Arabic Language', 'B.A Arabic, PGDE', '2015-08-01', 'active', 'Jos'),
('PAA-ST-006', 'Ngozi', 'Obi', 'ngozi.obi@paa.edu.ng', '+234 800 000 0006', '$2y$10$abcdef1234567890abcdef1234567890abcdef', 'finance', NULL, NULL, 'B.Sc Accounting', '2012-03-01', 'active', 'Jos'),
('PAA-ST-007', 'Fatima', 'Sani', 'fatima.sani@paa.edu.ng', '+234 800 000 0007', '$2y$10$abcdef1234567890abcdef1234567890abcdef', 'teacher', 3, 'Biology', 'B.Sc Biology, PGDE', '2018-09-01', 'active', 'Jos'),
('PAA-ST-008', 'James', 'Lar', 'james.lar@paa.edu.ng', '+234 800 000 0008', '$2y$10$abcdef1234567890abcdef1234567890abcdef', 'teacher', 3, 'Physics', 'B.Sc Physics, PGDE', '2016-01-15', 'on_leave', 'Jos');

-- Insert sample subjects
INSERT INTO `subjects` (`name`, `code`, `unit_id`) VALUES
('Mathematics', 'MATH', 3),
('English Language', 'ENG', 3),
('Basic Science', 'SCI', 3),
('Social Studies', 'SOCI', 3),
('Agric Science', 'AGRI', 3),
('Civic Education', 'CIVI', 3),
('Arabic Language', 'ARAB', 3),
('Computer Studies', 'COMP', 3),
('Physical Education', 'PE', 3);
