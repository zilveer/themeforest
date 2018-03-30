<?php
/**
 * Categories Only
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_setting( 'categories-only', array(
	'default' => true,
	'transport' => 'postMessage'
) );

$wp_customize->add_control( 'categories-only', array(
	'label' => __( 'Use categories only', 'listify' ),
	'type' => 'checkbox',
	'description' => __( 'Categories will be used to create map markers, and types will be hidden from all other areas. Categories must be enabled in Listings > Settings. <br /><br /><strong>Refresh this page in your browser after saving</strong>.', 'listify' ),
	'priority' => 70,
	'section' => 'labels'
) );
