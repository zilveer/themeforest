<?php

/**
 * Icon Box content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Icon_Box' ) ) {
	class PT_VC_Icon_Box extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_icon_box'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'   => '',
				'text'    => '',
				'link'    => '',
				'new_tab' => '',
				'icon'    => 'fa fa-home',
				), $atts );

			// Extract the icon class without the first 'fa' part
			$icon = explode( ' ', $atts['icon'] );

			$instance = array(
				'title'    => $atts['title'],
				'text'     => $atts['text'],
				'btn_link' => $atts['link'],
				'icon'     => $icon[1],
				'new_tab'  => $atts['new_tab'],
			);

			ob_start();
			the_widget( 'PT_Icon_Box', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => __( 'Icon Box', 'buildpress_wp' ),
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
						'type'       => 'textfield',
						'heading'    => __( 'Text', 'buildpress_wp' ),
						'param_name' => 'text',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Link', 'buildpress_wp' ),
						'description' => __( 'URL to any page, optional.', 'buildpress_wp' ),
						'param_name'  => 'link',
					),
					array(
						'type'       => 'checkbox',
						'heading'    => __( 'Open link in new tab', 'buildpress_wp' ),
						'param_name' => 'new_tab',
					),
					array(
						'type'        => 'iconpicker',
						'heading'     => __( 'Icon', 'buildpress_wp' ),
						'param_name'  => 'icon',
						'value'       => 'fa fa-home',
						'description' => __( 'Select icon from library.', 'buildpress_wp' ),
						'settings'    => array(
							'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							'iconsPerPage' => 100, // default 100, how many icons per/page to display
						),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Icon_Box;
}