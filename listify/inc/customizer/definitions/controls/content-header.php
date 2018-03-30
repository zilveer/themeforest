<?php
/**
 * Content Header
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_setting( 'fixed-header', array(
	'default' => true,
	'transport' => 'postMessage'
) );

$wp_customize->add_control( 'fixed-header', array(
	'label' => __( 'Fixed Header', 'listify' ),
	'type' => 'checkbox',
	'priority' => 50,
	'section' => 'title_tagline'
) );
