<?php
/**
 *	Mapping Attributes
 *
 *	Laborator.co
 *	www.laborator.co
 */


# ! VC_ROW
$attributes = array(
	array(
		'type'        => 'checkbox',
		'heading'     => __( 'Wrap with a Container', 'lab_composer' ),
		'param_name'  => 'container_wrap',
		'description' => __( 'When using fullwidth page this setting will help you center the content with a container.', 'lab_composer' ),
		'value'       => array( __( 'Yes', 'lab_composer' ) => 'yes' ),
		'weight'	  => 1
	),
);

vc_add_params('vc_row', $attributes);



# ! VC_TAB
$attributes = array(
	array(
		'type'        => 'checkbox',
		'heading'     => __( 'Bordered', 'lab_composer' ),
		'param_name'  => 'bordered',
		'description' => __( 'Add borders to tab panels.', 'lab_composer' ),
		'value'       => array( __( 'Yes', 'lab_composer' ) => 'yes' )
	),
);

vc_add_params('vc_tabs', $attributes);


# ! VC_TOUR
$attributes = array(
	array(
		'type'        => 'dropdown',
		'heading'     => __( 'Tabs Alignment', 'lab_composer' ),
		'param_name'  => 'align_tabs',
		'value'       => array('Left' => 'left', 'Right' => 'right'),
		'std'		  => 'left',
		'description' => __( 'Set tabs to be aligned on left or right.', 'lab_composer' )
	),
);

vc_add_params('vc_tour', $attributes);



# ! VC_MESSAGE
vc_remove_param('vc_message', 'style');


# ! VC_BUTTON
$primary_colors = array(
	__( 'Default', 	'lab_composer' ) => 'btn-default',
	__( 'Primary', 	'lab_composer' ) => 'btn-primary',
	__( 'Success', 	'lab_composer' ) => 'btn-success',
	__( 'Info', 	'lab_composer' ) => 'btn-info',
	__( 'Warning', 	'lab_composer' ) => 'btn-warning',
	__( 'Danger',	'lab_composer' ) => 'btn-danger',
	__( 'Grey', 	'lab_composer' ) => 'wpb_button',
	__( 'Black', 	'lab_composer' ) => "btn-inverse"
);


$attribute_color = array(
	'type' => 'dropdown',
	'heading' => __( 'Color', 'lab_composer' ),
	'param_name' => 'color',
	'value' => $primary_colors,
	'description' => __( 'Button color.', 'lab_composer' ),
	'param_holder_class' => 'vc_colored-dropdown'
);

vc_update_shortcode_param('vc_button', $attribute_color);



# ! VC_TEXT_SEPARATOR
$attributes = array(
	array(
		'type'        => 'dropdown',
		'heading'     => __( 'Title Style', 'lab_composer' ),
		'param_name'  => 'title_style',
		'value'       => array(
			'Plain'          => 'plain',
			'Squared'        => 'squared',
			'Rounded'        => 'rounded',
			'Square Filled'  => 'squared-filled',
			'Rounded Filled' => 'rounded-filled',
		),
		'std'		  => 'plain',
		'description' => __( 'Choose the separator title style.', 'lab_composer' )
	),
/*

	array(
		'type' => 'colorpicker',
		'heading' => __( 'Fill Background Color', 'lab_composer' ),
		'param_name' => 'title_bg_color',
		'std' => 'rgba(0,0,0,1)',
		'description' => __( 'Set filling background for title container.', 'lab_composer' ),
		'dependency'  => array(
			'element' => 'title_style',
			'value'   => array( 'squared-filled', 'rounded-filled' )
		),
	),
*/

	array(
		'type' => 'colorpicker',
		'heading' => __( 'Title Text Color', 'lab_composer' ),
		'param_name' => 'title_text_color',
		'description' => __( 'Set text color for the title.', 'lab_composer' ),
		'std' => 'rgba(255,255,255,1)',
		'dependency'  => array(
			'element' => 'title_style',
			'value'   => array( 'squared-filled', 'rounded-filled' )
		),
	),

	array(
		'type' => 'checkbox',
		'heading' => __( 'Icon', 'lab_composer' ),
		'param_name' => 'use_icon',
		'description' => __( 'Prepend an icon to the title.', 'lab_composer' ),
		'value' => array( __( 'Yes', 'lab_composer' ) => 'yes' ),
	),


	array(
		"type" => "fontelloicon",
		"heading" => __("Separator Icon", 'lab_composer'),
		"param_name" => "icon",
		"value" => "heart",
		"description" => __("Select icon to show.", 'lab_composer'),
		'dependency' => array( 'element' => 'use_icon', 'not_empty' => true )
	),
);

$colors_arr = array(
	'Default'	   => 'default',
	'Blue'         => 'blue',
	'Turquoise'    => 'turquoise',
	'Pink'         => 'pink',
	'Violet'       => 'violet',
	'Peacoc'       => 'peacoc',
	'Chino'        => 'chino',
	'Mulled Wine'  => 'mulled_wine',
	'Vista Blue'   => 'vista_blue',
	'Black'        => 'black',
	#'Grey'         => 'grey',
	'Orange'       => 'orange',
	'Sky'          => 'sky',
	'Green'        => 'green',
	'Juicy pink'   => 'juicy_pink',
	'Sandy brown'  => 'sandy_brown',
	'Purple'       => 'purple',
	'White'        => 'white'
);

$attribute_color = array(
	'type'                 => 'dropdown',
	'heading'              => __( 'Color', 'lab_composer' ),
	'param_name'           => 'color',
	'value'                => array_merge( $colors_arr, array( __( 'Custom color', 'lab_composer' ) => 'custom' ) ),
	'std'                  => 'default',
	'description'          => __( 'Separator color.', 'lab_composer' ),
	'param_holder_class'   => 'vc_colored-dropdown'
);

$attribute_style = array(
	'type' => 'dropdown',
	'heading' => __( 'Style', 'lab_composer' ),
	'param_name' => 'style',
	'value' => array(
		'Double Bordered'     => 'double-border',
		'Double Bordered 2'   => 'double-border-2',
		'Thick' 		 	  => 'thick',
		'Thin'                => 'plain'
	),
	'description' => __( 'Separator style.', 'lab_composer' )
);

vc_update_shortcode_param('vc_text_separator', $attribute_color);
vc_update_shortcode_param('vc_text_separator', $attribute_style);

vc_remove_param('vc_text_separator', 'el_width');

vc_add_params('vc_text_separator', $attributes);