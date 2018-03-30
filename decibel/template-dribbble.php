<?php
/**
 * Template Name: Dribbble Gallery
 */
get_header();

	if ( function_exists( 'wolf_dribbble_gallery' ) ) wolf_dribbble_gallery();

get_footer(); 
?>