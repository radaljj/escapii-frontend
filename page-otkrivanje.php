<?php
/**
 * Template Name: Otkrivanje Destinacije
 */
$logo_url      = get_template_directory_uri() . '/images/logo-white.svg';
$logo_dark_url = get_template_directory_uri() . '/images/logo-black.svg';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tvoja destinacija — Escapii</title>
  <meta name="robots" content="noindex, nofollow">
  <?php wp_head(); ?>
  <style>
    :root {
      --orange: #f97316;
      --gold:   #fbbf24;
      --cream:  #fdf8f0;
      --ink:    #1a1a2e;
      --accent: #CA8A71;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      height: 100%;
      font-family: system-ui, 'Segoe UI', sans-serif;
      overflow: hidden;
    }
    body {
      background: #0a0f1e;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    /* ─── Starfield canvas ─── */
    #sky { position: fixed; inset: 0; z-index: 0; pointer-events: none; }

    /* ─── Takeoff canvas ─── */
    #takeoff {
      position: fixed; inset: 0; z-index: 40;
      pointer-events: none; opacity: 0;
      transition: opacity 0.3s ease;
    }
    #takeoff.active { opacity: 1; }

    /* ─── Radial glow ─── */
    .glow {
      position: fixed; left: 50%; top: 50%;
      transform: translate(-50%, -50%);
      width: 600px; height: 420px;
      background: radial-gradient(ellipse, rgba(249,115,22,0.10) 0%, transparent 70%);
      z-index: 0; pointer-events: none;
    }

    /* ─── Top logo ─── */
    .top-logo {
      position: fixed; top: 28px; left: 50%;
      transform: translateX(-50%);
      z-index: 20;
      display: flex; align-items: center; gap: 10px;
      opacity: 0; animation: fadeUp 0.7s ease 0.2s forwards;
    }
    .top-logo img { height: 22px; width: auto; }
    .logo-divider { width: 1px; height: 18px; background: rgba(255,255,255,0.2); }
    .logo-sub {
      font-size: 11px; letter-spacing: 2px;
      text-transform: uppercase; color: rgba(255,255,255,0.4);
    }

    /* ─── Loading spinner ─── */
    #rvLoading {
      position: relative; z-index: 10;
    }
    .rv-spinner {
      width: 44px; height: 44px;
      border: 2px solid rgba(249,115,22,0.15);
      border-top-color: var(--orange);
      border-radius: 50%;
      animation: rv-spin .85s linear infinite;
    }
    @keyframes rv-spin { to { transform: rotate(360deg); } }

    /* ─── Error modal ─── */
    .rv-err-backdrop {
      display: none;
      position: fixed; inset: 0; z-index: 100;
      background: rgba(10,15,30,0.80);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      align-items: center; justify-content: center;
      padding: 24px;
    }
    .rv-err-backdrop.active { display: flex; animation: err-in .35s ease; }
    @keyframes err-in { from { opacity:0; } to { opacity:1; } }
    .rv-err-card {
      background: linear-gradient(145deg, #1a2a4a 0%, #0a1525 100%);
      border: 1px solid rgba(249,115,22,.2);
      border-radius: 24px;
      padding: 40px 32px 32px;
      max-width: 360px; width: 100%;
      text-align: center;
      box-shadow: 0 32px 80px rgba(0,0,0,.7);
      animation: card-up .4s .05s cubic-bezier(.34,1.08,.64,1) both;
    }
    @keyframes card-up {
      from { opacity:0; transform:translateY(24px) scale(.96); }
      to   { opacity:1; transform:translateY(0) scale(1); }
    }
    .rv-err-logo {
      margin: 0 auto 22px; width: 52px; height: 52px;
      background: rgba(249,115,22,.12);
      border: 1.5px solid rgba(249,115,22,.3);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
    }
    .rv-err-logo img { height: 24px; width: auto; }
    .rv-err-icon-wrap { font-size: 42px; margin-bottom: 16px; line-height: 1; }
    .rv-err-title { font-size: 19px; font-weight: 800; color: #fff; margin-bottom: 10px; letter-spacing: -.3px; }
    .rv-err-msg { font-size: 13.5px; color: rgba(255,255,255,.5); line-height: 1.7; margin-bottom: 28px; }
    .rv-err-btn {
      display: inline-block;
      background: var(--orange); color: #fff; border: none;
      padding: 13px 36px; border-radius: 100px;
      font-size: 14px; font-weight: 700;
      cursor: pointer; text-decoration: none;
      transition: background .18s;
    }
    .rv-err-btn:hover { background: #ea580c; }
    .rv-err-contact { margin-top: 16px; font-size: 12px; color: rgba(255,255,255,.28); }
    .rv-err-contact a { color: rgba(249,115,22,.7); text-decoration: none; }

    /* ─── Pre-open teaser ─── */
    .teaser {
      position: relative; z-index: 10;
      text-align: center;
      margin-bottom: 56px;
      opacity: 0; animation: fadeUp 0.7s ease 0.5s forwards;
    }
    .teaser-label {
      font-size: 11px; letter-spacing: 3px;
      text-transform: uppercase; color: rgba(255,255,255,0.45);
      margin-bottom: 6px;
    }
    .teaser-big {
      font-family: Georgia, serif; font-size: 30px;
      color: #fff; font-weight: normal; line-height: 1.25;
    }
    .teaser-big em { color: var(--orange); font-style: normal; font-weight: bold; }

    /* ─── Envelope wrapper ─── */
    .envelope-wrap {
      position: relative; z-index: 10;
      opacity: 0; animation: fadeUp 0.7s ease 0.8s forwards;
    }

    /* ─── The envelope ─── */
    .envelope {
      width: 420px; height: 280px;
      position: relative; cursor: pointer;
      perspective: 1200px;
      filter: drop-shadow(0 24px 60px rgba(0,0,0,0.6)) drop-shadow(0 0 40px rgba(249,115,22,0.12));
      transition: filter 0.3s ease;
    }
    .envelope:hover:not(.opened) {
      filter: drop-shadow(0 28px 70px rgba(0,0,0,0.7)) drop-shadow(0 0 60px rgba(249,115,22,0.25));
    }

    /* Cream base */
    .env-base {
      position: absolute; inset: 0;
      background: var(--cream);
      border-radius: 6px 6px 10px 10px;
      border: 1px solid rgba(200,185,160,0.8);
    }
    .env-base::after {
      content: ''; position: absolute; inset: 0; border-radius: inherit;
      background: repeating-linear-gradient(
        -45deg, transparent, transparent 6px,
        rgba(200,185,160,0.12) 6px, rgba(200,185,160,0.12) 7px
      );
      pointer-events: none;
    }

    /* Bottom V-fold */
    .env-bottom-fold {
      position: absolute; bottom: 0; left: 0; right: 0;
      height: 155px; z-index: 2; overflow: hidden;
      border-radius: 0 0 10px 10px;
    }
    .env-bottom-fold::before {
      content: ''; position: absolute; bottom: -2px; left: -2px; right: -2px;
      height: 155px;
      background: linear-gradient(175deg, #efe8d8 0%, #e8dcc8 100%);
      clip-path: polygon(0 100%, 50% 0%, 100% 100%);
      border-left: 1px solid rgba(180,165,140,0.5);
      border-right: 1px solid rgba(180,165,140,0.5);
    }

    /* Left fold */
    .env-left-fold {
      position: absolute; left: 0; top: 0; bottom: 0; width: 50%;
      z-index: 3; overflow: hidden;
    }
    .env-left-fold::before {
      content: ''; position: absolute; left: -1px; top: -1px; bottom: -1px; width: 100%;
      background: linear-gradient(125deg, #ece5d6 0%, #e4dbc8 100%);
      clip-path: polygon(0 0, 100% 50%, 0 100%);
      border-right: 1px solid rgba(180,165,140,0.4);
    }

    /* Right fold */
    .env-right-fold {
      position: absolute; right: 0; top: 0; bottom: 0; width: 50%;
      z-index: 3; overflow: hidden;
    }
    .env-right-fold::before {
      content: ''; position: absolute; right: -1px; top: -1px; bottom: -1px; width: 100%;
      background: linear-gradient(235deg, #ece5d6 0%, #e4dbc8 100%);
      clip-path: polygon(100% 0, 0 50%, 100% 100%);
      border-left: 1px solid rgba(180,165,140,0.4);
    }

    /* Top flap */
    .env-flap {
      position: absolute; top: -1px; left: -1px; right: -1px;
      height: 160px; z-index: 5;
      transform-origin: top center;
      transform-style: preserve-3d;
      transition: transform 1.3s cubic-bezier(.4,0,.15,1);
    }
    .env-flap-inner { position: absolute; inset: 0; overflow: hidden; }
    .env-flap-inner::before {
      content: ''; position: absolute; top: -1px; left: -1px; right: -1px; height: 100%;
      background: linear-gradient(195deg, #ede6d8 0%, #ddd4c0 60%, #cfc6b2 100%);
      clip-path: polygon(0 0, 100% 0, 50% 100%);
      border: 1px solid rgba(180,165,140,0.6);
    }
    .env-flap-inner::after {
      content: ''; position: absolute; bottom: 0; left: 20%; right: 20%;
      height: 1px; background: rgba(160,145,120,0.4);
    }
    .envelope.opened .env-flap { transform: rotateX(-192deg); }

    /* Airmail border */
    .env-airmail {
      position: absolute; inset: 0;
      border-radius: 6px 6px 10px 10px;
      border: 8px solid transparent;
      border-image: repeating-linear-gradient(
        90deg, #f97316 0px, #f97316 12px, #08112a 12px, #08112a 24px
      ) 8;
      z-index: 6; pointer-events: none; opacity: 0.7;
    }

    /* Postage stamp */
    .env-stamp {
      position: absolute; top: 18px; right: 18px;
      width: 46px; height: 56px;
      background: var(--orange); border-radius: 3px;
      z-index: 7;
      display: flex; flex-direction: column; align-items: center; justify-content: center;
      gap: 3px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
    .env-stamp::before {
      content: ''; position: absolute; inset: 3px;
      border: 1px solid rgba(255,255,255,0.4); border-radius: 2px;
    }
    .env-stamp img { width: 28px; height: auto; }
    .env-stamp-text { font-size: 6px; font-weight: 700; letter-spacing: 0.5px; color: rgba(255,255,255,0.8); text-transform: uppercase; }

    /* Address lines */
    .env-address { position: absolute; bottom: 54px; left: 28px; z-index: 4; }
    .env-address-line { width: 80px; height: 2px; background: rgba(140,125,100,0.3); border-radius: 1px; margin-bottom: 5px; }
    .env-address-line:nth-child(2) { width: 60px; }
    .env-address-line:nth-child(3) { width: 70px; }

    /* Wax seal */
    .wax-seal {
      position: absolute; top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      z-index: 8;
      transition: opacity 0.4s ease 0.1s, transform 0.4s ease 0.1s;
    }
    .wax-seal-circle {
      width: 64px; height: 64px; border-radius: 50%;
      background: radial-gradient(circle at 38% 32%, #fb923c 0%, #f97316 40%, #c2410c 100%);
      border: 2px solid rgba(255,255,255,0.2);
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 4px 16px rgba(0,0,0,0.4), 0 0 0 1px rgba(200,100,0,0.5), inset 0 1px 0 rgba(255,255,255,0.25);
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .wax-seal-circle img { width: 32px; height: auto; }
    .wax-seal-circle:hover {
      transform: scale(1.06);
      box-shadow: 0 6px 24px rgba(249,115,22,0.5), 0 0 0 1px rgba(200,100,0,0.5), inset 0 1px 0 rgba(255,255,255,0.25);
    }
    .envelope.opened .wax-seal {
      opacity: 0;
      transform: translate(-50%, -50%) scale(0.5) rotate(20deg);
    }

    /* ─── Boarding pass (inside envelope, slides up on open) ─── */
    .env-ticket {
      position: absolute; left: 28px; right: 28px; bottom: 12px;
      height: 330px; z-index: 1;
      transform: translateY(10px);
      border-radius: 10px;
      box-shadow: 0 -4px 20px rgba(0,0,0,0.15), 0 8px 32px rgba(0,0,0,0.35);
      overflow: hidden; background: #fff;
    }
    .envelope.opened .env-ticket {
      z-index: 10;
      animation: ticketSlideUp 1.6s cubic-bezier(.22,1,.36,1) 0.9s both;
    }
    @keyframes ticketSlideUp {
      0%   { transform: translateY(10px); }
      100% { transform: translateY(-338px); }
    }

    /* Ticket header */
    .ticket-header {
      background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
      padding: 13px 18px 11px;
      display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;
    }
    .ticket-header-logo img { height: 18px; width: auto; }
    .ticket-header-type {
      font-size: 8px; font-weight: 700; letter-spacing: 2.5px;
      text-transform: uppercase; color: rgba(255,255,255,0.65);
      border: 1px solid rgba(255,255,255,0.3); padding: 3px 8px; border-radius: 100px;
    }

    /* Ticket body */
    .ticket-body {
      padding: 16px 18px 14px;
      display: flex; flex-direction: column; gap: 12px;
      background: #fff; position: relative;
    }

    /* Route row */
    .ticket-route { display: flex; align-items: center; gap: 0; opacity: 0; }
    .envelope.opened .ticket-route { animation: fadeSlide 0.5s ease 2.1s both; }

    .ticket-airport { flex: 1; }
    .ticket-airport-label {
      font-size: 8px; font-weight: 700; letter-spacing: 2px;
      text-transform: uppercase; color: #9ca3af; margin-bottom: 3px;
    }
    .ticket-iata {
      font-family: Georgia, serif; font-size: 38px;
      line-height: 1; letter-spacing: -2px; font-weight: normal;
    }
    .ticket-iata.from { color: #1f2937; }
    .ticket-iata.to   { color: var(--orange); }
    .ticket-city { font-size: 11px; font-weight: 600; color: #6b7280; margin-top: 3px; }
    .ticket-city.to { color: var(--orange); font-weight: 700; }

    .ticket-route-mid {
      display: flex; flex-direction: column; align-items: center;
      gap: 4px; padding: 0 16px; padding-top: 18px;
    }
    .ticket-route-line {
      width: 60px; height: 1px;
      background: linear-gradient(90deg, #e5e7eb, var(--orange), #e5e7eb);
      position: relative;
    }
    .ticket-route-plane {
      font-size: 16px; position: absolute; top: 50%; left: 50%;
      transform: translate(-50%, -60%);
    }

    /* Tear line */
    .ticket-tear {
      height: 1px;
      background: repeating-linear-gradient(90deg, #e5e7eb 0, #e5e7eb 8px, transparent 8px, transparent 16px);
      margin: 0 -18px; position: relative; opacity: 0;
    }
    .ticket-tear::before, .ticket-tear::after {
      content: ''; position: absolute; top: 50%; transform: translateY(-50%);
      width: 16px; height: 16px; border-radius: 50%; background: #0a0f1e;
    }
    .ticket-tear::before { left: -8px; }
    .ticket-tear::after  { right: -8px; }
    .envelope.opened .ticket-tear { animation: fadeSlide 0.4s ease 2.3s both; }

    /* Details row */
    .ticket-details { display: flex; gap: 0; opacity: 0; }
    .envelope.opened .ticket-details { animation: fadeSlide 0.5s ease 2.5s both; }
    .ticket-detail { flex: 1; }
    .ticket-detail + .ticket-detail { border-left: 1px solid #f3f4f6; padding-left: 14px; }
    .ticket-detail-label {
      font-size: 8px; font-weight: 700; letter-spacing: 1.5px;
      text-transform: uppercase; color: #9ca3af; margin-bottom: 3px;
    }
    .ticket-detail-value { font-size: 12px; font-weight: 700; color: #1f2937; }
    .ticket-detail-value.accent { color: var(--orange); }

    /* Passenger row */
    .ticket-pax {
      padding-top: 8px; border-top: 1px dashed #e5e7eb;
      opacity: 0;
    }
    .envelope.opened .ticket-pax { animation: fadeSlide 0.5s ease 2.7s both; }
    .ticket-pax-row { font-size: 10px; color: #374151; font-weight: 600; line-height: 1.5; }

    @keyframes fadeSlide {
      from { opacity: 0; transform: translateY(6px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── Scratch canvas over ticket body ─── */
    #scratchCanvas {
      position: absolute; inset: 0; width: 100%; height: 100%;
      cursor: crosshair; z-index: 5;
      touch-action: none; border-radius: 0;
    }

    /* ─── Hint below envelope ─── */
    .hint {
      position: relative; z-index: 10;
      margin-top: 32px;
      display: flex; align-items: center; gap: 10px;
      color: rgba(255,255,255,0.45); font-size: 12px;
      letter-spacing: 2px; text-transform: uppercase;
      opacity: 0; animation: fadeUp 0.7s ease 1.2s forwards;
      transition: opacity 0.3s ease; user-select: none;
    }
    .hint.hide { opacity: 0 !important; pointer-events: none; }
    .hint-pulse {
      width: 7px; height: 7px; border-radius: 50%;
      background: var(--orange);
      animation: hintPop 1.6s ease-in-out infinite;
    }
    @keyframes hintPop {
      0%,100% { transform: scale(1); opacity: 0.5; }
      50%      { transform: scale(1.6); opacity: 1; }
    }

    /* ─── Scratch hint below envelope ─── */
    #scratchHintExternal {
      display: none; align-items: center; gap: 8px;
      margin-top: 20px;
      font-size: 10px; font-weight: 700; letter-spacing: 2px;
      text-transform: uppercase; color: rgba(249,115,22,0.85);
      pointer-events: none;
      animation: hintPop 1.8s ease-in-out infinite;
    }
    #scratchHintExternal .sh-coin { font-size: 16px; }

    /* ─── Marching dots ─── */
    .march {
      position: fixed; bottom: 36px; left: 50%;
      transform: translateX(-50%); z-index: 10;
      display: flex; gap: 6px;
      opacity: 0; animation: fadeUp 0.6s ease 1.4s forwards;
      transition: opacity 0.3s ease;
    }
    .march.hide { opacity: 0 !important; }
    .mdot { width: 5px; height: 5px; border-radius: 50%; background: var(--orange); animation: marchPop 1.4s ease-in-out infinite; }
    .mdot:nth-child(2) { animation-delay: 0.18s; }
    .mdot:nth-child(3) { animation-delay: 0.36s; }
    .mdot:nth-child(4) { animation-delay: 0.54s; }
    .mdot:nth-child(5) { animation-delay: 0.72s; }
    @keyframes marchPop {
      0%,100% { opacity: 0.2; transform: scale(0.7); }
      50%      { opacity: 1;   transform: scale(1.4); }
    }

    /* ─── Confetti ─── */
    .confetti-el {
      position: fixed; z-index: 50; pointer-events: none; opacity: 0;
      animation: confettiFall var(--dur, 2s) ease var(--delay, 0s) forwards;
    }
    @keyframes confettiFall {
      0%   { opacity: 0; transform: translate(0,0) rotate(0deg) scale(0.5); }
      8%   { opacity: 1; }
      85%  { opacity: 0.9; }
      100% { opacity: 0; transform: translate(var(--tx), 180px) rotate(var(--rot)) scale(1.1); }
    }

    /* ─── Success bar ─── */
    .success-bar {
      position: fixed; bottom: 0; left: 0; right: 0;
      background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
      padding: 16px 24px;
      display: flex; align-items: center; justify-content: center; gap: 14px;
      z-index: 60; transform: translateY(100%);
      transition: transform 0.7s cubic-bezier(.22,1,.36,1);
      font-size: 14px; color: rgba(255,255,255,0.9);
      border-top: 1px solid rgba(255,255,255,0.1);
    }
    .success-bar.show { transform: translateY(0); }
    .success-bar strong { color: #fff; }
    .success-btn {
      background: var(--orange); color: #fff;
      padding: 9px 22px; border-radius: 100px;
      font-size: 12px; font-weight: 700; text-decoration: none;
      letter-spacing: 0.5px; white-space: nowrap; transition: background 0.2s;
    }
    .success-btn:hover { background: #ea580c; }

    /* ─── Sparkle particles ─── */
    .rv-spark {
      position: fixed; pointer-events: none; z-index: 51; border-radius: 50%;
    }

    /* ─── Shared animation ─── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(14px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 480px) {
      .envelope { width: 320px; height: 215px; }
      .env-flap { height: 124px; }
      .env-ticket { left: 20px; right: 20px; height: 300px; }
      @keyframes ticketSlideUp {
        0%   { transform: translateY(10px); }
        100% { transform: translateY(-300px); }
      }
      .ticket-iata { font-size: 28px; }
      .teaser-big  { font-size: 24px; }
    }
  </style>
</head>
<body>

<canvas id="sky"></canvas>
<canvas id="takeoff"></canvas>
<div class="glow"></div>

<!-- Error modal -->
<div class="rv-err-backdrop" id="rvError">
  <div class="rv-err-card">
    <div class="rv-err-logo">
      <img src="<?php echo esc_url($logo_url); ?>" alt="Escapii"
           onerror="this.outerHTML='<span style=\'font-family:Georgia,serif;font-size:15px;color:#f97316;\'>e</span>'">
    </div>
    <div class="rv-err-icon-wrap" id="rvErrIcon">⚠️</div>
    <div class="rv-err-title"     id="rvErrTitle">Nešto je pošlo po krivu</div>
    <div class="rv-err-msg"       id="rvErrMsg">Došlo je do neočekivane greške. Pokušaj ponovo ili nas kontaktiraj.</div>
    <a href="/" class="rv-err-btn">← Nazad na početnu</a>
    <div class="rv-err-contact">Problem? Piši nam na <a href="mailto:escapii.team@gmail.com">escapii.team@gmail.com</a></div>
  </div>
</div>

<!-- Top logo -->
<div class="top-logo">
  <img src="<?php echo esc_url($logo_url); ?>" alt="Escapii"
       onerror="this.style.display='none'">
  <div class="logo-divider"></div>
  <div class="logo-sub">Mystery Travel</div>
</div>

<!-- Loading -->
<div id="rvLoading"><div class="rv-spinner"></div></div>

<!-- Teaser (shown after API responds) -->
<div class="teaser" id="rvTeaser" style="opacity:0;display:none;">
  <div class="teaser-label" id="teaserName">✦ Tvoje putovanje</div>
  <div class="teaser-big">Tvoja destinacija<br>čeka u koverti</div>
</div>

<!-- Envelope (shown after API responds) -->
<div class="envelope-wrap" id="rvEnvWrap" style="opacity:0;display:none;">
  <div class="envelope" id="env" onclick="openEnv()">

    <div class="env-base"></div>
    <div class="env-bottom-fold"></div>
    <div class="env-left-fold"></div>
    <div class="env-right-fold"></div>
    <div class="env-airmail"></div>

    <!-- Stamp with logo -->
    <div class="env-stamp">
      <img src="<?php echo esc_url($logo_url); ?>" alt="escapii"
           onerror="this.outerHTML='<span style=\'font-size:10px;color:#fff;\'>✈</span>'">
      <div class="env-stamp-text">escapii</div>
    </div>

    <!-- Address lines -->
    <div class="env-address">
      <div class="env-address-line"></div>
      <div class="env-address-line"></div>
      <div class="env-address-line"></div>
    </div>

    <!-- Boarding pass (slides up on open) -->
    <div class="env-ticket">
      <div class="ticket-header">
        <div class="ticket-header-logo">
          <img src="<?php echo esc_url($logo_url); ?>" alt="Escapii"
               onerror="this.outerHTML='<span style=\'font-family:Georgia,serif;font-size:15px;color:#fff;\'>escapii.</span>'">
        </div>
        <div class="ticket-header-type">Boarding Pass</div>
      </div>
      <div class="ticket-body">
        <div class="ticket-route">
          <div class="ticket-airport">
            <div class="ticket-airport-label">Od</div>
            <div class="ticket-iata from" id="ticketFromIata">BEG</div>
            <div class="ticket-city" id="ticketFromCity">Beograd</div>
          </div>
          <div class="ticket-route-mid">
            <div class="ticket-route-line">
              <span class="ticket-route-plane">✈</span>
            </div>
          </div>
          <div class="ticket-airport" style="text-align:right;">
            <div class="ticket-airport-label" style="text-align:right;">Do</div>
            <div class="ticket-iata to" id="ticketDestIata">???</div>
            <div class="ticket-city to" id="ticketDestCity">—</div>
          </div>
        </div>
        <div class="ticket-tear"></div>
        <div class="ticket-details">
          <div class="ticket-detail">
            <div class="ticket-detail-label">Polazak</div>
            <div class="ticket-detail-value" id="ticketDate">—</div>
          </div>
          <div class="ticket-detail">
            <div class="ticket-detail-label">Povratak</div>
            <div class="ticket-detail-value" id="ticketReturn">—</div>
          </div>
          <div class="ticket-detail">
            <div class="ticket-detail-label">Rezervacija</div>
            <div class="ticket-detail-value accent" id="ticketRef">—</div>
          </div>
        </div>
        <div class="ticket-pax">
          <div class="ticket-pax-row">✈&nbsp;<span id="ticketPassengers">—</span></div>
        </div>
      </div>
    </div>

    <!-- Flap -->
    <div class="env-flap">
      <div class="env-flap-inner"></div>
    </div>

    <!-- Wax seal with logo -->
    <div class="wax-seal">
      <div class="wax-seal-circle">
        <img src="<?php echo esc_url($logo_url); ?>" alt="e"
             onerror="this.outerHTML='<span style=\'font-family:Georgia,serif;font-size:20px;color:#fff;font-weight:bold;\'>e</span>'">
      </div>
    </div>

  </div><!-- /envelope -->
</div><!-- /envelope-wrap -->

<!-- Hint: click to open -->
<div class="hint" id="hint" style="display:none;">
  <div class="hint-pulse"></div>
  Klikni da otvoriš
  <div class="hint-pulse"></div>
</div>

<!-- Scratch hint (shown after ticket slides up) -->
<div id="scratchHintExternal">
  <span class="sh-coin">🪙</span>
  OGREBI I OTKRIJ DESTINACIJU
  <span class="sh-coin">🪙</span>
</div>

<!-- Marching dots -->
<div class="march" id="march" style="display:none;">
  <div class="mdot"></div><div class="mdot"></div><div class="mdot"></div>
  <div class="mdot"></div><div class="mdot"></div>
</div>

<!-- Success bar -->
<div class="success-bar" id="success-bar">
  <span>🎉 Dobrodošli u <strong id="success-city">vaše iznenađenje</strong>! Svi detalji su na vašem emailu.</span>
  <a class="success-btn" href="/">← Početna</a>
</div>

<script>
const API = '<?php echo esc_js(escapii_api_url()); ?>';
let opened    = false;
let errorShown = false;

/* ── Global error handlers ── */
window.onerror = function() { showError(0); return true; };
window.addEventListener('unhandledrejection', function() { showError(0); });

/* ── Starfield ── */
(function(){
  const c = document.getElementById('sky');
  const ctx = c.getContext('2d');
  let stars = [];
  function resize(){ c.width = innerWidth; c.height = innerHeight; }
  function init(){
    stars = Array.from({length:160}, () => ({
      x: Math.random()*c.width, y: Math.random()*c.height,
      r: Math.random()*1.4+0.2,
      a: Math.random(), da: (Math.random()*0.005+0.001)*(Math.random()>.5?1:-1),
      orange: Math.random()>.85
    }));
  }
  function draw(){
    ctx.clearRect(0,0,c.width,c.height);
    stars.forEach(s=>{
      s.a += s.da;
      if(s.a>1){s.a=1;s.da*=-1;} if(s.a<0.04){s.a=0.04;s.da*=-1;}
      ctx.beginPath(); ctx.arc(s.x,s.y,s.r,0,Math.PI*2);
      ctx.fillStyle = s.orange ? `rgba(249,115,22,${s.a*.8})` : `rgba(255,255,255,${s.a*.7})`;
      ctx.fill();
    });
    requestAnimationFrame(draw);
  }
  resize(); init(); draw();
  addEventListener('resize',()=>{resize();init();});
})();

/* ── Helpers ── */
function fmtDate(iso) {
  if (!iso) return '—';
  const [y,m,d] = iso.split('-');
  const mon = ['JAN','FEB','MAR','APR','MAJ','JUN','JUL','AVG','SEP','OKT','NOV','DEC'];
  return d + '. ' + (mon[+m - 1] || m) + ' ' + y + '.';
}
function airportCity(iata) {
  return ({BEG:'Beograd',INI:'Niš',ZAG:'Zagreb',BUD:'Budimpešta',TIM:'Temišvar'})[iata] || iata || '—';
}

/* ── Error state ── */
function showError(status) {
  if (errorShown) return;
  errorShown = true;
  document.getElementById('rvLoading').style.display = 'none';
  const m = {
    404: ['🔒','Link nije validan','Ovaj link nije ispravan ili je istekao. Proveri da li si kopirao ceo link iz emaila.'],
    410: ['✈️','Putovanje je počelo!','Tvoje putovanje je već počelo. Srećan put i uživaj u iznenađenju!'],
    403: ['⏳','Još nije dostupno','Rezervacija još nije potvrđena ili destinacija nije unesena. Pokušaj ponovo uskoro.'],
  }[status] || ['🌍','Nešto nije pošlo kako treba','Pokušaj ponovo ili nas kontaktiraj — rešićemo to u najkraćem roku.'];
  document.getElementById('rvErrIcon').textContent  = m[0];
  document.getElementById('rvErrTitle').textContent = m[1];
  document.getElementById('rvErrMsg').textContent   = m[2];
  document.getElementById('rvError').classList.add('active');
}

/* ── Show envelope after API ── */
function showEnvelope(data) {
  document.getElementById('rvLoading').style.display = 'none';

  // Populate ticket fields
  const iata = (data.departureAirport || '').toUpperCase();
  document.getElementById('ticketFromIata').textContent   = iata || 'BEG';
  document.getElementById('ticketFromCity').textContent   = airportCity(iata);
  document.getElementById('ticketDestIata').textContent   = '???';
  document.getElementById('ticketDestCity').textContent   = data.destination || '—';
  document.getElementById('ticketDate').textContent       = fmtDate(data.departureDate);
  document.getElementById('ticketReturn').textContent     = fmtDate(data.returnDate);
  document.getElementById('ticketRef').textContent        = data.bookingRef || '—';
  document.getElementById('success-city').textContent     = data.destination || 'vaše iznenađenje';

  const names = Array.isArray(data.passengers) && data.passengers.length
    ? data.passengers.join(' · ') : '—';
  document.getElementById('ticketPassengers').textContent = names;

  // Teaser name
  const firstName = data.firstName || '';
  document.getElementById('teaserName').textContent = '✦ ' + (firstName || 'Tvoje putovanje');

  // Show UI elements
  const teaser  = document.getElementById('rvTeaser');
  const envWrap = document.getElementById('rvEnvWrap');
  const hint    = document.getElementById('hint');
  const march   = document.getElementById('march');

  teaser.style.display  = 'block';
  envWrap.style.display = 'block';
  hint.style.display    = 'flex';
  march.style.display   = 'flex';

  // Trigger fade-in animations
  requestAnimationFrame(() => {
    teaser.style.animation  = 'fadeUp 0.7s ease 0.1s both';
    teaser.style.opacity    = '';
    envWrap.style.animation = 'fadeUp 0.7s ease 0.4s both';
    envWrap.style.opacity   = '';
  });
}

/* ── Open envelope ── */
function openEnv(){
  if (opened) return;
  opened = true;
  document.getElementById('env').classList.add('opened');
  document.getElementById('hint').classList.add('hide');
  document.getElementById('march').classList.add('hide');
  setTimeout(spawnConfetti, 1400);
  setTimeout(launchTakeoff,  1600);
  // Scratch card appears after ticket finishes sliding up (~2.5s after open)
  setTimeout(addScratchCard, 2700);
}

/* ── Confetti ── */
function spawnConfetti(){
  const syms   = ['✦','✈','★','✦','✦','●'];
  const colors = ['#f97316','#fbbf24','#fff','#fb923c','#fde68a'];
  for(let i=0;i<44;i++){
    const el = document.createElement('div');
    el.className = 'confetti-el';
    el.textContent = syms[Math.floor(Math.random()*syms.length)];
    el.style.color    = colors[Math.floor(Math.random()*colors.length)];
    el.style.left     = (15+Math.random()*70)+'vw';
    el.style.top      = (10+Math.random()*55)+'vh';
    el.style.fontSize = (9+Math.random()*14)+'px';
    el.style.setProperty('--dur',   (1.4+Math.random()*2)+'s');
    el.style.setProperty('--delay', (Math.random()*.7)+'s');
    el.style.setProperty('--tx',    (Math.random()*240-120)+'px');
    el.style.setProperty('--rot',   (Math.random()*720-360)+'deg');
    document.body.appendChild(el);
    setTimeout(()=>el.remove(), 4500);
  }
}

/* ── Takeoff plane ── */
function launchTakeoff(){
  const canvas = document.getElementById('takeoff');
  canvas.width = innerWidth; canvas.height = innerHeight;
  canvas.classList.add('active');
  const ctx = canvas.getContext('2d');
  const W = canvas.width, H = canvas.height;
  const DURATION = 3400;
  let start = null;
  const trail = [];

  function easeIn(t){ return t*t*t; }
  function easeIO(t){ return t<.5?2*t*t:-1+(4-2*t)*t; }

  function plane(x,y,angle,sc,alpha){
    ctx.save();
    ctx.globalAlpha = alpha;
    ctx.translate(x,y); ctx.rotate(angle); ctx.scale(sc,sc);
    ctx.fillStyle='#fff';
    ctx.beginPath(); ctx.ellipse(0,0,30,9,0,0,Math.PI*2); ctx.fill();
    ctx.beginPath(); ctx.moveTo(30,0); ctx.lineTo(42,0); ctx.lineTo(30,-4); ctx.closePath(); ctx.fill();
    ctx.beginPath(); ctx.moveTo(-24,0); ctx.lineTo(-34,-18); ctx.lineTo(-18,-2); ctx.closePath(); ctx.fill();
    ctx.fillStyle='#e2e8f0';
    ctx.beginPath(); ctx.moveTo(-4,0); ctx.lineTo(14,0); ctx.lineTo(2,-26); ctx.lineTo(-9,-20); ctx.closePath(); ctx.fill();
    ctx.beginPath(); ctx.moveTo(-4,0); ctx.lineTo(14,0); ctx.lineTo(2,26); ctx.lineTo(-9,20); ctx.closePath(); ctx.fill();
    ctx.fillStyle='rgba(100,200,255,.7)';
    ctx.beginPath(); ctx.arc(8,-2,3.5,0,Math.PI*2); ctx.fill();
    const eg=ctx.createLinearGradient(-36,0,-60,0);
    eg.addColorStop(0,'rgba(249,115,22,.7)'); eg.addColorStop(1,'rgba(249,115,22,0)');
    ctx.strokeStyle=eg; ctx.lineWidth=4; ctx.lineCap='round';
    ctx.beginPath(); ctx.moveTo(-36,0); ctx.lineTo(-60,Math.sin(Date.now()/110)*2); ctx.stroke();
    ctx.restore();
  }

  function frame(ts){
    if(!start) start=ts;
    const t = Math.min((ts-start)/DURATION,1);
    ctx.clearRect(0,0,W,H);
    let px,py,angle,sc;
    const startX=W*.36, startY=H*.64;
    if(t<.38){
      const q=easeIO(t/.38); px=startX+q*W*.24; py=startY; angle=0; sc=1.1;
    } else if(t<.62){
      const q=easeIn((t-.38)/.24); px=startX+W*.24+q*W*.15; py=startY-q*H*.2; angle=-q*.32; sc=1.1+q*.08;
    } else {
      const q=easeIn((t-.62)/.38); px=startX+W*.39+q*W*.75; py=startY-H*.2-q*H*.72; angle=-.32-q*.18; sc=1.18-q*.45;
    }
    const alpha = t<.05 ? t/.05 : t>.85 ? (1-t)/.15 : 1;
    trail.push({x:px,y:py});
    if(trail.length>28) trail.shift();
    if(trail.length>1){
      ctx.save(); ctx.strokeStyle='rgba(255,255,255,.1)';
      ctx.lineWidth=2; ctx.setLineDash([6,9]);
      ctx.lineDashOffset=-(Date.now()/80)%15;
      ctx.beginPath(); ctx.moveTo(trail[0].x,trail[0].y);
      trail.forEach(pt=>ctx.lineTo(pt.x,pt.y));
      ctx.stroke(); ctx.setLineDash([]); ctx.restore();
    }
    plane(px,py,angle,sc,alpha);
    if(t<1) requestAnimationFrame(frame);
    else { canvas.classList.remove('active'); ctx.clearRect(0,0,W,H); }
  }
  requestAnimationFrame(frame);
}

/* ── Scratch card (over ticket body) ── */
function addScratchCard() {
  const ticketBody = document.querySelector('.ticket-body');
  if (!ticketBody) return;

  const dpr  = window.devicePixelRatio || 1;
  const rect = ticketBody.getBoundingClientRect();
  const cw   = rect.width;
  const ch   = rect.height;

  const canvas = document.createElement('canvas');
  canvas.id = 'scratchCanvas';
  canvas.width  = Math.round(cw * dpr);
  canvas.height = Math.round(ch * dpr);
  ticketBody.style.position = 'relative';
  ticketBody.appendChild(canvas);

  const ctx = canvas.getContext('2d');
  const W = canvas.width, H = canvas.height;

  // Cover: orange-navy gradient matching envelope palette
  const grad = ctx.createLinearGradient(0, 0, W, H);
  grad.addColorStop(0,   '#1a0a02');
  grad.addColorStop(0.5, '#2d1200');
  grad.addColorStop(1,   '#0a0810');
  ctx.fillStyle = grad;
  ctx.fillRect(0, 0, W, H);

  // Diagonal stripe texture (matches airmail)
  ctx.save();
  for(let i = -H; i < W + H; i += 18 * dpr) {
    ctx.beginPath();
    ctx.moveTo(i, 0); ctx.lineTo(i + H, H);
    ctx.strokeStyle = 'rgba(249,115,22,0.06)';
    ctx.lineWidth = 7 * dpr;
    ctx.stroke();
  }
  ctx.restore();

  // Center text
  ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
  ctx.font = `${Math.round(22 * dpr)}px serif`;
  ctx.fillStyle = 'rgba(249,115,22,0.75)';
  ctx.fillText('🪙', W / 2, H / 2 - Math.round(18 * dpr));

  ctx.font = `bold ${Math.round(8.5 * dpr)}px system-ui, sans-serif`;
  ctx.fillStyle = 'rgba(249,115,22,0.95)';
  ctx.fillText('✦  OGREBI DA OTKRIJEŠ  ✦', W / 2, H / 2 + Math.round(2 * dpr));

  ctx.font = `${Math.round(7 * dpr)}px system-ui, sans-serif`;
  ctx.fillStyle = 'rgba(255,255,255,0.35)';
  ctx.fillText('svoju destinaciju', W / 2, H / 2 + Math.round(16 * dpr));

  // Show external hint
  const hintExt = document.getElementById('scratchHintExternal');
  if (hintExt) hintExt.style.display = 'flex';

  // Scratch logic
  let drawing  = false;
  let revealed = false;
  const total  = W * H;

  function getXY(e) {
    const r  = canvas.getBoundingClientRect();
    const sx = W / r.width, sy = H / r.height;
    const src = e.touches ? e.touches[0] : e;
    return [(src.clientX - r.left) * sx, (src.clientY - r.top) * sy];
  }
  function scratchAt(x, y) {
    ctx.globalCompositeOperation = 'destination-out';
    ctx.beginPath(); ctx.arc(x, y, 28 * dpr, 0, Math.PI * 2); ctx.fill();
    ctx.globalCompositeOperation = 'source-over';
    if (!revealed) checkReveal();
  }
  function checkReveal() {
    const data = ctx.getImageData(0, 0, W, H).data;
    let cleared = 0;
    for (let i = 3; i < data.length; i += 4) if (data[i] < 128) cleared++;
    if (cleared / total > 0.50) { revealed = true; fullyReveal(); }
  }
  function fullyReveal() {
    // Show real IATA code
    const destIata = document.getElementById('ticketDestIata');
    // Populate from stored data attribute
    if (destIata && destIata.dataset.iata) {
      destIata.textContent = destIata.dataset.iata;
    }

    canvas.style.transition = 'opacity 0.55s ease';
    canvas.style.opacity    = '0';
    if (hintExt) {
      hintExt.style.transition = 'opacity 0.3s';
      hintExt.style.opacity    = '0';
    }
    // Show success bar
    setTimeout(() => { document.getElementById('success-bar').classList.add('show'); }, 400);
    setTimeout(() => {
      canvas.remove();
      if (hintExt) hintExt.style.display = 'none';
    }, 600);

    // Celebration sparkles on destination
    setTimeout(() => {
      const r   = destIata ? destIata.getBoundingClientRect() : ticketBody.getBoundingClientRect();
      const cx  = r.left + r.width / 2;
      const cy  = r.top  + r.height / 2;
      const cols = ['#f97316','#fbbf24','#fff','#fb923c'];
      for (let i = 0; i < 24; i++) {
        const sp  = document.createElement('div');
        sp.className = 'rv-spark';
        const sz  = Math.random() * 8 + 3;
        const ang = (Math.PI * 2 * i / 24) + (Math.random() - 0.5) * 0.5;
        const dist = 55 + Math.random() * 95;
        sp.style.cssText = `width:${sz}px;height:${sz}px;background:${cols[i%cols.length]};` +
          `border-radius:${Math.random() > .4 ? '50%' : '3px'};left:${cx}px;top:${cy}px;` +
          `transform:translate(-50%,-50%);opacity:1`;
        document.body.appendChild(sp);
        const tx  = Math.cos(ang) * dist, ty = Math.sin(ang) * dist;
        const dur = 0.5 + Math.random() * 0.4, del = Math.random() * 0.12;
        requestAnimationFrame(() => requestAnimationFrame(() => {
          sp.style.transition = `transform ${dur}s ${del}s ease-out, opacity ${dur*.8}s ${del+.1}s ease-out`;
          sp.style.transform  = `translate(calc(-50% + ${tx}px),calc(-50% + ${ty}px)) rotate(${Math.random()*360}deg)`;
          sp.style.opacity    = '0';
        }));
        setTimeout(() => sp.remove(), (dur + del + 0.25) * 1000);
      }
    }, 200);
  }

  canvas.addEventListener('mousedown',  e => { drawing = true; const [x,y] = getXY(e); scratchAt(x,y); });
  window.addEventListener('mouseup',    () => drawing = false);
  canvas.addEventListener('mousemove',  e => { if (drawing) { const [x,y] = getXY(e); scratchAt(x,y); } });
  canvas.addEventListener('touchstart', e => { e.preventDefault(); drawing = true; const [x,y] = getXY(e); scratchAt(x,y); }, {passive:false});
  canvas.addEventListener('touchmove',  e => { e.preventDefault(); if (drawing) { const [x,y] = getXY(e); scratchAt(x,y); } }, {passive:false});
  canvas.addEventListener('touchend',   () => drawing = false);
}

/* ── API fetch ── */
(async function init() {
  const token = new URLSearchParams(location.search).get('token');
  if (!token) { showError(404); return; }
  try {
    const res = await fetch(`${API}/api/reveal?token=${encodeURIComponent(token)}`);
    if (!res.ok) { showError(res.status); return; }
    const data = await res.json();

    // Store IATA on element for scratch reveal
    const destIata = document.getElementById('ticketDestIata');
    if (destIata && data.destinationIata) {
      destIata.dataset.iata = data.destinationIata;
    }

    showEnvelope(data);
  } catch(e) {
    showError(0);
  }
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
