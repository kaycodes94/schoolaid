<?php
/**
 * School Aid Management System — User Removal Script
 * Removes user records associated with jamesotokpa2017@gmail.com
 */

header('Content-Type: application/json');
require_once __DIR__ . '/config/Database.php';

$targetEmail = 'jamesotokpa2017@gmail.com';

try {
    $db = new Database();
    $removed = [];

    // Delete from staff
    $stmt1 = $db->query("DELETE FROM staff WHERE email = ?", [$targetEmail]);
    $removed['staff'] = $stmt1->rowCount();

    // Delete from students
    $stmt2 = $db->query("DELETE FROM students WHERE email = ? OR parent_email = ?", [$targetEmail, $targetEmail]);
    $removed['students'] = $stmt2->rowCount();

    // Delete from teacher_registrations
    $stmt3 = $db->query("DELETE FROM teacher_registrations WHERE email = ?", [$targetEmail]);
    $removed['teacher_registrations'] = $stmt3->rowCount();

    // Delete from student_registrations
    $stmt4 = $db->query("DELETE FROM student_registrations WHERE email = ?", [$targetEmail]);
    $removed['student_registrations'] = $stmt4->rowCount();

    echo json_encode([
        'status' => 'success',
        'message' => "User {$targetEmail} successfully removed from database records.",
        'details' => $removed
    ], JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error executing removal: ' . $e->getMessage()
    ], JSON_PRETTY_PRINT);
}
