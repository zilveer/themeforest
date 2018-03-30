<?php

/**
 * Featured Page content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Featured_Page' ) ) {
	class PT_VC_Featured_Page extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_featured_page'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'page'   => '',
				'layout' => 'block',
				), $atts );

			$instance = array(
				'page_id' => absint( $atts['page'] ),
				'layout'  => $atts['layout'],
			);

			ob_start();
			the_widget( 'PT_Featured_Page', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {

			// Get all pages to use in the dropdown below:
			$args = array(
				'sort_order'  => 'ASC',
				'sort_column' => 'post_title',
				'post_type'   => 'page',
				'post_status' => 'publish',
			);
			$pages = get_pages( $args );

			$list_of_pages = array();

			// Parse through the objects returned and add the key value pairs to the list_of_pages array
			foreach ( $pages as $page ) {
				$list_of_pages[ $page->post_title ] = $page->ID;
			}

			vc_map( array(
				'name'     => __( 'Featured Page', 'buildpress_wp' ),
				'base'     => $this->shortcode_name(),
				'category' => __( 'Content', 'buildpress_wp' ),
				'icon'     => get_stylesheet_directory_uri() . '/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'       => 'dropdown',
						'heading'    => __( 'Page', 'buildpress_wp' ),
						'param_name' => 'page',
						'value'      => $list_of_pages,
					),
					array(
						'type'       => 'dropdown',
						'heading'    => __( 'Layout', 'buildpress_wp' ),
						'param_name' => 'layout',
						'value'      => array(
							__( 'With big picture', 'buildpress_wp' ) => 'block',
							__( 'With small picture, inline', 'buildpress_wp' ) => 'inline',
						),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Featured_Page;
}