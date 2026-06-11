<?php
/**
 * 404 template - vraća pravi HTTP 404 i preusmerava na početnu.
 * Bez ovog fajla WordPress vraća 200 (soft 404) što Google tretira kao
 * grešku pri indeksiranju.
 */
defined('ABSPATH') || exit;

// Postavi pravi 404 header
status_header(404);
nocache_headers();
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <title>Stranica nije pronađena - Escapii</title>
    <meta http-equiv="refresh" content="0;url=<?php echo esc_url(home_url('/')); ?>">
</head>
<body>
    <script>window.location.replace('<?php echo esc_js(home_url('/')); ?>');</script>
</body>
</html>
