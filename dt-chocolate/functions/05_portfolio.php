<?php

add_action( 'init', 'create_portfolio_type' );
function create_portfolio_type() {
	register_post_type( 'dt_portfolio',
		array(
			'labels' => array(
				'name' => __( 'Portfolio' , LANGUAGE_ZONE),
				'singular_name' => __( 'Work' , LANGUAGE_ZONE),
				'edit_item' => __('Edit Work', LANGUAGE_ZONE),
				'add_new_item' => __('Add New Work', LANGUAGE_ZONE),
				'new_item_name' => __('New Work Name', LANGUAGE_ZONE),
			),
			'public' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'taxonomies' => array('dt_portfolio'),
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array('slug' => 'portfolio'),
			'has_archive' => true,
			'menu_icon' => get_template_directory_uri() . '/images/portfolio.png',
			'supports' => array(
			  'title', 
			  'thumbnail', 
			  'editor',
			  'comments',
			  'trackbacks',
			  'revisions',
			  'custom-fields',
			  'excerpt'
			)
		)
	);

	register_taxonomy('dt_portfolio_cat', array (
		 0 => 'dt_portfolio',
	  ),
	  array(
		 'hierarchical' => true, 
			'labels' => array(
				'name' => __( 'Categories' , LANGUAGE_ZONE),
				'singular_name' => __( 'Category' , LANGUAGE_ZONE),
				'popular_items' => __( 'Popular Categories' , LANGUAGE_ZONE),
				'edit_item' => __('Edit Category', LANGUAGE_ZONE),
				'add_new_item' => __('Add New Category', LANGUAGE_ZONE),
				'new_item_name' => __('New Category Name', LANGUAGE_ZONE),
			),
		 'show_ui' => true,
		 'query_var' => true,
		 'rewrite' => array('slug' => 'category'),
		 'singular_label' => 'Categories',
	  )
   );
}
