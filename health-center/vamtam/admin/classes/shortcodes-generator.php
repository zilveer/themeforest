<?php
/**
 * Vamtam Basic Shortcode Generator
 *
 * @package wpv
 */

/**
 * class WpvShortcodesGenerator
 */
class WpvShortcodesGenerator extends WpvConfigGenerator {

	/**
	 * Initialize the generator
	 *
	 * @param array $config    generator options
	 * @param array $shortcode shortcode option definitions
	 */
	public function __construct( $config, $shortcode ){
		$this->config    = $config;
		$this->shortcode = $shortcode;
	}

	/**
	 * Render the generator
	 */
	public function render() {
		global $post;

		require_once WPV_ADMIN_HELPERS . 'shortcodes/render.php';
	}

}