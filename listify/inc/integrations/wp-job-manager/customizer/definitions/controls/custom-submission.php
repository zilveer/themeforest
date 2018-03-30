<?php
/**
 * Custom submission
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_setting( 'custom-submission', array(
	'default' => true
) );

$wp_customize->add_control( 'custom-submission', array(
	'label' => __( 'Use "directory" submission fields', 'listify' ),
	'type' => 'checkbox',
	'priority' => 50,
	'section' => 'labels'
) );
