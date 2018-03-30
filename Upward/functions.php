<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - START

		1.1 - Theme Options
		1.2 - Theme Settings
		1.3 - Framework

*/

/*= 1 ===========================================

	S T A R T
	The start point is here.

===============================================*/

	/*-------------------------------------------
		Theme Options:
		Global options comes by default.
	-------------------------------------------*/

	include( locate_template( '/options.php' ) );


	/*-------------------------------------------
		Theme Settings:
		Unique settings created by admin.
	-------------------------------------------*/

	$st_Settings = function_exists( 'st_kit' ) ? get_option( $st_Options['general']['name'] . 'settings' ) : array();


	/*-------------------------------------------
		Framework:
		A common functions.
	-------------------------------------------*/

	include( locate_template( '/framework/start.php' ) );


?>