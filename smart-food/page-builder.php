<?php
/**
 * Template Name: Page Builder
 * The template for displaying pages built with the page builder.
 *
 * @package smartfood
 */

get_header(); ?>

<?php 
	the_post(); 
	the_content();
?>

<?php get_footer();?>