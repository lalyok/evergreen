document.addEventListener('DOMContentLoaded', function () {
  var sliderEl = document.querySelector('.projects__slider > .swiper');
  if (!sliderEl) return;

  var projectsSwiper = new Swiper(sliderEl, {
    slidesPerView: 1,
    loop: true,
    navigation: {
      nextEl: '.projects__slider-next',
      prevEl: '.projects__slider-prev',
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      renderBullet: function (index, className) {
        return '<span class="' + className + '">' + "</span>";
      },
    },
    observer: true,
    observeParents: true,
  });
});
