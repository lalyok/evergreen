<?php
/*
Template Name: portfolio
 */

get_header();

if (get_field('hero_title')) {
    get_template_part( 'parts/hero' ); 
}

get_template_part( 'parts/portfolio-projects' );
get_template_part( 'parts/contact-form' );

get_footer();
?>