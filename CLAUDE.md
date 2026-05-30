# suryateja.pro — project memory

> Personal site for Suryateja Manchikatla. Static HTML + tiny Express
> backend for contact form. Self-hosted on VPS behind Cloudflare.

---

## What this project is

- Personal landing page at `https://suryateja.pro`.
- Sections: Hero, About, Ventures, Stack, Services, Contact, Footer.
  Plus a `/now/` page.
- Single page; no blog, no CMS, no multi-page nav. Out of scope.

## Stack

- **Frontend**: vanilla HTML / CSS / minimal JS. No bundler, no webfonts.
  Editorial serif (system stack: Iowan Old Style → Palatino → Georgia)
  for headings, system sans for body.
- **Backend**: Node 20, Express 4, better-sqlite3 for storage,
  nodemailer for Gmail SMTP. Single `server.js`.
- **Container**: Node 20 Alpine, multi-stage isn't worth it here.
  Named volume `suryateja_data` for `/data/contact.sqlite`.
- **Edge**: Cloudflare proxied → nginx on VPS → `127.0.0.1:3000`.

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

## Deploy

- `./deploy.sh` (rsync to VPS, `docker compose up -d --build`, health check).
- Override target with env: `VPS_HOST=1.2.3.4 VPS_PATH=/opt/x ./deploy.sh`.
- The script syntax-checks `server.js` before pushing, backs up the
  remote SQLite DB, and verifies `/health` after rebuild.

## Env vars (set in `.env` on VPS, not in image)

- `NODE_ENV=production`
- `PORT=3000`
- `DB_PATH=/data/contact.sqlite`
- `GMAIL_USER=emailsuryateja.m@gmail.com`
- `GMAIL_APP_PASSWORD=…` (16-char Gmail App Password)
- `CONTACT_TO=emailsuryateja.m@gmail.com`
- `CONTACT_FROM_NAME=suryateja.pro contact form`

If Gmail credentials are absent, the server still stores submissions in
SQLite but doesn't email — there's a startup warning.

## Routes

- `/` → `public/index.html`
- `/now/` → `public/now/index.html`
- `/sitemap.xml`, `/robots.txt` → static
- `/health` → `{ ok: true, env, time }` — used by Docker HEALTHCHECK and
  deploy verification. nginx serves it without access logs.
- `POST /api/contact` → JSON: `{ name, email, message, company }`
  (company is a honeypot). Rate-limited to 5 / 10 min per IP.

## Visual treatment — locked

- Dark theme. `--bg: #0e0e12`, `--accent: #d4a24c` (soft amber/gold).
- Editorial serif headings (system stack — no webfont download).
- Sections max-width 1100px, narrow articles 760px.
- Subtle scroll-fade via IntersectionObserver only. No typed text.
  No counters. No parallax.
- Single accent — amber/gold throughout. No agency-template gradients.
- Portrait: soft-cornered rectangle, no neon glow.

## TODOs and placeholders to fix

1. **Real social URLs.** Confirmed by Surya 2026-05-29:
   - LinkedIn: `https://www.linkedin.com/in/suryateja-ai/`
   - X: `https://x.com/suryatejaaibuff`
   - Instagram: `https://www.instagram.com/suryateja_manchikatla/`
   - Facebook: `https://www.facebook.com/share/1BN1rS27oD/` (share URL,
     not the canonical profile URL — works but is uglier in OG previews).
   - GitHub (source repo): `https://github.com/vyomaaistudio/suryateja.pro`
   - GitHub (account, used in JSON-LD `sameAs`): `https://github.com/vyomaaistudio`
     — this is the "vyoma ai studio" personal account on the Mac's gh
     auth list, used as the canonical Vyomai GitHub home until a true
     org is created. If you migrate to a proper GitHub Organization later
     (`vyomai-studios` or similar), update both URLs above.
2. **OG image.** `public/assets/og-image.jpg` is referenced but not yet
   created. Generate a 1200×630 image (portrait + name + tagline).
   `MIGRATION.md` step 6 includes the OG preview check.
3. **`apple-touch-icon.png`** — generate a 180×180 PNG from the favicon
   SVG.
4. **`/now/` page is dated May 2026.** I committed to keeping it fresh —
   if it goes stale past ~2 months, either update it or delete the page
   and remove the sitemap entry rather than letting it rot.

## Gotchas / what to remember

- `data/` is in `.gitignore` and `.dockerignore`. The SQLite DB lives on
  the **named volume** `suryateja_data`, not in the image, not in the
  source tree.
- `docker-compose.yml` binds port 3000 to `127.0.0.1` only — nginx on
  the host proxies. Don't expose 3000 publicly.
- Cloudflare's real IPs are set via `set_real_ip_from` in the nginx
  vhost so Express rate-limiting and SQLite logging record the real
  visitor IP, not Cloudflare's.
- `form_submissions.txt` (347 KB) on the old Hostinger site has
  historical submissions from the PHP version — preserve it offline.
  Don't import — schemas differ and it's not worth the effort.
- The old PHP files (`index.php`, `default.php`, `header.php`,
  `contact.php`, `style.css`, `script.js`, `Images/`, `test`) are
  excluded from rsync and Docker via `.dockerignore` and `deploy.sh`
  `--exclude` flags. Leave them in the working tree for reference until
  the migration is fully done, then clean up.

## Files

```
public/
  index.html              # main landing page
  now/index.html          # /now page
  robots.txt
  sitemap.xml
  assets/
    styles.css            # single stylesheet
    main.js               # minimal JS (fade-in, mobile nav, form)
    favicon.svg
    portrait.jpg          # current portrait (copy of Images/IMG_8359.jpeg)
    og-image.jpg          # TODO — not yet created
    apple-touch-icon.png  # TODO — not yet created
server.js                  # Express app
package.json
Dockerfile
docker-compose.yml
.env.example
deploy.sh
nginx.vhost.example.conf
MIGRATION.md               # Hostinger → VPS + Cloudflare checklist
CLAUDE.md                  # this file
```

## Phrasebook — "when user says X"

- "deploy" / "ship it" → run `./deploy.sh`, then read its output.
- "update /now" → edit `public/now/index.html`, change the
  `now-meta` date line and the section bullets. Same look + feel.
- "add a section" → it's a single landing page; before adding a section
  ask if it should sit in nav. Don't add hidden sections.
- "change the accent colour" → edit `--accent` / `--accent-hover` /
  `--accent-soft` / `--accent-line` in `public/assets/styles.css`. The
  amber/gold was chosen 2026-05-29 — don't switch without confirming.
- "fix the seo" → start with `public/index.html` `<head>` and the
  JSON-LD block, then `sitemap.xml`. Submit changes to Google Search
  Console.

## Open follow-ups (not blockers, but worth doing)

- Add Cloudflare Authenticated Origin Pull (commented in
  `nginx.vhost.example.conf`) so only Cloudflare can hit the origin.
- Add basic Cloudflare Cache Rule: cache HTML for 5 min, CSS/JS/IMG
  for 30 days at the edge.
- Consider adding a `/uses` page once `/now` has been kept fresh for a
  couple of cycles.

---

*Last updated: 2026-05-29*
