<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Attendance — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
</head>
<body>
<div class="app-shell">

  <!-- Sidebar Backdrop -->
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- ===================== SIDEBAR ===================== -->
  <aside class="sidebar" id="sidebar">
    <a href="index" class="sidebar-logo">
      <div class="sidebar-logo-icon">🏫</div>
      <div class="sidebar-logo-text">
        <div class="sidebar-logo-name">Plan Aid Academy</div>
        <div class="sidebar-logo-role">Head Unit Portal</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Overview</div>
      <a href="index" class="nav-item" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>

      <div class="nav-section-label">Recruitment</div>
      <a href="approvals" class="nav-item" id="nav-approvals">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Teacher Approvals
        <span class="nav-badge" id="pendingTeacherBadge" style="display:none">0</span>
      </a>
      <a href="teachers" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Teacher Management
      </a>

      <div class="nav-section-label">Students</div>
      <a href="students" class="nav-item" id="nav-students">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Student Management
      </a>

      <div class="nav-section-label">Academic</div>
      <a href="departments" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
        Departments
      </a>
      <a href="attendance" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Attendance
      </a>

      <div class="nav-section-label">Administration</div>
      <a href="reports" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        Reports
      </a>
      <a href="audit-logs" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Audit Logs
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--gradient-accent);">AU</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>Amaka Uche</div>
          <div class="sidebar-user-role">Head Unit</div>
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
          <div class="page-title">Attendance Tracking</div>
          <div class="page-breadcrumb">Staff / <span>Attendance</span></div>
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
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--gradient-accent);font-size:0.65rem;width:28px;height:28px;">AU</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>Amaka Uche</div>
            <div class="dropdown-divider"></div>
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

      <!-- Stats Grid -->
      <div class="stats-grid stats-grid-3 mb-6">
        <div class="stat-card" style="--stat-color:#10b981;--stat-color-bg:rgba(16,185,129,0.12)">
          <div class="stat-icon">👨‍🏫</div>
          <div class="stat-value" id="presentCount">3</div>
          <div class="stat-label">Teachers Present Today</div>
        </div>
        <div class="stat-card" style="--stat-color:#f59e0b;--stat-color-bg:rgba(245,158,11,0.12)">
          <div class="stat-icon">⏳</div>
          <div class="stat-value" id="leaveCount">1</div>
          <div class="stat-label">Teachers on Leave/Sick</div>
        </div>
        <div class="stat-card" style="--stat-color:#3b82f6;--stat-color-bg:rgba(59,130,246,0.12)">
          <div class="stat-icon">📈</div>
          <div class="stat-value">75.0%</div>
          <div class="stat-label">Today's Attendance Rate</div>
        </div>
      </div>

      <!-- Weekly Trend Chart -->
      <div class="card mb-6">
        <div class="card-header">
          <h3 class="card-title">Teacher Attendance Weekly History</h3>
        </div>
        <div class="chart-container" style="height: 240px;">
          <canvas id="teacherWeeklyChart"></canvas>
        </div>
      </div>

      <!-- Attendance Register Select -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daily Staff Attendance Register</h3>
          <div class="flex gap-2">
            <input type="date" id="attendanceDate" class="form-control" style="width: 180px; padding: 0.4rem 1rem;">
          </div>
        </div>
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Teacher</th>
                <th>Employee ID</th>
                <th>Department</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody id="attendanceRegisterBody">
              <!-- Loaded Dynamically -->
            </tbody>
          </table>
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
  Auth.requireRole('unit_head');

  document.getElementById('attendanceDate').value = new Date().toISOString().split('T')[0];

  let teachers = [];
  let attendanceData = {};

  document.addEventListener('DOMContentLoaded', () => {
    initAttendance();
    renderChart();
    loadRegister();

    document.getElementById('attendanceDate').addEventListener('change', loadRegister);

    // Sidebar badge count checking
    const pendingRegs = JSON.parse(localStorage.getItem('sams_mock_teacher_regs') || '[]')
      .filter(r => r.status === 'pending');
    const badge = document.getElementById('pendingTeacherBadge');
    if (pendingRegs.length > 0) {
      badge.textContent = pendingRegs.length;
      badge.style.display = '';
    } else {
      badge.style.display = 'none';
    }
  });

  function initAttendance() {
    // Read teachers
    const staffList = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
    teachers = staffList.filter(s => s.role === 'teacher');

    // Retrieve or create attendance registry
    const stored = localStorage.getItem('sams_mock_teacher_attendance');
    if (stored) {
      attendanceData = JSON.parse(stored);
    } else {
      // Seed default today's attendance
      const today = new Date().toISOString().split('T')[0];
      attendanceData[today] = {};
      teachers.forEach((t, index) => {
        attendanceData[today][t.id] = index === 0 ? 'leave' : 'present';
      });
      localStorage.setItem('sams_mock_teacher_attendance', JSON.stringify(attendanceData));
    }
  }

  function renderChart() {
    new Chart(document.getElementById('teacherWeeklyChart'), {
      type: 'bar',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
        datasets: [
          {
            label: 'Present',
            data: [4, 4, 3, 3, 4],
            backgroundColor: '#10b981',
            borderRadius: 4
          },
          {
            label: 'On Leave',
            data: [0, 0, 1, 1, 0],
            backgroundColor: '#f59e0b',
            borderRadius: 4
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: { stacked: true, grid: { display: false } },
          y: { stacked: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(148,163,184,0.08)' } }
        }
      }
    });
  }

  function loadRegister() {
    const date = document.getElementById('attendanceDate').value;
    const tbody = document.getElementById('attendanceRegisterBody');
    tbody.innerHTML = '';

    // Guarantee data structure for selected date
    if (!attendanceData[date]) {
      attendanceData[date] = {};
      teachers.forEach(t => {
        attendanceData[date][t.id] = 'present'; // default to present
      });
      localStorage.setItem('sams_mock_teacher_attendance', JSON.stringify(attendanceData));
    }

    const daily = attendanceData[date];
    let present = 0;
    let leave = 0;

    // Load department list to translate ID
    const departments = JSON.parse(localStorage.getItem('sams_mock_departments') || '[]');

    teachers.forEach(t => {
      const status = daily[t.id] || 'present';
      if (status === 'present') present++;
      else if (status === 'leave') leave++;

      const dept = departments.find(d => String(d.id) === String(t.department_id));
      const deptName = dept ? dept.name : 'Unassigned';

      tbody.innerHTML += `
        <tr>
          <td>
            <div class="user-cell">
              ${Format.avatar(`${t.first_name} ${t.last_name}`, t.passport_photo)}
              <div>
                <strong>${t.first_name} ${t.last_name}</strong>
                <div class="text-xs text-muted">${t.email}</div>
              </div>
            </div>
          </td>
          <td><code>${t.staff_id}</code></td>
          <td>${deptName}</td>
          <td>${Format.badge(status)}</td>
          <td class="text-right">
            <div class="flex gap-2 justify-end">
              <button class="btn btn-secondary btn-sm" onclick="setStatus(${t.id}, 'present')">Present</button>
              <button class="btn btn-warning btn-sm" onclick="setStatus(${t.id}, 'leave')">On Leave</button>
            </div>
          </td>
        </tr>
      `;
    });

    document.getElementById('presentCount').textContent = present;
    document.getElementById('leaveCount').textContent = leave;
  }

  function setStatus(teacherId, status) {
    const date = document.getElementById('attendanceDate').value;
    attendanceData[date][teacherId] = status;
    localStorage.setItem('sams_mock_teacher_attendance', JSON.stringify(attendanceData));
    Toast.success('Updated', 'Attendance status updated successfully.');
    loadRegister();
  }
</script>
</body>
</html>
