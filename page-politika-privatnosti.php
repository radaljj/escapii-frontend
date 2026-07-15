<?php
/**
 * Template Name: Privacy Policy
 */
?>
<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Politika privatnosti | Escapii</title>
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
  white-space: nowrap;
  flex-shrink: 0;
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
.pp-content {
  min-width: 0;
}

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
.pp-section h2 {
  font-size: 18px;
  font-weight: 700;
  letter-spacing: -.3px;
  color: var(--white);
}

.pp-section p {
  font-size: 14.5px;
  color: rgba(45,95,107,.85);
  margin-bottom: 14px;
  line-height: 1.75;
}
.pp-section p:last-child { margin-bottom: 0; }

.pp-section h3 {
  font-size: 14px;
  font-weight: 600;
  color: var(--white);
  margin: 20px 0 10px;
}

/* ── Table ── */
.pp-table-wrap {
  overflow-x: auto;
  border-radius: 12px;
  border: 1px solid var(--border);
  margin: 16px 0;
}
.pp-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 13.5px;
}
.pp-table thead {
  background: rgba(202,138,113,.08);
}
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
.pp-right-card-title {
  font-size: 13px;
  font-weight: 600;
  color: var(--white);
  margin-bottom: 5px;
}
.pp-right-card-desc {
  font-size: 12.5px;
  color: var(--gray);
  line-height: 1.5;
}

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
.pp-not-collected ul {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.pp-not-collected ul li {
  font-size: 13.5px;
  color: rgba(45,95,107,.8);
  display: flex;
  align-items: center;
  gap: 8px;
}
.pp-not-collected ul li::before {
  content: '✓';
  color: #22c55e;
  font-weight: 700;
  font-size: 12px;
}

/* ── Contact footer ── */
.pp-contact {
  background: rgba(255,255,255,.03);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 28px;
  text-align: center;
  margin-top: 16px;
}
.pp-contact h3 {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 8px;
}
.pp-contact p {
  font-size: 13.5px;
  color: var(--gray);
  margin-bottom: 18px;
}
.pp-contact-links {
  display: flex;
  justify-content: center;
  gap: 12px;
  flex-wrap: wrap;
}
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
.pp-contact-link:hover {
  background: rgba(202,138,113,.2);
  border-color: var(--accent);
}

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
.pp-lang-wrap { display: flex; background: rgba(255,255,255,.1); border-radius: 8px; overflow: hidden; flex-shrink: 0; }
.pp-lang-btn {
  padding: 6px 14px; font-size: 12px; font-weight: 700; cursor: pointer;
  border: none; background: transparent; color: rgba(255,255,255,.5);
  letter-spacing: .5px; transition: all .2s; text-decoration: none;
  display: inline-flex; align-items: center; justify-content: center;
  white-space: nowrap; line-height: 1;
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
        <span class="pp-lang-btn on">SR</span>
        <a href="<?php echo home_url('/privacy-policy'); ?>" class="pp-lang-btn">EN</a>
      </div>
      <a href="/" class="pp-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Nazad na sajt
      </a>
    </div>
  </div>
</header>

<!-- Hero -->
<div class="pp-hero">
  <div class="pp-hero-badge">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
    Pravni dokument
  </div>
  <h1>Politika privatnosti</h1>
  <p>Transparentno objašnjavamo koje podatke prikupljamo, zašto i kako ih štitimo.</p>
  <div class="pp-updated">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
    Poslednje ažuriranje: Maj 2026
  </div>
</div>

<!-- Main layout -->
<div class="pp-layout">

  <!-- TOC Sidebar -->
  <nav class="pp-toc">
    <div class="pp-toc-title">Sadržaj</div>
    <ul>
      <li><a href="#ko-smo-mi">Ko smo mi</a></li>
      <li><a href="#koji-podaci">Koje podatke prikupljamo</a></li>
      <li><a href="#zasto">Zašto obrađujemo podatke</a></li>
      <li><a href="#pristup">Ko ima pristup</a></li>
      <li><a href="#cuvanje">Koliko dugo čuvamo</a></li>
      <li><a href="#prava">Vaša prava</a></li>
      <li><a href="#bezbednost">Bezbednost</a></li>
      <li><a href="#kolacici">Kolačići</a></li>
      <li><a href="#izmene">Izmene politike</a></li>
      <li><a href="#kontakt">Kontakt</a></li>
    </ul>
  </nav>

  <!-- Content -->
  <main class="pp-content">

    <!-- Ko smo mi -->
    <section class="pp-section" id="ko-smo-mi">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </div>
        <h2>Ko smo mi</h2>
      </div>
      <p><strong>Escapii</strong> je digitalna platforma za organizaciju iznenađujućih putovanja iz Srbije. Nismo turistička agencija - nastupamo kao <strong>subagent</strong> licencirane turističke agencije i posredujemo pri formiranju aranžmana.</p>
      <p>Za sva pitanja u vezi sa obradom vaših podataka možete nas kontaktirati na <strong>escapii.team@gmail.com</strong>.</p>
    </section>

    <!-- Koji podaci -->
    <section class="pp-section" id="koji-podaci">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <h2>Koje podatke prikupljamo</h2>
      </div>

      <h3>Podaci koje direktno unosite</h3>
      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Podatak</th><th>Svrha</th></tr>
          </thead>
          <tbody>
            <tr><td>Ime i prezime</td><td>Identifikacija i komunikacija</td></tr>
            <tr><td>Email adresa</td><td>Slanje potvrda i informacija o putovanju</td></tr>
            <tr><td>Broj telefona</td><td>Hitna komunikacija u vezi sa putovanjem</td></tr>
            <tr><td>Datum polaska i povratka</td><td>Organizacija putovanja</td></tr>
            <tr><td>Aerodrom polaska</td><td>Pronalazak odgovarajućih letova</td></tr>
            <tr><td>Broj putnika</td><td>Rezervacija kapaciteta</td></tr>
            <tr><td>Tip smeštaja</td><td>Organizacija smeštaja</td></tr>
            <tr><td>Isključene destinacije</td><td>Prilagođavanje iznenađenja vašim preferencama</td></tr>
            <tr><td>Preference (doručak, sedišta, prtljag, osiguranje)</td><td>Personalizacija ponude</td></tr>
            <tr><td>Podaci o putnicima (ime, pol, datum rođenja)</td><td>Rezervacija leta i smeštaja kod partnerske agencije</td></tr>
            <tr><td>Informacije o vizama</td><td>Prilagođavanje destinacije viznom statusu putnika</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Podaci koje prikupljamo automatski</h3>
      <ul class="pp-list">
        <li><strong>IP adresa</strong> - isključivo za zaštitu od zloupotrebe (ograničavamo broj upita po IP adresi), čuva se 24 sata</li>
        <li><strong>Datum i vreme slanja upita</strong> - radi evidentiranja rezervacije</li>
      </ul>

      <h3>Šta ne prikupljamo</h3>
      <div class="pp-not-collected">
        <div class="pp-not-collected-title">Ne prikupljamo</div>
        <ul>
          <li>Podatke o platnoj kartici - plaćanje se vrši bankovnim transferom</li>
          <li>Brojeve pasoša niti kopije putnih isprava</li>
          <li>Kolačiće za praćenje ili profilisanje korisnika</li>
        </ul>
      </div>
    </section>

    <!-- Zasto -->
    <section class="pp-section" id="zasto">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <h2>Zašto obrađujemo vaše podatke</h2>
      </div>
      <p>Vaše podatke koristimo isključivo za:</p>
      <ul class="pp-list">
        <li><strong>Obradu vašeg upita za putovanje</strong> - bez ovih podataka ne možemo organizovati putovanje</li>
        <li><strong>Slanje potvrde upita na email</strong> - automatski, odmah po prijemu upita</li>
        <li><strong>Komunikaciju u vezi sa rezervacijom</strong> - slanje detalja o uplati, potvrde rezervacije, obaveštenja o izmenama ili otkazivanjima</li>
        <li><strong>Waitlist notifikacije</strong> - ukoliko ste se prijavili za obaveštenje o novim terminima za određeni aerodrom</li>
      </ul>
      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>Pravni osnov:</strong> Izvršenje ugovora (čl. 12. st. 1. tač. 2. Zakona o zaštiti podataka o ličnosti) i vaša saglasnost (čl. 12. st. 1. tač. 1.) za komunikaciju i waitlist.
        </div>
      </div>
    </section>

    <!-- Pristup -->
    <section class="pp-section" id="pristup">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h2>Ko ima pristup vašim podacima</h2>
      </div>

      <h3>Unutar Escapii</h3>
      <p>Samo osobe koje direktno organizuju vaše putovanje imaju pristup vašim podacima.</p>

      <h3>Treće strane</h3>
      <p>Vaše podatke delimo sa sledećim kategorijama primaoca, isključivo u meri neophodnoj za organizaciju putovanja:</p>
      <ul class="pp-list">
        <li><strong>Partnerska turistička agencija</strong> - prima podatke neophodne za rezervaciju leta i smeštaja (ime i prezime putnika, aerodrom, datumi, broj putnika, tip smeštaja), isključivo u svrhu izvršenja aranžmana</li>
        <li><strong>Avio kompanije i hoteli</strong> - radi rezervacije, posredstvom partnerske agencije</li>
        <li><strong>Osiguravajuće kompanije</strong> - isključivo ukoliko ste odabrali putno osiguranje</li>
        <li><strong>Google (Gmail)</strong> - emailovi koje šaljemo prolaze kroz Google infrastrukturu</li>
      </ul>
      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">Ne prodajemo vaše podatke trećim stranama. Ne delimo podatke u marketinške svrhe.</div>
      </div>
    </section>

    <!-- Cuvanje -->
    <section class="pp-section" id="cuvanje">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h2>Koliko dugo čuvamo podatke</h2>
      </div>
      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Vrsta podatka</th><th>Period čuvanja</th></tr>
          </thead>
          <tbody>
            <tr><td>Podaci o rezervaciji</td><td>3 godine od datuma putovanja (zakonska obaveza za poslovnu dokumentaciju)</td></tr>
            <tr><td>Waitlist email</td><td>Do slanja obaveštenja ili do vašeg zahteva za brisanje</td></tr>
            <tr><td>IP adrese (rate limiting)</td><td>24 sata</td></tr>
            <tr><td>Email prepiska</td><td>2 godine</td></tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Prava -->
    <section class="pp-section" id="prava">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2>Vaša prava</h2>
      </div>
      <p>Prema Zakonu o zaštiti podataka o ličnosti (ZZPL) i GDPR-u, imate sledeća prava:</p>
      <div class="pp-rights">
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo pristupa</div>
          <div class="pp-right-card-desc">Možete zatražiti kopiju svih podataka koje imamo o vama</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo na ispravku</div>
          <div class="pp-right-card-desc">Možete zatražiti ispravku netačnih ili nepotpunih podataka</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo na brisanje</div>
          <div class="pp-right-card-desc">Možete zatražiti brisanje podataka, osim onih koje smo zakonski obavezni da čuvamo</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo na ograničenje</div>
          <div class="pp-right-card-desc">Možete zatražiti da privremeno prestanemo sa obradom vaših podataka</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo na prigovor</div>
          <div class="pp-right-card-desc">Možete se usprotiviti obradi u određenim slučajevima</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo na prenosivost</div>
          <div class="pp-right-card-desc">Možete zatražiti vaše podatke u mašinski čitljivom formatu</div>
        </div>
      </div>
      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>Kako ostvariti prava:</strong> Pošaljite email na <a href="mailto:escapii.team@gmail.com">escapii.team@gmail.com</a> sa naznakom „Zahtev za zaštitu podataka". Odgovorićemo u roku od 30 dana.<br><br>
          Ukoliko smatrate da vaša prava nisu zaštićena, možete podneti pritužbu <a href="https://www.poverenik.rs" target="_blank" rel="noopener">Povereniku za informacije od javnog značaja i zaštitu podataka o ličnosti</a>.
        </div>
      </div>
    </section>

    <!-- Bezbednost -->
    <section class="pp-section" id="bezbednost">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h2>Bezbednost podataka</h2>
      </div>
      <ul class="pp-list">
        <li><strong>HTTPS enkripcija</strong> - sva komunikacija između vašeg browsera i našeg servisa je šifrovana</li>
        <li><strong>Ograničen pristup</strong> - samo ovlašćene osobe imaju pristup podacima</li>
        <li><strong>Rate limiting</strong> - automatska zaštita od masovnih napada i zloupotrebe API-ja</li>
        <li><strong>Zaštićen admin pristup</strong> - admin panel dostupan isključivo autentikovanim korisnicima</li>
      </ul>
    </section>

    <!-- Kolacici -->
    <section class="pp-section" id="kolacici">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/></svg>
        </div>
        <h2>Kolačići (Cookies)</h2>
      </div>
      <p>Koristimo isključivo tehničke kolačiće neophodne za funkcionisanje sajta (npr. WordPress sesija za admin panel). Ne koristimo kolačiće za praćenje, profilisanje ili ciljano oglašavanje korisnika.</p>
      <p>Ukoliko u budućnosti dodamo analitiku (npr. Google Analytics 4), ažuriraćemo ovu politiku i prikazaćemo banner za saglasnost u skladu sa GDPR zahtevima.</p>
    </section>

    <!-- Izmene -->
    <section class="pp-section" id="izmene">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <h2>Izmene politike</h2>
      </div>
      <p>Možemo ažurirati ovu politiku kako bismo odrazili promene u načinu rada ili zakonskim obavezama. Datum poslednjeg ažuriranja uvek je prikazan na vrhu stranice.</p>
      <p>Za značajne izmene koje utiču na vaša prava, obavestićemo vas emailom ako imamo vašu adresu.</p>
    </section>

    <!-- Kontakt -->
    <section class="pp-section" id="kontakt">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </div>
        <h2>Kontakt</h2>
      </div>
      <div class="pp-contact">
        <h3>Imate pitanje o privatnosti?</h3>
        <p>Slobodno nam se obratite - odgovaramo u roku od 48 sati.</p>
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

<?php include get_template_directory() . '/inc/footer.php'; ?>

<?php wp_footer(); ?>
</body>
</html>
