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
        <div class="sidebar-logo-role">Principal Portal</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Overview</div>
      <a href="index" class="nav-item" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>

      <div class="nav-section-label">Students</div>
      <a href="approvals" class="nav-item" id="nav-approvals">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Student Approvals
        <span class="nav-badge" id="pendingStudentBadge" style="display:none">0</span>
      </a>
      <a href="students" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Student Management
      </a>
      <a href="attendance" class="nav-item active" id="nav-attendance">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Attendance
      </a>
      <a href="performance" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        Performance
      </a>

      <div class="nav-section-label">Academic</div>
      <a href="classes" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Classes
      </a>
      <a href="departments" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
        Departments
      </a>

      <div class="nav-section-label">Communication</div>
      <a href="announcements" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 17H2a3 3 0 000-6h1V9a9 9 0 0118 0v2h1a3 3 0 010 6z"/></svg>
        Announcements
      </a>

      <div class="nav-section-label">Administration</div>
      <a href="reports" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        Reports
      </a>
      <a href="users" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        User Management
      </a>
      <a href="audit-logs" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Audit Logs
      </a>
      <a href="settings" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
        Settings
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--gradient-accent);">PA</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>Principal</div>
          <div class="sidebar-user-role">Principal</div>
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
          <div class="page-breadcrumb">Students / <span>Attendance</span></div>
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
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--gradient-accent);font-size:0.65rem;width:28px;height:28px;">PA</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>Principal</div>
            <div class="dropdown-divider"></div>
            <a href="settings" class="dropdown-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/></svg>
              Settings
            </a>
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
      <div class="stats-grid stats-grid-4 mb-6">
        <div class="stat-card" style="--stat-color:#10b981;--stat-color-bg:rgba(16,185,129,0.12)">
          <div class="stat-icon">✅</div>
          <div class="stat-value" id="totalPresent">824</div>
          <div class="stat-label">Present Today</div>
        </div>
        <div class="stat-card" style="--stat-color:#ef4444;--stat-color-bg:rgba(239,68,68,0.12)">
          <div class="stat-icon">❌</div>
          <div class="stat-value" id="totalAbsent">32</div>
          <div class="stat-label">Absent Today</div>
        </div>
        <div class="stat-card" style="--stat-color:#3b82f6;--stat-color-bg:rgba(59,130,246,0.12)">
          <div class="stat-icon">📈</div>
          <div class="stat-value" id="attendanceRate">96.2%</div>
          <div class="stat-label">Attendance Rate</div>
        </div>
        <div class="stat-card" style="--stat-color:#f59e0b;--stat-color-bg:rgba(245,158,11,0.12)">
          <div class="stat-icon">🎓</div>
          <div class="stat-value">856</div>
          <div class="stat-label">Total Students</div>
        </div>
      </div>

      <!-- Charts Row -->
      <div class="grid gap-6 mb-6" style="grid-template-columns: 2fr 1fr;">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Weekly Attendance History</h3>
          </div>
          <div class="chart-container" style="height: 240px;">
            <canvas id="weeklyAttendanceChart"></canvas>
          </div>
        </div>
        
        <div class="card flex flex-col justify-between">
          <div class="card-header">
            <h3 class="card-title">Today's Unit Breakdown</h3>
          </div>
          <div class="flex-col gap-3">
            <div class="mb-4">
              <div class="flex justify-between text-xs mb-1">
                <span>Secondary School</span>
                <strong>98%</strong>
              </div>
              <div class="progress"><div class="progress-bar" style="width: 98%; background:#10b981;"></div></div>
            </div>
            <div class="mb-4">
              <div class="flex justify-between text-xs mb-1">
                <span>Primary School</span>
                <strong>95%</strong>
              </div>
              <div class="progress"><div class="progress-bar" style="width: 95%; background:#3b82f6;"></div></div>
            </div>
            <div class="mb-4">
              <div class="flex justify-between text-xs mb-1">
                <span>Nursery School</span>
                <strong>92%</strong>
              </div>
              <div class="progress"><div class="progress-bar" style="width: 92%; background:#f59e0b;"></div></div>
            </div>
            <div>
              <div class="flex justify-between text-xs mb-1">
                <span>Arabic / Islamic Unit</span>
                <strong>97%</strong>
              </div>
              <div class="progress"><div class="progress-bar" style="width: 97%; background:#6366f1;"></div></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Attendance Register Select -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Class Attendance Register</h3>
          <div class="flex gap-2">
            <select id="classSelect" class="form-control" style="width: 160px; padding: 0.4rem 2.5rem 0.4rem 1rem;">
              <option value="JSS2">JSS 2</option>
              <option value="SSS1">SSS 1</option>
              <option value="PRI5">Primary 5</option>
            </select>
            <input type="date" id="attendanceDate" class="form-control" style="width: 160px; padding: 0.4rem 1rem;">
          </div>
        </div>
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Student</th>
                <th>Class</th>
                <th>Status</th>
                <th>Marked By</th>
                <th>Timestamp</th>
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

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('principal');

  document.getElementById('attendanceDate').value = new Date().toISOString().split('T')[0];

  document.addEventListener('DOMContentLoaded', () => {
    renderWeeklyChart();
    loadAttendanceRegister();

    document.getElementById('classSelect').addEventListener('change', loadAttendanceRegister);
    document.getElementById('attendanceDate').addEventListener('change', loadAttendanceRegister);
  });

  function renderWeeklyChart() {
    new Chart(document.getElementById('weeklyAttendanceChart'), {
      type: 'bar',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
        datasets: [
          {
            label: 'Present',
            data: [812, 820, 834, 824, 805],
            backgroundColor: '#10b981',
            borderRadius: 4
          },
          {
            label: 'Absent',
            data: [44, 36, 22, 32, 51],
            backgroundColor: '#ef4444',
            borderRadius: 4
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: { stacked: true, grid: { display: false } },
          y: { stacked: true, grid: { color: 'rgba(148,163,184,0.08)' } }
        }
      }
    });
  }

  function loadAttendanceRegister() {
    const tbody = document.getElementById('attendanceRegisterBody');
    tbody.innerHTML = `
      <tr>
        <td>
          <div class="user-cell">
            <div class="avatar">AM</div>
            <div><strong>Aisha Mohammed</strong><div class="text-xs text-muted">aisha@email.com</div></div>
          </div>
        </td>
        <td>JSS 2</td>
        <td><span class="badge badge-success">Present</span></td>
        <td>Mrs. Fatima Sani</td>
        <td>09:15 AM</td>
      </tr>
      <tr>
        <td>
          <div class="user-cell">
            <div class="avatar">BM</div>
            <div><strong>Blessing Musa</strong><div class="text-xs text-muted">blessing@email.com</div></div>
          </div>
        </td>
        <td>JSS 2</td>
        <td><span class="badge badge-success">Present</span></td>
        <td>Mrs. Fatima Sani</td>
        <td>09:16 AM</td>
      </tr>
      <tr>
        <td>
          <div class="user-cell">
            <div class="avatar">IH</div>
            <div><strong>Ibrahim Hassan</strong><div class="text-xs text-muted">ibrahim@email.com</div></div>
          </div>
        </td>
        <td>JSS 2</td>
        <td><span class="badge badge-danger">Absent</span></td>
        <td>Mrs. Fatima Sani</td>
        <td>—</td>
      </tr>
    `;
  }
</script>
</body>
</html>
