<?php if(! defined('ABSPATH')){ return; }
/**
 * About splash screen
 *
 * @author 		ThemeFuzz
 * @category 	Admin
 * @package 	ZnFramework/Classes
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Zn_Install Class
 */
class Zn_About {

	function __construct(){
		add_action( 'admin_menu', array( $this, 'admin_menus') );
		add_action( 'admin_init', array( $this, 'check_page' ) );
		add_action( 'admin_enqueue_scripts', array(&$this, 'zn_print_scripts') );
	}

	/*
	 *	Checks to see if we need to replace pages with our update page
	 */
	function check_page(){

		if( get_option( 'zn_theme_needs_update' ) && ( !isset( $_GET['page'] ) || isset( $_GET['page'] ) && $_GET['page'] != 'zn-update' ) && !ZN()->is_request('ajax') ) {
			wp_redirect( admin_url( 'index.php?page=zn-update' ) );
			exit();
		}

	}

	function admin_menus(){
		if ( empty( $_GET['page'] ) ) {
			return;
		}

		$about_page_name  = __( 'About Kallyas', 'zn_framework' );
		$welcome_page_title = __( 'Welcome to Kallyas', 'zn_framework' );

		switch ( $_GET['page'] ) {

			case 'zn-about' :
				$page = add_dashboard_page( $welcome_page_title, $about_page_name, 'manage_options', 'zn-about', array( $this, 'about_screen' ) );
			break;
			case 'zn-update' :
				// Remove all admin notices
				if( get_option( 'zn_theme_needs_update' ) ){
					remove_all_actions('admin_notices', 10 );
					$page = add_dashboard_page( $welcome_page_title, $about_page_name, 'manage_options', 'zn-update', array( $this, 'update_screen' ) );
				}

			break;
		}
	}

	function about_screen(){

		$about_screen_html = THEME_BASE .'/template_helpers/update/ui/html-page-about.php';
		if( file_exists( $about_screen_html ) ){
			require( $about_screen_html );
		}
		else{
			require( FW_PATH .'/classes/ui/html-page-about.php' );
		}
	}

	function zn_print_scripts( $hook ){

		/* Set default theme pages where the js and css should be loaded */
		$about_pages = array(
			'dashboard_page_zn-update'
		);

		if ( !in_array( $hook, $about_pages ) ) {
			return;
		}

		// Load the framework assets
		ZN()->load_html_scripts();
	}

	function update_screen(){

		$updater_screen_html = THEME_BASE .'/template_helpers/update/ui/html-page-update.php';
		if( file_exists( $updater_screen_html ) ){
			require( $updater_screen_html );
		}
		else{
			require( FW_PATH .'/classes/ui/html-page-update.php' );
		}
	}

}

new Zn_About();
