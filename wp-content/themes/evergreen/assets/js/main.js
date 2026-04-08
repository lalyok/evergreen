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
})();
