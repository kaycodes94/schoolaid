<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mark Attendance — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .attendance-options {
      display: flex;
      gap: var(--space-2);
    }
    .attendance-btn {
      padding: var(--space-2) var(--space-4);
      font-size: var(--font-size-xs);
      font-weight: 600;
      border-radius: var(--radius-md);
      border: 1px solid var(--color-border);
      background: var(--color-bg-surface);
      color: var(--color-text-secondary);
      cursor: pointer;
      transition: all var(--transition-normal);
    }
    .attendance-btn.present.active {
      background: rgba(30,58,138,0.15);
      border-color: var(--color-success);
      color: var(--color-success);
    }
    .attendance-btn.absent.active {
      background: rgba(239,68,68,0.15);
      border-color: var(--color-danger);
      color: var(--color-danger);
    }
  </style>
</head>
<body>
<div class="app-shell">

  <!-- Sidebar Backdrop -->
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- ===================== SIDEBAR ===================== -->
  <aside class="sidebar" id="sidebar">
    <a href="index" class="sidebar-logo">
      <div class="sidebar-logo-icon">🎓</div>
      <div class="sidebar-logo-text">
        <div class="sidebar-logo-name">Plan Aid Academy</div>
        <div class="sidebar-logo-role">Teacher Portal</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Overview</div>
      <a href="index" class="nav-item" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>
      <a href="profile" class="nav-item" id="nav-profile">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/></svg>
        My Profile
      </a>

      <div class="nav-section-label">Academics</div>
      <a href="classes" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        My Classes
      </a>
      <a href="timetable" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Timetable
      </a>

      <div class="nav-section-label">Student Records</div>
      <a href="attendance" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Mark Attendance
      </a>
      <a href="results" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4M7.5 8h9M7.5 16h9M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        Enter Results
      </a>
      <a href="assignments" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Assignments
      </a>

      <div class="nav-section-label">Communication</div>
      <a href="messages" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        Messages
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--gradient-accent);">FS</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>Fatima Sani</div>
          <div class="sidebar-user-role">Teacher</div>
        </div>
        <svg class="sidebar-user-action" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
      </div>
    </div>
  </aside>

  <!-- ===================== MAIN ===================== -->
  <main class="main-content">

    <!-- Topbar -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <div>
          <div class="page-title">Daily Student Attendance</div>
          <div class="page-breadcrumb">Student Records / <span>Attendance</span></div>
        </div>
      </div>
      <div class="topbar-right">
        <span class="session-badge session-info">2025/2026 | 1st Term</span>
        <button class="icon-btn" id="notifBtn" aria-label="Notifications">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
          <span class="dot notif-count-dot" style="display:none;"></span>
        </button>
        <div class="dropdown">
          <div class="icon-btn" data-dropdown="userMenu">
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--gradient-accent);font-size:0.65rem;width:28px;height:28px;">FS</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>Fatima Sani</div>
            <div class="dropdown-divider"></div>
            <a href="profile" class="dropdown-item">My Profile</a>
            <a href="#" class="dropdown-item danger" data-logout>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
              Sign Out
            </a>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="page-content">

      <!-- Query parameters card -->
      <div class="card mb-6">
        <div class="card-header"><h3 class="card-title">Select Class & Date</h3></div>
        <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr;">
          <div class="form-group">
            <label class="form-label" for="classSelect">Class</label>
            <select id="classSelect" class="form-control">
              <option value="JSS 2">JSS 2</option>
              <option value="SSS 2">SSS 2</option>
              <option value="JSS 1">JSS 1</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="attendanceDate">Date</label>
            <input type="date" id="attendanceDate" class="form-control">
          </div>
          <div class="form-group flex items-end">
            <button class="btn btn-primary btn-block" onclick="loadClassRoster()">Load Student List</button>
          </div>
        </div>
      </div>

      <!-- Attendance Register Card -->
      <div class="card" id="registerCard" style="display:none;">
        <div class="flex justify-between items-center mb-6" style="border-bottom:1px solid var(--color-border);padding-bottom:var(--space-4);">
          <h3 class="card-title" id="registerTitle">Attendance List</h3>
          <div class="flex gap-2">
            <button class="btn btn-secondary btn-sm" onclick="markAll('present')">Mark All Present</button>
            <button class="btn btn-secondary btn-sm" onclick="markAll('absent')">Mark All Absent</button>
          </div>
        </div>

        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Student</th>
                <th>Admission No</th>
                <th class="text-right">Attendance Status</th>
              </tr>
            </thead>
            <tbody id="attendanceTableBody">
              <!-- Dynamically Filled -->
            </tbody>
          </table>
        </div>

        <div class="flex justify-end mt-6" style="border-top:1px solid var(--color-border);padding-top:var(--space-4);">
          <button class="btn btn-success" onclick="saveAttendance()">Save Daily Attendance Register</button>
        </div>
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<div class="toast-container"></div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('teacher');

  document.getElementById('attendanceDate').value = new Date().toISOString().split('T')[0];

  let currentStudents = [];
  let dailyRegister = {}; // mapping student_id -> status ('present'/'absent')

  function loadClassRoster() {
    const selectedClass = document.getElementById('classSelect').value;
    const date = document.getElementById('attendanceDate').value;
    if (!date) {
      Toast.warning('Validation Warning', 'Please select a date.');
      return;
    }

    const students = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');
    currentStudents = students.filter(s => s.current_class === selectedClass && s.status === 'active');

    if (currentStudents.length === 0) {
      Toast.info('No Active Students', `No active students are currently registered in ${selectedClass}.`);
      document.getElementById('registerCard').style.display = 'none';
      return;
    }

    // Load existing attendance for this date & class
    const attendanceRecords = JSON.parse(localStorage.getItem('sams_mock_attendance') || '[]');
    dailyRegister = {};

    currentStudents.forEach(s => {
      const found = attendanceRecords.find(a => String(a.student_id) === String(s.id) && a.attendance_date === date);
      dailyRegister[s.id] = found ? found.status : 'present'; // default present
    });

    renderRegisterRows();
    document.getElementById('registerTitle').textContent = `Attendance List for ${selectedClass} (${Format.date(date)})`;
    document.getElementById('registerCard').style.display = 'block';
  }

  function renderRegisterRows() {
    const tbody = document.getElementById('attendanceTableBody');
    tbody.innerHTML = currentStudents.map(s => {
      const status = dailyRegister[s.id];
      return `
        <tr>
          <td>
            <div class="user-cell">
              ${Format.avatar(`${s.first_name} ${s.last_name}`, s.passport_photo)}
              <div>
                <strong>${s.first_name} ${s.last_name}</strong>
                <div class="text-xs text-muted">${s.email || 'student'}</div>
              </div>
            </div>
          </td>
          <td><code>${s.admission_no}</code></td>
          <td class="text-right">
            <div class="attendance-options justify-end">
              <button class="attendance-btn present ${status === 'present' ? 'active' : ''}" onclick="toggleStatus(${s.id}, 'present')">Present</button>
              <button class="attendance-btn absent ${status === 'absent' ? 'active' : ''}" onclick="toggleStatus(${s.id}, 'absent')">Absent</button>
            </div>
          </td>
        </tr>
      `;
    }).join('');
  }

  function toggleStatus(studentId, status) {
    dailyRegister[studentId] = status;
    renderRegisterRows();
  }

  function markAll(status) {
    currentStudents.forEach(s => {
      dailyRegister[s.id] = status;
    });
    renderRegisterRows();
  }

  async function saveAttendance() {
    const date = document.getElementById('attendanceDate').value;
    const selectedClass = document.getElementById('classSelect').value;

    const records = currentStudents.map(s => ({
      student_id: s.id,
      class_id: 1, // sample class entity id
      class_name: selectedClass,
      status: dailyRegister[s.id],
      attendance_date: date
    }));

    try {
      const res = await API.attendance.mark(records);
      if (res && res.status === 'success') {
        Toast.success('Success', 'Attendance marked successfully.');
      } else {
        Toast.error('Error', 'Failed to save attendance register.');
      }
    } catch(e) {
      Toast.error('Connection Error', 'Failed to connect to school server.');
    }
  }
</script>
</body>
</html>
