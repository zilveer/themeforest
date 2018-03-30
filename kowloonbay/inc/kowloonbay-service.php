<?php

/* KowloonBay Service: create post type */
add_action('init', 'kowloonbay_service_register_post_type');
function kowloonbay_service_register_post_type()
{
	// Register service item
	$service = array(
		'show_ui' => true,
		'show_in_menu' => true,
		'public' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-editor-ul',
		'query_var' => 'service',
		'rewrite' => array('slug' => 'service'),
		'has_archive' => false,
		'supports' => array(
			'title',
			'editor',
			'revisions',
			'page-attributes'
		),
		'labels' => array(
			'name' => 'Services',
			'singular_name' => 'Service',
			'add_new' => 'Add New Service',
			'add_new_item' => 'Add New Service',
			'edit_item' => 'Edit Service',
			'new_item' => 'New Service',
			'view_item' => 'View Service',
			'search_items' => 'Search Services',
			'not_found' => 'No Services Found',
			'not_found_in_trash' => 'No Services Found In Trash'
		),
	);

	register_post_type( 'kowloonbay_service', $service );
}