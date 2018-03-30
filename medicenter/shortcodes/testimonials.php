<?php
function theme_testimonials_shortcode($atts)
{
	global $themename;
	global $theme_options;
	extract(shortcode_atts(array(
		"id" => "testimonials",
		"header" => "",
		"animation" => 0,
		"testimonials_count" => 1,
		"autoplay" => 0,
		"pause_on_hover" => 1,
		"scroll" => 1,
		"effect" => "scroll",
		"easing" => "swing",
		"duration" => 500,
		"ontouch" => 0,
		"onmouse" => 0,
		"top_margin" => "page_margin_top_section"
	), $atts));
	if($effect=="_fade")
		$effect = "fade";
	if(strpos($easing, 'ease')!==false)
	{
		$newEasing = 'ease';
		if(strpos($easing, 'inout')!==false)
			$newEasing .= 'InOut';
		else if(strpos($easing, 'in')!==false)
			$newEasing .= 'In';
		else if(strpos($easing, 'out')!==false)
			$newEasing .= 'Out';
		$newEasing .= ucfirst(substr($easing, strlen($newEasing), strlen($easing)-strlen($newEasing)));
	}
	else
		$newEasing = $easing;
	
	$output = '<div class="clearfix' . ($top_margin!="none" ? ' ' . $top_margin : '') . '">
			<div class="header_left">' . ($header!="" ? '<h3 class="box_header ' . ((int)$animation ? ' animation-slide' : '') . '">' . $header . '</h3>' : '') . '</div>
			<div class="header_right"><a href="#" id="' . $id . '_prev" class="scrolling_list_control_left icon_small_arrow left_black"></a><a href="#" id="' . $id . '_next" class="scrolling_list_control_right icon_small_arrow right_black"></a></div></div>
			<ul class="columns full_width horizontal_carousel testimonials ' . $id . ' id-' . $id . ' autoplay-' . $autoplay . ' pause_on_hover-' . $pause_on_hover . ' scroll-' . $scroll . ' effect-' . $effect . ' easing-' . $newEasing . ' duration-' . $duration . ((int)$ontouch ? ' ontouch' : '') . ((int)$onmouse ? ' onmouse' : '') . '">';
	$i=0;
	for($i=0; $i<$testimonials_count; $i++)
	{
		$output .= '<li class="' . ( is_rtl() || $theme_options["direction"]=='rtl' ? 'column_right' : 'column_left' ) . '">
			<h3 class="sentence">' . $atts["testimonials_title" . $i] . '</h3>
			' . ($atts["testimonials_author" . $i]!="" ? '<span class="sentence_author">' . $atts["testimonials_author" . $i] . '</span>' : '') . '
		</li>';
	}
	$output .= '</ul>';
	return $output;
}
add_shortcode("mc_testimonials", "theme_testimonials_shortcode");

$count = array();
for($i=1; $i<=30; $i++)
	$count[$i] = $i;
	
$params = array(
	array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Id", 'medicenter'),
		"param_name" => "id",
		"value" => "testimonials",
		"description" => __("Please provide unique id for each testimonials carousel on the same page/post", 'medicenter')
	),
	array(
		"type" => "textfield",
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
		"heading" => __("Number of testimonials", 'medicenter'),
		"param_name" => "testimonials_count",
		"value" => $count
	)
);
for($i=0; $i<30; $i++)
{
	$params[] = array(
		"type" => "textfield",
		"heading" => __("Title", 'medicenter') . " " . ($i+1),
		"param_name" => "testimonials_title" . $i,
		"value" => "Sample Sentence Text"
	);
	$params[] = array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Author", 'medicenter') . " " . ($i+1),
		"param_name" => "testimonials_author" . $i,
		"value" => "&#8212;  Sample Author"
	);
}
$params = array_merge($params, array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Autoplay", 'medicenter'),
		"param_name" => "autoplay",
		"value" => array(__("No", 'medicenter') => 0, __("Yes", 'medicenter') => 1)
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Pause on hover", 'medicenter'),
		"param_name" => "pause_on_hover",
		"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0),
		"dependency" => Array('element' => "autoplay", 'value' => '1')
	),
	array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Scroll", 'medicenter'),
		"param_name" => "scroll",
		"value" => 1,
		"description" => __("Number of items to scroll in one step", 'medicenter')
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Effect", 'medicenter'),
		"param_name" => "effect",
		"value" => array(
			__("scroll", 'medicenter') => "scroll", 
			__("none", 'medicenter') => "none", 
			__("directscroll", 'medicenter') => "directscroll",
			__("fade", 'medicenter') => "_fade",
			__("crossfade", 'medicenter') => "crossfade",
			__("cover", 'medicenter') => "cover",
			__("uncover", 'medicenter') => "uncover"
		)
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Sliding easing", 'medicenter'),
		"param_name" => "easing",
		"value" => array(
			__("swing", 'medicenter') => "swing", 
			__("linear", 'medicenter') => "linear", 
			__("easeInQuad", 'medicenter') => "easeInQuad",
			__("easeOutQuad", 'medicenter') => "easeOutQuad",
			__("easeInOutQuad", 'medicenter') => "easeInOutQuad",
			__("easeInCubic", 'medicenter') => "easeInCubic",
			__("easeOutCubic", 'medicenter') => "easeOutCubic",
			__("easeInOutCubic", 'medicenter') => "easeInOutCubic",
			__("easeInQuart", 'medicenter') => "easeInQuart",
			__("easeOutQuart", 'medicenter') => "easeOutQuart",
			__("easeInOutQuart", 'medicenter') => "easeInOutQuart",
			__("easeInSine", 'medicenter') => "easeInSine",
			__("easeOutSine", 'medicenter') => "easeOutSine",
			__("easeInOutSine", 'medicenter') => "easeInOutSine",
			__("easeInExpo", 'medicenter') => "easeInExpo",
			__("easeOutExpo", 'medicenter') => "easeOutExpo",
			__("easeInOutExpo", 'medicenter') => "easeInOutExpo",
			__("easeInQuint", 'medicenter') => "easeInQuint",
			__("easeOutQuint", 'medicenter') => "easeOutQuint",
			__("easeInOutQuint", 'medicenter') => "easeInOutQuint",
			__("easeInCirc", 'medicenter') => "easeInCirc",
			__("easeOutCirc", 'medicenter') => "easeOutCirc",
			__("easeInOutCirc", 'medicenter') => "easeInOutCirc",
			__("easeInElastic", 'medicenter') => "easeInElastic",
			__("easeOutElastic", 'medicenter') => "easeOutElastic",
			__("easeInOutElastic", 'medicenter') => "easeInOutElastic",
			__("easeInBack", 'medicenter') => "easeInBack",
			__("easeOutBack", 'medicenter') => "easeOutBack",
			__("easeInOutBack", 'medicenter') => "easeInOutBack",
			__("easeInBounce", 'medicenter') => "easeInBounce",
			__("easeOutBounce", 'medicenter') => "easeOutBounce",
			__("easeInOutBounce", 'medicenter') => "easeInOutBounce"
		)
	),
	array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Sliding transition speed (ms)", 'medicenter'),
		"param_name" => "duration",
		"value" => 500
	),
	/*array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Slide on touch", 'medicenter'),
		"param_name" => "ontouch",
		"value" => array(__("No", 'medicenter') => 0, __("Yes", 'medicenter') => 1)
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Slide on mouse", 'medicenter'),
		"param_name" => "onmouse",
		"value" => array(__("No", 'medicenter') => 0, __("Yes", 'medicenter') => 1)
	),*/
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Top margin", 'medicenter'),
		"param_name" => "top_margin",
		"value" => array(__("Section (large)", 'medicenter') => "page_margin_top_section", __("Page (small)", 'medicenter') => "page_margin_top", __("None", 'medicenter') => "none")
	)
));
vc_map( array(
	"name" => __("Testimonials", 'medicenter'),
	"base" => "mc_testimonials",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-testimonials",
	"category" => __('MediCenter', 'medicenter'),
	"params" => $params
));
?>