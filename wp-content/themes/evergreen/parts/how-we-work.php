<?php
$steps = array();
$max_steps = 5;
$out_index = 1;
for ( $i = 1; $i <= $max_steps; $i++ ) {
    $title = get_field( "hww-step-{$i}-title" );
    $text  = get_field( "hww-step-{$i}-text" );

    // Skip if both title and text are empty
    if ( empty( $title ) && empty( $text ) ) {
        continue;
    }

    $steps[] = array(
        'step'  => $out_index,
        'title' => $title,
        'text'  => $text,
    );
    $out_index++;
}
$bg_image = get_field( 'hww-background-image' );
$bg_style = '';
if ( ! empty( $bg_image['url'] ) ) {
  $bg_style = "style=\"--hww-bg: url('" . esc_url( $bg_image['url'] ) . "')\"";
}
?>

<section class="section how-we-work" aria-label="Как мы работаем" <?php echo $bg_style; ?>>
  <div class="section--bg-gradient">
    <div class="container">
      <div class="section__title-wrapper">
        <h2 class="section__title">Как мы работаем</h2>
      </div>
      <div class="how-we-work__inner">
        <ol class="process-list">
          <?php if ( ! empty( $steps ) ) : ?>
            <?php foreach ( $steps as $s ) : ?>
              <li class="process-list__item">
                <strong class="process-list__title"><?php echo esc_html( $s['title'] ); ?></strong>
                <?php if ( ! empty( $s['text'] ) ) : ?>
                  <p class="process-list__text"><?php echo esc_html( $s['text'] ); ?></p>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ol>
      </div>
    </div>
  </div>
</section>
