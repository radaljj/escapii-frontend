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
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url($img_url . '/favicon.svg'); ?>">
    <link rel="icon" type="image/png"     href="<?php echo esc_url($img_url . '/favicon.png'); ?>">
    <link rel="apple-touch-icon"          href="<?php echo esc_url($img_url . '/favicon-white.png'); ?>">

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
