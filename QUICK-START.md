# Plan Aid Academy - Quick Start Guide

## 🚀 Get Started in 5 Minutes

### Step 1: Verify Your Environment
```bash
# Open in browser to check if everything is working
http://localhost/aidstudent/setup-check.php
```

### Step 2: Import Database

**Option A - Using phpMyAdmin:**
1. Go to http://localhost/phpmyadmin
2. Click "Create"
3. Enter database name: `plan_aid_academy`
4. Click "Create"
5. Go to "Import" tab
6. Upload `database.sql` from the project folder
7. Click "Go"

**Option B - Using MySQL Command Line:**
```bash
mysql -u root -p < database.sql
```

### Step 3: Update Database Config

Edit `config/Database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_NAME', 'plan_aid_academy');
define('DB_USER', 'root');
define('DB_PASS', 'your_password');  // If you have a password
```

### Step 4: Test It Works

Open in browser:
```
http://localhost/aidstudent/setup-check.php
```

You should see all checks pass ✓

### Step 5: Start Using

**Frontend Application:**
```
http://localhost/aidstudent/plan-aid-academy (1).html
```

**Staff Login Credentials (Sample):**
```
Staff ID: PAA-ST-001
Password: [check database for hashed password]
```

---

## 📁 Project Structure

```
aidstudent/
├── api/                           # REST API Endpoints
│   ├── admissions.php            # Submit & manage admissions
│   ├── auth.php                  # Staff login & authentication
│   ├── results.php               # Student results & grades
│   ├── finance.php               # Payment & fee management
│   └── students.php              # Student records
├── config/
│   └── Database.php              # PDO database connection
├── includes/
│   └── Helpers.php               # Utilities & validators
├── js/
│   └── api-integration.js        # Frontend integration
├── database.sql                  # Database schema
├── plan-aid-academy (1).html     # Main frontend
├── README.md                     # Full documentation
├── setup-check.php               # Verification script
└── QUICK-START.md               # This file
```

---

## 🔑 Default Staff Accounts

| Staff ID | Role | Name |
|----------|------|------|
| PAA-ST-001 | Principal | Samuel Dung |
| PAA-ST-002 | Unit Head - Secondary | Amaka Uche |
| PAA-ST-003 | Unit Head - Primary | Elisha Pwol |
| PAA-ST-004 | Unit Head - Nursery | Grace Longs |
| PAA-ST-005 | Unit Head - Arabic | Umar Sani |
| PAA-ST-006 | Finance Officer | Ngozi Obi |

**Note:** All passwords in the sample data are hashed. To set passwords, update them via database or use the API registration (if implemented).

---

## 🧪 Quick API Tests

### Test Admission Submission

```bash
curl -X POST http://localhost/aidstudent/api/admissions.php \
  -H "Content-Type: application/json" \
  -d '{
    "first_name": "John",
    "last_name": "Doe",
    "unit_applied": "Primary School",
    "parent_name": "James Doe",
    "parent_phone": "+234 800 123 4567"
  }'
```

### Test Login

```bash
curl -X POST http://localhost/aidstudent/api/auth.php \
  -H "Content-Type: application/json" \
  -d '{
    "staff_id": "PAA-ST-001",
    "password": "test123"
  }'
```

### Get Admissions List

```bash
curl -X GET "http://localhost/aidstudent/api/admissions.php?action=list"
```

### Get Finance Summary

```bash
curl -X GET "http://localhost/aidstudent/api/finance.php?action=summary"
```

---

## 📱 Frontend Features

### Public Pages
- **Home**: Overview & information
- **Admissions**: Submit applications
- **Results**: Check student results
- **Finance**: View fee information
- **Arabic Unit**: Arabic program details

### Staff Dashboard (After Login)
- **Overview**: School statistics
- **Students**: Student list & records
- **Staff**: Staff management
- **Admissions**: Review applications
- **Results**: Enter & manage grades
- **Finance**: Payment tracking
- **Timetable**: Class schedules
- **Reports**: Generate reports

---

## 🔒 Security Features

✓ **Password Hashing**: Bcrypt encryption
✓ **Session Tokens**: Cryptographically secure
✓ **Prepared Statements**: SQL injection protection
✓ **Input Sanitization**: XSS protection
✓ **Token Expiration**: 24-hour session timeout

---

## 🛠️ Common Tasks

### Reset a Password

```php
<?php
require_once 'config/Database.php';

$db = new Database();
$hashedPassword = password_hash('newpassword', PASSWORD_BCRYPT);

$db->update('staff', 
    ['password_hash' => $hashedPassword],
    ['staff_id' => 'PAA-ST-001']
);

echo "Password reset successful!";
?>
```

### Add a New User

```php
<?php
require_once 'config/Database.php';

$db = new Database();

$db->insert('staff', [
    'staff_id' => 'PAA-ST-010',
    'first_name' => 'John',
    'last_name' => 'Smith',
    'email' => 'john@paa.edu.ng',
    'password_hash' => password_hash('password123', PASSWORD_BCRYPT),
    'role' => 'teacher',
    'unit_id' => 3,
    'subject' => 'Mathematics',
    'status' => 'active'
]);

echo "User created successfully!";
?>
```

### Record a Payment

API Call:
```bash
curl -X POST http://localhost/aidstudent/api/finance.php \
  -H "Content-Type: application/json" \
  -d '{
    "student_id": 1,
    "amount_paid": 65000,
    "payment_date": "2025-05-24",
    "academic_session": "2024/2025",
    "term": "1st",
    "payment_method": "cash",
    "staff_id": 6
  }'
```

---

## 📚 File Descriptions

| File | Purpose |
|------|---------|
| `Database.php` | PDO connection & query builder |
| `Helpers.php` | API response, utilities, validators |
| `admissions.php` | Admission applications |
| `auth.php` | Staff login & sessions |
| `results.php` | Grade entry & retrieval |
| `finance.php` | Payment & fee tracking |
| `students.php` | Student records |
| `api-integration.js` | Connect frontend to API |
| `setup-check.php` | Verify installation |

---

## ✅ Verification Checklist

- [ ] Database created (`plan_aid_academy`)
- [ ] Database schema imported (`database.sql`)
- [ ] `config/Database.php` configured with correct credentials
- [ ] `setup-check.php` shows all checks passing
- [ ] Can access frontend at `http://localhost/aidstudent/plan-aid-academy (1).html`
- [ ] Admissions API responds to POST requests
- [ ] Staff can login with sample credentials

---

## 🆘 Troubleshooting

### Problem: Database Connection Failed
**Solution:**
- Check MySQL is running in XAMPP
- Verify credentials in `config/Database.php`
- Ensure database `plan_aid_academy` exists

### Problem: 404 on API endpoints
**Solution:**
- Check all files are in the `api/` folder
- Ensure folder path is `/aidstudent/api/`
- Check file names are exactly as specified

### Problem: Data not saving
**Solution:**
- Check database tables exist (run `database.sql` again)
- Verify file permissions (logs folder writable)
- Check MySQL error logs

### Problem: Can't login after import
**Solution:**
- Password hashes from `database.sql` sample data may need update
- Update password using PHP:
  ```php
  $hash = password_hash('newpass', PASSWORD_BCRYPT);
  ```
- Insert hash into database manually

---

## 📖 Next Steps

1. **Read Full Docs**: [README.md](README.md)
2. **Test All APIs**: Use Postman or curl
3. **Integrate Frontend**: Use `js/api-integration.js`
4. **Customize**: Modify for your needs
5. **Deploy**: Move to production server

---

## 📞 Support

For detailed API documentation, see [README.md](README.md)

For code examples, check `js/api-integration.js`

For testing, use `setup-check.php`

---

**Last Updated:** May 24, 2026
**Status:** ✓ Production Ready
