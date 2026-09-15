# suryateja.pro — project memory

> Personal site for Suryateja Manchikatla. Static HTML + PHP contact
> handler. Deployed to **Hostinger shared hosting** via git pull.

---

## What this project is

- Personal landing page at `https://suryateja.pro`.
- Sections: Hero, About, Ventures, Stack, Services, Contact, Footer.
  Plus a `/now/` page.
- Single page; no blog, no CMS, no multi-page nav. Out of scope.

## Stack — current (Hostinger)

- **Frontend**: vanilla HTML / CSS / minimal JS. No bundler.
  **Plus Jakarta Sans** (Google Fonts) everywhere — headings 700/800 with
  tight tracking, body 400/500. Matches tarkashila.com. (The old "no webfonts /
  editorial serif" rule was dropped 2026-09-16 in the Tarkashila rebrand.)
- **Backend**: a single `contact.php` for the form. Uses PHP's `mail()`
  to deliver to `emailsuryateja.m@gmail.com`. Stores every submission as
  a JSON line in `data/contact_submissions.jsonl`. File-based rate
  limit + honeypot.
- **Hosting**: Hostinger shared (PHP 8.2). Apache / LiteSpeed. No
  Docker, no Node.js, no nginx — `.htaccess` does the security headers,
  redirects, and access denies.
- **DNS / TLS**: Hostinger DNS + Hostinger's free SSL (or Cloudflare
  proxied in front, if/when added).
- **Deploy**: Hostinger's hPanel → Git → pulls `main` from
  `https://github.com/vyomaaistudio/suryateja.pro` into
  `public_html/`. Repo root IS public_html.

## Repo layout — multi-page

```
/                       # repo root = Hostinger public_html
├── index.php           # / — home (hero + asymmetric tile grid)
├── about/
│   └── index.php       # /about/
├── ventures/
│   └── index.php       # /ventures/
├── stack/
│   └── index.php       # /stack/
├── services/
│   └── index.php       # /services/
├── contact/
│   └── index.php       # /contact/  (form lives here)
├── now/
│   └── index.php       # /now/      (converted from .html)
├── api/
│   └── contact.php     # POST endpoint for the contact form
├── _partials/          # shared chrome — .htaccess-blocked
│   ├── head.php        # <head> + open <body> + skip link
│   ├── header.php      # site header + nav + aria-current
│   └── footer.php      # site footer + closing tags + main.js
├── .htaccess           # redirects, security headers, deny rules
├── assets/
│   ├── styles.css
│   ├── main.js         # form fetch points at /api/contact.php
│   ├── portrait.jpg
│   └── favicon.svg
├── robots.txt
├── sitemap.xml         # lists all 7 routes
├── data/               # runtime — gitignored, .htaccess-blocked
│   ├── contact_submissions.jsonl   (created on first submission)
│   └── ratelimit.json              (created on first submission)
├── CLAUDE.md           # this file — .htaccess-blocked
└── _vps/               # archived Node/Docker stack, kept for future
    ├── server.js
    ├── package.json
    ├── Dockerfile
    ├── docker-compose.yml
    ├── deploy.sh
    ├── nginx.vhost.example.conf
    ├── .env.example
    ├── .dockerignore
    └── MIGRATION.md
```

`_vps/` and `_partials/` are both denied via `.htaccess` so they never
serve over the web — `_partials/` is server-side only (included by
every page), `_vps/` is preserved for the future.

### How a page is built

Every page sets a handful of variables (title, description, canonical,
optional JSON-LD) then includes the three partials in order:

```php
<?php
$page_title       = 'About — Suryateja Manchikatla';
$page_description = '…';
$page_canonical   = 'https://suryateja.pro/about/';
$current_page     = 'about';    // drives aria-current on the nav

include $_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php';
?>
<main id="main"> … page content … </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
```

That's the DRY contract. To add a new top-level page: create
`<slug>/index.php`, set the four variables, write the `<main>`, add the
slug to `_partials/header.php`'s `$nav_items` array, and add it to
`sitemap.xml`.

## Positioning rules — DO NOT DEVIATE

**BRAND: the company is Tarkashila (Tarkashila Private Limited, Hyderabad,
EST. 2025). "Vyoma AI Studios / Vyomai Studios" is DROPPED — never mention it
anywhere.** Site is in sync with tarkashila.com (rebrand 2026-09-16).

Source of truth for how I'm described on this site:

- Identity word: **Founder** — "Founder of Tarkashila". This is now correct:
  Tarkashila Private Limited is registered. (The old rule reserving "Founder"
  was tied to Vyomai Studios, which no longer exists.)
- pdfonweb and leaselylite are **Tarkashila products** — the studio designs,
  builds, AND runs its own products ("we build software, we also run it").
- For Scholar Africa: "part of the team building" — not founder.
- For Karibu: CRM & automation lead / partner — data and reporting. Don't
  claim I run their socials.
- Hero eyebrow format: "FOUNDER, TARKASHILA · HYDERABAD & EAST AFRICA".
- Geography: Hyderabad, India & East Africa (products shipped across India,
  Kenya, Tanzania). (Old site said "Arusha, Tanzania" only — superseded.)
- Don't stack tool names (n8n, WordPress) as identity. Tools are stack
  details, not positioning.
- No marketing copy that promises outcomes ("we'll help you win",
  "guaranteed results"). Describe process, not promised results.

## Deploy — Hostinger git pull

One-time setup in hPanel:

1. hPanel → Advanced → **Git** → Create repository.
2. Repository address: `https://github.com/vyomaaistudio/suryateja.pro`
3. Branch: `main`
4. Install path: `/public_html` (so repo root maps to public_html).
5. After first deploy, set up the auto-deploy webhook URL in the
   GitHub repo (Settings → Webhooks → add the URL hPanel shows).

After that, **every push to `main` deploys automatically**.

**One-time Hostinger cleanup (do this BEFORE or RIGHT AFTER the first
git pull):**

The old PHP site left files in `public_html/` that are NOT in this repo
and won't be removed by `git pull`. Delete via hPanel File Manager or
SSH:

```
default.php
header.php
index.php           (old typed-text PHP — the new index.html replaces it)
script.js
style.css
test
Images/
form_submissions.txt   ← CRITICAL: contains 347 KB of third-party PII,
                          publicly accessible right now.
```

If `index.php` is not deleted, Apache's `DirectoryIndex` should still
prefer the new `index.html` (per the `.htaccess` here), but having both
present is confusing — delete it.

## Env vars

None required for the current PHP setup. The mail destination,
sender, and rate-limit values are hard-coded at the top of
`contact.php`. (The `.env`-based Express setup is preserved under
`_vps/` for the future.)

## Routes

| Path | File | Purpose |
|---|---|---|
| `/` | `index.php` | Home — hero + asymmetric tile preview grid |
| `/about/` | `about/index.php` | Three paragraphs about Surya, closing line |
| `/ventures/` | `ventures/index.php` | 4 venture cards (pdfonweb, leaselylite, Karibu, Scholar Africa) |
| `/stack/` | `stack/index.php` | 5 category lists (Engineering, Infra, Ops, AI, SEO) |
| `/services/` | `services/index.php` | 3 service cards + side-engagements disclaimer |
| `/contact/` | `contact/index.php` | Form + social links |
| `/now/` | `now/index.php` | What I'm focused on this month |
| `/sitemap.xml`, `/robots.txt` | static | |
| `POST /api/contact.php` | `api/contact.php` | JSON `{ name, email, message, company }` (company is honeypot). Rate-limited to 5 / 10 min per IP. |

## Visual treatment — locked (Tarkashila, 2026-09-16)

In sync with tarkashila.com. Tokens live in `assets/styles.css :root`.

- **Light theme.** `--bg: #ffffff`, warm surface `--surface: #f7f6f4`,
  ink text `--text: #0a0908` / muted `#3d3b38` / dim `#9a9691`.
- **Accent: gold `--accent: #c19a28`** (hover `#a2801d` — darker on light).
  Secondary green `#5b8c4a`. Single accent, no gradients-as-decoration.
- **Plus Jakarta Sans** everywhere (Google Fonts). Headings 700/800, tight
  tracking (h1 −0.03em). Body 16px.
- **Dark pill brand badge** ("S." gold chip on ink pill) echoing Tarkashila's
  "T." logo. Buttons are ink pills (dark bg, white text), radius 999px.
- Eyebrows: uppercase, tracked, with a gold dot (`::before`).
- Sections max-width 1200px, narrow articles 760px, gutter clamp(24px,5vw,64px).
- Expo easing `cubic-bezier(.16,1,.3,1)` on transitions.
- Subtle scroll-fade via IntersectionObserver (visible by default without JS).
- Portrait: soft-cornered rectangle, soft light shadow (no neon glow).
- Hero has a stat strip (6+ products / 3 countries / 100% direct access),
  mirroring Tarkashila's hero.

## Real social URLs (confirmed)

- LinkedIn: `https://www.linkedin.com/in/suryateja-ai/`
- X: `https://x.com/suryatejaaibuff`
- Instagram: `https://www.instagram.com/suryateja_manchikatla/`
- Facebook: `https://www.facebook.com/share/1BN1rS27oD/` (share URL —
  works but uglier in OG previews than a canonical profile URL).
- GitHub (source repo): `https://github.com/vyomaaistudio/suryateja.pro`
- GitHub (account, used in JSON-LD `sameAs`): `https://github.com/vyomaaistudio`
  — this is the "vyoma ai studio" personal account on the Mac's gh
  auth list. If you migrate to a proper GitHub Organization later,
  update both URLs above.

## TODOs

1. **OG image.** `assets/og-image.jpg` is referenced in the head but
   not yet created. Generate a 1200×630 image (portrait + name +
   tagline).
2. **`apple-touch-icon.png`** — generate a 180×180 PNG from the favicon
   SVG.
3. **`/now/` page is dated May 2026.** Keep fresh — if it goes stale
   past ~2 months, either update it or delete the page and remove the
   sitemap entry rather than letting it rot.
4. **Hostinger cleanup** (see Deploy section above) — must be done
   before declaring production fine.

## Gotchas / what to remember

- `data/` is in `.gitignore` and `.htaccess`-blocked. Contains JSON
  Lines of contact submissions + rate-limit state. To read the log on
  Hostinger: hPanel File Manager → `public_html/data/contact_submissions.jsonl`.
- The two `gh` CLI accounts on this Mac auto-switch — the Vyomai one
  is `vyomaaistudio`. **Before any GitHub operation on this repo, run:**
  `gh auth switch --user vyomaaistudio` (else 404 on edit operations).
- The repo is currently **public**. Flip to private with:
  `gh repo edit vyomaaistudio/suryateja.pro --visibility private --accept-visibility-change-consequences`
- `form_submissions.txt` (347 KB) is on Hostinger AND in the local
  working tree (gitignored). Don't import — schemas differ. Delete from
  Hostinger ASAP (PII exposure).
- The `.htaccess` denies `CLAUDE.md`, `_vps/`, `_partials/`, `data/`,
  `.env*`, `form_submissions.txt`. Anything else you add that shouldn't
  be web served, add to the `<FilesMatch>` block or a `RedirectMatch
  403`.
- `Options -MultiViews` is set in `.htaccess` so that a request to
  `/contact` doesn't extension-match `/contact.php` — it falls through
  to mod_dir's directory redirect, which sends `/contact` → `/contact/`
  (the actual page). The form endpoint is at `/api/contact.php` to
  avoid the same name collision entirely.
- PHP's `mail()` deliverability depends on Hostinger handling SPF for
  `suryateja.pro`. The `From:` is `noreply@suryateja.pro` so this
  authenticates correctly. If mail starts landing in spam, the next
  upgrade is PHPMailer + Gmail SMTP (vendored — no Composer needed).

## Phrasebook — "when user says X"

- "deploy" / "ship it" → `git push origin main`. Hostinger's git
  webhook auto-pulls (if you set up the webhook; otherwise click
  "Deploy" in hPanel → Git).
- "update /now" → edit `now/index.php`, change the `now-meta` date
  line and the section bullets. Same look + feel.
- "add a page" → create `<slug>/index.php`, copy the boilerplate from
  an existing page (e.g. `about/index.php`), set the four `$page_*`
  variables, add the slug to the `$nav_items` array in
  `_partials/header.php`, add to `sitemap.xml`. That's all the
  plumbing — content goes inside `<main id="main">`.
- "add a section to an existing page" → edit that page's `<main>`.
  Don't add sections to the home page without asking first — the home
  is intentionally minimal (hero + tile grid).
- "change the accent colour" → edit `--accent` / `--accent-hover` /
  `--accent-soft` / `--accent-line` in `assets/styles.css`. Gold `#c19a28`
  is Tarkashila's brand accent — don't switch without confirming.
- "fix the seo" → all `<head>` content is in `_partials/head.php` and
  driven by per-page `$page_title` / `$page_description` /
  `$page_canonical` / `$page_ldjson` variables. Update those on the
  affected page(s), then `sitemap.xml`. Submit changes to Google
  Search Console.
- "move to VPS" → everything for that is preserved under `_vps/`. The
  original migration checklist is `_vps/MIGRATION.md`. Path:
  1. Provision VPS, copy `_vps/*` to a fresh project root.
  2. Move `index.html`, `now/`, `assets/`, `robots.txt`, `sitemap.xml`
     into a `public/` directory.
  3. Rebuild `contact.php` logic in `_vps/server.js` (already done).
  4. Follow `_vps/MIGRATION.md`.

## Open follow-ups (not blockers, but worth doing)

- Add Cloudflare in front of Hostinger for caching + DDoS, even on
  shared hosting. (DNS-only or proxied — both work.)
- Set up Google Search Console + Bing Webmaster Tools after first
  deploy. Submit `sitemap.xml`.
- Generate the OG image (1200×630) for proper link previews on
  LinkedIn / WhatsApp / Slack.
- Consider PHPMailer + Gmail SMTP if Hostinger deliverability sucks.

---

*Last updated: 2026-06-14 — split single page into multi-page architecture
(home + 6 detail pages) using PHP includes for shared chrome.*
