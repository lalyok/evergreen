<section class="section tarifs" aria-label="Тарифы">
  <div class="container">
    <div class="section__title-wrapper">
      <h2 class="section__title">Тарифы</h2>
    </div>
    <div class="tarifs__wrapper">
      <?php 
      $tarifs = array();
      $max_tarifs = 3;
      for ( $i = 1; $i <= $max_tarifs; $i++ ) {
        $tarif_title = get_field( 'about-service-tarif-' . $i . '-title');
        $tarif_info = get_field( 'about-service-tarif-' . $i . '-info');
        $tarif_image = get_field( 'about-service-tarif-' . $i . '-image');
        

        if ( empty( $tarif_title )) {
          continue;
        }
        $tarifs[] = array(
          'title' => $tarif_title,
          'info' => $tarif_info,
          'image' => $tarif_image
        );
      }

      if ( ! empty( $tarifs ) ) : 
      ?>
          <?php foreach ( $tarifs as $t ) : ?>
            <div class="tarif-card">

              <?php
                if ( is_array( $t['image'] ) && ! empty( $t['image']['url'] ) ) :
                  $tarif_image_url = $t['image']['url'];
                  $tarif_image_alt = ! empty( $t['image']['alt'] ) ? $t['image']['alt'] : '';
              ?>
                <img class="tarif-card__image" src="<?php echo esc_url( $tarif_image_url ); ?>" alt="<?php echo esc_attr( $tarif_image_alt ); ?>">
              <?php elseif ( is_string( $t['image'] ) && ! empty( $t['image'] ) ) : ?>
                <img class="tarif-card__image" src="<?php echo esc_url( $t['image'] ); ?>" alt="">
              <?php endif; ?>

              <div class="tarif-card__inner">
                <div class="tarif-card__text">
                  <h3 class="tarif-card__title"><?php echo esc_html( $t['title'] ); ?></h3>
    
                  <?php if ( ! empty( $t['info'] ) ) : ?>
                    <div class="tarif-card__info">
                      <?php echo $t['info']; ?>
                    </div>
                  <?php endif; ?>
                </div>

                <button class="button open-modal" href="#contact">Связаться</button>
              </div>

              
            </div>
          <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </div>
</section>