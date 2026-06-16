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
      <a href="teachers" class="nav-item" id="nav-teachers">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Teacher Management
      </a>

      <div class="nav-section-label">Students</div>
      <a href="students" class="nav-item active" id="nav-students">
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
      <a href="reports" class="nav-item">
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

      <!-- Page Header Actions -->
      <div class="page-header">
        <div class="page-header-text">
          <h2>Student Directory</h2>
          <p class="text-secondary">Search and view student profiles under your unit.</p>
        </div>
      </div>

      <!-- Filters Toolbar -->
      <div class="toolbar">
        <div class="search-bar" style="max-width: 320px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" id="searchInput" placeholder="Search student name or admission ID...">
        </div>
        <div class="flex gap-3">
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
  Auth.requireRole('unit_head');

  let currentStatus = 'active';
  let limit = 10;
  let offset = 0;
  let searchQuery = '';
  let selectedStudentId = null;

  document.addEventListener('DOMContentLoaded', () => {
    loadStudents();

    // Filters listener
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

    loadPendingBadge();
  });

  async function loadPendingBadge() {
    try {
      const res = await API.dashboard.stats();
      if (res && res.status === 'success' && res.data?.stats?.pending_teachers > 0) {
        const badge = document.getElementById('pendingTeacherBadge');
        if (badge) {
          badge.textContent = res.data.stats.pending_teachers;
          badge.style.display = '';
        }
      }
    } catch (_) {}
  }

  async function loadStudents() {
    const tbody = document.getElementById('studentsTableBody');
    tableLoadingSkeleton(tbody, 6, 5);

    try {
      const user = Auth.getUser();
      const userUnitId = user?.unit?.id || user?.unit_id || '';

      const res = await API.students.list({
        unit: userUnitId,
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
</script>
</body>
</html>
