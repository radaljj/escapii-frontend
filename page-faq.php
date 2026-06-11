<?php
/**
 * Template Name: FAQ
 * Kompletna stranica sa svim cestim pitanjima.
 * URL: /faq
 */
$theme_uri = get_template_directory_uri();
$site_url  = get_site_url();
?>
<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Česta pitanja o putovanjima iznenađenja | Escapii FAQ</title>
  <meta name="description" content="Kako funkcioniše putovanje iznenađenja? Šta je uključeno u cenu, kada saznaješ destinaciju, može li otkaz, kako pokloniti putovanje - svi odgovori na jednom mestu.">
  <link rel="canonical" href="<?php echo esc_url($site_url); ?>/faq">
  <?php wp_head(); ?>

  <!-- FAQ Schema za Google rich results -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {"@type":"Question","name":"Šta je uključeno u cenu putovanja?","acceptedAnswer":{"@type":"Answer","text":"U osnovnu cenu su uključeni povratne avio karte, noćenje u hotelu ili apartmanu za svaku noć provedenu na putovanju i mali ručni prtljag, najčešće ranac dimenzija 40 x 30 x 20 cm, do 10kg. Ukoliko si odabrao dodatke, i oni su uključeni u tvoje putovanje."}},
      {"@type":"Question","name":"Kada ću saznati kuda putujem?","acceptedAnswer":{"@type":"Answer","text":"Poslaćemo ti vremensku prognozu na mejl 7 dana pred put, bez otkrivanja destinacije. Destinaciju saznaješ 48h pre polaska, zajedno sa svim informacijama o letu i smeštaju. Ako si se odlučio za Reveal Box, kutija sa detaljima o putovanju stiže između 2 i 5 dana pre polaska."}},
      {"@type":"Question","name":"Kako Escapii bira destinaciju za tvoje putovanje?","acceptedAnswer":{"@type":"Answer","text":"Destinaciju biramo na osnovu nekoliko faktora - dostupnosti letova u odabranom terminu, cene, kvaliteta smeštaja i trenutnih mogućnosti naše partnerske agencije. Svaka destinacija u našem pool-u je pažljivo proverena, a cilj nam je uvek da pronađemo najbolju opciju za tvoj datum i budžet."}},
      {"@type":"Question","name":"Šta ako dobijem destinaciju koja mi se ne sviđa?","acceptedAnswer":{"@type":"Answer","text":"Može se desiti da destinacija nije ona koju bi sam izabrao, ali u tome je i cela poenta. Naša putovanja su kratka vikend avantura, i za svaku destinaciju u našem pool-u smo sigurni da ima šta da se vidi, uradi i doživi. Uz to, dobijaš naš vodič sa insajderskim informacijama, preporukama lokalaca, popustima i idejama."}},
      {"@type":"Question","name":"Mogu li da isključim destinacije?","acceptedAnswer":{"@type":"Answer","text":"Da! Ako putuješ iz Beograda, možeš isključiti do 4 destinacije - prva je besplatna, a svaka sledeća se doplaćuje 15€. Ako putuješ iz Niša, možeš isključiti maksimalno 1 destinaciju uz doplatu od 15€."}},
      {"@type":"Question","name":"Mogu li da otkažem ili promenim rezervaciju?","acceptedAnswer":{"@type":"Answer","text":"Putovanje ne može da se otkaže ukoliko je rezervacija napravljena u roku od 90 dana pre polaska, jer karte i smeštaj rezervišemo unapred. Postoje opcije: fleksibilne karte kao dodatak, upit pre zvanične rezervacije, ili poklon putovanje gde se datumi ne fiksiraju do 30-60 dana pre polaska."}},
      {"@type":"Question","name":"Da li mogu da poklonim putovanje nekome?","acceptedAnswer":{"@type":"Answer","text":"Da! Postoje dve opcije: poklon vaučer koji primalac koristi pri rezervaciji bilo kog Escapii putovanja, ili personalizovana ponuda prilagođena željenom datumu, trajanju i budžetu."}},
      {"@type":"Question","name":"Ko organizuje putovanje i da li je Escapii registrovana firma?","acceptedAnswer":{"@type":"Answer","text":"Da, Escapii je registrovana firma. Sarađujemo sa partnerskim turističkim agencijama sa licencom, sa kojima zajedno kreiramo iznenađenja. Svako putovanje je organizovano profesionalno i u skladu sa svim propisima."}},
      {"@type":"Question","name":"Da li mogu da putujem sam/sama?","acceptedAnswer":{"@type":"Answer","text":"Apsolutno - imamo puno solo Escapera! Jedina napomena je da se za jednokrevetnu sobu primenjuje doplata od 60€ po noći, jer se hotelske sobe standardno rezervišu za dve osobe."}},
      {"@type":"Question","name":"Da li postoji starosno ograničenje i mogu li da putujem sa decom?","acceptedAnswer":{"@type":"Answer","text":"Naša putovanja su otvorena za sve uzraste. Osobe mlađe od 18 godina ne mogu da putuju bez punoletnog pratioca. Deca putuju pod istim uslovima kao i odrasli. Za decu mlađu od 2 godine važe posebni uslovi avio kompanija."}},
      {"@type":"Question","name":"Kako funkcioniše plaćanje?","acceptedAnswer":{"@type":"Answer","text":"Nakon što pošalješ upit, naša ekipa će te kontaktirati u roku od 24h sa svim detaljima i podacima za uplatu. Rezervacija se potvrđuje tek nakon izvršene uplate. Uplata se vrši na naš račun - bez naknade za karticu i bez skrivenih troškova."}},
      {"@type":"Question","name":"Kako funkcioniše poklon vaučer?","acceptedAnswer":{"@type":"Answer","text":"Na stranici Pokloni iznenađenje biraš iznos vaučera, unosiš ime i poruku - a mi šaljemo elegantni PDF vaučer na email. Primalac unosi kod vaučera pri rezervaciji, a iznos se oduzima od ukupne cene. Vaučer važi godinu dana od aktivacije."}},
      {"@type":"Question","name":"Šta je prilagođeni termin i kako ga rezervisati?","acceptedAnswer":{"@type":"Answer","text":"Prilagođeni termin je opcija za putnike kojima ne odgovaraju dostupni datumi. U booking formi izaberi opciju Prilagođeni termin, unesi željeni period i broj putnika i pošalji upit. Naš tim proverava dostupnost i dostavlja ponudu, a cena se određuje individualno."}}
    ]
  }
  </script>

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
* { -webkit-tap-highlight-color: transparent; }

:root {
  --bg:      #EFE9E7;
  --bg2:     #FFFFFF;
  --accent:  #CA8A71;
  --accent2: #B57560;
  --teal:    #2D5F6B;
  --gray:    #7A9FA8;
  --border:  rgba(15,45,53,.08);
}

body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  background: var(--bg);
  color: var(--teal);
  min-height: 100vh;
  line-height: 1.7;
}

/* ── Header ── */
.fq-header {
  background: rgba(15,45,53,.95);
  border-bottom: 1px solid var(--border);
  padding: 14px 0;
  position: sticky; top: 0; z-index: 100;
  backdrop-filter: blur(12px);
}
.fq-header-inner {
  max-width: 860px; margin: 0 auto; padding: 0 24px;
  display: flex; align-items: center; justify-content: space-between; gap: 12px;
}
.fq-logo { display: inline-flex; align-items: center; text-decoration: none; }
.fq-logo img { height: 40px; width: auto; display: block; }
.fq-header-right { display: flex; align-items: center; gap: 12px; }
.fq-lang { display: flex; background: rgba(255,255,255,.07); border-radius: 8px; overflow: hidden; }
.fq-lang button {
  padding: 7px 14px; font-size: 12px; font-weight: 700; cursor: pointer;
  border: none; background: transparent; color: rgba(255,255,255,.55);
  letter-spacing: .5px; transition: all .2s; font-family: inherit;
}
.fq-lang button.on { background: var(--accent); color: #fff; }
.fq-back {
  font-size: 13px; color: rgba(255,255,255,.75); text-decoration: none;
  display: flex; align-items: center; gap: 6px; transition: color .2s;
  padding: 8px 14px; border-radius: 8px;
  background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.12);
}
.fq-back:hover { color: #fff; background: rgba(255,255,255,.12); }

/* ── Hero ── */
.fq-hero {
  background: linear-gradient(135deg, rgba(202,138,113,.1) 0%, transparent 60%), var(--bg2);
  border-bottom: 1px solid var(--border);
  padding: 56px 24px 48px; text-align: center;
}
.fq-hero-badge {
  display: inline-flex; align-items: center; gap: 7px;
  background: rgba(202,138,113,.12); border: 1px solid rgba(202,138,113,.25);
  border-radius: 100px; padding: 5px 14px;
  font-size: 12px; font-weight: 600; color: var(--accent);
  letter-spacing: .04em; text-transform: uppercase; margin-bottom: 20px;
}
.fq-hero h1 { font-size: clamp(28px, 5vw, 40px); font-weight: 800; letter-spacing: -1px; margin-bottom: 12px; }
.fq-hero p { font-size: 15px; color: var(--gray); max-width: 540px; margin: 0 auto; }

/* ── Content ── */
.fq-wrap { max-width: 760px; margin: 0 auto; padding: 48px 24px 80px; }

.faq-list { display: flex; flex-direction: column; gap: 12px; }
.faq-item {
  background: var(--bg2);
  border: 1.5px solid var(--border);
  border-radius: 16px;
  cursor: pointer;
  transition: border-color .25s, box-shadow .25s;
  overflow: hidden;
}
.faq-item:hover { border-color: rgba(202,138,113,.3); }
.faq-item.open { border-color: rgba(202,138,113,.45); box-shadow: 0 8px 28px -16px rgba(202,138,113,.4); }
.faq-q {
  display: flex; align-items: center; justify-content: space-between; gap: 16px;
  padding: 20px 24px;
  font-size: 15.5px; font-weight: 700; color: var(--teal);
  transition: color .2s;
}
.faq-item.open .faq-q { color: var(--accent); }
.faq-icon {
  width: 30px; height: 30px; flex-shrink: 0;
  border-radius: 50%; border: 1.5px solid rgba(15,45,53,.18);
  display: flex; align-items: center; justify-content: center;
  font-size: 17px; font-weight: 600; color: var(--gray);
  transition: all .3s;
}
.faq-item.open .faq-icon { background: var(--accent); border-color: var(--accent); color: #fff; transform: rotate(45deg); }
.faq-a {
  max-height: 0; overflow: hidden;
  padding: 0 24px;
  font-size: 14.5px; color: rgba(45,95,107,.85); line-height: 1.75;
  transition: max-height .4s ease, padding .3s ease;
}
.faq-item.open .faq-a { max-height: 1200px; padding: 0 24px 22px; }
.faq-a a { color: var(--accent); font-weight: 600; }
.faq-a strong { color: var(--teal); }
.faq-a ol { padding-left: 20px; margin: 8px 0; }


/* ── Footer (identičan sa glavnom stranicom) ── */
.esc-footer { background: #EFE9E7; padding: 64px 64px 28px; border-top: 1px solid rgba(15,45,53,.07); }
.footer-main { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 56px; }
.footer-brand p { font-size: 14px; color: var(--gray); line-height: 1.75; margin-top: 16px; max-width: 280px; }
.footer-col h4 { font-size: 11px; font-weight: 800; color: var(--teal); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 18px; }
.footer-col a { display: block; font-size: 14px; color: var(--gray); text-decoration: none; margin-bottom: 10px; transition: color .2s; }
.footer-col a:hover { color: var(--accent); }
.footer-social { margin-top: 28px; }
.footer-social h4 { font-size: 11px; font-weight: 800; color: var(--teal); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 16px; }
.social-icons { display: flex; gap: 12px; }
.social-icon {
  width: 40px; height: 40px; border-radius: 10px;
  background: rgba(15,45,53,.07); border: 1px solid rgba(15,45,53,.1);
  display: flex; align-items: center; justify-content: center;
  color: var(--gray); text-decoration: none; transition: all .2s;
}
.social-icon:hover { background: var(--accent); border-color: var(--accent); color: #fff; }
.social-icon svg { width: 18px; height: 18px; fill: currentColor; }
.footer-divider { height: 1px; background: rgba(15,45,53,.08); margin-bottom: 24px; }
.footer-bottom { display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: var(--gray); flex-wrap: wrap; gap: 12px; }
.footer-bottom-links { display: flex; gap: 24px; }
.footer-bottom-links a { color: var(--gray); text-decoration: none; font-size: 13px; transition: color .2s; }
.footer-bottom-links a:hover { color: var(--accent); }
@media (max-width: 768px) {
  .footer-main { grid-template-columns: 1fr 1fr; gap: 32px; }
  .esc-footer { padding: 48px 24px 24px; }
  .footer-bottom { flex-direction: column; text-align: center; }
  .footer-bottom-links { flex-wrap: wrap; justify-content: center; gap: 16px; }
}

@media (max-width: 600px) {
  .fq-back span { display: none; }
  .faq-q { padding: 17px 18px; font-size: 14.5px; }
  .faq-item.open .faq-a { padding: 0 18px 18px; }
  .faq-a { padding: 0 18px; }
}
</style>
</head>
<body>

<header class="fq-header">
  <div class="fq-header-inner">
    <a href="<?php echo esc_url($site_url); ?>" class="fq-logo">
      <img src="<?php echo esc_url($theme_uri); ?>/images/escapii-logo.png" alt="Escapii" onerror="this.outerHTML='<span style=\'color:#fff;font-weight:900;font-size:20px;\'>escapii</span>'">
    </a>
    <div class="fq-header-right">
      <div class="fq-lang">
        <button id="langSr" class="on" onclick="setLang('sr')">SR</button>
        <button id="langEn" onclick="setLang('en')">EN</button>
      </div>
      <a href="<?php echo esc_url($site_url); ?>" class="fq-back">← <span data-i18n="back">Nazad na sajt</span></a>
    </div>
  </div>
</header>

<section class="fq-hero">
  <div class="fq-hero-badge">✦ <span data-i18n="badge">Česta pitanja</span></div>
  <h1 data-i18n="h1">Sve što te zanima, na jednom mestu</h1>
  <p data-i18n="sub">Od cene i destinacija do otkazivanja i poklona - tu su odgovori na sva pitanja o Escapii putovanjima iznenađenja.</p>
</section>

<div class="fq-wrap">
  <div class="faq-list">

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q1">Šta je uključeno u cenu putovanja?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a1">U osnovnu cenu su uključeni povratne avio karte, noćenje u hotelu ili apartmanu za svaku noć provedenu na putovanju i mali ručni prtljag, najčešće ranac dimenzija 40 x 30 x 20 cm, do 10kg. Ukoliko si odabrao/la dodatke, i oni su uključeni u tvoje putovanje.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q2">Kada ću saznati kuda putujem?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a2">Poslaćemo ti vremensku prognozu na mejl 7 dana pred put, bez otkrivanja destinacije. Destinaciju saznaješ 48h pre polaska, zajedno sa svim informacijama o letu i smeštaju. Ako si se odlučio/la za Reveal Box, kutija sa detaljima o putovanju stiže između 2 i 5 dana pre polaska.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q3">Kako Escapii bira destinaciju za tvoje putovanje?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a3">Destinaciju biramo na osnovu nekoliko faktora - dostupnosti letova u odabranom terminu, cene, kvaliteta smeštaja i trenutnih mogućnosti naše partnerske agencije. Svaka destinacija u našem pool-u je pažljivo proverena, a cilj nam je uvek da pronađemo najbolju opciju za tvoj datum i budžet. Ostatak je - iznenađenje.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q4">Šta ako dobijem destinaciju koja mi se ne sviđa?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a4">Razumemo - i to je potpuno validno pitanje. Može se desiti da destinacija nije ona koju bi sam/a izabrao/la, ali u tome je i cela poenta. Ponekad nije najvažnije gde si, već šta doživiš kad stigneš. Naša putovanja su kratka vikend avantura, i za svaku destinaciju u našem pool-u smo sigurni da ima šta da se vidi, uradi i doživi. Uz to, dobijaš naš vodič sa insajderskim informacijama, preporukama lokalaca, popustima i idejama kako provesti 2-3 dana u tom gradu na najbolji mogući način. Mnogi naši putnici su se vratili sa potpuno drugačijim mišljenjem - o destinaciji, ali i o tome šta putovanje uopšte znači.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q5">Mogu li da isključim destinacije?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a5">Da, možeš! Prilikom rezervacije imaš opciju da isključiš destinacije na koje ne bi hteo/la da ideš.<br><br>Ako putuješ iz Beograda, možeš isključiti do 4 destinacije - prva je besplatna, a svaka sledeća se doplaćuje 15€. Ipak, ne savetujemo da isključuješ više od 2-3 destinacije, jer što manje isključuješ, veće je iznenađenje - a to je i cela poenta.<br><br>Ako putuješ iz Niša, zbog manjeg pool-a destinacija, možeš isključiti maksimalno 1 destinaciju uz doplatu od 15€.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q6">Mogu li da otkažem ili promenim rezervaciju?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a6">Nažalost, putovanje ne može da se otkaže - nudimo konkurentne cene upravo zato što karte i smeštaj rezervišemo unapred, što znači da otkazivanje nije moguće ukoliko je rezervacija napravljena u roku od 90 dana pre polaska.<br><br>Međutim, postoji nekoliko opcija koje ti mogu pomoći:<br>- Ako nisi siguran/na koji datum će ti odgovarati, pošalji nam upit sa datumima koji ti najviše odgovaraju i mi ćemo kreirati paket za tebe pre nego što zvanično rezervišeš.<br>- Kao dodatak možeš odabrati fleksibilne karte, koje ti daju mogućnost promene datuma ukoliko se tvoji planovi promene.<br>- Ako razmišljaš o poklonu, opcija &#8220;Poklon putovanje iznenađenja&#8221; omogućava da se datumi ne fiksiraju sve do 30-60 dana pre polaska, u zavisnosti od paketa.<br><br>Hoteli se u nekim slučajevima mogu otkazati, ali to zavisi od uslova konkretnog termina i paketa.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q7">Da li mogu da poklonim putovanje nekome?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a7">Da, apsolutno! Postoje dve opcije za poklon putovanje:<br><br><strong>Poklon vaučer</strong> - na stranici <a href="/pokloni-putovanje-iznenadjenja">Pokloni iznenađenje</a> biraš iznos vaučera, unosiš ime i poruku - a mi šaljemo elegantni PDF vaučer koji primalac koristi pri rezervaciji bilo kog Escapii putovanja.<br><br><strong>Personalizovana ponuda</strong> - javi nam se i kreiraćemo ponudu prilagođenu željenom datumu, trajanju i budžetu.<br><br>Naši Escaperi najčešće poklanjaju putovanja iznenađenja za rođendane, godišnjice, devojačke i momačke večeri - jer avantura koja se pamti uvek pobeđuje svaki materijalni poklon.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q8">Ko organizuje putovanje i da li je Escapii registrovana firma?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a8">Da, Escapii je registrovana firma. Sarađujemo sa partnerskim turističkim agencijama sa licencom, sa kojima zajedno kreiramo iznenađenja za tebe. To znači da je svako putovanje organizovano profesionalno i u skladu sa svim propisima.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q9">Da li mogu da putujem sam/sama?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a9">Apsolutno - imamo puno solo Escapera! Jedina napomena je da se za jednokrevetnu sobu primenjuje doplata od 60€ po noći, jer se hotelske sobe standardno rezervišu za dve osobe. Sve ostalo funkcioniše potpuno isto kao i za grupe.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q10">Da li postoji starosno ograničenje i mogu li da putujem sa decom?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a10">Naša putovanja su otvorena za sve uzraste. Osobe mlađe od 18 godina ne mogu da putuju bez punoletnog pratioca. Deca putuju pod istim uslovima kao i odrasli - sa sopstvenom kartom i smeštajem. Jedina napomena je da za decu mlađu od 2 godine važe posebni uslovi avio kompanija, pa te molimo da nas kontaktiraš pre rezervacije kako bismo pronašli najbolju opciju za vas.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q11">Kako funkcioniše plaćanje?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a11">Nakon što pošalješ upit, naša ekipa će te kontaktirati u roku od 24h sa svim detaljima i podacima za uplatu. Rezervacija se potvrđuje tek nakon izvršene uplate. Po završetku uplate, dobijaš potvrdu na mejl.<br><br>Uplata se vrši na naš račun - bez naknade za karticu i bez skrivenih troškova. Cena koju vidiš na sajtu je cena koju plaćaš.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q12">Kako funkcioniše poklon vaučer?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a12">Poklon vaučer je idealan poklon za nekoga ko voli iznenađenja i putovanja. Na stranici <a href="/pokloni-putovanje-iznenadjenja"><strong>Pokloni iznenađenje</strong></a> biraš iznos vaučera, unosiš ime i poruku - a mi šaljemo elegantni PDF vaučer (boarding pass dizajn) na email koji možeš proslediti ili odštampati.<br><br>Primalac unosi kod vaučera pri rezervaciji Escapii putovanja, a iznos se oduzima od ukupne cene. Vaučer važi <strong>godinu dana od aktivacije</strong> i može se iskoristiti na bilo kom Escapii putovanju - grupnom ili prilagođenom terminu. Vaučer se ne može razmeniti za gotovinu.</div>
    </div>

    <div class="faq-item" onclick="togFaq(this)">
      <div class="faq-q"><span data-i18n="q13">Šta je prilagođeni termin i kako ga rezervisati?</span><div class="faq-icon">+</div></div>
      <div class="faq-a" data-i18n-html="a13">Prilagođeni termin je opcija namenjena putnicima kojima ne odgovaraju dostupni datumi ili žele putovanje organizovano u periodu koji sami odaberu.<br><br>Da biste poslali upit za prilagođeni termin:<br><ol><li>U booking formi izaberite opciju <strong>Prilagođeni termin</strong>.</li><li>Unesite željeni period putovanja i broj putnika.</li><li>Pošaljite upit.</li></ol>Nakon prijema upita, naš tim proverava dostupnost letova i smeštaja, formira ponudu i dostavlja vam sve potrebne informacije. Cena se određuje individualno, u skladu sa raspoloživim opcijama za odabrani period i broj putnika. ✈️🏨</div>
    </div>

  </div>

</div>

<footer class="esc-footer">
  <div class="footer-main">
    <div class="footer-brand">
      <a href="<?php echo esc_url($site_url); ?>"><img src="<?php echo esc_url($theme_uri); ?>/images/logo-black.svg" alt="Escapii" style="height:42px;width:auto;"></a>
      <p data-i18n="ft.desc">Iznenađujuća putovanja za ljude koji su spremni da puste kontrolu i probaju nešto drugačije.</p>
      <div class="footer-social">
        <h4 data-i18n="ft.social">Pratite nas</h4>
        <div class="social-icons">
          <a href="https://www.instagram.com/escapii.rs?igsh=NmMwY3djcHFncjg2&utm_source=qr" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram">
            <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="https://www.tiktok.com/@escapii.rs?_r=1&_t=ZS-96jzf1blOsf" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="TikTok">
            <svg viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.77a4.85 4.85 0 01-1.01-.08z"/></svg>
          </a>
        </div>
      </div>
    </div>
    <div class="footer-col">
      <h4 data-i18n="ft.nav">Navigacija</h4>
      <a href="<?php echo esc_url($site_url); ?>/#esc-booking" data-i18n="ft.book">Rezervacija</a>
      <a href="<?php echo esc_url($site_url); ?>/#esc-dest" data-i18n="ft.dest">Destinacije</a>
      <a href="<?php echo esc_url($site_url); ?>/#esc-how" data-i18n="ft.how">Kako funkcioniše</a>
      <a href="<?php echo esc_url($site_url); ?>/#esc-who" data-i18n="ft.who">Za koga</a>
      <a href="/faq" data-i18n="ft.faq">FAQ</a>
      <a href="/pokloni-putovanje-iznenadjenja" style="color:var(--accent);font-weight:600;" data-i18n="ft.gift">🎁 Pokloni putovanje</a>
    </div>
    <div class="footer-col">
      <h4 data-i18n="ft.dep">Polasci</h4>
      <a href="<?php echo esc_url($site_url); ?>/#esc-booking">✈ Beograd (BEG)</a>
      <a href="<?php echo esc_url($site_url); ?>/#esc-booking">✈ Niš (INI)</a>
    </div>
    <div class="footer-col">
      <h4 data-i18n="ft.contact">Kontakt</h4>
      <a href="mailto:escapii.team@gmail.com" style="display:inline-flex;align-items:center;gap:6px;">✉ escapii.team@gmail.com</a>
    </div>
  </div>
  <div class="footer-divider"></div>
  <div class="footer-bottom">
    <span>© 2026 Escapii - <span data-i18n="ft.rights">Sva prava zadržana</span></span>
    <div class="footer-bottom-links">
      <a href="/uslovi-koriscenja" data-i18n="ft.terms">Uslovi korišćenja</a>
      <a href="/politika-privatnosti" data-i18n="ft.privacy">Politika privatnosti</a>
    </div>
  </div>
</footer>

<script>
const I18N_EN = {
  'back':'Back to site',
  'badge':'FAQ',
  'h1':'Everything you want to know, in one place',
  'sub':'From pricing and destinations to cancellations and gifts - answers to all your questions about Escapii surprise trips.',
  'q1':'What\'s included in the trip price?',
  'a1':'The base price includes round-trip flights, hotel or apartment accommodation for every night of the trip, and a small carry-on bag - typically a backpack sized 40×30×20 cm, up to 10 kg. If you selected any add-ons, those are included in your trip as well.',
  'q2':'When will I find out where I\'m going?',
  'a2':'We\'ll send you a weather forecast by email 7 days before departure - no destination revealed yet. You\'ll find out your destination 48 hours before departure, along with all flight and accommodation details. If you opted for the Reveal Box, it arrives between 2 and 5 days before departure.',
  'q3':'How does Escapii choose my destination?',
  'a3':'We choose based on several factors - flight availability on your selected dates, price, accommodation quality, and current options from our partner agency. Every destination in our pool has been carefully vetted, and our goal is always to find the best option for your date and budget. The rest is a surprise.',
  'q4':'What if I get a destination I don\'t like?',
  'a4':'We get it - that\'s a completely valid question. It\'s possible you\'ll receive a destination you wouldn\'t have picked yourself, but that\'s kind of the whole point. Sometimes it\'s not about where you are, but what you experience when you get there. Our trips are short weekend adventures, and every destination in our pool has plenty to see, do, and discover. On top of that, you\'ll get our guide with insider tips, local recommendations, discounts, and ideas for making the most of 2-3 days in that city. Many of our travelers came back with a completely different perspective - about the destination, and about what travel really means.',
  'q5':'Can I exclude destinations?',
  'a5':'Yes, you can! During booking, you have the option to exclude destinations you don\'t want to visit.<br><br>If you\'re departing from Belgrade, you can exclude up to 4 destinations - the first one is free, and each additional costs +15€. We don\'t recommend excluding more than 2-3, though - the fewer you exclude, the bigger the surprise, and that\'s the whole point.<br><br>If you\'re departing from Niš, due to the smaller destination pool, you can exclude a maximum of 1 destination for a fee of 15€.',
  'q6':'Can I cancel or change my booking?',
  'a6':'Unfortunately, trips cannot be canceled - we offer competitive prices precisely because we book flights and accommodation in advance, which means cancellations are not possible once a reservation is made within 90 days of departure.<br><br>However, there are a few options that may help:<br>- If you\'re not sure which date will work for you, send us an inquiry with your preferred dates and we\'ll put together a package before you officially book.<br>- As an add-on, you can choose flexible tickets, which give you the option to change dates if your plans change.<br>- If you\'re thinking of a gift, the "Gift Surprise Trip" option allows dates to remain unfixed until 30-60 days before departure, depending on the package.<br><br>Hotels can in some cases be canceled, but this depends on the specific trip and package conditions.',
  'q7':'Can I give a trip as a gift?',
  'a7':'Yes, absolutely! There are two ways to gift a surprise trip:<br><br><strong>Gift voucher</strong> - on the <a href="/pokloni-putovanje-iznenadjenja">Pokloni iznenađenje</a> page, choose a voucher amount, enter a name and message - we\'ll send a beautifully designed PDF voucher the recipient uses when booking any Escapii trip.<br><br><strong>Personalized offer</strong> - just reach out and we\'ll create an offer tailored to the dates, duration, and budget that works for you.<br><br>Our Escapers most often give surprise trips as gifts for birthdays, anniversaries, hen and stag parties - because an adventure you\'ll remember always beats any material gift.',
  'q8':'Who organizes the trip and is Escapii a registered company?',
  'a8':'Yes, Escapii is a registered company. We work with licensed partner travel agencies to co-create surprises for you. This means every trip is organized professionally and in full compliance with all regulations.',
  'q9':'Can I travel alone?',
  'a9':'Absolutely - we have plenty of solo Escapers! The only thing to note is that a single room supplement of 60€ per night applies, since hotel rooms are standardly reserved for two people. Everything else works exactly the same as for groups.',
  'q10':'Is there an age limit, and can I travel with children?',
  'a10':'Our trips are open to all ages. Anyone under 18 cannot travel without an adult companion. Children travel under the same conditions as adults - with their own ticket and accommodation. The only note is that children under 2 are subject to special airline conditions, so please contact us before booking so we can find the best option for your group.',
  'q11':'How does payment work?',
  'a11':'After you submit your inquiry, our team will contact you within 24 hours with all the details and payment information. Your booking is confirmed only after payment is received. Once payment is completed, you\'ll receive a confirmation by email.<br><br>Payment is made directly to our account - no card fees, no hidden costs. The price you see on the site is the price you pay.',
  'q12':'How does a gift voucher work?',
  'a12':'A gift voucher is the perfect gift for someone who loves surprises and travel. On the <a href="/pokloni-putovanje-iznenadjenja"><strong>Pokloni iznenađenje</strong></a> page, choose a voucher amount, enter the recipient\'s name and a personal message - we\'ll send a beautifully designed PDF voucher (boarding pass style) to the email address you provide, ready to forward or print.<br><br>The recipient enters the voucher code when booking an Escapii trip, and the amount is deducted from the total price. Vouchers are valid for <strong>one year from activation</strong> and can be used on any Escapii trip - group or custom. Vouchers cannot be exchanged for cash.',
  'q13':'What is a custom trip and how do I book one?',
  'a13':'A custom trip is an option designed for travellers who don\'t find the available dates suitable, or who wish to travel in a period of their own choosing.<br><br>To submit a request for a custom trip:<br><ol><li>Select the <strong>Custom Trip</strong> option in the booking form.</li><li>Enter your preferred travel period and number of travellers.</li><li>Submit the request.</li></ol>After receiving your inquiry, our team checks flight and accommodation availability, prepares a quote, and sends you all the necessary information. Pricing is determined individually, based on available options for your chosen period and number of travellers. ✈️🏨',
  'ft.desc':'Surprise trips for people ready to let go of control and try something different.',
  'ft.social':'Follow us',
  'ft.nav':'Navigation',
  'ft.book':'Book a trip',
  'ft.dest':'Destinations',
  'ft.how':'How it works',
  'ft.who':'Who it\'s for',
  'ft.faq':'FAQ',
  'ft.gift':'🎁 Gift a trip',
  'ft.dep':'Departures',
  'ft.contact':'Contact',
  'ft.rights':'All rights reserved',
  'ft.terms':'Terms of Use',
  'ft.privacy':'Privacy Policy'
};

// Sacuvani SR tekstovi za vracanje sa EN
const I18N_SR = {};
document.querySelectorAll('[data-i18n]').forEach(el => { I18N_SR[el.getAttribute('data-i18n')] = el.textContent; });
document.querySelectorAll('[data-i18n-html]').forEach(el => { I18N_SR[el.getAttribute('data-i18n-html')] = el.innerHTML; });

let lang = localStorage.getItem('esc-lang') || 'sr';

function applyLang() {
  const dict = lang === 'en' ? I18N_EN : I18N_SR;
  document.querySelectorAll('[data-i18n]').forEach(el => {
    const k = el.getAttribute('data-i18n');
    if (dict[k]) el.textContent = dict[k];
  });
  document.querySelectorAll('[data-i18n-html]').forEach(el => {
    const k = el.getAttribute('data-i18n-html');
    if (dict[k]) el.innerHTML = dict[k];
  });
  document.getElementById('langSr').classList.toggle('on', lang === 'sr');
  document.getElementById('langEn').classList.toggle('on', lang === 'en');
  document.documentElement.lang = lang;
}

function setLang(l) {
  lang = l;
  localStorage.setItem('esc-lang', l);
  applyLang();
}

function togFaq(item) {
  const wasOpen = item.classList.contains('open');
  document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));
  if (!wasOpen) item.classList.add('open');
}

if (lang === 'en') applyLang();
</script>

<?php wp_footer(); ?>
</body>
</html>
