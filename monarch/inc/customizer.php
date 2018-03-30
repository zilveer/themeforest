<?php
/**
 * Monarch Customizer functionality
 *
 * @package WordPress
 * @subpackage Monarch_Theme
 * @since Monarch 1.0
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Monarch 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function monarch_customize_register( $wp_customize ) {
	$color_scheme = monarch_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

//======================================================================
// Add Monarch Theme Setting and Control
//======================================================================
	$wp_customize->add_section( 'monarch_section_theme' , array(
	    'title'             => esc_html__( 'Theme Settings', 'monarch' ),
	    'priority'          => 30,
	) );

// Home posts style
	$wp_customize->add_setting( 'monarch_main_style' , array(
	    'default'           => 'default',
		'sanitize_callback' => 'monarch_sanitize_main_style',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_main_style_control', array(
		'label'             => esc_html__( 'Home posts style', 'monarch' ),
		'section'           => 'monarch_section_theme',
		'settings'          => 'monarch_main_style',
		'type'		        => 'select',
		'choices'           => array( 'default' => esc_html__( 'Default', 'monarch' ), 'timeline' => esc_html__( 'Timeline', 'monarch' ), 'masonry' => esc_html__( 'Masonry', 'monarch' ), ),
		'priority'	        => 1
	) ) );

// Hide related posts
	$wp_customize->add_setting( 'monarch_relatedposts' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_relatedposts_control', array(
		'label'             => esc_html__( 'Hide related posts', 'monarch' ),
		'section'           => 'monarch_section_theme',
		'settings'          => 'monarch_relatedposts',
		'type'	       	    => 'checkbox',
		'priority'	        => 2
	) ) );

// Hide Monarch admin panel button
	$wp_customize->add_setting( 'monarch_admin_button' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_admin_button_control', array(
		'label'             => esc_html__( 'Hide admin panel button', 'monarch' ),
		'section'           => 'monarch_section_theme',
		'settings'          => 'monarch_admin_button',
		'type'	         	=> 'checkbox',
		'priority'      	=> 3
	) ) );

// Hide author bio after post
	$wp_customize->add_setting( 'monarch_author_bio' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_author_bio_control', array(
		'label'             => esc_html__( 'Hide author bio after post', 'monarch' ),
		'section'           => 'monarch_section_theme',
		'settings'          => 'monarch_author_bio',
		'type'		        => 'checkbox',
		'priority'	        => 4
	) ) );

// Show descriptions in main navigation
	$wp_customize->add_setting( 'monarch_primary_descriptions' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_primary_descriptions_control', array(
		'label'             => esc_html__( 'Show descriptions in main navigation', 'monarch' ),
		'section'           => 'monarch_section_theme',
		'settings'          => 'monarch_primary_descriptions',
		'type'		        => 'checkbox',
		'priority'	        => 5
	) ) );

// Hide the WordPress Toolbar for logged in and logged out users
	$wp_customize->add_setting( 'monarch_show_adminbar' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_show_adminbar_control', array(
		'label'             => esc_html__( 'Hide WordPress Toolbar for all users', 'monarch' ),
		'section'           => 'monarch_section_theme',
		'settings'          => 'monarch_show_adminbar',
		'type'		        => 'checkbox',
		'priority'	        => 6
	) ) );

// Hide post meta
	$wp_customize->add_setting( 'monarch_hide_post_meta' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_hide_post_meta_control', array(
		'label'             => esc_html__( 'Hide post meta', 'monarch' ),
		'section'           => 'monarch_section_theme',
		'settings'          => 'monarch_hide_post_meta',
		'type'		        => 'checkbox',
		'priority'	        => 7
	) ) );

// Do you want to make this website private?
	$wp_customize->add_setting( 'monarch_private_site' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_private_site_control', array(
		'label'             => esc_html__( 'Hide site for logged out users.', 'monarch' ),
		'section'           => 'monarch_section_theme',
		'settings'          => 'monarch_private_site',
		'type'		        => 'checkbox',
		'priority'	        => 8
	) ) );

// Footer copyright text
	$wp_customize->add_setting( 'monarch_footer_copyright' , array(
		'default'			=> wp_kses( __( 'Proudly powered by <strong>WordPress</strong>', 'monarch' ), esc_html( get_bloginfo( 'name' ) ) ),
		'sanitize_callback'	=> 'monarch_sanitize_html',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_footer_copyright_control', array(
		'label'             => esc_html__( 'Copyright or other text to be displayed in the site footer', 'monarch' ),
		'section'           => 'monarch_section_theme',
		'settings'          => 'monarch_footer_copyright',
		'type'		        => 'textarea',
		'priority'	        => 9
	) ) );

//======================================================================
// Typography
//======================================================================
		$wp_customize->add_panel( 'monarch_panel_typography', array(
	    'priority'          => 32,
	    'title'             => esc_html__( 'Typography', 'monarch' ),
	) );

//-----------------------------------------------------
// Add Font Section
//-----------------------------------------------------
	$wp_customize->add_section( 'monarch_section_font' , array(
	    'priority'          => 1,
        'panel'             => 'monarch_panel_typography',
	    'title'             => esc_html__( 'Font Settings', 'monarch' ),
		'description'       => sprintf( wp_kses( esc_html__( 'Not all fonts provide normal, normal italic, bold, bold italic styles. Please visit the %s to see which styles are available for each font.', 'monarch' ), array( 'a' => array( 'href' => array() ) ) ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://www.google.com/fonts' ), esc_html__( 'Google Fonts website', 'monarch' ) ) ),
	) );

// Primary Font
	$wp_customize->add_setting( 'monarch_font_primary', array(
		'default'           => 'Merriweather',
		'sanitize_callback' => 'monarch_font_primary_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_font_primary_control', array(
		'label'             => esc_html__( 'Primary Font', 'monarch' ),
		'description'       => esc_html__( 'Default: Merriweather', 'monarch' ),
		'section'           => 'monarch_section_font',
		'settings'          => 'monarch_font_primary',
		'type'              => 'select',
		'choices'           => monarch_get_font_choices(),
		'priority'          => 1
	) ) );

// Secondary Font
	$wp_customize->add_setting( 'monarch_font_secondary', array(
		'default'           => 'Playfair Display',
		'sanitize_callback' => 'monarch_font_secondary_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_font_secondary_control', array(
		'label'             => esc_html__( 'Secondary Font', 'monarch' ),
		'description'       => esc_html__( 'Default: Playfair Display', 'monarch' ),
		'section'           => 'monarch_section_font',
		'settings'          => 'monarch_font_secondary',
		'type'              => 'select',
		'choices'           => monarch_get_font_choices(),
		'priority'          => 2
	) ) );

//-----------------------------------------------------
// Logo Font
//-----------------------------------------------------
		$wp_customize->add_section( 'monarch_section_logo_font' , array(
	    'priority'          => 2,
        'panel'             => 'monarch_panel_typography',
	    'title'             => esc_html__( 'Logo Font', 'monarch' ),
	    'description'       => sprintf( wp_kses( esc_html__( 'Not all fonts provide all styles. Please visit the %s to see which styles are available for each font.', 'monarch' ), array( 'a' => array( 'href' => array() ) ) ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://www.google.com/fonts' ), esc_html__( 'Google Fonts website', 'monarch' ) ) ),
	) );

// Logo font
	$wp_customize->add_setting( 'monarch_font_logo', array(
		'default'           => 'UnifrakturCook',
		'sanitize_callback' => 'monarch_font_primary_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_font_logo_control', array(
		'label'             => esc_html__( 'Logo font', 'monarch' ),
		'description'       => esc_html__( 'Default: UnifrakturCook', 'monarch' ),
		'section'           => 'monarch_section_logo_font',
		'settings'          => 'monarch_font_logo',
		'type'              => 'select',
		'choices'           => monarch_get_font_choices(),
		'priority'          => 1
	) ) );

// Logo font size
	$wp_customize->add_setting( 'monarch_font_size_logo' , array(
		'default'			=> 29,
		'sanitize_callback' => 'monarch_sanitize_number',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_font_size_logo_control', array(
		'label'             => esc_html__( 'Font size (px)', 'monarch' ),
		'description'       => esc_html__( 'Default: 29px', 'monarch' ),
		'section'           => 'monarch_section_logo_font',
		'settings'          => 'monarch_font_size_logo',
		'type'		        => 'number',
		'input_attrs'       => array( 'min' => 12, 'max' => 90, 'step'	=> 1 ),
		'priority'	        => 2
	) ) );

// Logo letter spacing
	$wp_customize->add_setting( 'monarch_font_letter_spacing_logo' , array(
		'default'			=> 8,
		'sanitize_callback' => 'monarch_sanitize_number',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_font_letter_spacing_logo_control', array(
		'label'             => esc_html__( 'Letter spacing (px)', 'monarch' ),
		'description'       => esc_html__( 'Default: 8px', 'monarch' ),
		'section'           => 'monarch_section_logo_font',
		'settings'          => 'monarch_font_letter_spacing_logo',
		'type'		        => 'number',
		'input_attrs'       => array( 'min' => 0, 'max' => 90, 'step' => 1 ),
		'priority'	        => 3
	) ) );

// Logo Font Weight
	$wp_customize->add_setting( 'monarch_font_weight_logo' , array(
		'default'			=> 'normal',
		'sanitize_callback' => 'monarch_sanitize_font_weight',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_font_weight_logo_control', array(
		'label'             => esc_html__( 'Font weight', 'monarch' ),
		'section'           => 'monarch_section_logo_font',
		'settings'          => 'monarch_font_weight_logo',
		'type'		        => 'radio',
		'choices'           => array( 'normal' => esc_html__( 'Normal', 'monarch' ), 'bold' => esc_html__( 'Bold', 'monarch' ), ),
		'priority'	        => 4
	) ) );

//-----------------------------------------------------
// Font characters sets
//-----------------------------------------------------
	$wp_customize->add_section( 'monarch_section_character_sets' , array(
	    'priority'          => 3,
        'panel'             => 'monarch_panel_typography',
	    'title'             => esc_html__( 'Font Characters Sets', 'monarch' ),
	    'description'       => sprintf( wp_kses( esc_html__( 'Not all fonts provide each of these subsets. Please visit the %s to see which subsets are available for each font.', 'monarch' ), array( 'a' => array( 'href' => array() ) ) ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://www.google.com/fonts' ), esc_html__( 'Google Fonts website', 'monarch' ) ) ),
	) );

// Greek character set
	$wp_customize->add_setting( 'monarch_font_greek' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_font_greek_control', array(
		'label'             => esc_html__( 'Greek', 'monarch' ),
		'section'           => 'monarch_section_character_sets',
		'settings'          => 'monarch_font_greek',
		'type'		        => 'checkbox',
		'priority'	        => 2
	) ) );

// Cyrillic character set
	$wp_customize->add_setting( 'monarch_font_cyrillic' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_font_cyrillic_control', array(
		'label'             => esc_html__( 'Cyrillic', 'monarch' ),
		'section'           => 'monarch_section_character_sets',
		'settings'          => 'monarch_font_cyrillic',
		'type'		        => 'checkbox',
		'priority'	        => 3
	) ) );

// Devanagari character set
	$wp_customize->add_setting( 'monarch_font_devanagari' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_font_devanagari_control', array(
		'label'             => esc_html__( 'Devanagari', 'monarch' ),
		'section'           => 'monarch_section_character_sets',
		'settings'          => 'monarch_font_devanagari',
		'type'		        => 'checkbox',
		'priority'	        => 4
	) ) );

// Vietnamese character set
	$wp_customize->add_setting( 'monarch_font_vietnamese' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_font_vietnamese_control', array(
		'label'             => esc_html__( 'Vietnamese', 'monarch' ),
		'section'           => 'monarch_section_character_sets',
		'settings'          => 'monarch_font_vietnamese',
		'type'		        => 'checkbox',
		'priority'	        => 5
	) ) );

//======================================================================
// Responsive Settings
//======================================================================
	$wp_customize->add_section( 'monarch_section_responsive' , array(
	    'title'             => esc_html__( 'Responsive Settings', 'monarch' ),
	    'description'       => esc_html__( 'You can hide some widgets (1 - 2) on the resolution from 1200px to 1670px for the pages with two sidebars: category, single, blog. How this works can be seen on the demo site.', 'monarch' ),
	    'priority'          => 121,
	) );

// BuddyPress Groups
	$wp_customize->add_setting( 'monarch_responsive_bp_groups' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_responsive_bp_groups_control', array(
		'label'             => esc_html__( 'BuddyPress Groups', 'monarch' ),
		'section'           => 'monarch_section_responsive',
		'settings'          => 'monarch_responsive_bp_groups',
		'type'	       	    => 'checkbox',
		'priority'	        => 1
	) ) );

// BuddyPress Members
	$wp_customize->add_setting( 'monarch_responsive_bp_members' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_responsive_bp_members_control', array(
		'label'             => esc_html__( 'BuddyPress Members', 'monarch' ),
		'section'           => 'monarch_section_responsive',
		'settings'          => 'monarch_responsive_bp_members',
		'type'	       	    => 'checkbox',
		'priority'	        => 2
	) ) );

// Tag Cloud
	$wp_customize->add_setting( 'monarch_responsive_tag_cloud' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_responsive_tag_cloud_control', array(
		'label'             => esc_html__( 'Tag Cloud', 'monarch' ),
		'section'           => 'monarch_section_responsive',
		'settings'          => 'monarch_responsive_tag_cloud',
		'type'	       	    => 'checkbox',
		'priority'	        => 3
	) ) );

// Archives
	$wp_customize->add_setting( 'monarch_responsive_archives' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_responsive_archives_control', array(
		'label'             => esc_html__( 'Archives', 'monarch' ),
		'section'           => 'monarch_section_responsive',
		'settings'          => 'monarch_responsive_archives',
		'type'	       	    => 'checkbox',
		'priority'	        => 4
	) ) );

// Calendar
	$wp_customize->add_setting( 'monarch_responsive_calendar' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_responsive_calendar_control', array(
		'label'             => esc_html__( 'Calendar', 'monarch' ),
		'section'           => 'monarch_section_responsive',
		'settings'          => 'monarch_responsive_calendar',
		'type'	       	    => 'checkbox',
		'priority'	        => 5
	) ) );

// Monarch Posts
	$wp_customize->add_setting( 'monarch_responsive_monarch_posts' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_responsive_monarch_posts_control', array(
		'label'             => esc_html__( 'Monarch Posts', 'monarch' ),
		'section'           => 'monarch_section_responsive',
		'settings'          => 'monarch_responsive_monarch_posts',
		'type'	       	    => 'checkbox',
		'priority'	        => 6
	) ) );

// Monarch Comments
	$wp_customize->add_setting( 'monarch_responsive_monarch_comments' , array(
	    'default'           => false,
		'sanitize_callback' => 'monarch_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'monarch_responsive_monarch_comments_control', array(
		'label'             => esc_html__( 'Monarch Comments', 'monarch' ),
		'section'           => 'monarch_section_responsive',
		'settings'          => 'monarch_responsive_monarch_comments',
		'type'	       	    => 'checkbox',
		'priority'	        => 7
	) ) );

//======================================================================
// Add Color Scheme Setting and Control
//======================================================================
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'monarch_sanitize_color_scheme',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'            => esc_html__( 'Base Color Scheme', 'monarch' ),
		'section'          => 'colors',
		'type'             => 'select',
		'choices'          => monarch_get_color_scheme_choices(),
		'priority'         => 1,
	) );

// Add custom Main color setting and control
	$wp_customize->add_setting( 'main_hue', array(
		'default'           => $color_scheme[2],
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_hue', array(
		'label'             => esc_html__( 'Main color', 'monarch' ),
		'section'           => 'colors',
	) ) );

// Remove the core header textcolor control, as it shares the sidebar text color
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->remove_control( 'display_header_text' );

// Add custom Panels Background Color setting and control
	$wp_customize->add_setting( 'panels_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'panels_background_color', array(
		'label'             => esc_html__( 'Panels Background Color', 'monarch' ),
		'section'           => 'colors',
	) ) );

// Add an additional description to the header image section.
	$wp_customize->get_section( 'header_image' )->title = esc_html__( 'Logo', 'monarch' );
	$wp_customize->get_section( 'background_image' )->description = esc_html__( ' The background image is loaded for pages: register, login, activate.', 'monarch' );
}
add_action( 'customize_register', 'monarch_customize_register', 11 );

//======================================================================
// Font
//======================================================================

if ( ! function_exists( 'monarch_get_font_choices' ) ) :
/**
 * Returns an array of Google Fonts registered for Monarch.
 *
 * @since Monarch 1.1
 *
 * @return array Array of color schemes.
 */
function monarch_get_font_choices() {
	$fonts                = monarch_get_google_fonts();
	$font_control_options = array();

	foreach ( $fonts as $font => $value ) {
		$font_control_options[ $font ] = $value['label'];
	}

	return $font_control_options;
}
endif; // monarch_get_font_choices

/**
 * Enqueues front-end CSS for font scheme.
 *
 * @since Monarch 1.1
 *
 * @see wp_add_inline_style()
 */
function monarch_font_scheme_css() {
	$font_scheme_css = monarch_get_font_scheme_css();

	wp_add_inline_style( 'monarch-style', $font_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'monarch_font_scheme_css' );	

/**
 * Enqueues front-end CSS.
 *
 * @since Monarch 1.2
 *
 * @see wp_add_inline_style()
 */
function monarch_style_settings_css() {
	$style_settings_css = monarch_get_style_settings_css();

	wp_add_inline_style( 'monarch-style', $style_settings_css );
}
add_action( 'wp_enqueue_scripts', 'monarch_style_settings_css' );	

//======================================================================
// Color
//======================================================================

/**
 * Register color schemes for Monarch.
 *
 * Can be filtered with {@see 'monarch_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Sidebar Background Color.
 * 3. Box Background Color.
 * 4. Main Text and Link Color.
 * 5. Sidebar Text and Link Color.
 * 6. Meta Box Background Color.
 *
 * @since Monarch 1.0
 *
 * @return array An associative array of color scheme options.
 */
function monarch_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Monarch.
	 *
	 * @since Monarch 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, sidebar
	 *                              background, box background, main text and link, sidebar text and link,
	 *                              meta box background.
	 *     }
	 * }
	 */
	return apply_filters( 'monarch_color_schemes', array(
		'default'       => array('label' => esc_html__( 'Chocolate', 'monarch' ),       'colors' => array('#f2f2f2', '#323232', '#b5967f', ), ),
		'chocolate'     => array('label' => esc_html__( 'Chocolate II', 'monarch' ),    'colors' => array('#f2f2f2', '#181818', '#b5967f', ), ), 
		'chocolate3'    => array('label' => esc_html__( 'Chocolate III', 'monarch' ),   'colors' => array('#f2f2f2', '#181818', '#986D5B', ), ),
		'chocolate4'    => array('label' => esc_html__( 'Chocolate IV', 'monarch' ),    'colors' => array('#f2f2f2', '#292320', '#a57c6c', ), ),
		'chocolate5'    => array('label' => esc_html__( 'Chocolate V', 'monarch' ),     'colors' => array('#eeeeee', '#292623', '#8a7765', ), ),
		'cake'          => array('label' => esc_html__( 'Cake', 'monarch' ),            'colors' => array('#f0f0f0', '#3d3c3c', '#53b9a3', ), ),
		'cake2'         => array('label' => esc_html__( 'Cake II', 'monarch' ),         'colors' => array('#f4f4f4', '#232323', '#3ea59d', ), ),
		'cake3'         => array('label' => esc_html__( 'Cake III', 'monarch' ),        'colors' => array('#f4f4f4', '#393939', '#84bfa4', ), ),
		'red'           => array('label' => esc_html__( 'Red', 'monarch' ),             'colors' => array('#f2f2f2', '#222222', '#a73a3a', ), ),
		'red2'          => array('label' => esc_html__( 'Red II', 'monarch' ),          'colors' => array('#f0f0f0', '#262627', '#AF4B4B', ), ),
		'gold'          => array('label' => esc_html__( 'Gold', 'monarch' ),            'colors' => array('#f1f1f1', '#323232', '#BFA885', ), ),
		'gold2'         => array('label' => esc_html__( 'Gold II', 'monarch' ),         'colors' => array('#eeeeee', '#333333', '#c9af7e', ), ),
		'magenta'       => array('label' => esc_html__( 'Magenta', 'monarch' ),         'colors' => array('#f0f0f0', '#262627', '#ba68c8', ), ),
		'magenta2'      => array('label' => esc_html__( 'Magenta II', 'monarch' ),      'colors' => array('#f2f2f2', '#2b261f', '#97659b', ), ),
		'orchid'        => array('label' => esc_html__( 'Orchid', 'monarch' ),          'colors' => array('#f2f2f2', '#292124', '#b57f97', ), ),
		'olive'         => array('label' => esc_html__( 'Olive', 'monarch' ),           'colors' => array('#f2f2f2', '#252525', '#adaf7f', ), ),
		'green'         => array('label' => esc_html__( 'Green', 'monarch' ),           'colors' => array('#efefef', '#323232', '#669669', ), ),
		'greensea'      => array('label' => esc_html__( 'Greensea', 'monarch' ),        'colors' => array('#efefef', '#3B3B42', '#689598', ), ),
		'yellow'        => array('label' => esc_html__( 'Yellow', 'monarch' ),          'colors' => array('#f2f1ec', '#353533', '#C1B47F', ), ),
		'teal'          => array('label' => esc_html__( 'Teal', 'monarch' ),            'colors' => array('#ececec', '#2C2F33', '#1d7e84', ), ),
		'emerald'       => array('label' => esc_html__( 'Emerald', 'monarch' ),         'colors' => array('#efefe9', '#323232', '#009276', ), ),
		'violet'        => array('label' => esc_html__( 'Violet', 'monarch' ),          'colors' => array('#f2f2f2', '#252525', '#b57fb3', ), ),
		'lime'          => array('label' => esc_html__( 'Lime', 'monarch' ),            'colors' => array('#f1f1f1', '#262626', '#97b573', ), ),
		'darkkhaki'     => array('label' => esc_html__( 'Dark Khaki', 'monarch' ),      'colors' => array('#f2f2f2', '#333333', '#98957A', ), ),
		'darkseagreen'  => array('label' => esc_html__( 'Dark Sea Green', 'monarch' ),  'colors' => array('#f0f0f0', '#3A3A3A', '#8f9e8b', ), ),
		'darkslateblue' => array('label' => esc_html__( 'Dark Slate Blue', 'monarch' ), 'colors' => array('#ececec', '#251f2c', '#6964a7', ), ),
		'slateblue'     => array('label' => esc_html__( 'Slate Blue', 'monarch' ),      'colors' => array('#efefef', '#242729', '#666699', ), ),
		'lightcoral'    => array('label' => esc_html__( 'Light Coral', 'monarch' ),     'colors' => array('#f2f2f2', '#313131', '#a76262', ), ),
		'lightsea'      => array('label' => esc_html__( 'Light Sea', 'monarch' ),       'colors' => array('#eeeeee', '#333333', '#34a3b1', ), ),
		'lightyellow'   => array('label' => esc_html__( 'Light Yellow', 'monarch' ),    'colors' => array('#f2f2f2', '#3C3934', '#dec18c', ), ),
		'cadetbluegrey' => array('label' => esc_html__( 'Cadet Blue Grey', 'monarch' ), 'colors' => array('#f2f2f2', '#353535', '#74858E', ), ),
		'cadetgreen'    => array('label' => esc_html__( 'Cadet Green', 'monarch' ),     'colors' => array('#f0f0f0', '#2b2b2b', '#3CA09D', ), ),
		) );
}

if ( ! function_exists( 'monarch_get_color_scheme' ) ) :
/**
 * Get the current Monarch color scheme.
 *
 * @since Monarch 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function monarch_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = monarch_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // monarch_get_color_scheme

if ( ! function_exists( 'monarch_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for Monarch.
 *
 * @since Monarch 1.0
 *
 * @return array Array of color schemes.
 */
function monarch_get_color_scheme_choices() {
	$color_schemes                = monarch_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // monarch_get_color_scheme_choices

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Monarch 1.0
 *
 * @see wp_add_inline_style()
 */
function monarch_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	$color_scheme = monarch_get_color_scheme();

	// Convert main and sidebar text hex color to rgba.
	$color_main_hue_rgb  = monarch_hex2rgb( $color_scheme[2] );
	$color_panels_bg_rgb = monarch_hex2rgb( $color_scheme[1] );

	$colors = array(
		'background_color'            => $color_scheme[0],
		'panels_background_color'     => $color_scheme[1],
		'main_hue'                    => $color_scheme[2],
		'light_main_hue'              => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_main_hue_rgb ),
		'light_panels_bg_color'       => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_panels_bg_rgb ),
	);

	$color_scheme_css = monarch_get_color_scheme_css( $colors );

	wp_add_inline_style( 'monarch-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'monarch_color_scheme_css' );

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Monarch 1.0
 */
function monarch_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', monarch_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'monarch_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Monarch 1.0
 */
function monarch_customize_preview_js() {
	wp_enqueue_script( 'monarch-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'monarch_customize_preview_js' );

//======================================================================
// Sanitization
//======================================================================

if ( ! function_exists( 'monarch_sanitize_main_style' ) ) :
/**
 * Sanitization callback for main page posts style.
 *
 * @since Monarch 1.0
 *
 */
function monarch_sanitize_main_style( $main_page ) {
	if ( ! in_array( $main_page, array( 'default', 'timeline', 'masonry' ) ) ) {
		$main_page = 'default';
	}

	return $main_page;
}
endif; // monarch_sanitize_main_style

if ( ! function_exists( 'monarch_font_primary_sanitize' ) ) :
/**
 * Sanitization callback for primary font.
 *
 * @since Monarch 1.1
 */
function monarch_font_primary_sanitize( $value ) {
	$fonts = monarch_get_google_fonts();

	if ( ! array_key_exists( $value, $fonts ) ) {
		$value = 'Merriweather';
	}

	return $value;
}
endif; // monarch_font_primary_sanitize

if ( ! function_exists( 'monarch_font_secondary_sanitize' ) ) :
/**
 * Sanitization callback for secondary font.
 *
 * @since Monarch 1.1
 */
function monarch_font_secondary_sanitize( $value ) {
	$fonts = monarch_get_google_fonts();

	if ( ! array_key_exists( $value, $fonts ) ) {
		$value = 'Playfair Display';
	}

	return $value;
}
endif; // monarch_font_secondary_sanitize

if ( ! function_exists( 'monarch_sanitize_number' ) ) :
/**
 * Number sanitization callback.
 *
 * @since Monarch 1.1
 *
 */
function monarch_sanitize_number( $number, $setting ) {
	$number = absint( $number );
	return ( $number ? $number : $setting->default );
}
endif; // monarch_sanitize_number

if ( ! function_exists( 'monarch_sanitize_html' ) ) :
/**
 * HTML sanitization callback.
 *
 * @since Monarch 1.0
 *
 */
function monarch_sanitize_html( $html ) {
	return wp_kses( $html, array( 'a' => array( 'href' => array(), 'title' => array() ), 'br' => array(), 'em' => array(), 'strong' => array(), ) );
}
endif; // monarch_sanitize_html

if ( ! function_exists( 'monarch_sanitize_checkbox' ) ) :
/**
 * Checkbox sanitization callback.
 *
 * @since Monarch 1.0
 *
 */
function monarch_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
endif; // monarch_sanitize_checkbox

if ( ! function_exists( 'monarch_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since Monarch 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function monarch_sanitize_color_scheme( $value ) {
	$color_schemes = monarch_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default';
	}

	return $value;
}
endif; // monarch_sanitize_color_scheme

if ( ! function_exists( 'monarch_sanitize_font_weight' ) ) :
/**
 * Sanitization callback for font weight.
 *
 * @since Monarch 1.1
 *
 * @param string $value Font weight name value.
 * @return string font weight.
 */
function monarch_sanitize_font_weight( $value ) {

	if ( ! in_array( $value, array( 'normal', 'bold' ) ) ) {
		$value = 'normal';
	}

	return $value;
}
endif; // monarch_sanitize_font_weight

/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 * @since Monarch 1.0
 */
function monarch_color_scheme_css_template() {
	$colors = array(
		'background_color'            => '{{ data.background_color }}',
		'panels_background_color'     => '{{ data.panels_background_color }}',
		'main_hue'                    => '{{ data.main_hue }}',
		'light_main_hue'              => '{{ data.light_main_hue }}',
		'light_panels_bg_color'       => '{{ data.light_panels_bg_color }}',
	);
	?>
	<script type="text/html" id="tmpl-monarch-color-scheme">
		<?php echo monarch_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'monarch_color_scheme_css_template' );

/**
 *
 * Customizer: CSS
 * Customizer: Google Fonts
 *
 * @since Monarch 1.3
 *
 */
require get_template_directory() . '/inc/customizer-css.php';
require get_template_directory() . '/inc/customizer-fonts.php';
