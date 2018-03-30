<?php
//add woocommerce support
add_theme_support('woocommerce');

//site options
require_once( get_template_directory() . '/framework/theme-specific/site-options.php');

//admin functions
require_once( get_template_directory() . '/framework/theme-specific/admin-functions.php');

//shortcodes
require_once( get_template_directory() . '/framework/theme-specific/shortcodes.php');

//shortcodes
require_once( get_template_directory() . '/framework/theme-specific/tinymce/tinymce.loader.php');

//metaboxes
require_once( get_template_directory() . '/framework/theme-specific/metabox.php');

//Javascript Loader
require_once( get_template_directory() . '/framework/theme-specific/javascript.php');

//post types
require_once( get_template_directory() . '/framework/theme-specific/post-types.php');

//taxonomy
require_once( get_template_directory() . '/framework/theme-specific/taxonomy.php');

//navigation functions (register navs + custom walker)
require_once( get_template_directory() . '/framework/theme-specific/navigation.php');

//sidebars
require_once( get_template_directory() . '/framework/theme-specific/sidebars.php');

//update notifier - @since 2.2.1 - removed this feature