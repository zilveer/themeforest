<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Theme
 * @since G1_Theme 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') ) {
	die ( 'No direct script access allowed' );
}

//delete_site_transient( 'update_themes' );

class G1_Theme_Updater {
	public function __construct () {
		add_action( 'after_setup_theme', array( $this, 'setup_hooks' ) );
	}

	public function setup_hooks () {
		add_filter( 'pre_set_site_transient_update_themes', array( $this, 'check_themeforest_for_updates' ) );
		add_action( 'upgrader_process_complete', array( $this, 'after_theme_update' ), 10, 2 );
		add_action( get_redux_opts_sections_filter_name(), array( $this, 'add_theme_options_section' ) );
	}

	public function check_themeforest_for_updates ( $updates ) {
		if ( isset( $updates->checked ) ) {
			require_once( 'class-pixelentity-themes-updater.php' );

			$username = g1_get_theme_option( 'theme_update', 'tf_username' );
			$apikey = g1_get_theme_option( 'theme_update', 'tf_api_key' );

			if ( $username && $apikey ) {
				$updater = new Pixelentity_Themes_Updater( $username, $apikey );
				$updates = $updater->check( $updates );
			}
		}

		return $updates;
	}

	public function after_theme_update ( $upgrader, $options ) {
		if ( isset( $options['type'] ) && $options['type'] === 'theme' ) {
			// show notice even if user previously closed it
			update_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice', false );
		}
	}

	public function add_theme_options_section ( $sections ) {
		$fields = array();

		$section_id = 'theme_update';

		$fields[] = array(
			'id'        => $section_id . '_info',
			'priority'  => 1,
			'type'      => 'info',
			'desc'      =>
				'<h4>' .
					__( 'ThemeForest Account', Redux_TEXT_DOMAIN ) .
				'</h4>' .
				__( 'Once you have entered your Username and API Key, WordPress will check for available updates (every 12 hours) and notify you', Redux_TEXT_DOMAIN ) .
				'<p><a class="button button-secondary" href="#check-for-update">' . __( 'Check for updates now', Redux_TEXT_DOMAIN ). '</a></p>' .
				'<p id="g1-updates-available" style="display: none;"><strong>' . sprintf( _x( 'New updates available. Go to the <a href="%s" target="_blank">Updates</a> page.', 'theme_options', Redux_TEXT_DOMAIN ), admin_url( 'update-core.php' ) ) . '</strong></p>' .
				'<p id="g1-no-updates" style="display: none;"><strong >'. _x( 'No updates available.', 'theme_options', Redux_TEXT_DOMAIN ). '</strong></p>'
		);

		$fields[] = array(
			'id'        => $section_id . '_tf_username',
			'priority'  => 10,
			'type'      => 'text',
			'title'     => __( 'Username', Redux_TEXT_DOMAIN ),
			'std'       => ''
		);

		$fields[] = array(
			'id'        => $section_id . '_tf_api_key',
			'priority'  => 20,
			'type'      => 'text',
			'title'     => __( 'API Key', Redux_TEXT_DOMAIN ),
			'std'       => ''
		);

		$fields[] = array(
			'id'        => $section_id . '_api_key_info',
			'priority'  => 30,
			'type'      => 'info',
			'desc'      =>
				'<strong>' . __( 'Where to Generate Your API Key?', Redux_TEXT_DOMAIN ) . '</strong><br />' .
				'<ol>' .
					'<li>'. __( 'Log into your ThemeForest account and hover over your Username in the top right corner. From the dropdown choose the <strong>Settings</strong> link.', Redux_TEXT_DOMAIN ) .'</li>' .
					'<li>'. __( 'From left side menu, choose <strong>API Keys</strong>.', Redux_TEXT_DOMAIN ) .'</li>' .
					'<li>'. __( 'Enter a label for new key and click <strong>Generate API Key</strong>.', Redux_TEXT_DOMAIN ) .'</li>' .
				'</ol>',
		);

		$sections[ $section_id ] = array(
			'priority'   => 3000,
			'icon'       => 'refresh',
			'icon_class' => 'icon-large',
			'title'      => __( 'Theme Update', Redux_TEXT_DOMAIN ),
			'fields'     => $fields
		);

		return $sections;
	}
}

new G1_Theme_Updater();









