<?php
/*
Template Name: main
 */

get_header();
?>

  <main class="front-page" role="main">
    <?php get_template_part( 'parts/hero' ); ?>
    <?php get_template_part( 'parts/services' ); ?>
    <?php get_template_part( 'parts/why-us' ); ?>
    <?php get_template_part( 'parts/how-we-work' ); ?>
    <?php get_template_part( 'parts/partners' ); ?>
    <?php get_template_part( 'parts/before-after' ); ?>
    <?php get_template_part( 'parts/testimonials' ); ?>
    <?php get_template_part( 'parts/contact-form' ); ?>
  </main>

<?php
get_footer();
