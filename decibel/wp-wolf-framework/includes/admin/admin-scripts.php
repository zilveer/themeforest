<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'wolf_framework_enqueue_admin_scripts' ) ) {
	/**
	 * Enqueue framework admin scripts (admin JS)
	 */
	function wolf_framework_enqueue_admin_scripts() {


		wp_register_script( 'wolf-options-panel', WOLF_FRAMEWORK_URI . '/assets/js/min/options-panel.min.js', 'jquery', true, WOLF_FRAMEWORK_VERSION );

		wp_enqueue_script( 'chosen', WOLF_FRAMEWORK_URI . '/assets/chosen/chosen.jquery.min.js',  'jquery', true, '1.1.0' );
		wp_enqueue_script( 'fancybox', WOLF_FRAMEWORK_URI . '/assets/fancybox/jquery.fancybox.pack.js',  'jquery', true, '2.1.4' );
		wp_enqueue_script( 'cookie', WOLF_FRAMEWORK_URI . '/assets/js/min/memo.min.js',  'jquery', true, WOLF_FRAMEWORK_VERSION );
		wp_enqueue_script( 'tipsy', WOLF_FRAMEWORK_URI . '/assets/js/min/tipsy.min.js', 'jquery', true, WOLF_FRAMEWORK_VERSION );

		wp_enqueue_script( 'wolf-admin-colorpicker', WOLF_FRAMEWORK_URI . '/assets/js/min/colorpicker.min.js', array( 'wp-color-picker' ), false, true );
		wp_enqueue_script( 'wolf-admin-app', WOLF_FRAMEWORK_URI . '/assets/js/app.js', 'jquery', true, WOLF_FRAMEWORK_VERSION );
		wp_localize_script(
			'wolf-admin-app', 'WolfAdminParams', array(
				'chooseImage' => __( 'Choose an image', 'wolf' ),
				'chooseFile' => __( 'Choose a file', 'wolf' ),
				'noResult' => __( 'Oops, nothing found!', 'wolf' ),
			)
		);

		if ( isset( $_GET['page'] ) && $_GET['page'] == 'wolf-theme-options' ) {
			wp_enqueue_script( 'wolf-options-panel' );
		}
	}
	add_action( 'admin_enqueue_scripts', 'wolf_framework_enqueue_admin_scripts' );

} // end function check

if ( ! function_exists( 'wolf_framework_enqueue_admin_styles' ) ) {
	/**
	 * Enqueue framework admin styles (admin CSS)
	 */
	function wolf_framework_enqueue_admin_styles() {

		wp_enqueue_style( 'chosen', WOLF_FRAMEWORK_URI . '/assets/chosen/chosen.min.css', false, '1.1.0', 'all' );
		wp_enqueue_style( 'fancybox', WOLF_FRAMEWORK_URI . '/assets/fancybox/fancybox.css', false, '2.1.4', 'all' );
		wp_enqueue_style( 'wolf-options-panel', WOLF_FRAMEWORK_URI . '/assets/css/options-panel.css', false, WOLF_FRAMEWORK_VERSION, 'all' );
		wp_enqueue_style( 'wp-color-picker' );
	}
	add_action( 'admin_enqueue_scripts', 'wolf_framework_enqueue_admin_styles' );

} // end function check

if ( ! function_exists( 'wolf_conditional_admin_style_head' ) ) {
	/**
	 * Output CSS style conditionally
	 */
	function wolf_conditional_admin_style_head() {

		if ( isset( $_GET['page'] ) ) {
			if ( 'wolf-theme-import' == $_GET['page'] && 'wolf-theme-options' == $_GET['page'] ) {
				?>
					<style type="text/css">
						.wolf-plugin-admin-notice,
						.woocommerce-message{
							display: none;
						}
					</style>
				<?php
			}
		}
	}
	add_action( 'admin_head', 'wolf_conditional_admin_style_head' );
}