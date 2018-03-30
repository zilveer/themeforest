<?php 
/*DROPCAP*/
add_shortcode('oi_dropcap', 'oi_dropcap_f');
function oi_dropcap_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'oi_letter' => '',
			'oi_letter_c' => '',
			'oi_letter_s' => '',
			'oi_letter_p' => '',
			'oi_letter_border' => '',
			'oi_letter_bg' => '',
		), $atts)
	);
	$output ='<span class="oi_dropcap" style="font-size:'.$oi_letter_s.'; line-height:'.$oi_letter_s.'; color:'.$oi_letter_c.'; padding:'.$oi_letter_p.'; border-radius:'.$oi_letter_border.'; background-color:'.$oi_letter_bg.';">'.$oi_letter.'</span>';
	return $output;
};

/*DROPCAP*/
vc_map( array(
	"name" => __("DROPCAP",'orangeidea'),
	"base" => "oi_dropcap",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"icon" => "oi_icon_dropcap",
	"category" => __('BUILDER','orangeidea'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_letter",
			"heading" => __("Letter", "orangeidea"),
			"value" => 'A',
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_letter_s",
			"heading" => __("Letter Size", "orangeidea"),
			"value" => '16px',
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_letter_p",
			"heading" => __("Letter Padding", "orangeidea"),
			"value" => '24px',
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_letter_border",
			"heading" => __("Letter Border Radius", "orangeidea"),
			"value" => '',
		),
		
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_letter_c",
			"heading" => __("Letter Color", "orangeidea"),
			"value" => '#000',
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_letter_bg",
			"heading" => __("Letter Background", "orangeidea"),
			"value" => '',
		),
		
		
		
	)
) );


