<?php

/**
 * Location content element for the Visual Composer editor,
 * that can only be used in the Google Maps container
 */

if ( ! class_exists( 'PT_VC_Location' ) ) {
	class PT_VC_Location extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_location'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'          => __( 'London', 'buildpress_wp' ),
				'locationlatlng' => '51.507331,-0.127668',
				'custompinimage' => '',
				), $atts );

			// The PHP_EOL is added so that it can be used as a separator between multiple locations
			return PHP_EOL . json_encode( $atts );
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => __( 'Location', 'buildpress_wp' ),
				'base'     => $this->shortcode_name(),
				'category' => __( 'Content', 'buildpress_wp' ),
				'icon'     => get_stylesheet_directory_uri() . '/assets/images/pt.svg',
				'as_child' => array( 'only' => 'pt_vc_container_google_map' ),
				'params'   => array(
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Title of location', 'buildpress_wp' ),
						'description' => __( 'This is shown on the pin mouse hover', 'buildpress_wp' ),
						'param_name'  => 'title',
						'value'       => __( 'London', 'buildpress_wp' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Latitude and longitude of this location', 'buildpress_wp' ),
						'description' => __( 'Example: 51.507331,-0.127668', 'buildpress_wp' ),
						'param_name'  => 'locationlatlng',
						'value'       => '51.507331,-0.127668',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Custom pin icon URL', 'buildpress_wp' ),
						'description' => __( 'Input the URL of the pin icon image', 'buildpress_wp' ),
						'param_name'  => 'custompinimage',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Location;
}