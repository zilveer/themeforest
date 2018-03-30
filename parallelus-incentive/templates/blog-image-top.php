<?php global $custom_query, $column_left, $column_right;
/**
 * Template Name: Blog - Image Top
 */

$fromShortcode = ($custom_query) ? true : false;

// no columns inside <article> for this layout
$column_left  = false;
$column_right = false; 

if ( $fromShortcode ) {

	// For shortcode just include blog posts loop
	get_template_part( 'templates/blog' ); 

} else {

	// Setup the query 
	$custom_query = new WP_Query( array('post_type'=>'post', 'paged'=>$paged) );
	
	// Include full content structure
	get_template_part( 'index' );

} ?>