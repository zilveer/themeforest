<?php global $custom_query, $params, $portfolio;
/**
 * Template Name: Portfolio - Rows
 */

// Set the portfolio display style
$portfolio['type'] = 'fitRows';
$portfolio['filtered'] = false;

// Check for the custom query, most likely from shortcode
$fromShortcode = ($custom_query) ? true : false;

// Paging doesn't work for page templates set as home page. This is a workaround.
$paged = ($paged) ? $paged : get_query_var('page');
if ($paged < 1) {
	$paged = 1;
}

// Load the template 
if ( $fromShortcode ) {

	// For shortcode just include portfolio loop
	get_template_part( 'templates/grid' ); 

} else {

	// Setup the query 
	$args = array(
		'post_type' => 'portfolio',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => 12,
		'paged' => $paged
	);
	$custom_query = new WP_Query( $args );
	
	// Include full content structure with header and footers
	get_template_part( 'archive-portfolio' );

} ?>