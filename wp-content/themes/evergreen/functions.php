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

  wp_enqueue_style( 'evergreen-style', get_stylesheet_uri(), array(), null );

  // Swiper (CSS) from CDN
  wp_enqueue_style( 'swiper', 'https://unpkg.com/swiper@9/swiper-bundle.min.css', array(), '9.0' );

  // Main JS
  wp_enqueue_script( 'evergreen-main', get_template_directory_uri() . '/assets/js/main.js', array(), $theme_version, true );

  // Cookies consent banner logic
  // wp_enqueue_script( 'evergreen-main', get_template_directory_uri() . '/assets/js/cookies-consent.js', array(), $theme_version, true );

  // Swiper JS
  wp_enqueue_script( 'swiper', 'https://unpkg.com/swiper@9/swiper-bundle.min.js', array(), '9.0', true );

  wp_enqueue_script( 'evergreen-services-swiper', get_template_directory_uri() . '/assets/js/services-swiper.js', array( 'swiper', 'evergreen-main' ), $theme_version, true );
  
  wp_enqueue_script( 'evergreen-before-after-swiper', get_template_directory_uri() . '/assets/js/before-after-swiper.js', array( 'swiper', 'evergreen-main' ), $theme_version, true );

  wp_enqueue_script( 'evergreen-testimonials-swiper', get_template_directory_uri() . '/assets/js/testimonials-swiper.js', array( 'swiper', 'evergreen-main' ), $theme_version, true );

  wp_enqueue_script( 'evergreen-projects-swiper', get_template_directory_uri() . '/assets/js/projects-swiper.js', array( 'swiper', 'evergreen-main' ), $theme_version, true );

  wp_enqueue_script( 'evergreen-portfolio-swiper', get_template_directory_uri() . '/assets/js/portfolio-swiper.js', array( 'swiper', 'evergreen-main' ), $theme_version, true );

  // Quiz assets (client-side quiz, pre-generated JSON at assets/data/quiz.json)
  
  wp_enqueue_script( 'evergreen-quiz', get_template_directory_uri() . '/assets/js/quiz.js', array( 'evergreen-main' ), $theme_version, true );
  wp_localize_script( 'evergreen-quiz', 'EvergreenQuiz', array(
    'dataUrl' => get_template_directory_uri() . '/assets/data/quiz.json',
    'restBase' => rest_url( 'evergreen/v1/services' ),
  ) );

  // PhotoSwipe CSS
  wp_enqueue_style( 'photoswipe-css', 'https://unpkg.com/photoswipe@5/dist/photoswipe.css', array(), null );

  // Central module loader: imports PhotoSwipe ESM builds and exposes a shared object on window
  wp_enqueue_script( 'photoswipe-shared', get_template_directory_uri() . '/assets/js/photoswipe-shared.js', array(), $theme_version, true );
  wp_script_add_data( 'photoswipe-shared', 'type', 'module' );

  // Per-gallery init scripts (they will use the shared loader via window.__PhotoSwipeShared)
  wp_enqueue_script( 'evergreen-before-after-photoswipe', get_template_directory_uri() . '/assets/js/before-after-photoswipe.js', array( 'evergreen-main' ), $theme_version, true );
  wp_enqueue_script( 'evergreen-testimonials-photoswipe', get_template_directory_uri() . '/assets/js/testimonials-photoswipe.js', array( 'evergreen-main' ), $theme_version, true );
  wp_enqueue_script( 'evergreen-portfolio-photoswipe', get_template_directory_uri() . '/assets/js/portfolio-photoswipe.js', array( 'evergreen-main' ), $theme_version, true );
  wp_enqueue_script( 'evergreen-projects-photoswipe', get_template_directory_uri() . '/assets/js/projects-photoswipe.js', array( 'evergreen-main' ), $theme_version, true );
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

  $wp_customize->add_setting( 'evergreen_yougile_project_id', array(
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  $wp_customize->add_control( 'evergreen_yougile_project_id', array(
    'label'    => __( 'YouGile Project ID', 'evergreen' ),
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

    // Build title for the task
    $title = trim( $name . ', ' . $phone );

    // YouGile API configuration (read from theme options / Customizer)
    $api_key = get_theme_mod( 'evergreen_yougile_api_key' );
    $project_id = get_theme_mod( 'evergreen_yougile_project_id' );

    // Prepare contact-person creation payload
    $contact_endpoint = 'https://yougile.com/api-v2/crm/contact-persons';
    $contact_body = array(
      'projectId' => $project_id,
      'title'     => $name,
      'fields'    => array(
        'phone' => $phone_digits,
        'email' => $email,
      ),
    );

    $common_args = array(
      'headers' => array(
        'Content-Type'  => 'application/json',
        'Authorization' => 'Bearer ' . $api_key,
      ),
      'timeout' => 20,
    );

    $contact_args = $common_args;
    $contact_args['body'] = wp_json_encode( $contact_body );

    $contact_resp = wp_remote_post( $contact_endpoint, $contact_args );
    if ( is_wp_error( $contact_resp ) ) {
      error_log( 'YouGile contact create failed: ' . $contact_resp->get_error_message() );
      wp_send_json_error( array( 'message' => 'Failed to create contact' ), 500 );
    }

    $contact_code = wp_remote_retrieve_response_code( $contact_resp );
    $contact_body_raw = wp_remote_retrieve_body( $contact_resp );
    $contact_data = json_decode( $contact_body_raw, true );

    if ( ! ( $contact_code >= 200 && $contact_code < 300 ) || empty( $contact_data['id'] ) ) {
      error_log( 'YouGile contact create returned status ' . $contact_code . ' body: ' . $contact_body_raw );
      wp_send_json_error( array( 'message' => 'Contact creation failed', 'status' => $contact_code ), 502 );
    }

    $contact_id = $contact_data['id'];

    // Create task linked to the contact person
    $tasks_endpoint = 'https://yougile.com/api-v2/tasks';
    $task_body = array(
      'title' => $title,
      'columnId' => get_theme_mod( 'evergreen_yougile_column_id' ),
      'deal'  => array(
        'contactPersonIds' => array( $contact_id ),
      ),
    );

    $task_args = $common_args;
    $task_args['body'] = wp_json_encode( $task_body );

    $task_resp = wp_remote_post( $tasks_endpoint, $task_args );
    if ( is_wp_error( $task_resp ) ) {
      error_log( 'YouGile task create failed: ' . $task_resp->get_error_message() );
      wp_send_json_error( array( 'message' => 'Failed to create task' ), 500 );
    }

    $task_code = wp_remote_retrieve_response_code( $task_resp );
    $task_body_raw = wp_remote_retrieve_body( $task_resp );
    $task_data = json_decode( $task_body_raw, true );

    if ( $task_code >= 200 && $task_code < 300 ) {
      wp_send_json_success( array( 'message' => 'Contact and task created', 'contact' => $contact_data, 'task' => $task_data ) );
    }

    error_log( 'YouGile task create returned status ' . $task_code . ' body: ' . $task_body_raw );
    wp_send_json_error( array( 'message' => 'Task creation failed', 'status' => $task_code ), 502 );
  }
}

add_action( 'admin_post_nopriv_evergreen_contact', 'evergreen_handle_contact_form' );
add_action( 'admin_post_evergreen_contact', 'evergreen_handle_contact_form' );

/**
 * Shortcode to render quiz container
 */
function evergreen_quiz_shortcode( $atts ) {
  ob_start();
  get_template_part( 'parts/quiz' );
  return ob_get_clean();
}
add_shortcode( 'evergreen_quiz', 'evergreen_quiz_shortcode' );

/**
 * REST endpoint: GET /wp-json/evergreen/v1/services
 * Optional query param: keys (comma-separated quiz_key values) to filter services that contain at least one key.
 */
function evergreen_quiz_rest_services( \WP_REST_Request $request ) {
  $keys = $request->get_param( 'keys' );
  if ( $keys && ! is_array( $keys ) ) {
    $keys = array_filter( array_map( 'trim', explode( ',', $keys ) ) );
  }

  $args = array(
    'post_type'      => 'service',
    'posts_per_page' => 100,
    'post_status'    => 'publish',
  );

  $posts = get_posts( $args );
  $out = array();

  foreach ( $posts as $p ) {
    $quiz_keys = get_field( 'quiz_key', $p->ID );
    if ( ! $quiz_keys ) {
      $quiz_keys = array();
    }
    // Normalize string -> array
    if ( ! is_array( $quiz_keys ) ) {
      $quiz_keys = preg_split( '/[\s,]+/', (string) $quiz_keys );
      $quiz_keys = array_filter( array_map( 'trim', $quiz_keys ) );
    }

    if ( $keys && count( $keys ) > 0 ) {
      $match = false;
      foreach ( $quiz_keys as $k ) {
        if ( in_array( $k, $keys, true ) ) {
          $match = true;
          break;
        }
      }
      if ( ! $match ) {
        continue;
      }
    }

    $thumb = get_the_post_thumbnail_url( $p->ID, 'medium' ) ?: '';
    $excerpt = get_the_excerpt( $p->ID );

    $out[] = array(
      'id'       => $p->ID,
      'title'    => get_the_title( $p->ID ),
      'link'     => get_permalink( $p->ID ),
      'excerpt'  => $excerpt,
      'thumb'    => $thumb,
      'quiz_key' => array_values( $quiz_keys ),
    );
  }

  return rest_ensure_response( $out );
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'evergreen/v1', '/services', array(
    'methods'  => 'GET',
    'callback' => 'evergreen_quiz_rest_services',
    'permission_callback' => '__return_true',
  ) );
} );
