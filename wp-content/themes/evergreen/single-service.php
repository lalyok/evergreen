<?php
/*
Template Name: single-service
 */

get_header();

get_template_part( 'parts/hero-service' );
get_template_part( 'parts/service-description' );

if (get_field('about-service-includes')) {
    get_template_part( 'parts/service-includes' );
}

if (get_field('about-service-extra-info')) {
    get_template_part( 'parts/service-extra-info' );
}

if (get_field('about-service-is-tarifs')) {
    get_template_part( 'parts/service-tarifs' );
}

if (get_field('about-service-is-gallery')) {
    get_template_part( 'parts/service-projects' );
}

get_template_part( 'parts/contact-form' );

get_footer();
?>