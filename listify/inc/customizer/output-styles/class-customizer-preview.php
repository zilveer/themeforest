<?php
/**
 * Customizer Preview
 *
 * @uses Listify_Customizer_CSS
 *
 * @since 1.7.0
 * @package Customizer
 */
class Listify_Customizer_Preview {

	
	/**
	 * Start things up
	 *
	 * @since 1.7.0
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_ajax_listify-customizer-css', array( $this, 'customizer_preview_css_ajax' ) );
		add_action( 'wp_ajax_listify-customizer-webfont', array( $this, 'customizer_preview_webfont_ajax' ) );

		add_action( 'listify_output_customizer_preview_css', array( $this, 'preview_thememods' ) );
	}

	/**
	 * Return updated generated CSS based on the customizer settings.
	 *
	 * @see preview_thememods()
	 *
	 * @since 1.7.0
	 * @return mixed
	 */
	public function customizer_preview_css_ajax() {
		do_action( 'listify_output_customizer_preview_css' );
		do_action( 'listify_output_customizer_css' );

		if ( ! Listify_Customizer_CSS::has_rules() ) {
			return wp_send_json_error();
		}

		return wp_send_json_success( Listify_Customizer_CSS::build() );
	}

	/**
	 * Return an array os font data to be pased to WebFont
	 *
	 * @since 1.7.0
	 */
	public function customizer_preview_webfont_ajax() {
		do_action( 'listify_output_customizer_preview_css' );

		$controls = (array) $_POST[ 'listify-type-controls' ];
		$controls = array_map( 'esc_attr', $controls );

		$json = array();
		$fonts = array_values( $controls );

		// gather google
		$subset = get_theme_mod( 'typography-font-subset', 'latin' );
		$google = Listify_Customizer::$fonts->get_google_font_json( $fonts, $subset );

		if ( ! empty( $google ) ) {
			$json = array_merge( $json, $google );
		}

		if ( empty( $json ) ) {
			wp_send_json_error();
		}

		wp_send_json_success( $json );
	}

	/**
	 * Wrapper function for substituting preview values in theme mod settings.
	 *
	 * @since 1.7.0.
	 * @return void
	 */
	public function preview_thememods() {
		if ( ! isset( $_POST[ 'listify-style-controls' ] ) ) {
			return;
		}

		$preview = (array) $_POST[ 'listify-style-controls' ];

		foreach ( $preview as $setting_id => $value ) {
			add_filter( 'theme_mod_' . sanitize_key( $setting_id ), array( $this, 'preview_thememod_value' ) );
		}
	}

	/**
	 * Return a preview value for a particular theme mod setting.
	 *
	 * @since 1.7.0.
	 * @param $value
	 * @return mixed
	 */
	public function preview_thememod_value( $value ) {
		if ( ! isset( $_POST[ 'listify-style-controls' ] ) ) {
			return $value;
		}

		$preview = (array) $_POST[ 'listify-style-controls' ];
		$setting_id = str_replace( 'theme_mod_', '', current_filter() );

		if ( isset( $preview[ $setting_id ] ) ) {
			return $preview[ $setting_id ];
		}

		return $value;
	}
}

new Listify_Customizer_Preview();
