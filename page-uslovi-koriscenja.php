<?php
/**
 * Template Name: Uslovi koriscenja
 */
?>
<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Uslovi korišćenja — Escapii</title>
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
        <span class="pp-lang-btn on">SR</span>
        <a href="<?php echo home_url('/terms-of-use'); ?>" class="pp-lang-btn">EN</a>
      </div>
      <a href="<?php echo home_url('/'); ?>" class="pp-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Nazad na sajt
      </a>
    </div>
  </div>
</header>

<!-- Hero -->
<div class="pp-hero">
  <div class="pp-hero-badge">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    Pravni dokument
  </div>
  <h1>Uslovi korišćenja</h1>
  <p>Pročitajte uslove pre nego što pošaljete upit — korišćenjem platforme prihvatate ova pravila.</p>
  <div class="pp-updated">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
    Poslednje ažuriranje: Maj 2026 · v2 (poklon vaučeri, privatni termini)
  </div>
</div>

<!-- Main layout -->
<div class="pp-layout">

  <!-- TOC -->
  <nav class="pp-toc">
    <div class="pp-toc-title">Sadržaj</div>
    <ul>
      <li><a href="#ko-smo">Ko smo i šta radimo</a></li>
      <li><a href="#kako-funkcionise">Kako funkcioniše Escapii</a></li>
      <li><a href="#proces-rezervacije">Proces rezervacije</a></li>
      <li><a href="#cene-i-placanje">Cene i plaćanje</a></li>
      <li><a href="#poklon-vauceri">Poklon vaučeri</a></li>
      <li><a href="#privatni-termini">Privatni termini</a></li>
      <li><a href="#obaveze-putnika">Obaveze putnika</a></li>
      <li><a href="#otkaz-i-izmene">Otkaz i izmene</a></li>
      <li><a href="#odgovornost">Ograničenje odgovornosti</a></li>
      <li><a href="#viza-i-dokumenti">Viza i dokumenti</a></li>
      <li><a href="#spor">Rešavanje sporova</a></li>
      <li><a href="#izmene-uslova">Izmene uslova</a></li>
      <li><a href="#kontakt">Kontakt</a></li>
    </ul>
  </nav>

  <!-- Content -->
  <main class="pp-content">

    <!-- Ko smo -->
    <section class="pp-section" id="ko-smo">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </div>
        <h2>Ko smo i šta radimo</h2>
      </div>

      <p><strong>Escapii</strong> je digitalna platforma za organizaciju iznenađujućih putovanja. Korisnik bira aerodrom, datume, broj putnika i preferencije — mi pronalazimo i organizujemo putovanje.</p>
      <p>Escapii <strong>nije turistička agencija</strong> i ne nastupa kao licencirani organizator putovanja. Nastupamo kao <strong>subagent</strong> partnerske turističke agencije koja u potpunosti odgovara za realizaciju aranžmana.</p>
    </section>

    <!-- Kako funkcionise -->
    <section class="pp-section" id="kako-funkcionise">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <h2>Kako funkcioniše Escapii</h2>
      </div>

      <p>Escapii je platforma za <strong>iznenađujuća putovanja</strong> — korisnik ne bira destinaciju, već bira aerodrom polaska, period putovanja i svoje preferencije. Destinacija ostaje tajna sve do otkrića koje se šalje emailom <strong>48 sata pre polaska</strong>.</p>

      <h3>Koncept iznenađenja</h3>
      <ul class="pp-list">
        <li><strong>Korisnik bira:</strong> aerodrom, datume, broj putnika, tip smeštaja, dodaci (osiguranje, doručak, sedišta zajedno, prtljag) i do 5 destinacija koje želi isključiti</li>
        <li><strong>Escapii bira destinaciju</strong> iz skupa odgovarajućih letova koji nisu isključeni</li>
        <li><strong>Destinacija se otkriva</strong> korisniku emailom 48 sata pre polaska</li>
        <li>Slanjem upita korisnik <strong>prihvata iznenađenje kao sastavni deo usluge</strong> i ne može zahtevati promenu destinacije nakon potvrde rezervacije</li>
      </ul>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          Isključivanjem destinacija putem platforme korisnik može smanjiti broj mogućih destinacija, ali Escapii ne garantuje da će putovanje biti u neku konkretnu destinaciju niti isključuje svaku moguću lokaciju koju korisnik ne bi voleo.
        </div>
      </div>
    </section>

    <!-- Proces rezervacije -->
    <section class="pp-section" id="proces-rezervacije">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <h2>Proces rezervacije</h2>
      </div>

      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Korak</th><th>Opis</th></tr>
          </thead>
          <tbody>
            <tr><td>1. Upit</td><td>Korisnik popunjava formu na sajtu i šalje upit. Dobija automatsku potvrdu prijema na email.</td></tr>
            <tr><td>2. Pregled</td><td>Tim Escapii-ja proverava dostupnost i cenu. Upit nije obavezujući za korisnika dok ne dođe do potvrde i uplate.</td></tr>
            <tr><td>3. Potvrda i uplata</td><td>Korisnik prima email sa detaljima rezervacije i uputstvom za uplatu. Rezervacija se smatra zaključenom tek po prijemu uplate.</td></tr>
            <tr><td>4. Otkrivanje</td><td>48 sata pre polaska korisnik prima email sa destinacijom, linkom za vremensku prognozu i svim relevantnim informacijama.</td></tr>
          </tbody>
        </table>
      </div>

      <p>Slanjem upita korisnik <strong>ne zaključuje ugovor</strong> niti preuzima finansijsku obavezu. Ugovorni odnos nastaje <strong>isključivo uplatom avansa</strong> nakon pisane potvrde rezervacije.</p>
    </section>

    <!-- Cene i placanje -->
    <section class="pp-section" id="cene-i-placanje">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <h2>Cene i plaćanje</h2>
      </div>

      <p>Cene prikazane na platformi tokom unosa upita su <strong>okvirne i informativnog karaktera</strong>. Tačna cena se utvrđuje u trenutku provere dostupnosti i šalje se korisniku u potvrdi rezervacije, pre bilo kakve uplate.</p>

      <h3>Struktura cene</h3>
      <ul class="pp-list">
        <li>Osnovna cena aranžmana po osobi (let + smeštaj)</li>
        <li>Doplata za tip smeštaja (Superior ili Premium, po potrebi)</li>
        <li>Dodaci koje je korisnik odabrao: putno osiguranje, doručak, sedišta zajedno, kabinski kofer</li>
        <li>Naknada za isključivanje destinacija (1. isključivanje je besplatno — svako naredno +15€ po osobi)</li>
      </ul>

      <h3>Načini plaćanja</h3>
      <p>Plaćanje se vrši isključivo <strong>bankovnim transferom</strong> prema uputama koje se dostavljaju u potvrdi rezervacije. Escapii ne prikuplja podatke o platnim karticama.</p>

      <h3>Korekcija cene</h3>
      <p>U izuzetnim slučajevima (značajne promene cena goriva, deviznog kursa ili poreza), cena aranžmana može biti izmenjena pre zaključenja uplate. U tom slučaju korisnik biće pismeno obavešten i može odustati bez naknade.</p>
    </section>

    <!-- Poklon vauceri -->
    <section class="pp-section" id="poklon-vauceri">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
        </div>
        <h2>Poklon vaučeri</h2>
      </div>

      <p>Escapii nudi mogućnost kupovine <strong>poklon vaučera</strong> koji primalac može iskoristiti pri rezervaciji Escapii putovanja. Kupovinom vaučera prihvatate uslove navedene u ovoj sekciji.</p>

      <h3>Kako funkcioniše poklon vaučer</h3>
      <ul class="pp-list">
        <li>Vaučer se kupuje na stranici <strong>Poklon</strong> na sajtu escapii.rs odabirom željenog iznosa i unosom podataka o primaocu</li>
        <li>Nakon potvrde uplate, kupac dobija <strong>PDF vaučer</strong> (boarding pass dizajn) na email sa jedinstvenim kodom</li>
        <li>Vaučer se aktivira u trenutku kada Escapii tim potvrdi uplatu — od tog datuma počinje da teče rok važenja</li>
        <li>Primalac unosi kod vaučera pri slanju upita za Escapii putovanje; iznos vaučera se <strong>oduzima od ukupne cene</strong> aranžmana</li>
        <li>Vaučer se može iskoristiti na <strong>grupnom i privatnom terminu</strong></li>
      </ul>

      <h3>Rok važenja i uslovi korišćenja</h3>
      <ul class="pp-list">
        <li>Vaučer važi <strong>godinu dana od datuma aktivacije</strong> (ne od datuma kupovine)</li>
        <li>Po isteku roka, vaučer postaje nevažeći i ne može se koristiti</li>
        <li>Na jednu rezervaciju može se primeniti <strong>jedan vaučer</strong></li>
        <li>Ako je vrednost putovanja manja od iznosa vaučera, <strong>razlika se ne vraća</strong> niti prenosi</li>
        <li>Ako je vrednost putovanja veća od iznosa vaučera, razlika se plaća standardnim putem</li>
      </ul>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>Otkaz rezervacije:</strong> Ako korisnik otkaže rezervaciju na kojoj je primenjen vaučer, vaučer se automatski <strong>vraća u aktivno stanje</strong> (uz sva preostala prava iz prvobitnog roka važenja). Iznos uplate koji prevazilazi vrednost vaučera podleže standardnoj politici otkaza.
        </div>
      </div>

      <div class="pp-warning">
        <div class="pp-warning-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="pp-warning-text">
          <strong>Vaučer se ne može razmeniti za gotovinu</strong> niti delimično refundirati. Jednom aktiviran vaučer nije prenosiv na drugu osobu.
        </div>
      </div>
    </section>

    <!-- Privatni termini -->
    <section class="pp-section" id="privatni-termini">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h2>Privatni termini</h2>
      </div>

      <p>Pored redovnih grupnih termina, Escapii nudi mogućnost organizacije <strong>privatnog putovanja</strong> za grupe koje ne mogu da nađu odgovarajući datum u standardnoj ponudi ili koje žele ekskluzivni aranžman.</p>

      <h3>Proces privatnog termina</h3>
      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead><tr><th>Korak</th><th>Opis</th></tr></thead>
          <tbody>
            <tr><td>1. Upit</td><td>Korisnik u booking formi odabira opciju <strong>Privatni termin</strong>, unosi željeni period i broj putnika i šalje upit.</td></tr>
            <tr><td>2. Ponuda</td><td>Escapii tim proverava dostupnost i u roku od 24–48h šalje individualizovanu cenovnu ponudu.</td></tr>
            <tr><td>3. Potvrda</td><td>Korisnik prihvata ponudu i vrši uplatu prema dogovorenom roku. Rezervacija postaje obavezujuća tek po prijemu uplate.</td></tr>
            <tr><td>4. Otkrivanje</td><td>Destinacija se otkriva 48h pre polaska, jednako kao i kod grupnih termina.</td></tr>
          </tbody>
        </table>
      </div>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          Na privatne termine primenjuju se isti uslovi otkaza i izmena kao i na grupne aranžmane (videti sekciju <a href="#otkaz-i-izmene">Otkaz i izmene</a>). Cena privatnog termina formira se individualno i može se razlikovati od cena u standardnoj ponudi.
        </div>
      </div>
    </section>

    <!-- Obaveze putnika -->
    <section class="pp-section" id="obaveze-putnika">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <h2>Obaveze putnika</h2>
      </div>

      <p>Korisnik je odgovoran za tačnost i potpunost svih unetih podataka. Netačni podaci mogu dovesti do nemogućnosti realizacije putovanja ili dodatnih troškova koje snosi isključivo korisnik.</p>

      <h3>Korisnik je obavezan da:</h3>
      <ul class="pp-list">
        <li>Unese <strong>tačno ime i prezime svakog putnika</strong> onako kako stoji u putnom dokumentu koji će se koristiti za putovanje</li>
        <li>Unese <strong>tačan datum rođenja</strong> svakog putnika</li>
        <li>Proveri <strong>rok važnosti putnog dokumenta</strong> — pasoš mora biti važeći najmanje 6 meseci nakon datuma povratka</li>
        <li>U polju <strong>Napomene</strong> pri slanju upita naglasi ukoliko mu je potrebna viza za neku od potencijalnih destinacija, ili ukoliko poseduje aktivnu vizu za određene države (za sve putnike, ne samo nosioca rezervacije) — ovo nam omogućava da prilagodimo izbor destinacije</li>
        <li>Pravovremeno uplati avans i ostatak iznosa prema dogovorenim rokovima</li>
        <li>Stigne na aerodrom u vreme koje odredi avio kompanija (najkasnije 2 sata pre polaska za evropske letove)</li>
        <li><strong>Samostalno izvrši check-in</strong> kod avio kompanije nakon što primi obaveštenje o destinaciji (48h pre polaska) — Escapii dostavlja booking kod avio kompanije putem reveal linka, a svaki putnik je odgovoran da se prijavi za let na vreme i u skladu sa uslovima prevoznika</li>
      </ul>

      <div class="pp-warning">
        <div class="pp-warning-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div class="pp-warning-text">
          <strong>Vize i dokumenta:</strong> Budući da destinacija ostaje tajna do 48 sata pre polaska, korisnik je dužan da pri slanju upita u polju <strong>Napomene</strong> navede: (1) za koje države putnici poseduju aktivnu vizu, i (2) ukoliko nekom od putnika može biti potrebna viza za određene destinacije. Na osnovu tih informacija Escapii prilagođava izbor destinacije. Korisnik snosi isključivu odgovornost za putne isprave svih putnika na rezervaciji.
        </div>
      </div>
    </section>

    <!-- Otkaz i izmene -->
    <section class="pp-section" id="otkaz-i-izmene">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
        </div>
        <h2>Otkaz i izmene rezervacije</h2>
      </div>

      <p>Na otkaz i izmene aranžmana primenjuju se uslovi partnerske turističke agencije koja realizuje putovanje. Sledeće je okvirni pregled — tačne uslove možete dobiti od Escapii tima na <a href="mailto:escapii.team@gmail.com" style="color:var(--accent);text-decoration:none;">escapii.team@gmail.com</a>.</p>

      <div class="pp-table-wrap">
        <table class="pp-table">
          <thead>
            <tr><th>Vremenski period pre polaska</th><th>Naknada za otkaz</th></tr>
          </thead>
          <tbody>
            <tr><td>Pre uplate avansa</td><td>Bez troškova — upit nije obavezujuć</td></tr>
            <tr><td>Nakon uplate avansa, više od 30 dana pre polaska</td><td>Zadržava se avans</td></tr>
            <tr><td>15–30 dana pre polaska</td><td>Deo ukupne cene</td></tr>
            <tr><td>Manje od 15 dana pre polaska</td><td>Celokupan iznos može biti zadržan</td></tr>
          </tbody>
        </table>
      </div>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          <strong>Preporuka:</strong> Ukoliko postoji mogućnost da ćete morati da otkažete putovanje, toplo preporučujemo kupovinu <strong>putnog osiguranja sa pokrićem za otkaz</strong> koje je dostupno kao opcija pri rezervaciji.
        </div>
      </div>

      <h3>Izmena rezervacije</h3>
      <p><strong>Nakon potvrde rezervacije izmene nisu moguće.</strong> Potvrdom rezervacije korisnik prihvata sve uslove putovanja (destinacija, datumi, broj putnika, tip smeštaja i dodaci) kao konačne. Jedina opcija nakon potvrde je otkaz rezervacije uz primenu odgovarajuće naknade prema tabeli iznad.</p>

      <h3>Otkaz od strane organizatora</h3>
      <p>U slučaju otkazivanja putovanja od strane organizatora iz razloga koji nisu na strani korisnika, korisniku se vraća celokupan uplaćen iznos ili se nudi alternativni aranžman odgovarajuće vrednosti.</p>
    </section>

    <!-- Odgovornost -->
    <section class="pp-section" id="odgovornost">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2>Ograničenje odgovornosti</h2>
      </div>

      <h3>Odgovornost Escapii</h3>
      <p>Escapii je odgovoran isključivo za pravilno funkcionisanje digitalne platforme — prikupljanje upita i komunikaciju sa korisnikom. Escapii nije odgovoran za:</p>
      <ul class="pp-list">
        <li>Realizaciju turističkog aranžmana — ovo je odgovornost partnerske agencije koja organizuje putovanje</li>
        <li>Kvalitet letova, smeštaja ili pratećih usluga</li>
        <li>Kašnjenja, otkazivanja ili izmene letova od strane avio kompanija</li>
        <li>Vanredne okolnosti (prirodne katastrofe, epidemije, ratna dešavanja, štrajkovi)</li>
        <li>Posledice netačnih podataka koje je korisnik uneo u formu</li>
        <li>Nemogućnost ulaska u zemlju zbog nedostatka odgovarajućih dokumenata ili vize</li>
      </ul>

      <h3>Odgovornost korisnika</h3>
      <p>Korisnik je finansijski odgovoran za sve troškove nastale usled netačnih ili nepotpunih podataka koje je dostavio pri popunjavanju upita, kao i za posledice propuštanja rokova uplate.</p>

      <h3>Viša sila</h3>
      <p>Escapii nije odgovoran za neispunjenje obaveza prouzrokovano okolnostima koje nisu mogle biti predviđene niti sprečene (viša sila), uključujući ali ne ograničavajući se na: prirodne nepogode, epidemije, ratna dešavanja, vladine odluke o zabrani putovanja i slično.</p>
    </section>

    <!-- Viza i dokumenti -->
    <section class="pp-section" id="viza-i-dokumenti">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
        <h2>Viza i putni dokumenti</h2>
      </div>

      <p>Korisnik je <strong>isključivo odgovoran</strong> za pribavljanje svih potrebnih putnih dokumenata, viza i zdravstvenih potvrda koje zahteva destinacija. Konačna odgovornost leži na putniku.</p>

      <h3>Minimalni zahtevi</h3>
      <ul class="pp-list">
        <li><strong>Pasoš</strong> mora biti važeći najmanje 6 meseci nakon datuma povratka</li>
        <li>Za putovnike sa srpskim pasošem — provera potrebe za vizom za sve potencijalne destinacije u okviru ponude</li>
        <li>Deca moraju imati sopstveni putni dokument</li>
      </ul>

      <div class="pp-notice">
        <div class="pp-notice-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="pp-notice-text">
          Aktuelne informacije o viznim uslovima za nosioce srpskog pasoša dostupne su na sajtu <a href="https://www.mfa.gov.rs" target="_blank" rel="noopener">Ministarstva spoljnih poslova RS</a>.
        </div>
      </div>
    </section>

    <!-- Spor -->
    <section class="pp-section" id="spor">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
        </div>
        <h2>Rešavanje sporova</h2>
      </div>

      <p>Na ugovore zaključene putem Escapii platforme primenjuje se pravo <strong>Republike Srbije</strong>. Za eventualne sporove nadležni su sudovi u Beogradu.</p>

      <h3>Reklamacije</h3>
      <p>Korisnik koji je nezadovoljan realizacijom putovanja može podneti pisanu reklamaciju na <a href="mailto:escapii.team@gmail.com" style="color:var(--accent);text-decoration:none;">escapii.team@gmail.com</a>.</p>
      <p>Reklamacija mora biti podneta u roku od <strong>8 dana od povratka</strong> sa putovanja. Organizator je obavezan da odgovori u roku od 8 radnih dana od prijema.</p>

      <h3>Zaštita potrošača</h3>
      <p>Za zaštitu prava potrošača možete se obratiti <strong>Nacionalnoj organizaciji potrošača Srbije (NOPS)</strong> ili nadležnim inspekcijskim organima.</p>
    </section>

    <!-- Izmene uslova -->
    <section class="pp-section" id="izmene-uslova">
      <div class="pp-section-header">
        <div class="pp-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <h2>Izmene uslova korišćenja</h2>
      </div>
      <p>Escapii zadržava pravo izmene ovih Uslova korišćenja. Datum poslednje izmene uvek je naznačen na vrhu dokumenta. Nastavljanjem korišćenja platforme nakon izmene smatra se da korisnik prihvata izmenjene uslove.</p>
      <p>Za bitne izmene koje utiču na prava korisnika, pokušaćemo da obavestimo registrovane korisnike emailom.</p>
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
        <h3>Imate pitanje?</h3>
        <p>Tim Escapii-ja je tu za vas — odgovaramo u roku od 24 sata.</p>
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
    © <?php echo date('Y'); ?> Escapii · Republika Srbija ·
    <a href="<?php echo home_url('/politika-privatnosti'); ?>">Politika privatnosti</a> ·
    Sastavljen u skladu sa Zakonom o turizmu („Sl. glasnik RS", br. 17/2019) i ZZP („Sl. glasnik RS", br. 88/2021)
  </p>
</footer>

<?php wp_footer(); ?>
</body>
</html>
