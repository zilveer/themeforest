<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Count Down
vc_map(
	array(
		'name' => __( 'Count down', 'wolf' ),
		'base' => 'wolf_countdown',
		'category' => 'by WolfThemes',
		'icon' => 'wolf-vc-icon wolf-vc-count-down',
		'allowed_container_element' => 'vc_row',
		'params' => array(

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Date', 'wolf' ),
				'param_name' => 'date',
				'description' => __( 'formatted like 12/24/2020 12:00:00', 'wolf' ),
				'value' => '',
			),

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'UTC Timezone offset', 'wolf' ),
				'param_name' => 'offset',
				'description' => __( 'e.g : -5 for NY', 'wolf' ),
				'value' => '',
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

			// array(
			// 	'type' => 'textfield',
			// 	'holder' => 'div',
			// 	'class' => '',
			// 	'heading' => __( 'Message when it\'s over', 'wolf' ),
			// 	'param_name' => 'message',
			// 	'value' => __( 'Done!', 'wolf' ),
			// ),
		)
	)
);