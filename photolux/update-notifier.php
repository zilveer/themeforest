<?php
/**************************************************************
* *
* Provides a notification to the user everytime *
* your WordPress theme is updated *
* *
* Author: Joao Araujo *
* Profile: http://themeforest.net/user/unisphere *
* Follow me: http://twitter.com/unispheredesign *
* *
* NOTE: Modified by Pexeto
**************************************************************/

 


// Constants for the theme name, folder and remote XML url
define( 'NOTIFIER_THEME_NAME', 'Photolux' ); // The theme name
define( 'NOTIFIER_THEME_SHORTNAME', 'photolux' ); // The theme name
define( 'NOTIFIER_XML_FILE', 'http://pexeto.com/updates/photolux.xml' ); // The remote notifier XML file containing the latest version of the theme and changelog
define( 'NOTIFIER_CACHE_INTERVAL', 21600 ); // The time interval for the remote XML cache in the database (21600 seconds = 6 hours)
define ('PEXETO_UPDATE_PAGE_NAME', 'theme-update-notifier');


// Adds an update notification to the WordPress Dashboard menu
if(!function_exists("update_notifier_menu")){
	function update_notifier_menu() {
		if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
			$newversion=pexeto_check_if_new_version();
			
			$count = (isset($_GET['pexeto_update']) &&  $_GET['pexeto_update']=='true')?'':'<span class="update-plugins count-1"><span class="update-count">1</span></span>';
			if($newversion) { // Compare current theme version with the remote XML version
				add_dashboard_page( NOTIFIER_THEME_NAME . ' Theme Updates', NOTIFIER_THEME_NAME . ' Update '.$count, 'administrator', PEXETO_UPDATE_PAGE_NAME, 'update_notifier');
			}
		}
	}
}
add_action('admin_menu', 'update_notifier_menu');

if(!function_exists("pexeto_check_if_new_version")){
	function pexeto_check_if_new_version(){
		$xml = get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
			
		$latest = explode('.',$xml->latest);
		$current= explode('.',PEXETO_VERSION);
		$newversion=false;
		for($i=0; $i<sizeof($latest); $i++){
			if((int)$current[$i]<(int)$latest[$i]){
				$newversion=true;
				break;
			}elseif ( (int)$current[$i]>(int)$latest[$i] ) {
				$newversion=false;
				break;
			}
		}
		return $newversion;
	}
}

// Adds an update notification to the WordPress 3.1+ Admin Bar
if(!function_exists("update_notifier_bar_menu")){
	function update_notifier_bar_menu() {
		if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
			global $wp_admin_bar, $wpdb;
			
			if ( !is_super_admin() || !is_admin_bar_showing() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
			return;
			
			$newversion=pexeto_check_if_new_version();
			
			if($newversion) { // Compare current theme version with the remote XML version
				$wp_admin_bar->add_menu( array( 'id' => 'update_notifier', 'title' => '<span>' . NOTIFIER_THEME_NAME . ' <span id="ab-updates">New Updates</span></span>', 'href' => get_admin_url() . 'index.php?page=theme-update-notifier' ) );
			}
		}
	}
}
add_action( 'admin_bar_menu', 'update_notifier_bar_menu', 1000 );



// The notifier page
if(!function_exists("update_notifier")){
	function update_notifier() {
		$xml = get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$theme_data = wp_get_theme(); // Read theme current version from the style.css
		$options_url= admin_url('index.php?page='.PEXETO_UPDATE_PAGE_NAME.'&pexeto_update=true'); ?>

		<script type="text/javascript">
		var pexetoUpdateData = {
			optionsLink: "<?php echo $options_url; ?>",
			envatoDetails: <?php if (get_opt('_tf_username') && get_opt('_tf_api_key')) { echo "true"; } else { echo "false" ; } ?>
		};
		</script>

		<div class="wrap">

		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo NOTIFIER_THEME_NAME ?> Theme Updates</h2>

		<?php if(!(isset($_GET['pexeto_update']) &&  $_GET['pexeto_update']=='true')){ ?>
		<div id="message" class="updated below-h2"><p><strong><?php echo $xml->message; ?></strong> You have version <?php echo $theme_data->Version; ?> installed. Please update to version <?php echo $xml->latest; ?>.</p></div>


		<div id="instructions">

		<div class="two-columns">
		<h3>Automatic Update Instructions</h3>
		<b>Important: </b><i>Please note that with the automatic theme update any code modifications done in the theme's code will be lost, so please
				 make sure you have a backup copy of the theme files before you update the theme. </i>
		<p>In order to use this functionality, you have to:<br/>
		1. Go to <strong>"<?php echo NOTIFIER_THEME_NAME; ?> Options" &raquo; "General" &raquo; "Theme Update"</strong> section and insert your Envato Marketplace username and API Key in the relevant fields. <br/>
	    2. Make sure that the name of the folder that contains the theme files is called "<?php echo NOTIFIER_THEME_SHORTNAME; ?>". This is the default folder name, so if you haven't modified it manually, the name of the folder on your server should be called "<?php echo NOTIFIER_THEME_SHORTNAME; ?>"</p>

		<div id="confirm-update" title="Theme Update">Are you sure you want to update the theme and replace all your current theme files with the new updated files?</div>
		<div id="no-details" title="Almost There">You haven't inserted your Marketplace username and API Key - please go to the <a href="<?php echo admin_url().'admin.php?page=pexeto_options'; ?>"><?php echo NOTIFIER_THEME_NAME; ?> Options</a> page and populate the required data in the "Theme Update" section.</div>
		<a href="" class="button-primary" id="update-btn">Automatically Update Theme</a>
		</div>

			<div class="two-columns no-margin">
		<h3>Manual Update Instructions</h3>
		<p>It is recommended to manually install the update if you have done some modifications to the theme's code. If so, first create
			a backup copy of the current theme you have installed and modified and then you can proceed with installing the update.</p>
		<a id="manual-instructions-btn" class="button-primary">View Update Instructions</a>
		<div id="manual-instructions" title="Manual Update Instructions">
		<p>To download the latest update of the theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>, head over to your <strong>Downloads</strong> section and re-download the theme like you did when you bought it.</p>
		<p>There are two main ways of installing an update manually:</p>
		<ol>
		<li><i><b>By uploading the theme as a new theme (recommended)</b></i>- this is an easier way to accomplish this. You just have to upload
		the updated theme zip file via the built in WordPress theme uploader as a new theme from the Appearance &raquo; Themes &raquo; Install Themes &raquo; Upload section.

		<div class="note_box">
				 <b>Note: </b><i>Please note that with the activating of the new theme it is possible your menu setting not to
				 be saved for the new theme. If so, you just have to go to Appearance &raquo; Menus &raquo; Theme Locations, select the menu (it will be
				 still there) and press the "Save" button</i>.
				</div>
		</li>
		<li><i><b>Via FTP</b></i> - you have to first unzip the zipped theme file and then you can use an FTP client (such as <a href="http://filezilla-project.org/download.php">FileZilla</a>) and replace all the theme files with the
		updated ones.

		<div class="note_box">
				 <b>Note: </b><i>Please note that with the file replacing all the code changes you have made to the files 
				 (if you have made any) will be lost, so please
				 make sure you have a backup copy of the theme files before you do the replacement. All the settings that
				 you have made from the admin panel won't be lost- they will be still available.</i>
				</div>

				</li>
		</ol>
		</div>
	</div>
		<div class="clear"></div>
		<p>For more information about the updates, please refer to the "Updates" section of the documentation included.</p>
		<br />
		</div>
		<?php } ?>
		<div class="icon32 icon32-posts-page" id="icon-edit-pages"><br></div><h2 class="title" id="changes-title">Update Changes</h2>
			<div id="changelog">
		<?php echo $xml->changelog; ?>
		</div>
		</div>
	<?php 
	}
}






// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
if(!function_exists("get_latest_theme_version")){
	function get_latest_theme_version($interval) {
		$transient_id =  NOTIFIER_THEME_SHORTNAME.'_update_data';
		$xml = '';

		$cached_xml = get_transient( $transient_id );

		// check the cache
		if ( !$cached_xml ) {
			// cache doesn't exist, or is old, so refresh it

			$res = wp_remote_get( NOTIFIER_XML_FILE );
			$cache_interval = NOTIFIER_CACHE_INTERVAL;
			$notifier_data = '';

			$is_error = is_wp_error($res);
			if(!$is_error){
				$notifier_data = wp_remote_retrieve_body( $res );
			}

			if ($is_error || strpos( (string)$notifier_data, '<notifier>' ) === false ) {
				//the XML data could not be loaded, set the version back to 1.0 to prevent errors
				$notifier_data = '<?xml version="1.0" encoding="UTF-8"?><notifier><latest>1.0</latest><changelog></changelog></notifier>';
				$cache_interval = HOUR_IN_SECONDS; //set the transient to expire in an hour to try again
			}

			set_transient($transient_id, $notifier_data, $cache_interval);
		}else {
			// cache file is fresh enough, so read from it
			$notifier_data = $cached_xml;
		}

		// Load the remote XML data into a variable and return it
		$xml = simplexml_load_string( $notifier_data );

		return $xml;
	}
}

/*-------------------------------------------------------------
AUTOMATIC UPDATE FUNCTIONALITY
--------------------------------------------------------------*/

add_action('admin_init', 'pexeto_set_update_functionality');

if(!function_exists("pexeto_set_update_functionality")){
	function pexeto_set_update_functionality(){
		if(isset($_GET['pexeto_update']) &&  $_GET['pexeto_update']=='true'){

			$theme_data = wp_get_theme();
			$theme_name = $theme_data->Name;
			$tf_username = get_opt('_tf_username');
			$tf_api_key = get_opt('_tf_api_key');
			$allow_cache=true;
		
			if($tf_username && $tf_api_key){
				global $pexeto_data;

				// include the library
				include_once('envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');

				//cURL is enabled, the Envato Toolkit uses cURL, so the update can be performed
				$upgrader = new Envato_WordPress_Theme_Upgrader( $tf_username, $tf_api_key );
				$upgrader->check_for_theme_update($theme_name, $allow_cache);
				$res = $upgrader->upgrade_theme($theme_name, $allow_cache);
				$success = $res->success;
				$pexeto_data->theme_updated = $success;
			}
		}
	}
}


add_action('admin_notices', 'pexeto_update_notice' );

if(!function_exists("pexeto_update_notice")){
	function pexeto_update_notice(){
		global $pexeto_data;
		$message_type="updated";
		
		if(isset($pexeto_data->theme_updated)){
			if($pexeto_data->theme_updated){
				$message = 'The theme has been updated successfully';
			}else{
				$message = 'An error occurred, the theme has not been updated. Please try again later or install the update manually.';
				$message_type = "error";
			}
		}elseif(isset($pexeto_data->curl_disabled) && $pexeto_data->curl_disabled){
			$message = 'Error: The theme was not updated, because the cURL extension is not enabled on your server. In order to update the theme automatically, the Envato Toolkit Library requires cURL to be enabled on your server. You can contact your hosting provider to enable this extension for you.';
			$message_type = "error";
		}

		if(isset($message)){
			echo '<div class="'.$message_type.'"><p>'.$message.'</p></div>';
		}
	}
}


?>