<?php
/**
 * Template Name: Privacy Policy EN
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Privacy Policy — Escapii</title>
  <meta name="robots" content="noindex, follow">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
  <?php wp_head(); ?>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --navy:    #EFE9E7;
  --navy2:   #FFFFFF;
  --navy3:   #F5F3F1;
  --accent:  #CA8A71;
  --white:   #2D5F6B;
  --gray:    #7A9FA8;
  --gray2:   #7A9FA8;
  --border:  rgba(15,45,53,.08);
}

body {
  font-family: 'Inter', sans-serif;
  background: var(--navy);
  color: var(--white);
  min-height: 100vh;
  line-height: 1.7;
}

/* ── Header ── */
.pp-header {
  background: rgba(15,45,53,.95);
  border-bottom: 1px solid var(--border);
  padding: 18px 0;
  position: sticky;
  top: 0;
  z-index: 100;
  backdrop-filter: blur(12px);
}
.pp-header-inner {
  max-width: 900px;
  margin: 0 auto;
  padding: 0 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.pp-logo {
  text-decoration: none;
  display: inline-flex; align-items: center;
}
.pp-logo img { height: 42px; width: auto; display: block; }
.pp-back {
  font-size: 13px;
  color: rgba(255,255,255,.75);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: color .2s;
  cursor: pointer;
  padding: 8px 12px;
  border-radius: 8px;
  background: rgba(255,255,255,.07);
  border: 1px solid rgba(255,255,255,.12);
}
.pp-back:hover { color: #fff; background: rgba(255,255,255,.12); }

/* ── Hero ── */
.pp-hero {
  background: linear-gradient(135deg, rgba(202,138,113,.08) 0%, transparent 60%),
              var(--navy2);
  border-bottom: 1px solid var(--border);
  padding: 56px 24px 48px;
  text-align: center;
}
.pp-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(202,138,113,.12);
  border: 1px solid rgba(202,138,113,.25);
  border-radius: 100px;
  padding: 5px 14px;
  font-size: 12px;
  font-weight: 600;
  color: var(--accent);
  letter-spacing: .04em;
  text-transform: uppercase;
  margin-bottom: 20px;
}
.pp-hero h1 {
  font-size: clamp(26px, 5vw, 38px);
  font-weight: 800;
  letter-spacing: -1px;
  margin-bottom: 12px;
}
.pp-hero p {
  font-size: 15px;
  color: var(--gray);
  max-width: 520px;
  margin: 0 auto 20px;
}
.pp-updated {
  font-size: 12px;
  color: var(--gray2);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

/* ── Layout ── */
.pp-layout {
  max-width: 900px;
  margin: 0 auto;
  padding: 48px 24px 80px;
  display: grid;
  grid-template-columns: 220px 1fr;
  gap: 48px;
  align-items: start;
}
@media (max-width: 720px) {
  .pp-layout { grid-template-columns: 1fr; gap: 32px; }
  .pp-toc { position: static !important; }
}

/* ── Table of Contents ── */
.pp-toc {
  position: sticky;
  top: 80px;
  background: rgba(255,255,255,.03);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 20px;
}
.pp-toc-title {
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: var(--gray2);
  margin-bottom: 14px;
}
.pp-toc ul {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.pp-toc ul li a {
  display: block;
  font-size: 13px;
  color: var(--gray);
  text-decoration: none;
  padding: 6px 10px;
  border-radius: 8px;
  transition: all .2s;
  line-height: 1.4;
}
.pp-toc ul li a:hover {
  background: rgba(202,138,113,.1);
  color: var(--accent);
}

/* ── Content ── */
.pp-content { min-width: 0; }

.pp-section {
  margin-bottom: 52px;
  scroll-margin-top: 100px;
}
.pp-section-header {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 20px;
  padding-bottom: 16px;
  border-bottom: 1px solid var(--border);
}
.pp-section-icon {
  width: 38px;
  height: 38px;
  border-radius: 10px;
  background: rgba(202,138,113,.12);
  border: 1px solid rgba(202,138,113,.2);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  color: var(--accent);
}
.pp-section-icon svg { width: 18px; height: 18px; }
.pp-section h2 { font-size: 18px; font-weight: 700; letter-spacing: -.3px; color: var(--white); }
.pp-section p { font-size: 14.5px; color: rgba(45,95,107,.85); margin-bottom: 14px; line-height: 1.75; }
.pp-section p:last-child { margin-bottom: 0; }
.pp-section h3 { font-size: 14px; font-weight: 600; color: var(--white); margin: 20px 0 10px; }

/* ── Table ── */
.pp-table-wrap {
  overflow-x: auto;
  border-radius: 12px;
  border: 1px solid var(--border);
  margin: 16px 0;
}
.pp-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
.pp-table thead { background: rgba(202,138,113,.08); }
.pp-table th {
  text-align: left;
  padding: 12px 16px;
  font-weight: 600;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: .04em;
  color: var(--accent);
  border-bottom: 1px solid var(--border);
}
.pp-table td {
  padding: 12px 16px;
  color: rgba(45,95,107,.85);
  border-bottom: 1px solid rgba(15,45,53,.05);
  vertical-align: top;
}
.pp-table tr:last-child td { border-bottom: none; }
.pp-table tr:hover td { background: rgba(202,138,113,.03); }
.pp-table td:first-child { color: var(--white); font-weight: 500; }

/* ── List ── */
.pp-list {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin: 12px 0;
}
.pp-list li {
  font-size: 14.5px;
  color: rgba(45,95,107,.85);
  position: relative;
  padding-left: 16px;
  line-height: 1.6;
}
.pp-list li::before {
  content: '';
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--accent);
  position: absolute;
  left: 0;
  top: 9px;
}
.pp-list li strong { color: var(--white); }

/* ── Rights grid ── */
.pp-rights {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 12px;
  margin: 16px 0;
}
.pp-right-card {
  background: rgba(255,255,255,.03);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 16px;
  transition: border-color .2s;
}
.pp-right-card:hover { border-color: rgba(202,138,113,.3); }
.pp-right-card-title { font-size: 13px; font-weight: 600; color: var(--white); margin-bottom: 5px; }
.pp-right-card-desc { font-size: 12.5px; color: var(--gray); line-height: 1.5; }

/* ── Notice box ── */
.pp-notice {
  background: rgba(202,138,113,.07);
  border: 1px solid rgba(202,138,113,.2);
  border-radius: 12px;
  padding: 16px 18px;
  display: flex;
  gap: 12px;
  align-items: flex-start;
  margin: 16px 0;
}
.pp-notice-icon { color: var(--accent); flex-shrink: 0; margin-top: 1px; }
.pp-notice-text { font-size: 13.5px; color: rgba(45,95,107,.9); line-height: 1.6; }
.pp-notice-text strong { color: var(--white); }
.pp-notice-text a { color: var(--accent); text-decoration: none; }
.pp-notice-text a:hover { text-decoration: underline; }

/* ── Not-collected box ── */
.pp-not-collected {
  background: rgba(34,197,94,.05);
  border: 1px solid rgba(34,197,94,.15);
  border-radius: 12px;
  padding: 16px 18px;
  margin: 16px 0;
}
.pp-not-collected-title {
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .05em;
  color: #22c55e;
  margin-bottom: 10px;
}
.pp-not-collected ul { list-style: none; display: flex; flex-direction: column; gap: 6px; }
.pp-not-collected ul li {
  font-size: 13.5px;
  color: rgba(45,95,107,.8);
  display: flex;
  align-items: center;
  gap: 8px;
}
.pp-not-collected ul li::before { content: '✓'; color: #22c55e; font-weight: 700; font-size: 12px; }

/* ── Contact ── */
.pp-contact {
  background: rgba(255,255,255,.03);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 28px;
  text-align: center;
  margin-top: 16px;
}
.pp-contact h3 { font-size: 16px; font-weight: 700; margin-bottom: 8px; }
.pp-contact p { font-size: 13.5px; color: var(--gray); margin-bottom: 18px; }
.pp-contact-links { display: flex; justify-content: center; gap: 12px; flex-wrap: wrap; }
.pp-contact-link {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(202,138,113,.1);
  border: 1px solid rgba(202,138,113,.25);
  border-radius: 100px;
  padding: 8px 18px;
  font-size: 13px;
  font-weight: 500;
  color: var(--accent);
  text-decoration: none;
  transition: all .2s;
}
.pp-contact-link:hover { background: rgba(202,138,113,.2); border-color: var(--accent); }

/* ── Footer ── */
.pp-footer {
  border-top: 1px solid var(--border);
  padding: 24px;
  text-align: center;
  font-size: 12px;
  color: var(--gray2);
}
.pp-footer a { color: var(--gray); text-decoration: none; }
.pp-footer a:hover { color: var(--white); }

/* ── Lang toggle ── */
.pp-lang-wrap { display: flex; background: rgba(255,255,255,.1); border-radius: 8px; overflow: hidden; }
.pp-lang-btn {
  padding: 6px 14px; font-size: 12px; font-weight: 700; cursor: pointer;
  border: none; background: transparent; color: rgba(255,255,255,.5);
  letter-spacing: .5px; transition: all .2s; text-decoration: none;
  display: inline-flex; align-items: center;
}
.pp-lang-btn.on { background: #CA8A71; color: #fff; }
.pp-lang-btn:hover:not(.on) { color: rgba(255,255,255,.85); }
</style>
</head>
<body>

<!-- Header -->
<header class="pp-header">
  <div class="pp-header-inner">
    <a href="<?php echo home_url('/'); ?>" class="pp-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Escapii"></a>
    <div style="display:flex;align-items:center;gap:16px;">
      <div class="pp-lang-wrap">
        <a href="<?php echo home_url('/politika-privatnosti'); ?>" class="pp-lang-btn">SR</a>
        <span class="pp-lang-btn on">EN</span>
      </div>
      <a href="/" class="pp-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Back to site
      </a>
    </div>
  </div>
</header>

<!-- Hero -->
<div class="pp-hero">
  <div class="pp-hero-badge">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
    Legal document
  </div>
  <h1>Privacy Policy</h1>
  <p>We transparently explain what data we collect, why we collect it, and how we protect it.</p>
  <div class="pp-updated">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
    Last updated: May 2026
  </div>
</div>

<!-- Main layout -->
<div class="pp-layout">

  <!-- TOC Sidebar -->
  <nav class="pp-toc">
    <div class="pp-toc-title">Contents</div>
    <ul>
      <li><a href="#who-we-are">Who we are</a></li>
      <li><a href="#what-data">What data we collect</a></li>
      <li><a href="#why">Why we process your data</a></li>
      <li><a href="#access">Who has access</a></li>
      <li><a href="#retention">How long we keep data</a></li>
      <li><a href="#rights">Your rights</a></li>
      <li><a href="#security">Security</a></li>
      <li><a href="#cookies">Cookies</a></li>
      <li><a href="#changes">Policy changes</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>

  <!-- Content -->
  <main class="pp-content">

    <!-- Who we are -->
    <section class="pp-section" id="who-we-are">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </div>
        <h2>Who we are</h2>
      </div>
      <p><strong>Escapii</strong> is a digital platform for organising surprise trips from Serbia. We are not a travel agency — we act as a <strong>sub-agent</strong> of a licensed travel agency and facilitate the creation of travel packages.</p>
      <p>For any questions regarding the processing of your personal data, please contact us at <strong>escapii.team@gmail.com</strong>.</p>
    </section>

    <!-- What data -->
    <section class="pp-section" id="what-data">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <h2>What data we collect</h2>
      </div>

      <h3>Data you provide directly</h3>
      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Data</th><th>Purpose</th></tr>
          </thead>
          <tbody>
            <tr><td>Full name</td><td>Identification and communication</td></tr>
            <tr><td>Email address</td><td>Sending confirmations and travel information</td></tr>
            <tr><td>Phone number</td><td>Emergency communication regarding the trip</td></tr>
            <tr><td>Departure and return dates</td><td>Trip organisation</td></tr>
            <tr><td>Departure airport</td><td>Finding suitable flights</td></tr>
            <tr><td>Number of travellers</td><td>Capacity reservation</td></tr>
            <tr><td>Accommodation type</td><td>Accommodation arrangement</td></tr>
            <tr><td>Excluded destinations</td><td>Personalising the surprise to your preferences</td></tr>
            <tr><td>Preferences (breakfast, seats, luggage, insurance)</td><td>Offer personalisation</td></tr>
            <tr><td>Passenger data (name, gender, date of birth)</td><td>Flight and accommodation booking with the partner agency</td></tr>
            <tr><td>Visa information</td><td>Adapting the destination to the visa status of travellers</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Data we collect automatically</h3>
      <ul class="pp-list">
        <li><strong>IP address</strong> — solely to prevent abuse (we rate-limit requests per IP); stored for 24 hours</li>
        <li><strong>Date and time of submission</strong> — for booking records</li>
      </ul>

      <h3>What we do NOT collect</h3>
      <div class="pp-not-collected">
        <div class="pp-not-collected-title">We do not collect</div>
        <ul>
          <li>Payment card details — payments are made by bank transfer</li>
          <li>Passport or ID document details</li>
          <li>Tracking or profiling cookies</li>
        </ul>
      </div>
    </section>

    <!-- Why -->
    <section class="pp-section" id="why">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <h2>Why we process your data</h2>
      </div>
      <p>We use your data solely for:</p>
      <ul class="pp-list">
        <li><strong>Processing your travel enquiry</strong> — without this data we cannot organise your trip</li>
        <li><strong>Sending an enquiry confirmation to your email</strong> — automatically, immediately upon receipt</li>
        <li><strong>Booking-related communication</strong> — sending payment instructions, booking confirmation, and notifications of any changes or cancellations</li>
        <li><strong>Waitlist notifications</strong> — if you signed up to be notified about new dates for a particular airport</li>
      </ul>
      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>Legal basis:</strong> Performance of a contract (Art. 6(1)(b) GDPR) and your consent (Art. 6(1)(a) GDPR) for communications and waitlist.
        </div>
      </div>
    </section>

    <!-- Access -->
    <section class="pp-section" id="access">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h2>Who has access to your data</h2>
      </div>

      <h3>Within Escapii</h3>
      <p>Only the people directly involved in organising your trip have access to your personal data.</p>

      <h3>Third parties</h3>
      <p>We share your data with the following categories of recipients, strictly to the extent necessary to organise your trip:</p>
      <ul class="pp-list">
        <li><strong>Partner travel agency</strong> — receives the data required to book your flight and accommodation (full names of travellers, airport, dates, number of travellers, accommodation type), solely for the purpose of fulfilling the travel package</li>
        <li><strong>Airlines and hotels</strong> — for booking purposes, through the partner agency</li>
        <li><strong>Insurance companies</strong> — only if you selected travel insurance</li>
        <li><strong>Google (Gmail)</strong> — emails we send pass through Google infrastructure</li>
      </ul>
      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">We do not sell your data to third parties. We do not share data for marketing purposes.</div>
      </div>
    </section>

    <!-- Retention -->
    <section class="pp-section" id="retention">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h2>How long we keep your data</h2>
      </div>
      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Type of data</th><th>Retention period</th></tr>
          </thead>
          <tbody>
            <tr><td>Booking data</td><td>3 years from the date of travel (statutory requirement for business records)</td></tr>
            <tr><td>Waitlist email</td><td>Until notification is sent or until you request deletion</td></tr>
            <tr><td>IP addresses (rate limiting)</td><td>24 hours</td></tr>
            <tr><td>Email correspondence</td><td>2 years</td></tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Rights -->
    <section class="pp-section" id="rights">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2>Your rights</h2>
      </div>
      <p>Under GDPR (EU) 2016/679, you have the following rights:</p>
      <div class="pp-rights">
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right of access</div>
          <div class="pp-right-card-desc">You can request a copy of all data we hold about you</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right to rectification</div>
          <div class="pp-right-card-desc">You can request correction of inaccurate or incomplete data</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right to erasure</div>
          <div class="pp-right-card-desc">You can request deletion of your data, except where we are legally required to retain it</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right to restriction</div>
          <div class="pp-right-card-desc">You can request that we temporarily stop processing your data</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right to object</div>
          <div class="pp-right-card-desc">You can object to processing in certain circumstances</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right to portability</div>
          <div class="pp-right-card-desc">You can request your data in a machine-readable format</div>
        </div>
      </div>
      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>How to exercise your rights:</strong> Send an email to <a href="mailto:escapii.team@gmail.com">escapii.team@gmail.com</a> with the subject "Data Protection Request". We will respond within 30 days.<br><br>
          If you believe your rights have not been respected, you may lodge a complaint with your local supervisory authority. For residents of Serbia: <a href="https://www.poverenik.rs" target="_blank" rel="noopener">Commissioner for Information of Public Importance and Personal Data Protection</a>.
        </div>
      </div>
    </section>

    <!-- Security -->
    <section class="pp-section" id="security">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h2>Data security</h2>
      </div>
      <ul class="pp-list">
        <li><strong>HTTPS encryption</strong> — all communication between your browser and our service is encrypted</li>
        <li><strong>Restricted access</strong> — only authorised personnel have access to personal data</li>
        <li><strong>Rate limiting</strong> — automatic protection against bulk attacks and API abuse</li>
        <li><strong>Secured admin access</strong> — the admin panel is accessible only to authenticated users</li>
      </ul>
    </section>

    <!-- Cookies -->
    <section class="pp-section" id="cookies">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/></svg>
        </div>
        <h2>Cookies</h2>
      </div>
      <p>We use only essential technical cookies required for the site to function (e.g. WordPress session cookies for the admin panel). We do not use cookies for tracking, profiling, or targeted advertising.</p>
      <p>If we add analytics in the future (e.g. Google Analytics 4), we will update this policy and display a consent banner in accordance with GDPR requirements.</p>
    </section>

    <!-- Changes -->
    <section class="pp-section" id="changes">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <h2>Policy changes</h2>
      </div>
      <p>We may update this policy to reflect changes in our practices or legal obligations. The date of the last update is always shown at the top of this page.</p>
      <p>For significant changes that affect your rights, we will notify you by email if we have your address.</p>
    </section>

    <!-- Contact -->
    <section class="pp-section" id="contact">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </div>
        <h2>Contact</h2>
      </div>
      <div class="pp-contact">
        <h3>Have a privacy question?</h3>
        <p>Feel free to reach out — we respond within 48 hours.</p>
        <div class="pp-contact-links">
          <a href="mailto:escapii.team@gmail.com" class="pp-contact-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            escapii.team@gmail.com
          </a>
          <a href="<?php echo home_url('/'); ?>" class="pp-contact-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            escapii.rs
          </a>
        </div>
      </div>
    </section>

  </main>
</div>

<!-- Footer -->
<footer class="pp-footer">
  <p>
    © <?php echo date('Y'); ?> Escapii · Republic of Serbia ·
    <a href="<?php echo home_url('/terms-of-use'); ?>">Terms of Use</a> ·
    Compiled in accordance with the Personal Data Protection Act (Official Gazette RS, No. 87/2018) and GDPR (EU) 2016/679
  </p>
</footer>

<?php wp_footer(); ?>
</body>
</html>
