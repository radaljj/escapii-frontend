<?php
$_f_uri  = get_template_directory_uri();
$_f_home = rtrim(home_url('/'), '/');
?>
<style>
/* ── SHARED FOOTER ─────────────────────────────────────────────────────────── */
.esc-footer { background: #EFE9E7; padding: 64px 64px 28px; border-top: 1px solid rgba(15,45,53,.07); margin-top: 88px; }
.footer-main { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 56px; }
.footer-brand p { font-size: 14px; color: #7A9FA8; line-height: 1.75; margin-top: 16px; max-width: 280px; }
.footer-col h4 { font-size: 11px; font-weight: 800; color: #2D5F6B; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 18px; font-family: inherit; }
.footer-col a { display: block; font-size: 14px; color: #7A9FA8; text-decoration: none; margin-bottom: 10px; transition: color .2s; }
.footer-col a:hover { color: #CA8A71; }
.footer-social { margin-top: 28px; }
.footer-social h4 { font-size: 11px; font-weight: 800; color: #2D5F6B; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 16px; font-family: inherit; }
.social-icons { display: flex; gap: 12px; }
.social-icon { width: 40px; height: 40px; border-radius: 10px; background: rgba(15,45,53,.06); border: 1px solid rgba(15,45,53,.1); display: flex; align-items: center; justify-content: center; color: #7A9FA8; text-decoration: none; transition: all .2s; }
.social-icon:hover { background: #CA8A71; border-color: #CA8A71; color: #fff; }
.social-icon svg { width: 18px; height: 18px; fill: currentColor; }
.footer-divider { height: 1px; background: rgba(15,45,53,.07); margin-bottom: 24px; }
.footer-bottom { display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #7A9FA8; flex-wrap: wrap; gap: 12px; }
.footer-bottom-links { display: flex; gap: 24px; }
.footer-bottom-links a { color: #7A9FA8; text-decoration: none; font-size: 13px; transition: color .2s; }
.footer-bottom-links a:hover { color: #2D5F6B; }
@media (max-width: 768px) {
  .footer-main { grid-template-columns: 1fr 1fr; gap: 32px; }
  .esc-footer { padding: 48px 24px 24px; }
  .footer-bottom { flex-direction: column; text-align: center; }
  .footer-bottom-links { flex-wrap: wrap; justify-content: center; gap: 16px; }
}
</style>

<footer class="esc-footer">
  <div class="footer-main">
    <div class="footer-brand">
      <a href="<?php echo esc_url($_f_home); ?>/">
        <img src="<?php echo esc_url($_f_uri); ?>/images/logo-black.svg" alt="Escapii" style="height:36px;display:block;">
      </a>
      <p>Iznenađujuća putovanja za ljude koji su spremni da puste kontrolu i probaju nešto drugačije.</p>
      <div class="footer-social">
        <h4>Pratite nas</h4>
        <div class="social-icons">
          <a href="https://www.instagram.com/escapii.rs?igsh=NmMwY3djcHFncjg2&utm_source=qr" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram">
            <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="https://www.tiktok.com/@escapii.rs?_r=1&_t=ZS-96jzf1blOsf" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="TikTok">
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
      <a href="<?php echo esc_url($_f_home); ?>/#esc-about">O nama</a>
      <a href="<?php echo esc_url($_f_home); ?>/#esc-dest">Destinacije</a>
      <a href="<?php echo esc_url($_f_home); ?>/#esc-how">Kako funkcioniše</a>
      <a href="<?php echo esc_url($_f_home); ?>/#esc-who">Za koga</a>
      <a href="<?php echo esc_url($_f_home); ?>/faq/">FAQ</a>
      <a href="<?php echo esc_url($_f_home); ?>/blog/">Blog</a>
      <a href="<?php echo esc_url($_f_home); ?>/pokloni-putovanje-iznenadjenja/" style="color:#CA8A71;font-weight:600;">🎁 Pokloni putovanje iznenađenja</a>
    </div>
    <div class="footer-col">
      <h4>Polasci</h4>
      <a href="<?php echo esc_url($_f_home); ?>/#esc-booking">✈ Beograd (BEG)</a>
      <a href="<?php echo esc_url($_f_home); ?>/#esc-booking">✈ Niš (INI)</a>
    </div>
    <div class="footer-col">
      <h4>Kontakt</h4>
      <a href="mailto:escapii.team@gmail.com">✉ escapii.team@gmail.com</a>
      <a href="javascript:void(0)" onclick="openStatusModal()" style="margin-top:8px;display:inline-flex;align-items:center;gap:6px;">🔍 Proveri status rezervacije</a>
    </div>
  </div>
  <div class="footer-divider"></div>
  <div class="footer-bottom">
    <span>© 2026 Escapii - Sva prava zadržana</span>
    <div class="footer-bottom-links">
      <a href="<?php echo esc_url($_f_home); ?>/uslovi-koriscenja/">Uslovi korišćenja</a>
      <a href="<?php echo esc_url($_f_home); ?>/politika-privatnosti/">Politika privatnosti</a>
    </div>
  </div>
</footer>

<?php include get_template_directory() . '/inc/status-modal.php'; ?>
