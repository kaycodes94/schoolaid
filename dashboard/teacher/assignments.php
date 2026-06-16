<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignments — School Aid Management System</title>
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
      <a href="assignments" class="nav-item active">
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
          <div class="page-title">Course Assignments</div>
          <div class="page-breadcrumb">Academics / <span>Assignments</span></div>
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

      <!-- Header actions -->
      <div class="page-header mb-6">
        <div class="page-header-text">
          <h2>Assignments</h2>
          <p class="text-secondary">Create projects, post materials, review student submissions, and input feedback grades.</p>
        </div>
        <div class="page-header-actions">
          <button class="btn btn-primary" onclick="Modal.open('createModal')">+ Create Assignment</button>
        </div>
      </div>

      <!-- Split Layout -->
      <div class="grid gap-6" style="grid-template-columns: 1fr 1.5fr;">
        <!-- Left: List of Assignments -->
        <div class="card">
          <div class="card-header"><h3 class="card-title">Assigned Tasks</h3></div>
          <div id="assignmentsList" class="flex flex-col gap-3" style="max-height: 500px; overflow-y:auto; padding-right:4px;">
            <div class="empty-state"><div class="spinner"></div></div>
          </div>
        </div>

        <!-- Right: Submissions List -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" id="submissionsTitle">Submissions</h3>
          </div>
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                  <th>Student</th>
                  <th>Submitted At</th>
                  <th>Score</th>
                  <th>Status</th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody id="submissionsTableBody">
                <tr><td colspan="5"><div class="empty-state">Select an assignment to view student submissions.</div></td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<!-- Create Assignment Modal -->
<div class="modal-overlay" id="createModal">
  <div class="modal" style="max-width:480px;">
    <div class="modal-header">
      <h3 class="modal-title">Create Assignment</h3>
      <button class="modal-close" onclick="Modal.close('createModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="createForm" onsubmit="createAssignment(event)">
        <div class="form-group">
          <label class="form-label" for="asgnTitle">Assignment Title <span class="required">*</span></label>
          <input type="text" id="asgnTitle" class="form-control" placeholder="e.g. Mitochondria Drawing" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="asgnClass">Target Class <span class="required">*</span></label>
          <select id="asgnClass" class="form-control" required>
            <option value="1">JSS 2 (Basic Science)</option>
            <option value="2">SSS 2 (Biology)</option>
            <option value="3">JSS 1 (Basic Science)</option>
          </select>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="asgnMaxScore">Max Score <span class="required">*</span></label>
            <input type="number" id="asgnMaxScore" class="form-control" value="10" min="1" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="asgnDueDate">Due Date <span class="required">*</span></label>
            <input type="date" id="asgnDueDate" class="form-control" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="asgnDesc">Instructions / Details <span class="required">*</span></label>
          <textarea id="asgnDesc" class="form-control" placeholder="Provide instructions for the students..." rows="4" required></textarea>
        </div>

        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('createModal')">Cancel</button>
          <button type="submit" class="btn btn-primary">Publish Assignment</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Grading Modal -->
<div class="modal-overlay" id="gradeModal">
  <div class="modal" style="max-width:480px;">
    <div class="modal-header">
      <h3 class="modal-title">Grade Submission</h3>
      <button class="modal-close" onclick="Modal.close('gradeModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="gradeForm" onsubmit="saveGrade(event)">
        <input type="hidden" id="subId">

        <div class="form-group">
          <label class="form-label">Student Name</label>
          <input type="text" id="gradeStudentName" class="form-control" readonly style="opacity:0.7;">
        </div>

        <div class="form-group">
          <label class="form-label">Submission Text</label>
          <div id="gradeSubText" style="padding:var(--space-3);background:var(--color-bg-elevated);border-radius:var(--radius-md);border:1px solid var(--color-border);font-size:var(--font-size-sm);min-height:80px;white-space:pre-wrap;"></div>
        </div>

        <div class="form-group">
          <label class="form-label" for="gradeScore">Score (Max: <span id="gradeMaxScoreLabel">10</span>) <span class="required">*</span></label>
          <input type="number" id="gradeScore" class="form-control" min="0" step="0.5" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="gradeFeedback">Feedback Comments</label>
          <textarea id="gradeFeedback" class="form-control" placeholder="Write feedback comments..." rows="3"></textarea>
        </div>

        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('gradeModal')">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit Grade</button>
        </div>
      </form>
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

  document.getElementById('asgnDueDate').value = new Date(Date.now() + 3600000 * 24 * 7).toISOString().split('T')[0];

  let currentAssignments = [];
  let selectedAssignment = null;
  let submissionList = [];

  document.addEventListener('DOMContentLoaded', () => {
    loadAssignments();
  });

  async function loadAssignments() {
    const listEl = document.getElementById('assignmentsList');
    listEl.innerHTML = '<div class="empty-state"><div class="spinner"></div></div>';

    try {
      const res = await API.assignments.list({ teacher_id: 7 });
      if (res && res.status === 'success') {
        currentAssignments = res.data || [];
      } else {
        currentAssignments = JSON.parse(localStorage.getItem('sams_mock_assignments') || '[]');
      }

      if (currentAssignments.length === 0) {
        listEl.innerHTML = '<div class="empty-state">No assignments published.</div>';
        return;
      }

      listEl.innerHTML = currentAssignments.map(a => `
        <div class="notif-item assignment-card" id="asgn-${a.id}" onclick="selectAssignment(${a.id})" style="border: 1px solid var(--color-border); cursor:pointer; padding:var(--space-3) var(--space-4); border-radius:var(--radius-lg); transition: all var(--transition-normal);">
          <div class="notif-icon-wrap" style="background:rgba(99,102,241,0.12);">📝</div>
          <div class="notif-text" style="flex:1;">
            <div class="notif-title font-semibold" style="color:var(--color-text-primary);">${a.title}</div>
            <div class="notif-msg text-xs text-muted" style="margin-top:2px;">Due: ${Format.date(a.due_date)} · Max: ${a.max_score}</div>
          </div>
        </div>
      `).join('');

      // Auto-select first
      if (currentAssignments.length > 0) {
        selectAssignment(currentAssignments[0].id);
      }

    } catch(e) {
      listEl.innerHTML = '<div class="empty-state">Error connecting to server.</div>';
    }
  }

  function selectAssignment(id) {
    document.querySelectorAll('.assignment-card').forEach(card => {
      card.style.borderColor = 'var(--color-border)';
      card.style.background = '';
    });
    
    const card = document.getElementById(`asgn-${id}`);
    if (card) {
      card.style.borderColor = 'var(--color-accent)';
      card.style.background = 'rgba(99,102,241,0.04)';
    }

    selectedAssignment = currentAssignments.find(a => a.id === id);
    if (selectedAssignment) {
      document.getElementById('submissionsTitle').textContent = `Submissions for "${selectedAssignment.title}"`;
      loadSubmissions(id);
    }
  }

  async function loadSubmissions(asgnId) {
    const tbody = document.getElementById('submissionsTableBody');
    tableLoadingSkeleton(tbody, 5, 4);

    try {
      const res = await API.assignments.submissions({ assignment_id: asgnId });
      submissionList = (res && res.status === 'success') ? res.data : [];
      
      const students = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');

      if (submissionList.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5"><div class="empty-state">No submissions recorded yet for this task.</div></td></tr>';
        return;
      }

      tbody.innerHTML = submissionList.map(sub => {
        const student = students.find(s => String(s.id) === String(sub.student_id)) || {};
        const studentName = student.first_name ? `${student.first_name} ${student.last_name}` : 'Unknown Student';
        
        return `
          <tr>
            <td>
              <div class="user-cell">
                ${Format.avatar(studentName, student.passport_photo)}
                <div>
                  <strong>${studentName}</strong>
                  <div class="text-xs text-muted">${student.admission_no || ''}</div>
                </div>
              </div>
            </td>
            <td><code>${Format.datetime(sub.submitted_at)}</code></td>
            <td class="font-bold">${sub.score !== null ? `${sub.score} / ${selectedAssignment.max_score}` : '—'}</td>
            <td>${Format.badge(sub.status)}</td>
            <td class="text-right">
              <button class="btn btn-secondary btn-sm" onclick="openGradingModal(${sub.id}, '${studentName}')">Grade</button>
            </td>
          </tr>
        `;
      }).join('');

    } catch(e) {
      tbody.innerHTML = '<tr><td colspan="5"><div class="empty-state">Connection error</div></td></tr>';
    }
  }

  function openGradingModal(subId, studentName) {
    const sub = submissionList.find(s => s.id === subId);
    if (!sub) return;

    document.getElementById('subId').value = subId;
    document.getElementById('gradeStudentName').value = studentName;
    document.getElementById('gradeSubText').textContent = sub.submission_text || 'No submission content provided.';
    document.getElementById('gradeMaxScoreLabel').textContent = selectedAssignment.max_score;
    document.getElementById('gradeScore').value = sub.score !== null ? sub.score : '';
    document.getElementById('gradeScore').max = selectedAssignment.max_score;
    document.getElementById('gradeFeedback').value = sub.feedback || '';

    Modal.open('gradeModal');
  }

  async function saveGrade(e) {
    e.preventDefault();
    const subId = parseInt(document.getElementById('subId').value);
    const score = parseFloat(document.getElementById('gradeScore').value);
    const feedback = document.getElementById('gradeFeedback').value.trim();

    if (score > selectedAssignment.max_score) {
      Toast.warning('Validation Error', `Score cannot exceed maximum of ${selectedAssignment.max_score}.`);
      return;
    }

    try {
      const res = await API.assignments.grade({ submission_id: subId, score, feedback });
      if (res && res.status === 'success') {
        Toast.success('Success', 'Submission graded successfully.');
        Modal.close('gradeModal');
        loadSubmissions(selectedAssignment.id);
      } else {
        Toast.error('Grading Failed', res.message || 'Failed to grade submission.');
      }
    } catch(e) {
      Toast.error('Connection Error', 'Failed to communicate with server.');
    }
  }

  async function createAssignment(e) {
    e.preventDefault();
    const title = document.getElementById('asgnTitle').value.trim();
    const classId = document.getElementById('asgnClass').value;
    const maxScore = document.getElementById('asgnMaxScore').value;
    const dueDate = document.getElementById('asgnDueDate').value;
    const description = document.getElementById('asgnDesc').value.trim();

    try {
      const res = await API.assignments.create({ title, class_id: classId, max_score: maxScore, due_date: dueDate, description });
      if (res && res.status === 'success') {
        Toast.success('Success', 'Assignment posted successfully.');
        Modal.close('createModal');
        document.getElementById('createForm').reset();
        loadAssignments();
      } else {
        Toast.error('Post Failed', res.message || 'Failed to post assignment.');
      }
    } catch(e) {
      Toast.error('Connection Error', 'Unable to post assignment.');
    }
  }
</script>
</body>
</html>
