# Plan Aid Academy - School Management System
## Backend Setup Guide & API Documentation

### 📋 Project Structure

```
aidstudent/
├── config/
│   └── Database.php           # PDO Database configuration & class
├── api/
│   ├── admissions.php         # Admissions API
│   ├── auth.php               # Authentication & Login API
│   ├── results.php            # Results Management API
│   ├── finance.php            # Finance & Payment API
│   └── students.php           # Student Management API
├── includes/
│   └── Helpers.php            # Utility functions & validators
├── database.sql               # Database schema & sample data
└── plan-aid-academy (1).html  # Frontend application
```

---

## 🚀 Quick Setup

### Step 1: Create Database

1. **Open phpMyAdmin** (http://localhost/phpmyadmin)
2. **Create a new database** named `plan_aid_academy`
3. **Import the database schema:**
   - Go to `Import` tab
   - Upload [database.sql](database.sql)
   - Click `Go`

### Step 2: Configure Database Connection

Edit `config/Database.php`:

```php
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_NAME', 'plan_aid_academy');
define('DB_USER', 'root');
define('DB_PASS', '');  // Your XAMPP MySQL password
```

### Step 3: Test Connection

Create a test file `test-connection.php`:

```php
<?php
require_once 'config/Database.php';

try {
    $db = new Database();
    echo "✓ Database connection successful!";
} catch (Exception $e) {
    echo "✗ Connection failed: " . $e->getMessage();
}
?>
```

Visit: `http://localhost/aidstudent/test-connection.php`

---

## 🔐 API Endpoints Documentation

### 1. ADMISSIONS API
**Base URL:** `/api/admissions.php`

#### Submit New Admission Application
```http
POST /api/admissions.php
Content-Type: application/json

{
    "first_name": "John",
    "last_name": "Doe",
    "date_of_birth": "2015-05-10",
    "gender": "Male",
    "state_of_origin": "Plateau",
    "religion": "Christianity",
    "unit_applied": "Primary School (Primary 1 – 6)",
    "parent_name": "Mr. James Doe",
    "parent_phone": "+234 800 123 4567",
    "parent_email": "james@email.com",
    "home_address": "123 Main Street, Jos",
    "previous_school": "XYZ Primary School",
    "class_last_attended": "Primary 3"
}
```

**Response (201):**
```json
{
    "status": "success",
    "message": "Admission application submitted successfully",
    "data": {
        "admission_id": 1,
        "application_no": "PAA-2025-0042",
        "full_name": "John Doe",
        "unit_applied": "Primary School",
        "application_date": "2025-05-24",
        "status": "pending"
    }
}
```

#### List Admissions
```http
GET /api/admissions.php?action=list&status=pending&limit=50&offset=0
```

#### Get Pending Admissions
```http
GET /api/admissions.php?action=pending
```

---

### 2. AUTHENTICATION API
**Base URL:** `/api/auth.php`

#### Staff Login
```http
POST /api/auth.php
Content-Type: application/json

{
    "staff_id": "PAA-ST-001",
    "password": "your_password"
}
```

**Response (200):**
```json
{
    "status": "success",
    "message": "Login successful",
    "data": {
        "token": "abc123xyz456...",
        "staff_id": "PAA-ST-001",
        "name": "Samuel Dung",
        "email": "samuel.dung@paa.edu.ng",
        "role": "principal",
        "unit": {
            "id": 1,
            "name": "Nursery School",
            "code": "NUR"
        },
        "avatar_initials": "SD"
    }
}
```

#### Verify Session
```http
GET /api/auth.php?action=verify&token=your_token_here
```

#### Get User Info
```http
GET /api/auth.php?action=user&token=your_token_here
```

#### Logout
```http
GET /api/auth.php?action=logout&token=your_token_here
```

---

### 3. RESULTS API
**Base URL:** `/api/results.php`

#### Get Student Results
```http
GET /api/results.php?action=get&admission_no=PAA-2023-0047&session=2024/2025&term=1st
```

**Response:**
```json
{
    "status": "success",
    "data": {
        "student": {
            "admission_no": "PAA-2023-0047",
            "name": "Aisha Mohammed",
            "class": "JSS 2A",
            "unit": 3
        },
        "academic_session": "2024/2025",
        "results": [
            {
                "id": 1,
                "subject_name": "Mathematics",
                "continuous_assessment": 34,
                "exam_score": 52,
                "total_score": 86,
                "grade": "A",
                "remark": "Excellent"
            }
        ],
        "statistics": {
            "total_subjects": 7,
            "total_score": 578,
            "average": 82.57,
            "grade_a": 4,
            "grade_b": 2,
            "grade_c": 1
        }
    }
}
```

#### Enter Results
```http
POST /api/results.php
Content-Type: application/json

{
    "student_id": 1,
    "subject_id": 1,
    "class_id": 5,
    "academic_session": "2024/2025",
    "term": "1st",
    "continuous_assessment": 34,
    "exam_score": 52,
    "staff_id": 1
}
```

#### Get Class Results
```http
GET /api/results.php?action=class&class_id=5&session=2024/2025&term=1st
```

#### Get Result Statistics
```http
GET /api/results.php?action=statistics&class_id=5&session=2024/2025
```

---

### 4. FINANCE API
**Base URL:** `/api/finance.php`

#### Record Payment
```http
POST /api/finance.php
Content-Type: application/json

{
    "student_id": 1,
    "amount_paid": 65000,
    "payment_date": "2025-05-24",
    "academic_session": "2024/2025",
    "term": "1st",
    "payment_method": "bank_transfer",
    "reference": "TRANSFER_REF_001",
    "staff_id": 6,
    "remarks": "Full payment received"
}
```

**Response (201):**
```json
{
    "status": "success",
    "message": "Payment recorded successfully",
    "data": {
        "payment_id": 1,
        "receipt_no": "RCP-12345",
        "amount_paid": 65000,
        "payment_date": "2025-05-24",
        "status": "confirmed"
    }
}
```

#### Get All Payments
```http
GET /api/finance.php?action=payments&limit=50&offset=0&session=2024/2025
```

#### Get Student Payments
```http
GET /api/finance.php?action=student&admission_no=PAA-2023-0047&session=2024/2025
```

#### Get Outstanding Fees
```http
GET /api/finance.php?action=outstanding&session=2024/2025&limit=100
```

#### Get Finance Summary
```http
GET /api/finance.php?action=summary&session=2024/2025
```

**Response:**
```json
{
    "status": "success",
    "data": {
        "academic_session": "2024/2025",
        "total_revenue": 18400000,
        "revenue_by_unit": [
            {"name": "Secondary School", "total": 8200000},
            {"name": "Primary School", "total": 5400000}
        ],
        "revenue_by_term": [
            {"term": "1st", "total": 12100000},
            {"term": "2nd", "total": 6300000}
        ],
        "active_students": 1240,
        "currency": "₦"
    }
}
```

---

### 5. STUDENTS API
**Base URL:** `/api/students.php`

#### Get Student
```http
GET /api/students.php?action=get&admission_no=PAA-2023-0047
```

#### List Students
```http
GET /api/students.php?action=list&unit=3&status=active&limit=50&search=aisha
```

#### Get Class Students
```http
GET /api/students.php?action=class&class_id=5&session=2024/2025
```

#### Create Student from Admission
```http
POST /api/students.php
Content-Type: application/json

{
    "admission_id": 1,
    "unit_id": 2,
    "class_id": 5,
    "staff_id": 1
}
```

#### Update Student
```http
PUT /api/students.php?id=1
Content-Type: application/json

{
    "current_class": "Primary 4",
    "parent_phone": "+234 800 987 6543",
    "status": "active"
}
```

---

## 📊 Database Schema Overview

### Key Tables

| Table | Purpose |
|-------|---------|
| `units` | School units (Nursery, Primary, Secondary, Arabic) |
| `staff` | Staff members and authentication |
| `students` | Student records |
| `classes` | Classes and class information |
| `class_enrollment` | Student enrollment in classes |
| `subjects` | Subjects/courses |
| `results` | Student grades and scores |
| `payments` | Payment records |
| `admissions` | Admission applications |
| `attendance` | Student attendance tracking |
| `fees` | Fee structure |
| `timetables` | Class timetables |
| `login_sessions` | Staff session management |

---

## 🔒 Security Considerations

1. **Password Hashing**: All passwords use bcrypt (PASSWORD_BCRYPT)
   ```php
   $hashedPassword = Utilities::hashPassword($password);
   ```

2. **Session Tokens**: Generated using `random_bytes()` for cryptographic security
   ```php
   $token = Utilities::generateToken();
   ```

3. **SQL Injection Prevention**: All queries use prepared statements with parameterized inputs
   ```php
   $stmt = $db->prepare($query);
   $stmt->execute([$param1, $param2]);
   ```

4. **Input Sanitization**: All user input is sanitized
   ```php
   $name = Utilities::sanitize($input['name']);
   ```

5. **CORS Headers**: Configured for cross-origin requests (modify as needed)

---

## 🧪 Testing the APIs

### Using cURL (Command Line)

**Test Admission Submission:**
```bash
curl -X POST http://localhost/aidstudent/api/admissions.php \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "John",
    "last_name": "Doe",
    "unit_applied": "Primary School",
    "parent_name": "Mr. James",
    "parent_phone": "+234 800 123 4567"
  }'
```

**Test Login:**
```bash
curl -X POST http://localhost/aidstudent/api/auth.php \
  -H "Content-Type: application/json" \
  -d '{
    "staff_id": "PAA-ST-001",
    "password": "your_password"
  }'
```

### Using Postman

1. Import the endpoints into Postman
2. Set variables for base URL: `http://localhost/aidstudent`
3. Use environment variables for tokens from login response

---

## 🛠️ Sample Data

The database schema includes sample data:

**Staff Members:**
- **Principal**: Samuel Dung (PAA-ST-001)
- **Finance**: Ngozi Obi (PAA-ST-006)
- **Unit Heads**: Heads for Nursery, Primary, Secondary, and Arabic units

**Units:**
- Nursery School
- Primary School
- Secondary School
- Arabic / Islamic Unit

**Subjects:** Math, English, Science, Social Studies, Arabic, etc.

---

## 📝 Utility Functions Reference

### Helpers.php Classes

#### ApiResponse
- `success($data, $message, $code)` - Send success response
- `error($message, $code, $errors)` - Send error response
- `validateRequired($data, $required)` - Validate required fields

#### Utilities
- `generateApplicationNo()` - Generate unique admission number
- `generateStaffId()` - Generate staff ID
- `generateReceiptNo()` - Generate payment receipt
- `calculateGrade($total)` - Convert score to grade
- `hashPassword($password)` - Bcrypt password
- `verifyPassword($password, $hash)` - Verify password
- `generateToken()` - Generate secure token
- `sanitize($input)` - Sanitize input
- `validateEmail($email)` - Validate email format
- `validatePhone($phone)` - Validate Nigerian phone numbers
- `getAge($dob)` - Calculate age from DOB
- `logActivity($description)` - Log activities

#### Validator
- `validateAdmission($data)` - Validate admission form
- `validateLogin($data)` - Validate login credentials
- `validateResult($data)` - Validate result entry
- `validatePayment($data)` - Validate payment data
- `getErrors()` - Get validation errors

---

## 🔗 Frontend Integration

The HTML frontend already has functions ready to integrate with these APIs:

```javascript
// Update admissions submission in HTML to call API
function submitAdmission() {
    const formData = {
        unit_applied: document.getElementById('admUnit').value,
        first_name: document.getElementById('admFirst').value,
        last_name: document.getElementById('admSurname').value,
        // ... other fields
    };
    
    fetch('/api/admissions.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            // Show success and display application number
            document.getElementById('slipNo').textContent = data.data.application_no;
        }
    });
}
```

---

## 📞 Support & Troubleshooting

### Common Issues

1. **"Database Connection Failed"**
   - Check database credentials in `config/Database.php`
   - Ensure XAMPP MySQL is running
   - Verify database name is correct

2. **"Table doesn't exist"**
   - Re-import the database.sql file
   - Check for errors during import

3. **"Invalid or expired token"**
   - Tokens expire after 24 hours
   - User needs to login again

4. **"Validation failed"**
   - Check required fields in request body
   - Validate phone format: +234XXXXXXXXXX

---

## 📚 Additional Resources

- [PDO Documentation](https://www.php.net/manual/en/book.pdo.php)
- [Password Hashing](https://www.php.net/manual/en/function.password-hash.php)
- [REST API Best Practices](https://restfulapi.net/)

---

**Last Updated:** May 24, 2026  
**Version:** 1.0.0
