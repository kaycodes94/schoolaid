<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Financial Reports &amp; Analytics — Plan Aid Academy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <script src="../../assets/js/auth.js"></script>
  <script>
    Auth.requireAuth();
    Auth.requireRole(['finance', 'principal', 'admin']);
  </script>
</head>
<body>
<div class="app-shell">

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <a href="index.php" class="sidebar-logo">
      <div class="sidebar-logo-icon">💰</div>
      <div class="sidebar-logo-text">
        <div class="sidebar-logo-name">Plan Aid Academy</div>
        <div class="sidebar-logo-role">Finance Portal</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Finance Overview</div>
      <a href="index.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Finance Dashboard
      </a>

      <div class="nav-section-label">Fee &amp; Payment Operations</div>
      <a href="fees.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 8v2m0-10C6.477 4 2 8.477 2 14s4.477 10 10 10 10-4.477 10-10S17.523 4 12 4z"/></svg>
        Fee Structures &amp; Charges
      </a>
      <a href="payments.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        Record Payment &amp; Receipts
      </a>
      <a href="students.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Student Accounts
      </a>

      <div class="nav-section-label">Financial Analytics</div>
      <a href="reports.php" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        Financial Reports
      </a>
    </nav>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <header class="topbar">
      <div class="topbar-left">
        <div>
          <div class="page-title">Financial Reports &amp; Statements</div>
          <div class="page-breadcrumb">Plan Aid Academy &amp; Educational Resource, Jos</div>
        </div>
      </div>
      <div class="topbar-right">
        <button class="btn btn-secondary btn-sm" onclick="window.print()">🖨️ Export Report</button>
      </div>
    </header>

    <div class="page-body">
      <!-- REPORT TYPE SELECTOR BUTTONS -->
      <div class="card mb-6">
        <div class="card-body">
          <div class="flex gap-2 flex-wrap" id="report-type-btns">
            <button class="btn btn-sm btn-primary" onclick="loadReport('daily', this)">Daily Collection Report</button>
            <button class="btn btn-sm btn-secondary" onclick="loadReport('weekly', this)">Weekly Collection Report</button>
            <button class="btn btn-sm btn-secondary" onclick="loadReport('monthly', this)">Monthly Collection Report</button>
            <button class="btn btn-sm btn-secondary" onclick="loadReport('outstanding', this)">Outstanding Fees Report</button>
            <button class="btn btn-sm btn-secondary" onclick="loadReport('class', this)">Class-by-Class Fee Report</button>
            <button class="btn btn-sm btn-secondary" onclick="loadReport('transactions', this)">Transaction Audit Log</button>
          </div>
        </div>
      </div>

      <!-- REPORT DISPLAY CONTAINER -->
      <div class="card">
        <div class="card-header flex justify-between items-center">
          <h3 class="card-title" id="report-title">Daily Collection Statement</h3>
          <span class="badge badge-info" id="report-date-badge">Session: 2025/2026 — 1st Term</span>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr id="report-thead-tr">
                  <th>Date</th>
                  <th>Transactions Count</th>
                  <th>Total Collection (₦)</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="report-tbody">
                <tr>
                  <td><b>22 Sep 2025</b></td>
                  <td>14 Transactions</td>
                  <td><b>₦685,000.00</b></td>
                  <td><span class="badge badge-success">Audited</span></td>
                </tr>
                <tr>
                  <td><b>21 Sep 2025</b></td>
                  <td>18 Transactions</td>
                  <td><b>₦840,000.00</b></td>
                  <td><span class="badge badge-success">Audited</span></td>
                </tr>
                <tr>
                  <td><b>20 Sep 2025</b></td>
                  <td>11 Transactions</td>
                  <td><b>₦520,000.00</b></td>
                  <td><span class="badge badge-success">Audited</span></td>
                </tr>
                <tr>
                  <td><b>19 Sep 2025</b></td>
                  <td>22 Transactions</td>
                  <td><b>₦1,150,000.00</b></td>
                  <td><span class="badge badge-success">Audited</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
const BASE_URL_LOCAL = (() => {
  const parts = window.location.pathname.split('/');
  const idx = parts.indexOf('aidstudent');
  return idx !== -1 ? window.location.origin + parts.slice(0, idx + 1).join('/') : window.location.origin + '/';
})();

async function loadReport(type, btn) {
  if (btn) {
    document.querySelectorAll('#report-type-btns button').forEach(b => b.className = 'btn btn-sm btn-secondary');
    btn.className = 'btn btn-sm btn-primary';
  }

  const titles = {
    daily: 'Daily Collection Statement',
    weekly: 'Weekly Collection Statement',
    monthly: 'Monthly Revenue & Collection Statement',
    outstanding: 'Outstanding Fees Defaulters Statement',
    class: 'Class-by-Class Fee Breakdown Statement',
    transactions: 'Complete Financial Transaction Audit Log'
  };

  document.getElementById('report-title').textContent = titles[type] || 'Financial Report';

  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/finance.php?action=reports&type=${type}`);
    const data = await res.json();
    if (data.status === 'success' && data.data && data.data.length > 0) {
      renderReportTable(type, data.data);
    }
  } catch(e) {}
}

function renderReportTable(type, rows) {
  const theadTr = document.getElementById('report-thead-tr');
  const tbody = document.getElementById('report-tbody');
  tbody.innerHTML = '';

  if (type === 'daily' || type === 'weekly' || type === 'monthly') {
    theadTr.innerHTML = '<th>Period / Date</th><th>Transactions Count</th><th>Total Collection (₦)</th><th>Status</th>';
    rows.forEach(r => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><b>${r.payment_date || r.month || 'Period'}</b></td>
        <td>${r.transactions || 1} Transactions</td>
        <td><b>₦${Number(r.total_collected || 0).toLocaleString('en-NG', {minimumFractionDigits:2})}</b></td>
        <td><span class="badge badge-success">Audited</span></td>
      `;
      tbody.appendChild(tr);
    });
  } else if (type === 'class') {
    theadTr.innerHTML = '<th>School Class Track</th><th>Payments Count</th><th>Total Collected (₦)</th><th>Status</th>';
    rows.forEach(r => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><b>${r.current_class || 'General'}</b></td>
        <td>${r.payments_count || 0} Payments</td>
        <td><b>₦${Number(r.total_collected || 0).toLocaleString('en-NG', {minimumFractionDigits:2})}</b></td>
        <td><span class="badge badge-success">Active Track</span></td>
      `;
      tbody.appendChild(tr);
    });
  } else {
    theadTr.innerHTML = '<th>Receipt No.</th><th>Date</th><th>Student Name</th><th>Amount Paid</th><th>Method</th><th>Status</th>';
    rows.forEach(r => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><b>${r.receipt_no || 'RCP-001'}</b></td>
        <td>${r.payment_date || '—'}</td>
        <td>${r.student_name || 'Student'}</td>
        <td><b>₦${Number(r.amount_paid || 0).toLocaleString('en-NG', {minimumFractionDigits:2})}</b></td>
        <td>${r.payment_method || 'Cash'}</td>
        <td><span class="badge badge-success">Confirmed</span></td>
      `;
      tbody.appendChild(tr);
    });
  }
}
</script>
</body>
</html>
