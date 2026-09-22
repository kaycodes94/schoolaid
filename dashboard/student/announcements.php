<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Announcements — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .announcement-item {
      background: var(--bg-secondary);
      border: 1px solid var(--border-color);
      border-radius: var(--radius-xl);
      padding: 22px;
      transition: all .2s;
      cursor: pointer;
      position: relative;
    }
    .announcement-item:hover { border-color: var(--accent-primary); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0,0,0,0.12); }
    .announcement-item.unread { border-left: 4px solid var(--accent-primary); }
    .announcement-item.unread::after {
      content: '';
      position: absolute;
      top: 18px; right: 18px;
      width: 8px; height: 8px;
      border-radius: 50%;
      background: var(--accent-primary);
    }
    .announcement-header { display: flex; align-items: flex-start; gap: 14px; }
    .announcement-icon { width: 44px; height: 44px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
    .announcement-body { flex: 1; }
    .announcement-title { font-weight: 600; font-size: var(--font-size-base); margin-bottom: 4px; }
    .announcement-meta { font-size: var(--font-size-xs); color: var(--text-muted); display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 10px; }
    .announcement-preview { font-size: var(--font-size-sm); color: var(--text-muted); line-height: 1.6; }
    .announcement-full { display: none; font-size: var(--font-size-sm); color: var(--text-secondary); line-height: 1.7; margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--border-color); }
    .announcement-item.expanded .announcement-full { display: block; }
    .announcement-item.expanded .announcement-preview { display: none; }
    .priority-high { background: rgba(239,68,68,0.12); color: #ef4444; }
    .priority-medium { background: rgba(245,158,11,0.12); color: #f59e0b; }
    .priority-low { background: rgba(30,58,138,0.15); color: #1e3a8a; }
    .category-tabs { display: flex; gap: 6px; flex-wrap: wrap; }
    .cat-tab {
      padding: 6px 16px; border-radius: var(--radius-lg);
      border: 1px solid var(--border-color); background: transparent;
      color: var(--text-secondary); font-size: var(--font-size-sm); cursor: pointer; transition: all .2s;
    }
    .cat-tab.active, .cat-tab:hover { background: var(--accent-primary); color: #fff; border-color: var(--accent-primary); }
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
      <a href="assignments" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        My Assignments
      </a>
      <a href="announcements" class="nav-item active">
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
          <div class="page-title">Announcements</div>
          <div class="page-breadcrumb">Tasks & Memos / <span>Announcements</span></div>
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

      <!-- Header + filter row -->
      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div class="category-tabs" id="categoryTabs">
          <button class="cat-tab active" data-cat="all" onclick="filterCat(this,'all')">All</button>
          <button class="cat-tab" data-cat="general" onclick="filterCat(this,'general')">General</button>
          <button class="cat-tab" data-cat="exam" onclick="filterCat(this,'exam')">Exams</button>
          <button class="cat-tab" data-cat="event" onclick="filterCat(this,'event')">Events</button>
          <button class="cat-tab" data-cat="urgent" onclick="filterCat(this,'urgent')">Urgent</button>
        </div>
        <button class="btn btn-sm btn-outline" onclick="markAllRead()">Mark All as Read</button>
      </div>

      <!-- List -->
      <div id="announcementList" style="display:flex;flex-direction:column;gap:12px;"></div>

    </div>
  </main>
</div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('student');

  const addDays = d => new Date(Date.now() + d*86400000).toISOString().replace('T',' ').slice(0,16);

  const ANNOUNCEMENTS = [
    {
      id: 1, category: 'exam', priority: 'high', icon: '📝', unread: true,
      title: '1st Term Examination Timetable Released',
      from: 'Principal / Admin', date: addDays(-1),
      preview: 'The examination timetable for the 1st term has been released. All students are expected to review…',
      full: `The examination timetable for the 1st term 2025/2026 has been officially released. Examinations begin on <strong>Monday, 23rd June 2026</strong> and end on <strong>Friday, 4th July 2026</strong>.\n\nAll students are expected to report to school by 7:30 AM on examination days. Latecomers will not be allowed to write the exam. Please check the printed copies on the school notice board or ask your class teacher for your copy.\n\n<strong>Important:</strong> Any student caught cheating will be disqualified from the examination and may face suspension.`
    },
    {
      id: 2, category: 'general', priority: 'medium', icon: '📢', unread: true,
      title: 'School Fees Reminder — 2nd Installment Due',
      from: 'Bursar / Accounts', date: addDays(-2),
      preview: 'This is a reminder that the 2nd installment of school fees is due by the end of this month…',
      full: `Dear Parents and Students,\n\nThis is a formal reminder that the <strong>2nd installment of school fees</strong> for the 2025/2026 academic session is due by the <strong>30th June 2026</strong>.\n\nStudents who have not completed their fee payment may not be allowed to write the end-of-term examinations. Please proceed to the school bursary for payment.\n\nFor inquiries, contact the school accounts office.`
    },
    {
      id: 3, category: 'event', priority: 'low', icon: '🎤', unread: false,
      title: 'Annual Cultural Day — Dress Code Notice',
      from: 'Student Affairs', date: addDays(-4),
      preview: 'In preparation for our Annual Cultural Day on July 12th, students are reminded to come dressed…',
      full: `In preparation for our <strong>Annual Cultural Day</strong> scheduled for <strong>Saturday, 12th July 2026</strong>, all students are hereby reminded to come dressed in their traditional cultural attire.\n\nEach class should prepare at least one cultural dance or drama presentation. The class with the best performance wins the Cultural Excellence Trophy.\n\nParents are also invited to attend. The event begins at 9:00 AM.`
    },
    {
      id: 4, category: 'urgent', priority: 'high', icon: '🚨', unread: true,
      title: 'Emergency: School Closed Tomorrow',
      from: 'School Administration', date: addDays(0),
      preview: 'Due to a scheduled power infrastructure project in the school vicinity, school will be closed…',
      full: `<strong>URGENT NOTICE:</strong>\n\nDue to an emergency power infrastructure upgrade project scheduled in the school vicinity, school activities will be <strong>suspended tomorrow, 10th June 2026</strong>.\n\nAll students should stay at home. Teachers have been asked to send assignments via the school platform.\n\nNormal school activities will resume on <strong>Thursday, 11th June 2026</strong>. We apologize for any inconvenience caused.`
    },
    {
      id: 5, category: 'general', priority: 'low', icon: '📚', unread: false,
      title: 'New Library Books Available for Borrowing',
      from: 'Library Department', date: addDays(-7),
      preview: 'The school library has received a new collection of textbooks and storybooks. Students in JSS1…',
      full: `The school library is pleased to announce the arrival of <strong>250 new books</strong> covering various subjects and general reading materials.\n\nStudents from all classes are welcome to borrow books during library periods. Each student may borrow up to 2 books at a time for a period of 2 weeks.\n\nBooks available include Mathematics textbooks, English readers, Science encyclopaedias, and African literature collections.\n\nVisit the library to register if you haven't already.`
    },
    {
      id: 6, category: 'exam', priority: 'medium', icon: '🎯', unread: false,
      title: 'Mock Exam Results — Top Performers',
      from: 'Examinations Officer', date: addDays(-10),
      preview: 'Results from the recent mock examinations are ready. Top performers in each class will be…',
      full: `Mock examination results have been compiled. Top performers across all classes will be recognized at the upcoming assembly.\n\nResultslips will be distributed to class teachers by end of week. Students who performed below 50% average are encouraged to visit the Academic Support Unit for extra coaching sessions available every Wednesday and Friday after school.`
    },
  ];

  let currentCat = 'all';
  const readSet = new Set();

  function filterCat(btn, cat) {
    document.querySelectorAll('.cat-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    currentCat = cat;
    renderList();
  }

  function markAllRead() {
    ANNOUNCEMENTS.forEach(a => { a.unread = false; readSet.add(a.id); });
    renderList();
  }

  function toggleItem(id) {
    const el = document.getElementById(`ann-${id}`);
    el.classList.toggle('expanded');
    const a = ANNOUNCEMENTS.find(x => x.id === id);
    if (a) { a.unread = false; el.classList.remove('unread'); }
  }

  function renderList() {
    const filtered = currentCat === 'all' ? ANNOUNCEMENTS : ANNOUNCEMENTS.filter(a => a.category === currentCat);
    const list = document.getElementById('announcementList');
    if (filtered.length === 0) {
      list.innerHTML = `<div style="text-align:center;padding:60px;color:var(--text-muted);">No announcements in this category.</div>`;
      return;
    }

    const priorityBg = { high: 'priority-high', medium: 'priority-medium', low: 'priority-low' };
    const catColors = { exam: '#6366f1', event: '#1e3a8a', urgent: '#ef4444', general: '#3b82f6' };
    const catBg = { exam: 'rgba(99,102,241,0.12)', event: 'rgba(30,58,138,0.15)', urgent: 'rgba(239,68,68,0.12)', general: 'rgba(59,130,246,0.12)' };

    list.innerHTML = filtered.map(a => `
      <div class="announcement-item ${a.unread ? 'unread' : ''}" id="ann-${a.id}" onclick="toggleItem(${a.id})">
        <div class="announcement-header">
          <div class="announcement-icon" style="background:${catBg[a.category]||'rgba(99,102,241,0.12)'};color:${catColors[a.category]||'#6366f1'};">
            ${a.icon}
          </div>
          <div class="announcement-body">
            <div class="announcement-title">${a.title}</div>
            <div class="announcement-meta">
              <span>👤 ${a.from}</span>
              <span>🕐 ${a.date}</span>
              <span class="badge badge-sm ${priorityBg[a.priority]}" style="padding:2px 8px;border-radius:20px;font-size:10px;text-transform:uppercase;font-weight:700;">${a.priority} priority</span>
            </div>
            <div class="announcement-preview">${a.preview}</div>
            <div class="announcement-full">${a.full.replace(/\n/g,'<br>')}</div>
          </div>
          <div style="font-size:var(--font-size-xs);color:var(--text-muted);white-space:nowrap;flex-shrink:0;">
            Click to expand ↓
          </div>
        </div>
      </div>
    `).join('');
  }

  document.addEventListener('DOMContentLoaded', renderList);
</script>
</body>
</html>
