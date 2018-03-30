<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Video
vc_map(
	array(
		'name' => __( 'Video', 'wolf' ),
		'base' => 'wolf_video',
		'icon' => 'wolf-vc-icon wolf-vc-videos',
		'category' => 'by WolfThemes',
		'allowed_container_element' => 'vc_row',
		'params' => array(

			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => __( 'Video URL', 'wolf' ),
				'param_name' => 'url',
				'value' => '',
				'description' => sprintf( __( 'Link to the video. More about supported formats at <a href="%s" target="_blank">WordPress codex page.</a>', 'wolf' ), 'http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' ),
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
		),
	)
);