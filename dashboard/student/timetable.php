<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Class Timetable — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .timetable-grid {
      display: grid;
      grid-template-columns: 90px repeat(5, 1fr);
      gap: 6px;
      overflow-x: auto;
    }
    .tt-header {
      padding: 10px 8px;
      border-radius: var(--radius-md);
      font-weight: 600;
      font-size: var(--font-size-sm);
      text-align: center;
    }
    .tt-time {
      padding: 8px;
      border-radius: var(--radius-md);
      font-size: var(--font-size-xs);
      font-weight: 500;
      color: var(--text-muted);
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      background: var(--bg-secondary);
      border: 1px solid var(--border-color);
    }
    .tt-cell {
      padding: 12px 10px;
      border-radius: var(--radius-md);
      min-height: 70px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      transition: transform .15s;
      cursor: default;
    }
    .tt-cell:hover { transform: scale(1.02); }
    .tt-cell.empty { background: var(--bg-secondary); border: 1px dashed var(--border-color); }
    .tt-cell.break { background: rgba(148,163,184,0.08); border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; }
    .tt-subject { font-weight: 600; font-size: var(--font-size-sm); margin-bottom: 3px; }
    .tt-teacher { font-size: 10px; color: inherit; opacity: 0.75; }
    .tt-room { font-size: 10px; opacity: 0.65; margin-top: 2px; }
    .day-today { box-shadow: 0 0 0 2px var(--accent-primary); }
    .legend-dot { width: 12px; height: 12px; border-radius: 3px; display: inline-block; margin-right: 6px; }
    .today-marker {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 4px 12px; border-radius: var(--radius-lg);
      background: rgba(99,102,241,0.12); color: var(--accent-primary);
      font-size: var(--font-size-xs); font-weight: 600;
    }
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
      <a href="timetable" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Class Timetable
      </a>

      <div class="nav-section-label">Tasks & Memos</div>
      <a href="assignments" class="nav-item">
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
          <div class="page-title">Class Timetable</div>
          <div class="page-breadcrumb">Academic Records / <span>Timetable</span></div>
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

      <!-- Meta row -->
      <div class="card mb-6" style="padding:16px 20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
          <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
            <div>
              <div style="font-size:var(--font-size-xs);color:var(--text-muted);">Class</div>
              <div style="font-weight:700;">JSS 3A</div>
            </div>
            <div>
              <div style="font-size:var(--font-size-xs);color:var(--text-muted);">Form Teacher</div>
              <div style="font-weight:700;">Mrs. Thompson</div>
            </div>
            <div>
              <div style="font-size:var(--font-size-xs);color:var(--text-muted);">Total Subjects</div>
              <div style="font-weight:700;">8</div>
            </div>
            <span class="today-marker">📅 Today is <span id="todayName"></span></span>
          </div>
          <button class="btn btn-sm btn-outline" onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Print Timetable
          </button>
        </div>
      </div>

      <!-- Timetable -->
      <div class="card mb-6">
        <div class="card-header"><h3 class="card-title">Weekly Timetable — JSS 3A</h3></div>
        <div style="padding:16px;overflow-x:auto;">
          <div class="timetable-grid" id="timetableGrid">
            <!-- Rendered by JS -->
          </div>
        </div>
      </div>

      <!-- Subject Legend -->
      <div class="card">
        <div class="card-header"><h3 class="card-title">Subject Colour Legend</h3></div>
        <div style="padding:16px 20px;display:flex;flex-wrap:wrap;gap:16px;" id="legendGrid"></div>
      </div>

    </div>
  </main>
</div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('student');

  const SUBJECTS = {
    math:    { name: 'Mathematics',      teacher: 'Mr. Okoro',    room: 'Room 12', color: '#6366f1', bg: 'rgba(99,102,241,0.14)' },
    eng:     { name: 'English Language', teacher: 'Mrs. Thompson', room: 'Room 12', color: '#3b82f6', bg: 'rgba(59,130,246,0.14)' },
    sci:     { name: 'Basic Science',    teacher: 'Mr. Bello',    room: 'Lab 1',   color: '#10b981', bg: 'rgba(16,185,129,0.14)' },
    soc:     { name: 'Social Studies',   teacher: 'Mrs. Adeleke', room: 'Room 12', color: '#f59e0b', bg: 'rgba(245,158,11,0.14)'  },
    civic:   { name: 'Civic Education',  teacher: 'Mr. Danladi',  room: 'Room 12', color: '#8b5cf6', bg: 'rgba(139,92,246,0.14)'  },
    biz:     { name: 'Business Studies', teacher: 'Miss Eze',     room: 'Room 8',  color: '#ec4899', bg: 'rgba(236,72,153,0.14)'  },
    comp:    { name: 'Computer Studies', teacher: 'Miss Chioma',  room: 'Lab 2',   color: '#14b8a6', bg: 'rgba(20,184,166,0.14)'  },
    agric:   { name: 'Agric. Science',   teacher: 'Mr. Fagbemi',  room: 'Room 15', color: '#84cc16', bg: 'rgba(132,204,22,0.14)'  },
    break:   { name: 'Break',            teacher: '', room: '', color: '#94a3b8', bg: 'rgba(148,163,184,0.06)' },
  };

  // [period][day: Mon,Tue,Wed,Thu,Fri]
  const PERIODS = [
    { time: '7:30–8:30',  row: [null, 'eng',  'math', 'sci',  'soc']   },
    { time: '8:30–9:30',  row: ['math', null, 'eng',  'comp', 'civic']  },
    { time: '9:30–10:30', row: ['sci', 'soc', null,   'math', 'eng']    },
    { time: '10:30–11:00',row: ['break','break','break','break','break'] },
    { time: '11:00–12:00',row: ['civic','math','agric','eng',  'sci']   },
    { time: '12:00–13:00',row: ['biz',  'comp','soc',  'agric','math']  },
    { time: '13:00–13:30',row: ['break','break','break','break','break'] },
    { time: '13:30–14:30',row: ['comp', 'agric','biz', 'civic','biz']   },
    { time: '14:30–15:00',row: ['eng',  'civic','comp','biz',  'agric'] },
  ];

  const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
  const todayIdx = new Date().getDay() - 1; // 0=Mon … 4=Fri

  document.getElementById('todayName').textContent = todayIdx >= 0 && todayIdx < 5 ? DAYS[todayIdx] : 'Weekend';

  function renderTimetable() {
    const grid = document.getElementById('timetableGrid');

    // Header row
    let html = `<div class="tt-header" style="background:transparent;"></div>`;
    DAYS.forEach((d, i) => {
      const isToday = i === todayIdx;
      html += `<div class="tt-header" style="background:${isToday ? 'var(--accent-primary)' : 'var(--bg-secondary)'};color:${isToday ? '#fff' : 'var(--text-primary)'};border:1px solid ${isToday ? 'var(--accent-primary)' : 'var(--border-color)'};">${d}${isToday ? ' 📍' : ''}</div>`;
    });

    PERIODS.forEach(p => {
      html += `<div class="tt-time">${p.time}</div>`;
      p.row.forEach((code, i) => {
        const isToday = i === todayIdx;
        if (!code) {
          html += `<div class="tt-cell empty"></div>`;
          return;
        }
        const s = SUBJECTS[code];
        if (code === 'break') {
          html += `<div class="tt-cell break${isToday ? ' day-today' : ''}" style="background:${s.bg};"><span style="font-size:var(--font-size-xs);color:var(--text-muted);font-weight:600;">☕ Break</span></div>`;
          return;
        }
        html += `
          <div class="tt-cell${isToday ? ' day-today' : ''}" style="background:${s.bg};border:1px solid ${s.color}22;">
            <div class="tt-subject" style="color:${s.color};">${s.name}</div>
            <div class="tt-teacher" style="color:${s.color};">${s.teacher}</div>
            <div class="tt-room" style="color:${s.color};">${s.room}</div>
          </div>`;
      });
    });

    grid.innerHTML = html;
  }

  function renderLegend() {
    const leg = document.getElementById('legendGrid');
    leg.innerHTML = Object.entries(SUBJECTS)
      .filter(([k]) => k !== 'break')
      .map(([, s]) => `
        <div style="display:flex;align-items:center;gap:8px;">
          <span class="legend-dot" style="background:${s.bg};border:2px solid ${s.color};"></span>
          <span style="font-size:var(--font-size-sm);font-weight:500;">${s.name}</span>
          <span style="font-size:10px;color:var(--text-muted);">— ${s.teacher}</span>
        </div>`
      ).join('');
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderTimetable();
    renderLegend();
  });
</script>
</body>
</html>
