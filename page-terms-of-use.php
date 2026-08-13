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
  <title>Terms of Use - Escapii</title>
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
<?php wp_body_open(); ?>

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
  <p>Please read these terms before submitting an enquiry - by using the platform you accept these rules.</p>
  <div class="pp-updated">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
    Last updated: April 2026 · v2 (gift vouchers, private trips)
  </div>
</div>

<!-- Main layout -->
<div class="pp-layout">

  <!-- TOC -->
  <nav class="pp-toc">
    <div class="pp-toc-title">Contents</div>
    <ul>
      <li><a href="#section-1">1. About the service</a></li>
      <li><a href="#section-2">2. Acceptance of Terms</a></li>
      <li><a href="#section-3">3. How the service works</a></li>
      <li><a href="#section-4">4. Pricing and payment</a></li>
      <li><a href="#section-5">5. Cancellation and refunds</a></li>
      <li><a href="#section-6">6. Traveller responsibilities</a></li>
      <li><a href="#section-7">7. The surprise destination — special terms</a></li>
      <li><a href="#section-8">8. Limitation of liability</a></li>
      <li><a href="#section-9">9. Complaints</a></li>
      <li><a href="#section-10">10. Changes to terms</a></li>
      <li><a href="#section-11">11. Governing law</a></li>
      <li><a href="#section-12">12. Contact</a></li>
    </ul>
  </nav>

  <!-- Content -->
  <main class="pp-content">
    <!-- 1. About the service -->
    <section class="pp-section" id="section-1">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </div>
        <h2>1. About the service</h2>
      </div>

      <p>Escapii is a service for organizing <strong>surprise trips</strong> — you select an airport, travel dates, and preferences, and we choose your destination, which remains secret until departure.</p>
      <p>The service is provided by <strong>Escapii</strong> based in Serbia.</p>
      <p>📧 escapii.team@gmail.com<br>🌐 escapii.rs</p>
    </section>

    <!-- 2. Acceptance of Terms -->
    <section class="pp-section" id="section-2">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <h2>2. Acceptance of Terms</h2>
      </div>

      <p>By submitting an enquiry for a trip, you confirm that you have read and accepted these Terms of Use and our Privacy Policy. If you do not agree with these terms, please do not submit an enquiry.</p>
      <p>The service is only available to persons aged <strong>18 and above</strong>. Minors may only travel with the accompaniment and written consent of a parent or legal guardian who accepts these terms.</p>
    </section>

    <!-- 3. How the service works -->
    <section class="pp-section" id="section-3">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <h2>3. How the service works</h2>
      </div>

      <h3>Step 1 — Enquiry</h3>
      <p>You complete the form on the website: select your travel dates, departure airport, number of travellers, accommodation type, and any preferences (excluded destinations, breakfast, seat selection, travel insurance).</p>

      <h3>Step 2 — Enquiry confirmation</h3>
      <p>After submitting the form:</p>
      <ul class="pp-list">
        <li>You receive a <strong>booking reference number</strong> (e.g., <code>ESC-a1b2c3d4</code>)</li>
        <li>An email confirmation with your enquiry details is sent to you</li>
        <li>Our team checks availability and within <strong>24 hours</strong> sends payment details</li>
      </ul>

      <h3>Step 3 — Payment</h3>
      <p>Payment is made by <strong>bank transfer</strong> according to the details sent by email. Your booking is not confirmed until payment is received and verified.</p>

      <h3>Step 4 — Confirmed booking</h3>
      <p>Once payment is verified, your booking is official. The destination remains <strong>secret</strong> and is revealed at the airport on departure day.</p>
    </section>

    <!-- 4. Pricing and payment -->
    <section class="pp-section" id="section-4">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <h2>4. Pricing and payment</h2>
      </div>

      <h3>Base price</h3>
      <p>The base price includes:</p>
      <ul class="pp-list">
        <li>Return flight from your selected airport</li>
        <li>Accommodation for all nights (type of your choice)</li>
        <li>Trip organization and destination selection</li>
      </ul>

      <h3>Additional charges</h3>
      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Add-on</th><th>Price</th></tr>
          </thead>
          <tbody>
            <tr><td>1st destination exclusion</td><td>Free</td></tr>
            <tr><td>2nd and 3rd destination exclusion</td><td>+10€ per exclusion</td></tr>
            <tr><td>4th and 5th destination exclusion</td><td>+15€ per exclusion</td></tr>
            <tr><td>Cabin bag (up to 10kg)</td><td>Per price list</td></tr>
            <tr><td>Travel insurance</td><td>Per price list</td></tr>
            <tr><td>Breakfast included</td><td>Per price list</td></tr>
            <tr><td>Guaranteed seats together</td><td>Per price list</td></tr>
          </tbody>
        </table>
      </div>

      <p>The final price is shown in step 7 of the form before you submit your enquiry.</p>

      <h3>Payment deadline</h3>
      <p>Payment must be made within the timeframe specified in the payment details email (usually <strong>48 hours</strong>). If payment is not received within this deadline, your enquiry is automatically cancelled and seats are released.</p>

      <h3>Currency</h3>
      <p>All prices are in <strong>euros (€)</strong>. Payment can be made in the Serbian dinar equivalent at the exchange rate on the day of payment, or directly in euros.</p>
    </section>

    <!-- 5. Cancellation and refunds -->
    <section class="pp-section" id="section-5">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
        </div>
        <h2>5. Cancellation and refunds</h2>
      </div>

      <h3>Cancellation by the traveller</h3>
      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Time before departure</th><th>Refund</th></tr>
          </thead>
          <tbody>
            <tr><td>More than 30 days</td><td>80% of paid amount</td></tr>
            <tr><td>15–30 days</td><td>50% of paid amount</td></tr>
            <tr><td>7–14 days</td><td>30% of paid amount</td></tr>
            <tr><td>Less than 7 days</td><td>No refund</td></tr>
          </tbody>
        </table>
      </div>

      <p>To request cancellation, email escapii.team@gmail.com with your booking reference number.</p>

      <h3>Cancellation by Escapii</h3>
      <p>In exceptional circumstances (natural disasters, political instability, border closures, insufficient bookings), Escapii reserves the right to cancel the trip. In such cases:</p>
      <ul class="pp-list">
        <li>You receive a <strong>full refund</strong> of all amounts paid, or</li>
        <li>The option to <strong>transfer</strong> your booking to another date by mutual agreement</li>
      </ul>

      <p>Escapii is not responsible for additional costs you may have incurred (visa fees, time off work, etc.).</p>
    </section>

    <!-- 6. Traveller responsibilities -->
    <section class="pp-section" id="section-6">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <h2>6. Traveller responsibilities</h2>
      </div>

      <p>By accepting these terms, you confirm that:</p>

      <ul class="pp-list">
        <li><strong>Travel documents are your responsibility</strong> — you must have a valid passport or ID card as required by your destination. Escapii is not responsible if you are denied entry due to invalid documentation.</li>
        <li><strong>Visas</strong> — some destinations may require a visa. Escapii provides general information, but you are solely responsible for obtaining your visa.</li>
        <li><strong>Health requirements</strong> — vaccinations, health certificates, and similar matters are your responsibility.</li>
        <li><strong>Travel insurance</strong> — we recommend it for all travellers. Escapii is not responsible for costs arising from illness, injury, or lost baggage.</li>
        <li><strong>Conduct</strong> — you are responsible for your behaviour during the trip and bear all consequences of any incidents.</li>
      </ul>
    </section>

    <!-- 7. The surprise destination — special terms -->
    <section class="pp-section" id="section-7">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2>7. The surprise destination — special terms</h2>
      </div>

      <p>By purchasing an Escapii trip, you <strong>accept the surprise concept</strong> as the core of the service. This means:</p>

      <ul class="pp-list">
        <li>The destination is not revealed until departure day</li>
        <li>Any destinations you exclude are guaranteed to <strong>not be</strong> your destination</li>
        <li>Escapii chooses the destination based on availability, season, and your preferences — we <strong>do not guarantee</strong> any specific region or continent unless explicitly agreed</li>
        <li>Refunds are <strong>not possible</strong> solely because you do not like the revealed destination</li>
      </ul>
    </section>

    <!-- 8. Limitation of liability -->
    <section class="pp-section" id="section-8">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2>8. Limitation of liability</h2>
      </div>

      <p>Escapii acts as an intermediary between you and service providers (airlines, hotels). Accordingly:</p>

      <ul class="pp-list">
        <li>We are not responsible for flight delays, cancellations, or changes by airlines</li>
        <li>We are not responsible for hotel quality that does not match the stated category (we handle complaints on your behalf)</li>
        <li>We are not responsible for events beyond our control (force majeure, natural disasters, pandemics, strikes)</li>
        <li>Our total liability cannot exceed the amount you paid for the trip</li>
      </ul>
    </section>

    <!-- 9. Complaints -->
    <section class="pp-section" id="section-9">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
        </div>
        <h2>9. Complaints</h2>
      </div>

      <p>If you are dissatisfied with any aspect of the service:</p>

      <ol style="list-style: decimal; padding-left: 20px; color: rgba(45,95,107,.85); font-size: 14.5px;">
        <li>Contact escapii.team@gmail.com within <strong>14 days</strong> of your return</li>
        <li>Include your booking reference number and describe the problem</li>
        <li>We will respond within 7 working days</li>
      </ol>
    </section>

    <!-- 10. Changes to terms -->
    <section class="pp-section" id="section-10">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <h2>10. Changes to terms</h2>
      </div>

      <p>Escapii reserves the right to modify these terms. Changes take effect on the date of publication on the website. For bookings already confirmed, the terms in effect at the time of confirmation apply.</p>
    </section>

    <!-- 11. Governing law -->
    <section class="pp-section" id="section-11">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
        </div>
        <h2>11. Governing law</h2>
      </div>

      <p>These terms are governed by the <strong>law of the Republic of Serbia</strong>. Any disputes are subject to the jurisdiction of Serbian courts.</p>
    </section>

    <!-- 12. Contact -->
    <section class="pp-section" id="section-12">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </div>
        <h2>12. Contact</h2>
      </div>

      <p>If you have any questions about these terms, please contact us before submitting your enquiry.</p>

      <p>📧 <strong>escapii.team@gmail.com</strong><br>
      🌐 <strong>escapii.rs</strong><br>
      📍 Serbia</p>
    </section>
  </main>
</div>

<?php include get_template_directory() . '/inc/footer.php'; ?>

<?php wp_footer(); ?>
</body>
</html>
