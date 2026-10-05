<?php
require_once __DIR__ . '/../../includes/Helpers.php';
AuthHelper::requireRole(['teacher', 'principal', 'admin']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <script src="../../assets/js/auth.js"></script>
  <script>
    Auth.requireAuth();
    Auth.requireRole('teacher');
  </script>
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
        <div class="sidebar-logo-role">Teacher Portal</div>
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

      <div class="nav-section-label">Academics</div>
      <a href="classes" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Assigned Classes &amp; Students
      </a>
      <a href="timetable" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Today's Timetable
      </a>

      <div class="nav-section-label">Student Records</div>
      <a href="attendance" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Mark Attendance
      </a>
      <a href="results" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4M7.5 8h9M7.5 16h9M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        Enter &amp; Submit Results
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
          <div class="page-title">Teacher Dashboard</div>
          <div class="page-breadcrumb">Welcome back, <span data-user-name>Fatima Sani</span></div>
        </div>
      </div>
      <div class="topbar-right">
        <span class="session-badge session-info">2025/2026 | 1st Term</span>
        <button class="icon-btn" id="notifBtn" aria-label="Notifications">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
          <span class="dot notif-count-dot"></span>
        </button>
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

      <!-- Stats Grid (8 Core Items Required) -->
      <div class="stats-grid stats-grid-4 mb-6">
        <div class="stat-card" style="--stat-color:#6366f1;--stat-color-bg:rgba(99,102,241,0.12)">
          <div class="stat-icon">🏫</div>
          <div class="stat-value">2 Classes</div>
          <div class="stat-label">Assigned Classes (JSS 2A, SS 1 STEM)</div>
        </div>
        <div class="stat-card" style="--stat-color:#3b82f6;--stat-color-bg:rgba(59,130,246,0.12)">
          <div class="stat-icon">📚</div>
          <div class="stat-value">2 Subjects</div>
          <div class="stat-label">Assigned Subjects (Biology, Basic Science)</div>
        </div>
        <div class="stat-card" style="--stat-color:#f59e0b;--stat-color-bg:rgba(245,158,11,0.12)">
          <div class="stat-icon">⌛</div>
          <div class="stat-value" id="pendingAttendanceTask">1 Pending</div>
          <div class="stat-label">Daily Attendance Task</div>
        </div>
        <div class="stat-card" style="--stat-color:#10b981;--stat-color-bg:rgba(16,185,129,0.12)">
          <div class="stat-icon">📝</div>
          <div class="stat-value" id="pendingResultsTask">2 Drafts</div>
          <div class="stat-label">Pending Results Entry</div>
        </div>
      </div>

      <!-- Schedule & Upcoming Exams Row -->
      <div class="grid gap-6 mb-6" style="grid-template-columns: 1.4fr 1fr;">

        <!-- Today's Timetable -->
        <div class="card">
          <div class="card-header flex justify-between items-center">
            <h3 class="card-title">📅 Today's Teaching Timetable</h3>
            <a href="timetable" class="btn btn-secondary btn-sm">Full Timetable →</a>
          </div>
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                  <th>Period / Time</th>
                  <th>Class</th>
                  <th>Subject</th>
                  <th>Classroom</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><code>09:00 - 10:00 AM</code></td>
                  <td><strong>JSS 2A</strong></td>
                  <td>Basic Science</td>
                  <td>Room 104</td>
                </tr>
                <tr>
                  <td><code>11:30 - 12:30 PM</code></td>
                  <td><strong>SS 1 STEM</strong></td>
                  <td>Biology (Cell Structures)</td>
                  <td>Science Lab 2</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Upcoming Examinations Card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">📝 Upcoming Examinations</h3>
          </div>
          <div class="flex flex-col gap-3">
            <div style="padding:var(--space-3);background:var(--color-bg-elevated);border-radius:var(--radius-md);border-left:4px solid var(--color-warning);">
              <div class="font-semibold text-sm">1st Term Biology CA 2 Test</div>
              <div class="text-xs text-muted">SS 1 STEM · Friday, Oct 3, 2026 (10:00 AM)</div>
            </div>
            <div style="padding:var(--space-3);background:var(--color-bg-elevated);border-radius:var(--radius-md);border-left:4px solid var(--color-accent);">
              <div class="font-semibold text-sm">Basic Science Mid-Term Practical Exam</div>
              <div class="text-xs text-muted">JSS 2A · Wednesday, Oct 8, 2026 (11:30 AM)</div>
            </div>
          </div>
        </div>

      </div>

      <!-- Announcements & Notifications Row -->
      <div class="grid gap-6" style="grid-template-columns: 1fr 1fr;">

        <!-- School Announcements -->
        <div class="card">
          <div class="card-header flex justify-between items-center">
            <h3 class="card-title">📢 School Announcements</h3>
            <a href="attendance" class="btn btn-primary btn-sm">+ Send Class Announcement</a>
          </div>
          <div id="announcementList">
            <div class="empty-state"><div class="spinner"></div></div>
          </div>
        </div>

        <!-- Staff Notifications -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">🔔 Staff Notifications</h3>
          </div>
          <div class="notif-list">
            <div class="notif-item" style="border-bottom:1px solid var(--color-border);padding:var(--space-3) 0;">
              <div class="notif-icon-wrap" style="background:rgba(59,130,246,0.12);">📋</div>
              <div class="notif-text">
                <div class="notif-title">Result Submission Reminder</div>
                <div class="notif-msg text-xs text-muted">Please submit 1st Term CA scores for approval by Friday.</div>
              </div>
            </div>
            <div class="notif-item" style="padding:var(--space-3) 0;">
              <div class="notif-icon-wrap" style="background:rgba(16,185,129,0.12);">✅</div>
              <div class="notif-text">
                <div class="notif-title">Staff Meeting Scheduled</div>
                <div class="notif-msg text-xs text-muted">General academic staff briefing at 2:00 PM in the Assembly Hall.</div>
              </div>
            </div>
          </div>
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

  document.addEventListener('DOMContentLoaded', async () => {
    await loadAnnouncements();
  });

  async function loadAnnouncements() {
    const el = document.getElementById('announcementList');
    try {
      const res = await API.announcements.list();
      const list = (res && res.status === 'success') ? res.data : [];
      if (!list.length) {
        el.innerHTML = '<div class="empty-state">No announcements posted</div>';
        return;
      }
      el.innerHTML = list.slice(0, 3).map(a => `
        <div style="border-bottom:1px solid var(--color-border);padding:var(--space-3) 0;">
          <div class="flex justify-between items-center mb-1">
            <strong>${a.title}</strong>
            <span class="text-xs text-muted">${Format.timeAgo(a.created_at)}</span>
          </div>
          <p class="text-xs text-secondary">${a.body}</p>
        </div>
      `).join('');
    } catch(e) {
      el.innerHTML = '<div class="empty-state">Error loading announcements</div>';
    }
  }
</script>
</body>
</html>
