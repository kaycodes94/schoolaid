<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Profile — School Aid Management System</title>
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
      <a href="profile" class="nav-item active" id="nav-profile">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/></svg>
        My Profile
      </a>

      <div class="nav-section-label">Academics</div>
      <a href="classes" class="nav-item">
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
          <div class="page-title">My Profile</div>
          <div class="page-breadcrumb">Overview / <span>Profile</span></div>
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

      <div class="grid gap-6" style="grid-template-columns: 1fr 2fr;">
        <!-- Left Column: Avatar & Basic Specs -->
        <div class="card" style="text-align:center;padding:var(--space-6);">
          <div class="avatar user-avatar-initials" style="width:120px;height:120px;font-size:2.5rem;margin:0 auto var(--space-4);background:var(--gradient-accent);">FS</div>
          <h2 id="profileFullName" style="margin-bottom:var(--space-1);">Fatima Sani</h2>
          <span class="badge badge-primary mb-6">Secondary Educator</span>

          <div style="border-top:1px solid var(--color-border);padding-top:var(--space-4);text-align:left;">
            <div class="mb-3">
              <span class="text-xs text-muted block">Staff ID</span>
              <code id="profileStaffId">PAA-ST-007</code>
            </div>
            <div class="mb-3">
              <span class="text-xs text-muted block">Department</span>
              <strong id="profileDept">Science Department</strong>
            </div>
            <div class="mb-3">
              <span class="text-xs text-muted block">Employment Date</span>
              <span id="profileHireDate">2018-09-01</span>
            </div>
          </div>
        </div>

        <!-- Right Column: Personal & Contact Form -->
        <div class="card">
          <div class="card-header"><h3 class="card-title">Profile Information</h3></div>
          <form id="profileForm" onsubmit="saveProfile(event)">
            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="profileFirst">First Name</label>
                <input type="text" id="profileFirst" class="form-control" readonly style="opacity: 0.7;">
              </div>
              <div class="form-group">
                <label class="form-label" for="profileLast">Last Name</label>
                <input type="text" id="profileLast" class="form-control" readonly style="opacity: 0.7;">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="profileQual">Academic Qualifications</label>
              <input type="text" id="profileQual" class="form-control" readonly style="opacity: 0.7;">
            </div>

            <h4 class="mb-4 mt-6" style="border-bottom:1px solid var(--color-border);padding-bottom:var(--space-2);">Editable Contact Information</h4>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="profileEmail">Email Address <span class="required">*</span></label>
                <input type="email" id="profileEmail" class="form-control" required>
              </div>
              <div class="form-group">
                <label class="form-label" for="profilePhone">Phone Number <span class="required">*</span></label>
                <input type="tel" id="profilePhone" class="form-control" required>
              </div>
            </div>

            <div class="flex gap-3 justify-end mt-6">
              <button type="submit" class="btn btn-primary">Update Profile Settings</button>
            </div>
          </form>
        </div>
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<div class="toast-container"></div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('teacher');

  let activeTeacher = null;

  document.addEventListener('DOMContentLoaded', () => {
    loadProfileDetails();
  });

  function loadProfileDetails() {
    const user = Auth.getUser();
    if (!user) return;

    const staffList = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
    const teacher = staffList.find(s => s.staff_id === user.staff_id);
    if (!teacher) return;

    activeTeacher = teacher;

    // Load Department name
    const depts = JSON.parse(localStorage.getItem('sams_mock_departments') || '[]');
    const dept = depts.find(d => String(d.id) === String(teacher.department_id));
    const deptName = dept ? dept.name : 'Science Department';

    // Populate read-only text
    document.getElementById('profileFullName').textContent = `${teacher.first_name} ${teacher.last_name}`;
    document.getElementById('profileStaffId').textContent = teacher.staff_id;
    document.getElementById('profileDept').textContent = deptName;
    document.getElementById('profileHireDate').textContent = teacher.hire_date || '—';

    // Populate form inputs
    document.getElementById('profileFirst').value = teacher.first_name;
    document.getElementById('profileLast').value = teacher.last_name;
    document.getElementById('profileQual').value = teacher.qualification || 'B.Sc Biology, PGDE';
    document.getElementById('profileEmail').value = teacher.email;
    document.getElementById('profilePhone').value = teacher.phone || '';
  }

  function saveProfile(e) {
    e.preventDefault();
    if (!activeTeacher) return;

    const email = document.getElementById('profileEmail').value.trim();
    const phone = document.getElementById('profilePhone').value.trim();

    const staffList = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
    const idx = staffList.findIndex(s => s.id === activeTeacher.id);
    if (idx !== -1) {
      staffList[idx].email = email;
      staffList[idx].phone = phone;
      localStorage.setItem('sams_mock_staff', JSON.stringify(staffList));

      // Update Session
      const user = Auth.getUser();
      user.email = email;
      localStorage.setItem('sams_auth_user', JSON.stringify(user));

      Toast.success('Success', 'Profile settings updated.');
      loadProfileDetails();
    } else {
      Toast.error('Error', 'Unable to find teacher file record.');
    }
  }
</script>
</body>
</html>
