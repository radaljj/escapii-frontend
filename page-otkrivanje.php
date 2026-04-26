<?php
/**
 * Template Name: Otkrivanje Destinacije
 */
$logo_url       = get_template_directory_uri() . '/images/logo-white.svg';
$logo_dark_url  = get_template_directory_uri() . '/images/logo-black.svg';
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
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: #efe9e7;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    /* ── Stars canvas ── */
    #rv-stars {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: 0;
    }

    /* ── Background floating planes ── */
    .bg-planes {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: 1;
      overflow: hidden;
    }
    .bg-plane {
      position: absolute;
      opacity: 0;
      animation: bg-fly linear infinite;
    }
    .bg-plane svg { display: block; }

    @keyframes bg-fly {
      0%   { opacity: 0; transform: translate(0, 0)     rotate(var(--rot)); }
      8%   { opacity: var(--max-op); }
      92%  { opacity: var(--max-op); }
      100% { opacity: 0; transform: translate(var(--dx), var(--dy)) rotate(var(--rot)); }
    }

    /* ── Logo top ── */
    .rv-logo {
      position: fixed;
      top: 24px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 20;
      line-height: 0;
    }
    .rv-logo img { height: 26px; width: auto; }

    /* ── Scene ── */
    .scene {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* ── Generic state ── */
    .rv-state { display: none; flex-direction: column; align-items: center; }
    .rv-state.active { display: flex; }

    /* ── Loading ── */
    .rv-spinner {
      width: 44px; height: 44px;
      border: 2px solid rgba(202,138,113,0.15);
      border-top-color: #CA8A71;
      border-radius: 50%;
      animation: rv-spin .85s linear infinite;
    }
    @keyframes rv-spin { to { transform: rotate(360deg); } }

    /* ── Error modal ── */
    .rv-err-backdrop {
      display: none;
      position: fixed; inset: 0; z-index: 100;
      background: rgba(239,233,231,0.75);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      align-items: center; justify-content: center;
      padding: 24px;
    }
    .rv-err-backdrop.active { display: flex; animation: err-in .35s ease; }
    @keyframes err-in {
      from { opacity:0; }
      to   { opacity:1; }
    }
    .rv-err-card {
      background: linear-gradient(145deg, #1a4450 0%, #0F2D35 100%);
      border: 1px solid rgba(202,138,113,.25);
      border-radius: 24px;
      padding: 40px 32px 32px;
      max-width: 360px; width: 100%;
      text-align: center;
      box-shadow: 0 32px 80px rgba(0,0,0,.55);
      animation: card-up .4s .05s cubic-bezier(.34,1.08,.64,1) both;
    }
    @keyframes card-up {
      from { opacity:0; transform:translateY(24px) scale(.96); }
      to   { opacity:1; transform:translateY(0)    scale(1);   }
    }
    .rv-err-logo {
      margin: 0 auto 22px;
      width: 52px; height: 52px;
      background: rgba(202,138,113,.15);
      border: 1.5px solid rgba(202,138,113,.35);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
    }
    .rv-err-logo img { height: 24px; width: auto; }
    .rv-err-icon-wrap {
      font-size: 42px;
      margin-bottom: 16px;
      line-height: 1;
    }
    .rv-err-title {
      font-size: 19px; font-weight: 800;
      color: #fff; margin-bottom: 10px;
      letter-spacing: -.3px;
    }
    .rv-err-msg {
      font-size: 13.5px; color: rgba(255,255,255,.5);
      line-height: 1.7; margin-bottom: 28px;
    }
    .rv-err-btn {
      display: inline-block;
      background: #CA8A71; color: #fff; border: none;
      padding: 13px 36px; border-radius: 100px;
      font-size: 14px; font-weight: 700;
      cursor: pointer; text-decoration: none;
      transition: background .18s;
    }
    .rv-err-btn:hover { background: #b57560; }
    .rv-err-contact {
      margin-top: 16px;
      font-size: 12px; color: rgba(255,255,255,.28);
    }
    .rv-err-contact a {
      color: rgba(202,138,113,.7); text-decoration: none;
    }

    /* ══════════════════════════════════════════════
       ENVELOPE SCENE
    ══════════════════════════════════════════════ */
    .env-hint-top {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: rgba(10,30,38,0.45);
      margin-bottom: 64px;
    }

    /* Container */
    .env-scene {
      position: relative;
      width: 280px;
      height: 480px;
      overflow: hidden; /* prevents card peeking below envelope */
    }

    /* ── Boarding pass ── */
    .bp {
      position: absolute;
      top: 0;
      left: 10px; right: 10px;
      z-index: 1;
      background: #fff;
      border-radius: 12px 12px 8px 8px;
      overflow: hidden;
      box-shadow: 0 24px 64px rgba(0,0,0,0.55), 0 4px 16px rgba(0,0,0,0.3);
      /* Start fully hidden below envelope — pushed down so even top edge is hidden */
      transform: translateY(370px);
      opacity: 0;
      transition: transform 1s 0.25s cubic-bezier(0.34, 1.08, 0.64, 1),
                  opacity   0.2s 0.25s ease;
    }
    .env-scene.open .bp {
      transform: translateY(0);
      opacity: 1;
    }

    /* BP header strip */
    .bp-head {
      background: #CA8A71;
      padding: 10px 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .bp-head img { height: 18px; width: auto; }
    .bp-head-label {
      font-size: 8.5px;
      font-weight: 700;
      letter-spacing: 2px;
      color: rgba(255,255,255,0.75);
    }

    /* BP body */
    .bp-body { padding: 14px 16px 12px; transition: opacity 0.2s ease; }

    /* Route row */
    .bp-route {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 10px;
    }
    .bp-from { flex: 0 0 auto; }
    .bp-from-iata {
      font-size: 28px;
      font-weight: 800;
      color: #08112a;
      line-height: 1;
      letter-spacing: -1px;
    }
    .bp-from-city {
      font-size: 10px;
      color: #9ca3af;
      margin-top: 2px;
    }
    .bp-plane {
      flex: 1;
      text-align: center;
      font-size: 16px;
      color: #CA8A71;
    }
    .bp-to { flex: 0 1 auto; text-align: right; }
    .bp-dest {
      font-size: 22px;
      font-weight: 800;
      color: #CA8A71;
      line-height: 1.1;
      letter-spacing: -0.5px;
      text-transform: capitalize;
    }

    /* Ticket tear line */
    .bp-tear {
      position: relative;
      height: 1px;
      background: #f0f0f0;
      margin: 0 -16px 10px;
    }
    .bp-tear::before,
    .bp-tear::after {
      content: '';
      position: absolute;
      top: -7px;
      width: 14px; height: 14px;
      background: #efe9e7;
      border-radius: 50%;
    }
    .bp-tear::before { left: -7px; }
    .bp-tear::after  { right: -7px; }

    /* Detail columns */
    .bp-details {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 4px;
      margin-bottom: 10px;
    }
    .bp-detail-lbl {
      font-size: 7.5px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: #9ca3af;
      margin-bottom: 3px;
    }
    .bp-detail-val {
      font-size: 10.5px;
      font-weight: 700;
      color: #08112a;
      line-height: 1.3;
    }
    .bp-detail-val.accent { color: #CA8A71; }

    /* Passenger row */
    .bp-pax {
      padding-top: 9px;
      border-top: 1px dashed #e5e7eb;
    }
    .bp-pax-row {
      font-size: 10px;
      color: #374151;
      font-weight: 600;
      line-height: 1.5;
      display: flex;
      gap: 5px;
    }

    /* ══════════════════════════════════════════════
       ENVELOPE WRAPPER
    ══════════════════════════════════════════════ */
    .env-wrap {
      position: absolute;
      bottom: 0;
      left: 0; right: 0;
      z-index: 2;
      cursor: pointer;
    }

    /* Flap */
    .env-flap {
      width: 280px;
      height: 104px;
      background: #0F2D35;
      clip-path: polygon(0 0, 100% 0, 50% 100%);
      transform-origin: top center;
      transform: perspective(500px) rotateX(0deg);
      transition: transform 0.72s cubic-bezier(0.4, 0, 0.2, 1);
      backface-visibility: hidden;
    }
    .env-scene.open .env-flap {
      transform: perspective(500px) rotateX(180deg);
    }

    /* Envelope body */
    .env-body {
      width: 280px;
      height: 178px;
      background: #0F2D35;
      position: relative;
      overflow: hidden;
    }

    .env-fold-l {
      position: absolute;
      left: 0; top: 0;
      width: 0; height: 0;
      border-style: solid;
      border-width: 89px 0 89px 140px;
      border-color: transparent transparent transparent #0A1E26;
    }
    .env-fold-r {
      position: absolute;
      right: 0; top: 0;
      width: 0; height: 0;
      border-style: solid;
      border-width: 89px 140px 89px 0;
      border-color: transparent #0A1E26 transparent transparent;
    }

    /* Logo circle */
    .env-fav {
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      width: 58px; height: 58px;
      background: #CA8A71;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      z-index: 3;
      box-shadow: 0 4px 20px rgba(202,138,113,0.4);
    }
    .env-fav img {
      width: 62%;
      height: 62%;
      object-fit: contain;
    }
    .env-fav-fb {
      font-family: Georgia, serif;
      font-size: 15px; font-weight: 700;
      color: #fff; display: none;
    }

    .env-bottom-strip {
      width: 280px;
      height: 10px;
      background: #0A1E26;
      border-radius: 0 0 6px 6px;
    }

    /* ── Click hint ── */
    .env-hint-click {
      margin-top: 64px;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: rv-pulse 2.2s ease-in-out infinite;
    }
    .env-hint-label {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: rgba(10,30,38,0.5);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .env-hint-label .dot {
      width: 5px; height: 5px;
      background: #CA8A71;
      border-radius: 50%;
      display: inline-block;
    }
    @keyframes rv-pulse {
      0%,100% { opacity: 0.45; }
      50%      { opacity: 1;    }
    }

    /* ── Airplane SVG (launch on open) ── */
    .rv-plane {
      position: fixed;
      width: 46px; height: 46px;
      opacity: 0;
      z-index: 30;
      pointer-events: none;
    }

    /* ── Sparkle particles ── */
    .rv-spark {
      position: fixed;
      pointer-events: none;
      z-index: 31;
      border-radius: 50%;
    }

    @media (max-width: 340px) {
      .env-scene, .env-wrap, .env-flap,
      .env-body, .env-bottom-strip { width: 240px; }
      .env-fold-l { border-width: 89px 0 89px 120px; }
      .env-fold-r { border-width: 89px 120px 89px 0; }
      .bp { left: 5px; right: 5px; }
    }

    /* ── Scratch card ── */
    #scratchCanvas {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      cursor: crosshair;
      z-index: 5;
      touch-action: none;
      border-radius: 0 0 8px 8px;
    }
    #scratchHintExternal {
      display: none;
      align-items: center;
      gap: 8px;
      margin-top: 20px;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: rgba(202,138,113,0.85);
      pointer-events: none;
      animation: rv-pulse 1.8s ease-in-out infinite;
    }
    #scratchHintExternal .sh-coin {
      font-size: 16px;
      animation: rv-pulse 1.8s ease-in-out infinite reverse;
    }

    /* ── Background decoration ── */
    .bg-deco {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: 1;
      overflow: hidden;
    }
    /* Earth planets */
    .bg-planet {
      position: absolute;
      border-radius: 50%;
      overflow: hidden;
      animation: planet-float ease-in-out infinite;
      opacity: 0;
      animation-fill-mode: both;
    }
    .bg-planet svg { width: 100%; height: 100%; display: block; }
    @keyframes planet-float {
      0%    { opacity: 0; transform: translateY(0px); }
      8%    { opacity: var(--p-op); }
      92%   { opacity: var(--p-op); }
      100%  { opacity: 0; transform: translateY(-18px); }
    }
    /* Question marks */
    .bg-qmark {
      position: absolute;
      font-family: Georgia, serif;
      font-weight: 700;
      color: rgba(10,30,38,0.06);
      pointer-events: none;
      user-select: none;
      animation: qm-drift ease-in-out infinite;
    }
    @keyframes qm-drift {
      0%,100% { transform: translateY(0)     rotate(0deg);  opacity: 0.06; }
      50%      { transform: translateY(-18px) rotate(6deg); opacity: 0.13; }
    }
  </style>
</head>
<body>

<canvas id="rv-stars"></canvas>

<!-- Background floating planes -->
<div class="bg-planes" id="bgPlanes"></div>
<!-- Background decorations: planets + question marks -->
<div class="bg-deco" id="bgDeco"></div>

<!-- Top logo -->
<a href="/" class="rv-logo">
  <img src="<?php echo esc_url($logo_dark_url); ?>" alt="Escapii"
       onerror="this.outerHTML='<span style=\'font-family:Georgia,serif;font-size:20px;color:#0A1E26;\'>escapii<em style=\'color:#CA8A71;font-style:normal;\'>.</em></span>'">
</a>

<!-- Paper plane SVG for launch animation -->
<svg class="rv-plane" id="rvPlane" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
  <polygon points="44,4 4,20 18,24 22,40 28,30 40,36" fill="#ffffff" stroke="#CA8A71" stroke-width="1.4" stroke-linejoin="round"/>
  <line x1="18" y1="24" x2="26" y2="20" stroke="#CA8A71" stroke-width="1.4" stroke-linecap="round"/>
</svg>

<div class="scene">

  <!-- LOADING -->
  <div class="rv-state active" id="rvLoading">
    <div class="rv-spinner"></div>
  </div>

  <!-- ERROR (modal overlay) -->
  <div class="rv-err-backdrop" id="rvError">
    <div class="rv-err-card">
      <div class="rv-err-logo">
        <img src="<?php echo esc_url($logo_url); ?>" alt="Escapii"
             onerror="this.outerHTML='<span style=\'font-family:Georgia,serif;font-size:15px;color:#CA8A71;\'>e</span>'">
      </div>
      <div class="rv-err-icon-wrap" id="rvErrIcon">⚠️</div>
      <div class="rv-err-title"     id="rvErrTitle">Nešto je pošlo po krivu</div>
      <div class="rv-err-msg"       id="rvErrMsg">Došlo je do neočekivane greške. Pokušaj ponovo ili nas kontaktiraj.</div>
      <a href="/" class="rv-err-btn">← Nazad na početnu</a>
      <div class="rv-err-contact">
        Problem? Piši nam na <a href="mailto:escapii.team@gmail.com">escapii.team@gmail.com</a>
      </div>
    </div>
  </div>

  <!-- ENVELOPE + BOARDING PASS -->
  <div class="rv-state" id="rvEnvState">
    <div class="env-hint-top">Tvoja destinacija čeka</div>

    <div class="env-scene" id="envScene">

      <!-- Boarding pass (hidden initially, slides up on open) -->
      <div class="bp" id="rvBp">
        <div class="bp-head">
          <img src="<?php echo esc_url($logo_url); ?>" alt="Escapii"
               onerror="this.outerHTML='<span style=\'font-family:Georgia,serif;font-size:15px;color:#fff;\'>escapii.</span>'">
          <span class="bp-head-label">BOARDING PASS</span>
        </div>
        <div class="bp-body">
          <div class="bp-route">
            <div class="bp-from">
              <div class="bp-from-iata" id="bpFromIata">—</div>
              <div class="bp-from-city" id="bpFromCity">—</div>
            </div>
            <div class="bp-plane">✈</div>
            <div class="bp-to">
              <div class="bp-dest" id="bpDest">—</div>
            </div>
          </div>
          <div class="bp-tear"></div>
          <div class="bp-details">
            <div>
              <div class="bp-detail-lbl">Polazak</div>
              <div class="bp-detail-val" id="bpDate">—</div>
            </div>
            <div>
              <div class="bp-detail-lbl">Povratak</div>
              <div class="bp-detail-val" id="bpReturn">—</div>
            </div>
            <div>
              <div class="bp-detail-lbl">Rezervacija</div>
              <div class="bp-detail-val accent" id="bpRef">—</div>
            </div>
          </div>
          <div class="bp-pax">
            <div class="bp-pax-row">
              ✈&nbsp;<span id="bpPassengers">—</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Envelope -->
      <div class="env-wrap" id="envWrap">
        <div class="env-flap"></div>
        <div class="env-body">
          <div class="env-fold-l"></div>
          <div class="env-fold-r"></div>
          <div class="env-fav" id="envFav">
            <img id="envFavImg"
                 src="<?php echo esc_url(get_template_directory_uri()); ?>/images/favicon.png"
                 alt=""
                 onerror="this.style.display='none';document.getElementById('envFavFb').style.display='block';">
            <span class="env-fav-fb" id="envFavFb">e</span>
          </div>
        </div>
        <div class="env-bottom-strip"></div>
      </div>

    </div><!-- /env-scene -->

    <div class="env-hint-click" id="envHint">
      <div class="env-hint-label">
        <span class="dot"></span> KLIKNI DA OTVORIŠ <span class="dot"></span>
      </div>
    </div>

    <div id="scratchHintExternal">
      <span class="sh-coin">🪙</span>
      OGREBI I OTKRIJ DESTINACIJU
      <span class="sh-coin">🪙</span>
    </div>
  </div>

</div><!-- /scene -->

<script>
const API = '<?php echo esc_js(escapii_api_url()); ?>';
let opened = false;
let errorShown = false;

/* ── Stars ── */
(function() {
  const c = document.getElementById('rv-stars');
  const ctx = c.getContext('2d');
  function resize() { c.width = innerWidth; c.height = innerHeight; }
  resize();
  addEventListener('resize', resize);
  // Subtle warm dust particles on light background
  const stars = Array.from({length: 120}, () => ({
    x: Math.random(), y: Math.random(),
    r: Math.random() * 1.2 + 0.3,
    phase: Math.random() * Math.PI * 2,
    speed: Math.random() * 0.005 + 0.001,
    warm: Math.random() > 0.5
  }));
  function draw(t) {
    ctx.clearRect(0, 0, c.width, c.height);
    stars.forEach(s => {
      const a = 0.04 + 0.10 * (0.5 + 0.5 * Math.sin(t * s.speed + s.phase));
      ctx.beginPath();
      ctx.arc(s.x * c.width, s.y * c.height, s.r, 0, Math.PI * 2);
      ctx.fillStyle = s.warm ? 'rgba(202,138,113,1)' : 'rgba(10,30,38,1)';
      ctx.globalAlpha = a;
      ctx.fill();
    });
    ctx.globalAlpha = 1;
    requestAnimationFrame(draw);
  }
  requestAnimationFrame(draw);
})();

/* ── Background floating planes (real airliner silhouette) ── */
(function() {
  const container = document.getElementById('bgPlanes');
  // Commercial airliner side-view SVG
  const planeSvg = `<svg viewBox="0 0 80 28" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M72 14 C68 14 52 11 34 11 L10 11 C6.5 11 4 12.2 4 14 C4 15.8 6.5 17 10 17 L34 17 C52 17 68 17 72 14Z" fill="rgba(15,45,53,0.18)"/>
    <path d="M10 11 L4 14 L10 17Z" fill="rgba(15,45,53,0.22)"/>
    <path d="M40 11 L24 3  L29 11Z" fill="rgba(15,45,53,0.16)"/>
    <path d="M40 17 L24 25 L29 17Z" fill="rgba(15,45,53,0.12)"/>
    <path d="M66 11 L61 6  L63 11Z" fill="rgba(15,45,53,0.12)"/>
    <path d="M66 17 L59 20 L62 17Z" fill="rgba(15,45,53,0.09)"/>
    <circle cx="18" cy="14" r="2" fill="rgba(202,138,113,0.35)"/>
    <circle cx="26" cy="14" r="2" fill="rgba(202,138,113,0.28)"/>
  </svg>`;

  const configs = [
    { size:52, startX:'-8vw', startY:'12vh', dx:'114vw', dy:'-6vh',  rot:'-12deg', dur:22, delay:0,    op:0.22 },
    { size:38, startX:'-8vw', startY:'62vh', dx:'116vw', dy:'-18vh', rot:'-18deg', dur:28, delay:6,    op:0.16 },
    { size:60, startX:'-8vw', startY:'38vh', dx:'114vw', dy:'-10vh', rot:'-8deg',  dur:34, delay:12,   op:0.14 },
    { size:32, startX:'-8vw', startY:'78vh', dx:'116vw', dy:'-28vh', rot:'-22deg', dur:24, delay:18,   op:0.18 },
    { size:44, startX:'-8vw', startY:'25vh', dx:'114vw', dy:'-4vh',  rot:'-10deg', dur:30, delay:9,    op:0.13 },
    { size:28, startX:'-8vw', startY:'52vh', dx:'115vw', dy:'-16vh', rot:'-15deg', dur:26, delay:22,   op:0.15 },
  ];

  configs.forEach(cfg => {
    const el = document.createElement('div');
    el.className = 'bg-plane';
    el.innerHTML = planeSvg;
    el.querySelector('svg').style.width  = cfg.size + 'px';
    el.querySelector('svg').style.height = (cfg.size * 28/80) + 'px';
    el.style.left = cfg.startX;
    el.style.top  = cfg.startY;
    el.style.setProperty('--dx',     cfg.dx);
    el.style.setProperty('--dy',     cfg.dy);
    el.style.setProperty('--rot',    cfg.rot);
    el.style.setProperty('--max-op', cfg.op);
    el.style.animationDuration = cfg.dur + 's';
    el.style.animationDelay    = cfg.delay + 's';
    container.appendChild(el);
  });
})();

/* ── Background planets + question marks ── */
(function() {
  const deco = document.getElementById('bgDeco');

  // Earth SVG — reused for all planet instances
  const earthSvg = `<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <!-- Atmosphere halo -->
    <circle cx="50" cy="50" r="50" fill="rgba(60,130,220,0.06)"/>
    <!-- Ocean -->
    <circle cx="50" cy="50" r="45" fill="rgba(14,48,88,0.38)" stroke="rgba(55,120,210,0.20)" stroke-width="1.5"/>
    <!-- Ice caps -->
    <ellipse cx="50" cy="9"  rx="17" ry="7"  fill="rgba(200,225,255,0.16)"/>
    <ellipse cx="50" cy="91" rx="12" ry="5"  fill="rgba(200,225,255,0.10)"/>
    <!-- Europe / Africa -->
    <ellipse cx="54" cy="46" rx="11" ry="17" fill="rgba(42,82,38,0.30)" transform="rotate(8 54 46)"/>
    <!-- Americas -->
    <ellipse cx="28" cy="52" rx="8"  ry="18" fill="rgba(48,82,38,0.26)" transform="rotate(-8 28 52)"/>
    <!-- Asia -->
    <ellipse cx="70" cy="37" rx="13" ry="10" fill="rgba(42,78,36,0.24)" transform="rotate(-20 70 37)"/>
    <!-- Australia -->
    <ellipse cx="73" cy="66" rx="7"  ry="5"  fill="rgba(85,68,35,0.24)"/>
    <!-- Cloud streaks -->
    <ellipse cx="44" cy="28" rx="13" ry="3"  fill="rgba(255,255,255,0.07)" transform="rotate(-18 44 28)"/>
    <ellipse cx="62" cy="58" rx="10" ry="2.5" fill="rgba(255,255,255,0.05)" transform="rotate(12 62 58)"/>
    <!-- Orbital ring -->
    <ellipse cx="50" cy="50" rx="48" ry="12" fill="none" stroke="rgba(202,138,113,0.10)" stroke-width="1" transform="rotate(-20 50 50)"/>
  </svg>`;

  // Planet instances
  const planets = [
    { size:92,  top:'7%',  left:'6%',  dur:18, delay:0,  op:0.32 },
    { size:58,  top:'71%', left:'79%', dur:22, delay:4,  op:0.26 },
    { size:40,  top:'19%', left:'87%', dur:16, delay:2,  op:0.22 },
    { size:72,  top:'54%', left:'3%',  dur:26, delay:6,  op:0.28 },
    { size:46,  top:'87%', left:'44%', dur:20, delay:1,  op:0.22 },
  ];
  planets.forEach(p => {
    const el = document.createElement('div');
    el.className = 'bg-planet';
    el.innerHTML = earthSvg;
    el.style.cssText = `width:${p.size}px;height:${p.size}px;top:${p.top};left:${p.left};` +
      `animation-duration:${p.dur}s;animation-delay:${p.delay}s;--p-op:${p.op}`;
    deco.appendChild(el);
  });

  // Mystery question marks
  const qmarks = [
    { size:110, top:'6%',  left:'62%', dur:10, delay:0   },
    { size:70,  top:'78%', left:'15%', dur:12, delay:4   },
    { size:90,  top:'40%', left:'92%', dur:9,  delay:2   },
    { size:55,  top:'60%', left:'58%', dur:14, delay:7   },
    { size:130, top:'22%', left:'2%',  dur:11, delay:1   },
  ];
  qmarks.forEach(q => {
    const el = document.createElement('div');
    el.className = 'bg-qmark';
    el.textContent = '?';
    el.style.cssText = `font-size:${q.size}px;top:${q.top};left:${q.left};animation-duration:${q.dur}s;animation-delay:${q.delay}s`;
    deco.appendChild(el);
  });
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
  document.getElementById('rvLoading').classList.remove('active');
  const m = {
    404: ['🔒','Link nije validan','Ovaj link nije ispravan ili je istekao. Proveri da li si kopirao ceo link iz emaila.'],
    410: ['✈️','Putovanje je počelo!','Tvoje putovanje je već počelo. Srećan put i uživaj u iznenađenju!'],
    403: ['⏳','Još nije dostupno','Rezervacija još nije potvrđena ili destinacija nije unesena. Pokušaj ponovo uskoro.'],
  }[status] || ['🌍','Došlo je do neočekivane greške','Nešto nije pošlo kako treba. Pokušaj ponovo ili nas kontaktiraj — rešićemo to u najkraćem roku.'];
  document.getElementById('rvErrIcon').textContent  = m[0];
  document.getElementById('rvErrTitle').textContent = m[1];
  document.getElementById('rvErrMsg').textContent   = m[2];
  document.getElementById('rvError').classList.add('active');
}

/* ── Global error handlers ── */
window.onerror = function() { showError(0); return true; };
window.addEventListener('unhandledrejection', function() { showError(0); });

/* ── Show envelope ── */
function showEnvelope(data) {
  document.getElementById('rvLoading').classList.remove('active');
  document.getElementById('rvEnvState').classList.add('active');

  const iata = (data.departureAirport || '').toUpperCase();
  document.getElementById('bpFromIata').textContent = iata || '—';
  document.getElementById('bpFromCity').textContent = airportCity(iata);
  const destEl = document.getElementById('bpDest');
  destEl.textContent  = data.destination || '—';
  // Hide entire bp-body until scratch card is revealed
  document.querySelector('.bp-body').style.opacity = '0';
  document.getElementById('bpDate').textContent   = fmtDate(data.departureDate);
  document.getElementById('bpReturn').textContent = fmtDate(data.returnDate);
  document.getElementById('bpRef').textContent    = data.bookingRef || '—';

  const names = Array.isArray(data.passengers) && data.passengers.length
      ? data.passengers.join(' · ')
      : '—';
  document.getElementById('bpPassengers').textContent = names;

  document.getElementById('envWrap').addEventListener('click', openEnvelope);
  document.getElementById('envScene').addEventListener('click', openEnvelope);
}

/* ── Open envelope ── */
function openEnvelope() {
  if (opened) return;
  opened = true;

  document.getElementById('envScene').classList.add('open');

  const hint = document.getElementById('envHint');
  hint.style.transition = 'opacity 0.35s';
  hint.style.opacity = '0';

  setTimeout(launchPlane, 420);
  setTimeout(sparkles, 700);
  // Scratch card appears after boarding pass slides fully into view
  setTimeout(addScratchCard, 1450);
}

/* ── Airplane launch ── */
function launchPlane() {
  const env   = document.getElementById('envWrap').getBoundingClientRect();
  const plane = document.getElementById('rvPlane');

  plane.style.left      = (env.left + env.width * 0.6) + 'px';
  plane.style.top       = (env.top + 20) + 'px';
  plane.style.transform = 'rotate(-38deg)';
  plane.style.opacity   = '1';
  plane.style.transition = 'none';

  requestAnimationFrame(() => requestAnimationFrame(() => {
    plane.style.transition = 'transform 1.3s cubic-bezier(0.3, 0.1, 0.65, 0.9), opacity 1s 0.3s ease-in';
    plane.style.transform  = 'translate(260px, -320px) rotate(-42deg)';
    plane.style.opacity    = '0';
  }));
}

/* ── Sparkles ── */
function sparkles() {
  const bp  = document.getElementById('rvBp').getBoundingClientRect();
  const cx  = bp.left + bp.width  / 2;
  const cy  = bp.top  + bp.height / 3;
  const cols = ['#CA8A71','#F5C9A8','#ffffff','#2D5F6B','#CA8A71'];

  for (let i = 0; i < 20; i++) {
    const el  = document.createElement('div');
    el.className = 'rv-spark';
    const sz  = Math.random() * 7 + 3;
    const ang = (Math.PI * 2 * i / 20) + (Math.random() - 0.5) * 0.4;
    const dist = 60 + Math.random() * 100;

    el.style.cssText = [
      'width:' + sz + 'px', 'height:' + sz + 'px',
      'background:' + cols[i % cols.length],
      'border-radius:' + (Math.random() > 0.45 ? '50%' : '3px'),
      'left:' + cx + 'px', 'top:' + cy + 'px',
      'transform:translate(-50%,-50%)', 'opacity:1'
    ].join(';');
    document.body.appendChild(el);

    const tx  = Math.cos(ang) * dist;
    const ty  = Math.sin(ang) * dist;
    const dur = 0.55 + Math.random() * 0.35;
    const del = Math.random() * 0.15;

    requestAnimationFrame(() => requestAnimationFrame(() => {
      el.style.transition = `transform ${dur}s ${del}s ease-out, opacity ${dur * 0.8}s ${del + 0.1}s ease-out`;
      el.style.transform  = `translate(calc(-50% + ${tx}px), calc(-50% + ${ty}px)) rotate(${Math.random()*360}deg)`;
      el.style.opacity    = '0';
    }));
    setTimeout(() => el.remove(), (dur + del + 0.2) * 1000);
  }
}

/* ── Scratch card ── */
function addScratchCard() {
  const bpBody = document.querySelector('.bp-body');
  const destEl = document.getElementById('bpDest');
  if (!bpBody || !destEl) return;

  const dpr  = window.devicePixelRatio || 1;

  // Restore body visibility — canvas will immediately cover it
  bpBody.style.opacity = '1';

  const rect = bpBody.getBoundingClientRect();
  const cw   = rect.width;
  const ch   = rect.height;

  // Canvas covers entire .bp-body
  const canvas = document.createElement('canvas');
  canvas.id = 'scratchCanvas';
  canvas.width  = Math.round(cw * dpr);
  canvas.height = Math.round(ch * dpr);
  bpBody.style.position = 'relative';
  bpBody.appendChild(canvas);

  const ctx = canvas.getContext('2d');
  const W = canvas.width, H = canvas.height;

  // ── Draw cover: dark teal gradient matching site palette ──
  const grad = ctx.createLinearGradient(0, 0, W, H);
  grad.addColorStop(0,   '#16424f');
  grad.addColorStop(0.5, '#0D2E38');
  grad.addColorStop(1,   '#091e2e');
  ctx.fillStyle = grad;
  ctx.fillRect(0, 0, W, H);

  // Dot grid texture
  ctx.fillStyle = 'rgba(202,138,113,0.07)';
  const step = Math.round(16 * dpr);
  for (let row = step; row < H; row += step) {
    for (let col = (Math.floor(row / step) % 2 === 0 ? 0 : step / 2); col < W; col += step) {
      ctx.beginPath();
      ctx.arc(col, row, 1.2 * dpr, 0, Math.PI * 2);
      ctx.fill();
    }
  }

  // Subtle corner "?" decorations
  ctx.font = `bold ${Math.round(28 * dpr)}px Georgia, serif`;
  ctx.fillStyle = 'rgba(202,138,113,0.08)';
  ctx.textAlign = 'left';   ctx.textBaseline = 'top';
  ctx.fillText('?', 8 * dpr, 6 * dpr);
  ctx.textAlign = 'right';  ctx.textBaseline = 'bottom';
  ctx.fillText('?', W - 8 * dpr, H - 6 * dpr);

  // Center: coin icon + main hint text
  ctx.textAlign = 'center'; ctx.textBaseline = 'middle';

  ctx.font = `${Math.round(22 * dpr)}px serif`;
  ctx.fillStyle = 'rgba(202,138,113,0.7)';
  ctx.fillText('🪙', W / 2, H / 2 - Math.round(18 * dpr));

  ctx.font = `bold ${Math.round(9 * dpr)}px -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif`;
  ctx.fillStyle = 'rgba(202,138,113,0.95)';
  ctx.fillText('✦  OGREBI DA OTKRIJEŠ  ✦', W / 2, H / 2 + Math.round(2 * dpr));

  ctx.font = `${Math.round(7.5 * dpr)}px -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif`;
  ctx.fillStyle = 'rgba(255,255,255,0.3)';
  ctx.fillText('svoju destinaciju', W / 2, H / 2 + Math.round(16 * dpr));

  // Show external hint label
  const hintExt = document.getElementById('scratchHintExternal');
  if (hintExt) hintExt.style.display = 'flex';

  // ── Scratch logic ──
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
    ctx.beginPath();
    ctx.arc(x, y, 28 * dpr, 0, Math.PI * 2);
    ctx.fill();
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
    // Destination text is already correct color — just ensure visibility
    destEl.style.color = '#CA8A71';

    canvas.style.transition = 'opacity 0.55s ease';
    canvas.style.opacity    = '0';
    if (hintExt) {
      hintExt.style.transition = 'opacity 0.3s';
      hintExt.style.opacity    = '0';
    }
    setTimeout(() => {
      canvas.remove();
      if (hintExt) hintExt.style.display = 'none';
    }, 600);

    // Celebration burst on destination text
    setTimeout(() => {
      const r   = destEl.getBoundingClientRect();
      const cx  = r.left + r.width / 2;
      const cy  = r.top  + r.height / 2;
      const cols = ['#CA8A71','#F5C9A8','#ffffff','#2D5F6B'];
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
        const tx  = Math.cos(ang) * dist;
        const ty  = Math.sin(ang) * dist;
        const dur = 0.5 + Math.random() * 0.4;
        const del = Math.random() * 0.12;
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
    showEnvelope(await res.json());
  } catch(e) {
    showError(0);
  }
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
