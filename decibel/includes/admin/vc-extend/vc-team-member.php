<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $animations;

$args = array(
	'name' => __( 'Team member', 'wolf' ),
	'base' => 'wolf_team_member',
	'icon' => 'wolf-vc-icon wolf-vc-team-member',
	'category' => 'by WolfThemes',
	'allowed_container_element' => 'vc_row',
	'params' => array(

		array(
			'type' => 'single_image',
			'class' => '',
			'heading' => __( 'Photo', 'wolf' ),
			'param_name' => 'photo',
			'description' => sprintf( __( 'Minimum %s recommended', 'wolf' ), '960x960px' ),
			'value' => '',
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Image style', 'wolf' ),
			'param_name' => 'image_style',
			'value' => array(
				__( 'default', 'wolf' ) => 'default',
				__( 'portrait', 'wolf' ) => 'portrait',
				__( 'square', 'wolf' ) => '2x2',
				__( 'rounded', 'wolf' ) => 'round',
			),
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Text alignment', 'wolf' ),
			'param_name' => 'alignment',
			'value' => array(
				__( 'center', 'wolf' ) => 'center',
				__( 'left', 'wolf' ) => 'left',
				__( 'right', 'wolf' ) => 'right',
			),
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Name', 'wolf' ),
			'param_name' => 'name',
			'description' => '',
			'value' => '',
		),

		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Title tag', 'wolf' ),
			'param_name' => 'title_tag',
			'value' => array(
				'h3' => 'h3',
				'h1' => 'h1',
				'h2' => 'h2',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Role', 'wolf' ),
			'param_name' => 'role',
			'description' => '',
			'value' => '',
		),

		array(
			'type' => 'textarea',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Description', 'wolf' ),
			'param_name' => 'tagline',
			'description' => '',
			//'value' => '',
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
	)
);

global $team_member_socials;

foreach ( $team_member_socials as $social ) {
	$add = array(
		'type' => 'textfield',
		'holder' => 'div',
		'class' => '',
		'heading' => $social,
		'param_name' => $social,
		'description' => '',
		'value' => '',
	);

	array_push( $args['params'], $add);
}

vc_map( $args );