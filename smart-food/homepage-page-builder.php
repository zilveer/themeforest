<?php
/**
 * Template Name: Homepage Page Builder
 *
 * @package smartfood
 */
get_header('homepage'); 

get_template_part( 'templates/pages/content', 'slider' );

the_post(); 
the_content();

get_footer(); ?>