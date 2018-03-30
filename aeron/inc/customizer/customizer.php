<?php

require_once( get_template_directory(). '/inc/customizer/custom_controls.php' );
require_once( get_template_directory(). '/inc/customizer/import_redux_options.php' );

function aeron_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';


	/**
	------------------------------------------------------------
	SECTION: General
	------------------------------------------------------------
	**/
	$wp_customize->add_section('section_general', array(
		'title'		=> __('General', 'ABdev_aeron'),
		'priority'	=> 0,
	));

		/**
		Disable Responsiveness
		**/
		$wp_customize->add_setting('disable_responsiveness', array(
			'default'     => true,
			'sanitize_callback' => 'ABdev_aeron_checkbox_sanitization',
		));
		$wp_customize->add_control(new Toggle_Checkbox_Custom_control($wp_customize, 'disable_responsiveness', array(
			'label'    		=> esc_html__('Disable Responsiveness', 'ABdev_aeron'),
			'type'     		=> 'checkbox',
			'section'  		=> 'section_general',
		)));

		/**
		Google Map API Key
		**/
		$wp_customize->add_setting('google_maps_api_key', array(
			'default'     => '',
		));
		$wp_customize->add_control('google_maps_api_key', array(
			'label'    => esc_html__('Google Map API Key', 'ABdev_aeron'),
			'description'    => esc_html__('For more details please check ', 'ABdev_aeron'). '<a href="'.esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key').'" target="_blank">'.esc_html__( 'Google Maps API v3', 'ABdev_aeron' ).'</a>' . esc_html__(' documentation.', 'ABdev_aeron'),
			'type'     => 'text',
			'section'  => 'section_general',
		));

		/**
		Header Logo
		**/
		$wp_customize->add_setting('header_logo', array(
			'default'     => '',
		));
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_logo', array(
			'label'     	=> __( 'Header Logo', 'ABdev_aeron' ),
			'description'   => __('Upload header logo', 'ABdev_aeron'),
			'settings'  	=> 'header_logo',
			'section'   	=> 'section_general',
		)));

		/**
		Header Retina Logo 
		**/
		$wp_customize->add_setting('header_retina_logo', array(
			'default'     => '',
		));
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_retina_logo', array(
			'label'     	=> esc_html__( 'Header Logo (Retina Version @2x)', 'ABdev_aeron' ),
			'description'    => esc_html__('Select an image file for the retina version of the logo. It should be exactly 2x the size of main logo.', 'ABdev_aeron'),
			'settings'  	=> 'header_retina_logo',
			'section'   	=> 'section_general',
		)));

		/**
		Header Retina Logo Width
		**/
		$wp_customize->add_setting('header_retina_logo_width', array(
			'default'     => '',
		));
		$wp_customize->add_control('header_retina_logo_width', array(
			'label'    => esc_html__('Retina Logo Width', 'ABdev_aeron'),
			'description'    => esc_html__('If retina logo is uploaded, enter the standard logo (1x) version width, do not enter the retina logo width.', 'ABdev_aeron'),
			'type'     => 'text',
			'section'  => 'section_general',
		));

		/**
		Header Retina Logo Height
		**/
		$wp_customize->add_setting('header_retina_logo_height', array(
			'default'     => '',
		));
		$wp_customize->add_control('header_retina_logo_height', array(
			'label'    => esc_html__('Retina Logo Height', 'ABdev_aeron'),
			'description'    => esc_html__('If retina logo is uploaded, enter the standard logo (1x) version height, do not enter the retina logo height.', 'ABdev_aeron'),
			'type'     => 'text',
			'section'  => 'section_general',
		));

		/**
		Hide Comments
		**/
		$wp_customize->add_setting('hide_comments', array(
			'default'     => true,
			'sanitize_callback' => 'ABdev_aeron_checkbox_sanitization',
		));
		$wp_customize->add_control(new Toggle_Checkbox_Custom_control($wp_customize, 'hide_comments', array(
			'label'    		=> esc_html__('Hide Comments', 'ABdev_aeron'),
			'description'   => __('Check this to hide WordPress comments', 'ABdev_aeron'),
			'type'     		=> 'checkbox',
			'section'  		=> 'section_general',
		)));

		/**
		Boxed Body
		**/
		$wp_customize->add_setting('boxed_body', array(
			'default'     => true,
			'sanitize_callback' => 'ABdev_aeron_checkbox_sanitization',
		));
		$wp_customize->add_control(new Toggle_Checkbox_Custom_control($wp_customize, 'boxed_body', array(
			'label'    		=> esc_html__('Boxed Body', 'ABdev_aeron'),
			'description'   => __('Check this to enable boxed body layout', 'ABdev_aeron'),
			'type'     		=> 'checkbox',
			'section'  		=> 'section_general',
		)));

		/**
		Body Background
		**/
		$wp_customize->add_setting('bg_color', array(
			'default'     => '#fff',
			'transport'	  => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bg_color', array(
			'label'      => esc_attr__('Background Color', 'ABdev_aeron'),
			'settings'   => 'bg_color',
			'section'    => 'section_general',
		)));


        $wp_customize->add_setting( 'custom_bg_image', array(
            'default'        => '',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_bg_image' , array(
			'label'      => esc_attr__('Background Image', 'ABdev_aeron'),
			'settings'   => 'custom_bg_image',
			'section'    => 'section_general',
        )));


        $wp_customize->add_setting( 'aeron_background_repeat', array(
            'default'        => 'no-repeat',
        ) );

        $wp_customize->add_control( 'aeron_background_repeat', array(
            'label'      => esc_attr__( 'Background Repeat', 'ABdev_aeron' ),
            'section'    => 'section_general',
            'type'       => 'select',
            'choices'    => array(
                'no-repeat'  => esc_attr__('No Repeat', 'ABdev_aeron'),
                'repeat'     => esc_attr__('Tile', 'ABdev_aeron'),
                'repeat-x'   => esc_attr__('Tile Horizontally', 'ABdev_aeron'),
                'repeat-y'   => esc_attr__('Tile Vertically', 'ABdev_aeron'),
            ),
        ) );


        $wp_customize->add_setting( 'aeron_background_size', array(
            'default'        => 'cover',
        ) );

        $wp_customize->add_control( 'aeron_background_size', array(
            'label'      => esc_attr__( 'Background Size', 'ABdev_aeron' ),
            'section'    => 'section_general',
            'type'       => 'select',
            'choices'    => array(
                'cover'  => esc_attr__('Cover', 'ABdev_aeron'),
                'contain' => esc_attr__('Contain', 'ABdev_aeron'),
            ),
        ) );

        $wp_customize->add_setting( 'aeron_background_position', array(
            'default'  => 'center center',
        ) );

        $wp_customize->add_control( 'aeron_background_position', array(
            'label'      => esc_attr__( 'Background Position', 'ABdev_aeron' ),
            'section'    => 'section_general',
            'type'       => 'select',
            'choices'    => array(
                'left top'       => esc_attr__( 'Left Top', 'ABdev_aeron' ),
                'left center'     => esc_attr__( 'Left Center', 'ABdev_aeron' ),
                'left bottom'      => esc_attr__( 'Left Bottom', 'ABdev_aeron' ),
                'center top'       => esc_attr__( 'Center Top', 'ABdev_aeron' ),
                'center center'     => esc_attr__( 'Center Center', 'ABdev_aeron' ),
                'center bottom'      => esc_attr__( 'Center Bottom', 'ABdev_aeron' ),
                'right top'       => esc_attr__( 'Right Top', 'ABdev_aeron' ),
                'right center'     => esc_attr__( 'Right Center', 'ABdev_aeron' ),
                'right bottom'      => esc_attr__( 'Right Bottom', 'ABdev_aeron' ),
            ),
        ) );

        $wp_customize->add_setting( 'aeron_background_attachment', array(
            'default'        => 'fixed',
        ) );

        $wp_customize->add_control( 'aeron_background_attachment', array(
            'label'      => esc_attr__( 'Background Attachment', 'ABdev_aeron' ),
            'section'    => 'section_general',
            'type'       => 'select',
            'choices'    => array(
                'fixed'      => esc_attr__('Fixed', 'ABdev_aeron'),
                'scroll'     => esc_attr__('Scroll', 'ABdev_aeron'),
            ),
        ) );


	/**
	------------------------------------------------------------
	SECTION: Breadcrumbs
	------------------------------------------------------------
	**/
	$wp_customize->add_section('section_breadcrumbs', array(
		'title'		=> esc_html__('Breadcrumbs', 'ABdev_aeron'),
		'priority'	=> 0,
	));

		/**
		Hide Title/Breadcrumbs Bar
		**/
		$wp_customize->add_setting('hide_title_bar', array(
			'default'     => true,
			'sanitize_callback' => 'ABdev_aeron_checkbox_sanitization',
		));
		$wp_customize->add_control(new Toggle_Checkbox_Custom_control($wp_customize, 'hide_title_bar', array(
			'label'    		=> esc_html__('Hide Title/Breadcrumbs Bar', 'ABdev_aeron'),
			'type'     		=> 'checkbox',
			'section'  		=> 'section_breadcrumbs',
		)));

		/**
		Title/Breadcrumbs Bar Background Color
		**/
		$wp_customize->add_setting('aeron_title_breadcrumbs_color', array(
			'default'     => '#d9d9d9',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'aeron_title_breadcrumbs_color', array(
			'label'      => esc_html__('Title/Breadcrumbs Bar Background Color', 'ABdev_aeron'),
			'settings'   => 'aeron_title_breadcrumbs_color',
			'section'    => 'section_breadcrumbs',
		)));

		/**
		Title/Breadcrumbs Bar Background Image
		**/
		$wp_customize->add_setting('aeron_title_breadcrumbs_image', array(
			'default'     => '',
		));
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'aeron_title_breadcrumbs_image', array(
			'label'     	=> esc_html__( 'Title/Breadcrumbs Bar Background Image', 'ABdev_aeron' ),
			'settings'  	=> 'aeron_title_breadcrumbs_image',
			'section'   	=> 'section_breadcrumbs',
		)));


		$wp_customize->add_setting( 'aeron_title_breadcrumbs_bar_background_repeat', array(
            'default'        => 'no-repeat',
        ) );

        $wp_customize->add_control( 'aeron_title_breadcrumbs_bar_background_repeat', array(
            'label'      => esc_attr__( 'Background Repeat', 'ABdev_aeron' ),
            'section'    => 'section_breadcrumbs',
            'type'       => 'select',
            'choices'    => array(
                'no-repeat'  => esc_attr__('No Repeat', 'ABdev_aeron'),
                'repeat'     => esc_attr__('Tile', 'ABdev_aeron'),
                'repeat-x'   => esc_attr__('Tile Horizontally', 'ABdev_aeron'),
                'repeat-y'   => esc_attr__('Tile Vertically', 'ABdev_aeron'),
            ),
        ) );


        $wp_customize->add_setting( 'aeron_title_breadcrumbs_bar_background_size', array(
            'default'        => 'cover',
        ) );

        $wp_customize->add_control( 'aeron_title_breadcrumbs_bar_background_size', array(
            'label'      => esc_attr__( 'Background Size', 'ABdev_aeron' ),
            'section'    => 'section_breadcrumbs',
            'type'       => 'select',
            'choices'    => array(
                'cover'  => esc_attr__('Cover', 'ABdev_aeron'),
                'contain' => esc_attr__('Contain', 'ABdev_aeron'),
            ),
        ) );

        $wp_customize->add_setting( 'aeron_title_breadcrumbs_bar_background_position', array(
            'default'  => 'center center',
        ) );

        $wp_customize->add_control( 'aeron_title_breadcrumbs_bar_background_position', array(
            'label'      => esc_attr__( 'Background Position', 'ABdev_aeron' ),
            'section'    => 'section_breadcrumbs',
            'type'       => 'select',
            'choices'    => array(
                'left top'       => esc_attr__( 'Left Top', 'ABdev_aeron' ),
                'left center'     => esc_attr__( 'Left Center', 'ABdev_aeron' ),
                'left bottom'      => esc_attr__( 'Left Bottom', 'ABdev_aeron' ),
                'center top'       => esc_attr__( 'Center Top', 'ABdev_aeron' ),
                'center center'     => esc_attr__( 'Center Center', 'ABdev_aeron' ),
                'center bottom'      => esc_attr__( 'Center Bottom', 'ABdev_aeron' ),
                'right top'       => esc_attr__( 'Right Top', 'ABdev_aeron' ),
                'right center'     => esc_attr__( 'Right Center', 'ABdev_aeron' ),
                'right bottom'      => esc_attr__( 'Right Bottom', 'ABdev_aeron' ),
            ),
        ) );


	/**
	------------------------------------------------------------
	SECTION: Announcement Bar
	------------------------------------------------------------
	**/
	$wp_customize->add_section('section_announcement_bar', array(
		'title'		=> __('Announcement Bar', 'ABdev_aeron'),
		'priority'	=> 0,
	));

		/**
		Show Announcement Bar
		**/
		$wp_customize->add_setting('show_announcement_bar', array(
			'default'     => true,
			'sanitize_callback' => 'ABdev_aeron_checkbox_sanitization',
		));
		$wp_customize->add_control(new Toggle_Checkbox_Custom_control($wp_customize, 'show_announcement_bar', array(
			'label'    		=> esc_html__('Show Announcement Bar', 'ABdev_aeron'),
			'type'     		=> 'checkbox',
			'section'  		=> 'section_announcement_bar',
		)));

		/**
		Announcement Bar Style
		**/
		$wp_customize->add_setting( 'announcement_bar_style', array(
            'default'        => '_blank',
        ) );

        $wp_customize->add_control( 'announcement_bar_style', array(
            'label'      => esc_attr__( 'Announcement Bar Style', 'ABdev_aeron' ),
            'section'  		=> 'section_announcement_bar',
            'type'       => 'select',
            'choices'    => array(
                'announcement_bar_style_1'  => esc_attr__('Style 1', 'ABdev_aeron'),
                'announcement_bar_style_2'  => esc_attr__('Style 2', 'ABdev_aeron'),
                'announcement_bar_style_3'  => esc_attr__('Style 3', 'ABdev_aeron'),
            ),
        ) );

        /**
		Announcement Notice
		**/
		$wp_customize->add_setting('announcement_notice', array(
			'default'     => '',
			// 'transport'   => 'postMessage',
		));
		$wp_customize->add_control('announcement_notice', array(
			'label'    => __('Announcement Notice', 'ABdev_aeron'),
			'description'    => __('Enter announcement notice to be shown in Announcement Bar', 'ABdev_aeron'),
			'type'     => 'text',
			'section'  => 'section_announcement_bar',
		));

		/**
		Announcement Menu
		**/
		$wp_customize->add_setting('show_announcement_menu', array(
			'default'     => '',
		));
		$wp_customize->add_control('show_announcement_menu', array(
			'label'     	=> __( 'Menu Name to Show', 'ABdev_aeron' ),
			'description'        =>  __('If you would like to show menu in announcement bar type menu name here', 'ABdev_aeron'),
			'settings'  	=> 'show_announcement_menu',
			'type'        => 'text',
			'section'   	=> 'section_announcement_bar',
		));

		/**
		Menu Position
		**/
		$wp_customize->add_setting( 'announcement_bar_menu_position', array(
            'default'        => 'left',
        ) );

        $wp_customize->add_control( 'announcement_bar_menu_position', array(
            'label'      => esc_attr__( 'Menu Position', 'ABdev_aeron' ),
            'section'  		=> 'section_announcement_bar',
            'type'       => 'select',
            'choices'    => array(
                'left'  => esc_attr__('Left', 'ABdev_aeron'),
                'right'  => esc_attr__('Right', 'ABdev_aeron'),
            ),
        ) );


if( in_array('dnd-shortcodes/dnd-shortcodes.php', get_option('active_plugins')) ){
	/**
	------------------------------------------------------------
	SECTION: Icons
	------------------------------------------------------------
	**/
	$wp_customize->add_section('section_icons', array(
		'title'		=> __('Icons', 'ABdev_aeron'),
		'priority'	=> 0,
	));

		/**
		Info
		**/
		$wp_customize->add_setting('icon_font_info', array(
			'default'     => '',
		));
		$wp_customize->add_control(new Info_Custom_control($wp_customize, 'icon_font_info', array(
			'label'     	=> __( "Complete theme's icons names list", 'ABdev_aeron' ),
			'description'   => __( 'Icon list with all icons and their names can be found <a href="'.esc_url(get_template_directory_uri()).'/css/core-icons/demo.html" target="_blank">here</a>.', 'ABdev_aeron' ),
			'type'        => 'info',
			'settings'  	=> 'icon_font_info',
			'section'   	=> 'section_icons',
		)));
}


	/**
	------------------------------------------------------------
	SECTION: Sidebars
	------------------------------------------------------------
	**/
	$wp_customize->add_section('section_sidebars', array(
		'title'		=> esc_attr__('Sidebars', 'ABdev_aeron'),
		'priority'	=> 0,
	));

	/**
		Sidebars
		**/
		$wp_customize->add_setting('sidebars', array(
			'default'     => '',
		));
		$wp_customize->add_control(new Multi_Input_Custom_control($wp_customize, 'sidebars', array(
			'label'     	=> esc_attr__( 'Sidebars', 'ABdev_aeron' ),
			'description'   => esc_attr__( 'Add as many custom sidebars as you need', 'ABdev_aeron' ),
			'settings'  	=> 'sidebars',
			'section'   	=> 'section_sidebars',
		)));
		
	/**
	------------------------------------------------------------
	SECTION: Colors
	------------------------------------------------------------
	**/
	$wp_customize->add_section('section_global_colors', array(
		'title'		=> __('Colors', 'ABdev_aeron'),
		'priority'	=> 0,
	));

		/**
		Header Background Color
		**/
		$wp_customize->add_setting('header_background', array(
			'default'     => '#074176',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_background', array(
			'label'      => __('Header Background Color', 'ABdev_aeron'),
			'settings'   => 'header_background',
			'section'    => 'section_global_colors',
		)));

		/**
		Title Bar Background
		**/
		$wp_customize->add_setting('title_bar_background', array(
			'default'     => '#d9d9d9',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'title_bar_background', array(
			'label'      => __('Title Bar Background', 'ABdev_aeron'),
			'settings'   => 'title_bar_background',
			'section'    => 'section_global_colors',
		)));

		/**
		Main Menu Items
		**/
		$wp_customize->add_setting('main_menu_items', array(
			'default'     => '#c0ccd7',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_menu_items', array(
			'label'      => __('Main Menu Items', 'ABdev_aeron'),
			'settings'   => 'main_menu_items',
			'type'   => 'color',
			'section'    => 'section_global_colors',
		)));

		/**
		Main Menu Items Hover
		**/
		$wp_customize->add_setting('main_menu_items_hover', array(
			'default'     => '#ffffff',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_menu_items_hover', array(
			'label'      => __('Main Menu Items Hover', 'ABdev_aeron'),
			'settings'   => 'main_menu_items_hover',
			'type'   => 'color',
			'section'    => 'section_global_colors',
		)));

		/**
		Body Background Color
		**/
		$wp_customize->add_setting('body_background', array(
			'default'     => '#fff',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'body_background', array(
			'label'      => __('Body Background Color', 'ABdev_aeron'),
			'settings'   => 'body_background',
			'section'    => 'section_global_colors',
		)));
		
		/**
		Body Text Color
		**/
		$wp_customize->add_setting('body_text_color', array(
			'default'     => '#656565',
			'transport'	  => 'postMessage',	
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'body_text_color', array(
			'label'      => __('Body Text Color', 'ABdev_aeron'),
			'settings'   => 'body_text_color',
			'section'    => 'section_global_colors',
		)));

		/**
		Main Color
		**/
		$wp_customize->add_setting('main_color', array(
			'default'     => '#093d71',
			'transport'	  => 'postMessage',	
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_color', array(
			'label'      => __('Main Color', 'ABdev_aeron'),
			'settings'   => 'main_color',
			'section'    => 'section_global_colors',
		)));

		/**
		Secondary color
		**/
		$wp_customize->add_setting('secondary_color', array(
			'default'     => '#1e6d81',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
			'label'    => __('Secondary Color', 'ABdev_aeron'),
			'type'     => 'color',
			'section'  => 'section_global_colors',
		)));

		/**
		Lighter Text Color
		**/
		$wp_customize->add_setting('lighter_text_color', array(
			'default'     => '#929292',
			'transport'	  => 'postMessage',	
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'lighter_text_color', array(
			'label'      => __('Lighter Text Color', 'ABdev_aeron'),
			'settings'   => 'lighter_text_color',
			'section'    => 'section_global_colors',
		)));

		/**
		Highlight Color
		**/
		$wp_customize->add_setting('highlight_color', array(
			'default'     => '#cee6e6',
			'transport'	  => 'postMessage',	
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'highlight_color', array(
			'label'      => __('Light Color', 'ABdev_aeron'),
			'settings'   => 'highlight_color',
			'section'    => 'section_global_colors',
		)));

		/**
		Borders
		**/
		$wp_customize->add_setting('borders_color', array(
			'default'     => '#d9d9d9',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'borders_color', array(
			'label'      => __('Borders', 'ABdev_aeron'),
			'settings'   => 'borders_color',
			'section'    => 'section_global_colors',
		)));

		/**
		Pullquote Text
		**/
		$wp_customize->add_setting('pullquote_text', array(
			'default'     => '#ffad77',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pullquote_text', array(
			'label'      => __('Pullquote Text', 'ABdev_aeron'),
			'settings'   => 'pullquote_text',
			'type'   => 'color',
			'section'    => 'section_global_colors',
		)));	

		/**
		Footer Background Color
		**/
		$wp_customize->add_setting('footer_background', array(
			'default'     => '#434342',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_background', array(
			'label'      => __('Footer Background Color', 'ABdev_aeron'),
			'settings'   => 'footer_background',
			'section'    => 'section_global_colors',
		)));

		/**
		Footer Borders
		**/
		$wp_customize->add_setting('footer_borders', array(
			'default'     => '#5f5f5e',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_borders', array(
			'label'      => __('Footer Borders', 'ABdev_aeron'),
			'settings'   => 'footer_borders',
			'type'   => 'color',
			'section'    => 'section_global_colors',
		)));

		/**
		Footer Links
		**/
		$wp_customize->add_setting('footer_links', array(
			'default'     => '#929292',
			'transport'   => 'postMessage',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_links', array(
			'label'      => __('Footer Links', 'ABdev_aeron'),
			'settings'   => 'footer_links',
			'type'   => 'color',
			'section'    => 'section_global_colors',
		)));

	/**
	------------------------------------------------------------
	SECTION: Footer
	------------------------------------------------------------
	**/
	$wp_customize->add_section('section_footer', array(
		'title'		=> __('Footer', 'ABdev_aeron'),
		'priority'	=> 0,
	));

		/**
		Footer Logo
		**/
		$wp_customize->add_setting('footer_logo', array(
			'default'     => '',
		));
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
			'label'     	=> esc_attr__( 'Footer Logo', 'ABdev_aeron' ),
			'description'   => __('Upload footer logo', 'ABdev_aeron'),
			'settings'  	=> 'footer_logo',
			'section'   	=> 'section_footer',
		)));

		/**
		Copyright Notice
		**/
		$wp_customize->add_setting('copyright', array(
			'default'     => '',
			'transport'	  => 'postMessage',
		));
		$wp_customize->add_control('copyright', array(
			'label'    => esc_attr__('Copyright Notice', 'ABdev_aeron'),
			'description'    => esc_attr__('Enter copyright notice to be shown in footer', 'ABdev_aeron'),
			'type'     => 'text',
			'section'  => 'section_footer',
		));		
		
		/**
		Social Links Label
		**/
		$wp_customize->add_setting('social_links_label', array(
			'default'     => 'Social Networks:',
			'transport'	  => 'postMessage',
		));
		$wp_customize->add_control('social_links_label', array(
			'label'    => __('Social Links Label', 'ABdev_aeron'),
			'type'     => 'text',
			'section'  => 'section_footer',
		));

		/**
		Facebook Profile
		**/
		$wp_customize->add_setting('facebook_url', array(
			'default'     => '',
		));
		$wp_customize->add_control('facebook_url', array(
			'label'    		=> __('Facebook URL', 'ABdev_aeron'),
			'description' => __( 'Enter your Facebook profile URL', 'ABdev_aeron'),
			'type'     		=> 'text',
			'section'  		=> 'section_footer',
		));

		/**
		Twitter Profile
		**/
		$wp_customize->add_setting('twitter_url', array(
			'default'     => '',
		));
		$wp_customize->add_control('twitter_url', array(
			'label'    		=> __('Twitter URL', 'ABdev_aeron'),
			'description' => __( 'Enter your Twitter profile URL', 'ABdev_aeron'),
			'type'     		=> 'text',
			'section'  		=> 'section_footer',
		));

		/**
		Linkedin Profile
		**/
		$wp_customize->add_setting('linkedin_url', array(
			'default'     => '',
		));
		$wp_customize->add_control('linkedin_url', array(
			'label'    		=> __('Linkedin URL', 'ABdev_aeron'),
			'description' => __( 'Enter your Linkedin profile URL', 'ABdev_aeron'),
			'type'     		=> 'text',
			'section'  		=> 'section_footer',
		));

		/**
		Google Plus Profile
		**/
		$wp_customize->add_setting('googleplus_url', array(
			'default'     => '',
		));
		$wp_customize->add_control('googleplus_url', array(
			'label'    		=> __('Google+ Profile', 'ABdev_aeron'),
			'description' => __( 'Enter your Google+ profile URL', 'ABdev_aeron'),
			'type'     		=> 'text',
			'section'  		=> 'section_footer',
		));

		/**
		Skype Profile
		**/
		$wp_customize->add_setting('skype_url', array(
			'default'     => '',
		));
		$wp_customize->add_control('skype_url', array(
			'label'    		=> __('Skype Profile', 'ABdev_aeron'),
			'description' => __( 'Enter your Skype profile URL', 'ABdev_aeron'),
			'type'     		=> 'text',
			'section'  		=> 'section_footer',
		));

		/**
		Social Links Target
		**/
		$wp_customize->add_setting( 'social_links_target', array(
            'default'        => '_blank',
        ) );

        $wp_customize->add_control( 'social_links_target', array(
            'label'      => esc_attr__( 'Social Links Target', 'ABdev_aeron' ),
            'section'  		=> 'section_footer',
            'type'       => 'select',
            'choices'    => array(
                '_self'  => esc_attr__('_self', 'ABdev_aeron'),
                '_blank'     => esc_attr__('_blank', 'ABdev_aeron'),
            ),
        ) );

}
add_action('customize_register', 'aeron_customize_register');

function aeron_customizer_live_preview(){
	wp_enqueue_script('aeron-themecustomizer', get_template_directory_uri().'/inc/customizer/js/customizer.js', array('jquery', 'customize-preview'), '', true);
}
add_action( 'customize_preview_init', 'aeron_customizer_live_preview' );