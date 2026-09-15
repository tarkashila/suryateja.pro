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
            SaaS that turns PDFs into shareable interactive flipbooks
            hosted on user-owned subdomains. AI-powered redesign in the
            backend, genuinely free tier, built-in analytics.
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
            Multi-tenant property management SaaS for East African
            landlords and agents. Units, tenants, invoices, and a full
            billing engine with ACID accounting. Dedicated database and
            tenant-portal subdomain per landlord.
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
            Multi-camp hospitality group across Serengeti, Ngorongoro,
            Tarangire and Mara. I lead CRM, automation, reporting, and
            the digital data layer that feeds the brand and social team.
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
            Verification-led scholarship discovery platform for African
            students. I contribute on engineering, SEO, and product
            alongside the founding team — the idea isn't mine, I'm part
            of it.
          </p>
          <a class="venture-link" href="https://scholar.africa" rel="noopener">
            scholar.africa <span aria-hidden="true">→</span>
          </a>
        </article>
      </div>

      <nav class="page-next" aria-label="Continue">
        <a class="btn btn-primary" href="/stack/">See the stack →</a>
        <a class="btn btn-ghost" href="/contact/">Or start a conversation</a>
      </nav>
    </div>
  </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
