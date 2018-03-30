<?php
/**
 *
 */
class Listify_WP_Job_Manager_Customizer {

	public function __construct() {
		// frontend
		add_action( 'after_setup_theme', array( __CLASS__, 'output_styles' ) );

		// backend
		add_action( 'customize_register', array( __CLASS__, 'setup_panels' ), 10 );
		add_action( 'customize_register', array( __CLASS__, 'setup_sections' ), 20 );
		add_action( 'customize_register', array( __CLASS__, 'setup_controls' ), 30 );
	}

	/**
	 * Output custom CSS based on control values.
	 * 
	 * @since 1.5.0
	 * @return void
	 */
	public static function output_styles() {
		foreach ( glob( dirname( __FILE__ ) . '/output-styles/*.php' ) as $file ) {
			include_once( $file );
		}
	}

	/**
	 * Register and modify panels.
	 *
	 * @since 1.5.0
	 * @param object $wp_customize WP_Customize_Manager
	 * @return void
	 */
	public static function setup_panels( $wp_customize ) {
		foreach ( glob( dirname( __FILE__ ) . '/definitions/panels/*.php' ) as $file ) {
			include_once( $file );
		}
	}

	/**
	 * Register and modify sections.
	 *
	 * @since 1.5.0
	 * @param object $wp_customize WP_Customize_Manager
	 * @return void
	 */
	public static function setup_sections( $wp_customize ) {
		foreach ( glob( dirname( __FILE__ ) . '/definitions/sections/*.php' ) as $file ) {
			include_once( $file );
		}
	}

	/**
	 * Register and modify controls.
	 *
	 * @since 1.5.0
	 * @param object $wp_customize WP_Customize_Manager
	 * @return void
	 */
	public static function setup_controls( $wp_customize ) {
		foreach ( glob( dirname( __FILE__ ) . '/definitions/controls/*.php' ) as $file ) {
			include_once( $file );
		}
	}

}

new Listify_WP_Job_Manager_Customizer();
