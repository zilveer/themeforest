<?php
sd_register_post_type('portfolio', array(
	'labels' => array(
		'name' => _x('Portfolio', 'post type general name'),
		'singular_name' => _x('Portfolio', 'post type singular name'),
		'add_new' => _x('Add New', 'project'),
		'add_new_item' => __('Add New Item'),
		'edit_item' => __('Edit Item'),
		'new_item' => __('New Item'),
		'view_item' => __('View Item'),
		'search_items' => __('Search Items'),
		'not_found' =>  __('No items found'),
		'not_found_in_trash' => __('No items found in Trash'),
		'parent_item_colon' => ''
	),
	'public' => true,
	'show_ui' => true,
	'hierarchical' => false,
	'capability_type' => 'post',
	'exclude_from_search' => false,
	'show_in_nav_menus' => false,
	'supports' => array(
		'title',
		'editor',
		'excerpt',
		'thumbnail',
		'page-attributes',
		'comments',
	),
	'taxonomies' => array('projects', 'clients', 'divisions'),
), 'portfolio', 'portfolio_post_limits');

function register_portfolio_taxonomies() {
	$labels = array(
		'name' => _x( 'Projects', 'taxonomy general name' ),
		'singular_name' => _x( 'Project', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Projects' ),
		'all_items' => __( 'All Projects' ),
		'parent_item' => __( 'Parent Project' ),
		'parent_item_colon' => __( 'Parent Project:' ),
		'edit_item' => __( 'Edit Project' ),
		'update_item' => __( 'Update Project' ),
		'add_new_item' => __( 'Add New Project' ),
		'new_item_name' => __( 'New Project Name' ),
	);
	register_taxonomy(
		'projects',
		'portfolio',
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'query_var' => true,
			'rewrite' => true,
		)
	);

	$labels = array(
		'name' => _x( 'Clients', 'taxonomy general name' ),
		'singular_name' => _x( 'Client', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Clients' ),
		'all_items' => __( 'All Clients' ),
		'parent_item' => __( 'Parent Client' ),
		'parent_item_colon' => __( 'Parent Client:' ),
		'edit_item' => __( 'Edit Client' ),
		'update_item' => __( 'Update Client' ),
		'add_new_item' => __( 'Add New Client' ),
		'new_item_name' => __( 'New Client Name' ),
	);
	register_taxonomy(
		'clients',
		'portfolio',
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'query_var' => true,
			'rewrite' => true,
			'show_in_nav_menus' => false,
		)
	);

	$labels = array(
		'name' => _x( 'Divisions', 'taxonomy general name' ),
		'singular_name' => _x( 'Division', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Divisions' ),
		'all_items' => __( 'All Divisions' ),
		'parent_item' => __( 'Parent Division' ),
		'parent_item_colon' => __( 'Parent Division:' ),
		'edit_item' => __( 'Edit Division' ),
		'update_item' => __( 'Update Division' ),
		'add_new_item' => __( 'Add New Division' ),
		'new_item_name' => __( 'New Division Name' ),
	);
	register_taxonomy(
		'divisions',
		'portfolio',
		array(
			'hierarchical' => false,
			'labels' => $labels,
			'query_var' => true,
			'rewrite' => true,
			'show_in_nav_menus' => false,
		)
	);

	$labels = array(
		'name' => _x( 'Galleries', 'taxonomy general name' ),
		'singular_name' => _x( 'Gallery', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Galleries' ),
		'all_items' => __( 'All Galleries' ),
		'parent_item' => __( 'Parent Gallery' ),
		'parent_item_colon' => __( 'Parent Gallery:' ),
		'edit_item' => __( 'Edit Gallery' ),
		'update_item' => __( 'Update Gallery' ),
		'add_new_item' => __( 'Add New Gallery' ),
		'new_item_name' => __( 'New Gallery Name' ),
	);
	register_taxonomy(
		'gallery',
		array('portfolio', 'post', 'page'),
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'query_var' => true,
			'rewrite' => true,
			'show_in_nav_menus' => true,
		)
	);
}
add_action('init', 'register_portfolio_taxonomies');

function portfolio_post_limits( $limit )
{
	if (is_portfolio()) {
		$old_limit = $limit;
		$limit = get_option('portfolio_rows');
		$portfolio_layout = get_option('portfolio_layout');
		switch($portfolio_layout) {
			case 'portfolio3':
				$limit = $limit * 2;
				break;
			case 'portfolio4':
				$limit = $limit * 3;
				break;
		}
	} elseif (is_tax('gallery')) {
		$limit = get_option('gallery_limit');
	}
	if ( !$limit )
		$limit = $old_limit;
	elseif ( $limit == '-1' )
		$limit = '18446744073709551615';
	return $limit;
}

function set_portfolio_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __('Items', TEMPLATENAME),
		'projects' => __('Projects', TEMPLATENAME),
		'clients' => __('Clients', TEMPLATENAME),
		'divisions' => __('Divisions', TEMPLATENAME),
		'thumbnail' => __('Thumbnail', TEMPLATENAME),
	);
	return $columns;
}
add_filter('manage_edit-portfolio_columns', 'set_portfolio_columns');

function display_portfolio_columns($column_name, $post_id) {
	global $post;
	if ($post->post_type == 'portfolio') {
		if (in_array($column_name, array('clients', 'projects', 'divisions')))
			echo get_portfolio_taxs($column_name);
		elseif ($column_name == 'thumbnail') {
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('thumbnail');
			} else {
				echo __('None');
			}
		}
	}
}
add_action('manage_posts_custom_column',  'display_portfolio_columns', 10, 2);

function get_portfolio_taxs($cat_name) {
	global $post;
	$categories = get_the_terms(null, $cat_name);
	if ( !empty( $categories ) ) {
		$out = array();
		foreach ( $categories as $c )
			$out[] = "<a href='edit.php?post_type={$post->post_type}&amp;{$cat_name}={$c->slug}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, $cat_name, 'display')) . "</a>";
			return join( ', ', $out );
	} else {
		return ($cat_name == 'projects') ? __('Uncategorized') : __('No Tags');
	}
}

function is_portfolio() {
	$post_type = get_query_var('post_type');
	$projects = get_query_var('projects');
	$clients = get_query_var('clients');
	$divisions = get_query_var('divisions');
	return ($post_type == 'portfolio' || !empty($projects) || !empty($clients) || !empty($divisions)) ? true : false;
}

add_image_size('portfolio_single',   510, 250, true);
add_image_size('portfolio2',   510, 250, true);
add_image_size('portfolio4',   280, 180, true);
add_image_size('portfolio3',   440, 230, true);

require_once (TEMPLATEPATH . '/functions/metaboxes/portfolio.php');

?>