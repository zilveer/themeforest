<?php global $custom_query, $column_left, $column_right;
/**
 * Template Name: Blog - Image Left
 */

$fromShortcode = ($custom_query) ? true : false;

// Layout variables - Set size of image and content columns (specify # of columns 1-12 , total must = 12)
$column_left  = 5;
$column_right = MAX_COLUMNS - $column_left;  // 12 - 5 = 7

if ( $fromShortcode ) {

	// For shortcode just include blog posts loop
	get_template_part( 'templates/blog' ); 

} else {

	// Setup the query 
	$custom_query = new WP_Query( array('post_type'=>'post', 'paged'=>$paged) );
	
	// Include full content structure
	get_template_part( 'index' );

} ?>