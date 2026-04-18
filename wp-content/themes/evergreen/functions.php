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

  // Cookies consent banner logic
  // wp_enqueue_script( 'evergreen-main', get_template_directory_uri() . '/assets/js/cookies-consent.js', array(), $theme_version, true );

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

// Add YouGile settings to Customizer so API key and column ID are editable
function evergreen_customize_yougile_settings( $wp_customize ) {
  // Add a section for API settings
  $wp_customize->add_section( 'evergreen_api_settings', array(
    'title'    => __( 'YouGile API Settings', 'evergreen' ),
    'priority' => 160,
  ) );

  $wp_customize->add_setting( 'evergreen_yougile_api_key', array(
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  $wp_customize->add_control( 'evergreen_yougile_api_key', array(
    'label'    => __( 'YouGile API Key', 'evergreen' ),
    'section'  => 'evergreen_api_settings',
    'type'     => 'text',
  ) );

  $wp_customize->add_setting( 'evergreen_yougile_column_id', array(
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  $wp_customize->add_control( 'evergreen_yougile_column_id', array(
    'label'    => __( 'YouGile Column ID', 'evergreen' ),
    'section'  => 'evergreen_api_settings',
    'type'     => 'text',
  ) );
}
add_action( 'customize_register', 'evergreen_customize_yougile_settings' );

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

/**
 * Handle contact form submissions and create a task in YouGile via API.
 */
if ( ! function_exists( 'evergreen_handle_contact_form' ) ) {
  function evergreen_handle_contact_form() {
    // only accept POST
    if ( 'POST' !== $_SERVER['REQUEST_METHOD'] ) {
      wp_send_json_error( array( 'message' => 'Invalid request method' ), 405 );
    }

    // sanitize inputs
    $name  = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $phone = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

    if ( empty( $name ) || empty( $phone ) ) {
      wp_send_json_error( array( 'message' => 'Name and phone are required' ), 422 );
    }

    // server-side phone digits validation: require at least 11 digits (country +7 + 10 digits)
    $phone_digits = preg_replace( '/\D+/', '', $phone );
    if ( strlen( $phone_digits ) < 11 ) {
      wp_send_json_error( array( 'message' => 'Phone number is too short' ), 422 );
    }

    // Build task payload
    $title = trim( $name . ' ' . $phone );
    $description = $email;

    // YouGile API configuration (read from theme options / Customizer)
    $api_endpoint = 'https://yougile.com/api-v2/tasks';
    $api_key = get_theme_mod( 'evergreen_yougile_api_key' );
    $column_id = get_theme_mod( 'evergreen_yougile_column_id' );

    $body = array(
      'title' => $title,
      'description' => $description,
      // include column identifier — try common keys used by APIs
      'columnId' => $column_id
    );

    $args = array(
      'headers' => array(
        'Content-Type'  => 'application/json',
        'Authorization' => 'Bearer ' . $api_key
      ),
      'body'    => wp_json_encode( $body ),
      'timeout' => 20,
    );

    $response = wp_remote_post( $api_endpoint, $args );

    if ( is_wp_error( $response ) ) {
      error_log( 'YouGile API request failed: ' . $response->get_error_message() );
      wp_send_json_error( array( 'message' => 'Failed to send request' ), 500 );
    }

    $code = wp_remote_retrieve_response_code( $response );
    $body = wp_remote_retrieve_body( $response );

    if ( $code >= 200 && $code < 300 ) {
      wp_send_json_success( array( 'message' => 'Task created', 'response' => json_decode( $body, true ) ) );
    }

    // Log for debugging
    error_log( 'YouGile API returned status ' . $code . ' body: ' . $body );
    wp_send_json_error( array( 'message' => 'API returned error', 'status' => $code ), 502 );
  }
}

add_action( 'admin_post_nopriv_evergreen_contact', 'evergreen_handle_contact_form' );
add_action( 'admin_post_evergreen_contact', 'evergreen_handle_contact_form' );
