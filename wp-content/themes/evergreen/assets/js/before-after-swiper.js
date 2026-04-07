document.addEventListener('DOMContentLoaded', function () {
  var sliderEl = document.querySelector('.before-after__slider > .swiper');
  if (!sliderEl) return;

  var beforeAfterSwiper = new Swiper(sliderEl, {
    slidesPerView: 2,
    slidesPerGroup: 2,
    spaceBetween: 100,
    loop: true,
    navigation: {
      nextEl: '.before-after__slider-next',
      prevEl: '.before-after__slider-prev',
    },
    observer: true,
    observeParents: true,
    breakpoints: {
      993: {
        slidesPerView: 2,
        slidesPerGroup: 2,
      },
      769: {
        slidesPerView: 2,
        slidesPerGroup: 2,
      },
      0: {
        slidesPerView: 1,
        slidesPerGroup: 1,
      }
    }
  });
});
