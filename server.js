// suryateja.pro — minimal Express server.
// Serves /public statically + handles /api/contact with SQLite persistence and Gmail SMTP.

'use strict';

const path = require('path');
const fs = require('fs');
const express = require('express');
const Database = require('better-sqlite3');
const nodemailer = require('nodemailer');

const PORT = parseInt(process.env.PORT || '3000', 10);
const NODE_ENV = process.env.NODE_ENV || 'development';
const DB_PATH = process.env.DB_PATH || path.join(__dirname, 'data', 'contact.sqlite');
const PUBLIC_DIR = path.join(__dirname, 'public');

const GMAIL_USER = process.env.GMAIL_USER || '';
const GMAIL_APP_PASSWORD = process.env.GMAIL_APP_PASSWORD || '';
const CONTACT_TO = process.env.CONTACT_TO || GMAIL_USER || 'emailsuryateja.m@gmail.com';
const CONTACT_FROM_NAME = process.env.CONTACT_FROM_NAME || 'suryateja.pro contact form';

// Ensure data dir
fs.mkdirSync(path.dirname(DB_PATH), { recursive: true });

const db = new Database(DB_PATH);
db.pragma('journal_mode = WAL');
db.exec(`
  CREATE TABLE IF NOT EXISTS contact_submissions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    created_at TEXT NOT NULL DEFAULT (datetime('now')),
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    message TEXT NOT NULL,
    ip TEXT,
    user_agent TEXT,
    emailed INTEGER NOT NULL DEFAULT 0,
    email_error TEXT
  );
`);

const insertStmt = db.prepare(`
  INSERT INTO contact_submissions (name, email, message, ip, user_agent)
  VALUES (@name, @email, @message, @ip, @userAgent)
`);
const markEmailedStmt = db.prepare(`
  UPDATE contact_submissions SET emailed = 1 WHERE id = ?
`);
const markEmailErrorStmt = db.prepare(`
  UPDATE contact_submissions SET email_error = ? WHERE id = ?
`);

// Mail transport
let transporter = null;
if (GMAIL_USER && GMAIL_APP_PASSWORD) {
  transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: { user: GMAIL_USER, pass: GMAIL_APP_PASSWORD }
  });
} else {
  console.warn('[contact] GMAIL_USER / GMAIL_APP_PASSWORD not set — submissions will store but not email.');
}

const app = express();
app.disable('x-powered-by');
app.set('trust proxy', true);
app.use(express.json({ limit: '64kb' }));

// Light per-IP rate limit (in-memory, 5 / 10min)
const RATE_WINDOW_MS = 10 * 60 * 1000;
const RATE_MAX = 5;
const buckets = new Map();
function rateLimit(req, res, next) {
  const ip = req.ip || 'unknown';
  const now = Date.now();
  const entry = buckets.get(ip) || { count: 0, reset: now + RATE_WINDOW_MS };
  if (now > entry.reset) { entry.count = 0; entry.reset = now + RATE_WINDOW_MS; }
  entry.count += 1;
  buckets.set(ip, entry);
  if (entry.count > RATE_MAX) {
    return res.status(429).json({ error: 'Too many requests. Try again later.' });
  }
  next();
}

// Static
app.use(express.static(PUBLIC_DIR, {
  index: 'index.html',
  extensions: ['html'],
  maxAge: NODE_ENV === 'production' ? '1d' : 0,
  setHeaders: (res, filePath) => {
    if (filePath.endsWith('.html')) {
      res.setHeader('Cache-Control', 'public, max-age=300, must-revalidate');
    }
  }
}));

// Health
app.get('/health', (req, res) => {
  res.json({ ok: true, env: NODE_ENV, time: new Date().toISOString() });
});

// Contact
app.post('/api/contact', rateLimit, async (req, res) => {
  const body = req.body || {};
  const name = String(body.name || '').trim();
  const email = String(body.email || '').trim();
  const message = String(body.message || '').trim();
  const company = String(body.company || '').trim(); // honeypot

  if (company) {
    return res.status(200).json({ ok: true });
  }
  if (!name || !email || !message) {
    return res.status(400).json({ error: 'Name, email, and message are required.' });
  }
  if (name.length > 120 || email.length > 200 || message.length > 4000) {
    return res.status(400).json({ error: 'One of the fields is too long.' });
  }
  if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
    return res.status(400).json({ error: 'Email looks invalid.' });
  }

  const ip = req.ip;
  const userAgent = String(req.headers['user-agent'] || '').slice(0, 500);

  let row;
  try {
    const info = insertStmt.run({ name, email, message, ip, userAgent });
    row = { id: info.lastInsertRowid };
  } catch (err) {
    console.error('[contact] db insert failed', err);
    return res.status(500).json({ error: 'Could not save your message. Try emailing me directly.' });
  }

  if (transporter) {
    try {
      await transporter.sendMail({
        from: `"${CONTACT_FROM_NAME}" <${GMAIL_USER}>`,
        to: CONTACT_TO,
        replyTo: `"${name}" <${email}>`,
        subject: `[suryateja.pro] ${name} — contact form`,
        text:
`New contact form submission

Name:    ${name}
Email:   ${email}
IP:      ${ip}
UA:      ${userAgent}

Message:
${message}
`,
        html: `
<h3>New contact form submission</h3>
<p><strong>Name:</strong> ${escapeHtml(name)}<br>
<strong>Email:</strong> <a href="mailto:${escapeHtml(email)}">${escapeHtml(email)}</a><br>
<strong>IP:</strong> ${escapeHtml(ip || '')}<br>
<strong>UA:</strong> ${escapeHtml(userAgent)}</p>
<hr>
<pre style="white-space:pre-wrap;font-family:system-ui,-apple-system,sans-serif">${escapeHtml(message)}</pre>
`
      });
      markEmailedStmt.run(row.id);
    } catch (err) {
      console.error('[contact] email failed', err);
      markEmailErrorStmt.run(String(err && err.message || err).slice(0, 500), row.id);
    }
  }

  return res.status(200).json({ ok: true });
});

// 404 fallback for unknown routes — serve index for /something with no extension
app.use((req, res) => {
  if (req.method === 'GET' && !path.extname(req.path)) {
    return res.status(404).sendFile(path.join(PUBLIC_DIR, 'index.html'));
  }
  res.status(404).json({ error: 'Not found' });
});

app.listen(PORT, () => {
  console.log(`suryateja.pro listening on :${PORT} (${NODE_ENV})`);
});

function escapeHtml(s) {
  return String(s)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}
