<?php

/*-----------------------------------------------------------------------------------*/
/* Manage Employee's columns */
/*-----------------------------------------------------------------------------------*/

function edit_employees_columns($employee_columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		'title' => __('Employee Name', 'mk_framework'),
		"position" => __('Position', 'mk_framework' ),
		"desc" => __('Description', 'mk_framework' ),
		"thumbnail" => __('Thumbnail', 'mk_framework' ),
	);

	return $columns;
}
add_filter('manage_edit-employees_columns', 'edit_employees_columns');

function manage_employees_columns($column) {
	global $post;
	
	if ($post->post_type == "employees") {
		switch($column){
			case "position":
				echo get_post_meta($post->ID, '_position', true);
				break;
			case "desc":
				echo get_post_meta($post->ID, '_desc', true);
				break;
			
			case 'thumbnail':
				echo the_post_thumbnail('thumbnail');
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_employees_columns', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Gallerys */
/*-----------------------------------------------------------------------------------*/
function register_employees_post_type(){
	register_post_type('employees', array(
		'labels' => array(
			'name' => __('Employees','mk_framework'),
			'singular_name' => __('Team Member','mk_framework'),
			'add_new' => __('Add New Member','mk_framework'),
			'add_new_item' => __('Add New Team Member', 'mk_framework' ),
			'edit_item' => __('Edit Team Member','mk_framework'),
			'new_item' => __('New Team Member','mk_framework'),
			'view_item' => __('View Team Member','mk_framework'),
			'search_items' => __('Search Team Members','mk_framework'),
			'not_found' =>  __('No Team Member found','mk_framework'),
			'not_found_in_trash' => __('No Team Members found in Trash','mk_framework'),
			'parent_item_colon' => '',
			
		),
		'singular_label' => 'employees',
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'menu_icon'=> 'dashicons-groups',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'menu_position' => 100,
		'query_var' => false,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'thumbnail', 'page-attributes', 'revisions')
	));
}
add_action('init','register_employees_post_type');

function employees_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'employees' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'employees_context_fixer' );


