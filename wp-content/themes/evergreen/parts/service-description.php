<?php
$about_service_lead = get_field('about-service-lead');
$about_service_description = get_field('about-service-description');
$about_service_image = get_field('about-service-image');
?>
<section class="section about about-service" aria-label="Описание услуги">
  <div class="container">
    <div class="section__title-wrapper">
      <h2 class="section__title">Описание услуги</h2>
    </div>
    <div class="about__row about-service__row">
      <div class="about__text about-service__text">
        <?php if ($about_service_lead): ?>
          <p class="about__lead about-service__lead">
            <?php echo $about_service_lead; ?>
          </p>
        <?php endif; ?>
        <?php echo $about_service_description; ?>
      </div>
      <div class="about__image about-service__image">
        <?php
          if ( is_array( $about_service_image ) && ! empty( $about_service_image['url'] ) ) :
            $about_service_image_url = $about_service_image['url'];
            $about_service_image_alt = ! empty( $about_service_image['alt'] ) ? $about_service_image['alt'] : '';
        ?>
          <img src="<?php echo esc_url( $about_service_image_url ); ?>" alt="<?php echo esc_attr( $about_service_image_alt ); ?>">
        <?php elseif ( is_string( $about_service_image ) && ! empty( $about_service_image ) ) : ?>
          <img src="<?php echo esc_url( $about_service_image ); ?>" alt="">
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
