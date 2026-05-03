<?php
/*
Template Name: main
 */

get_header();
?>
    <?php
        if (get_field('hero_title')) {
            get_template_part( 'parts/hero-main' ); 
        }
    ?>
    <?php get_template_part( 'parts/services-slider' ); ?>
    <?php get_template_part( 'parts/why-us' ); ?>
    <?php get_template_part( 'parts/quiz' ); ?>
    <?php get_template_part( 'parts/how-we-work' ); ?>
    <?php get_template_part( 'parts/partners' ); ?>
    <?php get_template_part( 'parts/before-after' ); ?>
    <?php get_template_part( 'parts/testimonials' ); ?>
    <?php get_template_part( 'parts/contact-form' ); ?>

<?php
get_footer();
?>