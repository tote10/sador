import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/*
 * Prevent double form submissions.
 *
 * If a user clicks a submit button several times in quick succession (e.g. while
 * the page is reloading), the browser fires one submit event per click and the
 * server receives multiple identical requests — creating duplicate records or
 * sending duplicate messages. This guard lets the first submission through and
 * blocks every subsequent one until the page navigates away.
 *
 * Runs in the capture phase so it fires before any other submit handler. Note
 * that HTML5 validation failures never fire a submit event, so an invalid form
 * is not locked, and programmatic form.submit() calls bypass this entirely.
 */
document.addEventListener(
    'submit',
    function (e) {
        const form = e.target;
        if (!(form instanceof HTMLFormElement)) return;

        // Block any submission after the first one.
        if (form.dataset.submitting === 'true') {
            e.preventDefault();
            return;
        }
        form.dataset.submitting = 'true';

        // Disable submit buttons. Deferred to the next tick so the clicked
        // button's name/value is still included in this submission.
        const buttons = form.querySelectorAll(
            'button[type="submit"], button:not([type]), input[type="submit"]'
        );
        setTimeout(function () {
            buttons.forEach(function (btn) {
                btn.disabled = true;
                btn.classList.add('opacity-60', 'cursor-not-allowed');
            });
        }, 0);
    },
    true
);

/*
 * Re-enable forms when a page is restored from the back/forward cache. Without
 * this, navigating "back" to a form would leave its buttons permanently locked.
 */
window.addEventListener('pageshow', function (e) {
    if (!e.persisted) return;
    document.querySelectorAll('form[data-submitting="true"]').forEach(function (form) {
        form.dataset.submitting = 'false';
        form
            .querySelectorAll('button[type="submit"], button:not([type]), input[type="submit"]')
            .forEach(function (btn) {
                btn.disabled = false;
                btn.classList.remove('opacity-60', 'cursor-not-allowed');
            });
    });
});
