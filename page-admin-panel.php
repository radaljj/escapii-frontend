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
  --accent: #f97316;
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
  background: radial-gradient(ellipse at 30% 40%, rgba(249,115,22,.12) 0%, transparent 60%),
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
  font-size: 28px;
  font-weight: 900;
  letter-spacing: -1px;
  margin-bottom: 8px;
}
.login-logo span { color: var(--accent); }
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
.admin-logo { font-size: 20px; font-weight: 900; letter-spacing: -1px; }
.admin-logo span { color: var(--accent); }
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
.booking-filters { display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap; }
.filter-btn {
  padding: 6px 16px; border-radius: 100px; border: 1px solid rgba(255,255,255,.12);
  background: transparent; color: var(--gray); font-size: 13px; font-weight: 600;
  cursor: pointer; transition: all .2s;
}
.filter-btn.active, .filter-btn:hover { background: var(--accent); border-color: var(--accent); color: var(--navy); }
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
.bc-status.PENDING   { background: rgba(249,115,22,.15); color: var(--accent); }
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
.bc-btn-pending { background: rgba(249,115,22,.15); color: var(--accent); border: 1px solid rgba(249,115,22,.3); }
.bc-btn-pending:not(:disabled):hover { background: var(--accent); color: var(--navy); }
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
.badge-accent { background: rgba(249,115,22,.12); color: var(--accent); }

.dest-chips { display: flex; flex-wrap: wrap; gap: 5px; }
.dest-chip {
  background: rgba(249,115,22,.12);
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
.btn-toggle-off { background: rgba(249,115,22,.15); color: var(--accent); }
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
.ts-dropdown .option:hover, .ts-dropdown .option.active { background: rgba(249,115,22,.14) !important; color: var(--accent) !important; }
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
.flatpickr-day:hover { background: rgba(249,115,22,.2) !important; }
.flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange { background: var(--accent) !important; border-color: var(--accent) !important; color: var(--navy) !important; }
.flatpickr-day.inRange { background: rgba(249,115,22,.15) !important; border-color: transparent !important; }
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
.swal2-confirm { background: var(--accent) !important; color: var(--navy) !important; border-radius: 10px !important; font-weight: 700 !important; }
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
    <div class="login-logo">Escap<span>ii</span></div>
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

<!-- ══ ADMIN PANEL ══ -->
<div class="admin-wrap" id="adminWrap">
  <header class="admin-header">
    <div class="admin-logo">Escap<span>ii</span> <small>Admin</small></div>
    <button class="btn-logout" onclick="doLogout()">Odjavi se</button>
  </header>

  <main class="admin-main">
    <div class="tabs">
      <button class="tab-btn active" onclick="switchTab('dates')">📅 Termini</button>
      <button class="tab-btn" onclick="switchTab('bookings')">📋 Rezervacije <span class="tab-badge" id="bookingsBadge"></span></button>
      <button class="tab-btn" onclick="switchTab('destinations')">✈️ Destinacije</button>
      <button class="tab-btn" onclick="switchTab('waitlist')">🔔 Lista čekanja <span class="tab-badge" id="waitlistBadge"></span></button>
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
            <label class="field-label">Datum povratka <span class="req">*</span></label>
            <input type="text" class="form-input" id="fReturn" placeholder="Izaberi datum...">
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
const API  = 'https://escapii-backend.onrender.com';
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

function doLogout() {
  ADMIN_KEY = '';
  location.reload();
}

// ══ INIT ══
let airportTs = null;
let nightsTs  = null;

async function initAdmin() {
  await Promise.all([loadDestinations(), loadDates(), loadBookings(), loadWaitlist()]);

  airportTs = new TomSelect('#fAirport', {
    create: false, allowEmptyOption: false, controlInput: null,
    onChange() { initDestSelect(); }
  });

  nightsTs = new TomSelect('#fNights', {
    create: false, allowEmptyOption: false, controlInput: null
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
  const r = await fetch(`${API}/api/admin/dates`, { headers: { 'X-Admin-Key': ADMIN_KEY } });
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
  const retDate  = document.getElementById('fReturn')._flatpickr?.selectedDates[0];
  const slots    = parseInt(document.getElementById('fSlots').value);
  const price    = parseInt(document.getElementById('fPrice').value);
  const destIds  = destTomSelect ? destTomSelect.getValue().map(Number) : [];

  if (!depDate || !retDate) {
    Swal.fire({ icon: 'warning', title: 'Nedostaju datumi', text: 'Izaberite datum polaska i povratka.', confirmButtonText: 'OK' });
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
  document.getElementById('fReturn')._flatpickr?.clear();
  document.getElementById('fSlots').value = 50;
  document.getElementById('fPrice').value = 279;
  if (destTomSelect) destTomSelect.clear();
}

// ══ EDIT DESTINATIONS ══
async function editDestinations(dateId) {
  const r = await fetch(`${API}/api/admin/dates`, { headers: { 'X-Admin-Key': ADMIN_KEY } });
  const dates = await r.json();
  const date = dates.find(d => d.id === dateId);
  if (!date) return;

  const currentIds = (date.potentialDestinations || []).map(d => String(d.id));
  const filteredForAirport = ALL_DESTINATIONS.filter(d =>
    Array.isArray(d.departureAirports) && d.departureAirports.includes(date.departureAirport)
  );
  const options = filteredForAirport.map(d =>
    `<option value="${d.id}" ${currentIds.includes(String(d.id)) ? 'selected' : ''}>${d.name} (${d.airportCode})</option>`
  ).join('');

  const { value: formValues } = await Swal.fire({
    title: `Destinacije — termin #${dateId}`,
    html: `
      <div style="text-align:left;margin-bottom:8px;font-size:13px;color:#94a3b8;">
        Termin: <strong style="color:white;">${formatDate(date.departureDate)} → ${formatDate(date.returnDate)}</strong> | ${date.departureAirport}
      </div>
      <select id="swalDestSelect" multiple style="width:100%;min-height:200px;background:#0d1b38;color:white;border:1px solid rgba(255,255,255,.15);border-radius:10px;padding:8px;">
        ${options}
      </select>`,
    confirmButtonText: 'Sačuvaj',
    cancelButtonText: 'Otkaži',
    showCancelButton: true,
    preConfirm: () => {
      const sel = document.getElementById('swalDestSelect');
      return Array.from(sel.selectedOptions).map(o => parseInt(o.value));
    }
  });

  if (formValues !== undefined) {
    await fetch(`${API}/api/admin/dates/${dateId}/destinations`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json', 'X-Admin-Key': ADMIN_KEY },
      body: JSON.stringify(formValues)
    });
    Swal.fire({ icon: 'success', title: 'Sačuvano!', confirmButtonText: 'OK', timer: 1500 });
    loadDates();
  }
}

// ══ EDIT SLOTS ══
async function editSlots(id, currentSlots) {
  const { value, isConfirmed } = await Swal.fire({
    title: 'Izmeni broj mesta',
    html: `
      <div style="margin-bottom:8px;color:#94a3b8;font-size:14px;">Trenutno: <strong style="color:#f97316;">${currentSlots} mesta</strong></div>
      <input id="swal-slots" type="number" min="0" max="9999" value="${currentSlots}"
        class="swal2-input" style="width:140px;text-align:center;font-size:22px;font-weight:700;">
    `,
    confirmButtonText: 'Sačuvaj',
    confirmButtonColor: '#f97316',
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
function initFlatpickr() {
  const depPicker = flatpickr('#fDeparture', {
    locale: 'sr',
    dateFormat: 'd.m.Y',
    minDate: 'today',
    onChange([date]) {
      retPicker.set('minDate', date);
    }
  });
  const retPicker = flatpickr('#fReturn', {
    locale: 'sr',
    dateFormat: 'd.m.Y',
    minDate: 'today'
  });
  document.getElementById('fDeparture')._flatpickr = depPicker;
  document.getElementById('fReturn')._flatpickr = retPicker;
}

// ══ TABS ══
function switchTab(tab) {
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('panel-' + tab).classList.add('active');
  event.currentTarget.classList.add('active');
  if (tab === 'bookings') loadBookings();
  if (tab === 'waitlist') loadWaitlist();
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
    confirmButtonColor: '#f97316',
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

function renderBookings() {
  const list = document.getElementById('bookingList');
  const filtered = activeFilter === 'ALL'
    ? ALL_BOOKINGS
    : ALL_BOOKINGS.filter(b => b.status === activeFilter);

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
      b.hasInsurance    && '🛡 Osiguranje',
      b.hasBreakfast    && '🍳 Doručak',
      b.hasSeatsTogther && '💺 Sedišta zajedno',
      b.cabinSuitcaseCount > 0 && `🧳 ${b.cabinSuitcaseCount}× kofer`,
      b.exclusionCount  > 0 && `🚫 ${b.exclusionCount}× isključivanje`,
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
        <div class="bc-field"><div class="bc-label">Ime i prezime</div><div class="bc-value">${b.fullName}</div></div>
        <div class="bc-field"><div class="bc-label">Email</div><div class="bc-value">${b.email}</div></div>
        <div class="bc-field"><div class="bc-label">Telefon</div><div class="bc-value">${b.phone}</div></div>
        <div class="bc-field"><div class="bc-label">Aerodrom</div><div class="bc-value">✈ ${b.departureAirport}</div></div>
        <div class="bc-field"><div class="bc-label">Termin</div><div class="bc-value">${depDate} → ${retDate}</div></div>
        <div class="bc-field"><div class="bc-label">Putnici / Smeštaj</div><div class="bc-value">${b.numberOfTravelers}× · ${b.accommodationType}</div></div>
        <div class="bc-field"><div class="bc-label">Cena po osobi</div><div class="bc-value">${b.totalPricePerPerson}€/os</div></div>
        <div class="bc-field"><div class="bc-label">Ukupno</div><div class="bc-value" style="color:var(--accent);font-size:16px;">${b.totalPriceAll}€</div></div>
        <div class="bc-field"><div class="bc-label">Dodaci</div><div class="bc-value">${extras}</div></div>
      </div>

      ${b.notes ? `<div class="bc-notes">💬 <em>${b.notes}</em></div>` : ''}

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

async function changeStatus(id, status) {
  const labels = { CONFIRMED: 'potvrditi', CANCELLED: 'otkazati', PENDING: 'vratiti na čekanje' };
  const icons  = { CONFIRMED: '✅', CANCELLED: '❌', PENDING: '⏳' };
  const colors = { CONFIRMED: '#22c55e', CANCELLED: '#ef4444', PENDING: '#f97316' };

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
    if (idx > -1) ALL_BOOKINGS[idx] = updated;

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
</body>
</html>
