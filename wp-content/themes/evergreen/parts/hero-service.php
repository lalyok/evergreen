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

<?php
// Circular previous/next navigation for services
if ( is_singular() ) {
    $post_type = get_post_type();

    $prev_post = get_previous_post();
    if ( empty( $prev_post ) ) {
        $last = get_posts( array(
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => $post_type,
        ) );
        if ( ! empty( $last ) ) {
            $prev_post = $last[0];
        }
    }

    $next_post = get_next_post();
    if ( empty( $next_post ) ) {
        $first = get_posts( array(
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'ASC',
            'post_type' => $post_type,
        ) );
        if ( ! empty( $first ) ) {
            $next_post = $first[0];
        }
    }
}
?>

<div class="services-navigation">
    <div class="container">
        <div class="services-navigation__wrapper">
            <?php if ( ! empty( $prev_post ) ): ?>
                <a class="button button--navigation services-navigation__link services-navigation__link--prev" href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
                    << <?php echo esc_html( get_the_title( $prev_post ) ); ?>
                </a>
            <?php endif; ?>
        
            <?php if ( ! empty( $next_post ) ): ?>
                <a class="button button--navigation services-navigation__link services-navigation__link--next" href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
                    <?php echo esc_html( get_the_title( $next_post ) ); ?> >>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>