(async function(){
  try {
    const { default: PhotoSwipeLightbox } = await import('https://unpkg.com/photoswipe@5/dist/photoswipe-lightbox.esm.js');
    const pswpModule = () => import('https://unpkg.com/photoswipe@5/dist/photoswipe.esm.js');

    // expose a shared object that other scripts can wait for
    window.__PhotoSwipeShared = { PhotoSwipeLightbox, pswpModule };
  } catch (err) {
    console.error('Failed to load PhotoSwipe shared modules', err);
    window.__PhotoSwipeShared = null;
  }
})();
