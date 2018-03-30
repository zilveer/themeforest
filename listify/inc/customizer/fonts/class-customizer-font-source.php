<?php
/**
 * Manage a source
 *
 * @since 1.5.0
 * @package Listify
 * @category Customizer
 */
class 
	Listify_Customizer_Font_Source 
extends
	Listify_Customizer_Source {

	/**
	 * @var array
	 * @access public
	 */
	public $stacks;

	/**
	 * @var array
	 * @access public
	 */
	public $subsets;

	/**
	 * Assign properties
	 *
	 * @since 1.5.0
	 * @param string $id
	 * @param string $label
	 * @param array $data
	 */
	public function __construct( $id, $label, $data = array() ) {
		parent::__construct( $id, $label, $data );
	}

	/**
	 * Load the fonts and set the data property
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function load_data() {
		if ( isset( $this->data ) && ! empty( $this->data ) ) {
			return $this->data;
		}

		return $this->data = include_once( get_template_directory() . '/inc/customizer/definitions/fonts/' . $this->get_id() . '.php' );
	}

	/**
	 * Get the font stack for a particular font. If no stack is available, use a default stack instead.
	 *
	 * @since 1.5.0
	 *
	 * @param string $font
	 * @param string $default_stack
	 * @return string
	 */
	public function get_font_stack( $font, $default_stack = 'sans-serif' ) {
		$data = $this->get_font_data( $font );
		$stack = '';

		if ( isset( $data[ 'stack' ] ) ) {
			$stack = $data[ 'stack' ];
		} else if ( is_string( $default_stack ) ) {
			$stack = $default_stack;
		}

		return $stack;
	}

}
