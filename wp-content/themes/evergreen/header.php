<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat/Montserrat-VariableFont_wght.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Arkhip/Arkhip_font.woff" as="font" type="font/woff" crossorigin>
  <?php wp_head(); ?>
</head> 
<body <?php body_class(); ?>>
  <header class="site-header" role="banner">
    <div class="container">
      <div class="site-header-wrapper">
        <div class="site-branding">
          <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
          <?php else : ?>
            <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
          <?php endif; ?>
        </div>
  
        <nav class="main-navigation" id="site-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'evergreen' ); ?>">

          <div class="header-city">
            <svg class="header-city__icon" width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5 0C2.24299 0 0 2.27451 0 5.07025C0 8.53985 4.47451 13.6334 4.66502 13.8486C4.84395 14.0507 5.15637 14.0503 5.33498 13.8486C5.52549 13.6334 10 8.53985 10 5.07025C9.99995 2.27451 7.75699 0 5 0ZM5 7.62123C3.61288 7.62123 2.4844 6.47687 2.4844 5.07025C2.4844 3.66363 3.6129 2.51929 5 2.51929C6.3871 2.51929 7.51557 3.66366 7.51557 5.07028C7.51557 6.47689 6.3871 7.62123 5 7.62123Z" fill="currentColor"/>
            </svg>
            <p class="header-city__name">Санкт-Петербург</p>
          </div>

          <div class="main-menu">
          <?php
            wp_nav_menu( array(
              'theme_location' => 'primary',
              'container' => false,
              'menu_id' => 'primary-menu',
            ) );
          ?>
          </div>
        </nav>

        <div class="header-actions">
          <a class="button button--small open-modal" id="contact-button-header" href="#contact">Связаться</a>
          <div class="burger-toggle-wrapper">
            <button class="burger-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="Открыть меню">
              <span></span>
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  
  </header>

  <main id="main" class="site-main">
    <?php get_template_part( 'parts/modal-contact-form' ); ?>
