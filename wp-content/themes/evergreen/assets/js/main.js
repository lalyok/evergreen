// Main JS for Evergreen theme
(function (){
  'use strict';
  // Phone input mask: "+7 (999) - 999 - 99 - 99"
  function setCursorPosition(pos, el) {
    el.focus();
    if (el.setSelectionRange) el.setSelectionRange(pos, pos);
    else if (el.createTextRange) {
      var range = el.createTextRange();
      range.collapse(true);
      range.moveEnd('character', pos);
      range.moveStart('character', pos);
      range.select();
    }
  }

  function maskPhone(event) {
    var matrix = '+7 (___)-___-__-__';
    var i = 0;
    var def = matrix.replace(/\D/g, '');
    var val = this.value.replace(/\D/g, '');
    if (def.length >= val.length) val = def;
    this.value = matrix.replace(/./g, function(a) {
      return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? '' : a;
    });
    // ensure cursor stays after the last entered digit
    var firstPlaceholder = this.value.indexOf('_');
    if (firstPlaceholder !== -1) {
      setCursorPosition(this.value.indexOf('_'), this);
    } else {
      // move cursor to end
      setCursorPosition(this.value.length, this);
    }
  }

  function onPhoneFocus(e) {
    var el = e.target;
    if (!el.value) el.value = '+7 ('; // start template
    setTimeout(function(){
      // ensure cursor after prefix
      var pos = el.value.indexOf('_');
      if (pos === -1) pos = el.value.length;
      setCursorPosition(pos, el);
    }, 0);
  }

  function onPhoneBlur(e) {
    var el = e.target;
    // if only prefix present, clear field
    if (el.value === '+7 (' || el.value.replace(/\D/g, '').length <= 1) el.value = '';
  }

  document.addEventListener('DOMContentLoaded', function(){
    var phones = document.querySelectorAll('input.contact-form__input[type="tel"]');
    phones.forEach(function(input){
      input.addEventListener('input', maskPhone, false);
      input.addEventListener('focus', onPhoneFocus, false);
      input.addEventListener('blur', onPhoneBlur, false);
      input.addEventListener('keydown', function(e){
        // allow navigation keys
        var keys = [8,46,37,39,9]; // backspace, delete, left, right, tab
        if (keys.indexOf(e.keyCode) !== -1) return;
      }, false);
    });
  });

  // Format displayed phone numbers for anchors and text nodes
  function formatPhoneDigits(digits) {
    // Expect digits string like "79991234567" or similar
    if (!digits) return '';
    var d = digits.replace(/\D/g, '');
    if (d.length === 0) return '';
    var country = d.charAt(0) || '';
    var p1 = d.slice(1,4);
    var p2 = d.slice(4,7);
    var p3 = d.slice(7,9);
    var p4 = d.slice(9,11);
    var out = '+' + country;
    if (p1) out += ' (' + p1 + ')';
    if (p2) out += '-' + p2;
    if (p3) out += '-' + p3;
    if (p4) out += '-' + p4;
    return out;
  }

  function normalizeTelHref(digits) {
    var d = digits.replace(/\D/g, '');
    if (!d) return '';
    return '+' + d;
  }

  document.addEventListener('DOMContentLoaded', function(){
    // find all tel links and format their text content and href
    var telLinks = document.querySelectorAll('a[href^="tel:"]');
    telLinks.forEach(function(a){
      var href = a.getAttribute('href') || '';
      var raw = href.replace(/^tel:\+?/, '') || a.textContent || '';
      var digits = raw.replace(/\D/g, '');
      if (!digits) return;
      // if number begins with country+ and user wants first digit as country
      var formatted = formatPhoneDigits(digits);
      var normalized = normalizeTelHref(digits);
      a.setAttribute('href', 'tel:' + normalized);
      a.textContent = formatted;
    });
  });

  /* Responsive burger menu behavior
     - add 'js' class to <html> so CSS can hide inline nav on small screens
     - toggle mobile menu open/close
  */
  document.addEventListener('DOMContentLoaded', function(){
    document.documentElement.classList.add('js');
    var burger = document.querySelector('.burger-toggle');
    var menu = document.getElementById('site-navigation');
    if (!burger || !menu) return;

    function openMenu() {
      menu.classList.add('is-open');
      burger.classList.add('is-active');
      menu.setAttribute('aria-hidden', 'false');
      burger.setAttribute('aria-expanded', 'true');
      // focus first link
      var firstLink = menu.querySelector('a');
      if (firstLink) firstLink.focus();
    }

    function closeMenu() {
      menu.classList.remove('is-open');
      burger.classList.remove('is-active');
      menu.setAttribute('aria-hidden', 'true');
      burger.setAttribute('aria-expanded', 'false');
      burger.focus();
    }

    burger.addEventListener('click', function(e){
      var isOpen = menu.classList.contains('is-open');
      if (isOpen) closeMenu(); else openMenu();
    });

    document.addEventListener('keydown', function(e){
      if (e.key === 'Escape' && menu.classList.contains('is-open')) {
        closeMenu();
      }
    });
  });

  /* Modal dialog handling (contact modal + success modal)
     - open/close by buttons
     - close by clicking outside .modal__content
     - submit contact forms via fetch and show success modal on ok
  */
  document.addEventListener('DOMContentLoaded', function(){
    var contactButtons = document.querySelectorAll('.open-modal');
    var contactModal = document.getElementById('contact-modal');
    var contactClose = document.getElementById('contact-modal-close');
    var successModal = document.getElementById('feedback-success-modal');
    var successClose = document.getElementById('feedback-success-modal-close');

    function openModal(modal) {
      if (!modal) return;
      modal.classList.add('is-open');
      modal.setAttribute('aria-hidden', 'false');
      document.body.classList.add('modal-open');
    }

    function closeModal(modal) {
      if (!modal) return;
      modal.classList.remove('is-open');
      modal.setAttribute('aria-hidden', 'true');
      // remove modal-open if no modal remains open
      var anyOpen = document.querySelector('.modal.is-open');
      if (!anyOpen) document.body.classList.remove('modal-open');
    }

    // open contact modal from header button
    if (contactButtons && contactModal) {
      contactButtons.forEach(function(button){
        button.addEventListener('click', function(e){
          e.preventDefault();
          openModal(contactModal);
        });
      });
    }

    // close contact modal
    if (contactClose && contactModal) {
      contactClose.addEventListener('click', function(e){
        e.preventDefault();
        closeModal(contactModal);
      });
    }

    // close success modal
    if (successClose && successModal) {
      successClose.addEventListener('click', function(e){
        e.preventDefault();
        closeModal(successModal);
      });
    }

    // click outside modal__content closes modal
    [contactModal, successModal].forEach(function(modal){
      if (!modal) return;
      modal.addEventListener('click', function(e){
        // if click is outside .modal__content
        if (!e.target.closest('.modal__content')) {
          closeModal(modal);
        }
      });
    });

    // handle all contact-form submissions via AJAX so we can show success modal
    var forms = document.querySelectorAll('form.contact-form');
    forms.forEach(function(form){
      form.addEventListener('submit', function(e){
        e.preventDefault();
        var fd = new FormData(form);
        var action = form.getAttribute('action') || window.location.href;
        fetch(action, {
          method: 'POST',
          body: fd,
          credentials: 'same-origin'
        }).then(function(resp){
          if (resp.ok) {
            // if contact modal is open, close it
            if (contactModal && contactModal.classList.contains('is-open')) {
              closeModal(contactModal);
            }
            // open success modal
            if (successModal) openModal(successModal);
            // optionally reset the form
            try { form.reset(); } catch (err) {}
          } else {
            // non-ok response — still try to show success? keep it simple: show success only on ok
            console.warn('Form submit returned non-ok status', resp.status);
          }
        }).catch(function(err){
          console.error('Form submit failed', err);
        });
      });
    });
  });
})();
