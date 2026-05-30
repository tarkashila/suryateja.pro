# Migration — Hostinger → VPS + Cloudflare

End state: `suryateja.pro` runs on your VPS in Docker (same pattern as
pdfonweb / leaselylite / scholar.africa), DNS lives in Cloudflare,
public TLS terminates at Cloudflare, origin TLS uses a Cloudflare Origin
Certificate, Hostinger hosting is cancelled.

Do these in order. Don't skip the gates marked **VERIFY**.

---

## 0. Pre-flight (local)

- [ ] `node --check server.js` passes.
- [ ] `docker compose build` succeeds locally without errors.
- [ ] `.env` exists on the VPS (copied from `.env.example`) and is filled in.
- [ ] You have a Gmail App Password ready
      (https://myaccount.google.com/apppasswords — not your normal password).
- [ ] Local Hostinger backup taken: download a copy of the current site
      from Hostinger File Manager + export `form_submissions.txt` for
      history (it has ~347 KB of existing submissions — keep it).

---

## 1. VPS — provision the app

```bash
# On the VPS
mkdir -p /opt/suryateja-pro && cd /opt/suryateja-pro
# rsync from local (or git clone) — the deploy.sh script does this
```

From your laptop:

```bash
VPS_HOST=<vps-ip-or-host> VPS_USER=root ./deploy.sh
```

Then on the VPS:

```bash
cd /opt/suryateja-pro
nano .env            # fill in GMAIL_APP_PASSWORD
docker compose up -d --build
docker compose logs -f web
```

**VERIFY:**
- [ ] `curl http://127.0.0.1:3000/health` → `{"ok":true,...}`
- [ ] No errors in `docker compose logs web`.

---

## 2. VPS — nginx vhost

```bash
cp /opt/suryateja-pro/nginx.vhost.example.conf /etc/nginx/sites-available/suryateja.pro
# Edit: paths to the certificate, and the server_name if you're behind a
# different domain on the same box.
ln -sf /etc/nginx/sites-available/suryateja.pro /etc/nginx/sites-enabled/
nginx -t && systemctl reload nginx
```

**VERIFY:**
- [ ] `curl -H "Host: suryateja.pro" http://127.0.0.1/health` → ok.

---

## 3. Cloudflare Origin Certificate

In Cloudflare dashboard → SSL/TLS → Origin Server → **Create Certificate**:

- Common name: `suryateja.pro` and `*.suryateja.pro`
- 15-year validity
- Save both files to the VPS:
  - `/etc/ssl/cloudflare/suryateja.pro.pem`  (certificate)
  - `/etc/ssl/cloudflare/suryateja.pro.key`  (private key — `chmod 600`)

```bash
mkdir -p /etc/ssl/cloudflare
chmod 700 /etc/ssl/cloudflare
# Save the files, then:
chmod 600 /etc/ssl/cloudflare/suryateja.pro.key
nginx -t && systemctl reload nginx
```

---

## 4. DNS cutover — Cloudflare side, BEFORE touching Hostinger DNS

Add the domain to Cloudflare if it isn't there yet:

1. Cloudflare → Add a Site → `suryateja.pro` → Free plan is fine.
2. Cloudflare gives you two nameservers (e.g. `xena.ns.cloudflare.com`).
   **Don't change anything at the registrar yet** — first set the
   records below, then flip nameservers.

In Cloudflare DNS, create:

| Type | Name              | Value                | Proxy   | TTL  |
|------|-------------------|----------------------|---------|------|
| A    | `suryateja.pro`   | `<VPS IP>`           | Proxied | Auto |
| A    | `www`             | `<VPS IP>`           | Proxied | Auto |
| CAA  | `suryateja.pro`   | `0 issue "letsencrypt.org"` | DNS only | Auto |
| CAA  | `suryateja.pro`   | `0 issue "pki.goog"` | DNS only | Auto |

If you use Gmail / Google Workspace for email on this domain, also copy
over the **MX**, **SPF (TXT)**, **DKIM (TXT)**, and **DMARC (TXT)**
records from Hostinger DNS now. Do not skip this — the contact form
relies on outbound Gmail SMTP, but if `suryateja.pro` is also your
inbound email domain, missing MX records will silently break it.

In Cloudflare SSL/TLS → Overview, set encryption mode to **Full (strict)**.

---

## 5. Flip nameservers at the registrar

Wherever `suryateja.pro` is registered (probably Hostinger), update
nameservers to the two Cloudflare gave you.

Propagation: usually 5–30 minutes; up to 24h worst-case.

**VERIFY (every 10 min until green):**

```bash
dig +short NS suryateja.pro       # should return Cloudflare NS
dig +short suryateja.pro          # should return a Cloudflare IP (104.x / 172.x)
curl -I https://suryateja.pro     # should return HTTP/2 200, server: cloudflare
```

---

## 6. Functional verification — before cancelling Hostinger

- [ ] Open `https://suryateja.pro/` in a private window → new site loads.
- [ ] `https://www.suryateja.pro/` redirects to apex.
- [ ] `https://suryateja.pro/now/` loads.
- [ ] `https://suryateja.pro/robots.txt` → returns content.
- [ ] `https://suryateja.pro/sitemap.xml` → returns valid XML.
- [ ] OG preview renders correctly on:
  - [ ] LinkedIn post composer
  - [ ] WhatsApp share
  - [ ] Slack paste
- [ ] Contact form: submit a test message → it lands in your inbox AND
      shows up in `data/contact.sqlite` on the VPS:
      ```bash
      docker compose exec web sqlite3 /data/contact.sqlite \
        "select id, name, email, created_at, emailed from contact_submissions order by id desc limit 5;"
      ```
- [ ] Lighthouse Performance ≥ 95 on mobile (it should be, with a
      static-ish bundle).
- [ ] `https://search.google.com/test/rich-results?url=https%3A%2F%2Fsuryateja.pro%2F`
      → Person schema detected, no errors.

---

## 7. Submit to search engines

- [ ] **Google Search Console**: add `https://suryateja.pro/` as a property
      → verify via Cloudflare DNS TXT record → submit `sitemap.xml`.
- [ ] **Bing Webmaster Tools**: same — submit `sitemap.xml`.
- [ ] **IndexNow** (optional but quick win): ping the sitemap once via
      `https://api.indexnow.org/indexnow` — see the IndexNow spec.

---

## 8. Cancel Hostinger — only after Steps 6 & 7 are all green

- [ ] Confirm DNS is no longer pointing at any Hostinger IP:
      `dig +short suryateja.pro` returns only Cloudflare IPs.
- [ ] Download a final archive of the Hostinger site for cold storage:
      old `index.php`, `default.php`, `script.js`, `style.css`, the
      `Images/` folder, and the full `form_submissions.txt`.
- [ ] Cancel Hostinger hosting (not the domain registration if it's
      still there — move domain registration separately if you want).

---

## 9. Post-migration — first week

- [ ] Watch Google Search Console for crawl errors and the first
      indexed URLs.
- [ ] Watch `docker compose logs -f web` once daily for anomalies.
- [ ] Update `/now/` to reflect actual current work (you committed to
      keeping it fresh — see CLAUDE.md).
- [ ] Replace the placeholder LinkedIn / GitHub / X / Instagram URLs
      in `public/index.html` with the real ones — they're flagged in
      CLAUDE.md.

---

## Rollback (if something goes wrong)

Cloudflare lets you "Pause Cloudflare on Site" at any time — DNS will
still resolve via Cloudflare but the proxy chain is bypassed. If the VPS
deploy fails outright, switch the nameservers back to Hostinger's at the
registrar; old DNS records will start resolving again within propagation
time.

`form_submissions.txt` from Hostinger contains ~347 KB of historical
submissions — preserve it offline. The new system stores everything in
SQLite at `/data/contact.sqlite` on the VPS, which is on a named volume
that survives container rebuilds.
