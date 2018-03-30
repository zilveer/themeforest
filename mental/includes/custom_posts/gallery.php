<?php
/**
 * Custom Post Type - Gallery
 *
 * @author: Vedmant <vedmant@gmail.com>
 * @version: 1.0.0
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/**
 * Create Gallery Custom Post
 */
add_action( 'init', 'create_post_type_gallery', 0 );
function create_post_type_gallery()
{
	register_taxonomy(
		'gallery_category', //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'gallery', //post type name
		array(
			'hierarchical' => true,
			'label'        => __( 'Categories', 'mental' ), //Display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'gallery_category', // This controls the base slug that will display before each term
				'with_front' => false // Don't display the category base before
			),
		)
	);
	register_taxonomy(
		'gallery_filter', //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'gallery', //post type name
		array(
			'hierarchical' => true,
			'labels'        =>array(
				'name'               => __('Filters', 'mental'), //Display name
				'singular_name'      => __('Filter', 'mental'),
				'add_new'            => __('Add New', 'mental'),
				'add_new_item'       => __('Add New Filter', 'mental'),
				'all_items'          => __('All Filters', 'mental'),
				'edit'               => __('Edit Filter', 'mental'),
				'edit_item'          => __('Edit Filter', 'mental'),
				'new_item'           => __('New Filter', 'mental'),
				'view'               => __('View Filter', 'mental'),
				'view_item'          => __('View Filter', 'mental'),
				'search_items'       => __('Search Filter', 'mental'),
				'not_found'          => __('No Filters found', 'mental'),
				'not_found_in_trash' => __('No Filters found in Trash', 'mental'),
				'parent_item'        => __('Parent Filter', 'mental')
			),
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'gallery_filter', // This controls the base slug that will display before each term
				'with_front' => false // Don't display the category base before
			),
		)
	);
	register_post_type( 'gallery', // Register Custom Post Type
		array(
			'labels'        => array(
				'name'               => __( 'Gallery', 'mental' ), // Rename these to suit
				'singular_name'      => __( 'Gallery Post', 'mental' ),
				'add_new'            => __( 'Add New', 'mental' ),
				'add_new_item'       => __( 'Add New Gallery Post', 'mental' ),
				'edit'               => __( 'Edit', 'mental' ),
				'edit_item'          => __( 'Edit Gallery Post', 'mental' ),
				'new_item'           => __( 'New Gallery Post', 'mental' ),
				'view'               => __( 'View Gallery Post', 'mental' ),
				'view_item'          => __( 'View Gallery Post', 'mental' ),
				'search_items'       => __( 'Search Gallery Post', 'mental' ),
				'not_found'          => __( 'No Gallery Posts found', 'mental' ),
				'not_found_in_trash' => __( 'No Gallery Posts found in Trash', 'mental' )
			),
			'public'        => true,
			'hierarchical'  => false, // Allows your posts to behave like Hierarchy Pages
			'has_archive'   => false,
			'supports'      => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'comments'
			), // Go to Dashboard Custom HTML5 Blank post for supports
			'can_export'    => true, // Allows export in Tools > Export
			'taxonomies'    => array(
				'gallery_category',
				'gallery_filter',
				'post_format'
			), // Add Category and Post Tags support
			'yarpp_support' => true,
			'show_in_nav_menus' => true,
		) );

}