<?php 

/**
 * Ebor Framework
 * Theme Options
 * @since version 1.0
 * @author TommusRhodus
 */

add_action('customize_register', 'ebor_theme_customize');
function ebor_theme_customize($wp_customize) {
	
	/**
	 * Load custom theme customizer classes
	 * Textarea, Google Fonts Etc.
	 */
	require( "theme_options_classes.php" );
	
	/**
	 * Load custom fonts
	 */
	require( "theme_fonts.php" );
	
	/**
	 * Load theme fonts into variable
	 */
	$customFontFamilies = new Google_Font_Collection($fonts);
	
	/**
	 * Ebor Framework
	 * Blog Section
	 * @since version 1.0
	 * @author TommusRhodus
	 */
	
	/**
	 * Create Blog Section
	 */
	$wp_customize->add_section( 'blog_settings', array(
		'title'          => 'Blog Settings',
		'priority'       => 35,
	) );
	
	//blog continue
	$wp_customize->add_setting( 'blog_continue', array(
	    'default'        => 'Continue Reading &rarr;',
	    'type' => 'option'
	) );
	
	//blog continue
	$wp_customize->add_control( 'blog_continue', array(
	    'label' => __('Blog "Continue Reading" Text', 'ebor_starter'),
	    'type' => 'text',
	    'section' => 'blog_settings',
	    'priority'       => 6,
	) );
	
	//index date
	$wp_customize->add_setting( 'index_meta', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//index date
	$wp_customize->add_control( 'index_meta', array(
	    'label' => __('META - INDEX - Show Meta Details?', 'ebor_starter'),
	    'type' => 'checkbox',
	    'section' => 'blog_settings',
	    'priority'       => 7,
	) );
		
	//index date
	$wp_customize->add_setting( 'single_meta', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//index date
	$wp_customize->add_control( 'single_meta', array(
	    'label' => __('META - SINGLE POST - Show Meta Details?', 'ebor_starter'),
	    'type' => 'checkbox',
	    'section' => 'blog_settings',
	    'priority'       => 7,
	) );
	
	///////////////////////////////////////
	//     COLOURS SECTION              //
	/////////////////////////////////////
	
	//index date
	$wp_customize->add_setting( 'boxed_wrapper', array(
	    'default' => 0,
	    'type' => 'option'
	) );
	
	//index date
	$wp_customize->add_control( 'boxed_wrapper', array(
	    'label' => __('SITE - Box the main content? (Seperate from background.)', 'ebor_starter'),
	    'type' => 'checkbox',
	    'section' => 'colors',
	    'priority'       => 1,
	) );
	
	//page wrapper
	$wp_customize->add_setting('footer_colour', array(
	    'default'           => '#ffffff',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'type' => 'option'
	));
	
	//page wrapper
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_colour', array(
	    'label'    => __('GLOBAL - Boxed Content Background (See Above)', 'ebor_starter'),
	    'section'  => 'colors',
	)));
	
	//text colour
	$wp_customize->add_setting('text_colour', array(
	    'default'           => '#666666',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'type' => 'option'
	));
	
	//text colour
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_colour', array(
	    'label'    => __('GLOBAL - Text Colour', 'ebor_starter'),
	    'section'  => 'colors',
	)));
	
	//heading text colour
	$wp_customize->add_setting('heading_text_colour', array(
	    'default'           => '#444444',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'type' => 'option'
	));
	
	//hedaing text colour
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'heading_text_colour', array(
	    'label'    => __('GLOBAL - Headings Text Colour', 'ebor_starter'),
	    'section'  => 'colors',
	)));
	
	//meta colour
	$wp_customize->add_setting('meta_colour', array(
	    'default'           => '#d9d9d9',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'type' => 'option'
	));
	
	//meta colour
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'meta_colour', array(
	    'label'    => __('GLOBAL - Borders & Light Text', 'ebor_starter'),
	    'section'  => 'colors',
	)));
	
	//meta colour
	$wp_customize->add_setting('heading_link_colour', array(
	    'default'           => '#222222',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'type' => 'option'
	));
	
	//meta colour
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'heading_link_colour', array(
	    'label'    => __('GLOBAL - Link Colour', 'ebor_starter'),
	    'section'  => 'colors',
	)));
	
	/**
	 * Create lightbox Section
	 */
	$wp_customize->add_section( 'lightbox_section', array(
		'title'          => 'Lightbox Settings',
		'priority'       => 38,
	) );
	
	//index date
	$wp_customize->add_setting( 'lightbox_animations', array(
	    'default' => 0,
	    'type' => 'option'
	) );
	
	//index date
	$wp_customize->add_control( 'lightbox_animations', array(
	    'label' => __('LIGHTBOX - Turn on animations?', 'ebor_starter'),
	    'type' => 'checkbox',
	    'section' => 'lightbox_section',
	    'priority'       => 7,
	) );
	
	/**
	 * portfolio_posts_per_page
	 */
	$wp_customize->add_setting( 'animation_speed', array(
	    'default' => '600',
	    'type' => 'option'
	) );
	
	/**
	 * Nav Margin Control
	 */
	$wp_customize->add_control( new Ebor_Customizer_Number_Control( $wp_customize, 'animation_speed', array(
	    'label' => __('LIGHTBOX - Animation Speed (Milliseconds)', 'ebor_starter'),
	    'type' => 'number',
	    'section' => 'lightbox_section',
	    'priority'       => 8,
	) ) );
	
	//page wrapper
	$wp_customize->add_setting('lightbox_background', array(
	    'default'           => '#000000',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'type' => 'option'
	));
	
	//page wrapper
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'lightbox_background', array(
	    'label'    => __('LIGHTBOX - Background Colour', 'ebor_starter'),
	    'section' => 'lightbox_section',
	    'priority'       => 9,
	)));
	
	/**
	 * Ebor Framework
	 * Site Settings
	 * @since version 1.0
	 * @author TommusRhodus
	 */
	
	/**
	 * Create Site Settings
	 */
	$wp_customize->add_section( 'site_settings', array(
		'title'          => 'Site Settings',
		'priority'       => 33,
	) );
	
	/*$wp_customize->add_setting('border_style', array(
	    'default' => 'dashed',
	    'type' => 'option'
	));
	
	$wp_customize->add_control( 'border_style', array(
	    'label'   => __('Sitewide Border Style.', 'ebor_starter'),
	    'section' => 'site_settings',
	    'type'    => 'select',
	    'priority' => 4,
	    'choices' => array(
	    	'none' => 'None',
	        'dashed' => 'Dashed',
	        'dotted' => 'dotted',
	        'solid' => 'Solid',
	    ),
	));*/
	
	$wp_customize->add_setting( 'menu_width', array(
	    'default' => '210',
	    'type' => 'option'
	) );
	
	$wp_customize->add_control( new Ebor_Customizer_Number_Control( $wp_customize, 'menu_width', array(
	    'label' => __('Menu Section Width (Pixels)', 'ebor_starter'),
	    'type' => 'number',
	    'section' => 'site_settings',
	    'priority'       => 8,
	) ) );
	
	$wp_customize->add_setting( 'sidebar_width', array(
	    'default' => '210',
	    'type' => 'option'
	) );
	
	$wp_customize->add_control( new Ebor_Customizer_Number_Control( $wp_customize, 'sidebar_width', array(
	    'label' => __('Sidebar Width (Pixels)', 'ebor_starter'),
	    'type' => 'number',
	    'section' => 'site_settings',
	    'priority'       => 9,
	) ) );
	
	/**
	 * Ebor Framework
	 * Login Section
	 * @since version 1.0
	 * @author TommusRhodus
	 */
	
	/**
	 * Create Header Section
	 */
	$wp_customize->add_section( 'custom_login_section', array(
		'title'          => 'wp-login.php Logo',
		'priority'       => 29,
	) );
	
	/**
	 * Custom Logo Default
	 */
	$wp_customize->add_setting('custom_login_logo', array(
	    'default'  => '',
	    'type' => 'option'
	
	));
	
	/**
	 * Custom Logo Control
	 */
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_login_logo', array(
	    'label'    => __('Custom Login Logo Upload', 'ebor_starter'),
	    'section'  => 'custom_login_section',
	    'priority'       => 1
	)));
	
	
	/**
	 * Ebor Framework
	 * Header Section
	 * @since version 1.0
	 * @author TommusRhodus
	 */
	
	/**
	 * Create Header Section
	 */
	$wp_customize->add_section( 'custom_logo_section', array(
		'title'          => 'Header Settings & Logos',
		'priority'       => 30,
	) );
	
	$wp_customize->add_setting('menu_style', array(
	    'default' => 'side',
	    'type' => 'option'
	));
	
	$wp_customize->add_control( 'menu_style', array(
	    'label'   => __('Header & Menu Style.', 'ebor_starter'),
	    'section' => 'custom_logo_section',
	    'type'    => 'select',
	    'priority' => 1,
	    'choices' => array(
	    	'side' => 'Side Header',
	        'top' => 'Top Header',
	    ),
	));
	
	$wp_customize->add_setting('mobile_menu', array(
	    'default' => 'mobile-dropdown',
	    'type' => 'option'
	));
	
	$wp_customize->add_control( 'mobile_menu', array(
	    'label'   => __('Mobile Menu Style.', 'ebor_starter'),
	    'section' => 'custom_logo_section',
	    'type'    => 'select',
	    'priority' => 1,
	    'choices' => array(
	    	'mobile-dropdown' => 'Collapse Menu',
	        'mobile-selectnav' => 'Select Menu',
	    ),
	));
	
	$wp_customize->add_setting( 'menu_margin', array(
	    'default' => '35',
	    'type' => 'option'
	) );

	$wp_customize->add_control( new Ebor_Customizer_Number_Control( $wp_customize, 'menu_margin', array(
	    'label' => __('Menu Top Margin (Top Menu Style Only)', 'ebor_starter'),
	    'type' => 'number',
	    'section' => 'custom_logo_section',
	    'priority'       => 1,
	) ) );
	
	/**
	 * Custom Logo Default
	 */
	$wp_customize->add_setting('custom_logo', array(
	    'default'  => get_template_directory_uri() . '/img/logo.png',
	    'type' => 'option'
	
	));
	
	/**
	 * Custom Logo Control
	 */
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_logo', array(
	    'label'    => __('Custom Logo Upload', 'ebor_starter'),
	    'section'  => 'custom_logo_section',
	    'priority'       => 2
	)));
	
	/**
	 * Custom Logo Default
	 */
	$wp_customize->add_setting('custom_logo_retina', array(
	    'default'  => get_template_directory_uri() . '/img/logo@2x.png',
	    'type' => 'option'
	
	));
	
	/**
	 * Custom Logo Control
	 */
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_logo_retina', array(
	    'label'    => __('Retina Logo - Needs @2x on the file e.g logo@2x.png', 'ebor_starter'),
	    'section'  => 'custom_logo_section',
	    'priority'       => 2
	)));
	
	/**
	 * Custom Logo Alt Text Settings
	 */
	$wp_customize->add_setting( 'custom_logo_alt_text', array(
	    'default'        => 'Alt Text',
	    'type' => 'option'
	) );
	
	/**
	 * Custom Logo Alt Text Control
	 */
	$wp_customize->add_control( 'custom_logo_alt_text', array(
	    'label' => __('Custom Logo Alt Text', 'ebor_starter'),
	    'type' => 'text',
	    'section' => 'custom_logo_section',
	) );
	
	//copyright text
	$wp_customize->add_setting( 'header_left', array(
	    'default'        => 'Configure in "Appearance" => "Customise" => "Header"',
	    'type' => 'option'
	) );
	
	//copyright text
	$wp_customize->add_control( new Ebor_Customize_Textarea_Control( $wp_customize, 'header_left', array(
	    'label'   => __('Header Left Text', 'ebor_starter'),
	    'section' => 'custom_logo_section',
	    'settings'   => 'header_left',
	    'priority' => 98,
	) ) );
	
	//copyright text
	$wp_customize->add_setting( 'header_right', array(
	    'default'        => 'Configure in "Appearance" => "Customise" => "Header"',
	    'type' => 'option'
	) );
	
	//copyright text
	$wp_customize->add_control( new Ebor_Customize_Textarea_Control( $wp_customize, 'header_right', array(
	    'label'   => __('Header Right Text', 'ebor_starter'),
	    'section' => 'custom_logo_section',
	    'settings'   => 'header_right',
	    'priority' => 99,
	) ) );
	
	/**
	 * Ebor Framework
	 * Custom Favicons
	 * @since version 1.0
	 * @author TommusRhodus
	 */
	 
	 /**
	  * Create the Favicon Section
	  */
	 $wp_customize->add_section( 'favicon_settings', array(
	 	'title'          => 'Favicons',
	 	'priority'       => 30,
	 ) );
	
	/**
	 * Custom Favicon Defaults
	 */
	$wp_customize->add_setting('custom_favicon', array(
		'default' => '',
		'type' => 'option'
	));
	
	/**
	 * Custom Favicon Upload Control
	 */
	$wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'custom_favicon', array(
		'label'    => __('Custom Favicon Upload', 'ebor_starter'),
		'section'  => 'favicon_settings',
		'settings' => 'custom_favicon',
		'priority'       => 21,
	)));
	
	/**
	 * Custom Favicon Defaults
	 */
	$wp_customize->add_setting('mobile_favicon', array(
	    'default' => '',
	    'type' => 'option'
	));
	
	/**
	 * Custom Favicon Upload Control
	 */
	$wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'mobile_favicon', array(
	    'label'    => __('Non-Retina Mobile Favicon Upload', 'ebor_starter'),
	    'section'  => 'favicon_settings',
	    'settings' => 'mobile_favicon',
	    'priority'       => 22,
	)));
	
	/**
	 * Custom Favicon Defaults
	 */
	$wp_customize->add_setting('72_favicon', array(
	    'default' => '',
	    'type' => 'option'
	));
	
	/**
	 * Custom Favicon Upload Control
	 */
	$wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, '72_favicon', array(
	    'label'    => __('iPad Favicon (72x72px)', 'ebor_starter'),
	    'section'  => 'favicon_settings',
	    'settings' => '72_favicon',
	    'priority'       => 23,
	)));
	
	/**
	 * Custom Favicon Defaults
	 */
	$wp_customize->add_setting('114_favicon', array(
	   'default' => '',
	   'type' => 'option'
	));
	
	/**
	 * Custom Favicon Upload Control
	 */
	$wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, '114_favicon', array(
	   'label'    => __('Retina iPhone Favicon (114x114px)', 'ebor_starter'),
	   'section'  => 'favicon_settings',
	   'settings' => '114_favicon',
	   'priority'       => 24,
	)));
	
	/**
	 * Custom Favicon Defaults
	 */
	$wp_customize->add_setting('144_favicon', array(
		'default' => '',
		'type' => 'option'
	));
	
	/**
	 * Custom Favicon Upload Control
	 */
	$wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, '144_favicon', array(
		'label'    => __('Retina iPad Favicon (144x144px)', 'ebor_starter'),
		'section'  => 'favicon_settings',
		'settings' => '144_favicon',
		'priority'       => 25,
	)));


	/**
	 * Ebor Framework
	 * Custom Favicons
	 * @since version 1.0
	 * @author TommusRhodus
	 */
	
	/**
	 * Create Custom CSS Section
	 */
	$wp_customize->add_section( 'custom_css_section', array(
		'title'          => 'Custom CSS',
		'priority'       => 200,
	) ); 
	
	/**
	 * Custom CSS Defaults
	 */
	$wp_customize->add_setting( 'custom_css', array(
	  'default'        => '',
	  'type'           => 'option',
	) );
	
	/**
	 * Custom CSS Textarea
	 */
	$wp_customize->add_control( new Ebor_Customize_Textarea_Control( $wp_customize, 'custom_css', array(
	  'label'   => __('Custom CSS', 'ebor_starter'),
	  'section' => 'custom_css_section',
	  'settings'   => 'custom_css',
	) ) );
	      
	      
	///////////////////////////////////////
	//     FOOTER SETTINGS             //
	/////////////////////////////////////
	
	//CREATE CUSTOM CSS SUBSECTION
	$wp_customize->add_section( 'footer_section', array(
		'title'          => 'Footer Settings',
		'priority'       => 40,
	) );
	
	//copyright text
	$wp_customize->add_setting( 'footer_left', array(
	    'default'        => 'Configure in "Appearance" => "Customise" => "Footer"',
	    'type' => 'option'
	) );
	
	//copyright text
	$wp_customize->add_control( new Ebor_Customize_Textarea_Control( $wp_customize, 'footer_left', array(
	    'label'   => __('Footer Left Text', 'ebor_starter'),
	    'section' => 'footer_section',
	    'settings'   => 'footer_left',
	    'priority' => 1,
	) ) );
	
	//copyright text
	$wp_customize->add_setting( 'footer_right', array(
	    'default'        => 'Configure in "Appearance" => "Customise" => "Footer"',
	    'type' => 'option'
	) );
	
	//copyright text
	$wp_customize->add_control( new Ebor_Customize_Textarea_Control( $wp_customize, 'footer_right', array(
	    'label'   => __('Footer Right Text', 'ebor_starter'),
	    'section' => 'footer_section',
	    'settings'   => 'footer_right',
	    'priority' => 2,
	) ) );
	
	/**
	 * Ebor Framework
	 * Blog Section
	 * @since version 1.0
	 * @author TommusRhodus
	 */
	 
	/**
	 * Create Font SubSection
	 */
	$wp_customize->add_section( 'font_section', array(
		'title'          => 'Font Settings',
		'priority'       => 35,
	) );
	
	/**
	 * Headings Font Default
	 */ 
	$wp_customize->add_setting( 'heading_font', array(
	    'default' => 'Montserrat',
	    'type' => 'option'
	) );
	
	/**
	 * Heading Font Control
	 */ 
	$wp_customize->add_control( new Google_Font_Picker_Custom_Control( $wp_customize, 'heading_font', array(
	    'label'             => __( 'Headings Font', 'ebor_starter' ),
	    'section'           => 'font_section',
	    'settings'          => 'heading_font',
	    'choices'           => $customFontFamilies->getFontFamilyNameArray(),
	    'fonts'             => $customFontFamilies
	)));
	
	/**
	 * Body Font Default
	 */ 
	$wp_customize->add_setting( 'body_font', array(
	    'default' => 'Roboto Slab',
	    'type' => 'option'
	) );
	
	/**
	 * Body Font Control
	 */ 
	$wp_customize->add_control( new Google_Font_Picker_Custom_Control( $wp_customize, 'body_font', array(
	    'label'             => __( 'Body Font', 'ebor_starter' ),
	    'section'           => 'font_section',
	    'settings'          => 'body_font',
	    'choices'           => $customFontFamilies->getFontFamilyNameArray(),
	    'fonts'             => $customFontFamilies
	)));

}