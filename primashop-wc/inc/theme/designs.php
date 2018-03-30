<?php
/**
 * Setup theme specific design settings
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Setup
 * @subpackage Design
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Customize default theme customizer position.
 *
 * Default priority
 * title_tagline		- 20
 * colors				- 40
 * header_image 		- 60
 * background_image 	- 80
 * nav 					- 100
 * static_front_page 	- 120
 *
 * @since PrimaThemes 2.0
 */
add_action( 'customize_register', 'prima_design_settings_customize' );
function prima_design_settings_customize( $wp_customize ) {
	if ( !current_theme_supports('prima-design-settings') ) 
		return;
	
	/* Move "colors" section after "static_front_page" section */
	$wp_customize->get_section( 'colors' )->priority = 130;
	/* Rename "colors" section title to "Colors and Typography" */
	$wp_customize->get_section( 'colors' )->title = __( 'Colors & Typography', 'primathemes' );
	
	/* Move "background_image" section after "colors" section */
	$wp_customize->get_section( 'background_image' )->priority = 140;
	/* Rename "background_image" section title to "Background" */
	$wp_customize->get_section( 'background_image' )->title = __( 'Background', 'primathemes' );
	/* Move "background_color" control to "background_image" section */
	$wp_customize->get_control( 'background_color' )->section = 'background_image';
	
	/* Move "header_image" section after "header content" section */
	$wp_customize->get_section( 'header_image' )->priority = 154;
	/* Rename "header_image" section title to "Background" */
	$wp_customize->get_section( 'header_image' )->title = __( 'Header Featured (Default)', 'primathemes' );
	/* Remove "header_image" section and using our custom header section */
	// $wp_customize->remove_section('header_image');
	/* Remove "header_textcolor" control and using our custom header section */
	$wp_customize->remove_control('header_textcolor');
	
}

/**
 * Add Style Layout section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_style' );
function prima_design_settings_args_style( $settings ) {
	$settings["section_style_layout"] = array( 
		"name" => __('Style Layout', 'primathemes'),
		"id" => "style_layout",
		"type" => "section",
		"priority" => 121,
		);
	$settings["style"] = array( 
		"name" => __('Style Layout', 'primathemes'),
		"id" => "style",
		"section" => "style_layout",
		"database" => PRIMA_THEME_SETTINGS,
		"type" => "select",
		"default" => "full",
		"options" => array(
			'full' => __('Full', 'primathemes'),
			'boxed' => __('Boxed', 'primathemes'),
			'custom' => __('Custom', 'primathemes'),
			),
		);
	return $settings;
}

/**
 * Add Responsive Layout section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_responsive' );
function prima_design_settings_args_responsive( $settings ) {
	$settings["section_responsive"] = array( 
		"name" => __('Responsive Layout', 'primathemes'),
		"id" => "responsive",
		"type" => "section",
		"priority" => 122,
		);
	$settings["responsive"] = array( 
		"name" => __('Responsive Layout', 'primathemes'),
		"id" => "responsive",
		"section" => "responsive",
		"database" => PRIMA_THEME_SETTINGS,
		"type" => "select",
		"default" => "yes",
		"options" => array(
			'yes' => __('Yes', 'primathemes'),
			'no' => __('No', 'primathemes')
			),
		);
	return $settings;
}

/**
 * Define Google Fonts from Theme Settings.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_fonts', 'prima_fonts_setup_googlefonts' );
function prima_fonts_setup_googlefonts( $fonts ) {
	if ( prima_get_setting('fonts_1_name') || prima_get_setting('fonts_1_url') || prima_get_setting('fonts_1_family') ) {
		$fonts['googlefont1'] = array(
				'id' =>	'googlefont1',
				'type' => 'google',
				'name' => prima_get_setting('fonts_1_name'),
				'fontfamily' => prima_get_setting('fonts_1_family'),
				'googlefonturl' => prima_get_setting('fonts_1_url'),
			);
	}
	if ( prima_get_setting('fonts_2_name') || prima_get_setting('fonts_2_url') || prima_get_setting('fonts_2_family') ) {
		$fonts['googlefont2'] = array(
				'id' =>	'googlefont2',
				'type' => 'google',
				'name' => prima_get_setting('fonts_2_name'),
				'fontfamily' => prima_get_setting('fonts_2_family'),
				'googlefonturl' => prima_get_setting('fonts_2_url'),
			);
	}
	if ( prima_get_setting('fonts_3_name') || prima_get_setting('fonts_3_url') || prima_get_setting('fonts_3_family') ) {
		$fonts['googlefont3'] = array(
				'id' =>	'googlefont3',
				'type' => 'google',
				'name' => prima_get_setting('fonts_3_name'),
				'fontfamily' => prima_get_setting('fonts_3_family'),
				'googlefonturl' => prima_get_setting('fonts_3_url'),
			);
	}
	if ( prima_get_setting('fonts_4_name') || prima_get_setting('fonts_4_url') || prima_get_setting('fonts_4_family') ) {
		$fonts['googlefont4'] = array(
				'id' =>	'googlefont4',
				'type' => 'google',
				'name' => prima_get_setting('fonts_4_name'),
				'fontfamily' => prima_get_setting('fonts_4_family'),
				'googlefonturl' => prima_get_setting('fonts_4_url'),
			);
	}
	return $fonts;
}

/**
 * Add Fonts controls for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_fonts' );
function prima_design_settings_args_fonts( $settings ) {
	$options = array( '' => '' );
	$fonts = prima_fonts();
	if ( $fonts ) {
		foreach ($fonts as $key => $font ) {
			$options[$key] = $font['name'];
		}
	}
	$settings[] = array( 
		"name" => __('Body Font', 'primathemes'),
		"id" => "body_font",
		"type" => "select",
		"default" => "yes",
		"options" => $options,
		);
	$settings[] = array( 
		"name" => __('Heading Font', 'primathemes'),
		"id" => "heading_font",
		"type" => "select",
		"default" => "yes",
		"options" => $options,
		);
	return $settings;
}

/**
 * Enqueue Google Fonts CSS.
 *
 * @since PrimaShop 1.0
 */
add_action( 'wp_enqueue_scripts', 'prima_design_settings_fonts' );
function prima_design_settings_fonts() {
	if ( !current_theme_supports('prima-design-settings') ) return;
	$fonts = prima_fonts();
	$body_font = prima_get_setting('body_font',PRIMA_DESIGN_SETTINGS);
	if ( $body_font && isset($fonts[$body_font]) && isset($fonts[$body_font]['googlefonturl'] ) ) {
		wp_enqueue_style('font-body', $fonts[$body_font]['googlefonturl'], false, null, 'screen, projection');
	}	
	$heading_font = prima_get_setting('heading_font',PRIMA_DESIGN_SETTINGS);
	if ( $heading_font && $heading_font!=$body_font && isset($fonts[$heading_font]) && isset($fonts[$heading_font]['googlefonturl'] ) ) {
		wp_enqueue_style('font-heading', $fonts[$heading_font]['googlefonturl'], false, null, 'screen, projection');
	}	
}


/**
 * Echo Google Fonts stylesheet.
 *
 * @since PrimaShop 1.0
 */
add_action( 'prima_custom_styles', 'prima_design_settings_fonts_stylesheet' );
function prima_design_settings_fonts_stylesheet() {
	if ( !current_theme_supports('prima-design-settings') ) return;
	$fonts = prima_fonts();
	$body_font = prima_get_setting('body_font',PRIMA_DESIGN_SETTINGS);
	if ( $body_font && isset($fonts[$body_font]) && isset($fonts[$body_font]['fontfamily'] ) ) {
		echo 'body { font-family:'.$fonts[$body_font]['fontfamily'].' }';
	}	
	$heading_font = prima_get_setting('heading_font',PRIMA_DESIGN_SETTINGS);
	if ( $heading_font && isset($fonts[$heading_font]) && isset($fonts[$heading_font]['fontfamily'] ) ) {
		echo 'h1,h2,h3,h4,h5,h6 { font-family:'.$fonts[$heading_font]['fontfamily'].' }';
	}	
}

/**
 * Add Basic Typography controls for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_basic' );
function prima_design_settings_args_basic( $settings ) {
	$settings["body_color"] = array( 
		"name" => __('Default Text (Paragraph) Color', 'primathemes'),
		"id" => "body_color",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "body",
		"css_property" => "color",
		);
	$settings["body_heading"] = array( 
		"name" => __('Default Heading Color', 'primathemes'),
		"id" => "body_heading",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "h1,h2,h3,h4,h5",
		"css_property" => "color",
		);
	$settings["body_link"] = array( 
		"name" => __('Default Link Color', 'primathemes'),
		"id" => "body_link",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "a,a:visited",
		"css_property" => "color",
		);
	$settings["body_linkhover"] = array( 
		"name" => __('Default Link Color (Hover)', 'primathemes'),
		"id" => "body_linkhover",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "a:hover",
		"css_property" => "color",
		);
	$settings["body_input_color"] = array( 
		"name" => __('Default Form Input Text Color', 'primathemes'),
		"id" => "body_input_color",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "input, select, textarea",
		"css_property" => "color",
		);
	$settings["body_input_bg"] = array( 
		"name" => __('Default Form Input Background Color', 'primathemes'),
		"id" => "body_input_bg",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "input, select, textarea",
		"css_property" => "background-color",
		);
	$settings["body_input_border"] = array( 
		"name" => __('Default Form Input Border Color', 'primathemes'),
		"id" => "body_input_border",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "input, select, textarea",
		"css_property" => "border-color",
		);
	$settings["body_button_color"] = array( 
		"name" => __('Default Button Text Color', 'primathemes'),
		"id" => "body_button_color",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => 'button, input[type="button"], input[type="reset"], input[type="submit"], #respond input#submit, #comments .reply a',
		"css_property" => "color",
		);
	$settings["body_button_bg"] = array( 
		"name" => __('Default Button Background Color', 'primathemes'),
		"id" => "body_button_bg",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => 'button, input[type="button"], input[type="reset"], input[type="submit"], #respond input#submit, #comments .reply a',
		"css_property" => "background-color",
		);
	$settings["body_button_bg_hover"] = array( 
		"name" => __('Default Button Background Color (Hover)', 'primathemes'),
		"id" => "body_button_bg_hover",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, #respond input#submit:hover, #comments .reply a:hover',
		"css_property" => "background-color",
		);
	$settings["body_line_color"] = array( 
		"name" => __('Default Horizontal Line and Border Color', 'primathemes'),
		"id" => "body_line_color",
		"default" => "",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => 'hr, .ps-hr, .post-blog, .post-blog img, img.entry-image-featured, .widget h3.widget-title, .prima_recent_posts li img, .commentlist li .comment-author img.avatar, .woocommerce #reviews #comments ol.commentlist li .comment-text, .woocommerce-page #reviews #comments ol.commentlist li .comment-text, .woocommerce #reviews #comments ol.commentlist li img.avatar, .woocommerce-page #reviews #comments ol.commentlist li img.avatar, .woocommerce table.shop_attributes th, .woocommerce-page table.shop_attributes th, .woocommerce table.shop_attributes td, .woocommerce-page table.shop_attributes td, .woocommerce table.shop_table, .woocommerce-page table.shop_table, .woocommerce table.shop_table td, .woocommerce-page table.shop_table td, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th, .woocommerce-page table.shop_table tfoot td, .woocommerce-page table.shop_table tfoot th, .woocommerce .cart-collaterals .cart_totals tr td, .woocommerce .cart-collaterals .cart_totals tr th, .woocommerce-page .cart-collaterals .cart_totals tr td, .woocommerce-page .cart-collaterals .cart_totals tr th, .woocommerce ul.cart_list li dl, .woocommerce ul.product_list_widget li dl, .woocommerce-page ul.cart_list li dl, .woocommerce-page ul.product_list_widget li dl, .woocommerce ul.cart_list li img, .woocommerce ul.product_list_widget li img, .woocommerce-page ul.cart_list li img, .woocommerce-page ul.product_list_widget li img, .woocommerce .widget_shopping_cart .total, .woocommerce-page .widget_shopping_cart .total',
		"css_property" => "border-color",
		);
	return $settings;
}

/**
 * Add Boxed Content Background section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_boxed' );
function prima_design_settings_args_boxed( $settings ) {
	$settings["section_boxed_content"] = array( 
		"name" => __('Background (Boxed Content)', 'primathemes'),
		"id" => "boxed_content",
		"type" => "section",
		"priority" => 151,
		);
	$settings["boxed_background_color"] = array( 
		"name" => __('Background Color (Only for Boxed Layout)', 'primathemes'),
		"id" => "boxed_background_color",
		"section" => "boxed_content",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "body.stylelayout-boxed #main .margin",
		"css_property" => "background-color",
		);
	$settings["boxed_background_image"] = array( 
		"name" => __('Background Image (Only for Boxed Layout)', 'primathemes'),
		"id" => "boxed_background_image",
		"section" => "boxed_content",
		"type" => "image",
		"live_preview" => true,
		"css_selector" => "body.stylelayout-boxed #main .margin",
		"css_property" => "background-image",
		);
	return $settings;
}

/**
 * Add Top Navigation section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_topnav' );
function prima_design_settings_args_topnav( $settings ) {
	$settings["section_topnav"] = array( 
		"name" => __('Top Navigation', 'primathemes'),
		"id" => "topnav",
		"type" => "section",
		"priority" => 152,
		);
	$settings["topnav_bg_color"] = array( 
		"name" => __('Background Color', 'primathemes'),
		"id" => "topnav_bg_color",
		"section" => "topnav",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#topnav, #topnav ul.topnav-menu li.topnav-cart .minicart",
		"css_property" => "background-color",
		);
	$settings["topnav_bg_image"] = array( 
		"name" => __('Background Image', 'primathemes'),
		"id" => "topnav_bg_image",
		"section" => "topnav",
		"type" => "image",
		"live_preview" => true,
		"css_selector" => "#topnav",
		"css_property" => "background-image",
		);
	$settings["topnav_text_color"] = array( 
		"name" => __('Text Color', 'primathemes'),
		"id" => "topnav_text_color",
		"section" => "topnav",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#topnav",
		"css_property" => "color",
		);
	$settings["topnav_link_color"] = array( 
		"name" => __('Link Color', 'primathemes'),
		"id" => "topnav_link_color",
		"section" => "topnav",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#topnav a, #topnav a:visited, #topnav a:hover",
		"css_property" => "color",
		);
	$settings["topnav_cartcount_bg_color"] = array( 
		"name" => __('Cart Count Background Color', 'primathemes'),
		"id" => "topnav_cartcount_bg_color",
		"section" => "topnav",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#topnav ul.topnav-menu li a.topnav-cart-count, #topnav ul.topnav-menu li a.topnav-cart-count:visited, #topnav ul.topnav-menu li.topnav-cart .minicart a.button, #topnav ul.topnav-menu li.topnav-cart .minicart a.button:visited ",
		"css_property" => "background-color",
		);
	$settings["topnav_cartcount_bg_color_hover"] = array( 
		"name" => __('Cart Count Background Color (Hover)', 'primathemes'),
		"id" => "topnav_cartcount_bg_color_hover",
		"section" => "topnav",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#topnav ul.topnav-menu li a.topnav-cart-count:hover, #topnav ul.topnav-menu li.topnav-cart .minicart a.button:hover",
		"css_property" => "background-color",
		);
	$settings["topnav_cartcount_text_color"] = array( 
		"name" => __('Cart Count Text Color', 'primathemes'),
		"id" => "topnav_cartcount_text_color",
		"section" => "topnav",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#topnav ul.topnav-menu li a.topnav-cart-count, #topnav ul.topnav-menu li a.topnav-cart-count:visited, #topnav ul.topnav-menu li.topnav-cart .minicart a.button, #topnav ul.topnav-menu li.topnav-cart .minicart a.button:visited ",
		"css_property" => "color",
		);
	$settings["topnav_minicart_bg_color"] = array( 
		"name" => __('Mini Cart Background Color', 'primathemes'),
		"id" => "topnav_minicart_bg_color",
		"section" => "topnav",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#topnav ul.topnav-menu li.topnav-cart .minicart",
		"css_property" => "background-color",
		);
	$settings["topnav_searchform_bg_color"] = array( 
		"name" => __('Search Form Background Color', 'primathemes'),
		"id" => "topnav_searchform_bg_color",
		"section" => "topnav",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#topnav ul.topnav-menu input.searchinput",
		"css_property" => "background-color",
		);
	return $settings;
}

/**
 * Add Header Content section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_headercontent' );
function prima_design_settings_args_headercontent( $settings ) {
	$settings["section_headercontent"] = array( 
		"name" => __('Header Content (Logo&Menu)', 'primathemes'),
		"id" => "headercontent",
		"type" => "section",
		"priority" => 153,
		);
	$settings["headercontent_bg_color"] = array( 
		"name" => __('Background Color', 'primathemes'),
		"id" => "headercontent_bg_color",
		"section" => "headercontent",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header",
		"css_property" => "background-color",
		);
	$settings["headercontent_bg_image"] = array( 
		"name" => __('Background Image', 'primathemes'),
		"id" => "headercontent_bg_image",
		"section" => "headercontent",
		"type" => "image",
		"live_preview" => true,
		"css_selector" => "#header",
		"css_property" => "background-image",
		);
	$settings["headercontent_primary_color"] = array( 
		"name" => __('Primary Color', 'primathemes'),
		"id" => "headercontent_primary_color",
		"section" => "headercontent",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-title a, #header-title a:visited, #header-menu .menu-primary a, #header-menu .menu-primary a:visited, #header-menu .menu-primary li li a, #header-menu .menu-primary li li a:visited, #header-menu .menu-primary li li a:hover",
		"css_property" => "color",
		);
	$settings["headercontent_secondary_color"] = array( 
		"name" => __('Secondary Color', 'primathemes'),
		"id" => "headercontent_secondary_color",
		"section" => "headercontent",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-title a:hover, #header-menu .menu-primary a:hover",
		"css_property" => "color",
		);
	$settings["headercontent_submenu_bg_color"] = array( 
		"name" => __('Submenu Background Color', 'primathemes'),
		"id" => "headercontent_submenu_bg_color",
		"section" => "headercontent",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-menu .menu-primary li li a, #header-menu .menu-primary li li a:visited",
		"css_property" => "background-color",
		);
	$settings["headercontent_submenu_bg_color_hover"] = array( 
		"name" => __('Submenu Background Color (Hover)', 'primathemes'),
		"id" => "headercontent_submenu_bg_color_hover",
		"section" => "headercontent",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-menu .menu-primary li li a:hover",
		"css_property" => "background-color",
		);
	$settings["headercontent_submenu_border_color"] = array( 
		"name" => __('Submenu Border Color', 'primathemes'),
		"id" => "headercontent_submenu_border_color",
		"section" => "headercontent",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-menu .menu-primary li li a, #header-menu .menu-primary li li a:visited",
		"css_property" => "border-color",
		);
	return $settings;
}

/**
 * Add Header Featured (default) section for Design Settings (Customizer) page.
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_headerfeatured_default' );
function prima_design_settings_args_headerfeatured_default( $settings ) {
	$settings["header_featured_nopadding"] = array( 
		"name" => __('Remove padding (top,left,bottom,right space) on default header image', 'primathemes'),
		"id" => "header_featured_nopadding",
		"section" => "header_image",
		"database" => PRIMA_THEME_SETTINGS,
		"type" => "checkbox",
		"default" => "",
		"priority" => 20,
		);
	$settings["header_featured_fullscreen"] = array( 
		"name" => __('Full Screen Mode', 'primathemes'),
		"id" => "header_featured_fullscreen",
		"section" => "header_image",
		"database" => PRIMA_THEME_SETTINGS,
		"type" => "checkbox",
		"default" => "",
		"priority" => 20,
		);
	return $settings;
}

/**
 * Add Header Featured section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_headerfeatured' );
function prima_design_settings_args_headerfeatured( $settings ) {
	$settings["section_headerfeatured"] = array( 
		"name" => __('Header Featured', 'primathemes'),
		"id" => "headerfeatured",
		"type" => "section",
		"priority" => 154,
		);
	$settings["headerfeatured_bg_color"] = array( 
		"name" => __('Background Color', 'primathemes'),
		"id" => "headerfeatured_bg_color",
		"section" => "headerfeatured",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-featured",
		"css_property" => "background-color",
		);
	$settings["headerfeatured_bg_image"] = array( 
		"name" => __('Background Image', 'primathemes'),
		"id" => "headerfeatured_bg_image",
		"section" => "headerfeatured",
		"type" => "image",
		"live_preview" => true,
		"css_selector" => "#header-featured",
		"css_property" => "background-image",
		);
	$settings["headerfeatured_text_color"] = array( 
		"name" => __('Text Color', 'primathemes'),
		"id" => "headerfeatured_text_color",
		"section" => "headerfeatured",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-featured, #header-featured h1, #header-featured h2, #header-featured h3, #header-featured h4, #header-featured h5, #header-featured h6",
		"css_property" => "color",
		);
	$settings["headerfeatured_link_color"] = array( 
		"name" => __('Link Color', 'primathemes'),
		"id" => "headerfeatured_link_color",
		"section" => "headerfeatured",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-featured a, #header-featured a:visited, #header-featured a:hover",
		"css_property" => "color",
		);
	$settings["headerfeatured_button_bg_color"] = array( 
		"name" => __('Button Background Color', 'primathemes'),
		"id" => "headerfeatured_button_bg_color",
		"section" => "headerfeatured",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-featured a.ps-button, #header-featured a.ps-button:visited",
		"css_property" => "background",
		);
	$settings["headerfeatured_button_border_color"] = array( 
		"name" => __('Button Border Color', 'primathemes'),
		"id" => "headerfeatured_button_border_color",
		"section" => "headerfeatured",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-featured a.ps-button, #header-featured a.ps-button:visited",
		"css_property" => "border-color",
		);
	$settings["headerfeatured_button_text_color"] = array( 
		"name" => __('Button Text Color', 'primathemes'),
		"id" => "headerfeatured_button_text_color",
		"section" => "headerfeatured",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-featured a.ps-button, #header-featured a.ps-button:visited",
		"css_property" => "color",
		);
	$settings["headerfeatured_button_hover_bg_color"] = array( 
		"name" => __('Button (Hover) Background Color', 'primathemes'),
		"id" => "headerfeatured_button_hover_bg_color",
		"section" => "headerfeatured",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-featured a.ps-button:hover",
		"css_property" => "background",
		);
	$settings["headerfeatured_button_hover_border_color"] = array( 
		"name" => __('Button (Hover) Border Color', 'primathemes'),
		"id" => "headerfeatured_button_hover_border_color",
		"section" => "headerfeatured",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-featured a.ps-button:hover",
		"css_property" => "border-color",
		);
	$settings["headerfeatured_button_hover_text_color"] = array( 
		"name" => __('Button (Hover) Text Color', 'primathemes'),
		"id" => "headerfeatured_button_hover_text_color",
		"section" => "headerfeatured",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-featured a.ps-button:hover",
		"css_property" => "color",
		);
	return $settings;
}

/**
 * Add Header Call To Action section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_headeraction' );
function prima_design_settings_args_headeraction( $settings ) {
	$settings["section_headeraction"] = array( 
		"name" => __('Header Call To Action', 'primathemes'),
		"id" => "headeraction",
		"type" => "section",
		"priority" => 155,
		);
	$settings["headeraction_bg_color"] = array( 
		"name" => __('Background Color', 'primathemes'),
		"id" => "headeraction_bg_color",
		"section" => "headeraction",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-action",
		"css_property" => "background-color",
		);
	$settings["headeraction_bg_image"] = array( 
		"name" => __('Background Image', 'primathemes'),
		"id" => "headeraction_bg_image",
		"section" => "headeraction",
		"type" => "image",
		"live_preview" => true,
		"css_selector" => "#header-action",
		"css_property" => "background-image",
		);
	$settings["headeraction_text_color"] = array( 
		"name" => __('Text Color', 'primathemes'),
		"id" => "headeraction_text_color",
		"section" => "headeraction",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-action",
		"css_property" => "color",
		);
	$settings["headeraction_button_text_color"] = array( 
		"name" => __('Button Text Color', 'primathemes'),
		"id" => "headeraction_button_text_color",
		"section" => "headeraction",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-action a.header-action-button, #header-action a.header-action-button:visited",
		"css_property" => "color",
		);
	$settings["headeraction_button_bg_color"] = array( 
		"name" => __('Button Background Color', 'primathemes'),
		"id" => "headeraction_button_bg_color",
		"section" => "headeraction",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-action a.header-action-button, #header-action a.header-action-button:visited",
		"css_property" => "background-color",
		);
	$settings["headeraction_button_bg_color_hover"] = array( 
		"name" => __('Button Background Color (Hover)', 'primathemes'),
		"id" => "headeraction_button_bg_color_hover",
		"section" => "headeraction",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#header-action a.header-action-button:hover",
		"css_property" => "background-color",
		);
	return $settings;
}

/**
 * Add Footer Widgets section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_footerwidgets' );
function prima_design_settings_args_footerwidgets( $settings ) {
	$settings["section_footerwidgets"] = array( 
		"name" => __('Footer Widgets', 'primathemes'),
		"id" => "footerwidgets",
		"type" => "section",
		"priority" => 156,
		);
	$settings["footerwidgets_bg_color"] = array( 
		"name" => __('Background Color', 'primathemes'),
		"id" => "footerwidgets_bg_color",
		"section" => "footerwidgets",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#footer-widgets",
		"css_property" => "background-color",
		);
	$settings["footerwidgets_bg_image"] = array( 
		"name" => __('Background Image', 'primathemes'),
		"id" => "footerwidgets_bg_image",
		"section" => "footerwidgets",
		"type" => "image",
		"live_preview" => true,
		"css_selector" => "#footer-widgets",
		"css_property" => "background-image",
		);
	$settings["footerwidgets_border_color"] = array( 
		"name" => __('Border Color', 'primathemes'),
		"id" => "footerwidgets_border_color",
		"section" => "footerwidgets",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#footer-widgets, #footer-widgets .widget h3.widget-title",
		"css_property" => "border-color",
		);
	$settings["footerwidgets_title_color"] = array( 
		"name" => __('Widget Title Color', 'primathemes'),
		"id" => "footerwidgets_title_color",
		"section" => "footerwidgets",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#footer-widgets .widget h3.widget-title",
		"css_property" => "color",
		);
	$settings["footerwidgets_text_color"] = array( 
		"name" => __('Text Color', 'primathemes'),
		"id" => "footerwidgets_text_color",
		"section" => "footerwidgets",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#footer-widgets",
		"css_property" => "color",
		);
	$settings["footerwidgets_link_color"] = array( 
		"name" => __('Link Color', 'primathemes'),
		"id" => "footerwidgets_link_color",
		"section" => "footerwidgets",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#footer-widgets a, #footer-widgets a:visited",
		"css_property" => "color",
		);
	$settings["footerwidgets_hover_color"] = array( 
		"name" => __('Link (Hover) Color', 'primathemes'),
		"id" => "footerwidgets_hover_color",
		"section" => "footerwidgets",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#footer-widgets a:hover",
		"css_property" => "color",
		);
	return $settings;
}

/**
 * Add Footer Content section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_footercontent' );
function prima_design_settings_args_footercontent( $settings ) {
	$settings["section_footercontent"] = array( 
		"name" => __('Footer Content (Credits&Menu)', 'primathemes'),
		"id" => "footercontent",
		"type" => "section",
		"priority" => 157,
		);
	$settings["footercontent_bg_color"] = array( 
		"name" => __('Background Color', 'primathemes'),
		"id" => "footercontent_bg_color",
		"section" => "footercontent",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#footer",
		"css_property" => "background-color",
		);
	$settings["footercontent_bg_image"] = array( 
		"name" => __('Background Image', 'primathemes'),
		"id" => "footercontent_bg_image",
		"section" => "footercontent",
		"type" => "image",
		"live_preview" => true,
		"css_selector" => "#footer",
		"css_property" => "background-image",
		);
	$settings["footercontent_primary_color"] = array( 
		"name" => __('Primary Color', 'primathemes'),
		"id" => "footercontent_primary_color",
		"section" => "footercontent",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#footer, #footer .footer-right ul.footer-menu a, #footer .footer-right ul.footer-menu a:visited",
		"css_property" => "color",
		);
	$settings["footercontent_secondary_color"] = array( 
		"name" => __('Secondary Color', 'primathemes'),
		"id" => "footercontent_secondary_color",
		"section" => "footercontent",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#footer a, #footer a:visited, #footer a:hover, #footer .footer-right ul.footer-menu a:hover", 
		"css_property" => "color",
		);
	return $settings;
}

/**
 * Add Breadcrumb section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_breadcrumb' );
function prima_design_settings_args_breadcrumb( $settings ) {
	$settings["section_breadcrumb"] = array( 
		"name" => __('Breadcrumb', 'primathemes'),
		"id" => "breadcrumb",
		"type" => "section",
		"priority" => 158,
		);
	$settings["breadcrumb_text_color"] = array( 
		"name" => __('Breadcrumb Text Color', 'primathemes'),
		"id" => "breadcrumb_text_color",
		"section" => "breadcrumb",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".breadcrumb, .woocommerce .woocommerce-breadcrumb, .woocommerce-page .woocommerce-breadcrumb",
		"css_property" => "color",
		);
	$settings["breadcrumb_link_color"] = array( 
		"name" => __('Breadcrumb Link Color', 'primathemes'),
		"id" => "breadcrumb_link_color",
		"section" => "breadcrumb",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".breadcrumb a, .woocommerce .woocommerce-breadcrumb a, .woocommerce-page .woocommerce-breadcrumb a, .breadcrumb a:visited, .woocommerce .woocommerce-breadcrumb a:visited, .woocommerce-page .woocommerce-breadcrumb a:visited",
		"css_property" => "color",
		);
	$settings["breadcrumb_hover_color"] = array( 
		"name" => __('Breadcrumb Link (Hover) Color', 'primathemes'),
		"id" => "breadcrumb_hover_color",
		"section" => "breadcrumb",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".breadcrumb a:hover, .woocommerce .woocommerce-breadcrumb a:hover, .woocommerce-page .woocommerce-breadcrumb a:hover",
		"css_property" => "color",
		);
	return $settings;
}

/**
 * Add Blog Post section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_blogpost' );
function prima_design_settings_args_blogpost( $settings ) {
	$settings["section_blogpost"] = array( 
		"name" => __('Blog Post', 'primathemes'),
		"id" => "blogpost",
		"type" => "section",
		"priority" => 159,
		);
	$settings["blogpost_sticky_bg_color"] = array( 
		"name" => __('Sticky Post Background Color', 'primathemes'),
		"id" => "blogpost_sticky_bg_color",
		"section" => "blogpost",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".sticky",
		"css_property" => "background",
		);
	$settings["blogpost_sticky_border_color"] = array( 
		"name" => __('Sticky Post Border Color', 'primathemes'),
		"id" => "blogpost_sticky_border_color",
		"section" => "blogpost",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".sticky",
		"css_property" => "border-color",
		);
	$settings["blogpost_meta_text_color"] = array( 
		"name" => __('Post Meta Text Color', 'primathemes'),
		"id" => "blogpost_meta_text_color",
		"section" => "blogpost",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".hentry .post-meta, .prima_recent_posts .post-meta, .woocommerce #reviews #comments ol.commentlist li .meta, .woocommerce-page #reviews #comments ol.commentlist li .meta",
		"css_property" => "color",
		);
	$settings["blogpost_navnumeric_bg_color"] = array( 
		"name" => __('Numeric Navigation Background Color', 'primathemes'),
		"id" => "blogpost_navnumeric_bg_color",
		"section" => "blogpost",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#nav-numeric li a, .woocommerce nav.woocommerce-pagination ul li, .woocommerce #content nav.woocommerce-pagination ul li, .woocommerce-page nav.woocommerce-pagination ul li, .woocommerce-page #content nav.woocommerce-pagination ul li",
		"css_property" => "background",
		);
	$settings["blogpost_navnumeric_border_color"] = array( 
		"name" => __('Numeric Navigation Border Color', 'primathemes'),
		"id" => "blogpost_navnumeric_border_color",
		"section" => "blogpost",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#nav-numeric li a, .woocommerce nav.woocommerce-pagination ul, .woocommerce #content nav.woocommerce-pagination ul, .woocommerce-page nav.woocommerce-pagination ul, .woocommerce-page #content nav.woocommerce-pagination ul, .woocommerce nav.woocommerce-pagination ul li, .woocommerce #content nav.woocommerce-pagination ul li, .woocommerce-page nav.woocommerce-pagination ul li, .woocommerce-page #content nav.woocommerce-pagination ul li",
		"css_property" => "border-color",
		);
	$settings["blogpost_navnumeric_text_color"] = array( 
		"name" => __('Numeric Navigation Text Color', 'primathemes'),
		"id" => "blogpost_navnumeric_text_color",
		"section" => "blogpost",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#nav-numeric li a, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span, .woocommerce #content nav.woocommerce-pagination ul li a, .woocommerce #content nav.woocommerce-pagination ul li span, .woocommerce-page nav.woocommerce-pagination ul li a, .woocommerce-page nav.woocommerce-pagination ul li span, .woocommerce-page #content nav.woocommerce-pagination ul li a, .woocommerce-page #content nav.woocommerce-pagination ul li span",
		"css_property" => "color",
		);
	$settings["blogpost_navnumeric_hover_bg_color"] = array( 
		"name" => __('Numeric Navigation (Hover) Background Color', 'primathemes'),
		"id" => "blogpost_navnumeric_hover_bg_color",
		"section" => "blogpost",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#nav-numeric li a:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus",
		"css_property" => "background",
		);
	$settings["blogpost_navnumeric_active_a_color"] = array( 
		"name" => __('Numeric Navigation (Active) Background Color', 'primathemes'),
		"id" => "blogpost_navnumeric_active_bg_color",
		"section" => "blogpost",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "#nav-numeric li.current a, .woocommerce nav.woocommerce-pagination ul li span.current",
		"css_property" => "background",
		);
	return $settings;
}

/**
 * Add Shortcodes section for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_shortcode' );
function prima_design_settings_args_shortcode( $settings ) {
	$settings["section_shortcode"] = array( 
		"name" => __('Shortcodes', 'primathemes'),
		"id" => "shortcode",
		"type" => "section",
		"priority" => 160,
		);
	$settings["shortcode_highlight_bg_color"] = array( 
		"name" => __('Highlight Background Color', 'primathemes'),
		"id" => "shortcode_highlight_bg_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "span.ps-highlight",
		"css_property" => "background-color",
		);
	$settings["shortcode_highlight_text_color"] = array( 
		"name" => __('Highlight Text Color', 'primathemes'),
		"id" => "shortcode_highlight_text_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "span.ps-highlight",
		"css_property" => "color",
		);
	$settings["shortcode_quote_text_color"] = array( 
		"name" => __('Quote Text Color', 'primathemes'),
		"id" => "shortcode_quote_text_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-quote p",
		"css_property" => "color",
		);
	$settings["shortcode_quote_bg_color"] = array( 
		"name" => __('Quote (Boxed) Background Color', 'primathemes'),
		"id" => "shortcode_quote_bg_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-quote.boxed",
		"css_property" => "background",
		);
	$settings["shortcode_toggle_trigger_bg_color"] = array( 
		"name" => __('Toggle (Title) Background Color', 'primathemes'),
		"id" => "shortcode_toggle_trigger_bg_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-toggle-trigger",
		"css_property" => "background-color",
		);
	$settings["shortcode_toggle_trigger_text_color"] = array( 
		"name" => __('Toggle (Title) Text Color', 'primathemes'),
		"id" => "shortcode_toggle_trigger_text_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-toggle-trigger a, .ps-toggle-trigger a:hover",
		"css_property" => "color",
		);
	$settings["shortcode_toggle_bg_color"] = array( 
		"name" => __('Toggle (Content) Background Color', 'primathemes'),
		"id" => "shortcode_toggle_bg_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-toggle-container",
		"css_property" => "background",
		);
	$settings["shortcode_toggle_border_color"] = array( 
		"name" => __('Toggle Border Color', 'primathemes'),
		"id" => "shortcode_toggle_border_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-toggle-container, .ps-toggle-trigger",
		"css_property" => "border-color",
		);
	$settings["shortcode_tabs_trigger_bg_color"] = array( 
		"name" => __('Tabs (Title) Background Color', 'primathemes'),
		"id" => "shortcode_tabs_trigger_bg_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "ul.ps-tabs li",
		"css_property" => "background-color",
		);
	$settings["shortcode_tabs_trigger_text_color"] = array( 
		"name" => __('Tabs (Title) Text Color', 'primathemes'),
		"id" => "shortcode_tabs_trigger_text_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "ul.ps-tabs li span, ul.ps-tabs li span:hover, ul.ps-tabs li.active span",
		"css_property" => "color",
		);
	$settings["shortcode_tabs_bg_color"] = array( 
		"name" => __('Tabs (Content) Background Color', 'primathemes'),
		"id" => "shortcode_tabs_bg_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-tab_container, html ul.ps-tabs li.active, html ul.ps-tabs li.active span:hover",
		"css_property" => "background",
		"css_selector2" => "html ul.ps-tabs li.active, html ul.ps-tabs li.active span:hover",
		"css_property2" => "border-bottom-color",
		);
	$settings["shortcode_tabs_border_color"] = array( 
		"name" => __('Tabs Border Color', 'primathemes'),
		"id" => "shortcode_tabs_border_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-tab_container, ul.ps-tabs, ul.ps-tabs li",
		"css_property" => "border-color",
		);
	$settings["shortcode_box_bg_color"] = array( 
		"name" => __('Default Box Background Color', 'primathemes'),
		"id" => "shortcode_box_bg_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-box",
		"css_property" => "background",
		);
	$settings["shortcode_box_border_color"] = array( 
		"name" => __('Default Box Border Color', 'primathemes'),
		"id" => "shortcode_box_border_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-box",
		"css_property" => "border-color",
		);
	$settings["shortcode_box_text_color"] = array( 
		"name" => __('Default Box Text Color', 'primathemes'),
		"id" => "shortcode_box_text_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-box",
		"css_property" => "color",
		);
	$settings["shortcode_button_bg_color"] = array( 
		"name" => __('Default Button Background Color', 'primathemes'),
		"id" => "shortcode_button_bg_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-button, .ps-button:visited",
		"css_property" => "background",
		);
	$settings["shortcode_button_border_color"] = array( 
		"name" => __('Default Button Border Color', 'primathemes'),
		"id" => "shortcode_button_border_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-button, .ps-button:visited",
		"css_property" => "border-color",
		);
	$settings["shortcode_button_text_color"] = array( 
		"name" => __('Default Button Text Color', 'primathemes'),
		"id" => "shortcode_button_text_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-button, .ps-button:visited",
		"css_property" => "color",
		);
	$settings["shortcode_button_hover_bg_color"] = array( 
		"name" => __('Default Button (Hover) Background Color', 'primathemes'),
		"id" => "shortcode_button_hover_bg_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-button:hover",
		"css_property" => "background",
		);
	$settings["shortcode_button_hover_border_color"] = array( 
		"name" => __('Default Button (Hover) Border Color', 'primathemes'),
		"id" => "shortcode_button_hover_border_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-button:hover",
		"css_property" => "border-color",
		);
	$settings["shortcode_button_hover_text_color"] = array( 
		"name" => __('Default Button (Hover) Text Color', 'primathemes'),
		"id" => "shortcode_button_hover_text_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-button:hover",
		"css_property" => "color",
		);
	$settings["shortcode_sliderboxed_bg_color"] = array( 
		"name" => __('Slider (Boxed) Background Color', 'primathemes'),
		"id" => "shortcode_sliderboxed_bg_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-slider-withbg",
		"css_property" => "background",
		);
	$settings["shortcode_sliderboxed_border_color"] = array( 
		"name" => __('Slider (Boxed) Border Color', 'primathemes'),
		"id" => "shortcode_sliderboxed_border_color",
		"section" => "shortcode",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".ps-slider-withbg",
		"css_property" => "border-color",
		);
	return $settings;
}

/**
 * Add Ecommerce controls for Design Settings (Customizer) page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_design_settings_args', 'prima_design_settings_args_ecommerce' );
function prima_design_settings_args_ecommerce( $settings ) {
	$settings["section_ecommerce"] = array( 
		"name" => __('Ecommerce', 'primathemes'),
		"id" => "ecommerce",
		"type" => "section",
		"priority" => 157,
		);
	$settings["ecommerce_rating_color"] = array( 
		"name" => __('Star Rating Color', 'primathemes'),
		"id" => "ecommerce_rating_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce .star-rating span, .woocommerce-page .star-rating span",
		"css_property" => "color",
		);
	$settings["ecommerce_saleflash_bg_color"] = array( 
		"name" => __('Sale Flash Background Color', 'primathemes'),
		"id" => "ecommerce_saleflash_bg_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce-page span.onsale",
		"css_property" => "background",
		);
	$settings["ecommerce_saleflash_text_color"] = array( 
		"name" => __('Sale Flash Text Color', 'primathemes'),
		"id" => "ecommerce_saleflash_text_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce-page span.onsale",
		"css_property" => "color",
		);
	$settings["ecommerce_price_color"] = array( 
		"name" => __('Price Text Color (Default)', 'primathemes'),
		"id" => "ecommerce_price_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce div.product span.price, .woocommerce div.product p.price, .woocommerce #content div.product span.price, .woocommerce #content div.product p.price, .woocommerce-page div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page #content div.product p.price",
		"css_property" => "color",
		);
	$settings["ecommerce_price_from_color"] = array( 
		"name" => __('Price Text Color (From Text)', 'primathemes'),
		"id" => "ecommerce_price_from_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce ul.products li.product .price .from, .woocommerce-page ul.products li.product .price .from, .woocommerce div.product span.price .from, .woocommerce div.product p.price .from, .woocommerce #content div.product span.price .from, .woocommerce #content div.product p.price .from, .woocommerce-page div.product span.price .from, .woocommerce-page div.product p.price .from, .woocommerce-page #content div.product span.price .from, .woocommerce-page #content div.product p.price .from",
		"css_property" => "color",
		);
	$settings["ecommerce_price_regular_color"] = array( 
		"name" => __('Price Text Color (Regular Price)', 'primathemes'),
		"id" => "ecommerce_price_regular_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce div.product span.price del, .woocommerce div.product p.price del, .woocommerce #content div.product span.price del, .woocommerce #content div.product p.price del, .woocommerce-page div.product span.price del, .woocommerce-page div.product p.price del, .woocommerce-page #content div.product span.price del, .woocommerce-page #content div.product p.price del, .woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del",
		"css_property" => "color",
		);
	$settings["ecommerce_price_sale_color"] = array( 
		"name" => __('Price Text Color (Sale Price)', 'primathemes'),
		"id" => "ecommerce_price_sale_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .woocommerce div.product span.price ins, .woocommerce div.product p.price ins, .woocommerce #content div.product span.price ins, .woocommerce #content div.product p.price ins, .woocommerce-page div.product span.price ins, .woocommerce-page div.product p.price ins, .woocommerce-page #content div.product span.price ins, .woocommerce-page #content div.product p.price ins",
		"css_property" => "color",
		);
	$settings["ecommerce_button_text_color"] = array( 
		"name" => __('Button Text Color', 'primathemes'),
		"id" => "ecommerce_button_text_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce .woocommerce-message a, .woocommerce .woocommerce-error a, .woocommerce .woocommerce-info a, .woocommerce .woocommerce-message a:visited, .woocommerce .woocommerce-error a:visited, .woocommerce .woocommerce-info a:visited, .woocommerce .woocommerce-message a:hover, .woocommerce .woocommerce-error a:hover, .woocommerce .woocommerce-info a:hover",
		"css_property" => "color",
		);
	$settings["ecommerce_button_bg_color"] = array( 
		"name" => __('Button Background Color', 'primathemes'),
		"id" => "ecommerce_button_bg_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button",
		"css_property" => "background",
		);
	$settings["ecommerce_button_bg_color_hover"] = array( 
		"name" => __('Button Background Color (Hover)', 'primathemes'),
		"id" => "ecommerce_button_bg_color_hover",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover",
		"css_property" => "background",
		);
	$settings["ecommerce_button_border_color"] = array( 
		"name" => __('Button Border Color', 'primathemes'),
		"id" => "ecommerce_button_border_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button",
		"css_property" => "border-color",
		);
	$settings["ecommerce_buttonalt_text_color"] = array( 
		"name" => __('Alternate Button Text Color', 'primathemes'),
		"id" => "ecommerce_buttonalt_text_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt, .woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce table.cart td.actions .button.alt, .woocommerce #content table.cart td.actions .button.alt, .woocommerce-page table.cart td.actions .button.alt, .woocommerce-page #content table.cart td.actions .button.alt",
		"css_property" => "color",
		);
	$settings["ecommerce_buttonalt_bg_color"] = array( 
		"name" => __('Alternate Button Background Color', 'primathemes'),
		"id" => "ecommerce_buttonalt_bg_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt, .woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce table.cart td.actions .button.alt, .woocommerce #content table.cart td.actions .button.alt, .woocommerce-page table.cart td.actions .button.alt, .woocommerce-page #content table.cart td.actions .button.alt",
		"css_property" => "background",
		);
	$settings["ecommerce_buttonalt_bg_color_hover"] = array( 
		"name" => __('Alternate Button Background Color (Hover)', 'primathemes'),
		"id" => "ecommerce_buttonalt_bg_color_hover",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce div.product form.cart .button:hover, .woocommerce #content div.product form.cart .button:hover, .woocommerce-page div.product form.cart .button:hover, .woocommerce-page #content div.product form.cart .button:hover, .woocommerce table.cart td.actions .button.alt:hover, .woocommerce #content table.cart td.actions .button.alt:hover, .woocommerce-page table.cart td.actions .button.alt:hover, .woocommerce-page #content table.cart td.actions .button.alt:hover",
		"css_property" => "background",
		);
	$settings["ecommerce_buttonalt_border_color"] = array( 
		"name" => __('Alternate Button Border Color', 'primathemes'),
		"id" => "ecommerce_buttonalt_border_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt, .woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce table.cart td.actions .button.alt, .woocommerce #content table.cart td.actions .button.alt, .woocommerce-page table.cart td.actions .button.alt, .woocommerce-page #content table.cart td.actions .button.alt",
		"css_property" => "border-color",
		);
	$settings["ecommerce_tabs_bg_color"] = array( 
		"name" => __('Product Tabs Background Color', 'primathemes'),
		"id" => "ecommerce_tabs_bg_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce div.product .woocommerce-tabs ul.tabs li,.woocommerce #content div.product .woocommerce-tabs ul.tabs li,.woocommerce-page div.product .woocommerce-tabs ul.tabs li,.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li",
		"css_property" => "background",
		);
	$settings["ecommerce_tabs_text_color"] = array( 
		"name" => __('Product Tabs Text Color', 'primathemes'),
		"id" => "ecommerce_tabs_text_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce #content div.product .woocommerce-tabs ul.tabs li a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li a, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a",
		"css_property" => "color",
		);
	$settings["ecommerce_tabs_text_hover_color"] = array( 
		"name" => __('Product Tabs Text (Hover) Color', 'primathemes'),
		"id" => "ecommerce_tabs_text_hover_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover",
		"css_property" => "color",
		);
	$settings["ecommerce_tabs_active_bg_color"] = array( 
		"name" => __('Product Tabs (Active) Background Color', 'primathemes'),
		"id" => "ecommerce_tabs_active_bg_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active",
		"css_property" => "background",
		"css_selector2" => ".woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active",
		"css_property2" => "border-bottom-color",
		);
	$settings["ecommerce_tabs_active_text_color"] = array( 
		"name" => __('Product Tabs (Active) Text Color', 'primathemes'),
		"id" => "ecommerce_tabs_active_text_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a",
		"css_property" => "color",
		);
	$settings["ecommerce_tabs_border_color"] = array( 
		"name" => __('Product Tabs Border Color', 'primathemes'),
		"id" => "ecommerce_tabs_active_border_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce div.product .woocommerce-tabs ul.tabs:before, .woocommerce #content div.product .woocommerce-tabs ul.tabs:before, .woocommerce-page div.product .woocommerce-tabs ul.tabs:before, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs:before, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li",
		"css_property" => "border-color",
		);
	$settings["ecommerce_lighbox_bg_color"] = array( 
		"name" => __('Product Lightbox Background Color', 'primathemes'),
		"id" => "ecommerce_lighbox_bg_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => "div.pp_woocommerce .pp_content_container",
		"css_property" => "background",
		);
	$settings["ecommerce_payment_bg_color"] = array( 
		"name" => __('Checkout Payment Background Color', 'primathemes'),
		"id" => "ecommerce_payment_bg_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce #payment, .woocommerce-page #payment",
		"css_property" => "background",
		);
	$settings["ecommerce_payment_border_color"] = array( 
		"name" => __('Checkout Payment Border Color', 'primathemes'),
		"id" => "ecommerce_payment_border_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce #payment ul.payment_methods, .woocommerce-page #payment ul.payment_methods, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row",
		"css_property" => "border-color",
		);
	$settings["ecommerce_alert_bg_color"] = array( 
		"name" => __('Alert Background Color', 'primathemes'),
		"id" => "ecommerce_alert_bg_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce-message, .woocommerce-error, .woocommerce-info",
		"css_property" => "background",
		"css_additional" => ".woocommerce-message, .woocommerce-error, .woocommerce-info { text-shadow: none; -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; }",
		);
	$settings["ecommerce_alert_text_color"] = array( 
		"name" => __('Alert Text Color', 'primathemes'),
		"id" => "ecommerce_alert_text_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce-message, .woocommerce-error, .woocommerce-info",
		"css_property" => "color",
		);
	$settings["ecommerce_alert_link_color"] = array( 
		"name" => __('Alert Link Color', 'primathemes'),
		"id" => "ecommerce_alert_link_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce-message a, .woocommerce-error a, .woocommerce-info a, .woocommerce-message a:visited, .woocommerce-error a:visited, .woocommerce-info a:visited, .woocommerce-message a:hover, .woocommerce-error a:hover, .woocommerce-info a:hover",
		"css_property" => "color",
		);
	$settings["ecommerce_alert_message_border_color"] = array( 
		"name" => __('Alert (Message) Border Color', 'primathemes'),
		"id" => "ecommerce_alert_message_border_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce-message",
		"css_property" => "border-color",
		"css_selector2" => ".woocommerce-message:before",
		"css_property2" => "background-color",
		);
	$settings["ecommerce_alert_info_border_color"] = array( 
		"name" => __('Alert (Info) Border Color', 'primathemes'),
		"id" => "ecommerce_alert_info_border_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce-info",
		"css_property" => "border-color",
		"css_selector2" => ".woocommerce-info:before",
		"css_property2" => "background-color",
		);
	$settings["ecommerce_alert_error_border_color"] = array( 
		"name" => __('Alert (Error) Border Color', 'primathemes'),
		"id" => "ecommerce_alert_error_border_color",
		"section" => "ecommerce",
		"type" => "color",
		"live_preview" => true,
		"css_selector" => ".woocommerce-error",
		"css_property" => "border-color",
		"css_selector2" => ".woocommerce-error:before",
		"css_property2" => "background-color",
		);
	return $settings;
}

