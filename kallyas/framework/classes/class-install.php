<?php if(! defined('ABSPATH')){ return; }
/**
 * Installation related functions and actions.
 *
 * @author 		ThemeFuzz
 * @category 	Admin
 * @package 	ZnFramework/Classes
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Zn_Install Class
 */
class Zn_Install {

	/**
	 * Holds information about the current version of the theme
	 */
	private $theme_version;

	/**
	 * Holds information about the previous version of the theme
	 */
	private $theme_version_string;

	/**
	 * Holds information about the Convert updates that are available to be processed
	 */
	private $db_updates = array();

	/**
	 * Holds information about the normal updates that needs to be processed
	 */
	private $normal_updates = array();

	/**
	 * Main constructor
	 */
	function __construct(){

		$theme_name = 'zn_'.ZN()->theme_data['theme_id'];
		$this->theme_version = ZN()->version;
		$this->theme_version_string = $theme_name.'_version';

		// Load Updater scripts
		$update_config = THEME_BASE .'/template_helpers/update/update_config.php';
		if( file_exists( $update_config ) ){
			require( $update_config );
			$this->db_updates = apply_filters( 'zn_theme_update_scripts', array() );
			$this->normal_updates = apply_filters( 'zn_theme_normal_update_scripts', array() );
		}

		// Set this action to 5 so we can load the about page at a higher priority
		add_action( 'admin_init', array( $this, 'check_version' ), 5 );
	}

	/**
	 * Checks if this a theme update or a new installation
	 * @return type
	 */
	public function check_version(){

		// Check if we need to load an updater script
		$current_theme_version	= get_option( $this->theme_version_string );
		$saved_options 			= get_option( ZN()->theme_data['options_prefix'] );

		// Check if this is a new theme install
		if( empty( $saved_options ) ){
			// This is a new theme install
			$this->do_theme_activation();
		}
		else{
			// Check if we need a DB update
			if ( $current_theme_version != ZN()->version ){

				// Check if we need to perform a DB update
				foreach ( $this->db_updates as $version => $updater ) {
					if ( version_compare( $current_theme_version, $version, '<' ) ) {
						update_option( 'zn_theme_needs_update', $current_theme_version, false );
					}
				}

				// Perform the normal updates
				foreach ( $this->normal_updates as $version => $updater ) {

					if ( version_compare( $current_theme_version, $version, '<' ) ) {
						if( function_exists( $updater['function'] ) ){
							call_user_func( $updater['function'] );
						}
					}

				}

				// Call a general update action
				if ( version_compare( $current_theme_version, ZN()->version, '<' ) ) {
					// TODO : Move this elsewhere
					generate_options_css();
					do_action( 'zn_theme_updated', $current_theme_version, ZN()->version );
				}

				update_option( $this->theme_version_string, $this->theme_version, false );

			}

		}

	}

	/**
	 * This function will install the theme for the first time
	 */
	function do_theme_activation(){

		$options_field = ZN()->theme_data['options_prefix'];
		$saved_values = array();

		$file =  THEME_BASE."/template_helpers/dummy_content/theme_options.txt";
		if( ! is_file( $file ) ) {
			include(THEME_BASE.'/template_helpers/options/theme-options.php');

			foreach ( $admin_options as $key => $option ) {

				if( !empty( $option['std'] ) )
				{
					$saved_values[$option['parent']][$option['id']] = $option['std'];
				}

			}
		}
		else{
			$data = file_get_contents( $file );
			$saved_values = json_decode( $data, true );
		}

		update_option( $options_field , $saved_values );
		generate_options_css( $saved_values );
		ZN()->pagebuilder->refresh_pb_data();
		update_option( $this->theme_version_string, $this->theme_version, false );

		do_action('zn_theme_installed');

	}

	/**
	 * Handle updates
	 * TODO : Move all ajax code inside this file
	 */
	public function update( $step = 0,  $data = false ) {

		if( $step == '0' ){
			$this->set_data();

			if( !empty( $this->update_data['current_update'] ) ){
				$response = array(
					'status' => 'ok',
					'step'	=> 'process_update',
					'data'	=> array(
						'update_version' => $this->update_data['current_update'],
					),
					'response_text' => 'Starting update for version '. $this->update_data['current_update'],
				);
				$this->zn_send_json( $response );
			}
			else{
				$this->do_update_end();
			}

		}
		elseif( $step == 'process_update' ){

			// Load the version update file
			if( empty( $this->db_updates[$data['update_version']] ) ){
				// TODO : Investigate if we should close here.. it may be a javascript issue ?
				$this->do_update_end();
			}

			// We need to call the updater script for the current version
			include( $this->db_updates[$data['update_version']]['file'] );
			$current_version_function = $this->db_updates[$data['update_version']]['function'];

			call_user_func_array( $current_version_function, array( $step, $data ) );

		}
		elseif( $step == 'version_done' ){
			// Here we need to set the current_db_version to the current script version
			if( empty( $this->db_updates[$data['update_version']] ) ){
				// TODO : Investigate if we should close here.. it may be a javascript issue ?
				$this->do_update_end();
			}

			update_option( 'zn_theme_needs_update', $data['update_version'] );

			$this->set_data();

			if( !empty( $this->update_data['current_update'] ) ){
				$response = array(
					'status' => 'ok',
					'step'	=> 'process_update',
					'data'	=> array(
						'update_version' => $this->update_data['current_update'],
					),
					'response_text' => 'Starting update for version '. $this->update_data['current_update'],
				);
				$this->zn_send_json( $response );
			}
			else{
				$this->do_update_end();
			}


		}
		elseif( $step == 'done' ){
			$this->do_update_end();
		}
		return;
	}

	function do_update_end(){
		delete_option( 'zn_theme_needs_update' );
		$response = array(
				'status' => 'done',
				'response_text' => 'Theme update finished'
			);
		$this->zn_send_json( $response );
	}

	function zn_send_json( $response ) {

		while (ob_get_level()) {
		    ob_end_clean();
		}

		header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
		$response = json_encode( $response );
		echo '<div class="zn_json_response">';
			echo $response;
		echo '</div>';
		die();
	}

	function set_data(){

		$current_db_version = get_option( 'zn_theme_needs_update' );
		$updates_remaining  = array();

		foreach ( $this->db_updates as $version => $updater ) {

			if ( version_compare( $current_db_version, $version, '<' ) ) {
				$updates_remaining[] = $version;
			}

		}

		$current_update = false;
		if( !empty( $updates_remaining ) && is_array( $updates_remaining ) ){
			$current_update = reset( $updates_remaining );
		}

		$this->update_data = array(
			'updates_remaining' => $updates_remaining,
			'current_update' => $current_update,
		);

		set_transient( 'zn_update_process', $this->update_data, 12 * HOUR_IN_SECONDS );
	}

	function get_data(){
		$this->update_data = get_transient( 'zn_update_process' );
	}

}
