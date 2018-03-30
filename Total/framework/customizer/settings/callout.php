<?php
/**
 * Footer Customizer Options
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// General
$this->sections['wpex_callout'] = array(
	'title' => esc_html__( 'General', 'total' ),
	'settings' => array(
		array(
			'id' => 'callout',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Enable', 'total' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'If you disable this option we recommend you go to the Customizer Manager and disable the section as well so the next time you work with the Customizer it will load faster.', 'total' ),
			),
		),
		array(
			'id' => 'callout_visibility',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Visibility', 'total' ),
				'type' => 'select',
				'choices' => wpex_visibility(),
				'active_callback' => 'wpex_cac_has_callout',
			),
		),
		array(
			'id' => 'callout_text',
			'transport' => 'postMessage',
			'default' => 'I am the footer call-to-action block, here you can add some relevant/important information about your company or product. I can be disabled in the theme options.',
			'control' => array(
				'label' => esc_html__( 'Content', 'total' ),
				'type' => 'textarea',
				'active_callback' => 'wpex_cac_has_callout',
				'description' => esc_html__( 'If you enter the ID number of a page it will automatically display the content of such page.', 'total' ),
			),
		),
		/** Button **/
		array(
			'id' => 'callout_button_heading',
			'control' => array(
				'type' => 'wpex-heading',
				'label' => esc_html__( 'Button', 'total' ),
				'active_callback' => 'wpex_cac_has_callout',
			),
		),
		array(
			'id' => 'callout_link',
			//'transport' => 'postMessage', Can't because it defines if it shows or hides
			'default' => 'http://www.wpexplorer.com',
			'control' => array(
				'label' => esc_html__( 'Link URL', 'total' ),
				'type' => 'text',
				'active_callback' => 'wpex_cac_has_callout',
			),
		),
		array(
			'id' => 'callout_link_txt',
			'transport' => 'postMessage',
			'default' => 'Get In Touch',
			'control' => array(
				'label' => esc_html__( 'Link Text', 'total' ),
				'type' => 'text',
				'active_callback' => 'wpex_cac_callout_has_button',
			),
		),
		array(
			'id' => 'callout_button_target',
			'transport' => 'postMessage',
			'default' => 'blank',
			'control' => array(
				'label' => esc_html__( 'Link Target', 'total' ),
				'type' => 'select',
				'active_callback' => 'wpex_cac_callout_has_button',
				'choices' => array(
					'blank' => esc_html__( 'Blank', 'total' ),
					'self' => esc_html__( 'Self', 'total' ),
				),
			),
		),
		array(
			'id' => 'callout_button_rel',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Link Rel', 'total' ),
				'type' => 'select',
				'active_callback' => 'wpex_cac_callout_has_button',
				'choices' => array(
					'' => esc_html__( 'None', 'total' ),
					'nofollow' => esc_html__( 'Nofollow', 'total' ),
				),
			),
		),
		/** Styling **/
		array(
			'id' => 'callout_styling_heading',
			'control' => array(
				'type' => 'wpex-heading',
				'label' => esc_html__( 'Styling', 'total' ),
				'active_callback' => 'wpex_cac_has_callout',
			),
		),
		array(
			'id' => 'callout_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'total' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
			),
			'inline_css' => array(
				'target' => '#footer-callout-wrap',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'callout_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'total' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
			),
			'inline_css' => array(
				'target' => '#footer-callout-wrap',
				'alter' => 'padding-bottom',
			),
		),
		array(
			'id' => 'footer_callout_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'total' ),
				'active_callback' => 'wpex_cac_has_callout',
			),
			'inline_css' => array(
				'target' => '#footer-callout-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'footer_callout_border',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'total' ),
				'active_callback' => 'wpex_cac_has_callout',
			),
			'inline_css' => array(
				'target' => '#footer-callout-wrap',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'footer_callout_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'total' ),
				'active_callback' => 'wpex_cac_has_callout',
			),
			'inline_css' => array(
				'target' => '#footer-callout-wrap',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_callout_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links', 'total' ),
				'active_callback' => 'wpex_cac_has_callout',
			),
			'inline_css' => array(
				'target' => '.footer-callout-content a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_callout_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links: Hover', 'total' ),
				'active_callback' => 'wpex_cac_has_callout',
			),
			'inline_css' => array(
			'target' => '.footer-callout-content a:hover',
			'alter' => 'color',
			),
		),
		array(
			'id' => 'callout_button_border_radius',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Button Border Radius', 'total' ),
				'active_callback' => 'wpex_cac_callout_has_button',
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'total' ),
			),
			'inline_css' => array(
				'target' => '#footer-callout .theme-button',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'footer_callout_button_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Button Background', 'total' ),
				'active_callback' => 'wpex_cac_callout_has_button',
			),
			'inline_css' => array(
				'target' => '#footer-callout .theme-button',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'footer_callout_button_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Button Color', 'total' ),
				'active_callback' => 'wpex_cac_callout_has_button',
			),
			'inline_css' => array(
				'target' => '#footer-callout .theme-button',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_callout_button_hover_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Button: Hover Background', 'total' ),
				'active_callback' => 'wpex_cac_callout_has_button',
			),
			'inline_css' => array(
				'target' => '#footer-callout .theme-button:hover',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'footer_callout_button_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Button: Hover Color', 'total' ),
				'active_callback' => 'wpex_cac_callout_has_button',
			),
			'inline_css' => array(
				'target' => '#footer-callout .theme-button:hover',
				'alter' => 'color',
			),
		),
	),
);