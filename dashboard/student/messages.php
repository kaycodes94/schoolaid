<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Messages — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .msg-layout { display: grid; grid-template-columns: 300px 1fr; gap: 0; height: calc(100vh - 130px); min-height: 500px; overflow: hidden; border: 1px solid var(--border-color); border-radius: var(--radius-xl); }
    .msg-sidebar { border-right: 1px solid var(--border-color); display: flex; flex-direction: column; background: var(--bg-card); overflow: hidden; }
    .msg-sidebar-header { padding: 16px; border-bottom: 1px solid var(--border-color); }
    .msg-sidebar-header input { width: 100%; }
    .msg-list { overflow-y: auto; flex: 1; }
    .msg-thread-item { padding: 14px 16px; cursor: pointer; transition: background .15s; border-bottom: 1px solid var(--border-color); }
    .msg-thread-item:hover { background: var(--bg-secondary); }
    .msg-thread-item.active { background: rgba(99,102,241,0.08); border-left: 3px solid var(--accent-primary); }
    .msg-thread-item.unread .thread-name { font-weight: 700; }
    .msg-thread-item.unread .thread-preview { color: var(--text-secondary); }
    .thread-name { font-size: var(--font-size-sm); font-weight: 500; margin-bottom: 3px; display: flex; align-items: center; gap: 6px; }
    .thread-preview { font-size: var(--font-size-xs); color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .thread-time { font-size: 10px; color: var(--text-muted); margin-bottom: 4px; float: right; }
    .unread-badge { width: 8px; height: 8px; border-radius: 50%; background: var(--accent-primary); flex-shrink: 0; }
    /* Chat panel */
    .chat-panel { display: flex; flex-direction: column; background: var(--bg-secondary); }
    .chat-header { padding: 14px 20px; border-bottom: 1px solid var(--border-color); background: var(--bg-card); display: flex; align-items: center; gap: 14px; }
    .chat-messages { flex: 1; overflow-y: auto; padding: 16px; display: flex; flex-direction: column; gap: 12px; }
    .chat-bubble { max-width: 68%; padding: 12px 16px; border-radius: 18px; font-size: var(--font-size-sm); line-height: 1.55; position: relative; }
    .chat-bubble.from-teacher { background: var(--bg-card); border: 1px solid var(--border-color); align-self: flex-start; border-bottom-left-radius: 4px; }
    .chat-bubble.from-me { background: var(--accent-primary); color: #fff; align-self: flex-end; border-bottom-right-radius: 4px; }
    .bubble-time { font-size: 10px; opacity: 0.65; margin-top: 4px; }
    .chat-input-area { padding: 14px 16px; border-top: 1px solid var(--border-color); background: var(--bg-card); display: flex; gap: 10px; align-items: flex-end; }
    .chat-input-area textarea { flex: 1; resize: none; border-radius: var(--radius-lg); min-height: 40px; max-height: 120px; font-size: var(--font-size-sm); padding: 10px 14px; }
    .no-thread { flex: 1; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 12px; color: var(--text-muted); }
    @media (max-width: 640px) {
      .msg-layout { grid-template-columns: 1fr; }
      .msg-sidebar { display: none; }
      .msg-sidebar.show-mobile { display: flex; }
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
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        Announcements
      </a>
      <a href="messages" class="nav-item active">
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
          <div class="page-title">Teacher Messages</div>
          <div class="page-breadcrumb">Tasks & Memos / <span>Messages</span></div>
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
      <div class="msg-layout">

        <!-- Thread List Sidebar -->
        <div class="msg-sidebar">
          <div class="msg-sidebar-header">
            <input class="input" type="text" id="msgSearch" placeholder="Search conversations…" oninput="filterThreads()">
          </div>
          <div class="msg-list" id="msgList"></div>
        </div>

        <!-- Chat Panel -->
        <div class="chat-panel" id="chatPanel">
          <div class="no-thread" id="noThread">
            <div style="font-size:2.5rem;">💬</div>
            <p>Select a conversation to view messages.</p>
          </div>

          <div id="activeChat" style="display:none;flex-direction:column;height:100%;">
            <div class="chat-header" id="chatHeader"></div>
            <div class="chat-messages" id="chatMessages"></div>
            <div class="chat-input-area">
              <textarea class="input" id="chatInput" placeholder="Type a message…" rows="1" onkeydown="handleKey(event)"></textarea>
              <button class="btn btn-primary" onclick="sendMessage()" style="flex-shrink:0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                Send
              </button>
            </div>
          </div>
        </div>

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

  const fmt = (d) => new Date(d).toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
  const fmtDate = (d) => new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'short' });

  const THREADS = [
    {
      id: 1, name: 'Mrs. Thompson', role: 'English Teacher', initials: 'MT', color: '#3b82f6',
      unread: true,
      messages: [
        { from: 'teacher', text: 'Hello John, I noticed you missed the essay submission deadline. Is everything okay?', time: new Date(Date.now() - 86400000*2).toISOString() },
        { from: 'me', text: 'Good morning Ma. I'm sorry, I had a family emergency. I will submit it first thing tomorrow.', time: new Date(Date.now() - 86400000*2 + 600000).toISOString() },
        { from: 'teacher', text: 'No problem at all. Please submit before Friday and I will still mark it. Take care!', time: new Date(Date.now() - 86400000).toISOString() },
        { from: 'me', text: 'Thank you so much Ma! I appreciate it.', time: new Date(Date.now() - 86400000 + 300000).toISOString() },
        { from: 'teacher', text: 'You're welcome. I also wanted to commend you for your excellent performance in the last test. Keep it up!', time: new Date(Date.now() - 3600000).toISOString() },
      ]
    },
    {
      id: 2, name: 'Mr. Okoro', role: 'Mathematics Teacher', initials: 'MO', color: '#6366f1',
      unread: true,
      messages: [
        { from: 'teacher', text: 'John, you scored 36/40 in the CA test. Very impressive! Do you have any questions on the topics we covered?', time: new Date(Date.now() - 86400000*3).toISOString() },
        { from: 'me', text: 'Good morning Sir. Thank you! I am a bit confused about simultaneous equations. Could you explain further?', time: new Date(Date.now() - 86400000*3 + 1800000).toISOString() },
        { from: 'teacher', text: 'Sure! Simultaneous equations can be solved using elimination or substitution. I'll share worked examples with the class tomorrow.', time: new Date(Date.now() - 86400000*2).toISOString() },
      ]
    },
    {
      id: 3, name: 'Mr. Bello', role: 'Basic Science Teacher', initials: 'MB', color: '#1e3a8a',
      unread: false,
      messages: [
        { from: 'teacher', text: 'Hi John, your lab report was well-written. I gave you 45/50. Minor deductions for the conclusion section.', time: new Date(Date.now() - 86400000*5).toISOString() },
        { from: 'me', text: 'Thank you Sir! What should I improve in the conclusion?', time: new Date(Date.now() - 86400000*5 + 900000).toISOString() },
        { from: 'teacher', text: 'Your conclusion needs to summarize the findings more clearly and link back to the hypothesis. Practice this format.', time: new Date(Date.now() - 86400000*4).toISOString() },
        { from: 'me', text: 'Understood Sir. I will work on that for my next report. Thank you!', time: new Date(Date.now() - 86400000*4 + 600000).toISOString() },
      ]
    },
    {
      id: 4, name: 'Miss Chioma', role: 'Computer Studies Teacher', initials: 'MC', color: '#14b8a6',
      unread: false,
      messages: [
        { from: 'teacher', text: 'John, the Computer Studies quiz is on Friday. Please revise sorting algorithms, binary search, and basic HTML.', time: new Date(Date.now() - 86400000*1).toISOString() },
        { from: 'me', text: 'Thank you for the reminder Miss. I will revise tonight.', time: new Date(Date.now() - 86400000 + 1200000).toISOString() },
      ]
    },
  ];

  let activeThreadId = null;

  function renderThreadList(filter = '') {
    const list = document.getElementById('msgList');
    const threads = filter
      ? THREADS.filter(t => t.name.toLowerCase().includes(filter.toLowerCase()) || t.role.toLowerCase().includes(filter.toLowerCase()))
      : THREADS;

    list.innerHTML = threads.map(t => {
      const lastMsg = t.messages[t.messages.length - 1];
      return `
        <div class="msg-thread-item ${t.unread ? 'unread' : ''} ${t.id === activeThreadId ? 'active' : ''}" onclick="openThread(${t.id})">
          <div style="display:flex;align-items:flex-start;gap:10px;">
            <div class="avatar" style="background:${t.color}22;color:${t.color};font-size:0.7rem;flex-shrink:0;">${t.initials}</div>
            <div style="flex:1;min-width:0;">
              <div class="thread-name">
                ${t.name}
                ${t.unread ? '<span class="unread-badge"></span>' : ''}
                <span style="margin-left:auto;font-size:10px;font-weight:400;color:var(--text-muted);">${fmtDate(lastMsg.time)}</span>
              </div>
              <div style="font-size:10px;color:var(--text-muted);margin-bottom:3px;">${t.role}</div>
              <div class="thread-preview">${lastMsg.from === 'me' ? 'You: ' : ''}${lastMsg.text}</div>
            </div>
          </div>
        </div>`;
    }).join('');
  }

  function openThread(id) {
    activeThreadId = id;
    const thread = THREADS.find(t => t.id === id);
    if (!thread) return;
    thread.unread = false;
    renderThreadList(document.getElementById('msgSearch').value);

    document.getElementById('noThread').style.display = 'none';
    const activeChat = document.getElementById('activeChat');
    activeChat.style.display = 'flex';

    document.getElementById('chatHeader').innerHTML = `
      <div class="avatar" style="background:${thread.color}22;color:${thread.color};">${thread.initials}</div>
      <div>
        <div style="font-weight:600;">${thread.name}</div>
        <div style="font-size:var(--font-size-xs);color:var(--text-muted);">${thread.role} · Online</div>
      </div>`;

    renderMessages(thread);
  }

  function renderMessages(thread) {
    const container = document.getElementById('chatMessages');
    container.innerHTML = thread.messages.map(m => `
      <div class="chat-bubble ${m.from === 'me' ? 'from-me' : 'from-teacher'}">
        ${m.text}
        <div class="bubble-time">${fmt(m.time)}</div>
      </div>
    `).join('');
    container.scrollTop = container.scrollHeight;
  }

  function sendMessage() {
    const input = document.getElementById('chatInput');
    const text = input.value.trim();
    if (!text || !activeThreadId) return;
    const thread = THREADS.find(t => t.id === activeThreadId);
    if (!thread) return;
    thread.messages.push({ from: 'me', text, time: new Date().toISOString() });
    input.value = '';
    renderMessages(thread);
    renderThreadList(document.getElementById('msgSearch').value);

    // Simulate reply after 1.5s
    setTimeout(() => {
      const replies = [
        'Thank you for letting me know!',
        'Got it. Please make sure to review the topics before class.',
        'Well done! Keep up the hard work.',
        'Noted. I will follow up with you tomorrow.',
        'Sure thing! Feel free to ask if you need more help.'
      ];
      thread.messages.push({ from: 'teacher', text: replies[Math.floor(Math.random() * replies.length)], time: new Date().toISOString() });
      renderMessages(thread);
      renderThreadList(document.getElementById('msgSearch').value);
    }, 1500);
  }

  function handleKey(e) {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
  }

  function filterThreads() {
    renderThreadList(document.getElementById('msgSearch').value);
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderThreadList();
    openThread(1); // open first thread by default
  });
</script>
</body>
</html>
