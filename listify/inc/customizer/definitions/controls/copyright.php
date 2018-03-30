<?php
/**
 * Copyright
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// as seen on title
$wp_customize->add_setting( 'copyright-text', array(
	'default' => sprintf( __( 'Copyright %s &copy; %s. All Rights Reserved', 'listify' ), get_bloginfo( 'name' ), date( 'Y' ) )
) );

$wp_customize->add_control( 'copyright-text', array(
	'label' => __( 'Copyright Text', 'listify' ),
	'type' => 'text',
	'priority' => 30,
	'section' => 'content-footer'
) );
