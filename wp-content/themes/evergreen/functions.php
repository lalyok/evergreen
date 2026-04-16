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
  
  // Init script for before/after slider
  wp_enqueue_script( 'evergreen-before-after-swiper', get_template_directory_uri() . '/assets/js/before-after-swiper.js', array( 'swiper', 'evergreen-main' ), $theme_version, true );

  wp_enqueue_script( 'evergreen-testimonials-swiper', get_template_directory_uri() . '/assets/js/testimonials-swiper.js', array( 'swiper', 'evergreen-main' ), $theme_version, true );

  wp_enqueue_script( 'evergreen-projects-swiper', get_template_directory_uri() . '/assets/js/projects-swiper.js', array( 'swiper', 'evergreen-main' ), $theme_version, true );

  wp_enqueue_script( 'evergreen-portfolio-swiper', get_template_directory_uri() . '/assets/js/portfolio-swiper.js', array( 'swiper', 'evergreen-main' ), $theme_version, true );
}

add_action( 'wp_enqueue_scripts', 'evergreen_enqueue_assets' );

/**
 * Register secondary logo in Customizer and helper functions
 */
function evergreen_customize_register( $wp_customize ) {
  $wp_customize->add_setting( 'secondary_logo', array(
    'sanitize_callback' => 'absint',
  ) );

  $wp_customize->add_control( new WP_Customize_Media_Control(
    $wp_customize,
    'secondary_logo',
    array(
      'label'    => __( 'Secondary logo', 'evergreen' ),
      'section'  => 'title_tagline',
      'mime_type'=> 'image',
    )
  ) );
}
add_action( 'customize_register', 'evergreen_customize_register' );

if ( ! function_exists( 'get_custom_logo_secondary_url' ) ) {
  function get_custom_logo_secondary_url() {
    $id = get_theme_mod( 'secondary_logo' );
    return $id ? wp_get_attachment_image_url( $id, 'full' ) : '';
  }
}

if ( ! function_exists( 'the_custom_logo_secondary' ) ) {
  function the_custom_logo_secondary( $size = 'full', $args = array() ) {
    $id = get_theme_mod( 'secondary_logo' );
    if ( ! $id ) {
      return;
    }
    $defaults = array( 'class' => 'custom-logo-secondary' );
    $args = wp_parse_args( $args, $defaults );
    echo wp_get_attachment_image( $id, $size, false, $args );
  }
}

if ( ! function_exists( 'has_secondary_logo' ) ) {
  function has_secondary_logo() {
    return (bool) get_theme_mod( 'secondary_logo' );
  }
}
