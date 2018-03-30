<?php
/*
Plugin Name: WooCommerce Grid / List toggle
Plugin URI: http://jameskoster.co.uk/tag/grid-list-toggle/
Description: Adds a grid/list view toggle to product archives
Version: 0.3.4
Author: jameskoster
Author URI: http://jameskoster.co.uk
Requires at least: 3.3
Tested up to: 3.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wc_list_grid_toggle
Domain Path: /languages/
*/

/**
 * Check if WooCommerce is active
 **/
if ( class_exists('WooCommerce') ) {

	/**
	 * WC_List_Grid class
	 **/
	if (!class_exists('WC_List_Grid')) {

		class WC_List_Grid {

			public function __construct() {
				// Hooks
  				add_action( 'wp' , array( $this, 'setup_gridlist' ) , 20);
			}

			// Setup
			function setup_gridlist() {
				if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
					add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);
				}
			}
		}
		$WC_List_Grid = new WC_List_Grid();
	}
}
