<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Profile — School Aid Management System</title>
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
        <div class="sidebar-logo-role">Student Portal</div>
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

      <div class="nav-section-label">Academic Records</div>
      <a href="results" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4M7.5 8h9M7.5 16h9M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        Term Results
      </a>
      <a href="attendance" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        My Attendance
      </a>
      <a href="timetable" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Class Timetable
      </a>

      <div class="nav-section-label">Tasks & Memos</div>
      <a href="assignments" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        My Assignments
      </a>
      <a href="announcements" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 17H2a3 3 0 000-6h1V9a9 9 0 0118 0v2h1a3 3 0 010 6z"/></svg>
        Announcements
      </a>
      <a href="messages" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        Teacher Messages
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--gradient-accent);">JD</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>John Dakyen</div>
          <div class="sidebar-user-role">Student</div>
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
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--gradient-accent);font-size:0.65rem;width:28px;height:28px;">JD</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>John Dakyen</div>
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
        <!-- Avatar card -->
        <div class="card" style="text-align:center;padding:var(--space-6);">
          <div class="avatar user-avatar-initials" style="width:120px;height:120px;font-size:2.5rem;margin:0 auto var(--space-4);background:var(--gradient-accent);">JD</div>
          <h2 id="studentFullName" style="margin-bottom:var(--space-1);">John Dakyen</h2>
          <span class="badge badge-success mb-6">Active Student</span>

          <div style="border-top:1px solid var(--color-border);padding-top:var(--space-4);text-align:left;">
            <div class="mb-3">
              <span class="text-xs text-muted block">Admission Number</span>
              <code id="studentAdmissionNo">PAA-2026-0003</code>
            </div>
            <div class="mb-3">
              <span class="text-xs text-muted block">Student ID Number</span>
              <code id="studentIdNumber">STD-2026-0003</code>
            </div>
            <div class="mb-3">
              <span class="text-xs text-muted block">Current Class Room</span>
              <strong id="studentClass">JSS 2</strong>
            </div>
          </div>
        </div>

        <!-- Details form card -->
        <div class="card">
          <div class="card-header"><h3 class="card-title">Registration File Details</h3></div>
          <div class="profile-detail">
            <div class="detail-item">
              <label>First Name</label>
              <span id="fieldFirst">John</span>
            </div>
            <div class="detail-item">
              <label>Last Name</label>
              <span id="fieldLast">Dakyen</span>
            </div>
            <div class="detail-item">
              <label>Date of Birth</label>
              <span id="fieldDob">2012-05-14</span>
            </div>
            <div class="detail-item">
              <label>Parent / Guardian Name</label>
              <span id="fieldParentName">Parent Name</span>
            </div>
            <div class="detail-item">
              <label>Parent Contact Phone</label>
              <span id="fieldParentPhone">+234...</span>
            </div>
            <div class="detail-item">
              <label>Parent Email Address</label>
              <span id="fieldParentEmail">parent@email.com</span>
            </div>
            <div class="detail-item">
              <label>Home Address</label>
              <span id="fieldAddress">Jos, Plateau State, Nigeria</span>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('student');

  document.addEventListener('DOMContentLoaded', () => {
    loadStudentProfile();
  });

  function loadStudentProfile() {
    const user = Auth.getUser();
    if (!user) return;

    // Read students mock array
    const students = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');
    // Try to find by username or generating ID
    let student = students.find(s => s.username === user.username || s.student_id_number === user.staff_id);
    
    if (!student) {
      // Fallback JSS 2 student John Dakyen
      student = {
        first_name: 'John',
        last_name: 'Dakyen',
        admission_no: 'PAA-2026-0003',
        student_id_number: 'STD-2026-0003',
        current_class: 'JSS 2',
        date_of_birth: '2012-05-14',
        parent_name: 'Mr. Dakyen',
        parent_phone: '+234 705 555 6666',
        parent_email: 'dakyen@email.com',
        home_address: 'Jos, Plateau State, Nigeria'
      };
    }

    document.getElementById('studentFullName').textContent = `${student.first_name} ${student.last_name}`;
    document.getElementById('studentAdmissionNo').textContent = student.admission_no;
    document.getElementById('studentIdNumber').textContent = student.student_id_number;
    document.getElementById('studentClass').textContent = student.current_class;

    document.getElementById('fieldFirst').textContent = student.first_name;
    document.getElementById('fieldLast').textContent = student.last_name;
    document.getElementById('fieldDob').textContent = Format.date(student.date_of_birth);
    document.getElementById('fieldParentName').textContent = student.parent_name || '—';
    document.getElementById('fieldParentPhone').textContent = student.parent_phone || '—';
    document.getElementById('fieldParentEmail').textContent = student.parent_email || '—';
    document.getElementById('fieldAddress').textContent = student.home_address || '—';
  }
</script>
</body>
</html>
