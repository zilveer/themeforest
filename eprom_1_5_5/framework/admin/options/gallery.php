<?php

/* Gallery Options
------------------------------------------------------------------------*/
global $r_option, $gallery_cp;

/* Slug */
$gallery_slug = 'gallery';
if ( isset( $r_option['gallery_slug'] ) && $r_option['gallery_slug'] != '') 
	$gallery_slug = $r_option['gallery_slug'];

/* Order */
if ( isset( $r_option['gallery_order'] ) && $r_option['gallery_order'] == 'custom' ) 
	$gallery_sortable = true;
else 
	$gallery_sortable = false;

/* Class arguments */
$args = array( 
	'post_name' => 'wp_gallery', 
	'sortable' => $gallery_sortable,
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/custom_post',
	'textdomain' => SHORT_NAME
);

/* Post Labels */
$labels = array(
	'name' => _x( 'Gallery', 'Admin - Gallery', SHORT_NAME ),
	'singular_name' => _x( 'Gallery', 'Admin - Gallery', SHORT_NAME ),
	'add_new' => _x( 'Add New Album', 'Admin - Gallery', SHORT_NAME ),
	'add_new_item' => _x( 'Add New Album', 'Admin - Gallery', SHORT_NAME ),
	'edit_item' => _x( 'Edit Album', 'Admin - Gallery', SHORT_NAME ),
	'new_item' => _x( 'New Album', 'Admin - Gallery', SHORT_NAME ),
	'view_item' => _x( 'View Album', 'Admin - Gallery', SHORT_NAME ),
	'search_items' => _x( 'Search Albums', 'Admin - Gallery', SHORT_NAME ),
	'not_found' =>  _x( 'No albums found', 'Admin - Gallery', SHORT_NAME ),
	'not_found_in_trash' => _x( 'No albums found in Trash', 'Admin - Gallery', SHORT_NAME ), 
	'parent_item_colon' => ''
);

/* Post Options */
$options = array(
	'labels' => $labels,
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array(
					 'slug' => $gallery_slug,
					 'with_front' => false,
					 ),
	'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'comments' ),
	'menu_icon' => 'dashicons-camera'
);

/* Add class instance */
$gallery_cp = new R_Custom_Post( $args, $options );

/* Remove variables */
unset( $args, $options );


/*-------------------------------------------------------------------------------------*/


/* Column Layout
------------------------------------------------------------------------*/

add_filter( 'manage_edit-wp_gallery_columns', 'gallery_columns' );

function gallery_columns( $columns ) {
	
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => _x( 'Album Title', 'Admin - Gallery', SHORT_NAME ),
		'gallery_preview' => _x( 'Album Cover', 'Admin - Gallery', SHORT_NAME ),
		'date' => 'Date'
	);

	return $columns;
}

add_action( 'manage_posts_custom_column', 'gallery_display_columns' );

function gallery_display_columns( $column ) {
	global $post, $gallery_cp;
	
	switch ( $column ) {

		case 'gallery_preview' :
			$image = get_post_custom();
											  
			/* Image */
			if ( isset( $image['_album_cover'][0] ) && $gallery_cp->image_exists($image['_album_cover'][0]))
				echo '<img src="' . $gallery_cp->image_resize('80', '60', $image['_album_cover'][0]) . '" alt="' . esc_attr(get_the_title()) . '" style="padding:5px"/>';
		
			break;
	}
}

?>