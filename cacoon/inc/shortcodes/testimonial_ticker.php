<?php

function met_su_TESTIMONIALS_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_testimonials'] = array(
		'name' => __( 'Testimonials', 'su' ),
		'type' => 'wrap',
		'group' => 'met',
		'desc' => '',
		'atts' => array(),
		'content' => '',
		'icon' => 'star',
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_TESTIMONIALS_shortcode_data' );

function met_su_TESTIMONIAL_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_testimonial'] = array(
		'name' => __( 'Testimonial Item', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'desc' => '',
		'atts' => array(
			'title' => array(
				'default' => 'Some Customer Title',
				'name' => __( 'Title', 'su' ),
			),
			'customer_name' => array(
				'default' => 'John Doe',
				'name' => __( 'Customer Name', 'su' ),
			),
			'avatar' => array(
				'type' => 'upload',
				'default' => 'http://placehold.it/60/60',
				'name' => __( 'Customer Photo', 'su' ),
			),
			'customer_comment' => array(
				'default' => 'Whoola! Im so happy!',
				'name' => __( 'Customer Comment', 'su' ),
			),
		),
		'icon' => 'star',
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_TESTIMONIAL_shortcode_data' );