<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Classes — School Aid Management System</title>
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
      <div class="sidebar-logo-icon">🎓</div>
      <div class="sidebar-logo-text">
        <div class="sidebar-logo-name">Plan Aid Academy</div>
        <div class="sidebar-logo-role">Teacher Portal</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Overview</div>
      <a href="index" class="nav-item" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>
      <a href="profile" class="nav-item" id="nav-profile">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/></svg>
        My Profile
      </a>

      <div class="nav-section-label">Academics</div>
      <a href="classes" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        My Classes
      </a>
      <a href="timetable" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Timetable
      </a>

      <div class="nav-section-label">Student Records</div>
      <a href="attendance" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Mark Attendance
      </a>
      <a href="results" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4M7.5 8h9M7.5 16h9M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        Enter Results
      </a>
      <a href="assignments" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Assignments
      </a>

      <div class="nav-section-label">Communication</div>
      <a href="messages" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        Messages
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--gradient-accent);">FS</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>Fatima Sani</div>
          <div class="sidebar-user-role">Teacher</div>
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
          <div class="page-title">My Classes</div>
          <div class="page-breadcrumb">Academics / <span>Classes</span></div>
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
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--gradient-accent);font-size:0.65rem;width:28px;height:28px;">FS</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>Fatima Sani</div>
            <div class="dropdown-divider"></div>
            <a href="profile" class="dropdown-item">My Profile</a>
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

      <!-- Class selector toolbar -->
      <div class="toolbar">
        <div class="tabs" id="classTabs">
          <button class="tab-btn active" data-class="all">All Students</button>
          <button class="tab-btn" data-class="JSS 2">JSS 2</button>
          <button class="tab-btn" data-class="SSS 2">SSS 2</button>
          <button class="tab-btn" data-class="JSS 1">JSS 1</button>
        </div>
        <div class="toolbar-right">
          <div class="search-bar">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="searchInput" placeholder="Search student name...">
          </div>
        </div>
      </div>

      <!-- Class Students Card -->
      <div class="card">
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Student</th>
                <th>Admission No</th>
                <th>Class</th>
                <th>Parent Contact</th>
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
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<!-- Student Details Modal -->
<div class="modal-overlay" id="detailModal">
  <div class="modal" style="max-width: 500px;">
    <div class="modal-header">
      <h3 class="modal-title">Student Profile Detail</h3>
      <button class="modal-close" onclick="Modal.close('detailModal')">✕</button>
    </div>
    <div class="modal-body" id="detailContent">
      <!-- Loaded dynamically -->
    </div>
  </div>
</div>

<div class="toast-container"></div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('teacher');

  let activeClass = 'all';
  let searchQuery = '';
  let studentList = [];

  document.addEventListener('DOMContentLoaded', () => {
    loadStudents();

    // Tabs listener
    document.querySelectorAll('#classTabs .tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('#classTabs .tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        activeClass = btn.dataset.class;
        renderRoster();
      });
    });

    // Search bar
    document.getElementById('searchInput').addEventListener('input', debounce((e) => {
      searchQuery = e.target.value.toLowerCase().trim();
      renderRoster();
    }));
  });

  async function loadStudents() {
    try {
      const res = await API.students.list({ limit: 50 });
      if (res && res.status === 'success') {
        studentList = res.data.students || [];
      } else {
        studentList = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');
      }
      renderRoster();
    } catch (e) {
      studentList = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');
      renderRoster();
    }
  }

  function renderRoster() {
    const tbody = document.getElementById('studentsTableBody');
    let filtered = studentList;

    if (activeClass !== 'all') {
      filtered = filtered.filter(s => s.current_class === activeClass);
    }
    if (searchQuery) {
      filtered = filtered.filter(s => 
        `${s.first_name} ${s.last_name}`.toLowerCase().includes(searchQuery) ||
        s.admission_no.toLowerCase().includes(searchQuery)
      );
    }

    if (filtered.length === 0) {
      tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><div class="empty-state-icon">📂</div><div class="empty-state-title">No Students Found</div></div></td></tr>`;
      return;
    }

    tbody.innerHTML = filtered.map(s => `
      <tr>
        <td>
          <div class="user-cell">
            ${Format.avatar(`${s.first_name} ${s.last_name}`, s.passport_photo)}
            <div>
              <strong>${s.first_name} ${s.last_name}</strong>
              <div class="text-xs text-muted">${s.username || 'student'}</div>
            </div>
          </div>
        </td>
        <td><code>${s.admission_no}</code></td>
        <td>${s.current_class}</td>
        <td>${s.parent_name || '—'}<br><small style="color:var(--color-text-muted);">${s.parent_phone || '—'}</small></td>
        <td>${Format.badge(s.status || 'active')}</td>
        <td class="text-right">
          <button class="btn btn-secondary btn-sm" onclick="showStudentDetail(${s.id})">Details</button>
        </td>
      </tr>
    `).join('');
  }

  function showStudentDetail(id) {
    const s = studentList.find(item => item.id === id);
    if (!s) return;

    const modalBody = document.getElementById('detailContent');
    modalBody.innerHTML = `
      <div style="text-align:center;margin-bottom:var(--space-6);">
        <div class="avatar" style="width:80px;height:80px;font-size:1.8rem;margin:0 auto var(--space-3);background:var(--gradient-accent);">
          ${s.first_name[0]}${s.last_name[0]}
        </div>
        <h3>${s.first_name} ${s.last_name}</h3>
        <span class="badge badge-primary">${s.current_class}</span>
      </div>

      <div class="profile-detail">
        <div class="detail-item">
          <label>Admission Number</label>
          <span><code>${s.admission_no}</code></span>
        </div>
        <div class="detail-item">
          <label>Date of Birth</label>
          <span>${Format.date(s.date_of_birth)}</span>
        </div>
        <div class="detail-item">
          <label>Parent/Guardian</label>
          <span>${s.parent_name || '—'}</span>
        </div>
        <div class="detail-item">
          <label>Parent Contact Phone</label>
          <span>${s.parent_phone || '—'}</span>
        </div>
        <div class="detail-item">
          <label>Parent Contact Email</label>
          <span>${s.parent_email || s.email || '—'}</span>
        </div>
        <div class="detail-item">
          <label>Home Address</label>
          <span>${s.home_address || '—'}</span>
        </div>
      </div>

      <div class="flex justify-end mt-6">
        <button class="btn btn-secondary" onclick="Modal.close('detailModal')">Close</button>
      </div>
    `;
    Modal.open('detailModal');
  }
</script>
</body>
</html>
