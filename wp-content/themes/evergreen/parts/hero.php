<?php
$title = get_field('hero_title');
$subtitle = get_field('hero_subtitle');
$button_text = get_field('hero_button_text');
$button_link = get_field('hero_button_link');
$bg = get_field('hero_bg');
?>

<section class="section hero" style="background-image: url('<?php echo esc_url($bg['url']); ?>')">
    <div class="container hero__container">
        <div class="hero__content">
            <h1 class="hero__title"><?php echo esc_html($title); ?></h1>

            <p class="hero__lead"><?php echo esc_html($subtitle); ?></p>

            <?php if ($button_text && $button_link): ?>
                <a href="<?php echo esc_url($button_link); ?>" class="button">
                    <?php echo esc_html($button_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>