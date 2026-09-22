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
  <p>Kako Escapii prikuplja, koristi i štiti vaše podatke i kako koristimo kolačiće.</p>
  <div class="pp-updated">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
    Poslednje ažuriranje: 22. septembra 2026.
  </div>
</div>

<!-- Main layout -->
<div class="pp-layout">

  <!-- TOC Sidebar -->
  <nav class="pp-toc">
    <div class="pp-toc-title">Sadržaj</div>
    <ul>
      <li><a href="#ko-smo-mi">Opšte informacije</a></li>
      <li><a href="#koji-podaci">Koje podatke prikupljamo</a></li>
      <li><a href="#zasto">Zašto koristimo podatke</a></li>
      <li><a href="#agencije">Escapii i partnerske agencije</a></li>
      <li><a href="#alati">Tehnološki i marketinški alati</a></li>
      <li><a href="#marketing">Marketing i promocije</a></li>
      <li><a href="#kolacici">Kolačići</a></li>
      <li><a href="#cuvanje">Koliko dugo čuvamo podatke</a></li>
      <li><a href="#deljenje">Sa kim delimo podatke</a></li>
      <li><a href="#bezbednost">Zaštita podataka</a></li>
      <li><a href="#prava">Vaša prava</a></li>
      <li><a href="#izmene">Izmene politike</a></li>
      <li><a href="#kontakt">Kontakt</a></li>
    </ul>
  </nav>

  <!-- Content -->
  <main class="pp-content">

    <!-- 1. Opste informacije -->
    <section class="pp-section" id="ko-smo-mi">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </div>
        <h2>Opšte informacije</h2>
      </div>
      <p>Ova Politika privatnosti objašnjava na koji način Escapii („Escapii“, „mi“, „nas“) prikuplja, koristi, čuva i štiti podatke o ličnosti korisnika platforme escapii.rs, kao i kako koristimo kolačiće i slične tehnologije.</p>
      <p>Escapii je digitalna platforma za putovanja iznenađenja koja povezuje putnike sa licenciranim partnerskim turističkim agencijama. Agencije organizuju i realizuju konkretna putovanja.</p>
      <p>Podatke o ličnosti obrađujemo u skladu sa Zakonom o zaštiti podataka o ličnosti Republike Srbije.</p>
      <?php $rk = esc_rukovalac(); ?>
      <div class="pp-controller">
        <div class="pp-controller-title">Rukovalac podacima</div>
        <p><strong><?php echo esc_html($rk['naziv']); ?></strong><br>
          <?php echo esc_html($rk['sediste']); ?><br>
          Matični broj: <?php echo esc_html($rk['mb']); ?> · PIB: <?php echo esc_html($rk['pib']); ?><br>
          E-mail za pitanja u vezi sa privatnošću: <a href="mailto:info@escapii.rs">info@escapii.rs</a></p>
      </div>
    </section>

    <!-- 2. Koje podatke prikupljamo -->
    <section class="pp-section" id="koji-podaci">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <h2>Koje podatke prikupljamo</h2>
      </div>
      <p>U zavisnosti od načina na koji koristite Escapii, možemo prikupljati:</p>
      <ul class="pp-list">
        <li><strong>Kontakt podatke:</strong> ime i prezime, e-mail adresu i broj telefona.</li>
        <li><strong>Podatke o putovanju:</strong> polazni aerodrom, termin, broj putnika, destinacije koje ste isključili i dodatne opcije.</li>
        <li><strong>Podatke o putnicima</strong> potrebne za rezervaciju leta i smeštaja: ime i prezime, pol, datum rođenja, zemlju izdavanja i broj pasoša i, ako ih navedete, informacije o vizama.</li>
        <li><strong>Adresu i telefon za dostavu</strong>, ako ste izabrali Reveal Box.</li>
        <li><strong>Podatke o poklonu:</strong> ime i e-mail osobe kojoj poklanjate putovanje ili vaučer i poruku za nju.</li>
        <li><strong>Sadržaj vaših poruka:</strong> upite, napomene i komunikaciju sa našim timom.</li>
        <li><strong>E-mail adresu</strong>, ako se prijavite da vas obavestimo o pokretanju sajta ili o novim terminima.</li>
        <li><strong>Tehničke podatke</strong> o uređaju i korišćenju sajta, kao što su IP adresa, tip uređaja i pregledača i podaci o poseti.</li>
        <li><strong>Podatke prikupljene putem kolačića</strong> i sličnih tehnologija (videti odeljak <a href="#kolacici">Kolačići</a>).</li>
      </ul>
      <p>Ne prikupljamo više podataka nego što je potrebno za konkretnu svrhu obrade. Ne prikupljamo podatke o platnim karticama: uplatu vršite direktno partnerskoj turističkoj agenciji.</p>

      <h3>Važne napomene</h3>
      <ul class="pp-list">
        <li><strong>Obavezni podaci:</strong> podaci označeni kao obavezni u formi za rezervaciju potrebni su za organizaciju putovanja. Bez njih rezervaciju ne možemo da obradimo.</li>
        <li><strong>Podaci drugih osoba:</strong> kada rezervišete putovanje za više putnika ili ga nekome poklanjate, unosite i podatke drugih osoba. Time potvrđujete da imate pravo da nam ih dostavite i da ćete te osobe upoznati sa ovom Politikom privatnosti.</li>
        <li><strong>Deca:</strong> preko sajta se mogu rezervisati putovanja samo za punoletne putnike. Putovanja sa decom organizujemo na direktan upit roditelja ili staratelja, koji nam tada dostavlja i podatke deteta.</li>
        <li><strong>Podaci o zdravlju:</strong> ne tražimo ih. Ako nam ih sami navedete, na primer zbog posebnih potreba na putovanju, koristimo ih samo za organizaciju tog putovanja.</li>
      </ul>
    </section>

    <!-- 3. Zasto koristimo podatke -->
    <section class="pp-section" id="zasto">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <h2>Zašto koristimo vaše podatke</h2>
      </div>
      <p>Vaše podatke koristimo za sledeće svrhe, na osnovu pravnih osnova predviđenih Zakonom o zaštiti podataka o ličnosti:</p>
      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Svrha</th><th>Pravni osnov</th></tr>
          </thead>
          <tbody>
            <tr><td>Obrada upita i rezervacije, organizacija putovanja i komunikacija sa vama pre, tokom i nakon putovanja</td><td>Izvršenje ugovora, odnosno radnje pre zaključenja ugovora na vaš zahtev</td></tr>
            <tr><td>Ispunjavanje zakonskih obaveza</td><td>Zakonska obaveza</td></tr>
            <tr><td>Bezbednost platforme, sprečavanje zloupotreba i zaštita naših prava</td><td>Legitimni interes</td></tr>
            <tr><td>Unapređenje platforme, korisničkog iskustva i naših usluga</td><td>Legitimni interes</td></tr>
            <tr><td>Analiza korišćenja platforme (analitički kolačići)</td><td>Saglasnost</td></tr>
            <tr><td>Merenje uspešnosti oglašavanja (marketinški kolačići)</td><td>Saglasnost</td></tr>
            <tr><td>Slanje obaveštenja na koja ste se prijavili (pokretanje sajta, novi termini) i promotivnih poruka</td><td>Saglasnost</td></tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- 4. Escapii i partnerske agencije -->
    <section class="pp-section" id="agencije">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
        </div>
        <h2>Escapii i partnerske turističke agencije</h2>
      </div>
      <p>Escapii i partnerska turistička agencija imaju različite uloge.</p>
      <p>Escapii je digitalna i marketinška platforma. Podatke koristimo za upravljanje platformom, komunikaciju sa vama, korisničko iskustvo, marketing, analitiku i organizaciju Escapii iskustva.</p>
      <p>Partnerska turistička agencija organizuje i realizuje vaše putovanje. Od nas dobija podatke koji su joj za to potrebni: podatke o putnicima (uključujući podatke iz pasoša), termin i izabrane opcije. Agencija ih koristi za rezervaciju letova i smeštaja, zaključivanje i izvršenje ugovora o putovanju, naplatu, izdavanje dokumentacije i ispunjavanje svojih zakonskih obaveza, i za tu obradu odgovara kao rukovalac. Radi rezervacije, podatke putnika prosleđuje avio-kompanijama i smeštajnim objektima.</p>
      <p>Podaci koje dostavljamo agenciji ne koriste se za njene sopstvene marketinške aktivnosti, osim ako za to postoji poseban osnov i vaša saglasnost.</p>
    </section>

    <!-- 5. Tehnoloski i marketinski alati -->
    <section class="pp-section" id="alati">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
        </div>
        <h2>Tehnološki i marketinški alati</h2>
      </div>
      <p>Za rad platforme, komunikaciju, analitiku i oglašavanje koristimo pružaoce usluga kojima podatke dostavljamo samo u meri potrebnoj za uslugu koju nam pružaju:</p>
      <ul class="pp-list">
        <li><strong>hosting i infrastruktura:</strong> serveri u Evropskoj uniji i zaštita sajta od napada;</li>
        <li><strong>e-mail:</strong> slanje poruka o vašoj rezervaciji i poslovna e-pošta;</li>
        <li><strong>HubSpot:</strong> analitika posećenosti i upravljanje komunikacijom sa korisnicima (CRM);</li>
        <li><strong>Google Analytics 4 i Google Tag Manager:</strong> analitika korišćenja platforme i upravljanje ovim alatima;</li>
        <li><strong>Google Ads i Meta (Instagram, Facebook):</strong> oglašavanje i merenje rezultata oglasa.</li>
      </ul>
      <p>Ovi servisi mogu obrađivati određene tehničke i druge podatke u skladu sa svojim pravilima privatnosti. Analitički i marketinški alati aktiviraju se samo ako ih dozvolite u podešavanjima kolačića.</p>

      <h3>Prenos podataka van Srbije</h3>
      <p>Neki od ovih pružalaca usluga, na primer Google, Meta i HubSpot, imaju sedište ili servere van Srbije, uključujući Sjedinjene Američke Države. Podatke im prenosimo samo u skladu sa Zakonom o zaštiti podataka o ličnosti, uz mere zaštite predviđene ugovorima sa tim pružaocima usluga.</p>
    </section>

    <!-- 6. Marketing -->
    <section class="pp-section" id="marketing">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
        </div>
        <h2>Marketing i promotivne komunikacije</h2>
      </div>
      <p>Ako date saglasnost, na primer prijavom na listu za obaveštenja, možemo vam slati informacije o pokretanju sajta, novim putovanjima, ponudama i promocijama.</p>
      <p>Saglasnost možete povući u bilo kom trenutku. Od promotivnih poruka možete se odjaviti putem linka za odjavu u samoj poruci ili slanjem zahteva na <a href="mailto:info@escapii.rs">info@escapii.rs</a>.</p>
      <p>Poruke vezane za vašu rezervaciju, kao što su potvrde i informacije o putovanju, nisu promotivne i šaljemo ih bez posebne saglasnosti.</p>
    </section>

    <!-- 7. Kolacici -->
    <section class="pp-section" id="kolacici">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/></svg>
        </div>
        <h2>Kolačići (Cookies)</h2>
      </div>

      <style>
        .pp-cookie-table { width:100%; border-collapse:collapse; margin:14px 0 18px; font-size:14px; }
        .pp-cookie-table th, .pp-cookie-table td { text-align:left; padding:10px 12px; border-bottom:1px solid rgba(0,0,0,.1); vertical-align:top; }
        .pp-cookie-table th { font-weight:700; font-size:12px; letter-spacing:.04em; text-transform:uppercase; opacity:.7; }
        .pp-cookie-table code { font-size:13px; overflow-wrap:anywhere; }
        .pp-cookie-wrap { overflow-x:auto; }
      </style>

      <p>Kolačići su male tekstualne datoteke koje se čuvaju na vašem uređaju kada posetite internet stranicu. Escapii koristi kolačiće i slične tehnologije (lokalno skladište pregledača) kako bi platforma pravilno funkcionisala, kako bismo razumeli način na koji se escapii.rs koristi i, uz vaš izbor, merili i unapređivali naše oglašavanje.</p>

      <h3>Neophodni kolačići</h3>
      <p>Potrebni su za osnovno funkcionisanje platforme: pamćenje vaših podešavanja, čuvanje započete rezervacije, bezbednost i sprečavanje zloupotrebe. Za njih se saglasnost ne traži i ne mogu se isključiti putem banera za kolačiće, jer bez njih sajt ne radi.</p>
      <div class="pp-cookie-wrap">
      <table class="pp-cookie-table">
        <tr><th>Naziv</th><th>Svrha</th><th>Trajanje</th></tr>
        <tr><td><code>esc_consent</code></td><td>Pamti vaš izbor o kolačićima</td><td>12 meseci</td></tr>
        <tr><td><code>esc-lang</code></td><td>Pamti izabrani jezik (srpski ili engleski)</td><td>12 meseci</td></tr>
        <tr><td><code>esc_booking_draft_v2</code><br><small>(sessionStorage)</small></td><td>Čuva započetu rezervaciju, da se unos ne izgubi ako osvežite stranicu</td><td>4 sata ili do zatvaranja kartice</td></tr>
        <tr><td><code>esc_bp</code><br><small>(sessionStorage)</small></td><td>Prenosi podatke o rezervaciji na stranicu potvrde</td><td>Do zatvaranja kartice</td></tr>
      </table>
      </div>

      <h3>Analitički kolačići (uz vašu saglasnost)</h3>
      <p>Koristimo Google Analytics 4, preko Google Tag Manager-a, i HubSpot, kako bismo razumeli koje stranice i funkcionalnosti se najviše koriste, uočili probleme na platformi i unapredili korisničko iskustvo. Ovi alati se ne učitavaju dok ih ne dozvolite.</p>
      <div class="pp-cookie-wrap">
      <table class="pp-cookie-table">
        <tr><th>Naziv</th><th>Svrha</th><th>Trajanje</th></tr>
        <tr><td><code>_ga</code></td><td>Google Analytics: razlikuje posetioce</td><td>2 godine</td></tr>
        <tr><td><code>_ga_*</code></td><td>Google Analytics: održava stanje posete</td><td>2 godine</td></tr>
        <tr><td><code>__hstc</code></td><td>HubSpot: praćenje posetilaca</td><td>6 meseci</td></tr>
        <tr><td><code>hubspotutk</code></td><td>HubSpot: prepoznavanje posetioca pri slanju formi</td><td>6 meseci</td></tr>
        <tr><td><code>__hssc</code></td><td>HubSpot: praćenje sesije</td><td>30 minuta</td></tr>
        <tr><td><code>__hssrc</code></td><td>HubSpot: prepoznavanje nove sesije</td><td>Do zatvaranja pregledača</td></tr>
      </table>
      </div>
      <p>Više o obradi podataka: <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google politika privatnosti</a> i <a href="https://legal.hubspot.com/privacy-policy" target="_blank" rel="noopener">HubSpot politika privatnosti</a>.</p>

      <h3>Marketinški kolačići (uz vašu saglasnost)</h3>
      <p>U zavisnosti od vaših podešavanja, možemo koristiti tehnologije za merenje i optimizaciju oglašavanja, kao što su Google Ads i Meta Pixel (Instagram, Facebook). One omogućavaju merenje interakcije sa našim oglasima, konverzija i aktivnosti nakon klika na oglas. Aktiviraju se samo ako dozvolite marketinške kolačiće i tada mogu postaviti kolačiće kao što su:</p>
      <div class="pp-cookie-wrap">
      <table class="pp-cookie-table">
        <tr><th>Naziv</th><th>Svrha</th><th>Trajanje</th></tr>
        <tr><td><code>_gcl_au</code></td><td>Google Ads: merenje konverzija</td><td>90 dana</td></tr>
        <tr><td><code>_fbp</code></td><td>Meta: merenje rezultata oglasa</td><td>90 dana</td></tr>
      </table>
      </div>
      <p>Više o obradi podataka: <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google politika privatnosti</a> i <a href="https://www.facebook.com/privacy/policy/" target="_blank" rel="noopener">Meta politika privatnosti</a>.</p>

      <h3>Sadržaj trećih strana</h3>
      <p>Radi prikaza sajta učitavamo i fontove i skripte sa javnih servisa (na primer Google Fonts), koji pri tome vide vašu IP adresu, ali ne postavljaju kolačiće. Kada su na stranici prikazane objave sa Instagrama, Meta može postaviti svoje kolačiće u skladu sa svojim pravilima privatnosti.</p>

      <h3>Kako da promenite izbor</h3>
      <p>Pri prvoj poseti birate koje kategorije kolačića prihvatate, osim neophodnih. Izbor pamtimo 12 meseci i možete ga promeniti u bilo kom trenutku putem opcije <a href="javascript:void(0)" onclick="if(window.escOpenCookieSettings)escOpenCookieSettings()">Podešavanja kolačića</a>, koja se nalazi i u podnožju sajta. Kolačiće možete blokirati ili obrisati i u podešavanjima pregledača, ali isključivanje pojedinih kolačića može uticati na rad sajta.</p>
      <p>Povlačenje saglasnosti je jednako jednostavno kao i njeno davanje i ne utiče na zakonitost obrade pre povlačenja.</p>
    </section>

    <!-- 8. Cuvanje -->
    <section class="pp-section" id="cuvanje">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h2>Koliko dugo čuvamo podatke</h2>
      </div>
      <p>Podatke čuvamo samo onoliko dugo koliko je potrebno za svrhu za koju su prikupljeni, odnosno koliko je potrebno radi ispunjavanja zakonskih obaveza.</p>
      <ul class="pp-list">
        <li><strong>Podaci o rezervacijama i realizovanim putovanjima</strong> čuvaju se tokom perioda potrebnog za ispunjavanje zakonskih, računovodstvenih i drugih obaveza.</li>
        <li><strong>Broj pasoša</strong> u našoj bazi čuvamo šifrovan i brišemo ga 30 dana nakon povratka sa putovanja.</li>
        <li><strong>Podaci za promotivne komunikacije</strong> čuvaju se do povlačenja saglasnosti ili odjave, osim ako postoji drugi zakonski osnov za njihovo čuvanje.</li>
        <li><strong>E-mail za obaveštenje o novim terminima</strong> čuvamo dok vam ne pošaljemo obaveštenje.</li>
        <li><strong>Kolačići</strong> se čuvaju onoliko koliko je navedeno u odeljku <a href="#kolacici">Kolačići</a>.</li>
      </ul>
      <p>Kada podaci više nisu potrebni, brišemo ih, anonimizujemo ili na drugi odgovarajući način prestajemo da ih obrađujemo.</p>
    </section>

    <!-- 9. Sa kim delimo podatke -->
    <section class="pp-section" id="deljenje">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
        </div>
        <h2>Sa kim delimo podatke</h2>
      </div>
      <p>Podatke činimo dostupnim samo kada je to potrebno za ostvarivanje svrhe obrade, i to:</p>
      <ul class="pp-list">
        <li>partnerskoj turističkoj agenciji koja realizuje vaše putovanje;</li>
        <li>pružaocima tehnoloških usluga koje koristimo (videti odeljak <a href="#alati">Tehnološki i marketinški alati</a>);</li>
        <li>dostavnoj službi, ako ste izabrali Reveal Box;</li>
        <li>pružaocima računovodstvenih, pravnih i drugih profesionalnih usluga, kada je to potrebno;</li>
        <li>nadležnim organima, kada smo na to obavezani zakonom.</li>
      </ul>
      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">Escapii ne prodaje podatke korisnika trećim licima.</div>
      </div>
    </section>

    <!-- 10. Zastita podataka -->
    <section class="pp-section" id="bezbednost">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h2>Zaštita podataka</h2>
      </div>
      <p>Preduzimamo odgovarajuće tehničke i organizacione mere radi zaštite podataka od neovlašćenog pristupa, gubitka, zloupotrebe, izmene ili uništenja:</p>
      <ul class="pp-list">
        <li>sva komunikacija sa sajtom je šifrovana (HTTPS);</li>
        <li>brojevi pasoša se u našoj bazi čuvaju šifrovani;</li>
        <li>pristup podacima imaju samo lica i pružaoci usluga kojima je to potrebno za obavljanje njihovih zadataka.</li>
      </ul>
    </section>

    <!-- 11. Prava -->
    <section class="pp-section" id="prava">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2>Vaša prava</h2>
      </div>
      <p>U skladu sa Zakonom o zaštiti podataka o ličnosti, imate sledeća prava:</p>
      <div class="pp-rights">
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo pristupa</div>
          <div class="pp-right-card-desc">Možete zatražiti pristup podacima koje imamo o vama i njihovu kopiju</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo na ispravku</div>
          <div class="pp-right-card-desc">Možete zatražiti ispravku netačnih ili nepotpunih podataka</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo na brisanje</div>
          <div class="pp-right-card-desc">Možete zatražiti brisanje podataka kada su za to ispunjeni zakonski uslovi</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo na ograničenje</div>
          <div class="pp-right-card-desc">Možete zatražiti da ograničimo obradu vaših podataka</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo na prigovor</div>
          <div class="pp-right-card-desc">Možete uložiti prigovor na obradu zasnovanu na legitimnom interesu i na direktni marketing</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Pravo na prenosivost</div>
          <div class="pp-right-card-desc">Možete zatražiti svoje podatke u mašinski čitljivom obliku, kada su za to ispunjeni zakonski uslovi</div>
        </div>
        <div class="pp-right-card">
          <div class="pp-right-card-title">Povlačenje saglasnosti</div>
          <div class="pp-right-card-desc">Saglasnost možete povući u bilo kom trenutku, bez uticaja na zakonitost obrade pre povlačenja</div>
        </div>
      </div>
      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>Kako ostvariti prava:</strong> pošaljite e-mail na <a href="mailto:info@escapii.rs">info@escapii.rs</a> sa naznakom „Zahtev za zaštitu podataka“. Odgovorićemo bez odlaganja, a najkasnije u roku od 30 dana.<br><br>
          <strong>Pravo na pritužbu:</strong> ako smatrate da je došlo do povrede vaših prava u vezi sa zaštitom podataka o ličnosti, možete se obratiti <a href="https://www.poverenik.rs" target="_blank" rel="noopener">Povereniku za informacije od javnog značaja i zaštitu podataka o ličnosti</a>.
        </div>
      </div>
    </section>

    <!-- 12. Izmene -->
    <section class="pp-section" id="izmene">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <h2>Izmene politike</h2>
      </div>
      <p>Ovu Politiku privatnosti povremeno ažuriramo, kako bi odražavala promene u načinu na koji koristimo podatke, u našim uslugama ili u propisima. Važeća verzija, sa datumom poslednjeg ažuriranja, uvek je dostupna na ovoj stranici.</p>
    </section>

    <!-- 13. Kontakt -->
    <section class="pp-section" id="kontakt">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </div>
        <h2>Kontakt</h2>
      </div>
      <div class="pp-contact">
        <h3>Imate pitanje o privatnosti?</h3>
        <p>Za sva pitanja, zahteve ili prigovore u vezi sa obradom podataka o ličnosti pišite nam.</p>
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

<script>var lang = 'sr';</script>
<?php $_COOKIE['esc-lang'] = 'sr'; include get_template_directory() . '/inc/footer.php'; ?>

<?php wp_footer(); ?>
</body>
</html>
