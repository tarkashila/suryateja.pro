<?php
$page_title       = 'Services — Suryateja Manchikatla';
$page_description = 'CRM consulting, custom software development, and SEO — selective engagements through Tarkashila, with direct founder access.';
$page_canonical   = 'https://suryateja.pro/services/';
$page_og_type     = 'website';
$current_page     = 'services';

$page_ldjson = <<<'JSON'
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://suryateja.pro/"},
    {"@type": "ListItem", "position": 2, "name": "Services", "item": "https://suryateja.pro/services/"}
  ]
}
JSON;

include $_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php';
?>

<main id="main">
  <section class="section section-services section-page fade-in">
    <div class="container">
      <header class="section-head">
        <p class="eyebrow">Services</p>
        <h1>How I work with clients through Tarkashila.</h1>
      </header>

      <div class="service-grid">
        <article class="service-card">
          <h2>CRM Consulting</h2>
          <p>
            Salesforce, HubSpot, or custom CRM. I help teams move from
            spreadsheets and email threads to a clean pipeline with the
            automations, reporting, and integrations they actually need.
            Practical setup, not a year-long transformation programme.
          </p>
        </article>

        <article class="service-card">
          <h2>Custom Software Development</h2>
          <p>
            Small SaaS, internal tools, dashboards, and AI-augmented
            workflows. Full-stack on Node, PHP, React, MySQL or SQLite,
            shipped to a VPS behind Cloudflare. I prefer to own the box
            and ship the simple version first.
          </p>
        </article>

        <article class="service-card">
          <h2>Search Engine Optimization (SEO)</h2>
          <p>
            Technical and schema-driven SEO for SaaS, tourism, and
            education sites. Crawlability, Core Web Vitals, structured
            data, IndexNow, and content engineered for Answer Engine
            Optimization — not keyword stuffing.
          </p>
        </article>
      </div>

      <p class="services-disclaimer">
        Selective engagements through Tarkashila. The person you speak with is
        the person building your system — no account managers, no hand-offs.
      </p>

      <nav class="page-next" aria-label="Continue">
        <a class="btn btn-primary" href="/contact/">Start a conversation →</a>
        <a class="btn btn-ghost" href="/about/">Read about me first</a>
      </nav>
    </div>
  </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
