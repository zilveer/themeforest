<?php
/*
	Plugin Name: Themeforest Themes Update
	Plugin URI: https://github.com/bitfade/themeforest-themes-update
	Description: Updates all themes purchased from themeforest.net
	Author: pixelentity
	Version: 1.0
	Author URI: http://pixelentity.com
*/

global $smof_data;

if (@$smof_data['themeforest_username'] != '' AND @$smof_data['themeforest_api_key'] != '') {
	function us_themeforest_themes_update($updates) {

		global $smof_data;

		if (isset($updates->checked)) {
			require_once(get_template_directory()."/vendor/tf_updater/pixelentity-themes-updater/class-pixelentity-themes-updater.php");

			$username = $smof_data['themeforest_username'];
			$apikey = $smof_data['themeforest_api_key'];
			$author = 'UpSolution';

			$updater = new Pixelentity_Themes_Updater($username, $apikey, $author);
			$updates = $updater->check($updates);
		}
		return $updates;
	}

	add_filter("pre_set_site_transient_update_themes", "us_themeforest_themes_update");

}