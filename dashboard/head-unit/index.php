<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arabic &amp; Islamic Studies Unit Portal — Plan Aid Academy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <script src="../../assets/js/auth.js"></script>
  <script>
    Auth.requireAuth();
    Auth.requireRole(['unit_head', 'arabic', 'principal', 'admin']);
  </script>
</head>
<body>
<div class="app-shell">

  <!-- Sidebar Backdrop -->
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- ===================== SIDEBAR ===================== -->
  <aside class="sidebar" id="sidebar">
    <a href="index" class="sidebar-logo">
      <div class="sidebar-logo-icon">☪️</div>
      <div class="sidebar-logo-text">
        <div class="sidebar-logo-name">Plan Aid Academy</div>
        <div class="sidebar-logo-role">Arabic &amp; Islamic Unit</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Overview</div>
      <a href="index" class="nav-item active" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Unit Dashboard
      </a>

      <div class="nav-section-label">Arabic Academics</div>
      <a href="students" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Arabic Students &amp; Classes
      </a>
      <a href="teachers" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        Arabic Teachers
      </a>
      <a href="attendance" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Unit Attendance Summary
      </a>

      <div class="nav-section-label">Results &amp; Approvals</div>
      <a href="approvals" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Pending Arabic Results
      </a>
      <a href="reports" class="nav-item">
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
          <div class="page-title">Arabic &amp; Islamic Studies Unit</div>
          <div class="page-breadcrumb">وحدة اللغة العربية والدراسات الإسلامية</div>
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

      <!-- Stats Grid (6 Core Required Modules) -->
      <div class="stats-grid stats-grid-6 mb-6">
        <div class="stat-card" style="--stat-color:#f59e0b;--stat-color-bg:rgba(245,158,11,0.12)">
          <div class="stat-icon">📖</div>
          <div class="stat-value">118</div>
          <div class="stat-label">Arabic Students</div>
        </div>
        <div class="stat-card" style="--stat-color:#1e3a8a;--stat-color-bg:rgba(30,58,138,0.15)">
          <div class="stat-icon">🏫</div>
          <div class="stat-value">6 Classes</div>
          <div class="stat-label">Arabic &amp; Hifz Track Classes</div>
        </div>
        <div class="stat-card" style="--stat-color:#6366f1;--stat-color-bg:rgba(99,102,241,0.12)">
          <div class="stat-icon">👳‍♂️</div>
          <div class="stat-value">5 Teachers</div>
          <div class="stat-label">Arabic &amp; Islamic Instructors</div>
        </div>
        <div class="stat-card" style="--stat-color:#10b981;--stat-color-bg:rgba(16,185,129,0.12)">
          <div class="stat-icon">📊</div>
          <div class="stat-value">96.4%</div>
          <div class="stat-label">Unit Attendance Rate</div>
        </div>
        <div class="stat-card" style="--stat-color:#ef4444;--stat-color-bg:rgba(239,68,68,0.12)">
          <div class="stat-icon">📝</div>
          <div class="stat-value">3 Sets</div>
          <div class="stat-label">Pending Arabic Results</div>
        </div>
        <div class="stat-card" style="--stat-color:#3b82f6;--stat-color-bg:rgba(59,130,246,0.12)">
          <div class="stat-icon">📢</div>
          <div class="stat-value">4 Posts</div>
          <div class="stat-label">Unit Announcements</div>
        </div>
      </div>

      <!-- Schedule & Pending Results Row -->
      <div class="grid gap-6 mb-6" style="grid-template-columns: 1.4fr 1fr;">

        <!-- Today's Arabic Classes -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">📖 Today's Arabic &amp; Islamic Classes (جدول اليوم)</h3>
          </div>
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                  <th>Period</th>
                  <th>Class / Level</th>
                  <th>Subject (المادة)</th>
                  <th>Instructor</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><code>08:30 - 09:30</code></td>
                  <td><strong>Primary 3 Arabic</strong></td>
                  <td>Qur'an &amp; Tajweed (القرآن والتجويد)</td>
                  <td>Ustadh Bilal</td>
                </tr>
                <tr>
                  <td><code>09:30 - 10:30</code></td>
                  <td><strong>JSS 1 Islamic</strong></td>
                  <td>Arabic Grammar (النحو والصرف)</td>
                  <td>Ustadh Ahmad</td>
                </tr>
                <tr>
                  <td><code>11:30 - 12:30</code></td>
                  <td><strong>SS 1 Hifz</strong></td>
                  <td>Fiqh &amp; Seerah (الفقه والسيرة)</td>
                  <td>Ustadha Aisha</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pending Arabic Results -->
        <div class="card">
          <div class="card-header flex justify-between items-center">
            <h3 class="card-title">📝 Pending Arabic Results</h3>
            <a href="approvals" class="btn btn-secondary btn-sm">Review All →</a>
          </div>
          <div class="flex flex-col gap-3">
            <div style="padding:var(--space-3);background:var(--color-bg-elevated);border-radius:var(--radius-md);border-left:4px solid var(--color-warning);">
              <div class="font-semibold text-sm">JSS 2 Arabic Language CA 1</div>
              <div class="text-xs text-muted">Submitted by Ustadh Bilal · 38 Students</div>
            </div>
            <div style="padding:var(--space-3);background:var(--color-bg-elevated);border-radius:var(--radius-md);border-left:4px solid var(--color-warning);">
              <div class="font-semibold text-sm">SS 1 Islamic Studies Exam Draft</div>
              <div class="text-xs text-muted">Submitted by Ustadha Aisha · 29 Students</div>
            </div>
          </div>
        </div>

      </div>

      <!-- Recent Unit Announcements -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">📢 Arabic Unit Announcements</h3>
        </div>
        <div class="flex flex-col gap-3">
          <div style="padding:var(--space-3);border-bottom:1px solid var(--color-border);">
            <div class="flex justify-between items-center mb-1">
              <strong>Annual Qur'anic Recitation Competition (مسابقة تلاوة القرآن الكريم)</strong>
              <span class="text-xs text-muted">2 days ago</span>
            </div>
            <p class="text-xs text-secondary">The annual Hifz and Tajweed competition date is confirmed for next month. Instructors should prepare class candidates.</p>
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
  Auth.requireRole(['unit_head', 'arabic', 'principal', 'admin']);
</script>
</body>
</html>
