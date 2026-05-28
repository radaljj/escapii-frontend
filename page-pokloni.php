<?php
/**
 * Template Name: Pokloni putovanje iznenađenja
 * Dedicated SEO landing page za gift flow.
 * URL: /pokloni-putovanje-iznenadjenja
 */
$theme_uri = get_template_directory_uri();
$site_url  = get_site_url();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokloni putovanje iznenađenja — Escapii</title>
  <meta name="description" content="Pokloni nekome posebnom nezaboravno putovanje iznenađenja. Odaberi vaučer ili rezerviši konkretan termin — destinacija ostaje tajna do 48h pre polaska.">
  <link rel="canonical" href="<?php echo esc_url($site_url); ?>/pokloni-putovanje-iznenadjenja">
  <?php wp_head(); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    * { -webkit-tap-highlight-color: transparent; }
    :focus:not(:focus-visible) { outline: none; }

    :root {
      --navy:    #EFE9E7;
      --navy2:   #FAF7F5;
      --navy3:   #F0EBE8;
      --accent:  #CA8A71;
      --accent2: #B57560;
      --accent3: #D4A08C;
      --cream:   #BFD8DE;
      --white:   #2D5F6B;
      --gray:    #7A9FA8;
      --gray2:   #6B8E96;
      --green:   #22c55e;
      --red:     #ef4444;
      --gold:    #CA8A71;
      --gold2:   #B57560;
      --gold3:   #D4A08C;
    }

    body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
           background: #EFE9E7; color: #4A4442; overflow-x: hidden; }

    /* ══ NAV (identičan front-page.php) ══════════════════════════════════════ */
    .esc-nav {
      position: fixed; top: 0; left: 0; right: 0; z-index: 999;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 64px; height: 72px;
      background: rgba(15,45,53,.92); backdrop-filter: blur(24px);
      border-bottom: 1px solid rgba(255,255,255,.07);
    }
    .esc-logo { display: inline-flex; align-items: center; text-decoration: none; }
    .esc-logo img { height: 48px; width: auto; display: block; }
    @media (max-width: 768px) { .esc-logo img { height: 36px; } }
    .nav-right { display: flex; align-items: center; gap: 20px; }
    .lang-wrap { display: flex; background: rgba(255,255,255,.07); border-radius: 8px; overflow: hidden; }
    .lang-btn { padding: 7px 16px; font-size: 13px; font-weight: 700; cursor: pointer;
                border: none; background: transparent; color: var(--gray);
                letter-spacing: .5px; transition: all .2s; }
    .lang-btn.on { background: var(--gold); color: #ffffff; }
    .nav-status { background: rgba(255,255,255,.07); border: 1.5px solid rgba(255,255,255,.12);
                  color: var(--gray); border-radius: 8px; padding: 8px 14px;
                  font-size: 13px; font-weight: 600; font-family: inherit;
                  cursor: pointer; transition: all .2s;
                  display: flex; align-items: center; gap: 6px; }
    .nav-status:hover { background: rgba(255,255,255,.12); color: #fff; }
    .nav-gift-wrap { position: relative; }
    .nav-gift-btn {
      display: flex; align-items: center; gap: 7px;
      background: rgba(200,149,58,.12); border: 1.5px solid rgba(200,149,58,.28);
      color: #d4a83c; border-radius: 8px; padding: 8px 14px;
      font-size: 13px; font-weight: 700; font-family: inherit;
      cursor: pointer; transition: all .2s; white-space: nowrap;
    }
    .nav-gift-btn:hover, .nav-gift-btn.open { background: rgba(200,149,58,.22); border-color: rgba(200,149,58,.5); }
    .nav-gift-caret { font-size: 10px; transition: transform .2s; display: inline-block; }
    .nav-gift-btn.open .nav-gift-caret { transform: rotate(180deg); }
    .nav-gift-drop {
      position: absolute; top: calc(100%+10px); right: 0;
      background: rgba(15,45,53,.97); backdrop-filter: blur(28px);
      border: 1px solid rgba(255,255,255,.1); border-radius: 12px;
      min-width: 210px; overflow: hidden;
      box-shadow: 0 16px 48px rgba(0,0,0,.45);
      opacity: 0; transform: translateY(-8px); pointer-events: none;
      transition: opacity .2s, transform .2s; z-index: 1001;
    }
    .nav-gift-drop.open { opacity: 1; transform: translateY(0); pointer-events: auto; }
    .nav-gift-item {
      display: flex; align-items: center; gap: 10px;
      width: 100%; text-align: left; padding: 14px 18px;
      font-size: 14px; font-weight: 600; color: rgba(255,255,255,.78);
      background: none; border: none; border-bottom: 1px solid rgba(255,255,255,.07);
      font-family: inherit; cursor: pointer; transition: all .15s;
    }
    .nav-gift-item:last-child { border-bottom: none; }
    .nav-gift-item:hover { background: rgba(255,255,255,.06); color: #fff; }
    .nav-gift-item.primary { color: #d4a83c; }
    .nav-gift-item.primary:hover { background: rgba(200,149,58,.1); }
    .nav-gift-item-icon { font-size: 16px; flex-shrink: 0; }
    .nav-gift-item-text { display: flex; flex-direction: column; gap: 1px; }
    .nav-gift-item-label { font-size: 13px; font-weight: 700; line-height: 1.2; }
    .nav-gift-item-sub { font-size: 11px; font-weight: 400; color: rgba(255,255,255,.4); }
    .nav-gift-item.primary .nav-gift-item-sub { color: rgba(212,168,60,.55); }
    .nav-burger { display:none; flex-direction:column; justify-content:center; gap:5px;
                  width:40px; height:40px; background:none; border:none; cursor:pointer; padding:8px; }
    .nav-burger span { display:block; height:2px; background:white; border-radius:2px;
                       transition: transform .3s, opacity .3s, width .3s; width:100%; }
    .nav-burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .nav-burger.open span:nth-child(2) { opacity:0; width:0; }
    .nav-burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
    .mob-menu {
      display:none; position:fixed; top:72px; left:0; right:0; z-index:997;
      background:rgba(15,45,53,.97); backdrop-filter:blur(28px);
      border-bottom:1px solid rgba(255,255,255,.07);
      flex-direction:column; padding:16px 24px 24px;
      transform:translateY(-8px); opacity:0;
      transition: transform .25s ease, opacity .25s ease;
      pointer-events: none;
    }
    .mob-menu.open { transform:translateY(0); opacity:1; pointer-events: auto; }
    .mob-menu-links { display:flex; flex-direction:column; gap:2px; margin-bottom:20px; }
    .mob-menu-link { padding:13px 4px; font-size:15px; font-weight:700; color:rgba(255,255,255,.7);
                     background:none; border:none; text-align:left; cursor:pointer;
                     border-bottom:1px solid rgba(255,255,255,.06); transition:color .15s; }
    .mob-menu-link:last-child { border-bottom:none; }
    .mob-menu-link:hover { color:white; }
    .mob-menu-bottom { display:flex; align-items:center; justify-content:space-between; gap:12px; padding-top:4px; }
    .mob-menu-book { flex:1; background:var(--gold); color:#ffffff; border:none;
                     padding:13px; border-radius:10px; font-size:14px; font-weight:800; cursor:pointer; }
    .mob-gift-wrap { border-bottom: 1px solid rgba(255,255,255,.06); }
    .mob-gift-toggle {
      width: 100%; display: flex; align-items: center; justify-content: space-between;
      padding: 13px 4px; font-size: 15px; font-weight: 700; color: #d4a83c;
      background: none; border: none; text-align: left; cursor: pointer; font-family: inherit;
    }
    .mob-gift-caret { font-size: 11px; transition: transform .22s; }
    .mob-gift-toggle.open .mob-gift-caret { transform: rotate(180deg); }
    .mob-gift-sub { display:flex; flex-direction:column; padding:0 0 4px 16px; max-height:0; overflow:hidden; transition:max-height .25s; }
    .mob-gift-sub.open { max-height:120px; }
    .mob-gift-sub-btn { padding:10px 4px; font-size:14px; font-weight:600; color:rgba(255,255,255,.65);
                        background:none; border:none; border-bottom:1px solid rgba(255,255,255,.05);
                        text-align:left; cursor:pointer; font-family:inherit; transition:color .15s; }
    .mob-gift-sub-btn:last-child { border-bottom:none; }
    .mob-gift-sub-btn:hover { color:#fff; }
    @media (max-width:768px) {
      .nav-right { display:none; }
      .nav-burger { display:flex; }
      .mob-menu { display:flex; }
      .esc-nav { padding: 0 20px; }
    }

    /* ══ HERO ════════════════════════════════════════════════════════════════ */
    .gift-hero {
      min-height: 60vh; display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      text-align: center; padding: 130px 24px 80px;
      background: linear-gradient(135deg, #0a1e26 0%, #0f2d35 60%, #162e38 100%);
      position: relative; overflow: hidden;
    }
    .gift-hero::before {
      content: ''; position: absolute; inset: 0;
      background: radial-gradient(ellipse 80% 60% at 50% 40%, rgba(202,138,113,.08) 0%, transparent 70%);
      pointer-events: none;
    }
    .gift-hero > * { position: relative; z-index: 1; }
    .gift-eyebrow {
      display: inline-flex; align-items: center; gap: 10px;
      background: rgba(202,138,113,.1); border: 1px solid rgba(202,138,113,.3);
      color: var(--gold); padding: 9px 22px; border-radius: 100px;
      font-size: 12px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase;
      margin-bottom: 28px;
    }
    .gift-h1 {
      font-size: clamp(36px, 5.5vw, 72px); font-weight: 900; color: #ffffff;
      line-height: 1.05; letter-spacing: -2px; margin-bottom: 20px; max-width: 780px;
    }
    .gift-h1 em { color: var(--gold); font-style: normal; }
    .gift-hero-sub {
      font-size: clamp(15px, 1.8vw, 19px); color: rgba(255,255,255,.68);
      max-width: 520px; line-height: 1.65; margin-bottom: 48px;
    }
    .gift-hero-cards {
      display: flex; gap: 16px; flex-wrap: wrap; justify-content: center;
    }
    .gift-hero-card {
      background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1);
      border-radius: 16px; padding: 24px 28px; cursor: pointer;
      transition: all .25s; text-align: left; min-width: 220px; max-width: 260px;
      display: flex; flex-direction: column; gap: 8px;
      font-family: inherit;
    }
    .gift-hero-card:hover { background: rgba(255,255,255,.09); border-color: rgba(255,255,255,.2); transform: translateY(-3px); }
    .gift-hero-card.gold { border-color: rgba(202,138,113,.4); background: rgba(202,138,113,.07); }
    .gift-hero-card.gold:hover { background: rgba(202,138,113,.13); border-color: rgba(202,138,113,.65); }
    .gift-hc-icon { font-size: 28px; margin-bottom: 4px; }
    .gift-hc-title { font-size: 16px; font-weight: 800; color: #ffffff; }
    .gift-hc-sub { font-size: 13px; color: rgba(255,255,255,.5); line-height: 1.4; }
    .gift-hc-arrow { font-size: 12px; color: var(--gold); font-weight: 700; margin-top: 4px; }
    @media (max-width: 520px) {
      .gift-hero-cards { flex-direction: column; align-items: stretch; width: 100%; max-width: 340px; }
      .gift-hero-card { max-width: 100%; }
    }

    /* ══ SECTIONS WRAPPER ════════════════════════════════════════════════════ */
    .gift-sections { padding: 0 0 80px; }

    /* ══ SECTION HEADER ══════════════════════════════════════════════════════ */
    .gift-sec-wrap { max-width: 760px; margin: 0 auto; padding: 72px 24px 0; }
    .gift-sec-tag {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(202,138,113,.1); border: 1px solid rgba(202,138,113,.25);
      color: var(--accent); padding: 6px 16px; border-radius: 100px;
      font-size: 11px; font-weight: 800; letter-spacing: 1.2px; text-transform: uppercase;
      margin-bottom: 16px;
    }
    .gift-sec-h { font-size: clamp(24px, 3.5vw, 36px); font-weight: 900; color: var(--white);
                  letter-spacing: -1px; margin-bottom: 10px; }
    .gift-sec-desc { font-size: 15px; color: var(--gray); line-height: 1.65; margin-bottom: 36px; }
    .gift-divider { height: 1px; background: rgba(45,95,107,.1); margin: 72px 24px 0; max-width: 760px; margin-left: auto; margin-right: auto; }

    /* ══ VOUCHER FORM ════════════════════════════════════════════════════════ */
    .voucher-card {
      background: #ffffff; border: 1px solid rgba(45,95,107,.08);
      border-radius: 20px; padding: 32px 36px;
      box-shadow: 0 8px 40px rgba(0,0,0,.06);
    }
    @media (max-width: 600px) { .voucher-card { padding: 24px 20px; } }

    /* Iznos picker */
    .amount-label { font-size: 12px; font-weight: 800; color: var(--white);
                    letter-spacing: .8px; text-transform: uppercase; margin-bottom: 12px; }
    .amount-grid {
      display: grid; grid-template-columns: repeat(5, 1fr); gap: 8px; margin-bottom: 12px;
    }
    @media (max-width: 520px) { .amount-grid { grid-template-columns: repeat(3, 1fr); } }
    .amount-btn {
      padding: 12px 8px; border-radius: 10px; border: 1.5px solid rgba(45,95,107,.15);
      background: #fff; color: var(--white); font-size: 14px; font-weight: 700;
      cursor: pointer; font-family: inherit; transition: all .18s; text-align: center;
    }
    .amount-btn:hover { border-color: var(--accent); color: var(--accent); background: rgba(202,138,113,.04); }
    .amount-btn.on { border-color: var(--accent); background: rgba(202,138,113,.1); color: var(--accent2); }
    .amount-custom-wrap { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
    .amount-custom-input {
      flex: 1; padding: 11px 14px; border-radius: 10px;
      border: 1.5px solid rgba(45,95,107,.15);
      font-size: 14px; font-family: inherit; color: var(--white);
      background: #faf8f6; outline: none; transition: border-color .18s;
    }
    .amount-custom-input:focus { border-color: var(--accent); }
    .amount-hint {
      font-size: 12px; color: var(--gray); margin-bottom: 24px;
      display: flex; align-items: center; gap: 6px;
    }
    .amount-hint strong { color: var(--accent2); }

    /* Form fields */
    .gift-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media (max-width: 560px) { .gift-form-grid { grid-template-columns: 1fr; } }
    .gf-field { display: flex; flex-direction: column; gap: 6px; }
    .gf-field.full { grid-column: 1 / -1; }
    .gf-label { font-size: 12px; font-weight: 700; color: var(--white);
                letter-spacing: .4px; text-transform: uppercase; }
    .gf-input, .gf-textarea {
      padding: 12px 14px; border-radius: 10px;
      border: 1.5px solid rgba(45,95,107,.15);
      font-size: 14px; font-family: inherit; color: #3a3230;
      background: #faf8f6; outline: none; transition: border-color .18s;
    }
    .gf-input:focus, .gf-textarea:focus { border-color: var(--accent); }
    .gf-textarea { resize: vertical; min-height: 80px; }
    .gf-input::placeholder, .gf-textarea::placeholder { color: #b4aeac; }

    /* Submit button */
    .gift-submit-btn {
      width: 100%; margin-top: 20px;
      padding: 16px 24px; border-radius: 12px;
      background: var(--accent); border: none; color: #ffffff;
      font-size: 15px; font-weight: 800; font-family: inherit;
      cursor: pointer; transition: all .2s; letter-spacing: .3px;
    }
    .gift-submit-btn:hover { background: var(--accent2); transform: translateY(-1px); box-shadow: 0 8px 24px rgba(202,138,113,.35); }
    .gift-submit-btn:disabled { opacity: .6; cursor: not-allowed; transform: none; }
    .gift-form-err { font-size: 13px; color: var(--red); margin-top: 8px; min-height: 18px; }

    /* ══ FOOTER (identičan front-page.php) ══════════════════════════════════ */
    .esc-footer { background: #EFE9E7; padding: 64px 64px 28px; border-top: 1px solid rgba(15,45,53,.07); }
    .footer-main { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 56px; }
    .footer-brand p { font-size: 14px; color: var(--gray); line-height: 1.75; margin-top: 16px; max-width: 280px; }
    .footer-col h4 { font-size: 11px; font-weight: 800; color: var(--white);
                     letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 18px; }
    .footer-col a { display: block; font-size: 14px; color: var(--gray); text-decoration: none;
                    margin-bottom: 10px; transition: color .2s; }
    .footer-col a:hover { color: var(--accent); }
    .footer-social { margin-top: 28px; }
    .footer-social h4 { font-size: 11px; font-weight: 800; color: var(--white);
                        letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 16px; }
    .social-icons { display: flex; gap: 12px; }
    .social-icon { width: 40px; height: 40px; border-radius: 10px;
                   background: rgba(15,45,53,.07); border: 1px solid rgba(15,45,53,.12);
                   color: var(--gray); display: flex; align-items: center; justify-content: center;
                   text-decoration: none; transition: all .2s; }
    .social-icon:hover { background: var(--accent); border-color: var(--accent); color: #ffffff; }
    .social-icon svg { width: 18px; height: 18px; fill: currentColor; }
    .footer-divider { height: 1px; background: rgba(15,45,53,.08); margin-bottom: 24px; }
    .footer-bottom { display: flex; justify-content: space-between; align-items: center;
                     font-size: 13px; color: var(--gray2); flex-wrap: wrap; gap: 12px; }
    .footer-bottom-links { display: flex; gap: 24px; }
    .footer-bottom-links a { color: var(--gray2); text-decoration: none; font-size: 13px; transition: color .2s; }
    .footer-bottom-links a:hover { color: var(--gray); }
    @media (max-width: 768px) {
      .footer-main { grid-template-columns: 1fr 1fr; gap: 32px; }
      .esc-footer { padding: 48px 24px 24px; }
      .footer-bottom { flex-direction: column; text-align: center; }
      .footer-bottom-links { flex-wrap: wrap; justify-content: center; gap: 16px; }
    }

    /* ══ ANIMATIONS ═════════════════════════════════════════════════════════ */
    @keyframes fadeUp   { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:none; } }
    @keyframes fadeDown { from { opacity:0; transform:translateY(-12px); } to { opacity:1; transform:none; } }
    .gift-eyebrow  { animation: fadeDown .7s ease both; }
    .gift-h1       { animation: fadeUp .8s .1s ease both; }
    .gift-hero-sub { animation: fadeUp .8s .2s ease both; }
    .gift-hero-cards { animation: fadeUp .8s .3s ease both; }

    /* ══ VALIDATE MODAL ══════════════════════════════════════════════════════ */
    .validate-hint { font-size: 13px; color: var(--gray); margin-top: 24px; text-align: center; }
    .validate-hint a { color: var(--accent); font-weight: 700; text-decoration: none; cursor: pointer; }

  </style>
</head>
<body>

<!-- NAV -->
<nav class="esc-nav" id="mainNav">
  <a href="<?php echo esc_url($site_url); ?>/" class="esc-logo">
    <img src="<?php echo $theme_uri; ?>/images/logo-white.svg" alt="Escapii">
  </a>
  <div class="nav-right">
    <div class="lang-wrap">
      <button class="lang-btn on" onclick="setLang('sr')">SR</button>
      <button class="lang-btn"    onclick="setLang('en')">EN</button>
    </div>
    <button class="nav-status" onclick="goHome()" title="Rezerviši putovanje">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span data-i18n="nav.home">Početna</span>
    </button>
    <button class="nav-gift-btn" onclick="scrollToVoucher()" type="button">
      🎟️ <span data-i18n="nav.gift.voucher">Poklon vaučer</span>
    </button>
  </div>
  <button class="nav-burger" id="navBurger" onclick="togBurger()" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- MOBILE MENU -->
<div class="mob-menu" id="mobMenu">
  <div class="mob-menu-links">
    <button class="mob-menu-link" onclick="closeMobMenu();goHome();" data-i18n="nav.home">🏠 Početna</button>
    <button class="mob-menu-link" onclick="closeMobMenu();scrollToVoucher();">🎟️ <span data-i18n="nav.gift.voucher">Poklon vaučer</span></button>
  </div>
  <div class="mob-menu-bottom">
    <div class="lang-wrap">
      <button class="lang-btn on" onclick="setLang('sr')">SR</button>
      <button class="lang-btn"    onclick="setLang('en')">EN</button>
    </div>
    <button class="mob-menu-book" onclick="closeMobMenu();goHome();" data-i18n="nav.home">Nazad na sajt</button>
  </div>
</div>

<!-- HERO -->
<section class="gift-hero" id="gift-top">
  <div class="gift-eyebrow" data-i18n="gift.hero.badge">🎁 Poklon koji se pamti</div>
  <h1 class="gift-h1" data-i18n-html="gift.hero.h1">Pokloni nekome <em>iznenađenje</em></h1>
  <p class="gift-hero-sub" data-i18n="gift.hero.sub">Odaberi iznos vaučera — primalac ga koristi za bilo koje Escapii putovanje po izboru.</p>
  <button class="gift-submit-btn" onclick="scrollToVoucher()" type="button" style="max-width:320px;margin-top:0;" data-i18n="gift.hero.cta">🎟️ Pokloni vaučer →</button>
</section>

<!-- ═══ VAUČER SEKCIJA ═══════════════════════════════════════════════════════ -->
<div class="gift-sections" id="section-voucher">
  <div class="gift-sec-wrap">
    <div class="gift-sec-tag">🎟️ <span data-i18n="gift.sec.voucher.tag">Poklon vaučer</span></div>
    <h2 class="gift-sec-h" data-i18n="gift.sec.voucher.h">Odaberi iznos, primalac bira termin</h2>
    <p class="gift-sec-desc" data-i18n="gift.sec.voucher.desc">Kupac plaća vaučer unapred — primalac dobija personalizovani kod kojim umanjuje cenu rezervacije bilo kog Escapii putovanja.</p>

    <div class="voucher-card">
      <!-- Iznos -->
      <div class="amount-label" data-i18n="gift.amount.label">Iznos vaučera (EUR)</div>
      <div class="amount-grid">
        <button class="amount-btn" onclick="selectAmount(50)"  type="button">50€</button>
        <button class="amount-btn" onclick="selectAmount(100)" type="button">100€</button>
        <button class="amount-btn" onclick="selectAmount(200)" type="button">200€</button>
        <button class="amount-btn" onclick="selectAmount(300)" type="button">300€</button>
        <button class="amount-btn" onclick="selectAmount(400)" type="button">400€</button>
      </div>
      <div class="amount-custom-wrap">
        <input class="amount-custom-input" id="vCustomAmount" type="number" min="50" step="10"
               placeholder="ili unesi iznos po izboru (min. 50€)"
               oninput="onCustomAmount(this.value)">
      </div>
      <div class="amount-hint">
        <span>✈️</span>
        <span data-i18n-html="gift.amount.hint">Naša putovanja počinju od <strong>279€ po osobi</strong> — vaučer umanjuje tu cenu.</span>
      </div>

      <!-- Podaci -->
      <div class="gift-form-grid">
        <div class="gf-field">
          <label class="gf-label" data-i18n="gift.buyer.email.label">Tvoj email</label>
          <input class="gf-input" id="vBuyerEmail" type="email" autocomplete="email"
                 data-i18n-ph="gift.buyer.email.ph" placeholder="tvoj@email.com">
        </div>
        <div class="gf-field">
          <label class="gf-label" data-i18n="gift.buyer.name.label">Ime i prezime (piše se na vaučeru)</label>
          <input class="gf-input" id="vBuyerName" type="text" autocomplete="given-name"
                 data-i18n-ph="gift.buyer.name.ph" placeholder="Marko Marković">
        </div>
        <div class="gf-field full">
          <label class="gf-label" data-i18n="gift.msg.label">Lična poruka (opciono)</label>
          <textarea class="gf-textarea" id="vMessage" rows="3"
                    data-i18n-ph="gift.msg.ph" placeholder="Ovo putovanje je posebno za tebe..."></textarea>
        </div>
      </div>

      <div class="gift-form-err" id="vErr"></div>
      <button class="gift-submit-btn" id="vSubmitBtn" onclick="submitVoucher()" type="button" data-i18n="gift.voucher.submit">
        🎟️ Pošalji upit za vaučer →
      </button>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer class="esc-footer">
  <div class="footer-main">
    <div class="footer-brand">
      <a href="<?php echo esc_url($site_url); ?>/" class="esc-logo">
        <img src="<?php echo $theme_uri; ?>/images/logo-black.svg" alt="Escapii">
      </a>
      <p data-i18n="footer.desc">Iznenađujuća putovanja za ljude koji su spremni da puste kontrolu i probaju nešto drugačije.</p>
      <div class="footer-social">
        <h4 data-i18n="footer.social">Pratite nas</h4>
        <div class="social-icons">
          <a href="https://www.instagram.com/escapii.rs?igsh=NmMwY3djcHFncjg2&utm_source=qr" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram">
            <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="#" class="social-icon" aria-label="TikTok">
            <svg viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.77a4.85 4.85 0 01-1.01-.08z"/></svg>
          </a>
          <a href="#" class="social-icon" aria-label="Facebook">
            <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
        </div>
      </div>
    </div>
    <div class="footer-col">
      <h4 data-i18n="footer.nav">Navigacija</h4>
      <a href="<?php echo esc_url($site_url); ?>/" data-i18n="footer.home">Početna</a>
      <a href="<?php echo esc_url($site_url); ?>/#esc-how" data-i18n="footer.how">Kako funkcioniše</a>
      <a href="<?php echo esc_url($site_url); ?>/#esc-about" data-i18n="footer.about">O nama</a>
      <a href="<?php echo esc_url($site_url); ?>/#esc-booking" data-i18n="footer.book">Rezervacija</a>
      <a href="<?php echo esc_url($site_url); ?>/pokloni-putovanje-iznenadjenja" style="color:var(--accent);font-weight:600;">🎁 Pokloni putovanje iznenađenja</a>
    </div>
    <div class="footer-col">
      <h4 data-i18n="footer.departure">Polasci</h4>
      <a href="<?php echo esc_url($site_url); ?>/#esc-booking">✈ Beograd (BEG)</a>
      <a href="<?php echo esc_url($site_url); ?>/#esc-booking">✈ Niš (INI)</a>
    </div>
    <div class="footer-col">
      <h4 data-i18n="footer.contact">Kontakt</h4>
      <a href="mailto:escapii.team@gmail.com">✉ escapii.team@gmail.com</a>
    </div>
  </div>
  <div class="footer-divider"></div>
  <div class="footer-bottom">
    <span>© 2026 Escapii — <span data-i18n="footer.rights">Sva prava zadržana</span></span>
    <div class="footer-bottom-links">
      <a href="/uslovi-koriscenja" data-i18n="footer.terms">Uslovi korišćenja</a>
      <a href="/politika-privatnosti" data-i18n="footer.privacy">Politika privatnosti</a>
    </div>
  </div>
</footer>

<script>
const API_BASE = '<?php echo esc_js(escapii_api_url()); ?>';

// ── Prevodi ──────────────────────────────────────────────────────────────────
const TR = {
  sr: {
    'nav.home':              'Početna',
    'nav.gift.voucher':      'Poklon vaučer',
    'gift.hero.badge':       '🎁 Poklon koji se pamti',
    'gift.hero.h1':          'Pokloni nekome <em>iznenađenje</em>',
    'gift.hero.sub':         'Odaberi iznos vaučera — primalac ga koristi za bilo koje Escapii putovanje po izboru.',
    'gift.hero.cta':         '🎟️ Pokloni vaučer →',
    'gift.sec.voucher.tag':  'Poklon vaučer',
    'gift.sec.voucher.h':    'Odaberi iznos, primalac bira termin',
    'gift.sec.voucher.desc': 'Kupac plaća vaučer unapred — primalac dobija personalizovani kod kojim umanjuje cenu rezervacije bilo kog Escapii putovanja.',
    'gift.amount.label':     'Iznos vaučera (EUR)',
    'gift.amount.hint':      'Naša putovanja počinju od <strong>279€ po osobi</strong> — vaučer umanjuje tu cenu.',
    'gift.buyer.email.label':'Tvoj email (kupac)',
    'gift.buyer.email.ph':   'tvoj@email.com',
    'gift.buyer.name.label': 'Ime i prezime (piše se na vaučeru)',
    'gift.buyer.name.ph':    'Marko Marković',
    'gift.msg.label':        'Lična poruka (opciono)',
    'gift.msg.ph':           'Ovo putovanje je posebno za tebe...',
    'gift.voucher.submit':   '🎟️ Pošalji upit za vaučer →',
    'footer.home':           'Početna',
    'footer.how':            'Kako funkcioniše',
    'footer.about':          'O nama',
    'footer.book':           'Rezervacija',
    'footer.desc':           'Iznenađujuća putovanja za ljude koji su spremni da puste kontrolu i probaju nešto drugačije.',
    'footer.nav':            'Navigacija',
    'footer.departure':      'Polasci',
    'footer.contact':        'Kontakt',
    'footer.social':         'Pratite nas',
    'footer.terms':          'Uslovi korišćenja',
    'footer.privacy':        'Politika privatnosti',
    'footer.rights':         'Sva prava zadržana',
  },
  en: {
    'nav.home':              'Home',
    'nav.gift.voucher':      'Gift voucher',
    'gift.hero.badge':       '🎁 A gift they\'ll remember',
    'gift.hero.h1':          'Gift someone a <em>surprise</em>',
    'gift.hero.sub':         'Choose a voucher amount — recipient uses it on any Escapii trip of their choice.',
    'gift.hero.cta':         '🎟️ Gift a voucher →',
    'gift.sec.voucher.tag':  'Gift voucher',
    'gift.sec.voucher.h':    'Choose an amount, recipient picks a date',
    'gift.sec.voucher.desc': 'Buyer pays upfront — recipient receives a personalised code that discounts their reservation on any Escapii trip.',
    'gift.amount.label':     'Voucher amount (EUR)',
    'gift.amount.hint':      'Our trips start from <strong>€279 per person</strong> — the voucher reduces that price.',
    'gift.buyer.email.label':'Your email (buyer)',
    'gift.buyer.email.ph':   'your@email.com',
    'gift.buyer.name.label': 'Full name (printed on voucher)',
    'gift.buyer.name.ph':    'Marko Markovic',
    'gift.msg.label':        'Personal message (optional)',
    'gift.msg.ph':           'This trip is something special for you...',
    'gift.voucher.submit':   '🎟️ Send voucher inquiry →',
    'footer.home':           'Home',
    'footer.how':            'How it works',
    'footer.about':          'About us',
    'footer.book':           'Book',
    'footer.desc':           'Surprise Trips for people who are ready to let go of control and try something different.',
    'footer.nav':            'Navigation',
    'footer.departure':      'Departures',
    'footer.contact':        'Contact',
    'footer.social':         'Follow us',
    'footer.terms':          'Terms of use',
    'footer.privacy':        'Privacy policy',
    'footer.rights':         'All rights reserved',
  }
};

let lang = localStorage.getItem('esc-lang') || 'sr';
function t(k) { return TR[lang][k] || k; }

function setLang(l) {
  lang = l;
  localStorage.setItem('esc-lang', l);
  document.querySelectorAll('.lang-btn').forEach(b => b.classList.toggle('on', b.textContent === l.toUpperCase()));
  document.querySelectorAll('[data-i18n]').forEach(el => { el.textContent = t(el.dataset.i18n); });
  document.querySelectorAll('[data-i18n-html]').forEach(el => { el.innerHTML = t(el.dataset.i18nHtml); });
  document.querySelectorAll('[data-i18n-ph]').forEach(el => { el.placeholder = t(el.dataset.i18nPh); });
}

// ── Nav helpers ──────────────────────────────────────────────────────────────
function goHome() { window.location.href = '<?php echo esc_js($site_url); ?>/'; }

function togBurger() {
  document.getElementById('navBurger').classList.toggle('open');
  document.getElementById('mobMenu').classList.toggle('open');
}
function closeMobMenu() {
  document.getElementById('navBurger').classList.remove('open');
  document.getElementById('mobMenu').classList.remove('open');
}

function scrollToVoucher() {
  document.getElementById('section-voucher')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// ── Vaučer forma ─────────────────────────────────────────────────────────────
let selectedAmount = null;

function selectAmount(val) {
  selectedAmount = val;
  document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('on'));
  document.querySelectorAll('.amount-btn').forEach(b => {
    if (parseInt(b.textContent) === val) b.classList.add('on');
  });
  document.getElementById('vCustomAmount').value = '';
}

function onCustomAmount(val) {
  selectedAmount = null;
  document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('on'));
  const num = parseFloat(val);
  if (!isNaN(num) && num >= 50) selectedAmount = num;
}

async function submitVoucher() {
  const err  = document.getElementById('vErr');
  const btn  = document.getElementById('vSubmitBtn');
  const isSr = lang === 'sr';
  err.textContent = '';

  const customVal = parseFloat(document.getElementById('vCustomAmount').value);
  const amount = selectedAmount || (!isNaN(customVal) ? customVal : null);

  if (!amount || amount < 50) {
    err.textContent = isSr ? 'Odaberi ili unesi iznos vaučera (min. 50€).' : 'Select or enter a voucher amount (min. €50).';
    return;
  }
  const buyerEmail = document.getElementById('vBuyerEmail').value.trim();
  if (!buyerEmail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(buyerEmail)) {
    err.textContent = isSr ? 'Unesi validan email.' : 'Enter a valid email.';
    return;
  }
  if (!recipEmail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(recipEmail)) {
    err.textContent = isSr ? 'Unesi validan email primaoca.' : 'Enter a valid recipient email.';
    return;
  }

  btn.disabled = true;
  btn.textContent = isSr ? 'Slanje...' : 'Sending...';

  try {
    const res = await fetch(`${API_BASE}/api/gifts/vouchers`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        amount: amount,
        buyerEmail: buyerEmail,
        buyerName: document.getElementById('vBuyerName').value.trim() || null,
        giftMessage: document.getElementById('vMessage').value.trim() || null
      })
    });

    if (!res.ok) {
      const data = await res.json().catch(() => ({}));
      throw new Error(data.error || data.message || res.status);
    }

    Swal.fire({
      title: isSr ? '🎟️ Upit primljen!' : '🎟️ Inquiry received!',
      html: isSr
        ? `Javićemo ti se na <strong>${buyerEmail}</strong> u roku od 24h sa instrukcijama za uplatu.`
        : `We'll contact you at <strong>${buyerEmail}</strong> within 24h with payment instructions.`,
      background: '#0f2d35', color: '#e8e0d5',
      confirmButtonColor: '#CA8A71',
      confirmButtonText: 'OK',
    });

    // Reset forme
    selectedAmount = null;
    document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('on'));
    ['vCustomAmount','vBuyerEmail','vBuyerName','vMessage'].forEach(id => {
      const el = document.getElementById(id);
      if (el) el.value = '';
    });

  } catch (e) {
    const rateLimited = e.message?.includes('429') || e.message?.toLowerCase().includes('previše');
    err.textContent = rateLimited
      ? (isSr ? 'Previše zahteva. Pokušaj ponovo za sat vremena.' : 'Too many requests. Try again in an hour.')
      : (isSr ? 'Greška pri slanju. Pokušaj ponovo.' : 'Error sending. Please try again.');
  } finally {
    btn.disabled = false;
    btn.textContent = t('gift.voucher.submit');
  }
}

// ── Init ─────────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  AOS.init({ duration: 600, once: true, offset: 60 });
  setLang(lang); // uvek primeni jezik (uključujući i placeholder-e)
});
</script>

<?php wp_footer(); ?>
</body>
</html>
