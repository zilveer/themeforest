<?php
if( !defined('ABSPATH') ) exit;
require_once 'homepage-v1-2-columns-left-sidebar.php';
require_once 'homepage-v1-2-columns-right-sidebar.php';
require_once 'homepage-v2-fullwidth-3-columns.php';
require_once 'homepage-v3-fullwidth-4-columns.php';
require_once 'homepage-v4-fullwidth-6-columns.php';
require_once 'homepage-v5-1-column-left-sidebar.php';
require_once 'homepage-v5-1-column-left-sidebar-v2.php';
require_once 'homepage-v5-1-column-right-sidebar.php';
require_once 'homepage-v5-1-column-right-sidebar-v2.php';

if( !function_exists( 'mars_remove_default_templates' ) ){
	function mars_remove_default_templates( $data ) {
		return array(); // This will remove all default templates
	}
	add_filter( 'vc_load_default_templates', 'mars_remove_default_templates', 10, 1);
}