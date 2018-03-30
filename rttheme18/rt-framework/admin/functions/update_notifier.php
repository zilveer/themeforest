<?php
/**************************************************************
 *   ADAPTED										  *
 *   ---------										  *
 *												  *
 *   Provides a notification to the user everytime            *
 *   your WordPress theme is updated                          *
 *                                                            *
 *   Author: Joao Araujo                                      *
 *   Profile: http://themeforest.net/user/unisphere           *
 *   Follow me: http://twitter.com/unispheredesign            *
 *                                                            *
 **************************************************************/
function rt_get_latest_theme_version($interval) {
	 
	$notifier_file_url = RT_NOTIFIER_XML_FILE;	
	$db_cache_field = RT_THEMESLUG.'notifier-cache';
	$db_cache_field_last_updated = RT_THEMESLUG.'notifier-cache-last-updated';
 
	$last = get_option( $db_cache_field_last_updated );
	$now = time();

	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
 
		// cache doesn't exist, or is old, so refresh it 
		$cache = wp_remote_get( $notifier_file_url, array( 'timeout' => 5, 'httpversion' => '1.1' ) ); 

		if (is_array( $cache )){
			if ( isset( $cache["response"] ) && isset( $cache["response"]["code"] ) && $cache["response"]["code"] == "200" ) {
				if ( isset( $cache["body"] ) ) {			
					// we got good results	
					update_option( $db_cache_field, $cache["body"] );					
				} 
			} 
		}

		//update the time
		update_option( $db_cache_field_last_updated, time() );

		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	// Let's see if the $rt_update_xml data was returned as we expected it to.
	// If it didn't, use the default 1.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	if( strpos((string)$notifier_data, '<notifier>') === false ) {
		$notifier_data = '<?xml version="1.0" encoding="UTF-8"?><notifier><latest>0</latest><changelog></changelog></notifier>';
	}
	
	// Load the remote XML data into a variable and return it
	$rt_update_xml = simplexml_load_string($notifier_data); 
	
	return $rt_update_xml;
} 
?>