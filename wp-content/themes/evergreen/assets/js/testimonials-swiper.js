document.addEventListener('DOMContentLoaded', function () {
  var sliderEl = document.querySelector('.testimonials__slider .swiper');
  if (!sliderEl) return;
  if (typeof Swiper === 'undefined') { console.warn('Swiper not loaded'); return; }

  var testimonialsContainer = sliderEl.closest('.testimonials__slider');
  var bgEl = testimonialsContainer ? testimonialsContainer.querySelector('.testimonials__bg') : null;

  var testimonialsSwiper = new Swiper(sliderEl, {
    slidesPerView: 1,
    loop: true,
    init: false,
    navigation: {
      nextEl: '.testimonials__slider-next',
      prevEl: '.testimonials__slider-prev',
    },
    observer: true,
    observeParents: true,
  });

  function updateBackground(swiper) {
    if (!bgEl) return;
    // prefer the active slide element's data-bg attribute
    var active = sliderEl.querySelector('.swiper-slide-active');
    var url = active ? active.getAttribute('data-bg') : null;
    if (!url) {
      // fallback: try realIndex slide
      var realIdx = swiper.realIndex || 0;
      var slide = swiper.slides[realIdx];
      url = slide ? slide.getAttribute('data-bg') : null;
    }
    if (url) {
      // set with small fade transition
      bgEl.style.backgroundImage = 'url("' + url + '")';
      bgEl.classList.add('is-set');
    } else {
      bgEl.style.backgroundImage = '';
      bgEl.classList.remove('is-set');
    }
  }

  testimonialsSwiper.on('init', function(sw) { updateBackground(sw); });
  testimonialsSwiper.on('slideChange', function(sw) { updateBackground(sw); });
  testimonialsSwiper.on('transitionEnd', function(sw) { updateBackground(sw); });

  // initialize after listeners so 'init' is caught and background set
  testimonialsSwiper.init();
});
