<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Fees & Receipts — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <script src="../../assets/js/auth.js"></script>
  <script>
    Auth.requireAuth();
    Auth.requireRole('student');
  </script>
  <style>
    .receipt-modal {
      position: fixed; inset: 0; background: rgba(0,0,0,0.65);
      display: flex; align-items: center; justify-content: center;
      z-index: 1000; backdrop-filter: blur(4px);
    }
    .receipt-modal.hidden { display: none; }
    .receipt-box {
      background: #fff; color: #1e293b; border-radius: var(--radius-xl);
      padding: 32px; width: 100%; max-width: 580px; max-height: 90vh; overflow-y: auto;
      box-shadow: 0 20px 50px rgba(0,0,0,0.3); font-family: 'Inter', sans-serif;
    }
    .receipt-header { text-align: center; border-bottom: 2px dashed #e2e8f0; padding-bottom: 20px; margin-bottom: 20px; }
    .receipt-logo { font-size: 2rem; margin-bottom: 4px; }
    .receipt-title { font-size: 1.25rem; font-weight: 800; color: #1e3a8a; margin-bottom: 2px; }
    .receipt-subtitle { font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; }
    .receipt-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; background: #dcfce7; color: #166534; font-size: 0.75rem; font-weight: 700; margin-top: 8px; }
    .receipt-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.875rem; }
    .receipt-label { color: #64748b; }
    .receipt-val { font-weight: 600; text-align: right; }
    .receipt-total-box { background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: var(--radius-lg); padding: 16px; margin: 20px 0; display: flex; justify-content: space-between; align-items: center; }
    .receipt-total-label { font-weight: 700; color: #1e293b; }
    .receipt-total-amount { font-size: 1.5rem; font-weight: 800; color: #1e3a8a; }
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
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4M7.5 8h9M7.5 16h9M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
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

      <div class="nav-section-label">Financial Records</div>
      <a href="fees" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
        My Fees & Receipts
      </a>

      <div class="nav-section-label">Tasks & Memos</div>
      <a href="assignments" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        My Assignments
      </a>
      <a href="announcements" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 17H2a3 3 0 000-6h1V9a9 9 0 0118 0v2h1a3 3 0 010 6z"/></svg>
        Announcements
      </a>
      <a href="#" class="nav-item" style="color:var(--red);" data-logout>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sign Out
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
          <div class="page-title">My Fees & Receipts</div>
          <div class="page-breadcrumb">Financial Records / <span>School Fees</span></div>
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

      <!-- Financial Overview Cards -->
      <div class="stats-grid stats-grid-3 mb-6">
        <div class="stat-card" style="--stat-color:#6366f1;--stat-color-bg:rgba(99,102,241,0.12)">
          <div class="stat-icon">📄</div>
          <div class="stat-value" id="totalCharged">₦65,000</div>
          <div class="stat-label">Total Fees Charged</div>
        </div>
        <div class="stat-card" style="--stat-color:#10b981;--stat-color-bg:rgba(16,185,129,0.12)">
          <div class="stat-icon">💳</div>
          <div class="stat-value" id="totalPaid">₦50,000</div>
          <div class="stat-label">Total Amount Paid</div>
        </div>
        <div class="stat-card" style="--stat-color:#f59e0b;--stat-color-bg:rgba(245,158,11,0.12)">
          <div class="stat-icon">⚖️</div>
          <div class="stat-value" id="balanceDue">₦15,000</div>
          <div class="stat-label">Outstanding Balance</div>
        </div>
      </div>

      <!-- Fees Breakdown Table -->
      <div class="card mb-6">
        <div class="card-header">
          <h3 class="card-title">Fee Breakdown — 2025/2026 Academic Session (1st Term)</h3>
          <span class="badge badge-warning" id="feeStatusBadge">Partial Payment</span>
        </div>
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Item / Description</th>
                <th>Category</th>
                <th>Term</th>
                <th>Amount Billed</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Tuition Fee</strong></td>
                <td>Academic</td>
                <td>1st Term</td>
                <td><strong>₦40,000</strong></td>
              </tr>
              <tr>
                <td><strong>ICT & Computer Science Laboratory Fee</strong></td>
                <td>Facility</td>
                <td>1st Term</td>
                <td><strong>₦10,000</strong></td>
              </tr>
              <tr>
                <td><strong>Development & Infrastructure Levy</strong></td>
                <td>Development</td>
                <td>1st Term</td>
                <td><strong>₦8,000</strong></td>
              </tr>
              <tr>
                <td><strong>Sports & Library Subscription</strong></td>
                <td>Extracurricular</td>
                <td>1st Term</td>
                <td><strong>₦4,000</strong></td>
              </tr>
              <tr>
                <td><strong>Medical & First Aid Services</strong></td>
                <td>Welfare</td>
                <td>1st Term</td>
                <td><strong>₦3,000</strong></td>
              </tr>
            </tbody>
            <tfoot>
              <tr style="background:var(--bg-secondary);font-weight:700;">
                <td colspan="3" style="text-align:right;">Total Charged:</td>
                <td style="color:var(--accent-primary);">₦65,000</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      <!-- Payment History & Printable Receipts -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">My Payment History & Receipts</h3>
        </div>
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Payment Date</th>
                <th>Receipt #</th>
                <th>Payment Method</th>
                <th>Reference ID</th>
                <th>Amount Paid</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="paymentHistoryBody">
              <!-- Rendered Dynamically -->
            </tbody>
          </table>
        </div>
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->
</div><!-- /.app-shell -->

<!-- Receipt Modal -->
<div class="receipt-modal hidden" id="receiptModal">
  <div class="receipt-box">
    <div class="receipt-header">
      <div class="receipt-logo">🎓</div>
      <div class="receipt-title">PLAN AID ACADEMY</div>
      <div class="receipt-subtitle">OFFICIAL PAYMENT RECEIPT</div>
      <div class="receipt-badge">VERIFIED PAYMENT</div>
    </div>
    <div id="receiptContent">
      <!-- Populated via JavaScript -->
    </div>
    <div style="display:flex;gap:12px;margin-top:24px;">
      <button class="btn btn-primary" style="flex:1;" onclick="window.print()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
        Print Receipt / Save PDF
      </button>
      <button class="btn btn-outline" onclick="closeReceiptModal()">Close</button>
    </div>
  </div>
</div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('student');

  const PAYMENTS = [
    {
      receipt_no: 'REC-2026-8801',
      date: '2026-05-10',
      method: 'Bank Transfer (GTBank)',
      ref: 'TXN-99827101',
      amount: 30000,
      term: '1st Term 2025/2026',
      description: '1st Installment Fee Payment'
    },
    {
      receipt_no: 'REC-2026-9432',
      date: '2026-06-02',
      method: 'POS Card Payment',
      ref: 'TXN-10029384',
      amount: 20000,
      term: '1st Term 2025/2026',
      description: '2nd Installment Fee Payment'
    }
  ];

  document.addEventListener('DOMContentLoaded', () => {
    loadStudentFees();
  });

  function loadStudentFees() {
    const user = Auth.getUser();
    const tbody = document.getElementById('paymentHistoryBody');

    tbody.innerHTML = PAYMENTS.map(p => `
      <tr>
        <td><code>${Format.date(p.date)}</code></td>
        <td><strong style="color:var(--accent-primary);">${p.receipt_no}</strong></td>
        <td>${p.method}</td>
        <td><code>${p.ref}</code></td>
        <td><strong>₦${p.amount.toLocaleString()}</strong></td>
        <td><span class="badge badge-success">Successful</span></td>
        <td>
          <button class="btn btn-sm btn-outline" onclick="viewReceipt('${p.receipt_no}')">
            📄 View Receipt
          </button>
        </td>
      </tr>
    `).join('');
  }

  function viewReceipt(receiptNo) {
    const p = PAYMENTS.find(x => x.receipt_no === receiptNo);
    if (!p) return;

    const user = Auth.getUser();
    const studentName = user ? (user.name || `${user.first_name || 'John'} ${user.last_name || 'Dakyen'}`) : 'John Dakyen';

    document.getElementById('receiptContent').innerHTML = `
      <div class="receipt-row">
        <span class="receipt-label">Receipt Number</span>
        <span class="receipt-val">${p.receipt_no}</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Transaction Date</span>
        <span class="receipt-val">${Format.date(p.date)}</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Student Name</span>
        <span class="receipt-val">${studentName}</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Student ID</span>
        <span class="receipt-val">STD-2026-0003</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Class</span>
        <span class="receipt-val">JSS 3A</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Academic Session / Term</span>
        <span class="receipt-val">${p.term}</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Payment Description</span>
        <span class="receipt-val">${p.description}</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Payment Channel</span>
        <span class="receipt-val">${p.method}</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Reference Code</span>
        <span class="receipt-val">${p.ref}</span>
      </div>
      <div class="receipt-total-box">
        <div class="receipt-total-label">AMOUNT PAID</div>
        <div class="receipt-total-amount">₦${p.amount.toLocaleString()}</div>
      </div>
      <div style="font-size:0.75rem;color:#94a3b8;text-align:center;">
        Issued electronically by Bursary Department, Plan Aid Academy. No physical signature required.
      </div>
    `;

    document.getElementById('receiptModal').classList.remove('hidden');
  }

  function closeReceiptModal() {
    document.getElementById('receiptModal').classList.add('hidden');
  }
</script>
</body>
</html>
