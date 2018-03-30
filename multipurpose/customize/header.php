<?php
function multipurpose_customize_register_header($wp_customize) {
	
	$wp_customize->add_section('header', array(
		'title' => esc_attr__('Header', 'multipurpose'),
		'priority' => 15
	));

	$wp_customize->add_setting('sticky_disabled', array('default' => 1));
	$wp_customize->add_control('sticky_disabled', array(
		'label' => esc_attr__('Disable sticky header', 'multipurpose'),
		'section' => 'header',
		'settings' => 'sticky_disabled', 
		'type' => 'radio',
		'choices' => array(
			0 => esc_attr__('Sticky header enabled with top bar', 'multipurpose'),
			1 => esc_attr__('Sticky header enabled without top bar', 'multipurpose'),
			2 => esc_attr__('Sticky header disabled', 'multipurpose')
		)
	));

	$wp_customize->add_setting('sticky_header_transparency', array('default' => 1));
	$wp_customize->add_control('sticky_header_transparency', array(
		'label' => esc_attr__('Sticky header with transparent background', 'multipurpose'),
		'section' => 'header',
		'settings' => 'sticky_header_transparency', 
		'type' => 'radio',
		'choices' => array(
			0 => esc_attr__('Disabled', 'multipurpose'),
			1 => esc_attr__('Enabled', 'multipurpose')
		)
	));

	$wp_customize->add_setting('hide_top', array('default' => 2));
	$wp_customize->add_control('hide_top', array(
		'label' => esc_attr__('Disable top bar', 'multipurpose'),
		'section' => 'header',
		'settings' => 'hide_top', 
		'type' => 'radio',
		'choices' => array(
			1 => esc_attr__('Top bar visible', 'multipurpose'),
			2 => esc_attr__('Top bar hidden', 'multipurpose')
		)
	));

	$wp_customize->add_setting('header_layout', array('default' => 3));
	$wp_customize->add_control('header_layout', array(
		'label' => esc_attr__('Choose header layout', 'multipurpose'),
		'section' => 'header',
		'settings' => 'header_layout', 
		'type' => 'radio',
		'choices' => array(
			1 => esc_attr__('Header 1', 'multipurpose'),
			2 => esc_attr__('Header 2', 'multipurpose'),
			3 => esc_attr__('Header 3', 'multipurpose'),
			4 => esc_attr__('Header 4', 'multipurpose'),
			5 => esc_attr__('Header 5', 'multipurpose'),
			6 => esc_attr__('Header 6', 'multipurpose'),
			7 => esc_attr__('Header 7', 'multipurpose'),
			8 => esc_attr__('Header 8', 'multipurpose'),
			9 => esc_attr__('Header 9', 'multipurpose'),
			10 => esc_attr__('Header 10', 'multipurpose'),
			11 => esc_attr__('Header 11', 'multipurpose'),
			12 => esc_attr__('Header 12', 'multipurpose'),
			13 => esc_attr__('Header 13', 'multipurpose'),
			14 => esc_attr__('Header 14', 'multipurpose'),
			15 => esc_attr__('Header 15', 'multipurpose')
		)
	));

	$wp_customize->add_setting('top_links', array('default' => 'menu'));
	$wp_customize->add_control('top_links', array(
		'label' => esc_attr__('What to display in top bar?', 'multipurpose'),
		'section' => 'header',
		'settings' => 'top_links', 
		'type' => 'radio',
		'choices' => array(
			'menu' => esc_attr__('Secondary navigation', 'multipurpose'),
			'social' => esc_attr__('Social links', 'multipurpose'),
			'search' => esc_attr__('Search form', 'multipurpose')
		)
	));

	$wp_customize->add_setting('top_header_msg', array());
	$wp_customize->add_control('top_header_msg', array(
		'label' => esc_attr__('Top header message', 'multipurpose'),
		'section' => 'header',
		'settings' => 'top_header_msg'
	));

	$wp_customize->add_setting('main_header_msg', array());
	$wp_customize->add_control('main_header_msg', array(
		'label' => esc_attr__('Main header message', 'multipurpose'),
		'section' => 'header',
		'settings' => 'main_header_msg'
	));
}

add_action('customize_register', 'multipurpose_customize_register_header');