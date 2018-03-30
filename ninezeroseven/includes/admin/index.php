<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/************************************************************************
* ReduxFrameWork Config Files
*************************************************************************/
require dirname( __FILE__ ) . '/configs/index.php';

/************************************************************************
* Includes
*************************************************************************/

if ( is_admin() ) {

	//TGM Plugin activation
	require dirname( __FILE__ ) . '/assets/install-plugins.php';

	//Flush rewrite on theme switch :)
	if ( !function_exists( 'wbc907_flush_rewrite_rules' ) ) {

		function wbc907_flush_rewrite_rules() {
			flush_rewrite_rules();
		}

		add_action( 'after_switch_theme', 'wbc907_flush_rewrite_rules' );
	}

}
?>