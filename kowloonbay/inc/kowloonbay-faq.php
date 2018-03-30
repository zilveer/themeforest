<?php

/* KowloonBay FAQ: create post type */
add_action('init', 'kowloonbay_faq_register_post_type');
function kowloonbay_faq_register_post_type()
{
	// Register faq item
	$faq = array(
		'show_ui' => true,
		'show_in_menu' => true,
		'publicly_queryable' => false,
		'show_in_nav_menus' => false,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-editor-help',
		'query_var' => 'faq',
		'rewrite' => array('slug' => 'faq'),
		'has_archive' => false,
		'supports' => array(
			'title',
			'editor',
			'revisions',
			'page-attributes'
		),
		'labels' => array(
			'name' => 'FAQ',
			'singular_name' => 'FAQ Item',
			'add_new' => 'Add New FAQ Item',
			'add_new_item' => 'Add New FAQ Item',
			'edit_item' => 'Edit FAQ Item',
			'new_item' => 'New FAQ Item',
			'view_item' => 'View FAQ Item',
			'search_items' => 'Search FAQ Items',
			'not_found' => 'No FAQ Items Found',
			'not_found_in_trash' => 'No FAQ Items Found In Trash'
		),
	);

	register_post_type( 'kowloonbay_faq', $faq );
}

/* KowloonBay FAQ category: register taxonomy */
add_action('init', 'kowloonbay_faq_category_register_taxonomy');
function kowloonbay_faq_category_register_taxonomy()
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
	$faq_cat_labels = array(
		'name'					=> esc_html(_x( 'FAQ Categories', 'Taxonomy FAQ Categories', 'KowloonBay' )),
		'singular_name'			=> esc_html(_x( 'FAQ Category', 'Taxonomy FAQ Category', 'KowloonBay' )),
		'search_items'			=> esc_html__( 'Search FAQ Categories', 'KowloonBay' ),
		'popular_items'			=> esc_html__( 'Popular FAQ Categories', 'KowloonBay' ),
		'all_items'				=> esc_html__( 'All FAQ Categories', 'KowloonBay' ),
		'parent_item'			=> esc_html__( 'Parent FAQ Category', 'KowloonBay' ),
		'parent_item_colon'		=> esc_html__( 'Parent FAQ Category', 'KowloonBay' ),
		'edit_item'				=> esc_html__( 'Edit FAQ Category', 'KowloonBay' ),
		'update_item'			=> esc_html__( 'Update FAQ Category', 'KowloonBay' ),
		'add_new_item'			=> esc_html__( 'Add New FAQ Category', 'KowloonBay' ),
		'new_item_name'			=> esc_html__( 'New FAQ Category Name', 'KowloonBay' ),
		'add_or_remove_items'	=> esc_html__( 'Add or remove FAQ Categories', 'KowloonBay' ),
		'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'KowloonBay' ),
		'menu_name'				=> esc_html__( 'FAQ Category', 'KowloonBay' ),
	);

	$faq_cat = array(
		'labels'            => $faq_cat_labels,
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_admin_column' => false,
		'hierarchical'      => true,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'kowloonbay_faq_cat', 'kowloonbay_faq', $faq_cat );
}