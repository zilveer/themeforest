<?php
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo '<!------- SIDEBAR ---------><div class="sidebar_wrapper margin-left48">';
dynamic_sidebar( 'woocommerce' );
echo '</div>';