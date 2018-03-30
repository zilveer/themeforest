<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$font_list = array( __( 'Default heading font', 'wolf' ) => '' );
global $animations, $wolf_fonts;

foreach ( $wolf_fonts as $key => $value ) {
	$font_list[$key] = $key;
}

// Fittext
vc_map(
	array(
		'name' => __( 'Headline', 'wolf' ),
		'base' => 'wolf_fittext',
		'category' => 'by WolfThemes',
		'icon' => 'wolf-vc-icon wolf-vc-fittext',
		'allowed_container_element' => 'vc_row',
		'params' => array(

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Maximum font size', 'wolf' ),
				'param_name' => 'max_font_size',
				'value' => 72,
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Text', 'wolf' ),
				'param_name' => 'text',
				'value' => __( 'My Headline', 'wolf' ),
			),

			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __( 'Tag', 'wolf' ),
				'param_name' => 'title_tag',
				'value' => array(
					//'span' => 'span',
					'h5' => 'h5',
					'h4' => 'h4',
					'h3' => 'h3',
					'h2' => 'h2',
					'h1' => 'h1',
				),
				// 'description' => '',
			),

			array(
				'type' => 'colorpicker',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Text color', 'wolf' ),
				'param_name' => 'color',
				'value' => '',
			),


			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Font weight', 'wolf' ),
				'param_name' => 'font_weight',
				'value' => 700,
			),

			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __( 'Text transform', 'wolf' ),
				'param_name' => 'text_transform',
				'value' => array(
					__( 'uppercase', 'wolf' ) => 'uppercase',
					__( 'none', 'wolf' ) => 'none',

				),
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Letter spacing', 'wolf' ),
				'param_name' => 'letter_spacing',
				'value' => 0,
			),

			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Font', 'wolf' ),
				'param_name' => 'font_family',
				'value' => $font_list,
				// 'description' => '',
			),

			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Animation', 'wolf' ),
				'description' => '',
				'param_name' => 'animation',
				'value' => $animations,
				'description' => '',
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Animation delay (in ms)', 'wolf' ),
				'param_name' => 'animation_delay',
				'value' => '',
				'description' => '',
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Inline style', 'wolf' ),
				'param_name' => 'inline_style',
				'description' => __( 'Additional inline CSS style', 'wolf' ),
				'value' => '',
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Extra class', 'wolf' ),
				'param_name' => 'class',
				'description' => __( 'Optional additional CSS class to add to the element', 'wolf' ),
				'value' => '',
			),
		)
	)
);