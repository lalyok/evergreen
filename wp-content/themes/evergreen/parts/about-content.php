<?php
  $about_us_promo_title = get_field('about-us-promo-title');
  $about_us_promo_text = get_field('about-us-promo-text');
  $about_us_promo_image = get_field('about-us-promo-image');
  $about_us_staff_photo = get_field('about-us-staff-photo');
  $about_us_values_text = get_field('about-us-values-text');
  $about_us_chief_photo = get_field('about-us-chief-photo');
  $about_us_chief_speech = get_field('about-us-chief-speech');
  $about_us_chief_name = get_field('about-us-chief-name');
  $about_us_chief_description = get_field('about-us-chief-description');
?>

<div class="container">
  <h1 class="section__title section__title--huge">О&nbsp;компании</h1>
  <section class="section about-us__promo">
    <div class="about-us__promo-text">
      <?php if ($about_us_promo_title): ?>
        <h2 class="about-us__promo-title section__subtitle">
          <?php echo $about_us_promo_title; ?>
        </h2>
      <?php endif; ?>
      <div class="about-us__promo-description">
        <?php echo $about_us_promo_text; ?>
      </div>
    </div>
    <?php
      if ( is_array( $about_us_promo_image ) && ! empty( $about_us_promo_image['url'] ) ) :
        $about_us_promo_image_url = $about_us_promo_image['url'];
        $about_us_promo_image_alt = ! empty( $about_us_promo_image['alt'] ) ? $about_us_promo_image['alt'] : '';
    ?>
      <img class="about-us__promo-image" src="<?php echo esc_url( $about_us_promo_image_url ); ?>" alt="<?php echo esc_attr( $about_us_promo_image_alt ); ?>">
    <?php elseif ( is_string( $about_us_promo_image ) && ! empty( $about_us_promo_image ) ) : ?>
      <img class="about-us__promo-image" src="<?php echo esc_url( $about_us_promo_image ); ?>" alt="">
    <?php endif; ?>
  </section>
  <section class="section about-us__staff">
    <h2 class="section__subtitle">Команда</h2>
      <?php
        if ( is_array( $about_us_staff_photo ) && ! empty( $about_us_staff_photo['url'] ) ) :
          $about_us_staff_photo_url = $about_us_staff_photo['url'];
          $about_us_staff_photo_alt = ! empty( $about_us_staff_photo['alt'] ) ? $about_us_staff_photo['alt'] : '';
      ?>
        <img class="about-us__staff-photo" src="<?php echo esc_url( $about_us_staff_photo_url ); ?>" alt="<?php echo esc_attr( $about_us_staff_photo_alt ); ?>">
      <?php elseif ( is_string( $about_us_staff_photo ) && ! empty( $about_us_staff_photo ) ) : ?>
        <img class="about-us__staff-photo" src="<?php echo esc_url( $about_us_staff_photo ); ?>" alt="">
      <?php endif; ?>
  </section>
</div>
<section class="section about-us__citations">
  <div class="about-us__values">
    <div class="container">
      <div class="about-us__values-wrapper">
        <h3 class="section__subtitle">Ценности</h3>
        <p class="about-us__values-text">
          <?php echo $about_us_values_text; ?>
        </p>
      </div>
    </div>
  </div>
  <div class="about-us__chief-info">
    <div class="container">
      <div class="about-us__chief-info-wrapper">
        <?php
          if ( is_array( $about_us_chief_photo ) && ! empty( $about_us_chief_photo['url'] ) ) :
            $about_us_chief_photo_url = $about_us_chief_photo['url'];
            $about_us_chief_photo_alt = ! empty( $about_us_chief_photo['alt'] ) ? $about_us_chief_photo['alt'] : '';
        ?>
          <img class="about-us__chief-photo" src="<?php echo esc_url( $about_us_chief_photo_url ); ?>" alt="<?php echo esc_attr( $about_us_chief_photo_alt ); ?>">
        <?php elseif ( is_string( $about_us_chief_photo ) && ! empty( $about_us_chief_photo ) ) : ?>
          <img class="about-us__chief-photo" src="<?php echo esc_url( $about_us_chief_photo ); ?>" alt="">
        <?php endif; ?>
        <div class="about-us__chief-info-text">
          <p class="about-us__chief-info-speech">
            <?php echo $about_us_chief_speech; ?>
          </p>
          <p class="about-us__chief-info-name">
            <?php echo $about_us_chief_name; ?>
          </p>
          <p class="about-us__chief-info-description">
            <?php echo $about_us_chief_description; ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>