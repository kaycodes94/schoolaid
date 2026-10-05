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
  <script src="../../assets/js/auth.js"></script>
  <script>
    Auth.requireAuth();
    Auth.requireRole('principal');
  </script>
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

      <div class="nav-section-label">Communication &amp; Finance</div>
      <a href="../finance/index.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
        Finance Portal
      </a>
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
      <a href="#" class="nav-item" style="color:var(--red);" data-logout>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sign Out
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--gradient-accent);">PA</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>Principal</div>
          <div class="sidebar-user-role">Super Admin</div>
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
          <div class="page-title">User Account Creation &amp; Management</div>
          <div class="page-breadcrumb">Administration / <span>Users</span></div>
        </div>
      </div>
      <div class="topbar-right">
        <span class="session-badge session-info">Principal Super Admin Access</span>
        <div class="dropdown">
          <div class="icon-btn" data-dropdown="userMenu">
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--gradient-accent);font-size:0.65rem;width:28px;height:28px;">PA</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>Principal</div>
            <div class="dropdown-divider"></div>
            <a href="settings" class="dropdown-item">Settings</a>
            <a href="#" class="dropdown-item danger" data-logout>Sign Out</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="page-content">

      <!-- Page Header -->
      <div class="page-header">
        <div class="page-header-text">
          <h2>User Accounts &amp; Access Control</h2>
          <p class="text-secondary">Only the Principal can create and manage Staff, Arabic Staff, Finance Staff, and Student accounts.</p>
        </div>
        <div class="page-header-actions">
          <button class="btn btn-primary" onclick="Modal.open('userModal')">+ Add User Account</button>
        </div>
      </div>

      <!-- Filter Controls -->
      <div class="card mb-6" style="padding:var(--space-4);">
        <div class="flex gap-4 items-center flex-wrap">
          <div style="flex:1;min-width:200px;">
            <input type="text" id="userSearchInput" class="form-control" placeholder="Search by name, ID, or email..." oninput="filterUsers()">
          </div>
          <div style="width:180px;">
            <select id="roleFilterSelect" class="form-control" onchange="filterUsers()">
              <option value="">All Roles</option>
              <option value="teacher">Staff (Teacher)</option>
              <option value="unit_head">Arabic Staff</option>
              <option value="finance">Finance Staff</option>
              <option value="student">Student</option>
              <option value="principal">Principal</option>
            </select>
          </div>
          <div style="width:160px;">
            <select id="statusFilterSelect" class="form-control" onchange="filterUsers()">
              <option value="">All Statuses</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Users Table Card -->
      <div class="card">
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>User Details</th>
                <th>Account ID</th>
                <th>Assigned Role</th>
                <th>Class / Department</th>
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

<!-- Create User Modal -->
<div class="modal-overlay" id="userModal">
  <div class="modal" style="max-width:560px;">
    <div class="modal-header">
      <h3 class="modal-title">Create User Account</h3>
      <button class="modal-close" onclick="Modal.close('userModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="staffForm" onsubmit="createUser(event)">

        <div class="form-group">
          <label class="form-label" for="userRole">Account Category / System Role <span class="required">*</span></label>
          <select id="userRole" class="form-control" required onchange="onRoleSelectChange(this.value)">
            <option value="teacher">Staff (Teacher)</option>
            <option value="arabic">Arabic Staff (Arabic/Islamic Unit)</option>
            <option value="finance">Finance Staff (Fees &amp; Financials)</option>
            <option value="student">Student Account</option>
          </select>
        </div>

        <!-- Shared Name Row -->
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="userFirst" id="lblFirst">First Name <span class="required">*</span></label>
            <input type="text" id="userFirst" class="form-control" placeholder="e.g. Fatima" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="userLast" id="lblLast">Last Name <span class="required">*</span></label>
            <input type="text" id="userLast" class="form-control" placeholder="e.g. Umar" required>
          </div>
        </div>

        <!-- Dynamic Fields for Staff -->
        <div id="staffFields">
          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="customStaffId">Staff ID <span class="text-xs text-muted">(Auto-generated if empty)</span></label>
              <input type="text" id="customStaffId" class="form-control" placeholder="e.g. PAA-ST-008">
            </div>
            <div class="form-group">
              <label class="form-label" for="staffDept">Department</label>
              <select id="staffDept" class="form-control">
                <option value="Science & ICT">Science &amp; ICT Department</option>
                <option value="Mathematics">Mathematics Department</option>
                <option value="Languages & Humanities">Languages &amp; Humanities</option>
                <option value="Arabic & Islamic Studies">Arabic &amp; Islamic Studies Unit</option>
                <option value="Finance & Accounts">Finance &amp; Accounts Unit</option>
                <option value="Administration">General Administration</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="staffSubjects">Assigned Classes / Subjects</label>
            <input type="text" id="staffSubjects" class="form-control" placeholder="e.g. Mathematics (JSS 1 - JSS 3), Computer Studies">
          </div>
        </div>

        <!-- Dynamic Fields for Student -->
        <div id="studentFields" style="display:none;">
          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="customStudentId">Student ID / Admission No. <span class="text-xs text-muted">(Auto-generated if empty)</span></label>
              <input type="text" id="customStudentId" class="form-control" placeholder="e.g. PAA-2026-0012">
            </div>
            <div class="form-group">
              <label class="form-label" for="studentClass">Class <span class="required">*</span></label>
              <select id="studentClass" class="form-control">
                <option value="Nursery 1">Nursery 1</option>
                <option value="Nursery 2">Nursery 2</option>
                <option value="Primary 1">Primary 1</option>
                <option value="Primary 2">Primary 2</option>
                <option value="Primary 3">Primary 3</option>
                <option value="JSS 1A">JSS 1A</option>
                <option value="JSS 1B">JSS 1B</option>
                <option value="JSS 2 STEM">JSS 2 STEM</option>
                <option value="JSS 3">JSS 3</option>
                <option value="SS 1 STEM">SS 1 STEM</option>
                <option value="SS 2 STEM">SS 2 STEM</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="parentName">Parent / Guardian Name</label>
              <input type="text" id="parentName" class="form-control" placeholder="e.g. Alhaji Umar Sani">
            </div>
            <div class="form-group">
              <label class="form-label" for="parentPhone">Parent / Guardian Phone</label>
              <input type="tel" id="parentPhone" class="form-control" placeholder="+2348030000000">
            </div>
          </div>
        </div>

        <!-- Account Status & Password Fields -->
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="userEmail">Email Address</label>
            <input type="email" id="userEmail" class="form-control" placeholder="user@paa.edu.ng">
          </div>
          <div class="form-group">
            <label class="form-label" for="userPhone">Phone Number</label>
            <input type="tel" id="userPhone" class="form-control" placeholder="+234...">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="userStatus">Initial Account Status <span class="required">*</span></label>
            <select id="userStatus" class="form-control" required>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
              <option value="suspended">Suspended</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="userPassword">Temporary Password <span class="text-xs text-muted">(Auto-generated if empty)</span></label>
            <input type="text" id="userPassword" class="form-control" placeholder="Leave empty for auto-generated password">
          </div>
        </div>

        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('userModal')">Cancel</button>
          <button type="submit" class="btn btn-primary" id="saveUserBtn">Create Account &amp; Generate Slip</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Reset Password Modal -->
<div class="modal-overlay" id="resetPassModal">
  <div class="modal" style="max-width:400px;">
    <div class="modal-header">
      <h3 class="modal-title">Reset User Password</h3>
      <button class="modal-close" onclick="Modal.close('resetPassModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="resetPassForm" onsubmit="submitPasswordReset(event)">
        <input type="hidden" id="resetUserId">
        <input type="hidden" id="resetUserType">
        <p class="mb-4 text-sm text-secondary" id="resetUserPrompt">Enter a new temporary password or leave blank to auto-generate:</p>
        <div class="form-group">
          <label class="form-label" for="newPassword">New Temporary Password</label>
          <input type="text" id="newPassword" class="form-control" placeholder="Leave empty for auto-generated temp password">
        </div>
        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('resetPassModal')">Cancel</button>
          <button type="submit" class="btn btn-primary">Generate New Credentials</button>
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

  let allUsers = [];

  document.addEventListener('DOMContentLoaded', loadUsersList);

  function onRoleSelectChange(val) {
    const staffFields = document.getElementById('staffFields');
    const studentFields = document.getElementById('studentFields');
    const lblFirst = document.getElementById('lblFirst');
    const lblLast = document.getElementById('lblLast');

    if (val === 'student') {
      staffFields.style.display = 'none';
      studentFields.style.display = 'block';
      lblFirst.innerHTML = 'Student First Name <span class="required">*</span>';
      lblLast.innerHTML = 'Student Last Name <span class="required">*</span>';
    } else {
      staffFields.style.display = 'block';
      studentFields.style.display = 'none';
      lblFirst.innerHTML = 'Staff First Name <span class="required">*</span>';
      lblLast.innerHTML = 'Staff Last Name <span class="required">*</span>';

      if (val === 'arabic') {
        document.getElementById('staffDept').value = 'Arabic & Islamic Studies';
      } else if (val === 'finance') {
        document.getElementById('staffDept').value = 'Finance & Accounts';
      }
    }
  }

  async function loadUsersList() {
    const tbody = document.getElementById('staffTableBody');
    tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="spinner"></div></div></td></tr>`;

    try {
      const res = await API.get('api/users.php?action=list');
      if (res && res.status === 'success' && Array.isArray(res.data)) {
        allUsers = res.data;
      } else {
        allUsers = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
      }
      renderUsers(allUsers);
    } catch (e) {
      allUsers = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
      renderUsers(allUsers);
    }
  }

  function filterUsers() {
    const q = document.getElementById('userSearchInput').value.toLowerCase().trim();
    const r = document.getElementById('roleFilterSelect').value;
    const s = document.getElementById('statusFilterSelect').value;

    const filtered = allUsers.filter(u => {
      const fullName = `${u.first_name || ''} ${u.last_name || ''}`.toLowerCase();
      const email = (u.email || '').toLowerCase();
      const idStr = (u.staff_id || u.student_id || u.user_id || '').toLowerCase();
      const roleStr = (u.role || '').toLowerCase();

      const matchesSearch = !q || fullName.includes(q) || email.includes(q) || idStr.includes(q);
      const matchesRole = !r || roleStr === r || (r === 'unit_head' && (roleStr === 'unit_head' || roleStr === 'arabic'));
      const matchesStatus = !s || (u.status || 'active') === s;

      return matchesSearch && matchesRole && matchesStatus;
    });

    renderUsers(filtered);
  }

  function renderUsers(list) {
    const tbody = document.getElementById('staffTableBody');
    if (!list || list.length === 0) {
      tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="empty-state-title">No User Accounts Found</div><div class="empty-state-desc">Click "+ Add User Account" to add staff or students.</div></div></td></tr>`;
      return;
    }

    tbody.innerHTML = list.map(u => {
      const name = `${u.first_name || ''} ${u.last_name || ''}`.trim() || 'User Account';
      const idNum = u.staff_id || u.student_id || u.user_id || `ID-${u.id}`;
      const role = u.role || 'teacher';
      const userType = u.user_type || (role === 'student' ? 'student' : 'staff');
      const status = u.status || 'active';

      let roleBadgeClass = 'badge-primary';
      if (role === 'principal' || role === 'admin') roleBadgeClass = 'badge-gold';
      if (role === 'unit_head' || role === 'arabic') roleBadgeClass = 'badge-warning';
      if (role === 'finance') roleBadgeClass = 'badge-info';
      if (role === 'student') roleBadgeClass = 'badge-secondary';

      let statusBadgeClass = 'badge-success';
      if (status === 'inactive') statusBadgeClass = 'badge-warning';
      if (status === 'suspended') statusBadgeClass = 'badge-danger';

      return `
        <tr>
          <td>
            <div class="user-cell">
              ${Format.avatar(name, u.passport_photo)}
              <div>
                <strong>${name}</strong>
                <div class="text-xs text-muted">${u.email || 'No email registered'}</div>
              </div>
            </div>
          </td>
          <td><code>${idNum}</code></td>
          <td><span class="badge ${roleBadgeClass}">${formatRole(role)}</span></td>
          <td>${u.subject || u.qualification || u.current_class || '—'}</td>
          <td>
            <select class="form-control form-control-sm" style="width:110px; padding:2px 6px; font-size:0.75rem;" onchange="changeUserStatus(${u.id}, '${userType}', '${name}', this.value)" ${role === 'principal' ? 'disabled' : ''}>
              <option value="active" ${status === 'active' ? 'selected' : ''}>Active</option>
              <option value="inactive" ${status === 'inactive' ? 'selected' : ''}>Inactive</option>
              <option value="suspended" ${status === 'suspended' ? 'selected' : ''}>Suspended</option>
            </select>
          </td>
          <td class="text-right">
            <div class="flex gap-2 justify-end">
              <button class="btn btn-secondary btn-sm" onclick="openResetPasswordModal(${u.id}, '${userType}', '${name}')">Reset Password</button>
            </div>
          </td>
        </tr>
      `;
    }).join('');
  }

  async function createUser(e) {
    e.preventDefault();
    const btn = document.getElementById('saveUserBtn');
    btn.disabled = true;

    const role = document.getElementById('userRole').value;
    const first = document.getElementById('userFirst').value.trim();
    const last = document.getElementById('userLast').value.trim();
    const email = document.getElementById('userEmail').value.trim();
    const phone = document.getElementById('userPhone').value.trim();
    const status = document.getElementById('userStatus').value;
    const password = document.getElementById('userPassword').value.trim();

    const payload = {
      role,
      first_name: first,
      last_name: last,
      email,
      phone,
      status,
      password
    };

    if (role === 'student') {
      payload.student_id = document.getElementById('customStudentId').value.trim();
      payload.class_name = document.getElementById('studentClass').value;
      payload.parent_name = document.getElementById('parentName').value.trim();
      payload.parent_phone = document.getElementById('parentPhone').value.trim();
    } else {
      payload.staff_id = document.getElementById('customStaffId').value.trim();
      payload.department = document.getElementById('staffDept').value;
      payload.subject = document.getElementById('staffSubjects').value.trim();
    }

    try {
      const res = await API.post('api/users.php?action=create', payload);

      if (res && res.status === 'success') {
        Toast.success('Account Created', `Created ${formatRole(role)} account for ${first} ${last}`);
        Modal.close('userModal');
        document.getElementById('staffForm').reset();
        loadUsersList();

        // Show Credentials Slip Modal to Principal with print, PDF, email options
        if (window.showCredentialsModal) {
          showCredentialsModal(res.data);
        }
      } else {
        Toast.error('Creation Failed', res.message || 'Could not create account.');
      }
    } catch (err) {
      Toast.error('Error', err.message || 'Server error creating user.');
    } finally {
      btn.disabled = false;
    }
  }

  function openResetPasswordModal(id, userType, name) {
    document.getElementById('resetUserId').value = id;
    document.getElementById('resetUserType').value = userType;
    document.getElementById('resetUserPrompt').textContent = `Generate new temporary password for ${name}:`;
    document.getElementById('newPassword').value = '';
    Modal.open('resetPassModal');
  }

  async function submitPasswordReset(e) {
    e.preventDefault();
    const id = document.getElementById('resetUserId').value;
    const userType = document.getElementById('resetUserType').value;
    const password = document.getElementById('newPassword').value.trim();

    try {
      const res = await API.post('api/users.php?action=reset_password', {
        id,
        user_type: userType,
        password
      });

      if (res && res.status === 'success') {
        Toast.success('Password Reset', 'New temporary password generated.');
        Modal.close('resetPassModal');
        loadUsersList();

        // Show Credential Slip modal to Principal
        if (window.showCredentialsModal) {
          showCredentialsModal(res.data);
        }
      } else {
        Toast.error('Reset Failed', res.message || 'Failed to update password.');
      }
    } catch (err) {
      Toast.error('Error', err.message || 'Server error resetting password.');
    }
  }

  function changeUserStatus(id, userType, name, newStatus) {
    confirmAction(`Are you sure you want to set account status for ${name} to '${newStatus.toUpperCase()}'?`, async () => {
      try {
        const res = await API.post('api/users.php?action=toggle_status', { id, user_type: userType, status: newStatus });
        if (res && res.status === 'success') {
          Toast.success('Status Updated', `User account status is now '${res.data.status}'`);
          loadUsersList();
        } else {
          Toast.error('Update Failed', res.message || 'Could not update status');
          loadUsersList();
        }
      } catch (err) {
        Toast.error('Error', err.message || 'Failed to update status.');
        loadUsersList();
      }
    });
  }
</script>
</body>
</html>
