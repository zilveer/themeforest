<?php
/**
 * Style Kit group definitions.
 *
 * @since Listify 1.5.0
 */
$groups = array(
	'default' => array(
		'title' => __( 'Original', 'listify' ),
		'controls' => array(
			'color-scheme' => 'default',
			'typography-font-pack' => 'montserrat',
			'color-content-background' => '#ffffff',
			'color-content-border' => '#ffffff',
			'content-box-style' => 'default',
			'content-button-style' => 'default'
		)
	),
	'classic' => array(
		'title' => __( 'Classic', 'listify' ),
		'controls' => array(
			'color-scheme' => 'classic',
			'typography-font-pack' => 'karla',
			'content-box-style' => 'minimal',
			'content-button-style' => 'solid',
			'map-appearance-scheme' => 'blue-water',
			'fixed-header' => true,
			'nav-secondary' => false
		)
	),
	'iced-coffee' => array(
		'title' => __( 'Iced Coffee', 'listify' ),
		'controls' => array(
			'color-scheme' => 'iced-coffee',
			'typography-font-pack' => 'lato',
			'color-content-background' => '#ffffff',
			'color-content-border' => '#ffffff',
			'content-box-style' => 'shadow',
			'content-button-style' => 'solid'
		)
	),
	'radical-red' => array(
		'title' => __( 'Radical Red', 'listify' ),
		'controls' => array(
			'color-scheme' => 'radical-red',
			'typography-font-pack' => 'karla',
			'color-content-background' => '#ffffff',
			'color-content-border' => '#dcdcdc',
			'content-box-style' => 'minimal',
			'content-button-style' => 'solid',
		)
	),
	'green-flash' => array(
		'title' => __( 'Green Flash', 'listify' ),
		'controls' => array(
			'color-scheme' => 'green-flash',
			'typography-font-pack' => 'varela-round',
			'color-content-background' => '#fcfdff',
			'color-content-border' => '#e3eaf4',
			'content-box-style' => 'default',
			'content-button-style' => 'outline',
		)
	),
	'ultra-dark' => array(
		'title' => __( 'Ultra Dark', 'listify' ),
		'controls' => array(
			'color-scheme' => 'ultra-dark',
			'map-appearance-scheme' => 'dark',
			'typography-font-pack' => 'karla',
			'color-content-background' => '#292932',
			'color-content-border' => '#292932',
			'content-box-style' => 'minimal',
			'content-button-style' => 'solid',
		)
	)
);

return $groups;
