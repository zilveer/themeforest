<?php
/**
 * Homepage Hero
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'home-header-style', array(
	'default' => 'default'
) );

$wp_customize->add_control( 'home-header-style', array(
	'label' => __( 'Header Style', 'listify' ),
	'description' => sprintf( __( 'For a full overview of this hero style please <a href="%s">review this article</a>', 'listify' ), 'http://listify.astoundify.com/article/1011-content-home' ),
	'type' => 'select',
	'choices' => array(
		'default' => __( 'Default', 'listify' ),
		'transparent' => __( 'Transparent & Full Width', 'listify' )
	),
	'priority' => 20,
	'section' => 'static_front_page'
) );