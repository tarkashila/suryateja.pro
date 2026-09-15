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
        <h1 class="hero-creed">I build software.<br />Then I <span class="accent">run</span> it.</h1>
        <p class="lede">
          I'm the founder of <a href="https://tarkashila.com" rel="noopener">Tarkashila</a>,
          a studio that ships and operates its own products, including
          <a href="https://pdfonweb.com" rel="noopener">pdfonweb</a> and
          <a href="https://leaselylite.com" rel="noopener">leaselylite</a>.
          Because I run what I build, I know what software looks like under
          real-world pressure, not just at handover.
        </p>
        <div class="hero-ctas">
          <a class="btn btn-primary" href="/ventures/">See what I'm building</a>
          <a class="btn btn-ghost" href="/contact/">Start a conversation</a>
        </div>
        <p class="hero-meta">
          <b>Hyderabad &amp; East Africa</b>
          <span class="sep" aria-hidden="true">/</span>
          <span>product, engineering, CRM, SEO</span>
          <span class="sep" aria-hidden="true">/</span>
          <span>one operator, end to end</span>
        </p>
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
          <h3>What I'm building at Tarkashila.</h3>
          <p class="explore-desc">
            pdfonweb, leaselylite, and the work across the studio —
            plus where I partner outside it. What each is, and what I do on it.
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
          <h3>How I work with clients through Tarkashila.</h3>
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
