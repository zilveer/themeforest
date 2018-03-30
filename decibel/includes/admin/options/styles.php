<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wolf_theme_options[] = array(
	'type' => 'open',
	'label' => __( 'Styles', 'wolf' ),
);

	$wolf_theme_options['styles_head'] = array(
		'label' => __( 'Default Styles', 'wolf' ),
 		'type' => 'section_open',
 		'desc' => __( 'Here you can set the styles for your website.', 'wolf' )
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Accent color', 'wolf' ),
		'id' =>'accent_color',
		'type' => 'colorpicker',
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Layout', 'wolf' ),
		'id' => 'layout',
		'type' => 'select',
		'options' => array(
			'wide' => __( 'Wide', 'wolf' ),
			'boxed' => __( 'Boxed', 'wolf' ),
		),
	);

	$wolf_theme_options[] = array( 'type' => 'section_close' );

	$wolf_theme_options[] = array(
		'label' => __( 'Body background', 'wolf' ),
		'desc' => __( 'Visible only in boxed layout mode', 'wolf' ),
		'id' => 'body_bg',
		'type' => 'background',
		'font_color' => false,
		'bg_attachment' => true,
	);

	// $wolf_theme_options[] = array(
	// 	'label' => __( 'Page background', 'wolf' ),
	// 	'id' => 'page_bg',
	// 	'type' => 'background',
	// );

$wolf_theme_options[] = array( 'type' => 'close' );