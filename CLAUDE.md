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

- **Frontend**: vanilla HTML / CSS / minimal JS. No bundler, no webfonts.
  Editorial serif (system stack: Iowan Old Style → Palatino → Georgia)
  for headings, system sans for body.
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

## Repo layout

```
/                       # repo root = Hostinger public_html
├── index.html
├── contact.php         # contact form handler
├── .htaccess           # redirects, security headers, deny rules
├── now/
│   └── index.html      # /now page
├── assets/
│   ├── styles.css
│   ├── main.js
│   ├── portrait.jpg
│   └── favicon.svg
├── robots.txt
├── sitemap.xml
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

`_vps/` is denied via `.htaccess` so it never serves over the web —
but it's there if the hosting decision is reversed.

## Positioning rules — DO NOT DEVIATE

Source of truth for how I'm described on this site:

- Identity word: **Entrepreneur** OR **Building [product]**. Never
  "Founder" by itself — pdfonweb and leaselylite are recently launched
  and registration is in progress. "Founder" is reserved for after
  registration of Vyomai Studios.
- For Scholar Africa: "part of the team building" — not founder.
- For Karibu: "Digital & CRM Lead" — partner with brand/social team on
  data and reporting. Don't claim I run their socials.
- LinkedIn-style headline format used on the hero:
  "Building pdfonweb + leaselylite · CRM, automation & product at
  Karibu Camps & Lodges"
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

- `/` → `index.html`
- `/now/` → `now/index.html`
- `/sitemap.xml`, `/robots.txt` → static
- `POST /contact.php` → JSON `{ name, email, message, company }`
  (company is honeypot). Rate-limited to 5 / 10 min per IP.

## Visual treatment — locked

- Dark theme. `--bg: #0e0e12`, `--accent: #d4a24c` (soft amber/gold).
- Editorial serif headings (system stack — no webfont download).
- Sections max-width 1100px, narrow articles 760px.
- Subtle scroll-fade via IntersectionObserver (progressive
  enhancement — content is visible by default without JS).
- Single accent — amber/gold throughout. No agency-template gradients.
- Portrait: soft-cornered rectangle, no neon glow.

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
- The `.htaccess` denies `CLAUDE.md`, `_vps/`, `data/`, `.env*`,
  `form_submissions.txt`. Anything else you add that shouldn't be web
  served, add to the `<FilesMatch>` block.
- PHP's `mail()` deliverability depends on Hostinger handling SPF for
  `suryateja.pro`. The `From:` is `noreply@suryateja.pro` so this
  authenticates correctly. If mail starts landing in spam, the next
  upgrade is PHPMailer + Gmail SMTP (vendored — no Composer needed).

## Phrasebook — "when user says X"

- "deploy" / "ship it" → `git push origin main`. Hostinger's git
  webhook auto-pulls (if you set up the webhook; otherwise click
  "Deploy" in hPanel → Git).
- "update /now" → edit `now/index.html`, change the `now-meta` date
  line and the section bullets. Same look + feel.
- "add a section" → it's a single landing page; before adding a section
  ask if it should sit in nav. Don't add hidden sections.
- "change the accent colour" → edit `--accent` / `--accent-hover` /
  `--accent-soft` / `--accent-line` in `assets/styles.css`. The
  amber/gold was chosen 2026-05-29 — don't switch without confirming.
- "fix the seo" → start with `index.html` `<head>` and the JSON-LD
  block, then `sitemap.xml`. Submit changes to Google Search Console.
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

*Last updated: 2026-06-01 — pivoted from VPS to Hostinger architecture.*
