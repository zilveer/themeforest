<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wolf_theme_options[] = array(
	'type' => 'open',
	'label' => __( 'Misc', 'wolf'  )
);

	$wolf_theme_options[] = array(
		'label' => __( 'Misc', 'wolf' ),
		'type' => 'section_open',
	);

		$wolf_theme_options[] = array(
			'label' => __( 'Page transition', 'wolf' ),
			'id' => 'page_transition',
			'type' => 'select',
			'desc' => __( 'Enable page fade transition animation.', 'wolf' ),
			'options' => array(
				'yes' => __( 'Yes', 'wolf' ),
				'' => __( 'No', 'wolf' ),
			),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Loading overlay color', 'wolf' ),
			'id' => 'loading_overlay_color',
			'type' => 'colorpicker',
			'dependency' => array( 'element' => 'page_transition', 'value' => array( 'yes' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Loader', 'wolf' ),
			'id' => 'loader',
			'desc' => __( 'Spinner animation.', 'wolf' ),
			'type' => 'select',
			'options' => array(
				'yes' => __( 'Yes', 'wolf' ),
				'' => __( 'No', 'wolf' ),
			),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Loader', 'wolf' ),
			'id' => 'loader_type',
			'desc' => __( 'Choose', 'wolf' ),
			'help' => 'loaders',
			'type' => 'select',
			'options' => array(
				'loader1' => __( 'Square (1)', 'wolf' ),
				'loader2' => __( 'Double Pulse (2)', 'wolf' ),
				'loader3' => __( 'Stripes (3)', 'wolf' ),
				'loader4' => __( 'Rotating Squares (4)', 'wolf' ),
				'loader5' => __( 'Pulse (5)', 'wolf' ),
				'loader6' => __( '2 Rotating Circles (6)', 'wolf' ),
				'loader7' => __( 'Wave (7)', 'wolf' ),
				'loader8' => __( 'Classic Loader (8)', 'wolf' ),
			),
			'dependency' => array( 'element' => 'loader', 'value' => array( 'yes' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Spinner color', 'wolf' ),
			'id' => 'spinner_color',
			'type' => 'colorpicker',
			'dependency' => array( 'element' => 'loader', 'value' => array( 'yes' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Disable back to top arrow', 'wolf' ),
			'id' => 'no_back_to_top_animation',
			'type' => 'checkbox',
		);

		$wolf_theme_options[] = array(

			'label' => __( 'Admin login logo', 'wolf' ),
			'id' => 'login_logo',
			'desc' => '80px x 80 px',
			'type' => 'image',

		);

		$wolf_theme_options[] = array(

			'label' => __( '404 background', 'wolf' ),
			'id' => '404_bg',
			'type' => 'image',

		);

		$wolf_theme_options[] = array(
			'label' => __( 'Custom default avatar (80px X 80px)', 'wolf' ),
			'id' => 'custom_avatar',
			'desc' => sprintf( __( 'Once uploaded and saved, select your new avatar in the <a href="%s">discussion settings</a>', 'wolf' ), esc_url( admin_url( 'options-discussion.php' ) ) ),
			'type' => 'image',
			'help' => 'custom-avatar'

		);

		$wolf_theme_options[] = array(
			'label' => __( 'Enable parallax on mobile devices (not recommended)', 'wolf' ),
			'id' => 'enable_parallax_on_mobile',
			'desc' => '',
			'type' => 'checkbox',
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Enable animation on mobile devices (not recommended)', 'wolf' ),
			'id' => 'enable_animation_on_mobile',
			'desc' => '',
			'type' => 'checkbox',
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Use minified CSS files', 'wolf' ),
			'id' => 'css_min',
			'type' => 'checkbox',
			'desc' => sprintf( __( 'Disable this option if you want to edit the %s files.', 'wolf' ), 'CSS' ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Use minified JS files', 'wolf' ),
			'id' => 'js_min',
			'type' => 'checkbox',
			'desc' => sprintf( __( 'Disable this option if you want to edit the %s files.', 'wolf' ), 'JS' ),
		);

		// $wolf_theme_options[] = array(
		// 	'label' => __( 'Enlable RTL support', 'wolf' ),
		// 	'id' => 'rtl',
		// 	'type' => 'checkbox',
		// );

	$wolf_theme_options[] = array( 'type' => 'section_close' );

$wolf_theme_options[] = array( 'type' => 'close' );
