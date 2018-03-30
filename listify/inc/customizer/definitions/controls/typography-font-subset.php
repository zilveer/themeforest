<?php
/**
 * Font Subset
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) || ! $wp_customize instanceof WP_Customize_Manager ) {
	exit; // Exit if accessed directly.
}

$wp_customize->add_setting( 'typography-font-subset', array(
	'default' => 'latin'
) );

$wp_customize->add_control( 'typography-font-subset', array(
	'label' => __( 'Font Subset', 'listify' ),
	'type' => 'select',
	'choices' => Listify_Customizer::$fonts->get_font_subset_choices( array( 'google' ) ),
	'description' => __( 'Please note not all subsets are available for each font family. <a href="https://www.google.com/fonts">Read more</a>.', 'listify' ),
	'section' => 'font-subset'
) );
