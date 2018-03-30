<?php

/**
 * Facebook content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Facebook' ) ) {
	class PT_VC_Facebook extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_facebook'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'       => 'Facebook',
				'fb_page_url' => 'https://www.facebook.com/ProteusThemes',
				'height'      => 290,
				'background'  => '#ffffff',
				'colorscheme' => 'light',
				), $atts );

			$instance = array(
				'title'       => $atts['title'],
				'like_link'   => $atts['fb_page_url'],
				'height'      => $atts['height'],
				'colorscheme' => $atts['colorscheme'],
				'background'  => $atts['background'],
			);

			ob_start();
			the_widget( 'PT_Footer_Facebook', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => __( 'Facebook Box', 'buildpress_wp' ),
				'base'     => $this->shortcode_name(),
				'category' => __( 'Social', 'buildpress_wp' ),
				'icon'     => get_stylesheet_directory_uri() . '/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Title', 'buildpress_wp' ),
						'param_name'  => 'title',
						'value'       => 'Facebook',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'FB Page to like', 'buildpress_wp' ),
						'description' => __( 'Input the whole FB page url. Example: https://www.facebook.com/ProteusThemes', 'buildpress_wp' ),
						'param_name'  => 'fb_page_url',
						'value'       => 'https://www.facebook.com/ProteusThemes',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Height', 'buildpress_wp' ),
						'description' => __( 'Input height in pixels. Min: 70', 'buildpress_wp' ),
						'param_name'  => 'height',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => __( 'Color scheme', 'buildpress_wp' ),
						'param_name'  => 'colorscheme',
						'value'       => array(
							__( 'Light', 'buildpress_wp' ) => 'light',
							__( 'Dark', 'buildpress_wp' )  => 'dark',
						),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => __( 'Background color', 'buildpress_wp' ),
						'param_name' => 'background',
						'value'      => '#ffffff'
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Facebook;
}