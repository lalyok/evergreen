<?php
/**
 * Theme setup and enqueue scripts/styles for Evergreen theme.
 */

if ( ! function_exists( 'evergreen_setup' ) ) {
  function evergreen_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
      'height'      => 60,
      'width'       => 220,
      'flex-height' => true,
      'flex-width'  => true,
      'header-text' => array( 'site-title', 'site-description' ),
    ) );
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'evergreen' ),
    ) );
  }
}
add_action( 'after_setup_theme', 'evergreen_setup' );

/**
 * Enqueue styles and scripts
 */
function evergreen_enqueue_assets() {
  $theme_version = wp_get_theme()->get( 'Version' );

  // Main theme stylesheet (style.css in theme root)
  wp_enqueue_style( 'evergreen-style', get_stylesheet_uri(), array(), $theme_version );

  // Additional compiled/site CSS
  wp_enqueue_style( 'evergreen-main', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version );

  // Swiper (CSS + JS) from CDN
  wp_enqueue_style( 'swiper', 'https://unpkg.com/swiper@9/swiper-bundle.min.css', array(), '9.0' );

  // Main JS
  wp_enqueue_script( 'evergreen-main', get_template_directory_uri() . '/assets/js/main.js', array(), $theme_version, true );

  // Swiper JS
  wp_enqueue_script( 'swiper', 'https://unpkg.com/swiper@9/swiper-bundle.min.js', array(), '9.0', true );

  // Init script for services slider (depends on swiper and main)
  wp_enqueue_script( 'evergreen-services-swiper', get_template_directory_uri() . '/assets/js/services-swiper.js', array( 'swiper', 'evergreen-main' ), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'evergreen_enqueue_assets' );
