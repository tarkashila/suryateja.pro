<?php
$page_title       = 'Ventures — Suryateja Manchikatla';
$page_description = 'Tarkashila products — pdfonweb and leaselylite — plus partner work with Karibu Camps & Lodges and Scholar Africa. What each is and what I do on it.';
$page_canonical   = 'https://suryateja.pro/ventures/';
$page_og_type     = 'website';
$current_page     = 'ventures';

$page_ldjson = <<<'JSON'
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://suryateja.pro/"},
    {"@type": "ListItem", "position": 2, "name": "Ventures", "item": "https://suryateja.pro/ventures/"}
  ]
}
JSON;

include $_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php';
?>

<main id="main">
  <section class="section section-ventures section-page fade-in">
    <div class="container">
      <header class="section-head">
        <p class="eyebrow">Ventures</p>
        <h1>What I'm building at Tarkashila &amp; beyond.</h1>
      </header>

      <div class="venture-grid">
        <article class="venture-card">
          <header class="venture-head">
            <h2>pdfonweb</h2>
            <span class="venture-role">Tarkashila product</span>
          </header>
          <p>
            Turns PDFs into shareable interactive flipbooks on your own
            subdomain. AI redesign, a real free tier, built-in analytics.
          </p>
          <a class="venture-link" href="https://pdfonweb.com" rel="noopener">
            pdfonweb.com <span aria-hidden="true">→</span>
          </a>
        </article>

        <article class="venture-card">
          <header class="venture-head">
            <h2>leaselylite</h2>
            <span class="venture-role">Tarkashila product</span>
          </header>
          <p>
            Property management for East African landlords and agents.
            Units, tenants, invoices, and a real billing engine, with a
            dedicated database per landlord.
          </p>
          <a class="venture-link" href="https://leaselylite.com" rel="noopener">
            leaselylite.com <span aria-hidden="true">→</span>
          </a>
        </article>

        <article class="venture-card">
          <header class="venture-head">
            <h2>Karibu Camps &amp; Lodges</h2>
            <span class="venture-role">Digital &amp; CRM Lead</span>
          </header>
          <p>
            A safari hospitality group. I lead CRM, automation, and
            reporting, the data layer behind their decisions.
          </p>
          <a class="venture-link" href="https://karibucamps.com" rel="noopener">
            karibucamps.com <span aria-hidden="true">→</span>
          </a>
        </article>

        <article class="venture-card">
          <header class="venture-head">
            <h2>Scholar Africa</h2>
            <span class="venture-role">Part of the team</span>
          </header>
          <p>
            Scholarship discovery for African students. I help on
            engineering, SEO, and product alongside the founding team.
          </p>
          <a class="venture-link" href="https://scholar.africa" rel="noopener">
            scholar.africa <span aria-hidden="true">→</span>
          </a>
        </article>
      </div>

      <nav class="page-next" aria-label="Continue">
        <a class="btn btn-primary" href="https://tarkashila.com" rel="noopener">Work with Tarkashila →</a>
        <a class="btn btn-ghost" href="/contact/">Or start a conversation</a>
      </nav>
    </div>
  </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
