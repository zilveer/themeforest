<?php 
/*SIMPLE ICON*/
add_shortcode('oi_simple_icon', 'oi_simple_icon_f');
function oi_simple_icon_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'oi_icon' => '',
			'oi_icon_c' => '',
			'oi_icon_s' => '',
			'oi_align' => ''
		), $atts)
	);
	$output ='<div class="oi_simple_icon_'.$oi_align.'"><i class="fa fa-fw '.$oi_icon.'" style="font-size:'.$oi_icon_s.'; color:'.$oi_icon_c.'"></i></div>';
	return $output;
};
/*SIMPLE ICON*/
vc_map( array(
	"name" => __("SIMPLE ICON",'orangeidea'),
	"base" => "oi_simple_icon",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"icon" => "oi_icon_icon",
	"category" => __('BUILDER','orangeidea'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon",
			"heading" => __("Fontawesome Icon", "orangeidea"),
			"value" => 'fa-tree',
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_s",
			"heading" => __("Icon Size", "orangeidea"),
			"value" => '16px',
		),
		
		array(
			'type' => 'dropdown',
			'heading' => "Icon align",
			'param_name' => 'oi_align',
			'value' => array( "left", "right", "center"),
			'std' => 'left',
		),
		
		
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_c",
			"heading" => __("Icon Color", "orangeidea"),
			"value" => '#000',
		),
		
		
		
	)
) );

