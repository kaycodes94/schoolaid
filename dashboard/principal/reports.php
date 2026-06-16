<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reports — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    @media print {
      body * { visibility: hidden; }
      #printableReportArea, #printableReportArea * { visibility: visible; }
      #printableReportArea { position: absolute; left: 0; top: 0; width: 100%; }
      .app-shell { display: block; }
      .sidebar, .topbar, .page-header, .card:not(#printableReportCard), .btn { display: none !important; }
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
      <a href="attendance" class="nav-item">
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
      <a href="reports" class="nav-item active" id="nav-reports">
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
          <div class="page-title">Report Generator</div>
          <div class="page-breadcrumb">Administration / <span>Reports</span></div>
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

      <!-- Query parameters card -->
      <div class="card mb-6">
        <div class="card-header"><h3 class="card-title">Select Report Parameters</h3></div>
        <div class="form-row" style="grid-template-columns: repeat(4, 1fr);">
          <div class="form-group">
            <label class="form-label" for="reportType">Report Category</label>
            <select id="reportType" class="form-control" onchange="updateOptions()">
              <option value="enrollment">Enrollment Directory</option>
              <option value="finance">Tuition Collections</option>
              <option value="performance">Class Performance</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="sessionSelect">Academic Session</label>
            <select id="sessionSelect" class="form-control">
              <option>2025/2026</option>
              <option>2024/2025</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="termSelect">Term</label>
            <select id="termSelect" class="form-control">
              <option>1st Term</option>
              <option>2nd Term</option>
              <option>3rd Term</option>
            </select>
          </div>
          <div class="form-group flex items-end">
            <button class="btn btn-primary btn-block" onclick="generateReport()">Generate Report</button>
          </div>
        </div>
      </div>

      <!-- Printable Report Card -->
      <div class="card" id="printableReportCard" style="display:none;">
        <div class="flex justify-between items-center mb-6" style="border-bottom:1px solid var(--color-border);padding-bottom:var(--space-4);">
          <div class="text-sm text-secondary">Report Preview</div>
          <button class="btn btn-secondary btn-sm" onclick="window.print()">🖨️ Print / Save PDF</button>
        </div>
        
        <div id="printableReportArea">
          <!-- Populated Dynamically -->
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

  function generateReport() {
    const type = document.getElementById('reportType').value;
    const session = document.getElementById('sessionSelect').value;
    const term = document.getElementById('termSelect').value;
    const container = document.getElementById('printableReportArea');

    let reportHtml = '';

    if (type === 'enrollment') {
      reportHtml = `
        <div style="padding:var(--space-6);background:var(--color-bg-surface);border-radius:var(--radius-lg);border:1px solid var(--color-border);color:var(--color-text-primary);">
          <div class="flex justify-between items-center" style="border-bottom:2px solid var(--color-accent);padding-bottom:var(--space-4);margin-bottom:var(--space-6);">
            <div>
              <h2 style="color:var(--color-accent-light);font-size:var(--font-size-2xl);">PLAN AID ACADEMY</h2>
              <p class="text-xs text-secondary">Jos, Plateau State, Nigeria</p>
            </div>
            <div style="text-align:right;">
              <h4 class="font-bold">Student Enrollment Report</h4>
              <p class="text-xs text-muted">${session} · ${term}</p>
            </div>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>Class</th>
                <th>Male Count</th>
                <th>Female Count</th>
                <th>Total Enrolled</th>
              </tr>
            </thead>
            <tbody>
              <tr><td><strong>JSS 1</strong></td><td>24</td><td>28</td><td>52</td></tr>
              <tr><td><strong>JSS 2</strong></td><td>21</td><td>21</td><td>42</td></tr>
              <tr><td><strong>JSS 3</strong></td><td>18</td><td>22</td><td>40</td></tr>
              <tr><td><strong>SSS 1</strong></td><td>15</td><td>20</td><td>35</td></tr>
              <tr><td><strong>Total Summary</strong></td><td><strong>78</strong></td><td><strong>91</strong></td><td><strong>169</strong></td></tr>
            </tbody>
          </table>
        </div>
      `;
    } else if (type === 'finance') {
      reportHtml = `
        <div style="padding:var(--space-6);background:var(--color-bg-surface);border-radius:var(--radius-lg);border:1px solid var(--color-border);color:var(--color-text-primary);">
          <div class="flex justify-between items-center" style="border-bottom:2px solid var(--color-success);padding-bottom:var(--space-4);margin-bottom:var(--space-6);">
            <div>
              <h2 style="color:var(--color-success);font-size:var(--font-size-2xl);">PLAN AID ACADEMY</h2>
              <p class="text-xs text-secondary">Jos, Plateau State, Nigeria</p>
            </div>
            <div style="text-align:right;">
              <h4 class="font-bold">Fee Collection Summary</h4>
              <p class="text-xs text-muted">${session} · ${term}</p>
            </div>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>Class</th>
                <th>Target Amount (₦)</th>
                <th>Collected Amount (₦)</th>
                <th>Outstanding (₦)</th>
              </tr>
            </thead>
            <tbody>
              <tr><td><strong>SSS 1</strong></td><td>2,275,000.00</td><td>1,950,000.00</td><td>325,000.00</td></tr>
              <tr><td><strong>JSS 2</strong></td><td>1,890,000.00</td><td>1,530,000.00</td><td>360,000.00</td></tr>
              <tr><td><strong>Primary 5</strong></td><td>1,064,000.00</td><td>874,000.00</td><td>190,000.00</td></tr>
              <tr><td><strong>Total Summary</strong></td><td><strong>5,229,000.00</strong></td><td><strong>4,354,000.00</strong></td><td><strong>875,000.00</strong></td></tr>
            </tbody>
          </table>
        </div>
      `;
    } else {
      reportHtml = `
        <div style="padding:var(--space-6);background:var(--color-bg-surface);border-radius:var(--radius-lg);border:1px solid var(--color-border);color:var(--color-text-primary);">
          <div class="flex justify-between items-center" style="border-bottom:2px solid var(--color-info);padding-bottom:var(--space-4);margin-bottom:var(--space-6);">
            <div>
              <h2 style="color:var(--color-accent-light);font-size:var(--font-size-2xl);">PLAN AID ACADEMY</h2>
              <p class="text-xs text-secondary">Jos, Plateau State, Nigeria</p>
            </div>
            <div style="text-align:right;">
              <h4 class="font-bold">Class Performance Report</h4>
              <p class="text-xs text-muted">${session} · ${term}</p>
            </div>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>Class</th>
                <th>Class Average (%)</th>
                <th>High Score (%)</th>
                <th>Low Score (%)</th>
                <th>Pass Rate (%)</th>
              </tr>
            </thead>
            <tbody>
              <tr><td><strong>SSS 1</strong></td><td>79.6%</td><td>96.0%</td><td>45.0%</td><td>97.1%</td></tr>
              <tr><td><strong>JSS 2</strong></td><td>85.4%</td><td>98.5%</td><td>50.0%</td><td>100.0%</td></tr>
              <tr><td><strong>Primary 5</strong></td><td>71.7%</td><td>88.0%</td><td>40.0%</td><td>92.8%</td></tr>
            </tbody>
          </table>
        </div>
      `;
    }

    container.innerHTML = reportHtml;
    document.getElementById('printableReportCard').style.display = 'block';
  }
</script>
</body>
</html>
