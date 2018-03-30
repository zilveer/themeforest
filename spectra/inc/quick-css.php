<?php
/**
 * Plugin Name: 	spectra
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			quick-css.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */

$_GET = array_map('strip_tags', $_GET);

$wp_load = dirname(__FILE__);
 
for ($i = 0; $i < 8; $i++) {
	$wp_load = dirname($wp_load);
	if (file_exists($wp_load . '/wp-load.php')) break;
	if ($i == 7) { 
	    echo 'Error: wp-load.php doesn\'t exists';
		die();
	}
}

require_once($wp_load . '/wp-load.php');

global $spectra_opts;

header('Content-type: text/css');

$spectra_opts->e_get_option( 'custom_css' ); 
?>