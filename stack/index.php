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
        <h1>The tools I use day-to-day.</h1>
      </header>

      <div class="stack-grid">
        <div class="stack-group">
          <h2>Engineering</h2>
          <ul>
            <li>Node.js</li>
            <li>PHP</li>
            <li>React</li>
            <li>Docker</li>
            <li>MySQL</li>
            <li>SQLite (better-sqlite3)</li>
          </ul>
        </div>
        <div class="stack-group">
          <h2>Infrastructure</h2>
          <ul>
            <li>Self-hosted VPS</li>
            <li>Cloudflare (DNS, TLS, CDN)</li>
            <li>Cloudflare R2</li>
            <li>nginx</li>
            <li>GitHub Actions (self-hosted runner)</li>
          </ul>
        </div>
        <div class="stack-group">
          <h2>Operations</h2>
          <ul>
            <li>n8n</li>
            <li>Salesforce</li>
            <li>Tourplan</li>
            <li>Google Workspace</li>
          </ul>
        </div>
        <div class="stack-group">
          <h2>AI</h2>
          <ul>
            <li>Claude integration patterns</li>
            <li>Prompt engineering</li>
            <li>AI-augmented workflows</li>
            <li>Puppeteer + LLM pipelines</li>
          </ul>
        </div>
        <div class="stack-group">
          <h2>SEO</h2>
          <ul>
            <li>Schema-driven SEO</li>
            <li>AEO (Answer Engine Optimization)</li>
            <li>IndexNow</li>
            <li>Server-side analytics</li>
          </ul>
        </div>
      </div>

      <nav class="page-next" aria-label="Continue">
        <a class="btn btn-primary" href="/services/">See services →</a>
        <a class="btn btn-ghost" href="/ventures/">Back to ventures</a>
      </nav>
    </div>
  </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
