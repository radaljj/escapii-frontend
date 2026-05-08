<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escapii — Iznenadite se</title>
  <meta name="description" content="Surprise putovanja iz Srbije — odaberi aerodrom, datum i budžet. Mi biramo destinaciju. Ti se iznenadis na aerodromu.">

  <?php wp_head(); ?>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Choices.js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
  <!-- Tom Select -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
  <!-- AOS — scroll animations -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <!-- GSAP -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
  <!-- CountUp.js -->
  <script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.umd.js"></script>
  <!-- Animate.css (for Swal) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4/animate.min.css">
  <!-- Tippy.js tooltips -->
  <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
  <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/themes/light.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    /* Remove blue tap highlight on all elements on mobile */
    * { -webkit-tap-highlight-color: transparent; }
    /* Remove focus outline on click (keep visible for keyboard navigation only) */
    :focus:not(:focus-visible) { outline: none; }

    :root {
      /* Sandstone — svetla pozadina */
      --navy:    #EFE9E7;
      --navy2:   #FAF7F5;
      --navy3:   #F0EBE8;
      /* Soft Copper — CTA akcent */
      --accent:  #CA8A71;
      --accent2: #B57560;
      --accent3: #D4A08C;
      /* Light Aegean — sekundarni ton */
      --cream:   #BFD8DE;
      --cream2:  #BFD8DE;
      --cream3:  #A3C4CB;
      /* Neutralno */
      --white:   #2D5F6B;
      --gray:    #7A9FA8;
      --gray2:   #6B8E96;
      --green:   #22c55e;
      --red:     #ef4444;
      /* backward-compat */
      --gold:  var(--accent);
      --gold2: var(--accent2);
      --gold3: var(--accent3);
      --teal:  var(--cream2);
    }

    /* scroll-behavior:smooth removed — conflicts with programmatic scrollTo on mobile */
    body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
           background: #EFE9E7; color: #4A4442; overflow-x: hidden; }

    /* ══════════════════════ NAV */
    .esc-nav {
      position: fixed; top: 0; left: 0; right: 0; z-index: 999;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 64px; height: 72px;
      background: rgba(15,45,53,.92); backdrop-filter: blur(24px);
      border-bottom: 1px solid rgba(255,255,255,.07);
      transition: background .3s;
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
    .nav-status:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.22); color: var(--white); }
    .nav-status svg { flex-shrink: 0; }
    .nav-book { background: var(--gold); color: #ffffff; border: none;
                padding: 11px 28px; border-radius: 8px; font-size: 14px;
                font-weight: 800; cursor: pointer; transition: all .2s; }
    .nav-book:hover { background: var(--gold2); transform: translateY(-1px); }

    /* hamburger */
    .nav-burger { display:none; flex-direction:column; justify-content:center; gap:5px;
                  width:40px; height:40px; background:none; border:none; cursor:pointer; padding:8px; }
    .nav-burger span { display:block; height:2px; background:white; border-radius:2px;
                       transition: transform .3s, opacity .3s, width .3s; width:100%; }
    .nav-burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .nav-burger.open span:nth-child(2) { opacity:0; width:0; }
    .nav-burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* mobile menu */
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

    @media (max-width:768px) {
      .nav-right { display:none; }
      .nav-burger { display:flex; }
      .mob-menu { display:flex; }
    }

    /* ══════════════════════ SECONDARY NAV */
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
    .sec-nav-link {
      white-space: nowrap; flex-shrink: 0;
      padding: 5px 14px; border-radius: 20px;
      font-size: 11px; font-weight: 700; letter-spacing: .8px;
      text-transform: uppercase; color: rgba(255,255,255,.4);
      cursor: pointer; transition: color .2s, background .2s;
      background: none; border: none;
    }
    .sec-nav-link:hover { color: rgba(255,255,255,.85); background: rgba(255,255,255,.06); }
    .sec-nav-link.active { color: #ffffff; background: var(--gold); }
    @media (max-width: 768px) {
      .sec-nav { display: none !important; }
    }

    /* ══════════════════════ HERO */
    .esc-hero {
      min-height: 100vh; display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      text-align: center; padding: 110px 24px 80px;
      position: relative; overflow: hidden;
      background: #0a1e26;
    }
    .hero-video {
      position: absolute; inset: 0; width: 100%; height: 100%;
      object-fit: cover; object-position: center;
      z-index: 0; pointer-events: none;
    }
    .hero-video-overlay {
      position: absolute; inset: 0; z-index: 1; pointer-events: none;
      background: linear-gradient(to bottom, rgba(10,30,38,.5) 0%, rgba(10,30,38,.72) 55%, rgba(10,30,38,.92) 100%);
    }
    .esc-hero > *:not(.hero-video):not(.hero-video-overlay) { position: relative; z-index: 2; }
    .hero-eyebrow {
      display: inline-flex; align-items: center; gap: 10px;
      background: rgba(202,138,113,.1); border: 1px solid rgba(202,138,113,.3);
      color: var(--gold); padding: 9px 22px; border-radius: 100px;
      font-size: 12px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase;
      margin-bottom: 36px; animation: fadeDown .8s ease both;
    }
    .hero-h1 {
      font-size: clamp(40px, 6.5vw, 84px); font-weight: 900;
      color: #ffffff;
      line-height: 1.04; letter-spacing: -2.5px; margin-bottom: 28px;
      max-width: 900px; animation: fadeUp .9s .1s ease both;
    }
    .hero-h1 em { color: var(--gold); font-style: normal; }
    .hero-sub {
      font-size: clamp(16px, 2vw, 21px); color: rgba(255,255,255,0.72);
      max-width: 580px; line-height: 1.65; margin-bottom: 52px;
      animation: fadeUp .9s .2s ease both;
    }
    .hero-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;
                 animation: fadeUp .9s .3s ease both; }
    .btn-gold {
      background: var(--gold); color: #ffffff; border: none;
      padding: 18px 52px; border-radius: 100px; font-size: 16px; font-weight: 800;
      cursor: pointer; transition: all .25s; box-shadow: 0 8px 36px rgba(202,138,113,.4);
      position: relative; overflow: hidden; display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-gold::before {
      content: ''; position: absolute; top: 0; left: -100%;
      width: 60%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.25), transparent);
      transition: left .5s ease; pointer-events: none;
    }
    .btn-gold:hover::before { left: 150%; }
    .btn-gold:hover { transform: translateY(-3px); box-shadow: 0 14px 48px rgba(202,138,113,.6); background: var(--gold3); }
    .btn-gold:active { transform: translateY(0) scale(.97); }
    .btn-ghost {
      background: transparent; color: rgba(255,255,255,0.9);
      border: 2px solid rgba(255,255,255,.35);
      padding: 18px 44px; border-radius: 100px; font-size: 16px; font-weight: 700;
      cursor: pointer; transition: all .25s; position: relative; overflow: hidden;
    }
    .btn-ghost::before {
      content: ''; position: absolute; top: 0; left: -100%;
      width: 60%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.1), transparent);
      transition: left .5s ease;
    }
    .btn-ghost:hover::before { left: 150%; }
    .btn-ghost:hover { border-color: rgba(255,255,255,.5); background: rgba(255,255,255,.06); }
    /* Sparkle particles */
    .spark {
      position: fixed; pointer-events: none; z-index: 9999;
      border-radius: 50%; animation: sparkFly .6s ease-out forwards;
    }
    @keyframes sparkFly {
      0%   { opacity: 1; transform: translate(-50%,-50%) scale(1); }
      100% { opacity: 0; transform: translate(calc(-50% + var(--dx)), calc(-50% + var(--dy))) scale(0); }
    }
    /* Step btn shimmer */
    .btn-next {
      background: var(--gold); color: #ffffff;
      border: none; padding: 14px 36px; border-radius: 12px;
      font-size: 15px; font-weight: 800; cursor: pointer; transition: all .25s;
      margin-left: auto; position: relative; overflow: hidden;
    }
    .btn-next::before {
      content: ''; position: absolute; top: 0; left: -100%;
      width: 60%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.3), transparent);
      transition: left .45s ease;
    }
    .btn-next:hover::before { left: 150%; }
    .btn-next:hover:not(:disabled) { background: var(--gold2); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(202,138,113,.4); }
    .hero-stats { display: flex; gap: 0; margin-top: 72px; animation: fadeUp .9s .4s ease both; }
    .hero-stat {
      padding: 22px 44px; text-align: center;
      border-right: 1px solid rgba(255,255,255,.1);
      background: rgba(255,255,255,.04); backdrop-filter: blur(10px);
    }
    .hero-stat:first-child { border-radius: 16px 0 0 16px; border-left: 1px solid rgba(255,255,255,.1); }
    .hero-stat:last-child { border-radius: 0 16px 16px 0; border-right: 1px solid rgba(255,255,255,.1); }
    .stat-num { font-size: 34px; font-weight: 900; color: var(--gold); line-height: 1; }
    .stat-label { font-size: 12px; color: var(--gray); margin-top: 6px;
                  text-transform: uppercase; letter-spacing: 1px; }

    /* ══════════════════════ MANIFESTO */
    .esc-manifesto {
      background: var(--navy2);
      padding: 120px 24px;
      text-align: center;
    }
    .mf-inner { max-width: 800px; margin: 0 auto; }
    .mf-tag {
      display: inline-block; font-size: 11px; font-weight: 800; letter-spacing: 2px;
      text-transform: uppercase; color: var(--gold); margin-bottom: 20px;
    }
    .mf-heading {
      font-size: clamp(30px, 4.5vw, 52px); font-weight: 900;
      letter-spacing: -1.5px; line-height: 1.1; margin-bottom: 40px;
      color: var(--white);
    }
    .mf-heading em { color: var(--gold); font-style: normal; }
    .mf-body { font-size: clamp(15px, 1.6vw, 18px); color: var(--gray);
               line-height: 1.85; margin-bottom: 20px; }
    .mf-body strong { color: var(--white); }
    .mf-quote {
      font-size: clamp(18px, 2.2vw, 26px); font-weight: 700; font-style: italic;
      color: var(--white); line-height: 1.5; margin: 48px 0 40px;
      padding: 36px 48px; border-left: 4px solid var(--teal);
      background: rgba(226,201,160,.06); border-radius: 0 16px 16px 0; text-align: left;
    }
    .mf-quote em { color: var(--teal); font-style: normal; }

    /* ══════════════════════ DESTINATIONS CAROUSEL */
    .esc-dest {
      padding: 100px 0 80px;
      background: var(--navy);
      overflow: hidden;
    }
    .dest-header {
      text-align: center; padding: 0 24px; margin-bottom: 64px;
    }
    .sec-tag {
      font-size: 11px; font-weight: 800; letter-spacing: 2px;
      text-transform: uppercase; color: var(--gold); margin-bottom: 16px;
      display: block;
    }
    .sec-heading {
      font-size: clamp(28px, 4vw, 48px); font-weight: 900;
      letter-spacing: -1.5px; color: var(--white); margin-bottom: 16px;
    }
    .sec-sub {
      font-size: 17px; color: var(--gray); max-width: 520px;
      margin: 0 auto; line-height: 1.6;
    }
    .carousel-outer {
      position: relative;
      mask-image: linear-gradient(to right, transparent 0%, black 8%, black 92%, transparent 100%);
      -webkit-mask-image: linear-gradient(to right, transparent 0%, black 8%, black 92%, transparent 100%);
    }
    .carousel-track {
      display: flex; gap: 20px; padding: 16px 0;
      width: max-content;
      animation: carouselScroll 90s linear infinite;
    }
    .carousel-track:hover { animation-play-state: paused; }
    @keyframes carouselScroll {
      from { transform: translateX(0); }
      to   { transform: translateX(-50%); }
    }
    .dest-card-c {
      flex-shrink: 0; width: 190px; height: 300px;
      border-radius: 24px; overflow: hidden; position: relative;
      cursor: pointer; transition: transform .3s;
      box-shadow: 0 8px 32px rgba(0,0,0,.5);
    }
    .dest-card-c:hover { transform: translateY(-8px) scale(1.02); }
    .dest-card-c img {
      width: 100%; height: 100%; object-fit: cover;
      transition: transform .4s;
    }
    .dest-card-c:hover img { transform: scale(1.08); }
    .dest-card-name { font-size: 16px; font-weight: 800; color: white; }
    .dest-card-ctry { font-size: 12px; color: var(--gray); margin-top: 3px; }
    .dest-card-label {
      position: absolute; bottom: 0; left: 0; right: 0;
      padding: 40px 14px 14px;
      background: linear-gradient(to top, rgba(10,20,30,.82) 0%, transparent 100%);
      pointer-events: none;
    }
    .dest-card-label-name {
      font-size: 15px; font-weight: 800; color: #ffffff;
      letter-spacing: .3px; text-shadow: 0 1px 4px rgba(0,0,0,.5);
    }
    .dest-mystery-row {
      text-align: center; margin-top: 48px; padding: 0 24px;
    }
    .mystery-badge {
      display: inline-flex; align-items: center; gap: 10px;
      background: rgba(202,138,113,.1); border: 1px solid rgba(202,138,113,.25);
      color: var(--gold); padding: 12px 28px; border-radius: 100px;
      font-size: 14px; font-weight: 700;
    }

    /* ══════════════════════ FEATURES */
    .esc-features { background: var(--navy2); padding: 100px 24px; }
    .features-inner { max-width: 1100px; margin: 0 auto; }
    .features-header { text-align: center; margin-bottom: 72px; }
    .features-grid {
      display: grid; grid-template-columns: repeat(2, 1fr); gap: 32px;
      align-items: stretch;
    }
    .feat-card {
      background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);
      border-radius: 20px; padding: 36px 32px;
      display: flex; gap: 24px; align-items: flex-start;
      transition: border-color .2s; box-sizing: border-box;
    }
    .feat-card:hover { border-color: rgba(202,138,113,.3); }
    .feat-icon-wrap {
      width: 56px; height: 56px; flex-shrink: 0;
      background: rgba(202,138,113,.12); border-radius: 16px;
      display: flex; align-items: center; justify-content: center;
      font-size: 28px;
    }
    .feat-content h3 { font-size: 18px; font-weight: 800; color: var(--white); margin-bottom: 10px; }
    .feat-content p { font-size: 15px; color: var(--gray); line-height: 1.65; }

    /* ══════════════════════ FOR WHO */
    .esc-who { padding: 100px 24px; background: var(--navy3); }
    .who-inner { max-width: 900px; margin: 0 auto; }
    .who-header { text-align: center; margin-bottom: 64px; }
    .who-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 28px; }
    .who-card {
      background: rgba(0,0,0,.25); border-radius: 20px; padding: 36px 32px;
      border: 1px solid rgba(255,255,255,.08);
    }
    .who-card.yes { border-color: rgba(202,138,113,.25); background: rgba(202,138,113,.04); }
    .who-card.no  { border-color: rgba(239,68,68,.18); background: rgba(239,68,68,.04); }
    .who-card-title {
      font-size: 16px; font-weight: 800; margin-bottom: 20px;
      display: flex; align-items: center; gap: 10px;
    }
    .who-card.yes .who-card-title { color: var(--accent3); }
    .who-card.no  .who-card-title { color: #f87171; }
    .who-item {
      display: flex; align-items: flex-start; gap: 12px;
      font-size: 14px; color: var(--gray); line-height: 1.55; margin-bottom: 12px;
    }
    .who-item:last-child { margin-bottom: 0; }
    .who-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; margin-top: 7px; }
    .yes .who-dot { background: var(--accent3); }
    .no  .who-dot { background: #f87171; }

    /* ══════════════════════ FAQ */
    .esc-faq { padding: 100px 24px; background: var(--navy2); }
    .faq-inner { max-width: 760px; margin: 0 auto; }
    .faq-header { text-align: center; margin-bottom: 56px; }
    .faq-list { display: flex; flex-direction: column; gap: 12px; }
    .faq-item {
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 16px;
      background: rgba(255,255,255,.03);
      overflow: hidden;
      transition: border-color .2s;
    }
    .faq-item.open { border-color: rgba(202,138,113,.35); }
    .faq-q {
      display: flex; align-items: center; justify-content: space-between;
      padding: 22px 28px; cursor: pointer; gap: 16px;
      font-size: 16px; font-weight: 700; color: var(--white);
      user-select: none; transition: color .2s;
    }
    .faq-item.open .faq-q { color: var(--gold); }
    .faq-icon {
      flex-shrink: 0; width: 28px; height: 28px; border-radius: 50%;
      border: 1.5px solid rgba(255,255,255,.2);
      display: flex; align-items: center; justify-content: center;
      font-size: 16px; color: var(--gray); font-weight: 300;
      transition: all .25s; line-height: 1;
    }
    .faq-item.open .faq-icon { background: var(--gold); border-color: var(--gold); color: #ffffff; transform: rotate(45deg); }
    .faq-a {
      max-height: 0; overflow: hidden;
      transition: max-height .35s ease, padding .35s ease;
      font-size: 15px; color: rgba(255,255,255,.65); line-height: 1.75;
      padding: 0 28px;
    }
    .faq-item.open .faq-a { max-height: 300px; padding: 0 28px 24px; }

    /* ══════════════════════ STATS */
    .esc-stats {
      background: var(--navy); padding: 60px 24px;
      border-top: 1px solid rgba(255,255,255,.07);
      border-bottom: 1px solid rgba(255,255,255,.07);
    }
    .stats-row { max-width: 900px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); }
    .stats-item { text-align: center; padding: 20px; border-right: 1px solid rgba(255,255,255,.1); }
    .stats-item:last-child { border-right: none; }
    .stats-num { font-size: 44px; font-weight: 900; color: var(--gold); line-height: 1; }
    .stats-lbl { font-size: 12px; color: var(--gray); text-transform: uppercase;
                 letter-spacing: 1px; margin-top: 8px; }

    /* ══════════════════════ BOOKING */
    .esc-booking { background: var(--navy2); padding: 100px 24px; overflow-anchor: none; }
    .step-wrap { overflow-anchor: none; }
    .booking-inner { max-width: 700px; margin: 0 auto; }
    .booking-header { text-align: center; margin-bottom: 48px; }
    .card {
      background: var(--navy3); border-radius: 24px;
      padding: 40px; border: 1px solid rgba(255,255,255,.08);
    }
    .card h2 { font-size: 24px; font-weight: 800; margin-bottom: 8px; }
    .hint { font-size: 14px; color: var(--gray); margin-bottom: 28px; }
    .steps-nav {
      display: flex; justify-content: center; gap: 8px; margin-bottom: 32px;
      flex-wrap: wrap;
    }
    .sn-item { display: flex; flex-direction: column; align-items: center; gap: 6px;
               opacity: .4; transition: opacity .2s; }
    .sn-item.active { opacity: 1; }
    .sn-item.done  { opacity: .7; }
    .sn-dot {
      width: 30px; height: 30px; border-radius: 50%;
      background: rgba(255,255,255,.1); border: 2px solid rgba(255,255,255,.2);
      display: flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 700; transition: all .2s;
    }
    .sn-item.active .sn-dot { background: var(--gold); border-color: var(--gold); color: var(--navy); }
    .sn-item.done  .sn-dot { background: var(--green); border-color: var(--green); color: white; }
    .sn-label { font-size: 10px; color: var(--gray); }
    .step-wrap { display: none; }
    .step-wrap.on { display: block; }
    .step-btns { display: flex; justify-content: space-between; align-items: center; margin-top: 32px; gap: 12px; }
    .btn-next:disabled { opacity: .4; cursor: not-allowed; }
    .btn-back {
      background: transparent; color: var(--gray);
      border: 1px solid rgba(255,255,255,.15); padding: 14px 28px;
      border-radius: 12px; font-size: 15px; font-weight: 600;
      cursor: pointer; transition: all .2s;
    }
    .btn-back:hover { border-color: rgba(255,255,255,.35); color: var(--white); }
    /* Step 1 */
    .opts { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 8px; }
    .opt-tile {
      border: 2px solid rgba(255,255,255,.1); border-radius: 16px; padding: 28px 20px;
      text-align: center; cursor: pointer; transition: all .2s;
    }
    .opt-tile:hover, .opt-tile.on { border-color: var(--gold); background: rgba(202,138,113,.07); }
    .opt-icon { font-size: 36px; margin-bottom: 10px; }
    .opt-label { font-size: 18px; font-weight: 800; }
    .opt-sub { font-size: 12px; color: var(--gray); margin-top: 4px; }
    /* Step 2 */
    .trav-row { display: flex; justify-content: space-between; align-items: center;
                background: rgba(255,255,255,.05); border-radius: 14px; padding: 20px 24px; }
    .trav-info h3 { font-size: 16px; font-weight: 700; }
    .trav-info p  { font-size: 13px; color: var(--gray); margin-top: 3px; }
    .counter { display: flex; align-items: center; gap: 0; }
    .cb {
      width: 40px; height: 40px; border-radius: 12px; border: 1px solid rgba(255,255,255,.15);
      background: rgba(255,255,255,.07); color: white; font-size: 20px; font-weight: 700;
      cursor: pointer; display: flex; align-items: center; justify-content: center;
      transition: all .2s; line-height: 1;
    }
    .cb:hover:not(:disabled) { background: var(--gold); color: #ffffff; border-color: var(--gold); }
    .cb:disabled { opacity: .3; cursor: not-allowed; }
    .cv { font-size: 24px; font-weight: 900; min-width: 52px; text-align: center; }
    /* Step 3 */
    .dates-list { display: flex; flex-direction: column; gap: 8px; margin-bottom: 8px; }
    @keyframes noDatesFadeIn {
      from { opacity: 0; transform: translateY(14px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .no-dates-wrap {
      display: flex; flex-direction: column; align-items: center;
      padding: 32px 16px; gap: 16px; text-align: center;
      animation: noDatesFadeIn .4s ease;
    }
    .no-dates-icon {
      width: 72px; height: 72px; border-radius: 50%;
      background: rgba(202,138,113,.08); border: 1.5px solid rgba(202,138,113,.18);
      display: flex; align-items: center; justify-content: center;
      font-size: 32px;
      animation: noDatesFloat 3s ease-in-out infinite;
    }
    @keyframes noDatesFloat {
      0%,100% { transform: translateY(0); }
      50%      { transform: translateY(-8px); }
    }
    .no-dates-title { font-size: 16px; font-weight: 700; color: var(--white); }
    .no-dates-sub { font-size: 13px; color: var(--gray); line-height: 1.6; max-width: 280px; }
    .no-dates-waitlist-card {
      width: 100%; max-width: 360px;
      background: rgba(255,255,255,.04);
      border: 1px solid rgba(255,255,255,.1);
      border-radius: 16px; padding: 20px 20px 16px;
    }
    .no-dates-waitlist-label {
      font-size: 11px; font-weight: 700; text-transform: uppercase;
      letter-spacing: .06em; color: var(--gray); margin-bottom: 12px; text-align: left;
    }
    .no-dates-back {
      background: transparent;
      border: 1.5px solid rgba(255,255,255,.12);
      border-radius: 12px; padding: 10px 22px;
      color: var(--gray); font-size: 13px; font-weight: 600;
      font-family: inherit; cursor: pointer;
      transition: all .2s; margin-top: 4px;
    }
    .no-dates-back:hover { border-color: rgba(255,255,255,.3); color: var(--white); }
    .waitlist-form {
      display: flex; gap: 10px; width: 100%; max-width: 340px; margin-top: 6px;
    }
    .waitlist-input {
      flex: 1; background: rgba(255,255,255,.06);
      border: 1.5px solid rgba(255,255,255,.14);
      border-radius: 12px; padding: 12px 16px;
      font-size: 14px; color: var(--white); font-family: inherit;
      outline: none; transition: border-color .2s, background .2s;
      min-width: 0;
    }
    .waitlist-input::placeholder { color: rgba(255,255,255,.3); }
    .waitlist-input:focus {
      border-color: var(--accent);
      background: rgba(202,138,113,.06);
    }
    .waitlist-btn {
      background: var(--accent); color: #fff; border: none;
      border-radius: 12px; padding: 12px 20px;
      font-size: 14px; font-weight: 700; font-family: inherit;
      cursor: pointer; white-space: nowrap;
      transition: background .2s, transform .15s;
      box-shadow: 0 4px 16px rgba(202,138,113,.35);
    }
    .waitlist-btn:hover { background: #B57560; transform: translateY(-1px); }
    .waitlist-btn:active { transform: translateY(0); }
    .waitlist-msg { font-size: 13px; line-height: 1.6; padding: 0 8px; }
    .date-row {
      display: flex; justify-content: space-between; align-items: center;
      background: rgba(255,255,255,.04); border: 1.5px solid rgba(255,255,255,.08);
      border-radius: 16px; padding: 14px 18px; cursor: pointer; transition: all .25s ease; gap: 12px;
    }
    .date-row:hover { border-color: rgba(202,138,113,.4); background: rgba(202,138,113,.05); transform: translateX(3px); }
    .date-row.on { border-color: var(--accent); background: rgba(202,138,113,.08); box-shadow: 0 0 0 3px rgba(202,138,113,.12); }
    /* Date row inner elements */
    .dr-segment { display: flex; align-items: center; gap: 10px; flex: 1; min-width: 0; }
    .dr-date-block { text-align: center; min-width: 38px; flex-shrink: 0; }
    .dr-dayname { font-size: 10px; color: var(--gray); font-weight: 700; text-transform: uppercase; letter-spacing: .4px; margin-bottom: 1px; }
    .dr-daynum { font-size: 20px; font-weight: 900; color: white; line-height: 1; }
    .dr-month { font-size: 11px; color: var(--accent); font-weight: 700; text-transform: uppercase; letter-spacing: .3px; margin-top: 1px; }
    .dr-divider { display: flex; flex-direction: column; align-items: center; gap: 2px; padding: 0 4px; flex-shrink: 0; }
    .dr-plane { font-size: 13px; color: var(--gray2); }
    .dr-line { width: 28px; height: 1px; background: rgba(255,255,255,.12); }
    .dr-meta { margin-left: 4px; }
    .dr-nights { font-size: 12px; color: var(--gray); font-weight: 600; }
    .dr-price-block { text-align: right; flex-shrink: 0; }
    .dr-price { font-size: 22px; font-weight: 900; color: var(--accent); line-height: 1; }
    .dr-per { font-size: 11px; color: var(--gray); margin-top: 2px; }
    .low-stock-badge {
      display: inline-flex; align-items: center; gap: 4px;
      margin-left: 10px; vertical-align: middle;
      background: rgba(239,68,68,.12);
      border: 1px solid rgba(239,68,68,.35);
      color: #fca5a5; font-size: 11px; font-weight: 700;
      padding: 3px 9px; border-radius: 100px;
      letter-spacing: .3px; text-transform: uppercase;
      box-shadow: 0 0 12px rgba(239,68,68,.2);
      animation: pulse-badge 2s ease-in-out infinite;
    }
    .low-stock-badge::before {
      content: ''; width: 6px; height: 6px; border-radius: 50%;
      background: #ef4444;
      animation: blink-dot 1s ease-in-out infinite;
      flex-shrink: 0;
    }
    @keyframes pulse-badge {
      0%, 100% { box-shadow: 0 0 8px rgba(239,68,68,.2); }
      50%       { box-shadow: 0 0 18px rgba(239,68,68,.45); }
    }
    @keyframes blink-dot {
      0%, 100% { opacity: 1; } 50% { opacity: .3; }
    }
    /* Disabled datum */
    .date-row.disabled {
      opacity: .5; cursor: not-allowed;
      border-color: rgba(255,255,255,.05) !important;
      background: transparent !important;
    }
    .date-row.disabled .date-price { color: var(--gray); }
    /* Month accordion */
    .month-group { margin-bottom: 10px; border-radius: 18px; overflow: hidden; border: 1px solid rgba(255,255,255,.08); }
    .month-header {
      display: flex; align-items: center; justify-content: space-between;
      padding: 16px 20px; cursor: pointer; user-select: none;
      background: rgba(255,255,255,.04); transition: all .2s;
    }
    .month-header:hover { background: rgba(255,255,255,.065); }
    .month-header.open { background: rgba(202,138,113,.09); border-bottom: 1px solid rgba(202,138,113,.18); }
    .month-name { font-size: 15px; font-weight: 800; color: var(--white); letter-spacing: .2px; }
    .month-meta { font-size: 12px; color: var(--gray); margin-top: 3px; }
    .month-chevron { width: 28px; height: 28px; border-radius: 8px; background: rgba(255,255,255,.07);
                     display: flex; align-items: center; justify-content: center;
                     font-size: 14px; color: var(--gray); transition: all .25s;
                     flex-shrink: 0; align-self: center; }
    .month-header.open .month-chevron { transform: rotate(180deg); background: rgba(202,138,113,.2); color: var(--accent); }
    .month-body { display: none; padding: 10px; background: rgba(0,0,0,.18); }
    .month-body.open { display: block; animation: slideDown .2s ease; }
    @keyframes slideDown { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }
    .date-row { margin-bottom: 4px; }
    .date-row:last-child { margin-bottom: 0; }
    .sold-out-badge {
      display: inline-flex; align-items: center; gap: 4px;
      margin-left: 10px; vertical-align: middle;
      background: rgba(100,116,139,.15);
      border: 1px solid rgba(100,116,139,.3);
      color: #7A9FA8; font-size: 11px; font-weight: 700;
      padding: 3px 9px; border-radius: 100px;
      letter-spacing: .3px; text-transform: uppercase;
    }
    /* Tippy custom theme */
    .tippy-box[data-theme~='escapii'] {
      background: #2D5F6B;
      border: 1px solid rgba(202,138,113,.35);
      color: rgba(255,255,255,.9);
      font-size: 13px; font-weight: 500;
      border-radius: 10px;
      box-shadow: 0 8px 32px rgba(0,0,0,.6);
      max-width: 260px;
    }
    .tippy-box[data-theme~='escapii'] .tippy-arrow { color: #2D5F6B; }
    .tippy-box[data-theme~='escapii'] .tippy-content { padding: 10px 14px; line-height: 1.5; }
    /* Step 4 */
    .accom-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 16px; }
    .accom-tile {
      border: 2px solid rgba(255,255,255,.1); border-radius: 16px; padding: 22px 16px;
      text-align: center; cursor: pointer; transition: all .25s;
      position: relative; overflow: hidden;
    }
    .accom-tile:hover, .accom-tile.on { border-color: var(--gold); background: rgba(202,138,113,.07); }
    .a-icon  { font-size: 32px; margin-bottom: 10px; }
    .a-name  { font-size: 16px; font-weight: 800; margin-bottom: 8px; }
    .a-badge { font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 100px; margin-bottom: 8px; display: inline-block; }
    /* Hover overlay */
    .a-hover {
      position: absolute; left: 0; right: 0; bottom: -100%;
      background: linear-gradient(to top, rgba(15,45,53,.97) 60%, rgba(15,45,53,.82));
      padding: 16px 14px 14px; transition: bottom .28s ease;
      border-top: 2px solid var(--accent); text-align: left;
    }
    .accom-tile:hover .a-hover { bottom: 0; }
    .a-hover-stars { color: #fbbf24; font-size: 20px; letter-spacing: 2px; margin-bottom: 6px; }
    .a-hover-desc { font-size: 12px; color: rgba(255,255,255,.8); line-height: 1.55; }
    /* Single notice */
    .single-notice {
      display: none; background: rgba(202,138,113,.1); border: 1px solid rgba(202,138,113,.3);
      border-radius: 12px; padding: 14px 16px; margin-bottom: 16px;
      font-size: 13px; color: rgba(255,255,255,.85); line-height: 1.6;
    }
    .single-notice strong { color: var(--accent); }
    .a-badge.free { background: rgba(34,197,94,.15); color: var(--green); }
    .a-badge.pay  { background: rgba(202,138,113,.15); color: var(--gold); }
    .a-desc  { font-size: 12px; color: var(--gray); }
    /* Step 5 */
    .suit-row {
      display: flex; align-items: center; gap: 16px;
      background: rgba(255,255,255,.05); border-radius: 14px; padding: 18px 20px; margin-bottom: 14px;
    }
    .extras { display: flex; flex-direction: column; gap: 10px; }
    .extra-row {
      display: flex; align-items: center; gap: 14px;
      background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);
      border-radius: 14px; padding: 16px 18px; cursor: pointer; transition: all .2s;
    }
    .extra-row:hover, .extra-row.on { border-color: var(--gold); background: rgba(202,138,113,.05); }
    .e-chk {
      width: 22px; height: 22px; border-radius: 6px;
      border: 2px solid rgba(255,255,255,.25); flex-shrink: 0;
      display: flex; align-items: center; justify-content: center; font-size: 13px;
    }
    .extra-row.on .e-chk { background: var(--gold); border-color: var(--gold); color: #ffffff; }
    .e-icon { font-size: 22px; flex-shrink: 0; }
    .e-txt { flex: 1; }
    .e-label { font-size: 14px; font-weight: 700; }
    .e-desc  { font-size: 12px; color: var(--gray); margin-top: 2px; }
    .e-price { font-size: 14px; font-weight: 700; color: var(--gold); flex-shrink: 0; }
    /* Airport Cards */
    .airport-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .airport-card {
      position: relative; border-radius: 20px; overflow: hidden;
      aspect-ratio: 4/3; cursor: pointer;
      border: 3px solid transparent; transition: all .35s cubic-bezier(.25,.46,.45,.94);
      box-shadow: 0 8px 32px rgba(0,0,0,.5);
    }
    .airport-card:hover { transform: translateY(-6px) scale(1.02); border-color: rgba(255,255,255,.2); }
    .airport-card.on { border-color: var(--accent); box-shadow: 0 0 0 4px rgba(202,138,113,.25), 0 8px 32px rgba(0,0,0,.5); }
    .airport-card img { width: 100%; height: 100%; object-fit: cover; filter: brightness(.55); transition: all .45s; }
    .airport-card:hover img { filter: brightness(.7); transform: scale(1.06); }
    .airport-card.on img { filter: brightness(.45); }
    .airport-overlay { position: absolute; bottom: 0; left: 0; right: 0; padding: clamp(10px, 3vw, 20px); background: linear-gradient(to top, rgba(15,45,53,.98) 0%, rgba(15,45,53,.4) 60%, transparent 100%); }
    .airport-iata { font-size: clamp(20px, 5vw, 36px); font-weight: 900; color: var(--accent); letter-spacing: clamp(1px, 0.5vw, 3px); line-height: 1; }
    .airport-city { font-size: clamp(13px, 3vw, 18px); font-weight: 800; color: white; margin-top: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .airport-name { font-size: clamp(9px, 1.8vw, 11px); color: rgba(255,255,255,.55); margin-top: 2px; letter-spacing: .5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .airport-check {
      position: absolute; top: 14px; right: 14px;
      width: 34px; height: 34px; border-radius: 50%;
      background: var(--accent); color: #ffffff;
      display: none; align-items: center; justify-content: center;
      font-size: 16px; font-weight: 900;
      box-shadow: 0 4px 12px rgba(202,138,113,.5);
      animation: popIn .3s cubic-bezier(.175,.885,.32,1.275);
    }
    .airport-card.on .airport-check { display: flex; }
    @keyframes popIn { from { transform: scale(0); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    /* Modern Extra Toggle Cards */
    .extras-grid { display: flex; flex-direction: column; gap: 10px; margin-top: 8px; }
    .extra-card {
      display: flex; align-items: center; gap: 16px;
      background: rgba(255,255,255,.04); border: 1.5px solid rgba(255,255,255,.08);
      border-radius: 16px; padding: 16px 18px; cursor: pointer;
      transition: all .25s ease; user-select: none;
    }
    .extra-card:hover { border-color: rgba(202,138,113,.3); background: rgba(202,138,113,.04); transform: translateX(4px); }
    .extra-card.on { border-color: var(--accent); background: rgba(202,138,113,.07); }
    .extra-card-icon {
      width: 46px; height: 46px; border-radius: 14px;
      background: rgba(255,255,255,.06); display: flex;
      align-items: center; justify-content: center;
      font-size: 22px; flex-shrink: 0; transition: background .25s;
    }
    .extra-card.on .extra-card-icon { background: rgba(202,138,113,.18); }
    .extra-card-body { flex: 1; min-width: 0; }
    .extra-card-title { font-size: 14px; font-weight: 700; color: white; }
    .extra-card-sub { font-size: 12px; color: var(--gray); margin-top: 3px; }
    .extra-card-price { font-size: 14px; font-weight: 800; color: var(--accent); flex-shrink: 0; margin-right: 8px; }
    .extra-toggle {
      width: 46px; height: 26px; border-radius: 100px;
      background: rgba(255,255,255,.12); transition: background .25s;
      position: relative; flex-shrink: 0;
    }
    .extra-toggle::after {
      content: ''; position: absolute;
      width: 20px; height: 20px; border-radius: 50%;
      background: white; top: 3px; left: 3px;
      transition: transform .25s cubic-bezier(.25,.46,.45,.94);
      box-shadow: 0 2px 6px rgba(0,0,0,.3);
    }
    .extra-card.on .extra-toggle { background: var(--accent); }
    .extra-card.on .extra-toggle::after { transform: translateX(20px); }

    /* Connecting flights tooltip */
    .connecting-tooltip-wrap { position: relative; }
    .connecting-tooltip {
      position: absolute; bottom: calc(100% + 12px); left: 50%; transform: translateX(-50%) translateY(6px);
      background: linear-gradient(135deg, #2D5F6B 0%, #0D2E38 100%);
      border: 1px solid rgba(202,138,113,.35); border-radius: 14px;
      padding: 14px 16px; width: 270px; pointer-events: none;
      opacity: 0; transition: opacity .22s ease, transform .22s ease;
      z-index: 50; box-shadow: 0 12px 36px rgba(0,0,0,.55);
    }
    .connecting-tooltip-wrap:hover .connecting-tooltip,
    .connecting-tooltip-wrap:focus-within .connecting-tooltip {
      opacity: 1; transform: translateX(-50%) translateY(0);
    }
    .connecting-tooltip::after {
      content: ''; position: absolute; top: 100%; left: 50%; transform: translateX(-50%);
      border: 7px solid transparent; border-top-color: rgba(202,138,113,.35);
    }
    .connecting-tooltip-title {
      font-size: 13px; font-weight: 700; color: var(--accent3); margin-bottom: 6px; line-height: 1.4;
    }
    .connecting-tooltip-body {
      font-size: 12px; color: rgba(255,255,255,.72); line-height: 1.6;
    }
    .connecting-tooltip-body strong { color: rgba(255,255,255,.95); }

    /* Floating price animation */
    .price-float {
      position: absolute; pointer-events: none; z-index: 9999;
      font-size: 18px; font-weight: 900;
      text-shadow: 0 2px 8px rgba(0,0,0,.6);
      animation: floatUp .95s ease-out forwards;
      white-space: nowrap;
    }
    @keyframes floatUp {
      0%   { opacity: 0; transform: translateY(0) scale(.8); }
      15%  { opacity: 1; transform: translateY(-10px) scale(1.1); }
      80%  { opacity: 1; }
      100% { opacity: 0; transform: translateY(-70px) scale(1); }
    }
    /* SweetAlert custom */
    .swal-escapii { border: 1px solid rgba(202,138,113,.25) !important; border-radius: 20px !important; }

    /* Step 6 — image grid */
    .excl-info {
      margin-bottom: 20px;
      border-radius: 14px;
      border: 1px solid rgba(202,138,113,.18);
      overflow: hidden;
    }
    .excl-info-tiers {
      display: flex; gap: 0;
    }
    .excl-tier {
      flex: 1; text-align: center; padding: 12px 8px;
      border-right: 1px solid rgba(255,255,255,.07);
      background: rgba(202,138,113,.05);
      transition: background .2s;
      cursor: default;
    }
    .excl-tier:last-child { border-right: none; }
    .excl-tier:hover { background: rgba(202,138,113,.12); }
    .excl-tier-label {
      font-size: 10px; font-weight: 700; text-transform: uppercase;
      letter-spacing: .8px; color: rgba(255,255,255,.4); margin-bottom: 4px;
    }
    .excl-tier-price {
      font-size: 16px; font-weight: 900;
    }
    .excl-tier-price.free { color: #4ade80; }
    .excl-tier-price.low  { color: var(--accent3); }
    .excl-tier-price.high { color: rgba(202,138,113,.6); }
    .excl-info-note {
      display: flex; align-items: center; gap: 8px;
      padding: 9px 14px;
      background: rgba(255,255,255,.03);
      border-top: 1px solid rgba(255,255,255,.06);
      font-size: 12px; color: rgba(255,255,255,.4); line-height: 1.4;
    }
    .excl-info-note svg { flex-shrink: 0; opacity: .5; }
    .excl-grid {
      display: grid; grid-template-columns: repeat(3, 1fr);
      gap: 12px; margin-bottom: 8px;
    }
    .excl-tile {
      position: relative; border-radius: 16px; overflow: hidden;
      aspect-ratio: 3/4; cursor: pointer;
      border: 3px solid transparent; transition: border-color .2s, transform .2s;
      box-shadow: 0 4px 16px rgba(0,0,0,.5);
    }
    .excl-tile:hover { transform: translateY(-5px); border-color: rgba(255,255,255,.25); }
    .excl-tile.on { border-color: transparent; }
    .excl-tile img {
      width: 100%; height: 100%; object-fit: cover;
      transition: transform .35s, filter .35s; filter: brightness(.82);
    }
    .excl-tile:hover img { transform: scale(1.06); }
    .excl-tile.on img { filter: brightness(.22); }
    /* top accent line on selected */
    .excl-tile::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0;
      height: 3px; background: var(--accent);
      transform: scaleX(0); transform-origin: left;
      transition: transform .3s ease; z-index: 3; border-radius: 0;
    }
    .excl-tile.on::before { transform: scaleX(1); }
    /* center X icon on selected */
    .excl-tile::after {
      content: '✕'; position: absolute;
      top: 50%; left: 50%; transform: translate(-50%, -60%) scale(.6);
      width: 44px; height: 44px; border-radius: 50%;
      background: rgba(255,255,255,.12); backdrop-filter: blur(8px);
      border: 2px solid rgba(255,255,255,.3);
      display: flex; align-items: center; justify-content: center;
      color: white; font-size: 18px; font-weight: 900;
      opacity: 0; transition: all .3s ease; z-index: 3;
    }
    .excl-tile.on::after {
      opacity: 1; transform: translate(-50%, -60%) scale(1);
    }
    .excl-overlay {
      position: absolute; bottom: 0; left: 0; right: 0;
      padding: 28px 12px 12px;
      background: linear-gradient(to top, rgba(15,45,53,.95) 0%, transparent 100%);
      transition: opacity .3s;
    }
    .excl-name {
      font-size: 12px; font-weight: 800; color: white;
      text-align: center; letter-spacing: .8px; text-transform: uppercase;
    }
    .excl-tile.on .excl-overlay { opacity: .4; }
    .excl-x { display: none; } /* handled via ::after pseudo-element */
    /* Step 7 */
    .pax-list { display: flex; flex-direction: column; gap: 14px; margin-bottom: 20px; }
    .pax-item { background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.09); border-radius: 16px; padding: 20px; }
    .pax-num { font-size: 12px; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 14px; }
    .pax-fields { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .pax-fields.full { grid-column: span 2; }
    .pax-field { display: flex; flex-direction: column; gap: 6px; }
    .pax-field label { font-size: 12px; color: var(--gray); font-weight: 600; }
    .pax-input, .pax-select {
      background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.12);
      border-radius: 10px; padding: 10px 14px; color: white; font-size: 14px;
      outline: none; width: 100%; transition: border .2s; box-sizing: border-box;
    }
    .pax-input:focus, .pax-select:focus { border-color: var(--gold); }
    .pax-input::placeholder { color: var(--gray2); }
    .pax-select {
      appearance: none; -webkit-appearance: none;
      padding-right: 34px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='7' viewBox='0 0 11 7'%3E%3Cpath d='M1 1l4.5 4.5L10 1' stroke='%23888' stroke-width='1.8' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: calc(100% - 12px) 50%;
    }
    .pax-select option { background: var(--navy3); }
    /* DOB selects — wrapper with ::after arrow guarantees pixel-perfect centering */
    .dob-sel { position: relative; }
    .dob-sel::after {
      content: '';
      position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
      width: 11px; height: 7px; pointer-events: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='7' viewBox='0 0 11 7'%3E%3Cpath d='M1 1l4.5 4.5L10 1' stroke='%23888' stroke-width='1.8' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat; background-size: contain;
    }
    .dob-sel .pax-select { background-image: none; padding-right: 32px; }
    /* DOB row */
    .dob-wrap { display: grid; grid-template-columns: 1fr 2fr 1.4fr; gap: 8px; }
    /* Required asterisk */
    .req { color: var(--gold); margin-left: 3px; }
    .field-error input, .field-error select, .field-error .choices__inner { border-color: var(--red) !important; }
    .field-error-msg { color: #f87171; font-size: 12px; margin-top: 4px; display: none; }
    .field-error .field-error-msg { display: block; }

    /* Choices.js dark override */
    .choices__inner {
      background: rgba(255,255,255,.07) !important; border: 1px solid rgba(255,255,255,.12) !important;
      border-radius: 10px !important; padding: 7px 14px !important; min-height: 40px !important;
      color: white !important; font-size: 14px !important;
    }
    .choices__list--dropdown, .choices__list[aria-expanded] {
      background: #2D5F6B !important; border: 1px solid rgba(255,255,255,.15) !important;
      border-radius: 12px !important; box-shadow: 0 12px 40px rgba(0,0,0,.7) !important; z-index: 999 !important;
    }
    .choices__list--dropdown .choices__item {
      color: rgba(255,255,255,.85) !important; padding: 10px 14px !important; font-size: 14px !important;
    }
    .choices__list--dropdown .choices__item--selectable.is-highlighted {
      background: rgba(202,138,113,.14) !important; color: var(--accent3) !important;
    }
    .choices__list--dropdown .choices__item.is-selected {
      background: rgba(202,138,113,.08) !important; color: var(--accent3) !important; font-weight: 600 !important;
    }
    .choices__list--single .choices__item { color: rgba(255,255,255,.45) !important; }
    .choices__list--single .choices__item.choices__item--selectable:not(.choices__placeholder) { color: var(--accent3) !important; font-weight: 600 !important; }
    .choices__placeholder { color: #64748b !important; }
    .choices__input {
      background: transparent !important; color: white !important;
      font-size: 14px !important; border: none !important; padding: 4px 0 !important;
    }
    .choices__input::placeholder { color: #64748b !important; }
    .choices[data-type*=select-one]::after { border-color: rgba(255,255,255,.4) transparent transparent !important; }
    .choices[data-type*=select-one].is-open::after { border-color: transparent transparent rgba(255,255,255,.4) !important; }
    .choices__heading { color: var(--gray) !important; font-size: 12px !important;
                        background: transparent !important; border-bottom-color: rgba(255,255,255,.1) !important; }

    /* Tom Select dark theme */
    .ts-wrapper .ts-control {
      background: rgba(255,255,255,.07) !important;
      border: 1px solid rgba(255,255,255,.12) !important;
      border-radius: 12px !important; color: white !important;
      padding: 10px 14px !important; min-height: 48px !important;
      gap: 6px !important; box-shadow: none !important;
    }
    .ts-wrapper.focus .ts-control {
      border-color: var(--accent) !important; box-shadow: none !important;
    }
    .ts-wrapper .ts-control input {
      color: white !important; font-size: 14px !important;
    }
    .ts-wrapper .ts-control input::placeholder { color: var(--gray2) !important; }
    .ts-dropdown {
      background: var(--navy2) !important;
      border: 1px solid rgba(255,255,255,.15) !important;
      border-radius: 12px !important;
      box-shadow: 0 16px 48px rgba(0,0,0,.7) !important;
      color: white !important; margin-top: 4px !important;
    }
    .ts-dropdown .option {
      color: rgba(255,255,255,.85) !important;
      padding: 10px 14px !important; font-size: 14px !important;
    }
    .ts-dropdown .option:hover,
    .ts-dropdown .option.active {
      background: rgba(202,138,113,.14) !important; color: var(--accent3) !important;
    }
    .ts-dropdown .optgroup-header {
      color: var(--gray) !important; font-size: 11px !important;
      background: transparent !important; text-transform: uppercase !important;
      letter-spacing: 1px !important;
    }
    .ts-wrapper .item {
      background: var(--accent) !important; color: #ffffff !important;
      border-radius: 8px !important; padding: 4px 8px 4px 12px !important;
      font-weight: 700 !important; font-size: 13px !important;
      border: none !important; display: inline-flex !important;
      align-items: center !important; gap: 6px !important;
    }
    .ts-wrapper .item .remove {
      color: #ffffff !important; opacity: .7 !important;
      border: none !important; font-size: 16px !important;
      padding: 0 !important; line-height: 1 !important;
    }
    .ts-wrapper .item .remove:hover { opacity: 1 !important; }
    .ts-dropdown-content { max-height: 240px !important; }
    .ts-dropdown .no-results {
      color: var(--gray) !important; padding: 12px 14px !important; font-size: 14px !important;
    }
    /* Price box */
    .price-box {
      background: rgba(202,138,113,.06); border: 1px solid rgba(202,138,113,.2);
      border-radius: 18px; padding: 24px; margin-top: 24px;
    }
    .price-box-title { font-size: 14px; font-weight: 800; color: var(--gold);
                       text-transform: uppercase; letter-spacing: .5px; margin-bottom: 14px; }
    .pr-row { display: flex; justify-content: space-between; align-items: center;
              font-size: 14px; color: var(--gray); padding: 6px 0;
              border-bottom: 1px solid rgba(255,255,255,.06); }
    .pr-row:last-of-type { border-bottom: none; }
    .pr-row span:last-child { font-weight: 700; color: var(--white); }
    .pr-total {
      display: flex; justify-content: space-between; align-items: flex-end;
      padding-top: 14px; margin-top: 4px;
      border-top: 2px solid rgba(202,138,113,.3);
    }
    .ptl { font-size: 16px; font-weight: 800; }
    .ptv { font-size: 28px; font-weight: 900; color: var(--gold); line-height: 1; }
    .pr-per { font-size: 12px; color: var(--gray); text-align: right; margin-top: 4px; }
    /* Step 8 */
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-field { display: flex; flex-direction: column; gap: 8px; }
    .form-field.full { grid-column: span 2; }
    .f-label { font-size: 13px; color: var(--gray); font-weight: 600; }
    .f-input {
      background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.12);
      border-radius: 12px; padding: 14px; color: white; font-size: 15px; outline: none;
      width: 100%; transition: border .2s; resize: vertical;
    }
    .f-input:focus { border-color: var(--gold); }
    .f-input::placeholder { color: var(--gray2); }
    textarea.f-input { min-height: 90px; }
    .err-msg { color: #f87171; font-size: 13px; margin-top: 12px; display: none; }
    /* Success */
    .success-wrap { display: none; text-align: center; padding: 48px 32px; }
    .success-wrap.on { display: block; }
    .s-icon { font-size: 72px; margin-bottom: 24px; }
    .success-wrap h2 { font-size: 28px; font-weight: 900; margin-bottom: 12px; }
    .success-wrap p { font-size: 16px; color: var(--gray); line-height: 1.6; margin-bottom: 8px; }
    .success-ref { font-size: 20px; font-weight: 800; color: var(--gold); margin-top: 16px; }

    /* ══════════ BOOKING SUMMARY CARD (Step 8) */
    .booking-summary {
      background: linear-gradient(135deg, #2D5F6B 0%, #1a4450 100%);
      border: 1.5px solid rgba(202,138,113,.30);
      border-radius: 20px; padding: 22px 24px; margin-bottom: 28px;
    }
    .bs-header {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 18px; padding-bottom: 14px;
      border-bottom: 1px solid rgba(255,255,255,.07);
    }
    .bs-title { font-size: 11px; font-weight: 800; color: var(--accent); letter-spacing: 1.5px; text-transform: uppercase; }
    .bs-trip {
      display: flex; align-items: center; justify-content: space-between;
      background: rgba(255,255,255,.04); border-radius: 14px;
      padding: 14px 18px; margin-bottom: 16px;
    }
    .bs-trip-left { display: flex; flex-direction: column; gap: 4px; }
    .bs-airport { font-size: 13px; font-weight: 700; color: var(--gray); letter-spacing: .5px; }
    .bs-dates { font-size: 17px; font-weight: 800; color: white; }
    .bs-nights-lbl { font-size: 12px; color: var(--gray); margin-top: 2px; }
    .bs-mystery {
      font-size: 32px; font-weight: 900; color: rgba(202,138,113,.25);
      letter-spacing: 4px; font-style: italic;
    }
    .bs-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 18px; }
    .bs-tag {
      display: inline-flex; align-items: center; gap: 5px;
      background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);
      border-radius: 100px; padding: 5px 13px;
      font-size: 12px; font-weight: 600; color: rgba(255,255,255,.82);
    }
    .bs-price-rows { border-top: 1px solid rgba(255,255,255,.07); padding-top: 14px; }
    .bs-pr-row {
      display: flex; justify-content: space-between; align-items: center;
      font-size: 13px; color: var(--gray); padding: 5px 0;
      border-bottom: 1px solid rgba(255,255,255,.04);
    }
    .bs-pr-row:last-of-type { border-bottom: none; }
    .bs-pr-row span:last-child { color: white; font-weight: 600; }
    .bs-total {
      display: flex; justify-content: space-between; align-items: flex-end;
      padding-top: 14px; margin-top: 6px;
      border-top: 2px solid rgba(202,138,113,.35);
    }
    .bs-total-label { font-size: 16px; font-weight: 800; color: rgba(255,255,255,.9); }
    .bs-total-price { font-size: 34px; font-weight: 900; color: var(--accent); line-height: 1; }

    /* ══════════════════════ FOOTER */
    /* ── Call-us section ── */
    .call-us-section { background: linear-gradient(135deg, #1a3a42 0%, #2D5F6B 60%, #1e4a54 100%); padding: 80px 24px; text-align: center; }
    .call-us-inner { max-width: 620px; margin: 0 auto; }
    .call-us-icon { font-size: 44px; margin-bottom: 18px; }
    .call-us-heading { font-size: clamp(26px, 4vw, 36px); font-weight: 800; color: #fff; margin-bottom: 14px; }
    .call-us-sub { font-size: 16px; color: rgba(255,255,255,.75); line-height: 1.7; margin-bottom: 32px; max-width: 480px; margin-left: auto; margin-right: auto; }
    .call-us-actions { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; margin-bottom: 18px; }
    .call-us-btn { display: inline-flex; align-items: center; gap: 9px; padding: 14px 28px; border-radius: 50px; font-size: 15px; font-weight: 700; text-decoration: none; transition: transform .2s, box-shadow .2s; }
    .call-us-btn.primary { background: #CA8A71; color: #fff; box-shadow: 0 6px 24px rgba(202,138,113,.4); }
    .call-us-btn.primary:hover { transform: translateY(-2px); box-shadow: 0 10px 32px rgba(202,138,113,.6); }
    .call-us-btn.secondary { background: rgba(255,255,255,.12); color: #fff; border: 1px solid rgba(255,255,255,.25); }
    .call-us-btn.secondary:hover { background: rgba(255,255,255,.2); transform: translateY(-2px); }
    .call-us-note { font-size: 13px; color: rgba(255,255,255,.5); }
    .call-us-note strong { color: rgba(255,255,255,.75); }

    .esc-footer { background: #EFE9E7; padding: 64px 64px 28px; border-top: 1px solid rgba(15,45,53,.07); }
    .footer-main { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 56px; }
    .footer-brand p { font-size: 14px; color: var(--gray); line-height: 1.75; margin-top: 16px; max-width: 280px; }
    .footer-col h4 { font-size: 11px; font-weight: 800; color: var(--white); letter-spacing: 1.5px;
                     text-transform: uppercase; margin-bottom: 18px; }
    .footer-col a { display: block; font-size: 14px; color: var(--gray); text-decoration: none;
                    margin-bottom: 10px; transition: color .2s; }
    .footer-col a:hover { color: var(--accent); }
    .footer-social { margin-top: 28px; }
    .footer-social h4 { font-size: 11px; font-weight: 800; color: var(--white); letter-spacing: 1.5px;
                        text-transform: uppercase; margin-bottom: 16px; }
    .social-icons { display: flex; gap: 12px; }
    .social-icon {
      width: 40px; height: 40px; border-radius: 10px;
      background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.1);
      display: flex; align-items: center; justify-content: center;
      color: var(--gray); text-decoration: none; transition: all .2s;
    }
    .social-icon:hover { background: var(--accent); border-color: var(--accent); color: #ffffff; }
    .social-icon svg { width: 18px; height: 18px; fill: currentColor; }
    .footer-divider { height: 1px; background: rgba(255,255,255,.07); margin-bottom: 24px; }
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

    /* ══════════════════════ TRUST BADGES */
    .trust-badges {
      display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
      justify-content: center; margin-top: 28px;
      animation: fadeUp .9s .45s ease both;
    }
    .trust-badge { font-size: 13px; color: rgba(255,255,255,.72); font-weight: 600; display: flex; align-items: center; gap: 5px; }
    .trust-sep { color: rgba(255,255,255,.3); }

    /* ══════════════════════ FORM VALIDATION ALERT */
    .form-alert {
      display: flex; align-items: flex-start; gap: 12px;
      padding: 14px 16px;
      background: rgba(239,68,68,.1);
      border: 1px solid rgba(239,68,68,.35);
      border-radius: 12px;
      margin-bottom: 20px;
      animation: alertSlideIn .25s cubic-bezier(.4,0,.2,1) both;
    }
    @keyframes alertSlideIn {
      from { opacity: 0; transform: translateY(-10px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .form-alert-icon {
      flex-shrink: 0; width: 20px; height: 20px; margin-top: 1px;
      background: #ef4444; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 11px; font-weight: 900; color: white; line-height: 1;
    }
    .form-alert-body { flex: 1; }
    .form-alert-title {
      font-size: 13px; font-weight: 700; color: #fca5a5; margin-bottom: 2px;
    }
    .form-alert-msg { font-size: 13px; color: rgba(255,255,255,.65); line-height: 1.5; }
    .form-alert-close {
      flex-shrink: 0; background: none; border: none; cursor: pointer;
      color: rgba(255,255,255,.35); font-size: 18px; line-height: 1;
      padding: 0; margin-top: -1px; transition: color .15s;
    }
    .form-alert-close:hover { color: rgba(255,255,255,.7); }

    /* ══════════════════════ STATUS MODAL */
    .status-modal-overlay {
      display: none; position: fixed; inset: 0; z-index: 2000;
      background: rgba(0,0,0,.65); backdrop-filter: blur(4px);
      align-items: center; justify-content: center; padding: 20px;
    }
    .status-modal-overlay.open { display: flex; }
    .status-modal-card {
      position: relative; background: var(--navy2); border: 1px solid rgba(255,255,255,.08);
      border-radius: 20px; padding: 36px 32px 32px; width: 100%; max-width: 420px;
      box-shadow: 0 24px 64px rgba(0,0,0,.5);
      animation: modalIn .22s cubic-bezier(.34,1.56,.64,1);
    }
    @keyframes modalIn { from { opacity:0; transform:scale(.94) translateY(12px); } to { opacity:1; transform:none; } }
    .status-modal-close {
      position: absolute; top: 14px; right: 16px; background: none; border: none;
      color: var(--gray); font-size: 18px; cursor: pointer; line-height: 1;
      padding: 4px 8px; border-radius: 6px; transition: color .15s;
    }
    .status-modal-close:hover { color: var(--white); }
    .status-modal-icon { font-size: 32px; margin-bottom: 12px; }
    .status-modal-title { font-size: 20px; font-weight: 800; color: var(--white); margin-bottom: 6px; }
    .status-modal-sub { font-size: 13px; color: var(--gray); margin-bottom: 24px; line-height: 1.5; }
    .status-modal-form { display: flex; flex-direction: column; gap: 14px; }
    .status-field { display: flex; flex-direction: column; gap: 6px; }
    .status-field label { font-size: 12px; font-weight: 700; color: var(--gray); text-transform: uppercase; letter-spacing: .5px; }
    .status-field input {
      background: rgba(255,255,255,.06); border: 1.5px solid rgba(255,255,255,.1);
      border-radius: 10px; padding: 11px 14px; color: var(--white); font-size: 15px;
      font-family: inherit; outline: none; transition: border-color .2s;
    }
    .status-field input:focus { border-color: var(--accent); }
    .status-modal-btn {
      background: var(--accent); border: none; border-radius: 12px; padding: 13px;
      color: #ffffff; font-size: 15px; font-weight: 800; font-family: inherit;
      cursor: pointer; transition: opacity .2s; margin-top: 4px;
    }
    .status-modal-btn:hover { opacity: .88; }
    .status-modal-btn:disabled { opacity: .5; cursor: not-allowed; }
    .status-error { font-size: 13px; color: #f87171; text-align: center; padding: 4px 0; }
    .status-result {
      margin-top: 24px; border-top: 1px solid rgba(255,255,255,.08);
      padding-top: 20px; display: flex; flex-direction: column; gap: 14px;
    }
    .sr-badge {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 6px 14px; border-radius: 100px; font-size: 13px; font-weight: 700;
    }
    .sr-badge.PENDING   { background: rgba(202,138,113,.15); color: var(--accent); }
    .sr-badge.CONFIRMED { background: rgba(34,197,94,.15);  color: #22c55e; }
    .sr-badge.CANCELLED { background: rgba(239,68,68,.15);  color: #f87171; }
    .sr-label  { font-size: 10px; color: var(--gray); text-transform: uppercase; letter-spacing: .6px; margin-bottom: 3px; }
    .sr-name   { font-size: 17px; font-weight: 800; color: var(--white); }
    .sr-ref    { font-size: 12px; color: var(--gray); }
    .sr-info   { display: flex; flex-direction: column; gap: 6px; }
    .sr-row    { display: flex; justify-content: space-between; font-size: 13px; }
    .sr-row-label { color: var(--gray); }
    .sr-row-val   { color: var(--white); font-weight: 600; }
    .sr-row-passengers { align-items: flex-start; }
    .sr-passengers { font-size: 11px; font-weight: 500; line-height: 1.7; text-align: right; }
    .sr-msg    { font-size: 13px; color: var(--gray); line-height: 1.5; border-left: 3px solid; padding-left: 10px; }
    .sr-msg.PENDING   { border-color: var(--accent); }
    .sr-msg.CONFIRMED { border-color: #22c55e; }
    .sr-msg.CANCELLED { border-color: #f87171; }

    /* ══════════════════════ SCROLL TO TOP */
    .scroll-top {
      position: fixed; bottom: 28px; right: 28px; z-index: 996;
      width: 46px; height: 46px; border-radius: 14px;
      background: var(--accent); color: #ffffff; border: none;
      font-size: 20px; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      opacity: 0; transform: translateY(16px);
      transition: opacity .3s, transform .3s;
      box-shadow: 0 4px 20px rgba(202,138,113,.4);
    }
    .scroll-top.visible { opacity: 1; transform: translateY(0); }
    .scroll-top:hover { background: var(--accent2); transform: translateY(-3px); box-shadow: 0 8px 28px rgba(202,138,113,.5); }

    /* ══════════════════════ SKELETON SHIMMER */
    @keyframes skelShimmer {
      0%   { background-position: -600px 0; }
      100% { background-position:  600px 0; }
    }
    .skel-shimmer {
      background: linear-gradient(90deg, rgba(255,255,255,.05) 25%, rgba(255,255,255,.1) 50%, rgba(255,255,255,.05) 75%);
      background-size: 1200px 100%;
      animation: skelShimmer 1.6s ease infinite;
      border-radius: 24px;
    }
    .skel-card { pointer-events: none; }

    /* ══════════════════════ PROGRESS BAR */
    .booking-progress { margin-bottom: 20px; }
    .bp-header {
      display: flex; justify-content: space-between; align-items: center;
      font-size: 11px; color: var(--gray); margin-bottom: 8px;
      font-weight: 700; text-transform: uppercase; letter-spacing: .8px;
    }
    .bp-bar {
      height: 3px; background: rgba(255,255,255,.1); border-radius: 100px; overflow: hidden;
    }
    .bp-fill {
      height: 100%; background: var(--accent); border-radius: 100px;
      transition: width .4s cubic-bezier(.4,0,.2,1);
    }

    /* ══════════════════════ PAYMENT INFO */
    .payment-info {
      background: rgba(202,138,113,.06); border: 1px solid rgba(202,138,113,.2);
      border-radius: 16px; padding: 20px 22px; margin-bottom: 20px;
    }
    .pi-header {
      display: flex; align-items: center; gap: 10px;
      font-size: 14px; font-weight: 800; color: var(--accent); margin-bottom: 14px;
    }
    .pi-icon { font-size: 18px; }
    .pi-steps {
      padding-left: 20px; display: flex; flex-direction: column; gap: 8px;
      margin-bottom: 14px;
    }
    .pi-steps li { font-size: 13px; color: rgba(255,255,255,.75); line-height: 1.6; }
    .pi-steps li strong { color: white; }
    .pi-note {
      font-size: 12px; color: var(--gray); padding-top: 12px;
      border-top: 1px solid rgba(255,255,255,.07); line-height: 1.5;
    }

    /* ══════════════════════ TERMS / GDPR CHECKBOXES */
    .terms-wrap { margin: 20px 0 8px; display: flex; flex-direction: column; gap: 10px; }

    .terms-check-row {
      position: relative;
      border: 1.5px solid rgba(255,255,255,.1);
      border-radius: 12px;
      background: rgba(255,255,255,.03);
      transition: border-color .25s, background .25s, box-shadow .25s;
    }
    .terms-check-row:has(input:checked) {
      border-color: rgba(202,138,113,.5);
      background: rgba(202,138,113,.06);
      box-shadow: 0 0 0 3px rgba(202,138,113,.08);
    }
    .terms-check-row.terms-invalid {
      border-color: #ef4444 !important;
      background: rgba(239,68,68,.05) !important;
      box-shadow: 0 0 0 3px rgba(239,68,68,.08) !important;
    }

    /* Hide native checkbox */
    .terms-check-row input[type="checkbox"] {
      position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;
    }

    /* Label = full clickable area */
    .terms-check-row label {
      display: flex; align-items: flex-start; gap: 14px;
      padding: 14px 16px; cursor: pointer; width: 100%;
      font-size: 13.5px; color: rgba(255,255,255,.78); line-height: 1.55;
      user-select: none;
    }
    .terms-check-row label a { color: var(--accent3); text-decoration: underline; }
    .terms-check-row label a:hover { color: var(--accent2); }

    /* Custom checkbox box (::before on label) */
    .terms-check-row label::before {
      content: ''; flex-shrink: 0;
      width: 22px; height: 22px;
      border: 2px solid rgba(255,255,255,.22);
      border-radius: 7px;
      background: rgba(255,255,255,.04);
      transition: all .2s cubic-bezier(.4,0,.2,1);
      background-size: 14px 14px;
      background-position: center;
      background-repeat: no-repeat;
    }
    .terms-check-row:hover label::before { border-color: rgba(202,138,113,.5); }
    .terms-check-row input:checked + label::before {
      background-color: var(--accent3);
      border-color: var(--accent3);
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3.5 8.5l3 3 6-7' stroke='white' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    }
    .terms-check-row.terms-invalid label::before { border-color: #ef4444; }

    .terms-err-msg { color: #f87171; font-size: 12px; margin-top: -4px; display: none; padding: 0 16px 10px; }
    .terms-err-msg.visible { display: block; }

/* ══════════════════════ LIGHT-BG SECTION OVERRIDES
   All rgba(255,255,255,…) styles were designed for dark backgrounds.
   Sections that now use white/parchment need dark equivalents.
   ═══════════════════════════════════════════════════════════════ */

    /* --- FAQ (white bg) ---------------------------------------- */
    .faq-item { border-color: rgba(15,45,53,.1); background: rgba(15,45,53,.025); }
    .faq-item.open { border-color: rgba(202,138,113,.35); background: rgba(202,138,113,.03); }
    .faq-q { color: #2D5F6B; }
    .faq-icon { border-color: rgba(15,45,53,.18); color: #7A9FA8; }
    .faq-a { color: #5a4f6a; }

    /* --- Features (white bg) ------------------------------------ */
    .feat-card { background: #F5F3F1; border-color: rgba(15,45,53,.08); }
    .feat-card:hover { border-color: rgba(202,138,113,.3); background: rgba(202,138,113,.04); }
    .feat-icon-wrap { background: rgba(202,138,113,.1); }

    /* --- For Who (light bg) ------------------------------------- */
    .who-card { background: rgba(15,45,53,.04); border-color: rgba(15,45,53,.1); }
    .who-card.yes { background: rgba(202,138,113,.05); border-color: rgba(202,138,113,.18); }
    .who-card.no  { background: rgba(239,68,68,.04); border-color: rgba(239,68,68,.14); }

    /* --- Stats (parchment bg) ----------------------------------- */
    .esc-stats { border-top-color: rgba(15,45,53,.08); border-bottom-color: rgba(15,45,53,.08); }
    .stats-item { border-right-color: rgba(15,45,53,.1); }

    /* --- Footer (parchment bg) ---------------------------------- */
    .social-icon { background: rgba(15,45,53,.07); border-color: rgba(15,45,53,.12); color: #7A9FA8; }
    .footer-divider { background: rgba(15,45,53,.08); }

    /* --- Booking card — dark interior, all text must be light --- */
    .card {
      background: #0D2E38;            /* deep purple-midnight */
      border-color: rgba(255,255,255,.08);
    }
    /* Headings and hint text inside card (inherit dark from body → must override) */
    .card h2    { color: #ffffff; }
    .card .hint { color: rgba(255,255,255,.45); }

    /* Passenger items */
    .pax-num  { color: #F9CFF2 !important; }  /* Petal Frost — readable on dark */
    .pax-item { background: rgba(255,255,255,.05); border-color: rgba(255,255,255,.1); }
    .pax-field label { color: rgba(255,255,255,.5); }
    .pax-input { color: #ffffff; }
    .pax-input::placeholder { color: rgba(255,255,255,.28); }
    .pax-select { color: #ffffff; }
    .pax-select option { background: #0D2E38; color: #ffffff; }

    /* Counter/trav inside card */
    .trav-info h3 { color: #ffffff; }
    .trav-row { background: rgba(255,255,255,.06); }
    /* Counter number — nasleđivalo bi tamni body color, mora biti belo */
    .card .cv { color: #ffffff; }
    /* Accom tiles inside card — text beo na tamnoj pozadini */
    .card .a-name { color: #ffffff; }
    .card .a-desc { color: rgba(255,255,255,.6); }
    .card .accom-tile { border-color: rgba(255,255,255,.14); }
    .card .accom-tile:hover,
    .card .accom-tile.on { border-color: var(--gold); background: rgba(202,138,113,.1); }
    /* Suit row / extras inside card */
    .card .suit-row { background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); }
    .card .e-label  { color: #ffffff; }
    .card .e-desc   { color: rgba(255,255,255,.55); }
    .card .e-price  { color: var(--gold); }
    .card h3 { color: #ffffff; }
    .card p, .card .sec-sub { color: rgba(255,255,255,.65); }

    /* Choices.js — selected value lighter */
    .choices__list--single .choices__item.choices__item--selectable:not(.choices__placeholder) {
      color: #BFD8DE !important;
    }

    /* Progress bar + step nav */
    .booking-progress .bp-bar { background: rgba(255,255,255,.12); }
    .sn-dot { background: rgba(255,255,255,.1); border-color: rgba(255,255,255,.2); }
    .sn-item.active .sn-dot { background: var(--gold); border-color: var(--gold); color: #ffffff; }

    /* Price box inside card */
    .pr-row { border-bottom-color: rgba(255,255,255,.07); }

    /* Terms checkboxes */
    .terms-check-row { border-color: rgba(255,255,255,.12); background: rgba(255,255,255,.03); }

    /* Date rows — dr-daynum was 'white' which is fine on dark */
    .month-body { background: rgba(0,0,0,.2); }

    /* Step nav labels */
    .sn-label { color: rgba(255,255,255,.4); }

    /* No-dates title */
    .no-dates-title { color: #ffffff; }

    /* --- Status modal (white bg card) --------------------------- */
    .status-modal-card { border-color: rgba(15,45,53,.1); }
    .status-field input {
      background: rgba(15,45,53,.05); border-color: rgba(15,45,53,.14);
      color: var(--white);
    }
    .status-result { border-top-color: rgba(15,45,53,.08); }

    /* Manifesto quote (white bg) */
    .mf-quote { background: rgba(202,138,113,.04); border-left-color: var(--accent); }
    .mf-quote em { color: var(--accent3); }  /* was var(--teal)=#BFD8DE — invisible on white */

/* ══════════════════════ ANIMATIONS */
    @keyframes fadeUp   { from { opacity:0; transform:translateY(32px); } to { opacity:1; transform:none; } }
    @keyframes fadeDown { from { opacity:0; transform:translateY(-20px); } to { opacity:1; transform:none; } }

    /* ══════════════════════ RESPONSIVE */
    @media (max-width: 768px) {
      .esc-nav { padding: 0 20px; }
      .hero-stats { display: none; }
      .features-grid, .who-grid, .accom-grid { grid-template-columns: 1fr; }
      .footer-top { grid-template-columns: 1fr; gap: 32px; }
      .esc-footer { padding: 48px 24px 28px; }
      .stats-row { grid-template-columns: repeat(2, 1fr); }
      .form-grid { grid-template-columns: 1fr; }
      .form-field.full { grid-column: span 1; }
      .pax-fields { grid-template-columns: 1fr; }
      .excl-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* ══════════ MOBILE BOOKING CARD — fixes cramped add-ons + passenger steps */
    @media (max-width: 540px) {
      /* Root fix: card padding eats 80px on 375px screen → reduce */
      .card { padding: 22px 16px; }

      /* Suit row — icon+text fill row 1, counter+price wrap to row 2 */
      .suit-row { padding: 14px 12px; gap: 8px; flex-wrap: wrap; }
      .suit-row .e-txt { min-width: 0; } /* flex:1 already set; expands to fill row so counter wraps */
      .suit-row .counter { margin-left: auto; } /* right-align counter on row 2 */

      /* Extra toggle cards */
      .extra-card { padding: 12px 12px; gap: 10px; }
      .extra-card-icon { width: 38px; height: 38px; font-size: 18px; flex-shrink: 0; }
      .extra-card-title { font-size: 13px; }
      .extra-card-sub { font-size: 11px; }
      .extra-card-price { font-size: 12px; margin-right: 4px; }

      /* DOB grid — balanced columns with room for custom arrow */
      .dob-wrap { grid-template-columns: 1fr 1.8fr 1.2fr; gap: 6px; }

      /* Choices.js full width in narrow cells */
      .choices { width: 100% !important; }
      .choices__inner { padding: 6px 10px !important; }

      /* Pax grid 1 col */
      .pax-fields { grid-template-columns: 1fr; }

      /* Accom tiles 1 col on very small */
      .accom-grid { grid-template-columns: 1fr; }

      /* Steps nav smaller text */
      .sn-label { font-size: 9px; }
      .sn-dot { width: 26px; height: 26px; font-size: 11px; }
    }
  </style>
</head>
<body>

<!-- NAV -->
<nav class="esc-nav" id="mainNav">
  <a href="#" class="esc-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Escapii"></a>
  <div class="nav-right">
    <div class="lang-wrap">
      <button class="lang-btn on" onclick="setLang('sr')">SR</button>
      <button class="lang-btn" onclick="setLang('en')">EN</button>
    </div>
    <button class="nav-status" onclick="openStatusModal()" title="Proveri status rezervacije">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <span data-i18n="nav.status">Moja rezervacija</span>
    </button>
    <button class="nav-book" onclick="escScrollTo('esc-booking')" data-i18n="nav.book">Rezerviši →</button>
  </div>
  <button class="nav-burger" id="navBurger" onclick="togBurger()" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- MOBILE MENU -->
<div class="mob-menu" id="mobMenu">
  <div class="mob-menu-links">
    <button class="mob-menu-link" onclick="mobNav('esc-about')"   data-i18n="snav.about">O nama</button>
    <button class="mob-menu-link" onclick="mobNav('esc-dest')"    data-i18n="snav.dest">Destinacije</button>
    <button class="mob-menu-link" onclick="mobNav('esc-how')"     data-i18n="snav.how">Kako funkcioniše</button>
    <button class="mob-menu-link" onclick="mobNav('esc-who')"     data-i18n="snav.who">Za koga</button>
    <button class="mob-menu-link" onclick="mobNav('esc-faq')"     data-i18n="snav.faq">FAQ</button>
    <button class="mob-menu-link" onclick="closeMobMenu();openStatusModal();" data-i18n="nav.status" style="color:var(--accent);">🔍 Moja rezervacija</button>
  </div>
  <div class="mob-menu-bottom">
    <div class="lang-wrap">
      <button class="lang-btn on" onclick="setLang('sr')">SR</button>
      <button class="lang-btn" onclick="setLang('en')">EN</button>
    </div>
    <button class="mob-menu-book" onclick="mobNav('esc-booking')" data-i18n="snav.book">Rezerviši</button>
  </div>
</div>

<!-- SECONDARY NAV -->
<nav class="sec-nav" id="secNav">
  <button class="sec-nav-link" onclick="escScrollTo('esc-about')"   data-i18n="snav.about">O nama</button>
  <button class="sec-nav-link" onclick="escScrollTo('esc-dest')"    data-i18n="snav.dest">Destinacije</button>
  <button class="sec-nav-link" onclick="escScrollTo('esc-how')"     data-i18n="snav.how">Kako funkcioniše</button>
  <button class="sec-nav-link" onclick="escScrollTo('esc-who')"     data-i18n="snav.who">Za koga</button>
  <button class="sec-nav-link" onclick="escScrollTo('esc-faq')"     data-i18n="snav.faq">FAQ</button>
  <button class="sec-nav-link" onclick="escScrollTo('esc-booking')" data-i18n="snav.book">Rezerviši</button>
</nav>

<!-- HERO -->
<section class="esc-hero">
  <video class="hero-video" autoplay muted loop playsinline preload="auto">
    <source src="<?= get_template_directory_uri() ?>/assets/hero-bg-opt.mp4" type="video/mp4">
  </video>
  <div class="hero-video-overlay"></div>
  <div class="hero-eyebrow" data-i18n="hero.badge">Iznenađenje garantovano</div>
  <h1 class="hero-h1" data-i18n-html="hero.h1">Putujte <em>a da ne znate</em> kuda idete</h1>
  <p class="hero-sub" data-i18n="hero.sub">Odaberite aerodrom, datum i budžet. Mi biramo destinaciju. Vi se iznenadite na aerodromu.</p>
  <div class="hero-btns">
    <button class="btn-gold" onclick="escScrollTo('esc-booking')" data-i18n="hero.cta">Otkrij svoju avanturu</button>
    <button class="btn-ghost" onclick="escScrollTo('esc-how')" data-i18n="hero.how">Kako funkcioniše?</button>
  </div>
  <div class="trust-badges" style="animation: fadeUp .9s .45s ease both;">
    <span class="trust-badge">✓ <span data-i18n="trust.1">Potvrda u 24h</span></span>
    <span class="trust-sep">·</span>
    <span class="trust-badge">🔒 <span data-i18n="trust.2">Bez skrivenih troškova</span></span>
    <span class="trust-sep">·</span>
    <span class="trust-badge">⭐ <span data-i18n="trust.3">Sigurna rezervacija</span></span>
  </div>

  <div class="hero-stats">
    <div class="hero-stat"><div class="stat-num" id="destCount">50+</div><div class="stat-label" data-i18n="hero.stat.dest">Destinacija</div></div>
    <div class="hero-stat"><div class="stat-num">100%</div><div class="stat-label" data-i18n="hero.stat.surprise">Iznenađenje</div></div>
  </div>
</section>

<!-- BOOKING -->
<section class="esc-booking" id="esc-booking">
  <div class="booking-inner">
    <div class="booking-header">
      <span class="sec-tag" data-i18n="book.tag">Rezervacija</span>
      <h2 class="sec-heading" data-i18n="book.heading">Krenite na avanturu</h2>
      <p class="sec-sub" data-i18n="book.sub">Popunite formu u par koraka</p>
    </div>

    <div class="booking-progress" id="bookingProgress">
      <div class="bp-header">
        <span id="bpLabel">Korak 1 od 8</span>
        <span id="bpPct">12%</span>
      </div>
      <div class="bp-bar"><div class="bp-fill" id="bpFill" style="width:12%"></div></div>
    </div>

    <div class="steps-nav" id="stepsNav"></div>

    <!-- Step 1: Airport -->
    <div class="step-wrap on" id="step1">
      <div class="card">
        <h2 data-i18n="s1.h">Odakle putujete?</h2>
        <p class="hint" data-i18n="s1.hint">Izaberite aerodrom polaska</p>
        <div class="airport-cards">
          <div class="airport-card" id="ap-BEG" onclick="pickAirport(this,'BEG')">
            <img src="<?php echo get_template_directory_uri(); ?>/images/destinations/beograd.jpg" alt="Beograd">
            <div class="airport-overlay">
              <div class="airport-iata">BEG</div>
              <div class="airport-city">Beograd</div>
              <div class="airport-name" data-i18n="s1.beg.name">Aerodrom Nikola Tesla</div>
            </div>
            <div class="airport-check">✓</div>
          </div>
          <div class="airport-card" id="ap-INI" onclick="pickAirport(this,'INI')">
            <img src="<?php echo get_template_directory_uri(); ?>/images/destinations/nis.jpg" alt="Niš">
            <div class="airport-overlay">
              <div class="airport-iata">INI</div>
              <div class="airport-city">Niš</div>
              <div class="airport-name" data-i18n="s1.ini.name">Aerodrom Constantine the Great</div>
            </div>
            <div class="airport-check">✓</div>
          </div>
        </div>
        <div class="step-btns" style="margin-top:24px;">
          <button class="btn-next" id="btnN1" disabled onclick="nextStep()" data-i18n="btn.next">Nastavi →</button>
        </div>
      </div>
    </div>

    <!-- Step 2: Travelers -->
    <div class="step-wrap" id="step2">
      <div class="card">
        <h2 data-i18n="s2.h">Koliko vas putuje?</h2>
        <p class="hint" data-i18n="s2.hint"></p>
        <div class="trav-row">
          <div class="trav-info">
            <h3 data-i18n="s2.label">Broj putnika</h3>
            <p data-i18n="s2.sub">1 do 6 osoba</p>
          </div>
          <div class="counter">
            <button class="cb" onclick="chTrav(-1)" id="travD">−</button>
            <div class="cv" id="travN">1</div>
            <button class="cb" onclick="chTrav(1)" id="travU">+</button>
          </div>
        </div>
        <div class="step-btns">
          <button class="btn-back" onclick="prevStep()" data-i18n="btn.back">← Nazad</button>
          <button class="btn-next" onclick="nextStep()" data-i18n="btn.next">Nastavi →</button>
        </div>
      </div>
    </div>

    <!-- Step 3: Date -->
    <div class="step-wrap" id="step3">
      <div class="card">
        <h2 data-i18n="s3.h">Izaberite termin</h2>
        <p class="hint" data-i18n="s3.hint">Dostupni termini za izabrani aerodrom</p>
        <div class="dates-list" id="datesList"><div style="color:var(--gray);text-align:center;padding:30px;" data-i18n="loading">Učitavanje...</div></div>
        <div class="step-btns">
          <button class="btn-back" onclick="prevStep()" data-i18n="btn.back">← Nazad</button>
          <button class="btn-next" id="btnN3" disabled onclick="nextStep()" data-i18n="btn.next">Nastavi →</button>
        </div>
      </div>
    </div>

    <!-- Step 4: Accommodation -->
    <div class="step-wrap" id="step4">
      <div class="card">
        <h2 data-i18n="s4.h">Tip smeštaja</h2>
        <p class="hint" data-i18n="s4.hint">Izaberi kategoriju hotela</p>
        <div id="singleNotice" class="single-notice">
          🛏️ <strong data-i18n="single.warn">Napomena:</strong>
          <span data-i18n="single.msg"> Putujete sami — hotelske sobe se uglavnom rezervišu za minimum 2 osobe, pa se primenjuje doplata za jednokrevetnu sobu.</span>
          <strong> +60€</strong>
        </div>
        <div class="accom-grid">
          <div class="accom-tile on" onclick="pickAccom(this,'STANDARD')">
            <div class="a-icon">🏨</div>
            <div class="a-name" data-i18n="accom.std">Standard</div>
            <div class="a-badge free" data-i18n="accom.std.p">Uključeno</div>
            <div class="a-desc" data-i18n="accom.std.d">Ugodan hotel, odlična lokacija</div>
            <div class="a-hover">
              <div class="a-hover-stars">★★★</div>
              <div class="a-hover-desc" data-i18n="accom.std.hover">Hotel sa 3 zvezdice ili apartman na dobroj lokaciji. Udoban smeštaj sa svim osnovnim sadržajima.</div>
            </div>
          </div>
          <div class="accom-tile" onclick="pickAccom(this,'SUPERIOR')">
            <div class="a-icon">⭐</div>
            <div class="a-name" data-i18n="accom.sup">Superior</div>
            <div class="a-badge pay" data-i18n="accom.sup.badge">+50€/os</div>
            <div class="a-desc" data-i18n="accom.sup.d">Viša kategorija, bolji pogled</div>
            <div class="a-hover">
              <div class="a-hover-stars">★★★★</div>
              <div class="a-hover-desc" data-i18n="accom.sup.hover">Hotel sa 4 zvezdice, pažljivo odabrani hoteli koji garantuju udobnost, visok nivo usluge i prijatan boravak.</div>
            </div>
          </div>
          <div class="accom-tile" onclick="pickAccom(this,'PREMIUM')">
            <div class="a-icon">💎</div>
            <div class="a-name" data-i18n="accom.prem">Premium</div>
            <div class="a-badge pay" data-i18n="accom.prem.badge">+130€/os</div>
            <div class="a-desc" data-i18n="accom.prem.d">Luksuz i ekskluzivnost</div>
            <div class="a-hover">
              <div class="a-hover-stars">★★★★★</div>
              <div class="a-hover-desc" data-i18n="accom.prem.hover">Hotel sa 5 zvezdica, luksuzni smeštaj sa ekskluzivnim sadržajima i vrhunskom uslugom.</div>
            </div>
          </div>
        </div>
        <div class="step-btns">
          <button class="btn-back" onclick="prevStep()" data-i18n="btn.back">← Nazad</button>
          <button class="btn-next" onclick="nextStep()" data-i18n="btn.next">Nastavi →</button>
        </div>
      </div>
    </div>

    <!-- Step 5: Extras -->
    <div class="step-wrap" id="step5">
      <div class="card">
        <h2 data-i18n="s5.h">Dodaci</h2>
        <p class="hint" data-i18n="s5.hint">Sve je opciono</p>
        <div class="suit-row" id="suitRow">
          <div class="e-icon">🧳</div>
          <div class="e-txt">
            <div class="e-label" data-i18n="ext.suit">Želim da moja karta uključuje ručni kofer</div>
            <div class="e-desc" data-i18n="ext.suit.d">50€/smer × 2 smera = 100€/os</div>
          </div>
          <div class="counter">
            <button class="cb" id="suitD" onclick="chSuit(-1)">−</button>
            <div class="cv" id="suitN">0</div>
            <button class="cb" id="suitU" onclick="chSuit(1)">+</button>
          </div>
          <div class="e-price" id="suitPrice">0€</div>
        </div>
        <div class="extras-grid">
          <div class="connecting-tooltip-wrap">
            <div class="extra-card" id="ec-hasInsurance" onclick="togExtra(this,'hasInsurance')">
              <div class="extra-card-icon">🛡️</div>
              <div class="extra-card-body">
                <div class="extra-card-title" data-i18n="ext.ins">Putno osiguranje</div>
                <div class="extra-card-sub" data-i18n="ext.ins.d">Medicinska pomoć, otkazivanje, prtljag</div>
              </div>
              <div class="extra-card-price" data-i18n="ins.price">+12€/os</div>
              <div class="extra-toggle"></div>
            </div>
            <div class="connecting-tooltip">
              <div class="connecting-tooltip-title" data-i18n="ext.ins.tip.title">🛡️ Putno osiguranje</div>
              <div class="connecting-tooltip-body" data-i18n-html="ext.ins.tip.body">Pokriva <strong>medicinske troškove</strong> u inostranstvu, otkazivanje leta i oštećen ili izgubljen prtljag. Preporučujemo svim putnicima.</div>
            </div>
          </div>
          <div class="connecting-tooltip-wrap">
            <div class="extra-card" id="ec-hasBreakfast" onclick="togExtra(this,'hasBreakfast')">
              <div class="extra-card-icon">🍳</div>
              <div class="extra-card-body">
                <div class="extra-card-title" data-i18n="ext.bfst">Doručak</div>
                <div class="extra-card-sub" data-i18n="ext.bfst.d">Svaki dan u hotelu uključen</div>
              </div>
              <div class="extra-card-price" data-i18n="bfst.price">+13€/os</div>
              <div class="extra-toggle"></div>
            </div>
            <div class="connecting-tooltip">
              <div class="connecting-tooltip-title" data-i18n="ext.bfst.tip.title">🍳 Doručak u hotelu</div>
              <div class="connecting-tooltip-body" data-i18n-html="ext.bfst.tip.body">Svako jutro krećeš odmoran i sit — doručak u hotelu je uključen <strong>svakog dana</strong> boravka. Nema brige šta i gde ćeš jesti ujutru.</div>
            </div>
          </div>
          <div class="connecting-tooltip-wrap">
            <div class="extra-card" id="ec-hasSeatsTogether" onclick="togSeats(this)">
              <div class="extra-card-icon">💺</div>
              <div class="extra-card-body">
                <div class="extra-card-title" data-i18n="ext.seats">Sedišta zajedno</div>
                <div class="extra-card-sub" data-i18n="ext.seats.d">po smeru, oba smera leta</div>
              </div>
              <div class="extra-card-price" data-i18n="seats.price">+12€/os/smer</div>
              <div class="extra-toggle"></div>
            </div>
            <div class="connecting-tooltip">
              <div class="connecting-tooltip-title" data-i18n="ext.seats.tip.title">💺 Sedišta zajedno</div>
              <div class="connecting-tooltip-body" data-i18n-html="ext.seats.tip.body">Garantujemo da cela vaša grupa sedi <strong>zajedno u istom redu</strong>, u oba smera leta. Idealno za parove i grupe koji ne žele da putuju razdvojeni.</div>
            </div>
          </div>
          <div class="connecting-tooltip-wrap">
            <div class="extra-card" id="ec-hasConnectingFlights" onclick="togExtra(this,'hasConnectingFlights')">
              <div class="extra-card-icon">🔄</div>
              <div class="extra-card-body">
                <div class="extra-card-title" data-i18n="ext.connecting">Prihvatam presedanje</div>
                <div class="extra-card-sub" data-i18n="ext.connecting.d">Prihvatam da moj let može uključivati presedanje</div>
              </div>
              <div class="extra-card-price" data-i18n="free" style="color:var(--accent3);font-size:12px;font-weight:700">Besplatno</div>
              <div class="extra-toggle"></div>
            </div>
            <div class="connecting-tooltip">
              <div class="connecting-tooltip-title" data-i18n="ext.connecting.tip.title">✈️ Više destinacija, više iznenađenja</div>
              <div class="connecting-tooltip-body" data-i18n-html="ext.connecting.tip.body">Saglasnost na presedanje nam otvara <strong>više mogućnosti</strong> — destinacije do kojih nema direktnih letova postaju dostupne. Tvoje iznenađenje može biti još <strong>spektakularnije</strong>.</div>
            </div>
          </div>
        </div>
        <div id="seatsNotice" style="display:none; margin-top:14px; background:rgba(202,138,113,.1); border:1px solid rgba(202,138,113,.3); border-radius:12px; padding:14px 16px; font-size:13px; color:rgba(255,255,255,.85); line-height:1.6;">
          💺 <span id="seatsNoticeText"></span>
        </div>
        <div class="step-btns" style="margin-top:28px;">
          <button class="btn-back" onclick="prevStep()" data-i18n="btn.back">← Nazad</button>
          <button class="btn-next" onclick="nextStep()" data-i18n="btn.next">Nastavi →</button>
        </div>
      </div>
    </div>

    <!-- Step 6: Exclusions -->
    <div class="step-wrap" id="step6">
      <div class="card">
        <h2 data-i18n="s6.h">Isključite destinacije</h2>
        <p class="hint" data-i18n="s6.hint">Destinacije koje ne želite (opciono, max 5)</p>

        <div class="excl-info" id="exclInfoBlock">
          <div class="excl-info-tiers">
            <div class="excl-tier">
              <div class="excl-tier-label" data-i18n="s6.t1.lbl">1. isključivanje</div>
              <div class="excl-tier-price free" data-i18n="free">Besplatno</div>
            </div>
            <div class="excl-tier" id="exclTier2">
              <div class="excl-tier-label" id="exclTier2Label" data-i18n="s6.t2.lbl">2. i 3. isključivanje</div>
              <div class="excl-tier-price high" id="exclTier2Price">+15€/os.</div>
            </div>
          </div>
          <div class="excl-info-note">
            <svg width="13" height="13" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M8 7v4M8 5v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            <span id="exclNote" data-i18n="s6.note">Preporučujemo do 3 isključivanja — manje isključivanja znači više iznenađenja!</span>
          </div>
        </div>
        <div class="excl-grid" id="exclGrid"></div>
        <div class="step-btns">
          <button class="btn-back" onclick="prevStep()" data-i18n="btn.back">← Nazad</button>
          <button class="btn-next" onclick="nextStep()" data-i18n="btn.next">Nastavi →</button>
        </div>
      </div>
    </div>

    <!-- Step 7: Passengers + Price -->
    <div class="step-wrap" id="step7">
      <div class="card">
        <h2 data-i18n="s7.h">Podaci o putnicima</h2>
        <p class="hint" data-i18n="s7.hint">Unesite podatke za svakog putnika</p>
        <div class="pax-list" id="paxList"></div>
        <div class="price-box">
          <div class="price-box-title" data-i18n="price.title">Pregled cene</div>
          <div id="priceRows"><div style="color:var(--gray);font-size:14px;text-align:center;padding:16px;">Izračunavanje...</div></div>
          <div class="pr-total">
            <div class="ptl" data-i18n="price.total">Ukupno</div>
            <div><div class="ptv" id="priceTotal">—</div><div class="pr-per" id="pricePer"></div></div>
          </div>
        </div>
        <div class="step-btns">
          <button class="btn-back" onclick="prevStep()" data-i18n="btn.back">← Nazad</button>
          <button class="btn-next" onclick="nextStep()" data-i18n="btn.next">Nastavi →</button>
        </div>
      </div>
    </div>

    <!-- Step 8: Contact -->
    <div class="step-wrap" id="step8">
      <div class="card">
        <h2 data-i18n="s8.h">Kontakt podaci</h2>
        <p class="hint" data-i18n="s8.hint">Javićemo se u roku od 24 sata</p>
        <div id="bookingSummary" class="booking-summary" style="display:none;"></div>
        <div class="form-grid">
          <div class="form-field" id="ff-firstname">
            <div class="f-label"><span data-i18n="s8.firstname">Ime nosioca rezervacije</span> <span class="req">*</span></div>
            <input class="f-input" type="text" id="fFirstName" placeholder="Marko" autocomplete="given-name">
            <div class="field-error-msg" data-i18n="err.required"></div>
          </div>
          <div class="form-field" id="ff-lastname">
            <div class="f-label"><span data-i18n="s8.lastname">Prezime nosioca rezervacije</span> <span class="req">*</span></div>
            <input class="f-input" type="text" id="fLastName" placeholder="Marković" autocomplete="family-name">
            <div class="field-error-msg" data-i18n="err.required"></div>
          </div>
          <div class="form-field" id="ff-email">
            <div class="f-label">Email <span class="req">*</span></div>
            <input class="f-input" type="email" id="fEmail" placeholder="youremail@gmail.com">
            <div class="field-error-msg" data-i18n="err.email"></div>
          </div>
          <div class="form-field" id="ff-phone">
            <div class="f-label"><span data-i18n="s8.phone">Telefon</span> <span class="req">*</span></div>
            <input class="f-input" type="tel" id="fPhone" placeholder="+381641234567">
            <div class="field-error-msg" data-i18n="err.required"></div>
          </div>
          <div class="form-field full">
            <div class="f-label" data-i18n="s8.notes">Napomene (opciono)</div>
            <textarea class="f-input" id="fNotes" placeholder="Alergije, posebni zahtevi..." data-i18n-ph="s8.notes.ph"></textarea>
          </div>
        </div>
        <div class="payment-info">
          <div class="pi-header">
            <span class="pi-icon">💳</span>
            <span data-i18n="pay.heading">Kako funkcioniše uplata?</span>
          </div>
          <ol class="pi-steps">
            <li data-i18n-html="pay.s1">Pošalji upit klikom na dugme ispod</li>
            <li data-i18n-html="pay.s2">U roku od <strong>24h</strong> dobićeš email sa podacima za uplatu na naš račun</li>
            <li data-i18n-html="pay.s3">Izvrši uplatu — rezervacija se <strong>potvrđuje tek nakon uplate</strong></li>
            <li data-i18n-html="pay.s4">Potvrda stiže na email — putovanje je tvoje! ✓</li>
          </ol>
          <div class="pi-note" data-i18n="pay.note">Bez naknade za karticu. Bez skrivenih troškova. Cena na sajtu je cena koju plaćaš.</div>
        </div>

        <div class="terms-wrap">
          <div class="terms-check-row" id="terms-row">
            <input type="checkbox" id="chkTerms">
            <label for="chkTerms" data-i18n-html="terms.check">Prihvatam <a href="/uslovi-koriscenja" target="_blank">Uslove korišćenja</a> <span class="req">*</span></label>
          </div>
          <div class="terms-err-msg" id="terms-err" data-i18n="err.terms">Morate prihvatiti uslove korišćenja.</div>
          <div class="terms-check-row" id="privacy-row">
            <input type="checkbox" id="chkPrivacy">
            <label for="chkPrivacy" data-i18n-html="privacy.check">Prihvatam <a href="/politika-privatnosti" target="_blank">Politiku privatnosti</a> <span class="req">*</span></label>
          </div>
          <div class="terms-err-msg" id="privacy-err" data-i18n="err.privacy">Morate prihvatiti politiku privatnosti.</div>
          <div class="terms-check-row" id="gdpr-row">
            <input type="checkbox" id="chkGdpr">
            <label for="chkGdpr" data-i18n-html="gdpr.check">Saglasan/na sam sa obradom ličnih podataka u svrhu organizacije putovanja. <span class="req">*</span></label>
          </div>
          <div class="terms-err-msg" id="gdpr-err" data-i18n="err.gdpr">Morate dati saglasnost za obradu podataka.</div>
        </div>

        <div class="step-btns">
          <button class="btn-back" onclick="prevStep()" data-i18n="btn.back">← Nazad</button>
          <button class="btn-next" onclick="submitBooking()" id="btnSubmit" data-i18n="s8.submit">Pošalji upit ✓</button>
        </div>
      </div>
    </div>

    <!-- Success handled via SweetAlert2 -->
  </div>
</section>

<!-- MANIFESTO -->
<section class="esc-manifesto" id="esc-about">
  <div class="mf-inner">
    <div class="mf-tag" data-i18n="mf.tag">Šta je Escapii?</div>
    <h2 class="mf-heading" data-i18n-html="mf.heading">Pusti destinaciju da te <em>iznenadi</em></h2>
    <blockquote class="mf-quote" data-i18n-html="mf.quote">"Nije problem što ne putujemo dovoljno.<br>Problem je što putujemo <em>uvek isto</em>."</blockquote>
    <p class="mf-body" data-i18n-html="mf.p1">ESCAPII je onaj osećaj kad kažeš "ajde" i ne znaš tačno gde ideš — ali znaš da će biti dobro. To je beg iz rutine. Iskustvo koje te malo pomeri.</p>
    <p class="mf-body" data-i18n-html="mf.p2">Nije samo 2-3 dana. To je <strong>reset</strong>. Onaj momenat kad ti srce malo jače kuca jer ne znaš šta dolazi — i baš zato jedva čekaš.</p>
    <p class="mf-body" data-i18n-html="mf.p3"><strong>ESCAPII nije destinacija. ESCAPII je osećaj.</strong></p>
  </div>
</section>

<!-- DESTINATIONS CAROUSEL -->
<section class="esc-dest" id="esc-dest">
  <div class="dest-header">
    <span class="sec-tag" data-i18n="dest.tag">Naše destinacije</span>
    <h2 class="sec-heading" data-i18n="dest.heading">Sve ovo te čeka…</h2>
    <p class="sec-sub" data-i18n="dest.sub">Izaberi da isključiš ono što ne voliš — ostatak ostaje misterija</p>
  </div>
  <div class="carousel-outer">
    <div class="carousel-track" id="carouselTrack">
      <!-- Populated by JS -->
    </div>
  </div>
  <div class="dest-mystery-row">
    <div class="mystery-badge">🎭 <span data-i18n="dest.mystery">Ali ne znaš šta ćeš dobiti</span></div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="esc-features" id="esc-how">
  <div class="features-inner">
    <div class="features-header">
      <span class="sec-tag" data-i18n="how.tag">Kako funkcioniše</span>
      <h2 class="sec-heading" data-i18n="how.heading">Putovanje bez razmišljanja</h2>
      <p class="sec-sub" data-i18n="how.sub">Sve što treba je da odabereš polazak i budžet.</p>
    </div>
    <div class="features-grid">
      <div class="feat-card">
        <div class="feat-icon-wrap">✈️</div>
        <div class="feat-content">
          <h3 data-i18n="how.c1.t">Odaberi polazak</h3>
          <p data-i18n="how.c1.p">Aerodrom, broj putnika, termin. Bez komplikacija. Mi preuzimamo ostatak planiranja.</p>
        </div>
      </div>
      <div class="feat-card">
        <div class="feat-icon-wrap">🛏️</div>
        <div class="feat-content">
          <h3 data-i18n="how.c2.t">Kvalitetan smeštaj</h3>
          <p data-i18n="how.c2.p">Hoteli centralno locirani, provereni, dobro ocenjeni.</p>
        </div>
      </div>
      <div class="feat-card">
        <div class="feat-icon-wrap">💶</div>
        <div class="feat-content">
          <h3 data-i18n="how.c3.t">Najbolja cena</h3>
          <p data-i18n="how.c3.p">Iznenađujuća destinacija nam omogućava da pregovaramo drugačije — i da taj popust prenesemo na tebe.</p>
        </div>
      </div>
      <div class="feat-card">
        <div class="feat-icon-wrap">🎭</div>
        <div class="feat-content">
          <h3 data-i18n="how.c4.t">Avantura počinje pre puta</h3>
          <p data-i18n="how.c4.p">Tri dana pre polaska otkrivamo tvoju destinaciju. Dovoljno da se pripremiš, ali ne i da pokvariš čar iznenađenja.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOR WHO -->
<section class="esc-who" id="esc-who">
  <div class="who-inner">
    <div class="who-header">
      <span class="sec-tag" data-i18n="who.tag">Za koga je Escapii</span>
      <h2 class="sec-heading" data-i18n="who.heading">Nije za svakoga — i to je poenta</h2>
    </div>
    <div class="who-grid">
      <div class="who-card yes">
        <div class="who-card-title">✓ <span data-i18n="who.yes.title">Escapii je za tebe ako...</span></div>
        <div class="who-item"><div class="who-dot"></div><span data-i18n="who.yes.1">Voliš da putuješ, ali ti je dosadilo da sve planiraš</span></div>
        <div class="who-item"><div class="who-dot"></div><span data-i18n="who.yes.2">Želiš nešto novo, ali ne znaš šta tačno</span></div>
        <div class="who-item"><div class="who-dot"></div><span data-i18n="who.yes.3">Voliš spontanost, ali uz dobru organizaciju</span></div>
        <div class="who-item"><div class="who-dot"></div><span data-i18n="who.yes.4">Kažeš "a što da ne" češće nego "a šta ako"</span></div>
        <div class="who-item"><div class="who-dot"></div><span data-i18n="who.yes.5">Hoćeš priču koju ćeš prepričavati</span></div>
      </div>
      <div class="who-card no">
        <div class="who-card-title">✕ <span data-i18n="who.no.title">Escapii nije za tebe ako...</span></div>
        <div class="who-item"><div class="who-dot"></div><span data-i18n="who.no.1">Moraš da znaš svaki detalj unapred</span></div>
        <div class="who-item"><div class="who-dot"></div><span data-i18n="who.no.2">Ideš samo tamo gde si već video na Instagramu</span></div>
        <div class="who-item"><div class="who-dot"></div><span data-i18n="who.no.3">Praviš plan za svaki sat 73 dana unapred</span></div>
        <div class="who-item"><div class="who-dot"></div><span data-i18n="who.no.4">Tražiš isto putovanje svaki put</span></div>
        <div class="who-item"><div class="who-dot"></div><span data-i18n="who.no.5">Hoćeš klasičnu agenciju i klasičan aranžman</span></div>
      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<div class="esc-stats">
  <div class="stats-row">
    <div class="stats-item" data-aos="fade-up" data-aos-delay="0"><div class="stats-num" id="statsDestCount" data-countup="50">50+</div><div class="stats-lbl" data-i18n="stats.dest">Destinacija</div></div>
    <div class="stats-item" data-aos="fade-up" data-aos-delay="100"><div class="stats-num" id="statsTravelers" data-countup="15">15+</div><div class="stats-lbl" data-i18n="stats.travelers">Godina iskustva</div></div>
    <div class="stats-item" data-aos="fade-up" data-aos-delay="200"><div class="stats-num">24h</div><div class="stats-lbl" data-i18n="stats.support">Podrška</div></div>
    <div class="stats-item" data-aos="fade-up" data-aos-delay="300"><div class="stats-num" id="statSurprise" data-countup="100">100%</div><div class="stats-lbl" data-i18n="stats.surprise">Iznenađenje</div></div>
  </div>
</div>

<!-- FAQ -->
<section class="esc-faq" id="esc-faq">
  <div class="faq-inner">
    <div class="faq-header">
      <span class="sec-tag" data-i18n="faq.tag">Česta pitanja</span>
      <h2 class="sec-heading" data-i18n="faq.heading">Imaš pitanje?</h2>
    </div>
    <div class="faq-list">

      <div class="faq-item" onclick="togFaq(this)">
        <div class="faq-q">
          <span data-i18n="faq.1.q">Šta je uključeno u putovanje?</span>
          <div class="faq-icon">+</div>
        </div>
        <div class="faq-a" data-i18n="faq.1.a">Svako putovanje uključuje povratne avio karte i smeštaj. Prevoz do aerodroma i unutar destinacije nije uključen u cenu putovanja.</div>
      </div>

      <div class="faq-item" onclick="togFaq(this)">
        <div class="faq-q">
          <span data-i18n="faq.2.q">Šta od prtljaga mogu da ponesem?</span>
          <div class="faq-icon">+</div>
        </div>
        <div class="faq-a" data-i18n="faq.2.a">U svim putovanjima je uključen besplatni ručni prtljag. Dozvoljene dimenzije kabinskog prtljaga zavise od avio kompanije sa kojom putuješ — preporučujemo da proveriš mere na sajtu konkretne kompanije.</div>
      </div>

      <div class="faq-item" onclick="togFaq(this)">
        <div class="faq-q">
          <span data-i18n="faq.3.q">Izmene i otkazivanje</span>
          <div class="faq-icon">+</div>
        </div>
        <div class="faq-a" data-i18n="faq.3.a">Rezervacija se potvrđuje tek nakon uplate na račun. Nakon potvrde, rezervacija se obrađuje u roku od 24 sata i nije moguće izvršiti otkaz. Ukoliko želiš da izmeniš već potvrđenu rezervaciju, primenjuju se uslovi koje nameće avio kompanija ili smeštaj. Sve troškove eventualnih izmena snosi putnik.</div>
      </div>

    </div>
  </div>
</section>

<!-- STATUS MODAL ─────────────────────────────────────────────────────────── -->
<div id="statusModal" class="status-modal-overlay" onclick="if(event.target===this)closeStatusModal()">
  <div class="status-modal-card">
    <button class="status-modal-close" onclick="closeStatusModal()" aria-label="Zatvori">✕</button>
    <div class="status-modal-icon">🔍</div>
    <h3 class="status-modal-title" data-i18n="status.title">Proveri status rezervacije</h3>
    <p class="status-modal-sub" data-i18n="status.sub">Unesite broj rezervacije i prezime nosioca rezervacije.</p>

    <div class="status-modal-form">
      <div class="status-field">
        <label data-i18n="status.ref">Broj rezervacije</label>
        <input id="statusRef" type="text" placeholder="ESC-xxxxxxxx" autocomplete="off"
               onkeydown="if(event.key==='Enter')checkStatus()">
      </div>
      <div class="status-field">
        <label data-i18n="status.surname">Prezime</label>
        <input id="statusSurname" type="text" placeholder="Marković" autocomplete="off"
               onkeydown="if(event.key==='Enter')checkStatus()">
      </div>
      <button class="status-modal-btn" id="statusBtn" onclick="checkStatus()">
        <span data-i18n="status.btn">Proveri →</span>
      </button>
      <div id="statusError" class="status-error" style="display:none"></div>
    </div>

    <div id="statusResult" class="status-result" style="display:none"></div>
  </div>
</div>

<!-- SCROLL TO TOP -->
<button class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to top">↑</button>

<!-- CALL US SECTION -->
<section class="call-us-section" id="esc-contact-cta">
  <div class="call-us-inner">
    <div class="call-us-icon">📞</div>
    <h2 class="call-us-heading" data-i18n="callus.h">Nisi siguran? Pozovi nas!</h2>
    <p class="call-us-sub" data-i18n="callus.p">Ako imaš pitanja ili nisi siguran kako sve ovo funkcioniše — Escapii tim je tu za tebe. Pozovi nas i sve ti objasnimo u par minuta.</p>
    <div class="call-us-actions">
      <a class="call-us-btn primary" href="tel:+381693414430">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.24h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.96a16 16 0 0 0 6.29 6.29l.95-.95a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        +381 69 341 44 30
      </a>
      <a class="call-us-btn secondary" href="mailto:escapii.team@gmail.com">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        escapii.team@gmail.com
      </a>
    </div>
    <p class="call-us-note" data-i18n="callus.note">Dostupni smo <strong>pon–sub, 9h–21h</strong></p>
  </div>
</section>

<!-- FOOTER -->
<footer class="esc-footer">
  <div class="footer-main">
    <div class="footer-brand">
      <a href="#" class="esc-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-black.svg" alt="Escapii"></a>
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
      <a href="javascript:void(0)" onclick="escScrollTo('esc-about')"   data-i18n="footer.about">O nama</a>
      <a href="javascript:void(0)" onclick="escScrollTo('esc-dest')"    data-i18n="footer.dest">Destinacije</a>
      <a href="javascript:void(0)" onclick="escScrollTo('esc-how')"     data-i18n="footer.how">Kako funkcioniše</a>
      <a href="javascript:void(0)" onclick="escScrollTo('esc-who')"     data-i18n="footer.who">Za koga</a>
      <a href="javascript:void(0)" onclick="escScrollTo('esc-faq')"     data-i18n="footer.faq">FAQ</a>
      <a href="javascript:void(0)" onclick="escScrollTo('esc-booking')" data-i18n="footer.book">Rezervacija</a>
    </div>
    <div class="footer-col">
      <h4 data-i18n="footer.departure">Polasci</h4>
      <a href="javascript:void(0)" onclick="escScrollTo('esc-booking')">✈ Beograd (BEG)</a>
      <a href="javascript:void(0)" onclick="escScrollTo('esc-booking')">✈ Niš (INI)</a>
    </div>
    <div class="footer-col">
      <h4 data-i18n="footer.contact">Kontakt</h4>
      <a href="mailto:escapii.team@gmail.com" style="display:inline-flex;align-items:center;gap:6px;">✉ escapii.team@gmail.com</a>
      <a href="javascript:void(0)" onclick="openStatusModal()" data-i18n="footer.status" style="margin-top:8px;display:inline-flex;align-items:center;gap:6px;">🔍 Proveri status rezervacije</a>
    </div>
  </div>
  <div class="footer-divider"></div>
  <div class="footer-bottom">
    <span>© 2026 Escapii — Sva prava zadržana</span>
    <div class="footer-bottom-links">
      <a href="/uslovi-koriscenja" data-i18n="footer.terms">Uslovi korišćenja</a>
      <a href="/politika-privatnosti" data-i18n="footer.privacy">Politika privatnosti</a>
    </div>
  </div>
</footer>

<script>
const API = '<?php echo esc_js(escapii_api_url()); ?>';

// ══════════ i18n
const TR = {
  sr: {
    'nav.status':'Moja rezervacija',
    'nav.book':'Rezerviši →',
    'status.title':'Proveri status rezervacije',
    'status.sub':'Unesite broj rezervacije i prezime nosioca rezervacije.',
    'status.ref':'Broj rezervacije',
    'status.surname':'Prezime',
    'status.btn':'Proveri →',
    'hero.badge':'Iznenađenje garantovano',
    'hero.h1':'Putujte <em>a da ne znate</em> kuda idete',
    'hero.sub':'Odaberite aerodrom, datum i budžet. Mi biramo destinaciju. Vi se iznenadite na aerodromu.',
    'hero.cta':'Otkrij svoju avanturu', 'hero.how':'Kako funkcioniše?',
    'hero.stat.dest':'Destinacija', 'hero.stat.airports':'Aerodroma polaska', 'hero.stat.surprise':'Iznenađenje',
    'mf.tag':'Šta je Escapii?',
    'mf.heading':'Pusti destinaciju da te <em>iznenadi</em>',
    'mf.quote':'"Nije problem što ne putujemo dovoljno.<br>Problem je što putujemo <em>uvek isto</em>."',
    'mf.p1':'ESCAPII je onaj osećaj kad kažeš "ajde" i ne znaš tačno gde ideš — ali znaš da će biti dobro. To je beg iz rutine. Iskustvo koje te malo pomeri.',
    'mf.p2':'Nije samo 2-3 dana. To je <strong>reset</strong>. Onaj momenat kad ti srce malo jače kuca jer ne znaš šta dolazi — i baš zato jedva čekaš.',
    'mf.p3':'<strong>ESCAPII nije destinacija. ESCAPII je osećaj.</strong>',
    'dest.tag':'Naše destinacije', 'dest.heading':'Sve ovo te čeka…',
    'dest.sub':'Izaberi da isključiš ono što ne voliš — ostatak ostaje misterija',
    'dest.mystery':'Ali ne znaš šta ćeš dobiti',
    'how.tag':'Kako funkcioniše', 'how.heading':'Putovanje bez razmišljanja',
    'how.sub':'Sve što treba je da odabereš polazak i budžet.',
    'how.c1.t':'Odaberi polazak', 'how.c1.p':'Aerodrom, broj putnika, termin. Bez komplikacija. Mi preuzimamo ostatak planiranja.',
    'how.c2.t':'Kvalitetan smeštaj', 'how.c2.p':'Provereni i visoko ocenjeni — uz mogućnost da odabereš i višu kategoriju smeštaja.',
    'how.c3.t':'Najbolja cena', 'how.c3.p':'Iznenađujuća destinacija nam omogućava da pregovaramo drugačije — i da taj popust prenesemo na tebe.',
    'how.c4.t':'Otkrij na aerodromu', 'how.c4.p':'Kovertu sa destinacijom otvaraš tek na aerodromu. Let, hotel, transfer — sve rezervisano. Tebi ostaje uzbuđenje.',
    'who.tag':'Za koga je Escapii', 'who.heading':'Nije za svakoga — i to je poenta',
    'who.yes.title':'Escapii je za tebe ako...',
    'who.yes.1':'Voliš da putuješ, ali ti je dosadilo da sve planiraš',
    'who.yes.2':'Želiš nešto novo, ali ne znaš šta tačno',
    'who.yes.3':'Voliš spontanost, ali uz dobru organizaciju',
    'who.yes.4':'Kažeš "a što da ne" češće nego "a šta ako"',
    'who.yes.5':'Hoćeš priču koju ćeš prepričavati',
    'who.no.title':'Escapii nije za tebe ako...',
    'who.no.1':'Moraš da znaš svaki detalj unapred',
    'who.no.2':'Ideš samo tamo gde si već video na Instagramu',
    'who.no.3':'Praviš plan za svaki sat 73 dana unapred',
    'who.no.4':'Tražiš isto putovanje svaki put',
    'who.no.5':'Hoćeš klasičnu agenciju i klasičan aranžman',
    'stats.dest':'Destinacija', 'stats.travelers':'Godina iskustva', 'stats.support':'Podrška', 'stats.surprise':'Iznenađenje',
    'book.tag':'Rezervacija', 'book.heading':'Krenite na avanturu', 'book.sub':'Popunite formu u par koraka',
    'loading':'Učitavanje...', 'btn.next':'Nastavi →', 'btn.back':'← Nazad', 'free':'Besplatno',
    's1.h':'Odakle putujete?', 's1.hint':'Izaberite aerodrom polaska',
    's2.h':'Koliko vas putuje?', 's2.hint':'Svaki putnik unosi ime i pasoš',
    's2.label':'Broj putnika', 's2.sub':'1 do 6 osoba',
    's3.h':'Izaberite termin', 's3.hint':'Dostupni termini za izabrani aerodrom',
    's4.h':'Tip smeštaja', 's4.hint':'Izaberi kategoriju hotela',
    'accom.std':'Standard', 'accom.std.p':'Uključeno', 'accom.std.d':'Ugodan hotel, odlična lokacija',
    'accom.sup':'Superior', 'accom.sup.d':'Viša kategorija, bolji pogled',
    'accom.prem':'Premium', 'accom.prem.d':'Luksuz i ekskluzivnost',
    'accom.std.hover':'Hotel sa 3 zvezdice ili apartman na dobroj lokaciji. Udoban smeštaj sa svim osnovnim sadržajima.',
    'accom.sup.hover':'Hotel sa 4 zvezdice, viša kategorija smeštaja i usluge.',
    'accom.prem.hover':'Hotel sa 5 zvezdica, luksuzni smeštaj sa ekskluzivnim sadržajima i vrhunskom uslugom.',
    'single.warn':'Napomena:', 'single.msg':' Putujete sami — hotelske sobe se uglavnom rezervišu za minimum 2 osobe, pa se primenjuje doplata.',
    's5.h':'Dodaci', 's5.hint':'Sve je opciono',
    'ext.suit':'Želim da moja karta uključuje ručni kofer', 'ext.suit.d':'50€/smer × 2 smera = 100€/os',
    'ext.ins':'Putno osiguranje', 'ext.ins.d':'Medicinska pomoć, otkazivanje, prtljag',
    'ext.bfst':'Doručak', 'ext.bfst.d':'Svaki dan u hotelu',
    'ext.seats':'Sedišta zajedno', 'ext.seats.d':'po smeru, oba smera leta',
    'ext.connecting':'Prihvatam presedanje', 'ext.connecting.d':'Prihvatam da moj let može uključivati presedanje',
    'ext.ins.tip.title':'🛡️ Putno osiguranje',
    'ext.ins.tip.body':'Pokriva <strong>medicinske troškove</strong> u inostranstvu, otkazivanje leta i oštećen ili izgubljen prtljag. Preporučujemo svim putnicima.',
    'ext.bfst.tip.title':'🍳 Doručak u hotelu',
    'ext.bfst.tip.body':'Svako jutro krećeš odmoran i sit — doručak u hotelu je uključen <strong>svakog dana</strong> boravka. Nema brige šta i gde ćeš jesti ujutru.',
    'ext.seats.tip.title':'💺 Sedišta zajedno',
    'ext.seats.tip.body':'Garantujemo da cela vaša grupa sedi <strong>zajedno u istom redu</strong>, u oba smera leta. Idealno za parove i grupe koji ne žele da putuju razdvojeni.',
    'ext.connecting.tip.title':'✈️ Više destinacija, više iznenađenja',
    'ext.connecting.tip.body':'Saglasnost na presedanje nam otvara <strong>više mogućnosti</strong> — destinacije do kojih nema direktnih letova postaju dostupne. Tvoje iznenađenje može biti još <strong>spektakularnije</strong>.',
    's6.h':'Isključite destinacije', 's6.hint':'Destinacije koje ne želite (opciono, max 5)',
    's6.t1.lbl':'1. isključivanje', 's6.t2.lbl':'2. i 3. isključivanje',
    's6.note':'Preporučujemo do 3 isključivanja — manje isključivanja znači više iznenađenja!',
    's7.h':'Podaci o putnicima', 's7.hint':'Unesite podatke za svakog putnika',
    'price.title':'Pregled cene', 'price.total':'Ukupno',
    's8.h':'Kontakt podaci', 's8.hint':'Javićemo se u roku od 24 sata',
    's8.name':'Ime i prezime nosioca rezervacije', 's8.firstname':'Ime nosioca rezervacije', 's8.lastname':'Prezime nosioca rezervacije',
    's8.email':'Email',
    's8.phone':'Telefon', 's8.notes':'Napomene (opciono)', 's8.submit':'Pošalji upit ✓',
    'success.h':'Upit je primljen!',
    'success.p':'Javimo se u roku od 24 sata. Jedva čekamo da vas iznenadimo!',
    'callus.h':'Nisi siguran? Pozovi nas!',
    'callus.p':'Ako imaš pitanja ili nisi siguran kako sve ovo funkcioniše — Escapii tim je tu za tebe. Pozovi nas i sve ti objasnimo u par minuta.',
    'callus.note':'Dostupni smo pon–sub, 9h–21h',
    'footer.desc':'Iznenađujuća putovanja za ljude koji su spremni da puste kontrolu.',
    'footer.nav':'Navigacija', 'footer.about':'O nama', 'footer.dest':'Destinacije',
    'footer.how':'Kako funkcioniše', 'footer.who':'Za koga', 'footer.faq':'FAQ',
    'footer.book':'Rezervacija', 'footer.departure':'Polasci', 'footer.rights':'Sva prava zadržana',
    'steps':['Aerodrom','Putnici','Datum','Smeštaj','Dodaci','Isključi','Putnici','Kontakt'],
    'nights': n=>n===1?'1 noć':`${n} noći`, 'slots': n=>`${n} mesta`,
    'excl.n': n=>`${n} isključeno`, 'pax.ph': i=>`Putnik ${i} — Ime i prezime`,
    'gender.m':'Muški', 'gender.f':'Ženski',
    'pax.num': n=>`Putnik ${n}`, 'pax.name':'Ime i prezime', 'pax.name.err':'Unesite ime putnika.', 'pax.dob.err':'Putnik mora imati najmanje 18 godina.',
    'pax.passport':'Broj pasoša (opciono)', 'pax.passport.ph':'npr. AA1234567',
    'pax.valid.passport':'Putnik ima validan pasoš (važeći min. 6 meseci od povratka)',
    'pax.gender':'Pol', 'pax.dob':'Datum rođenja',
    'pax.visa':'Aktivne vize (opciono)', 'pax.visa.ph':'npr. Engleska, Irska, Maroko...',
    's1.beg.name':'Aerodrom Nikola Tesla', 's1.ini.name':'Aerodrom Constantine the Great',
    'footer.social':'Pratite nas', 'footer.contact':'Kontakt',
    'footer.terms':'Uslovi korišćenja', 'footer.privacy':'Politika privatnosti', 'footer.cookies':'Kolačići',
    'snav.about':'O nama', 'snav.dest':'Destinacije', 'snav.how':'Kako funkcioniše',
    'snav.who':'Za koga', 'snav.faq':'FAQ', 'snav.book':'Rezerviši',
    'faq.tag':'Česta pitanja', 'faq.heading':'Imaš pitanje?',
    'faq.1.q':'Šta je uključeno u putovanje?',
    'faq.1.a':'Svako putovanje uključuje povratne avio karte i smeštaj. Prevoz do aerodroma i unutar destinacije nije uključen u cenu putovanja.',
    'faq.2.q':'Šta od prtljaga mogu da ponesem?',
    'faq.2.a':'U svim putovanjima je uključen besplatni ručni prtljag. Dozvoljene dimenzije kabinskog prtljaga zavise od avio kompanije sa kojom putuješ — preporučujemo da proveriš mere na sajtu konkretne kompanije.',
    'faq.3.q':'Izmene i otkazivanje',
    'faq.3.a':'Rezervacija se potvrđuje tek nakon uplate na račun. Nakon potvrde, rezervacija se obrađuje u roku od 24 sata i nije moguće izvršiti otkaz. Ukoliko želiš da izmeniš već potvrđenu rezervaciju, primenjuju se uslovi koje nameće avio kompanija ili smeštaj. Sve troškove eventualnih izmena snosi putnik.',
    'swal.excl.title':'Maksimalno 3 isključivanja',
    'swal.excl.html':'Već si iskoristio sva 3 dozvoljena isključivanja.<br><br><strong style="color:#CA8A71">Hajde, prepusti se iznenađenju! 🌍</strong>',
    'swal.excl.btn':'Važi, razumem! ✈',
    'pr.base':'Osnovna cena', 'pr.accom':'Smeštaj upgrade', 'pr.suit':'Kabinski kofer',
    'pr.ins':'Putno osiguranje', 'pr.bfst':'Doručak', 'pr.seats':'Sedišta zajedno', 'pr.excl':'Isključivanja', 'pr.solo':'Doplata za solo putnika',
    'pr.pp': n=>`≈ ${n}€ po osobi`, 'err.price':'Nije moguće učitati cenu.',
    'err.req':'Molimo popunite sva obavezna polja.',
    'err.required':'Ovo polje je obavezno.',
    'err.email':'Unesite ispravan email.',
    'err.terms':'Morate prihvatiti uslove korišćenja.',
    'err.privacy':'Morate prihvatiti politiku privatnosti.',
    'err.gdpr':'Morate dati saglasnost za obradu podataka.',
    'terms.check':'Prihvatam <a href="/uslovi-koriscenja" target="_blank">Uslove korišćenja</a> <span class="req">*</span>',
    'privacy.check':'Prihvatam <a href="/politika-privatnosti" target="_blank">Politiku privatnosti</a> <span class="req">*</span>',
    'gdpr.check':'Saglasan/na sam sa obradom ličnih podataka u svrhu organizacije putovanja. <span class="req">*</span>',
    'err.srv':'Greška. Pokušajte ponovo.', 'success.ref': id=>`Referenca rezervacije: ${id}`,
    's3.nodates.title':'Nema dostupnih termina',
    's3.nodates.sub':'Trenutno nema otvorenih termina za izabrani aerodrom. Ostavi email — javljamo ti čim se otvore novi.',
    's3.nodates.btn':'Obavesti me',
    'per.p':'/os',
    'accom.sup.badge':'+50€/os', 'accom.prem.badge':'+130€/os',
    'ins.price':'+12€/os', 'bfst.price':'+13€/os', 'seats.price':'+12€/os/smer',
    'waitlist.ph':'tvoj@email.com',
    'waitlist.already':'📬 Već si na listi — javiće ti se čim se otvore termini.',
    'waitlist.ok':'✓ Dodali smo te! Dobićeš email čim se otvore novi termini.',
    'waitlist.err':'Greška — pokušaj ponovo.',
    'waitlist.swal.ok.title':'✓ Prijavljen/a si!',
    'waitlist.swal.ok.html':'{email} je uspešno prijavljena na listu čekanja za aerodrom {airportName}.<br><br>Bićeš obavešten/a čim se doda novi termin.',
    'waitlist.swal.already.title':'📬 Već si na listi',
    'waitlist.swal.already.html':'{email} je već prijavljena na listu čekanja za aerodrom {airportName}.<br><br>Javiće ti se čim se otvore novi termini.',
    'waitlist.swal.err.title':'Greška',
    'waitlist.swal.err.text':'Nešto nije pošlo kako treba — pokušaj ponovo.',
    'err.dates.load':'Greška pri učitavanju termina.',
    's8.name.ph':'Marko Marković',
    's8.notes.ph':'Alergije, posebni zahtevi...',
    'trust.1':'Potvrda u 24h', 'trust.2':'Bez skrivenih troškova', 'trust.3':'Sigurna rezervacija',
    'pay.heading':'Kako funkcioniše uplata?',
    'pay.s1':'Pošalji upit klikom na dugme ispod',
    'pay.s2':'U roku od <strong>24h</strong> dobićeš email sa podacima za uplatu na naš račun',
    'pay.s3':'Izvrši uplatu — rezervacija se <strong>potvrđuje tek nakon uplate</strong>',
    'pay.s4':'Potvrda stiže na email — putovanje je tvoje! ✓',
    'pay.note':'Bez naknade za karticu. Bez skrivenih troškova. Cena na sajtu je cena koju plaćaš.',
    'bp.label': (s,t) => `Korak ${s} od ${t}`
  },
  en: {
    'nav.status':'My reservation',
    'nav.book':'Book now →',
    'status.title':'Check reservation status',
    'status.sub':'Enter your booking reference and the last name of the lead traveler.',
    'status.ref':'Booking reference',
    'status.surname':'Last name',
    'status.btn':'Check →',
    'hero.badge':'Surprise guaranteed',
    'hero.h1':'Travel <em>without knowing</em> where you\'re going',
    'hero.sub':'Choose airport, date and budget. We pick the destination. You\'re surprised at the airport.',
    'hero.cta':'Discover your adventure', 'hero.how':'How does it work?',
    'hero.stat.dest':'Destinations', 'hero.stat.airports':'Departure airports', 'hero.stat.surprise':'Surprise',
    'mf.tag':'What is Escapii?',
    'mf.heading':'Let the destination <em>surprise you</em>',
    'mf.quote':'"The problem isn\'t that we don\'t travel enough.<br>The problem is we travel <em>the same way</em> every time."',
    'mf.p1':'ESCAPII is that feeling when you say "let\'s go" and you don\'t know exactly where — but you know it\'ll be good. It\'s an escape from routine.',
    'mf.p2':'It\'s not just 2-3 days. It\'s a <strong>reset</strong>. That moment when your heart beats faster because you don\'t know what\'s coming.',
    'mf.p3':'<strong>ESCAPII is not a destination. ESCAPII is a feeling.</strong>',
    'dest.tag':'Our destinations', 'dest.heading':'All this awaits you…',
    'dest.sub':'Choose to exclude what you don\'t like — the rest stays a mystery',
    'dest.mystery':'But you don\'t know what you\'ll get',
    'how.tag':'How it works', 'how.heading':'Travel without planning ahead',
    'how.sub':'All you need is to choose your departure and budget.',
    'how.c1.t':'Choose departure', 'how.c1.p':'Airport, travelers, date. Simple as that. We handle the rest.',
    'how.c2.t':'Quality accommodation', 'how.c2.p':'Hotels centrally located, verified, well-rated. You can also choose a higher category.',
    'how.c3.t':'Best price', 'how.c3.p':'The surprise destination lets us negotiate differently — and pass those savings on to you.',
    'how.c4.t':'Discover at the airport', 'how.c4.p':'You open the destination envelope at the airport. Flight, hotel, transfer — all booked. You just enjoy.',
    'who.tag':'Who is Escapii for', 'who.heading':'Not for everyone — and that\'s the point',
    'who.yes.title':'Escapii is for you if...',
    'who.yes.1':'You love traveling but are tired of planning everything',
    'who.yes.2':'You want something new but don\'t know what exactly',
    'who.yes.3':'You love spontaneity, but with good organization',
    'who.yes.4':'You say "why not" more than "what if"',
    'who.yes.5':'You want a story worth telling',
    'who.no.title':'Escapii is not for you if...',
    'who.no.1':'You need to know every detail in advance',
    'who.no.2':'You only go where you\'ve already seen on Instagram',
    'who.no.3':'You plan every hour 73 days in advance',
    'who.no.4':'You want the same trip every time',
    'who.no.5':'You want a classic travel agency',
    'stats.dest':'Destinations', 'stats.travelers':'Years of experience', 'stats.support':'Support', 'stats.surprise':'Surprise',
    'book.tag':'Book', 'book.heading':'Start your adventure', 'book.sub':'Fill out the form in a few steps',
    'loading':'Loading...', 'btn.next':'Continue →', 'btn.back':'← Back', 'free':'Free',
    's1.h':'Where are you departing from?', 's1.hint':'Select departure airport',
    's2.h':'How many travelers?', 's2.hint':'Each traveler enters name and passport',
    's2.label':'Number of travelers', 's2.sub':'1 to 6 persons',
    's3.h':'Select a date', 's3.hint':'Available dates for the selected airport',
    's4.h':'Accommodation type', 's4.hint':'Select hotel category',
    'accom.std':'Standard', 'accom.std.p':'Included', 'accom.std.d':'Comfortable hotel, great location',
    'accom.sup':'Superior', 'accom.sup.d':'Higher category, better view',
    'accom.prem':'Premium', 'accom.prem.d':'Luxury and exclusivity',
    'accom.std.hover':'3-star hotel or apartment in a great location. Comfortable accommodation with all the essentials.',
    'accom.sup.hover':'4-star hotel, higher category accommodation, better views and premium facilities.',
    'accom.prem.hover':'5-star hotel, luxury accommodation with exclusive facilities and top-tier service.',
    'single.warn':'Note:', 'single.msg':' You are traveling alone — hotel rooms are typically reserved for a minimum of 2 people, so a single room supplement applies.',
    's5.h':'Add-ons', 's5.hint':'All optional',
    'ext.suit':'I want my ticket to include cabin luggage', 'ext.suit.d':'50€/way × 2 ways = 100€/person',
    'ext.ins':'Travel insurance', 'ext.ins.d':'Medical, cancellation, baggage',
    'ext.bfst':'Breakfast', 'ext.bfst.d':'Every day at the hotel',
    'ext.seats':'Seats together', 'ext.seats.d':'per flight, both ways',
    'ext.connecting':'I accept connecting flights', 'ext.connecting.d':'I accept that my flight may include a layover',
    'ext.ins.tip.title':'🛡️ Travel insurance',
    'ext.ins.tip.body':'Covers <strong>medical expenses</strong> abroad, flight cancellation, and damaged or lost luggage. We recommend it for all travelers.',
    'ext.bfst.tip.title':'🍳 Hotel breakfast',
    'ext.bfst.tip.body':'Start every morning refreshed — hotel breakfast is included <strong>every day</strong> of your stay. No need to worry about where to eat in the morning.',
    'ext.seats.tip.title':'💺 Seats together',
    'ext.seats.tip.body':'We guarantee your entire group sits <strong>together in the same row</strong>, on both flights. Perfect for couples and groups who don\'t want to travel apart.',
    'ext.connecting.tip.title':'✈️ More destinations, more surprises',
    'ext.connecting.tip.body':'Accepting connecting flights opens up <strong>more possibilities</strong> — destinations without a direct flight become available. Your surprise could be <strong>even more spectacular</strong>.',
    's6.h':'Exclude destinations', 's6.hint':'Destinations you don\'t want (optional, max 5)',
    's6.t1.lbl':'1st exclusion', 's6.t2.lbl':'2nd & 3rd',
    's6.note':'We recommend up to 3 exclusions — the fewer you exclude, the bigger the surprise!',
    's7.h':'Passenger details', 's7.hint':'Enter details for each traveler',
    'price.title':'Price breakdown', 'price.total':'Total',
    's8.h':'Contact details', 's8.hint':'We\'ll get back to you within 24 hours',
    's8.name':'Lead passenger full name', 's8.firstname':'Lead passenger first name', 's8.lastname':'Lead passenger last name',
    's8.email':'Email',
    's8.phone':'Phone', 's8.notes':'Notes (optional)', 's8.submit':'Send inquiry ✓',
    'success.h':'Inquiry received!',
    'success.p':'We\'ll get back to you within 24 hours. We can\'t wait to surprise you!',
    'callus.h':'Not sure? Give us a call!',
    'callus.p':'If you have questions or are not sure how this works — the Escapii team is here for you. Call us and we\'ll explain everything in a few minutes.',
    'callus.note':'Available Mon–Sat, 9am–9pm',
    'footer.desc':'Surprise trips for people ready to let go and try something different.',
    'footer.nav':'Navigation', 'footer.about':'About', 'footer.dest':'Destinations',
    'footer.how':'How it works', 'footer.who':'Who\'s it for', 'footer.faq':'FAQ',
    'footer.book':'Book', 'footer.departure':'Departures', 'footer.rights':'All rights reserved',
    'steps':['Airport','Travelers','Date','Stay','Add-ons','Exclude','Passengers','Contact'],
    'nights': n=>n===1?'1 night':`${n} nights`, 'slots': n=>`${n} seats`,
    'excl.n': n=>`${n} excluded`, 'pax.ph': i=>`Traveler ${i} — Full name`,
    'gender.m':'Male', 'gender.f':'Female',
    'pax.num': n=>`Traveler ${n}`, 'pax.name':'Full name', 'pax.name.err':'Please enter traveler name.', 'pax.dob.err':'Each traveler must be at least 18 years old.',
    'pax.gender':'Gender', 'pax.dob':'Date of birth',
    'pax.visa':'Active visas (optional)', 'pax.visa.ph':'e.g. England, Ireland, Morocco...',
    'pax.passport':'Passport number (optional)', 'pax.passport.ph':'e.g. AA1234567',
    'pax.valid.passport':'Traveler has a valid passport (valid for at least 6 months after return)',
    's1.beg.name':'Nikola Tesla Airport', 's1.ini.name':'Constantine the Great Airport',
    'footer.social':'Follow us', 'footer.contact':'Contact',
    'footer.terms':'Terms & Conditions', 'footer.privacy':'Privacy Policy', 'footer.cookies':'Cookies',
    'snav.about':'About', 'snav.dest':'Destinations', 'snav.how':'How it works',
    'snav.who':'Who\'s it for', 'snav.faq':'FAQ', 'snav.book':'Book now',
    'faq.tag':'FAQ', 'faq.heading':'Got a question?',
    'faq.1.q':'What does the trip include?',
    'faq.1.a':'Every trip includes round-trip flights and accommodation. Transportation within the destination city is not included in the price.',
    'faq.2.q':'What luggage can I bring?',
    'faq.2.a':'Free hand luggage is included in all trips. Permitted cabin baggage dimensions depend on the airline you travel with — we recommend checking the allowed measurements on your airline\'s website.',
    'faq.3.q':'Changes and cancellations',
    'faq.3.a':'Your reservation is confirmed only after payment has been received. Once confirmed, the booking is processed within 24 hours and can no longer be canceled. If you wish to make changes to an already confirmed reservation, the conditions imposed by the airline or accommodation provider will apply. All costs arising from any changes are the responsibility of the traveler.',
    'swal.excl.title':'✈ Too many exclusions!',
    'swal.excl.html':'You can exclude up to 3 destinations maximum.<br><br><strong style="color:#CA8A71">Trust the surprise — you\'ll love where you end up. 🌍</strong>',
    'swal.excl.btn':'OK, let\'s do it! 🚀',
    'pr.base':'Base price', 'pr.accom':'Accommodation upgrade', 'pr.suit':'Cabin luggage',
    'pr.ins':'Travel insurance', 'pr.bfst':'Breakfast', 'pr.seats':'Seats together', 'pr.excl':'Exclusions', 'pr.solo':'Solo traveler surcharge',
    'pr.pp': n=>`≈ ${n}€ per person`, 'err.price':'Unable to load price.',
    'err.req':'Please fill in all required fields.',
    'err.required':'This field is required.',
    'err.email':'Please enter a valid email address.',
    'err.terms':'You must accept the Terms & Conditions.',
    'err.privacy':'You must accept the Privacy Policy.',
    'err.gdpr':'You must consent to data processing.',
    'terms.check':'I accept the <a href="/uslovi-koriscenja" target="_blank">Terms & Conditions</a> <span class="req">*</span>',
    'privacy.check':'I accept the <a href="/politika-privatnosti" target="_blank">Privacy Policy</a> <span class="req">*</span>',
    'gdpr.check':'I consent to the processing of my personal data for trip organization purposes. <span class="req">*</span>',
    'err.srv':'Error. Please try again.', 'success.ref': id=>`Booking reference: ${id}`,
    's3.nodates.title':'No available dates',
    's3.nodates.sub':'There are currently no open dates for the selected airport. Leave your email — we\'ll notify you when new ones open.',
    's3.nodates.btn':'Notify me',
    'per.p':'/pp',
    'accom.sup.badge':'+50€/pp', 'accom.prem.badge':'+130€/pp',
    'ins.price':'+12€/pp', 'bfst.price':'+13€/pp', 'seats.price':'+12€/pp/way',
    'waitlist.ph':'your@email.com',
    'waitlist.already':'📬 You\'re already on the list — we\'ll notify you when dates open up.',
    'waitlist.ok':'✓ Done! You\'ll get an email as soon as new dates open up.',
    'waitlist.err':'Error — please try again.',
    'waitlist.swal.ok.title':'✓ You\'re on the list!',
    'waitlist.swal.ok.html':'{email} has been added to the waitlist for {airportName} airport.<br><br>You\'ll be notified as soon as new dates are added.',
    'waitlist.swal.already.title':'📬 Already on the list',
    'waitlist.swal.already.html':'{email} is already on the waitlist for {airportName} airport.<br><br>We\'ll notify you when new dates open up.',
    'waitlist.swal.err.title':'Error',
    'waitlist.swal.err.text':'Something went wrong — please try again.',
    'err.dates.load':'Error loading dates.',
    's8.name.ph':'John Smith',
    's8.notes.ph':'Allergies, special requests...',
    'trust.1':'Confirmed in 24h', 'trust.2':'No hidden fees', 'trust.3':'Secure booking',
    'pay.heading':'How does payment work?',
    'pay.s1':'Submit your inquiry by clicking the button below',
    'pay.s2':'Within <strong>24h</strong> you\'ll receive an email with bank transfer details',
    'pay.s3':'Make the transfer — your booking is <strong>confirmed only after payment</strong>',
    'pay.s4':'Confirmation arrives by email — the trip is yours! ✓',
    'pay.note':'No card fees. No hidden costs. The price you see is the price you pay.',
    'bp.label': (s,t) => `Step ${s} of ${t}`
  }
};

let lang = localStorage.getItem('esc-lang') || 'sr';
function t(k,...a){ const v=TR[lang][k]; return typeof v==='function'?v(...a):v||k; }

// ══════════ PREVENT href="#" SCROLL-TO-TOP
document.addEventListener('click', e => {
  const a = e.target.closest('a[href="#"]');
  if (a) e.preventDefault();
});

// ══════════ HAMBURGER MENU
function togBurger() {
  document.getElementById('navBurger').classList.toggle('open');
  document.getElementById('mobMenu').classList.toggle('open');
}
function mobNav(id) {
  document.getElementById('navBurger').classList.remove('open');
  document.getElementById('mobMenu').classList.remove('open');
  setTimeout(() => escScrollTo(id), 180);
}
function closeMobMenu() {
  document.getElementById('navBurger').classList.remove('open');
  document.getElementById('mobMenu').classList.remove('open');
}

// ══════════ PROGRESS BAR
function updateProgress() {
  const total = 8;
  const pct = Math.round((S.step / total) * 100);
  const fill  = document.getElementById('bpFill');
  const label = document.getElementById('bpLabel');
  const pctEl = document.getElementById('bpPct');
  if (fill)  fill.style.width = pct + '%';
  if (label) label.textContent = t('bp.label', S.step, total);
  if (pctEl) pctEl.textContent = pct + '%';
}

// ══════════ STATUS MODAL
function openStatusModal() {
  document.getElementById('statusModal').classList.add('open');
  document.getElementById('statusRef').focus();
}
function closeStatusModal() {
  document.getElementById('statusModal').classList.remove('open');
  document.getElementById('statusResult').style.display = 'none';
  document.getElementById('statusError').style.display  = 'none';
  document.getElementById('statusRef').value     = '';
  document.getElementById('statusSurname').value = '';
}
async function checkStatus() {
  const ref     = document.getElementById('statusRef').value.trim().toUpperCase();
  const surname = document.getElementById('statusSurname').value.trim();
  const errEl   = document.getElementById('statusError');
  const resEl   = document.getElementById('statusResult');
  const btn     = document.getElementById('statusBtn');

  errEl.style.display = 'none';
  resEl.style.display = 'none';

  if (!ref || !surname) {
    errEl.textContent = lang === 'sr' ? 'Unesite broj rezervacije i prezime.' : 'Please enter your booking ref and surname.';
    errEl.style.display = 'block';
    return;
  }

  btn.disabled = true;
  btn.querySelector('span').textContent = '...';

  try {
    const r = await fetch(`${API}/api/booking/status?ref=${encodeURIComponent(ref)}&lastName=${encodeURIComponent(surname)}`);
    if (r.status === 404) {
      errEl.textContent = lang === 'sr'
        ? 'Rezervacija nije pronađena. Proverite broj rezervacije i prezime.'
        : 'Reservation not found. Please check your booking ref and surname.';
      errEl.style.display = 'block';
      return;
    }
    if (!r.ok) throw new Error('server error');
    const d = await r.json();

    const isSr = lang === 'sr';
    const statusLabels = isSr ? {
      PENDING:   '⏳ Na čekanju',
      CONFIRMED: '✅ Potvrđeno',
      CANCELLED: '❌ Otkazano',
    } : {
      PENDING:   '⏳ Pending',
      CONFIRMED: '✅ Confirmed',
      CANCELLED: '❌ Cancelled',
    };
    const statusMsgs = isSr ? {
      PENDING:   'Vaš upit je primljen. Kontaktiraćemo vas u roku od 24h sa detaljima za plaćanje.',
      CONFIRMED: 'Rezervacija potvrđena! Vaše iznenađenje putovanje je osigurano. Vidimo se na aerodromu! ✈',
      CANCELLED: 'Ova rezervacija je otkazana. Kontaktirajte nas ukoliko smatrate da je ovo greška.',
    } : {
      PENDING:   'Your inquiry has been received. We will contact you within 24h with payment details.',
      CONFIRMED: 'Booking confirmed! Your surprise trip is secured. See you at the airport! ✈',
      CANCELLED: 'This booking has been cancelled. Contact us if you think this is a mistake.',
    };
    const lbl = isSr ? {
      leadTraveler: 'Nosilac rezervacije',
      depAirport:   'Aerodrom polaska',
      travelDates:  'Datumi putovanja',
      travelers:    'Putnici',
      names:        'Imena',
    } : {
      leadTraveler: 'Lead traveler',
      depAirport:   'Departure airport',
      travelDates:  'Travel dates',
      travelers:    'Travelers',
      names:        'Names',
    };

    const airportNames = { BEG:'Beograd (BEG)', INI:'Niš (INI)', ZAG:'Zagreb (ZAG)', BUD:'Budimpešta (BUD)', TIM:'Timișoara (TIM)' };
    const dep = new Date(d.departureDate).toLocaleDateString(isSr ? 'sr-RS' : 'en-GB', {day:'numeric',month:'short',year:'numeric'});
    const ret = new Date(d.returnDate).toLocaleDateString(isSr ? 'sr-RS' : 'en-GB', {day:'numeric',month:'short',year:'numeric'});

    resEl.innerHTML = `
      <div>
        <div class="sr-label">${lbl.leadTraveler}</div>
        <div class="sr-name">${d.firstName}${d.lastName ? ' ' + d.lastName : ''}</div>
        <div class="sr-ref">${d.bookingRef}</div>
      </div>
      <span class="sr-badge ${d.status}">${statusLabels[d.status] || d.status}</span>
      <div class="sr-info">
        <div class="sr-row">
          <span class="sr-row-label">${lbl.depAirport}</span>
          <span class="sr-row-val">${airportNames[d.departureAirport] || d.departureAirport}</span>
        </div>
        <div class="sr-row">
          <span class="sr-row-label">${lbl.travelDates}</span>
          <span class="sr-row-val">${dep} → ${ret}</span>
        </div>
        <div class="sr-row">
          <span class="sr-row-label">${lbl.travelers}</span>
          <span class="sr-row-val">${d.numberOfTravelers}</span>
        </div>
        ${d.passengerNames && d.passengerNames.length ? `
        <div class="sr-row sr-row-passengers">
          <span class="sr-row-label">${lbl.names}</span>
          <span class="sr-row-val sr-passengers">${d.passengerNames.join('<br>')}</span>
        </div>` : ''}
      </div>
      <div class="sr-msg ${d.status}">${statusMsgs[d.status] || ''}</div>
    `;
    resEl.style.display = 'flex';
  } catch(e) {
    errEl.textContent = lang === 'sr' ? 'Greška. Pokušaj ponovo.' : 'Error. Please try again.';
    errEl.style.display = 'block';
  } finally {
    btn.disabled = false;
    btn.querySelector('span').textContent = lang === 'sr' ? 'Proveri →' : 'Check →';
  }
}

// ══════════ SCROLL TO TOP visibility
window.addEventListener('scroll', () => {
  document.getElementById('scrollTop')?.classList.toggle('visible', window.scrollY > 400);
}, { passive: true });

function togFaq(item) {
  const isOpen = item.classList.contains('open');
  document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));
  if (!isOpen) item.classList.add('open');
}

function setLang(l) {
  lang = l;
  localStorage.setItem('esc-lang', l);
  document.querySelectorAll('.lang-btn').forEach(b=>b.classList.toggle('on',b.textContent===l.toUpperCase()));
  // Uvek primeni prevod bez uslova — garantuje tačan prevod pri svakom prelasku
  document.querySelectorAll('[data-i18n]').forEach(el=>{ el.textContent = t(el.dataset.i18n); });
  document.querySelectorAll('[data-i18n-html]').forEach(el=>{ el.innerHTML = t(el.dataset.i18nHtml); });
  document.querySelectorAll('[data-i18n-ph]').forEach(el=>{ el.placeholder = t(el.dataset.i18nPh); });
  // Re-renderuj sve dinamičke delove
  renderSteps(); updateProgress();
  if(S.dates.length) renderDatesFromCache();          // lista termina u koraku 3
  if(S.destinations.length) { buildCarousel(); renderExclGrid(); }
  // Re-renderuj formu putnika sačuvavši unesene vrednosti
  if(document.querySelectorAll('.pax-item').length > 0) {
    const savedPax = Array.from({length:S.travelers},(_,i)=>({
      name:   (document.getElementById('pn'+i)||{}).value||'',
      gender: (document.getElementById('pg'+i)||{}).value||'M',
      dob_d:  (document.getElementById('pd-d-'+i)||{}).value||'',
      dob_m:  (document.getElementById('pd-m-'+i)||{}).value||'',
      dob_y:  (document.getElementById('pd-y-'+i)||{}).value||'',
      visa:   (document.getElementById('pv'+i)||{}).value||''
    }));
    renderPax();
    savedPax.forEach((p,i)=>{
      const n=document.getElementById('pn'+i);    if(n) n.value=p.name;
      const g=document.getElementById('pg'+i);    if(g) g.value=p.gender;
      const dd=document.getElementById('pd-d-'+i);if(dd) dd.value=p.dob_d;
      const dm=document.getElementById('pd-m-'+i);if(dm) dm.value=p.dob_m;
      const dy=document.getElementById('pd-y-'+i);if(dy) dy.value=p.dob_y;
      const v=document.getElementById('pv'+i);    if(v) v.value=p.visa;
    });
  }
  if(S.selectedDateId) loadPrice();
  updateSummaryCard();
}

function escScrollTo(id) {
  document.getElementById(id)?.scrollIntoView({behavior:'smooth', block:'start'});
}

// ══════════ DESTINATION IMAGES
// Slike su lokalno čuvane u: wp-content/themes/escapii-theme/images/destinations/
// Izvor: Unsplash.com (besplatna Unsplash licenca za komercijalnu upotrebu)
const IMG_BASE = '<?php echo get_template_directory_uri(); ?>/images/destinations';

// Slike u folderu se zovu isto kao destinacije (lowercase, bez dijakritika, bez razmaka).
// Za nekoliko gradova postoji razlika između srpskog naziva i naziva fajla — override mapa.
const IMG_OVERRIDE = {
  'alikante':   'alicante',
  'bazelmuluz': 'bazel',
  'geteborg':   'getebourg',
  'larnaka':    'kipar',
  'memingen':   'memmingen',
};
function destImgUrl(name) {
  const slug = name.toLowerCase()
    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
    .replace(/[^a-z0-9]+/g, '');
  return `${IMG_BASE}/${IMG_OVERRIDE[slug] || slug}.jpg`;
}

// Serbian → English city name translation
const CITY_EN = {
  'Alikante':'Alicante','Atina':'Athens','Bazel-Muluz':'Basel-Mulhouse',
  'Beč':'Vienna','Brisel':'Brussels','Budimpešta':'Budapest',
  'Bukurešt':'Bucharest','Cirih':'Zurich','Firenca':'Florence',
  'Fridrihshafen':'Friedrichshafen','Geteborg':'Gothenburg',
  'Karlsrue':'Karlsruhe','Keln':'Cologne','Krit':'Crete',
  'Larnaka':'Larnaca','Lisabon':'Lisbon','Malme':'Malmö',
  'Memingen':'Memmingen','Milano':'Milan','Minhen':'Munich',
  'Nica':'Nice','Pariz':'Paris','Rim':'Rome','Sardinija':'Sardinia',
  'Sicilija':'Sicily','Sofija':'Sofia','Solun':'Thessaloniki',
  'Stokholm':'Stockholm','Varšava':'Warsaw','Venecija':'Venice',
  'Ženeva':'Geneva',
};
function destDisplayName(name) {
  return lang === 'en' ? (CITY_EN[name] || name) : name;
}

function airportImgUrl(code) {
  const map = { BEG:'beograd', INI:'nis', ZAG:'zagreb', BUD:'budimpesta', TIM:'timisoara' };
  return `${IMG_BASE}/${map[code] || 'beograd'}.jpg`;
}

// ══════════ STATE
// Countries loaded from backend — see loadCountries()

const FLAGS = {RS:'🇷🇸',DE:'🇩🇪',FR:'🇫🇷',ES:'🇪🇸',IT:'🇮🇹',GB:'🇬🇧',NL:'🇳🇱',SE:'🇸🇪',
               PT:'🇵🇹',AT:'🇦🇹',MT:'🇲🇹',CY:'🇨🇾',GR:'🇬🇷',HR:'🇭🇷',BA:'🇧🇦',SK:'🇸🇰',
               CZ:'🇨🇿',PL:'🇵🇱',UA:'🇺🇦',RO:'🇷🇴',BG:'🇧🇬',MK:'🇲🇰',AL:'🇦🇱',CH:'🇨🇭',
               BE:'🇧🇪',LU:'🇱🇺',TR:'🇹🇷',FI:'🇫🇮',DK:'🇩🇰',NO:'🇳🇴',IE:'🇮🇪',HU:'🇭🇺'};

const S = {
  step:1, airport:null, travelers:1,
  selectedDateId:null, selectedDate:null, accommodationType:'STANDARD',
  cabinSuitcaseCount:0, hasInsurance:false, hasBreakfast:false, hasSeatsTogether:false, hasConnectingFlights:false,
  excludedIds:[], passengers:[], destinations:[], allDestinations:[], dates:[], countries:[],
  lastPrice:null
};

// ══════════ COUNTRIES (from backend — no external API dependency)
async function loadCountries() {
  try {
    const r = await fetch(`${API}/api/destinations/countries`);
    if (!r.ok) throw new Error();
    S.countries = await r.json();
  } catch(e) {
    // fallback: empty array — Choices.js will show empty dropdown
    S.countries = [];
  }
}

// ══════════ CAROUSEL
function showCarouselSkeleton() {
  const track = document.getElementById('carouselTrack');
  if (!track) return;
  track.innerHTML = Array(10).fill(0).map(() =>
    `<div class="dest-card-c skel-card"><div class="skel-shimmer" style="width:100%;height:100%;"></div></div>`
  ).join('');
}

async function loadDestinations() {
  showCarouselSkeleton();
  try {
    const [rActive, rAll] = await Promise.all([
      fetch(`${API}/api/destinations`),
      fetch(`${API}/api/destinations/all`)
    ]);
    if (!rActive.ok || !rAll.ok) throw new Error();
    S.destinations    = await rActive.json();
    S.allDestinations = await rAll.json();
    const count = Math.max(S.destinations.length, 50);
    document.getElementById('destCount').textContent = count + '+';
    document.getElementById('statsDestCount').textContent = count + '+';
    buildCarousel();
    renderExclGrid();
  } catch(e) {
    // fallback static carousel if backend is offline
    buildCarousel();
  }
}

const FALLBACK_DESTS = [
  {id:1,name:'Pariz',country:'FR'},{id:2,name:'Barcelona',country:'ES'},
  {id:3,name:'Rim',country:'IT'},{id:4,name:'Amsterdam',country:'NL'},
  {id:5,name:'Beč',country:'AT'},{id:6,name:'Prag',country:'CZ'},
  {id:7,name:'London',country:'GB'},{id:8,name:'Atina',country:'GR'},
  {id:9,name:'Lisabon',country:'PT'},{id:10,name:'Malta',country:'MT'},
  {id:11,name:'Budimpešta',country:'HU'},{id:12,name:'Berlin',country:'DE'},
  {id:13,name:'Krakow',country:'PL'},{id:14,name:'Minhen',country:'DE'},
  {id:15,name:'Stokholm',country:'SE'}
];

// Prevod naziva destinacija za carousel (EN → SR)
const CAROUSEL_DEST_SR = {
  'Athens':'Atina','Rome':'Rim','Paris':'Pariz','Lisbon':'Lisabon',
  'Vienna':'Beč','Prague':'Prag','Amsterdam':'Amsterdam','Barcelona':'Barselona',
  'Madrid':'Madrid','London':'London','Munich':'Minhen','Budapest':'Budimpešta',
  'Crete':'Krit','Rhodes':'Rodos','Corfu':'Krf','Mykonos':'Mikonos',
  'Santorini':'Santorini','Thessaloniki':'Solun','Florence':'Firenca',
  'Venice':'Venecija','Naples':'Napulj','Milan':'Milano','Turin':'Torino',
  'Seville':'Sevilja','Valencia':'Valensija','Ibiza':'Ibiza','Mallorca':'Majorka',
  'Tenerife':'Tenerife','Nice':'Nica','Marseille':'Marsej','Lyon':'Lion',
  'Brussels':'Brisel','Copenhagen':'Kopenhagen','Stockholm':'Stokholm',
  'Warsaw':'Varšava','Krakow':'Krakov','Bucharest':'Bukurešt','Sofia':'Sofija',
  'Istanbul':'Istanbul','Dubrovnik':'Dubrovnik','Split':'Split','Malta':'Malta',
  'Salzburg':'Zalcburg','Zurich':'Cirih','Geneva':'Ženeva','Edinburgh':'Edinburg',
};
function carouselDestName(d) {
  if (lang === 'en') {
    // Backend šalje engleski naziv → ostavi ga; fallback lista ima srpski → prevedi
    return CITY_EN[d.name] || d.name;
  }
  // SR: backend šalje engleski → prevedi; fallback lista srpski → ostavi
  return CAROUSEL_DEST_SR[d.name] || d.name;
}

function buildCarousel() {
  const pool     = S.allDestinations.length ? S.allDestinations : (S.destinations.length ? S.destinations : FALLBACK_DESTS);
  const shuffled = [...pool].sort(() => Math.random() - 0.5);
  const track    = document.getElementById('carouselTrack');
  const html     = [...shuffled, ...shuffled].map(d => `
    <div class="dest-card-c">
      <img src="${destImgUrl(d.name)}" alt="${d.name}" loading="lazy">
      <div class="dest-card-label">
        <div class="dest-card-label-name">${carouselDestName(d)}</div>
      </div>
    </div>
  `).join('');
  track.innerHTML = html;
}

// ══════════ AIRPORT NAME LOOKUP
const AIRPORT_NAMES = {
  sr: { BEG: 'Beograd (BEG)', INI: 'Niš (INI)', ZAG: 'Zagreb (ZAG)', BUD: 'Budimpešta (BUD)', TIM: 'Temišvar (TIM)' },
  en: { BEG: 'Belgrade (BEG)', INI: 'Niš (INI)', ZAG: 'Zagreb (ZAG)', BUD: 'Budapest (BUD)', TIM: 'Timișoara (TIM)' }
};
function airportName(code) {
  return (AIRPORT_NAMES[lang] || AIRPORT_NAMES.sr)[code] || code;
}

// ══════════ WAITLIST
async function submitWaitlist() {
  const emailEl = document.getElementById('waitlistEmail');
  const email   = emailEl ? emailEl.value.trim() : '';

  if (!email || !email.includes('@')) {
    if (emailEl) emailEl.style.borderColor = '#ef4444';
    return;
  }

  const airportCode = S.airport || 'BEG';
  const aName = airportName(airportCode);

  function waitlistHtml(key) {
    return t(key).replace('{email}', `<strong>${email}</strong>`).replace('{airportName}', `<strong>${aName}</strong>`);
  }

  try {
    const hp = (document.getElementById('waitlistHp') || {}).value || '';
    const r = await fetch(`${API}/api/waitlist`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email, airport: airportCode, hp })
    });
    const data = await r.json();

    if (data.status === 'already_subscribed') {
      Swal.fire({
        icon: 'info',
        title: t('waitlist.swal.already.title'),
        html: `<p style="color:rgba(255,255,255,.8);font-size:15px;line-height:1.6">${waitlistHtml('waitlist.swal.already.html')}</p>`,
        confirmButtonText: 'OK',
        confirmButtonColor: '#CA8A71',
        background: '#2D5F6B',
        color: '#fff',
        backdrop: 'rgba(0,0,0,0.55)',
        customClass: { popup: 'swal-escapii' }
      });
    } else {
      Swal.fire({
        icon: 'success',
        iconColor: '#4ade80',
        title: t('waitlist.swal.ok.title'),
        html: `<p style="color:rgba(255,255,255,.8);font-size:15px;line-height:1.6">${waitlistHtml('waitlist.swal.ok.html')}</p>`,
        confirmButtonText: 'OK',
        confirmButtonColor: '#CA8A71',
        background: '#2D5F6B',
        color: '#fff',
        backdrop: 'rgba(0,0,0,0.55)',
        customClass: { popup: 'swal-escapii' }
      });
      if (emailEl) emailEl.value = '';
    }
  } catch(e) {
    Swal.fire({
      icon: 'error',
      title: t('waitlist.swal.err.title'),
      text: t('waitlist.swal.err.text'),
      confirmButtonColor: '#CA8A71',
      background: '#2D5F6B',
      color: '#fff'
    });
  }
}

// ══════════ STEP NAV
function renderSteps() {
  const lbs = t('steps');
  document.getElementById('stepsNav').innerHTML = lbs.map((lb,i) => {
    const n=i+1, cls=n<S.step?'done':n===S.step?'active':'';
    return `<div class="sn-item ${cls}"><div class="sn-dot">${n<S.step?'✓':n}</div><div class="sn-label">${lb}</div></div>`;
  }).join('');
}

function scrollToStepTop() {
  requestAnimationFrame(() => {
    const nav = document.getElementById('stepsNav');
    if(nav) {
      const top = nav.getBoundingClientRect().top + window.scrollY - 90;
      window.scrollTo({ top, behavior: 'smooth' });
    }
  });
}

function showStep(n, scroll = true) {
  document.querySelectorAll('.step-wrap').forEach(c => c.classList.remove('on'));
  document.getElementById('step'+n)?.classList.add('on');
  document.querySelector('.form-alert')?.remove();
  renderSteps();
  updateProgress();
  if(scroll) scrollToStepTop();
}

function isAtLeast18(dob) {
  const [y, m, d] = dob.split('-').map(Number);
  const today = new Date();
  const limit = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
  return new Date(y, m - 1, d) <= limit;
}

// ══════════ FORM VALIDATION ALERT
let _alertTimer = null;
function showFormAlert(msg, title) {
  // find the visible step's card
  const card = document.querySelector('.step-wrap.on .card');
  if (!card) return;

  // remove existing
  card.querySelector('.form-alert')?.remove();

  const alertTitle = title || (lang === 'sr' ? 'Nedostaju podaci' : 'Missing information');

  const el = document.createElement('div');
  el.className = 'form-alert';
  el.innerHTML = `
    <div class="form-alert-icon">!</div>
    <div class="form-alert-body">
      <div class="form-alert-title">${alertTitle}</div>
      <div class="form-alert-msg">${msg}</div>
    </div>
    <button class="form-alert-close" onclick="this.closest('.form-alert').remove()">×</button>
  `;

  // insert after h2+hint, before first form field
  const hint = card.querySelector('.hint') || card.querySelector('h2');
  if (hint && hint.nextSibling) {
    card.insertBefore(el, hint.nextSibling);
  } else {
    card.prepend(el);
  }

  clearTimeout(_alertTimer);
  _alertTimer = setTimeout(() => el.remove(), 6000);
}

function validatePassengers() {
  let ok = true;
  let underage = false;
  for(let i=0;i<S.travelers;i++){
    const name=(document.getElementById('pn'+i)||{}).value||'';
    const wrap=document.getElementById('pf-name-'+i);
    if(!name.trim()){
      if(wrap) wrap.classList.add('field-error');
      ok=false;
    } else {
      if(wrap) wrap.classList.remove('field-error');
    }
    const dob = getPaxDob(i);
    const dobWrap = document.getElementById('pf-dob-'+i);
    if(!isAtLeast18(dob)){
      if(dobWrap) dobWrap.classList.add('field-error');
      ok=false; underage=true;
    } else {
      if(dobWrap) dobWrap.classList.remove('field-error');
    }
  }
  if(!ok) {
    const firstErr = document.querySelector('#step7 .field-error');
    if (firstErr) {
      const top = firstErr.getBoundingClientRect().top + window.scrollY - 120;
      window.scrollTo({ top, behavior: 'instant' });
    }
    const msg = underage ? t('pax.dob.err') : (lang === 'sr' ? 'Unesite ime za svakog putnika.' : 'Please enter a name for each traveler.');
    showFormAlert(msg);
  }
  return ok;
}

function nextStep() {
  if(S.step===7 && !validatePassengers()) return;
  S.step++; onEnter(); showStep(S.step);
}
function prevStep() {
  const from = S.step;
  S.step--; onEnter();
  showStep(S.step, !(from === 7 && S.step === 6));
}

function onEnter() {
  if(S.step===3) loadDates();
  if(S.step===4) updateSingleNotice();
  if(S.step===5) { updateSuitUI(); updateSeatsVisibility(); }
  if(S.step===6) updateExclStep();
  if(S.step===7) {
    // Renderuj formu samo ako broj putnika ne odgovara — ne resetuj popunjena polja
    if(document.querySelectorAll('.pax-item').length !== S.travelers) renderPax();
    loadPrice();
  }
  if(S.step===8) updateSummaryCard();
}

// ══════════ STEP 1
function pickAirport(el, code) {
  document.querySelectorAll('.airport-card').forEach(o => o.classList.remove('on'));
  el.classList.add('on');
  S.airport = code;
  document.getElementById('btnN1').disabled = false;
  // Učitaj destinacije filtrowane po aerodromu (za grid isključivanja u koraku 6)
  loadDestinationsByAirport(code);
}

async function loadDestinationsByAirport(airport) {
  try {
    const r = await fetch(`${API}/api/destinations?airport=${airport}`);
    if (!r.ok) throw new Error();
    S.destinations = await r.json();
    renderExclGrid();
  } catch(e) { /* fallback — ostaje prethodni S.destinations */ }
}

// ══════════ STEP 2
function chTrav(d) {
  S.travelers = Math.min(6, Math.max(1, S.travelers+d));
  document.getElementById('travN').textContent = S.travelers;
  document.getElementById('travD').disabled = S.travelers<=1;
  document.getElementById('travU').disabled = S.travelers>=6;
  if(S.cabinSuitcaseCount > S.travelers) S.cabinSuitcaseCount = S.travelers;
  updateSingleNotice();
  updateSeatsNotice();
  updateSeatsVisibility();
  // Re-render dates da se azuriraju disabled statusi
  if(S.dates.length) renderDatesFromCache();
}

function buildDateRow(d) {
  const ms = ['jan','feb','mar','apr','maj','jun','jul','avg','sep','okt','nov','dec'];
  const daysSr = ['Ned','Pon','Uto','Sre','Čet','Pet','Sub'];
  const daysEn = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
  const [,dm,dd] = d.departureDate.split('-');
  const [,rm,rd] = d.returnDate.split('-');
  const depDay = +dd; const retDay = +rd;
  const depMon = ms[+dm-1]; const retMon = ms[+rm-1];
  const depDow = (lang==='sr' ? daysSr : daysEn)[new Date(d.departureDate).getDay()];
  const retDow = (lang==='sr' ? daysSr : daysEn)[new Date(d.returnDate).getDay()];
  const notEnoughSlots = d.availableSlots < S.travelers;
  const isLowStock     = d.availableSlots <= 5 && !notEnoughSlots;
  const stockBadge = notEnoughSlots
    ? `<span class="sold-out-badge">⛔ ${lang==='sr'?`Samo ${d.availableSlots} mesta`:`Only ${d.availableSlots} spots`}</span>`
    : isLowStock
      ? `<span class="low-stock-badge">${lang==='sr'?`Ostalo ${d.availableSlots}`:`${d.availableSlots} left`}</span>`
      : '';
  const tooltipText = notEnoughSlots
    ? (lang==='sr'
        ? `Nema dovoljno mesta — izabrali ste ${S.travelers} putnika, a dostupno je samo ${d.availableSlots} mesta.`
        : `Not enough spots — you selected ${S.travelers} travelers but only ${d.availableSlots} spots are available.`)
    : '';
  const isSelected = S.selectedDateId === d.id;
  const cls = notEnoughSlots ? 'date-row disabled' : `date-row${isSelected?' on':''}`;
  const onclick = notEnoughSlots ? '' : `onclick="pickDate(this,${d.id},${JSON.stringify(d).replace(/"/g,'&quot;')})"`;
  const tooltip = notEnoughSlots ? `data-tippy-content="${tooltipText}"` : '';
  const nightLabel = lang==='sr' ? `${d.numberOfNights} noći` : `${d.numberOfNights} nights`;
  return `<div class="${cls}" ${onclick} ${tooltip}>
    <div class="dr-segment">
      <div class="dr-date-block">
        <div class="dr-dayname">${depDow}</div>
        <div class="dr-daynum">${depDay}</div>
        <div class="dr-month">${depMon}</div>
      </div>
      <div class="dr-divider"><div class="dr-line"></div><div class="dr-plane">✈</div><div class="dr-line"></div></div>
      <div class="dr-date-block">
        <div class="dr-dayname">${retDow}</div>
        <div class="dr-daynum">${retDay}</div>
        <div class="dr-month">${retMon}</div>
      </div>
      <div class="dr-meta">
        <div class="dr-nights">${nightLabel}</div>
        ${stockBadge}
      </div>
    </div>
    <div class="dr-price-block">
      <div class="dr-price">${d.basePrice}€</div>
      <div class="dr-per">${t('per.p')}</div>
    </div>
  </div>`;
}

function renderDatesFromCache() {
  const el = document.getElementById('datesList');
  if(!el || !S.dates.length) return;

  const MONTHS_SR = ['Januar','Februar','Mart','April','Maj','Jun','Jul','Avgust','Septembar','Oktobar','Novembar','Decembar'];
  const MONTHS_EN = ['January','February','March','April','May','June','July','August','September','October','November','December'];

  // Grupišemo po mesecu
  const groups = {};
  S.dates.forEach(d => {
    const [y,m] = d.departureDate.split('-');
    const key = `${y}-${m}`;
    if(!groups[key]) groups[key] = { year:+y, month:+m, dates:[] };
    groups[key].dates.push(d);
  });

  const sortedKeys = Object.keys(groups).sort();
  const hasSelected = S.selectedDateId != null;

  el.innerHTML = sortedKeys.map((key, i) => {
    const g = groups[key];
    const mName = lang==='sr' ? MONTHS_SR[g.month-1] : MONTHS_EN[g.month-1];
    const available = g.dates.filter(d => d.availableSlots >= S.travelers).length;
    const total = g.dates.length;
    // Otvori prvi mesec ili mesec selektovanog datuma
    const hasSelectedInGroup = g.dates.some(d => d.id === S.selectedDateId);
    const isOpen = hasSelectedInGroup || (!hasSelected && i === 0);
    return `<div class="month-group">
      <div class="month-header${isOpen?' open':''}" onclick="toggleMonth(this)">
        <div>
          <div class="month-name">${mName} ${g.year}</div>
          <div class="month-meta">${available}/${total} ${lang==='sr'?'termina dostupno':'dates available'}</div>
        </div>
        <div class="month-chevron">⌄</div>
      </div>
      <div class="month-body${isOpen?' open':''}">
        ${g.dates.map(d => buildDateRow(d)).join('')}
      </div>
    </div>`;
  }).join('');

  tippy('[data-tippy-content]', { theme:'escapii', placement:'top', arrow:true, duration:[200,150] });

  if(S.selectedDateId) {
    const sel = S.dates.find(d => d.id === S.selectedDateId);
    if(sel && sel.availableSlots < S.travelers) {
      S.selectedDateId = null; S.selectedDate = null;
    }
  }
}

function toggleMonth(header) {
  const body = header.nextElementSibling;
  const isOpen = header.classList.contains('open');
  header.classList.toggle('open', !isOpen);
  body.classList.toggle('open', !isOpen);
}

function updateSingleNotice() {
  const notice = document.getElementById('singleNotice');
  if(notice) notice.style.display = S.travelers === 1 ? 'block' : 'none';
}

// ══════════ STEP 3
function skelDateRow() {
  return `<div class="date-row skel-card" style="pointer-events:none;gap:12px">
    <div class="dr-segment">
      <div class="dr-date-block" style="display:flex;flex-direction:column;gap:5px">
        <div class="skel-shimmer" style="height:11px;width:26px;border-radius:4px"></div>
        <div class="skel-shimmer" style="height:22px;width:26px;border-radius:6px"></div>
        <div class="skel-shimmer" style="height:10px;width:26px;border-radius:4px"></div>
      </div>
      <div style="display:flex;flex-direction:column;gap:7px;flex:1">
        <div class="skel-shimmer" style="height:14px;width:55%;border-radius:6px"></div>
        <div class="skel-shimmer" style="height:12px;width:35%;border-radius:4px"></div>
      </div>
    </div>
    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px">
      <div class="skel-shimmer" style="height:20px;width:64px;border-radius:6px"></div>
      <div class="skel-shimmer" style="height:11px;width:40px;border-radius:4px"></div>
    </div>
  </div>`;
}

async function loadDates() {
  const el = document.getElementById('datesList');
  el.innerHTML = `<div style="display:flex;flex-direction:column;gap:8px">${Array(5).fill(0).map(skelDateRow).join('')}</div>`;
  try {
    const r = await fetch(`${API}/api/dates?airport=${S.airport}`);
    S.dates = await r.json();
    if(!S.dates.length) {
      const aName = airportName(S.airport || 'BEG');
      el.innerHTML=`
        <div class="no-dates-wrap">
          <div class="no-dates-icon">✈️</div>
          <div class="no-dates-title">${t('s3.nodates.title')}</div>
          <div class="no-dates-sub">${t('s3.nodates.sub')}</div>
          <div class="no-dates-waitlist-card">
            <div class="no-dates-waitlist-label">${lang==='sr'?'Obavesti me kad se otvore termini':'Notify me when dates open up'}</div>
            <div class="waitlist-form" id="waitlistForm">
              <input type="text" id="waitlistHp" name="website" autocomplete="off" tabindex="-1"
                     style="position:absolute;left:-9999px;opacity:0;pointer-events:none;" value="">
              <input class="waitlist-input" id="waitlistEmail" type="email" placeholder="${t('waitlist.ph')}">
              <button class="waitlist-btn" onclick="submitWaitlist()">${t('s3.nodates.btn')}</button>
            </div>
            <div class="waitlist-msg" id="waitlistMsg" style="display:none;margin-top:10px"></div>
          </div>
          <button class="no-dates-back" onclick="S.step=1;onEnter();showStep(1)">
            ← ${lang==='sr'?'Promeni aerodrom':'Change airport'}
          </button>
        </div>`;
      return;
    }
    renderDatesFromCache();

  } catch(e) {
    el.innerHTML=`<div style="color:#f87171;text-align:center;padding:30px;">${t('err.dates.load')}</div>`;
  }
}

function pickDate(el,id,d) {
  document.querySelectorAll('.date-row').forEach(r => r.classList.remove('on'));
  el.classList.add('on');
  S.selectedDateId = id;
  S.selectedDate = d;
  document.getElementById('btnN3').disabled = false;
}

// ══════════ STEP 4
function pickAccom(el, type) {
  document.querySelectorAll('.accom-tile').forEach(c => c.classList.remove('on'));
  el.classList.add('on');
  S.accommodationType = type;
}

// ══════════ STEP 5
function togExtra(el, key) {
  S[key] = !S[key];
  el.classList.toggle('on', S[key]);
}

function updateSeatsVisibility() {
  const card = document.getElementById('ec-hasSeatsTogether');
  if (!card) return;
  if (S.travelers <= 1) {
    card.style.display = 'none';
    // Reset state ako je bio upaljen
    S.hasSeatsTogether = false;
    card.classList.remove('on');
  } else {
    card.style.display = '';
  }
}

function togSeats(el) {
  S.hasSeatsTogether = !S.hasSeatsTogether;
  el.classList.toggle('on', S.hasSeatsTogether);
  updateSeatsNotice();
}

function updateSeatsNotice() {
  const notice = document.getElementById('seatsNotice');
  const text   = document.getElementById('seatsNoticeText');
  if (!notice || !text) return;

  if (!S.hasSeatsTogether || S.travelers <= 1) {
    notice.style.display = 'none';
    return;
  }

  const n = S.travelers;
  const totalCost = n * 24; // 12€/os/smer × 2 smera = 24€/os
  let arrangement = '';

  if (n <= 3) {
    arrangement = lang === 'sr'
      ? `Bićete smešteni zajedno (${n} mesta u redu).`
      : `You will all sit together (${n} seats in a row).`;
  } else if (n === 4) {
    arrangement = lang === 'sr'
      ? 'Sedi ćete <strong>2 + 2</strong> zajedno (po 2 u redu).'
      : 'You will sit <strong>2 + 2</strong> together (2 per row).';
  } else if (n === 5) {
    arrangement = lang === 'sr'
      ? 'Sedi ćete <strong>3 + 2</strong> zajedno (3 u jednom redu, 2 u drugom).'
      : 'You will sit <strong>3 + 2</strong> together (3 in one row, 2 in another).';
  } else {
    arrangement = lang === 'sr'
      ? 'Sedi ćete <strong>3 + 3</strong> zajedno (po 3 u redu).'
      : 'You will sit <strong>3 + 3</strong> together (3 per row).';
  }

  const priceInfo = lang === 'sr'
    ? `Sedišta zajedno važe u <strong>oba smera</strong> — 12€/os/smer = <strong>${totalCost}€ ukupno</strong> za ${n} putnika.`
    : `Seats together apply on <strong>both flights</strong> — 12€/person/way = <strong>${totalCost}€ total</strong> for ${n} travelers.`;

  text.innerHTML = `${arrangement}<br><span style="color:var(--accent);">${priceInfo}</span>`;
  notice.style.display = 'block';
}
function chSuit(d) {
  S.cabinSuitcaseCount = Math.min(S.travelers, Math.max(0, S.cabinSuitcaseCount+d));
  updateSuitUI();
}
function updateSuitUI() {
  document.getElementById('suitN').textContent = S.cabinSuitcaseCount;
  document.getElementById('suitPrice').textContent = S.cabinSuitcaseCount*100+'€';
  document.getElementById('suitD').disabled = S.cabinSuitcaseCount<=0;
  document.getElementById('suitU').disabled = S.cabinSuitcaseCount>=S.travelers;
}

// ══════════ STEP 6
function updateExclStep() {
  const isINI = S.airport === 'INI';

  // Re-renduj grid sa destinacijama iz izabranog datuma
  renderExclGrid();

  // Ako je INI i korisnik je već izabrao >2 isključivanja, obreži na max 2
  if (isINI && S.excludedIds.length > 2) {
    S.excludedIds = S.excludedIds.slice(0, 2);
    document.querySelectorAll('.excl-tile.on').forEach(t => {
      const tileId = parseInt(t.id.replace('ex-', ''));
      if (!S.excludedIds.includes(tileId)) t.classList.remove('on');
    });
  }

  // Ažuriraj tier prikaz i hint tekst za INI vs BEG
  const tier2Label = document.getElementById('exclTier2Label');
  const tier2Price = document.getElementById('exclTier2Price');
  const hint       = document.querySelector('#step6 .hint');
  const note       = document.getElementById('exclNote');

  // Svi aerodromi: max 3, cena 15€/os. za 2. i 3.
  if (tier2Label) tier2Label.textContent = lang === 'en' ? '2nd & 3rd exclusion' : '2. i 3. isključivanje';
  if (tier2Price) { tier2Price.textContent = '+15€/os.'; tier2Price.className = 'excl-tier-price high'; }
  if (hint)       hint.textContent = lang === 'en' ? 'Destinations you want to exclude (optional, max 3)' : 'Destinacije koje ne želite (opciono, max 3)';
  if (note)       note.textContent = lang === 'en' ? 'We recommend up to 3 exclusions — fewer exclusions means more of a surprise!' : 'Preporučujemo do 3 isključivanja — manje isključivanja znači više iznenađenja!';

  loadPrice();
}

function renderExclGrid() {
  document.getElementById('exclGrid').innerHTML = S.destinations.map(d => `
    <div class="excl-tile" id="ex-${d.id}" onclick="togExcl(${d.id})">
      <img src="${destImgUrl(d.name)}" alt="${d.name}" loading="lazy">
      <div class="excl-overlay">
        <div class="excl-name">${destDisplayName(d.name)}</div>
      </div>
      <div class="excl-x">✕</div>
    </div>`
  ).join('');
}
function togExcl(id, event) {
  const i = S.excludedIds.indexOf(id);
  if (i > -1) {
    // removing exclusion
    S.excludedIds.splice(i, 1);
    document.getElementById('ex-'+id)?.classList.remove('on');
  } else {
    const maxExcl = 3;
    if (S.excludedIds.length >= maxExcl) {
      Swal.fire({
        background: '#2D5F6B',
        color: '#fff',
        icon: 'info',
        iconColor: '#CA8A71',
        title: `<span style="color:#CA8A71;font-size:20px">${t('swal.excl.title')}</span>`,
        html: `<p style="color:rgba(255,255,255,.8);font-size:15px;line-height:1.6">${t('swal.excl.html')}</p>`,
        confirmButtonText: 'OK',
        confirmButtonColor: '#CA8A71',
        showClass: { popup: 'animate__animated animate__fadeInDown animate__faster' },
        hideClass: { popup: 'animate__animated animate__fadeOutUp animate__faster' },
        backdrop: 'rgba(0,0,0,0.55)',
        customClass: { popup: 'swal-escapii' }
      });
      return;
    }
    S.excludedIds.push(id);
    document.getElementById('ex-'+id)?.classList.add('on');

    // Floating price animation
    const tile = document.getElementById('ex-'+id);
    if(tile) {
      const rect = tile.getBoundingClientRect();
      const n = S.excludedIds.length;
      const label = n === 1 ? '🎁 1. gratis!' : '+15€/os.';
      const color = n === 1 ? '#22c55e' : '#CA8A71';
      const el = document.createElement('div');
      el.className = 'price-float';
      el.textContent = label;
      el.style.cssText = `left:${rect.left + rect.width/2 - 30}px;top:${rect.top + window.scrollY + rect.height/2}px;color:${color};`;
      document.body.appendChild(el);
      setTimeout(() => el.remove(), 950);
    }
  }
}

// ══════════ STEP 7 — helpers
function dobDays() {
  return Array.from({length:31},(_,i)=>`<option value="${String(i+1).padStart(2,'0')}">${i+1}.</option>`).join('');
}
function dobMonths() {
  const sr=['Januar','Februar','Mart','April','Maj','Jun','Jul','Avgust','Septembar','Oktobar','Novembar','Decembar'];
  const en=['January','February','March','April','May','June','July','August','September','October','November','December'];
  const ms = lang==='sr' ? sr : en;
  return ms.map((m,i)=>`<option value="${String(i+1).padStart(2,'0')}">${m}</option>`).join('');
}
function dobYears() {
  const cur=new Date().getFullYear();
  let o='';
  for(let y=cur-5;y>=1930;y--) o+=`<option value="${y}">${y}</option>`;
  return o;
}
function getPaxDob(i) {
  const d=document.getElementById('pd-d-'+i)?.value||'01';
  const m=document.getElementById('pd-m-'+i)?.value||'01';
  const y=document.getElementById('pd-y-'+i)?.value||'2000';
  return `${y}-${m}-${d}`;
}

const _choices = [];

function initChoices() {
  _choices.forEach(c => { try { c.destroy(); } catch(e){} });
  _choices.length = 0;
  for(let i=0;i<S.travelers;i++){
    const gSel = document.getElementById('pg'+i);
    if(gSel) {
      _choices.push(new Choices(gSel, {
        searchEnabled: false, itemSelectText: '', shouldSort: false, allowHTML: false,
      }));
    }
    const dSel = document.getElementById('pd-d-'+i);
    if(dSel) {
      _choices.push(new Choices(dSel, {
        searchEnabled: false, itemSelectText: '', shouldSort: false, allowHTML: false,
      }));
    }
    const mSel = document.getElementById('pd-m-'+i);
    if(mSel) {
      _choices.push(new Choices(mSel, {
        searchEnabled: false, itemSelectText: '', shouldSort: false, allowHTML: false,
      }));
    }
    const ySel = document.getElementById('pd-y-'+i);
    if(ySel) {
      _choices.push(new Choices(ySel, {
        searchEnabled: false, itemSelectText: '', shouldSort: false, allowHTML: false,
      }));
    }
  }
}

function renderPax() {
  document.getElementById('paxList').innerHTML = Array.from({length:S.travelers},(_,i) => `
    <div class="pax-item">
      <div class="pax-num">${t('pax.num', i+1)}</div>
      <div class="pax-fields">
        <div class="pax-field" style="grid-column:span 2" id="pf-name-${i}">
          <label>${t('pax.name')} <span class="req">*</span></label>
          <input class="pax-input" id="pn${i}" type="text" placeholder="${t('pax.ph',i+1)}">
          <div class="field-error-msg">${t('pax.name.err')}</div>
        </div>
        <div class="pax-field">
          <label>${t('pax.gender')} <span class="req">*</span></label>
          <select class="pax-select" id="pg${i}">
            <option value="M">${t('gender.m')}</option>
            <option value="F">${t('gender.f')}</option>
          </select>
        </div>
        <div class="pax-field" id="pf-dob-${i}" style="grid-column:span 2">
          <label>${t('pax.dob')} <span class="req">*</span></label>
          <div class="dob-wrap">
            <div class="dob-sel"><select class="pax-select" id="pd-d-${i}">${dobDays()}</select></div>
            <div class="dob-sel"><select class="pax-select" id="pd-m-${i}">${dobMonths()}</select></div>
            <div class="dob-sel"><select class="pax-select" id="pd-y-${i}">${dobYears()}</select></div>
          </div>
          <div class="field-error-msg">${t('pax.dob.err')}</div>
        </div>
        <div class="pax-field" style="grid-column:span 2">
          <label>${t('pax.visa')}</label>
          <input class="pax-input" id="pv${i}" type="text" placeholder="${t('pax.visa.ph')}" maxlength="500" autocomplete="off">
        </div>
        <div class="pax-field" style="grid-column:span 2">
          <label>${t('pax.passport')}</label>
          <input class="pax-input" id="pp${i}" type="text" placeholder="${t('pax.passport.ph')}" maxlength="50" autocomplete="off" style="text-transform:uppercase;">
        </div>
        <div class="pax-field" style="grid-column:span 2">
          <label class="pax-checkbox-label">
            <input type="checkbox" id="phv${i}" checked style="width:16px;height:16px;accent-color:#CA8A71;margin-right:8px;cursor:pointer;">
            ${t('pax.valid.passport')}
          </label>
        </div>
      </div>
    </div>`
  ).join('');
  setTimeout(initChoices, 0);
}

async function loadPrice() {
  if(!S.selectedDateId) return;
  try {
    const params = new URLSearchParams({
      selectedDateId: S.selectedDateId,
      numberOfTravelers: S.travelers,
      accommodationType: S.accommodationType,
      exclusionCount: S.excludedIds.length,
      cabinSuitcaseCount: S.cabinSuitcaseCount,
      hasInsurance: S.hasInsurance,
      hasBreakfast: S.hasBreakfast,
      hasSeatsTogether: S.hasSeatsTogether
    });
    const r = await fetch(`${API}/api/booking/price-preview?${params}`);
    const p = await r.json();
    S.lastPrice = p;
    const rows = document.getElementById('priceRows');
    const pp = t('per.p');
    let html = `<div class="pr-row"><span>${t('pr.base')}</span><span>${p.basePricePerPerson}€${pp}</span></div>`;
    if(p.accommodationExtraPerPerson>0) html+=`<div class="pr-row"><span>${t('pr.accom')}</span><span>+${p.accommodationExtraPerPerson}€${pp}</span></div>`;
    if(p.cabinSuitcaseTotal>0) html+=`<div class="pr-row"><span>${t('pr.suit')} (${p.cabinSuitcaseCount}×)</span><span>+${p.cabinSuitcaseTotal}€</span></div>`;
    if(p.insurancePerPerson>0) html+=`<div class="pr-row"><span>${t('pr.ins')}</span><span>+${p.insurancePerPerson}€${pp}</span></div>`;
    if(p.breakfastPerPerson>0) html+=`<div class="pr-row"><span>${t('pr.bfst')}</span><span>+${p.breakfastPerPerson}€${pp}</span></div>`;
    if(p.seatsTogtherPerPerson>0) html+=`<div class="pr-row"><span>${t('pr.seats')}</span><span>+${p.seatsTogtherPerPerson}€${pp}</span></div>`;
    if(p.exclusionCostFlat>0) html+=`<div class="pr-row"><span>${t('pr.excl')}</span><span>+${p.exclusionCostFlat}€</span></div>`;
    if(p.soloSurcharge>0) html+=`<div class="pr-row"><span>${t('pr.solo')}</span><span>+${p.soloSurcharge}€</span></div>`;
    rows.innerHTML = html;
    document.getElementById('priceTotal').textContent = p.totalEurAll+'€';
    const perPerson = p.numberOfTravelers > 1 ? Math.round(p.totalEurAll / p.numberOfTravelers) : 0;
    document.getElementById('pricePer').textContent = p.numberOfTravelers > 1 ? t('pr.pp', perPerson) : '';
  } catch(e) {
    document.getElementById('priceRows').innerHTML=`<div style="color:#f87171;font-size:13px;text-align:center;padding:10px;">${t('err.price')}</div>`;
  }
}

// ══════════ STEP 8 — SUMMARY CARD
function updateSummaryCard() {
  const el = document.getElementById('bookingSummary');
  if (!el || !S.selectedDate) return;
  el.style.display = '';

  const ms = lang === 'sr'
    ? ['jan','feb','mar','apr','maj','jun','jul','avg','sep','okt','nov','dec']
    : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  const d = S.selectedDate;
  const [,dm,dd] = d.departureDate.split('-');
  const [,rm,rd] = d.returnDate.split('-');
  const dep = `${+dd}. ${ms[+dm-1]}`;
  const ret = `${+rd}. ${ms[+rm-1]}`;
  const nightLabel = `${d.numberOfNights} ${lang==='sr'?'noći':'nights'}`;
  const airportLabel = `✈ ${airportName(S.airport)}`;
  const accomMap = { STANDARD:'Standard', SUPERIOR:'Superior', PREMIUM:'Premium' };
  const accom = accomMap[S.accommodationType] || S.accommodationType;

  // Tags
  const n = S.travelers;
  const tags = [
    `👤 ${n} ${lang==='sr'?(n===1?'putnik':n<5?'putnika':'putnika'):(n===1?'traveler':'travelers')}`,
    `🏨 ${accom}`,
  ];
  if (S.cabinSuitcaseCount > 0) tags.push(`🧳 ${S.cabinSuitcaseCount}× ${lang==='sr'?'kofer':'bag'}`);
  if (S.hasInsurance) tags.push(`🛡️ ${lang==='sr'?'Osiguranje':'Insurance'}`);
  if (S.hasBreakfast) tags.push(`🍳 ${lang==='sr'?'Doručak':'Breakfast'}`);
  if (S.hasSeatsTogether) tags.push(`💺 ${lang==='sr'?'Sedišta':'Seats'}`);
  if (S.hasConnectingFlights) tags.push(`🔄 ${lang==='sr'?'Presedanje OK':'Connecting OK'}`);
  if (S.excludedIds.length > 0) tags.push(`🚫 ${S.excludedIds.length} ${lang==='sr'?'isključeno':'excluded'}`);

  const tagsHtml = tags.map(tg => `<span class="bs-tag">${tg}</span>`).join('');

  // Price breakdown
  let priceRowsHtml = '';
  let totalHtml = '—';
  if (S.lastPrice) {
    const p = S.lastPrice;
    priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.base')}</span><span>${p.basePricePerPerson}€ × ${n} = ${p.basePricePerPerson * n}€</span></div>`;
    if (p.accommodationExtraPerPerson > 0)
      priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.accom')}</span><span>+${p.accommodationExtraPerPerson * n}€</span></div>`;
    if (p.cabinSuitcaseTotal > 0)
      priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.suit')}</span><span>+${p.cabinSuitcaseTotal}€</span></div>`;
    if (p.insurancePerPerson > 0)
      priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.ins')}</span><span>+${p.insurancePerPerson * n}€</span></div>`;
    if (p.breakfastPerPerson > 0)
      priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.bfst')}</span><span>+${p.breakfastPerPerson * n}€</span></div>`;
    if (p.seatsTogtherPerPerson > 0)
      priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.seats')}</span><span>+${p.seatsTogtherPerPerson * n}€</span></div>`;
    if (p.exclusionCostFlat > 0)
      priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.excl')}</span><span>+${p.exclusionCostFlat}€</span></div>`;
    if (p.soloSurcharge > 0)
      priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.solo')}</span><span>+${p.soloSurcharge}€</span></div>`;
    totalHtml = `${p.totalEurAll}€`;
  }

  el.innerHTML = `
    <div class="bs-header">
      <div class="bs-title">${lang==='sr'?'✈ Pregled rezervacije':'✈ Booking Summary'}</div>
    </div>
    <div class="bs-trip">
      <div class="bs-trip-left">
        <div class="bs-airport">${airportLabel}</div>
        <div class="bs-dates">${dep} → ${ret}</div>
        <div class="bs-nights-lbl">${nightLabel}</div>
      </div>
      <div class="bs-mystery">?</div>
    </div>
    <div class="bs-tags">${tagsHtml}</div>
    <div class="bs-price-rows">
      ${priceRowsHtml}
      <div class="bs-total">
        <div class="bs-total-label">${lang==='sr'?'Ukupno':'Total'}</div>
        <div class="bs-total-price">${totalHtml}</div>
      </div>
    </div>
  `;
}

// ══════════ STEP 8 — SUBMIT
function validateContact() {
  let ok=true;
  const fields=[
    {id:'fFirstName',wrap:'ff-firstname',check:v=>v.trim().length>0},
    {id:'fLastName', wrap:'ff-lastname', check:v=>v.trim().length>0},
    {id:'fEmail',    wrap:'ff-email',    check:v=>/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim())},
    {id:'fPhone',    wrap:'ff-phone',    check:v=>v.trim().length>5},
  ];
  fields.forEach(f=>{
    const el=document.getElementById(f.id);
    const wrap=document.getElementById(f.wrap);
    if(!el||!wrap) return;
    if(!f.check(el.value)){
      wrap.classList.add('field-error'); ok=false;
    } else {
      wrap.classList.remove('field-error');
    }
  });

  // Terms checkbox
  const chkTerms = document.getElementById('chkTerms');
  const termsRow  = document.getElementById('terms-row');
  const termsErr  = document.getElementById('terms-err');
  if (chkTerms && !chkTerms.checked) {
    termsRow?.classList.add('terms-invalid');
    termsErr?.classList.add('visible');
    ok = false;
  } else {
    termsRow?.classList.remove('terms-invalid');
    termsErr?.classList.remove('visible');
  }

  // Privacy checkbox
  const chkPrivacy  = document.getElementById('chkPrivacy');
  const privacyRow  = document.getElementById('privacy-row');
  const privacyErr  = document.getElementById('privacy-err');
  if (chkPrivacy && !chkPrivacy.checked) {
    privacyRow?.classList.add('terms-invalid');
    privacyErr?.classList.add('visible');
    ok = false;
  } else {
    privacyRow?.classList.remove('terms-invalid');
    privacyErr?.classList.remove('visible');
  }

  // GDPR checkbox
  const chkGdpr = document.getElementById('chkGdpr');
  const gdprRow  = document.getElementById('gdpr-row');
  const gdprErr  = document.getElementById('gdpr-err');
  if (chkGdpr && !chkGdpr.checked) {
    gdprRow?.classList.add('terms-invalid');
    gdprErr?.classList.add('visible');
    ok = false;
  } else {
    gdprRow?.classList.remove('terms-invalid');
    gdprErr?.classList.remove('visible');
  }

  // Scroll to first error field
  if (!ok) {
    const firstErr = document.querySelector('#step8 .field-error, #step8 .terms-invalid');
    if (firstErr) {
      const top = firstErr.getBoundingClientRect().top + window.scrollY - 120;
      window.scrollTo({ top, behavior: 'instant' });
    }
  }

  return ok;
}

async function submitBooking() {
  if(!validateContact()) {
    showFormAlert(lang === 'sr'
      ? 'Molimo popunite sva obavezna polja i prihvatite uslove.'
      : 'Please fill in all required fields and accept the terms.');
    return;
  }
  const btn=document.getElementById('btnSubmit');
  const firstName=document.getElementById('fFirstName').value.trim();
  const lastName=document.getElementById('fLastName').value.trim();
  const email=document.getElementById('fEmail').value.trim();
  const phone=document.getElementById('fPhone').value.trim();
  const passengers=Array.from({length:S.travelers},(_,i)=>({
    passportNumber:(document.getElementById('pp'+i)||{}).value?.trim().toUpperCase()||'',
    hasValidPassport:!!(document.getElementById('phv'+i)||{checked:true}).checked,
    name:(document.getElementById('pn'+i)||{}).value||'',
    gender:(document.getElementById('pg'+i)||{}).value||'M',
    dateOfBirth:getPaxDob(i),
    visaInfo:(document.getElementById('pv'+i)||{}).value||''
  }));
  const body={
    departureAirport:S.airport,
    selectedDateId:S.selectedDateId,
    numberOfTravelers:S.travelers,
    accommodationType:S.accommodationType,
    cabinSuitcaseCount:S.cabinSuitcaseCount,
    hasInsurance:S.hasInsurance,
    hasBreakfast:S.hasBreakfast,
    hasSeatsTogether:S.hasSeatsTogether,
    hasConnectingFlights:S.hasConnectingFlights,
    excludedDestination1Id:S.excludedIds[0]||null,
    excludedDestination2Id:S.excludedIds[1]||null,
    excludedDestination3Id:S.excludedIds[2]||null,
    passengers,
    firstName:firstName, lastName:lastName, email:email, phone:phone,
    notes:document.getElementById('fNotes').value
  };
  btn.disabled=true; btn.textContent = lang==='sr' ? 'Slanje...' : 'Sending...';
  try {
    const r=await fetch(`${API}/api/booking`,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(body)});
    const d=await r.json();
    if(r.ok){
      // Sačuvaj podatke za boarding pass na hvala stranici
      sessionStorage.setItem('esc_bp', JSON.stringify({
        name:       (firstName + ' ' + lastName).toUpperCase(),
        airport:    (S.airport || '').toUpperCase(),
        date:       S.selectedDate?.departureDate || '',
        returnDate: S.selectedDate?.returnDate || '',
        ref:        d.bookingRef
      }));
      window.location.href = '/hvala?ref=' + encodeURIComponent(d.bookingRef);
    } else if(r.status === 409) {
      await Swal.fire({
        icon: 'error',
        title: lang==='sr' ? '😔 Mesta su popunjena' : '😔 No spots available',
        html: lang==='sr'
          ? `<p style="color:#7A9FA8;line-height:1.7;">Nažalost, u trenutku slanja vaše rezervacije mesta su se popunila.<br><br>
             <strong style="color:white;">Molimo vas da odaberete drugi termin.</strong></p>`
          : `<p style="color:#7A9FA8;line-height:1.7;">Unfortunately, the remaining spots were taken just before your request was submitted.<br><br>
             <strong style="color:white;">Please select a different date.</strong></p>`,
        confirmButtonText: lang==='sr' ? '← Odaberi drugi termin' : '← Choose another date',
        confirmButtonColor: '#CA8A71',
        background: '#2D5F6B',
        color: '#fff',
        allowOutsideClick: false
      });
      // Vrati korisnika na korak 3 (izbor datuma) i osvezi listu
      S.step = 3;
      S.selectedDateId = null;
      S.selectedDate = null;
      showStep(3);
      loadDates();
      btn.disabled=false; btn.textContent=t('s8.submit');
    } else {
      Swal.fire({icon:'error',title:'Greška',text:d.error||t('err.srv'),
        confirmButtonColor:'#CA8A71',background:'#2D5F6B',color:'#fff'});
      btn.disabled=false; btn.textContent=t('s8.submit');
    }
  } catch(e) {
    Swal.fire({icon:'error',title:'Greška',text:t('err.srv'),
      confirmButtonColor:'#CA8A71',background:'#2D5F6B',color:'#fff'});
    btn.disabled=false; btn.textContent=t('s8.submit');
  }
}

// ══════════ SCROLL NAV EFFECT
window.addEventListener('scroll',()=>{
  document.getElementById('mainNav').style.background =
    window.scrollY>50 ? 'rgba(15,45,53,.98)' : 'rgba(15,45,53,.92)';
});

// ══════════ INIT
renderSteps();
updateProgress();
loadCountries();
loadDestinations();

// ══════════ SECONDARY NAV — show after hero, highlight active section
(function() {
  const secNav   = document.getElementById('secNav');
  const sections = [
    { id:'esc-about',   btn: 0 },
    { id:'esc-dest',    btn: 1 },
    { id:'esc-how',     btn: 2 },
    { id:'esc-who',     btn: 3 },
    { id:'esc-faq',     btn: 4 },
    { id:'esc-booking', btn: 5 },
  ];
  const heroH = () => document.querySelector('.esc-hero')?.offsetHeight || 500;

  function updateSecNav() {
    const scrollY = window.scrollY;
    // Show only after user scrolls past the hero
    if (scrollY > heroH() - 120) secNav.classList.add('visible');
    else secNav.classList.remove('visible');

    // Highlight active section
    const links = secNav.querySelectorAll('.sec-nav-link');
    let active = -1;
    sections.forEach(({ id }, i) => {
      const el = document.getElementById(id);
      if (el && el.getBoundingClientRect().top <= 120) active = i;
    });
    links.forEach((l, i) => l.classList.toggle('active', i === active));
  }

  window.addEventListener('scroll', updateSecNav, { passive: true });
  updateSecNav();
})();
</script>

<!-- ══════ LIBRARIES INIT ══════ -->
<script>
// ── AOS
AOS.init({ duration: 700, once: true, offset: 60, easing: 'ease-out-cubic' });

// ── GSAP + CountUp on stats section
gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.create({
  trigger: '.esc-stats',
  start: 'top 85%',
  once: true,
  onEnter() {
    document.querySelectorAll('[data-countup]').forEach(el => {
      const end = parseInt(el.dataset.countup);
      const suffix = el.textContent.replace(/[0-9]/g,'').trim();
      const cu = new countUp.CountUp(el, end, { duration: 2, suffix });
      cu.start();
    });
  }
});

// ── GSAP magnetic effect on primary buttons (desktop/hover-capable only)
// Disabled on touch devices — elastic spring-back animation interferes with mobile scroll
const isHoverDevice = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
if (isHoverDevice) {
  document.querySelectorAll('.btn-gold, .btn-next').forEach(btn => {
    btn.addEventListener('mousemove', e => {
      const r = btn.getBoundingClientRect();
      const x = e.clientX - r.left - r.width/2;
      const y = e.clientY - r.top  - r.height/2;
      gsap.to(btn, { x: x * .18, y: y * .18, duration: .3, ease: 'power2.out' });
    });
    btn.addEventListener('mouseleave', () => {
      gsap.to(btn, { x: 0, y: 0, duration: .5, ease: 'elastic.out(1,.5)' });
    });
  });
}

// ── Sparkle on btn-gold click
function spawnSparks(e) {
  const colors = ['#f97316','#fb923c','#fbbf24','#ffffff','#f5ede0','#fdba74'];
  const n = 10;
  for(let i = 0; i < n; i++) {
    const s = document.createElement('div');
    s.className = 'spark';
    const angle  = (Math.PI * 2 / n) * i + Math.random() * .8;
    const dist   = 35 + Math.random() * 35;
    const size   = 5 + Math.random() * 5;
    s.style.cssText = [
      `left:${e.clientX}px`, `top:${e.clientY}px`,
      `width:${size}px`, `height:${size}px`,
      `background:${colors[i % colors.length]}`,
      `--dx:${Math.cos(angle)*dist}px`,
      `--dy:${Math.sin(angle)*dist}px`
    ].join(';');
    document.body.appendChild(s);
    setTimeout(() => s.remove(), 650);
  }
}
document.querySelectorAll('.btn-gold, .btn-next, .btn-back').forEach(btn => {
  btn.addEventListener('click', spawnSparks);
});

// ── GSAP hero entrance
gsap.from('.hero-badge', { opacity:0, y:20, duration:.7, delay:.1 });
gsap.from('.hero-h1',    { opacity:0, y:30, duration:.8, delay:.25 });
gsap.from('.hero-sub',   { opacity:0, y:20, duration:.7, delay:.45 });
gsap.from('.hero-btns',  { opacity:0, y:20, duration:.7, delay:.6  });
gsap.from('.hero-stats', { opacity:0, y:16, duration:.7, delay:.8  });

// ── feat-card equal height
function equalFeatCards() {
  const cards = document.querySelectorAll('.feat-card');
  if (!cards.length) return;
  cards.forEach(c => c.style.minHeight = '');
  let max = 0;
  cards.forEach(c => { max = Math.max(max, c.offsetHeight); });
  if (max > 0) cards.forEach(c => c.style.minHeight = max + 'px');
}
document.addEventListener('DOMContentLoaded', () => {
  equalFeatCards();
  // Primeni sačuvani jezik na lang dugmad
  document.querySelectorAll('.lang-btn').forEach(b => b.classList.toggle('on', b.textContent === lang.toUpperCase()));
});
window.addEventListener('load', equalFeatCards);
window.addEventListener('resize', equalFeatCards);

// ── feat-card tilt on hover (desktop only — 3D transforms trigger scroll correction on mobile)
if (isHoverDevice) {
  document.querySelectorAll('.feat-card, .airport-card, .accom-tile').forEach(card => {
    card.addEventListener('mousemove', e => {
      const r = card.getBoundingClientRect();
      const x = (e.clientX - r.left) / r.width  - .5;
      const y = (e.clientY - r.top)  / r.height - .5;
      gsap.to(card, { rotateY: x*10, rotateX: -y*10, duration:.3, ease:'power1.out', transformPerspective: 800 });
    });
    card.addEventListener('mouseleave', () => {
      gsap.to(card, { rotateY:0, rotateX:0, duration:.5, ease:'elastic.out(1,.6)' });
    });
  });
}
</script>

<?php wp_footer(); ?>
</body>
</html>
