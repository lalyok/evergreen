<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header class="site-header" role="banner">
    <div class="site-branding">
      <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
      <?php endif; ?>
    </div>

    <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'evergreen' ); ?>">
      <?php
        wp_nav_menu( array(
          'theme_location' => 'primary',
          'container' => false,
          'menu_id' => 'primary-menu',
        ) );
      ?>
    </nav>

    <div class="header-actions">
      <a class="contact-button" href="#contact">Связаться</a>
    </div>
  </header>

  <main id="main" class="site-main">
