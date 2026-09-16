// suryateja.pro — chrome behaviour ported from tarkashila.com + contact form.

(function () {
  'use strict';

  // Footer year
  var yearEl = document.getElementById('footer-year');
  if (yearEl) yearEl.textContent = String(new Date().getFullYear());

  // Header menu pill toggle
  var hdrMenu = document.getElementById('hdr-menu');
  var hdrToggle = hdrMenu && hdrMenu.querySelector('.hdr-toggle');
  var hdrLabel = hdrToggle && hdrToggle.querySelector('.hdr-toggle-label');
  if (hdrMenu && hdrToggle) {
    var setHdr = function (open) {
      hdrMenu.classList.toggle('is-open', open);
      hdrToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (hdrLabel) hdrLabel.textContent = open ? 'Close' : 'Menu';
    };
    hdrToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      setHdr(!hdrMenu.classList.contains('is-open'));
    });
    document.addEventListener('click', function (e) {
      if (hdrMenu.classList.contains('is-open') && !hdrMenu.contains(e.target)) setHdr(false);
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setHdr(false); });
    hdrMenu.querySelectorAll('.hdr-links a').forEach(function (a) {
      a.addEventListener('click', function () { setHdr(false); });
    });
  }

  // Footer nav pill toggle
  var fnav = document.getElementById('fnavpill');
  var fnavToggle = fnav && fnav.querySelector('.fnav-toggle');
  if (fnav && fnavToggle) {
    fnavToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      var open = !fnav.classList.contains('is-open');
      fnav.classList.toggle('is-open', open);
      fnavToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    document.addEventListener('click', function (e) {
      if (fnav.classList.contains('is-open') && !fnav.contains(e.target)) {
        fnav.classList.remove('is-open');
        fnavToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // Back to top
  var btop = document.querySelector('.bento-ftr .btop');
  if (btop) {
    btop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // Header hide-on-scroll-down, show-on-scroll-up
  var logo = document.querySelector('.hdr-logo');
  var menu = document.querySelector('.hdr-menu');
  if (logo && menu) {
    var lastY = window.scrollY, ticking = false;
    var onScroll = function () {
      var y = window.scrollY;
      var hide = y > 120 && y > lastY;
      // don't hide while the menu is open
      if (!menu.classList.contains('is-open')) {
        logo.classList.toggle('is-hidden', hide);
        menu.classList.toggle('is-hidden', hide);
      }
      lastY = y;
      ticking = false;
    };
    window.addEventListener('scroll', function () {
      if (!ticking) { window.requestAnimationFrame(onScroll); ticking = true; }
    }, { passive: true });
  }

  // Scroll reveal (mt-reveal) + fade-in
  var reveals = document.querySelectorAll('.mt-reveal, .fade-in');
  if ('IntersectionObserver' in window && reveals.length) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view', 'is-visible');
          io.unobserve(entry.target);
        }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.05 });
    reveals.forEach(function (el) { io.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('in-view', 'is-visible'); });
  }

  // Contact form
  var form = document.getElementById('contact-form');
  if (!form) return;

  var status = form.querySelector('.form-status');
  var button = form.querySelector('button[type="submit"]');
  var defaultLabel = button ? button.dataset.defaultLabel || button.textContent : '';

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    if (!form.checkValidity()) {
      status.textContent = 'Please fill the required fields.';
      status.classList.remove('is-success');
      status.classList.add('is-error');
      form.reportValidity();
      return;
    }

    var data = {
      name: form.name.value.trim(),
      email: form.email.value.trim(),
      message: form.message.value.trim(),
      company: form.company.value
    };

    button.disabled = true;
    button.textContent = 'Sending…';
    status.textContent = '';
    status.classList.remove('is-success', 'is-error');

    fetch('/api/contact.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
      .then(function (res) {
        return res.json().then(function (body) {
          if (!res.ok) throw new Error(body && body.error ? body.error : 'Request failed');
          return body;
        });
      })
      .then(function () {
        form.reset();
        status.textContent = 'Thanks — message received. I\'ll reply from emailsuryateja.m@gmail.com.';
        status.classList.add('is-success');
      })
      .catch(function (err) {
        status.textContent = err.message || 'Something went wrong. Try emailing me directly.';
        status.classList.add('is-error');
      })
      .finally(function () {
        button.disabled = false;
        button.textContent = defaultLabel;
      });
  });
})();
