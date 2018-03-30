<?php
/**
 * A Fork of the Aqua Page Builder
 *
 * @copyright alessandrotesoro, syamilmj
 * @link  https://themesdepot.org
*/
 
//definitions
if(!defined('TDPB_PATH')) define( 'TDPB_PATH', plugin_dir_path(__FILE__) );
if(!defined('TDPB_DIR')) define( 'TDPB_DIR', get_template_directory_uri() . '/framework/extensions/page-builder/' );

function tdpb_get_version() {
	$version = '1';
	return $version;
}

//required functions & classes
require_once(TDPB_PATH . 'functions/tdpb_config.php');
require_once(TDPB_PATH . 'classes/class-td-page-builder.php');
require_once(TDPB_PATH . 'classes/class-td-block.php');
require_once(TDPB_PATH . 'functions/tdpb_functions.php');

//fire up page builder
$tdpb_config = td_page_builder_config();
$td_page_builder = new TD_Page_Builder($tdpb_config);
if(!is_network_admin()) $td_page_builder->init();
