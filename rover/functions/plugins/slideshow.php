<?php
/**
 * @package by Theme Record
 * @auther: MattMao
*/

add_action('init', 'theme_create_post_type_slideshow');
add_filter('manage_edit-slideshow_columns', 'prod_edit_columns_slideshow');
add_action('manage_posts_custom_column',  'prod_custom_columns_slideshow');
add_action( 'add_meta_boxes', 'theme_slideshow_meta_boxes' );


#
#Create post type for slideshow
#
function theme_create_post_type_slideshow() 
{
	$labels = array(
		'name' => __( 'Slideshows', 'TR'),
		'singular_name' => __( 'Slideshow', 'TR' ),
		'add_new' => __('Add New', 'TR'),
		'add_new_item' => __('Add New Slideshow', 'TR'),
		'edit_item' => __('Edit Slideshow', 'TR'),
		'new_item' => __('New Slideshow', 'TR'),
		'view_item' => __('View Slideshow', 'TR'),
		'search_items' => __('Search Slideshow', 'TR'),
		'not_found' => __('No slideshow found', 'TR'),
		'not_found_in_trash' => __('No slideshow found in Trash', 'TR'), 
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'capability_type' => 'page',
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'show_ui' => true,
		'show_in_menu' => 'theme-settings',
		'query_var' => false,
		'can_export' => true,
		'rewrite' => false,
		'hierarchical' => false,
		'has_archive' => false,
		'show_in_nav_menus' => false,
		'menu_position' => 25,
		'supports' => array('title', 'page-attributes'),
	); 

	register_post_type( 'slideshow' , $args );
}



#
#Prod edit columns
#
function prod_edit_columns_slideshow($columns)
{
	$columns = array();

	$columns['cb'] = '<input type=\'checkbox\' />';
	$columns['title'] = __('Title', 'TR');
	$columns['slideshow_type'] = __('Type', 'TR');
	$columns['slideshow_actions'] = __('Actions', 'TR');
	
	return $columns;
}



#
#Prod custom columns
#
function prod_custom_columns_slideshow($column)
{
	global $post;

	$type = get_meta_option('slideshow_type');

	switch ($type)
	{
		case 'full' : $slideshow_type = 'Full Width Image'; break;
		case 'fixed' : $slideshow_type = 'Fixed Width Image'; break;
		case 'text' : $slideshow_type = 'Image With Text'; break;
		case 'video' : $slideshow_type = 'Video'; break;	
	}

	switch ($column)
	{
		case 'slideshow_type' :	
			echo '<p>'. $slideshow_type .'</p>';	
		break;

		case 'slideshow_actions' :	
			echo '<p><a href="'. admin_url('post.php?post='.$post->ID.'&action=edit'). '">'. __('Edit', 'TR'). '</a></p>';			
		break;		
	}
}



#
#Remove meta boxes
#
function theme_slideshow_meta_boxes() {
	remove_meta_box( 'commentstatusdiv', 'slideshow' , 'normal' );
	remove_meta_box( 'slugdiv', 'slideshow' , 'normal' );
	remove_meta_box( 'commentsdiv', 'slideshow' , 'normal' );
}

?>