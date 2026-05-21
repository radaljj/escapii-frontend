<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escapii - Putovanja iznenađenja već od 239€</title>
  <meta name="description" content="Prva platforma za putovanja iznenađenja u Srbiji. Ti biraš datum, mi biramo destinaciju. Saznaš kuda ideš 48h pre polaska.">

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
    /* "Pozovi nas" pill u secondary navu */
    .sec-nav-call {
      white-space: nowrap; flex-shrink: 0;
      display: inline-flex; align-items: center; gap: 6px;
      padding: 5px 14px; border-radius: 20px;
      font-size: 12px; font-weight: 700; cursor: pointer; font-family: inherit;
      color: var(--gold);
      background: rgba(202,138,113,.12);
      border: 1px solid rgba(202,138,113,.3);
      transition: all .2s;
    }
    .sec-nav-call:hover { background: rgba(202,138,113,.22); border-color: rgba(202,138,113,.55); }
    @media (max-width: 768px) {
      .sec-nav { display: none !important; }
    }
    /* Mobile menu — "Pozovi nas" red */
    .mob-menu-call { color: var(--accent) !important; }
    .mob-menu-call-hours { display: block; font-size: 11px; color: rgba(255,255,255,.38); font-weight: 500; margin-top: 3px; }

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
    .carousel-track { cursor: grab; user-select: none; }
    .carousel-track.is-dragging { cursor: grabbing; animation-play-state: paused; }
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
    .esc-features { background: var(--navy3); padding: 80px 24px; }
    .features-inner { max-width: 1200px; margin: 0 auto; }
    .features-header { text-align: center; margin-bottom: 52px; }
    .features-grid {
      display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;
    }
    .feat-card {
      background: #fff; border: none; border-radius: 20px; padding: 32px 26px;
      display: flex; flex-direction: column;
      box-shadow: 0 2px 16px rgba(45,95,107,.07);
      transition: transform .22s ease, box-shadow .22s ease;
      position: relative; overflow: hidden; box-sizing: border-box;
    }
    .feat-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
      background: var(--accent); border-radius: 20px 20px 0 0;
    }
    .feat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 32px rgba(45,95,107,.13); }
    .feat-icon-wrap {
      font-size: 11px; font-weight: 800; color: var(--accent);
      letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 14px;
    }
    .feat-icon {
      width: 52px; height: 52px; border-radius: 16px;
      background: rgba(202,138,113,.12);
      display: flex; align-items: center; justify-content: center;
      font-size: 24px; margin-bottom: 18px;
    }
    .feat-content h3 { font-size: 15px; font-weight: 800; color: #2D5F6B; margin-bottom: 8px; line-height: 1.35; }
    .feat-content p { font-size: 13px; color: #6B7C80; line-height: 1.65; }

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
    /* Private link mode — hide Back button only on step 4 (can't go back to steps 1-3) */
    .private-mode #step4 .btn-back { display: none !important; }
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
    /* Anti-bot honeypot — nevidljivo za ljude, bots ga popune */
    .hp-field { position:absolute; left:-9999px; top:-9999px; width:1px; height:1px;
                opacity:0; pointer-events:none; tab-index:-1; }
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
      flex: 1; background: rgba(255,255,255,.08);
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 10px; padding: 10px 14px;
      font-size: 14px; color: var(--white); font-family: inherit;
      outline: none; transition: border-color .25s;
      min-width: 0;
    }
    .waitlist-input::placeholder { color: rgba(255,255,255,.3); }
    .waitlist-input:focus { border-color: var(--accent); }
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
    /* ── Term card (date row) ─────────────────────── */
    .term {
      display: grid;
      grid-template-columns: auto 1fr auto;
      align-items: center;
      gap: 16px;
      background: rgba(0,0,0,.04);
      border: 1.5px solid rgba(0,0,0,.08);
      border-radius: 16px;
      padding: 16px 20px;
      cursor: pointer;
      transition: border-color .25s, background .25s, transform .2s, box-shadow .25s;
      position: relative;
      margin-bottom: 8px;
    }
    .term:last-child { margin-bottom: 0; }
    .term:hover {
      border-color: rgba(202,138,113,.45);
      background: rgba(202,138,113,.05);
      transform: translateY(-2px);
    }
    .term.on {
      border-color: var(--accent);
      background: rgba(202,138,113,.07);
      box-shadow: 0 0 0 1px var(--accent), 0 12px 28px -12px rgba(202,138,113,.45);
    }
    .term.on::after {
      content: '✓';
      position: absolute;
      top: -8px; right: -8px;
      width: 20px; height: 20px;
      background: var(--accent);
      color: #fff;
      border-radius: 100px;
      font-size: 11px;
      font-weight: 800;
      display: flex; align-items: center; justify-content: center;
      line-height: 20px;
      text-align: center;
    }
    .term.disabled {
      opacity: .45; cursor: not-allowed;
      border-color: rgba(0,0,0,.05) !important;
      background: transparent !important;
      transform: none !important;
    }
    .term-dates { display: flex; align-items: center; gap: 10px; }
    .t-date-block { text-align: center; min-width: 36px; }
    .t-dow {
      font-size: 9px; letter-spacing: .22em; color: var(--gray);
      font-weight: 700; text-transform: uppercase; margin-bottom: 2px;
    }
    .t-num {
      font-size: 28px; font-weight: 900; color: var(--white);
      line-height: 1; letter-spacing: -.02em;
    }
    .t-mon {
      font-size: 10px; letter-spacing: .2em; color: var(--accent);
      font-weight: 700; text-transform: uppercase; margin-top: 3px;
    }
    .t-plane-sep {
      width: 28px; height: 28px; border-radius: 100px;
      background: rgba(202,138,113,.1);
      border: 1px solid rgba(202,138,113,.22);
      display: flex; align-items: center; justify-content: center;
      color: var(--accent); font-size: 13px; flex-shrink: 0;
    }
    .term-mid { display: flex; flex-direction: column; gap: 6px; }
    .t-nights-pill {
      font-size: 11px; color: var(--gray);
      background: rgba(0,0,0,.05);
      border: 1px solid rgba(0,0,0,.08);
      padding: 3px 10px; border-radius: 100px; font-weight: 600;
      display: inline-block; width: fit-content;
    }
    .term-price { text-align: right; flex-shrink: 0; }
    .t-price-v {
      font-size: 26px; font-weight: 900; color: var(--accent); line-height: 1;
    }
    .t-price-unit { font-size: 11px; color: var(--gray); margin-top: 3px; letter-spacing: .06em; }
    /* Stock badges */
    .low-stock-badge {
      display: inline-flex; align-items: center; gap: 4px;
      background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.3);
      color: #dc2626; font-size: 10px; font-weight: 700;
      padding: 2px 8px; border-radius: 100px;
      letter-spacing: .3px; text-transform: uppercase;
      animation: pulse-badge 2s ease-in-out infinite;
    }
    .low-stock-badge::before {
      content: ''; width: 5px; height: 5px; border-radius: 50%;
      background: #ef4444; animation: blink-dot 1s ease-in-out infinite; flex-shrink: 0;
    }
    .sold-out-badge {
      display: inline-flex; align-items: center; gap: 4px;
      background: rgba(0,0,0,.06); border: 1px solid rgba(0,0,0,.1);
      color: var(--gray); font-size: 10px; font-weight: 700;
      padding: 2px 8px; border-radius: 100px;
      letter-spacing: .3px; text-transform: uppercase;
    }
    @keyframes pulse-badge { 0%,100%{box-shadow:0 0 6px rgba(239,68,68,.15);} 50%{box-shadow:0 0 14px rgba(239,68,68,.4);} }
    @keyframes blink-dot { 0%,100%{opacity:1;} 50%{opacity:.3;} }
    /* ── Month accordion ──────────────────────────── */
    .month-card {
      margin-bottom: 12px; border-radius: 18px; overflow: hidden;
      border: 1px solid rgba(0,0,0,.08);
      transition: border-color .3s;
    }
    .month-card.open { border-color: rgba(202,138,113,.3); }
    .month-head {
      display: flex; align-items: center; justify-content: space-between;
      padding: 16px 20px; cursor: pointer; user-select: none;
      background: rgba(0,0,0,.03); transition: background .2s;
    }
    .month-head:hover { background: rgba(0,0,0,.055); }
    .month-card.open .month-head { background: rgba(202,138,113,.07); border-bottom: 1px solid rgba(202,138,113,.15); }
    .month-head-left h3 { font-size: 17px; font-weight: 800; color: var(--white); line-height: 1.1; }
    .month-head-left .month-meta { font-size: 12px; color: var(--gray); margin-top: 3px; }
    .chev {
      width: 32px; height: 32px; border-radius: 100px;
      background: rgba(0,0,0,.06); border: 1px solid rgba(0,0,0,.08);
      display: flex; align-items: center; justify-content: center;
      color: var(--gray); flex-shrink: 0;
      transition: transform .4s cubic-bezier(.2,.8,.2,1), background .3s, color .3s;
    }
    .chev svg { width: 14px; height: 14px; }
    .month-card.open .chev { transform: rotate(180deg); background: rgba(202,138,113,.15); color: var(--accent); }
    .month-body { max-height: 0; overflow: hidden; transition: max-height .45s cubic-bezier(.2,.8,.2,1); }
    .month-card.open .month-body { max-height: 800px; }
    .month-body-inner { padding: 12px 14px 14px; display: flex; flex-direction: column; }
    /* ── Custom CTA ───────────────────────────────── */
    .custom-cta {
      width: 100%; margin-top: 12px; padding: 16px 18px;
      background: linear-gradient(135deg, rgba(202,138,113,.07), rgba(202,138,113,.02));
      border: 1.5px dashed rgba(202,138,113,.38);
      border-radius: 16px; color: var(--white); font-family: inherit;
      font-size: 14px; font-weight: 600; cursor: pointer;
      display: flex; align-items: center; justify-content: center; gap: 12px;
      transition: background .3s, border-color .3s, transform .25s;
      position: relative; overflow: hidden; text-align: left;
    }
    .custom-cta::after {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(120deg, transparent 30%, rgba(202,138,113,.2) 50%, transparent 70%);
      transform: translateX(-100%); transition: transform .7s;
    }
    .custom-cta:hover {
      background: linear-gradient(135deg, rgba(202,138,113,.13), rgba(202,138,113,.05));
      border-color: var(--accent); transform: translateY(-2px);
    }
    .custom-cta:hover::after { transform: translateX(100%); }
    .custom-cta .cta-ic {
      width: 34px; height: 34px; background: rgba(202,138,113,.15);
      border-radius: 10px; display: flex; align-items: center; justify-content: center;
      color: var(--accent); flex-shrink: 0;
    }
    .custom-cta .cta-tx { flex: 1; }
    .custom-cta .cta-tx strong { display: block; font-size: 14px; color: var(--accent); margin-bottom: 2px; }
    .custom-cta .cta-tx small { color: rgba(255,255,255,.85); font-weight: 400; font-size: 12px; }
    .custom-cta .cta-arr {
      width: 26px; height: 26px; background: var(--accent); color: #fff;
      border-radius: 100px; display: flex; align-items: center; justify-content: center;
      transition: transform .3s; flex-shrink: 0;
    }
    .cta-arr svg { width: 13px; height: 13px; }
    .custom-cta:hover .cta-arr { transform: translateX(4px); }
    /* ── Inquiry view (custom calendar) ──────────── */
    .inq-panel {
      background: linear-gradient(180deg,#102530 0%,#0d1f29 100%);
      border-radius: 18px; padding: 24px; color: #f6f1e6;
      margin-top: 0;
    }
    .inq-back {
      display: inline-flex; align-items: center; gap: 6px;
      background: none; border: none; color: rgba(246,241,230,.5);
      font-size: 13px; font-weight: 600; cursor: pointer;
      margin-bottom: 18px; font-family: inherit; padding: 0;
      transition: color .2s;
    }
    .inq-back:hover { color: rgba(246,241,230,.9); }
    .inq-badge {
      display: inline-flex; align-items: center; gap: 7px;
      background: rgba(202,138,113,.12); border: 1px solid rgba(202,138,113,.28);
      color: #f0b094; padding: 5px 12px; border-radius: 100px;
      font-size: 10px; letter-spacing: .28em; text-transform: uppercase;
      font-weight: 700; margin-bottom: 14px;
    }
    .inq-badge .dot { width: 5px; height: 5px; border-radius: 100px; background: var(--accent); box-shadow: 0 0 6px var(--accent); }
    .inq-h { font-size: 22px; font-weight: 800; color: #f6f1e6; margin-bottom: 5px; }
    .inq-sub { font-size: 13px; color: rgba(246,241,230,.55); margin-bottom: 22px; line-height: 1.5; }
    .inq-label {
      font-size: 10px; letter-spacing: .28em; text-transform: uppercase;
      color: rgba(246,241,230,.35); font-weight: 700; margin-bottom: 10px; display: block;
    }
    .inq-label .opt { font-size: 9px; letter-spacing: .18em; margin-left: 6px; font-weight: 500; }
    .inq-field { margin-bottom: 20px; }
    /* Calendar */
    .inq-cal {
      background: rgba(246,241,230,.025); border: 1px solid rgba(246,241,230,.08);
      border-radius: 14px; padding: 16px;
    }
    .inq-cal-head {
      display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;
    }
    .inq-cal-month { font-size: 18px; font-weight: 800; color: #f6f1e6; }
    .inq-cal-nav { display: flex; gap: 5px; }
    .inq-cal-nav button {
      width: 30px; height: 30px; border-radius: 100px;
      background: rgba(246,241,230,.05); border: 1px solid rgba(246,241,230,.08);
      color: rgba(246,241,230,.6); cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background .2s, color .2s, border-color .2s;
    }
    .inq-cal-nav button:hover { background: rgba(202,138,113,.15); color: #f0b094; border-color: rgba(202,138,113,.35); }
    .inq-cal-nav button svg { width: 13px; height: 13px; }
    .inq-cal-grid { display: grid; grid-template-columns: repeat(7,1fr); gap: 3px; }
    .inq-cal-dow {
      text-align: center; font-size: 9px; letter-spacing: .18em;
      color: rgba(246,241,230,.3); font-weight: 700; text-transform: uppercase;
      padding: 5px 0 7px;
    }
    .inq-cal-day {
      aspect-ratio: 1; display: flex; align-items: center; justify-content: center;
      background: transparent; border: 1px solid transparent; border-radius: 9px;
      color: #f6f1e6; font-size: 13px; font-weight: 500; cursor: pointer;
      transition: background .18s, border-color .18s, transform .18s;
      font-family: inherit;
    }
    .inq-cal-day:hover:not(:disabled):not(.muted) {
      background: rgba(202,138,113,.12); border-color: rgba(202,138,113,.35); transform: scale(1.06);
    }
    .inq-cal-day.muted { color: rgba(246,241,230,.25); cursor: default; }
    .inq-cal-day.today { box-shadow: inset 0 0 0 1px rgba(246,241,230,.2); }
    .inq-cal-day.selected {
      background: var(--accent); color: #fff; font-weight: 700;
      box-shadow: 0 5px 14px -4px rgba(202,138,113,.6);
    }
    .inq-cal-day:disabled { opacity: .2; cursor: not-allowed; }
    /* Range selection in calendar */
    .inq-cal-day.dep {
      background: var(--accent); color: #fff; font-weight: 700;
      box-shadow: 0 5px 14px -4px rgba(202,138,113,.6);
      border-radius: 9px 0 0 9px;
    }
    .inq-cal-day.ret {
      background: var(--accent); color: #fff; font-weight: 700;
      box-shadow: 0 5px 14px -4px rgba(202,138,113,.6);
      border-radius: 0 9px 9px 0;
    }
    .inq-cal-day.dep.ret { border-radius: 9px; }
    .inq-cal-day.in-range {
      background: rgba(202,138,113,.18); border-radius: 0;
      border-color: transparent;
    }
    .inq-cal-day.in-range-preview {
      background: rgba(202,138,113,.08); border-radius: 0;
      border-color: transparent;
    }
    .inq-cal-day.dep-hover {
      background: rgba(202,138,113,.2); border-radius: 9px 0 0 9px;
    }
    /* Range status indicator */
    .inq-range-status {
      margin-top: 10px; padding: 9px 13px; border-radius: 10px;
      font-size: 12px; line-height: 1.5; text-align: center;
      transition: all .2s;
    }
    .inq-range-status.hint {
      background: rgba(246,241,230,.04); color: rgba(246,241,230,.4);
      border: 1px dashed rgba(246,241,230,.1);
    }
    .inq-range-status.dep-set {
      background: rgba(202,138,113,.1); color: #f0b094;
      border: 1px solid rgba(202,138,113,.25);
    }
    .inq-range-status.valid {
      background: rgba(74,222,128,.08); color: #86efac;
      border: 1px solid rgba(74,222,128,.2);
    }
    .inq-range-status.invalid {
      background: rgba(239,68,68,.08); color: #fca5a5;
      border: 1px solid rgba(239,68,68,.2);
      animation: fadeInDown .25s ease;
    }
    @keyframes fadeInDown { from{opacity:0;transform:translateY(-5px);}to{opacity:1;transform:translateY(0);} }
    /* Inquiry text inputs */
    .inq-control {
      background: rgba(246,241,230,.04); border: 1px solid rgba(246,241,230,.08);
      border-radius: 12px; padding: 12px 14px; color: #f6f1e6;
      font-family: inherit; font-size: 14px; font-weight: 500; width: 100%;
      transition: background .2s, border-color .2s, box-shadow .2s;
    }
    .inq-control::placeholder { color: rgba(246,241,230,.28); font-weight: 400; }
    .inq-control:focus {
      outline: none; background: rgba(246,241,230,.08);
      border-color: var(--accent); box-shadow: 0 0 0 3px rgba(202,138,113,.12);
    }
    textarea.inq-control { resize: vertical; min-height: 80px; font-family: inherit; }
    .inq-field-ic { position: relative; }
    .inq-field-ic .ic {
      position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
      width: 16px; height: 16px; color: rgba(246,241,230,.3); pointer-events: none;
    }
    .inq-field-ic .inq-control { padding-left: 40px; }
    /* Summary card */
    .inq-summary {
      background: linear-gradient(135deg,rgba(202,138,113,.08),rgba(202,138,113,.02));
      border: 1px solid rgba(202,138,113,.22); border-radius: 12px;
      padding: 12px 16px; display: flex; align-items: center; gap: 12px;
      margin-bottom: 18px; font-size: 13px; color: rgba(246,241,230,.6);
    }
    .inq-summary .sum-ic {
      width: 32px; height: 32px; background: rgba(202,138,113,.15); border-radius: 9px;
      display: flex; align-items: center; justify-content: center; color: var(--accent); flex-shrink: 0;
    }
    .inq-summary strong { color: #f6f1e6; }
    /* Submit button */
    .inq-submit {
      width: 100%; padding: 16px; background: var(--accent); color: #fff;
      border: none; border-radius: 13px; font-family: inherit;
      font-size: 14px; font-weight: 700; cursor: pointer;
      display: flex; align-items: center; justify-content: center; gap: 9px;
      box-shadow: 0 14px 40px -10px rgba(202,138,113,.55);
      transition: transform .3s, box-shadow .3s, opacity .2s;
      position: relative; overflow: hidden;
    }
    .inq-submit::before {
      content: ''; position: absolute; inset: 0;
      background: linear-gradient(120deg,transparent 30%,rgba(255,255,255,.35) 50%,transparent 70%);
      transform: translateX(-100%); transition: transform .7s;
    }
    .inq-submit:hover { transform: translateY(-2px); box-shadow: 0 20px 50px -10px rgba(202,138,113,.7); }
    .inq-submit:hover::before { transform: translateX(100%); }
    .inq-submit:disabled { opacity: .5; cursor: not-allowed; transform: none; }
    .inq-submit svg { width: 15px; height: 15px; }
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
    .accom-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 16px; }
    .accom-tile {
      border: 2px solid rgba(255,255,255,.1); border-radius: 18px; padding: 0;
      text-align: center; cursor: pointer; transition: all .25s;
      position: relative; overflow: hidden;
    }
    .accom-tile:hover, .accom-tile.on { border-color: var(--gold); box-shadow: 0 0 0 4px rgba(202,138,113,.12); }
    .a-tile-img {
      width: 100%; height: 130px; object-fit: cover; display: block;
      transition: transform .35s ease;
    }
    .accom-tile:hover .a-tile-img { transform: scale(1.04); }
    .a-tile-body { padding: 18px 16px 16px; }
    .a-icon  {
      display: flex; align-items: center; justify-content: center;
      font-size: 48px; padding: 28px 0 4px;
      background: rgba(202,138,113,.06);
    }
    .a-name  { font-size: 17px; font-weight: 800; margin-bottom: 8px; }
    .a-badge { font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 100px; margin-bottom: 8px; display: inline-block; }
    /* Hover overlay */
    .a-hover {
      position: absolute; left: 0; right: 0; bottom: -100%;
      background: linear-gradient(to top, rgba(15,45,53,.97) 60%, rgba(15,45,53,.82));
      padding: 14px 16px; transition: bottom .28s ease;
      border-top: 2px solid var(--accent); text-align: left;
    }
    .accom-tile:hover .a-hover { bottom: 0; }
    .a-hover-stars { display: none; }
    .a-hover-desc { font-size: 12px; color: rgba(255,255,255,.85); line-height: 1.6; }
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

    /* ── Coming soon airports tooltip ── */
    .ap-soon-wrap {
      position: relative; display: flex; justify-content: center;
      margin: 14px 0 4px;
    }
    .ap-soon-trigger {
      display: inline-flex; align-items: center; gap: 5px;
      font-size: 12px; color: var(--gray); cursor: default;
      padding: 5px 12px; border-radius: 100px;
      border: 1px solid rgba(255,255,255,.08);
      background: rgba(255,255,255,.04);
      transition: color .2s, border-color .2s, background .2s;
      user-select: none;
    }
    .ap-soon-wrap:hover .ap-soon-trigger {
      color: var(--accent); border-color: rgba(202,138,113,.3);
      background: rgba(202,138,113,.06);
    }
    .ap-soon-tooltip {
      position: absolute; bottom: calc(100% + 10px); left: 50%;
      transform: translateX(-50%) translateY(4px);
      background: #0e2530; border: 1px solid rgba(202,138,113,.25);
      border-radius: 12px; padding: 14px 18px; min-width: 230px;
      box-shadow: 0 12px 40px rgba(0,0,0,.5);
      opacity: 0; pointer-events: none;
      transition: opacity .2s ease, transform .2s ease;
      z-index: 50;
    }
    .ap-soon-tooltip::after {
      content: ''; position: absolute; top: 100%; left: 50%;
      transform: translateX(-50%);
      border: 6px solid transparent;
      border-top-color: rgba(202,138,113,.25);
    }
    .ap-soon-wrap:hover .ap-soon-tooltip {
      opacity: 1; transform: translateX(-50%) translateY(0);
    }
    .ap-soon-title {
      font-size: 10px; font-weight: 700; letter-spacing: 1.5px;
      text-transform: uppercase; color: var(--accent); margin-bottom: 10px;
    }
    .ap-soon-list {
      display: flex; flex-direction: column; gap: 7px; margin-bottom: 10px;
    }
    .ap-soon-list span {
      font-size: 13px; color: rgba(255,255,255,.85); font-weight: 500;
    }
    .ap-soon-list em { color: var(--gray); font-style: normal; font-weight: 400; }
    .ap-soon-note {
      font-size: 11px; color: var(--gray); line-height: 1.5;
      padding-top: 8px; border-top: 1px solid rgba(255,255,255,.07);
    }

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
    /* Step 7 — Traveler cards */
    .pax-list { display: flex; flex-direction: column; gap: 16px; margin-bottom: 20px; }
    .pax-item {
      background: rgba(246,241,230,.03); border: 1px solid rgba(246,241,230,.08);
      border-radius: 18px; padding: 26px 28px; position: relative; transition: border-color .3s;
    }
    .pax-item:hover { border-color: rgba(246,241,230,.14); }
    .traveler-head {
      display: flex; align-items: center;
      margin-bottom: 22px; padding-bottom: 16px;
      border-bottom: 1px solid rgba(246,241,230,.08);
    }
    .traveler-num {
      width: 32px; height: 32px; border-radius: 100px;
      background: linear-gradient(135deg, var(--gold), #c8775a);
      color: #fff; font-weight: 700; font-size: 13px;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 6px 18px -4px rgba(202,138,113,.5); flex-shrink: 0;
    }
    .traveler-lbl {
      font-size: 11px; letter-spacing: .32em; text-transform: uppercase;
      font-weight: 700; color: rgba(246,241,230,.8); margin-left: 10px;
    }
    .traveler-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .traveler-grid > .full { grid-column: 1 / -1; }
    .traveler-triple { display: grid; grid-template-columns: 90px 1fr 110px; gap: 12px; }
    /* Field */
    .traveler-field { display: flex; flex-direction: column; gap: 8px; }
    .traveler-field > label:not(.passport-check) {
      font-size: 10px; letter-spacing: .28em; text-transform: uppercase;
      color: rgba(246,241,230,.34); font-weight: 700;
      display: flex; align-items: center; gap: 6px;
      transition: color .2s; user-select: none;
    }
    .traveler-field:focus-within > label:not(.passport-check) { color: var(--gold); }
    .traveler-field label .req { color: var(--gold); font-size: 12px; line-height: 1; }
    .traveler-field label .opt { font-size: 9px; letter-spacing: .2em; color: rgba(246,241,230,.28); font-weight: 500; margin-left: 2px; }
    /* Input / select */
    .t-control {
      background: rgba(246,241,230,.04); border: 1px solid rgba(246,241,230,.09);
      border-radius: 12px; padding: 14px 16px;
      color: rgba(246,241,230,.95); font-family: inherit; font-size: 15px; font-weight: 500;
      width: 100%; transition: background .2s, border-color .2s, box-shadow .2s;
      appearance: none; -webkit-appearance: none;
    }
    .t-control::placeholder { color: rgba(246,241,230,.22); font-weight: 400; }
    .t-control:hover { background: rgba(246,241,230,.07); border-color: rgba(246,241,230,.16); }
    .t-control:focus { outline: none; background: rgba(246,241,230,.1); border-color: var(--gold); box-shadow: 0 0 0 4px rgba(202,138,113,.12); }
    .t-control option { background: #0d1f29; }
    /* Icon prefix */
    .t-field-ic { position: relative; }
    .t-field-ic .t-ic { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: rgba(246,241,230,.28); pointer-events: none; transition: color .2s; }
    .t-field-ic .t-control { padding-left: 44px; }
    .t-field-ic:focus-within .t-ic { color: var(--gold); }
    /* Select — hide native arrow, inject SVG via background-image */
    .t-sel-wrap { position: relative; }
    .t-sel-wrap .t-control {
      padding-right: 40px; cursor: pointer;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23ca8a71' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: calc(100% - 14px) 50%;
      appearance: none; -webkit-appearance: none; -moz-appearance: none;
    }
    /* Tag input (visa) */
    .t-tags {
      background: rgba(246,241,230,.04); border: 1px solid rgba(246,241,230,.09);
      border-radius: 12px; padding: 10px 12px;
      display: flex; flex-wrap: wrap; gap: 8px; min-height: 50px; align-items: center;
      transition: background .2s, border-color .2s, box-shadow .2s; cursor: text;
    }
    .t-tags:focus-within { background: rgba(246,241,230,.1); border-color: var(--gold); box-shadow: 0 0 0 4px rgba(202,138,113,.12); }
    .t-chip {
      display: inline-flex; align-items: center; gap: 5px;
      background: rgba(246,241,230,.1); border: 1px solid rgba(246,241,230,.18);
      color: rgba(246,241,230,.85); padding: 4px 6px 4px 10px;
      border-radius: 100px; font-size: 12px; font-weight: 600;
      animation: chip-in .25s cubic-bezier(.2,.8,.2,1); white-space: nowrap;
    }
    .t-chip button {
      background: rgba(246,241,230,.12); border: none; color: rgba(246,241,230,.6);
      cursor: pointer; width: 18px; height: 18px; border-radius: 100px;
      display: flex; align-items: center; justify-content: center;
      transition: background .15s, color .15s; padding: 0; flex-shrink: 0;
    }
    .t-chip button:hover { background: rgba(239,68,68,.25); color: #fca5a5; }
    .t-chip svg { width: 9px; height: 9px; }
    @keyframes chip-in { from { transform: scale(.7); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .t-tags input { flex: 1; min-width: 100px; background: none; border: none; outline: none; color: rgba(246,241,230,.9); font-size: 14px; padding: 4px 6px; font-family: inherit; }
    .t-tags input::placeholder { color: rgba(246,241,230,.22); }
    /* Passport validity checkbox */
    .passport-check {
      background: linear-gradient(135deg, rgba(202,138,113,.1), rgba(202,138,113,.04));
      border: 1px solid rgba(202,138,113,.28); border-radius: 14px;
      padding: 14px 16px; display: flex; align-items: center; gap: 14px;
      cursor: pointer; transition: background .3s, border-color .3s; user-select: none;
    }
    .passport-check:hover { background: linear-gradient(135deg, rgba(202,138,113,.18), rgba(202,138,113,.08)); border-color: rgba(202,138,113,.5); }
    .passport-check input[type="checkbox"] { display: none; }
    .t-chk-box { width: 24px; height: 24px; border-radius: 6px; background: rgba(246,241,230,.06); border: 2px solid rgba(246,241,230,.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all .2s; }
    .passport-check input:checked ~ .t-chk-box { background: var(--gold); border-color: var(--gold); box-shadow: 0 4px 12px -3px rgba(202,138,113,.6); }
    .t-chk-box svg { color: #fff; width: 14px; height: 14px; stroke-width: 3; opacity: 0; transition: opacity .15s; }
    .passport-check input:checked ~ .t-chk-box svg { opacity: 1; }
    .passport-check .t-chk-tx { font-size: 11px; letter-spacing: .18em; text-transform: uppercase; font-weight: 700; color: rgba(246,241,230,.9); line-height: 1.4; }
    .passport-check .t-chk-tx small { display: block; color: rgba(246,241,230,.5); font-weight: 500; letter-spacing: .04em; text-transform: none; margin-top: 4px; font-size: 12px; }
    .passport-check.field-error { border-color: var(--red) !important; background: rgba(239,68,68,.08) !important; }
    .pax-chk-err { color: #f87171; font-size: 12px; margin-top: 6px; display: none; }
    .passport-check.field-error + .pax-chk-err { display: block; }
    /* Error states */
    .req { color: var(--gold); margin-left: 3px; }
    .field-error-msg { color: #f87171; font-size: 12px; margin-top: 2px; display: none; }
    .traveler-field.field-error .t-control { border-color: var(--red) !important; box-shadow: 0 0 0 3px rgba(239,68,68,.08) !important; }
    .traveler-field.field-error .t-tags { border-color: var(--red) !important; box-shadow: 0 0 0 3px rgba(239,68,68,.08) !important; }
    .traveler-field.field-error .field-error-msg { display: block; }

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
    /* Step 8 — box style matching traveler form */
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px 24px; }
    .form-field { display: flex; flex-direction: column; gap: 8px; }
    .form-field.full { grid-column: span 2; }
    .f-label {
      font-size: 10px; letter-spacing: .28em; text-transform: uppercase;
      color: rgba(246,241,230,.34); font-weight: 700;
      display: flex; align-items: center; gap: 6px;
      transition: color .2s;
    }
    .form-field:focus-within .f-label { color: var(--gold); }
    .f-input-wrap { /* wrapper kept for JS compat — no special styling */ }
    .f-input {
      background: rgba(246,241,230,.04); border: 1px solid rgba(246,241,230,.09);
      border-radius: 12px; padding: 14px 16px;
      color: rgba(246,241,230,.95); font-family: inherit; font-size: 15px; font-weight: 500;
      width: 100%; resize: none;
      transition: background .2s, border-color .2s, box-shadow .2s;
      outline: none;
    }
    .f-input::placeholder { color: rgba(246,241,230,.22); font-weight: 400; }
    .f-input:hover { background: rgba(246,241,230,.07); border-color: rgba(246,241,230,.16); }
    .f-input:focus { background: rgba(246,241,230,.1); border-color: var(--gold); box-shadow: 0 0 0 4px rgba(202,138,113,.12); }
    textarea.f-input { min-height: 90px; }
    .field-error .f-input { border-color: var(--red) !important; box-shadow: 0 0 0 3px rgba(239,68,68,.08) !important; }
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
      align-items: flex-start; justify-content: center; padding: 20px;
      overflow-y: auto;
    }
    .status-modal-overlay.open { display: flex; }
    .status-modal-card {
      position: relative; background: var(--navy2); border: 1px solid rgba(255,255,255,.08);
      border-radius: 20px; padding: 36px 32px 32px; width: 100%; max-width: 420px;
      box-shadow: 0 24px 64px rgba(0,0,0,.5);
      animation: modalIn .22s cubic-bezier(.34,1.56,.64,1);
      margin: auto;
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
    .feat-card { background: rgba(255,255,255,.06); border-color: rgba(255,255,255,.1); }
    .feat-card:hover { border-color: rgba(202,138,113,.35); background: rgba(202,138,113,.04); }

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
    /* traveler cards already styled for dark — no overrides needed */
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
    .card .accom-tile.on { border-color: var(--gold); box-shadow: 0 0 0 4px rgba(202,138,113,.12); background: transparent; }
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

    /* ── Term cards & month accordion inside dark card ── */
    .card .month-card { border-color: rgba(255,255,255,.1); }
    .card .month-head { background: rgba(255,255,255,.04); }
    .card .month-head:hover { background: rgba(255,255,255,.07); }
    .card .month-card.open .month-head { background: rgba(202,138,113,.1); border-bottom-color: rgba(202,138,113,.2); }
    .card .month-head-left h3 { color: #ffffff; }
    .card .month-head-left .month-meta { color: rgba(255,255,255,.45); }
    .card .chev { color: rgba(255,255,255,.5); }
    .card .month-card.open .chev { color: var(--accent); }
    .card .term { background: rgba(255,255,255,.05); border-color: rgba(255,255,255,.12); }
    .card .term:hover { background: rgba(202,138,113,.08); border-color: rgba(202,138,113,.45); }
    .card .term.on { background: rgba(202,138,113,.1); }
    .card .t-num { color: #ffffff; }
    .card .t-dow { color: rgba(255,255,255,.45); }
    .card .t-nights-pill { background: rgba(255,255,255,.07); border-color: rgba(255,255,255,.1); color: rgba(255,255,255,.5); }
    .card .t-price-unit { color: rgba(255,255,255,.45); }

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
    @media (max-width: 960px) {
      .features-grid { grid-template-columns: repeat(2, 1fr); }
    }
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

      /* Step 7 traveler form — 1 col on mobile */
      .traveler-grid { grid-template-columns: 1fr; }
      .traveler-triple { grid-template-columns: 1fr 1fr 1fr; gap: 8px; }

      /* Date row price — ne izlazi van granica */
      .term-price { min-width: 0; }
      .t-price-v { font-size: 21px; }
      .date-row { overflow: hidden; }

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
    <button class="mob-menu-link" onclick="mobNav('esc-how')"     data-i18n="snav.how">Kako funkcioniše</button>
    <button class="mob-menu-link" onclick="mobNav('esc-about')"   data-i18n="snav.about">O nama</button>
    <button class="mob-menu-link" onclick="mobNav('esc-dest')"    data-i18n="snav.dest">Destinacije</button>
    <button class="mob-menu-link" onclick="mobNav('esc-who')"     data-i18n="snav.who">Za koga</button>
    <button class="mob-menu-link" onclick="mobNav('esc-faq')"     data-i18n="snav.faq">FAQ</button>
    <button class="mob-menu-link mob-menu-call" onclick="mobNav('esc-contact-cta')">
      <span data-i18n="snav.call">✉ Kontaktiraj nas</span>
      <span class="mob-menu-call-hours" data-i18n="snav.call.hours">escapii.team@gmail.com</span>
    </button>
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
  <button class="sec-nav-link" onclick="escScrollTo('esc-how')"     data-i18n="snav.how">Kako funkcioniše</button>
  <button class="sec-nav-link" onclick="escScrollTo('esc-about')"   data-i18n="snav.about">O nama</button>
  <button class="sec-nav-link" onclick="escScrollTo('esc-dest')"    data-i18n="snav.dest">Destinacije</button>
  <button class="sec-nav-link" onclick="escScrollTo('esc-who')"     data-i18n="snav.who">Za koga</button>
  <button class="sec-nav-link" onclick="escScrollTo('esc-faq')"         data-i18n="snav.faq">FAQ</button>
  <button class="sec-nav-call"  onclick="escScrollTo('esc-contact-cta')" data-i18n="snav.call">✉ Kontaktiraj nas</button>
  <button class="sec-nav-link" onclick="escScrollTo('esc-booking')"     data-i18n="snav.book">Rezerviši</button>
</nav>

<!-- HERO -->
<section class="esc-hero">
  <video class="hero-video" autoplay muted loop playsinline webkit-playsinline preload="auto" disableremoteplayback poster="<?= get_template_directory_uri() ?>/assets/hero-poster.jpg">
    <source src="<?= get_template_directory_uri() ?>/assets/hero-bg-opt.mp4" type="video/mp4">
  </video>
  <div class="hero-video-overlay"></div>
  <div class="hero-eyebrow" data-i18n="hero.badge">Putovanja iznenađenja</div>
  <h1 class="hero-h1" data-i18n-html="hero.h1">Ti biraš kada. <em>Mi biramo gde.</em></h1>
  <p class="hero-sub" data-i18n="hero.sub">Izaberi aerodrom, datum i budžet — sve ostalo organizujemo mi. Destinaciju ćeš saznati tek 48h pre polaska.</p>
  <div class="hero-btns">
    <button class="btn-gold" onclick="escScrollTo('esc-booking')" data-i18n="hero.cta">Rezerviši svoje iznenađenje</button>
    <button class="btn-ghost" onclick="escScrollTo('esc-how')" data-i18n="hero.how">Kako funkcioniše Escapii?</button>
  </div>
  <div class="trust-badges" style="animation: fadeUp .9s .45s ease both;">
    <span class="trust-badge">✈️ <span data-i18n="trust.1">Let + hotel uključeni</span></span>
    <span class="trust-sep">·</span>
    <span class="trust-badge">📍 <span data-i18n="trust.2">Destinaciju ćeš saznati 48h pre polaska</span></span>
    <span class="trust-sep">·</span>
    <span class="trust-badge">🛡️ <span data-i18n="trust.3">Sarađujemo sa licenciranom turističkom agencijom</span></span>
  </div>

</section>

<!-- HOW IT WORKS -->
<section class="esc-features" id="esc-how">
  <div class="features-inner">
    <div class="features-header">
      <span class="sec-tag" data-i18n="how.tag">Kako funkcioniše?</span>
      <h2 class="sec-heading" data-i18n="how.heading">Četiri koraka do tvoje avanture</h2>
    </div>
    <div class="features-grid">
      <div class="feat-card">
        <div class="feat-icon-wrap">01</div>
        <span class="feat-icon">📅</span>
        <div class="feat-content">
          <h3 data-i18n="how.c1.t">Kreiraj svoje putovanje iznenađenja.</h3>
          <p data-i18n="how.c1.p">Izaberi datum, broj putnika, budžet i dodatke. Isključi destinacije koje ne želiš.</p>
        </div>
      </div>
      <div class="feat-card">
        <div class="feat-icon-wrap">02</div>
        <span class="feat-icon">✈️</span>
        <div class="feat-content">
          <h3 data-i18n="how.c2.t">Mi organizujemo sve.</h3>
          <p data-i18n="how.c2.p">Naša Escapii ekipa će skrojiti iznenađenje baš za tebe — let, hotel i sve ostalo. Na tebi je samo da spakuješ kofer.</p>
        </div>
      </div>
      <div class="feat-card">
        <div class="feat-icon-wrap">03</div>
        <span class="feat-icon">📍</span>
        <div class="feat-content">
          <h3 data-i18n="how.c3.t">Otkrij svoje iznenađenje.</h3>
          <p data-i18n="how.c3.p">Destinaciju na koju putuješ ćeš saznati 48h pre polaska. Ne brini, 7 dana pred put ćemo ti poslati vremensku prognozu, bez otkrivanja destinacije.</p>
        </div>
      </div>
      <div class="feat-card">
        <div class="feat-icon-wrap">04</div>
        <span class="feat-icon">💬</span>
        <div class="feat-content">
          <h3 data-i18n="how.c4.t">Stvori priču za prepričavanje</h3>
          <p data-i18n="how.c4.p">"Otišli smo, nismo znali kuda" — uvek bolja priča od "rezervisali smo mesecima unapred".</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- BOOKING -->
<section class="esc-booking" id="esc-booking">
  <div class="booking-inner">
    <div class="booking-header">
      <span class="sec-tag" data-i18n="book.tag">Rezervacija</span>
      <h2 class="sec-heading" data-i18n="book.heading">Kreiraj svoje putovanje iznenađenja</h2>
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
      <!-- Anti-bot honeypot — ne diraj ovo polje -->
      <div class="hp-field" aria-hidden="true">
        <label for="hp_website">Website</label>
        <input type="text" id="hp_website" name="website" tabindex="-1" autocomplete="off">
      </div>
      <div class="card">
        <h2 data-i18n="s1.h">Odakle kreće tvoja avantura?</h2>
        <p class="hint" data-i18n="s1.hint">Izaberi aerodrom polaska</p>
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
              <div class="airport-name" data-i18n="s1.ini.name">Aerodrom Konstantin Veliki</div>
            </div>
            <div class="airport-check">✓</div>
          </div>
        </div>

        <!-- Coming soon airports hint -->
        <div class="ap-soon-wrap">
          <span class="ap-soon-trigger">
            <svg width="13" height="13" viewBox="0 0 16 16" fill="none" style="vertical-align:-1px;opacity:.7;"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/><line x1="8" y1="4.5" x2="8" y2="8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="8" cy="11" r=".8" fill="currentColor"/></svg>
            <span data-i18n="s1.soon">Uskoro i polasci iz susednih zemalja</span>
          </span>
          <div class="ap-soon-tooltip" role="tooltip">
            <div class="ap-soon-title" data-i18n="s1.soon.title">Planirana polazišta</div>
            <div class="ap-soon-list">
              <span>✈ Zagreb (ZAG) <em data-i18n="s1.soon.hr">· Hrvatska</em></span>
              <span>✈ Budimpešta (BUD) <em data-i18n="s1.soon.hu">· Mađarska</em></span>
              <span>✈ Temišvar (TSR) <em data-i18n="s1.soon.ro">· Rumunija</em></span>
            </div>
          </div>
        </div>

        <div class="step-btns" style="margin-top:16px;">
          <button class="btn-next" id="btnN1" disabled onclick="nextStep()" data-i18n="btn.next">Nastavi →</button>
        </div>
      </div>
    </div>

    <!-- Step 2: Travelers -->
    <div class="step-wrap" id="step2">
      <div class="card">
        <h2 data-i18n="s2.h">Izaberi broj putnika (Escapera)</h2>
        <p class="hint" data-i18n="s2.hint"></p>
        <div class="trav-row">
          <div class="trav-info">
            <h3 data-i18n="s2.label">Broj Escapera</h3>
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
        <!-- VIEW A: date list -->
        <div id="s3DateView">
          <h2 data-i18n="s3.h">Izaberi datum putovanja</h2>
          <div class="dates-list" id="datesList"><div style="color:var(--gray);text-align:center;padding:30px;" data-i18n="loading">Učitavanje...</div></div>

          <!-- CTA za custom termin -->
          <button class="custom-cta" onclick="showInquiryView()" type="button">
            <div class="cta-ic">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div class="cta-tx">
              <strong data-i18n="s3.noDates.title">Ne vidim datum koji mi odgovara</strong>
              <small data-i18n="s3.noDates.sub">Pošalji upit za prilagođeni termin</small>
            </div>
            <span class="cta-arr">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </span>
          </button>

          <div class="step-btns">
            <button class="btn-back" onclick="prevStep()" data-i18n="btn.back">← Nazad</button>
            <button class="btn-next" id="btnN3" disabled onclick="nextStep()" data-i18n="btn.next">Nastavi →</button>
          </div>
        </div>

        <!-- VIEW B: custom date inquiry -->
        <div id="s3InquiryView" style="display:none;">
          <div class="inq-panel">
            <button class="inq-back" onclick="hideInquiryView()" type="button">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
              <span data-i18n="inq.back">Nazad na termine</span>
            </button>

            <div class="inq-badge"><span class="dot"></span><span data-i18n="inq.badge">Prilagođeni termin</span></div>
            <h3 class="inq-h" data-i18n="inq.title">Izaberi <em style="font-style:italic;color:#f0b094;">svoj</em> datum putovanja</h3>
            <p class="inq-sub" data-i18n="inq.sub">Odaberi željeni datum polaska i broj noćenja. Naš tim proverava dostupnost i kreira privatni termin za tebe.</p>

            <!-- Calendar -->
            <div class="inq-field">
              <label class="inq-label" data-i18n="inq.date">Datum polaska</label>
              <div class="inq-cal">
                <div class="inq-cal-head">
                  <div class="inq-cal-month" id="inqCalMonth">—</div>
                  <div class="inq-cal-nav">
                    <button id="inqPrevM" type="button" aria-label="Prethodni mesec">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>
                    <button id="inqNextM" type="button" aria-label="Sledeći mesec">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                  </div>
                </div>
                <div class="inq-cal-grid" id="inqCalGrid"></div>
              </div>
              <!-- Range status -->
              <div class="inq-range-status hint" id="inqRangeStatus" data-i18n="inq.range.hint">
                Odaberi datum polaska, pa datum povratka (2 ili 3 noći)
              </div>
            </div>

            <!-- Email -->
            <div class="inq-field">
              <label class="inq-label">Email <span class="opt" data-i18n="inq.email.label">ZA SLANJE LINKA</span></label>
              <div class="inq-field-ic">
                <span class="ic">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </span>
                <input type="email" id="inqEmail" class="inq-control" data-i18n-ph="inq.email.ph" placeholder="ime@gmail.com">
              </div>
            </div>

            <!-- Notes -->
            <div class="inq-field">
              <label class="inq-label"><span data-i18n="inq.notes">Napomena</span> <span class="opt" data-i18n="inq.notes.opt">OPCIONO</span></label>
              <textarea id="inqNotes" class="inq-control" rows="2" data-i18n-ph="inq.notes.ph" placeholder="Npr. preferišem vikend…"></textarea>
            </div>

            <!-- Summary -->
            <div class="inq-summary">
              <div class="sum-ic">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              </div>
              <div data-i18n-html="inq.summary">Naš tim odgovara <strong>u roku od 24h</strong>. Ako termin bude dostupan, dobićeš link za rezervaciju.</div>
            </div>

            <!-- Submit -->
            <button class="inq-submit" id="inqSubmitBtn" onclick="submitInquiry()" type="button">
              <span data-i18n="inq.submit">Pošalji upit</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Step 4: Accommodation -->
    <div class="step-wrap" id="step4">
      <div class="card">
        <h2 data-i18n="s4.h">Izaberi kategoriju smeštaja</h2>
        <p class="hint" data-i18n="s4.hint">Svi naši hoteli se nalaze u blizini centra grada i/ili su u delovima grada koji su dobro povezani javnim prevozom.</p>
        <div id="singleNotice" class="single-notice">
          🛏️ <strong data-i18n="single.warn">Napomena za solo putnike —</strong>
          <span data-i18n="single.msg"> hotelske sobe se standardno rezervišu za 2 osobe. Za jednokrevetnu sobu primenjuje se doplata od +60€.</span>
        </div>
        <div class="accom-grid">
          <div class="accom-tile on" onclick="pickAccom(this,'STANDARD')">
            <div class="a-icon">🏨</div>
            <div class="a-tile-body">
              <div class="a-name" data-i18n="accom.std">Standard</div>
              <div class="a-badge free" data-i18n="accom.std.p">Uključeno</div>
              <div class="a-desc" data-i18n="accom.std.d">3★ hotel ili apartman, dobra lokacija</div>
            </div>
            <div class="a-hover">
              <div class="a-hover-desc" data-i18n="accom.std.hover">Hotel od 3 ★ ili apartman. Udoban smeštaj sa svim osnovnim sadržajima.</div>
            </div>
          </div>
          <div class="accom-tile" onclick="pickAccom(this,'SUPERIOR')">
            <div class="a-icon">✨</div>
            <div class="a-tile-body">
              <div class="a-name" data-i18n="accom.sup">Superior</div>
              <div class="a-badge pay" data-i18n="accom.sup.badge">+100€/os</div>
              <div class="a-desc" data-i18n="accom.sup.d">4★ ili 5★, viša kategorija hotela</div>
            </div>
            <div class="a-hover">
              <div class="a-hover-desc" data-i18n="accom.sup.hover">4★ ili 5★ hotel, pažljivo odabran za svaku destinaciju. Viši nivo komfora, bolja lokacija i usluga koja se primeti — za one koji žele malo više od iznenađenja.</div>
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
        <!-- Ranac — uvek uključen -->
        <div class="suit-row" style="opacity:.75;pointer-events:none;margin-bottom:6px;">
          <div class="e-icon">🎒</div>
          <div class="e-txt" style="flex:1;">
            <div class="e-label">Ranac / personal item (do 10kg)</div>
            <div class="e-desc">Uključeno u svako Escapii putovanje</div>
          </div>
          <div style="font-size:13px;font-weight:700;color:#4ade80;">✓ Uključeno</div>
        </div>

        <!-- Upozorenje o koferu -->
        <div style="margin-bottom:10px;padding:12px 15px;background:rgba(251,191,36,.08);border:1px solid rgba(251,191,36,.3);border-left:3px solid #fbbf24;border-radius:10px;font-size:12px;color:rgba(246,241,230,.75);line-height:1.6;">
          ⚠️ <strong style="color:#fcd34d;">Važno:</strong> Sva Escapii putovanja podrazumevaju ručni prtljag (40 × 30 × 20 cm, do 10kg). Ponekad možemo da obezbedimo i ručni kofer bez doplate, u zavisnosti od aviokompanije i termina — ali to ne možemo da garantujemo. Ako ti je ručni kofer neophodan, <strong style="color:#fcd34d;">izaberi ovu opciju pre nego što završiš rezervaciju.</strong>
        </div>

        <!-- Ručni kofer — opciono -->
        <div class="connecting-tooltip-wrap">
          <div class="suit-row" id="suitRow">
            <div class="e-icon">🧳</div>
            <div class="e-txt">
              <div class="e-label" data-i18n="ext.suit">Dodaj ručni kofer (carry-on)</div>
              <div class="e-desc" data-i18n="ext.suit.d">Dimenzije 55×40×20cm · 50€/smer × 2 smera = 100€/os</div>
            </div>
            <div class="counter">
              <button class="cb" id="suitD" onclick="chSuit(-1)">−</button>
              <div class="cv" id="suitN">0</div>
              <button class="cb" id="suitU" onclick="chSuit(1)">+</button>
            </div>
            <div class="e-price" id="suitPrice">0€</div>
          </div>
          <div class="connecting-tooltip">
            <div class="connecting-tooltip-title">🧳 Ručni kofer (carry-on)</div>
            <div class="connecting-tooltip-body">Cena je po osobi. Podesi broj kofera prema tome koliko putnika na tvojoj rezervaciji želi da putuje sa ručnim koferom. Na kraju rezervacije, u napomeni naznači na čije ime ide svaki kofer koji si odabrao u ovom koraku.</div>
          </div>
        </div>
        <div class="extras-grid">
          <div class="connecting-tooltip-wrap">
            <div class="extra-card" id="ec-hasInsurance" onclick="togExtra(this,'hasInsurance')">
              <div class="extra-card-icon">🛡️</div>
              <div class="extra-card-body">
                <div class="extra-card-title" data-i18n="ext.ins">Putno osiguranje</div>
                <div class="extra-card-sub" data-i18n="ext.ins.d">Pokriva medicinske troškove u inostranstvu. Preporučujemo svim putnicima.</div>
              </div>
              <div class="extra-card-price" data-i18n="ins.price">+12€/noć</div>
              <div class="extra-toggle"></div>
            </div>
            <div class="connecting-tooltip">
              <div class="connecting-tooltip-title" data-i18n="ext.ins.tip.title">🛡️ Putno osiguranje</div>
              <div class="connecting-tooltip-body" data-i18n-html="ext.ins.tip.body">Pokriva <strong>medicinske troškove</strong> u inostranstvu. Preporučujemo svim putnicima ukoliko već nemaju ovaj vid osiguranja.</div>
            </div>
          </div>
          <div class="connecting-tooltip-wrap">
            <div class="extra-card" id="ec-hasBreakfast" onclick="togExtra(this,'hasBreakfast')">
              <div class="extra-card-icon">🍳</div>
              <div class="extra-card-body">
                <div class="extra-card-title" data-i18n="ext.bfst">Doručak u hotelu</div>
                <div class="extra-card-sub" data-i18n="ext.bfst.d">Doručak u hotelu uključen za svaki dan boravka.</div>
              </div>
              <div class="extra-card-price" data-i18n="bfst.price">+20€/os/noć</div>
              <div class="extra-toggle"></div>
            </div>
            <div class="connecting-tooltip">
              <div class="connecting-tooltip-title" data-i18n="ext.bfst.tip.title">🍳 Doručak u hotelu</div>
              <div class="connecting-tooltip-body" data-i18n-html="ext.bfst.tip.body">Doručak u hotelu uključen <strong>svakog dana boravka</strong>. Kreni odmoran i sit — nema brige šta i gde ćeš jesti ujutru.</div>
            </div>
          </div>
          <div class="connecting-tooltip-wrap">
            <div class="extra-card" id="ec-hasSeatsTogether" onclick="togSeats(this)">
              <div class="extra-card-icon">💺</div>
              <div class="extra-card-body">
                <div class="extra-card-title" data-i18n="ext.seats">Želim sedišta jedan pored drugog</div>
                <div class="extra-card-sub" data-i18n="ext.seats.d">po osobi, po smeru leta</div>
              </div>
              <div class="extra-card-price" data-i18n="seats.price">+12€/os/smer</div>
              <div class="extra-toggle"></div>
            </div>
            <div class="connecting-tooltip">
              <div class="connecting-tooltip-title" data-i18n="ext.seats.tip.title">💺 Sedišta zajedno</div>
              <div class="connecting-tooltip-body" data-i18n-html="ext.seats.tip.body">Garantujemo da cela vaša grupa sedi <strong>zajedno</strong>, u oba smera leta. Idealno za parove i grupe koji ne žele da putuju razdvojeni.</div>
            </div>
          </div>
          <div class="connecting-tooltip-wrap">
            <div class="extra-card" id="ec-hasConnectingFlights" onclick="togExtra(this,'hasConnectingFlights')">
              <div class="extra-card-icon">🔄</div>
              <div class="extra-card-body">
                <div class="extra-card-title" data-i18n="ext.connecting">Prihvatam let sa presedanjem</div>
                <div class="extra-card-sub" data-i18n="ext.connecting.d">Letovi sa presedanjem, više destinacija</div>
              </div>
              <div class="extra-card-price" data-i18n="free" style="color:var(--accent3);font-size:12px;font-weight:700">Besplatno</div>
              <div class="extra-toggle"></div>
            </div>
            <div class="connecting-tooltip">
              <div class="connecting-tooltip-title" data-i18n="ext.connecting.tip.title">✈️ Više destinacija, više iznenađenja</div>
              <div class="connecting-tooltip-body" data-i18n-html="ext.connecting.tip.body">Saglasnost na presedanje ti otvara više mogućnosti — destinacije do kojih nema direktnih letova postaju dostupne. <strong>Tvoje iznenađenje može biti još posebnije.</strong></div>
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
        <h2 data-i18n="s6.h">Isključi destinacije na koje ne želiš da te odvedemo</h2>
        <p class="hint" data-i18n="s6.hint">Već bio/bila u Rimu? Ne želiš vikend da provedeš u Berlinu? Imaš mogućnost da izbaciš do 4 destinacije. Prva je besplatna, svaka sledeća se doplaćuje 15€ po osobi.</p>

        <div class="excl-info" id="exclInfoBlock">
          <div class="excl-info-tiers">
            <div class="excl-tier">
              <div class="excl-tier-label" data-i18n="s6.t1.lbl">1. isključivanje</div>
              <div class="excl-tier-price free" data-i18n="free">Besplatno</div>
            </div>
            <div class="excl-tier" id="exclTier2">
              <div class="excl-tier-label" id="exclTier2Label" data-i18n="s6.t2.lbl">2., 3. i 4. isključivanje</div>
              <div class="excl-tier-price high" id="exclTier2Price">+15€/os.</div>
            </div>
          </div>
          <div class="excl-info-note" id="exclSavetNote" style="cursor:default;">
            <span style="font-size:15px;">💡</span>
            <span id="exclNote" data-i18n="s6.note">Escapii savet: ne isključuj previše destinacija.</span>
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
            <div class="f-input-wrap"><input class="f-input" type="text" id="fFirstName" placeholder="Marko" autocomplete="given-name"></div>
            <div class="field-error-msg" data-i18n="err.required"></div>
          </div>
          <div class="form-field" id="ff-lastname">
            <div class="f-label"><span data-i18n="s8.lastname">Prezime nosioca rezervacije</span> <span class="req">*</span></div>
            <div class="f-input-wrap"><input class="f-input" type="text" id="fLastName" placeholder="Marković" autocomplete="family-name"></div>
            <div class="field-error-msg" data-i18n="err.required"></div>
          </div>
          <div class="form-field" id="ff-email">
            <div class="f-label">Email <span class="req">*</span></div>
            <div class="f-input-wrap"><input class="f-input" type="email" id="fEmail" placeholder="youremail@gmail.com"></div>
            <div class="field-error-msg" data-i18n="err.email"></div>
          </div>
          <div class="form-field" id="ff-phone">
            <div class="f-label"><span data-i18n="s8.phone">Telefon</span> <span class="req">*</span></div>
            <div class="f-input-wrap"><input class="f-input" type="tel" id="fPhone" placeholder="+381641234567"></div>
            <div class="field-error-msg" data-i18n="err.required"></div>
          </div>
          <div class="form-field full">
            <div class="f-label" data-i18n="s8.notes">Napomene (opciono)</div>
            <div class="f-input-wrap"><textarea class="f-input" id="fNotes" placeholder="Alergije, posebni zahtevi..." data-i18n-ph="s8.notes.ph"></textarea></div>
          </div>
        </div>
        <div class="payment-info">
          <div class="pi-header">
            <span class="pi-icon">💳</span>
            <span data-i18n="pay.heading">Kako funkcioniše plaćanje?</span>
          </div>
          <ol class="pi-steps">
            <li data-i18n-html="pay.s1">Pošalji upit klikom na dugme ispod — besplatno i bez obaveza</li>
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
    <h2 class="mf-heading" data-i18n="mf.heading">Prva digitalna platforma u Srbiji i regionu za organizovana vikend putovanja iznenađenja po celoj Evropi</h2>
    <div class="mf-tag" data-i18n="mf.why">Zašto da putuješ sa Escapii ekipom?</div>
    <p class="mf-body" data-i18n-html="mf.p1">Zato što najbolje priče počinju sa <em style="color:var(--gold);font-style:normal;">"putujemo sledeći vikend, ali ne znamo gde."</em></p>
    <p class="mf-body" data-i18n-html="mf.p2">Bez obzira na to da li si ti ona osoba koja planira sva putovanja, ili ona za koju drugi organizuju, a prijatelji te i dalje zatrpavaju pitanjima — kraj je uvek isti. Glasaš za destinaciju, biraš hotel, i na kraju se ispostavi da je baš ta destinacija preskupa, let ti poskupljuje već treći put u 24h, a dobar smeštaj je uveliko rasprodat. I onda završiš na vikend putovanju po regionu (nema tu ništa loše, da se razumemo, ali si maštao/la o Siciliji).</p>
    <p class="mf-body" data-i18n-html="mf.p3">A kad konačno dođe dan putovanja, raduješ se ali se i dalje malo preispituješ: da li je hotel na dovoljno dobroj lokaciji, da li si uneo/la sve podatke tačno, da li si odabrao/la pravu destinaciju, da li bi možda Barcelona bila bolja od Lisabona, da li si preplatio/la karte jer si ih kupio/la previše kasno ili previše rano? A faktor iznenađenja? <strong>Nestao je čim si kliknuo/la 'potvrdi rezervaciju'.</strong></p>
    <p class="mf-body" data-i18n-html="mf.p4">Sa Escapii platformom sada možeš da rezervišeš vikend putovanje iznenađenja u Evropi za svega 10 minuta za tebe i celu tvoju ekipu — bez trošenja gomile sati na istraživanje, dogovaranje, kupovinu karata i proveru hotela. Plus da na sve to dobijaš iskustvo koje ćeš pamtiti ceo život.</p>
    <p class="mf-body" data-i18n-html="mf.p5">Zato postoji Escapii. Pronađeš datum koji ti odgovara, a naša ekipa će se pobrinuti za sve ostalo. Nema stresa, nema beskrajnog dogovaranja, nema gomile dosadnih poruka po grupnom četu. Samo ti, tvoja ekipa i onaj mali adrenalin u stomaku dok ne saznate gde to tačno putujete.</p>
    <p class="mf-body" data-i18n-html="mf.p6">A onda kreće uzbuđenje. Svi se radujete i iščekujete nagoveštaje koje vam Escapii tim šalje — analizirate vremensku prognozu i pokušavate da skapirate na koju vas to destinaciju vodimo.</p>
    <blockquote class="mf-quote" data-i18n-html="mf.quote">Escapii nije putovanje koje ćeš zaboraviti. Escapii je avantura koju ćeš prepričavati <em>zauvek</em>.</blockquote>
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

<!-- FOR WHO -->
<section class="esc-who" id="esc-who">
  <div class="who-inner">
    <div class="who-header">
      <span class="sec-tag" data-i18n="who.tag">Budimo iskreni — Escapii nije za svakoga</span>
      <h2 class="sec-heading" data-i18n="who.heading">I to je sasvim okej. Evo kako da znaš da li si na pravom mestu.</h2>
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
    <div class="call-us-icon">✉️</div>
    <h2 class="call-us-heading" data-i18n="callus.h">Nisi siguran? Kontaktiraj nas!</h2>
    <p class="call-us-sub" data-i18n="callus.p">Ako imaš pitanja ili nisi siguran kako sve ovo funkcioniše — Escapii tim je tu za tebe. Piši nam i odgovorićemo ti u najkraćem roku.</p>
    <div class="call-us-actions">
      <a class="call-us-btn primary" href="mailto:escapii.team@gmail.com">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        escapii.team@gmail.com
      </a>
    </div>
    <p class="call-us-note" data-i18n="callus.note">Odgovaramo u roku od 24h</p>
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
// Anti-bot: beleži vreme učitavanja stranice
const _FORM_START = Date.now();

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
    'hero.badge':'Putovanja iznenađenja',
    'hero.h1':'Ti biraš kada. <em>Mi biramo gde.</em>',
    'hero.sub':'Izaberi aerodrom, datum i budžet — sve ostalo organizujemo mi. Destinaciju ćeš saznati tek 48h pre polaska.',
    'hero.cta':'Rezerviši svoje iznenađenje', 'hero.how':'Kako funkcioniše Escapii?',
    'hero.stat.dest':'Destinacija', 'hero.stat.airports':'Aerodroma polaska', 'hero.stat.surprise':'Iznenađenje',
    'mf.tag':'Šta je Escapii?',
    'mf.heading':'Prva digitalna platforma u Srbiji i regionu za organizovana vikend putovanja iznenađenja po celoj Evropi',
    'mf.why':'Zašto da putuješ sa Escapii ekipom?',
    'mf.p1':'Zato što najbolje priče počinju sa <em style="color:var(--gold);font-style:normal;">"putujemo sledeći vikend, ali ne znamo gde."</em>',
    'mf.p2':'Bez obzira na to da li si ti ona osoba koja planira sva putovanja, ili ona za koju drugi organizuju, a prijatelji te i dalje zatrpavaju pitanjima — kraj je uvek isti. Glasaš za destinaciju, biraš hotel, i na kraju se ispostavi da je baš ta destinacija preskupa, let ti poskupljuje već treći put u 24h, a dobar smeštaj je uveliko rasprodat. I onda završiš na vikend putovanju po regionu (nema tu ništa loše, da se razumemo, ali si maštao/la o Siciliji).',
    'mf.p3':'A kad konačno dođe dan putovanja, raduješ se ali se i dalje malo preispituješ: da li je hotel na dovoljno dobroj lokaciji, da li si uneo/la sve podatke tačno, da li si odabrao/la pravu destinaciju, da li bi možda Barcelona bila bolja od Lisabona, da li si preplatio/la karte jer si ih kupio/la previše kasno ili previše rano? A faktor iznenađenja? <strong>Nestao je čim si kliknuo/la \'potvrdi rezervaciju\'.</strong>',
    'mf.p4':'Sa Escapii platformom sada možeš da rezervišeš vikend putovanje iznenađenja u Evropi za svega 10 minuta za tebe i celu tvoju ekipu — bez trošenja gomile sati na istraživanje, dogovaranje, kupovinu karata i proveru hotela. Plus da na sve to dobijaš iskustvo koje ćeš pamtiti ceo život.',
    'mf.p5':'Zato postoji Escapii. Pronađeš datum koji ti odgovara, a naša ekipa će se pobrinuti za sve ostalo. Nema stresa, nema beskrajnog dogovaranja, nema gomile dosadnih poruka po grupnom četu. Samo ti, tvoja ekipa i onaj mali adrenalin u stomaku dok ne saznate gde to tačno putujete.',
    'mf.p6':'A onda kreće uzbuđenje. Svi se radujete i iščekujete nagoveštaje koje vam Escapii tim šalje — analizirate vremensku prognozu i pokušavate da skapirate na koju vas to destinaciju vodimo.',
    'mf.quote':'Escapii nije putovanje koje ćeš zaboraviti. Escapii je avantura koju ćeš prepričavati <em>zauvek</em>.',
    'dest.tag':'Naše destinacije', 'dest.heading':'Sve ovo te čeka…',
    'dest.sub':'Izaberi da isključiš ono što ne voliš — ostatak ostaje misterija',
    'dest.mystery':'Ali ne znaš šta ćeš dobiti',
    'how.tag':'Kako funkcioniše?', 'how.heading':'Četiri koraka do tvoje avanture',
    'how.sub':'Sve što treba je da odabereš polazak i budžet.',
    'how.c1.t':'Kreiraj svoje putovanje iznenađenja.', 'how.c1.p':'Izaberi datum, broj putnika, budžet i dodatke. Isključi destinacije koje ne želiš.',
    'how.c2.t':'Mi organizujemo sve.', 'how.c2.p':'Naša Escapii ekipa će skrojiti iznenađenje baš za tebe — let, hotel i sve ostalo. Na tebi je samo da spakuješ kofer.',
    'how.c3.t':'Otkrij svoje iznenađenje.', 'how.c3.p':'Destinaciju na koju putuješ ćeš saznati 48h pre polaska. Ne brini, 7 dana pred put ćemo ti poslati vremensku prognozu, bez otkrivanja destinacije.',
    'how.c4.t':'Stvori priču za prepričavanje', 'how.c4.p':'"Otišli smo, nismo znali kuda" — uvek bolja priča od "rezervisali smo mesecima unapred".',
    'who.tag':'Budimo iskreni — Escapii nije za svakoga', 'who.heading':'I to je sasvim okej. Evo kako da znaš da li si na pravom mestu.',
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
    'book.tag':'Rezervacija', 'book.heading':'Kreiraj svoje putovanje iznenađenja',
    'loading':'Učitavanje...', 'btn.next':'Nastavi →', 'btn.back':'← Nazad', 'free':'Besplatno',
    's1.h':'Odakle kreće tvoja avantura?', 's1.hint':'Izaberi aerodrom polaska',
    's2.h':'Izaberi broj putnika (Escapera)', 's2.hint':'Svaki putnik unosi ime i pasoš',
    's2.label':'Broj Escapera', 's2.sub':'1 do 6 osoba',
    's3.h':'Izaberi datum putovanja', 's3.hint':'',
    's3.noDates.title':'Ne vidim datum koji mi odgovara',
    's3.noDates.sub':'Pošalji upit za prilagođeni termin',
    'inq.back':'Nazad na termine',
    'inq.badge':'Prilagođeni termin',
    'inq.title':'Izaberi svoj datum putovanja',
    'inq.sub':'Odaberi željeni datum polaska i broj noćenja. Naš tim proverava dostupnost i kreira privatni termin za tebe.',
    'inq.date':'Datum polaska',
    'inq.nights':'Broj noćenja',
    'inq.nights.alert':'Trenutno nudimo termine samo za <strong>2 ili 3 noćenja</strong>. Odaberi jednu od ovih opcija.',
    'inq.email.label':'ZA SLANJE LINKA',
    'inq.email.ph':'ime@gmail.com',
    'inq.notes':'Napomena',
    'inq.notes.opt':'OPCIONO',
    'inq.notes.ph':'Npr. preferišem vikend…',
    'inq.summary':'Naš tim odgovara <strong>u roku od 24h</strong>. Ako termin bude dostupan, dobićeš link za rezervaciju.',
    'inq.submit':'Pošalji upit',
    'inq.ok.t':'Upit primljen!',
    'inq.ok.m':'Naš tim će proveriti dostupnost i javiti ti se na email.',
    'inq.err.date':'Izaberi datum polaska.',
    'inq.err.nights':'Izaberi broj noćenja (2 ili 3 noći).',
    'inq.err.email':'Unesi validnu email adresu.',
    'inq.err.ret':'Odaberi datum povratka.',
    'inq.range.hint':'Odaberi datum polaska, pa datum povratka (2 ili 3 noći)',
    's4.h':'Izaberi kategoriju smeštaja', 's4.hint':'Svi naši hoteli se nalaze u blizini centra grada i/ili su u delovima grada koji su dobro povezani javnim prevozom.',
    'accom.std':'Standard', 'accom.std.p':'Uključeno', 'accom.std.d':'3★ hotel ili apartman, dobra lokacija',
    'accom.sup':'Superior', 'accom.sup.d':'4★ ili 5★, viša kategorija hotela',
    'accom.std.hover':'Hotel od 3 ★ ili apartman. Udoban smeštaj sa svim osnovnim sadržajima.',
    'accom.sup.hover':'4★ ili 5★ hotel, pažljivo odabran za svaku destinaciju. Viši nivo komfora, bolja lokacija i usluga koja se primeti — za one koji žele malo više od iznenađenja.',
    'single.warn':'Napomena za solo putnike —', 'single.msg':' hotelske sobe se standardno rezervišu za 2 osobe. Za jednokrevetnu sobu primenjuje se doplata od +60€.',
    's5.h':'Dodaci', 's5.hint':'Sve je opciono',
    'ext.suit':'Dodaj ručni kofer (carry-on)', 'ext.suit.d':'Dimenzije 55×40×20cm · 50€/smer × 2 smera = 100€/os',
    'ext.ins':'Putno osiguranje', 'ext.ins.d':'Pokriva medicinske troškove u inostranstvu. Preporučujemo svim putnicima.',
    'ext.bfst':'Doručak u hotelu', 'ext.bfst.d':'Doručak u hotelu uključen za svaki dan boravka.',
    'ext.seats':'Želim sedišta jedan pored drugog', 'ext.seats.d':'po osobi, po smeru leta',
    'ext.connecting':'Prihvatam let sa presedanjem', 'ext.connecting.d':'Letovi sa presedanjem, više destinacija',
    'ext.ins.tip.title':'🛡️ Putno osiguranje',
    'ext.ins.tip.body':'Pokriva <strong>medicinske troškove</strong> u inostranstvu. Preporučujemo svim putnicima ukoliko već nemaju ovaj vid osiguranja.',
    'ext.bfst.tip.title':'🍳 Doručak u hotelu',
    'ext.bfst.tip.body':'Doručak u hotelu uključen <strong>svakog dana boravka</strong>. Kreni odmoran i sit — nema brige šta i gde ćeš jesti ujutru.',
    'ext.seats.tip.title':'💺 Sedišta zajedno',
    'ext.seats.tip.body':'Garantujemo da cela vaša grupa sedi <strong>zajedno</strong>, u oba smera leta. Idealno za parove i grupe koji ne žele da putuju razdvojeni.',
    'ext.connecting.tip.title':'✈️ Više destinacija, više iznenađenja',
    'ext.connecting.tip.body':'Saglasnost na presedanje ti otvara više mogućnosti — destinacije do kojih nema direktnih letova postaju dostupne. <strong>Tvoje iznenađenje može biti još posebnije.</strong>',
    's6.h':'Isključi destinacije na koje ne želiš da te odvedemo', 's6.hint':'Već bio/bila u Rimu? Ne želiš vikend da provedeš u Berlinu? Imaš mogućnost da izbaciš do 4 destinacije. Prva destinacija je besplatna, svaka sledeća se doplaćuje 15€ po osobi.',
    's6.t1.lbl':'1. isključivanje', 's6.t2.lbl':'2., 3. i 4. isključivanje',
    's6.note':'Escapii savet: ne isključuj previše destinacija.',
    's7.h':'Podaci o putnicima', 's7.hint':'Unesite podatke za svakog putnika',
    'price.title':'Pregled cene', 'price.total':'Ukupno',
    's8.h':'Kontakt podaci', 's8.hint':'Javićemo se u roku od 24 sata',
    's8.name':'Ime i prezime nosioca rezervacije', 's8.firstname':'Ime nosioca rezervacije', 's8.lastname':'Prezime nosioca rezervacije',
    's8.email':'Email',
    's8.phone':'Telefon', 's8.notes':'Napomene (opciono)', 's8.submit':'Pošalji upit ✓',
    'success.h':'Upit je primljen!',
    'success.p':'Javimo se u roku od 24 sata. Jedva čekamo da vas iznenadimo!',
    'callus.h':'Nisi siguran? Kontaktiraj nas!',
    'callus.p':'Ako imaš pitanja ili nisi siguran kako sve ovo funkcioniše — Escapii tim je tu za tebe. Piši nam i odgovorićemo ti u najkraćem roku.',
    'callus.note':'Odgovaramo u roku od 24h',
    'footer.desc':'Iznenađujuća putovanja za ljude koji su spremni da puste kontrolu.',
    'footer.nav':'Navigacija', 'footer.about':'O nama', 'footer.dest':'Destinacije',
    'footer.how':'Kako funkcioniše', 'footer.who':'Za koga', 'footer.faq':'FAQ',
    'footer.book':'Rezervacija', 'footer.departure':'Polasci', 'footer.rights':'Sva prava zadržana',
    'steps':['Aerodrom','Putnici','Datum','Smeštaj','Dodaci','Isključi','Putnici','Kontakt'],
    'nights': n=>n===1?'1 noć':`${n} noći`, 'slots': n=>`${n} mesta`,
    'excl.n': n=>`${n} isključeno`, 'pax.ph': i=>`Putnik ${i} — Ime i prezime`,
    'gender.m':'Muški', 'gender.f':'Ženski',
    'pax.num': n=>`Putnik ${n}`, 'pax.name':'Ime i prezime', 'pax.name.err':'Unesite ime putnika.', 'pax.dob.err':'Putnik mora imati najmanje 18 godina.',
    'pax.passport':'Zemlja pasoša', 'pax.passport.ph':'npr. Srbija', 'pax.passport.err':'Unesite zemlju pasoša.',
    'pax.valid.passport':'Putnik ima validan pasoš (važeći min. 6 meseci od povratka)',
    'pax.valid.passport.err':'Putnik mora imati validan pasoš da bi nastavio.',
    'pax.gender':'Pol', 'pax.dob':'Datum rođenja',
    'pax.visa':'Aktivne vize (opciono)', 'pax.visa.ph':'npr. Engleska, Irska, Maroko...',
    's1.beg.name':'Aerodrom Nikola Tesla', 's1.ini.name':'Aerodrom Konstantin Veliki',
    's1.soon':'Uskoro i polasci iz susednih zemalja', 's1.soon.title':'Planirana polazišta',
    's1.soon.hr':'· Hrvatska', 's1.soon.hu':'· Mađarska', 's1.soon.ro':'· Rumunija',
    'footer.social':'Pratite nas', 'footer.contact':'Kontakt',
    'footer.status':'🔍 Proveri status rezervacije',
    'footer.terms':'Uslovi korišćenja', 'footer.privacy':'Politika privatnosti', 'footer.cookies':'Kolačići',
    'snav.about':'O nama', 'snav.dest':'Destinacije', 'snav.how':'Kako funkcioniše',
    'snav.who':'Za koga', 'snav.faq':'FAQ', 'snav.call':'✉ Kontaktiraj nas', 'snav.call.hours':'escapii.team@gmail.com', 'snav.book':'Rezerviši',
    'faq.tag':'Česta pitanja', 'faq.heading':'Imaš pitanje?',
    'faq.1.q':'Šta je uključeno u putovanje?',
    'faq.1.a':'Svako putovanje uključuje povratne avio karte i smeštaj. Prevoz do aerodroma i unutar destinacije nije uključen u cenu putovanja.',
    'faq.2.q':'Šta od prtljaga mogu da ponesem?',
    'faq.2.a':'U svim putovanjima je uključen besplatni ručni prtljag. Dozvoljene dimenzije kabinskog prtljaga zavise od avio kompanije sa kojom putuješ — preporučujemo da proveriš mere na sajtu konkretne kompanije.',
    'faq.3.q':'Izmene i otkazivanje',
    'faq.3.a':'Rezervacija se potvrđuje tek nakon uplate na račun. Nakon potvrde, rezervacija se obrađuje u roku od 24 sata i nije moguće izvršiti otkaz. Ukoliko želiš da izmeniš već potvrđenu rezervaciju, primenjuju se uslovi koje nameće avio kompanija ili smeštaj. Sve troškove eventualnih izmena snosi putnik.',
    'swal.excl.title':'Maksimalno 4 isključivanja',
    'swal.excl.html':'Iskoristio/la si sva 4 isključivanja.<br><br><strong style="color:#CA8A71">Prepusti ostatak nama — tu počinje pravo iznenađenje! 🌍</strong>',
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
    'err.srv':'Nešto nije u redu. Pokušajte ponovo, a ako se problem ponovi kontaktirajte nas na escapii.team@gmail.com.', 'err.unexpected':'Neočekivana greška na serveru. Pokušajte ponovo ili nas kontaktirajte na escapii.team@gmail.com.', 'success.ref': id=>`Referenca rezervacije: ${id}`,
    's3.nodates.title':'Nema dostupnih termina',
    's3.nodates.sub':'Trenutno nema otvorenih termina za izabrani aerodrom. Ostavi email — javljamo ti čim se otvore novi.',
    's3.nodates.btn':'Obavesti me',
    'per.p':'/os',
    'accom.sup.badge':'+100€/os',
    'ins.price':'+12€/noć', 'bfst.price':'+20€/os/noći', 'seats.price':'+12€/os/smer',
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
    'trust.1':'Let + hotel uključeni', 'trust.2':'Destinaciju ćeš saznati 48h pre polaska', 'trust.3':'Sarađujemo sa licenciranom turističkom agencijom',
    'pay.heading':'Kako funkcioniše plaćanje?',
    'pay.s1':'Pošalji upit klikom na dugme ispod — besplatno i bez obaveza',
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
    'hero.badge':'Surprise travel experiences',
    'hero.h1':'You choose when. <em>We choose where.</em>',
    'hero.sub':'Choose your airport, date and budget — we handle everything else. You\'ll find out the destination only 48h before departure.',
    'hero.cta':'Book your surprise', 'hero.how':'How does Escapii work?',
    'hero.stat.dest':'Destinations', 'hero.stat.airports':'Departure airports', 'hero.stat.surprise':'Surprise',
    'mf.tag':'What is Escapii?',
    'mf.heading':'The first surprise travel platform in Serbia.',
    'mf.why':'Why Escapii?',
    'mf.p1':'Because the best stories start with <em style="color:var(--gold);font-style:normal;">"we\'re traveling next weekend, but we don\'t know where."</em>',
    'mf.p2':'We all know that feeling. You\'re either the person who plans and organizes every trip, or the one others plan for — yet your friends still bombard you with questions. You vote on a destination, pick a hotel, and it turns out it\'s too expensive, the flight went up in price for the third time in 24 hours, or the good accommodation is already sold out — and you\'re back to square one. Or you end up on a weekend trip in the region (nothing wrong with that, but you were dreaming of Sicily).',
    'mf.p3':'You\'ve searched the same website 4,328 times, you know the map of your destination by heart, you\'ve become an expert — but when you finally go, you already know exactly what to expect. The element of surprise? <strong>Doesn\'t exist.</strong>',
    'mf.p4':'Did you know you can now book a surprise weekend trip in Europe — without spending hours researching, coordinating, and checking hotels? Plus get an experience you\'ll remember for life?',
    'mf.p5':'That\'s exactly why we created Escapii. You find a date that works for you, and our team handles everything else. No stress, no spreadsheets, no 75,430 messages in the group chat. Just you, your crew, and that little flutter in your stomach as you wait to find out where you\'re headed.',
    'mf.p6':'And that\'s where the fun starts. Everyone gets excited and hyped up until 3 days before departure — analyzing the weather forecast and trying to guess the destination, and whoever figures it out doesn\'t pay for the expensive coffee at the airport.',
    'mf.quote':'Escapii is not a trip you\'ll forget. Escapii is an adventure you\'ll be telling stories about <em>forever</em>.',
    'dest.tag':'Our destinations', 'dest.heading':'All this awaits you…',
    'dest.sub':'Choose to exclude what you don\'t like — the rest stays a mystery',
    'dest.mystery':'But you don\'t know what you\'ll get',
    'how.tag':'How does it work?', 'how.heading':'Four steps to your adventure',
    'how.sub':'All you need to do is pick a date and a budget.',
    'how.c1.t':'Create your surprise trip.', 'how.c1.p':'Choose your date, number of travelers, budget and extras. Exclude destinations you don\'t want.',
    'how.c2.t':'We handle everything.', 'how.c2.p':'Our Escapii team will craft the perfect surprise just for you — flight, hotel and everything else. All you need to do is pack your bag.',
    'how.c3.t':'Discover your surprise.', 'how.c3.p':'You\'ll find out your destination 48h before departure. Don\'t worry — 7 days before the trip we\'ll send you a weather forecast, without revealing the destination.',
    'how.c4.t':'Create a story worth telling', 'how.c4.p':'"We left and had no idea where" — always a better story than "we booked months in advance".',
    'who.tag':'Let\'s be honest — Escapii isn\'t for everyone', 'who.heading':'And that\'s completely okay. Here\'s how to know if you\'re in the right place.',
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
    'book.tag':'Booking', 'book.heading':'Create your surprise trip',
    'loading':'Loading...', 'btn.next':'Continue →', 'btn.back':'← Back', 'free':'Free',
    's1.h':'Where does your adventure begin?', 's1.hint':'Select departure airport',
    's2.h':'Select number of travelers (Escapers)', 's2.hint':'Each traveler enters name and passport',
    's2.label':'Number of Escapers', 's2.sub':'1 to 6 persons',
    's3.h':'Select travel date', 's3.hint':'',
    's3.noDates.title':"I don't see a date that works for me",
    's3.noDates.sub':'Send a request for a custom date',
    'inq.back':'Back to dates',
    'inq.badge':'Custom Date',
    'inq.title':'Pick your own travel date',
    'inq.sub':'Select your preferred departure date and number of nights. Our team checks availability and creates a private slot for you.',
    'inq.date':'Departure date',
    'inq.nights':'Number of nights',
    'inq.nights.alert':'We currently offer trips for <strong>2 or 3 nights</strong> only. Please choose one of these options.',
    'inq.email.label':'FOR SENDING THE LINK',
    'inq.email.ph':'name@gmail.com',
    'inq.notes':'Note',
    'inq.notes.opt':'OPTIONAL',
    'inq.notes.ph':'E.g. I prefer weekends…',
    'inq.summary':'Our team replies <strong>within 24h</strong>. If the date is available, you\'ll get a booking link by email.',
    'inq.submit':'Send inquiry',
    'inq.ok.t':'Inquiry received!',
    'inq.ok.m':'Our team will check availability and get back to you by email.',
    'inq.err.date':'Please select a departure date.',
    'inq.err.nights':'Please select 2 or 3 nights.',
    'inq.err.email':'Please enter a valid email address.',
    'inq.err.ret':'Please select a return date.',
    'inq.range.hint':'Select departure date, then return date (2 or 3 nights)',
    's4.h':'Choose accommodation category', 's4.hint':'All our hotels are located near the city center or in well-connected areas.',
    'accom.std':'Standard', 'accom.std.p':'Included', 'accom.std.d':'3★ hotel or apartment, great location',
    'accom.sup':'Superior', 'accom.sup.d':'4★ or 5★, higher category hotel',
    'accom.std.hover':'3★ hotel or apartment. Comfortable accommodation with all the essentials.',
    'accom.sup.hover':'4★ or 5★ hotel, carefully selected for each destination. Higher comfort, better location and service — for those who want a little more.',
    'single.warn':'Note for solo travelers —', 'single.msg':' hotel rooms are standardly reserved for 2 people. A single room supplement of +60€ applies.',
    's5.h':'Add-ons', 's5.hint':'All optional',
    'ext.suit':'Add cabin luggage (carry-on)', 'ext.suit.d':'Dimensions 55×40×20cm · 50€/way × 2 ways = 100€/person',
    'ext.ins':'Travel insurance', 'ext.ins.d':'Covers medical expenses abroad. Recommended for all travelers.',
    'ext.bfst':'Hotel breakfast', 'ext.bfst.d':'Hotel breakfast included for every day of stay.',
    'ext.seats':'I want seats next to each other', 'ext.seats.d':'per person, per flight direction',
    'ext.connecting':'I accept a connecting flight', 'ext.connecting.d':'Connecting flights, more destinations',
    'ext.ins.tip.title':'🛡️ Travel insurance',
    'ext.ins.tip.body':'Covers <strong>medical expenses</strong> abroad. Recommended for all travelers who don\'t already have this type of insurance.',
    'ext.bfst.tip.title':'🍳 Hotel breakfast',
    'ext.bfst.tip.body':'Hotel breakfast included <strong>every day of your stay</strong>. Start refreshed — no need to worry about where to eat in the morning.',
    'ext.seats.tip.title':'💺 Seats together',
    'ext.seats.tip.body':'We guarantee your entire group sits <strong>together</strong>, on both flights. Perfect for couples and groups who don\'t want to travel apart.',
    'ext.connecting.tip.title':'✈️ More destinations, more surprises',
    'ext.connecting.tip.body':'Accepting a connecting flight opens up more possibilities — destinations without a direct flight become available. <strong>Your surprise could be even more special.</strong>',
    's6.h':'Exclude destinations you don\'t want us to take you to',
    's6.hint':'Already been to Rome? Don\'t want to spend a weekend in Berlin? You can exclude up to 4 destinations. The first one is free, each additional costs +15€ per person.',
    's6.t1.lbl':'1st exclusion', 's6.t2.lbl':'2nd, 3rd & 4th exclusion',
    's6.note':'Escapii tip: don\'t exclude too many destinations.',
    's7.h':'Passenger details', 's7.hint':'Enter details for each traveler',
    'price.title':'Price breakdown', 'price.total':'Total',
    's8.h':'Contact details', 's8.hint':'We\'ll get back to you within 24 hours',
    's8.name':'Lead passenger full name', 's8.firstname':'Lead passenger first name', 's8.lastname':'Lead passenger last name',
    's8.email':'Email',
    's8.phone':'Phone', 's8.notes':'Notes (optional)', 's8.submit':'Send inquiry ✓',
    'success.h':'Inquiry received!',
    'success.p':'We\'ll get back to you within 24 hours. We can\'t wait to surprise you!',
    'callus.h':'Not sure? Contact us!',
    'callus.p':'If you have questions or are not sure how this works — the Escapii team is here for you. Write to us and we\'ll get back to you as soon as possible.',
    'callus.note':'We respond within 24 hours',
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
    'pax.passport':'Passport country', 'pax.passport.ph':'e.g. Serbia', 'pax.passport.err':'Please enter passport country.',
    'pax.valid.passport':'Traveler has a valid passport (valid for at least 6 months after return)',
    'pax.valid.passport.err':'Traveler must have a valid passport to proceed.',
    's1.beg.name':'Nikola Tesla Airport', 's1.ini.name':'Constantine the Great Airport',
    's1.soon':'Departures from neighboring countries coming soon', 's1.soon.title':'Planned departures',
    's1.soon.hr':'· Croatia', 's1.soon.hu':'· Hungary', 's1.soon.ro':'· Romania',
    'footer.social':'Follow us', 'footer.contact':'Contact',
    'footer.status':'🔍 Check reservation status',
    'footer.terms':'Terms & Conditions', 'footer.privacy':'Privacy Policy', 'footer.cookies':'Cookies',
    'snav.about':'About', 'snav.dest':'Destinations', 'snav.how':'How it works',
    'snav.who':'Who\'s it for', 'snav.faq':'FAQ', 'snav.call':'✉ Contact us', 'snav.call.hours':'escapii.team@gmail.com', 'snav.book':'Book now',
    'faq.tag':'FAQ', 'faq.heading':'Got a question?',
    'faq.1.q':'What does the trip include?',
    'faq.1.a':'Every trip includes round-trip flights and accommodation. Transportation within the destination city is not included in the price.',
    'faq.2.q':'What luggage can I bring?',
    'faq.2.a':'Free hand luggage is included in all trips. Permitted cabin baggage dimensions depend on the airline you travel with — we recommend checking the allowed measurements on your airline\'s website.',
    'faq.3.q':'Changes and cancellations',
    'faq.3.a':'Your reservation is confirmed only after payment has been received. Once confirmed, the booking is processed within 24 hours and can no longer be canceled. If you wish to make changes to an already confirmed reservation, the conditions imposed by the airline or accommodation provider will apply. All costs arising from any changes are the responsibility of the traveler.',
    'swal.excl.title':'Maximum 4 exclusions',
    'swal.excl.html':'You\'ve used all 4 exclusions.<br><br><strong style="color:#CA8A71">Leave the rest to us — that\'s where the real surprise begins! 🌍</strong>',
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
    'err.srv':'Something went wrong. Please try again — if the problem persists, contact us at escapii.team@gmail.com.', 'err.unexpected':'An unexpected server error occurred. Please try again or contact us at escapii.team@gmail.com.', 'success.ref': id=>`Booking reference: ${id}`,
    's3.nodates.title':'No available dates',
    's3.nodates.sub':'There are currently no open dates for the selected airport. Leave your email — we\'ll notify you when new ones open.',
    's3.nodates.btn':'Notify me',
    'per.p':'/pp',
    'accom.sup.badge':'+100€/pp',
    'ins.price':'+12€/night', 'bfst.price':'+20€/pp/night', 'seats.price':'+12€/pp/way',
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
    'trust.1':'Flight + hotel included', 'trust.2':'Destination revealed 48h before departure', 'trust.3':'We work with a licensed travel agency',
    'pay.heading':'How does payment work?',
    'pay.s1':'Submit your inquiry by clicking the button below — free and with no obligation',
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
      visa:   getVisaValue(i)
    }));
    renderPax();
    savedPax.forEach((p,i)=>{
      const n=document.getElementById('pn'+i);    if(n) n.value=p.name;
      const g=document.getElementById('pg'+i);    if(g) g.value=p.gender;
      const dd=document.getElementById('pd-d-'+i);if(dd) dd.value=p.dob_d;
      const dm=document.getElementById('pd-m-'+i);if(dm) dm.value=p.dob_m;
      const dy=document.getElementById('pd-y-'+i);if(dy) dy.value=p.dob_y;
      // Restore visa chips
      const pvTags=document.getElementById('pv-tags-'+i);
      if(pvTags && p.visa) {
        p.visa.split(',').map(s=>s.trim()).filter(Boolean).forEach(v=>addChip(pvTags,v));
      }
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
      <img src="${destImgUrl(d.name)}" alt="${d.name}" loading="lazy" decoding="async" width="600" height="900">
      <div class="dest-card-label">
        <div class="dest-card-label-name">${carouselDestName(d)}</div>
      </div>
    </div>
  `).join('');
  track.innerHTML = html;
  initCarouselDrag(track);
}

function initCarouselDrag(track) {
  if (!track || track._dragInit) return;
  track._dragInit = true;

  let isDragging = false, startX = 0, currentX = 0, hasDragged = false;

  function getTranslateX() {
    const matrix = new DOMMatrix(window.getComputedStyle(track).transform);
    return matrix.m41;
  }

  function startDrag(x) {
    isDragging = true; hasDragged = false;
    startX = x; currentX = getTranslateX();
    track.classList.add('is-dragging');
    track.style.animation = 'none';
    track.style.transform = `translateX(${currentX}px)`;
  }

  function moveDrag(x) {
    if (!isDragging) return;
    const delta = x - startX;
    if (Math.abs(delta) > 3) hasDragged = true;
    track.style.transform = `translateX(${currentX + delta}px)`;
  }

  function endDrag(x) {
    if (!isDragging) return;
    isDragging = false;
    track.classList.remove('is-dragging');
    const finalX = currentX + (x - startX);
    const half = track.scrollWidth / 2;
    let norm = finalX % half;
    if (norm > 0) norm -= half;
    const delay = -(Math.abs(norm) / half) * 90;
    track.style.transform = '';
    track.style.animation = `carouselScroll 90s linear ${delay}s infinite`;
  }

  track.addEventListener('mousedown', e => { e.preventDefault(); startDrag(e.clientX); });
  window.addEventListener('mousemove', e => moveDrag(e.clientX));
  window.addEventListener('mouseup',   e => endDrag(e.clientX));
  track.addEventListener('touchstart', e => startDrag(e.touches[0].clientX), { passive: true });
  track.addEventListener('touchmove',  e => { if (isDragging) { e.preventDefault(); moveDrag(e.touches[0].clientX); } }, { passive: false });
  track.addEventListener('touchend',   e => endDrag(e.changedTouches[0].clientX));
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
    // Name
    const name=(document.getElementById('pn'+i)||{}).value||'';
    const wrap=document.getElementById('pf-name-'+i);
    if(!name.trim()){
      if(wrap) wrap.classList.add('field-error');
      ok=false;
    } else {
      if(wrap) wrap.classList.remove('field-error');
    }
    // DOB
    const dob = getPaxDob(i);
    const dobWrap = document.getElementById('pf-dob-'+i);
    if(!isAtLeast18(dob)){
      if(dobWrap) dobWrap.classList.add('field-error');
      ok=false; underage=true;
    } else {
      if(dobWrap) dobWrap.classList.remove('field-error');
    }
    // Passport country (required)
    const ppVal=(document.getElementById('pp'+i)||{}).value||'';
    const ppWrap=document.getElementById('pf-passport-'+i);
    if(!ppVal.trim()){
      if(ppWrap) ppWrap.classList.add('field-error');
      ok=false;
    } else {
      if(ppWrap) ppWrap.classList.remove('field-error');
    }
    // Valid passport checkbox (must be checked)
    const chk=document.getElementById('phv'+i);
    const chkWrap=document.getElementById('pf-hvpassport-'+i);
    if(chk && !chk.checked){
      if(chkWrap) chkWrap.classList.add('field-error');
      ok=false;
    } else {
      if(chkWrap) chkWrap.classList.remove('field-error');
    }
  }
  if(!ok) {
    const firstErr = document.querySelector('#step7 .field-error');
    if (firstErr) {
      const top = firstErr.getBoundingClientRect().top + window.scrollY - 120;
      window.scrollTo({ top, behavior: 'instant' });
    }
    const msg = underage ? t('pax.dob.err') : (lang === 'sr' ? 'Unesite sva obavezna polja za svakog putnika.' : 'Please fill in all required fields for each traveler.');
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
  // Private-mode guard: cannot navigate below step 4
  const isPrivate = document.getElementById('esc-booking')?.classList.contains('private-mode');
  if (isPrivate && S.step <= 4) return;
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
  const MONTHS_SR = ['JAN','FEB','MAR','APR','MAJ','JUN','JUL','AVG','SEP','OKT','NOV','DEC'];
  const MONTHS_EN = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
  const daysSr = ['Ned','Pon','Uto','Sre','Čet','Pet','Sub'];
  const daysEn = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
  const [,dm,dd] = d.departureDate.split('-');
  const [,rm,rd] = d.returnDate.split('-');
  const depDay = +dd; const retDay = +rd;
  const depMon = (lang==='sr' ? MONTHS_SR : MONTHS_EN)[+dm-1];
  const retMon = (lang==='sr' ? MONTHS_SR : MONTHS_EN)[+rm-1];
  const depDow = (lang==='sr' ? daysSr : daysEn)[new Date(d.departureDate).getDay()];
  const retDow = (lang==='sr' ? daysSr : daysEn)[new Date(d.returnDate).getDay()];
  const notEnoughSlots = d.availableSlots < S.travelers;
  const isLowStock     = d.availableSlots <= 5 && !notEnoughSlots;
  const isSelected = S.selectedDateId === d.id;

  const stockBadge = notEnoughSlots
    ? `<span class="sold-out-badge">⛔ ${lang==='sr'?`Samo ${d.availableSlots} mesta`:`Only ${d.availableSlots} spots`}</span>`
    : isLowStock
      ? `<span class="low-stock-badge">${lang==='sr'?`Ostalo ${d.availableSlots}`:`${d.availableSlots} left`}</span>`
      : '';

  const cls = notEnoughSlots ? 'term disabled' : `term${isSelected?' on':''}`;
  const onclick = notEnoughSlots ? '' : `onclick="pickDate(this,${d.id},${JSON.stringify(d).replace(/"/g,'&quot;')})"`;
  const tooltipText = notEnoughSlots
    ? (lang==='sr'
        ? `Nema dovoljno mesta — izabrali ste ${S.travelers} putnika, dostupno ${d.availableSlots}.`
        : `Not enough spots — you picked ${S.travelers} travelers, only ${d.availableSlots} available.`)
    : '';
  const tooltip = notEnoughSlots ? `data-tippy-content="${tooltipText}"` : '';
  const nightLabel = lang==='sr' ? `${d.numberOfNights} noći` : `${d.numberOfNights} nights`;

  return `<div class="${cls}" ${onclick} ${tooltip}>
    <div class="term-dates">
      <div class="t-date-block">
        <div class="t-dow">${depDow}</div>
        <div class="t-num">${depDay}</div>
        <div class="t-mon">${depMon}</div>
      </div>
      <div class="t-plane-sep">✈</div>
      <div class="t-date-block">
        <div class="t-dow">${retDow}</div>
        <div class="t-num">${retDay}</div>
        <div class="t-mon">${retMon}</div>
      </div>
    </div>
    <div class="term-mid">
      <span class="t-nights-pill">${nightLabel}</span>
      ${stockBadge}
    </div>
    <div class="term-price">
      <div class="t-price-v">${d.basePrice}€</div>
      <div class="t-price-unit">${t('per.p')}</div>
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
    return `<div class="month-card${isOpen?' open':''}">
      <div class="month-head" onclick="toggleMonth(this)">
        <div class="month-head-left">
          <h3>${mName} ${g.year}</h3>
          <div class="month-meta">${available}/${total} ${lang==='sr'?'termina dostupno':'dates available'}</div>
        </div>
        <div class="chev">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
        </div>
      </div>
      <div class="month-body">
        <div class="month-body-inner">
          ${g.dates.map(d => buildDateRow(d)).join('')}
        </div>
      </div>
    </div>`;
  }).join('');

  tippy('[data-tippy-content]', { theme:'escapii', placement:'top', arrow:true, duration:[200,150] });

  // Escapii savet tooltip na excl-info-note
  const savetEl = document.getElementById('exclSavetNote');
  if (savetEl) {
    tippy(savetEl, {
      content: lang === 'en'
        ? '💡 <strong>Escapii tip</strong><br>Don\'t exclude too many destinations. Even places you\'ve visited before look completely different through the Escapii experience.<br><em>You can take our word for it — or not.</em>'
        : '💡 <strong>Escapii savet</strong><br>Ne isključuj previše destinacija. Čak i destinacije koje poznaješ izgledaju potpuno drugačije kroz Escapii iskustvo.<br><em>Možeš nas poslušati — a i ne moraš.</em>',
      allowHTML: true,
      theme: 'escapii',
      placement: 'top',
      arrow: true,
      duration: [200, 150],
      maxWidth: 280,
    });
  }

  if(S.selectedDateId) {
    const sel = S.dates.find(d => d.id === S.selectedDateId);
    if(sel && sel.availableSlots < S.travelers) {
      S.selectedDateId = null; S.selectedDate = null;
    }
  }
}

function toggleMonth(header) {
  const card = header.parentElement;
  card.classList.toggle('open');
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
  el.innerHTML = '';

  // Loader se prikazuje tek nakon 400ms — da ne treperi ako backend odgovori brzo
  const loaderTimer = setTimeout(() => {
    el.innerHTML = `
      <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:48px 20px;gap:16px">
        <div style="font-size:52px;animation:spinGlobe 1.8s linear infinite;display:inline-block;line-height:1">🌍</div>
        <div style="font-size:13px;letter-spacing:.12em;color:rgba(246,241,230,.5);text-align:center;font-weight:500">
          ${lang==='sr' ? 'Učitavaju se termini...' : 'Loading dates...'}
        </div>
      </div>
      <style>@keyframes spinGlobe{0%{transform:rotate(0deg) scale(1)}50%{transform:rotate(180deg) scale(1.1)}100%{transform:rotate(360deg) scale(1)}}</style>
    `;
  }, 400);
  try {
    const r = await fetch(`${API}/api/dates?airport=${S.airport}`);
    clearTimeout(loaderTimer);
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
    clearTimeout(loaderTimer);
    el.innerHTML=`<div style="color:#f87171;text-align:center;padding:30px;">${t('err.dates.load')}</div>`;
  }
}

function pickDate(el,id,d) {
  document.querySelectorAll('.term').forEach(r => r.classList.remove('on'));
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

  // Svi aerodromi: max 4, cena 15€/os. za 2., 3. i 4.
  if (tier2Label) tier2Label.textContent = lang === 'en' ? '2nd, 3rd & 4th exclusion' : '2., 3. i 4. isključivanje';
  if (tier2Price) { tier2Price.textContent = '+15€/os.'; tier2Price.className = 'excl-tier-price high'; }
  if (hint)       hint.textContent = lang === 'en' ? 'Destinations you want to exclude (optional, max 4)' : 'Već bio/bila u Rimu? Ne želiš vikend da provedeš u Berlinu? Imaš mogućnost da izbaciš do 4 destinacije. Prva je besplatna, svaka sledeća se doplaćuje 15€ po osobi.';
  if (note)       note.textContent = lang === 'en' ? 'We recommend up to 3 exclusions — fewer exclusions means more of a surprise!' : 'Preporučujemo do 3 isključivanja — manje isključivanja znači više iznenađenja!';

  loadPrice();
}

function renderExclGrid() {
  document.getElementById('exclGrid').innerHTML = S.destinations.map(d => `
    <div class="excl-tile${S.excludedIds.includes(d.id) ? ' on' : ''}" id="ex-${d.id}" onclick="togExcl(${d.id})">
      <img src="${destImgUrl(d.name)}" alt="${d.name}" loading="lazy" decoding="async" width="600" height="900">
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
    const maxExcl = 4;
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

// ── Tag input helpers ──────────────────────────────────────────────────────────
function addChip(container, text) {
  const inp = container.querySelector('input');
  const chip = document.createElement('span');
  chip.className = 't-chip';
  chip.innerHTML = '<span class="chip-label">' + text + '</span>'
    + '<button type="button" aria-label="Ukloni"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>';
  chip.querySelector('button').addEventListener('click', () => chip.remove());
  container.insertBefore(chip, inp);
}

function initTagInputs() {
  document.querySelectorAll('.t-tags').forEach(container => {
    const inp = container.querySelector('input');
    if (!inp || inp._tagInited) return;
    inp._tagInited = true;
    inp.addEventListener('keydown', function(e) {
      if ((e.key === 'Enter' || e.key === ',') && this.value.trim()) {
        e.preventDefault();
        addChip(container, this.value.trim());
        this.value = '';
      }
      if (e.key === 'Backspace' && !this.value) {
        const chips = container.querySelectorAll('.t-chip');
        if (chips.length) chips[chips.length - 1].remove();
      }
    });
    inp.addEventListener('input', function() {
      if (this.value.endsWith(',')) {
        const val = this.value.slice(0, -1).trim();
        if (val) addChip(container, val);
        this.value = '';
      }
    });
    inp.addEventListener('blur', function() {
      const val = this.value.trim();
      if (val) { addChip(container, val); this.value = ''; }
    });
    container.addEventListener('click', () => inp.focus());
  });
}

function getVisaValue(i) {
  const container = document.getElementById('pv-tags-' + i);
  if (!container) return (document.getElementById('pv' + i) || {}).value || '';
  const chips = [...container.querySelectorAll('.chip-label')].map(s => s.textContent.trim()).filter(Boolean);
  const inp = ((document.getElementById('pv' + i) || {}).value || '').trim();
  return [...chips, ...(inp ? [inp] : [])].join(', ');
}

function renderPax() {
  // Format return date for passport validity hint
  let retHint = '';
  if (S.selectedDate) {
    const [ry, rm, rd] = S.selectedDate.returnDate.split('-');
    const ms = lang === 'sr'
      ? ['jan','feb','mar','apr','maj','jun','jul','avg','sep','okt','nov','dec']
      : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    retHint = `${+rd}. ${ms[+rm-1]}. ${ry}.`;
  }
  const passportSmall = (lang === 'sr' ? 'Važeći najmanje 6 meseci od datuma povratka' : 'Valid at least 6 months from return date')
    + (retHint ? ' (' + retHint + ')' : '');

  document.getElementById('paxList').innerHTML = Array.from({length:S.travelers},(_,i) => `
    <div class="pax-item">
      <div class="traveler-head">
        <div class="traveler-num">${i+1}</div>
        <span class="traveler-lbl">${lang==='sr'?'Putnik':'Traveler'} ${i+1}</span>
      </div>
      <div class="traveler-grid">

        <div class="traveler-field full" id="pf-name-${i}">
          <label>${t('pax.name')} <span class="req">*</span></label>
          <div class="t-field-ic">
            <input class="t-control" id="pn${i}" type="text" placeholder="${t('pax.ph',i+1)}" autocomplete="off">
            <svg class="t-ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          </div>
          <div class="field-error-msg">${t('pax.name.err')}</div>
        </div>

        <div class="traveler-field">
          <label>${t('pax.gender')} <span class="req">*</span></label>
          <div class="t-sel-wrap">
            <select class="t-control" id="pg${i}">
              <option value="M">${t('gender.m')}</option>
              <option value="F">${t('gender.f')}</option>
            </select>
          </div>
        </div>

        <div class="traveler-field" id="pf-dob-${i}">
          <label>${t('pax.dob')} <span class="req">*</span></label>
          <div class="traveler-triple">
            <div class="t-sel-wrap"><select class="t-control" id="pd-d-${i}">${dobDays()}</select></div>
            <div class="t-sel-wrap"><select class="t-control" id="pd-m-${i}">${dobMonths()}</select></div>
            <div class="t-sel-wrap"><select class="t-control" id="pd-y-${i}">${dobYears()}</select></div>
          </div>
          <div class="field-error-msg">${t('pax.dob.err')}</div>
        </div>

        <div class="traveler-field full">
          <label>${t('pax.visa')} <span class="opt">${lang==='sr'?'opciono':'optional'}</span></label>
          <div class="t-tags" id="pv-tags-${i}">
            <input id="pv${i}" type="text" placeholder="${t('pax.visa.ph')}" autocomplete="off" maxlength="100">
          </div>
        </div>

        <div class="traveler-field full" id="pf-passport-${i}">
          <label>${t('pax.passport')} <span class="req">*</span></label>
          <input class="t-control" id="pp${i}" type="text" placeholder="${t('pax.passport.ph')}" maxlength="100" autocomplete="off">
          <div class="field-error-msg">${t('pax.passport.err')}</div>
        </div>

        <div class="traveler-field full">
          <label class="passport-check" id="pf-hvpassport-${i}">
            <input type="checkbox" id="phv${i}">
            <div class="t-chk-box">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="t-chk-tx">
              ${t('pax.valid.passport')}
              <small>${passportSmall}</small>
            </div>
          </label>
          <div class="pax-chk-err" id="pf-hvpassport-err-${i}">${t('pax.valid.passport.err')}</div>
        </div>

      </div>
    </div>`
  ).join('');
  initTagInputs();
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
    if(p.breakfastPerPerson>0) { const bfstTotal=p.breakfastPerPerson*p.numberOfTravelers; const bfstSub=lang==='sr'?`20€/os/noć`:`20€/pp/night`; const bfstPers=lang==='sr'?`${p.numberOfNights} noći × ${p.numberOfTravelers} os`:`${p.numberOfNights} nights × ${p.numberOfTravelers} pp`; html+=`<div class="pr-row"><span><span>${t('pr.bfst')} (${bfstPers})</span><br><span style="font-size:11px;opacity:.55;">${bfstSub}</span></span><span>+${bfstTotal}€</span></div>`; }
    if(p.seatsTogether>0) html+=`<div class="pr-row"><span>${t('pr.seats')}</span><span>+${p.seatsTogether}€${pp}</span></div>`;
    if(p.exclusionCostFlat>0) { const exclPP=Math.round(p.exclusionCostFlat/p.numberOfTravelers); html+=`<div class="pr-row"><span>${t('pr.excl')}</span><span>+${exclPP}€${pp}</span></div>`; }
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
      priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.bfst')} (${p.numberOfNights} ${lang==='sr'?'noći':'nights'} × ${n} ${lang==='sr'?'os':'pp'})<br><small style="opacity:.55;font-size:11px;">20€/os/noć</small></span><span>+${p.breakfastPerPerson * n}€</span></div>`;
    if (p.seatsTogether > 0)
      priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.seats')}</span><span>+${p.seatsTogether * n}€</span></div>`;
    if (p.exclusionCostFlat > 0) {
      const exclPP = Math.round(p.exclusionCostFlat / n);
      priceRowsHtml += `<div class="bs-pr-row"><span>${t('pr.excl')}</span><span>+${exclPP}€${t('per.p')} × ${n} = +${p.exclusionCostFlat}€</span></div>`;
    }
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
    passportNumber:(document.getElementById('pp'+i)||{}).value?.trim()||'',
    hasValidPassport:!!(document.getElementById('phv'+i)||{checked:false}).checked,
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
    notes:document.getElementById('fNotes').value,
    // Anti-bot polja
    website: document.getElementById('hp_website')?.value || '',
    formDuration: Math.round((Date.now() - _FORM_START) / 1000)
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
        ref:        d.bookingRef,
        travelers:  S.travelers || 1,
        passengers: passengers.map(p => (p.name || '').toUpperCase()).filter(Boolean)
      }));
      window.location.href = '/hvala?ref=' + encodeURIComponent(d.bookingRef);
    } else if(r.status === 409) {
      const errMsg409 = d.error || '';
      if (errMsg409.includes('slobodnih mesta') || errMsg409.includes('No spots')) {
        // Mesta popunjena — vrati na korak 3
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
        // Duplikat rezervacije ili drugi 409 — prikaži konkretnu poruku
        await Swal.fire({
          icon: 'warning',
          title: lang==='sr' ? 'Rezervacija nije moguća' : 'Booking not allowed',
          text: errMsg409 || t('err.srv'),
          confirmButtonColor: '#CA8A71',
          background: '#2D5F6B',
          color: '#fff'
        });
        btn.disabled=false; btn.textContent=t('s8.submit');
      }
    } else {
      // Sve ostale greške (4xx, 5xx) — user-friendly poruka, bez backend detalja
      Swal.fire({icon:'error',title:lang==='sr'?'Nešto nije u redu':'Something went wrong',
        text:t('err.srv'),
        confirmButtonColor:'#CA8A71',background:'#2D5F6B',color:'#fff'});
      btn.disabled=false; btn.textContent=t('s8.submit');
    }
  } catch(e) {
    // Mrežna greška (fetch sam failovao — backend nedostupan, timeout…)
    Swal.fire({icon:'error',title:lang==='sr'?'Mrežna greška':'Network error',
      text:t('err.unexpected'),
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
  // Forsira autoplay na mobilnom (iOS ignoruje autoplay atribut)
  const hv = document.querySelector('.hero-video');
  if (hv) {
    hv.muted = true;
    const tryPlay = () => hv.play().catch(() => {});
    tryPlay();
    hv.addEventListener('canplay', tryPlay, { once: true });
    hv.addEventListener('loadeddata', tryPlay, { once: true });
    // iOS zahteva user gesture — pokreni na prvom touchu/scrollu
    const onInteract = () => { tryPlay(); document.removeEventListener('touchstart', onInteract); window.removeEventListener('scroll', onInteract); };
    document.addEventListener('touchstart', onInteract, { once: true, passive: true });
    window.addEventListener('scroll', onInteract, { once: true, passive: true });
  }
});
window.addEventListener('load', equalFeatCards);
window.addEventListener('resize', equalFeatCards);

// ══════════════════════════════════════════════════════════════════
// CUSTOM DATE INQUIRY — range calendar picker (2 or 3 nights only)
// ══════════════════════════════════════════════════════════════════

let _inqDep      = null;   // departure Date
let _inqRet      = null;   // return Date
let _inqCurMonth = null;   // displayed month (1st of month)
let _inqHover    = null;   // hovered date (for range preview)

const INQ_MONTHS_SR = ['Januar','Februar','Mart','April','Maj','Jun','Jul','Avgust','Septembar','Oktobar','Novembar','Decembar'];
const INQ_MONTHS_EN = ['January','February','March','April','May','June','July','August','September','October','November','December'];
const INQ_DOWS_SR   = ['PON','UTO','SRE','ČET','PET','SUB','NED'];
const INQ_DOWS_EN   = ['MON','TUE','WED','THU','FRI','SAT','SUN'];
const INQ_DAYS_SR   = ['Ned','Pon','Uto','Sre','Čet','Pet','Sub'];
const INQ_DAYS_EN   = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];

function showInquiryView() {
  document.getElementById('s3DateView').style.display = 'none';
  document.getElementById('s3InquiryView').style.display = 'block';
  const now = new Date();
  _inqCurMonth = new Date(now.getFullYear(), now.getMonth(), 1);
  _inqDep = null; _inqRet = null; _inqHover = null;
  renderInqCalendar();
  updateInqRangeStatus();
  const emailEl = document.getElementById('contactEmail');
  if (emailEl && emailEl.value) document.getElementById('inqEmail').value = emailEl.value;
}

function hideInquiryView() {
  document.getElementById('s3InquiryView').style.display = 'none';
  document.getElementById('s3DateView').style.display = 'block';
}

function inqDateDiff(a, b) {
  // Returns difference in whole days (b - a)
  return Math.round((b - a) / 86400000);
}

function inqFmtDate(date) {
  const days  = lang === 'sr' ? INQ_DAYS_SR  : INQ_DAYS_EN;
  const months= lang === 'sr' ? INQ_MONTHS_SR : INQ_MONTHS_EN;
  return `${days[date.getDay()]}, ${date.getDate()}. ${months[date.getMonth()].slice(0,3).toLowerCase()}.`;
}

function updateInqRangeStatus() {
  const el = document.getElementById('inqRangeStatus');
  if (!el) return;
  el.className = 'inq-range-status';
  if (!_inqDep && !_inqRet) {
    el.className += ' hint';
    el.textContent = lang==='sr'
      ? 'Odaberi datum polaska, pa datum povratka (2 ili 3 noći)'
      : 'Select departure, then return date (2 or 3 nights)';
  } else if (_inqDep && !_inqRet) {
    el.className += ' dep-set';
    el.innerHTML = (lang==='sr'
      ? `✈️ Polazak: <strong>${inqFmtDate(_inqDep)}</strong> — sada odaberi datum povratka`
      : `✈️ Departure: <strong>${inqFmtDate(_inqDep)}</strong> — now select return date`);
  } else if (_inqDep && _inqRet) {
    const nights = inqDateDiff(_inqDep, _inqRet);
    el.className += ' valid';
    el.innerHTML = `✓ ${inqFmtDate(_inqDep)} → ${inqFmtDate(_inqRet)} &nbsp;·&nbsp; <strong>${nights} ${lang==='sr'?'noći':'nights'}</strong>`;
  }
}

// Lightweight hover update — never re-renders the grid, so clicks are never disrupted
function updateInqHoverClasses() {
  const grid = document.getElementById('inqCalGrid');
  if (!grid) return;
  const hoverDiff = (_inqDep && _inqHover) ? inqDateDiff(_inqDep, _inqHover) : 0;
  grid.querySelectorAll('button.inq-cal-day').forEach(btn => {
    const ts  = Number(btn.dataset.ts);
    const d   = new Date(ts);
    btn.classList.remove('in-range-preview', 'dep-hover');
    if (!_inqDep || _inqRet || !_inqHover) return;
    if (d > _inqDep && d < _inqHover && (hoverDiff === 2 || hoverDiff === 3))
      btn.classList.add('in-range-preview');
    if (d.toDateString() === _inqHover.toDateString() && hoverDiff > 0)
      btn.classList.add('dep-hover');
  });
}

function renderInqCalendar() {
  const monthNames = lang === 'sr' ? INQ_MONTHS_SR : INQ_MONTHS_EN;
  const dows       = lang === 'sr' ? INQ_DOWS_SR   : INQ_DOWS_EN;
  document.getElementById('inqCalMonth').textContent =
    `${monthNames[_inqCurMonth.getMonth()]} ${_inqCurMonth.getFullYear()}`;

  const grid = document.getElementById('inqCalGrid');
  grid.innerHTML = '';
  dows.forEach(d => {
    const el = document.createElement('div');
    el.className = 'inq-cal-dow'; el.textContent = d;
    grid.appendChild(el);
  });

  const today    = new Date(); today.setHours(0,0,0,0);
  const tomorrow = new Date(today); tomorrow.setDate(today.getDate() + 1);
  const maxDate  = new Date(today); maxDate.setMonth(today.getMonth() + 3);

  const firstDay = new Date(_inqCurMonth.getFullYear(), _inqCurMonth.getMonth(), 1);
  const lastDay  = new Date(_inqCurMonth.getFullYear(), _inqCurMonth.getMonth() + 1, 0);
  let startDow = firstDay.getDay() - 1; if (startDow < 0) startDow = 6;
  const prevLast = new Date(_inqCurMonth.getFullYear(), _inqCurMonth.getMonth(), 0).getDate();

  // Prev month trailing days (muted)
  for (let i = startDow; i > 0; i--) {
    const el = document.createElement('div');
    el.className = 'inq-cal-day muted'; el.textContent = prevLast - i + 1;
    grid.appendChild(el);
  }

  // Current month days
  for (let d = 1; d <= lastDay.getDate(); d++) {
    const date = new Date(_inqCurMonth.getFullYear(), _inqCurMonth.getMonth(), d);
    const el = document.createElement('button');
    el.type = 'button'; el.textContent = d;

    const tooEarly = date < tomorrow;
    const tooLate  = date > maxDate;

    if (tooEarly || tooLate) {
      el.className = 'inq-cal-day'; el.disabled = true;
      grid.appendChild(el); continue;
    }

    let cls = 'inq-cal-day';
    if (date.toDateString() === today.toDateString()) cls += ' today';

    const isDep = _inqDep && date.toDateString() === _inqDep.toDateString();
    const isRet = _inqRet && date.toDateString() === _inqRet.toDateString();

    if (isDep) cls += ' dep';
    if (isRet) cls += ' ret';

    // In-range highlight (between dep and ret)
    if (_inqDep && _inqRet && date > _inqDep && date < _inqRet) cls += ' in-range';

    // Hover preview: if dep is set, ret isn't, and user is hovering
    if (_inqDep && !_inqRet && _inqHover) {
      const diff = inqDateDiff(_inqDep, _inqHover);
      if ((diff === 2 || diff === 3) && date > _inqDep && date < _inqHover) cls += ' in-range-preview';
      if (date.toDateString() === _inqHover.toDateString() && diff > 0) cls += ' dep-hover';
    }

    el.className = cls;
    el.dataset.ts = date.getTime(); // needed for lightweight hover update

    el.addEventListener('click', () => {
      if (!_inqDep || _inqRet) {
        // Start fresh: set as departure
        _inqDep = date; _inqRet = null;
      } else {
        // Dep is set, set return
        const diff = inqDateDiff(_inqDep, date);
        if (diff < 1) {
          // Clicked before or on departure — restart
          _inqDep = date; _inqRet = null;
        } else if (diff === 2 || diff === 3) {
          _inqRet = date;
        } else {
          // Invalid range — show error in status
          const statusEl = document.getElementById('inqRangeStatus');
          if (statusEl) {
            statusEl.className = 'inq-range-status invalid';
            statusEl.innerHTML = lang==='sr'
              ? `⚠️ Moguće je odabrati samo <strong>2 ili 3 noći</strong>. Pokušaj ponovo.`
              : `⚠️ Only <strong>2 or 3 nights</strong> are allowed. Try again.`;
            setTimeout(() => updateInqRangeStatus(), 2500);
          }
          return; // don't re-render, keep dep selected
        }
      }
      _inqHover = null;
      renderInqCalendar();
      updateInqRangeStatus();
    });

    // Hover preview — update classes only (no full re-render, avoids click disruption)
    el.addEventListener('mouseenter', () => {
      if (_inqDep && !_inqRet) { _inqHover = date; updateInqHoverClasses(); }
    });
    el.addEventListener('mouseleave', () => {
      if (_inqDep && !_inqRet) { _inqHover = null; updateInqHoverClasses(); }
    });

    grid.appendChild(el);
  }

  // Next month leading days (muted)
  const total = startDow + lastDay.getDate();
  const trail = (7 - (total % 7)) % 7;
  for (let i = 1; i <= trail; i++) {
    const el = document.createElement('div');
    el.className = 'inq-cal-day muted'; el.textContent = i;
    grid.appendChild(el);
  }
}

// Calendar nav — attached once on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('inqPrevM').addEventListener('click', () => {
    const prev = new Date(_inqCurMonth); prev.setMonth(prev.getMonth() - 1);
    const now  = new Date(); now.setHours(0,0,0,0);
    const minMonth = new Date(now.getFullYear(), now.getMonth(), 1);
    if (prev >= minMonth) { _inqCurMonth = prev; renderInqCalendar(); }
  });
  document.getElementById('inqNextM').addEventListener('click', () => {
    const next = new Date(_inqCurMonth); next.setMonth(next.getMonth() + 1);
    const now  = new Date(); now.setHours(0,0,0,0);
    const maxMonth = new Date(now.getFullYear(), now.getMonth() + 4, 1);
    if (next < maxMonth) { _inqCurMonth = next; renderInqCalendar(); }
  });
});

async function submitInquiry() {
  if (!_inqDep) return showFormAlert(t('inq.err.date'));
  if (!_inqRet) return showFormAlert(t('inq.err.ret'));
  const emailVal = document.getElementById('inqEmail').value.trim();
  if (!emailVal || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal))
                 return showFormAlert(t('inq.err.email'));

  const btn = document.getElementById('inqSubmitBtn');
  btn.disabled = true;

  const pad     = n => String(n).padStart(2,'0');
  const dateStr = `${_inqDep.getFullYear()}-${pad(_inqDep.getMonth()+1)}-${pad(_inqDep.getDate())}`;
  const nights  = inqDateDiff(_inqDep, _inqRet);

  try {
    const r = await fetch(`${API}/api/inquiries/custom-date`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        airport:              S.airport || 'BEG',
        travelers:            S.travelers || 1,
        desiredDepartureDate: dateStr,
        nights:               nights,
        email:                emailVal,
        notes:                document.getElementById('inqNotes').value.trim() || null
      })
    });

    if (r.ok) {
      hideInquiryView();
      await Swal.fire({
        title: t('inq.ok.t'), text: t('inq.ok.m'), icon: 'success',
        confirmButtonColor: 'var(--accent)',
        background: '#1a3a42', color: '#f6f1e6',
      });
    } else {
      const err = await r.json().catch(() => ({}));
      showFormAlert(err.error || (lang==='sr' ? 'Greška pri slanju.' : 'Send error.'));
      btn.disabled = false;
    }
  } catch(e) {
    showFormAlert(lang==='sr' ? 'Greška pri slanju. Proveri konekciju.' : 'Send error. Check connection.');
    btn.disabled = false;
  }
}

// ══════════════════════════════════════════════════════════════════
// PRIVATE DATE DETECTION (?privateDate=TOKEN)
// Korisnik dolazi sa privatnim linkom koji mu admin pošalje.
// API vraća DateResponse koji sadrži: id, departureAirport, availableSlots, ...
// Frontend pre-popunjava S i preskače direktno na Korak 4.
// ══════════════════════════════════════════════════════════════════

async function checkPrivateDateToken() {
  const params = new URLSearchParams(window.location.search);
  const token  = params.get('privateDate');
  if (!token) return;

  // Prikaži overlay za učitavanje
  const sectionEl = document.getElementById('booking');
  sectionEl?.scrollIntoView({ behavior: 'smooth' });

  try {
    const r = await fetch(`${API}/api/dates/private?token=${encodeURIComponent(token)}`);
    if (!r.ok) {
      const msg = r.status === 410
        ? (lang === 'sr' ? 'Privatni link je istekao. Kontaktirajte Escapii tim.' : 'This private link has expired. Contact the Escapii team.')
        : (lang === 'sr' ? 'Privatni link nije validan.' : 'This private link is not valid.');
      await Swal.fire({ title: '⛔', text: msg, icon: 'error', confirmButtonColor: 'var(--accent)', background: '#1a3a42', color: '#f6f1e6' });
      return;
    }

    const date = await r.json();

    // Pre-popuni S state
    S.airport        = date.departureAirport;
    S.travelers      = date.availableSlots;     // admin je postavio slots = travelers iz upita
    S.selectedDateId = date.id;
    S.selectedDate   = date;                    // potrebno za boarding pass datume na hvala stranici
    S.dates          = [date];                  // niz sa jednim datumom (za price preview)
    S.step           = 4;

    // Ukloni token iz URL-a (bez reload-a)
    const cleanUrl = window.location.pathname + window.location.hash;
    window.history.replaceState({}, '', cleanUrl);

    // Prikaži korak 4 — sakrij Back dugmad (korisnik ne sme da se vrati na prethodne korake)
    document.getElementById('esc-booking')?.classList.add('private-mode');
    onEnter();
    showStep(4);

    // Notify korisnika
    const departureFmt = new Date(date.departureDate).toLocaleDateString(lang === 'sr' ? 'sr-Latn-RS' : 'en-GB', { day:'numeric', month:'long', year:'numeric' });
    await Swal.fire({
      title: lang === 'sr' ? '🔒 Privatni termin' : '🔒 Private slot',
      html:  lang === 'sr'
        ? `Tvoj privatni termin je spreman!<br><strong>${departureFmt}</strong> · ${date.numberOfNights} ${date.numberOfNights === 1 ? 'noć' : 'noći'} · ${S.travelers} ${S.travelers === 1 ? 'putnik' : 'putnika'}<br><br>Nastavi sa izborom smeštaja.`
        : `Your private slot is ready!<br><strong>${departureFmt}</strong> · ${date.numberOfNights} night${date.numberOfNights !== 1 ? 's' : ''} · ${S.travelers} traveller${S.travelers !== 1 ? 's' : ''}<br><br>Continue with accommodation selection.`,
      icon:  'success',
      confirmButtonColor: 'var(--accent)',
      background: '#1a3a42',
      color: '#f6f1e6',
    });

  } catch(e) {
    console.warn('[Escapii] Private date check failed:', e);
  }
}

// Pokreni proveru privatnog linka čim je DOM spreman
document.addEventListener('DOMContentLoaded', checkPrivateDateToken);

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
