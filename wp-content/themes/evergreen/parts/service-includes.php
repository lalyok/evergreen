<?php
$si_photo = get_field('about-service-includes-image');
$bg_style = '';
if ( ! empty( $si_photo['url'] ) ) {
  $bg_style = "style=\"--si-bg: url('" . esc_url( $si_photo['url'] ) . "')\"";
}
?>

<section class="section section--extra-padding list-section service-includes" aria-label="Что входит в услугу" <?php echo $bg_style; ?>>
    <div class="container">
      <div class="section__title-wrapper">
        <h2 class="section__title">Что входит в услугу</h2>
      </div>
      <div class="list-section__wrapper">
        <div class="list-section__inner service-includes__inner">
          <?php echo get_field('about-service-includes'); ?>
        </div>
      </div>
    </div>
</section>
