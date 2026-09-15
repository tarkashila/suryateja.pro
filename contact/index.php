<?php
$page_title       = 'Contact — Suryateja Manchikatla';
$page_description = 'Say hello. Email, contact form, LinkedIn, GitHub, X, Instagram, Facebook.';
$page_canonical   = 'https://suryateja.pro/contact/';
$page_og_type     = 'website';
$current_page     = 'contact';

$page_ldjson = <<<'JSON'
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://suryateja.pro/"},
    {"@type": "ListItem", "position": 2, "name": "Contact", "item": "https://suryateja.pro/contact/"}
  ]
}
JSON;

include $_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php';
?>

<main id="main">
  <section class="section section-contact section-page fade-in">
    <div class="container narrow">
      <header class="section-head">
        <p class="eyebrow">Contact</p>
        <h1>Say hello.</h1>
        <p class="contact-lede">
          For project work, the front door is
          <a href="https://tarkashila.com" rel="noopener">Tarkashila</a>.
          For anything else, this reaches me directly. I reply within 48 hours.
        </p>
      </header>

      <form id="contact-form" class="contact-form" novalidate>
        <div class="field">
          <label for="cf-name">Name</label>
          <input id="cf-name" name="name" type="text" autocomplete="name" required maxlength="120" enterkeyhint="next" />
        </div>
        <div class="field">
          <label for="cf-email">Email</label>
          <input id="cf-email" name="email" type="email" autocomplete="email" inputmode="email" required maxlength="200" enterkeyhint="next" />
        </div>
        <div class="field">
          <label for="cf-message">Message</label>
          <textarea id="cf-message" name="message" rows="5" required maxlength="4000" enterkeyhint="send"></textarea>
        </div>
        <div class="field hp" aria-hidden="true">
          <label for="cf-company">Company</label>
          <input id="cf-company" name="company" type="text" tabindex="-1" autocomplete="off" />
        </div>
        <button class="btn btn-primary" type="submit" data-default-label="Send message">Send message</button>
        <p class="form-status" role="status" aria-live="polite"></p>
      </form>

      <ul class="contact-links" aria-label="Other ways to reach me">
        <li>
          <a href="https://github.com/tarkashila" rel="noopener" aria-label="GitHub — Tarkashila">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M12 .5C5.65.5.5 5.65.5 12c0 5.08 3.29 9.39 7.86 10.91.58.1.79-.25.79-.56v-2c-3.2.7-3.87-1.36-3.87-1.36-.52-1.33-1.28-1.68-1.28-1.68-1.05-.72.08-.7.08-.7 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.71 1.26 3.37.96.1-.75.4-1.26.73-1.55-2.55-.29-5.24-1.28-5.24-5.69 0-1.26.45-2.28 1.18-3.08-.12-.29-.51-1.46.11-3.04 0 0 .97-.31 3.17 1.18a10.99 10.99 0 0 1 5.78 0c2.2-1.49 3.17-1.18 3.17-1.18.63 1.58.23 2.75.11 3.04.74.8 1.18 1.82 1.18 3.08 0 4.42-2.69 5.39-5.26 5.68.41.36.78 1.06.78 2.14v3.18c0 .31.21.67.8.56C20.22 21.38 23.5 17.08 23.5 12 23.5 5.65 18.35.5 12 .5Z"/></svg>
            <span>GitHub</span>
          </a>
        </li>
        <li>
          <a href="https://www.linkedin.com/in/suryateja-ai/" rel="noopener" aria-label="LinkedIn">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5ZM.25 8h4.5v15h-4.5V8Zm7.5 0h4.3v2.05h.06c.6-1.13 2.07-2.32 4.26-2.32 4.56 0 5.4 3 5.4 6.9V23h-4.5v-7.16c0-1.71-.03-3.91-2.38-3.91-2.38 0-2.74 1.86-2.74 3.78V23h-4.5V8Z"/></svg>
            <span>LinkedIn</span>
          </a>
        </li>
        <li>
          <a href="https://x.com/suryatejaaibuff" rel="noopener" aria-label="X (Twitter)">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M18.244 2H21.5l-7.5 8.57L23 22h-6.93l-5.43-7.1L4.4 22H1.14l8.04-9.19L1 2h7.1l4.91 6.49L18.244 2Zm-1.214 18h1.92L7.05 4H5.02l12.01 16Z"/></svg>
            <span>X</span>
          </a>
        </li>
        <li>
          <a href="https://www.instagram.com/suryateja_manchikatla/" rel="noopener" aria-label="Instagram">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M12 2.2c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.22.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.05.41 2.22.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.22-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.05.36-2.22.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.22-.41a3.72 3.72 0 0 1-1.38-.9 3.72 3.72 0 0 1-.9-1.38c-.16-.42-.36-1.05-.41-2.22C2.21 15.58 2.2 15.2 2.2 12s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.22.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.05-.36 2.22-.41C8.42 2.21 8.8 2.2 12 2.2Zm0 1.8c-3.14 0-3.51.01-4.75.07-1.02.05-1.57.22-1.94.36-.49.19-.84.42-1.21.79-.37.37-.6.72-.79 1.21-.14.37-.31.92-.36 1.94C3.01 8.49 3 8.86 3 12s.01 3.51.07 4.75c.05 1.02.22 1.57.36 1.94.19.49.42.84.79 1.21.37.37.72.6 1.21.79.37.14.92.31 1.94.36 1.24.06 1.61.07 4.75.07s3.51-.01 4.75-.07c1.02-.05 1.57-.22 1.94-.36.49-.19.84-.42 1.21-.79.37-.37.6-.72.79-1.21.14-.37.31-.92.36-1.94.06-1.24.07-1.61.07-4.75s-.01-3.51-.07-4.75c-.05-1.02-.22-1.57-.36-1.94a3.27 3.27 0 0 0-.79-1.21 3.27 3.27 0 0 0-1.21-.79c-.37-.14-.92-.31-1.94-.36C15.51 4.01 15.14 4 12 4Zm0 3.05a4.95 4.95 0 1 1 0 9.9 4.95 4.95 0 0 1 0-9.9Zm0 1.8a3.15 3.15 0 1 0 0 6.3 3.15 3.15 0 0 0 0-6.3Zm5.15-2.05a1.15 1.15 0 1 1 0 2.3 1.15 1.15 0 0 1 0-2.3Z"/></svg>
            <span>Instagram</span>
          </a>
        </li>
        <li>
          <a href="https://www.facebook.com/share/1BN1rS27oD/" rel="noopener" aria-label="Facebook">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.787 4.659-4.787 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg>
            <span>Facebook</span>
          </a>
        </li>
        <li>
          <a href="mailto:emailsuryateja.m@gmail.com" aria-label="Email">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M3 5h18a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm9 8.18 8.4-5.18H3.6L12 13.18ZM4 9.42V18h16V9.42l-7.47 4.6a1 1 0 0 1-1.06 0L4 9.42Z"/></svg>
            <span>emailsuryateja.m@gmail.com</span>
          </a>
        </li>
      </ul>
    </div>
  </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'; ?>
