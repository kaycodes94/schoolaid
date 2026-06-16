<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Management — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .teacher-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: var(--space-6);
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
      <a href="teachers" class="nav-item active">
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
          <div class="page-title">Teacher Management</div>
          <div class="page-breadcrumb">Recruitment / <span>Teachers</span></div>
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

      <!-- Search Toolbar -->
      <div class="toolbar">
        <div class="search-bar">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" id="searchInput" placeholder="Search teacher name or ID...">
        </div>
        <div class="toolbar-right">
          <select class="form-control" id="deptFilter" style="width: 200px;">
            <option value="all">All Departments</option>
          </select>
        </div>
      </div>

      <!-- Teachers List Card -->
      <div class="card">
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Teacher</th>
                <th>Employee ID</th>
                <th>Department</th>
                <th>Qualification</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody id="teachersTableBody">
              <tr>
                <td colspan="6"><div class="empty-state"><div class="spinner"></div></div></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<!-- Edit Modal -->
<div class="modal-overlay" id="editModal">
  <div class="modal" style="max-width:480px;">
    <div class="modal-header">
      <h3 class="modal-title">Edit Teacher Assignment</h3>
      <button class="modal-close" onclick="Modal.close('editModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="editForm" onsubmit="saveTeacherAssignment(event)">
        <input type="hidden" id="teacherId">
        
        <div class="form-group">
          <label class="form-label" for="teacherName">Name</label>
          <input type="text" id="teacherName" class="form-control" readonly style="opacity: 0.7;">
        </div>

        <div class="form-group">
          <label class="form-label" for="teacherDept">Department</label>
          <select id="teacherDept" class="form-control" required></select>
        </div>

        <div class="form-group">
          <label class="form-label" for="teacherStatus">Status</label>
          <select id="teacherStatus" class="form-control" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="suspended">Suspended</option>
          </select>
        </div>

        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('editModal')">Cancel</button>
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

  let currentTeachers = [];
  let departments = [];

  document.addEventListener('DOMContentLoaded', async () => {
    await loadDepartments();
    loadTeachers();

    document.getElementById('searchInput').addEventListener('input', debounce(() => {
      loadTeachers();
    }));

    document.getElementById('deptFilter').addEventListener('change', () => {
      loadTeachers();
    });
  });

  async function loadDepartments() {
    try {
      const res = await API.departments.list();
      if (res && res.status === 'success') {
        departments = res.data || [];
        const filterSelect = document.getElementById('deptFilter');
        const modalSelect = document.getElementById('teacherDept');
        
        departments.forEach(d => {
          filterSelect.innerHTML += `<option value="${d.id}">${d.name}</option>`;
          modalSelect.innerHTML += `<option value="${d.id}">${d.name}</option>`;
        });
      }
    } catch(e) {
      console.error(e);
    }
  }

  function loadTeachers() {
    const tbody = document.getElementById('teachersTableBody');
    tableLoadingSkeleton(tbody, 6, 5);

    const search = document.getElementById('searchInput').value.toLowerCase().trim();
    const deptId = document.getElementById('deptFilter').value;

    const staffList = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
    currentTeachers = staffList.filter(s => s.role === 'teacher');

    // Filter
    let filtered = currentTeachers;
    if (search) {
      filtered = filtered.filter(t => 
        `${t.first_name} ${t.last_name}`.toLowerCase().includes(search) ||
        t.staff_id.toLowerCase().includes(search)
      );
    }
    if (deptId !== 'all') {
      filtered = filtered.filter(t => String(t.department_id) === String(deptId));
    }

    // Check count of pending applications for the Recruitment badge in sidebar
    const pendingRegs = JSON.parse(localStorage.getItem('sams_mock_teacher_regs') || '[]')
      .filter(r => r.status === 'pending');
    const badge = document.getElementById('pendingTeacherBadge');
    if (pendingRegs.length > 0) {
      badge.textContent = pendingRegs.length;
      badge.style.display = '';
    } else {
      badge.style.display = 'none';
    }

    if (filtered.length === 0) {
      tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="empty-state-icon">👨‍🏫</div><div class="empty-state-title">No Teachers Found</div></div></td></tr>`;
      return;
    }

    tbody.innerHTML = filtered.map(t => {
      const dept = departments.find(d => String(d.id) === String(t.department_id));
      const deptName = dept ? dept.name : 'Unassigned';
      return `
        <tr>
          <td>
            <div class="user-cell">
              ${Format.avatar(`${t.first_name} ${t.last_name}`, t.passport_photo)}
              <div>
                <strong>${t.first_name} ${t.last_name}</strong>
                <div class="text-xs text-muted">${t.email}</div>
              </div>
            </div>
          </td>
          <td><code>${t.staff_id}</code></td>
          <td>${deptName}</td>
          <td>${t.qualification || '—'}</td>
          <td>${Format.badge(t.status || 'active')}</td>
          <td class="text-right">
            <button class="btn btn-secondary btn-sm" onclick="openEditModal(${t.id})">Edit</button>
          </td>
        </tr>
      `;
    }).join('');
  }

  function openEditModal(id) {
    const t = currentTeachers.find(item => item.id === id);
    if (!t) return;

    document.getElementById('teacherId').value = t.id;
    document.getElementById('teacherName').value = `${t.first_name} ${t.last_name}`;
    document.getElementById('teacherDept').value = t.department_id || '';
    document.getElementById('teacherStatus').value = t.status || 'active';

    Modal.open('editModal');
  }

  function saveTeacherAssignment(e) {
    e.preventDefault();
    const id = parseInt(document.getElementById('teacherId').value);
    const deptId = parseInt(document.getElementById('teacherDept').value);
    const status = document.getElementById('teacherStatus').value;

    const staffList = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
    const idx = staffList.findIndex(s => s.id === id);
    if (idx !== -1) {
      staffList[idx].department_id = deptId;
      staffList[idx].status = status;
      localStorage.setItem('sams_mock_staff', JSON.stringify(staffList));
      
      // Add Audit Log
      const audit = JSON.parse(localStorage.getItem('sams_mock_audit') || '[]');
      audit.unshift({
        id: audit.length + 1,
        actor_name: 'Amaka Uche',
        action: 'UPDATE_TEACHER',
        description: `Updated teacher assignment/status for ${staffList[idx].first_name} ${staffList[idx].last_name}`,
        ip_address: '127.0.0.1',
        created_at: new Date().toISOString()
      });
      localStorage.setItem('sams_mock_audit', JSON.stringify(audit));

      Toast.success('Success', 'Teacher assignments updated successfully.');
      Modal.close('editModal');
      loadTeachers();
    } else {
      Toast.error('Error', 'Teacher not found.');
    }
  }
</script>
</body>
</html>
