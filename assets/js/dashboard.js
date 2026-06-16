/**
 * School Aid Management System
 * dashboard.js — Sidebar, topbar, notifications, chart defaults
 */

document.addEventListener('DOMContentLoaded', () => {
  initSidebar();
  initDropdowns();
  initNotifPanel();
  populateUserInfo();
  setActivePage();
  loadSessionInfo();
  loadNotifCount();
});

/* -------------------------------------------------------
   Sidebar toggle (mobile)
   ------------------------------------------------------- */
function initSidebar() {
  const toggle   = document.getElementById('sidebarToggle');
  const sidebar  = document.getElementById('sidebar');
  const backdrop = document.getElementById('sidebarBackdrop');

  if (!toggle || !sidebar) return;

  toggle.addEventListener('click', () => {
    sidebar.classList.toggle('open');
    backdrop.classList.toggle('open');
  });
  backdrop?.addEventListener('click', () => {
    sidebar.classList.remove('open');
    backdrop.classList.remove('open');
  });
}

/* -------------------------------------------------------
   Auto-highlight active nav item
   ------------------------------------------------------- */
function setActivePage() {
  const current = window.location.pathname;
  document.querySelectorAll('.nav-item').forEach(link => {
    const href = link.getAttribute('href');
    if (!href) return;
    // Match by filename
    const linkFile = href.split('/').pop();
    const curFile  = current.split('/').pop();
    if (linkFile && curFile && linkFile === curFile) {
      link.classList.add('active');
    }
  });
}

/* -------------------------------------------------------
   Dropdowns
   ------------------------------------------------------- */
function initDropdowns() {
  document.addEventListener('click', e => {
    const trigger = e.target.closest('[data-dropdown]');
    if (trigger) {
      const menuId = trigger.dataset.dropdown;
      const menu   = document.getElementById(menuId);
      if (menu) {
        // Close others
        document.querySelectorAll('.dropdown-menu.open').forEach(m => {
          if (m !== menu) m.classList.remove('open');
        });
        menu.classList.toggle('open');
      }
      return;
    }
    // Click outside
    if (!e.target.closest('.dropdown')) {
      document.querySelectorAll('.dropdown-menu.open').forEach(m => m.classList.remove('open'));
    }
  });
}

/* -------------------------------------------------------
   Notification Panel
   ------------------------------------------------------- */
function initNotifPanel() {
  const panel   = document.getElementById('notifPanel');
  const openBtn = document.getElementById('notifBtn');
  const closeBtn= document.getElementById('notifClose');

  openBtn?.addEventListener('click', () => {
    panel?.classList.toggle('open');
    if (panel?.classList.contains('open')) loadNotifications();
  });
  closeBtn?.addEventListener('click', () => panel?.classList.remove('open'));

  // Mark all read
  document.getElementById('markAllRead')?.addEventListener('click', async () => {
    await API.notifications.markAll();
    loadNotifications();
    loadNotifCount();
  });
}

async function loadNotifCount() {
  try {
    const res = await API.notifications.list();
    if (res?.status === 'success') {
      const unread = res.data.filter(n => !n.is_read).length;
      document.querySelectorAll('.notif-count-dot').forEach(el => {
        el.style.display = unread > 0 ? '' : 'none';
      });
      document.querySelectorAll('.notif-count-badge').forEach(el => {
        el.textContent = unread > 0 ? unread : '';
        el.style.display = unread > 0 ? '' : 'none';
      });
    }
  } catch (_) {}
}

async function loadNotifications() {
  const list = document.getElementById('notifList');
  if (!list) return;

  list.innerHTML = '<div class="empty-state"><div class="spinner"></div></div>';
  try {
    const res = await API.notifications.list();
    if (res?.status === 'success' && res.data.length > 0) {
      list.innerHTML = res.data.map(n => `
        <div class="notif-item ${!n.is_read ? 'unread' : ''}" onclick="markNotifRead(${n.id}, '${n.link || ''}')">
          <div class="notif-icon-wrap">${notifIcon(n.type)}</div>
          <div class="notif-text">
            <div class="notif-title">${n.title}</div>
            <div class="notif-msg">${n.body}</div>
            <div class="notif-time">${Format.timeAgo(n.created_at)}</div>
          </div>
        </div>
      `).join('');
    } else {
      list.innerHTML = `<div class="empty-state">
        <div class="empty-state-icon">🔔</div>
        <div class="empty-state-title">All caught up!</div>
        <div class="empty-state-desc">No notifications at the moment.</div>
      </div>`;
    }
  } catch (_) {
    list.innerHTML = '<div class="empty-state"><div class="empty-state-desc">Failed to load notifications.</div></div>';
  }
}

async function markNotifRead(id, link) {
  await API.notifications.markRead(id);
  loadNotifCount();
  loadNotifications();
  if (link) window.location.href = link;
}
window.markNotifRead = markNotifRead;

function notifIcon(type) {
  const map = {
    approval: '✅', rejection: '❌', message: '💬',
    result: '📊', assignment: '📝', announcement: '📢',
    correction: '📋', system: '🔔',
  };
  return map[type] || '🔔';
}

/* -------------------------------------------------------
   Session info in topbar
   ------------------------------------------------------- */
async function loadSessionInfo() {
  try {
    const res = await API.get('api/dashboard.php');
    if (res?.status === 'success' && res.data?.current_session) {
      const s = res.data.current_session;
      document.querySelectorAll('.session-info').forEach(el => {
        el.textContent = `${s.session} | ${s.term} Term`;
      });
    }
  } catch (_) {}
}

/* -------------------------------------------------------
   Chart.js global defaults
   ------------------------------------------------------- */
if (window.Chart) {
  Chart.defaults.color = '#94a3b8';
  Chart.defaults.borderColor = 'rgba(148,163,184,0.1)';
  Chart.defaults.font.family = "'Inter', sans-serif";
  Chart.defaults.font.size = 12;
  Chart.defaults.plugins.legend.labels.usePointStyle = true;
  Chart.defaults.plugins.legend.labels.padding = 16;
  Chart.defaults.plugins.tooltip.backgroundColor = '#1a2235';
  Chart.defaults.plugins.tooltip.borderColor = 'rgba(148,163,184,0.2)';
  Chart.defaults.plugins.tooltip.borderWidth = 1;
  Chart.defaults.plugins.tooltip.padding = 12;
  Chart.defaults.plugins.tooltip.titleColor = '#f1f5f9';
  Chart.defaults.plugins.tooltip.bodyColor = '#94a3b8';
  Chart.defaults.plugins.tooltip.cornerRadius = 8;
}

/* -------------------------------------------------------
   Confirm dialog helper
   ------------------------------------------------------- */
function confirmAction(message, onConfirm) {
  const overlay = document.getElementById('confirmOverlay');
  const msg     = document.getElementById('confirmMessage');
  const yesBtn  = document.getElementById('confirmYes');
  const noBtn   = document.getElementById('confirmNo');

  if (!overlay) {
    // Fallback
    if (window.confirm(message)) onConfirm();
    return;
  }
  msg.textContent = message;
  overlay.classList.add('active');
  const cleanup = () => { overlay.classList.remove('active'); yesBtn.onclick = null; noBtn.onclick = null; };
  yesBtn.onclick = () => { cleanup(); onConfirm(); };
  noBtn.onclick  = cleanup;
}
window.confirmAction = confirmAction;

/* -------------------------------------------------------
   Logout handler
   ------------------------------------------------------- */
document.querySelectorAll('[data-logout]').forEach(el => {
  el.addEventListener('click', e => {
    e.preventDefault();
    confirmAction('Are you sure you want to logout?', () => Auth.logout());
  });
});

/* -------------------------------------------------------
   Search debounce helper
   ------------------------------------------------------- */
function debounce(fn, delay = 300) {
  let t;
  return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), delay); };
}
window.debounce = debounce;

/* -------------------------------------------------------
   Table row loading skeleton
   ------------------------------------------------------- */
function tableLoadingSkeleton(tbody, cols = 5, rows = 5) {
  tbody.innerHTML = Array.from({ length: rows }, () =>
    `<tr>${Array.from({ length: cols }, () =>
      `<td><div class="skeleton" style="height:14px;"></div></td>`
    ).join('')}</tr>`
  ).join('');
}
window.tableLoadingSkeleton = tableLoadingSkeleton;
