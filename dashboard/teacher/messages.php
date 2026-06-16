<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <style>
    .messages-shell {
      display: grid;
      grid-template-columns: 350px 1fr;
      gap: var(--space-6);
      background: var(--color-bg-surface);
      border: 1px solid var(--color-border);
      border-radius: var(--radius-xl);
      overflow: hidden;
      height: 600px;
    }
    .messages-list-pane {
      border-right: 1px solid var(--color-border);
      display: flex;
      flex-col: column;
      overflow-y: auto;
    }
    .message-item {
      padding: var(--space-4);
      border-bottom: 1px solid var(--color-border);
      cursor: pointer;
      transition: all var(--transition-normal);
    }
    .message-item:hover {
      background: var(--color-bg-elevated);
    }
    .message-item.active {
      background: rgba(99,102,241,0.06);
      border-left: 3px solid var(--color-accent);
    }
    .message-item.unread {
      font-weight: 600;
    }
    .message-view-pane {
      padding: var(--space-6);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      overflow-y: auto;
    }
    .message-header {
      border-bottom: 1px solid var(--color-border);
      padding-bottom: var(--space-4);
      margin-bottom: var(--space-4);
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
      <a href="results" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4M7.5 8h9M7.5 16h9M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        Enter Results
      </a>
      <a href="assignments" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Assignments
      </a>

      <div class="nav-section-label">Communication</div>
      <a href="messages" class="nav-item active">
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
          <div class="page-title">Messages</div>
          <div class="page-breadcrumb">Communication / <span>Inbox</span></div>
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

      <!-- Action buttons -->
      <div class="flex justify-between items-center mb-6">
        <div>
          <h2>Staff Mailbox</h2>
          <p class="text-secondary">Send internal memos to the Principal, Head Unit, or other school staff.</p>
        </div>
        <button class="btn btn-primary" onclick="Modal.open('composeModal')">✏️ Compose Message</button>
      </div>

      <!-- Messages Grid -->
      <div class="messages-shell">
        
        <!-- Left: Inbox List -->
        <div class="messages-list-pane flex flex-col" id="inboxList">
          <div class="empty-state"><div class="spinner"></div></div>
        </div>

        <!-- Right: Message Detail View -->
        <div class="message-view-pane" id="messageDetailView">
          <div class="empty-state" style="margin:auto;">
            <div style="font-size:3rem;margin-bottom:var(--space-4);">✉️</div>
            <h3>Select a Message</h3>
            <p class="text-muted text-xs">Click on any message in the inbox listing to view the message body contents.</p>
          </div>
        </div>

      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<!-- Compose Modal -->
<div class="modal-overlay" id="composeModal">
  <div class="modal" style="max-width:480px;">
    <div class="modal-header">
      <h3 class="modal-title">Compose Message</h3>
      <button class="modal-close" onclick="Modal.close('composeModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="composeForm" onsubmit="sendMessage(event)">
        <div class="form-group">
          <label class="form-label" for="msgRecipient">Recipient <span class="required">*</span></label>
          <select id="msgRecipient" class="form-control" required>
            <option value="1">Samuel Dung (Principal)</option>
            <option value="2">Amaka Uche (Head Unit)</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="msgSubject">Subject <span class="required">*</span></label>
          <input type="text" id="msgSubject" class="form-control" placeholder="Enter message subject..." required>
        </div>

        <div class="form-group">
          <label class="form-label" for="msgBody">Message Body <span class="required">*</span></label>
          <textarea id="msgBody" class="form-control" placeholder="Write message body content here..." rows="6" required></textarea>
        </div>

        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('composeModal')">Cancel</button>
          <button type="submit" class="btn btn-primary">Send Message</button>
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

  let currentMessages = [];
  let selectedMsg = null;

  document.addEventListener('DOMContentLoaded', () => {
    loadInbox();
  });

  async function loadInbox() {
    const listEl = document.getElementById('inboxList');
    listEl.innerHTML = '<div class="empty-state"><div class="spinner"></div></div>';

    try {
      const res = await API.messages.inbox();
      if (res && res.status === 'success') {
        currentMessages = res.data || [];
      } else {
        currentMessages = JSON.parse(localStorage.getItem('sams_mock_messages') || '[]');
      }

      // Filter messages meant for Teacher role or sent by teacher
      // Mock includes: Fatima Sani is id:7, or sender_role matches teacher
      if (currentMessages.length === 0) {
        listEl.innerHTML = '<div class="empty-state">No messages in inbox.</div>';
        return;
      }

      listEl.innerHTML = currentMessages.map(m => `
        <div class="message-item ${m.is_read ? '' : 'unread'}" id="msg-card-${m.id}" onclick="readMessage(${m.id})">
          <div class="flex justify-between items-center mb-1">
            <strong>${m.sender_name}</strong>
            <span class="text-xs text-muted">${Format.timeAgo(m.created_at)}</span>
          </div>
          <div class="text-sm font-semibold truncate" style="color:var(--color-text-primary);">${m.subject}</div>
          <p class="text-xs text-secondary truncate mt-1">${m.body}</p>
        </div>
      `).join('');

    } catch(e) {
      listEl.innerHTML = '<div class="empty-state">Error loading inbox.</div>';
    }
  }

  async function readMessage(id) {
    document.querySelectorAll('.message-item').forEach(item => item.classList.remove('active'));
    
    const card = document.getElementById(`msg-card-${id}`);
    if (card) {
      card.classList.add('active');
      card.classList.remove('unread');
    }

    selectedMsg = currentMessages.find(m => m.id === id);
    if (!selectedMsg) return;

    // Mark as read
    selectedMsg.is_read = 1;
    await API.messages.read(id);

    const viewPane = document.getElementById('messageDetailView');
    viewPane.innerHTML = `
      <div>
        <div class="message-header">
          <span class="text-xs text-muted block">Subject</span>
          <h2 style="margin-bottom:var(--space-2); color:var(--color-accent-light);">${selectedMsg.subject}</h2>
          
          <div class="flex justify-between items-center text-xs mt-4">
            <div>From: <strong>${selectedMsg.sender_name}</strong> (${selectedMsg.sender_role || 'staff'})</div>
            <div>Date: <code>${Format.datetime(selectedMsg.created_at)}</code></div>
          </div>
        </div>

        <div style="font-size:var(--font-size-sm); color:var(--color-text-secondary); line-height:1.6; white-space:pre-wrap; padding:var(--space-3) 0;">
          ${selectedMsg.body}
        </div>
      </div>

      <div style="border-top:1px solid var(--color-border); padding-top:var(--space-4); margin-top:var(--space-4);" class="flex justify-end">
        <button class="btn btn-secondary btn-sm" onclick="replyMessage('${selectedMsg.sender_name}', ${selectedMsg.recipient_id || 1})">Reply Message</button>
      </div>
    `;
  }

  function replyMessage(senderName, recipientId) {
    document.getElementById('msgRecipient').value = recipientId;
    document.getElementById('msgSubject').value = `Re: ${selectedMsg.subject}`;
    document.getElementById('msgBody').value = `\n\n--- Original Message from ${senderName} ---\n${selectedMsg.body}`;
    Modal.open('composeModal');
  }

  async function sendMessage(e) {
    e.preventDefault();
    const recId = document.getElementById('msgRecipient').value;
    const recText = document.getElementById('msgRecipient').options[document.getElementById('msgRecipient').selectedIndex].text.split(' ')[0];
    const subject = document.getElementById('msgSubject').value.trim();
    const body = document.getElementById('msgBody').value.trim();

    const data = {
      recipient_id: recId,
      recipient_name: recText,
      subject,
      body
    };

    try {
      const res = await API.messages.send(data);
      if (res && res.status === 'success') {
        Toast.success('Success', 'Message sent successfully.');
        Modal.close('composeModal');
        document.getElementById('composeForm').reset();
        loadInbox();
      } else {
        Toast.error('Error', res.message || 'Failed to send message.');
      }
    } catch(e) {
      Toast.error('Connection Error', 'Failed to communicate with mail server.');
    }
  }
</script>
</body>
</html>
