<?php
$title = get_the_title();
$subtitle = get_field('hero_subtitle');
$button_text = get_field('hero_button_text');
$button_link = get_field('hero_button_link');
$bg = get_field('hero_bg');
$bg_url = is_array( $bg ) && ! empty( $bg['url'] ) ? $bg['url'] : ( is_string( $bg ) ? $bg : '' );
?>

<section class="section hero hero--service"<?php echo $bg_url ? ' style="background-image: url(' . esc_url( $bg_url ) . ')"' : ''; ?>>
    <div class="container hero__container hero__container--service">
        <div class="hero__content hero__content--service">
            <h1 class="hero__title hero__title--service"><?php echo esc_html($title); ?></h1>

            <?php if ($subtitle): ?>
            <p class="hero__lead hero__lead--service"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>

            <?php if ($button_text && $button_link): ?>
                <a class="button button--outline hero__button hero__button--service" href="<?php echo esc_url($button_link); ?>">
                    <?php echo esc_html($button_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>