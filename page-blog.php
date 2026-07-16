<?php
/**
 * Template Name: Blog
 *
 * Listanje blog postova. Dodaj postove u WP Admin → Posts → Add New.
 */

// Paginacija
$paged = max(1, get_query_var('paged') ?: (get_query_var('page') ?: 1));

// Filtriranje po kategoriji iz URL-a (?cat=ID)
$cat_filter = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;

$args = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 7,   // 1 featured + 6 grid
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
];
if ($cat_filter) $args['cat'] = $cat_filter;

$q = new WP_Query($args);
$total_pages = $q->max_num_pages;
$total_posts = $q->found_posts;

// Sve kategorije sa postovima
$all_cats = get_categories(['hide_empty' => true, 'orderby' => 'count', 'order' => 'DESC']);

// Helper: broj reči → vreme čitanja
function bl_read_time($post_id) {
    $content = get_post_field('post_content', $post_id);
    return max(1, round(str_word_count(wp_strip_all_tags($content)) / 200));
}
?>
<!DOCTYPE html>
<html lang="sr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Blog o putovanjima iznenađenja | Escapii</title>
<meta name="description" content="Priče sa naših iznenađenja i sve što treba da znaš pre polaska.">
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
  /* footer vars */
  --gray:#7A9FA8; --white-nav:#2D5F6B; --accent:#CA8A71;
  --gold:#CA8A71; --gold2:#b87a62;
}
*{box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{margin:0; background:var(--cream); color:var(--ink);
  font-family:var(--serif); -webkit-font-smoothing:antialiased; text-rendering:optimizeLegibility;}
img{max-width:100%; display:block;}
a{color:inherit;}

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
.hero{position:relative; overflow:hidden; text-align:center; padding:142px 24px 120px;
  background:url('https://images.unsplash.com/photo-1452421822248-d4c2b47f0c81?w=1920&q=80&auto=format&fit=crop') center/cover no-repeat var(--teal-deep);}
.hero::before{content:""; position:absolute; inset:0;
  background:rgba(10,30,38,.72);}
.hero::after{content:""; position:absolute; inset:0; opacity:.25;
  background-image:radial-gradient(rgba(255,255,255,.07) 1px, transparent 1px); background-size:26px 26px;}
.hero-content{position:relative; z-index:2; max-width:760px; margin:0 auto;}
.hero-pill{display:inline-flex; align-items:center; gap:9px; font-family:var(--sans);
  font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#fbe3d6;
  background:rgba(200,119,90,.18); border:1px solid rgba(200,119,90,.45);
  padding:8px 16px; border-radius:100px; margin-bottom:26px;}
.hero-pill svg{width:14px; height:14px;}
.hero h1{font-family:var(--display); font-weight:600; color:#fff; margin:0 0 18px;
  font-size:clamp(40px,5.4vw,68px); line-height:1.04; letter-spacing:-1.5px; text-wrap:balance;}
.hero h1 em{font-style:italic; color:#f0c3ae;}
.hero p{font-family:var(--serif); font-size:19px; line-height:1.6; color:rgba(255,255,255,.72); margin:0 auto; max-width:48ch;}

/* ---------- filters ---------- */
.filters{position:relative; z-index:3; max-width:1180px; margin:-34px auto 0; padding:0 40px;
  display:flex; flex-wrap:wrap; gap:10px; justify-content:center;}
.chip{font-family:var(--sans); font-size:13px; font-weight:500; color:var(--mute);
  background:var(--paper); border:1px solid var(--line); padding:11px 20px; border-radius:100px;
  cursor:pointer; text-decoration:none; transition:all .2s; box-shadow:0 6px 18px -10px rgba(26,20,16,.25);}
.chip:hover{color:var(--ink); border-color:var(--terra);}
.chip.active{background:var(--ink); color:#fff; border-color:var(--ink);}

/* ---------- layout ---------- */
.wrap{max-width:1180px; margin:0 auto; padding:56px 40px 0;}
.sec-label{display:flex; align-items:baseline; gap:16px; margin:0 0 28px;}
.sec-label h2{font-family:var(--display); font-weight:600; font-size:26px; margin:0; letter-spacing:-.5px;}
.sec-label .ln{flex:1; height:1px; background:var(--line);}
.sec-label .count{font-family:var(--sans); font-size:12px; color:var(--faint); letter-spacing:.5px;}

/* featured */
.featured{display:grid; grid-template-columns:1.15fr 1fr; gap:0; background:var(--paper);
  border:1px solid var(--line); border-radius:22px; overflow:hidden; margin-bottom:64px;
  box-shadow:0 30px 60px -36px rgba(26,20,16,.3); text-decoration:none; color:var(--ink);}
.featured .f-img{position:relative; min-height:380px; background:var(--teal-deep);}
.featured .f-img img{position:absolute; inset:0; width:100%; height:100%; object-fit:cover;}
.featured .f-img-placeholder{position:absolute; inset:0; background:radial-gradient(120% 140% at 25% 15%, #2f5660 0%, #1d3b43 48%, #16313a 100%);}
.featured .f-tag{position:absolute; top:20px; left:20px; z-index:2;
  font-family:var(--sans); font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;
  color:#fff; background:rgba(168,94,68,.92); padding:7px 14px; border-radius:100px; backdrop-filter:blur(4px);}
.featured .f-body{padding:46px 48px; display:flex; flex-direction:column; justify-content:center;}
.featured .f-eyebrow{font-family:var(--sans); font-size:11px; font-weight:700; letter-spacing:2px;
  text-transform:uppercase; color:var(--terra); margin-bottom:16px;}
.featured h3{font-family:var(--display); font-weight:600; font-size:34px; line-height:1.14;
  letter-spacing:-.6px; margin:0 0 18px; color:var(--ink);}
.featured .f-excerpt{font-size:17px; line-height:1.65; color:var(--mute); margin:0 0 28px; max-width:46ch;}
.featured .f-meta{display:flex; align-items:center; gap:12px; font-family:var(--sans); font-size:13px;
  color:var(--faint); margin-bottom:28px;}
.featured .f-meta .av{width:34px; height:34px; border-radius:50%; overflow:hidden; background:var(--sand); flex:none; display:flex; align-items:center; justify-content:center;}
.featured .f-meta .av img{width:100%; height:100%; object-fit:cover;}
.featured .f-meta b{color:var(--ink); font-weight:600;}
.featured .f-meta .dot{width:3px; height:3px; border-radius:50%; background:var(--faint);}
.featured:hover .f-img img{transform:scale(1.03); transition:transform .5s ease;}
.read-link{font-family:var(--sans); font-size:14px; font-weight:600; color:var(--terra);
  text-decoration:none; display:inline-flex; align-items:center; gap:9px; align-self:flex-start;}
.read-link svg{width:16px; height:16px; transition:transform .2s;}
.featured:hover .read-link svg{transform:translateX(4px);}

/* grid cards */
.cards{display:grid; grid-template-columns:repeat(3,1fr); gap:28px;}
.card{background:var(--paper); border:1px solid var(--line); border-radius:18px; overflow:hidden;
  text-decoration:none; display:flex; flex-direction:column; transition:transform .25s, box-shadow .25s; color:var(--ink);}
.card:hover{transform:translateY(-6px); box-shadow:0 28px 54px -30px rgba(26,20,16,.34);}
.card .c-img{position:relative; height:200px; background:var(--teal-deep);}
.card .c-img img{position:absolute; inset:0; width:100%; height:100%; object-fit:cover;}
.card .c-img-placeholder{position:absolute; inset:0; background:radial-gradient(120% 140% at 25% 15%, #2f5660 0%, #1d3b43 48%, #16313a 100%);}
.card .c-cat-abs{position:absolute; top:14px; left:14px; font-family:var(--sans); font-size:10px;
  font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:#fff;
  background:rgba(26,20,16,.55); backdrop-filter:blur(6px); padding:6px 12px; border-radius:100px; z-index:1;}
.card-body{padding:22px 24px 26px; display:flex; flex-direction:column; flex:1;}
.card h3{font-family:var(--display); font-weight:600; font-size:22px; line-height:1.2; margin:0 0 12px; color:var(--ink); letter-spacing:-.3px;}
.card .c-excerpt{font-size:15px; line-height:1.6; color:var(--mute); margin:0 0 20px; flex:1;
  display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;}
.card .c-meta{display:flex; align-items:center; gap:9px; font-family:var(--sans); font-size:12px;
  color:var(--faint); padding-top:16px; border-top:1px solid var(--line);}
.card .c-meta .av{width:26px; height:26px; border-radius:50%; overflow:hidden; background:var(--sand); flex:none;}
.card .c-meta .av img{width:100%; height:100%; object-fit:cover;}
.card .c-meta b{color:var(--ink); font-weight:600;}
.card .c-meta .dot{width:3px; height:3px; border-radius:50%; background:var(--faint);}

/* empty */
/* empty state */
@keyframes floatUp{0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);}}
@keyframes fadeInUp{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
@keyframes shimmer{0%,100%{opacity:.4;} 50%{opacity:1;}}
.bl-empty{text-align:center; padding:100px 24px 120px;}
.bl-empty-icon{font-size:56px; display:block; margin-bottom:28px; animation:floatUp 3s ease-in-out infinite;}
.bl-empty h2{font-family:var(--display); font-size:36px; font-weight:600; color:var(--ink); margin:0 0 14px; letter-spacing:-.5px; animation:fadeInUp .6s ease both .1s; opacity:0;}
.bl-empty p{font-family:var(--sans); font-size:15px; color:var(--faint); margin:0 auto 40px; max-width:36ch; line-height:1.65; animation:fadeInUp .6s ease both .2s; opacity:0;}
.bl-empty-dots{display:flex; justify-content:center; gap:8px; animation:fadeInUp .6s ease both .3s; opacity:0;}
.bl-empty-dots span{width:8px; height:8px; border-radius:50%; background:var(--terra); animation:shimmer 1.4s ease-in-out infinite;}
.bl-empty-dots span:nth-child(2){animation-delay:.2s;}
.bl-empty-dots span:nth-child(3){animation-delay:.4s;}

/* pagination */
.bl-pag{display:flex; justify-content:center; gap:8px; margin:48px 0 0; flex-wrap:wrap;}
.bl-pag a,.bl-pag span{display:inline-flex; align-items:center; justify-content:center;
  min-width:40px; height:40px; padding:0 14px; border-radius:100px; font-family:var(--sans);
  font-size:13px; font-weight:600; text-decoration:none; border:1px solid var(--line); transition:all .15s;}
.bl-pag a{color:var(--ink); background:var(--paper);}
.bl-pag a:hover{background:var(--terra); color:#fff; border-color:var(--terra);}
.bl-pag span.current{background:var(--ink); color:#fff; border-color:var(--ink);}
.bl-pag span.dots{background:none; border:none; color:var(--faint);}

/* newsletter */
.news{margin:88px 0 0; background:var(--ink); border-radius:26px; overflow:hidden; position:relative; padding:64px 56px; text-align:center;}
.news::before{content:""; position:absolute; inset:0; background:radial-gradient(50% 120% at 50% 0%, rgba(200,119,90,.25), transparent 70%);}
.news-in{position:relative; z-index:2; max-width:520px; margin:0 auto;}
.news .n-eyebrow{font-family:var(--sans); font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--peach); margin-bottom:16px;}
.news h2{font-family:var(--display); font-weight:600; color:#fff; font-size:34px; line-height:1.15; letter-spacing:-.5px; margin:0 0 14px;}
.news p{font-size:16px; line-height:1.6; color:rgba(255,255,255,.68); margin:0 0 28px;}
.news form{display:flex; gap:10px; max-width:420px; margin:0 auto;}
.news input{flex:1; font-family:var(--sans); font-size:14px; padding:14px 20px; border-radius:100px;
  border:1px solid rgba(255,255,255,.18); background:rgba(255,255,255,.06); color:#fff; outline:none;}
.news input::placeholder{color:rgba(255,255,255,.5);}
.news input:focus{border-color:var(--peach);}
.news button{font-family:var(--sans); font-size:14px; font-weight:600; color:#fff; cursor:pointer;
  padding:14px 26px; border:none; border-radius:100px; background:var(--terra); transition:.2s; white-space:nowrap;}
.news button:hover{background:var(--peach);}

/* ---------- footer (identičan početnoj) ---------- */
.esc-footer{background:#EFE9E7; padding:64px 64px 28px; border-top:1px solid rgba(15,45,53,.07); margin-top:88px;}
.footer-main{display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:48px; margin-bottom:56px;}
.footer-brand p{font-size:14px; color:var(--gray); line-height:1.75; margin-top:16px; max-width:280px;}
.footer-col h4{font-family:var(--sans); font-size:11px; font-weight:800; color:var(--white-nav); letter-spacing:1.5px; text-transform:uppercase; margin-bottom:18px;}
.footer-col a{display:block; font-size:14px; color:var(--gray); text-decoration:none; margin-bottom:10px; transition:color .2s;}
.footer-col a:hover{color:var(--accent);}
.footer-social{margin-top:28px;}
.footer-social h4{font-size:11px; font-weight:800; color:var(--white-nav); letter-spacing:1.5px; text-transform:uppercase; margin-bottom:16px; font-family:var(--sans);}
.social-icons{display:flex; gap:12px;}
.social-icon{width:40px; height:40px; border-radius:10px; background:rgba(15,45,53,.06); border:1px solid rgba(15,45,53,.1); display:flex; align-items:center; justify-content:center; color:var(--gray); text-decoration:none; transition:all .2s;}
.social-icon:hover{background:var(--accent); border-color:var(--accent); color:#fff;}
.social-icon svg{width:18px; height:18px; fill:currentColor;}
.footer-divider{height:1px; background:rgba(15,45,53,.08); margin-bottom:24px;}
.footer-bottom{display:flex; justify-content:space-between; align-items:center; font-family:var(--sans); font-size:13px; color:var(--gray); flex-wrap:wrap; gap:12px;}
.footer-bottom-links{display:flex; gap:24px;}
.footer-bottom-links a{color:var(--gray); text-decoration:none; font-size:13px; transition:color .2s;}
.footer-bottom-links a:hover{color:var(--white-nav);}

@media(max-width:900px){
  .nav{padding:16px 20px;}
  .hero{padding:64px 20px 96px;}
  .filters{padding:0 20px;}
  .wrap{padding:48px 20px 0;}
  .featured{grid-template-columns:1fr;}
  .featured .f-img{min-height:240px;}
  .featured .f-body{padding:32px 28px;}
  .cards{grid-template-columns:1fr 1fr;}
  .news{padding:48px 26px; border-radius:0; margin-left:-20px; margin-right:-20px;}
  .footer-main{grid-template-columns:1fr 1fr; gap:32px;}
  .esc-footer{padding:48px 24px 24px;}
  .footer-bottom{flex-direction:column; text-align:center;}
  .footer-bottom-links{flex-wrap:wrap; justify-content:center; gap:16px;}
}
@media(max-width:600px){
  .cards{grid-template-columns:1fr;}
  .news form{flex-direction:column;}
}
</style>
</head>
<body>

<?php include get_template_directory() . '/inc/subpage-nav.php'; ?>

<!-- HERO -->
<header class="hero">
  <div class="hero-content">
    <span class="hero-pill">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.586 7.586"></path><circle cx="11" cy="11" r="2"></circle></svg>
      Escapii Blog
    </span>
    <h1>Putovanja, saveti <em>i inspiracija</em></h1>
    <p>Priče sa naših iznenađenja i sve što treba da znaš pre polaska.</p>
  </div>
</header>

<!-- CATEGORY FILTERS -->
<nav class="filters">
  <a href="<?php echo home_url('/blog'); ?>" class="chip <?php echo !$cat_filter ? 'active' : ''; ?>">Sve</a>
  <?php foreach ($all_cats as $cat): ?>
    <a href="<?php echo esc_url(add_query_arg('cat', $cat->term_id, home_url('/blog'))); ?>"
       class="chip <?php echo ($cat_filter === $cat->term_id) ? 'active' : ''; ?>">
      <?php echo esc_html($cat->name); ?>
    </a>
  <?php endforeach; ?>
</nav>

<main class="wrap">

<?php if ($q->have_posts()):
  // ── FEATURED (prvi post) ────────────────────────────────────────────────
  $q->the_post();
  $feat_cats = get_the_category();
  $feat_cat  = $feat_cats ? esc_html($feat_cats[0]->name) : '';
  $feat_read = bl_read_time(get_the_ID());
  $feat_excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 28, '…');
?>

  <div class="sec-label">
    <h2>Izdvojeno</h2><span class="ln"></span>
    <span class="count">Najnoviji članak</span>
  </div>

  <a href="<?php the_permalink(); ?>" class="featured">
    <div class="f-img">
      <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('large'); ?>
      <?php else: ?>
        <div class="f-img-placeholder"></div>
      <?php endif; ?>
      <?php if ($feat_cat): ?><span class="f-tag"><?php echo $feat_cat; ?></span><?php endif; ?>
    </div>
    <div class="f-body">
      <div class="f-eyebrow"><?php echo esc_date_sr('d. F Y.'); ?> · <?php echo $feat_read; ?> min čitanja</div>
      <h3><?php the_title(); ?></h3>
      <p class="f-excerpt"><?php echo esc_html($feat_excerpt); ?></p>
      <span class="read-link">Čitaj članak
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
      </span>
    </div>
  </a>

  <?php if ($q->have_posts()): // ostatak postova u grid ?>
  <div class="sec-label">
    <h2>Najnovije</h2><span class="ln"></span>
    <span class="count"><?php echo $total_posts - 1; ?> <?php echo ($total_posts - 1 === 1) ? 'članak' : 'članaka'; ?></span>
  </div>
  <div class="cards">
    <?php while ($q->have_posts()): $q->the_post();
      $g_cats   = get_the_category();
      $g_cat    = $g_cats ? esc_html($g_cats[0]->name) : '';
      $g_read   = bl_read_time(get_the_ID());
      $g_excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 18, '…');
    ?>
    <a href="<?php the_permalink(); ?>" class="card">
      <div class="c-img">
        <?php if (has_post_thumbnail()): ?>
          <?php the_post_thumbnail('medium_large'); ?>
        <?php else: ?>
          <div class="c-img-placeholder"></div>
        <?php endif; ?>
        <?php if ($g_cat): ?><span class="c-cat-abs"><?php echo $g_cat; ?></span><?php endif; ?>
      </div>
      <div class="card-body">
        <h3><?php the_title(); ?></h3>
        <p class="c-excerpt"><?php echo esc_html($g_excerpt); ?></p>
        <div class="c-meta">
          <span><?php echo get_the_date('d.m.Y.'); ?> · <?php echo $g_read; ?> min</span>
        </div>
      </div>
    </a>
    <?php endwhile; ?>
  </div>
  <?php endif; // end grid ?>

  <?php wp_reset_postdata(); ?>

  <!-- PAGINACIJA -->
  <?php if ($total_pages > 1):
    $current = max(1, $paged);
    $base    = home_url('/blog') . '%_%';
    $format  = strpos($base, '?') !== false ? '&page=%#%' : '/page/%#%';
  ?>
  <div class="bl-pag">
    <?php if ($current > 1): ?>
      <a href="<?php echo get_pagenum_link($current - 1); ?>">‹</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $total_pages; $i++):
      if ($i == $current): ?>
        <span class="current"><?php echo $i; ?></span>
      <?php elseif ($i == 1 || $i == $total_pages || abs($i - $current) <= 1): ?>
        <a href="<?php echo get_pagenum_link($i); ?>"><?php echo $i; ?></a>
      <?php elseif (abs($i - $current) == 2): ?>
        <span class="dots">…</span>
      <?php endif;
    endfor; ?>
    <?php if ($current < $total_pages): ?>
      <a href="<?php echo get_pagenum_link($current + 1); ?>">›</a>
    <?php endif; ?>
  </div>
  <?php endif; ?>

<?php else: ?>
  <div class="bl-empty">
    <span class="bl-empty-icon">✈️</span>
    <h2>Uskoro otkrivamo nešto novo</h2>
    <p>Pripremamo narednu priču sa puta. Vrati se uskoro i budi među prvima koji će je otkriti.</p>
    <div class="bl-empty-dots">
      <span></span><span></span><span></span>
    </div>
  </div>
<?php endif; ?>


</main>

<?php include get_template_directory() . '/inc/footer.php'; ?>

<?php wp_footer(); ?>
<script>
var lang = localStorage.getItem('esc-lang') || 'sr';
function applyLang() {
  document.querySelectorAll('.lang-btn').forEach(function(b) {
    b.classList.toggle('on', b.textContent.trim() === lang.toUpperCase());
  });
}
function setLang(l) {
  lang = l; localStorage.setItem('esc-lang', l); applyLang();
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
applyLang();
</script>
</body>
</html>
