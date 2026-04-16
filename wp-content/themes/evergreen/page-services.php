<?php
/*
Template Name: services
 */

get_header();

if (get_field('hero_title')) {
    get_template_part( 'parts/hero' ); 
}
get_template_part( 'parts/services-grid' );
get_template_part( 'parts/contact-form' );

get_footer();
?>