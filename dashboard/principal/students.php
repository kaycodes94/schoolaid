<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Management — School Aid Management System</title>
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
      <a href="students" class="nav-item active" id="nav-students">
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
          <div class="page-title">Student Management</div>
          <div class="page-breadcrumb">Students / <span>List</span></div>
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

      <!-- Page Header Actions -->
      <div class="page-header">
        <div class="page-header-text">
          <h2>Student Directory</h2>
          <p class="text-secondary">Search, view and manage all student enrollments.</p>
        </div>
        <div class="page-header-actions">
          <button class="btn btn-primary" onclick="Modal.open('addStudentModal')">+ Add Student Record</button>
        </div>
      </div>

      <!-- Filters Toolbar -->
      <div class="toolbar">
        <div class="search-bar" style="max-width: 320px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" id="searchInput" placeholder="Search student name or admission ID...">
        </div>
        <div class="flex gap-3">
          <select id="unitFilter" class="form-control" style="width: 180px; padding: 0.5rem 2.5rem 0.5rem 1rem;">
            <option value="">All Units</option>
            <option value="1">Nursery School</option>
            <option value="2">Primary School</option>
            <option value="3">Secondary School</option>
            <option value="4">Arabic Unit</option>
          </select>
          <select id="statusFilter" class="form-control" style="width: 150px; padding: 0.5rem 2.5rem 0.5rem 1rem;">
            <option value="active">Active</option>
            <option value="graduated">Graduated</option>
            <option value="withdrawn">Withdrawn</option>
          </select>
        </div>
      </div>

      <!-- Students Table Card -->
      <div class="card">
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Student</th>
                <th>Admission No</th>
                <th>Student ID</th>
                <th>Class</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody id="studentsTableBody">
              <tr>
                <td colspan="6"><div class="empty-state"><div class="spinner"></div></div></td>
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

<!-- View / Edit Student Modal -->
<div class="modal-overlay" id="editStudentModal">
  <div class="modal" style="max-width: 640px;">
    <div class="modal-header">
      <h3 class="modal-title">Student Profile Detail</h3>
      <button class="modal-close" onclick="Modal.close('editStudentModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="editStudentForm" onsubmit="saveStudentChanges(event)">
        <div class="flex items-center gap-4 mb-6" style="border-bottom: 1px solid var(--color-border); padding-bottom: var(--space-4);">
          <div class="passport-preview" id="profileModalPhoto">📷</div>
          <div>
            <h3 id="profileModalName" style="margin-bottom: var(--space-1);">Loading...</h3>
            <span class="badge badge-primary" id="profileModalAdmNo">—</span>
          </div>
        </div>

        <div class="grid gap-4 grid-cols-2 mb-6">
          <div class="form-group">
            <label class="form-label" for="editClass">Current Class</label>
            <input type="text" id="editClass" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label" for="editStatus">Status</label>
            <select id="editStatus" class="form-control">
              <option value="active">Active</option>
              <option value="graduated">Graduated</option>
              <option value="withdrawn">Withdrawn</option>
            </select>
          </div>

          <!-- Portal Login details -->
          <div class="form-group">
            <label class="form-label" for="editStudentIdNum">Student ID</label>
            <input type="text" id="editStudentIdNum" class="form-control" readonly style="opacity:0.85;background-color:rgba(255,255,255,0.04)">
          </div>
          <div class="form-group">
            <label class="form-label" for="editUsername">Portal Username</label>
            <input type="text" id="editUsername" class="form-control" readonly style="opacity:0.85;background-color:rgba(255,255,255,0.04)">
          </div>

          <!-- Reset password -->
          <div class="form-group" style="grid-column: span 2;">
            <label class="form-label" for="editPassword">Reset Password (Leave blank to keep current)</label>
            <input type="text" id="editPassword" class="form-control" placeholder="Enter new password (min. 8 characters)">
          </div>

          <div class="form-group">
            <label class="form-label" for="editParentName">Parent Name</label>
            <input type="text" id="editParentName" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label" for="editParentPhone">Parent Phone</label>
            <input type="tel" id="editParentPhone" class="form-control">
          </div>
          <div class="form-group" style="grid-column: span 2;">
            <label class="form-label" for="editParentEmail">Parent Email</label>
            <input type="email" id="editParentEmail" class="form-control">
          </div>
          <div class="form-group" style="grid-column: span 2;">
            <label class="form-label" for="editAddress">Home Address</label>
            <textarea id="editAddress" class="form-control" rows="3"></textarea>
          </div>
        </div>

        <div class="flex gap-3 justify-end">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('editStudentModal')">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add Student Modal (Manual) -->
<div class="modal-overlay" id="addStudentModal">
  <div class="modal" style="max-width: 680px;">
    <div class="modal-header">
      <h3 class="modal-title">New Student Record</h3>
      <button class="modal-close" onclick="Modal.close('addStudentModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="addStudentForm" onsubmit="addNewStudent(event)">
        <div class="grid gap-4 grid-cols-2 mb-6">
          <div class="form-group">
            <label class="form-label" for="addFirst">First Name <span class="required">*</span></label>
            <input type="text" id="addFirst" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="addLast">Last Name <span class="required">*</span></label>
            <input type="text" id="addLast" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="addDob">Date of Birth</label>
            <input type="date" id="addDob" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label" for="addGender">Gender</label>
            <select id="addGender" class="form-control">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="addUnit">School Unit <span class="required">*</span></label>
            <select id="addUnit" class="form-control" required>
              <option value="1">Nursery School</option>
              <option value="2">Primary School</option>
              <option value="3" selected>Secondary School</option>
              <option value="4">Arabic Unit</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="addClass">Class <span class="required">*</span></label>
            <input type="text" id="addClass" class="form-control" placeholder="e.g. SSS 2" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="addState">State of Origin</label>
            <input type="text" id="addState" class="form-control" placeholder="e.g. Plateau">
          </div>
          <div class="form-group">
            <label class="form-label" for="addReligion">Religion</label>
            <select id="addReligion" class="form-control">
              <option value="Christianity">Christianity</option>
              <option value="Islam">Islam</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="addParent">Parent / Guardian Name</label>
            <input type="text" id="addParent" class="form-control" placeholder="e.g. Samuel Longs">
          </div>
          <div class="form-group">
            <label class="form-label" for="addParentPhone">Parent Phone</label>
            <input type="tel" id="addParentPhone" class="form-control" placeholder="+234 800...">
          </div>
          <div class="form-group" style="grid-column: span 2;">
            <label class="form-label" for="addParentEmail">Parent Email</label>
            <input type="email" id="addParentEmail" class="form-control" placeholder="parent@email.com">
          </div>
          <div class="form-group" style="grid-column: span 2;">
            <label class="form-label" for="addHomeAddress">Home Address</label>
            <textarea id="addHomeAddress" class="form-control" rows="2" placeholder="Street, Area, Jos"></textarea>
          </div>
        </div>

        <div class="flex gap-3 justify-end">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('addStudentModal')">Cancel</button>
          <button type="submit" class="btn btn-primary" id="saveStudentBtn">Create Student Record</button>
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

  let currentUnit = '';
  let currentStatus = 'active';
  let limit = 10;
  let offset = 0;
  let searchQuery = '';
  let selectedStudentId = null;

  document.addEventListener('DOMContentLoaded', () => {
    loadStudents();

    // Filters listener
    document.getElementById('unitFilter').addEventListener('change', (e) => {
      currentUnit = e.target.value;
      offset = 0;
      loadStudents();
    });

    document.getElementById('statusFilter').addEventListener('change', (e) => {
      currentStatus = e.target.value;
      offset = 0;
      loadStudents();
    });

    // Search input
    document.getElementById('searchInput').addEventListener('input', debounce((e) => {
      searchQuery = e.target.value.trim();
      offset = 0;
      loadStudents();
    }));
  });

  async function loadStudents() {
    const tbody = document.getElementById('studentsTableBody');
    tableLoadingSkeleton(tbody, 6, 5);

    try {
      const res = await API.students.list({
        unit: currentUnit,
        status: currentStatus,
        limit,
        offset,
        search: searchQuery
      });

      if (!res || res.status !== 'success') {
        tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="empty-state-title">Error Loading Students</div></div></td></tr>`;
        return;
      }

      const count = res.data.total;
      const list = res.data.students || [];

      if (list.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="empty-state-icon">👥</div><div class="empty-state-title">No Students Found</div></div></td></tr>`;
        document.getElementById('paginationContainer').innerHTML = '';
        return;
      }

      tbody.innerHTML = list.map(student => `
        <tr>
          <td>
            <div class="user-cell">
              ${Format.avatar(student.first_name + ' ' + student.last_name, student.passport_photo)}
              <div>
                <strong>${student.first_name} ${student.last_name}</strong>
                <div class="text-xs text-muted">${student.gender || '—'} · DOB: ${Format.date(student.date_of_birth)}</div>
              </div>
            </div>
          </td>
          <td><code>${student.admission_no}</code></td>
          <td>${student.student_id_number || '—'}</td>
          <td>${student.current_class || '—'}</td>
          <td>${Format.badge(student.status)}</td>
          <td class="text-right">
            <button class="btn btn-secondary btn-sm" onclick="editStudent('${student.admission_no}')">Edit</button>
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
          loadStudents();
        }
      );

    } catch (e) {
      tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="empty-state-title">Connection Error</div></div></td></tr>`;
    }
  }

  async function editStudent(admNo) {
    try {
      const res = await API.students.get(admNo);
      if (!res || res.status !== 'success') {
        Toast.error('Error', 'Failed to retrieve student profile');
        return;
      }

      const student = res.data.student;
      selectedStudentId = student.id;

      // Populate edit form
      document.getElementById('profileModalName').textContent = `${student.first_name} ${student.last_name}`;
      document.getElementById('profileModalAdmNo').textContent = student.admission_no;
      document.getElementById('editClass').value = student.current_class || '';
      document.getElementById('editStatus').value = student.status || 'active';
      document.getElementById('editStudentIdNum').value = student.student_id_number || '—';
      document.getElementById('editUsername').value = student.username || '—';
      document.getElementById('editPassword').value = '';
      document.getElementById('editParentName').value = student.parent_name || '';
      document.getElementById('editParentPhone').value = student.parent_phone || '';
      document.getElementById('editParentEmail').value = student.parent_email || '';
      document.getElementById('editAddress').value = student.home_address || '';

      const photoDiv = document.getElementById('profileModalPhoto');
      if (student.passport_photo) {
        photoDiv.innerHTML = `<img src="${window.BASE_URL}/${student.passport_photo}" alt="Passport Photo">`;
      } else {
        photoDiv.innerHTML = '📷';
      }

      Modal.open('editStudentModal');
    } catch (e) {
      Toast.error('Error', 'An error occurred loading profile details');
    }
  }

  async function saveStudentChanges(e) {
    e.preventDefault();
    if (!selectedStudentId) return;

    const btn = e.target.querySelector('button[type="submit"]');
    btn.disabled = true;

    try {
      const data = {
        current_class: document.getElementById('editClass').value.trim(),
        status: document.getElementById('editStatus').value,
        parent_name: document.getElementById('editParentName').value.trim(),
        parent_phone: document.getElementById('editParentPhone').value.trim(),
        parent_email: document.getElementById('editParentEmail').value.trim(),
        home_address: document.getElementById('editAddress').value.trim(),
      };

      const newPass = document.getElementById('editPassword').value.trim();
      if (newPass) {
        if (newPass.length < 8) {
          Toast.error('Validation Error', 'Password must be at least 8 characters.');
          btn.disabled = false;
          return;
        }
        data.password = newPass;
      }

      const res = await API.students.update(selectedStudentId, data);
      if (res && res.status === 'success') {
        Toast.success('Success', 'Student profile updated successfully.');
        Modal.close('editStudentModal');
        loadStudents();
      } else {
        Toast.error('Failed', res.message || 'Failed to update record.');
      }
    } catch (err) {
      Toast.error('Error', 'Failed to communicate with server.');
    } finally {
      btn.disabled = false;
    }
  }

  async function addNewStudent(e) {
    e.preventDefault();
    const btn = document.getElementById('saveStudentBtn');
    btn.disabled = true;

    try {
      const data = {
        first_name: document.getElementById('addFirst').value.trim(),
        last_name: document.getElementById('addLast').value.trim(),
        date_of_birth: document.getElementById('addDob').value,
        gender: document.getElementById('addGender').value,
        unit_id: document.getElementById('addUnit').value,
        current_class: document.getElementById('addClass').value.trim(),
        state_of_origin: document.getElementById('addState').value.trim(),
        religion: document.getElementById('addReligion').value,
        parent_name: document.getElementById('addParent').value.trim(),
        parent_phone: document.getElementById('addParentPhone').value.trim(),
        parent_email: document.getElementById('addParentEmail').value.trim(),
        home_address: document.getElementById('addHomeAddress').value.trim(),
      };

      // Call students create API
      const res = await API.post('api/students.php', data);
      if (res && res.status === 'success') {
        Toast.success('Success', `Student record created with Admission No: ${res.data.admission_no}`);
        Modal.close('addStudentModal');
        document.getElementById('addStudentForm').reset();
        loadStudents();
      } else {
        Toast.error('Failed', res.message || 'Failed to create student record.');
      }
    } catch (err) {
      Toast.error('Error', 'Communication error.');
    } finally {
      btn.disabled = false;
    }
  }
</script>
</body>
</html>
