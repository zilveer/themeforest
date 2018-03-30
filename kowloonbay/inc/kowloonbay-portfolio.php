<?php

/* KowloonBay Portfolio: create post type */
add_action('init', 'kowloonbay_portfolio_register_post_type');
function kowloonbay_portfolio_register_post_type()
{
	// Register portfolio item
	$portfolio = array(
		'show_ui' => true,
		'show_in_menu' => true,
		'public' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-screenoptions',
		'query_var' => 'portfolio',
		'rewrite' => array('slug' => 'portfolio'),
		'has_archive' => false,
		'supports' => array(
			'title',
			'editor',
			'revisions',
			'page-attributes'
		),
		'labels' => array(
			'name' => 'Portfolio',
			'singular_name' => 'Portfolio Item',
			'add_new' => 'Add New Portfolio Item',
			'add_new_item' => 'Add New Portfolio Item',
			'edit_item' => 'Edit Portfolio Item',
			'new_item' => 'New Portfolio Item',
			'view_item' => 'View Portfolio Item',
			'search_items' => 'Search Portfolio Items',
			'not_found' => 'No Portfolio Items Found',
			'not_found_in_trash' => 'No Portfolio Items Found In Trash'
		),
	);

	register_post_type( 'kowloonbay_portfolio', $portfolio );
}


/* KowloonBay portfolio category: register taxonomy */
add_action('init', 'kowloonbay_portfolio_category_register_taxonomy');
function kowloonbay_portfolio_category_register_taxonomy()
{
	/**
	 * Create a taxonomy
	 *
	 * @uses  Inserts new taxonomy object into the list
	 * @uses  Adds query vars
	 *
	 * @param string  Name of taxonomy object
	 * @param array|string  Name of the object type for the taxonomy object.
	 * @param array|string  Taxonomy arguments
	 * @return null|WP_Error WP_Error if errors, otherwise null.
	 */
	$portfolio_cat_labels = array(
		'name'					=> esc_html(_x( 'Portfolio Categories', 'Taxonomy Portfolio Categories', 'KowloonBay' )),
		'singular_name'			=> esc_html(_x( 'Portfolio Category', 'Taxonomy Portfolio Category', 'KowloonBay' )),
		'search_items'			=> esc_html__( 'Search Portfolio Categories', 'KowloonBay' ),
		'popular_items'			=> esc_html__( 'Popular Portfolio Categories', 'KowloonBay' ),
		'all_items'				=> esc_html__( 'All Portfolio Categories', 'KowloonBay' ),
		'parent_item'			=> esc_html__( 'Parent Portfolio Category', 'KowloonBay' ),
		'parent_item_colon'		=> esc_html__( 'Parent Portfolio Category', 'KowloonBay' ),
		'edit_item'				=> esc_html__( 'Edit Portfolio Category', 'KowloonBay' ),
		'update_item'			=> esc_html__( 'Update Portfolio Category', 'KowloonBay' ),
		'add_new_item'			=> esc_html__( 'Add New Portfolio Category', 'KowloonBay' ),
		'new_item_name'			=> esc_html__( 'New Portfolio Category Name', 'KowloonBay' ),
		'add_or_remove_items'	=> esc_html__( 'Add or remove Portfolio Categories', 'KowloonBay' ),
		'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'KowloonBay' ),
		'menu_name'				=> esc_html__( 'Portfolio Category', 'KowloonBay' ),
	);

	$portfolio_cat = array(
		'labels'            => $portfolio_cat_labels,
		'public'            => false,
		'show_in_nav_menus' => false,
		'show_admin_column' => false,
		'hierarchical'      => true,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'kowloonbay_portfolio_cat', 'kowloonbay_portfolio', $portfolio_cat );
}