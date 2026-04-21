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

    /* ── BOARDING PASS ── */
    .bp-wrap {
      display: flex; width: 100%;
      background: #0D2E38;
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
    /* Desna dokument-stub traka */
    .bp-right {
      width: 64px; flex-shrink: 0;
      background: #2D5F6B;
      border-left: 1px solid rgba(255,255,255,.06);
      display: flex; flex-direction: column;
      align-items: center; justify-content: flex-start;
      padding: 14px 10px 10px; gap: 0;
    }
    .bp-doc-dot {
      width: 9px; height: 9px;
      background: var(--gold);
      border-radius: 50%; flex-shrink: 0;
      margin-bottom: 11px;
      opacity: 0; transition: opacity .4s ease;
    }
    .bp-doc-dot.visible { opacity: 1; }
    .bp-doc-lines {
      flex: 1; align-self: stretch;
      display: flex; flex-direction: column;
      justify-content: center; gap: 5px;
      padding: 0 4px;
    }
    .bp-doc-line {
      height: 2.5px; border-radius: 2px;
      background: #7A9FA8;
      opacity: 0; transition: opacity .3s ease;
    }
    .bp-doc-line.visible { opacity: 1; }
    .bp-ref-small {
      font-size: 6.5px; font-weight: 700;
      color: #64748b;
      letter-spacing: .8px; text-transform: uppercase;
      flex-shrink: 0; margin-top: 10px;
      opacity: 0; transition: opacity .6s ease;
      white-space: nowrap;
    }
    .bp-ref-small.visible { opacity: 1; }
    /* Ref badge ispod boarding pass-a */
    .bp-refbadge {
      background: rgba(202,138,113,.08);
      border: 1px solid rgba(202,138,113,.2);
      border-radius: 10px;
      padding: 12px 24px;
      margin-bottom: 28px; margin-top: -20px;
      text-align: center;
      opacity: 0; transition: opacity .5s ease .3s;
    }
    .bp-refbadge.visible { opacity: 1; }
    .bp-refbadge-label {
      font-size: 10px; font-weight: 700; letter-spacing: 1.5px;
      text-transform: uppercase; color: var(--gray);
      margin-bottom: 5px; display: block;
    }
    .bp-refbadge-value {
      font-size: 20px; font-weight: 900; color: #CA8A71;
      letter-spacing: 2px; font-family: 'Courier New', monospace;
    }

    @media (max-width: 560px) {
      .ty-card { padding: 36px 24px; border-radius: 20px; }
      .bp-field { min-width: 55px; }
      .bp-value { font-size: 11px; }
      .bp-right { width: 58px; }
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

  <!-- BOARDING PASS -->
  <div class="bp-wrap" id="boardingPass">
    <div class="bp-left">
      <span class="bp-left-plane">✈</span>
      <span class="bp-left-brand">escapii</span>
    </div>
    <div class="bp-main">
      <div class="bp-row">
        <div class="bp-field" id="bpf-name">
          <span class="bp-label" id="bpl-name">Putnik</span>
          <span class="bp-value" id="bp-name">&nbsp;</span>
        </div>
        <div class="bp-field" id="bpf-date">
          <span class="bp-label" id="bpl-date">Datum polaska</span>
          <span class="bp-value" id="bp-date">&nbsp;</span>
        </div>
        <div class="bp-field" id="bpf-airport">
          <span class="bp-label" id="bpl-airport">Aerodrom</span>
          <span class="bp-value" id="bp-airport">&nbsp;</span>
        </div>
      </div>
      <div class="bp-divider"></div>
      <div class="bp-row">
        <div class="bp-field" id="bpf-flight">
          <span class="bp-label" id="bpl-flight">Broj leta</span>
          <span class="bp-value bp-mystery">???</span>
        </div>
        <div class="bp-field" id="bpf-dest">
          <span class="bp-label" id="bpl-dest">Destinacija</span>
          <span class="bp-value bp-mystery">???</span>
        </div>
      </div>
    </div>
    <div class="bp-right">
      <div class="bp-doc-dot" id="bpDocDot"></div>
      <div class="bp-doc-lines" id="bpDocLines"></div>
      <div class="bp-ref-small" id="bp-ref-small">&nbsp;</div>
    </div>
  </div>

  <!-- REF BADGE ispod boarding pass-a -->
  <div class="bp-refbadge" id="bpRefBadge">
    <span class="bp-refbadge-label" id="bpl-ref">Broj rezervacije</span>
    <span class="bp-refbadge-value" id="refCode">—</span>
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

// Generiši dokument-stub (horizontalne linije + tačka kao na referentnoj slici)
function buildBarcode() {
  const container = document.getElementById('bpDocLines');
  if (!container) return;
  // Širine linija kao % od kontejnera — variraju kao redovi teksta
  const widths = [88, 70, 92, 60, 78, 88, 65, 80, 55, 72, 85, 62, 75, 90];
  widths.forEach((w, i) => {
    const line = document.createElement('div');
    line.className = 'bp-doc-line';
    line.style.width = w + '%';
    line.style.transitionDelay = (i * 70) + 'ms';
    container.appendChild(line);
  });
  // Pojavi tačku i linije kad se ostala polja završe
  setTimeout(() => {
    const dot = document.getElementById('bpDocDot');
    if (dot) dot.classList.add('visible');
    container.querySelectorAll('.bp-doc-line').forEach(l => l.classList.add('visible'));
  }, 2600);
}
buildBarcode();

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
const name    = bp?.name    || '—';
const airport = bp?.airport || '—';
const date    = fmtDate(bp?.date || '');
const ref     = bp?.ref     || urlRef;

// Polja se pojavljuju jedno po jedno sa razmakom 400ms
animField('bpf-name',    document.getElementById('bp-name'),    name,    400,  45);
animField('bpf-date',    document.getElementById('bp-date'),    date,    800,  50);
animField('bpf-airport', document.getElementById('bp-airport'), airport, 1200, 60);
animMystery('bpf-flight', 1700);
animMystery('bpf-dest',   2000);

// Ref badge ispod karte + mali ref u barcodu
setTimeout(() => {
  const rc = document.getElementById('refCode');
  const rb = document.getElementById('bpRefBadge');
  if (rc) rc.textContent = ref || '—';
  if (rb) rb.classList.add('visible');
  const rs = document.getElementById('bp-ref-small');
  if (rs) { rs.textContent = ref || ''; rs.classList.add('visible'); }
}, 2400);

// ── Prevod na osnovu odabranog jezika
const TY = {
  en: {
    h1:        'Request received!',
    sub:       'We\'ll get back to you within <strong style="color:white">24 hours</strong> with all the details. Your secret trip is waiting!',
    refLabel:  'Booking reference',
    bplName:   'Passenger',
    bplDate:   'Departure date',
    bplAirport:'Airport',
    bplFlight: 'Flight no.',
    bplDest:   'Destination',
    s1t:       'Email confirmation ✉',
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
  if (lang !== 'en') return;
  const tr = TY.en;
  document.querySelector('.ty-h1').textContent                      = tr.h1;
  document.querySelector('.ty-sub').innerHTML                       = tr.sub;
  // Boarding pass labele
  const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
  set('bpl-name',    tr.bplName);
  set('bpl-date',    tr.bplDate);
  set('bpl-airport', tr.bplAirport);
  set('bpl-flight',  tr.bplFlight);
  set('bpl-dest',    tr.bplDest);
  set('bpl-ref',     tr.refLabel);
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
