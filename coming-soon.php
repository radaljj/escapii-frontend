<?php defined('ABSPATH') || exit; ?>
<!DOCTYPE html>
<html lang="sr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Escapii — Uskoro</title>
<link href="https://api.fontshare.com/v2/css?f[]=chillax@500,600&display=swap" rel="stylesheet">
<style>
  :root {
    --evergreen: #041F1E;
    --jet: #1E2D2F;
    --peach: #F7DBA7;
    --tangerine: #F1AB86;
    --cinnamon: #C57B57;
    --cream: #FAF7F2;
  }
  * { margin: 0; padding: 0; box-sizing: border-box; }
  html, body { height: 100%; }
  body {
    font-family: 'Chillax', 'Poppins', -apple-system, 'Segoe UI', sans-serif;
    background: radial-gradient(ellipse at 50% 20%, #0A2B29 0%, var(--evergreen) 55%, #021413 100%);
    color: var(--cream);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 48px 24px;
    overflow-x: hidden;
    position: relative;
  }

  .star {
    position: absolute;
    border-radius: 50%;
    background: rgba(250, 247, 242, 0.55);
    animation: twinkle 4s ease-in-out infinite;
  }
  @keyframes twinkle {
    0%, 100% { opacity: .15; }
    50%       { opacity: .7; }
  }

  .logo-img {
    width: min(300px, 62vw);
    height: auto;
    margin-bottom: 56px;
    position: relative;
  }

  /* flight path */
  .flight {
    width: min(520px, 92vw);
    margin-bottom: 48px;
    position: relative;
  }
  .flight svg { width: 100%; height: auto; display: block; overflow: visible; }

  .airport-label {
    font-family: inherit;
    font-size: 15px;
    font-weight: 500;
    letter-spacing: .24em;
    fill: var(--peach);
    opacity: .85;
  }

  .trail {
    fill: none;
    stroke: #F1AB86;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-dasharray: 100;
    stroke-dashoffset: 100;
    opacity: .38;
    animation: trailDraw 5.5s ease-in infinite;
  }
  @keyframes trailDraw {
    0%   { stroke-dashoffset: 100; opacity: .38; }
    90%  { opacity: .38; }
    96%  { stroke-dashoffset: 0; opacity: 0; }
    100% { stroke-dashoffset: 0; opacity: 0; }
  }

  .plane {
    offset-path: path('M 46 70 C 150 12, 340 4, 461 64');
    offset-rotate: auto;
    animation: fly 5.5s ease-in infinite;
  }
  @keyframes fly {
    0%   { offset-distance: 0%;   opacity: 1; }
    92%  { offset-distance: 92%;  opacity: 1; }
    96%  { offset-distance: 96%;  opacity: 0; }
    100% { offset-distance: 100%; opacity: 0; }
  }

  .pin-orange {
    opacity: 0;
    animation: pinFlash 5.5s ease-in infinite;
  }
  @keyframes pinFlash {
    0%, 93%    { opacity: 0; }
    96%, 100%  { opacity: 1; }
  }

  /* badge */
  .badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    border: 1px solid rgba(241, 171, 134, .45);
    border-radius: 999px;
    padding: 10px 26px;
    letter-spacing: .3em;
    font-size: 13px;
    font-weight: 500;
    color: var(--peach);
    margin-bottom: 40px;
    background: rgba(30, 45, 47, .5);
  }
  .badge::before {
    content: "";
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--tangerine);
  }

  h1 {
    font-size: clamp(2rem, 7.5vw, 3.2rem);
    font-weight: 600;
    line-height: 1.15;
    letter-spacing: -0.01em;
    margin-bottom: 28px;
  }
  h1 .tajna { color: var(--tangerine); }

  .body-copy {
    max-width: 560px;
    font-size: clamp(1rem, 3.6vw, 1.15rem);
    line-height: 1.65;
    color: var(--cream);
    font-weight: 500;
    margin-bottom: 14px;
  }
  .body-copy strong { color: var(--peach); font-weight: 600; }

  .punchline {
    max-width: 560px;
    font-size: clamp(1rem, 3.6vw, 1.15rem);
    line-height: 1.6;
    color: var(--cream);
    font-weight: 600;
    margin-bottom: 44px;
  }

  .cta {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(120deg, var(--cinnamon), var(--tangerine));
    color: #23120A;
    font-family: inherit;
    font-size: 1.05rem;
    font-weight: 600;
    text-decoration: none;
    border-radius: 999px;
    padding: 18px 42px;
    transition: transform .18s ease, box-shadow .18s ease;
    box-shadow: 0 10px 34px rgba(197, 123, 87, .35);
  }
  .cta:hover { transform: translateY(-2px); box-shadow: 0 14px 40px rgba(197, 123, 87, .45); }
  .cta:focus-visible { outline: 3px solid var(--peach); outline-offset: 3px; }
  .cta svg { width: 22px; height: 22px; }

  @media (prefers-reduced-motion: reduce) {
    .star, .plane, .trail, .pin-orange { animation: none !important; }
    .trail { stroke-dashoffset: 0; }
  }
</style>
</head>
<body>

<script>
  for (let i = 0; i < 46; i++) {
    const s = document.createElement('div');
    s.className = 'star';
    const size = Math.random() * 2.2 + 1;
    s.style.width = size + 'px';
    s.style.height = size + 'px';
    s.style.left = Math.random() * 100 + 'vw';
    s.style.top  = Math.random() * 100 + 'vh';
    s.style.animationDelay = (Math.random() * 4) + 's';
    document.body.appendChild(s);
  }
</script>

<img class="logo-img"
     src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-white.svg'); ?>"
     alt="Escapii" draggable="false">

<div class="flight" aria-hidden="true">
  <svg viewBox="0 0 520 100">
    <path id="trail" class="trail" d="M 46 70 C 150 12, 340 4, 461 64" pathLength="100"/>

    <!-- departure pin -->
    <circle cx="42" cy="74" r="6.5" fill="#C57B57"/>
    <text x="24" y="97" class="airport-label">BEG</text>

    <!-- destination pin — dark (always visible) -->
    <g opacity=".92">
      <circle cx="465" cy="68" r="16" fill="#0A2B29"/>
      <circle cx="465" cy="68" r="16" fill="none" stroke="#F7DBA7" stroke-width="1.5" opacity=".55"/>
      <text x="465" y="74" text-anchor="middle"
            font-family="Georgia,serif" font-style="italic" font-size="16" font-weight="700"
            fill="#FAF7F2">?</text>
    </g>

    <!-- destination pin — orange flash on arrival -->
    <g class="pin-orange">
      <circle cx="465" cy="68" r="16" fill="#C57B57"/>
      <text x="465" y="74" text-anchor="middle"
            font-family="Georgia,serif" font-style="italic" font-size="16" font-weight="700"
            fill="#FAF7F2">?</text>
    </g>

    <!-- plane travelling along path -->
    <g class="plane">
      <g transform="rotate(90)">
        <path transform="translate(-12,-12)" fill="#FAF7F2"
              d="M21.5 15.5v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5V8.5l-8 5v2l8-2.5v5.5l-2 1.5v1.5l3.5-1 3.5 1V20l-2-1.5V13l8 2.5z"/>
      </g>
    </g>
  </svg>
</div>

<div class="badge">USKORO</div>

<h1>
  Sledeća destinacija?<br>
  <span class="tajna">Za sada ostaje tajna. ✈️</span>
</h1>

<p class="body-copy">
  Vikend putovanja iznenađenja po Evropi. Let i hotel uključeni.
  Destinaciju znamo samo mi, i nećemo ti je otkriti čak i ako nas lepo zamoliš.
</p>

<p class="punchline">
  Saznačeš je tačno 48h pre polaska. Ni minut ranije.
</p>

<a href="https://www.instagram.com/escapii.rs/" target="_blank" rel="noopener" class="cta">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <rect x="2" y="2" width="20" height="20" rx="5.5"/>
    <circle cx="12" cy="12" r="4.5"/>
    <circle cx="17.6" cy="6.4" r="1.3" fill="currentColor" stroke="none"/>
  </svg>
  Prati nas na Instagramu
</a>

</body>
</html>
