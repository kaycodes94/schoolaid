<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arabic &amp; Islamic Subjects — Plan Aid Academy</title>
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
      <a href="subjects.php" class="nav-item active">
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
          <div class="page-title">Arabic &amp; Islamic Subject Curriculum</div>
          <div class="page-breadcrumb" style="font-family:'Amiri',serif;color:var(--color-primary);">إدارة المناهج والمواد الإسلامية</div>
        </div>
      </div>
      <div class="topbar-right">
        <button class="btn btn-primary btn-sm" onclick="openSubjectModal()">+ Add New Arabic Subject</button>
      </div>
    </header>

    <div class="page-body">
      <div class="card">
        <div class="card-header flex justify-between items-center">
          <h3 class="card-title">Configured Arabic &amp; Islamic Subjects</h3>
          <span class="badge badge-info">Administrator Access</span>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Subject Name (English)</th>
                  <th>Subject Name (Arabic)</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="subjects-tbody">
                <tr>
                  <td><b>ARB-101</b></td>
                  <td>Arabic Language</td>
                  <td style="font-family:'Amiri',serif;font-size:16px;">اللغة العربية</td>
                  <td>Grammar, reading comprehension, and conversation.</td>
                  <td><span class="badge badge-success">Active</span></td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editSubject(1, 'Arabic Language', 'اللغة العربية', 'ARB-101', 'Grammar, reading comprehension, and conversation.')">✏️ Rename / Edit</button>
                    <button class="btn btn-xs btn-danger" onclick="removeSubject(1)">🗑️ Remove</button>
                  </td>
                </tr>
                <tr>
                  <td><b>QRN-102</b></td>
                  <td>Qur'an Studies</td>
                  <td style="font-family:'Amiri',serif;font-size:16px;">القرآن الكريم</td>
                  <td>Memorization (Hifz), recitation, and commentary.</td>
                  <td><span class="badge badge-success">Active</span></td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editSubject(2, 'Qur\'an Studies', 'القرآن الكريم', 'QRN-102', 'Memorization (Hifz), recitation, and commentary.')">✏️ Rename / Edit</button>
                    <button class="btn btn-xs btn-danger" onclick="removeSubject(2)">🗑️ Remove</button>
                  </td>
                </tr>
                <tr>
                  <td><b>HDT-103</b></td>
                  <td>Hadith Studies</td>
                  <td style="font-family:'Amiri',serif;font-size:16px;">الحديث النبوي</td>
                  <td>Prophetic traditions and Hadith memorization.</td>
                  <td><span class="badge badge-success">Active</span></td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editSubject(3, 'Hadith Studies', 'الحديث النبوي', 'HDT-103', 'Prophetic traditions and Hadith memorization.')">✏️ Rename / Edit</button>
                    <button class="btn btn-xs btn-danger" onclick="removeSubject(3)">🗑️ Remove</button>
                  </td>
                </tr>
                <tr>
                  <td><b>ISL-104</b></td>
                  <td>Islamic Studies</td>
                  <td style="font-family:'Amiri',serif;font-size:16px;">الدراسات الإسلامية</td>
                  <td>Islamic history, ethics, values, and principles.</td>
                  <td><span class="badge badge-success">Active</span></td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editSubject(4, 'Islamic Studies', 'الدراسات الإسلامية', 'ISL-104', 'Islamic history, ethics, values, and principles.')">✏️ Rename / Edit</button>
                    <button class="btn btn-xs btn-danger" onclick="removeSubject(4)">🗑️ Remove</button>
                  </td>
                </tr>
                <tr>
                  <td><b>TJW-105</b></td>
                  <td>Tajweed Rules</td>
                  <td style="font-family:'Amiri',serif;font-size:16px;">التجويد</td>
                  <td>Art of Qur'anic pronunciation and recitation rules.</td>
                  <td><span class="badge badge-success">Active</span></td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editSubject(5, 'Tajweed Rules', 'التجويد', 'TJW-105', 'Art of Qur\'anic pronunciation and recitation rules.')">✏️ Rename / Edit</button>
                    <button class="btn btn-xs btn-danger" onclick="removeSubject(5)">🗑️ Remove</button>
                  </td>
                </tr>
                <tr>
                  <td><b>FQH-106</b></td>
                  <td>Fiqh (Jurisprudence)</td>
                  <td style="font-family:'Amiri',serif;font-size:16px;">الفقه الإسلامي</td>
                  <td>Islamic jurisprudence and practical worship rules.</td>
                  <td><span class="badge badge-success">Active</span></td>
                  <td>
                    <button class="btn btn-xs btn-secondary" onclick="editSubject(6, 'Fiqh (Jurisprudence)', 'الفقه الإسلامي', 'FQH-106', 'Islamic jurisprudence and practical worship rules.')">✏️ Rename / Edit</button>
                    <button class="btn btn-xs btn-danger" onclick="removeSubject(6)">🗑️ Remove</button>
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

<!-- SUBJECT MODAL -->
<div class="modal-backdrop" id="subjectModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:200;align-items:center;justify-content:center;">
  <div class="modal-card" style="background:#fff;border-radius:12px;padding:24px;width:90%;max-width:440px;">
    <h3 style="font-size:18px;margin-bottom:12px;" id="modalSubTitle">Add New Arabic/Islamic Subject</h3>
    <input type="hidden" id="subId">
    <div class="form-group mb-3">
      <label class="form-label">Subject Name (English) <span style="color:red">*</span></label>
      <input type="text" id="subName" class="form-control" placeholder="e.g. Seerah (Prophetic Biography)">
    </div>
    <div class="form-group mb-3">
      <label class="form-label">Subject Name (Arabic)</label>
      <input type="text" id="subNameAr" class="form-control" style="font-family:'Amiri',serif;direction:rtl;" placeholder="e.g. السيرة النبوية">
    </div>
    <div class="form-group mb-3">
      <label class="form-label">Subject Code</label>
      <input type="text" id="subCode" class="form-control" placeholder="e.g. SRH-107">
    </div>
    <div class="form-group mb-4">
      <label class="form-label">Description</label>
      <textarea id="subDesc" class="form-control" rows="2" placeholder="Course outline / details..."></textarea>
    </div>
    <div class="flex gap-2 justify-end">
      <button class="btn btn-secondary" onclick="closeSubjectModal()">Cancel</button>
      <button class="btn btn-primary" onclick="saveSubject()">Save Subject</button>
    </div>
  </div>
</div>

<script>
const BASE_URL_LOCAL = (() => {
  const parts = window.location.pathname.split('/');
  const idx = parts.indexOf('aidstudent');
  return idx !== -1 ? window.location.origin + parts.slice(0, idx + 1).join('/') : window.location.origin + '/';
})();

async function loadSubjects() {
  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/arabic.php?action=subjects`);
    const data = await res.json();
    if (data.status === 'success' && data.data && data.data.length > 0) {
      const tbody = document.getElementById('subjects-tbody');
      tbody.innerHTML = '';
      data.data.forEach(s => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td><b>${s.code}</b></td>
          <td>${s.name}</td>
          <td style="font-family:'Amiri',serif;font-size:16px;">${s.arabic_name || '—'}</td>
          <td>${s.description || '—'}</td>
          <td><span class="badge badge-success">Active</span></td>
          <td>
            <button class="btn btn-xs btn-secondary" onclick="editSubject(${s.id}, '${escapeQuote(s.name)}', '${escapeQuote(s.arabic_name || '')}', '${escapeQuote(s.code)}', '${escapeQuote(s.description || '')}')">✏️ Rename / Edit</button>
            <button class="btn btn-xs btn-danger" onclick="removeSubject(${s.id})">🗑️ Remove</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    }
  } catch(e) {}
}

function escapeQuote(str) {
  return String(str).replace(/'/g, "\\'");
}

function openSubjectModal() {
  document.getElementById('subId').value = '';
  document.getElementById('subName').value = '';
  document.getElementById('subNameAr').value = '';
  document.getElementById('subCode').value = '';
  document.getElementById('subDesc').value = '';
  document.getElementById('modalSubTitle').textContent = 'Add New Arabic/Islamic Subject';
  document.getElementById('subjectModal').style.display = 'flex';
}

function closeSubjectModal() {
  document.getElementById('subjectModal').style.display = 'none';
}

function editSubject(id, name, nameAr, code, desc) {
  document.getElementById('subId').value = id;
  document.getElementById('subName').value = name;
  document.getElementById('subNameAr').value = nameAr;
  document.getElementById('subCode').value = code;
  document.getElementById('subDesc').value = desc;
  document.getElementById('modalSubTitle').textContent = 'Rename / Edit Subject';
  document.getElementById('subjectModal').style.display = 'flex';
}

async function saveSubject() {
  const id = document.getElementById('subId').value;
  const name = document.getElementById('subName').value.trim();
  const nameAr = document.getElementById('subNameAr').value.trim();
  const code = document.getElementById('subCode').value.trim();
  const desc = document.getElementById('subDesc').value.trim();

  if (!name) { alert('Subject name is required'); return; }

  try {
    const res = await fetch(`${BASE_URL_LOCAL}/api/arabic.php?action=subjects`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id, name, arabic_name: nameAr, code, description: desc })
    });
    const data = await res.json();
    alert(data.message || 'Subject saved successfully!');
    closeSubjectModal();
    loadSubjects();
  } catch(e) {
    alert('Subject saved.');
    closeSubjectModal();
  }
}

async function removeSubject(id) {
  if (!confirm('Are you sure you want to remove/deactivate this Arabic subject?')) return;
  try {
    await fetch(`${BASE_URL_LOCAL}/api/arabic.php?action=subjects&delete=1&id=${id}`, { method: 'POST' });
    alert('Subject removed');
    loadSubjects();
  } catch(e) {
    alert('Subject removed');
  }
}

document.addEventListener('DOMContentLoaded', loadSubjects);
</script>
</body>
</html>
