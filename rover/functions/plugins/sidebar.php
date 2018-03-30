<?php
/**
 * @package by Theme Record
 * @auther: MattMao
*/

add_action('init', 'theme_create_post_type_sidebar');
add_filter('manage_edit-sidebar_columns', 'prod_edit_columns_sidebar');
add_action('manage_posts_custom_column',  'prod_custom_columns_sidebar');
add_action( 'add_meta_boxes', 'theme_sidebar_meta_boxes' );


#
#Create post type for sidebar
#
function theme_create_post_type_sidebar() 
{
	$labels = array(
		'name' => __( 'Sidebars','TR'),
		'singular_name' => __( 'Sidebar','TR' ),
		'add_new' => __('Add New','TR'),
		'add_new_item' => __('Add New Sidebar','TR'),
		'edit_item' => __('Edit Sidebar','TR'),
		'new_item' => __('New Sidebar','TR'),
		'view_item' => __('View Sidebar','TR'),
		'search_items' => __('Search Sidebar','TR'),
		'not_found' => __('No sidebar found','TR'),
		'not_found_in_trash' => __('No sidebar found in Trash','TR'), 
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'capability_type' => 'post',
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
		'supports' => 'comments'
	); 

	register_post_type( 'sidebar' , $args );
}



#
#Prod edit columns
#
function prod_edit_columns_sidebar($columns)
{
	$columns = array();

	$columns['cb'] = '<input type=\'checkbox\' />';
	$columns['sidebar_name'] = __('Name', 'TR');
	$columns['sidebar_shortcode'] = __('Shortcode', 'TR');
	$columns['sidebar_desc'] = __('Description', 'TR');
	$columns['sidebar_actions'] = __('Actions', 'TR');
	
	return $columns;
}



#
#Prod custom columns
#
function prod_custom_columns_sidebar($column)
{
	global $post;

	$name = get_meta_option('sidebar_name');
	$shortcode = '[sidebar id="'.$post->ID.'"]';
	$desc = get_meta_option('sidebar_desc');

	switch ($column)
	{
		case 'sidebar_name' :	
			echo '<p>'. $name .'</p>';	
		break;
		
		case 'sidebar_shortcode' :	
			echo '<p>'. $shortcode .'</p>';	
		break;
		
		case 'sidebar_desc' :	
			echo '<p>'. $desc .'</p>';	
		break;	

		case 'sidebar_actions' :	
			echo '<p><a href="'. admin_url('post.php?post='.$post->ID.'&action=edit'). '">'. __('Edit', 'TR'). '</a></p>';			
		break;		
	}
}


#
#Remove meta boxes
#
function theme_sidebar_meta_boxes() {
	remove_meta_box( 'commentstatusdiv', 'sidebar' , 'normal' );
	remove_meta_box( 'slugdiv', 'sidebar' , 'normal' );
	remove_meta_box( 'commentsdiv', 'sidebar' , 'normal' );
}

?>