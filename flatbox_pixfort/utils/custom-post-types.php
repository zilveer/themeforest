<?php

function flatbox_create_post_types() {

	global $smof_data;

	// Portfolio
	$portfolio_slug = 'portfolio-items';
	if ( !empty($smof_data['portfolio_post_type_slug']) ) {
		$portfolio_slug = $smof_data['portfolio_post_type_slug'];
	}
	$portfolio_post_type_name = 'Portfolio';
	if ( !empty($smof_data['portfolio_post_type_name']) ) {
		$portfolio_post_type_name = $smof_data['portfolio_post_type_name'];
	}
	$portfolio_labels = array(
		'name' => $portfolio_post_type_name
	);
	register_post_type( 'portfolio-items',
		array(
			'labels' => $portfolio_labels,
			'public' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'category', 'revisions', 'page-attributes', 'comments' ),
			'menu_position' => 5,
			'menu_icon' => get_template_directory_uri() . '/utils/admin/assets/images/icon-gallery2.png',
			'query_var' => true,
			'taxonomies' => array( 'project-category', 'post_tag' ),
			'rewrite' => array( 'slug' => $portfolio_slug ),
		)
	);


	// Staff Members
	$staff_members_slug = 'staff-members';
	if ( !empty($smof_data['staff_members_post_type_slug']) ) {
		$staff_members_slug = $smof_data['staff_members_post_type_slug'];
	}
	$staff_members_post_type_name = 'Staff Members';
	if ( !empty($smof_data['staff_members_post_type_name']) ) {
		$staff_members_post_type_name = $smof_data['staff_members_post_type_name'];
	}
	$staff_members_labels = array(
		'name' => $staff_members_post_type_name
	);
	register_post_type( 'staff-members',
		array(
			'labels' => $staff_members_labels,
			'public' => true,
			'supports' => array( 'title','editor','excerpt','thumbnail', 'revisions', 'page-attributes' ),
			'menu_position' => 5,
			'menu_icon' => get_template_directory_uri() . '/utils/admin/assets/images/icon-staff.png',
			'query_var' => true,
			'rewrite' => array( 'slug' => $staff_members_slug ),
		)
	);

	// Testimonials
	$testimonials_slug = 'testimonials';
	if ( !empty($smof_data['testimonials_post_type_slug']) ) {
		$testimonials_slug = $smof_data['testimonials_post_type_slug'];
	}
	$testimonials_post_type_name = 'Testimonials';
	if ( !empty($smof_data['testimonials_post_type_name']) ) {
		$testimonials_post_type_name = $smof_data['testimonials_post_type_name'];
	}
	$testimonials_labels = array(
		'name' => $testimonials_post_type_name
	);


	register_post_type( 'testimonials',
		array(
			'labels' => $testimonials_labels,
			'public' => true,
			'supports' => array( 'title','editor','excerpt','thumbnail', 'revisions', 'page-attributes' ),
			'menu_position' => 5,
			'menu_icon' => get_template_directory_uri() . '/utils/admin/assets/images/icon-testimonials.png',
			'query_var' => true,
			'rewrite' => array( 'slug' => $testimonials_slug ),
		)
	);

}
add_action( 'init', 'flatbox_create_post_types' );