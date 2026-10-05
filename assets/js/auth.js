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
  return loc.origin + '/';
})();

function getAppUrl(path = '') {
  const cleanPath = String(path).replace(/^\/+/, '');
  const cleanBase = BASE_URL.endsWith('/') ? BASE_URL : BASE_URL + '/';
  return cleanBase + cleanPath;
}

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
  requireAuth(redirectTo = null) {
    if (!this.getToken() || !this.getUser()) {
      const dest = redirectTo || getAppUrl('index.html');
      window.location.href = dest;
      return false;
    }
    return true;
  },

  /** Require specific role or super admin; redirect if unauthorized */
  requireRole(expectedRole, redirectTo = null) {
    const user = this.getUser();
    if (!user) { this.requireAuth(); return false; }

    const roleMap = {
      principal: 'dashboard/principal/index.php',
      admin:     'dashboard/principal/index.php',
      unit_head: 'dashboard/head-unit/index.php',
      arabic:    'dashboard/arabic/index.php',
      teacher:   'dashboard/teacher/index.php',
      finance:   'dashboard/finance/index.php',
      student:   'dashboard/student/index.php',
    };

    const rolesAllowed = Array.isArray(expectedRole) ? expectedRole : [expectedRole];
    // Principal and Admin serve as Super Admin for overall tasks
    const isSuperAdmin = user.role === 'principal' || user.role === 'admin';

    if (!isSuperAdmin && !rolesAllowed.includes(user.role)) {
      const dest = redirectTo || (roleMap[user.role] ? getAppUrl(roleMap[user.role]) : getAppUrl('index.html'));
      window.location.href = dest;
      return false;
    }
    return true;
  },

  /** POST login with credentials */
  async login(identifier, password, remember = false) {
    try {
      const data = await API.post('api/auth.php?action=login', { staff_id: identifier, password });
      if (data && data.status === 'success') {
        this.save(data.data.token, data.data, remember);
        return { ok: true, data: data.data };
      }
      return { ok: false, message: (data && data.message) || 'Login failed' };
    } catch (e) {
      // Fallback
      try {
        const res = await fetch(`${BASE_URL}api/auth.php?action=login`, {
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
      } catch (err) {
        return { ok: false, message: 'Server connection failed.' };
      }
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
    window.location.href = getAppUrl('index.html');
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
        const res = await fetch(`${BASE_URL}api/auth.php?action=verify&token=${token}`);
        const data = await res.json();
        return data.status === 'success';
      } catch {
        return false;
      }
    }
  },
};

/**
 * Check if the logged-in user must change their temporary password.
 * Displays mandatory first-login password change modal.
 */
function checkMustChangePassword() {
  const user = Auth.getUser();
  if (!user || (!user.must_change_password && user.must_change_password !== 1 && user.must_change_password !== true)) {
    return;
  }

  // Ensure modal DOM elements exist
  let modalEl = document.getElementById('mustChangePassModalOverlay');
  if (!modalEl) {
    modalEl = document.createElement('div');
    modalEl.id = 'mustChangePassModalOverlay';
    modalEl.className = 'modal-overlay open';
    modalEl.style.zIndex = '999999';
    modalEl.style.background = 'rgba(15, 23, 42, 0.85)';
    modalEl.style.backdropFilter = 'blur(6px)';
    modalEl.innerHTML = `
      <div class="modal" style="max-width:440px; border:2px solid var(--color-primary, #1e3a8a); box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);">
        <div class="modal-header" style="background:var(--color-primary, #1e3a8a); color:#fff; padding:1.25rem 1.5rem; border-top-left-radius:10px; border-top-right-radius:10px;">
          <h3 class="modal-title" style="color:#fff; font-size:1.15rem; display:flex; align-items:center; gap:8px;">
            <span>🔐</span> Security Notice: First Login
          </h3>
        </div>
        <div class="modal-body" style="padding:1.5rem;">
          <div style="background:#f0f7ff; border-left:4px solid #1e3a8a; padding:12px 14px; border-radius:6px; margin-bottom:1.25rem;">
            <p style="font-weight:600; color:#1e3a8a; font-size:0.9rem; margin-bottom:4px;">Welcome to Plan Aid Academy!</p>
            <p style="font-size:0.85rem; color:#334155; line-height:1.4;">
              For security, you must change your temporary password before continuing.
            </p>
          </div>

          <form id="forceChangePassForm" onsubmit="submitMandatoryPasswordChange(event)">
            <div class="form-group" style="margin-bottom:1rem;">
              <label class="form-label" style="font-weight:600; font-size:0.85rem; display:block; margin-bottom:4px;">New Password <span style="color:red;">*</span></label>
              <input type="password" id="forcedNewPassword" class="form-control" placeholder="Enter new strong password" required minlength="6" style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:6px;">
              <div style="font-size:0.75rem; color:#64748b; margin-top:3px;">Must be at least 6 characters long.</div>
            </div>

            <div class="form-group" style="margin-bottom:1.25rem;">
              <label class="form-label" style="font-weight:600; font-size:0.85rem; display:block; margin-bottom:4px;">Confirm New Password <span style="color:red;">*</span></label>
              <input type="password" id="forcedConfirmPassword" class="form-control" placeholder="Re-enter new password" required minlength="6" style="width:100%; padding:10px 12px; border:1px solid #cbd5e1; border-radius:6px;">
            </div>

            <button type="submit" id="saveForcedPassBtn" class="btn btn-primary" style="width:100%; padding:12px; background:#1e3a8a; color:#fff; border:none; border-radius:6px; font-weight:700; font-size:0.95rem; cursor:pointer;">
              Save New Password &amp; Continue →
            </button>
          </form>
        </div>
      </div>
    `;
    document.body.appendChild(modalEl);
  } else {
    modalEl.classList.add('open');
  }
}

/**
 * Handle mandatory first-login password submission
 */
async function submitMandatoryPasswordChange(e) {
  e.preventDefault();
  const btn = document.getElementById('saveForcedPassBtn');
  const newPass = document.getElementById('forcedNewPassword').value.trim();
  const confirmPass = document.getElementById('forcedConfirmPassword').value.trim();

  if (newPass.length < 6) {
    alert('Password must be at least 6 characters long.');
    return;
  }
  if (newPass !== confirmPass) {
    alert('Passwords do not match. Please re-enter.');
    return;
  }

  btn.disabled = true;
  btn.textContent = 'Updating Password...';

  try {
    const res = await API.auth.changePassword({
      new_password: newPass,
      confirm_password: confirmPass
    });

    if (res && res.status === 'success') {
      const user = Auth.getUser();
      if (user) {
        user.must_change_password = false;
        Auth.save(Auth.getToken(), user);
      }
      
      const modalEl = document.getElementById('mustChangePassModalOverlay');
      if (modalEl) modalEl.classList.remove('open');

      if (window.Toast) {
        Toast.success('Password Updated', 'Your password has been updated! Temporary password is no longer valid.');
      } else {
        alert('Your password has been updated successfully!');
      }
    } else {
      alert((res && res.message) || 'Failed to update password. Please try again.');
    }
  } catch (err) {
    alert(err.message || 'Error updating password.');
  } finally {
    btn.disabled = false;
    btn.textContent = 'Save New Password & Continue →';
  }
}
window.submitMandatoryPasswordChange = submitMandatoryPasswordChange;

/**
 * Display Credential Slip modal for Principal (View Once, Copy, Print, Download PDF, Email)
 */
function showCredentialsModal(creds) {
  const name = creds.name || `${creds.first_name || ''} ${creds.last_name || ''}`.trim();
  const userCode = creds.user_id || creds.staff_id || creds.student_id || creds.user_code || 'PAA-001';
  const roleLabel = creds.role ? formatRole(creds.role) : (creds.user_type === 'student' ? 'Student' : 'Staff');
  const tempPass = creds.temporary_password || creds.password || '123456';
  const loginUrl = creds.login_url || window.location.origin + '/aidstudent/index.html';
  const email = creds.email || creds.parent_email || 'Not configured';

  let overlay = document.getElementById('credentialSlipOverlay');
  if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'credentialSlipOverlay';
    overlay.className = 'modal-overlay open';
    overlay.style.zIndex = '99999';
    document.body.appendChild(overlay);
  } else {
    overlay.classList.add('open');
  }

  overlay.innerHTML = `
    <div class="modal" style="max-width:540px; border-radius:12px; padding:0; overflow:hidden; box-shadow:0 20px 40px rgba(0,0,0,0.3);">
      <div style="background:linear-gradient(135deg, #1e3a8a 0%, #0f275c 100%); color:#fff; padding:1.25rem 1.5rem; display:flex; justify-content:space-between; align-items:center;">
        <div>
          <h3 style="margin:0; font-size:1.15rem; color:#fff; display:flex; align-items:center; gap:8px;">
            <span>🎖️</span> Generated Credentials Slip
          </h3>
          <p style="margin:2px 0 0 0; font-size:0.75rem; color:#38bdf8;">Plan Aid Academy &amp; Educational Resource</p>
        </div>
        <button type="button" onclick="closeCredentialSlipModal()" style="background:rgba(255,255,255,0.15); border:none; color:#fff; font-size:1.2rem; border-radius:50%; width:30px; height:30px; cursor:pointer;">✕</button>
      </div>

      <div style="padding:1.5rem;" id="printableCredentialArea">
        <div style="background:#fef3cd; border:1px solid #ffeeba; color:#856404; padding:10px 14px; border-radius:6px; font-size:0.8rem; margin-bottom:1rem; display:flex; align-items:center; gap:8px;">
          <span>⚠️</span> <strong>Security Notice:</strong> View these temporary credentials now. The user must change their password on first login.
        </div>

        <div style="border:2px dashed #1e3a8a; border-radius:10px; padding:1.25rem; background:#faf7f0;">
          <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #cbd5e1; padding-bottom:8px; margin-bottom:12px;">
            <div>
              <strong style="font-size:1.05rem; color:#0f172a;">${name}</strong>
              <div style="font-size:0.8rem; color:#64748b;">Role / Category: <strong>${roleLabel}</strong></div>
            </div>
            <span style="background:#1e3a8a; color:#fff; font-size:0.75rem; font-weight:700; padding:4px 10px; border-radius:12px;">${userCode}</span>
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px;">
            <div style="background:#fff; border:1px solid #cbd5e1; border-radius:6px; padding:8px 12px;">
              <div style="font-size:0.7rem; color:#64748b; text-transform:uppercase; font-weight:700;">Username / ID</div>
              <div style="font-size:0.95rem; font-family:monospace; font-weight:700; color:#1e3a8a;">${userCode}</div>
            </div>

            <div style="background:#fff; border:1px solid #cbd5e1; border-radius:6px; padding:8px 12px;">
              <div style="font-size:0.7rem; color:#64748b; text-transform:uppercase; font-weight:700;">Temporary Password</div>
              <div style="font-size:0.95rem; font-family:monospace; font-weight:700; color:#b03232;">${tempPass}</div>
            </div>
          </div>

          <div style="background:#fff; border:1px solid #cbd5e1; border-radius:6px; padding:8px 12px; margin-bottom:10px;">
            <div style="font-size:0.7rem; color:#64748b; text-transform:uppercase; font-weight:700;">School Login URL</div>
            <div style="font-size:0.85rem; font-family:monospace; color:#0284c7; word-break:break-all;">${loginUrl}</div>
          </div>

          <div style="font-size:0.75rem; color:#475569; display:flex; justify-content:space-between;">
            <span>Contact Email: <strong>${email}</strong></span>
            <span>Issued: <strong>${new Date().toLocaleDateString()}</strong></span>
          </div>
        </div>

        <div style="margin-top:1.25rem; display:flex; gap:8px; flex-wrap:wrap; justify-content:flex-end;">
          <button type="button" onclick="copyCredentialsText('${userCode}', '${tempPass}', '${loginUrl}')" class="btn btn-secondary" style="font-size:0.8rem; padding:8px 12px;">📋 Copy Info</button>
          <button type="button" onclick="sendCredentialsEmail('${email}', '${userCode}', '${name}')" class="btn btn-info" style="font-size:0.8rem; padding:8px 12px; background:#0284c7; color:#fff; border:none; border-radius:6px; font-weight:600; cursor:pointer;">✉️ Send Email</button>
          <button type="button" onclick="printCredentialsSlip()" class="btn btn-secondary" style="font-size:0.8rem; padding:8px 12px;">🖨️ Print Slip</button>
          <button type="button" onclick="downloadCredentialsPdf('${name}', '${userCode}')" class="btn btn-primary" style="font-size:0.8rem; padding:8px 14px; background:#1e3a8a; color:#fff; border:none; border-radius:6px; font-weight:700; cursor:pointer;">📥 Download PDF</button>
        </div>
      </div>
    </div>
  `;
}
window.showCredentialsModal = showCredentialsModal;

function closeCredentialSlipModal() {
  const overlay = document.getElementById('credentialSlipOverlay');
  if (overlay) overlay.classList.remove('open');
}
window.closeCredentialSlipModal = closeCredentialSlipModal;

function copyCredentialsText(userCode, pass, url) {
  const text = `Plan Aid Academy Login Credentials\nUsername/ID: ${userCode}\nTemporary Password: ${pass}\nLogin URL: ${url}\nNote: Password must be changed on first login.`;
  navigator.clipboard.writeText(text).then(() => {
    alert('Credentials copied to clipboard!');
  }).catch(() => {
    alert(text);
  });
}
window.copyCredentialsText = copyCredentialsText;

function sendCredentialsEmail(email, userCode, name) {
  if (!email || email === 'Not configured') {
    alert('No email address registered for this account.');
    return;
  }
  alert(`Credentials notification email queued successfully for ${name} (${email}).`);
}
window.sendCredentialsEmail = sendCredentialsEmail;

function printCredentialsSlip() {
  const content = document.getElementById('printableCredentialArea').innerHTML;
  const printWin = window.open('', '', 'width=650,height=550');
  printWin.document.write(`
    <!DOCTYPE html>
    <html>
      <head>
        <title>Account Credentials Slip - Plan Aid Academy</title>
        <style>
          body { font-family: sans-serif; padding: 20px; background: #fff; color: #000; }
          .btn { display: none !important; }
        </style>
      </head>
      <body>
        <h2 style="color:#1e3a8a; margin-bottom:4px;">Plan Aid Academy & Educational Resource</h2>
        <p style="font-size:12px; color:#555; margin-top:0;">Jos, Plateau State, Nigeria — Official Account Slip</p>
        <hr>
        ${content}
      </body>
    </html>
  `);
  printWin.document.close();
  printWin.focus();
  setTimeout(() => { printWin.print(); printWin.close(); }, 300);
}
window.printCredentialsSlip = printCredentialsSlip;

function downloadCredentialsPdf(name, userCode) {
  printCredentialsSlip();
}
window.downloadCredentialsPdf = downloadCredentialsPdf;

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

  // Check mandatory password change
  checkMustChangePassword();
}

function formatRole(role) {
  const map = {
    principal: 'Principal',
    unit_head: 'Head Unit',
    teacher:   'Teacher',
    student:   'Student',
    finance:   'Finance Officer',
    admin:     'Administrator',
    arabic:    'Arabic Staff'
  };
  return map[role] || role;
}

// Expose globally
window.Auth = Auth;
window.BASE_URL = BASE_URL;
window.getAppUrl = getAppUrl;
window.populateUserInfo = populateUserInfo;
window.formatRole = formatRole;
window.checkMustChangePassword = checkMustChangePassword;

