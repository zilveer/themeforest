<?php
function multipurpose_customize_register_typography($wp_customize) {
	$wp_customize->add_section( 'typography', array(
	    'title'    => esc_attr__( 'Typography', 'multipurpose' ),
	    'type'     => 'theme_mod',
	    'priority' => 45
	) );

	$wp_customize->add_setting('primary_font', array('default' => 0));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'primary_font', array(
		'label' => esc_attr__('Basic font', 'multipurpose'),
		'section' => 'typography',
		'settings' => 'primary_font',
		'type' => 'select',
		'choices' => array(
			0 => esc_attr__('Default (Arial)', 'multipurpose'),
			'google' => 'Google Font',
			'Arial, Helvetica, sans-serif' => 'Arial',
			'"Arial Black", Gadget, sans-serif' => 'Arial Black',
			'"Comic Sans MS", cursive' => 'Comic Sans MS',
			'"Courier New", monospace' => 'Courier New',
			'Georgia, serif' => 'Georgia',
			'Impact, Charcoal, sans-serif' => 'Impact',
			'"Lucida Console", Monaco, monospace' => 'Lucida Console',
			'"Lucida Sans Unicode", "Lucida Grande", sans-serif' => 'Lucida Sans Unicode',
			'"Open Sans", sans-serif' => 'Open Sans',
			'"Palatino Linotype", "Book Antiqua", Palatino, serif' => 'Palatino Linotype',
			'Tahoma, Geneva, sans-serif' => 'Tahoma',
			'"Times New Roman", Times, serif' => 'Times New Roman',
			'"Trebuchet MS", sans-serif' => 'Trebuchet MS',
			'Verdana, Geneva, sans-serif' => 'Verdana',
			'"MS Sans Serif", Geneva, sans-serif' => 'MS Sans Serif',
			'"MS Serif", "New York", serif' => 'MS Serif'
		)
	) ) );
	$wp_customize->add_setting('primary_google_font', array('default' => ''));
	$wp_customize->add_control('primary_google_font', array(
		'label' => esc_attr__('Basic font (from Google Fonts)', 'multipurpose'),
		'section' => 'typography',
		'settings' => 'primary_google_font'
	));
	$wp_customize->add_setting('secondary_font', array('default' => 0));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'secondary_font', array(
		'label' => esc_attr__('Font for headings, navigation etc', 'multipurpose'),
		'section' => 'typography',
		'settings' => 'secondary_font',
		'type' => 'select',
		'choices' => array(
			0 => esc_attr__('Default (Signika)', 'multipurpose'),
			'google' => 'Google Font',
			'Arial, Helvetica, sans-serif' => 'Arial',
			'"Arial Black", Gadget, sans-serif' => 'Arial Black',
			'"Comic Sans MS", cursive' => 'Comic Sans MS',
			'"Courier New", monospace' => 'Courier New',
			'Georgia, serif' => 'Georgia',
			'Impact, Charcoal, sans-serif' => 'Impact',
			'"Lucida Console", Monaco, monospace' => 'Lucida Console',
			'"Lucida Sans Unicode", "Lucida Grande", sans-serif' => 'Lucida Sans Unicode',
			'"Open Sans", sans-serif' => 'Open Sans',
			'"Palatino Linotype", "Book Antiqua", Palatino, serif' => 'Palatino Linotype',
			'Tahoma, Geneva, sans-serif' => 'Tahoma',
			'"Times New Roman", Times, serif' => 'Times New Roman',
			'"Trebuchet MS", sans-serif' => 'Trebuchet MS',
			'Verdana, Geneva, sans-serif' => 'Verdana',
			'"MS Sans Serif", Geneva, sans-serif' => 'MS Sans Serif',
			'"MS Serif", "New York", serif' => 'MS Serif'
		)
	) ) );
	$wp_customize->add_setting('secondary_google_font', array());
	$wp_customize->add_control('secondary_google_font', array(
		'label' => esc_attr__('Font for headings, navigation etc (from Google)', 'multipurpose'),
		'section' => 'typography',
		'settings' => 'secondary_google_font'
	));
}

add_action('customize_register', 'multipurpose_customize_register_typography');	