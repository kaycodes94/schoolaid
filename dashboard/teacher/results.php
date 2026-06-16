<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enter Results — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .score-input {
      width: 75px;
      padding: var(--space-2) var(--space-3);
      font-size: var(--font-size-sm);
      text-align: center;
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
      <a href="results" class="nav-item active">
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
          <div class="page-title">Gradebook Manager</div>
          <div class="page-breadcrumb">Student Records / <span>Results</span></div>
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

      <!-- Configuration Card -->
      <div class="card mb-6">
        <div class="card-header"><h3 class="card-title">Select Class & Subject Parameters</h3></div>
        <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr 1fr;">
          <div class="form-group">
            <label class="form-label" for="classSelect">Class Room</label>
            <select id="classSelect" class="form-control">
              <option value="JSS 2">JSS 2</option>
              <option value="SSS 2">SSS 2</option>
              <option value="JSS 1">JSS 1</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="subjectSelect">Subject</label>
            <select id="subjectSelect" class="form-control">
              <option value="1">Biology</option>
              <option value="2">Basic Science</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="termSelect">Academic Term</label>
            <select id="termSelect" class="form-control">
              <option value="1st">1st Term</option>
              <option value="2nd">2nd Term</option>
              <option value="3rd">3rd Term</option>
            </select>
          </div>
          <div class="form-group flex items-end">
            <button class="btn btn-primary btn-block" onclick="loadScoreSheet()">Load Score Sheet</button>
          </div>
        </div>
      </div>

      <!-- Results Editor Card -->
      <div class="card" id="scoreSheetCard" style="display:none;">
        <div class="flex justify-between items-center mb-6" style="border-bottom:1px solid var(--color-border);padding-bottom:var(--space-4);">
          <h3 class="card-title" id="scoreSheetTitle">Grades Register</h3>
          <span class="text-xs text-muted">Max: CA (30 Marks) | Exam (70 Marks)</span>
        </div>

        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Student</th>
                <th>Admission No</th>
                <th style="width: 120px; text-align:center;">CA (30)</th>
                <th style="width: 120px; text-align:center;">Exam (70)</th>
                <th style="width: 100px; text-align:center;">Total (100)</th>
                <th style="width: 100px; text-align:center;">Grade</th>
                <th style="width: 120px; text-align:center;">Remark</th>
              </tr>
            </thead>
            <tbody id="scoresTableBody">
              <!-- Filled Dynamically -->
            </tbody>
          </table>
        </div>

        <div class="flex justify-end mt-6" style="border-top:1px solid var(--color-border);padding-top:var(--space-4);">
          <button class="btn btn-success" onclick="saveScoreSheet()">Save & Publish Grades</button>
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
  if (!localStorage.getItem('sams_mock_results')) {
    localStorage.removeItem('sams_mock_initialized');
    window.location.reload();
  }

  Auth.requireAuth();
  Auth.requireRole('teacher');

  let currentStudents = [];
  let existingResults = [];

  async function loadScoreSheet() {
    const cls = document.getElementById('classSelect').value;
    const sub = document.getElementById('subjectSelect').value;
    const term = document.getElementById('termSelect').value;

    const students = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');
    currentStudents = students.filter(s => s.current_class === cls && s.status === 'active');

    if (currentStudents.length === 0) {
      Toast.info('No Students', `No active students found in ${cls}.`);
      document.getElementById('scoreSheetCard').style.display = 'none';
      return;
    }

    try {
      const res = await API.results.get({ class_name: cls, subject_id: sub, term });
      existingResults = (res && res.status === 'success') ? res.data : [];
    } catch(e) {
      existingResults = [];
    }

    renderScoreRows();
    const subText = document.getElementById('subjectSelect').options[document.getElementById('subjectSelect').selectedIndex].text;
    document.getElementById('scoreSheetTitle').textContent = `${subText} Score sheet — ${cls} (${term})`;
    document.getElementById('scoreSheetCard').style.display = 'block';
  }

  function renderScoreRows() {
    const tbody = document.getElementById('scoresTableBody');
    tbody.innerHTML = currentStudents.map(s => {
      const score = existingResults.find(r => String(r.student_id) === String(s.id)) || {};
      const ca = score.continuous_assessment || 0;
      const exam = score.exam_score || 0;
      const total = ca + exam;
      const grade = score.grade || calculateGrade(total);
      const remark = score.remark || calculateRemark(grade);

      return `
        <tr data-student-id="${s.id}">
          <td>
            <div class="user-cell">
              ${Format.avatar(`${s.first_name} ${s.last_name}`, s.passport_photo)}
              <div>
                <strong>${s.first_name} ${s.last_name}</strong>
                <div class="text-xs text-muted">${s.email || 'student'}</div>
              </div>
            </div>
          </td>
          <td><code>${s.admission_no}</code></td>
          <td>
            <input type="number" class="form-control score-input ca-input" min="0" max="30" value="${ca}" oninput="updateLiveGrade(this)">
          </td>
          <td>
            <input type="number" class="form-control score-input exam-input" min="0" max="70" value="${exam}" oninput="updateLiveGrade(this)">
          </td>
          <td class="text-center font-bold total-cell">${total}</td>
          <td class="text-center grade-cell">${grade}</td>
          <td class="text-center remark-cell">${remark}</td>
        </tr>
      `;
    }).join('');
  }

  function calculateGrade(total) {
    if (total >= 70) return 'A';
    if (total >= 60) return 'B';
    if (total >= 50) return 'C';
    if (total >= 40) return 'P';
    return 'F';
  }

  function calculateRemark(grade) {
    if (grade === 'A') return 'Excellent';
    if (grade === 'B') return 'V. Good';
    if (grade === 'C') return 'Good';
    if (grade === 'P') return 'Pass';
    return 'Fail';
  }

  function updateLiveGrade(input) {
    const row = input.closest('tr');
    const caVal = parseFloat(row.querySelector('.ca-input').value || 0);
    const examVal = parseFloat(row.querySelector('.exam-input').value || 0);

    const total = caVal + examVal;
    const grade = calculateGrade(total);
    const remark = calculateRemark(grade);

    row.querySelector('.total-cell').textContent = total;
    row.querySelector('.grade-cell').textContent = grade;
    row.querySelector('.remark-cell').textContent = remark;
  }

  async function saveScoreSheet() {
    const sub = document.getElementById('subjectSelect').value;
    const cls = document.getElementById('classSelect').value;
    const term = document.getElementById('termSelect').value;

    const rows = document.querySelectorAll('#scoresTableBody tr');
    const records = [];

    rows.forEach(row => {
      const studentId = row.dataset.studentId;
      const ca = parseFloat(row.querySelector('.ca-input').value || 0);
      const exam = parseFloat(row.querySelector('.exam-input').value || 0);
      const total = ca + exam;
      const grade = row.querySelector('.grade-cell').textContent;
      const remark = row.querySelector('.remark-cell').textContent;

      records.push({
        student_id: studentId,
        subject_id: sub,
        class_name: cls,
        term,
        continuous_assessment: ca,
        exam_score: exam,
        total_score: total,
        grade,
        remark
      });
    });

    try {
      const res = await API.results.enterResult(records);
      if (res && res.status === 'success') {
        Toast.success('Success', 'Grades saved and published successfully.');
      } else {
        Toast.error('Failed', res.message || 'Failed to save scores.');
      }
    } catch(e) {
      Toast.error('Connection Error', 'Failed to connect to school server.');
    }
  }
</script>
</body>
</html>
