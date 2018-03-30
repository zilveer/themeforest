<?php
/**
 * Sets up the theme by loading the Mysitemyway class & initializing the framework
 * which activates all classes and functions needed for theme's operation.
 *
 * @package Mysitemyway
 * @subpackage Functions
 */

# Load the Mysitemyway class.
require_once( TEMPLATEPATH . '/framework.php' );

# Get theme data.
$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );

# Initialize the Mysitemyway framework.
Mysitemyway::init(array(
	'theme_name' => $theme_data['Name'],
	'theme_version' => $theme_data['Version']
));

?>