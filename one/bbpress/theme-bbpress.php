<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( !function_exists('thb_bbpress_remove_sidebar') ) {
	/**
	 * Remove the page sidebar from the bbPress topic pages
	 */
	function thb_bbpress_remove_sidebar() {
		if ( is_bbpress() && ! ( bbp_is_forum_archive() || bbp_is_single_forum() ) ) {
			add_filter( 'thb_page_sidebar', '__return_false' );
		}
	}

	add_action( 'thb_before_doctype', 'thb_bbpress_remove_sidebar' );
}