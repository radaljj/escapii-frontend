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
  <title>Pokloni putovanje iznenađenja - Poklon vaučer | Escapii</title>
  <meta name="description" content="Pokloni avanturu koja se pamti. Ti biraš budžet, mi biramo destinaciju i organizujemo sve. Savršen poklon za rođendan ili godišnjicu.">
  <link rel="canonical" href="<?php echo esc_url($site_url); ?>/pokloni/">
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
    .mob-menu-call { flex-direction:column; align-items:flex-start; gap:2px; }
    .mob-menu-call-hours { font-size:12px; font-weight:500; color:rgba(255,255,255,.4); }
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

    /* ══ NOVI GIFT HERO (gv-) — sistemski font + Georgia za vaučer ═══════════ */
    .gv-hero { position:relative; background:#16313a; overflow:hidden; padding:120px 56px 104px; }
    .gv-hero::before { content:""; position:absolute; inset:0; z-index:0;
      background:
        radial-gradient(60% 90% at 18% -10%, rgba(80,130,140,.5) 0%, rgba(22,49,58,0) 60%),
        radial-gradient(50% 80% at 92% 115%, rgba(200,119,90,.22) 0%, rgba(22,49,58,0) 60%); }
    .gv-hero::after { content:""; position:absolute; inset:0; z-index:0; opacity:.4;
      background-image:radial-gradient(rgba(255,255,255,.05) 1px, transparent 1px); background-size:28px 28px; }
    /* Suptilne konture / putanje leta preko teala */
    .gv-bg { position:absolute; inset:0; width:100%; height:100%; z-index:0; pointer-events:none; opacity:.5; }
    .gv-grid { position:relative; z-index:2; max-width:1200px; margin:0 auto;
      display:grid; grid-template-columns:1fr 1fr; gap:56px; align-items:center; }

    .gv-pill { display:inline-flex; align-items:center; gap:9px;
      font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#fbe3d6;
      background:rgba(200,119,90,.2); border:1px solid rgba(200,119,90,.5);
      padding:8px 16px; border-radius:100px; margin-bottom:26px; }
    .gv-h1 { font-weight:800; color:#fff; margin:0 0 20px;
      font-size:clamp(40px,4.6vw,62px); line-height:1.05; letter-spacing:-1.5px; }
    .gv-h1 em { font-style:italic; color:#f0c3ae; }
    .gv-sub { font-size:19px; line-height:1.6; color:rgba(255,255,255,.74); margin:0 0 34px; max-width:42ch; }
    .gv-cta { display:flex; align-items:center; gap:18px; flex-wrap:wrap; }
    .gv-btn { font-size:15px; font-weight:600; text-decoration:none; cursor:pointer; border:none; font-family:inherit;
      display:inline-flex; align-items:center; gap:10px; padding:17px 30px; border-radius:100px; transition:.2s; }
    .gv-btn-primary { background:#a85e44; color:#fff; box-shadow:0 16px 34px -16px rgba(168,94,68,.8); }
    .gv-btn-primary:hover { background:#c8775a; transform:translateY(-2px); }
    .gv-trust { display:flex; align-items:center; gap:9px; font-size:13px; color:rgba(255,255,255,.62); }
    .gv-trust svg { width:15px; height:15px; color:#7fb0a0; }

    .gv-stage { position:relative; height:480px; display:flex; align-items:center; justify-content:center; }
    .gv-stage::before { content:""; position:absolute; width:380px; height:380px; border-radius:50%;
      background:radial-gradient(circle, rgba(200,119,90,.4), transparent 68%); filter:blur(20px); }
    .gv-voucher { position:relative; width:420px; transform:rotate(-7deg);
      filter:drop-shadow(0 40px 70px rgba(0,0,0,.45)); animation:gv-float 6s ease-in-out infinite; }
    @keyframes gv-float { 0%,100%{transform:rotate(-7deg) translateY(0);} 50%{transform:rotate(-7deg) translateY(-14px);} }
    @media (prefers-reduced-motion:reduce) { .gv-voucher{ animation:none; } }

    .gv-card { display:flex; background:#fffdf8; border-radius:18px; overflow:hidden; }
    .gv-card-main { flex:1; padding:26px 24px; }
    .gv-card-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:22px; }
    .gv-card-logo { height:26px; width:auto; display:block; }
    .gv-mini-tag { font-size:8px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;
      color:#a85e44; border:1px solid #e6c6b6; background:#faf0ea; padding:5px 10px; border-radius:100px; }
    .gv-route { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
    .gv-iata { font-family:Georgia,'Times New Roman',serif; font-weight:700; font-size:38px; color:#1a1410; line-height:1; letter-spacing:-1px; }
    .gv-iata.gv-dest { color:#a85e44; font-style:italic; }
    .gv-iata-sub { font-size:8px; color:#a89888; letter-spacing:.5px; margin-top:4px; }
    .gv-route .gv-mid { flex:1; text-align:center; padding:0 12px; }
    .gv-plane { display:inline-block; color:#c8775a; font-size:18px; }
    .gv-route .gv-ln { border-top:1.5px dashed #e0c3b2; margin-top:6px; }
    .gv-row { display:flex; border-top:1px dashed #e7ddcd; margin-top:4px;
      background:#fff; border-radius:10px; overflow:hidden;
      border:1px solid rgba(168,94,68,.12); }
    .gv-cell { flex:1; padding:9px 12px; border-right:1px solid rgba(168,94,68,.1); }
    .gv-cell:last-child { border-right:none; }
    .gv-cell .gv-k { font-size:7px; font-weight:700; letter-spacing:1.2px; text-transform:uppercase; color:#b4a89a; }
    .gv-cell .gv-v { font-size:11px; font-weight:700; color:#1a1410; margin-top:5px; }
    .gv-cell .gv-v.gv-terra { color:#a85e44; }

    .gv-stub { width:120px; background:#16313a; padding:24px 16px; position:relative;
      border-left:2px dashed #d8cab2; display:flex; flex-direction:column; align-items:center; text-align:center; }
    .gv-stub-k { font-size:7px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:rgba(255,255,255,.5); margin-bottom:6px; }
    .gv-stub-amt { font-family:Georgia,'Times New Roman',serif; font-weight:600; font-size:40px; color:#fff; line-height:1; }
    .gv-stub-amt .gv-cur { color:#c8775a; font-size:18px; font-style:italic; }
    .gv-stub-words { font-family:Georgia,serif; font-style:italic; font-size:9px; color:rgba(255,255,255,.6); margin:6px 0 18px; }
    .gv-qr { width:72px; height:72px; border-radius:8px; background:#fff; padding:7px; margin-bottom:14px; }
    .gv-qr svg { width:100%; height:100%; display:block; }
    .gv-stub-foot { font-size:7px; color:rgba(255,255,255,.55); line-height:1.5; }

    .gv-badge { position:absolute; z-index:4; background:#fffdf8; border-radius:14px;
      box-shadow:0 18px 36px -18px rgba(0,0,0,.5); padding:13px 16px; display:flex; align-items:center; gap:11px;
      animation:gv-float2 7s ease-in-out infinite; }
    @keyframes gv-float2 { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
    .gv-badge .gv-ic { width:34px; height:34px; border-radius:9px; flex:none; display:flex; align-items:center; justify-content:center;
      font-family:Georgia,serif; font-weight:700; font-size:20px; }
    .gv-badge .gv-tx b { font-size:12px; font-weight:700; color:#1a1410; display:block; line-height:1.2; }
    .gv-badge .gv-tx small { font-size:10px; color:#6b5d4f; }
    .gv-badge.gv-mystery { top:28px; right:-32px; animation-delay:.4s; }
    .gv-badge.gv-mystery .gv-ic { background:#16313a; color:#f0c3ae; }
    .gv-badge.gv-cal { bottom:40px; left:-12px; animation-delay:1.2s; }
    .gv-badge.gv-cal .gv-ic { background:#faf0ea; color:#a85e44; }

    @media (max-width:960px) {
      .gv-hero { padding:96px 24px 72px; }
      .gv-grid { grid-template-columns:1fr; gap:56px; }
      .gv-stage { height:420px; }
      .gv-voucher { width:360px; }
      .gv-badge.gv-cal { left:0; } .gv-badge.gv-mystery { right:0; }
    }
    /* Mobilni: bez rotacije (da se ne seče cena), širina vezana za ekran */
    @media (max-width:600px) {
      .gv-stage { height:auto; padding:40px 0 40px; overflow:visible; }
      .gv-voucher { width:min(360px, calc(100vw - 48px)); transform:rotate(0);
        animation:gv-float-flat 6s ease-in-out infinite; }
      @keyframes gv-float-flat { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
      .gv-stage::before { width:240px; height:240px; }
      .gv-stub { display:none; }
      .gv-stub-amt { font-size:30px; }
      .gv-stub-words { font-size:7.5px; margin:4px 0 12px; }
      .gv-qr { width:58px; height:58px; padding:5px; margin-bottom:10px; }
      .gv-badge { padding:8px 11px; gap:8px; }
      .gv-badge .gv-ic { width:28px; height:28px; font-size:16px; }
      .gv-badge .gv-tx b { font-size:10px; }
      .gv-badge .gv-tx small { font-size:8.5px; }
      .gv-badge.gv-mystery { top:-14px; left:12px; right:auto; }
      .gv-badge.gv-cal { bottom:-14px; right:12px; left:auto; }
    }
    @media (max-width:360px) {
      .gv-stub { width:84px; padding:16px 8px; }
      .gv-stub-amt { font-size:26px; }
      .gv-qr { width:50px; height:50px; }
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

    /* ══ VOUCHER REVEAL - premešteno na page-poklon.php (/poklon?code=...) ══ */
    #voucherReveal {
      min-height: 100vh;
      background: linear-gradient(160deg, #0a1e26 0%, #0f2d35 55%, #122830 100%);
      padding: 104px 20px 80px;
      position: relative; overflow: hidden;
    }
    #voucherReveal::before {
      content: ''; position: absolute; inset: 0;
      background: radial-gradient(ellipse 70% 50% at 50% 30%, rgba(202,138,113,.08) 0%, transparent 70%);
      pointer-events: none;
    }
    .bp-reveal-wrap { max-width: 840px; margin: 0 auto; position: relative; z-index: 1; }

    /* Loading */
    .bp-loading { text-align: center; padding: 80px 20px; color: rgba(255,255,255,.6); font-size: 16px; }
    .bp-spinner {
      width: 40px; height: 40px;
      border: 3px solid rgba(202,138,113,.2); border-top-color: #CA8A71;
      border-radius: 50%; animation: bpSpin .8s linear infinite; margin: 0 auto 20px;
    }
    @keyframes bpSpin { to { transform: rotate(360deg); } }

    /* Active badge */
    .bp-status-wrap { text-align: center; margin-bottom: 20px; }
    .bp-badge-active {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(34,197,94,.1); border: 1.5px solid rgba(34,197,94,.3);
      color: #4ade80; padding: 8px 24px; border-radius: 100px;
      font-size: 11px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;
      opacity: 0; animation: bpBadgePop .55s cubic-bezier(.34,1.56,.64,1) .8s forwards;
    }
    @keyframes bpBadgePop {
      0%   { opacity: 0; transform: scale(0); }
      65%  { transform: scale(1.14); }
      100% { opacity: 1; transform: scale(1); }
    }

    /* Card */
    .bp-card {
      border-radius: 20px; overflow: hidden;
      box-shadow: 0 32px 80px rgba(0,0,0,.55), 0 0 0 1px rgba(255,255,255,.06);
      animation: bpCardIn .75s cubic-bezier(.22,.61,.36,1) .1s both;
    }
    .bp-card.bp-float { animation: bpFloat 5s ease-in-out infinite; }
    @keyframes bpCardIn {
      from { opacity: 0; transform: translateY(50px) scale(0.97); }
      to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes bpFloat { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-7px); } }
    .bp-bar { height: 8px; background: linear-gradient(90deg, #a85e44, #c8775a 50%, #a85e44); }
    .bp-inner { display: flex; min-height: 370px; }

    /* Main (cream) */
    .bp-main { flex: 1; background: #faf6ee; padding: 34px 38px; min-width: 0; }
    .bp-hdr { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
    .bp-logo { height: 32px; width: auto; display: block; }
    .bp-tag {
      font-size: 9px; letter-spacing: 2.5px; text-transform: uppercase;
      color: #a85e44; font-weight: 700;
      border: 1px solid #e0c3b2; background: #fbf1ea;
      padding: 5px 12px; border-radius: 100px; white-space: nowrap;
    }
    .bp-title-area {
      border-top: 1px dashed #d8cab2; border-bottom: 1px dashed #d8cab2;
      padding: 15px 0; margin-bottom: 17px;
    }
    .bp-eyebrow { font-size: 10px; letter-spacing: 2px; text-transform: uppercase; color: #6b5d4f; margin-bottom: 7px; font-style: italic; }
    .bp-h1 {
      font-family: Georgia, 'Times New Roman', serif;
      font-size: clamp(26px, 3.2vw, 38px); font-weight: 400;
      color: #1a1410; line-height: 1.1; letter-spacing: -.5px; margin: 0;
    }
    .bp-h1 em { color: #a85e44; font-style: italic; }
    .bp-route { display: flex; align-items: flex-start; margin-bottom: 15px; }
    .bp-route-from, .bp-route-to { flex: 1; }
    .bp-route-to { text-align: right; }
    .bp-iata {
      font-family: Georgia, 'Times New Roman', serif;
      font-size: clamp(38px, 4.8vw, 52px); font-weight: 700;
      color: #1a1410; line-height: 1; letter-spacing: -2px;
    }
    .bp-iata-dest { color: #a85e44; font-style: italic; }
    .bp-city { font-size: 11px; font-weight: 700; color: #1a1410; padding-top: 8px; letter-spacing: .5px; }
    .bp-city-r { text-align: right; }
    .bp-cap { font-size: 9.5px; color: #a89888; padding-top: 4px; }
    .bp-cap-r { text-align: right; }
    .bp-route-mid { width: 88px; text-align: center; padding-top: 15px; flex-shrink: 0; }
    .bp-plane-icon { font-size: 19px; color: #c8775a; display: block; margin-bottom: 4px; }
    .bp-plane-line { border-top: 1.5px dashed rgba(200,119,90,.4); width: 60px; margin: 0 auto; }
    .bp-meta { display: flex; border: 1px solid #ebe1cf; background: #fff; border-radius: 10px; overflow: hidden; margin-bottom: 13px; }
    .bp-meta-cell { flex: 1; padding: 11px 14px; border-right: 1px solid #ebe1cf; }
    .bp-meta-cell:last-child { border-right: none; }
    .bp-mk { font-size: 9px; letter-spacing: 2px; text-transform: uppercase; color: #a89888; font-weight: 700; }
    .bp-mv { font-size: 12px; font-weight: 700; color: #1a1410; padding-top: 5px; }
    .bp-mv-terra { color: #a85e44; }
    .bp-msg { background: #fff; border: 1px solid #ebe1cf; border-left: 3px solid #a85e44; border-radius: 10px; padding: 12px 16px; }
    .bp-msg-k { font-size: 9px; letter-spacing: 2px; text-transform: uppercase; color: #a89888; font-weight: 700; margin-bottom: 6px; }
    .bp-msg-text { font-family: Georgia, serif; font-style: italic; font-size: 14px; color: #2b231b; line-height: 1.5; }
    .bp-msg-sig { font-size: 11px; color: #6b5d4f; padding-top: 6px; }

    /* Perforated divider */
    .bp-perf {
      width: 1px; flex-shrink: 0;
      background: repeating-linear-gradient(to bottom, rgba(216,202,178,.55) 0px, rgba(216,202,178,.55) 8px, transparent 8px, transparent 14px);
      position: relative;
    }
    .bp-perf::before, .bp-perf::after {
      content: ''; position: absolute; left: 50%; transform: translateX(-50%);
      width: 20px; height: 20px; border-radius: 50%;
      background: linear-gradient(160deg, #0a1e26, #0f2d35);
      box-shadow: 0 0 0 1px rgba(216,202,178,.12);
    }
    .bp-perf::before { top: -10px; }
    .bp-perf::after  { bottom: -10px; }

    /* Stub (dark) */
    .bp-stub { width: 248px; flex-shrink: 0; background: #1a1410; padding: 34px 26px; display: flex; flex-direction: column; }
    .bp-stub-head { font-size: 9px; letter-spacing: 3px; text-transform: uppercase; color: #8a8079; font-weight: 700; margin-bottom: 22px; }
    .bp-stub-head b { color: #c8775a; }
    .bp-stub-k { font-size: 9px; letter-spacing: 3px; text-transform: uppercase; color: #948a82; margin-bottom: 6px; }
    .bp-stub-amount { font-family: Georgia, serif; font-size: 58px; font-weight: 400; color: #fff; line-height: 1; letter-spacing: -2px; margin-bottom: 3px; }
    .bp-cur { color: #c8775a; font-size: 25px; font-style: italic; }
    .bp-stub-sub { font-family: Georgia, serif; font-style: italic; font-size: 12px; color: #a59c94; margin-bottom: 20px; }
    .bp-code-wrap { background: #2a211a; border: 1px dashed #4a3f36; border-radius: 8px; padding: 11px 8px; margin-bottom: 18px; text-align: center; }
    .bp-code-text {
      font-family: 'Courier New', Courier, monospace;
      font-size: 13px; font-weight: 700; letter-spacing: 2px; display: block;
      background: linear-gradient(90deg, #e29070 20%, #f8d4be 50%, #e29070 80%);
      background-size: 200% auto;
      -webkit-background-clip: text; background-clip: text;
      -webkit-text-fill-color: transparent; color: #e29070;
      animation: bpShimmer 3s linear 1.5s infinite;
    }
    @keyframes bpShimmer { from { background-position: -200% center; } to { background-position: 200% center; } }
    .bp-stub-info { font-size: 11px; color: #8a8079; line-height: 1.7; flex: 1; }
    .bp-stub-info strong { color: #c8775a; }
    .bp-stub-scan { font-size: 10px; color: #5a5250; line-height: 1.6; text-align: center; border-top: 1px dashed #2a211a; padding-top: 14px; margin-top: auto; }

    /* How to use */
    .bp-how { margin-top: 52px; animation: bpCardIn .7s cubic-bezier(.22,.61,.36,1) .3s both; }
    .bp-how-h { text-align: center; font-size: clamp(20px, 2.8vw, 26px); font-weight: 900; color: #fff; letter-spacing: -.5px; margin-bottom: 24px; }
    .bp-how-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 22px; }
    .bp-how-card {
      background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.09);
      border-radius: 16px; padding: 24px 22px; transition: all .25s;
    }
    .bp-how-card:hover { background: rgba(202,138,113,.08); border-color: rgba(202,138,113,.35); transform: translateY(-3px); }
    .bp-how-icon { font-size: 28px; margin-bottom: 10px; }
    .bp-how-title { font-size: 17px; font-weight: 800; color: #fff; margin-bottom: 7px; }
    .bp-how-sub { font-size: 13px; color: rgba(255,255,255,.5); line-height: 1.65; margin-bottom: 15px; }
    .bp-how-sub strong { color: rgba(255,255,255,.75); }
    .bp-how-btn {
      display: inline-block; background: rgba(202,138,113,.1);
      border: 1px solid rgba(202,138,113,.3); color: #CA8A71;
      padding: 9px 16px; border-radius: 10px;
      font-size: 13px; font-weight: 700; text-decoration: none; transition: all .2s;
    }
    .bp-how-btn:hover { background: rgba(202,138,113,.2); border-color: rgba(202,138,113,.6); }
    .bp-how-info {
      background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.07);
      border-radius: 14px; padding: 22px 26px;
      display: grid; grid-template-columns: 1fr 1fr; gap: 10px 28px;
    }
    .bp-info-item { font-size: 13px; color: rgba(255,255,255,.55); line-height: 1.5; }
    .bp-info-item strong { color: rgba(255,255,255,.85); }
    .bp-info-item a { color: #CA8A71; text-decoration: none; font-weight: 600; }
    .bp-info-item a:hover { text-decoration: underline; }

    /* Mobile */
    @media (max-width: 640px) {
      #voucherReveal { padding: 88px 16px 60px; }
      .bp-inner { flex-direction: column; }
      .bp-main  { padding: 24px 20px; }
      .bp-stub  { width: auto; padding: 24px 20px; }
      .bp-perf  {
        width: auto; height: 1px;
        background: repeating-linear-gradient(to right, rgba(216,202,178,.45) 0px, rgba(216,202,178,.45) 8px, transparent 8px, transparent 14px);
      }
      .bp-perf::before { top: 50%; left: -10px; transform: translateY(-50%); }
      .bp-perf::after  { top: 50%; left: auto; right: -10px; bottom: auto; transform: translateY(-50%); }
      .bp-iata { font-size: 38px; }
      .bp-h1   { font-size: 26px; }
      .bp-stub-amount { font-size: 50px; }
      .bp-how-cards { grid-template-columns: 1fr; }
      .bp-how-info  { grid-template-columns: 1fr; }
    }

  </style>
</head>
<body>

<!-- NAV -->
<?php include get_template_directory() . '/inc/subpage-nav.php'; ?>

<!-- HERO -->
<section class="gv-hero" id="gift-top">

  <!-- Dekorativni sloj: konture + putanja leta (suptilno preko teala) -->
  <svg class="gv-bg" viewBox="0 0 1200 600" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false">
    <defs>
      <linearGradient id="gvLine" x1="0" y1="0" x2="1" y2="0">
        <stop offset="0"   stop-color="#7fb0a0" stop-opacity="0"/>
        <stop offset=".5"  stop-color="#a9d0c4" stop-opacity=".9"/>
        <stop offset="1"   stop-color="#c8775a" stop-opacity="0"/>
      </linearGradient>
    </defs>
    <g fill="none" stroke="url(#gvLine)" stroke-width="1">
      <path d="M-60 90  C 220 30, 420 150, 660 95  S 1040 30, 1280 110"/>
      <path d="M-60 170 C 200 110, 440 220, 680 160 S 1060 110, 1280 185"/>
      <path d="M-60 255 C 240 200, 420 300, 660 250 S 1080 195, 1280 270"/>
      <path d="M-60 340 C 200 285, 460 385, 700 335 S 1060 285, 1280 350"/>
      <path d="M-60 425 C 240 370, 420 470, 660 420 S 1080 370, 1280 440"/>
      <path d="M-60 510 C 200 455, 460 555, 700 505 S 1060 455, 1280 525"/>
    </g>
    <!-- putanja leta -->
    <path d="M150 470 Q 600 200 1060 360" fill="none" stroke="#f0c3ae" stroke-width="1.3"
          stroke-dasharray="3 9" stroke-linecap="round" opacity=".55"/>
    <circle cx="150" cy="470" r="3.5" fill="#f0c3ae" opacity=".7"/>
    <circle cx="1060" cy="360" r="3.5" fill="#f0c3ae" opacity=".7"/>
  </svg>

  <div class="gv-grid">

    <!-- LEVO: tekst -->
    <div class="gv-copy">
      <span class="gv-pill" data-i18n="gift.hero.badge">🎁 Poklon koji se pamti</span>
      <h1 class="gv-h1" data-i18n-html="gift.hero.h1">Pokloni nekome <em>iznenađenje</em></h1>
      <p class="gv-sub" data-i18n="gift.hero.sub">Odaberi iznos vaučera - primalac ga koristi za bilo koje Escapii putovanje po izboru. Destinaciju otkriva tek 48h pre polaska.</p>
      <div class="gv-cta">
        <button class="gv-btn gv-btn-primary" onclick="scrollToVoucher()" type="button" data-i18n="gift.hero.cta">🎟️ Pokloni vaučer →</button>
        <span class="gv-trust">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"></path></svg>
          <span data-i18n="gift.hero.trust">Vaučer važi godinu dana</span>
        </span>
      </div>
    </div>

    <!-- DESNO: vizuelni vaučer -->
    <div class="gv-stage">
      <div class="gv-voucher">
        <div class="gv-card">
          <div class="gv-card-main">
            <div class="gv-card-top">
              <img src="<?php echo $theme_uri; ?>/images/logo-black.svg" alt="Escapii" class="gv-card-logo">
              <span class="gv-mini-tag">Poklon vaučer</span>
            </div>
            <div class="gv-route">
              <div>
                <div class="gv-iata">BEG</div>
                <div class="gv-iata-sub">Beograd · bilo kada</div>
              </div>
              <div class="gv-mid">
                <span class="gv-plane">✈</span>
                <div class="gv-ln"></div>
              </div>
              <div style="text-align:right;">
                <div class="gv-iata gv-dest">???</div>
                <div class="gv-iata-sub">otkriva se 48h pre</div>
              </div>
            </div>
            <div class="gv-row">
              <div class="gv-cell"><div class="gv-k">Izdato</div><div class="gv-v">20.06.2026</div></div>
              <div class="gv-cell"><div class="gv-k">Važi do</div><div class="gv-v gv-terra">20.06.2027</div></div>
              <div class="gv-cell"><div class="gv-k">Vrednost</div><div class="gv-v">200 €</div></div>
            </div>
          </div>
          <div class="gv-stub">
            <div class="gv-stub-k">Vrednost</div>
            <div class="gv-stub-amt">200<span class="gv-cur"> €</span></div>
            <div class="gv-stub-words">— dvesta evra —</div>
            <div class="gv-qr">
              <svg viewBox="0 0 100 100" shape-rendering="crispEdges"><rect width="100" height="100" fill="#fff"/><g fill="#16313a"><rect x="0" y="0" width="30" height="30"/><rect x="8" y="8" width="14" height="14" fill="#fff"/><rect x="70" y="0" width="30" height="30"/><rect x="78" y="8" width="14" height="14" fill="#fff"/><rect x="0" y="70" width="30" height="30"/><rect x="8" y="78" width="14" height="14" fill="#fff"/><rect x="40" y="0" width="8" height="8"/><rect x="52" y="0" width="8" height="8"/><rect x="40" y="14" width="8" height="8"/><rect x="60" y="14" width="8" height="8"/><rect x="0" y="40" width="8" height="8"/><rect x="14" y="40" width="8" height="8"/><rect x="40" y="40" width="8" height="8"/><rect x="52" y="48" width="8" height="8"/><rect x="64" y="40" width="8" height="8"/><rect x="76" y="48" width="8" height="8"/><rect x="88" y="40" width="8" height="8"/><rect x="40" y="60" width="8" height="8"/><rect x="60" y="60" width="8" height="8"/><rect x="80" y="64" width="8" height="8"/><rect x="40" y="76" width="8" height="8"/><rect x="56" y="80" width="8" height="8"/><rect x="72" y="76" width="8" height="8"/><rect x="88" y="80" width="8" height="8"/></g></svg>
            </div>
          </div>
        </div>
      </div>

      <!-- floating badge-ovi -->
      <div class="gv-badge gv-mystery">
        <span class="gv-ic">?</span>
        <span class="gv-tx"><b>Tajna destinacija</b><small>otkriva se 48h pre</small></span>
      </div>
      <div class="gv-badge gv-cal">
        <span class="gv-ic">12</span>
        <span class="gv-tx"><b>Važi 12 meseci</b><small>iskoristi bilo kada</small></span>
      </div>
    </div>

  </div>
</section>

<!-- ═══ VAUČER SEKCIJA ═══════════════════════════════════════════════════════ -->
<div class="gift-sections" id="section-voucher">
  <div class="gift-sec-wrap">
    <div class="gift-sec-tag">🎟️ <span data-i18n="gift.sec.voucher.tag">Poklon vaučer</span></div>
    <h2 class="gift-sec-h" data-i18n="gift.sec.voucher.h">Odaberi iznos i pokloni nekome putovanje koje će pamtiti</h2>
    <p class="gift-sec-desc" data-i18n="gift.sec.voucher.desc">Odaberi iznos vaučera, upiši ime i poruku - mi generišemo vaučer sa unikatnim kodom. Primalac ga koristi pri rezervaciji bilo kog Escapii putovanja iznenađenja, a vrednost se automatski odbija od cene putovanja. Vaučer važi godinu dana.</p>

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
        <input class="amount-custom-input" id="vCustomAmount" type="number" min="50" step="1"
               placeholder="ili unesi iznos po izboru (min. 50€)"
               oninput="onCustomAmount(this.value)">
      </div>
      <div class="amount-hint">
        <span>✈️</span>
        <span data-i18n-html="gift.amount.hint">Naša putovanja počinju od <strong>279€ po osobi</strong> - vaučer umanjuje tu cenu.</span>
      </div>

      <!-- Podaci -->
      <div class="gift-form-grid">
        <div class="gf-field">
          <label class="gf-label" data-i18n="gift.buyer.email.label">Email za dostavu vaučera</label>
          <input class="gf-input" id="vBuyerEmail" type="email" autocomplete="email"
                 data-i18n-ph="gift.buyer.email.ph" placeholder="tvoj@email.com">
        </div>
        <div class="gf-field">
          <label class="gf-label" data-i18n="gift.buyer.name.label">Ime i prezime na vaučeru</label>
          <input class="gf-input" id="vBuyerName" type="text" autocomplete="given-name"
                 data-i18n-ph="gift.buyer.name.ph" placeholder="Marko Marković">
        </div>
        <div class="gf-field full">
          <label class="gf-label" data-i18n="gift.msg.label">Poruka na vaučeru (opciono)</label>
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

<?php include get_template_directory() . '/inc/footer.php'; ?>

<script>
const API_BASE   = '<?php echo esc_js(escapii_api_url()); ?>';
const THEME_URI  = '<?php echo esc_js($theme_uri); ?>';
const SITE_URL   = '<?php echo esc_js($site_url); ?>';

// ── Prevodi ──────────────────────────────────────────────────────────────────
const TR = {
  sr: {
    'nav.home':              'Početna',
    'nav.status':            'Moja rezervacija',
    'nav.gift.voucher':      'Poklon vaučer',
    'nav.gift.label':        'Pokloni putovanje iznenađenja',
    'nav.gift.offer':        '🎁 Pokloni putovanje iznenađenja',
    'nav.gift.offer.sub':    'Pokloni savršen poklon nekome ko voli da putuje',
    'nav.gift.redeem':       '🔓 Iskoristi poklon',
    'nav.gift.redeem.sub':   'Imaš poklon kod? Aktiviraj ga ovde',
    'snav.how':              'Kako funkcioniše',
    'snav.about':            'O nama',
    'snav.dest':             'Destinacije',
    'snav.who':              'Za koga',
    'snav.faq':              'FAQ',
    'snav.blog':             'Blog',
    'snav.call':             '✉ Kontaktiraj nas',
    'snav.call.hours':       'escapii.team@gmail.com',
    'snav.book':             'Rezerviši',
    'gift.hero.badge':       '🎁 Poklon koji se pamti',
    'gift.hero.h1':          'Pokloni nekome <em>iznenađenje</em>',
    'gift.hero.sub':         'Odaberi iznos vaučera - primalac ga koristi za bilo koje Escapii putovanje po izboru. Destinaciju otkriva tek 48h pre polaska.',
    'gift.hero.cta':         '🎟️ Pokloni vaučer →',
    'gift.hero.trust':       'Vaučer važi godinu dana',
    'gift.sec.voucher.tag':  'Poklon vaučer',
    'gift.sec.voucher.h':    'Odaberi iznos i pokloni nekome putovanje koje će pamtiti',
    'gift.sec.voucher.desc': 'Odaberi iznos vaučera, upiši ime i poruku - mi generišemo vaučer sa unikatnim kodom. Primalac ga koristi pri rezervaciji bilo kog Escapii putovanja iznenađenja, a vrednost se automatski odbija od cene putovanja. Vaučer važi godinu dana.',
    'gift.amount.label':     'Iznos vaučera (EUR)',
    'gift.amount.hint':      'Naša putovanja počinju od <strong>279€ po osobi</strong> - vaučer umanjuje tu cenu.',
    'gift.buyer.email.label':'Email za dostavu vaučera',
    'gift.buyer.email.ph':   'tvoj@email.com',
    'gift.buyer.name.label': 'Ime i prezime na vaučeru',
    'gift.buyer.name.ph':    'Marko Marković',
    'gift.msg.label':        'Poruka na vaučeru (opciono)',
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
    'nav.status':            'My reservation',
    'nav.gift.voucher':      'Gift voucher',
    'nav.gift.label':        'Gift a Surprise Trip',
    'nav.gift.offer':        '🎁 Gift a Surprise Trip',
    'nav.gift.offer.sub':    'Gift the perfect present for a travel lover',
    'nav.gift.redeem':       '🔓 Redeem gift',
    'nav.gift.redeem.sub':   'Have a gift code? Activate it here',
    'snav.book.cta':         'Book now →',
    'snav.how':              'How it works',
    'snav.about':            'About us',
    'snav.dest':             'Destinations',
    'snav.who':              'Who\'s it for',
    'snav.faq':              'FAQ',
    'snav.blog':             'Blog',
    'snav.call':             '✉ Contact us',
    'snav.call.hours':       'escapii.team@gmail.com',
    'snav.book':             'Book now',
    'gift.hero.badge':       '🎁 A gift they\'ll remember',
    'gift.hero.h1':          'Gift someone a <em>surprise</em>',
    'gift.hero.sub':         'Choose a voucher amount - recipient uses it on any Escapii trip of their choice. The destination is revealed only 48h before departure.',
    'gift.hero.cta':         '🎟️ Gift a voucher →',
    'gift.hero.trust':       'Voucher valid for one year',
    'gift.sec.voucher.tag':  'Gift voucher',
    'gift.sec.voucher.h':    'Choose an amount and gift someone a trip they\'ll never forget',
    'gift.sec.voucher.desc': 'Choose a voucher amount, add a name and message - we generate a voucher with a unique code. The recipient uses it when booking any Escapii surprise trip, and the value is automatically deducted from the trip price. Valid for one year.',
    'gift.amount.label':     'Voucher amount (EUR)',
    'gift.amount.hint':      'Our trips start from <strong>€279 per person</strong> - the voucher reduces that price.',
    'gift.buyer.email.label':'Email for voucher delivery',
    'gift.buyer.email.ph':   'your@email.com',
    'gift.buyer.name.label': 'Full name on voucher',
    'gift.buyer.name.ph':    'Marko Markovic',
    'gift.msg.label':        'Message on the voucher (optional)',
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
  document.querySelectorAll('.lang-btn').forEach(b => b.classList.toggle('on', b.textContent.trim() === l.toUpperCase()));
  document.querySelectorAll('[data-i18n]').forEach(el => { el.textContent = t(el.dataset.i18n); });
  document.querySelectorAll('[data-i18n-html]').forEach(el => { el.innerHTML = t(el.dataset.i18nHtml); });
  document.querySelectorAll('[data-i18n-ph]').forEach(el => { el.placeholder = t(el.dataset.i18nPh); });
}

// ── Nav helpers ──────────────────────────────────────────────────────────────
function goHome() { window.location.href = '<?php echo esc_js($site_url); ?>/'; }

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
  const num = parseInt(val, 10);
  if (!isNaN(num) && num >= 50) selectedAmount = num;
}

async function submitVoucher() {
  const err  = document.getElementById('vErr');
  const btn  = document.getElementById('vSubmitBtn');
  const isSr = lang === 'sr';
  err.textContent = '';

  const customRaw = document.getElementById('vCustomAmount').value;
  const customVal = parseInt(customRaw, 10);
  const amount = selectedAmount || (!isNaN(customVal) ? customVal : null);

  if (!amount || amount < 50) {
    err.textContent = isSr ? 'Odaberi ili unesi iznos vaučera (min. 50€).' : 'Select or enter a voucher amount (min. €50).';
    return;
  }
  if (customRaw && String(customVal) !== String(parseFloat(customRaw))) {
    err.textContent = isSr ? 'Iznos mora biti ceo broj (bez decimala).' : 'Amount must be a whole number.';
    return;
  }
  const buyerEmail = document.getElementById('vBuyerEmail').value.trim();
  if (!buyerEmail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(buyerEmail)) {
    err.textContent = isSr ? 'Unesi validan email.' : 'Enter a valid email.';
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

// ── Voucher Reveal - premešteno na page-poklon.php (/poklon?code=...) ────────
// QR kod vodi na /poklon, ne ovde. Reveal logika je tamo.

function _renderRevealCard_UNUSED(container, code, d) {
  const amount   = Math.round(d.amount);
  const words    = _AMOUNT_WORDS[amount] || (amount + ' evra');
  const msgHtml  = d.giftMessage ? `
    <div class="bp-msg" style="margin-top:13px;">
      <div class="bp-msg-k">Lična poruka</div>
      <div class="bp-msg-text">${_esc(d.giftMessage)}</div>
      ${d.buyerName ? `<div class="bp-msg-sig">- <strong>${_esc(d.buyerName)}</strong></div>` : ''}
    </div>` : '';

  container.innerHTML = `
    <div class="bp-status-wrap">
      <div class="bp-badge-active">✓ VAUČER AKTIVAN</div>
    </div>

    <div class="bp-card" id="bpCardEl">
      <div class="bp-bar"></div>
      <div class="bp-inner">

        <!-- Leva (krem) strana -->
        <div class="bp-main">
          <div class="bp-hdr">
            <img src="${THEME_URI}/images/logo-black.svg" alt="escapii" class="bp-logo">
            <div class="bp-tag">🎟️ Poklon vaučer</div>
          </div>
          <div class="bp-title-area">
            <div class="bp-eyebrow">- Iskoristi vaučer za Escapii putovanje -</div>
            <h2 class="bp-h1">Tvoja sledeća<br><em>avantura te čeka.</em></h2>
          </div>
          <div class="bp-route">
            <div class="bp-route-from">
              <div class="bp-iata">BEG</div>
              <div class="bp-city">Beograd</div>
              <div class="bp-cap">Polazak - bilo kada</div>
            </div>
            <div class="bp-route-mid">
              <span class="bp-plane-icon">✈</span>
              <div class="bp-plane-line"></div>
            </div>
            <div class="bp-route-to">
              <div class="bp-iata bp-iata-dest">???</div>
              <div class="bp-city bp-city-r">Iznenađenje</div>
              <div class="bp-cap bp-cap-r">otkriva se 48h pre polaska</div>
            </div>
          </div>
          <div class="bp-meta">
            <div class="bp-meta-cell">
              <div class="bp-mk">Izdato</div>
              <div class="bp-mv">${_fmtDate(d.activatedAt)}</div>
            </div>
            <div class="bp-meta-cell">
              <div class="bp-mk">Važi do</div>
              <div class="bp-mv bp-mv-terra">${_fmtDate(d.expiresAt)}</div>
            </div>
            <div class="bp-meta-cell">
              <div class="bp-mk">Vrednost</div>
              <div class="bp-mv">${amount} €</div>
            </div>
          </div>
          ${msgHtml}
        </div>

        <!-- Perforacija -->
        <div class="bp-perf"></div>

        <!-- Desna (tamna) strana -->
        <div class="bp-stub">
          <div class="bp-stub-head">BOARDING PASS · <b>GIFT</b></div>
          <div class="bp-stub-k">Vrednost</div>
          <div class="bp-stub-amount">${amount}<span class="bp-cur"> €</span></div>
          <div class="bp-stub-sub">- ${_esc(words)} -</div>
          <div class="bp-stub-k">Vaučer kod</div>
          <div class="bp-code-wrap">
            <span class="bp-code-text">${_esc(code)}</span>
          </div>
          <div class="bp-stub-info">
            Unesi kod pri rezervaciji - cena se automatski umanjuje za <strong>${amount}€</strong>.<br><br>
            Važi do: <strong>${_fmtDate(d.expiresAt)}</strong>
          </div>
          <div class="bp-stub-scan">escapii.rs/poklon<br>ili unesi kod pri rezervaciji</div>
        </div>
      </div>
    </div>

    <!-- Kako iskoristiti -->
    <div class="bp-how">
      <h3 class="bp-how-h">Kako iskoristiti vaučer?</h3>
      <div class="bp-how-cards">
        <div class="bp-how-card">
          <div class="bp-how-icon">✈️</div>
          <div class="bp-how-title">Escapii putovanje</div>
          <div class="bp-how-sub">Odaberi neki od naših termina, pri rezervaciji unesi kod <strong>${_esc(code)}</strong> - cena se automatski umanjuje za ${amount}€.</div>
          <a href="${SITE_URL}/#esc-booking" class="bp-how-btn">Pogledaj termine →</a>
        </div>
        <div class="bp-how-card">
          <div class="bp-how-icon">🌍</div>
          <div class="bp-how-title">Prilagođeni termin</div>
          <div class="bp-how-sub">Ne odgovara ti nijedan datum? Organizujemo putovanje za termin koji tebi odgovara - iznenađenje i dalje ostaje tajna.</div>
          <a href="${SITE_URL}/#esc-custom" class="bp-how-btn">Zatraži termin koji ti odgovara →</a>
        </div>
      </div>
      <div class="bp-how-info">
        <div class="bp-info-item">✓ Važi <strong>godinu dana od aktivacije</strong> - do ${_fmtDate(d.expiresAt)}</div>
        <div class="bp-info-item">✓ Unosi se u booking formi pri rezervaciji putovanja</div>
        <div class="bp-info-item">✓ Važi za bilo koji termin i bilo koji aerodrom polaska</div>
        <div class="bp-info-item">✓ Pitanja? <a href="mailto:escapii.team@gmail.com">escapii.team@gmail.com</a></div>
      </div>
    </div>`;

  // Nakon ulazne animacije (750ms) dodaj float animaciju
  setTimeout(() => {
    const card = document.getElementById('bpCardEl');
    if (card) card.classList.add('bp-float');
  }, 950);
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
