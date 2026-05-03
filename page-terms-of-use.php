<?php
/**
 * Template Name: Terms of Use EN
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terms of Use — Escapii</title>
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
.pp-logo { text-decoration: none; display: inline-flex; align-items: center; }
.pp-logo img { height: 42px; width: auto; display: block; }
.pp-back {
  font-size: 13px;
  color: var(--gray);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: color .2s;
}
.pp-back:hover { color: var(--white); }

.pp-hero {
  background: linear-gradient(135deg, rgba(202,138,113,.08) 0%, transparent 60%), var(--navy2);
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
.pp-hero p { font-size: 15px; color: var(--gray); max-width: 520px; margin: 0 auto 20px; }
.pp-updated {
  font-size: 12px;
  color: var(--gray2);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

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
.pp-toc ul { list-style: none; display: flex; flex-direction: column; gap: 2px; }
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
.pp-toc ul li a:hover { background: rgba(202,138,113,.1); color: var(--accent); }

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
  display: flex;
  align-items: flex-start;
  gap: 10px;
  line-height: 1.6;
}
.pp-list li::before {
  content: '';
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--accent);
  flex-shrink: 0;
  margin-top: 8px;
}
.pp-list li strong { color: var(--white); }

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

.pp-warning {
  background: rgba(239,68,68,.05);
  border: 1px solid rgba(239,68,68,.18);
  border-radius: 12px;
  padding: 16px 18px;
  display: flex;
  gap: 12px;
  align-items: flex-start;
  margin: 16px 0;
}
.pp-warning-icon { color: #ef4444; flex-shrink: 0; margin-top: 1px; }
.pp-warning-text { font-size: 13.5px; color: rgba(45,95,107,.9); line-height: 1.6; }
.pp-warning-text strong { color: #dc2626; }

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

.pp-bta-card {
  background: rgba(202,138,113,.06);
  border: 1px solid rgba(202,138,113,.2);
  border-radius: 14px;
  padding: 22px 24px;
  margin: 16px 0;
  display: flex;
  gap: 16px;
  align-items: flex-start;
}
.pp-bta-badge {
  background: var(--accent);
  color: #fff;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .06em;
  text-transform: uppercase;
  border-radius: 6px;
  padding: 4px 10px;
  white-space: nowrap;
  margin-top: 2px;
}
.pp-bta-body p { font-size: 14px; color: rgba(45,95,107,.85); margin-bottom: 8px; line-height: 1.65; }
.pp-bta-body p:last-child { margin-bottom: 0; }
.pp-bta-body a { color: var(--accent); text-decoration: none; }
.pp-bta-body a:hover { text-decoration: underline; }

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
        <a href="<?php echo home_url('/uslovi-koriscenja'); ?>" class="pp-lang-btn">SR</a>
        <span class="pp-lang-btn on">EN</span>
      </div>
      <a href="<?php echo home_url('/'); ?>" class="pp-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Back to site
      </a>
    </div>
  </div>
</header>

<!-- Hero -->
<div class="pp-hero">
  <div class="pp-hero-badge">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    Legal document
  </div>
  <h1>Terms of Use</h1>
  <p>Please read these terms before submitting an enquiry — by using the platform you accept these rules.</p>
  <div class="pp-updated">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
    Last updated: May 2026
  </div>
</div>

<!-- Main layout -->
<div class="pp-layout">

  <!-- TOC -->
  <nav class="pp-toc">
    <div class="pp-toc-title">Contents</div>
    <ul>
      <li><a href="#who-we-are">Who we are</a></li>
      <li><a href="#how-it-works">How Escapii works</a></li>
      <li><a href="#booking-process">Booking process</a></li>
      <li><a href="#prices-payment">Prices &amp; payment</a></li>
      <li><a href="#traveller-obligations">Traveller obligations</a></li>
      <li><a href="#cancellation">Cancellation &amp; changes</a></li>
      <li><a href="#liability">Limitation of liability</a></li>
      <li><a href="#visa-documents">Visa &amp; documents</a></li>
      <li><a href="#disputes">Dispute resolution</a></li>
      <li><a href="#changes-to-terms">Changes to terms</a></li>
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
        <h2>Who we are and what we do</h2>
      </div>

      <p><strong>Escapii</strong> is a digital platform for organising surprise trips. We provide an intermediary service for arranging travel packages — the traveller selects an airport, dates, number of passengers, and preferences, and we work with our partner agency to find and organise the trip.</p>

      <div class="pp-warning">
        <div class="pp-warning-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="pp-warning-text">
          <strong>Important:</strong> Escapii <strong>is not a travel agency</strong> and does not hold a licence to operate as a travel organiser. Escapii is a digital intermediary that coordinates your request with a licensed travel organiser.
        </div>
      </div>

      <div class="pp-bta-card">
        <div class="pp-bta-badge">Partner agency</div>
        <div class="pp-bta-body">
          <p>All travel packages booked through the Escapii platform are operated in partnership with:</p>
          <p>
            <strong>BTA — Tourist Agency BTA</strong><br>
            Takovska 6, Belgrade, Republic of Serbia<br>
            <a href="https://www.bta.co.rs" target="_blank" rel="noopener">www.bta.co.rs</a> · <a href="mailto:office@bta.co.rs">office@bta.co.rs</a>
          </p>
          <p>Escapii acts as a <strong>sub-agent</strong> of BTA. BTA is the licensed travel organiser and is fully responsible for executing the travel package in accordance with applicable Serbian tourism law. BTA's General Terms and Conditions of Travel apply to every booking.</p>
        </div>
      </div>
    </section>

    <!-- How it works -->
    <section class="pp-section" id="how-it-works">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <h2>How Escapii works</h2>
      </div>

      <p>Escapii is a platform for <strong>surprise trips</strong> — the traveller does not choose the destination, but instead selects a departure airport, travel period, and personal preferences. The destination is kept secret until the reveal email is sent <strong>72 hours before departure</strong>.</p>

      <h3>The surprise concept</h3>
      <ul class="pp-list">
        <li><strong>The traveller chooses:</strong> airport, dates, number of passengers, accommodation type, add-ons (insurance, breakfast, seats together, cabin bag) and up to 5 destinations to exclude</li>
        <li><strong>Escapii and BTA select the destination</strong> from available flights that are not excluded</li>
        <li><strong>The destination is revealed</strong> to the traveller via email 72 hours before departure</li>
        <li>By submitting an enquiry, the traveller <strong>accepts the surprise as an inherent part of the service</strong> and may not request a change of destination after the booking is confirmed</li>
      </ul>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          By excluding destinations via the platform, the traveller can narrow the pool of possible destinations, but Escapii does not guarantee travel to any specific destination, nor does it exclude every location the traveller might not prefer.
        </div>
      </div>
    </section>

    <!-- Booking process -->
    <section class="pp-section" id="booking-process">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <h2>Booking process</h2>
      </div>

      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Step</th><th>Description</th></tr>
          </thead>
          <tbody>
            <tr><td>1. Enquiry</td><td>The traveller fills in the form on the website and submits an enquiry. An automatic confirmation is sent to their email.</td></tr>
            <tr><td>2. Review</td><td>The Escapii team and agency BTA check availability and pricing. The enquiry is not binding on the traveller until a confirmation and payment have been received.</td></tr>
            <tr><td>3. Confirmation &amp; payment</td><td>The traveller receives an email with booking details and payment instructions. The booking is considered finalised only upon receipt of payment.</td></tr>
            <tr><td>4. Reveal</td><td>72 hours before departure, the traveller receives an email with the destination, a weather forecast link, and all relevant information.</td></tr>
          </tbody>
        </table>
      </div>

      <p>Submitting an enquiry does <strong>not constitute a contract</strong> or create any financial obligation. The contractual relationship arises <strong>only upon payment of the deposit</strong> following a written booking confirmation.</p>
    </section>

    <!-- Prices & payment -->
    <section class="pp-section" id="prices-payment">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <h2>Prices &amp; payment</h2>
      </div>

      <p>Prices shown on the platform during the enquiry process are <strong>indicative and for information purposes only</strong>. The exact price is determined at the time of availability check and is sent to the traveller in the booking confirmation, before any payment is made.</p>

      <h3>Price structure</h3>
      <ul class="pp-list">
        <li>Base package price per person (flight + accommodation)</li>
        <li>Accommodation upgrade supplement (Superior or Premium, where applicable)</li>
        <li>Traveller-selected add-ons: travel insurance, breakfast, seats together, cabin bag</li>
        <li>Destination exclusion fee (2nd and 3rd exclusion +€10 each, 4th and 5th +€15 each — 1st exclusion is free)</li>
      </ul>

      <h3>Payment method</h3>
      <p>Payment is made exclusively by <strong>bank transfer</strong> as per the instructions provided in the booking confirmation. Escapii does not collect payment card details.</p>

      <h3>Price adjustment</h3>
      <p>In exceptional circumstances (significant changes in fuel costs, exchange rates, or taxes), the package price may be revised before payment is finalised. In such a case, the traveller will be notified in writing and may withdraw without any penalty.</p>
    </section>

    <!-- Traveller obligations -->
    <section class="pp-section" id="traveller-obligations">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <h2>Traveller obligations</h2>
      </div>

      <p>The traveller is responsible for the accuracy and completeness of all information provided. Incorrect information may result in the inability to execute the trip or additional costs borne solely by the traveller.</p>

      <h3>The traveller is required to:</h3>
      <ul class="pp-list">
        <li>Provide the <strong>exact full name of each traveller</strong> as it appears on the travel document to be used for the trip</li>
        <li>Provide the <strong>correct date of birth</strong> of each traveller</li>
        <li>Check the <strong>expiry date of the travel document</strong> — the passport must be valid for at least 6 months after the return date</li>
        <li>Hold a <strong>valid visa</strong> or right of entry for the destination; since the destination is a surprise, the traveller is responsible for verifying visa requirements for all realistically possible destinations, or for accepting responsibility for any resulting issues</li>
        <li>Pay the deposit and remaining balance by the agreed deadlines</li>
        <li>Arrive at the airport within the time required by the airline (at least 2 hours before departure for European flights)</li>
      </ul>

      <div class="pp-warning">
        <div class="pp-warning-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="pp-warning-text">
          <strong>Visa risk and the surprise concept:</strong> As the destination remains secret until 72 hours before departure, travellers who do not have visa-free access to all destinations within the selected programme should inform us before confirming the booking, or exclude destinations for which they are unsure. Escapii and BTA are not liable for consequences arising from a lack of the necessary travel documents.
        </div>
      </div>
    </section>

    <!-- Cancellation -->
    <section class="pp-section" id="cancellation">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
        </div>
        <h2>Cancellation &amp; changes</h2>
      </div>

      <p>Cancellations and changes to bookings are governed by <strong>BTA's General Terms and Conditions of Travel</strong>. The table below is a general overview — exact conditions are available from BTA (<a href="mailto:office@bta.co.rs" style="color:var(--accent);text-decoration:none;">office@bta.co.rs</a>) or the Escapii team.</p>

      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Period before departure</th><th>Cancellation fee</th></tr>
          </thead>
          <tbody>
            <tr><td>Before payment of deposit</td><td>No charge — the enquiry is non-binding</td></tr>
            <tr><td>After deposit payment, more than 30 days before departure</td><td>Deposit retained (per BTA terms)</td></tr>
            <tr><td>15–30 days before departure</td><td>Portion of total price (per BTA terms)</td></tr>
            <tr><td>Fewer than 15 days before departure</td><td>Full amount may be retained</td></tr>
          </tbody>
        </table>
      </div>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>Recommendation:</strong> If there is a chance you may need to cancel, we strongly recommend purchasing <strong>travel insurance with cancellation cover</strong>, which is available as an add-on during the booking process.
        </div>
      </div>

      <h3>Changes to a confirmed booking</h3>
      <p>Changes to a confirmed booking (number of travellers, dates, accommodation type) are possible only with the written agreement of both the Escapii team and BTA, and may be subject to an administrative fee. <strong>The destination cannot be changed</strong> — it is determined at the time of booking confirmation and cannot be altered afterwards.</p>

      <h3>Cancellation by Escapii / BTA</h3>
      <p>If the travel organiser (BTA) cancels the trip for reasons not attributable to the traveller, the traveller will receive a full refund of all amounts paid, or an alternative package of equivalent value.</p>
    </section>

    <!-- Liability -->
    <section class="pp-section" id="liability">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2>Limitation of liability</h2>
      </div>

      <h3>Escapii's liability</h3>
      <p>Escapii is liable solely for the proper functioning of the digital platform — collecting enquiries, passing information to BTA, and communicating with the traveller. Escapii is not liable for:</p>
      <ul class="pp-list">
        <li>Execution of the travel package — this is the responsibility of BTA</li>
        <li>The quality of flights, accommodation, or ancillary services</li>
        <li>Flight delays, cancellations, or changes by airlines</li>
        <li>Force majeure events (natural disasters, epidemics, armed conflicts, strikes)</li>
        <li>Consequences of incorrect information provided by the traveller</li>
        <li>Denial of entry due to missing documents or a visa</li>
      </ul>

      <h3>Traveller's liability</h3>
      <p>The traveller is financially responsible for all costs arising from inaccurate or incomplete information provided when submitting the enquiry, and for the consequences of missing payment deadlines.</p>

      <h3>Force majeure</h3>
      <p>Neither Escapii nor BTA is liable for failure to fulfil obligations caused by circumstances beyond their reasonable control (force majeure), including but not limited to: natural disasters, epidemics, armed conflicts, and government travel bans.</p>
    </section>

    <!-- Visa & documents -->
    <section class="pp-section" id="visa-documents">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
        <h2>Visa &amp; travel documents</h2>
      </div>

      <p>The traveller is <strong>solely responsible</strong> for obtaining all required travel documents, visas, and health certificates for the destination. Escapii and BTA may provide informational support, but final responsibility lies with the traveller.</p>

      <h3>Minimum requirements</h3>
      <ul class="pp-list">
        <li>The <strong>passport</strong> must be valid for at least 6 months after the return date</li>
        <li>Travellers holding a Serbian passport should check visa requirements for all potential destinations within the available programme</li>
        <li>Children must hold their own travel document</li>
      </ul>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          Up-to-date information on visa requirements for Serbian passport holders is available from the <a href="https://www.mfa.gov.rs" target="_blank" rel="noopener">Ministry of Foreign Affairs of the Republic of Serbia</a>.
        </div>
      </div>
    </section>

    <!-- Disputes -->
    <section class="pp-section" id="disputes">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
        </div>
        <h2>Dispute resolution</h2>
      </div>

      <p>Contracts concluded through the Escapii platform are governed by the law of the <strong>Republic of Serbia</strong>. The courts of Belgrade have exclusive jurisdiction over any disputes.</p>

      <h3>Complaints</h3>
      <p>A traveller who is dissatisfied with the execution of a trip may submit a written complaint to:</p>
      <ul class="pp-list">
        <li><strong>Escapii</strong> — by email to <a href="mailto:escapii.team@gmail.com" style="color:var(--accent);text-decoration:none;">escapii.team@gmail.com</a></li>
        <li><strong>BTA</strong> — by email to <a href="mailto:office@bta.co.rs" style="color:var(--accent);text-decoration:none;">office@bta.co.rs</a></li>
      </ul>
      <p>Complaints must be submitted within <strong>8 days of returning</strong> from the trip. The organiser is required to respond within 8 working days of receiving the complaint.</p>

      <h3>Consumer protection</h3>
      <p>For consumer rights protection you may contact the <strong>National Organisation of Consumers of Serbia (NOPS)</strong> or the relevant inspection authorities.</p>
    </section>

    <!-- Changes to terms -->
    <section class="pp-section" id="changes-to-terms">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <h2>Changes to these Terms</h2>
      </div>
      <p>Escapii reserves the right to amend these Terms of Use. The date of the last amendment is always indicated at the top of this document. Continued use of the platform after an amendment constitutes acceptance of the revised terms.</p>
      <p>For material changes that affect users' rights, we will endeavour to notify registered users by email.</p>
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
        <h3>Have a question?</h3>
        <p>The Escapii team is here for you — we respond within 24 hours.</p>
        <div class="pp-contact-links">
          <a href="mailto:escapii.team@gmail.com" class="pp-contact-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            escapii.team@gmail.com
          </a>
          <a href="<?php echo home_url('/'); ?>" class="pp-contact-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            escapii.com
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
    <a href="<?php echo home_url('/privacy-policy'); ?>">Privacy Policy</a> ·
    Trips are operated in partnership with <a href="https://www.bta.co.rs" target="_blank" rel="noopener">BTA</a> ·
    Prepared in accordance with the Tourism Act (Official Gazette of RS, No. 17/2019) and the Consumer Protection Act (Official Gazette of RS, No. 88/2021)
  </p>
</footer>

<?php wp_footer(); ?>
</body>
</html>
