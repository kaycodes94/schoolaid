<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Approvals — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .modal-detail-grid {
      display: grid;
      grid-template-columns: 120px 1fr;
      gap: var(--space-6);
    }
    .action-panel {
      background: var(--color-bg-elevated);
      border: 1px solid var(--color-border);
      border-radius: var(--radius-xl);
      padding: var(--space-4);
      margin-top: var(--space-6);
    }
    .textarea-box {
      margin-bottom: var(--space-4);
    }
  </style>
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
      <a href="index" class="nav-item" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>

      <div class="nav-section-label">Students</div>
      <a href="approvals" class="nav-item active" id="nav-approvals">
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
          <div class="page-title">Student Approvals</div>
          <div class="page-breadcrumb">Admissions / <span>Approvals</span></div>
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

      <!-- Tabs and Search Toolbar -->
      <div class="toolbar">
        <div class="tabs" id="statusTabs">
          <button class="tab-btn active" data-status="pending">Pending</button>
          <button class="tab-btn" data-status="approved">Approved</button>
          <button class="tab-btn" data-status="rejected">Rejected</button>
          <button class="tab-btn" data-status="correction_requested">Correction Requested</button>
        </div>
        <div class="toolbar-right">
          <div class="search-bar">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="searchInput" placeholder="Search name or email...">
          </div>
        </div>
      </div>

      <!-- Applications Table Card -->
      <div class="card">
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Applicant</th>
                <th>Class</th>
                <th>Applied Date</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody id="applicationsTableBody">
              <tr>
                <td colspan="5"><div class="empty-state"><div class="spinner"></div></div></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="pagination" id="paginationContainer"></div>
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

<!-- Application Detail Modal -->
<div class="modal-overlay" id="detailModal">
  <div class="modal" style="max-width: 640px;">
    <div class="modal-header">
      <h3 class="modal-title">Application Review</h3>
      <button class="modal-close" onclick="Modal.close('detailModal')">✕</button>
    </div>
    <div class="modal-body">
      <div id="modalDetailContent">
        <!-- Loaded Dynamically -->
      </div>
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

  let currentStatus = 'pending';
  let limit = 10;
  let offset = 0;
  let searchQuery = '';
  let activeApplication = null;

  document.addEventListener('DOMContentLoaded', () => {
    loadApplications();

    // Tabs listener
    document.querySelectorAll('#statusTabs .tab-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        document.querySelectorAll('#statusTabs .tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentStatus = btn.dataset.status;
        offset = 0;
        loadApplications();
      });
    });

    // Search input listener
    document.getElementById('searchInput').addEventListener('input', debounce((e) => {
      searchQuery = e.target.value.trim();
      offset = 0;
      loadApplications();
    }));
  });

  async function loadApplications() {
    const tbody = document.getElementById('applicationsTableBody');
    tableLoadingSkeleton(tbody, 5, 5);

    try {
      const res = await API.approvals.list({
        type: 'student',
        status: currentStatus,
        limit,
        offset,
        search: searchQuery
      });

      if (!res || res.status !== 'success') {
        tbody.innerHTML = `<tr><td colspan="5"><div class="empty-state"><div class="empty-state-title">Error Loading Data</div></div></td></tr>`;
        return;
      }

      const results = res.data;
      const count = results.total;
      const list = results.data || [];

      // Update Sidebar Badge if status is pending
      if (currentStatus === 'pending') {
        const badge = document.getElementById('pendingStudentBadge');
        if (count > 0) {
          badge.textContent = count;
          badge.style.display = '';
        } else {
          badge.style.display = 'none';
        }
      }

      if (list.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5"><div class="empty-state"><div class="empty-state-icon">📂</div><div class="empty-state-title">No Applications Found</div><div class="empty-state-desc">There are no applications matching your criteria.</div></div></td></tr>`;
        document.getElementById('paginationContainer').innerHTML = '';
        return;
      }

      tbody.innerHTML = list.map(app => `
        <tr>
          <td>
            <div class="user-cell">
              ${Format.avatar(app.full_name, app.passport_photo)}
              <div>
                <strong>${app.full_name}</strong>
                <div class="text-xs text-muted">${app.email}</div>
              </div>
            </div>
          </td>
          <td>${app.class_name}</td>
          <td>${Format.date(app.created_at)}</td>
          <td>${Format.badge(app.status)}</td>
          <td class="text-right">
            <button class="btn btn-secondary btn-sm" onclick="viewDetails(${app.id})">Review</button>
          </td>
        </tr>
      `).join('');

      renderPagination(
        document.getElementById('paginationContainer'),
        count,
        limit,
        offset,
        (newOffset) => {
          offset = newOffset;
          loadApplications();
        }
      );

    } catch (e) {
      tbody.innerHTML = `<tr><td colspan="5"><div class="empty-state"><div class="empty-state-title">Connection Error</div></div></td></tr>`;
    }
  }

  async function viewDetails(id) {
    try {
      const res = await API.approvals.get(id, 'student');
      if (!res || res.status !== 'success') {
        Toast.error('Failed to load application details');
        return;
      }

      activeApplication = res.data;
      renderDetailModal(activeApplication);
      Modal.open('detailModal');
    } catch (e) {
      Toast.error('An error occurred while loading details');
    }
  }

  function renderDetailModal(app) {
    const container = document.getElementById('modalDetailContent');
    const photoUrl = app.passport_photo ? `${window.BASE_URL}/${app.passport_photo}` : '';

    let actionsHtml = '';
    if (app.status === 'pending' || app.status === 'correction_requested') {
      actionsHtml = `
        <div class="action-panel">
          <h4 class="mb-4">Process Application</h4>
          
          <div class="textarea-box">
            <label class="form-label" for="actionComments">Reason / Comments</label>
            <textarea class="form-control" id="actionComments" placeholder="Enter comments for correction or rejection reason..."></textarea>
          </div>

          <div class="flex gap-3 justify-end">
            <button class="btn btn-danger" onclick="processAction('reject')">Reject</button>
            <button class="btn btn-warning" onclick="processAction('correct')">Request Correction</button>
            <button class="btn btn-success" onclick="processAction('approve')">Approve Enrollment</button>
          </div>
        </div>
      `;
    } else {
      actionsHtml = `
        <div class="action-panel" style="border-left: 4px solid var(--color-success);">
          <div class="text-sm text-secondary">Processed by: <strong>${app.approver_name || 'System'}</strong></div>
          <div class="text-xs text-muted" style="margin-top:4px;">Processed at: ${Format.datetime(app.approved_at)}</div>
          ${app.rejection_reason ? `<div class="text-sm text-danger mt-4"><strong>Rejection Reason:</strong> ${app.rejection_reason}</div>` : ''}
          ${app.correction_comments ? `<div class="text-sm text-warning mt-4"><strong>Correction Comments:</strong> ${app.correction_comments}</div>` : ''}
        </div>
      `;
    }

    container.innerHTML = `
      <div class="modal-detail-grid">
        <div class="passport-preview">
          ${photoUrl ? `<img src="${photoUrl}" alt="Passport Photo">` : '📷'}
        </div>
        <div class="profile-detail">
          <div class="detail-item">
            <label>Full Name</label>
            <span>${app.full_name}</span>
          </div>
          <div class="detail-item">
            <label>Email Address</label>
            <span>${app.email}</span>
          </div>
          <div class="detail-item">
            <label>Phone Number</label>
            <span>${app.phone}</span>
          </div>
          <div class="detail-item">
            <label>Date of Birth</label>
            <span>${Format.date(app.date_of_birth)}</span>
          </div>
          <div class="detail-item">
            <label>Class Applied</label>
            <span>${app.class_name}</span>
          </div>
          <div class="detail-item">
            <label>Department</label>
            <span>${app.department_name || '—'}</span>
          </div>
          <div class="detail-item">
            <label>Application Date</label>
            <span>${Format.datetime(app.created_at)}</span>
          </div>
          <div class="detail-item">
            <label>Application Status</label>
            <span>${Format.badge(app.status)}</span>
          </div>
        </div>
      </div>
      
      ${actionsHtml}
    `;
  }

  async function processAction(action) {
    if (!activeApplication) return;
    const commentsEl = document.getElementById('actionComments');
    const comments = commentsEl ? commentsEl.value.trim() : '';

    if ((action === 'reject' || action === 'correct') && !comments) {
      Toast.warning('Comments Required', `Please enter a reason or comments to proceed with ${action}.`);
      return;
    }

    let actionWord = 'approve';
    if (action === 'reject') actionWord = 'reject';
    if (action === 'correct') actionWord = 'request correction for';

    confirmAction(`Are you sure you want to ${actionWord} this application?`, async () => {
      Modal.close('detailModal');
      try {
        let res;
        if (action === 'approve') {
          res = await API.approvals.approve({ id: activeApplication.id, type: 'student', comments });
        } else if (action === 'reject') {
          res = await API.approvals.reject({ id: activeApplication.id, type: 'student', reason: comments });
        } else if (action === 'correct') {
          res = await API.approvals.requestCorrection({ id: activeApplication.id, type: 'student', comments });
        }

        if (res && res.status === 'success') {
          Toast.success('Success', `Application successfully processed.`);
          loadApplications();
          loadNotifCount();
        } else {
          Toast.error('Action Failed', res.message || 'Failed to process application.');
        }
      } catch (e) {
        Toast.error('System Error', 'An error occurred during processing.');
      }
    });
  }
</script>
</body>
</html>
