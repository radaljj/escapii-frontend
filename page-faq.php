<?php
/**
 * Template Name: FAQ
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
  <link rel="canonical" href="<?php echo esc_url($site_url); ?>/faq/">
  <?php wp_head(); ?>

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
:root {
  --cream:     #faf6ee;
  --sand:      #f4eee1;
  --paper:     #fffdf8;
  --ink:       #1a1410;
  --mute:      #6b5d4f;
  --faint:     #a3978a;
  --line:      #e7ddcd;
  --terra:     #a85e44;
  --gold:      #CA8A71;
  --gold2:     #b87a62;
  --white:     #ffffff;
  --peach:     #c8775a;
  --teal:      #22424a;
  --teal-deep: #16313a;
  --serif:     -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --display:   -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --sans:      -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --gray:      #7A9FA8;
  --white-nav: #2D5F6B;
  --accent:    #CA8A71;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
* { -webkit-tap-highlight-color: transparent; }
html { scroll-behavior: smooth; }
body { background: var(--cream); color: var(--ink); font-family: var(--serif);
  -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; line-height: 1.7; }
a { color: inherit; }

/* ── Nav (identičan homepage) ── */
.esc-nav {
  position: fixed; top: 0; left: 0; right: 0; z-index: 999;
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 64px; height: 72px;
  background: rgba(15,45,53,.92); backdrop-filter: blur(24px);
  border-bottom: 1px solid rgba(255,255,255,.07); transition: background .3s;
}
.esc-logo { display: inline-flex; align-items: center; text-decoration: none; }
.esc-logo img { height: 48px; width: auto; display: block; }
@media (max-width:768px) { .esc-logo img { height:36px; } }
.nav-right { display: flex; align-items: center; gap: 20px; }
.lang-wrap { display: flex; background: rgba(255,255,255,.07); border-radius: 8px; overflow: hidden; }
.lang-btn { padding: 7px 16px; font-size: 13px; font-weight: 700; cursor: pointer;
            border: none; background: transparent; color: var(--gray);
            letter-spacing: .5px; transition: all .2s; }
.lang-btn.on { background: var(--gold); color: #fff; }
.nav-status { background: rgba(255,255,255,.07); border: 1.5px solid rgba(255,255,255,.12);
              color: var(--gray); border-radius: 8px; padding: 8px 14px;
              font-size: 13px; font-weight: 600; font-family: inherit;
              cursor: pointer; transition: all .2s;
              display: flex; align-items: center; gap: 6px; }
.nav-status:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.22); color: var(--white); }
.nav-status svg { flex-shrink: 0; }
/* mobile gift accordion */
.mob-gift-wrap { border-bottom: 1px solid rgba(255,255,255,.06); }
.mob-gift-toggle {
  width: 100%; display: flex; align-items: center; justify-content: space-between;
  padding: 13px 4px; font-size: 15px; font-weight: 700; color: #d4a83c;
  background: none; border: none; text-align: left; cursor: pointer; font-family: inherit; transition: color .15s;
}
.mob-gift-caret { font-size: 11px; transition: transform .22s; flex-shrink: 0; margin-left: 6px; }
.mob-gift-toggle.open .mob-gift-caret { transform: rotate(180deg); }
.mob-gift-sub { display: flex; flex-direction: column; padding: 0 0 4px 16px;
                max-height: 0; overflow: hidden; transition: max-height .25s ease; }
.mob-gift-sub.open { max-height: 120px; }
.mob-gift-sub-btn { padding: 10px 4px; font-size: 14px; font-weight: 600;
                    color: rgba(255,255,255,.65); background: none; border: none;
                    border-bottom: 1px solid rgba(255,255,255,.05); text-align: left;
                    cursor: pointer; font-family: inherit; transition: color .15s; }
.mob-gift-sub-btn:last-child { border-bottom: none; }
.mob-gift-sub-btn:hover { color: #fff; }
/* hamburger */
.nav-burger { display:none; flex-direction:column; justify-content:center; gap:5px;
              width:40px; height:40px; background:none; border:none; cursor:pointer; padding:8px; }
.nav-burger span { display:block; height:2px; background:white; border-radius:2px;
                   transition: transform .3s, opacity .3s, width .3s; width:100%; }
.nav-burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.nav-burger.open span:nth-child(2) { opacity:0; width:0; }
.nav-burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
/* mobile menu */
.mob-menu { display:none; position:fixed; top:72px; left:0; right:0; z-index:997;
            background:rgba(15,45,53,.97); backdrop-filter:blur(28px);
            border-bottom:1px solid rgba(255,255,255,.07);
            flex-direction:column; padding:16px 24px 24px;
            transform:translateY(-8px); opacity:0;
            transition: transform .25s ease, opacity .25s ease; pointer-events: none; }
.mob-menu.open { transform:translateY(0); opacity:1; pointer-events: auto; }
.mob-menu-links { display:flex; flex-direction:column; gap:2px; margin-bottom:20px; }
.mob-menu-link { padding:13px 4px; font-size:15px; font-weight:700; color:rgba(255,255,255,.7);
                 background:none; border:none; text-align:left; cursor:pointer;
                 border-bottom:1px solid rgba(255,255,255,.06); transition:color .15s; }
.mob-menu-link:last-child { border-bottom:none; }
.mob-menu-link:hover { color:white; }
.mob-menu-call { color: var(--accent) !important; }
.mob-menu-call-hours { display:block; font-size:11px; color:rgba(255,255,255,.38); font-weight:500; margin-top:3px; }
.mob-menu-bottom { display:flex; align-items:center; justify-content:space-between; gap:12px; padding-top:4px; }
.mob-menu-book { flex:1; background:var(--gold); color:#fff; border:none;
                 padding:13px; border-radius:10px; font-size:14px; font-weight:800; cursor:pointer; font-family:inherit; }
@media (max-width:768px) {
  .esc-nav { padding: 0 20px; }
  .nav-right { display: none; }
  .nav-burger { display: flex; }
  .mob-menu { display: flex; }
}

/* ── Secondary nav ── */
.sec-nav {
  position: fixed; top: 72px; left: 0; right: 0; z-index: 998;
  display: flex; align-items: center; justify-content: center;
  padding: 0 24px; height: 44px;
  background: rgba(15,45,53,.82); backdrop-filter: blur(28px) saturate(180%);
  border-bottom: 1px solid rgba(255,255,255,.05);
  overflow-x: auto; gap: 4px;
  transform: translateY(-116%); opacity: 0;
  transition: transform .35s cubic-bezier(.4,0,.2,1), opacity .35s ease;
  scrollbar-width: none;
}
.sec-nav::-webkit-scrollbar { display: none; }
.sec-nav.visible { transform: translateY(0); opacity: 1; }
@media (max-width: 768px) { .sec-nav { display: none !important; } }
.sec-nav-link {
  white-space: nowrap; flex-shrink: 0;
  padding: 5px 14px; border-radius: 20px;
  font-size: 11px; font-weight: 700; letter-spacing: .8px;
  text-transform: uppercase; color: rgba(255,255,255,.4);
  cursor: pointer; transition: color .2s, background .2s;
  background: none; border: none; font-family: inherit;
}
.sec-nav-link:hover { color: rgba(255,255,255,.85); background: rgba(255,255,255,.06); }
.sec-nav-cta {
  white-space: nowrap; flex-shrink: 0;
  display: inline-flex; align-items: center; gap: 4px;
  padding: 6px 16px; border-radius: 20px;
  font-size: 12px; font-weight: 700; cursor: pointer; font-family: inherit;
  color: #fff; background: var(--gold); border: none;
  box-shadow: 0 2px 10px rgba(202,138,113,.35); transition: all .2s;
}
.sec-nav-cta:hover { background: var(--gold2); box-shadow: 0 4px 16px rgba(202,138,113,.45); transform: translateY(-1px); }
.sec-nav-call {
  white-space: nowrap; flex-shrink: 0;
  display: inline-flex; align-items: center; gap: 6px;
  padding: 5px 14px; border-radius: 20px;
  font-size: 12px; font-weight: 700; cursor: pointer; font-family: inherit;
  color: var(--gold); background: rgba(202,138,113,.12);
  border: 1px solid rgba(202,138,113,.3); transition: all .2s;
}
.sec-nav-call:hover { background: rgba(202,138,113,.22); border-color: rgba(202,138,113,.55); }
.sec-gift-wrap { position: relative; flex-shrink: 0; margin-left: 16px; }
.sec-gift-btn {
  white-space: nowrap; display: inline-flex; align-items: center; gap: 6px;
  padding: 5px 14px; border-radius: 20px;
  font-size: 11px; font-weight: 700; letter-spacing: .4px;
  cursor: pointer; font-family: inherit;
  color: #d4a83c; background: rgba(200,149,58,.14);
  border: 1px solid rgba(200,149,58,.3); transition: all .2s;
}
.sec-gift-btn:hover, .sec-gift-btn.open { background: rgba(200,149,58,.26); border-color: rgba(200,149,58,.55); }
.sec-gift-caret { font-size: 9px; transition: transform .2s; display: inline-block; }
.sec-gift-btn.open .sec-gift-caret { transform: rotate(180deg); }
.sec-gift-drop {
  position: fixed; top: 0; right: 0;
  background: rgba(15,45,53,.97); backdrop-filter: blur(28px);
  border: 1px solid rgba(255,255,255,.1); border-radius: 12px;
  min-width: 210px; overflow: hidden;
  box-shadow: 0 16px 48px rgba(0,0,0,.45);
  opacity: 0; transform: translateY(-8px); pointer-events: none;
  transition: opacity .2s, transform .2s; z-index: 1002;
}
.sec-gift-drop.open { opacity: 1; transform: translateY(0); pointer-events: auto; }
.nav-gift-item {
  display: flex; align-items: center; gap: 10px;
  padding: 12px 16px; width: 100%;
  background: none; border: none; border-bottom: 1px solid rgba(255,255,255,.06);
  color: rgba(255,255,255,.7); cursor: pointer; font-family: inherit; text-align: left;
  transition: background .15s, color .15s;
}
.nav-gift-item:last-child { border-bottom: none; }
.nav-gift-item:hover { background: rgba(255,255,255,.06); color: #fff; }
.nav-gift-item.primary { color: #d4a83c; }
.nav-gift-item.primary:hover { background: rgba(200,149,58,.1); color: #e0b84a; }
.nav-gift-item-icon { font-size: 16px; flex-shrink: 0; }
.nav-gift-item-text { display: flex; flex-direction: column; gap: 1px; }
.nav-gift-item-label { font-size: 13px; font-weight: 700; line-height: 1.2; }
.nav-gift-item-sub { font-size: 11px; font-weight: 400; color: rgba(255,255,255,.4); line-height: 1.2; }
.nav-gift-item.primary .nav-gift-item-sub { color: rgba(212,168,60,.55); }

/* ── Hero ── */
.fq-hero {
  position: relative; overflow: hidden;
  text-align: center; padding: 142px 24px 110px;
  background: url('https://images.unsplash.com/photo-1646303297330-17073f7823c3?w=1920&q=80&auto=format&fit=crop') center/cover no-repeat var(--teal-deep);
}
.fq-hero::before {
  content: ""; position: absolute; inset: 0;
  background: rgba(10,30,38,.70);
}
.fq-hero::after {
  content: ""; position: absolute; inset: 0; opacity: .25;
  background-image: radial-gradient(rgba(255,255,255,.07) 1px, transparent 1px);
  background-size: 26px 26px;
}
.fq-hero-content { position: relative; z-index: 2; max-width: 680px; margin: 0 auto; }
.fq-hero-pill {
  display: inline-flex; align-items: center; gap: 9px;
  font-family: var(--sans); font-size: 11px; font-weight: 700;
  letter-spacing: 2px; text-transform: uppercase; color: #fbe3d6;
  background: rgba(200,119,90,.18); border: 1px solid rgba(200,119,90,.45);
  padding: 8px 16px; border-radius: 100px; margin-bottom: 22px;
}
.fq-hero-pill svg { width: 13px; height: 13px; }
.fq-hero h1 {
  font-family: var(--display); font-weight: 600; color: #fff;
  font-size: clamp(34px, 5vw, 58px); line-height: 1.07; letter-spacing: -1px;
  margin-bottom: 14px; text-wrap: balance;
}
.fq-hero p {
  font-family: var(--serif); font-size: 17px; line-height: 1.6;
  color: rgba(255,255,255,.7); max-width: 48ch; margin: 0 auto;
}

/* ── Categories ── */
.fq-cats {
  display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;
  max-width: 740px; margin: 26px auto 0; padding: 0 24px;
}
.fq-cat {
  font-family: var(--sans); font-size: 13px; font-weight: 500; color: var(--mute);
  background: var(--paper); border: 1px solid var(--line);
  padding: 9px 18px; border-radius: 100px; cursor: pointer; transition: all .2s;
}
.fq-cat:hover { color: var(--ink); border-color: var(--terra); }
.fq-cat.active { background: var(--ink); color: #fff; border-color: var(--ink); }

/* ── FAQ list ── */
.fq-wrap { max-width: 800px; margin: 0 auto; padding: 56px 24px 0; }

.fq-group { margin-bottom: 48px; }
.fq-group-title {
  font-family: var(--sans); font-size: 11px; font-weight: 700;
  letter-spacing: 2px; text-transform: uppercase; color: var(--terra);
  margin: 0 0 18px; display: flex; align-items: center; gap: 12px;
}
.fq-group-title::after { content: ""; flex: 1; height: 1px; background: var(--line); }

.faq {
  background: var(--paper); border: 1px solid var(--line); border-radius: 16px;
  margin-bottom: 12px; overflow: hidden; transition: border-color .25s, box-shadow .25s;
}
.faq.open { border-color: #e3c8b8; box-shadow: 0 16px 36px -24px rgba(168,94,68,.4); }
.faq-q {
  display: flex; align-items: center; justify-content: space-between; gap: 20px;
  cursor: pointer; padding: 22px 26px; list-style: none; user-select: none;
}
.faq-q::-webkit-details-marker { display: none; }
.faq-q h3 {
  font-family: var(--display); font-weight: 600; font-size: 19px; line-height: 1.3;
  margin: 0; color: var(--ink); letter-spacing: -.2px; transition: color .2s;
}
.faq.open .faq-q h3 { color: var(--terra); }
.faq-ic {
  width: 32px; height: 32px; flex: none; border-radius: 50%;
  border: 1px solid var(--line); display: flex; align-items: center; justify-content: center;
  position: relative; transition: all .25s;
}
.faq.open .faq-ic { background: var(--terra); border-color: var(--terra); }
.faq-ic::before, .faq-ic::after {
  content: ""; position: absolute; background: var(--mute); border-radius: 2px; transition: all .25s;
}
.faq-ic::before { width: 12px; height: 2px; }
.faq-ic::after  { width: 2px; height: 12px; }
.faq.open .faq-ic::before, .faq.open .faq-ic::after { background: #fff; }
.faq.open .faq-ic::after { transform: rotate(90deg); opacity: 0; }
.faq-a { max-height: 0; overflow: hidden; transition: max-height .35s ease; }
.faq-a-inner {
  padding: 0 26px 26px; font-family: var(--serif); font-size: 16px;
  line-height: 1.75; color: var(--mute); max-width: 66ch;
}
.faq-a-inner strong { color: var(--ink); font-weight: 600; }
.faq-a-inner a { color: var(--terra); text-decoration: underline; text-underline-offset: 2px; }
.faq-a-inner ol { padding-left: 20px; margin: 8px 0; }
.faq-a-inner br + br { display: block; margin-top: 8px; }

/* ── Footer (identičan blog/glavnoj strani) ── */
.esc-footer{background:#EFE9E7; padding:64px 64px 28px; border-top:1px solid rgba(15,45,53,.07); margin-top:88px;}
.footer-main{display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:48px; margin-bottom:56px;}
.footer-brand p{font-size:14px; color:var(--gray); line-height:1.75; margin-top:16px; max-width:280px;}
.footer-col h4{font-family:var(--sans); font-size:11px; font-weight:800; color:var(--white-nav); letter-spacing:1.5px; text-transform:uppercase; margin-bottom:18px;}
.footer-col a{display:block; font-size:14px; color:var(--gray); text-decoration:none; margin-bottom:10px; transition:color .2s;}
.footer-col a:hover{color:var(--accent);}
.footer-social{margin-top:28px;}
.footer-social h4{font-size:11px; font-weight:800; color:var(--white-nav); letter-spacing:1.5px; text-transform:uppercase; margin-bottom:16px; font-family:var(--sans);}
.social-icons{display:flex; gap:12px;}
.social-icon{width:40px; height:40px; border-radius:10px; background:rgba(15,45,53,.06); border:1px solid rgba(15,45,53,.1); display:flex; align-items:center; justify-content:center; color:var(--gray); text-decoration:none; transition:all .2s;}
.social-icon:hover{background:var(--accent); border-color:var(--accent); color:#fff;}
.social-icon svg{width:18px; height:18px; fill:currentColor;}
.footer-divider{height:1px; background:rgba(15,45,53,.08); margin-bottom:24px;}
.footer-bottom{display:flex; justify-content:space-between; align-items:center; font-family:var(--sans); font-size:13px; color:var(--gray); flex-wrap:wrap; gap:12px;}
.footer-bottom-links{display:flex; gap:24px;}
.footer-bottom-links a{color:var(--gray); text-decoration:none; font-size:13px; transition:color .2s;}
.footer-bottom-links a:hover{color:var(--white-nav);}

/* ── Responsive ── */
@media (max-width: 760px) {
  .fq-nav { padding: 14px 20px; }
  .fq-hero { padding: 124px 20px 92px; }
  .fq-wrap { padding: 48px 20px 0; }
  .faq-q h3 { font-size: 17px; }
  .faq-q { padding: 18px 20px; }
  .faq-a-inner { padding: 0 20px 22px; }
  .footer-main{grid-template-columns:1fr 1fr; gap:32px;}
  .esc-footer{padding:48px 24px 24px;}
  .footer-bottom{flex-direction:column; text-align:center;}
  .footer-bottom-links{flex-wrap:wrap; justify-content:center; gap:16px;}
}
</style>
</head>
<body>

<!-- NAV -->
<?php include get_template_directory() . '/inc/subpage-nav.php'; ?>

<!-- HERO -->
<header class="fq-hero">
  <div class="fq-hero-content">
    <span class="fq-hero-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      <span data-i18n="badge">Česta pitanja</span>
    </span>
    <h1 data-i18n="h1">Sve što te zanima, na jednom mestu</h1>
    <p data-i18n="sub">Od cene i destinacija do otkazivanja i poklona - tu su odgovori na sva pitanja o Escapii putovanjima iznenađenja.</p>
  </div>
</header>

<!-- CATEGORIES -->
<div class="fq-cats" id="fqCats">
  <button class="fq-cat active" data-cat="all" data-i18n="cat.all">Sve</button>
  <button class="fq-cat" data-cat="cena" data-i18n="cat.cena">Cena i plaćanje</button>
  <button class="fq-cat" data-cat="dest" data-i18n="cat.dest">Destinacije</button>
  <button class="fq-cat" data-cat="rez" data-i18n="cat.rez">Rezervacija</button>
  <button class="fq-cat" data-cat="poklon" data-i18n="cat.poklon">Pokloni</button>
</div>

<main class="fq-wrap">

  <!-- GROUP: Cena i plaćanje -->
  <section class="fq-group" data-group="cena">
    <h2 class="fq-group-title" data-i18n="grp.cena">Cena i plaćanje</h2>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q1">Šta je uključeno u cenu putovanja?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a1">U osnovnu cenu su uključeni <strong>povratne avio karte</strong>, noćenje u hotelu ili apartmanu za svaku noć provedenu na putovanju i mali ručni prtljag, najčešće ranac dimenzija 40 x 30 x 20 cm, do 10kg. Ukoliko si odabrao/la dodatke, i oni su uključeni u tvoje putovanje.</div></div>
    </details>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q11">Kako funkcioniše plaćanje?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a11">Nakon što pošalješ upit, naša ekipa će te kontaktirati u roku od 24h sa svim detaljima i podacima za uplatu. Rezervacija se potvrđuje tek nakon izvršene uplate. Po završetku uplate, dobijaš potvrdu na mejl.<br><br>Uplata se vrši na naš račun - bez naknade za karticu i bez skrivenih troškova. Cena koju vidiš na sajtu je cena koju plaćaš.</div></div>
    </details>
  </section>

  <!-- GROUP: Destinacije -->
  <section class="fq-group" data-group="dest">
    <h2 class="fq-group-title" data-i18n="grp.dest">Destinacije</h2>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q2">Kada ću saznati kuda putujem?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a2">Poslaćemo ti vremensku prognozu na mejl <strong>7 dana pred put</strong>, bez otkrivanja destinacije. Destinaciju saznaješ <strong>48h pre polaska</strong>, zajedno sa svim informacijama o letu i smeštaju. Ako si se odlučio/la za Reveal Box, kutija sa detaljima o putovanju stiže između 2 i 5 dana pre polaska.</div></div>
    </details>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q3">Kako Escapii bira destinaciju za tvoje putovanje?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a3">Destinaciju biramo na osnovu nekoliko faktora - dostupnosti letova u odabranom terminu, cene, kvaliteta smeštaja i trenutnih mogućnosti naše partnerske agencije. Svaka destinacija u našem pool-u je pažljivo proverena, a cilj nam je uvek da pronađemo najbolju opciju za tvoj datum i budžet. Ostatak je - iznenađenje.</div></div>
    </details>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q4">Šta ako dobijem destinaciju koja mi se ne sviđa?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a4">Razumemo - i to je potpuno validno pitanje. Može se desiti da destinacija nije ona koju bi sam/a izabrao/la, ali u tome je i cela poenta. Ponekad nije najvažnije gde si, već šta doživiš kad stigneš. Naša putovanja su kratka vikend avantura, i za svaku destinaciju u našem pool-u smo sigurni da ima šta da se vidi, uradi i doživi. Uz to, dobijaš naš vodič sa insajderskim informacijama, preporukama lokalaca, popustima i idejama kako provesti 2-3 dana u tom gradu na najbolji mogući način. Mnogi naši putnici su se vratili sa potpuno drugačijim mišljenjem - o destinaciji, ali i o tome šta putovanje uopšte znači.</div></div>
    </details>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q5">Mogu li da isključim destinacije?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a5">Da, možeš! Prilikom rezervacije imaš opciju da isključiš destinacije na koje ne bi hteo/la da ideš.<br><br>Ako putuješ iz <strong>Beograda</strong>, možeš isključiti do 4 destinacije - prva je besplatna, a svaka sledeća se doplaćuje 15€. Ipak, ne savetujemo da isključuješ više od 2-3, jer što manje isključuješ, veće je iznenađenje.<br><br>Ako putuješ iz <strong>Niša</strong>, zbog manjeg pool-a destinacija, možeš isključiti maksimalno 1 destinaciju uz doplatu od 15€.</div></div>
    </details>
  </section>

  <!-- GROUP: Rezervacija -->
  <section class="fq-group" data-group="rez">
    <h2 class="fq-group-title" data-i18n="grp.rez">Rezervacija</h2>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q6">Mogu li da otkažem ili promenim rezervaciju?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a6">Nažalost, putovanje ne može da se otkaže - nudimo konkurentne cene upravo zato što karte i smeštaj rezervišemo unapred, što znači da otkazivanje nije moguće ukoliko je rezervacija napravljena u roku od 90 dana pre polaska.<br><br>Međutim, postoji nekoliko opcija koje ti mogu pomoći:<br>- Ako nisi siguran/na koji datum će ti odgovarati, pošalji nam upit sa datumima koji ti najviše odgovaraju pre nego što zvanično rezervišeš.<br>- Kao dodatak možeš odabrati <strong>fleksibilne karte</strong>, koje ti daju mogućnost promene datuma.<br>- Ako razmišljaš o poklonu, opcija &#8220;Poklon putovanje iznenađenja&#8221; omogućava da se datumi ne fiksiraju sve do 30-60 dana pre polaska.<br><br>Hoteli se u nekim slučajevima mogu otkazati, ali to zavisi od uslova konkretnog termina.</div></div>
    </details>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q8">Ko organizuje putovanje i da li je Escapii registrovana firma?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a8">Da, <strong>Escapii je registrovana firma</strong>. Sarađujemo sa partnerskim turističkim agencijama sa licencom, sa kojima zajedno kreiramo iznenađenja za tebe. To znači da je svako putovanje organizovano profesionalno i u skladu sa svim propisima.</div></div>
    </details>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q9">Da li mogu da putujem sam/sama?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a9">Apsolutno - imamo puno solo Escapera! Jedina napomena je da se za jednokrevetnu sobu primenjuje <strong>doplata od 60€ po noći</strong>, jer se hotelske sobe standardno rezervišu za dve osobe. Sve ostalo funkcioniše potpuno isto kao i za grupe.</div></div>
    </details>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q10">Da li postoji starosno ograničenje i mogu li da putujem sa decom?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a10">Naša putovanja su otvorena za sve uzraste. Osobe mlađe od 18 godina ne mogu da putuju bez punoletnog pratioca. Deca putuju pod istim uslovima kao i odrasli - sa sopstvenom kartom i smeštajem. Jedina napomena je da za decu mlađu od 2 godine važe posebni uslovi avio kompanija, pa te molimo da nas kontaktiraš pre rezervacije.</div></div>
    </details>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q13">Šta je prilagođeni termin i kako ga rezervisati?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a13">Prilagođeni termin je opcija namenjena putnicima kojima ne odgovaraju dostupni datumi ili žele putovanje organizovano u periodu koji sami odaberu.<br><br>Da biste poslali upit za prilagođeni termin:<br><ol><li>U booking formi izaberite opciju <strong>Prilagođeni termin</strong>.</li><li>Unesite željeni period putovanja i broj putnika.</li><li>Pošaljite upit.</li></ol>Nakon prijema upita, naš tim proverava dostupnost letova i smeštaja, formira ponudu i dostavlja vam sve potrebne informacije. Cena se određuje individualno.</div></div>
    </details>
  </section>

  <!-- GROUP: Pokloni -->
  <section class="fq-group" data-group="poklon">
    <h2 class="fq-group-title" data-i18n="grp.poklon">Pokloni</h2>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q7">Da li mogu da poklonim putovanje nekome?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a7">Da, apsolutno! Postoje dve opcije za poklon putovanje:<br><br><strong>Poklon vaučer</strong> - na stranici <a href="/pokloni-putovanje-iznenadjenja">Pokloni iznenađenje</a> biraš iznos vaučera, unosiš ime i poruku - a mi šaljemo elegantni PDF vaučer koji primalac koristi pri rezervaciji bilo kog Escapii putovanja.<br><br><strong>Personalizovana ponuda</strong> - javi nam se i kreiraćemo ponudu prilagođenu željenom datumu, trajanju i budžetu.<br><br>Naši Escaperi najčešće poklanjaju putovanja iznenađenja za rođendane, godišnjice, devojačke i momačke večeri - jer avantura koja se pamti uvek pobeđuje svaki materijalni poklon.</div></div>
    </details>

    <details class="faq">
      <summary class="faq-q"><h3 data-i18n="q12">Kako funkcioniše poklon vaučer?</h3><span class="faq-ic"></span></summary>
      <div class="faq-a"><div class="faq-a-inner" data-i18n-html="a12">Poklon vaučer je idealan poklon za nekoga ko voli iznenađenja i putovanja. Na stranici <a href="/pokloni-putovanje-iznenadjenja"><strong>Pokloni iznenađenje</strong></a> biraš iznos vaučera, unosiš ime i poruku - a mi šaljemo elegantni PDF vaučer (boarding pass dizajn) na email koji možeš proslediti ili odštampati.<br><br>Primalac unosi kod vaučera pri rezervaciji Escapii putovanja, a iznos se oduzima od ukupne cene. Vaučer važi <strong>godinu dana od aktivacije</strong> i može se iskoristiti na bilo kom Escapii putovanju. Vaučer se ne može razmeniti za gotovinu.</div></div>
    </details>
  </section>


</main>

<?php include get_template_directory() . '/inc/footer.php'; ?>

<script>
// ── i18n ──────────────────────────────────────────────────────────────────
const I18N_EN = {
  'back':'Back to site',
  'badge':'FAQ',
  'h1':'Everything you want to know, in one place',
  'sub':'From pricing and destinations to cancellations and gifts - answers to all your questions about Escapii surprise trips.',
  'cat.all':'All',
  'cat.cena':'Price & payment',
  'cat.dest':'Destinations',
  'cat.rez':'Booking',
  'cat.poklon':'Gifts',
  'grp.cena':'Price & payment',
  'grp.dest':'Destinations',
  'grp.rez':'Booking',
  'grp.poklon':'Gifts',
  'q1':'What\'s included in the trip price?',
  'a1':'The base price includes <strong>round-trip flights</strong>, hotel or apartment accommodation for every night of the trip, and a small carry-on bag - typically a backpack sized 40×30×20 cm, up to 10 kg. If you selected any add-ons, those are included in your trip as well.',
  'q2':'When will I find out where I\'m going?',
  'a2':'We\'ll send you a weather forecast by email <strong>7 days before departure</strong> - no destination revealed yet. You\'ll find out your destination <strong>48 hours before departure</strong>, along with all flight and accommodation details. If you opted for the Reveal Box, it arrives between 2 and 5 days before departure.',
  'q3':'How does Escapii choose my destination?',
  'a3':'We choose based on several factors - flight availability on your selected dates, price, accommodation quality, and current options from our partner agency. Every destination in our pool has been carefully vetted, and our goal is always to find the best option for your date and budget. The rest is a surprise.',
  'q4':'What if I get a destination I don\'t like?',
  'a4':'We get it - that\'s a completely valid question. It\'s possible you\'ll receive a destination you wouldn\'t have picked yourself, but that\'s kind of the whole point. Sometimes it\'s not about where you are, but what you experience when you get there. Our trips are short weekend adventures, and every destination in our pool has plenty to see, do, and discover. On top of that, you\'ll get our guide with insider tips, local recommendations, discounts, and ideas for making the most of 2-3 days in that city.',
  'q5':'Can I exclude destinations?',
  'a5':'Yes, you can! During booking, you have the option to exclude destinations you don\'t want to visit.<br><br>If you\'re departing from <strong>Belgrade</strong>, you can exclude up to 4 destinations - the first one is free, and each additional costs +15€.<br><br>If you\'re departing from <strong>Niš</strong>, due to the smaller destination pool, you can exclude a maximum of 1 destination for a fee of 15€.',
  'q6':'Can I cancel or change my booking?',
  'a6':'Unfortunately, trips cannot be canceled - we offer competitive prices precisely because we book flights and accommodation in advance, which means cancellations are not possible once a reservation is made within 90 days of departure.<br><br>However, there are a few options that may help:<br>- Send us an inquiry with your preferred dates before you officially book.<br>- As an add-on, you can choose <strong>flexible tickets</strong>, which give you the option to change dates.<br>- The "Gift Surprise Trip" option allows dates to remain unfixed until 30-60 days before departure.<br><br>Hotels can in some cases be canceled, depending on the specific trip conditions.',
  'q7':'Can I give a trip as a gift?',
  'a7':'Yes, absolutely! There are two ways to gift a surprise trip:<br><br><strong>Gift voucher</strong> - on the <a href="/pokloni-putovanje-iznenadjenja">Pokloni iznenađenje</a> page, choose a voucher amount, enter a name and message - we\'ll send a beautifully designed PDF voucher the recipient uses when booking any Escapii trip.<br><br><strong>Personalized offer</strong> - just reach out and we\'ll create an offer tailored to the dates, duration, and budget that works for you.',
  'q8':'Who organizes the trip and is Escapii a registered company?',
  'a8':'Yes, <strong>Escapii is a registered company</strong>. We work with licensed partner travel agencies to co-create surprises for you. This means every trip is organized professionally and in full compliance with all regulations.',
  'q9':'Can I travel alone?',
  'a9':'Absolutely - we have plenty of solo Escapers! The only thing to note is that a <strong>single room supplement of 60€ per night</strong> applies, since hotel rooms are standardly reserved for two people. Everything else works exactly the same as for groups.',
  'q10':'Is there an age limit, and can I travel with children?',
  'a10':'Our trips are open to all ages. Anyone under 18 cannot travel without an adult companion. Children travel under the same conditions as adults - with their own ticket and accommodation. The only note is that children under 2 are subject to special airline conditions, so please contact us before booking.',
  'q11':'How does payment work?',
  'a11':'After you submit your inquiry, our team will contact you within 24 hours with all the details and payment information. Your booking is confirmed only after payment is received. Once payment is completed, you\'ll receive a confirmation by email.<br><br>Payment is made directly to our account - no card fees, no hidden costs. The price you see on the site is the price you pay.',
  'q12':'How does a gift voucher work?',
  'a12':'A gift voucher is the perfect gift for someone who loves surprises and travel. On the <a href="/pokloni-putovanje-iznenadjenja"><strong>Pokloni iznenađenje</strong></a> page, choose a voucher amount, enter the recipient\'s name and a personal message - we\'ll send a beautifully designed PDF voucher (boarding pass style) ready to forward or print.<br><br>The recipient enters the voucher code when booking an Escapii trip, and the amount is deducted from the total price. Vouchers are valid for <strong>one year from activation</strong>. Vouchers cannot be exchanged for cash.',
  'q13':'What is a custom trip and how do I book one?',
  'a13':'A custom trip is designed for travellers who don\'t find the available dates suitable, or who wish to travel in a period of their own choosing.<br><br>To submit a request:<br><ol><li>Select the <strong>Custom Trip</strong> option in the booking form.</li><li>Enter your preferred travel period and number of travellers.</li><li>Submit the request.</li></ol>After receiving your inquiry, our team checks availability, prepares a quote, and sends you all the necessary information. Pricing is determined individually.',
  'ft.desc':'Surprise trips for people ready to let go of control and try something different.',
  'ft.nav':'Navigation', 'ft.book':'Book a trip', 'ft.dest':'Destinations',
  'ft.how':'How it works', 'ft.who':'Who it\'s for', 'ft.faq':'FAQ',
  'ft.gift':'🎁 Gift a trip', 'ft.dep':'Departures', 'ft.contact':'Contact',
  'ft.rights':'All rights reserved', 'ft.terms':'Terms of Use', 'ft.privacy':'Privacy Policy',
  'nav.status':'My reservation',
  'snav.how':'How it works', 'snav.about':'About us', 'snav.dest':'Destinations',
  'snav.who':'Who\'s it for', 'snav.faq':'FAQ', 'snav.blog':'Blog',
  'snav.call':'✉ Contact us', 'snav.call.hours':'info@escapii.rs',
  'snav.book':'Book now', 'snav.book.cta':'Book now →',
  'nav.gift.label':'Gift a Surprise', 'nav.gift.offer':'Gift a Surprise Trip',
  'nav.gift.offer.sub':'Gift the perfect present for a travel lover',
  'nav.gift.redeem':'Redeem gift',
  'nav.gift.redeem.sub':'Have a gift code? Activate it here'
};

const I18N_SR = {};
document.querySelectorAll('[data-i18n]').forEach(el => { I18N_SR[el.getAttribute('data-i18n')] = el.textContent; });
document.querySelectorAll('[data-i18n-html]').forEach(el => { I18N_SR[el.getAttribute('data-i18n-html')] = el.innerHTML; });

let lang = localStorage.getItem('esc-lang') || 'sr';

function applyLang() {
  const dict = lang === 'en' ? I18N_EN : I18N_SR;
  document.querySelectorAll('[data-i18n]').forEach(el => {
    const k = el.getAttribute('data-i18n');
    if (dict[k] !== undefined) el.textContent = dict[k];
  });
  document.querySelectorAll('[data-i18n-html]').forEach(el => {
    const k = el.getAttribute('data-i18n-html');
    if (dict[k] !== undefined) el.innerHTML = dict[k];
  });
  document.querySelectorAll('.lang-btn').forEach(b => {
    b.classList.toggle('on', b.textContent.trim() === lang.toUpperCase());
  });
  document.documentElement.lang = lang;
  // update search placeholder
  const inp = document.getElementById('fqSearch');
  if (inp) inp.placeholder = lang === 'en' ? 'Search questions…' : 'Pretraži pitanja…';
}

function setLang(l) {
  lang = l; localStorage.setItem('esc-lang', l); applyLang();
}

// ── Accordion ─────────────────────────────────────────────────────────────
var allFaqs = document.querySelectorAll('.faq');

function setOpen(f, on) {
  f.classList.toggle('open', on);
  var a = f.querySelector('.faq-a');
  a.style.maxHeight = on ? (a.querySelector('.faq-a-inner').scrollHeight + 'px') : '0px';
}

allFaqs.forEach(function(f) {
  f.querySelector('.faq-q').addEventListener('click', function(e) {
    e.preventDefault();
    var willOpen = !f.classList.contains('open');
    allFaqs.forEach(function(o) { if (o !== f) { o.removeAttribute('open'); setOpen(o, false); } });
    f.toggleAttribute('open', willOpen);
    setOpen(f, willOpen);
  });
  setOpen(f, f.hasAttribute('open'));
});

// ── Category filter ────────────────────────────────────────────────────────
var catsEl = document.getElementById('fqCats');
catsEl.addEventListener('click', function(e) {
  var b = e.target.closest('.fq-cat'); if (!b) return;
  catsEl.querySelectorAll('.fq-cat').forEach(function(x) { x.classList.remove('active'); });
  b.classList.add('active');
  var cat = b.dataset.cat;
  document.querySelectorAll('.fq-group').forEach(function(g) {
    g.style.display = (cat === 'all' || g.dataset.group === cat) ? '' : 'none';
  });
});

// ── Nav functions (identične homepage-u) ─────────────────────────────────
function togBurger() {
  var burger = document.getElementById('navBurger');
  var menu   = document.getElementById('mobMenu');
  var open   = burger.classList.toggle('open');
  menu.classList.toggle('open', open);
  document.body.style.overflow = open ? 'hidden' : '';
}
function closeMobMenu() {
  document.getElementById('navBurger').classList.remove('open');
  document.getElementById('mobMenu').classList.remove('open');
  document.body.style.overflow = '';
}
function togMobGift() {
  document.getElementById('mobGiftToggle').classList.toggle('open');
  document.getElementById('mobGiftSub').classList.toggle('open');
}
function toggleSecGift() {
  var btn  = document.getElementById('secGiftBtn');
  var drop = document.getElementById('secGiftDrop');
  var open = btn.classList.toggle('open');
  if (open) {
    var r = btn.getBoundingClientRect();
    drop.style.top   = (r.bottom + 6) + 'px';
    drop.style.right = (window.innerWidth - r.right) + 'px';
    drop.style.left  = 'auto';
  }
  drop.classList.toggle('open', open);
}
function closeSecGift() {
  document.getElementById('secGiftBtn').classList.remove('open');
  document.getElementById('secGiftDrop').classList.remove('open');
}
document.addEventListener('click', function(e) {
  if (!e.target.closest('#secGiftWrap') && !e.target.closest('#secGiftDrop')) closeSecGift();
});
document.addEventListener('click', function(e) {
  if (!e.target.closest('#mobMenu') && !e.target.closest('#navBurger')) {
    closeMobMenu();
  }
});

if (lang === 'en') applyLang();
</script>

<?php wp_footer(); ?>
</body>
</html>
