<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

if( ! class_exists( 'Youxi_Customize_Manager' ) ) {
	require( get_template_directory() . '/lib/framework/customizer/class-manager.php' );
}

class Shiroi_Customizer extends Youxi_Customize_Manager {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct();

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ) );

		add_action( 'customize_register', array( $this, 'color_customizer' ) );
		add_action( 'customize_register', array( $this, 'typography_customizer' ) );
		add_action( 'customize_register', array( $this, 'header_customizer' ) );
		add_action( 'customize_register', array( $this, 'footer_customizer' ) );
		add_action( 'customize_register', array( $this, 'featured_slider_customizer' ) );
		add_action( 'customize_register', array( $this, 'blog_customizer' ) );

	}

	public function enqueue_control_scripts() {

		/* Get theme version */
		$wp_theme = wp_get_theme();
		$theme_version = $wp_theme->exists() ? $wp_theme->get( 'Version' ) : false;

		wp_enqueue_script( 'shiroi-customize-controls', get_template_directory_uri() . '/assets/admin/js/shiroi.customize-controls.js', array( 'customize-controls' ), $theme_version, true );
		wp_localize_script( 'shiroi-customize-controls', '_shiroiCustomizeControls', array( 'prefix' => $this->prefix() ) );
	}

	public function pre_customize( $wp_customize ) {

		parent::pre_customize( $wp_customize );

		/* Remove predefined sections and controls */
		$wp_customize->remove_section( 'nav' );

		$wp_customize->remove_setting( 'background_color' );
		$wp_customize->remove_control( 'background_color' );

		$wp_customize->get_section( 'background_image' )->priority = 39;
	}

	public function color_customizer( $wp_customize ) {

		$prefix = $this->prefix();

		/* Styling Settings */

		$wp_customize->add_setting( $prefix . '[accent_color]', array(
			'default' => '#a57a50', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[color_scheme]', array(
			'default' => 'default'
		));
		$wp_customize->add_setting( $prefix . '[body_bg]', array(
			'default' => '#f0f0f0', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[text_color]', array(
			'default' => '#444444', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[headings_color]', array(
			'default' => '#101010', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[base_border_color]', array(
			'default' => '#eaeaea', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[dotted_border_color]', array(
			'default' => '#d5d5d5', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[base_box_bg]', array(
			'default' => '#ffffff', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[header_top_bg]', array(
			'default' => '#1d1d1d', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[header_top_text_color]', array(
			'default' => '#a7a7a7', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[header_top_link_hover_color]', array(
			'default' => '#ffffff', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[header_bg]', array(
			'default' => '#ffffff', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[menu_link_color]', array(
			'default' => '#444444', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[menu_link_hover_color]', array(
			'default' => '#101010', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[menu_submenu_bg]', array(
			'default' => '#1d1d1d', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[menu_submenu_link_color]', array(
			'default' => '#a7a7a7', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[menu_submenu_link_hover_color]', array(
			'default' => '#ffffff', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[footer_bg]', array(
			'default' => '#383838', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[footer_text_color]', array(
			'default' => '#cccccc', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[footer_link_color]', array(
			'default' => '#fafafa', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[footer_link_hover_color]', array(
			'default' => '#ffffff', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[footer_bottom_bg]', array(
			'default' => '#2f2f2f', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[widget_box_bg]', array(
			'default' => '#ffffff', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[widget_title_color]', array(
			'default' => '#101010', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[widget_title_border_color]', array(
			'default' => '#d5d5d5', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[widget_border_color]', array(
			'default' => '#eaeaea', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[widget_footer_title_color]', array(
			'default' => '#fafafa', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[widget_footer_title_border_color]', array(
			'default' => '#4d4d4d', 
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_setting( $prefix . '[widget_footer_border_color]', array(
			'default' => '#4d4d4d', 
			'sanitize_callback' => 'sanitize_hex_color'
		));

		/* Styling Controls */

		$priority = 0;

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[accent_color]', array(
				'label' => __( 'Accent Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));

		$wp_customize->add_control( $prefix . '[color_scheme]', array(
			'label' => __( 'Color Scheme', 'shiroi' ), 
			'section' => 'colors', 
			'type' => 'select', 
			'choices' => array(
				'default' => __( 'Default', 'shiroi' ), 
				'dark' => __( 'Dark', 'shiroi' ), 
				'custom' => __( 'Custom', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[body_bg]', array(
				'label' => __( 'Body Background Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[text_color]', array(
				'label' => __( 'Text Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[headings_color]', array(
				'label' => __( 'Headings Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[base_border_color]', array(
				'label' => __( 'Base Border Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[dotted_border_color]', array(
				'label' => __( 'Dotted Border Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[base_box_bg]', array(
				'label' => __( 'Box Background Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[header_top_bg]', array(
				'label' => __( 'Header Top Background Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[header_top_text_color]', array(
				'label' => __( 'Header Top Text Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[header_top_link_hover_color]', array(
				'label' => __( 'Header Top Link Hover Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[header_bg]', array(
				'label' => __( 'Header Background Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[menu_link_color]', array(
				'label' => __( 'Menu Link Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[menu_link_hover_color]', array(
				'label' => __( 'Menu Link Hover Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[menu_submenu_bg]', array(
				'label' => __( 'Menu Submenu Background Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[menu_submenu_link_color]', array(
				'label' => __( 'Menu Submenu Link Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[menu_submenu_link_hover_color]', array(
				'label' => __( 'Menu Submenu Link Hover Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[footer_bg]', array(
				'label' => __( 'Footer Background Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[footer_text_color]', array(
				'label' => __( 'Footer Text Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[footer_link_color]', array(
				'label' => __( 'Footer Link Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[footer_link_hover_color]', array(
				'label' => __( 'Footer Link Hover Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[footer_bottom_bg]', array(
				'label' => __( 'Footer Bottom Background Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[widget_box_bg]', array(
				'label' => __( 'Widget Box Background Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[widget_title_color]', array(
				'label' => __( 'Widget Title Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[widget_title_border_color]', array(
				'label' => __( 'Widget Title Border Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[widget_border_color]', array(
				'label' => __( 'Widget Border Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[widget_footer_title_color]', array(
				'label' => __( 'Footer Widget Title Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[widget_footer_title_border_color]', array(
				'label' => __( 'Footer Widget Title Border Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $prefix . '[widget_footer_border_color]', array(
				'label' => __( 'Footer Widget Border Color', 'shiroi' ), 
				'section' => 'colors', 
				'priority' => ++$priority
			)
		));
	}

	public function typography_customizer( $wp_customize ) {

		$prefix = $this->prefix();

		/* Section: Typography */

		$wp_customize->add_section( $prefix . '_typography', array(
			'title' => __( 'Typography', 'shiroi' ), 
			'priority' => 41
		));

		/* Typography Settings */

		$wp_customize->add_setting( $prefix . '[headings_font]', array(
			'default' => ''
		));
		$wp_customize->add_setting( $prefix . '[body_font]', array(
			'default' => ''
		));
		$wp_customize->add_setting( $prefix . '[blockquote_font]', array(
			'default' => ''
		));
		$wp_customize->add_setting( $prefix . '[menu_font]', array(
			'default' => ''
		));
		$wp_customize->add_setting( $prefix . '[post_meta_font]', array(
			'default' => ''
		));
		$wp_customize->add_setting( $prefix . '[post_label_font]', array(
			'default' => ''
		));
		$wp_customize->add_setting( $prefix . '[slider_title_font]', array(
			'default' => ''
		));
		$wp_customize->add_setting( $prefix . '[slider_meta_font]', array(
			'default' => ''
		));
		$wp_customize->add_setting( $prefix . '[slider_read_more_font]', array(
			'default' => ''
		));


		/* Typography Controls */

		$priority = 0;

		$wp_customize->add_control( new Youxi_Customize_WebFont_Control(
			$wp_customize, $prefix . '[headings_font]', array(
				'label' => __( 'Headings Font', 'shiroi' ), 
				'section' => $prefix . '_typography', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_WebFont_Control(
			$wp_customize, $prefix . '[body_font]', array(
				'label' => __( 'Body Font', 'shiroi' ), 
				'section' => $prefix . '_typography', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_WebFont_Control(
			$wp_customize, $prefix . '[blockquote_font]', array(
				'label' => __( 'Blockquote Font', 'shiroi' ), 
				'section' => $prefix . '_typography', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_WebFont_Control(
			$wp_customize, $prefix . '[menu_font]', array(
				'label' => __( 'Menu Font', 'shiroi' ), 
				'section' => $prefix . '_typography', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_WebFont_Control(
			$wp_customize, $prefix . '[post_meta_font]', array(
				'label' => __( 'Post Meta Font', 'shiroi' ), 
				'section' => $prefix . '_typography', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_WebFont_Control(
			$wp_customize, $prefix . '[post_label_font]', array(
				'label' => __( 'Post Label Font', 'shiroi' ), 
				'section' => $prefix . '_typography', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_WebFont_Control(
			$wp_customize, $prefix . '[slider_title_font]', array(
				'label' => __( 'Slider Title Font', 'shiroi' ), 
				'section' => $prefix . '_typography', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_WebFont_Control(
			$wp_customize, $prefix . '[slider_meta_font]', array(
				'label' => __( 'Slider Meta Font', 'shiroi' ), 
				'section' => $prefix . '_typography', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_WebFont_Control(
			$wp_customize, $prefix . '[slider_read_more_font]', array(
				'label' => __( 'Slider Read More Font', 'shiroi' ), 
				'section' => $prefix . '_typography', 
				'priority' => ++$priority
			)
		));
	}

	public function header_customizer( $wp_customize ) {

		$prefix = $this->prefix();

		/* Panel: Branding */

		if( method_exists( $wp_customize, 'add_panel' ) ) {
			$section_priority = 0;
			$section_title_prefix = '';
			$wp_customize->add_panel( $prefix . '_header', array(
				'title' => __( 'Header', 'shiroi' ), 
				'priority' => 41
			));
		} else {
			$section_priority = 41;
			$section_title_prefix = __( 'Header', 'shiroi' ) . ' ';
		}

		/* Section: Top Bar */

		$wp_customize->add_section( $prefix . '_header_top_bar', array(
			'title' => $section_title_prefix . __( 'Top Bar', 'shiroi' ), 
			'priority' => ++$section_priority, 
			'panel' => $prefix . '_header'
		));

		/* Top Bar Settings */

		$wp_customize->add_setting( $prefix . '[show_top_bar]', array(
			'default' => true
		));
		$wp_customize->add_setting( $prefix . '[top_bar_menu_fallback]', array(
			'default' => __( 'Welcome to my blog, a place where I write about stuffs.', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));

		/* Top Bar Controls */

		$priority = 0;

		$wp_customize->add_control( new Youxi_Customize_Switch_Control(
			$wp_customize, $prefix . '[show_top_bar]', array(
				'label' => __( 'Show Top Bar', 'shiroi' ), 
				'section' => $prefix . '_header_top_bar', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( $prefix . '[top_bar_menu_fallback]', array(
			'label' => __( 'Menu Fallback Text', 'shiroi' ), 
			'description' => __( 'This is the replacement text to be displayed if there is no menu assigned to the top bar.', 'shiroi' ), 
			'section' => $prefix . '_header_top_bar', 
			'type' => 'text', 
			'priority' => ++$priority
		));

		/* Section: Branding */

		$wp_customize->add_section( $prefix . '_header_branding', array(
			'title' => $section_title_prefix . __( 'Branding', 'shiroi' ), 
			'priority' => ++$section_priority, 
			'panel' => $prefix . '_header'
		));

		/* Branding Settings */

		$wp_customize->add_setting( $prefix . '[logo_image]', array(
			'default' => ''
		));
		$wp_customize->add_setting( $prefix . '[logo_top_padding]', array(
			'default' => 35, 
			'sanitize_callback' => 'absint'
		));
		$wp_customize->add_setting( $prefix . '[logo_bottom_padding]', array(
			'default' => 35, 
			'sanitize_callback' => 'absint'
		));
		$wp_customize->add_setting( $prefix . '[logo_max_width]', array(
			'default' => 200, 
			'sanitize_callback' => 'absint'
		));
		$wp_customize->add_setting( $prefix . '[logo_max_height]', array(
			'default' => 0, 
			'sanitize_callback' => 'absint'
		));

		/* Branding Controls */

		$priority = 0;

		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize, $prefix . '[logo_image]', array(
				'label' => __( 'Logo Image', 'shiroi' ), 
				'section' => $prefix . '_header_branding', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_Range_Control(
			$wp_customize, $prefix . '[logo_top_padding]', array(
				'label' => __( 'Logo Top Padding', 'shiroi' ), 
				'section' => $prefix . '_header_branding', 
				'min' => 0, 
				'max' => 100, 
				'step' => 1, 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_Range_Control(
			$wp_customize, $prefix . '[logo_bottom_padding]', array(
				'label' => __( 'Logo Bottom Padding', 'shiroi' ), 
				'section' => $prefix . '_header_branding', 
				'min' => 0, 
				'max' => 100, 
				'step' => 1, 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_Range_Control(
			$wp_customize, $prefix . '[logo_max_width]', array(
				'label' => __( 'Logo Max Width', 'shiroi' ), 
				'section' => $prefix . '_header_branding', 
				'min' => 50, 
				'max' => 1140, 
				'step' => 1, 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_Range_Control(
			$wp_customize, $prefix . '[logo_max_height]', array(
				'label' => __( 'Logo Max Height', 'shiroi' ), 
				'section' => $prefix . '_header_branding', 
				'min' => 0, 
				'max' => 400, 
				'step' => 1, 
				'priority' => ++$priority
			)
		));

		/* Section: Responsive */

		$wp_customize->add_section( $prefix . '_header_responsive', array(
			'title' => $section_title_prefix . __( 'Responsive', 'shiroi' ), 
			'priority' => ++$section_priority, 
			'panel' => $prefix . '_header'
		));

		/* Responsive Settings */

		$wp_customize->add_setting( $prefix . '[responsive_breakpoint]', array(
			'default' => 992
		));

		/* Responsive Controls */

		$wp_customize->add_control( $prefix . '[responsive_breakpoint]', array(
			'label' => __( 'Responsive Breakpoint', 'shiroi' ), 
			'section' => $prefix . '_header_responsive', 
			'type' => 'select', 
			'choices' => array(
				768 => __( '768px &ndash; Tablet', 'shiroi' ), 
				992 => __( '992px &ndash; Desktop', 'shiroi' )
			), 
			'priority' => 1
		));
	}

	public function footer_customizer( $wp_customize ) {

		$prefix = $this->prefix();

		/* Section: Footer */

		$wp_customize->add_section( $prefix . '_footer', array(
			'title' => __( 'Footer', 'shiroi' ), 
			'priority' => 42
		));

		/* Footer Settings */

		$wp_customize->add_setting( $prefix . '[footer_copyright_text]', array(
			'default' => __( '&copy; 2012-2014. Youxi Themes. All Rights Reserved.', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_setting( $prefix . '[footer_widget_areas]', array(
			'default' => 4, 
			'sanitize_callback' => 'absint'
		));

		/* Footer Controls */

		$priority = 0;

		$wp_customize->add_control( $prefix . '[footer_copyright_text]', array(
			'label' => __( 'Copyright Text', 'shiroi' ), 
			'section' => $prefix . '_footer', 
			'type' => 'text', 
			'priority' => ++$priority
		));
		$wp_customize->add_control( new Youxi_Customize_Range_Control(
			$wp_customize, $prefix . '[footer_widget_areas]', array(
				'label' => __( 'Widget Areas', 'shiroi' ), 
				'section' => $prefix . '_footer', 
				'min' => 1, 
				'max' => 4, 
				'step' => 1, 
				'priority' => ++$priority
			)
		));
	}

	public function featured_slider_customizer( $wp_customize ) {

		$prefix = $this->prefix();

		/* Section: Entries */

		$wp_customize->add_section( $prefix . '_featured_slider', array(
			'title' => __( 'Featured Slider', 'shiroi' ), 
			'priority' => 42.5
		));

		/* Entries Settings */

		$wp_customize->add_setting( $prefix . '[featured_slider_enabled]', array(
			'default' => true
		));
		$wp_customize->add_setting( $prefix . '[featured_slider_overlap]', array(
			'default' => true
		));
		$wp_customize->add_setting( $prefix . '[featured_slider_animate_text]', array(
			'default' => true
		));
		$wp_customize->add_setting( $prefix . '[featured_slider_meta]', array(
			'default' => 'category'
		));
		$wp_customize->add_setting( $prefix . '[featured_slider_transition]', array(
			'default' => 'slide'
		));
		$wp_customize->add_setting( $prefix . '[featured_slider_transition_duration]', array(
			'default' => 300, 
			'sanitize_callback' => 'absint'
		));
		$wp_customize->add_setting( $prefix . '[featured_slider_autoplay_timeout]', array(
			'default' => 0, 
			'sanitize_callback' => 'absint'
		));
		$wp_customize->add_setting( $prefix . '[featured_slider_limit]', array(
			'default' => 0, 
			'sanitize_callback' => 'absint'
		));		
		$wp_customize->add_setting( $prefix . '[featured_slider_orderby]', array(
			'default' => 'date'
		));
		$wp_customize->add_setting( $prefix . '[featured_slider_order]', array(
			'default' => 'DESC'
		));

		/* Entries Controls */

		$priority = 0;

		$wp_customize->add_control( new Youxi_Customize_Switch_Control(
			$wp_customize, $prefix . '[featured_slider_enabled]', array(
				'label' => __( 'Enabled', 'shiroi' ), 
				'section' => $prefix . '_featured_slider', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_Switch_Control(
			$wp_customize, $prefix . '[featured_slider_overlap]', array(
				'label' => __( 'Overlap First Post on the Slider', 'shiroi' ), 
				'section' => $prefix . '_featured_slider', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_Switch_Control(
			$wp_customize, $prefix . '[featured_slider_animate_text]', array(
				'label' => __( 'Animate Text', 'shiroi' ), 
				'section' => $prefix . '_featured_slider', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( $prefix . '[featured_slider_meta]', array(
			'label' => __( 'Post Meta', 'shiroi' ), 
			'section' => $prefix . '_featured_slider', 
			'type' => 'select', 
			'choices' => array(
				'none'     => __( 'None', 'shiroi' ), 
				'date'     => __( 'Date', 'shiroi' ), 
				'author'   => __( 'Author', 'shiroi' ), 
				'category' => __( 'Category', 'shiroi' ), 
				'tags'     => __( 'Tags', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[featured_slider_transition]', array(
			'label' => __( 'Transition', 'shiroi' ), 
			'section' => $prefix . '_featured_slider', 
			'type' => 'select', 
			'choices' => array(
				'slide' => __( 'Slide', 'shiroi' ), 
				'crossfade' => __( 'Cross Fade', 'shiroi' ), 
				'dissolve' => __( 'Dissolve', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( new Youxi_Customize_Range_Control(
			$wp_customize, $prefix . '[featured_slider_transition_duration]', array(
				'label' => __( 'Transition Duration', 'shiroi' ), 
				'section' => $prefix . '_featured_slider', 
				'min' => 100, 
				'max' => 2000, 
				'step' => 10, 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_Range_Control(
			$wp_customize, $prefix . '[featured_slider_autoplay_timeout]', array(
				'label' => __( 'Autoplay Timeout (0 to disable autoplay)', 'shiroi' ), 
				'section' => $prefix . '_featured_slider', 
				'min' => 0, 
				'max' => 15000, 
				'step' => 100, 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_Range_Control(
			$wp_customize, $prefix . '[featured_slider_limit]', array(
				'label' => __( 'Limit Posts (0 for unlimited)', 'shiroi' ), 
				'section' => $prefix . '_featured_slider', 
				'min' => 0, 
				'max' => 20, 
				'step' => 1, 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( $prefix . '[featured_slider_orderby]', array(
			'label' => __( 'Order By', 'shiroi' ), 
			'section' => $prefix . '_featured_slider', 
			'type' => 'select', 
			'choices' => array(
				'date' => __( 'Date', 'shiroi' ), 
				'comment_count' => __( 'Number of Comments', 'shiroi' ), 
				'title' => __( 'Post Title', 'shiroi' ), 
				'author' => __( 'Post Author', 'shiroi' ), 
				'modified' => __( 'Last Modified', 'shiroi' ), 
				'rand' => __( 'Random', 'shiroi' ), 
				'ID' => __( 'Post ID', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[featured_slider_order]', array(
			'label' => __( 'Order', 'shiroi' ), 
			'section' => $prefix . '_featured_slider', 
			'type' => 'select', 
			'choices' => array(
				'ASC' => __( 'Ascending', 'shiroi' ), 
				'DESC' => __( 'Descending', 'shiroi' )
			), 
			'priority' => ++$priority
		));
	}

	public function blog_customizer( $wp_customize ) {

		$prefix = $this->prefix();

		/* Panel: Blog */

		if( method_exists( $wp_customize, 'add_panel' ) ) {
			$section_priority = 0;
			$section_title_prefix = '';
			$wp_customize->add_panel( $prefix . '_blog', array(
				'title' => __( 'Blog', 'shiroi' ), 
				'priority' => 43
			));
		} else {
			$section_priority = 43;
			$section_title_prefix = __( 'Blog', 'shiroi' ) . ' ';
		}

		/* Section: General */

		$wp_customize->add_section( $prefix . '_blog_general', array(
			'title' => $section_title_prefix . __( 'General', 'shiroi' ), 
			'priority' => ++$section_priority, 
			'panel' => $prefix . '_blog'
		));

		/* General Settings */

		$wp_customize->add_setting( $prefix . '[blog_above_title_meta]', array(
			'default' => 'date'
		));
		$wp_customize->add_setting( $prefix . '[blog_below_title_meta]', array(
			'default' => array( 'author', 'category', 'comments' )
		));
		$wp_customize->add_setting( $prefix . '[blog_header_alignment]', array(
			'default' => 'center'
		));
		$wp_customize->add_setting( $prefix . '[blog_summary]', array(
			'default' => 'the_excerpt'
		));
		$wp_customize->add_setting( $prefix . '[blog_excerpt_length]', array(
			'default' => 100, 
			'sanitize_callback' => 'absint'
		));

		/* General Controls */

		$priority = 0;

		$wp_customize->add_control( $prefix . '[blog_above_title_meta]', array(
			'label' => __( 'Post Meta: Above Title', 'shiroi' ), 
			'section' => $prefix . '_blog_general', 
			'type' => 'select', 
			'choices' => array(
				'none' => __( 'None', 'shiroi' ), 
				'date' => __( 'Date', 'shiroi' ), 
				'category' => __( 'Category', 'shiroi' ), 
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( new Youxi_Customize_Multicheck_Control(
			$wp_customize, $prefix . '[blog_below_title_meta]', array(
				'label' => __( 'Post Meta: Below Title', 'shiroi' ), 
				'section' => $prefix . '_blog_general', 
				'choices' => array(
					'author' => __( 'Author', 'shiroi' ), 
					'date' => __( 'Date', 'shiroi' ), 
					'category' => __( 'Category', 'shiroi' ), 
					'comments' => __( 'Comments', 'shiroi' )
				), 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( $prefix . '[blog_header_alignment]', array(
			'label' => __( 'Header Alignment', 'shiroi' ), 
			'section' => $prefix . '_blog_general', 
			'type' => 'select', 
			'choices' => array(
				'left' => __( 'Left', 'shiroi' ), 
				'center' => __( 'Center', 'shiroi' ), 
				'right' => __( 'Right', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_summary]', array(
			'label' => __( 'Summary Display', 'shiroi' ), 
			'section' => $prefix . '_blog_general', 
			'type' => 'radio', 
			'choices' => array(
				'the_excerpt' => __( 'Excerpt', 'shiroi' ), 
				'the_content' => __( 'More Tag', 'shiroi' ), 
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( new Youxi_Customize_Range_Control(
			$wp_customize, $prefix . '[blog_excerpt_length]', array(
				'label' => __( 'Excerpt Length', 'shiroi' ), 
				'section' => $prefix . '_blog_general', 
				'min' => 55, 
				'max' => 250, 
				'step' => 1, 
				'priority' => ++$priority
			)
		));

		/* Section: Media */

		$wp_customize->add_section( $prefix . '_blog_media', array(
			'title' => $section_title_prefix . __( 'Media', 'shiroi' ), 
			'priority' => ++$section_priority, 
			'panel' => $prefix . '_blog'
		));

		/* Media Settings */

		$wp_customize->add_setting( $prefix . '[blog_media_position]', array(
			'default' => 'below_header'
		));
		$wp_customize->add_setting( $prefix . '[blog_grid_media_position]', array(
			'default' => 'above_header'
		));
		$wp_customize->add_setting( $prefix . '[blog_featured_image_behavior]', array(
			'default' => 'img'
		));
		$wp_customize->add_setting( $prefix . '[blog_featured_image_display]', array(
			'default' => 'always'
		));


		/* Media Controls */

		$priority = 0;

		$wp_customize->add_control( $prefix . '[blog_media_position]', array(
			'label' => __( 'Position on Default Layout', 'shiroi' ), 
			'section' => $prefix . '_blog_media', 
			'type' => 'radio', 
			'choices' => array(
				'above_header' => __( 'Above Header', 'shiroi' ), 
				'below_header' => __( 'Below Header', 'shiroi' ), 
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_grid_media_position]', array(
			'label' => __( 'Position on Grid/Masonry Layout', 'shiroi' ), 
			'section' => $prefix . '_blog_media', 
			'type' => 'radio', 
			'choices' => array(
				'above_header' => __( 'Above Header', 'shiroi' ), 
				'below_header' => __( 'Below Header', 'shiroi' ), 
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_featured_image_behavior]', array(
			'label' => __( 'Featured Image Behavior', 'shiroi' ), 
			'section' => $prefix . '_blog_media', 
			'type' => 'select', 
			'choices' => array(
				'none' => __( 'None', 'shiroi' ), 
				'post' => __( 'Go to Post', 'shiroi' ), 
				'img'  => __( 'Enlarge Image', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_featured_image_display]', array(
			'label' => __( 'Featured Image Display', 'shiroi' ), 
			'section' => $prefix . '_blog_media', 
			'type' => 'select', 
			'choices' => array(
				'always' => __( 'Always Visible', 'shiroi' ), 
				'single' => __( 'Visible on Single Entries', 'shiroi' ), 
				'archive'  => __( 'Visible on Index/Archive', 'shiroi' )
			), 
			'priority' => ++$priority
		));

		/* Section: Entries */

		$wp_customize->add_section( $prefix . '_blog_entries', array(
			'title' => $section_title_prefix . __( 'Single Entries', 'shiroi' ), 
			'priority' => ++$section_priority, 
			'panel' => $prefix . '_blog'
		));

		/* Entries Settings */

		$wp_customize->add_setting( $prefix . '[blog_show_tags]', array(
			'default' => true
		));
		$wp_customize->add_setting( $prefix . '[blog_sections]', array(
			'default' => array( 'values' => array( 'sharing', 'author', 'adjacent', 'related', 'comments' ) )
		));
		$wp_customize->add_setting( $prefix . '[blog_related_posts_count]', array(
			'default' => 3, 
			'sanitize_callback' => 'absint'
		));

		/* Entries Controls */

		$priority = 0;

		$wp_customize->add_control( new Youxi_Customize_Switch_Control(
			$wp_customize, $prefix . '[blog_show_tags]', array(
				'label' => __( 'Show Tags', 'shiroi' ), 
				'section' => $prefix . '_blog_entries', 
				'priority' => ++$priority
			)
		));
		$wp_customize->add_control( new Youxi_Customize_Sortable_Control(
			$wp_customize, $prefix . '[blog_sections]', array(
				'label' => __( 'Footer Sections', 'shiroi' ), 
				'section' => $prefix . '_blog_entries', 
				'priority' => ++$priority, 
				'togglable' => true, 
				'choices' => array(
					'sharing' => __( 'Sharing', 'shiroi' ), 
					'author' => __( 'Author', 'shiroi' ), 
					'adjacent' => __( 'Adjacent Posts', 'shiroi' ), 
					'related' => __( 'Related', 'shiroi' ), 
					'comments' => __( 'Comments', 'shiroi' )
				)
			)
		));
		$wp_customize->add_control( new Youxi_Customize_Range_Control(
			$wp_customize, $prefix . '[blog_related_posts_count]', array(
				'label' => __( 'Related Posts Count', 'shiroi' ), 
				'section' => $prefix . '_blog_entries', 
				'min' => 2, 
				'max' => 4, 
				'step' => 1, 
				'priority' => ++$priority
			)
		));

		/* Section: Layout */

		$wp_customize->add_section( $prefix . '_blog_layout', array(
			'title' => $section_title_prefix . __( 'Layout', 'shiroi' ), 
			'priority' => ++$section_priority, 
			'panel' => $prefix . '_blog'
		));

		/* Layout Settings */

		$wp_customize->add_setting( $prefix . '[blog_index_layout]', array(
			'default' => 'right_sidebar'
		));
		$wp_customize->add_setting( $prefix . '[blog_index_sidebar]', array(
			'default' => 'default-sidebar'
		));
		$wp_customize->add_setting( $prefix . '[blog_index_layout_mode]', array(
			'default' => 'default'
		));
		$wp_customize->add_setting( $prefix . '[blog_archive_layout]', array(
			'default' => 'right_sidebar'
		));
		$wp_customize->add_setting( $prefix . '[blog_archive_sidebar]', array(
			'default' => 'default-sidebar'
		));
		$wp_customize->add_setting( $prefix . '[blog_archive_layout_mode]', array(
			'default' => 'default'
		));
		$wp_customize->add_setting( $prefix . '[blog_single_layout]', array(
			'default' => 'right_sidebar'
		));
		$wp_customize->add_setting( $prefix . '[blog_single_sidebar]', array(
			'default' => 'default-sidebar'
		));
		$wp_customize->add_setting( $prefix . '[blog_search_layout]', array(
			'default' => 'fullwidth'
		));
		$wp_customize->add_setting( $prefix . '[blog_search_sidebar]', array(
			'default' => ''
		));
		$wp_customize->add_setting( $prefix . '[blog_pagination]', array(
			'default' => 'pager'
		));

		/* Layout Controls */

		$priority = 0;

		$wp_customize->add_control( $prefix . '[blog_index_layout]', array(
			'label' => __( 'Index Layout', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => array(
				'fullwidth' => __( 'Fullwidth', 'shiroi' ), 
				'left_sidebar' => __( 'Left Sidebar', 'shiroi' ), 
				'right_sidebar' => __( 'Right Sidebar', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_index_sidebar]', array(
			'label' => __( 'Index Sidebar', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => shiroi_sidebar_choices(), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_index_layout_mode]', array(
			'label' => __( 'Index Layout Mode', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => array(
				'default' => __( 'Default', 'shiroi' ), 
				'grid' => __( 'Grid', 'shiroi' ), 
				'masonry' => __( 'Masonry', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_archive_layout]', array(
			'label' => __( 'Archive Layout', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => array(
				'fullwidth' => __( 'Fullwidth', 'shiroi' ), 
				'left_sidebar' => __( 'Left Sidebar', 'shiroi' ), 
				'right_sidebar' => __( 'Right Sidebar', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_archive_sidebar]', array(
			'label' => __( 'Archive Sidebar', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => shiroi_sidebar_choices(), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_archive_layout_mode]', array(
			'label' => __( 'Archive Layout Mode', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => array(
				'default' => __( 'Default', 'shiroi' ), 
				'grid' => __( 'Grid', 'shiroi' ), 
				'masonry' => __( 'Masonry', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_single_layout]', array(
			'label' => __( 'Single Layout', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => array(
				'fullwidth' => __( 'Fullwidth', 'shiroi' ), 
				'left_sidebar' => __( 'Left Sidebar', 'shiroi' ), 
				'right_sidebar' => __( 'Right Sidebar', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_single_sidebar]', array(
			'label' => __( 'Single Sidebar', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => shiroi_sidebar_choices(), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_search_layout]', array(
			'label' => __( 'Search Layout', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => array(
				'fullwidth' => __( 'Fullwidth', 'shiroi' ), 
				'left_sidebar' => __( 'Left Sidebar', 'shiroi' ), 
				'right_sidebar' => __( 'Right Sidebar', 'shiroi' )
			), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_search_sidebar]', array(
			'label' => __( 'Search Sidebar', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => shiroi_sidebar_choices(), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_pagination]', array(
			'label' => __( 'Pagination Type', 'shiroi' ), 
			'section' => $prefix . '_blog_layout', 
			'type' => 'select', 
			'choices' => array(
				'pager' => __( 'Prev/Next', 'shiroi' ), 
				'numbered' => __( 'Numbered', 'shiroi' )
			), 
			'priority' => ++$priority
		));


		/* Section: Titles */

		$wp_customize->add_section( $prefix . '_blog_titles', array(
			'title' => $section_title_prefix . __( 'Titles', 'shiroi' ), 
			'priority' => ++$section_priority, 
			'panel' => $prefix . '_blog'
		));

		/* Titles Settings */

		$wp_customize->add_setting( $prefix . '[blog_category_title]', array(
			'default' => __( '{category}', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_setting( $prefix . '[blog_category_subtitle]', array(
			'default' => __( 'Browsing Category', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_setting( $prefix . '[blog_tag_title]', array(
			'default' => __( '&lsquo;{tag}&rsquo;', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_setting( $prefix . '[blog_tag_subtitle]', array(
			'default' => __( 'Posts Tagged', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_setting( $prefix . '[blog_author_title]', array(
			'default' => __( '{author}', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_setting( $prefix . '[blog_author_subtitle]', array(
			'default' => __( 'Posts Written By', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_setting( $prefix . '[blog_date_title]', array(
			'default' => __( '{date}', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_setting( $prefix . '[blog_date_subtitle]', array(
			'default' => __( 'Posts Written On', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_setting( $prefix . '[blog_search_title]', array(
			'default' => __( '&lsquo;{query}&rsquo;', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_setting( $prefix . '[blog_search_subtitle]', array(
			'default' => __( 'Search Results For', 'shiroi' ), 
			'sanitize_callback' => 'sanitize_text_field'
		));

		/* Titles Controls */

		$priority = 0;

		$wp_customize->add_control( $prefix . '[blog_category_title]', array(
			'label' => __( 'Category Archive', 'shiroi' ), 
			'section' => $prefix . '_blog_titles', 
			'type' => 'text', 
			'description' => __( 'Use <strong>{category}</strong> for the category name.', 'shiroi' ), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_category_subtitle]', array(
			'label' => __( 'Category Archive Subtitle', 'shiroi' ), 
			'section' => $prefix . '_blog_titles', 
			'type' => 'text', 
			'description' => __( 'Use <strong>{category}</strong> for the category name.', 'shiroi' ), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_tag_title]', array(
			'label' => __( 'Tag Archive', 'shiroi' ), 
			'section' => $prefix . '_blog_titles', 
			'type' => 'text', 
			'description' => __( 'Use <strong>{tag}</strong> for the tag name.', 'shiroi' ), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_tag_subtitle]', array(
			'label' => __( 'Tag Archive Subtitle', 'shiroi' ), 
			'section' => $prefix . '_blog_titles', 
			'type' => 'text', 
			'description' => __( 'Use <strong>{tag}</strong> for the tag name.', 'shiroi' ), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_author_title]', array(
			'label' => __( 'Author Archive', 'shiroi' ), 
			'section' => $prefix . '_blog_titles', 
			'type' => 'text', 
			'description' => __( 'Use <strong>{author}</strong> for the author name.', 'shiroi' ), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_author_subtitle]', array(
			'label' => __( 'Author Archive Subtitle', 'shiroi' ), 
			'section' => $prefix . '_blog_titles', 
			'type' => 'text', 
			'description' => __( 'Use <strong>{author}</strong> for the author name.', 'shiroi' ), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_date_title]', array(
			'label' => __( 'Date Archive', 'shiroi' ), 
			'section' => $prefix . '_blog_titles', 
			'type' => 'text', 
			'description' => __( 'Use <strong>{date}</strong> for the date.', 'shiroi' ), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_date_subtitle]', array(
			'label' => __( 'Date Archive Subtitle', 'shiroi' ), 
			'section' => $prefix . '_blog_titles', 
			'type' => 'text', 
			'description' => __( 'Use <strong>{date}</strong> for the date.', 'shiroi' ), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_search_title]', array(
			'label' => __( 'Blog Search', 'shiroi' ), 
			'section' => $prefix . '_blog_titles', 
			'type' => 'text', 
			'description' => __( 'Use <strong>{query}</strong> for the search query.', 'shiroi' ), 
			'priority' => ++$priority
		));
		$wp_customize->add_control( $prefix . '[blog_search_subtitle]', array(
			'label' => __( 'Blog Search Subtitle', 'shiroi' ), 
			'section' => $prefix . '_blog_titles', 
			'type' => 'text', 
			'description' => __( 'Use <strong>{query}</strong> for the search query.', 'shiroi' ), 
			'priority' => ++$priority
		));

		// foreach( $wp_customize->settings() as $setting ) {
		// 	if( preg_match( '/^shiroihana_settings\[/', $setting->id ) ) {
		// 		printf( "'%s' => '%s', \n", preg_replace( '/^shiroihana_settings\[|\]$/', '', $setting->id ), $setting->default );
		// 	}
		// }
	}
}
new Shiroi_Customizer();
