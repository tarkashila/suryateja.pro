<?php
$page_title       = 'Suryateja Manchikatla — Founder, Tarkashila · pdfonweb + leaselylite';
$page_description = 'Founder of Tarkashila — software that solves operational problems. Builder of pdfonweb and leaselylite, shipping products across India and East Africa.';
$page_canonical   = 'https://suryateja.pro/';
$page_og_type     = 'website';
$current_page     = 'home';

$page_ldjson = <<<'JSON'
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Suryateja Manchikatla",
  "alternateName": "Surya Teja",
  "jobTitle": "Founder",
  "description": "Founder of Tarkashila, building software that solves operational problems. Builder of pdfonweb and leaselylite.",
  "url": "https://suryateja.pro/",
  "image": "https://suryateja.pro/assets/portrait.jpg",
  "email": "mailto:emailsuryateja.m@gmail.com",
  "worksFor": {
    "@type": "Organization",
    "name": "Tarkashila",
    "legalName": "Tarkashila Private Limited",
    "url": "https://tarkashila.com"
  },
  "sameAs": [
    "https://www.linkedin.com/in/suryateja-ai/",
    "https://github.com/tarkashila",
    "https://x.com/suryatejaaibuff",
    "https://www.instagram.com/suryateja_manchikatla/",
    "https://www.facebook.com/share/1BN1rS27oD/",
    "https://tarkashila.com",
    "https://pdfonweb.com",
    "https://leaselylite.com"
  ]
}
JSON;

include $_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php';
?>

<main id="main">
  <section class="hero">
    <div class="container hero-grid">
      <div class="hero-copy fade-in">
        <p class="eyebrow">Suryateja Manchikatla · Founder, Tarkashila</p>
        <h1 class="hero-creed hero-heading-reveal">
          <span class="hl-mask"><span class="hl-line">I build software.</span></span>
          <span class="hl-mask"><span class="hl-line">Then I <span class="accent">run</span> it.</span></span>
        </h1>
        <p class="lede">
          I'm the founder of <a href="https://tarkashila.com" rel="noopener">Tarkashila</a>,
          a studio that builds and runs its own software. Got a problem worth
          solving? That's where we do the work.
        </p>
        <div class="hero-ctas">
          <a class="btn btn-primary" href="https://tarkashila.com" rel="noopener">Work with Tarkashila →</a>
          <a class="btn btn-ghost" href="/contact/">Say hello</a>
        </div>
      </div>
      <figure class="hero-portrait fade-in">
        <img
          src="/assets/portrait.jpg"
          alt="Portrait of Suryateja Manchikatla"
          width="864" height="1064"
          loading="eager" decoding="async" fetchpriority="high" />
      </figure>
    </div>
  </section>

  <section class="section section-explore fade-in">
    <div class="container">
      <header class="section-head">
        <p class="eyebrow">Where next</p>
        <h2>Start with the studio.</h2>
      </header>

      <div class="explore-grid">
        <a class="explore-tile explore-tile--lead" href="https://tarkashila.com" rel="noopener">
          <p class="explore-eyebrow">→ Tarkashila</p>
          <h3>The studio where the work happens.</h3>
          <p class="explore-desc">
            Tarkashila designs, builds, and runs software, from early strategy
            to shipped product. If you're here to start something, start there.
          </p>
          <span class="explore-cta">Go to Tarkashila <span aria-hidden="true">→</span></span>
        </a>

        <a class="explore-tile" href="/ventures/">
          <p class="explore-eyebrow">Ventures</p>
          <h3>What I'm building.</h3>
          <span class="explore-cta">See ventures <span aria-hidden="true">→</span></span>
        </a>

        <a class="explore-tile" href="/about/">
          <p class="explore-eyebrow">About</p>
          <h3>The short version of me.</h3>
          <span class="explore-cta">Read about <span aria-hidden="true">→</span></span>
        </a>

        <a class="explore-tile explore-tile--quiet" href="/contact/">
          <p class="explore-eyebrow">Contact</p>
          <h3>Say hello, or bring a problem worth solving.</h3>
          <span class="explore-cta">Get in touch <span aria-hidden="true">→</span></span>
        </a>
      </div>
    </div>
  </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
