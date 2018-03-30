<?php 

////////////////////////////////////////////////////////
////////QUEUE UP FRAMEWORK/////////////////////////////
//////////////////////////////////////////////////////
	
//MENUS & WIDGETS
	require_once ( "mandw.php");
	
//STYLES & SCRIPTS
	require_once ( "styles_scripts.php");
	
//THEME FUNCTIONS
	require_once ( "theme_functions.php");
	
//THEME OPTIONS
	require_once ( "theme_options.php");
	
//THEME SUPPORT
	require_once ( "theme_support.php");
	
//THEME CUSTOM FILTERS
	require_once ( "theme_filters.php");
	
//METABOXES
	require_once ( "metaboxes.php");
	
//REQUIRED PLUGINS
	require_once ('class-tgm-plugin-activation.php');
	
//PLUGINS LOAD
	require_once ('plugins_load.php');
	
//COLOURS
	require_once ('custom_colours.php');

//Demo Data Importer	
function ebor_ajax_import_data() {				
	require_once( 'demo_import.php');
	die('ebor_import');
}
add_action('wp_ajax_ebor_ajax_import_data', 'ebor_ajax_import_data');