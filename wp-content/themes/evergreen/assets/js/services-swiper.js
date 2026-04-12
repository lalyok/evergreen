document.addEventListener('DOMContentLoaded', function () {
  var sliderEl = document.querySelector('.services__slider > .swiper');
  if (!sliderEl) return;

  var servicesSwiper = new Swiper(sliderEl, {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: true,
    navigation: {
      nextEl: '.services__slider-next',
      prevEl: '.services__slider-prev',
    },
    observer: true,
    observeParents: true,
    breakpoints: {
        1025: {
            spaceBetween: 30,
            slidesPerView: 3,
        },
        681: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        0: {
            slidesPerView: "auto",
            navigation: false,
        }
    }
  });
});
