<?php
require_once CT_THEME_LIB_DIR.'/updater/theme-update-checker.php';

/**
 * Theme updater
 * @author alex
 */
class ctThemeUpdater extends ThemeUpdateChecker {

	const LICENSE_KEY = 'general_envato_license';

	/**
	 * License key
	 * @var string
	 */
	protected $license;

	/**
	 * Internal project name
	 * @var string
	 */

	protected $name;

	/**
	 * Creates object
	 * @param string $theme
	 * @param string $metadataUrl
	 * @param bool $enableAutomaticChecking
	 */
	public function __construct($theme, $metadataUrl = null, $enableAutomaticChecking = true) {
		$metadataUrl = $metadataUrl ? $metadataUrl : 'http://update.optimus-prime.createit.pl/updater';
		parent::__construct($theme, $metadataUrl, $enableAutomaticChecking);

		$this->addQueryArgFilter(array($this, 'filterQuery'));
		$this->license = ct_get_option(self::LICENSE_KEY);
		add_filter('update_theme_complete_actions', array($this, 'themeUpdate'));
	}

	/**
	 * Invoked when key license is updated
	 * @param array $newValues
	 * @return void
	 */

	public function handleLicenseKeySaved($newValues) {
		//rebulild data if new license is entered
		if (isset($newValues[self::LICENSE_KEY]) && ($this->license != $newValues[self::LICENSE_KEY])) {
			$this->license = $newValues[self::LICENSE_KEY];
			$this->checkForUpdates();
		}
	}

	/**
	 * Aktualizacja theme
	 * @param $actions
	 * @param $themeName
	 * @return array
	 */
	public function themeUpdate($actions) {
		if (count($actions) <= 1) {
			$actions[] = "<br/><br/><strong style=\"font-size:18px\">Invalid or missing envato license key! Please update your license key in Theme Options - General - Automatic Update</strong>";
		}
		if(is_child_theme()){
			$theme_data = wp_get_theme();
			$actions[] = "<br/><br/><strong style=\"font-size:18px\">To update main theme, activate ".$theme_data->get('Template')." theme and use automatic update.</strong>";
		}
		return $actions;
	}

	/**
	 * Sets license
	 * @param $license
	 */

	public function setLicense($license) {
		$this->license = $license;
	}

	/**
	 * Adds data to querystring
	 * @param array $args
	 * @return array
	 */
	public function filterQuery($args) {
		$args['theme'] = $this->name;
		$args['license'] = $this->license;
		return $args;
	}

	/**
	 * Sets internal theme name
	 * @param string $name
	 */

	public function setInternalName($name) {
		$this->name = $name;
	}


}
