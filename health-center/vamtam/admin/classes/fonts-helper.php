<?php

/**
 * Fonts Helper
 *
 * @package wpv
 */
/**
 * class WpvFontsHelper
 */
class WpvFontsHelper extends WpvAjax {
	/**
	 * Hook ajax actions
	 */
	public function __construct() {
		$this->actions = array(
			'font-preview' => 'font_preview',
		);

		parent::__construct();
	}

	/**
	 * gets the stylesheet for the font preview
	 */
	public function font_preview() {
		$url = wpv_get_font_url( $_POST['face'], $_POST['weight'] );

		if ( ! empty( $url ) ) {
			echo $url; // xss ok
		}

		exit;
	}
}
