<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wolf_theme_options[] = array(
	'type' => 'open',
	'label' => __( 'Footer', 'wolf' ),
);

$wolf_theme_options[] = array(
	'label' => __( 'Footer', 'wolf' ),
	'type' => 'section_open',
	//'desc' => __( 'An additional content area just above the footer that will be displayed on every page', 'wolf' ),
);

	$wolf_theme_options[] = array(
		'label' => __( 'Display bottom social icons', 'wolf' ),
		'id' => 'bottom_socials',
		'type' => 'select',
		'options' => array(
			'yes' => __( 'Yes', 'wolf' ),
			'' => __( 'No', 'wolf' ),
		),
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Services', 'wolf' ),
		'id' => 'bottom_socials_services',
		'desc' => __( 'Enter the service names separated by a comma. e.g "twitter, facebook, instagram". Leave empty to display them all (Social links tab).', 'wolf' ),
		'type' => 'text',
		'dependency' => array( 'element' => 'bottom_socials', 'value' => array( 'yes' ) ),
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Copyright text', 'wolf' ),
		'id' => 'copyright_textbox',
		'desc' => __( 'Will appear at the very bottom of the page', 'wolf' ),
		'type' => 'text',
	);

	// $wolf_theme_options[] = array(
	// 	'label' => __( 'Uncover Effect', 'wolf' ),
	// 	'id' => 'footer_uncover',
	// 	'type' => 'checkbox',
	// );

	// $wolf_theme_options[] = array(
	// 	'label' => __( 'Content Editor', 'wolf' ),
	// 	'desc' => __( 'Any content to display above the footer: text, HTML, shortcodes...', 'wolf' ),
	// 	'id' => 'footer_holder_content',
	// 	'type' => 'editor'
	// );


$wolf_theme_options[] = array( 'type' => 'section_close' );

// $wolf_theme_options[] = array( 
// 	'label' => __( 'Footer Holder Background', 'wolf' ),
// 	'desc' => __( 'A different header background can be set on each page', 'wolf' ),
// 	'id' =>'footer_holder_bg',
// 	'type' => 'background',
// 	'font_color' => true,
// 	'parallax' => true,
// );

// $wolf_theme_options[] = array(
// 	'label' => __( 'Overlay', 'wolf' ),
// 		'type' => 'section_open',
// );

// $wolf_theme_options[] = array(
// 	'label' => __( 'Overlay Color', 'wolf' ),
// 	'id' =>'footer_holder_overlay_color',
// 	'type' => 'colorpicker',
// );

// $wolf_theme_options[] = array(
// 	'label' => __( 'Overlay Pattern', 'wolf' ),
// 	'id' =>'footer_holder_overlay_img',
// 	'type' => 'image',
// );

// $wolf_theme_options[] = array(
// 	'label' => __( 'Overlay Opacity in percent', 'wolf' ),
// 	'desc' => __( 'A different footer_holder background can be set on each page', 'wolf' ),
// 	'id' =>'footer_holder_overlay_opacity',
// 	'type' => 'int',
// );

// $wolf_theme_options[] = array( 'type' => 'section_close' );


$wolf_theme_options[] = array( 'type' => 'close' );