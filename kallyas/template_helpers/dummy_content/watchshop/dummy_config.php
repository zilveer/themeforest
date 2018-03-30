<?php
/**
 * This file contains various tweaks for this export
 */

/* Set the proper homepage */
$homepage = get_page_by_title( 'Home' );
if(isset( $homepage ) && $homepage->ID) {
	update_option('show_on_front', 'page'); // Set to static frontpage
	update_option('page_on_front', $homepage->ID); // Front Page
}

/* Set the proper shop page */
$shoppage = get_page_by_title( 'Shop' );
if(isset( $shoppage ) && $shoppage->ID) {
	update_option('woocommerce_shop_page_id', $shoppage->ID); // Front Page
}

