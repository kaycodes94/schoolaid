<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arabic &amp; Islamic Studies Unit Portal — Plan Aid Academy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <script src="../../assets/js/auth.js"></script>
  <script>
    Auth.requireAuth();
    Auth.requireRole(['arabic', 'unit_head', 'principal', 'admin']);
  </script>
</head>
<body>
<div class="app-shell">

  <!-- Sidebar Backdrop -->
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <a href="index.php" class="sidebar-logo">
      <div class="sidebar-logo-icon">☪️</div>
      <div class="sidebar-logo-text">
        <div class="sidebar-logo-name">Plan Aid Academy</div>
        <div class="sidebar-logo-role">Arabic Unit Portal</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Overview</div>
      <a href="index.php" class="nav-item active" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Arabic Dashboard
      </a>

      <div class="nav-section-label">Academic Management</div>
      <a href="students.php" class="nav-item" id="nav-students">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Arabic Students &amp; Classes
      </a>
      <a href="subjects.php" class="nav-item" id="nav-subjects">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Arabic Subjects
      </a>
      <a href="attendance.php" class="nav-item" id="nav-attendance">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Arabic Attendance
      </a>

      <div class="nav-section-label">Results &amp; Approvals</div>
      <a href="results.php" class="nav-item" id="nav-results">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Arabic Results Entry
      </a>

      <a href="#" class="nav-item mt-6" style="color:var(--color-danger);" data-logout>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sign Out
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--color-warning);">AU</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>Ustadh Ahmad</div>
          <div class="sidebar-user-role">Arabic Unit Instructor</div>
        </div>
      </div>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <header class="topbar">
      <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <div>
          <div class="page-title">Arabic &amp; Islamic Studies Portal</div>
          <div class="page-breadcrumb" style="font-family:'Amiri',serif;color:var(--color-primary);">وحدة اللغة العربية والدراسات الإسلامية</div>
        </div>
      </div>
      <div class="topbar-right">
        <span class="session-badge session-info">2025/2026 | 1st Term</span>
      </div>
    </header>

    <div class="page-body">
      <!-- STATS CARDS GRID -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(30,58,138,0.1);color:var(--color-primary);">👥</div>
          <div class="stat-info">
            <div class="stat-value" id="stat-students">130</div>
            <div class="stat-label">Arabic Students</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(200,150,12,0.15);color:#b45309;">📖</div>
          <div class="stat-info">
            <div class="stat-value" id="stat-classes">4</div>
            <div class="stat-label">Arabic Classes</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(16,185,129,0.1);color:#059669;">👨‍🏫</div>
          <div class="stat-info">
            <div class="stat-value" id="stat-teachers">6</div>
            <div class="stat-label">Arabic Teachers</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(239,68,68,0.1);color:#dc2626;">📝</div>
          <div class="stat-info">
            <div class="stat-value" id="stat-pending-results">3</div>
            <div class="stat-label">Pending Results</div>
          </div>
        </div>
      </div>

      <div class="grid grid-2 mt-6">
        <!-- TODAY'S CLASSES -->
        <div class="card">
          <div class="card-header">
            <div>
              <h3 class="card-title">📅 Today's Arabic Schedule</h3>
              <p class="card-sub" style="font-family:'Amiri',serif;">جدول الحصص اليومية</p>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Period</th>
                    <th>Subject</th>
                    <th>Class</th>
                    <th>Teacher</th>
                  </tr>
                </thead>
                <tbody id="schedule-tbody">
                  <tr>
                    <td><b>1st Period</b> (8:30 AM)</td>
                    <td>Qur'an Memorization (Hifz)</td>
                    <td><span class="badge badge-warning">Hifz Circle</span></td>
                    <td>Ustadh Ahmad</td>
                  </tr>
                  <tr>
                    <td><b>2nd Period</b> (9:15 AM)</td>
                    <td>Arabic Language &amp; Grammar</td>
                    <td><span class="badge badge-info">Advanced</span></td>
                    <td>Mallam Umar Sani</td>
                  </tr>
                  <tr>
                    <td><b>3rd Period</b> (10:30 AM)</td>
                    <td>Fiqh &amp; Islamic Ethics</td>
                    <td><span class="badge badge-success">Intermediate</span></td>
                    <td>Ustadh Ibrahim</td>
                  </tr>
                  <tr>
                    <td><b>4th Period</b> (11:15 AM)</td>
                    <td>Tajweed &amp; Recitation</td>
                    <td><span class="badge badge-secondary">Foundation</span></td>
                    <td>Mrs. Amina Yusuf</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- ATTENDANCE SUMMARY & ANNOUNCEMENTS -->
        <div class="grid grid-1 gap-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">📊 Attendance Summary</h3>
            </div>
            <div class="card-body">
              <div class="flex items-center justify-between mb-4">
                <div>
                  <div class="text-2xl font-bold" id="att-rate" style="color:var(--color-success);">94.2%</div>
                  <div class="text-xs text-muted">Today's Attendance Rate</div>
                </div>
                <div class="flex gap-4 text-xs">
                  <div><span class="badge badge-success">Present: 122</span></div>
                  <div><span class="badge badge-warning">Late: 5</span></div>
                  <div><span class="badge badge-danger">Absent: 3</span></div>
                </div>
              </div>
              <a href="attendance.php" class="btn btn-secondary btn-sm w-full" style="text-align:center;">Mark / View Arabic Attendance →</a>
            </div>
          </div>

          <div class="card">
            <div class="card-header flex justify-between items-center">
              <h3 class="card-title">📢 Announcements</h3>
              <button class="btn btn-sm btn-primary" onclick="openAnnouncementModal()">+ Post Announcement</button>
            </div>
            <div class="card-body" id="announcements-container">
              <div style="border-left:3px solid var(--color-warning);padding-left:12px;margin-bottom:12px;">
                <div class="font-bold text-sm">1st Term Qur'an Competition Registration</div>
                <div class="text-xs font-semibold" style="font-family:'Amiri',serif;color:#b45309;">التسجيل في مسابقة حفظ القرآن الكريم</div>
                <div class="text-xs text-muted mt-1">Registration for the Hifz and Tajweed competition is open for all Arabic Unit students.</div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
</div>

<!-- POST ANNOUNCEMENT MODAL -->
<div class="modal-backdrop" id="annModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:200;align-items:center;justify-content:center;">
  <div class="modal-card" style="background:#fff;border-radius:12px;padding:24px;width:90%;max-width:440px;">
    <h3 style="font-size:18px;margin-bottom:12px;">Post Arabic Unit Announcement</h3>
    <div class="form-group mb-3">
      <label class="form-label">Title (English)</label>
      <input type="text" id="annTitle" class="form-control" placeholder="e.g. Qur'an Recitation Competition">
    </div>
    <div class="form-group mb-3">
      <label class="form-label">Title (Arabic)</label>
      <input type="text" id="annTitleAr" class="form-control" style="font-family:'Amiri',serif;direction:rtl;" placeholder="عنوان الإعلان">
    </div>
    <div class="form-group mb-4">
      <label class="form-label">Content / Details</label>
      <textarea id="annContent" class="form-control" rows="3" placeholder="Enter announcement details..."></textarea>
    </div>
    <div class="flex gap-2 justify-end">
      <button class="btn btn-secondary" onclick="closeAnnouncementModal()">Cancel</button>
      <button class="btn btn-primary" onclick="postAnnouncement()">Publish Announcement</button>
    </div>
  </div>
</div>

<script>
const BASE_URL_LOCAL = (() => {
  const parts = window.location.pathname.split('/');
  const idx = parts.indexOf('aidstudent');
  return idx !== -1 ? window.location.origin + parts.slice(0, idx + 1).join('/') : window.location.origin + '/';
})();

async function loadArabicDashboard() {
  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/arabic.php?action=dashboard`);
    const data = await res.json();
    if (data.status === 'success' && data.data) {
      const d = data.data;
      document.getElementById('stat-students').textContent = d.total_students;
      document.getElementById('stat-classes').textContent = d.total_classes;
      document.getElementById('stat-teachers').textContent = d.total_teachers;
      document.getElementById('stat-pending-results').textContent = d.pending_results;
      if (d.today_attendance) {
        document.getElementById('att-rate').textContent = d.today_attendance.rate;
      }
    }
  } catch(e) {}
}

function openAnnouncementModal() {
  document.getElementById('annModal').style.display = 'flex';
}
function closeAnnouncementModal() {
  document.getElementById('annModal').style.display = 'none';
}

async function postAnnouncement() {
  const title = document.getElementById('annTitle').value.trim();
  const titleAr = document.getElementById('annTitleAr').value.trim();
  const content = document.getElementById('annContent').value.trim();
  if (!title || !content) { alert('Please enter title and content'); return; }

  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/arabic.php?action=announcements`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ title, title_ar: titleAr, content })
    });
    const data = await res.json();
    alert(data.message || 'Announcement posted successfully!');
    closeAnnouncementModal();
    location.reload();
  } catch(e) {
    alert('Failed to post announcement');
  }
}

document.addEventListener('DOMContentLoaded', loadArabicDashboard);
</script>
</body>
</html>
