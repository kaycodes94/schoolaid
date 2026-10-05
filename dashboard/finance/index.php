<?php
require_once __DIR__ . '/../../includes/Helpers.php';
AuthHelper::requireRole(['finance', 'principal', 'admin']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finance Dashboard — Plan Aid Academy</title>
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
      <a href="index.php" class="nav-item active">
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
      <a href="reports.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        Financial Reports
      </a>

      <a href="#" class="nav-item mt-6" style="color:var(--color-danger);" data-logout>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sign Out
      </a>
    </nav>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <header class="topbar">
      <div class="topbar-left">
        <div>
          <div class="page-title">Finance &amp; Accounts Dashboard</div>
          <div class="page-breadcrumb">Plan Aid Academy &amp; Educational Resource, Jos</div>
        </div>
      </div>
      <div class="topbar-right">
        <a href="payments.php" class="btn btn-primary btn-sm">+ Record Payment</a>
      </div>
    </header>

    <div class="page-body">
      <!-- STATS METRICS GRID -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(30,58,138,0.1);color:var(--color-primary);">📄</div>
          <div class="stat-info">
            <div class="stat-value" id="stat-billed">₦18,400,000</div>
            <div class="stat-label">Total Fees Billed</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(16,185,129,0.1);color:#059669;">💰</div>
          <div class="stat-info">
            <div class="stat-value" id="stat-collected" style="color:#059669;">₦14,100,000</div>
            <div class="stat-label">Total Amount Collected</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(239,68,68,0.1);color:#dc2626;">⚠️</div>
          <div class="stat-info">
            <div class="stat-value" id="stat-outstanding" style="color:#dc2626;">₦4,300,000</div>
            <div class="stat-label">Outstanding Fees</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(245,158,11,0.15);color:#d97706;">👥</div>
          <div class="stat-info">
            <div class="stat-value" id="stat-unpaid-count">24</div>
            <div class="stat-label">Students with Unpaid Fees</div>
          </div>
        </div>
      </div>

      <div class="grid grid-2 mt-6">
        <!-- RECENT PAYMENTS -->
        <div class="card">
          <div class="card-header flex justify-between items-center">
            <h3 class="card-title">💳 Recent Payment Transactions</h3>
            <a href="payments.php" class="text-xs text-primary font-semibold">View All →</a>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Receipt No.</th>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Amount Paid</th>
                    <th>Method</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody id="recent-payments-tbody">
                  <tr>
                    <td><b>RCP-2025-0241</b></td>
                    <td>Ibrahim Hassan</td>
                    <td>SSS 2</td>
                    <td><b>₦65,000</b></td>
                    <td>Bank Transfer</td>
                    <td><span class="badge badge-success">Confirmed</span></td>
                  </tr>
                  <tr>
                    <td><b>RCP-2025-0242</b></td>
                    <td>Blessing Musa</td>
                    <td>JSS 1A</td>
                    <td><b>₦45,000</b></td>
                    <td>Cash</td>
                    <td><span class="badge badge-success">Confirmed</span></td>
                  </tr>
                  <tr>
                    <td><b>RCP-2025-0243</b></td>
                    <td>Fatima Yusuf</td>
                    <td>Primary 5</td>
                    <td><b>₦38,000</b></td>
                    <td>Bank Transfer</td>
                    <td><span class="badge badge-warning">Part</span></td>
                  </tr>
                  <tr>
                    <td><b>RCP-2025-0244</b></td>
                    <td>John Dakyen</td>
                    <td>Nursery 2</td>
                    <td><b>₦30,000</b></td>
                    <td>POS / Card</td>
                    <td><span class="badge badge-success">Confirmed</span></td>
                  </tr>
                  <tr>
                    <td><b>RCP-2025-0245</b></td>
                    <td>Amina Abdullahi</td>
                    <td>Arabic Adv.</td>
                    <td><b>₦25,000</b></td>
                    <td>Cash</td>
                    <td><span class="badge badge-success">Confirmed</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- PAYMENT METHOD BREAKDOWN & SUMMARY -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">📊 Collection Statistics</h3>
          </div>
          <div class="card-body">
            <div class="mb-4">
              <div class="flex justify-between text-xs mb-1">
                <span class="font-bold">Overall Collection Rate</span>
                <span class="font-bold" id="collection-rate-val">76.6%</span>
              </div>
              <div style="height:10px;background:#e2e8f0;border-radius:5px;overflow:hidden;">
                <div style="width:76.6%;height:100%;background:var(--color-success);border-radius:5px;"></div>
              </div>
            </div>

            <h4 class="font-bold text-xs uppercase text-muted mb-3">Payment Methods Distribution</h4>
            <div class="flex flex-col gap-3">
              <div class="flex justify-between items-center text-xs">
                <span>🏦 Bank Transfer</span>
                <b>₦8,200,000 (58%)</b>
              </div>
              <div class="flex justify-between items-center text-xs">
                <span>💵 Cash Payments</span>
                <b>₦4,500,000 (32%)</b>
              </div>
              <div class="flex justify-between items-center text-xs">
                <span>💳 POS / Card Payments</span>
                <b>₦1,400,000 (10%)</b>
              </div>
            </div>

            <div class="mt-6 pt-4 border-t flex gap-2">
              <a href="students.php" class="btn btn-secondary btn-sm flex-1" style="text-align:center;">🔍 Search Student Account</a>
              <a href="reports.php" class="btn btn-primary btn-sm flex-1" style="text-align:center;">📊 Generate Financial Report</a>
            </div>
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

async function loadFinanceSummary() {
  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/finance.php?action=summary`);
    const data = await res.json();
    if (data.status === 'success' && data.data) {
      const d = data.data;
      document.getElementById('stat-billed').textContent = '₦' + Number(d.total_billed).toLocaleString();
      document.getElementById('stat-collected').textContent = '₦' + Number(d.total_collected).toLocaleString();
      document.getElementById('stat-outstanding').textContent = '₦' + Number(d.outstanding_fees).toLocaleString();
      document.getElementById('stat-unpaid-count').textContent = d.unpaid_students_count;
      document.getElementById('collection-rate-val').textContent = d.collection_rate;

      if (d.recent_payments && d.recent_payments.length > 0) {
        const tbody = document.getElementById('recent-payments-tbody');
        tbody.innerHTML = '';
        d.recent_payments.forEach(p => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td><b>${p.receipt_no}</b></td>
            <td>${p.first_name} ${p.last_name}</td>
            <td>${p.current_class || '—'}</td>
            <td><b>₦${Number(p.amount_paid).toLocaleString()}</b></td>
            <td>${p.payment_method || 'Cash'}</td>
            <td><span class="badge badge-success">Confirmed</span></td>
          `;
          tbody.appendChild(tr);
        });
      }
    }
  } catch(e) {}
}

document.addEventListener('DOMContentLoaded', loadFinanceSummary);
</script>
</body>
</html>
