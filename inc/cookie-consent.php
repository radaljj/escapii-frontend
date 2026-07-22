<?php
/**
 * Banner za saglasnost o kolačićima.
 *
 * Analitika je blokirana dok korisnik ne pristane - Consent Mode v2 podrazumevano
 * postavlja analytics_storage na 'denied' (vidi esc_consent_mode_default u
 * functions.php), pa GTM ne postavlja nijedan kolačić do klika na "Prihvatam".
 *
 * "Odbij" mora biti jednako lako dostupno kao "Prihvatam" - to GDPR izričito
 * traži, zato su oba dugmeta ista po veličini i vidljivosti.
 */
defined('ABSPATH') || exit;

$_cc_home = get_site_url();
// Coming-soon je jedna forma na praznoj strani - puna traka je tamo preglasna.
$_cc_mini = defined('ESC_IS_COMING_SOON') ? ' esc-cc--mini' : '';
?>
<style>
  .esc-cc {
    position: fixed;
    left: 16px; right: 16px;
    bottom: calc(16px + env(safe-area-inset-bottom));
    z-index: 9000;
    max-width: 720px;
    margin: 0 auto;
    background: #0d2530;
    border: 1px solid rgba(250,247,242,0.14);
    border-radius: 14px;
    box-shadow: 0 24px 60px -18px rgba(0,0,0,.7);
    padding: 20px 22px;
    color: #FAF7F2;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    display: none;
  }
  .esc-cc.show { display: block; animation: escCcIn .35s ease both; }
  @keyframes escCcIn { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: none; } }

  .esc-cc-title { font-size: 15px; font-weight: 700; margin: 0 0 6px; }
  .esc-cc-text  { font-size: 13px; line-height: 1.55; color: rgba(250,247,242,0.78); margin: 0 0 16px; }
  .esc-cc-text a { color: #F7DBA7; text-decoration: underline; }

  .esc-cc-actions { display: flex; gap: 10px; flex-wrap: wrap; }
  .esc-cc-btn {
    flex: 1 1 160px;
    padding: 12px 18px;
    border-radius: 10px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    border: 1px solid transparent;
    transition: background .15s, border-color .15s;
  }
  .esc-cc-accept { background: #D85A30; color: #FAF7F2; }
  .esc-cc-accept:hover { background: #c14e28; }
  /* Namerno iste veličine i težine kao "Prihvatam" - odbijanje ne sme biti
     teže uočljivo ni teže dostupno od pristanka. */
  .esc-cc-reject {
    background: transparent;
    color: #FAF7F2;
    border-color: rgba(250,247,242,0.35);
  }
  .esc-cc-reject:hover { border-color: rgba(250,247,242,0.65); }
  .esc-cc-btn:focus-visible { outline: 2px solid #F7DBA7; outline-offset: 2px; }

  @media (max-width: 460px) { .esc-cc-btn { flex: 1 1 100%; } }

  /* ── Sitna varijanta (coming-soon) ── */
  .esc-cc--mini {
    max-width: 340px;
    margin: 0 auto 0 0;          /* uz levu ivicu, ne preko sredine */
    padding: 14px 16px;
    border-radius: 12px;
  }
  .esc-cc--mini .esc-cc-title { font-size: 13px; margin-bottom: 4px; }
  .esc-cc--mini .esc-cc-text  { font-size: 11.5px; line-height: 1.5; margin-bottom: 11px; }
  .esc-cc--mini .esc-cc-full  { display: none; }   /* duži tekst samo van coming-soon */
  .esc-cc--mini .esc-cc-btn   { flex: 1 1 auto; padding: 8px 12px; font-size: 12.5px; border-radius: 8px; }
  .esc-cc--mini .esc-cc-actions { gap: 7px; }
  @media (max-width: 460px) {
    .esc-cc--mini { max-width: none; margin: 0 auto; }
    .esc-cc--mini .esc-cc-btn { flex: 1 1 auto; }
  }
</style>

<div class="esc-cc<?php echo $_cc_mini; ?>" id="escCookieBanner" role="dialog" aria-live="polite"
     aria-label="Saglasnost za kolačiće">
  <p class="esc-cc-title">Kolačići</p>
  <p class="esc-cc-text">
    Koristimo kolačiće kako bismo poboljšali vaše iskustvo na sajtu.
    Analitičke postavljamo samo uz vašu saglasnost.<span class="esc-cc-full">
    <a href="<?php echo esc_url($_cc_home); ?>/politika-privatnosti/#kolacici">Detaljnije</a></span>
  </p>
  <div class="esc-cc-actions">
    <button type="button" class="esc-cc-btn esc-cc-accept" id="escCcAccept">Prihvatam</button>
    <button type="button" class="esc-cc-btn esc-cc-reject" id="escCcReject">Samo neophodni</button>
  </div>
</div>

<script>
(function() {
  var NAME = 'esc_consent';
  var YEAR = 60 * 60 * 24 * 365;
  var banner = document.getElementById('escCookieBanner');

  function read() {
    var m = document.cookie.match(/(?:^|;\s*)esc_consent=(granted|denied)/);
    return m ? m[1] : null;
  }

  function save(value) {
    document.cookie = NAME + '=' + value + ';path=/;max-age=' + YEAR + ';SameSite=Lax';
  }

  function apply(value) {
    // Consent Mode: obavesti GTM da sme (ili ne sme) da postavlja analitiku.
    if (typeof gtag === 'function') {
      gtag('consent', 'update', {
        analytics_storage: value === 'granted' ? 'granted' : 'denied'
      });
    }
  }

  function decide(value) {
    save(value);
    apply(value);
    banner.classList.remove('show');
  }

  document.getElementById('escCcAccept').addEventListener('click', function() { decide('granted'); });
  document.getElementById('escCcReject').addEventListener('click', function() { decide('denied'); });

  // Banner se prikazuje samo ako korisnik još nije odlučio.
  if (!read()) banner.classList.add('show');

  // Poziva ga link "Podešavanja kolačića" u futeru - vraća banner da se
  // odluka može promeniti, što GDPR traži (povlačenje saglasnosti).
  window.escOpenCookieSettings = function() {
    banner.classList.add('show');
    banner.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
