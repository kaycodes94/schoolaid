<?php
/**
 * Plan Aid Academy - Database Configuration
 * PDO Database Connection Configuration
 */

// Database credentials
define('DB_HOST', '127.0.0.1');
define('DB_PORT', 3306);
define('DB_NAME', 'plan_aid_academy');
define('DB_USER', 'root');
define('DB_PASS', '');  // Change to your XAMPP MySQL password if any

// PDO Connection Options
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', 'utf8mb4_unicode_ci');

/**
 * Database Class - Handles all PDO connections
 */
class Database {
    private $pdo;
    private $error;

    public function __construct() {
        $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
            $this->ensureSchemaReady();
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            throw new Exception("Database Connection Failed: " . $e->getMessage());
        }
    }

    /**
     * Ensure required tables and columns exist
     */
    private function ensureSchemaReady() {
        try {
            @$this->pdo->exec("ALTER TABLE `staff` ADD COLUMN IF NOT EXISTS `must_change_password` TINYINT(1) DEFAULT 1, ADD COLUMN IF NOT EXISTS `assigned_classes` VARCHAR(255) NULL");
            @$this->pdo->exec("ALTER TABLE `students` ADD COLUMN IF NOT EXISTS `must_change_password` TINYINT(1) DEFAULT 1, ADD COLUMN IF NOT EXISTS `academic_session` VARCHAR(20) DEFAULT '2025/2026'");
            @$this->pdo->exec("CREATE TABLE IF NOT EXISTS `password_resets` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `email_or_id` VARCHAR(150) NOT NULL,
                `user_type` ENUM('staff','student') NOT NULL,
                `user_id` INT NOT NULL,
                `token` VARCHAR(255) UNIQUE NOT NULL,
                `otp_code` VARCHAR(10) NULL,
                `expires_at` DATETIME NOT NULL,
                `used` TINYINT(1) DEFAULT 0,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
            @$this->pdo->exec("CREATE TABLE IF NOT EXISTS `audit_logs` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `actor_type` ENUM('staff','student','system') NOT NULL,
                `actor_id` INT NULL,
                `actor_name` VARCHAR(200) NULL,
                `action` VARCHAR(100) NOT NULL,
                `resource_type` VARCHAR(100) NULL,
                `resource_id` INT NULL,
                `description` TEXT NOT NULL,
                `ip_address` VARCHAR(45) NULL,
                `user_agent` TEXT NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        } catch (Exception $e) {
            // Ignore if mysql user lacks schema modification privileges
        }
    }

    /**
     * Prepare a query
     */
    public function prepare($query) {
        return $this->pdo->prepare($query);
    }

    /**
     * Execute a prepared statement
     */
    public function execute($stmt, $params = []) {
        try {
            if (!empty($params)) {
                $stmt->execute($params);
            } else {
                $stmt->execute();
            }
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Query Execution Error: " . $e->getMessage());
        }
    }

    /**
     * Fetch one record
     */
    public function fetch($query, $params = []) {
        $stmt = $this->prepare($query);
        $this->execute($stmt, $params);
        return $stmt->fetch();
    }

    /**
     * Fetch all records
     */
    public function fetchAll($query, $params = []) {
        $stmt = $this->prepare($query);
        $this->execute($stmt, $params);
        return $stmt->fetchAll();
    }

    /**
     * Insert record and return last insert ID
     */
    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $query = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        
        $stmt = $this->prepare($query);
        $this->execute($stmt, array_values($data));
        return $this->pdo->lastInsertId();
    }

    /**
     * Update record
     */
    public function update($table, $data, $where) {
        $set = [];
        $params = [];
        
        foreach ($data as $key => $value) {
            $set[] = "{$key} = ?";
            $params[] = $value;
        }
        
        $whereClause = [];
        foreach ($where as $key => $value) {
            $whereClause[] = "{$key} = ?";
            $params[] = $value;
        }
        
        $query = "UPDATE {$table} SET " . implode(', ', $set) . " WHERE " . implode(' AND ', $whereClause);
        $stmt = $this->prepare($query);
        return $this->execute($stmt, $params);
    }

    /**
     * Delete record
     */
    public function delete($table, $where) {
        $whereClause = [];
        $params = [];
        
        foreach ($where as $key => $value) {
            $whereClause[] = "{$key} = ?";
            $params[] = $value;
        }
        
        $query = "DELETE FROM {$table} WHERE " . implode(' AND ', $whereClause);
        $stmt = $this->prepare($query);
        return $this->execute($stmt, $params);
    }

    /**
     * Count records
     */
    public function count($table, $where = []) {
        $query = "SELECT COUNT(*) as count FROM {$table}";
        $params = [];
        
        if (!empty($where)) {
            $whereClause = [];
            foreach ($where as $key => $value) {
                $whereClause[] = "{$key} = ?";
                $params[] = $value;
            }
            $query .= " WHERE " . implode(' AND ', $whereClause);
        }
        
        $result = $this->fetch($query, $params);
        return $result['count'] ?? 0;
    }

    /**
     * Begin transaction
     */
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public function commit() {
        return $this->pdo->commit();
    }

    /**
     * Rollback transaction
     */
    public function rollBack() {
        return $this->pdo->rollBack();
    }

    /**
     * Get PDO connection
     */
    public function getConnection() {
        return $this->pdo;
    }

    /**
     * Get last error
     */
    public function getError() {
        return $this->error;
    }
}

// Create database instance
$db = new Database();
