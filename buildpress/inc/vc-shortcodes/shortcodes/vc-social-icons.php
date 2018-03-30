<?php

/**
 * Social Icons content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Social_Icons' ) ) {
	class PT_VC_Social_Icons extends PT_VC_Shortcode {

		private $num_social_icons = 8;

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_social_icons'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'new_tab'    => '',
				'btn_link_0' => '',
				'icon_0'     => 'fa fa-facebook',
				'btn_link_1' => '',
				'icon_1'     => 'fa fa-twitter',
				'btn_link_2' => '',
				'icon_2'     => 'fa fa-youtube',
				'btn_link_3' => '',
				'icon_3'     => '',
				'btn_link_4' => '',
				'icon_4'     => '',
				'btn_link_5' => '',
				'icon_5'     => '',
				'btn_link_6' => '',
				'icon_6'     => '',
				'btn_link_7' => '',
				'icon_7'     => '',
				), $atts );

			$instance = array(
				'new_tab' => $atts['new_tab'],
			);

			for ( $i=0; $i < $this->num_social_icons; $i++ ) {
				$instance[ 'btn_link_' . $i ] = $atts[ 'btn_link_' . $i ];

				// Extract the icon class without the first 'fa' part
				if ( ! empty( $atts[ 'icon_' . $i ] ) ) {
					$icon = explode( ' ', $atts[ 'icon_' . $i ] );
					$instance[ 'icon_' . $i ] = $icon[1];
				}
			}

			ob_start();
				the_widget( 'PT_Social_Icons', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'                    => __( 'Social Icons', 'buildpress_wp' ),
				'base'                    => $this->shortcode_name(),
				'category'                => __( 'Content', 'buildpress_wp' ),
				'icon'                    => get_stylesheet_directory_uri() . '/assets/images/pt.svg',
				'params'                  => array(
					array(
						'type'       => 'checkbox',
						'heading'    => __( 'Open link in new tab', 'buildpress_wp' ),
						'param_name' => 'new_tab',
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Link 1', 'backend', 'buildpress_wp' ),
						'param_name' => 'btn_link_0',
						'value'      => 'https://www.facebook.com/ProteusThemes',
					),
					array(
						'type'        => 'iconpicker',
						'param_name'  => 'icon_0',
						'value'       => 'fa fa-facebook',
						'description' => _x( 'Select icon from library.', 'backend', 'buildpress_wp' ),
						'settings'    => array(
							'emptyIcon'    => false,
							'iconsPerPage' => 50,
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Link 2', 'backend', 'buildpress_wp' ),
						'param_name' => 'btn_link_1',
						'value'      => '',
					),
					array(
						'type'        => 'iconpicker',
						'param_name'  => 'icon_1',
						'value'       => 'fa fa-twitter',
						'description' => _x( 'Select icon from library.', 'backend', 'buildpress_wp' ),
						'settings'    => array(
							'emptyIcon'    => false,
							'iconsPerPage' => 50,
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Link 3', 'backend', 'buildpress_wp' ),
						'param_name' => 'btn_link_2',
						'value'      => '',
					),
					array(
						'type'        => 'iconpicker',
						'param_name'  => 'icon_2',
						'value'       => 'fa fa-youtube',
						'description' => _x( 'Select icon from library.', 'backend', 'buildpress_wp' ),
						'settings'    => array(
							'emptyIcon'    => false,
							'iconsPerPage' => 50,
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Link 4', 'backend', 'buildpress_wp' ),
						'param_name' => 'btn_link_3',
					),
					array(
						'type'        => 'iconpicker',
						'param_name'  => 'icon_3',
						'value'       => 'fa fa-facebook',
						'description' => _x( 'Select icon from library.', 'backend', 'buildpress_wp' ),
						'settings'    => array(
							'emptyIcon'    => false,
							'iconsPerPage' => 50,
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Link 5', 'backend', 'buildpress_wp' ),
						'param_name' => 'btn_link_4',
					),
					array(
						'type'        => 'iconpicker',
						'param_name'  => 'icon_4',
						'value'       => 'fa fa-facebook',
						'description' => _x( 'Select icon from library.', 'backend', 'buildpress_wp' ),
						'settings'    => array(
							'emptyIcon'    => false,
							'iconsPerPage' => 50,
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Link 6', 'backend', 'buildpress_wp' ),
						'param_name' => 'btn_link_5',
					),
					array(
						'type'        => 'iconpicker',
						'param_name'  => 'icon_5',
						'value'       => 'fa fa-facebook',
						'description' => _x( 'Select icon from library.', 'backend', 'buildpress_wp' ),
						'settings'    => array(
							'emptyIcon'    => false,
							'iconsPerPage' => 50,
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Link 7', 'backend', 'buildpress_wp' ),
						'param_name' => 'btn_link_6',
					),
					array(
						'type'        => 'iconpicker',
						'param_name'  => 'icon_6',
						'value'       => 'fa fa-facebook',
						'description' => _x( 'Select icon from library.', 'backend', 'buildpress_wp' ),
						'settings'    => array(
							'emptyIcon'    => false,
							'iconsPerPage' => 50,
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Link 8', 'backend', 'buildpress_wp' ),
						'param_name' => 'btn_link_7',
					),
					array(
						'type'        => 'iconpicker',
						'param_name'  => 'icon_7',
						'value'       => 'fa fa-facebook',
						'description' => _x( 'Select icon from library.', 'backend', 'buildpress_wp' ),
						'settings'    => array(
							'emptyIcon'    => false,
							'iconsPerPage' => 50,
						),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Social_Icons;
}