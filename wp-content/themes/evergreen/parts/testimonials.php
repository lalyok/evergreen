<section class="section testimonials" aria-label="Отзывы наших клиентов">
  <div class="container">
    <div class="section__title-wrapper">
      <h2 class="section__title">Отзывы наших клиентов</h2>
    </div>
  </div>
  <div class="slider testimonials__slider">
    <div class="testimonials__bg" aria-hidden="true"></div>
    <div class="container">
      <button class="slider-prev testimonials__slider-prev" aria-label="Предыдущий слайд">
        <svg class="slider-prev-icon" width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="37" cy="37" r="35" transform="matrix(1 -8.74228e-08 -8.74228e-08 -1 7.62939e-06 74)" stroke="currentColor"/>
        <path d="M44 16L20 37L44 58" stroke-linecap="round" stroke-linejoin="round" stroke="CurrentColor"/>
        </svg>
      </button>
  
      <div class="swiper">
        <div class="swiper-wrapper">
  
        <?php
          $feedbacks = get_posts( array(
            'numberposts' => -1,
            'category'    => 0,
            'orderby'     => 'date',
            'order'       => 'ASC',
            'include'     => array(),
            'exclude'     => array(),
            'meta_key'    => '',
            'meta_value'  =>'',
            'post_type'   => 'feedback',
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
          ) );
  
          global $feedback;
  
          foreach( $feedbacks as $feedback ){
            setup_postdata( $feedback );
            ?>
  
            <?php
            // prepare thumbnail for background: use full size if available
            $thumb = get_the_post_thumbnail_url( $feedback->ID, 'full' );
            $bg_attr = $thumb ? ' data-bg="' . esc_url( $thumb ) . '"' : '';
            ?>
            <div class="swiper-slide"<?php echo $bg_attr; ?>>
              <div class="feedback-card">
                <div class="feedback-card__text">
                  <p><?php echo esc_html( get_field( 'feedback-text', $feedback->ID ) ); ?></p>
                  <p class="feedback-card__author"><?php echo esc_html( get_field( 'feedback-author', $feedback->ID ) ); ?></p>
                  <p class="feedback-card__company"><?php echo esc_html( get_field( 'feedback-company', $feedback->ID ) ); ?></p>
                </div>
                <?php
                $feedback_file = get_field( 'feedback-file', $feedback->ID );
                if ( $feedback_file ) :
                  // ACF file field may return an array with ['url'] or a string URL
                  $file_url = is_array( $feedback_file ) && ! empty( $feedback_file['url'] ) ? $feedback_file['url'] : $feedback_file;
                ?>
                  <a href="<?php echo esc_url( $file_url ); ?>" target="_blank">
                    <img class="feedback-card__photo" src="<?php echo esc_url( $file_url ); ?>" alt="<?php echo esc_attr( get_the_title( $feedback->ID ) ); ?>">
                    <p>Смотреть скан →</p>
                  </a>
                <?php endif; ?>
              </div>
            </div>
  
            <?php  
          }
  
          wp_reset_postdata(); // сброс
  
        ?>
        </div>
  
        <!-- Swiper navigation -->
        
      </div>
      <button class="slider-next testimonials__slider-next" aria-label="Следующий слайд">
        <svg class="slider-next-icon" width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="37" cy="37" r="35" transform="rotate(-180 37 37)" stroke="currentColor"/>
        <path d="M30 16L54 37L30 58" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"/>
        </svg>
      </button>
    </div>
  </div>
</section>
