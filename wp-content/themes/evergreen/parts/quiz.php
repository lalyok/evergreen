<?php
$quiz_image = get_field('quiz-image');
?>
<section class="section quiz" aria-label="Опрос для подбора услуг">
  <div class="container">
    <div class="quiz__wrapper">
      <div class="quiz__container">
        <div class="section__title-wrapper">
          <h2 class="section__title quiz__title">Подберите услугу</h2>
        </div>
        <div id="evergreen-quiz" class="evergreen-quiz">
          <noscript>
            <p>Опрос требует включённый JavaScript. Пожалуйста, включите JS в браузере.</p>
          </noscript>
        </div>
      </div>
      <?php
          if ( is_array( $quiz_image ) && ! empty( $quiz_image['url'] ) ) :
            $quiz_image_url = $quiz_image['url'];
            $quiz_image_alt = ! empty( $quiz_image['alt'] ) ? $quiz_image['alt'] : '';
        ?>
          <img class="quiz__image" src="<?php echo esc_url( $quiz_image_url ); ?>" alt="<?php echo esc_attr( $quiz_image_alt ); ?>">
        <?php elseif ( is_string( $quiz_image ) && ! empty( $quiz_image ) ) : ?>
          <img class="quiz__image" src="<?php echo esc_url( $quiz_image ); ?>" alt="">
        <?php endif; ?>
    </div>
  </div>
</section>
