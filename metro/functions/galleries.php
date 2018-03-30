<?php

/*************************************************************************************
 *	Add Gallery Post Type
 *************************************************************************************/
 
function om_create_galleries() 
{
	$labels = array(
		'name' => __( 'Galleries','om_theme'),
		'all_items' => __( 'All Galleries','om_theme' ),
		'singular_name' => __( 'Gallery','om_theme' ),
		'add_new' => __('Add New','om_theme'),
		'add_new_item' => __('Add New Gallery','om_theme'),
		'edit_item' => __('Edit Gallery','om_theme'),
		'new_item' => __('New Gallery','om_theme'),
		'view_item' => __('View Gallery','om_theme'),
		'search_items' => __('Search Gallery','om_theme'),
		'not_found' =>  __('No Galleries found','om_theme'),
		'not_found_in_trash' => __('No Gallery found in Trash','om_theme'), 
		'parent_item_colon' => ''
	);
	  
	register_post_type( 'galleries', array(
		'labels' => $labels,
		'public' => false,
		'show_ui' => true,
		'menu_icon' => TEMPLATE_DIR_URI.'/admin/images/galleries.png',
		'capability_type' => 'page',
		'query_var' => false,
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title')
	));
	
	flush_rewrite_rules(false);
}
add_action( 'init', 'om_create_galleries' );

/*************************************************************************************
 *	Add Columns
 *************************************************************************************/

function om_galleries_add_columns($columns) {
	
	$columns_=array();
	$found=false;
	foreach($columns as $k=>$v) {
		$columns_[$k]=$v;
		if($k == 'title') {
			$columns_['gallery_id'] = __('ID','om_theme');
			$found=true;
		}
	}
	if(!$found)
		$columns_['gallery_id'] = __('ID','om_theme');
	
	return $columns_;
}
add_filter('manage_galleries_posts_columns', 'om_galleries_add_columns');

function om_galleries_show_columns($name, $post_id) {
	
	switch ($name) {
		case 'gallery_id':
			echo $post_id;
	}
}
add_action('manage_posts_custom_column', 'om_galleries_show_columns', 10, 2);
