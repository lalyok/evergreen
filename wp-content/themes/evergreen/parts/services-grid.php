<section class="section services-grid" aria-label="Наши услуги">
  <div class="container">
    <h1 class="section__title section__title--huge">Услуги</h1>
    <div class="services-grid-wrapper">

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

            <div class="service-card service-card--grid">
              <a class="service-card__link service-card__link--grid" href="<?php echo esc_url( get_permalink( $service->ID ) ); ?>">
                <img class="service-card__image service-card__image--grid" src="<?php echo esc_url(get_the_post_thumbnail_url( $service -> ID)) ?>" alt="<?php echo esc_attr( get_the_title( $service->ID ) ); ?>">
                <h3 class="service-card__title service-card__title--grid"><?php echo esc_html( get_the_title( $service->ID ) ); ?></h3>
              </a>
            </div>

          <?php  
        }
  
          wp_reset_postdata(); // сброс
  
        ?>
    </div>
  </div>
</section>
