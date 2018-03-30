<?php
function multipurpose_customize_register_footer($wp_customize) {
	$wp_customize->add_section('footer', array(
		'title' => esc_attr__('Footer', 'multipurpose'),
		'priority' => 30
	));

	$wp_customize->add_setting('column_count', array('default' => 4));
	$wp_customize->add_control('column_count', array(
		'priority' => 1,
		'label' => esc_attr__('Number of columns', 'multipurpose'),
		'section' => 'footer',
		'settings' => 'column_count', 
		'type' => 'radio',
		'choices' => array(
			1 => esc_attr__('One column', 'multipurpose'),
			2 => esc_attr__('Two columns', 'multipurpose'),
			3 => esc_attr__('Three columns', 'multipurpose'),
			4 => esc_attr__('Four columns', 'multipurpose')
		)
	));

	$wp_customize->add_setting('footer_bg_color', array());
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'footer_bg_color', 
		array(
			'priority' => 2,
			'label'      => esc_attr__('Footer background color', 'multipurpose'),
			'section'    => 'footer',
			'settings'   => 'footer_bg_color'
		)) 
	);

	$wp_customize->add_setting('footer_pattern', array('default' => 0));
	$wp_customize->add_control('footer_pattern', array(
		'priority' => 3,
		'label' => esc_attr__('Footer background pattern', 'multipurpose'),
		'section' => 'footer',
		'settings' => 'footer_pattern', 
		'type' => 'radio',
		'choices' => array(
			0 => esc_attr__('Default', 'multipurpose'),
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

	/*
	 * "go to top" link
	 */

	$wp_customize->add_setting('disable_top_link', array('default' => 0));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'disable_top_link',
        array(
			'priority' => 4,
            'label'     => esc_attr__('"Go to top" link disabled', 'multipurpose'),
            'section'   => 'footer',
            'settings'  => 'disable_top_link',
            'type'      => 'checkbox'
        )
	));

	//Show custom footer content
	$wp_customize->add_setting('show_footer_content', array(
		'default' => 0,
		'sanitize_callback' => ''
	));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'show_footer_content',
        array(
			'priority' => 4,
            'label'     => __('Show custom footer content', 'multipurpose'),
            'section'   => 'footer',
            'settings'  => 'show_footer_content',
            'type'      => 'checkbox'
        )
	));
	
	//Footer Content
	$wp_customize->add_setting('footer_content', array(
		'default' => '<p>2012-2016 <a href="http://themeforest.net/item/multipurpose-responsive-wordpress-theme/9219359">MultiPurpose</a> WordPress Theme by <a href="http://thememotive.com/">ThemeMotive</a> | All rights reserved.</p>',
		'sanitize_callback' => ''
	));
	$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'footer_content', array(
		'priority' => 6,
		'label' => __('Footer Content', 'multipurpose'),
		'section' => 'footer',
		'settings' => 'footer_content'
	) ) );		
	
}

add_action('customize_register', 'multipurpose_customize_register_footer');