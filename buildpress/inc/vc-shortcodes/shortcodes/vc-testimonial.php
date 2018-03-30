<?php

/**
 * Testimonial content element for the Visual Composer editor,
 * that can only be used in the Testimonials container
 */

if ( ! class_exists( 'PT_VC_Testimonial' ) ) {
	class PT_VC_Testimonial extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_testimonial'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'quote'  => '',
				'author' => '',
				'rating' => '5',
				), $atts );

			// Remove all HTML tags from the testimonial text
			$atts['quote'] = wp_strip_all_tags( $atts['quote'] );

			// The PHP_EOL is added so that it can be used as a separator between multiple counters
			return PHP_EOL . json_encode( $atts );
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => __( 'Testimonial', 'buildpress_wp' ),
				'base'     => $this->shortcode_name(),
				'category' => __( 'Content', 'buildpress_wp' ),
				'icon'     => get_stylesheet_directory_uri() . '/assets/images/pt.svg',
				'as_child' => array( 'only' => 'pt_vc_container_testimonials' ),
				'params'   => array(
					array(
						'type'        => 'textarea',
						'heading'     => __( 'Quote', 'buildpress_wp' ),
						'param_name'  => 'quote',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Author', 'buildpress_wp' ),
						'param_name'  => 'author',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => __( 'Rating', 'buildpress_wp' ),
						'param_name'  => 'rating',
						'value'       => array(
							'5' => '5',
							'4' => '4',
							'3' => '3',
							'2' => '2',
							'1' => '1',
							'0' => '0',
						),
						'std'         => '5',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Testimonial;
}