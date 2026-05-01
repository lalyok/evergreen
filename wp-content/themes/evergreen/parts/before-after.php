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
                <?php
                  $before = get_field( 'before-photo', $photo->ID );
                  $before_url = is_array( $before ) && ! empty( $before['url'] ) ? $before['url'] : ( is_string( $before ) ? $before : '' );
                  $before_alt = is_array( $before ) && ! empty( $before['alt'] ) ? $before['alt'] : '';
                  $before_w = is_array( $before ) && ! empty( $before['width'] ) ? $before['width'] : '';
                  $before_h = is_array( $before ) && ! empty( $before['height'] ) ? $before['height'] : '';
                  $before_thumb = is_array( $before ) && ! empty( $before['sizes']['large'] ) ? $before['sizes']['large'] : $before_url;
                  if ( $before_url ) :
                ?>
                  <a class="pswp-link" href="<?php echo esc_url( $before_url ); ?>" data-pswp-width="<?php echo esc_attr( $before_w ); ?>" data-pswp-height="<?php echo esc_attr( $before_h ); ?>">
                    <img class="before-after__photo" src="<?php echo esc_url( $before_thumb ); ?>" alt="<?php echo esc_attr( $before_alt ); ?>" loading="lazy">
                  </a>
                <?php endif; ?>
              </div>

              <div class="before-after__arrow"></div>

              <div class="before-after__photo-wrapper">
                <?php
                  $after = get_field( 'after-photo', $photo->ID );
                  $after_url = is_array( $after ) && ! empty( $after['url'] ) ? $after['url'] : ( is_string( $after ) ? $after : '' );
                  $after_alt = is_array( $after ) && ! empty( $after['alt'] ) ? $after['alt'] : '';
                  $after_w = is_array( $after ) && ! empty( $after['width'] ) ? $after['width'] : '';
                  $after_h = is_array( $after ) && ! empty( $after['height'] ) ? $after['height'] : '';
                  $after_thumb = is_array( $after ) && ! empty( $after['sizes']['large'] ) ? $after['sizes']['large'] : $after_url;
                  if ( $after_url ) :
                ?>
                  <a class="pswp-link" href="<?php echo esc_url( $after_url ); ?>" data-pswp-width="<?php echo esc_attr( $after_w ); ?>" data-pswp-height="<?php echo esc_attr( $after_h ); ?>">
                    <img class="before-after__photo" src="<?php echo esc_url( $after_thumb ); ?>" alt="<?php echo esc_attr( $after_alt ); ?>" loading="lazy">
                  </a>
                <?php endif; ?>
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
