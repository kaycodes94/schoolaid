<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Announcements — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .ann-card {
      border-left: 4px solid var(--color-border);
      transition: all var(--transition-base);
    }
    .ann-card.pinned {
      border-left-color: var(--color-accent);
      background: rgba(59, 130, 246, 0.04);
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
      <a href="announcements" class="nav-item active" id="nav-announcements">
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
          <div class="page-title">Announcements</div>
          <div class="page-breadcrumb">Communication / <span>Announcements</span></div>
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

      <!-- Header actions -->
      <div class="page-header">
        <div class="page-header-text">
          <h2>School Announcements</h2>
          <p class="text-secondary">Post notifications and alerts targeting teachers, students, or administrative staff.</p>
        </div>
        <div class="page-header-actions">
          <button class="btn btn-primary" onclick="Modal.open('annModal')">+ Publish Announcement</button>
        </div>
      </div>

      <!-- Announcements List -->
      <div class="flex flex-col gap-4" id="announcementsContainer">
        <div class="card"><div class="skeleton" style="height:100px;"></div></div>
        <div class="card"><div class="skeleton" style="height:100px;"></div></div>
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

<!-- Publish Modal -->
<div class="modal-overlay" id="annModal">
  <div class="modal" style="max-width:520px;">
    <div class="modal-header">
      <h3 class="modal-title">Publish Announcement</h3>
      <button class="modal-close" onclick="Modal.close('annModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="annForm" onsubmit="publishAnnouncement(event)">
        <div class="form-group">
          <label class="form-label" for="annTitle">Title <span class="required">*</span></label>
          <input type="text" id="annTitle" class="form-control" placeholder="e.g. End of Term Examination Schedule" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="annTarget">Target Audience</label>
          <select id="annTarget" class="form-control">
            <option value="all">All Users</option>
            <option value="teacher">Teachers Only</option>
            <option value="student">Students & Parents Only</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="annBody">Content / Message <span class="required">*</span></label>
          <textarea id="annBody" class="form-control" placeholder="Write announcement text here..." rows="4" required></textarea>
        </div>

        <div class="form-group flex items-center gap-2">
          <input type="checkbox" id="annPin" style="width:16px;height:16px;accent-color:var(--color-accent);">
          <label class="form-label" for="annPin" style="margin-bottom:0;cursor:pointer;">Pin to top of dashboards</label>
        </div>

        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('annModal')">Cancel</button>
          <button type="submit" class="btn btn-primary" id="pubBtn">Publish Announcement</button>
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

  document.addEventListener('DOMContentLoaded', loadAnnouncements);

  async function loadAnnouncements() {
    const container = document.getElementById('announcementsContainer');
    container.innerHTML = `
      <div class="card"><div class="skeleton" style="height:100px;"></div></div>
      <div class="card"><div class="skeleton" style="height:100px;"></div></div>
    `;

    try {
      const res = await API.announcements.list();
      if (!res || res.status !== 'success') {
        container.innerHTML = `<div class="empty-state"><div class="empty-state-title">Error Loading Announcements</div></div>`;
        return;
      }

      const list = res.data || [];
      if (list.length === 0) {
        container.innerHTML = `<div class="empty-state"><div class="empty-state-icon">📢</div><div class="empty-state-title">No Announcements Posted</div><div class="empty-state-desc">Announcements you publish will show up here.</div></div>`;
        return;
      }

      container.innerHTML = list.map(a => `
        <div class="card ann-card ${a.is_pinned ? 'pinned' : ''}">
          <div class="flex items-start justify-between mb-2">
            <div>
              <div class="flex items-center gap-2 mb-1">
                <h3 class="text-lg font-bold">${a.title}</h3>
                ${a.is_pinned ? `<span class="badge badge-primary">📌 Pinned</span>` : ''}
                <span class="badge badge-info">To: ${Format.audience(a.target_role)}</span>
              </div>
              <div class="text-xs text-muted">Posted by <strong>${a.author || 'Principal'}</strong> · ${Format.datetime(a.created_at)}</div>
            </div>
            <button class="btn btn-danger btn-sm" onclick="deleteAnnouncement(${a.id})">Delete</button>
          </div>
          <p class="text-sm text-secondary" style="white-space:pre-wrap;line-height:1.7;">${a.body}</p>
        </div>
      `).join('');
    } catch (e) {
      container.innerHTML = `<div class="empty-state"><div class="empty-state-title">Connection Error</div></div>`;
    }
  }

  async function publishAnnouncement(e) {
    e.preventDefault();
    const btn = document.getElementById('pubBtn');
    btn.disabled = true;

    const data = {
      title: document.getElementById('annTitle').value.trim(),
      target_role: document.getElementById('annTarget').value,
      body: document.getElementById('annBody').value.trim(),
      is_pinned: document.getElementById('annPin').checked
    };

    try {
      const res = await API.announcements.create(data);
      if (res && res.status === 'success') {
        Toast.success('Success', 'Announcement published successfully.');
        Modal.close('annModal');
        document.getElementById('annForm').reset();
        loadAnnouncements();
      } else {
        Toast.error('Failed', res.message || 'Failed to publish announcement.');
      }
    } catch (err) {
      Toast.error('Error', 'Communication error.');
    } finally {
      btn.disabled = false;
    }
  }

  function deleteAnnouncement(id) {
    confirmAction('Are you sure you want to delete this announcement?', async () => {
      try {
        const res = await API.announcements.delete(id);
        if (res && res.status === 'success') {
          Toast.success('Deleted', 'Announcement deleted successfully.');
          loadAnnouncements();
        } else {
          Toast.error('Failed', 'Failed to delete announcement.');
        }
      } catch (e) {
        Toast.error('Error', 'Connection error.');
      }
    });
  }

  // Extend Format audience helper
  Format.audience = (role) => {
    const map = { all: 'All Users', teacher: 'Teachers Only', student: 'Students & Parents' };
    return map[role] || role;
  };
</script>
</body>
</html>
