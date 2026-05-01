<?php
  $projects = get_posts( array(
    'numberposts' => -1,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'ASC',
    'include'     => array(),
    'exclude'     => array(),
    'meta_key'    => '',
    'meta_value'  =>'',
    'post_type'   => 'project',
    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
  ) );

  if ( $projects ) :
?>
<section class="section portfolio" aria-label="Портфолио">
  <div class="container">
    <h2 class="section__title section__title--huge">Портфолио</h2>
    <div class="portfolio__container">
      <?php
        global $project;
    
        foreach( $projects as $project ){
          setup_postdata( $project );
      ?>
      <div class="portfolio__inner">
        <div class="portfolio__text">
          <h3 class="portfolio__project-title"><?php echo esc_html( get_the_title( $project->ID ) ); ?></h3>
          <div class="portfolio__project-description">
            <?php echo get_field( 'project-description', $project->ID ); ?>
          </div>
        </div>

        <?php
        $photos = array();
        $max_photos = 5;
        for ( $i = 1; $i <= $max_photos; $i++ ) {
            $photo = get_field( 'project-photo-' . $i , $project->ID);

            if ( empty( $photo )) {
              continue;
            }
            $photos[] = $photo;
        }

        if ( ! empty( $photos ) ) : 
        ?>
        
        <div class="slider portfolio__slider">
          <div class="portfolio__slider-container">
            <div class="swiper portfolio__main-slider">
              <div class="swiper-wrapper">
    
                <?php foreach ( $photos as $p ) : 
                    // Normalize ACF file field (may be array or string)
                    $photo_url = is_array( $p ) && ! empty( $p['url'] ) ? $p['url'] : $p;
                    if ( empty( $photo_url ) ) {
                        continue;
                    }
                ?>
          
                <div class="swiper-slide">
                  <?php
                    $photo_w = is_array( $p ) && ! empty( $p['width'] ) ? $p['width'] : '';
                    $photo_h = is_array( $p ) && ! empty( $p['height'] ) ? $p['height'] : '';
                    $photo_thumb = is_array( $p ) && ! empty( $p['sizes']['large'] ) ? $p['sizes']['large'] : $photo_url;
                  ?>
                  <a class="pswp-link" href="<?php echo esc_url( $photo_url ); ?>" data-pswp-width="<?php echo esc_attr( $photo_w ); ?>" data-pswp-height="<?php echo esc_attr( $photo_h ); ?>">
                    <img class="portfolio__photo" src="<?php echo esc_url( $photo_thumb ); ?>" alt="<?php echo esc_attr( get_the_title( $project->ID ) ); ?>" loading="lazy">
                  </a>
                </div>
                <?php endforeach; ?>
              
        
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="portfolio__slider-container">
            <div thumbsSlider="" class="swiper portfolio__thumbs-slider">
              <div class="swiper-wrapper">
                <?php foreach ( $photos as $p ) : 
                    // Normalize ACF file field (may be array or string)
                    $photo_url = is_array( $p ) && ! empty( $p['url'] ) ? $p['url'] : $p;
                    if ( empty( $photo_url ) ) {
                        continue;
                    }
                    
                ?>
          
                <div class="swiper-slide">
                  <img class="portfolio__photo" src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( get_the_title( $project->ID ) ); ?>">
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>


        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php  
      }
      wp_reset_postdata(); // сброс
    ?>
  </div>
</section>
<?php endif; ?>
