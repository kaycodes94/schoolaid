<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arabic Subjects &amp; Departments — Plan Aid Academy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
<div class="app-shell">

  <!-- Sidebar Backdrop -->
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- ===================== SIDEBAR ===================== -->
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
      <a href="index.php" class="nav-item" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Unit Dashboard
      </a>

      <div class="nav-section-label">Arabic Academics</div>
      <a href="students.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Arabic Students &amp; Classes
      </a>
      <a href="teachers.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        Arabic Teachers
      </a>
      <a href="departments.php" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
        Arabic Subjects &amp; Curriculum
      </a>
      <a href="attendance.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
        Unit Attendance Summary
      </a>

      <div class="nav-section-label">Results &amp; Approvals</div>
      <a href="approvals.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Pending Arabic Results
      </a>
      <a href="reports.php" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        Arabic Reports
      </a>

      <a href="#" class="nav-item mt-6" style="color:var(--red);" data-logout>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sign Out
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="avatar user-avatar-initials" style="background:var(--color-warning);">AU</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name" data-user-name>Ustadh Ahmad</div>
          <div class="sidebar-user-role">Head of Arabic Unit</div>
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
          <div class="page-title">Arabic &amp; Islamic Subjects Management</div>
          <div class="page-breadcrumb">إدارة المواد والمنهج العربي</div>
        </div>
      </div>
      <div class="topbar-right">
        <span class="session-badge session-info">2025/2026 | 1st Term</span>
        <div class="dropdown">
          <div class="icon-btn" data-dropdown="userMenu">
            <div class="avatar avatar-sm user-avatar-initials" style="background:var(--color-warning);font-size:0.65rem;width:28px;height:28px;">AU</div>
          </div>
          <div class="dropdown-menu" id="userMenu">
            <div class="dropdown-item" style="cursor:default;opacity:0.7;font-size:var(--font-size-xs);" data-user-name>Ustadh Ahmad</div>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item danger" data-logout>Sign Out</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="page-content">

      <!-- Page Header -->
      <div class="page-header">
        <div class="page-header-text">
          <h2>Arabic &amp; Islamic Curriculum Subjects</h2>
          <p class="text-secondary">Configure, rename, add, or remove subjects in the Arabic &amp; Islamic Studies Unit.</p>
        </div>
        <div class="page-header-actions">
          <button class="btn btn-primary" onclick="openAddModal()">+ Add Arabic Subject</button>
        </div>
      </div>

      <!-- Subjects Card Grid -->
      <div class="grid gap-6 grid-cols-3" id="subjectsGrid">
        <!-- Dynamically Populated -->
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<!-- Subject Add/Edit Modal -->
<div class="modal-overlay" id="subjectModal">
  <div class="modal" style="max-width:480px;">
    <div class="modal-header">
      <h3 class="modal-title" id="modalTitle">Add Arabic Subject</h3>
      <button class="modal-close" onclick="Modal.close('subjectModal')">✕</button>
    </div>
    <div class="modal-body">
      <form id="subjectForm" onsubmit="saveSubject(event)">
        <input type="hidden" id="subjectIndex">
        
        <div class="form-group">
          <label class="form-label" for="subName">Subject Title (English) <span class="required">*</span></label>
          <input type="text" id="subName" class="form-control" placeholder="e.g. Qur'an & Tajweed" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="subArabicName">Subject Title (Arabic - اسم المادة) <span class="required">*</span></label>
          <input type="text" id="subArabicName" class="form-control" placeholder="e.g. القرآن والتجويد" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="subCode">Subject Code <span class="required">*</span></label>
          <input type="text" id="subCode" class="form-control" placeholder="e.g. ARB-QUR" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="subDesc">Subject Scope / Description</label>
          <textarea id="subDesc" class="form-control" placeholder="Brief details about curriculum requirements..." rows="3"></textarea>
        </div>

        <div class="flex gap-3 justify-end mt-6">
          <button type="button" class="btn btn-secondary" onclick="Modal.close('subjectModal')">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Subject</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="toast-container"></div>

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole(['unit_head', 'arabic', 'principal', 'admin']);

  let defaultSubjects = [
    { code: 'ARB-LNG', name: 'Arabic Language', arabicName: 'اللغة العربية', desc: 'Grammar, reading comprehension, and spoken fluency.' },
    { code: 'ARB-QUR', name: 'Qur\'an', arabicName: 'القرآن الكريم', desc: 'Memorization (Hifz) and proper recitation.' },
    { code: 'ARB-HAD', name: 'Hadith', arabicName: 'الحديث الشريف', desc: 'Study of Prophetic traditions and teachings.' },
    { code: 'ARB-ISL', name: 'Islamic Studies', arabicName: 'الدراسات الإسلامية', desc: 'General Islamic history, Seerah, and moral character.' },
    { code: 'ARB-TAJ', name: 'Tajweed', arabicName: 'علم التجويد', desc: 'Rules of Qur'anic pronunciation and phonetics.' },
    { code: 'ARB-FIQ', name: 'Fiqh', arabicName: 'الفقه والعقيدة', desc: 'Islamic jurisprudence, worship rules, and Aqeedah.' }
  ];

  document.addEventListener('DOMContentLoaded', loadSubjects);

  function loadSubjects() {
    const saved = localStorage.getItem('paa_arabic_subjects');
    if (saved) {
      try { defaultSubjects = JSON.parse(saved); } catch(_) {}
    }
    renderGrid();
  }

  function renderGrid() {
    const grid = document.getElementById('subjectsGrid');
    grid.innerHTML = defaultSubjects.map((s, idx) => `
      <div class="card flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="badge badge-warning">${s.code}</span>
            <span class="badge badge-success">Active</span>
          </div>
          <h3 style="margin-bottom:var(--space-1);">${s.name}</h3>
          <div class="text-sm font-bold" style="color:var(--color-warning);margin-bottom:var(--space-2);">${s.arabicName || ''}</div>
          <p class="text-xs text-muted mb-4">${s.desc || 'No description provided.'}</p>
        </div>
        <div class="flex items-center justify-between" style="border-top:1px solid var(--color-border);padding-top:var(--space-3);margin-top:var(--space-2);">
          <button class="btn btn-secondary btn-sm" onclick="openEditModal(${idx})">Rename / Edit</button>
          <button class="btn btn-danger btn-sm" onclick="removeSubject(${idx})">Remove</button>
        </div>
      </div>
    `).join('');
  }

  function openAddModal() {
    document.getElementById('subjectForm').reset();
    document.getElementById('subjectIndex').value = '';
    document.getElementById('modalTitle').textContent = 'Add Arabic Subject';
    Modal.open('subjectModal');
  }

  function openEditModal(idx) {
    const item = defaultSubjects[idx];
    if (!item) return;
    document.getElementById('subjectIndex').value = idx;
    document.getElementById('subName').value = item.name;
    document.getElementById('subArabicName').value = item.arabicName || '';
    document.getElementById('subCode').value = item.code;
    document.getElementById('subDesc').value = item.desc || '';
    document.getElementById('modalTitle').textContent = 'Rename / Edit Subject';
    Modal.open('subjectModal');
  }

  function removeSubject(idx) {
    const item = defaultSubjects[idx];
    if (!confirm(`Are you sure you want to remove ${item.name} from Arabic subjects?`)) return;
    defaultSubjects.splice(idx, 1);
    localStorage.setItem('paa_arabic_subjects', JSON.stringify(defaultSubjects));
    Toast.success('Removed', `${item.name} removed from Arabic subjects.`);
    renderGrid();
  }

  function saveSubject(e) {
    e.preventDefault();
    const idx = document.getElementById('subjectIndex').value;
    const name = document.getElementById('subName').value.trim();
    const arabicName = document.getElementById('subArabicName').value.trim();
    const code = document.getElementById('subCode').value.trim().toUpperCase();
    const desc = document.getElementById('subDesc').value.trim();

    const obj = { code, name, arabicName, desc };

    if (idx !== '') {
      defaultSubjects[idx] = obj;
      Toast.success('Updated', `Subject updated to "${name}".`);
    } else {
      defaultSubjects.push(obj);
      Toast.success('Created', `New Arabic subject "${name}" added.`);
    }

    localStorage.setItem('paa_arabic_subjects', JSON.stringify(defaultSubjects));
    Modal.close('subjectModal');
    renderGrid();
  }
</script>
</body>
</html>
