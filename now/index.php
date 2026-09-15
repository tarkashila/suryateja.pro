<?php
$page_title       = 'Now — Suryateja Manchikatla';
$page_description = "What I'm focused on this month — Tarkashila, building pdfonweb and leaselylite, CRM work at Karibu, contributions to Scholar Africa.";
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
    <p class="now-meta">Last updated: September 2026 · Hyderabad &amp; East Africa</p>
    <h1>Right now.</h1>

    <p>
      Most of my time goes into <a href="https://tarkashila.com" rel="noopener">Tarkashila</a>,
      building and running <a href="https://pdfonweb.com" rel="noopener">pdfonweb</a>
      and <a href="https://leaselylite.com" rel="noopener">leaselylite</a>.
    </p>
    <p>
      Not doing: buying backlinks, or AI-generated content at scale. Ever.
    </p>

    <nav class="page-next" aria-label="Continue">
      <a class="btn btn-primary" href="https://tarkashila.com" rel="noopener">Work with Tarkashila →</a>
      <a class="btn btn-ghost" href="/contact/">Say hello</a>
    </nav>
  </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
