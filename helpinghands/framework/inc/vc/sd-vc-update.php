<?php
/**
 * Update Visual Composer Parameters
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
// Row
$row_atts = array (
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Center content?', 'sd-framework' ),
		'param_name' => 'centered',
		'value'      => array(
							__( 'No', 'sd-framework' )  => 'no',
							__( 'Yes', 'sd-framework' ) => 'yes',
							),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Margin Top', 'sd-framework' ),
		'param_name'  => 'sd_margin_top',
		'description' => __( 'eg. 20px', 'sd-framework' ),
		'group'       => __( 'Margin', 'sd-framework' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Margin Bottom', 'sd-framework' ),
		'param_name'  => 'sd_margin_bottom',
		'description' => __( 'eg. 20px', 'sd-framework' ),
		'group'       => __( 'Margin', 'sd-framework' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Padding Top', 'sd-framework' ),
		'param_name'  => 'padding_top',
		'description' => __( 'eg. 20px', 'sd-framework' ),
		'group'       => __( 'Padding', 'sd-framework' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Padding Right', 'sd-framework' ),
		'param_name'  => 'padding_right',
		'description' => __( 'eg. 20px', 'sd-framework' ),
		'group'       => __( 'Padding', 'sd-framework' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Padding Bottom', 'sd-framework' ),
		'param_name'  => 'padding_bottom',
		'description' => __( 'eg. 20px', 'sd-framework' ),
		'group'       => __( 'Padding', 'sd-framework' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Padding Left', 'sd-framework' ),
		'param_name'  => 'padding_left',
		'description' => __( 'eg. 20px', 'sd-framework' ),
		'group'       => __( 'Padding', 'sd-framework' ),
	),
	array(
		'type'       => "colorpicker",
		'heading'    => __( 'Border Color', 'sd-framework' ),
		'param_name' => 'border_color',
		'value'      => '',
		'group'      => __( 'Border', 'sd-framework' ),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Border Style', 'sd-framework' ),
		'param_name' => 'border_style',
		'value'      => array( 
							__( 'None', 'sd-framework' )   => 'none', 
							__( 'Solid', 'sd-framework' )  => 'solid',
							__( 'Dotted', 'sd-framework' ) => 'dotted',
							__( 'Dashed', 'sd-framework' ) => 'dashed',
						),
		'group'      => __( 'Border', 'sd-framework' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Border Width', 'sd-framework' ),
		'param_name'  => 'border_width',
		'description' => __( 'The width of your border. (eg. 1px 1px 1px 1px) Note: the widths are in this order: top right bottom left', 'sd-framework' ),
		'group'       => __( 'Border', 'sd-framework' )
	),
);

vc_add_params( 'vc_row', $row_atts );

// Separator

$separator_atts = array(
	 array(
		'type'        => 'textfield',
		'heading'     => __( 'Margin Top', 'sd-framework' ),
		'description' => __( 'Insert the top margin of the separator in pixels. (eg. 20px)', 'sd-framework' ),
		'param_name'  => 'margintop',
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Margin Bottom', 'sd-framework' ),
		'description' => __( 'Insert the bottom margin of the separator in pixels. (eg. 20px)', 'sd-framework' ),
		'value'       => '0',
		'param_name'  => 'marginbottom',
	),
);

vc_add_params( 'vc_separator', $separator_atts );

// Separator text
$text_separator_atts = array(
	array(
		'type'        => 'dropdown',
		'heading'     => __( 'Heading Type', 'sd-framework' ),
		'description' => __( 'Insert the bottom margin of the separator in pixels (eg. 20px)', 'sd-framework' ),
		'value'       => array( "h2", "h3", "h4", "h5", "h6" ),
		'param_name'  => 'heading'
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Margin Top', 'sd-framework' ),
		'description' => __( 'Insert the top margin of the separator in pixels (eg. 20px)', 'sd-framework' ),
		'value'       => '0',
		'param_name'  => 'margintop'
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Margin Bottom', 'sd-framework' ),
		'description' => __( 'Insert the bottom margin of the separator in pixels (eg. 20px)', 'sd-framework' ),
		'value'	      => '20px',
		'param_name'  => 'marginbottom'
	)
);

vc_add_params( 'vc_text_separator', $text_separator_atts );

// Icons

$icon_atts = array(

	array(
		'type'       => "colorpicker",
		'heading'    => __( 'Icon Color', 'sd-framework' ),
		'param_name' => 'color',
		'group'      => __( 'Styling', 'sd-framework' ),
		'value'      => '#5e8cc0',
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Background Styling', 'sd-framework' ),
		'param_name' => 'background_style',
		'value'      => array( 
							__( 'None', 'sd-framework' )                    => 'none',
							__( 'Rounded', 'sd-framework' )                 => 'rounded',
							__( 'Square', 'sd-framework' )                  => 'square',
							__( 'Rounded Square', 'sd-framework' )          => 'rounded-square',
							__( 'Outlined Rounded', 'sd-framework' )        => 'outlined-rounded',
							__( 'Outlined Square', 'sd-framework' )         => 'outlined-square',
							__( 'Outlined Rounded Square', 'sd-framework' ) => 'outlined-rounded-square',
							),
		'group'       => __( 'Styling', 'sd-framework' ),
		'description' => __( 'Select the background type.', 'sd-framework' ),
	),
	array(
		'type'        => "textfield",
		'heading'     => __( 'Radius', 'sd-framework' ),
		'param_name'  => 'radius',
		'value'       => '5px',
		'description' => __( 'If rounded square or outlined rounded square is selected.', 'sd-framework' ),
		'group'       => __( 'Styling', 'sd-framework' ),
		'dependency'  => array(
							'element' => 'background_style',
							'value'	  => array( 'rounded-square', 'outlined-rounded-square' ),
							),
	),
	array(
		'type'        => "textfield",
		'heading'     => __( 'Icon Padding', 'sd-framework' ),
		'param_name'  => 'icon_padding',
		'value'       => '20px',
		'description' => __( 'If any background style is selected except "none".', 'sd-framework' ),
		'group'       => __( 'Styling', 'sd-framework' ),
		'dependency'  => array(
							'element' => 'background_style',
							'value'	  => array( 'rounded', 'square', 'rounded-square', 'outlined-rounded', 'outlined-square', 'outlined-rounded-square' ),
							),
	),
	array(
		'type'        => "textfield",
		'heading'     => __( 'Icon Line Height', 'sd-framework' ),
		'param_name'  => 'icon_line_height',
		'value'       => '24px',
		'description' => __( 'Select the line-height of the icon (optional).', 'sd-framework' ),
		'group'       => __( 'Styling', 'sd-framework' ),
	),
	array(
		'type'        => "textfield",
		'heading'     => __( 'Border Width', 'sd-framework' ),
		'param_name'  => 'border_width',
		'value'       => '2px',
		'description' => __( 'If outlined style is selected.', 'sd-framework' ),
		'group'       => __( 'Styling', 'sd-framework' ),
		'dependency'  => array(
							'element' => 'background_style',
							'value'	  => array( 'outlined-rounded', 'outlined-square', 'outlined-rounded-square' ),
							),
	),
	array(
		'type'       => "colorpicker",
		'heading'    => __( 'Background Color', 'sd-framework' ),
		'param_name' => 'background_color',
		'group'      => __( 'Styling', 'sd-framework' ),
		'value'      => '',
	),
	array(
		'type'       => "textfield",
		'heading'    => __( 'Icon Size', 'sd-framework' ),
		'param_name' => 'size',
		'group'      => __( 'Styling', 'sd-framework' ),
		'value'      => '24px',
	),
	array(
		'type'        => 'dropdown',
		'heading'     => __( 'Icon Align', 'sd-framework' ),
		'param_name'  => 'align',
		'value'       => array( 'left', 'center', 'right' ),
		'group'       => __( 'Styling', 'sd-framework' ),
		'description' => __( 'Select the icon alignment.', 'sd-framework' ),
	),
	array(
		'type'        => "textfield",
		'heading'     => __( 'Padding Left', 'sd-framework' ),
		'param_name'  => 'padding_left',
		'value'       => '35px',
		'description' => __( 'If left align is selected.', 'sd-framework' ),
		'group'       => __( 'Styling', 'sd-framework' ),
		'dependency'  => array(
							'element' => 'align',
							'value'	  => array( 'left' ),
							),
	),
	array(
		'type'        => "textfield",
		'heading'     => __( 'Padding Right', 'sd-framework' ),
		'param_name'  => 'padding_right',
		'value'       => '35px',
		'description' => __( 'If right align is selected.', 'sd-framework' ),
		'group'       => __( 'Styling', 'sd-framework' ),
		'dependency'  => array(
							'element' => 'align',
							'value'	  => array( 'right' ),
							),
	),
	array(
		'type'       => "textfield",
		'heading'    => __( 'Title', 'sd-framework' ),
		'param_name' => 'title',
		'group'		 => __( 'Content', 'sd-framework' ),
		'value'      => '',
	),
	array(
		'type'        => 'dropdown',
		'heading'     => __( 'Heading', 'sd-framework' ),
		'param_name'  => 'heading',
		'value'       => array( 'none', 'h2', 'h3', 'h4', 'h5', 'h6' ),
		'group'       => __( 'Content', 'sd-framework' ),
		'description' => __( 'Select the heading type.', 'sd-framework' ),
	),
	array(
		'type'       => "textarea_html",
		'heading'    => __( 'Text content (optional)', 'sd-framework' ),
		'param_name' => 'content',
		'group'      => __( 'Content', 'sd-framework' ),
		'value'      => '',
	)
);

vc_add_params( 'vc_icon', $icon_atts );

// Custom Heading

$custom_heading_atts = array(
	 array(
		'type'        => 'textfield',
		'heading'     => __( 'Margin Top', 'sd-framework' ),
		'description' => __( 'Insert the top margin of the separator in pixels. (eg. 20px)', 'sd-framework' ),
		'param_name'  => 'margintop',
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Margin Top', 'sd-framework' ),
		'description' => __( 'Insert the top margin of the separator in pixels. (eg. 20px)', 'sd-framework' ),
		'param_name'  => 'margintop',
	),
);

vc_add_params( 'vc_custom_heading', $custom_heading_atts );