<?php
/**
 * Baner za saglasnost o kolačićima. Tekstovi su iz dokumenta „Cookie Policy + Cookie Banner":
 * prvi sloj (Prihvati sve / Samo neophodni / Podesi kolačiće) i podešavanja po kategorijama.
 *
 * Kategorije: neophodni (uvek aktivni), analitički (GA4 i HubSpot) i marketinški (Google Ads,
 * Meta - trenutno bez ijednog taga u GTM-u, ali saglasnost je spremna kad se dodaju).
 * Izbor se pamti 12 meseci u kolačiću esc_consent kao "v2.aX.mY" (X, Y = 1 ili 0). Server ga
 * čita u esc_consent_state() (functions.php). Stare vrednosti granted/denied ne važe, pa se
 * posetilac posle promene politike pita ponovo.
 *
 * GTM se učitava tek posle izbora: functions.php ga štampa samo kad kolačić to dozvoljava, a
 * ovde se ubacuje u trenutku klika. Dok posetilac ne odluči, Google ne dobija ništa.
 *
 * „Samo neophodni" mora biti jednako lako dostupno kao „Prihvati sve": isti red, ista veličina.
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
  .esc-cc [hidden] { display: none !important; }
  @keyframes escCcIn { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: none; } }
  /* Podešavanja su viša od prvog sloja: na niskom ekranu (telefon položeno) baner se skroluje.
     Samo ovde - uz animaciju ulaska Chrome inače crta prazne trake za skrolovanje. */
  @media (max-height: 640px) {
    /* border-box: u visinu ulaze i unutrašnje margine, inače vrh kutije ode iznad ekrana */
    .esc-cc { box-sizing: border-box; max-height: calc(100vh - 32px - env(safe-area-inset-bottom)); overflow-y: auto; }
  }

  .esc-cc-title { font-size: 15px; font-weight: 700; margin: 0 0 6px; }
  .esc-cc-text  { font-size: 13px; line-height: 1.55; color: rgba(250,247,242,0.78); margin: 0 0 16px; }
  .esc-cc-text a { color: #F7DBA7; text-decoration: underline; }
  .esc-cc-links { display: block; margin-top: 6px; }

  .esc-cc-actions { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
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
  /* Namerno iste veličine i težine kao „Prihvati sve" - odbijanje ne sme biti
     teže uočljivo ni teže dostupno od pristanka. */
  .esc-cc-reject {
    background: transparent;
    color: #FAF7F2;
    border-color: rgba(250,247,242,0.35);
  }
  .esc-cc-reject:hover { border-color: rgba(250,247,242,0.65); }
  /* Podešavanja su treća, tiša opcija: tekstualno dugme u istom redu. */
  .esc-cc-link {
    flex: 0 0 auto;
    background: transparent;
    color: #F7DBA7;
    text-decoration: underline;
    text-underline-offset: 3px;
    padding: 12px 6px;
  }
  .esc-cc-link:hover { color: #FAF7F2; }
  .esc-cc-btn:focus-visible { outline: 2px solid #F7DBA7; outline-offset: 2px; }

  /* ── Podešavanja po kategorijama ── */
  .esc-cc-cats { display: flex; flex-direction: column; gap: 10px; margin: 0 0 16px; }
  .esc-cc-cat {
    border: 1px solid rgba(250,247,242,0.14);
    border-radius: 10px;
    padding: 12px 14px;
  }
  .esc-cc-cat-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; }
  label.esc-cc-cat-head { cursor: pointer; }
  .esc-cc-cat-name { font-size: 13.5px; font-weight: 700; }
  .esc-cc-always { font-size: 12px; font-weight: 600; color: #9fd6b6; white-space: nowrap; }
  .esc-cc-cat-desc { font-size: 12.5px; line-height: 1.5; color: rgba(250,247,242,0.72); margin: 4px 0 0; }
  .esc-cc-switch {
    -webkit-appearance: none; appearance: none;
    flex: 0 0 auto;
    width: 40px; height: 22px;
    margin: 0;
    border-radius: 999px;
    background: rgba(250,247,242,0.25);
    position: relative;
    cursor: pointer;
    transition: background .15s;
  }
  .esc-cc-switch::after {
    content: '';
    position: absolute;
    top: 3px; left: 3px;
    width: 16px; height: 16px;
    border-radius: 50%;
    background: #FAF7F2;
    transition: transform .15s;
  }
  .esc-cc-switch:checked { background: #D85A30; }
  .esc-cc-switch:checked::after { transform: translateX(18px); }
  .esc-cc-switch:focus-visible { outline: 2px solid #F7DBA7; outline-offset: 2px; }

  @media (max-width: 460px) {
    .esc-cc-btn { flex: 1 1 100%; }
    .esc-cc-link { flex: 1 1 100%; padding: 6px; }
  }

  /* ── Sitna varijanta (coming-soon) ── */
  .esc-cc--mini {
    max-width: 340px;
    margin: 0 auto 0 0;          /* uz levu ivicu, ne preko sredine */
    padding: 14px 16px;
    border-radius: 12px;
  }
  .esc-cc--mini .esc-cc-title { font-size: 13px; margin-bottom: 4px; }
  .esc-cc--mini .esc-cc-text  { font-size: 11.5px; line-height: 1.5; margin-bottom: 11px; }
  .esc-cc--mini .esc-cc-full  { display: none; }   /* duži tekst i linkovi samo van coming-soon */
  .esc-cc-short { display: none; }
  .esc-cc--mini .esc-cc-short { display: inline; }
  .esc-cc--mini .esc-cc-btn   { flex: 1 1 auto; padding: 8px 12px; font-size: 12.5px; border-radius: 8px; }
  .esc-cc--mini .esc-cc-link  { flex: 1 1 100%; padding: 4px 6px; font-size: 12px; }
  .esc-cc--mini .esc-cc-actions { gap: 7px; }
  .esc-cc--mini .esc-cc-cats { gap: 7px; margin-bottom: 11px; }
  .esc-cc--mini .esc-cc-cat { padding: 9px 11px; }
  .esc-cc--mini .esc-cc-cat-name { font-size: 12.5px; }
  .esc-cc--mini .esc-cc-cat-desc { font-size: 11.5px; }
  @media (max-width: 460px) {
    .esc-cc--mini { max-width: none; margin: 0 auto; }
    .esc-cc--mini .esc-cc-btn { flex: 1 1 auto; }
    .esc-cc--mini .esc-cc-link { flex: 1 1 100%; }
  }
</style>

<div class="esc-cc<?php echo $_cc_mini; ?>" id="escCookieBanner" role="dialog" aria-live="polite"
     aria-label="Saglasnost za kolačiće">

  <div id="escCcMain">
    <p class="esc-cc-title" id="escCcTitle">🍪 Koristimo kolačiće</p>
    <p class="esc-cc-text">
      <span class="esc-cc-full"><span id="escCcMsg">Escapii koristi kolačiće i slične tehnologije kako bi platforma pravilno funkcionisala, kako bismo unapredili vaše iskustvo i, uz vaš izbor, analizirali korišćenje platforme i merili naše oglašavanje.</span>
      <span id="escCcMsg2">Možete prihvatiti sve kolačiće, odbiti one koji nisu neophodni ili podesiti svoje preferencije.</span>
      <span class="esc-cc-links"><a id="escCcCookieLink" href="<?php echo esc_url($_cc_home); ?>/politika-privatnosti/#kolacici">Politika kolačića</a> · <a id="escCcPrivacyLink" href="<?php echo esc_url($_cc_home); ?>/politika-privatnosti/">Politika privatnosti</a></span></span><span class="esc-cc-short" id="escCcShort">Escapii koristi neophodne kolačiće za funkcionisanje platforme, kao i analitičke i marketinške kolačiće uz vaš izbor.</span>
    </p>
    <div class="esc-cc-actions">
      <button type="button" class="esc-cc-btn esc-cc-accept" id="escCcAccept">Prihvati sve</button>
      <button type="button" class="esc-cc-btn esc-cc-reject" id="escCcReject">Samo neophodni</button>
      <button type="button" class="esc-cc-btn esc-cc-link" id="escCcOpenPrefs">Podesi kolačiće</button>
    </div>
  </div>

  <div id="escCcPrefs" hidden>
    <p class="esc-cc-title" id="escCcPrefsTitle">Podešavanja kolačića</p>
    <p class="esc-cc-text" id="escCcPrefsIntro">Izaberite koje kategorije kolačića želite da dozvolite.</p>
    <div class="esc-cc-cats">
      <div class="esc-cc-cat">
        <div class="esc-cc-cat-head">
          <span class="esc-cc-cat-name" id="escCcNecName">Neophodni</span>
          <span class="esc-cc-always" id="escCcAlways">Uvek aktivni</span>
        </div>
        <p class="esc-cc-cat-desc" id="escCcNecDesc">Potrebni za osnovno funkcionisanje platforme.</p>
      </div>
      <div class="esc-cc-cat">
        <label class="esc-cc-cat-head" for="escCcAnalytics">
          <span class="esc-cc-cat-name" id="escCcAnaName">Analitički</span>
          <input type="checkbox" role="switch" class="esc-cc-switch" id="escCcAnalytics" aria-describedby="escCcAnaDesc">
        </label>
        <p class="esc-cc-cat-desc" id="escCcAnaDesc">Pomažu nam da razumemo kako se Escapii.rs koristi i da unapredimo platformu.</p>
      </div>
      <div class="esc-cc-cat">
        <label class="esc-cc-cat-head" for="escCcMarketing">
          <span class="esc-cc-cat-name" id="escCcMktName">Marketinški</span>
          <input type="checkbox" role="switch" class="esc-cc-switch" id="escCcMarketing" aria-describedby="escCcMktDesc">
        </label>
        <p class="esc-cc-cat-desc" id="escCcMktDesc">Koriste se za merenje i optimizaciju oglašavanja i marketinških aktivnosti.</p>
      </div>
    </div>
    <div class="esc-cc-actions">
      <button type="button" class="esc-cc-btn esc-cc-reject" id="escCcSave">Sačuvaj izbor</button>
      <button type="button" class="esc-cc-btn esc-cc-accept" id="escCcAcceptAll">Prihvati sve</button>
    </div>
  </div>
</div>

<script>
(function() {
  var NAME = 'esc_consent';
  var YEAR = 60 * 60 * 24 * 365;
  // Na stranama gde praćenje ne radi (token strane, prijavljeni korisnici) baner se ne nudi
  // sam i ništa se ne učitava - ali link „Podešavanja kolačića" u futeru i tamo mora da radi.
  var TRACKING = <?php echo !empty($_cc_tracking) ? 'true' : 'false'; ?>;
  var HOME = <?php echo wp_json_encode(esc_url_raw($_cc_home)); ?>;
  var GTM_ID = <?php echo wp_json_encode(ESC_GTM_ID); ?>;
  var MINI = <?php echo $_cc_mini ? 'true' : 'false'; ?>;
  var banner = document.getElementById('escCookieBanner');
  var chkA = document.getElementById('escCcAnalytics');
  var chkM = document.getElementById('escCcMarketing');

  // Tekst prati jezik sajta (esc-lang): saglasnost važi samo ako je posetilac razume.
  var TXT = {
    sr: {
      aria: 'Saglasnost za kolačiće', title: '🍪 Koristimo kolačiće',
      msg: 'Escapii koristi kolačiće i slične tehnologije kako bi platforma pravilno funkcionisala, kako bismo unapredili vaše iskustvo i, uz vaš izbor, analizirali korišćenje platforme i merili naše oglašavanje.',
      msg2: 'Možete prihvatiti sve kolačiće, odbiti one koji nisu neophodni ili podesiti svoje preferencije.',
      short: 'Escapii koristi neophodne kolačiće za funkcionisanje platforme, kao i analitičke i marketinške kolačiće uz vaš izbor.',
      cookieLink: 'Politika kolačića', privacyLink: 'Politika privatnosti',
      cookieUrl: '/politika-privatnosti/#kolacici', privacyUrl: '/politika-privatnosti/',
      accept: 'Prihvati sve', reject: 'Samo neophodni', prefs: 'Podesi kolačiće', prefsMini: 'Podesi',
      prefsTitle: 'Podešavanja kolačića', prefsIntro: 'Izaberite koje kategorije kolačića želite da dozvolite.',
      necName: 'Neophodni', always: 'Uvek aktivni', necDesc: 'Potrebni za osnovno funkcionisanje platforme.',
      anaName: 'Analitički', anaDesc: 'Pomažu nam da razumemo kako se Escapii.rs koristi i da unapredimo platformu.',
      mktName: 'Marketinški', mktDesc: 'Koriste se za merenje i optimizaciju oglašavanja i marketinških aktivnosti.',
      save: 'Sačuvaj izbor'
    },
    en: {
      aria: 'Cookie consent', title: '🍪 We use cookies',
      msg: 'Escapii uses cookies and similar technologies to make the platform work properly, to improve your experience and, based on your choice, to analyse how the platform is used and to measure our advertising.',
      msg2: 'You can accept all cookies, reject the non-essential ones or set your preferences.',
      short: 'Escapii uses essential cookies to run the platform, and analytics and marketing cookies based on your choice.',
      cookieLink: 'Cookie Policy', privacyLink: 'Privacy Policy',
      cookieUrl: '/privacy-policy/#cookies', privacyUrl: '/privacy-policy/',
      accept: 'Accept all', reject: 'Essential only', prefs: 'Cookie settings', prefsMini: 'Settings',
      prefsTitle: 'Cookie settings', prefsIntro: 'Choose which cookie categories you want to allow.',
      necName: 'Essential', always: 'Always active', necDesc: 'Needed for the basic operation of the platform.',
      anaName: 'Analytics', anaDesc: 'Help us understand how Escapii.rs is used and improve the platform.',
      mktName: 'Marketing', mktDesc: 'Used to measure and optimise our advertising and marketing activities.',
      save: 'Save choice'
    }
  };
  function jezik() {
    try { var l = localStorage.getItem('esc-lang'); if (l) return l === 'en' ? 'en' : 'sr'; } catch (e) {}
    var m = document.cookie.match(/(?:^|;\s*)esc-lang=(\w+)/);
    return m && m[1] === 'en' ? 'en' : 'sr';
  }
  function postavi(id, tekst) { var el = document.getElementById(id); if (el) el.textContent = tekst; }
  function prevedi() {
    var t = TXT[jezik()];
    banner.setAttribute('aria-label', t.aria);
    postavi('escCcTitle', t.title);
    postavi('escCcMsg', t.msg);
    postavi('escCcMsg2', t.msg2);
    postavi('escCcShort', t.short);
    postavi('escCcAccept', t.accept);
    postavi('escCcReject', t.reject);
    postavi('escCcOpenPrefs', MINI ? t.prefsMini : t.prefs);
    postavi('escCcPrefsTitle', t.prefsTitle);
    postavi('escCcPrefsIntro', t.prefsIntro);
    postavi('escCcNecName', t.necName);
    postavi('escCcAlways', t.always);
    postavi('escCcNecDesc', t.necDesc);
    postavi('escCcAnaName', t.anaName);
    postavi('escCcAnaDesc', t.anaDesc);
    postavi('escCcMktName', t.mktName);
    postavi('escCcMktDesc', t.mktDesc);
    postavi('escCcSave', t.save);
    postavi('escCcAcceptAll', t.accept);
    var ck = document.getElementById('escCcCookieLink'), pv = document.getElementById('escCcPrivacyLink');
    ck.textContent = t.cookieLink; ck.href = HOME + t.cookieUrl;
    pv.textContent = t.privacyLink; pv.href = HOME + t.privacyUrl;
  }

  // { analytics, marketing } ili null dok posetilac ne odluči (stari format se ne priznaje).
  function read() {
    var m = document.cookie.match(/(?:^|;\s*)esc_consent=v2\.a([01])\.m([01])(?:;|$)/);
    return m ? { analytics: m[1] === '1', marketing: m[2] === '1' } : null;
  }

  function save(c) {
    document.cookie = NAME + '=v2.a' + (c.analytics ? 1 : 0) + '.m' + (c.marketing ? 1 : 0)
      + ';path=/;max-age=' + YEAR + ';SameSite=Lax' + (location.protocol === 'https:' ? ';Secure' : '');
  }

  // Consent Mode: analitički -> analytics_storage, marketinški -> signali za oglase.
  function javiGoogle(c) {
    if (typeof gtag !== 'function') return;
    gtag('consent', 'update', {
      analytics_storage:  c.analytics ? 'granted' : 'denied',
      ad_storage:         c.marketing ? 'granted' : 'denied',
      ad_user_data:       c.marketing ? 'granted' : 'denied',
      ad_personalization: c.marketing ? 'granted' : 'denied'
    });
  }

  // Isti snippet koji functions.php štampa kad saglasnost već postoji.
  function loadGTM() {
    if (window.__escGtm || document.querySelector('script[src*="googletagmanager.com/gtm.js"]')) return;
    window.__escGtm = true;
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer',GTM_ID);
  }

  function loadHubSpot() {
    if (document.getElementById('hs-script-loader')) return;
    var hs = document.createElement('script');
    hs.type = 'text/javascript';
    hs.id   = 'hs-script-loader';
    hs.async = true;
    hs.defer = true;
    hs.src  = '//js-eu1.hs-scripts.com/148950343.js';
    document.head.appendChild(hs);
  }

  // _ga, HubSpot i oglasni kolačići se postavljaju na registrovani domen (.escapii.rs), ne na
  // host, pa se brišu za sve varijante domena - brisanje bez tačnog domena ne radi ništa.
  function obrisiKolacic(name) {
    var delovi = location.hostname.split('.');
    var domeni = ['', location.hostname];
    for (var i = 0; i < delovi.length - 1; i++) domeni.push('.' + delovi.slice(i).join('.'));
    domeni.forEach(function(d) {
      document.cookie = name + '=;path=/;max-age=0;expires=Thu, 01 Jan 1970 00:00:00 GMT' + (d ? ';domain=' + d : '');
    });
  }

  var ANALITICKI = /^(_ga|_gid|_gat|__hstc$|hubspotutk$|__hssc$|__hssrc$|__hs_|messagesUtk$)/;
  var MARKETINSKI = /^(_gcl_|_gac_|_fbp$|_fbc$)/;

  // Povlačenje saglasnosti mora stvarno da skloni kolačiće odbijenih kategorija, ne samo da
  // zabrani nove. Zove se i pri svakom učitavanju, pa se stanje samo popravlja ako je neka
  // skripta u međuvremenu nešto upisala.
  function ocisti(c) {
    // HubSpot sam briše i svoje pomoćne kolačiće, ali samo ako je već na strani. Kad nije,
    // red _hsp se ne puni, jer bi ga HubSpot izvršio tek posle kasnijeg pristanka.
    if (!c.analytics && document.getElementById('hs-script-loader')) {
      try { window._hsp = window._hsp || []; window._hsp.push(['revokeCookieConsent']); } catch (e) {}
    }
    document.cookie.split(';').forEach(function(x) {
      var n = x.split('=')[0].trim();
      if (!n) return;
      if ((!c.analytics && ANALITICKI.test(n)) || (!c.marketing && MARKETINSKI.test(n))) obrisiKolacic(n);
    });
  }

  function odluci(c) {
    save(c);
    javiGoogle(c);
    ocisti(c);
    if (TRACKING && (c.analytics || c.marketing)) loadGTM();
    if (TRACKING && c.analytics) loadHubSpot();
    banner.classList.remove('show');
  }

  function prikazi(podesavanja) {
    prevedi();   // jezik je mogao da se promeni bez učitavanja strane
    document.getElementById('escCcMain').hidden = !!podesavanja;
    document.getElementById('escCcPrefs').hidden = !podesavanja;
    if (podesavanja) {
      // Prekidači pokazuju trenutni izbor; pre prve odluke su isključeni.
      var c = read() || { analytics: false, marketing: false };
      chkA.checked = c.analytics;
      chkM.checked = c.marketing;
    }
    banner.classList.add('show');
  }

  document.getElementById('escCcAccept').addEventListener('click', function() { odluci({ analytics: true, marketing: true }); });
  document.getElementById('escCcReject').addEventListener('click', function() { odluci({ analytics: false, marketing: false }); });
  document.getElementById('escCcAcceptAll').addEventListener('click', function() { odluci({ analytics: true, marketing: true }); });
  document.getElementById('escCcSave').addEventListener('click', function() { odluci({ analytics: chkA.checked, marketing: chkM.checked }); });
  document.getElementById('escCcOpenPrefs').addEventListener('click', function() {
    prikazi(true);
    chkA.focus();
  });

  prevedi();
  var stanje = read();
  ocisti(stanje || { analytics: false, marketing: false });

  // Baner se sam nudi samo ako posetilac još nije odlučio, i samo tamo gde praćenje postoji.
  if (!stanje && TRACKING) prikazi(false);

  // Poziva ga link „Podešavanja kolačića" (futer i politika privatnosti): otvara podešavanja
  // sa trenutnim izborom, da se odluka može promeniti ili povući jednako lako kao što je data.
  window.escOpenCookieSettings = function() {
    prikazi(true);
    banner.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
