<?php
/**
 * Font/Typography management
 *
 * @since 1.5.0
 */
class 
	Listify_Customizer_Fonts 
extends 
	Listify_Customizer_SourceLoader {

	/**
	 * Listify_Customize_Fonts constructor
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function __construct() {
		$this->files = array(
			'fonts/class-customizer-font-source.php',
			'fonts/class-customizer-font-source-google.php'
		);

		parent::__construct();

		$this->add_source( 'google', new Listify_Customizer_Font_Source_Google() );
	}

	/**
	 * Get the CSS font stack for a particular font, if it exists. If not, fall back on a default stack.
	 *
	 * @since 1.5.0
	 * @param string $font
	 * @param string $default
	 * @param string $source_id
	 * @return mixed|string|void
	 */
	public function get_font_stack( $font, $source_id = null, $default = 'sans-serif' ) { 
		$stack = '';

		// Look for the stack in a particular source.
		if ( ! is_null( $source_id ) && $this->has_source( $source_id ) ) {
			$stack = $this->get_source( $source_id )->get_font_stack( $font, $default );
		}

		// Search all sources for the stack.
		else {
			$source = $this->get_item_source( $font );

			if ( ! is_null( $source ) ) {
				$stack = $source->get_font_stack( $font, $default );
				$source_id = $source->get_id();
			}
		}

		// Fall back to the default
		return $stack;
	}

	/**
	 * Get the array of all font subsets, or for a particular source.
	 *
	 * @since 1.5.0
	 * @param string $source_id
	 * @param bool $headings
	 * @return array
	 */
	public function get_font_subset_choices( $sources = array() ) {
		$choices = array();

		if ( empty( $sources ) ) {
			return $choices;
		}

		foreach ( $sources as $source_id ) {
			if ( $this->has_source( $source_id ) ) {
				$choices = $this->get_source( $source_id )->get_subsets();
			}
		}

		return $choices;
	}

	/**
	 * Get the line height.
	 *
	 * This is mainly there for backwards compatibility.
	 * 
	 * @since 1.5.0
	 * @param string $height
	 * @return mixed
	 */
	public function get_line_height( $height ) {
		if ( is_int( $height ) ) {
			return absint( $height );
		}

		return 'normal';
	}

	/**
	 * Helper function for checking/build a Google Font API URL
	 *
	 * @since 1.5.0
	 * @return mixed string|false
	 */
	public function get_google_font_url() {
		if ( ! $this->has_source( 'google' ) ) {
			return false;
		}

		$google = $this->get_source( 'google' );

		return $google->get_url();
	}

	/**
	 * Helper function for checking/build a Google Font JSON for WebFont
	 *
	 * @since 1.7.0
	 * @return mixed string|false
	 */
	public function get_google_font_json( $fonts, $subset ) {
		if ( ! $this->has_source( 'google' ) ) {
			return false;
		}

		$google = $this->get_source( 'google' );

		return $google->get_webfont_json( $fonts, $subset );
	}

}
