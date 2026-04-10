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
          <?php
            wp_nav_menu( array(
              'theme_location' => 'primary',
              'container' => false,
              'menu_id' => 'primary-menu',
            ) );
          ?>
        </nav>

        <div class="header-actions">
          <a class="button button--small" href="#contact">Связаться</a>
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
    
    <!-- <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
      <div class="container">
        <div class="mobile-menu__inner">
          <button class="modal__close-button mobile-menu__close" aria-label="Закрыть меню"></button>
            <nav id="site-navigation-mobile" class="main-navigation main-navigation--mobile" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'evergreen' ); ?>">
              <?php
                wp_nav_menu( array(
                  'theme_location' => 'primary',
                  'container' => false,
                  'menu_class' => 'mobile-menu__list',
                ) );
              ?>
            </nav>
        </div>
      </div>
    </div> -->
  </header>

  <main id="main" class="site-main">
    <?php get_template_part( 'parts/modal-contact-form' ); ?>
