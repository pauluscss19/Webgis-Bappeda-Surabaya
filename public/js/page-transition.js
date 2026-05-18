/**
 * Page Transition Handler
 * Intercepts link clicks and form submits to add smooth exit animation
 * before navigating to the next page.
 */
(function () {
  'use strict';

  const TRANSITION_MS = 280;

  // Intercept all internal link clicks
  document.addEventListener('click', function (e) {
    const link = e.target.closest('a[href]');
    if (!link) return;

    const href = link.getAttribute('href');

    // Skip: external, anchor, javascript, new-tab, or modal-related links
    if (
      !href ||
      href.startsWith('#') ||
      href.startsWith('javascript:') ||
      href.startsWith('mailto:') ||
      link.target === '_blank' ||
      link.hasAttribute('download') ||
      e.ctrlKey || e.metaKey || e.shiftKey ||
      link.closest('.crud-modal-overlay') ||
      link.classList.contains('crud-alert__close')
    ) {
      return;
    }

    // Only intercept same-origin links
    try {
      const url = new URL(href, window.location.origin);
      if (url.origin !== window.location.origin) return;
    } catch (_) {
      return;
    }

    e.preventDefault();
    document.body.classList.add('page-leaving');

    setTimeout(function () {
      window.location.href = href;
    }, TRANSITION_MS);
  });

  // Intercept form submissions (for filter forms, not delete/create)
  document.addEventListener('submit', function (e) {
    const form = e.target;

    // Skip delete forms (inside modals) and forms with method != GET
    if (
      form.closest('.crud-modal-overlay') ||
      (form.method && form.method.toUpperCase() !== 'GET')
    ) {
      return;
    }

    // Only add transition for filter/search forms
    if (form.classList.contains('crud-filters')) {
      document.body.classList.add('page-leaving');
    }
  });

  // Handle browser back/forward (remove leaving class on popstate)
  window.addEventListener('pageshow', function (e) {
    if (e.persisted) {
      document.body.classList.remove('page-leaving');
    }
  });
})();
