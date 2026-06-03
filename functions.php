<?php
defined('ABSPATH') || exit;

function escapii_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'escapii_setup');

function escapii_assets() {
    wp_enqueue_style('escapii-style', get_stylesheet_uri(), [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'escapii_assets');

// API URL za backend (lokalno ili produkcija)
// Lokalni wp-config.php definiše ESCAPII_API_URL = http://localhost:8080
// InfinityFree nema tu konstantu → automatski koristi Render
function escapii_api_url() {
    return defined('ESCAPII_API_URL') ? ESCAPII_API_URL : 'https://escapii-backend.onrender.com';
}

// ── Favicon & OG meta tagovi ─────────────────────────────────────────────────
function escapii_head_meta() {
    $img_url = get_template_directory_uri() . '/images';
    $site_name = 'Escapii';
    $og_title  = 'Escapii - Putovanja iznenađenja već od 239€';
    $desc      = 'Rezerviši putovanje iznenađenja — destinacija ostaje tajna do 3 dana pre polaska!';
    $og_img    = $img_url . '/og-image.jpg';
    $home      = home_url('/');
    ?>
    <!-- Favicon — PNG prvi da Google ne koristi stari .ico -->
    <link rel="icon" type="image/png" sizes="512x512" href="<?php echo esc_url(home_url('/favicon.png')); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url(home_url('/favicon.png')); ?>">
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url($img_url . '/favicon.svg'); ?>">
    <link rel="icon" type="image/x-icon"  href="<?php echo esc_url(home_url('/favicon.ico')); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url(home_url('/favicon.png')); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url($img_url . '/favicon-white.png'); ?>">

    <!-- Canonical — dinamički po URL-u stranice -->
    <?php
    if ( is_front_page() ) {
        $canonical = $home;
    } elseif ( is_singular() ) {
        $canonical = get_permalink();
    } else {
        // blog listing, archive, custom template
        $path = parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH );
        $canonical = home_url( trailingslashit( $path ) );
    }
    ?>
    <link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">

    <!-- OG / Social share (1200×630) -->
    <meta property="og:type"         content="website">
    <meta property="og:url"          content="<?php echo esc_url($home); ?>">
    <meta property="og:site_name"    content="<?php echo esc_attr($site_name); ?>">
    <meta property="og:title"        content="<?php echo esc_attr($og_title); ?>">
    <meta property="og:description"  content="<?php echo esc_attr($desc); ?>">
    <meta property="og:image"        content="<?php echo esc_url($og_img); ?>">
    <meta property="og:image:type"   content="image/jpeg">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt"    content="<?php echo esc_attr($og_title); ?>">

    <!-- Twitter / X card (large image) -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo esc_attr($og_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($desc); ?>">
    <meta name="twitter:image"       content="<?php echo esc_url($og_img); ?>">
    <meta name="twitter:image:alt"   content="<?php echo esc_attr($og_title); ?>">
    <?php
}
add_action('wp_head', 'escapii_head_meta', 1);

// Ukloni WordPress-ov wp_site_icon() — mi sami outputujemo favicon tagove u escapii_head_meta()
remove_action('wp_head', 'wp_site_icon');

// Ukloni WordPress-ov automatski canonical — mi dodajemo eksplicitan u escapii_head_meta()
remove_action('wp_head', 'rel_canonical');

// Automatski kreiraj /admin-panel stranicu ako ne postoji
function escapii_create_admin_page() {
    if (get_page_by_path('admin-panel')) return;
    wp_insert_post([
        'post_title'  => 'Admin Panel',
        'post_name'   => 'admin-panel',
        'post_status' => 'publish',
        'post_type'   => 'page',
    ]);
}
add_action('after_switch_theme', 'escapii_create_admin_page');
add_action('init', 'escapii_create_admin_page');

// Automatski kreiraj /politika-privatnosti stranicu ako ne postoji
function escapii_create_privacy_page() {
    if (get_page_by_path('politika-privatnosti')) return;
    $id = wp_insert_post([
        'post_title'  => 'Politika privatnosti',
        'post_name'   => 'politika-privatnosti',
        'post_status' => 'publish',
        'post_type'   => 'page',
    ]);
    update_post_meta($id, '_wp_page_template', 'page-politika-privatnosti.php');
}
add_action('after_switch_theme', 'escapii_create_privacy_page');
add_action('init', 'escapii_create_privacy_page');

// Automatski kreiraj /privacy-policy stranicu ako ne postoji
function escapii_create_privacy_policy_en_page() {
    if (get_page_by_path('privacy-policy')) return;
    $id = wp_insert_post([
        'post_title'  => 'Privacy Policy',
        'post_name'   => 'privacy-policy',
        'post_status' => 'publish',
        'post_type'   => 'page',
    ]);
    update_post_meta($id, '_wp_page_template', 'page-privacy-policy.php');
}
add_action('after_switch_theme', 'escapii_create_privacy_policy_en_page');
add_action('init', 'escapii_create_privacy_policy_en_page');

// Automatski kreiraj /hvala stranicu ako ne postoji
function escapii_create_hvala_page() {
    if (get_page_by_path('hvala')) return;
    wp_insert_post([
        'post_title'     => 'Hvala',
        'post_name'      => 'hvala',
        'post_status'    => 'publish',
        'post_type'      => 'page',
        'page_template'  => 'page-hvala.php',
    ]);
}
add_action('after_switch_theme', 'escapii_create_hvala_page');
add_action('init', 'escapii_create_hvala_page');

// Automatski kreiraj /otkrivanje stranicu ako ne postoji
function escapii_create_otkrivanje_page() {
    if (get_page_by_path('otkrivanje')) return;
    $id = wp_insert_post([
        'post_title'  => 'Otkrivanje',
        'post_name'   => 'otkrivanje',
        'post_status' => 'publish',
        'post_type'   => 'page',
    ]);
    update_post_meta($id, '_wp_page_template', 'page-otkrivanje.php');
}
add_action('after_switch_theme', 'escapii_create_otkrivanje_page');
add_action('init', 'escapii_create_otkrivanje_page');

// Automatski kreiraj /blog stranicu ako ne postoji
function escapii_create_blog_page() {
    if (get_page_by_path('blog')) return;
    $id = wp_insert_post([
        'post_title'  => 'Blog',
        'post_name'   => 'blog',
        'post_status' => 'publish',
        'post_type'   => 'page',
    ]);
    if ($id) update_post_meta($id, '_wp_page_template', 'page-blog.php');
}
add_action('after_switch_theme', 'escapii_create_blog_page');
add_action('init', 'escapii_create_blog_page');

// ── 301 redirecti za stare/kratke URL-ove ────────────────────────────────────
add_action('template_redirect', function () {
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $map  = [
        '/pp'  => '/politika-privatnosti/',
        '/pp/' => '/politika-privatnosti/',
    ];
    if (isset($map[$path])) {
        wp_redirect(home_url($map[$path]), 301);
        exit;
    }
});

// ── robots.txt — override WordPress default ──────────────────────────────────
add_filter('robots_txt', 'escapii_robots_txt', 99);
function escapii_robots_txt() {
    return "User-agent: *\n"
         . "Disallow: /wp-admin/\n"
         . "Disallow: /wp-login.php\n"
         . "Disallow: /wp-json/\n"
         . "Disallow: /wp-cron.php\n"
         . "Disallow: /xmlrpc.php\n"
         . "Disallow: /author/\n"
         . "Disallow: /category/\n"
         . "Disallow: /tag/\n"
         . "Disallow: /feed/\n"
         . "Disallow: /page/\n"
         . "Disallow: /attachment/\n"
         . "Disallow: /?p=\n"
         . "Disallow: /?page_id=\n"
         . "Disallow: /?attachment_id=\n"
         . "Disallow: /?author=\n"
         . "Disallow: /?s=\n"
         . "Disallow: /2024/\n"
         . "Disallow: /2025/\n"
         . "Disallow: /2026/\n"
         . "Disallow: /2027/\n"
         . "Disallow: /cdn-cgi/\n"
         . "Disallow: /admin-panel/\n"
         . "Disallow: /hvala/\n"
         . "Disallow: /otkrivanje/\n"
         . "Disallow: /poklon/\n"
         . "Allow: /wp-admin/admin-ajax.php\n"
         . "\nSitemap: " . home_url('/sitemap.xml') . "\n";
}

// ── sitemap.xml — intercept rano, pre WordPress rewrite sistema ──────────────
// Isključi WordPress-ov ugrađeni sitemap da ne pravi konflikt
add_filter('wp_sitemaps_enabled', '__return_false');

add_action('init', 'escapii_serve_sitemap', 1);
function escapii_serve_sitemap() {
    if (!isset($_SERVER['REQUEST_URI'])) return;
    if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) !== '/sitemap.xml') return;
    $h = trailingslashit(home_url('/'));
    $pages = [
        ['loc' => $h,                            'priority' => '1.0', 'freq' => 'weekly'],
        ['loc' => $h . 'blog/',                          'priority' => '0.8', 'freq' => 'weekly'],
        ['loc' => $h . 'pokloni-putovanje-iznenadjenja/', 'priority' => '0.8', 'freq' => 'monthly'],
        ['loc' => $h . 'politika-privatnosti/',  'priority' => '0.3', 'freq' => 'yearly'],
        ['loc' => $h . 'privacy-policy/',        'priority' => '0.3', 'freq' => 'yearly'],
        ['loc' => $h . 'uslovi-koristenja/',     'priority' => '0.3', 'freq' => 'yearly'],
        ['loc' => $h . 'terms-of-use/',          'priority' => '0.3', 'freq' => 'yearly'],
    ];
    header('Content-Type: application/xml; charset=UTF-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($pages as $p) {
        echo "  <url>\n"
           . "    <loc>" . esc_url($p['loc']) . "</loc>\n"
           . "    <changefreq>" . $p['freq'] . "</changefreq>\n"
           . "    <priority>" . $p['priority'] . "</priority>\n"
           . "  </url>\n";
    }
    echo '</urlset>';
    exit;
}
