<?php
/*
Plugin Name: Advanced Custom Fields: Repeater Field
Plugin URI: http://www.advancedcustomfields.com/
Description: This premium Add-on adds a repeater field type for the Advanced Custom Fields plugin
Version: 1.1.1
Author: Elliot Condon
Author URI: http://www.elliotcondon.com/
License: GPL
Copyright: Elliot Condon
*/

// only include add-on once
if( !function_exists('acf_register_repeater_field') ):


// add action to include field
add_action('acf/register_fields', 'acf_register_repeater_field');

function acf_register_repeater_field()
{
	include_once('repeater.php');
}

endif; // class_exists check

?>
