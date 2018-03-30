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
 
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 

// Constants for the theme name, folder and remote XML url
define( 'UDESIGN_NOTIFIER_THEME_NAME', 'U-Design' ); // The theme name
define( 'UDESIGN_NOTIFIER_THEME_FOLDER_NAME', 'u-design' ); // The theme folder name
define( 'UDESIGN_NOTIFIER_XML_FILE', 'http://idesignmywebsite.com/notifier/u-design/notifier.xml' ); // The remote notifier XML file containing the latest version of the theme and changelog
define( 'UDESIGN_NOTIFIER_CACHE_INTERVAL', 21600 ); // The time interval for the remote XML cache in the database (21600 seconds = 6 hours)

// Get the current theme version (always from parent theme)
if ( function_exists('wp_get_theme') ) { // if WordPress v3.4+
    $curr_theme = ( wp_get_theme()->parent() ) ? wp_get_theme()->parent() : wp_get_theme();
    $curr_theme_version = $curr_theme->get('Version');
} else {
    $curr_theme = get_theme_data( trailingslashit( get_template_directory() ) . 'style.css' );
    $curr_theme_version = $curr_theme['Version'];
}
define( 'UDESIGN_NOTIFIER_CURR_THEME_VERSION', $curr_theme_version );

// Adds an update notification to the WordPress Dashboard menu
function update_notifier_menu() {  
	if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
	    $xml = get_latest_theme_version(UDESIGN_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
            
            if( version_compare($xml->latest, UDESIGN_NOTIFIER_CURR_THEME_VERSION, '>') ) { // Compare current theme version with the remote XML version
                    add_dashboard_page( UDESIGN_NOTIFIER_THEME_NAME . ' Theme Updates', UDESIGN_NOTIFIER_THEME_NAME . ' <span class="update-plugins count-1"><span class="update-count">1 Update</span></span>', 'administrator', 'theme-update-notifier', 'update_notifier');
            }
	}	
}
add_action('admin_menu', 'update_notifier_menu');  



// Adds an update notification to the WordPress 3.1+ Admin Bar
function update_notifier_bar_menu_udesign() {
	if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
		global $wp_admin_bar, $wpdb;
	
		if ( !is_super_admin() || !is_admin_bar_showing() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
		return;
		
		$xml = get_latest_theme_version(UDESIGN_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
	
		if( version_compare($xml->latest, UDESIGN_NOTIFIER_CURR_THEME_VERSION, '>') ) { // Compare current theme version with the remote XML version
			$wp_admin_bar->add_menu( array( 'id' => 'update_notifier', 'title' => '<span>' . UDESIGN_NOTIFIER_THEME_NAME . ' <span id="ab-updates">1 Update</span></span>', 'href' => get_admin_url() . 'index.php?page=theme-update-notifier' ) );
		}
	}
}
add_action( 'admin_bar_menu', 'update_notifier_bar_menu_udesign', 1000 );



// The notifier page
function update_notifier() { 
	$xml = get_latest_theme_version(UDESIGN_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server ?>
	
	<style>
		.update-nag { display: none; }
		#instructions {max-width: 100%;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo UDESIGN_NOTIFIER_THEME_NAME ?> Theme Updates</h2>
                <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo UDESIGN_NOTIFIER_THEME_NAME; ?> theme available.</strong> You have version <?php echo UDESIGN_NOTIFIER_CURR_THEME_VERSION; ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>

		<img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" width="350" />
                
		<div id="instructions">
                    <h3 style="margin-top: 30px; line-height: 1.5;">For update instructions please go to <a href="<?php echo admin_url('admin.php?page=udesign_updates_options_page'); ?>">U-Design Theme Update</a>.</h3>
                    <p>To find out what's new in the latest release please refer to the "Changelog" below.</p>
		</div>
                <div class="clear"></div>

	    <h3 class="title">Changelog</h3>
	    <?php echo $xml->changelog; ?>

	</div>
    
<?php } 


// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function get_latest_theme_version($interval) {
	$notifier_file_url = UDESIGN_NOTIFIER_XML_FILE;	
	$db_cache_field = 'udesign-notifier-cache';
	$db_cache_field_last_updated = 'udesign-notifier-cache-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
                if( function_exists('wp_remote_get') ) { // if WordPress HTTP API is available
                    $resp = wp_remote_get( $notifier_file_url, array( 'timeout' => 10 ) );
                    if ( !is_wp_error( $resp ) && is_array($resp) && 200 == $resp['response']['code'] ) {
                        $cache = $resp['body'];
                        if ($cache) {			
                                // we got good results	
                                update_option( $db_cache_field, $cache );
                        }
                    }
		}
                
                // update the last check timestamp regardless of results above. This is to avoid unecessary requests to remote file in case the remote server is down, the file renamed, missing, etc., which could cause slow admin pages
                update_option( $db_cache_field_last_updated, time() );
		 
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	} else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	// Let's see if the $xml data was returned as we expected it to.
	// If it didn't, use the default 1.0.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	if( strpos((string)$notifier_data, '<notifier>') === false ) {
		$notifier_data = '<?xml version="1.0.0" encoding="UTF-8"?><notifier><latest>1.0.0</latest><changelog></changelog></notifier>';
	}
	
	// Load the remote XML data into a variable and return it
	$xml = @simplexml_load_string($notifier_data); 
	
	return $xml;
}

