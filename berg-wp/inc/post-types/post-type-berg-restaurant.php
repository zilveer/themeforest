<?php

function restaurant_taxonomy() {
	register_taxonomy(
		'berg_restaurant_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'berg_restaurant',   		 //post type name
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

add_action('init', 'restaurant_taxonomy');
add_action('init', 'restaurant_post_type');

function restaurant_post_type() {
	$redux = get_option('redux');
	if(isset($redux['theme_permalink_berg_restaurant'])) {
		$slug = $redux['theme_permalink_berg_restaurant'];
	} else {
		$slug = 'slider';
	}

	register_post_type( 'berg_restaurant',
		array(
			'labels' => array(
				'name' => __( 'Vertical Slider', 'BERG'),
				'singular_name' => __( 'Vertical Slider', 'BERG'),
				'all_items' => __('Vertical Slider Items', 'BERG'),
				'add_new' => __('Add Vertical Slider Item', 'BERG'),
				'add_new_item' => __('Add Vertical Slider Item', 'BERG'),
				'edit_item' => __('Edit Vertical Slider Item', 'BERG')
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array('title','editor', 'thumbnail', 'post-formats'),
			'taxonomies' => array('berg_restaurant_categories'),
			'rewrite' => array(
				'slug' => $slug,
			)
		)
	);
}

function custom_default_post_format($format) {
	global $post_type;

	if ($post_type == 'berg_restaurant') {
		add_theme_support('post-formats', array('video'));
	}
}

add_filter('manage_berg_restaurant_columns', 'custom_default_post_format');