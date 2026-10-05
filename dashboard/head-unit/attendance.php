<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arabic Unit Attendance — Plan Aid Academy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .attendance-btn-group { display: flex; gap: var(--space-2); }
    .att-btn {
      padding: 4px 10px;
      font-size: var(--font-size-xs);
      font-weight: 600;
      border-radius: var(--radius-md);
      border: 1px solid var(--color-border);
      background: var(--color-bg-surface);
      cursor: pointer;
    }
    .att-btn.present.active { background: rgba(16,185,129,0.15); border-color: var(--color-success); color: var(--color-success); }
    .att-btn.absent.active { background: rgba(239,68,68,0.15); border-color: var(--color-danger); color: var(--color-danger); }
    .att-btn.late.active { background: rgba(245,158,11,0.15); border-color: var(--color-warning); color: var(--color-warning); }
  </style>
</head>
<body>
<div class="app-shell">

  <!-- Sidebar Backdrop -->
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- ===================== SIDEBAR ===================== -->
  <aside class="sidebar" id="sidebar">
    <a href="index.php" class="sidebar-logo">
      <div class="sidebar-logo-icon">☪️</div>
      <div class="sidebar-logo-text">
        <div class="sidebar-logo-name">Plan Aid Academy</div>
        <div class="sidebar-logo-role">Arabic Unit Portal</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Overview</div>
      <a href="index.php" class="nav-item" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Unit Dashboard
      </a>

      <div class="nav-section-label">Arabic Academics</div>
      <a href="students.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Arabic Students &amp; Classes
      </a>
      <a href="teachers.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        Arabic Teachers
      </a>
      <a href="departments.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
        Arabic Subjects &amp; Curriculum
      </a>
      <a href="attendance.php" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Unit Attendance Summary
      </a>

      <div class="nav-section-label">Results &amp; Approvals</div>
      <a href="approvals.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Pending Arabic Results
      </a>
      <a href="reports.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        Arabic Reports
      </a>

      <a href="#" class="nav-item mt-6" style="color:var(--red);" data-logout>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sign Out
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--color-warning);">AU</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>Ustadh Ahmad</div>
          <div class="sidebar-user-role">Head of Arabic Unit</div>
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
          <div class="page-title">Arabic Unit Attendance Register</div>
          <div class="page-breadcrumb">حضور وغياب طلاب وحدة اللغة العربية</div>
        </div>
      </div>
      <div class="topbar-right">
        <span class="session-badge session-info">2025/2026 | 1st Term</span>
        <div class="dropdown">
          <div class="icon-btn" data-dropdown="userMenu">
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--color-warning);font-size:0.65rem;width:28px;height:28px;">AU</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>Ustadh Ahmad</div>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item danger" data-logout>Sign Out</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="page-content">

      <!-- Query Filter Card -->
      <div class="card mb-6">
        <div class="card-header"><h3 class="card-title">Select Arabic Class &amp; Date</h3></div>
        <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr;">
          <div class="form-group">
            <label class="form-label" for="arabicClassSelect">Arabic Track Class</label>
            <select id="arabicClassSelect" class="form-control">
              <option value="Primary 3 Arabic">Primary 3 Arabic (الابتدائي 3)</option>
              <option value="JSS 1 Arabic">JSS 1 Arabic (المتوسط 1)</option>
              <option value="JSS 2 Arabic">JSS 2 Arabic (المتوسط 2)</option>
              <option value="SS 1 Hifz">SS 1 Hifz Track (تحفيظ القرآن 1)</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="attendanceDate">Date</label>
            <input type="date" id="attendanceDate" class="form-control">
          </div>
          <div class="form-group flex items-end">
            <button class="btn btn-primary btn-block" onclick="loadRoster()">Load Student List</button>
          </div>
        </div>
      </div>

      <!-- Register Card -->
      <div class="card" id="registerCard" style="display:none;">
        <div class="flex justify-between items-center mb-6 flex-wrap gap-3" style="border-bottom:1px solid var(--color-border);padding-bottom:var(--space-4);">
          <h3 class="card-title" id="registerTitle">Attendance Register</h3>
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
                <th>Student Name</th>
                <th>ID / Admission No</th>
                <th style="width:220px;">Attendance Status</th>
                <th>Notes / Lateness Reason</th>
              </tr>
            </thead>
            <tbody id="attendanceTableBody">
              <!-- Dynamically Filled -->
            </tbody>
          </table>
        </div>

        <div class="flex justify-end mt-6" style="border-top:1px solid var(--color-border);padding-top:var(--space-4);">
          <button class="btn btn-success" onclick="saveAttendance()">Save Daily Register</button>
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
  Auth.requireRole(['unit_head', 'arabic', 'principal', 'admin']);

  document.getElementById('attendanceDate').value = new Date().toISOString().split('T')[0];

  let sampleStudents = [
    { id: 201, first_name: 'Aisha', last_name: 'Mohammed', admission_no: 'PAA-2023-0047' },
    { id: 202, first_name: 'Ibrahim', last_name: 'Danlami', admission_no: 'PAA-2023-0012' },
    { id: 203, first_name: 'Zainab', last_name: 'Bello', admission_no: 'PAA-2024-0089' },
    { id: 204, first_name: 'Yusuf', last_name: 'Ahmed', admission_no: 'PAA-2023-0104' }
  ];

  let registerState = {};

  function loadRoster() {
    const cls = document.getElementById('arabicClassSelect').value;
    const date = document.getElementById('attendanceDate').value;

    sampleStudents.forEach(s => {
      if (!registerState[s.id]) registerState[s.id] = { status: 'present', note: '' };
    });

    renderTable();
    document.getElementById('registerTitle').textContent = `Attendance for ${cls} (${Format.date(date)})`;
    document.getElementById('registerCard').style.display = 'block';
  }

  function renderTable() {
    const tbody = document.getElementById('attendanceTableBody');
    tbody.innerHTML = sampleStudents.map(s => {
      const item = registerState[s.id] || { status: 'present', note: '' };
      return `
        <tr>
          <td>
            <div class="user-cell">
              ${Format.avatar(`${s.first_name} ${s.last_name}`, null)}
              <div>
                <strong>${s.first_name} ${s.last_name}</strong>
              </div>
            </div>
          </td>
          <td><code>${s.admission_no}</code></td>
          <td>
            <div class="attendance-btn-group">
              <button class="att-btn present ${item.status === 'present' ? 'active' : ''}" onclick="setStatus(${s.id}, 'present')">Present</button>
              <button class="att-btn absent ${item.status === 'absent' ? 'active' : ''}" onclick="setStatus(${s.id}, 'absent')">Absent</button>
              <button class="att-btn late ${item.status === 'late' ? 'active' : ''}" onclick="setStatus(${s.id}, 'late')">Late</button>
            </div>
          </td>
          <td>
            <input type="text" class="form-control text-xs" placeholder="Add notes..." value="${item.note}" oninput="updateNote(${s.id}, this.value)">
          </td>
        </tr>
      `;
    }).join('');
  }

  function setStatus(id, st) {
    if (!registerState[id]) registerState[id] = { status: 'present', note: '' };
    registerState[id].status = st;
    renderTable();
  }

  function updateNote(id, txt) {
    if (!registerState[id]) registerState[id] = { status: 'present', note: '' };
    registerState[id].note = txt;
  }

  function markAll(st) {
    sampleStudents.forEach(s => {
      if (!registerState[s.id]) registerState[s.id] = { status: 'present', note: '' };
      registerState[s.id].status = st;
    });
    renderTable();
  }

  function saveAttendance() {
    const cls = document.getElementById('arabicClassSelect').value;
    Toast.success('Attendance Saved', `Daily attendance register for ${cls} saved successfully.`);
  }
</script>
</body>
</html>
