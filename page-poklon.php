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
  <title>Neko ti je poklonio iznenađenje - Escapii</title>
  <?php wp_head(); ?>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    * { -webkit-tap-highlight-color: transparent; }

    html, body {
      min-height: 100vh;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: #0a1e26;
      color: #e8e0d5;
      overflow-x: hidden;
    }

    /* ── Stars canvas ── */
    #starsCanvas { position: fixed; inset: 0; z-index: 0; pointer-events: none; }

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
      border-top-color: #CA8A71;
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
      background: #CA8A71; border: none; color: #fff;
      font-size: 15px; font-weight: 800; font-family: inherit;
      cursor: pointer; transition: all .2s;
    }
    .err-btn:hover { background: #B57560; transform: translateY(-1px); }
    .err-btn:disabled { opacity: .55; cursor: default; transform: none; }

    /* ── Unos koda (kad se stranica otvori bez ?code= u linku) ── */
    #stateEntry {
      display: none; position: relative; z-index: 10;
      min-height: 100vh; align-items: center; justify-content: center;
      flex-direction: column; text-align: center; padding: 40px 24px; gap: 20px;
    }
    .entry-form { display: flex; flex-direction: column; gap: 12px; width: min(360px, 90vw); }
    .entry-input {
      padding: 14px 18px; border-radius: 12px; text-align: center;
      background: rgba(255,255,255,.06); border: 1.5px solid rgba(255,255,255,.16);
      color: #fff; font-size: 16px; font-weight: 700; font-family: inherit;
      letter-spacing: 1.5px; outline: none; transition: border-color .2s;
    }
    .entry-input::placeholder { color: rgba(255,255,255,.3); letter-spacing: 1px; font-weight: 500; }
    .entry-input:focus { border-color: #CA8A71; }
    .entry-msg { font-size: 14px; color: #E4A08A; min-height: 1.2em; }

    /* ── Reveal wrapper ── */
    #stateReveal {
      display: none; position: relative; z-index: 10;
      min-height: 100vh; padding: 100px 20px 80px;
    }
    .bp-reveal-wrap { max-width: 840px; margin: 0 auto; }

    /* ── Active badge ── */
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

    /* ── Boarding pass card ── */
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

    .bp-msg { background: #fff; border: 1px solid #ebe1cf; border-left: 3px solid #a85e44; border-radius: 10px; padding: 12px 16px; overflow: hidden; }
    .bp-msg-k { font-size: 9px; letter-spacing: 2px; text-transform: uppercase; color: #a89888; font-weight: 700; margin-bottom: 6px; }
    .bp-msg-text { font-family: Georgia, serif; font-style: italic; font-size: 14px; color: #2b231b; line-height: 1.5; word-break: break-word; overflow-wrap: break-word; white-space: normal; }
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
    .bp-code-wrap { background: #231b14; border: 1px solid #5a4535; border-radius: 8px; padding: 12px 8px; margin-bottom: 18px; text-align: center; }
    .bp-code-text {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      font-size: 13px; font-weight: 700; letter-spacing: 3.5px; display: block;
      color: #ffffff;
    }
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

    /* ── Confetti ── */
    .confetti-piece {
      position: fixed; width: 8px; height: 8px; border-radius: 2px;
      animation: confettiFall linear forwards;
      pointer-events: none; z-index: 5;
    }
    @keyframes confettiFall {
      0%   { transform: translateY(-20px) rotate(0deg); opacity: 1; }
      100% { transform: translateY(110vh) rotate(720deg); opacity: 0; }
    }

    /* ── Keyframes ── */
    @keyframes fadeUp   { from { opacity:0; transform:translateY(18px); } to { opacity:1; transform:none; } }
    @keyframes fadeDown { from { opacity:0; transform:translateY(-12px); } to { opacity:1; transform:none; } }

    /* ── Mobile ── */
    @media (max-width: 640px) {
      #stateReveal { padding: 80px 16px 60px; }
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

<canvas id="starsCanvas"></canvas>
<div class="bg-glow"></div>

<!-- STATE: LOADING -->
<div id="stateLoading">
  <div class="spinner"></div>
  <div class="loading-txt">Proveravamo tvoj poklon...</div>
</div>

<!-- STATE: ERROR -->
<div id="stateError">
  <div class="err-icon">🔍</div>
  <div class="err-title" id="errTitle">Vaučer nije pronađen</div>
  <div class="err-sub" id="errSub">Kod nije validan, nije aktivan ili je već iskorišćen.</div>
  <button class="err-btn" onclick="window.location.href='<?php echo esc_js($site_url); ?>/pokloni-putovanje-iznenadjenja'">
    Pogledaj poklon opcije
  </button>
</div>

<!-- STATE: UNOS KODA (stranica otvorena bez ?code= u linku) -->
<div id="stateEntry">
  <div class="err-icon">🎁</div>
  <div class="err-title">Iskoristi poklon</div>
  <div class="err-sub">Unesi kod sa vaučera pa ti pokažemo koliko iznosi.</div>
  <form class="entry-form" id="entryForm" novalidate>
    <input class="entry-input" id="entryCode" type="text"
           placeholder="ESC-XXXX-XXXX-XXXX" autocomplete="off"
           spellcheck="false" maxlength="24" aria-label="Vaučer kod">
    <button class="err-btn" type="submit" id="entryBtn">Proveri kod</button>
  </form>
  <div class="entry-msg" id="entryMsg"></div>
</div>

<!-- STATE: REVEAL -->
<div id="stateReveal">
  <div class="bp-reveal-wrap" id="bpRevealContent"></div>
</div>

<script>
const API_BASE = '<?php echo esc_js(escapii_api_url()); ?>';
const SITE_URL = '<?php echo esc_js($site_url); ?>';
const THEME_URI = '<?php echo esc_js($theme_uri); ?>';

// ── Stars ─────────────────────────────────────────────────────────────────────
(function() {
  const canvas = document.getElementById('starsCanvas');
  const ctx    = canvas.getContext('2d');
  let stars    = [];
  function resize() { canvas.width = window.innerWidth; canvas.height = window.innerHeight; }
  function initStars() {
    stars = Array.from({ length: 120 }, () => ({
      x: Math.random() * canvas.width, y: Math.random() * canvas.height,
      r: Math.random() * 1.4 + .3, a: Math.random(), speed: Math.random() * .003 + .001
    }));
  }
  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    stars.forEach(s => {
      s.a = Math.abs(Math.sin(Date.now() * s.speed));
      ctx.beginPath(); ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(255,255,255,${s.a * .6})`; ctx.fill();
    });
    requestAnimationFrame(draw);
  }
  resize(); initStars(); draw();
  window.addEventListener('resize', () => { resize(); initStars(); });
})();

// ── Confetti ──────────────────────────────────────────────────────────────────
function launchConfetti() {
  const colors = ['#CA8A71','#d4a83c','#BFD8DE','#ffffff','#f6c89f','#e8e0d5'];
  for (let i = 0; i < 60; i++) {
    setTimeout(() => {
      const el = document.createElement('div');
      el.className = 'confetti-piece';
      el.style.left = Math.random() * 100 + 'vw';
      el.style.background = colors[Math.floor(Math.random() * colors.length)];
      el.style.width  = (6 + Math.random() * 8) + 'px';
      el.style.height = (6 + Math.random() * 8) + 'px';
      el.style.animationDuration = (2.5 + Math.random() * 2) + 's';
      el.style.animationDelay = '0s';
      document.body.appendChild(el);
      setTimeout(() => el.remove(), 5000);
    }, i * 50);
  }
}

// ── Helpers ───────────────────────────────────────────────────────────────────
function _esc(s) {
  if (s == null) return '';
  return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

const _AMOUNT_WORDS = {
  50:'pedeset evra', 100:'sto evra', 150:'sto pedeset evra', 200:'dvesta evra',
  250:'dvesta pedeset evra', 300:'trista evra', 400:'četiristo evra',
  500:'petsto evra', 600:'šeststo evra', 750:'sedamsto pedeset evra', 1000:'hiljadu evra'
};

function _fmtDate(iso) {
  if (!iso) return '-';
  return new Date(iso).toLocaleDateString('sr-RS', { day:'2-digit', month:'2-digit', year:'numeric' });
}

// ── Boarding pass render ───────────────────────────────────────────────────────
function _renderRevealCard(container, code, d) {
  const amount = Math.round(d.amount);
  const words  = _AMOUNT_WORDS[amount] || (amount + ' evra');
  const msgHtml = d.giftMessage ? `
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
              <div class="bp-iata">???</div>
              <div class="bp-city">Polazak</div>
              <div class="bp-cap">Aerodrom po tvom izboru</div>
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

        <div class="bp-perf"></div>

        <div class="bp-stub">
          <div class="bp-stub-head">BOARDING PASS · <b>GIFT</b></div>
          <div class="bp-stub-k">Vrednost</div>
          <div class="bp-stub-amount">${amount}<span class="bp-cur"> €</span></div>
          <div class="bp-stub-k">Vaučer kod</div>
          <div class="bp-code-wrap">
            <span class="bp-code-text">${_esc(code)}</span>
          </div>
          <div class="bp-stub-info">
            Unesi kod pri rezervaciji - cena se automatski umanjuje za <strong>${amount}€</strong>.<br><br>
            Važi do: <strong>${_fmtDate(d.expiresAt)}</strong>
          </div>
          <div class="bp-stub-scan">escapii.rs · unesi kod pri rezervaciji</div>
        </div>
      </div>
    </div>

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
          <a href="${SITE_URL}/#esc-booking" class="bp-how-btn">Zatraži termin koji ti odgovara →</a>
        </div>
      </div>
      <div class="bp-how-info">
        <div class="bp-info-item">✓ Važi <strong>godinu dana od aktivacije</strong> - do ${_fmtDate(d.expiresAt)}</div>
        <div class="bp-info-item">✓ Unosi se u booking formi pri rezervaciji putovanja</div>
        <div class="bp-info-item">✓ Važi za bilo koji termin i bilo koji aerodrom polaska</div>
        <div class="bp-info-item">✓ Pitanja? <a href="mailto:info@escapii.rs">info@escapii.rs</a></div>
      </div>
    </div>`;

  setTimeout(() => {
    const card = document.getElementById('bpCardEl');
    if (card) card.classList.add('bp-float');
  }, 950);
}

function _renderRevealError(container, msg) {
  document.getElementById('stateReveal').style.display = 'none';
  document.getElementById('errTitle').textContent = 'Vaučer nije pronađen';
  document.getElementById('errSub').textContent   = msg || 'Kod nije validan, nije aktivan ili je već iskorišćen.';
  document.getElementById('stateError').style.display = 'flex';
}

// ── Show/hide states ──────────────────────────────────────────────────────────
function show(state) {
  document.getElementById('stateLoading').style.display = state === 'loading' ? 'flex'  : 'none';
  document.getElementById('stateError').style.display   = state === 'error'   ? 'flex'  : 'none';
  document.getElementById('stateEntry').style.display   = state === 'entry'   ? 'flex'  : 'none';
  document.getElementById('stateReveal').style.display  = state === 'reveal'  ? 'block' : 'none';
}

/**
 * Otkriva vaučer po kodu. Koriste je oba ulaza: link/QR sa ?code= u adresi
 * i ručni unos u formi. Pri ručnom unosu greška se ispisuje pored polja da
 * korisnik može odmah da ispravi kod - kod linka nema šta da se ispravlja,
 * pa se prikazuje puna poruka o grešci.
 */
async function revealCode(code, { inline = false } = {}) {
  const msg = document.getElementById('entryMsg');
  const btn = document.getElementById('entryBtn');

  const fail = (title, sub) => {
    if (inline) {
      msg.textContent = sub;
      btn.disabled = false;
      btn.textContent = 'Proveri kod';
      show('entry');
    } else {
      document.getElementById('errTitle').textContent = title;
      document.getElementById('errSub').textContent   = sub;
      show('error');
    }
  };

  if (!inline) show('loading');

  try {
    const res  = await fetch(`${API_BASE}/api/gifts/vouchers/reveal?code=${encodeURIComponent(code)}`);
    const data = await res.json();

    if (!data.valid) {
      fail('Vaučer nije aktivan',
           data.message || 'Vaučer kod nije validan, nije još aktiviran ili je već iskorišćen.');
      return;
    }

    show('reveal');
    _renderRevealCard(document.getElementById('bpRevealContent'), code, data);
    setTimeout(launchConfetti, 600);

  } catch (e) {
    fail('Greška pri učitavanju', 'Pokušaj ponovo za nekoliko sekundi.');
  }
}

// ── Init ──────────────────────────────────────────────────────────────────────
function init() {
  const params = new URLSearchParams(window.location.search);
  const code   = (params.get('code') || params.get('k') || '').trim().toUpperCase();

  // Bez koda u adresi - ponudi unos umesto poruke o grešci
  if (!code) {
    show('entry');
    document.getElementById('entryCode').focus();
    return;
  }

  revealCode(code);
}

document.getElementById('entryForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const input = document.getElementById('entryCode');
  const msg   = document.getElementById('entryMsg');
  const btn   = document.getElementById('entryBtn');
  const code  = input.value.trim().toUpperCase();

  msg.textContent = '';
  if (!code) {
    msg.textContent = 'Unesi kod sa vaučera.';
    input.focus();
    return;
  }

  btn.disabled = true;
  btn.textContent = 'Proveravamo...';
  revealCode(code, { inline: true });
});

document.addEventListener('DOMContentLoaded', init);
</script>

<?php include get_template_directory() . '/inc/footer.php'; ?>
<?php wp_footer(); ?>
</body>
</html>
