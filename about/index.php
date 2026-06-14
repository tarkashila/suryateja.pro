<?php
$page_title       = 'About — Suryateja Manchikatla';
$page_description = 'Indian-born, based in Arusha, Tanzania. One operator across product, engineering, CRM, and SEO. Building pdfonweb and leaselylite under Vyomai Studios.';
$page_canonical   = 'https://suryateja.pro/about/';
$page_og_type     = 'profile';
$current_page     = 'about';

$page_ldjson = <<<'JSON'
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://suryateja.pro/"},
    {"@type": "ListItem", "position": 2, "name": "About", "item": "https://suryateja.pro/about/"}
  ]
}
JSON;

include $_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php';
?>

<main id="main">
  <section class="section section-about section-page fade-in">
    <div class="container narrow">
      <p class="eyebrow">About</p>
      <h1>One operator, three time zones of work.</h1>
      <p>
        I'm Suryateja Manchikatla — Indian-born, based in Arusha, Tanzania.
        A one-man-army across product, engineering, CRM, and SEO. I move
        between code and commercial work in a single day, and I prefer
        shipping the simple version and iterating.
      </p>
      <p>
        I'm building two SaaS products under Vyomai Studios.
        <a href="https://pdfonweb.com" rel="noopener">pdfonweb</a> turns
        static PDFs into shareable, AI-redesigned interactive flipbooks
        hosted on user-owned subdomains.
        <a href="https://leaselylite.com" rel="noopener">leaselylite</a> is
        a multi-tenant property management SaaS for East African landlords
        and agents, with a real billing engine and a dedicated database
        per landlord.
      </p>
      <p>
        By day I'm Digital &amp; CRM Lead at
        <a href="https://karibucamps.com" rel="noopener">Karibu Camps &amp;
        Lodges</a>, a multi-camp hospitality group across the northern
        Tanzania circuit. I'm also part of the team building
        <a href="https://scholar.africa" rel="noopener">Scholar Africa</a>,
        a verification-led scholarship discovery platform for African
        students. Before East Africa: six years in B2B sales and partner
        development at Hikvision, Dahua, and PGR Systems in Hyderabad,
        building distribution networks of 600+ partners across
        Andhra Pradesh and Telangana.
      </p>
      <p class="about-closer">
        Open to conversations across the East African tourism, hospitality,
        tech, and education ecosystem.
      </p>

      <nav class="page-next" aria-label="Continue">
        <a class="btn btn-primary" href="/ventures/">See what I'm building →</a>
        <a class="btn btn-ghost" href="/contact/">Or get in touch</a>
      </nav>
    </div>
  </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
