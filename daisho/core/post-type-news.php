<?php
function create_news_post_type() {
	register_post_type( 'news',
		array(
			'labels' => array(
				'name' => _x( 'News', 'News post type general name', 'flowthemes' ),
				'singular_name' => _x( 'News Item', 'News post type singular name', 'flowthemes' ),
				'add_new' => _x( 'Add New', 'News post type', 'flowthemes' ),
				'add_new_item' => __( 'Add New News Item', 'flowthemes' ),
				'edit_item' => __( 'Edit News Item', 'flowthemes' ),
				'new_item' => __( 'New News Item', 'flowthemes' ),
				'view_item' => __( 'View News Item', 'flowthemes' ),
				'search_items' => __( 'Search News Items', 'flowthemes' ),
				'not_found' =>  __( 'No news items found', 'flowthemes' ),
				'not_found_in_trash' => __( 'No news items found in Trash', 'flowthemes' ), 
				'parent_item_colon' => '',
				'menu_name' => _x( 'News', 'News menu name', 'flowthemes' ),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array('title', 'editor', 'author', 'custom-fields', 'revisions', 'page-attributes', 'post-formats', 'comments', 'trackbacks', 'excerpt' ),
			'rewrite' => array('slug' => 'news')
		)
	);
	register_taxonomy( 'news_category', 'news', array(
	'hierarchical' => true,
	'labels' => array(
		'name' => _x( 'News Categories', 'News taxonomy general name', 'flowthemes' ),
		'singular_name' => _x( 'News Category', 'News taxonomy singular name', 'flowthemes' ),
		'search_items' =>  __( 'Search Categories', 'flowthemes' ),
		'popular_items' => __( 'Popular Categories', 'flowthemes' ),
		'all_items' => __( 'All Categories', 'flowthemes' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit News Category', 'flowthemes' ), 
		'update_item' => __( 'Update News Category', 'flowthemes' ),
		'add_new_item' => __( 'Add New News Category', 'flowthemes' ),
		'new_item_name' => __( 'New News Category Name', 'flowthemes' ),
		'separate_items_with_commas' => __( 'Separate News category with commas', 'flowthemes' ),
		'add_or_remove_items' => __( 'Add or remove news category', 'flowthemes' ),
		'choose_from_most_used' => __( 'Choose from the most used news category', 'flowthemes' )
	),
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => false,
	) );
}
add_action( 'init', 'create_news_post_type' );
