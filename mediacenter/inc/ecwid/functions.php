<?php

if ( ! function_exists( 'mc_ecwid_scripts' ) ) {
	function mc_ecwid_scripts() {
		global $mc_version;

		wp_enqueue_style( 'media_center-ecwid-style', get_template_directory_uri() . '/assets/css/ecwid.css', '', $mc_version );
	}
}