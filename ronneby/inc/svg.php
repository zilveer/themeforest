<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class dfd_svg_support {

	public function __construct() {
		$this->_add_filters();
	}

	private function _add_filters() {
		add_filter( 'upload_mimes', array( &$this, 'allow_svg_uploads' ) );
	}

	public function allow_svg_uploads( $existing_mime_types = array() ) {
		return $this->_add_svg_mime_type( $existing_mime_types );
	}

	private function _add_svg_mime_type( $mime_types ) {
		$mime_types[ 'svg' ] = 'image/svg+xml';

		return $mime_types;
	}

}


add_action('after_setup_theme', 'dfd_svg_support_run');

if (!function_exists('dfd_eight_setup_theme')) {
	function dfd_svg_support_run() {
		if (class_exists('dfd_svg_support')) {
			new dfd_svg_support();
		}
	}
}

