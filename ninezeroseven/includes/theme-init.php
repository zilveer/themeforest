<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/************************************************************************
* Include Options FrameWork & Admin Assets
*************************************************************************/
require dirname( __FILE__ ) . '/admin/index.php';

/************************************************************************
* Theme Functions
*************************************************************************/
require dirname( __FILE__ ) . '/functions/index.php';

/************************************************************************
* Include VC Settings/Extend
*************************************************************************/
if ( class_exists( 'WPBMap' ) ) {
	function wbc907_vc_settings() {
		require_once dirname( __FILE__ ) . '/vc_extend/vc-functions.php';
	}

	add_action( 'init' , 'wbc907_vc_settings', 5 );
}

/************************************************************************
* WooCommerce
*************************************************************************/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	if( file_exists( dirname( __FILE__ ) . '/config-woo/woo-functions.php' ) ){
   		require dirname( __FILE__ ) . '/config-woo/woo-functions.php';
	}
}

?>
