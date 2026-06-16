<?php
/**
 * Plan Aid Academy - API Response Handler
 */

class ApiResponse {
    /**
     * Send JSON success response
     */
    public static function success($data = [], $message = 'Success', $code = 200) {
        http_response_code($code);
        echo json_encode([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
        exit();
    }

    /**
     * Send JSON error response
     */
    public static function error($message = 'Error', $code = 400, $errors = []) {
        http_response_code($code);
        echo json_encode([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        exit();
    }

    /**
     * Validate required fields
     */
    public static function validateRequired($data, $required = []) {
        $missing = [];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                $missing[] = $field;
            }
        }
        return $missing;
    }
}

/**
 * Plan Aid Academy - Utilities
 */
class Utilities {
    /**
     * Generate application/admission number
     */
    public static function generateApplicationNo($year = null) {
        if (!$year) {
            $year = date('Y');
        }
        // Format: PAA-YYYY-XXXX
        $random = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        return 'PAA-' . $year . '-' . $random;
    }

    /**
     * Generate staff ID
     */
    public static function generateStaffId($role = 'ST') {
        // Format: PAA-ROLE-XXXX
        $random = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        return 'PAA-' . $role . '-' . $random;
    }

    /**
     * Generate approval code for student/staff portal access
     */
    public static function generateApprovalCode($length = 8) {
        $alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';
        $max = strlen($alphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $code .= $alphabet[random_int(0, $max)];
        }
        return 'PAA-' . $code;
    }

    /**
     * Generate receipt number for payments
     */
    public static function generateReceiptNo() {
        // Format: RCP-XXXXX
        return 'RCP-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }

    /**
     * Calculate grade from total score
     */
    public static function calculateGrade($total) {
        if ($total >= 90) return 'A';
        if ($total >= 80) return 'B';
        if ($total >= 70) return 'C';
        if ($total >= 60) return 'D';
        if ($total >= 50) return 'E';
        return 'F';
    }

    /**
     * Get grade remark
     */
    public static function getGradeRemark($total) {
        if ($total >= 90) return 'Excellent';
        if ($total >= 80) return 'Very Good';
        if ($total >= 70) return 'Good';
        if ($total >= 60) return 'Average';
        if ($total >= 50) return 'Below Average';
        return 'Poor';
    }

    /**
     * Format currency
     */
    public static function formatCurrency($amount) {
        return '₦' . number_format($amount, 2);
    }

    /**
     * Hash password (bcrypt)
     */
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Verify password
     */
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * Generate secure token
     */
    public static function generateToken($length = 32) {
        return bin2hex(random_bytes($length));
    }

    /**
     * Sanitize input
     */
    public static function sanitize($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Validate email
     */
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validate phone
     */
    public static function validatePhone($phone) {
        // Nigeria format: +234XXXXXXXXXX or 0XXXXXXXXXX
        return preg_match('/^(\+234|0)[0-9]{10}$/', str_replace(' ', '', $phone));
    }

    /**
     * Get date range for academic term
     */
    public static function getTermDateRange($term, $year) {
        $ranges = [
            '1st' => ['start' => "{$year}-09-01", 'end' => "{$year}-12-31"],
            '2nd' => ['start' => "{$year}-01-01", 'end' => "{$year}-03-31"],
            '3rd' => ['start' => "{$year}-04-01", 'end' => "{$year}-06-30"]
        ];
        return $ranges[$term] ?? null;
    }

    /**
     * Get age from date of birth
     */
    public static function getAge($dob) {
        $date = new DateTime($dob);
        $now = new DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }

    /**
     * Log activity
     */
    public static function logActivity($description, $user_id = null, $ip = null) {
        $file = __DIR__ . '/../logs/activity.log';
        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0755, true);
        }
        $log = date('Y-m-d H:i:s') . " | User: {$user_id} | IP: {$ip} | {$description}\n";
        file_put_contents($file, $log, FILE_APPEND);
    }
}

/**
 * Plan Aid Academy - Validator
 */
class Validator {
    private $errors = [];

    /**
     * Validate admission form
     */
    public function validateAdmission($data) {
        if (empty($data['unit_applied'])) {
            $this->errors['unit_applied'] = 'School unit is required';
        }
        if (empty($data['last_name'])) {
            $this->errors['last_name'] = 'Surname is required';
        }
        if (empty($data['first_name'])) {
            $this->errors['first_name'] = 'First name is required';
        }
        if (!empty($data['date_of_birth']) && !strtotime($data['date_of_birth'])) {
            $this->errors['date_of_birth'] = 'Invalid date of birth';
        }
        if (!empty($data['parent_phone']) && !Utilities::validatePhone($data['parent_phone'])) {
            $this->errors['parent_phone'] = 'Invalid phone number';
        }
        return empty($this->errors);
    }

    /**
     * Validate staff login
     */
    public function validateLogin($data) {
        if (empty($data['staff_id'])) {
            $this->errors['staff_id'] = 'Staff ID is required';
        }
        if (empty($data['password'])) {
            $this->errors['password'] = 'Password is required';
        }
        return empty($this->errors);
    }

    /**
     * Validate result entry
     */
    public function validateResult($data) {
        if (empty($data['student_id'])) {
            $this->errors['student_id'] = 'Student ID is required';
        }
        if (empty($data['subject_id'])) {
            $this->errors['subject_id'] = 'Subject is required';
        }
        if (!isset($data['continuous_assessment'])) {
            $this->errors['continuous_assessment'] = 'Continuous assessment is required';
        } elseif ($data['continuous_assessment'] < 0 || $data['continuous_assessment'] > 40) {
            $this->errors['continuous_assessment'] = 'CA must be between 0 and 40';
        }
        if (!isset($data['exam_score'])) {
            $this->errors['exam_score'] = 'Exam score is required';
        } elseif ($data['exam_score'] < 0 || $data['exam_score'] > 60) {
            $this->errors['exam_score'] = 'Exam score must be between 0 and 60';
        }
        return empty($this->errors);
    }

    /**
     * Validate payment
     */
    public function validatePayment($data) {
        if (empty($data['student_id'])) {
            $this->errors['student_id'] = 'Student ID is required';
        }
        if (empty($data['amount_paid']) || $data['amount_paid'] <= 0) {
            $this->errors['amount_paid'] = 'Valid payment amount is required';
        }
        if (empty($data['payment_date']) || !strtotime($data['payment_date'])) {
            $this->errors['payment_date'] = 'Valid payment date is required';
        }
        return empty($this->errors);
    }

    /**
     * Get errors
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Get error message
     */
    public function getErrorMessage() {
        if (empty($this->errors)) {
            return '';
        }
        return implode(', ', $this->errors);
    }
}
