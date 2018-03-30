<?php
/*
* @KingSize 2015
** Add Gallery Post Type **
*/
function kingsize_create_post_type_gallery() 
{
	$labels = array(
		'name' => __( 'Galleries', 'kslang'),
		'singular_name' => __( 'Gallery', 'kslang' ),
		'add_new' => __('Add New', 'gallery', 'kslang'),
		'add_new_item' => __('Add New Gallery', 'kslang'),
		'edit_item' => __('Edit Gallery', 'kslang'),
		'new_item' => __('New Gallery', 'kslang'),
		'view_item' => __('View Gallery', 'kslang'),
		'search_items' => __('Search Galleries', 'kslang'),
		'not_found' =>  __('No galleries found', 'kslang'),
		'not_found_in_trash' => __('No galleries found in Trash', 'kslang'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'rewrite' => array('slug' => 'galleries'),
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
	    'supports' => array('title','editor','thumbnail','excerpt') //,'custom-fields'
	  ); 
	  
	  register_post_type('galleries',$args);
}
add_action( 'init', 'kingsize_create_post_type_gallery' );



/*add_filter('manage_posts_columns', 'kingsize_gallery_columns');
function kingsize_gallery_columns($defaults) {
    $defaults['postid'] = __('POST ID', 'kslang');
    return $defaults;
}

add_action('manage_posts_custom_column', 'kingsize_gallery_custom_column', 10, 2);

function kingsize_gallery_custom_column($column_name, $post_id) {
    global $wpdb;
	if( $column_name == 'postid' ) {
		echo $post_id;
	}
}*/
?>