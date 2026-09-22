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
  <title>Privacy Policy | Escapii</title>
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
  color: var(--gray);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: color .2s;
}
.pp-back:hover { color: var(--white); }

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

/* ── Rukovalac podacima + linkovi u tekstu ── */
.pp-controller {
  background: var(--navy3);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 16px 18px;
  margin-top: 16px;
}
.pp-controller-title {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  color: var(--accent);
  margin-bottom: 8px;
}
.pp-controller p { margin: 0; font-size: 14px; line-height: 1.7; }
.pp-section p a, .pp-list a, .pp-controller a { color: var(--accent); }
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
  <p>How Escapii collects, uses and protects your data, and how we use cookies.</p>
  <div class="pp-updated">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
    Last updated: 22 September 2026
  </div>
</div>

<!-- Main layout -->
<div class="pp-layout">

  <!-- TOC Sidebar -->
  <nav class="pp-toc">
    <div class="pp-toc-title">Contents</div>
    <ul>
      <li><a href="#who-we-are">General information</a></li>
      <li><a href="#data-we-collect">What data we collect</a></li>
      <li><a href="#why">Why we use your data</a></li>
      <li><a href="#agencies">Escapii and partner agencies</a></li>
      <li><a href="#tools">Technology and marketing tools</a></li>
      <li><a href="#marketing">Marketing and promotions</a></li>
      <li><a href="#cookies">Cookies</a></li>
      <li><a href="#retention">How long we keep data</a></li>
      <li><a href="#sharing">Who we share data with</a></li>
      <li><a href="#security">Data protection</a></li>
      <li><a href="#rights">Your rights</a></li>
      <li><a href="#changes">Changes to this policy</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>

  <!-- Content -->
  <main class="pp-content">

    <!-- 1. General information -->
    <section class="pp-section" id="who-we-are">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </div>
        <h2>General information</h2>
      </div>
      <p>This Privacy Policy explains how Escapii ("Escapii", "we", "us") collects, uses, stores and protects the personal data of users of the escapii.rs platform, and how we use cookies and similar technologies.</p>
      <p>Escapii is a digital platform for surprise trips that connects travellers with licensed partner travel agencies. The agencies organise and carry out the actual trips.</p>
      <p>We process personal data in accordance with the Law on Personal Data Protection of the Republic of Serbia.</p>
      <?php $rk = esc_rukovalac(); ?>
      <div class="pp-controller">
        <div class="pp-controller-title">Data controller</div>
        <p><strong><?php echo esc_html($rk['naziv']); ?></strong><br>
          <?php echo esc_html($rk['sediste']); ?><br>
          Company ID: <?php echo esc_html($rk['mb']); ?> · Tax ID: <?php echo esc_html($rk['pib']); ?><br>
          Email for privacy questions: <a href="mailto:info@escapii.rs">info@escapii.rs</a></p>
      </div>
    </section>

    <!-- 2. What data we collect -->
    <section class="pp-section" id="data-we-collect">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <h2>What data we collect</h2>
      </div>
      <p>Depending on how you use Escapii, we may collect:</p>
      <ul class="pp-list">
        <li><strong>Contact details:</strong> name, email address and phone number.</li>
        <li><strong>Trip details:</strong> departure airport, dates, number of travellers, destinations you excluded and add-ons.</li>
        <li><strong>Traveller details</strong> needed to book flights and accommodation: name, gender, date of birth, passport issuing country and number and, if you provide it, visa information.</li>
        <li><strong>Delivery address and phone number</strong>, if you chose the Reveal Box.</li>
        <li><strong>Gift details:</strong> the name and email of the person you are giving a trip or voucher to, and your message for them.</li>
        <li><strong>The content of your messages:</strong> inquiries, notes and communication with our team.</li>
        <li><strong>Your email address</strong>, if you sign up to be notified about the site launch or new dates.</li>
        <li><strong>Technical data</strong> about your device and use of the site, such as IP address, device and browser type and visit data.</li>
        <li><strong>Data collected through cookies</strong> and similar technologies (see <a href="#cookies">Cookies</a>).</li>
      </ul>
      <p>We do not collect more data than needed for the specific purpose. We do not collect payment card details: you pay the partner travel agency directly.</p>

      <h3>Important notes</h3>
      <ul class="pp-list">
        <li><strong>Required data:</strong> the fields marked as required in the booking form are needed to organise the trip. Without them we cannot process the booking.</li>
        <li><strong>Other people's data:</strong> when you book a trip for several travellers or give it as a gift, you also enter other people's data. By doing so, you confirm that you are entitled to share it with us and that you will make those people aware of this Privacy Policy.</li>
        <li><strong>Children:</strong> only trips for adult travellers can be booked on the site. We organise trips with children on a direct request from a parent or guardian, who then also provides the child's data.</li>
        <li><strong>Health data:</strong> we do not ask for it. If you provide it yourself, for example because of special needs during the trip, we use it only to organise that trip.</li>
      </ul>
    </section>

    <!-- 3. Why we use your data -->
    <section class="pp-section" id="why">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <h2>Why we use your data</h2>
      </div>
      <p>We use your data for the following purposes, on the legal bases set out in the Law on Personal Data Protection:</p>
      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Purpose</th><th>Legal basis</th></tr>
          </thead>
          <tbody>
            <tr><td>Handling your inquiry and booking, organising the trip and communicating with you before, during and after the trip</td><td>Performance of a contract, or steps taken at your request before entering into a contract</td></tr>
            <tr><td>Meeting legal obligations</td><td>Legal obligation</td></tr>
            <tr><td>Platform security, preventing misuse and protecting our rights</td><td>Legitimate interest</td></tr>
            <tr><td>Improving the platform, the user experience and our services</td><td>Legitimate interest</td></tr>
            <tr><td>Analysing how the platform is used (analytics cookies)</td><td>Consent</td></tr>
            <tr><td>Measuring advertising performance (marketing cookies)</td><td>Consent</td></tr>
            <tr><td>Sending notifications you signed up for (site launch, new dates) and promotional messages</td><td>Consent</td></tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- 4. Escapii and partner agencies -->
    <section class="pp-section" id="agencies">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
        </div>
        <h2>Escapii and partner travel agencies</h2>
      </div>
      <p>Escapii and the partner travel agency have different roles.</p>
      <p>Escapii is a digital and marketing platform. We use data to run the platform, communicate with you, provide the user experience, and for marketing, analytics and organising the Escapii experience.</p>
      <p>The partner travel agency organises and carries out your trip. It receives from us the data it needs for this: traveller details (including passport details), dates and the options you chose. The agency uses them to book flights and accommodation, to conclude and perform the travel contract, for payment, issuing documents and meeting its own legal obligations, and it is the controller for that processing. To make the bookings, it passes traveller details on to airlines and accommodation providers.</p>
      <p>The data we provide to the agency is not used for its own marketing, unless there is a separate legal basis and your consent.</p>
    </section>

    <!-- 5. Technology and marketing tools -->
    <section class="pp-section" id="tools">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
        </div>
        <h2>Technology and marketing tools</h2>
      </div>
      <p>To run the platform and for communication, analytics and advertising, we use service providers to whom we give data only to the extent needed for the service they provide:</p>
      <ul class="pp-list">
        <li><strong>hosting and infrastructure:</strong> servers in the European Union and protection of the site against attacks;</li>
        <li><strong>email:</strong> sending messages about your booking and business email;</li>
        <li><strong>HubSpot:</strong> visitor analytics and managing communication with users (CRM);</li>
        <li><strong>Google Analytics 4 and Google Tag Manager:</strong> analytics of platform use and managing these tools;</li>
        <li><strong>Google Ads and Meta (Instagram, Facebook):</strong> advertising and measuring ad results.</li>
      </ul>
      <p>These services may process certain technical and other data in line with their own privacy policies. Analytics and marketing tools are only activated if you allow them in the cookie settings.</p>

      <h3>Transfers outside Serbia</h3>
      <p>Some of these providers, such as Google, Meta and HubSpot, are based or have servers outside Serbia, including in the United States. We transfer data to them only in accordance with the Law on Personal Data Protection, with the safeguards provided in our agreements with those providers.</p>
    </section>

    <!-- 6. Marketing -->
    <section class="pp-section" id="marketing">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
        </div>
        <h2>Marketing and promotional messages</h2>
      </div>
      <p>If you give your consent, for example by signing up for our notification list, we may send you information about the site launch, new trips, offers and promotions.</p>
      <p>You can withdraw your consent at any time. You can unsubscribe from promotional messages using the unsubscribe link in the message itself or by writing to <a href="mailto:info@escapii.rs">info@escapii.rs</a>.</p>
      <p>Messages about your booking, such as confirmations and trip information, are not promotional and we send them without separate consent.</p>
    </section>

    <!-- 7. Cookies -->
    <section class="pp-section" id="cookies">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/></svg>
        </div>
        <h2>Cookies</h2>
      </div>

      <style>
        .pp-cookie-table { width:100%; border-collapse:collapse; margin:14px 0 18px; font-size:14px; }
        .pp-cookie-table th, .pp-cookie-table td { text-align:left; padding:10px 12px; border-bottom:1px solid rgba(0,0,0,.1); vertical-align:top; }
        .pp-cookie-table th { font-weight:700; font-size:12px; letter-spacing:.04em; text-transform:uppercase; opacity:.7; }
        .pp-cookie-table code { font-size:13px; overflow-wrap:anywhere; }
        .pp-cookie-wrap { overflow-x:auto; }
      </style>

      <p>Cookies are small text files stored on your device when you visit a website. Escapii uses cookies and similar technologies (browser local storage) to make the platform work properly, to understand how escapii.rs is used and, based on your choice, to measure and improve our advertising.</p>

      <h3>Essential cookies</h3>
      <p>They are needed for the basic operation of the platform: remembering your settings, keeping a booking in progress, security and preventing misuse. They do not require consent and cannot be switched off in the cookie banner, because the site does not work without them.</p>
      <div class="pp-cookie-wrap">
      <table class="pp-cookie-table">
        <tr><th>Name</th><th>Purpose</th><th>Duration</th></tr>
        <tr><td><code>esc_consent</code></td><td>Remembers your cookie choice</td><td>12 months</td></tr>
        <tr><td><code>esc-lang</code></td><td>Remembers the selected language (Serbian or English)</td><td>12 months</td></tr>
        <tr><td><code>esc_booking_draft_v2</code><br><small>(sessionStorage)</small></td><td>Keeps a booking in progress so your input is not lost if you refresh the page</td><td>4 hours or until the tab is closed</td></tr>
        <tr><td><code>esc_bp</code><br><small>(sessionStorage)</small></td><td>Passes booking details to the confirmation page</td><td>Until the tab is closed</td></tr>
      </table>
      </div>

      <h3>Analytics cookies (with your consent)</h3>
      <p>We use Google Analytics 4, through Google Tag Manager, and HubSpot to understand which pages and features are used most, spot problems on the platform and improve the user experience. These tools are not loaded until you allow them.</p>
      <div class="pp-cookie-wrap">
      <table class="pp-cookie-table">
        <tr><th>Name</th><th>Purpose</th><th>Duration</th></tr>
        <tr><td><code>_ga</code></td><td>Google Analytics: distinguishes visitors</td><td>2 years</td></tr>
        <tr><td><code>_ga_*</code></td><td>Google Analytics: keeps the session state</td><td>2 years</td></tr>
        <tr><td><code>__hstc</code></td><td>HubSpot: visitor tracking</td><td>6 months</td></tr>
        <tr><td><code>hubspotutk</code></td><td>HubSpot: recognises the visitor when forms are submitted</td><td>6 months</td></tr>
        <tr><td><code>__hssc</code></td><td>HubSpot: session tracking</td><td>30 minutes</td></tr>
        <tr><td><code>__hssrc</code></td><td>HubSpot: detects a new session</td><td>Until the browser is closed</td></tr>
      </table>
      </div>
      <p>More about how they process data: <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google Privacy Policy</a> and <a href="https://legal.hubspot.com/privacy-policy" target="_blank" rel="noopener">HubSpot Privacy Policy</a>.</p>

      <h3>Marketing cookies (with your consent)</h3>
      <p>Depending on your settings, we may use technologies to measure and optimise our advertising, such as Google Ads and the Meta Pixel (Instagram, Facebook). They make it possible to measure interaction with our ads, conversions and activity after an ad is clicked. They are only activated if you allow marketing cookies, and may then set cookies such as:</p>
      <div class="pp-cookie-wrap">
      <table class="pp-cookie-table">
        <tr><th>Name</th><th>Purpose</th><th>Duration</th></tr>
        <tr><td><code>_gcl_au</code></td><td>Google Ads: conversion measurement</td><td>90 days</td></tr>
        <tr><td><code>_fbp</code></td><td>Meta: measuring ad results</td><td>90 days</td></tr>
      </table>
      </div>
      <p>More about how they process data: <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google Privacy Policy</a> and <a href="https://www.facebook.com/privacy/policy/" target="_blank" rel="noopener">Meta Privacy Policy</a>.</p>

      <h3>Third-party content</h3>
      <p>To display the site, we also load fonts and scripts from public services (for example Google Fonts), which see your IP address in the process but do not set cookies. When Instagram posts are shown on a page, Meta may set its own cookies in line with its privacy policy.</p>

      <h3>How to change your choice</h3>
      <p>On your first visit you choose which cookie categories you accept, apart from the essential ones. We remember your choice for 12 months, and you can change it at any time through <a href="javascript:void(0)" onclick="if(window.escOpenCookieSettings)escOpenCookieSettings()">Cookie settings</a>, which is also in the site footer. You can also block or delete cookies in your browser settings, but switching off some cookies may affect how the site works.</p>
      <p>Withdrawing consent is as easy as giving it and does not affect the lawfulness of processing before the withdrawal.</p>
    </section>

    <!-- 8. Retention -->
    <section class="pp-section" id="retention">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h2>How long we keep data</h2>
      </div>
      <p>We keep data only as long as needed for the purpose it was collected for, or as long as needed to meet our legal obligations.</p>
      <ul class="pp-list">
        <li><strong>Booking and completed trip data</strong> is kept for the period required to meet legal, accounting and other obligations.</li>
        <li><strong>Passport numbers</strong> are stored encrypted in our database and deleted 30 days after you return from the trip.</li>
        <li><strong>Data used for promotional messages</strong> is kept until you withdraw consent or unsubscribe, unless another legal basis requires us to keep it.</li>
        <li><strong>Your email for new-date notifications</strong> is kept until we send you the notification.</li>
        <li><strong>Cookies</strong> are kept for the periods listed in the <a href="#cookies">Cookies</a> section.</li>
      </ul>
      <p>When data is no longer needed, we delete it, anonymise it or otherwise stop processing it in an appropriate way.</p>
    </section>

    <!-- 9. Sharing -->
    <section class="pp-section" id="sharing">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
        </div>
        <h2>Who we share data with</h2>
      </div>
      <p>We make data available only when it is needed to achieve the purpose of processing, namely to:</p>
      <ul class="pp-list">
        <li>the partner travel agency that carries out your trip;</li>
        <li>the technology providers we use (see <a href="#tools">Technology and marketing tools</a>);</li>
        <li>the delivery service, if you chose the Reveal Box;</li>
        <li>accounting, legal and other professional service providers, when needed;</li>
        <li>competent authorities, when we are required to by law.</li>
      </ul>
      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">Escapii does not sell users' data to third parties.</div>
      </div>
    </section>

    <!-- 10. Security -->
    <section class="pp-section" id="security">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h2>Data protection</h2>
      </div>
      <p>We take appropriate technical and organisational measures to protect data against unauthorised access, loss, misuse, alteration or destruction:</p>
      <ul class="pp-list">
        <li>all communication with the site is encrypted (HTTPS);</li>
        <li>passport numbers are stored encrypted in our database;</li>
        <li>only the people and service providers who need the data to do their work have access to it.</li>
      </ul>
    </section>

    <!-- 11. Rights -->
    <section class="pp-section" id="rights">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2>Your rights</h2>
      </div>
      <p>Under the Law on Personal Data Protection, you have the following rights:</p>
      <div class="pp-rights">
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right of access</div>
          <div class="pp-right-card-desc">You can ask for access to the data we hold about you and for a copy of it</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right to rectification</div>
          <div class="pp-right-card-desc">You can ask us to correct inaccurate or incomplete data</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right to erasure</div>
          <div class="pp-right-card-desc">You can ask us to delete your data when the legal conditions are met</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right to restriction</div>
          <div class="pp-right-card-desc">You can ask us to restrict the processing of your data</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right to object</div>
          <div class="pp-right-card-desc">You can object to processing based on legitimate interest and to direct marketing</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Right to data portability</div>
          <div class="pp-right-card-desc">You can ask for your data in a machine-readable format when the legal conditions are met</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Withdrawing consent</div>
          <div class="pp-right-card-desc">You can withdraw consent at any time, without affecting the lawfulness of processing before the withdrawal</div>
        </div>
      </div>
      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>How to exercise your rights:</strong> send an email to <a href="mailto:info@escapii.rs">info@escapii.rs</a> with the subject "Data protection request". We will reply without undue delay and within 30 days at the latest.<br><br>
          <strong>Right to lodge a complaint:</strong> if you believe your data protection rights have been violated, you can contact the <a href="https://www.poverenik.rs" target="_blank" rel="noopener">Commissioner for Information of Public Importance and Personal Data Protection</a> of the Republic of Serbia.
        </div>
      </div>
    </section>

    <!-- 12. Changes -->
    <section class="pp-section" id="changes">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <h2>Changes to this policy</h2>
      </div>
      <p>We update this Privacy Policy from time to time to reflect changes in how we use data, in our services or in the law. The current version, with the date of the last update, is always available on this page.</p>
    </section>

    <!-- 13. Contact -->
    <section class="pp-section" id="contact">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </div>
        <h2>Contact</h2>
      </div>
      <div class="pp-contact">
        <h3>Have a privacy question?</h3>
        <p>For any questions, requests or complaints about the processing of personal data, write to us.</p>
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
