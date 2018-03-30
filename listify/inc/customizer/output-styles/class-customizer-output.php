<?php
/**
 * Output customizer options as CSS.
 *
 * This is an abtract class and should not be created directly.
 *
 * @uses Listify_Customizer_CSS
 *
 * @since 1.5.0
 * @package Customizer
 */
abstract class Listify_Customizer_OutputCSS {

	/**
	 * @var $scheme
	 * @access public
	 */
	public static $scheme;

	/**
	 * @var $priority
	 * @access public
	 */
	public $priority;

	/**
	 * Start things up
	 *
	 * Define a few things and attach the output method to the output filter.
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function __construct() {
		self::$scheme = sanitize_title( get_theme_mod( 'color-scheme', 'default' ) );

		if ( ! isset( $this->priority ) ) {
			$this->priority = 10;
		}

		add_action( 'listify_output_customizer_css', array( $this, 'output' ), $this->priority );
	}

	/**
	 * Add items to the CSS object that will be built and output.
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function output() {}

}
