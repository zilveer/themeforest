<?php
/**
 * This is not a plugin! It's just a helper class for your own plugin
 *
 * Include this file only in your own plugins.
 * Use next code to enable auto-updates in your plugins:
 *
 * require_once 'autoupdate-client.php';
 * new AutoUpdate_Client( __FILE__, '1.0.0', 'http://example.com/' );
 *
 * __FILE__ - main plugin file
 * 1.0.0 - current plugin version (actual version, yet not updated)
 * http://example.com/ - URL of your WordPress-driven site with installed AutoUpdate Server plugin
 *
 * Author: Vladimir Anokhin <http://gndev.info/>
 * License: Private
 */
if ( !class_exists( 'AutoUpdate_Client' ) ) {
	class AutoUpdate_Client {

		/**
		 * Plugin file (__FILE__)
		 */
		public $file;

		/**
		 * Current plugin version
		 */
		public $version;

		/**
		 * Autoupdate server URL
		 */
		public $server;

		/**
		 * Extra request keys
		 */
		public $extras;

		/**
		 * Plugin basename
		 */
		public $basename;

		/**
		 * Plugin slug
		 */
		public $slug;

		/**
		 * Init class
		 */
		function __construct( $file, $version, $server, $slug = false, $extras = array() ) {
			// Setup public vars
			$this->file      = $file;
			$this->version   = $version;
			$this->server    = $server;
			$this->basename  = plugin_basename( $file );
			$this->slug      = ( $slug ) ? $slug : basename( $this->basename, '.php' );
			$this->extras    = $extras;
			// Plugins update filter
			add_filter( 'pre_set_site_transient_update_plugins', array( &$this, 'add_update' ) );
			// Plugins API filter
			add_filter( 'plugins_api', array( &$this, 'add_info' ), 10, 3 );
		}

		/**
		 * Add plugin update
		 */
		public function add_update( $transient ) {
			// Check response, update already injected
			if ( isset( $transient->response[$this->basename] ) ) return $transient;
			// Get update info
			$update = $this->get_update();
			// Check update data
			if ( !$update || !is_array( $transient->response ) ) return $transient;
			// If a newer version is available, inject the update
			if ( version_compare( $this->version, $update->version, '<' ) )
				$transient->response[$this->basename] = $update;
			return $transient;
		}

		/**
		 * Add plugin info
		 */
		public function add_info( $result, $action = null, $args = null ) {
			$info = ( $action === 'plugin_information' && isset( $args->slug ) && $args->slug === $this->slug ) ? $this->get_update() : false;
			return ( $info ) ? $info : $result;
		}

		/**
		 * Retrieve plugin remote info
		 */
		public function get_update() {
			// Default value
			$data = false;
			// Perform request
			$request = wp_remote_post( $this->server, array( // TODO: add extra keys to the request
					'body' => array(
						'aus_action' => 'get_info',
						'aus_slug'   => $this->slug,
						'aus_extras' => $this->extras
					),
					'user-agent' => 'WordPress/' . __CLASS__
				) );
			// Check request and it's response
			if ( !is_wp_error( $request )
				&& wp_remote_retrieve_response_code( $request ) === 200
				&& strpos( $request['body'], 'Ok: ' ) === 0 ) {
				$data = str_replace( 'Ok: ', '', $request['body'] );
				$data = base64_decode( $data );
				$data = maybe_unserialize( $data );
			}
			return $data;
		}

	}
}
