<?php
add_action( 'init', 'create_post_types' );
function create_post_types() {
	global $smof_data;

	// Portfolio categories
	register_taxonomy( 'us_portfolio_category', array( 'us_portfolio' ), array(
		'hierarchical' => TRUE,
		'label' => 'Portfolio Categories',
		'singular_label' => 'Portfolio Category',
		'rewrite' => TRUE
	) );

	register_post_type( 'us_main_page_section', array(
		'labels' => array(
			'name' => 'Page Sections',
			'singular_name' => 'Page Section',
			'add_new' => 'Add Page Section',
		),
		'public' => TRUE,
		'show_ui' => TRUE,
		'query_var' => TRUE,
		'has_archive' => TRUE,
		'rewrite' => TRUE,
		'supports' => array( 'title', 'editor', 'revisions', 'page-attributes' ),
		'show_in_nav_menus' => TRUE,
		'can_export' => TRUE,
		'hierarchical' => TRUE,
		'exclude_from_search' => TRUE,
		'capability_type' => 'us_main_page_section',
		'capabilities' => array(
			'read_post' => 'read_us_main_page_section',
			'publish_posts' => 'publish_us_main_page_sections',
			'edit_posts' => 'edit_us_main_page_sections',
			'edit_others_posts' => 'edit_others_us_main_page_sections',
			'delete_posts' => 'delete_us_main_page_sections',
			'delete_others_posts' => 'delete_others_us_main_page_sections',
			'read_private_posts' => 'read_private_us_main_page_sections',
			'edit_post' => 'edit_us_main_page_section',
			'delete_post' => 'delete_us_main_page_section',
		),
		'map_meta_cap' => TRUE,
	) );

	// Portfolio post type
	register_post_type( 'us_portfolio', array(
		'labels' => array(
			'name' => 'Portfolio',
			'singular_name' => 'Portfolio Item',
			'add_new' => 'Add Portfolio Item',
		),
		'public' => TRUE,
		'has_archive' => TRUE,
		'rewrite' => TRUE,
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'can_export' => TRUE,
		'hierarchical' => FALSE,
		'exclude_from_search' => TRUE,
		'capability_type' => 'us_portfolio',
		'capabilities' => array(
			'read_post' => 'read_us_portfolio',
			'publish_posts' => 'publish_us_portfolios',
			'edit_posts' => 'edit_us_portfolios',
			'edit_others_posts' => 'edit_others_us_portfolios',
			'delete_posts' => 'delete_us_portfolios',
			'delete_others_posts' => 'delete_others_us_portfolios',
			'read_private_posts' => 'read_private_us_portfolios',
			'edit_post' => 'edit_us_portfolio',
			'delete_post' => 'delete_us_portfolio',
		),
		'map_meta_cap' => TRUE,
	) );

	// Clients post type
	register_post_type( 'us_client', array(
		'labels' => array(
			'name' => 'Clients Logos',
			'singular_name' => 'Client Logo',
			'add_new' => 'Add Client Logo',
		),
		'public' => TRUE,
		'publicly_queryable' => FALSE,
		'has_archive' => TRUE,
		'supports' => array( 'title', 'thumbnail' ),
		'can_export' => TRUE,
		'capability_type' => 'us_client',
		'capabilities' => array(
			'read_post' => 'read_us_client',
			'publish_posts' => 'publish_us_clients',
			'edit_posts' => 'edit_us_clients',
			'edit_others_posts' => 'edit_others_us_clients',
			'delete_posts' => 'delete_us_clients',
			'delete_others_posts' => 'delete_others_us_clients',
			'read_private_posts' => 'read_private_us_clients',
			'edit_post' => 'edit_us_client',
			'delete_post' => 'delete_us_client',
		),
		'map_meta_cap' => TRUE,
	) );
}

add_action( 'admin_init', 'us_add_theme_caps' );
function us_add_theme_caps() {
	global $wp_post_types;
	$role = get_role( 'administrator' );
	$force_refresh = FALSE;
	$custom_post_types = array( 'us_main_page_section', 'us_portfolio', 'us_client' );
	foreach ( $custom_post_types as $post_type ) {
		if ( ! isset( $wp_post_types[ $post_type ] ) ) {
			continue;
		}
		foreach ( $wp_post_types[ $post_type ]->cap as $cap ) {
			if ( ! $role->has_cap( $cap ) ) {
				$role->add_cap( $cap );
				$force_refresh = TRUE;
			}
		}
	}
	if ( $force_refresh AND current_user_can( 'manage_options' ) AND ! isset( $_COOKIE['us_cap_page_refreshed'] ) ) {
		// To prevent infinite refreshes when the DB is not writable
		setcookie( 'us_cap_page_refreshed' );
		header( 'Refresh: 0' );
	}
}
