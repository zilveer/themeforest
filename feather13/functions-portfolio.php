<?php


/* Get meta field values
/*-------------------------------------------------------*/

// Layout
$meta_layout = wpb_meta('_portfolio_layout', 'grid one-third');

// Portfolio Loop - orderby, order, category
$meta_loop_orderby = wpb_meta('_portfolio_orderby', 'title');
$meta_loop_order = wpb_meta('_portfolio_order', 'ASC');
$meta_loop_category = wpb_meta('_portfolio_category');

// View
$meta_view = wpb_meta('_portfolio_view');

// Isotope class
$isotope_class = $meta_view?'':'iso';


/* Set portfolio loop arguments
/*-------------------------------------------------------*/

// Loop arugments
$loop_args = array(
	'post_type'			=> 'portfolio',
	'posts_per_page'	=> -1, // show all posts
	'orderby'			=> $meta_loop_orderby,
	'order'				=> $meta_loop_order
);

// Loop category, if set
if ( $meta_loop_category ) {
	$loop_args['tax_query'] = array(
		array(
			'taxonomy'	=> 'portfolio_category',
			'field'		=> 'id',
			'terms'		=> $meta_loop_category
		)
	);
}


/* Query portfolio posts
/*-------------------------------------------------------*/

$loop = new WP_Query($loop_args);
