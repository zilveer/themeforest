<?php

/*-----------------------------------------------------------------------------------*/
/* Manage slideshow's columns */
/*-----------------------------------------------------------------------------------*/
function edit_edge_slider_columns($columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"thumbnail" => 'Thumbnail', 
		"date" => 'Date',
	);

	return $columns;
}
add_filter('manage_edit-edge_slider_columns', 'edit_edge_slider_columns');


function manage_edge_slider_columns($column) {
	global $post;
	
	if ($post->post_type == "edge") {
		switch($column){
			case 'thumbnail':
				echo the_post_thumbnail('thumbnail');
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_edge_slider_columns', 10, 2);
/*-----------------------------------------------------------------------------------*/
/* Add image size for slideshow */
/*-----------------------------------------------------------------------------------*/
if ((isset($_REQUEST['post_id']) && get_post_type($_REQUEST['post_id']) == 'edge') || 
	(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')) {
	add_image_size('edge', 2500, 440, true);
}



/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Gallerys */
/*-----------------------------------------------------------------------------------*/
function register_edge_slider_post_type(){

	$icon = version_compare(get_bloginfo('version'), '3.8', '>=') ? 'dashicons-image-flip-horizontal' : false;
	
	register_post_type('edge', array(
		'labels' => array(
			'name' => __('Edge Slideshow','mk_framework'),
			'singular_name' => __('Edge Item','mk_framework'),
			'add_new' => __('Add New Edge Slider','mk_framework'),
			'add_new_item' => __('Add New Edge Slider Item', 'mk_framework'),
			'edit_item' => __('Edit Edge Slider Item','mk_framework'),
			'new_item' => __('New Edge Slider Item','mk_framework'),
			'view_item' => __('View Edge Slider Item','mk_framework'),
			'search_items' => __('Search Edge Slider Items','mk_framework'),
			'not_found' =>  __('No Edge slider item found','mk_framework'),
			'not_found_in_trash' => __('No Edge slider items found in Trash','mk_framework'),
			'parent_item_colon' => '',
		),
		'singular_label' => 'Edge',
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
add_action('init','register_edge_slider_post_type');

function edge_slider_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'slideshow' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'edge_slider_context_fixer' );


