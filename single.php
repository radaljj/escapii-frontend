<?php
/**
 * Single post template.
 * Prikazuje jedan blog post.
 */
if (!have_posts()) { wp_redirect(home_url('/blog')); exit; }
the_post();
$cats     = get_the_category();
$cat_name = $cats ? esc_html($cats[0]->name) : '';
$content  = apply_filters('the_content', get_the_content());
$words    = str_word_count(wp_strip_all_tags($content));
$read_min = max(1, round($words / 200));
?>
<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php the_title(); ?> — Escapii Blog</title>
  <meta name="description" content="<?php echo esc_attr(wp_trim_words(get_the_excerpt() ?: get_the_content(), 25, '')); ?>">
  <?php if (has_post_thumbnail()): ?>
  <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>">
  <?php endif; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap">
  <?php wp_head(); ?>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg:      #EFE9E7;
  --surface: #FFFFFF;
  --text:    #1a2e34;
  --muted:   #6b8a93;
  --accent:  #CA8A71;
  --border:  rgba(15,45,53,.1);
}

body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); line-height: 1.7; }

/* ── Header ── */
.sp-header { background: rgba(15,45,53,.96); border-bottom: 1px solid rgba(255,255,255,.06); padding: 16px 0; position: sticky; top: 0; z-index: 100; backdrop-filter: blur(14px); }
.sp-header-inner { max-width: 780px; margin: 0 auto; padding: 0 24px; display: flex; align-items: center; justify-content: space-between; }
.sp-logo img { height: 36px; width: auto; display: block; }
.sp-back { display: inline-flex; align-items: center; gap: 7px; color: rgba(255,255,255,.65); text-decoration: none; font-size: 13px; font-weight: 600; transition: color .15s; }
.sp-back:hover { color: #fff; }

/* ── Hero ── */
.sp-hero { background: #0f2d35; padding: 52px 24px 44px; }
.sp-hero-inner { max-width: 780px; margin: 0 auto; }
.sp-meta { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: wrap; }
.sp-cat { font-size: 10px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--accent); background: rgba(202,138,113,.15); border: 1px solid rgba(202,138,113,.3); padding: 4px 12px; border-radius: 100px; }
.sp-date { font-size: 13px; color: rgba(255,255,255,.45); }
.sp-read { font-size: 13px; color: rgba(255,255,255,.35); }
.sp-sep { color: rgba(255,255,255,.2); font-size: 11px; }
.sp-hero h1 { font-size: clamp(26px, 4.5vw, 42px); font-weight: 800; color: #fff; line-height: 1.15; letter-spacing: -.025em; }

/* ── Featured image ── */
.sp-img-wrap { max-width: 780px; margin: 0 auto; padding: 0 24px; transform: translateY(-24px); }
.sp-img-wrap img { width: 100%; border-radius: 16px; display: block; box-shadow: 0 20px 60px rgba(15,45,53,.2); aspect-ratio: 16/9; object-fit: cover; }

/* ── Content ── */
.sp-body { max-width: 680px; margin: 0 auto; padding: 0 24px 80px; }
.sp-content { font-family: 'Lora', Georgia, serif; font-size: 18px; line-height: 1.8; color: #2a3d44; }
.sp-content p { margin-bottom: 1.4em; }
.sp-content h2 { font-family: 'Inter', sans-serif; font-size: 24px; font-weight: 800; color: var(--text); margin: 2em 0 .7em; letter-spacing: -.02em; }
.sp-content h3 { font-family: 'Inter', sans-serif; font-size: 20px; font-weight: 700; color: var(--text); margin: 1.6em 0 .6em; }
.sp-content a { color: var(--accent); text-decoration: underline; text-underline-offset: 3px; }
.sp-content a:hover { color: #b07460; }
.sp-content ul, .sp-content ol { padding-left: 1.5em; margin-bottom: 1.4em; }
.sp-content li { margin-bottom: .5em; }
.sp-content strong { font-weight: 700; color: var(--text); }
.sp-content em { font-style: italic; }
.sp-content blockquote { border-left: 3px solid var(--accent); padding: 14px 20px; margin: 2em 0; background: rgba(202,138,113,.06); border-radius: 0 10px 10px 0; font-style: italic; color: #4a6570; }
.sp-content img { max-width: 100%; border-radius: 12px; margin: 1.5em 0; display: block; }
.sp-content hr { border: none; border-top: 1px dashed rgba(15,45,53,.15); margin: 2.5em 0; }
.sp-content figure { margin: 2em 0; }
.sp-content figcaption { font-family: 'Inter', sans-serif; font-size: 13px; color: var(--muted); text-align: center; margin-top: 8px; }

/* ── Back to blog ── */
.sp-back-footer { display: inline-flex; align-items: center; gap: 8px; margin-top: 48px; padding: 14px 22px; border: 1.5px solid var(--border); border-radius: 12px; color: var(--text); font-size: 14px; font-weight: 600; text-decoration: none; transition: all .15s; background: var(--surface); }
.sp-back-footer:hover { border-color: var(--accent); color: var(--accent); }

/* ── Footer ── */
.sp-footer { background: #0c2530; border-top: 1px solid rgba(255,255,255,.06); padding: 28px 24px; text-align: center; }
.sp-footer a { color: rgba(255,255,255,.45); font-size: 13px; text-decoration: none; }
.sp-footer a:hover { color: rgba(255,255,255,.8); }

@media(max-width: 640px) {
  .sp-hero { padding: 36px 20px 32px; }
  .sp-content { font-size: 16px; }
  .sp-body { padding-bottom: 56px; }
  .sp-img-wrap { padding: 0 16px; }
}
</style>
</head>
<body>

<header class="sp-header">
  <div class="sp-header-inner">
    <a href="<?php echo home_url('/'); ?>" class="sp-logo">
      <img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Escapii">
    </a>
    <a href="<?php echo home_url('/blog'); ?>" class="sp-back">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Nazad na blog
    </a>
  </div>
</header>

<div class="sp-hero">
  <div class="sp-hero-inner">
    <div class="sp-meta">
      <?php if ($cat_name): ?><span class="sp-cat"><?php echo $cat_name; ?></span><?php endif; ?>
      <span class="sp-date"><?php echo get_the_date('d.m.Y.'); ?></span>
      <span class="sp-sep">·</span>
      <span class="sp-read"><?php echo $read_min; ?> min čitanja</span>
    </div>
    <h1><?php the_title(); ?></h1>
  </div>
</div>

<?php if (has_post_thumbnail()): ?>
<div class="sp-img-wrap">
  <?php the_post_thumbnail('large'); ?>
</div>
<?php endif; ?>

<div class="sp-body">
  <div class="sp-content">
    <?php echo $content; ?>
  </div>
  <a href="<?php echo home_url('/blog'); ?>" class="sp-back-footer">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
    Svi članci
  </a>
</div>

<footer class="sp-footer">
  <a href="<?php echo home_url('/'); ?>">escapii.rs</a>
</footer>

<?php wp_footer(); ?>
</body>
</html>
