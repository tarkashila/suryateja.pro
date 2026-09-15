<?php
// Header ported from tarkashila.com — floating brand pill + "Menu" pill.
// $current_page drives aria-current on the active link.
$current_page = $current_page ?? '';

$nav_items = [
  ['slug' => 'about',    'href' => '/about/',    'label' => 'About'],
  ['slug' => 'ventures', 'href' => '/ventures/', 'label' => 'Ventures'],
  ['slug' => 'stack',    'href' => '/stack/',    'label' => 'Stack'],
  ['slug' => 'services', 'href' => '/services/', 'label' => 'Services'],
  ['slug' => 'contact',  'href' => '/contact/',  'label' => 'Contact'],
];
?>
<div class="hdr-logo">
  <a class="nav-logo" href="/" aria-label="Suryateja Manchikatla — home">
    <span class="mk" aria-hidden="true">S.</span><span>Suryateja</span>
  </a>
</div>
<div class="hdr-menu" id="hdr-menu">
  <div class="hdr-links">
    <nav class="hdr-links-inner" aria-label="Primary">
      <?php foreach ($nav_items as $item): ?>
        <a href="<?= $item['href'] ?>"<?= $current_page === $item['slug'] ? ' aria-current="page"' : '' ?>><?= $item['label'] ?></a>
      <?php endforeach; ?>
      <a class="is-cta" href="https://tarkashila.com" rel="noopener">Tarkashila →</a>
    </nav>
  </div>
  <button class="hdr-toggle" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="hdr-menu">
    <span class="hdr-toggle-label">Menu</span>
    <span class="hdr-toggle-icon" aria-hidden="true"><span></span><span></span></span>
  </button>
</div>
