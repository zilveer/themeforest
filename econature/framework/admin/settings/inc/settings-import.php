<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.1.2
 * 
 * Theme Settings Importer
 * Created by CMSMasters
 * 
 */


$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);

require_once($parse_uri[0] . 'wp-load.php');


if (isset($_POST['settings'])) {
	$settings = json_decode(base64_decode($_POST['settings']), true);
	
	
	foreach ($settings as $name => $value) {
		update_option($name, $value);
	}
	
	
	cmsms_regenerate_styles();
}

