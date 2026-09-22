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
      <a href="attendance" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Attendance
      </a>

      <div class="nav-section-label">Administration</div>
      <a href="reports" class="nav-item active">
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

      <!-- Query parameters card -->
      <div class="card mb-6">
        <div class="card-header"><h3 class="card-title">Select Report Parameters</h3></div>
        <div class="form-row" style="grid-template-columns: repeat(4, 1fr);">
          <div class="form-group">
            <label class="form-label" for="reportType">Report Category</label>
            <select id="reportType" class="form-control">
              <option value="recruitment">Recruitment Summary</option>
              <option value="staffing">Staff by Department</option>
              <option value="attendance">Teacher Attendance Logs</option>
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
  Auth.requireRole('unit_head');

  // Load sidebar pending teacher count
  document.addEventListener('DOMContentLoaded', () => {
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

  function generateReport() {
    const type = document.getElementById('reportType').value;
    const session = document.getElementById('sessionSelect').value;
    const term = document.getElementById('termSelect').value;
    const container = document.getElementById('printableReportArea');

    const teachers = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]').filter(s => s.role === 'teacher');
    const departments = JSON.parse(localStorage.getItem('sams_mock_departments') || '[]');
    const teacherRegs = JSON.parse(localStorage.getItem('sams_mock_teacher_regs') || '[]');

    let reportHtml = '';

    if (type === 'recruitment') {
      const pending = teacherRegs.filter(r => r.status === 'pending').length;
      const approved = teacherRegs.filter(r => r.status === 'approved').length;
      const rejected = teacherRegs.filter(r => r.status === 'rejected').length;

      reportHtml = `
        <div style="padding:var(--space-6);background:var(--color-bg-surface);border-radius:var(--radius-lg);border:1px solid var(--color-border);color:var(--color-text-primary);">
          <div class="flex justify-between items-center" style="border-bottom:2px solid var(--color-accent);padding-bottom:var(--space-4);margin-bottom:var(--space-6);">
            <div>
              <h2 style="color:var(--color-accent-light);font-size:var(--font-size-2xl);">PLAN AID ACADEMY</h2>
              <p class="text-xs text-secondary">Jos, Plateau State, Nigeria</p>
            </div>
            <div style="text-align:right;">
              <h4 class="font-bold">Teacher Recruitment Report</h4>
              <p class="text-xs text-muted">${session} · ${term}</p>
            </div>
          </div>

          <div class="grid gap-4 grid-cols-3 mb-6">
            <div style="border:1px solid var(--color-border);padding:var(--space-4);border-radius:var(--radius-md);background:rgba(245,158,11,0.08);">
              <div class="text-xs text-secondary">Pending Reviews</div>
              <div class="text-2xl font-bold" style="color:#f59e0b;">${pending}</div>
            </div>
            <div style="border:1px solid var(--color-border);padding:var(--space-4);border-radius:var(--radius-md);background:rgba(30,58,138,0.12);">
              <div class="text-xs text-secondary">Approved Applicants</div>
              <div class="text-2xl font-bold" style="color:#1e3a8a;">${approved}</div>
            </div>
            <div style="border:1px solid var(--color-border);padding:var(--space-4);border-radius:var(--radius-md);background:rgba(239,68,68,0.08);">
              <div class="text-xs text-secondary">Rejected Applications</div>
              <div class="text-2xl font-bold" style="color:#ef4444;">${rejected}</div>
            </div>
          </div>

          <h3 class="mb-4">Recent Applicants Roster</h3>
          <table class="table">
            <thead>
              <tr>
                <th>Applicant Name</th>
                <th>Email / Phone</th>
                <th>Department</th>
                <th>Status</th>
                <th>Applied Date</th>
              </tr>
            </thead>
            <tbody>
              ${teacherRegs.map(r => `
                <tr>
                  <td><strong>${r.full_name}</strong><br><small style="color:var(--color-text-muted);">${r.qualification}</small></td>
                  <td>${r.email}<br><small style="color:var(--color-text-muted);">${r.phone}</small></td>
                  <td>${r.department_name || '—'}</td>
                  <td>${Format.badge(r.status)}</td>
                  <td><code>${Format.date(r.created_at)}</code></td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>
      `;
    } else if (type === 'staffing') {
      const deptCounts = departments.map(d => {
        const count = teachers.filter(t => String(t.department_id) === String(d.id)).length;
        return { name: d.name, code: d.code, head: d.Head || 'Unassigned', count };
      });

      reportHtml = `
        <div style="padding:var(--space-6);background:var(--color-bg-surface);border-radius:var(--radius-lg);border:1px solid var(--color-border);color:var(--color-text-primary);">
          <div class="flex justify-between items-center" style="border-bottom:2px solid var(--color-success);padding-bottom:var(--space-4);margin-bottom:var(--space-6);">
            <div>
              <h2 style="color:var(--color-success);font-size:var(--font-size-2xl);">PLAN AID ACADEMY</h2>
              <p class="text-xs text-secondary">Jos, Plateau State, Nigeria</p>
            </div>
            <div style="text-align:right;">
              <h4 class="font-bold">Staff Distribution by Department</h4>
              <p class="text-xs text-muted">${session} · ${term}</p>
            </div>
          </div>

          <table class="table">
            <thead>
              <tr>
                <th>Department Code</th>
                <th>Department Name</th>
                <th>Head of Department</th>
                <th class="text-right">Teachers Count</th>
              </tr>
            </thead>
            <tbody>
              ${deptCounts.map(dc => `
                <tr>
                  <td><code>${dc.code}</code></td>
                  <td><strong>${dc.name}</strong></td>
                  <td>${dc.head}</td>
                  <td class="text-right font-bold">${dc.count}</td>
                </tr>
              `).join('')}
              <tr>
                <td colspan="3"><strong>Total Active Teachers</strong></td>
                <td class="text-right font-bold" style="border-top: 2px solid var(--color-border);">${teachers.length}</td>
              </tr>
            </tbody>
          </table>
        </div>
      `;
    } else if (type === 'attendance') {
      // Teachers attendance logs
      reportHtml = `
        <div style="padding:var(--space-6);background:var(--color-bg-surface);border-radius:var(--radius-lg);border:1px solid var(--color-border);color:var(--color-text-primary);">
          <div class="flex justify-between items-center" style="border-bottom:2px solid var(--color-info);padding-bottom:var(--space-4);margin-bottom:var(--space-6);">
            <div>
              <h2 style="color:var(--color-accent-light);font-size:var(--font-size-2xl);">PLAN AID ACADEMY</h2>
              <p class="text-xs text-secondary">Jos, Plateau State, Nigeria</p>
            </div>
            <div style="text-align:right;">
              <h4 class="font-bold">Teacher Attendance Logs</h4>
              <p class="text-xs text-muted">${session} · ${term}</p>
            </div>
          </div>

          <table class="table">
            <thead>
              <tr>
                <th>Teacher Name</th>
                <th>Employee ID</th>
                <th>Status (Today)</th>
                <th>Duty Status</th>
              </tr>
            </thead>
            <tbody>
              ${teachers.map((t, idx) => `
                <tr>
                  <td><strong>${t.first_name} ${t.last_name}</strong></td>
                  <td><code>${t.staff_id}</code></td>
                  <td>${Format.badge(idx % 4 === 0 ? 'absent' : 'present')}</td>
                  <td>${idx % 4 === 0 ? 'Excused (Sick Leave)' : 'On Duty'}</td>
                </tr>
              `).join('')}
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
