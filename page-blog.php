<?php
/**
 * Template Name: Blog
 *
 * Listanje blog postova. Dodaj postove u WP Admin → Posts → Add New.
 * Stranica se automatski kreira na /blog/ pri aktivaciji teme.
 */
$paged = max(1, get_query_var('paged') ?: (get_query_var('page') ?: 1));
$q = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
$total_pages = $q->max_num_pages;
?>
<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog — Escapii</title>
  <meta name="description" content="Saveti, inspiracija i priče sa naših putovanja iznenađenja.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
  <?php wp_head(); ?>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg:      #EFE9E7;
  --bg2:     #F7F3F0;
  --surface: #FFFFFF;
  --text:    #1a2e34;
  --muted:   #6b8a93;
  --accent:  #CA8A71;
  --accent2: #b07460;
  --border:  rgba(15,45,53,.1);
  --radius:  16px;
  --white:   #2D5F6B;
  --gray:    #7A9FA8;
  --gray2:   #7A9FA8;
}

body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; line-height: 1.6; }

/* ── Header ── */
.bl-header { background: rgba(15,45,53,.96); border-bottom: 1px solid rgba(255,255,255,.06); padding: 16px 0; position: sticky; top: 0; z-index: 100; backdrop-filter: blur(14px); }
.bl-header-inner { max-width: 1100px; margin: 0 auto; padding: 0 24px; display: flex; align-items: center; justify-content: space-between; }
.bl-logo img { height: 38px; width: auto; display: block; }
.bl-back { display: inline-flex; align-items: center; gap: 7px; color: rgba(255,255,255,.65); text-decoration: none; font-size: 13px; font-weight: 600; transition: color .15s; }
.bl-back:hover { color: #fff; }
.bl-back svg { flex-shrink: 0; }

/* ── Hero ── */
.bl-hero { background: #0f2d35; padding: 60px 24px 52px; text-align: center; }
.bl-hero-badge { display: inline-flex; align-items: center; gap: 7px; background: rgba(202,138,113,.15); border: 1px solid rgba(202,138,113,.3); color: var(--accent); font-size: 11px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; padding: 6px 14px; border-radius: 100px; margin-bottom: 20px; }
.bl-hero h1 { font-size: clamp(32px, 5vw, 52px); font-weight: 800; color: #fff; letter-spacing: -.02em; line-height: 1.1; margin-bottom: 14px; }
.bl-hero p { font-size: 16px; color: rgba(255,255,255,.6); max-width: 480px; margin: 0 auto; }

/* ── Grid ── */
.bl-wrap { max-width: 1100px; margin: 0 auto; padding: 48px 24px 80px; }
.bl-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 28px; }

/* ── Card ── */
.bl-card { background: var(--surface); border-radius: var(--radius); overflow: hidden; border: 1px solid var(--border); transition: transform .2s, box-shadow .2s; display: flex; flex-direction: column; }
.bl-card:hover { transform: translateY(-4px); box-shadow: 0 16px 48px rgba(15,45,53,.12); }
.bl-card-img { display: block; aspect-ratio: 16/9; overflow: hidden; background: #d4c8c0; }
.bl-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; display: block; }
.bl-card:hover .bl-card-img img { transform: scale(1.04); }
.bl-card-img-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 48px; background: linear-gradient(135deg, #d4c8c0, #c4b8b0); }
.bl-card-body { padding: 22px 24px 24px; display: flex; flex-direction: column; flex: 1; }
.bl-card-meta { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; flex-wrap: wrap; }
.bl-cat { font-size: 10px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--accent); background: rgba(202,138,113,.1); border: 1px solid rgba(202,138,113,.25); padding: 4px 10px; border-radius: 100px; }
.bl-date { font-size: 12px; color: var(--muted); }
.bl-card-title { font-size: 18px; font-weight: 700; color: var(--text); line-height: 1.35; margin-bottom: 10px; letter-spacing: -.02em; }
.bl-card-title a { color: inherit; text-decoration: none; }
.bl-card-title a:hover { color: var(--accent); }
.bl-card-excerpt { font-size: 14px; color: var(--muted); line-height: 1.65; margin-bottom: 20px; flex: 1; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.bl-read-more { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: var(--accent); text-decoration: none; transition: gap .15s; }
.bl-read-more:hover { gap: 10px; }

/* ── Empty ── */
.bl-empty { text-align: center; padding: 80px 24px; color: var(--muted); }
.bl-empty h2 { font-size: 22px; font-weight: 700; color: var(--text); margin-bottom: 10px; }

/* ── Pagination ── */
.bl-pag { display: flex; justify-content: center; gap: 8px; margin-top: 48px; flex-wrap: wrap; }
.bl-pag a, .bl-pag span { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 10px; font-size: 14px; font-weight: 600; text-decoration: none; border: 1px solid var(--border); transition: all .15s; }
.bl-pag a { color: var(--text); background: var(--surface); }
.bl-pag a:hover { background: var(--accent); color: #fff; border-color: var(--accent); }
.bl-pag span.current { background: var(--accent); color: #fff; border-color: var(--accent); }
.bl-pag span.dots { background: none; border: none; color: var(--muted); width: auto; padding: 0 4px; }

/* ── Footer ── */
.esc-footer { background: #EFE9E7; padding: 64px 64px 28px; border-top: 1px solid rgba(15,45,53,.07); }
.footer-main { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 56px; }
.footer-brand p { font-size: 14px; color: var(--gray); line-height: 1.75; margin-top: 16px; max-width: 280px; }
.footer-col h4 { font-size: 11px; font-weight: 800; color: var(--white); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 18px; }
.footer-col a { display: block; font-size: 14px; color: var(--gray); text-decoration: none; margin-bottom: 10px; transition: color .2s; }
.footer-col a:hover { color: var(--accent); }
.footer-social { margin-top: 28px; }
.footer-social h4 { font-size: 11px; font-weight: 800; color: var(--white); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 16px; }
.social-icons { display: flex; gap: 12px; }
.social-icon { width: 40px; height: 40px; border-radius: 10px; background: rgba(15,45,53,.06); border: 1px solid rgba(15,45,53,.1); display: flex; align-items: center; justify-content: center; color: var(--gray); text-decoration: none; transition: all .2s; }
.social-icon:hover { background: var(--accent); border-color: var(--accent); color: #fff; }
.social-icon svg { width: 18px; height: 18px; fill: currentColor; }
.footer-divider { height: 1px; background: rgba(15,45,53,.08); margin-bottom: 24px; }
.footer-bottom { display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: var(--gray2); flex-wrap: wrap; gap: 12px; }
.footer-bottom-links { display: flex; gap: 24px; }
.footer-bottom-links a { color: var(--gray2); text-decoration: none; font-size: 13px; transition: color .2s; }
.footer-bottom-links a:hover { color: var(--gray); }
@media(max-width: 768px) {
  .footer-main { grid-template-columns: 1fr 1fr; gap: 32px; }
  .esc-footer { padding: 48px 24px 24px; }
  .footer-bottom { flex-direction: column; text-align: center; }
  .footer-bottom-links { flex-wrap: wrap; justify-content: center; gap: 16px; }
}

@media(max-width: 640px) {
  .bl-grid { grid-template-columns: 1fr; gap: 20px; }
  .bl-hero { padding: 44px 20px 40px; }
  .bl-wrap { padding: 32px 16px 60px; }
}
</style>
</head>
<body>

<header class="bl-header">
  <div class="bl-header-inner">
    <a href="<?php echo home_url('/'); ?>" class="bl-logo">
      <img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Escapii">
    </a>
    <a href="<?php echo home_url('/'); ?>" class="bl-back">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Nazad na sajt
    </a>
  </div>
</header>

<div class="bl-hero">
  <div class="bl-hero-badge">
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
    Escapii blog
  </div>
  <h1>Putovanja, saveti<br>i inspiracija</h1>
  <p>Priče sa naših iznenađenja i sve što treba da znaš pre polaska.</p>
</div>

<div class="bl-wrap">

<?php if ($q->have_posts()): ?>

  <div class="bl-grid">
    <?php while ($q->have_posts()): $q->the_post(); ?>
    <article class="bl-card">

      <?php if (has_post_thumbnail()): ?>
        <a href="<?php the_permalink(); ?>" class="bl-card-img">
          <?php the_post_thumbnail('medium_large'); ?>
        </a>
      <?php else: ?>
        <a href="<?php the_permalink(); ?>" class="bl-card-img">
          <div class="bl-card-img-placeholder">✈️</div>
        </a>
      <?php endif; ?>

      <div class="bl-card-body">
        <div class="bl-card-meta">
          <?php $cats = get_the_category(); if ($cats): ?>
            <span class="bl-cat"><?php echo esc_html($cats[0]->name); ?></span>
          <?php endif; ?>
          <span class="bl-date"><?php echo get_the_date('d.m.Y.'); ?></span>
        </div>
        <h2 class="bl-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="bl-card-excerpt"><?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 22, '…'); ?></p>
        <a href="<?php the_permalink(); ?>" class="bl-read-more">Čitaj više <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      </div>

    </article>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>

  <?php if ($total_pages > 1): ?>
  <div class="bl-pag">
    <?php
    $current = max(1, $paged);
    if ($current > 1) echo '<a href="' . get_pagenum_link($current - 1) . '">‹</a>';
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current) { echo '<span class="current">' . $i . '</span>'; }
        elseif ($i == 1 || $i == $total_pages || abs($i - $current) <= 1) { echo '<a href="' . get_pagenum_link($i) . '">' . $i . '</a>'; }
        elseif (abs($i - $current) == 2) { echo '<span class="dots">…</span>'; }
    }
    if ($current < $total_pages) echo '<a href="' . get_pagenum_link($current + 1) . '">›</a>';
    ?>
  </div>
  <?php endif; ?>

<?php else: ?>
  <div class="bl-empty">
    <h2>Uskoro...</h2>
  </div>
<?php endif; ?>

</div>

<footer class="esc-footer">
  <div class="footer-main">
    <div class="footer-brand">
      <a href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-black.svg" alt="Escapii" style="height:36px;display:block;"></a>
      <p>Iznenađujuća putovanja za ljude koji su spremni da puste kontrolu i probaju nešto drugačije.</p>
      <div class="footer-social">
        <h4>Pratite nas</h4>
        <div class="social-icons">
          <a href="https://www.instagram.com/escapii.rs?igsh=NmMwY3djcHFncjg2&utm_source=qr" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram">
            <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="https://www.tiktok.com/@escapii.rs?_r=1&_t=ZS-96jzf1blOsf" target="_blank" rel="noopener" class="social-icon" aria-label="TikTok">
            <svg viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.77a4.85 4.85 0 01-1.01-.08z"/></svg>
          </a>
          <a href="#" class="social-icon" aria-label="Facebook">
            <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
        </div>
      </div>
    </div>
    <div class="footer-col">
      <h4>Navigacija</h4>
      <a href="<?php echo home_url('/'); ?>#esc-about">O nama</a>
      <a href="<?php echo home_url('/'); ?>#esc-dest">Destinacije</a>
      <a href="<?php echo home_url('/'); ?>#esc-how">Kako funkcioniše</a>
      <a href="<?php echo home_url('/'); ?>#esc-who">Za koga</a>
      <a href="<?php echo home_url('/'); ?>#esc-faq">FAQ</a>
      <a href="<?php echo home_url('/blog'); ?>">Blog</a>
      <a href="<?php echo home_url('/pokloni-putovanje-iznenadjenja'); ?>" style="color:var(--accent);font-weight:600;">🎁 Pokloni putovanje iznenađenja</a>
    </div>
    <div class="footer-col">
      <h4>Polasci</h4>
      <a href="<?php echo home_url('/'); ?>#esc-booking">✈ Beograd (BEG)</a>
      <a href="<?php echo home_url('/'); ?>#esc-booking">✈ Niš (INI)</a>
    </div>
    <div class="footer-col">
      <h4>Kontakt</h4>
      <a href="mailto:escapii.team@gmail.com">✉ escapii.team@gmail.com</a>
    </div>
  </div>
  <div class="footer-divider"></div>
  <div class="footer-bottom">
    <span>© 2026 Escapii — Sva prava zadržana</span>
    <div class="footer-bottom-links">
      <a href="<?php echo home_url('/uslovi-koriscenja'); ?>">Uslovi korišćenja</a>
      <a href="<?php echo home_url('/politika-privatnosti'); ?>">Politika privatnosti</a>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
