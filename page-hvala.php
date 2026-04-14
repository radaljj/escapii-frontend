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

    @media (max-width: 560px) {
      .ty-card { padding: 36px 24px; border-radius: 20px; }
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

  <div class="ty-ref">
    <div class="ty-ref-label">Broj rezervacije</div>
    <div class="ty-ref-code" id="refCode">—</div>
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
// ── Pročitaj ref iz URL params
const ref = new URLSearchParams(window.location.search).get('ref');
if (ref) document.getElementById('refCode').textContent = ref;

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
  document.querySelector('.ty-ref-label').textContent               = tr.refLabel;
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
