<?php

function portfolio_taxonomy() {
	register_taxonomy(
		'berg_portfolio_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'berg_portfolio',   		 //post type name
		array(
			'hierarchical' 		=> true,
			'label' 			=> 'Categories',  //Display name
			'query_var' 		=> true,
			'rewrite'			=> array(
				'slug' 			=> 'themes', // This controls the base slug that will display before each term
				'with_front' 	=> false // Don't display the category base before
				)
			)
		);
}

add_action( 'init', 'portfolio_taxonomy');
add_action( 'init', 'create_post_type' );

function create_post_type() {
	$redux = get_option('redux');
	if(isset($redux['theme_permalink_berg_portfolio'])) {
		$slug = $redux['theme_permalink_berg_portfolio'];
	} else {
		$slug = 'portfolios';
	}
	
	register_post_type( 'berg_portfolio',
		array(
			'labels' => array(
				'name' => __( 'Portfolio', 'BERG'),
				'singular_name' => __( 'Portfolio', 'BERG'),
				'all_items' => __('Portfolio Items', 'BERG'),
				'add_new' => __('Add Portfolio Item', 'BERG'),
				'add_new_item' => __('Add Portfolio Item', 'BERG'),
				'edit_item' => __('Edit Portfolio Item', 'BERG')
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array('title','editor', 'thumbnail', 'excerpt' ),
			'taxonomies' => array('berg_portfolio_categories'),
			'rewrite' => array(
				'slug' => $slug
			)
		)
	);
}