<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - INCLUDINGS

		1.1 - Check ST Kit compatibility
		1.2 - Functions
		1.3 - Register: CSS
		1.4 - Register: JS
		1.5 - Register: Menu
		1.6 - Register: Sidebars
		1.7 - Comment Callback
		1.8 - IE Styles
		1.9 - TGM
		1.10 - TF

*/

/*= 1 ===========================================

	I N C L U D I N G S
	Required includings

===============================================*/

	global
		$st_Options,
		$st_Settings;

		$st_ = array();



	/*-------------------------------------------
		1.1 - Checking of compatibility
	-------------------------------------------*/

	if ( is_admin() ) {
		include( locate_template( '/framework/functions/checking.php' ) ); }



	/*-------------------------------------------
		1.2 - Functions
	-------------------------------------------*/

	include( locate_template( '/framework/functions/global.php' ) );



	/*-------------------------------------------
		1.3 - Register: CSS
	-------------------------------------------*/

	get_template_part( '/framework/functions/register-css' );



	/*-------------------------------------------
		1.4 - Register: JS
	-------------------------------------------*/

	get_template_part( '/framework/functions/register-js' );



	/*-------------------------------------------
		1.5 - Register: Menu
	-------------------------------------------*/

	get_template_part( '/framework/functions/register-menu' );



	/*-------------------------------------------
		1.6 - Register: Sidebars
	-------------------------------------------*/

	get_template_part( '/framework/functions/register-sidebars' );



	/*-------------------------------------------
		1.7 - Comment Callback
	-------------------------------------------*/

	if ( !is_admin() ) {

		get_template_part( '/includes/comments/comment' );
		get_template_part( '/includes/comments/pingback' );

	}



	/*-------------------------------------------
		1.8 - IE Styles
	-------------------------------------------*/

	if ( !is_admin() ) {
		get_template_part( '/framework/functions/ie-css' ); }



	/*-------------------------------------------
		1.9 - TGM
	-------------------------------------------*/

	include( locate_template( '/framework/functions/register-tgm.php' ) );



	/*-------------------------------------------
		1.10 - TF
	-------------------------------------------*/

	if ( function_exists( 'st_kit' ) ) {
		include( locate_template( '/framework/functions/register-tf.php' ) ); }



?>