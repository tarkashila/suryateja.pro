<?php
$page_title       = 'Suryateja Manchikatla — Building pdfonweb + leaselylite · Arusha, Tanzania';
$page_description = 'Entrepreneur and builder in Arusha, Tanzania. Building pdfonweb and leaselylite under Vyomai Studios. CRM, automation, and product engineering.';
$page_canonical   = 'https://suryateja.pro/';
$page_og_type     = 'website';
$current_page     = 'home';

$page_ldjson = <<<'JSON'
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Suryateja Manchikatla",
  "alternateName": "Surya Teja",
  "jobTitle": "Digital & CRM Lead",
  "description": "Entrepreneur building pdfonweb and leaselylite under Vyomai Studios. Digital & CRM Lead at Karibu Camps & Lodges.",
  "url": "https://suryateja.pro/",
  "image": "https://suryateja.pro/assets/portrait.jpg",
  "email": "mailto:emailsuryateja.m@gmail.com",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Arusha",
    "addressCountry": "Tanzania"
  },
  "worksFor": {
    "@type": "Organization",
    "name": "Karibu Camps & Lodges",
    "url": "https://karibucamps.com"
  },
  "sameAs": [
    "https://www.linkedin.com/in/suryateja-ai/",
    "https://github.com/vyomaaistudio",
    "https://x.com/suryatejaaibuff",
    "https://www.instagram.com/suryateja_manchikatla/",
    "https://www.facebook.com/share/1BN1rS27oD/",
    "https://pdfonweb.com",
    "https://leaselylite.com",
    "https://scholar.africa"
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
        <p class="eyebrow">Arusha, Tanzania</p>
        <h1>Suryateja Manchikatla</h1>
        <p class="lede">
          Building <a href="https://pdfonweb.com" rel="noopener">pdfonweb</a>
          + <a href="https://leaselylite.com" rel="noopener">leaselylite</a>
          · CRM, automation &amp; product at
          <a href="https://karibucamps.com" rel="noopener">Karibu Camps &amp; Lodges</a>.
        </p>
        <div class="hero-ctas">
          <a class="btn btn-primary" href="/ventures/">See what I'm building</a>
          <a class="btn btn-ghost" href="/contact/">Contact</a>
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
        <p class="eyebrow">What's here</p>
        <h2>Five short pages. Pick where you want to start.</h2>
      </header>

      <div class="explore-grid">
        <a class="explore-tile explore-tile--lead" href="/ventures/">
          <p class="explore-eyebrow">01 · Ventures</p>
          <h3>What I'm building &amp; where I work.</h3>
          <p class="explore-desc">
            pdfonweb, leaselylite, Karibu Camps &amp; Lodges,
            Scholar Africa — what they are and what I do on them.
          </p>
          <span class="explore-cta">Open Ventures <span aria-hidden="true">→</span></span>
        </a>

        <a class="explore-tile" href="/about/">
          <p class="explore-eyebrow">02 · About</p>
          <h3>One operator, three time zones of work.</h3>
          <span class="explore-cta">Read About <span aria-hidden="true">→</span></span>
        </a>

        <a class="explore-tile" href="/stack/">
          <p class="explore-eyebrow">03 · Stack</p>
          <h3>The tools I use day-to-day.</h3>
          <span class="explore-cta">See the Stack <span aria-hidden="true">→</span></span>
        </a>

        <a class="explore-tile" href="/services/">
          <p class="explore-eyebrow">04 · Services</p>
          <h3>How I work with clients, on the side.</h3>
          <span class="explore-cta">See Services <span aria-hidden="true">→</span></span>
        </a>

        <a class="explore-tile explore-tile--quiet" href="/now/">
          <p class="explore-eyebrow">05 · Now</p>
          <h3>What I'm actually focused on this month.</h3>
          <span class="explore-cta">Read /now <span aria-hidden="true">→</span></span>
        </a>
      </div>
    </div>
  </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
