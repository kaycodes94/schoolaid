<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard — School Aid Management System</title>
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
      <div class="sidebar-logo-icon">🎓</div>
      <div class="sidebar-logo-text">
        <div class="sidebar-logo-name">Plan Aid Academy</div>
        <div class="sidebar-logo-role">Student Portal</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Overview</div>
      <a href="index" class="nav-item active" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>
      <a href="profile" class="nav-item" id="nav-profile">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/></svg>
        My Profile
      </a>

      <div class="nav-section-label">Academic Records</div>
      <a href="results" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4M7.5 8h9M7.5 16h9M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        Term Results
      </a>
      <a href="attendance" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        My Attendance
      </a>
      <a href="timetable" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Class Timetable
      </a>

      <div class="nav-section-label">Tasks & Memos</div>
      <a href="assignments" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        My Assignments
      </a>
      <a href="announcements" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 17H2a3 3 0 000-6h1V9a9 9 0 0118 0v2h1a3 3 0 010 6z"/></svg>
        Announcements
      </a>
      <a href="messages" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        Teacher Messages
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--gradient-accent);">JD</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>John Dakyen</div>
          <div class="sidebar-user-role">Student</div>
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
          <div class="page-title">Dashboard</div>
          <div class="page-breadcrumb">Welcome back, <span data-user-name>John Dakyen</span></div>
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
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--gradient-accent);font-size:0.65rem;width:28px;height:28px;">JD</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>John Dakyen</div>
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

      <!-- Stats Grid -->
      <div class="stats-grid stats-grid-3 mb-6">
        <div class="stat-card" style="--stat-color:#1e3a8a;--stat-color-bg:rgba(30,58,138,0.15)">
          <div class="stat-icon">📈</div>
          <div class="stat-value">96.8%</div>
          <div class="stat-label">Term Attendance Rate</div>
        </div>
        <div class="stat-card" style="--stat-color:#6366f1;--stat-color-bg:rgba(99,102,241,0.12)">
          <div class="stat-icon">🌟</div>
          <div class="stat-value" id="termAverage">B+</div>
          <div class="stat-label">Current Term Average</div>
        </div>
        <div class="stat-card" style="--stat-color:#f59e0b;--stat-color-bg:rgba(245,158,11,0.12)">
          <div class="stat-icon">📝</div>
          <div class="stat-value" id="pendingTasks">1</div>
          <div class="stat-label">Pending Assignments</div>
        </div>
      </div>

      <!-- Charts + Schedule -->
      <div class="grid gap-6 mb-6" style="grid-template-columns: 1.5fr 1fr;">
        <!-- Scores trend -->
        <div class="card">
          <div class="card-header"><h3 class="card-title">Subject Continuous Assessment & Exams</h3></div>
          <div class="chart-container" style="height:230px;">
            <canvas id="studentScoresChart"></canvas>
          </div>
        </div>

        <!-- Today schedule -->
        <div class="card flex flex-col justify-between">
          <div class="card-header"><h3 class="card-title">Today's Class Schedule</h3></div>
          <div class="table-wrapper" style="flex:1;">
            <table class="table" style="font-size:var(--font-size-xs);">
              <thead>
                <tr>
                  <th>Time</th>
                  <th>Subject</th>
                  <th>Teacher</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><code>08:30 - 09:30</code></td>
                  <td><strong>Biology</strong></td>
                  <td>Fatima Sani</td>
                </tr>
                <tr>
                  <td><code>12:00 - 01:00</code></td>
                  <td><strong>Basic Science</strong></td>
                  <td>Fatima Sani</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Announcements Board -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Announcements & Notices</h3>
          <a href="announcements" class="btn btn-secondary btn-sm">View Board →</a>
        </div>
        <div id="announcementsGrid" class="flex flex-col gap-3">
          <div class="empty-state"><div class="spinner"></div></div>
        </div>
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

  <!-- Notification Panel -->
  <div class="notif-panel" id="notifPanel">
    <div class="notif-panel-header">
      <span class="font-semibold">Notifications</span>
      <div class="flex gap-2">
        <button class="btn btn-ghost btn-sm" id="markAllRead">Mark all read</button>
        <button class="icon-btn" id="notifClose" aria-label="Close">✕</button>
      </div>
    </div>
    <div class="notif-list" id="notifList">
      <div class="empty-state"><div class="spinner"></div></div>
    </div>
  </div>

</div><!-- /.app-shell -->

<div class="toast-container"></div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('student');

  document.addEventListener('DOMContentLoaded', () => {
    loadStudentDashboard();
    renderScoresChart();
    loadAnnouncements();
  });

  function loadStudentDashboard() {
    const user = Auth.getUser();
    const subs = JSON.parse(localStorage.getItem('sams_mock_submissions') || '[]');
    const studentId = user?.db_student_id || 1;

    // Filter pending tasks
    const pending = subs.filter(s => String(s.student_id) === String(studentId) && s.status === 'submitted').length;
    document.getElementById('pendingTasks').textContent = pending;
  }

  function renderScoresChart() {
    new Chart(document.getElementById('studentScoresChart'), {
      type: 'bar',
      data: {
        labels: ['Biology', 'Basic Science', 'Mathematics'],
        datasets: [
          {
            label: 'Continuous Assessment',
            data: [12, 14, 13],
            backgroundColor: '#6366f1',
            borderRadius: 4
          },
          {
            label: 'Exam score',
            data: [52, 58, 48],
            backgroundColor: '#1e3a8a',
            borderRadius: 4
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: { max: 100, grid: { color: 'rgba(148,163,184,0.08)' } }
        }
      }
    });
  }

  async function loadAnnouncements() {
    const el = document.getElementById('announcementsGrid');
    try {
      const res = await API.announcements.list();
      if (!res || res.status !== 'success') {
        el.innerHTML = '<div class="empty-state">No notices posted</div>';
        return;
      }

      const list = res.data.filter(a => a.target_role === 'all' || a.target_role === 'student').slice(0, 2);
      if (list.length === 0) {
        el.innerHTML = '<div class="empty-state">No announcements active.</div>';
        return;
      }

      el.innerHTML = list.map(a => `
        <div style="border-bottom:1px solid var(--color-border);padding:var(--space-3) var(--space-4);">
          <div class="flex justify-between items-center mb-1">
            <strong>${a.title}</strong>
            <span class="text-xs text-muted">${Format.timeAgo(a.created_at)}</span>
          </div>
          <p class="text-xs text-secondary">${a.body}</p>
        </div>
      `).join('');
    } catch(e) {
      el.innerHTML = '<div class="empty-state">Failed to connect.</div>';
    }
  }
</script>
</body>
</html>
