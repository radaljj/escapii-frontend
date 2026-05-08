<?php
/**
 * Template Name: Otkrivanje Destinacije
 */
$logo_url    = get_template_directory_uri() . '/images/logo-white.svg';
$favicon_url = get_template_directory_uri() . '/images/favicon.png';
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
      --teal:   #0F2D35;
      --teal2:  #143843;
      --teal3:  #0A1E26;
      --accent: #CA8A71;
      --page-bg: #0a0f1e;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      height: 100%;
      font-family: system-ui, 'Segoe UI', sans-serif;
      overflow: hidden;
    }
    body {
      background: var(--page-bg);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    /* ── Canvases ── */
    #sky     { position: fixed; inset: 0; z-index: 0; pointer-events: none; }
    #takeoff { position: fixed; inset: 0; z-index: 40; pointer-events: none; opacity: 0; transition: opacity 0.3s; }
    #takeoff.active { opacity: 1; }

    /* ── Radial glow ── */
    .glow {
      position: fixed; left: 50%; top: 50%;
      transform: translate(-50%, -50%);
      width: 560px; height: 380px;
      background: radial-gradient(ellipse, rgba(202,138,113,0.08) 0%, transparent 70%);
      z-index: 0; pointer-events: none;
    }

    /* ── Top logo ── */
    .top-logo {
      position: fixed; top: 26px; left: 50%;
      transform: translateX(-50%);
      z-index: 20;
      display: flex; align-items: center; gap: 10px;
      opacity: 0; animation: fadeUp 0.7s ease 0.2s both;
    }
    .top-logo img  { height: 20px; width: auto; }
    .logo-divider  { width: 1px; height: 16px; background: rgba(255,255,255,0.18); }
    .logo-sub      { font-size: 10px; letter-spacing: 2.5px; text-transform: uppercase; color: rgba(255,255,255,0.35); }

    /* ── Loading ── */
    #rvLoading { position: relative; z-index: 10; }
    .rv-spinner {
      width: 40px; height: 40px;
      border: 2px solid rgba(202,138,113,0.15);
      border-top-color: var(--accent);
      border-radius: 50%;
      animation: rv-spin .85s linear infinite;
    }
    @keyframes rv-spin { to { transform: rotate(360deg); } }

    /* ── Error modal ── */
    .rv-err-backdrop {
      display: none; position: fixed; inset: 0; z-index: 200;
      background: rgba(10,15,30,0.82); backdrop-filter: blur(8px);
      align-items: center; justify-content: center; padding: 24px;
    }
    .rv-err-backdrop.active { display: flex; animation: err-in .35s ease; }
    @keyframes err-in { from { opacity:0; } to { opacity:1; } }
    .rv-err-card {
      background: linear-gradient(145deg, #1a2a4a 0%, #0a1525 100%);
      border: 1px solid rgba(202,138,113,.2); border-radius: 24px;
      padding: 40px 32px 32px; max-width: 360px; width: 100%;
      text-align: center; box-shadow: 0 32px 80px rgba(0,0,0,.7);
      animation: card-up .4s .05s cubic-bezier(.34,1.08,.64,1) both;
    }
    @keyframes card-up {
      from { opacity:0; transform:translateY(24px) scale(.96); }
      to   { opacity:1; transform:translateY(0) scale(1); }
    }
    .rv-err-logo { margin: 0 auto 20px; width: 48px; height: 48px; background: rgba(202,138,113,.12); border: 1.5px solid rgba(202,138,113,.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; }
    .rv-err-logo img { height: 22px; width: auto; }
    .rv-err-icon  { font-size: 40px; margin-bottom: 14px; line-height: 1; }
    .rv-err-title { font-size: 18px; font-weight: 800; color: #fff; margin-bottom: 10px; }
    .rv-err-msg   { font-size: 13px; color: rgba(255,255,255,.5); line-height: 1.7; margin-bottom: 26px; }
    .rv-err-btn   { display: inline-block; background: var(--accent); color: #fff; border: none; padding: 12px 32px; border-radius: 100px; font-size: 14px; font-weight: 700; cursor: pointer; text-decoration: none; transition: background .18s; }
    .rv-err-btn:hover { background: #b57560; }
    .rv-err-contact { margin-top: 14px; font-size: 11px; color: rgba(255,255,255,.25); }
    .rv-err-contact a { color: rgba(202,138,113,.6); text-decoration: none; }

    /* ── Teaser ── */
    .teaser {
      position: relative; z-index: 10; text-align: center;
      margin-bottom: 44px;
      opacity: 0; animation: fadeUp 0.7s ease 0.5s both;
      transition: opacity 0.4s ease, transform 0.4s ease;
    }
    .teaser.hide { opacity: 0 !important; pointer-events: none; transform: translateY(-10px); }
    .teaser-label { font-size: 10px; letter-spacing: 3px; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 6px; }
    .teaser-big   { font-family: Georgia, serif; font-size: 28px; color: #fff; font-weight: normal; line-height: 1.3; }
    .teaser-big em { color: var(--accent); font-style: normal; font-weight: bold; }

    /* ═══════════════════════════════════
       ENVELOPE SCENE
    ═══════════════════════════════════ */

    /* Outer wrapper: shifts down when opened to make room for ticket above */
    .envelope-wrap {
      position: relative; z-index: 10;
      opacity: 0; animation: fadeUp 0.7s ease 0.8s both;
      transition: transform 0.7s cubic-bezier(.22,1,.36,1);
    }
    .envelope-wrap.shifted { transform: translateY(110px); }

    /* The envelope — 380×240 */
    .envelope {
      width: 380px; height: 240px;
      position: relative;
      cursor: pointer;
      perspective: 1200px;        /* 3D context so flap backface-visibility works */
      filter: drop-shadow(0 20px 50px rgba(0,0,0,0.55)) drop-shadow(0 0 30px rgba(202,138,113,0.10));
      transition: filter 0.3s ease;
    }
    .envelope:hover:not(.opened) {
      filter: drop-shadow(0 24px 64px rgba(0,0,0,0.65)) drop-shadow(0 0 50px rgba(202,138,113,0.20));
    }

    /* Cream base */
    .env-base {
      position: absolute; inset: 0;
      background: linear-gradient(160deg, var(--teal2) 0%, var(--teal) 100%);
      border-radius: 6px 6px 10px 10px;
      border: 1px solid rgba(202,138,113,0.2);
      z-index: 2;
    }

    /* Bottom V-fold */
    .env-bottom-fold {
      position: absolute; bottom: 0; left: 0; right: 0;
      height: 130px; z-index: 3; overflow: hidden; border-radius: 0 0 10px 10px;
    }
    .env-bottom-fold::before {
      content: ''; position: absolute; bottom: -2px; left: -2px; right: -2px;
      height: 130px;
      background: linear-gradient(175deg, #143843 0%, #0A1E26 100%);
      clip-path: polygon(0 100%, 50% 0%, 100% 100%);
    }

    /* Left fold */
    .env-left-fold {
      position: absolute; left: 0; top: 0; bottom: 0; width: 50%;
      z-index: 3; overflow: hidden;
    }
    .env-left-fold::before {
      content: ''; position: absolute; left: -1px; top: -1px; bottom: -1px; width: 100%;
      background: linear-gradient(125deg, var(--teal2) 0%, var(--teal3) 100%);
      clip-path: polygon(0 0, 100% 50%, 0 100%);
      border-right: 1px solid rgba(202,138,113,0.12);
    }

    /* Right fold */
    .env-right-fold {
      position: absolute; right: 0; top: 0; bottom: 0; width: 50%;
      z-index: 3; overflow: hidden;
    }
    .env-right-fold::before {
      content: ''; position: absolute; right: -1px; top: -1px; bottom: -1px; width: 100%;
      background: linear-gradient(235deg, var(--teal2) 0%, var(--teal3) 100%);
      clip-path: polygon(100% 0, 0 50%, 100% 100%);
      border-left: 1px solid rgba(202,138,113,0.12);
    }

    /* Airmail border — diagonal stripes in brand colors */
    .env-airmail {
      position: absolute; inset: 0;
      border-radius: 6px 6px 10px 10px;
      border: 7px solid transparent;
      border-image: repeating-linear-gradient(
        -45deg,
        var(--accent) 0px, var(--accent) 8px,
        var(--teal3)  8px, var(--teal3)  16px
      ) 7;
      z-index: 6; pointer-events: none; opacity: 0.75;
    }

    /* Top flap */
    .env-flap {
      position: absolute; top: -1px; left: -1px; right: -1px;
      height: 140px; z-index: 5;
      transform-origin: top center;
      transform-style: preserve-3d;
      transition: transform 1.2s cubic-bezier(.4,0,.15,1);
      /* When rotated past 90° the back face must be invisible so it
         doesn't cover the ticket that's sliding out from underneath */
      backface-visibility: hidden;
      -webkit-backface-visibility: hidden;
    }
    .env-flap-inner { position: absolute; inset: 0; overflow: hidden; }
    .env-flap-inner::before {
      content: ''; position: absolute; top: -1px; left: -1px; right: -1px; height: 100%;
      background: linear-gradient(195deg, var(--teal2) 0%, var(--teal) 60%, var(--teal3) 100%);
      clip-path: polygon(0 0, 100% 0, 50% 100%);
      border: 1px solid rgba(202,138,113,0.18);
    }
    .env-flap-inner::after {
      content: ''; position: absolute; bottom: 0; left: 20%; right: 20%;
      height: 1px; background: rgba(202,138,113,0.15);
    }
    .envelope.opened .env-flap { transform: rotateX(-192deg); }

    /* Stamp */
    .env-stamp {
      position: absolute; top: 14px; right: 14px;
      width: 42px; height: 50px;
      background: var(--accent); border-radius: 3px; z-index: 7;
      display: flex; flex-direction: column; align-items: center; justify-content: center;
      gap: 3px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    .env-stamp::before { content: ''; position: absolute; inset: 3px; border: 1px solid rgba(255,255,255,0.35); border-radius: 2px; }
    .env-stamp img { width: 22px; height: 22px; object-fit: contain; }
    .env-stamp-text { font-size: 5.5px; font-weight: 700; letter-spacing: 0.5px; color: rgba(255,255,255,0.75); text-transform: uppercase; }

    /* Address lines */
    .env-address { position: absolute; bottom: 44px; left: 24px; z-index: 4; }
    .env-address-line { width: 72px; height: 1.5px; background: rgba(202,138,113,0.2); border-radius: 1px; margin-bottom: 5px; }
    .env-address-line:nth-child(2) { width: 55px; }
    .env-address-line:nth-child(3) { width: 64px; }

    /* Wax seal */
    .wax-seal {
      position: absolute; top: 50%; left: 50%;
      transform: translate(-50%, -50%); z-index: 8;
      transition: opacity 0.35s ease 0.1s, transform 0.35s ease 0.1s;
    }
    .wax-seal-circle {
      width: 60px; height: 60px; border-radius: 50%;
      background: radial-gradient(circle at 38% 32%, #d9906a 0%, var(--accent) 45%, #9a6248 100%);
      border: 2px solid rgba(255,255,255,0.15);
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 4px 16px rgba(0,0,0,0.4), 0 0 0 1px rgba(202,138,113,0.4), inset 0 1px 0 rgba(255,255,255,0.2);
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .wax-seal-circle img { width: 28px; height: 28px; object-fit: contain; }
    .wax-seal-circle:hover { transform: scale(1.06); box-shadow: 0 6px 20px rgba(202,138,113,0.45), 0 0 0 1px rgba(202,138,113,0.4), inset 0 1px 0 rgba(255,255,255,0.2); }
    .envelope.opened .wax-seal { opacity: 0; transform: translate(-50%, -50%) scale(0.5) rotate(18deg); }

    /* ── Boarding pass: starts FULLY inside envelope, slides up on open ── */
    /* Key: bottom:0 + height:220px → top sits at 240-0-220=20px inside envelope.
       env-base (z:2) covers the ticket (z:1) while inside.
       No overflow below envelope → no floor mask needed. */
    .env-ticket {
      position: absolute;
      left: 24px; right: 24px;
      bottom: 0;
      height: 220px;
      z-index: 1;           /* stays behind env-base (z:2) the whole time */
      border-radius: 10px;
      box-shadow: 0 -2px 16px rgba(0,0,0,0.12), 0 6px 28px rgba(0,0,0,0.3);
      background: #fff;
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }

    /* Slide ticket upward — NO z-index change, env-base naturally hides inside portion */
    .envelope.opened .env-ticket {
      animation: ticketRise 1.2s cubic-bezier(.22,1,.36,1) 0.55s both;
    }
    @keyframes ticketRise {
      0%   { transform: translateY(0); }
      100% { transform: translateY(-252px); }
    }

    /* ── Ticket layout ── */
    .ticket-header {
      background: linear-gradient(135deg, var(--accent) 0%, #b57257 100%);
      padding: 11px 16px 10px;
      display: flex; align-items: center; justify-content: space-between;
      flex-shrink: 0;
    }
    .ticket-header-logo img { height: 16px; width: auto; }
    .ticket-header-type {
      font-size: 7.5px; font-weight: 700; letter-spacing: 2.5px;
      text-transform: uppercase; color: rgba(255,255,255,0.6);
      border: 1px solid rgba(255,255,255,0.25); padding: 2px 7px; border-radius: 100px;
    }

    .ticket-body {
      flex: 1; /* fills remaining ticket height */
      padding: 14px 16px 12px;
      display: flex; flex-direction: column; gap: 10px;
      background: #fff; position: relative;
      min-height: 0; /* important for flex child */
    }

    /* Route */
    .ticket-route { display: flex; align-items: center; gap: 0; opacity: 0; }
    .envelope.opened .ticket-route { animation: fadeSlide 0.45s ease 1.8s both; }

    .ticket-airport { flex: 1; }
    .ticket-airport-label { font-size: 7.5px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #9ca3af; margin-bottom: 2px; }
    .ticket-iata { font-family: Georgia, serif; font-size: 34px; line-height: 1; letter-spacing: -2px; font-weight: normal; }
    .ticket-iata.from { color: #1f2937; }
    .ticket-iata.to   { color: var(--accent); }
    .ticket-city      { display: none; }
    .ticket-city.to   { display: none; }

    .ticket-route-mid {
      display: flex; flex-direction: column; align-items: center;
      padding: 0 14px; padding-top: 14px;
    }
    .ticket-route-line {
      width: 52px; height: 1px;
      background: linear-gradient(90deg, #e5e7eb, var(--accent), #e5e7eb);
      position: relative;
    }
    .ticket-route-plane { font-size: 14px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -60%); }

    /* Tear */
    .ticket-tear {
      height: 1px;
      background: repeating-linear-gradient(90deg, #e5e7eb 0, #e5e7eb 7px, transparent 7px, transparent 14px);
      margin: 0 -16px; position: relative; opacity: 0;
    }
    .ticket-tear::before, .ticket-tear::after {
      content: ''; position: absolute; top: 50%; transform: translateY(-50%);
      width: 14px; height: 14px; border-radius: 50%; background: var(--page-bg);
    }
    .ticket-tear::before { left: -7px; }
    .ticket-tear::after  { right: -7px; }
    .envelope.opened .ticket-tear { animation: fadeSlide 0.35s ease 2.0s both; }

    /* Details */
    .ticket-details { display: flex; gap: 0; opacity: 0; }
    .envelope.opened .ticket-details { animation: fadeSlide 0.45s ease 2.15s both; }
    .ticket-detail { flex: 1; }
    .ticket-detail + .ticket-detail { border-left: 1px solid #f3f4f6; padding-left: 12px; }
    .ticket-detail-label { font-size: 7.5px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #9ca3af; margin-bottom: 2px; }
    .ticket-detail-value { font-size: 11px; font-weight: 700; color: #1f2937; }
    .ticket-detail-value.accent { color: var(--accent); }

    /* Passengers */
    .ticket-pax { padding-top: 8px; border-top: 1px dashed #e5e7eb; opacity: 0; flex-shrink: 0; }
    .envelope.opened .ticket-pax { animation: fadeSlide 0.45s ease 2.3s both; }
    .ticket-pax-row { font-size: 9.5px; color: #374151; font-weight: 600; line-height: 1.5; }

    @keyframes fadeSlide {
      from { opacity: 0; transform: translateY(5px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Scratch canvas ── */
    #scratchCanvas {
      position: absolute; inset: 0; width: 100%; height: 100%;
      cursor: crosshair; z-index: 5; touch-action: none;
      border-radius: 0 0 10px 10px;
    }

    /* ── Hints ── */
    .hint {
      position: relative; z-index: 10; margin-top: 28px;
      display: flex; align-items: center; gap: 10px;
      color: rgba(255,255,255,0.4); font-size: 11px;
      letter-spacing: 2px; text-transform: uppercase;
      opacity: 0; animation: fadeUp 0.7s ease 1.2s both;
      transition: opacity 0.3s ease; user-select: none;
    }
    .hint.hide { opacity: 0 !important; pointer-events: none; }
    .hint-pulse {
      width: 6px; height: 6px; border-radius: 50%; background: var(--accent);
      animation: hintPop 1.6s ease-in-out infinite;
    }
    @keyframes hintPop { 0%,100% { transform: scale(1); opacity: 0.5; } 50% { transform: scale(1.7); opacity: 1; } }

    #scratchHintExternal {
      display: none; align-items: center; justify-content: center; gap: 8px;
      margin-top: 20px;
      font-size: 10px; font-weight: 700; letter-spacing: 2px;
      text-transform: uppercase; color: rgba(202,138,113,0.85);
      pointer-events: none; animation: hintPop 1.8s ease-in-out infinite;
    }
    #scratchHintExternal .sh-coin { font-size: 15px; }

    /* ── Confetti ── */
    .confetti-el {
      position: fixed; z-index: 50; pointer-events: none; opacity: 0;
      animation: confettiFall var(--dur, 2s) ease var(--delay, 0s) forwards;
    }
    @keyframes confettiFall {
      0%   { opacity: 0; transform: translate(0,0) rotate(0deg) scale(0.5); }
      8%   { opacity: 1; }
      85%  { opacity: 0.9; }
      100% { opacity: 0; transform: translate(var(--tx), 160px) rotate(var(--rot)) scale(1.1); }
    }

    /* ── Reveal CTA (ispod karte, posle grebalice) ── */
    @keyframes ctaReveal {
      0%   { opacity: 0; transform: translateY(22px) scale(0.93); filter: blur(4px); }
      60%  { opacity: 1; filter: blur(0px); }
      100% { opacity: 1; transform: translateY(0) scale(1); filter: blur(0px); }
    }
    @keyframes ctaLabelReveal {
      0%   { opacity: 0; transform: translateY(10px); letter-spacing: 4px; }
      100% { opacity: 1; transform: translateY(0);    letter-spacing: 2.5px; }
    }
    @keyframes ctaHomeReveal {
      0%   { opacity: 0; }
      100% { opacity: 1; }
    }

    #revealCTA {
      display: none;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      margin-top: 28px;
    }
    #revealCTA.show { display: flex; }

    #revealCTA.show .rv-cta-label {
      animation: ctaLabelReveal 0.7s cubic-bezier(.22,1,.36,1) 0.15s both;
    }
    #revealCTA.show .rv-cta-btn {
      animation: ctaReveal 0.85s cubic-bezier(.22,1,.36,1) 0.28s both;
    }
    #revealCTA.show .rv-cta-home {
      animation: ctaHomeReveal 0.6s ease 0.7s both;
    }

    .rv-cta-label {
      font-size: 10px; letter-spacing: 2.5px; text-transform: uppercase;
      color: rgba(255,255,255,0.35); user-select: none;
    }
    .rv-cta-btn {
      background: var(--accent);
      color: #fff;
      border: none;
      border-radius: 100px;
      padding: 16px 36px;
      font-size: 15px; font-weight: 700;
      cursor: pointer;
      box-shadow: 0 14px 40px -10px rgba(202,138,113,0.65);
      transition: transform 0.35s, box-shadow 0.35s;
      letter-spacing: 0.3px;
    }
    .rv-cta-btn:hover {
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0 20px 48px -10px rgba(202,138,113,0.75);
    }
    .rv-cta-home {
      font-size: 11px; color: rgba(255,255,255,0.25);
      text-decoration: none; letter-spacing: 0.5px;
      transition: color 0.2s;
    }
    .rv-cta-home:hover { color: rgba(255,255,255,0.5); }

    /* ── Sparkles ── */
    .rv-spark { position: fixed; pointer-events: none; z-index: 51; border-radius: 50%; }

    /* ── Shared animations ── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(12px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ═══════════════════════════════════════════════════
       TRIP DETAILS POPUP
    ═══════════════════════════════════════════════════ */
    :root {
      --ink: #f6f1e6;
      --ink-dim: rgba(246,241,230,0.62);
      --ink-faint: rgba(246,241,230,0.36);
      --pop-accent: #d99877;
      --pop-accent2: #e8b89a;
      --line: rgba(246,241,230,0.1);
    }

    .tp-backdrop {
      position: fixed; inset: 0;
      background: rgba(8,12,22,0);
      backdrop-filter: blur(0px);
      -webkit-backdrop-filter: blur(0px);
      z-index: 300;
      display: flex; align-items: center; justify-content: center;
      padding: 16px;
      pointer-events: none;
      transition: background 0.6s, backdrop-filter 0.6s;
      overflow: hidden; /* sprečava horizontalni scroll od tp-glow */
    }
    .tp-backdrop.open {
      background: rgba(8,12,22,0.82);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      pointer-events: auto;
    }

    .tp-modal {
      width: min(600px, 100%);
      max-height: calc(100vh - 32px);
      overflow-y: auto;
      overflow-x: hidden;
      background: linear-gradient(180deg, #14202f 0%, #0d1726 100%);
      border-radius: 22px;
      position: relative;
      color: var(--ink);
      font-family: system-ui, 'Segoe UI', sans-serif;
      box-shadow:
        0 32px 80px -16px rgba(0,0,0,0.85),
        0 0 0 1px rgba(246,241,230,0.06);
      transform: translateY(32px) scale(0.95);
      opacity: 0;
      transition: transform 0.65s cubic-bezier(0.2,0.85,0.25,1), opacity 0.45s;
      scrollbar-width: none;
    }
    .tp-modal::-webkit-scrollbar { display: none; }
    .tp-backdrop.open .tp-modal {
      transform: translateY(0) scale(1);
      opacity: 1;
    }

    /* Glow ostaje unutar modala — bez negativnih offsets */
    .tp-glow {
      position: absolute; top: 0; left: 0; right: 0;
      height: 180px;
      background: radial-gradient(ellipse at center top, rgba(217,152,119,0.20), transparent 70%);
      pointer-events: none;
    }

    .tp-close {
      position: absolute; top: 12px; right: 12px;
      width: 32px; height: 32px;
      border-radius: 100px;
      background: rgba(246,241,230,0.06);
      border: 1px solid rgba(246,241,230,0.1);
      color: var(--ink);
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.25s, transform 0.25s;
      z-index: 5; font-size: 14px; line-height: 1;
    }
    .tp-close:hover { background: rgba(246,241,230,0.12); transform: rotate(90deg); }

    .tp-inner { padding: 24px 28px 20px; position: relative; }

    .tp-eyebrow {
      display: inline-flex; align-items: center; gap: 7px;
      font-size: 9px; letter-spacing: 0.30em;
      text-transform: uppercase;
      color: var(--pop-accent2);
      font-weight: 700;
      padding: 5px 12px;
      background: rgba(217,152,119,0.1);
      border: 1px solid rgba(217,152,119,0.22);
      border-radius: 100px;
    }
    .tp-eyebrow .tp-dot {
      width: 5px; height: 5px;
      background: var(--pop-accent);
      border-radius: 100px;
      box-shadow: 0 0 8px var(--pop-accent);
      animation: tp-pulse 1.6s ease-in-out infinite;
    }
    @keyframes tp-pulse {
      0%,100% { opacity:1; transform:scale(1); }
      50% { opacity:0.5; transform:scale(0.78); }
    }

    .tp-title {
      font-family: Georgia, 'Times New Roman', serif;
      font-size: clamp(22px, 3.5vw, 32px);
      font-weight: 500;
      line-height: 1.05;
      margin-top: 10px;
    }
    .tp-title em { font-style: italic; color: var(--pop-accent2); }
    .tp-sub { color: var(--ink-dim); font-size: 12px; margin-top: 4px; line-height: 1.5; }

    .tp-route {
      margin-top: 14px;
      background: rgba(246,241,230,0.03);
      border: 1px solid var(--line);
      border-radius: 14px;
      padding: 14px 18px;
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      align-items: center;
      gap: 10px;
      position: relative;
    }
    .tp-route::before {
      content: '';
      position: absolute; left: 50%; top: 50%;
      width: 56%; height: 1px;
      border-top: 1px dashed rgba(246,241,230,0.15);
      transform: translate(-50%, -50%);
    }
    .tp-rs { position: relative; z-index: 1; }
    .tp-rs.r { text-align: right; }
    .tp-rs .lab { font-size: 8px; letter-spacing: 0.28em; color: var(--ink-faint); font-weight: 700; }
    .tp-rs .city { font-size: 22px; font-weight: 700; margin-top: 3px; }
    .tp-rs .city.dest { font-family: Georgia, serif; font-style: italic; color: var(--pop-accent2); font-weight: 500; font-size: 26px; }
    .tp-rs .when { font-size: 11px; color: var(--ink-dim); margin-top: 2px; }
    .tp-plane-ic {
      position: relative; z-index: 1;
      width: 42px; height: 42px;
      background: linear-gradient(135deg, var(--pop-accent), #c5856a);
      border-radius: 100px;
      display: flex; align-items: center; justify-content: center;
      font-size: 17px;
      box-shadow: 0 6px 20px -5px rgba(217,152,119,0.55);
    }

    .tp-stats {
      margin-top: 10px;
      display: grid;
      grid-template-columns: repeat(3,1fr);
      gap: 8px;
    }
    .tp-stat {
      background: rgba(246,241,230,0.03);
      border: 1px solid var(--line);
      border-radius: 12px;
      padding: 10px 12px;
      display: flex; flex-direction: column; gap: 3px;
    }
    .tp-stat .ic { font-size: 16px; line-height: 1; }
    .tp-stat .lab { font-size: 8px; letter-spacing: 0.26em; color: var(--ink-faint); font-weight: 700; }
    .tp-stat .v { font-size: 13px; font-weight: 700; }

    .tp-details {
      margin-top: 10px;
      background: rgba(246,241,230,0.03);
      border: 1px solid var(--line);
      border-radius: 14px;
      padding: 2px 16px;
    }
    .tp-det-row {
      display: flex; align-items: center; justify-content: space-between;
      padding: 9px 0;
      border-bottom: 1px solid var(--line);
      gap: 12px;
    }
    .tp-det-row:last-child { border-bottom: none; }
    .tp-det-row .l { color: var(--ink-dim); font-size: 12px; flex-shrink: 0; }
    .tp-det-row .v { font-weight: 700; font-size: 12px; text-align: right; }

    .tp-inbox {
      margin-top: 10px;
      background: linear-gradient(135deg, rgba(30,107,84,0.16), rgba(217,152,119,0.07));
      border: 1px solid rgba(30,107,84,0.28);
      border-radius: 12px;
      padding: 12px 14px;
      display: flex; gap: 12px; align-items: flex-start;
    }
    .tp-inbox-ic {
      width: 34px; height: 34px; flex-shrink: 0;
      background: rgba(30,107,84,0.25);
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      font-size: 15px;
    }
    .tp-inbox-tx h4 {
      font-family: Georgia, serif; font-size: 14px; font-weight: 600; margin-bottom: 2px;
      color: var(--ink);
    }
    .tp-inbox-tx p { color: var(--ink-dim); font-size: 11px; line-height: 1.5; }

    .tp-foot {
      margin-top: 12px;
      display: flex; align-items: center; justify-content: space-between;
      gap: 10px;
      padding-top: 12px;
      border-top: 1px solid var(--line);
    }
    .tp-foot .small { font-size: 11px; color: var(--ink-faint); }
    .tp-foot .ok {
      background: var(--pop-accent);
      color: #1a1410;
      font-weight: 700;
      padding: 10px 20px;
      border: none;
      border-radius: 100px;
      cursor: pointer;
      font-size: 13px;
      transition: transform 0.25s, box-shadow 0.25s;
    }
    .tp-foot .ok:hover { transform: translateY(-2px); box-shadow: 0 8px 24px -5px rgba(217,152,119,0.5); }

    /* Stagger */
    .tp-stagger > * { opacity: 0; transform: translateY(10px); transition: opacity 0.5s, transform 0.5s; }
    .tp-backdrop.open .tp-stagger > * { opacity: 1; transform: translateY(0); }
    .tp-backdrop.open .tp-stagger > *:nth-child(1) { transition-delay: 0.10s; }
    .tp-backdrop.open .tp-stagger > *:nth-child(2) { transition-delay: 0.16s; }
    .tp-backdrop.open .tp-stagger > *:nth-child(3) { transition-delay: 0.22s; }
    .tp-backdrop.open .tp-stagger > *:nth-child(4) { transition-delay: 0.28s; }
    .tp-backdrop.open .tp-stagger > *:nth-child(5) { transition-delay: 0.34s; }
    .tp-backdrop.open .tp-stagger > *:nth-child(6) { transition-delay: 0.40s; }
    .tp-backdrop.open .tp-stagger > *:nth-child(7) { transition-delay: 0.46s; }

    /* Modal confetti */
    .tp-confetti { position: absolute; inset: 0; pointer-events: none; overflow: hidden; border-radius: 22px; }
    .tp-confetti span { position: absolute; width: 5px; height: 5px; border-radius: 100px; opacity: 0; }
    .tp-backdrop.open .tp-confetti span {
      animation: tp-confetti-fall 1.3s cubic-bezier(0.2,0.8,0.3,1) forwards;
    }
    @keyframes tp-confetti-fall {
      0%   { opacity: 0; transform: translate(0,0) scale(0); }
      18%  { opacity: 1; }
      100% { opacity: 0; transform: translate(var(--dx), var(--dy)) scale(1); }
    }

    /* ── Mobile ── */
    @media (max-width: 460px) {
      .envelope { width: 310px; height: 196px; }
      .env-flap { height: 114px; }
      .env-bottom-fold { height: 106px; }
      .env-bottom-fold::before { height: 106px; }
      .env-ticket { left: 18px; right: 18px; bottom: 0; height: 180px; }
      @keyframes ticketRise {
        0%   { transform: translateY(0); }
        100% { transform: translateY(-200px); }
      }
      .ticket-iata { font-size: 26px; }
      .teaser-big  { font-size: 24px; }
      .envelope-wrap.shifted { transform: translateY(56px); }
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
           onerror="this.outerHTML='<span style=\'font-family:Georgia,serif;font-size:15px;color:var(--accent);\'>e</span>'">
    </div>
    <div class="rv-err-icon"  id="rvErrIcon">⚠️</div>
    <div class="rv-err-title" id="rvErrTitle">Nešto je pošlo po krivu</div>
    <div class="rv-err-msg"   id="rvErrMsg">Došlo je do neočekivane greške. Pokušaj ponovo ili nas kontaktiraj.</div>
    <a href="/" class="rv-err-btn">← Nazad na početnu</a>
    <div class="rv-err-contact">Problem? Piši nam na <a href="mailto:escapii.team@gmail.com">escapii.team@gmail.com</a></div>
  </div>
</div>

<!-- Top logo -->
<div class="top-logo">
  <img src="<?php echo esc_url($logo_url); ?>" alt="Escapii" onerror="this.style.display='none'">
  <div class="logo-divider"></div>
  <div class="logo-sub">Mystery Travel</div>
</div>

<!-- Loading -->
<div id="rvLoading"><div class="rv-spinner"></div></div>

<!-- Teaser -->
<div class="teaser" id="rvTeaser" style="display:none;">
  <div class="teaser-label" id="teaserName">✦ Tvoje putovanje</div>
  <div class="teaser-big">Tvoja destinacija<br>čeka u koverti</div>
</div>

<!-- Envelope -->
<div class="envelope-wrap" id="rvEnvWrap" style="display:none;">
  <div class="envelope" id="env" onclick="openEnv()">

    <!-- Base & folds (z:2-3, naturally hide ticket while inside) -->
    <div class="env-base"></div>
    <div class="env-bottom-fold"></div>
    <div class="env-left-fold"></div>
    <div class="env-right-fold"></div>

    <!-- Airmail decorative border -->
    <div class="env-airmail"></div>

    <!-- Stamp with favicon -->
    <div class="env-stamp">
      <img src="<?php echo esc_url($favicon_url); ?>" alt=""
           onerror="this.style.display='none'">
      <div class="env-stamp-text">escapii</div>
    </div>

    <!-- Address lines -->
    <div class="env-address">
      <div class="env-address-line"></div>
      <div class="env-address-line"></div>
      <div class="env-address-line"></div>
    </div>

    <!-- Boarding pass (z:1 — hidden behind folds while inside, slides above) -->
    <div class="env-ticket">
      <div class="ticket-header">
        <div class="ticket-header-logo">
          <img src="<?php echo esc_url($logo_url); ?>" alt="Escapii"
               onerror="this.outerHTML='<span style=\'font-family:Georgia,serif;font-size:14px;color:#fff;\'>escapii.</span>'">
        </div>
        <div class="ticket-header-type">Boarding Pass</div>
      </div>
      <div class="ticket-body">
        <div class="ticket-route">
          <div class="ticket-airport">
            <div class="ticket-airport-label">Od</div>
            <div class="ticket-iata from" id="ticketFromIata">BEG</div>
            <div class="ticket-city"      id="ticketFromCity">Beograd</div>
          </div>
          <div class="ticket-route-mid">
            <div class="ticket-route-line">
              <span class="ticket-route-plane">✈</span>
            </div>
          </div>
          <div class="ticket-airport" style="text-align:right;">
            <div class="ticket-airport-label" style="text-align:right;">Do</div>
            <div class="ticket-iata to" id="ticketDestIata">—</div>
            <div class="ticket-city to"  id="ticketDestCity">—</div>
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
          <div class="ticket-detail" id="ticketAirlineRow" style="display:none;">
            <div class="ticket-detail-label">Check-in kod</div>
            <div class="ticket-detail-value accent" id="ticketAirlineCode">—</div>
          </div>
        </div>
        <div class="ticket-pax">
          <div class="ticket-pax-row">✈&nbsp;<span id="ticketPassengers">—</span></div>
        </div>
      </div>
    </div>

    <!-- Top flap (opens upward) -->
    <div class="env-flap"><div class="env-flap-inner"></div></div>

    <!-- Wax seal with favicon -->
    <div class="wax-seal">
      <div class="wax-seal-circle">
        <img src="<?php echo esc_url($favicon_url); ?>" alt=""
             onerror="this.style.display='none'">
      </div>
    </div>

  </div><!-- /envelope -->

  <!-- Scratch hint — inside envelope-wrap so it shifts down with it -->
  <div id="scratchHintExternal">
    <span class="sh-coin">🪙</span>
    OGREBI I OTKRIJ DESTINACIJU
    <span class="sh-coin">🪙</span>
  </div>

  <!-- CTA dugme — pojavljuje se posle grebalice, na mestu hinta -->
  <div id="revealCTA">
    <div class="rv-cta-label">✦ destinacija otkrivena</div>
    <button class="rv-cta-btn" onclick="openTripPopup()">Vidi detalje putovanja</button>
    <a class="rv-cta-home" href="/">← Nazad na početnu</a>
  </div>

</div><!-- /envelope-wrap -->

<!-- Click hint -->
<div class="hint" id="hint" style="display:none;">
  <div class="hint-pulse"></div>
  Klikni da otvoriš
  <div class="hint-pulse"></div>
</div>

<!-- success-city hidden span — koristi se samo za JS -->
<span id="success-city" style="display:none;"></span>

<!-- Trip details popup -->
<div class="tp-backdrop" id="tripModal" style="display:none;">
  <div class="tp-modal" role="dialog" aria-modal="true">
    <div class="tp-glow"></div>
    <div class="tp-confetti" id="tpConfetti"></div>
    <button class="tp-close" id="tpClose" aria-label="Zatvori" onclick="closeTripPopup()">✕</button>

    <div class="tp-inner tp-stagger">
      <span class="tp-eyebrow"><span class="tp-dot"></span>Putovanje potvrđeno</span>
      <h2 class="tp-title">Detalji vašeg <em>putovanja</em></h2>
      <p class="tp-sub">Rezervacija <strong id="tpRef">—</strong> · spremamo sve za vaš odlazak.</p>

      <div class="tp-route">
        <div class="tp-rs">
          <div class="lab">POLAZAK</div>
          <div class="city" id="tpFrom">—</div>
          <div class="when" id="tpDepDate">—</div>
        </div>
        <div class="tp-plane-ic">✈</div>
        <div class="tp-rs r">
          <div class="lab">DESTINACIJA</div>
          <div class="city dest" id="tpDest">—</div>
          <div class="when" id="tpRetDate">—</div>
        </div>
      </div>

      <div class="tp-stats">
        <div class="tp-stat">
          <div class="ic">👥</div>
          <div class="lab">PUTNIKA</div>
          <div class="v" id="tpTravelers">—</div>
        </div>
        <div class="tp-stat">
          <div class="ic">📅</div>
          <div class="lab">TRAJANJE</div>
          <div class="v" id="tpNights">—</div>
        </div>
        <div class="tp-stat">
          <div class="ic">📍</div>
          <div class="lab">DESTINACIJA</div>
          <div class="v" id="tpDestCity">—</div>
        </div>
      </div>

      <div class="tp-details">
        <div class="tp-det-row" id="tpAirlineRow" style="display:none;"><span class="l">✈ Check-in kod</span><span class="v" id="tpAirlineCode" style="color:var(--pop-accent2);font-weight:700;letter-spacing:1px;">—</span></div>
        <div class="tp-det-row" id="tpAddonsRow"><span class="l">Dodaci</span><span class="v" id="tpAddons">—</span></div>
        <div class="tp-det-row"><span class="l">Putnici</span><span class="v" id="tpPassengerList">—</span></div>
        <div class="tp-det-row"><span class="l">Ukupno plaćeno</span><span class="v" id="tpTotal" style="color:var(--pop-accent2)">—</span></div>
      </div>

      <div class="tp-inbox">
        <div class="tp-inbox-ic">✉️</div>
        <div class="tp-inbox-tx">
          <h4>Uskoro stiže email sa boarding kartama</h4>
          <p>Poslaćemo ti zvanični email sa svim daljim koracima — check-in instrukcije, boarding pass i savete za putovanje. Proveri inbox u narednih 24h.</p>
        </div>
      </div>

      <div class="tp-foot">
        <span class="small">🔒 Sigurna rezervacija</span>
        <button class="ok" onclick="closeTripPopup()">Razumem, hvala</button>
      </div>
    </div>
  </div>
</div>

<script>
const API = '<?php echo esc_js(escapii_api_url()); ?>';
let opened = false, errorShown = false, revealData = null;

/* ── Global error handlers ── */
window.onerror = function() { showError(0); return true; };
window.addEventListener('unhandledrejection', function() { showError(0); });

/* ── Starfield ── */
(function(){
  const c = document.getElementById('sky'), ctx = c.getContext('2d');
  let stars = [];
  function resize(){ c.width = innerWidth; c.height = innerHeight; }
  function init(){
    stars = Array.from({length:150}, () => ({
      x: Math.random()*c.width, y: Math.random()*c.height,
      r: Math.random()*1.3+0.2,
      a: Math.random(), da: (Math.random()*0.004+0.001)*(Math.random()>.5?1:-1),
      accent: Math.random()>.88
    }));
  }
  function draw(){
    ctx.clearRect(0,0,c.width,c.height);
    stars.forEach(s=>{
      s.a += s.da;
      if(s.a>1){s.a=1;s.da*=-1;} if(s.a<0.04){s.a=0.04;s.da*=-1;}
      ctx.beginPath(); ctx.arc(s.x,s.y,s.r,0,Math.PI*2);
      ctx.fillStyle = s.accent ? `rgba(202,138,113,${s.a*.7})` : `rgba(255,255,255,${s.a*.65})`;
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
  return d + '. ' + (mon[+m-1] || m) + ' ' + y + '.';
}
function airportCity(iata) {
  return ({BEG:'Beograd',INI:'Niš',ZAG:'Zagreb',BUD:'Budimpešta',TIM:'Temišvar'})[iata] || iata || '—';
}

/* ── Mapa prevoda destinacija (engleski → srpski prikaz) ── */
const DEST_SR = {
  // Grčka
  'Athens':'Atina', 'Thessaloniki':'Solun', 'Crete':'Krit',
  'Rhodes':'Rodos', 'Corfu':'Krf', 'Mykonos':'Mikonos',
  'Santorini':'Santorini', 'Zakynthos':'Zakintos',
  // Italija
  'Rome':'Rim', 'Venice':'Venecija', 'Florence':'Firenca',
  'Naples':'Napulj', 'Sicily':'Sicilija', 'Sardinia':'Sardinija',
  'Milan':'Milano', 'Turin':'Torino',
  // Španija
  'Barcelona':'Barselona', 'Seville':'Sevilja', 'Valencia':'Valensija',
  'Ibiza':'Ibiza', 'Mallorca':'Majorka', 'Tenerife':'Tenerife',
  // Francuska
  'Paris':'Pariz', 'Nice':'Nica', 'Marseille':'Marsej', 'Lyon':'Lion',
  'Bordeaux':'Bordo',
  // Portugal
  'Lisbon':'Lisabon',
  // Austrija
  'Vienna':'Beč', 'Salzburg':'Zalcburg', 'Innsbruck':'Inzbruk',
  // Nemačka
  'Munich':'Minhen', 'Cologne':'Keln', 'Stuttgart':'Štutgart',
  'Nuremberg':'Nirnberg', 'Leipzig':'Lajpcig', 'Dresden':'Drezden',
  // Švajcarska
  'Zurich':'Cirih', 'Geneva':'Ženeva', 'Basel':'Bazel',
  // Belgija
  'Brussels':'Brisel', 'Bruges':'Briž', 'Antwerp':'Antverpen',
  // UK
  'London':'London', 'Edinburgh':'Edinburg', 'Glasgow':'Glazgov',
  'Manchester':'Mančester', 'Liverpool':'Liverpul',
  // Skandinavija
  'Copenhagen':'Kopenhagen', 'Stockholm':'Stokholm', 'Oslo':'Oslo',
  'Helsinki':'Helsinki', 'Reykjavik':'Rejkjavik',
  // Baltik / Istočna Evropa
  'Warsaw':'Varšava', 'Krakow':'Krakov', 'Prague':'Prag',
  'Bucharest':'Bukurešt', 'Sofia':'Sofija', 'Skopje':'Skoplje',
  'Vilnius':'Vilnjus', 'Riga':'Riga', 'Tallinn':'Talin',
  'Budapest':'Budimpešta', 'Luxembourg':'Luksemburg', 'Monaco':'Monako',
  // Mediteran / Bliski Istok
  'Istanbul':'Istanbul', 'Cyprus':'Kipar', 'Malta':'Malta',
  'Cairo':'Kairo', 'Marrakech':'Marakеš', 'Casablanca':'Kazablanka',
  'Dubai':'Dubai', 'Abu Dhabi':'Abu Dabi', 'Doha':'Doha',
  // Daleki Istok / Ostalo
  'Tokyo':'Tokio', 'Kyoto':'Kjoto', 'Seoul':'Seul',
  'Beijing':'Peking', 'Shanghai':'Šangaj', 'Singapore':'Singapur',
  'Bangkok':'Bangkok', 'Bali':'Bali', 'Maldives':'Maldivi',
  'Sydney':'Sidnej', 'Melbourne':'Melburn',
  'New York':'Njujork', 'Cape Town':'Kejptaun',
};
function translateDest(name) {
  if (!name || name === '—') return name;
  return DEST_SR[name] || name;
}

/* ── Error ── */
function showError(status) {
  if (errorShown) return; errorShown = true;
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

/* ── Show envelope ── */
function showEnvelope(data) {
  revealData = data;
  document.getElementById('rvLoading').style.display = 'none';

  const iata = (data.departureAirport || '').toUpperCase();
  document.getElementById('ticketFromIata').textContent = iata || 'BEG';
  document.getElementById('ticketFromCity').textContent = airportCity(iata);
  document.getElementById('ticketDestIata').textContent = '—'; /* hidden under scratch card */
  document.getElementById('ticketDestCity').textContent = translateDest(data.destination) || '—';
  document.getElementById('ticketDate').textContent     = fmtDate(data.departureDate);
  document.getElementById('ticketReturn').textContent   = fmtDate(data.returnDate);
  document.getElementById('ticketRef').textContent      = data.bookingRef || '—';
  // Airline booking code — prikazuje se tek kad admin unese
  if (data.airlineBookingCode) {
    document.getElementById('ticketAirlineCode').textContent = data.airlineBookingCode;
    const airlineRow = document.getElementById('ticketAirlineRow');
    if (airlineRow) airlineRow.style.display = '';
  }
  // (success-city se ne prikazuje više — sklonjen success bar)

  const names = Array.isArray(data.passengers) && data.passengers.length
    ? data.passengers.join(' · ') : '—';
  document.getElementById('ticketPassengers').textContent = names;
  document.getElementById('teaserName').textContent = '✦ ' + (data.firstName || 'Tvoje putovanje');

  // Store translated destination for post-scratch reveal
  document.getElementById('ticketDestIata').dataset.dest = translateDest(data.destination) || '—';

  const teaser  = document.getElementById('rvTeaser');
  const envWrap = document.getElementById('rvEnvWrap');
  const hint    = document.getElementById('hint');

  teaser.style.display  = 'block';
  envWrap.style.display = 'block';
  hint.style.display    = 'flex';

  requestAnimationFrame(() => {
    teaser.style.animation  = 'fadeUp 0.7s ease 0.1s both';
    teaser.style.opacity    = '';
    envWrap.style.animation = 'fadeUp 0.7s ease 0.45s both';
    envWrap.style.opacity   = '';
  });
}

/* ── Open envelope ── */
function openEnv() {
  if (opened) return;
  opened = true;

  const env     = document.getElementById('env');
  const envWrap = document.getElementById('rvEnvWrap');
  const hint    = document.getElementById('hint');
  const teaser  = document.getElementById('rvTeaser');

  env.classList.add('opened');
  hint.classList.add('hide');
  teaser.classList.add('hide');

  // Shift envelope down to make room for ticket above
  setTimeout(() => envWrap.classList.add('shifted'), 50);

  // Once ticket is almost fully out (1700ms ≈ 96% of animation),
  // raise its z-index above everything so no element can cover it
  setTimeout(() => {
    const t = document.querySelector('.env-ticket');
    if (t) t.style.zIndex = '20';
  }, 1700);

  // Add scratch card IMMEDIATELY — canvas covers ticket-body from the start,
  // so the white background is never visible (even while ticket is still inside).
  addScratchCard();

  // Confetti + takeoff plane
  setTimeout(spawnConfetti, 1200);
  setTimeout(launchTakeoff,  1400);
}

/* ── Confetti ── */
function spawnConfetti(){
  const syms   = ['✦','✈','★','✦','●'];
  const colors = ['#CA8A71','#f97316','#fbbf24','#fff','#fb923c'];
  for(let i=0;i<40;i++){
    const el = document.createElement('div');
    el.className = 'confetti-el';
    el.textContent = syms[Math.floor(Math.random()*syms.length)];
    el.style.color    = colors[Math.floor(Math.random()*colors.length)];
    el.style.left     = (15+Math.random()*70)+'vw';
    el.style.top      = (10+Math.random()*55)+'vh';
    el.style.fontSize = (9+Math.random()*13)+'px';
    el.style.setProperty('--dur',   (1.4+Math.random()*1.8)+'s');
    el.style.setProperty('--delay', (Math.random()*.65)+'s');
    el.style.setProperty('--tx',    (Math.random()*220-110)+'px');
    el.style.setProperty('--rot',   (Math.random()*700-350)+'deg');
    document.body.appendChild(el);
    setTimeout(()=>el.remove(), 4000);
  }
}

/* ── Takeoff plane ── */
function launchTakeoff(){
  const canvas = document.getElementById('takeoff');
  canvas.width = innerWidth; canvas.height = innerHeight;
  canvas.classList.add('active');
  const ctx = canvas.getContext('2d');
  const W = canvas.width, H = canvas.height;
  const DUR = 3200; let start = null; const trail = [];

  function easeIn(t){ return t*t*t; }
  function easeIO(t){ return t<.5?2*t*t:-1+(4-2*t)*t; }

  function plane(x,y,angle,sc,alpha){
    ctx.save(); ctx.globalAlpha=alpha;
    ctx.translate(x,y); ctx.rotate(angle); ctx.scale(sc,sc);
    ctx.fillStyle='#fff';
    ctx.beginPath(); ctx.ellipse(0,0,28,8,0,0,Math.PI*2); ctx.fill();
    ctx.beginPath(); ctx.moveTo(28,0); ctx.lineTo(40,0); ctx.lineTo(28,-4); ctx.closePath(); ctx.fill();
    ctx.beginPath(); ctx.moveTo(-22,0); ctx.lineTo(-32,-16); ctx.lineTo(-16,-2); ctx.closePath(); ctx.fill();
    ctx.fillStyle='#e2e8f0';
    ctx.beginPath(); ctx.moveTo(-4,0); ctx.lineTo(12,0); ctx.lineTo(2,-24); ctx.lineTo(-8,-18); ctx.closePath(); ctx.fill();
    ctx.beginPath(); ctx.moveTo(-4,0); ctx.lineTo(12,0); ctx.lineTo(2,24); ctx.lineTo(-8,18); ctx.closePath(); ctx.fill();
    const eg=ctx.createLinearGradient(-32,0,-56,0);
    eg.addColorStop(0,'rgba(202,138,113,.7)'); eg.addColorStop(1,'rgba(202,138,113,0)');
    ctx.strokeStyle=eg; ctx.lineWidth=3.5; ctx.lineCap='round';
    ctx.beginPath(); ctx.moveTo(-32,0); ctx.lineTo(-56,Math.sin(Date.now()/100)*2); ctx.stroke();
    ctx.restore();
  }

  function frame(ts){
    if(!start) start=ts;
    const t=Math.min((ts-start)/DUR,1);
    ctx.clearRect(0,0,W,H);
    let px,py,angle,sc;
    const sx=W*.36, sy=H*.64;
    if(t<.38){ const q=easeIO(t/.38); px=sx+q*W*.24; py=sy; angle=0; sc=1.1; }
    else if(t<.62){ const q=easeIn((t-.38)/.24); px=sx+W*.24+q*W*.15; py=sy-q*H*.2; angle=-q*.32; sc=1.1+q*.08; }
    else { const q=easeIn((t-.62)/.38); px=sx+W*.39+q*W*.75; py=sy-H*.2-q*H*.72; angle=-.32-q*.18; sc=1.18-q*.45; }
    const alpha=t<.05?t/.05:t>.85?(1-t)/.15:1;
    trail.push({x:px,y:py}); if(trail.length>26) trail.shift();
    if(trail.length>1){
      ctx.save(); ctx.strokeStyle='rgba(255,255,255,.08)'; ctx.lineWidth=2; ctx.setLineDash([5,8]);
      ctx.lineDashOffset=-(Date.now()/75)%13;
      ctx.beginPath(); ctx.moveTo(trail[0].x,trail[0].y);
      trail.forEach(pt=>ctx.lineTo(pt.x,pt.y)); ctx.stroke(); ctx.setLineDash([]); ctx.restore();
    }
    plane(px,py,angle,sc,alpha);
    if(t<1) requestAnimationFrame(frame);
    else { canvas.classList.remove('active'); ctx.clearRect(0,0,W,H); }
  }
  requestAnimationFrame(frame);
}

/* ── Scratch card ── */
function addScratchCard() {
  const ticketBody = document.querySelector('.ticket-body');
  if (!ticketBody) return;

  // Force all ticket content visible (they're behind the canvas, revealed when scratched)
  ticketBody.querySelectorAll('.ticket-route, .ticket-tear, .ticket-details, .ticket-pax').forEach(el => {
    el.style.cssText = 'opacity:1;animation:none;transform:none;';
  });

  const dpr  = window.devicePixelRatio || 1;
  const rect = ticketBody.getBoundingClientRect();

  const canvas = document.createElement('canvas');
  canvas.id = 'scratchCanvas';
  canvas.width  = Math.round(rect.width  * dpr);
  canvas.height = Math.round(rect.height * dpr);
  ticketBody.style.position = 'relative';
  ticketBody.appendChild(canvas);

  const ctx = canvas.getContext('2d');
  const W = canvas.width, H = canvas.height;

  /* Cover: dark gradient matching brand */
  const grad = ctx.createLinearGradient(0, 0, W, H);
  grad.addColorStop(0, '#1c0e06');
  grad.addColorStop(0.5, '#2a1208');
  grad.addColorStop(1, '#120a16');
  ctx.fillStyle = grad;
  ctx.fillRect(0, 0, W, H);

  /* Diagonal stripe texture (matches airmail border) */
  ctx.save();
  ctx.strokeStyle = 'rgba(202,138,113,0.07)';
  ctx.lineWidth = 8 * dpr;
  for (let i = -H; i < W + H; i += 20 * dpr) {
    ctx.beginPath(); ctx.moveTo(i, 0); ctx.lineTo(i + H, H); ctx.stroke();
  }
  ctx.restore();

  /* Center text */
  ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
  ctx.font = `${Math.round(20 * dpr)}px serif`;
  ctx.fillStyle = 'rgba(202,138,113,0.8)';
  ctx.fillText('🪙', W/2, H/2 - Math.round(16 * dpr));

  ctx.font = `bold ${Math.round(8 * dpr)}px system-ui, sans-serif`;
  ctx.fillStyle = 'rgba(202,138,113,1)';
  ctx.fillText('✦  OGREBI DA OTKRIJEŠ  ✦', W/2, H/2 + Math.round(2 * dpr));

  ctx.font = `${Math.round(6.5 * dpr)}px system-ui, sans-serif`;
  ctx.fillStyle = 'rgba(255,255,255,0.3)';
  ctx.fillText('svoju destinaciju', W/2, H/2 + Math.round(15 * dpr));

  /* Show external hint */
  const hintExt = document.getElementById('scratchHintExternal');
  if (hintExt) hintExt.style.display = 'flex';

  /* Scratch logic */
  let drawing = false, revealed = false;
  const total = W * H;

  function getXY(e) {
    const r = canvas.getBoundingClientRect();
    const sx = W/r.width, sy = H/r.height;
    const src = e.touches ? e.touches[0] : e;
    return [(src.clientX - r.left)*sx, (src.clientY - r.top)*sy];
  }
  function scratchAt(x, y) {
    ctx.globalCompositeOperation = 'destination-out';
    ctx.beginPath(); ctx.arc(x, y, 26*dpr, 0, Math.PI*2); ctx.fill();
    ctx.globalCompositeOperation = 'source-over';
    if (!revealed) checkReveal();
  }
  function checkReveal() {
    const px = ctx.getImageData(0,0,W,H).data;
    let cleared = 0;
    for (let i=3; i<px.length; i+=4) if(px[i]<128) cleared++;
    if (cleared/total > 0.50) { revealed = true; fullyReveal(); }
  }
  function fullyReveal() {
    // Show real destination name in IATA slot
    const destEl = document.getElementById('ticketDestIata');
    if (destEl) destEl.textContent = destEl.dataset.dest || '—';

    canvas.style.transition = 'opacity 0.5s ease';
    canvas.style.opacity    = '0';
    if (hintExt) { hintExt.style.transition = 'opacity 0.3s'; hintExt.style.opacity = '0'; }

    setTimeout(() => {
      canvas.remove();
      if (hintExt) hintExt.style.display = 'none';
      // Prikaži CTA dugme ispod karte
      const cta = document.getElementById('revealCTA');
      if (cta) cta.classList.add('show');
      // Obavesti backend da je korisnik ogrebaо (fire-and-forget)
      const _tok = new URLSearchParams(location.search).get('token');
      if (_tok) fetch(`${API}/api/reveal/confirm?token=${encodeURIComponent(_tok)}`, { method: 'POST' }).catch(() => {});
    }, 550);

    // Sparkle burst
    setTimeout(() => {
      const el = destEl || document.getElementById('ticketDestCity');
      if (!el) return;
      const r = el.getBoundingClientRect();
      const cx = r.left+r.width/2, cy = r.top+r.height/2;
      const cols = ['#CA8A71','#fbbf24','#fff','#f97316'];
      for(let i=0;i<22;i++){
        const sp = document.createElement('div'); sp.className='rv-spark';
        const sz=Math.random()*7+3, ang=(Math.PI*2*i/22)+(Math.random()-.5)*.5, dist=50+Math.random()*90;
        sp.style.cssText=`width:${sz}px;height:${sz}px;background:${cols[i%cols.length]};border-radius:${Math.random()>.4?'50%':'3px'};left:${cx}px;top:${cy}px;transform:translate(-50%,-50%);opacity:1`;
        document.body.appendChild(sp);
        const tx=Math.cos(ang)*dist, ty=Math.sin(ang)*dist;
        const dur=0.45+Math.random()*.4, del=Math.random()*.1;
        requestAnimationFrame(()=>requestAnimationFrame(()=>{
          sp.style.transition=`transform ${dur}s ${del}s ease-out,opacity ${dur*.8}s ${del+.1}s ease-out`;
          sp.style.transform=`translate(calc(-50% + ${tx}px),calc(-50% + ${ty}px)) rotate(${Math.random()*360}deg)`;
          sp.style.opacity='0';
        }));
        setTimeout(()=>sp.remove(),(dur+del+.2)*1000);
      }
    }, 180);
  }

  canvas.addEventListener('mousedown',  e=>{drawing=true;const[x,y]=getXY(e);scratchAt(x,y);});
  window.addEventListener('mouseup',    ()=>drawing=false);
  canvas.addEventListener('mousemove',  e=>{if(drawing){const[x,y]=getXY(e);scratchAt(x,y);}});
  canvas.addEventListener('touchstart', e=>{e.preventDefault();drawing=true;const[x,y]=getXY(e);scratchAt(x,y);},{passive:false});
  canvas.addEventListener('touchmove',  e=>{e.preventDefault();if(drawing){const[x,y]=getXY(e);scratchAt(x,y);}},{passive:false});
  canvas.addEventListener('touchend',   ()=>drawing=false);
}

/* ── Trip popup helpers ── */
function fmtDateLong(iso) {
  if (!iso) return '—';
  const [y,m,d] = iso.split('-');
  const mon = ['jan','feb','mar','apr','maj','jun','jul','avg','sep','okt','nov','dec'];
  return d + '. ' + (mon[+m-1] || m) + ' ' + y + '.';
}

function airportCityFull(iata) {
  return ({BEG:'Beograd',INI:'Niš',ZAG:'Zagreb',BUD:'Budimpešta',TIM:'Temišvar'})[iata] || iata || '—';
}

function fmtMoney(eur) {
  if (!eur && eur !== 0) return '—';
  return '€' + Number(eur).toLocaleString('de-DE', {minimumFractionDigits:2, maximumFractionDigits:2});
}

function setupModalConfetti() {
  const c = document.getElementById('tpConfetti');
  if (!c) return;
  c.innerHTML = '';
  const colors = ['#d99877','#e8b89a','#fff','#f97316','#fbbf24','#fb923c'];
  for (let i = 0; i < 28; i++) {
    const s = document.createElement('span');
    s.style.cssText = `background:${colors[i%colors.length]};left:${Math.random()*90+5}%;top:${Math.random()*50}%;`;
    s.style.setProperty('--dx', (Math.random()*340-170)+'px');
    s.style.setProperty('--dy', (Math.random()*220+60)+'px');
    s.style.animationDelay = (Math.random()*0.4)+'s';
    c.appendChild(s);
  }
}

function openTripPopup() {
  if (!revealData) return;
  const d = revealData;
  const dest      = translateDest(d.destination) || d.destination || '—';
  const fromCity  = airportCityFull(d.departureAirport);
  const nights    = d.numberOfNights;
  const travelers = d.numberOfTravelers || 1;
  const addons    = Array.isArray(d.addons) ? d.addons : [];

  document.getElementById('tpRef').textContent       = d.bookingRef || '—';
  document.getElementById('tpFrom').textContent      = fromCity;
  document.getElementById('tpDest').textContent      = dest;
  document.getElementById('tpDepDate').textContent   = fmtDateLong(d.departureDate);
  document.getElementById('tpRetDate').textContent   = 'povratak · ' + fmtDateLong(d.returnDate);
  document.getElementById('tpTravelers').textContent = travelers + (travelers === 1 ? ' osoba' : travelers < 5 ? ' osobe' : ' osoba');
  document.getElementById('tpNights').textContent    = nights + (nights === 1 ? ' noć' : nights < 5 ? ' noći' : ' noći');
  document.getElementById('tpDestCity').textContent  = dest;

  // Airline booking code
  const airlineCodeEl  = document.getElementById('tpAirlineCode');
  const airlineCodeRow = document.getElementById('tpAirlineRow');
  if (d.airlineBookingCode && airlineCodeEl && airlineCodeRow) {
    airlineCodeEl.textContent  = d.airlineBookingCode;
    airlineCodeRow.style.display = 'flex';
  } else if (airlineCodeRow) {
    airlineCodeRow.style.display = 'none';
  }

  const addonsEl = document.getElementById('tpAddons');
  const addonsRow = document.getElementById('tpAddonsRow');
  if (addons.length > 0) {
    addonsEl.innerHTML = addons.join('<br>');
    addonsRow.style.display = 'flex';
  } else {
    addonsRow.style.display = 'none';
  }

  // Putnici
  const paxEl = document.getElementById('tpPassengerList');
  if (paxEl) {
    const paxNames = Array.isArray(d.passengers) && d.passengers.length ? d.passengers : [];
    paxEl.textContent = paxNames.length ? paxNames.join(', ') : '—';
  }

  document.getElementById('tpTotal').textContent = fmtMoney(d.totalPriceAll);

  setupModalConfetti();

  const modal = document.getElementById('tripModal');
  modal.style.display = 'flex';
  requestAnimationFrame(() => requestAnimationFrame(() => modal.classList.add('open')));
  document.body.style.overflow = 'hidden';
}

function closeTripPopup() {
  const modal = document.getElementById('tripModal');
  modal.classList.remove('open');
  setTimeout(() => {
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }, 500);
}

// Close on backdrop click
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('tripModal');
  if (modal) {
    modal.addEventListener('click', e => {
      if (e.target === modal) closeTripPopup();
    });
  }
});

/* ── API fetch ── */
(async function init(){
  const token = new URLSearchParams(location.search).get('token');
  if (!token) { showError(404); return; }
  try {
    const res = await fetch(`${API}/api/reveal?token=${encodeURIComponent(token)}`);
    if (!res.ok) { showError(res.status); return; }
    showEnvelope(await res.json());
  } catch(e) { showError(0); }
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
