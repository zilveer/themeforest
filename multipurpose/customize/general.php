<?php
function multipurpose_customize_register_general($wp_customize) {
	$wp_customize->add_section('general', array(
		'title' => esc_attr__('General', 'multipurpose'),
		'priority' => 5
	));

	/*
	 * Logo
	 */

	$wp_customize->add_setting( 'logo_file' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_file', array(
	    'label'    => esc_attr__( 'Logo Upload', 'multipurpose' ),
	    'section'  => 'general',
	    'settings' => 'logo_file',
	    'priority' => '1'
	) ) );

	$wp_customize->add_setting('logo_width', array());
	$wp_customize->add_control('logo_width', array(
	    'label' => esc_attr__('Logo width: ', 'multipurpose'),
	    'section' => 'general',
	    'settings' => 'logo_width',
	    'priority' => '2'
	));

	$wp_customize->add_setting('logo_height', array());
	$wp_customize->add_control('logo_height', array(
	    'label' => esc_attr__('Logo height: ', 'multipurpose'),
	    'section' => 'general',
	    'settings' => 'logo_height',
	    'priority' => '3'
	));

	/*
	 * Favicon
	 */

	$wp_customize->add_setting( 'favicon' );
	$wp_customize->add_control( new Multipurpose_Customize_Image_Media_Library_Control( $wp_customize, 'favicon', array(
	    'label'    => esc_attr__( 'Favicon upload', 'multipurpose' ),
	    'section'  => 'general',
	    'settings' => 'favicon'
	) ) );

	/*
	 * Fancy borders
	 */

	$wp_customize->add_setting('fancy_borders_disabled', array('default' => 0));
	$wp_customize->add_control('fancy_borders_disabled', array(
		'label' => esc_attr__('Fancy borders on images', 'multipurpose'),
		'section' => 'general',
		'settings' => 'fancy_borders_disabled', 
		'type' => 'radio',
		'choices' => array(
			0 => esc_attr__('Enabled (default)', 'multipurpose'),
			1 => esc_attr__('Disabled', 'multipurpose')
		)
	));

	/*
	 * Headings: h2, widgets...
	 */

	$wp_customize->add_setting('underlined_heading_style', array('default' => 1));
	$wp_customize->add_control('underlined_heading_style', array(
		'label' => esc_attr__('Choose heading style for underlined H2 and widget titles', 'multipurpose'),
		'section' => 'general',
		'settings' => 'underlined_heading_style', 
		'type' => 'radio',
		'choices' => array(
			1 => esc_attr__('Heading style 1', 'multipurpose'),
			2 => esc_attr__('Heading style 2', 'multipurpose'),
			3 => esc_attr__('Heading style 3', 'multipurpose'),
			4 => esc_attr__('Heading style 4', 'multipurpose'),
			5 => esc_attr__('Heading style 5', 'multipurpose'),
			6 => esc_attr__('Heading style 6', 'multipurpose'),
			7 => esc_attr__('Heading style 7', 'multipurpose'),
			8 => esc_attr__('Heading style 8', 'multipurpose'),
			9 => esc_attr__('Heading style 9', 'multipurpose'),
			10 => esc_attr__('Heading style 10', 'multipurpose')
		)
	));

	/*
	 * Web analytics
	 */

	$wp_customize->add_setting('ga_code', array());
	$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'ga_code', array(
		'label' => esc_attr__('Google Analytics tracking code', 'multipurpose'),
		'section' => 'general',
		'settings' => 'ga_code'
	) ) );


	/*
	 * Custom CSS
	 */

	$wp_customize->add_setting('custom_css', array());
	$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'custom_css', array(
		'label' => esc_attr__('Custom css code (make sure you know what you\'re doing)', 'multipurpose'),
		'section' => 'general',
		'settings' => 'custom_css'
	) ) );

	

}

add_action('customize_register', 'multipurpose_customize_register_general');