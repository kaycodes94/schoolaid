<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management — School Aid Management System</title>
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
      <a href="users" class="nav-item active" id="nav-users">
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
          <div class="page-title">User Management</div>
          <div class="page-breadcrumb">Administration / <span>Users</span></div>
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
          <h2>Administrative & Teaching Staff</h2>
          <p class="text-secondary">Manage administrative accounts, form teachers, and assign system permissions.</p>
        </div>
        <div class="page-header-actions">
          <button class="btn btn-primary" onclick="Modal.open('userModal')">+ Add Staff Member</button>
        </div>
      </div>

      <!-- Staff Table Card -->
      <div class="card">
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Staff Name</th>
                <th>Staff ID</th>
                <th>Portal Role</th>
                <th>Hire Date</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody id="staffTableBody">
              <!-- Dynamically Populated -->
            </tbody>
          </table>
        </div>
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<!-- Add Staff Modal -->
<div class="modal-overlay" id="userModal">
  <div class="modal" style="max-width:480px;">
    <div class="modal-header">
      <h3 class="modal-title">Add Staff Member</h3>
      <button class="modal-close" onclick="Modal.close('userModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="staffForm" onsubmit="addStaff(event)">
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="staffFirst">First Name <span class="required">*</span></label>
            <input type="text" id="staffFirst" class="form-control" placeholder="e.g. John" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="staffLast">Last Name <span class="required">*</span></label>
            <input type="text" id="staffLast" class="form-control" placeholder="e.g. Doe" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="staffEmail">Email Address <span class="required">*</span></label>
          <input type="email" id="staffEmail" class="form-control" placeholder="john.doe@paa.edu.ng" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="staffRole">System Role <span class="required">*</span></label>
          <select id="staffRole" class="form-control" required>
            <option value="teacher">Teacher</option>
            <option value="unit_head">Unit Head</option>
            <option value="finance">Finance Officer</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="staffPhone">Phone Number</label>
          <input type="tel" id="staffPhone" class="form-control" placeholder="+234...">
        </div>

        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('userModal')">Cancel</button>
          <button type="submit" class="btn btn-primary" id="saveStaffBtn">Create Account</button>
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

  let currentStaff = [];

  document.addEventListener('DOMContentLoaded', loadStaffList);

  async function loadStaffList() {
    const tbody = document.getElementById('staffTableBody');
    tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="spinner"></div></div></td></tr>`;

    try {
      const res = await API.get('api/users.php?action=list');
      // If endpoint is missing, read from Mock database list
      const staffList = res && res.status === 'success' ? res.data : JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
      currentStaff = staffList;

      if (currentStaff.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="empty-state-title">No Staff Members Registered</div></div></td></tr>`;
        return;
      }

      tbody.innerHTML = currentStaff.map(s => `
        <tr>
          <td>
            <div class="user-cell">
              ${Format.avatar(s.first_name + ' ' + s.last_name, s.passport_photo)}
              <div>
                <strong>${s.first_name} ${s.last_name}</strong>
                <div class="text-xs text-muted">${s.email}</div>
              </div>
            </div>
          </td>
          <td><code>${s.staff_id}</code></td>
          <td><span class="badge badge-primary">${formatRole(s.role)}</span></td>
          <td>${s.hire_date || '—'}</td>
          <td>${Format.badge(s.status || 'active')}</td>
          <td class="text-right">
            <button class="btn btn-secondary btn-sm" onclick="toggleStatus(${s.id})">Toggle Status</button>
          </td>
        </tr>
      `).join('');
    } catch (e) {
      tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="empty-state-title">Error Loading Staff</div></div></td></tr>`;
    }
  }

  function toggleStatus(id) {
    const matched = currentStaff.find(s => s.id === id);
    if (!matched) return;

    confirmAction(`Change status of ${matched.first_name} to ${matched.status === 'active' ? 'Inactive' : 'Active'}?`, () => {
      const mockList = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
      const idx = mockList.findIndex(s => s.id === id);
      if (idx !== -1) {
        mockList[idx].status = mockList[idx].status === 'active' ? 'inactive' : 'active';
        localStorage.setItem('sams_mock_staff', JSON.stringify(mockList));
        Toast.success('Success', 'Staff status updated.');
        loadStaffList();
      }
    });
  }

  function addStaff(e) {
    e.preventDefault();
    const btn = document.getElementById('saveStaffBtn');
    btn.disabled = true;

    const first = document.getElementById('staffFirst').value.trim();
    const last = document.getElementById('staffLast').value.trim();
    const email = document.getElementById('staffEmail').value.trim();
    const role = document.getElementById('staffRole').value;
    const phone = document.getElementById('staffPhone').value.trim();

    const mockList = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
    const idNum = `PAA-ST-00${mockList.length + 1}`;

    const newStaff = {
      id: mockList.length + 10,
      staff_id: idNum,
      first_name: first,
      last_name: last,
      email,
      username: `${first.toLowerCase()}.${last.toLowerCase()}`,
      phone,
      role,
      status: 'active',
      hire_date: new Date().toISOString().split('T')[0]
    };

    mockList.push(newStaff);
    localStorage.setItem('sams_mock_staff', JSON.stringify(mockList));

    Toast.success('Success', `Created account for ${first} ${last} (${idNum})`);
    Modal.close('userModal');
    document.getElementById('staffForm').reset();
    btn.disabled = false;
    loadStaffList();
  }
</script>
</body>
</html>
