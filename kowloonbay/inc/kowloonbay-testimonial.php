<?php

/* KowloonBay Testimonial: create post type */
add_action('init', 'kowloonbay_testimonial_register_post_type');
function kowloonbay_testimonial_register_post_type()
{
	// Register testimonial item
	$testimonial = array(
		'show_ui' => true,
		'show_in_menu' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-awards',
		'query_var' => 'testimonial',
		'rewrite' => array('slug' => 'testimonial'),
		'has_archive' => false,
		'supports' => array(
			'title',
			'editor',
			'revisions',
			'page-attributes'
		),
		'labels' => array(
			'name' => 'Testimonials',
			'singular_name' => 'Testimonial',
			'add_new' => 'Add New Testimonial',
			'add_new_item' => 'Add New Testimonial',
			'edit_item' => 'Edit Testimonial',
			'new_item' => 'New Testimonial',
			'view_item' => 'View Testimonial',
			'search_items' => 'Search Testimonials',
			'not_found' => 'No Testimonials Found',
			'not_found_in_trash' => 'No Testimonials Found In Trash'
		),
	);

	register_post_type( 'kowloonbay_tmnl', $testimonial );
}