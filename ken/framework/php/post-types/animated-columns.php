<?php



/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Animated Columns */
/*-----------------------------------------------------------------------------------*/
function register_animated_columns_post_type(){
	register_post_type('animated-columns', array(
		'labels' => array(
			'name' => __('Animated Columns','mk_framework'), __('post type general name','mk_framework'),
			'singular_name' => __('Animated Column','mk_framework'), __('post type singular name','mk_framework'),
			'add_new' => __('Add New Animated Column','mk_framework'), __('Animated Columns','mk_framework'),
			'add_new_item' => __('Add New Animated Column', 'mk_framework' ),
			'edit_item' => __('Edit Animated Column','mk_framework'),
			'new_item' => __('New Animated Column','mk_framework'),
			'view_item' => __('View Animated Column','mk_framework'),
			'search_items' => __('Search Animated Columns','mk_framework'),
			'not_found' =>  __('No Animated Columns found','mk_framework'),
			'not_found_in_trash' => __('No Animated Columns found in Trash','mk_framework'),
			'parent_item_colon' => '',
			
		),
		'singular_label' => 'animated-columns',
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'menu_icon'=> 'dashicons-align-center',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'menu_position' => 100,
		'query_var' => false,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'page-attributes', 'revisions', 'editor')
	));
}
add_action('init','register_animated_columns_post_type');

function animated_columns_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'animated-columns' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'animated_columns_context_fixer' );


