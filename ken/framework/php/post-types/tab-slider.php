<?php

/*-----------------------------------------------------------------------------------*/
/* Manage slideshow's columns */
/*-----------------------------------------------------------------------------------*/
function edit_tab_slider_columns($columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Tab Slider Name', 'mk_framework' ),
		"date" => 'Date',
	);

	return $columns;
}
add_filter('manage_edit-tab_slider_columns', 'edit_tab_slider_columns');


/*-----------------------------------------------------------------------------------*/
/* Add image size for slideshow */
/*-----------------------------------------------------------------------------------*/
if ((isset($_REQUEST['post_id']) && get_post_type($_REQUEST['post_id']) == 'tab_slider') || 
	(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')) {
	add_image_size('tab_slider', 2500, 440, true);
}



/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Gallerys */
/*-----------------------------------------------------------------------------------*/
function register_tab_slider_post_type(){

	$icon = version_compare(get_bloginfo('version'), '3.8', '>=') ? 'dashicons-image-flip-horizontal' : false;
	
	register_post_type('tab_slider', array(
		'labels' => array(
			'name' => __('Tab Slides','mk_framework'),
			'singular_name' => __('Tab Item','mk_framework'),
			'add_new' => __('Add New Tab Slide','mk_framework'),
			'add_new_item' => __('Add New Tab Slider Item', 'mk_framework'),
			'edit_item' => __('Edit Tab Slider Item','mk_framework'),
			'new_item' => __('New Tab Slider Item','mk_framework'),
			'view_item' => __('View Tab Slider Item','mk_framework'),
			'search_items' => __('Search Tab Slider Items','mk_framework'),
			'not_found' =>  __('No Tab slider item found','mk_framework'),
			'not_found_in_trash' => __('No Tab slider items found in Trash','mk_framework'),
			'parent_item_colon' => '',
		),
		'singular_label' => 'Tab Slide',
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'menu_icon' => $icon,
		'menu_position' => 100,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'query_var' => false,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'page-attributes', 'editor', 'revisions')
	));
}
add_action('init','register_tab_slider_post_type');

function tab_slider_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'slideshow' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'tab_slider_context_fixer' );


