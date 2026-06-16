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
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            throw new Exception("Database Connection Failed: " . $e->getMessage());
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
