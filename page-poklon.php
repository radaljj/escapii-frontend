<?php
/**
 * Template Name: Poklon Reveal
 * Stranica na kojoj primalac aktivira/vidi gift vaučer.
 * URL: /poklon?code=ESC-XXXX-XXXX-XXXX  (staro: ?k=, podrzano za kompatibilnost)
 */
$theme_uri = get_template_directory_uri();
$site_url  = get_site_url();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Neko ti je poklonio iznenađenje — Escapii</title>
  <?php wp_head(); ?>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    * { -webkit-tap-highlight-color: transparent; }

    :root {
      --accent:  #CA8A71;
      --accent2: #B57560;
      --gold:    #d4a83c;
    }

    html, body {
      min-height: 100vh;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: #0a1e26;
      color: #e8e0d5;
      overflow-x: hidden;
    }

    /* ── Stars canvas ── */
    #starsCanvas {
      position: fixed; inset: 0; z-index: 0; pointer-events: none;
    }

    /* ── Glow ── */
    .bg-glow {
      position: fixed; left: 50%; top: 40%;
      transform: translate(-50%, -50%);
      width: 700px; height: 500px;
      background: radial-gradient(ellipse, rgba(202,138,113,.07) 0%, transparent 70%);
      pointer-events: none; z-index: 0;
    }

    /* ── Logo ── */
    .top-logo {
      position: fixed; top: 24px; left: 50%;
      transform: translateX(-50%); z-index: 10;
      opacity: 0; animation: fadeDown .7s ease .2s both;
    }
    .top-logo img { height: 22px; width: auto; }

    /* ── Loading ── */
    #stateLoading {
      position: relative; z-index: 10;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      min-height: 100vh; gap: 20px;
    }
    .spinner {
      width: 44px; height: 44px;
      border: 2.5px solid rgba(202,138,113,.15);
      border-top-color: var(--accent);
      border-radius: 50%;
      animation: spin .85s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .loading-txt { font-size: 14px; color: rgba(255,255,255,.35); letter-spacing: .5px; }

    /* ── Error ── */
    #stateError {
      display: none; position: relative; z-index: 10;
      min-height: 100vh; align-items: center; justify-content: center;
      flex-direction: column; text-align: center; padding: 40px 24px; gap: 20px;
    }
    .err-icon { font-size: 48px; margin-bottom: 8px; }
    .err-title { font-size: 22px; font-weight: 800; color: rgba(255,255,255,.85); }
    .err-sub { font-size: 15px; color: rgba(255,255,255,.45); max-width: 380px; line-height: 1.65; }
    .err-btn {
      margin-top: 8px; padding: 14px 32px; border-radius: 12px;
      background: var(--accent); border: none; color: #fff;
      font-size: 15px; font-weight: 800; font-family: inherit;
      cursor: pointer; transition: all .2s;
    }
    .err-btn:hover { background: var(--accent2); transform: translateY(-1px); }

    /* ── Main reveal ── */
    #stateReveal {
      display: none; position: relative; z-index: 10;
      min-height: 100vh; align-items: center; justify-content: center;
      flex-direction: column; padding: 100px 24px 60px;
    }

    .reveal-wrap {
      max-width: 520px; width: 100%; text-align: center;
    }

    /* Gift box animation */
    .gift-box {
      font-size: 80px; margin-bottom: 8px;
      display: inline-block;
      animation: giftPop .8s .4s cubic-bezier(.34,1.56,.64,1) both;
    }
    @keyframes giftPop {
      from { opacity:0; transform: scale(.3) rotate(-15deg); }
      to   { opacity:1; transform: scale(1) rotate(0); }
    }

    .reveal-eyebrow {
      font-size: 12px; font-weight: 800; letter-spacing: 1.8px;
      text-transform: uppercase; color: var(--accent);
      margin-bottom: 16px;
      opacity: 0; animation: fadeUp .7s .9s ease both;
    }

    .reveal-h1 {
      font-size: clamp(28px, 5vw, 44px); font-weight: 900;
      color: #ffffff; letter-spacing: -1.5px; line-height: 1.1;
      margin-bottom: 12px;
      opacity: 0; animation: fadeUp .7s 1s ease both;
    }
    .reveal-h1 em { color: var(--accent); font-style: normal; }

    .reveal-from {
      font-size: 15px; color: rgba(255,255,255,.5); margin-bottom: 36px;
      opacity: 0; animation: fadeUp .7s 1.1s ease both;
    }
    .reveal-from strong { color: rgba(255,255,255,.8); }

    /* Amount card */
    .amount-card {
      background: rgba(255,255,255,.04); border: 1px solid rgba(202,138,113,.3);
      border-radius: 20px; padding: 28px 32px; margin-bottom: 28px;
      opacity: 0; animation: fadeUp .7s 1.2s ease both;
    }
    .amount-label {
      font-size: 11px; font-weight: 800; letter-spacing: 1.2px;
      text-transform: uppercase; color: rgba(255,255,255,.35);
      margin-bottom: 8px;
    }
    .amount-value {
      font-size: clamp(40px, 8vw, 60px); font-weight: 900;
      color: var(--accent); letter-spacing: -2px; line-height: 1;
      margin-bottom: 8px;
    }
    .amount-desc { font-size: 13px; color: rgba(255,255,255,.4); line-height: 1.55; }

    /* Gift message */
    .gift-message-wrap {
      background: rgba(202,138,113,.06); border-left: 3px solid var(--accent);
      border-radius: 0 12px 12px 0; padding: 16px 20px;
      margin-bottom: 28px; text-align: left;
      opacity: 0; animation: fadeUp .7s 1.3s ease both;
    }
    .gift-message-label {
      font-size: 11px; font-weight: 800; letter-spacing: 1px;
      text-transform: uppercase; color: var(--accent);
      margin-bottom: 8px;
    }
    .gift-message-text {
      font-size: 15px; color: rgba(255,255,255,.75);
      line-height: 1.65; font-style: italic;
    }

    /* Code block */
    .code-wrap {
      background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.08);
      border-radius: 14px; padding: 18px 24px; margin-bottom: 28px;
      opacity: 0; animation: fadeUp .7s 1.35s ease both;
    }
    .code-label {
      font-size: 11px; font-weight: 800; letter-spacing: 1px;
      text-transform: uppercase; color: rgba(255,255,255,.3);
      margin-bottom: 10px;
    }
    .code-value {
      font-size: 22px; font-weight: 700; letter-spacing: 3px;
      color: var(--accent); font-family: monospace;
      margin-bottom: 8px;
    }
    .code-hint { font-size: 12px; color: rgba(255,255,255,.3); line-height: 1.55; }

    /* How to use */
    .how-wrap {
      background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06);
      border-radius: 14px; padding: 20px 24px; margin-bottom: 32px;
      text-align: left;
      opacity: 0; animation: fadeUp .7s 1.4s ease both;
    }
    .how-title {
      font-size: 12px; font-weight: 800; letter-spacing: .8px;
      text-transform: uppercase; color: rgba(255,255,255,.35);
      margin-bottom: 14px;
    }
    .how-steps { display: flex; flex-direction: column; gap: 10px; }
    .how-step {
      display: flex; align-items: flex-start; gap: 12px;
      font-size: 13px; color: rgba(255,255,255,.6); line-height: 1.5;
    }
    .how-step-num {
      width: 22px; height: 22px; border-radius: 50%;
      background: rgba(202,138,113,.15); border: 1px solid rgba(202,138,113,.3);
      color: var(--accent); font-size: 11px; font-weight: 800;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; margin-top: 1px;
    }

    /* Expiry */
    .expiry-note {
      font-size: 12px; color: rgba(255,255,255,.25);
      margin-bottom: 28px;
      opacity: 0; animation: fadeUp .7s 1.45s ease both;
    }

    /* CTA */
    .reveal-cta {
      width: 100%;
      padding: 16px 24px; border-radius: 14px;
      background: var(--accent); border: none; color: #fff;
      font-size: 16px; font-weight: 800; font-family: inherit;
      cursor: pointer; transition: all .22s; letter-spacing: .3px;
      opacity: 0; animation: fadeUp .7s 1.5s ease both;
    }
    .reveal-cta:hover { background: var(--accent2); transform: translateY(-2px); box-shadow: 0 10px 32px rgba(202,138,113,.35); }

    /* ── Keyframes ── */
    @keyframes fadeUp   { from { opacity:0; transform:translateY(18px); } to { opacity:1; transform:none; } }
    @keyframes fadeDown { from { opacity:0; transform:translateY(-12px); } to { opacity:1; transform:none; } }

    /* ── Confetti particles ── */
    .confetti-piece {
      position: fixed; width: 8px; height: 8px; border-radius: 2px;
      animation: confettiFall linear forwards;
      pointer-events: none; z-index: 5;
    }
    @keyframes confettiFall {
      0%   { transform: translateY(-20px) rotate(0deg); opacity: 1; }
      100% { transform: translateY(110vh) rotate(720deg); opacity: 0; }
    }
  </style>
</head>
<body>

<canvas id="starsCanvas"></canvas>
<div class="bg-glow"></div>

<a href="<?php echo esc_url($site_url); ?>/" class="top-logo">
  <img src="<?php echo $theme_uri; ?>/images/logo-white.svg" alt="Escapii">
</a>

<!-- STATE: LOADING -->
<div id="stateLoading">
  <div class="spinner"></div>
  <div class="loading-txt" id="loadingTxt">Proveravamo tvoj poklon...</div>
</div>

<!-- STATE: ERROR -->
<div id="stateError">
  <div class="err-icon">🔍</div>
  <div class="err-title" id="errTitle">Vaučer nije pronađen</div>
  <div class="err-sub" id="errSub">Kod nije validan, nije aktivan ili je već iskorišćen. Proveri da li si uneo ispravan kod.</div>
  <button class="err-btn" onclick="window.location.href='<?php echo esc_js($site_url); ?>/pokloni-putovanje-iznenadjenja'">
    Pogledaj poklon opcije
  </button>
</div>

<!-- STATE: REVEAL -->
<div id="stateReveal">
  <div class="reveal-wrap">
    <div class="gift-box">🎁</div>
    <div class="reveal-eyebrow" id="revealEyebrow">Poklon iznenađenje</div>
    <h1 class="reveal-h1">
      Čestitamo, <em id="revealName">prijatelju</em>!
    </h1>
    <p class="reveal-from">Dobio/la si poklon od <strong id="revealFrom">nekoga posebnog</strong></p>

    <!-- Iznos -->
    <div class="amount-card">
      <div class="amount-label">Vrednost vaučera</div>
      <div class="amount-value" id="revealAmount">—</div>
      <div class="amount-desc">
        Ovaj vaučer možeš iskoristiti za bilo koje Escapii iznenađenje putovanje.<br>
        Sva naša putovanja počinju od <strong style="color:rgba(255,255,255,.65);">279€ po osobi</strong>.
      </div>
    </div>

    <!-- Poruka -->
    <div class="gift-message-wrap" id="revealMsgWrap" style="display:none;">
      <div class="gift-message-label">Poruka za tebe</div>
      <div class="gift-message-text" id="revealMsg"></div>
    </div>

    <!-- Kod -->
    <div class="code-wrap">
      <div class="code-label">Tvoj vaučer kod</div>
      <div class="code-value" id="revealCode">—</div>
      <div class="code-hint">Sačuvaj ovaj kod — trebaće ti pri rezervaciji putovanja.</div>
    </div>

    <!-- Kako koristiti -->
    <div class="how-wrap">
      <div class="how-title">Kako iskoristiti vaučer</div>
      <div class="how-steps">
        <div class="how-step">
          <div class="how-step-num">1</div>
          <span>Poseti <strong style="color:rgba(255,255,255,.8);">escapii.rs</strong> i pronađi termin koji ti odgovara</span>
        </div>
        <div class="how-step">
          <div class="how-step-num">2</div>
          <span>Popuni booking formu i u polje za vaučer kod unesi gore prikazani kod</span>
        </div>
        <div class="how-step">
          <div class="how-step-num">3</div>
          <span>Cena putovanja biće umanjena za iznos vaučera — ti plaćaš samo razliku</span>
        </div>
      </div>
    </div>

    <!-- Isteklo -->
    <div class="expiry-note" id="revealExpiry"></div>

    <!-- CTA -->
    <button class="reveal-cta" onclick="window.location.href='<?php echo esc_js($site_url); ?>/'">
      ✈️ Rezerviši putovanje sada →
    </button>
  </div>
</div>

<script>
const API_BASE  = '<?php echo esc_js(escapii_api_url()); ?>';
const SITE_URL  = '<?php echo esc_js($site_url); ?>';
const lang      = localStorage.getItem('esc-lang') || 'sr';
const isSr      = lang === 'sr';

// ── Stars background ─────────────────────────────────────────────────────────
(function() {
  const canvas = document.getElementById('starsCanvas');
  const ctx    = canvas.getContext('2d');
  let stars    = [];

  function resize() {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  function initStars() {
    stars = Array.from({ length: 120 }, () => ({
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      r: Math.random() * 1.4 + .3,
      a: Math.random(),
      speed: Math.random() * .003 + .001
    }));
  }

  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    stars.forEach(s => {
      s.a = Math.abs(Math.sin(Date.now() * s.speed));
      ctx.beginPath();
      ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(255,255,255,${s.a * .6})`;
      ctx.fill();
    });
    requestAnimationFrame(draw);
  }

  resize();
  initStars();
  draw();
  window.addEventListener('resize', () => { resize(); initStars(); });
})();

// ── Confetti ─────────────────────────────────────────────────────────────────
function launchConfetti() {
  const colors = ['#CA8A71','#d4a83c','#BFD8DE','#ffffff','#f6c89f','#e8e0d5'];
  for (let i = 0; i < 60; i++) {
    setTimeout(() => {
      const el = document.createElement('div');
      el.className = 'confetti-piece';
      el.style.left     = Math.random() * 100 + 'vw';
      el.style.background = colors[Math.floor(Math.random() * colors.length)];
      el.style.width    = (6 + Math.random() * 8) + 'px';
      el.style.height   = (6 + Math.random() * 8) + 'px';
      el.style.animationDuration = (2.5 + Math.random() * 2) + 's';
      el.style.animationDelay   = '0s';
      document.body.appendChild(el);
      setTimeout(() => el.remove(), 5000);
    }, i * 50);
  }
}

// ── Format date ──────────────────────────────────────────────────────────────
function fmtDate(iso) {
  if (!iso) return '';
  const d = new Date(iso);
  return d.toLocaleDateString(isSr ? 'sr-Latn-RS' : 'en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
}

// ── Show states ──────────────────────────────────────────────────────────────
function show(state) {
  document.getElementById('stateLoading').style.display = state === 'loading' ? 'flex' : 'none';
  document.getElementById('stateError').style.display   = state === 'error'   ? 'flex' : 'none';
  document.getElementById('stateReveal').style.display  = state === 'reveal'  ? 'flex' : 'none';
}

// ── Main logic ───────────────────────────────────────────────────────────────
async function init() {
  const params = new URLSearchParams(window.location.search);
  const code   = (params.get('code') || params.get('k') || '').trim().toUpperCase();

  if (!code) {
    document.getElementById('errTitle').textContent = isSr ? 'Kod nije pronađen' : 'No code provided';
    document.getElementById('errSub').textContent   = isSr
      ? 'Otvori link koji si dobio/la u email poruci.'
      : 'Please open the link you received via email.';
    show('error');
    return;
  }

  document.getElementById('loadingTxt').textContent = isSr
    ? 'Proveravamo tvoj poklon...'
    : 'Checking your gift...';
  show('loading');

  try {
    const res  = await fetch(`${API_BASE}/api/gifts/vouchers/reveal?code=${encodeURIComponent(code)}`);
    const data = await res.json();

    if (!data.valid) {
      document.getElementById('errTitle').textContent = isSr ? 'Vaučer nije aktivan' : 'Voucher not active';
      document.getElementById('errSub').textContent   = isSr
        ? 'Vaučer kod nije validan, nije još aktiviran ili je već iskorišćen.'
        : 'This voucher code is not valid, not yet activated, or has already been used.';
      show('error');
      return;
    }

    // Popuni reveal
    const recipientName = data.recipientName || (isSr ? 'prijatelju' : 'friend');
    const buyerName     = data.buyerName     || (isSr ? 'nekoga posebnog' : 'someone special');

    document.getElementById('revealName').textContent  = recipientName;
    document.getElementById('revealFrom').textContent  = buyerName;
    document.getElementById('revealAmount').textContent = data.amount + ' EUR';
    document.getElementById('revealCode').textContent  = code;

    if (data.giftMessage) {
      document.getElementById('revealMsg').textContent = '„' + data.giftMessage + '"';
      document.getElementById('revealMsgWrap').style.display = 'block';
    }

    if (data.expiresAt) {
      document.getElementById('revealExpiry').textContent = (isSr ? 'Vaučer važi do: ' : 'Voucher valid until: ') + fmtDate(data.expiresAt);
    }

    document.getElementById('revealEyebrow').textContent = isSr ? '🎁 Poklon iznenađenje' : '🎁 Gift surprise';

    show('reveal');
    setTimeout(launchConfetti, 600);

  } catch (e) {
    document.getElementById('errTitle').textContent = isSr ? 'Greška pri učitavanju' : 'Loading error';
    document.getElementById('errSub').textContent   = isSr
      ? 'Pokušaj ponovo za nekoliko sekundi.'
      : 'Please try again in a few seconds.';
    show('error');
  }
}

document.addEventListener('DOMContentLoaded', init);
</script>

<?php wp_footer(); ?>
</body>
</html>
