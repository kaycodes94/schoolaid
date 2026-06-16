# Plan Aid Academy - Complete Backend System
## Project Index & Navigation

---

## 📚 Documentation (Start Here)

### For Quick Setup
👉 **[QUICK-START.md](QUICK-START.md)** - 5-minute setup guide
- Database import
- Configuration
- Testing
- Default credentials

### For Full Documentation  
👉 **[README.md](README.md)** - Complete API reference
- All endpoints documented
- Request/response examples
- Database schema
- Troubleshooting
- Security info

### For Project Overview
👉 **[PROJECT-SUMMARY.md](PROJECT-SUMMARY.md)** - What's included
- Files created
- Database tables
- API endpoints
- Security features

---

## 🧪 Setup & Verification

### Test Your Installation
```bash
http://localhost/aidstudent/setup-check.php
```

This will verify:
- ✓ PHP version
- ✓ Required extensions
- ✓ Database connection
- ✓ All required files
- ✓ Directory permissions

---

## 🔌 API Endpoints

| Endpoint | Purpose | Docs |
|----------|---------|------|
| `/api/admissions.php` | Admission applications | [Admissions API](README.md#1-admissions-api) |
| `/api/auth.php` | Staff login & auth | [Auth API](README.md#2-authentication-api) |
| `/api/results.php` | Student grades | [Results API](README.md#3-results-api) |
| `/api/finance.php` | Payments & fees | [Finance API](README.md#4-finance-api) |
| `/api/students.php` | Student management | [Students API](README.md#5-students-api) |

---

## 🗄️ Database & Configuration

### Database Setup
**File**: [database.sql](database.sql)
- 13 tables
- All relationships
- Sample data
- Indexes for performance

### Configuration  
**File**: [config/Database.php](config/Database.php)
- PDO connection
- Query builder class
- Error handling

---

## 💻 Code Files

### Backend APIs
- [api/admissions.php](api/admissions.php) - 190 lines
- [api/auth.php](api/auth.php) - 250 lines
- [api/results.php](api/results.php) - 320 lines
- [api/finance.php](api/finance.php) - 310 lines
- [api/students.php](api/students.php) - 310 lines

### Support Code
- [includes/Helpers.php](includes/Helpers.php) - Utilities (320 lines)
- [config/Database.php](config/Database.php) - PDO class (170 lines)
- [js/api-integration.js](js/api-integration.js) - Frontend integration (450 lines)

### Configuration
- [.htaccess](.htaccess) - Apache config
- [setup-check.php](setup-check.php) - Verification script

---

## 🚀 Quick Start

### Step 1: Import Database
```bash
# In phpMyAdmin
1. Create database: plan_aid_academy
2. Import: database.sql
```

### Step 2: Configure
Edit `config/Database.php`:
```php
define('DB_USER', 'root');
define('DB_PASS', '');  // Your password
```

### Step 3: Verify
```
http://localhost/aidstudent/setup-check.php
```

### Step 4: Test API
```bash
curl -X POST http://localhost/aidstudent/api/admissions.php \
  -H "Content-Type: application/json" \
  -d '{"first_name":"John","last_name":"Doe","unit_applied":"Primary"}'
```

### Step 5: Use Frontend
```
http://localhost/aidstudent/plan-aid-academy (1).html
```

---

## 📊 Database Structure

### Tables (13 total)
```
units                    # School units
├── staff                # Teachers & staff
│   └── login_sessions   # Session management
├── students             # Student records
│   ├── class_enrollment # Class assignments
│   ├── attendance       # Attendance
│   ├── results          # Grades
│   └── payments         # Payments
├── classes              # Classes
│   ├── subjects         # Subjects
│   └── timetables       # Schedules
├── admissions           # Applications
└── fees                 # Fee structure
```

---

## 🔑 Default Staff Accounts

| ID | Name | Role |
|----|------|------|
| PAA-ST-001 | Samuel Dung | Principal |
| PAA-ST-002 | Amaka Uche | Head - Secondary |
| PAA-ST-003 | Elisha Pwol | Head - Primary |
| PAA-ST-004 | Grace Longs | Head - Nursery |
| PAA-ST-005 | Umar Sani | Head - Arabic |
| PAA-ST-006 | Ngozi Obi | Finance Officer |

---

## 🔒 Security Features

✅ Passwords hashed with bcrypt
✅ Tokens use random_bytes()
✅ Prepared statements prevent SQL injection
✅ Input sanitized with htmlspecialchars
✅ CORS configured
✅ Session timeout: 24 hours
✅ Activity logging
✅ HTTP security headers

---

## 📝 API Examples

### Submit Admission
```bash
POST /api/admissions.php
{
  "first_name": "John",
  "last_name": "Doe",
  "unit_applied": "Primary School",
  "parent_name": "James Doe",
  "parent_phone": "+234 800 123 4567"
}
```

### Staff Login
```bash
POST /api/auth.php
{
  "staff_id": "PAA-ST-001",
  "password": "password"
}
```

### Record Payment
```bash
POST /api/finance.php
{
  "student_id": 1,
  "amount_paid": 65000,
  "payment_date": "2025-05-24",
  "academic_session": "2024/2025"
}
```

---

## 🛠️ Common Tasks

### Change Password
See: [README.md - Reset Password](README.md#common-issues)

### Add New User
See: [QUICK-START.md - Common Tasks](QUICK-START.md#-common-tasks)

### Record Payment
See: [API Examples](#-api-examples)

---

## 📞 Support Resources

### Issues?
Check [QUICK-START.md - Troubleshooting](QUICK-START.md#-troubleshooting)

### How do I...?
- Submit admission? → [Admissions API](README.md#submit-new-admission-application)
- Login as staff? → [Auth API](README.md#staff-login)
- Check results? → [Results API](README.md#get-student-results)
- Record payment? → [Finance API](README.md#record-payment)
- Manage students? → [Students API](README.md#get-student)

---

## 📁 File Structure

```
aidstudent/
├── api/
│   ├── admissions.php
│   ├── auth.php
│   ├── finance.php
│   ├── results.php
│   └── students.php
├── config/
│   └── Database.php
├── includes/
│   └── Helpers.php
├── js/
│   └── api-integration.js
├── logs/                    (auto-created)
├── database.sql
├── plan-aid-academy (1).html
├── setup-check.php
├── QUICK-START.md
├── README.md
├── PROJECT-SUMMARY.md
├── .htaccess
└── INDEX.md                 (this file)
```

---

## ✅ Verification Checklist

- [ ] Database imported successfully
- [ ] setup-check.php shows all ✓
- [ ] Can call admissions API
- [ ] Can login with sample credentials
- [ ] Frontend loads properly
- [ ] Results display correctly
- [ ] Payments can be recorded

---

## 📚 Learning Resources

- [PHP PDO Documentation](https://www.php.net/manual/en/book.pdo.php)
- [REST API Best Practices](https://restfulapi.net/)
- [Security in Web Apps](https://owasp.org/www-community/attacks/)
- [Password Hashing in PHP](https://www.php.net/manual/en/function.password-hash.php)

---

## 🎯 Next Steps

1. **Now**: Read QUICK-START.md
2. **Setup**: Import database
3. **Test**: Run setup-check.php
4. **Learn**: Read README.md
5. **Build**: Integrate frontend

---

## 📞 Questions?

Reference the appropriate documentation:
- **Setup issues** → QUICK-START.md
- **API questions** → README.md
- **What's included?** → PROJECT-SUMMARY.md
- **Database?** → database.sql
- **Frontend?** → api-integration.js

---

**Version**: 1.0.0
**Created**: May 24, 2026
**Status**: ✅ Production Ready

[← Back to Index](./)
