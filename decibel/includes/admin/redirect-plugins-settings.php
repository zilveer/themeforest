<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_redirect_plugin_settings' ) ) {
	/**
	 * Redirect wolf plugin settings to theme options page
	 *
	 * @access public
	 * @return void
	 */
	function wolf_redirect_plugin_settings() {

		if ( isset( $_GET['post_type'] ) ) {

			if ( 'gallery' == $_GET['post_type'] && isset( $_GET['page'] ) && 'wolf-albums-settings' == isset( $_GET['page'] ) )  {

				wp_redirect( admin_url( 'admin.php?page=wolf-theme-options#photo-albums' ) );
				exit;
			}

			if ( 'work' == $_GET['post_type'] && isset( $_GET['page'] ) && 'wolf-work-settings' == isset( $_GET['page'] ) )  {

				wp_redirect( admin_url( 'admin.php?page=wolf-theme-options#portfolio' ) );
				exit;
			}

			if ( 'video' == $_GET['post_type'] && isset( $_GET['page'] ) && 'wolf-video-settings' == isset( $_GET['page'] ) )  {

				wp_redirect( admin_url( 'admin.php?page=wolf-theme-options#videos' ) );
				exit;
			}

			if ( 'release' == $_GET['post_type'] && isset( $_GET['page'] ) && 'wolf-discography-settings' == isset( $_GET['page'] ) )  {

				wp_redirect( admin_url( 'admin.php?page=wolf-theme-options#discography' ) );
				exit;
			}
		}
	}
	//add_action( 'admin_init', 'wolf_redirect_plugin_settings' );
}
