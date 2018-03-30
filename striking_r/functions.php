<?php 
/**
 * Theme framework initialization
 *
 * Sets up the theme and provides some helper functions.
 *
 * This file will not be overridden by theme updates. So you can add your custom functions down below where indicated and they are safe. 
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 * This file is like a child functions file, and serves the same purpose, without having to go to the 
 * trouble of implementing a child theme, if only having one or two simple custom functions.
 *
 * NOTE: IF UPDATING THE THEME BY FTP, RENAME THIS FILE SO THAT IT IS NOT OVERRIDDEN OR DO NOT ALLOW
 * IT TO BE REPLACED IN THE FTP UPDATE.  IF SAVED BY A RENAME, OF COURSE REMEMBER TO COME BACK AND 
 * COPY ITS CUSTOM FUNCTIONS TO YOUR NEW FUNCTIONS.PHP FILE.
 */

if(!class_exists('Theme')){
	/* Load the Theme class. */
	require_once (TEMPLATEPATH . '/framework/theme.php');

	$theme = new Theme();
	$options = include(TEMPLATEPATH . '/framework/info.php');

	$theme->init($options);
}
/* Place your custom functions below */