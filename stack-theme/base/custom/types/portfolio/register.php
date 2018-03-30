<?php

add_action('init','register_portfolio_custom_post_type');
function register_portfolio_custom_post_type() {
	$arg = array(
		'labels' => array(
			'name' 					=> __('Portfolios', 'theme_admin' ),
			'singular_name' 		=> __('Portfolio', 'theme_admin' ),
			'add_new' 				=> __('Add New', 'theme_admin' ),
			'add_new_item' 			=> __('Add New Portfolio', 'theme_admin' ),
			'edit_item' 			=> __('Edit Portfolio', 'theme_admin' ),
			'new_item' 				=> __('New Portfolio', 'theme_admin' ),
			'view_item' 			=> __('View Portfolio', 'theme_admin' ),
			'search_items' 			=> __('Search Portfolio', 'theme_admin' ),
			'not_found' 			=> __('No Portfolio found', 'theme_admin' ),
			'not_found_in_trash' 	=> __('No Portfolio found in Trash', 'theme_admin' ), 
			'parent_item_colon' 	=> '',
		),
		'singular_label' 		=> __('Portfolio', 'theme_admin' ),
		'public' 				=> true,
		'exclude_from_search' 	=> false,
		'show_ui' 				=> true,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'rewrite' 				=> array( 'with_front' => false, 'slug' => '/'.theme_options('portfolio', 'slug', 'portfolio') ),
		'query_var' 			=> 'portfolio',
		'_builtin' 				=> false,
		'supports' 				=> array('title', 'editor', 'thumbnail'),
		'taxonomies'			=> array(),
		'show_in_menu' 			=> true,
		'has_archive'			=> false,
	);

	// Custom Icon
	if( is_readable( THEME_TYPES_DIR . '/portfolio/icon.png') )
		$arg['menu_icon'] = THEME_TYPES_URI . '/portfolio/icon.png';

	register_post_type('portfolio', $arg);
	
	//register taxonomy for Platform
	register_taxonomy('portfolio_category','portfolio',array(
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
		'show_in_nav_menus' 	=> true,
		'show_ui' 				=> true,
		'show_admin_column'		=> true,
		'sort'					=> true,
		'show_tagcloud' 		=> false,
		'query_var' 			=> 'cateogry'
	));
	
	
}

?>