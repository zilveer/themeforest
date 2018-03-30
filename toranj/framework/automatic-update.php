<?php
/**
 *  Automatic updater
 * 
 * @package toranj
 * @author owwwlab (Alireza Jahandideh & Ehsan Dalvand @owwwlab)
 */

 add_action( 'after_setup_theme', 'toranj_check_for_updates' );

if ( ! function_exists( 'toranj_check_for_updates' ) ) {
	function toranj_check_for_updates() {
		
		
		$username = trim( ot_get_option( 'toranj_envato_username', '' ) );
		$api_key  = trim( ot_get_option( 'toranj_envato_api_key', '' ) );

		if ( ! empty( $username ) && ! empty( $api_key ) ) {
			load_template( get_template_directory() . '/framework/envato-wordpress-theme-updater/envato-wp-theme-updater.php' );

			if ( class_exists( 'Envato_WP_Theme_Updater' ) ) {
				
				Envato_WP_Theme_Updater::init( $username, $api_key,'owwwlab' );
			}
		}
		
	}
}
