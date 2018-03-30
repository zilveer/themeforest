<?php
/**
 * Custom submission
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
$wp_customize->add_setting( 'gallery-comments', array(
	'default' => true
) );

$wp_customize->add_control( 'gallery-comments', array(
	'label' => __( 'Allow comments on gallery images', 'listify' ),
	'type' => 'checkbox',
	'priority' => 60,
	'section' => 'labels'
) );
