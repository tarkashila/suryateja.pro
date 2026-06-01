<?php
/**
 * suryateja.pro — contact form handler (Hostinger / PHP).
 *
 * Mirrors the Express endpoint that's archived under _vps/server.js:
 *   - Accepts POST application/json (also tolerates form-urlencoded)
 *   - Honeypot via `company` field
 *   - File-based rate limit: 5 per 10 min per IP
 *   - Appends every submission to data/contact_submissions.jsonl
 *   - Sends email via PHP mail()
 *     (Hostinger handles SPF/DKIM for the suryateja.pro domain — using a
 *      noreply@suryateja.pro From: address gives best deliverability.)
 *
 * data/ folder is denied at the .htaccess layer so logs aren't web-readable.
 */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}

// --- Config -----------------------------------------------------------------
$contactTo        = 'emailsuryateja.m@gmail.com';
$contactFromName  = 'suryateja.pro contact form';
$contactFromEmail = 'noreply@suryateja.pro'; // Hostinger sends authoritatively for this domain
$dataDir          = __DIR__ . '/data';
$rateWindowSec    = 10 * 60;
$rateMax          = 5;

// --- Ensure data dir exists -------------------------------------------------
if (!is_dir($dataDir)) {
    @mkdir($dataDir, 0755, true);
}

// --- Parse body (JSON preferred, form fallback) -----------------------------
$body = null;
$raw  = file_get_contents('php://input');
if ($raw !== false && $raw !== '') {
    $decoded = json_decode($raw, true);
    if (is_array($decoded)) {
        $body = $decoded;
    }
}
if ($body === null) {
    $body = $_POST;
}

$name    = trim((string)($body['name']    ?? ''));
$email   = trim((string)($body['email']   ?? ''));
$message = trim((string)($body['message'] ?? ''));
$company = trim((string)($body['company'] ?? '')); // honeypot

// --- Honeypot: silently succeed for bots ------------------------------------
if ($company !== '') {
    echo json_encode(['ok' => true]);
    exit;
}

// --- Validation -------------------------------------------------------------
if ($name === '' || $email === '' || $message === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Name, email, and message are required.']);
    exit;
}
if (strlen($name) > 120 || strlen($email) > 200 || strlen($message) > 4000) {
    http_response_code(400);
    echo json_encode(['error' => 'One of the fields is too long.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Email looks invalid.']);
    exit;
}

// --- Real client IP (Hostinger sits behind their own edge) ------------------
$ip = 'unknown';
foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP'] as $hdr) {
    if (!empty($_SERVER[$hdr])) {
        $ip = trim(explode(',', $_SERVER[$hdr])[0]);
        break;
    }
}
if ($ip === 'unknown' && !empty($_SERVER['REMOTE_ADDR'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$userAgent = substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500);

// --- Rate limit (file-based) ------------------------------------------------
$rateFile = $dataDir . '/ratelimit.json';
$now      = time();
$bucket   = [];

if (is_file($rateFile)) {
    $contents = @file_get_contents($rateFile);
    if ($contents !== false) {
        $decoded = json_decode($contents, true);
        if (is_array($decoded)) $bucket = $decoded;
    }
}

// Prune expired buckets to keep the file small
foreach ($bucket as $k => $v) {
    if (!is_array($v) || ($v['reset'] ?? 0) < $now) {
        unset($bucket[$k]);
    }
}

$entry = $bucket[$ip] ?? ['count' => 0, 'reset' => $now + $rateWindowSec];
if ($entry['reset'] < $now) {
    $entry = ['count' => 0, 'reset' => $now + $rateWindowSec];
}
$entry['count'] += 1;
$bucket[$ip] = $entry;

@file_put_contents($rateFile, json_encode($bucket), LOCK_EX);

if ($entry['count'] > $rateMax) {
    http_response_code(429);
    echo json_encode(['error' => 'Too many requests. Try again in a bit.']);
    exit;
}

// --- Persist submission as a JSON-Lines record ------------------------------
$logFile = $dataDir . '/contact_submissions.jsonl';
$record  = [
    'created_at' => gmdate('Y-m-d\TH:i:s\Z'),
    'name'       => $name,
    'email'      => $email,
    'message'    => $message,
    'ip'         => $ip,
    'user_agent' => $userAgent,
];
@file_put_contents(
    $logFile,
    json_encode($record, JSON_UNESCAPED_UNICODE) . "\n",
    FILE_APPEND | LOCK_EX
);

// --- Send email via mail() --------------------------------------------------
// Sanitize the visitor's name for the Reply-To display so we can't be
// header-injected via the form field.
$safeName = preg_replace('/[\r\n"<>]/u', '', $name) ?? $name;

$subject  = "[suryateja.pro] {$safeName} — contact form";
$bodyText = "New contact form submission\n\n"
          . "Name:    {$name}\n"
          . "Email:   {$email}\n"
          . "IP:      {$ip}\n"
          . "UA:      {$userAgent}\n\n"
          . "Message:\n{$message}\n";

$headers = implode("\r\n", [
    "From: \"{$contactFromName}\" <{$contactFromEmail}>",
    "Reply-To: \"{$safeName}\" <{$email}>",
    "MIME-Version: 1.0",
    "Content-Type: text/plain; charset=utf-8",
    "X-Mailer: PHP/suryateja.pro",
]);

$sent = @mail($contactTo, $subject, $bodyText, $headers);

if (!$sent) {
    // Log but DON'T fail the user — submission is persisted in the log.
    @file_put_contents(
        $dataDir . '/mail-errors.log',
        gmdate('c') . " - mail() returned false for {$email}\n",
        FILE_APPEND
    );
}

echo json_encode(['ok' => true]);
