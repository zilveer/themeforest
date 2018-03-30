<?php
/**
 * Update notifier:
 * - adds notices to the menus and admin bar when an update is avialable
 * - creates an update page that contains update instructions, changelog and
 * option to automatically update the theme. The automatic theme update
 * uses the Envato Toolkit Library.
 * This class partially contains some code from the Joao Araujo's update
 * notifier : Profile: http://themeforest.net/user/unisphere
 */
class PexetoUpdateNotifier {

	protected $theme_name = '';
	protected $short_name = '';
	protected $xml_url = '';
	protected $cache_interval = 21600;
	protected $update_page_name = '';
	protected $options_url = '';
	protected $transient_id;
	public $current_version = '1.0.0';
	const NONCE = 'pexeto_update_nonce';
	const ENVATO_LIB_PATH = 'envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php';
	const UPDATE_ATTRIBUTE = 'pexeto_update';

	/**
	 * Main constructor.
	 *
	 * @param srting  $theme_name       the theme name
	 * @param srting  $short_name       short theme name
	 * @param srting  $xml_url          the URL of the XML file that will contain the latest version and changelog
	 * @param int     $cache_interval   cache interval in milliseconds - the time the XML data will be cached
	 * @param srting  $update_page_name the name of the update page
	 * @param string  $options_url      the URL of the theme options page
	 */
	function __construct( $theme_name, $short_name, $xml_url, $cache_interval, $update_page_name, $options_url ) {
		$this->theme_name = $theme_name;
		$this->short_name = $short_name;
		$this->xml_url = $xml_url;
		$this->cache_interval = $cache_interval;
		$this->update_page_name = $update_page_name;
		$this->options_url = $options_url;
		$this->transient_id = $this->short_name.'_update_data';
	}

	/**
	 * Inits the main update functionality, adds the actions.
	 */
	public function init() {
		$theme_data = wp_get_theme($this->short_name);
		if(!$theme_data->Version){
			$theme_data = wp_get_theme();
		}
		$this->current_version = $theme_data->Version;

		//add the actions
		add_action( 'admin_menu', array( &$this, 'add_menu_noification' ) );
		add_action( 'admin_bar_menu', array( &$this, 'add_admin_bar_noification' ), 1000 );
		if ( isset( $_GET['page'] ) && $_GET['page']==$this->update_page_name ) {
			add_action( 'admin_init', array( &$this, 'init_update_functionality' ) );
			add_action( 'admin_notices', array( &$this, 'add_update_notices' ) );
		}
	}

	/**
	 * Adds an update notification to the WordPress Dashboard menu.
	 */
	public function add_menu_noification() {
		if ( function_exists( 'simplexml_load_string' ) ) { // Stop if simplexml_load_string funtion isn't available
			if ( $this->is_new_version_available() ) {
				$count = ( isset( $_GET[self::UPDATE_ATTRIBUTE] ) &&  $_GET[self::UPDATE_ATTRIBUTE]=='true' )?'':'<span class="update-plugins count-1"><span class="update-count">1</span></span>';
				add_dashboard_page( $this->theme_name . ' Theme Updates', $this->theme_name . ' Update '.$count, 'administrator', $this->update_page_name, array( &$this, "print_update_page" ) );
			}
		}
	}

	/**
	 * Adds an update notification to the WordPress 3.1+ Admin Bar.
	 */
	public function add_admin_bar_noification() {
		if ( function_exists( 'simplexml_load_string' ) ) { // Stop if simplexml_load_string funtion isn't available
			global $wp_admin_bar, $wpdb;

			if ( !is_super_admin() || !is_admin_bar_showing() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
				return;

			if ( $this->is_new_version_available() ) { // Compare current theme version with the remote XML version
				$wp_admin_bar->add_menu( array( 'id' => 'pexeto_update_notifier', 'title' => '<span>' . $this->theme_name . ' <span id="ab-updates">New Updates</span></span>', 'href' => get_admin_url() . 'index.php?page='.$this->update_page_name ) );
			}
		}
	}

	/**
	 * Checks if a new version of the theme is available.
	 *
	 * @return boolean true if a new version is available and false if there isn't a new version available
	 */
	public function is_new_version_available() {
		if ( !isset( $this->new_available ) ) {
			$xml = $this->get_update_xml(); // Get the latest remote XML file on our server
			$this->new_available = $this->is_version_newer( $this->current_version, $xml->latest );
		}
		return $this->new_available;
	}

	/**
	 * Compares between two versions if one of them is newer.
	 *
	 * @param [type]  $current_ver the current version
	 * @param [type]  $latest_ver  the latest version
	 * @return boolean true if $latest_ver is newer than $current_ver and false in all other cases
	 */
	public function is_version_newer( $current_ver, $latest_ver ) {
		$latest = explode( '.', $latest_ver );
		$current= explode( '.', $current_ver );
		$new_available=false;
		for ( $i=0; $i<sizeof( $latest ); $i++ ) {
			if ( (int)$current[$i]<(int)$latest[$i] ) {
				$new_available=true;
				break;
			}elseif ( (int)$current[$i]>(int)$latest[$i] ) {
				$new_available=false;
				break;
			}
		}

		return $new_available;
	}

	/**
	 * Get the remote XML file contents and return its data (Version and Changelog).
	 * Uses the cached version if available and inside the time interval defined.
	 *
	 * @return XML object containing the parsed XML data
	 */
	public function get_update_xml() {
		if ( !isset( $this->xml ) ) {
			$cached_xml = get_transient( $this->transient_id );

			// check the cache
			if ( !$cached_xml ) {
				// cache doesn't exist, or is old, so refresh it

				$res = wp_remote_get( $this->xml_url );
				$cache_interval = $this->cache_interval;
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

				set_transient($this->transient_id, $notifier_data, $cache_interval);
			}else {
				// cache file is fresh enough, so read from it
				$notifier_data = $cached_xml;
			}

			// Load the remote XML data into a variable and return it
			$this->xml = simplexml_load_string( $notifier_data );
		}

		return $this->xml;
	}


	/**
	 * Inits the update functionality. If update is set, validates all the requirements:
	 * - user role must be super admin
	 * - nonce field must verify
	 * - cUrl must be enabled
	 * - the Envato API username and key must be set
	 * and if all the requirements are met, updates the theme.
	 * It sets the protected properties:
	 * $this->theme_updated - will be true if the theme is updated successfully and false in all other cases.
	 * $this->message - will contain an error message if there is an error.
	 */
	public function init_update_functionality() {

		if ( isset( $_GET[self::UPDATE_ATTRIBUTE] ) &&  $_GET[self::UPDATE_ATTRIBUTE]=='true' ) {
			$this->theme_updated = false;

			//test the user capability
			if ( !is_super_admin() ) {
				$this->update_message = 'Error: You are not allowed to update the
				theme with this user role. Please login as super admin to update the theme.';
				return;
			}

			//test the nonce
			$nonce=$_GET[self::NONCE];
			if ( !wp_verify_nonce( $nonce, self::NONCE ) ) {
				$this->update_message = 'Error: Your nonce did not verify. Please
				re-open this page and try again.';
				return;
			}

			//test if cURL is enabled - the Envato Toolkit uses cURL, so the update can be performed
			if ( !in_array( 'curl', get_loaded_extensions() ) ) {
				$this->update_message = 'Error: The theme was not updated, because the cURL extension is not
				enabled on your server. In order to update the theme automatically, the Envato
				Toolkit Library requires cURL to be enabled on your server. You can contact your
				hosting provider to enable this extension for you.';
				return;
			}

			$tf_username = pexeto_option( 'tf_username' );
			$tf_api_key = pexeto_option( 'tf_api_key' );

			if ( !$tf_username || !$tf_api_key ) {
				$this->update_message = $this->get_empty_details_message();
				return;
			}

			// include the library
			include_once get_template_directory().'/'.self::ENVATO_LIB_PATH;

			//update the theme
			$allow_cache=true;

			$upgrader = new Envato_WordPress_Theme_Upgrader( $tf_username, $tf_api_key );
			$upgrader->check_for_theme_update($this->theme_name, $allow_cache);
			$res = $upgrader->upgrade_theme($this->theme_name, $allow_cache);
			$success = $res->success;
			$this->theme_updated = $success;
		}
	}


	/**
	 * Adds an update message to the standard admin notices if there is a message set.
	 * Requires the $this->theme_updated to be set to true or false and if it is set to false
	 * (meaning that the update was not successful), it uses the global $this->update_message to display the message.
	 */
	public function add_update_notices() {
		$message_type="updated";

		if ( isset( $this->theme_updated ) ) {
			if ( $this->theme_updated ) {
				$message = 'The theme has been updated successfully';
			}else {
				$message = $this->update_message? $this->update_message : 'An error occurred, the theme has not
				been updated. Please try again later or install the update manually.';
				$message_type = "error";
			}
		}

		if ( isset( $message ) ) {
			echo '<div class="'.$message_type.'"><p>'.$message.'</p></div>';
		}

		if ( isset( $this->a ) ) {
			echo $this->a;
		}
	}

	public function print_update_notification_message( $add_link = false ) {
		$xml = $this->get_update_xml();
		$message = '<div id="message" class="updated below-h2"><p><strong>'.$xml->message
			.'</strong> You have version '.$this->current_version.' installed. Please ';
		if ( $add_link ) {
			$message.= '<a href="'.admin_url( 'index.php?page='.$this->update_page_name ).'">';
		}
		$message .= 'update to version '. $xml->latest;
		if ( $add_link ) {
			$message.= '</a>';
		}
		$message .='.</p></div>';
		echo $message;
	}


	/**
	 * Prints the update page containing instructions, update changelog and an option to update the theme automatically.
	 */
	public function print_update_page() {
		$xml = $this->get_update_xml();

		echo '<div class="wrap">
		<div id="icon-tools" class="icon32"></div>
		<h2>'.$this->theme_name.'Theme Updates</h2>';

		if ( !( isset( $_GET[self::UPDATE_ATTRIBUTE] ) &&  $_GET[self::UPDATE_ATTRIBUTE]=='true' ) ) {
			$this->print_update_notification_message();
			$this->print_instructions();
		}

		//print the changelog
		echo '<div class="icon32 icon32-posts-page" id="icon-edit-pages"><br></div><h2 class="title" id="changes-title">Update Changes</h2>
		<div id="changelog">'.$xml->changelog.'</div></div>';

	}

	/**
	 * Prints the update instructions including the option links to update the theme automatically.
	 */
	protected function print_instructions() {
		$nonce = wp_create_nonce( self::NONCE );
		$update_url= admin_url( 'index.php?page='.$this->update_page_name.'&'.self::UPDATE_ATTRIBUTE.'=true&'.self::NONCE.'='.$nonce );
		$envato_details = ( pexeto_option( 'tf_username' ) && pexeto_option( 'tf_api_key' ) )?"true":"false";


		echo '
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			var optionsLink = "'.$update_url.'",
				envatoDetails = '.$envato_details.',
				notifier = new UpdateNotifier(optionsLink, envatoDetails);
			notifier.init();
		});
		</script>

		<div id="instructions">
			<div class="two-columns">
				<h3>Automatic Update Instructions</h3>
				<b>Important: </b><i>Please note that with the automatic theme update any code modifications done in the theme\'s code will be lost, so please
						 make sure you have a backup copy of the theme files before you update the theme. </i>
				<p>In order to use this functionality, you have to:<br/>
				1. Go to <strong>"'.$this->theme_name.' Options" &raquo; "General" &raquo; "Theme Update"</strong> section and insert your Envato Marketplace username and API Key in the relevant fields. <br/>
			    2. Make sure that the name of the folder that contains the theme files is called "'.$this->short_name.'". This is the default folder name, so if you haven\'t modified it manually, the name of the folder on your server should be called "'. $this->short_name.'"</p>

				<div id="confirm-update" title="Theme Update">Are you sure you want to update the theme and replace all your current theme files with the new updated files?</div>
				<div id="no-details" title="Almost There">'.$this->get_empty_details_message().'</div>
				<a href="" class="button-primary" id="update-btn">Automatically Update Theme</a>
			</div>

			<div class="two-columns no-margin">
				<h3>Manual Update Instructions</h3>
				<p>It is recommended to manually install the update if you have done some modifications to the theme\'s code. If so, first create
					a backup copy of the current theme you have installed and modified and then you can proceed with installing the update.</p>
				<a id="manual-instructions-btn" class="button-primary">View Update Instructions</a>
				<div id="manual-instructions" title="Manual Update Instructions">
					<p>To download the latest update of the theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>, head over to your <strong>Downloads</strong> section and re-download the theme like you did when you bought it.</p>
					<p>You have to first unzip the zipped theme file and then you can use an FTP client (such as <a href="http://filezilla-project.org/download.php">FileZilla</a>) and replace all the theme files with the
					updated ones.

					<div class="note_box">
						 <b>Note: </b><i>Please note that with the file replacing all the code changes you have made to the files
						 (if you have made any) will be lost, so please
						 make sure you have a backup copy of the theme files before you do the replacement. All the settings that
						 you have made from the admin panel won\'t be lost- they will be still available.</i>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<p>For more information about the updates, please refer to the "Updates" section of the documentation included.</p>
			<br />
		</div>';
	}

	/**
	 * Returns the message that will be displayed when the Envato API username and key are not inserted.
	 *
	 * @return string the error message
	 */
	protected function get_empty_details_message() {
		return 'You haven\'t inserted your Marketplace username and API Key - please go to the
		<a href="'.$this->options_url.'">'.$this->theme_name .' Options</a> page
		 and populate the required data in the "Theme Update" section.';
	}

}
