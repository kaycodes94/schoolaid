-- ============================================================
-- Plan Aid Academy - Migration: Student Portal Login Columns
-- Run this once against your plan_aid_academy database
-- to enable student portal access (login details management)
-- ============================================================

-- Add student_id_number: unique short ID shown in the portal (e.g. STD-2024-0001)
ALTER TABLE `students`
  ADD COLUMN IF NOT EXISTS `student_id_number` VARCHAR(50) UNIQUE AFTER `admission_no`;

-- Add email: optional student / parent contact email for portal login
ALTER TABLE `students`
  ADD COLUMN IF NOT EXISTS `email` VARCHAR(100) UNIQUE AFTER `student_id_number`;

-- Add username: chosen or auto-generated portal username
ALTER TABLE `students`
  ADD COLUMN IF NOT EXISTS `username` VARCHAR(100) UNIQUE AFTER `email`;

-- Add password_hash: bcrypt hash of the student's portal password
ALTER TABLE `students`
  ADD COLUMN IF NOT EXISTS `password_hash` VARCHAR(255) AFTER `username`;

-- Add a composite index for fast login lookups
ALTER TABLE `students`
  ADD INDEX IF NOT EXISTS `idx_student_login` (`student_id_number`, `username`, `email`);

-- ============================================================
-- Optional: auto-populate student_id_number for existing rows
-- ============================================================
-- Updates any student without an ID to PAA-STD-<zero-padded id>
UPDATE `students`
  SET `student_id_number` = CONCAT('PAA-STD-', LPAD(id, 4, '0'))
  WHERE `student_id_number` IS NULL OR `student_id_number` = '';
