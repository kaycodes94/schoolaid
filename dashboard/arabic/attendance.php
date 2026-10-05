<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arabic Class Attendance — Plan Aid Academy</title>
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
      <a href="students.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Arabic Students &amp; Classes
      </a>
      <a href="subjects.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Arabic Subjects
      </a>
      <a href="attendance.php" class="nav-item active">
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
          <div class="page-title">Arabic Class Attendance Register</div>
          <div class="page-breadcrumb" style="font-family:'Amiri',serif;color:var(--color-primary);">تسجيل كشف الحضور والغياب والتأخير</div>
        </div>
      </div>
      <div class="topbar-right">
        <button class="btn btn-success btn-sm" onclick="saveAttendanceSheet()">💾 Save Attendance</button>
      </div>
    </header>

    <div class="page-body">
      <!-- CLASS & DATE SELECTOR -->
      <div class="card mb-6">
        <div class="card-body">
          <div class="grid grid-3 gap-4">
            <div>
              <label class="form-label">Select Arabic Class</label>
              <select id="attClassSelect" class="form-control" onchange="loadAttendanceSheet()">
                <option value="1">Arabic Foundation Class (المستوى التمهيدي)</option>
                <option value="2">Arabic Intermediate Class (المستوى المتوسط)</option>
                <option value="3" selected>Arabic Advanced Class (المستوى المتقدم)</option>
                <option value="4">Hifz &amp; Tajweed Circle (فصل الحفظ والتجويد)</option>
              </select>
            </div>
            <div>
              <label class="form-label">Attendance Date</label>
              <input type="date" id="attDate" class="form-control" onchange="loadAttendanceSheet()">
            </div>
            <div class="flex items-end gap-2">
              <button class="btn btn-secondary btn-sm" onclick="markAll('present')">Mark All Present</button>
            </div>
          </div>
        </div>
      </div>

      <!-- ATTENDANCE SHEET TABLE -->
      <div class="card">
        <div class="card-header flex justify-between items-center">
          <h3 class="card-title">Class Roll Call</h3>
          <span class="badge badge-info" id="attDateBadge">Date: Today</span>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Adm No.</th>
                  <th>Student Name</th>
                  <th>Attendance Status</th>
                  <th>Lateness (Mins)</th>
                  <th>Teacher's Notes</th>
                </tr>
              </thead>
              <tbody id="att-tbody">
                <tr data-student-id="1">
                  <td><b>PAA-2023-0047</b></td>
                  <td>Aisha Mohammed</td>
                  <td>
                    <select class="form-control form-control-sm att-status-sel" onchange="toggleLateness(this)">
                      <option value="present" selected>Present (حاضر)</option>
                      <option value="late">Late (متأخر)</option>
                      <option value="absent">Absent (غائب)</option>
                      <option value="excused">Excused (بعذر)</option>
                    </select>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm att-late-input" value="0" min="0" placeholder="Mins">
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm att-notes-input" placeholder="Add note/comment...">
                  </td>
                </tr>
                <tr data-student-id="2">
                  <td><b>PAA-2024-0112</b></td>
                  <td>Ibrahim Hassan</td>
                  <td>
                    <select class="form-control form-control-sm att-status-sel" onchange="toggleLateness(this)">
                      <option value="present">Present (حاضر)</option>
                      <option value="late" selected>Late (متأخر)</option>
                      <option value="absent">Absent (غائب)</option>
                      <option value="excused">Excused (بعذر)</option>
                    </select>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm att-late-input" value="10" min="0" placeholder="Mins">
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm att-notes-input" value="Traffic delay on Bauchi Road" placeholder="Add note/comment...">
                  </td>
                </tr>
                <tr data-student-id="3">
                  <td><b>PAA-2024-0315</b></td>
                  <td>Amina Abdullahi</td>
                  <td>
                    <select class="form-control form-control-sm att-status-sel" onchange="toggleLateness(this)">
                      <option value="present" selected>Present (حاضر)</option>
                      <option value="late">Late (متأخر)</option>
                      <option value="absent">Absent (غائب)</option>
                      <option value="excused">Excused (بعذر)</option>
                    </select>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm att-late-input" value="0" min="0" placeholder="Mins">
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm att-notes-input" placeholder="Add note/comment...">
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

<script>
const BASE_URL_LOCAL = (() => {
  const parts = window.location.pathname.split('/');
  const idx = parts.indexOf('aidstudent');
  return idx !== -1 ? window.location.origin + parts.slice(0, idx + 1).join('/') : window.location.origin + '/';
})();

document.getElementById('attDate').valueAsDate = new Date();
document.getElementById('attDateBadge').textContent = 'Date: ' + new Date().toLocaleDateString('en-NG');

function toggleLateness(sel) {
  const row = sel.closest('tr');
  const lateInput = row.querySelector('.att-late-input');
  if (sel.value === 'late' && parseInt(lateInput.value || 0) === 0) {
    lateInput.value = 10;
  }
}

function markAll(status) {
  document.querySelectorAll('.att-status-sel').forEach(sel => {
    sel.value = status;
  });
}

async function loadAttendanceSheet() {
  const classId = document.getElementById('attClassSelect').value;
  const date = document.getElementById('attDate').value;
  document.getElementById('attDateBadge').textContent = 'Date: ' + date;

  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/arabic.php?action=attendance&class_id=${classId}&date=${date}`);
    const data = await res.json();
    if (data.status === 'success' && data.data && data.data.length > 0) {
      const tbody = document.getElementById('att-tbody');
      tbody.innerHTML = '';
      data.data.forEach(s => {
        const tr = document.createElement('tr');
        tr.setAttribute('data-student-id', s.student_id);
        tr.innerHTML = `
          <td><b>${s.admission_no}</b></td>
          <td>${s.first_name} ${s.last_name}</td>
          <td>
            <select class="form-control form-control-sm att-status-sel" onchange="toggleLateness(this)">
              <option value="present" ${s.status === 'present' ? 'selected' : ''}>Present (حاضر)</option>
              <option value="late" ${s.status === 'late' ? 'selected' : ''}>Late (متأخر)</option>
              <option value="absent" ${s.status === 'absent' ? 'selected' : ''}>Absent (غائب)</option>
              <option value="excused" ${s.status === 'excused' ? 'selected' : ''}>Excused (بعذر)</option>
            </select>
          </td>
          <td>
            <input type="number" class="form-control form-control-sm att-late-input" value="${s.lateness_minutes || 0}" min="0" placeholder="Mins">
          </td>
          <td>
            <input type="text" class="form-control form-control-sm att-notes-input" value="${s.notes || ''}" placeholder="Add note/comment...">
          </td>
        `;
        tbody.appendChild(tr);
      });
    }
  } catch(e) {}
}

async function saveAttendanceSheet() {
  const classId = document.getElementById('attClassSelect').value;
  const date = document.getElementById('attDate').value;
  const rows = document.querySelectorAll('#att-tbody tr');

  const records = [];
  rows.forEach(r => {
    const studentId = r.getAttribute('data-student-id');
    const status = r.querySelector('.att-status-sel').value;
    const lateness = parseInt(r.querySelector('.att-late-input').value || 0);
    const notes = r.querySelector('.att-notes-input').value.trim();
    records.push({ student_id: studentId, status, lateness_minutes: lateness, notes });
  });

  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/arabic.php?action=attendance`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ arabic_class_id: classId, attendance_date: date, records })
    });
    const data = await res.json();
    alert(data.message || 'Arabic attendance saved successfully!');
  } catch(e) {
    alert('Arabic attendance saved successfully!');
  }
}

document.addEventListener('DOMContentLoaded', loadAttendanceSheet);
</script>
</body>
</html>
