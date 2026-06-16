<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Assignments — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .assignment-card {
      background: var(--bg-secondary);
      border: 1px solid var(--border-color);
      border-radius: var(--radius-xl);
      padding: 20px;
      transition: all .2s;
      position: relative;
      overflow: hidden;
    }
    .assignment-card::before {
      content: '';
      position: absolute;
      left: 0; top: 0; bottom: 0;
      width: 4px;
      border-radius: 4px 0 0 4px;
    }
    .assignment-card.status-pending::before { background: #f59e0b; }
    .assignment-card.status-submitted::before { background: #10b981; }
    .assignment-card.status-overdue::before { background: #ef4444; }
    .assignment-card.status-graded::before { background: #6366f1; }
    .assignment-card:hover { border-color: var(--accent-primary); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.15); }
    .assignment-meta { display: flex; gap: 16px; flex-wrap: wrap; margin: 10px 0; font-size: var(--font-size-sm); color: var(--text-muted); }
    .assignment-meta span { display: flex; align-items: center; gap: 4px; }
    .due-soon { color: #f59e0b; font-weight: 600; }
    .due-overdue { color: #ef4444; font-weight: 600; }
    .filter-tabs { display: flex; gap: 6px; flex-wrap: wrap; }
    .filter-tab {
      padding: 6px 16px;
      border-radius: var(--radius-lg);
      border: 1px solid var(--border-color);
      background: transparent;
      color: var(--text-secondary);
      font-size: var(--font-size-sm);
      cursor: pointer;
      transition: all .2s;
    }
    .filter-tab.active, .filter-tab:hover { background: var(--accent-primary); color: #fff; border-color: var(--accent-primary); }
    .submission-modal {
      position: fixed; inset: 0; background: rgba(0,0,0,0.6);
      display: flex; align-items: center; justify-content: center;
      z-index: 1000; backdrop-filter: blur(4px);
    }
    .submission-modal.hidden { display: none; }
    .submission-modal-content {
      background: var(--bg-card); border: 1px solid var(--border-color);
      border-radius: var(--radius-xl); padding: 28px;
      width: 100%; max-width: 520px; max-height: 90vh; overflow-y: auto;
    }
    .submission-modal-content h3 { margin-bottom: 16px; }
    .score-display { display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: var(--radius-lg); background: rgba(99,102,241,0.1); color: #6366f1; font-weight: 700; }
  </style>
</head>
<body>
<div class="app-shell">

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
      <a href="index" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>
      <a href="profile" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/></svg>
        My Profile
      </a>

      <div class="nav-section-label">Academic Records</div>
      <a href="results" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4M7.5 8h9M7.5 16h9"/></svg>
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
      <a href="assignments" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        My Assignments
      </a>
      <a href="announcements" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
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

    <header class="topbar">
      <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <div>
          <div class="page-title">My Assignments</div>
          <div class="page-breadcrumb">Tasks & Memos / <span>Assignments</span></div>
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

    <div class="page-content">

      <!-- Stats -->
      <div class="stats-grid stats-grid-4 mb-6">
        <div class="stat-card" style="--stat-color:#6366f1;--stat-color-bg:rgba(99,102,241,0.12)">
          <div class="stat-icon">📋</div>
          <div class="stat-value" id="totalAssign">0</div>
          <div class="stat-label">Total Assignments</div>
        </div>
        <div class="stat-card" style="--stat-color:#f59e0b;--stat-color-bg:rgba(245,158,11,0.12)">
          <div class="stat-icon">⏳</div>
          <div class="stat-value" id="pendingAssign">0</div>
          <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card" style="--stat-color:#10b981;--stat-color-bg:rgba(16,185,129,0.12)">
          <div class="stat-icon">✅</div>
          <div class="stat-value" id="submittedAssign">0</div>
          <div class="stat-label">Submitted</div>
        </div>
        <div class="stat-card" style="--stat-color:#ef4444;--stat-color-bg:rgba(239,68,68,0.12)">
          <div class="stat-icon">🚫</div>
          <div class="stat-value" id="overdueAssign">0</div>
          <div class="stat-label">Overdue</div>
        </div>
      </div>

      <!-- Filters -->
      <div class="card mb-4" style="padding:16px 20px;">
        <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
          <div class="filter-tabs" id="filterTabs">
            <button class="filter-tab active" data-filter="all" onclick="filterAssignments(this, 'all')">All</button>
            <button class="filter-tab" data-filter="pending" onclick="filterAssignments(this, 'pending')">Pending</button>
            <button class="filter-tab" data-filter="submitted" onclick="filterAssignments(this, 'submitted')">Submitted</button>
            <button class="filter-tab" data-filter="graded" onclick="filterAssignments(this, 'graded')">Graded</button>
            <button class="filter-tab" data-filter="overdue" onclick="filterAssignments(this, 'overdue')">Overdue</button>
          </div>
          <div style="margin-left:auto;">
            <input type="text" class="input" id="searchInput" placeholder="Search assignments..." style="width:220px;" oninput="renderList()">
          </div>
        </div>
      </div>

      <!-- Assignment Cards -->
      <div id="assignmentGrid" style="display:grid;gap:14px;"></div>

    </div>
  </main>
</div>

<!-- Submit Modal -->
<div class="submission-modal hidden" id="submitModal">
  <div class="submission-modal-content">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
      <h3 id="modalTitle">Submit Assignment</h3>
      <button class="icon-btn" onclick="closeModal()">✕</button>
    </div>
    <div id="modalBody">
      <p id="modalDesc" style="color:var(--text-muted);font-size:var(--font-size-sm);margin-bottom:16px;"></p>
      <div class="form-group">
        <label class="form-label">Your Answer / Response</label>
        <textarea class="input" id="submissionText" rows="5" placeholder="Type your response here..."></textarea>
      </div>
      <div class="form-group">
        <label class="form-label">Attach File (simulated)</label>
        <input type="file" class="input" id="submissionFile">
        <div class="form-hint">File upload is simulated for demo purposes.</div>
      </div>
      <div style="display:flex;gap:10px;margin-top:16px;">
        <button class="btn btn-primary" onclick="submitAssignment()">Submit Assignment</button>
        <button class="btn btn-outline" onclick="closeModal()">Cancel</button>
      </div>
    </div>
    <div id="modalSuccess" class="hidden" style="text-align:center;padding:24px 0;">
      <div style="font-size:3rem;margin-bottom:12px;">🎉</div>
      <h4 style="margin-bottom:8px;">Assignment Submitted!</h4>
      <p style="color:var(--text-muted);font-size:var(--font-size-sm);">Your submission has been recorded. Your teacher will grade it soon.</p>
      <button class="btn btn-primary" style="margin-top:16px;" onclick="closeModal()">Close</button>
    </div>
  </div>
</div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('student');

  const now = new Date();
  const addDays = (d) => new Date(Date.now() + d * 86400000).toISOString().split('T')[0];

  const ASSIGNMENTS = [
    { id: 1, title: 'Algebra Problem Set 3', subject: 'Mathematics', icon: '📐', teacher: 'Mr. Okoro', due: addDays(3), status: 'pending', maxScore: 40, desc: 'Solve the following 10 quadratic equations. Show all workings clearly.' },
    { id: 2, title: 'Essay: Democracy in Nigeria', subject: 'Social Studies', icon: '🌍', teacher: 'Mrs. Adeleke', due: addDays(-2), status: 'overdue', maxScore: 30, desc: 'Write a 500-word essay on the history of democracy in Nigeria.' },
    { id: 3, title: 'Lab Report: Photosynthesis', subject: 'Basic Science', icon: '🔬', teacher: 'Mr. Bello', due: addDays(7), status: 'submitted', submittedAt: addDays(-1), maxScore: 50, desc: 'Write a full lab report on the photosynthesis experiment conducted in class.' },
    { id: 4, title: 'Computer Algorithms Quiz', subject: 'Computer Studies', icon: '💻', teacher: 'Miss Chioma', due: addDays(1), status: 'pending', maxScore: 20, desc: 'Answer all 10 questions on sorting and searching algorithms.' },
    { id: 5, title: 'Book Review: Things Fall Apart', subject: 'English Language', icon: '📝', teacher: 'Mrs. Thompson', due: addDays(-5), status: 'graded', score: 27, maxScore: 30, feedback: 'Great analysis! Your literary criticism is excellent. Work on sentence variety.', desc: 'Write a 300-word review of the novel Things Fall Apart by Chinua Achebe.' },
    { id: 6, title: 'Farm Tools Identification', subject: 'Agricultural Science', icon: '🌾', teacher: 'Mr. Fagbemi', due: addDays(10), status: 'pending', maxScore: 25, desc: 'Identify and describe the uses of 15 common farm tools from the list provided.' },
  ];

  let currentFilter = 'all';
  let currentAssignId = null;

  function filterAssignments(btn, filter) {
    document.querySelectorAll('.filter-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    currentFilter = filter;
    renderList();
  }

  function renderList() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    let filtered = ASSIGNMENTS.filter(a => {
      const matchFilter = currentFilter === 'all' || a.status === currentFilter;
      const matchSearch = a.title.toLowerCase().includes(query) || a.subject.toLowerCase().includes(query);
      return matchFilter && matchSearch;
    });

    const grid = document.getElementById('assignmentGrid');
    if (filtered.length === 0) {
      grid.innerHTML = `<div class="empty-state" style="padding:48px;text-align:center;"><div style="font-size:2.5rem;margin-bottom:12px;">📋</div><p style="color:var(--text-muted);">No assignments found.</p></div>`;
      return;
    }

    grid.innerHTML = filtered.map(a => {
      const dueDate = new Date(a.due);
      const daysLeft = Math.round((dueDate - now) / 86400000);
      let dueLabel = `Due ${Format.date(a.due)}`;
      let dueClass = '';
      if (a.status === 'overdue') { dueLabel = `Overdue — ${Format.date(a.due)}`; dueClass = 'due-overdue'; }
      else if (daysLeft <= 2 && daysLeft >= 0) { dueLabel += ` (${daysLeft === 0 ? 'today' : daysLeft + 'd left'})`; dueClass = 'due-soon'; }

      let actionBtn = '';
      if (a.status === 'pending') {
        actionBtn = `<button class="btn btn-sm btn-primary" onclick="openSubmitModal(${a.id})">Submit Assignment</button>`;
      } else if (a.status === 'overdue') {
        actionBtn = `<button class="btn btn-sm" style="background:#ef444418;color:#ef4444;border-color:#ef4444;" onclick="openSubmitModal(${a.id})">Submit Late</button>`;
      } else if (a.status === 'submitted') {
        actionBtn = `<span style="color:#10b981;font-size:var(--font-size-sm);font-weight:500;">✓ Submitted — Awaiting Grade</span>`;
      } else if (a.status === 'graded') {
        actionBtn = `<div class="score-display">⭐ ${a.score}/${a.maxScore}</div>`;
      }

      const feedbackSection = a.status === 'graded' && a.feedback
        ? `<div style="background:rgba(99,102,241,0.08);border-left:3px solid #6366f1;padding:10px 14px;border-radius:0 8px 8px 0;margin-top:12px;font-size:var(--font-size-sm);color:var(--text-secondary);">
            <strong>Teacher Feedback:</strong> ${a.feedback}
           </div>`
        : '';

      return `
        <div class="assignment-card status-${a.status}">
          <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;flex-wrap:wrap;">
            <div style="display:flex;align-items:flex-start;gap:14px;flex:1;">
              <div style="font-size:2rem;flex-shrink:0;">${a.icon}</div>
              <div style="flex:1;">
                <div style="font-weight:600;font-size:var(--font-size-base);margin-bottom:4px;">${a.title}</div>
                <div class="assignment-meta">
                  <span>📚 ${a.subject}</span>
                  <span>👤 ${a.teacher}</span>
                  <span class="${dueClass}">🗓 ${dueLabel}</span>
                  <span>📊 Max: ${a.maxScore} marks</span>
                </div>
                <p style="font-size:var(--font-size-sm);color:var(--text-muted);margin:0;">${a.desc}</p>
                ${feedbackSection}
              </div>
            </div>
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:10px;flex-shrink:0;">
              ${Format.badge(a.status)}
              ${actionBtn}
            </div>
          </div>
        </div>
      `;
    }).join('');

    // Update stats
    document.getElementById('totalAssign').textContent = ASSIGNMENTS.length;
    document.getElementById('pendingAssign').textContent = ASSIGNMENTS.filter(a => a.status === 'pending').length;
    document.getElementById('submittedAssign').textContent = ASSIGNMENTS.filter(a => a.status === 'submitted' || a.status === 'graded').length;
    document.getElementById('overdueAssign').textContent = ASSIGNMENTS.filter(a => a.status === 'overdue').length;
  }

  function openSubmitModal(id) {
    const a = ASSIGNMENTS.find(x => x.id === id);
    if (!a) return;
    currentAssignId = id;
    document.getElementById('modalTitle').textContent = `Submit: ${a.title}`;
    document.getElementById('modalDesc').textContent = a.desc;
    document.getElementById('submissionText').value = '';
    document.getElementById('modalBody').classList.remove('hidden');
    document.getElementById('modalSuccess').classList.add('hidden');
    document.getElementById('submitModal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('submitModal').classList.add('hidden');
    currentAssignId = null;
  }

  function submitAssignment() {
    const text = document.getElementById('submissionText').value.trim();
    if (!text) { alert('Please enter your submission text.'); return; }
    const a = ASSIGNMENTS.find(x => x.id === currentAssignId);
    if (a) {
      a.status = 'submitted';
      a.submittedAt = new Date().toISOString().split('T')[0];
    }
    document.getElementById('modalBody').classList.add('hidden');
    document.getElementById('modalSuccess').classList.remove('hidden');
    renderList();
  }

  document.addEventListener('DOMContentLoaded', renderList);
</script>
</body>
</html>
