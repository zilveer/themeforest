<?php

/* Tracks Manager Options
 ------------------------------------------------------------------------*/
 
global $r_option;

/* Class arguments */
$args = array( 
	'post_name' => 'wp_tracks', 
	'sortable' => false,
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/custom_post'
);

/* Post Labels */
$labels = array(
	'name' => _x( 'Audio Tracks', 'Admin - Tracks Manager', SHORT_NAME ),
	'singular_name' => _x( 'Tracks', 'Admin - Tracks Manager', SHORT_NAME ),
	'add_new' => _x( 'Add New', 'Admin - Tracks Manager', SHORT_NAME ),
	'add_new_item' => _x( 'Add New Tracks', 'Admin - Tracks Manager', SHORT_NAME ),
	'edit_item' => _x( 'Edit Tracks', 'Admin - Tracks Manager', SHORT_NAME ),
	'new_item' => _x( 'New Tracks', 'Admin - Tracks Manager', SHORT_NAME ),
	'view_item' => _x( 'View Tracks', 'Admin - Tracks Manager', SHORT_NAME ),
	'search_items' => _x( 'Search Tracks', 'Admin - Tracks Manager', SHORT_NAME ),
	'not_found' =>  _x( 'No tracks found', 'Admin - Tracks Manager', SHORT_NAME ),
	'not_found_in_trash' => _x( 'No tracks found in Trash', 'Admin - Tracks Manager', SHORT_NAME ), 
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
		'slug' => 'tracks',
		'with_front' => false,
	),
	'supports' => array( 'title', 'editor', 'custom-fields', 'comments', 'thumbnail'),
	'menu_icon' => 'dashicons-format-audio'
);

/* Add class instance */
if ( isset( $r_option['js_soundmanager'] ) && $r_option['js_soundmanager'] == 'on' )
	$tracks_manager = new R_Custom_Post( $args, $options );

/* Remove variables */
unset( $args, $options );


/*-------------------------------------------------------------------------------------*/


/* Column Layout
------------------------------------------------------------------------*/

add_filter( 'manage_edit-wp_tracks_columns', 'tracks_columns' );

function tracks_columns( $columns ) {
	
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => _x( 'Title', 'Admin - Tracks Manager', SHORT_NAME ),
		'tracks_id' => _x( 'Tracks ID', 'Admin - Tracks Manager', SHORT_NAME ),
		'date' => _x( 'Date', 'Admin - Tracks Manager', SHORT_NAME )
	);

	return $columns;
}

add_action( 'manage_posts_custom_column', 'tracks_display_columns' );

function tracks_display_columns( $column ) {
	global $post;
	
	switch ( $column ) {
		case 'tracks_id' :
		    the_ID();
		
		break;
	}
}

?>