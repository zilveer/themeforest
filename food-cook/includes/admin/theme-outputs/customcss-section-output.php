<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}

$woo_options = get_option( 'woo_options' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue dynamic CSS 																 */
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_head', 'woo_enqueue_custom_styling' );		// Check for an enqueue custom styles, if necessary.

if ( ! function_exists( 'woo_enqueue_custom_styling' ) ) :
	function woo_enqueue_custom_styling () {
		echo '<!-- Custom CSS Styling -->';
		echo '<style type="text/css">';
		woo_custom_styling();
		echo '</style>';
	} // End woo_enqueue_custom_styling()
endif;