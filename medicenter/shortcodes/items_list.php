<?php
//items list
function theme_items_list($atts, $content)
{
	extract(shortcode_atts(array(
		"id" => "scrolling_list_0",
		"type" => "items",
		"header" => "",
		"animation" => 0,
		"class" => "",
		"color" => "",
		"read_more" => 0,
		"button_label" => "",
		"button_url" => "",
		"top_margin_header" => "page_margin_top_section",
		"top_margin" => "page_margin_top"
	), $atts));
	
	$output = "";
	if($type=="scrolling")
	{
		$output .= '<div class="clearfix' . ($top_margin_header!="none" ? ' ' . $top_margin_header : '') . '">
		<div class="header_left">';
	}
	if($header!="")
		$output .= '<h3 class="box_header' . ((int)$animation ? ' animation-slide' : '') . ($top_margin_header!="none" && $type!="scrolling" ? ' ' . $top_margin_header : '') . '">' . $header . '</h3>';
	if($type=="scrolling")
	{
		$output .= '</div>
		<div class="header_right">
			<a href="#" id="' . $id . '_prev" class="scrolling_list_control_left icon_small_arrow left_black"></a>
			<a href="#" id="' . $id . '_next" class="scrolling_list_control_right icon_small_arrow right_black"></a>
		</div>
	</div>
	<div class="scrolling_list_wrapper">';
	}
	$output .= '<ul class="' . $type . '_list' . ($id!='' && $type=='scrolling' ? ' ' . $id : '') . ($color!='' ? ' ' . $color : '') . ($class!='' ? ' ' . $class : '') . ($top_margin!="none" ? ' ' . $top_margin : '') . ' clearfix">' . wpb_js_remove_wpautop($content) . '</ul>';
	if($type=="scrolling")
		$output .= '</div>';
	if((int)$read_more)
		$output .= '<div class="item_footer clearfix"><a class="more" href="' . $button_url . '" title="' . esc_attr($button_label) . '">' . $button_label . '</a></div>';
	return $output;
}
add_shortcode("items_list", "theme_items_list");

//items list
function theme_item($atts, $content)
{
	extract(shortcode_atts(array(
		"type" => "items",
		"icon" => "",
		"class" => "",
		"value" => "",
		"url" => "",
		"url_target" => "",
		"border_color" => "",
		"text_color" => "",
		"value_color" => ""
	), $atts));
	
	$output = "";
	if($type=="scrolling")
	{
		$output .= '<li class="' . ($icon!="" || $class!="" ? ($icon!="" ? 'icon_small_arrow ' . $icon . ' ': '') . ($class!="" ? $class . ' ' : '') : '') . 'clearfix"' . ($border_color!='' ? ' style="border-bottom: ' . ($border_color=='none' ? 'none' : '1px solid ' . $border_color . '') . ';"' : '') . '>
			' . ($url!="" ? '<a class="clearfix" href="' . esc_attr($url) . '"' . ($url_target=='new_window' ? ' target="_blank"' : '') . '>' : '') . '
			<span class="left"' . ($text_color!='' ? ' style="color: ' . $text_color . ';"' : '') . '>' . do_shortcode($content) . '</span>';
			if($value!="")
				$output .= '<span class="number"' . ($value_color!='' ? ' style="color: ' . $value_color . ';"' : '') . '>' . do_shortcode($value) . '</span>';
			if($url!="")
				$output .= '</a>';
		$output .= '</li>';
			/*<a class="clearfix" href="?page=post">
				<span class="left">
					Lorem ipsum dolor sit amat velum.
				</span>
				<span class="number">
					16
				</span>
			</a>
			<abbr class="timeago" title="04 Apr 2012">about a year ago</abbr>
		</li>*/
	}
	else
	{
		$output .= '<li class="' . ($icon!="" || $class!="" ? ($icon!="" ? 'icon_small_arrow ' . $icon . ' ': '') . ($class!="" ? $class . ' ' : '') : '') . 'clearfix"' . ($border_color!='' || ($text_color!='' && $type=='simple') ? ' style="' . ($border_color!='' ? 'border-bottom: ' . ($border_color=='none' ? 'none' : '1px solid ' . $border_color . '') . ';' : '') . ($text_color!='' && $type=='simple' ? 'color:' . $text_color . ';' : '') . '"' : '') . '>
			' . ($type!='simple' ? '<' . ($url!="" ? 'a href="' . esc_attr($url) . '"' . ($url_target=='new_window' ? ' target="_blank"' : '')  : ($type=='items' ? 'span' : $type='info' ? 'label' : '')) . ($text_color!='' ? ' style="color: ' . $text_color . ';"' : '') . '>' . do_shortcode($content) . '</' . ($url!="" ? "a" : ($type=='items' ? 'span' : $type='info' ? 'label' : '')) . '>' : ($url!="" ? '<a class="clearfix" href="' . esc_attr($url) . '"' . ($url_target=='new_window' ? ' target="_blank"' : '') . ($text_color!='' ? ' style="color: ' . $text_color . ';"' : '') . '>' : '') . do_shortcode($content) . ($url!="" ? '</a>' : ''));
			if($value!="")
				$output .= '<div class="' . ($type=='items' ? 'value' : $type='info' ? 'text' : '') . '"' . ($value_color!='' ? ' style="color: ' . $value_color . ';"' : '') . '>' . do_shortcode($value) . '</div>';
		$output .= '</li>';
	}
	return $output;
}
add_shortcode("item", "theme_item");

//visual composer
vc_map( array(
	"name" => __("Items list", 'medicenter'),
	"base" => "items_list",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-items-list",
	"category" => __('MediCenter', 'medicenter'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'medicenter'),
			"param_name" => "type",
			"value" => array(__("Items list", 'medicenter') => 'items', __("Info list", 'medicenter') => 'info', __("Scrolling list", 'medicenter') => 'scrolling', __("Simple list", 'medicenter') => 'simple',)
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Header", 'medicenter'),
			"param_name" => "header",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Header border animation", 'medicenter'),
			"param_name" => "animation",
			"value" => array(__("no", 'medicenter') => 0,  __("yes", 'medicenter') => 1)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin header", 'medicenter'),
			"param_name" => "top_margin_header",
			"value" => array(__("Section (large)", 'medicenter') => "page_margin_top_section", __("Page (small)", 'medicenter') => "page_margin_top", __("None", 'medicenter') => "none")
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'medicenter'),
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
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Read more button", 'medicenter'),
			"param_name" => "read_more",
			"value" => array(__("No", 'medicenter') => 0, __("Yes", 'medicenter') => 1)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button label", 'medicenter'),
			"param_name" => "button_label",
			"value" => "",
			"dependency" => Array('element' => "read_more", 'value' => '1')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button url", 'medicenter'),
			"param_name" => "button_url",
			"value" => "",
			"dependency" => Array('element' => "read_more", 'value' => '1')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("Section (large)", 'medicenter') => "page_margin_top_section", __("Page (small)", 'medicenter') => "page_margin_top", __("None", 'medicenter') => "none")
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra class name", 'medicenter'),
			"param_name" => "class",
			"value" => ""
		)
	)
));
?>