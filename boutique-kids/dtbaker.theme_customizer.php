<?php


if ( ! defined( 'ABSPATH' ) ) exit;


if ( ! function_exists( 'boutique_theme_sanitize_callback' ) ) {
	function boutique_theme_sanitize_callback( $value ) {
		return $value;
	}
}

add_action( 'customize_register', 'boutique_customize_register' );
if ( ! function_exists( 'boutique_customize_register' ) ) {
	function boutique_customize_register( $wp_customize ) {
		global $boutique_theme_defaults;
		$done_settings = array();

		class dtbakerWP_Customize_CustomBGImage_Control extends WP_Customize_Control {
			public function render_content() {
				parent::render_content();
				// script removed  -  see freetom theme.
			}
		}

		$p = 1;

		if ( $boutique_theme_defaults['boutique_site_color_options'] && count($boutique_theme_defaults['boutique_site_color_options']) > 1 ) {
			$wp_customize->add_section( 'default_style', array(
				'title'    => __( 'Default Styles', 'boutique-kids' ),
				'priority' => 2,
			) );
			$wp_customize->add_setting( 'boutique_site_color', array(
				'default'           => $boutique_theme_defaults['boutique_site_color'],
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'boutique_theme_sanitize_callback',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'boutique_site_color',
				array(
					'label'    => 'Default Style',
					'section'  => 'default_style',
					'type'     => 'select',
					'choices'  => $boutique_theme_defaults['boutique_site_color_options'],
					'priority' => $p ++,
				)
			) );

		}

		$wp_customize->add_setting( 'border_color', array(
			'default'           => $boutique_theme_defaults['border_color'],
			'transport'         => 'refresh',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		) );
		$wp_customize->add_control( new dtbakerWP_Customize_CustomBGImage_Control( $wp_customize, 'border_color',
			array(
				'label'    => 'Border Color',
				'section'  => 'background_image',
				'type'     => 'select',
				'choices'  => array(
					'blue'  => __( 'Blue', 'boutique-kids' ),
					'brown'  => __( 'Brown', 'boutique-kids' ),
					'grey'  => __( 'Grey', 'boutique-kids' ),
				),
				'priority' => - 1,
			)
		) );
		$done_settings['border_color'] = true;
		
		
		$wp_customize->add_setting( 'menu_color', array(
			'default'           => $boutique_theme_defaults['menu_color'],
			'transport'         => 'refresh',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		) );
		$wp_customize->add_control( new dtbakerWP_Customize_CustomBGImage_Control( $wp_customize, 'menu_color',
			array(
				'label'    => 'Menu Color',
				'section'  => 'background_image',
				'type'     => 'select',
				'choices'  => array(
					'blue'  => __( 'Blue', 'boutique-kids' ),
					'brown'  => __( 'Brown', 'boutique-kids' ),
					'grey'  => __( 'Grey', 'boutique-kids' ),
				),
				'priority' => - 1,
			)
		) );
		$done_settings['menu_color'] = true;

		$wp_customize->add_setting( 'background_color', array(
			'default'              => $boutique_theme_defaults['background_color'],
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
			'capability'           => 'edit_theme_options',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color',
			array(
				'label'    => 'Background Color',
				'section'  => 'background_image',
				'priority' => 10,
			)
		) );
		$done_settings['background_color'] = true;



		$wp_customize->add_setting('gallery_background_image', array(
			'default'        => $boutique_theme_defaults['gallery_background_image'],
			'transport'   => 'refresh',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		));
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gallery_background_image', array(
				'label'     => __('Gallery Background Image', 'boutique-kids'),
				'section'   => 'background_image',
				'priority'       => $p++,
			)
		));

		/*
		DOCUMENTATION: Logo
		CATEGORY: Customizing
		In Appearance > Customize > Logo you can change the logo of the website. You can type in a text logo, a text sub title or you can upload an image logo.
		To change the text logo font type please see Appearance > Customize > Fonts
		ADVANCED: For advanced logo changes please edit the `header.php` file and look for the `<div id="logo">` section. Replace this with your custom advanced logo code. The code that handles the logo customization options is located in `dtbaker.theme_options.php` on line {{current_line}}
		FILES: dtbaker.theme_options.php header.php
		*/

		$wp_customize->add_section( 'logo_header', array(
			'title'    => esc_html__( 'Logo', 'boutique-kids' ),
			'priority' => 15,
		) );


		$wp_customize->add_setting( 'logo_show_text' , array(
			'default'     => $boutique_theme_defaults['logo_show_text'],
			'transport'   => 'refresh',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'logo_show_text',
			array(
				'label'        => 'Show Logo Text',
				'section'    => 'logo_header',
				'type'      => 'select',
				'choices'   => array(
					1 => __('Yes','boutique-kids'),
					0 => __('No','boutique-kids'),
				),
				'priority'       => $p++,
			)
		) );
		$done_settings['logo_show_text']=true;

		$wp_customize->add_setting('logo_header_text', array(
			'default'        => $boutique_theme_defaults['logo_header_text'],
			//'type'           => 'option',
			'transport'   => 'refresh',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'logo_header_text', array(
				'label'     => __('Logo Text', 'boutique-kids'),
				'section'   => 'logo_header',
				'type'      => 'text',
				'priority'       => $p++,
			)
		));
		$done_settings['logo_header_text']=true;

		$wp_customize->add_setting( 'logo_header_image', array(
			'default'           => $boutique_theme_defaults['logo_header_image'],
			// 'type'           => 'option',
			'transport'         => 'refresh',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_header_image', array(
				'label'    => __( 'Logo Image', 'boutique-kids' ),
				'section'  => 'logo_header',
				'priority' => $p ++,
			)
		) );
		$done_settings['logo_header_image'] = true;

		$wp_customize->add_setting( 'logo_header_image_width', array(
			'default'           => '126',
			'transport'         => 'refresh',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'logo_header_image_width', array(
				'label'    => __( 'Logo Image Width', 'boutique-kids' ),
				'section'  => 'logo_header',
				'type'     => 'text',
				'priority' => $p ++,
			)
		) );

		$done_settings['boutique_site_color']         = true;
		$done_settings['boutique_site_color_options'] = true;

		/* responsive on/off switch */
		$wp_customize->add_section( 'boutique_responsive', array(
			'title' => __( 'Page Layout', 'boutique-kids' ),
			// 'priority'   => 30,
		) );
		$wp_customize->add_setting( 'responsive_enabled', array(
			'default'           => $boutique_theme_defaults['responsive_enabled'],
			'transport'         => 'refresh',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'responsive_enabled',
			array(
				'label'    => 'Enable Responsive',
				'section'  => 'boutique_responsive',
				'type'     => 'select',
				'choices'  => array(
					1 => __( 'Enabled', 'boutique-kids' ),
					0 => __( 'Disabled', 'boutique-kids' ),
				),
				'priority' => $p ++,
			)
		) );

		if(class_exists('boutique_post_metabox')) {
			$wp_customize->add_section( 'boutique_post_styles', array(
				'title' => __( 'Page Layout', 'boutique-kids' ),
				// 'priority'   => 30,
			) );
			$wp_customize->add_setting( 'boutique_post_style', array(
				'default'           => boutique_post_metabox::$default_style,
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'boutique_theme_sanitize_callback',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'boutique_post_style',
				array(
					'label'    => 'Default Blog Post Style',
					'section'  => 'boutique_responsive',
					'type'     => 'select',
					'choices'  => boutique_post_metabox::get_instance()->post_styles,
					'priority' => $p ++,
				)
			) );
		}

		$wp_customize->add_setting( 'boutique_full_blog', array(
			'default'           => $boutique_theme_defaults['boutique_full_blog'],
			'transport'         => 'refresh',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'boutique_full_blog',
			array(
				'label'    => 'Blog Page Output',
				'section'  => 'boutique_responsive',
				'type'     => 'select',
				'choices'  => array(
					0 => __( 'Summary', 'boutique-kids' ),
					1 => __( 'Full', 'boutique-kids' ),
				),
				'priority' => $p ++,
			)
		) );
		$done_settings['boutique_full_blog'] = true;

		if(class_exists('boutique_page_metabox')) {
			$wp_customize->add_section( 'boutique_page_styles', array(
				'title' => __( 'Page Headings', 'boutique-kids' ),
				// 'priority'   => 30,
			) );
			$wp_customize->add_setting( 'boutique_page_style', array(
				'default'           => boutique_page_metabox::$default_style,
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'boutique_theme_sanitize_callback',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'boutique_page_style',
				array(
					'label'    => 'Default Page Heading Style',
					'section'  => 'boutique_responsive',
					'type'     => 'select',
					'choices'  => boutique_page_metabox::get_instance()->page_styles,
					'priority' => $p ++,
				)
			) );
		}

		if(class_exists('boutique_featured_image_options')) {
			$wp_customize->add_section( 'boutique_thumbnail_styles', array(
				'title' => __( 'Blog Images', 'boutique-kids' ),
				// 'priority'   => 30,
			) );
			$wp_customize->add_setting( 'boutique_thumbnail_style', array(
				'default'           => boutique_featured_image_options::$default_style,
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'boutique_theme_sanitize_callback',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'boutique_thumbnail_style',
				array(
					'label'    => 'Default Blog Image Style',
					'section'  => 'boutique_responsive',
					'type'     => 'select',
					'choices'  => boutique_featured_image_options::get_instance()->image_options,
					'priority' => $p ++,
				)
			) );
		}


		/*
		$wp_customize->add_setting( 'menu_fade_in', array(
			'default'           => $boutique_theme_defaults['menu_fade_in'],
			'transport'         => 'refresh',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'menu_fade_in',
			array(
				'label'    => 'Menu Fade In',
				'section'  => 'boutique_responsive',
				'type'     => 'select',
				'choices'  => array(
					1 => __( 'Enabled' ),
					0 => __( 'Disabled' ),
				),
				'priority' => $p ++,
			)
		) );
		$done_settings['menu_fade_in'] = true;
*/
		$wp_customize->add_setting( 'full_width_fluid', array(
			'default'           => $boutique_theme_defaults['full_width_fluid'],
			'transport'         => 'refresh',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'full_width_fluid',
			array(
				'label'    => 'Full Width Fluid',
				'section'  => 'boutique_responsive',
				'type'     => 'select',
				'choices'  => array(
					1 => __( 'Enabled', 'boutique-kids' ),
					0 => __( 'Disabled', 'boutique-kids' ),
				),
				'priority' => $p ++,
			)
		) );
		$done_settings['full_width_fluid'] = true;

		$wp_customize->add_setting( 'sidebar_width', array(
			'default'           => $boutique_theme_defaults['sidebar_width'],
			'transport'         => 'refresh',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boutique_theme_sanitize_callback',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sidebar_width', array(
				'label'   => __( 'Sidebar Width', 'boutique-kids' ),
				'section' => 'boutique_responsive',
				'type'    => 'text',
			)
		) );
		$done_settings['sidebar_width'] = true;

		/* font colors */
		$wp_customize->add_section( 'boutique_font_color', array(
			'title' => __( 'Link Colors', 'boutique-kids' ),
			// 'priority'   => 30,
		) );
		foreach ( $boutique_theme_defaults as $key => $val ) {
			if ( strpos( $key, 'font_color_' ) !== false && ! isset( $done_settings[ $key ] ) ) {
				$wp_customize->add_setting( $key, array(
					'default'              => $val,
					'transport'            => 'refresh',
					'sanitize_callback'    => 'sanitize_hex_color_no_hash',
					'sanitize_js_callback' => 'maybe_hash_hex_color',
					'capability'           => 'edit_theme_options',
				) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key,
					array(
						'label'    => ucwords( str_replace( '_', ' ', str_replace( 'font_color_', '', $key ) ) ),
						'section'  => 'boutique_font_color',
						'priority' => $p ++,
					)
				) );
				$done_settings[ $key ] = true;
			}
		}

		/* site colors */
		$wp_customize->add_section( 'boutique_other_color', array(
			'title' => __( 'Other Colors', 'boutique-kids' ),
			// 'priority'   => 30,
		) );
		foreach ( $boutique_theme_defaults as $key => $val ) {
			if ( strpos( $key, 'color_' ) !== false && ! isset( $done_settings[ $key ] ) ) {
				$wp_customize->add_setting( $key, array(
					'default'              => $val,
					'transport'            => 'refresh',
					'sanitize_callback'    => 'sanitize_hex_color_no_hash',
					'sanitize_js_callback' => 'maybe_hash_hex_color',
					'capability'           => 'edit_theme_options',
				) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key,
					array(
						'label'    => ucwords( str_replace( '_', ' ', str_replace( 'color_', '', $key ) ) ),
						'section'  => 'boutique_other_color',
						'priority' => $p ++,
					)
				) );
				$done_settings[ $key ] = true;
			}
		}

	}

}