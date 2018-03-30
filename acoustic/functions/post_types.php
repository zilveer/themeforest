<?php
//
// Include all custom post types here (one custom post type per file)
//
add_action('after_setup_theme', 'ci_load_custom_post_type_files');
if( !function_exists('ci_load_custom_post_type_files') ):
function ci_load_custom_post_type_files()
{
	$cpt_files = apply_filters('load_custom_post_type_files', array(
		'functions/post_types/slider',
		'functions/post_types/events',
		'functions/post_types/discography',
		'functions/post_types/videos',
		'functions/post_types/galleries',
		'functions/post_types/artists'
	));
	foreach($cpt_files as $cpt_file) get_template_part($cpt_file);
}
endif;


add_action( 'init', 'ci_tax_create_taxonomies');
if( !function_exists('ci_tax_create_taxonomies') ):
function ci_tax_create_taxonomies() {
	//
	// Create all taxonomies here.
	//

	// Discography > Sections Taxonomy
	$labels = array(
		'name'              => _x( 'Discography Sections', 'taxonomy general name', 'ci_theme' ),
		'singular_name'     => _x( 'Discography Section', 'taxonomy singular name', 'ci_theme' ),
		'search_items'      => __( 'Search Discography Sections', 'ci_theme' ),
		'all_items'         => __( 'All Discography Sections', 'ci_theme' ),
		'parent_item'       => __( 'Parent Discography Section', 'ci_theme' ),
		'parent_item_colon' => __( 'Parent Discography Section:', 'ci_theme' ),
		'edit_item'         => __( 'Edit Discography Section', 'ci_theme' ),
		'update_item'       => __( 'Update Discography Section', 'ci_theme' ),
		'add_new_item'      => __( 'Add New Discography Section', 'ci_theme' ),
		'new_item_name'     => __( 'New Discography Section Name', 'ci_theme' ),
		'menu_name'         => __( 'Discography Sections', 'ci_theme' ),
		'view_item'         => __( 'View Discography Section', 'ci_theme' ),
		'popular_items'     => __( 'Popular Discography Sections', 'ci_theme' ),
	);

	register_taxonomy( 'section', array( 'cpt_discography' ), array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => _x( 'album-category', 'taxonomy slug', 'ci_theme' ) ),
	) );

	// Artists > Category
	$labels = array(
		'name'              => _x( 'Artist Categories', 'taxonomy general name', 'ci_theme' ),
		'singular_name'     => _x( 'Artist Category', 'taxonomy singular name', 'ci_theme' ),
		'search_items'      => __( 'Search Artist Categories', 'ci_theme' ),
		'all_items'         => __( 'All Artist Categories', 'ci_theme' ),
		'parent_item'       => __( 'Parent Artist Category', 'ci_theme' ),
		'parent_item_colon' => __( 'Parent Artist Category:', 'ci_theme' ),
		'edit_item'         => __( 'Edit Artist Category', 'ci_theme' ),
		'update_item'       => __( 'Update Artist Category', 'ci_theme' ),
		'add_new_item'      => __( 'Add New Artist Category', 'ci_theme' ),
		'new_item_name'     => __( 'New Artist Category Name', 'ci_theme' ),
		'menu_name'         => __( 'Categories', 'ci_theme' ),
		'view_item'         => __( 'View Artist Category', 'ci_theme' ),
		'popular_items'     => __( 'Popular Artist Categories', 'ci_theme' ),
	);

	register_taxonomy( 'artist-category', array( 'cpt_artists' ), array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => _x( 'artist-category', 'taxonomy slug', 'ci_theme' ) ),
	) );

}
endif;

add_action('admin_enqueue_scripts', 'ci_load_post_scripts');
if( !function_exists('ci_load_post_scripts') ):
function ci_load_post_scripts($hook)
{
	//
	// Add here all scripts and styles, to load on all admin pages.
	//

	if('post.php' == $hook or 'post-new.php' == $hook)
	{
		//
		// Add here all scripts and styles, specific to post edit screens.
		//
		wp_enqueue_media();
		ci_enqueue_media_manager_scripts();

		wp_enqueue_style('ci-post-edit-screens');

		wp_enqueue_style('jquery-ui-style');
		wp_enqueue_style('jquery-ui-timepicker');

		ci_localize_datepicker();
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('jquery-ui-timepicker');

		wp_enqueue_script('jquery-gmaps-latlon-picker');
		wp_enqueue_script('ci-post-edit-scripts');

	}
}
endif;

add_filter('request', 'ci_feed_request');
if( !function_exists('ci_feed_request') ):
function ci_feed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type'])){

		$qv['post_type'] = array();
		$qv['post_type'] = get_post_types($args = array(
			'public'   => true,
			'_builtin' => false
		));
		$qv['post_type'][] = 'post';
	}
	return $qv;
}
endif;
?>