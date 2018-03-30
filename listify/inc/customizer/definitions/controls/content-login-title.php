<?php
/**
 * Content: Login Title
 *
 * @uses $wp_customize
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'content-login-title', array(
	'default' => 'Hey, welcome back!'
) );

$wp_customize->add_control( 'content-login-title', array(
	'label' => __( 'Login Popup Title', 'listify' ),
	'type' => 'text',
	'section' => 'content-login-register',
	'priority' => 10
) );
