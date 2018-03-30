<?php

/**************************************************************
 *                                                            *
 *   Provides a notification to the user everytime            *
 *   your WordPress theme is updated                          *
 *                                                            *
 *   Author: Joao Araujo  									  *
 *   Profile: http://themeforest.net/user/unisphere           *
 *   Follow me: http://twitter.com/unispheredesign   		  *
 *															  *
 *	 Modified By: Orange-Themes								  *
 *   Web: http://www.orange.themes.com     					  *
 *	 Follow us on Twitter: http://twitter.com/orangethemes	  *
 *	 Follow us on Facebook: http://facebook.com/orangethemes  *
 **************************************************************/
 
 

// Constants for the theme name, folder and remote XML url
define( 'THEME_NOTIFIER_THEME_NAME', THEME_FULL_NAME ); // The theme name
define( 'THEME_NOTIFIER_THEME_FOLDER_NAME', THEME_NAME ); // The theme folder name
define( 'THEME_NOTIFIER_XML_FILE', 'http://www.orange-themes.com/other-orange-themes/' ); // The remote notifier XML file containing the latest version of the theme and changelog
define( 'THEME_NOTIFIER_CACHE_INTERVAL', 21600 ); // The time interval for the remote XML cache in the database (21600 seconds = 6 hours)

// Adds an update notification to the WordPress Dashboard menu
function theme_update_notifier_menu() {  
	if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
	    $xml = theme_get_latest_theme_version(THEME_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$title = explode("Private: ", $xml->item->title);
		
            if( $title[1] != get_option('latest-orange-theme') ) { // Compare current theme version with the remote XML version
                    //add_dashboard_page( THEME_NOTIFIER_THEME_NAME . '  ', 'Orange Themes ' . ' <span class="update-plugins count-1"><span class="update-count">1</span></span>', 'administrator', 'other-themes', 'other_themes');
					add_submenu_page('themes.php', "More Themes From Orange Themes", "More Themes From Orange Themes <span class=\"update-plugins count-1\"><span class=\"update-count\">1</span></span>", 'administrator', "other-themes", "other_themes");
			} else { 
					add_submenu_page('themes.php', "More Themes From Orange Themes", "More Themes From Orange Themes", 'administrator', "other-themes", "other_themes");
			}
	}	
}
add_action('admin_menu', 'theme_update_notifier_menu');  



// Adds an update notification to the WordPress 3.1+ Admin Bar
function theme_update_notifier_bar_menu() {
	if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
		global $wp_admin_bar, $wpdb;
	
		if ( !is_super_admin() || !is_admin_bar_showing() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
		return;
			$xml = theme_get_latest_theme_version(THEME_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
			$title = explode("Private: ", $xml->item->title);
	
		if( $title[1] != get_option("latest-orange-theme") ) { // Compare current theme version with the remote XML version
			$wp_admin_bar->add_menu( array( 'id' => 'other_themes', 'title' => '<span>Orange Themes <span id="ab-updates">1 Theme</span></span>', 'href' => get_admin_url() . '/themes.php?page=other-themes' ) );
		}
	}
	
}
add_action( 'admin_bar_menu', 'theme_update_notifier_bar_menu', 1000 );

 	$xml = theme_get_latest_theme_version(THEME_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
	$title = explode("Private: ", $xml->item->title);
	if ( isset( $_GET['page'] ) && $_GET['page'] == "other-themes" ) {
		update_option( 'latest-orange-theme', $title[1] );
	}


// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function theme_get_latest_theme_version($interval) {

	$notifier_file_url = THEME_NOTIFIER_XML_FILE;	
	$db_cache_field = 'orange-themes-notifier-cache';
	$db_cache_field_last_updated = 'orange-themes-notifier-cache-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
			
		 $cache = wp_remote_get($notifier_file_url);

	
		if ($cache && is_array($cache)) {	
			$cache = $cache['body'];
			// we got good results	
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );
		} 
		
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	// Let's see if the $xml data was returned as we expected it to.
	// If it didn't, use the default 1.0.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	if( strpos((string)$notifier_data, '<theme>') === false ) {
		$notifier_data = '<?xml version="1.0.0" encoding="UTF-8"?><theme><item><title></title><item></theme>';
	}
	
	// Load the remote XML data into a variable and return it
	$xml = @simplexml_load_string($notifier_data); 
	
	return $xml;
}

?>