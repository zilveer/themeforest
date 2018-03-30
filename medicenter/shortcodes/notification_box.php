<?php
//dropcap
function theme_notification_box($atts)
{
	extract(shortcode_atts(array(
		"header" => "Sample Header",
		"info_text" => "",
		"type" => "success",
		"closing_time" => "",
		"custom_background_color" => "",
		"header_color" => "",
		"content_text_color" => "",
		"class" => "",
		"top_margin" => "page_margin_top"
	), $atts));
	
	$output = '<div class="notification_box nb_' . $type . ($top_margin!="none" ? ' ' . $top_margin : '') . '"' . ($custom_background_color!="" ? ' style="background-color:' . $custom_background_color . ';"' : '') . '><h2' . ($header_color!="" ? ' style="color:' . $header_color . ';"' : '') . '>' . $header . '</h2>';
	if($info_text!="")
		$output .= '<h5' . ($content_text_color!="" ? ' style="color:' . $content_text_color . ';"' : '') . '>' . $info_text . '</h5>';
	$output .= '</div>';
	if((int)$closing_time>0)
		$output .= '<div class="clearfix"><span class="closing_in">' . __("Closing in ", 'medicenter') . '<span class="seconds">' . $closing_time . '</span>' . __(" sec...", 'medicenter') . '</span></div>';

	return $output;
}
add_shortcode("notification_box", "theme_notification_box");
//visual composer
$mc_colors_arr = array(__("Dark blue", "js_composer") => "#3156a3", __("Blue", "js_composer") => "#0384ce", __("Light blue", "js_composer") => "#42b3e5", __("Black", "js_composer") => "#000000", __("Gray", "js_composer") => "#AAAAAA", __("Dark gray", "js_composer") => "#444444", __("Light gray", "js_composer") => "#CCCCCC", __("Green", "js_composer") => "#43a140", __("Dark green", "js_composer") => "#008238", __("Light green", "js_composer") => "#7cba3d", __("Orange", "js_composer") => "#f17800", __("Dark orange", "js_composer") => "#cb451b", __("Light orange", "js_composer") => "#ffa800", __("Red", "js_composer") => "#db5237", __("Dark red", "js_composer") => "#c03427", __("Light red", "js_composer") => "#f37548", __("Turquoise", "js_composer") => "#0097b5", __("Dark turquoise", "js_composer") => "#006688", __("Light turquoise", "js_composer") => "#00b6cc", __("Violet", "js_composer") => "#6969b3", __("Dark violet", "js_composer") => "#3e4c94", __("Light violet", "js_composer") => "#9187c4", __("White", "js_composer") => "#FFFFFF", __("Yellow", "js_composer") => "#fec110");
vc_map( array(
	"name" => __("Notification box", 'medicenter'),
	"base" => "notification_box",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-notification-box",
	"category" => __('MediCenter', 'medicenter'),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Header", 'medicenter'),
			"param_name" => "header",
			"value" => "Sample Header"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Info text", 'medicenter'),
			"param_name" => "info_text",
			"value" => ""
		),
		array(
            "type" => "dropdown",
            "heading" => __("Type", "medicenter"),
            "param_name" => "type",
            "value" => array(__("Success", 'medicenter') => "success", __("Error", 'medicenter') => "error", __("Info", 'medicenter') => "info")
        ),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Auto closing time (in seconds)", 'medicenter'),
			"param_name" => "closing_time",
			"value" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Custom background color", 'medicenter'),
			"param_name" => "custom_background_color",
			"value" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Header text color", 'medicenter'),
			"param_name" => "header_color",
			"value" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content text color", 'medicenter'),
			"param_name" => "content_text_color",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Extra class name", 'medicenter'),
			"param_name" => "class",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section", __("None", 'medicenter') => "none")
		)
	)
));
?>