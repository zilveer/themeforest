<?php
/**
 * omni Theme Customizer.
 *
 * @package omni
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function omni_customizer_register( $wp_customize ) {

	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->remove_control( 'header_image' );
}

add_action( 'customize_register', 'omni_customizer_register' );

