<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

if( ! function_exists( 'shiroi_wpcf7_form_class_attr' ) ) {

	function shiroi_wpcf7_form_class_attr( $class ) {
		return $class . ' form-horizontal';
	}
}
add_filter( 'wpcf7_form_class_attr', 'shiroi_wpcf7_form_class_attr' );

if( ! function_exists( 'shiroi_wpcf7_enqueue_scripts' ) ) {

	function shiroi_wpcf7_enqueue_scripts() {

		$wp_theme = wp_get_theme();
		$theme_version = $wp_theme->exists() ? $wp_theme->get( 'Version' ) : false;

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_enqueue_script( 'shiroi-contact-form-7', 
			get_template_directory_uri() . "/assets/js/shiroi.wpcf7{$suffix}.js", 
			array( 'contact-form-7' ), 
			$theme_version, true 
		);
	}
}
add_action( 'wpcf7_enqueue_scripts', 'shiroi_wpcf7_enqueue_scripts' );
