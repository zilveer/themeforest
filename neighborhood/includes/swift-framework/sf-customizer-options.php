<?php 

	/*
	*
	*	Theme Customizer Options
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	add_action( 'customize_register', 'sf_customize_register' );
	
	function sf_customize_register($wp_customize) {
	
		$wp_customize->get_setting('blogname')->transport='postMessage';
		$wp_customize->get_setting('blogdescription')->transport='postMessage';
		$wp_customize->get_setting('header_textcolor')->transport='postMessage';	
					
		/* MAIN COLOR SCHEME
		================================================== */
		
		$wp_customize->add_section( 'color_scheme', array(
		    'title'          => __( 'Color - Accent', 'swiftframework' ),
		    'priority'       => 202,
		) );
		
		$wp_customize->add_setting( 'accent_color', array(
			'default'        => '#07c1b6',
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
			'label'   => __( 'Accent Color', 'swiftframework' ),
			'section' => 'color_scheme',
			'settings'   => 'accent_color',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_alt_color', array(
			'label'   => __( 'Accent Alt Color', 'swiftframework' ),
			'section' => 'color_scheme',
			'settings'   => 'accent_alt_color',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_accent_color', array(
			'label'   => __( 'Secondary Accent Color', 'swiftframework' ),
			'section' => 'color_scheme',
			'settings'   => 'secondary_accent_color',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_accent_alt_color', array(
			'label'   => __( 'Secondary Accent Alt Color', 'swiftframework' ),
			'section' => 'color_scheme',
			'settings'   => 'secondary_accent_alt_color',
		) ) );
		
		
		/* PAGE STYLING
		================================================== */
		
		$wp_customize->add_section( 'page_styling', array(
		    'title'          => __( 'Color - Page', 'swiftframework' ),
		    'priority'       => 203,
		) );
		
		$wp_customize->add_setting( 'page_bg_color', array(
			'default'        => '#e4e4e4',
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
			'label'   => __( 'Background colour (bordered only)', 'swiftframework' ),
			'section' => 'page_styling',
			'settings'   => 'page_bg_color',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inner_page_bg_color', array(
			'label'   => __( 'Inner page background color', 'swiftframework' ),
			'section' => 'page_styling',
			'settings'   => 'inner_page_bg_color',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'section_divide_color', array(
			'label'   => __( 'Section divide color', 'swiftframework' ),
			'section' => 'page_styling',
			'settings'   => 'section_divide_color',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alt_bg_color', array(
			'label'   => __( 'Alt Background Color', 'swiftframework' ),
			'section' => 'page_styling',
			'settings'   => 'alt_bg_color',
		) ) );
		
		
		/* HEADER STYLING
		================================================== */
		
		$wp_customize->add_section( 'header_styling', array(
		    'title'          => __( 'Color - Header', 'swiftframework' ),
		    'priority'       => 204,
		) );
		
		$wp_customize->add_setting( 'topbar_bg_color', array(
			'default'        => '#252525',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'topbar_text_color', array(
			'default'        => '#999999',
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
			'default'        => '#07c1b6',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'topbar_divider_color', array(
			'default'        => '#444444',
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
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_bg_color', array(
			'label'   => __( 'Top Bar Background Color', 'swiftframework' ),
			'section' => 'header_styling',
			'settings'   => 'topbar_bg_color',
			'priority'       => 1,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_text_color', array(
			'label'   => __( 'Top Bar Text Color', 'swiftframework' ),
			'section' => 'header_styling',
			'settings'   => 'topbar_text_color',
			'priority'       => 2,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_link_color', array(
			'label' => __( 'Top Bar Link Color', 'swiftframework' ),
			'section' => 'header_styling',
			'settings' => 'topbar_link_color',
			'priority' => 3,
		) ) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_link_hover_color', array(
			'label'   => __( 'Top Bar Link Hover Color', 'swiftframework' ),
			'section' => 'header_styling',
			'settings'   => 'topbar_link_hover_color',
			'priority'       => 3,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_divider_color', array(
			'label'   => __( 'Top Bar Divider Color', 'swiftframework' ),
			'section' => 'header_styling',
			'settings'   => 'topbar_divider_color',
			'priority'       => 4,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color1', array(
			'label'   => __( 'Header Background Color Gradient Top', 'swiftframework' ),
			'section' => 'header_styling',
			'settings'   => 'header_bg_color1',
			'priority'       => 5,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color2', array(
			'label'   => __( 'Header Background Color Gradient Bottom', 'swiftframework' ),
			'section' => 'header_styling',
			'settings'   => 'header_bg_color2',
			'priority'       => 6,
		) ) );
		
		
		/* NAVIGATION STYLING
		================================================== */
		
		$wp_customize->add_section( 'nav_styling', array(
		    'title'          => __( 'Color - Navigation', 'swiftframework' ),
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
			'default'        => '#1bbeb4',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'nav_sm_text_hover_color', array(
			'default'        => '#ffffff',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'nav_sm_selected_text_color', array(
			'default'        => '#ffffff',
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
			'label'   => __( 'Nav Text Color', 'swiftframework' ),
			'section' => 'nav_styling',
			'settings'   => 'nav_text_color',
			'priority'       => 2,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_text_hover_color', array(
			'label'   => __( 'Nav Text Hover Color', 'swiftframework' ),
			'section' => 'nav_styling',
			'settings'   => 'nav_text_hover_color',
			'priority'       => 3,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_selected_text_color', array(
			'label'   => __( 'Nav Selected Text Color', 'swiftframework' ),
			'section' => 'nav_styling',
			'settings'   => 'nav_selected_text_color',
			'priority'       => 4,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_pointer_color', array(
			'label'   => __( 'Nav Pointer Color', 'swiftframework' ),
			'section' => 'nav_styling',
			'settings'   => 'nav_pointer_color',
			'priority'       => 5,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_bg_color', array(
			'label'   => __( 'Sub Menu Background Color', 'swiftframework' ),
			'section' => 'nav_styling',
			'settings'   => 'nav_sm_bg_color',
			'priority'       => 6,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_text_color', array(
			'label'   => __( 'Sub Menu Text Color', 'swiftframework' ),
			'section' => 'nav_styling',
			'settings'   => 'nav_sm_text_color',
			'priority'       => 7,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_bg_hover_color', array(
			'label'   => __( 'Sub Menu Background Hover Color', 'swiftframework' ),
			'section' => 'nav_styling',
			'settings'   => 'nav_sm_bg_hover_color',
			'priority'       => 8,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_text_hover_color', array(
			'label'   => __( 'Sub Menu Text Hover Color', 'swiftframework' ),
			'section' => 'nav_styling',
			'settings'   => 'nav_sm_text_hover_color',
			'priority'       => 9,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_selected_text_color', array(
			'label'   => __( 'Sub Menu Selected Text Color', 'swiftframework' ),
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
			'label'   => __( 'Nav Divider Color', 'swiftframework' ),
			'section' => 'nav_styling',
			'settings'   => 'nav_divider_color',
			'priority'       => 12,
		) ) );
		
		/* PROMO BAR STYLING
		================================================== */
				
		$wp_customize->add_section( 'promo_bar_styling', array(
		    'title'          => __( 'Color - Promo Bar', 'swiftframework' ),
		    'priority'       => 206,
		) );

		$wp_customize->add_setting( 'promo_bar_bg_color', array(
			'default'        => '#ef3f32',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'promo_bar_text_color', array(
			'default'        => '#ffffff',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'promo_bar_bg_color', array(
			'label'   => __( 'Promo Bar Background Color', 'swiftframework' ),
			'section' => 'promo_bar_styling',
			'settings'   => 'promo_bar_bg_color',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'promo_bar_text_color', array(
			'label'   => __( 'Promo Bar Text Color', 'swiftframework' ),
			'section' => 'promo_bar_styling',
			'settings'   => 'promo_bar_text_color',
		) ) );
		
		
		/* PAGE HEADING STYLING
		================================================== */
				
		$wp_customize->add_section( 'page_heading_styling', array(
		    'title'          => __( 'Color - Page Heading', 'swiftframework' ),
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
			'default'        => '#999999',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'breadcrumb_link_color', array(
			'default'        => '#999999',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_heading_bg_color', array(
			'label'   => __( 'Page Heading Background Color', 'swiftframework' ),
			'section' => 'page_heading_styling',
			'settings'   => 'page_heading_bg_color',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_heading_text_color', array(
			'label'   => __( 'Page Heading Text Color', 'swiftframework' ),
			'section' => 'page_heading_styling',
			'settings'   => 'page_heading_text_color',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_text_color', array(
			'label'   => __( 'Breadcrumb Text Color', 'swiftframework' ),
			'section' => 'page_heading_styling',
			'settings'   => 'breadcrumb_text_color',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_link_color', array(
			'label'   => __( 'Breadcrumb Link Color', 'swiftframework' ),
			'section' => 'page_heading_styling',
			'settings'   => 'breadcrumb_link_color',
		) ) );
		
		
		/* BODY STYLING
		================================================== */
		
		$wp_customize->add_section( 'body_styling', array(
		    'title'          => __( 'Color - Body', 'swiftframework' ),
		    'priority'       => 208,
		) );
		
		$wp_customize->add_setting( 'body_color', array(
			'default'        => '#444444',
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
			'label'   => __( 'Body Text Color', 'swiftframework' ),
			'section' => 'body_styling',
			'settings'   => 'body_color',
			'priority'       => 1,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'   => __( 'Link Text Color', 'swiftframework' ),
			'section' => 'body_styling',
			'settings'   => 'link_color',
			'priority'       => 2,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h1_color', array(
			'label'   => __( 'H1 Text Color', 'swiftframework' ),
			'section' => 'body_styling',
			'settings'   => 'h1_color',
			'priority'       => 3,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h2_color', array(
			'label'   => __( 'H2 Text Color', 'swiftframework' ),
			'section' => 'body_styling',
			'settings'   => 'h2_color',
			'priority'       => 4,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h3_color', array(
			'label'   => __( 'H3 Text Color', 'swiftframework' ),
			'section' => 'body_styling',
			'settings'   => 'h3_color',
			'priority'       => 5,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h4_color', array(
			'label'   => __( 'H4 Text Color', 'swiftframework' ),
			'section' => 'body_styling',
			'settings'   => 'h4_color',
			'priority'       => 6,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h5_color', array(
			'label'   => __( 'H5 Text Color', 'swiftframework' ),
			'section' => 'body_styling',
			'settings'   => 'h5_color',
			'priority'       => 7,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h6_color', array(
			'label'   => __( 'H6 Text Color', 'swiftframework' ),
			'section' => 'body_styling',
			'settings'   => 'h6_color',
			'priority'       => 8,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'impact_text_color', array(
			'label'   => __( 'Impact Text Color', 'swiftframework' ),
			'section' => 'body_styling',
			'settings'   => 'impact_text_color',
			'priority'       => 9,
		) ) );
		
		
		/* SHORTCODE STYLING
		================================================== */
		
		$wp_customize->add_section( 'shortcode_styling', array(
		    'title'          => __( 'Color - Shortcodes', 'swiftframework' ),
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
			'default'        => '#f7f7f7',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'lpt_secondary_row_color', array(
			'default'        => '#eeeeee',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'lpt_default_pricing_header', array(
			'default'        => '#999999',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'lpt_default_package_header', array(
			'default'        => '#bbbbbb',
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
			'default'        => '#B4E5F8',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'sf_icon_color', array(
			'default'        => '#000000',
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
			'label'   => __( 'Pricing Table Primary Background Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'pt_primary_bg_color',
			'priority'       => 1,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pt_secondary_bg_color', array(
			'label'   => __( 'Pricing Table Secondary Background Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'pt_secondary_bg_color',
			'priority'       => 2,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pt_tertiary_bg_color', array(
			'label'   => __( 'Pricing Table Tertiary Background Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'pt_tertiary_bg_color',
			'priority'       => 3,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lpt_primary_row_color', array(
			'label'   => __( 'Labelled Pricing Table Primary Row Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'lpt_primary_row_color',
			'priority'       => 4,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lpt_secondary_row_color', array(
			'label'   => __( 'Labelled Pricing Table Secondary Row Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'lpt_secondary_row_color',
			'priority'       => 5,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lpt_default_pricing_header', array(
			'label'   => __( 'Labelled Pricing Table Default Pricing Background Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'lpt_default_pricing_header',
			'priority'       => 6,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lpt_default_package_header', array(
			'label'   => __( 'Labelled Pricing Table Default Package Background Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'lpt_default_package_header',
			'priority'       => 7,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lpt_default_footer', array(
			'label'   => __( 'Labelled Pricing Table Default Footer Background Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'lpt_default_footer',
			'priority'       => 8,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_container_bg_color', array(
			'label'   => __( 'Icon Container Background Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'icon_container_bg_color',
			'priority'       => 9,
		) ) );	
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sf_icon_color', array(
			'label'   => __( 'Icon Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'sf_icon_color',
			'priority'       => 10,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boxed_content_color', array(
			'label'   => __( 'Boxed Content Coloured BG Color', 'swiftframework' ),
			'section' => 'shortcode_styling',
			'settings'   => 'boxed_content_color',
			'priority'       => 11,
		) ) );
		
		
		/* FOOTER STYLING
		================================================== */
				
		$wp_customize->add_section( 'footer_styling', array(
		    'title'          => __( 'Color - Footer', 'swiftframework' ),
		    'priority'       => 210,
		) );
		
		$wp_customize->add_setting( 'footer_bg_color', array(
			'default'        => '#252525',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );

		$wp_customize->add_setting( 'footer_text_color', array(
			'default'        => '#2d2f36',
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
			'default'        => '#000000',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'copyright_text_color', array(
			'default'        => '#666666',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_setting( 'copyright_link_color', array(
			'default'        => '#222222',
			'type'           => 'option',
			'transport'      => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
			'label'   => __( 'Footer Background Color', 'swiftframework' ),
			'section' => 'footer_styling',
			'settings'   => 'footer_bg_color',
			'priority'       => 1,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
			'label'   => __( 'Footer Text Color', 'swiftframework' ),
			'section' => 'footer_styling',
			'settings'   => 'footer_text_color',
			'priority'       => 3,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_border_color', array(
			'label'   => __( 'Footer Border Color', 'swiftframework' ),
			'section' => 'footer_styling',
			'settings'   => 'footer_border_color',
			'priority'       => 4,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_bg_color', array(
			'label'   => __( 'Copyright Background Color', 'swiftframework' ),
			'section' => 'footer_styling',
			'settings'   => 'copyright_bg_color',
			'priority'       => 5,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_text_color', array(
			'label'   => __( 'Copyright Text Color', 'swiftframework' ),
			'section' => 'footer_styling',
			'settings'   => 'copyright_text_color',
			'priority'       => 6,
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_link_color', array(
			'label'   => __( 'Copyright Link Color', 'swiftframework' ),
			'section' => 'footer_styling',
			'settings'   => 'copyright_link_color',
			'priority'       => 7,
		) ) );
		
		
		/* LIVE PREVIEW FUNCTION ACTION
		================================================== */
		
		if ( $wp_customize->is_preview() && ! is_admin() ) {
			add_action( 'wp_footer', 'sf_customize_preview', 21);
		}
		
	}
	
	
	/* JQUERY LIVE PREVIEW
	================================================== */
	
	
	function sf_customize_preview() {
		?>
		<script type="text/javascript">
		( function( $ ){		
		
		// MAIN STYLING
		
		wp.customize('accent_color',function( value ) {
			value.bind(function(to) {
				$('.recent-post figure,span.highlighted,span.dropcap4,.loved-item:hover .loved-count,.flickr-widget li,.portfolio-grid li,.wpcf7 input.wpcf7-submit[type="submit"],.sf-button.accent,figure .overlay,.progress .bar,.progress.standard .bar,.pagination-wrap li span.current,.blog-aux-options li.selected a').css('background-color', to ? to : '' );
				$('#copyright a,.portfolio-item .portfolio-item-permalink,.read-more-link,.blog-item .read-more,.blog-item-details a,.author-link,.comment-meta .edit-link a,.comment-meta .comment-reply a,#reply-title small a,ul.member-contact,ul.member-contact li a,span.dropcap2,.spb_divider.go_to_top a,.love-it-wrapper .loved,#header-translation p a,.caption-details-inner .details span > a,.caption-details-inner .chart span,.caption-details-inner .chart i,#swift-slider .flex-caption-large .chart i,#swift-slider .flex-caption-large .loveit-chart span,#swift-slider .flex-caption-large a,.ui-tabs .ui-tabs-nav li.ui-tabs-active a,.spb_accordion .spb_accordion_section > h3.ui-state-active a,.ui-accordion h3.ui-accordion-header.ui-state-active .ui-icon').css('color', to ? to : '' );
				$('.sidebar a:not(.sf-button),#footer a:not(.sf-button)').css('color', to ? to : '' );
				$('.bypostauthor .comment-wrap .comment-avatar,.search-form input:focus,.wpcf7 input[type="text"]:focus,.wpcf7 textarea:focus,.pagination-wrap li span.current').css('border-color', to ? to : '' );
				$('#nav-section,#mini-header,#copyright').css('border-top-color', to ? to : '' );
				$('nav .menu ul li:first-child:after,.navigation a:hover > .nav-text').css('border-bottom-color', to ? to : '' );
				$('nav .menu ul ul li:first-child:after').css('border-right-color', to ? to : '' );
			});
		});
		
		wp.customize('accent_alt_color',function( value ) {
			value.bind(function(to) {
				$('.pagination-wrap li span.current,.blog-aux-options li.selected a').css('color', to ? to : '' );
			});
		});
		
		wp.customize('secondary_accent_color',function( value ) {
			value.bind(function(to) {
				$('.related-item figure,article.type-post #respond .form-submit input#submit,.show-menu,.flexslider ul.slides,.loved-item .loved-count,.subscribers-list li > a.social-circle').css('background-color', to ? to : '' );
				$('#top-bar .show-menu,#swift-slider .flex-caption .comment-chart i,#swift-slider .flex-caption .comment-chart span,.sidebar .widget_calendar tfoot a,.widget_sf_infocus_widget .infocus-item h5 a').css('color', to ? to : '' );
				$('#calendar_wrap caption').css('border-bottom-color', to ? to : '' );
			});
		});
		
		wp.customize('secondary_accent_alt_color',function( value ) {
			value.bind(function(to) {
				$('.show-menu,#swift-slider .flex-caption-large,#swift-slider .flex-caption-large h1 a,#swift-slider .flex-caption-large .comment-chart i,.loved-item .loved-count,.subscribers-list li > a.social-circle,.sidebar .widget_calendar tbody tr > td a').css('color', to ? to : '' );
			});
		});
		
		// PAGE STYLING
		
		wp.customize('page_bg_color',function( value ) {
			value.bind(function(to) {
				$('body,#boxed-container').css('background-color', to ? to : '' );
			});
		});
		wp.customize('inner_page_bg_color',function( value ) {
			value.bind(function(to) {
				$('#container').css('background-color', to ? to : '' );
			});
		});
		wp.customize('section_divide_color',function( value ) {
			value.bind(function(to) {
				$('.minimal .spb_accordion_section,.minimal .spb_accordion_section:first-child,.spb_accordion.standard .spb_accordion_section,.spb_accordion.standard .spb_accordion_section h3.ui-state-active,.spb_divider,.spb_divider.go_to_top_icon1,.spb_divider.go_to_top_icon2,.testimonials > li,.jobs > li,.spb_impact_text,.tm-toggle-button-wrap,.tm-toggle-button-wrap a,.portfolio-details-wrap,.spb_divider.go_to_top a,blockquote.pullquote,.spb_box_text.whitestroke .box-content-wrap,.client-item figure,#footer,.pagination-wrap,.pagination-wrap li,.page-heading,.inner-page-wrap article,.inner-page-wrap .type-page,.inner-page-wrap .page-content,.inner-page-wrap .blog-listings,.pb-border-bottom,.pb-border-top,.sidebar .widget-heading h3,.widget ul li,.portfolio-item,.masonry-items .portfolio-item-details,.masonry-items .portfolio-item figure,.blog-item,.blog-item h1,.masonry-items .blog-item,.blog-item .spacer,.mini-items .blog-item-details,.author-info-wrap,.related-wrap').css('border-color', to ? to : '' );
			});
		});
		
		
		// HEADER STYLING
		wp.customize('topbar_bg_color',function( value ) {
			value.bind(function(to) {
				$('#top-bar').css('background-color', to ? to : '' );
			});
		});
		wp.customize('topbar_divider_color',function( value ) {
			value.bind(function(to) {
				$('#top-bar-date,#top-bar .menu li').css('border-color', to ? to : '' );
			});
		});
		wp.customize('topbar_text_color',function( value ) {
			value.bind(function(to) {
				$('#top-bar-date, #top-bar .menu li a').css('color', to ? to : '' );
			});
		});
		wp.customize('header_text_color',function( value ) {
			value.bind(function(to) {
				$('#header-section').css('color', to ? to : '' );
			});
		});
		
		
		// NAVIGATION STYLING
		
		wp.customize('nav_text_color',function( value ) {
			value.bind(function(to) {
				$('nav .menu li a,#menubar-controls a').css('color', to ? to : '' );
			});
		});
		wp.customize('nav_selected_text_color',function( value ) {
			value.bind(function(to) {
				$('nav .menu li.current-menu-ancestor > a, nav .menu li.current-menu-item > a').css('color', to ? to : '' );
			});
		});
		wp.customize('nav_pointer_color',function( value ) {
			value.bind(function(to) {
				$('#nav-pointer').css('background-color', to ? to : '' );
			});
		});
		wp.customize('nav_sm_bg_color',function( value ) {
			value.bind(function(to) {
				$('nav .menu ul').css('background-color', to ? to : '' );
			});
		});
		wp.customize('nav_sm_text_color',function( value ) {
			value.bind(function(to) {
				$('nav .menu ul li a').css('color', to ? to : '' );
			});
		});	
		wp.customize('nav_sm_selected_text_color',function( value ) {
			value.bind(function(to) {
				$('nav .menu ul li.current-menu-ancestor > a, nav .menu ul li.current-menu-item > a').css('color', to ? to : '' );
			});
		});
		wp.customize('nav_divider',function( value ) {
			value.bind(function(to) {
				$('nav .menu ul li').css('border-bottom-style', to ? to : '' );
			});
		});		
		wp.customize('nav_divider_color',function( value ) {
			value.bind(function(to) {
				$('nav .menu ul li').css('border-bottom-color', to ? to : '' );
				$('nav .menu ul').css('border-color', to ? to : '' );
			});
		});	
		
		
		// PAGE HEADING STYLING
		
		wp.customize('page_heading_bg_color',function( value ) {
			value.bind(function(to) {
				$('.page-heading').css('background-color', to ? to : '' );
			});
		});
		wp.customize('page_heading_text_color',function( value ) {
			value.bind(function(to) {
				$('.page-heading h1').css('color', to ? to : '' );
			});
		});
		wp.customize('breadcrumb_text_color',function( value ) {
			value.bind(function(to) {
				$('#breadcrumbs').css('color', to ? to : '' );
			});
		});
		wp.customize('breadcrumb_link_color',function( value ) {
			value.bind(function(to) {
				$('#breadcrumbs a,#breadcrumb i').css('color', to ? to : '' );
			});
		});
		
		
		// BODY STYLING
		
		wp.customize('body_color',function( value ) {
			value.bind(function(to) {
				$('body').css('color', to ? to : '' );
			});
		});
		wp.customize('h1_color',function( value ) {
			value.bind(function(to) {
				$('h1').css('color', to ? to : '' );
			});
		});
		wp.customize('h2_color',function( value ) {
			value.bind(function(to) {
				$('h2').css('color', to ? to : '' );
			});
		});
		wp.customize('h3_color',function( value ) {
			value.bind(function(to) {
				$('h3').css('color', to ? to : '' );
			});
		});
		wp.customize('h4_color',function( value ) {
			value.bind(function(to) {
				$('h4').css('color', to ? to : '' );
			});
		});
		wp.customize('h5_color',function( value ) {
			value.bind(function(to) {
				$('h5').css('color', to ? to : '' );
			});
		});
		wp.customize('h6_color',function( value ) {
			value.bind(function(to) {
				$('h6').css('color', to ? to : '' );
			});
		});
		wp.customize('impact_text_color',function( value ) {
			value.bind(function(to) {
				$('.spb_impact_text .spb_call_text,.impact-text').css('color', to ? to : '' );
			});
		});
		
		
		// SHORTCODES STYLING
		
		wp.customize('pt_primary_bg_color',function( value ) {
			value.bind(function(to) {
				$('.column-highlight .pricing-table-price').css('background-color', to ? to : '' );
				$('.column-highlight .pricing-table-price').css('border-bottom-color', to ? to : '' );
			});
		});
		wp.customize('pt_secondary_bg_color',function( value ) {
			value.bind(function(to) {
				$('.column-highlight .pricing-table-package').css('background-color', to ? to : '' );
			});
		});
		wp.customize('pt_tertiary_bg_color',function( value ) {
			value.bind(function(to) {
				$('.column-highlight .pricing-table-details').css('background-color', to ? to : '' );
			});
		});
		wp.customize('icon_container_bg_color',function( value ) {
			value.bind(function(to) {
				$('.sf-icon-cont').css('background-color', to ? to : '' );
			});
		});		
		wp.customize('sf_icon_color',function( value ) {
			value.bind(function(to) {
				$('.sf-icon').css('color', to ? to : '' );
			});
		});
			
		
		// FOOTER STYLING
		
		wp.customize('footer_bg_color',function( value ) {
			value.bind(function(to) {
				$('#footer').css('background-color', to ? to : '' );
			});
		});
		wp.customize('footer_text_color',function( value ) {
			value.bind(function(to) {
				$('#footer, #footer h5, #footer p').css('color', to ? to : '' );
			});
		});
		wp.customize('copyright_bg_color',function( value ) {
			value.bind(function(to) {
				$('#copyright').css('background-color', to ? to : '' );
			});
		});
		wp.customize('copyright_text_color',function( value ) {
			value.bind(function(to) {
				$('#copyright p').css('color', to ? to : '' );
			});
		});
		wp.customize('copyright_link_color',function( value ) {
			value.bind(function(to) {
				$('#copyright a').css('color', to ? to : '' );
			});
		});
		
	
		wp.customize( 'blogname', function( value ) {
			value.bind( function( to ) {
				$( '#site-title a' ).html( to );
			} );
		} );
		wp.customize( 'blogdescription', function( value ) {
			value.bind( function( to ) {
				$( '#site-description' ).html( to );
			} );
		} );
		} )( jQuery )
		</script>
		<?php 
	}
?>