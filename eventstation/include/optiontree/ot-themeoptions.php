<?php
/**
 * Initialize the custom Theme Options.
 */
add_action( 'init', 'eventstation_custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function eventstation_custom_theme_options() {

	/* OptionTree is not loaded yet, or this is not an admin request */
	if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
	return false;

	/**
	* Get a copy of the saved settings array. 
	*/
	$saved_settings = get_option( ot_settings_id(), array() );

	/**
	* Custom settings array that will eventually be 
	* passes to the OptionTree Settings API Class.
	*/
	
	$custom_settings = array(
		'contextual_help' => array(
			'content' => array(
				array(
					'id' => 'option_types_help',
					'title' => esc_html__( 'Header Settings', 'eventstation' ),
					'content' => '<p>' . esc_html__( 'Help content goes here!', 'eventstation' ) . '</p>'
				)
			),
			'sidebar' => '<p>' . esc_html__( 'Sidebar content goes here!', 'eventstation' ) . '</p>'
		),
		
		'sections' => array(
			array(
				'title' => '<span class="dashicons dashicons-admin-site"></span>' . esc_html__( 'General', 'eventstation' ),
				'id' => 'general'
			),
			array(
				'title' => '<span class="dashicons dashicons-admin-appearance"></span>' . esc_html__( 'Colors', 'eventstation' ),
				'id' => 'colors'
			),
			array(
				'title' => '<span class="dashicons dashicons-editor-justify"></span>' . esc_html__( 'Typography', 'eventstation' ),
				'id' => 'fonts'
			),
			array(
				'title' => '<span class="dashicons dashicons-media-document"></span>' . esc_html__( 'Blog/Archive', 'eventstation' ),
				'id' => 'blog'
			),
			array(
				'title' => '<span class="dashicons dashicons-media-text"></span>' . esc_html__( 'Pages', 'eventstation' ),
				'id' => 'page'
			),
			array(
				'title' => '<span class="dashicons dashicons-share"></span>' . esc_html__( 'Social Media', 'eventstation' ),
				'id' => 'socialmedia'
			),
			array(
				'title' => '<span class="dashicons dashicons-cart"></span>' . esc_html__( 'WooCommerce', 'eventstation' ),
				'id' => 'woocommerce'
			),
			array(
				'title' => '<span class="dashicons dashicons-hammer"></span>' . esc_html__( 'Custom Codes', 'eventstation' ),
				'id' => 'customcodes'
			),
			array(
				'title' => '<span class="dashicons dashicons-star-filled"></span>' . esc_html__( 'Support', 'eventstation' ),
				'id' => 'support'
			),
		),

		'settings' => array(
			/*----- GENERAL TAB START -----*/
			array(
				'label' => esc_html__( 'General', 'eventstation' ),
				'id' => 'general_tab1',
				'type' => 'tab',
				'section' => 'general'
			),
				array(
					'label' => esc_html__( 'General Sidebar Position', 'eventstation' ),
					'id' => 'sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the general sidebar position.', 'eventstation' ),
					'std' => 'right',
					'section' => 'general'
				),
				array(
					'label' => esc_html__( 'Loader Status', 'eventstation' ),
					'id' => 'eventstation_loader',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can select the loader status.', 'eventstation' ),
					'std' => 'on',
					'section' => 'general'
				),
				array(
					'label' => esc_html__( 'Fixed Sidebar', 'eventstation' ),
					'id' => 'eventstation_fixed_sidebar',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can active/deactive the fixed sidebar .', 'eventstation' ),
					'std' => 'on',
					'section' => 'general'
				),
			array(
				'label' => esc_html__( 'Header', 'eventstation' ),
				'id' => 'general_tab2',
				'type' => 'tab',
				'section' => 'general'
			),
				array(
					'label' => esc_html__( 'Header Status', 'eventstation' ),
					'id' => 'hide_header',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the header.', 'eventstation' ),
					'std' => 'on',
					'section' => 'general'
				),
				array(
					'label' => esc_html__( 'General Header Style', 'eventstation' ),
					'id' => 'default_header_layout',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the general header style.', 'eventstation' ),
					'std' => 'default',
					'section' => 'general',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo Upload', 'eventstation' ),
					'id' => 'eventstation_logo',
					'type' => 'upload',
					'desc' => esc_html__( 'You can the upload your site logo. (Original Logo)', 'eventstation' ),
					'std' => '' . get_template_directory_uri() . '/assets/img/logo.png' . '',
					'section' => 'general',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Alternative Logo Upload', 'eventstation' ),
					'id' => 'eventstation_logo_alternative',
					'type' => 'upload',
					'desc' => esc_html__( 'You can the upload your site alternative logo. (White Logo)', 'eventstation' ),
					'std' => '' . get_template_directory_uri() . '/assets/img/logo-alternative.png' . '',
					'section' => 'general',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Header Fixed', 'eventstation' ),
					'id' => 'header_fixed',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can make the fixed header.', 'eventstation' ),
					'std' => 'on',
					'section' => 'general',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Header Search', 'eventstation' ),
					'id' => 'header_search',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the search from header.', 'eventstation' ),
					'std' => 'on',
					'section' => 'general',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo Height', 'eventstation' ),
					'id' => 'logo_height',
					'type' => 'measurement',
					'desc' => esc_html__( 'You can enter the logo height. Recommended type px.', 'eventstation' ),
					'section' => 'general',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo Weight', 'eventstation' ),
					'id' => 'logo_width',
					'type' => 'measurement',
					'desc' => esc_html__( 'You can enter the logo weight. Recommended type px.', 'eventstation' ),
					'section' => 'general',
					'condition' => 'hide_header:is(on)'
				),
			array(
				'label' => esc_html__( 'Footer', 'eventstation' ),
				'id' => 'general_tab3',
				'type' => 'tab',
				'section' => 'general'
			),
				array(
					'label' => esc_html__( 'Footer Status', 'eventstation' ),
					'id' => 'hide_footer',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the footer.', 'eventstation' ),
					'std' => 'on',
					'section' => 'general'
				),
				array(
					'label' => esc_html__( 'General Footer Style', 'eventstation' ),
					'id' => 'default_footer_layout',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the general footer style.', 'eventstation' ),
					'std' => 'default',
					'section' => 'general',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Footer Page - Default Style', 'eventstation' ),
					'id' => 'footer_page',
					'type' => 'page-select',
					'desc' => esc_html__( 'You can select the footer content page.', 'eventstation' ),
					'section' => 'general',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Footer Page - Alternative Style', 'eventstation' ),
					'id' => 'footer_page_alternative',
					'type' => 'page-select',
					'desc' => esc_html__( 'You can select the alternative style footer content page.', 'eventstation' ),
					'section' => 'general',
					'condition' => 'hide_footer:is(on)'
				),
			array(
				'label' => esc_html__( 'Sidebar', 'eventstation' ),
				'id' => 'general_tab4',
				'type' => 'tab',
				'section' => 'general'
			),
				array(
					'id' => 'custom_sidebars',
					'desc' => '',
					'label' => esc_html__('Create Sidebars','eventstation'),
					'type' => 'list-item',
					'section' => 'general',
					'settings' => array(
						array(
							'label' => esc_html__('ID','eventstation'),
							'id' => 'id',
							'type' => 'text',
							'desc' => esc_html__('Please write a lowercase id, with <strong>no spaces</strong>','eventstation'),
						)
					)
				),
			/*----- GENERAL TAB END -----*/
			
			/*----- COLORS TAB START -----*/
			array(
				'label' => esc_html__( 'General', 'eventstation' ),
				'id' => 'colors_tab1',
				'type' => 'tab',
				'section' => 'colors'
			),
				array(
					'label' => esc_html__( 'Body Background', 'eventstation' ),
					'id' => 'body_background',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the body background color of the site.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Wrapper Background', 'eventstation' ),
					'id' => 'wrapper_background',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the wrapper background color of the site.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Theme Color One', 'eventstation' ),
					'id' => 'theme_color_one',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the main color one of the site. By setting a color here, all of your elements will use this color instead of default open blue color.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Theme Color Two', 'eventstation' ),
					'id' => 'theme_color_two',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the main color two of the site. By setting a color here, all of your elements will use this color instead of default navy blue color.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Theme Color Three', 'eventstation' ),
					'id' => 'theme_color_three',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the main color three of the site. By setting a color here, all of your elements will use this color instead of dark blue color.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Theme Color Four', 'eventstation' ),
					'id' => 'theme_color_four',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the main color four of the site. By setting a color here, all of your elements will use this color instead of default orange color.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Link Color', 'eventstation' ),
					'id' => 'link_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the link color of the site.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Link Hover Color', 'eventstation' ),
					'id' => 'link_hover_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the link hover color of the site.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Heading Color', 'eventstation' ),
					'id' => 'heading_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the heading(h1, h2, h3, h4, h5 and h6) color of the site.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Input Border Color', 'eventstation' ),
					'id' => 'input_border_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the input border color of the site.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Input Background Color', 'eventstation' ),
					'id' => 'input_background_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the input background color of the site.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Button Background Color', 'eventstation' ),
					'id' => 'button_background_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the button background color of the site.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Button Hover Background Color', 'eventstation' ),
					'id' => 'button_hover_background_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the button hover background color of the site.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Button Hover Text Color', 'eventstation' ),
					'id' => 'button_hover_text_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the button hover text color of the site.', 'eventstation' ),
					'section' => 'colors'
				),
			array(
				'label' => esc_html__( 'Header', 'eventstation' ),
				'id' => 'colors_tab2',
				'type' => 'tab',
				'section' => 'colors'
			),
				array(
					'label' => esc_html__( 'Header Background - Default Style', 'eventstation' ),
					'id' => 'header_default_style_background',
					'type' => 'colorpicker-opacity',
					'desc' => esc_html__( 'This is the background color of the default header style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Menu Link Color - Default Style', 'eventstation' ),
					'id' => 'header_default_style_menu_link_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the menu link color of the default header style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Menu Link Hover Color - Default Style', 'eventstation' ),
					'id' => 'header_default_style_menu_link_hover_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the menu link hover color of the default header style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Submenu Link Color - Default Style', 'eventstation' ),
					'id' => 'header_default_style_submenu_link_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the submenu link color of the default header style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Submenu Link Hover Color - Default Style', 'eventstation' ),
					'id' => 'header_default_style_submenu_link_hover_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the submenu link hover color of the default header style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Submenu Background - Default Style', 'eventstation' ),
					'id' => 'header_default_style_submenu_background',
					'type' => 'colorpicker-opacity',
					'desc' => esc_html__( 'This is the submenu background color of the default header style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Background - Alternative Style', 'eventstation' ),
					'id' => 'header_alternative_style_background',
					'type' => 'colorpicker-opacity',
					'desc' => esc_html__( 'This is the background color of the header alternative style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Menu Link Color - Alternative Style', 'eventstation' ),
					'id' => 'header_alternative_style_menu_link_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the menu link color of the alternative header style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Menu Link Hover Color - Alternative Style', 'eventstation' ),
					'id' => 'header_alternative_style_menu_link_hover_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the menu link hover color of the alternative header style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Submenu Link Color - Alternative Style', 'eventstation' ),
					'id' => 'header_alternative_style_submenu_link_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the submenu link color of the alternative header style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Submenu Link Hover Color - Alternative Style', 'eventstation' ),
					'id' => 'header_alternative_style_submenu_link_hover_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the submenu link hover color of the alternative header style.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Header Submenu Background - Alternative Style', 'eventstation' ),
					'id' => 'header_alternative_style_submenu_background',
					'type' => 'colorpicker-opacity',
					'desc' => esc_html__( 'This is the submenu background color of the alternative header style.', 'eventstation' ),
					'section' => 'colors'
				),
			array(
				'label' => esc_html__( 'Mobile', 'eventstation' ),
				'id' => 'colors_tab3',
				'type' => 'tab',
				'section' => 'colors'
			),
				array(
					'label' => esc_html__( 'Mobile Header Background - Default Style', 'eventstation' ),
					'id' => 'mobile_menu_default_style_background',
					'type' => 'colorpicker-opacity',
					'desc' => esc_html__( 'This is the mobile menu background color of the default style header.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Mobile Header Background - Alternative Style', 'eventstation' ),
					'id' => 'mobile_menu_alternative_style_background',
					'type' => 'colorpicker-opacity',
					'desc' => esc_html__( 'This is the mobile menu background color of the alternative style header.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Mobile Header Menu Link Color', 'eventstation' ),
					'id' => 'header_default_mobile_menu_menu_link_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the mobile menu link color of the header.', 'eventstation' ),
					'section' => 'colors'
				),
				array(
					'label' => esc_html__( 'Mobile Header Menu Link Hover Color', 'eventstation' ),
					'id' => 'header_default_mobile_menu_menu_link_hover_color',
					'type' => 'colorpicker',
					'desc' => esc_html__( 'This is the mobile menu link hover color of the header.', 'eventstation' ),
					'section' => 'colors'
				),
			/*----- COLORS TAB END -----*/
			
			/*----- TYPOGRAPHY TAB START -----*/
			array(
				'label' => esc_html__( 'General', 'eventstation' ),
				'id' => 'fonts_tab1',
				'type' => 'tab',
				'section' => 'fonts'
			),
				array(
					'label' => esc_html__('Extra Character Sets','eventstation'),
					'id' => 'fonts_languages',
					'type' => 'radio',
					'desc' => esc_html__('You can choose the language character sets. Default: Latin and Latin Extended.','eventstation'),
					'section' => 'fonts',
					'choices' => array(
						array(
							'label' => esc_html__('None Select','eventstation'),
							'value' => 'none-select'
						),
						array(
							'label' => esc_html__('Cyrillic','eventstation'),
							'value' => 'cyrillic'
						),
						array(
							'label' => esc_html__('Greek','eventstation'),
							'value' => 'greek'
						),
						array(
							'label' => esc_html__('Vietnamese','eventstation'),
							'value' => 'vietnamese'
						),
					),
					'std' => 'none-select',
				),
				array(
					'label' => esc_html__( 'Theme One Font', 'eventstation' ),
					'id' => 'theme_one_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the theme one font.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Theme Two Font', 'eventstation' ),
					'id' => 'theme_two_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the theme two font.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Body', 'eventstation' ),
					'id' => 'body_text',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the body for font settings.', 'eventstation' ),
					'section' => 'fonts',
					'std' => '',
				),
				array(
					'label' => esc_html__( 'H1', 'eventstation' ),
					'id' => 'h1_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the h1 for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'H2', 'eventstation' ),
					'id' => 'h2_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the h2 for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'H3', 'eventstation' ),
					'id' => 'h3_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the h3 for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'H4', 'eventstation' ),
					'id' => 'h4_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the h4 for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'H5', 'eventstation' ),
					'id' => 'h5_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the h5 for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'H6', 'eventstation' ),
					'id' => 'h6_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the h6 for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Input Font', 'eventstation' ),
					'id' => 'input_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the input for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Input Placeholder Font', 'eventstation' ),
					'id' => 'input_placeholder_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the input placeholder for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Button Font', 'eventstation' ),
					'id' => 'button_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the button for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
			array(
				'label' => esc_html__( 'Header', 'eventstation' ),
				'id' => 'fonts_tab2',
				'type' => 'tab',
				'section' => 'fonts'
			),
				array(
					'label' => esc_html__( 'Header Menu Font - Default Style', 'eventstation' ),
					'id' => 'header_default_menu_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the header default style menu for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Header Submenu Font - Default Style', 'eventstation' ),
					'id' => 'header_default_submenu_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the header default style submenu for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Header Menu Font - Alternative Style', 'eventstation' ),
					'id' => 'header_alternative_menu_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the header alternative style menu for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Header Submenu Font - Default Style', 'eventstation' ),
					'id' => 'header_alternative_submenu_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the header alternative style submenu for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
			array(
				'label' => esc_html__( 'Blog', 'eventstation' ),
				'id' => 'fonts_tab3',
				'type' => 'tab',
				'section' => 'fonts'
			),
				array(
					'label' => esc_html__( 'Post Title Font', 'eventstation' ),
					'id' => 'blog_posts_title_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the post title for for font settings of the blog, single and all archive.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Post Title Hover Font', 'eventstation' ),
					'id' => 'blog_posts_title_hover_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the post title hover for for font settings of the blog, single and all archive.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Post Content Font', 'eventstation' ),
					'id' => 'blog_posts_content_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the post content for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Post Title Excerpt Font', 'eventstation' ),
					'id' => 'blog_page_title_excerpt_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the post title excerpt for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
			array(
				'label' => esc_html__( 'Single Post', 'eventstation' ),
				'id' => 'fonts_tab4',
				'type' => 'tab',
				'section' => 'fonts'
			),
				array(
					'label' => esc_html__( 'Post Title Font', 'eventstation' ),
					'id' => 'single_posts_title_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the post title for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Post Content Font', 'eventstation' ),
					'id' => 'single_posts_content_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the post content for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Post Title Excerpt Font', 'eventstation' ),
					'id' => 'single_page_title_excerpt_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the post title excerpt for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Post Bottom Element Title Font', 'eventstation' ),
					'id' => 'single_posts_bottom_element_title_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the post bottom element title for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
			array(
				'label' => esc_html__( 'Pages', 'eventstation' ),
				'id' => 'fonts_tab5',
				'type' => 'tab',
				'section' => 'fonts'
			),
				array(
					'label' => esc_html__( 'Page Title Font', 'eventstation' ),
					'id' => 'page_title_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the page title for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Page Title Excerpt Font', 'eventstation' ),
					'id' => 'page_title_excerpt_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the page title excerpt for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( 'Page Content Font', 'eventstation' ),
					'id' => 'page_content_font',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the page content for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
			array(
				'label' => esc_html__( '404 Page', 'eventstation' ),
				'id' => 'fonts_tab6',
				'type' => 'tab',
				'section' => 'fonts'
			),
				array(
					'label' => esc_html__( '404 Page Title', 'eventstation' ),
					'id' => '404_page_title',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the 404 page title for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( '404 Page Text', 'eventstation' ),
					'id' => '404_page_text',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the 404 page text for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
				array(
					'label' => esc_html__( '404 Page Icon', 'eventstation' ),
					'id' => '404_page_icon',
					'type' => 'typography',
					'desc' => esc_html__( 'You can select the 404 page icon for font settings.', 'eventstation' ),
					'section' => 'fonts'
				),
			/*----- TYPOGRAPHY TAB END -----*/
			
			/*----- BLOG TAB START -----*/
			array(
				'label' => esc_html__( 'Category', 'eventstation' ),
				'id' => 'blog_tab1',
				'type' => 'tab',
				'section' => 'blog'
			),
				array(
					'label' => esc_html__( 'Category Sidebar Position', 'eventstation' ),
					'id' => 'category_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the general sidebar position of category page.', 'eventstation' ),
					'std' => 'right',
					'section' => 'blog'
				),
				array(
					'id' => 'sidebar_select',
					'desc' => '',
					'label' => esc_html__('Sidebar For Categories','eventstation'),
					'type' => 'sidebar_select_category',
					'section' => 'blog',
				),
				array(
					'label' => esc_html__( 'Heading Navigation', 'eventstation' ),
					'id' => 'blog_heading_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the heading navigation of the category page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Excerpt', 'eventstation' ),
					'id' => 'blog_post_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post excerpt of the category page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Title Excerpt', 'eventstation' ),
					'id' => 'blog_post_title_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the title post excerpt of the category page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Category Name', 'eventstation' ),
					'id' => 'blog_post_category_name',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post category name of the category page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Information', 'eventstation' ),
					'id' => 'blog_post_information',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post information of the category page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Read More Button', 'eventstation' ),
					'id' => 'blog_post_read_more',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post read more button of the category page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Image', 'eventstation' ),
					'id' => 'blog_post_image',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post image of the category page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Share Buttons', 'eventstation' ),
					'id' => 'blog_post_share_buttons',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post share buttons of the category page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
			array(
				'label' => esc_html__( 'Post', 'eventstation' ),
				'id' => 'blog_tab2',
				'type' => 'tab',
				'section' => 'blog'
			),
				array(
					'label' => esc_html__( 'Post Sidebar Position', 'eventstation' ),
					'id' => 'single_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the general sidebar position of the post.', 'eventstation' ),
					'std' => 'right',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Single Sidebar Select', 'eventstation' ),
					'id' => 'single_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select the sidebar of the post.', 'eventstation' ),
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Heading Navigation', 'eventstation' ),
					'id' => 'single_heading_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the heading navigation of the post.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Title Excerpt', 'eventstation' ),
					'id' => 'single_post_title_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post title excerpt of the post.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Category Name', 'eventstation' ),
					'id' => 'single_post_category_name',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post category name of the post.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Information', 'eventstation' ),
					'id' => 'single_post_information',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post information of the post.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Image', 'eventstation' ),
					'id' => 'single_post_image',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post image of the post.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Share Buttons', 'eventstation' ),
					'id' => 'single_post_share_buttons',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post share buttons of the post.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Tags', 'eventstation' ),
					'id' => 'single_post_tags',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post tags of the post.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Navigation', 'eventstation' ),
					'id' => 'single_post_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the posts navigation of the post.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Comment Area', 'eventstation' ),
					'id' => 'single_post_comment_area',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the comment area of the post.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Related Posts', 'eventstation' ),
					'id' => 'single_post_related_posts',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the related posts of the post.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Related Posts - Post Count', 'eventstation' ),
					'id' => 'single_post_related_posts_post_count',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter the post count of the related posts.', 'eventstation' ),
					'std' => '3',
					'section' => 'blog',
					'condition' => 'single_post_related_posts:is(on)'
				),
			array(
				'label' => esc_html__( 'Tag', 'eventstation' ),
				'id' => 'blog_tab3',
				'type' => 'tab',
				'section' => 'blog'
			),
				array(
					'label' => esc_html__( 'Tag Sidebar Position', 'eventstation' ),
					'id' => 'tag_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the general sidebar position of the tag page.', 'eventstation' ),
					'std' => 'right',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Tag Sidebar Select', 'eventstation' ),
					'id' => 'tag_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select the sidebar of the tag page.', 'eventstation' ),
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Heading Navigation', 'eventstation' ),
					'id' => 'tag_heading_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the heading navigation of the tag page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Excerpt', 'eventstation' ),
					'id' => 'tag_post_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post excerpt of the tag page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Title Excerpt', 'eventstation' ),
					'id' => 'tag_post_title_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post title excerpt of the tag page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Category Name', 'eventstation' ),
					'id' => 'tag_post_category_name',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post category name of the tag page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Information', 'eventstation' ),
					'id' => 'tag_post_information',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post information of the tag page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Read More Button', 'eventstation' ),
					'id' => 'tag_post_read_more',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post read more button of the tag page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Image', 'eventstation' ),
					'id' => 'tag_post_image',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post image of the tag page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Share Buttons', 'eventstation' ),
					'id' => 'tag_post_share_buttons',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post share buttons of the tag page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
			array(
				'label' => esc_html__( 'Author', 'eventstation' ),
				'id' => 'blog_tab4',
				'type' => 'tab',
				'section' => 'blog'
			),
				array(
					'label' => esc_html__( 'Author Sidebar Position', 'eventstation' ),
					'id' => 'author_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the general sidebar position of the author page.', 'eventstation' ),
					'std' => 'right',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Author Sidebar Select', 'eventstation' ),
					'id' => 'author_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select the sidebar of the author page.', 'eventstation' ),
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Heading Navigation', 'eventstation' ),
					'id' => 'author_heading_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the heading navigation of the author page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Excerpt', 'eventstation' ),
					'id' => 'author_post_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post excerpt of the author page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Title Excerpt', 'eventstation' ),
					'id' => 'author_post_title_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post title excerpt of the author page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Category Name', 'eventstation' ),
					'id' => 'author_post_category_name',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post category name of the author page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Information', 'eventstation' ),
					'id' => 'author_post_information',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post information of the author page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Read More Button', 'eventstation' ),
					'id' => 'author_post_read_more',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post read more button of the author page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Image', 'eventstation' ),
					'id' => 'author_post_image',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post image of the author page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Share Buttons', 'eventstation' ),
					'id' => 'author_post_share_buttons',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post share buttons of the author page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
			array(
				'label' => esc_html__( 'Search', 'eventstation' ),
				'id' => 'blog_tab5',
				'type' => 'tab',
				'section' => 'blog'
			),
				array(
					'label' => esc_html__( 'Search Sidebar Position', 'eventstation' ),
					'id' => 'search_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the general sidebar position of the search page.', 'eventstation' ),
					'std' => 'right',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Search Sidebar Select', 'eventstation' ),
					'id' => 'search_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select the sidebar of the search page.', 'eventstation' ),
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Heading Navigation', 'eventstation' ),
					'id' => 'search_heading_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the heading navigation of the search page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Excerpt', 'eventstation' ),
					'id' => 'search_post_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post excerpt of the search page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Title Excerpt', 'eventstation' ),
					'id' => 'search_post_title_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post title excerpt of the search page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Category Name', 'eventstation' ),
					'id' => 'search_post_category_name',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post category name of the search page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Information', 'eventstation' ),
					'id' => 'search_post_information',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post information of the search page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Read More Button', 'eventstation' ),
					'id' => 'search_post_read_more',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post read more button of the search page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Image', 'eventstation' ),
					'id' => 'search_post_image',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post image of the search page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Share Buttons', 'eventstation' ),
					'id' => 'search_post_share_buttons',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post share buttons of the search page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
			array(
				'label' => esc_html__( 'Archive', 'eventstation' ),
				'id' => 'blog_tab6',
				'type' => 'tab',
				'section' => 'blog'
			),
				array(
					'label' => esc_html__( 'Archive Sidebar Position', 'eventstation' ),
					'id' => 'archive_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the general sidebar position of the archive page.', 'eventstation' ),
					'std' => 'right',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Archive Sidebar Select', 'eventstation' ),
					'id' => 'archive_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select the sidebar of the archive page.', 'eventstation' ),
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Heading Navigation', 'eventstation' ),
					'id' => 'archive_heading_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the heading navigation of the archive page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Excerpt', 'eventstation' ),
					'id' => 'archive_post_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post excerpt of the archive page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Title Excerpt', 'eventstation' ),
					'id' => 'archive_post_title_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post title excerpt of the archive page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Category Name', 'eventstation' ),
					'id' => 'archive_post_category_name',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post category name of the archive page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Information', 'eventstation' ),
					'id' => 'archive_post_information',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post information of the archive page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Read More Button', 'eventstation' ),
					'id' => 'archive_post_read_more',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post read more button of the archive page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Image', 'eventstation' ),
					'id' => 'archive_post_image',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post image of the archive page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Post Share Buttons', 'eventstation' ),
					'id' => 'archive_post_share_buttons',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the post share buttons of the archive page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
			array(
				'label' => esc_html__( 'Attachment', 'eventstation' ),
				'id' => 'blog_tab7',
				'type' => 'tab',
				'section' => 'blog'
			),
				array(
					'label' => esc_html__( 'Attachment Sidebar Position', 'eventstation' ),
					'id' => 'attachment_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the general sidebar position of the attachment page.', 'eventstation' ),
					'std' => 'nosidebar',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Attachment Sidebar Select', 'eventstation' ),
					'id' => 'attachment_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select the sidebar of the attachment page.', 'eventstation' ),
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Heading Navigation', 'eventstation' ),
					'id' => 'attachment_heading_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the heading navigation of the attachment page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Social Share Buttons', 'eventstation' ),
					'id' => 'attachment_social_share',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the social share buttons of the attachment page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
				array(
					'label' => esc_html__( 'Comment Area', 'eventstation' ),
					'id' => 'attachment_comment_area',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the comment area of the attachment page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'blog'
				),
			/*----- BLOG TAB END -----*/
			
			/*----- PAGES TAB START -----*/
			array(
				'label' => esc_html__( 'General', 'eventstation' ),
				'id' => 'page_tab1',
				'type' => 'tab',
				'section' => 'page'
			),
				array(
					'label' => esc_html__( 'Page Title', 'eventstation' ),
					'id' => 'page_title',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the page title of the page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'page'
				),
				array(
					'label' => esc_html__( 'Page Title Excerpt', 'eventstation' ),
					'id' => 'page_title_excerpt',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the page title excerpt of the page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'page'
				),
				array(
					'label' => esc_html__( 'Heading Navigation', 'eventstation' ),
					'id' => 'page_heading_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the heading navigation of the page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'page'
				),
				array(
					'label' => esc_html__( 'Comment Area', 'eventstation' ),
					'id' => 'page_comment_area',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the comment area of the page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'page'
				),
			array(
				'label' => esc_html__( '404 Page', 'eventstation' ),
				'id' => 'page_tab3',
				'type' => 'tab',
				'section' => 'page'
			),
				array(
					'label' => esc_html__( 'Heading Navigation', 'eventstation' ),
					'id' => '404_page_heading_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the heading navigation of the 404 page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'page'
				),
				array(
					'label' => esc_html__( 'Search Form', 'eventstation' ),
					'id' => '404_page_search_form',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the search form of the 404 page.', 'eventstation' ),
					'std' => 'on',
					'section' => 'page'
				),
			/*----- PAGES TAB END -----*/
			
			/*----- SOCIAL MEDIA TAB START -----*/
			array(
				'label' => esc_html__( 'Social Links', 'eventstation' ),
				'id' => 'socialmedia_tab1',
				'type' => 'tab',
				'section' => 'socialmedia'
			),
				array(
					'label' => esc_html__( 'Facebook URL', 'eventstation' ),
					'id' => 'social_media_facebook',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Facebook url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Twitter URL', 'eventstation' ),
					'id' => 'social_media_twitter',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Twitter url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Google+ URL', 'eventstation' ),
					'id' => 'social_media_googleplus',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Google+ url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Instagram URL', 'eventstation' ),
					'id' => 'social_media_instagram',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Instagram url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'LinkedIn URL', 'eventstation' ),
					'id' => 'social_media_linkedin',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the LinkedIn url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Vine URL', 'eventstation' ),
					'id' => 'social_media_vine',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Vine url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Pinterest URL', 'eventstation' ),
					'id' => 'social_media_pinterest',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Pinterest url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'YouTube URL', 'eventstation' ),
					'id' => 'social_media_youtube',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the YouTube url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Behance URL', 'eventstation' ),
					'id' => 'social_media_behance',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Behance url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'DeviantArt URL', 'eventstation' ),
					'id' => 'social_media_deviantart',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the DeviantArt url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Digg URL', 'eventstation' ),
					'id' => 'social_media_digg',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Digg url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Dribbble URL', 'eventstation' ),
					'id' => 'social_media_dribbble',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Dribbble url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Flickr URL', 'eventstation' ),
					'id' => 'social_media_flickr',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Flickr url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'GitHub URL', 'eventstation' ),
					'id' => 'social_media_github',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the GitHub url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Last.fm URL', 'eventstation' ),
					'id' => 'social_media_lastfm',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Last.fm url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Reddit URL', 'eventstation' ),
					'id' => 'social_media_reddit',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Reddit url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'SoundCloud URL', 'eventstation' ),
					'id' => 'social_media_soundcloud',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the SoundCloud url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Tumblr URL', 'eventstation' ),
					'id' => 'social_media_tumblr',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Tumblr url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Vimeo URL', 'eventstation' ),
					'id' => 'social_media_vimeo',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Vimeo url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'VK URL', 'eventstation' ),
					'id' => 'social_media_vk',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the VK url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Medium URL', 'eventstation' ),
					'id' => 'social_media_medium',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the Medium url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'RSS URL', 'eventstation' ),
					'id' => 'social_media_rss',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter the RSS url.', 'eventstation' ),
					'section' => 'socialmedia'
				),
			array(
				'label' => esc_html__( 'Social Share', 'eventstation' ),
				'id' => 'socialmedia_tab2',
				'type' => 'tab',
				'section' => 'socialmedia'
			),
				array(
					'label' => esc_html__( 'Facebook Share', 'eventstation' ),
					'id' => 'social_share_facebook',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the Facebook of the social share.', 'eventstation' ),
					'std' => 'on',
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Twitter Share', 'eventstation' ),
					'id' => 'social_share_twitter',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the Twitter of the social share.', 'eventstation' ),
					'std' => 'on',
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Google+ Share', 'eventstation' ),
					'id' => 'social_share_googleplus',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the Google+ of the social share.', 'eventstation' ),
					'std' => 'on',
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Linkedin Share', 'eventstation' ),
					'id' => 'social_share_linkedin',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the Linkedin of the social share.', 'eventstation' ),
					'std' => 'on',
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Pinterest Share', 'eventstation' ),
					'id' => 'social_share_pinterest',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the Pinterest of the social share.', 'eventstation' ),
					'std' => 'on',
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Reddit Share', 'eventstation' ),
					'id' => 'social_share_reddit',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the Reddit of the social share.', 'eventstation' ),
					'std' => 'on',
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Delicious Share', 'eventstation' ),
					'id' => 'social_share_delicious',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the Delicious of the social share.', 'eventstation' ),
					'std' => 'on',
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Stumbleupon Share', 'eventstation' ),
					'id' => 'social_share_stumbleupon',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the Stumbleupon of the social share.', 'eventstation' ),
					'std' => 'on',
					'section' => 'socialmedia'
				),
				array(
					'label' => esc_html__( 'Tumblr Share', 'eventstation' ),
					'id' => 'social_share_tumblr',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide the Tumblr of the social share.', 'eventstation' ),
					'std' => 'on',
					'section' => 'socialmedia'
				),
			/*----- SOCIAL MEDIA TAB END -----*/
			
			/*----- WOOCOMMERCE TAB START -----*/
			array(
				'label' => esc_html__( 'WooCommerce Sidebar Position - Shop Page', 'eventstation' ),
				'id' => 'woocommerce_sidebar_position',
				'type' => 'radio-image',
				'desc' => esc_html__( 'You can select the sidebar position of WooCommerce.', 'eventstation' ),
				'std' => 'right',
				'section' => 'woocommerce'
			),
			array(
				'label' => esc_html__( 'WooCommerce Sidebar Position - Single Product', 'eventstation' ),
				'id' => 'woocommerce_product_sidebar_position',
				'type' => 'radio-image',
				'desc' => esc_html__( 'You can select the sidebar position of WooCommerce single product.', 'eventstation' ),
				'std' => 'right',
				'section' => 'woocommerce'
			),
			array(
				'label' => esc_html__( 'WooCommerce Shop Product Column', 'eventstation' ),
				'id' => 'woocommerce_shop_product_column',
				'type' => 'numeric-slider',
				'desc' => esc_html__( 'You can enter the product column of WooCommerce shop page.', 'eventstation' ),
				'std' => '4',
				'min_max_step'=> '3,6,1',
				'section' => 'woocommerce'
			),
			array(
				'label' => esc_html__( 'WooCommerce Related Product Count', 'eventstation' ),
				'id' => 'woocommerce_related_product_count_column',
				'type' => 'numeric-slider',
				'desc' => esc_html__( 'You can enter the product count of related products.', 'eventstation' ),
				'std' => '4',
				'section' => 'woocommerce'
			),
			/*----- WOOCOMMERCE TAB END -----*/
			
			/*----- CUSTOM CODES TAB START -----*/
			array(
				'label' => esc_html__( 'Custom CSS Codes', 'eventstation' ),
				'id' => 'custom_css',
				'type' => 'css',
				'desc' => esc_html__( 'You can enter the custom CSS codes.', 'eventstation' ),
				'section' => 'customcodes'
			),
			array(
				'label' => esc_html__( 'Custom JavaScript Codes', 'eventstation' ),
				'id' => 'custom_js',
				'type' => 'javascript',
				'desc' => esc_html__( 'You can enter the custom JavaScript codes.', 'eventstation' ),
				'section' => 'customcodes'
			),
			/*----- CUSTOM CODES TAB END -----*/
			
			/*----- SUPPORT TAB START -----*/
			array(
				'label' => esc_html__( 'Support', 'eventstation' ),
				'id' => 'theme_support',
				'type' => 'text',
				'desc' => eventstation_support_tab_content(),
				'section' => 'support'
			)
			/*----- SUPPORT TAB END -----*/
		),
	);

	/* allow settings to be filtered before saving */
	$custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

	/* settings are not the same update the DB */
	if ( $saved_settings !== $custom_settings ) {
		update_option( ot_settings_id(), $custom_settings ); 
	}

	/* Lets OptionTree know the UI Builder is being overridden */
	global $ot_has_eventstation_custom_theme_options;
	$ot_has_eventstation_custom_theme_options = true;
}