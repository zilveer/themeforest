<?php
/**
 * Header Customizer Options
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.4.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Header styles
$header_styles = apply_filters( 'wpex_header_styles', array(
	'one'   => esc_html__( 'One - Left Logo & Right Navbar','total' ),
	'two'   => esc_html__( 'Two - Bottom Navbar','total' ),
	'three' => esc_html__( 'Three - Bottom Navbar Centered','total' ),
	'four'  => esc_html__( 'Four - Top Navbar Centered','total' ),
	'five'  => esc_html__( 'Five - Centered Inline Logo','total' ),
	'six'   => esc_html__( 'Six - Vertical','total' ),
) );

/*-----------------------------------------------------------------------------------*/
/* - Header => General
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_header_general'] = array(
	'title' => esc_html__( 'General', 'total' ),
	'panel' => 'wpex_header',
	'settings' => array(
		array(
			'id' => 'enable_header',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'full_width_header',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Full-Width', 'total' ),
				'type' => 'checkbox',
				'active_callback' => 'wpex_cac_hasnt_boxed_layout',
			),
		),
		array(
			'id' => 'header_style',
			'default' => 'one',
			'control' => array(
				'label' => esc_html__( 'Style', 'total' ),
				'type' => 'select',
				'choices' => $header_styles,
			),
		),
		array(
			'id' => 'vertical_header_style',
			'transport' => 'postMessage',
			'default' => 'one',
			'control' => array(
				'label' => esc_html__( 'Vertical Header Style', 'total' ),
				'type' => 'select',
				'choices' => array(
					'' => esc_html__( 'Default', 'total' ),
					'fixed' => esc_html__( 'Fixed', 'total' ),
				),
				'active_callback' => 'wpex_cac_has_vertical_header',
			),
		),
		array(
			'id' => 'header_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Background', 'total' ),
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'#site-header',
					'#site-header-sticky-wrapper.is-sticky #site-header',
					'.footer-has-reveal #site-header',
					'#searchform-header-replace',
					'body.wpex-has-vertical-header #site-header',
				),
				'alter' => 'background-color',
				'obj_condition' => 'has_header',
			),
		),
		array(
			'id' => 'header_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'total' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
			),
			'inline_css' => array(
				'target' => array(
					'#site-header-inner',
					'#site-header.overlay-header #site-header-inner',
				),
				'alter' => 'padding-top',
				'sanitize' => 'px',
				'obj_condition' => 'has_header',
			),
		),
		array(
			'id' => 'header_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'total' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
			),
			'inline_css' => array(
				'target' => array(
					'#site-header-inner',
					'#site-header.overlay-header #site-header-inner',
				),
				'alter' => 'padding-bottom',
				'sanitize' => 'px',
				'obj_condition' => 'has_header',
			),
		),
		/*** Aside ***/
		array(
			'id' => 'header_aside_heading',
			'control' => array(
				'type' => 'wpex-heading',
				'label' => esc_html__( 'Aside', 'total' ),
				'active_callback' => 'wpex_cac_header_has_aside',
			),
		),
		array(
			'id' => 'header_aside_visibility',
			'default' => 'visible-desktop',
			'control' => array(
				'label' => esc_html__( 'Visibility', 'total' ),
				'type' => 'select',
				'choices' => wpex_visibility(),
				'active_callback' => 'wpex_cac_header_has_aside',
			),
		),
		array(
			'id' => 'header_aside_search',
			//'transport' => 'postMessage', // Can't because if hidden on customizer load we could never show it
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Header Aside Search', 'total' ),
				'type' => 'checkbox',
				'active_callback' => 'wpex_cac_header_has_aside_search',
			),
		),
		array(
			'id' => 'header_aside',
			'control' => array(
				'label' => esc_html__( 'Header Aside Content', 'total' ),
				'type' => 'textarea',
				'active_callback' => 'wpex_cac_header_has_aside',
				'description' => esc_html__( 'If you enter the ID number of a page it will automatically display the content of such page.', 'total' ),
			),
		),
	)
);

/*-----------------------------------------------------------------------------------*/
/* - Header => Logo
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_header_logo'] = array(
	'title' => esc_html__( 'Logo', 'total' ),
	'panel' => 'wpex_header',
	'settings' => array(
		array(
			'id' => 'logo_top_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Margin', 'total' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-logo',
				'alter' => 'padding-top',
				'sanitize' => 'px',
			),
		),
		array(
			'id' => 'logo_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Margin', 'total' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-logo',
				'alter' => 'padding-bottom',
				'sanitize' => 'px',
			),
		),
		array(
			'id' => 'logo_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'total' ),
				'active_callback' => 'wpex_cac_hasnt_custom_logo',
			),
			'inline_css' => array(
				'target' => '#site-logo a.site-logo-text',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'logo_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Hover Color', 'total' ),
				'active_callback' => 'wpex_cac_hasnt_custom_logo',
			),
			'inline_css' => array(
				'target' => '#site-logo a.site-logo-text:hover',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'custom_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Image Logo', 'total' ),
				'type' => 'image',
			),
		),
		array(
			'id' => 'logo_height',
			'control' => array(
				'label' => esc_html__( 'Height', 'total' ),
				'type' => 'text',
				'description' => esc_html__( 'Used for retina and image height attribute tag.', 'total' ),
				'active_callback' => 'wpex_cac_has_image_logo',
			),
		),
		array(
			'id' => 'apply_logo_height',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Apply Height', 'total' ),
				'type' => 'checkbox',
				'description' => esc_html__( 'Check this box to apply your logo height to the image. Useful for displaying large logos at a smaller size.', 'total' ),
				'active_callback' => 'wpex_cac_has_image_logo',
			),
		),
		array(
			'id' => 'logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Width', 'total' ),
				'description' => esc_html__( 'Used for image width attribute tag.', 'total' ),
				'type' => 'text',
				'active_callback' => 'wpex_cac_has_image_logo',
			),
		),
		array(
			'id' => 'retina_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Retina Image Logo', 'total' ),
				'type' => 'image',
				'active_callback' => 'wpex_cac_has_image_logo',
			),
		),
		array(
			'id' => 'logo_max_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Logo Max Width: Desktop', 'total' ),
				'type' => 'text',
				'description' => esc_html__( 'Screens 960px wide and greater.', 'total' ),
				'active_callback' => 'wpex_cac_has_image_logo',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 960px)',
				'target' => '#site-logo img',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'logo_max_width_tablet_portrait',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Logo Max Width: Tablet Portrait', 'total' ),
				'type' => 'text',
				'description' => esc_html__( 'Screens 768px-959px wide.', 'total' ),
				'active_callback' => 'wpex_cac_has_image_logo',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 768px) and (max-width: 959px)',
				'target' => '#site-logo img',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'logo_max_width_phone',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Logo Max Width: Phone', 'total' ),
				'type' => 'text',
				'description' => esc_html__( 'Screens smaller than 767px wide.', 'total' ),
				'active_callback' => 'wpex_cac_has_image_logo',
			),
			'inline_css' => array(
				'media_query' => '(max-width: 767px)',
				'target' => '#site-logo img',
				'alter' => 'max-width',
			),
		),
	)
);

/*-----------------------------------------------------------------------------------*/
/* - Header => Logo Icon
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_header_logo_icon'] = array(
	'title' => esc_html__( 'Logo Icon', 'total' ),
	'panel' => 'wpex_header',
	'settings' => array(
		array(
			'id' => 'logo_icon',
			'transport' => 'postMessage',
			'default' => 'none',
			'control' => array(
				'label' => esc_html__( 'Text Logo Icon', 'total' ),
				'type' => 'select',
				'choices' => wpex_get_awesome_icons(),
				'active_callback' => 'wpex_cac_hasnt_custom_logo',
			),
		),
		array(
			'id' => 'logo_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Logo Icon Color', 'total' ),
				'active_callback' => 'wpex_cac_hasnt_custom_logo',
			),
			'inline_css' => array(
				'target' => '#site-logo-fa-icon',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'logo_icon_right_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Logo Icon Right Margin', 'total' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
				'active_callback' => 'wpex_cac_hasnt_custom_logo',
			),
			'inline_css' => array(
				'target' => '#site-logo-fa-icon',
				'alter' => 'margin-right',
			),
		),
	)
);

/*-----------------------------------------------------------------------------------*/
/* - Header => Fixed On Scroll
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_header_fixed'] = array(
	'title' => esc_html__( 'Sticky Header', 'total' ),
	'panel' => 'wpex_header',
	'settings' => array(
		'fixed_header_style' => array(
			'id' => 'fixed_header_style',
			'transport' => 'refresh',
			'default' => 'standard',
			'sanitize_callback' => 'esc_html',
			'control' => array(
				'label' => esc_html__( 'Style', 'total' ),
				'type' => 'select',
				'choices' => array(
					'disabled' => esc_html__( 'Disabled', 'total' ),
					'standard' => esc_html__( 'Standard', 'total' ),
					//'slide_down' => esc_html__( 'Visible Slide Down', 'total' ),
					//'slide_down_hidden' => esc_html__( 'Hidden Slide Down', 'total' ),
					'shrink' => esc_html__( 'Shrink', 'total' ),
					'shrink_animated' => esc_html__( 'CSS3 Animated Shrink (Best with Image Logo)', 'total' ),
				),
				'active_callback' => 'wpex_cac_header_supports_fixed_header',
			),
		),
		'fixed_header_shrink_start_height' => array(
			'id' => 'fixed_header_shrink_start_height',
			'sanitize_callback' => 'absint',
			'default' => 60,
			'control' => array(
				'label' => esc_html__( 'Logo Start Height', 'total' ),
				'type' => 'number',
				'description' => esc_html__( 'In order to properly animate the header with CSS3 it is important to apply a fixed height to the header logo by default.', 'total' ),
				'active_callback' => 'wpex_cac_has_fixed_header_shrink',
			),
			'inline_css' => array(
				'target' => '.shrink-sticky-header #site-logo img',
				'alter' => 'max-height',
				'sanitize' => 'px',
				'obj_condition' => 'shrink_fixed_header',
				'important' => true,
			),
		),
		'fixed_header_shrink_end_height' => array(
			'id' => 'fixed_header_shrink_end_height',
			'default' => 50,
			'sanitize_callback' => 'absint',
			'control' => array(
				'label' => esc_html__( 'Logo Shrunk Height', 'total' ),
				'type' => 'number',
				'active_callback' => 'wpex_cac_has_fixed_header_shrink',
				'description' => esc_html__( 'Your shrink header height will be set to your Logo Shrunk Height plus 20px for a top and bottom padding of 10px.', 'total' ),
			),
		),
		'fixed_header_mobile' => array(
			'id' => 'fixed_header_mobile',
			'sanitize_callback' => 'esc_html',
			'control' => array(
				'label' => esc_html__( 'Mobile Support', 'total' ),
				'type' => 'checkbox',
			),
		),
		'fixed_header_opacity' => array(
			'id' => 'fixed_header_opacity',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'number',
				'label' => esc_html__( 'Opacity', 'total' ),
				'active_callback' => 'wpex_cac_has_fixed_header',
				'input_attrs' => array(
					'min' => 0.1,
        			'max' => 1,
        			'step' => 0.1,
        		),
			),
			'inline_css' => array(
				'target' => '.wpex-sticky-header-holder.is-sticky #site-header',
				'alter' => 'opacity',
				'obj_condition' => 'has_fixed_header',
			),
		),
		'fixed_header_logo' => array(
			'id' => 'fixed_header_logo',
			'sanitize_callback' => 'esc_url',
			'control' => array(
				'label' => esc_html__( 'Custom Logo', 'total' ),
				'type' => 'image',
				'active_callback' => 'wpex_cac_supports_fixed_header_logo',
				'description' => esc_html__( 'If this custom logo is a different size, for best results go to the Logo section and apply a custom height to your logo.', 'total' ),
			),
		),
		'fixed_header_logo_retina' => array(
			'id' => 'fixed_header_logo_retina',
			'sanitize_callback' => 'esc_url',
			'control' => array(
				'label' => esc_html__( 'Custom Logo Retina', 'total' ) .' '. esc_html__( 'Retina', 'total' ),
				'type' => 'image',
				'active_callback' => 'wpex_cac_has_fixed_header_logo',
			),
		),
		'fixed_header_logo_retina_height' => array(
			'id' => 'fixed_header_logo_retina_height',
			'sanitize_callback' => 'absint',
			'control' => array(
				'label' => esc_html__( 'Custom Logo Retina Height', 'total' ),
				'type' => 'number',
				'active_callback' => 'wpex_supports_fixed_header_logo_retina_height',
			),
			'inline_css' => array(
					'target' => 'body.wpex-is-retina #site-header-sticky-wrapper.is-sticky #site-logo img',
					'obj_condition' => 'fixed_header_logo_retina_height',
					'alter' => 'height',
					'sanitize' => 'px',
				),
		),
	)
);

/*-----------------------------------------------------------------------------------*/
/* - Header => Menu
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_header_menu'] = array(
	'title' => esc_html__( 'Menu', 'total' ),
	'panel' => 'wpex_header',
	'settings' => array(
		array(
			'id' => 'menu_arrow_down',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Top Level Dropdown Icon', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'menu_arrow_side',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Second+ Level Dropdown Icon', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'menu_dropdown_top_border',
			//'transport' => 'postMessage', // Can't cause it has dependent options
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Dropdown Top Border', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'menu_flush_dropdowns',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Flush Dropdowns', 'total' ),
				'type' => 'checkbox',
				'active_callback' => 'wpex_cac_navbar_supports_flush_dropdowns'
			),
		),
		array(
			'id' => 'menu_dropdown_style',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Dropdown Style', 'total' ),
				'type' => 'select',
				'choices' => wpex_get_menu_dropdown_styles(),
			),
		),
		array(
			'id' => 'menu_dropdown_dropshadow',
			'transport' => 'postMessage',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Dropdown Dropshadow Style', 'total' ),
				'type' => 'select',
				'choices' => array(
					'' => esc_html__( 'None', 'total' ),
					'one' => esc_html__( 'One', 'total' ),
					'two' => esc_html__( 'Two', 'total' ),
					'three' => esc_html__( 'Three', 'total' ),
					'four' => esc_html__( 'Four', 'total' ),
					'five' => esc_html__( 'Five', 'total' ),
				),
			),
		),

		/*** Search Icon ***/
		array(
			'id' => 'navbar_search_icon_heading',
			'control' => array(
				'type' => 'wpex-heading',
				'label' => esc_html__( 'Search Icon', 'total' ),
			),
		),
		array(
			'id' => 'menu_search_style',
			'default' => 'drop_down',
			'control' => array(
				'label' => esc_html__( 'Search Icon Style', 'total' ),
				'type' => 'select',
				'choices' => array(
					'disabled' => esc_html__( 'Disabled','total' ),
					'drop_down' => esc_html__( 'Drop Down','total' ),
					'overlay' => esc_html__( 'Site Overlay','total' ),
					'header_replace' => esc_html__( 'Header Replace','total' )
				),
				'description' => esc_html__( 'Vertical header styles only support the disabled and overlay styles.', 'total' ),
			),
		),
		array(
			'id' => 'search_dropdown_top_border',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Search Dropdown Top Border', 'total' ),
				'type' => 'color',
				'active_callback' => 'wpex_cac_has_menu_search_dropdown',
			),
			'inline_css' => array(
				'target' => '#searchform-dropdown',
				'alter' => 'border-top-color',
				'obj_condition' => 'has_menu_search',
			),
		),

		/*** Main Styling ***/
		array(
			'id' => 'menu_main_styling_heading',
			'control' => array(
				'type' => 'wpex-heading',
				'label' => esc_html__( 'Styling: Main', 'total' ),
				'active_callback' => 'wpex_cac_has_mobile_menu_icons',
			),
		),
		array(
			'id' => 'menu_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'total' ),
			),
			'inline_css' => array(
				'target' => array(
					'#site-navigation-wrap',
					'#site-navigation-sticky-wrapper.is-sticky #site-navigation-wrap',
				),
				'alter' => 'background-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'menu_borders',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Borders', 'total' ),
				'description' => esc_html__( 'Not all menus have borders, but this setting is for those that do', 'total' ),
			),
			'inline_css' => array(
				'target' => array(
					'#site-navigation li',
					'#site-navigation a',
					'#site-navigation ul',
					'#site-navigation-wrap',
					'#site-navigation',
					'.navbar-style-six #site-navigation',
					'#site-navigation-sticky-wrapper.is-sticky #site-navigation-wrap',
				),
				'alter' => 'border-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		// Menu Link Colors
		array(
			'id' => 'menu_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-navigation .dropdown-menu > li > a',
				'alter' => 'color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'menu_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-navigation .dropdown-menu > li > a:hover',
				'alter' => 'color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'menu_link_color_active',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Current Menu Item', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-navigation .dropdown-menu > .current-menu-item > a,
							#site-navigation .dropdown-menu > .current-menu-parent > a,
							#site-navigation .dropdown-menu > .current-menu-item > a:hover,
							#site-navigation .dropdown-menu > .current-menu-parent > a:hover',
				'alter' => 'color',
				'obj_condition' => 'has_header_menu',
			),
		),
		// Link Background
		array(
			'id' => 'menu_link_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Background', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-navigation .dropdown-menu > li > a',
				'alter' => 'background-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'menu_link_hover_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Background: Hover', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-navigation .dropdown-menu > li > a:hover',
				'alter' => 'background-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'menu_link_active_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Background: Current Menu Item', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-navigation .dropdown-menu > .current-menu-item > a,
							#site-navigation .dropdown-menu > .current-menu-parent > a,
							#site-navigation .dropdown-menu > .current-menu-item > a:hover,
							#site-navigation .dropdown-menu > .current-menu-parent > a:hover',
				'alter' => 'background-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		// Link Inner
		array(
			'id' => 'menu_link_span_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Inner Background', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-navigation .dropdown-menu > li > a > span.link-inner',
				'alter' => 'background-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'menu_link_span_hover_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Inner Background: Hover', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-navigation .dropdown-menu > li > a:hover > span.link-inner',
				'alter' => 'background-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'menu_link_span_active_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Inner Background: Current Menu Item', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-navigation .dropdown-menu > .current-menu-item > a > span.link-inner,
							#site-navigation .dropdown-menu > .current-menu-parent > a > span.link-inner,
							#site-navigation .dropdown-menu > .current-menu-item > a:hover > span.link-inner,
							#site-navigation .dropdown-menu > .current-menu-parent > a:hover > span.link-inner',
				'alter' => 'background-color',
				'obj_condition' => 'has_header_menu',
			),
		),

		/**** Dropdown Styling ****/
		array(
			'id' => 'menu_dropdowns_styling_heading',
			'control' => array(
				'type' => 'wpex-heading',
				'label' => esc_html__( 'Styling: Dropdowns', 'total' ),
			),
		),

		// Menu Dropdowns
		array(
			'id' => 'dropdown_menu_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-header #site-navigation .dropdown-menu ul',
				'alter' => 'background-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		// Pointer
		array(
			'id' => 'dropdown_menu_pointer_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Pointer Background', 'total' ),
			),
			'inline_css' => array(
				'target' => '.wpex-dropdowns-caret .dropdown-menu ul:after',
				'alter' => 'border-bottom-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'dropdown_menu_pointer_border',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Pointer Border', 'total' ),
			),
			'inline_css' => array(
				'target' => '.wpex-dropdowns-caret .dropdown-menu ul:before',
				'alter' => 'border-bottom-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		// Borders
		array(
			'id' => 'dropdown_menu_borders',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Dropdown Borders', 'total' ),
			),
			'inline_css' => array(
				'target' => array(
						'#site-header #site-navigation .dropdown-menu ul',
						'#site-header #site-navigation .dropdown-menu ul li',
						'#site-header #site-navigation .dropdown-menu ul li a',
				),
				'alter' => 'border-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'menu_dropdown_top_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Top Border', 'total' ),
				'active_callback' => 'wpex_cac_has_menu_dropdown_top_border',
			),
			'inline_css' => array(
				'target' => array(
					'.wpex-dropdown-top-border #site-navigation .dropdown-menu li ul',
					'#searchform-dropdown',
					'#current-shop-items-dropdown',
				),
				'alter' => 'border-top-color',
				'important' => true,
				'obj_condition' => 'has_header_menu',
			),
		),
		// Link color
		array(
			'id' => 'dropdown_menu_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-header #site-navigation .dropdown-menu ul > li > a',
				'alter' => 'color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'dropdown_menu_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-header #site-navigation .dropdown-menu ul > li > a:hover',
				'alter' => 'color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'dropdown_menu_link_hover_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Background: Hover', 'total' ),
			),
			'subtitle' => esc_html__( 'Select your custom hex color.', 'total' ),
			'inline_css' => array(
				'target' => '#site-header #site-navigation .dropdown-menu ul > li > a:hover',
				'alter' => 'background-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		// Current item
		array(
			'id' => 'dropdown_menu_link_color_active',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Current Menu Item', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-header #site-navigation .dropdown-menu ul > .current-menu-item > a',
				'alter' => 'color',
				'obj_condition' => 'has_header_menu',
			),
		),
		array(
			'id' => 'dropdown_menu_link_bg_active',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Background: Current Menu Item', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-header #site-navigation .dropdown-menu ul > .current-menu-item > a',
				'alter' => 'background-color',
				'obj_condition' => 'has_header_menu',
			),
		),
		// Mega menu
		array(
			'id' => 'mega_menu_title',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Megamenu Subtitle Color', 'total' ),
			),
			'inline_css' => array(
				'target' => '#site-header #site-navigation .sf-menu > li.megamenu > ul.sub-menu > .menu-item-has-children > a',
				'alter' => 'color',
				'obj_condition' => 'has_header_menu',
			),
		),
	)
);

/*-----------------------------------------------------------------------------------*/
/* - Header => Fixed Menu
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_fixed_menu'] = array(
	'title' => esc_html__( 'Sticky Menu', 'total' ),
	'panel' => 'wpex_header',
	'settings' => array(
		array(
			'id' => 'fixed_header_menu',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Sticky Header Menu', 'total' ),
				'type' => 'checkbox',
				'active_callback' => 'wpex_cac_header_supports_fixed_menu',
			),
		),
	)
);

/*-----------------------------------------------------------------------------------*/
/* - Header => Mobile Menu
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_header_mobile_menu'] = array(
	'title' => esc_html__( 'Mobile Menu', 'total' ),
	'panel' => 'wpex_header',
	'settings' => array(
		// Breakpoint
		array(
			'id' => 'mobile_menu_breakpoint',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Breakpoint', 'total' ),
				'type' => 'text',
				'active_callback' => 'wpex_cac_responsive',
				'desc' => esc_html__( 'Default:', 'total' ) .' 959px'
			),
		),
		// Search
		array(
			'id' => 'mobile_menu_search',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Search', 'total' ),
				'type' => 'checkbox',
			),
		),
		/*** Mobile Menu > Toggle Style ***/
		array(
			'id' => 'mobile_menu_toggle_style',
			'default' => 'icon_buttons',
			'control' => array(
				'label' => esc_html__( 'Toggle Button Style', 'total' ),
				'type' => 'select',
				'active_callback' => 'wpex_cac_has_mobile_menu',
				'choices' => array(
					'icon_buttons' => esc_html__( 'Right Aligned Icon Button(s)', 'total' ),
					'icon_buttons_under_logo' => esc_html__( 'Under The Logo Icon Button(s)', 'total' ),
					'navbar' => esc_html__( 'Navbar', 'total' ),
					'fixed_top'  => esc_html__( 'Fixed Site Top', 'total' ),
				),
			),
		),
		array(
			'id' => 'mobile_menu_toggle_fixed_top_bg',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Toggle Background', 'total' ),
				'type' => 'color',
				'active_callback' => 'wpex_cac_is_mobile_fixed_or_navbar',
			),
			'inline_css' => array(
				'target' => '#wpex-mobile-menu-fixed-top, #wpex-mobile-menu-navbar',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'mobile_menu_toggle_text',
			'transport' => 'postMessage',
			'default' => esc_html__( 'Menu', 'total' ),
			'control' => array(
				'label' => esc_html__( 'Toggle Text', 'total' ),
				'type' => 'text',
				'active_callback' => 'wpex_cac_is_mobile_fixed_or_navbar',
			),
		),
		/*** Mobile Menu > Style */
		array(
			'id' => 'mobile_menu_style',
			'default' => 'sidr',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Style', 'total' ),
				'type' => 'select',
				'choices' => array(
					'sidr' => esc_html__( 'Sidebar', 'total' ),
					'toggle' => esc_html__( 'Toggle', 'total' ),
					'full_screen' => esc_html__( 'Full Screen Overlay', 'total' ),
					'disabled' => esc_html__( 'Disabled', 'total' ),
				),
			),
		),
		array(
			'id' => 'full_screen_mobile_menu_style',
			'default' => 'white',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Style', 'total' ),
				'type' => 'select',
				'active_callback' => 'wpex_cac_mobile_menu_is_full_screen',
				'choices' => array(
					'white'	=> esc_html__( 'White', 'total' ),
					'black'	=> esc_html__( 'Black', 'total' ),
				),
			),
		),
		array(
			'id' => 'mobile_menu_sidr_direction',
			'default' => 'left',
			'control' => array(
				'label' => esc_html__( 'Direction', 'total' ),
				'type' => 'select',
				'active_callback' => 'wpex_cac_mobile_menu_is_sidr',
				'choices' => array(
					'left'	=> esc_html__( 'Left', 'total' ),
					'right'	=> esc_html__( 'Right', 'total' ),
				),
			),
		),
		array(
			'id' => 'mobile_menu_sidr_displace',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Displace', 'total' ),
				'type' => 'checkbox',
				'active_callback' => 'wpex_cac_mobile_menu_is_sidr',
			),
		),
		/*** Mobile Menu > Mobile Icons Styling ***/
		array(
			'id' => 'mobile_menu_sidr_styling_heading',
			'control' => array(
				'type' => 'wpex-heading',
				'label' => esc_html__( 'Styling: Mobile Icons Menu', 'total' ),
				'active_callback' => 'wpex_cac_has_mobile_menu_icons',
			),
		),
		array(
			'id' => 'mobile_menu_icon_size',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Font Size', 'total' ),
				'active_callback' => 'wpex_cac_has_mobile_menu_icons',
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
			),
			'inline_css' => array(
				'target' => '#mobile-menu a',
				'alter' => 'font-size',
				'sanitize' => 'px',
			),
		),
		array(
			'id' => 'mobile_menu_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'total' ),
				'active_callback' => 'wpex_cac_has_mobile_menu_icons',
			),
			'inline_css' => array(
				'target' => '#mobile-menu a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'mobile_menu_icon_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color: Hover', 'total' ),
				'active_callback' => 'wpex_cac_has_mobile_menu_icons',
			),
			'inline_css' => array(
				'target' => '#mobile-menu a:hover',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'mobile_menu_icon_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'total' ),
				'active_callback' => 'wpex_cac_has_mobile_menu_icons',
			),
			'inline_css' => array(
				'target' => '#mobile-menu a',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'mobile_menu_icon_background_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background: Hover', 'total' ),
				'active_callback' => 'wpex_cac_has_mobile_menu_icons',
			),
			'inline_css' => array(
				'target' => '#mobile-menu a:hover',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'mobile_menu_icon_border',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border', 'total' ),
				'active_callback' => 'wpex_cac_has_mobile_menu_icons',
			),
			'inline_css' => array(
				'target' => '#mobile-menu a',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'mobile_menu_icon_border_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border: Hover', 'total' ),
				'active_callback' => 'wpex_cac_has_mobile_menu_icons',
			),
			'inline_css' => array(
				'target' => '#mobile-menu a:hover',
				'alter' => 'border-color',
			),
		),
		/*** Mobile Menu > Sidr ***/
		array(
			'id' => 'mobile_menu_icons_styling_heading',
			'control' => array(
				'type' => 'wpex-heading',
				'label' => esc_html__( 'Styling: Mobile Sidebar Menu', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_sidr',
			),
		),
		array(
			'id' => 'mobile_menu_sidr_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_sidr',
			),
			'inline_css' => array(
				'target' => '#sidr-main',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'mobile_menu_sidr_borders',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Borders', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_sidr',
			),
			'inline_css' => array(
				'target' => '#sidr-main li, #sidr-main ul',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'mobile_menu_links',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_sidr',
			),
			'inline_css' => array(
				'target' => '.sidr a, .sidr-class-dropdown-toggle',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'mobile_menu_links_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links: Hover', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_sidr',
			),
			'inline_css' => array(
				'target' => '.sidr a:hover, .sidr-class-dropdown-toggle:hover, .sidr-class-dropdown-toggle .fa, .sidr-class-menu-item-has-children.active > a, .sidr-class-menu-item-has-children.active > a > .sidr-class-dropdown-toggle',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'mobile_menu_sidr_search_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Searchbar Color', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_sidr',
			),
			'inline_css' => array(
				'target' => array(
					'.sidr-class-mobile-menu-searchform input',
					'.sidr-class-mobile-menu-searchform input:focus',
					'.sidr-class-mobile-menu-searchform button',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'mobile_menu_sidr_search_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Searchbar Background', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_sidr',
			),
			'inline_css' => array(
				'target' => '.sidr-class-mobile-menu-searchform input',
				'alter' => 'background',
			),
		),

		/*** Mobile Menu > Toggle Menu ***/
		array(
			'id' => 'mobile_menu_toggle_menu_styling_heading',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'wpex-heading',
				'label' => esc_html__( 'Styling: Mobile Toggle Menu', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_toggle',
			),
		),
		array(
			'id' => 'toggle_mobile_menu_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_toggle',
			),
			'inline_css' => array(
				'target' => array(
					'.mobile-toggle-nav',
					'.wpex-mobile-toggle-menu-fixed_top .mobile-toggle-nav',
				),
				'alter' => 'background',
			),
		),
		array(
			'id' => 'toggle_mobile_menu_borders',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Borders', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_toggle',
			),
			'inline_css' => array(
				'target' => array(
					'.mobile-toggle-nav a',
					'.wpex-mobile-toggle-menu-fixed_top .mobile-toggle-nav a',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'toggle_mobile_menu_links',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_toggle',
			),
			'inline_css' => array(
				'target' => array(
					'.mobile-toggle-nav a',
					'.wpex-mobile-toggle-menu-fixed_top .mobile-toggle-nav a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'toggle_mobile_menu_links_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links: Hover', 'total' ),
				'active_callback' => 'wpex_cac_mobile_menu_is_toggle',
			),
			'inline_css' => array(
				'target' => array(
					'.mobile-toggle-nav a:hover',
					'.wpex-mobile-toggle-menu-fixed_top .mobile-toggle-nav a:hover',
				),
				'alter' => 'color',
			),
		),
	),
);

// Remove vars from memory
unset( $header_styles );