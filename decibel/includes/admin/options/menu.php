<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$page_option = array( '' => __( 'Disabled', 'wolf' ) );
$pages = get_pages();

foreach ( $pages as $page ) {
	$page_option[ absint( $page->ID ) ] = sanitize_text_field( $page->post_title );
}

$wolf_theme_options[] = array(
	'type' => 'open',
	'label' => __( 'Menu', 'wolf' )
);

	$wolf_theme_options[] = array(
		'label' => __( 'Menu settings', 'wolf' ),
 		'type' => 'section_open',
	);

		$wolf_theme_options[] = array(
			'label' => __( 'Main menu color tone', 'wolf' ),
			'id' => 'menu_skin',
			'type' => 'select',
			'options' => array(
				'light' => __( 'light', 'wolf' ),
				'dark' => __( 'dark', 'wolf' ),
			),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Menu type', 'wolf' ),
			'id' => 'menu_position',
			'type' => 'select',
			'options' => array(
				'default' => __( 'default', 'wolf' ),
				//'center' => __( 'centered', 'wolf' ),
				'logo-centered' => __( 'logo centered', 'wolf' ),
				'left' => __( 'at left', 'wolf' ),
				//'modern' => __( 'modern minimalist', 'wolf' ),
				'' => __( 'disable main menu', 'wolf' ),
			),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Transparent menu when full screen header', 'wolf' ),
			'id' => 'left_menu_transparency',
			'type' => 'checkbox',
			'dependency' => array( 'element' => 'menu_position', 'value' => array( 'left' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Menu socials', 'wolf' ),
			'id' => 'menu_socials_services',
			'desc' => __( 'Enter the social networks names separated by a comma. e.g "twitter, facebook, instagram". ( see social links tab).', 'wolf' ),
			'type' => 'text',
			'dependency' => array( 'element' => 'menu_position', 'value' => array( 'default', 'logo-centered', 'left' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Logo overflow', 'wolf' ),
			'id' => 'logo_overflow',
			'type' => 'checkbox',
			'dependency' => array( 'element' => 'menu_position', 'value' => array( 'logo-centered' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Sticky menu', 'wolf' ),
			'id' => 'sticky_menu',
			'type' => 'checkbox',
			'dependency' => array( 'element' => 'menu_position', 'value' => array( 'default', 'center', 'logo-centered' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Menu width', 'wolf' ),
			'id' => 'menu_width',
			'type' => 'select',
			'options' => array(
				'boxed' => __( 'boxed', 'wolf' ),
				'wide' => __( 'wide', 'wolf' ),
			),
			'dependency' => array( 'element' => 'menu_position', 'value' => array( 'default', 'center' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Sub menu alignment', 'wolf' ),
			'id' => 'submenu_align',
			'type' => 'select',
			'options' => array(
				'left-align' => __( 'left', 'wolf' ),
				'right-align' => __( 'right', 'wolf' ),
			),
			'dependency' => array( 'element' => 'menu_position', 'value' => array( 'default', 'center' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Menu style', 'wolf' ),
			'id' => 'menu_style',
			'type' => 'select',
			'options' => array(
				'transparent' => __( 'transparent', 'wolf' ),
				'semi-transparent' => __( 'semi-transparent', 'wolf' ),
				'plain' => __( 'plain', 'wolf' ),
			),
			'dependency' => array( 'element' => 'menu_position', 'value' => array( 'default', 'center', 'logo-centered' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Menu hover effect', 'wolf' ),
			'id' => 'menu_hover_effect',
			'type' => 'select',
			'type' => 'select',
			'options' => array(
				'default' => __( 'none', 'wolf' ),
				'text-color' => __( 'text color', 'wolf' ),
				'border-top' => __( 'border top', 'wolf' ),
				'plain-color' => __( 'plain color', 'wolf' ),
			),
			'dependency' => array( 'element' => 'menu_position', 'value' => array( 'default', 'center', 'logo-centered' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Sub menu background color', 'wolf' ),
			'id' => 'sub_menu_bg_color',
			'type' => 'colorpicker',
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Sub menu color', 'wolf' ),
			'id' => 'sub_menu_color',
			'type' => 'colorpicker',
		);

		$wolf_theme_options[] = array(
			'label' => __( 'One page main page', 'wolf' ),
			'id' => 'one_page_menu',
			'desc' => sprintf( __( 'Will you use anchors in your menu to create a one-page website? <br><a href="%s">See the doc</a>', 'wolf' ), 'http://docs.wolfthemes.com/documentation/themes/' . wolf_get_theme_slug() . '#one-page' ),
			'type' => 'select',
			'options' => $page_option,
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Menu breakpoint in pixels', 'wolf' ),
			'desc' => __( 'Below each width would you like to display the mobile menu? 0 will always show the desktop menu and 99999 will always show the mobile menu.', 'wolf' ),
			'id' => 'breakpoint',
			'type' => 'int',
			'dependency' => array( 'element' => 'menu_position', 'value' => array( 'default', 'center', 'left', 'logo-centered' ) ),
		);


		if ( class_exists( 'WooCommerce' ) ) {

			$wolf_theme_options[] =array( 'label' => __( 'Display WooCommerce cart menu item', 'wolf' ),
				'id' => 'cart_menu_item',
				'type' => 'checkbox',
			);
		}

		$wolf_theme_options[] = array(
			'label' => __( 'Search icon', 'wolf' ),
			'id' => 'search_menu_item',
			'type' => 'checkbox',
			'desc' => __( 'Display search icon in the menu', 'wolf' ),
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );


	$wolf_theme_options[] = array(
		'label' => __( 'Secondary', 'wolf' ),
 		'type' => 'section_open',
 		'dependency' => array( 'element' => 'menu_position', 'value' => array( 'default', 'center', 'logo-centered' ) ),
	);

		$wolf_theme_options[] = array(
			'label' => __( 'Enable secondary menu', 'wolf' ),
			'id' => 'additional_toggle_menu',
			'type' => 'select',
			'options' => array(
				'' => __( 'No', 'wolf' ),
				'yes' => __( 'Yes', 'wolf' ),
			),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Text before the secondary menu item', 'wolf' ),
			'id' => 'toggle_side_menu_item_text',
			'type' => 'text',
			'desc' => __( 'Optional text to display before the secondary menu icon in the main menu', 'wolf' )
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Secondary menu type', 'wolf' ),
			'id' => 'additional_toggle_menu_type',
			'type' => 'select',
			'options' => array(
				'side' => __( 'Side Panel', 'wolf' ),
				'overlay' => __( 'Overlay', 'wolf' ),
			),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Overlay menu background color', 'wolf' ),
			'id' => 'overlay_menu_bg',
			'type' => 'colorpicker',
			'dependency' => array( 'element' => 'additional_toggle_menu_type', 'value' => array( 'overlay' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Overlay menu font color', 'wolf' ),
			'id' => 'overlay_menu_color',
			'type' => 'colorpicker',
			'dependency' => array( 'element' => 'additional_toggle_menu_type', 'value' => array( 'overlay' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Overlay menu background opacity', 'wolf' ),
			'id' => 'overlay_menu_bg_opacity',
			'type' => 'int',
			'dependency' => array( 'element' => 'additional_toggle_menu_type', 'value' => array( 'overlay' ) ),
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );

$wolf_theme_options[] = array( 'type' => 'close' );