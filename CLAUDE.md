# Escapii Frontend (WordPress tema) — kontekst za Claude

WordPress custom tema, čist PHP + vanilla JS (bez build koraka, bez npm).
Backend je zaseban repo (Spring Boot) — pun kontekst o backendu, email
sistemu, deploymentu i poznatim rupama je u `CLAUDE.md` **tog** repoa
(`D:\escapii\backend\CLAUDE.md`). Ovaj fajl pokriva samo ono što je
specifično za temu.

**Snimak stanja, ne izvor istine — proveri kod pre nego što poveruješ ovom fajlu.**

## Deploy

Push na `main` = live za par minuta, automatski. Nema ručnog koraka, nema PR toka.

## Ključne stranice

| Fajl | Ruta | Šta radi |
|---|---|---|
| `front-page.php` | `/` | Naslovna + ceo booking wizard (8 koraka) + upit za privatni termin |
| `page-admin-panel.php` | `/admin-panel/` | Kompletan admin panel (X-Admin-Key header, ~4000 linija) |
| `page-poklon.php` | `/poklon/` | Aktivacija/pregled poklon vaučera — radi i sa `?code=` (link iz mejla) i bez (forma za ručni unos) |
| `page-pokloni.php` | `/pokloni-putovanje-iznenadjenja/` | Kupovina poklon vaučera |
| `page-hvala.php` | `/hvala` | Zahvalnica posle rezervacije, boarding-pass prikaz |
| `page-otkrivanje.php` | (magic link) | Reveal stranica — "grebalica" za destinaciju |
| `page-politika-privatnosti.php` / `page-privacy-policy.php` | SR/EN | Politika privatnosti — tabela kolačića mora pratiti stvarno stanje koda |
| `coming-soon.php` | (sve rute, gate) | Privremena "uskoro" stranica — vidi `functions.php` u backend CLAUDE.md |
| `inc/footer.php` | (uključen svuda) | Zajednički futer — SR verzija |
| `inc/subpage-nav.php` | (uključen na podstranicama) | Zajednička navigacija van naslovne |
| `inc/cookie-consent.php` | (uključen preko `wp_footer` hooka) | GDPR banner, ima "mini" varijantu za coming-soon |

`front-page.php` ima svoju kopiju futera i navigacije (ne uključuje `inc/`
verzije) — ako menjaš futer/nav, po pravilu treba izmena na **oba** mesta,
proveri pre push-a.

## Booking wizard — bitne stvari

- 8 koraka, stanje u JS objektu `S` (globalna promenljiva u `front-page.php`)
- **Privatni termin** (`?privateDate=TOKEN` u URL-u): `checkPrivateDateToken()`
  preskače direktno na korak 4, dodaje `.private-mode` klasu na `#esc-booking`.
  Ta klasa CSS-om sakriva karticu "Presedanje" (privatni termin uvek ima
  presedanje prihvaćeno — traži se let za tačan datum, direktan često ne
  postoji) — JS eksplicitno postavlja `S.hasConnectingFlights = true` jer
  sakrivanje kartice samo ne menja vrednost. Backend TAKOĐE forsira ovo
  nezavisno (ne oslanjaj se samo na frontend).
- Nedovršen unos se čuva u `sessionStorage` (`esc_booking_draft`, TTL 4h) —
  namerna funkcionalnost, ne bag, da se ne izgubi popunjena forma pri
  slučajnom osvežavanju stranice
- Validacija telefona/emaila na klijentu MORA pratiti backend `@Pattern` pravila
  (`BookingRequest.java`) — desio se bag gde je klijent puštao zarez u telefon
  (samo `length>5` provera), backend ga odbijao, i korisnik video generičko
  "nešto nije u redu" umesto konkretne poruke. Ako menjaš validaciju na jednoj
  strani, proveri i drugu.
- Greške sa backenda stižu kao `{"error": "poruka"}` — čitaj `err.error`, NE
  `err.message` (ovaj drugi ne postoji, desilo se da 11+ mesta u admin panelu
  čita pogrešan ključ i prikazuje golo "HTTP 409" umesto stvarnog razloga)

## Admin panel — obrasci

- Autentifikacija: `X-Admin-Key` header na svaki `/api/admin/*` poziv (ključ
  u `localStorage` posle unosa)
- Greške: koristi `apiError(response)` helper (čita `error` pa `message` pa
  fallback) — NE `throw new Error()` bez poruke, NE ručno parsiranje
- Rate limit na `/api/admin/*`: 150 zahteva/minut (podignut sa 20 jer jedna
  akcija u panelu često okine 2+ poziva, a samo otvaranje panela ih šalje 7+)

## Kolačići / GDPR

Banner (`inc/cookie-consent.php`) ima punu i "mini" varijantu (`.esc-cc--mini`,
uključena preko `ESC_IS_COMING_SOON` konstante) — mini verzija sakriva link ka
politici privatnosti jer taj link ne radi dok je coming-soon gate aktivan
(interni linkovi su presretnuti, vidi backend CLAUDE.md). Ne diraj ovu logiku
bez razumevanja gate-a.

## Kontakt adrese na sajtu

- **`info@escapii.rs`** — javna kontakt adresa, svuda u futerima, politikama,
  formama. NE `hello@escapii.rs` (stara, ne postoji, popravljeno svuda gde je
  nađeno)
- Facebook link u oba futera (`front-page.php` + `inc/footer.php`) — bio je
  `href="#"` mrtav, sad vodi na pravu stranicu

## Poznate stvari koje NISU bag

- `.dg-*` klase, mnoge `data-i18n` ključevi bez upotrebe na nekim stranicama —
  ostaci od ranijih iteracija, generalno bezopasni
- Futer se razlikuje malo između `front-page.php` i `inc/footer.php` (npr.
  "Kolačići" link) — dosledno je popravljano na oba, ali proveri oba kad
  dodaješ nešto u futer
