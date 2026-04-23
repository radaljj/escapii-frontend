<?php
/**
 * Template Name: Otkrivanje Destinacije
 * Prikazuje se kada korisnik klikne magic link iz reveal emaila.
 * URL: /otkrivanje?token=abc123
 */
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
      background: #08112a;
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

    /* ── Logo top ── */
    .rv-logo {
      position: fixed;
      top: 22px;
      left: 50%;
      transform: translateX(-50%);
      font-family: Georgia, 'Times New Roman', serif;
      font-size: 21px;
      font-weight: normal;
      color: #fff;
      text-decoration: none;
      letter-spacing: -0.3px;
      z-index: 20;
    }
    .rv-logo em { color: #CA8A71; font-style: normal; }

    /* ── Scene ── */
    .scene {
      position: relative;
      z-index: 1;
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

    /* ── Error ── */
    .rv-err-icon  { font-size: 50px; margin-bottom: 18px; }
    .rv-err-title { font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 10px; }
    .rv-err-msg   {
      font-size: 14px; color: rgba(255,255,255,0.45); line-height: 1.65;
      text-align: center; max-width: 300px; margin-bottom: 26px;
    }
    .rv-err-btn {
      background: #CA8A71; color: #fff; border: none;
      padding: 12px 32px; border-radius: 100px;
      font-size: 14px; font-weight: 700;
      cursor: pointer; text-decoration: none;
    }

    /* ══════════════════════════════════════════════
       ENVELOPE SCENE
    ══════════════════════════════════════════════ */
    .env-hint-top {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.28);
      margin-bottom: 28px;
    }

    /* Container — tall enough for BP above + envelope below */
    .env-scene {
      position: relative;
      width: 280px;
      height: 480px;
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
      /* Start hidden inside envelope */
      transform: translateY(280px);
      transition: transform 1s 0.22s cubic-bezier(0.34, 1.08, 0.64, 1);
    }
    .env-scene.open .bp { transform: translateY(0); }

    /* BP header strip */
    .bp-head {
      background: #CA8A71;
      padding: 11px 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .bp-head-logo {
      font-family: Georgia, serif;
      font-size: 16px;
      font-weight: normal;
      color: #fff;
    }
    .bp-head-logo em { font-style: normal; }
    .bp-head-label {
      font-size: 8.5px;
      font-weight: 700;
      letter-spacing: 2px;
      color: rgba(255,255,255,0.7);
    }

    /* BP body */
    .bp-body { padding: 16px 18px 14px; }

    /* Route row */
    .bp-route {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 12px;
    }
    .bp-from { flex: 0 0 auto; }
    .bp-from-iata {
      font-size: 30px;
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
      font-size: 24px;
      font-weight: 800;
      color: #CA8A71;
      line-height: 1.1;
      letter-spacing: -0.5px;
    }

    /* Ticket tear line */
    .bp-tear {
      position: relative;
      height: 1px;
      background: #f0f0f0;
      margin: 0 -18px 12px;
    }
    .bp-tear::before,
    .bp-tear::after {
      content: '';
      position: absolute;
      top: -7px;
      width: 14px; height: 14px;
      background: #08112a;
      border-radius: 50%;
    }
    .bp-tear::before { left: -7px; }
    .bp-tear::after  { right: -7px; }

    /* Detail columns */
    .bp-details {
      display: flex;
      gap: 4px;
    }
    .bp-detail { flex: 1; }
    .bp-detail-lbl {
      font-size: 8px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: #9ca3af;
      margin-bottom: 3px;
    }
    .bp-detail-val {
      font-size: 11px;
      font-weight: 700;
      color: #08112a;
    }
    .bp-detail-val.accent { color: #CA8A71; }

    /* Passenger row */
    .bp-pax {
      margin-top: 12px;
      padding-top: 10px;
      border-top: 1px dashed #e5e7eb;
      font-size: 10px;
      color: #9ca3af;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .bp-pax-name { font-weight: 700; color: #374151; }

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

    /* Flap — triangle pointing DOWN when closed, rotates open */
    .env-flap {
      width: 280px;
      height: 104px;
      background: #112438;
      clip-path: polygon(0 0, 100% 0, 50% 100%);
      transform-origin: top center;
      transform: perspective(500px) rotateX(0deg);
      transition: transform 0.72s cubic-bezier(0.4, 0, 0.2, 1);
      backface-visibility: hidden;
    }
    .env-scene.open .env-flap {
      transform: perspective(500px) rotateX(180deg);
    }

    /* Envelope rectangular body */
    .env-body {
      width: 280px;
      height: 178px;
      background: #0D2E38;
      position: relative;
      overflow: hidden;
    }

    /* Left fold triangle */
    .env-fold-l {
      position: absolute;
      left: 0; top: 0;
      width: 0; height: 0;
      border-style: solid;
      border-width: 89px 0 89px 140px;
      border-color: transparent transparent transparent #091e2e;
    }

    /* Right fold triangle */
    .env-fold-r {
      position: absolute;
      right: 0; top: 0;
      width: 0; height: 0;
      border-style: solid;
      border-width: 89px 140px 89px 0;
      border-color: transparent #091e2e transparent transparent;
    }

    /* Favicon circle — center of envelope */
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
      font-size: 15px;
      font-weight: 700;
      color: #fff;
      display: none;
    }

    /* Envelope bottom strip */
    .env-bottom-strip {
      width: 280px;
      height: 10px;
      background: #091e2e;
      border-radius: 0 0 6px 6px;
    }

    /* ── Click hint ── */
    .env-hint-click {
      margin-top: 26px;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.4);
      display: flex;
      align-items: center;
      gap: 10px;
      animation: rv-pulse 2.2s ease-in-out infinite;
    }
    .env-hint-click .dot {
      width: 5px; height: 5px;
      background: #CA8A71;
      border-radius: 50%;
      display: inline-block;
    }
    @keyframes rv-pulse {
      0%,100% { opacity: 0.4; }
      50%      { opacity: 1;   }
    }

    /* ── Airplane SVG ── */
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
  </style>
</head>
<body>

<canvas id="rv-stars"></canvas>

<a href="/" class="rv-logo">escapii<em>.</em></a>

<!-- Paper plane SVG (hidden, positioned via JS on open) -->
<svg class="rv-plane" id="rvPlane" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
  <polygon points="44,4 4,20 18,24 22,40 28,30 40,36" fill="#ffffff" stroke="#CA8A71" stroke-width="1.4" stroke-linejoin="round"/>
  <line x1="18" y1="24" x2="26" y2="20" stroke="#CA8A71" stroke-width="1.4" stroke-linecap="round"/>
</svg>

<div class="scene">

  <!-- LOADING -->
  <div class="rv-state active" id="rvLoading">
    <div class="rv-spinner"></div>
  </div>

  <!-- ERROR -->
  <div class="rv-state" id="rvError">
    <div class="rv-err-icon" id="rvErrIcon">🔒</div>
    <div class="rv-err-title" id="rvErrTitle">Link nije validan</div>
    <div class="rv-err-msg"   id="rvErrMsg">Ovaj link nije ispravan ili je istekao.</div>
    <a href="/" class="rv-err-btn">← Nazad na početnu</a>
  </div>

  <!-- ENVELOPE + BOARDING PASS -->
  <div class="rv-state" id="rvEnvState">
    <div class="env-hint-top">Tvoja destinacija čeka</div>

    <div class="env-scene" id="envScene">

      <!-- Boarding pass (hidden initially, slides up on open) -->
      <div class="bp" id="rvBp">
        <div class="bp-head">
          <span class="bp-head-logo">escapii<em>.</em></span>
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
            <div class="bp-detail">
              <div class="bp-detail-lbl">Datum</div>
              <div class="bp-detail-val" id="bpDate">—</div>
            </div>
            <div class="bp-detail">
              <div class="bp-detail-lbl">Noći</div>
              <div class="bp-detail-val" id="bpNights">—</div>
            </div>
            <div class="bp-detail">
              <div class="bp-detail-lbl">Rezervacija</div>
              <div class="bp-detail-val accent" id="bpRef">—</div>
            </div>
          </div>
          <div class="bp-pax">
            ✈&nbsp;<span class="bp-pax-name" id="bpName">—</span>
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
            <span class="env-fav-fb" id="envFavFb">e?</span>
          </div>
        </div>
        <div class="env-bottom-strip"></div>
      </div>

    </div><!-- /env-scene -->

    <div class="env-hint-click" id="envHint">
      <span class="dot"></span> KLIKNI DA OTVORIŠ <span class="dot"></span>
    </div>
  </div>

</div><!-- /scene -->

<script>
/* ── Config ── */
const API = 'https://escapii-backend.onrender.com';
let opened = false;

/* ── Stars ───────────────────────────────────────────────────── */
(function() {
  const c = document.getElementById('rv-stars');
  const ctx = c.getContext('2d');
  function resize() { c.width = innerWidth; c.height = innerHeight; }
  resize();
  addEventListener('resize', resize);

  const stars = Array.from({length: 200}, () => ({
    x: Math.random(), y: Math.random(),
    r: Math.random() * 1.5 + 0.2,
    phase: Math.random() * Math.PI * 2,
    speed: Math.random() * 0.006 + 0.002,
    gold: Math.random() > 0.88
  }));

  function draw(t) {
    ctx.clearRect(0, 0, c.width, c.height);
    stars.forEach(s => {
      const a = 0.25 + 0.75 * (0.5 + 0.5 * Math.sin(t * s.speed + s.phase));
      ctx.beginPath();
      ctx.arc(s.x * c.width, s.y * c.height, s.r, 0, Math.PI * 2);
      ctx.fillStyle = s.gold ? '#F5C9A8' : '#ffffff';
      ctx.globalAlpha = a;
      ctx.fill();
    });
    ctx.globalAlpha = 1;
    requestAnimationFrame(draw);
  }
  requestAnimationFrame(draw);
})();

/* ── Date formatter ───────────────────────────────────────────── */
function fmtDate(iso) {
  if (!iso) return '—';
  const [y,m,d] = iso.split('-');
  const mon = ['JAN','FEB','MAR','APR','MAJ','JUN','JUL','AVG','SEP','OKT','NOV','DEC'];
  return d + '. ' + (mon[+m - 1] || m) + ' ' + y + '.';
}

/* ── Airport city map ─────────────────────────────────────────── */
function airportCity(iata) {
  return ({BEG:'Beograd',INI:'Niš',ZAG:'Zagreb',BUD:'Budimpešta',TIM:'Temišvar'})[iata] || iata || '—';
}

/* ── Error state ──────────────────────────────────────────────── */
function showError(status) {
  document.getElementById('rvLoading').classList.remove('active');
  document.getElementById('rvError').classList.add('active');
  const m = {
    404: ['🔒','Link nije validan','Ovaj link nije ispravan ili je istekao.'],
    410: ['✈','Putovanje je počelo','Tvoje putovanje je već počelo. Srećan put!'],
    403: ['⏳','Destinacija nije dostupna','Rezervacija nije potvrđena ili destinacija još nije unesena.'],
  }[status] || ['⚠️','Nešto je pošlo po krivu','Pokušaj ponovo ili nas kontaktiraj.'];
  document.getElementById('rvErrIcon').textContent  = m[0];
  document.getElementById('rvErrTitle').textContent = m[1];
  document.getElementById('rvErrMsg').textContent   = m[2];
}

/* ── Show envelope ────────────────────────────────────────────── */
function showEnvelope(data) {
  document.getElementById('rvLoading').classList.remove('active');
  document.getElementById('rvEnvState').classList.add('active');

  const iata = (data.departureAirport || '').toUpperCase();
  document.getElementById('bpFromIata').textContent = iata || '—';
  document.getElementById('bpFromCity').textContent = airportCity(iata);
  document.getElementById('bpDest').textContent     = data.destination || '—';
  document.getElementById('bpDate').textContent     = fmtDate(data.departureDate);
  document.getElementById('bpNights').textContent   = data.numberOfNights ? data.numberOfNights + ' noći' : '—';
  document.getElementById('bpRef').textContent      = data.bookingRef || '—';
  document.getElementById('bpName').textContent     = data.firstName || '—';

  document.getElementById('envWrap').addEventListener('click', openEnvelope);
  document.getElementById('envScene').addEventListener('click', openEnvelope);
}

/* ── Open envelope ────────────────────────────────────────────── */
function openEnvelope() {
  if (opened) return;
  opened = true;

  document.getElementById('envScene').classList.add('open');

  /* Fade hint */
  const hint = document.getElementById('envHint');
  hint.style.transition = 'opacity 0.35s';
  hint.style.opacity = '0';

  /* Launch plane at T+400ms (matches BP halfway up) */
  setTimeout(launchPlane, 420);

  /* Sparkle burst at T+700ms (BP nearly fully visible) */
  setTimeout(sparkles, 700);
}

/* ── Airplane launch ──────────────────────────────────────────── */
function launchPlane() {
  const env   = document.getElementById('envWrap').getBoundingClientRect();
  const plane = document.getElementById('rvPlane');

  plane.style.left      = (env.right - 30) + 'px';
  plane.style.top       = (env.top + 10) + 'px';
  plane.style.transform = 'rotate(-38deg)';
  plane.style.opacity   = '1';
  plane.style.transition = 'none';

  requestAnimationFrame(() => requestAnimationFrame(() => {
    /* Same duration as BP slide: 1s + 0.22s delay = 1.22s total → use ~1.1s for plane */
    plane.style.transition = 'transform 1.1s cubic-bezier(0.3, 0.1, 0.65, 0.9), opacity 0.9s 0.2s ease-in';
    plane.style.transform  = 'translate(320px, -280px) rotate(-42deg)';
    plane.style.opacity    = '0';
  }));
}

/* ── Sparkles ─────────────────────────────────────────────────── */
function sparkles() {
  const bp  = document.getElementById('rvBp').getBoundingClientRect();
  const cx  = bp.left + bp.width  / 2;
  const cy  = bp.top  + bp.height / 3;
  const cols = ['#CA8A71','#F5C9A8','#ffffff','#2D5F6B','#CA8A71'];

  for (let i = 0; i < 18; i++) {
    const el   = document.createElement('div');
    el.className = 'rv-spark';
    const sz   = Math.random() * 7 + 3;
    const ang  = (Math.PI * 2 * i / 18) + (Math.random() - 0.5) * 0.4;
    const dist = 55 + Math.random() * 90;

    el.style.width  = sz + 'px';
    el.style.height = sz + 'px';
    el.style.background   = cols[i % cols.length];
    el.style.borderRadius = Math.random() > 0.45 ? '50%' : '2px';
    el.style.left    = cx + 'px';
    el.style.top     = cy + 'px';
    el.style.transform = 'translate(-50%,-50%)';
    el.style.opacity   = '1';
    document.body.appendChild(el);

    const tx = Math.cos(ang) * dist;
    const ty = Math.sin(ang) * dist;
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

/* ── API fetch ────────────────────────────────────────────────── */
(async function init() {
  const token = new URLSearchParams(location.search).get('token');
  if (!token) { showError(404); return; }
  try {
    const res  = await fetch(`${API}/api/reveal?token=${encodeURIComponent(token)}`);
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
