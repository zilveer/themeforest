<?php
/**
* Custom Sanitize Functions
**/
function grandportfolio_sanitize_checkbox( $input ) {
	if(is_bool($input))
	{
		return $input;
	}
	else
	{
		return false;
	}

}

function grandportfolio_sanitize_slider( $input ) {	if(is_numeric($input))
	{
		return $input;
	}
	else
	{
		return 0;

	}
}

function grandportfolio_sanitize_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/*** Configuration to disable default Wordpress customizer tabs
**/

add_action( 'customize_register', 'grandportfolio_customize_register' );
function grandportfolio_customize_register( $wp_customize ) {
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
}

/**
 * Configuration sample for the Kirki Customizer
 */
function grandportfolio_demo_configuration_sample() {

    /**
     * If you need to include Kirki in your theme,
     * then you may want to consider adding the translations here
     * using your textdomain.
     * 
     * If you're using Kirki as a plugin then you can remove these.
     */

    $strings = array(
        'background-color' => esc_html__('Background Color', 'grandportfolio-translation' ),
        'background-image' => esc_html__('Background Image', 'grandportfolio-translation' ),
        'no-repeat' => esc_html__('No Repeat', 'grandportfolio-translation' ),
        'repeat-all' => esc_html__('Repeat All', 'grandportfolio-translation' ),
        'repeat-x' => esc_html__('Repeat Horizontally', 'grandportfolio-translation' ),
        'repeat-y' => esc_html__('Repeat Vertically', 'grandportfolio-translation' ),
        'inherit' => esc_html__('Inherit', 'grandportfolio-translation' ),
        'background-repeat' => esc_html__('Background Repeat', 'grandportfolio-translation' ),
        'cover' => esc_html__('Cover', 'grandportfolio-translation' ),
        'contain' => esc_html__('Contain', 'grandportfolio-translation' ),
        'background-size' => esc_html__('Background Size', 'grandportfolio-translation' ),
        'fixed' => esc_html__('Fixed', 'grandportfolio-translation' ),
        'scroll' => esc_html__('Scroll', 'grandportfolio-translation' ),
        'background-attachment' => esc_html__('Background Attachment', 'grandportfolio-translation' ),
        'left-top' => esc_html__('Left Top', 'grandportfolio-translation' ),
        'left-center' => esc_html__('Left Center', 'grandportfolio-translation' ),
        'left-bottom' => esc_html__('Left Bottom', 'grandportfolio-translation' ),
        'right-top' => esc_html__('Right Top', 'grandportfolio-translation' ),
        'right-center' => esc_html__('Right Center', 'grandportfolio-translation' ),
        'right-bottom' => esc_html__('Right Bottom', 'grandportfolio-translation' ),
        'center-top' => esc_html__('Center Top', 'grandportfolio-translation' ),
        'center-center' => esc_html__('Center Center', 'grandportfolio-translation' ),
        'center-bottom' => esc_html__('Center Bottom', 'grandportfolio-translation' ),
        'background-position' => esc_html__('Background Position', 'grandportfolio-translation' ),
        'background-opacity' => esc_html__('Background Opacity', 'grandportfolio-translation' ),
        'ON' => esc_html__('ON', 'grandportfolio-translation' ),
        'OFF' => esc_html__('OFF', 'grandportfolio-translation' ),
        'all' => esc_html__('All', 'grandportfolio-translation' ),
        'cyrillic' => esc_html__('Cyrillic', 'grandportfolio-translation' ),
        'cyrillic-ext' => esc_html__('Cyrillic Extended', 'grandportfolio-translation' ),
        'devanagari' => esc_html__('Devanagari', 'grandportfolio-translation' ),
        'greek' => esc_html__('Greek', 'grandportfolio-translation' ),
        'greek-ext' => esc_html__('Greek Extended', 'grandportfolio-translation' ),
        'khmer' => esc_html__('Khmer', 'grandportfolio-translation' ),
        'latin' => esc_html__('Latin', 'grandportfolio-translation' ),
        'latin-ext' => esc_html__('Latin Extended', 'grandportfolio-translation' ),
        'vietnamese' => esc_html__('Vietnamese', 'grandportfolio-translation' ),
    );

    $args = array(
        'textdomain'   => 'grandportfolio-translation',
    );

    return $args;

}
add_filter( 'kirki/config', 'grandportfolio_demo_configuration_sample' );

/**
 * Create the customizer panels and sections
 */
function grandportfolio_add_panels_and_sections( $wp_customize ) {

	/**
     * Add panels
     */
    $wp_customize->add_panel( 'general', array(
        'priority'    => 35,
        'title'       => esc_html__('General', 'grandportfolio-translation' ),
    ) ); 
    
    $wp_customize->add_panel( 'menu', array(
        'priority'    => 35,
        'title'       => esc_html__('Navigation', 'grandportfolio-translation' ),
    ) );
    
    $wp_customize->add_panel( 'header', array(
        'priority'    => 39,
        'title'       => esc_html__('Header', 'grandportfolio-translation' ),
    ) );
    
    $wp_customize->add_panel( 'sidebar', array(
        'priority'    => 43,
        'title'       => esc_html__('Sidebar', 'grandportfolio-translation' ),
    ) );
    
    $wp_customize->add_panel( 'footer', array(
        'priority'    => 44,
        'title'       => esc_html__('Footer', 'grandportfolio-translation' ),
    ) );
    
    $wp_customize->add_panel( 'gallery', array(
        'priority'    => 45,
        'title'       => esc_html__('Gallery', 'grandportfolio-translation' ),
    ) );
    
    $wp_customize->add_panel( 'portfolio', array(
        'priority'    => 46,
        'title'       => esc_html__('Portfolio', 'grandportfolio-translation' ),
    ) );
    
    $wp_customize->add_panel( 'blog', array(
        'priority'    => 47,
        'title'       => esc_html__('Blog', 'grandportfolio-translation' ),
    ) );
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		$wp_customize->add_panel( 'shop', array(
	        'priority'    => 48,
	        'title'       => esc_html__('Shop', 'grandportfolio-translation' ),
	    ) );
	}

    /**
     * Add sections
     */
	$wp_customize->add_section( 'logo_favicon', array(
        'title'       => esc_html__('Logo & Favicon', 'grandportfolio-translation' ),
        'priority'    => 34,

    ) );
    
    $wp_customize->add_section( 'general_image', array(
        'title'       => esc_html__('Image', 'grandportfolio-translation' ),
        'panel'		  => 'general',
        'priority'    => 46,

    ) );
    
    $wp_customize->add_section( 'general_typography', array(
        'title'       => esc_html__('Typography', 'grandportfolio-translation' ),
        'panel'		  => 'general',
        'priority'    => 47,

    ) );
    
    $wp_customize->add_section( 'general_color', array(
        'title'       => esc_html__('Background & Colors', 'grandportfolio-translation' ),
        'panel'		  => 'general',
        'priority'    => 48,

    ) );
    
    $wp_customize->add_section( 'general_input', array(
        'title'       => esc_html__('Input and Button Elements', 'grandportfolio-translation' ),
        'panel'		  => 'general',
        'priority'    => 49,

    ) );
    
    $wp_customize->add_section( 'general_sharing', array(
        'title'       => esc_html__('Sharing', 'grandportfolio-translation' ),
        'panel'		  => 'general',
        'priority'    => 50,

    ) );
    
    $wp_customize->add_section( 'general_mobile', array(
        'title'       => esc_html__('Mobile', 'grandportfolio-translation' ),
        'panel'		  => 'general',
        'priority'    => 50,

    ) );
    
    $wp_customize->add_section( 'general_frame', array(
        'title'       => esc_html__('Frame', 'grandportfolio-translation' ),
        'panel'		  => 'general',
        'priority'    => 51,

    ) );
    
    $wp_customize->add_section( 'general_boxed', array(
        'title'       => esc_html__('Boxed Layout', 'grandportfolio-translation' ),
        'panel'		  => 'general',
        'priority'    => 52,

    ) );

    $wp_customize->add_section( 'menu_general', array(
        'title'       => esc_html__('General', 'grandportfolio-translation' ),
        'panel'		  => 'menu',
        'priority'    => 36,

    ) );
    
    $wp_customize->add_section( 'menu_typography', array(
        'title'       => esc_html__('Typography', 'grandportfolio-translation' ),
        'panel'		  => 'menu',
        'priority'    => 36,

    ) );
    
    $wp_customize->add_section( 'menu_color', array(
        'title'       => esc_html__('Colors', 'grandportfolio-translation' ),
        'panel'		  => 'menu',
        'priority'    => 37,

    ) );
    
    $wp_customize->add_section( 'menu_background', array(
        'title'       => esc_html__('Background', 'grandportfolio-translation' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_submenu', array(
        'title'       => esc_html__('Sub Menu', 'grandportfolio-translation' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_megamenu', array(
        'title'       => esc_html__('Mega Menu', 'grandportfolio-translation' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_topbar', array(
        'title'       => esc_html__('Top Bar', 'grandportfolio-translation' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_contact', array(
        'title'       => esc_html__('Contact Info', 'grandportfolio-translation' ),
        'panel'		  => 'menu',
        'priority'    => 39,

    ) );
    
    $wp_customize->add_section( 'menu_sidemenu', array(
        'title'       => esc_html__('Side Menu', 'grandportfolio-translation' ),
        'panel'		  => 'menu',
        'priority'    => 39,

    ) );
    
    $wp_customize->add_section( 'menu_search', array(
        'title'       => esc_html__('Side Menu Search', 'grandportfolio-translation' ),
        'panel'		  => 'menu',
        'priority'    => 40,

    ) );
    
    $wp_customize->add_section( 'header_background', array(
        'title'       => esc_html__('Background', 'grandportfolio-translation' ),
        'panel'		  => 'header',
        'priority'    => 40,

    ) );
    
    $wp_customize->add_section( 'header_title', array(
        'title'       => esc_html__('Page Title', 'grandportfolio-translation' ),
        'panel'		  => 'header',
        'priority'    => 41,

    ) );
    
    $wp_customize->add_section( 'header_title_bg', array(
        'title'       => esc_html__('Page Title With Background Image', 'grandportfolio-translation' ),
        'panel'		  => 'header',
        'priority'    => 41,

    ) );
    
    $wp_customize->add_section( 'header_builder_title', array(
        'title'       => esc_html__('Content Builder Header', 'grandportfolio-translation' ),
        'panel'		  => 'header',
        'priority'    => 41,

    ) );
    
    $wp_customize->add_section( 'header_tagline', array(
        'title'       => esc_html__('Page Tagline & Sub Title', 'grandportfolio-translation' ),
        'panel'		  => 'header',
        'priority'    => 42,

    ) );
    
    $wp_customize->add_section( 'sidebar_typography', array(
        'title'       => esc_html__('Typography', 'grandportfolio-translation' ),
        'panel'		  => 'sidebar',
        'priority'    => 43,

    ) );
    
    $wp_customize->add_section( 'sidebar_color', array(
        'title'       => esc_html__('Colors', 'grandportfolio-translation' ),
        'panel'		  => 'sidebar',
        'priority'    => 44,

    ) );
    
    $wp_customize->add_section( 'footer_general', array(
        'title'       => esc_html__('General', 'grandportfolio-translation' ),
        'panel'		  => 'footer',
        'priority'    => 45,

    ) );
    
    $wp_customize->add_section( 'footer_color', array(
        'title'       => esc_html__('Colors', 'grandportfolio-translation' ),
        'panel'		  => 'footer',
        'priority'    => 46,

    ) );
    
    $wp_customize->add_section( 'footer_copyright', array(
        'title'       => esc_html__('Copyright', 'grandportfolio-translation' ),
        'panel'		  => 'footer',
        'priority'    => 47,

    ) );
    
    $wp_customize->add_section( 'gallery_sorting', array(
        'title'       => esc_html__('Images Sorting', 'grandportfolio-translation' ),
        'panel'		  => 'gallery',
        'priority'    => 48,

    ) );
    
    $wp_customize->add_section( 'gallery_lightbox', array(
        'title'       => esc_html__('Lightbox', 'grandportfolio-translation' ),
        'panel'		  => 'gallery',
        'priority'    => 49,

    ) );
    
    $wp_customize->add_section( 'gallery_archive', array(
        'title'       => esc_html__('Archive', 'grandportfolio-translation' ),
        'panel'		  => 'gallery',
        'priority'    => 49,

    ) );
    
    $wp_customize->add_section( 'gallery_fullscreen', array(
        'title'       => esc_html__('Fullscreen', 'grandportfolio-translation' ),
        'panel'		  => 'gallery',
        'priority'    => 49,

    ) );
    
    $wp_customize->add_section( 'gallery_kenburns', array(
        'title'       => esc_html__('Kenburns', 'grandportfolio-translation' ),
        'panel'		  => 'gallery',
        'priority'    => 50,

    ) );
    
    $wp_customize->add_section( 'gallery_flow', array(
        'title'       => esc_html__('Flow', 'grandportfolio-translation' ),
        'panel'		  => 'gallery',
        'priority'    => 51,

    ) );
    
    $wp_customize->add_section( 'portfolio_general', array(
        'title'       => esc_html__('General', 'grandportfolio-translation' ),
        'panel'		  => 'portfolio',
        'priority'    => 50,

    ) );
    
    $wp_customize->add_section( 'portfolio_filterable', array(
        'title'       => esc_html__('Filterable', 'grandportfolio-translation' ),
        'panel'		  => 'portfolio',
        'priority'    => 50,

    ) );
    
    $wp_customize->add_section( 'portfolio_page', array(
        'title'       => esc_html__('Page Options', 'grandportfolio-translation' ),
        'panel'		  => 'portfolio',
        'priority'    => 51,

    ) );
    
    $wp_customize->add_section( 'portfolio_single', array(
        'title'       => esc_html__('Single Portfolio Page', 'grandportfolio-translation' ),
        'panel'		  => 'portfolio',
        'priority'    => 52,

    ) );
    
    $wp_customize->add_section( 'blog_general', array(
        'title'       => esc_html__('General', 'grandportfolio-translation' ),
        'panel'		  => 'blog',
        'priority'    => 53,

    ) );
    
    $wp_customize->add_section( 'blog_slider', array(
        'title'       => esc_html__('Slider', 'grandportfolio-translation' ),
        'panel'		  => 'blog',
        'priority'    => 54,

    ) );
    
    $wp_customize->add_section( 'blog_single', array(
        'title'       => esc_html__('Single Post', 'grandportfolio-translation' ),
        'panel'		  => 'blog',
        'priority'    => 55,

    ) );
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		$wp_customize->add_section( 'shop_layout', array(
	        'title'       => esc_html__('Layout', 'grandportfolio-translation' ),
	        'panel'		  => 'shop',
	        'priority'    => 55,
	
	    ) );
	    
	    $wp_customize->add_section( 'shop_single', array(
	        'title'       => esc_html__('Single Product', 'grandportfolio-translation' ),
	        'panel'		  => 'shop',
	        'priority'    => 56,
	
	    ) );
	}

}
add_action( 'customize_register', 'grandportfolio_add_panels_and_sections' );

/**
 * Register and setting to header section
 */
function grandportfolio_header_setting( $wp_customize ) {

	//Register Logo Tab Settings
	$wp_customize->add_setting( 'tg_favicon', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
	
    $wp_customize->add_setting( 'tg_retina_logo', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_setting( 'tg_retina_transparent_logo', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_setting( 'tg_retina_fullscreen_menu_logo', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    //End Logo Tab Settings
    
    //Register General Tab Settings
    $wp_customize->add_setting( 'tg_enable_right_click', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_enable_dragging', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_disable_hover_kenburns', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_body_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_body_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
	$wp_customize->add_setting( 'tg_header_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_header_font_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_header_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_header_font_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_h1_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h2_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h3_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h4_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h5_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h6_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_content_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_hover_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_h1_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_hr_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_focus_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_button_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_button_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_button_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_button_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    //End General Tab Settings
    

    //Register Menu Tab Settings
    $wp_customize->add_setting( 'tg_menu_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_fixed_menu', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_fixed_menu_border', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_fixed_menu_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_padding', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_hover_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_active_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_transparent_menu_opacity', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_hover_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_hover_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_megamenu_header_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_megamenu_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_content', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_font_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_social_link', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_contact_hours', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_contact_number', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search_instant', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search_input_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_line_height', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_hover_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    //End Menu Tab Settings
    
    //Register Header Tab Settings
	$wp_customize->add_setting( 'tg_page_header_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_page_header_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_page_header_padding_top', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_header_padding_bottom', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_line_height', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_bg_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_bg_height', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_bg_bg_style', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_bg_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_header_builder_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_header_builder_font_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    //End Header Tab Settings
    
    //Register Copyright Tab Settings
    
    $wp_customize->add_setting( 'tg_footer_sidebar', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
	
	$wp_customize->add_setting( 'tg_footer_social_link', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
	$wp_customize->add_setting( 'tg_footer_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_hover_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_social_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_widget_title_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_text', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_html',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_right_area', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_totop', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    //End Copyright Tab Settings
    
    
    //Begin Gallery Tab Settings
    $wp_customize->add_setting( 'tg_gallery_sort', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_lightbox_skin', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_lightbox_enable_caption', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_lightbox_thumbnails', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_lightbox_opacity', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_gallery_hover_slide', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_full_autoplay', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_full_slideshow_timer', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_full_slideshow_trans', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_full_slideshow_trans_speed', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_full_image_caption', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_full_nocover', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_full_arrow', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_kenburns_timer', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_kenburns_zoom', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_kenburns_trans', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    //End Gallery Tab Settings
    
    
    //Begin Portfolio Tab Settings
    $wp_customize->add_setting( 'tg_portfolio_hover_style', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_hover_timer', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_grayscale', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_filterable', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_filterable_link', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_filterable_sort', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_items', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_next_prev', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_recent', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_url', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_setting( 'tg_portfolio_fullscreen_menu_recent', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    //End Portfolio Tab Settings
    
    
    //Begin Blog Tab Settings
    $wp_customize->add_setting( 'tg_blog_display_full', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_archive_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_category_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_tag_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_fullwidth', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_cat_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_header_align', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_header_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_classic_title_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_fullwidth_title_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_twocols__title_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_slider', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_slider_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_slider_cat', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_slider_items', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_single_post_title_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_single_post_sub_title_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_single_post_related_title_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_single_post_bg_style', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_header_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_feat_content', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_display_tags', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_display_author', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_display_related', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
    ) );
    //End Blog Tab Settings
    
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		//Begin Shop Tab Settings
		$wp_customize->add_setting( 'tg_shop_layout', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'esc_html',
	    ) );
	    
	    $wp_customize->add_setting( 'tg_shop_items', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'grandportfolio_sanitize_slider',
	    ) );
	    
	    $wp_customize->add_setting( 'tg_shop_price_font_color', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    
	    $wp_customize->add_setting( 'tg_shop_related_products', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'grandportfolio_sanitize_checkbox',
	    ) );
		//End Shop Tab Settings
	}
    
    
    //Add Live preview
    if ( $wp_customize->is_preview() && ! is_admin() ) {
	    add_action( 'wp_footer', 'grandportfolio_customize_preview', 21);
	}
}
add_action( 'customize_register', 'grandportfolio_header_setting' );

/**
 * Create the setting
 */
function grandportfolio_custom_setting( $controls ) {

	//Default control choices
	$tg_text_transform = array(
	    'none' => 'None',
	    'capitalize' => 'Capitalize',
	    'uppercase' => 'Uppercase',
	    'lowercase' => 'Lowercase',
	);
	
	$tg_text_alignment = array(
	    'left' => 'Left',
	    'center' => 'Center',
	    'right' => 'Right',
	);
	
	$tg_copyright_layout = array(
	    'classic' => 'Classic',
	    'center' => 'Align Center',
	);
	
	$tg_copyright_content = array(
	    'social' => 'Social Icons',
	    'menu' => 'Footer Menu',
	);
	
	$tg_copyright_column = array(
	    0 => 'Hide Footer Sidebar',
	    1 => '1 Column',
	    2 => '2 Column',
	    3 => '3 Column',
	    4 => '4 Column',
	);
	
	$tg_gallery_sort = array(
		'drag' => 'By Drag&drop',
		'post_date' => 'By Newest',
		'post_date_old' => 'By Oldest',
		'rand' => 'By Random',
		'title' => 'By Title',
	);
	
	$tg_portfolio_filterable_sort = array(
		'name' => 'By Name',
		'slug' => 'By Slug',
		'id' => 'By ID',
		'count' => 'By Number of Portfolio',
	);
	
	$tg_portfolio_hover_style = array(
	    'classic' => 'Classic',
	    'center_title' => 'Center Title',
	);
	
	$tg_blog_layout = array(
		'blog_g2cols' => 'Grid 2 Columns',
		'blog_g' => 'Grid 3 Columns',
		'blog_gs' => 'Grid + Right Siebar',
		'blog_gls' => 'Grid + Left Siebar',
		'blog_r' => 'Right Sidebar',
		'blog_l' => 'Left Sidebar',
		'blog_f' => 'Fullwidth',
	);
	
	$tg_shop_layout = array(
		'fullwidth' => 'Fullwidth',
		'sidebar' => 'With Sidebar',
	);
	
	$tg_slideshow_trans = array(
	    1 => 'Fade',
	    2 => 'Slide Top',
	    3 => 'Slide Right',
	    4 => 'Slide Bottom',
	    5 => 'Slide Left',
	    6 => 'Carousel Right',
	    7 => 'Carousel Left',
	);
	
	$tg_menu_layout = array(
	    'leftalign' => 'Left Align',
	    'leftalign_center' => 'Left Align + Center Menu',
	    'centeralign' => 'Center Align',
	    'leftmenu' => 'Left Vertical',
	    'hammenuside' => 'Hamburger Menu + Open Side Menu',
	    'hammenufull' => 'Hamburger Menu + Open Fullscreen Menu',
	);
	
	$tg_fixed_menu_color = array(
	    'dark' => 'Dark',
	    'light' => 'Light',
	    'black' => 'Black',
	);
	
	$tg_slider_layout = array(
		'slider' => 'Fullwidth',
		'2cols-slider' => '2 Columns',
		'3cols-slider' => '3 Columns',
	);
	
	$tg_lightbox_skin = array(
		'metro-white' => 'White',
		'metro-black' => 'Black',
	);
	
	$tg_lightbox_thumbnails = array(
		'horizontal' => 'Horizontal Align',
		'vertical' => 'Vertical Align',
	);
	
	$tg_topbar_content = array(
		'menu_contact' => 'Menu + Contact Info',
		'center_menu' => 'Center Menu',
	);
	
	$tg_sidemenu_layout = array(
		'menu_widgets' => 'Menu + Widgets',
		'menu_center' => 'Center Menu',
	);
	
	$tg_header_alignment = array(
	    'left' => 'Left',
	    'center' => 'Center',
	    'absolute left' => 'Absolute Left',
	);
	
	$tg_header_bg_style = array(
	    'classic' => 'Classic',
	    'center_title' => 'Center Title',
	);
	
	//Get all categories
	$categories_arr = get_categories();
	$tg_categories_select = array();
	$tg_categories_select[''] = '';
	
	foreach ($categories_arr as $cat) {
		$tg_categories_select[$cat->cat_ID] = $cat->cat_name;
	}
	
	//Register Logo Tab Settings
	$controls[] = array(
        'type'     => 'image',
        'setting'  => 'tg_retina_logo',
        'label'    => esc_html__('Retina Logo', 'grandportfolio-translation' ),
        'description' => esc_html__('Retina Ready Image logo. It should be 2x size of normal logo. For example 200x60px logo will displays at 100x30px', 'grandportfolio-translation' ),
        'section'  => 'logo_favicon',
	    'default'  => get_template_directory_uri().'/images/logo@2x.png',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'image',
        'setting'  => 'tg_retina_transparent_logo',
        'label'    => esc_html__('Retina Transparent Logo', 'grandportfolio-translation' ),
        'description' => esc_html__('Retina Ready Image logo for menu transparent page. It should be 2x size of normal logo. For example 200x60px logo will displays at 100x30px. Recommend logo color is white or bright color', 'grandportfolio-translation' ),
        'section'  => 'logo_favicon',
	    'default'  => get_template_directory_uri().'/images/logo@2x_white.png',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'image',
        'setting'  => 'tg_retina_fullscreen_menu_logo',
        'label'    => esc_html__('Retina Fullscreen Menu Logo', 'grandportfolio-translation' ),
        'description' => esc_html__('Retina Ready Image logo for fullscreen menu layout. It should be 2x size of normal logo. For example 200x60px logo will displays at 100x30px. Recommend logo color is white or bright color', 'grandportfolio-translation' ),
        'section'  => 'logo_favicon',
	    'default'  => get_template_directory_uri().'/images/logo@2x_fullscreen.png',
	    'priority' => 4,
    );
    //End Logo Tab Settings
    
    //Register General Tab Settings
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_enable_right_click',
        'label'    => esc_html__('Enable Right Click Protection', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this to disable right click.', 'grandportfolio-translation' ),
        'section'  => 'general_image',
        'default'  => '',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_enable_dragging',
        'label'    => esc_html__('Enable Image Dragging Protection', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this to disable dragging on all images.', 'grandportfolio-translation' ),
        'section'  => 'general_image',
        'default'  => '',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_disable_hover_kenburns',
        'label'    => esc_html__('Enable Kenburns Effect For Gallery and Portfolio Pages', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this to enable kenburns effect when mouse over gallery and portfolio images.', 'grandportfolio-translation' ),
        'section'  => 'general_image',
        'default'  => 1,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_body_font',
        'label'    => esc_html__('Main Content Font Family', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 'Varela Round',
        'choices'  => Kirki_Fonts::get_font_choices(),
        'output' => array(
	        array(
	            'element'  => 'body, input[type=text], input[type=email], input[type=url], input[type=password], textarea, .portfolio_title_desc',
	            'property' => 'font-family',
	        ),
	    ),
		'transport' => 'postMessage',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_body_font_size',
        'label'    => esc_html__('Main Content Font Size', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 15,
        'choices' => array( 'min' => 11, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'body',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_header_font',
        'label'    => esc_html__('H1, H2, H3, H4, H5, H6 Font Family', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 'Karla',
        'choices'  => Kirki_Fonts::get_font_choices(),
        'output' => array(
	        array(
	            'element'  => 'h1, h2, h3, h4, h5, h6, h7, .post_quote_title, label, strong[itemprop="author"], #page_content_wrapper .posts.blog li a, .page_content_wrapper .posts.blog li a, .post_info_cat, .readmore, .post_info_comment, #post_featured_slider li .slider_image .slide_post .slide_post_date, .post_featured_slider li .slider_image .slide_post .slide_post_date, blockquote, .ppb_subtitle, .comment_date, .post_attribute, .post_header_title, .post_header.grid, .odometer, .pricing_wrapper li.price_row em.exact_price',
	            'property' => 'font-family',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_header_font_weight',
        'label'    => esc_html__('H1, H2, H3, H4, H5, H6 Font Weight', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 400,
        'choices' => array( 'min' => 100, 'max' => 900, 'step' => 100 ),
        'output' => array(
	        array(
	            'element'  => 'h1, h2, h3, h4, h5, h6, h7, .post_info_cat, .comment_date, .post_attribute',
	            'property' => 'font-weight',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_header_font_spacing',
        'label'    => esc_html__('H1, H2, H3, H4, H5, H6 Font Spacing', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 0,
        'choices' => array( 'min' => -2, 'max' => 5, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h1, h2, h3, h4, h5, h6, h7, blockquote, body.single .post_header.grid.related',
	            'property' => 'letter-spacing',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_header_font_transform',
        'label'    => esc_html__('H1, H2, H3, H4, H5, H6 Text Transform', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 'none',
        'choices'  => $tg_text_transform,
        'output' => array(
	        array(
	            'element'  => 'h1, h2, h3, h4, h5, h6, h7',
	            'property' => 'text-transform',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_h1_size',
        'label'    => esc_html__('H1 Font Size', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 34,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h1',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_h2_size',
        'label'    => esc_html__('H2 Font Size', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 30,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h2',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_h3_size',
        'label'    => esc_html__('H3 Font Size', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 26,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h3',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_h4_size',
        'label'    => esc_html__('H4 Font Size', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 22,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h4',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_h5_size',
        'label'    => esc_html__('H5 Font Size', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 18,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h5',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_h6_size',
        'label'    => esc_html__('H6 Font Size', 'grandportfolio-translation' ),
        'section'  => 'general_typography',
        'default'  => 16,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h6',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_content_bg_color',
        'label'    => esc_html__('Main Content Background Color', 'grandportfolio-translation' ),
        'section'  => 'general_color',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => 'body, #wrapper, #page_content_wrapper.fixed, #gallery_lightbox h2, .slider_wrapper .gallery_image_caption h2, #body_loading_screen, h3#reply-title span, .overlay_gallery_wrapper, .progress_bar_holder, .pricing_wrapper_border, .pagination a, .pagination span, blockquote:before',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_font_color',
        'label'    => esc_html__('Page Content Font Color', 'grandportfolio-translation' ),
        'section'  => 'general_color',
        'default'  => '#777777',
        'output' => array(
	        array(
	            'element'  => 'body, .pagination a, #gallery_lightbox h2, .slider_wrapper .gallery_image_caption h2, .post_info a, #page_content_wrapper.split #copyright, .page_content_wrapper.split #copyright, .ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '::selection',
	            'property' => 'background-color',
	        ),
	        array(
	            'element'  => '::-webkit-input-placeholder',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '::-moz-placeholder',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => ':-ms-input-placeholder',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 11,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_link_color',
        'label'    => esc_html__('Page Content Link Color', 'grandportfolio-translation' ),
        'section'  => 'general_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => 'a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 12,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_hover_link_color',
        'label'    => esc_html__('Page Content Hover Link Color', 'grandportfolio-translation' ),
        'section'  => 'general_color',
        'default'  => '#999999',
        'output' => array(
	        array(
	            'element'  => 'a:hover, a:active, .post_info_comment a i',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_h1_font_color',
        'label'    => esc_html__('H1, H2, H3, H4, H5, H6 Font Color', 'grandportfolio-translation' ),
        'section'  => 'general_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => 'h1, h2, h3, h4, h5, h6, h7, pre, code, tt, blockquote, .post_header h5 a, .post_header h3 a, .post_header.grid h6 a, .post_header.fullwidth h4 a, .post_header h5 a, blockquote, .site_loading_logo_item i, .woocommerce .woocommerce-ordering select, .woocommerce #page_content_wrapper a.button, .woocommerce.columns-4 ul.products li.product a.add_to_cart_button, .woocommerce.columns-4 ul.products li.product a.add_to_cart_button:hover, .ui-accordion .ui-accordion-header a, .tabs .ui-state-active a, body.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .post_header h5 a, .post_header h6 a, blockquote:before',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => 'body.page.page-template-gallery-archive-split-screen-php #fp-nav li .active span, body.tax-gallerycat #fp-nav li .active span, body.page.page-template-portfolio-fullscreen-split-screen-php #fp-nav li .active span, body.page.tax-portfolioset #fp-nav li .active span, body.page.page-template-gallery-archive-split-screen-php #fp-nav ul li a span, body.tax-gallerycat #fp-nav ul li a span, body.page.page-template-portfolio-fullscreen-split-screen-php #fp-nav ul li a span, body.page.tax-portfolioset #fp-nav ul li a span',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 14,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_hr_color',
        'label'    => esc_html__('Horizontal Line Color', 'grandportfolio-translation' ),
        'section'  => 'general_color',
        'default'  => '#e1e1e1',
        'output' => array(
	        array(
	            'element'  => '#social_share_wrapper, hr, #social_share_wrapper, .post.type-post, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle, .comment .right, .widget_tag_cloud div a, .meta-tags a, .tag_cloud a, #footer, #post_more_wrapper, .woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, #page_content_wrapper .inner .sidebar_content, #page_content_wrapper .inner .sidebar_content.left_sidebar, .ajax_close, .ajax_next, .ajax_prev, .portfolio_next, .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_next, .separated, .blog_next_prev_wrapper, #post_more_wrapper h5, #ajax_portfolio_wrapper.hidding, #ajax_portfolio_wrapper.visible, .tabs.vertical .ui-tabs-panel, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel, .woocommerce table.shop_table, .woocommerce-page table.shop_table, table tr td, .woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals, .woocommerce .cart-collaterals .shipping_calculator, .woocommerce-page .cart-collaterals .shipping_calculator, .woocommerce .cart-collaterals .cart_totals tr td, .woocommerce .cart-collaterals .cart_totals tr th, .woocommerce-page .cart-collaterals .cart_totals tr td, .woocommerce-page .cart-collaterals .cart_totals tr th, table tr th, .woocommerce #payment, .woocommerce-page #payment, .woocommerce #payment ul.payment_methods li, .woocommerce-page #payment ul.payment_methods li, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row, .ui-tabs li:first-child, .ui-tabs .ui-tabs-nav li, .ui-tabs.vertical .ui-tabs-nav li, .ui-tabs.vertical.right .ui-tabs-nav li.ui-state-active, .ui-tabs.vertical .ui-tabs-nav li:last-child, #page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .pricing_wrapper, .pricing_wrapper li, .ui-accordion .ui-accordion-header, .ui-accordion .ui-accordion-content, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle:before, h2.widgettitle:before, #autocomplete, .ppb_blog_minimal .one_third_bg, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.event_title, .tabs .ui-tabs-panel, .ui-tabs .ui-tabs-nav li, .ui-tabs li:first-child, .ui-tabs.vertical .ui-tabs-nav li:last-child, .woocommerce .woocommerce-ordering select, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page table.cart th, table.shop_table thead tr th, hr.title_break, .overlay_gallery_border, #page_content_wrapper.split #copyright, .page_content_wrapper.split #copyright, .post.type-post, .events.type-events, h5.event_title, .post_header h5.event_title, blockquote:after, #about_the_author, .two_cols.gallery.wide .element, .three_cols.gallery.wide .element, .four_cols.gallery.wide .element',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 15,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_input_bg_color',
        'label'    => esc_html__('Input and Textarea Background Color', 'grandportfolio-translation' ),
        'section'  => 'general_input',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], textarea',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 16,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_input_font_color',
        'label'    => esc_html__('Input and Textarea Font Color', 'grandportfolio-translation' ),
        'section'  => 'general_input',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], textarea',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 17,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_input_border_color',
        'label'    => esc_html__('Input and Textarea Border Color', 'grandportfolio-translation' ),
        'section'  => 'general_input',
        'default'  => '#e1e1e1',
        'output' => array(
	        array(
	            'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], textarea',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 18,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_input_focus_color',
        'label'    => esc_html__('Input and Textarea Focus State Color', 'grandportfolio-translation' ),
        'section'  => 'general_input',
        'default'  => '#999999',
        'output' => array(
	        array(
	            'element'  => 'input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=url]:focus, textarea:focus',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 19,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_button_font',
        'label'    => esc_html__('Button Font Family', 'grandportfolio-translation' ),
        'section'  => 'general_input',
        'default'  => 'Varela Round',
        'choices'  => Kirki_Fonts::get_font_choices(),
        'output' => array(
	        array(
	            'element'  => 'input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
	            'property' => 'font-family',
	        ),
	    ),
		'transport' => 'postMessage',
	    'priority' => 19,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_button_bg_color',
        'label'    => esc_html__('Button Background Color', 'grandportfolio-translation' ),
        'section'  => 'general_input',
        'default'  => '#959595',
        'output' => array(
	        array(
	            'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination span, .pagination a:hover, .woocommerce .footer_bar .button, .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .post_type_icon',
	            'property' => 'background-color',
	        ),
	        array(
	            'element'  => '.pagination span, .pagination a:hover, .button.ghost, .button.ghost:hover, .button.ghost:active',
	            'property' => 'border-color',
	        ),
	        array(
	            'element'  => '.button.ghost, .button.ghost:hover, .button.ghost:active',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 20,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_button_font_color',
        'label'    => esc_html__('Button Font Color', 'grandportfolio-translation' ),
        'section'  => 'general_input',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .post_type_icon',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 21,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_button_border_color',
        'label'    => esc_html__('Button Border Color', 'grandportfolio-translation' ),
        'section'  => 'general_input',
        'default'  => '#959595',
        'output' => array(
	        array(
	            'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 22,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_mobile_responsive',
        'label'    => esc_html__('Enable Responsive Layout', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this to enable responsive layout for tablet and mobile devices.', 'grandportfolio-translation' ),
        'section'  => 'general_mobile',
        'default'  => 1,
	    'priority' => 25,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_frame',
        'label'    => esc_html__('Enable Frame', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this to enable frame for site layout', 'grandportfolio-translation' ),
        'section'  => 'general_frame',
        'default'  => 0,
	    'priority' => 26,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_frame_color',
        'label'    => esc_html__('Frame Color', 'grandportfolio-translation' ),
        'section'  => 'general_frame',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '.frame_top, .frame_bottom, .frame_left, .frame_right',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 27,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_boxed',
        'label'    => esc_html__('Enable Boxed Layout', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this to enable boxed layout for site layout', 'grandportfolio-translation' ),
        'section'  => 'general_boxed',
        'default'  => 0,
	    'priority' => 28,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_global_sharing',
        'label'    => esc_html__('Enable Sharing Button To All Pages', 'photography-translation' ),
        'description' => esc_html__('Check this to enable sharing button on main menu for pages', 'photography-translation' ),
        'section'  => 'general_sharing',
        'default'  => 0,
	    'priority' => 28,
    );
    //End General Tab Settings

	//Register Menu Tab Settings 
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_menu_layout',
        'label'    => esc_html__('Menu Layout', 'grandportfolio-translation' ),
        'section'  => 'menu_general',
        'default'  => 'leftalign_center',
        'choices'  => $tg_menu_layout,
	    'priority' => 1,
    );
	
	$controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_fixed_menu',
        'label'    => esc_html__('Enable Sticky Menu', 'grandportfolio-translation' ),
        'description' => esc_html__('Enable this to display main menu fixed when scrolling.', 'grandportfolio-translation' ),
        'section'  => 'menu_general',
        'default'  => 1,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_fixed_menu_border',
        'label'    => esc_html__('Enable Sticky Menu Border', 'grandportfolio-translation' ),
        'description' => esc_html__('Enable this to display sticky menu border.', 'grandportfolio-translation' ),
        'section'  => 'menu_general',
        'default'  => 1,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_fixed_menu_color',
        'label'    => esc_html__('Sticky Menu Color Scheme', 'grandportfolio-translation' ),
        'section'  => 'menu_general',
        'default'  => 'light',
        'choices'  => $tg_fixed_menu_color,
	    'priority' => 2,
    );
	
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_menu_font',
        'label'    => esc_html__('Menu Font Family', 'grandportfolio-translation' ),
        'section'  => 'menu_typography',
        'default'  => 'Karla',
        'choices'  => Kirki_Fonts::get_font_choices(),
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a',
	            'property' => 'font-family',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_menu_font_size',
        'label'    => esc_html__('Menu Font Size', 'grandportfolio-translation' ),
        'section'  => 'menu_typography',
        'default'  => 14,
        'choices' => array( 'min' => 11, 'max' => 40, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_menu_padding',
        'label'    => esc_html__('Menu Padding', 'grandportfolio-translation' ),
        'section'  => 'menu_typography',
        'default'  => 22,
        'choices' => array( 'min' => 0, 'max' => 150, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a',
	            'property' => 'padding-top',
	            'units'    => 'px',
	        ),
	        array(
	            'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a',
	            'property' => 'padding-bottom',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_menu_weight',
        'label'    => esc_html__('Menu Font Weight', 'grandportfolio-translation' ),
        'section'  => 'menu_typography',
        'default'  => 600,
        'choices' => array( 'min' => 100, 'max' => 900, 'step' => 100 ),
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a',
	            'property' => 'font-weight',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_menu_font_spacing',
        'label'    => esc_html__('Menu Font Spacing', 'grandportfolio-translation' ),
        'section'  => 'menu_typography',
        'default'  => 0,
        'choices' => array( 'min' => -2, 'max' => 5, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a',
	            'property' => 'letter-spacing',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_menu_transform',
        'label'    => esc_html__('Menu Font Text Transform', 'grandportfolio-translation' ),
        'section'  => 'menu_typography',
        'default'  => 'none',
        'choices'  => $tg_text_transform,
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a',
	            'property' => 'text-transform',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_menu_font_color',
        'label'    => esc_html__('Menu Font Color', 'grandportfolio-translation' ),
        'section'  => 'menu_color',
        'default'  => '#666666',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .header_cart_wrapper a, #page_share',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '#mobile_nav_icon',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_menu_hover_font_color',
        'label'    => esc_html__('Menu Hover State Font Color', 'grandportfolio-translation' ),
        'section'  => 'menu_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover, .header_cart_wrapper a:hover, #page_share:hover',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_menu_active_font_color',
        'label'    => esc_html__('Menu Active State Font Color', 'grandportfolio-translation' ),
        'section'  => 'menu_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent  ul li.current-menu-item a, .header_cart_wrapper a:active, #page_share:active',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent  ul li.current-menu-item a',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_menu_border_color',
        'label'    => esc_html__('Menu Bar Border Color', 'grandportfolio-translation' ),
        'section'  => 'menu_color',
        'default'  => '#e1e1e1',
        'output' => array(
	        array(
	            'element'  => '.top_bar, #page_caption, #nav_wrapper',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'background',
        'setting'  => 'tg_menu_bg',
        'label'    => esc_html__('Menu Background', 'grandportfolio-translation' ),
        'section'  => 'menu_background',
	    'default'     => array(
	        'color'    => 'rgba(256,256,256,1)',
	        'image'    => '',
	        'repeat'   => 'no-repeat',
	        'size'     => 'cover',
	        'attach'   => 'fixed',
	        'position' => 'left-top',
	        'opacity'  => 100
	    ),
	    'output' => '.top_bar',
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_transparent_menu_opacity',
        'label'    => esc_html__('Transparent Menu Opacity', 'grandportfolio-translation' ),
        'section'  => 'menu_background',
        'default'  => 0,
        'choices' => array( 'min' => 0, 'max' => 100, 'step' => 5 ),
	    'priority' => 20,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_submenu_font_size',
        'label'    => esc_html__('SubMenu Font Size', 'grandportfolio-translation' ),
        'section'  => 'menu_submenu',
        'default'  => 13,
        'choices' => array( 'min' => 10, 'max' => 40, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_submenu_weight',
        'label'    => esc_html__('SubMenu Font Weight', 'grandportfolio-translation' ),
        'section'  => 'menu_submenu',
        'default'  => 600,
        'choices' => array( 'min' => 100, 'max' => 900, 'step' => 100 ),
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a',
	            'property' => 'font-weight',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 10,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_submenu_font_spacing',
        'label'    => esc_html__('SubMenu Font Spacing', 'grandportfolio-translation' ),
        'section'  => 'menu_submenu',
        'default'  => 0,
        'choices' => array( 'min' => -2, 'max' => 5, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a',
	            'property' => 'letter-spacing',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 11,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_submenu_transform',
        'label'    => esc_html__('Menu Font Text Transform', 'grandportfolio-translation' ),
        'section'  => 'menu_submenu',
        'default'  => 'none',
        'choices'  => $tg_text_transform,
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a',
	            'property' => 'text-transform',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 12,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_submenu_font_color',
        'label'    => esc_html__('Sub Menu Font Color', 'grandportfolio-translation' ),
        'section'  => 'menu_submenu',
        'default'  => '#777777',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li.current-menu-parent ul li.current-menu-item a, #menu_wrapper .nav ul li.megamenu ul li ul li a, #menu_wrapper div .nav li.megamenu ul li ul li a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_submenu_hover_font_color',
        'label'    => esc_html__('Sub Menu Hover State Font Color', 'grandportfolio-translation' ),
        'section'  => 'menu_submenu',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.current-menu-parent ul li.current-menu-item  a:hover',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 14,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_submenu_hover_bg_color',
        'label'    => esc_html__('Sub Menu Hover State Background Color', 'grandportfolio-translation' ),
        'section'  => 'menu_submenu',
        'default'  => '#f9f9f9',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 15,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_submenu_bg_color',
        'label'    => esc_html__('Sub Menu Background Color', 'grandportfolio-translation' ),
        'section'  => 'menu_submenu',
        'default'  => '#f9f9f9',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 16,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_submenu_border_color',
        'label'    => esc_html__('Sub Menu Border Color', 'grandportfolio-translation' ),
        'section'  => 'menu_submenu',
        'default'  => '#e1e1e1',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 17,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_megamenu_header_color',
        'label'    => esc_html__('Mega Menu Header Font Color', 'grandportfolio-translation' ),
        'section'  => 'menu_megamenu',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper div .nav li.megamenu ul li > a, #menu_wrapper div .nav li.megamenu ul li > a:hover, #menu_wrapper div .nav li.megamenu ul li > a:active, #menu_wrapper div .nav li.megamenu ul li.current-menu-item > a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 18,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_megamenu_border_color',
        'label'    => esc_html__('Mega Menu Border Color', 'grandportfolio-translation' ),
        'section'  => 'menu_megamenu',
        'default'  => '#e1e1e1',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper div .nav li.megamenu ul li',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 20,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_topbar',
        'label'    => esc_html__('Display Top Bar', 'grandportfolio-translation' ),
        'description' => esc_html__('Enable this option to display top bar above main menu', 'grandportfolio-translation' ),
        'section'  => 'menu_topbar',
        'default'  => 0,
	    'priority' => 21,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_topbar_content',
        'label'    => esc_html__('Topbar Content', 'grandportfolio-translation' ),
        'section'  => 'menu_topbar',
        'default'  => 'menu_contact',
        'choices'  => $tg_topbar_content,
	    'priority' => 21,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_topbar_bg_color',
        'label'    => esc_html__('Top Bar Background Color', 'grandportfolio-translation' ),
        'section'  => 'menu_topbar',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '.above_top_bar',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 22,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_topbar_font_color',
        'label'    => esc_html__('Top Bar Menu Font Color', 'grandportfolio-translation' ),
        'section'  => 'menu_topbar',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '#top_menu li a, .top_contact_info, .top_contact_info i, .top_contact_info a, .top_contact_info a:hover, .top_contact_info a:active',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 23,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_topbar_font',
        'label'    => esc_html__('Top Bar Font Family', 'grandportfolio-translation' ),
        'section'  => 'menu_topbar',
        'default'  => 'Karla',
        'choices'  => Kirki_Fonts::get_font_choices(),
        'output' => array(
	        array(
	            'element'  => '.above_top_bar',
	            'property' => 'font-family',
	        ),
	    ),
		'transport' => 'postMessage',
	    'priority' => 23,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_topbar_font_weight',
        'label'    => esc_html__('Top Bar Font Weight', 'grandportfolio-translation' ),
        'section'  => 'menu_topbar',
        'default'  => 400,
        'choices' => array( 'min' => 100, 'max' => 900, 'step' => 100 ),
        'output' => array(
	        array(
	            'element'  => '.top_contact_info, #top_menu li a',
	            'property' => 'font-weight',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 24,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'tg_menu_contact_hours',
        'label'    => esc_html__('Contact Hours (Optional)', 'grandportfolio-translation' ),
        'description' => esc_html__('Enter your company contact hours.', 'grandportfolio-translation' ),
        'section'  => 'menu_contact',
        'default'  => 'Mon-Fri 09.00 - 17.00',
        'transport' 	 => 'postMessage',
	    'priority' => 26,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'tg_menu_contact_number',
        'label'    => esc_html__('Contact Phone Number (Optional)', 'grandportfolio-translation' ),
        'description' => esc_html__('Enter your company contact phone number.', 'grandportfolio-translation' ),
        'section'  => 'menu_contact',
        'default'  => '1.800.456.6743',
        'transport' => 'postMessage',
	    'priority' => 27,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_topbar_social_link',
        'label'    => esc_html__('Open Top Bar Social Icons link in new window', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this to open top bar social icons link in new window', 'grandportfolio-translation' ),
        'section'  => 'menu_contact',
        'default'  => 1,
	    'priority' => 28,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_menu_search',
        'label'    => esc_html__('Enable Search', 'grandportfolio-translation' ),
        'description' => esc_html__('Select to display search form in header of side menu', 'grandportfolio-translation' ),
        'section'  => 'menu_search',
        'default'  => 1,
	    'priority' => 28,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_menu_search_instant',
        'label'    => esc_html__('Enable Instant Search', 'grandportfolio-translation' ),
        'description' => esc_html__('Select to display search result instantly while typing', 'grandportfolio-translation' ),
        'section'  => 'menu_search',
        'default'  => 1,
	    'priority' => 29,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_menu_search_input_color',
        'label'    => esc_html__('Search Input Background Color', 'grandportfolio-translation' ),
        'section'  => 'menu_search',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform input[type=text]',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 30,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_menu_search_font_color',
        'label'    => esc_html__('Search Input Font Color', 'grandportfolio-translation' ),
        'section'  => 'menu_search',
        'default'  => '#777777',
        'output' => array(
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform input[type=text], .mobile_menu_wrapper #searchform button i',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform ::-webkit-input-placeholder',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform ::-moz-placeholder',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform :-ms-input-placeholder',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform input[type=text]',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_sidemenu_layout',
        'label'    => esc_html__('Side Menu Layout', 'grandportfolio-translation' ),
        'section'  => 'menu_sidemenu',
        'default'  => 'menu_widgets',
        'choices'  => $tg_sidemenu_layout,
	    'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_sidemenu',
        'label'    => esc_html__('Enable Side Menu on Desktop', 'grandportfolio-translation' ),
        'description' => 'Check this option to enable side menu on desktop',
        'section'  => 'menu_sidemenu',
        'default'  => 1,
	    'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'background',
        'setting'  => 'tg_sidemenu_bg',
        'label'    => esc_html__('Side Menu Background', 'grandportfolio-translation' ),
        'section'  => 'menu_sidemenu',
	    'default'     => array(
	        'color'    => '#ffffff',
	        'image'    => '',
	        'repeat'   => 'no-repeat',
	        'size'     => 'cover',
	        'attach'   => 'fixed',
	        'position' => 'left-top',
	        'opacity'  => 100
	    ),
	    'output' => '.mobile_menu_wrapper',
	    'priority' => 32,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_sidemenu_font',
        'label'    => esc_html__('Side Menu Font Family', 'grandportfolio-translation' ),
        'section'  => 'menu_sidemenu',
        'default'  => 'Karla',
        'choices'  => Kirki_Fonts::get_font_choices(),
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a, #sub_menu li a',
	            'property' => 'font-family',
	        ),
	    ),
		'transport' => 'postMessage',
	    'priority' => 40,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_sidemenu_font_size',
        'label'    => esc_html__('Side Menu Font Size', 'grandportfolio-translation' ),
        'section'  => 'menu_sidemenu',
        'default'  => 16,
        'choices' => array( 'min' => 11, 'max' => 40, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a, #sub_menu li a',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 41,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_sidemenu_line_height',
        'label'    => esc_html__('Side Menu Font Line Height (in em)', 'grandportfolio-translation' ),
        'section'  => 'menu_sidemenu',
        'default'  => 3,
        'choices' => array( 'min' => 1, 'max' => 4, 'step' => 0.2 ),
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a, #sub_menu li a',
	            'property' => 'line-height',
	            'units'    => 'em',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 41,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_sidemenu_font_weight',
        'label'    => esc_html__('Side Menu Font Weight', 'grandportfolio-translation' ),
        'section'  => 'menu_sidemenu',
        'default'  => 400,
        'choices' => array( 'min' => 100, 'max' => 900, 'step' => 100 ),
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a, #sub_menu li a',
	            'property' => 'font-weight',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 42,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_sidemenu_font_transform',
        'label'    => esc_html__('Side Menu Font Text Transform', 'grandportfolio-translation' ),
        'section'  => 'menu_sidemenu',
        'default'  => 'none',
        'choices'  => $tg_text_transform,
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a, #sub_menu li a',
	            'property' => 'text-transform',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 42,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_sidemenu_font_spacing',
        'label'    => esc_html__('Side Menu Font Spacing', 'grandportfolio-translation' ),
        'section'  => 'menu_sidemenu',
        'default'  => 0,
        'choices' => array( 'min' => -2, 'max' => 5, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a, #sub_menu li a',
	            'property' => 'letter-spacing',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 42,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_sidemenu_font_color',
        'label'    => esc_html__('Side Menu Font Color', 'grandportfolio-translation' ),
        'section'  => 'menu_sidemenu',
        'default'  => '#777777',
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a, #sub_menu li a, .mobile_menu_wrapper .sidebar_wrapper a, .mobile_menu_wrapper .sidebar_wrapper, #close_mobile_menu i, .fullmenu_wrapper a, .fullmenu_wrapper h2.widgettitle, .mobile_menu_wrapper #copyright',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 43,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_sidemenu_font_hover_color',
        'label'    => esc_html__('Side Menu Hover State Font Color', 'grandportfolio-translation' ),
        'section'  => 'menu_sidemenu',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a:hover, .mobile_main_nav li a:active, #sub_menu li a:hover, #sub_menu li a:active, .mobile_menu_wrapper .sidebar_wrapper h2.widgettitle',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 44,
    );
    //End Menu Tab Settings
    
    //Register Header Tab Settings
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_page_title_img_blur',
        'label'    => esc_html__('Add Blur Effect When Scroll', 'grandportfolio-translation' ),
        'description' => esc_html__('Enable this option to add blur effect to header background image when scrolling pass it', 'grandportfolio-translation' ),
        'section'  => 'header_background',
        'default'  => '1',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_page_header_bg_color',
        'label'    => esc_html__('Page Header Background Color', 'grandportfolio-translation' ),
        'section'  => 'header_background',
        'default'  => '#f9f9f9',
        'output' => array(
	        array(
	            'element'  => '#page_caption',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 18,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_page_header_alignment',
        'label'    => esc_html__('Page Header Alignment', 'grandportfolio-translation' ),
        'section'  => 'header_title',
        'default'  => 'left',
        'choices'  => $tg_header_alignment,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_header_padding_top',
        'label'    => esc_html__('Page Header Padding Top', 'grandportfolio-translation' ),
        'section'  => 'header_title',
        'default'  => 30,
        'choices' => array( 'min' => 0, 'max' => 200, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption',
	            'property' => 'padding-top',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_header_padding_bottom',
        'label'    => esc_html__('Page Header Padding Bottom', 'grandportfolio-translation' ),
        'section'  => 'header_title',
        'default'  => 40,
        'choices' => array( 'min' => 0, 'max' => 200, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption',
	            'property' => 'padding-bottom',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_title_font_size',
        'label'    => esc_html__('Page Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'header_title',
        'default'  => 32,
        'choices' => array( 'min' => 12, 'max' => 100, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption h1, .ppb_title',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_title_font_weight',
        'label'    => esc_html__('Page Title Font Weight', 'grandportfolio-translation' ),
        'section'  => 'header_title',
        'default'  => 400,
        'choices' => array( 'min' => 100, 'max' => 900, 'step' => 100 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption h1, .ppb_title, .post_caption h1',
	            'property' => 'font-weight',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_title_line_height',
        'label'    => esc_html__('Page Title Font Line Height (in em)', 'grandportfolio-translation' ),
        'section'  => 'header_title',
        'default'  => 1.4,
        'choices' => array( 'min' => 1, 'max' => 4, 'step' => 0.2 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption h1, .ppb_title, .post_caption h1',
	            'property' => 'line-height',
	            'units'    => 'em',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_page_title_transform',
        'label'    => esc_html__('Page Title Text Transform', 'grandportfolio-translation' ),
        'section'  => 'header_title',
        'default'  => 'none',
        'choices'  => $tg_text_transform,
        'output' => array(
	        array(
	            'element'  => '#page_caption h1, .ppb_title, .post_caption h1',
	            'property' => 'text-transform',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_title_font_spacing',
        'label'    => esc_html__('Page Title Font Spacing', 'grandportfolio-translation' ),
        'section'  => 'header_title',
        'default'  => 0,
        'choices' => array( 'min' => -5, 'max' => 5, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption h1, .ppb_title, .post_caption h1',
	            'property' => 'letter-spacing',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_page_title_font_color',
        'label'    => esc_html__('Page Title Font Color', 'grandportfolio-translation' ),
        'section'  => 'header_title',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#page_caption h1, .ppb_title, .post_caption h1',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_title_bg_font_size',
        'label'    => esc_html__('Page Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'header_title_bg',
        'default'  => 22,
        'choices' => array( 'min' => 12, 'max' => 100, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption.hasbg h1, h1.hasbg',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_title_bg_height',
        'label'    => esc_html__('Page Title Background Image Height (in %)', 'grandportfolio-translation' ),
        'section'  => 'header_title_bg',
        'default'  => 70,
        'choices' => array( 'min' => 10, 'max' => 100, 'step' => 5 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption.hasbg',
	            'property' => 'height',
	            'units'    => 'vh',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_page_title_bg_bg_style',
        'label'    => esc_html__('Header With Background Style', 'grandportfolio-translation' ),
        'section'  => 'header_title_bg',
        'default'  => 'classic',
        'choices'  => $tg_header_bg_style,
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_header_builder_font_size',
        'label'    => esc_html__(' Content Builder Header Font Size', 'grandportfolio-translation' ),
        'section'  => 'header_builder_title',
        'default'  => 36,
        'choices' => array( 'min' => 12, 'max' => 100, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h2.ppb_title',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	        array(
	            'element'  => '#portfolio_wall_filters.alignright, .portfolio_wall_filters.alignright',
	            'property' => 'bottom',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_header_builder_font_transform',
        'label'    => esc_html__('Content Builder Header Text Transform', 'grandportfolio-translation' ),
        'section'  => 'header_builder_title',
        'default'  => 'none',
        'choices'  => $tg_text_transform,
        'output' => array(
	        array(
	            'element'  => 'h2.ppb_title',
	            'property' => 'text-transform',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_subtitle_builder_font_size',
        'label'    => esc_html__(' Content Builder Sub Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'header_builder_title',
        'default'  => 11,
        'choices' => array( 'min' => 11, 'max' => 30, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '.ppb_subtitle',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_page_tagline_font_color',
        'label'    => esc_html__('Page Tagline Font Color', 'grandportfolio-translation' ),
        'section'  => 'header_tagline',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '.page_tagline, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_tagline_font_size',
        'label'    => esc_html__('Page Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'header_tagline',
        'default'  => 13,
        'choices' => array( 'min' => 10, 'max' => 30, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '.page_tagline, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 10,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_tagline_font_weight',
        'label'    => esc_html__('Page Tagline Font Weight', 'grandportfolio-translation' ),
        'section'  => 'header_tagline',
        'default'  => 400,
        'choices' => array( 'min' => 100, 'max' => 900, 'step' => 100 ),
        'output' => array(
	        array(
	            'element'  => '.page_tagline',
	            'property' => 'font-weight',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 11,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_page_tagline_font_spacing',
        'label'    => esc_html__('Page Tagline Font Spacing', 'grandportfolio-translation' ),
        'section'  => 'header_tagline',
        'default'  => 0,
        'choices' => array( 'min' => -2, 'max' => 4, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '.page_tagline, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company',
	            'property' => 'letter-spacing',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 12,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_page_tagline_transform',
        'label'    => esc_html__('Page Tagline Text Transform', 'grandportfolio-translation' ),
        'section'  => 'header_tagline',
        'default'  => 'none',
        'choices'  => $tg_text_transform,
        'output' => array(
	        array(
	            'element'  => '.page_tagline, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company',
	            'property' => 'text-transform',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    //End Header Tab Settings
    
    //Register Sidebar Tab Settings
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_sidebar_title_font',
        'label'    => esc_html__('Widget Title Font Family', 'grandportfolio-translation' ),
        'section'  => 'sidebar_typography',
        'default'  => 'Karla',
        'choices'  => Kirki_Fonts::get_font_choices(),
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
	            'property' => 'font-family',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_sidebar_title_font_size',
        'label'    => esc_html__('Widget Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'sidebar_typography',
        'default'  => 12,
        'choices' => array( 'min' => 11, 'max' => 40, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_sidebar_title_font_weight',
        'label'    => esc_html__('Widget Title Font Weight', 'grandportfolio-translation' ),
        'section'  => 'sidebar_typography',
        'default'  => 900,
        'choices' => array( 'min' => 100, 'max' => 900, 'step' => 100 ),
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
	            'property' => 'font-weight',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_sidebar_title_font_spacing',
        'label'    => esc_html__('Widget Title Font Spacing', 'grandportfolio-translation' ),
        'section'  => 'sidebar_typography',
        'default'  => 2,
        'choices' => array( 'min' => -2, 'max' => 4, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
	            'property' => 'letter-spacing',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_sidebar_title_transform',
        'label'    => esc_html__('Widget Title Text Transform', 'grandportfolio-translation' ),
        'section'  => 'sidebar_typography',
        'default'  => 'uppercase',
        'choices'  => $tg_text_transform,
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
	            'property' => 'text-transform',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_sidebar_font_color',
        'label'    => esc_html__('Sidebar Font Color', 'grandportfolio-translation' ),
        'section'  => 'sidebar_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .inner .sidebar_wrapper .sidebar .content, .page_content_wrapper .inner .sidebar_wrapper .sidebar .content',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_sidebar_link_color',
        'label'    => esc_html__('Sidebar Link Color', 'grandportfolio-translation' ),
        'section'  => 'sidebar_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .inner .sidebar_wrapper a, .page_content_wrapper .inner .sidebar_wrapper a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_sidebar_hover_link_color',
        'label'    => esc_html__('Sidebar Hover Link Color', 'grandportfolio-translation' ),
        'section'  => 'sidebar_color',
        'default'  => '#999999',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .inner .sidebar_wrapper a:hover, #page_content_wrapper .inner .sidebar_wrapper a:active, .page_content_wrapper .inner .sidebar_wrapper a:hover, .page_content_wrapper .inner .sidebar_wrapper a:active',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_sidebar_title_color',
        'label'    => esc_html__('Sidebar Widget Title Font Color', 'grandportfolio-translation' ),
        'section'  => 'sidebar_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    //End Sidebar Tab Settings
    
    //Register Footer Tab Settings
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_footer_sidebar',
        'label'    => esc_html__('Footer Sidebar Columns', 'grandportfolio-translation' ),
        'section'  => 'footer_general',
        'default'  => 4,
        'choices'  => $tg_copyright_column,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_footer_social_link',
        'label'    => esc_html__('Open Footer Social Icons link in new window', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this to open footer social icons link in new window', 'grandportfolio-translation' ),
        'section'  => 'footer_general',
        'default'  => 1,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'background',
        'setting'  => 'tg_footer_bg',
        'label'    => esc_html__('Footer Background', 'grandportfolio-translation' ),
        'section'  => 'footer_color',
	    'default'     => array(
	        'color'    => '#f9f9f9',
	        'image'    => '',
	        'repeat'   => 'no-repeat',
	        'size'     => 'cover',
	        'attach'   => 'fixed',
	        'position' => 'center-center',
	        'opacity'  => 100
	    ),
	    'output' => '.footer_bar',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_footer_font_color',
        'label'    => esc_html__('Footer Font Color', 'grandportfolio-translation' ),
        'section'  => 'footer_color',
        'default'  => '#777777',
        'output' => array(
	        array(
	            'element'  => '#footer, #copyright, #footer_menu li a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 10,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_footer_link_color',
        'label'    => esc_html__('Footer Link Color', 'grandportfolio-translation' ),
        'section'  => 'footer_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#copyright a, #copyright a:active, #footer a, #footer a:active',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 11,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_footer_hover_link_color',
        'label'    => esc_html__('Footer Hover Link Color', 'grandportfolio-translation' ),
        'section'  => 'footer_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#copyright a:hover, #footer a:hover, .social_wrapper ul li a:hover',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 12,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_footer_border_color',
        'label'    => esc_html__('Footer Border Color', 'grandportfolio-translation' ),
        'section'  => 'footer_color',
        'default'  => '#e1e1e1',
        'output' => array(
	        array(
	            'element'  => '.footer_bar_wrapper, .footer_bar',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_footer_social_color',
        'label'    => esc_html__('Footer Social Icon Color', 'grandportfolio-translation' ),
        'section'  => 'footer_color',
        'default'  => '#999999',
        'output' => array(
	        array(
	            'element'  => '.footer_bar_wrapper .social_wrapper ul li a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_footer_widget_title_color',
        'label'    => esc_html__('Footer Widget Title Color', 'grandportfolio-translation' ),
        'section'  => 'footer_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#footer .sidebar_widget li h2.widgettitle',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_footer_copyright_layout',
        'label'    => esc_html__('Copyright Content Layout', 'grandportfolio-translation' ),
        'section'  => 'footer_copyright',
        'default'  => 'center',
        'choices'  => $tg_copyright_layout,
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'textarea',
        'setting'  => 'tg_footer_copyright_text',
        'label'    => esc_html__('Copyright Text', 'grandportfolio-translation' ),
        'description' => esc_html__('Enter your copyright text.', 'grandportfolio-translation' ),
        'section'  => 'footer_copyright',
        'default'  => '© Copyright Grand Portfolio Theme Demo - Theme by ThemeGoods',
        'transport' 	 => 'postMessage',
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_footer_copyright_right_area',
        'label'    => esc_html__('Copyright Additional Content', 'grandportfolio-translation' ),
        'section'  => 'footer_copyright',
        'default'  => 'social',
        'choices'  => $tg_copyright_content,
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_footer_copyright_totop',
        'label'    => esc_html__('Go To Top Button', 'grandportfolio-translation' ),
        'description' => 'Check this option to enable go to top button at the bottom of page when scrolling',
        'section'  => 'footer_copyright',
        'default'  => 1,
	    'priority' => 7,
    );
    //End Footer Tab Settings
    
    
    //Begin Gallery Tab Settings
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_gallery_sort',
        'label'    => esc_html__('Gallery Images Sorting', 'grandportfolio-translation' ),
        'section'  => 'gallery_sorting',
        'default'  => 'drag',
        'choices'  => $tg_gallery_sort,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_lightbox_skin',
        'label'    => esc_html__('Select lightbox skin color', 'grandportfolio-translation' ),
        'description' => esc_html__('Select which skin you want to use for lightbox', 'grandportfolio-translation' ),
        'section'  => 'gallery_lightbox',
        'default'  => 'metro-white',
        'choices'  => $tg_lightbox_skin,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_lightbox_enable_caption',
        'label'    => esc_html__('Display image caption in lightbox', 'grandportfolio-translation' ),
        'description' => esc_html__('Check if you want to display image caption under the image in lightbox mode', 'grandportfolio-translation' ),
        'section'  => 'gallery_lightbox',
        'default'  => 1,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_lightbox_thumbnails',
        'label'    => esc_html__('Select lightbox thumbnails alignment', 'grandportfolio-translation' ),
        'description' => esc_html__('Select which alignment you want to use for lightbox thumbnails', 'grandportfolio-translation' ),
        'section'  => 'gallery_lightbox',
        'default'  => 'horizontal',
        'choices'  => $tg_lightbox_thumbnails,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_lightbox_opacity',
        'label'    => esc_html__('Lightbox Overlay Opacity', 'grandportfolio-translation' ),
        'section'  => 'gallery_lightbox',
        'default'  => 95,
        'choices' => array( 'min' => 0, 'max' => 100, 'step' => 5 ),
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_gallery_hover_slide',
        'label'    => esc_html__('Enable slideshow on hover effect', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to enable slideshow effect when move mouse over gallery thumbnail', 'grandportfolio-translation' ),
        'section'  => 'gallery_archive',
        'default'  => 1,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_full_autoplay',
        'label'    => esc_html__('Enable autoplay slideshow', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to let fullscreen slideshow starts playing automatically', 'grandportfolio-translation' ),
        'section'  => 'gallery_fullscreen',
        'default'  => 1,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_full_random',
        'label'    => esc_html__('Enable random slideshow', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to let fullscreen slideshow displays images randomly', 'grandportfolio-translation' ),
        'section'  => 'gallery_fullscreen',
        'default'  => 0,
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_full_slideshow_timer',
        'label'    => esc_html__('Slideshow Timer', 'grandportfolio-translation' ),
        'description' => esc_html__('Select number of seconds for Full Screen Slideshow timer', 'grandportfolio-translation' ),
        'section'  => 'gallery_fullscreen',
        'default'  => 9,
        'choices' => array( 'min' => 1, 'max' => 20, 'step' => 1 ),
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_full_slideshow_trans',
        'label'    => esc_html__('Slideshow Transition Effect', 'grandportfolio-translation' ),
        'description' => esc_html__('Select transition type for contents in Full Screen slideshow', 'grandportfolio-translation' ),
        'section'  => 'gallery_fullscreen',
        'default'  => 1,
        'choices'  => $tg_slideshow_trans,
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_full_slideshow_trans_speed',
        'label'    => esc_html__('Slideshow Transition Timer', 'grandportfolio-translation' ),
        'description' => esc_html__('Select number of milliseconds for transition between each image', 'grandportfolio-translation' ),
        'section'  => 'gallery_fullscreen',
        'default'  => 800,
        'choices' => array( 'min' => 100, 'max' => 10000, 'step' => 100 ),
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_full_image_caption',
        'label'    => esc_html__('Display slideshow image caption', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option if you want to display fullscreen slideshow image caption', 'grandportfolio-translation' ),
        'section'  => 'gallery_fullscreen',
        'default'  => 1,
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_full_nocover',
        'label'    => esc_html__('Display image proportion size', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option if you want to display slide image proportion size without covering screen', 'grandportfolio-translation' ),
        'section'  => 'gallery_fullscreen',
        'default'  => 0,
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_full_arrow',
        'label'    => esc_html__('Display slideshow arrows', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option if you want to display slide navigation arrow', 'grandportfolio-translation' ),
        'section'  => 'gallery_fullscreen',
        'default'  => 0,
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_kenburns_timer',
        'label'    => esc_html__('Kenburns Slideshow timer', 'grandportfolio-translation' ),
        'description' => esc_html__('Select number of seconds for Kenburns Slideshow timer', 'grandportfolio-translation' ),
        'section'  => 'gallery_kenburns',
        'default'  => 7,
        'choices' => array( 'min' => 1, 'max' => 20, 'step' => 1 ),
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_kenburns_zoom',
        'label'    => esc_html__('Kenburns Zoom Level', 'grandportfolio-translation' ),
        'description' => esc_html__('Select zoom level for Kenburns slideshow', 'grandportfolio-translation' ),
        'section'  => 'gallery_kenburns',
        'default'  => 2,
        'choices' => array( 'min' => 1, 'max' => 10, 'step' => 1 ),
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_kenburns_trans',
        'label'    => esc_html__('Kenburns Transition Timer', 'grandportfolio-translation' ),
        'description' => esc_html__('Select number of seconds for transition between each image', 'grandportfolio-translation' ),
        'section'  => 'gallery_kenburns',
        'default'  => 1000,
        'choices' => array( 'min' => 100, 'max' => 1000, 'step' => 100),
	    'priority' => 10,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_flow_enable_reflection',
        'label'    => esc_html__('Display Image Reflection', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option if you want to display mirror reflection effect in flow gallery', 'grandportfolio-translation' ),
        'section'  => 'gallery_flow',
        'default'  => 0,
	    'priority' => 11,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_flow_enable_lightbox',
        'label'    => esc_html__('Link flow gallery image to lightbox', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option if you want to link flow gallery to full size image in lightbox mode', 'grandportfolio-translation' ),
        'section'  => 'gallery_flow',
        'default'  => 1,
	    'priority' => 12,
    );
    
    //End Gallery Tab Settings
    
    
    //Begin Portfolio Tab Settings
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_portfolio_hover_style',
        'label'    => esc_html__('Portfolio Hover Style', 'grandportfolio-translation' ),
        'section'  => 'portfolio_general',
        'default'  => 'classic',
        'choices'  => $tg_portfolio_hover_style,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_portfolio_hover_timer',
        'label'    => esc_html__('Portfolio Hover Timer', 'grandportfolio-translation' ),
        'description' => esc_html__('Select number of seconds for transition when hover portfolio image', 'grandportfolio-translation' ),
        'section'  => 'portfolio_general',
        'default'  => 4.5,
        'choices' => array( 'min' => 0.1, 'max' => 6, 'step' => 0.1),
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_portfolio_grayscale',
        'label'    => esc_html__('Enable Portfolio Grayscale Filter', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to enable grayscale filter for portfolio featured images', 'grandportfolio-translation' ),
        'section'  => 'portfolio_general',
        'default'  => 0,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_portfolio_filterable',
        'label'    => esc_html__('Enable Portfolio Filterable Feature', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to enable filterable feature in portfolio pages', 'grandportfolio-translation' ),
        'section'  => 'portfolio_filterable',
        'default'  => 1,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_portfolio_filterable_link',
        'label'    => esc_html__('Link Portfolio Filterable', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to enable linking filterable to its page.', 'grandportfolio-translation' ),
        'section'  => 'portfolio_filterable',
        'default'  => 0,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_portfolio_filterable_sort',
        'label'    => esc_html__('Portfolio Filterable Options Sorting', 'grandportfolio-translation' ),
        'section'  => 'portfolio_filterable',
        'default'  => 'name',
        'choices'  => $tg_portfolio_filterable_sort,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_portfolio_items',
        'label'    => esc_html__('Portfolio Page Show At Most', 'grandportfolio-translation' ),
        'description' => esc_html__('Select number of portfolio items you want to display per page', 'grandportfolio-translation' ),
        'section'  => 'portfolio_page',
        'default'  => 24,
        'choices' => array( 'min' => 1, 'max' => 50, 'step' => 1 ),
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'setting'  => 'tg_portfolio_url',
        'label'    => esc_html__('Portfolio Page (Optional)', 'grandportfolio-translation' ),
        'description' => esc_html__('Enter your portfolio page URL so it displays portfolio page link in recent portfolio module.', 'grandportfolio-translation' ),
        'section'  => 'portfolio_page',
        'default'  => '',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_portfolio_fullscreen_menu_recent',
        'label'    => esc_html__('Display Recent Portfolios on Fullscreen Menu Layout (Optional)', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to display recent portfolios when using fullscreen menu layout', 'grandportfolio-translation' ),
        'section'  => 'portfolio_page',
        'default'  => 1,
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_portfolio_next_prev',
        'label'    => esc_html__('Display Next and Previous Portfolios', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to display next and previous portfolios in single portfolio page', 'grandportfolio-translation' ),
        'section'  => 'portfolio_single',
        'default'  => 0,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_portfolio_recent',
        'label'    => esc_html__('Display Recent Portfolios', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to display recent portfolios in single portfolio page', 'grandportfolio-translation' ),
        'section'  => 'portfolio_single',
        'default'  => 1,
	    'priority' => 6,
    );
    //End Portfolio Tab Settings
    
    
    //Begin Blog Tab Settings
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_blog_display_full',
        'label'    => esc_html__('Display Full Blog Post Content', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to display post full content in blog page (excerpt blog grid layout)', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 0,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_blog_archive_layout',
        'label'    => esc_html__('Archive Page Layout', 'grandportfolio-translation' ),
        'description' => esc_html__('Select page layout for displaying archive page', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 'blog_f',
        'choices'  => $tg_blog_layout,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_blog_category_layout',
        'label'    => esc_html__('Category Page Layout', 'grandportfolio-translation' ),
        'description' => esc_html__('Select page layout for displaying category page', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 'blog_f',
        'choices'  => $tg_blog_layout,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_blog_tag_layout',
        'label'    => esc_html__('Tag Page Layout', 'grandportfolio-translation' ),
        'description' => esc_html__('Select page layout for displaying tag page', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 'blog_f',
        'choices'  => $tg_blog_layout,
	    'priority' => 3,
    );
    
     $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_blog_fullwidth',
        'label'    => esc_html__('Blog Fullwidth Layout Custom Width (in %)', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 80,
        'choices' => array( 'min' => 50, 'max' => 100, 'step' => 5 ),
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .inner .sidebar_content.full_width.blog_f',
	            'property' => 'width',
	            'units'    => '%',
	        ),
	    ),
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'setting'  => 'tg_blog_cat_font_color',
        'label'    => esc_html__('Post Category Link Font Color', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => '#999999',
        'output' => array(
	        array(
	            'element'  => '.post_info_cat, .post_info_cat a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_blog_header_align',
        'label'    => esc_html__('Post Header Text Alignment', 'grandportfolio-translation' ),
        'description' => esc_html__('Select text alignment for post header', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 'center',
        'choices'  => $tg_text_alignment,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_blog_header_transform',
        'label'    => esc_html__('Post Header Text Transform', 'grandportfolio-translation' ),
        'description' => esc_html__('Select text transform for post header', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 'none',
        'choices'  => $tg_text_transform,
        'output' => array(
	        array(
	            'element'  => '.post_header h3, .post_header h4, .post_header h5, .post_header h6, .post_header h3, .post_header h4, .post_header h5, .post_header h6, #post_featured_slider li .slider_image .slide_post h2, .post_featured_slider li .slider_image .slide_post h2, #post_featured_slider li .slider_image.three_cols .slide_post h2, .post_featured_slider li .slider_image.three_cols .slide_post h2, body.single .post_header.grid.related strong, body.single-post .post_caption h1, #page_content_wrapper .posts.blog li a',
	            'property' => 'text-transform',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_blog_classic_title_font_size',
        'label'    => esc_html__(' Blog Classic Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 32,
        'choices' => array( 'min' => 12, 'max' => 100, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '.post_header h5',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_blog_fullwidth_title_font_size',
        'label'    => esc_html__(' Blog Fullwidth Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 32,
        'choices' => array( 'min' => 12, 'max' => 100, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '.sidebar_content.full_width.blog_f .post_header h5',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_blog_twocols_title_font_size',
        'label'    => esc_html__(' Blog Grid 2 Columns Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 22,
        'choices' => array( 'min' => 12, 'max' => 100, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#blog_grid_wrapper.two_cols .post_header.grid h6, .blog_grid_wrapper.two_cols .post_header.grid h6',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_blog_threecols_title_font_size',
        'label'    => esc_html__(' Blog Grid 3 Columns Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'blog_general',
        'default'  => 20,
        'choices' => array( 'min' => 12, 'max' => 100, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '.post_header.grid h6',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_blog_slider',
        'label'    => esc_html__('Display Slider', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to display slider in blog pages', 'grandportfolio-translation' ),
        'section'  => 'blog_slider',
        'default'  => 1,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_blog_slider_layout',
        'label'    => esc_html__('Slider Layout', 'grandportfolio-translation' ),
        'description' => esc_html__('Select layout for slider posts', 'grandportfolio-translation' ),
        'section'  => 'blog_slider',
        'default'  => '3cols-slider',
        'choices'  => $tg_slider_layout,
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_blog_slider_cat',
        'label'    => esc_html__('Slider Post Category', 'grandportfolio-translation' ),
        'description' => esc_html__('Select post category filter for slider posts', 'grandportfolio-translation' ),
        'section'  => 'blog_slider',
        'default'  => '',
        'choices'  => $tg_categories_select,
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_blog_slider_items',
        'label'    => esc_html__('Slider Post Items', 'grandportfolio-translation' ),
        'section'  => 'blog_slider',
        'default'  => 5,
        'choices' => array( 'min' => 1, 'max' => 30, 'step' => 1 ),
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_single_post_title_size',
        'label'    => esc_html__('Single Post Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'blog_single',
        'default'  => 34,
        'choices' => array( 'min' => 13, 'max' => 80, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '.post_caption h1, #page_caption.hasbg .background_center_title_wrapper .title_content h1',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_single_post_sub_title_size',
        'label'    => esc_html__('Single Post Sub Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'blog_single',
        'default'  => 26,
        'choices' => array( 'min' => 13, 'max' => 80, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h6.subtitle',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'setting'  => 'tg_single_post_related_title_size',
        'label'    => esc_html__('Single Post Related Title Font Size', 'grandportfolio-translation' ),
        'section'  => 'blog_single',
        'default'  => 15,
        'choices' => array( 'min' => 13, 'max' => 80, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'body.single .post_header.grid.related',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'setting'  => 'tg_single_post_bg_style',
        'label'    => esc_html__('Header With Background Style', 'grandportfolio-translation' ),
        'section'  => 'blog_single',
        'default'  => 'classic',
        'choices'  => $tg_header_bg_style,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_blog_header_bg',
        'label'    => esc_html__('Display Post Header', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this to display featured image as post header background', 'grandportfolio-translation' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_blog_feat_content',
        'label'    => esc_html__('Display Post Featured Content', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this to display featured content (image or gallery) in single post page', 'grandportfolio-translation' ),
        'section'  => 'blog_single',
        'default'  => 0,
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_blog_display_tags',
        'label'    => esc_html__('Display Post Tags', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to display post tags on single post page', 'grandportfolio-translation' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_blog_display_author',
        'label'    => esc_html__('Display About Author', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to display about author on single post page', 'grandportfolio-translation' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'setting'  => 'tg_blog_display_related',
        'label'    => esc_html__('Display Related Posts', 'grandportfolio-translation' ),
        'description' => esc_html__('Check this option to display related posts on single post page', 'grandportfolio-translation' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 8,
    );
    //End Blog Tab Settings
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		//Begin Shop Tab Settings
		$controls[] = array(
	        'type'     => 'select',
	        'setting'  => 'tg_shop_layout',
	        'label'    => esc_html__('Shop Main Page Layout', 'grandportfolio-translation' ),
	        'description' => esc_html__('Select page layout for displaying shop\'s products page', 'grandportfolio-translation' ),
	        'section'  => 'shop_layout',
	        'default'  => 'fullwidth',
	        'choices'  => $tg_shop_layout,
		    'priority' => 1,
	    );
	    
	    $controls[] = array(
	        'type'     => 'slider',
	        'setting'  => 'tg_shop_items',
	        'label'    => esc_html__('Products Page Show At Most', 'grandportfolio-translation' ),
	        'description' => esc_html__('Select number of product items you want to display per page', 'grandportfolio-translation' ),
	        'section'  => 'shop_layout',
	        'default'  => 16,
	        'choices' => array( 'min' => 1, 'max' => 100, 'step' => 1 ),
		    'priority' => 2,
	    );
	    
	    $controls[] = array(
	        'type'     => 'color',
	        'setting'  => 'tg_shop_price_font_color',
	        'label'    => esc_html__('Product Price Font Color', 'grandportfolio-translation' ),
	        'section'  => 'shop_single',
	        'default'  => '#222222',
	        'output' => array(
		        array(
		            'element'  => '.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, p.price ins span.amount, p.price span.amount, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price',
		            'property' => 'color',
		        ),
		    ),
		    'transport' 	 => 'postMessage',
		    'priority' => 2,
	    );
	    
	    $controls[] = array(
	        'type'     => 'toggle',
	        'setting'  => 'tg_shop_related_products',
	        'label'    => esc_html__('Display Related Products', 'grandportfolio-translation' ),
	        'description' => esc_html__('Check this option to display related products on single product page', 'grandportfolio-translation' ),
	        'section'  => 'shop_single',
	        'default'  => 1,
		    'priority' => 3,
	    );
		//End Shop Tab Settings
	}

    return $controls;
}
add_filter( 'kirki/controls', 'grandportfolio_custom_setting' );


function grandportfolio_customize_preview()
{
?>
    <script type="text/javascript">
        ( function( $ ) {
        	//Register Logo Tab Settings
        	wp.customize('tg_retina_logo',function( value ) {
                value.bind(function(to) {
                    jQuery('#custom_logo img').attr('src', to );
                });
            });
        	//End Logo Tab Settings
        
			//Register General Tab Settings
            wp.customize('tg_body_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('body, input[type=text], input[type=email], input[type=url], input[type=password], textarea, .portfolio_title_desc').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_body_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('body').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_header_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('h1, h2, h3, h4, h5, h6, h7, .post_quote_title, label, strong[itemprop="author"], #page_content_wrapper .posts.blog li a, .page_content_wrapper .posts.blog li a, .post_info_cat, .readmore, .post_info_comment, #post_featured_slider li .slider_image .slide_post .slide_post_date, .post_featured_slider li .slider_image .slide_post .slide_post_date, .ppb_subtitle, .comment_date, .post_attribute, .post_header_title, .post_header.grid, .odometer, .pricing_wrapper li.price_row em.exact_price').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_header_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('h1, h2, h3, h4, h5, h6, h7, .post_info_cat, .comment_date, .post_attribute').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_header_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('h1, h2, h3, h4, h5, h6, h7, blockquote, body.single .post_header.grid.related').css('letterSpacing', to+ 'px' );
                });
            });
            
            wp.customize('tg_header_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('h1, h2, h3, h4, h5, h6, h7, blockquote').css('textTransform', to );
                });
            });
            
            wp.customize('tg_content_bg_color',function( value ) {
                value.bind(function(to) {
                    jQuery('body, #wrapper, #page_content_wrapper.fixed, #gallery_lightbox h2, .slider_wrapper .gallery_image_caption h2, #body_loading_screen, h3#reply-title span, .overlay_gallery_wrapper, .progress_bar_holder, .pricing_wrapper_border, .pagination a, .pagination span, blockquote:before').css('background-color', to );
                });
            });
            
            wp.customize('tg_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('body, .pagination a, #gallery_lightbox h2, .slider_wrapper .gallery_image_caption h2, .post_info a, #page_content_wrapper.split #copyright, .page_content_wrapper.split #copyright, .ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited').css('color', to );
                    jQuery('::selection').css('background-color', to );
                    jQuery('::-webkit-input-placeholder').css('color', to );
                    jQuery('::-moz-placeholder').css('color', to );
                    jQuery(':-ms-input-placeholder').css('color', to );
                });
            });
            
            wp.customize('tg_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('a').css('color', to );
                });
            });
            
            wp.customize('tg_hover_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('a:hover, a:active, .post_info_comment a i').css('color', to );
                });
            });
            
            wp.customize('tg_h1_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('h1, h2, h3, h4, h5, pre, code, tt, blockquote, .post_header h5 a, .post_header h3 a, .post_header.grid h6 a, .post_header.fullwidth h4 a, .post_header h5 a, blockquote, .site_loading_logo_item i, .woocommerce .woocommerce-ordering select, .woocommerce #page_content_wrapper a.button, .woocommerce.columns-4 ul.products li.product a.add_to_cart_button, .woocommerce.columns-4 ul.products li.product a.add_to_cart_button:hover, .tabs .ui-state-active a, body.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .post_header h5 a, .post_header h6 a, blockquote:before').css('color', to );
                    
                    jQuery('body.page.page-template-gallery-archive-split-screen-php #fp-nav li .active span, body.tax-gallerycat #fp-nav li .active span, body.page.page-template-portfolio-fullscreen-split-screen-php #fp-nav li .active span, body.page.tax-portfolioset #fp-nav li .active span, body.page.page-template-gallery-archive-split-screen-php #fp-nav ul li a span, body.tax-gallerycat #fp-nav ul li a span, body.page.page-template-portfolio-fullscreen-split-screen-php #fp-nav ul li a span, body.page.tax-portfolioset #fp-nav ul li a span').css('backgroundColor', to );
                });
            });
            
            wp.customize('tg_hr_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#social_share_wrapper, hr, #social_share_wrapper, .post.type-post, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle, .comment .right, .widget_tag_cloud div a, .meta-tags a, .tag_cloud a, #footer, #post_more_wrapper, .woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, #page_content_wrapper .inner .sidebar_content, #page_caption, #page_content_wrapper .inner .sidebar_content.left_sidebar, .ajax_close, .ajax_next, .ajax_prev, .portfolio_next, .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_next, .separated, .blog_next_prev_wrapper, #post_more_wrapper h5, #ajax_portfolio_wrapper.hidding, #ajax_portfolio_wrapper.visible, .tabs.vertical .ui-tabs-panel, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel, .woocommerce table.shop_table, .woocommerce-page table.shop_table, table tr td, .woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals, .woocommerce .cart-collaterals .shipping_calculator, .woocommerce-page .cart-collaterals .shipping_calculator, .woocommerce .cart-collaterals .cart_totals tr td, .woocommerce .cart-collaterals .cart_totals tr th, .woocommerce-page .cart-collaterals .cart_totals tr td, .woocommerce-page .cart-collaterals .cart_totals tr th, table tr th, .woocommerce #payment, .woocommerce-page #payment, .woocommerce #payment ul.payment_methods li, .woocommerce-page #payment ul.payment_methods li, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row, .ui-tabs li:first-child, .ui-tabs .ui-tabs-nav li, .ui-tabs.vertical .ui-tabs-nav li, .ui-tabs.vertical.right .ui-tabs-nav li.ui-state-active, .ui-tabs.vertical .ui-tabs-nav li:last-child, #page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .pricing_wrapper, .pricing_wrapper li, , .ui-accordion .ui-accordion-header, .ui-accordion .ui-accordion-content, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle:before, h2.widgettitle:before, #autocomplete, .ppb_blog_minimal .one_third_bg, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.event_title, .woocommerce .woocommerce-ordering select, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page table.cart th, table.shop_table thead tr th, hr.title_break, .overlay_gallery_border, #page_content_wrapper.split #copyright, .page_content_wrapper.split #copyright, .post.type-post, .events.type-events, h5.event_title, .post_header h5.event_title, blockquote:after, #about_the_author, .two_cols.gallery.wide .element, .three_cols.gallery.wide .element, .four_cols.gallery.wide .element').css('border-color', to );
                });
            });
            
            wp.customize('tg_input_bg_color',function( value ) {
                value.bind(function(to) {
                    jQuery('input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], textarea').css('background-color', to );
                });
            });
            
            wp.customize('tg_input_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], textarea').css('color', to );
                });
            });
            
            wp.customize('tg_input_border_color',function( value ) {
                value.bind(function(to) {
                    jQuery('input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], textarea').css('border-color', to );
                });
            });
            
            wp.customize('tg_input_focus_color',function( value ) {
                value.bind(function(to) {
                    jQuery('input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=url]:focus, textarea:focus').css('border-color', to );
                });
            });
            
            wp.customize('tg_button_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_button_bg_color',function( value ) {
                value.bind(function(to) {
                	jQuery('input[type=submit], input[type=button], a.button, .button, .pagination span, .pagination a:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt').css('background-color', to );
                    jQuery('.pagination span, .pagination a:hover').css('border-color', to );
                });
            });
            
            wp.customize('tg_button_font_color',function( value ) {
                value.bind(function(to) {
                	jQuery('input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt').css('color', to );
                });
            });
            
            wp.customize('tg_button_border_color',function( value ) {
                value.bind(function(to) {
                	jQuery('input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt').css('border-color', to );
                });
            });
            //End General Tab Settings
        
        	//Register Menu Tab Settings
        	wp.customize('tg_menu_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_menu_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_menu_padding',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a').css('paddingTop', to+'px' );
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a').css('paddingBottom', to+'px' );
                });
            });
            
            wp.customize('tg_menu_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_menu_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a').css('letterSpacing', to+'px' );
                });
            });
            
            wp.customize('tg_menu_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .sicky_nav li a').css('textTransform', to );
                });
            });
            
            wp.customize('tg_menu_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, .header_cart_wrapper a, #page_share').css('color', to );
                    jQuery('#mobile_nav_icon').css('borderColor', to );
                });
            });
            
            wp.customize('tg_menu_hover_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover, .header_cart_wrapper a:hover, #page_share:hover').css('color', to );
                    jQuery('#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover').css('borderColor', to );
                });
            });
            
            wp.customize('tg_menu_active_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent  ul li.current-menu-item a, .header_cart_wrapper a:active, #page_share:active').css('color', to );
                    jQuery('#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent  ul li.current-menu-item a').css('borderColor', to );
                });
            });
            
            wp.customize('tg_menu_border_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.top_bar, #page_caption, #nav_wrapper').css('borderColor', to );
                });
            });
            
            wp.customize('tg_submenu_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_submenu_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_submenu_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a').css('letterSpacing', to+'px' );
                });
            });
            
            wp.customize('tg_submenu_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a').css('textTransform', to );
                });
            });
            
            wp.customize('tg_submenu_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a').css('color', to );
                });
            });
            
            wp.customize('tg_submenu_hover_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active').css('color', to );
                });
            });
            
            wp.customize('tg_submenu_hover_bg_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active').css('background', to );
                });
            });
            
            wp.customize('tg_submenu_bg_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul').css('background', to );
                });
            });
            
            wp.customize('tg_submenu_border_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul').css('borderColor', to );
                });
            });
            
            wp.customize('tg_megamenu_header_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper div .nav li.megamenu ul li > a, #menu_wrapper div .nav li.megamenu ul li > a:hover, #menu_wrapper div .nav li.megamenu ul li > a:active, #menu_wrapper div .nav li.megamenu ul li.current-menu-item > a').css('color', to );
                });
            });
            
            wp.customize('tg_megamenu_border_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper div .nav li.megamenu ul li').css('borderColor', to );
                });
            });
            
            wp.customize('tg_topbar_bg_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.above_top_bar').css('background', to );
                });
            });
            
            wp.customize('tg_topbar_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('.above_top_bar').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_topbar_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#top_menu li a, .top_contact_info, .top_contact_info i, .top_contact_info a, .top_contact_info a:hover, .top_contact_info a:active').css('color', to );
                });
            });
            
            wp.customize('tg_topbar_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('.top_contact_info, #top_menu li a').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_menu_contact_hours',function( value ) {
                value.bind(function(to) {
                    jQuery('#top_contact_hours').html('<i class="fa fa-clock-o"></i>'+to);
                });
            });
            
            wp.customize('tg_menu_contact_number',function( value ) {
                value.bind(function(to) {
                    jQuery('#top_contact_number').html('<i class="fa fa-phone"></i>'+to);
                });
            });
            
            wp.customize('tg_menu_search_input_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_menu_wrapper #searchform').css('background', to );
                });
            });
            
            wp.customize('tg_menu_search_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_menu_wrapper #searchform input[type=text], .mobile_menu_wrapper #searchform button i, #close_mobile_menu i').css('color', to );
                });
            });
            
            wp.customize('tg_sidemenu_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('.mobile_main_nav li a, #sub_menu li a').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_sidemenu_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_main_nav li a, #sub_menu li a').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_sidemenu_line_height',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_main_nav li a, #sub_menu li a').css('lineHeight', to+'em' );
                });
            });
            
            wp.customize('tg_sidemenu_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_main_nav li a, #sub_menu li a').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_sidemenu_font_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_main_nav li a, #sub_menu li a').css('textTransform', to );
                });
            });
            
            wp.customize('tg_sidemenu_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_main_nav li a, #sub_menu li a, .mobile_menu_wrapper .sidebar_wrapper a, .mobile_menu_wrapper .sidebar_wrapper, #close_mobile_menu i, .fullmenu_wrapper a, .fullmenu_wrapper h2.widgettitle, .mobile_menu_wrapper #copyright').css('color', to );
                });
            });
            
            wp.customize('tg_submenu_hover_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_main_nav li a:hover, .mobile_main_nav li a:active, #sub_menu li a:active, .mobile_menu_wrapper .sidebar_wrapper h2.widgettitle').css('color', to );
                });
            });
            //End Menu Tab Settings
            
            
            //Register Header Tab Settings 
        	wp.customize('tg_page_header_bg_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption, .page_caption_bg_content, .overlay_gallery_content').css('background-color', to );
                    jQuery('.page_caption_bg_border, .overlay_gallery_border').css('border-color', to );
                });
            });
            
            wp.customize('tg_page_header_padding_top',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption').css('paddingTop', to+'px' );
                });
            });
            
            wp.customize('tg_page_header_padding_bottom',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption').css('paddingBottom', to+'px' );
                });
            });
            
            wp.customize('tg_page_title_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption h1, .ppb_title, .post_caption h1').css('color', to );
                });
            });
            
            wp.customize('tg_page_title_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption h1, .ppb_title, .post_caption h1').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_page_title_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption h1, .ppb_title, .post_caption h1').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_page_title_line_height',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption h1, .ppb_title, .post_caption h1').css('lineHeight', to+'em' );
                });
            });
            
            wp.customize('tg_page_title_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption h1, .ppb_title, .post_caption h1').css('textTransform', to );
                });
            });
            
            wp.customize('tg_page_title_bg_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption.hasbg h1, h1.hasbg').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_page_title_bg_height',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption.hasbg').css('height', to+'vh' );
                });
            });
            
            wp.customize('tg_header_builder_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('h2.ppb_title').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_header_builder_font_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('h2.ppb_title').css('textTransform', to );
                });
            });
            
            wp.customize('tg_subtitle_builder_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('.ppb_subtitle').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_page_tagline_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.page_tagline, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company').css('color', to );
                });
            });
            
            wp.customize('tg_page_tagline_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('.page_tagline, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_page_tagline_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('.page_tagline, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_page_tagline_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('.page_tagline, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company').css('textTransform', to );
                });
            });
            
            wp.customize('tg_page_tagline_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('.page_tagline, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company').css('letterSpacing', to+'px' );
                });
            });
        	//End Logo Header Settings
        	
        	//Register Sidebar Tab Settings
            wp.customize('tg_sidebar_title_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'http://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_sidebar_title_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_sidebar_title_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_sidebar_title_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('textTransform', to );
                });
            });
            
            wp.customize('tg_sidebar_title_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('letterSpacing', to+'px' );
                });
            });
            
            wp.customize('tg_sidebar_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .inner .sidebar_wrapper .sidebar .content, .page_content_wrapper .inner .sidebar_wrapper .sidebar .content').css('color', to );
                });
            });
            
            wp.customize('tg_sidebar_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .inner .sidebar_wrapper a, .page_content_wrapper .inner .sidebar_wrapper a').css('color', to );
                });
            });
            
            wp.customize('tg_sidebar_hover_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .inner .sidebar_wrapper a:hover, #page_content_wrapper .inner .sidebar_wrapper a:active, .page_content_wrapper .inner .sidebar_wrapper a:hover, .page_content_wrapper .inner .sidebar_wrapper a:active').css('color', to );
                });
            });
            
            wp.customize('tg_sidebar_title_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('color', to );
                });
            });
            //End Sidebar Tab Settings
            
            //Register Footer Tab Settings
            
            wp.customize('tg_footer_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#footer, #copyright, #footer_menu li a').css('color', to );
                });
            });
            
            wp.customize('tg_footer_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#copyright a, #copyright a:active, #footer a, #footer a:active').css('color', to );
                });
            });
            
            wp.customize('tg_footer_hover_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#copyright a:hover, #footer a:hover, .social_wrapper ul li a:hover').css('color', to );
                });
            });
            
            wp.customize('tg_footer_border_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.footer_bar_wrapper, .footer_bar').css('borderColor', to );
                });
            });
            
            wp.customize('tg_footer_social_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.footer_bar_wrapper .social_wrapper ul li a').css('color', to );
                });
            });
            
            wp.customize('tg_footer_widget_title_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#footer .sidebar_widget li h2.widgettitle').css('color', to );
                });
            });
            
            wp.customize('tg_footer_copyright_text',function( value ) {
                value.bind(function(to) {
                    jQuery('#copyright').html( to );
                });
            });
            //End Footer Tab Settings
            
            wp.customize('tg_single_post_title_size',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_caption h1, #page_caption.hasbg .background_center_title_wrapper .title_content h1').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_single_post_sub_title_size',function( value ) {
                value.bind(function(to) {
                    jQuery('h6.subtitle').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_single_post_related_title_size',function( value ) {
                value.bind(function(to) {
                    jQuery('body.single .post_header.grid.related').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_blog_cat_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_info_cat, .post_info_cat a').css('color', to );
                });
            });
            
            wp.customize('tg_blog_header_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header h3, .post_header h4, .post_header h5, .post_header h6, #post_featured_slider li .slider_image .slide_post h2, .post_featured_slider li .slider_image .slide_post h2, #post_featured_slider li .slider_image.three_cols .slide_post h2, .post_featured_slider li .slider_image.three_cols .slide_post h2, body.single .post_header.grid.related strong, body.single-post .post_caption h1, #page_content_wrapper .posts.blog li a').css('textTransform', to );
                });
            });
            
            wp.customize('tg_blog_classic_title_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header h5').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_blog_fullwidth_title_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('.sidebar_content.full_width.blog_f .post_header h5').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_blog_twocols_title_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('#blog_grid_wrapper.two_cols .post_header.grid h6, .blog_grid_wrapper.two_cols .post_header.grid h6').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_blog_threecols_title_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header.grid h6').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_blog_fullwidth',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .inner .sidebar_content.full_width.blog_f').css('width', to+'%' );
                });
            });
            
            
            //Register Shop Tab Settings
             wp.customize('tg_shop_price_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, p.price ins span.amount, p.price span.amount, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price').css( 'color', to );
                });
            });
            //End Shop Tab Settings
        } )( jQuery )
    </script>
<?php	
}