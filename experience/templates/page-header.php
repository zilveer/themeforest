<?php
/**
 * Page Header
 *
 * Page header the most  page template files.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/

// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

if ( get_post_meta( $post->ID, 'experience_header_type', true ) != "none" ) {
	
	switch ( get_post_meta( $post->ID, 'experience_header_type', true ) ) {
		case "":
			get_template_part( 'templates/page-header-standard' );
		break;
		case "slider":
			get_template_part( 'templates/page-header-slider' );
		break;
	}
	
}