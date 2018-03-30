<?php

/**
 * Testimonials container content element for the Visual Composer editor,
 * that allows nesting of the Testimonial VC content element
 */

if ( ! class_exists( 'PT_VC_Container_Testimonials' ) ) {
	class PT_VC_Container_Testimonials extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_container_testimonials'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'     => __( 'Testimonials', 'buildpress_wp' ),
				'autocycle' => 'no',
				'interval'  => '5000',
				), $atts );

			$testimonials = PT_VC_Helper_Functions::get_child_elements_data( $content );

			$instance = array(
				'title'        => $atts['title'],
				'autocycle'    => $atts['autocycle'],
				'interval'     => absint( $atts['interval'] ),
				'testimonials' => $testimonials,
			);

			// Unique widget id so that the navigation/slider for testimonials work properly.
			$args = array(
			 'widget_id' => uniqid( 'widget-id-' ),
			);

			ob_start();
				the_widget( 'PT_Testimonials', $instance, $args );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'            => __( 'Testimonials', 'buildpress_wp' ),
				'base'            => $this->shortcode_name(),
				'category'        => __( 'Content', 'buildpress_wp' ),
				'icon'            => get_stylesheet_directory_uri() . '/assets/images/pt.svg',
				'as_parent'       => array( 'only' => 'pt_vc_testimonial' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Title', 'buildpress_wp' ),
						'param_name'  => 'title',
						'value'       => __( 'Testimonials', 'buildpress_wp' ),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => __( 'Automatically cycle the carousel?', 'buildpress_wp' ),
						'param_name'  => 'autocycle',
						'value'       => array(
							__( 'No', 'buildpress_wp' )  => 'no',
							__( 'Yes', 'buildpress_wp' ) => 'yes',
						),
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Interval', 'buildpress_wp' ),
						'description' => __( 'Input time (number) in milliseconds.', 'buildpress_wp' ),
						'param_name'  => 'interval',
						'value'       => '5000',
						'dependency'  => array(
							'element' => 'autocycle',
							'value'   => array( 'yes' )
						),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Container_Testimonials;

	// The "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Pt_Vc_Container_Testimonials extends WPBakeryShortCodesContainer {}
	}
}