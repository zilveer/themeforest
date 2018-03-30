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

if( tie_get_option('notify_theme') && is_admin() ):

define( 'MTHEME_NOTIFIER_CACHE_INTERVAL', 43200 );

// Adds an update notification to the WordPress Dashboard menu
function tie_update_notifier_menu() {
	if ( function_exists('wp_get_theme') ) { // Stop if simplexml_load_string funtion isn't available
	  $xml 		= tie_get_latest_theme_version(MTHEME_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$theme_data = wp_get_theme( THEME_FOLDER ); // Read theme current version from the style.css

         if( !empty( $xml->latest ) && version_compare( $xml->latest, $theme_data['Version'], '>') ) { // Compare current theme version with the remote XML version
			add_submenu_page('panel', THEME_NAME . __( 'Theme Updates', 'tie' ), __( 'Theme Updates', 'tie' ) . ' <span class="update-plugins tie-theme-update"><span class="update-count">'.__( 'New', 'tie' ).'</span></span>','administrator', 'theme-update-notifier' , 'tie_update_notifier');
		}
	}
}
add_action('admin_menu', 'tie_update_notifier_menu', 99999);


// The notifier page
function tie_update_notifier() {
	if( function_exists('wp_get_theme') ){
		$xml 		= tie_get_latest_theme_version(MTHEME_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$theme_data = wp_get_theme( THEME_FOLDER ); // Read theme current version from the style.css
	}?>
	<style>
		.update-nag { display: none; }
		#instructions {
			font-size: 110%;
		}
		#instructions p {
			font-size: 110%;
		}
		#instructions i {
			background: #FFF8D6;
			padding: 0 4px;
		}
		a.check-changelog{
		    display: inline-block;
		    margin: 10px auto;
		    text-align: center;
		    vertical-align: middle;
		    cursor: pointer;
		    box-sizing: border-box;
		    word-wrap: break-word;
		    text-decoration: none;
		    -webkit-transition: all 0.2s ease-in-out;
		    transition: all 0.2s ease-in-out;
		    line-height: normal;
		    font-size: 14px;
		    padding-top: 14px;
		    padding-bottom: 14px;
		    padding-left: 20px;
		    padding-right: 20px;
			color: #ffffff !important;
		    background-color: #6dab3c;
		    outline: 0 !important;
		    font-weight: bold;
		}
		a.check-changelog:hover,
		a.check-changelog:focus,
		a.check-changelog:active{
			background-color: #5f9434;
		}

	</style>

	<div class="wrap">


		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo THEME_NAME ?> <?php _e( 'Theme Updates', 'tie' ) ?></h2>

		<div id="message" class="updated below-h2">
			<p>
				<strong><?php printf( __( 'There is a new version of the %s theme available.', 'tie' ), THEME_NAME ) ?> </strong> <?php printf( __( 'You have version %1$s installed. Update to version %2$s .' ), $theme_data['Version'], $xml->latest ) ?>
			</p>
		</div>

		<img style="margin: 0 0 20px 0; border: 1px solid #ddd; max-width:400px; height:auto;" src="<?php echo get_stylesheet_directory_uri() . '/screenshot.png'; ?>" />

		<div id="instructions">

			<h2><?php _e( 'Updating Automatically', 'tie' ) ?></h2>
			<p><?php _e( 'Envato have developed the <a href="https://github.com/envato/envato-wordpress-toolkit" target="_blank">Envato Toolkit Plugin</a> for WordPress.
				You can use this to receive notification of updates to themes purchased from ThemeForest
				and to automatically update (upon clicking) directly from within your WordPress admin area.', 'tie' ) ?>
			</p>
			<ol>
				<li class="p-bottom"><?php _e( 'Download the <a href="https://github.com/envato/envato-wordpress-toolkit/zipball/master">plugin zip file</a> to your computer.', 'tie' ) ?></li>
				<li class="p-bottom"><?php _e( 'In your WordPress admin area, go to <i>Plugins &gt; Add New</i> then click <i>Upload</i>.', 'tie' ) ?></li>
				<li class="p-bottom"><?php _e( 'Click <i>Choose File</i>, select the plugin zip file you downloaded and click <i>Install Now</i>.', 'tie' ) ?></li>
				<li class="p-bottom"><?php _e( 'After installation, click <i>Activate</i>.', 'tie' ) ?></li>
				<li class="p-bottom"><?php _e( 'Click the new <i>Envato Toolkit</i> link in the menu and follow the instructions to configure the plugin.', 'tie' ) ?></li>
			</ol>

			<h2><?php _e( 'Updating Manually', 'tie' ) ?></h2>
			<ol>
				<li class="p-bottom"><?php _e( 'Download the most current version from <a href="http://themeforest.net/downloads?ref=tielabs" target="_blank">ThemeForest</a> in the <i>Downloads</i> area of your account.', 'tie' ) ?></li>
				<li class="p-bottom"><?php printf( __( 'Unzip the package and locate <i>%s.zip</i> in the theme folder.', 'tie' ), THEME_NAME ) ?></li>
				<li class="p-bottom"><?php _e( 'Go to <i>Appearance &gt; Themes</i> and activate another theme such as the default WordPress theme.', 'tie' ) ?></li>
				<li class="p-bottom"><?php printf( __( 'Delete the <i>%s</i> theme which is now inactive.', 'tie' ), THEME_NAME  ) ?></li>
				<li class="p-bottom"><?php printf( __( 'Go to <i>Install Themes &gt; Upload</i> then install and activate <i>%s.zip</i> from the new package.', 'tie' ) , THEME_NAME  ) ?></li>
			</ol>

			<h2><?php _e( 'Changelog and Update History', 'tie' ) ?></h2>
			<a class="check-changelog" href="<?php echo NOTIFIER_CHANGELOG_URL ?>" target="_blank"><?php _e( 'View the ChangeLog Details', 'tie' ) ?></a>
		</div>
	</div>

<?php }



// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function tie_get_latest_theme_version($interval) {
	$notifier_file_url 			 = NOTIFIER_XML_FILE;
	$db_cache_field 			 = 'notifier-cache-'.THEME_NAME;
	$db_cache_field_last_updated = 'notifier-cache-last-updated-'.THEME_NAME;
	$last 						 = get_option( $db_cache_field_last_updated );
	$now 						 = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it

		$cache = wp_remote_retrieve_body( wp_remote_get( $notifier_file_url , array( 'sslverify' => false ) ) );

		if ($cache) {
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
	if( strpos((string)$notifier_data, '<notifier>') === false ) {
		$notifier_data = '<?xml version="1.0.0" encoding="UTF-8"?><notifier><latest>1.0.0</latest></notifier>';
	}

	// Load the remote XML data into a variable and return it
	$xml = @simplexml_load_string($notifier_data);

	return $xml;
}

endif;
