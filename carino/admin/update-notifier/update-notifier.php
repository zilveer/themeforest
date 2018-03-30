<?php
/**************************************************************
 *                                                            *
 *   Provides a notification to the user everytime            *
 *   your WordPress theme is updated                          *
 *                                                            *
 *   Author: Joao Araujo                                      *
 *   Profile: http://themeforest.net/user/unisphere           *
 *   Follow me: http://twitter.com/unispheredesign            *
 *                                                            *
 **************************************************************/
 /*==============================================================
 *	Modified by Vanthemes.com to be compatible with Theme-Check 
 =================================================================*/

define( 'NOTIFIER_THEME_NAME', THEME_NAME );
define( 'NOTIFIER_THEME_FOLDER_NAME', THEME_FOLDER);
define( 'NOTIFIER_CACHE_INTERVAL', 1 );
define( 'NOTIFIER_XML_FILE', THEME_XML ); 


// Adds an update notification to the WordPress Dashboard menu
function van_update_notifier_menu() {  
	if (function_exists('simplexml_load_string') && function_exists("wp_get_theme") ) { // Stop if simplexml_load_string funtion isn't available
	    	$xml = van_get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$theme_data = wp_get_theme(NOTIFIER_THEME_FOLDER_NAME); // Read theme current version from the style.css
		
		if( version_compare($xml->latest, $theme_data['Version'], '>') ) { // Compare current theme version with the remote XML version
		   	add_theme_page( NOTIFIER_THEME_NAME . ' Theme Updates', NOTIFIER_THEME_NAME . ' <span class="update-plugins count-1"><span class="update-count">New Updates</span></span>', 'administrator', 'theme-update-notifier', 'van_update_notifier');
		}
	}	
}
add_action('admin_menu', 'van_update_notifier_menu');

// add update icon to appearance menu  
function van_edit_admin_menus() {  
	if (function_exists('simplexml_load_string') && function_exists("wp_get_theme") ) { 
		global $menu;
	    	$xml = van_get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$theme_data = wp_get_theme(NOTIFIER_THEME_FOLDER_NAME); // Read theme current version from the style.css
		
		if( version_compare($xml->latest, $theme_data['Version'], '>') ) { 
			$menu[60][0] .= '<span class="update-plugins count-1"><span class="update-count">1</span></span>';
		}
	}
}  
add_action( 'admin_menu', 'van_edit_admin_menus' );

// Adds an update notification to the WordPress 3.1+ Admin Bar
function van_update_notifier_bar_menu() {
	if (function_exists('simplexml_load_string') && function_exists("wp_get_theme") ) { // Stop if simplexml_load_string funtion isn't available
		global $wp_admin_bar, $wpdb;
	
		if ( !is_super_admin() || !is_admin_bar_showing() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
		return;
		
		$xml = van_get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$theme_data = wp_get_theme(NOTIFIER_THEME_FOLDER_NAME); // Read theme current version from the style.css
	
		if( version_compare($xml->latest, $theme_data['Version'], '>') ) { // Compare current theme version with the remote XML version
			$wp_admin_bar->add_menu( array( 'id' => 'update_notifier', 'title' => '<span>' . NOTIFIER_THEME_NAME . ' <span id="ab-updates">New Updates</span></span>', 'href' => get_admin_url() . 'themes.php?page=theme-update-notifier' ) );
		}
	}
}
add_action( 'admin_bar_menu', 'van_update_notifier_bar_menu', 1000 );


// The notifier page
function van_update_notifier() { 
	$xml = van_get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
	$theme_data = wp_get_theme(NOTIFIER_THEME_FOLDER_NAME); // Read theme current version from the style.css ?>
	
	<style>
		.update-nag { display: none; }
		#instructions {max-width: 670px;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo NOTIFIER_THEME_NAME ?> Theme Updates</h2>
	    <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo NOTIFIER_THEME_NAME; ?> theme available.</strong> You have version <?php echo $theme_data['Version']; ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>

		<img width="300" height="225" style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" />
		
		<div id="instructions">
		    <h3>Update Download and Instructions</h3>
		    <p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo NOTIFIER_THEME_FOLDER_NAME; ?>/</strong></p>
		    <p>To update the Theme, login to <a href="<?php echo esc_url('http://www.themeforest.net/'); ?>">ThemeForest</a>, head over to your <strong>downloads</strong> section and re-download the theme like you did when you bought it.</p>
		    <p>Extract the zip's contents, look for the extracted theme folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/themes/<?php echo NOTIFIER_THEME_FOLDER_NAME; ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
		    <p>If you didn't make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, etc, and backwards compatibility is guaranteed.</p>
		</div>
	    
	    <h3 class="title">Changelog</h3>
	    <?php echo $xml->changelog; ?>

	</div>
    
<?php } 

// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function van_get_latest_theme_version($interval) {
	$notifier_file_url = NOTIFIER_XML_FILE;	
	$db_cache_field = 'notifier-cache';
	$db_cache_field_last_updated = 'notifier-cache-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache

	if ( !$last || (( $now - $last ) > $interval) ) {

		$response = wp_remote_get($notifier_file_url);
		
		if ( !is_wp_error($response) ) {
			$cache = wp_remote_retrieve_body($response);
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );
			$notifier_data = $cache;
		}else{
			$notifier_data = get_option( $db_cache_field );
		}
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	// Let's see if the $xml data was returned as we expected it to.
	// If it didn't, use the default 1.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	if( strpos((string)$notifier_data, '<notifier>') === false ) {
		$notifier_data = '<?xml version="1.0" encoding="UTF-8"?><notifier><latest>1.0</latest><changelog></changelog></notifier>';
	}
	
	// Load the remote XML data into a variable and return it
	$xml = simplexml_load_string($notifier_data); 
	
	return $xml;
}
?>