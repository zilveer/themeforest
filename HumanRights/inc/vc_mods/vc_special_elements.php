<?php
/*------------------------------------------------------*/
/* CUSTOM HEADING
/*------------------------------------------------------*/
vc_map( array(
	"name"                      => __("Custom Heading", "js_composer"),
	"base"                      => 'wpc_custom_heading',
	"icon"                      => "",
	"show_settings_on_create"   => true,
	"category"                  => __('WPC Elements', 'js_composer'),
	//"description"               => __('Restaurant menu heading', 'js_composer'),
	'save_always' 				=> true,
	"params"                    => array(
		array(
			'type'        => 'textarea',
			'holder'      => 'h2',
			'heading'     => __( 'Heading', 'js_composer' ),
			'param_name'  => 'heading',
			'admin_label' => true,
			'value'       => '',
			'description' => __('Custom heading, allow simple HTML code.', 'js_composer')
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => __("Heading Color","js_composer"),
			"param_name" => "heading_color",
			"value"      => ""
		),
		array(
			"type"        => "checkbox",
			"class"       => "",
			"heading"     => __("Display a colored line below heading?","js_composer"),
			"value"       => array( __("Yes.","js_composer") => "yes" ),
			"param_name"  => "colored_line",
			"description" => ""
		),

		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Custom Line Color', 'js_composer' ),
			'param_name'         => 'line_color',
			'description'        => __( 'Heading custom line color.', 'js_composer' ),
			'value'              => array(
				__("Primary Color", "js_composer")   => "primary",
				__("Secondary Color", "js_composer") => "secondary",
				__("Custom Color", "js_composer") => "custom",
			)
		),
		array(
			"type"       => "colorpicker",
			"class"      => "",
			"heading"    => __("Custom Line Color","js_composer"),
			"param_name" => "line_custom_color",
			"value"      => "",
			"dependency" => Array('element' => "line_color", 'value' => array('custom'))
		),

		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Heading Position', 'js_composer' ),
			'param_name'  => 'position',
			'value'       => array(
				__("Left", "js_composer")   => "left",
				__("Center", "js_composer") => "center",
				__("Right", "js_composer")  => "right"
			)
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Custom Margin Top","js_composer"),
			"param_name"	=> "margin_top",
			"value"			=> "",
			"description" 	=> "Don't include \"px\" in your string. e.g \"50\"",
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __("Custom Margin Bottom","js_composer"),
			"param_name"	=> "margin_bottom",
			"value"			=> "",
			"description" 	=> "Don't include \"px\" in your string. e.g \"50\"",
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'js_composer' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
) );
function wpc_shortcode_custom_heading($atts, $content = null) {
	// extract(shortcode_atts(array(
	// 	'heading'           => '',
	// 	'heading_color'     => '',
	// 	'colored_line'      => '',
	// 	'line_color'        => '',
	// 	'line_custom_color' => '',
	// 	'position'          => '',
	// 	'margin_top'        => '',
	// 	'margin_bottom'     => '',
	// 	'el_class'          => ''
	// ), $atts));
	$atts = vc_map_get_attributes( 'wpc_custom_heading', $atts );
	extract( $atts );

	$heading_style_color = '';
	if ( $heading_color ) {
		$heading_style_color = ' style="color: '. $heading_color .';"';
	}

	$extract_class = '';
	if ( $el_class ) $extract_class = $el_class;

	$position_class = '';
	if ( $position == 'right' ) $position_class = ' text-right';
	if ( $position == 'center' ) $position_class = ' text-center';

	// Custom Style
	$custom_styles = array();
		if ( $margin_top ) {
			$custom_styles[] = 'margin-top: ' . intval($margin_top) . 'px;';
		}
		if ( $margin_bottom ) {
			$custom_styles[] = 'margin-bottom: ' . intval($margin_bottom) . 'px;';
		}
	$custom_styles = implode('', $custom_styles);
	if ( $custom_styles ) {
		$custom_styles = wp_kses( $custom_styles, array() );
		$custom_styles = ' style="' . esc_attr($custom_styles) . '"';
	}

	$line_class = '';
	$line_color_custom = '';
	if ( $line_color == 'primary' ) {
		$line_class = 'primary';
	} 
	if ( $line_color == 'secondary' ) {
		$line_class = 'secondary';
	} 
	if ( $line_color == 'custom' ) {
		$line_class = '';
	} 

	if ( $line_custom_color && $line_color == 'custom' ) $line_color_custom = 'style="background-color: '. $line_custom_color .'"';

	$output = null;

	$output .= '
	<div class="custom-heading wpb_content_element '. $extract_class . $position_class .'"'. $custom_styles .'>';

		if ( $heading ) $output .= '
		<h2 class="heading-title" '. $heading_style_color .'>'. wp_kses_post($heading) .'</h2>';

		if ( $colored_line ) $output .= '
		<span class="heading-line '. $line_class .'"'. $line_color_custom .'></span>';

	$output .= '
	</div>';

	return $output;
}
add_shortcode('wpc_custom_heading', 'wpc_shortcode_custom_heading');