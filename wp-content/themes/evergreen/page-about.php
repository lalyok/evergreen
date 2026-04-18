<?php
/*
Template Name: about-us
 */

get_header();

if (get_field('hero_title')) {
    get_template_part( 'parts/hero' ); 
}

get_template_part( 'parts/about-content' );
get_template_part( 'parts/about-us-form' );

get_footer();
?>