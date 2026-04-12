<section class="section before-after" aria-label="До и После">
  <div class="container">
    <div class="section__title-wrapper">
      <h2 class="section__title">До / После</h2>
    </div>
    <div class="slider before-after__slider">
      <button class="slider-prev before-after__slider-prev" aria-label="Предыдущий слайд">
        <svg class="slider-prev-icon" width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="37" cy="37" r="35" transform="matrix(1 -8.74228e-08 -8.74228e-08 -1 7.62939e-06 74)" stroke="currentColor"/>
        <path d="M44 16L20 37L44 58" stroke-linecap="round" stroke-linejoin="round" stroke="CurrentColor"/>
        </svg>
      </button>
  
      <div class="swiper">
        <div class="swiper-wrapper">
  
        <?php
          $photos = get_posts( array(
            'numberposts' => -1,
            'category'    => 0,
            'orderby'     => 'date',
            'order'       => 'ASC',
            'include'     => array(),
            'exclude'     => array(),
            'meta_key'    => '',
            'meta_value'  =>'',
            'post_type'   => 'before-after',
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
          ) );
  
          global $photo;
  
          foreach( $photos as $photo ){
            setup_postdata( $photo );
            ?>

            <div class="swiper-slide before-after__slides-wrapper">
              <div class="before-after__photo-wrapper">
                <img class="before-after__photo" src="<?php echo esc_url(get_field( 'before-photo', $photo -> ID)['url']); ?>" alt="<?php echo esc_attr(get_field( 'before-photo', $photo -> ID)['alt']); ?>">
              </div>

              <div class="before-after__arrow"></div>

              <div class="before-after__photo-wrapper">
                <img class="before-after__photo" src="<?php echo esc_url(get_field( 'after-photo', $photo -> ID)['url']); ?>" alt="<?php echo esc_attr(get_field( 'after-photo', $photo -> ID)['alt']); ?>">
              </div>
            </div>
  
            <?php  
          }
  
          wp_reset_postdata(); // сброс
  
        ?>
        </div>

        <div class="swiper-pagination"></div>
  
        <!-- Swiper navigation -->
        
      </div>
      <button class="slider-next before-after__slider-next" aria-label="Следующий слайд">
        <svg class="slider-next-icon" width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="37" cy="37" r="35" transform="rotate(-180 37 37)" stroke="currentColor"/>
        <path d="M30 16L54 37L30 58" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"/>
        </svg>

      </button>
  </div>
</section>
