<?php defined('ABSPATH') || exit; ?>
<!DOCTYPE html>
<html lang="sr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Uskoro — Escapii</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --teal-deep:#101f24; --teal:#16313a; --teal-2:#1d3f48;
    --cream:#faf6ee; --paper:#fffdf8;
    --terra:#c8775a; --peach:#e0a183; --peach-soft:#f0c3ae;
    --mute:rgba(255,255,255,.62); --faint:rgba(255,255,255,.36); --line:rgba(255,255,255,.14);
    --display:"Playfair Display",Georgia,serif;
    --sans:"Inter",-apple-system,"Segoe UI",system-ui,sans-serif;
  }
  *{box-sizing:border-box;}
  html,body{height:100%;}
  body{
    margin:0; font-family:var(--sans); color:var(--cream);
    background:
      radial-gradient(120% 90% at 15% -10%, #1f434c 0%, rgba(31,67,76,0) 55%),
      radial-gradient(90% 70% at 88% 112%, rgba(200,119,90,.22) 0%, rgba(16,31,36,0) 60%),
      var(--teal-deep);
  }

  .stage{position:relative; min-height:100vh; width:100%; display:flex;
    flex-direction:column; align-items:center; justify-content:center; padding:40px 32px 40px;}

  /* starfield */
  .stars{position:fixed; inset:0; z-index:0; overflow:hidden; pointer-events:none;}
  .star{position:absolute; width:2px; height:2px; border-radius:50%; background:#fff;
    animation:twinkle 3.6s ease-in-out infinite;}
  @keyframes twinkle{0%,100%{opacity:.15;}50%{opacity:.85;}}

  /* grain */
  .grain{position:fixed; inset:0; z-index:0; opacity:.5; pointer-events:none;
    background-image:radial-gradient(rgba(255,255,255,.045) 1px, transparent 1px); background-size:26px 26px;}

  /* rotating stamp badge */
  .stamp{position:fixed; top:34px; left:34px; width:104px; height:104px; z-index:3;}
  .stamp svg{width:100%; height:100%; animation:spin 22s linear infinite;}
  @keyframes spin{to{transform:rotate(360deg);}}
  .stamp-center{position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
    font-size:20px; color:var(--peach);}

  /* hero */
  .hero{position:relative; z-index:1; display:flex; flex-direction:column;
    align-items:center; width:100%; gap:0;}

  /* logo */
  .hero-logo{
    display:block; width:clamp(180px,32vw,300px); height:auto;
    margin:0 auto 32px; opacity:.95;
    filter:drop-shadow(0 4px 24px rgba(224,161,131,.18));
    animation:fadeUp .9s ease both;
  }
  @keyframes fadeUp{from{opacity:0;transform:translateY(14px);}to{opacity:.95;transform:none;}}

  /* flight route */
  .route-wrap{position:relative; z-index:1; width:min(1000px,90vw); margin-bottom:4px;}
  .route-wrap svg{width:100%; height:auto; display:block; overflow:visible;}
  .route-path{fill:none; stroke:url(#routeGrad); stroke-width:2.5; stroke-linecap:round;
    stroke-dasharray:2 14; animation:dash 1.6s linear infinite;}
  @keyframes dash{to{stroke-dashoffset:-16;}}
  .pin{transform-origin:center;}
  .pin-dep circle.core{fill:var(--peach);}
  .pin-dest .ring{fill:none; stroke:var(--peach-soft); stroke-width:1.4; opacity:.7;
    transform-origin:center; animation:ping 2.4s ease-out infinite;}
  @keyframes ping{0%{transform:scale(.6); opacity:.8;}100%{transform:scale(2.4); opacity:0;}}
  .pin-dest .q{font-family:var(--display); font-style:italic; font-weight:600; font-size:13px; fill:#101f24;}
  .plane-glow{filter:drop-shadow(0 0 8px rgba(224,161,131,.9));}

  /* content */
  .content{position:relative; z-index:2; text-align:center; max-width:600px; margin-top:4px;}
  .pill{display:inline-flex; align-items:center; gap:9px; font-family:var(--sans);
    font-size:11px; font-weight:700; letter-spacing:2.5px; text-transform:uppercase; color:#fbe3d6;
    background:rgba(200,119,90,.18); border:1px solid rgba(200,119,90,.45);
    padding:8px 17px; border-radius:100px; margin-bottom:22px;}
  .pill .dotb{width:6px; height:6px; border-radius:50%; background:var(--peach); animation:twinkle 1.6s ease-in-out infinite;}

  h1{font-family:var(--display); font-weight:600; font-size:clamp(28px,4.6vw,52px); line-height:1.1;
    letter-spacing:-1px; margin:0 0 16px; color:#fff; text-wrap:balance;}
  h1 em{font-style:italic; color:var(--peach-soft);}
  .sub{font-size:16px; line-height:1.7; color:var(--mute); margin:0 auto 30px; max-width:44ch;}

  .ig-btn{display:inline-flex; align-items:center; gap:10px; font-family:var(--sans); font-size:15px; font-weight:600;
    color:#fff; text-decoration:none; padding:15px 30px; border-radius:100px; background:var(--terra);
    box-shadow:0 16px 34px -16px rgba(168,94,68,.8); transition:.2s; margin-bottom:18px;}
  .ig-btn:hover{background:var(--peach); transform:translateY(-2px);}
  .ig-btn svg{width:18px; height:18px;}

  .trust{font-size:12.5px; color:var(--faint); margin:0;}

  @media(max-width:640px){
    .stamp{width:72px; height:72px; top:16px; left:16px;}
    .stage{padding:90px 20px 32px;}
    .hero-logo{margin-bottom:20px;}
    .sub{font-size:15px;}
  }
  @media(prefers-reduced-motion:reduce){
    .star,.stamp svg,.route-path,.pin-dest .ring,.hero-logo{animation:none !important;}
  }
</style>
</head>
<body>
<div class="stage" id="stage">
  <div class="stars" id="stars"></div>
  <div class="grain"></div>

  <div class="stamp">
    <svg viewBox="0 0 100 100">
      <defs>
        <path id="stampCircle" d="M50,50 m-38,0 a38,38 0 1,1 76,0 a38,38 0 1,1 -76,0"></path>
      </defs>
      <circle cx="50" cy="50" r="46" fill="none" stroke="rgba(255,255,255,.16)" stroke-width="1"></circle>
      <circle cx="50" cy="50" r="38" fill="none" stroke="rgba(224,161,131,.5)" stroke-width="1" stroke-dasharray="2 3"></circle>
      <text font-family="Inter, sans-serif" font-size="8.6" font-weight="700" letter-spacing="2.2" fill="rgba(255,255,255,.75)">
        <textPath href="#stampCircle" startOffset="0%">USKORO · NOVA DESTINACIJA · USKORO ·</textPath>
      </text>
    </svg>
    <div class="stamp-center">✦</div>
  </div>

  <div class="hero">

    <img class="hero-logo"
         src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-white.svg'); ?>"
         alt="Escapii" draggable="false">

    <div class="route-wrap">
      <svg viewBox="0 0 1000 200" preserveAspectRatio="xMidYMid meet">
        <defs>
          <linearGradient id="routeGrad" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%"   stop-color="#e0a183" stop-opacity="0"></stop>
            <stop offset="15%"  stop-color="#e0a183" stop-opacity=".9"></stop>
            <stop offset="85%"  stop-color="#e0a183" stop-opacity=".9"></stop>
            <stop offset="100%" stop-color="#e0a183" stop-opacity="0"></stop>
          </linearGradient>
        </defs>

        <path id="flightPath" class="route-path" d="M 60 160 Q 500 10 940 160"></path>

        <g class="pin pin-dep" transform="translate(60,160)">
          <circle r="9" fill="rgba(224,161,131,.18)"></circle>
          <circle class="core" r="4"></circle>
        </g>
        <text x="60" y="182" text-anchor="middle" font-family="Inter, sans-serif" font-size="11" font-weight="600" fill="rgba(255,255,255,.5)" letter-spacing="1">BEG</text>

        <g class="pin pin-dest" transform="translate(940,160)">
          <circle class="ring" r="10"></circle>
          <circle r="15" fill="#faf6ee"></circle>
          <text class="q" x="0" y="5" text-anchor="middle">?</text>
        </g>
        <text x="940" y="128" text-anchor="middle" font-family="Playfair Display, serif" font-style="italic" font-weight="600" font-size="13" fill="#f0c3ae">nepoznato</text>

        <g class="plane-glow">
          <path d="M0,-7 L6,0 L0,7 L1.5,0 Z" fill="#faf6ee" transform="scale(1.6)">
            <animateMotion dur="5.5s" repeatCount="indefinite" rotate="auto" keyPoints="0;1" keyTimes="0;1" calcMode="linear">
              <mpath href="#flightPath"></mpath>
            </animateMotion>
          </path>
        </g>
      </svg>
    </div>

    <div class="content">
      <span class="pill"><span class="dotb"></span>Uskoro</span>
      <h1>Sledeća destinacija?<br><em>Za sada ostaje tajna.</em> ✈️</h1>
      <p class="sub">Escapii uskoro lansira putovanja iznenađenja koja će svaku avanturu učiniti nezaboravnom. Do tada, zapratite nas na Instagramu i budite među prvima koji će otkriti gde vas vodimo.</p>

      <a href="https://instagram.com/escapii" target="_blank" rel="noopener" class="ig-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="2" width="20" height="20" rx="5"></rect>
          <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
          <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
        </svg>
        Prati na Instagramu
      </a>
      <p class="trust">@escapii · prve najave i termin lansiranja</p>
    </div>

  </div>
</div>

<script>
  var stars = document.getElementById('stars');
  for(var i=0;i<70;i++){
    var s = document.createElement('div');
    s.className='star';
    s.style.left = Math.random()*100+'%';
    s.style.top  = Math.random()*100+'%';
    s.style.animationDelay = (Math.random()*3.6)+'s';
    var sz = Math.random()*1.6+1;
    s.style.width=sz+'px'; s.style.height=sz+'px';
    stars.appendChild(s);
  }
</script>
</body>
</html>
