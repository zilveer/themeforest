<?php
function multipurpose_customize_register_colors($wp_customize) {
    $wp_customize->get_section('colors')->priority = 50;

    $wp_customize->add_setting('color_scheme', array('default' => 0));
    $wp_customize->add_control('color_scheme', array(
	  'priority' => 1,
      'label' => esc_attr__('Choose color scheme', 'multipurpose'),
      'section' => 'colors',
      'settings' => 'color_scheme', 
      'type' => 'radio',
      'choices' => array(
        0 => esc_attr__('Orange (Default)', 'multipurpose'),
        'azure' => esc_attr__('Azure', 'multipurpose'),
        'black' => esc_attr__('Black', 'multipurpose'),
        'blue' => esc_attr__('Blue', 'multipurpose'),
        'brown' => esc_attr__('Brown', 'multipurpose'),
        'gray' => esc_attr__('Gray', 'multipurpose'),
        'green' => esc_attr__('Green', 'multipurpose'),
        'pink' => esc_attr__('Pink', 'multipurpose'),
        'purple' => esc_attr__('Purple', 'multipurpose'),
        'red' => esc_attr__('Red', 'multipurpose'),
        /*'silver' => esc_attr__('Silver', 'multipurpose'),*/
        /*'tan' => esc_attr__('Tan', 'multipurpose'),*/
        'turquoise' => esc_attr__('Turquoise', 'multipurpose'),
        'yellow' => esc_attr__('Yellow', 'multipurpose'),
		'custom' => esc_attr__('Custom Colors', 'multipurpose')
      )
    ));
	
	$wp_customize->add_setting('custom_color_1', array(
		'default' => '#ff8400'
	));
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'custom_color_1', 
		array(
			'priority' => 2,
			'label'      => esc_attr__('Main color', 'multipurpose'),
			'section'    => 'colors',
			'settings'   => 'custom_color_1'
		)) 
	);
	
	$wp_customize->add_setting('custom_color_2', array(
		'default' => '#d97000'
	));
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'custom_color_2', 
		array(
			'priority' => 3,
			'label'      => esc_attr__('Main color dark', 'multipurpose'),
			'section'    => 'colors',
			'settings'   => 'custom_color_2'
		)) 
	);
	$wp_customize->add_setting('custom_color_3', array(
		'default' => '#ff9f00'
	));
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'custom_color_3', 
		array(
			'priority' => 4,
			'label'      => esc_attr__('Button background color', 'multipurpose'),
			'section'    => 'colors',
			'settings'   => 'custom_color_3'
		)) 
	);
	$wp_customize->add_setting('custom_color_4', array(
		'default' => '#ff7100'
	));
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'custom_color_4', 
		array(
			'priority' => 5,
			'label'      => esc_attr__('Button bottom gradient color', 'multipurpose'),
			'section'    => 'colors',
			'settings'   => 'custom_color_4'
		)) 
	);
	$wp_customize->add_setting('custom_color_5', array(
		'default' => '#de6200'
	));
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'custom_color_5', 
		array(
			'priority' => 6,
			'label'      => esc_attr__('Button border color and text shadow', 'multipurpose'),
			'section'    => 'colors',
			'settings'   => 'custom_color_5'
		)) 
	);
}

add_action('customize_register', 'multipurpose_customize_register_colors');