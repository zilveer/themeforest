<?php

function swm_register_customizer_options( $wp_customize ) {

	$custpath = get_template_directory() . '/framework/customizer/options/';	

	require_once( $custpath . 'general.php' );    
	require_once( $custpath . 'styling.php' );
	require_once( $custpath . 'favicon.php' );
	require_once( $custpath . 'logo.php' );
	require_once( $custpath . 'header.php' );
	require_once( $custpath . 'footer.php' );
	require_once( $custpath . 'fonts.php' );
	require_once( $custpath . 'social-media-icons.php' );
	require_once( $custpath . 'blog.php' );
	require_once( $custpath . 'portfolio.php' );
	require_once( $custpath . 'cause.php' );
	require_once( $custpath . 'sermons.php' );
	require_once( $custpath . 'custom-css-js.php' );
	require_once( $custpath . 'error-page.php' );
	require_once( $custpath . 'image-height.php' );

	//the event caldendar plugin
	if ( class_exists( 'Tribe__Events__Main' ) ) {
		require_once( SWM_ADMIN . 'customizer/options/event.php' );
	}
}

add_action( 'customize_register', 'swm_register_customizer_options' );