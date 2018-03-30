<?php

/*-----------------------------------------------------------------------------------*/
/* Manage Pricing's columns */
/*-----------------------------------------------------------------------------------*/

function edit_pricing_columns($pricing_columns) {
	$pricing_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		'title' => __('Pricing Table', 'mk_framework'),
	);
	return $pricing_columns;
}
add_filter('manage_edit-pricing_columns', 'edit_pricing_columns');





/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Pricing */
/*-----------------------------------------------------------------------------------*/
function register_pricing_post_type(){
	register_post_type('pricing', array(
		'labels' => array(
			'name' => __('Pricing Tables','mk_framework'),
			'singular_name' => __('Pricing Item','mk_framework'),
			'add_new' => __('Add New Pricing Item','mk_framework'),
			'add_new_item' => __('Add New Pricing Item', 'mk_framework' ),
			'edit_item' => __('Edit Pricing Item','mk_framework'),
			'new_item' => __('New Pricing Item','mk_framework'),
			'view_item' => __('View Pricing Item','mk_framework'),
			'search_items' => __('Search Pricing Item','mk_framework'),
			'not_found' =>  __('No Pricing Item found','mk_framework'),
			'not_found_in_trash' => __('No Pricing Item found in Trash','mk_framework'),
			'parent_item_colon' => '',
			
		),
		'singular_label' => 'pricing',
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'menu_icon'=> 'dashicons-tag',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'menu_position' => 100,
		'query_var' => false,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'page-attributes', 'thumbnail', 'revisions'),
	));
}
add_action('init','register_pricing_post_type');

function pricing_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'pricing' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'pricing_context_fixer' );


