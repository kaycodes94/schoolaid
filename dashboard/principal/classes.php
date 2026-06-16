<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Classes — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
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
      <a href="classes" class="nav-item active" id="nav-classes">
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
          <div class="page-title">Classes</div>
          <div class="page-breadcrumb">Academic / <span>Classes</span></div>
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

      <!-- Page Header -->
      <div class="page-header">
        <div class="page-header-text">
          <h2>School Classes</h2>
          <p class="text-secondary">View and organize all active classrooms, academic sessions, and assigned form teachers.</p>
        </div>
        <div class="page-header-actions">
          <button class="btn btn-primary" onclick="Modal.open('classModal')">+ Add Class</button>
        </div>
      </div>

      <!-- Classes Grid -->
      <div class="grid gap-6 grid-cols-3" id="classesGrid">
        <!-- Seed classes -->
        <div class="card flex flex-col justify-between">
          <div>
            <div class="flex justify-between items-center mb-4">
              <span class="badge badge-primary">SEC</span>
              <span class="badge badge-success">35 Students</span>
            </div>
            <h3 style="margin-bottom:var(--space-1);">SSS 1</h3>
            <p class="text-xs text-secondary mb-3">Code: <code>SSS1-2025</code></p>
            <p class="text-xs text-muted">Academic Session: 2025/2026</p>
          </div>
          <div class="flex items-center justify-between" style="border-top:1px solid var(--color-border);padding-top:var(--space-3);margin-top:var(--space-4);">
            <div class="text-xs">Teacher: <strong>Fatima Sani</strong></div>
            <span class="badge badge-info">1st Term</span>
          </div>
        </div>

        <div class="card flex flex-col justify-between">
          <div>
            <div class="flex justify-between items-center mb-4">
              <span class="badge badge-primary">SEC</span>
              <span class="badge badge-success">42 Students</span>
            </div>
            <h3 style="margin-bottom:var(--space-1);">JSS 2</h3>
            <p class="text-xs text-secondary mb-3">Code: <code>JSS2-2025</code></p>
            <p class="text-xs text-muted">Academic Session: 2025/2026</p>
          </div>
          <div class="flex items-center justify-between" style="border-top:1px solid var(--color-border);padding-top:var(--space-3);margin-top:var(--space-4);">
            <div class="text-xs">Teacher: <strong>Amaka Uche</strong></div>
            <span class="badge badge-info">1st Term</span>
          </div>
        </div>

        <div class="card flex flex-col justify-between">
          <div>
            <div class="flex justify-between items-center mb-4">
              <span class="badge badge-primary">PRI</span>
              <span class="badge badge-success">28 Students</span>
            </div>
            <h3 style="margin-bottom:var(--space-1);">Primary 5</h3>
            <p class="text-xs text-secondary mb-3">Code: <code>PRI5-2025</code></p>
            <p class="text-xs text-muted">Academic Session: 2025/2026</p>
          </div>
          <div class="flex items-center justify-between" style="border-top:1px solid var(--color-border);padding-top:var(--space-3);margin-top:var(--space-4);">
            <div class="text-xs">Teacher: <strong>Elisha Pwol</strong></div>
            <span class="badge badge-info">1st Term</span>
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

<!-- Add Class Modal -->
<div class="modal-overlay" id="classModal">
  <div class="modal" style="max-width:480px;">
    <div class="modal-header">
      <h3 class="modal-title">Create Class</h3>
      <button class="modal-close" onclick="Modal.close('classModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="classForm" onsubmit="createClass(event)">
        <div class="form-group">
          <label class="form-label" for="className">Class Name <span class="required">*</span></label>
          <input type="text" id="className" class="form-control" placeholder="e.g. SSS 2" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="classCode">Class Code <span class="required">*</span></label>
          <input type="text" id="classCode" class="form-control" placeholder="e.g. SSS2-2025" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="classTeacher">Assign Form Teacher</label>
          <select id="classTeacher" class="form-control">
            <option value="">Select teacher</option>
            <option value="7">Fatima Sani</option>
            <option value="2">Amaka Uche</option>
            <option value="8">James Lar</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="classCapacity">Capacity</label>
          <input type="number" id="classCapacity" class="form-control" placeholder="40" value="40">
        </div>

        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('classModal')">Cancel</button>
          <button type="submit" class="btn btn-primary" id="saveClassBtn">Save Class</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
  Auth.requireRole('principal');

  function createClass(e) {
    e.preventDefault();
    const btn = document.getElementById('saveClassBtn');
    btn.disabled = true;

    const name = document.getElementById('className').value.trim();
    const code = document.getElementById('classCode').value.trim().toUpperCase();
    const teacherSel = document.getElementById('classTeacher');
    const teacherName = teacherSel.options[teacherSel.selectedIndex].text;

    const newCard = document.createElement('div');
    newCard.className = 'card flex flex-col justify-between';
    newCard.innerHTML = `
      <div>
        <div class="flex justify-between items-center mb-4">
          <span class="badge badge-primary">SEC</span>
          <span class="badge badge-success">0 Students</span>
        </div>
        <h3 style="margin-bottom:var(--space-1);">${name}</h3>
        <p class="text-xs text-secondary mb-3">Code: <code>${code}</code></p>
        <p class="text-xs text-muted">Academic Session: 2025/2026</p>
      </div>
      <div class="flex items-center justify-between" style="border-top:1px solid var(--color-border);padding-top:var(--space-3);margin-top:var(--space-4);">
        <div class="text-xs">Teacher: <strong>${teacherName !== 'Select teacher' ? teacherName : 'Not Assigned'}</strong></div>
        <span class="badge badge-info">1st Term</span>
      </div>
    `;

    document.getElementById('classesGrid').appendChild(newCard);
    Toast.success('Success', 'New class registered successfully.');
    Modal.close('classModal');
    document.getElementById('classForm').reset();
    btn.disabled = false;
  }
</script>
</body>
</html>
