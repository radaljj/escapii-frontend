<?php
/**
 * Template Name: Utisci
 * URL: /utisci
 */
$theme_uri = get_template_directory_uri();
$site_url  = get_site_url();
?>
<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Utisci Escapera - Iskustva putnika | Escapii</title>
  <meta name="description" content="Pročitaj šta Escaperi kažu o putovanjima iznenađenja. Autentična iskustva putnika koji su verovali iznenađenju - i nisu požalili.">
  <link rel="canonical" href="<?php echo esc_url($site_url); ?>/utisci/">
  <?php wp_head(); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<style>
:root {
  --cream:     #faf6ee;
  --sand:      #f4eee1;
  --paper:     #fffdf8;
  --ink:       #1a1410;
  --mute:      #6b5d4f;
  --faint:     #a3978a;
  --line:      #e7ddcd;
  --terra:     #a85e44;
  --gold:      #CA8A71;
  --gold2:     #b87a62;
  --white:     #ffffff;
  --peach:     #c8775a;
  --teal:      #22424a;
  --teal-deep: #16313a;
  --serif:     -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --display:   -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --sans:      -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --gray:      #7A9FA8;
  --white-nav: #2D5F6B;
  --accent:    #CA8A71;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
* { -webkit-tap-highlight-color: transparent; }
html { scroll-behavior: smooth; }
body { background: var(--cream); color: var(--ink); font-family: var(--serif);
  -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; line-height: 1.7; }
a { color: inherit; }

/* ── Nav ── */
.esc-nav {
  position: fixed; top: 0; left: 0; right: 0; z-index: 999;
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 64px; height: 72px;
  background: rgba(15,45,53,.92); backdrop-filter: blur(24px);
  border-bottom: 1px solid rgba(255,255,255,.07); transition: background .3s;
}
.esc-logo { display: inline-flex; align-items: center; text-decoration: none; }
.esc-logo img { height: 48px; width: auto; display: block; }
@media (max-width:768px) { .esc-logo img { height:36px; } }
.nav-right { display: flex; align-items: center; gap: 20px; }
.lang-wrap { display: flex; background: rgba(255,255,255,.07); border-radius: 8px; overflow: hidden; }
.lang-btn { padding: 7px 16px; font-size: 13px; font-weight: 700; cursor: pointer;
            border: none; background: transparent; color: var(--gray);
            letter-spacing: .5px; transition: all .2s; }
.lang-btn.on { background: var(--gold); color: #fff; }
.nav-status { background: rgba(255,255,255,.07); border: 1.5px solid rgba(255,255,255,.12);
              color: var(--gray); border-radius: 8px; padding: 8px 14px;
              font-size: 13px; font-weight: 600; font-family: inherit;
              cursor: pointer; transition: all .2s;
              display: flex; align-items: center; gap: 6px; }
.nav-status:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.22); color: var(--white); }
.nav-status svg { flex-shrink: 0; }
.mob-gift-wrap { border-bottom: 1px solid rgba(255,255,255,.06); }
.mob-gift-toggle {
  width: 100%; display: flex; align-items: center; justify-content: space-between;
  padding: 13px 4px; font-size: 15px; font-weight: 700; color: #d4a83c;
  background: none; border: none; text-align: left; cursor: pointer; font-family: inherit; transition: color .15s;
}
.mob-gift-caret { font-size: 11px; transition: transform .22s; flex-shrink: 0; margin-left: 6px; }
.mob-gift-toggle.open .mob-gift-caret { transform: rotate(180deg); }
.mob-gift-sub { display: flex; flex-direction: column; padding: 0 0 4px 16px;
                max-height: 0; overflow: hidden; transition: max-height .25s ease; }
.mob-gift-sub.open { max-height: 120px; }
.mob-gift-sub-btn { padding: 10px 4px; font-size: 14px; font-weight: 600;
                    color: rgba(255,255,255,.65); background: none; border: none;
                    border-bottom: 1px solid rgba(255,255,255,.05); text-align: left;
                    cursor: pointer; font-family: inherit; transition: color .15s; }
.mob-gift-sub-btn:last-child { border-bottom: none; }
.mob-gift-sub-btn:hover { color: #fff; }
.nav-burger { display:none; flex-direction:column; justify-content:center; gap:5px;
              width:40px; height:40px; background:none; border:none; cursor:pointer; padding:8px; }
.nav-burger span { display:block; height:2px; background:white; border-radius:2px;
                   transition: transform .3s, opacity .3s, width .3s; width:100%; }
.nav-burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.nav-burger.open span:nth-child(2) { opacity:0; width:0; }
.nav-burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
.mob-menu { display:none; position:fixed; top:72px; left:0; right:0; z-index:997;
            background:rgba(15,45,53,.97); backdrop-filter:blur(28px);
            border-bottom:1px solid rgba(255,255,255,.07);
            flex-direction:column; padding:16px 24px 24px;
            transform:translateY(-8px); opacity:0;
            transition: transform .25s ease, opacity .25s ease; pointer-events: none; }
.mob-menu.open { transform:translateY(0); opacity:1; pointer-events: auto; }
.mob-menu-links { display:flex; flex-direction:column; gap:2px; margin-bottom:20px; }
.mob-menu-link { padding:13px 4px; font-size:15px; font-weight:700; color:rgba(255,255,255,.7);
                 background:none; border:none; text-align:left; cursor:pointer;
                 border-bottom:1px solid rgba(255,255,255,.06); transition:color .15s; }
.mob-menu-link:last-child { border-bottom:none; }
.mob-menu-link:hover { color:white; }
.mob-menu-call { color: var(--accent) !important; }
.mob-menu-call-hours { display:block; font-size:11px; color:rgba(255,255,255,.38); font-weight:500; margin-top:3px; }
.mob-menu-bottom { display:flex; align-items:center; justify-content:space-between; gap:12px; padding-top:4px; }
.mob-menu-book { flex:1; background:var(--gold); color:#fff; border:none;
                 padding:13px; border-radius:10px; font-size:14px; font-weight:800; cursor:pointer; font-family:inherit; }
@media (max-width:768px) {
  .esc-nav { padding: 0 20px; }
  .nav-right { display: none; }
  .nav-burger { display: flex; }
  .mob-menu { display: flex; }
}

/* ── Secondary nav ── */
.sec-nav {
  position: fixed; top: 72px; left: 0; right: 0; z-index: 998;
  display: flex; align-items: center; justify-content: center;
  padding: 0 24px; height: 44px;
  background: rgba(15,45,53,.82); backdrop-filter: blur(28px) saturate(180%);
  border-bottom: 1px solid rgba(255,255,255,.05);
  overflow-x: auto; gap: 4px;
  transform: translateY(-116%); opacity: 0;
  transition: transform .35s cubic-bezier(.4,0,.2,1), opacity .35s ease;
  scrollbar-width: none;
}
.sec-nav::-webkit-scrollbar { display: none; }
.sec-nav.visible { transform: translateY(0); opacity: 1; }
@media (max-width: 768px) { .sec-nav { display: none !important; } }
.sec-nav-link {
  white-space: nowrap; flex-shrink: 0;
  padding: 5px 14px; border-radius: 20px;
  font-size: 11px; font-weight: 700; letter-spacing: .8px;
  text-transform: uppercase; color: rgba(255,255,255,.4);
  cursor: pointer; transition: color .2s, background .2s;
  background: none; border: none; font-family: inherit;
}
.sec-nav-link:hover { color: rgba(255,255,255,.85); background: rgba(255,255,255,.06); }
.sec-nav-cta {
  white-space: nowrap; flex-shrink: 0;
  display: inline-flex; align-items: center; gap: 4px;
  padding: 6px 16px; border-radius: 20px;
  font-size: 12px; font-weight: 700; cursor: pointer; font-family: inherit;
  color: #fff; background: var(--gold); border: none;
  box-shadow: 0 2px 10px rgba(202,138,113,.35); transition: all .2s;
}
.sec-nav-cta:hover { background: var(--gold2); box-shadow: 0 4px 16px rgba(202,138,113,.45); transform: translateY(-1px); }
.sec-nav-call {
  white-space: nowrap; flex-shrink: 0;
  display: inline-flex; align-items: center; gap: 6px;
  padding: 5px 14px; border-radius: 20px;
  font-size: 12px; font-weight: 700; cursor: pointer; font-family: inherit;
  color: var(--gold); background: rgba(202,138,113,.12);
  border: 1px solid rgba(202,138,113,.3); transition: all .2s;
}
.sec-nav-call:hover { background: rgba(202,138,113,.22); border-color: rgba(202,138,113,.55); }
.sec-gift-wrap { position: relative; flex-shrink: 0; margin-left: 16px; }
.sec-gift-btn {
  white-space: nowrap; display: inline-flex; align-items: center; gap: 6px;
  padding: 5px 14px; border-radius: 20px;
  font-size: 11px; font-weight: 700; letter-spacing: .4px;
  cursor: pointer; font-family: inherit;
  color: #d4a83c; background: rgba(200,149,58,.14);
  border: 1px solid rgba(200,149,58,.3); transition: all .2s;
}
.sec-gift-btn:hover, .sec-gift-btn.open { background: rgba(200,149,58,.26); border-color: rgba(200,149,58,.55); }
.sec-gift-caret { font-size: 9px; transition: transform .2s; display: inline-block; }
.sec-gift-btn.open .sec-gift-caret { transform: rotate(180deg); }
.sec-gift-drop {
  position: fixed; top: 0; right: 0;
  background: rgba(15,45,53,.97); backdrop-filter: blur(28px);
  border: 1px solid rgba(255,255,255,.1); border-radius: 12px;
  min-width: 210px; overflow: hidden;
  box-shadow: 0 16px 48px rgba(0,0,0,.45);
  opacity: 0; transform: translateY(-8px); pointer-events: none;
  transition: opacity .2s, transform .2s; z-index: 1002;
}
.sec-gift-drop.open { opacity: 1; transform: translateY(0); pointer-events: auto; }
.nav-gift-item {
  display: flex; align-items: center; gap: 10px;
  padding: 12px 16px; width: 100%;
  background: none; border: none; border-bottom: 1px solid rgba(255,255,255,.06);
  color: rgba(255,255,255,.7); cursor: pointer; font-family: inherit; text-align: left;
  transition: background .15s, color .15s;
}
.nav-gift-item:last-child { border-bottom: none; }
.nav-gift-item:hover { background: rgba(255,255,255,.06); color: #fff; }
.nav-gift-item.primary { color: #d4a83c; }
.nav-gift-item.primary:hover { background: rgba(200,149,58,.1); color: #e0b84a; }
.nav-gift-item-icon { font-size: 16px; flex-shrink: 0; }
.nav-gift-item-text { display: flex; flex-direction: column; gap: 1px; }
.nav-gift-item-label { font-size: 13px; font-weight: 700; line-height: 1.2; }
.nav-gift-item-sub { font-size: 11px; font-weight: 400; color: rgba(255,255,255,.4); line-height: 1.2; }
.nav-gift-item.primary .nav-gift-item-sub { color: rgba(212,168,60,.55); }

/* ── Hero ── */
.ut-hero {
  position: relative; overflow: hidden;
  text-align: center; padding: 142px 24px 110px;
  background: url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1920&q=80&auto=format&fit=crop') center/cover no-repeat var(--teal-deep);
}
.ut-hero::before {
  content: ""; position: absolute; inset: 0;
  background: rgba(10,30,38,.68);
}
.ut-hero::after {
  content: ""; position: absolute; inset: 0; opacity: .22;
  background-image: radial-gradient(rgba(255,255,255,.07) 1px, transparent 1px);
  background-size: 26px 26px;
}
.ut-hero-content { position: relative; z-index: 2; max-width: 680px; margin: 0 auto; }
.ut-hero-pill {
  display: inline-flex; align-items: center; gap: 9px;
  font-family: var(--sans); font-size: 11px; font-weight: 700;
  letter-spacing: 2px; text-transform: uppercase; color: #fbe3d6;
  background: rgba(200,119,90,.18); border: 1px solid rgba(200,119,90,.45);
  padding: 8px 16px; border-radius: 100px; margin-bottom: 22px;
}
.ut-hero h1 {
  font-family: var(--display); font-weight: 600; color: #fff;
  font-size: clamp(34px, 5vw, 58px); line-height: 1.07; letter-spacing: -1px;
  margin-bottom: 14px; text-wrap: balance;
}
.ut-hero p {
  font-family: var(--serif); font-size: 17px; line-height: 1.6;
  color: rgba(255,255,255,.7); max-width: 48ch; margin: 0 auto;
}

/* ── Reviews section ── */
.ut-reviews {
  max-width: 1120px; margin: 0 auto;
  padding: 88px 32px 64px;
}
.ut-section-label {
  font-size: 11px; font-weight: 700; letter-spacing: 2px;
  text-transform: uppercase; color: var(--terra);
  display: flex; align-items: center; gap: 12px;
  margin-bottom: 14px;
}
.ut-section-label::before {
  content: ""; width: 32px; height: 2px; background: var(--terra); border-radius: 2px;
}
.ut-section-h2 {
  font-size: clamp(28px, 3.5vw, 44px); font-weight: 600; letter-spacing: -.8px;
  color: var(--ink); line-height: 1.1; margin-bottom: 8px;
}
.ut-section-sub {
  font-size: 16px; color: var(--mute); line-height: 1.6; margin-bottom: 52px;
}
.ut-reviews-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  perspective: 1000px;
}
.ut-review-card {
  background: var(--paper);
  border: 1px solid var(--line);
  border-radius: 20px;
  padding: 32px 28px;
  display: flex;
  flex-direction: column;
  gap: 0;
  will-change: transform, opacity;
  transition: box-shadow .25s, border-color .25s;
}
.ut-review-card:hover {
  border-color: #e3c8b8;
  box-shadow: 0 24px 56px -16px rgba(168,94,68,.22);
}
.ut-review-stars {
  display: flex; gap: 3px; margin-bottom: 18px;
}
.ut-review-stars span {
  font-size: 15px; color: #CA8A71;
}
.ut-review-quote {
  font-size: 32px; line-height: 1; color: var(--line);
  font-family: Georgia, serif; margin-bottom: 10px; user-select: none;
}
.ut-review-text {
  font-size: 15px; line-height: 1.7; color: var(--mute);
  flex: 1; margin-bottom: 24px;
}
.ut-review-footer {
  display: flex; align-items: center; gap: 12px;
  border-top: 1px solid var(--line); padding-top: 20px;
}
.ut-review-avatar {
  width: 40px; height: 40px; border-radius: 50%;
  background: linear-gradient(135deg, var(--gold), var(--terra));
  display: flex; align-items: center; justify-content: center;
  font-size: 14px; font-weight: 700; color: #fff; flex-shrink: 0;
}
.ut-review-name {
  font-size: 14px; font-weight: 700; color: var(--ink); line-height: 1.2;
}
.ut-review-city {
  font-size: 12px; color: var(--faint);
}
.ut-review-dest {
  margin-left: auto; flex-shrink: 0;
  font-size: 11px; font-weight: 600; letter-spacing: .3px;
  color: var(--terra); background: rgba(168,94,68,.08);
  border: 1px solid rgba(168,94,68,.18); border-radius: 100px;
  padding: 4px 10px;
}

/* ── Google Reviews ── */
.ut-gr {
  background: var(--cream);
  padding: 80px 0 88px;
  overflow: hidden;
}
.ut-gr-hero {
  text-align: center;
  padding: 0 24px;
  margin-bottom: 48px;
}
.ut-gr-glogo-wrap {
  display: inline-flex; align-items: center; gap: 10px;
  margin-bottom: 16px;
}
.ut-gr-glogo { width: 26px; height: 26px; flex-shrink: 0; }
.ut-gr-platform-label {
  font-size: 12px; font-weight: 700; letter-spacing: 1.5px;
  text-transform: uppercase; color: var(--faint);
}
.ut-gr-stars-big { display: flex; justify-content: center; gap: 4px; margin-bottom: 8px; }
.ut-gr-stars-big span { font-size: 26px; color: #FBBC05; }
.ut-gr-count { font-size: 14px; color: var(--faint); }
/* marquee */
.ut-gr-marquee-outer {
  overflow: hidden;
  margin-bottom: 44px;
  -webkit-mask-image: linear-gradient(to right, transparent 0%, #000 8%, #000 92%, transparent 100%);
  mask-image: linear-gradient(to right, transparent 0%, #000 8%, #000 92%, transparent 100%);
}
.ut-gr-marquee-track {
  display: flex; gap: 14px;
  width: max-content;
  animation: gr-left 45s linear infinite;
}
.ut-gr-marquee-outer:hover .ut-gr-marquee-track { animation-play-state: paused; }
@keyframes gr-left { from { transform: translateX(0); } to { transform: translateX(-50%); } }
/* card */
.ut-gr-card {
  width: 300px; flex-shrink: 0;
  background: #fff;
  border: 1px solid var(--line);
  border-radius: 18px;
  padding: 20px 22px;
  display: flex; flex-direction: column; gap: 10px;
  box-shadow: 0 2px 16px rgba(0,0,0,.05);
  cursor: default;
  transition: box-shadow .2s, transform .2s;
}
.ut-gr-card:hover { box-shadow: 0 10px 32px rgba(0,0,0,.1); transform: translateY(-3px); }
.ut-gr-card-top { display: flex; align-items: center; gap: 10px; }
.ut-gr-avatar {
  width: 36px; height: 36px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 14px; font-weight: 700; color: #fff; flex-shrink: 0;
}
.ut-gr-name { font-size: 13px; font-weight: 700; color: var(--ink); line-height: 1.2; }
.ut-gr-date { font-size: 11px; color: var(--faint); margin-top: 1px; }
.ut-gr-gmark { width: 14px; height: 14px; margin-left: auto; flex-shrink: 0; }
.ut-gr-stars { display: flex; gap: 1px; }
.ut-gr-stars span { font-size: 12px; color: #FBBC05; }
.ut-gr-text { font-size: 13px; line-height: 1.65; color: var(--mute); }
/* cta */
.ut-gr-cta {
  display: flex; flex-direction: column; align-items: center; gap: 10px;
  padding: 0 24px;
}
.ut-gr-btn {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 12px 26px; background: #fff; color: var(--ink);
  font-size: 14px; font-weight: 700; font-family: inherit;
  border: 1.5px solid var(--line); border-radius: 12px;
  text-decoration: none;
  box-shadow: 0 1px 6px rgba(0,0,0,.07);
  transition: border-color .2s, box-shadow .2s, transform .2s;
}
.ut-gr-btn:hover { border-color: #4285F4; box-shadow: 0 4px 20px rgba(66,133,244,.18); transform: translateY(-1px); }
.ut-gr-note { font-size: 13px; color: var(--faint); }

/* ── Separator ── */
.ut-sep {
  text-align: center; padding: 0 24px 80px;
}
.ut-sep-inner {
  display: inline-flex; align-items: center; gap: 20px;
  font-size: 13px; font-weight: 600; letter-spacing: 1.5px;
  text-transform: uppercase; color: var(--faint);
}
.ut-sep-inner::before, .ut-sep-inner::after {
  content: ""; width: 64px; height: 1px; background: var(--line);
}

/* ── Instagram section ── */
.ut-ig {
  background: var(--teal-deep);
  padding: 88px 32px 96px;
}
.ut-ig-inner {
  max-width: 1120px; margin: 0 auto;
}
.ut-ig .ut-section-label { color: var(--gold); }
.ut-ig .ut-section-label::before { background: var(--gold); }
.ut-ig .ut-section-h2 { color: #fff; }
.ut-ig .ut-section-sub { color: rgba(255,255,255,.55); }
/* ── Swiper ── */
.ut-swiper-wrap { position: relative; padding: 8px 0 56px; }
.ut-swiper { width: 100%; overflow: visible; }
.ut-swiper .swiper-slide {
  width: 360px; max-width: 82vw;
  position: relative;
  transform: scale(0.84);
  opacity: .5;
  transition: transform .45s ease, opacity .45s ease;
}
.ut-swiper .swiper-slide-active {
  transform: scale(1);
  opacity: 1;
}
.ut-swiper .swiper-slide .instagram-media {
  margin: 0 auto !important;
  border-radius: 18px !important;
  width: 100% !important;
  min-width: 0 !important;
}
.ut-slide-overlay {
  display: none;
  position: absolute; inset: 0; z-index: 10;
  border-radius: 18px; cursor: pointer;
}
.ut-swiper .swiper-slide:not(.swiper-slide-active) .ut-slide-overlay { display: block; }
.ut-swiper-pagination { margin-top: 28px; display: flex; justify-content: center; gap: 6px; }
.ut-swiper-pagination .swiper-pagination-bullet {
  width: 8px; height: 8px; border-radius: 4px;
  background: rgba(255,255,255,.25); opacity: 1; transition: all .25s;
}
.ut-swiper-pagination .swiper-pagination-bullet-active {
  background: var(--gold); width: 24px;
}
.ut-ig-handle {
  text-align: center; margin-top: 36px;
}
.ut-ig-handle a {
  display: inline-flex; align-items: center; gap: 8px;
  font-size: 14px; font-weight: 700; color: rgba(255,255,255,.6);
  text-decoration: none; transition: color .2s;
}
.ut-ig-handle a:hover { color: var(--gold); }
.ut-ig-handle svg { width: 16px; height: 16px; fill: currentColor; }


/* ── CTA section ── */
.ut-cta {
  text-align: center; padding: 96px 24px;
}
.ut-cta h2 {
  font-size: clamp(28px, 4vw, 46px); font-weight: 600;
  letter-spacing: -.8px; color: var(--ink);
  line-height: 1.1; margin-bottom: 14px;
}
.ut-cta p {
  font-size: 17px; color: var(--mute);
  margin-bottom: 36px; max-width: 44ch; margin-left: auto; margin-right: auto;
}
.ut-cta-btn {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 16px 36px; background: var(--gold); color: #fff;
  font-size: 15px; font-weight: 700; font-family: inherit;
  border: none; border-radius: 14px; cursor: pointer;
  box-shadow: 0 8px 28px rgba(202,138,113,.38);
  transition: background .2s, box-shadow .2s, transform .2s;
  text-decoration: none;
}
.ut-cta-btn:hover { background: var(--gold2); box-shadow: 0 12px 36px rgba(202,138,113,.5); transform: translateY(-2px); }

/* ── Footer (identičan homepage) ── */
.esc-footer { background: #EFE9E7; padding: 64px 64px 28px; border-top: 1px solid rgba(15,45,53,.07); }
.footer-main { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 56px; }
.footer-brand p { font-size: 14px; color: var(--gray); line-height: 1.75; margin-top: 16px; max-width: 280px; }
.footer-col h4 { font-family: var(--sans); font-size: 11px; font-weight: 800; color: var(--white-nav); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 18px; }
.footer-col a { display: block; font-size: 14px; color: var(--gray); text-decoration: none; margin-bottom: 10px; transition: color .2s; }
.footer-col a:hover { color: var(--accent); }
.footer-social { margin-top: 28px; }
.footer-social h4 { font-size: 11px; font-weight: 800; color: var(--white-nav); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 16px; font-family: var(--sans); }
.social-icons { display: flex; gap: 12px; }
.social-icon { width: 40px; height: 40px; border-radius: 10px; background: rgba(15,45,53,.06); border: 1px solid rgba(15,45,53,.1); display: flex; align-items: center; justify-content: center; color: var(--gray); text-decoration: none; transition: all .2s; }
.social-icon:hover { background: var(--accent); border-color: var(--accent); color: #fff; }
.social-icon svg { width: 18px; height: 18px; fill: currentColor; }
.footer-divider { height: 1px; background: rgba(15,45,53,.08); margin-bottom: 24px; }
.footer-bottom { display: flex; justify-content: space-between; align-items: center; font-family: var(--sans); font-size: 13px; color: var(--gray); flex-wrap: wrap; gap: 12px; }
.footer-bottom-links { display: flex; gap: 24px; }
.footer-bottom-links a { color: var(--gray); text-decoration: none; font-size: 13px; transition: color .2s; }
.footer-bottom-links a:hover { color: var(--white-nav); }

/* ── Responsive ── */
@media (max-width: 900px) {
  .ut-reviews-grid { grid-template-columns: repeat(2, 1fr); }
  .ut-reviews { padding: 72px 28px 56px; }
  .ut-gr { padding: 64px 0 72px; }
}
@media (max-width: 768px) {
  .ut-hero { padding: 110px 24px 80px; }
  .ut-cta h2 { font-size: clamp(26px, 7vw, 36px); }
}
@media (max-width: 600px) {
  .ut-hero { padding: 96px 20px 72px; }
  .ut-reviews { padding: 56px 16px 40px; }
  .ut-reviews-grid { grid-template-columns: 1fr; gap: 16px; }
  .ut-gr { padding: 48px 0 56px; }
  .ut-gr-big-score { letter-spacing: -2px; }
  .ut-ig { padding: 56px 16px 64px; }
  .ut-swiper .swiper-slide { width: 78vw; max-width: 300px; }
  .ut-swiper-wrap { padding: 8px 0 48px; }
  .ut-cta { padding: 56px 20px; }
  .esc-footer { padding: 48px 20px 24px; }
  .footer-main { grid-template-columns: 1fr; gap: 32px; }
  .footer-brand p { max-width: 100%; }
  .footer-bottom { flex-direction: column; text-align: center; }
  .footer-bottom-links { flex-wrap: wrap; justify-content: center; gap: 16px; }
}
@media (max-width: 400px) {
  .ut-hero { padding: 88px 16px 64px; }
  .ut-section-h2 { font-size: clamp(22px, 6.5vw, 30px); }
  .ut-swiper .swiper-slide { width: 82vw; }
}
</style>
</head>
<body>

<!-- NAV -->
<?php include get_template_directory() . '/inc/subpage-nav.php'; ?>

<!-- HERO -->
<header class="ut-hero">
  <div class="ut-hero-content">
    <span class="ut-hero-pill">
      <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
      Pravi Escaperi govore
    </span>
    <h1>Čuli smo svašta.</h1>
    <p>Skupljamo poruke posle svakog putovanja. Nismo birali ni uređivali — ovo je sve.</p>
  </div>
</header>

<!-- REVIEWS -->
<section class="ut-reviews" id="utisci">
  <div class="ut-section-label">Utisci</div>
  <h2 class="ut-section-h2">Stiglo u inbox</h2>

  <div class="ut-reviews-grid">

    <div class="ut-review-card">
      <div class="ut-review-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
      <div class="ut-review-quote">"</div>
      <p class="ut-review-text">Iskreno nisam verovala da ću biti zadovoljna jer sam skeptik po prirodi. Ali Prag je bio wow. Svaka čast Escapii, jedva čekam sledeće.</p>
      <div class="ut-review-footer">
        <div class="ut-review-avatar">M</div>
        <div>
          <div class="ut-review-name">Milica D.</div>
          <div class="ut-review-city">Beograd</div>
        </div>
        <span class="ut-review-dest">Prag ✈</span>
      </div>
    </div>

    <div class="ut-review-card">
      <div class="ut-review-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
      <div class="ut-review-quote">"</div>
      <p class="ut-review-text">Malo sam se plašio šta ako dobijemo neku destinaciju koja nam ne odgovara. Porto je bio odličan. Jedina žalba — premalo dana.</p>
      <div class="ut-review-footer">
        <div class="ut-review-avatar">S</div>
        <div>
          <div class="ut-review-name">Stefan J.</div>
          <div class="ut-review-city">Niš</div>
        </div>
        <span class="ut-review-dest">Porto ✈</span>
      </div>
    </div>

    <div class="ut-review-card">
      <div class="ut-review-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
      <div class="ut-review-quote">"</div>
      <p class="ut-review-text">Poklonila sam muzu za godišnjicu. Bio je siguran da zna kuda idemo i pogodio je krivo :) Budimpešta je bila top, on sad traži da ponovo idemo.</p>
      <div class="ut-review-footer">
        <div class="ut-review-avatar">J</div>
        <div>
          <div class="ut-review-name">Jovana M.</div>
          <div class="ut-review-city">Beograd</div>
        </div>
        <span class="ut-review-dest">Budimpešta ✈</span>
      </div>
    </div>

    <div class="ut-review-card">
      <div class="ut-review-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
      <div class="ut-review-quote">"</div>
      <p class="ut-review-text">Prosto radi. Rezervišeš, platiš i čekaš. Otišli smo u Rim, a ja nisam znao ni koji aerodrom koristimo sve do dva dana pre polaska.</p>
      <div class="ut-review-footer">
        <div class="ut-review-avatar">L</div>
        <div>
          <div class="ut-review-name">Lazar N.</div>
          <div class="ut-review-city">Beograd</div>
        </div>
        <span class="ut-review-dest">Rim ✈</span>
      </div>
    </div>

    <div class="ut-review-card">
      <div class="ut-review-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
      <div class="ut-review-quote">"</div>
      <p class="ut-review-text">Putovala sam sama, malo nervozna zbog toga. Sve je prošlo odlično, Barsa je bila savršena za solo trip. Već rezervisala sledeće.</p>
      <div class="ut-review-footer">
        <div class="ut-review-avatar">A</div>
        <div>
          <div class="ut-review-name">Ana K.</div>
          <div class="ut-review-city">Beograd</div>
        </div>
        <span class="ut-review-dest">Barselona ✈</span>
      </div>
    </div>

    <div class="ut-review-card">
      <div class="ut-review-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
      <div class="ut-review-quote">"</div>
      <p class="ut-review-text">Treće putovanje, ista priča — mislim da znam kuda idemo, svaki put pogrešim. I svaki put budem oduševljena. Krakow mi je bio najdraži do sad.</p>
      <div class="ut-review-footer">
        <div class="ut-review-avatar">T</div>
        <div>
          <div class="ut-review-name">Tamara V.</div>
          <div class="ut-review-city">Niš</div>
        </div>
        <span class="ut-review-dest">Krakow ✈</span>
      </div>
    </div>

  </div>
</section>

<!-- GOOGLE REVIEWS -->
<section class="ut-gr" id="google-recenzije">

  <div class="ut-gr-hero">
    <div class="ut-gr-glogo-wrap">
      <svg class="ut-gr-glogo" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
      <span class="ut-gr-platform-label">Google recenzije</span>
    </div>
    <div class="ut-gr-stars-big"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
    <div class="ut-gr-count">na osnovu 24 recenzije · Escapii</div>
  </div>

  <?php
  $gsvg = '<svg class="ut-gr-gmark" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>';
  $stars = '<div class="ut-gr-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>';

  $cards = [
    ['M','#4285F4','Milica D.','pre mesec dana','Prag je bio wow. Nisam ni sanjala tu destinaciju a sad je jedna od omiljenih. Definitivno ponavljamo.'],
    ['J','#34A853','Jovana M.','pre 2 meseca','Poklonila muzu za godišnjicu, nije ni slutio kuda idemo. Budimpešta savršena. Muz sad pita kad idemo opet :)'],
    ['L','#EA4335','Lazar N.','pre mesec dana','Prosto radi. Uplatiš, čekaš, pakuješ kofere dan pre. Otišli smo u Rim a nisam znao ni koji aerodrom.'],
    ['T','#FBBC05','Tamara V.','pre 3 meseca','Treće putovanje, Krakow ovaj put. Svaki put pogodim krivo i svaki put budem oduševljena. Jedini način da putujem.'],
    ['S','#4285F4','Stefan J.','pre 2 meseca','Malo sam se plašio ali Porto je bio odličan. Jedina žalba — premalo dana. Sledeće putovanje već planiram.'],
    ['A','#34A853','Ana K.','pre mesec dana','Putovala sama, malo nervozna. Sve prošlo odlično, Barsa savršena za solo trip. Već rezervisala sledeće.'],
  ];

  function gr_card($c, $gsvg, $stars) {
    return '<div class="ut-gr-card">
      <div class="ut-gr-card-top">
        <div class="ut-gr-avatar" style="background:'.$c[1].'">'.$c[0].'</div>
        <div><div class="ut-gr-name">'.$c[2].'</div><div class="ut-gr-date">'.$c[3].'</div></div>'
        .$gsvg.
      '</div>'.$stars.'<p class="ut-gr-text">'.$c[4].'</p></div>';
  }
  ?>

  <div class="ut-gr-marquee-outer">
    <div class="ut-gr-marquee-track">
      <?php foreach(array_merge($cards,$cards) as $c) echo gr_card($c,$gsvg,$stars); ?>
    </div>
  </div>

  <div class="ut-gr-cta">
    <a href="#" class="ut-gr-btn" target="_blank" rel="noopener">
      <svg viewBox="0 0 24 24" width="16" height="16"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
      Ostavi recenziju na Google-u
    </a>
    <span class="ut-gr-note">Svaka recenzija pomaže sledećem Escaperu da odluči</span>
  </div>

</section>

<!-- SEPARATOR -->
<div class="ut-sep">
  <div class="ut-sep-inner">A sada tvoj red</div>
</div>

<!-- INSTAGRAM -->
<section class="ut-ig" id="instagram">
  <div class="ut-ig-inner">
    <div class="ut-section-label">Instagram</div>
    <h2 class="ut-section-h2">Uhvaćeni na putu</h2>
    <p class="ut-section-sub">Telefoni iz džepa. Niko nije snimao za promo.</p>

    <div class="ut-swiper-wrap">
      <div class="swiper ut-swiper" id="utSwiperIG">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="ut-slide-overlay"></div>
            <blockquote class="instagram-media"
              data-instgrm-permalink="https://www.instagram.com/reel/Dasa7Ieo-RR/?utm_source=ig_embed&utm_campaign=loading"
              data-instgrm-version="14"
              style="background:#FFF;border:0;border-radius:16px;box-shadow:0 0 1px 0 rgba(0,0,0,.5),0 1px 10px 0 rgba(0,0,0,.15);margin:0 auto;padding:0;width:100%;">
            </blockquote>
          </div>

          <div class="swiper-slide">
            <div class="ut-slide-overlay"></div>
            <blockquote class="instagram-media"
              data-instgrm-permalink="https://www.instagram.com/reel/DaqGCg1ojBT/?utm_source=ig_embed&utm_campaign=loading"
              data-instgrm-version="14"
              style="background:#FFF;border:0;border-radius:16px;box-shadow:0 0 1px 0 rgba(0,0,0,.5),0 1px 10px 0 rgba(0,0,0,.15);margin:0 auto;padding:0;width:100%;">
            </blockquote>
          </div>

        </div>
      </div>

      <div class="ut-swiper-pagination" id="utSwiperPag"></div>
    </div>

    <script async src="//www.instagram.com/embed.js"></script>

    <div class="ut-ig-handle">
      <a href="https://www.instagram.com/escapii.rs" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
        @escapii.rs
      </a>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="ut-cta">
  <h2>Tvoj red.</h2>
  <p>Rezerviši i zaboravi. Javljamo se kad je vreme.</p>
  <a href="<?php echo esc_url($site_url); ?>/#esc-booking" class="ut-cta-btn">
    Rezerviši putovanje
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
  </a>
</section>

<?php include get_template_directory() . '/inc/footer.php'; ?>

<script>
// ── Nav functions ──────────────────────────────────────────────────────────
var lang = localStorage.getItem('esc-lang') || 'sr';

function setLang(l) {
  lang = l; localStorage.setItem('esc-lang', l);
  document.querySelectorAll('.lang-btn').forEach(function(b) {
    b.classList.toggle('on', b.textContent.trim() === l.toUpperCase());
  });
  document.documentElement.lang = l;
}

function togBurger() {
  var burger = document.getElementById('navBurger');
  var menu   = document.getElementById('mobMenu');
  var open   = burger.classList.toggle('open');
  menu.classList.toggle('open', open);
  document.body.style.overflow = open ? 'hidden' : '';
}
function closeMobMenu() {
  document.getElementById('navBurger').classList.remove('open');
  document.getElementById('mobMenu').classList.remove('open');
  document.body.style.overflow = '';
}
function togMobGift() {
  document.getElementById('mobGiftToggle').classList.toggle('open');
  document.getElementById('mobGiftSub').classList.toggle('open');
}
function toggleSecGift() {
  var btn  = document.getElementById('secGiftBtn');
  var drop = document.getElementById('secGiftDrop');
  var open = btn.classList.toggle('open');
  if (open) {
    var r = btn.getBoundingClientRect();
    drop.style.top   = (r.bottom + 6) + 'px';
    drop.style.right = (window.innerWidth - r.right) + 'px';
    drop.style.left  = 'auto';
  }
  drop.classList.toggle('open', open);
}
function closeSecGift() {
  document.getElementById('secGiftBtn').classList.remove('open');
  document.getElementById('secGiftDrop').classList.remove('open');
}
document.addEventListener('click', function(e) {
  if (!e.target.closest('#secGiftWrap') && !e.target.closest('#secGiftDrop')) closeSecGift();
});
document.addEventListener('click', function(e) {
  if (!e.target.closest('#mobMenu') && !e.target.closest('#navBurger')) closeMobMenu();
});

if (lang === 'en') setLang('en');

// ── Review card animations ─────────────────────────────────────────────────
(function() {
  var cards = Array.from(document.querySelectorAll('.ut-review-card'));

  // Set initial hidden state
  cards.forEach(function(card) {
    card.style.opacity = '0';
    card.style.transform = 'translateY(48px)';
  });

  // Staggered scroll entrance
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (!entry.isIntersecting) return;
      var card = entry.target;
      var idx = cards.indexOf(card);
      setTimeout(function() {
        card.style.transition = 'opacity .65s cubic-bezier(.16,1,.3,1), transform .65s cubic-bezier(.16,1,.3,1)';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
        setTimeout(function() { card.style.transition = ''; }, 700);
      }, idx * 85);
      observer.unobserve(card);
    });
  }, { threshold: 0.08 });
  cards.forEach(function(card) { observer.observe(card); });

  // 3D tilt on hover
  cards.forEach(function(card) {
    card.addEventListener('mousemove', function(e) {
      var r = card.getBoundingClientRect();
      var dx = (e.clientX - r.left - r.width  / 2) / (r.width  / 2);
      var dy = (e.clientY - r.top  - r.height / 2) / (r.height / 2);
      card.style.transition = 'box-shadow .12s, border-color .12s, transform .12s';
      card.style.transform = 'translateY(-5px) rotateX(' + (-dy * 7) + 'deg) rotateY(' + (dx * 7) + 'deg)';
    });
    card.addEventListener('mouseleave', function() {
      card.style.transition = 'box-shadow .4s, border-color .4s, transform .55s cubic-bezier(.16,1,.3,1)';
      card.style.transform = '';
    });
  });
})();
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
(function() {
  var swiper = new Swiper('#utSwiperIG', {
    slidesPerView: 'auto',
    centeredSlides: true,
    spaceBetween: 28,
    loop: false,
    grabCursor: true,
    pagination: {
      el: '#utSwiperPag',
      clickable: true,
      bulletClass: 'swiper-pagination-bullet',
      bulletActiveClass: 'swiper-pagination-bullet-active'
    },
    on: {
      afterInit: function() {
        if (window.instgrm) window.instgrm.Embeds.process();
      }
    }
  });

  document.querySelectorAll('.ut-slide-overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function() {
      var slide = this.closest('.swiper-slide');
      var idx = Array.from(swiper.slides).indexOf(slide);
      if (idx !== -1) swiper.slideTo(idx);
    });
  });
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
