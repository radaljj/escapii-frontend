<?php if (!defined('ESC_STATUS_MODAL_LOADED')) { define('ESC_STATUS_MODAL_LOADED', true); ?>
<style>
/* ── STATUS MODAL ─────────────────────────────────────────────────────────── */
.status-modal-overlay {
  display: none; position: fixed; inset: 0; z-index: 2000;
  background: rgba(0,0,0,.65); backdrop-filter: blur(4px);
  align-items: flex-start; justify-content: center; padding: 20px;
  overflow-y: auto;
}
.status-modal-overlay.open { display: flex; }
.status-modal-card {
  position: relative; background: #0f2d35; border: 1px solid rgba(255,255,255,.08);
  border-radius: 20px; padding: 36px 32px 32px; width: 100%; max-width: 420px;
  box-shadow: 0 24px 64px rgba(0,0,0,.5);
  animation: esc-modalIn .22s cubic-bezier(.34,1.56,.64,1);
  margin: auto;
}
@keyframes esc-modalIn { from { opacity:0; transform:scale(.94) translateY(12px); } to { opacity:1; transform:none; } }
.status-modal-close {
  position: absolute; top: 14px; right: 16px; background: none; border: none;
  color: #7A9FA8; font-size: 18px; cursor: pointer; line-height: 1;
  padding: 4px 8px; border-radius: 6px; transition: color .15s;
}
.status-modal-close:hover { color: #fff; }
.status-modal-icon { font-size: 32px; margin-bottom: 12px; }
.status-modal-title { font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 6px; }
.status-modal-sub { font-size: 13px; color: #7A9FA8; margin-bottom: 24px; line-height: 1.5; }
.status-modal-form { display: flex; flex-direction: column; gap: 14px; }
.status-field { display: flex; flex-direction: column; gap: 6px; }
.status-field label { font-size: 12px; font-weight: 700; color: #7A9FA8; text-transform: uppercase; letter-spacing: .5px; }
.status-field input {
  background: rgba(255,255,255,.06); border: 1.5px solid rgba(255,255,255,.1);
  border-radius: 10px; padding: 11px 14px; color: #fff; font-size: 15px;
  font-family: inherit; outline: none; transition: border-color .2s;
}
.status-field input:focus { border-color: #CA8A71; }
.status-modal-btn {
  background: #CA8A71; border: none; border-radius: 12px; padding: 13px;
  color: #fff; font-size: 15px; font-weight: 800; font-family: inherit;
  cursor: pointer; transition: opacity .2s; margin-top: 4px;
}
.status-modal-btn:hover { opacity: .88; }
.status-modal-btn:disabled { opacity: .5; cursor: not-allowed; }
.status-error { font-size: 13px; color: #f87171; text-align: center; padding: 4px 0; }
.status-result {
  margin-top: 24px; border-top: 1px solid rgba(255,255,255,.08);
  padding-top: 20px; display: flex; flex-direction: column; gap: 14px;
}
.sr-badge {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 6px 14px; border-radius: 100px; font-size: 13px; font-weight: 700;
}
.sr-badge.PENDING   { background: rgba(202,138,113,.15); color: #CA8A71; }
.sr-badge.CONFIRMED { background: rgba(34,197,94,.15);  color: #22c55e; }
.sr-badge.CANCELLED { background: rgba(239,68,68,.15);  color: #f87171; }
.sr-badge.COMPLETED { background: rgba(99,102,241,.15); color: #818cf8; }
.sr-label  { font-size: 10px; color: #7A9FA8; text-transform: uppercase; letter-spacing: .6px; margin-bottom: 3px; }
.sr-name   { font-size: 17px; font-weight: 800; color: #fff; }
.sr-ref    { font-size: 12px; color: #7A9FA8; }
.sr-info   { display: flex; flex-direction: column; gap: 6px; }
.sr-row    { display: flex; justify-content: space-between; font-size: 13px; }
.sr-row-label { color: #7A9FA8; }
.sr-row-val   { color: #fff; font-weight: 600; }
.sr-row-passengers { align-items: flex-start; }
.sr-passengers { font-size: 11px; font-weight: 500; line-height: 1.7; text-align: right; }
.sr-msg    { font-size: 13px; color: #7A9FA8; line-height: 1.5; border-left: 3px solid; padding-left: 10px; }
.sr-msg.PENDING   { border-color: #CA8A71; }
.sr-msg.CONFIRMED { border-color: #22c55e; }
.sr-msg.CANCELLED { border-color: #f87171; }
.sr-msg.COMPLETED { border-color: #818cf8; }
.sr-countdown {
  display: flex; align-items: center; gap: 10px;
  background: rgba(34,197,94,.08); border: 1px solid rgba(34,197,94,.2);
  border-radius: 12px; padding: 12px 14px;
}
.sr-countdown-num { font-size: 28px; font-weight: 900; color: #22c55e; line-height: 1; }
.sr-countdown-label { font-size: 12px; color: #7A9FA8; line-height: 1.4; }
.sr-countdown-label strong { display: block; font-size: 13px; color: #fff; }
@keyframes sr-fly {
  0%   { transform: translateX(-40px) translateY(4px); opacity: 0; }
  60%  { opacity: 1; }
  100% { transform: translateX(0) translateY(0); opacity: 1; }
}
.sr-plane-anim { font-size: 26px; display: inline-block; animation: sr-fly .55s cubic-bezier(.34,1.2,.64,1) forwards; }
</style>

<div id="statusModal" class="status-modal-overlay" onclick="if(event.target===this)closeStatusModal()">
  <div class="status-modal-card">
    <button class="status-modal-close" onclick="closeStatusModal()" aria-label="Zatvori">✕</button>
    <div class="status-modal-icon">🔍</div>
    <h3 class="status-modal-title">Proveri status rezervacije</h3>
    <p class="status-modal-sub">Unesite broj rezervacije i prezime nosioca rezervacije.</p>
    <div class="status-modal-form">
      <div class="status-field">
        <label>Broj rezervacije</label>
        <input id="statusRef" type="text" placeholder="ESC-xxxxxxxx" autocomplete="off"
               onkeydown="if(event.key==='Enter')checkStatus()">
      </div>
      <div class="status-field">
        <label>Prezime</label>
        <input id="statusSurname" type="text" placeholder="Marković" autocomplete="off"
               onkeydown="if(event.key==='Enter')checkStatus()">
      </div>
      <button class="status-modal-btn" id="statusBtn" onclick="checkStatus()">
        <span>Proveri →</span>
      </button>
      <div id="statusError" class="status-error" style="display:none"></div>
    </div>
    <div id="statusResult" class="status-result" style="display:none"></div>
  </div>
</div>

<script>
(function() {
  var _STATUS_API = '<?php echo esc_js(escapii_api_url()); ?>';
  var _lang = function() { return (typeof lang !== 'undefined' ? lang : null) || localStorage.getItem('esc-lang') || 'sr'; };

  window.openStatusModal = function() {
    document.getElementById('statusModal').classList.add('open');
    setTimeout(function(){ document.getElementById('statusRef').focus(); }, 50);
  };
  window.closeStatusModal = function() {
    document.getElementById('statusModal').classList.remove('open');
    document.getElementById('statusResult').style.display = 'none';
    document.getElementById('statusError').style.display  = 'none';
    document.getElementById('statusRef').value     = '';
    document.getElementById('statusSurname').value = '';
  };
  window.checkStatus = async function() {
    var ref     = document.getElementById('statusRef').value.trim().toUpperCase();
    var surname = document.getElementById('statusSurname').value.trim();
    var errEl   = document.getElementById('statusError');
    var resEl   = document.getElementById('statusResult');
    var btn     = document.getElementById('statusBtn');
    var isSr    = _lang() === 'sr';

    errEl.style.display = 'none';
    resEl.style.display = 'none';

    if (!ref || !surname) {
      errEl.textContent = isSr ? 'Unesite broj rezervacije i prezime.' : 'Please enter your booking ref and surname.';
      errEl.style.display = 'block';
      return;
    }

    btn.disabled = true;
    btn.querySelector('span').textContent = '...';

    try {
      var r = await fetch(_STATUS_API + '/api/booking/status?ref=' + encodeURIComponent(ref) + '&lastName=' + encodeURIComponent(surname));
      if (r.status === 404) {
        errEl.textContent = isSr
          ? 'Rezervacija nije pronađena. Proverite broj rezervacije i prezime.'
          : 'Reservation not found. Please check your booking ref and surname.';
        errEl.style.display = 'block';
        return;
      }
      if (!r.ok) throw new Error('server error');
      var d = await r.json();

      var statusLabels = isSr ? { PENDING:'⏳ Na čekanju', CONFIRMED:'✅ Potvrđeno', CANCELLED:'❌ Otkazano', COMPLETED:'🎉 Završeno' }
                               : { PENDING:'⏳ Pending',   CONFIRMED:'✅ Confirmed',  CANCELLED:'❌ Cancelled',  COMPLETED:'🎉 Completed' };
      var statusMsgs = isSr ? {
        PENDING:   'Vaš upit je primljen. Kontaktiraćemo vas u roku od 24h sa detaljima za plaćanje.',
        CONFIRMED: 'Rezervacija potvrđena! Vaše iznenađenje putovanje je osigurano.',
        CANCELLED: 'Ova rezervacija je otkazana. Kontaktirajte nas ukoliko smatrate da je ovo greška.',
        COMPLETED: 'Putovanje je završeno. Nadamo se da je bilo nezaboravno! 🌍',
      } : {
        PENDING:   'Your inquiry has been received. We will contact you within 24h with payment details.',
        CONFIRMED: 'Booking confirmed! Your surprise trip is secured.',
        CANCELLED: 'This booking has been cancelled. Contact us if you think this is a mistake.',
        COMPLETED: 'Your trip is complete. We hope it was unforgettable! 🌍',
      };
      var lbl = isSr ? {
        leadTraveler:'Nosilac rezervacije', depAirport:'Aerodrom polaska',
        travelDates:'Datumi putovanja', travelers:'Putnici', names:'Imena',
        daysLeft:'dana do polaska', tripSoon:'Polazak uskoro!', departed:'Trenutno na putu ✈',
      } : {
        leadTraveler:'Lead traveler', depAirport:'Departure airport',
        travelDates:'Travel dates', travelers:'Travelers', names:'Names',
        daysLeft:'days until departure', tripSoon:'Departing soon!', departed:'Currently travelling ✈',
      };

      var airportNames = { BEG:'Beograd (BEG)', INI:'Niš (INI)', ZAG:'Zagreb (ZAG)', BUD:'Budimpešta (BUD)', TIM:'Timișoara (TIM)' };
      var loc = isSr ? 'sr-Latn-RS' : 'en-GB';
      var depStr = new Date(d.departureDate).toLocaleDateString(loc, {day:'numeric',month:'short',year:'numeric'});
      var retStr = new Date(d.returnDate).toLocaleDateString(loc, {day:'numeric',month:'short',year:'numeric'});

      var today   = new Date(); today.setHours(0,0,0,0);
      var depDate = new Date(d.departureDate); depDate.setHours(0,0,0,0);
      var retDate = new Date(d.returnDate);    retDate.setHours(0,0,0,0);
      var daysLeft = Math.round((depDate - today) / 86400000);
      var onTrip   = today >= depDate && today <= retDate;

      var countdownHtml = '';
      if (d.status === 'CONFIRMED') {
        if (onTrip) {
          countdownHtml = '<div class="sr-countdown"><span style="font-size:28px;">✈️</span><div class="sr-countdown-label"><strong>' + lbl.departed + '</strong>' + depStr + ' → ' + retStr + '</div></div>';
        } else if (daysLeft > 0) {
          var planeAnim = daysLeft <= 7 ? '<span class="sr-plane-anim">✈️</span>' : '✈️';
          countdownHtml = '<div class="sr-countdown">' + planeAnim + '<div class="sr-countdown-num">' + daysLeft + '</div><div class="sr-countdown-label"><strong>' + (daysLeft === 1 ? (isSr ? 'dan do polaska!' : 'day until departure!') : lbl.daysLeft) + '</strong>' + (daysLeft <= 7 ? lbl.tripSoon : '') + '</div></div>';
        }
      }

      resEl.innerHTML =
        '<div>' +
          '<div class="sr-label">' + lbl.leadTraveler + '</div>' +
          '<div class="sr-name">' + d.firstName + (d.lastName ? ' ' + d.lastName : '') + '</div>' +
          '<div class="sr-ref">' + d.bookingRef + '</div>' +
        '</div>' +
        '<span class="sr-badge ' + d.status + '">' + (statusLabels[d.status] || d.status) + '</span>' +
        countdownHtml +
        '<div class="sr-info">' +
          '<div class="sr-row"><span class="sr-row-label">' + lbl.depAirport + '</span><span class="sr-row-val">' + (airportNames[d.departureAirport] || d.departureAirport) + '</span></div>' +
          '<div class="sr-row"><span class="sr-row-label">' + lbl.travelDates + '</span><span class="sr-row-val">' + depStr + ' → ' + retStr + '</span></div>' +
          '<div class="sr-row"><span class="sr-row-label">' + lbl.travelers + '</span><span class="sr-row-val">' + d.numberOfTravelers + '</span></div>' +
          (d.passengerNames && d.passengerNames.length ? '<div class="sr-row sr-row-passengers"><span class="sr-row-label">' + lbl.names + '</span><span class="sr-row-val sr-passengers">' + d.passengerNames.join('<br>') + '</span></div>' : '') +
        '</div>' +
        '<div class="sr-msg ' + d.status + '">' + (statusMsgs[d.status] || '') + '</div>';

      resEl.style.display = 'flex';
    } catch(e) {
      errEl.textContent = isSr ? 'Greška. Pokušaj ponovo.' : 'Error. Please try again.';
      errEl.style.display = 'block';
    } finally {
      btn.disabled = false;
      btn.querySelector('span').textContent = isSr ? 'Proveri →' : 'Check →';
    }
  };
})();
</script>
<?php } ?>
