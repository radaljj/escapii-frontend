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
      --navy:   #080d1a;
      --navy2:  #0d1b38;
      --gold:   #f97316;
      --gold2:  #ea6d0e;
      --white:  #f1f5f9;
      --gray:   #94a3b8;
      --green:  #22c55e;
      --teal:   #2dd4bf;
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
      border: 1px solid rgba(255,255,255,.08);
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
      background: rgba(249,115,22,.1);
      border: 1px solid rgba(249,115,22,.25);
      border-radius: 14px;
      padding: 18px 24px;
      margin-bottom: 36px;
    }
    .ty-ref-label {
      font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
      text-transform: uppercase; color: var(--gray); margin-bottom: 6px;
    }
    .ty-ref-code {
      font-size: 24px; font-weight: 900; color: #f59e0b;
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
      border-bottom: 1px solid rgba(255,255,255,.06);
    }
    .ty-step:last-child { border-bottom: none; }
    .ty-step-num {
      flex-shrink: 0;
      width: 28px; height: 28px; border-radius: 50%;
      background: rgba(249,115,22,.15);
      border: 1px solid rgba(249,115,22,.3);
      display: flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 800; color: var(--gold);
      margin-top: 1px;
    }
    .ty-step-body {}
    .ty-step-title {
      font-size: 14px; font-weight: 700; color: var(--white); margin-bottom: 2px;
    }
    .ty-step-desc { font-size: 13px; color: var(--gray); line-height: 1.5; }
    .ty-step-desc strong { color: rgba(255,255,255,.75); }

    /* ── BUTTON ── */
    .ty-btn {
      display: inline-block;
      background: var(--gold); color: var(--navy);
      border: none; padding: 15px 40px;
      border-radius: 100px; font-size: 15px; font-weight: 800;
      cursor: pointer; text-decoration: none;
      transition: all .2s; box-shadow: 0 8px 28px rgba(249,115,22,.35);
    }
    .ty-btn:hover { background: var(--gold2); transform: translateY(-2px); box-shadow: 0 12px 36px rgba(249,115,22,.45); }

    /* ── LOGO ── */
    .ty-logo {
      position: fixed; top: 24px; left: 50%; transform: translateX(-50%);
      font-size: 22px; font-weight: 900; letter-spacing: -0.5px;
      text-decoration: none; color: white; z-index: 10;
    }
    .ty-logo span { color: var(--gold); }

    /* ── INSTAGRAM ── */
    .ty-ig {
      margin-top: 24px; font-size: 13px; color: var(--gray);
    }
    .ty-ig a { color: var(--gold); text-decoration: none; font-weight: 600; }
    .ty-ig a:hover { text-decoration: underline; }

    /* ── BOARDING PASS ── */
    .bp-wrap {
      display: flex; width: 100%;
      background: #0a1628;
      border: 1px solid rgba(255,255,255,.1);
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 36px;
      box-shadow: 0 8px 32px rgba(0,0,0,.5);
    }
    /* Lijeva narandžasta traka */
    .bp-left {
      background: var(--gold);
      width: 52px; flex-shrink: 0;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      padding: 20px 0; gap: 8px;
    }
    .bp-left-plane {
      font-size: 20px; color: #fff; transform: rotate(45deg);
      display: block;
    }
    .bp-left-brand {
      writing-mode: vertical-rl; transform: rotate(180deg);
      font-size: 10px; font-weight: 900; color: rgba(255,255,255,.85);
      letter-spacing: 2px; text-transform: uppercase;
    }
    /* Srednji sadržaj */
    .bp-main {
      flex: 1; padding: 20px 20px 16px; min-width: 0;
    }
    .bp-row {
      display: flex; gap: 4px; flex-wrap: wrap;
    }
    .bp-field {
      flex: 1; min-width: 70px;
      padding: 6px 8px;
      opacity: 0; transform: translateY(8px);
      transition: opacity .35s ease, transform .35s ease;
    }
    .bp-field.visible {
      opacity: 1; transform: none;
    }
    .bp-label {
      display: block;
      font-size: 9px; font-weight: 700; letter-spacing: 1.2px;
      text-transform: uppercase; color: rgba(255,255,255,.38);
      margin-bottom: 5px;
    }
    .bp-value {
      display: block;
      font-size: 13px; font-weight: 800; color: #fff;
      letter-spacing: .3px; min-height: 18px;
      font-family: 'Courier New', monospace;
    }
    .bp-value.bp-mystery {
      color: var(--gold); letter-spacing: 3px;
      animation: bpBlink 1.8s ease-in-out infinite;
    }
    @keyframes bpBlink {
      0%,100% { opacity: 1; } 50% { opacity: .4; }
    }
    /* Tačkasta linija razdjelnica */
    .bp-divider {
      height: 1px; margin: 12px 0;
      background: repeating-linear-gradient(90deg, rgba(255,255,255,.15) 0, rgba(255,255,255,.15) 6px, transparent 6px, transparent 12px);
    }
    /* Desna barcode traka */
    .bp-right {
      width: 44px; flex-shrink: 0;
      background: rgba(255,255,255,.03);
      border-left: 1px solid rgba(255,255,255,.08);
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      padding: 16px 6px; gap: 10px;
    }
    .bp-barcode {
      display: flex; gap: 2px; height: 72px; align-items: flex-end;
    }
    .bp-barcode span {
      display: block; width: 2px; background: rgba(255,255,255,.5);
      border-radius: 1px;
    }
    .bp-ref-small {
      writing-mode: vertical-rl;
      font-size: 8px; font-weight: 700; color: rgba(255,255,255,.25);
      letter-spacing: 1px; text-transform: uppercase;
      opacity: 0; transition: opacity .5s ease;
    }
    .bp-ref-small.visible { opacity: 1; }

    @media (max-width: 560px) {
      .ty-card { padding: 36px 24px; border-radius: 20px; }
      .bp-field { min-width: 60px; }
      .bp-value { font-size: 11px; }
    }
  </style>
</head>
<body>

<canvas id="confetti-canvas"></canvas>

<a href="/" class="ty-logo">Escap<span>ii</span></a>

<div class="ty-card">

  <div class="ty-icon">✓</div>

  <h1 class="ty-h1">Upit je primljen!</h1>
  <p class="ty-sub">Javićemo ti se u roku od <strong style="color:white">24 sata</strong> sa svim detaljima. Tvoje tajno putovanje te čeka!</p>

  <!-- BOARDING PASS -->
  <div class="bp-wrap" id="boardingPass">
    <div class="bp-left">
      <span class="bp-left-plane">✈</span>
      <span class="bp-left-brand">escapii</span>
    </div>
    <div class="bp-main">
      <div class="bp-row">
        <div class="bp-field" id="bpf-name">
          <span class="bp-label">Putnik</span>
          <span class="bp-value" id="bp-name">&nbsp;</span>
        </div>
        <div class="bp-field" id="bpf-ref">
          <span class="bp-label">Rezervacija</span>
          <span class="bp-value" id="bp-ref">&nbsp;</span>
        </div>
        <div class="bp-field" id="bpf-date">
          <span class="bp-label">Datum</span>
          <span class="bp-value" id="bp-date">&nbsp;</span>
        </div>
        <div class="bp-field" id="bpf-airport">
          <span class="bp-label">Aerodrom</span>
          <span class="bp-value" id="bp-airport">&nbsp;</span>
        </div>
      </div>
      <div class="bp-divider"></div>
      <div class="bp-row">
        <div class="bp-field" id="bpf-flight">
          <span class="bp-label">Broj leta</span>
          <span class="bp-value bp-mystery">???</span>
        </div>
        <div class="bp-field" id="bpf-dest">
          <span class="bp-label">Destinacija</span>
          <span class="bp-value bp-mystery">???</span>
        </div>
      </div>
    </div>
    <div class="bp-right">
      <div class="bp-barcode" id="bpBarcode"></div>
      <div class="bp-ref-small" id="bp-ref-small">&nbsp;</div>
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
function fmtDate(iso) {
  if (!iso) return '—';
  const [y, m, d] = iso.split('-');
  const months = ['JAN','FEB','MAR','APR','MAJ','JUN','JUL','AVG','SEP','OKT','NOV','DEC'];
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

// Generiši nasumični barcode
function buildBarcode() {
  const bar = document.getElementById('bpBarcode');
  if (!bar) return;
  const heights = [28,48,36,60,32,52,24,56,40,44,30,62,38,50,26,58,34,46,42,54];
  bar.innerHTML = heights.map(h =>
    `<span style="height:${h}px;opacity:${0.3 + Math.random()*0.6}"></span>`
  ).join('');
}

// Animiraj jedno polje — pojavi ga, pa typewriter
function animField(fieldId, valueEl, text, delay, charDelay) {
  setTimeout(() => {
    const field = document.getElementById(fieldId);
    if (field) field.classList.add('visible');
    if (valueEl) typeIn(valueEl, text, charDelay);
  }, delay);
}

// Pojavi "???" polja (ne trebaju typewriter, već samo fade in)
function animMystery(fieldId, delay) {
  setTimeout(() => {
    const field = document.getElementById(fieldId);
    if (field) field.classList.add('visible');
  }, delay);
}

// Pokreni boarding pass animaciju
buildBarcode();

const name    = bp?.name    || urlRef || '—';
const airport = bp?.airport || '—';
const date    = fmtDate(bp?.date || '');
const ref     = bp?.ref     || urlRef;

// Polja se pojavljuju jedno po jedno sa razmakom 350ms
animField('bpf-name',    document.getElementById('bp-name'),    name,    400,  45);
animField('bpf-ref',     document.getElementById('bp-ref'),     ref,     800,  40);
animField('bpf-date',    document.getElementById('bp-date'),    date,    1200, 50);
animField('bpf-airport', document.getElementById('bp-airport'), airport, 1600, 60);
animMystery('bpf-flight', 2100);
animMystery('bpf-dest',   2400);

// Barcode ref
setTimeout(() => {
  const rs = document.getElementById('bp-ref-small');
  if (rs) { rs.textContent = ref; rs.classList.add('visible'); }
}, 2600);

// ── Prevod na osnovu odabranog jezika
const TY = {
  en: {
    h1:      'Request received!',
    sub:     'We\'ll get back to you within <strong style="color:white">24 hours</strong> with all the details. Your secret trip is waiting!',
    refLabel:'Booking reference number',
    s1t:     'Email confirmation ✉',
    s1d:     'A confirmation of your request has just been sent to your email. Check your spam folder if you don\'t see it.',
    s2t:     'We\'ll contact you within <strong>24h</strong>',
    s2d:     'We\'ll send you an email with payment details and all the next steps.',
    s3t:     'Payment → Reservation confirmed 🎉',
    s3d:     'Once payment is received, your reservation is officially yours. The destination remains a mystery until the airport!',
    btn:     '← Back to home',
    ig:      'Follow us on Instagram for sneak peeks →',
  }
};

(function applyLang() {
  const lang = localStorage.getItem('esc-lang') || 'sr';
  if (lang !== 'en') return;
  const tr = TY.en;
  document.querySelector('.ty-h1').textContent                      = tr.h1;
  document.querySelector('.ty-sub').innerHTML                       = tr.sub;
  // boarding pass labels se ne prevode (kratice su iste)
  const steps = document.querySelectorAll('.ty-step');
  steps[0].querySelector('.ty-step-title').textContent              = tr.s1t;
  steps[0].querySelector('.ty-step-desc').textContent               = tr.s1d;
  steps[1].querySelector('.ty-step-title').innerHTML                = tr.s2t;
  steps[1].querySelector('.ty-step-desc').textContent               = tr.s2d;
  steps[2].querySelector('.ty-step-title').textContent              = tr.s3t;
  steps[2].querySelector('.ty-step-desc').textContent               = tr.s3d;
  document.querySelector('.ty-btn').textContent                     = tr.btn;
  document.querySelector('.ty-ig').innerHTML                        =
    tr.ig + ' <a href="https://www.instagram.com/escapii.rs?igsh=NmMwY3djcHFncjg2&utm_source=qr" target="_blank" rel="noopener">@escapii.rs</a>';
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
