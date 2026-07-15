<?php
$_nav_site = isset($site_url) ? $site_url : get_site_url();
$_nav_uri  = get_template_directory_uri();
?>
<nav class="esc-nav" id="mainNav">
  <a href="<?php echo esc_url($_nav_site); ?>/" class="esc-logo">
    <img src="<?php echo esc_url($_nav_uri); ?>/images/logo-white.svg" alt="Escapii">
  </a>
  <div class="nav-right">
    <div class="lang-wrap">
      <button class="lang-btn on" onclick="setLang('sr')">SR</button>
      <button class="lang-btn"    onclick="setLang('en')">EN</button>
    </div>
    <button class="nav-status" onclick="openStatusModal()" title="Proveri status rezervacije">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <span data-i18n="nav.status">Moja rezervacija</span>
    </button>
  </div>
  <button class="nav-burger" id="navBurger" onclick="togBurger()" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- SECONDARY NAV - uvijek vidljiv na podstranicama -->
<nav class="sec-nav visible" id="secNav">
  <button class="sec-nav-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-how'"          data-i18n="snav.how">Kako funkcioniše</button>
  <button class="sec-nav-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-about'"        data-i18n="snav.about">O nama</button>
  <button class="sec-nav-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-dest'"         data-i18n="snav.dest">Destinacije</button>
  <button class="sec-nav-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-who'"          data-i18n="snav.who">Za koga</button>
  <button class="sec-nav-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/faq/'"              data-i18n="snav.faq">FAQ</button>
  <button class="sec-nav-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/blog/'"             data-i18n="snav.blog">Blog</button>
  <button class="sec-nav-cta"  onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-booking'"      data-i18n="snav.book.cta">Rezerviši →</button>
  <button class="sec-nav-call" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-contact-cta'"  data-i18n="snav.call">✉ Kontaktiraj nas</button>
  <div class="sec-gift-wrap" id="secGiftWrap">
    <button class="sec-gift-btn" id="secGiftBtn" onclick="toggleSecGift()" type="button">
      🎁 <span data-i18n="nav.gift.label">Pokloni putovanje iznenađenja</span> <span class="sec-gift-caret">▾</span>
    </button>
  </div>
</nav>
<div class="sec-gift-drop" id="secGiftDrop">
  <button class="nav-gift-item primary" onclick="closeSecGift();window.location.href='<?php echo esc_url($_nav_site); ?>/pokloni/';" type="button">
    <span class="nav-gift-item-icon">🎁</span>
    <span class="nav-gift-item-text">
      <span class="nav-gift-item-label" data-i18n="nav.gift.offer">Pokloni putovanje iznenađenja</span>
      <span class="nav-gift-item-sub" data-i18n="nav.gift.offer.sub">Pokloni savršen poklon nekome ko voli da putuje</span>
    </span>
  </button>
  <button class="nav-gift-item" onclick="closeSecGift();window.location.href='<?php echo esc_url($_nav_site); ?>/poklon/';" type="button">
    <span class="nav-gift-item-icon">🔓</span>
    <span class="nav-gift-item-text">
      <span class="nav-gift-item-label" data-i18n="nav.gift.redeem">Iskoristi poklon</span>
      <span class="nav-gift-item-sub" data-i18n="nav.gift.redeem.sub">Imaš poklon kod? Aktiviraj ga ovde</span>
    </span>
  </button>
</div>

<!-- MOBILE MENU -->
<div class="mob-menu" id="mobMenu">
  <div class="mob-menu-links">
    <button class="mob-menu-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-how'"     data-i18n="snav.how">Kako funkcioniše</button>
    <button class="mob-menu-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-about'"   data-i18n="snav.about">O nama</button>
    <button class="mob-menu-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-dest'"    data-i18n="snav.dest">Destinacije</button>
    <button class="mob-menu-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-who'"     data-i18n="snav.who">Za koga</button>
    <button class="mob-menu-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/faq/'"         data-i18n="snav.faq">FAQ</button>
    <button class="mob-menu-link" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/blog/'"        data-i18n="snav.blog">Blog</button>
    <button class="mob-menu-link mob-menu-call" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-contact-cta'">
      <span data-i18n="snav.call">✉ Kontaktiraj nas</span>
      <span class="mob-menu-call-hours" data-i18n="snav.call.hours">escapii.team@gmail.com</span>
    </button>
    <div class="mob-gift-wrap">
      <button class="mob-gift-toggle" id="mobGiftToggle" onclick="togMobGift()" type="button">
        <span>🎁 <span data-i18n="nav.gift.label">Pokloni putovanje iznenađenja</span></span>
        <span class="mob-gift-caret">▾</span>
      </button>
      <div class="mob-gift-sub" id="mobGiftSub">
        <button class="mob-gift-sub-btn" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/pokloni/'" data-i18n="nav.gift.offer" type="button">🎁 Pokloni putovanje iznenađenja</button>
        <button class="mob-gift-sub-btn" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/poklon/'" data-i18n="nav.gift.redeem" type="button">🔓 Iskoristi poklon</button>
      </div>
    </div>
  </div>
  <div class="mob-menu-bottom">
    <div class="lang-wrap">
      <button class="lang-btn on" onclick="setLang('sr')">SR</button>
      <button class="lang-btn"    onclick="setLang('en')">EN</button>
    </div>
    <button class="mob-menu-book" onclick="window.location.href='<?php echo esc_url($_nav_site); ?>/#esc-booking'" data-i18n="snav.book">Rezerviši</button>
  </div>
</div>
