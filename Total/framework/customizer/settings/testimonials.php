<?php
/**
 * Testimonials Customizer Options
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.3.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// General
$this->sections['wpex_testimonials'] = array(
	'title' => esc_html__( 'General', 'total' ),
	'settings' => array(
		array(
			'id' => 'testimonials_archive_layout',
			'default' => 'full-width',
			'control' => array (
				'label' => esc_html__( 'Archive Layout', 'total' ),
				'type' => 'select',
				'choices' => $post_layouts,
			),
		),
		array(
			'id' => 'testimonials_entry_columns',
			'default' => '4',
			'control' => array (
				'label' => esc_html__( 'Archive Columns', 'total' ), 
				'type' => 'select',
				'choices' => wpex_grid_columns(),
			),
		),
		array(
			'id' => 'testimonials_archive_posts_per_page',
			'default' => '12',
			'control' => array (
				'label' => esc_html__( 'Archive Posts Per Page', 'total' ),
				'type' => 'number',
			),
		),
		array(
			'id' => 'testimonial_entry_title',
			'control' => array (
				'label' => esc_html__( 'Archive Entry Title', 'total' ), 
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'testimonial_post_style',
			'default' => 'blockquote',
			'control' => array (
				'label' => esc_html__( 'Single Style', 'total' ),
				'type' => 'select',
				'choices' => array(
					'blockquote' => esc_html__( 'Blockquote', 'total' ),
					'standard' => esc_html__( 'Standard', 'total' ),
				),
			),
		),
		array(
			'id' => 'testimonials_single_layout',
			'default' => 'right-sidebar',
			'control' => array (
				'label' => esc_html__( 'Single Layout', 'total' ),
				'type' => 'select',
				'choices' => $post_layouts,
			),
		),
		array(
			'id' => 'testimonials_comments',
			'control' => array (
				'label' => esc_html__( 'Comments', 'total' ), 
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'testimonials_next_prev',
			'default' => 1,
			'control' => array (
				'label' => esc_html__( 'Next & Previous Links', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'testimonial_entry_bg',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'color',
				'label' => esc_html__( 'Entry Background', 'total' ),
			),
			'inline_css' => array(
				'target' => '.testimonial-entry-content',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'testimonial_entry_pointer_bg',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'color',
				'label' => esc_html__( 'Entry Pointer Background', 'total' ),
			),
			'inline_css' => array(
				'target' => '.testimonial-caret',
				'alter' => 'border-top-color',
			),
		),
		array(
			'id' => 'testimonial_entry_color',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'color',
				'label' => esc_html__( 'Entry Color', 'total' ),
			),
			'inline_css' => array(
				'target' => array(
					'.testimonial-entry-content',
					'.testimonial-entry-content a',
				),
				'alter' => 'color',
			),
		),
	),
);