<?php
$title = get_field('hero_title');
$subtitle = get_field('hero_subtitle');
$button_text = get_field('hero_button_text');
$button_link = get_field('hero_button_link');
$bg = get_field('hero_bg');
// normalize background field (may be array or string)
$bg_url = is_array( $bg ) && ! empty( $bg['url'] ) ? $bg['url'] : ( is_string( $bg ) ? $bg : '' );
?>

<section class="section hero"<?php echo $bg_url ? ' style="background-image: url(' . esc_url( $bg_url ) . ')"' : ''; ?>>
    <div class="container hero__container">
        <div class="hero__content">
            <h1 class="hero__title"><?php echo esc_html($title); ?></h1>

            <?php if ($subtitle): ?>
            <p class="hero__lead"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>

            <?php if ($button_text && $button_link): ?>
                <a class="button button--outline hero__button" href="<?php echo esc_url($button_link); ?>">
                    <?php echo esc_html($button_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>