<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - REGISTER JS

		1.1 - Unique

			- jquery.menu.js

		1.2 - Common

			- jquery.st.js

		1.3 - Other scripts

			- comment-reply.js
			- wp-mediaelement.js

*/

	if ( !is_admin() ) {

		function st_theme_scripts() {
	
			global
				$st_Options,
				$st_Settings;


			/*-------------------------------------------
				1.1 - Unique scripts
			-------------------------------------------*/

			if ( $st_Options['js']['menu'] ) {
				wp_enqueue_script( 'st-jquery-menu', get_template_directory_uri() . '/assets/js/jquery.menu.js', array('jquery'), null, true ); }
	
	
			/*-------------------------------------------
				1.2 - Common scripts
			-------------------------------------------*/

			if ( $st_Options['js']['st'] ) {
				wp_enqueue_script( 'st-jquery-st', get_template_directory_uri() . '/framework/assets/js/jquery.st.js', array('jquery'), null, true ); }


			/*-------------------------------------------
				1.3 - Other scripts
			-------------------------------------------*/

			if ( !empty( $st_Options['comment-reply'] ) && $st_Options['comment-reply'] ) {
				wp_enqueue_script( 'comment-reply' ); }

			if ( $st_Options['js']['mediaelement'] ) {
				wp_enqueue_script( 'wp-mediaelement' ); }


		}
	
		add_action( 'wp_enqueue_scripts', 'st_theme_scripts' );

	}


?>