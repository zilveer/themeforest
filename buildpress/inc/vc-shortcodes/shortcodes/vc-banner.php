<?php

/**
 * Call to Action content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Banner' ) ) {
	class PT_VC_Banner extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_banner'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title' => __( 'Looking for a quality and affordable constructor for your next project?', 'buildpress_wp' ),
				), $atts );

			$instance = array(
				'text'     => $atts['title'],
				'textarea' => $content,
			);

			ob_start();
			the_widget( 'PT_Banner', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => __( 'Banner', 'buildpress_wp' ),
				'base'     => $this->shortcode_name(),
				'category' => __( 'Content', 'buildpress_wp' ),
				'icon'     => get_stylesheet_directory_uri() . '/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'       => 'textfield',
						'holder'     => 'div',
						'heading'    => __( 'Title', 'buildpress_wp' ),
						'param_name' => 'title',
					),
					array(
						'type'        => 'textarea_html',
						'class'       => '',
						'heading'     => __( 'Button Area', 'buildpress_wp' ),
						'param_name'  => 'content',
						'description' => __( 'For adding buttons you must use button shortcode which look like this: [button]Text[/button]. Please take a look at the documentation for more details.', 'buildpress_wp' ),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Banner;
}