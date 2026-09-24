<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Plan Aid Academy &amp; Educational Resource, Jos | Science &amp; ICT Education</title>
<meta name="description" content="Plan Aid Academy &amp; Educational Resource, Jos — a Science and ICT-based centre of excellence focused on academic excellence, innovation, creativity, technology and practical learning."/>
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet"/>
<style>
  :root {
    --font-main: 'Calibri', Carlito, 'Segoe UI', Arial, sans-serif;
    --green: #1e3a8a;
    --navy: #0f275c;
    --gold: #c8960c;
    --gold-light: #fef3cd;
    --cream: #faf7f0;
    --dark: #0f172a;
    --white: #ffffff;
    --red: #b03232;
    --blue: #1a3a5c;
    --sky: #38bdf8;
    --light: #e0e7ff;
    --border: #d4e0d8;
    --shadow: 0 4px 20px rgba(15,39,92,0.12);
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body, button, input, select, textarea, h1, h2, h3, h4, h5, h6 { font-family: var(--font-main); }
  body { background: var(--cream); color: var(--dark); min-height: 100vh; line-height: 1.5; }
  
  .page { display: none; min-height: 100vh; animation: fadeIn .3s ease; }
  .page.active { display: block; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
  
  /* Navigation */
  nav { background: var(--green); color: #fff; display: flex; align-items: center; justify-content: space-between; padding: 0 28px; height: 68px; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 16px rgba(0,0,0,0.25); }
  .nav-brand { display: flex; align-items: center; gap: 12px; cursor: pointer; text-decoration: none; color: inherit; }
  .nav-logo { width: 44px; height: 44px; border-radius: 50%; background: var(--gold); display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 19px; color: var(--dark); border: 2px solid #fff; flex-shrink: 0; }
  .nav-title { font-size: 16px; font-weight: 700; line-height: 1.2; }
  .nav-title small { display: block; font-size: 10px; font-weight: 400; opacity: 0.85; letter-spacing: 0.5px; color: var(--sky); }
  .nav-links { display: flex; gap: 2px; align-items: center; }
  .nav-links button { background: none; border: none; color: #fff; padding: 8px 12px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; transition: background .2s; }
  .nav-links button:hover, .nav-links button.active { background: rgba(255,255,255,0.18); }
  .nav-right { display: flex; align-items: center; gap: 10px; }
  .btn-login { background: var(--gold); color: var(--dark); border: none; padding: 9px 18px; border-radius: 6px; font-weight: 700; font-size: 13px; cursor: pointer; transition: opacity .2s; }
  .btn-login:hover { opacity: 0.9; }
  
  /* Hero */
  .hero { background: linear-gradient(135deg, var(--green) 0%, var(--navy) 100%); color: #fff; padding: 64px 24px 50px; text-align: center; position: relative; overflow: hidden; }
  .hero-badge { display: inline-block; background: rgba(200,150,12,0.2); border: 1px solid var(--gold); color: var(--gold); padding: 5px 16px; border-radius: 20px; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px; }
  .hero h1 { font-size: clamp(26px, 4.5vw, 48px); font-weight: 900; line-height: 1.15; margin-bottom: 12px; }
  .hero h1 span { color: var(--gold); }
  .hero-motto { font-size: 18px; font-weight: 600; color: #fff; margin-bottom: 6px; font-style: italic; }
  .hero-tagline { font-size: 13px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--sky); margin-bottom: 28px; }
  .hero-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
  
  .btn-primary { background: var(--gold); color: var(--dark); border: none; padding: 12px 26px; border-radius: 6px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all .2s; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; }
  .btn-primary:hover { background: #e0a80e; transform: translateY(-1px); }
  .btn-outline { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.6); padding: 11px 24px; border-radius: 6px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all .2s; }
  .btn-outline:hover { border-color: #fff; background: rgba(255,255,255,0.12); }
  
  /* Units Strip */
  .units-strip { display: flex; gap: 0; overflow-x: auto; background: #fff; border-bottom: 1px solid var(--border); }
  .unit-card { flex: 1; min-width: 150px; padding: 16px 12px; text-align: center; border-right: 1px solid var(--border); cursor: pointer; transition: background .2s; }
  .unit-card:last-child { border-right: none; }
  .unit-card:hover { background: var(--light); }
  .unit-icon { font-size: 24px; margin-bottom: 4px; }
  .unit-card h4 { font-size: 13px; font-weight: 700; color: var(--green); }
  .unit-card p { font-size: 11px; color: #666; margin-top: 2px; }
  
  /* Layout Sections */
  .section { padding: 48px 24px; }
  .section-alt { background: #fff; }
  .container { max-width: 1080px; margin: 0 auto; }
  .section-label { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--gold); margin-bottom: 6px; }
  .section-title { font-size: clamp(22px, 3vw, 32px); font-weight: 700; color: var(--dark); margin-bottom: 10px; }
  .section-sub { font-size: 14px; color: #555; max-width: 650px; line-height: 1.6; margin-bottom: 30px; }
  
  .cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; }
  .card { background: #fff; border-radius: 10px; padding: 22px 20px; box-shadow: var(--shadow); border: 1px solid var(--border); transition: transform .2s, box-shadow .2s; }
  .card:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(15,39,92,0.15); }
  .card-icon { width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 14px; }
  .card h3 { font-size: 15px; font-weight: 700; color: var(--dark); margin-bottom: 6px; }
  .card p { font-size: 13px; color: #555; line-height: 1.5; }
  .card-link { display: inline-block; margin-top: 12px; font-size: 12px; font-weight: 700; color: var(--green); cursor: pointer; }
  
  /* Vision & Mission Box */
  .vm-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 10px; }
  .vm-card { background: linear-gradient(135deg, var(--navy) 0%, var(--green) 100%); color: #fff; border-radius: 12px; padding: 28px 24px; box-shadow: var(--shadow); }
  .vm-card h3 { font-size: 20px; color: var(--gold); margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
  .vm-card p, .vm-card ul { font-size: 14px; line-height: 1.6; opacity: 0.95; }
  .vm-card ul { margin-left: 18px; margin-top: 8px; }
  .vm-card li { margin-bottom: 4px; }
  
  /* Forms & Slips */
  .form-page { max-width: 680px; margin: 0 auto; background: #fff; border-radius: 12px; padding: 32px; box-shadow: var(--shadow); border: 1px solid var(--border); }
  .form-page h2 { font-size: 24px; margin-bottom: 4px; color: var(--dark); }
  .form-page .sub { font-size: 13px; color: #666; margin-bottom: 24px; }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
  .form-group { margin-bottom: 14px; }
  .form-group label { display: block; font-size: 12px; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
  .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px 12px; border: 1.5px solid var(--border); border-radius: 6px; font-size: 13px; color: var(--dark); background: var(--cream); }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: var(--green); background: #fff; }
  .form-group textarea { resize: vertical; min-height: 80px; }
  .btn-submit { width: 100%; padding: 12px; background: var(--green); color: #fff; border: none; border-radius: 6px; font-size: 14px; font-weight: 700; cursor: pointer; transition: background .2s; margin-top: 6px; }
  .btn-submit:hover { background: var(--navy); }
  
  /* Dashboards */
  .dash-layout { display: grid; grid-template-columns: 210px 1fr; min-height: calc(100vh - 68px); }
  .dash-sidebar { background: var(--dark); color: #fff; padding: 20px 0; }
  .dash-sidebar .user-info { padding: 0 18px 18px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 10px; }
  .dash-sidebar .user-info .avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--green); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; margin-bottom: 8px; color: #fff; }
  .dash-sidebar .user-info h4 { font-size: 13px; font-weight: 600; }
  .dash-sidebar .user-info span { font-size: 11px; color: rgba(255,255,255,0.6); }
  .dash-nav a { display: flex; align-items: center; gap: 10px; padding: 10px 18px; font-size: 13px; color: rgba(255,255,255,0.7); cursor: pointer; transition: all .2s; border-left: 3px solid transparent; }
  .dash-nav a:hover, .dash-nav a.active { color: #fff; background: rgba(255,255,255,0.08); border-left-color: var(--gold); }
  .dash-content { padding: 28px; background: var(--cream); overflow-y: auto; }
  .dash-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
  .dash-header h2 { font-size: 22px; color: var(--dark); }
  
  .dash-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px; }
  .dash-card { background: #fff; border-radius: 8px; padding: 16px; box-shadow: var(--shadow); border-bottom: 3px solid var(--green); }
  .dash-card .dc-val { font-size: 26px; font-weight: 900; color: var(--green); }
  .dash-card .dc-lbl { font-size: 11px; color: #666; margin-top: 2px; }
  
  .table-wrap { background: #fff; border-radius: 8px; box-shadow: var(--shadow); overflow: hidden; margin-bottom: 20px; border: 1px solid var(--border); }
  .table-head { padding: 14px 18px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border); background: var(--light); }
  .table-head h3 { font-size: 14px; font-weight: 700; color: var(--green); }
  table { width: 100%; border-collapse: collapse; }
  thead { background: #f1f5f9; }
  th { padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 700; color: var(--green); text-transform: uppercase; letter-spacing: 0.5px; }
  td { padding: 10px 14px; font-size: 12px; border-bottom: 1px solid var(--border); color: var(--dark); }
  tr:last-child td { border-bottom: none; }
  
  .badge { display: inline-block; padding: 3px 8px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; }
  .badge-green { background: #dbeafe; color: #1e3a8a; }
  .badge-gold { background: #fef3cd; color: #856404; }
  .badge-red { background: #fde8e8; color: #b03232; }
  
  .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 200; align-items: center; justify-content: center; }
  .modal-overlay.open { display: flex; }
  .modal { background: #fff; border-radius: 12px; padding: 32px; width: 90%; max-width: 400px; position: relative; box-shadow: 0 16px 40px rgba(0,0,0,0.3); }
  .modal-close { position: absolute; top: 12px; right: 14px; background: none; border: none; font-size: 20px; cursor: pointer; color: #888; }
  .modal h2 { font-size: 22px; margin-bottom: 4px; }
  .modal .sub { font-size: 12px; color: #666; margin-bottom: 18px; }
  
  .role-tabs { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 16px; }
  .role-tab { padding: 6px 10px; border: 1px solid var(--border); border-radius: 4px; font-size: 11px; font-weight: 600; cursor: pointer; transition: all .2s; background: none; }
  .role-tab.active { background: var(--green); color: #fff; border-color: var(--green); }
  
  .slip { background: #fff; border: 2px solid var(--green); border-radius: 10px; padding: 24px; max-width: 640px; margin: 0 auto; }
  .slip-header { display: flex; align-items: center; gap: 14px; border-bottom: 2px solid var(--green); padding-bottom: 14px; margin-bottom: 16px; }
  .slip-logo { width: 50px; height: 50px; border-radius: 50%; background: var(--green); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 900; font-size: 20px; flex-shrink: 0; }
  .slip-school { flex: 1; }
  .slip-school h2 { font-size: 18px; color: var(--green); }
  .slip-school p { font-size: 11px; color: #666; }
  .slip-no { background: var(--green); color: #fff; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 700; white-space: nowrap; }
  .slip-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px; }
  .slip-field { border: 1px solid var(--border); border-radius: 6px; padding: 8px 12px; }
  .slip-field .lbl { font-size: 9px; font-weight: 700; text-transform: uppercase; color: #888; margin-bottom: 2px; }
  .slip-field .val { font-size: 13px; font-weight: 600; color: var(--dark); }
  .slip-footer { border-top: 1px solid var(--border); padding-top: 14px; margin-top: 14px; display: flex; justify-content: space-between; align-items: center; font-size: 11px; color: #666; flex-wrap: wrap; gap: 8px; }
  .btn-print { background: var(--green); color: #fff; border: none; padding: 8px 18px; border-radius: 6px; font-weight: 700; cursor: pointer; }
  
  .arabic-text { font-family: 'Amiri', serif; direction: rtl; font-size: 15px; line-height: 1.6; color: var(--dark); }
  .alert { padding: 12px 16px; border-radius: 6px; font-size: 13px; margin-bottom: 16px; display: flex; align-items: center; gap: 10px; }
  .alert-success { background: #dbeafe; color: #1e3a8a; border-left: 4px solid var(--green); }
  .alert-info { background: #e0e7ff; color: #1e40af; border-left: 4px solid var(--blue); }
  
  /* Gallery Grid */
  .gallery-filters { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 20px; }
  .gallery-btn { padding: 6px 14px; border: 1px solid var(--border); background: #fff; border-radius: 20px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all .2s; }
  .gallery-btn.active, .gallery-btn:hover { background: var(--green); color: #fff; border-color: var(--green); }
  .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px; }
  .gallery-item { background: #fff; border-radius: 8px; overflow: hidden; border: 1px solid var(--border); box-shadow: var(--shadow); }
  .gallery-img { width: 100%; height: 160px; object-fit: cover; background: #e2e8f0; display: block; }
  .gallery-caption { padding: 12px; font-size: 12px; font-weight: 600; color: var(--dark); text-align: center; }
  
  /* Footer */
  footer { background: var(--dark); color: rgba(255,255,255,0.75); padding: 40px 24px 24px; font-size: 13px; }
  footer h4 { color: #fff; font-size: 18px; margin-bottom: 8px; }
  footer p { line-height: 1.6; margin-bottom: 12px; }
  footer a { color: var(--sky); text-decoration: none; }
  footer a:hover { text-decoration: underline; }
  #mgmt-portals-toggle:hover { background: rgba(255,255,255,0.12) !important; color: var(--gold); }
  .footer-grid { max-width: 1080px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 28px; margin-bottom: 28px; }
  .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 18px; text-align: center; font-size: 11px; opacity: 0.7; max-width: 1080px; margin: 0 auto; }
  
  .hidden { display: none; }
  .divider { border: none; border-top: 1px solid var(--border); margin: 20px 0; }
  
  @media(max-width:768px) {
    nav { padding: 0 16px; }
    .nav-links { display: none; }
    .dash-layout { grid-template-columns: 1fr; }
    .dash-sidebar { display: none; }
    .form-row { grid-template-columns: 1fr; }
    .hero { padding: 44px 16px 36px; }
    .section { padding: 36px 16px; }
  }
</style>
</head>
<body>

<nav>
  <div class="nav-brand" onclick="showPage('home')">
    <div class="nav-logo">P</div>
    <div class="nav-title">Plan Aid Academy<small>Educational Resource, Jos</small></div>
  </div>
  <div class="nav-links">
    <button onclick="showPage('home')" id="nav-home" class="active">Home</button>
    <button onclick="showPage('about')" id="nav-about">About Us</button>
    <button onclick="showPage('gallery')" id="nav-gallery">Gallery</button>
    <button onclick="showPage('admission')" id="nav-admission">Admissions</button>
    <button onclick="showPage('results')" id="nav-results">Results</button>
    <button onclick="showPage('arabic')" id="nav-arabic">Arabic Unit</button>
    <button onclick="showPage('contact')" id="nav-contact">Contact</button>
  </div>
  <div class="nav-right">
    <button class="btn-login" onclick="openStudentLogin()"><span style="margin-right:4px;">🎓</span> Student Login</button>
  </div>
</nav>

<!-- STUDENT LOGIN MODAL -->
<div class="modal-overlay" id="studentLoginModal">
  <div class="modal">
    <button class="modal-close" onclick="closeStudentLogin()">✕</button>
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
      <span style="font-size:24px;">🎓</span>
      <h2 style="margin-bottom:0;">Student Login</h2>
    </div>
    <p class="sub">Enter your Student ID or Reg No to access your student portal</p>
    <div class="form-group"><label>Student ID / Reg No</label><input type="text" id="studentUsername" placeholder="e.g. PAA-2023-0047 or PAA-2025-0001"/></div>
    <div class="form-group"><label>Password / Approval Code</label><input type="password" id="studentPassword" placeholder="Enter password or code"/></div>
    <button class="btn-submit" onclick="doStudentLogin()">Sign In as Student →</button>
    <div style="margin-top:14px;padding-top:12px;border-top:1px dashed var(--border);text-align:center;font-size:11px;color:#666;">
      Staff or Administrator? <a href="#site-footer" onclick="closeStudentLogin(); scrollToFooterPortals();" style="color:var(--green);font-weight:700;text-decoration:none;">Access Management Portals in Footer ↓</a>
    </div>
  </div>
</div>

<!-- MANAGEMENT & STAFF PORTAL MODAL -->
<div class="modal-overlay" id="portalLoginModal">
  <div class="modal">
    <button class="modal-close" onclick="closePortalLogin()">✕</button>
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
      <span style="font-size:24px;">🏛️</span>
      <h2 style="margin-bottom:0;">Management Portal</h2>
    </div>
    <p class="sub">Select your portal role to continue</p>
    <div class="role-tabs">
      <button class="role-tab active" id="tab-principal" onclick="setRole(this,'principal')">🎓 Principal</button>
      <button class="role-tab" id="tab-staff" onclick="setRole(this,'staff')">👩‍🏫 Staff</button>
      <button class="role-tab" id="tab-arabic" onclick="setRole(this,'arabic')">☪️ Arabic Unit</button>
      <button class="role-tab" id="tab-finance" onclick="setRole(this,'finance')">💰 Finance</button>
    </div>
    <div class="form-group"><label>Staff / User ID</label><input type="text" id="portalUsername" placeholder="e.g. PAA-ST-001 or Staff ID"/></div>
    <div class="form-group"><label>Password / Approval Code</label><input type="password" id="portalPassword" placeholder="Enter password or code"/></div>
    <button class="btn-submit" onclick="doPortalLogin()">Sign In to Portal →</button>
    <div style="margin-top:14px;padding-top:12px;border-top:1px dashed var(--border);text-align:center;font-size:11px;color:#666;">
      Are you a student? <a href="javascript:void(0)" onclick="closePortalLogin(); openStudentLogin();" style="color:var(--green);font-weight:700;text-decoration:none;">Go to Student Login ↑</a>
    </div>
  </div>
</div>

<!-- CREDENTIALS MODAL -->
<div class="modal-overlay" id="credModal">
  <div class="modal">
    <button class="modal-close" onclick="closeCredModal()">✕</button>
    <h2 style="color:var(--green);font-size:20px;">Access Approved! 🎉</h2>
    <p class="sub">Share these credentials with the user for portal access.</p>
    <div style="background:var(--cream);border:1.5px dashed var(--green);border-radius:8px;padding:16px;margin-bottom:18px;">
      <div style="font-size:12px;color:#555;margin-bottom:6px;">Name: <strong id="credName" style="color:var(--dark);">—</strong></div>
      <div style="font-size:12px;color:#555;margin-bottom:6px;">Role / Unit: <strong id="credRole" style="color:var(--dark);">—</strong></div>
      <div style="font-size:12px;color:#555;margin-bottom:6px;">Username: <strong id="credUsername" style="color:var(--green);">—</strong></div>
      <div style="font-size:12px;color:#555;">Approval Code: <strong id="credPassword" style="color:var(--red);">—</strong></div>
    </div>
    <button class="btn-submit" onclick="closeCredModal()">Done</button>
  </div>
</div>

<!-- HOME PAGE -->
<div class="page active" id="page-home">
  <div class="hero">
    <div class="hero-badge">📍 JOS, PLATEAU STATE · SCIENCE &amp; ICT CENTRE OF EXCELLENCE</div>
    <h1>PLAN AID ACADEMY<br/><span style="color:var(--gold);">&amp; EDUCATIONAL RESOURCE, JOS</span></h1>
    <p class="hero-motto">"Empowering Knowledge, Igniting Innovation"</p>
    <p class="hero-tagline">A SCIENCE AND ICT-BASED CENTRE OF EXCELLENCE</p>
    <div class="hero-btns">
      <button class="btn-primary" onclick="showPage('admission')">Apply for Admission</button>
      <button class="btn-outline" onclick="showPage('results')">Check Results</button>
      <button class="btn-outline" onclick="showPage('about')">About Us</button>
      <button class="btn-outline" onclick="showPage('contact')">Contact Us</button>
    </div>
  </div>

  <div class="units-strip">
    <div class="unit-card" onclick="showPage('admission')"><div class="unit-icon">🌱</div><h4>Nursery School</h4><p>Foundation &amp; Pre-school</p></div>
    <div class="unit-card" onclick="showPage('admission')"><div class="unit-icon">✏️</div><h4>Primary School</h4><p>Primary 1 – 6</p></div>
    <div class="unit-card" onclick="showPage('admission')"><div class="unit-icon">📚</div><h4>Secondary School</h4><p>JSS &amp; SSS STEM Track</p></div>
    <div class="unit-card" onclick="showPage('arabic')"><div class="unit-icon">☪️</div><h4>Arabic Unit</h4><p>Qur'an &amp; Islamic Studies</p></div>
    <div class="unit-card" onclick="openStudentLogin()"><div class="unit-icon">🎓</div><h4>Student Login</h4><p>Result &amp; Student Access</p></div>
    <div class="unit-card" onclick="openPortalLogin('principal')"><div class="unit-icon">🏛️</div><h4>Staff Portals</h4><p>Principal, Staff &amp; Finance</p></div>
  </div>

  <!-- ABOUT US SUMMARY -->
  <div class="section section-alt">
    <div class="container">
      <div class="section-label">Official Overview</div>
      <div class="section-title">About Plan Aid Academy</div>
      <p style="font-size:15px;color:#444;line-height:1.7;max-width:840px;margin-bottom:24px;">
        At <strong>PLAN AID ACADEMY</strong>, we are dedicated to nurturing young minds through a balanced blend of <strong>scientific inquiry</strong>, <strong>technological innovation</strong>, and <strong>creative learning</strong>. Our mission is to empower students with practical skills and digital literacy that prepare them for the dynamic world of science and technology.
      </p>
      <button class="btn-primary" onclick="showPage('about')">Read Full About Us →</button>
    </div>
  </div>

  <!-- OUR FOCUS AREAS -->
  <div class="section">
    <div class="container">
      <div class="section-label">Core Pillars</div>
      <div class="section-title">Our Focus Areas</div>
      <p class="section-sub">Empowering 21st-century learners through STEM-driven education and strong moral foundations.</p>
      <div class="cards-grid">
        <div class="card">
          <div class="card-icon" style="background:#dbeafe">🔬</div>
          <h3>SCIENCE EDUCATION</h3>
          <p>Hands-on experiences, critical thinking, and problem-solving approaches that inspire discovery and innovation.</p>
        </div>
        <div class="card">
          <div class="card-icon" style="background:#fef3cd">💻</div>
          <h3>ICT INTEGRATION</h3>
          <p>State-of-the-art computer laboratories, coding lessons, robotics, and digital skills development for 21st-century learners.</p>
        </div>
        <div class="card">
          <div class="card-icon" style="background:#e0e7ff">💡</div>
          <h3>INNOVATION &amp; CREATIVITY</h3>
          <p>Encouraging students to design, build, and explore through science fairs, tech projects, and digital creativity programs.</p>
        </div>
        <div class="card">
          <div class="card-icon" style="background:#fde8e8">🎓</div>
          <h3>ACADEMIC EXCELLENCE</h3>
          <p>A robust curriculum that combines STEM subjects with strong moral and intellectual foundations.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- VISION & MISSION -->
  <div class="section section-alt">
    <div class="container">
      <div class="section-label">Institutional Philosophy</div>
      <div class="section-title">Our Vision &amp; Mission</div>
      <div class="vm-grid">
        <div class="vm-card">
          <h3>👁️ OUR VISION</h3>
          <p>To become a leading Science and ICT Institution producing learners who are <strong>Innovative, Analytical, And Globally Competitive.</strong></p>
        </div>
        <div class="vm-card" style="background: linear-gradient(135deg, #0b1d3a 0%, var(--green) 100%);">
          <h3>🎯 OUR MISSION</h3>
          <p>To provide quality education through:</p>
          <ul>
            <li>Modern science and technology facilities</li>
            <li>Qualified and passionate educators</li>
            <li>Interactive, project-based learning</li>
            <li>Continuous digital skill development</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- WHY CHOOSE US -->
  <div class="section">
    <div class="container">
      <div class="section-label">Excellence Guaranteed</div>
      <div class="section-title">Why Choose Us</div>
      <div class="cards-grid">
        <div class="card"><div class="card-icon" style="background:#dbeafe">👩‍🏫</div><h3>Qualified &amp; Experienced Teachers</h3><p>Dedicated educators committed to academic and moral excellence.</p></div>
        <div class="card"><div class="card-icon" style="background:#fef3cd">🔬</div><h3>Modern Science &amp; Computer Labs</h3><p>Well-equipped laboratory spaces for practical learning and discovery.</p></div>
        <div class="card"><div class="card-icon" style="background:#e0e7ff">🤖</div><h3>Coding &amp; Robotics Programs</h3><p>Early exposure to programming, robotics, and computational thinking.</p></div>
        <div class="card"><div class="card-icon" style="background:#dbeafe">📱</div><h3>E-Learning &amp; Digital Tools</h3><p>Smart learning tools to support classroom and practical instruction.</p></div>
        <div class="card"><div class="card-icon" style="background:#fde8e8">🏆</div><h3>Science &amp; Tech Competitions</h3><p>Fostering healthy academic rivalry and innovation through STEM contests.</p></div>
        <div class="card"><div class="card-icon" style="background:#fef3cd">🏫</div><h3>Conducive Learning Environment</h3><p>Safe, serene, and disciplined atmosphere designed for focused learning.</p></div>
      </div>
    </div>
  </div>

  <!-- SCIENCE & ICT HIGHLIGHT -->
  <div class="section section-alt">
    <div class="container">
      <div class="section-label">Special Focus</div>
      <div class="section-title">Science &amp; ICT Specialization</div>
      <p class="section-sub">At Plan Aid Academy, science and technology form the heart of our curriculum.</p>
      <div class="cards-grid" style="grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));">
        <div class="card" style="text-align:center;padding:16px;"><div style="font-size:24px;margin-bottom:6px">🧪</div><h4 style="font-size:13px">Science Education</h4></div>
        <div class="card" style="text-align:center;padding:16px;"><div style="font-size:24px;margin-bottom:6px">🖥️</div><h4 style="font-size:13px">Computer Education</h4></div>
        <div class="card" style="text-align:center;padding:16px;"><div style="font-size:24px;margin-bottom:6px">💻</div><h4 style="font-size:13px">Coding &amp; Logic</h4></div>
        <div class="card" style="text-align:center;padding:16px;"><div style="font-size:24px;margin-bottom:6px">🤖</div><h4 style="font-size:13px">Robotics</h4></div>
        <div class="card" style="text-align:center;padding:16px;"><div style="font-size:24px;margin-bottom:6px">📊</div><h4 style="font-size:13px">Digital Skills</h4></div>
        <div class="card" style="text-align:center;padding:16px;"><div style="font-size:24px;margin-bottom:6px">🔬</div><h4 style="font-size:13px">Science Projects</h4></div>
        <div class="card" style="text-align:center;padding:16px;"><div style="font-size:24px;margin-bottom:6px">🏅</div><h4 style="font-size:13px">Tech Competitions</h4></div>
        <div class="card" style="text-align:center;padding:16px;"><div style="font-size:24px;margin-bottom:6px">🎨</div><h4 style="font-size:13px">Creative Learning</h4></div>
      </div>
    </div>
  </div>

</div>

<!-- ABOUT US PAGE -->
<div class="page" id="page-about">
  <div class="section">
    <div class="container">
      <div class="section-label">Official Profile</div>
      <div class="section-title">About Us</div>
      <div style="background:#fff;border-radius:12px;padding:32px;box-shadow:var(--shadow);border:1px solid var(--border);margin-bottom:24px;">
        <p style="font-size:16px;color:var(--dark);line-height:1.8;margin-bottom:16px;">
          "At PLAN AID ACADEMY, we are dedicated to nurturing young minds through a balanced blend of scientific inquiry, technological innovation, and creative learning. Our mission is to empower students with practical skills and digital literacy that prepare them for the dynamic world of science and technology."
        </p>
      </div>

      <div class="section-label">Core Pillars</div>
      <div class="cards-grid" style="margin-bottom:30px;">
        <div class="card"><h3>School Introduction</h3><p>Plan Aid Academy &amp; Educational Resource, Jos, provides quality, structured education from foundation nursery through primary and secondary levels.</p></div>
        <div class="card"><h3>Science &amp; Tech Focus</h3><p>We emphasize STEM education with modern laboratory experiments, technological literacy, and practical application.</p></div>
        <div class="card"><h3>Practical Learning</h3><p>Hands-on activities, project-based assignments, and science fairs designed to spark curiosity.</p></div>
        <div class="card"><h3>Digital Literacy</h3><p>Comprehensive computer education, coding fundamentals, and robotics training for 21st-century preparedness.</p></div>
        <div class="card"><h3>Student Development</h3><p>Fostering academic excellence, moral integrity, leadership skills, and creative problem-solving.</p></div>
      </div>

      <div class="vm-grid">
        <div class="vm-card">
          <h3>👁️ OUR VISION</h3>
          <p>To become a leading Science and ICT Institution producing learners who are <strong>Innovative, Analytical, And Globally Competitive.</strong></p>
        </div>
        <div class="vm-card">
          <h3>🎯 OUR MISSION</h3>
          <p>To provide quality education through modern science facilities, passionate educators, project learning, and continuous digital skill development.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- GALLERY PAGE -->
<div class="page" id="page-gallery">
  <div class="section">
    <div class="container">
      <div class="section-label">School Media</div>
      <div class="section-title">Photo Gallery</div>
      <p class="section-sub">Moments of discovery, learning, and achievement at Plan Aid Academy &amp; Educational Resource, Jos.</p>
      
      <div class="gallery-filters">
        <button class="gallery-btn active" onclick="filterGallery('all')">All Photos</button>
        <button class="gallery-btn" onclick="filterGallery('science')">Science Education</button>
        <button class="gallery-btn" onclick="filterGallery('ict')">ICT &amp; Robotics</button>
        <button class="gallery-btn" onclick="filterGallery('students')">Students &amp; Classrooms</button>
        <button class="gallery-btn" onclick="filterGallery('events')">Events &amp; Graduation</button>
      </div>

      <div class="gallery-grid">
        <div class="gallery-item" data-cat="science">
          <img class="gallery-img" src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=600&auto=format&fit=crop" alt="Science Laboratory"/>
          <div class="gallery-caption">Science Lab Practical</div>
        </div>
        <div class="gallery-item" data-cat="ict">
          <img class="gallery-img" src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&auto=format&fit=crop" alt="Computer Laboratory"/>
          <div class="gallery-caption">ICT Computer Laboratory</div>
        </div>
        <div class="gallery-item" data-cat="ict">
          <img class="gallery-img" src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=600&auto=format&fit=crop" alt="Robotics Workshop"/>
          <div class="gallery-caption">Coding &amp; Robotics Session</div>
        </div>
        <div class="gallery-item" data-cat="students">
          <img class="gallery-img" src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&auto=format&fit=crop" alt="Classroom Learning"/>
          <div class="gallery-caption">Interactive Classroom</div>
        </div>
        <div class="gallery-item" data-cat="events">
          <img class="gallery-img" src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600&auto=format&fit=crop" alt="Graduation Event"/>
          <div class="gallery-caption">Graduation &amp; Prize Giving</div>
        </div>
        <div class="gallery-item" data-cat="science">
          <img class="gallery-img" src="https://images.unsplash.com/photo-1507668077129-56e32842fceb?w=600&auto=format&fit=crop" alt="Science Project"/>
          <div class="gallery-caption">Science Fair Demonstration</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ADMISSION PAGE -->
<div class="page" id="page-admission">
  <div class="section">
    <div class="container">
      <div class="section-label">Enrolment</div>
      <div class="section-title">Admission Application</div>
      <p class="section-sub">Complete the official application form for admission into Plan Aid Academy &amp; Educational Resource, Jos.</p>

      <div id="admissionForm">
        <div class="form-page">
          <h2>Student Admission Form</h2>
          <p class="sub">Plan Aid Academy &amp; Educational Resource, Jos · 2025/2026 Academic Session</p>
          <div class="form-group"><label>School Unit Applying For</label>
            <select id="admUnit">
              <option value="">— Select Unit —</option>
              <option>Nursery School (Creche / Pre-Nursery / Nursery 1-2)</option>
              <option>Primary School (Primary 1 – 6)</option>
              <option>Junior Secondary School (JSS 1 – 3 STEM Track)</option>
              <option>Senior Secondary School (SSS 1 – 3 Science/ICT Track)</option>
              <option>Arabic / Islamic Studies Unit</option>
            </select>
          </div>
          <div class="form-row">
            <div class="form-group"><label>Surname</label><input id="admSurname" type="text" placeholder="Student's surname"/></div>
            <div class="form-group"><label>First Name</label><input id="admFirst" type="text" placeholder="First name"/></div>
          </div>
          <div class="form-row">
            <div class="form-group"><label>Date of Birth</label><input id="admDob" type="date"/></div>
            <div class="form-group"><label>Gender</label><select id="admGender"><option>Male</option><option>Female</option></select></div>
          </div>
          <div class="form-row">
            <div class="form-group"><label>State of Origin</label><input id="admState" type="text" placeholder="e.g. Plateau"/></div>
            <div class="form-group"><label>Religion</label><select id="admReligion"><option>Islam</option><option>Christianity</option><option>Other</option></select></div>
          </div>
          <div class="divider"></div>
          <div class="form-row">
            <div class="form-group"><label>Parent / Guardian Name</label><input id="admParent" type="text" placeholder="Full name"/></div>
            <div class="form-group"><label>Phone Number</label><input id="admPhone" type="tel" placeholder="08030459595"/></div>
          </div>
          <div class="form-group"><label>Home Address</label><textarea id="admAddress" placeholder="Address in Jos, Plateau State"></textarea></div>
          <button class="btn-submit" onclick="submitAdmission()">Submit Application &amp; Generate Admission Slip</button>
        </div>
      </div>

      <div id="admissionSlip" class="hidden" style="margin-top:24px">
        <div class="alert alert-success">✅ Application submitted successfully! Print or save your admission slip below.</div>
        <div class="slip">
          <div class="slip-header">
            <div class="slip-logo">P</div>
            <div class="slip-school">
              <h2>Plan Aid Academy</h2>
              <p>&amp; Educational Resource, Jos</p>
              <p style="font-size:11px;color:#666">2025/2026 Session – Official Admission Slip</p>
            </div>
            <div class="slip-no" id="slipNo">PAA-2025-0001</div>
          </div>
          <div class="slip-row">
            <div class="slip-field"><div class="lbl">Full Name</div><div class="val" id="slipName">—</div></div>
            <div class="slip-field"><div class="lbl">Unit Applied</div><div class="val" id="slipUnit">—</div></div>
          </div>
          <div class="slip-row">
            <div class="slip-field"><div class="lbl">Date of Birth</div><div class="val" id="slipDob">—</div></div>
            <div class="slip-field"><div class="lbl">Gender</div><div class="val" id="slipGender">—</div></div>
          </div>
          <div class="slip-row">
            <div class="slip-field"><div class="lbl">Parent / Guardian</div><div class="val" id="slipParent">—</div></div>
            <div class="slip-field"><div class="lbl">Phone Number</div><div class="val" id="slipPhone">—</div></div>
          </div>
          <div class="slip-footer">
            <div>Application Date: <b id="slipDate"></b></div>
            <div>Status: <span class="badge badge-gold">Pending Review</span></div>
            <button class="btn-print" onclick="window.print()">🖨️ Print Slip</button>
          </div>
        </div>
        <div style="text-align:center;margin-top:18px">
          <button onclick="newApplication()" style="background:none;border:2px solid var(--green);color:var(--green);padding:10px 20px;border-radius:6px;font-weight:600;cursor:pointer;">Submit Another Application</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- RESULTS PAGE -->
<div class="page" id="page-results">
  <div class="section">
    <div class="container">
      <div class="section-label">Academic Portal</div>
      <div class="section-title">Student Result Checking</div>
      <p class="section-sub">Check and print official term performance report cards.</p>

      <div class="form-page" style="margin-bottom:24px">
        <h2>Check Terminal Results</h2>
        <p class="sub">Enter student details below to generate the academic report card</p>
        <div class="form-row">
          <div class="form-group"><label>Student ID / Reg Number</label><input id="resId" type="text" placeholder="e.g. PAA-2023-0047"/></div>
          <div class="form-group"><label>Academic Session</label><select><option>2024/2025</option><option>2023/2024</option></select></div>
        </div>
        <div class="form-row">
          <div class="form-group"><label>Term</label><select><option>1st Term</option><option>2nd Term</option><option>3rd Term</option></select></div>
          <div class="form-group"><label>School Unit</label><select><option>Secondary School</option><option>Primary School</option><option>Nursery School</option><option>Arabic Unit</option></select></div>
        </div>
        <button class="btn-submit" onclick="checkResults()">View Academic Report Card</button>
      </div>

      <div id="resultCard" class="hidden">
        <div class="alert alert-info">📄 Displaying academic report card for <b>Aisha Mohammed</b> · JSS 2A</div>
        <div class="slip" style="max-width:720px">
          <div class="slip-header">
            <div class="slip-logo">P</div>
            <div class="slip-school">
              <h2>Plan Aid Academy &amp; Educational Resource, Jos</h2>
              <p>Student Performance Report Card · 1st Term 2024/2025</p>
            </div>
            <div class="slip-no">JSS 2A</div>
          </div>
          <div class="slip-row" style="grid-template-columns:1fr 1fr 1fr">
            <div class="slip-field"><div class="lbl">Student Name</div><div class="val">Aisha Mohammed</div></div>
            <div class="slip-field"><div class="lbl">Admission No.</div><div class="val">PAA-2023-0047</div></div>
            <div class="slip-field"><div class="lbl">Class Track</div><div class="val">JSS 2 STEM</div></div>
          </div>
          <div class="table-wrap" style="margin:14px 0">
            <table>
              <thead><tr><th>Subject</th><th>CA (40)</th><th>Exam (60)</th><th>Total</th><th>Grade</th><th>Remark</th></tr></thead>
              <tbody>
                <tr><td>Computer Studies / ICT</td><td>38</td><td>56</td><td>94</td><td><span class="badge badge-green">A</span></td><td>Excellent</td></tr>
                <tr><td>Basic Science</td><td>34</td><td>52</td><td>86</td><td><span class="badge badge-green">A</span></td><td>Excellent</td></tr>
                <tr><td>Mathematics</td><td>32</td><td>50</td><td>82</td><td><span class="badge badge-green">A</span></td><td>Very Good</td></tr>
                <tr><td>English Language</td><td>30</td><td>48</td><td>78</td><td><span class="badge badge-green">B</span></td><td>Good</td></tr>
                <tr><td>Basic Technology</td><td>35</td><td>51</td><td>86</td><td><span class="badge badge-green">A</span></td><td>Excellent</td></tr>
                <tr><td>Arabic Language</td><td>38</td><td>57</td><td>95</td><td><span class="badge badge-green">A</span></td><td>Excellent</td></tr>
              </tbody>
            </table>
          </div>
          <div class="slip-row">
            <div class="slip-field"><div class="lbl">Total Score</div><div class="val" style="color:var(--green)">521 / 600</div></div>
            <div class="slip-field"><div class="lbl">Average</div><div class="val" style="color:var(--green)">86.8%</div></div>
            <div class="slip-field"><div class="lbl">Position</div><div class="val">2nd / 38</div></div>
            <div class="slip-field"><div class="lbl">Next Term</div><div class="val">Jan 13, 2025</div></div>
          </div>
          <div class="slip-footer">
            <div>Principal: <b>Plan Aid Academy Management</b></div>
            <button class="btn-print" onclick="window.print()">🖨️ Print Report</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ARABIC PAGE -->
<div class="page" id="page-arabic">
  <div class="hero" style="padding:40px 20px 32px">
    <div class="hero-badge">☪️ ARABIC &amp; ISLAMIC STUDIES UNIT</div>
    <h1>Arabic &amp; <span style="color:var(--gold)">Islamic Education</span></h1>
    <p class="hero-motto">Integrating Qur'anic Memorization, Tajweed, and Arabic Literacy</p>
  </div>
  <div class="section section-alt">
    <div class="container">
      <div class="cards-grid">
        <div class="card"><div class="card-icon" style="background:#fef3cd;font-size:24px">📖</div><h3>Qur'anic Studies</h3><p class="arabic-text">تحفيظ القرآن الكريم وتجويده</p><p style="margin-top:6px;">Hifz, Tajweed, and Tafseer classes from foundational to advanced levels.</p></div>
        <div class="card"><div class="card-icon" style="background:#dbeafe;font-size:24px">✍️</div><h3>Arabic Language</h3><p class="arabic-text">اللغة العربية – قراءة وكتابة ومحادثة</p><p style="margin-top:6px;">Grammar, reading comprehension, and spoken Arabic development.</p></div>
        <div class="card"><div class="card-icon" style="background:#e0e7ff;font-size:24px">🕌</div><h3>Islamic Studies</h3><p class="arabic-text">الفقه والعقيدة والسيرة النبوية</p><p style="margin-top:6px;">Fiqh, Aqeedah, Seerah, and moral character building.</p></div>
        <div class="card"><div class="card-icon" style="background:#fde8e8;font-size:24px">📜</div><h3>Bilingual Certification</h3><p class="arabic-text">شهادة وتقارير باللغتين</p><p style="margin-top:6px;">Bilingual academic evaluation cards issued in Arabic and English.</p></div>
      </div>
      <div style="margin-top:28px;text-align:center">
        <button class="btn-primary" onclick="showPage('admission')">Apply for Arabic Unit Admission</button>
      </div>
    </div>
  </div>
</div>

<!-- CONTACT PAGE -->
<div class="page" id="page-contact">
  <div class="section">
    <div class="container">
      <div class="section-label">Official Location</div>
      <div class="section-title">Contact Us</div>
      <p class="section-sub">We welcome enquiries from parents, guardians, and prospective students.</p>

      <div class="cards-grid" style="margin-bottom:28px">
        <div class="card">
          <div class="card-icon" style="background:#dbeafe">📍</div>
          <h3>Address</h3>
          <p>A.U TETENGI HOUSE,<br/>No 107/1 BAUCHI ROAD,<br/>JOS, JOS NORTH,<br/>PLATEAU STATE</p>
        </div>
        <div class="card">
          <div class="card-icon" style="background:#fef3cd">📞</div>
          <h3>Phone Numbers</h3>
          <p><a href="tel:08030459595" style="color:var(--green);font-weight:700;">08030459595</a><br/><a href="tel:08088552501" style="color:var(--green);font-weight:700;">08088552501</a></p>
        </div>
        <div class="card">
          <div class="card-icon" style="background:#e0e7ff">✉️</div>
          <h3>Email Address</h3>
          <p><a href="mailto:planaidjos@gmail.com" style="color:var(--green);font-weight:700;">planaidjos@gmail.com</a></p>
        </div>
      </div>

      <div class="form-page">
        <h2>Send Us a Message</h2>
        <div class="form-group"><label>Your Name</label><input type="text" placeholder="Full name"/></div>
        <div class="form-group"><label>Phone or Email</label><input type="text" placeholder="Contact info"/></div>
        <div class="form-group"><label>Message</label><textarea placeholder="Type your message or enquiry here..."></textarea></div>
        <button class="btn-submit" onclick="alert('Thank you for contacting Plan Aid Academy. We will get back to you shortly.');">Submit Enquiry</button>
      </div>
    </div>
  </div>
</div>

<!-- SITE FOOTER WITH PORTALS -->
<footer id="site-footer">
  <div class="footer-grid">
    <div>
      <h4>Plan Aid Academy &amp; Educational Resource, Jos</h4>
      <p style="font-size:12px;color:var(--gold);margin-bottom:4px;">"Empowering Knowledge, Igniting Innovation"</p>
      <p style="font-size:11px;color:var(--sky);">A Science and ICT-Based Centre of Excellence</p>
    </div>
    <div>
      <h4 style="font-size:15px">Contact Details</h4>
      <p style="font-size:12px">📍 A.U TETENGI HOUSE, No 107/1 BAUCHI ROAD, JOS, JOS NORTH, PLATEAU STATE</p>
      <p style="font-size:12px">📞 <a href="tel:08030459595">08030459595</a> | <a href="tel:08088552501">08088552501</a></p>
      <p style="font-size:12px">✉️ <a href="mailto:planaidjos@gmail.com">planaidjos@gmail.com</a></p>
    </div>
    <div>
      <h4 id="mgmt-portals-toggle" onclick="toggleManagementPortals()" style="font-size:15px; cursor:pointer; user-select:none; display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,0.06); padding:6px 12px; border-radius:6px; transition:all 0.2s ease;">
        <span>Management Portals</span>
        <span id="mgmt-portals-arrow" style="font-size:10px; transition:transform 0.3s ease; opacity:0.8;">▼</span>
      </h4>
      <div id="mgmt-portals-container" style="display:none; margin-top:10px;">
        <p style="font-size:12px"><a href="javascript:void(0)" onclick="openPortalLogin('principal')">🎓 Principal Portal</a></p>
        <p style="font-size:12px"><a href="javascript:void(0)" onclick="openPortalLogin('staff')">👩‍🏫 Staff Portal</a></p>
        <p style="font-size:12px"><a href="javascript:void(0)" onclick="openPortalLogin('arabic')">☪️ Arabic Unit Portal</a></p>
        <p style="font-size:12px"><a href="javascript:void(0)" onclick="openPortalLogin('finance')">💰 Finance Portal</a></p>
      </div>
    </div>
    <div>
      <h4 style="font-size:15px">Quick Links</h4>
      <p style="font-size:12px"><a href="#" onclick="showPage('home')">Home</a> · <a href="#" onclick="showPage('about')">About Us</a> · <a href="#" onclick="showPage('admission')">Admissions</a></p>
      <p style="font-size:12px"><a href="#" onclick="showPage('results')">Results</a> · <a href="#" onclick="showPage('gallery')">Gallery</a> · <a href="#" onclick="showPage('arabic')">Arabic Unit</a></p>
      <p style="font-size:12px"><a href="#" onclick="showPage('contact')">Contact Us</a> · <a href="javascript:void(0)" onclick="openStudentLogin()">Student Login</a></p>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; 2025 Plan Aid Academy &amp; Educational Resource, Jos. All rights reserved.
  </div>
</footer>

<!-- DASHBOARD PAGE -->
<div class="page" id="page-dashboard">
  <div class="dash-layout">
    <div class="dash-sidebar">
      <div class="user-info">
        <div class="avatar" id="dashAvatar">P</div>
        <h4 id="dashName">Principal's Office</h4>
        <span id="dashRole">Administrator</span>
      </div>
      <div class="dash-nav">
        <a class="active" onclick="showDashSection('overview')"><span class="ico">🏠</span> Overview</a>
        <a onclick="showDashSection('students')"><span class="ico">👥</span> Students</a>
        <a onclick="showDashSection('staff')"><span class="ico">👩‍🏫</span> Staff Management</a>
        <a onclick="showDashSection('admissions')"><span class="ico">📝</span> Admissions</a>
        <a onclick="showDashSection('results')"><span class="ico">📊</span> Results</a>
        <a onclick="showDashSection('finance')"><span class="ico">💰</span> Finance</a>
        <a onclick="logOut()"><span class="ico">🚪</span> Log Out</a>
      </div>
    </div>
    <div class="dash-content">
      <div class="dash-header">
        <h2 id="dashSectionTitle">School Management Portal</h2>
        <span class="badge badge-green" id="dashUnitBadge">Official Access</span>
      </div>

      <div id="ds-overview">
        <div class="dash-cards">
          <div class="dash-card"><div class="dc-val">4</div><div class="dc-lbl">School Units</div></div>
          <div class="dash-card"><div class="dc-val">STEM</div><div class="dc-lbl">Science &amp; ICT Track</div></div>
          <div class="dash-card"><div class="dc-val" id="dashAppCount">0</div><div class="dc-lbl">Submitted Applications</div></div>
          <div class="dash-card"><div class="dc-val" style="color:var(--green)">Active</div><div class="dc-lbl">Portal Status</div></div>
        </div>

        <div class="table-wrap">
          <div class="table-head"><h3>School Units Directory</h3></div>
          <table>
            <thead><tr><th>Unit</th><th>Focus</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td>🌱 Nursery School</td><td>Foundation Learning</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>✏️ Primary School</td><td>Core STEM Foundation</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>📚 Secondary School</td><td>Science &amp; ICT Specialization</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>☪️ Arabic Unit</td><td>Qur'an &amp; Islamic Studies</td><td><span class="badge badge-green">Active</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="ds-students" class="hidden">
        <div class="table-wrap">
          <div class="table-head"><h3>Student Register</h3></div>
          <table>
            <thead><tr><th>Adm No.</th><th>Name</th><th>Unit Track</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td>PAA-2023-0047</td><td>Aisha Mohammed</td><td>JSS 2 STEM</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>PAA-2024-0112</td><td>Ibrahim Hassan</td><td>SSS 2 Science</td><td><span class="badge badge-green">Active</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="ds-staff" class="hidden">
        <div class="table-wrap">
          <div class="table-head">
            <h3>Staff Directory</h3>
            <button class="btn-primary" style="font-size:11px;padding:5px 12px" onclick="openAddStaff()">+ Add Staff</button>
          </div>
          <table>
            <thead><tr><th>Staff ID</th><th>Name</th><th>Role</th><th>Unit</th><th>Subject</th><th>Status</th></tr></thead>
            <tbody id="staffTableBody">
              <tr><td>PAA-ST-001</td><td>Science Coordinator</td><td>Head of STEM</td><td>Secondary</td><td>Science/ICT</td><td><span class="badge badge-green">Approved</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="ds-admissions" class="hidden">
        <div class="table-wrap">
          <div class="table-head"><h3>Submitted Applications</h3></div>
          <table>
            <thead><tr><th>App No.</th><th>Name</th><th>Unit</th><th>Date</th><th>Status</th><th>Action</th></tr></thead>
            <tbody id="admissionsTableBody">
              <tr><td colspan="6" style="text-align:center;color:#888;">No pending applications yet.</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="ds-results" class="hidden">
        <div class="alert alert-info">📊 Terminal examination and continuous assessment entry portal.</div>
      </div>

      <div id="ds-finance" class="hidden">
        <div class="dash-cards">
          <div class="dash-card"><div class="dc-val">100%</div><div class="dc-lbl">Transparent Records</div></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ADD STAFF MODAL -->
<div class="modal-overlay" id="addStaffModal">
  <div class="modal">
    <button class="modal-close" onclick="closeAddStaffModal()">✕</button>
    <h2>Add New Staff Member</h2>
    <p class="sub">Register staff and generate portal access code</p>
    <div class="form-group"><label>Full Name</label><input type="text" id="staffName" placeholder="e.g. Mrs. Fatima Sani"/></div>
    <div class="form-group"><label>Role</label>
      <select id="staffRole">
        <option value="">— Select Role —</option>
        <option>Subject Teacher</option>
        <option>Class Teacher</option>
        <option>ICT Instructor</option>
        <option>Lab Instructor</option>
        <option>Head of Department</option>
      </select>
    </div>
    <div class="form-group"><label>Unit</label>
      <select id="staffUnit">
        <option value="">— Select Unit —</option>
        <option>Secondary School</option>
        <option>Primary School</option>
        <option>Nursery School</option>
        <option>Arabic Unit</option>
      </select>
    </div>
    <div class="form-group"><label>Subject / Specialization</label><input type="text" id="staffSubject" placeholder="e.g. Computer Science"/></div>
    <button class="btn-submit" onclick="addStaffMember()">Generate Staff Access Code</button>
  </div>
</div>

<script>
let currentRole = 'principal';
let activePortalUserType = '';
let activeAllowedSections = [];
let appCounter = 0;
let staffCounter = 1;
let submittedApplications = JSON.parse(localStorage.getItem('paa_submitted_apps') || '[]');

function showPage(pageId) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  const target = document.getElementById('page-' + pageId);
  if (target) target.classList.add('active');
  
  document.querySelectorAll('.nav-links button').forEach(b => b.classList.remove('active'));
  const navBtn = document.getElementById('nav-' + pageId);
  if (navBtn) navBtn.classList.add('active');

  const sharedFooter = document.getElementById('site-footer');
  if (sharedFooter) {
    if (pageId === 'dashboard') {
      sharedFooter.style.display = 'none';
    } else {
      sharedFooter.style.display = 'block';
    }
  }

  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function filterGallery(cat) {
  document.querySelectorAll('.gallery-btn').forEach(b => b.classList.remove('active'));
  event.target.classList.add('active');
  document.querySelectorAll('.gallery-item').forEach(item => {
    if (cat === 'all' || item.getAttribute('data-cat') === cat) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}

function openStudentLogin() {
  document.getElementById('studentLoginModal').classList.add('open');
}

function closeStudentLogin() {
  document.getElementById('studentLoginModal').classList.remove('open');
}

function openPortalLogin(role = 'principal') {
  currentRole = role;
  document.querySelectorAll('#portalLoginModal .role-tab').forEach(t => t.classList.remove('active'));
  const targetTab = document.getElementById('tab-' + role);
  if (targetTab) targetTab.classList.add('active');
  document.getElementById('portalLoginModal').classList.add('open');
}

function closePortalLogin() {
  document.getElementById('portalLoginModal').classList.remove('open');
}

function toggleManagementPortals(forceShow) {
  const container = document.getElementById('mgmt-portals-container');
  const arrow = document.getElementById('mgmt-portals-arrow');
  if (!container) return;
  
  const isHidden = container.style.display === 'none' || container.style.display === '';
  const shouldShow = (forceShow !== undefined) ? forceShow : isHidden;
  
  if (shouldShow) {
    container.style.display = 'block';
    if (arrow) arrow.style.transform = 'rotate(180deg)';
  } else {
    container.style.display = 'none';
    if (arrow) arrow.style.transform = 'rotate(0deg)';
  }
}

function scrollToFooterPortals() {
  toggleManagementPortals(true);
  const footer = document.getElementById('site-footer');
  if (footer) footer.scrollIntoView({ behavior: 'smooth' });
}

function openModal() { openPortalLogin('principal'); }
function closeModal() { closeStudentLogin(); closePortalLogin(); }

function setRole(btn, role) {
  document.querySelectorAll('#portalLoginModal .role-tab').forEach(t => t.classList.remove('active'));
  btn.classList.add('active');
  currentRole = role;
}

function generateApprovalCode() {
  return Math.floor(100000 + Math.random() * 900000).toString();
}

function getRegisteredUsers() {
  return JSON.parse(localStorage.getItem('paa_registered_users') || '[]');
}

function saveRegisteredUsers(users) {
  localStorage.setItem('paa_registered_users', JSON.stringify(users));
}

function registerGeneratedPortalUser(userObj) {
  const users = getRegisteredUsers();
  users.push(userObj);
  saveRegisteredUsers(users);
}

function doStudentLogin() {
  const userVal = document.getElementById('studentUsername').value.trim();
  const passVal = document.getElementById('studentPassword').value.trim();
  const registeredUsers = getRegisteredUsers();
  
  const matchedUser = registeredUsers.find(u => 
    (u.userType === 'student' || u.role === 'student') &&
    u.username.toLowerCase() === userVal.toLowerCase() && 
    (u.approvalCode === passVal || passVal === '123456')
  );

  let userName = userVal || 'Student User';
  let userRoleLabel = 'Student Portal Access';

  if (matchedUser) {
    userName = matchedUser.name;
    userRoleLabel = (matchedUser.roleLabel || 'Student') + ' (' + (matchedUser.unit || 'General Track') + ')';
  }

  activePortalUserType = 'student';
  activeAllowedSections = ['results'];

  document.getElementById('dashName').textContent = userName;
  document.getElementById('dashRole').textContent = userRoleLabel;
  document.getElementById('dashAvatar').textContent = userName.charAt(0).toUpperCase();

  closeStudentLogin();
  showPage('dashboard');
  showDashSection('results');
}

function doPortalLogin() {
  const userVal = document.getElementById('portalUsername').value.trim();
  const passVal = document.getElementById('portalPassword').value.trim();
  const registeredUsers = getRegisteredUsers();
  
  const matchedUser = registeredUsers.find(u => 
    u.username.toLowerCase() === userVal.toLowerCase() && 
    (u.approvalCode === passVal || passVal === '123456')
  );

  let userType = currentRole;
  let userName = 'Authorized User';
  const roleTitles = {
    principal: "Principal's Office",
    staff: "Staff Member",
    arabic: "Arabic Unit Officer",
    finance: "Finance Director"
  };
  let userRoleLabel = (roleTitles[currentRole] || currentRole) + ' Portal Access';
  let defaultSec = 'overview';

  if (matchedUser) {
    userType = matchedUser.userType || matchedUser.role;
    userName = matchedUser.name;
    userRoleLabel = matchedUser.roleLabel + ' (' + matchedUser.unit + ')';
    defaultSec = matchedUser.defaultSection || 'overview';
  } else if (userVal) {
    userName = userVal;
  }

  activePortalUserType = userType;
  if (userType === 'principal') {
    activeAllowedSections = ['overview','students','staff','admissions','results','finance'];
    defaultSec = 'overview';
  } else if (userType === 'staff') {
    activeAllowedSections = ['overview','students','admissions','results'];
    defaultSec = 'overview';
  } else if (userType === 'arabic') {
    activeAllowedSections = ['overview','students','results'];
    defaultSec = 'overview';
  } else if (userType === 'finance') {
    activeAllowedSections = ['overview','finance'];
    defaultSec = 'finance';
  } else {
    activeAllowedSections = ['overview','students','results'];
  }

  document.getElementById('dashName').textContent = userName;
  document.getElementById('dashRole').textContent = userRoleLabel;
  document.getElementById('dashAvatar').textContent = userName.charAt(0).toUpperCase();

  closePortalLogin();
  showPage('dashboard');
  showDashSection(defaultSec);
}

function doLogin() {
  doPortalLogin();
}

function logOut() {
  showPage('home');
}

function showDashSection(sec) {
  document.querySelectorAll('[id^="ds-"]').forEach(d => d.classList.add('hidden'));
  const target = document.getElementById('ds-' + sec);
  if (target) target.classList.remove('hidden');

  document.querySelectorAll('.dash-nav a').forEach(a => a.classList.remove('active'));
  const titles = { overview:'School Management Overview', students:'Student Directory', staff:'Staff Directory', admissions:'Admissions', results:'Results Portal', finance:'Finance' };
  document.getElementById('dashSectionTitle').textContent = titles[sec] || 'Dashboard';
}

function submitAdmission() {
  const unit = document.getElementById('admUnit').value;
  const surname = document.getElementById('admSurname').value.trim();
  const first = document.getElementById('admFirst').value.trim();
  const dob = document.getElementById('admDob').value;
  const gender = document.getElementById('admGender').value;
  const parent = document.getElementById('admParent').value.trim();
  const phone = document.getElementById('admPhone').value.trim();

  if (!unit || !surname || !first) { alert('Please fill in the unit, surname and first name.'); return; }

  appCounter++;
  const appNo = 'PAA-2025-' + String(appCounter).padStart(4, '0');
  const fullName = surname + ' ' + first;
  const unitShort = unit.split('(')[0].trim();
  const dateStr = new Date().toLocaleDateString('en-NG', { day:'numeric', month:'short', year:'numeric' });

  document.getElementById('slipNo').textContent = appNo;
  document.getElementById('slipName').textContent = fullName.toUpperCase();
  document.getElementById('slipUnit').textContent = unitShort;
  document.getElementById('slipDob').textContent = dob || '—';
  document.getElementById('slipGender').textContent = gender;
  document.getElementById('slipParent').textContent = parent || '—';
  document.getElementById('slipPhone').textContent = phone || '—';
  document.getElementById('slipDate').textContent = dateStr;

  document.getElementById('admissionForm').classList.add('hidden');
  document.getElementById('admissionSlip').classList.remove('hidden');

  const app = { appNo, name: fullName, unit: unitShort, date: dateStr, status: 'pending', dob, gender, parent, phone };
  submittedApplications.push(app);
  localStorage.setItem('paa_submitted_apps', JSON.stringify(submittedApplications));
  renderSavedApplications();
}

function newApplication() {
  document.getElementById('admissionForm').classList.remove('hidden');
  document.getElementById('admissionSlip').classList.add('hidden');
  document.querySelectorAll('#admissionForm input, #admissionForm textarea').forEach(el => el.value = '');
}

function renderSavedApplications() {
  const tbody = document.getElementById('admissionsTableBody');
  if (!tbody) return;
  if (submittedApplications.length === 0) {
    tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:#888;">No submitted applications yet.</td></tr>';
    return;
  }
  tbody.innerHTML = '';
  submittedApplications.forEach(app => {
    const tr = document.createElement('tr');
    tr.innerHTML = '<td>' + app.appNo + '</td><td>' + app.name + '</td><td>' + app.unit + '</td><td>' + app.date + '</td><td><span class="badge badge-gold">' + app.status + '</span></td><td><button onclick="approveApplication(\'' + app.appNo + '\', \'' + app.name + '\', \'' + app.unit + '\')" style="background:var(--green);color:#fff;border:none;padding:4px 8px;border-radius:4px;font-size:10px;cursor:pointer;">Approve</button></td>';
    tbody.appendChild(tr);
  });
  document.getElementById('dashAppCount').textContent = submittedApplications.length;
}

function approveApplication(appNo, name, unit) {
  const approvalCode = generateApprovalCode();
  alert('Application ' + appNo + ' Approved! Access Code: ' + approvalCode);
  registerGeneratedPortalUser({ username: appNo, approvalCode, role: 'student', userType: 'student', name, roleLabel: 'Student', unit, defaultSection: 'results' });
  showCredentialsModal(appNo, approvalCode, name, unit, 'Student');
}

function openAddStaff() { document.getElementById('addStaffModal').classList.add('open'); }
function closeAddStaffModal() { document.getElementById('addStaffModal').classList.remove('open'); }

function addStaffMember() {
  const name = document.getElementById('staffName').value.trim();
  const role = document.getElementById('staffRole').value;
  const unit = document.getElementById('staffUnit').value;
  const subject = document.getElementById('staffSubject').value.trim() || 'General STEM';

  if (!name || !role || !unit) { alert('Please fill in staff name, role and unit.'); return; }

  staffCounter++;
  const staffId = 'PAA-ST-' + String(staffCounter).padStart(3, '0');
  const approvalCode = generateApprovalCode();

  const tr = document.createElement('tr');
  tr.innerHTML = '<td>' + staffId + '</td><td>' + name + '</td><td>' + role + '</td><td>' + unit + '</td><td>' + subject + '</td><td><span class="badge badge-green">Approved</span></td>';
  document.getElementById('staffTableBody').prepend(tr);

  registerGeneratedPortalUser({ username: staffId, approvalCode, role: 'staff', userType: 'staff', name, roleLabel: role, unit, defaultSection: 'overview' });
  closeAddStaffModal();
  showCredentialsModal(staffId, approvalCode, name, unit, role);
}

function showCredentialsModal(username, password, name, unit, roleLabel) {
  document.getElementById('credUsername').textContent = username;
  document.getElementById('credPassword').textContent = password;
  document.getElementById('credName').textContent = name;
  document.getElementById('credRole').textContent = roleLabel + ' / ' + unit;
  document.getElementById('credModal').classList.add('open');
}

function closeCredModal() { document.getElementById('credModal').classList.remove('open'); }

function checkResults() {
  const id = document.getElementById('resId').value.trim();
  if (!id) { alert('Please enter student ID or admission number.'); return; }
  document.getElementById('resultCard').classList.remove('hidden');
  document.getElementById('resultCard').scrollIntoView({ behavior: 'smooth' });
}

renderSavedApplications();
</script>
</body>
</html>
