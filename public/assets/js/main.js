(function () {
  'use strict';

  // ---------- Navbar scroll + mobile toggle ----------
  var navbar = document.getElementById('navbar');
  var navToggle = document.getElementById('navToggle');
  var navLinks = document.getElementById('navLinks');

  function onScroll() {
    if (!navbar) return;
    if (window.scrollY > 30) navbar.classList.add('is-scrolled');
    else navbar.classList.remove('is-scrolled');
  }
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  if (navToggle && navLinks) {
    navToggle.addEventListener('click', function () {
      navLinks.classList.toggle('is-open');
    });
    navLinks.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () { navLinks.classList.remove('is-open'); });
    });
  }

  // ---------- Reveal on scroll ----------
  var revealEls = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('is-visible'); });
  }

  // ---------- FAQ accordion ----------
  document.querySelectorAll('.faq-item').forEach(function (item) {
    var q = item.querySelector('.faq-q');
    if (!q) return;
    q.addEventListener('click', function () {
      var wasOpen = item.classList.contains('is-open');
      document.querySelectorAll('.faq-item.is-open').forEach(function (o) { o.classList.remove('is-open'); });
      if (!wasOpen) item.classList.add('is-open');
    });
  });

  // ---------- Order form: trip type toggle ----------
  var form = document.getElementById('orderForm');
  if (form) {
    var typeRadios = form.querySelectorAll('input[name="trip_type"]');
    function applyType() {
      var val = form.querySelector('input[name="trip_type"]:checked').value;
      form.querySelectorAll('.field-block').forEach(function (block) {
        var isActive = block.dataset.block === val;
        block.classList.toggle('is-active', isActive);
        block.querySelectorAll('input[type="text"]').forEach(function (input) {
          input.required = isActive;
        });
      });
    }
    typeRadios.forEach(function (r) { r.addEventListener('change', applyType); });
    applyType();

    var dateInput = document.getElementById('preferredDate');
    if (dateInput) {
      var today = new Date().toISOString().split('T')[0];
      dateInput.setAttribute('min', today);
    }

    // ---------- Submit via fetch, reveal 2-step confirmation ----------
    var confirmPanel = document.getElementById('confirmPanel');
    var confirmWaLink = document.getElementById('confirmWaLink');
    var confirmMessengerLink = document.getElementById('confirmMessengerLink');
    var submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (submitBtn) submitBtn.setAttribute('disabled', 'disabled');

      fetch(form.getAttribute('action'), {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: new FormData(form)
      })
        .then(function (res) { return res.json(); })
        .then(function (data) {
          if (!data.success) {
            if (submitBtn) submitBtn.removeAttribute('disabled');
            alert('Merci de vérifier votre nom et votre numéro de téléphone.');
            return;
          }
          form.style.display = 'none';
          if (confirmWaLink) confirmWaLink.setAttribute('href', data.whatsapp_url);
          if (confirmMessengerLink && data.messenger_url) confirmMessengerLink.setAttribute('href', data.messenger_url);
          if (confirmPanel) confirmPanel.classList.add('is-active');
          confirmPanel.scrollIntoView({ behavior: 'smooth', block: 'center' });

          setTimeout(function () {
            if (data.whatsapp_url) window.open(data.whatsapp_url, '_blank');
          }, 1200);
        })
        .catch(function () {
          if (submitBtn) submitBtn.removeAttribute('disabled');
          alert('Une erreur est survenue, merci de réessayer.');
        });
    });
  }
})();
