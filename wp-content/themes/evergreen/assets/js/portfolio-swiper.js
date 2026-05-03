document.addEventListener('DOMContentLoaded', function () {
    var mainSliders = Array.prototype.slice.call(document.querySelectorAll('.portfolio__main-slider'));
    var allThumbs = Array.prototype.slice.call(document.querySelectorAll('.portfolio__thumbs-slider'));
    if (!mainSliders.length) return;

    // Initialize each pair: try to find a thumbs slider inside the same .portfolio ancestor,
    // otherwise fall back to thumbs by index.
    mainSliders.forEach(function (sliderElMain, idx) {
        var sliderElThumbs = null;
        var parent = sliderElMain.closest('.portfolio__slider') || sliderElMain.parentElement;
        if (parent) sliderElThumbs = parent.querySelector('.portfolio__thumbs-slider');
        if (!sliderElThumbs) sliderElThumbs = allThumbs[idx] || null;
        if (!sliderElThumbs) return; // no matching thumbs, skip

        // Thumbs swiper: use freeMode + watchSlidesProgress/watchSlidesVisibility
        // and a reasonable slidesPerView so thumbnails fit the container.
        var portfolioSwiperThumbs = new Swiper(sliderElThumbs, {
            slidesPerView: 4,
            loop: true,
            spaceBetween: 20,
            freeMode: true,
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
            observer: true,
            observeParents: true,
        });

        // Main swiper linked to its thumbs instance
        var portfolioSwiperMain = new Swiper(sliderElMain, {
            slidesPerView: 1,
            loop: true,
            observer: true,
            observeParents: true,
            // allow clicking a thumb to change main slide
            slideToClickedSlide: true,
            thumbs: {
                swiper: portfolioSwiperThumbs,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + "</span>";
                },
            }
        });
    });
});
