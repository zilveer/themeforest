<?php

/**
 * Custom Taxonomies
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

$iron_taxonomies = array();

function iron_register_taxonomies ()
{
	global $iron_taxonomies;

	$iron_taxonomies = array( 'video-category' );

	$args = array(
		  'public'            => true
		, 'show_ui'           => true
		, 'show_in_nav_menus' => true
		, 'show_in_admin_bar' => false
		, 'show_admin_column' => true
		, 'show_tagcloud'     => false
		, 'query_var'         => false
		, 'rewrite'           => true
		, 'hierarchical'      => true
		, 'sort'              => false
	);


/* Video Categories (video-categories)
   ========================================================================== */

	$labels = array(
		  'name'          => _x('Video Categories',     'Taxonomy : name',          IRON_TEXT_DOMAIN)
		, 'all_items'     => _x('All Categories',       'Taxonomy : all_items',     IRON_TEXT_DOMAIN)
		, 'singular_name' => _x('Category',             'Taxonomy : singular_name', IRON_TEXT_DOMAIN)
		, 'add_new_item'  => _x('Add New Category',     'Taxonomy : add_new_item',  IRON_TEXT_DOMAIN)
		, 'not_found'     => _x('No categories found.', 'Taxonomy : not_found',     IRON_TEXT_DOMAIN)
	);

	$args['labels'] = $labels;


	register_taxonomy('video-category', 'video', $args);



/* Portfolio Categories (portfolio-categories)
   ========================================================================== */

	$labels = array(
		  'name'          => _x('Portfolio Categories', 'Taxonomy : name',          IRON_TEXT_DOMAIN)
		, 'all_items'     => _x('All Categories',       'Taxonomy : all_items',     IRON_TEXT_DOMAIN)
		, 'singular_name' => _x('Category',             'Taxonomy : singular_name', IRON_TEXT_DOMAIN)
		, 'add_new_item'  => _x('Add New Category',     'Taxonomy : add_new_item',  IRON_TEXT_DOMAIN)
		, 'not_found'     => _x('No categories found.', 'Taxonomy : not_found',     IRON_TEXT_DOMAIN)
	);

	$args['labels'] = $labels;


	register_taxonomy('portfolio-category', 'portfolio', $args);
	
	
/* Discography Categories (discography-categories)
   ========================================================================== */

	$labels = array(
		  'name'          => _x('Discography Categories', 'Taxonomy : name',          IRON_TEXT_DOMAIN)
		, 'all_items'     => _x('All Categories',       'Taxonomy : all_items',     IRON_TEXT_DOMAIN)
		, 'singular_name' => _x('Category',             'Taxonomy : singular_name', IRON_TEXT_DOMAIN)
		, 'add_new_item'  => _x('Add New Category',     'Taxonomy : add_new_item',  IRON_TEXT_DOMAIN)
		, 'not_found'     => _x('No categories found.', 'Taxonomy : not_found',     IRON_TEXT_DOMAIN)
	);

	$args['labels'] = $labels;


	register_taxonomy('album-category', 'album', $args);
	
	
	
/* Photo Albums Categories (photo-album-categories)
   ========================================================================== */

	$labels = array(
		  'name'          => _x('Photo Albums Categories', 'Taxonomy : name',          IRON_TEXT_DOMAIN)
		, 'all_items'     => _x('All Categories',       'Taxonomy : all_items',     IRON_TEXT_DOMAIN)
		, 'singular_name' => _x('Category',             'Taxonomy : singular_name', IRON_TEXT_DOMAIN)
		, 'add_new_item'  => _x('Add New Category',     'Taxonomy : add_new_item',  IRON_TEXT_DOMAIN)
		, 'not_found'     => _x('No categories found.', 'Taxonomy : not_found',     IRON_TEXT_DOMAIN)
	);

	$args['labels'] = $labels;


	register_taxonomy('photo-album-category', 'photo-album', $args);
		
}

add_action('init', 'iron_register_taxonomies');

function iron_post_class_terms ( $classes = array() )
{
	global $post, $iron_taxonomies;


/*

	// Tags
	if ( is_object_in_taxonomy( $post->post_type, 'post_tag' ) ) {
		foreach ( (array) get_the_tags($post->ID) as $tag ) {
			if ( empty($tag->slug ) )
				continue;
			$classes[] = 'tag-' . sanitize_html_class($tag->slug, $tag->term_id);
		}
	}

*/
	global $post;

	foreach ( $iron_taxonomies as $tax )
	{
		if ( is_object_in_taxonomy( $post->post_type, $tax ) )
		{
			$terms = get_the_terms($post->ID, $tax);

			foreach ( (array) $terms as $term ) {
				if ( empty($term->slug ) )
					continue;
				$classes[] = sanitize_html_class($tax, 'tax') . '-' . sanitize_html_class($term->slug, $term->term_id);
			}

			# Alternate
			// $terms = wp_list_pluck($terms, 'slug');
			// $classes = array_merge($classes, $terms);
		}
	}

	return $classes;
}

add_filter('post_class', 'iron_post_class_terms');