<?php

/*-----------------------------------------------------------------------------------*/
/* Manage Employee's columns */
/*-----------------------------------------------------------------------------------*/

function edit_testimonial_columns( $testimonial_columns ) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		'title' => __( 'Testimonial Name', 'mk_framework' ),
		"quote_author" => __( 'Author', 'mk_framework' ),
		"desc" => __( 'Description', 'mk_framework' ),
		"thumbnail" => __( 'Thumbnail', 'mk_framework' ),
	);

	return $columns;
}
add_filter( 'manage_edit-testimonial_columns', 'edit_testimonial_columns' );

function manage_testimonials_columns( $column ) {
	global $post;

	if ( $post->post_type == "testimonial" ) {
		switch ( $column ) {
		case "quote_author":
			echo get_post_meta( $post->ID, '_author', true );
			break;
		case "desc":
			echo get_post_meta( $post->ID, '_desc', true );
			break;

		case 'thumbnail':
			echo the_post_thumbnail( 'thumbnail' );
			break;
		}
	}
}
add_action( 'manage_posts_custom_column', 'manage_testimonials_columns', 10, 2 );



/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Gallerys */
/*-----------------------------------------------------------------------------------*/
function register_testimonials_post_type() {
	register_post_type( 'testimonial', array(
			'labels' => array(
				'name' => __( 'Testimonials', 'mk_framework' ),
				'singular_name' => __( 'Testimonial', 'mk_framework' ),
				'add_new' => __( 'Add New Testimonial', 'mk_framework' ),
				'add_new_item' => __( 'Add New Testimonial', 'mk_framework'),
				'edit_item' => __( 'Edit Testimonial', 'mk_framework' ),
				'new_item' => __( 'New Testimonial', 'mk_framework' ),
				'view_item' => __( 'View Testimonials', 'mk_framework' ),
				'search_items' => __( 'Search Testimonials', 'mk_framework' ),
				'not_found' =>  __( 'No Testimonials found', 'mk_framework' ),
				'not_found_in_trash' => __( 'No Testimonials found in Trash', 'mk_framework' ),
				'parent_item_colon' => '',

			),
			'singular_label' => 'Testimonials',
			'public' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'menu_icon'=> 'dashicons-awards',
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => false,
			'menu_position' => 100,
			'query_var' => false,
			'show_in_nav_menus' => false,
			'supports' => array('title', 'thumbnail', 'page-attributes', 'revisions')
		) );
}
add_action( 'init', 'register_testimonials_post_type' );

function testimonials_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'testimonial' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'testimonials_context_fixer' );
