<?php
$why_us_lead = get_field('why-us-lead');
$why_us_description = get_field('why-us-description');
$why_us_image = get_field('why-us-image');
?>
<section class="section why-us" aria-label="Почему выбирают нас">
  <div class="container">
    <div class="section__title-wrapper">
      <h2 class="section__title">Почему выбирают нас</h2>
    </div>
    <div class="why-us__row">
      <div class="why-us__text">
        <?php if ($why_us_lead): ?>
          <p class="why-us__lead">
            <?php echo $why_us_lead; ?>
          </p>
        <?php endif; ?>
        <?php echo $why_us_description; ?>
      </div>
      <div class="why-us__image">
        <img src="<?php echo esc_url($why_us_image['url']); ?>" alt="<?php echo esc_attr($why_us_image['alt']); ?>">
      </div>
    </div>
  </div>
</section>
