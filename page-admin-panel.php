<?php
/**
 * Template Name: Admin Panel
 */
if (!current_user_can('administrator')) {
    wp_redirect(home_url());
    exit;
}
?>
<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escapii - Admin Panel</title>
  <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/images/favicon.svg">
  <link rel="icon" type="image/png"     href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
  <link rel="apple-touch-icon"          href="<?php echo get_template_directory_uri(); ?>/images/favicon-white.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/sr.js"></script>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --navy:   #07102a;
  --navy2:  #0d1b38;
  --navy3:  #162040;
  --accent: #CA8A71;
  --cream:  #f5ede0;
  --white:  #ffffff;
  --gray:   #94a3b8;
  --gray2:  #64748b;
  --green:  #22c55e;
  --red:    #ef4444;
  --yellow: #f59e0b;
}

body {
  font-family: 'Inter', sans-serif;
  background: var(--navy);
  color: var(--white);
  min-height: 100vh;
}

/* ── Login ── */
.login-wrap {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: radial-gradient(ellipse at 30% 40%, rgba(202,138,113,.12) 0%, transparent 60%),
              radial-gradient(ellipse at 70% 70%, rgba(22,32,64,.8) 0%, transparent 60%),
              var(--navy);
}
.login-card {
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 24px;
  padding: 48px;
  width: 100%;
  max-width: 400px;
  box-shadow: 0 24px 64px rgba(0,0,0,.6);
}
.login-logo {
  margin-bottom: 12px;
  display: flex; align-items: center; justify-content: center;
}
.login-logo img { height: 50px; width: auto; display: block; }
.login-subtitle {
  font-size: 13px;
  color: var(--gray);
  margin-bottom: 32px;
}
.form-group { margin-bottom: 20px; }
.form-group label {
  display: block;
  font-size: 12px;
  font-weight: 700;
  color: var(--gray);
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 8px;
}
.form-input {
  width: 100%;
  background: rgba(255,255,255,.07);
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 12px;
  padding: 12px 16px;
  color: var(--white);
  font-size: 15px;
  outline: none;
  transition: border .2s;
}
.form-input:focus { border-color: var(--accent); }
.btn-primary {
  width: 100%;
  background: var(--accent);
  color: var(--navy);
  border: none;
  border-radius: 12px;
  padding: 14px;
  font-size: 15px;
  font-weight: 800;
  cursor: pointer;
  transition: opacity .2s, transform .1s;
}
.btn-primary:hover { opacity: .9; }
.btn-primary:active { transform: scale(.98); }

/* ── Layout ── */
.admin-wrap { display: none; }
.admin-header {
  background: rgba(255,255,255,.03);
  border-bottom: 1px solid rgba(255,255,255,.07);
  padding: 16px 32px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.admin-logo { display: flex; align-items: center; gap: 10px; }
.admin-logo img { height: 38px; width: auto; display: block; }
.admin-logo small {
  font-size: 11px;
  font-weight: 600;
  color: var(--gray);
  margin-left: 8px;
  letter-spacing: 1px;
  text-transform: uppercase;
}
.btn-logout {
  background: rgba(239,68,68,.12);
  color: var(--red);
  border: 1px solid rgba(239,68,68,.2);
  border-radius: 8px;
  padding: 8px 16px;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
  transition: background .2s;
}
.btn-logout:hover { background: rgba(239,68,68,.22); }

.admin-main {
  max-width: 1280px;
  margin: 0 auto;
  padding: 32px 24px;
}

/* ── Tabs ── */
.tabs {
  display: flex;
  gap: 4px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  padding: 4px;
  margin-bottom: 32px;
  width: fit-content;
}
.tab-btn {
  padding: 10px 24px;
  border-radius: 10px;
  border: none;
  background: transparent;
  color: var(--gray);
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all .2s;
}
.tab-btn.active {
  background: var(--accent);
  color: var(--navy);
}
.tab-badge {
  display: inline-flex; align-items: center; justify-content: center;
  background: var(--red); color: white;
  font-size: 10px; font-weight: 800; min-width: 18px; height: 18px;
  border-radius: 100px; padding: 0 5px; margin-left: 6px;
  vertical-align: middle; line-height: 1;
}
.tab-badge:empty { display: none; }

/* Dates sub-tabs */
.dates-sub-tabs {
  display: flex;
  gap: 4px;
  background: rgba(255,255,255,.03);
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 12px;
  padding: 4px;
  margin-bottom: 20px;
  width: fit-content;
}
.dates-sub-btn {
  padding: 8px 20px;
  border-radius: 9px;
  border: none;
  background: transparent;
  color: var(--gray);
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: all .2s;
  white-space: nowrap;
}
.dates-sub-btn.active {
  background: rgba(var(--accent-rgb, 200,169,113),.18);
  color: var(--accent);
  border: 1px solid rgba(var(--accent-rgb, 200,169,113),.3);
}
.dates-sub-btn:not(.active):hover {
  background: rgba(255,255,255,.05);
  color: #ccc;
}
.dates-sub-panel { display: none; }
.dates-sub-panel.active { display: block; }

/* Booking cards */
.booking-toolbar { display: flex; gap: 10px; margin-bottom: 12px; flex-wrap: wrap; align-items: center; }
.booking-search {
  flex: 1; min-width: 200px;
  background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.12);
  border-radius: 10px; padding: 8px 14px; color: var(--white); font-size: 14px;
  outline: none; transition: border .2s; font-family: inherit;
}
.booking-search:focus { border-color: var(--accent); }
.booking-search::placeholder { color: var(--gray2); }
.btn-export {
  padding: 8px 18px; border-radius: 10px; border: 1px solid rgba(255,255,255,.15);
  background: rgba(255,255,255,.06); color: var(--white); font-size: 13px; font-weight: 700;
  cursor: pointer; transition: all .2s; white-space: nowrap;
}
.btn-export:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.3); }
.booking-filters { display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap; }
.filter-btn {
  padding: 6px 16px; border-radius: 100px; border: 1px solid rgba(255,255,255,.12);
  background: transparent; color: var(--gray); font-size: 13px; font-weight: 600;
  cursor: pointer; transition: all .2s;
}
.filter-btn.active, .filter-btn:hover { background: var(--accent); border-color: var(--accent); color: var(--navy); }
/* Destination */
.bc-field--full { grid-column: 1 / -1; }
.bc-dest-row { display: flex; gap: 8px; align-items: center; margin-top: 4px; }
.bc-dest-input {
  flex: 1; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.09);
  border-radius: 8px; padding: 8px 12px; color: var(--white); font-size: 13px;
  font-family: inherit; outline: none; transition: border .2s;
}
.bc-dest-input:focus { border-color: var(--accent); }
select.bc-dest-input {
  appearance: none; -webkit-appearance: none;
  padding-right: 32px;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2394a3b8' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: right 10px center;
  cursor: pointer;
}
select.bc-dest-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(234,179,8,.12); }
select.bc-dest-input option { background: #0d1b38; color: var(--white); padding: 6px 10px; }
select.bc-dest-input option:disabled { color: #64748b; }
.bc-reveal-sent { color: #4ade80; font-size: 11px; font-weight: 600; }
/* Manual send buttons */
.bc-send-row { display: flex; gap: 8px; margin-top: 10px; flex-wrap: wrap; }
.bc-btn-reveal, .bc-btn-forecast {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 6px 14px; border-radius: 8px; border: none;
  font-size: 12px; font-weight: 600; font-family: inherit;
  cursor: pointer; transition: all .2s;
}
.bc-btn-reveal  { background: rgba(74,222,128,.12); color: #4ade80; border: 1px solid rgba(74,222,128,.25); }
.bc-btn-reveal:hover  { background: rgba(74,222,128,.22); }
.bc-btn-forecast { background: rgba(56,189,248,.12); color: #38bdf8; border: 1px solid rgba(56,189,248,.25); }
.bc-btn-forecast:hover { background: rgba(56,189,248,.22); }
.bc-btn-reveal:disabled, .bc-btn-forecast:disabled {
  opacity: 0.35; cursor: not-allowed;
}
/* Notes */
.bc-note-wrap { margin-top: 14px; border-top: 1px solid rgba(255,255,255,.06); padding-top: 12px; }
.bc-note-row { display: flex; gap: 8px; align-items: flex-start; }
.bc-note-input {
  flex: 1; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.09);
  border-radius: 8px; padding: 8px 12px; color: var(--white); font-size: 13px;
  font-family: inherit; resize: vertical; min-height: 52px; outline: none; transition: border .2s;
}
.bc-note-input:focus { border-color: var(--accent); }
.bc-note-save {
  flex-shrink: 0; width: 36px; height: 36px; border-radius: 8px;
  background: rgba(34,197,94,.15); border: 1px solid rgba(34,197,94,.3);
  color: var(--green); font-size: 16px; cursor: pointer; transition: all .2s;
  display: flex; align-items: center; justify-content: center;
}
.bc-note-save:hover { background: var(--green); color: var(--navy); }
.bc-note-save.saving { opacity: .5; pointer-events: none; }
.bc-note-status { font-size: 11px; margin-top: 5px; min-height: 15px; }
.booking-list { display: flex; flex-direction: column; gap: 12px; }
.booking-card {
  background: var(--card); border: 1px solid rgba(255,255,255,.07);
  border-radius: 14px; padding: 20px; transition: border-color .2s;
}
.booking-card:hover { border-color: rgba(255,255,255,.15); }
.booking-card.status-CONFIRMED  { border-left: 3px solid var(--green); }
.booking-card.status-CANCELLED  { border-left: 3px solid var(--red); opacity: .65; }
.booking-card.status-PENDING    { border-left: 3px solid var(--accent); }
.booking-card.status-COMPLETED  { border-left: 3px solid #818cf8; }
.bc-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 8px; }
.bc-ref { font-size: 15px; font-weight: 800; color: var(--white); }
.bc-date { font-size: 12px; color: var(--gray); }
.bc-status {
  display: inline-flex; align-items: center; gap: 5px;
  font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 100px;
  text-transform: uppercase; letter-spacing: .5px;
}
.bc-status.PENDING    { background: rgba(202,138,113,.15); color: var(--accent); }
.bc-status.CONFIRMED  { background: rgba(34,197,94,.15);  color: var(--green);  }
.bc-status.CANCELLED  { background: rgba(239,68,68,.15);  color: var(--red);    }
.bc-status.COMPLETED  { background: rgba(129,140,248,.15); color: #818cf8;      }
.bc-body { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 16px; }
.bc-field { font-size: 13px; }
.bc-label { color: var(--gray); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 3px; }
.bc-value { color: var(--white); font-weight: 600; }
.bc-notes { font-size: 13px; color: var(--gray); background: rgba(255,255,255,.04); border-radius: 8px; padding: 10px 12px; margin-bottom: 14px; }
.bc-reveal-box-section { margin: 0 0 14px; border: 1px solid rgba(202,138,113,.35); border-radius: 10px; overflow: hidden; }
.bc-reveal-box-header { background: rgba(202,138,113,.12); padding: 9px 14px; font-size: 12px; font-weight: 700; color: var(--accent); letter-spacing: .04em; }
.bc-reveal-box-body { padding: 12px 14px; display: flex; flex-direction: column; gap: 6px; }
.bc-reveal-box-row { display: flex; gap: 10px; font-size: 13px; align-items: baseline; }
.bc-reveal-box-label { color: var(--gray); font-size: 11px; font-weight: 700; min-width: 56px; flex-shrink: 0; }
.bc-btn-reveal-box { padding: 8px 16px; border-radius: 8px; border: 1px solid rgba(202,138,113,.5); background: rgba(202,138,113,.12); color: var(--accent); font-size: 12px; font-weight: 700; cursor: pointer; transition: all .2s; font-family: inherit; }
.bc-btn-reveal-box:hover { background: var(--accent); color: #fff; border-color: var(--accent); }
.bc-actions { display: flex; gap: 8px; }
/* Passenger section */
.bc-passengers-wrap {
  grid-column: 1 / -1;
  margin-top: 4px;
  padding: 14px 16px;
  background: rgba(255,255,255,.03);
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 10px;
}
.bc-passengers-title {
  font-size: 10px; font-weight: 700; text-transform: uppercase;
  letter-spacing: .6px; color: var(--gray); margin-bottom: 10px;
}
.bc-passenger-row {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 6px 16px;
  padding: 10px 0;
  border-bottom: 1px solid rgba(255,255,255,.05);
}
.bc-passenger-row:last-child { border-bottom: none; padding-bottom: 0; }
.bc-passenger-row:first-of-type { padding-top: 0; }
.bc-passenger-name {
  font-size: 14px; font-weight: 700; color: var(--white);
  display: flex; align-items: center; gap: 8px;
}
.bc-passenger-num {
  display: inline-flex; align-items: center; justify-content: center;
  width: 20px; height: 20px; border-radius: 50%;
  background: rgba(202,138,113,.18); color: var(--accent);
  font-size: 10px; font-weight: 800; flex-shrink: 0;
}
.bc-passenger-gender {
  font-size: 10px; font-weight: 700; padding: 2px 7px;
  border-radius: 100px; flex-shrink: 0;
}
.bc-passenger-gender.M { background: rgba(56,189,248,.12); color: #38bdf8; }
.bc-passenger-gender.F { background: rgba(244,114,182,.12); color: #f472b6; }
.bc-passenger-meta {
  grid-column: 1 / -1;
  display: flex; flex-wrap: wrap; gap: 6px 20px;
  font-size: 12px; color: var(--gray);
}
.bc-passenger-meta span { display: flex; align-items: center; gap: 5px; }
.bc-passenger-meta strong { color: var(--white); font-weight: 600; }
.bc-passport-ok   { color: #4ade80; }
.bc-passport-warn { color: #f87171; }
.bc-btn {
  padding: 7px 16px; border-radius: 8px; border: none; font-size: 12px; font-weight: 700;
  cursor: pointer; transition: all .2s; display: flex; align-items: center; gap: 5px;
}
.bc-btn:disabled { opacity: .4; cursor: not-allowed; }
.bc-btn-confirm { background: rgba(34,197,94,.15); color: var(--green); border: 1px solid rgba(34,197,94,.3); }
.bc-btn-confirm:not(:disabled):hover { background: var(--green); color: var(--navy); }
.bc-btn-cancel  { background: rgba(239,68,68,.15); color: var(--red); border: 1px solid rgba(239,68,68,.3); }
.bc-btn-cancel:not(:disabled):hover  { background: var(--red); color: white; }
.bc-btn-pending { background: rgba(202,138,113,.15); color: var(--accent); border: 1px solid rgba(202,138,113,.3); }
.bc-btn-pending:not(:disabled):hover { background: var(--accent); color: white; }
.bc-btn-price { background: none; border: 1px solid rgba(255,255,255,.2); color: var(--gray); font-size: 11px; border-radius: 6px; padding: 2px 8px; cursor: pointer; margin-left: 6px; vertical-align: middle; }
.bc-btn-price:hover { border-color: var(--accent); color: var(--accent); }
.price-popup-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.7); z-index:9999; align-items:center; justify-content:center; }
.price-popup-overlay.open { display:flex; }
.price-popup { background:#1a1d2e; border:1px solid rgba(255,255,255,.1); border-radius:14px; padding:28px; min-width:320px; max-width:420px; width:90%; }
.price-popup h3 { font-size:16px; margin-bottom:18px; color:var(--white); }
.price-popup table { width:100%; border-collapse:collapse; font-size:13px; }
.price-popup td { padding:7px 4px; border-bottom:1px solid rgba(255,255,255,.06); }
.price-popup td:last-child { text-align:right; font-weight:600; color:var(--white); }
.price-popup tr.total td { border-top:2px solid rgba(255,255,255,.15); border-bottom:none; padding-top:12px; font-size:15px; color:var(--accent); }
.price-popup-close { margin-top:18px; width:100%; padding:9px; border-radius:8px; border:none; background:rgba(255,255,255,.08); color:var(--white); cursor:pointer; font-size:13px; }
.price-popup-close:hover { background:rgba(255,255,255,.15); }
@media (max-width: 700px) { .bc-body { grid-template-columns: 1fr 1fr; } }

/* ── Panel ── */
.panel { display: none; }
.panel.active { display: block; }

.panel-title {
  font-size: 22px;
  font-weight: 800;
  margin-bottom: 6px;
}
.panel-subtitle {
  font-size: 14px;
  color: var(--gray);
  margin-bottom: 28px;
}

/* ── Card ── */
.card {
  background: rgba(255,255,255,.03);
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 20px;
  padding: 28px;
  margin-bottom: 24px;
}
.card-title {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 20px;
  padding-bottom: 16px;
  border-bottom: 1px solid rgba(255,255,255,.07);
}

/* ── Form grid ── */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.form-grid.three { grid-template-columns: 1fr 1fr 1fr; }
.form-span { grid-column: span 2; }

.field-label {
  display: block;
  font-size: 12px;
  font-weight: 700;
  color: var(--gray);
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 8px;
}
.req { color: var(--accent); }

.btn-add {
  background: var(--accent);
  color: var(--navy);
  border: none;
  border-radius: 12px;
  padding: 12px 28px;
  font-size: 14px;
  font-weight: 800;
  cursor: pointer;
  transition: opacity .2s;
  margin-top: 8px;
}
.btn-add:hover { opacity: .88; }

/* ── Table ── */
.table-wrap { overflow-x: auto; }
table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}
thead th {
  text-align: left;
  padding: 12px 16px;
  font-size: 11px;
  font-weight: 700;
  color: var(--gray);
  text-transform: uppercase;
  letter-spacing: 1px;
  border-bottom: 1px solid rgba(255,255,255,.08);
}
tbody td {
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.05);
  vertical-align: middle;
}
tbody tr:hover { background: rgba(255,255,255,.03); }
tbody tr:last-child td { border-bottom: none; }

.badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  border-radius: 100px;
  padding: 4px 10px;
  font-size: 11px;
  font-weight: 700;
}
.badge-green { background: rgba(34,197,94,.12); color: var(--green); }
.badge-red   { background: rgba(239,68,68,.12); color: var(--red); }
.badge-gray  { background: rgba(148,163,184,.1); color: var(--gray); }
.badge-accent { background: rgba(202,138,113,.12); color: var(--accent); }

/* ── Inquiry / private-date status pills ──────────────── */
.iq-pill {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 4px 11px; border-radius: 100px;
  font-size: 11px; font-weight: 700; letter-spacing: .3px;
  white-space: nowrap; border: 1px solid transparent;
}
.iq-PENDING      { background: rgba(251,191,36,.12); color: #fbbf24; border-color: rgba(251,191,36,.25); }
.iq-PRIVATE_SENT { background: rgba(202,138,113,.15); color: #e09070; border-color: rgba(202,138,113,.35); }
.iq-status-sel {
  font-size: 11px; padding: 4px 8px; border-radius: 6px; margin-top: 5px;
  background: #0d1b38; border: 1px solid rgba(255,255,255,.18);
  color: #e2e8f0; cursor: pointer; outline: none; display: block; width: 100%;
  appearance: auto; -webkit-appearance: auto;
}
.iq-status-sel:focus { border-color: var(--accent); }
.iq-status-sel option { background: #0d1b38; color: #e2e8f0; }

/* ── ERROR LOG ─────────────────────────────────────────── */
.err-row { cursor: pointer; transition: background .15s; }
.err-row:hover { background: rgba(255,255,255,.03); }
.err-row.resolved td { opacity: .45; }
.err-type { font-size: 12px; font-weight: 700; color: #ff7b72; font-family: monospace; }
.err-endpoint { font-size: 11px; color: var(--gray); font-family: monospace; margin-top: 2px; }
.err-msg { font-size: 12px; color: #e6edf3; max-width: 320px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.err-count { display: inline-block; background: rgba(255,123,114,.15); color: #ff7b72; border-radius: 20px; padding: 2px 10px; font-size: 11px; font-weight: 700; }
.err-time { font-size: 11px; color: var(--gray); }
.err-stack-wrap { display: none; background: #0d1117; border-top: 1px solid rgba(255,255,255,.06); padding: 16px 20px; }
.err-stack-wrap.open { display: table-row; }
.err-stack { font-family: monospace; font-size: 11px; color: #a5d6ff; white-space: pre-wrap; word-break: break-word; max-height: 300px; overflow-y: auto; }
.err-actions { display: flex; gap: 8px; align-items: center; }
.btn-resolve { background: rgba(34,197,94,.1); color: var(--green); border: 1px solid rgba(34,197,94,.2); border-radius: 8px; padding: 5px 12px; font-size: 11px; font-weight: 700; cursor: pointer; transition: all .15s; }
.btn-resolve:hover { background: rgba(34,197,94,.2); }
.err-badge-resolved { background: rgba(34,197,94,.1); color: var(--green); border-radius: 20px; padding: 2px 10px; font-size: 11px; font-weight: 700; }
.err-header-actions { display: flex; gap: 10px; align-items: center; margin-bottom: 16px; flex-wrap: wrap; }
.btn-clear-resolved { background: rgba(148,163,184,.08); color: var(--gray); border: 1px solid rgba(148,163,184,.15); border-radius: 8px; padding: 7px 16px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all .15s; }
.btn-clear-resolved:hover { background: rgba(148,163,184,.15); color: #fff; }
.btn-clear-all { background: rgba(239,68,68,.08); color: var(--red); border: 1px solid rgba(239,68,68,.15); border-radius: 8px; padding: 7px 16px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all .15s; }
.btn-clear-all:hover { background: rgba(239,68,68,.15); }
.err-empty { text-align: center; padding: 48px 20px; color: var(--gray); font-size: 14px; }
.err-empty-icon { font-size: 40px; margin-bottom: 12px; }

.dest-chips { display: flex; flex-wrap: wrap; gap: 5px; }
.dest-chip {
  background: rgba(202,138,113,.12);
  color: var(--accent);
  border-radius: 6px;
  padding: 3px 8px;
  font-size: 11px;
  font-weight: 700;
}

.btn-action {
  border: none;
  border-radius: 8px;
  padding: 6px 12px;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: opacity .2s;
}
.btn-action:hover { opacity: .8; }
.btn-toggle-on  { background: rgba(34,197,94,.15); color: var(--green); }
.btn-toggle-off { background: rgba(202,138,113,.15); color: var(--accent); }
.btn-delete     { background: rgba(239,68,68,.15); color: var(--red); }
.btn-edit       { background: rgba(148,163,184,.1); color: var(--gray); }

.empty-state {
  text-align: center;
  padding: 48px;
  color: var(--gray);
  font-size: 14px;
}

/* Tom Select dark theme */
.ts-wrapper .ts-control {
  background: #0a1628 !important;
  border: 1px solid rgba(255,255,255,.22) !important;
  border-radius: 12px !important;
  color: white !important;
  padding: 10px 14px !important;
  min-height: 46px !important;
}
.ts-wrapper.focus .ts-control { border-color: var(--accent) !important; box-shadow: 0 0 0 3px rgba(202,138,113,.15) !important; }
/* single select */
.ts-wrapper.single .ts-control { cursor: pointer !important; padding-right: 36px !important; }
.ts-wrapper.single .ts-control .item { background: transparent !important; color: white !important; padding: 0 !important; font-weight: 500 !important; font-size: 14px !important; }
/* multi select — placeholder visible */
.ts-wrapper.multi .ts-control { cursor: text !important; }
.ts-wrapper.multi .ts-control input { color: white !important; background: transparent !important; }
.ts-wrapper.multi .ts-control input::placeholder { color: rgba(255,255,255,.35) !important; }
.ts-wrapper.multi.has-items .ts-control input::placeholder { color: rgba(255,255,255,.25) !important; }
.ts-dropdown {
  background: #0b1929 !important;
  border: 1px solid rgba(255,255,255,.18) !important;
  border-radius: 12px !important;
  box-shadow: 0 12px 40px rgba(0,0,0,.7) !important;
  color: white !important;
}
.ts-dropdown .option { color: rgba(255,255,255,.85) !important; padding: 10px 14px !important; }
.ts-dropdown .option:hover, .ts-dropdown .option.active { background: rgba(202,138,113,.14) !important; color: var(--accent) !important; }
.ts-wrapper .item { background: var(--accent) !important; color: var(--navy) !important; border-radius: 6px !important; padding: 3px 10px !important; font-weight: 700 !important; font-size: 12px !important; border: none !important; }
.ts-wrapper .item .remove { color: var(--navy) !important; }
.ts-wrapper input { color: white !important; background: transparent !important; }
.ts-wrapper input::placeholder { color: rgba(255,255,255,.35) !important; }

/* Flatpickr dark */
.flatpickr-calendar {
  background: #0d1b38 !important;
  border: 1px solid rgba(255,255,255,.12) !important;
  border-radius: 16px !important;
  box-shadow: 0 16px 48px rgba(0,0,0,.7) !important;
  color: white !important;
}
.flatpickr-day { color: white !important; border-radius: 8px !important; }
.flatpickr-day:hover { background: rgba(202,138,113,.2) !important; }
.flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange { background: var(--accent) !important; border-color: var(--accent) !important; color: white !important; }
.flatpickr-day.inRange { background: rgba(202,138,113,.15) !important; border-color: transparent !important; }
.flatpickr-months { background: #0d1b38 !important; border-radius: 16px 16px 0 0 !important; }
.flatpickr-month, .flatpickr-weekday, .flatpickr-current-month { color: white !important; fill: white !important; }
.flatpickr-day.flatpickr-disabled { color: #334155 !important; }
.numInputWrapper:hover { background: rgba(255,255,255,.07) !important; }
.flatpickr-monthDropdown-months {
  background: #0d1b38 !important;
  color: white !important;
  border: 1px solid rgba(255,255,255,.15) !important;
  border-radius: 6px !important;
  padding: 2px 4px !important;
  font-weight: 600 !important;
  cursor: pointer !important;
}
.flatpickr-monthDropdown-months option {
  background: #1a2f50 !important;
  color: white !important;
}
.numInputWrapper input { color: white !important; }

/* SweetAlert dark */
.swal2-popup {
  background: #0d1b38 !important;
  border: 1px solid rgba(255,255,255,.1) !important;
  border-radius: 20px !important;
  color: white !important;
}
.swal2-title { color: white !important; }
.swal2-html-container { color: var(--gray) !important; }
.swal2-confirm { background: var(--accent) !important; color: white !important; border-radius: 10px !important; font-weight: 700 !important; }
.swal2-cancel { background: rgba(239,68,68,.15) !important; color: var(--red) !important; border: 1px solid rgba(239,68,68,.2) !important; border-radius: 10px !important; font-weight: 700 !important; }

/* ── Responsive ─────────────────────────────────────────── */

/* Compact table globally */
thead th { padding: 10px 12px; }
tbody td  { padding: 11px 12px; }

@media (max-width: 768px) {
  .form-grid, .form-grid.three { grid-template-columns: 1fr; }
  .form-span { grid-column: span 1; }
  .admin-main { padding: 16px 12px; }
}

/* Header */
@media (max-width: 600px) {
  .admin-header { padding: 12px 14px; }
  .admin-logo img { height: 30px; }
  .admin-logo small { display: none; }
  .btn-logout { padding: 7px 12px; font-size: 12px; }
}

/* Tabs - horizontally scrollable on mobile */
@media (max-width: 900px) {
  .tabs {
    width: 100%;
    overflow-x: auto;
    flex-wrap: nowrap;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
  }
  .tabs::-webkit-scrollbar { display: none; }
  .tab-btn { padding: 9px 16px; font-size: 13px; white-space: nowrap; }
}

/* Tables on mobile */
@media (max-width: 768px) {
  table { font-size: 12px; }
  thead th { padding: 8px 9px; font-size: 10px; }
  tbody td  { padding: 9px 9px; }
}

/* Term-dest popup responsive */
.td-popup-inner { padding: 32px; }
@media (max-width: 540px) {
  .td-popup-inner { padding: 18px; }
  .td-item { flex-wrap: wrap !important; gap: 8px !important; }
  .td-item-right { width: 100%; justify-content: flex-end !important; }
}

/* Booking cards */
@media (max-width: 500px) {
  .bc-body { grid-template-columns: 1fr; }
  .bc-header { flex-direction: column; align-items: flex-start; }
  .bc-actions { flex-wrap: wrap; }
  .panel-title { font-size: 18px; }
  .card { padding: 16px; }
}

</style>
</head>
<body>

<!-- ══ LOGIN ══ -->
<div class="login-wrap" id="loginWrap">
  <div class="login-card">
    <div class="login-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Escapii"></div>
    <div class="login-subtitle">Admin Panel - unesite ključ za pristup</div>
    <div class="form-group">
      <label>Admin ključ</label>
      <input type="password" class="form-input" id="keyInput" placeholder="••••••••••••" autocomplete="off">
    </div>
    <button class="btn-primary" onclick="doLogin()">Prijavi se →</button>
    <div id="loginError" style="color:var(--red);font-size:13px;margin-top:12px;text-align:center;display:none;">
      Pogrešan ključ
    </div>
  </div>
</div>

<!-- ══ PRICE BREAKDOWN POPUP ══ -->
<div class="price-popup-overlay" id="pricePopupOverlay" onclick="if(event.target===this)closePricePopup()">
  <div class="price-popup">
    <h3 id="pricePopupTitle"></h3>
    <table id="pricePopupTable"></table>
    <button class="price-popup-close" onclick="closePricePopup()">Zatvori</button>
  </div>
</div>

<!-- ══ ADMIN PANEL ══ -->
<div class="admin-wrap" id="adminWrap">
  <header class="admin-header">
    <div class="admin-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Escapii"><small>Admin</small></div>
    <button class="btn-logout" onclick="doLogout()">Odjavi se</button>
  </header>

  <main class="admin-main">
    <div class="tabs">
      <button class="tab-btn active" onclick="switchTab('dates')">📅 Termini</button>
      <button class="tab-btn" onclick="switchTab('bookings')">📋 Rezervacije <span class="tab-badge" id="bookingsBadge"></span></button>
      <button class="tab-btn" onclick="switchTab('destinations')">✈️ Destinacije</button>
      <button class="tab-btn" onclick="switchTab('inquiries')">📩 Upiti <span class="tab-badge" id="inquiriesBadge"></span></button>
      <button class="tab-btn" onclick="switchTab('waitlist')">🔔 Lista čekanja <span class="tab-badge" id="waitlistBadge"></span></button>
      <button class="tab-btn" onclick="switchTab('gifts')">🎁 Pokloni <span class="tab-badge" id="giftsBadge"></span></button>
      <button class="tab-btn" onclick="switchTab('errors')">🚨 Greške <span class="tab-badge" id="errorsBadge"></span></button>
    </div>

    <!-- ══ TERMINI ══ -->
    <div class="panel active" id="panel-dates">
      <div class="panel-title">Upravljanje terminima</div>
      <div class="panel-subtitle">Dodaj nove termine i povezi ih sa potencijalnim destinacijama</div>

      <!-- Forma za dodavanje -->
      <div class="card">
        <div class="card-title">➕ Dodaj novi termin</div>
        <div class="form-grid">
          <div>
            <label class="field-label">Aerodrom polaska <span class="req">*</span></label>
            <select id="fAirport" class="form-input">
              <option value="BEG">✈ Beograd (BEG)</option>
              <option value="INI">✈ Niš (INI)</option>
            </select>
          </div>
          <div>
            <label class="field-label">Broj noći <span class="req">*</span></label>
            <select id="fNights" class="form-input">
              <option value="2">2 noći</option>
              <option value="3">3 noći</option>
              <option value="4">4 noći</option>
              <option value="5">5 noći</option>
            </select>
          </div>
          <div>
            <label class="field-label">Datum polaska <span class="req">*</span></label>
            <input type="text" class="form-input" id="fDeparture" placeholder="Izaberi datum...">
          </div>
          <div>
            <label class="field-label">Datum povratka</label>
            <input type="text" class="form-input" id="fReturn" placeholder="Automatski se računa..."
                   readonly style="opacity:.55;cursor:default;">
          </div>
          <div>
            <label class="field-label">Dostupna mesta <span class="req">*</span></label>
            <input type="number" class="form-input" id="fSlots" value="50" min="1" max="500">
          </div>
          <div>
            <label class="field-label">Osnovna cena (EUR) <span class="req">*</span></label>
            <input type="number" class="form-input" id="fPrice" value="279" min="1">
          </div>
          <div class="form-span">
            <label class="field-label">Destinacije za ovaj termin <span style="color:var(--gray);font-weight:500;">(filtrirane po aerodromu polaska)</span></label>
            <select id="fDestinations" multiple placeholder="Pretraži i izaberi destinacije..."></select>
          </div>
        </div>
        <button class="btn-add" onclick="addDate()">Dodaj termin</button>
      </div>

      <!-- Sub-tabovi za termine -->
      <div class="dates-sub-tabs">
        <button class="dates-sub-btn active" onclick="switchDatesTab('javni', this)">📋 Javni termini</button>
        <button class="dates-sub-btn" onclick="switchDatesTab('privatni', this)">🔒 Privatni <span class="tab-badge" id="privateBadge"></span></button>
        <button class="dates-sub-btn" onclick="switchDatesTab('deaktivirani', this)">📦 Deaktivirani <span class="tab-badge" id="deaktivBadge"></span></button>
      </div>

      <!-- Javni termini -->
      <div class="dates-sub-panel active" id="sub-javni">
        <div class="table-wrap">
          <table id="datesTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Aerodrom</th>
                <th>Polazak</th>
                <th>Povratak</th>
                <th>Noći</th>
                <th>Mesta</th>
                <th>Cena</th>
                <th>Pot. destinacije</th>
                <th>Akcije</th>
              </tr>
            </thead>
            <tbody id="datesBody">
              <tr><td colspan="9" class="empty-state">Učitavanje...</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Privatni termini -->
      <div class="dates-sub-panel" id="sub-privatni">
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Aerodrom</th>
                <th>Polazak → Povratak</th>
                <th>Mesta / Cena</th>
                <th>Destinacije</th>
                <th>Privatni link</th>
                <th>Ističe</th>
                <th>Akcije</th>
              </tr>
            </thead>
            <tbody id="privateDatesBody">
              <tr><td colspan="7" class="empty-state">Nema aktivnih privatnih termina.</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Deaktivirani termini (javni inactive + privatni expired) -->
      <div class="dates-sub-panel" id="sub-deaktivirani">
        <div class="table-wrap">
          <table id="deactivatedTable">
            <thead>
              <tr>
                <th>Tip</th>
                <th>Aerodrom</th>
                <th>Polazak → Povratak</th>
                <th>Noći</th>
                <th>Mesta / Cena</th>
                <th>Razlog</th>
                <th>Akcije</th>
              </tr>
            </thead>
            <tbody id="deactivatedBody">
              <tr><td colspan="7" class="empty-state">Nema deaktiviranih termina.</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══ REZERVACIJE ══ -->
    <div class="panel" id="panel-bookings">
      <div class="panel-title">Rezervacije</div>
      <div class="panel-subtitle">Pregled svih upita - potvrdi ili otkaži rezervaciju</div>

      <div class="booking-toolbar">
        <input type="text" class="booking-search" id="bookingSearch"
               placeholder="🔍 Pretraži po imenu, emailu, broju rezervacije..."
               autocomplete="new-password" name="booking-search-field"
               onfocus="this.value=''" oninput="renderBookings()">
        <button class="btn-export" onclick="exportCSV()">📥 Export CSV</button>
      </div>

      <div class="booking-filters">
        <button class="filter-btn" onclick="filterBookings('ALL', this)">Sve</button>
        <button class="filter-btn active" onclick="filterBookings('PENDING', this)">⏳ Na čekanju</button>
        <button class="filter-btn" onclick="filterBookings('CONFIRMED', this)">✅ Potvrđene</button>
        <button class="filter-btn" onclick="filterBookings('CANCELLED', this)">❌ Otkazane</button>
        <button class="filter-btn" onclick="filterBookings('COMPLETED', this)">🏁 Završene</button>
      </div>

      <div class="booking-list" id="bookingList">
        <div class="empty-state">Učitavanje rezervacija...</div>
      </div>
    </div>

    <!-- ══ UPITI ZA CUSTOM TERMINE ══ -->
    <div class="panel" id="panel-inquiries">
      <div class="panel-title">Upiti za prilagođene termine</div>
      <div class="panel-subtitle">Korisnici koji nisu pronašli odgovarajući datum u ponudi</div>
      <div id="inquiriesTable" style="margin-top:16px;">Učitavanje...</div>
    </div>

    <!-- ══ LISTA ČEKANJA ══ -->
    <div class="panel" id="panel-waitlist">
      <div class="panel-title">Lista čekanja</div>
      <div class="panel-subtitle">Korisnici koji čekaju da se otvore termini</div>
      <div id="wlCards" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;"></div>
      <div class="card">
        <div class="table-wrap">
          <table>
            <thead>
              <tr><th>Email</th><th>Aerodrom</th><th>Datum prijave</th></tr>
            </thead>
            <tbody id="waitlistBody">
              <tr><td colspan="3" class="empty-state">Učitavanje...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══ POKLONI ══ -->
    <div class="panel" id="panel-gifts">
      <div class="panel-title">Pokloni iznenađenje</div>
      <div class="panel-subtitle">Upravljanje gift vaučerima i putovanjima iznenađenja</div>


      <!-- ⚠️ Podsetnik: vaučer lifecycle -->
      <div style="background:rgba(202,138,113,.1);border:1px solid rgba(202,138,113,.3);border-radius:12px;padding:14px 18px;margin-bottom:16px;font-size:13px;line-height:1.7;color:rgba(246,241,230,.8);">
        <strong style="color:#CA8A71;">⚠️ Vaučer lifecycle - VAŽNO:</strong><br>
        Kad korisnik unese vaučer pri rezervaciji → iznos se odmah oduzima od preostalog iznosa vaučera.<br>
        Ako vaučer <strong>pokrije celu cenu putovanja</strong> → status postaje <strong style="color:#fbbf24;">RESERVED</strong> (čeka COMPLETED da postane USED).<br>
        Ako vaučer <strong>pokrije samo deo</strong> → ostaje <strong style="color:#22c55e;">ACTIVE</strong> i može se odmah koristiti ponovo za preostali iznos.<br>
        Ako se rezervacija <strong>otkaže ili obriše</strong> → iznos se vraća na vaučer, status → <strong style="color:#93c5fd;">ACTIVE</strong>.<br>
        Vaučer postaje <strong>USED</strong> tek kad rezervacija pređe u COMPLETED i u potpunosti je potrošen.
      </div>

      <!-- Vaučeri -->
      <div id="gift-sub-vouchers">
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Kupac</th>
                <th>Iznos</th>
                <th>Status</th>
                <th>Poruka</th>
                <th>Kreiran</th>
                <th>Ističe</th>
                <th>Akcije</th>
              </tr>
            </thead>
            <tbody id="giftVouchersTbody">
              <tr><td colspan="8" style="text-align:center;padding:32px;color:#64748b;">Učitavanje...</td></tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- ══ GREŠKE ══ -->
    <div class="panel" id="panel-errors">
      <div class="panel-title">Log grešaka</div>
      <div class="panel-subtitle">Neočekivane greške aplikacije - ista greška se grupiše, email se šalje samo pri prvoj pojavi</div>
      <div class="card">
        <div class="err-header-actions">
          <button class="btn-clear-resolved" onclick="clearResolvedErrors()">🧹 Obriši rešene</button>
          <button class="btn-clear-all" onclick="clearAllErrors()">🗑 Obriši sve</button>
        </div>
        <div id="errorsContent">
          <div class="empty-state">Učitavanje...</div>
        </div>
      </div>
    </div>

    <!-- ══ DESTINACIJE ══ -->
    <div class="panel" id="panel-destinations">
      <div class="panel-title">Upravljanje destinacijama</div>
      <div class="panel-subtitle">Dodaj, uredi ili ukloni destinacije iz sistema</div>

      <!-- Forma za dodavanje -->
      <div class="card">
        <div class="card-title">➕ Dodaj novu destinaciju</div>
        <div class="form-grid">
          <div>
            <label class="field-label">Naziv <span class="req">*</span></label>
            <input type="text" class="form-input" id="dName" placeholder="npr. Barcelona">
          </div>
          <div>
            <label class="field-label">IATA kod odredišta <span class="req">*</span></label>
            <input type="text" class="form-input" id="dIata" placeholder="npr. BCN" maxlength="10" oninput="this.value=this.value.toUpperCase()">
          </div>
          <div>
            <label class="field-label">Država <span class="req">*</span></label>
            <input type="text" class="form-input" id="dCountry" placeholder="npr. Španija">
          </div>
          <div>
            <label class="field-label">Aerodromi polaska <span class="req">*</span></label>
            <div style="display:flex;gap:20px;padding:12px 0;">
              <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;">
                <input type="checkbox" id="dBEG" value="BEG" checked style="accent-color:var(--accent);width:16px;height:16px;"> BEG (Beograd)
              </label>
              <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;">
                <input type="checkbox" id="dINI" value="INI" style="accent-color:var(--accent);width:16px;height:16px;"> INI (Niš)
              </label>
            </div>
          </div>
          <div class="form-span">
            <label class="field-label">Slika destinacije <span style="color:var(--gray);font-weight:400;">(opciono)</span></label>
            <div id="dImgPreview" style="margin-bottom:8px;"></div>
            <input type="file" id="dImg" accept="image/jpeg,image/png,image/webp" style="display:none;" onchange="previewNewImg(this)">
            <button onclick="document.getElementById('dImg').click()"
                    style="background:rgba(255,255,255,.05);border:1px dashed rgba(255,255,255,.2);border-radius:10px;padding:10px 20px;color:var(--gray);cursor:pointer;font-size:13px;width:100%;font-family:inherit;transition:border-color .2s;"
                    onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='rgba(255,255,255,.2)'">
              📁 Izaberi sliku (JPG, PNG, WebP — max 5MB)
            </button>
          </div>
        </div>
        <button class="btn-add" onclick="createDestination()">Dodaj destinaciju</button>
      </div>

      <!-- Tabela destinacija -->
      <div class="card">
        <div class="card-title">Sve destinacije</div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Slika</th>
                <th>Grad</th>
                <th>Zemlja</th>
                <th>IATA</th>
                <th>Aerodromi</th>
                <th>Akcije</th>
              </tr>
            </thead>
            <tbody id="destBody">
              <tr><td colspan="8" class="empty-state">Učitavanje...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</div>

<!-- ══ EDIT DESTINATION MODAL ══ -->
<div id="editDestOverlay" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.65);backdrop-filter:blur(4px);align-items:center;justify-content:center;" onclick="if(event.target===this)closeEditDest()">
  <div style="background:#0d1b38;border:1px solid rgba(255,255,255,.12);border-radius:18px;width:540px;max-width:95vw;max-height:90vh;overflow-y:auto;padding:32px;">
    <div style="font-size:18px;font-weight:800;margin-bottom:24px;color:var(--white);">✏️ Uredi destinaciju</div>
    <input type="hidden" id="editDestId">
    <div class="form-grid" style="margin-bottom:16px;">
      <div>
        <label class="field-label">Naziv <span class="req">*</span></label>
        <input type="text" class="form-input" id="editDestName">
      </div>
      <div>
        <label class="field-label">IATA kod odredišta <span class="req">*</span></label>
        <input type="text" class="form-input" id="editDestIata" maxlength="10" oninput="this.value=this.value.toUpperCase()">
      </div>
      <div>
        <label class="field-label">Država <span class="req">*</span></label>
        <input type="text" class="form-input" id="editDestCountry">
      </div>
      <div>
        <label class="field-label">Aerodromi polaska <span class="req">*</span></label>
        <div style="display:flex;gap:20px;padding:12px 0;">
          <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;">
            <input type="checkbox" id="editDestBEG" value="BEG" style="accent-color:var(--accent);width:16px;height:16px;"> BEG (Beograd)
          </label>
          <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;">
            <input type="checkbox" id="editDestINI" value="INI" style="accent-color:var(--accent);width:16px;height:16px;"> INI (Niš)
          </label>
        </div>
      </div>
    </div>
    <div style="margin-bottom:24px;">
      <label class="field-label">Slika destinacije</label>
      <div id="editDestImgPreview" style="margin-bottom:10px;"></div>
      <input type="file" id="editDestImg" accept="image/jpeg,image/png,image/webp" style="display:none;" onchange="previewEditImg(this)">
      <button onclick="document.getElementById('editDestImg').click()"
              style="background:rgba(255,255,255,.05);border:1px dashed rgba(255,255,255,.2);border-radius:10px;padding:12px 20px;color:var(--gray);cursor:pointer;font-size:13px;width:100%;font-family:inherit;transition:border-color .2s;"
              onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='rgba(255,255,255,.2)'">
        📁 Izaberi sliku (JPG, PNG, WebP — max 5MB)
      </button>
    </div>
    <div style="display:flex;gap:10px;justify-content:flex-end;">
      <button onclick="closeEditDest()" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:var(--gray);border-radius:10px;padding:10px 20px;cursor:pointer;font-family:inherit;font-size:13px;font-weight:600;">Otkaži</button>
      <button onclick="saveEditDest()" style="background:var(--accent);border:none;color:white;border-radius:10px;padding:10px 24px;cursor:pointer;font-family:inherit;font-size:14px;font-weight:700;">Sačuvaj promene</button>
    </div>
  </div>
</div>

<!-- ══ TERM DESTINATIONS POPUP ══ -->
<div id="termDestOverlay" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.65);backdrop-filter:blur(4px);align-items:center;justify-content:center;" onclick="if(event.target===this)closeTermDestPopup()">
  <div class="td-popup-inner" style="background:#0d1b38;border:1px solid rgba(255,255,255,.12);border-radius:18px;width:580px;max-width:95vw;max-height:88vh;overflow-y:auto;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
      <div style="font-size:18px;font-weight:800;color:var(--white);">✈️ Destinacije za termin <span id="termDestTitle" style="color:var(--accent);"></span></div>
      <button onclick="closeTermDestPopup()" style="background:none;border:none;color:var(--gray);font-size:20px;cursor:pointer;padding:4px 8px;">✕</button>
    </div>
    <!-- Dodaj destinaciju -->
    <div style="margin-bottom:20px;padding:16px;background:rgba(255,255,255,.04);border-radius:12px;border:1px solid rgba(255,255,255,.08);">
      <label class="field-label" style="margin-bottom:8px;display:block;">Dodaj destinaciju u ovaj termin</label>
      <div style="display:flex;gap:10px;">
        <select id="termDestSelect" style="flex:1;background:#0a1628;border:1px solid rgba(255,255,255,.12);border-radius:10px;padding:10px 14px;color:var(--white);font-family:inherit;font-size:14px;">
          <option value="">-- izaberi destinaciju --</option>
        </select>
        <button onclick="addDestToTerm()" style="background:var(--accent);border:none;color:white;border-radius:10px;padding:10px 20px;cursor:pointer;font-family:inherit;font-size:14px;font-weight:700;white-space:nowrap;">+ Dodaj</button>
      </div>
    </div>
    <!-- Lista destinacija -->
    <div id="termDestList" style="display:flex;flex-direction:column;gap:8px;">
      <div style="color:var(--gray);text-align:center;padding:20px;">Učitavanje...</div>
    </div>
    <div style="margin-top:20px;text-align:right;">
      <button onclick="closeTermDestPopup()" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:var(--gray);border-radius:10px;padding:10px 24px;cursor:pointer;font-family:inherit;font-size:14px;font-weight:600;">Zatvori</button>
    </div>
  </div>
</div>

<script>
const API  = '<?php echo esc_js(escapii_api_url()); ?>';
let ADMIN_KEY = '';
let ALL_DESTINATIONS = [];
let destTomSelect = null;

// ══ LOGIN ══
function doLogin() {
  const key = document.getElementById('keyInput').value.trim();
  if (!key) return;

  fetch(`${API}/api/admin/dates`, {
    headers: { 'X-Admin-Key': key }
  }).then(r => {
    if (r.ok) {
      ADMIN_KEY = key;
      document.getElementById('loginWrap').style.display = 'none';
      document.getElementById('adminWrap').style.display = 'block';
      initAdmin();
    } else {
      document.getElementById('loginError').style.display = 'block';
    }
  }).catch(() => {
    document.getElementById('loginError').style.display = 'block';
  });
}

document.getElementById('keyInput').addEventListener('keydown', e => {
  if (e.key === 'Enter') doLogin();
});

function showPriceBreakdown(b) {
  document.getElementById('pricePopupTitle').textContent = `Cenovnik - ${b.bookingRef}`;
  const rows = [];
  const tr = (label, val) => `<tr><td>${label}</td><td>${val}</td></tr>`;
  const n = b.numberOfTravelers || 1;
  // Broj noći (za doručak) - iz polja ili izračunato iz datuma
  let nights = b.numberOfNights;
  if (!nights && b.departureDate && b.returnDate) {
    nights = Math.round((new Date(b.returnDate) - new Date(b.departureDate)) / 86400000);
  }
  // ── Po osobi (množi se brojem putnika) ──
  rows.push(tr('Osnovna cena', `${b.basePricePerPerson}€/os`));
  if (b.accommodationType === 'SUPERIOR') rows.push(tr('Superior hotel', '+100€/os'));
  if (b.hasBreakfast)     rows.push(tr(`Doručak${nights ? ' ('+nights+' noći)' : ''}`, `+${20 * (nights || 0)}€/os`));
  if (b.hasInsurance)     rows.push(tr('Osiguranje', '+12€/os'));
  if (b.hasSeatsTogether) rows.push(tr('Sedišta zajedno', '+24€/os'));
  rows.push(`<tr class="subtotal"><td>Po osobi (${b.totalPricePerPerson}€/os) × ${n} ${n === 1 ? 'putnik' : 'putnika'}</td><td>${b.totalPricePerPerson * n}€</td></tr>`);
  // ── Flat doplate (NE množe se brojem putnika) ──
  if (b.cabinSuitcaseCount > 0) rows.push(tr(`Ručni kofer × ${b.cabinSuitcaseCount}`, `+${100 * b.cabinSuitcaseCount}€`));
  if (b.exclusionCostEur > 0)   rows.push(tr(`Isključivanja (${b.exclusionCount}×)`, `+${b.exclusionCostEur}€`));
  if (n === 1)            rows.push(tr('Doplata za solo putnika', '+60€'));
  if (b.hasRevealBox)     rows.push(tr('📦 Reveal Box', '+25€'));
  if (b.voucherDiscount > 0) rows.push(tr(`🎟️ Vaučer (${b.appliedVoucherCode || ''})`, `−${b.voucherDiscount}€`));
  rows.push(`<tr class="total"><td><strong>UKUPNO</strong></td><td><strong>${b.totalPriceAll}€</strong></td></tr>`);
  document.getElementById('pricePopupTable').innerHTML = rows.join('');
  document.getElementById('pricePopupOverlay').classList.add('open');
}
function closePricePopup() {
  document.getElementById('pricePopupOverlay').classList.remove('open');
}

function doLogout() {
  ADMIN_KEY = '';
  location.reload();
}

// ══ INIT ══
let airportTs = null;
let nightsTs  = null;

async function initAdmin() {
  // Briši autofill iz search polja - browser ponekad ubaci korisničko ime
  const bs = document.getElementById('bookingSearch');
  if (bs) { bs.value = ''; bs.setAttribute('readonly', 'true'); setTimeout(() => bs.removeAttribute('readonly'), 100); }

  await Promise.all([loadDestinations(), loadDates(), loadBookings(), loadWaitlist(), loadErrorsBadge()]);

  airportTs = new TomSelect('#fAirport', {
    create: false, allowEmptyOption: false, controlInput: null,
    onChange() { initDestSelect(); }
  });

  nightsTs = new TomSelect('#fNights', {
    create: false, allowEmptyOption: false, controlInput: null,
    onChange() { autoFillReturn(); }
  });

  initDestSelect();
  initFlatpickr();
}

function getAdminAirport() {
  return airportTs ? airportTs.getValue() : document.getElementById('fAirport').value;
}
function getAdminNights() {
  return nightsTs ? parseInt(nightsTs.getValue()) : parseInt(document.getElementById('fNights').value);
}

// ══ ERROR HELPER ══
// Swal toast - ne blokira, auto-dismiss za 4s. Koristi se za API greške u load funkcijama.
function apiErr(msg) {
  Swal.fire({
    toast: true, position: 'top-end', icon: 'error',
    title: msg || 'Greška pri učitavanju. Pokušajte ponovo.',
    showConfirmButton: false, timer: 4000, timerProgressBar: true,
    background: '#1e0f0f', color: '#fca5a5',
    didOpen: (el) => { el.addEventListener('mouseenter', Swal.stopTimer); el.addEventListener('mouseleave', Swal.resumeTimer); }
  });
}

// ══ DESTINATIONS ══
async function loadDestinations() {
  try {
    const r = await fetch(`${API}/api/admin/destinations`, { headers: { 'X-Admin-Key': ADMIN_KEY } });
    if (!r.ok) throw new Error(`HTTP ${r.status}`);
    ALL_DESTINATIONS = await r.json();
    renderDestTable();
  } catch (e) {
    apiErr('Greška pri učitavanju destinacija.');
    console.error('[loadDestinations]', e);
  }
}

function renderDestTable() {
  const tbody = document.getElementById('destBody');
  if (!ALL_DESTINATIONS.length) {
    tbody.innerHTML = '<tr><td colspan="7" class="empty-state">Nema destinacija</td></tr>';
    return;
  }
  tbody.innerHTML = ALL_DESTINATIONS.map(d => {
    const imgHtml = d.imageUrl
      ? `<img src="${d.imageUrl}" alt="${d.name}" style="width:56px;height:40px;object-fit:cover;border-radius:6px;display:block;">`
      : `<div style="width:56px;height:40px;border-radius:6px;background:rgba(255,255,255,.06);display:flex;align-items:center;justify-content:center;font-size:20px;">✈️</div>`;
    return `
    <tr>
      <td><span style="color:var(--gray);font-size:12px;">#${d.id}</span></td>
      <td>${imgHtml}</td>
      <td><strong>${d.name}</strong></td>
      <td>${d.country}</td>
      <td><span class="badge badge-gray">${d.airportCode}</span></td>
      <td>${(d.departureAirports||[]).sort().map(a => `<span class="badge badge-accent">${a}</span>`).join(' ')}</td>
      <td style="white-space:nowrap;">
        <button class="btn-action btn-edit" onclick="openEditDest(${d.id})">Uredi</button>
        <button class="btn-action btn-delete" onclick="deleteDestination(${d.id})" style="margin-left:4px;">Obriši</button>
      </td>
    </tr>`;
  }).join('');
}

function previewNewImg(input) {
  const file = input.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = e => {
    document.getElementById('dImgPreview').innerHTML =
      `<img src="${e.target.result}" style="height:64px;border-radius:8px;object-fit:cover;" alt="preview">
       <div style="font-size:11px;color:#4ade80;margin-top:4px;">Slika će biti uploadovana</div>`;
  };
  reader.readAsDataURL(file);
}

async function createDestination() {
  const name    = document.getElementById('dName').value.trim();
  const iata    = document.getElementById('dIata').value.trim().toUpperCase();
  const country = document.getElementById('dCountry').value.trim();
  const airports = [];
  if (document.getElementById('dBEG').checked) airports.push('BEG');
  if (document.getElementById('dINI').checked) airports.push('INI');

  if (!name || !iata || !country) {
    Swal.fire({ icon: 'warning', title: 'Popuni obavezna polja', text: 'Naziv, IATA kod i država su obavezni.', background: '#0d1b38', color: '#fff' });
    return;
  }
  if (airports.length === 0) {
    Swal.fire({ icon: 'warning', title: 'Izaberi aerodrom', text: 'Barem jedan aerodrom polaska mora biti odabran.', background: '#0d1b38', color: '#fff' });
    return;
  }
  try {
    const r = await fetch(`${API}/api/admin/destinations`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-Admin-Key': ADMIN_KEY },
      body: JSON.stringify({ name, airportCode: iata, country, region: null, departureAirports: airports })
    });
    if (!r.ok) {
      const err = await r.json().catch(() => ({}));
      throw new Error(err.message || `HTTP ${r.status}`);
    }
    const newDest = await r.json();
    // Upload slike ako je izabrana
    const imgFile = document.getElementById('dImg').files[0];
    if (imgFile) {
      const fd = new FormData();
      fd.append('file', imgFile);
      await fetch(`${API}/api/admin/destinations/${newDest.id}/image`, {
        method: 'POST',
        headers: { 'X-Admin-Key': ADMIN_KEY },
        body: fd
      });
    }
    document.getElementById('dName').value    = '';
    document.getElementById('dIata').value    = '';
    document.getElementById('dCountry').value = '';
    document.getElementById('dBEG').checked   = true;
    document.getElementById('dINI').checked   = false;
    document.getElementById('dImg').value     = '';
    document.getElementById('dImgPreview').innerHTML = '';
    await loadDestinations();
    Swal.fire({ icon: 'success', title: 'Destinacija dodana!', text: `${newDest.name} (${newDest.airportCode}) je dodata u sistem.`, timer: 2000, showConfirmButton: false, background: '#0d1b38', color: '#fff' });
  } catch(e) {
    Swal.fire({ icon: 'error', title: 'Greška', text: e.message, background: '#0d1b38', color: '#fff' });
  }
}

function openEditDest(id) {
  const d = ALL_DESTINATIONS.find(x => x.id === id);
  if (!d) return;
  document.getElementById('editDestId').value      = id;
  document.getElementById('editDestName').value    = d.name;
  document.getElementById('editDestIata').value    = d.airportCode;
  document.getElementById('editDestCountry').value = d.country;
  document.getElementById('editDestBEG').checked   = (d.departureAirports||[]).includes('BEG');
  document.getElementById('editDestINI').checked   = (d.departureAirports||[]).includes('INI');
  document.getElementById('editDestImg').value     = '';
  const preview = document.getElementById('editDestImgPreview');
  preview.innerHTML = d.imageUrl
    ? `<img src="${d.imageUrl}" style="height:72px;border-radius:8px;object-fit:cover;" alt="${d.name}">
       <div style="font-size:11px;color:var(--gray);margin-top:5px;">Trenutna slika — izaberi novu da je zameniš</div>`
    : '';
  document.getElementById('editDestOverlay').style.display = 'flex';
}

function closeEditDest() {
  document.getElementById('editDestOverlay').style.display = 'none';
}

function previewEditImg(input) {
  const file = input.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = e => {
    document.getElementById('editDestImgPreview').innerHTML =
      `<img src="${e.target.result}" style="height:72px;border-radius:8px;object-fit:cover;" alt="preview">
       <div style="font-size:11px;color:#4ade80;margin-top:5px;">Nova slika — biće uploadovana</div>`;
  };
  reader.readAsDataURL(file);
}

async function saveEditDest() {
  const id      = parseInt(document.getElementById('editDestId').value);
  const name    = document.getElementById('editDestName').value.trim();
  const iata    = document.getElementById('editDestIata').value.trim().toUpperCase();
  const country = document.getElementById('editDestCountry').value.trim();
  const airports = [];
  if (document.getElementById('editDestBEG').checked) airports.push('BEG');
  if (document.getElementById('editDestINI').checked) airports.push('INI');

  if (!name || !iata || !country) {
    Swal.fire({ icon: 'warning', title: 'Popuni obavezna polja', background: '#0d1b38', color: '#fff' });
    return;
  }
  if (airports.length === 0) {
    Swal.fire({ icon: 'warning', title: 'Izaberi barem jedan aerodrom', background: '#0d1b38', color: '#fff' });
    return;
  }
  try {
    const r = await fetch(`${API}/api/admin/destinations/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json', 'X-Admin-Key': ADMIN_KEY },
      body: JSON.stringify({ name, airportCode: iata, country, region: null, departureAirports: airports })
    });
    if (!r.ok) {
      const err = await r.json().catch(() => ({}));
      throw new Error(err.message || `HTTP ${r.status}`);
    }
    const imgFile = document.getElementById('editDestImg').files[0];
    if (imgFile) {
      const fd = new FormData();
      fd.append('file', imgFile);
      const ri = await fetch(`${API}/api/admin/destinations/${id}/image`, {
        method: 'POST',
        headers: { 'X-Admin-Key': ADMIN_KEY },
        body: fd
      });
      if (!ri.ok) throw new Error('Greška pri uploadovanju slike');
    }
    closeEditDest();
    await loadDestinations();
    Swal.fire({ icon: 'success', title: 'Sačuvano!', timer: 1500, showConfirmButton: false, background: '#0d1b38', color: '#fff' });
  } catch(e) {
    Swal.fire({ icon: 'error', title: 'Greška pri čuvanju', text: e.message, background: '#0d1b38', color: '#fff' });
  }
}

async function deleteDestination(id) {
  const dest = ALL_DESTINATIONS.find(d => d.id === id);
  const name = dest ? dest.name : `#${id}`;
  const { isConfirmed } = await Swal.fire({
    title: 'Obrisati destinaciju?',
    html: `<span style="color:#94a3b8;">Ovo trajno briše <strong style="color:white;">${name}</strong> iz sistema.<br>Akcija je <strong style="color:#ef4444;">nepovratna</strong>.</span>`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Obriši',
    cancelButtonText: 'Otkaži',
    confirmButtonColor: '#ef4444',
    background: '#0d1b38', color: '#fff'
  });
  if (!isConfirmed) return;
  try {
    const r = await fetch(`${API}/api/admin/destinations/${id}`, {
      method: 'DELETE',
      headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) {
      const err = await r.json().catch(() => ({}));
      throw new Error(err.message || `HTTP ${r.status}`);
    }
    await loadDestinations();
    Swal.fire({ icon: 'success', title: 'Destinacija obrisana', timer: 1500, showConfirmButton: false, background: '#0d1b38', color: '#fff' });
  } catch(e) {
    Swal.fire({ icon: 'error', title: 'Greška', text: e.message, background: '#0d1b38', color: '#fff' });
  }
}

function initDestSelect() {
  const airport  = getAdminAirport() || 'BEG';
  const filtered = ALL_DESTINATIONS.filter(d =>
    Array.isArray(d.departureAirports) && d.departureAirports.includes(airport)
  );
  if (destTomSelect) { destTomSelect.destroy(); destTomSelect = null; }
  destTomSelect = new TomSelect('#fDestinations', {
    maxItems: 20,
    valueField: 'value',
    labelField: 'text',
    searchField: ['text'],
    options: filtered.map(d => ({
      value: String(d.id),
      text:  `${d.name} (${d.airportCode})`,
      label: `${d.name}`
    })),
    placeholder: filtered.length
      ? `Pretraži destinacije za ${airport}...`
      : 'Nema destinacija za ovaj aerodrom',
    plugins: ['remove_button'],
    render: {
      option: (d) => `<div class="option">${d.text}</div>`,
      item:   (d) => `<div>${d.label}</div>`,
    }
  });
}

// ══ PER-TERMIN DESTINACIJE POPUP ══
let _termDestDateId = null;

async function openTermDestPopup(dateId, airport) {
  _termDestDateId = dateId;
  const overlay = document.getElementById('termDestOverlay');
  overlay.style.display = 'flex';
  document.getElementById('termDestTitle').textContent = `#${dateId} — ${airport || ''}`;
  document.getElementById('termDestList').innerHTML =
    '<div style="color:var(--gray);text-align:center;padding:20px;">Učitavanje...</div>';

  const select = document.getElementById('termDestSelect');
  const availDests = airport
    ? ALL_DESTINATIONS.filter(d => Array.isArray(d.departureAirports) && d.departureAirports.includes(airport))
    : ALL_DESTINATIONS;
  select.innerHTML = '<option value="">-- izaberi destinaciju --</option>' +
    availDests.map(d => `<option value="${d.id}">${d.name} (${d.airportCode})</option>`).join('');

  await refreshTermDestList();
}

async function refreshTermDestList() {
  const r = await fetch(`${API}/api/admin/dates/${_termDestDateId}/destinations`, {
    headers: { 'X-Admin-Key': ADMIN_KEY }
  });
  const dests = r.ok ? await r.json() : [];
  const list = document.getElementById('termDestList');
  if (!dests.length) {
    list.innerHTML = '<div style="color:var(--gray);text-align:center;padding:20px;font-size:13px;">Nema destinacija u ovom terminu</div>';
    return;
  }
  list.innerHTML = dests.map(td => `
    <div class="td-item" style="display:flex;align-items:center;justify-content:space-between;padding:12px 16px;background:rgba(255,255,255,.04);border-radius:10px;border:1px solid rgba(255,255,255,.07);${td.active ? '' : 'opacity:.55;'}">
      <div style="display:flex;align-items:center;gap:12px;min-width:0;">
        ${td.imageUrl
          ? `<img src="${td.imageUrl}" style="width:44px;height:32px;object-fit:cover;border-radius:6px;flex-shrink:0;" alt="${td.name}">`
          : `<div style="width:44px;height:32px;border-radius:6px;background:rgba(255,255,255,.06);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;">✈️</div>`}
        <div style="min-width:0;">
          <div style="font-weight:700;font-size:14px;color:var(--white);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${td.name}</div>
          <div style="font-size:11px;color:var(--gray);margin-top:2px;">${td.country} · <span style="color:var(--accent);">${td.airportCode}</span></div>
        </div>
      </div>
      <div class="td-item-right" style="display:flex;gap:6px;align-items:center;flex-shrink:0;">
        <span style="font-size:11px;padding:2px 8px;border-radius:6px;${td.active ? 'background:rgba(34,197,94,.12);color:#4ade80;' : 'background:rgba(239,68,68,.1);color:#f87171;'}">${td.active ? '● Aktivan' : '● Neaktivan'}</span>
        <button onclick="toggleTermDest(${td.destinationId}, ${td.active})"
          style="background:${td.active ? 'rgba(239,68,68,.1)' : 'rgba(34,197,94,.1)'};border:none;color:${td.active ? '#f87171' : '#4ade80'};border-radius:7px;padding:5px 10px;cursor:pointer;font-family:inherit;font-size:12px;font-weight:600;">
          ${td.active ? 'Deaktiviraj' : 'Aktiviraj'}
        </button>
        <button onclick="removeTermDest(${td.destinationId})"
          style="background:rgba(239,68,68,.08);border:none;color:#f87171;border-radius:7px;padding:5px 10px;cursor:pointer;font-family:inherit;font-size:12px;font-weight:600;">
          Ukloni
        </button>
      </div>
    </div>`).join('');
}

async function addDestToTerm() {
  const destId = parseInt(document.getElementById('termDestSelect').value);
  if (!destId) return;
  try {
    const r = await fetch(`${API}/api/admin/dates/${_termDestDateId}/destinations/${destId}`, {
      method: 'POST', headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) {
      const err = await r.json().catch(() => ({}));
      throw new Error(err.message || `HTTP ${r.status}`);
    }
    document.getElementById('termDestSelect').value = '';
    await refreshTermDestList();
    await loadDates();
  } catch(e) {
    Swal.fire({ icon: 'error', title: 'Greška', text: e.message, background: '#0d1b38', color: '#fff' });
  }
}

async function toggleTermDest(destId, currentActive) {
  const newVal = !currentActive;
  try {
    const r = await fetch(`${API}/api/admin/dates/${_termDestDateId}/destinations/${destId}/active?value=${newVal}`, {
      method: 'PATCH', headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) {
      const err = await r.json().catch(() => ({}));
      throw new Error(err.message || `Greška ${r.status}`);
    }
    await refreshTermDestList();
    await loadDates();
  } catch(e) {
    Swal.fire({ icon: 'error', title: 'Greška', text: e.message, background: '#0d1b38', color: '#fff' });
  }
}

async function removeTermDest(destId) {
  const { isConfirmed } = await Swal.fire({
    title: 'Ukloniti destinaciju?',
    text: 'Destinacija će biti uklonjena iz ovog termina.',
    icon: 'question', showCancelButton: true,
    confirmButtonText: 'Ukloni', cancelButtonText: 'Otkaži',
    confirmButtonColor: '#ef4444', background: '#0d1b38', color: '#fff'
  });
  if (!isConfirmed) return;
  try {
    const r = await fetch(`${API}/api/admin/dates/${_termDestDateId}/destinations/${destId}`, {
      method: 'DELETE', headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) {
      const err = await r.json().catch(() => ({}));
      throw new Error(err.message || `Greška ${r.status}`);
    }
    await refreshTermDestList();
    await loadDates();
  } catch(e) {
    Swal.fire({ icon: 'error', title: 'Greška', text: e.message, background: '#0d1b38', color: '#fff' });
  }
}

function closeTermDestPopup() {
  document.getElementById('termDestOverlay').style.display = 'none';
  _termDestDateId = null;
}

// ══ DATES ══
async function loadDates() {
  try {
    const r = await fetch(`${API}/api/admin/dates`, {
      headers: { 'X-Admin-Key': ADMIN_KEY },
      cache: 'no-store'
    });
    if (!r.ok) throw new Error(`HTTP ${r.status}`);
    const dates = await r.json();
    renderDatesTable(dates);
  } catch (e) {
    apiErr('Greška pri učitavanju termina.');
    console.error('[loadDates]', e);
  }
}

function renderDatesTable(dates) {
  const now = new Date();

  const javni       = dates.filter(d => !d.isPrivate && d.active);
  const privatni    = dates.filter(d =>  d.isPrivate && !(d.expiresAt && new Date(d.expiresAt) < now));
  const deaktivirani = dates.filter(d =>
    (!d.isPrivate && !d.active) ||
    ( d.isPrivate &&  d.expiresAt && new Date(d.expiresAt) < now)
  );

  // Badges na sub-tab dugmadima
  document.getElementById('privateBadge').textContent  = privatni.length     || '';
  document.getElementById('deaktivBadge').textContent  = deaktivirani.length || '';

  // ── Javni termini ──────────────────────────────────────────────────────────
  const tbody = document.getElementById('datesBody');
  if (!javni.length) {
    tbody.innerHTML = '<tr><td colspan="9" class="empty-state">Nema aktivnih javnih termina. Dodajte prvi termin iznad.</td></tr>';
  } else {
    tbody.innerHTML = javni.map(d => {
      const dests = d.destinations || [];
      const activeCount = dests.filter(x => x.active).length;
      const destHtml = dests.length
        ? `<div class="dest-chips">${dests.map(x => `<span class="dest-chip" style="${x.active ? '' : 'opacity:.4;text-decoration:line-through;'}">${x.name}</span>`).join('')}</div>`
        : `<span style="color:var(--gray);font-size:12px;">-</span>`;
      return `
      <tr>
        <td><span style="color:var(--gray);font-size:12px;">#${d.id}</span></td>
        <td><span class="badge badge-accent">${d.departureAirport}</span></td>
        <td><strong>${formatDate(d.departureDate)}</strong></td>
        <td><strong>${formatDate(d.returnDate)}</strong></td>
        <td>${d.numberOfNights}n</td>
        <td>${d.availableSlots}</td>
        <td><strong>${d.basePrice}€</strong></td>
        <td>${destHtml}</td>
        <td style="white-space:nowrap;">
          <button class="btn-action btn-toggle-off"
            onclick="toggleDate(${d.id}, false)">Deaktiviraj</button>
          <button class="btn-action btn-edit" onclick="openTermDestPopup(${d.id}, '${d.departureAirport}')" style="margin-left:4px;">✈️ Destinacije (${activeCount}/${dests.length})</button>
          <button class="btn-action" onclick="editSlots(${d.id}, ${d.availableSlots})" style="margin-left:4px;background:rgba(99,102,241,.15);color:#a5b4fc;">📋 Mesta (${d.availableSlots})</button>
          <button class="btn-action" onclick="editPrice(${d.id}, ${d.basePrice})" style="margin-left:4px;background:rgba(34,197,94,.1);color:#86efac;">💶 Cena (${d.basePrice}€)</button>
          <button class="btn-action btn-delete" onclick="deleteDate(${d.id})" style="margin-left:4px;">Obriši</button>
        </td>
      </tr>`;
    }).join('');
  }

  // ── Privatni termini ───────────────────────────────────────────────────────
  const privateTbody = document.getElementById('privateDatesBody');
  if (!privatni.length) {
    privateTbody.innerHTML = '<tr><td colspan="6" class="empty-state">Nema aktivnih privatnih termina.</td></tr>';
  } else {
    privateTbody.innerHTML = privatni.map(d => {
      const expires     = d.expiresAt ? new Date(d.expiresAt) : null;
      const expiryStr   = expires
        ? expires.toLocaleString('sr-RS', { day:'2-digit', month:'2-digit', year:'numeric', hour:'2-digit', minute:'2-digit' })
        : '-';
      const privateUrl  = `${window.location.origin}/?privateDate=${encodeURIComponent(d.privateToken)}`;
      const dests       = d.destinations || [];
      const activeCount = dests.filter(x => x.active).length;
      const destHtml    = dests.length
        ? `<div class="dest-chips">${dests.map(x => `<span class="dest-chip" style="${x.active ? '' : 'opacity:.4;text-decoration:line-through;'}">${x.name}</span>`).join('')}</div>`
        : `<span style="color:var(--gray);font-size:12px;">-</span>`;
      return `
      <tr>
        <td><span class="badge badge-accent">${d.departureAirport}</span></td>
        <td>
          <strong>${formatDate(d.departureDate)} → ${formatDate(d.returnDate)}</strong>
          <div style="font-size:11px;color:var(--gray);margin-top:2px;">${d.numberOfNights} noći</div>
        </td>
        <td>
          <span style="font-size:13px;">${d.availableSlots} mesta</span><br>
          <strong>${d.basePrice}€/os</strong>
        </td>
        <td>${destHtml}</td>
        <td>
          <button class="btn-action" style="background:rgba(99,102,241,.15);color:#a5b4fc;font-size:11px;"
            onclick="copyPrivateLink('${privateUrl}', this)">📋 Kopiraj link</button>
        </td>
        <td><span style="color:#22c55e;font-size:12px;">✓ Aktivan<br><span style="opacity:.65;">${expiryStr}</span></span></td>
        <td style="white-space:nowrap;">
          <button class="btn-action btn-edit" onclick="openTermDestPopup(${d.id}, '${d.departureAirport}')" style="margin-right:4px;">✈️ Destinacije (${activeCount}/${dests.length})</button>
          <button class="btn-action btn-delete" onclick="deleteDate(${d.id})">Obriši</button>
        </td>
      </tr>`;
    }).join('');
  }

  // ── Deaktivirani termini ───────────────────────────────────────────────────
  const deaktivTbody = document.getElementById('deactivatedBody');
  if (!deaktivirani.length) {
    deaktivTbody.innerHTML = '<tr><td colspan="7" class="empty-state">Nema deaktiviranih termina.</td></tr>';
  } else {
    deaktivTbody.innerHTML = deaktivirani.map(d => {
      const isPriv  = d.isPrivate;
      const tipHtml = isPriv
        ? `<span class="badge" style="background:rgba(99,102,241,.15);color:#a5b4fc;">🔒 Privatni</span>`
        : `<span class="badge" style="background:rgba(255,255,255,.07);color:var(--gray);">📋 Javni</span>`;
      const razlog  = isPriv
        ? `<span style="color:#ef4444;font-size:12px;">⛔ Istekao link</span>`
        : `<span style="color:var(--gray);font-size:12px;">● Deaktiviran</span>`;
      const akcije  = isPriv
        ? `<button class="btn-action btn-delete" onclick="deleteDate(${d.id})">Obriši</button>`
        : `<button class="btn-action btn-toggle-on" onclick="toggleDate(${d.id}, true)">Aktiviraj</button>
           <button class="btn-action btn-delete" onclick="deleteDate(${d.id})" style="margin-left:4px;">Obriši</button>`;
      return `
      <tr style="opacity:.7;">
        <td>${tipHtml}</td>
        <td><span class="badge badge-accent">${d.departureAirport}</span></td>
        <td>
          <strong>${formatDate(d.departureDate)} → ${formatDate(d.returnDate)}</strong>
        </td>
        <td>${d.numberOfNights}n</td>
        <td>
          <span style="font-size:13px;">${d.availableSlots} mesta</span><br>
          <strong>${d.basePrice}€/os</strong>
        </td>
        <td>${razlog}</td>
        <td style="white-space:nowrap;">${akcije}</td>
      </tr>`;
    }).join('');
  }
}

function switchDatesTab(tab, btn) {
  document.querySelectorAll('.dates-sub-btn').forEach(b => b.classList.remove('active'));
  document.querySelectorAll('.dates-sub-panel').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('sub-' + tab).classList.add('active');
}

function copyPrivateLink(url, btn) {
  navigator.clipboard.writeText(url).then(() => {
    const orig = btn.innerHTML;
    btn.innerHTML = '✅ Kopirano!';
    btn.style.background = 'rgba(34,197,94,.15)';
    btn.style.color = '#86efac';
    setTimeout(() => { btn.innerHTML = orig; btn.style.background = ''; btn.style.color = ''; }, 2000);
  }).catch(() => {
    prompt('Kopiraj link:', url);
  });
}

function formatDate(str) {
  if (!str) return '-';
  const [y, m, d] = str.split('-');
  const months = ['jan','feb','mar','apr','maj','jun','jul','avg','sep','okt','nov','dec'];
  return `${d}. ${months[parseInt(m)-1]} ${y}.`;
}

// ══ ADD DATE ══
async function addDate() {
  const airport  = getAdminAirport();
  const nights   = getAdminNights();
  const depDate  = document.getElementById('fDeparture')._flatpickr?.selectedDates[0];
  const retDate  = window._fReturnDate;
  const slots    = parseInt(document.getElementById('fSlots').value);
  const price    = parseInt(document.getElementById('fPrice').value);
  const destIds  = destTomSelect ? destTomSelect.getValue().map(Number) : [];

  if (!depDate) {
    Swal.fire({ icon: 'warning', title: 'Nedostaje datum', text: 'Izaberite datum polaska.', confirmButtonText: 'OK' });
    return;
  }

  const body = {
    departureAirport: airport,
    departureDate: fmtIso(depDate),
    returnDate: fmtIso(retDate),
    numberOfNights: nights,
    availableSlots: slots,
    basePrice: price,
    destinationIds: destIds
  };

  try {
    const r = await fetch(`${API}/api/admin/dates`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-Admin-Key': ADMIN_KEY },
      body: JSON.stringify(body)
    });
    if (!r.ok) {
      const err = await r.json();
      throw new Error(err.message || 'Greška pri dodavanju');
    }
    await Swal.fire({ icon: 'success', title: 'Termin dodat!', text: `${fmtIso(depDate)} → ${fmtIso(retDate)} | ${airport}`, confirmButtonText: 'OK' });
    resetForm();
    loadDates();
  } catch (e) {
    Swal.fire({ icon: 'error', title: 'Greška', text: e.message, confirmButtonText: 'OK' });
  }
}

function fmtIso(date) {
  // Koristimo lokalno vreme umesto UTC da izbegnemo pomeranje datuma kod UTC+1/+2
  const y = date.getFullYear();
  const m = String(date.getMonth() + 1).padStart(2, '0');
  const d = String(date.getDate()).padStart(2, '0');
  return `${y}-${m}-${d}`;
}

function resetForm() {
  document.getElementById('fDeparture')._flatpickr?.clear();
  document.getElementById('fReturn').value = '';
  window._fReturnDate = null;
  document.getElementById('fSlots').value = 50;
  document.getElementById('fPrice').value = 279;
  if (destTomSelect) destTomSelect.clear();
}


// ══ EDIT SLOTS ══
async function editSlots(id, currentSlots) {
  const { value, isConfirmed } = await Swal.fire({
    title: 'Izmeni broj mesta',
    html: `
      <div style="margin-bottom:8px;color:#94a3b8;font-size:14px;">Trenutno: <strong style="color:#CA8A71;">${currentSlots} mesta</strong></div>
      <input id="swal-slots" type="number" min="0" max="9999" value="${currentSlots}"
        class="swal2-input" style="width:140px;text-align:center;font-size:22px;font-weight:700;">
    `,
    confirmButtonText: 'Sačuvaj',
    confirmButtonColor: '#CA8A71',
    cancelButtonText: 'Otkaži',
    showCancelButton: true,
    background: '#0b1929',
    color: '#fff',
    focusConfirm: false,
    preConfirm: () => {
      const val = parseInt(document.getElementById('swal-slots').value);
      if (isNaN(val) || val < 0) {
        Swal.showValidationMessage('Unesite validan broj (≥ 0)');
        return false;
      }
      return val;
    }
  });

  if (!isConfirmed || value === undefined) return;

  const r = await fetch(`${API}/api/admin/dates/${id}/slots?value=${value}`, {
    method: 'PATCH',
    headers: { 'X-Admin-Key': ADMIN_KEY }
  });

  if (r.ok) {
    Swal.fire({ icon: 'success', title: `Mesta ažurirana na ${value}`, timer: 1400, showConfirmButton: false, background: '#0b1929', color: '#fff' });
    loadDates();
  } else {
    Swal.fire({ icon: 'error', title: 'Greška', text: 'Nije moguće ažurirati mesta.', background: '#0b1929', color: '#fff' });
  }
}

// ══ EDIT PRICE ══
async function editPrice(id, currentPrice) {
  const { value, isConfirmed } = await Swal.fire({
    title: 'Izmeni cenu termina',
    html: `
      <div style="margin-bottom:8px;color:#94a3b8;font-size:14px;">Trenutna osnovna cena: <strong style="color:#CA8A71;">${currentPrice}€</strong></div>
      <input id="swal-price" type="number" min="1" max="9999" value="${currentPrice}"
        class="swal2-input" style="width:140px;text-align:center;font-size:22px;font-weight:700;">
      <div style="margin-top:8px;color:#64748b;font-size:12px;">Cena po osobi u EUR - dodaci se računaju posebno</div>
    `,
    confirmButtonText: 'Sačuvaj',
    confirmButtonColor: '#CA8A71',
    cancelButtonText: 'Otkaži',
    showCancelButton: true,
    background: '#0b1929',
    color: '#fff',
    focusConfirm: false,
    preConfirm: () => {
      const val = parseInt(document.getElementById('swal-price').value);
      if (isNaN(val) || val < 1 || val > 9999) {
        Swal.showValidationMessage('Unesite validnu cenu (1–9999€)');
        return false;
      }
      return val;
    }
  });

  if (!isConfirmed || value === undefined) return;

  const r = await fetch(`${API}/api/admin/dates/${id}/price?value=${value}`, {
    method: 'PATCH',
    headers: { 'X-Admin-Key': ADMIN_KEY }
  });

  if (r.ok) {
    Swal.fire({ icon: 'success', title: `Cena ažurirana na ${value}€`, timer: 1400, showConfirmButton: false, background: '#0b1929', color: '#fff' });
    loadDates();
  } else {
    Swal.fire({ icon: 'error', title: 'Greška', text: 'Nije moguće ažurirati cenu.', background: '#0b1929', color: '#fff' });
  }
}

// ══ TOGGLE ACTIVE ══
async function toggleDate(id, newValue) {
  const label = newValue ? 'aktivirati' : 'deaktivirati';
  const { isConfirmed } = await Swal.fire({
    title: `${newValue ? 'Aktivirati' : 'Deaktivirati'} termin?`,
    text: `Jeste li sigurni da želite ${label} ovaj termin?`,
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Da',
    cancelButtonText: 'Ne'
  });
  if (!isConfirmed) return;

  await fetch(`${API}/api/admin/dates/${id}/active?value=${newValue}`, {
    method: 'PATCH',
    headers: { 'X-Admin-Key': ADMIN_KEY }
  });
  loadDates();
}

// ══ DELETE ══
async function deleteDate(id) {
  const { isConfirmed } = await Swal.fire({
    title: 'Obrisati termin?',
    text: 'Ova akcija je nepovratna!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Obriši',
    cancelButtonText: 'Otkaži'
  });
  if (!isConfirmed) return;

  const res = await fetch(`${API}/api/admin/dates/${id}`, {
    method: 'DELETE',
    headers: { 'X-Admin-Key': ADMIN_KEY }
  });

  if (!res.ok) {
    let msg = 'Greška pri brisanju termina.';
    try { const body = await res.json(); msg = body.message || msg; } catch {}
    Swal.fire({ icon: 'error', title: 'Nije moguće obrisati', text: msg, confirmButtonText: 'OK' });
    return;
  }

  Swal.fire({ icon: 'success', title: 'Termin obrisan', confirmButtonText: 'OK', timer: 1500 });
  loadDates();
}

// ══ FLATPICKR ══
function autoFillReturn() {
  const depPicker = document.getElementById('fDeparture')._flatpickr;
  if (!depPicker?.selectedDates[0]) return;
  const nights = getAdminNights();
  const ret = new Date(depPicker.selectedDates[0]);
  ret.setDate(ret.getDate() + nights);
  // Format dd.mm.yyyy for display
  const d = String(ret.getDate()).padStart(2, '0');
  const m = String(ret.getMonth() + 1).padStart(2, '0');
  const y = ret.getFullYear();
  document.getElementById('fReturn').value = `${d}.${m}.${y}`;
  window._fReturnDate = ret;
}

function initFlatpickr() {
  const depPicker = flatpickr('#fDeparture', {
    locale: 'sr',
    dateFormat: 'd.m.Y',
    minDate: 'today',
    onChange() { autoFillReturn(); }
  });
  document.getElementById('fDeparture')._flatpickr = depPicker;
}

// ══ TABS ══
function switchTab(tab) {
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('panel-' + tab).classList.add('active');
  event.currentTarget.classList.add('active');
  if (tab === 'bookings')  loadBookings();
  if (tab === 'waitlist')  loadWaitlist();
  if (tab === 'errors')    loadErrors();
  if (tab === 'inquiries') loadInquiries();
  if (tab === 'gifts')     loadGifts();
}

// ══ GREŠKE ═══════════════════════════════════════════════════════════════════
async function loadErrors() {
  const el = document.getElementById('errorsContent');
  try {
    const r    = await fetch(`${API}/api/admin/errors`, { headers: { 'X-Admin-Key': ADMIN_KEY }, cache: 'no-store' });
    const errors = await r.json();

    const unresolved = errors.filter(e => !e.resolved).length;
    document.getElementById('errorsBadge').textContent = unresolved > 0 ? unresolved : '';

    if (!errors.length) {
      el.innerHTML = `<div class="err-empty"><div class="err-empty-icon">✅</div>Nema zabeleženih grešaka</div>`;
      return;
    }

    const rows = errors.map(e => {
      const firstSeen = new Date(e.firstSeenAt).toLocaleString('sr-RS');
      const lastSeen  = new Date(e.lastSeenAt).toLocaleString('sr-RS');
      const statusBadge = e.resolved
        ? `<span class="err-badge-resolved">✓ Rešeno</span>`
        : `<button class="btn-resolve" onclick="resolveError(${e.id}, this)">Označi kao rešeno</button>`;
      return `
        <tr class="err-row ${e.resolved ? 'resolved' : ''}" onclick="toggleErrStack('stack-${e.id}')">
          <td>
            <div class="err-type">${e.exceptionType}</div>
            <div class="err-endpoint">${e.endpoint}</div>
          </td>
          <td><div class="err-msg" title="${e.message?.replace(/"/g,"'") || ''}">${e.message || '-'}</div></td>
          <td><span class="err-count">${e.count}×</span></td>
          <td class="err-time">${firstSeen}</td>
          <td class="err-time">${e.count > 1 ? lastSeen : '-'}</td>
          <td class="err-actions" onclick="event.stopPropagation()">${statusBadge}</td>
        </tr>
        <tr id="stack-${e.id}" class="err-stack-wrap">
          <td colspan="6">
            <div class="err-stack">${e.stackTrace || 'nema stack trace-a'}</div>
          </td>
        </tr>`;
    }).join('');

    el.innerHTML = `
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Tip / Endpoint</th>
              <th>Poruka</th>
              <th>Puta</th>
              <th>Prva pojava</th>
              <th>Poslednji put</th>
              <th>Akcija</th>
            </tr>
          </thead>
          <tbody>${rows}</tbody>
        </table>
      </div>`;
  } catch(e) {
    el.innerHTML = `<div class="empty-state">Greška pri učitavanju: ${e.message}</div>`;
  }
}

async function loadErrorsBadge() {
  try {
    const r = await fetch(`${API}/api/admin/errors/count`, { headers: { 'X-Admin-Key': ADMIN_KEY }, cache: 'no-store' });
    const { count } = await r.json();
    document.getElementById('errorsBadge').textContent = count > 0 ? count : '';
  } catch(_) {}
}

function toggleErrStack(id) {
  const el = document.getElementById(id);
  el.classList.toggle('open');
}

async function resolveError(id, btn) {
  btn.disabled = true;
  btn.textContent = '...';
  try {
    await fetch(`${API}/api/admin/errors/${id}/resolve`, {
      method: 'PATCH',
      headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    await loadErrors();
  } catch(e) {
    btn.disabled = false;
    btn.textContent = 'Označi kao rešeno';
  }
}

async function clearResolvedErrors() {
  const { isConfirmed } = await Swal.fire({
    title: 'Obriši rešene greške?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Da, obriši',
    cancelButtonText: 'Otkaži',
    confirmButtonColor: '#CA8A71',
    background: '#0d1b38', color: '#fff'
  });
  if (!isConfirmed) return;
  await fetch(`${API}/api/admin/errors/resolved`, { method: 'DELETE', headers: { 'X-Admin-Key': ADMIN_KEY } });
  loadErrors();
}

async function clearAllErrors() {
  const { isConfirmed } = await Swal.fire({
    title: 'Obriši SVE greške?',
    text: 'Ovo briše i nerešene greške.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Da, obriši sve',
    cancelButtonText: 'Otkaži',
    confirmButtonColor: '#ef4444',
    background: '#0d1b38', color: '#fff'
  });
  if (!isConfirmed) return;
  await fetch(`${API}/api/admin/errors`, { method: 'DELETE', headers: { 'X-Admin-Key': ADMIN_KEY } });
  loadErrors();
}

// ══ LISTA ČEKANJA ════════════════════════════════════════════════════════════
async function loadWaitlist() {
  try {
    const r    = await fetch(`${API}/api/admin/waitlist`, { headers: { 'X-Admin-Key': ADMIN_KEY } });
    const data = await r.json();
    const total = data.total || 0;

    const byAirport = data.byAirport || {};
    document.getElementById('waitlistBadge').textContent = total > 0 ? total : '';

    const airportNames = { BEG: 'Beograd', INI: 'Niš' };
    const allAirports  = [...new Set([...Object.keys(byAirport), 'BEG', 'INI'])];
    document.getElementById('wlCards').innerHTML = allAirports.map(ap => `
      <div class="card" style="text-align:center;padding:32px 24px;">
        <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--gray);margin-bottom:10px;">
          ${ap}${airportNames[ap] ? ' - ' + airportNames[ap] : ''}
        </div>
        <div style="font-size:48px;font-weight:900;color:var(--accent);line-height:1;" id="wlCount-${ap}">${byAirport[ap] ?? 0}</div>
        <div style="font-size:13px;color:var(--gray);margin:6px 0 20px;">korisnika čeka</div>
        <button class="btn-primary" onclick="notifyWaitlist('${ap}')" style="width:100%;padding:12px;">📧 Obavesti za ${ap}</button>
      </div>
    `).join('');

    const tbody = document.getElementById('waitlistBody');
    if (!data.entries || data.entries.length === 0) {
      tbody.innerHTML = '<tr><td colspan="3" class="empty-state">Nema čekajućih.</td></tr>';
      return;
    }
    tbody.innerHTML = data.entries.map(e => `
      <tr>
        <td>${e.email}</td>
        <td>${e.airport}</td>
        <td>${new Date(e.createdAt).toLocaleString('sr-RS')}</td>
      </tr>
    `).join('');
  } catch(err) {
    document.getElementById('waitlistBody').innerHTML =
      '<tr><td colspan="3" class="empty-state">Greška pri učitavanju.</td></tr>';
    apiErr('Greška pri učitavanju liste čekanja.');
  }
}

async function notifyWaitlist(airport) {
  const countEl = document.getElementById('wlCount-' + airport);
  const count   = countEl ? countEl.textContent : '0';

  if (count === '0' || count === '-') {
    Swal.fire({ icon: 'info', title: 'Nema čekajućih', text: `Lista čekanja za ${airport} je prazna.`, background: '#0d1b38', color: '#fff' });
    return;
  }

  const { isConfirmed } = await Swal.fire({
    icon: 'question',
    title: `Obavesti ${count} korisnika?`,
    text: `Svi na listi čekanja za ${airport} dobiće email da su se otvorili novi termini.`,
    showCancelButton: true,
    confirmButtonText: 'Pošalji',
    cancelButtonText: 'Odustani',
    confirmButtonColor: '#CA8A71',
    background: '#0d1b38', color: '#fff'
  });
  if (!isConfirmed) return;

  const r    = await fetch(`${API}/api/admin/waitlist/notify/${airport}`, {
    method: 'POST', headers: { 'X-Admin-Key': ADMIN_KEY }
  });
  const data = await r.json();
  Swal.fire({ icon: 'success', title: 'Poslato!', text: data.message, background: '#0d1b38', color: '#fff' });
  loadWaitlist();
}

// ══ REZERVACIJE ══════════════════════════════════════════════════════════════
let ALL_BOOKINGS   = [];
let activeFilter   = 'PENDING';

async function loadBookings() {
  const list = document.getElementById('bookingList');
  list.innerHTML = '<div class="empty-state">Učitavanje...</div>';
  try {
    const r = await fetch(`${API}/api/admin/bookings`, {
      headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    ALL_BOOKINGS = await r.json();
    updateBookingBadge();
    renderBookings();
  } catch (e) {
    list.innerHTML = '<div class="empty-state" style="color:#f87171;">Greška pri učitavanju.</div>';
    apiErr('Greška pri učitavanju rezervacija.');
  }
}

function updateBookingBadge() {
  const pending = ALL_BOOKINGS.filter(b => b.status === 'PENDING').length;
  document.getElementById('bookingsBadge').textContent = pending > 0 ? pending : '';
}

function filterBookings(status, btn) {
  activeFilter = status;
  document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  renderBookings();
}

function getFilteredBookings() {
  const q = (document.getElementById('bookingSearch')?.value || '').toLowerCase().trim();
  return ALL_BOOKINGS
    .filter(b => activeFilter === 'ALL' || b.status === activeFilter)
    .filter(b => !q || `${b.firstName} ${b.lastName} ${b.email} ${b.bookingRef}`.toLowerCase().includes(q));
}

function buildPassengersSection(passengers) {
  if (!passengers || !passengers.length) return '';

  const rows = passengers.map((p, i) => {
    const dob = p.dateOfBirth
      ? new Date(p.dateOfBirth).toLocaleDateString('sr-RS', { day:'2-digit', month:'2-digit', year:'numeric' })
      : null;

    const passportIcon = p.hasValidPassport === false
      ? `<span class="bc-passport-warn" title="Pasoš nije validan">⚠</span>`
      : `<span class="bc-passport-ok" title="Pasoš validan">✓</span>`;

    const passportInfo = p.passportNumber
      ? `<span>${passportIcon} Pasoš: <strong>${p.passportNumber}</strong></span>`
      : `<span style="opacity:.45;">Broj pasoša nije unesen</span>`;

    const dobInfo = dob
      ? `<span>📅 Datum rođenja: <strong>${dob}</strong></span>`
      : '';

    const visaInfo = p.visaInfo
      ? `<span>🛂 Vize: <strong>${p.visaInfo}</strong></span>`
      : '';

    return `
      <div class="bc-passenger-row">
        <div class="bc-passenger-name">
          <span class="bc-passenger-num">${i + 1}</span>
          ${p.name}
          <span class="bc-passenger-gender ${p.gender || ''}">${p.gender === 'F' ? 'Ž' : p.gender || '-'}</span>
        </div>
        <div class="bc-passenger-meta">
          ${dobInfo}
          ${passportInfo}
          ${visaInfo}
        </div>
      </div>`;
  }).join('');

  return `
    <div class="bc-passengers-wrap bc-field--full">
      <div class="bc-passengers-title">👤 Putnici - detalji</div>
      ${rows}
    </div>`;
}

function renderBookings() {
  const list = document.getElementById('bookingList');
  const filtered = getFilteredBookings();

  if (!filtered.length) {
    list.innerHTML = '<div class="empty-state">Nema rezervacija.</div>';
    return;
  }

  list.innerHTML = filtered.map(b => {
    const created = new Date(b.createdAt).toLocaleString('sr-RS', {
      day:'2-digit', month:'2-digit', year:'numeric',
      hour:'2-digit', minute:'2-digit'
    });
    const depDate = b.departureDate
      ? new Date(b.departureDate).toLocaleDateString('sr-RS') : '-';
    const retDate = b.returnDate
      ? new Date(b.returnDate).toLocaleDateString('sr-RS') : '-';

    const extras = [
      b.hasInsurance         && '🛡 Osiguranje',
      b.hasBreakfast         && '🍳 Doručak',
      b.hasSeatsTogether     && '💺 Sedišta zajedno',
      b.hasConnectingFlights && '✈✈ Presedanje',
      b.cabinSuitcaseCount > 0 && `🧳 ${b.cabinSuitcaseCount}× kofer`,
      b.hasRevealBox && '📦 Reveal Box',
      b.excludedDestinations && b.excludedDestinations.length > 0 && `🚫 ${b.excludedDestinations.join(', ')}`,
    ].filter(Boolean).join(' · ') || '-';

    const isConfirmed  = b.status === 'CONFIRMED';
    const isCancelled  = b.status === 'CANCELLED';
    const isPending    = b.status === 'PENDING';
    const isCompleted  = b.status === 'COMPLETED';

    const statusLabels = { PENDING: '⏳ Na čekanju', CONFIRMED: '✅ Potvrđena', CANCELLED: '❌ Otkazana', COMPLETED: '🏁 Završena' };

    return `
    <div class="booking-card status-${b.status}" id="bcard-${b.id}">
      <div class="bc-header">
        <div>
          <div class="bc-ref">${b.bookingRef}</div>
          <div class="bc-date">Primljeno: ${created}</div>
        </div>
        <span class="bc-status ${b.status}">${statusLabels[b.status]||b.status}</span>
      </div>

      <div class="bc-body">
        <div class="bc-field"><div class="bc-label">Ime i prezime</div><div class="bc-value">${b.firstName} ${b.lastName}</div></div>
        <div class="bc-field"><div class="bc-label">Email</div><div class="bc-value">${b.email}</div></div>
        <div class="bc-field"><div class="bc-label">Telefon</div><div class="bc-value">${b.phone}</div></div>
        <div class="bc-field"><div class="bc-label">Aerodrom</div><div class="bc-value">✈ ${b.departureAirport}</div></div>
        <div class="bc-field"><div class="bc-label">Termin</div><div class="bc-value">${depDate} → ${retDate}</div></div>
        <div class="bc-field"><div class="bc-label">Putnici / Smeštaj</div><div class="bc-value">${b.numberOfTravelers}× · ${b.accommodationType}</div></div>
        ${buildPassengersSection(b.passengers)}
        <div class="bc-field"><div class="bc-label">Cena po osobi</div><div class="bc-value">${b.totalPricePerPerson}€/os <button class="bc-btn-price" onclick='showPriceBreakdown(${JSON.stringify(b).replace(/'/g,"&#39;")})'>💰 detalji</button></div></div>
        <div class="bc-field"><div class="bc-label">Ukupno</div><div class="bc-value" style="color:var(--accent);font-size:16px;">${b.totalPriceAll}€</div></div>
        <div class="bc-field"><div class="bc-label">Dodaci</div><div class="bc-value">${extras}</div></div>
        <div class="bc-field bc-field--full">
          <div class="bc-label">✈ Dodeljena destinacija</div>
          <div class="bc-dest-row">
            ${(() => {
              const termDests = b.termDestinations || [];
              const excludedIds = new Set(b.excludedDestinationIds || []);
              if (!termDests.length) {
                return `<input class="bc-dest-input" id="dest-${b.id}" type="text"
                  placeholder="npr. Barcelona"
                  value="${b.assignedDestination || ''}"
                  onkeydown="if(event.key==='Enter')saveDestination(${b.id})" />`;
              }
              const opts = termDests.map(td => {
                const isExcluded = excludedIds.has(td.destinationId);
                const isCurrent  = td.name === b.assignedDestination;
                return `<option value="${td.name}"
                  ${isCurrent  ? 'selected' : ''}
                  ${isExcluded ? 'disabled' : ''}
                  style="${isExcluded ? 'text-decoration:line-through;color:#64748b;' : ''}${!td.active ? 'opacity:.45;' : ''}">
                  ${td.name}${isExcluded ? ' 🚫' : ''}${!td.active ? ' (neaktivna)' : ''}
                </option>`;
              }).join('');
              return `<select class="bc-dest-input" id="dest-${b.id}"
                onchange="saveDestination(${b.id})"
                style="cursor:pointer;">
                <option value="">-- izaberi destinaciju --</option>
                ${opts}
              </select>`;
            })()}
            <button class="bc-note-save" id="dest-btn-${b.id}" onclick="saveDestination(${b.id})" title="Sačuvaj destinaciju">✓</button>
          </div>
          <div style="margin-top:6px;">
            <input class="bc-dest-input" id="weather-city-${b.id}" type="text"
              style="width:100%;font-size:11px;opacity:.8;"
              placeholder="🌤 Grad za prognozu (opcionalno) - npr. Santa Cruz de Tenerife, Spain"
              value="${b.weatherCity || ''}"
              onkeydown="if(event.key==='Enter')saveWeatherCity(${b.id})"
              onblur="saveWeatherCity(${b.id})" />
            <div id="weather-city-status-${b.id}" style="font-size:10px;color:var(--gray);margin-top:2px;">
              ${b.weatherCity ? `🌤 Prognoza koristi: <strong>${b.weatherCity}</strong>` : '<span style="opacity:.5;">ako ostaviš prazno, koristi se ime destinacije</span>'}
            </div>
          </div>
          <div class="bc-note-status" id="dest-status-${b.id}" style="display:flex;flex-wrap:wrap;gap:8px;margin-top:4px;">
            ${b.revealSentAt
              ? `<span class="bc-reveal-sent">✉ Reveal poslan ${new Date(b.revealSentAt).toLocaleString('sr-RS',{day:'2-digit',month:'2-digit',year:'numeric',hour:'2-digit',minute:'2-digit'})}</span>`
              : (b.assignedDestination ? '<span style="color:var(--gray);font-size:11px;">✉ Reveal još nije poslan</span>' : '')}
            ${b.forecastSentAt
              ? `<span style="color:#38bdf8;font-size:11px;font-weight:600;">🌤 Prognoza poslata ${new Date(b.forecastSentAt).toLocaleString('sr-RS',{day:'2-digit',month:'2-digit',year:'numeric',hour:'2-digit',minute:'2-digit'})}</span>`
              : (b.assignedDestination ? '<span style="color:var(--gray);font-size:11px;">🌤 Prognoza još nije poslata</span>' : '')}
            ${b.destinationRevealedAt
              ? `<span style="color:#fbbf24;font-size:11px;font-weight:600;">👁 Korisnik video destinaciju ${new Date(b.destinationRevealedAt).toLocaleString('sr-RS',{day:'2-digit',month:'2-digit',year:'numeric',hour:'2-digit',minute:'2-digit'})}</span>`
              : ''}
          </div>
          ${b.assignedDestination && b.status === 'CONFIRMED' ? `
          <div class="bc-send-row">
            <button class="bc-btn-reveal" id="btn-reveal-${b.id}" ${getBtnAttrs(b, 'reveal')}>
              ✉ ${b.revealSentAt ? 'Reveal poslan' : 'Pošalji Reveal'}
            </button>
            <button class="bc-btn-forecast" id="btn-forecast-${b.id}" ${getBtnAttrs(b, 'forecast')}>
              🌤 ${b.forecastSentAt ? 'Prognoza poslata' : 'Pošalji Prognozu'}
            </button>
          </div>` : (b.assignedDestination && b.status !== 'CONFIRMED' ? `
          <div style="font-size:11px;color:#f87171;margin-top:6px;">
            ⚠️ Reveal i prognoza se mogu poslati samo za CONFIRMED rezervacije
          </div>` : '')}
        </div>
      </div>

      ${b.notes ? `<div class="bc-notes">💬 Napomena klijenta: <em>${b.notes}</em></div>` : ''}

      ${b.hasRevealBox ? `
      <div class="bc-reveal-box-section" id="rbs-${b.id}">
        <div class="bc-reveal-box-header">📦 Reveal Box - adresa dostave</div>
        <div class="bc-reveal-box-body">
          <div class="bc-reveal-box-row"><span class="bc-reveal-box-label">Adresa</span><span>${b.deliveryAddress || '-'}</span></div>
          ${b.deliveryApartment ? `<div class="bc-reveal-box-row"><span class="bc-reveal-box-label">Stan/sprat</span><span>${b.deliveryApartment}</span></div>` : ''}
          <div class="bc-reveal-box-row"><span class="bc-reveal-box-label">Grad</span><span>${b.deliveryCity || '-'}</span></div>
          <div class="bc-reveal-box-row"><span class="bc-reveal-box-label">Telefon</span><span>${b.deliveryPhone || '-'}</span></div>
          <div style="margin-top:12px;">
            ${b.revealBoxSent
              ? `<span style="color:#4ade80;font-size:13px;font-weight:700;">✅ Reveal Box poslan</span>`
              : `<button class="bc-btn-reveal-box" id="btn-rbs-${b.id}" onclick="markRevealBoxSent(${b.id})">📦 Označi kao poslan</button>`
            }
          </div>
        </div>
      </div>` : ''}

      <div class="bc-note-wrap">
        <div class="bc-label" style="margin-bottom:6px;">🛫 Avio kompanija</div>
        <div class="bc-note-row">
          <input class="bc-note-input" id="airline-name-${b.id}" type="text"
            placeholder="npr. Wizz Air, Ryanair..."
            value="${b.airlineName || ''}"
            onkeydown="if(event.key==='Enter')saveAirlineName(${b.id})"
            onblur="saveAirlineName(${b.id})" />
          <button class="bc-note-save" onclick="saveAirlineName(${b.id})" title="Sačuvaj (Enter)">✓</button>
        </div>
        <div class="bc-note-status" id="airline-name-status-${b.id}">
          ${b.airlineName ? `<span style="color:#22c55e;font-size:11px;">✓ ${b.airlineName}</span>` : '<span style="opacity:.45;font-size:11px;">Unesi naziv avio kompanije</span>'}
        </div>
      </div>

      <div class="bc-note-wrap">
        <div class="bc-label" style="margin-bottom:6px;">✈ Airline booking kod (check-in)</div>
        <div class="bc-note-row">
          <input class="bc-note-input" id="airline-code-${b.id}" type="text"
            style="text-transform:uppercase;letter-spacing:1.5px;font-family:monospace;font-size:14px;font-weight:700;"
            placeholder="npr. ABC123"
            value="${b.airlineBookingCode || ''}"
            onkeydown="if(event.key==='Enter')saveAirlineCode(${b.id})"
            onblur="saveAirlineCode(${b.id})" />
          <button class="bc-note-save" onclick="saveAirlineCode(${b.id})" title="Sačuvaj (Enter)">✓</button>
        </div>
        <div class="bc-note-status" id="airline-code-status-${b.id}">
          ${b.airlineBookingCode ? `<span style="color:#22c55e;font-size:11px;">✓ Kod poslan korisniku na reveal linku</span>` : '<span style="opacity:.45;font-size:11px;">Unesi kod - biće vidljiv korisniku na reveal stranici</span>'}
        </div>
      </div>

      <div class="bc-note-wrap">
        <div class="bc-label" style="margin-bottom:6px;">📝 Interna napomena</div>
        <div class="bc-note-row">
          <textarea class="bc-note-input" id="note-${b.id}"
            placeholder="npr. Uplata primljena, kontaktiran, čeka potvrdu..."
            onkeydown="if(event.ctrlKey&&event.key==='Enter')saveNote(${b.id})"
          >${b.adminNotes || ''}</textarea>
          <button class="bc-note-save" id="note-btn-${b.id}" onclick="saveNote(${b.id})" title="Sačuvaj napomenu (Ctrl+Enter)">✓</button>
        </div>
        <div class="bc-note-status" id="note-status-${b.id}"></div>
      </div>

      ${isCompleted ? `
      <div class="bc-actions">
        <span style="color:#818cf8;font-size:12px;font-weight:600;">🏁 Putovanje završeno - automatski zatvorena rezervacija</span>
      </div>` : `
      <div class="bc-actions">
        <button class="bc-btn bc-btn-confirm" onclick="changeStatus(${b.id},'CONFIRMED')" ${isConfirmed?'disabled':''}>
          ✅ Potvrdi
        </button>
        <button class="bc-btn bc-btn-cancel" onclick="changeStatus(${b.id},'CANCELLED')" ${isCancelled?'disabled':''}>
          ❌ Otkaži
        </button>
        ${!isPending ? `<button class="bc-btn bc-btn-pending" onclick="changeStatus(${b.id},'PENDING')">⏳ Vrati na čekanje</button>` : ''}
        ${(b.status !== 'CONFIRMED' && b.oldStatus !== 'CONFIRMED') ? `
        <button class="bc-btn" onclick="deleteBooking(${b.id},'${b.bookingRef}')"
          style="background:rgba(239,68,68,.12);color:#f87171;border:1px solid rgba(239,68,68,.2);margin-left:auto;">
          🗑 Obriši
        </button>` : ''}
      </div>`}
    </div>`;
  }).join('');
}

// ══ NOTES (API) ═══════════════════════════════════════════════════════════════
async function saveNote(id) {
  const el  = document.getElementById(`note-${id}`);
  const btn = document.getElementById(`note-btn-${id}`);
  const msg = document.getElementById(`note-status-${id}`);
  if (!el) return;

  btn.classList.add('saving');
  msg.textContent = '';

  try {
    const r = await fetch(`${API}/api/admin/bookings/${id}/notes`, {
      method: 'PATCH',
      headers: { 'Content-Type': 'application/json', 'X-Admin-Key': ADMIN_KEY },
      body: JSON.stringify({ adminNotes: el.value })
    });
    if (!r.ok) throw new Error();
    const updated = await r.json();
    // Ažuriraj lokalni cache
    const idx = ALL_BOOKINGS.findIndex(b => b.id === id);
    if (idx > -1) ALL_BOOKINGS[idx].adminNotes = updated.adminNotes;
    msg.textContent = '✓ Sačuvano';
    msg.style.color = 'var(--green)';
  } catch {
    msg.textContent = '✗ Greška pri čuvanju';
    msg.style.color = 'var(--red)';
  } finally {
    btn.classList.remove('saving');
    setTimeout(() => { msg.textContent = ''; }, 2500);
  }
}

// ══ DESTINATION (API) ═════════════════════════════════════════════════════════
async function saveDestination(id) {
  const el  = document.getElementById(`dest-${id}`);
  const btn = document.getElementById(`dest-btn-${id}`);
  const msg = document.getElementById(`dest-status-${id}`);
  if (!el) return;

  btn.classList.add('saving');
  msg.textContent = '';

  try {
    const r = await fetch(`${API}/api/admin/bookings/${id}/destination`, {
      method: 'PATCH',
      headers: { 'Content-Type': 'application/json', 'X-Admin-Key': ADMIN_KEY },
      body: JSON.stringify({ destination: el.value.trim() })
    });
    if (!r.ok) throw new Error();
    const updated = await r.json();
    const idx = ALL_BOOKINGS.findIndex(b => b.id === id);
    if (idx > -1) ALL_BOOKINGS[idx].assignedDestination = updated.assignedDestination;
    msg.innerHTML = '<span style="color:var(--green);font-size:11px;">✓ Sačuvano</span>';
  } catch {
    msg.innerHTML = '<span style="color:var(--red);font-size:11px;">✗ Greška pri čuvanju</span>';
  } finally {
    btn.classList.remove('saving');
    setTimeout(() => { msg.textContent = ''; }, 2500);
  }
}

// ══ WEATHER CITY (API) ════════════════════════════════════════════════════════
async function saveWeatherCity(id) {
  const el  = document.getElementById(`weather-city-${id}`);
  const msg = document.getElementById(`weather-city-status-${id}`);
  if (!el) return;

  const val = el.value.trim();

  // Ako je isti kao cache, ne šalji request
  const idx = ALL_BOOKINGS.findIndex(b => b.id === id);
  if (idx > -1 && (ALL_BOOKINGS[idx].weatherCity || '') === val) return;

  try {
    const r = await fetch(`${API}/api/admin/bookings/${id}/weather-city`, {
      method: 'PATCH',
      headers: { 'Content-Type': 'application/json', 'X-Admin-Key': ADMIN_KEY },
      body: JSON.stringify({ weatherCity: val })
    });
    if (!r.ok) throw new Error();
    const updated = await r.json();
    if (idx > -1) ALL_BOOKINGS[idx].weatherCity = updated.weatherCity;
    msg.innerHTML = updated.weatherCity
      ? `🌤 Prognoza koristi: <strong>${updated.weatherCity}</strong>`
      : '<span style="opacity:.5;">ako ostaviš prazno, koristi se ime destinacije</span>';
  } catch {
    msg.innerHTML = '<span style="color:var(--red);">✗ Greška pri čuvanju</span>';
    setTimeout(() => { msg.innerHTML = ''; }, 2000);
  }
}

async function saveAirlineName(id) {
  const el = document.getElementById(`airline-name-${id}`);
  if (!el) return;
  const val = el.value.trim();
  const idx = ALL_BOOKINGS.findIndex(b => b.id === id);
  if (idx > -1 && (ALL_BOOKINGS[idx].airlineName || '') === val) return;
  try {
    const r = await fetch(`${API}/api/admin/bookings/${id}/airline-name`, {
      method: 'PATCH',
      headers: { 'Content-Type': 'application/json', 'X-Admin-Key': ADMIN_KEY },
      body: JSON.stringify({ name: val })
    });
    if (!r.ok) throw new Error();
    const updated = await r.json();
    if (idx > -1) ALL_BOOKINGS[idx].airlineName = updated.airlineName;
    el.value = updated.airlineName || '';
    const statusEl = document.getElementById(`airline-name-status-${id}`);
    if (statusEl) {
      if (updated.airlineName) {
        const sp = document.createElement('span');
        sp.style.cssText = 'color:#22c55e;font-size:11px';
        sp.textContent = '✓ ' + updated.airlineName;
        statusEl.replaceChildren(sp);
      } else {
        statusEl.innerHTML = `<span style="opacity:.45;font-size:11px;">Unesi naziv avio kompanije</span>`;
      }
    }
  } catch {
    const statusEl = document.getElementById(`airline-name-status-${id}`);
    if (statusEl) statusEl.innerHTML = `<span style="color:#ef4444;font-size:11px;">Greška pri čuvanju</span>`;
  }
}

async function saveAirlineCode(id) {
  const el = document.getElementById(`airline-code-${id}`);
  if (!el) return;
  const val = el.value.trim().toUpperCase();
  const idx = ALL_BOOKINGS.findIndex(b => b.id === id);
  if (idx > -1 && (ALL_BOOKINGS[idx].airlineBookingCode || '') === val) return;
  try {
    const r = await fetch(`${API}/api/admin/bookings/${id}/airline-code`, {
      method: 'PATCH',
      headers: { 'Content-Type': 'application/json', 'X-Admin-Key': ADMIN_KEY },
      body: JSON.stringify({ code: val })
    });
    if (!r.ok) throw new Error();
    const updated = await r.json();
    if (idx > -1) ALL_BOOKINGS[idx].airlineBookingCode = updated.airlineBookingCode;
    el.value = updated.airlineBookingCode || '';
    const statusEl = document.getElementById(`airline-code-status-${id}`);
    if (statusEl) {
      statusEl.innerHTML = updated.airlineBookingCode
        ? `<span style="color:#22c55e;font-size:11px;">✓ Kod poslan korisniku na reveal linku</span>`
        : `<span style="opacity:.45;font-size:11px;">Unesi kod - biće vidljiv korisniku na reveal stranici</span>`;
    }
  } catch {
    el.style.borderColor = 'var(--red)';
    setTimeout(() => { el.style.borderColor = ''; }, 2000);
  }
}

// ══ REVEAL BOX - označi kao poslan ═══════════════════════════════════════════

async function markRevealBoxSent(id) {
  const btn = document.getElementById(`btn-rbs-${id}`);
  if (btn) { btn.disabled = true; btn.textContent = '⏳ Slanje...'; }
  try {
    const r = await fetch(`${API}/api/admin/bookings/${id}/reveal-box-sent`, {
      method: 'POST',
      headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) throw new Error();
    const updated = await r.json();
    const idx = ALL_BOOKINGS.findIndex(b => b.id === id);
    if (idx > -1) ALL_BOOKINGS[idx].revealBoxSent = true;
    // Zameni dugme sa statusom
    if (btn) {
      btn.replaceWith(Object.assign(document.createElement('span'), {
        style: 'color:#4ade80;font-size:13px;font-weight:700;',
        textContent: '✅ Reveal Box poslan'
      }));
    }
  } catch {
    if (btn) { btn.disabled = false; btn.textContent = '📦 Označi kao poslan'; }
    alert('Greška - pokušaj ponovo.');
  }
}

// ══ MANUAL SEND REVEAL / FORECAST ════════════════════════════════════════════

function fmtTs(iso) {
  return new Date(iso).toLocaleString('sr-RS',{day:'2-digit',month:'2-digit',year:'numeric',hour:'2-digit',minute:'2-digit'});
}

function getBtnAttrs(b, type) {
  if (type === 'reveal') {
    if (b.revealSentAt) return 'disabled title="Reveal je već poslan"';
    return 'onclick="sendReveal(' + b.id + ')"';
  } else {
    if (b.forecastSentAt) return 'disabled title="Prognoza je već poslata"';
    var days = b.departureDate
      ? Math.round((new Date(b.departureDate) - new Date()) / 86400000)
      : 0;
    if (days > 7) return 'disabled title="Prerano - polazak za ' + days + ' dana (prognoza je pouzdana max 7 dana unapred)"';
    return 'onclick="sendForecast(' + b.id + ')"';
  }
}

async function sendReveal(id) {
  const { isConfirmed } = await Swal.fire({
    title: 'Pošalji Reveal email?',
    html: '<span style="color:#94a3b8;font-size:13px;">Korisniku će biti poslan email sa destinacijom i magic linkom.<br>Nakon slanja <strong style="color:white;">automatsko slanje se neće ponoviti</strong> za ovaj booking.</span>',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: '✉ Pošalji',
    cancelButtonText: 'Otkaži',
    background: '#0b1929', color: '#fff',
    confirmButtonColor: '#22c55e',
    cancelButtonColor: '#374151',
  });
  if (!isConfirmed) return;

  const btn = document.getElementById(`btn-reveal-${id}`);
  btn.disabled = true;
  btn.textContent = '⏳ Šaljem...';

  try {
    const r = await fetch(`${API}/api/admin/bookings/${id}/send-reveal`, {
      method: 'POST',
      headers: {
        'X-Admin-Key': ADMIN_KEY,
        'X-Frontend-Url': '<?php echo esc_url(home_url()); ?>'
      }
    });
    const data = await r.json();

    if (!r.ok) {
      throw new Error(data.message || data.error || 'Greška pri slanju.');
    }

    // Ažuriraj lokalni cache i UI
    const now = new Date().toISOString();
    const idx = ALL_BOOKINGS.findIndex(b => b.id === id);
    if (idx > -1) ALL_BOOKINGS[idx].revealSentAt = now;

    btn.textContent = '✉ Reveal poslan';
    btn.title = 'Reveal je već poslan';

    const statusEl = document.getElementById(`dest-status-${id}`);
    if (statusEl) {
      const old = statusEl.querySelector('.rv-not-sent');
      if (old) old.remove();
      const span = document.createElement('span');
      span.className = 'bc-reveal-sent';
      span.textContent = `✉ Reveal poslan ${fmtTs(now)}`;
      statusEl.prepend(span);
    }

    Swal.fire({ icon: 'success', title: 'Poslato!', text: data.message, background: '#0b1929', color: '#fff', timer: 2500, showConfirmButton: false });
  } catch(e) {
    btn.disabled = false;
    btn.textContent = '✉ Pošalji Reveal';
    Swal.fire({ icon: 'error', title: 'Greška', text: e.message, background: '#0b1929', color: '#fff' });
  }
}

async function sendForecast(id) {
  const { isConfirmed } = await Swal.fire({
    title: 'Pošalji Prognozu?',
    html: '<span style="color:#94a3b8;font-size:13px;">Korisniku će biti poslata vremenska prognoza za putovanje.<br>Nakon slanja <strong style="color:white;">automatsko slanje se neće ponoviti</strong> za ovaj booking.</span>',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: '🌤 Pošalji',
    cancelButtonText: 'Otkaži',
    background: '#0b1929', color: '#fff',
    confirmButtonColor: '#38bdf8',
    cancelButtonColor: '#374151',
  });
  if (!isConfirmed) return;

  const btn = document.getElementById(`btn-forecast-${id}`);
  btn.disabled = true;
  btn.textContent = '⏳ Preuzimam prognozu...';

  try {
    const r = await fetch(`${API}/api/admin/bookings/${id}/send-forecast`, {
      method: 'POST',
      headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    const data = await r.json();

    if (!r.ok) {
      throw new Error(data.message || data.error || 'Greška pri slanju.');
    }

    const now = new Date().toISOString();
    const idx = ALL_BOOKINGS.findIndex(b => b.id === id);
    if (idx > -1) ALL_BOOKINGS[idx].forecastSentAt = now;

    btn.textContent = '🌤 Prognoza poslata';
    btn.title = 'Prognoza je već poslata';

    const statusEl = document.getElementById(`dest-status-${id}`);
    if (statusEl) {
      const span = document.createElement('span');
      span.style.cssText = 'color:#38bdf8;font-size:11px;font-weight:600;';
      span.textContent = `🌤 Prognoza poslata ${fmtTs(now)}`;
      statusEl.appendChild(span);
    }

    Swal.fire({ icon: 'success', title: 'Poslato!', text: data.message, background: '#0b1929', color: '#fff', timer: 2500, showConfirmButton: false });
  } catch(e) {
    btn.disabled = false;
    btn.textContent = '🌤 Pošalji Prognozu';
    Swal.fire({ icon: 'error', title: 'Greška', text: e.message, background: '#0b1929', color: '#fff' });
  }
}

// ══ EXPORT CSV ════════════════════════════════════════════════════════════════
function exportCSV() {
  const filtered = getFilteredBookings();
  if (!filtered.length) {
    Swal.fire({ icon: 'info', title: 'Nema podataka', text: 'Nema rezervacija za export.', background: '#0b1929', color: '#fff' });
    return;
  }
  const headers = [
    'Broj rezervacije','Status','Ime','Prezime','Email','Telefon',
    'Aerodrom','Datum polaska','Datum povratka','Putnici','Smeštaj',
    'Osnovna cena/os','Ukupno/os','Ukupno EUR',
    'Isključene destinacije','Dodaci','Napomena klijenta','Interna napomena','Primljeno'
  ];
  const esc = v => `"${String(v ?? '').replace(/"/g, '""')}"`;
  const rows = filtered.map(b => [
    b.bookingRef,
    b.status,
    b.firstName,
    b.lastName,
    b.email,
    b.phone,
    b.departureAirport,
    b.departureDate || '',
    b.returnDate || '',
    b.numberOfTravelers,
    b.accommodationType,
    b.basePricePerPerson,
    b.totalPricePerPerson,
    b.totalPriceAll,
    (b.excludedDestinations || []).join('; '),
    [
      b.hasInsurance         ? 'Osiguranje'       : '',
      b.hasBreakfast         ? 'Doručak'           : '',
      b.hasSeatsTogther      ? 'Sedišta zajedno'   : '',
      b.hasConnectingFlights ? 'Presedanje'        : '',
      b.cabinSuitcaseCount > 0 ? `Kofer×${b.cabinSuitcaseCount}` : '',
    ].filter(Boolean).join('; '),
    b.notes || '',
    b.adminNotes || '',
    b.createdAt ? new Date(b.createdAt).toLocaleString('sr-RS') : ''
  ].map(esc).join(','));

  const csv  = [headers.map(esc).join(','), ...rows].join('\r\n');
  const blob = new Blob(['\uFEFF' + csv], { type: 'text/csv;charset=utf-8;' });
  const url  = URL.createObjectURL(blob);
  const a    = document.createElement('a');
  const date = new Date().toISOString().split('T')[0];
  a.href     = url;
  a.download = `escapii-${activeFilter.toLowerCase()}-${date}.csv`;
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
}

async function changeStatus(id, status) {
  const labels = { CONFIRMED: 'potvrditi', CANCELLED: 'otkazati', PENDING: 'vratiti na čekanje' };
  const icons  = { CONFIRMED: '✅', CANCELLED: '❌', PENDING: '⏳' };
  const colors = { CONFIRMED: '#22c55e', CANCELLED: '#ef4444', PENDING: '#CA8A71' };

  const confirm = await Swal.fire({
    title: `${icons[status]} ${labels[status]?.charAt(0).toUpperCase() + labels[status]?.slice(1)} rezervaciju?`,
    text: `Status će biti promenjen na: ${status}`,
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Da, promeni',
    cancelButtonText: 'Odustani',
    confirmButtonColor: colors[status],
    background: '#0b1929',
    color: '#fff'
  });
  if (!confirm.isConfirmed) return;

  try {
    const r = await fetch(`${API}/api/admin/bookings/${id}/status?value=${status}`, {
      method: 'PATCH',
      headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) throw new Error();

    const updated = await r.json();
    const idx = ALL_BOOKINGS.findIndex(b => b.id === id);
    if (idx > -1) {
      // Čuvamo lokalno weatherCity u slučaju race condition-a
      // (saveWeatherCity request možda još uvek u toku kad changeStatus pročita DB)
      const localWeatherCity = ALL_BOOKINGS[idx].weatherCity;
      ALL_BOOKINGS[idx] = updated;
      if (!ALL_BOOKINGS[idx].weatherCity && localWeatherCity) {
        ALL_BOOKINGS[idx].weatherCity = localWeatherCity;
      }
    }

    updateBookingBadge();
    renderBookings();

    Swal.fire({
      toast: true, position: 'top-end', icon: 'success',
      title: `Status promenjen na ${status}`,
      showConfirmButton: false, timer: 2000,
      background: '#0b1929', color: '#fff'
    });
  } catch {
    Swal.fire({ icon: 'error', title: 'Greška', text: 'Status nije promenjen.', background: '#0b1929', color: '#fff' });
  }
}

async function deleteBooking(id, ref) {
  const confirm = await Swal.fire({
    title: '🗑 Obriši rezervaciju?',
    html: `<p style="color:#9ca3af;line-height:1.7;">Rezervacija <strong style="color:#fff;">${ref}</strong> biće trajno obrisana.<br>
           Ova radnja se ne može poništiti.</p>`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Da, obriši',
    cancelButtonText: 'Odustani',
    confirmButtonColor: '#ef4444',
    background: '#0b1929',
    color: '#fff'
  });
  if (!confirm.isConfirmed) return;

  try {
    const r = await fetch(`${API}/api/admin/bookings/${id}`, {
      method: 'DELETE',
      headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) {
      const d = await r.json().catch(() => ({}));
      apiErr(d.error || 'Greška pri brisanju rezervacije.');
      return;
    }

    ALL_BOOKINGS = ALL_BOOKINGS.filter(b => b.id !== id);
    updateBookingBadge();
    renderBookings();

    Swal.fire({
      toast: true, position: 'top-end', icon: 'success',
      title: `Rezervacija ${ref} obrisana`,
      showConfirmButton: false, timer: 2500,
      background: '#0b1929', color: '#fff'
    });
  } catch {
    apiErr('Greška pri brisanju rezervacije.');
  }
}

// ══════════════════════════════════════════════════════════════════════════════
// UPITI ZA CUSTOM TERMINE
// ══════════════════════════════════════════════════════════════════════════════

let _inquiries = [];

// Format LocalDate - handles both "2026-06-15" string and [2026,6,15] Java array
function fmtLocalDate(d) {
  if (!d) return '-';
  if (Array.isArray(d)) {
    // Java serializes LocalDate as [year, month(1-indexed), day]
    const [y, m, day] = d;
    return `${String(day).padStart(2,'0')}.${String(m).padStart(2,'0')}.${y}.`;
  }
  const parts = String(d).split('-');
  if (parts.length === 3) return `${parts[2]}.${parts[1]}.${parts[0]}.`;
  return String(d);
}

const INQ_STATUS_LABELS = {
  PENDING:      'Na čekanju',
  PRIVATE_SENT: 'Link poslat'
};
const INQ_STATUS_ICONS = {
  PENDING: '●', PRIVATE_SENT: '🔒'
};

async function loadInquiries() {
  const el = document.getElementById('inquiriesTable');
  el.innerHTML = 'Učitavanje...';
  try {
    const r = await fetch(`${API}/api/admin/inquiries`, {
      headers: { 'X-Admin-Key': ADMIN_KEY }, cache: 'no-store'
    });
    _inquiries = await r.json();

    const pending = _inquiries.filter(i => i.status === 'PENDING').length;
    document.getElementById('inquiriesBadge').textContent = pending > 0 ? pending : '';

    if (!_inquiries.length) {
      el.innerHTML = `<div style="text-align:center;padding:40px;color:#8899aa;">Nema upita.</div>`;
      return;
    }

    renderInquiries();
  } catch(e) {
    el.innerHTML = `<div style="color:#f87171;">Greška pri učitavanju upita.</div>`;
  }
}

function renderInquiries() {
  const el = document.getElementById('inquiriesTable');
  const rows = _inquiries.map(i => {
    const created = new Date(i.createdAt).toLocaleString('sr-RS');
    const depDate  = fmtLocalDate(i.desiredDepartureDate);
    const retDate  = (() => {
      if (!i.desiredDepartureDate || !i.nights) return '-';
      let d;
      if (Array.isArray(i.desiredDepartureDate)) {
        d = new Date(i.desiredDepartureDate[0], i.desiredDepartureDate[1]-1, i.desiredDepartureDate[2]);
      } else {
        const p = String(i.desiredDepartureDate).split('-');
        d = new Date(parseInt(p[0]), parseInt(p[1])-1, parseInt(p[2]));
      }
      d.setDate(d.getDate() + i.nights);
      return fmtLocalDate([d.getFullYear(), d.getMonth()+1, d.getDate()]);
    })();
    const period = `${depDate} → ${retDate}`;
    const rawDepISO = Array.isArray(i.desiredDepartureDate)
      ? `${i.desiredDepartureDate[0]}-${String(i.desiredDepartureDate[1]).padStart(2,'0')}-${String(i.desiredDepartureDate[2]).padStart(2,'0')}`
      : String(i.desiredDepartureDate);
    const createdShort = new Date(i.createdAt).toLocaleString('sr-RS', {day:'2-digit',month:'2-digit',year:'numeric',hour:'2-digit',minute:'2-digit'});
    return `
      <tr>
        <td style="white-space:nowrap;font-size:12px;color:var(--gray);">${createdShort}</td>
        <td><strong>${i.airport}</strong></td>
        <td style="text-align:center;">${i.travelers}</td>
        <td style="white-space:nowrap;">${period} <span style="color:var(--gray);font-size:11px;">${i.nights}🌙</span></td>
        <td><a href="mailto:${i.email}" style="color:#60a5fa;word-break:break-all;">${i.email}</a></td>
        <td style="max-width:160px;font-size:12px;color:#aaa;">${i.notes ? escHtml(i.notes) : '-'}</td>
        <td>
          <div style="display:flex;flex-direction:column;gap:4px;min-width:110px;">
            <input type="number" min="0" max="99999" step="1"
              value="${i.price != null ? i.price : ''}"
              placeholder="npr. 279"
              title="Ukupna cena u EUR (za sve putnike)"
              onchange="updateInquiryPrice(${i.id}, this)"
              style="width:100%;padding:5px 8px;border-radius:6px;font-size:13px;font-weight:700;
                background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.15);
                color:#f6f1e6;outline:none;text-align:right;">
            <span style="font-size:10px;color:#64748b;text-align:right;">
              ${i.price != null
                ? `≈ <strong style="color:#CA8A71">${Math.round(i.price / i.travelers)}€</strong>/os.`
                : '<span style="color:#475569">unesi cenu</span>'}
            </span>
          </div>
        </td>
        <td>
          <span class="iq-pill iq-${i.status}">${INQ_STATUS_ICONS[i.status] || '●'} ${INQ_STATUS_LABELS[i.status] || i.status}</span>
          <select class="iq-status-sel" onchange="updateInquiryStatus(${i.id}, this.value)">
            ${Object.keys(INQ_STATUS_LABELS).map(s =>
              `<option value="${s}" ${i.status === s ? 'selected' : ''}>${INQ_STATUS_LABELS[s]}</option>`
            ).join('')}
          </select>
        </td>
        <td>
          <button onclick="promptMakePrivate(${i.id}, '${i.airport}', ${i.travelers}, '${period}', ${i.price != null ? i.price : 'null'})" style="
            padding:5px 10px;border-radius:6px;font-size:12px;background:#1a4a5a;
            border:1px solid #2a6a7a;color:#fff;cursor:pointer;white-space:nowrap;
          ">🔒 Privatni termin</button>
        </td>
      </tr>`;
  }).join('');

  el.innerHTML = `
    <div class="table-wrap">
      <table>
        <thead><tr>
          <th>Datum upita</th><th>Aerodrom</th><th>Putnici</th>
          <th>Period</th><th>Email</th><th>Napomena</th>
          <th>Cena (€)</th><th>Status</th><th>Akcija</th>
        </tr></thead>
        <tbody>${rows}</tbody>
      </table>
    </div>`;
}

async function updateInquiryStatus(id, status) {
  try {
    await fetch(`${API}/api/admin/inquiries/${id}/status?value=${status}`, {
      method: 'PATCH', headers: { 'X-Admin-Key': ADMIN_KEY }
    });

    if (status === 'PRIVATE_SENT') {
      // Automatski briši upit čim je link poslat
      await fetch(`${API}/api/admin/inquiries/${id}`, {
        method: 'DELETE', headers: { 'X-Admin-Key': ADMIN_KEY }
      });
      _inquiries = _inquiries.filter(x => x.id !== id);
      const pending = _inquiries.filter(i => i.status === 'PENDING').length;
      document.getElementById('inquiriesBadge').textContent = pending > 0 ? pending : '';
      if (!_inquiries.length) {
        document.getElementById('inquiriesTable').innerHTML =
          `<div style="text-align:center;padding:40px;color:#8899aa;">Nema upita.</div>`;
      } else {
        renderInquiries();
      }
      return; // toast se prikazuje u promptMakePrivate, ovde ne treba
    }

    const i = _inquiries.find(x => x.id === id);
    if (i) i.status = status;
    const pending = _inquiries.filter(i => i.status === 'PENDING').length;
    document.getElementById('inquiriesBadge').textContent = pending > 0 ? pending : '';
    Swal.fire({ toast:true, position:'top-end', icon:'success', title:'Status ažuriran',
      showConfirmButton:false, timer:1500, background:'#0b1929', color:'#fff' });
  } catch {
    Swal.fire({ icon:'error', title:'Greška', text:'Status nije promenjen.', background:'#0b1929', color:'#fff' });
  }
}

async function updateInquiryPrice(id, inputEl) {
  const raw = inputEl.value.trim();
  const value = raw === '' ? null : parseFloat(raw);
  if (value !== null && (isNaN(value) || value < 0)) {
    inputEl.style.borderColor = '#ef4444';
    return;
  }
  inputEl.style.borderColor = '';
  try {
    const url = value !== null
      ? `${API}/api/admin/inquiries/${id}/price?value=${value}`
      : `${API}/api/admin/inquiries/${id}/price`;
    const resp = await fetch(url, { method: 'PATCH', headers: { 'X-Admin-Key': ADMIN_KEY } });
    if (!resp.ok) throw new Error();
    const updated = await resp.json();
    const i = _inquiries.find(x => x.id === id);
    if (i) i.price = updated.price;
    // Osveži /os prikaz ispod inputa
    const priceCell = inputEl.closest('td');
    const ppEl = priceCell?.querySelector('span:last-child');
    if (ppEl) {
      ppEl.innerHTML = updated.price != null
        ? `≈ <strong style="color:#CA8A71">${Math.round(updated.price / updated.travelers)}€</strong>/os.`
        : '<span style="color:#475569">unesi cenu</span>';
    }
    inputEl.style.borderColor = 'rgba(34,197,94,.5)';
    setTimeout(() => { inputEl.style.borderColor = ''; }, 1200);
    Swal.fire({ toast:true, position:'top-end', icon:'success', title:'Cena sačuvana',
      showConfirmButton:false, timer:1500, background:'#0b1929', color:'#fff' });
  } catch {
    inputEl.style.borderColor = '#ef4444';
    Swal.fire({ toast:true, position:'top-end', icon:'error', title:'Greška pri čuvanju cene',
      showConfirmButton:false, timer:2000, background:'#0b1929', color:'#fff' });
  }
}

function fallbackCopy(inp, btn) {
  inp.select(); inp.setSelectionRange(0, 99999);
  try { document.execCommand('copy'); } catch {}
  btn.innerHTML = '✅ Kopirano!';
  btn.style.background = 'rgba(34,197,94,.15)';
  btn.style.borderColor = 'rgba(34,197,94,.35)';
  btn.style.color = '#86efac';
}

async function promptMakePrivate(inquiryId, airport, travelers, desiredPeriod, inquiryPrice) {
  const suggestedPrice = (inquiryPrice != null && travelers > 0)
    ? Math.round(inquiryPrice / travelers) : '';

  const { value: formValues } = await Swal.fire({
    title: '🔒 Kreiraj privatni termin',
    html: `
      <p style="margin-bottom:10px;font-size:13px;color:#aaa;">
        Upit #${inquiryId} · <strong style="color:#fff;">${airport}</strong> · ${travelers} os.
      </p>
      <div style="background:rgba(202,138,113,.1);border:1px solid rgba(202,138,113,.25);
                  border-radius:8px;padding:10px 14px;margin-bottom:14px;font-size:13px;color:#e09070;text-align:left;">
        📅 Privatni termin: <strong>${desiredPeriod}</strong>
      </div>
      <label style="font-size:12px;display:block;text-align:left;margin-bottom:4px;">Broj putnika (slobodnih mesta):</label>
      <input id="swal-travelers" type="number" value="${travelers}" min="1" max="50"
        style="width:100%;padding:8px;border-radius:6px;margin-bottom:12px;background:#0d2035;border:1px solid #1e3a55;color:#fff;">
      <label style="font-size:12px;display:block;text-align:left;margin-bottom:4px;">
        Cena po osobi (€) <span style="color:#ef4444;">*</span>
      </label>
      <input id="swal-price" type="number" min="1" value="${suggestedPrice}" placeholder="npr. 299"
        style="width:100%;padding:8px;border-radius:6px;margin-bottom:12px;background:#0d2035;border:1px solid #1e3a55;color:#fff;">
      <label style="font-size:12px;display:block;text-align:left;margin-bottom:4px;">Link važi (sati):</label>
      <input id="swal-expiry" type="number" value="48" min="1" max="720"
        style="width:100%;padding:8px;border-radius:6px;background:#0d2035;border:1px solid #1e3a55;color:#fff;">
    `,
    showCancelButton: true,
    confirmButtonText: '🔒 Generiši privatni link',
    confirmButtonColor: '#1a4a5a',
    cancelButtonText: 'Odustani',
    background: '#0b1929', color: '#fff',
    preConfirm: () => {
      const priceVal = document.getElementById('swal-price').value.trim();
      if (!priceVal || parseInt(priceVal) < 1) {
        Swal.showValidationMessage('Cena po osobi je obavezna.');
        return false;
      }
      return {
        travelers:      parseInt(document.getElementById('swal-travelers').value),
        expiresInHours: parseInt(document.getElementById('swal-expiry').value),
        pricePerPerson: parseInt(priceVal)
      };
    }
  });

  if (!formValues) return;

  try {
    // Jedan atomični poziv - termin je privatan od prvog trenutka, nema race conditiona
    const res = await fetch(`${API}/api/admin/inquiries/${inquiryId}/create-private-date`, {
      method: 'POST',
      headers: { 'X-Admin-Key': ADMIN_KEY, 'Content-Type': 'application/json' },
      body: JSON.stringify({
        pricePerPerson: formValues.pricePerPerson,
        travelers:      formValues.travelers,
        expiresInHours: formValues.expiresInHours
      })
    });

    if (!res.ok) {
      const err = await res.json().catch(() => ({}));
      return Swal.fire({ icon:'error', title:'Greška',
        text: err.message || err.error || 'Kreiranje nije uspelo.',
        background:'#0b1929', color:'#fff' });
    }

    const dateResp    = await res.json();
    const privateLink = `${window.location.origin}/?privateDate=${dateResp.privateToken}`;

    await updateInquiryStatus(inquiryId, 'PRIVATE_SENT');

    await Swal.fire({
      title: '✅ Privatni termin kreiran!',
      html: `
        <p style="margin-bottom:10px;font-size:13px;color:#aaa;">Pošalji korisniku ovaj link:</p>
        <input id="privateLinkInput" readonly value="${privateLink}"
          style="width:100%;padding:9px 12px;border-radius:8px;background:#0d2035;border:1px solid #1e3a55;
                 color:#7dd3fc;font-size:12px;font-family:monospace;">
        <button id="swalCopyBtn" style="
          margin-top:10px;width:100%;padding:10px;border-radius:8px;
          background:rgba(202,138,113,.15);border:1px solid rgba(202,138,113,.35);
          color:#e09070;cursor:pointer;font-size:13px;font-weight:700;transition:background .2s;">
          📋 Kopiraj link
        </button>
        <p style="margin-top:10px;font-size:11px;color:#64748b;">
          ⏱ Link ističe za <strong style="color:#94a3b8">${formValues.expiresInHours}h</strong>
          &nbsp;·&nbsp; 📅 ${desiredPeriod}
        </p>
      `,
      confirmButtonText: 'Zatvori',
      confirmButtonColor: 'var(--accent)',
      background: '#0b1929', color: '#fff',
      didOpen: () => {
        const btn = document.getElementById('swalCopyBtn');
        const inp = document.getElementById('privateLinkInput');
        btn.addEventListener('click', () => {
          if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(inp.value)
              .then(() => { btn.innerHTML = '✅ Kopirano!'; btn.style.background='rgba(34,197,94,.15)'; btn.style.borderColor='rgba(34,197,94,.35)'; btn.style.color='#86efac'; })
              .catch(() => fallbackCopy(inp, btn));
          } else { fallbackCopy(inp, btn); }
        });
      }
    });

    loadDates();

  } catch(e) {
    Swal.fire({ icon:'error', title:'Greška', text:'Mrežna greška. Pokušaj ponovo.', background:'#0b1929', color:'#fff' });
  }
}

function escHtml(str) {
  return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// ══ POKLONI ══════════════════════════════════════════════════════════════════

let _gVouchers = [];

async function loadGifts() {
  await loadGiftVouchers();
}

async function loadGiftVouchers() {
  const tbody = document.getElementById('giftVouchersTbody');
  try {
    const r = await fetch(`${API}/api/admin/gifts/vouchers`, { headers: { 'X-Admin-Key': ADMIN_KEY }, cache: 'no-store' });
    if (!r.ok) throw new Error();
    _gVouchers = await r.json();
    const pending = _gVouchers.filter(v => v.status === 'PENDING').length;
    const giftsBadge = document.getElementById('giftsBadge');
    if (giftsBadge) giftsBadge.textContent = pending || '';
    renderGiftVouchers();
  } catch {
    tbody.innerHTML = `<tr><td colspan="8" style="text-align:center;padding:32px;color:#ef4444;">Greška pri učitavanju vaučera.</td></tr>`;
  }
}

function renderGiftVouchers() {
  const tbody = document.getElementById('giftVouchersTbody');
  if (!_gVouchers.length) {
    tbody.innerHTML = `<tr><td colspan="8" class="empty-state">Nema vaučera.</td></tr>`;
    return;
  }
  const statusLabel = { PENDING:'⏳ Na čekanju', ACTIVE:'✅ Aktivan', RESERVED:'🔒 Rezervisan', USED:'🏁 Iskorišćen', EXPIRED:'⌛ Istekao' };
  const statusClass = { PENDING:'iq-PENDING', ACTIVE:'badge-green', RESERVED:'iq-IN_REVIEW', USED:'badge-gray', EXPIRED:'badge-red' };
  tbody.innerHTML = _gVouchers.map(v => {
    const created  = v.createdAt  ? new Date(v.createdAt).toLocaleDateString('sr-RS')  : '-';
    const expires  = v.expiresAt  ? new Date(v.expiresAt).toLocaleDateString('sr-RS')  : '-';
    const msg      = v.giftMessage ? `<span title="${escHtml(v.giftMessage)}" style="cursor:help;color:#94a3b8;">💬</span>` : '';
    const codePill = (v.status === 'ACTIVE' || v.status === 'RESERVED') && v.code
      ? `<span style="font-family:monospace;font-size:11px;background:rgba(202,138,113,.1);color:#CA8A71;padding:2px 7px;border-radius:5px;">${escHtml(v.code)}</span>` : '';
    const reservedNote = v.status === 'RESERVED'
      ? `<div style="font-size:11px;color:#fbbf24;margin-top:3px;">⏳ Čeka potvrdu rezervacije</div>` : '';
    const canReactivate = ['RESERVED','USED','EXPIRED'].includes(v.status);
    const actions  = v.status === 'PENDING'
      ? `<button class="btn-action btn-toggle-on" onclick="activateGiftVoucher(${v.id})">✅ Aktiviraj</button>`
      : v.status === 'ACTIVE'
      ? `<button class="btn-action btn-edit" onclick="markGiftVoucherUsed(${v.id})">🏁 Iskorišćen</button>`
      : canReactivate
      ? `<div style="display:flex;gap:5px;flex-wrap:wrap;">
           ${v.status === 'RESERVED' ? `<button class="btn-action btn-edit" onclick="markGiftVoucherUsed(${v.id})" title="Ručni override">🏁 USED</button>` : ''}
           <button class="btn-action" style="background:rgba(147,197,253,.15);color:#93c5fd;border:1px solid rgba(147,197,253,.3);" onclick="reactivateGiftVoucher(${v.id})" title="Vrati vaučer u ACTIVE stanje (npr. test rezervacija, otkazano putovanje)">🔓 Reaktiviraj</button>
         </div>`
      : '-';
    return `<tr>
      <td style="color:#64748b;font-size:12px;">#${v.id}</td>
      <td>
        <div style="font-size:13px;font-weight:600;">${escHtml(v.buyerName || '-')}</div>
        <div style="font-size:11px;color:#64748b;">${escHtml(v.buyerEmail)}</div>
      </td>
      <td style="font-weight:800;color:#CA8A71;">
        ${(v.remainingAmount != null ? v.remainingAmount : v.amount)}€
        ${(v.usedAmount > 0 ? `<div style="font-size:10px;color:#64748b;font-weight:400;">od ${v.amount}€ ukupno</div>` : '')}
      </td>
      <td>
        <span class="badge ${statusClass[v.status] || 'badge-gray'}">${statusLabel[v.status] || v.status}</span>
        ${codePill}${reservedNote}
      </td>
      <td style="text-align:center;">${msg}</td>
      <td style="font-size:12px;color:#64748b;">${created}</td>
      <td style="font-size:12px;color:#64748b;">${expires}</td>
      <td>${actions}</td>
    </tr>`;
  }).join('');
}

async function activateGiftVoucher(id) {
  const v = _gVouchers.find(x => x.id === id);
  const { isConfirmed } = await Swal.fire({
    title: '✅ Aktiviraj vaučer?',
    html: `<p style="color:#94a3b8;font-size:14px;">Vaučer <strong style="color:#fff;">#${id}</strong> (${v?.amount}€) biće aktiviran - kupac <strong style="color:#CA8A71;">${escHtml(v?.buyerEmail||'')}</strong> dobija PDF vaučer na email.</p>`,
    showCancelButton: true, confirmButtonText: 'Da, aktiviraj', cancelButtonText: 'Odustani',
    confirmButtonColor: '#22c55e', background: '#0b1929', color: '#fff'
  });
  if (!isConfirmed) return;
  try {
    const r = await fetch(`${API}/api/admin/gifts/vouchers/${id}/activate`, {
      method: 'PATCH', headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) throw new Error((await r.json().catch(()=>({}))).error || 'Greška');
    const updated = await r.json();
    const idx = _gVouchers.findIndex(x => x.id === id);
    if (idx !== -1) _gVouchers[idx] = updated;
    renderGiftVouchers();
    Swal.fire({ toast:true, position:'top-end', icon:'success', title:'Vaučer aktiviran - email poslat primaocu', showConfirmButton:false, timer:2500, background:'#0b1929', color:'#fff' });
  } catch(e) {
    Swal.fire({ icon:'error', title:'Greška', text: e.message, background:'#0b1929', color:'#fff' });
  }
}

async function markGiftVoucherUsed(id) {
  const { isConfirmed } = await Swal.fire({
    title: '🏁 Označi kao iskorišćen?',
    html: `<p style="color:#94a3b8;font-size:14px;">Vaučer #${id} biće trajno označen kao iskorišćen.</p>`,
    showCancelButton: true, confirmButtonText: 'Da', cancelButtonText: 'Odustani',
    background: '#0b1929', color: '#fff'
  });
  if (!isConfirmed) return;
  try {
    const r = await fetch(`${API}/api/admin/gifts/vouchers/${id}/mark-used`, {
      method: 'PATCH', headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) throw new Error();
    const updated = await r.json();
    const idx = _gVouchers.findIndex(x => x.id === id);
    if (idx !== -1) _gVouchers[idx] = updated;
    renderGiftVouchers();
    Swal.fire({ toast:true, position:'top-end', icon:'success', title:'Vaučer označen kao iskorišćen', showConfirmButton:false, timer:2000, background:'#0b1929', color:'#fff' });
  } catch {
    Swal.fire({ icon:'error', title:'Greška', background:'#0b1929', color:'#fff' });
  }
}

async function reactivateGiftVoucher(id) {
  const v = _gVouchers.find(x => x.id === id);
  const { isConfirmed } = await Swal.fire({
    title: '🔓 Reaktiviraj vaučer?',
    html: `<p style="color:#94a3b8;font-size:14px;">Vaučer <strong style="color:#fff;">#${id}</strong> (${v?.amount}€, trenutno: <strong style="color:#fbbf24;">${v?.status}</strong>) biće vraćen u <strong style="color:#93c5fd;">ACTIVE</strong> stanje i može ponovo biti korišćen.</p>
           <p style="color:#ef4444;font-size:12px;margin-top:8px;">⚠️ Koristi samo ako je vaučer ostao zarobljen zbog test rezervacije ili otkazanog putovanja.</p>`,
    showCancelButton: true, confirmButtonText: 'Da, reaktiviraj', cancelButtonText: 'Odustani',
    confirmButtonColor: '#3b82f6', background: '#0b1929', color: '#fff'
  });
  if (!isConfirmed) return;
  try {
    const r = await fetch(`${API}/api/admin/gifts/vouchers/${id}/reactivate`, {
      method: 'PATCH', headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) throw new Error((await r.json().catch(()=>({}))).message || 'Greška');
    const updated = await r.json();
    const idx = _gVouchers.findIndex(x => x.id === id);
    if (idx !== -1) _gVouchers[idx] = updated;
    renderGiftVouchers();
    Swal.fire({ toast:true, position:'top-end', icon:'success', title:'Vaučer reaktiviran - sada ACTIVE', showConfirmButton:false, timer:2000, background:'#0b1929', color:'#fff' });
  } catch(e) {
    Swal.fire({ icon:'error', title:'Greška', text: e.message, background:'#0b1929', color:'#fff' });
  }
}


</script>

</body>
</html>
