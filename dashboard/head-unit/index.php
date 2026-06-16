<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Head Unit Dashboard — School Aid Management System</title>
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
      <a href="index" class="nav-item active" id="nav-dashboard">
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
      <a href="attendance" class="nav-item">
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
          <div class="page-title">Dashboard</div>
          <div class="page-breadcrumb">Welcome back, <span data-user-name>Amaka Uche</span></div>
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
      <div class="stats-grid stats-grid-4 mb-6" id="statsGrid">
        <div class="stat-card"><div class="skeleton" style="height:100px;"></div></div>
        <div class="stat-card"><div class="skeleton" style="height:100px;"></div></div>
        <div class="stat-card"><div class="skeleton" style="height:100px;"></div></div>
        <div class="stat-card"><div class="skeleton" style="height:100px;"></div></div>
      </div>

      <!-- Charts + Pending Grid -->
      <div class="grid gap-6 mb-6" style="grid-template-columns: 1fr 380px;">
        <!-- PENDING APPLICATIONS -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Pending Teacher Applications</h3>
            <a href="approvals" class="btn btn-secondary btn-sm">View All Queue →</a>
          </div>
          <div id="pendingTeacherList">
            <div class="empty-state"><div class="spinner"></div></div>
          </div>
        </div>

        <!-- TEACHERS PER DEPARTMENT CHART -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Staff by Department</h3>
          </div>
          <div class="chart-container" style="height:200px;">
            <canvas id="deptStaffChart"></canvas>
          </div>
        </div>
      </div>

      <!-- RECENT ACTION HISTORY -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Recent Approvals Log</h3>
        </div>
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Applicant Type</th>
                <th>Outcome</th>
                <th>Processed At</th>
                <th>Approver</th>
              </tr>
            </thead>
            <tbody id="approvalsHistoryList">
              <tr><td colspan="4"><div class="empty-state"><div class="spinner"></div></div></td></tr>
            </tbody>
          </table>
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
  Auth.requireAuth();
  Auth.requireRole('unit_head');

  let deptChart = null;

  document.addEventListener('DOMContentLoaded', loadHeadUnitDashboard);

  async function loadHeadUnitDashboard() {
    try {
      const res = await API.dashboard.stats();
      if (!res || res.status !== 'success') return;
      const d = res.data;

      // Stats
      renderStats(d.stats);
      renderPendingTeachers(d.pending_teacher_applications || []);
      renderDeptChart(d.teachers_by_department || []);
      renderHistory(d.recent_approval_history || []);

      // Badge
      const pendingCnt = d.stats.pending_teachers;
      const badge = document.getElementById('pendingTeacherBadge');
      if (pendingCnt > 0) {
        badge.textContent = pendingCnt;
        badge.style.display = '';
      }

    } catch (e) {
      Toast.error('Error', 'Failed to load dashboard data');
    }
  }

  function renderStats(s) {
    const cards = [
      { label: 'Total Teachers', value: s.total_teachers, icon: '👨‍🏫', color: '#6366f1', bgColor: 'rgba(99,102,241,0.12)' },
      { label: 'Active Teachers', value: s.active_teachers, icon: '✅', color: '#10b981', bgColor: 'rgba(16,185,129,0.12)' },
      { label: 'Pending Recruits', value: s.pending_teachers, icon: '⏳', color: '#f59e0b', bgColor: 'rgba(245,158,11,0.12)' },
      { label: 'Syllabus Groups', value: s.departments, icon: '🏛️', color: '#3b82f6', bgColor: 'rgba(59,130,246,0.12)' },
    ];

    document.getElementById('statsGrid').innerHTML = cards.map(c => `
      <div class="stat-card" style="--stat-color:${c.color};--stat-color-bg:${c.bgColor};">
        <div class="stat-icon">${c.icon}</div>
        <div class="stat-value">${Number(c.value || 0).toLocaleString()}</div>
        <div class="stat-label">${c.label}</div>
      </div>
    `).join('');
  }

  function renderPendingTeachers(list) {
    const el = document.getElementById('pendingTeacherList');
    if (!list.length) {
      el.innerHTML = `<div class="empty-state"><div class="empty-state-icon">✅</div><div class="empty-state-title">All Caught Up</div><div class="empty-state-desc">No pending teacher applications.</div></div>`;
      return;
    }

    el.innerHTML = list.map(t => `
      <div class="notif-item" style="border-bottom:1px solid var(--color-border);padding:var(--space-3) var(--space-4);">
        <div class="notif-icon-wrap" style="background:rgba(99,102,241,0.12);">👩‍🏫</div>
        <div class="notif-text" style="flex:1;">
          <div class="notif-title">${t.full_name}</div>
          <div class="notif-msg">${t.qualification}</div>
          <div class="notif-time">${Format.timeAgo(t.created_at)}</div>
        </div>
        <a href="approvals" class="btn btn-warning btn-sm">Review</a>
      </div>
    `).join('');
  }

  function renderDeptChart(data) {
    const labels = data.map(d => d.dept);
    const counts = data.map(d => d.count);

    if (deptChart) deptChart.destroy();
    deptChart = new Chart(document.getElementById('deptStaffChart'), {
      type: 'doughnut',
      data: {
        labels: labels.length ? labels : ['Science', 'Arts', 'Primary', 'Nursery'],
        datasets: [{
          data: counts.length ? counts : [8, 5, 12, 6],
          backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#6366f1', '#ec4899'],
          borderColor: '#111827',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        cutout: '65%',
        plugins: { legend: { display: false } }
      }
    });
  }

  function renderHistory(list) {
    const el = document.getElementById('approvalsHistoryList');
    if (!list.length) {
      el.innerHTML = `<tr><td colspan="4"><div class="empty-state"><div class="empty-state-title">No Actions Recorded</div></div></td></tr>`;
      return;
    }

    el.innerHTML = list.map(h => `
      <tr>
        <td><strong>${Format.role(h.applicant_type)}</strong></td>
        <td>${Format.badge(h.approval_status)}</td>
        <td><code>${Format.datetime(h.approval_date)}</code></td>
        <td>${h.approver_name}</td>
      </tr>
    `).join('');
  }

  Format.role = (role) => {
    return role === 'teacher' ? 'Teacher Application' : 'Student Enrollment';
  };
</script>
</body>
</html>
