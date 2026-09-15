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
      <h1>The short version.</h1>
      <p>
        I'm Suryateja Manchikatla, founder of
        <a href="https://tarkashila.com" rel="noopener">Tarkashila</a>. I work
        across product, engineering, CRM, and SEO, and I prefer shipping the
        simple version and iterating.
      </p>
      <p>
        Tarkashila builds and runs its own software, so I know what it looks
        like under real-world pressure, not just at handover.
        <a href="https://pdfonweb.com" rel="noopener">pdfonweb</a> and
        <a href="https://leaselylite.com" rel="noopener">leaselylite</a> are
        two of ours, in production now.
      </p>
      <p class="about-closer">
        If you have a problem worth solving, the studio is the place to start.
      </p>

      <nav class="page-next" aria-label="Continue">
        <a class="btn btn-primary" href="https://tarkashila.com" rel="noopener">Work with Tarkashila →</a>
        <a class="btn btn-ghost" href="/contact/">Or get in touch</a>
      </nav>
    </div>
  </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
