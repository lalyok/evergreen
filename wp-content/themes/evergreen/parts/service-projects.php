<?php
  $photos = array();
  $max_photos = 5;
  for ( $i = 1; $i <= $max_photos; $i++ ) {
      $photo = get_field( 'about-service-photo-' . $i );

      if ( empty( $photo )) {
        continue;
      }
      $photos[] = $photo;
  }

  if ( ! empty( $photos ) ) : 
  ?>
  <section class="section projects" aria-label="Проекты">
    <div class="container">
      <div class="section__title-wrapper">
        <h2 class="section__title">Проекты</h2>
      </div>
      <div class="slider projects__slider">
        <button class="slider-prev projects__slider-prev" aria-label="Previous slide">
          <svg class="slider-prev-icon" width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="37" cy="37" r="35" transform="matrix(1 -8.74228e-08 -8.74228e-08 -1 7.62939e-06 74)" stroke="currentColor"/>
          <path d="M44 16L20 37L44 58" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"/>
          </svg>
        </button>
    
        <div class="swiper">
          <div class="swiper-wrapper">

            <?php foreach ( $photos as $p ) : 
                // Normalize ACF file field (may be array or string)
                $photo_url = is_array( $p ) && ! empty( $p['url'] ) ? $p['url'] : $p;
                if ( empty( $photo_url ) ) {
                    continue;
                }
            ?>
              <div class="swiper-slide">
                <div class="projects__photo-wrapper">
                  <img class="projects__photo" src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                </div>
              </div>
            <?php endforeach; ?>
    
          </div>

          <div class="swiper-pagination"></div>
    
          <!-- Swiper navigation -->
          
        </div>
        <button class="slider-next projects__slider-next" aria-label="Next slide">
          <svg class="slider-next-icon" width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="37" cy="37" r="35" transform="rotate(-180 37 37)" stroke="currentColor"/>
          <path d="M30 16L54 37L30 58" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"/>
          </svg>

        </button>
      </div>
  </section>
<?php endif; ?>
