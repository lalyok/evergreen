document.addEventListener('DOMContentLoaded', function () {
  var sliderEl = document.querySelector('.before-after__slider > .swiper');
  if (!sliderEl) return;

  var beforeAfterSwiper = new Swiper(sliderEl, {
    slidesPerView: 1,
    loop: true,
    navigation: {
      nextEl: '.before-after__slider-next',
      prevEl: '.before-after__slider-prev',
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
