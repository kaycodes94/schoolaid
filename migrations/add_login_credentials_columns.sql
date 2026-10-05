-- ============================================================
-- Plan Aid Academy - Migration: Staff & Student Login Credentials
-- Adds must_change_password, account status, password resets & audit logging
-- ============================================================

-- Add must_change_password and assigned_classes to staff
ALTER TABLE `staff`
  ADD COLUMN IF NOT EXISTS `must_change_password` TINYINT(1) DEFAULT 1 AFTER `password_hash`,
  ADD COLUMN IF NOT EXISTS `assigned_classes` VARCHAR(255) NULL AFTER `subject`,
  MODIFY COLUMN `status` ENUM('active','inactive','suspended','on_leave') DEFAULT 'active';

-- Add must_change_password and academic_session to students
ALTER TABLE `students`
  ADD COLUMN IF NOT EXISTS `must_change_password` TINYINT(1) DEFAULT 1 AFTER `password_hash`,
  ADD COLUMN IF NOT EXISTS `academic_session` VARCHAR(20) DEFAULT '2025/2026' AFTER `current_class`,
  MODIFY COLUMN `status` ENUM('active','inactive','suspended','graduated','withdrawn') DEFAULT 'active';

-- Password resets table for self-service forgot password
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email_or_id` VARCHAR(150) NOT NULL,
  `user_type` ENUM('staff','student') NOT NULL,
  `user_id` INT NOT NULL,
  `token` VARCHAR(255) UNIQUE NOT NULL,
  `otp_code` VARCHAR(10) NULL,
  `expires_at` DATETIME NOT NULL,
  `used` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_reset_token` (`token`),
  INDEX `idx_reset_user` (`user_type`, `user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Audit logs table (if not exists from database_extensions.sql)
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `actor_type` ENUM('staff','student','system') NOT NULL,
  `actor_id` INT NULL,
  `actor_name` VARCHAR(200) NULL,
  `action` VARCHAR(100) NOT NULL COMMENT 'e.g. LOGIN, CREATE_STAFF_ACCOUNT, RESET_PASSWORD',
  `resource_type` VARCHAR(100) NULL COMMENT 'e.g. staff, student',
  `resource_id` INT NULL,
  `description` TEXT NOT NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_audit_actor` (`actor_type`, `actor_id`),
  INDEX `idx_audit_action` (`action`),
  INDEX `idx_audit_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
