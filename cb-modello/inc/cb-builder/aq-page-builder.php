<?php
/** بسم الله الرحمن الرحيم **

Plugin Name: Aqua Page Builder
Plugin URI: http://aquagraphite.com/page-builder
Description: Easily create custom page templates with intuitive drag-and-drop interface. Requires PHP5 and WP3.5
Version: 1.0.8
Author: Syamil MJ
Author URI: http://aquagraphite.com

*/

/**
 * Copyright (c) 2013 Syamil MJ. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

//definitions
if(!defined('AQPB_VERSION')) define( 'AQPB_VERSION', '1.0.8' );
if(!defined('AQPB_PATH')) define( 'AQPB_PATH', trailingslashit( dirname(__FILE__) ));
if(!defined('AQPB_DIR')) define( 'AQPB_DIR', get_template_directory_uri().'/inc/cb-builder/' );

//required functions & classes
require_once(AQPB_PATH . 'functions/aqpb_config.php');
require_once(AQPB_PATH . 'classes/class-aq-page-builder.php');
require_once(AQPB_PATH . 'classes/class-aq-block.php');
//require_once(AQPB_PATH . 'classes/class-aq-plugin-updater.php');
require_once(AQPB_PATH . 'functions/aqpb_functions.php');

//some default blocks
require_once(AQPB_PATH . 'cb-blocks.php');

$aqpb_config = aq_page_builder_config();
$aq_page_builder = new AQ_Page_Builder($aqpb_config);


if(!is_network_admin()) $aq_page_builder->init();

/*
$aqpb_updater_config = array(
	'api_url'	=> 'http://aquagraphite.com/api/',
	'slug'		=> 'aqua-page-builder',
	'filename'	=> 'aq-page-builder.php'
);
$aqpb_updater = new AQ_Plugin_Updater($aqpb_updater_config);
*/