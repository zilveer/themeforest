<?php
function register_ads_post_type(){
	register_post_type('ads', array(
		'labels' => array(
			'name' => __('Ads','framework' ),
			'singular_name' => __('Ad', 'theme' ),
			'add_new' => __('Add New','framework' ),
			'add_new_item' => __('Add New ad', 'theme' ),
			'edit_item' => __('Edit ad', 'theme' ),
			'new_item' => __('New ad', 'theme' ),
			'view_item' => __('View ad', 'theme' ),
			'search_items' => __('Search in ads', 'theme' ),
			'not_found' =>  __('No ads found', 'theme' ),
			'not_found_in_trash' => __('No ads found in Trash', 'theme' ), 
			'parent_item_colon' => '',
			'menu_name' => __('Ads System', 'theme' ),
		),
		'singular_label' => __('ads', 'theme' ),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 22,
		'capability_type' => 'post',
		'capabilities' => array(
			'publish_posts' => 'moderate_comments',
			'edit_posts' => 'moderate_comments',
			'edit_others_posts' => 'moderate_comments',
			'delete_posts' => 'moderate_comments',
			'delete_others_posts' => 'moderate_comments',
			'read_private_posts' => 'moderate_comments',
			'edit_post' => 'moderate_comments',
			'delete_post' => 'moderate_comments',
			'read_post' => 'moderate_comments',
		),
		'hierarchical' => false,
		'supports' => array('title', 'editor'),
		'has_archive' => false,
		'rewrite' => array( 'slug' => 'banners', 'with_front' => true, 'pages' => true, 'feeds'=>false ),
		'query_var' => false,
		'can_export' => true,
		'show_in_nav_menus' => false,
		 'menu_icon' => 'dashicons-feedback'
	));
	flush_rewrite_rules();	
}
add_action('init','register_ads_post_type');
