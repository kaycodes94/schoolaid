<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finance &amp; Accounts Portal — Plan Aid Academy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <script src="../../assets/js/auth.js"></script>
  <script>
    Auth.requireAuth();
    Auth.requireRole(['finance', 'principal', 'admin']);
  </script>
  <style>
    .receipt-box {
      background: #ffffff;
      color: #0f172a;
      border: 2px dashed var(--color-border);
      border-radius: var(--radius-xl);
      padding: var(--space-6);
      font-family: 'Courier New', Courier, monospace;
    }
    .receipt-header {
      text-align: center;
      border-bottom: 2px solid #0f172a;
      padding-bottom: var(--space-4);
      margin-bottom: var(--space-4);
    }
    .receipt-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: var(--space-2);
      font-size: 0.9rem;
    }
    @media print {
      body * { visibility: hidden; }
      .printable-receipt, .printable-receipt * { visibility: visible; }
      .printable-receipt { position: absolute; left: 0; top: 0; width: 100%; }
    }
  </style>
</head>
<body>
<div class="app-shell">

  <!-- Sidebar Backdrop -->
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- ===================== SIDEBAR ===================== -->
  <aside class="sidebar" id="sidebar">
    <a href="index.php" class="sidebar-logo">
      <div class="sidebar-logo-icon">💳</div>
      <div class="sidebar-logo-text">
        <div class="sidebar-logo-name">Plan Aid Academy</div>
        <div class="sidebar-logo-role">Finance Portal</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Financial Overview</div>
      <a href="#overview" class="nav-item active" id="nav-overview" onclick="switchSection('overview')">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Finance Dashboard
      </a>

      <div class="nav-section-label">Fee &amp; Payments</div>
      <a href="#fees" class="nav-item" id="nav-fees" onclick="switchSection('fees')">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Fee Structures
      </a>
      <a href="#payments" class="nav-item" id="nav-payments" onclick="switchSection('payments')">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
        Record Payments
      </a>
      <a href="#accounts" class="nav-item" id="nav-accounts" onclick="switchSection('accounts')">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Student Financial Accounts
      </a>

      <div class="nav-section-label">Reports &amp; Receipts</div>
      <a href="#receipts" class="nav-item" id="nav-receipts" onclick="switchSection('receipts')">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Receipts History
      </a>
      <a href="#reports" class="nav-item" id="nav-reports" onclick="switchSection('reports')">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        Financial Reports
      </a>

      <a href="#" class="nav-item mt-6" style="color:var(--red);" data-logout>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sign Out
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--color-info);">FO</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>Finance Officer</div>
          <div class="sidebar-user-role">Finance Staff</div>
        </div>
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
          <div class="page-title" id="pageTitleText">Finance &amp; Accounts Portal</div>
          <div class="page-breadcrumb">Financial Records / <span id="sectionBreadcrumb">Overview</span></div>
        </div>
      </div>
      <div class="topbar-right">
        <span class="session-badge session-info">2025/2026 Term 1 Financials</span>
        <div class="dropdown">
          <div class="icon-btn" data-dropdown="userMenu">
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--color-info);font-size:0.65rem;width:28px;height:28px;">FO</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>Finance Officer</div>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item danger" data-logout>Sign Out</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="page-content">

      <!-- ================= SECTION: OVERVIEW ================= -->
      <div id="sec-overview" class="finance-section">
        <!-- 7 Required Dashboard Metrics -->
        <div class="stats-grid stats-grid-4 mb-6">
          <div class="stat-card" style="--stat-color:#6366f1;--stat-color-bg:rgba(99,102,241,0.12);">
            <div class="stat-icon">📑</div>
            <div class="stat-value">₦17,000,000</div>
            <div class="stat-label">Total Fees Billed</div>
          </div>
          <div class="stat-card" style="--stat-color:#10b981;--stat-color-bg:rgba(16,185,129,0.12);">
            <div class="stat-icon">💰</div>
            <div class="stat-value">₦14,850,000</div>
            <div class="stat-label">Total Amount Collected</div>
          </div>
          <div class="stat-card" style="--stat-color:#ef4444;--stat-color-bg:rgba(239,68,68,0.12);">
            <div class="stat-icon">⌛</div>
            <div class="stat-value">₦2,150,000</div>
            <div class="stat-label">Outstanding Fees</div>
          </div>
          <div class="stat-card" style="--stat-color:#f59e0b;--stat-color-bg:rgba(245,158,11,0.12);">
            <div class="stat-icon">👥</div>
            <div class="stat-value">42 Students</div>
            <div class="stat-label">Students with Unpaid Fees</div>
          </div>
        </div>

        <!-- Action Row -->
        <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
          <h2>Financial Operations</h2>
          <div class="flex gap-3">
            <button class="btn btn-primary" onclick="Modal.open('paymentModal')">+ Record Fee Payment</button>
            <button class="btn btn-secondary" onclick="Modal.open('chargeModal')">+ Add Individual Charge</button>
            <button class="btn btn-warning" onclick="Modal.open('discountModal')">Apply Discount</button>
          </div>
        </div>

        <!-- Recent Transactions & Payment Statistics -->
        <div class="grid gap-6 mb-6" style="grid-template-columns: 1.5fr 1fr;">
          <!-- Recent Transactions Table -->
          <div class="card">
            <div class="card-header flex justify-between items-center">
              <h3 class="card-title">Recent Fee Transactions</h3>
              <span class="badge badge-primary">Term 1 (2025/2026)</span>
            </div>
            <div class="table-wrapper">
              <table class="table">
                <thead>
                  <tr>
                    <th>Ref / Receipt</th>
                    <th>Student Name</th>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Date</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody id="overviewPaymentsTable">
                  <!-- Loaded dynamically -->
                </tbody>
              </table>
            </div>
          </div>

          <!-- Payment Statistics Breakdown -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Payment Method Statistics</h3>
            </div>
            <div class="flex flex-col gap-4">
              <div>
                <div class="flex justify-between text-xs mb-1">
                  <span>Bank Transfer (68%)</span>
                  <strong>₦10,098,000</strong>
                </div>
                <div style="height:8px;background:var(--color-bg-elevated);border-radius:4px;overflow:hidden;">
                  <div style="width:68%;height:100%;background:var(--color-primary);"></div>
                </div>
              </div>

              <div>
                <div class="flex justify-between text-xs mb-1">
                  <span>POS / Card Payment (22%)</span>
                  <strong>₦3,267,000</strong>
                </div>
                <div style="height:8px;background:var(--color-bg-elevated);border-radius:4px;overflow:hidden;">
                  <div style="width:22%;height:100%;background:var(--color-info);"></div>
                </div>
              </div>

              <div>
                <div class="flex justify-between text-xs mb-1">
                  <span>Cash Deposit (10%)</span>
                  <strong>₦1,485,000</strong>
                </div>
                <div style="height:8px;background:var(--color-bg-elevated);border-radius:4px;overflow:hidden;">
                  <div style="width:10%;height:100%;background:var(--color-warning);"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ================= SECTION: FEE STRUCTURES ================= -->
      <div id="sec-fees" class="finance-section" style="display:none;">
        <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
          <h2>Fee Structures &amp; Class Pricing</h2>
          <button class="btn btn-primary" onclick="Modal.open('feeStructureModal')">+ Create Fee Structure</button>
        </div>

        <div class="grid gap-6 grid-cols-3 mb-6">
          <div class="card">
            <div class="flex justify-between items-center mb-3">
              <span class="badge badge-primary">Nursery Track</span>
              <strong>₦35,000 / Term</strong>
            </div>
            <h4>Nursery 1 &amp; 2 Fee Schedule</h4>
            <p class="text-xs text-muted mt-2">Tuition: ₦25,000 · Development: ₦5,000 · Learning Materials: ₦5,000</p>
          </div>

          <div class="card">
            <div class="flex justify-between items-center mb-3">
              <span class="badge badge-info">Primary Track</span>
              <strong>₦40,000 / Term</strong>
            </div>
            <h4>Primary 1 - 6 Fee Schedule</h4>
            <p class="text-xs text-muted mt-2">Tuition: ₦28,000 · ICT &amp; Lab: ₦7,000 · Development: ₦5,000</p>
          </div>

          <div class="card">
            <div class="flex justify-between items-center mb-3">
              <span class="badge badge-gold">Junior Secondary</span>
              <strong>₦45,000 / Term</strong>
            </div>
            <h4>JSS 1 - 3 Fee Schedule</h4>
            <p class="text-xs text-muted mt-2">Tuition: ₦30,000 · Science &amp; ICT: ₦10,000 · Development: ₦5,000</p>
          </div>
        </div>
      </div>

      <!-- ================= SECTION: RECORD PAYMENTS ================= -->
      <div id="sec-payments" class="finance-section" style="display:none;">
        <div class="card max-w-xl mx-auto">
          <div class="card-header"><h3 class="card-title">Record Student Payment</h3></div>
          <form id="recordPaymentForm" onsubmit="recordPayment(event)">
            <div class="form-group mb-4">
              <label class="form-label" for="payStudentId">Student Admission No. / ID <span class="required">*</span></label>
              <input type="text" id="payStudentId" class="form-control" placeholder="e.g. PAA-2023-0047" required>
            </div>

            <div class="form-row mb-4">
              <div class="form-group">
                <label class="form-label" for="payAmount">Amount Paid (₦) <span class="required">*</span></label>
                <input type="number" id="payAmount" class="form-control" placeholder="e.g. 45000" min="1" required>
              </div>
              <div class="form-group">
                <label class="form-label" for="payMethod">Payment Method <span class="required">*</span></label>
                <select id="payMethod" class="form-control" required>
                  <option value="Bank Transfer">Bank Transfer</option>
                  <option value="POS / Card">POS / Card</option>
                  <option value="Cash Deposit">Cash Deposit</option>
                </select>
              </div>
            </div>

            <div class="form-group mb-4">
              <label class="form-label" for="payTxnRef">Transaction Reference Code</label>
              <input type="text" id="payTxnRef" class="form-control" placeholder="e.g. TXN-9804123">
            </div>

            <div class="flex justify-end gap-3 mt-6">
              <button type="submit" class="btn btn-primary">Process &amp; Issue Receipt</button>
            </div>
          </form>
        </div>
      </div>

      <!-- ================= SECTION: STUDENT ACCOUNTS ================= -->
      <div id="sec-accounts" class="finance-section" style="display:none;">
        <div class="card mb-6">
          <div class="card-header"><h3 class="card-title">Student Financial Accounts</h3></div>
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                  <th>Student Name</th>
                  <th>Admission ID</th>
                  <th>Class</th>
                  <th>Amount Billed</th>
                  <th>Amount Paid</th>
                  <th>Balance</th>
                  <th>Status</th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody id="studentAccountsBody">
                <!-- Loaded dynamically -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ================= SECTION: RECEIPTS ================= -->
      <div id="sec-receipts" class="finance-section" style="display:none;">
        <div class="card mb-6">
          <div class="card-header"><h3 class="card-title">Official Financial Receipts History</h3></div>
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                  <th>Receipt No</th>
                  <th>Student</th>
                  <th>Amount</th>
                  <th>Payment Method</th>
                  <th>Date</th>
                  <th class="text-right">Receipt Action</th>
                </tr>
              </thead>
              <tbody id="receiptsTableBody">
                <!-- Loaded dynamically -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ================= SECTION: REPORTS ================= -->
      <div id="sec-reports" class="finance-section" style="display:none;">
        <div class="card mb-6">
          <div class="card-header"><h3 class="card-title">Generate Financial Reports</h3></div>
          <div class="grid gap-4 grid-cols-3 mb-6">
            <button class="btn btn-secondary text-left" onclick="generateReport('Daily Collection')">📊 Daily Collection Report</button>
            <button class="btn btn-secondary text-left" onclick="generateReport('Weekly Collection')">📊 Weekly Collection Report</button>
            <button class="btn btn-secondary text-left" onclick="generateReport('Monthly Collection')">📊 Monthly Collection Report</button>
            <button class="btn btn-secondary text-left" onclick="generateReport('Outstanding Fees')">⚠️ Outstanding Fees Report</button>
            <button class="btn btn-secondary text-left" onclick="generateReport('Class-by-Class Fee')">🏫 Class-by-Class Fee Report</button>
            <button class="btn btn-secondary text-left" onclick="generateReport('Full Transaction Log')">📄 Full Transaction Log</button>
          </div>
        </div>
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<!-- Payment Modal -->
<div class="modal-overlay" id="paymentModal">
  <div class="modal" style="max-width:480px;">
    <div class="modal-header">
      <h3 class="modal-title">Record Fee Payment</h3>
      <button class="modal-close" onclick="Modal.close('paymentModal')">✕</button>
    </div>
    <div class="modal-body">
      <form onsubmit="recordPayment(event)">
        <div class="form-group mb-4">
          <label class="form-label" for="modalPayStudentId">Student ID or Admission No. <span class="required">*</span></label>
          <input type="text" id="modalPayStudentId" class="form-control" placeholder="e.g. PAA-2023-0047" required>
        </div>
        <div class="form-group mb-4">
          <label class="form-label" for="modalPayAmount">Amount Paid (₦) <span class="required">*</span></label>
          <input type="number" id="modalPayAmount" class="form-control" placeholder="e.g. 45000" min="1" required>
        </div>
        <div class="form-group mb-4">
          <label class="form-label" for="modalPayMethod">Payment Method <span class="required">*</span></label>
          <select id="modalPayMethod" class="form-control" required>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="POS / Card">POS / Card</option>
            <option value="Cash Deposit">Cash Deposit</option>
          </select>
        </div>
        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('paymentModal')">Cancel</button>
          <button type="submit" class="btn btn-primary">Process &amp; Issue Receipt</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Receipt Modal -->
<div class="modal-overlay" id="receiptModal">
  <div class="modal printable-receipt" style="max-width:520px;">
    <div class="modal-header">
      <h3 class="modal-title">Official Fee Receipt</h3>
      <button class="modal-close" onclick="Modal.close('receiptModal')">✕</button>
    </div>
    <div class="modal-body">
      <div class="receipt-box" id="receiptBoxContent">
        <!-- Dynamically rendered -->
      </div>
      <div class="flex gap-3 justify-end mt-6">
        <button class="btn btn-secondary" onclick="Modal.close('receiptModal')">Close</button>
        <button class="btn btn-primary" onclick="window.print()">🖨️ Print / Download PDF</button>
      </div>
    </div>
  </div>
</div>

<!-- Student Account Detail Modal -->
<div class="modal-overlay" id="studentAccountModal">
  <div class="modal" style="max-width:560px;">
    <div class="modal-header">
      <h3 class="modal-title">Student Financial Account Detail</h3>
      <button class="modal-close" onclick="Modal.close('studentAccountModal')">✕</button>
    </div>
    <div class="modal-body" id="studentAccountContent">
      <!-- Loaded Dynamically -->
    </div>
  </div>
</div>

<div class="toast-container"></div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole(['finance', 'principal', 'admin']);

  let paymentsList = [
    { receipt: 'REC-2025-001', student: 'Aisha Mohammed', id: 'PAA-2023-0047', class: 'JSS 2A', billed: 45000, paid: 45000, balance: 0, method: 'Bank Transfer', date: '2026-09-28', txnRef: 'TXN-98213' },
    { receipt: 'REC-2025-002', student: 'Ibrahim Danlami', id: 'PAA-2023-0012', class: 'SS 1 STEM', billed: 50000, paid: 50000, balance: 0, method: 'POS / Card', date: '2026-09-27', txnRef: 'TXN-88124' },
    { receipt: 'REC-2025-003', student: 'Zainab Bello', id: 'PAA-2024-0089', class: 'JSS 1A', billed: 45000, paid: 30000, balance: 15000, method: 'Bank Transfer', date: '2026-09-25', txnRef: 'TXN-77312' },
    { receipt: 'REC-2025-004', student: 'Yusuf Ahmed', id: 'PAA-2023-0104', class: 'Primary 3', billed: 40000, paid: 40000, balance: 0, method: 'Cash Deposit', date: '2026-09-24', txnRef: 'TXN-66102' }
  ];

  document.addEventListener('DOMContentLoaded', () => {
    renderTables();
  });

  function switchSection(sec) {
    document.querySelectorAll('.finance-section').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.sidebar-nav .nav-item').forEach(el => el.classList.remove('active'));

    const targetSec = document.getElementById(`sec-${sec}`);
    if (targetSec) targetSec.style.display = 'block';

    const targetNav = document.getElementById(`nav-${sec}`);
    if (targetNav) targetNav.classList.add('active');

    document.getElementById('sectionBreadcrumb').textContent = sec.charAt(0).toUpperCase() + sec.slice(1);
  }

  function renderTables() {
    // Overview Table
    const overviewBody = document.getElementById('overviewPaymentsTable');
    overviewBody.innerHTML = paymentsList.map(p => `
      <tr>
        <td><code>${p.receipt}</code></td>
        <td><strong>${p.student}</strong></td>
        <td><code>${p.id}</code></td>
        <td><strong style="color:var(--color-success);">₦${p.paid.toLocaleString()}</strong></td>
        <td><span class="badge badge-info">${p.method}</span></td>
        <td>${p.date}</td>
        <td class="text-right">
          <button class="btn btn-secondary btn-sm" onclick="showReceiptModal('${p.receipt}')">Receipt</button>
        </td>
      </tr>
    `).join('');

    // Student Accounts Table
    const accountsBody = document.getElementById('studentAccountsBody');
    accountsBody.innerHTML = paymentsList.map(p => {
      const statusBadge = p.balance === 0 ? '<span class="badge badge-success">Fully Paid</span>' : '<span class="badge badge-warning">Partially Paid</span>';
      return `
        <tr>
          <td><strong>${p.student}</strong></td>
          <td><code>${p.id}</code></td>
          <td>${p.class}</td>
          <td>₦${p.billed.toLocaleString()}</td>
          <td style="color:var(--color-success);font-weight:700;">₦${p.paid.toLocaleString()}</td>
          <td style="color:${p.balance > 0 ? 'var(--color-danger)' : 'var(--color-text-muted)'};font-weight:700;">₦${p.balance.toLocaleString()}</td>
          <td>${statusBadge}</td>
          <td class="text-right">
            <button class="btn btn-secondary btn-sm" onclick="showStudentAccountModal('${p.id}')">View Account</button>
          </td>
        </tr>
      `;
    }).join('');

    // Receipts Table
    const receiptsBody = document.getElementById('receiptsTableBody');
    receiptsBody.innerHTML = paymentsList.map(p => `
      <tr>
        <td><code>${p.receipt}</code></td>
        <td><strong>${p.student} (${p.id})</strong></td>
        <td><strong style="color:var(--color-success);">₦${p.paid.toLocaleString()}</strong></td>
        <td><span class="badge badge-info">${p.method}</span></td>
        <td>${p.date}</td>
        <td class="text-right">
          <button class="btn btn-secondary btn-sm" onclick="showReceiptModal('${p.receipt}')">🖨️ View Receipt</button>
        </td>
      </tr>
    `).join('');
  }

  function recordPayment(e) {
    e.preventDefault();
    const stdId = document.getElementById('payStudentId')?.value || document.getElementById('modalPayStudentId')?.value;
    const amt = parseFloat(document.getElementById('payAmount')?.value || document.getElementById('modalPayAmount')?.value || 0);
    const method = document.getElementById('payMethod')?.value || document.getElementById('modalPayMethod')?.value;

    const receiptNo = 'REC-2025-' + String(paymentsList.length + 1).padStart(3, '0');
    const newTxn = {
      receipt: receiptNo,
      student: `Student (${stdId})`,
      id: stdId,
      class: 'JSS 2A',
      billed: amt,
      paid: amt,
      balance: 0,
      method: method,
      date: new Date().toISOString().split('T')[0],
      txnRef: 'TXN-' + Math.floor(100000 + Math.random() * 900000)
    };

    paymentsList.unshift(newTxn);
    Toast.success('Payment Successful', `Receipt generated: ${receiptNo}`);

    Modal.close('paymentModal');
    renderTables();
    showReceiptModal(receiptNo);
  }

  function showReceiptModal(receiptNo) {
    const p = paymentsList.find(item => item.receipt === receiptNo) || paymentsList[0];
    const box = document.getElementById('receiptBoxContent');

    box.innerHTML = `
      <div class="receipt-header">
        <h2 style="margin:0;">PLAN AID ACADEMY</h2>
        <div style="font-size:0.8rem;margin-top:4px;">A.U Tetengi House, Jos, Plateau State</div>
        <div style="font-size:0.85rem;font-weight:bold;margin-top:8px;">OFFICIAL FEE RECEIPT</div>
      </div>
      <div class="receipt-row"><span>Receipt No:</span><strong>${p.receipt}</strong></div>
      <div class="receipt-row"><span>Transaction Ref:</span><span>${p.txnRef}</span></div>
      <div class="receipt-row"><span>Date:</span><span>${p.date}</span></div>
      <div class="receipt-row"><span>Student Name:</span><strong>${p.student}</strong></div>
      <div class="receipt-row"><span>Admission / ID:</span><span>${p.id}</span></div>
      <div class="receipt-row"><span>Class Track:</span><span>${p.class}</span></div>
      <hr style="border:1px dashed #0f172a;margin:12px 0;">
      <div class="receipt-row"><span>Term Tuition &amp; Fees:</span><span>₦${p.billed.toLocaleString()}</span></div>
      <div class="receipt-row"><span>Amount Paid:</span><strong style="font-size:1.1rem;color:#10b981;">₦${p.paid.toLocaleString()}</strong></div>
      <div class="receipt-row"><span>Outstanding Balance:</span><span>₦${p.balance.toLocaleString()}</span></div>
      <div class="receipt-row"><span>Payment Method:</span><span>${p.method}</span></div>
      <hr style="border:1px dashed #0f172a;margin:12px 0;">
      <div style="text-align:center;font-size:0.75rem;margin-top:12px;">Thank you for your prompt payment!</div>
    `;

    Modal.open('receiptModal');
  }

  function showStudentAccountModal(studentId) {
    const p = paymentsList.find(item => item.id === studentId) || paymentsList[0];
    const box = document.getElementById('studentAccountContent');

    box.innerHTML = `
      <div style="margin-bottom:var(--space-4);">
        <h3>${p.student}</h3>
        <div class="text-xs text-muted">ID: <code>${p.id}</code> · Class: ${p.class}</div>
      </div>
      <div class="grid gap-3 grid-cols-3 mb-6" style="text-align:center;">
        <div style="padding:var(--space-3);background:var(--color-bg-elevated);border-radius:var(--radius-md);">
          <div class="text-xs text-muted">Total Billed</div>
          <div class="font-bold">₦${p.billed.toLocaleString()}</div>
        </div>
        <div style="padding:var(--space-3);background:var(--color-bg-elevated);border-radius:var(--radius-md);">
          <div class="text-xs text-muted">Total Paid</div>
          <div class="font-bold" style="color:var(--color-success);">₦${p.paid.toLocaleString()}</div>
        </div>
        <div style="padding:var(--space-3);background:var(--color-bg-elevated);border-radius:var(--radius-md);">
          <div class="text-xs text-muted">Outstanding</div>
          <div class="font-bold" style="color:${p.balance > 0 ? 'var(--color-danger)' : 'var(--color-text-muted)'};">₦${p.balance.toLocaleString()}</div>
        </div>
      </div>
      <h4>Payment Transaction History</h4>
      <div class="table-wrapper">
        <table class="table text-xs">
          <thead>
            <tr><th>Date</th><th>Ref</th><th>Method</th><th>Amount</th></tr>
          </thead>
          <tbody>
            <tr><td>${p.date}</td><td><code>${p.txnRef}</code></td><td>${p.method}</td><td>₦${p.paid.toLocaleString()}</td></tr>
          </tbody>
        </table>
      </div>
    `;

    Modal.open('studentAccountModal');
  }

  function generateReport(reportName) {
    Toast.success('Report Generated', `Successfully compiled ${reportName}. Opening print summary.`);
  }
</script>
</body>
</html>
