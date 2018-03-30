<?php

/**
 * Class TMM_Plugin_Update_Checker
 *
 * Checked custom plugins version and changes plugins list table output
 */
class TMM_Plugin_Update_Checker{

	/**
	 * @var array
	 */
	public static $plugins_to_update = array();

	/**
	 * Check plugins versions. Add hooks.
	 * @param $plugins
	 */
	public static function init($plugins) {

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$installed_plugins = get_plugins();

		foreach ( $plugins as $plugin ) {

			$plugin['file_path'] = self::get_plugin_basename_from_slug($plugin['slug']);

			if ( isset( $plugin['version']) && isset( $installed_plugins[$plugin['file_path']]['Version'] ) ) {

				if ( version_compare( $installed_plugins[$plugin['file_path']]['Version'], $plugin['version'], '<' ) ) {

					if ( current_user_can( 'install_plugins' ) && strpos($plugin['source'], 'webtemplatemasters.com') !== false ) {
						$plugin_to_update = new stdClass();
						$plugin_to_update->slug = $plugin['slug'];
						$plugin_to_update->plugin = $plugin['file_path'];
						$plugin_to_update->new_version = $plugin['version'];
						$plugin_to_update->url = '';
						$plugin_to_update->package = $plugin['source'];

						/* for plugins_api filter */
						$plugin_to_update->name = $installed_plugins[$plugin['file_path']]['Name'];
						$plugin_to_update->version = $plugin['version'];
						$plugin_to_update->author = '<a target="_blank" href="'.$installed_plugins[$plugin['file_path']]['AuthorURI'].'">ThemeMakers</a>';
						//$plugin_to_update->homepage = THEMEMAKERS_LINK;
						$plugin_to_update->requires = '';
						$plugin_to_update->tested = '';
						$plugin_to_update->downloaded = 0;
						$plugin_to_update->last_updated = '';
						$plugin_to_update->download_link = $plugin['source'];
						$plugin_to_update->sections = array( 'description' => $installed_plugins[$plugin['file_path']]['Description'] );

						self::$plugins_to_update[$plugin['file_path']] = $plugin_to_update;
					}

				}

			}

		}

		add_filter('plugin_row_meta', array(__CLASS__, 'plugin_row_meta'), 10, 4);
		add_filter('site_transient_update_plugins', array(__CLASS__,'add_plugin_for_update'), 10, 1);
		add_filter('plugins_api', array(__CLASS__, 'set_plugin_info'), 10, 3);
	}

	/**
	 * Extract the file path of the plugin file from the
	 * plugin slug, if the plugin is installed.
	 *
	 * @param string $slug Plugin slug (typically folder name) as provided by the developer.
	 * @return string      Either file path for plugin if installed, or just the plugin slug.
	 */
	protected static function get_plugin_basename_from_slug($slug) {

		$keys = array_keys( get_plugins() );

		foreach ( $keys as $key ) {
			if ( preg_match( '|^' . $slug .'/|', $key ) ) {
				return $key;
			}
		}

		return $slug;
	}

	/**
	 * Add plugins, that needed updates to database. site_transient_update_plugins filter
	 *
	 * @param $updates
	 *
	 * @return StdClass
	 */
	public static function add_plugin_for_update($updates){

		if ( !empty(self::$plugins_to_update) ) {

			if ( !is_object($updates) ) {
				$updates = new StdClass();
			}

			if(!isset($updates->response)) {
				$updates->response = array();
			}

			foreach (self::$plugins_to_update as $key => $value) {
				$response = new stdClass;
				$response->slug = $value->slug;
				$response->plugin = $value->plugin;
				$response->new_version = $value->new_version;
				$response->url = $value->url;
				$response->package = $value->package;

				$updates->response[ $key ] = $response;
			}

		}

		return $updates;
	}

	/**
	 * Set Plugin info
	 *
	 * @access public
	 * @param object $result Result object containing update info
	 * @param string $action WP Updates API action
	 * @param object $args Object containing additional information
	 * @return object $result Result object containing update info
	 */
	public static function set_plugin_info($result, $action, $args) {

		if ( !empty(self::$plugins_to_update) ) {

			foreach (self::$plugins_to_update as $key => $value) {

				if(is_object($value) && !empty($value)) {
					if( $action == 'plugin_information' && isset($args->slug) && $args->slug == $value->slug ) {
						$result = $value;
					}
				}

			}

		}

		return $result;
	}

	/**
	 * Change plugin row links
	 *
	 * @param $meta
	 * @param $plugin_file
	 *
	 * @return mixed
	 */
	public static function plugin_row_meta($meta, $plugin_file) {

		if ( isset(self::$plugins_to_update[$plugin_file]) && strpos(self::$plugins_to_update[$plugin_file]->package, 'webtemplatemasters.com') !== false ) {
			$meta[2] = '<a href="' . THEMEMAKERS_LINK . '" target="_blank">' . __('Visit plugin site', 'cardealer') . '</a>';
		}

		return $meta;
	}

}
