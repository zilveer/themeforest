<?php
class TMM_CarSettingsHelper
{
    public static $sections = array();
    /*
	 * Drawing theme option for car settings
	 */

	public static function draw_theme_option($data, $prefix = TMM_THEME_PREFIX)
	{
		TMM_OptionsHelper::draw_theme_option($data, TMM_APP_CARDEALER_PREFIX);
	}
}
