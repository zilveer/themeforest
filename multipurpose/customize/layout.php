<?php
function multipurpose_customize_register_layout($wp_customize) {
	$wp_customize->add_section('layout', array(
		'title' => esc_attr__('Layout', 'multipurpose'),
		'priority' => 10
	));

	$wp_customize->add_setting('layout_type', array('default' => 0));
	$wp_customize->add_control('layout_type', array(
		'label' => esc_attr__('Layout type', 'multipurpose'),
		'section' => 'layout',
		'settings' => 'layout_type', 
		'type' => 'radio',
		'choices' => array(
			0 => esc_attr__('Wide (default)', 'multipurpose'),
			1 => esc_attr__('Boxed', 'multipurpose'),
			2 => esc_attr__('Boxed with shadow', 'multipurpose')
		)
	));

	$wp_customize->add_setting('layout_bg_pattern', array('default' => 0));
	$wp_customize->add_control('layout_bg_pattern', array(
		'label' => esc_attr__('Page background pattern', 'multipurpose'),
		'section' => 'layout',
		'settings' => 'layout_bg_pattern', 
		'type' => 'radio',
		'choices' => array(
			0 => esc_attr__('No pattern', 'multipurpose'),
			1 => esc_attr__('Pattern 1', 'multipurpose'),
			2 => esc_attr__('Pattern 2', 'multipurpose'),
			3 => esc_attr__('Pattern 3', 'multipurpose'),
			4 => esc_attr__('Pattern 4', 'multipurpose'),
			5 => esc_attr__('Pattern 5', 'multipurpose'),
			6 => esc_attr__('Pattern 6', 'multipurpose'),
			7 => esc_attr__('Pattern 7', 'multipurpose'),
			8 => esc_attr__('Pattern 8', 'multipurpose'),
			9 => esc_attr__('Pattern 9', 'multipurpose'),
			10 => esc_attr__('Pattern 10', 'multipurpose')
		)
	));
	$wp_customize->add_setting('layout_border', array('default' => 0));
	$wp_customize->add_control('layout_border', array(
		'label' => esc_attr__('Page border (boxed layout only)', 'multipurpose'),
		'section' => 'layout',
		'settings' => 'layout_border', 
		'type' => 'radio',
		'choices' => array(
			0 => esc_attr__('No border', 'multipurpose'),
			1 => esc_attr__('Border 1', 'multipurpose'),
			2 => esc_attr__('Border 2', 'multipurpose'),
			3 => esc_attr__('Border 3', 'multipurpose'),
			4 => esc_attr__('Border 4', 'multipurpose'),
			5 => esc_attr__('Border 5', 'multipurpose'),
			6 => esc_attr__('Border 6', 'multipurpose'),
			7 => esc_attr__('Border 7', 'multipurpose'),
			8 => esc_attr__('Border 8', 'multipurpose'),
			9 => esc_attr__('Border 9', 'multipurpose'),
		)
	));
}

add_action('customize_register', 'multipurpose_customize_register_layout');