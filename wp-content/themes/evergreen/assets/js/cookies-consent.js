/* Cookie consent: single universal consent and deferred script loader stub
    - stores consent in localStorage under 'evergreen_cookie_consent' = 'accepted'|'rejected'
    - future third-party scripts should be added with attribute `data-cookie="deferred"` and
      `data-src="<script-src>"` or as <script type="text/plain" data-cookie="deferred" data-src="..."> to be loaded later
*/
document.addEventListener('DOMContentLoaded', function(){
  var banner = document.getElementById('cookie-banner');
  var acceptBtn = document.getElementById('cookie-accept');
  var key = 'evergreen_cookie_consent';

  function getConsent() {
    try { return localStorage.getItem(key); } catch (e) { return null; }
  }
  function setConsent(val) {
    try { localStorage.setItem(key, val); } catch (e) {}
  }

  function showBanner() {
    if (!banner) return;
    banner.setAttribute('aria-hidden', 'false');
    banner.classList.add('is-open');
    // focus the accept button for keyboard users
    var btn = acceptBtn || banner.querySelector('button');
    if (btn) btn.focus();
  }

  function hideBanner() {
    if (!banner) return;
    banner.setAttribute('aria-hidden', 'true');
    banner.classList.remove('is-open');
  }

  function loadDeferredScripts() {
    // Stub: find scripts annotated for deferred loading and inject them.
    // Future trackers should be included like: <script data-cookie="deferred" data-src="https://..." ></script>
    var deferred = document.querySelectorAll('script[data-cookie="deferred"]');
    deferred.forEach(function(node){
      // if node already has src, skip
      var src = node.getAttribute('data-src') || node.getAttribute('src');
      if (!src) return;
      var s = document.createElement('script');
      s.src = src;
      s.async = node.hasAttribute('data-async') || false;
      // copy type if provided
      var type = node.getAttribute('data-type');
      if (type) s.type = type;
      document.head.appendChild(s);
      // remove placeholder node
      node.parentNode && node.parentNode.removeChild(node);
    });
  }

  // initialize: if accepted -> load scripts; if not set -> show banner
  var consent = getConsent();
  if (consent === 'accepted') {
    loadDeferredScripts();
  } else if (!consent) {
    showBanner();
  }

  if (acceptBtn) acceptBtn.addEventListener('click', function(e){
    e.preventDefault();
    setConsent('accepted');
    hideBanner();
    loadDeferredScripts();
  });
});
