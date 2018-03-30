<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Theme Options Importer
 * Created by CMSMasters
 * 
 */


$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);

require_once($parse_uri[0] . 'wp-load.php');


global $wpdb;


$objDOM = new DOMDocument();


$objDOM->load(TEMPLATEPATH . '/framework/admin/inc/theme-options.xml');


$options = $objDOM->getElementsByTagName('table');


foreach ($options as $option) {
	$params = $option->getElementsByTagName('column');
	
	
	foreach ($params as $param) {
		if ($param.nodeName == 'option_name') {
			$name = $param->item(0)->nodeValue;
		}
		
		
		if ($param->item(0)->nodeName == 'option_value') {
			$value = $param->item(0)->nodeValue;
		}
	}
	
	
	if (get_option($name)) {
		update_option($name, $value);
	} else {
		add_option($name, $value, '', 'yes');
	}
}

