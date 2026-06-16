/**
 * School Aid Management System
 * auth.js — Session management, login, logout utilities
 */

const BASE_URL = (() => {
  const loc = window.location;
  // Walk up to find the aidstudent root
  const parts = loc.pathname.split('/');
  const idx = parts.indexOf('aidstudent');
  if (idx !== -1) return loc.origin + parts.slice(0, idx + 1).join('/');
  return loc.origin;
})();

const Auth = {
  TOKEN_KEY: 'sams_token',
  USER_KEY:  'sams_user',

  /** Get stored token */
  getToken() { return sessionStorage.getItem(this.TOKEN_KEY) || localStorage.getItem(this.TOKEN_KEY); },

  /** Get stored user object */
  getUser() {
    const raw = sessionStorage.getItem(this.USER_KEY) || localStorage.getItem(this.USER_KEY);
    try { return raw ? JSON.parse(raw) : null; } catch { return null; }
  },

  /** Save auth data */
  save(token, user, remember = false) {
    const storage = remember ? localStorage : sessionStorage;
    storage.setItem(this.TOKEN_KEY, token);
    storage.setItem(this.USER_KEY, JSON.stringify(user));
  },

  /** Clear auth data */
  clear() {
    [sessionStorage, localStorage].forEach(s => {
      s.removeItem(this.TOKEN_KEY);
      s.removeItem(this.USER_KEY);
    });
  },

  /** Redirect if not logged in */
  requireAuth(redirectTo = '/login') {
    if (!this.getToken()) {
      window.location.href = BASE_URL + redirectTo;
      return false;
    }
    return true;
  },

  /** Require specific role; redirect if wrong */
  requireRole(expectedRole, redirectTo = null) {
    const user = this.getUser();
    if (!user) { this.requireAuth(); return false; }

    const roleMap = {
      principal: 'dashboard/principal/index',
      unit_head: 'dashboard/head-unit/index',
      teacher:   'dashboard/teacher/index',
      student:   'dashboard/student/index',
    };

    if (user.role !== expectedRole) {
      const dest = redirectTo || (roleMap[user.role] ? BASE_URL + '/' + roleMap[user.role] : BASE_URL + '/login');
      window.location.href = dest;
      return false;
    }
    return true;
  },

  /** POST login with credentials */
  async login(identifier, password, remember = false) {
    try {
      const data = await API.post('api/auth.php', { staff_id: identifier, password });
      if (data && data.status === 'success') {
        this.save(data.data.token, data.data, remember);
        return { ok: true, data: data.data };
      }
      return { ok: false, message: (data && data.message) || 'Login failed' };
    } catch (e) {
      // Fallback in case API is not defined yet
      const res = await fetch(`${BASE_URL}/api/auth.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ staff_id: identifier, password }),
      });
      const data = await res.json();
      if (data.status === 'success') {
        this.save(data.data.token, data.data, remember);
        return { ok: true, data: data.data };
      }
      return { ok: false, message: data.message || 'Login failed' };
    }
  },

  /** Logout */
  async logout() {
    const token = this.getToken();
    if (token) {
      try {
        await API.get('api/auth.php', { action: 'logout', token });
      } catch (_) { /* ignore */ }
    }
    this.clear();
    window.location.href = BASE_URL + '/login';
  },

  /** Verify session is still valid */
  async verify() {
    const token = this.getToken();
    if (!token) return false;
    try {
      const data = await API.get('api/auth.php', { action: 'verify', token });
      return data && data.status === 'success';
    } catch {
      try {
        const res = await fetch(`${BASE_URL}/api/auth.php?action=verify&token=${token}`);
        const data = await res.json();
        return data.status === 'success';
      } catch {
        return false;
      }
    }
  },
};

/** Populate user info in the DOM (name, role, avatar initials) */
function populateUserInfo() {
  const user = Auth.getUser();
  if (!user) return;

  document.querySelectorAll('[data-user-name]').forEach(el => el.textContent = user.name || '');
  document.querySelectorAll('[data-user-role]').forEach(el => el.textContent = formatRole(user.role || ''));
  document.querySelectorAll('[data-user-id]').forEach(el => el.textContent = user.staff_id || user.student_id || '');
  document.querySelectorAll('[data-user-email]').forEach(el => el.textContent = user.email || '');

  // Avatar initials
  const initials = (user.name || 'U A').split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase();
  document.querySelectorAll('.user-avatar-initials').forEach(el => el.textContent = initials);
}

function formatRole(role) {
  const map = {
    principal: 'Principal',
    unit_head: 'Head Unit',
    teacher:   'Teacher',
    student:   'Student',
    finance:   'Finance Officer',
    admin:     'Administrator',
  };
  return map[role] || role;
}

// Expose globally
window.Auth = Auth;
window.BASE_URL = BASE_URL;
window.populateUserInfo = populateUserInfo;
window.formatRole = formatRole;
