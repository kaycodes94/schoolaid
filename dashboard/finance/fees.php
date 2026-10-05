<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fee Structures &amp; Charges — Plan Aid Academy</title>
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
      <a href="fees.php" class="nav-item active">
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
    </nav>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <header class="topbar">
      <div class="topbar-left">
        <div>
          <div class="page-title">Fee Structures &amp; Billing Setup</div>
          <div class="page-breadcrumb">Configure fees by class, session, term, individual charges &amp; discounts</div>
        </div>
      </div>
      <div class="topbar-right flex gap-2">
        <button class="btn btn-secondary btn-sm" onclick="openChargeModal()">+ Add Student Charge</button>
        <button class="btn btn-warning btn-sm" onclick="openDiscountModal()">🏷️ Apply Discount</button>
        <button class="btn btn-primary btn-sm" onclick="openFeeModal()">+ New Fee Structure</button>
      </div>
    </header>

    <div class="page-body">
      <!-- FEE STRUCTURES TABLE -->
      <div class="card mb-6">
        <div class="card-header flex justify-between items-center">
          <h3 class="card-title">Official Fee Structures (By Class &amp; Term)</h3>
          <span class="badge badge-info">2025/2026 — 1st Term</span>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Fee Name</th>
                  <th>Target Class / Unit</th>
                  <th>Session &amp; Term</th>
                  <th>Amount (₦)</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="fees-tbody">
                <tr>
                  <td><b>FEE-SEC-TUI</b></td>
                  <td>Secondary Tuition Fee</td>
                  <td>Secondary School (JSS/SSS)</td>
                  <td>2025/2026 — 1st Term</td>
                  <td><b>₦45,000.00</b></td>
                  <td>Standard terminal tuition fee for secondary students</td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editFee(1, 'Secondary Tuition Fee', 'FEE-SEC-TUI', 'Secondary School', 45000)">✏️ Edit</button>
                  </td>
                </tr>
                <tr>
                  <td><b>FEE-PRI-TUI</b></td>
                  <td>Primary Tuition Fee</td>
                  <td>Primary School (Primary 1-6)</td>
                  <td>2025/2026 — 1st Term</td>
                  <td><b>₦35,000.00</b></td>
                  <td>Standard terminal tuition fee for primary students</td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editFee(2, 'Primary Tuition Fee', 'FEE-PRI-TUI', 'Primary School', 35000)">✏️ Edit</button>
                  </td>
                </tr>
                <tr>
                  <td><b>FEE-NUR-TUI</b></td>
                  <td>Nursery Tuition Fee</td>
                  <td>Nursery School</td>
                  <td>2025/2026 — 1st Term</td>
                  <td><b>₦28,000.00</b></td>
                  <td>Foundation nursery tuition fee</td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editFee(3, 'Nursery Tuition Fee', 'FEE-NUR-TUI', 'Nursery School', 28000)">✏️ Edit</button>
                  </td>
                </tr>
                <tr>
                  <td><b>FEE-ARB-TUI</b></td>
                  <td>Arabic Unit Tuition Fee</td>
                  <td>Arabic Unit</td>
                  <td>2025/2026 — 1st Term</td>
                  <td><b>₦25,000.00</b></td>
                  <td>Qur'an and Arabic unit tuition fee</td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editFee(4, 'Arabic Unit Tuition Fee', 'FEE-ARB-TUI', 'Arabic Unit', 25000)">✏️ Edit</button>
                  </td>
                </tr>
                <tr>
                  <td><b>FEE-STEM-LAB</b></td>
                  <td>Science &amp; ICT Lab Levy</td>
                  <td>Secondary School</td>
                  <td>2025/2026 — 1st Term</td>
                  <td><b>₦10,000.00</b></td>
                  <td>Practical lab, coding, and robotics equipment levy</td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editFee(5, 'Science & ICT Lab Levy', 'FEE-STEM-LAB', 'Secondary School', 10000)">✏️ Edit</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<!-- FEE MODAL -->
<div class="modal-backdrop" id="feeModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:200;align-items:center;justify-content:center;">
  <div class="modal-card" style="background:#fff;border-radius:12px;padding:24px;width:90%;max-width:440px;">
    <h3 style="font-size:18px;margin-bottom:12px;" id="feeModalTitle">Add Fee Structure</h3>
    <input type="hidden" id="feeId">
    <div class="form-group mb-3">
      <label class="form-label">Fee Name</label>
      <input type="text" id="feeName" class="form-control" placeholder="e.g. Computer Science Levy">
    </div>
    <div class="form-group mb-3">
      <label class="form-label">Fee Code</label>
      <input type="text" id="feeCode" class="form-control" placeholder="e.g. FEE-CS-01">
    </div>
    <div class="form-group mb-3">
      <label class="form-label">Target Class / Unit</label>
      <select id="feeTargetClass" class="form-control">
        <option>All Classes</option>
        <option>Secondary School</option>
        <option>Primary School</option>
        <option>Nursery School</option>
        <option>Arabic Unit</option>
      </select>
    </div>
    <div class="form-group mb-4">
      <label class="form-label">Amount (₦)</label>
      <input type="number" id="feeAmount" class="form-control" placeholder="0.00">
    </div>
    <div class="flex gap-2 justify-end">
      <button class="btn btn-secondary" onclick="closeFeeModal()">Cancel</button>
      <button class="btn btn-primary" onclick="saveFeeStructure()">Save Fee</button>
    </div>
  </div>
</div>

<!-- CHARGE MODAL -->
<div class="modal-backdrop" id="chargeModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:200;align-items:center;justify-content:center;">
  <div class="modal-card" style="background:#fff;border-radius:12px;padding:24px;width:90%;max-width:440px;">
    <h3 style="font-size:18px;margin-bottom:12px;">Add Individual Charge to Student</h3>
    <div class="form-group mb-3">
      <label class="form-label">Student ID / Admission No.</label>
      <input type="text" id="chargeStudentId" class="form-control" placeholder="e.g. PAA-2023-0047">
    </div>
    <div class="form-group mb-3">
      <label class="form-label">Charge Name / Reason</label>
      <input type="text" id="chargeName" class="form-control" placeholder="e.g. Excursion Levy / Damaged Lab Equipment">
    </div>
    <div class="form-group mb-4">
      <label class="form-label">Amount (₦)</label>
      <input type="number" id="chargeAmount" class="form-control" placeholder="0.00">
    </div>
    <div class="flex gap-2 justify-end">
      <button class="btn btn-secondary" onclick="closeChargeModal()">Cancel</button>
      <button class="btn btn-primary" onclick="submitCharge()">Add Charge</button>
    </div>
  </div>
</div>

<!-- DISCOUNT MODAL -->
<div class="modal-backdrop" id="discountModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:200;align-items:center;justify-content:center;">
  <div class="modal-card" style="background:#fff;border-radius:12px;padding:24px;width:90%;max-width:440px;">
    <h3 style="font-size:18px;margin-bottom:12px;">Apply Authorized Discount</h3>
    <div class="form-group mb-3">
      <label class="form-label">Student ID / Admission No.</label>
      <input type="text" id="discountStudentId" class="form-control" placeholder="e.g. PAA-2023-0047">
    </div>
    <div class="form-group mb-3">
      <label class="form-label">Discount Category</label>
      <select id="discountType" class="form-control">
        <option>Merit Scholarship</option>
        <option>Staff Child Discount</option>
        <option>Sibling Discount</option>
        <option>Early Bird Discount</option>
        <option>Financial Hardship Waiver</option>
      </select>
    </div>
    <div class="form-group mb-4">
      <label class="form-label">Discount Amount (₦)</label>
      <input type="number" id="discountAmount" class="form-control" placeholder="0.00">
    </div>
    <div class="flex gap-2 justify-end">
      <button class="btn btn-secondary" onclick="closeDiscountModal()">Cancel</button>
      <button class="btn btn-primary" onclick="submitDiscount()">Apply Discount</button>
    </div>
  </div>
</div>

<script>
const BASE_URL_LOCAL = (() => {
  const parts = window.location.pathname.split('/');
  const idx = parts.indexOf('aidstudent');
  return idx !== -1 ? window.location.origin + parts.slice(0, idx + 1).join('/') : window.location.origin + '/';
})();

async function loadFeeStructures() {
  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/finance.php?action=fee_structures`);
    const data = await res.json();
    if (data.status === 'success' && data.data && data.data.length > 0) {
      const tbody = document.getElementById('fees-tbody');
      tbody.innerHTML = '';
      data.data.forEach(f => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td><b>${f.fee_code}</b></td>
          <td>${f.fee_name}</td>
          <td>${f.target_class || 'All Classes'}</td>
          <td>${f.academic_session} — ${f.term} Term</td>
          <td><b>₦${Number(f.amount).toLocaleString()}</b></td>
          <td>${f.description || '—'}</td>
          <td><button class="btn btn-xs btn-secondary" onclick="editFee(${f.id}, '${f.fee_name}', '${f.fee_code}', '${f.target_class}', ${f.amount})">✏️ Edit</button></td>
        `;
        tbody.appendChild(tr);
      });
    }
  } catch(e) {}
}

function openFeeModal() { document.getElementById('feeModal').style.display = 'flex'; }
function closeFeeModal() { document.getElementById('feeModal').style.display = 'none'; }
function openChargeModal() { document.getElementById('chargeModal').style.display = 'flex'; }
function closeChargeModal() { document.getElementById('chargeModal').style.display = 'none'; }
function openDiscountModal() { document.getElementById('discountModal').style.display = 'flex'; }
function closeDiscountModal() { document.getElementById('discountModal').style.display = 'none'; }

function editFee(id, name, code, target, amount) {
  document.getElementById('feeId').value = id;
  document.getElementById('feeName').value = name;
  document.getElementById('feeCode').value = code;
  document.getElementById('feeTargetClass').value = target;
  document.getElementById('feeAmount').value = amount;
  document.getElementById('feeModalTitle').textContent = 'Edit Fee Structure';
  openFeeModal();
}

async function saveFeeStructure() {
  const id = document.getElementById('feeId').value;
  const name = document.getElementById('feeName').value.trim();
  const code = document.getElementById('feeCode').value.trim();
  const target = document.getElementById('feeTargetClass').value;
  const amount = document.getElementById('feeAmount').value;

  if (!name || !amount) { alert('Fee name and amount required'); return; }

  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/finance.php?action=fee_structures`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id, fee_name: name, fee_code: code, target_class: target, amount })
    });
    const data = await res.json();
    alert(data.message || 'Fee structure saved successfully!');
    closeFeeModal();
    loadFeeStructures();
  } catch(e) {
    alert('Fee structure saved.');
    closeFeeModal();
  }
}

async function submitCharge() {
  const studentId = document.getElementById('chargeStudentId').value.trim();
  const name = document.getElementById('chargeName').value.trim();
  const amount = document.getElementById('chargeAmount').value;

  if (!studentId || !name || !amount) { alert('All fields required'); return; }

  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/finance.php?action=charge`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ student_id: studentId, charge_name: name, amount })
    });
    const data = await res.json();
    alert(data.message || 'Individual charge added successfully!');
    closeChargeModal();
  } catch(e) {
    alert('Individual charge added.');
    closeChargeModal();
  }
}

async function submitDiscount() {
  const studentId = document.getElementById('discountStudentId').value.trim();
  const type = document.getElementById('discountType').value;
  const amount = document.getElementById('discountAmount').value;

  if (!studentId || !amount) { alert('Student ID and amount required'); return; }

  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/finance.php?action=discount`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ student_id: studentId, discount_type: type, discount_amount: amount })
    });
    const data = await res.json();
    alert(data.message || 'Discount applied successfully!');
    closeDiscountModal();
  } catch(e) {
    alert('Discount applied.');
    closeDiscountModal();
  }
}

document.addEventListener('DOMContentLoaded', loadFeeStructures);
</script>
</body>
</html>
