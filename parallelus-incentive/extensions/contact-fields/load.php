<?php
/*
    Extension Name: Contact Form
    Extension URI:
    Version: 0.8
    Description: Add custom contact forms to your site. Insert forms with shortcodes.
    Author: Parallelus
    Author URI: http://runwaywp.com
    Text Domain:
    Domain Path:
    Network:
    Site Wide Only:
*/

// Reset
if (0) update_option('contact_form', array());

// Settings

$fields = array(
	'var' => array(),
	'array' => array()
);
$default = array();

$settings = array(
	'name' => 'Contact Form', 
	'option_key' => $shortname.'contact_fields',
	'fields' => $fields,
	'default' => $default,
	'parent_menu' => 'settings',
	//'menu_permissions' => 5,
	'file' => __FILE__,
	'css' => array(
		// FRAMEWORK_URL.'framework/css/styles.css',
		FRAMEWORK_URL.'extensions/contact-fields/css/styles.css'
	)
);

// Required components
include('object.php');
if (!is_admin()) {	
	include('inc/functions.php');	
	include('inc/shortcodes.php');	
}

global $contact_fields, $contact_fields_admin;

$contact_fields = new contact_fields_object($settings);
	
// Load admin components
if (is_admin()) {	
	include('settings-object.php');
	$contact_fields_admin = new contact_fields_admin_object($settings);
}

?>