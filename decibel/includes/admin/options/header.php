<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$wolf_theme_options[] = array(
	'type' => 'open',
	'label' => __( 'Header', 'wolf' ),
);

	$wolf_theme_options[] = array(
		'label' => __( 'Page header', 'wolf' ),
 		'type' => 'section_open',
	);

		$wolf_theme_options[] = array(
			'label' => __( 'Page header type', 'wolf' ),
			'id' =>'page_header_type',
			'type' => 'select',
			'options' => array(
				'big' => __( 'Centered page title big height', 'wolf' ),
				'medium' => __( 'Centered page title', 'wolf' ),
				'small' => __( 'Breadcrumb + page title', 'wolf' ),
				'full' => __( 'Full screen', 'wolf' ),
				'none' => __( 'No page title area', 'wolf' ),
			),
			'desc' => __( 'It can be overwritten in category options and single post options', 'wolf' ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Page title font size', 'wolf' ),
			'id' =>'page_title_font_size',
			'type' => 'text',
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );

	$wolf_theme_options[] = array(
		'label' => __( 'Top bar', 'wolf' ),
 		'type' => 'section_open',
	);

		$wolf_theme_options[] = array(
			'label' => __( 'Display top bar', 'wolf' ),
			'id' =>'top_bar',
			'type' => 'select',
			'desc' => __( 'It won\'t be visible below the mobile menu breaking point (see the menu tab)', 'wolf' ),
			'options' => array(
				'' => __( 'No', 'wolf' ),
				'yes' => __( 'Yes', 'wolf' ),
			),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Top Bar socials', 'wolf' ),
			'id' => 'top_bar_socials_services',
			'desc' => __( 'Enter the social networks names separated by a comma. e.g "twitter, facebook, instagram". ( see social links tab).', 'wolf' ),
			'type' => 'text',
			'dependency' => array( 'element' => 'top_bar', 'value' => array( 'yes' ) ),
		);

		if ( function_exists( 'icl_get_languages' ) ) {
			$wolf_theme_options[] = array(
				'label' => __( 'Flags in top bar', 'wolf' ),
				'id' =>'top_bar_flags',
				'type' => 'select',
				'options' => array(
					'' => __( 'No', 'wolf' ),
					'list' => __( 'Flag list', 'wolf' ),
					'dropdown' => __( 'Flag dropdown', 'wolf' ),
				),
				'dependency' => array( 'element' => 'top_bar', 'value' => array( 'yes' ) ),
			);
		}

		$wolf_theme_options[] = array(
			'label' => __( 'Top bar contact infos', 'wolf' ),
			'id' =>'top_bar_content',
			'type' => 'text',
			'size' => 'long',
			'dependency' => array( 'element' => 'top_bar', 'value' => array( 'yes' ) ),
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );

$wolf_theme_options[] = array( 'type' => 'close' );
