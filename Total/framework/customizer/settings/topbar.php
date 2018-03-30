<?php
/**
 * Customizer => Top Bar
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.3.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Social styles
$social_styles = array(
	'' => esc_html__( 'Minimal', 'total' ),
	'colored-icons' => esc_html__( 'Colored Image Icons (Legacy)', 'total' ),
);
$social_styles = array_merge( wpex_social_button_styles(), $social_styles );
unset( $social_styles[''] );

// General
$this->sections['wpex_topbar_general'] = array(
	'title' => esc_html__( 'General', 'total' ),
	'panel' => 'wpex_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'total' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'If you disable this option we recommend you go to the Customizer Manager and disable the section as well so the next time you work with the Customizer it will load faster.', 'total' ),
			),
		),
		array(
			'id' => 'top_bar_sticky',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Sticky', 'total' ),
				'type' => 'checkbox',
				'active_callback' => 'wpex_cac_has_topbar',
			),
		),
		array(
			'id' => 'top_bar_fullwidth',
			'default' => false,
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Full-Width', 'total' ),
				'type' => 'checkbox',
				'active_callback' => 'wpex_cac_hasnt_boxed_layout',
			),
		),
		array(
			'id' => 'top_bar_visibility',
			'transport' => 'postMessage',
			'default' => 'always-visible',
			'control' => array(
				'label' => esc_html__( 'Visibility', 'total' ),
				'type' => 'select',
				'choices' => wpex_visibility(),
				'active_callback' => 'wpex_cac_has_topbar',
			),
		),
		array(
			'id' => 'top_bar_style',
			//'transport' => 'postMessage', // Can't because of sticky setting
			'default' => 'one',
			'control' => array(
				'label' => esc_html__( 'Style', 'total' ),
				'type' => 'select',
				'active_callback' => 'wpex_cac_has_topbar',
				'choices' => array(
					'one' => esc_html__( 'Left Content & Right Social', 'total' ),
					'two' => esc_html__( 'Left Social & Right Content', 'total' ),
					'three' => esc_html__( 'Centered Content & Social', 'total' ),
				),
			),
		),
		// main styling
		array(
			'id' => 'top_bar_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'total' ),
				'active_callback' => 'wpex_cac_has_topbar',
			),
			'inline_css' => array(
				'target' => array(
					'#top-bar-wrap',
					'.wpex-top-bar-sticky',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'top_bar_border',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Borders', 'total' ),
				'active_callback' => 'wpex_cac_has_topbar',
			),
			'inline_css' => array(
				'target' => '#top-bar-wrap',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'top_bar_text',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'total' ),
				'active_callback' => 'wpex_cac_has_topbar',
			),
			'inline_css' => array(
				'target' => array(
					'#top-bar-wrap',
					'#top-bar-content strong',
				),
				'alter' => 'color',
			),
		),
		// link colors
		array(
			'id' => 'top_bar_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'total' ),
				'active_callback' => 'wpex_cac_has_topbar',
			),
			'inline_css' => array(
				'target' => array(
					'#top-bar-content a',
					'#top-bar-social-alt a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'total' ),
				'active_callback' => 'wpex_cac_has_topbar',
			),
			'inline_css' => array(
				'target' => array(
					'#top-bar-content a:hover',
					'#top-bar-social-alt a:hover',
				),
				'alter' => 'color',
			),
		),
		// Padding
		array(
			'id' => 'top_bar_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'total' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
			),
			'inline_css' => array(
				'target' => '#top-bar',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'top_bar_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'total' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
			),
			'inline_css' => array(
				'target' => '#top-bar',
				'alter' => 'padding-bottom',
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/* - TopBar => Content
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_topbar_content'] = array(
	'title' => esc_html__( 'Content', 'total' ),
	'panel' => 'wpex_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_content',
			'default' => '[font_awesome icon="phone" margin_right="5px" color="#000"] 1-800-987-654 [font_awesome icon="envelope" margin_right="5px" margin_left="20px" color="#000"] admin@totalwptheme.com [font_awesome icon="user" margin_right="5px" margin_left="20px" color="#000"] [wp_login_url text="User Login" logout_text="Logout"]',
			'control' => array(
				'label' => esc_html__( 'Content', 'total' ),
				'type' => 'wpex_textareaa',
				'rows' => 25,
				'active_callback' => 'wpex_cac_has_topbar',
				'description' => esc_html__( 'If you enter the ID number of a page it will automatically display the content of such page.', 'total' ),
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/* - TopBar => Social
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_topbar_social'] = array(
	'title' => esc_html__( 'Social', 'total' ),
	'panel' => 'wpex_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_social',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Social', 'total' ),
				'type' => 'checkbox',
				'active_callback' => 'wpex_cac_has_topbar',
			),
		),
		array(
			'id' => 'top_bar_social_alt',
			'control' => array(
				'label' => esc_html__( 'Social Alternative', 'total' ),
				'type' => 'textarea',
				'active_callback' => 'wpex_cac_has_topbar',
				'description' => esc_html__( 'If you enter the ID number of a page it will automatically display the content of such page.', 'total' ),
			),
		),
		array(
			'id' => 'top_bar_social_target',
			'default' => 'blank',
			'transport' => 'postMessage', // Doesn't need any js because you can't click links in the customizer anyway
			'control' => array(
				'label' => esc_html__( 'Social Link Target', 'total' ),
				'type' => 'select',
				'choices' => array(
					'blank' => esc_html__( 'New Window', 'total' ),
					'self' => esc_html__( 'Same Window', 'total' ),
				),
				'active_callback' => 'wpex_cac_has_topbar_social',
			),
		),
		array(
			'id' => 'top_bar_social_style',
			'default' => 'none',
			'control' => array(
				'label' => esc_html__( 'Social Style', 'total' ),
				'type' => 'select',
				'choices' => $social_styles,
				'active_callback' => 'wpex_cac_has_topbar_social',
			),
		),
		array(
			'id' => 'top_bar_social_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Social Links Color', 'total' ),
				'active_callback' => 'wpex_cac_topbar_social_style_is_none',
			),
			'inline_css' => array(
				'target' => '#top-bar-social a.wpex-social-btn-no-style',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_social_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Social Links Hover Color', 'total' ),
				'active_callback' => 'wpex_cac_topbar_social_style_is_none',
			),
			'inline_css' => array(
				'target' => '#top-bar-social a.wpex-social-btn-no-style:hover',
				'alter' => 'color',
			),
		),
	),
);

// Social settings
$social_options = wpex_topbar_social_options();
foreach ( $social_options as $key => $val ) {
	$this->sections['wpex_topbar_social']['settings'][] = array(
		'id' => 'top_bar_social_profiles[' . $key .']',
		'control' => array(
			'label' => esc_html__( $val['label'], 'total' ),
			'type' => 'text',
			'active_callback' => 'wpex_cac_has_topbar_social',
		),
	);
}

// Remove vars from memory
unset( $social_styles );
unset( $social_options );