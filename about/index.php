<?php
$page_title       = 'About — Suryateja Manchikatla';
$page_description = 'Founder of Tarkashila. Indian-born, working across Hyderabad and East Africa. One operator across product, engineering, CRM, and SEO — building pdfonweb and leaselylite.';
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
        I'm Suryateja Manchikatla — Indian-born, working across Hyderabad
        and East Africa. A one-man-army across product, engineering, CRM,
        and SEO. I move between code and commercial work in a single day,
        and I prefer shipping the simple version and iterating.
      </p>
      <p>
        I'm the founder of <a href="https://tarkashila.com" rel="noopener">Tarkashila</a>
        — a software studio that designs, builds, and <em>runs</em> its own
        products. In production now:
        <a href="https://pdfonweb.com" rel="noopener">pdfonweb</a>, which turns
        static PDFs into shareable, AI-redesigned interactive flipbooks hosted
        on user-owned subdomains, and
        <a href="https://leaselylite.com" rel="noopener">leaselylite</a>, a
        multi-tenant property-management SaaS for East African landlords and
        agents with a real billing engine and a dedicated database per landlord.
      </p>
      <p>
        Because we run what we build, I know what software looks like under
        real-world pressure — not just at handover. I also lead CRM and
        automation work with
        <a href="https://karibucamps.com" rel="noopener">Karibu Camps &amp;
        Lodges</a>, a multi-camp hospitality group across the northern Tanzania
        circuit. Before this: six years in B2B sales and partner development at
        Hikvision, Dahua, and PGR Systems in Hyderabad, building distribution
        networks of 600+ partners across Andhra Pradesh and Telangana.
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
