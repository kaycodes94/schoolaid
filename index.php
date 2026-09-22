<?php
/**
 * Plan Aid Academy & Educational Resource, Jos - School Management System
 * Main Application Entry Point
 * @version 1.0.0
 */

session_start();
header('Content-Type: text/html; charset=UTF-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');

define('API_BASE_URL', 'http://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . '/aidstudent/api');
define('APP_NAME', 'Plan Aid Academy & Educational Resource, Jos');
define('APP_VERSION', '1.0.0');

$backendReady = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Plan Aid Academy & Educational Resource, Jos | Science & ICT Education</title>
<meta name="description" content="Plan Aid Academy & Educational Resource, Jos — a Science and ICT-based centre of excellence focused on academic excellence, innovation, creativity, technology and practical learning."/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Inter:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet"/>
<style>
  :root {
    --navy: #0b2545;
    --navy-light: #1e3a8a;
    --navy-dark: #07162c;
    --gold: #f59e0b;
    --gold-light: #fbbf24;
    --gold-dark: #d97706;
    --red: #ef4444;
    --red-dark: #dc2626;
    --cyan: #0ea5e9;
    --cyan-light: #e0f2fe;
    --white: #ffffff;
    --bg-base: #f8fafc;
    --bg-card: #ffffff;
    --dark: #0f172a;
    --text-muted: #64748b;
    --border: #e2e8f0;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
    --shadow-md: 0 4px 12px rgba(11,37,69,0.08);
    --shadow-lg: 0 10px 30px rgba(11,37,69,0.12);
    --radius-sm: 6px;
    --radius-md: 10px;
    --radius-lg: 16px;
    --radius-full: 9999px;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Inter', -apple-system, sans-serif; background: var(--bg-base); color: var(--dark); line-height: 1.6; min-height: 100vh; }
  .hidden { display: none !important; }
  .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

  /* Smooth animations & page switching */
  .page { display: none; min-height: 80vh; animation: fadeIn 0.3s ease; }
  .page.active { display: block; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

  /* Navigation Bar */
  nav {
    background: var(--navy);
    color: var(--white);
    position: sticky; top: 0; z-index: 1000;
    box-shadow: 0 4px 20px rgba(0,0,0,0.25);
    border-bottom: 3px solid var(--gold);
  }
  .nav-container {
    display: flex; align-items: center; justify-content: space-between;
    height: 72px; padding: 0 20px; max-width: 1280px; margin: 0 auto;
  }
  .nav-brand {
    display: flex; align-items: center; gap: 12px; cursor: pointer; text-decoration: none; color: var(--white);
  }
  .nav-logo-icon {
    width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
    display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 900; color: var(--navy-dark);
    box-shadow: 0 2px 8px rgba(0,0,0,0.2); flex-shrink: 0;
  }
  .nav-title-box { display: flex; flex-direction: column; }
  .nav-title-main { font-family: 'Playfair Display', serif; font-size: 16px; font-weight: 800; line-height: 1.15; letter-spacing: 0.3px; color: var(--white); }
  .nav-title-sub { font-size: 10px; font-weight: 600; color: var(--gold-light); letter-spacing: 0.5px; text-transform: uppercase; }

  .nav-menu { display: flex; align-items: center; gap: 4px; }
  .nav-menu button {
    background: transparent; border: none; color: rgba(255,255,255,0.9);
    padding: 8px 12px; border-radius: var(--radius-sm); font-size: 13px; font-weight: 500;
    cursor: pointer; transition: all 0.2s; font-family: inherit; white-space: nowrap;
  }
  .nav-menu button:hover, .nav-menu button.active { background: rgba(255,255,255,0.15); color: var(--gold-light); }
  
  .btn-portal-login {
    background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold-dark) 100%);
    color: var(--navy-dark); border: none; padding: 9px 18px; border-radius: var(--radius-sm);
    font-weight: 700; font-size: 13px; cursor: pointer; transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(245,158,11,0.3); font-family: inherit; white-space: nowrap;
  }
  .btn-portal-login:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(245,158,11,0.4); }

  .mobile-toggle { display: none; background: none; border: none; color: var(--white); font-size: 24px; cursor: pointer; }
  .mobile-menu {
    display: none; background: var(--navy-dark); padding: 16px; border-bottom: 2px solid var(--gold);
    flex-direction: column; gap: 8px;
  }
  .mobile-menu.open { display: flex; }
  .mobile-menu button {
    background: none; border: none; color: var(--white); padding: 10px 14px; text-align: left;
    font-size: 14px; font-weight: 500; border-radius: var(--radius-sm); cursor: pointer;
  }
  .mobile-menu button.active { background: rgba(255,255,255,0.12); color: var(--gold-light); font-weight: 700; }

  /* Hero Section */
  .hero-section {
    background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 60%, #1e3a8a 100%);
    color: var(--white); padding: 70px 20px 60px; text-align: center; position: relative; overflow: hidden;
  }
  .hero-section::before {
    content: ''; position: absolute; inset: 0; opacity: 0.05; pointer-events: none;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
  }
  .hero-badge-location {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.4);
    color: var(--gold-light); padding: 6px 18px; border-radius: var(--radius-full);
    font-size: 12px; font-weight: 600; letter-spacing: 0.5px; margin-bottom: 20px; text-transform: uppercase;
  }
  .hero-title-main {
    font-family: 'Playfair Display', serif; font-size: clamp(30px, 5vw, 54px);
    font-weight: 900; line-height: 1.15; margin-bottom: 12px; letter-spacing: -0.5px;
  }
  .hero-title-main span { color: var(--gold-light); }
  .hero-motto-banner {
    display: inline-block; background: rgba(255,255,255,0.1); border-left: 4px solid var(--gold);
    padding: 8px 20px; border-radius: var(--radius-sm); font-size: 16px; font-weight: 700;
    color: var(--gold-light); margin-bottom: 16px; font-style: italic;
  }
  .hero-tagline-badge {
    display: inline-block; background: var(--red); color: var(--white);
    padding: 6px 18px; border-radius: var(--radius-full); font-size: 12px; font-weight: 800;
    letter-spacing: 1px; text-transform: uppercase; margin-bottom: 24px; box-shadow: 0 4px 12px rgba(239,68,68,0.3);
  }
  .hero-intro {
    font-size: 16px; opacity: 0.9; max-width: 800px; margin: 0 auto 36px; line-height: 1.7; font-weight: 400;
  }
  .hero-actions { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
  .btn-hero-primary {
    background: linear-gradient(135deg, var(--gold-light), var(--gold-dark)); color: var(--navy-dark);
    border: none; padding: 14px 28px; border-radius: var(--radius-md); font-weight: 800; font-size: 14px;
    cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 14px rgba(245,158,11,0.35); text-transform: uppercase;
  }
  .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(245,158,11,0.5); }
  
  .btn-hero-cyan {
    background: linear-gradient(135deg, var(--cyan), #0284c7); color: var(--white);
    border: none; padding: 14px 28px; border-radius: var(--radius-md); font-weight: 800; font-size: 14px;
    cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 14px rgba(14,165,233,0.35); text-transform: uppercase;
  }
  .btn-hero-cyan:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(14,165,233,0.5); }

  .btn-hero-outline {
    background: transparent; color: var(--white); border: 2px solid rgba(255,255,255,0.4);
    padding: 13px 26px; border-radius: var(--radius-md); font-weight: 700; font-size: 14px;
    cursor: pointer; transition: all 0.2s; text-transform: uppercase;
  }
  .btn-hero-outline:hover { border-color: var(--white); background: rgba(255,255,255,0.1); }

  /* Features Strip */
  .features-strip { background: var(--white); border-bottom: 1px solid var(--border); box-shadow: var(--shadow-sm); }
  .features-strip-inner { display: flex; overflow-x: auto; scrollbar-width: none; }
  .feature-strip-card {
    flex: 1; min-width: 180px; padding: 20px 16px; text-align: center;
    border-right: 1px solid var(--border); cursor: pointer; transition: background 0.2s;
  }
  .feature-strip-card:last-child { border-right: none; }
  .feature-strip-card:hover { background: var(--cyan-light); }
  .feature-strip-icon { font-size: 28px; margin-bottom: 6px; }
  .feature-strip-title { font-size: 13px; font-weight: 700; color: var(--navy); }
  .feature-strip-desc { font-size: 11px; color: var(--text-muted); margin-top: 2px; }

  /* Sections & Cards */
  .section-padding { padding: 64px 0; }
  .section-alt { background: var(--white); }
  .section-header { text-align: center; margin-bottom: 48px; }
  .section-badge {
    display: inline-block; font-size: 11px; font-weight: 800; letter-spacing: 1.5px;
    text-transform: uppercase; color: var(--navy-light); background: var(--cyan-light);
    padding: 4px 14px; border-radius: var(--radius-full); margin-bottom: 10px;
  }
  .section-title { font-family: 'Playfair Display', serif; font-size: clamp(26px, 3.5vw, 38px); font-weight: 800; color: var(--navy); margin-bottom: 12px; }
  .section-subtitle { font-size: 15px; color: var(--text-muted); max-width: 720px; margin: 0 auto; line-height: 1.6; }

  /* Grid Layouts */
  .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; }
  .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
  .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
  @media (max-width: 992px) { .grid-4 { grid-template-columns: repeat(2, 1fr); } .grid-3 { grid-template-columns: repeat(2, 1fr); } }
  @media (max-width: 640px) { .grid-4, .grid-3, .grid-2 { grid-template-columns: 1fr; } }

  /* Cards */
  .card-box {
    background: var(--white); border-radius: var(--radius-lg); padding: 30px 24px;
    border: 1px solid var(--border); box-shadow: var(--shadow-md); transition: all 0.25s; position: relative;
  }
  .card-box:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); border-color: var(--cyan); }
  .card-icon-wrap {
    width: 54px; height: 54px; border-radius: var(--radius-md); background: linear-gradient(135deg, var(--navy-light), var(--navy));
    color: var(--gold-light); display: flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 20px;
    box-shadow: 0 4px 10px rgba(30,58,138,0.2);
  }
  .card-title { font-size: 18px; font-weight: 700; color: var(--navy); margin-bottom: 10px; }
  .card-desc { font-size: 14px; color: var(--text-muted); line-height: 1.6; }

  /* Vision & Mission Cards */
  .vm-card {
    background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 100%);
    color: var(--white); border-radius: var(--radius-lg); padding: 36px 30px; border-top: 4px solid var(--gold);
    box-shadow: var(--shadow-lg);
  }
  .vm-card h3 { font-family: 'Playfair Display', serif; font-size: 24px; color: var(--gold-light); margin-bottom: 14px; display: flex; align-items: center; gap: 10px; }
  .vm-card p { font-size: 15px; line-height: 1.7; opacity: 0.95; }
  .vm-list { list-style: none; margin-top: 14px; display: flex; flex-direction: column; gap: 10px; }
  .vm-list li { display: flex; align-items: flex-start; gap: 10px; font-size: 14px; opacity: 0.95; }
  .vm-list li::before { content: '✓'; color: var(--gold-light); font-weight: 900; }

  /* Gallery Grid & Modal */
  .gallery-nav { display: flex; justify-content: center; gap: 8px; flex-wrap: wrap; margin-bottom: 30px; }
  .gallery-filter-btn {
    background: var(--white); border: 1px solid var(--border); padding: 8px 16px; border-radius: var(--radius-full);
    font-size: 13px; font-weight: 600; color: var(--dark); cursor: pointer; transition: all 0.2s;
  }
  .gallery-filter-btn.active, .gallery-filter-btn:hover { background: var(--navy); color: var(--white); border-color: var(--navy); }

  .gallery-card {
    background: var(--white); border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--border);
    box-shadow: var(--shadow-sm); transition: all 0.25s;
  }
  .gallery-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
  .gallery-img-placeholder {
    height: 180px; background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    display: flex; flex-direction: column; align-items: center; justify-content: center; color: var(--white);
    padding: 20px; text-align: center; position: relative;
  }
  .gallery-tag { position: absolute; top: 12px; right: 12px; background: var(--gold); color: var(--navy-dark); font-size: 10px; font-weight: 800; padding: 3px 10px; border-radius: var(--radius-full); text-transform: uppercase; }
  .gallery-body { padding: 16px; }
  .gallery-title { font-size: 15px; font-weight: 700; color: var(--navy); margin-bottom: 4px; }
  .gallery-sub { font-size: 12px; color: var(--text-muted); }

  /* Contact Cards & Form */
  .contact-info-card {
    background: var(--white); border-radius: var(--radius-lg); padding: 30px; border: 1px solid var(--border); box-shadow: var(--shadow-md);
  }
  .contact-item { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 24px; }
  .contact-icon { width: 44px; height: 44px; border-radius: 50%; background: var(--cyan-light); color: var(--navy); display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
  .contact-text h4 { font-size: 15px; font-weight: 700; color: var(--navy); margin-bottom: 4px; }
  .contact-text p, .contact-text a { font-size: 14px; color: var(--text-muted); text-decoration: none; }
  .contact-text a:hover { color: var(--navy-light); text-decoration: underline; }

  /* Footer */
  footer {
    background: var(--navy-dark); color: var(--white); padding: 60px 20px 30px; border-top: 4px solid var(--gold);
  }
  .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 40px; max-width: 1200px; margin: 0 auto 40px; }
  @media (max-width: 992px) { .footer-grid { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 640px) { .footer-grid { grid-template-columns: 1fr; } }
  .footer-brand h3 { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 800; color: var(--gold-light); margin-bottom: 8px; }
  .footer-brand p { font-size: 13px; opacity: 0.8; line-height: 1.6; margin-bottom: 16px; }
  .footer-motto { font-size: 13px; font-weight: 700; color: var(--gold-light); font-style: italic; }
  .footer-title { font-size: 15px; font-weight: 700; color: var(--white); margin-bottom: 16px; position: relative; padding-bottom: 8px; }
  .footer-title::after { content: ''; position: absolute; bottom: 0; left: 0; width: 30px; height: 2px; background: var(--gold); }
  .footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }
  .footer-links a { color: rgba(255,255,255,0.75); text-decoration: none; font-size: 13px; transition: all 0.2s; cursor: pointer; }
  .footer-links a:hover { color: var(--gold-light); padding-left: 4px; }
  .footer-bottom { text-align: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 24px; font-size: 12px; opacity: 0.7; }

  /* Restored Modals, Form & Dashboard Styles */
  .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); z-index: 2000; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
  .modal-overlay.open { display: flex; }
  .modal { background: var(--white); border-radius: var(--radius-lg); padding: 36px; width: 90%; max-width: 440px; position: relative; box-shadow: var(--shadow-lg); }
  .modal-wide { max-width: 640px; }
  .modal-close { position: absolute; top: 16px; right: 16px; background: none; border: none; font-size: 22px; cursor: pointer; color: var(--text-muted); }
  .modal h2 { font-family: 'Playfair Display', serif; font-size: 24px; color: var(--navy); margin-bottom: 6px; }
  .modal .sub { font-size: 13px; color: var(--text-muted); margin-bottom: 20px; }
  .role-tabs { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 20px; }
  .role-tab { padding: 8px 14px; border: 1px solid var(--border); border-radius: var(--radius-sm); font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; background: var(--bg-base); }
  .role-tab.active { background: var(--navy); color: var(--white); border-color: var(--navy); }
  
  .form-group { margin-bottom: 16px; }
  .form-group label { display: block; font-size: 13px; font-weight: 600; color: var(--dark); margin-bottom: 6px; }
  .form-group input, .form-group select, .form-group textarea {
    width: 100%; padding: 11px 14px; border: 1px solid var(--border); border-radius: var(--radius-sm);
    font-family: inherit; font-size: 14px; color: var(--dark); background: var(--bg-base); transition: border-color 0.2s;
  }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: var(--navy-light); }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  @media (max-width: 640px) { .form-row { grid-template-columns: 1fr; } }
  
  .btn-submit {
    width: 100%; padding: 13px; background: var(--navy); color: var(--white); border: none;
    border-radius: var(--radius-sm); font-size: 14px; font-weight: 700; cursor: pointer; transition: background 0.2s; margin-top: 8px;
  }
  .btn-submit:hover { background: var(--navy-light); }

  .slip { background: var(--white); border: 2px solid var(--navy); border-radius: var(--radius-md); padding: 30px; max-width: 680px; margin: 0 auto; box-shadow: var(--shadow-md); }
  .slip-header { display: flex; align-items: center; gap: 16px; border-bottom: 2px solid var(--navy); padding-bottom: 16px; margin-bottom: 20px; }
  .slip-logo { width: 56px; height: 56px; border-radius: 50%; background: var(--navy); color: var(--gold); display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 22px; flex-shrink: 0; }
  .slip-school { flex: 1; }
  .slip-school h2 { font-family: 'Playfair Display', serif; font-size: 18px; color: var(--navy); }
  .slip-no { background: var(--navy); color: var(--white); padding: 6px 14px; border-radius: var(--radius-sm); font-size: 12px; font-weight: 700; }
  .slip-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px; }
  .slip-field { border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 8px 12px; }
  .slip-field .lbl { font-size: 10px; font-weight: 700; text-transform: uppercase; color: var(--text-muted); }
  .slip-field .val { font-size: 13px; font-weight: 600; color: var(--dark); }
  .btn-print { background: var(--navy); color: var(--white); border: none; padding: 9px 20px; border-radius: var(--radius-sm); font-weight: 700; cursor: pointer; }

  /* Dashboard Framework Styles */
  .dash-layout { display: grid; grid-template-columns: 240px 1fr; min-height: calc(100vh - 72px); }
  .dash-sidebar { background: var(--navy-dark); color: var(--white); padding: 24px 0; }
  .dash-sidebar .user-info { padding: 0 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 12px; }
  .dash-sidebar .user-info .avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--gold); color: var(--navy-dark); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px; margin-bottom: 10px; }
  .dash-nav a { display: flex; align-items: center; gap: 12px; padding: 11px 20px; font-size: 13px; color: rgba(255,255,255,0.7); cursor: pointer; transition: all 0.2s; border-left: 3px solid transparent; }
  .dash-nav a:hover, .dash-nav a.active { color: var(--white); background: rgba(255,255,255,0.08); border-left-color: var(--gold); }
  .dash-content { padding: 32px; background: var(--bg-base); overflow-y: auto; }
  .dash-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-bottom: 28px; }
  .dash-card { background: var(--white); border-radius: var(--radius-md); padding: 20px; box-shadow: var(--shadow-sm); border-bottom: 3px solid var(--navy); }
  .dash-card .dc-val { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 900; color: var(--navy); }
  .dash-card .dc-lbl { font-size: 12px; color: var(--text-muted); margin-top: 4px; }
  .table-wrap { background: var(--white); border-radius: var(--radius-md); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 24px; border: 1px solid var(--border); }
  .table-head { padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border); }
  table { width: 100%; border-collapse: collapse; }
  thead { background: var(--bg-base); }
  th { padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 700; color: var(--navy); text-transform: uppercase; letter-spacing: 0.5px; }
  td { padding: 12px 16px; font-size: 13px; border-bottom: 1px solid var(--border); color: var(--dark); }
  .badge { display: inline-block; padding: 3px 10px; border-radius: var(--radius-full); font-size: 11px; font-weight: 700; text-transform: uppercase; }
  .badge-green { background: #dbeafe; color: #1e3a8a; }
  .badge-gold { background: #fef3cd; color: #856404; }
  .badge-red { background: #fde8e8; color: #b03232; }
  @media (max-width: 992px) { .dash-layout { grid-template-columns: 1fr; } .dash-sidebar { display: none; } }
</style>
<script>
  const API_CONFIG = {
    baseUrl: '<?php echo API_BASE_URL; ?>',
    appName: '<?php echo APP_NAME; ?>'
  };
</script>
</head>
<body>

<!-- NAVIGATION BAR -->
<nav>
  <div class="nav-container">
    <a class="nav-brand" onclick="showPage('home')">
      <div class="nav-logo-icon">🎓</div>
      <div class="nav-title-box">
        <span class="nav-title-main">PLAN AID ACADEMY</span>
        <span class="nav-title-sub">&amp; Educational Resource, Jos</span>
      </div>
    </a>
    <div class="nav-menu">
      <button onclick="showPage('home')" id="nav-home" class="active">Home</button>
      <button onclick="showPage('about')" id="nav-about">About Us</button>
      <button onclick="showPage('academics')" id="nav-academics">Academics</button>
      <button onclick="showPage('focus')" id="nav-focus">Focus Areas</button>
      <button onclick="showPage('why-choose')" id="nav-why-choose">Why Choose Us</button>
      <button onclick="showPage('science-ict')" id="nav-science-ict">Science &amp; ICT</button>
      <button onclick="showPage('gallery')" id="nav-gallery">Gallery</button>
      <button onclick="showPage('admission')" id="nav-admission">Admissions</button>
      <button onclick="showPage('results')" id="nav-results">Results</button>
      <button onclick="showPage('arabic')" id="nav-arabic">Arabic Unit</button>
      <button onclick="showPage('contact')" id="nav-contact">Contact</button>
      <button class="btn-portal-login" onclick="openModal()">Portal Login</button>
    </div>
    <button class="mobile-toggle" onclick="toggleMobileMenu()">☰</button>
  </div>
  <div class="mobile-menu" id="mobileMenu">
    <button onclick="showPage('home'); toggleMobileMenu();">Home</button>
    <button onclick="showPage('about'); toggleMobileMenu();">About Us</button>
    <button onclick="showPage('academics'); toggleMobileMenu();">Academics</button>
    <button onclick="showPage('focus'); toggleMobileMenu();">Focus Areas</button>
    <button onclick="showPage('why-choose'); toggleMobileMenu();">Why Choose Us</button>
    <button onclick="showPage('science-ict'); toggleMobileMenu();">Science &amp; ICT</button>
    <button onclick="showPage('gallery'); toggleMobileMenu();">Gallery</button>
    <button onclick="showPage('admission'); toggleMobileMenu();">Admissions</button>
    <button onclick="showPage('results'); toggleMobileMenu();">Results</button>
    <button onclick="showPage('arabic'); toggleMobileMenu();">Arabic Unit</button>
    <button onclick="showPage('contact'); toggleMobileMenu();">Contact Us</button>
    <button onclick="openModal(); toggleMobileMenu();" style="background:var(--gold); color:var(--navy-dark); font-weight:700;">Portal Login</button>
  </div>
</nav>

<!-- PORTAL LOGIN MODAL -->
<div class="modal-overlay" id="loginModal">
  <div class="modal">
    <button class="modal-close" onclick="closeModal()">✕</button>
    <h2>Portal Login</h2>
    <p class="sub" id="loginHelp">Sign in to your Plan Aid Academy portal account.</p>
    <div class="role-tabs">
      <button class="role-tab active" onclick="setRole(this,'principal')">Principal</button>
      <button class="role-tab" onclick="setRole(this,'unithead')">Head Teacher</button>
      <button class="role-tab" onclick="setRole(this,'staff')">Staff</button>
      <button class="role-tab" onclick="setRole(this,'student')">Student</button>
    </div>
    <div class="form-group"><label id="loginUsernameLabel">Staff ID / Email</label><input id="loginUsername" type="text" placeholder="e.g. PAA-PRINCIPAL" autocomplete="off"/></div>
    <div class="form-group"><label id="loginSecretLabel">Password</label><input id="loginPassword" type="password" placeholder="Enter password" autocomplete="new-password"/></div>
    <button class="btn-submit" onclick="doLogin()">Sign In to Portal</button>
    <div style="text-align:center;margin-top:12px">
      <button id="showLoginDetailsBtn" type="button" onclick="showRoleLoginDetails()" style="background:none;border:none;color:var(--navy-light);font-size:12px;cursor:pointer;text-decoration:underline">Show Principal / Head Teacher Demo Credentials</button>
    </div>
  </div>
</div>

<!-- CREDENTIALS MODAL -->
<div class="modal-overlay" id="credModal">
  <div class="modal">
    <button class="modal-close" onclick="closeCredModal()">✕</button>
    <h2>Generated Login Credentials</h2>
    <p class="sub">Share these portal credentials securely.</p>
    <div class="form-group"><label>Name</label><div id="credName" style="font-weight:700;margin-top:4px"></div></div>
    <div class="form-group"><label>Role / Unit</label><div id="credRole" style="margin-top:4px"></div></div>
    <div class="form-group" style="display:flex;align-items:center;gap:10px"><label style="min-width:110px">Username</label><div id="credUsername" style="font-family:monospace;font-weight:700"></div><button onclick="copyCred('credUsername')" class="btn-hero-cyan" style="padding:4px 10px;font-size:11px">Copy</button></div>
    <div class="form-group" style="display:flex;align-items:center;gap:10px"><label id="credSecretLabel" style="min-width:110px">Approval Code</label><div id="credPassword" style="font-family:monospace;font-weight:700"></div><button onclick="copyCred('credPassword')" class="btn-hero-cyan" style="padding:4px 10px;font-size:11px">Copy</button></div>
    <div style="text-align:right;margin-top:16px"><button class="btn-submit" onclick="closeCredModal()">Done</button></div>
  </div>
</div>

<!-- ADD STAFF MODAL -->
<div class="modal-overlay" id="addStaffModal">
  <div class="modal modal-wide">
    <button class="modal-close" onclick="closeAddStaffModal()">✕</button>
    <h2>Approve Staff Login</h2>
    <p class="sub">Approve a staff record and generate their portal sign-in code.</p>
    <div class="form-row">
      <div class="form-group"><label>Full Name</label><input id="staffName" type="text" placeholder="e.g. Mr. John Danjuma"/></div>
      <div class="form-group"><label>Role</label>
        <select id="staffRole">
          <option value="">— Select Role —</option>
          <option>Science Educator</option>
          <option>ICT / Robotics Instructor</option>
          <option>Head of Secondary</option>
          <option>Head of Primary</option>
          <option>Head of Nursery</option>
          <option>Head of Arabic</option>
          <option>Class Teacher</option>
          <option>Finance Officer</option>
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group"><label>Unit</label>
        <select id="staffUnit">
          <option value="">— Select Unit —</option>
          <option>Secondary</option>
          <option>Primary</option>
          <option>Nursery</option>
          <option>Arabic</option>
          <option>Administration</option>
        </select>
      </div>
      <div class="form-group"><label>Subject / Department</label><input id="staffSubject" type="text" placeholder="e.g. Computer Science / ICT"/></div>
    </div>
    <button class="btn-submit" onclick="addStaffMember()">Approve &amp; Generate Code</button>
  </div>
</div>

<!-- PAGE 1: HOME PAGE -->
<div class="page active" id="page-home">
  <!-- HERO SECTION -->
  <section class="hero-section">
    <div class="container">
      <div class="hero-badge-location">📍 A.U TETENGI HOUSE, NO 107/1 BAUCHI ROAD, JOS NORTH, PLATEAU STATE</div>
      <h1 class="hero-title-main">
        PLAN AID ACADEMY<br/>
        <span>&amp; EDUCATIONAL RESOURCE, JOS</span>
      </h1>
      <div class="hero-motto-banner">Motto: "Empowering Knowledge, Igniting Innovation"</div>
      <div>
        <span class="hero-tagline-badge">A SCIENCE AND ICT-BASED CENTRE OF EXCELLENCE</span>
      </div>
      <p class="hero-intro">
        At PLAN AID ACADEMY, we are dedicated to nurturing young minds through a balanced blend of scientific inquiry, technological innovation, and creative learning. Our mission is to empower students with practical skills and digital literacy that prepare them for the dynamic world of science and technology.
      </p>
      <div class="hero-actions">
        <button class="btn-hero-primary" onclick="showPage('admission')">Apply for Admission</button>
        <button class="btn-hero-cyan" onclick="showPage('results')">Check Results</button>
        <button class="btn-hero-outline" onclick="showPage('about')">About Us</button>
        <button class="btn-hero-outline" onclick="showPage('contact')">Contact Us</button>
      </div>
    </div>
  </section>

  <!-- FEATURES STRIP -->
  <div class="features-strip">
    <div class="features-strip-inner">
      <div class="feature-strip-card" onclick="showPage('science-ict')">
        <div class="feature-strip-icon">🔬</div>
        <div class="feature-strip-title">Science Education</div>
        <div class="feature-strip-desc">Hands-on experimentation</div>
      </div>
      <div class="feature-strip-card" onclick="showPage('science-ict')">
        <div class="feature-strip-icon">💻</div>
        <div class="feature-strip-title">ICT Integration</div>
        <div class="feature-strip-desc">Computer labs &amp; e-learning</div>
      </div>
      <div class="feature-strip-card" onclick="showPage('science-ict')">
        <div class="feature-strip-icon">🤖</div>
        <div class="feature-strip-title">Coding &amp; Robotics</div>
        <div class="feature-strip-desc">Digital skills development</div>
      </div>
      <div class="feature-strip-card" onclick="showPage('focus')">
        <div class="feature-strip-icon">💡</div>
        <div class="feature-strip-title">Innovation Fairs</div>
        <div class="feature-strip-desc">Projects &amp; tech competitions</div>
      </div>
      <div class="feature-strip-card" onclick="showPage('arabic')">
        <div class="feature-strip-icon">☪️</div>
        <div class="feature-strip-title">Arabic &amp; Islamic Unit</div>
        <div class="feature-strip-desc">Qur'anic studies &amp; bilingual cards</div>
      </div>
    </div>
  </div>

  <!-- ABOUT US SECTION -->
  <section class="section-padding section-alt" id="home-about">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Welcome to Plan Aid Academy</span>
        <h2 class="section-title">Nurturing Young Minds For A Digital World</h2>
        <p class="section-subtitle">
          "At PLAN AID ACADEMY, we are dedicated to nurturing young minds through a balanced blend of scientific inquiry, technological innovation, and creative learning. Our mission is to empower students with practical skills and digital literacy that prepare them for the dynamic world of science and technology."
        </p>
      </div>
      <div class="grid-3">
        <div class="card-box">
          <div class="card-icon-wrap">🔬</div>
          <h3 class="card-title">Science &amp; Tech Focus</h3>
          <p class="card-desc">Fostering analytical thinking, scientific inquiry, and hands-on laboratory experiences to inspire future scientists and engineers.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">💻</div>
          <h3 class="card-title">Digital Literacy &amp; ICT</h3>
          <p class="card-desc">Providing modern computer laboratories, coding tutorials, robotics modules, and 21st-century digital competencies.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🌱</div>
          <h3 class="card-title">Holistic Student Development</h3>
          <p class="card-desc">Combining rigorous STEM curriculum with strong moral values, leadership training, creative expression, and extracurricular activities.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- OUR FOCUS AREAS SECTION -->
  <section class="section-padding" id="home-focus">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Core Pillars</span>
        <h2 class="section-title">OUR FOCUS AREAS</h2>
        <p class="section-subtitle">Empowering learners with discovery, digital technology, innovation, and academic rigor.</p>
      </div>
      <div class="grid-4">
        <div class="card-box">
          <div class="card-icon-wrap">🔬</div>
          <h3 class="card-title">SCIENCE EDUCATION</h3>
          <p class="card-desc">Hands-on experiences, critical thinking, and problem-solving approaches that inspire discovery and innovation.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">💻</div>
          <h3 class="card-title">ICT INTEGRATION</h3>
          <p class="card-desc">State-of-the-art computer laboratories, coding lessons, robotics, and digital skills development for 21st-century learners.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">💡</div>
          <h3 class="card-title">INNOVATION &amp; CREATIVITY</h3>
          <p class="card-desc">Encouraging students to design, build, and explore through science fairs, tech projects, and digital creativity programs.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🎓</div>
          <h3 class="card-title">ACADEMIC EXCELLENCE</h3>
          <p class="card-desc">A robust curriculum that combines STEM subjects with strong moral and intellectual foundations.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- VISION & MISSION SECTION -->
  <section class="section-padding section-alt" id="home-vision-mission">
    <div class="container">
      <div class="grid-2">
        <div class="vm-card">
          <h3>👁️ OUR VISION</h3>
          <p>
            "To become a leading Science and ICT Institution producing learners who are Innovative, Analytical, And Globally Competitive."
          </p>
        </div>
        <div class="vm-card" style="border-top-color: var(--cyan);">
          <h3>🎯 OUR MISSION</h3>
          <p><strong>"To provide quality education through:"</strong></p>
          <ul class="vm-list">
            <li>Modern science and technology facilities</li>
            <li>Qualified and passionate educators</li>
            <li>Interactive, project-based learning</li>
            <li>Continuous digital skill development</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- WHY CHOOSE US SECTION -->
  <section class="section-padding" id="home-why-choose">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Excellence Guaranteed</span>
        <h2 class="section-title">WHY CHOOSE US</h2>
        <p class="section-subtitle">Discover why families in Jos and Plateau State choose Plan Aid Academy for their children's education.</p>
      </div>
      <div class="grid-3">
        <div class="card-box">
          <div class="card-icon-wrap">👨‍🏫</div>
          <h3 class="card-title">Qualified &amp; Experienced Teachers</h3>
          <p class="card-desc">Passionate educators trained in modern pedagogical approaches, scientific inquiry, and interactive student engagement.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🔬</div>
          <h3 class="card-title">Modern Science &amp; Computer Labs</h3>
          <p class="card-desc">Fully equipped science workstations and computer labs providing practical hands-on learning experiences.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🤖</div>
          <h3 class="card-title">Coding &amp; Robotics Programs</h3>
          <p class="card-desc">Structured digital skills development introducing students to logic, programming languages, and robotics automation.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">📲</div>
          <h3 class="card-title">E-Learning &amp; Digital Resources</h3>
          <p class="card-desc">Integrating digital learning tools, online student evaluation, and interactive educational content for continuous progress.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🏆</div>
          <h3 class="card-title">Science &amp; Technology Competitions</h3>
          <p class="card-desc">Encouraging student participation in inter-school science fairs, robotics challenges, and innovation competitions.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🏫</div>
          <h3 class="card-title">Conducive Learning Environment</h3>
          <p class="card-desc">Serene, secure, and supportive campus atmosphere fostering curiosity, discipline, and creative academic growth.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <h3>PLAN AID ACADEMY &amp; EDUCATIONAL RESOURCE, JOS</h3>
        <p class="footer-motto">"Empowering Knowledge, Igniting Innovation"</p>
        <p style="margin-top:10px; font-size:12px; opacity:0.8;">A Science and ICT-Based Centre of Excellence in Jos North, Plateau State.</p>
      </div>
      <div>
        <h4 class="footer-title">Quick Links</h4>
        <ul class="footer-links">
          <li><a onclick="showPage('home')">Home</a></li>
          <li><a onclick="showPage('about')">About Us</a></li>
          <li><a onclick="showPage('academics')">Academics</a></li>
          <li><a onclick="showPage('focus')">Focus Areas</a></li>
          <li><a onclick="showPage('why-choose')">Why Choose Us</a></li>
          <li><a onclick="showPage('science-ict')">Science &amp; ICT</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-title">Portals &amp; Media</h4>
        <ul class="footer-links">
          <li><a onclick="showPage('admission')">Online Admissions</a></li>
          <li><a onclick="showPage('results')">Check Results</a></li>
          <li><a onclick="showPage('arabic')">Arabic Unit</a></li>
          <li><a onclick="showPage('gallery')">School Gallery</a></li>
          <li><a onclick="showPage('contact')">Contact Us</a></li>
          <li><a onclick="openModal()">Portal Login</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-title">Official Contact</h4>
        <p style="font-size:12px; opacity:0.85; line-height:1.6; margin-bottom:10px;">
          <strong>Address:</strong><br/>
          A.U Tetengi House, No 107/1 Bauchi Road, Jos, Jos North, Plateau State
        </p>
        <p style="font-size:12px; opacity:0.85; line-height:1.6; margin-bottom:10px;">
          <strong>Phone:</strong><br/>
          <a href="tel:08030459595" style="color:var(--gold-light); text-decoration:none;">08030459595</a> | 
          <a href="tel:08088552501" style="color:var(--gold-light); text-decoration:none;">08088552501</a>
        </p>
        <p style="font-size:12px; opacity:0.85; line-height:1.6;">
          <strong>Email:</strong><br/>
          <a href="mailto:planaidjos@gmail.com" style="color:var(--gold-light); text-decoration:none;">planaidjos@gmail.com</a>
        </p>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; <?php echo date('Y'); ?> Plan Aid Academy &amp; Educational Resource, Jos. All rights reserved.
    </div>
  </footer>
</div>

<!-- PAGE 2: ABOUT US -->
<div class="page" id="page-about">
  <section class="hero-section" style="padding: 40px 20px;">
    <div class="container">
      <span class="hero-badge-location">Official School Information</span>
      <h1 class="hero-title-main">ABOUT <span>PLAN AID ACADEMY</span></h1>
      <p class="hero-intro" style="margin-bottom:0;">
        "At PLAN AID ACADEMY, we are dedicated to nurturing young minds through a balanced blend of scientific inquiry, technological innovation, and creative learning. Our mission is to empower students with practical skills and digital literacy that prepare them for the dynamic world of science and technology."
      </p>
    </div>
  </section>

  <section class="section-padding section-alt">
    <div class="container">
      <div class="grid-2" style="margin-bottom: 40px;">
        <div class="card-box">
          <h3 class="card-title" style="color:var(--navy-light);">🏫 Institution Overview</h3>
          <p class="card-desc" style="margin-bottom:14px;">
            Plan Aid Academy &amp; Educational Resource, Jos is situated at A.U Tetengi House, No 107/1 Bauchi Road, Jos North, Plateau State. The school provides quality education across Nursery, Primary, Secondary, and Arabic/Islamic Study units.
          </p>
          <p class="card-desc">
            We are committed to building analytical, innovative, and globally competitive learners equipped with digital skills, practical scientific experience, and strong moral character.
          </p>
        </div>
        <div class="card-box">
          <h3 class="card-title" style="color:var(--navy-light);">💡 Science &amp; Technology Focus</h3>
          <p class="card-desc" style="margin-bottom:14px;">
            Our academic programs prioritize STEM (Science, Technology, Engineering, and Mathematics) education. Students engage in practical laboratory experiments, computer programming, and robotics workshops.
          </p>
          <p class="card-desc">
            Through interactive learning and science fairs, we inspire discovery and critical thinking from early childhood through secondary education.
          </p>
        </div>
      </div>

      <div class="grid-3">
        <div class="card-box">
          <div class="card-icon-wrap">🧩</div>
          <h3 class="card-title">Practical Learning</h3>
          <p class="card-desc">Emphasis on hands-on laboratory experiments, project-based assignments, and interactive problem-solving modules.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">📲</div>
          <h3 class="card-title">Digital Literacy</h3>
          <p class="card-desc">Equipping every student with essential computer competencies, internet safety, coding foundations, and digital software skills.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🌟</div>
          <h3 class="card-title">Student Development</h3>
          <p class="card-desc">Cultivating moral integrity, intellectual curiosity, leadership qualities, and competitive academic excellence.</p>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- PAGE 3: ACADEMICS -->
<div class="page" id="page-academics">
  <section class="hero-section" style="padding: 40px 20px;">
    <div class="container">
      <span class="hero-badge-location">Academic Programs</span>
      <h1 class="hero-title-main">OUR <span>ACADEMIC UNITS</span></h1>
      <p class="hero-intro" style="margin-bottom:0;">Offering continuous, high-quality Science and ICT-based education from early childhood to secondary graduation.</p>
    </div>
  </section>

  <section class="section-padding section-alt">
    <div class="container">
      <div class="grid-2">
        <div class="card-box">
          <div class="card-icon-wrap">🌱</div>
          <h3 class="card-title">Nursery School Unit</h3>
          <p class="card-desc" style="margin-bottom:12px;">Creche, Pre-Nursery, and Nursery 1–2 foundation years.</p>
          <p class="card-desc">Focusing on early child development, foundational literacy, numeracy, creative play, and introductory digital exposure.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">✏️</div>
          <h3 class="card-title">Primary School Unit</h3>
          <p class="card-desc" style="margin-bottom:12px;">Primary 1 through Primary 6 core education.</p>
          <p class="card-desc">Integrating basic science, elementary computer studies, mathematics, language arts, and critical reasoning.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">📚</div>
          <h3 class="card-title">Secondary School Unit</h3>
          <p class="card-desc" style="margin-bottom:12px;">Junior Secondary (JSS 1–3) &amp; Senior Secondary (SSS 1–3).</p>
          <p class="card-desc">Comprehensive STEM subjects, WAEC/NECO examination preparation, advanced science practicals, and coding curriculum.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">☪️</div>
          <h3 class="card-title">Arabic &amp; Islamic Unit</h3>
          <p class="card-desc" style="margin-bottom:12px;">Qur'anic studies, Arabic language &amp; Islamic education.</p>
          <p class="card-desc">Qur'anic recitation (Tajweed), Arabic grammar, Islamic ethics, and bilingual report cards integrated alongside standard subjects.</p>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- PAGE 4: FOCUS AREAS -->
<div class="page" id="page-focus">
  <section class="hero-section" style="padding: 40px 20px;">
    <div class="container">
      <span class="hero-badge-location">Core Educational Pillars</span>
      <h1 class="hero-title-main">OUR <span>FOCUS AREAS</span></h1>
      <p class="hero-intro" style="margin-bottom:0;">Four key focus areas defining our academic approach and student development strategy.</p>
    </div>
  </section>

  <section class="section-padding section-alt">
    <div class="container">
      <div class="grid-2">
        <div class="card-box">
          <div class="card-icon-wrap">🔬</div>
          <h3 class="card-title">SCIENCE EDUCATION</h3>
          <p class="card-desc">Hands-on experiences, critical thinking, and problem-solving approaches that inspire discovery and innovation.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">💻</div>
          <h3 class="card-title">ICT INTEGRATION</h3>
          <p class="card-desc">State-of-the-art computer laboratories, coding lessons, robotics, and digital skills development for 21st-century learners.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">💡</div>
          <h3 class="card-title">INNOVATION &amp; CREATIVITY</h3>
          <p class="card-desc">Encouraging students to design, build, and explore through science fairs, tech projects, and digital creativity programs.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🎓</div>
          <h3 class="card-title">ACADEMIC EXCELLENCE</h3>
          <p class="card-desc">A robust curriculum that combines STEM subjects with strong moral and intellectual foundations.</p>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- PAGE 5: WHY CHOOSE US -->
<div class="page" id="page-why-choose">
  <section class="hero-section" style="padding: 40px 20px;">
    <div class="container">
      <span class="hero-badge-location">Why Plan Aid Academy</span>
      <h1 class="hero-title-main">WHY <span>CHOOSE US</span></h1>
      <p class="hero-intro" style="margin-bottom:0;">Dedicated to delivering qualitative, technology-driven education in Jos North, Plateau State.</p>
    </div>
  </section>

  <section class="section-padding section-alt">
    <div class="container">
      <div class="grid-3">
        <div class="card-box">
          <div class="card-icon-wrap">👨‍🏫</div>
          <h3 class="card-title">Qualified and Experienced Teachers</h3>
          <p class="card-desc">Passionate educators committed to student growth and modern teaching methodologies.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🔬</div>
          <h3 class="card-title">Modern Science &amp; Computer Laboratories</h3>
          <p class="card-desc">Equipped facilities for practical chemistry, biology, physics, and ICT lessons.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🤖</div>
          <h3 class="card-title">Coding and Robotics Programs</h3>
          <p class="card-desc">Teaching students programming logic, hardware automation, and digital skills from an early age.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">📲</div>
          <h3 class="card-title">E-Learning</h3>
          <p class="card-desc">Digital learning integration, student portal access, and online academic tracking.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🏆</div>
          <h3 class="card-title">Science &amp; Technology Competitions</h3>
          <p class="card-desc">Inspiring students through inter-school STEM challenges, innovation exhibitions, and tech fairs.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🏫</div>
          <h3 class="card-title">Conducive Learning Environment</h3>
          <p class="card-desc">A safe, well-organized campus designed for focused academic and personal growth.</p>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- PAGE 6: SCIENCE & ICT SHOWCASE -->
<div class="page" id="page-science-ict">
  <section class="hero-section" style="padding: 40px 20px;">
    <div class="container">
      <span class="hero-badge-location">STEM Excellence</span>
      <h1 class="hero-title-main">SCIENCE &amp; <span>ICT PROGRAM</span></h1>
      <p class="hero-intro" style="margin-bottom:0;">Building digital skills, scientific discovery, robotics, and creative problem-solving.</p>
    </div>
  </section>

  <section class="section-padding section-alt">
    <div class="container">
      <div class="grid-3">
        <div class="card-box"><div class="card-icon-wrap">🔬</div><h3 class="card-title">Science Education</h3><p class="card-desc">Interactive physics, chemistry, and biology experiments fostering deep scientific understanding.</p></div>
        <div class="card-box"><div class="card-icon-wrap">💻</div><h3 class="card-title">Computer Education</h3><p class="card-desc">Comprehensive ICT literacy, office tools, internet security, and computer fundamentals.</p></div>
        <div class="card-box"><div class="card-icon-wrap">👨‍💻</div><h3 class="card-title">Coding</h3><p class="card-desc">Introducing algorithms, web development basics, Python, and logic building for young programmers.</p></div>
        <div class="card-box"><div class="card-icon-wrap">🤖</div><h3 class="card-title">Robotics</h3><p class="card-desc">Hands-on robotics kits, sensor programming, and hardware automation modules.</p></div>
        <div class="card-box"><div class="card-icon-wrap">📲</div><h3 class="card-title">Digital Skills</h3><p class="card-desc">Developing 21st-century digital competencies, graphic tools, and computational thinking.</p></div>
        <div class="card-box"><div class="card-icon-wrap">💡</div><h3 class="card-title">Science Projects</h3><p class="card-desc">Student-led scientific research, model creation, and environmental technology solutions.</p></div>
        <div class="card-box"><div class="card-icon-wrap">🏆</div><h3 class="card-title">Technology Competitions</h3><p class="card-desc">Preparing students to represent the academy in regional and national STEM contests.</p></div>
        <div class="card-box"><div class="card-icon-wrap">🚀</div><h3 class="card-title">Innovation</h3><p class="card-desc">Cultivating an inventive mindset where students solve real-world problems with tech.</p></div>
        <div class="card-box"><div class="card-icon-wrap">🎨</div><h3 class="card-title">Creative Learning</h3><p class="card-desc">Blending digital art, multimedia presentations, and design thinking into school coursework.</p></div>
      </div>
    </div>
  </section>
</div>

<!-- PAGE 7: GALLERY -->
<div class="page" id="page-gallery">
  <section class="hero-section" style="padding: 40px 20px;">
    <div class="container">
      <span class="hero-badge-location">Campus &amp; Activities</span>
      <h1 class="hero-title-main">SCHOOL <span>GALLERY</span></h1>
      <p class="hero-intro" style="margin-bottom:0;">Highlights of academic projects, science practicals, ICT classes, and student life at Plan Aid Academy.</p>
    </div>
  </section>

  <section class="section-padding section-alt">
    <div class="container">
      <div class="gallery-nav">
        <button class="gallery-filter-btn active" onclick="filterGallery('all', this)">All</button>
        <button class="gallery-filter-btn" onclick="filterGallery('science', this)">Science Education</button>
        <button class="gallery-filter-btn" onclick="filterGallery('ict', this)">ICT &amp; Computer</button>
        <button class="gallery-filter-btn" onclick="filterGallery('coding', this)">Coding &amp; Robotics</button>
        <button class="gallery-filter-btn" onclick="filterGallery('activities', this)">School Activities</button>
        <button class="gallery-filter-btn" onclick="filterGallery('students', this)">Students</button>
        <button class="gallery-filter-btn" onclick="filterGallery('graduation', this)">Graduation</button>
        <button class="gallery-filter-btn" onclick="filterGallery('classroom', this)">Classroom</button>
        <button class="gallery-filter-btn" onclick="filterGallery('competitions', this)">Competitions</button>
      </div>

      <div class="grid-3" id="galleryContainer">
        <div class="gallery-card" data-cat="science">
          <div class="gallery-img-placeholder">
            <span class="gallery-tag">Science</span>
            <div style="font-size:36px; margin-bottom:8px;">🧪</div>
            <div style="font-weight:700; font-size:14px;">Science Laboratory Practical</div>
          </div>
          <div class="gallery-body">
            <div class="gallery-title">Chemistry Lab Experiment</div>
            <div class="gallery-sub">Students conducting chemical analysis in the science laboratory.</div>
          </div>
        </div>

        <div class="gallery-card" data-cat="ict">
          <div class="gallery-img-placeholder" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
            <span class="gallery-tag">ICT</span>
            <div style="font-size:36px; margin-bottom:8px;">💻</div>
            <div style="font-weight:700; font-size:14px;">ICT Computer Laboratory</div>
          </div>
          <div class="gallery-body">
            <div class="gallery-title">Computer Science Class</div>
            <div class="gallery-sub">Hands-on ICT training and software application practice.</div>
          </div>
        </div>

        <div class="gallery-card" data-cat="coding">
          <div class="gallery-img-placeholder" style="background: linear-gradient(135deg, #065f46 0%, #047857 100%);">
            <span class="gallery-tag">Coding</span>
            <div style="font-size:36px; margin-bottom:8px;">🤖</div>
            <div style="font-weight:700; font-size:14px;">Robotics &amp; Coding Workshop</div>
          </div>
          <div class="gallery-body">
            <div class="gallery-title">Robotics Kit Assembly</div>
            <div class="gallery-sub">Junior programmers building and coding autonomous robotics models.</div>
          </div>
        </div>

        <div class="gallery-card" data-cat="competitions">
          <div class="gallery-img-placeholder" style="background: linear-gradient(135deg, #78350f 0%, #b45309 100%);">
            <span class="gallery-tag">Competitions</span>
            <div style="font-size:36px; margin-bottom:8px;">🏆</div>
            <div style="font-weight:700; font-size:14px;">Annual Science Fair</div>
          </div>
          <div class="gallery-body">
            <div class="gallery-title">STEM Project Exhibition</div>
            <div class="gallery-sub">Student innovative projects presented at the annual technology competition.</div>
          </div>
        </div>

        <div class="gallery-card" data-cat="classroom">
          <div class="gallery-img-placeholder" style="background: linear-gradient(135deg, #312e81 0%, #4338ca 100%);">
            <span class="gallery-tag">Classroom</span>
            <div style="font-size:36px; margin-bottom:8px;">📚</div>
            <div style="font-weight:700; font-size:14px;">Interactive Learning Session</div>
          </div>
          <div class="gallery-body">
            <div class="gallery-title">Secondary Mathematics Class</div>
            <div class="gallery-sub">Engaging problem-solving session in a modern classroom setup.</div>
          </div>
        </div>

        <div class="gallery-card" data-cat="graduation">
          <div class="gallery-img-placeholder" style="background: linear-gradient(135deg, #831843 0%, #be185d 100%);">
            <span class="gallery-tag">Graduation</span>
            <div style="font-size:36px; margin-bottom:8px;">🎓</div>
            <div style="font-weight:700; font-size:14px;">Annual Graduation Ceremony</div>
          </div>
          <div class="gallery-body">
            <div class="gallery-title">Graduating Class Celebration</div>
            <div class="gallery-sub">Celebrating academic achievement and student excellence.</div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- PAGE 8: CONTACT US -->
<div class="page" id="page-contact">
  <section class="hero-section" style="padding: 40px 20px;">
    <div class="container">
      <span class="hero-badge-location">Get in Touch</span>
      <h1 class="hero-title-main">CONTACT <span>OUR OFFICE</span></h1>
      <p class="hero-intro" style="margin-bottom:0;">We welcome your inquiries, school visit requests, and admission questions.</p>
    </div>
  </section>

  <section class="section-padding section-alt">
    <div class="container">
      <div class="grid-2">
        <div class="contact-info-card">
          <h3 class="section-title" style="font-size:24px; margin-bottom:24px;">Official Contact Details</h3>
          
          <div class="contact-item">
            <div class="contact-icon">📍</div>
            <div class="contact-text">
              <h4>School Address</h4>
              <p>
                A.U TETENGI HOUSE,<br/>
                No 107/1 BAUCHI ROAD, JOS,<br/>
                JOS NORTH, PLATEAU STATE
              </p>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-icon">📞</div>
            <div class="contact-text">
              <h4>Phone Numbers</h4>
              <p>
                <a href="tel:08030459595">08030459595</a><br/>
                <a href="tel:08088552501">08088552501</a>
              </p>
              <a href="https://wa.me/2348030459595" target="_blank" class="btn-hero-cyan" style="display:inline-block; margin-top:10px; padding:6px 14px; font-size:12px;">💬 Chat on WhatsApp</a>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-icon">✉️</div>
            <div class="contact-text">
              <h4>Email Address</h4>
              <p><a href="mailto:planaidjos@gmail.com">planaidjos@gmail.com</a></p>
            </div>
          </div>
        </div>

        <div class="contact-info-card">
          <h3 class="section-title" style="font-size:24px; margin-bottom:20px;">Send Us A Message</h3>
          <form onsubmit="event.preventDefault(); alert('Thank you for contacting Plan Aid Academy! We will respond shortly.');">
            <div class="form-group">
              <label>Your Full Name</label>
              <input type="text" placeholder="Enter your name" required/>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" placeholder="email@example.com" required/>
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" placeholder="08012345678" required/>
              </div>
            </div>
            <div class="form-group">
              <label>Subject</label>
              <input type="text" placeholder="Inquiry about admissions, fees, etc." required/>
            </div>
            <div class="form-group">
              <label>Message</label>
              <textarea placeholder="Write your message here..." style="min-height:100px" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Submit Message</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- PAGE 9: ADMISSION APPLICATION (PRESERVED) -->
<div class="page" id="page-admission">
  <section class="section-padding">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Enrolment Application</span>
        <h2 class="section-title">Online Student Admission</h2>
        <p class="section-subtitle">Complete the form below to apply for admission at Plan Aid Academy. You will receive an instant application reference number.</p>
      </div>
      <div id="admissionForm">
        <div class="slip" style="max-width:760px; border-color:var(--border);">
          <h2 style="font-family:'Playfair Display',serif; font-size:24px; color:var(--navy); margin-bottom:4px;">Student Admission Form</h2>
          <p style="font-size:13px; color:var(--text-muted); margin-bottom:24px;">Plan Aid Academy &amp; Educational Resource, Jos · Academic Session Registration</p>
          <div class="form-group">
            <label>School Unit Applying For</label>
            <select id="admUnit">
              <option value="">— Select Unit —</option>
              <option>Nursery School Unit (Creche / Pre-Nursery / Nursery 1-2)</option>
              <option>Primary School Unit (Primary 1 – 6)</option>
              <option>Junior Secondary School Unit (JSS 1 – 3)</option>
              <option>Senior Secondary School Unit (SSS 1 – 3)</option>
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
            <div class="form-group"><label>Religion</label><select id="admReligion"><option>Christianity</option><option>Islam</option><option>Other</option></select></div>
          </div>
          <hr style="margin:20px 0; border:none; border-top:1px solid var(--border);"/>
          <div class="form-row">
            <div class="form-group"><label>Parent / Guardian Name</label><input id="admParent" type="text" placeholder="Full name"/></div>
            <div class="form-group"><label>Phone Number</label><input id="admPhone" type="tel" placeholder="080XXXXXXXX"/></div>
          </div>
          <div class="form-group"><label>Home Address</label><textarea id="admAddress" placeholder="Address, Jos"></textarea></div>
          <button class="btn-submit" onclick="submitAdmission()">Submit Application &amp; Generate Admission Slip</button>
        </div>
      </div>

      <div id="admissionSlip" class="hidden" style="margin-top:32px">
        <div class="slip">
          <div class="slip-header">
            <div class="slip-logo">🎓</div>
            <div class="slip-school">
              <h2>PLAN AID ACADEMY</h2>
              <p>&amp; Educational Resource, Jos</p>
              <p style="font-size:11px;color:#888">Admission Slip</p>
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
            <div class="slip-field"><div class="lbl">Phone</div><div class="val" id="slipPhone">—</div></div>
          </div>
          <div class="slip-footer">
            <div>Application Date: <b id="slipDate"></b></div>
            <div>Status: <span class="badge badge-gold">Pending Review</span></div>
            <button class="btn-print" onclick="window.print()">🖨️ Print Slip</button>
          </div>
        </div>
        <div style="text-align:center;margin-top:20px">
          <button onclick="newApplication()" class="btn-hero-outline" style="color:var(--navy); border-color:var(--navy);">Submit Another Application</button>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- PAGE 10: RESULTS PORTAL (PRESERVED) -->
<div class="page" id="page-results">
  <section class="section-padding">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Academic Verification</span>
        <h2 class="section-title">Student Result Portal</h2>
        <p class="section-subtitle">Enter student admission number to access and print academic report cards.</p>
      </div>
      <div class="slip" style="max-width:680px; border-color:var(--border); margin-bottom:28px;">
        <h2 style="font-family:'Playfair Display',serif; font-size:22px; color:var(--navy); margin-bottom:16px;">Check Results</h2>
        <div class="form-row">
          <div class="form-group"><label>Student ID / Admission Number</label><input id="resId" type="text" placeholder="e.g. PAA-2025-0047"/></div>
          <div class="form-group"><label>Academic Session</label><select><option>2025/2026</option><option>2024/2025</option></select></div>
        </div>
        <div class="form-row">
          <div class="form-group"><label>Term</label><select><option>1st Term</option><option>2nd Term</option><option>3rd Term</option></select></div>
          <div class="form-group"><label>School Unit</label><select><option>Secondary School</option><option>Primary School</option><option>Nursery School</option><option>Arabic Unit</option></select></div>
        </div>
        <button class="btn-submit" onclick="checkResults()">View Result Card</button>
      </div>

      <div id="resultCard" class="hidden">
        <div class="slip" style="max-width:760px">
          <div class="slip-header">
            <div class="slip-logo">🎓</div>
            <div class="slip-school">
              <h2>PLAN AID ACADEMY</h2>
              <p>&amp; Educational Resource, Jos · Academic Report Card</p>
            </div>
            <div class="slip-no">JSS 2A</div>
          </div>
          <div class="slip-row" style="grid-template-columns:1fr 1fr 1fr">
            <div class="slip-field"><div class="lbl">Student Name</div><div class="val">Aisha Mohammed</div></div>
            <div class="slip-field"><div class="lbl">Admission No.</div><div class="val">PAA-2025-0047</div></div>
            <div class="slip-field"><div class="lbl">Class</div><div class="val">JSS 2A</div></div>
          </div>
          <div class="table-wrap" style="margin:16px 0">
            <table>
              <thead><tr><th>Subject</th><th>CA (40)</th><th>Exam (60)</th><th>Total</th><th>Grade</th><th>Remark</th></tr></thead>
              <tbody>
                <tr><td>Mathematics</td><td>34</td><td>52</td><td>86</td><td><span class="badge badge-green">A</span></td><td>Excellent</td></tr>
                <tr><td>English Language</td><td>30</td><td>48</td><td>78</td><td><span class="badge badge-green">B</span></td><td>Good</td></tr>
                <tr><td>Basic Science</td><td>32</td><td>50</td><td>82</td><td><span class="badge badge-green">A</span></td><td>Very Good</td></tr>
                <tr><td>Computer Studies / ICT</td><td>36</td><td>54</td><td>90</td><td><span class="badge badge-green">A</span></td><td>Excellent</td></tr>
                <tr><td>Agric Science</td><td>35</td><td>55</td><td>90</td><td><span class="badge badge-green">A</span></td><td>Excellent</td></tr>
                <tr><td>Civic Education</td><td>29</td><td>46</td><td>75</td><td><span class="badge badge-gold">B</span></td><td>Good</td></tr>
                <tr><td>Arabic Language</td><td>38</td><td>57</td><td>95</td><td><span class="badge badge-green">A</span></td><td>Excellent</td></tr>
              </tbody>
            </table>
          </div>
          <div class="slip-row">
            <div class="slip-field"><div class="lbl">Total Score</div><div class="val" style="color:var(--navy)">596 / 700</div></div>
            <div class="slip-field"><div class="lbl">Average</div><div class="val" style="color:var(--navy)">85.1%</div></div>
            <div class="slip-field"><div class="lbl">Position</div><div class="val">1st / 42</div></div>
          </div>
          <div class="slip-footer">
            <div>Principal: <b>Mr. Samuel Dung</b></div>
            <button class="btn-print" onclick="window.print()">🖨️ Print Report</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- PAGE 11: ARABIC UNIT (PRESERVED) -->
<div class="page" id="page-arabic">
  <section class="hero-section" style="padding: 40px 20px;">
    <div class="container">
      <span class="hero-badge-location">☪️ Arabic &amp; Islamic Studies Unit</span>
      <h1 class="hero-title-main">ARABIC &amp; <span>ISLAMIC EDUCATION</span></h1>
      <p class="hero-intro" style="margin-bottom:0;">Integrating Qur'anic memorization, Tajweed, Arabic language, and Islamic ethics into our STEM curriculum.</p>
    </div>
  </section>

  <section class="section-padding section-alt">
    <div class="container">
      <div class="grid-2">
        <div class="card-box">
          <div class="card-icon-wrap">📖</div>
          <h3 class="card-title">Qur'anic Studies</h3>
          <p class="arabic-text" style="font-size:18px; margin-bottom:8px;">تحفيظ القرآن الكريم وتجويده</p>
          <p class="card-desc">Hifz (memorisation), Tajweed (recitation) and Tafseer (interpretation) from beginner to advanced levels.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">✍️</div>
          <h3 class="card-title">Arabic Language</h3>
          <p class="arabic-text" style="font-size:18px; margin-bottom:8px;">اللغة العربية – قراءة وكتابة ومحادثة</p>
          <p class="card-desc">Reading, writing, grammar and spoken Arabic across Foundation, Intermediate and Advanced levels.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">🕌</div>
          <h3 class="card-title">Islamic Studies</h3>
          <p class="arabic-text" style="font-size:18px; margin-bottom:8px;">الفقه والعقيدة والسيرة النبوية</p>
          <p class="card-desc">Fiqh, Aqeedah, Seerah (Prophet's biography) and Islamic ethics integrated into the weekly timetable.</p>
        </div>
        <div class="card-box">
          <div class="card-icon-wrap">📜</div>
          <h3 class="card-title">Bilingual Reports</h3>
          <p class="arabic-text" style="font-size:18px; margin-bottom:8px;">كشف الدرجات – عربي وإنجليزي</p>
          <p class="card-desc">Arabic Unit students receive bilingual report cards in both English and Arabic, certified by the Unit Head.</p>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- PAGE 12: PORTAL DASHBOARD (PRESERVED) -->
<div class="page" id="page-dashboard">
  <div class="dash-layout">
    <div class="dash-sidebar">
      <div class="user-info">
        <div class="avatar" id="dashAvatar">P</div>
        <h4 id="dashName">Mr. Samuel Dung</h4>
        <span id="dashRole">Principal</span>
      </div>
      <div class="dash-nav">
        <a class="active" onclick="showDashSection('overview')"><span class="ico">🏠</span> Overview</a>
        <a onclick="showDashSection('students')"><span class="ico">👥</span> Students</a>
        <a onclick="showDashSection('staff')"><span class="ico">👩‍🏫</span> Staff</a>
        <a onclick="showDashSection('admissions')"><span class="ico">📝</span> Admissions</a>
        <a onclick="showDashSection('results')"><span class="ico">📊</span> Results</a>
        <a onclick="showDashSection('finance')"><span class="ico">💰</span> Finance</a>
        <a onclick="showDashSection('timetable')"><span class="ico">📅</span> Timetable</a>
        <a onclick="showDashSection('reports')"><span class="ico">📄</span> Reports</a>
        <a onclick="logOut()"><span class="ico">🚪</span> Log Out</a>
      </div>
    </div>
    <div class="dash-content">
      <div class="dash-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <h2 id="dashSectionTitle" style="font-family:'Playfair Display',serif; font-size:24px; color:var(--navy);">School Overview</h2>
        <span class="badge badge-green" id="dashUnitBadge">All Units</span>
      </div>

      <div id="ds-overview">
        <div class="dash-cards">
          <div class="dash-card"><div class="dc-val">Plan Aid</div><div class="dc-lbl">School Management</div></div>
          <div class="dash-card"><div class="dc-val">4</div><div class="dc-lbl">Academic Units</div></div>
          <div class="dash-card"><div class="dc-val">Active</div><div class="dc-lbl">Academic Session</div></div>
        </div>
        <div class="table-wrap">
          <div class="table-head"><h3>Academic Units Status</h3></div>
          <table>
            <thead><tr><th>Unit</th><th>Head Teacher</th><th>Focus Area</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td>🌱 Nursery School</td><td>Mrs. Grace Longs</td><td>Early Science &amp; Literacy</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>✏️ Primary School</td><td>Mr. Elisha Pwol</td><td>Basic Science &amp; Math</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>📚 Secondary School</td><td>Mrs. Amaka Uche</td><td>STEM &amp; Computer Science</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>☪️ Arabic Unit</td><td>Mallam Umar Sani</td><td>Arabic &amp; Islamic Studies</td><td><span class="badge badge-green">Active</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="ds-students" class="hidden">
        <div class="table-wrap">
          <div class="table-head"><h3>Student Register</h3><button class="btn-hero-primary" style="font-size:11px; padding:6px 12px;" onclick="showPage('admission')">+ New Admission</button></div>
          <table>
            <thead><tr><th>Adm. No.</th><th>Name</th><th>Class</th><th>Unit</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td>PAA-2025-0047</td><td>Aisha Mohammed</td><td>JSS 2A</td><td>Secondary</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>PAA-2025-0112</td><td>Ibrahim Hassan</td><td>SSS 2</td><td>Secondary</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>PAA-2025-0089</td><td>Fatima Yusuf</td><td>Primary 5</td><td>Primary</td><td><span class="badge badge-green">Active</span></td></tr>
            </tbody>
          </table>
        </div>
        <div id="studentLoginInfoPanel" class="table-wrap" style="margin-top:20px;display:none">
          <div class="table-head"><h3>🔐 Student Portal Login Info</h3></div>
          <table>
            <thead><tr><th>Name</th><th>Username</th><th>Approval Code</th><th>Approved By</th><th>Action</th></tr></thead>
            <tbody id="studentLoginInfoBody"><tr><td colspan="5" style="text-align:center;color:#888;padding:20px">No student portal accounts generated yet.</td></tr></tbody>
          </table>
        </div>
      </div>

      <div id="ds-staff" class="hidden">
        <div class="table-wrap">
          <div class="table-head"><h3>Staff Directory</h3><button class="btn-hero-primary" style="font-size:11px; padding:6px 12px;" onclick="openAddStaff()">+ Add Staff</button></div>
          <table>
            <thead><tr><th>Staff ID</th><th>Name</th><th>Role</th><th>Unit</th><th>Subject</th><th>Status</th></tr></thead>
            <tbody id="staffTableBody">
              <tr><td>PAA-ST-001</td><td>Mrs. Amaka Uche</td><td>Head of Secondary</td><td>Secondary</td><td>English Language</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>PAA-ST-002</td><td>Mr. Elisha Pwol</td><td>Head of Primary</td><td>Primary</td><td>Mathematics</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>PAA-ST-003</td><td>Mrs. Grace Longs</td><td>Head of Nursery</td><td>Nursery</td><td>Early Childhood</td><td><span class="badge badge-green">Active</span></td></tr>
              <tr><td>PAA-ST-004</td><td>Mallam Umar Sani</td><td>Head of Arabic</td><td>Arabic</td><td>Arabic Language</td><td><span class="badge badge-green">Active</span></td></tr>
            </tbody>
          </table>
        </div>
        <div id="staffLoginInfoPanel" class="table-wrap" style="margin-top:20px;display:none">
          <div class="table-head"><h3>🔐 Staff Portal Login Info</h3></div>
          <table>
            <thead><tr><th>Name</th><th>Role</th><th>Username</th><th>Approval Code</th><th>Approved By</th><th>Action</th></tr></thead>
            <tbody id="staffLoginInfoBody"><tr><td colspan="6" style="text-align:center;color:#888;padding:20px">No staff portal accounts generated yet.</td></tr></tbody>
          </table>
        </div>
      </div>

      <div id="ds-admissions" class="hidden">
        <div class="table-wrap">
          <div class="table-head"><h3>Admission Applications</h3></div>
          <table>
            <thead><tr><th>App. No.</th><th>Name</th><th>Unit Applied</th><th>Date</th><th>Status</th><th>Action</th></tr></thead>
            <tbody id="admissionsTableBody">
              <tr><td>PAA-2025-0041</td><td>Daniel Gyang</td><td>JSS 1</td><td>12 May 2025</td><td><span class="badge badge-gold">Pending</span></td><td><button onclick="approveApplication('PAA-2025-0041','Daniel Gyang','JSS 1')" style="background:var(--navy);color:#fff;border:none;padding:5px 12px;border-radius:4px;font-size:11px;cursor:pointer">Approve</button></td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="ds-results" class="hidden">
        <div class="table-wrap">
          <div class="table-head"><h3>Result Entry Status by Class</h3></div>
          <table>
            <thead><tr><th>Class</th><th>Teacher</th><th>Students</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td>SSS 2</td><td>Mrs. Amaka Uche</td><td>42</td><td><span class="badge badge-green">Complete</span></td></tr>
              <tr><td>JSS 2A</td><td>Mrs. Fatima Sani</td><td>40</td><td><span class="badge badge-gold">In Progress</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="ds-finance" class="hidden">
        <div class="table-wrap">
          <div class="table-head"><h3>Finance &amp; Fee Status</h3></div>
          <div style="padding:20px; color:var(--text-muted); font-size:14px;">Fee tracking and financial management.</div>
        </div>
      </div>

      <div id="ds-timetable" class="hidden">
        <div class="table-wrap">
          <div class="table-head"><h3>School Timetables</h3></div>
          <div style="padding:20px; color:var(--text-muted); font-size:14px;">Class schedules and weekly timetables.</div>
        </div>
      </div>

      <div id="ds-reports" class="hidden">
        <div class="table-wrap">
          <div class="table-head"><h3>Academic Reports</h3></div>
          <div style="padding:20px; color:var(--text-muted); font-size:14px;">Termly reports and statistics.</div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- SCRIPTS -->
<script>
function toggleMobileMenu(){
  document.getElementById('mobileMenu').classList.toggle('open');
}

function showPage(id){
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('active'));
  const target = document.getElementById('page-'+id);
  if(target){
    target.classList.add('active');
  } else {
    document.getElementById('page-home').classList.add('active');
  }
  document.querySelectorAll('.nav-menu button').forEach(b=>b.classList.remove('active'));
  const nb=document.getElementById('nav-'+id);
  if(nb) nb.classList.add('active');
  window.scrollTo(0,0);
}

function filterGallery(category, btn){
  document.querySelectorAll('.gallery-filter-btn').forEach(b=>b.classList.remove('active'));
  if(btn) btn.classList.add('active');
  
  const cards = document.querySelectorAll('.gallery-card');
  cards.forEach(card => {
    if(category === 'all' || card.getAttribute('data-cat') === category){
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
}

// Portal Login JS Logic
let currentRole='principal';
let appCounter=42;
let staffCounter=4;
const SUBMITTED_APPS_KEY='paaSubmittedApplications';
let submittedApplications=loadSubmittedApplications();

function loadSubmittedApplications(){
  try{
    const stored=localStorage.getItem(SUBMITTED_APPS_KEY);
    return stored ? JSON.parse(stored) : [];
  }catch(e){ return []; }
}
function saveSubmittedApplications(){
  localStorage.setItem(SUBMITTED_APPS_KEY, JSON.stringify(submittedApplications));
}

function addApplicationToTable(app){
  const tbody=document.getElementById('admissionsTableBody');
  if(!tbody) return;
  const row=document.createElement('tr');
  row.id='app-row-'+app.appNo;
  const isApproved=app.status==='approved';
  const approveBtn='<button onclick="approveApplication(\x27'+escapeHtml(app.appNo)+'\x27,\x27'+escapeHtml(app.name)+'\x27,\x27'+escapeHtml(app.unit)+'\x27)" style="background:var(--navy);color:#fff;border:none;padding:5px 12px;border-radius:4px;font-size:11px;cursor:pointer">Approve</button>';
  row.innerHTML='<td>'+escapeHtml(app.appNo)+'</td>'
    +'<td>'+escapeHtml(app.name)+'</td>'
    +'<td>'+escapeHtml(app.unit)+'</td>'
    +'<td>'+escapeHtml(app.date)+'</td>'
    +'<td><span class="badge '+(isApproved?'badge-green':'badge-gold')+'">'+(isApproved?'Approved':'Pending')+'</span></td>'
    +'<td>'+(isApproved?'<span style="font-weight:700;color:var(--navy)">Approved</span>':approveBtn)+'</td>';
  tbody.prepend(row);
}
function renderSavedApplications(){ submittedApplications.forEach(app=>addApplicationToTable(app)); }

const adminRoles=['principal','unithead'];
const portalRoles={
  principal:{ username:'PAA-PRINCIPAL', secret:'PAA@Principal2026', name:'Mr. Samuel Dung', roleLabel:'Principal', unit:'All Units', avatar:'P', userType:'admin', defaultSection:'overview' },
  unithead:{ username:'PAA-UH-001', secret:'PAA@UnitHead2026', name:'Head Teacher', roleLabel:'Head Teacher', unit:'All Units', avatar:'H', userType:'admin', defaultSection:'overview' },
  staff:{ roleLabel:'Staff', userType:'staff', defaultSection:'overview' },
  student:{ roleLabel:'Student', userType:'student', defaultSection:'results' }
};
const portalAccess={
  admin:['overview','students','staff','admissions','results','finance','timetable','reports'],
  staff:['overview','students','results','timetable','reports'],
  student:['overview','results','finance','timetable']
};

const GENERATED_USERS_KEY='paaGeneratedPortalUsers';
let generatedPortalUsers=loadGeneratedPortalUsers();
let activePortalUserType='admin';
let activeAllowedSections=portalAccess.admin.slice();
let activeUser=null;

function loadGeneratedPortalUsers(){
  try{ const stored=localStorage.getItem(GENERATED_USERS_KEY); return stored ? JSON.parse(stored) : {}; }catch(e){ return {}; }
}
function saveGeneratedPortalUsers(){ localStorage.setItem(GENERATED_USERS_KEY, JSON.stringify(generatedPortalUsers)); }
function normalizeUsername(username){ return String(username||'').trim().toUpperCase(); }
function generateApprovalCode(length=8){
  const chars='ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
  let code='';
  for(let i=0;i<length;i++){ code+=chars[Math.floor(Math.random()*chars.length)]; }
  return 'PAA-'+code;
}
function getInitials(name){
  const parts=String(name||'').trim().split(/\s+/).filter(Boolean);
  if(parts.length===0) return '?';
  if(parts.length===1) return parts[0].charAt(0).toUpperCase();
  return (parts[0].charAt(0)+parts[parts.length-1].charAt(0)).toUpperCase();
}
function getApproverName(){ return activeUser ? activeUser.name : 'Principal'; }

function updateLoginInfoTables(){
  const isAdm = (activePortalUserType === 'admin');
  const studentPanel = document.getElementById('studentLoginInfoPanel');
  if (studentPanel) {
    if (isAdm) {
      studentPanel.style.display = 'block';
      const body = document.getElementById('studentLoginInfoBody');
      const studentsList = Object.values(generatedPortalUsers).filter(u => u.role === 'student');
      if (studentsList.length === 0) {
        body.innerHTML = '<tr><td colspan="5" style="text-align:center;color:#888;padding:20px">No student portal accounts generated yet.</td></tr>';
      } else {
        body.innerHTML = studentsList.map(u => `
          <tr>
            <td>${escapeHtml(u.name)}</td>
            <td><code>${escapeHtml(u.username)}</code></td>
            <td><code>${escapeHtml(u.approvalCode)}</code></td>
            <td>${escapeHtml(u.approvedBy)}</td>
            <td><button onclick="showCredentialsModal('${escapeHtml(u.username)}', '${escapeHtml(u.approvalCode)}', '${escapeHtml(u.name)}', '${escapeHtml(u.unit)}', '${escapeHtml(u.roleLabel)}')" style="background:var(--navy);color:#fff;border:none;padding:4px 8px;border-radius:4px;font-size:11px;cursor:pointer">Show Code</button></td>
          </tr>
        `).join('');
      }
    } else { studentPanel.style.display = 'none'; }
  }

  const staffPanel = document.getElementById('staffLoginInfoPanel');
  if (staffPanel) {
    if (isAdm) {
      staffPanel.style.display = 'block';
      const body = document.getElementById('staffLoginInfoBody');
      const staffList = Object.values(generatedPortalUsers).filter(u => u.role === 'staff');
      if (staffList.length === 0) {
        body.innerHTML = '<tr><td colspan="6" style="text-align:center;color:#888;padding:20px">No staff portal accounts generated yet.</td></tr>';
      } else {
        body.innerHTML = staffList.map(u => `
          <tr>
            <td>${escapeHtml(u.name)}</td>
            <td>${escapeHtml(u.roleLabel)}</td>
            <td><code>${escapeHtml(u.username)}</code></td>
            <td><code>${escapeHtml(u.approvalCode)}</code></td>
            <td>${escapeHtml(u.approvedBy)}</td>
            <td><button onclick="showCredentialsModal('${escapeHtml(u.username)}', '${escapeHtml(u.approvalCode)}', '${escapeHtml(u.name)}', '${escapeHtml(u.unit)}', '${escapeHtml(u.roleLabel)}')" style="background:var(--navy);color:#fff;border:none;padding:4px 8px;border-radius:4px;font-size:11px;cursor:pointer">Show Code</button></td>
          </tr>
        `).join('');
      }
    } else { staffPanel.style.display = 'none'; }
  }
}

function registerGeneratedPortalUser(user){
  const key=normalizeUsername(user.username);
  generatedPortalUsers[key]={
    username:user.username, approvalCode:user.approvalCode, role:user.role, userType:user.userType,
    name:user.name, roleLabel:user.roleLabel, unit:user.unit, avatar:user.avatar || getInitials(user.name),
    defaultSection:user.defaultSection || 'overview', status:'approved', approvedBy:getApproverName(), approvedAt:new Date().toISOString()
  };
  saveGeneratedPortalUsers(); updateLoginInfoTables(); return generatedPortalUsers[key];
}

function findGeneratedPortalUser(username, role){
  const user=generatedPortalUsers[normalizeUsername(username)];
  if(!user || user.role!==role) return null; return user;
}

function openModal(){ document.getElementById('loginModal').classList.add('open'); }
function closeModal(){ document.getElementById('loginModal').classList.remove('open'); }
function closeCredModal(){ document.getElementById('credModal').classList.remove('open'); }
function openAddStaff(){ document.getElementById('addStaffModal').classList.add('open'); }
function closeAddStaffModal(){ document.getElementById('addStaffModal').classList.remove('open'); }

function setRole(el,role){
  if(!portalRoles[role]) return;
  document.querySelectorAll('.role-tab').forEach(t=>t.classList.remove('active'));
  el.classList.add('active'); currentRole=role;
  const isAdmin=adminRoles.includes(role);
  document.getElementById('loginUsernameLabel').textContent=role==='student' ? 'Student ID / Admission No.' : 'Staff ID / Email';
  document.getElementById('loginSecretLabel').textContent=isAdmin ? 'Password' : 'Approval Code';
  document.getElementById('loginUsername').placeholder=isAdmin ? ('e.g. '+portalRoles[role].username) : (role==='student' ? 'e.g. PAA-2025-0041' : 'e.g. PAA-ST-007');
  document.getElementById('loginPassword').placeholder=isAdmin ? 'Enter password' : 'Enter generated approval code';
}

function doLogin(){
  const username=document.getElementById('loginUsername').value.trim();
  const secret=document.getElementById('loginPassword').value;
  const roleConfig=portalRoles[currentRole];
  if(!roleConfig || !username || !secret){ alert('Enter your credentials.'); return; }

  if(adminRoles.includes(currentRole)){
    if(username!==roleConfig.username || secret!==roleConfig.secret){ alert('Incorrect username or password.'); return; }
    startPortalSession({ username:roleConfig.username, name:roleConfig.name, role:currentRole, roleLabel:roleConfig.roleLabel, unit:roleConfig.unit, avatar:roleConfig.avatar, userType:roleConfig.userType, defaultSection:roleConfig.defaultSection });
    return;
  }
  const approvedUser=findGeneratedPortalUser(username, currentRole);
  if(!approvedUser || secret!==approvedUser.approvalCode){ alert('Invalid portal account or approval code.'); return; }
  startPortalSession(approvedUser);
}

function startPortalSession(user){
  closeModal(); activeUser=user; activePortalUserType=user.userType||'admin';
  activeAllowedSections=(portalAccess[activePortalUserType]||portalAccess.admin).slice();
  document.getElementById('dashName').textContent=user.name||'Portal User';
  document.getElementById('dashRole').textContent=user.roleLabel||'Portal User';
  document.getElementById('dashAvatar').textContent=user.avatar||getInitials(user.name);
  document.getElementById('dashUnitBadge').textContent=user.unit||user.roleLabel||'Portal';
  applyPortalAccess(); showPage('dashboard'); updateLoginInfoTables();
  showDashSection(user.defaultSection||activeAllowedSections[0]||'overview');
}

function showRoleLoginDetails(){
  if(!adminRoles.includes(currentRole)){ alert('Code required after admin approval.'); return; }
  const roleCredential=portalRoles[currentRole]; closeModal();
  showCredentialsModal(roleCredential.username, roleCredential.secret, roleCredential.name, roleCredential.unit, roleCredential.roleLabel, 'Password');
}

function logOut(){ activePortalUserType='admin'; activeUser=null; showPage('home'); }
function getDashSectionFromLink(link){ const match=(link.getAttribute('onclick')||'').match(/showDashSection\('([^']+)'\)/); return match ? match[1] : null; }
function applyPortalAccess(){
  document.querySelectorAll('.dash-nav a').forEach(link=>{
    const section=getDashSectionFromLink(link);
    if(!section) return; link.style.display=activeAllowedSections.includes(section) ? 'flex' : 'none';
  });
}
function showDashSection(sec){
  if(!activeAllowedSections.includes(sec)){ sec=activeAllowedSections[0]||'overview'; }
  document.querySelectorAll('[id^="ds-"]').forEach(d=>d.classList.add('hidden'));
  document.getElementById('ds-'+sec).classList.remove('hidden');
  document.querySelectorAll('.dash-nav a').forEach(a=>a.classList.remove('active'));
  const activeLink=Array.from(document.querySelectorAll('.dash-nav a')).find(a=>getDashSectionFromLink(a)===sec);
  if(activeLink) activeLink.classList.add('active');
  const titles={overview:'School Overview',students:'Student Register',staff:'Staff Management',admissions:'Admissions',results:'Result Management',finance:'Finance Dashboard',timetable:'Timetables',reports:'Reports'};
  document.getElementById('dashSectionTitle').textContent=titles[sec]||'';
  updateLoginInfoTables();
}

function submitAdmission(){
  const unit=document.getElementById('admUnit').value;
  const surname=document.getElementById('admSurname').value.trim();
  const first=document.getElementById('admFirst').value.trim();
  const dob=document.getElementById('admDob').value;
  const gender=document.getElementById('admGender').value;
  const parent=document.getElementById('admParent').value.trim();
  const phone=document.getElementById('admPhone').value.trim();
  if(!unit||!surname||!first){ alert('Please fill in required fields.'); return; }
  appCounter++;
  const appNo='PAA-2025-'+String(appCounter).padStart(4,'0');
  const fullName=(surname+' '+first);
  const dateStr=new Date().toLocaleDateString('en-NG',{day:'numeric',month:'short',year:'numeric'});

  document.getElementById('slipNo').textContent=appNo;
  document.getElementById('slipName').textContent=fullName.toUpperCase();
  document.getElementById('slipUnit').textContent=unit.split('(')[0].trim();
  document.getElementById('slipDob').textContent=dob||'—';
  document.getElementById('slipGender').textContent=gender;
  document.getElementById('slipParent').textContent=parent||'—';
  document.getElementById('slipPhone').textContent=phone||'—';
  document.getElementById('slipDate').textContent=dateStr;
  document.getElementById('admissionForm').classList.add('hidden');
  document.getElementById('admissionSlip').classList.remove('hidden');

  const app={appNo:appNo, name:fullName, unit:unit, date:dateStr, status:'pending'};
  submittedApplications.push(app); saveSubmittedApplications(); addApplicationToTable(app);
}

function newApplication(){
  document.getElementById('admissionForm').classList.remove('hidden');
  document.getElementById('admissionSlip').classList.add('hidden');
}

function checkResults(){
  const id=document.getElementById('resId').value.trim();
  if(!id){ alert('Please enter admission number.'); return; }
  document.getElementById('resultCard').classList.remove('hidden');
  document.getElementById('resultCard').scrollIntoView({behavior:'smooth'});
}

function escapeHtml(val){ return String(val).replace(/[&<>"']/g, ch=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[ch])); }

function addStaffMember(){
  const name=document.getElementById('staffName').value.trim();
  const role=document.getElementById('staffRole').value;
  const unit=document.getElementById('staffUnit').value;
  const subject=document.getElementById('staffSubject').value.trim()||'General';
  if(!name||!role||!unit){ alert('Fill required fields.'); return; }
  staffCounter++;
  const staffId='PAA-ST-'+String(staffCounter).padStart(3,'0');
  const approvalCode=generateApprovalCode();
  const tbody=document.getElementById('staffTableBody');
  const row=document.createElement('tr');
  row.innerHTML='<td>'+staffId+'</td><td>'+escapeHtml(name)+'</td><td>'+escapeHtml(role)+'</td><td>'+escapeHtml(unit)+'</td><td>'+escapeHtml(subject)+'</td><td><span class="badge badge-green">Approved</span></td>';
  tbody.prepend(row);
  registerGeneratedPortalUser({ username:staffId, approvalCode:approvalCode, role:'staff', userType:'staff', name:name, roleLabel:role, unit:unit });
  closeAddStaffModal();
  showCredentialsModal(staffId, approvalCode, name, unit, role, 'Approval Code');
}

function approveApplication(appNo, name, unit){
  const approvalCode = generateApprovalCode();
  const rows = document.querySelectorAll('#ds-admissions table tbody tr');
  for(let r of rows){
    const cell = r.querySelector('td');
    if(cell && cell.textContent.trim() === appNo){
      const statusSpan = r.querySelector('td:nth-child(5) span');
      if(statusSpan){ statusSpan.className = 'badge badge-green'; statusSpan.textContent = 'Approved'; }
      const actionCell = r.querySelector('td:nth-child(6)');
      if(actionCell){ actionCell.innerHTML = '<span style="font-weight:700;color:var(--navy)">Approved</span>'; }
      break;
    }
  }
  const savedApp = submittedApplications.find(a => a.appNo === appNo);
  if(savedApp){ savedApp.status = 'approved'; saveSubmittedApplications(); }
  registerGeneratedPortalUser({ username:appNo, approvalCode:approvalCode, role:'student', userType:'student', name:name, roleLabel:'Student', unit:unit, defaultSection:'results' });
  showCredentialsModal(appNo, approvalCode, name, unit, 'Student', 'Approval Code');
}

function showCredentialsModal(username, password, name, unit, roleLabel, secretLabel='Approval Code'){
  document.getElementById('credSecretLabel').textContent = secretLabel;
  document.getElementById('credUsername').textContent = username;
  document.getElementById('credPassword').textContent = password;
  document.getElementById('credName').textContent = name;
  document.getElementById('credRole').textContent = roleLabel + ' / ' + unit;
  document.getElementById('credModal').classList.add('open');
}

function copyCred(id){
  const text = document.getElementById(id).textContent || '';
  navigator.clipboard.writeText(text).then(()=>{ alert('Copied to clipboard'); }, ()=>{ alert('Unable to copy'); });
}

renderSavedApplications();
</script>
</body>
</html>
