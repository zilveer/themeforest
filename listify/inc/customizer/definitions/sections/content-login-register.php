<?php
/**
 * Content: Login/Register
 *
 * @uses $wp_customize
 * @since 1.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


$wp_customize->add_section( 'content-login-register', array(
	'title' => _x( 'Login/Register', 'customizer section title', 'listify' ),
	'panel' => 'content',
	'priority' => 60
) );
