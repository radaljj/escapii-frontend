<?php
/**
 * Single post template.
 */
if (!have_posts()) { wp_redirect(home_url('/blog')); exit; }
the_post();
$cats      = get_the_category();
$cat_name  = $cats ? esc_html($cats[0]->name) : '';
$content   = apply_filters('the_content', get_the_content());
$words     = str_word_count(wp_strip_all_tags($content));
$read_min  = max(1, round($words / 200));
$has_img   = has_post_thumbnail();
?>
<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php the_title(); ?> — Escapii Blog</title>
  <meta name="description" content="<?php echo esc_attr(wp_trim_words(get_the_excerpt() ?: get_the_content(), 28, '')); ?>">
  <?php if ($has_img): ?>
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
  --white:   #2D5F6B;
  --gray:    #7A9FA8;
  --gray2:   #7A9FA8;
  --max:     760px;
}

body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); line-height: 1.7; }

/* ── Header ── */
.sp-header { background: rgba(15,45,53,.97); border-bottom: 1px solid rgba(255,255,255,.06); padding: 18px 0; position: sticky; top: 0; z-index: 100; backdrop-filter: blur(16px); }
.sp-header-inner { max-width: 1100px; margin: 0 auto; padding: 0 32px; display: flex; align-items: center; justify-content: space-between; }
.sp-logo img { height: 38px; width: auto; display: block; }
.sp-hd-back { display: inline-flex; align-items: center; gap: 8px; color: rgba(255,255,255,.6); text-decoration: none; font-size: 13px; font-weight: 600; transition: color .15s; padding: 8px 16px; border: 1px solid rgba(255,255,255,.12); border-radius: 10px; }
.sp-hd-back:hover { color: #fff; border-color: rgba(255,255,255,.3); }

/* ── Hero ── */
.sp-hero { background: linear-gradient(160deg, #0a2530 0%, #0f2d35 60%, #142f38 100%); padding: 80px 32px 72px; }
.sp-hero-inner { max-width: var(--max); margin: 0 auto; }
.sp-meta { display: flex; align-items: center; gap: 10px; margin-bottom: 24px; flex-wrap: wrap; }
.sp-cat { font-size: 10px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--accent); background: rgba(202,138,113,.14); border: 1px solid rgba(202,138,113,.28); padding: 5px 14px; border-radius: 100px; }
.sp-date { font-size: 13px; color: rgba(255,255,255,.42); }
.sp-read { font-size: 13px; color: rgba(255,255,255,.32); }
.sp-sep { color: rgba(255,255,255,.18); }
.sp-hero h1 { font-size: clamp(28px, 4.5vw, 46px); font-weight: 800; color: #fff; line-height: 1.12; letter-spacing: -.028em; }

/* ── Featured image ── */
.sp-img-wrap { max-width: var(--max); margin: -32px auto 0; padding: 0 32px; position: relative; z-index: 1; }
.sp-img-wrap img { width: 100%; border-radius: 18px; display: block; box-shadow: 0 24px 72px rgba(15,45,53,.22); aspect-ratio: 16/9; object-fit: cover; }

/* ── Content ── */
.sp-body { max-width: var(--max); margin: 0 auto; padding: 56px 32px 96px; }
.sp-body.has-img { padding-top: 48px; }

.sp-content { font-family: 'Lora', Georgia, serif; font-size: 18px; line-height: 1.85; color: #253840; }
.sp-content > * + * { margin-top: 1.5em; }
.sp-content p { margin-top: 1.4em; }
.sp-content p:first-child { margin-top: 0; }
.sp-content h2 { font-family: 'Inter', sans-serif; font-size: 26px; font-weight: 800; color: var(--text); margin-top: 2.2em; margin-bottom: -.4em; letter-spacing: -.025em; line-height: 1.2; }
.sp-content h3 { font-family: 'Inter', sans-serif; font-size: 21px; font-weight: 700; color: var(--text); margin-top: 2em; margin-bottom: -.4em; }
.sp-content a { color: var(--accent); text-decoration: underline; text-underline-offset: 3px; }
.sp-content a:hover { color: #b07460; }
.sp-content ul, .sp-content ol { padding-left: 1.6em; }
.sp-content li + li { margin-top: .5em; }
.sp-content strong { font-weight: 700; color: #1a2e34; }
.sp-content blockquote { border-left: 3px solid var(--accent); padding: 18px 24px; background: rgba(202,138,113,.06); border-radius: 0 14px 14px 0; font-style: italic; color: #4a6570; }
.sp-content img { max-width: 100%; border-radius: 14px; display: block; box-shadow: 0 8px 32px rgba(15,45,53,.1); }
.sp-content figure { margin: 0; }
.sp-content figcaption { font-family: 'Inter', sans-serif; font-size: 13px; color: var(--muted); text-align: center; margin-top: 10px; }
.sp-content hr { border: none; border-top: 1px dashed var(--border); }

/* ── Divider before back btn ── */
.sp-divider { height: 1px; background: var(--border); margin: 56px 0 40px; }

/* ── Back to blog ── */
.sp-back-footer { display: inline-flex; align-items: center; gap: 9px; padding: 14px 24px; border: 1.5px solid var(--border); border-radius: 12px; color: var(--text); font-size: 14px; font-weight: 600; text-decoration: none; transition: all .18s; background: var(--surface); box-shadow: 0 2px 8px rgba(15,45,53,.06); }
.sp-back-footer:hover { border-color: var(--accent); color: var(--accent); box-shadow: 0 4px 16px rgba(202,138,113,.12); transform: translateY(-1px); }

/* ── Footer (identičan početnoj) ── */
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
  .sp-header-inner { padding: 0 20px; }
  .sp-hero { padding: 60px 20px 52px; }
  .sp-img-wrap { padding: 0 20px; }
  .sp-body { padding: 44px 20px 72px; }
  .sp-content { font-size: 17px; }
  .footer-main { grid-template-columns: 1fr 1fr; gap: 32px; }
  .esc-footer { padding: 48px 24px 24px; }
  .footer-bottom { flex-direction: column; text-align: center; }
  .footer-bottom-links { flex-wrap: wrap; justify-content: center; gap: 16px; }
}
@media(max-width: 480px) {
  .sp-hero h1 { font-size: 26px; }
  .sp-content { font-size: 16px; line-height: 1.75; }
}
</style>
</head>
<body>

<!-- Header -->
<header class="sp-header">
  <div class="sp-header-inner">
    <a href="<?php echo home_url('/'); ?>" class="sp-logo">
      <img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Escapii">
    </a>
    <a href="<?php echo home_url('/blog'); ?>" class="sp-hd-back">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Nazad na blog
    </a>
  </div>
</header>

<!-- Hero -->
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

<!-- Featured image -->
<?php if ($has_img): ?>
<div class="sp-img-wrap">
  <?php the_post_thumbnail('large'); ?>
</div>
<?php endif; ?>

<!-- Content -->
<div class="sp-body <?php echo $has_img ? 'has-img' : ''; ?>">
  <div class="sp-content">
    <?php echo $content; ?>
  </div>
  <div class="sp-divider"></div>
  <a href="<?php echo home_url('/blog'); ?>" class="sp-back-footer">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
    Svi članci
  </a>
</div>

<!-- Footer -->
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
