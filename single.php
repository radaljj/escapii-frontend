<?php
/**
 * Single post template.
 */
if (!have_posts()) { wp_redirect(home_url('/blog')); exit; }
the_post();

$cats      = get_the_category();
$cat_link  = $cats ? esc_url(get_category_link($cats[0]->term_id)) : home_url('/blog');
$has_img   = has_post_thumbnail();
$author_id = get_the_author_meta('ID');
$author    = get_the_author();
$author_bio= get_the_author_meta('description');
$tags      = get_the_tags();

// Related posts - 3 najnovija, isključi trenutni
$related = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post__not_in'   => [get_the_ID()],
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
]);

// ── Jezik (server-side, iz kolačića - sadržaj posta je dinamički iz baze) ────
$lang         = esc_lang();
$post_id      = get_the_ID();
$title_out    = esc_post_title($post_id, $lang);
$excerpt_out  = esc_post_excerpt($post_id, $lang);
$content_out  = esc_post_content($post_id, $lang);
$cat_name_out = $cats ? esc_category_name($cats[0], $lang) : 'Blog';
$words_out    = str_word_count(wp_strip_all_tags($content_out));
$read_min     = max(1, round($words_out / 200));

$T = $lang === 'en' ? [
    'blog'          => 'Blog',
    'continue_reading' => 'Continue reading',
    'all_articles'  => 'All articles',
    'read_min'      => 'min read',
    'share'         => 'Share',
] : [
    'blog'          => 'Blog',
    'continue_reading' => 'Nastavi da čitaš',
    'all_articles'  => 'Svi članci',
    'read_min'      => 'min čitanja',
    'share'         => 'Podeli',
];
?>
<!DOCTYPE html>
<html lang="<?php echo esc_attr($lang); ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo esc_html($title_out); ?> | Escapii Blog</title>
<meta name="description" content="<?php echo esc_attr(wp_trim_words($excerpt_out, 28, '')); ?>">
<?php if ($has_img): ?>
<meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>">
<?php endif; ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<?php wp_head(); ?>
<style>
:root{
  --cream:#faf6ee; --sand:#f4eee1; --paper:#fffdf8;
  --ink:#1a1410; --mute:#6b5d4f; --faint:#a3978a; --line:#e7ddcd;
  --terra:#a85e44; --peach:#c8775a; --teal:#22424a; --teal-deep:#16313a;
  --serif:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;
  --display:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;
  --sans:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;
  /* nav vars */
  --gray:#7A9FA8; --white-nav:#2D5F6B; --accent:#CA8A71; --gold:#CA8A71; --gold2:#b87a62;
}
*{box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{
  margin:0; background:var(--cream); color:var(--ink);
  font-family:var(--serif); -webkit-font-smoothing:antialiased;
  text-rendering:optimizeLegibility;
}
img{max-width:100%; display:block;}
a{color:inherit;}

/* ---------- reading progress ---------- */
.progress{position:fixed; top:0; left:0; height:3px; width:0%;
  background:linear-gradient(90deg,var(--peach),var(--terra)); z-index:60;
  transition:width .12s linear;}

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
.nav-status:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.22); color: #fff; }
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

/* ---------- hero ---------- */
.hero{position:relative; max-width:1180px; margin:0 auto; padding:144px 40px 0;}
.hero-card{position:relative; border-radius:24px; overflow:hidden;
  background:var(--teal-deep); aspect-ratio:16/8.4; min-height:440px;
  box-shadow:0 40px 80px -40px rgba(22,49,58,.5);}
.hero-card .hero-img{position:absolute; inset:0; width:100%; height:100%; object-fit:cover;}
.hero-card .hero-placeholder{position:absolute; inset:0; background:radial-gradient(120% 140% at 20% 10%, #2f5660 0%, #1d3b43 45%, #16313a 100%);}
.hero-card::after{content:""; position:absolute; inset:0; z-index:2;
  background:linear-gradient(180deg, rgba(16,25,28,.15) 0%, rgba(16,25,28,.30) 45%, rgba(13,22,25,.86) 100%);
  pointer-events:none;}
.hero-inner{position:absolute; z-index:3; left:0; right:0; bottom:0; padding:48px 56px;}
/* Responsive hero overrides */
@media(max-width:900px){
  .hero{padding:88px 16px 0;}
  .hero-card{aspect-ratio:16/10; min-height:320px; border-radius:16px;}
  .hero-inner{padding:28px 28px;}
  h1.title{font-size:clamp(22px,6vw,38px);}
}
@media(max-width:560px){
  .hero-card{aspect-ratio:unset; min-height:380px;}
  .hero-inner{padding:20px 20px;}
  .crumb{display:none;}
  h1.title{font-size:24px; letter-spacing:-.5px; line-height:1.15;}
  .hero-meta{gap:10px; font-size:12px;}
  .author-avatar{width:32px; height:32px;}
}
.crumb{font-family:var(--sans); font-size:12px; letter-spacing:.5px; color:rgba(255,255,255,.7);
  display:flex; align-items:center; gap:8px; margin-bottom:22px;}
.crumb a{text-decoration:none; opacity:.85;}
.crumb a:hover{opacity:1; color:#fff;}
.crumb .sep{opacity:.4;}
.cat-pill{display:inline-flex; align-items:center; gap:8px;
  font-family:var(--sans); font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase;
  color:#fbe3d6; background:rgba(200,119,90,.22); border:1px solid rgba(200,119,90,.5);
  padding:7px 15px; border-radius:100px; margin-bottom:20px; backdrop-filter:blur(4px); text-decoration:none;}
.cat-pill::before{content:""; width:6px; height:6px; border-radius:50%; background:var(--peach);}
h1.title{font-family:var(--display); font-weight:600; color:#fff;
  font-size:clamp(28px,4.4vw,56px); line-height:1.06; letter-spacing:-1px;
  margin:0; max-width:20ch; text-wrap:balance; text-shadow:0 2px 30px rgba(0,0,0,.3);}
.hero-meta{display:flex; align-items:center; gap:18px; margin-top:26px;
  font-family:var(--sans); font-size:13.5px; color:rgba(255,255,255,.82); flex-wrap:wrap;}
.author{display:flex; align-items:center; gap:11px;}
.author-avatar{width:42px; height:42px; border-radius:50%; object-fit:cover;
  border:2px solid rgba(255,255,255,.5); flex:none; overflow:hidden; background:rgba(255,255,255,.1);}
.author b{color:#fff; font-weight:600;}
.author small{display:block; font-size:11.5px; color:rgba(255,255,255,.62); font-weight:400;}
.hero-meta .dot{width:4px; height:4px; border-radius:50%; background:rgba(255,255,255,.45); flex-shrink:0;}

/* ---------- article shell ---------- */
.shell{max-width:1180px; margin:0 auto; padding:0 40px;
  display:grid; grid-template-columns:64px 1fr 64px;}
.rail{padding-top:64px;}
.rail-sticky{position:sticky; top:96px; display:flex; flex-direction:column; gap:12px; align-items:center;}
.rail-label{font-family:var(--sans); font-size:10px; letter-spacing:1.5px; text-transform:uppercase;
  color:var(--faint); writing-mode:vertical-rl; transform:rotate(180deg); margin-bottom:6px;}
.share-btn{width:42px; height:42px; border-radius:50%; border:1px solid var(--line);
  background:var(--paper); color:var(--mute); display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:all .2s; text-decoration:none;}
.share-btn:hover{color:#fff; background:var(--terra); border-color:var(--terra); transform:translateY(-2px);
  box-shadow:0 8px 18px -8px rgba(168,94,68,.7);}
.share-btn svg{width:17px; height:17px;}

.article{padding:64px 4.5%; min-width:0;}
.lede{font-family:var(--serif); font-size:22px; line-height:1.55; color:var(--mute);
  font-style:italic; margin:0 0 38px; max-width:40ch; font-weight:400;}

.body{font-size:19.5px; line-height:1.75; color:#2b231b; max-width:66ch;}
.body p{margin:0 0 26px;}
.body > p:first-of-type::first-letter{
  font-family:var(--display); font-weight:600; float:left; font-size:80px; line-height:.78;
  padding:6px 14px 0 0; color:var(--terra);}
.body h2{font-family:var(--display); font-weight:600; font-size:31px; line-height:1.2;
  letter-spacing:-.4px; margin:48px 0 16px; color:var(--ink);}
.body h3{font-family:var(--sans); font-weight:700; font-size:15px; letter-spacing:1.5px;
  text-transform:uppercase; color:var(--terra); margin:40px 0 12px;}
.body a{color:var(--terra); text-decoration:underline; text-decoration-thickness:1px;
  text-underline-offset:3px; text-decoration-color:rgba(168,94,68,.4); transition:.2s;}
.body a:hover{text-decoration-color:var(--terra);}
.body strong{font-weight:600; color:var(--ink);}
.body ul{list-style:none; padding:0; margin:0 0 26px;}
.body ul li{position:relative; padding-left:30px; margin-bottom:13px;}
.body ul li::before{content:""; position:absolute; left:6px; top:13px;
  width:7px; height:7px; border-radius:50%; background:var(--peach);}
.body blockquote{margin:40px 0; padding:6px 0 6px 34px; border-left:3px solid var(--terra);
  font-family:var(--display); font-style:italic; font-size:27px; line-height:1.4;
  color:var(--ink); font-weight:500; max-width:60ch;}
.body blockquote footer{font-family:var(--sans); font-style:normal; font-size:13px; font-weight:600;
  color:var(--faint); letter-spacing:.5px; margin-top:14px;}
.body figure{margin:44px 0;}
.body figure img{width:100%; border-radius:14px; object-fit:cover;}
.body figcaption{font-family:var(--sans); font-size:12.5px; color:var(--faint); margin-top:12px;
  padding-left:16px; border-left:2px solid var(--line);}
.body img{border-radius:14px;}

.tags{display:flex; flex-wrap:wrap; gap:10px; margin:46px 0 0; max-width:66ch;}
.tag{font-family:var(--sans); font-size:12px; font-weight:500; color:var(--mute);
  background:var(--sand); border:1px solid var(--line); padding:7px 14px; border-radius:100px;
  text-decoration:none; transition:.2s;}
.tag:hover{border-color:var(--terra); color:var(--terra);}


/* ── Mobile share bar (vidljivo samo ispod 900px) ── */
.mob-share{display:none; align-items:center; gap:12px; max-width:66ch;
  margin-top:40px; padding:16px 20px; background:var(--paper);
  border:1px solid var(--line); border-radius:16px;}
.mob-share-label{font-family:var(--sans); font-size:11px; font-weight:700; letter-spacing:1.5px;
  text-transform:uppercase; color:var(--faint); white-space:nowrap;}
.mob-share-btns{display:flex; gap:10px; flex:1; justify-content:flex-end;}
.mob-share-btn{width:42px; height:42px; border-radius:50%; border:1px solid var(--line);
  background:var(--cream); color:var(--mute); display:flex; align-items:center; justify-content:center;
  cursor:pointer; transition:all .2s; text-decoration:none; flex-shrink:0; font-family:inherit;}
.mob-share-btn:hover,.mob-share-btn:active{color:#fff; background:var(--terra); border-color:var(--terra);}
.mob-share-btn svg{width:17px; height:17px;}
@media(max-width:900px){ .mob-share{display:flex;} }

/* ---------- related ---------- */
.related{background:var(--sand); border-top:1px solid var(--line); margin-top:80px; padding:72px 0 88px;}
.related-wrap{max-width:1180px; margin:0 auto; padding:0 40px;}
.related-head{display:flex; align-items:baseline; justify-content:space-between; margin-bottom:36px;}
.related-head h2{font-family:var(--display); font-weight:600; font-size:30px; margin:0; letter-spacing:-.5px;}
.related-head a{font-family:var(--sans); font-size:13px; font-weight:600; color:var(--terra);
  text-decoration:none; display:inline-flex; align-items:center; gap:7px;}
.related-head a svg{width:15px; height:15px;}
.cards{display:grid; grid-template-columns:repeat(3,1fr); gap:26px;}
.card{background:var(--paper); border:1px solid var(--line); border-radius:18px; overflow:hidden;
  text-decoration:none; transition:transform .25s, box-shadow .25s; display:flex; flex-direction:column; color:var(--ink);}
.card:hover{transform:translateY(-5px); box-shadow:0 26px 50px -28px rgba(26,20,16,.32);}
.card-img{width:100%; height:188px; object-fit:cover; display:block;}
.card-img-placeholder{width:100%; height:188px; background:linear-gradient(135deg,#2f5660,#16313a);}
.card-body{padding:22px 22px 26px; flex:1;}
.card .c-cat{font-family:var(--sans); font-size:10.5px; font-weight:700; letter-spacing:1.5px;
  text-transform:uppercase; color:var(--terra); margin-bottom:10px;}
.card h3{font-family:var(--display); font-weight:600; font-size:21px; line-height:1.22; margin:0 0 12px;
  color:var(--ink); letter-spacing:-.3px;}
.card .c-meta{font-family:var(--sans); font-size:12px; color:var(--faint);
  display:flex; align-items:center; gap:8px;}

/* ---------- footer (identičan početnoj) ---------- */
.esc-footer{background:#EFE9E7; padding:64px 64px 28px; border-top:1px solid rgba(15,45,53,.07);}
.footer-main{display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:48px; margin-bottom:56px;}
.footer-brand p{font-size:14px; color:#7A9FA8; line-height:1.75; margin-top:16px; max-width:280px;}
.footer-col h4{font-family:var(--sans); font-size:11px; font-weight:800; color:#2D5F6B; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:18px;}
.footer-col a{display:block; font-size:14px; color:#7A9FA8; text-decoration:none; margin-bottom:10px; transition:color .2s;}
.footer-col a:hover{color:#CA8A71;}
.footer-social{margin-top:28px;}
.footer-social h4{font-size:11px; font-weight:800; color:#2D5F6B; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:16px; font-family:var(--sans);}
.social-icons{display:flex; gap:12px;}
.social-icon{width:40px; height:40px; border-radius:10px; background:rgba(15,45,53,.06); border:1px solid rgba(15,45,53,.1); display:flex; align-items:center; justify-content:center; color:#7A9FA8; text-decoration:none; transition:all .2s;}
.social-icon:hover{background:#CA8A71; border-color:#CA8A71; color:#fff;}
.social-icon svg{width:18px; height:18px; fill:currentColor;}
.footer-divider{height:1px; background:rgba(15,45,53,.08); margin-bottom:24px;}
.footer-bottom{display:flex; justify-content:space-between; align-items:center; font-family:var(--sans); font-size:13px; color:#7A9FA8; flex-wrap:wrap; gap:12px;}
.footer-bottom-links{display:flex; gap:24px;}
.footer-bottom-links a{color:#7A9FA8; text-decoration:none; font-size:13px; transition:color .2s;}
.footer-bottom-links a:hover{color:#2D5F6B;}

@media(max-width:900px){
  .nav{padding:16px 20px;}
  .shell{grid-template-columns:1fr; padding:0 20px;}
  .rail{display:none;}
  .article{padding:44px 0;}
  .body,.lede,.tags,.author-card{max-width:none;}
  .body blockquote{max-width:none;}
  .cards{grid-template-columns:1fr;}
  .footer-main{grid-template-columns:1fr 1fr; gap:32px;}
  .esc-footer{padding:48px 24px 24px;}
  .footer-bottom{flex-direction:column; text-align:center;}
  .footer-bottom-links{flex-wrap:wrap; justify-content:center; gap:16px;}
  .related-wrap{padding:0 20px;}
  .sp-img-wrap{padding:0 16px; margin:-20px auto 0;}
  .sp-body{padding:36px 20px 72px;}
}
@media(max-width:560px){
  .related-head{flex-direction:column; gap:14px; align-items:flex-start;}
  .body{font-size:17px;}
  .lede{font-size:18px;}
  .sp-hd-back span{display:none;}

}
</style>
</head>
<body>
<div class="progress" id="progress"></div>

<?php $site_url = home_url(); include get_template_directory() . '/inc/subpage-nav.php'; ?>

<!-- HERO -->
<header class="hero">
  <div class="hero-card">
    <?php if ($has_img): ?>
      <?php the_post_thumbnail('full', ['class' => 'hero-img']); ?>
    <?php else: ?>
      <div class="hero-placeholder"></div>
    <?php endif; ?>
    <div class="hero-inner">
      <div class="crumb">
        <a href="<?php echo home_url('/blog'); ?>"><?php echo esc_html($T['blog']); ?></a>
        <span class="sep">/</span>
        <a href="<?php echo $cat_link; ?>"><?php echo esc_html($cat_name_out); ?></a>
      </div>
      <a href="<?php echo $cat_link; ?>" class="cat-pill"><?php echo esc_html($cat_name_out); ?></a>
      <h1 class="title"><?php echo esc_html($title_out); ?></h1>
      <div class="hero-meta">
        <span><?php echo esc_post_date('d. F Y.', 'M d, Y', null, $lang); ?></span>
        <span class="dot"></span>
        <span><?php echo $read_min; ?> <?php echo esc_html($T['read_min']); ?></span>
      </div>
    </div>
  </div>
</header>

<!-- ARTICLE -->
<div class="shell">
  <aside class="rail">
    <div class="rail-sticky">
      <span class="rail-label"><?php echo esc_html($T['share']); ?></span>
      <a class="share-btn" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" aria-label="Facebook">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 9H16V6h-2.5C11.6 6 10 7.6 10 9.5V11H8v3h2v7h3v-7h2.2l.8-3H13V9.4c0-.3.2-.4.5-.4z"/></svg>
      </a>
      <button class="share-btn" aria-label="Podeli na Instagram" id="shareIG" type="button">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
      </button>
      <a class="share-btn" href="#" aria-label="Kopiraj link" id="copyLink">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1.5 1.5"></path><path d="M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1.5-1.5"></path></svg>
      </a>
    </div>
  </aside>

  <article class="article">
    <?php if ($excerpt_out): ?>
    <p class="lede"><?php echo esc_html($excerpt_out); ?></p>
    <?php endif; ?>

    <div class="body">
      <?php echo $content_out; ?>
    </div>

    <?php if ($tags): ?>
    <div class="tags">
      <?php foreach ($tags as $tag): ?>
        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag">#<?php echo esc_html($tag->name); ?></a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Mobile share bar - vidljivo samo na mobilnom -->
    <div class="mob-share">
      <span class="mob-share-label"><?php echo esc_html($T['share']); ?></span>
      <div class="mob-share-btns">
        <a class="mob-share-btn"
           href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
           target="_blank" rel="noopener" aria-label="Facebook">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 9H16V6h-2.5C11.6 6 10 7.6 10 9.5V11H8v3h2v7h3v-7h2.2l.8-3H13V9.4c0-.3.2-.4.5-.4z"/></svg>
        </a>
        <button class="mob-share-btn" aria-label="Podeli na Instagram" id="mobShareIG" type="button">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
        </button>
        <button class="mob-share-btn" aria-label="Kopiraj link" id="mobCopyLink" type="button">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1.5 1.5"></path><path d="M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1.5-1.5"></path></svg>
        </button>
      </div>
    </div>

  </article>

  <div class="rail"></div>
</div>

<!-- RELATED POSTS -->
<?php if ($related->have_posts()): ?>
<section class="related">
  <div class="related-wrap">
    <div class="related-head">
      <h2><?php echo esc_html($T['continue_reading']); ?></h2>
      <a href="<?php echo home_url('/blog'); ?>"><?php echo esc_html($T['all_articles']); ?>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
      </a>
    </div>
    <div class="cards">
      <?php while ($related->have_posts()): $related->the_post();
        $rel_id   = get_the_ID();
        $rel_cats = get_the_category();
        $rel_cat  = $rel_cats ? esc_category_name($rel_cats[0], $lang) : '';
        $rel_words = str_word_count(wp_strip_all_tags(esc_post_content($rel_id, $lang)));
        $rel_read  = max(1, round($rel_words / 200));
      ?>
      <a href="<?php the_permalink(); ?>" class="card">
        <?php if (has_post_thumbnail()): ?>
          <?php the_post_thumbnail('medium_large', ['class' => 'card-img']); ?>
        <?php else: ?>
          <div class="card-img-placeholder"></div>
        <?php endif; ?>
        <div class="card-body">
          <?php if ($rel_cat): ?><div class="c-cat"><?php echo esc_html($rel_cat); ?></div><?php endif; ?>
          <h3><?php echo esc_html(esc_post_title($rel_id, $lang)); ?></h3>
          <div class="c-meta">
            <span><?php echo esc_post_date('d.m.Y.', 'm/d/Y', null, $lang); ?></span>
            <span>·</span>
            <span><?php echo $rel_read; ?> <?php echo esc_html($T['read_min']); ?></span>
          </div>
        </div>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- FOOTER -->
<?php include get_template_directory() . '/inc/footer.php'; ?>

<?php wp_footer(); ?>
<script>
// Jezik ove stranice je odlučen server-side (kolačić 'esc-lang') jer je sadržaj
// posta dinamički iz baze - JS ga ne može prevesti kao statički UI tekst.
// Nav (inc/subpage-nav.php) je deljen fajl sa data-i18n atributima - njega i dalje
// prevodimo client-side, isto kao na FAQ/Pokloni/Utisci/Blog stranicama.
var lang = '<?php echo esc_js($lang); ?>';
const NAV_I18N_EN = {
  'nav.status':'My reservation',
  'snav.how':'How it works', 'snav.about':'About us', 'snav.dest':'Destinations',
  'snav.who':'Who\'s it for', 'snav.faq':'FAQ', 'snav.blog':'Blog',
  'snav.call':'✉ Contact us', 'snav.call.hours':'escapii.team@gmail.com',
  'snav.book':'Book now', 'snav.book.cta':'Book now →',
  'nav.gift.label':'Gift a Surprise Trip', 'nav.gift.offer':'Gift a Surprise Trip',
  'nav.gift.offer.sub':'Gift the perfect present for a travel lover',
  'nav.gift.redeem':'Redeem gift', 'nav.gift.redeem.sub':'Have a gift code? Activate it here'
};
const NAV_I18N_SR = {};
document.querySelectorAll('[data-i18n]').forEach(function(el) {
  NAV_I18N_SR[el.getAttribute('data-i18n')] = el.textContent;
});
function applyLang() {
  var dict = lang === 'en' ? NAV_I18N_EN : NAV_I18N_SR;
  document.querySelectorAll('[data-i18n]').forEach(function(el) {
    var k = el.getAttribute('data-i18n');
    if (dict[k] !== undefined) el.textContent = dict[k];
  });
  document.querySelectorAll('.lang-btn').forEach(function(b) {
    b.classList.toggle('on', b.textContent.trim() === lang.toUpperCase());
  });
}
function setLang(l) {
  if (l === lang) return;
  document.cookie = 'esc-lang=' + l + ';path=/;max-age=31536000;SameSite=Lax';
  localStorage.setItem('esc-lang', l);
  location.reload();
}
(function() {
  var stored = localStorage.getItem('esc-lang');
  if (stored && stored !== lang) {
    document.cookie = 'esc-lang=' + stored + ';path=/;max-age=31536000;SameSite=Lax';
    location.reload();
  }
})();
applyLang();
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

var progress=document.getElementById('progress');
var article=document.querySelector('.article');
function onScroll(){
  var start=article.offsetTop;
  var end=start+article.offsetHeight-window.innerHeight;
  var p=Math.min(1,Math.max(0,(window.scrollY-start)/(end-start)));
  progress.style.width=(p*100)+'%';
}
window.addEventListener('scroll',onScroll,{passive:true});
onScroll();

// Instagram - Web Share API na mobilnom (otvara native share sheet + Instagram Stories)
// Na desktopu fallback: kopiraj link
document.getElementById('shareIG').addEventListener('click', function(e) {
  e.preventDefault();
  var url   = location.href;
  var title = document.title;
  if (navigator.share) {
    navigator.share({ title: title, url: url }).catch(function(){});
  } else {
    window.open('https://www.instagram.com/escapii.rs', '_blank');
  }
});

// Mobile share dugmad
document.getElementById('mobShareIG').addEventListener('click', function(e) {
  e.preventDefault();
  if (navigator.share) { navigator.share({ title: document.title, url: location.href }).catch(function(){}); }
  else { window.open('https://www.instagram.com/escapii.rs', '_blank'); }
});
document.getElementById('mobCopyLink').addEventListener('click', function(e) {
  e.preventDefault();
  if (navigator.clipboard) navigator.clipboard.writeText(location.href);
  var b = this; b.style.background='#a85e44'; b.style.color='#fff'; b.style.borderColor='#a85e44';
  setTimeout(function(){ b.style.background=''; b.style.color=''; b.style.borderColor=''; }, 1200);
});

document.getElementById('copyLink').addEventListener('click',function(e){
  e.preventDefault();
  if(navigator.clipboard) navigator.clipboard.writeText(location.href);
  var b=this; b.style.background='#a85e44'; b.style.color='#fff'; b.style.borderColor='#a85e44';
  setTimeout(function(){ b.style.background=''; b.style.color=''; b.style.borderColor=''; },1200);
});
</script>
</body>
</html>
