<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'cmb_meta_boxes', 'dfd_headers_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes Metabox options.
 *
 * @return array
 */
function dfd_headers_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list.
	$prefix = 'preloader_';

	$meta_boxes[] = array(
		'id'         => 'dfd_preloader_settings_box',
		'title'      => esc_attr__( 'Preloader options', 'dfd' ),
		'pages'      => array('page','post','my-product','product','gallery'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left.
		'fields'     => array(
			array(
				'name'    => esc_attr__( 'Background image', 'dfd' ),
				'id'      => $prefix . 'bg_img',
				'type'    => 'file',
				'save_id' => false,
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Background position', 'dfd' ),
				'id'      => $prefix . 'bg_img_position',
				'type'    => 'select',
				'options' => dfd_get_bgposition_redux(),
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Background color', 'dfd' ),
				'id'      => $prefix . 'bg_color',
				'type'    => 'colorpicker',
				'save_id' => false,
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Background size', 'dfd' ),
				'id'      => $prefix . 'bg_size',
				'type'    => 'select',
				'options' => array(
					array(
						'name'  => esc_attr__( 'Cover', 'dfd' ),
						'value' => 'cover',
					),
					array(
						'name'  => esc_attr__( 'Contain', 'dfd' ),
						'value' => 'contain',
					),
					array(
						'name'  => esc_attr__( 'Inheirt', 'dfd' ),
						'value' => 'inherit',
					),
				),
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Background repeat', 'dfd' ),
				'id'      => $prefix . 'bg_repeat',
				'type'    => 'select',
				'options' => array(
					array(
						'name'  => esc_attr__( 'No-repeat', 'dfd' ),
						'value' => 'no-repeat',
					),
					array(
						'name'  => esc_attr__( 'Repeat All', 'dfd' ),
						'value' => 'repeat',
					),
					array(
						'name'  => esc_attr__( 'Repeat Horizontally', 'dfd' ),
						'value' => 'repeat-x',
					),
					array(
						'name'  => esc_attr__( 'Repeat Vertically', 'dfd' ),
						'value' => 'repeat-y',
					),
					array(
						'name'  => esc_attr__( 'Inheirt', 'dfd' ),
						'value' => 'inherit',
					),
				),
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Background attachment', 'dfd' ),
				'id'      => $prefix . 'bg_attachment',
				'type'    => 'select',
				'options' => array(
					array(
						'name'  => esc_attr__( 'Inherit', 'dfd' ),
						'value' => 'inherit',
					),
					array(
						'name'  => esc_attr__( 'Scroll', 'dfd' ),
						'value' => 'scroll',
					),
					array(
						'name'  => esc_attr__( 'Fixed', 'dfd' ),
						'value' => 'fixed',
					),
				),
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Enable counter', 'dfd' ),
				'id'      => $prefix . 'enable_counter',
				'type'    => 'radio_inline',
				'options' => array(
					array(
						'name'  => esc_attr__( 'Inherit from theme options', 'dfd' ),
						'value' => '',
					),
					array(
						'name'  => esc_attr__( 'On', 'dfd' ),
						'value' => 'on',
					),
					array(
						'name'  => esc_attr__( 'Off', 'dfd' ),
						'value' => 'off',
					),
				),
			),
			array(
				'name'    => esc_attr__( 'Preloader style', 'dfd' ),
				'id'      => $prefix . 'style',
				'type'    => 'select',
				'options' => array(
					array(
						'name'  => esc_attr__( 'Inherit from options', 'dfd' ),
						'value' => '',
					),
					array(
						'name'  => esc_attr__( 'None', 'dfd' ),
						'value' => 'none',
					),
					array(
						'name'  => esc_attr__( 'CSS Animetion', 'dfd' ),
						'value' => 'css_animation',
					),
					array(
						'name'  => esc_attr__( 'Image', 'dfd' ),
						'value' => 'image',
					),
					array(
						'name'  => esc_attr__( 'Progress bar', 'dfd' ),
						'value' => 'progress_bar',
					),
				),
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Animation style', 'dfd' ),
				'id'      => $prefix . 'animation_style',
				'type'    => 'select',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'css_animation',
				'options' => dfd_preloader_animation_style_cmb(),
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Animation base color', 'dfd' ),
				'desc'    => '',
				'id'      => $prefix . 'animation_color',
				'type'    => 'colorpicker',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'css_animation',
				'save_id' => false,
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Preloader image', 'dfd' ),
				'desc'    => '',
				'id'      => $prefix . 'img',
				'type'    => 'file',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'image',
				'save_id' => false,
				'std'     => '',
			),
			array(
				'name' => esc_attr__( 'Preloader bar height', 'dfd' ),
				'desc' => '',
				'id'   => $prefix . 'bar_height',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
				'type' => 'text',
			),
			array(
				'name'    => esc_attr__( 'Preloader bar background color', 'dfd' ),
				'desc'    => '',
				'id'      => $prefix . 'bar_bg',
				'type'    => 'colorpicker',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
				'save_id' => false,
				'std'     => '',
			),
			array(
				'name' => esc_attr__( 'Preloader bar opacity', 'dfd' ),
				'desc' => esc_attr__( 'Please enter value from 1 to 100 here to change bar background opacity', 'dfd' ),
				'id'   => $prefix . 'bar_opacity',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
				'type' => 'text',
			),
			array(
				'name'    => esc_attr__( 'Preloader bar position', 'dfd' ),
				'id'      => $prefix . 'bar_position',
				'type'    => 'select',
				'options' => array(
					array(
						'name'  => esc_attr__( 'Middle', 'dfd' ),
						'value' => 'middle',
					),
					array(
						'name'  => esc_attr__( 'Top', 'dfd' ),
						'value' => 'top',
					),
					array(
						'name'  => esc_attr__( 'Bottom', 'dfd' ),
						'value' => 'bottom',
					),
				),
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
				'std'     => '',
			),
		),
	);

	return $meta_boxes;
}
