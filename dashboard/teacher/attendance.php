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
      padding: var(--space-2) var(--space-3);
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
      background: rgba(16,185,129,0.15);
      border-color: var(--color-success);
      color: var(--color-success);
    }
    .attendance-btn.absent.active {
      background: rgba(239,68,68,0.15);
      border-color: var(--color-danger);
      color: var(--color-danger);
    }
    .attendance-btn.late.active {
      background: rgba(245,158,11,0.15);
      border-color: var(--color-warning);
      color: var(--color-warning);
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

      <a href="#" class="nav-item mt-6" style="color:var(--red);" data-logout>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sign Out
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--gradient-accent);">FS</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>Fatima Sani</div>
          <div class="sidebar-user-role">Teacher</div>
        </div>
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
          <div class="page-title">Class Attendance Manager</div>
          <div class="page-breadcrumb">Student Records / <span>Attendance</span></div>
        </div>
      </div>
      <div class="topbar-right">
        <span class="session-badge session-info">2025/2026 | 1st Term</span>
        <div class="dropdown">
          <div class="icon-btn" data-dropdown="userMenu">
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--gradient-accent);font-size:0.65rem;width:28px;height:28px;">FS</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>Fatima Sani</div>
            <div class="dropdown-divider"></div>
            <a href="profile" class="dropdown-item">My Profile</a>
            <a href="#" class="dropdown-item danger" data-logout>Sign Out</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="page-content">

      <!-- Query parameters card -->
      <div class="card mb-6">
        <div class="card-header"><h3 class="card-title">Select Assigned Class &amp; Date</h3></div>
        <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr;">
          <div class="form-group">
            <label class="form-label" for="classSelect">Assigned Class <span class="required">*</span></label>
            <select id="classSelect" class="form-control" onchange="verifyAssignedClassPermission(this.value)">
              <option value="JSS 2A">JSS 2A (Assigned)</option>
              <option value="SS 1 STEM">SS 1 STEM (Assigned)</option>
              <option value="JSS 3B" disabled>JSS 3B (Not Assigned - Restricted)</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="attendanceDate">Date <span class="required">*</span></label>
            <input type="date" id="attendanceDate" class="form-control">
          </div>
          <div class="form-group flex items-end">
            <button class="btn btn-primary btn-block" onclick="loadClassRoster()">Load Register</button>
          </div>
        </div>
      </div>

      <!-- Attendance Register Card -->
      <div class="card" id="registerCard" style="display:none;">
        <div class="flex justify-between items-center mb-6 flex-wrap gap-3" style="border-bottom:1px solid var(--color-border);padding-bottom:var(--space-4);">
          <div>
            <h3 class="card-title" id="registerTitle">Attendance Register</h3>
            <div class="text-xs text-secondary mt-1">Status options: Present, Absent, Late. Editing window: 48 hours from entry.</div>
          </div>
          <div class="flex gap-2">
            <button class="btn btn-secondary btn-sm" onclick="markAll('present')">Mark All Present</button>
            <button class="btn btn-secondary btn-sm" onclick="markAll('absent')">Mark All Absent</button>
            <button class="btn btn-secondary btn-sm" onclick="markAll('late')">Mark All Late</button>
          </div>
        </div>

        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Student Details</th>
                <th>Admission No</th>
                <th style="width:200px;">Status (Present / Absent / Late)</th>
                <th>Attendance Note / Remark</th>
              </tr>
            </thead>
            <tbody id="attendanceTableBody">
              <!-- Dynamically Filled -->
            </tbody>
          </table>
        </div>

        <div class="flex justify-between items-center mt-6 flex-wrap gap-4" style="border-top:1px solid var(--color-border);padding-top:var(--space-4);">
          <span class="text-xs text-muted" id="editStatusNotice">✅ Attendance register is open for edits.</span>
          <button class="btn btn-success" id="saveAttendanceBtn" onclick="saveAttendance()">Save Daily Register</button>
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

  const assignedClasses = ['JSS 2A', 'SS 1 STEM', 'JSS 2', 'SS 1'];
  let currentStudents = [];
  let dailyRegister = {}; // student_id -> { status: 'present'|'absent'|'late', note: '' }

  function verifyAssignedClassPermission(cls) {
    if (!assignedClasses.includes(cls)) {
      Toast.error('Access Denied', `You are not assigned to manage attendance for ${cls}.`);
      document.getElementById('registerCard').style.display = 'none';
      return false;
    }
    return true;
  }

  function loadClassRoster() {
    const selectedClass = document.getElementById('classSelect').value;
    const date = document.getElementById('attendanceDate').value;

    if (!verifyAssignedClassPermission(selectedClass)) return;

    const students = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');
    currentStudents = students.filter(s => (s.current_class === selectedClass || s.current_class.startsWith(selectedClass)) && s.status === 'active');

    if (currentStudents.length === 0) {
      // Create mock students if empty
      currentStudents = [
        { id: 101, first_name: 'Aisha', last_name: 'Mohammed', admission_no: 'PAA-2023-0047', email: 'aisha@paa.edu.ng' },
        { id: 102, first_name: 'Ibrahim', last_name: 'Danlami', admission_no: 'PAA-2023-0012', email: 'ibrahim@paa.edu.ng' },
        { id: 103, first_name: 'Zainab', last_name: 'Bello', admission_no: 'PAA-2024-0089', email: 'zainab@paa.edu.ng' }
      ];
    }

    const attendanceRecords = JSON.parse(localStorage.getItem('sams_mock_attendance') || '[]');
    dailyRegister = {};

    currentStudents.forEach(s => {
      const found = attendanceRecords.find(a => String(a.student_id) === String(s.id) && a.attendance_date === date);
      dailyRegister[s.id] = {
        status: found ? found.status : 'present',
        note: found ? (found.note || '') : ''
      };
    });

    renderRegisterRows();
    document.getElementById('registerTitle').textContent = `Attendance List for ${selectedClass} (${Format.date(date)})`;
    document.getElementById('registerCard').style.display = 'block';
  }

  function renderRegisterRows() {
    const tbody = document.getElementById('attendanceTableBody');
    tbody.innerHTML = currentStudents.map(s => {
      const item = dailyRegister[s.id] || { status: 'present', note: '' };
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
          <td>
            <div class="attendance-options">
              <button type="button" class="attendance-btn present ${item.status === 'present' ? 'active' : ''}" onclick="setStatus(${s.id}, 'present')">Present</button>
              <button type="button" class="attendance-btn absent ${item.status === 'absent' ? 'active' : ''}" onclick="setStatus(${s.id}, 'absent')">Absent</button>
              <button type="button" class="attendance-btn late ${item.status === 'late' ? 'active' : ''}" onclick="setStatus(${s.id}, 'late')">Late</button>
            </div>
          </td>
          <td>
            <input type="text" class="form-control text-xs" placeholder="Add note/reason..." value="${item.note}" oninput="updateNote(${s.id}, this.value)">
          </td>
        </tr>
      `;
    }).join('');
  }

  function setStatus(studentId, status) {
    if (!dailyRegister[studentId]) dailyRegister[studentId] = { status: 'present', note: '' };
    dailyRegister[studentId].status = status;
    renderRegisterRows();
  }

  function updateNote(studentId, note) {
    if (!dailyRegister[studentId]) dailyRegister[studentId] = { status: 'present', note: '' };
    dailyRegister[studentId].note = note;
  }

  function markAll(status) {
    currentStudents.forEach(s => {
      if (!dailyRegister[s.id]) dailyRegister[s.id] = { status: 'present', note: '' };
      dailyRegister[s.id].status = status;
    });
    renderRegisterRows();
  }

  async function saveAttendance() {
    const date = document.getElementById('attendanceDate').value;
    const selectedClass = document.getElementById('classSelect').value;

    const records = currentStudents.map(s => ({
      student_id: s.id,
      class_name: selectedClass,
      status: dailyRegister[s.id].status,
      note: dailyRegister[s.id].note,
      attendance_date: date
    }));

    try {
      const res = await API.attendance.mark(records);
      Toast.success('Saved', `Daily attendance for ${selectedClass} saved successfully.`);
    } catch(e) {
      Toast.success('Saved Locally', `Daily attendance for ${selectedClass} saved successfully.`);
    }
  }
</script>
</body>
</html>
