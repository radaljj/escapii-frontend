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
function escapii_api_url() {
    return defined('ESCAPII_API_URL') ? ESCAPII_API_URL : 'http://localhost:8080';
}

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
