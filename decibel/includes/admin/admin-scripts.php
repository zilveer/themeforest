<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_enqueue_admin_scripts' ) ) {
	/**
	 * Enqueue admin scripts
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	function wolf_enqueue_admin_scripts() {
		wp_enqueue_media();
		wp_enqueue_style( 'wolf-admin', WOLF_THEME_URI. '/css/admin/admin.css', array(), WOLF_THEME_VERSION );
		wp_enqueue_style( 'wolf-icon-pack', WOLF_THEME_URI. '/css/icon-pack.min.css', array(), WOLF_THEME_VERSION );
		wp_enqueue_script( 'wolf-slider-admin', WOLF_THEME_URI . '/js/admin/min/jquery.wolfSlider.admin.min.js', 'jquery', WOLF_THEME_VERSION, true );
		wp_localize_script(
			'wolf-slider-admin', 'WolfSliderParams', array(
				'isSlideAdminPage' => wolf_is_slide_admin_page(),
				'isSlideListAdminPage' => wolf_is_slide_list_admin_page(),
			)
		);

		wp_enqueue_script( 'wolf-editor-buttons', WOLF_THEME_URI . '/js/admin/editor-buttons.js', 'jquery', WOLF_THEME_VERSION, true );
		wp_enqueue_script( 'wolf-theme-admin', WOLF_THEME_URI . '/js/admin/admin.js', 'jquery', WOLF_THEME_VERSION, true );
		wp_localize_script(
			'wolf-theme-admin', 'WolfThemeAdminParams', array(
				'addSlider' 	=> __( 'Add Slider', 'wolf' ),
				'insertSlider' 	=> __( 'Insert Slider', 'wolf' ),
				'createSlider' 	=> __( 'Create Slider', 'wolf' ),
				'gallery' 	=> __( 'Gallery', 'wolf' ),
				'insertGallery' 	=> __( 'Insert Gallery', 'wolf' ),
				'createGallery' => __( 'Create Gallery', 'wolf' ),
				'defaultPalette' => array(
					'#000000', // black
					'#FFFFFF', // white
					'#ecad81', // orange
					'#79bc90', // green
					'#63a69f', // turquoise
					'#7e8aa2', // blue
					'#c84564',
					'#49535a', // dark blue
					'#C74735', // red
					'#e6ae48',
					'#046380', // other dark blue
				),
			)
		);
	}
	add_action( 'admin_enqueue_scripts', 'wolf_enqueue_admin_scripts' );
}

if ( ! function_exists( 'wolf_is_slide_admin_page' ) ) {
	/**
	 * Check if we're on a slide edit page
	 *
	 * @access public
	 * @since 1.0.0
	 * @return bool
	 */
	function wolf_is_slide_admin_page() {

		if ( is_admin() && 'slide' == get_post_type() )
			return true;
		else
			return false;
	}
}

if ( ! function_exists( 'wolf_is_slide_list_admin_page' ) ) {
	/**
	 * Check if we're on a slide list admin page
	 *
	 * @access public
	 * @since 1.0.0
	 * @return bool
	 */
	function wolf_is_slide_list_admin_page() {

		return true;
	}
}
