-- ============================================================
-- Plan Aid Academy - Migration: Dedicated Finance Portal Tables
-- Run against database to set up advanced fee structures,
-- student financial accounts, charges, discounts & receipt logs.
-- ============================================================

-- 1. FEE STRUCTURES TABLE
CREATE TABLE IF NOT EXISTS `fee_structures` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fee_name` VARCHAR(150) NOT NULL,
  `fee_code` VARCHAR(30) UNIQUE NOT NULL,
  `unit_id` INT NULL,
  `target_class` VARCHAR(100) DEFAULT 'All Classes',
  `academic_session` VARCHAR(20) DEFAULT '2025/2026',
  `term` ENUM('1st','2nd','3rd','full_year') DEFAULT '1st',
  `amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `description` TEXT NULL,
  `is_mandatory` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`unit_id`) REFERENCES `units`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default fee structures if empty
INSERT IGNORE INTO `fee_structures` (`id`, `fee_name`, `fee_code`, `target_class`, `academic_session`, `term`, `amount`, `description`) VALUES
(1, 'Secondary Tuition Fee', 'FEE-SEC-TUI', 'Secondary School', '2025/2026', '1st', 45000.00, 'Standard terminal tuition fee for secondary students'),
(2, 'Primary Tuition Fee', 'FEE-PRI-TUI', 'Primary School', '2025/2026', '1st', 35000.00, 'Standard terminal tuition fee for primary students'),
(3, 'Nursery Tuition Fee', 'FEE-NUR-TUI', 'Nursery School', '2025/2026', '1st', 28000.00, 'Foundation nursery tuition fee'),
(4, 'Arabic Unit Tuition Fee', 'FEE-ARB-TUI', 'Arabic Unit', '2025/2026', '1st', 25000.00, 'Qur\'an and Arabic unit tuition fee'),
(5, 'Science & ICT Lab Levy', 'FEE-STEM-LAB', 'Secondary School', '2025/2026', '1st', 10000.00, 'Practical lab, coding, and robotics equipment levy'),
(6, 'Development & Exam Levy', 'FEE-DEV-EXM', 'All Classes', '2025/2026', '1st', 5000.00, 'School facility development and exam printing levy');

-- 2. INDIVIDUAL STUDENT CHARGES
CREATE TABLE IF NOT EXISTS `student_charges` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_id` INT NOT NULL,
  `charge_name` VARCHAR(150) NOT NULL,
  `amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `academic_session` VARCHAR(20) DEFAULT '2025/2026',
  `term` ENUM('1st','2nd','3rd') DEFAULT '1st',
  `reason` TEXT NULL,
  `created_by` INT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. STUDENT DISCOUNTS TABLE
CREATE TABLE IF NOT EXISTS `student_discounts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_id` INT NOT NULL,
  `discount_type` VARCHAR(100) NOT NULL, -- e.g. Scholarship, Sibling Discount, Staff Child, Early Bird
  `discount_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `academic_session` VARCHAR(20) DEFAULT '2025/2026',
  `term` ENUM('1st','2nd','3rd') DEFAULT '1st',
  `authorized_by` INT NULL,
  `notes` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`authorized_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. RECEIPTS LOG TABLE
CREATE TABLE IF NOT EXISTS `receipts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `receipt_no` VARCHAR(50) UNIQUE NOT NULL,
  `payment_id` INT NULL,
  `student_id` INT NOT NULL,
  `amount_paid` DECIMAL(12,2) NOT NULL,
  `payment_date` DATE NOT NULL,
  `payment_method` VARCHAR(50) DEFAULT 'Cash',
  `reference_no` VARCHAR(100) NULL,
  `academic_session` VARCHAR(20) DEFAULT '2025/2026',
  `term` ENUM('1st','2nd','3rd') DEFAULT '1st',
  `issued_by` INT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`issued_by`) REFERENCES `staff`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
