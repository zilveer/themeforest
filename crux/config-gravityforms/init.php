<?php
/**
 * Gravityforms configurations.
 */
if ( class_exists( 'GFForms' ) ) {
	add_action( 'wp_enqueue_scripts', 'stag_gravityforms_scripts' );
}

function stag_gravityforms_scripts() {
	wp_register_style( 'stag-gravityforms', get_template_directory_uri() . '/config-gravityforms/gravityforms-custom.css', array('gforms_formsmain_css'), '1', 'screen' );
	wp_enqueue_style( 'stag-gravityforms' );
}
