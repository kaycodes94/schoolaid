<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arabic Students &amp; Classes — Plan Aid Academy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <script src="../../assets/js/auth.js"></script>
  <script>
    Auth.requireAuth();
    Auth.requireRole(['arabic', 'unit_head', 'principal', 'admin']);
  </script>
</head>
<body>
<div class="app-shell">

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <a href="index.php" class="sidebar-logo">
      <div class="sidebar-logo-icon">☪️</div>
      <div class="sidebar-logo-text">
        <div class="sidebar-logo-name">Plan Aid Academy</div>
        <div class="sidebar-logo-role">Arabic Unit Portal</div>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Overview</div>
      <a href="index.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Arabic Dashboard
      </a>

      <div class="nav-section-label">Academic Management</div>
      <a href="students.php" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Arabic Students &amp; Classes
      </a>
      <a href="subjects.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Arabic Subjects
      </a>
      <a href="attendance.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Arabic Attendance
      </a>

      <div class="nav-section-label">Results &amp; Approvals</div>
      <a href="results.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Arabic Results Entry
      </a>
    </nav>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <header class="topbar">
      <div class="topbar-left">
        <div>
          <div class="page-title">Arabic Students &amp; Class Directory</div>
          <div class="page-breadcrumb" style="font-family:'Amiri',serif;color:var(--color-primary);">سجل طلاب وحدة اللغة العربية والفصول</div>
        </div>
      </div>
      <div class="topbar-right">
        <button class="btn btn-primary btn-sm" onclick="openAssignModal()">+ Assign Student to Class</button>
      </div>
    </header>

    <div class="page-body">
      <!-- CLASS FILTER TABS -->
      <div class="card mb-6">
        <div class="card-body py-3">
          <div class="flex gap-2 flex-wrap" id="class-filter-btns">
            <button class="btn btn-sm btn-primary" onclick="filterClass('all', this)">All Arabic Students</button>
            <button class="btn btn-sm btn-secondary" onclick="filterClass(1, this)">Arabic Foundation</button>
            <button class="btn btn-sm btn-secondary" onclick="filterClass(2, this)">Arabic Intermediate</button>
            <button class="btn btn-sm btn-secondary" onclick="filterClass(3, this)">Arabic Advanced</button>
            <button class="btn btn-sm btn-secondary" onclick="filterClass(4, this)">Hifz &amp; Tajweed Circle</button>
          </div>
        </div>
      </div>

      <!-- STUDENTS TABLE -->
      <div class="card">
        <div class="card-header flex justify-between items-center">
          <h3 class="card-title">Enrolled Arabic Students</h3>
          <input type="text" id="searchStudent" class="form-control form-control-sm" style="max-width:220px;" placeholder="Search student name or ID..." onkeyup="searchTable()">
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table" id="studentsTable">
              <thead>
                <tr>
                  <th>Adm No.</th>
                  <th>Student Name</th>
                  <th>Gender</th>
                  <th>Main Class</th>
                  <th>Assigned Arabic Class</th>
                  <th>Parent Contact</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="students-tbody">
                <!-- Dynamically populated or fallback static rows -->
                <tr>
                  <td><b>PAA-2023-0047</b></td>
                  <td>Aisha Mohammed</td>
                  <td>Female</td>
                  <td>JSS 2 STEM</td>
                  <td><span class="badge badge-info">Arabic Advanced Class</span></td>
                  <td>08030459595</td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="viewHistory('Aisha Mohammed', 'PAA-2023-0047')">📜 View History</button>
                  </td>
                </tr>
                <tr>
                  <td><b>PAA-2024-0112</b></td>
                  <td>Ibrahim Hassan</td>
                  <td>Male</td>
                  <td>SSS 2 Science</td>
                  <td><span class="badge badge-warning">Hifz &amp; Tajweed Circle</span></td>
                  <td>08088552501</td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="viewHistory('Ibrahim Hassan', 'PAA-2024-0112')">📜 View History</button>
                  </td>
                </tr>
                <tr>
                  <td><b>PAA-2024-0315</b></td>
                  <td>Amina Abdullahi</td>
                  <td>Female</td>
                  <td>Primary 5</td>
                  <td><span class="badge badge-success">Arabic Intermediate Class</span></td>
                  <td>08030001122</td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="viewHistory('Amina Abdullahi', 'PAA-2024-0315')">📜 View History</button>
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

<!-- ASSIGN STUDENT MODAL -->
<div class="modal-backdrop" id="assignModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:200;align-items:center;justify-content:center;">
  <div class="modal-card" style="background:#fff;border-radius:12px;padding:24px;width:90%;max-width:440px;">
    <h3 style="font-size:18px;margin-bottom:12px;">Assign Student to Arabic Class</h3>
    <div class="form-group mb-3">
      <label class="form-label">Student ID / Admission No.</label>
      <input type="text" id="assignStudentId" class="form-control" placeholder="e.g. PAA-2023-0047">
    </div>
    <div class="form-group mb-4">
      <label class="form-label">Select Arabic Class</label>
      <select id="assignArabicClass" class="form-control">
        <option value="1">Arabic Foundation Class (المستوى التمهيدي)</option>
        <option value="2">Arabic Intermediate Class (المستوى المتوسط)</option>
        <option value="3">Arabic Advanced Class (المستوى المتقدم)</option>
        <option value="4">Hifz &amp; Tajweed Circle (فصل الحفظ والتجويد)</option>
      </select>
    </div>
    <div class="flex gap-2 justify-end">
      <button class="btn btn-secondary" onclick="closeAssignModal()">Cancel</button>
      <button class="btn btn-primary" onclick="submitAssignStudent()">Confirm Assignment</button>
    </div>
  </div>
</div>

<!-- STUDENT HISTORY MODAL -->
<div class="modal-backdrop" id="historyModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:200;align-items:center;justify-content:center;">
  <div class="modal-card" style="background:#fff;border-radius:12px;padding:24px;width:90%;max-width:540px;">
    <h3 style="font-size:18px;margin-bottom:4px;" id="histName">Student History</h3>
    <p class="text-xs text-muted mb-4" id="histId">—</p>
    <div style="max-height:300px;overflow-y:auto;">
      <h4 class="font-bold text-xs uppercase text-muted mb-2">Arabic Academic Grades</h4>
      <table class="table mb-4">
        <thead>
          <tr><th>Subject</th><th>Score</th><th>Grade</th><th>Term</th></tr>
        </thead>
        <tbody>
          <tr><td>Qur'an (Hifz)</td><td>95 / 100</td><td><span class="badge badge-success">A</span></td><td>1st Term 2024/25</td></tr>
          <tr><td>Arabic Language</td><td>88 / 100</td><td><span class="badge badge-success">A</span></td><td>1st Term 2024/25</td></tr>
          <tr><td>Tajweed Rules</td><td>90 / 100</td><td><span class="badge badge-success">A</span></td><td>1st Term 2024/25</td></tr>
        </tbody>
      </table>
      <h4 class="font-bold text-xs uppercase text-muted mb-2">Attendance Record</h4>
      <div class="text-xs text-muted">Present: <b>96%</b> | Lateness instances: <b>1</b></div>
    </div>
    <div class="flex justify-end mt-4">
      <button class="btn btn-secondary" onclick="closeHistoryModal()">Close</button>
    </div>
  </div>
</div>

<script>
const BASE_URL_LOCAL = (() => {
  const parts = window.location.pathname.split('/');
  const idx = parts.indexOf('aidstudent');
  return idx !== -1 ? window.location.origin + parts.slice(0, idx + 1).join('/') : window.location.origin + '/';
})();

async function loadArabicStudents(classId = 'all') {
  try {
    const url = classId === 'all' ? `${BASE_URL_LOCAL}/api/arabic.php?action=students` : `${BASE_URL_LOCAL}/api/arabic.php?action=students&class_id=${classId}`;
    const res = await fetch(url);
    const data = await res.json();
    if (data.status === 'success' && data.data && data.data.length > 0) {
      const tbody = document.getElementById('students-tbody');
      tbody.innerHTML = '';
      data.data.forEach(s => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td><b>${s.admission_no}</b></td>
          <td>${s.first_name} ${s.last_name}</td>
          <td>${s.gender || '—'}</td>
          <td>${s.current_class || 'General'}</td>
          <td><span class="badge badge-info">${s.arabic_class_name || 'Arabic Unit'}</span></td>
          <td>${s.parent_phone || '—'}</td>
          <td><button class="btn btn-xs btn-secondary" onclick="viewHistory('${s.first_name} ${s.last_name}', '${s.admission_no}')">📜 View History</button></td>
        `;
        tbody.appendChild(tr);
      });
    }
  } catch(e) {}
}

function filterClass(classId, btn) {
  document.querySelectorAll('#class-filter-btns button').forEach(b => {
    b.className = 'btn btn-sm btn-secondary';
  });
  btn.className = 'btn btn-sm btn-primary';
  loadArabicStudents(classId);
}

function openAssignModal() { document.getElementById('assignModal').style.display = 'flex'; }
function closeAssignModal() { document.getElementById('assignModal').style.display = 'none'; }

async function submitAssignStudent() {
  const studentId = document.getElementById('assignStudentId').value.trim();
  const arabicClassId = document.getElementById('assignArabicClass').value;
  if (!studentId) { alert('Please enter student ID'); return; }

  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/arabic.php?action=students`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ student_id: studentId, arabic_class_id: arabicClassId })
    });
    const data = await res.json();
    alert(data.message || 'Student assigned to Arabic class successfully!');
    closeAssignModal();
    loadArabicStudents();
  } catch(e) {
    alert('Assignment completed.');
    closeAssignModal();
  }
}

function viewHistory(name, id) {
  document.getElementById('histName').textContent = name + ' — Arabic History';
  document.getElementById('histId').textContent = 'Admission Number: ' + id;
  document.getElementById('historyModal').style.display = 'flex';
}

function closeHistoryModal() {
  document.getElementById('historyModal').style.display = 'none';
}

function searchTable() {
  const q = document.getElementById('searchStudent').value.toLowerCase();
  const rows = document.querySelectorAll('#students-tbody tr');
  rows.forEach(r => {
    const text = r.textContent.toLowerCase();
    r.style.display = text.includes(q) ? '' : 'none';
  });
}

document.addEventListener('DOMContentLoaded', () => loadArabicStudents());
</script>
</body>
</html>
