<?php
/*
Plugin Name: WooTumblog
Plugin URI: http://wordpress.org/extend/plugins/woo-tumblog/
Description: Create a tumblr style blog using this plugin.
Version: 2.0.2
Author: Jeffikus of WooThemes
Author URI: http://www.woothemes.com
License: GPL2
*/

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Include Classes and Functions
- Initiate the plugin
-- WooTumblogInit()

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Include Classes and Functions */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('WooTumblogInit')) {

	// Main Tumblog Plugin Class
	include( 'classes/wootumblog.class.php' );
	// Test for Post Formats
	if (get_option('woo_tumblog_content_method') == 'post_format') {
		// Tumblog Post Format Class
		include( 'classes/wootumblog_postformat.class.php' );
	} else {
		// Tumblog Custom Taxonomy Class
		include( 'classes/wootumblog_taxonomy.class.php' );
	}
	// Dashboard Widget Output Functions
	include( 'functions/wootumblog_dashboard_functions.php' );
	// Test for Post Formats
	if (get_option('woo_tumblog_content_method') == 'post_format') {
		// Don't use the iPhone app functions - TEMPORARY UNTIL EXPRESS APP UPGRADES
		include( 'functions/wootumblog_express_app_functions.php' );
	} else {
		// Express iPhone app Functions
		include( 'functions/wootumblog_express_app_functions_deprecated.php' );
	}
	// Woo Helper Functions
	include( 'functions/wootumblog_helper_functions.php' );
	// Template Output Functions
	include( 'functions/wootumblog_template_functions.php' );

	/*-----------------------------------------------------------------------------------*/
	/* Initiate the plugin */
	/*-----------------------------------------------------------------------------------*/

	add_action("init", "WooTumblogInit");
	function WooTumblogInit() { 
	
		$pluginpath = dirname( __FILE__ );
		$pluginurl = get_template_directory_uri().'/plugins/woo-tumblog/';
	 		
		//Main Tumblog Object
		global $woo_tumblog; 
		$woo_tumblog = new WooTumblog(); 
		
		// Test for Post Formats
		if (get_option('woo_tumblog_content_method') == 'post_format') {
			//Tumblog Post Formats
			global $woo_tumblog_post_format; 
			$woo_tumblog_post_format = new WooTumblogPostFormat(); 
			if ( $woo_tumblog_post_format->woo_tumblog_upgrade_existing_taxonomy_posts_to_post_formats()) {
				update_option('woo_tumblog_post_formats_upgraded','true');
			}
			
		} else {
			//Tumblog Custom Taxonomy
			global $woo_tumblog_taxonomy; 
			$woo_tumblog_taxonomy = new WooTumblogTaxonomy(); 
			$woo_tumblog_taxonomy->woo_tumblog_create_initial_taxonomy_terms();
		}
	
	}
}

register_activation_hook(__FILE__,'woo_tumblog_on_activation');

function woo_tumblog_on_activation() {


}


?>
