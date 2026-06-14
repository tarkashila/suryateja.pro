<?php
// Shared site header + primary nav + mobile-nav scaffold.
// Pages set $current_page to one of: 'home', 'about', 'ventures', 'stack',
// 'services', 'contact', 'now' — used for aria-current on the active link.
$current_page = $current_page ?? '';

$nav_items = [
  ['slug' => 'about',    'href' => '/about/',    'label' => 'About'],
  ['slug' => 'ventures', 'href' => '/ventures/', 'label' => 'Ventures'],
  ['slug' => 'stack',    'href' => '/stack/',    'label' => 'Stack'],
  ['slug' => 'services', 'href' => '/services/', 'label' => 'Services'],
  ['slug' => 'contact',  'href' => '/contact/',  'label' => 'Contact'],
];
?>
<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="/" aria-label="Suryateja Manchikatla — home">
      <span class="brand-mark">ST</span>
      <span class="brand-word">Suryateja</span>
    </a>
    <nav class="primary-nav" aria-label="Primary">
      <?php foreach ($nav_items as $item): ?>
        <a href="<?= $item['href'] ?>"<?= $current_page === $item['slug'] ? ' aria-current="page"' : '' ?>><?= $item['label'] ?></a>
      <?php endforeach; ?>
    </nav>
    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="mobile-nav" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>
  </div>
  <nav id="mobile-nav" class="mobile-nav" aria-label="Mobile" hidden>
    <?php foreach ($nav_items as $item): ?>
      <a href="<?= $item['href'] ?>"<?= $current_page === $item['slug'] ? ' aria-current="page"' : '' ?>><?= $item['label'] ?></a>
    <?php endforeach; ?>
  </nav>
</header>
