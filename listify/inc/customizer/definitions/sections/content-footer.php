<?php
/**
 * Content Footer
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_section( 'content-footer', array(
	'title' => _x( 'Footer', 'customizer section title', 'listify' ),
	'panel' => 'content',
	'priority' => 25
) );
