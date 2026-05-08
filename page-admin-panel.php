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
  <title>Escapii — Admin Panel</title>
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
.booking-card.status-CONFIRMED { border-left: 3px solid var(--green); }
.booking-card.status-CANCELLED { border-left: 3px solid var(--red); opacity: .65; }
.booking-card.status-PENDING   { border-left: 3px solid var(--accent); }
.bc-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 8px; }
.bc-ref { font-size: 15px; font-weight: 800; color: var(--white); }
.bc-date { font-size: 12px; color: var(--gray); }
.bc-status {
  display: inline-flex; align-items: center; gap: 5px;
  font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 100px;
  text-transform: uppercase; letter-spacing: .5px;
}
.bc-status.PENDING   { background: rgba(202,138,113,.15); color: var(--accent); }
.bc-status.CONFIRMED { background: rgba(34,197,94,.15);  color: var(--green);  }
.bc-status.CANCELLED { background: rgba(239,68,68,.15);  color: var(--red);    }
.bc-body { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 16px; }
.bc-field { font-size: 13px; }
.bc-label { color: var(--gray); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 3px; }
.bc-value { color: var(--white); font-weight: 600; }
.bc-notes { font-size: 13px; color: var(--gray); background: rgba(255,255,255,.04); border-radius: 8px; padding: 10px 12px; margin-bottom: 14px; }
.bc-actions { display: flex; gap: 8px; }
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

/* ── Dest picker modal ── */
#destPickerOverlay {
  display: none;
  position: fixed; inset: 0; z-index: 9999;
  background: rgba(0,0,0,.6);
  backdrop-filter: blur(4px);
  align-items: center;
  justify-content: center;
}
#destPickerOverlay.open { display: flex; }
#destPickerBox {
  background: #0d1b38;
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 16px;
  width: 480px;
  max-width: 95vw;
  max-height: 85vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}
#destPickerHeader {
  padding: 20px 24px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
}
#destPickerTitle {
  font-size: 16px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 4px;
}
#destPickerSub {
  font-size: 12px;
  color: #64748b;
}
#destPickerSearch {
  width: 100%;
  margin-top: 12px;
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 8px;
  padding: 9px 14px;
  font-size: 13px;
  color: #fff;
  outline: none;
}
#destPickerSearch::placeholder { color: #64748b; }
#destPickerSearch:focus { border-color: rgba(202,138,113,.5); }
#destPickerList {
  flex: 1;
  overflow-y: auto;
  padding: 8px 12px;
}
.dp-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 12px;
  border-radius: 10px;
  cursor: pointer;
  transition: background .15s;
  user-select: none;
}
.dp-item:hover { background: rgba(255,255,255,.05); }
.dp-item.selected { background: rgba(202,138,113,.12); }
.dp-check {
  width: 18px; height: 18px;
  border: 2px solid rgba(255,255,255,.2);
  border-radius: 5px;
  flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  transition: all .15s;
}
.dp-item.selected .dp-check {
  background: #CA8A71;
  border-color: #CA8A71;
}
.dp-check-icon { display: none; color: #fff; font-size: 11px; font-weight: 700; }
.dp-item.selected .dp-check-icon { display: block; }
.dp-name { font-size: 14px; color: #e2e8f0; font-weight: 500; }
.dp-code { font-size: 11px; color: #64748b; margin-left: auto; }
#destPickerFooter {
  padding: 14px 24px;
  border-top: 1px solid rgba(255,255,255,.08);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
#destPickerCount { font-size: 12px; color: #64748b; }
#destPickerCount strong { color: #CA8A71; }
.dp-btn-cancel {
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.1);
  color: #94a3b8;
  border-radius: 8px;
  padding: 9px 20px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: all .2s;
}
.dp-btn-cancel:hover { background: rgba(255,255,255,.1); color: #fff; }
.dp-btn-save {
  background: #CA8A71;
  border: none;
  color: #fff;
  border-radius: 8px;
  padding: 9px 24px;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
  transition: opacity .2s;
}
.dp-btn-save:hover { opacity: .85; }

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
  background: rgba(255,255,255,.07) !important;
  border: 1px solid rgba(255,255,255,.12) !important;
  border-radius: 12px !important;
  color: white !important;
  padding: 10px 14px !important;
  min-height: 46px !important;
}
.ts-wrapper.focus .ts-control { border-color: var(--accent) !important; box-shadow: none !important; }
/* single select — show cursor pointer, no tag bg */
.ts-wrapper.single .ts-control { cursor: pointer !important; padding-right: 36px !important; }
.ts-wrapper.single .ts-control .item { background: transparent !important; color: white !important; padding: 0 !important; font-weight: 500 !important; font-size: 14px !important; }
.ts-dropdown {
  background: #0b1929 !important;
  border: 1px solid rgba(255,255,255,.15) !important;
  border-radius: 12px !important;
  box-shadow: 0 12px 40px rgba(0,0,0,.7) !important;
  color: white !important;
}
.ts-dropdown .option { color: rgba(255,255,255,.85) !important; padding: 10px 14px !important; }
.ts-dropdown .option:hover, .ts-dropdown .option.active { background: rgba(202,138,113,.14) !important; color: var(--accent) !important; }
.ts-wrapper .item { background: var(--accent) !important; color: var(--navy) !important; border-radius: 6px !important; padding: 3px 10px !important; font-weight: 700 !important; font-size: 12px !important; border: none !important; }
.ts-wrapper .item .remove { color: var(--navy) !important; }
.ts-wrapper input { color: white !important; }
.ts-wrapper input::placeholder { color: #64748b !important; }

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

@media (max-width: 768px) {
  .form-grid, .form-grid.three { grid-template-columns: 1fr; }
  .form-span { grid-column: span 1; }
  .admin-main { padding: 20px 16px; }
}
</style>
</head>
<body>

<!-- ══ LOGIN ══ -->
<div class="login-wrap" id="loginWrap">
  <div class="login-card">
    <div class="login-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Escapii"></div>
    <div class="login-subtitle">Admin Panel — unesite ključ za pristup</div>
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
      <button class="tab-btn" onclick="switchTab('waitlist')">🔔 Lista čekanja <span class="tab-badge" id="waitlistBadge"></span></button>
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
            <label class="field-label">Potencijalne destinacije <span style="color:var(--gray);font-weight:500;">(opciono — vidljivo samo vama)</span></label>
            <select id="fDestinations" multiple placeholder="Pretraži i izaberi destinacije..."></select>
          </div>
        </div>
        <button class="btn-add" onclick="addDate()">Dodaj termin</button>
      </div>

      <!-- Tabela termina -->
      <div class="card">
        <div class="card-title">📋 Svi termini</div>
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
                <th>Status</th>
                <th>Pot. destinacije</th>
                <th>Akcije</th>
              </tr>
            </thead>
            <tbody id="datesBody">
              <tr><td colspan="10" class="empty-state">Učitavanje...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══ REZERVACIJE ══ -->
    <div class="panel" id="panel-bookings">
      <div class="panel-title">Rezervacije</div>
      <div class="panel-subtitle">Pregled svih upita — potvrdi ili otkaži rezervaciju</div>

      <div class="booking-toolbar">
        <input type="text" class="booking-search" id="bookingSearch"
               placeholder="🔍 Pretraži po imenu, emailu, broju rezervacije..."
               oninput="renderBookings()">
        <button class="btn-export" onclick="exportCSV()">📥 Export CSV</button>
      </div>

      <div class="booking-filters">
        <button class="filter-btn" onclick="filterBookings('ALL', this)">Sve</button>
        <button class="filter-btn active" onclick="filterBookings('PENDING', this)">⏳ Na čekanju</button>
        <button class="filter-btn" onclick="filterBookings('CONFIRMED', this)">✅ Potvrđene</button>
        <button class="filter-btn" onclick="filterBookings('CANCELLED', this)">❌ Otkazane</button>
      </div>

      <div class="booking-list" id="bookingList">
        <div class="empty-state">Učitavanje rezervacija...</div>
      </div>
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

    <!-- ══ GREŠKE ══ -->
    <div class="panel" id="panel-errors">
      <div class="panel-title">Log grešaka</div>
      <div class="panel-subtitle">Neočekivane greške aplikacije — ista greška se grupiše, email se šalje samo pri prvoj pojavi</div>
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
      <div class="panel-title">Pregled destinacija</div>
      <div class="panel-subtitle">Sve destinacije u sistemu (aktivne i neaktivne)</div>
      <div class="card">
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Grad</th>
                <th>Zemlja</th>
                <th>IATA</th>
                <th>Aerodrom polaska</th>
                <th>Status</th>
                <th>Akcije</th>
              </tr>
            </thead>
            <tbody id="destBody">
              <tr><td colspan="7" class="empty-state">Učitavanje...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
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
  document.getElementById('pricePopupTitle').textContent = `Cenovnik — ${b.bookingRef}`;
  const rows = [];
  const tr = (label, val) => `<tr><td>${label}</td><td>${val}</td></tr>`;
  rows.push(tr('Osnovna cena', `${b.basePricePerPerson}€/os`));
  if (b.accommodationType === 'SUPERIOR') rows.push(tr('Superior hotel', '+100€/os'));
  if (b.hasBreakfast)       rows.push(tr('Doručak', '+15€/os'));
  if (b.cabinSuitcaseCount > 0) rows.push(tr(`Kofer × ${b.cabinSuitcaseCount}`, `+${50 * b.cabinSuitcaseCount}€/os`));
  if (b.exclusionCostEur > 0)   rows.push(tr(`Isključivanja (${b.exclusionCount}×)`, `+${b.exclusionCostEur}€ flat`));
  if (b.hasInsurance)       rows.push(tr('Osiguranje', '+20€ flat'));
  if (b.hasSeatsTogther)    rows.push(tr('Sedišta zajedno', '+20€/os'));
  rows.push(`<tr class="total"><td><strong>${b.totalPricePerPerson}€/os × ${b.numberOfTravelers}</strong></td><td><strong>${b.totalPriceAll}€</strong></td></tr>`);
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

// ══ DESTINATIONS ══
async function loadDestinations() {
  const r = await fetch(`${API}/api/admin/destinations`, { headers: { 'X-Admin-Key': ADMIN_KEY } });
  ALL_DESTINATIONS = await r.json();
  renderDestTable();
}

function renderDestTable() {
  const tbody = document.getElementById('destBody');
  if (!ALL_DESTINATIONS.length) {
    tbody.innerHTML = '<tr><td colspan="7" class="empty-state">Nema destinacija</td></tr>';
    return;
  }
  tbody.innerHTML = ALL_DESTINATIONS.map(d => {
    const isActive = d.active !== false;
    return `
    <tr style="${isActive ? '' : 'opacity:.55;'}">
      <td><span style="color:var(--gray);font-size:12px;">#${d.id}</span></td>
      <td><strong>${d.name}</strong></td>
      <td>${d.country}</td>
      <td><span class="badge badge-gray">${d.airportCode}</span></td>
      <td>${(d.departureAirports||[]).map(a => `<span class="badge badge-accent">${a}</span>`).join(' ')}</td>
      <td>${isActive ? '<span class="badge badge-green">● Aktivan</span>' : '<span class="badge badge-red">● Neaktivan</span>'}</td>
      <td>
        <button class="btn-action ${isActive ? 'btn-cancel' : 'btn-confirm'}"
                onclick="toggleDestActive(${d.id}, ${isActive})">
          ${isActive ? 'Deaktiviraj' : 'Aktiviraj'}
        </button>
      </td>
    </tr>`;
  }).join('');
}

async function toggleDestActive(id, currentActive) {
  const newValue = !currentActive;
  const dest = ALL_DESTINATIONS.find(d => d.id === id);
  const name = dest ? dest.name : `#${id}`;
  const action = newValue ? 'aktivirati' : 'deaktivirati';

  const confirm = await Swal.fire({
    title: `${newValue ? 'Aktiviraj' : 'Deaktiviraj'} destinaciju?`,
    html: `<span style="color:#94a3b8;">Da li želiš da <strong style="color:white;">${action}</strong> destinaciju <strong style="color:white;">${name}</strong>?</span>`,
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: newValue ? '✓ Aktiviraj' : '✗ Deaktiviraj',
    cancelButtonText: 'Otkaži',
    confirmButtonColor: newValue ? '#22c55e' : '#ef4444',
    cancelButtonColor: '#334155',
    background: '#0d1b38', color: '#fff'
  });
  if (!confirm.isConfirmed) return;

  try {
    const r = await fetch(`${API}/api/admin/destinations/${id}/active?value=${newValue}`, {
      method: 'PATCH',
      headers: { 'X-Admin-Key': ADMIN_KEY }
    });
    if (!r.ok) throw new Error();
    // Ažuriraj lokalno bez re-fetch-a
    const idx = ALL_DESTINATIONS.findIndex(d => d.id === id);
    if (idx !== -1) ALL_DESTINATIONS[idx].active = newValue;
    renderDestTable();
    Swal.fire({
      icon: 'success',
      title: newValue ? 'Destinacija aktivirana' : 'Destinacija deaktivirana',
      text: `${name} je sada ${newValue ? 'aktivna' : 'neaktivna'}.`,
      timer: 2000, showConfirmButton: false,
      background: '#0d1b38', color: '#fff'
    });
  } catch {
    Swal.fire({ icon: 'error', title: 'Greška', text: 'Nije moguće promeniti status.',
      background: '#0d1b38', color: '#fff' });
  }
}

function initDestSelect() {
  const airport = document.getElementById('fAirport').value;
  const filtered = ALL_DESTINATIONS.filter(d =>
    Array.isArray(d.departureAirports) && d.departureAirports.includes(airport)
  );

  if (destTomSelect) { destTomSelect.destroy(); destTomSelect = null; }
  destTomSelect = new TomSelect('#fDestinations', {
    maxItems: 10,
    options: filtered.map(d => ({
      value: String(d.id),
      text: `${d.name} (${d.airportCode})`,
      label: `${d.name}`
    })),
    placeholder: filtered.length
      ? `Pretraži ${airport} destinacije...`
      : 'Nema destinacija za ovaj aerodrom',
    plugins: ['remove_button'],
    render: {
      option: (d) => `<div class="option">${d.text}</div>`,
      item:   (d) => `<div>${d.label}</div>`,
    }
  });
}

// ══ DATES ══
async function loadDates() {
  const r = await fetch(`${API}/api/admin/dates`, {
    headers: { 'X-Admin-Key': ADMIN_KEY },
    cache: 'no-store'
  });
  const dates = await r.json();
  renderDatesTable(dates);
}

function renderDatesTable(dates) {
  const tbody = document.getElementById('datesBody');
  if (!dates.length) {
    tbody.innerHTML = '<tr><td colspan="10" class="empty-state">Nema termina. Dodajte prvi termin iznad.</td></tr>';
    return;
  }
  tbody.innerHTML = dates.map(d => {
    const chips = (d.potentialDestinations || [])
      .map(pd => `<span class="dest-chip">${pd.name}</span>`).join('');
    const destHtml = chips ? `<div class="dest-chips">${chips}</div>` : `<span style="color:var(--gray);font-size:12px;">—</span>`;
    return `
    <tr>
      <td><span style="color:var(--gray);font-size:12px;">#${d.id}</span></td>
      <td><span class="badge badge-accent">${d.departureAirport}</span></td>
      <td><strong>${formatDate(d.departureDate)}</strong></td>
      <td><strong>${formatDate(d.returnDate)}</strong></td>
      <td>${d.numberOfNights}n</td>
      <td>${d.availableSlots}</td>
      <td><strong>${d.basePrice}€</strong></td>
      <td>${d.active ? '<span class="badge badge-green">● Aktivan</span>' : '<span class="badge badge-red">● Neaktivan</span>'}</td>
      <td>${destHtml}</td>
      <td style="white-space:nowrap;">
        <button class="btn-action ${d.active ? 'btn-toggle-off' : 'btn-toggle-on'}"
          onclick="toggleDate(${d.id}, ${!d.active})">
          ${d.active ? 'Deaktiviraj' : 'Aktiviraj'}
        </button>
        <button class="btn-action btn-edit" onclick="editDestinations(${d.id})" style="margin-left:4px;">Destinacije</button>
        <button class="btn-action" onclick="editSlots(${d.id}, ${d.availableSlots})" style="margin-left:4px;background:rgba(99,102,241,.15);color:#a5b4fc;">📋 Mesta (${d.availableSlots})</button>
        <button class="btn-action btn-delete" onclick="deleteDate(${d.id})" style="margin-left:4px;">Obriši</button>
      </td>
    </tr>`;
  }).join('');
}

function formatDate(str) {
  if (!str) return '—';
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
    potentialDestinationIds: destIds
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

// ══ EDIT DESTINATIONS ══
let _dpDateId = null;
let _dpSelected = new Set();
let _dpItems = [];

async function editDestinations(dateId) {
  const r = await fetch(`${API}/api/admin/dates`, { headers: { 'X-Admin-Key': ADMIN_KEY } });
  const dates = await r.json();
  const date = dates.find(d => d.id === dateId);
  if (!date) return;

  _dpDateId = dateId;
  _dpSelected = new Set((date.potentialDestinations || []).map(d => d.id));
  _dpItems = ALL_DESTINATIONS;

  document.getElementById('destPickerTitle').textContent = `Destinacije — termin #${dateId}`;
  document.getElementById('destPickerSub').innerHTML =
    `<strong style="color:#e2e8f0;">${formatDate(date.departureDate)} → ${formatDate(date.returnDate)}</strong>
     &nbsp;<span style="background:rgba(202,138,113,.15);color:#CA8A71;border-radius:5px;padding:1px 7px;font-size:11px;font-weight:700;">${date.departureAirport}</span>`;
  document.getElementById('destPickerSearch').value = '';

  renderDestPickerList('');
  document.getElementById('destPickerOverlay').classList.add('open');
  document.getElementById('destPickerSearch').focus();
}

function renderDestPickerList(query) {
  const q = query.toLowerCase();
  const filtered = q ? _dpItems.filter(d => d.name.toLowerCase().includes(q) || d.airportCode.toLowerCase().includes(q)) : _dpItems;
  const list = document.getElementById('destPickerList');
  list.innerHTML = filtered.map(d => `
    <div class="dp-item ${_dpSelected.has(d.id) ? 'selected' : ''}" onclick="toggleDpItem(${d.id})">
      <div class="dp-check"><span class="dp-check-icon">✓</span></div>
      <div class="dp-name">${d.name}</div>
      <div class="dp-code">${d.airportCode}</div>
    </div>`).join('');
  updateDpCount();
}

function toggleDpItem(id) {
  if (_dpSelected.has(id)) _dpSelected.delete(id);
  else _dpSelected.add(id);
  // Toggle just the clicked element without re-rendering whole list
  const q = document.getElementById('destPickerSearch').value;
  renderDestPickerList(q);
}

function updateDpCount() {
  document.getElementById('destPickerCount').innerHTML =
    `<strong>${_dpSelected.size}</strong> odabrano`;
}

function closeDestPicker() {
  document.getElementById('destPickerOverlay').classList.remove('open');
  _dpDateId = null;
}

async function saveDestPicker() {
  if (!_dpDateId) return;
  const ids = Array.from(_dpSelected);
  console.log('[destPicker] saving dateId=', _dpDateId, 'ids=', ids);
  let res;
  try {
    res = await fetch(`${API}/api/admin/dates/${_dpDateId}/destinations`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json', 'X-Admin-Key': ADMIN_KEY },
      body: JSON.stringify(ids)
    });
  } catch(e) {
    console.error('[destPicker] fetch error:', e);
    Swal.fire({ icon: 'error', title: 'Greška mreže', text: e.message, background: '#0d1b38', color: '#fff' });
    return;
  }
  console.log('[destPicker] response status:', res.status);
  const dateIdSaved = _dpDateId;
  closeDestPicker();
  if (res.ok) {
    await loadDates();
    Swal.fire({ icon: 'success', title: 'Sačuvano!', timer: 1200, showConfirmButton: false, background: '#0d1b38', color: '#fff' });
  } else {
    const errText = await res.text().catch(() => '');
    console.error('[destPicker] error response:', errText);
    Swal.fire({ icon: 'error', title: `Greška ${res.status}`, text: errText || 'Nije uspelo čuvanje.', background: '#0d1b38', color: '#fff' });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('destPickerSearch').addEventListener('input', e => renderDestPickerList(e.target.value));
  document.getElementById('destPickerOverlay').addEventListener('click', e => {
    if (e.target === document.getElementById('destPickerOverlay')) closeDestPicker();
  });
});

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

  await fetch(`${API}/api/admin/dates/${id}`, {
    method: 'DELETE',
    headers: { 'X-Admin-Key': ADMIN_KEY }
  });
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
  if (tab === 'bookings') loadBookings();
  if (tab === 'waitlist') loadWaitlist();
  if (tab === 'errors')   loadErrors();
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
          <td><div class="err-msg" title="${e.message?.replace(/"/g,"'") || ''}">${e.message || '—'}</div></td>
          <td><span class="err-count">${e.count}×</span></td>
          <td class="err-time">${firstSeen}</td>
          <td class="err-time">${e.count > 1 ? lastSeen : '—'}</td>
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
          ${ap}${airportNames[ap] ? ' — ' + airportNames[ap] : ''}
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
  }
}

async function notifyWaitlist(airport) {
  const countEl = document.getElementById('wlCount-' + airport);
  const count   = countEl ? countEl.textContent : '0';

  if (count === '0' || count === '—') {
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
  }
}

function updateBookingBadge() {
  const pending = ALL_BOOKINGS.filter(b => b.status === 'PENDING').length;
  const badge = document.getElementById('bookingsBadge');
  badge.textContent = pending > 0 ? pending : '';
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
      ? new Date(b.departureDate).toLocaleDateString('sr-RS') : '—';
    const retDate = b.returnDate
      ? new Date(b.returnDate).toLocaleDateString('sr-RS') : '—';

    const extras = [
      b.hasInsurance         && '🛡 Osiguranje',
      b.hasBreakfast         && '🍳 Doručak',
      b.hasSeatsTogether     && '💺 Sedišta zajedno',
      b.hasConnectingFlights && '✈✈ Presedanje',
      b.cabinSuitcaseCount > 0 && `🧳 ${b.cabinSuitcaseCount}× kofer`,
      b.excludedDestinations && b.excludedDestinations.length > 0 && `🚫 ${b.excludedDestinations.join(', ')}`,
    ].filter(Boolean).join(' · ') || '—';

    const isConfirmed = b.status === 'CONFIRMED';
    const isCancelled = b.status === 'CANCELLED';
    const isPending   = b.status === 'PENDING';

    const statusLabels = { PENDING: '⏳ Na čekanju', CONFIRMED: '✅ Potvrđena', CANCELLED: '❌ Otkazana' };

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
        <div class="bc-field"><div class="bc-label">Putnici / Smeštaj</div><div class="bc-value">${b.numberOfTravelers}× · ${b.accommodationType}${b.passengerNames && b.passengerNames.length ? '<br><span style="font-size:11px;font-weight:400;color:var(--gray)">' + b.passengerNames.join(', ') + '</span>' : ''}</div></div>
        <div class="bc-field"><div class="bc-label">Cena po osobi</div><div class="bc-value">${b.totalPricePerPerson}€/os <button class="bc-btn-price" onclick='showPriceBreakdown(${JSON.stringify(b).replace(/'/g,"&#39;")})'>💰 detalji</button></div></div>
        <div class="bc-field"><div class="bc-label">Ukupno</div><div class="bc-value" style="color:var(--accent);font-size:16px;">${b.totalPriceAll}€</div></div>
        <div class="bc-field"><div class="bc-label">Dodaci</div><div class="bc-value">${extras}</div></div>
        <div class="bc-field bc-field--full">
          <div class="bc-label">✈ Dodeljena destinacija</div>
          <div class="bc-dest-row">
            <input class="bc-dest-input" id="dest-${b.id}" type="text"
              placeholder="npr. Barcelona"
              value="${b.assignedDestination || ''}"
              onkeydown="if(event.key==='Enter')saveDestination(${b.id})" />
            <button class="bc-note-save" id="dest-btn-${b.id}" onclick="saveDestination(${b.id})" title="Sačuvaj destinaciju (Enter)">✓</button>
          </div>
          <div style="margin-top:6px;">
            <input class="bc-dest-input" id="weather-city-${b.id}" type="text"
              style="width:100%;font-size:11px;opacity:.8;"
              placeholder="🌤 Grad za prognozu (opcionalno) — npr. Santa Cruz de Tenerife, Spain"
              value="${b.weatherCity || ''}"
              onkeydown="if(event.key==='Enter')saveWeatherCity(${b.id})"
              onblur="saveWeatherCity(${b.id})" />
            <div id="weather-city-status-${b.id}" style="font-size:10px;color:var(--gray);margin-top:2px;">
              ${b.weatherCity ? `🌤 Prognoza koristi: <strong>${b.weatherCity}</strong>` : '<span style="opacity:.5;">ako ostaviš prazno, koristi se ime destinacije</span>'}
            </div>
          </div>
          <div style="margin-top:6px;">
            <input class="bc-dest-input" id="airline-code-${b.id}" type="text"
              style="width:100%;font-size:11px;text-transform:uppercase;letter-spacing:1px;"
              placeholder="✈ Airline booking kod za check-in (npr. ABC123)"
              value="${b.airlineBookingCode || ''}"
              onkeydown="if(event.key==='Enter')saveAirlineCode(${b.id})"
              onblur="saveAirlineCode(${b.id})" />
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

      <div class="bc-actions">
        <button class="bc-btn bc-btn-confirm" onclick="changeStatus(${b.id},'CONFIRMED')" ${isConfirmed?'disabled':''}>
          ✅ Potvrdi
        </button>
        <button class="bc-btn bc-btn-cancel" onclick="changeStatus(${b.id},'CANCELLED')" ${isCancelled?'disabled':''}>
          ❌ Otkaži
        </button>
        ${!isPending ? `<button class="bc-btn bc-btn-pending" onclick="changeStatus(${b.id},'PENDING')" >⏳ Vrati na čekanje</button>` : ''}
      </div>
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
  } catch {
    el.style.borderColor = 'var(--red)';
    setTimeout(() => { el.style.borderColor = ''; }, 2000);
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
    if (days > 7) return 'disabled title="Prerano — polazak za ' + days + ' dana (prognoza je pouzdana max 7 dana unapred)"';
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
</script>

<!-- Dest Picker Modal -->
<div id="destPickerOverlay">
  <div id="destPickerBox">
    <div id="destPickerHeader">
      <div id="destPickerTitle">Destinacije</div>
      <div id="destPickerSub"></div>
      <input id="destPickerSearch" type="text" placeholder="Pretraži destinacije...">
    </div>
    <div id="destPickerList"></div>
    <div id="destPickerFooter">
      <div id="destPickerCount"><strong>0</strong> odabrano</div>
      <div style="display:flex;gap:8px;">
        <button class="dp-btn-cancel" onclick="closeDestPicker()">Otkaži</button>
        <button class="dp-btn-save" onclick="saveDestPicker()">Sačuvaj</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
