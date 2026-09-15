<?php
// Shared <head> + open <body> + skip link.
// Pages set $page_title / $page_description / $page_canonical / $page_og_type /
// $page_og_image / $page_class / $page_ldjson before including this partial.

$page_title       = $page_title       ?? 'Suryateja Manchikatla — Founder, Tarkashila · pdfonweb + leaselylite';
$page_description = $page_description ?? 'Founder of Tarkashila — software that solves operational problems. Builder of pdfonweb and leaselylite, shipping products across India and East Africa.';
$page_canonical   = $page_canonical   ?? 'https://suryateja.pro/';
$page_og_type     = $page_og_type     ?? 'website';
$page_og_image    = $page_og_image    ?? 'https://suryateja.pro/assets/og-image.jpg';
$page_class       = $page_class       ?? '';
$page_ldjson      = $page_ldjson      ?? '';

function _h(string $s): string { return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?><!doctype html>
<html lang="en"<?= $page_class !== '' ? ' class="' . _h($page_class) . '"' : '' ?>>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta name="theme-color" content="#ffffff" />
  <meta name="color-scheme" content="light" />

  <!-- Mark JS as available BEFORE the stylesheet parses so .fade-in starts hidden only when JS will run. -->
  <script>document.documentElement.classList.add('js');</script>

  <title><?= _h($page_title) ?></title>
  <meta name="description" content="<?= _h($page_description) ?>" />
  <link rel="canonical" href="<?= _h($page_canonical) ?>" />

  <link rel="icon" href="/assets/favicon.svg" type="image/svg+xml" />
  <link rel="apple-touch-icon" href="/assets/apple-touch-icon.png" />

  <!-- Plus Jakarta Sans — matches tarkashila.com -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" />

  <meta property="og:type"        content="<?= _h($page_og_type) ?>" />
  <meta property="og:site_name"   content="Suryateja Manchikatla — Tarkashila" />
  <meta property="og:title"       content="<?= _h($page_title) ?>" />
  <meta property="og:description" content="<?= _h($page_description) ?>" />
  <meta property="og:url"         content="<?= _h($page_canonical) ?>" />
  <meta property="og:image"       content="<?= _h($page_og_image) ?>" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <meta property="og:locale"      content="en_US" />

  <meta name="twitter:card"        content="summary_large_image" />
  <meta name="twitter:title"       content="<?= _h($page_title) ?>" />
  <meta name="twitter:description" content="<?= _h($page_description) ?>" />
  <meta name="twitter:image"       content="<?= _h($page_og_image) ?>" />

  <link rel="stylesheet" href="/assets/styles.css" />

  <?php if ($page_ldjson !== ''): ?>
  <script type="application/ld+json"><?= $page_ldjson ?></script>
  <?php endif; ?>
</head>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
