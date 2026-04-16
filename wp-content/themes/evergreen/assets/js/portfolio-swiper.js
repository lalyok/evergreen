document.addEventListener('DOMContentLoaded', function () {
    var sliderElMain = document.querySelector('.portfolio__main-slider');
    var sliderElThumbs = document.querySelector('.portfolio__thumbs-slider');
    if (!sliderElMain || !sliderElThumbs) return;

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
