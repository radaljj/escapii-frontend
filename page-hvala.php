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
      max-width: 560px; width: 100%;
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

    /* ── TICKET (same style as reveal page) ── */
    .ticket-wrap {
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 8px 40px rgba(0,0,0,.35);
      background: #fff;
      display: flex; flex-direction: column;
      overflow: hidden;
      margin-bottom: 28px;
      opacity: 0; transform: translateY(16px);
      transition: opacity .6s ease .3s, transform .6s ease .3s;
    }
    .ticket-wrap.visible { opacity: 1; transform: none; }
    .ticket-header {
      background: linear-gradient(135deg, #CA8A71 0%, #b57257 100%);
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
      flex: 1; padding: 14px 16px 12px;
      display: flex; flex-direction: column; gap: 10px;
      background: #fff; position: relative;
    }
    .ticket-route { display: flex; align-items: center; gap: 0; }
    .ticket-airport { flex: 1; }
    .ticket-airport-label {
      font-size: 7.5px; font-weight: 700; letter-spacing: 2px;
      text-transform: uppercase; color: #9ca3af; margin-bottom: 2px;
    }
    .ticket-iata {
      font-family: Georgia, serif; font-size: 34px; line-height: 1;
      letter-spacing: -2px; font-weight: normal;
    }
    .ticket-iata.from { color: #1f2937; }
    .ticket-iata.to   { color: #CA8A71; }
    .ticket-iata.mystery { color: #CA8A71; letter-spacing: 3px; animation: tickBlink 1.8s ease-in-out infinite; }
    @keyframes tickBlink { 0%,100% { opacity:1; } 50% { opacity:.35; } }
    .ticket-route-mid {
      display: flex; flex-direction: column; align-items: center;
      padding: 0 14px; padding-top: 14px;
    }
    .ticket-route-line {
      width: 52px; height: 1px;
      background: linear-gradient(90deg, #e5e7eb, #CA8A71, #e5e7eb);
      position: relative;
    }
    .ticket-route-plane { font-size: 14px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -60%); }
    .ticket-tear {
      height: 1px;
      background: repeating-linear-gradient(90deg, #e5e7eb 0, #e5e7eb 7px, transparent 7px, transparent 14px);
      margin: 0 -16px; position: relative;
    }
    .ticket-tear::before, .ticket-tear::after {
      content: ''; position: absolute; top: 50%; transform: translateY(-50%);
      width: 14px; height: 14px; border-radius: 50%; background: #EFE9E7;
    }
    .ticket-tear::before { left: -7px; }
    .ticket-tear::after  { right: -7px; }
    .ticket-details { display: flex; gap: 0; }
    .ticket-detail { flex: 1; }
    .ticket-detail + .ticket-detail { border-left: 1px solid #f3f4f6; padding-left: 12px; }
    .ticket-detail-label {
      font-size: 7.5px; font-weight: 700; letter-spacing: 1.5px;
      text-transform: uppercase; color: #9ca3af; margin-bottom: 2px;
    }
    .ticket-detail-value { font-size: 11px; font-weight: 700; color: #1f2937; }
    .ticket-detail-value.accent { color: #CA8A71; }
    .ticket-pax { padding-top: 8px; border-top: 1px dashed #e5e7eb; flex-shrink: 0; }
    .ticket-pax-row { font-size: 9.5px; color: #374151; font-weight: 600; line-height: 1.5; }

    @media (max-width: 480px) {
      .ty-card { padding: 28px 16px; border-radius: 20px; }
      .ticket-iata { font-size: 26px; }
      .ticket-detail + .ticket-detail { padding-left: 8px; }
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

  <!-- BOARDING PASS (ticket style) -->
  <div class="ticket-wrap" id="boardingPass">
    <div class="ticket-header">
      <div class="ticket-header-logo">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo-white.svg" alt="Escapii"
             onerror="this.outerHTML='<span style=\'font-family:Georgia,serif;font-size:14px;color:#fff;\'>escapii.</span>'">
      </div>
      <div class="ticket-header-type">Boarding Pass</div>
    </div>
    <div class="ticket-body">
      <div class="ticket-route">
        <div class="ticket-airport">
          <div class="ticket-airport-label" id="bpl-from">Od</div>
          <div class="ticket-iata from" id="bp-iata-from">—</div>
        </div>
        <div class="ticket-route-mid">
          <div class="ticket-route-line">
            <span class="ticket-route-plane">✈</span>
          </div>
        </div>
        <div class="ticket-airport" style="text-align:right;">
          <div class="ticket-airport-label" id="bpl-to" style="text-align:right;">Do</div>
          <div class="ticket-iata to mystery">???</div>
        </div>
      </div>
      <div class="ticket-tear"></div>
      <div class="ticket-details">
        <div class="ticket-detail">
          <div class="ticket-detail-label" id="bpl-depart">Polazak</div>
          <div class="ticket-detail-value" id="bp-date">—</div>
        </div>
        <div class="ticket-detail">
          <div class="ticket-detail-label" id="bpl-return">Povratak</div>
          <div class="ticket-detail-value" id="bp-return">—</div>
        </div>
        <div class="ticket-detail">
          <div class="ticket-detail-label" id="bpl-ref">Rezervacija</div>
          <div class="ticket-detail-value accent" id="refCode">—</div>
        </div>
      </div>
      <div class="ticket-pax">
        <div class="ticket-pax-row">✈&nbsp;<span id="bp-pax-names">—</span></div>
      </div>
    </div>
  </div>

  <div class="ty-steps">
    <div class="ty-step">
      <div class="ty-step-num">1</div>
      <div class="ty-step-body">
        <div class="ty-step-title">Potvrda na email ✉</div>
        <div class="ty-step-desc">Upravo ti je poslata potvrda upita na email. Provjeri i spam folder ako ne vidiš poruku.</div>
      </div>
    </div>
    <div class="ty-step">
      <div class="ty-step-num">2</div>
      <div class="ty-step-body">
        <div class="ty-step-title">Kontaktiraćemo te u roku od <strong>24h</strong></div>
        <div class="ty-step-desc">Šaljemo ti email sa podacima za uplatu i svim detaljima o sledećim koracima.</div>
      </div>
    </div>
    <div class="ty-step">
      <div class="ty-step-num">3</div>
      <div class="ty-step-body">
        <div class="ty-step-title">Uplata → Rezervacija potvrđena 🎉</div>
        <div class="ty-step-desc">Nakon uplate, rezervacija je zvanično tvoja. Destinacija ostaje misterija sve do aerodroma!</div>
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

// Formatiraj datum iz "2026-04-20" → "20 APR 2026"
const lang = localStorage.getItem('esc-lang') || 'sr';
function fmtDate(iso) {
  if (!iso) return '—';
  const [y, m, d] = iso.split('-');
  const mSr = ['JAN','FEB','MAR','APR','MAJ','JUN','JUL','AVG','SEP','OKT','NOV','DEC'];
  const mEn = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
  const months = lang === 'en' ? mEn : mSr;
  return d + ' ' + (months[parseInt(m, 10) - 1] || m) + ' ' + y;
}

// Typewriter efekat — upisuje karakter po karakter
function typeIn(el, text, charDelay) {
  el.textContent = '';
  let i = 0;
  const tick = () => {
    if (i <= text.length) {
      el.textContent = text.slice(0, i);
      i++;
      setTimeout(tick, charDelay);
    }
  };
  tick();
}

// Airport city helper
const AIRPORT_CITIES = { BEG:'Beograd', INI:'Niš', ZAG:'Zagreb', BUD:'Budimpešta', TIM:'Timișoara' };
function airportCity(iata) { return AIRPORT_CITIES[iata] || iata; }

// Popuni boarding pass
function fillBoardingPass() {
  const airport  = (bp?.airport || '').toUpperCase();
  const date     = fmtDate(bp?.date || '');
  const returnDt = fmtDate(bp?.returnDate || '');
  const ref      = bp?.ref || urlRef;
  const pax      = bp?.name || '—';

  // Pojavi kartu
  const wrap = document.getElementById('boardingPass');
  if (wrap) setTimeout(() => wrap.classList.add('visible'), 200);

  // IATA od — typewriter efekat
  const iataFrom = document.getElementById('bp-iata-from');
  if (iataFrom) setTimeout(() => typeIn(iataFrom, airport || 'BEG', 80), 500);

  // Datum polaska
  setTimeout(() => {
    const dEl = document.getElementById('bp-date');
    if (dEl) typeIn(dEl, date || '—', 40);
  }, 750);

  // Datum povratka
  setTimeout(() => {
    const rEl = document.getElementById('bp-return');
    if (rEl) rEl.textContent = returnDt || '—';
  }, 950);

  // Ref — typewriter
  setTimeout(() => {
    const rc = document.getElementById('refCode');
    if (rc) typeIn(rc, ref || '—', 55);
  }, 1150);

  // Putnici
  setTimeout(() => {
    const paxEl = document.getElementById('bp-pax-names');
    if (paxEl) paxEl.textContent = pax;
  }, 1400);
}

fillBoardingPass();

// ── Prevod na osnovu odabranog jezika
const TY = {
  en: {
    h1:    'Request received!',
    sub:   'We\'ll get back to you within <strong style="color:white">24 hours</strong> with all the details. Your secret trip is waiting!',
    bpFrom:'From', bpTo:'To', bpDepart:'Departure', bpReturn:'Return', bpRef:'Booking',
    s1t:   'Email confirmation ✉',
    s1d:   'A confirmation of your request has just been sent to your email. Check your spam folder if you don\'t see it.',
    s2t:   'We\'ll contact you within <strong>24h</strong>',
    s2d:   'We\'ll send you an email with payment details and all the next steps.',
    s3t:   'Payment → Reservation confirmed 🎉',
    s3d:   'Once payment is received, your reservation is officially yours. The destination remains a mystery until the airport!',
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
  set('bpl-from', tr.bpFrom); set('bpl-to', tr.bpTo);
  set('bpl-depart', tr.bpDepart); set('bpl-return', tr.bpReturn); set('bpl-ref', tr.bpRef);
  const steps = document.querySelectorAll('.ty-step');
  if (steps[0]) { steps[0].querySelector('.ty-step-title').textContent = tr.s1t; steps[0].querySelector('.ty-step-desc').textContent = tr.s1d; }
  if (steps[1]) { steps[1].querySelector('.ty-step-title').innerHTML = tr.s2t; steps[1].querySelector('.ty-step-desc').textContent = tr.s2d; }
  if (steps[2]) { steps[2].querySelector('.ty-step-title').textContent = tr.s3t; steps[2].querySelector('.ty-step-desc').textContent = tr.s3d; }
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
