<?php
function multipurpose_customize_register_breadcrumb($wp_customize) {
	$wp_customize->add_section('breadcrumb', array(
		'title' => esc_attr__('Breadcrumb', 'multipurpose'),
		'priority' => 20
	));
	
	$wp_customize->add_setting('breadcrumb_pattern', array('default' => 7));
	$wp_customize->add_control('breadcrumb_pattern', array(
		'label' => esc_attr__('Breadcrumb background pattern', 'multipurpose'),
		'section' => 'breadcrumb',
		'settings' => 'breadcrumb_pattern', 
		'type' => 'radio',
		'choices' => array(
			-1 => esc_attr__('No pattern', 'multipurpose'),
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

	$wp_customize->add_setting('breadcrumb_color', array());
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'breadcrumb_color', 
		array(
			'label'      => esc_attr__('Breadcrumb background color', 'multipurpose'),
			'section'    => 'breadcrumb',
			'settings'   => 'breadcrumb_color'
		)) 
	);

	$wp_customize->add_setting('breadcrumb_disabled', array('default' => 0));
	$wp_customize->add_control('breadcrumb_disabled', array(
		'label' => esc_attr__('Disable breadcrumb (may be overwritten by post/page settings)', 'multipurpose'),
		'section' => 'breadcrumb',
		'settings' => 'breadcrumb_disabled', 
		'type' => 'radio',
		'choices' => array(
			0 => esc_attr__('Breadcrumb enabled', 'multipurpose'),
			1 => esc_attr__('Breadcrumb disabled', 'multipurpose')
		)
	));
	
}

add_action('customize_register', 'multipurpose_customize_register_breadcrumb');