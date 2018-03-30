<?php

/*************
 * Header Dropdown Style
 *************/

Flatsome_Option::add_section( 'header_dropdown', array(
	'title'       => __( 'Dropdown Style', 'flatsome-admin' ),
	'panel'       => 'header',
) );


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color-alpha',
    'settings'     => 'dropdown_bg',
    'transport' => 'postMessage',
    'label'       => __( 'Background color', 'flatsome-admin' ),
    'section'     => 'header_dropdown',
	'default'     => '',
));


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color-alpha',
    'settings'     => 'dropdown_border',
    'transport' => 'postMessage',
    'label'       => __( 'Border Color', 'flatsome-admin' ),
    'section'     => 'header_dropdown',
	'default'     => '',
));



Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'dropdown_text',
    'label'       => __( 'Text Color', 'flatsome-admin' ),
    'section'     => 'header_dropdown',
    'transport' => 'postMessage',
	'default'     => 'light',
	'choices'     => array(
		'light' => __( 'Dark', 'flatsome-admin' ),
		'dark' => __( 'Light', 'flatsome-admin' ),
	),
));

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'dropdown_style',
	'transport' => 'postMessage',
	'label'       => __( 'Link Style', 'flatsome-admin' ),
	'section'     => 'header_dropdown',
	'default'     => 'default',
	'choices'     => array(
		'simple' => $image_url . 'dropdown-style-1.svg',
		'default' => $image_url . 'dropdown-style-2.svg',
		'bold' => $image_url . 'dropdown-style-3.svg'
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'dropdown_text_style',
	'transport' => 'postMessage',
    'label'       => __( 'Text Style', 'flatsome-admin' ),
    'section'     => 'header_dropdown',
	'default'     => 'simple',
	'choices'     => array(
		'simple' => __( 'Simple', 'flatsome-admin' ),
		'uppercase' => __( 'UPPERCASE', 'flatsome-admin' ),
	),
));