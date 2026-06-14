<?php
$page_title       = 'Now — Suryateja Manchikatla';
$page_description = "What I'm focused on this month — building pdfonweb and leaselylite, CRM work at Karibu, contributions to Scholar Africa.";
$page_canonical   = 'https://suryateja.pro/now/';
$page_og_type     = 'article';
$page_class       = 'now-page';
$current_page     = 'now';

$page_ldjson = <<<'JSON'
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://suryateja.pro/"},
    {"@type": "ListItem", "position": 2, "name": "Now", "item": "https://suryateja.pro/now/"}
  ]
}
JSON;

include $_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php';
?>

<main id="main">
  <div class="container narrow">
    <p class="now-meta">Last updated: May 2026 · Arusha, Tanzania</p>
    <h1>What I'm working on right now.</h1>

    <p>
      A short, honest list of what's actually on my plate this month.
      Inspired by <a href="https://nownownow.com/about" rel="noopener">Derek
      Sivers' /now movement</a>. I update it when reality shifts, not on a
      schedule.
    </p>

    <h2>Building</h2>
    <ul>
      <li>
        <strong>pdfonweb</strong> — wiring up AI-redesigned flipbook
        templates, sharper analytics on free-tier accounts, and the
        subdomain provisioning flow.
      </li>
      <li>
        <strong>leaselylite</strong> — finishing the per-landlord database
        isolation, tenant-portal subdomains, and the invoice → receipt →
        ledger loop.
      </li>
      <li>
        <strong>suryateja.pro</strong> — this site, rebuilt from scratch
        and migrated from the old PHP template.
      </li>
    </ul>

    <h2>At Karibu Camps &amp; Lodges</h2>
    <ul>
      <li>
        CRM cleanup and pipeline hygiene across the camps' enquiry flow.
      </li>
      <li>
        Reporting layer between Tourplan and the data the brand &amp;
        social team need to make decisions.
      </li>
    </ul>

    <h2>With Scholar Africa</h2>
    <ul>
      <li>
        Page-quality polish on the 162-page React SPA — SEO, structured
        data, and helping the team think through verification workflows.
      </li>
    </ul>

    <h2>Reading / Learning</h2>
    <ul>
      <li>
        Going deeper on prompt-cache patterns and agentic Claude API
        workflows.
      </li>
      <li>
        The May 2026 Google Core Update aftermath — how it actually moved
        things on real sites I run.
      </li>
    </ul>

    <h2>Not doing</h2>
    <ul>
      <li>No new client work this month.</li>
      <li>No buying backlinks. Ever.</li>
      <li>No AI-generated content at scale.</li>
    </ul>

    <nav class="page-next" aria-label="Continue">
      <a class="btn btn-ghost" href="/">← Back to home</a>
      <a class="btn btn-primary" href="/contact/">Say hello</a>
    </nav>
  </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
