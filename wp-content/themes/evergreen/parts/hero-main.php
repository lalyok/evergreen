<?php
$title = get_field('hero_title');
$subtitle = get_field('hero_subtitle');
$button_text = get_field('hero_button_text');
$button_link = get_field('hero_button_link');
$bg = get_field('hero_bg');
?>

<section class="section hero-main" style="background-image: url('<?php echo esc_url($bg['url']); ?>')">
    <div class="container hero-main__container">
        <div class="hero-main__content">
            <h1 class="hero-main__title"><?php echo esc_html($title); ?></h1>

            <?php if ($subtitle): ?>
                <p class="hero-main__lead"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>

            <?php if ($button_text && $button_link): ?>
                <a class="button" href="<?php echo esc_url($button_link); ?>">
                    <?php echo esc_html($button_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>