<?php if(! defined('ABSPATH')){ return; }

class ZnAddonsManager{

	/**
	 * @var ZnAddonsManager The single instance of the class
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	var $plugins = array();

	/**
	 * Main ZnAddonsManager Instance
	 *
	 * Ensures only one instance of ZnAddonsManager is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see ZnAddonsManager()
	 * @return ZnAddonsManager - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Main class constructor
	 */
	function __construct(){
		// Don't do anything if we don't have a config file
		if( file_exists( THEME_BASE .'/template_helpers/plugins/config.php' ) ) {
			// include the config file
			include THEME_BASE .'/template_helpers/plugins/config.php';
			if( is_array( $plugins ) ){
				foreach ( $plugins as $plugin ) {
					$this->register( $plugin );
				}
			}

			// Register Ajax actions
			add_action('wp_ajax_zn_do_plugin_action', array( &$this, 'zn_do_plugin_action' ) );

		}

		do_action( 'znfw_addons_manager_init' );
	}

	public function zn_do_plugin_action(){
		check_ajax_referer( 'zn_plugins_nonce', 'security' );

		$action		= !empty( $_POST['plugin_action'] ) ? $_POST['plugin_action'] 	: false;
		$slug		= !empty( $_POST['slug'] ) 			? $_POST['slug'] 			: false;

		// Perform plugin actions here
		switch ( $action ) {
			case 'enable_plugin':
				$this->_do_plugin_activate( $slug );
				break;
			case 'install_plugin':
				$credentials = !empty( $_POST['credentials'] ) ? $_POST['credentials'] : false;
				$this->_do_plugin_install( $slug, $credentials );

				break;
			case 'disable_plugin':
				$this->do_plugin_deactivate( $slug );
				break;
			case 'update_plugin':
				$this->do_plugin_update( $slug );
				break;
			case 'enable_child_theme':
				$this->enable_child_theme( $slug );
				break;
			case 'install_theme':
				$this->install_child_theme( $slug );
				break;
			default:
				# code...
				break;
		}

	}

	/**
	 * Performs the plugin update
	 * @param  [type] $slug [description]
	 * @return [type]       [description]
	 */
	function do_plugin_update( $slug ){
		if( empty( $this->plugins[$slug] ) ){
			$status['error'] = 'We have no data about this plugin.';
			wp_send_json_error( $status );
		}

		if( $this->plugin_has_update( $slug ) ){
			if ( ! class_exists( 'Plugin_Upgrader', false ) ) {
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			}

			$upgrader = new Plugin_Upgrader( new Automatic_Upgrader_Skin() );
			// Inject our info into the update transient.
			$source        				= $this->get_download_url( $slug );
			$to_inject                    = array( $slug => $this->plugins[ $slug ] );
			$to_inject[ $slug ]['source'] = $source;
			$this->inject_update_info( $to_inject );
			$result = $upgrader->upgrade( $this->plugins[ $slug ]['file_path']  );

			if ( is_wp_error( $result ) ) {
				$status['error'] = $result->get_error_message();
				wp_send_json_error( $status );
			}

			// Return the status of the plugin
			$status = $this->get_plugin_status( $slug );
			wp_send_json_success( $status );
		}

		$status['error'] = 'The plugin doesn\'t have an update.';
		wp_send_json_error( $status );

	}

	/**
	 * Enable a child theme
	 * @param  string $slug The slug used in the addons config file for the child theme
	 * @return string A json formatted value
	 */
	function enable_child_theme( $slug ){

		$status = $this->get_plugin_status( $slug );

		// Get all installed themes
		$current_installed_themes = wp_get_themes();
		// Get the zn themes currently installed
		$active_theme = wp_get_theme();
		$theme_folder_name = $active_theme->get_template();

		$child_theme = false;

		if( is_array( $current_installed_themes ) ){
			foreach ($current_installed_themes as $key => $theme_obj) {
				if( $theme_obj->get('Template') === $theme_folder_name ){
					$child_theme = $theme_obj;
				}
			}
		}

		if( $child_theme !== false ){
			switch_theme( $child_theme->get_stylesheet() );
			$status = $this->get_plugin_status( $slug );
		}

		wp_send_json_success( $status );
	}

	function install_child_theme( $slug ){
		if( empty( $this->plugins[$slug] ) ){
			wp_send_json_error( array( 'error' => 'We don\'t know anything about this theme' ) );
		}

		$url = $this->get_download_url( $slug );
		$status = $this->get_plugin_status( $slug );

		if( ! current_user_can( 'install_themes' ) ){
			$status['error'] = 'You don\'t have permissions to install install_themes';
			wp_send_json_error( array( 'error' => '' ) );
		}

		if ( ! class_exists( 'Theme_Upgrader', false ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		$skin = new Automatic_Upgrader_Skin();
		$upgrader = new Theme_Upgrader( $skin, array( 'clear_destination' => true ) );
		$result = $upgrader->install( $url );

		// There is a bug in WP where the install method can return null in case the folder already exists
		// see https://core.trac.wordpress.org/ticket/27365
		if( $result === null && ! empty( $skin->result ) ){
			$result = $skin->result;
		}

		if ( is_wp_error( $skin->result ) ) {
			$status['error'] = $result->get_error_message();
			 wp_send_json_error( $status );
		}

		$status = $this->get_plugin_status( $slug );
		wp_send_json_success( $status );
	}

	/**
	 * Will check if a child theme is installed for the current theme
	 * @return boolean true/false if a child theme is installed or not
	 */
	function is_child_theme_installed(){

		// Get all installed themes
		$current_installed_themes = wp_get_themes();
		// Get the zn themes currently installed
		$active_theme = wp_get_theme();
		$theme_folder_name = $active_theme->get_template();

		if( is_array( $current_installed_themes ) ){
			foreach ($current_installed_themes as $key => $theme_obj) {
				if( $theme_obj->get('Template') === $theme_folder_name ){
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Checks if a child theme is active or not
	 * @return boolean If the child theme is in use
	 */
	function is_child_theme_active(){
		$active_theme = wp_get_theme();
		$template = $active_theme->get('Template');
		return ! empty( $template );
	}

	function get_addon_config( $plugin_slug ){
		if( ! empty( $this->plugins[ $plugin_slug ] ) ){
			return $this->plugins[ $plugin_slug ];
		}
	}

	/**
	 * Returns the status and actions for a plugin
	 * @param  string $plugin_slug The plugin slug
	 * @return array  The status and actions for the requested plugin
	 */
	function get_plugin_status( $plugin_slug ){

		$status = array();
		$plugin_config = $this->get_addon_config( $plugin_slug );
		if( isset( $plugin_config['addon_type'] ) && $plugin_config['addon_type'] === 'child_theme' ){
			// We have a theme
			if( $this->is_child_theme_installed( $plugin_config ) ){
				// Check if the theme is active or not
				if ( $this->is_child_theme_active( $plugin_slug ) ) {
					$status['status']      = 'zn-active zn-addons-disabled';
					$status['status_text'] = __( 'Active', 'zn_framework');
					$status['action_text'] = __( 'Child theme is installed and active', 'zn_framework');
					$status['action']      = 'no_action';
				} else  {
					$status['status']      = 'zn-inactive';
					$status['status_text'] = __( 'Inctive', 'zn_framework');
					$status['action_text'] = __( 'Activate child theme', 'zn_framework');
					$status['action']      = 'enable_child_theme';
				}
			}
			else{
				$status['status']      = 'zn-needs-install';
				$status['status_text'] = __( 'Not isntalled', 'zn_framework');
				$status['action_text'] = __( 'Install child theme', 'zn_framework');
				$status['action']      = 'install_theme';

				if( ! current_user_can( 'install_themes' ) ){
					$status['status']         = 'zn-not-installed zn-addons-disabled';
					$status['action_text']    = __( 'You don\'t have permission to install child themes. Contact site administrator.', 'zn_framework');
					$status['action']         = 'contact_network_admin';
				}

			}
		}
		else{
			if( $this->is_plugin_installed( $plugin_slug ) ){
				if( $this->does_plugin_have_update( $plugin_slug ) ){
					$status['status']         = 'zn-has-update';
					$status['status_text'] = __( 'Needs update', 'zn_framework');
					$status['action_text']           = __( 'Update plugin', 'zn_framework');
					$status['action']         = 'update_plugin';
				}
				elseif ( $this->is_plugin_active( $plugin_slug ) ) {
					$status['status']         = 'zn-active';
					$status['status_text'] = __( 'Active', 'zn_framework');
					$status['action_text']           = __( 'Deactivate plugin', 'zn_framework');
					$status['action']         = 'disable_plugin';
				} else  {
					$status['status']         = 'zn-inactive';
					$status['status_text'] = __( 'Inctive', 'zn_framework');
					$status['action_text']           = __( 'Activate plugin', 'zn_framework');
					$status['action']         = 'enable_plugin';
				}
			}
			else{
				$status['status']         = 'zn-not-installed';
				$status['status_text'] = __( 'Not Installed', 'zn_framework');
				$status['action_text']           = __( 'Install plugin', 'zn_framework');
				$status['action']         = 'install_plugin';

				if( ! current_user_can( 'install_plugins' ) ){
					$status['status']         = 'zn-not-installed zn-addons-disabled';
					$status['action_text']    = __( 'You don\'t have permission to install plugins. Contact site administrator.', 'zn_framework');
					$status['action']         = 'contact_network_admin';
				}

			}
		}


		return $status;
	}

	/**
	 * Inject information into the 'update_plugins' site transient as WP checks that before running an update.
	 *
	 * @since 1.0.0
	 *
	 * @param array $plugins The plugin information for the plugins which are to be updated.
	 */
	public function inject_update_info( $plugins ) {
		$repo_updates = get_site_transient( 'update_plugins' );
		if ( ! is_object( $repo_updates ) ) {
			$repo_updates = new stdClass;
		}
		foreach ( $plugins as $slug => $plugin ) {
			$file_path = $plugin['file_path'];
			if ( empty( $repo_updates->response[ $file_path ] ) ) {
				$repo_updates->response[ $file_path ] = new stdClass;
			}
			// We only really need to set package, but let's do all we can in case WP changes something.
			$repo_updates->response[ $file_path ]->slug        = $slug;
			$repo_updates->response[ $file_path ]->plugin      = $file_path;
			$repo_updates->response[ $file_path ]->new_version = $plugin['version'];
			$repo_updates->response[ $file_path ]->package     = $plugin['source'];
			if ( empty( $repo_updates->response[ $file_path ]->url ) && ! empty( $plugin['external_url'] ) ) {
				$repo_updates->response[ $file_path ]->url = $plugin['external_url'];
			}
		}

		set_site_transient( 'update_plugins', $repo_updates );
	}

	/**
	 * Performs plugin update
	 * @return type
	 */
	function plugin_has_update( $slug ){
		if( empty( $this->plugins[$slug] ) ){
			return false;
		}

		$installed_version = $this->get_installed_version( $slug );
		$minimum_version   = $this->plugins[ $slug ]['version'];

		return version_compare( $minimum_version, $installed_version, '>' );

	}

	function _do_plugin_install( $slug, $saved_credentials = false ){
		$result = $this->do_plugin_install( $slug, $saved_credentials = false );
		if( is_array( $result ) && ! empty( $result['error'] ) ){
			wp_send_json_error( $result );
		}
		wp_send_json_success( $result );
	}

	/**
	 * Performs plugins installation
	 * @return type
	 */
	function do_plugin_install( $slug, $saved_credentials = false ){
		if( empty( $this->plugins[$slug] ) ){
			return false;
		}

		$url = $this->get_download_url( $slug );
		$status = $this->get_plugin_status( $slug );

		if( ! current_user_can( 'install_plugins' ) ){
			$status['error'] = 'You don\'t have permissions to install plugins';
			return $status;
		}

		if ( ! class_exists( 'Plugin_Upgrader', false ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		$skin = new Automatic_Upgrader_Skin();
		$upgrader = new Plugin_Upgrader( $skin, array( 'clear_destination' => true ) );
		$result = $upgrader->install( $url );

		// There is a bug in WP where the install method can return null in case the folder already exists
		// see https://core.trac.wordpress.org/ticket/27365
		if( $result === null && ! empty( $skin->result ) ){
			$result = $skin->result;
		}

		if ( is_wp_error( $skin->result ) ) {
			$status['error'] = $result->get_error_message();
			return $status;
		}

		$plugin_activation = $this->do_plugin_activate( $slug );
		return $this->get_plugin_status( $slug );

	}


	/**
	 * Performs a plugin dezactivation
	 * @return type
	 */
	function do_plugin_deactivate( $slug ){

		$status = $this->get_plugin_status( $slug );

		if( empty( $this->plugins[$slug] ) ){
			$status['error'] = 'We have no data about this plugin.';
			 wp_send_json_error( $status );
		}

		deactivate_plugins( $this->plugins[$slug]['zn_plugin'] );

		$status = $this->get_plugin_status( $slug );
		wp_send_json_success( $status );

	}

	/**
	 * Will try activate a plugin
	 * Should be used in ajax calls
	 * @return json the plugin activation result
	 */
	function _do_plugin_activate(){
		$result = $this->do_plugin_activate( $slug, $saved_credentials = false );
		if( is_array( $result ) && ! empty( $result['error'] ) ){
			wp_send_json_error( $result );
		}
		wp_send_json_success( $result );
	}

	/**
	 * Performs plugins activation.
	 * @param string $slug
	 * @return bool|string
	 */
	function do_plugin_activate( $slug ){

		$status = $this->get_plugin_status( $slug );

		if( empty( $this->plugins[$slug] ) ){
			$status['error'] = 'We have no data about this plugin.';
			return $status;
		}

		$result = activate_plugin( $this->plugins[$slug]['zn_plugin'] );
		if ( is_wp_error( $result ) ) {
			$status['error'] = $result->get_error_message();
			return $status;
		}

		return $this->get_plugin_status( $slug );
	}

	/**
	 * Returns the install url for the current plugin
	 * @param type $slug
	 * @return type
	 */
	public function get_download_url( $slug ) {
		$dl_source = '';

		switch ( $this->plugins[ $slug ]['source_type'] ) {
			case 'repo':
				return $this->get_wp_repo_download_url( $slug );
			case 'external':
				return $this->plugins[ $slug ]['source'];
		}

		return $dl_source; // Should never happen.
	}

	function get_wp_repo_download_url( $slug ){
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' ); // for plugins_api..
		$api = plugins_api('plugin_information', array('slug' => $slug, 'fields' => array('sections' => false) ) ); //Save on a bit of bandwidth.
		if ( is_wp_error( $api ) ) {
			 $status['error'] = $api->get_error_message();
			 wp_send_json_error( $status );
		 }

		 return $api->download_link;
	}


	/**
	 * Check if a plugin is installed. Does not take must-use plugins into account.
	 *
	 * @since 1.0.0
	 *
	 * @param string $slug Plugin slug.
	 * @return bool True if installed, false otherwise.
	 */
	public function is_plugin_installed( $slug ) {
		$installed_plugins = $this->get_plugins(); // Retrieve a list of all installed plugins (WP cached).

		return ( ! empty( $installed_plugins[ $this->plugins[ $slug ]['file_path'] ] ) );
	}

	/**
	 * Check whether a plugin complies with the minimum version requirements.
	 *
	 * @since 1.0.0
	 *
	 * @param string $slug Plugin slug.
	 * @return bool True when a plugin needs to be updated, otherwise false.
	 */
	public function does_plugin_require_update( $slug ) {
		$installed_version = $this->get_installed_version( $slug );
		$minimum_version   = $this->plugins[ $slug ]['version'];

		return version_compare( $minimum_version, $installed_version, '>' );
	}

	/**
	 * Check whether there is an update available for a plugin.
	 *
	 * @since 1.0.0
	 *
	 * @param string $slug Plugin slug.
	 * @return false|string Version number string of the available update or false if no update available.
	 */
	public function does_plugin_have_update( $slug ) {
		// Presume bundled and external plugins will point to a package which meets the minimum required version.
		if ( 'repo' !== $this->plugins[ $slug ]['source_type'] ) {
			if ( $this->does_plugin_require_update( $slug ) ) {
				return $this->plugins[ $slug ]['version'];
			}

			return false;
		}

		$repo_updates = get_site_transient( 'update_plugins' );

		if ( isset( $repo_updates->response[ $this->plugins[ $slug ]['file_path'] ]->new_version ) ) {
			return $repo_updates->response[ $this->plugins[ $slug ]['file_path'] ]->new_version;
		}

		return false;
	}

	/**
	 * Check if a plugin is active.
	 *
	 * @since 1.0.0
	 *
	 * @param string $slug Plugin slug.
	 * @return bool True if active, false otherwise.
	 */
	public function is_plugin_active( $slug ) {
		return ( ( ! empty( $this->plugins[ $slug ]['is_callable'] ) && is_callable( $this->plugins[ $slug ]['is_callable'] ) ) || is_plugin_active( $this->plugins[ $slug ]['file_path'] ) );
	}

	/**
	 * Retrieve the version number of an installed plugin.
	 *
	 * @since 1.0.0
	 *
	 * @param string $slug Plugin slug.
	 * @return string Version number as string or an empty string if the plugin is not installed
	 *                or version unknown (plugins which don't comply with the plugin header standard).
	 */
	public function get_installed_version( $slug ) {
		$installed_plugins = $this->get_plugins(); // Retrieve a list of all installed plugins (WP cached).

		if ( ! empty( $installed_plugins[ $this->plugins[ $slug ]['file_path'] ]['Version'] ) ) {
			return $installed_plugins[ $this->plugins[ $slug ]['file_path'] ]['Version'];
		}

		return '';
	}

	/**
	 * Wrapper around the core WP get_plugins function, making sure it's actually available.
	 *
	 * @since 1.0.0
	 *
	 * @param string $plugin_folder Optional. Relative path to single plugin folder.
	 * @return array Array of installed plugins with plugin information.
	 */
	public function get_plugins( $plugin_folder = '' ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return get_plugins( $plugin_folder );
	}

	/**
	 * Registers a plugin
	 * @return null
	 */
	private function register( $plugin ){
		if ( empty( $plugin['slug'] ) || ! is_string( $plugin['slug'] ) || isset( $this->plugins[ $plugin['slug'] ] ) ) {
			return;
		}

		$defaults = array(
			'name'               => '',      // String
			'slug'               => '',      // String
			'source'             => 'repo',  // Can be 'repo', 'local', 'custom url'
			'source_type'        => 'repo',  // Can be 'repo', 'local', 'custom url'
			'required'           => false,   // Boolean
			'version'            => '',      // String
			'external_url'       => '',      // String
			'z_plugin_icon'       => '',      // String
			'z_plugin_author'       => '',      // String
			'z_plugin_description'       => '',      // String
			'zn_plugin'       => '',      // String
			'addon_type'       => 'plugin',      // String
		);

		// Prepare the received data.
		$plugin = wp_parse_args( $plugin, $defaults );

		// Forgive users for using string versions of booleans or floats for version number.
		$plugin['version']            = (string) $plugin['version'];
		$plugin['source']             = empty( $plugin['source'] ) ? 'repo' : $plugin['source'];
		$plugin['required']           = $plugin['required'];

		// Enrich the received data.
		$plugin['file_path']   = $plugin['zn_plugin'];

		// Set the class properties.
		$this->plugins[ $plugin['slug'] ]    = $plugin;
	}

}

/**
 * Shortcut to ZnAddonsManager class
 */
function ZnAddonsManager(){
	return ZnAddonsManager::instance();
}

ZnAddonsManager();
