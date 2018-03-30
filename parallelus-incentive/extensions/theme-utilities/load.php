<?php
/*
    Extension Name: Theme Utilities
    Extension URI:
    Version: 1.0
    Description: Add on functionality for enhanced theme options including meta options (exclude from search, hide title, disable wpautop), pagination, the query shortcode, static blocks, etc...
    Author: Parallelus
    Author URI: http://para.llel.us
*/

// Do this first
if (is_admin()) {
	require('demo-data.php');
	require('theme-options-filters.php');
}

// Now load everything else
require('custom-css.php');
require('custom-js.php');
require('pagination.php');
if (!function_exists('the_static_block')) {
	require('post-type-static-block.php');
}
require('query-shortcode-class.php');
require('theme-helpers.php');
require('theme-sidebars.php');
require('theme-shortcodes.php');

if (!is_admin()) {
	require('image-resize.php');
}
