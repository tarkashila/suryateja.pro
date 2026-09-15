<?php
$page_title       = 'Stack — Suryateja Manchikatla';
$page_description = 'The tools I use day-to-day. Engineering, infrastructure, operations, AI, and SEO.';
$page_canonical   = 'https://suryateja.pro/stack/';
$page_og_type     = 'website';
$current_page     = 'stack';

$page_ldjson = <<<'JSON'
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://suryateja.pro/"},
    {"@type": "ListItem", "position": 2, "name": "Stack", "item": "https://suryateja.pro/stack/"}
  ]
}
JSON;

include $_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php';
?>

<main id="main">
  <section class="section section-stack section-page fade-in">
    <div class="container">
      <header class="section-head">
        <p class="eyebrow">Stack</p>
        <h1>How I build.</h1>
      </header>

      <div class="stack-grid">
        <div class="stack-group">
          <h2>Build</h2>
          <ul>
            <li>Node.js &amp; PHP</li>
            <li>React</li>
            <li>MySQL &amp; SQLite</li>
          </ul>
        </div>
        <div class="stack-group">
          <h2>Run</h2>
          <ul>
            <li>Docker</li>
            <li>Self-hosted VPS</li>
            <li>Cloudflare</li>
          </ul>
        </div>
        <div class="stack-group">
          <h2>Grow</h2>
          <ul>
            <li>AI-augmented workflows</li>
            <li>Technical SEO</li>
            <li>CRM &amp; automation</li>
          </ul>
        </div>
      </div>

      <nav class="page-next" aria-label="Continue">
        <a class="btn btn-primary" href="https://tarkashila.com" rel="noopener">Work with Tarkashila →</a>
        <a class="btn btn-ghost" href="/contact/">Get in touch</a>
      </nav>
    </div>
  </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
