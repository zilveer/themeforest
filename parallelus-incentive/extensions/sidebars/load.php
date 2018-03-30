<?php
/*
    Extension Name: Sidebar Settings
    Extension URI:
    Version: 0.1
    Description: Create custom sidebars for adding widget content. Add sidebars into the code directly or in the admin with shortcodes.
    Author: Parallelus
    Author URI: http://runwaywp.com
    Text Domain:
    Domain Path:
    Network:
    Site Wide Only:

*/

// Reset
if (0) update_option('sidebar_settings', array());

// Settings
$fields = array(
		'var' => array(),
		'array' => array()
);
$default = array();

$settings = array(
	'name' => 'Sidebars', 
	'option_key' => $shortname.'sidebar_settings',
	'fields' => $fields,
	'default' => $default,
	'parent_menu' => 'appearance',
	//'menu_permissions' => 5,
	'file' => __FILE__,
	'js' => array(
		'jquery',
		'jquery-ui-core',
		'jquery-ui-dialog',
	),
);

// Including Sidebar Generator and Sidebar Shortcodes

// Required components
include('object.php');
global $sidebar_settings, $sidebar_admin;
$sidebar_settings = new Sidebar_Settings_Object($settings);

// Load admin components
if (is_admin()) {	
	include('settings-object.php');
	$sidebar_admin = new Sidebar_Admin_Object($settings);
}

// Setup a custom button in the title
function title_button_new_sidebar( $title ) {
	if ( $_GET['page'] == 'sidebars' ) {
		$title .= ' <a href="admin.php?page=sidebars&navigation=add-sidebar" class="add-new-h2">'. __( 'Add new sidebar', FRAMEWORK_TEXT ) .'</a>';
	}
	return $title;
}

add_filter( 'framework_admin_title', 'title_button_new_sidebar' );
?>
