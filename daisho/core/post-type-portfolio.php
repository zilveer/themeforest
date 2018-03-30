<?php
function flow_create_portfolio_post_type() {
	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name' => _x( 'Portfolio', 'Portfolio post type general name', 'flowthemes' ),
				'singular_name' => _x( 'Portfolio Item', 'Portfolio post type singular name', 'flowthemes' ),
				'add_new' => _x( 'Add New', 'Portfolio post type', 'flowthemes' ),
				'add_new_item' => __( 'Add New Portfolio Item', 'flowthemes' ),
				'edit_item' => __( 'Edit Portfolio Item', 'flowthemes' ),
				'new_item' => __( 'New Portfolio Item', 'flowthemes' ),
				'view_item' => __( 'View Portfolio Item', 'flowthemes' ),
				'search_items' => __( 'Search Portfolio Items', 'flowthemes' ),
				'not_found' =>  __( 'No portfolio items found', 'flowthemes' ),
				'not_found_in_trash' => __( 'No portfolio items found in Trash', 'flowthemes' ), 
				'parent_item_colon' => '',
				'menu_name' => _x( 'Portfolio', 'Portfolio menu name', 'flowthemes' ),
			),
			'public' => true,
			'exclude_from_search' => true,
			'has_archive' => false,
			'supports' => array( 'title', 'editor', 'author', 'trackbacks', 'custom-fields', 'comments', 'revisions' ),
			'rewrite' => array( 'slug' => 'portfolio' )
		)
	);
	register_taxonomy( 'portfolio_category', 'portfolio',
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => _x( 'Portfolio Categories', 'Portfolio taxonomy general name', 'flowthemes' ),
				'singular_name' => _x( 'Portfolio Category', 'Portfolio taxonomy singular name', 'flowthemes' ),
				'search_items' =>  __( 'Search Categories', 'flowthemes' ),
				'popular_items' => __( 'Popular Categories', 'flowthemes' ),
				'all_items' => __( 'All Categories', 'flowthemes' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Portfolio Category', 'flowthemes' ), 
				'update_item' => __( 'Update Portfolio Category', 'flowthemes' ),
				'add_new_item' => __( 'Add New Portfolio Category', 'flowthemes' ),
				'new_item_name' => __( 'New Portfolio Category Name', 'flowthemes' ),
				'separate_items_with_commas' => __( 'Separate Portfolio category with commas', 'flowthemes' ),
				'add_or_remove_items' => __( 'Add or remove portfolio category', 'flowthemes' ),
				'choose_from_most_used' => __( 'Choose from the most used portfolio category', 'flowthemes' ),
				'not_found' => __( 'No categories found.', 'flowthemes' ),
				'menu_name' => __( 'Portfolio Categories', 'flowthemes' ),
			),
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
		)
	);
}
add_action( 'init', 'flow_create_portfolio_post_type' );
