<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_remove_vc_admin_bar_menu_item' ) ) {
	/**
	 * Remove "edit with visual composer" link from admin bar
	 *
	 *  @access public
	 *  @return void
	 */
	function wolf_remove_vc_admin_bar_menu_item() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_node( 'vc_inline-admin-bar-link' );
	}
	add_action( 'admin_bar_menu', 'wolf_remove_vc_admin_bar_menu_item', 9999 );
}