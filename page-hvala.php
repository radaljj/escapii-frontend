<?php
/**
 * Template Name: Thank You Page
 * Prikazuje se nakon uspešnog slanja booking upita.
 * URL: /hvala?ref=ESC-XXXX
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upit primljen — Escapii</title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,700;1,400&family=JetBrains+Mono:wght@500;700&family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --navy:   #EFE9E7;
      --navy2:  #FFFFFF;
      --gold:   #CA8A71;
      --gold2:  #B57560;
      --white:  #2D5F6B;
      --gray:   #7A9FA8;
      --green:  #22c55e;
      --teal:   #BFD8DE;
    }
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: var(--navy); color: var(--white);
      min-height: 100vh; display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      padding: 40px 24px;
    }

    /* ── CONFETTI CANVAS ── */
    #confetti-canvas {
      position: fixed; inset: 0; pointer-events: none; z-index: 0;
    }

    /* ── CARD ── */
    .ty-card {
      position: relative; z-index: 1;
      max-width: 720px; width: 100%;
      background: var(--navy2);
      border: 1px solid rgba(15,45,53,.08);
      border-radius: 28px;
      padding: 52px 48px;
      text-align: center;
      box-shadow: 0 32px 80px rgba(0,0,0,.5);
      animation: fadeUp .7s cubic-bezier(.4,0,.2,1) both;
    }
    @keyframes fadeUp {
      from { opacity:0; transform:translateY(32px); }
      to   { opacity:1; transform:none; }
    }

    /* ── ICON ── */
    .ty-icon {
      width: 80px; height: 80px; margin: 0 auto 28px;
      background: rgba(34,197,94,.12);
      border: 2px solid rgba(34,197,94,.3);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 36px;
      animation: popIn .6s .3s cubic-bezier(.34,1.56,.64,1) both;
    }
    @keyframes popIn {
      from { opacity:0; transform:scale(.4); }
      to   { opacity:1; transform:scale(1); }
    }

    /* ── HEADING ── */
    .ty-h1 {
      font-size: clamp(26px, 5vw, 36px);
      font-weight: 900; letter-spacing: -1px;
      margin-bottom: 12px;
    }
    .ty-sub {
      font-size: 16px; color: var(--gray); line-height: 1.65; margin-bottom: 32px;
    }

    /* ── REF BADGE ── */
    .ty-ref {
      background: rgba(202,138,113,.1);
      border: 1px solid rgba(202,138,113,.25);
      border-radius: 14px;
      padding: 18px 24px;
      margin-bottom: 36px;
    }
    .ty-ref-label {
      font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
      text-transform: uppercase; color: var(--gray); margin-bottom: 6px;
    }
    .ty-ref-code {
      font-size: 24px; font-weight: 900; color: #CA8A71;
      letter-spacing: 2px;
    }

    /* ── STEPS ── */
    .ty-steps {
      display: flex; flex-direction: column; gap: 0;
      margin-bottom: 36px; text-align: left;
    }
    .ty-step {
      display: flex; align-items: flex-start; gap: 16px;
      padding: 16px 0;
      border-bottom: 1px solid rgba(15,45,53,.06);
    }
    .ty-step:last-child { border-bottom: none; }
    .ty-step-num {
      flex-shrink: 0;
      width: 28px; height: 28px; border-radius: 50%;
      background: rgba(202,138,113,.15);
      border: 1px solid rgba(202,138,113,.3);
      display: flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 800; color: var(--gold);
      margin-top: 1px;
    }
    .ty-step-body {}
    .ty-step-title {
      font-size: 14px; font-weight: 700; color: var(--white); margin-bottom: 2px;
    }
    .ty-step-desc { font-size: 13px; color: var(--gray); line-height: 1.5; }
    .ty-step-desc strong { color: rgba(15,45,53,.85); }

    /* ── BUTTON ── */
    .ty-btn {
      display: inline-block;
      background: var(--gold); color: #FFFFFF;
      border: none; padding: 15px 40px;
      border-radius: 100px; font-size: 15px; font-weight: 800;
      cursor: pointer; text-decoration: none;
      transition: all .2s; box-shadow: 0 8px 28px rgba(202,138,113,.35);
    }
    .ty-btn:hover { background: var(--gold2); transform: translateY(-2px); box-shadow: 0 12px 36px rgba(202,138,113,.45); }

    /* ── LOGO ── */
    .ty-logo {
      position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
      text-decoration: none; z-index: 10; display: inline-flex; align-items: center;
    }
    .ty-logo img { height: 42px; width: auto; display: block; }
    @media (max-width: 560px) { .ty-logo img { height: 34px; } }

    /* ── INSTAGRAM ── */
    .ty-ig {
      margin-top: 24px; font-size: 13px; color: var(--gray);
    }
    .ty-ig a { color: var(--gold); text-decoration: none; font-weight: 600; }
    .ty-ig a:hover { text-decoration: underline; }

    /* ── BOARDING PASS ── */
    .bp-wrap {
      font-family: 'Manrope', sans-serif;
      width: 100%; margin-bottom: 28px;
      border-radius: 28px; overflow: hidden; position: relative;
      background: linear-gradient(180deg, #fbf7ee 0%, #f5efe2 100%);
      box-shadow: 0 20px 60px -20px rgba(80,55,30,0.3), 0 0 0 1px rgba(255,255,255,0.5) inset;
      opacity: 0; transform: translateY(16px);
      transition: opacity .6s ease .3s, transform .6s ease .3s;
    }
    .bp-wrap.visible { opacity: 1; transform: none; }

    .bp-arc {
      position: absolute; top: 0; left: 0; right: 0; height: 160px;
      background: radial-gradient(ellipse 70% 100% at 80% 0%, rgba(226,144,112,0.25), transparent 70%),
                  linear-gradient(135deg, #a85e44 0%, #c8775a 50%, #e29070 100%);
      border-radius: 28px 28px 0 0; overflow: hidden;
    }
    .bp-arc::before {
      content: ''; position: absolute; top: -60%; right: -10%;
      width: 320px; height: 320px; border-radius: 50%;
      background: radial-gradient(circle, rgba(255,255,255,0.18), transparent 60%);
    }
    .bp-arc::after {
      content: ''; position: absolute; inset: 0;
      background: repeating-linear-gradient(115deg, transparent 0 28px, rgba(255,255,255,0.04) 28px 29px);
    }

    .bp-head {
      position: relative; z-index: 2;
      padding: 20px 28px 80px;
      display: flex; align-items: center; justify-content: space-between; gap: 16px;
    }
    .bp-brand-row { display: flex; align-items: center; gap: 12px; }
    .bp-logo { height: 28px; width: auto; display: block; }
    .bp-divider { width: 1px; height: 16px; background: rgba(255,255,255,0.4); flex-shrink: 0; }
    .bp-flight-no {
      font-family: 'JetBrains Mono', monospace; font-size: 10px;
      letter-spacing: 0.18em; font-weight: 500; color: rgba(255,255,255,0.8);
    }
    .bp-pill {
      display: inline-flex; align-items: center; gap: 7px;
      font-size: 9px; letter-spacing: 0.3em; text-transform: uppercase;
      font-weight: 700; padding: 6px 12px; border-radius: 100px;
      background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.3); color: #fff;
    }
    .bp-pill-dot {
      width: 5px; height: 5px; border-radius: 50%; background: #fff;
      box-shadow: 0 0 7px rgba(255,255,255,0.8);
      animation: bpPulse 1.6s ease-in-out infinite;
    }
    @keyframes bpPulse { 0%,100%{opacity:1;transform:scale(1);} 50%{opacity:.5;transform:scale(.8);} }

    .bp-body {
      position: relative; z-index: 2;
      margin: -46px 20px 0;
      background: #fff; border-radius: 20px; padding: 30px 32px 24px;
      box-shadow: 0 16px 40px -16px rgba(80,55,30,0.16), 0 0 0 1px rgba(26,20,16,0.04);
    }

    .bp-route { display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; gap: 16px; margin-bottom: 24px; }
    .bp-city .bp-iata {
      font-family: 'Cormorant Garamond', serif; font-size: 56px; font-weight: 700;
      line-height: 0.95; letter-spacing: -0.02em; color: #1a1410;
    }
    .bp-city .bp-iata.mystery { color: #a85e44; font-style: italic; letter-spacing: 0.02em; }
    .bp-city .bp-city-name { font-size: 13px; font-weight: 600; margin-top: 7px; color: #1a1410; }
    .bp-city .bp-city-sub  { font-size: 11px; color: #a89888; margin-top: 2px; }
    .bp-city.right { text-align: right; }

    .bp-path { display: flex; align-items: center; gap: 8px; min-width: 110px; }
    .bp-dot { width: 8px; height: 8px; border-radius: 50%; background: #c8775a; flex-shrink: 0; box-shadow: 0 0 0 4px rgba(200,119,90,0.15); }
    .bp-dot.dashed { background: transparent; border: 2px dashed #c8775a; }
    .bp-path-line {
      flex: 1; height: 2px;
      background-image: linear-gradient(90deg, #c8775a 50%, transparent 50%);
      background-size: 7px 2px; background-repeat: repeat-x;
      position: relative; display: flex; align-items: center; justify-content: center;
    }
    .bp-plane {
      width: 26px; height: 26px; background: #fff; color: #c8775a;
      border-radius: 50%; padding: 5px; border: 1.5px solid #c8775a;
      box-shadow: 0 4px 12px -2px rgba(200,119,90,0.4);
      animation: bpFly 4s ease-in-out infinite;
    }
    @keyframes bpFly { 0%,100%{transform:translateX(-3px);} 50%{transform:translateX(3px);} }

    .bp-meta {
      display: grid; grid-template-columns: 1fr auto 1fr auto 1fr;
      align-items: center; padding: 16px 2px;
      background: linear-gradient(135deg, rgba(200,119,90,0.06), rgba(200,119,90,0.02));
      border: 1px solid rgba(200,119,90,0.15); border-radius: 12px; margin-bottom: 20px;
    }
    .bp-meta-cell { padding: 0 16px; }
    .bp-meta-label { font-size: 8px; letter-spacing: 0.28em; text-transform: uppercase; color: #a89888; font-weight: 700; }
    .bp-meta-value {
      font-family: 'JetBrains Mono', monospace; font-size: 13px; font-weight: 700;
      margin-top: 4px; color: #1a1410; letter-spacing: 0.02em;
    }
    .bp-meta-div { width: 1px; height: 24px; background: rgba(200,119,90,0.18); }

    .bp-bottom { display: flex; align-items: flex-start; justify-content: space-between; padding-top: 18px; border-top: 1.5px dashed rgba(26,20,16,0.12); }
    .bp-pax-row { display: flex; align-items: flex-start; gap: 10px; }
    .bp-avatar {
      width: 36px; height: 36px; border-radius: 50%;
      background: linear-gradient(135deg, #e29070, #c8775a); color: #fff;
      display: flex; align-items: center; justify-content: center;
      font-weight: 700; font-size: 12px; letter-spacing: 0.04em;
      box-shadow: 0 5px 12px -3px rgba(200,119,90,0.5); flex-shrink: 0; margin-top: 2px;
    }
    .bp-pax-label { font-size: 8px; letter-spacing: 0.28em; text-transform: uppercase; color: #a89888; font-weight: 700; margin-bottom: 4px; }
    .bp-pax-name  { font-size: 14px; font-weight: 700; color: #1a1410; line-height: 1.4; }
    .bp-pax-extra { font-size: 12px; font-weight: 600; color: #6b5d4f; }
    .bp-ref { text-align: right; }
    .bp-ref-label { font-size: 8px; letter-spacing: 0.28em; text-transform: uppercase; color: #a89888; font-weight: 700; }
    .bp-ref-code  { font-family: 'JetBrains Mono', monospace; font-size: 13px; font-weight: 700; color: #a85e44; margin-top: 3px; letter-spacing: 0.04em; }

    .bp-tear { margin-top: 20px; display: flex; align-items: center; }
    .bp-tear-line { flex: 1; height: 1px; background-image: linear-gradient(90deg, rgba(26,20,16,0.18) 50%, transparent 50%); background-size: 6px 1px; background-repeat: repeat-x; }
    .bp-tear-circle { width: 26px; height: 26px; background: radial-gradient(ellipse at top, #EFE9E7, #ebe2d1); border-radius: 50%; flex-shrink: 0; }
    .bp-tear-circle.left { margin-left: -13px; }
    .bp-tear-circle.right { margin-right: -13px; }

    .bp-stub { padding: 18px 32px 24px; display: grid; grid-template-columns: 1fr 1fr 1fr 2fr; align-items: center; gap: 18px; }
    .bp-stub-label { font-size: 8px; letter-spacing: 0.28em; text-transform: uppercase; color: #a89888; font-weight: 700; }
    .bp-stub-value { font-family: 'JetBrains Mono', monospace; font-size: 14px; font-weight: 700; color: #1a1410; margin-top: 4px; }
    .bp-barcode { display: flex; align-items: stretch; gap: 2px; height: 40px; justify-content: flex-end; }
    .bp-barcode span { background: #1a1410; border-radius: 1px; }
    .bp-barcode span:nth-child(1){width:2px} .bp-barcode span:nth-child(2){width:4px} .bp-barcode span:nth-child(3){width:1px}
    .bp-barcode span:nth-child(4){width:3px} .bp-barcode span:nth-child(5){width:2px} .bp-barcode span:nth-child(6){width:5px}
    .bp-barcode span:nth-child(7){width:1px} .bp-barcode span:nth-child(8){width:2px} .bp-barcode span:nth-child(9){width:4px}
    .bp-barcode span:nth-child(10){width:2px} .bp-barcode span:nth-child(11){width:1px} .bp-barcode span:nth-child(12){width:3px}
    .bp-barcode span:nth-child(13){width:2px} .bp-barcode span:nth-child(14){width:5px} .bp-barcode span:nth-child(15){width:1px}
    .bp-barcode span:nth-child(16){width:4px} .bp-barcode span:nth-child(17){width:2px} .bp-barcode span:nth-child(18){width:3px}
    .bp-barcode span:nth-child(19){width:1px} .bp-barcode span:nth-child(20){width:2px} .bp-barcode span:nth-child(21){width:5px}
    .bp-barcode span:nth-child(22){width:1px} .bp-barcode span:nth-child(23){width:3px} .bp-barcode span:nth-child(24){width:2px}

    @media (max-width: 560px) {
      .ty-card { padding: 28px 12px; border-radius: 20px; }
      .bp-wrap { border-radius: 20px; }
      .bp-head { padding: 14px 14px 68px; }
      .bp-flight-no { display: none; }
      .bp-body { margin: -42px 8px 0; padding: 20px 14px 16px; }
      .bp-city .bp-iata { font-size: 34px; }
      .bp-route { gap: 8px; }
      .bp-path { min-width: 70px; }
      .bp-meta { grid-template-columns: 1fr auto 1fr auto 1fr; padding: 10px 0; }
      .bp-meta-cell { padding: 0 6px; }
      .bp-meta-label { font-size: 7px; letter-spacing: 0.18em; }
      .bp-meta-value { font-size: 10px; }
      .bp-stub { grid-template-columns: 1fr 1fr; padding: 14px 14px 18px; }
      .bp-barcode { grid-column: 1 / -1; height: 32px; }
      .bp-bottom { flex-direction: column; gap: 12px; }
      .bp-ref { text-align: left; }
    }
  </style>
</head>
<body>

<canvas id="confetti-canvas"></canvas>

<a href="/" class="ty-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Escapii"></a>

<div class="ty-card">

  <div class="ty-icon">✓</div>

  <h1 class="ty-h1">Upit je primljen!</h1>
  <p class="ty-sub">Javićemo ti se u roku od <strong style="color:#2D5F6B">24 sata</strong> sa svim detaljima. Tvoje tajno putovanje te čeka!</p>

  <!-- BOARDING PASS -->
  <div class="bp-wrap" id="boardingPass">
    <div class="bp-arc"></div>

    <div class="bp-head">
      <div class="bp-brand-row">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo-white.svg"
             alt="escapii" class="bp-logo"
             onerror="this.outerHTML='<span style=\'font-family:Georgia,serif;font-style:italic;font-size:20px;color:#fff;\'>escapii</span>'">
        <span class="bp-divider"></span>
        <span class="bp-flight-no" id="bp-flight-no">FLIGHT · ESC0001</span>
      </div>
      <span class="bp-pill">
        <span class="bp-pill-dot"></span>
        BOARDING PASS
      </span>
    </div>

    <div class="bp-body">
      <div class="bp-route">
        <div class="bp-city">
          <div class="bp-iata" id="bp-iata">BEG</div>
          <div class="bp-city-name" id="bp-city-name">Beograd</div>
          <div class="bp-city-sub" id="bp-city-sub">Polazni aerodrom</div>
        </div>
        <div class="bp-path">
          <span class="bp-dot"></span>
          <div class="bp-path-line">
            <svg class="bp-plane" viewBox="0 0 24 24" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z" transform="rotate(90 12 12)"/></svg>
          </div>
          <span class="bp-dot dashed"></span>
        </div>
        <div class="bp-city right">
          <div class="bp-iata mystery">???</div>
          <div class="bp-city-name" id="bp-dest-label">Iznenađenje</div>
          <div class="bp-city-sub" id="bp-dest-sub">otkrij 48h pre polaska</div>
        </div>
      </div>

      <div class="bp-meta">
        <div class="bp-meta-cell">
          <div class="bp-meta-label" id="bpl-dep">Polazak</div>
          <div class="bp-meta-value" id="bp-dep-date">—</div>
        </div>
        <div class="bp-meta-div"></div>
        <div class="bp-meta-cell">
          <div class="bp-meta-label" id="bpl-ret">Povratak</div>
          <div class="bp-meta-value" id="bp-ret-date">—</div>
        </div>
        <div class="bp-meta-div"></div>
        <div class="bp-meta-cell">
          <div class="bp-meta-label" id="bpl-n">Putnika</div>
          <div class="bp-meta-value" id="bp-n">1</div>
        </div>
      </div>

      <div class="bp-bottom">
        <div class="bp-pax-row">
          <div class="bp-avatar" id="bp-avatar">?</div>
          <div>
            <div class="bp-pax-label" id="bpl-pax">Putnici</div>
            <div id="bp-pax-names"></div>
          </div>
        </div>
        <div class="bp-ref">
          <div class="bp-ref-label" id="bpl-ref">Rezervacija</div>
          <div class="bp-ref-code" id="bp-ref-code">—</div>
        </div>
      </div>
    </div>

    <div class="bp-tear">
      <span class="bp-tear-circle left"></span>
      <span class="bp-tear-line"></span>
      <span class="bp-tear-circle right"></span>
    </div>

    <div class="bp-stub">
      <div>
        <div class="bp-stub-label">Gate</div>
        <div class="bp-stub-value">—</div>
      </div>
      <div>
        <div class="bp-stub-label">Boarding</div>
        <div class="bp-stub-value">USKORO</div>
      </div>
      <div>
        <div class="bp-stub-label" id="bpl-seat">Sedište</div>
        <div class="bp-stub-value">—</div>
      </div>
      <div class="bp-barcode">
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span>
      </div>
    </div>
  </div>

  <div class="ty-steps">
    <div class="ty-step">
      <div class="ty-step-num">1</div>
      <div class="ty-step-body">
        <div class="ty-step-title" id="step1-title">Tim Escapii vam se javlja u roku od 24 sata</div>
        <div class="ty-step-desc" id="step1-desc">Proveravamo dostupnost i potvrđujemo vašu rezervaciju.</div>
      </div>
    </div>
    <div class="ty-step">
      <div class="ty-step-num">2</div>
      <div class="ty-step-body">
        <div class="ty-step-title" id="step2-title">Detalji rezervacije i uplata</div>
        <div class="ty-step-desc" id="step2-desc">Javićemo vam se sa svim detaljima — koracima za uplatu, pravilima putovanja i svim informacijama koje su vam potrebne pre polaska.</div>
      </div>
    </div>
    <div class="ty-step">
      <div class="ty-step-num">3</div>
      <div class="ty-step-body">
        <div class="ty-step-title" id="step3-title">Vremenska prognoza — 7 dana pre polaska</div>
        <div class="ty-step-desc" id="step3-desc">Dobijate prognozu da znate šta da spakujete. Destinacija? I dalje tajna. 🌤</div>
      </div>
    </div>
    <div class="ty-step">
      <div class="ty-step-num">4</div>
      <div class="ty-step-body">
        <div class="ty-step-title" id="step4-title">Koverta s destinacijom — 48h pre polaska</div>
        <div class="ty-step-desc" id="step4-desc">Koverta otkriva gde putujete. ✉</div>
      </div>
    </div>
  </div>

  <a href="/" class="ty-btn">← Nazad na početnu</a>

  <div class="ty-ig">
    Prati nas na Instagramu za sneak peekove →
    <a href="https://www.instagram.com/escapii.rs?igsh=NmMwY3djcHFncjg2&utm_source=qr" target="_blank" rel="noopener">@escapii.rs</a>
  </div>

</div>

<script>
// ── Boarding pass animacija ───────────────────────────────────────────────

// Pročitaj iz sessionStorage (setuje se iz front-page.php prije redirecta)
const bpRaw = sessionStorage.getItem('esc_bp');
const bp    = bpRaw ? JSON.parse(bpRaw) : null;

// Fallback: ref iz URL-a ako nema sessionStorage podataka
const urlRef = new URLSearchParams(window.location.search).get('ref') || '';

// Formatiraj datum iz "2026-04-20" → "21.05.2026"
const lang = localStorage.getItem('esc-lang') || 'sr';
function fmtDate(iso) {
  if (!iso) return '—';
  const [y, m, d] = iso.split('-');
  return d + '.' + m + '.' + y;
}

// Typewriter efekat
function typeIn(el, text, charDelay) {
  el.textContent = '';
  let i = 0;
  const tick = () => {
    if (i <= text.length) { el.textContent = text.slice(0, i); i++; setTimeout(tick, charDelay); }
  };
  tick();
}

// Airport helper
const AIRPORT_CITIES = { BEG:'Beograd', INI:'Niš', ZAG:'Zagreb', BUD:'Budimpešta', TIM:'Timișoara' };
function airportCity(iata) { return AIRPORT_CITIES[iata] || iata; }

function avatarInitials(names) {
  if (!names || !names.length) return '?';
  const parts = names[0].trim().split(/\s+/);
  return parts.length >= 2
    ? (parts[0][0] + parts[parts.length-1][0]).toUpperCase()
    : (parts[0][0] || '?').toUpperCase();
}

// Popuni boarding pass
function fillBoardingPass() {
  const airport   = (bp?.airport || '').toUpperCase();
  const depDate   = fmtDate(bp?.date || '');
  const retDate   = fmtDate(bp?.returnDate || '');
  const ref       = bp?.ref || urlRef;
  const n         = bp?.travelers || 1;
  const paxNames  = (bp?.passengers && bp.passengers.length) ? bp.passengers : [bp?.name || '—'];

  const wrap = document.getElementById('boardingPass');
  if (wrap) setTimeout(() => wrap.classList.add('visible'), 200);

  // IATA + city
  setTimeout(() => {
    const el = document.getElementById('bp-iata');
    if (el) typeIn(el, airport || 'BEG', 80);
    const cn = document.getElementById('bp-city-name');
    if (cn) cn.textContent = airportCity(airport);
    // Flight no
    const fn = document.getElementById('bp-flight-no');
    if (fn) fn.textContent = 'FLIGHT · ' + (ref || 'ESC0001').replace('ESC-','ESC').toUpperCase();
  }, 400);

  // Datumi
  setTimeout(() => {
    const d = document.getElementById('bp-dep-date');
    if (d) typeIn(d, depDate, 35);
  }, 650);
  setTimeout(() => {
    const r = document.getElementById('bp-ret-date');
    if (r) r.textContent = retDate;
  }, 900);

  // Putnika
  setTimeout(() => {
    const el = document.getElementById('bp-n');
    if (el) el.textContent = n;
  }, 950);

  // Avatar + putnici
  setTimeout(() => {
    const av = document.getElementById('bp-avatar');
    if (av) av.textContent = avatarInitials(paxNames);

    const paxEl = document.getElementById('bp-pax-names');
    if (paxEl) {
      paxEl.innerHTML = paxNames.map((name, i) =>
        i === 0
          ? `<div class="bp-pax-name">${name}</div>`
          : `<div class="bp-pax-extra">${name}</div>`
      ).join('');
    }
  }, 1100);

  // Ref — typewriter
  setTimeout(() => {
    const rc = document.getElementById('bp-ref-code');
    if (rc) typeIn(rc, ref || '—', 50);
  }, 1300);
}

fillBoardingPass();

// ── Prevod na osnovu odabranog jezika
const TY = {
  en: {
    h1:    'Request received!',
    sub:   'We\'ll get back to you within <strong style="color:white">24 hours</strong> with all the details. Your secret trip is waiting!',
    bpDep:'Departure', bpRet:'Return', bpN:'Passengers', bpPax:'Passengers', bpRef:'Booking', bpSeat:'Seat',
    s1t:   'The Escapii team will reach out within 24 hours',
    s1d:   'We verify availability and confirm your reservation.',
    s2t:   'Reservation details & payment',
    s2d:   'We\'ll send you all the details — payment steps, travel rules and everything you need to know before departure.',
    s3t:   'Weather forecast — 7 days before departure',
    s3d:   'You\'ll get a forecast so you know what to pack. Destination? Still a secret. 🌤',
    s4t:   'Destination envelope — 48h before departure',
    s4d:   'The envelope reveals where you\'re going. ✉',
    btn:   '← Back to home',
    ig:    'Follow us on Instagram for sneak peeks →',
  }
};

(function applyLang() {
  if (lang !== 'en') return;
  const tr = TY.en;
  document.querySelector('.ty-h1').textContent  = tr.h1;
  document.querySelector('.ty-sub').innerHTML   = tr.sub;
  const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
  set('bpl-dep', tr.bpDep); set('bpl-ret', tr.bpRet);
  set('bpl-n', tr.bpN); set('bpl-pax', tr.bpPax); set('bpl-ref', tr.bpRef); set('bpl-seat', tr.bpSeat);
  if (lang === 'en') {
    const destLbl = document.getElementById('bp-dest-label'); if (destLbl) destLbl.textContent = 'Surprise';
    const destSub = document.getElementById('bp-dest-sub');   if (destSub) destSub.textContent = 'reveal 48h before departure';
  }
  const setStep = (ti, di, t, d) => { const tel=document.getElementById(ti); const del=document.getElementById(di); if(tel)tel.textContent=t; if(del)del.textContent=d; };
  setStep('step1-title','step1-desc', tr.s1t, tr.s1d);
  setStep('step2-title','step2-desc', tr.s2t, tr.s2d);
  setStep('step3-title','step3-desc', tr.s3t, tr.s3d);
  setStep('step4-title','step4-desc', tr.s4t, tr.s4d);
  document.querySelector('.ty-btn').textContent = tr.btn;
  document.querySelector('.ty-ig').innerHTML = tr.ig + ' <a href="https://www.instagram.com/escapii.rs?igsh=NmMwY3djcHFncjg2&utm_source=qr" target="_blank" rel="noopener">@escapii.rs</a>';
})();

// ── Confetti animacija
(function () {
  const canvas = document.getElementById('confetti-canvas');
  const ctx = canvas.getContext('2d');
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  });

  const colors = ['#f97316','#f59e0b','#22c55e','#2dd4bf','#a78bfa','#f1f5f9'];
  const pieces = Array.from({ length: 120 }, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height - canvas.height,
    w: Math.random() * 10 + 5,
    h: Math.random() * 5 + 3,
    color: colors[Math.floor(Math.random() * colors.length)],
    rot: Math.random() * Math.PI * 2,
    rotSpeed: (Math.random() - .5) * .08,
    speed: Math.random() * 3 + 1.5,
    drift: (Math.random() - .5) * 1.2,
    opacity: Math.random() * .6 + .4,
  }));

  let frame = 0;
  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    pieces.forEach(p => {
      ctx.save();
      ctx.globalAlpha = p.opacity;
      ctx.translate(p.x, p.y);
      ctx.rotate(p.rot);
      ctx.fillStyle = p.color;
      ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
      ctx.restore();
      p.y += p.speed;
      p.x += p.drift;
      p.rot += p.rotSpeed;
      if (p.y > canvas.height + 20) {
        p.y = -20;
        p.x = Math.random() * canvas.width;
      }
    });
    frame++;
    // Zaustavi confetti posle 5 sekundi
    if (frame < 300) requestAnimationFrame(draw);
    else ctx.clearRect(0, 0, canvas.width, canvas.height);
  }
  draw();
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
