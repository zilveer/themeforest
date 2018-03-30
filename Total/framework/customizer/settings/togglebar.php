<?php
/**
 * Toggle Bar Panel
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
$this->sections['wpex_togglebar'] = array(
	'title' => esc_html__( 'General', 'total' ),
	'settings' => array(
		array(
			'id' => 'toggle_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'total' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'If you disable this option we recommend you go to the Customizer Manager and disable the section as well so the next time you work with the Customizer it will load faster.', 'total' ),
			),
		),
		array(
			'id' => 'toggle_bar_page',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Content', 'total' ),
				'type' => 'dropdown-pages',
				'active_callback' => 'wpex_cac_has_togglebar',
			),
		),
		array(
			'id' => 'toggle_bar_visibility',
			'transport' => 'postMessage',
			'default' => 'always-visible',
			'control' => array(
				'label' => esc_html__( 'Visibility', 'total' ),
				'type' => 'select',
				'choices' => wpex_visibility(),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
		),
		array(
			'id' => 'toggle_bar_display',
			'default' => 'overlay',
			'control' => array(
				'label' => esc_html__( 'Display', 'total' ),
				'type' => 'select',
				'choices' => array(
					'overlay' => esc_html__( 'Overlay', 'total' ),
					'inline' => esc_html__( 'Inline', 'total' ),
				),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
		),
		array(
			'id' => 'toggle_bar_animation',
			'default' => 'fade',
			'control' => array(
				'label' => esc_html__( 'Animation', 'total' ),
				'type' => 'select',
				'choices' => array(
					'fade' => esc_html__( 'Fade', 'total' ),
					'fade-slide' => esc_html__( 'Fade & Slide Down', 'total' ),
				),
				'active_callback' => 'wpex_cac_has_togglebar_animation',
			),
		),
		array(
			'id' => 'toggle_bar_button_icon',
			//'transport' => 'postMessage',
			'default' => 'plus',
			'control' => array(
				'label' => esc_html__( 'Button Icon', 'total' ),
				'type' => 'select',
				'choices' => wpex_get_awesome_icons(),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
		),
		array(
			'id' => 'toggle_bar_button_icon_active',
			//'transport' => 'postMessage',
			'default' => 'minus',
			'control' => array(
				'label' => esc_html__( 'Button Icon: Active', 'total' ),
				'type' => 'select',
				'choices' => wpex_get_awesome_icons(),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
		),
		array(
			'id' => 'toggle_bar_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Content Background', 'total' ),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
			'inline_css' => array(
				'target' => '#toggle-bar-wrap',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'toggle_bar_border',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Content Border', 'total' ),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
			'inline_css' => array(
				'target' => '#toggle-bar-wrap',
				'alter' => 'border-color',
				'important' => true,
			),
		),
		array(
			'id' => 'toggle_bar_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Content Color', 'total' ),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
			'inline_css' => array(
				'target' => array(
					'#toggle-bar-wrap',
					'#toggle-bar-wrap strong',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'toggle_bar_btn_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Button Background', 'total' ),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
			'inline_css' => array(
				'target' => '.toggle-bar-btn',
				'alter' => array( 'border-top-color', 'border-right-color' ),
			),
		),
		array(
			'id' => 'toggle_bar_btn_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Button Color', 'total' ),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
			'inline_css' => array(
				'target' => '.toggle-bar-btn span.fa',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'toggle_bar_btn_hover_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Button Hover Background', 'total' ),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
			'inline_css' => array(
				'target' => '.toggle-bar-btn:hover',
				'alter' => array( 'border-top-color', 'border-right-color' ),
			),
		),
		array(
			'id' => 'toggle_bar_btn_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Button Hover Color', 'total' ),
				'active_callback' => 'wpex_cac_has_togglebar',
			),
			'inline_css' => array(
				'target' => '.toggle-bar-btn:hover span.fa',
				'alter' => 'color',
			),
		),
	)
);