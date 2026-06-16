<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Term Results — School Aid Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
  <style>
    .grade-pill {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      font-weight: 700;
      font-size: 0.85rem;
    }
    .grade-A { background: rgba(16,185,129,0.18); color: #10b981; }
    .grade-B { background: rgba(59,130,246,0.18); color: #3b82f6; }
    .grade-C { background: rgba(245,158,11,0.18); color: #f59e0b; }
    .grade-D { background: rgba(239,68,68,0.18); color: #ef4444; }
    .grade-F { background: rgba(127,29,29,0.18); color: #dc2626; }
    .score-bar-wrap { background: rgba(148,163,184,0.1); border-radius: 8px; height: 6px; flex: 1; overflow: hidden; }
    .score-bar { height: 6px; border-radius: 8px; background: var(--accent-primary); }
    .result-row-scores { display: flex; align-items: center; gap: 8px; }
    .term-selector { display: flex; gap: 8px; flex-wrap: wrap; }
    .term-btn {
      padding: 6px 16px;
      border-radius: var(--radius-lg);
      border: 1px solid var(--border-color);
      background: transparent;
      color: var(--text-secondary);
      font-size: var(--font-size-sm);
      cursor: pointer;
      transition: all .2s;
    }
    .term-btn.active, .term-btn:hover { background: var(--accent-primary); color: #fff; border-color: var(--accent-primary); }
    .subject-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
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
      <a href="index" class="nav-item" id="nav-dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>
      <a href="profile" class="nav-item" id="nav-profile">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/></svg>
        My Profile
      </a>

      <div class="nav-section-label">Academic Records</div>
      <a href="results" class="nav-item active">
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

      <div class="nav-section-label">Tasks & Memos</div>
      <a href="assignments" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        My Assignments
      </a>
      <a href="announcements" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        Announcements
      </a>
      <a href="messages" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        Teacher Messages
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

    <!-- Topbar -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <div>
          <div class="page-title">Term Results</div>
          <div class="page-breadcrumb">Academic Records / <span>Results</span></div>
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

    <!-- Page Content -->
    <div class="page-content">

      <!-- Term Selector -->
      <div class="card mb-6" style="padding: var(--spacing-4);">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
          <div>
            <div style="font-weight:600;font-size:var(--font-size-sm);margin-bottom:6px;">Select Academic Term</div>
            <div class="term-selector" id="termSelector">
              <button class="term-btn active" data-term="1st" onclick="selectTerm(this, '1st')">1st Term</button>
              <button class="term-btn" data-term="2nd" onclick="selectTerm(this, '2nd')">2nd Term</button>
              <button class="term-btn" data-term="3rd" onclick="selectTerm(this, '3rd')">3rd Term</button>
            </div>
          </div>
          <div style="text-align:right;">
            <div style="font-size:var(--font-size-xs);color:var(--text-muted);">Session</div>
            <div style="font-weight:600;font-size:var(--font-size-sm);">2025/2026</div>
          </div>
        </div>
      </div>

      <!-- GPA Stats -->
      <div class="stats-grid stats-grid-4 mb-6">
        <div class="stat-card" style="--stat-color:#6366f1;--stat-color-bg:rgba(99,102,241,0.12)">
          <div class="stat-icon">🎯</div>
          <div class="stat-value" id="avgScore">78.2</div>
          <div class="stat-label">Average Score</div>
        </div>
        <div class="stat-card" style="--stat-color:#10b981;--stat-color-bg:rgba(16,185,129,0.12)">
          <div class="stat-icon">🏆</div>
          <div class="stat-value" id="highestScore">94</div>
          <div class="stat-label">Highest Score</div>
        </div>
        <div class="stat-card" style="--stat-color:#3b82f6;--stat-color-bg:rgba(59,130,246,0.12)">
          <div class="stat-icon">📚</div>
          <div class="stat-value" id="subjectCount">8</div>
          <div class="stat-label">Subjects Taken</div>
        </div>
        <div class="stat-card" style="--stat-color:#f59e0b;--stat-color-bg:rgba(245,158,11,0.12)">
          <div class="stat-icon">⭐</div>
          <div class="stat-value" id="classPos">3rd</div>
          <div class="stat-label">Class Position</div>
        </div>
      </div>

      <!-- Chart + Subject Breakdown side by side -->
      <div class="grid-2-col mb-6" style="display:grid;grid-template-columns:1fr 1.6fr;gap:var(--spacing-4);">
        <div class="card">
          <div class="card-header"><h3 class="card-title">Score Distribution</h3></div>
          <div class="chart-container" style="height:240px;">
            <canvas id="scoreRadarChart"></canvas>
          </div>
        </div>
        <div class="card">
          <div class="card-header"><h3 class="card-title">Subject Performance</h3></div>
          <div class="chart-container" style="height:240px;">
            <canvas id="subjectBarChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Results Table -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detailed Subject Results</h3>
          <button class="btn btn-sm btn-outline" onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Print Report
          </button>
        </div>
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Subject</th>
                <th>CA Score <small style="color:var(--text-muted)">(40)</small></th>
                <th>Exam Score <small style="color:var(--text-muted)">(60)</small></th>
                <th>Total <small style="color:var(--text-muted)">(100)</small></th>
                <th>Score Bar</th>
                <th>Grade</th>
                <th>Remark</th>
              </tr>
            </thead>
            <tbody id="resultsTableBody">
              <!-- Loaded Dynamically -->
            </tbody>
          </table>
        </div>
        <!-- Cumulative footer -->
        <div style="padding:16px 20px;border-top:1px solid var(--border-color);display:flex;gap:32px;flex-wrap:wrap;">
          <div>
            <span style="font-size:var(--font-size-xs);color:var(--text-muted);">Total Score</span>
            <div style="font-weight:700;" id="totalScore">—</div>
          </div>
          <div>
            <span style="font-size:var(--font-size-xs);color:var(--text-muted);">Average</span>
            <div style="font-weight:700;" id="avgScoreFooter">—</div>
          </div>
          <div>
            <span style="font-size:var(--font-size-xs);color:var(--text-muted);">Overall Grade</span>
            <div style="font-weight:700;" id="overallGrade">—</div>
          </div>
          <div>
            <span style="font-size:var(--font-size-xs);color:var(--text-muted);">Class Position</span>
            <div style="font-weight:700;" id="positionFooter">3rd / 45 Students</div>
          </div>
        </div>
      </div>

    </div><!-- /.page-content -->
  </main><!-- /.main-content -->

</div><!-- /.app-shell -->

<script src="../../assets/js/auth.js"></script>
<script src="../../assets/js/api.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script>
  Auth.requireAuth();
  Auth.requireRole('student');

  const MOCK_RESULTS = {
    '1st': [
      { subject: 'Mathematics',     icon: '📐', ca: 36, exam: 56, total: 92 },
      { subject: 'English Language',icon: '📝', ca: 34, exam: 60, total: 94 },
      { subject: 'Basic Science',   icon: '🔬', ca: 30, exam: 48, total: 78 },
      { subject: 'Social Studies',  icon: '🌍', ca: 28, exam: 44, total: 72 },
      { subject: 'Civic Education', icon: '🏛️', ca: 32, exam: 50, total: 82 },
      { subject: 'Business Studies',icon: '💼', ca: 25, exam: 40, total: 65 },
      { subject: 'Computer Studies',icon: '💻', ca: 38, exam: 54, total: 92 },
      { subject: 'Agricultural Sci',icon: '🌾', ca: 22, exam: 42, total: 64 },
    ],
    '2nd': [
      { subject: 'Mathematics',     icon: '📐', ca: 38, exam: 58, total: 96 },
      { subject: 'English Language',icon: '📝', ca: 35, exam: 55, total: 90 },
      { subject: 'Basic Science',   icon: '🔬', ca: 32, exam: 52, total: 84 },
      { subject: 'Social Studies',  icon: '🌍', ca: 30, exam: 46, total: 76 },
      { subject: 'Civic Education', icon: '🏛️', ca: 34, exam: 52, total: 86 },
      { subject: 'Business Studies',icon: '💼', ca: 27, exam: 45, total: 72 },
      { subject: 'Computer Studies',icon: '💻', ca: 40, exam: 57, total: 97 },
      { subject: 'Agricultural Sci',icon: '🌾', ca: 24, exam: 44, total: 68 },
    ],
    '3rd': [
      { subject: 'Mathematics',     icon: '📐', ca: 33, exam: 50, total: 83 },
      { subject: 'English Language',icon: '📝', ca: 36, exam: 58, total: 94 },
      { subject: 'Basic Science',   icon: '🔬', ca: 28, exam: 47, total: 75 },
      { subject: 'Social Studies',  icon: '🌍', ca: 26, exam: 40, total: 66 },
      { subject: 'Civic Education', icon: '🏛️', ca: 30, exam: 48, total: 78 },
      { subject: 'Business Studies',icon: '💼', ca: 22, exam: 38, total: 60 },
      { subject: 'Computer Studies',icon: '💻', ca: 35, exam: 52, total: 87 },
      { subject: 'Agricultural Sci',icon: '🌾', ca: 20, exam: 40, total: 60 },
    ],
  };

  let radarChart, barChart;
  let currentTerm = '1st';

  function getGrade(score) {
    if (score >= 75) return 'A';
    if (score >= 65) return 'B';
    if (score >= 55) return 'C';
    if (score >= 40) return 'D';
    return 'F';
  }

  function getRemark(grade) {
    return { A: 'Excellent', B: 'Very Good', C: 'Good', D: 'Pass', F: 'Fail' }[grade] || '—';
  }

  function selectTerm(btn, term) {
    document.querySelectorAll('.term-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    currentTerm = term;
    renderResults(term);
  }

  function renderResults(term) {
    const results = MOCK_RESULTS[term] || [];
    const tbody = document.getElementById('resultsTableBody');

    const total = results.reduce((s, r) => s + r.total, 0);
    const avg = total / results.length;
    const highest = Math.max(...results.map(r => r.total));
    const grade = getGrade(avg);

    document.getElementById('avgScore').textContent = avg.toFixed(1);
    document.getElementById('highestScore').textContent = highest;
    document.getElementById('subjectCount').textContent = results.length;
    document.getElementById('totalScore').textContent = total;
    document.getElementById('avgScoreFooter').textContent = avg.toFixed(1);
    document.getElementById('overallGrade').textContent = grade + ' — ' + getRemark(grade);

    tbody.innerHTML = results.map(r => {
      const g = getGrade(r.total);
      const pct = r.total;
      return `
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:10px;">
              <div class="subject-icon" style="background:rgba(99,102,241,0.1);">${r.icon}</div>
              <span style="font-weight:500;">${r.subject}</span>
            </div>
          </td>
          <td><strong>${r.ca}</strong></td>
          <td><strong>${r.exam}</strong></td>
          <td><strong>${r.total}</strong></td>
          <td style="min-width:120px;">
            <div class="result-row-scores">
              <div class="score-bar-wrap">
                <div class="score-bar" style="width:${pct}%;background:${pct>=75?'#10b981':pct>=55?'#3b82f6':pct>=40?'#f59e0b':'#ef4444'};"></div>
              </div>
              <span style="font-size:var(--font-size-xs);color:var(--text-muted);width:30px;">${pct}%</span>
            </div>
          </td>
          <td><div class="grade-pill grade-${g}">${g}</div></td>
          <td>${Format.badge(getRemark(g).toLowerCase().replace(' ','_'))}</td>
        </tr>
      `;
    }).join('');

    // Update charts
    updateCharts(results);
  }

  function updateCharts(results) {
    const labels = results.map(r => r.subject.split(' ')[0]);
    const data = results.map(r => r.total);
    const colors = data.map(d => d >= 75 ? '#10b981' : d >= 55 ? '#3b82f6' : d >= 40 ? '#f59e0b' : '#ef4444');

    if (barChart) {
      barChart.data.labels = labels;
      barChart.data.datasets[0].data = data;
      barChart.data.datasets[0].backgroundColor = colors.map(c => c + '88');
      barChart.data.datasets[0].borderColor = colors;
      barChart.update();
    }

    if (radarChart) {
      radarChart.data.labels = labels;
      radarChart.data.datasets[0].data = data;
      radarChart.update();
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderResults('1st');

    const results = MOCK_RESULTS['1st'];
    const labels = results.map(r => r.subject.split(' ')[0]);
    const data = results.map(r => r.total);

    // Radar chart
    radarChart = new Chart(document.getElementById('scoreRadarChart'), {
      type: 'radar',
      data: {
        labels,
        datasets: [{
          label: 'Score',
          data,
          backgroundColor: 'rgba(99,102,241,0.15)',
          borderColor: '#6366f1',
          borderWidth: 2,
          pointBackgroundColor: '#6366f1'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          r: {
            min: 0, max: 100,
            ticks: { stepSize: 20, color: 'rgba(148,163,184,0.7)', font: { size: 9 } },
            grid: { color: 'rgba(148,163,184,0.12)' },
            pointLabels: { color: 'rgba(148,163,184,0.8)', font: { size: 9 } }
          }
        },
        plugins: { legend: { display: false } }
      }
    });

    // Bar chart
    barChart = new Chart(document.getElementById('subjectBarChart'), {
      type: 'bar',
      data: {
        labels,
        datasets: [{
          label: 'Total Score',
          data,
          backgroundColor: data.map(d => (d >= 75 ? '#10b981' : d >= 55 ? '#3b82f6' : '#f59e0b') + '88'),
          borderColor: data.map(d => d >= 75 ? '#10b981' : d >= 55 ? '#3b82f6' : '#f59e0b'),
          borderWidth: 2,
          borderRadius: 6,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: { min: 0, max: 100, grid: { color: 'rgba(148,163,184,0.08)' } },
          x: { grid: { display: false } }
        },
        plugins: { legend: { display: false } }
      }
    });
  });
</script>
</body>
</html>
