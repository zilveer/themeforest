<?php

/**
 * Theme functions. Initializes the Vamtam Framework.
 *
 * @package  wpv
 */

require_once('vamtam/classes/framework.php');

new WpvFramework(array(
	'name' => 'health-center',
	'slug' => 'health-center'
));

if ( ! defined( 'REV_SLIDER_AS_THEME' ) ) {
	define( 'REV_SLIDER_AS_THEME', true );
}

// TODO remove next line when the editor is fully functional, to be packaged as a standalone module with no dependencies to the theme
define ('VAMTAM_EDITOR_IN_THEME', true); include_once THEME_DIR.'vamtam-editor/editor.php';

remove_action( 'admin_head', 'jordy_meow_flattr', 1 );

