<?php

add_action('init','register_testimonial_custom_post_type');
function register_testimonial_custom_post_type() {
	$arg = array(
		'labels' => array(
			'name' 					=> __('Testimonials', 'theme_admin' ),
			'singular_name' 		=> __('Testimonial', 'theme_admin' ),
			'add_new' 				=> __('Add New', 'theme_admin' ),
			'add_new_item' 			=> __('Add New Testimonial', 'theme_admin' ),
			'edit_item' 			=> __('Edit Testimonial', 'theme_admin' ),
			'new_item' 				=> __('New Testimonial', 'theme_admin' ),
			'view_item' 			=> __('View Testimonial', 'theme_admin' ),
			'search_items' 			=> __('Search Testimonial', 'theme_admin' ),
			'not_found' 			=> __('No Testimonial found', 'theme_admin' ),
			'not_found_in_trash' 	=> __('No Testimonial found in Trash', 'theme_admin' ), 
			'parent_item_colon' 	=> '',
		),
		'singular_label' 		=> __('Testimonial', 'theme_admin' ),
		'public' 				=> true,
		'exclude_from_search' 	=> true,
		'show_ui' 				=> true,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'rewrite' 				=> array( 'with_front' => false, 'slug' => '/testimonial' ),
		'query_var' 			=> 'testimonial',
		'_builtin' 				=> false,
		'supports' 				=> array('title'),//false,
		'taxonomies'			=> array(),
		'show_in_menu' 			=> true,
		'has_archive'			=> false,
	);

	// Custom Icon
	if( is_readable( THEME_TYPES_DIR . '/testimonial/icon.png') )
		$arg['menu_icon'] = THEME_TYPES_URI . '/testimonial/icon.png';

	register_post_type('testimonial', $arg);
	
	//register taxonomy for Platform
	register_taxonomy('testimonial_category','testimonial',array(
		'hierarchical' => false,
		'labels' => array(
			'name' => __( 'Category', 'theme_admin' ),
			'singular_name' => __( 'Category', 'theme_admin' ),
			'search_items' =>  __( 'Search Category', 'theme_admin' ),
			'popular_items' => __( 'Popular Category', 'theme_admin' ),
			'all_items' => __( 'All Category', 'theme_admin' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Category', 'theme_admin' ), 
			'update_item' => __( 'Update Category', 'theme_admin' ),
			'add_new_item' => __( 'Add New Category', 'theme_admin' ),
			'new_item_name' => __( 'New Category Name', 'theme_admin' ),
			'separate_items_with_commas' => __( 'Separate Category with commas', 'theme_admin' ),
			'add_or_remove_items' => __( 'Add or remove Category', 'theme_admin' ),
			'choose_from_most_used' => __( 'Choose from the most used Category', 'theme_admin' ),
			'menu_name' => __( 'Category', 'theme_admin' ),
		),
		'public' 				=> true,
		'show_in_nav_menus' 	=> false,
		'show_ui' 				=> true,
		'show_admin_column'		=> true,
		'sort'					=> true,
		'show_tagcloud' 		=> false,
		'query_var' 			=> true,
	));
}
?>