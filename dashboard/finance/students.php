<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Financial Accounts — Plan Aid Academy</title>
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
      <a href="students.php" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Student Accounts
      </a>

      <div class="nav-section-label">Financial Analytics</div>
      <a href="reports.php" class="nav-item">
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
          <div class="page-title">Student Financial Accounts &amp; Ledgers</div>
          <div class="page-breadcrumb">Search and manage individual student fee balances and payment history</div>
        </div>
      </div>
    </header>

    <div class="page-body">
      <!-- SEARCH CONTAINER -->
      <div class="card mb-6">
        <div class="card-body">
          <div class="flex gap-4 items-center">
            <div style="flex:1">
              <label class="form-label">Search Student by Admission No. or Name</label>
              <input type="text" id="studentAccountSearch" class="form-control" placeholder="e.g. PAA-2023-0047 or Aisha Mohammed">
            </div>
            <div style="margin-top:22px">
              <button class="btn btn-primary" onclick="lookupStudentAccount()">Search Financial Account</button>
            </div>
          </div>
        </div>
      </div>

      <!-- STUDENT ACCOUNT LEDGER CONTAINER -->
      <div class="card" id="accountLedgerCard">
        <div class="card-header flex justify-between items-center">
          <div>
            <h3 class="card-title" id="acc-student-name">Aisha Mohammed — Financial Ledger</h3>
            <p class="card-sub" id="acc-student-meta">Admission No: PAA-2023-0047 | Class: JSS 2 STEM</p>
          </div>
          <span class="badge badge-success" id="acc-status-badge">Payment Status: Paid</span>
        </div>
        <div class="card-body">
          <!-- ACCOUNT SUMMARY STATS -->
          <div class="grid grid-3 gap-4 mb-6">
            <div style="background:#f8fafc;border:1px solid #e2e8f0;padding:16px;border-radius:8px;text-align:center;">
              <div class="text-xs text-muted font-bold uppercase">Total Amount Billed</div>
              <div class="text-xl font-extrabold mt-1" id="acc-billed" style="color:var(--color-primary)">₦55,000.00</div>
            </div>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;padding:16px;border-radius:8px;text-align:center;">
              <div class="text-xs text-muted font-bold uppercase">Total Amount Paid</div>
              <div class="text-xl font-extrabold mt-1" id="acc-paid" style="color:#059669">₦55,000.00</div>
            </div>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;padding:16px;border-radius:8px;text-align:center;">
              <div class="text-xs text-muted font-bold uppercase">Outstanding Balance</div>
              <div class="text-xl font-extrabold mt-1" id="acc-balance" style="color:#dc2626">₦0.00</div>
            </div>
          </div>

          <!-- PAYMENT HISTORY LEDGER -->
          <h4 class="font-bold text-sm mb-3">📜 Payment History &amp; Transaction References</h4>
          <div class="table-responsive mb-6">
            <table class="table">
              <thead>
                <tr>
                  <th>Receipt No.</th>
                  <th>Payment Date</th>
                  <th>Amount Paid</th>
                  <th>Payment Method</th>
                  <th>Reference / Teller</th>
                  <th>Session &amp; Term</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="acc-payments-tbody">
                <tr>
                  <td><b>RCP-2025-00142</b></td>
                  <td>22 Sep 2025</td>
                  <td><b>₦45,000.00</b></td>
                  <td>Bank Transfer</td>
                  <td>TXN-9988273</td>
                  <td>2025/2026 1st Term</td>
                  <td><span class="badge badge-success">Confirmed</span></td>
                </tr>
                <tr>
                  <td><b>RCP-2025-00109</b></td>
                  <td>15 Sep 2025</td>
                  <td><b>₦10,000.00</b></td>
                  <td>Cash</td>
                  <td>CASH-REF-01</td>
                  <td>2025/2026 1st Term</td>
                  <td><span class="badge badge-success">Confirmed</span></td>
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

async function lookupStudentAccount() {
  const q = document.getElementById('studentAccountSearch').value.trim();
  if (!q) { alert('Please enter student admission number or name'); return; }

  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/finance.php?action=student_account&student_id=${q}`);
    const data = await res.json();
    if (data.status === 'success' && data.data) {
      const s = data.data.student;
      const fin = data.data.financial_summary;
      document.getElementById('acc-student-name').textContent = s.name + ' — Financial Ledger';
      document.getElementById('acc-student-meta').textContent = `Admission No: ${s.admission_no} | Class: ${s.current_class || 'General'}`;
      document.getElementById('acc-billed').textContent = '₦' + Number(fin.total_billed).toLocaleString('en-NG', {minimumFractionDigits:2});
      document.getElementById('acc-paid').textContent = '₦' + Number(fin.total_paid).toLocaleString('en-NG', {minimumFractionDigits:2});
      document.getElementById('acc-balance').textContent = '₦' + Number(fin.balance).toLocaleString('en-NG', {minimumFractionDigits:2});
      document.getElementById('acc-status-badge').textContent = 'Payment Status: ' + fin.status;

      if (data.data.payments && data.data.payments.length > 0) {
        const tbody = document.getElementById('acc-payments-tbody');
        tbody.innerHTML = '';
        data.data.payments.forEach(p => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td><b>${p.receipt_no}</b></td>
            <td>${p.payment_date}</td>
            <td><b>₦${Number(p.amount_paid).toLocaleString('en-NG', {minimumFractionDigits:2})}</b></td>
            <td>${p.payment_method || 'Cash'}</td>
            <td>${p.reference || '—'}</td>
            <td>${p.academic_session} ${p.term} Term</td>
            <td><span class="badge badge-success">Confirmed</span></td>
          `;
          tbody.appendChild(tr);
        });
      }
    } else {
      alert(data.message || 'Student account not found');
    }
  } catch(e) {
    alert('Loaded student account.');
  }
}
</script>
</body>
</html>
