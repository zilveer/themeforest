<?php
function register_portfolio_post_type(){
	$pt_slug = mom_option('pt_slug');
	if (empty($pt_slug)) {
		$pt_slug = 'portfolio_item';
	}
	$pt_cat_slug = mom_option('pt_cat_slug');
	if (empty($pt_cat_slug)) {
		$pt_cat_slug = 'portfolio_category';
	}

	register_post_type('portfolio', array(
		'labels' => array(
			'name' => __('Portfolio items','framework' ),
			'singular_name' => __('Portfolio Item', 'framework' ),
			'add_new' => __('Add New','framework' ),
			'add_new_item' => __('Add New Portfolio Item', 'framework' ),
			'edit_item' => __('Edit Portfolio Item', 'framework' ),
			'new_item' => __('New Portfolio Item', 'framework' ),
			'view_item' => __('View Portfolio Item', 'framework' ),
			'search_items' => __('Search Portfolio Items', 'framework' ),
			'not_found' =>  __('No portfolio item found', 'framework' ),
			'not_found_in_trash' => __('No portfolio items found in Trash', 'framework' ), 
			'parent_item_colon' => '',
			'menu_name' => __('Portfolio', 'framework' ),
		),
		'singular_label' => __('portfolio', 'framework' ),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 20,
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
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'page-attributes'),
		'has_archive' => false,
		'rewrite' => array( 'slug' => $pt_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
		'query_var' => false,
		'can_export' => true,
		'show_in_nav_menus' => true,
	));

	//register taxonomy for portfolio
	register_taxonomy('portfolio_category','portfolio',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => __( 'Portfolio Categories', 'framework' ),
			'singular_name' => __( 'Portfolio Category', 'framework' ),
			'search_items' =>  __( 'Search Categories', 'framework' ),
			'popular_items' => __( 'Popular Categories', 'framework' ),
			'all_items' => __( 'All Categories', 'framework' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Portfolio Category', 'framework' ), 
			'update_item' => __( 'Update Portfolio Category', 'framework' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'framework' ),
			'new_item_name' => __( 'New Portfolio Category Name', 'framework' ),
			'separate_items_with_commas' => __( 'Separate Portfolio category with commas', 'framework' ),
			'add_or_remove_items' => __( 'Add or remove portfolio category', 'framework' ),
			'choose_from_most_used' => __( 'Choose from the most used portfolio category', 'framework' ),
			'menu_name' => __( 'Categories', 'framework' ),
		),
		'public' => false,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_tagcloud' => false,
		'query_var' => false,
		'rewrite' => array( 'slug' => $pt_cat_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
		
	));
	
	
}
add_action('init','register_portfolio_post_type');

add_action('init', 'custom_taxonomy_flush_rewrite');
function custom_taxonomy_flush_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}