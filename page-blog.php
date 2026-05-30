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
.bl-footer { background: #0c2530; border-top: 1px solid rgba(255,255,255,.06); padding: 28px 24px; text-align: center; }
.bl-footer a { color: rgba(255,255,255,.45); font-size: 13px; text-decoration: none; }
.bl-footer a:hover { color: rgba(255,255,255,.8); }

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
    <p>Prve priče su na putu. Dodaj post u WP Admin → Posts → Add New.</p>
  </div>
<?php endif; ?>

</div>

<footer class="bl-footer">
  <a href="<?php echo home_url('/'); ?>">escapii.rs</a>
</footer>

<?php wp_footer(); ?>
</body>
</html>
