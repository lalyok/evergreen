<?php
$why_us_lead = get_field('why-us-lead');
$why_us_description = get_field('why-us-description');
$why_us_image = get_field('why-us-image');
?>
<section class="section about why-us" aria-label="Почему выбирают нас">
  <div class="container">
    <div class="section__title-wrapper">
      <h2 class="section__title">Почему выбирают нас</h2>
    </div>
    <div class="about__row why-us__row">
      <div class="about__text why-us__text">
        <?php if ($why_us_lead): ?>
          <p class="about__lead why-us__lead">
            <?php echo $why_us_lead; ?>
          </p>
        <?php endif; ?>
        <?php echo $why_us_description; ?>
      </div>
      <div class="about__image why-us__image">
        <?php
          // Support ACF image field that may be array or string, and guard null
          if ( is_array( $why_us_image ) && ! empty( $why_us_image['url'] ) ) :
            $why_us_image_url = $why_us_image['url'];
            $why_us_image_alt = ! empty( $why_us_image['alt'] ) ? $why_us_image['alt'] : '';
        ?>
          <img src="<?php echo esc_url( $why_us_image_url ); ?>" alt="<?php echo esc_attr( $why_us_image_alt ); ?>">
        <?php elseif ( is_string( $why_us_image ) && ! empty( $why_us_image ) ) : ?>
          <img src="<?php echo esc_url( $why_us_image ); ?>" alt="">
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
