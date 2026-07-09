<?php defined('ABSPATH') || exit; ?>
<!DOCTYPE html>
<html lang="sr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Uskoro — Escapii</title>
<style>
  :root{
    --teal-deep:#101f24;
    --cream:#faf6ee;
    --terra:#c8775a; --peach:#e0a183; --peach-soft:#f0c3ae;
    --mute:rgba(255,255,255,.60); --faint:rgba(255,255,255,.32);
    --sans:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  html,body{height:100%;}
  body{
    font-family:var(--sans); color:var(--cream); overflow-x:hidden;
    background:#101f24;
  }

  /* ── Aurora background blobs ─────────────────────── */
  .aurora{position:fixed;inset:0;z-index:0;overflow:hidden;pointer-events:none;}
  .blob{position:absolute;border-radius:50%;filter:blur(80px);opacity:0;
    animation:blobPulse 10s ease-in-out infinite;}
  .blob-1{width:70vw;height:60vw;top:-20%;left:-15%;
    background:radial-gradient(circle,rgba(31,67,76,.85) 0%,transparent 70%);
    animation-delay:0s;}
  .blob-2{width:60vw;height:55vw;bottom:-15%;right:-10%;
    background:radial-gradient(circle,rgba(200,119,90,.18) 0%,transparent 70%);
    animation-delay:-4s;}
  .blob-3{width:40vw;height:40vw;top:30%;left:40%;
    background:radial-gradient(circle,rgba(26,55,65,.6) 0%,transparent 70%);
    animation-delay:-7s;}
  @keyframes blobPulse{
    0%,100%{opacity:1;transform:scale(1) translate(0,0);}
    33%{opacity:.8;transform:scale(1.05) translate(2%,-2%);}
    66%{opacity:.9;transform:scale(.97) translate(-1%,1%);}
  }

  /* ── Grain ───────────────────────────────────────── */
  .grain{position:fixed;inset:0;z-index:0;opacity:.45;pointer-events:none;
    background-image:radial-gradient(rgba(255,255,255,.05) 1px,transparent 1px);
    background-size:26px 26px;}

  /* ── Stars ───────────────────────────────────────── */
  .stars{position:fixed;inset:0;z-index:0;overflow:hidden;pointer-events:none;}
  .star{position:absolute;border-radius:50%;background:#fff;animation:twinkle var(--dur,3.6s) ease-in-out infinite;}
  .star.big{background:radial-gradient(circle,#fff 0%,rgba(224,161,131,.4) 60%,transparent 100%);
    box-shadow:0 0 6px 2px rgba(224,161,131,.3);}
  @keyframes twinkle{0%,100%{opacity:.12;}50%{opacity:var(--peak,.8);}}

  /* ── Stage ───────────────────────────────────────── */
  .stage{position:relative;z-index:1;min-height:100vh;display:flex;
    flex-direction:column;align-items:center;justify-content:center;
    padding:60px 24px 48px;gap:0;}

  /* ── Logo ────────────────────────────────────────── */
  .hero-logo{
    display:block;width:clamp(200px,30vw,320px);height:auto;
    margin:0 auto 36px;
    filter:drop-shadow(0 8px 32px rgba(224,161,131,.22));
    animation:logoIn 1s cubic-bezier(.22,1,.36,1) both,logoFloat 7s ease-in-out 1s infinite;
  }
  @keyframes logoIn{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
  @keyframes logoFloat{0%,100%{transform:translateY(0);}50%{transform:translateY(-7px);}}

  /* ── Route SVG ───────────────────────────────────── */
  .route-wrap{width:min(920px,88vw);margin-bottom:8px;
    animation:fadeUp .9s .3s cubic-bezier(.22,1,.36,1) both;}
  .route-wrap svg{width:100%;height:auto;display:block;overflow:visible;}
  .route-path{fill:none;stroke:url(#rg);stroke-width:2;stroke-linecap:round;
    stroke-dasharray:2 12;animation:dash 1.4s linear infinite;}
  @keyframes dash{to{stroke-dashoffset:-14;}}
  .pin-dep circle.core{fill:var(--peach);}
  .pin-dep .halo{fill:none;stroke:var(--peach);stroke-width:1;opacity:0;
    transform-origin:center;animation:halopulse 2.8s ease-out 1.2s infinite;}
  @keyframes halopulse{0%{opacity:.7;transform:scale(.5);}100%{opacity:0;transform:scale(2.8);}}
  .pin-dest .ring{fill:none;stroke:var(--peach-soft);stroke-width:1.4;opacity:.75;
    transform-origin:center;animation:ping 2.4s ease-out infinite;}
  @keyframes ping{0%{transform:scale(.5);opacity:.8;}100%{transform:scale(2.6);opacity:0;}}
  .pin-dest .qmark{font-family:Georgia,serif;font-style:italic;font-weight:700;font-size:14px;fill:#101f24;}
  .plane-g{filter:drop-shadow(0 0 10px rgba(224,161,131,.95));}

  /* ── Content ─────────────────────────────────────── */
  .content{text-align:center;max-width:580px;animation:fadeUp .9s .5s cubic-bezier(.22,1,.36,1) both;}
  @keyframes fadeUp{from{opacity:0;transform:translateY(18px);}to{opacity:1;transform:none;}}

  .pill{
    display:inline-flex;align-items:center;gap:8px;
    font-family:var(--sans);font-size:10px;font-weight:700;
    letter-spacing:3px;text-transform:uppercase;color:var(--peach-soft);
    background:rgba(200,119,90,.14);border:1px solid rgba(200,119,90,.4);
    padding:7px 16px;border-radius:100px;margin-bottom:24px;
  }
  .dot{width:5px;height:5px;border-radius:50%;background:var(--peach);
    animation:twinkle 1.6s ease-in-out infinite;}

  h1{
    font-family:var(--sans);font-weight:800;
    font-size:clamp(30px,4.8vw,56px);line-height:1.08;
    letter-spacing:-1.5px;margin-bottom:18px;color:#fff;
    text-wrap:balance;
  }
  h1 .accent{
    background:linear-gradient(135deg,var(--peach-soft) 0%,var(--peach) 50%,var(--terra) 100%);
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
    font-style:italic;
  }

  .sub{
    font-size:16px;line-height:1.72;color:var(--mute);
    margin:0 auto 32px;max-width:42ch;
  }

  /* ── CTA Button ──────────────────────────────────── */
  .ig-btn{
    display:inline-flex;align-items:center;gap:11px;
    font-family:var(--sans);font-size:15px;font-weight:700;
    color:#fff;text-decoration:none;
    padding:15px 32px;border-radius:100px;
    background:linear-gradient(135deg,var(--terra) 0%,#b5624a 100%);
    box-shadow:0 0 0 0 rgba(200,119,90,0),0 16px 40px -12px rgba(168,94,68,.65);
    transition:transform .22s,box-shadow .22s;
    animation:btnPop .6s 1.1s cubic-bezier(.34,1.56,.64,1) both;
    margin-bottom:20px;
  }
  @keyframes btnPop{from{opacity:0;transform:scale(.88);}to{opacity:1;transform:scale(1);}}
  .ig-btn:hover{
    transform:translateY(-3px) scale(1.02);
    box-shadow:0 0 0 6px rgba(200,119,90,.15),0 22px 48px -10px rgba(168,94,68,.7);
  }
  .ig-btn svg{width:18px;height:18px;flex-shrink:0;}

  /* ── Footer trust ────────────────────────────────── */
  .trust-row{display:flex;align-items:center;justify-content:center;gap:10px;
    font-size:13px;color:var(--faint);letter-spacing:.3px;
    animation:fadeUp .9s 1.3s cubic-bezier(.22,1,.36,1) both;}
  .trust-dot{width:3px;height:3px;border-radius:50%;background:rgba(255,255,255,.25);}

  @media(max-width:600px){
    .stage{padding:48px 20px 36px;}
    .hero-logo{margin-bottom:24px;}
    .sub{font-size:15px;}
    h1{letter-spacing:-1px;}
  }
  @media(prefers-reduced-motion:reduce){
    .blob,.star,.hero-logo,.route-path,.pin-dest .ring,.ig-btn{animation:none!important;}
    .hero-logo{opacity:1;}
  }
</style>
</head>
<body>

<div class="aurora">
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>
</div>
<div class="grain"></div>
<div class="stars" id="stars"></div>

<div class="stage">

  <img class="hero-logo"
       src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-white.svg'); ?>"
       alt="Escapii" draggable="false">

  <div class="route-wrap">
    <svg viewBox="0 0 920 190" preserveAspectRatio="xMidYMid meet">
      <defs>
        <linearGradient id="rg" x1="0" y1="0" x2="1" y2="0">
          <stop offset="0%"   stop-color="#e0a183" stop-opacity="0"/>
          <stop offset="12%"  stop-color="#e0a183" stop-opacity=".85"/>
          <stop offset="88%"  stop-color="#e0a183" stop-opacity=".85"/>
          <stop offset="100%" stop-color="#e0a183" stop-opacity="0"/>
        </linearGradient>
      </defs>

      <path id="fp" class="route-path" d="M 55 152 Q 460 12 865 152"/>

      <g class="pin-dep" transform="translate(55,152)">
        <circle class="halo" r="10"/>
        <circle r="8" fill="rgba(224,161,131,.15)"/>
        <circle class="core" r="4"/>
      </g>
      <text x="55" y="172" text-anchor="middle"
        font-family="-apple-system,sans-serif" font-size="10" font-weight="700"
        fill="rgba(255,255,255,.45)" letter-spacing="1.2">BEG</text>

      <g class="pin-dest" transform="translate(865,152)">
        <circle class="ring" r="10"/>
        <circle r="14" fill="#faf6ee"/>
        <text class="qmark" x="0" y="5" text-anchor="middle">?</text>
      </g>
      <text x="865" y="122" text-anchor="middle"
        font-family="Georgia,serif" font-style="italic" font-size="13" font-weight="600"
        fill="rgba(240,195,174,.85)">nepoznato</text>

      <g class="plane-g">
        <path d="M0,-6 L5.5,0 L0,6 L1.4,0 Z" fill="#faf6ee" transform="scale(1.5)">
          <animateMotion dur="5.5s" repeatCount="indefinite" rotate="auto" calcMode="linear">
            <mpath href="#fp"/>
          </animateMotion>
        </path>
      </g>
    </svg>
  </div>

  <div class="content">
    <span class="pill"><span class="dot"></span>Uskoro</span>

    <h1>Sledeća destinacija?<br><span class="accent">Za sada ostaje tajna.</span> ✈️</h1>

    <p class="sub">Escapii uskoro lansira putovanja iznenađenja koja će svaku avanturu učiniti nezaboravnom. Do tada, zapratite nas na Instagramu i budite među prvima koji će otkriti gde vas vodimo.</p>

    <a href="https://www.instagram.com/escapii.rs/" target="_blank" rel="noopener" class="ig-btn">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
           stroke-linecap="round" stroke-linejoin="round">
        <rect x="2" y="2" width="20" height="20" rx="5"/>
        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
      </svg>
      Prati nas na Instagramu
    </a>

    <div class="trust-row">
      <span>@escapii.rs</span>
      <span class="trust-dot"></span>
      <span>Prve destinacije se objavljuju uskoro</span>
    </div>
  </div>

</div>

<script>
(function(){
  var c = document.getElementById('stars');
  for(var i=0;i<90;i++){
    var s=document.createElement('div');
    s.className='star'+(Math.random()>.88?' big':'');
    s.style.cssText='left:'+Math.random()*100+'%;top:'+Math.random()*100+'%;'
      +'animation-delay:'+(Math.random()*5)+'s;'
      +'--dur:'+(2.8+Math.random()*3.2)+'s;'
      +'--peak:'+(Math.random()>.88?.95:.55)+';';
    var sz=Math.random()*(s.className.includes('big')?3:1.5)+.8;
    s.style.width=sz+'px';s.style.height=sz+'px';
    c.appendChild(s);
  }
})();
</script>
</body>
</html>
