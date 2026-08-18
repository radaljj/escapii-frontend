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
  <title>Terms of Use | Escapii</title>
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
    Last updated: May 2026 · v2 (gift vouchers, custom dates)
  </div>
</div>

<!-- Main layout -->
<div class="pp-layout">

  <!-- TOC -->
  <nav class="pp-toc">
    <div class="pp-toc-title">Contents</div>
    <ul>
      <li><a href="#who-we-are">Who We Are and What We Do</a></li>
      <li><a href="#how-it-works">How Escapii Works</a></li>
      <li><a href="#booking-process">Booking Process</a></li>
      <li><a href="#prices">Prices and Payment</a></li>
      <li><a href="#gift-vouchers">Gift Vouchers</a></li>
      <li><a href="#custom-dates">Custom Dates</a></li>
      <li><a href="#traveler-responsibilities">Traveler Responsibilities</a></li>
      <li><a href="#cancellation">Cancellation and Changes</a></li>
      <li><a href="#liability">Limitation of Liability</a></li>
      <li><a href="#visas">Visas and Travel Documents</a></li>
      <li><a href="#disputes">Dispute Resolution</a></li>
      <li><a href="#changes">Changes to the Terms of Use</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>

  <!-- Content -->
  <main class="pp-content">

    <!-- Who We Are -->
    <section class="pp-section" id="who-we-are">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </div>
        <h2>Who We Are and What We Do</h2>
      </div>

      <p><strong>Escapii</strong> is a digital platform for arranging surprise trips. Users choose their departure airport, travel dates, number of travelers, and preferences — we find and arrange the trip for them.</p>
      <p>Escapii is <strong>not a travel agency</strong> and does not act as a licensed tour operator. We operate as a <strong>subagent</strong> of a partner travel agency, which is fully responsible for the execution of the travel arrangement.</p>
    </section>

    <!-- How It Works -->
    <section class="pp-section" id="how-it-works">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <h2>How Escapii Works</h2>
      </div>

      <p>Escapii is a platform for <strong>surprise trips</strong> — users do not choose their destination, but instead choose their departure airport, travel period, and preferences. The destination remains a secret until the reveal sent by email <strong>48 hours before departure</strong>.</p>

      <h3>The Surprise Concept</h3>
      <ul class="pp-list">
        <li><strong>The user chooses:</strong> departure airport, dates, number of travelers, accommodation type, add-ons (travel insurance, breakfast, seats together, baggage) and up to 5 destinations they wish to exclude</li>
        <li><strong>Escapii chooses the destination</strong> from a pool of suitable available flights that have not been excluded — every trip is tailored to the best available options at the time, so the final destination may also be one that is not currently featured on the website</li>
        <li><strong>The destination is revealed</strong> to the user by email 48 hours before departure</li>
        <li>By submitting a request, the user <strong>accepts the surprise as an integral part of the service</strong> and cannot request a destination change after the booking has been confirmed</li>
      </ul>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          By excluding destinations through the platform, users can reduce the number of possible destinations. However, Escapii does not guarantee travel to any specific destination, nor does it exclude every possible location the user may not wish to visit.
        </div>
      </div>
    </section>

    <!-- Booking Process -->
    <section class="pp-section" id="booking-process">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <h2>Booking Process</h2>
      </div>

      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Step</th><th>Description</th></tr>
          </thead>
          <tbody>
            <tr><td>1. Request</td><td>The user fills out the form on the website and submits a request. An automatic confirmation of receipt is sent by email.</td></tr>
            <tr><td>2. Review</td><td>The Escapii team checks availability and pricing. The request is not binding on the user until confirmation and payment have been made.</td></tr>
            <tr><td>3. Confirmation and Payment</td><td>The user receives an email with the booking details and payment instructions. The booking is considered confirmed only once payment has been received.</td></tr>
            <tr><td>4. Reveal</td><td>48 hours before departure, the user receives an email revealing the destination, along with a weather forecast link and all relevant information.</td></tr>
          </tbody>
        </table>
      </div>

      <p>Submitting a request does <strong>not constitute a contract</strong> and does not create any financial obligation for the user. A contractual relationship is established <strong>exclusively upon payment of the deposit</strong> following written booking confirmation.</p>
    </section>

    <!-- Prices and Payment -->
    <section class="pp-section" id="prices">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <h2>Prices and Payment</h2>
      </div>

      <p>Prices displayed on the platform while submitting a request are <strong>indicative and for informational purposes only</strong>. The final price is determined when availability is checked and is sent to the user in the booking confirmation before any payment is made.</p>

      <h3>Price Structure</h3>
      <ul class="pp-list">
        <li>Base package price per person (flight + accommodation)</li>
        <li>Accommodation upgrade (Superior or Premium, where applicable)</li>
        <li>Add-ons selected by the user: travel insurance, breakfast, seats together, cabin baggage</li>
        <li>Destination exclusion fee (1 exclusion is free — each additional exclusion costs +€15 per person)</li>
      </ul>

      <h3>Payment Methods</h3>
      <p>Payment is made exclusively by <strong>bank transfer</strong> according to the instructions provided in the booking confirmation. Escapii does not collect payment card details.</p>

      <h3>Price Adjustments</h3>
      <p>In exceptional circumstances (significant changes in fuel prices, exchange rates, or taxes), the package price may be adjusted before payment is completed. In such cases, the user will be notified in writing and may cancel without a fee.</p>
    </section>

    <!-- Gift Vouchers -->
    <section class="pp-section" id="gift-vouchers">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
        </div>
        <h2>Gift Vouchers</h2>
      </div>

      <p>Escapii offers the option to purchase <strong>gift vouchers</strong> that the recipient can use when booking an Escapii trip. By purchasing a voucher, you accept the terms set out in this section.</p>

      <h3>How Gift Vouchers Work</h3>
      <ul class="pp-list">
        <li>The voucher is purchased on the <strong>Gift</strong> page on escapii.rs by selecting the desired amount and entering the recipient's details</li>
        <li>After payment is confirmed, the purchaser receives a <strong>PDF voucher</strong> (boarding pass design) by email containing a unique code</li>
        <li>The voucher is activated once the Escapii team confirms the payment — the validity period starts from that date</li>
        <li>The recipient enters the voucher code when submitting a request for an Escapii trip; the amount corresponding to the price of the trip is <strong>deducted from the voucher balance</strong> — any remaining balance stays available for future trips</li>
        <li>The voucher can be used for <strong>group departures and custom dates</strong></li>
      </ul>

      <h3>Validity Period and Terms of Use</h3>
      <ul class="pp-list">
        <li>The voucher is valid for <strong>one year from the activation date</strong> (not from the purchase date)</li>
        <li>Once the validity period expires, the voucher becomes invalid and cannot be used, regardless of any remaining balance</li>
        <li><strong>One voucher</strong> may be applied to each booking</li>
        <li>The voucher may be used <strong>multiple times</strong> across different bookings until the balance has been fully used</li>
        <li>If the value of the trip is lower than the remaining voucher balance, <strong>the difference remains on the voucher</strong> and can be used toward a future Escapii booking within the remaining validity period</li>
        <li>If the value of the trip exceeds the remaining voucher balance, the difference must be paid using the standard payment method</li>
      </ul>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>Booking cancellation:</strong> If a user cancels a booking where a voucher was applied, the voucher is automatically <strong>returned to active status with its full remaining balance</strong> (along with all remaining rights from its original validity period). Any amount paid above the voucher value is subject to the standard cancellation policy.
        </div>
      </div>

      <div class="pp-warning">
        <div class="pp-warning-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="pp-warning-text">
          <strong>The voucher cannot be exchanged for cash</strong> — any unused balance is not refundable and remains on the voucher until it expires. Once activated, a voucher is non-transferable to another person.
        </div>
      </div>
    </section>

    <!-- Custom Dates -->
    <section class="pp-section" id="custom-dates">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h2>Custom Dates</h2>
      </div>

      <p>In addition to regular group departures, Escapii offers the option to arrange a <strong>custom trip</strong> for groups that cannot find a suitable date in the standard offering or that want an exclusive arrangement.</p>

      <h3>Custom Date Process</h3>
      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead><tr><th>Step</th><th>Description</th></tr></thead>
          <tbody>
            <tr><td>1. Request</td><td>The user selects the <strong>Custom Date</strong> option in the booking form, enters their preferred travel period and number of travelers, and submits a request.</td></tr>
            <tr><td>2. Offer</td><td>The Escapii team checks availability and sends an individual price offer within 24–48 hours.</td></tr>
            <tr><td>3. Confirmation</td><td>The user accepts the offer and makes the payment within the agreed timeframe. The booking becomes binding only once payment has been received.</td></tr>
            <tr><td>4. Reveal</td><td>The destination is revealed 48 hours before departure, just as with group departures.</td></tr>
          </tbody>
        </table>
      </div>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          The same cancellation and amendment terms that apply to group arrangements also apply to custom dates (see the <a href="#cancellation">Cancellation and Changes</a> section). The price of a custom trip is determined individually and may differ from the prices shown in the standard offering.
        </div>
      </div>
    </section>

    <!-- Traveler Responsibilities -->
    <section class="pp-section" id="traveler-responsibilities">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <h2>Traveler Responsibilities</h2>
      </div>

      <p>The user is responsible for ensuring that all information provided is accurate and complete. Incorrect information may result in the inability to carry out the trip or additional costs, which will be borne solely by the user.</p>

      <h3>The User Is Required To:</h3>
      <ul class="pp-list">
        <li>Enter the <strong>exact first and last name of each traveler</strong> as shown on the travel document that will be used for the trip</li>
        <li>Enter the <strong>exact date of birth</strong> of each traveler</li>
        <li>Check the <strong>validity of their travel document</strong> — the passport must be valid for at least 6 months after the return date</li>
        <li>In the <strong>Notes</strong> field when submitting a request, indicate if a visa is required for any potential destination, or if any traveler holds a valid visa for specific countries (for all travelers, not only the booking holder) — this allows us to adjust the destination selection accordingly</li>
        <li>Pay the deposit and remaining balance on time, according to the agreed deadlines</li>
        <li>Arrive at the airport at the time specified by the airline (at least 2 hours before departure for European flights)</li>
        <li><strong>Complete check-in independently</strong> with the airline after receiving the destination reveal (48 hours before departure) — Escapii provides the airline booking reference via the reveal link, while each traveler is responsible for completing check-in on time and in accordance with the carrier's requirements</li>
      </ul>

      <div class="pp-warning">
        <div class="pp-warning-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="pp-warning-text">
          <strong>Visas and travel documents:</strong> Since the destination remains secret until 48 hours before departure, the user is required to state in the <strong>Notes</strong> field when submitting a request: (1) which countries the travelers hold valid visas for, and (2) whether any traveler may require a visa for certain destinations. Based on this information, Escapii adjusts the destination selection. The user bears sole responsibility for the travel documents of all travelers included in the booking.
        </div>
      </div>
    </section>

    <!-- Cancellation and Changes -->
    <section class="pp-section" id="cancellation">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
        </div>
        <h2>Cancellation and Changes</h2>
      </div>

      <p>Cancellation and amendment terms are governed by the terms of the partner travel agency that carries out the trip. The following is a general overview — exact terms can be obtained from the Escapii team at <a href="mailto:info@escapii.rs" style="color:var(--accent);text-decoration:none;">info@escapii.rs</a>.</p>

      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Time Before Departure</th><th>Cancellation Fee</th></tr>
          </thead>
          <tbody>
            <tr><td>Before deposit payment</td><td>No fee — the request is non-binding</td></tr>
            <tr><td>After deposit payment, more than 30 days before departure</td><td>The deposit is retained</td></tr>
            <tr><td>15–30 days before departure</td><td>Part of the total price</td></tr>
            <tr><td>Less than 15 days before departure</td><td>The full amount may be retained</td></tr>
          </tbody>
        </table>
      </div>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>Recommendation:</strong> If there is a possibility that you may need to cancel your trip, we strongly recommend purchasing <strong>travel insurance with cancellation coverage</strong>, which is available as an option during booking.
        </div>
      </div>

      <h3>Booking Changes</h3>
      <p><strong>Changes are not possible after the booking has been confirmed.</strong> By confirming the booking, the user accepts all travel arrangements (destination, dates, number of travelers, accommodation type, and add-ons) as final. The only option after confirmation is to cancel the booking, subject to the applicable cancellation fee according to the table above.</p>

      <h3>Cancellation by the Organizer</h3>
      <p>If the organizer cancels the trip for reasons that are not attributable to the user, the user will receive a full refund of the amount paid or be offered an alternative arrangement of equivalent value.</p>
    </section>

    <!-- Limitation of Liability -->
    <section class="pp-section" id="liability">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2>Limitation of Liability</h2>
      </div>

      <h3>Escapii's Responsibility</h3>
      <p>Escapii is responsible solely for the proper functioning of the digital platform — collecting requests and communicating with users. Escapii is not responsible for:</p>
      <ul class="pp-list">
        <li>The execution of the travel arrangement — this is the responsibility of the partner agency organizing the trip</li>
        <li>The quality of flights, accommodation, or accompanying services</li>
        <li>Delays, cancellations, or changes to flights made by airlines</li>
        <li>Extraordinary circumstances (natural disasters, epidemics, wars, strikes)</li>
        <li>Consequences resulting from incorrect information entered by the user</li>
        <li>Inability to enter a country due to missing or inadequate travel documents or visas</li>
      </ul>

      <h3>User Responsibility</h3>
      <p>The user is financially responsible for all costs arising from incorrect or incomplete information provided when submitting a request, as well as for any consequences resulting from missed payment deadlines.</p>

      <h3>Force Majeure</h3>
      <p>Escapii is not responsible for failure to fulfill its obligations due to circumstances that could not have been foreseen or prevented (force majeure), including but not limited to natural disasters, epidemics, wars, government-imposed travel bans, and similar events.</p>
    </section>

    <!-- Visas and Travel Documents -->
    <section class="pp-section" id="visas">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
        <h2>Visas and Travel Documents</h2>
      </div>

      <p>The user is <strong>solely responsible</strong> for obtaining all travel documents, visas, and health certificates required by the destination. Final responsibility lies with the traveler.</p>

      <h3>Minimum Requirements</h3>
      <ul class="pp-list">
        <li><strong>Passport</strong> must be valid for at least 6 months after the return date</li>
        <li>Holders of Serbian passports must check visa requirements for all potential destinations included in the offering</li>
        <li>Children must have their own travel documents</li>
      </ul>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          Current information on visa requirements for Serbian passport holders is available on the website of the <a href="https://www.mfa.gov.rs" target="_blank" rel="noopener">Ministry of Foreign Affairs of the Republic of Serbia</a>.
        </div>
      </div>
    </section>

    <!-- Dispute Resolution -->
    <section class="pp-section" id="disputes">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
        </div>
        <h2>Dispute Resolution</h2>
      </div>

      <p>Contracts concluded through the Escapii platform are governed by the laws of the <strong>Republic of Serbia</strong>. The courts in Belgrade have jurisdiction over any disputes.</p>

      <h3>Complaints</h3>
      <p>Users who are dissatisfied with the execution of their trip may submit a written complaint to <a href="mailto:info@escapii.rs" style="color:var(--accent);text-decoration:none;">info@escapii.rs</a>.</p>
      <p>A complaint must be submitted within <strong>8 days of returning</strong> from the trip. The organizer is required to respond within 8 business days of receiving the complaint.</p>

      <h3>Consumer Protection</h3>
      <p>For the protection of consumer rights, users may contact the <strong>National Organization of Consumers of Serbia (NOPS)</strong> or the relevant inspection authorities.</p>
    </section>

    <!-- Changes to Terms -->
    <section class="pp-section" id="changes">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <h2>Changes to the Terms of Use</h2>
      </div>
      <p>Escapii reserves the right to amend these Terms of Use. The date of the latest amendment will always be indicated at the top of the document. Continued use of the platform after an amendment constitutes acceptance of the revised terms.</p>
      <p>For significant changes affecting users' rights, we will make reasonable efforts to notify registered users by email.</p>
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
        <h3>Have a Question?</h3>
        <p>The Escapii team is here for you — we respond within 24 hours.</p>
        <div class="pp-contact-links">
          <a href="mailto:info@escapii.rs" class="pp-contact-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            info@escapii.rs
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

<script>var lang = 'en';</script>
<?php $_COOKIE['esc-lang'] = 'en'; include get_template_directory() . '/inc/footer.php'; ?>

<?php wp_footer(); ?>
</body>
</html>
