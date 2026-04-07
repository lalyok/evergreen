document.addEventListener('DOMContentLoaded', function () {
  var sliderEl = document.querySelector('.testimonials__slider .swiper');
  if (!sliderEl) return;
  if (typeof Swiper === 'undefined') { console.warn('Swiper not loaded'); return; }

  var testimonialsSwiper = new Swiper(sliderEl, {
    slidesPerView: 1,
    loop: true,
    navigation: {
      nextEl: '.testimonials__slider-next',
      prevEl: '.testimonials__slider-prev',
    },
    observer: true,
    observeParents: true,
  });
});
