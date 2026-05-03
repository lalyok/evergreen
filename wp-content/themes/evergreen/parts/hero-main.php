<?php
$title = get_field('hero_title');
$subtitle = get_field('hero_subtitle');
$button_text = get_field('hero_button_text');
$button_link = get_field('hero_button_link');
$bg = get_field('hero_bg');
$bg_url = is_array( $bg ) && ! empty( $bg['url'] ) ? $bg['url'] : ( is_string( $bg ) ? $bg : '' );
?>

<section class="section hero hero--main"<?php echo $bg_url ? ' style="background-image: url(' . esc_url( $bg_url ) . ')"' : ''; ?>>
    <div class="container hero__container hero__container--main">
        <div class="hero__content hero__content--main">
            <h1 class="hero__title hero__title--main"><?php echo $title; ?></h1>

            <?php if ($subtitle): ?>
                <p class="hero__lead hero__lead--main"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>

            <?php if ($button_text && $button_link): ?>
                <a class="button hero__button hero__button--main" href="<?php echo esc_url($button_link); ?>">
                    <?php echo esc_html($button_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>