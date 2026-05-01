document.addEventListener('DOMContentLoaded', function () {
    function waitForShared(timeout = 5000) {
        return new Promise((resolve, reject) => {
            if (window.__PhotoSwipeShared) return resolve(window.__PhotoSwipeShared);
            var waited = 0;
            var iv = setInterval(function () {
                if (window.__PhotoSwipeShared) {
                    clearInterval(iv);
                    resolve(window.__PhotoSwipeShared);
                }
                waited += 50;
                if (waited >= timeout) {
                    clearInterval(iv);
                    reject(new Error('PhotoSwipe shared loader timeout'));
                }
            }, 50);
        });
    }

    waitForShared().then(function (shared) {
        if (!shared || !shared.PhotoSwipeLightbox) return;

        var lightboxMain = new shared.PhotoSwipeLightbox({
            gallery: '.portfolio__main-slider',
            children: 'a.pswp-link',
            pswpModule: shared.pswpModule
        });

        lightboxMain.init();
    }).catch(function (err) {
        console.error('PhotoSwipe init failed', err);
    });
});