<?php
/**
 * Customizer => Footer Bottom
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
$this->sections['wpex_footer_bottom'] = array(
	'title' => esc_html__( 'General', 'total' ),
	'settings' => array(
				array(
			'id' => 'footer_bottom',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Bottom Footer Area', 'total' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'If you disable this option we recommend you go to the Customizer Manager and disable the section as well so the next time you work with the Customizer it will load faster.', 'total' ),
			),
		),
		array(
			'id' => 'footer_copyright_text',
			'transport' => 'postMessage',
			'default' => 'Copyright <a href="#">Your Business LLC.</a> - All Rights Reserved',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'total' ),
				'type' => 'textarea',
				'active_callback' => 'wpex_cac_has_footer_bottom',
			),
		),
		array(
			'id' => 'bottom_footer_text_align',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'select',
				'label' => esc_html__( 'Text Align', 'total' ),
				'choices' => array(
					'default' => esc_html__( 'Default','total' ),
					'left' => esc_html__( 'Left','total' ),
					'right' => esc_html__( 'Right','total' ),
					'center' => esc_html__( 'Center','total' ),
				),
				'active_callback'=> 'wpex_cac_has_footer_bottom',
			),
			'inline_css' => array(
				'target' => '#footer-bottom',
				'alter' => 'text-align',
			),
		),
		array(
			'id' => 'bottom_footer_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'total' ),
				'description' => esc_html__( 'Format: top right bottom left.', 'total' ),
				'active_callback'=> 'wpex_cac_has_footer_bottom',
			),
			'inline_css' => array(
				'target' => '#footer-bottom-inner',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_footer_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'total' ),
				'active_callback'=> 'wpex_cac_has_footer_bottom',
			),
			'inline_css' => array(
				'target' => '#footer-bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_footer_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'total' ),
				'active_callback'=> 'wpex_cac_has_footer_bottom',
			),
			'inline_css' => array(
				'target' => array(
					'#footer-bottom',
					'#footer-bottom p',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'bottom_footer_link_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Links', 'total' ),
				'active_callback'=> 'wpex_cac_has_footer_bottom',
			),
			'inline_css' => array(
				'target' => '#footer-bottom a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'bottom_footer_link_color_hover',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Links: Hover', 'total' ),
				'active_callback'=> 'wpex_cac_has_footer_bottom',
			),
			'inline_css' => array(
				'target' => '#footer-bottom a:hover',
				'alter' => 'color',
			),
		),
	),
);