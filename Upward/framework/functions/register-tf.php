<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - THEMEFOREST

		1.1 - Userdata
		1.2 - Include
		1.3 - Init

*/

/*= 1 ===========================================

	T H E M E F O R E S T
	Plugin activation class

===============================================*/

	/*-------------------------------------------
		1.1 - Userdata
	-------------------------------------------*/

	$st_['apikey'] = !empty( $st_Settings['apikey'] ) ? $st_Settings['apikey'] : '';
	$st_['username'] = !empty( $st_Settings['username'] ) ? $st_Settings['username'] : '';



	/*-------------------------------------------
		1.2 - Include
	-------------------------------------------*/

	if ( $st_['apikey'] ) {
		require_once dirname( __FILE__ ) . '/classes/class-pixelentity-theme-update.php'; }



	/*-------------------------------------------
		1.3 - Init
	-------------------------------------------*/

	if ( $st_['apikey'] ) {
		PixelentityThemeUpdate::init( $st_['username'], $st_['apikey'], 'StrictThemes' ); }



?>