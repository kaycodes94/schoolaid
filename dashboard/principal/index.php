<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Principal Dashboard — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
</head>
<body>
<div class="app-shell">

  <!-- Sidebar Backdrop (mobile) -->
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
      <a href="index"        class="nav-item active" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>

      <div class="nav-section-label">Students</div>
      <a href="approvals"    class="nav-item" id="nav-approvals">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Student Approvals
        <span class="nav-badge" id="pendingStudentBadge" style="display:none">0</span>
      </a>
      <a href="students"     class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Student Management
      </a>
      <a href="attendance"   class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Attendance
      </a>
      <a href="performance"  class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        Performance
      </a>

      <div class="nav-section-label">Academic</div>
      <a href="classes"      class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Classes
      </a>
      <a href="departments"  class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
        Departments
      </a>

      <div class="nav-section-label">Communication</div>
      <a href="announcements" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 17H2a3 3 0 000-6h1V9a9 9 0 0118 0v2h1a3 3 0 010 6z"/></svg>
        Announcements
      </a>

      <div class="nav-section-label">Administration</div>
      <a href="reports"      class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        Reports
      </a>
      <a href="users"        class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        User Management
      </a>
      <a href="audit-logs"   class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Audit Logs
      </a>
      <a href="settings"     class="nav-item">
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
          <div class="page-title">Dashboard</div>
          <div class="page-breadcrumb">Welcome back, <span data-user-name>Principal</span></div>
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
      <div class="stats-grid stats-grid-6 mb-6" id="statsGrid">
        <!-- Loaded dynamically -->
        <div class="stat-card"><div class="skeleton" style="height:100px;"></div></div>
        <div class="stat-card"><div class="skeleton" style="height:100px;"></div></div>
        <div class="stat-card"><div class="skeleton" style="height:100px;"></div></div>
        <div class="stat-card"><div class="skeleton" style="height:100px;"></div></div>
        <div class="stat-card"><div class="skeleton" style="height:100px;"></div></div>
        <div class="stat-card"><div class="skeleton" style="height:100px;"></div></div>
      </div>

      <!-- Charts + Pending Queue Row -->
      <div class="grid gap-6 mb-6" style="grid-template-columns:1fr 380px;">

        <!-- Enrollment Trend Chart -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Student Enrollment Trend</h3>
            <span class="badge badge-primary">Last 6 months</span>
          </div>
          <div class="chart-container" style="height:220px;">
            <canvas id="enrollmentChart"></canvas>
          </div>
        </div>

        <!-- Student Status Donut -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Student Status</h3>
          </div>
          <div class="chart-container" style="height:180px;">
            <canvas id="statusChart"></canvas>
          </div>
          <div id="statusLegend" style="margin-top:var(--space-3);"></div>
        </div>
      </div>

      <!-- Pending Approvals + Recent Announcements Row -->
      <div class="grid gap-6" style="grid-template-columns:1fr 1fr;">

        <!-- Pending Student Approvals -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Pending Student Applications</h3>
            <a href="approvals" class="btn btn-secondary btn-sm">View All →</a>
          </div>
          <div id="pendingStudentsList">
            <div class="empty-state">
              <div class="spinner"></div>
            </div>
          </div>
        </div>

        <!-- Recent Announcements -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Recent Announcements</h3>
            <a href="announcements" class="btn btn-primary btn-sm">+ New</a>
          </div>
          <div id="announcementsList">
            <div class="empty-state"><div class="spinner"></div></div>
          </div>
        </div>

      </div>

      <!-- Attendance Today -->
      <div class="card mt-6">
        <div class="card-header">
          <h3 class="card-title">Today's Attendance Overview</h3>
          <span class="text-sm text-muted" id="todayDate"></span>
        </div>
        <div class="grid gap-4" style="grid-template-columns:repeat(4,1fr);">
          <div style="text-align:center;padding:var(--space-4);background:var(--color-bg-elevated);border-radius:var(--radius-lg);">
            <div style="font-size:var(--font-size-3xl);font-weight:800;color:var(--color-success);" id="att-present">—</div>
            <div class="text-sm text-muted">Present</div>
          </div>
          <div style="text-align:center;padding:var(--space-4);background:var(--color-bg-elevated);border-radius:var(--radius-lg);">
            <div style="font-size:var(--font-size-3xl);font-weight:800;color:var(--color-danger);" id="att-absent">—</div>
            <div class="text-sm text-muted">Absent</div>
          </div>
          <div style="text-align:center;padding:var(--space-4);background:var(--color-bg-elevated);border-radius:var(--radius-lg);">
            <div style="font-size:var(--font-size-3xl);font-weight:800;color:var(--color-accent);" id="att-rate">—%</div>
            <div class="text-sm text-muted">Attendance Rate</div>
          </div>
          <div style="text-align:center;padding:var(--space-4);background:var(--color-bg-elevated);border-radius:var(--radius-lg);">
            <div style="font-size:var(--font-size-3xl);font-weight:800;color:var(--color-text-primary);" id="att-total">—</div>
            <div class="text-sm text-muted">Total Students</div>
          </div>
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

<!-- Confirm Dialog -->
<div class="modal-overlay" id="confirmOverlay">
  <div class="modal" style="max-width:400px;">
    <div class="modal-body" style="text-align:center;padding:var(--space-8);">
      <div style="font-size:2.5rem;margin-bottom:var(--space-4);">⚠️</div>
      <h3 id="confirmMessage" class="mb-4">Are you sure?</h3>
      <div class="flex gap-3 justify-center">
        <button class="btn btn-secondary" id="confirmNo">Cancel</button>
        <button class="btn btn-danger" id="confirmYes">Confirm</button>
      </div>
    </div>
  </div>
</div>

<div class="toast-container"></div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  // Guard
  Auth.requireAuth();
  Auth.requireRole('principal');

  let enrollChart = null;
  let statusChart  = null;

  document.addEventListener('DOMContentLoaded', loadDashboard);

  document.getElementById('todayDate').textContent = new Date().toLocaleDateString('en-NG', {weekday:'long', year:'numeric', month:'long', day:'numeric'});

  async function loadDashboard() {
    try {
      const res = await API.dashboard.stats();
      if (!res || res.status !== 'success') return;
      const d = res.data;

      renderStats(d.stats);
      renderEnrollmentChart(d.enrollment_trend || []);
      renderStatusChart(d.stats);
      renderPendingStudents(d.recent_student_registrations || []);
      renderAnnouncements(d.recent_announcements || []);
      renderAttendance(d.stats);

      // Badge
      const cnt = d.stats.pending_students;
      const badge = document.getElementById('pendingStudentBadge');
      if (cnt > 0) { badge.textContent = cnt; badge.style.display = ''; }

    } catch (e) {
      Toast.error('Failed to load dashboard data');
    }
  }

  function renderStats(s) {
    const cards = [
      { label: 'Total Students',   value: s.total_students,   icon: '🎓', color: '#3b82f6', bgColor: 'rgba(59,130,246,0.12)' },
      { label: 'Active Students',  value: s.active_students,  icon: '✅', color: '#10b981', bgColor: 'rgba(16,185,129,0.12)' },
      { label: 'Pending Students', value: s.pending_students, icon: '⏳', color: '#f59e0b', bgColor: 'rgba(245,158,11,0.12)' },
      { label: 'Teachers',         value: s.total_teachers,   icon: '👨‍🏫', color: '#6366f1', bgColor: 'rgba(99,102,241,0.12)' },
      { label: 'Departments',      value: s.departments,      icon: '🏛️', color: '#8b5cf6', bgColor: 'rgba(139,92,246,0.12)' },
      { label: 'Classes',          value: s.classes,          icon: '📚', color: '#ec4899', bgColor: 'rgba(236,72,153,0.12)' },
    ];

    document.getElementById('statsGrid').innerHTML = cards.map(c => `
      <div class="stat-card" style="--stat-color:${c.color};--stat-color-bg:${c.bgColor};">
        <div class="stat-icon">${c.icon}</div>
        <div class="stat-value">${Number(c.value || 0).toLocaleString()}</div>
        <div class="stat-label">${c.label}</div>
      </div>
    `).join('');
  }

  function renderEnrollmentChart(trend) {
    const labels = trend.map(t => {
      const [y, m] = t.month.split('-');
      return new Date(y, m-1).toLocaleDateString('en-NG', {month:'short', year:'2-digit'});
    });
    const data = trend.map(t => t.count);

    if (enrollChart) enrollChart.destroy();
    enrollChart = new Chart(document.getElementById('enrollmentChart'), {
      type: 'line',
      data: {
        labels: labels.length ? labels : ['Jan','Feb','Mar','Apr','May','Jun'],
        datasets: [{
          label: 'New Enrollments',
          data: data.length ? data : [0,0,0,0,0,0],
          borderColor: '#3b82f6',
          backgroundColor: 'rgba(59,130,246,0.1)',
          borderWidth: 2.5,
          fill: true,
          tension: 0.4,
          pointBackgroundColor: '#3b82f6',
          pointRadius: 4,
          pointHoverRadius: 6,
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, grid: { color: 'rgba(148,163,184,0.08)' }, ticks: { stepSize: 1 } },
          x: { grid: { display: false } }
        }
      }
    });
  }

  function renderStatusChart(s) {
    const data = [s.active_students||0, s.pending_students||0, (s.total_students||0)-(s.active_students||0)-(s.pending_students||0)];
    const labels = ['Active','Pending','Other'];
    const colors = ['#10b981','#f59e0b','#6366f1'];

    if (statusChart) statusChart.destroy();
    statusChart = new Chart(document.getElementById('statusChart'), {
      type: 'doughnut',
      data: { labels, datasets: [{ data, backgroundColor: colors, borderColor: '#111827', borderWidth: 3, hoverOffset: 6 }] },
      options: {
        responsive: true, maintainAspectRatio: false,
        cutout: '70%',
        plugins: { legend: { display: false } }
      }
    });

    document.getElementById('statusLegend').innerHTML = labels.map((l,i) => `
      <div class="flex items-center gap-2" style="margin-bottom:6px;">
        <div style="width:10px;height:10px;border-radius:50%;background:${colors[i]};flex-shrink:0;"></div>
        <span class="text-xs text-secondary">${l}</span>
        <span class="text-xs font-semibold" style="margin-left:auto;">${Number(data[i]).toLocaleString()}</span>
      </div>
    `).join('');
  }

  function renderPendingStudents(list) {
    const el = document.getElementById('pendingStudentsList');
    if (!list.length) {
      el.innerHTML = `<div class="empty-state"><div class="empty-state-icon">✅</div><div class="empty-state-title">No Pending Applications</div><div class="empty-state-desc">All student applications have been reviewed.</div></div>`;
      return;
    }
    el.innerHTML = list.map(s => `
      <div class="notif-item" style="border-bottom:1px solid var(--color-border);padding:var(--space-3) var(--space-4);">
        <div class="notif-icon-wrap" style="background:rgba(245,158,11,0.12);">🎓</div>
        <div class="notif-text" style="flex:1;">
          <div class="notif-title">${s.full_name}</div>
          <div class="notif-msg">${s.email} · ${s.class_name||'—'}</div>
          <div class="notif-time">${Format.timeAgo(s.created_at)}</div>
        </div>
        <a href="approvals" class="btn btn-warning btn-sm">Review</a>
      </div>
    `).join('');
  }

  function renderAnnouncements(list) {
    const el = document.getElementById('announcementsList');
    if (!list.length) {
      el.innerHTML = `<div class="empty-state"><div class="empty-state-icon">📢</div><div class="empty-state-title">No Announcements Yet</div><div class="empty-state-desc">Post an announcement to inform teachers and students.</div></div>`;
      return;
    }
    el.innerHTML = list.map(a => `
      <div style="padding:var(--space-3) var(--space-4);border-bottom:1px solid var(--color-border);">
        <div class="flex items-center justify-between mb-4">
          <span class="font-semibold text-sm">${a.title}</span>
          <span class="text-xs text-muted">${Format.timeAgo(a.created_at)}</span>
        </div>
        <div class="text-xs text-muted">By ${a.author}</div>
      </div>
    `).join('');
  }

  function renderAttendance(s) {
    document.getElementById('att-present').textContent = Number(s.present_today||0).toLocaleString();
    document.getElementById('att-absent').textContent  = Number(s.absent_today||0).toLocaleString();
    const total = (s.present_today||0) + (s.absent_today||0);
    const rate  = total > 0 ? Math.round((s.present_today / total) * 100) : 0;
    document.getElementById('att-rate').textContent  = rate + '%';
    document.getElementById('att-total').textContent = Number(s.total_students||0).toLocaleString();
  }
</script>
</body>
</html>
