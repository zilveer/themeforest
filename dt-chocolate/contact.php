<?php
/* Template Name: Contact */

global $dt_is_contacts;
$dt_is_contacts=1;

get_header(); ?>
<?php get_sidebar(); ?>
<?php get_template_part( 'loop' , 'post' ); ?>
<?php get_footer(); ?>
