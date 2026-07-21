<?php defined('ABSPATH') || exit; ?>
<!DOCTYPE html>
<html lang="sr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Escapii — Uskoro</title>
<style>
  :root {
    --teal:      #1A3A4A;
    --evergreen: #041F1E;
    --coral:     #D85A30;
    --cream:     #FAF7F2;
    --peach:     #F7DBA7;
    --cinnamon:  #C57B57;
    /* koristi ga success animacija ispod */
    --tangerine: #F1AB86;

    /* Isti stek kao ostatak sajta - bez eksternih fontova.
       Mono je sistemski, samo za detalje table i oznaka. */
    --sans: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    --mono: ui-monospace, SFMono-Regular, 'SF Mono', Consolas, 'Liberation Mono', monospace;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body {
    background: var(--evergreen);
    color: var(--cream);
    font-family: var(--sans);
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
  }
  a { color: inherit; }

  /* ── Pozadina: more viđeno kroz prozor aviona ── */
  .sky {
    position: relative;
    min-height: 100vh;
    min-height: 100dvh;
    background: linear-gradient(180deg, #1c3f4c 0%, var(--teal) 30%, #0e2833 55%, var(--evergreen) 100%);
    padding: 0 24px 90px;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow: hidden;
  }
  /* zatamnjene ivice - more se čita kao da se gleda kroz okrugli prozor */
  .sky::after {
    content: "";
    position: fixed;
    inset: 0;
    background: radial-gradient(ellipse 68% 62% at 50% 42%, transparent 55%, rgba(2,10,10,0.55) 88%, rgba(2,10,10,0.85) 100%);
    box-shadow: inset 0 0 140px 40px rgba(0,0,0,0.55);
    pointer-events: none;
    z-index: 1;
  }
  .window-frame {
    position: fixed;
    top: 50%; left: 50%;
    transform: translate(-50%,-50%);
    width: min(90vw, 640px);
    height: min(90vh, 900px);
    border: 2px solid var(--cream);
    border-radius: 50%/38%;
    box-shadow: inset 0 0 0 16px rgba(250,247,242,0.5);
    opacity: .07;
    pointer-events: none;
    z-index: 1;
  }
  .waves { position: absolute; left: 0; width: 100%; pointer-events: none; opacity: .9; }
  .waves svg { display: block; width: 200%; height: auto; }
  .waves.w1 { bottom: 6%; animation: driftLeft 22s linear infinite; }
  .waves.w2 { bottom: 0;  animation: driftRight 30s linear infinite; opacity: .6; }
  @keyframes driftLeft  { from { transform: translateX(0);    } to { transform: translateX(-50%); } }
  @keyframes driftRight { from { transform: translateX(-50%); } to { transform: translateX(0);    } }

  /* ── Zaglavlje ── */
  nav {
    width: 100%;
    max-width: 1040px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 28px 0 0;
    position: relative;
    z-index: 2;
  }
  nav img { height: 40px; }
  .route-pill {
    font-family: var(--mono);
    font-size: 15px;
    font-weight: 500;
    letter-spacing: .08em;
    background: rgba(250,247,242,0.10);
    border: 1px solid rgba(250,247,242,0.22);
    padding: 10px 20px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .route-pill .dest { color: var(--coral); font-weight: 600; }

  /* ── Hero ── */
  .hero {
    max-width: 760px;
    text-align: center;
    padding-top: 64px;
    position: relative;
    z-index: 2;
  }
  .eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: var(--mono);
    font-size: 12.5px;
    letter-spacing: .16em;
    color: var(--peach);
    background: rgba(216,90,48,0.12);
    border: 1px solid rgba(216,90,48,0.35);
    padding: 6px 16px;
    border-radius: 999px;
    margin-bottom: 28px;
  }
  .eyebrow .dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--coral);
    animation: pulse 1.8s ease-in-out infinite;
  }
  @keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: .25; } }

  h1 {
    font-family: var(--sans);
    font-weight: 700;
    font-size: clamp(32px, 6vw, 54px);
    line-height: 1.08;
    letter-spacing: -0.015em;
    margin-bottom: 22px;
  }
  h1 .accent { color: var(--coral); }

  .sub {
    font-size: 17px;
    line-height: 1.65;
    color: rgba(250,247,242,0.78);
    max-width: 520px;
    margin: 0 auto 14px;
  }
  .sub strong { color: var(--cream); font-weight: 600; }
  .timing {
    font-family: var(--mono);
    font-size: 13.5px;
    color: var(--peach);
    letter-spacing: .03em;
    margin-bottom: 48px;
  }

  /* ── Split-flap tabla ── */
  .board-wrap {
    margin: 0 auto 56px;
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }
  .board {
    background: #0d2530;
    border: 1px solid rgba(250,247,242,0.12);
    border-radius: 10px;
    padding: 14px 10px;
    box-shadow: 0 20px 50px -20px rgba(0,0,0,.6), inset 0 1px 0 rgba(255,255,255,.04);
    display: flex;
    gap: 6px;
  }
  .flap {
    position: relative;
    width: clamp(26px, 7vw, 40px);
    height: clamp(38px, 10vw, 56px);
    background: #132f3d;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: inset 0 0 0 1px rgba(250,247,242,0.06);
  }
  .flap::after {
    content: "";
    position: absolute;
    top: 50%; left: 0; right: 0;
    height: 1px;
    background: rgba(0,0,0,.45);
    z-index: 3;
  }
  .flap-char {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--mono);
    font-weight: 500;
    font-size: clamp(18px, 4.2vw, 28px);
    color: var(--peach);
    transition: transform .18s ease-in;
  }
  .flap.locked .flap-char { color: var(--coral); text-shadow: 0 0 18px rgba(216,90,48,.5); }
  .flap.flipping .flap-char { animation: flipDown .42s ease-in-out; }
  @keyframes flipDown {
    0%   { transform: translateY(0); }
    45%  { transform: translateY(6px)  scaleY(0.3); opacity: .3; }
    55%  { transform: translateY(-6px) scaleY(0.3); opacity: .3; }
    100% { transform: translateY(0); }
  }

  /* ── Boarding pass kartica ── */
  .pass {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 460px;
    background: var(--cream);
    color: var(--evergreen);
    border-radius: 18px;
    box-shadow: 0 30px 70px -25px rgba(0,0,0,.55);
  }
  .pass-notch { position: relative; height: 0; padding-top: 22px; }
  .pass-notch::before, .pass-notch::after {
    content: "";
    position: absolute;
    top: 11px;
    width: 22px; height: 22px;
    background: var(--evergreen);
    border-radius: 50%;
  }
  .pass-notch::before { left: -11px; }
  .pass-notch::after  { right: -11px; }
  .perf-line { border-top: 2px dashed rgba(4,31,30,0.18); margin: 0 22px; }

  .pass-bottom { padding: 24px 26px 28px; }
  .pass-bottom p.lead {
    font-size: 13.5px;
    color: rgba(4,31,30,0.82);
    margin-bottom: 16px;
    line-height: 1.5;
  }

  .barcode {
    height: 26px;
    margin: 0 26px 22px;
    background: repeating-linear-gradient(90deg,
      rgba(4,31,30,0.75) 0px,  rgba(4,31,30,0.75) 2px,
      transparent 2px,  transparent 5px,
      rgba(4,31,30,0.75) 5px,  rgba(4,31,30,0.75) 8px,
      transparent 8px,  transparent 11px,
      rgba(4,31,30,0.75) 11px, rgba(4,31,30,0.75) 13px,
      transparent 13px, transparent 18px);
    opacity: .55;
    border-radius: 2px;
  }

  form { display: flex; flex-direction: column; gap: 10px; }
  .field-row { display: flex; gap: 8px; }
  input[type="email"] {
    flex: 1;
    min-width: 0;
    padding: 13px 14px;
    border-radius: 10px;
    border: 1.5px solid rgba(4,31,30,0.26);
    background: #fff;
    font-family: var(--sans);
    font-size: 14.5px;
    color: var(--evergreen);
    outline: none;
    transition: border-color .15s;
  }
  input[type="email"]:focus { border-color: var(--coral); }
  input[type="email"]::placeholder { color: rgba(4,31,30,0.52); }

  .submit-btn {
    padding: 13px 20px;
    border: none;
    border-radius: 10px;
    background: var(--coral);
    color: var(--cream);
    font-family: var(--sans);
    font-weight: 600;
    font-size: 14.5px;
    cursor: pointer;
    white-space: nowrap;
    transition: background .15s, transform .1s, opacity .15s;
  }
  .submit-btn:hover { background: #c14e28; }
  .submit-btn:active { transform: scale(.98); }
  .submit-btn:disabled { opacity: .6; cursor: default; transform: none; }
  .submit-btn:focus-visible, input:focus-visible { outline: 2px solid var(--coral); outline-offset: 2px; }

  .consent {
    display: flex;
    gap: 8px;
    align-items: flex-start;
    font-size: 12.5px;
    color: rgba(4,31,30,0.75);
    line-height: 1.5;
    cursor: pointer;
  }
  /* Sopstveni checkbox - appearance:none pa crtamo kvadrat i kvačicu.
     Ostaje pravi <input>, tako da fokus, tastatura i klik na label rade sami. */
  .consent input {
    appearance: none;
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    margin: 1px 0 0;
    flex-shrink: 0;
    border: 1.5px solid rgba(4,31,30,0.3);
    border-radius: 6px;
    background: #fff;
    position: relative;
    cursor: pointer;
    transition: background .15s, border-color .15s;
  }
  .consent input:hover { border-color: rgba(4,31,30,0.5); }
  .consent input:checked { background: var(--coral); border-color: var(--coral); }
  .consent input:checked::after {
    content: "";
    position: absolute;
    left: 6px; top: 2.5px;
    width: 5px; height: 10px;
    border: solid #fff;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
  }
  .consent input:focus-visible { outline: 2px solid var(--coral); outline-offset: 2px; }
  /* stanje greške - korisnik je pokušao da pošalje bez saglasnosti */
  .consent.err { color: var(--coral); }
  .consent.err input { outline: 2px solid var(--coral); outline-offset: 2px; }

  .form-msg { font-size: 12.5px; color: var(--coral); min-height: 1.1em; line-height: 1.4; }

  /* honeypot - skriveno od ljudi, boti ga popune */
  .hp { position: absolute; left: -9999px; width: 1px; height: 1px; opacity: 0; }

  /* ── Podnožje ── */
  footer {
    position: relative;
    z-index: 2;
    margin-top: 56px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    text-align: center;
  }
  footer .links { display: flex; gap: 20px; font-size: 13.5px; }
  footer .links a {
    text-decoration: none;
    color: rgba(250,247,242,0.75);
    border-bottom: 1px solid rgba(250,247,242,0.25);
    padding-bottom: 2px;
    transition: color .15s, border-color .15s;
  }
  footer .links a:hover { color: var(--peach); border-color: var(--peach); }
  footer .fine { font-family: var(--mono); font-size: 11px; color: rgba(250,247,242,0.35); }

  @media (max-width: 520px) {
    .field-row { flex-direction: column; }
  }
  @media (prefers-reduced-motion: reduce) {
    .eyebrow .dot { animation: none; }
    .flap-char { transition: none; }
    .flap.flipping .flap-char { animation: none; }
    .waves.w1, .waves.w2 { animation: none; }
  }

    /* ── Success animacija (mejl → avion → tajna destinacija) ── */
  /* Pozadina je ista kao na stranici ispod - isti gradijent mora, ista
     vinjeta i isti ovalni prozor - da prelaz na animaciju ne deluje kao
     da si otišao na drugu stranicu. */
  .sent-overlay {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 200;
    background: linear-gradient(180deg, #1c3f4c 0%, var(--teal) 30%, #0e2833 55%, var(--evergreen) 100%);
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 40px 24px;
    opacity: 0;
    transition: opacity .45s ease;
  }
  .sent-overlay.show { display: flex; opacity: 1; }

  /* zatamnjene ivice */
  .sent-overlay::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 68% 62% at 50% 42%, transparent 55%, rgba(2,10,10,0.55) 88%, rgba(2,10,10,0.85) 100%);
    box-shadow: inset 0 0 140px 40px rgba(0,0,0,0.55);
    pointer-events: none;
  }
  /* ovalni okvir prozora aviona */
  .sent-overlay::after {
    content: "";
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%,-50%);
    width: min(90vw, 640px);
    height: min(90vh, 900px);
    border: 2px solid var(--cream);
    border-radius: 50%/38%;
    box-shadow: inset 0 0 0 16px rgba(250,247,242,0.5);
    opacity: .07;
    pointer-events: none;
  }
  /* sadržaj mora iznad vinjete i okvira */
  .sent-overlay > * { position: relative; z-index: 1; }

  .sent-stage {
    width: min(560px, 94vw);
    position: relative;
  }
  .sent-stage svg { width: 100%; height: auto; display: block; overflow: visible; }

  /* koverta */
  .sent-envelope {
    transform-box: fill-box;
    transform-origin: center;
    opacity: 0;
    animation:
      envIn .5s cubic-bezier(.34,1.56,.64,1) .15s forwards,
      envBob 1.2s ease-in-out .7s,
      envLaunch .55s cubic-bezier(.5,0,.75,0) 1.35s forwards;
  }
  @keyframes envIn {
    from { opacity: 0; transform: scale(.4) translateY(14px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
  }
  @keyframes envBob {
    0%, 100% { transform: translateY(0); }
    50%      { transform: translateY(-6px); }
  }
  @keyframes envLaunch {
    from { opacity: 1; transform: scale(1) translate(0,0) rotate(0deg); }
    to   { opacity: 0; transform: scale(.5) translate(-40px,-30px) rotate(-18deg); }
  }
  .sent-seal {
    transform-box: fill-box;
    transform-origin: top center;
    animation: sealFlap .4s ease-in .95s both;
  }
  @keyframes sealFlap {
    from { transform: rotateX(0deg); }
    to   { transform: rotateX(-150deg); }
  }

  /* trag - tačkice (mystery) */
  .sent-trail {
    fill: none;
    stroke: var(--tangerine);
    stroke-width: 2.5;
    stroke-linecap: round;
    stroke-dasharray: 2 12;
    stroke-dashoffset: 300;
    opacity: 0;
    animation: sentTrailDraw 1.6s ease-out 1.5s forwards;
  }
  @keyframes sentTrailDraw {
    0%   { stroke-dashoffset: 300; opacity: 0; }
    12%  { opacity: .55; }
    100% { stroke-dashoffset: 0; opacity: .55; }
  }

  /* avion */
  .sent-plane {
    offset-path: path('M 250 150 C 150 40, 400 20, 505 74');
    offset-rotate: auto;
    opacity: 0;
    animation: planeFly 1.7s cubic-bezier(.45,.05,.55,.95) 1.5s forwards;
  }
  @keyframes planeFly {
    0%   { offset-distance: 0%;   opacity: 0; }
    8%   { opacity: 1; }
    88%  { offset-distance: 92%;  opacity: 1; }
    100% { offset-distance: 100%; opacity: 0; }
  }

  /* tajna destinacija - pin sa upitnikom */
  .sent-pin {
    transform-box: fill-box;
    transform-origin: center bottom;
    opacity: 0;
    animation: pinPop .5s cubic-bezier(.34,1.56,.64,1) 3s forwards;
  }
  @keyframes pinPop {
    0%   { opacity: 0; transform: scale(1.35) translateY(-4px); }
    60%  { opacity: 1; transform: scale(1) translateY(0); }
    100% { opacity: 1; transform: scale(1) translateY(0); }
  }
  .sent-ring {
    transform-box: fill-box;
    transform-origin: center;
    opacity: 0;
    animation: ringPulse .8s ease-out 3.1s forwards;
  }
  @keyframes ringPulse {
    0%   { opacity: .7; transform: scale(.3); }
    100% { opacity: 0; transform: scale(2.2); }
  }

  .sent-text {
    opacity: 0;
    animation: sentTextIn .6s ease-out 3.15s forwards;
  }
  @keyframes sentTextIn {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .sent-title {
    font-size: clamp(1.5rem, 5vw, 2.1rem);
    font-weight: 600;
    color: var(--cream);
    margin: 8px 0 12px;
  }
  .sent-title .accent { color: var(--tangerine); }
  .sent-sub {
    max-width: 440px;
    margin: 0 auto;
    font-size: clamp(.95rem, 3.4vw, 1.1rem);
    line-height: 1.6;
    color: rgba(250, 247, 242, .8);
  }
  .sent-sub strong { color: var(--peach); }

  /* Saglasnost - inline checkbox ispod polja za mejl */
  .notify-consent {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    width: min(420px, 92vw);
    text-align: left;
    font-size: .82rem;
    line-height: 1.5;
    color: rgba(250, 247, 242, .75);
    cursor: pointer;
    margin-top: -14px;
    margin-bottom: 14px;
  }
  .notify-consent input {
    flex-shrink: 0;
    width: 18px;
    height: 18px;
    margin-top: 1px;
    accent-color: var(--tangerine);
    cursor: pointer;
  }
  /* stanje greške - kad korisnik pokuša da pošalje bez saglasnosti */
  .notify-consent.err { color: var(--tangerine); }
  .notify-consent.err input { outline: 2px solid var(--tangerine); outline-offset: 2px; }


  @media (prefers-reduced-motion: reduce) {
    .star, .plane, .trail, .pin-orange { animation: none !important; }
    .trail { stroke-dashoffset: 0; }
    /* bez leta - odmah prikaži krajnje stanje i potvrdu */
    .sent-envelope { display: none; }
    .sent-trail    { animation: none !important; stroke-dashoffset: 0; opacity: .55; }
    .sent-plane    { display: none; }
    .sent-pin, .sent-text { animation: none !important; opacity: 1; }
    .sent-ring     { display: none; }
  }
</style>
</head>
<body>

<div class="sky">
  <div class="window-frame" aria-hidden="true"></div>

  <div class="waves w2" aria-hidden="true">
    <svg viewBox="0 0 2400 160" preserveAspectRatio="none">
      <path d="M0,80 C150,20 300,140 450,80 C600,20 750,140 900,80 C1050,20 1200,140 1350,80 C1500,20 1650,140 1800,80 C1950,20 2100,140 2250,80 L2400,160 L0,160 Z" fill="#0d2530"/>
    </svg>
  </div>
  <div class="waves w1" aria-hidden="true">
    <svg viewBox="0 0 2400 160" preserveAspectRatio="none">
      <path d="M0,100 C150,40 300,160 450,100 C600,40 750,160 900,100 C1050,40 1200,160 1350,100 C1500,40 1650,160 1800,100 C1950,40 2100,160 2250,100 L2400,160 L0,160 Z" fill="#041F1E"/>
    </svg>
  </div>

  <nav>
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo-white.svg" alt="Escapii">
    <div class="route-pill">BEG <span aria-hidden="true">→</span> <span class="dest">???</span></div>
  </nav>

  <div class="hero">
    <div class="eyebrow"><span class="dot"></span> USKORO</div>
    <h1>Sledeća destinacija?<br>Za sada ostaje <span class="accent">tajna</span> ✈️</h1>
    <p class="sub">Vikend putovanja iznenađenja po Evropi. <strong>Let i hotel uključeni.</strong> Destinaciju znamo samo mi, i nećemo ti je otkriti čak i ako nas lepo zamoliš.</p>
    <p class="timing">SAZNAĆEŠ JE TAČNO 48H PRE POLASKA. NI MINUT RANIJE.</p>

    <div class="board-wrap">
      <div class="board" id="board" aria-live="polite" aria-label="Destinacija: uskoro"></div>
    </div>
  </div>

  <div class="pass">
    <div class="pass-notch"><div class="perf-line"></div></div>
    <div class="pass-bottom">
      <p class="lead">
        Ostavi nam svoj mejl i budi među prvim Escaperima u Srbiji koji će rezervisati
        putovanje iznenađenja. Javljamo ti se čim budemo spremni za poletanje. ✈️
      </p>
      <form id="notifyForm" novalidate>
        <label class="hp" for="notifyHp">Ostavi prazno</label>
        <input class="hp" type="text" id="notifyHp" name="hp" tabindex="-1" autocomplete="off">
        <div class="field-row">
          <input type="email" id="notifyEmail" placeholder="tvoj@mejl.com" required autocomplete="email">
          <button class="submit-btn" type="submit" id="notifyBtn">Dodaj me na listu</button>
        </div>
        <label class="consent" id="consentLabel" for="consentCheck">
          <input type="checkbox" id="consentCheck">
          <span>Slažem se da Escapii koristi moj mejl za obaveštenja i ponude o putovanjima.</span>
        </label>
        <p class="form-msg" id="notifyMsg"></p>
      </form>
    </div>
    <div class="barcode" aria-hidden="true"></div>
  </div>

  <footer>
    <div class="links">
      <a href="https://www.instagram.com/escapii.rs/" target="_blank" rel="noopener">Zaprati nas na Instagramu</a>
    </div>
    <div class="fine">© 2026 Escapii · Beograd · Niš</div>
  </footer>
</div>

<!-- Success animacija: mejl poleti kao avion ka tajnoj destinaciji -->
<div class="sent-overlay" id="sentOverlay" aria-hidden="true">
  <div class="sent-stage">
    <svg viewBox="0 0 600 220">
      <!-- trag - tačkice -->
      <path class="sent-trail" d="M 250 150 C 150 40, 400 20, 505 74" pathLength="300"/>

      <!-- tajna destinacija: pin sa upitnikom -->
      <!-- beli pin (uvek vidljiv) + narandžasti koji se upali kad avion sleti -->
      <image href="<?php echo esc_url(get_template_directory_uri() . '/images/escapii-pin-white.png'); ?>"
             x="488" y="44" width="34" height="53" opacity=".97"/>
      <image class="sent-pin"
             href="<?php echo esc_url(get_template_directory_uri() . '/images/escapii-pin-orange.png'); ?>"
             x="488" y="44" width="34" height="53"/>
      <circle class="sent-ring" cx="505" cy="70" r="26" fill="none" stroke="var(--peach)" stroke-width="2"/>

      <!-- koverta -->
      <g class="sent-envelope">
        <rect x="216" y="120" width="68" height="46" rx="6" fill="var(--cream)"/>
        <path class="sent-seal" d="M 216 126 L 250 150 L 284 126"
              fill="none" stroke="var(--cinnamon)" stroke-width="3" stroke-linejoin="round"/>
        <path d="M 216 126 L 250 148 L 284 126" fill="none" stroke="var(--cinnamon)" stroke-width="2.5" stroke-linejoin="round" opacity=".5"/>
      </g>

      <!-- avion koji poleti -->
      <g class="sent-plane">
        <g transform="rotate(90)">
          <path transform="translate(-13,-13) scale(1.1)" fill="var(--peach)"
                d="M21.5 15.5v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5V8.5l-8 5v2l8-2.5v5.5l-2 1.5v1.5l3.5-1 3.5 1V20l-2-1.5V13l8 2.5z"/>
        </g>
      </g>
    </svg>

    <div class="sent-text">
      <div class="sent-title">Sad si korak bliže svom putovanju godine. <span class="accent">🙂</span></div>
      <div class="sent-sub">
        Javićemo ti se mejlom čim Escapii bude 100% spreman za poletanje.<br><br>
        <strong>Biće brže nego što misliš.</strong>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  // ── Split-flap tabla: vrti kodove evropskih aerodroma, zaključava se na "???"
  // Redosled je izmešan da se susedni kodovi ne liče - prevrtanje se bolje vidi.
  var cities = ['CDG','FCO','BCN','BER','LHR','PMO','AMS','VLC','LIS','ATH','???'];
  var boardEl = document.getElementById('board');
  var WIDTH = 3; // tri mesta - koliko ima pravi IATA kod

  function buildFlaps(word) {
    boardEl.innerHTML = '';
    var padded = word.padStart(WIDTH, ' ').slice(-WIDTH);
    for (var i = 0; i < padded.length; i++) {
      var flap = document.createElement('div');
      flap.className = 'flap';
      var span = document.createElement('span');
      span.className = 'flap-char';
      span.textContent = padded[i];
      flap.appendChild(span);
      boardEl.appendChild(flap);
    }
  }

  function setWord(word, locked) {
    var flaps = boardEl.querySelectorAll('.flap');
    var padded = word.padStart(WIDTH, ' ').slice(-WIDTH);
    flaps.forEach(function(flap, i) {
      flap.classList.add('flipping');
      flap.classList.toggle('locked', !!locked);
      var charEl = flap.querySelector('.flap-char');
      setTimeout(function() { charEl.textContent = padded[i]; }, 120);
      setTimeout(function() { flap.classList.remove('flipping'); }, 440);
    });
  }

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  buildFlaps(reduceMotion ? '???' : cities[0]);

  if (!reduceMotion) {
    var i = 1;
    var timer = setInterval(function() {
      setWord(cities[i], i === cities.length - 1);
      if (i === cities.length - 1) clearInterval(timer);
      i++;
    }, 800);
  }

  // ── Prijava na obaveštenje o lansiranju ──
  var API = '<?php echo esc_js(escapii_api_url()); ?>';

  var form    = document.getElementById('notifyForm');
  var email   = document.getElementById('notifyEmail');
  var hp      = document.getElementById('notifyHp');
  var btn     = document.getElementById('notifyBtn');
  var msg     = document.getElementById('notifyMsg');
  var check   = document.getElementById('consentCheck');
  var consent = document.getElementById('consentLabel');
  var sent    = document.getElementById('sentOverlay');

  // Saglasnost se skida na svakom učitavanju - browser ume da vrati prethodno
  // stanje pri osvežavanju, a kutijica nikad ne sme biti unapred čekirana.
  check.checked = false;

  check.addEventListener('change', function() {
    if (check.checked) consent.classList.remove('err');
  });

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    msg.textContent = '';
    consent.classList.remove('err');

    var val = email.value.trim();
    if (!val || !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(val)) {
      msg.textContent = 'Unesi validnu email adresu.';
      email.focus();
      return;
    }

    // Saglasnost je obavezna - bez nje se ne šalje ništa
    if (!check.checked) {
      consent.classList.add('err');
      msg.textContent = 'Moraš označiti saglasnost da bismo ti mogli poslati obaveštenje.';
      check.focus();
      return;
    }

    btn.disabled = true;

    // Animacija kreće ODMAH - traje ~4s i sakriva mrežno čekanje.
    // Ako zahtev pukne, vraćamo formu i prikazujemo grešku.
    sent.classList.add('show');
    sent.setAttribute('aria-hidden', 'false');

    fetch(API + '/api/launch-notify', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email: val, hp: hp.value, consent: true })
    })
      .then(function(r) { return r.json().then(function(data) { return { ok: r.ok, data: data }; }); })
      .then(function(res) {
        if (!res.ok) throw new Error(res.data.error || 'Greška');
        email.value = '';
      })
      .catch(function(err) {
        sent.classList.remove('show');
        sent.setAttribute('aria-hidden', 'true');
        msg.textContent = err.message || 'Greška - pokušaj ponovo.';
        btn.disabled = false;
      });
  });
})();
</script>

</body>
</html>
