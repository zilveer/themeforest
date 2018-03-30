<?php
//items list
function theme_items_list($atts, $content)
{
	extract(shortcode_atts(array(
		"class" => "",
		"color" => "",
		"type" => "",
		"top_margin" => "page_margin_top_none"
	), $atts));
	
	$output = '
	<ul class="' . ($type!='simple' ? 'items_': '') . 'list' . ($color!='' ? ' ' . $color : '') . ($class!='' ? ' ' . $class : '') . ' ' . $top_margin . '">
		' . do_shortcode($content) . '
	</ul>';
	return $output;
}
add_shortcode("items_list", "theme_items_list");

//visual composer
vc_map( array(
	"name" => __("Items list", 'gymbase'),
	"base" => "items_list",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-items-list",
	"category" => __('GymBase', 'gymbase'),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra class name", 'gymbase'),
			"param_name" => "class",
			"description" => __("Specifies the custom css class for the list.", 'gymbase'),
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'gymbase'),
			"param_name" => "type",
			"value" => array(__("Normal", 'gymbase') => 'normal', __("Simple", 'gymbase') => 'simple')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Color", 'gymbase'),
			"param_name" => "color",
			"value" => array(__("Light green", 'gymbase') => 'light_green', __("Green", 'gymbase') => 'green',
				__("Gray", 'gymbase') => 'gray', __("Dark", 'gymbase') => 'dark')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "page_margin_top_none", __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section")
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'gymbase'),
			"param_name" => "content",
			"value" => ""
		),
		array(
			"type" => "listitem",
			"class" => "",
			"param_name" => "additembutton",
			"value" => "Add list item"
		),
		array(
			"type" => "listitemwindow",
			"class" => "",
			"param_name" => "additemwindow",
			"value" => ""
		)
	)
));
?>