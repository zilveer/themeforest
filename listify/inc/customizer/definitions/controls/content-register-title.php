<?php
/**
 * Content: Register Title
 *
 * @uses $wp_customize
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'content-register-title', array(
	'default' => sprintf( 'Sign up for %s', get_bloginfo( 'name' ) )
) );

$wp_customize->add_control( 'content-register-title', array(
	'label' => __( 'Register Popup Title', 'listify' ),
	'type' => 'text',
	'section' => 'content-login-register',
	'priority' => 20
) );
