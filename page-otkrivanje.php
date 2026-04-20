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
    :root {
      --navy:  #080d1a;
      --navy2: #0d1b38;
      --gold:  #f97316;
      --gold2: #ea6d0e;
      --white: #f1f5f9;
      --gray:  #94a3b8;
      --green: #22c55e;
    }
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: var(--navy); color: var(--white);
      min-height: 100vh; display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      padding: 40px 24px;
    }

    /* ── LOGO ── */
    .rv-logo {
      position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
      text-decoration: none; z-index: 10; display: inline-flex; align-items: center;
    }
    .rv-logo img { height: 32px; width: auto; display: block; }
    @media (max-width: 560px) { .rv-logo img { height: 26px; } }

    /* ── CARD ── */
    .rv-card {
      position: relative; z-index: 1;
      max-width: 520px; width: 100%;
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

    /* ── LOADING ── */
    .rv-loading {
      display: flex; flex-direction: column;
      align-items: center; gap: 20px;
    }
    .rv-spinner {
      width: 48px; height: 48px;
      border: 3px solid rgba(249,115,22,.2);
      border-top-color: var(--gold);
      border-radius: 50%;
      animation: spin .8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .rv-loading-text {
      font-size: 15px; color: var(--gray); line-height: 1.6;
    }

    /* ── ERROR ── */
    .rv-error { display: none; }
    .rv-error-icon {
      font-size: 52px; margin-bottom: 20px;
    }
    .rv-error-title {
      font-size: 22px; font-weight: 800; margin-bottom: 12px; color: var(--white);
    }
    .rv-error-msg {
      font-size: 15px; color: var(--gray); line-height: 1.65; margin-bottom: 28px;
    }

    /* ── SUCCESS ── */
    .rv-success { display: none; }

    /* ─── ENVELOPE PLACEHOLDER ───────────────────────────────────────────────
       Ova sekcija će biti zamijenjena animacijom koverte kada dizajn stigne.
       Trenutno prikazuje jednostavan placeholder sa ikonom i destinacijom.
    ──────────────────────────────────────────────────────────────────────── */
    .rv-envelope-placeholder {
      margin: 0 0 32px;
      padding: 40px 24px;
      background: rgba(249,115,22,.06);
      border: 2px dashed rgba(249,115,22,.25);
      border-radius: 20px;
      /* TODO: zamijeniti animacijom koverte */
    }
    .rv-envelope-icon {
      font-size: 64px; display: block; margin-bottom: 12px;
      animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
      0%,100% { transform: translateY(0); }
      50%      { transform: translateY(-8px); }
    }
    .rv-envelope-label {
      font-size: 11px; font-weight: 700; letter-spacing: 2px;
      text-transform: uppercase; color: var(--gray); margin-bottom: 10px;
    }

    /* Destinacija — glavni tekst */
    .rv-destination {
      font-size: clamp(32px, 8vw, 52px);
      font-weight: 900; letter-spacing: -1.5px;
      color: var(--gold);
      margin-bottom: 6px;
      opacity: 0;
      animation: popIn .7s .3s cubic-bezier(.34,1.56,.64,1) both;
    }
    @keyframes popIn {
      from { opacity:0; transform:scale(.6); }
      to   { opacity:1; transform:scale(1); }
    }

    .rv-meta {
      display: flex; flex-direction: column; gap: 12px;
      margin: 24px 0 32px; text-align: left;
    }
    .rv-meta-row {
      display: flex; align-items: center; gap: 14px;
      padding: 12px 16px;
      background: rgba(255,255,255,.04);
      border: 1px solid rgba(255,255,255,.07);
      border-radius: 12px;
      opacity: 0; transform: translateY(10px);
      transition: opacity .4s ease, transform .4s ease;
    }
    .rv-meta-row.visible { opacity: 1; transform: none; }
    .rv-meta-icon { font-size: 18px; flex-shrink: 0; }
    .rv-meta-label {
      font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
      text-transform: uppercase; color: var(--gray); margin-bottom: 2px;
    }
    .rv-meta-value {
      font-size: 14px; font-weight: 700; color: var(--white);
    }

    /* ── CTA dugme ── */
    .rv-btn {
      display: inline-block;
      background: var(--gold); color: var(--navy);
      border: none; padding: 15px 40px;
      border-radius: 100px; font-size: 15px; font-weight: 800;
      cursor: pointer; text-decoration: none;
      transition: all .2s; box-shadow: 0 8px 28px rgba(249,115,22,.35);
    }
    .rv-btn:hover {
      background: var(--gold2); transform: translateY(-2px);
      box-shadow: 0 12px 36px rgba(249,115,22,.45);
    }

    /* ── CONFETTI CANVAS ── */
    #rv-confetti {
      position: fixed; inset: 0; pointer-events: none; z-index: 0;
    }

    @media (max-width: 560px) {
      .rv-card { padding: 36px 24px; border-radius: 20px; }
    }
  </style>
</head>
<body>

<canvas id="rv-confetti"></canvas>
<a href="/" class="rv-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Escapii"></a>

<div class="rv-card">

  <!-- LOADING stanje -->
  <div class="rv-loading" id="rvLoading">
    <div class="rv-spinner"></div>
    <div class="rv-loading-text" id="rvLoadingText">Otvaramo kovertu...</div>
  </div>

  <!-- ERROR stanje -->
  <div class="rv-error" id="rvError">
    <div class="rv-error-icon" id="rvErrorIcon">🔒</div>
    <div class="rv-error-title" id="rvErrorTitle">Link nije validan</div>
    <div class="rv-error-msg" id="rvErrorMsg">Ovaj link nije ispravan ili je već istekao.</div>
    <a href="/" class="rv-btn" id="rvErrorBtn">← Nazad na početnu</a>
  </div>

  <!-- SUCCESS stanje -->
  <div class="rv-success" id="rvSuccess">

    <!-- ─── ENVELOPE PLACEHOLDER ───────────────────────────────────────────
         Zamijeniti animacijom koverte. API odgovor je dostupan u window.rvData.
         Polja: destination, firstName, departureDate, bookingRef
    ──────────────────────────────────────────────────────────────────── -->
    <div class="rv-envelope-placeholder" id="rvEnvelopePlaceholder">
      <span class="rv-envelope-icon">✉</span>
      <div class="rv-envelope-label" id="rvLabelDest">Tvoja destinacija je</div>
      <div class="rv-destination" id="rvDestination"></div>
    </div>

    <!-- Detalji putovanja -->
    <div class="rv-meta">
      <div class="rv-meta-row" id="rvMetaName">
        <span class="rv-meta-icon">👤</span>
        <div>
          <div class="rv-meta-label" id="rvLabelName">Putnik</div>
          <div class="rv-meta-value" id="rvName"></div>
        </div>
      </div>
      <div class="rv-meta-row" id="rvMetaDate">
        <span class="rv-meta-icon">📅</span>
        <div>
          <div class="rv-meta-label" id="rvLabelDate">Datum polaska</div>
          <div class="rv-meta-value" id="rvDate"></div>
        </div>
      </div>
      <div class="rv-meta-row" id="rvMetaRef">
        <span class="rv-meta-icon">🎫</span>
        <div>
          <div class="rv-meta-label" id="rvLabelRef">Broj rezervacije</div>
          <div class="rv-meta-value" id="rvRef"></div>
        </div>
      </div>
    </div>

    <a href="/" class="rv-btn" id="rvSuccessBtn">← Nazad na početnu</a>
  </div>

</div>

<script>
const API = 'https://escapii-backend.onrender.com';
const lang = localStorage.getItem('esc-lang') || 'sr';

// ── Prijevodi ─────────────────────────────────────────────────────────────
const T = {
  sr: {
    loading:      'Otvaramo kovertu...',
    labelDest:    'Tvoja destinacija je',
    labelName:    'Putnik',
    labelDate:    'Datum polaska',
    labelRef:     'Broj rezervacije',
    btnHome:      '← Nazad na početnu',
    errInvalid:   'Link nije validan',
    errInvalidMsg:'Ovaj link nije ispravan ili je istekao.',
    errExpired:   'Link je istekao',
    errExpiredMsg:'Tvoje putovanje je već počelo. Srećan put! ✈',
    errForbidden: 'Destinacija nije dostupna',
    errForbiddenMsg: 'Rezervacija nije potvrđena ili destinacija još nije unesena.',
    errGeneric:   'Nešto je pošlo po krivu',
    errGenericMsg:'Pokušaj ponovo ili nas kontaktiraj.',
  },
  en: {
    loading:      'Opening the envelope...',
    labelDest:    'Your destination is',
    labelName:    'Passenger',
    labelDate:    'Departure date',
    labelRef:     'Booking reference',
    btnHome:      '← Back to home',
    errInvalid:   'Link is not valid',
    errInvalidMsg:'This link is invalid or has expired.',
    errExpired:   'Link has expired',
    errExpiredMsg:'Your trip has already started. Have a great journey! ✈',
    errForbidden: 'Destination not available',
    errForbiddenMsg: 'Booking is not confirmed or destination has not been assigned yet.',
    errGeneric:   'Something went wrong',
    errGenericMsg:'Please try again or contact us.',
  }
};
const tr = T[lang] || T.sr;

// Postavi prijevode
document.getElementById('rvLoadingText').textContent  = tr.loading;
document.getElementById('rvLabelDest').textContent    = tr.labelDest;
document.getElementById('rvLabelName').textContent    = tr.labelName;
document.getElementById('rvLabelDate').textContent    = tr.labelDate;
document.getElementById('rvLabelRef').textContent     = tr.labelRef;
document.getElementById('rvErrorBtn').textContent     = tr.btnHome;
document.getElementById('rvSuccessBtn').textContent   = tr.btnHome;

// ── Datum formatter ───────────────────────────────────────────────────────
function fmtDate(iso) {
  if (!iso) return '—';
  const [y, m, d] = iso.split('-');
  const mSr = ['JAN','FEB','MAR','APR','MAJ','JUN','JUL','AVG','SEP','OKT','NOV','DEC'];
  const mEn = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
  const months = lang === 'en' ? mEn : mSr;
  return d + '. ' + (months[parseInt(m, 10) - 1] || m) + ' ' + y + '.';
}

// ── Prikaži error ─────────────────────────────────────────────────────────
function showError(status) {
  document.getElementById('rvLoading').style.display = 'none';
  const el = document.getElementById('rvError');
  el.style.display = 'block';

  if (status === 410) {
    document.getElementById('rvErrorIcon').textContent  = '✈';
    document.getElementById('rvErrorTitle').textContent = tr.errExpired;
    document.getElementById('rvErrorMsg').textContent   = tr.errExpiredMsg;
  } else if (status === 403) {
    document.getElementById('rvErrorIcon').textContent  = '⏳';
    document.getElementById('rvErrorTitle').textContent = tr.errForbidden;
    document.getElementById('rvErrorMsg').textContent   = tr.errForbiddenMsg;
  } else if (status === 404) {
    document.getElementById('rvErrorIcon').textContent  = '🔒';
    document.getElementById('rvErrorTitle').textContent = tr.errInvalid;
    document.getElementById('rvErrorMsg').textContent   = tr.errInvalidMsg;
  } else {
    document.getElementById('rvErrorIcon').textContent  = '⚠️';
    document.getElementById('rvErrorTitle').textContent = tr.errGeneric;
    document.getElementById('rvErrorMsg').textContent   = tr.errGenericMsg;
  }
}

// ── Prikaži uspjeh ────────────────────────────────────────────────────────
function showSuccess(data) {
  document.getElementById('rvLoading').style.display = 'none';
  document.getElementById('rvSuccess').style.display = 'block';

  // Dostupno globalno za animaciju koverte koja dolazi
  window.rvData = data;

  document.getElementById('rvDestination').textContent = data.destination;
  document.getElementById('rvName').textContent        = data.firstName;
  document.getElementById('rvDate').textContent        = fmtDate(data.departureDate);
  document.getElementById('rvRef').textContent         = data.bookingRef;

  // Meta redovi se pojavljuju jedan po jedan
  setTimeout(() => document.getElementById('rvMetaName').classList.add('visible'), 400);
  setTimeout(() => document.getElementById('rvMetaDate').classList.add('visible'), 650);
  setTimeout(() => document.getElementById('rvMetaRef').classList.add('visible'),  900);

  launchConfetti();
}

// ── Dohvati destinaciju ───────────────────────────────────────────────────
(async function init() {
  const token = new URLSearchParams(window.location.search).get('token');

  if (!token) { showError(404); return; }

  try {
    const res = await fetch(`${API}/api/reveal?token=${encodeURIComponent(token)}`);
    if (!res.ok) { showError(res.status); return; }
    const data = await res.json();
    showSuccess(data);
  } catch (e) {
    showError(0);
  }
})();

// ── Confetti ──────────────────────────────────────────────────────────────
function launchConfetti() {
  const canvas = document.getElementById('rv-confetti');
  const ctx = canvas.getContext('2d');
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  });
  const colors = ['#f97316','#f59e0b','#22c55e','#2dd4bf','#a78bfa','#f1f5f9'];
  const pieces = Array.from({ length: 150 }, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height - canvas.height,
    w: Math.random() * 10 + 5, h: Math.random() * 5 + 3,
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
      ctx.save(); ctx.globalAlpha = p.opacity;
      ctx.translate(p.x, p.y); ctx.rotate(p.rot);
      ctx.fillStyle = p.color;
      ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
      ctx.restore();
      p.y += p.speed; p.x += p.drift; p.rot += p.rotSpeed;
      if (p.y > canvas.height + 20) { p.y = -20; p.x = Math.random() * canvas.width; }
    });
    frame++;
    if (frame < 350) requestAnimationFrame(draw);
    else ctx.clearRect(0, 0, canvas.width, canvas.height);
  }
  draw();
}
</script>

<?php wp_footer(); ?>
</body>
</html>
