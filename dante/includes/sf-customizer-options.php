<?php 

	/*
	*
	*	Theme Customizer Options
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*	sf_customize_register()
	*	sf_customize_preview()
	*
	*/
	
	if (!function_exists('sf_customize_register')) {
		function sf_customize_register($wp_customize) {
		
			$wp_customize->get_setting('blogname')->transport='postMessage';
			$wp_customize->get_setting('blogdescription')->transport='postMessage';
			$wp_customize->get_setting('header_textcolor')->transport='postMessage';	
						
			/* MAIN COLOR SCHEME
			================================================== */
			
			$wp_customize->add_section( 'color_scheme', array(
			    'title'          => __( 'Color - Accent', 'swift-framework-admin' ),
			    'priority'       => 202,
			    'description'	 => __( 'These colours are used throughout the theme to give your site consistent styling, these would likely be colours from your identity colour scheme.', 'swift-framework-admin' ),
			) );
			
			$wp_customize->add_setting( 'accent_color', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'accent_alt_color', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'secondary_accent_color', array(
				'default'        => '#2e2e36',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'secondary_accent_alt_color', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
					
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
				'label'   => __( 'Accent Color', 'swift-framework-admin' ),
				'section' => 'color_scheme',
				'settings'   => 'accent_color',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_alt_color', array(
				'label'   => __( 'Accent Alt Color', 'swift-framework-admin' ),
				'section' => 'color_scheme',
				'settings'   => 'accent_alt_color',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_accent_color', array(
				'label'   => __( 'Secondary Accent Color', 'swift-framework-admin' ),
				'section' => 'color_scheme',
				'settings'   => 'secondary_accent_color',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_accent_alt_color', array(
				'label'   => __( 'Secondary Accent Alt Color', 'swift-framework-admin' ),
				'section' => 'color_scheme',
				'settings'   => 'secondary_accent_alt_color',
			) ) );
			
			
			/* PAGE STYLING
			================================================== */
			
			$wp_customize->add_section( 'page_styling', array(
			    'title'          => __( 'Color - Page', 'swift-framework-admin' ),
			    'priority'       => 203,
			) );
			
			$wp_customize->add_setting( 'page_bg_color', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
	
			$wp_customize->add_setting( 'inner_page_bg_color', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'section_divide_color', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'alt_bg_color', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_bg_color', array(
				'label'   => __( 'Background colour (bordered only)', 'swift-framework-admin' ),
				'section' => 'page_styling',
				'settings'   => 'page_bg_color',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inner_page_bg_color', array(
				'label'   => __( 'Inner page background color', 'swift-framework-admin' ),
				'section' => 'page_styling',
				'settings'   => 'inner_page_bg_color',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'section_divide_color', array(
				'label'   => __( 'Section divide color', 'swift-framework-admin' ),
				'section' => 'page_styling',
				'settings'   => 'section_divide_color',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alt_bg_color', array(
				'label'   => __( 'Alt Background Color', 'swift-framework-admin' ),
				'section' => 'page_styling',
				'settings'   => 'alt_bg_color',
			) ) );
			
			
			/* HEADER STYLING
			================================================== */
			
			$wp_customize->add_section( 'header_styling', array(
			    'title'          => __( 'Color - Header', 'swift-framework-admin' ),
			    'priority'       => 204,
			) );
			
			$wp_customize->add_setting( 'header_aux_text_color', array(
				'default'        => '#fff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'topbar_bg_color', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'topbar_text_color', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'topbar_link_color', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'topbar_link_hover_color', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'topbar_divider_color', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'header_bg_color1', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'header_bg_color2', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'header_border_color', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_aux_text_color', array(
				'label'   => __( 'Header Aux Text Color', 'swift-framework-admin' ),
				'section' => 'header_styling',
				'settings'   => 'header_aux_text_color',
				'priority'       => 1,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_bg_color', array(
				'label'   => __( 'Top Bar Background Color', 'swift-framework-admin' ),
				'section' => 'header_styling',
				'settings'   => 'topbar_bg_color',
				'priority'       => 2,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_text_color', array(
				'label'   => __( 'Top Bar Text Color', 'swift-framework-admin' ),
				'section' => 'header_styling',
				'settings'   => 'topbar_text_color',
				'priority'       => 3,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_link_color', array(
				'label'   => __( 'Top Bar Link Color', 'swift-framework-admin' ),
				'section' => 'header_styling',
				'settings'   => 'topbar_link_color',
				'priority'       => 4,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_link_hover_color', array(
				'label'   => __( 'Top Bar Link Hover Color', 'swift-framework-admin' ),
				'section' => 'header_styling',
				'settings'   => 'topbar_link_hover_color',
				'priority'       => 5,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_divider_color', array(
				'label'   => __( 'Top Bar Divider Color', 'swift-framework-admin' ),
				'section' => 'header_styling',
				'settings'   => 'topbar_divider_color',
				'priority'       => 6,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color1', array(
				'label'   => __( 'Header Background Color Gradient Top', 'swift-framework-admin' ),
				'section' => 'header_styling',
				'settings'   => 'header_bg_color1',
				'priority'       => 7,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color2', array(
				'label'   => __( 'Header Background Color Gradient Bottom', 'swift-framework-admin' ),
				'section' => 'header_styling',
				'settings'   => 'header_bg_color2',
				'priority'       => 8,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_border_color', array(
				'label'   => __( 'Header Border Color', 'swift-framework-admin' ),
				'section' => 'header_styling',
				'settings'   => 'header_border_color',
				'priority'       => 9,
			) ) );
			
			
			/* NAVIGATION STYLING
			================================================== */
			
			$wp_customize->add_section( 'nav_styling', array(
			    'title'          => __( 'Color - Navigation', 'swift-framework-admin' ),
			    'priority'       => 205,
			) );
					
			$wp_customize->add_setting( 'nav_text_color', array(
				'default'        => '#252525',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'nav_text_hover_color', array(
				'default'        => '#07c1b6',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'nav_selected_text_color', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'nav_pointer_color', array(
				'default'        => '#07c1b6',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'nav_sm_bg_color', array(
				'default'        => '#FFFFFF',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'nav_sm_text_color', array(
				'default'        => '#666666',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'nav_sm_bg_hover_color', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'nav_sm_text_hover_color', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'nav_sm_selected_text_color', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'nav_divider', array(
				'default'        => 'solid',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'nav_divider_color', array(
				'default'        => '#f0f0f0',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );	
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_text_color', array(
				'label'   => __( 'Nav Text Color', 'swift-framework-admin' ),
				'section' => 'nav_styling',
				'settings'   => 'nav_text_color',
				'priority'       => 2,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_text_hover_color', array(
				'label'   => __( 'Nav Text Hover Color', 'swift-framework-admin' ),
				'section' => 'nav_styling',
				'settings'   => 'nav_text_hover_color',
				'priority'       => 3,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_selected_text_color', array(
				'label'   => __( 'Nav Selected Text Color', 'swift-framework-admin' ),
				'section' => 'nav_styling',
				'settings'   => 'nav_selected_text_color',
				'priority'       => 4,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_pointer_color', array(
				'label'   => __( 'Nav Pointer Color', 'swift-framework-admin' ),
				'section' => 'nav_styling',
				'settings'   => 'nav_pointer_color',
				'priority'       => 5,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_bg_color', array(
				'label'   => __( 'Sub Menu Background Color', 'swift-framework-admin' ),
				'section' => 'nav_styling',
				'settings'   => 'nav_sm_bg_color',
				'priority'       => 6,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_text_color', array(
				'label'   => __( 'Sub Menu Text Color', 'swift-framework-admin' ),
				'section' => 'nav_styling',
				'settings'   => 'nav_sm_text_color',
				'priority'       => 7,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_bg_hover_color', array(
				'label'   => __( 'Sub Menu Background Hover Color', 'swift-framework-admin' ),
				'section' => 'nav_styling',
				'settings'   => 'nav_sm_bg_hover_color',
				'priority'       => 8,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_text_hover_color', array(
				'label'   => __( 'Sub Menu Text Hover Color', 'swift-framework-admin' ),
				'section' => 'nav_styling',
				'settings'   => 'nav_sm_text_hover_color',
				'priority'       => 9,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_selected_text_color', array(
				'label'   => __( 'Sub Menu Selected Text Color', 'swift-framework-admin' ),
				'section' => 'nav_styling',
				'settings'   => 'nav_sm_selected_text_color',
				'priority'       => 10,
			) ) );
			
			$wp_customize->add_control( 'nav_divider', array(
				'label'   => 'Nav Divider Style',
				'section' => 'nav_styling',
				'type'    => 'select',
				'priority'       => 11,
				'choices'    => array(
					'dotted' => 'Dotted',
					'solid'	 => 'Solid',
					'none'   => 'none'
					),
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_divider_color', array(
				'label'   => __( 'Nav Divider Color', 'swift-framework-admin' ),
				'section' => 'nav_styling',
				'settings'   => 'nav_divider_color',
				'priority'       => 12,
			) ) );
			
			/* PROMO BAR STYLING
			================================================== */
					
			$wp_customize->add_section( 'promo_bar_styling', array(
			    'title'          => __( 'Color - Promo Bar', 'swift-framework-admin' ),
			    'priority'       => 206,
			) );
	
			$wp_customize->add_setting( 'promo_bar_bg_color', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'promo_bar_text_color', array(
				'default'        => '#222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'promo_bar_bg_color', array(
				'label'   => __( 'Promo Bar Background Color', 'swift-framework-admin' ),
				'section' => 'promo_bar_styling',
				'settings'   => 'promo_bar_bg_color',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'promo_bar_text_color', array(
				'label'   => __( 'Promo Bar Text Color', 'swift-framework-admin' ),
				'section' => 'promo_bar_styling',
				'settings'   => 'promo_bar_text_color',
			) ) );
			
			
			/* PAGE HEADING STYLING
			================================================== */
					
			$wp_customize->add_section( 'page_heading_styling', array(
			    'title'          => __( 'Color - Page Heading', 'swift-framework-admin' ),
			    'priority'       => 207,
			) );
	
			$wp_customize->add_setting( 'page_heading_bg_color', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'page_heading_text_color', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
	
			$wp_customize->add_setting( 'breadcrumb_text_color', array(
				'default'        => '#333333',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'breadcrumb_link_color', array(
				'default'        => '#333333',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_heading_bg_color', array(
				'label'   => __( 'Page Heading Background Color', 'swift-framework-admin' ),
				'section' => 'page_heading_styling',
				'settings'   => 'page_heading_bg_color',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_heading_text_color', array(
				'label'   => __( 'Page Heading Text Color', 'swift-framework-admin' ),
				'section' => 'page_heading_styling',
				'settings'   => 'page_heading_text_color',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_text_color', array(
				'label'   => __( 'Breadcrumb Text Color', 'swift-framework-admin' ),
				'section' => 'page_heading_styling',
				'settings'   => 'breadcrumb_text_color',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_link_color', array(
				'label'   => __( 'Breadcrumb Link Color', 'swift-framework-admin' ),
				'section' => 'page_heading_styling',
				'settings'   => 'breadcrumb_link_color',
			) ) );
			
			
			/* BODY STYLING
			================================================== */
			
			$wp_customize->add_section( 'body_styling', array(
			    'title'          => __( 'Color - Body', 'swift-framework-admin' ),
			    'priority'       => 208,
			) );
			
			$wp_customize->add_setting( 'body_color', array(
				'default'        => '#444444',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'body_alt_color', array(
				'default'        => '#999999',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'link_color', array(
				'default'        => '#333333',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'link_hover_color', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'h1_color', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'h2_color', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'h3_color', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'h4_color', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'h5_color', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'h6_color', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'impact_text_color', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_color', array(
				'label'   => __( 'Body Text Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'body_color',
				'priority'       => 1,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_alt_color', array(
				'label'   => __( 'Body Alt Text Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'body_alt_color',
				'priority'       => 2,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
				'label'   => __( 'Link Text Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'link_color',
				'priority'       => 3,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
				'label'   => __( 'Link Text Hover Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'link_hover_color',
				'priority'       => 4,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h1_color', array(
				'label'   => __( 'H1 Text Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'h1_color',
				'priority'       => 5,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h2_color', array(
				'label'   => __( 'H2 Text Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'h2_color',
				'priority'       => 6,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h3_color', array(
				'label'   => __( 'H3 Text Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'h3_color',
				'priority'       => 7,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h4_color', array(
				'label'   => __( 'H4 Text Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'h4_color',
				'priority'       => 8,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h5_color', array(
				'label'   => __( 'H5 Text Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'h5_color',
				'priority'       => 9,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h6_color', array(
				'label'   => __( 'H6 Text Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'h6_color',
				'priority'       => 10,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'impact_text_color', array(
				'label'   => __( 'Impact Text Color', 'swift-framework-admin' ),
				'section' => 'body_styling',
				'settings'   => 'impact_text_color',
				'priority'       => 11,
			) ) );
			
			
			/* SHORTCODE STYLING
			================================================== */
			
			$wp_customize->add_section( 'shortcode_styling', array(
			    'title'          => __( 'Color - Shortcodes', 'swift-framework-admin' ),
			    'priority'       => 209,
			) );
			
			$wp_customize->add_setting( 'pt_primary_bg_color', array(
				'default'        => '#00AEEF',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'pt_secondary_bg_color', array(
				'default'        => '#B4E5F8',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'pt_tertiary_bg_color', array(
				'default'        => '#E1F3FA',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'lpt_primary_row_color', array(
				'default'        => '#fff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'lpt_secondary_row_color', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'lpt_default_pricing_header', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'lpt_default_package_header', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'lpt_default_footer', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'icon_container_bg_color', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'sf_icon_color', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'sf_icon_alt_color', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'boxed_content_color', array(
				'default'        => '#fb3c2d',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
					
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pt_primary_bg_color', array(
				'label'   => __( 'Pricing Table Primary Background Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'pt_primary_bg_color',
				'priority'       => 1,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pt_secondary_bg_color', array(
				'label'   => __( 'Pricing Table Secondary Background Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'pt_secondary_bg_color',
				'priority'       => 2,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pt_tertiary_bg_color', array(
				'label'   => __( 'Pricing Table Tertiary Background Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'pt_tertiary_bg_color',
				'priority'       => 3,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lpt_primary_row_color', array(
				'label'   => __( 'Labelled Pricing Table Primary Row Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'lpt_primary_row_color',
				'priority'       => 4,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lpt_secondary_row_color', array(
				'label'   => __( 'Labelled Pricing Table Secondary Row Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'lpt_secondary_row_color',
				'priority'       => 5,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lpt_default_pricing_header', array(
				'label'   => __( 'Labelled Pricing Table Default Pricing Background Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'lpt_default_pricing_header',
				'priority'       => 6,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lpt_default_package_header', array(
				'label'   => __( 'Labelled Pricing Table Default Package Background Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'lpt_default_package_header',
				'priority'       => 7,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lpt_default_footer', array(
				'label'   => __( 'Labelled Pricing Table Default Footer Background Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'lpt_default_footer',
				'priority'       => 8,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_container_bg_color', array(
				'label'   => __( 'Icon Container Background Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'icon_container_bg_color',
				'priority'       => 9,
			) ) );	
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sf_icon_color', array(
				'label'   => __( 'Icon Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_icon_color',
				'priority'       => 10,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sf_icon_alt_color', array(
				'label'   => __( 'Icon Hover/Alt Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_icon_alt_color',
				'priority'       => 11,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boxed_content_color', array(
				'label'   => __( 'Boxed Content Coloured BG Color', 'swift-framework-admin' ),
				'section' => 'shortcode_styling',
				'settings'   => 'boxed_content_color',
				'priority'       => 12,
			) ) );
			
			
			/* EXTRA ICON STYLING
			================================================== */
			
			$wp_customize->add_section( 'extra_icon_styling', array(
			    'title'          => __( 'Color - Icons (Extra options)', 'swift-framework-admin' ),
			    'priority'       => 210,
			    'description'	 => __( 'These colours can be used in any of the icon/icon box shortcodes. The Icon colour is the standard colour of the icon, and the hover background colour. The Alt colour is the colour of the icon when hovered.', 'swift-framework-admin' ),
			) );
			
			$wp_customize->add_setting( 'icon_one_color', array(
				'default'        => '#FF9900',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'icon_one_alt_color', array(
				'default'        => '#FFFFFF',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'icon_two_color', array(
				'default'        => '#339933',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'icon_two_alt_color', array(
				'default'        => '#FFFFFF',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'icon_three_color', array(
				'default'        => '#CCCCCC',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'icon_three_alt_color', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'icon_four_color', array(
				'default'        => '#6633ff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'icon_four_alt_color', array(
				'default'        => '#FFFFFF',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
					
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_one_color', array(
				'label'   => __( 'Icon One Color', 'swift-framework-admin' ),
				'section' => 'extra_icon_styling',
				'settings'   => 'icon_one_color',
				'priority'       => 1,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_one_alt_color', array(
				'label'   => __( 'Icon One Alt Color', 'swift-framework-admin' ),
				'section' => 'extra_icon_styling',
				'settings'   => 'icon_one_alt_color',
				'priority'       => 2,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_two_color', array(
				'label'   => __( 'Icon Two Color', 'swift-framework-admin' ),
				'section' => 'extra_icon_styling',
				'settings'   => 'icon_two_color',
				'priority'       => 3,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_two_alt_color', array(
				'label'   => __( 'Icon Two Alt Color', 'swift-framework-admin' ),
				'section' => 'extra_icon_styling',
				'settings'   => 'icon_two_alt_color',
				'priority'       => 4,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_three_color', array(
				'label'   => __( 'Icon Three Color', 'swift-framework-admin' ),
				'section' => 'extra_icon_styling',
				'settings'   => 'icon_three_color',
				'priority'       => 5,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_three_alt_color', array(
				'label'   => __( 'Icon Three Alt Color', 'swift-framework-admin' ),
				'section' => 'extra_icon_styling',
				'settings'   => 'icon_three_alt_color',
				'priority'       => 6,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_four_color', array(
				'label'   => __( 'Icon Four Color', 'swift-framework-admin' ),
				'section' => 'extra_icon_styling',
				'settings'   => 'icon_four_color',
				'priority'       => 7,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_four_alt_color', array(
				'label'   => __( 'Icon Four Alt Color', 'swift-framework-admin' ),
				'section' => 'extra_icon_styling',
				'settings'   => 'icon_four_alt_color',
				'priority'       => 8,
			) ) );
						
			
			/* FOOTER STYLING
			================================================== */
					
			$wp_customize->add_section( 'footer_styling', array(
			    'title'          => __( 'Color - Footer', 'swift-framework-admin' ),
			    'priority'       => 210,
			) );
			
			$wp_customize->add_setting( 'footer_bg_color', array(
				'default'        => '#252525',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
	
			$wp_customize->add_setting( 'footer_text_color', array(
				'default'        => '#cccccc',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'footer_border_color', array(
				'default'        => '#333333',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'copyright_bg_color', array(
				'default'        => '#252525',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'copyright_text_color', array(
				'default'        => '#999999',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'copyright_link_color', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_setting( 'copyright_link_hover_color', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
				'label'   => __( 'Footer Background Color', 'swift-framework-admin' ),
				'section' => 'footer_styling',
				'settings'   => 'footer_bg_color',
				'priority'       => 1,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
				'label'   => __( 'Footer Text Color', 'swift-framework-admin' ),
				'section' => 'footer_styling',
				'settings'   => 'footer_text_color',
				'priority'       => 3,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_border_color', array(
				'label'   => __( 'Footer Border Color', 'swift-framework-admin' ),
				'section' => 'footer_styling',
				'settings'   => 'footer_border_color',
				'priority'       => 4,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_bg_color', array(
				'label'   => __( 'Copyright Background Color', 'swift-framework-admin' ),
				'section' => 'footer_styling',
				'settings'   => 'copyright_bg_color',
				'priority'       => 5,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_text_color', array(
				'label'   => __( 'Copyright Text Color', 'swift-framework-admin' ),
				'section' => 'footer_styling',
				'settings'   => 'copyright_text_color',
				'priority'       => 6,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_link_color', array(
				'label'   => __( 'Copyright Link Color', 'swift-framework-admin' ),
				'section' => 'footer_styling',
				'settings'   => 'copyright_link_color',
				'priority'       => 7,
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_link_hover_color', array(
				'label'   => __( 'Copyright Link Hover Color', 'swift-framework-admin' ),
				'section' => 'footer_styling',
				'settings'   => 'copyright_link_hover_color',
				'priority'       => 8,
			) ) );
			
		}
		add_action( 'customize_register', 'sf_customize_register' );
	}
	
	
	function sf_customizer_live_preview() {
		wp_enqueue_script( 'sf-customizer',	get_template_directory_uri().'/js/sf-customizer.js', array( 'jquery','customize-preview' ), NULL, true);
	}
	add_action( 'customize_preview_init', 'sf_customizer_live_preview' );
	
?>