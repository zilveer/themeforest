<?php
function couponxl_button_func( $atts, $content ){
	extract( shortcode_atts( array(
		'text' => '',
		'link' => '',
		'target' => '',
		'bg_color' => '',
		'bg_color_hvr' => '',
		'font_color' => '',
		'font_color_hvr' => '',
	), $atts ) );

	$rnd = couponxl_random_string();

	$style_css = '
	<style>
		a.'.$rnd.', a.'.$rnd.':active, a.'.$rnd.':visited, a.'.$rnd.':focus{
			'.( !empty( $bg_color ) ? 'background-color: '.$bg_color.';' : '' ).'
			'.( !empty( $font_color ) ? 'color: '.$font_color.';' : '' ).'
		}
		a.'.$rnd.':hover{
			'.( !empty( $bg_color_hvr ) ? 'background-color: '.$bg_color_hvr.';' : '' ).'
			'.( !empty( $font_color_hvr ) ? 'color: '.$font_color_hvr.';' : '' ).'
		}		
	</style>
	';

	return couponxl_shortcode_style( $style_css ).'
		<a href="'.esc_url( $link ).'" class="btn btn-default '.$rnd.'" target="'.esc_attr( $target ).'">
			'.$text.'
		</a>';
}

add_shortcode( 'button', 'couponxl_button_func' );

function couponxl_button_params(){
	return array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Text","couponxl"),
			"param_name" => "text",
			"value" => '',
			"description" => __("Input button text.","couponxl")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Link","couponxl"),
			"param_name" => "link",
			"value" => '',
			"description" => __("Input button link.","couponxl")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Select Window","couponxl"),
			"param_name" => "target",
			"value" => array(
				__( 'Same Window', 'couponxl' ) => '_self',
				__( 'New Window', 'couponxl' ) => '_blank',
			),
			"description" => __("Select window where to open the link.","couponxl")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Background Color","couponxl"),
			"param_name" => "bg_color",
			"value" => '',
			"description" => __("Select button background color.","couponxl")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Background Color On Hover","couponxl"),
			"param_name" => "bg_color_hvr",
			"value" => '',
			"description" => __("Select button background color on hover.","couponxl")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Font Color","couponxl"),
			"param_name" => "font_color",
			"value" => '',
			"description" => __("Select button font color.","couponxl")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Font Color On Hover","couponxl"),
			"param_name" => "font_color_hvr",
			"value" => '',
			"description" => __("Select button font color on hover.","couponxl")
		),
	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Button", 'couponxl'),
	   "base" => "button",
	   "category" => __('Content', 'couponxl'),
	   "params" => couponxl_button_params()
	) );
}

?>