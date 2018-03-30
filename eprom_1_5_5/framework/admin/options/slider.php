<?php

/* Slider Options
------------------------------------------------------------------------*/
 
global $r_option;

/* Class arguments */
$args = array( 
	'post_name' => 'wp_slider', 
	'sortable' => false,
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/custom_post',
	'textdomain' => SHORT_NAME
);

/* Post Labels */
$labels = array(
	'name' => _x( 'Nivo Slider', 'Admin - Nivo Slider', SHORT_NAME ),
	'singular_name' => _x( 'Slider', 'Admin - Nivo Slider', SHORT_NAME ),
	'add_new' => _x( 'Add New', 'Admin - Nivo Slider', SHORT_NAME ),
	'add_new_item' => _x( 'Add New Slider Item', 'Admin - Nivo Slider', SHORT_NAME ),
	'edit_item' => _x( 'Edit Slider Item', 'Admin - Nivo Slider', SHORT_NAME ),
	'new_item' => _x( 'New Slider Item', 'Admin - Nivo Slider', SHORT_NAME ),
	'view_item' => _x( 'View Slider Item', 'Admin - Nivo Slider', SHORT_NAME ),
	'search_items' => _x( 'Search Items', 'Admin - Nivo Slider', SHORT_NAME ),
	'not_found' =>  _x( 'No slider items found', 'Admin - Nivo Slider', SHORT_NAME ),
	'not_found_in_trash' => _x( 'No slider items found in Trash', 'Admin - Nivo Slider', SHORT_NAME ), 
	'parent_item_colon' => ''
);

/* Post Options */
$options = array(
	'labels' => $labels,
	'public' => true,
	'show_ui' => true,
	'show_in_nav_menus' => false,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array(
		'slug' => 'sliders',
		'with_front' => false,
	),
	'supports' => array('title', 'editor', 'thumbnail'),
	'menu_icon' => 'dashicons-slides'
);

/* Add class instance */
if ( isset( $r_option['js_nivo_slider'] ) && $r_option['js_nivo_slider'] == 'on')
	$sliders_manager = new R_Custom_Post( $args, $options );

/* Remove variables */
unset( $args, $options );


/*-------------------------------------------------------------------------------------*/


/* Column Layout
------------------------------------------------------------------------*/
add_filter( 'manage_edit-wp_slider_columns', 'slider_columns' );

function slider_columns( $columns ) {
	
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => _x( 'Title', 'Admin - Nivo Slider', SHORT_NAME ),
		'slider_id' => _x( 'Slider ID', 'Admin - Nivo Slider', SHORT_NAME ),
		'date' => _x( 'Date', 'Admin - Nivo Slider', SHORT_NAME )
	);

	return $columns;
}

add_action( 'manage_posts_custom_column', 'slider_display_columns' );

function slider_display_columns( $column ) {

	global $post;
	
	switch ($column) {
		case 'slider_id':
		    the_ID();
		
		break;
	}
}

?>