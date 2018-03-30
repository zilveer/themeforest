<?php
/**
 * Homepage Secondary Logo
 *
 * @uses $wp_customize
 * @since 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'home-header-logo', array(
	'default' => false,
	'transport' => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( 
	$wp_customize, 
	'home-header-logo', 
	array(
		'label' => __( 'Transparent Header Logo', 'listify' ),
		'priority' => 25,
		'section' => 'static_front_page'
	) 
) );

if ( ! isset( $wp_customize->selective_refresh ) ) {
	return;
}

$wp_customize->selective_refresh->add_partial( 'home-header-logo', array(
	'selector' => '.site-branding',
	'settings' => array( 'home-header-logo' ),
	'render_callback' => 'listify_partial_site_branding'
) );
