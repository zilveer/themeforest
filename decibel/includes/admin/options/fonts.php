<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wolf_theme_options[] = array(
	'type' => 'open',
	'label' => __( 'Fonts', 'wolf' ),
);

	$wolf_theme_options[] = array(
		'label' => __( 'Fonts', 'wolf' ),
		'type' => 'section_open',
		'desc' => '',
	);

		$wolf_theme_options[] = array(
			'label' => __( 'Google font loader', 'wolf' ),
			'id' => 'google_fonts',
			'desc' => sprintf( __( 'e.g: %s<br>Hit "save" to see your new fonts in the dropdown fonts list', 'wolf' ), 'Lora:400,700|Open+Sans:400,700' ),
			'type' => 'text',
			'size' => 'long',
			'help' => 'google-fonts',
		);


	$wolf_theme_options[] = array( 'type' => 'section_close' );

	$wolf_theme_options[] = array(
		'label' => __( 'Body', 'wolf' ),
		'type' => 'section_open',
		'desc' => __( 'The default font for your page body', 'wolf' )
	);

		$wolf_theme_options[] = array(
			'label' => __( 'Body font name', 'wolf' ),
			'id' => 'body_font_name',
			'desc' => sprintf( __( 'e.g: %s', 'wolf' ), 'Lora' ),
			'type' => 'text',
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );


	$wolf_theme_options[] = array(
		'label' => __( 'Headings font', 'wolf' ),
		'id' => 'heading',
		'type' => 'font',
		'exclude_params' => array( 'color' ),
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Page title font', 'wolf' ),
		'id' => 'page_title',
		'type' => 'font',
		'exclude_params' => array( 'color' ),
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Menu font', 'wolf' ),
		'id' => 'menu',
		'type' => 'font',
		'exclude_params' => array( 'color' ),
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Entry meta font', 'wolf' ),
		'id' => 'entry_meta',
		'type' => 'font',
		'exclude_params' => array( 'color', 'letter_spacing' ),
	);

$wolf_theme_options[] = array( 'type' => 'close' );
