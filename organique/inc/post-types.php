<?php
/**
 * Register custom post types
 *
 * @package Organique
 */


function organique_custom_post_types() {
	// slider
	$labels = array(
		'name'               => __( 'Slider', 'organique_wp'),
		'singular_name'      => _x( 'Slide', 'backend', 'organique_wp'),
		'add_new'            => _x( 'Add New', 'backend', 'organique_wp'),
		'add_new_item'       => _x( 'Add New Slide', 'backend', 'organique_wp'),
		'edit_item'          => _x( 'Edit Slide', 'backend', 'organique_wp'),
		'new_item'           => _x( 'New Slide', 'backend', 'organique_wp'),
		'all_items'          => _x( 'All Slides', 'backend', 'organique_wp'),
		'view_item'          => _x( 'View Slide', 'backend', 'organique_wp'),
		'search_items'       => _x( 'Search Slides', 'backend', 'organique_wp'),
		'not_found'          => _x( 'No slides found', 'backend', 'organique_wp'),
		'not_found_in_trash' => _x( 'No slides found in Trash', 'backend', 'organique_wp'),
		'menu_name'          => _x( 'Slider', 'backend', 'organique_wp'),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
	);
	register_post_type( 'slider', $args );

	// testimonials
	$labels = array(
		'name'               => __( 'Testimonials', 'organique_wp'),
		'singular_name'      => _x( 'Testimonial', 'backend', 'organique_wp'),
		'add_new'            => _x( 'Add New', 'backend', 'organique_wp'),
		'add_new_item'       => _x( 'Add New Testimonial', 'backend', 'organique_wp'),
		'edit_item'          => _x( 'Edit Testimonial', 'backend', 'organique_wp'),
		'new_item'           => _x( 'New Testimonial', 'backend', 'organique_wp'),
		'all_items'          => _x( 'All Testimonials', 'backend', 'organique_wp'),
		'view_item'          => _x( 'View Testimonial', 'backend', 'organique_wp'),
		'search_items'       => _x( 'Search Testimonials', 'backend', 'organique_wp'),
		'not_found'          => _x( 'No testimonial found', 'backend', 'organique_wp'),
		'not_found_in_trash' => _x( 'No testimonial found in Trash', 'backend', 'organique_wp'),
		'menu_name'          => _x( 'Testimonials', 'backend', 'organique_wp'),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title', 'editor', 'page-attributes' )
	);
	register_post_type( 'testimonials', $args );

	// meet the team
	$labels = array(
		'name'               => __( 'Team', 'organique_wp'),
		'singular_name'      => _x( 'Team Member', 'backend', 'organique_wp'),
		'add_new'            => _x( 'Add New', 'backend', 'organique_wp'),
		'add_new_item'       => _x( 'Add New Team Member', 'backend', 'organique_wp'),
		'edit_item'          => _x( 'Edit Team Member', 'backend', 'organique_wp'),
		'new_item'           => _x( 'New Team Member', 'backend', 'organique_wp'),
		'all_items'          => _x( 'All Team Members', 'backend', 'organique_wp'),
		'view_item'          => _x( 'View Team Member', 'backend', 'organique_wp'),
		'search_items'       => _x( 'Search Team Members', 'backend', 'organique_wp'),
		'not_found'          => _x( 'No team members found', 'backend', 'organique_wp'),
		'not_found_in_trash' => _x( 'No team members found in Trash', 'backend', 'organique_wp'),
		'menu_name'          => _x( 'Team', 'backend', 'organique_wp'),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'the-team' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title', 'thumbnail', 'page-attributes' )
	);
	register_post_type( 'team', $args );
}
add_action( 'init', 'organique_custom_post_types' );
