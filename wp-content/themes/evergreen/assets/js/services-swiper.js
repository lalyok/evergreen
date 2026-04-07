document.addEventListener('DOMContentLoaded', function () {
  var sliderEl = document.querySelector('.services__slider > .swiper');
  if (!sliderEl) return;

  var servicesSwiper = new Swiper(sliderEl, {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: true,
    // centeredSlides: true,
    // centeredSlidesBounds: true,
    navigation: {
      nextEl: '.services__slider-next',
      prevEl: '.services__slider-prev',
    },
    observer: true,
    observeParents: true,
    breakpoints: {
      993: {
        slidesPerView: 3,
      },
      769: {
        slidesPerView: 2,
      },
      0: {
        slidesPerView: 1,
      }
    }
  });
});
