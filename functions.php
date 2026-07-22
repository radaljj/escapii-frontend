<?php
defined('ABSPATH') || exit;

// ── Coming Soon gate — blokira sve neadmince ─────────────────────────────────
add_action('template_redirect', 'esc_coming_soon_gate', 1);
function esc_coming_soon_gate() {
    if (is_admin())           return; // WP admin panel
    if (wp_doing_ajax())      return; // AJAX pozivi
    if (current_user_can('manage_options')) return; // ulogovani admin
    nocache_headers();
    // Banner za kolačiće se na ovoj strani prikazuje u sitnoj varijanti -
    // stranica je svedena na jednu formu, pa puna traka previše odvlači.
    define('ESC_IS_COMING_SOON', true);
    include get_template_directory() . '/coming-soon.php';
    exit;
}
// ─────────────────────────────────────────────────────────────────────────────

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
    $desc      = 'Vikend putovanja iznenađenja po Evropi. Ti biraš datum, mi biramo destinaciju. Let i hotel uključeni. Destinaciju ćeš saznati tek 48h pre polaska.';
    $og_img    = $img_url . '/og-image.jpg';
    $home      = home_url('/');
    ?>
    <!-- Favicon -->
    <link rel="icon" href="<?php echo esc_url(home_url('/favicon.ico')); ?>" sizes="any">
    <link rel="icon" type="image/png" sizes="512x512" href="<?php echo esc_url($img_url . '/favicon.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url($img_url . '/favicon.png'); ?>">
    <link rel="icon" type="image/svg+xml"             href="<?php echo esc_url($img_url . '/favicon.svg'); ?>">
    <link rel="shortcut icon"                         href="<?php echo esc_url($img_url . '/favicon.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180"      href="<?php echo esc_url($img_url . '/favicon.png'); ?>">

    <!-- Canonical - dinamički po URL-u stranice -->
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

// Ukloni WordPress-ov wp_site_icon() - mi sami outputujemo favicon tagove u escapii_head_meta()
remove_action('wp_head', 'wp_site_icon', 99);

// Ukloni WordPress-ov automatski canonical - mi dodajemo eksplicitan u escapii_head_meta()
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

// ── robots.txt - override WordPress default ──────────────────────────────────
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
         . "Allow: /wp-admin/admin-ajax.php\n"
         // /hvala/, /otkrivanje/, /poklon/ imaju noindex u templateu —
         // NE blokiraj robots.txt jer Google mora crawlati da vidi noindex i deindeksira
         . "\nSitemap: " . home_url('/sitemap.xml') . "\n";
}

// ── sitemap.xml - intercept rano, pre WordPress rewrite sistema ──────────────
// Isključi WordPress-ov ugrađeni sitemap da ne pravi konflikt
add_filter('wp_sitemaps_enabled', '__return_false');

add_action('init', 'escapii_serve_sitemap', 1);
function escapii_serve_sitemap() {
    if (!isset($_SERVER['REQUEST_URI'])) return;
    if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) !== '/sitemap.xml') return;
    $h = trailingslashit(home_url('/'));
    $pages = [
        ['loc' => $h,               'priority' => '1.0', 'freq' => 'weekly'],
        ['loc' => $h . 'pokloni/', 'priority' => '0.8', 'freq' => 'monthly'],
        ['loc' => $h . 'faq/',     'priority' => '0.7', 'freq' => 'monthly'],
        ['loc' => $h . 'blog/',    'priority' => '0.7', 'freq' => 'weekly'],
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

function esc_date_sr(string $format, $timestamp = null): string {
    if ($timestamp === null) $timestamp = get_the_time('U');
    $en = ['January','February','March','April','May','June',
           'July','August','September','October','November','December'];
    $sr = ['januar','februar','mart','april','maj','jun',
           'jul','avgust','septembar','oktobar','novembar','decembar'];
    return str_replace($en, $sr, date($format, $timestamp));
}

// ── Blog EN prevod ────────────────────────────────────────────────────────────
// Jezik se čita server-side iz kolačića (isti 'esc-lang' koji ostatak sajta već
// koristi u localStorage) - potreban je server-side jer je sadržaj posta (naslov,
// izvod, telo) dinamički iz baze, JS ga ne može prevesti kao statički UI tekst.
function esc_lang(): string {
    $lang = $_COOKIE['esc-lang'] ?? 'sr';
    return $lang === 'en' ? 'en' : 'sr';
}

function esc_post_title(int $post_id, ?string $lang = null): string {
    $lang = $lang ?? esc_lang();
    if ($lang === 'en') {
        $en = get_post_meta($post_id, '_title_en', true);
        if ($en !== '') return $en;
    }
    return get_the_title($post_id);
}

function esc_post_excerpt(int $post_id, ?string $lang = null): string {
    $lang = $lang ?? esc_lang();
    if ($lang === 'en') {
        $en = get_post_meta($post_id, '_excerpt_en', true);
        if ($en !== '') return $en;
    }
    return has_excerpt($post_id) ? get_the_excerpt($post_id) : '';
}

function esc_post_content(int $post_id, ?string $lang = null): string {
    $lang = $lang ?? esc_lang();
    if ($lang === 'en') {
        $en = get_post_meta($post_id, '_content_en', true);
        if ($en !== '') return apply_filters('the_content', $en);
    }
    return apply_filters('the_content', get_the_content(null, false, $post_id));
}

function esc_post_date(string $format_sr, string $format_en, $timestamp = null, ?string $lang = null): string {
    $lang = $lang ?? esc_lang();
    if ($timestamp === null) $timestamp = get_the_time('U');
    return $lang === 'en' ? date($format_en, $timestamp) : esc_date_sr($format_sr, $timestamp);
}

function esc_category_name($term, ?string $lang = null): string {
    if (!$term) return '';
    $lang = $lang ?? esc_lang();
    if ($lang === 'en') {
        $en = get_term_meta($term->term_id, 'name_en', true);
        if ($en !== '') return $en;
    }
    return $term->name;
}

// ── Meta box: EN prevod posta (Title/Excerpt/Content) ────────────────────────
add_action('add_meta_boxes', function () {
    add_meta_box(
        'esc_en_translation',
        'Engleski prevod (EN)',
        'esc_render_en_meta_box',
        'post',
        'normal',
        'high'
    );
});

function esc_render_en_meta_box(WP_Post $post) {
    wp_nonce_field('esc_save_en_translation', 'esc_en_nonce');
    $title_en   = get_post_meta($post->ID, '_title_en', true);
    $excerpt_en = get_post_meta($post->ID, '_excerpt_en', true);
    $content_en = get_post_meta($post->ID, '_content_en', true);
    ?>
    <p>
        <label for="esc_title_en"><strong>Title (EN)</strong></label><br>
        <input type="text" id="esc_title_en" name="esc_title_en" style="width:100%;"
               value="<?php echo esc_attr($title_en); ?>">
    </p>
    <p>
        <label for="esc_excerpt_en"><strong>Excerpt (EN)</strong></label><br>
        <textarea id="esc_excerpt_en" name="esc_excerpt_en" rows="3" style="width:100%;"><?php echo esc_textarea($excerpt_en); ?></textarea>
    </p>
    <?php
    wp_editor($content_en, 'esc_content_en', [
        'textarea_name' => 'esc_content_en',
        'textarea_rows' => 12,
        'media_buttons' => true,
    ]);
    ?>
    <p style="color:#666;font-size:12px;">Ostavi prazno da se na engleskoj verziji sajta prikaže originalni (srpski) tekst.</p>
    <?php
}

add_action('save_post_post', function (int $post_id) {
    if (!isset($_POST['esc_en_nonce']) || !wp_verify_nonce($_POST['esc_en_nonce'], 'esc_save_en_translation')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, '_title_en', sanitize_text_field($_POST['esc_title_en'] ?? ''));
    update_post_meta($post_id, '_excerpt_en', sanitize_textarea_field($_POST['esc_excerpt_en'] ?? ''));
    update_post_meta($post_id, '_content_en', wp_kses_post($_POST['esc_content_en'] ?? ''));
});

// ── Term meta: EN naziv kategorije ────────────────────────────────────────────
add_action('category_add_form_fields', function () { ?>
    <div class="form-field">
        <label for="name_en">Name (EN)</label>
        <input type="text" name="name_en" id="name_en" value="">
        <p>Engleski naziv kategorije. Ostavi prazno da ostane isti kao srpski.</p>
    </div>
<?php });

add_action('category_edit_form_fields', function (WP_Term $term) {
    $name_en = get_term_meta($term->term_id, 'name_en', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="name_en">Name (EN)</label></th>
        <td>
            <input type="text" name="name_en" id="name_en" value="<?php echo esc_attr($name_en); ?>">
            <p class="description">Engleski naziv kategorije. Ostavi prazno da ostane isti kao srpski.</p>
        </td>
    </tr>
<?php });

add_action('created_category', 'esc_save_category_name_en');
add_action('edited_category', 'esc_save_category_name_en');
function esc_save_category_name_en(int $term_id) {
    if (!isset($_POST['name_en'])) return;
    update_term_meta($term_id, 'name_en', sanitize_text_field($_POST['name_en']));
}

/* ─────────────────────────────────────────────────────────────────────────────
   Google Tag Manager (GA4)

   Kod stoji na jednom mestu umesto u 17 templejta - kači se na wp_head i
   wp_body_open, pa svaki templejt koji ih poziva automatski dobija tracking.

   Admin panel (page-admin-panel.php) namerno NE poziva te hookove, pa se
   interno korišćenje ne meša u statistiku posetilaca. Iz istog razloga se
   preskaču i prijavljeni korisnici.
   ────────────────────────────────────────────────────────────────────────── */

const ESC_GTM_ID = 'GTM-N84K66L6';

/** Ne pratimo sebe: WP admin, prijavljene korisnike ni preglede iz uređivača. */
function esc_gtm_enabled(): bool {
    return !is_admin() && !is_user_logged_in() && !is_preview();
}

/**
 * Consent Mode v2 - MORA da se izvrši pre GTM skripte, zato prioritet 0.
 * Podrazumevano je sve odbijeno: GTM se učita, ali ne postavlja nijedan
 * analitički kolačić dok korisnik ne klikne "Prihvatam".
 *
 * Ako je korisnik ranije već odlučio, odluku primenjujemo odmah ovde iz
 * kolačića - da ne bude trenutka u kom je stanje pogrešno.
 */
add_action('wp_head', 'esc_consent_mode_default', 0);
function esc_consent_mode_default() {
    if (!esc_gtm_enabled()) return;
    $choice = $_COOKIE['esc_consent'] ?? '';
    $granted = ($choice === 'granted') ? 'granted' : 'denied';
    ?>
<!-- Consent Mode (default: denied) -->
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('consent', 'default', {
  ad_storage: 'denied',
  ad_user_data: 'denied',
  ad_personalization: 'denied',
  analytics_storage: '<?php echo esc_js($granted); ?>',
  functionality_storage: 'granted',
  security_storage: 'granted',
  wait_for_update: 500
});
</script>
    <?php
}

add_action('wp_head', 'esc_gtm_head', 1);   // prioritet 1 = odmah posle consent default-a
function esc_gtm_head() {
    if (!esc_gtm_enabled()) return;
    ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo esc_js(ESC_GTM_ID); ?>');</script>
<!-- End Google Tag Manager -->
    <?php
}

add_action('wp_body_open', 'esc_gtm_body');
function esc_gtm_body() {
    if (!esc_gtm_enabled()) return;
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr(ESC_GTM_ID); ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <?php
}

/** Banner za saglasnost - na svakoj javnoj strani, ista logika svuda. */
add_action('wp_footer', 'esc_cookie_banner');
function esc_cookie_banner() {
    if (!esc_gtm_enabled()) return;
    include get_template_directory() . '/inc/cookie-consent.php';
}
