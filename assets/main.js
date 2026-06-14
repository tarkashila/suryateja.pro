// suryateja.pro — minimal client JS: scroll-fade, header state, mobile nav, contact form.

(function () {
  'use strict';

  // Footer year
  var yearEl = document.getElementById('footer-year');
  if (yearEl) yearEl.textContent = String(new Date().getFullYear());

  // Header scroll state
  var header = document.querySelector('.site-header');
  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 8);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // Mobile nav
  var toggle = document.querySelector('.nav-toggle');
  var mobileNav = document.getElementById('mobile-nav');
  if (toggle && mobileNav) {
    toggle.addEventListener('click', function () {
      var open = mobileNav.dataset.open === 'true';
      mobileNav.dataset.open = open ? 'false' : 'true';
      mobileNav.hidden = open;
      toggle.setAttribute('aria-expanded', open ? 'false' : 'true');
    });
    mobileNav.addEventListener('click', function (e) {
      if (e.target.tagName === 'A') {
        mobileNav.dataset.open = 'false';
        mobileNav.hidden = true;
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // Scroll fade
  var fades = document.querySelectorAll('.fade-in');
  if ('IntersectionObserver' in window && fades.length) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.05 });
    fades.forEach(function (el) { io.observe(el); });
  } else {
    fades.forEach(function (el) { el.classList.add('is-visible'); });
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
