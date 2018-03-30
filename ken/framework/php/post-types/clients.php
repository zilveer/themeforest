<?php

/*-----------------------------------------------------------------------------------*/
/* Manage Employee's columns */
/*-----------------------------------------------------------------------------------*/

function edit_clients_columns($clients_columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		'title' => __('Client Name', 'mk_framework'),
		"thumbnail" => __('Thumbnail', 'mk_framework' ),
	);

	return $columns;
}
add_filter('manage_edit-clients_columns', 'edit_clients_columns');

function manage_clients_columns($column) {
	global $post;
	
	if ($post->post_type == "clients") {
		switch($column){
			
			case 'thumbnail':
				echo the_post_thumbnail('thumbnail');
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_clients_columns', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Gallerys */
/*-----------------------------------------------------------------------------------*/
function register_clients_post_type(){
	register_post_type('clients', array(
		'labels' => array(
			'name' => __('Clients','mk_framework'),
			'singular_name' => __('Client','mk_framework'),
			'add_new' => __('Add New Client','mk_framework'),
			'add_new_item' => __('Add New Client', 'mk_framework' ),
			'edit_item' => __('Edit Client','mk_framework'),
			'new_item' => __('New Client','mk_framework'),
			'view_item' => __('View Client','mk_framework'),
			'search_items' => __('Search Clients','mk_framework'),
			'not_found' =>  __('No Clients found','mk_framework'),
			'not_found_in_trash' => __('No Clients found in Trash','mk_framework'),
			'parent_item_colon' => '',
			
		),
		'singular_label' => 'clients',
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'menu_icon'=> 'dashicons-businessman',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'menu_position' => 100,
		'query_var' => false,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'thumbnail', 'page-attributes', 'revisions')
	));
}
add_action('init','register_clients_post_type');

function clients_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'clients' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'clients_context_fixer' );


