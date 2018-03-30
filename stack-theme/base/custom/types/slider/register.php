<?php

add_action('init','register_slider_custom_post_type');
function register_slider_custom_post_type() {
	$arg = array(
		'labels' => array(
			'name' 					=> __('Sliders', 'theme_admin' ),
			'singular_name' 		=> __('Slider', 'theme_admin' ),
			'add_new' 				=> __('Add New', 'theme_admin' ),
			'add_new_item' 			=> __('Add New Slider', 'theme_admin' ),
			'edit_item' 			=> __('Edit Slider', 'theme_admin' ),
			'new_item' 				=> __('New Slider', 'theme_admin' ),
			'view_item' 			=> __('View Slider', 'theme_admin' ),
			'search_items' 			=> __('Search Slider', 'theme_admin' ),
			'not_found' 			=> __('No Slider found', 'theme_admin' ),
			'not_found_in_trash' 	=> __('No Slider found in Trash', 'theme_admin' ), 
			'parent_item_colon' 	=> '',
		),
		'singular_label' 		=> __('Slider', 'theme_admin' ),
		'public' 				=> true,
		'exclude_from_search' 	=> true,
		'publicly_queryable'	=> false,
		'show_ui' 				=> true,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'rewrite' 				=> true,
		'query_var' 			=> 'slider',
		'supports' 				=> array('title'), //false,
		'taxonomies'			=> array(),
		'show_in_menu' 			=> true,
		'show_in_nav_menus'		=> false,
		'has_archive'			=> false,
	);

	// Custom Icon
	if( is_readable( THEME_TYPES_DIR . '/slider/icon.png') )
		$arg['menu_icon'] = THEME_TYPES_URI . '/slider/icon.png';

	register_post_type('slider', $arg);
}
?>