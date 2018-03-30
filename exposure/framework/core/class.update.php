<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme updater class.
 *
 * This class is entitled to manage the theme updates notifications.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_ThemeUpdate') ) {
	class THB_ThemeUpdate {

		/**
		 * The theme instance.
		 *
		 * @var THB_Theme
		 */
		private $instance = null;

		/**
		 * The latest version number of the theme.
		 *
		 * @var integer
		 */
		public $latestVersion = 0;

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			$this->instance = thb_theme();

			$this->instance->getAdmin()->setInstallationDetails(array(
				'updates' => array(
					'last_check'     => 0,
					'latest_version' => 0,
					'changelog'      => ''
				)
			), true); // Preserve original data

			$this->checkForUpdates();
		}

		/**
		 * Add a dashboard page to show notifications and display the theme
		 * changelog.
		 *
		 * @return void
		 */
		public function addPage()
		{
			$installationDetails = $this->instance->getAdmin()->getInstallationDetails();
			$latest_version = $installationDetails['updates']['latest_version'];
			$updateSpan = '';

			$checkVersion = is_child_theme() ? THB_PARENT_THEME_VERSION : THB_THEME_VERSION;
			$themeName = is_child_theme() ? THB_PARENT_THEME_NAME : 'thb_text_domain';

			if( thb_system_is_development() ) {
				if( version_compare($checkVersion, $latest_version) < 0 ) {
					// We've got updates!
					$newUpdates = __('Update!', 'thb_text_domain');
					$updateSpan = '<span class="update-plugins count-1"><span>' . $newUpdates . '</span></span>';
				}
			}

			add_dashboard_page(
				$themeName . ' ' . __('theme updates', 'thb_text_domain'),
				$themeName . ' ' . $updateSpan,
				'administrator',
				'thb_theme_updates',
				array($this, '_themeVersionPage')
			);
		}

		/**
		 * Check for updates.
		 *
		 * @return void
		 */
		private function checkForUpdates()
		{
			$installationDetails = $this->instance->getAdmin()->getInstallationDetails();
			$update_last_check = $installationDetails['updates']['last_check'];

			if( time() - $update_last_check > THB_UPDATE_CHECK_INTERVAL ) {
				$theme_data = json_decode( $this->_grabChangelog() );

				if( $theme_data && !empty($theme_data->changelog) ) {
					foreach( $theme_data->changelog as $version => $release ) {
						$latest_version = $version;
						break;
					}

					$this->instance->getAdmin()->setInstallationDetails(array(
						'updates' => array(
							'last_check'     => time(),
							'latest_version' => $latest_version,
							'changelog'      => $theme_data->changelog
						)
					));
				}
			}
		}

		/**
		 * Grab the changelog data.
		 *
		 * @return stdClass
		 */
		private function _grabChangelog()
		{
			$data = wp_remote_get(THB_UPDATE_CHANGELOG_DISPATCHER);

			if( !thb_response_is_ok($data) ) {
				return false;
			}
			else {
				return $data['body'];
			}
		}

		/**
		 * Display the changelo page content.
		 *
		 * @return void
		 */
		public function _themeVersionPage()
		{
			$page = new THB_Template(THB_RESOURCES_DIR . '/admin/pages/thb_theme_updates');
			$page->render();
		}

	}

	$thb_theme_updater = new THB_ThemeUpdate();
	add_action( 'admin_menu', array($thb_theme_updater, 'addPage') );
}