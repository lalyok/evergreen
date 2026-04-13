<section class="section services" aria-label="Наши услуги">
  <div class="container">
    <div class="section__title-wrapper">
      <h2 class="section__title">Наши услуги</h2>
    </div>
    <div class="slider services__slider">
      <button class="slider-prev services__slider-prev" aria-label="Previous slide">
        <svg class="slider-prev-icon" width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="37" cy="37" r="35" transform="matrix(1 -8.74228e-08 -8.74228e-08 -1 7.62939e-06 74)" stroke="currentColor"/>
        <path d="M44 16L20 37L44 58" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"/>
        </svg>
      </button>
  
      <div class="swiper">
        <div class="swiper-wrapper">
  
        <?php
          $services = get_posts( array(
            'numberposts' => -1,
            'category'    => 0,
            'orderby'     => 'date',
            'order'       => 'ASC',
            'include'     => array(),
            'exclude'     => array(),
            'meta_key'    => '',
            'meta_value'  =>'',
            'post_type'   => 'service',
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
          ) );
  
          global $service;
  
          foreach( $services as $service ){
            setup_postdata( $service );
            ?>
  
            <div class="swiper-slide">
              <div class="slide-wrapper">
                <div class="service-card">
                  <a class="service-card__link" href="<?php echo esc_url( get_permalink( $service->ID ) ); ?>">
                    <img class="service-card__image" src="<?php echo esc_url(get_the_post_thumbnail_url( $service -> ID)) ?>" alt="<?php echo esc_attr( get_the_title( $service->ID ) ); ?>">
                    <h3 class="service-card__title"><?php echo esc_html( get_the_title( $service->ID ) ); ?></h3>
                  </a>
                </div>
              </div>
            </div>
  
            <?php  
          }
  
          wp_reset_postdata(); // сброс
  
        ?>
        </div>
  
        <!-- Swiper navigation -->
        
      </div>
      <button class="slider-next services__slider-next" aria-label="Next slide">
        <svg class="slider-next-icon" width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="37" cy="37" r="35" transform="rotate(-180 37 37)" stroke="currentColor"/>
        <path d="M30 16L54 37L30 58" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"/>
        </svg>

      </button>
    </div>
</section>
