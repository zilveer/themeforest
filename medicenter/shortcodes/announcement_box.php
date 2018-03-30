<?php
function theme_announcement_box_shortcode($atts, $content)
{
	extract(shortcode_atts(array(
		"header" => "",
		"button_label" => "",
		"button_url" => "",
		"button_size" => "medium",
		"button_color" => "#3156a3",
		"button_custom_color" => "",
		"button_hover_color" => "#3156a3",
		"button_hover_custom_color" => "",
		"button_text_color" => "#FFFFFF",
		"button_hover_text_color" => "#FFFFFF",
		"animation" => 0,
		"animation_duration" => "600",
		"animation_delay" => "0",
		"top_margin" => "page_margin_top_section"
	), $atts));
	
	$button_color = ($button_custom_color!="" ? $button_custom_color : $button_color);
	$button_hover_color = ($button_hover_custom_color!="" ? $button_hover_custom_color : $button_hover_color);
	
	$output = '<div class="announcement clearfix' . ($top_margin!="none" ? ' ' . $top_margin : '') . '">
					<ul class="columns no_width">
						<li class="column_left">' . ($header!="" ? '<h1>' . $header . '</h1>' : '')	. wpb_js_remove_wpautop(apply_filters('the_content', $content)) . '</li>';
	if($button_label!="")
		$output .= '<li class="column_right">
						<div class="vertical_align">
							<div class="vertical_align_cell">
								<a' . ($button_color!="" || $button_text_color!="" ? ' style="' . ($button_color!="" ? 'background-color:' . $button_color . ';border-color:' . $button_color . ';' : '') . ($button_text_color!="" ? 'color:' . $button_text_color . ';': '') . '"' : '') . ($button_hover_color!="" || $button_hover_text_color!="" ? ' onMouseOver="' . ($button_hover_color!="" ? 'this.style.backgroundColor=\''.$button_hover_color.'\';this.style.borderColor=\''.$button_hover_color.'\';' : '' ) . ($button_hover_text_color!="" ? 'this.style.color=\''.$button_hover_text_color.'\';' : '' ) . '" onMouseOut="' . ($button_hover_color!="" ? 'this.style.backgroundColor=\''.$button_color.'\';this.style.borderColor=\''.$button_color.'\';' : '' ) . ($button_hover_text_color!="" ? 'this.style.color=\''.$button_text_color.'\';' : '') . '"' : '') . ' title="' . esc_attr($button_label) . '" href="' . esc_attr($button_url) . '" class="more mc_button' . ' ' . $button_size . ($animation!='' ? ' animated_element animation-' . $animation . ((int)$animation_duration>0 && (int)$animation_duration!=600 ? ' duration-' . (int)$animation_duration : '') . ((int)$animation_delay>0 ? ' delay-' . (int)$animation_delay : '') : '') . '">' . $button_label . '</a>
							</div>
						</div>
					</li>';
	$output .= '</ul>
			</div>';
	return $output;
}
add_shortcode("announcement_box", "theme_announcement_box_shortcode");
//visual composer
$mc_colors_arr = array(__("Dark blue", "js_composer") => "#3156a3", __("Blue", "js_composer") => "#0384ce", __("Light blue", "js_composer") => "#42b3e5", __("Black", "js_composer") => "#000000", __("Gray", "js_composer") => "#AAAAAA", __("Dark gray", "js_composer") => "#444444", __("Light gray", "js_composer") => "#CCCCCC", __("Green", "js_composer") => "#43a140", __("Dark green", "js_composer") => "#008238", __("Light green", "js_composer") => "#7cba3d", __("Orange", "js_composer") => "#f17800", __("Dark orange", "js_composer") => "#cb451b", __("Light orange", "js_composer") => "#ffa800", __("Red", "js_composer") => "#db5237", __("Dark red", "js_composer") => "#c03427", __("Light red", "js_composer") => "#f37548", __("Turquoise", "js_composer") => "#0097b5", __("Dark turquoise", "js_composer") => "#006688", __("Turquoise", "js_composer") => "#00b6cc", __("Light turquoise", "js_composer") => "#00b6cc", __("Violet", "js_composer") => "#6969b3", __("Dark violet", "js_composer") => "#3e4c94", __("Light violet", "js_composer") => "#9187c4", __("White", "js_composer") => "#FFFFFF", __("Yellow", "js_composer") => "#fec110");
vc_map( array(
	"name" => __("Announcement box", 'medicenter'),
	"base" => "announcement_box",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-announcement-box",
	"category" => __('MediCenter', 'medicenter'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Header", 'medicenter'),
			"param_name" => "header",
			"value" => ""
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
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button label", 'medicenter'),
			"param_name" => "button_label",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button url", 'medicenter'),
			"param_name" => "button_url",
			"value" => ""
		),
		/*array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button color", 'medicenter'),
			"param_name" => "button_color",
			"value" => array(__("Dark blue", 'medicenter') => "blue", __("Blue", 'medicenter') => "dark_blue", __("Light", 'medicenter') => "light")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("or pick custom button color", 'medicenter'),
			"param_name" => "custom_button_color",
			"value" => ""
		),*/
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button size", 'medicenter'),
			"param_name" => "button_size",
			"value" => array(__("Medium", 'medicenter') => "medium", __("Tiny", 'medicenter') => "tiny", __("Small", 'medicenter') => "small", __("Large", 'medicenter') => "large")
		),
        array(
            "type" => "dropdown",
            "heading" => __("Button color", "js_composer"),
            "param_name" => "button_color",
            "value" => $mc_colors_arr
        ),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("or pick custom button color", 'medicenter'),
			"param_name" => "button_custom_color",
			"value" => ""
		),
		array(
            "type" => "dropdown",
            "heading" => __("Button hover Color", "js_composer"),
            "param_name" => "button_hover_color",
            "value" => $mc_colors_arr
        ),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("or pick custom button hover color", 'medicenter'),
			"param_name" => "button_hover_custom_color",
			"value" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button text color", 'medicenter'),
			"param_name" => "button_text_color",
			"value" => "#FFFFFF"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Hover text color", 'medicenter'),
			"param_name" => "button_hover_text_color",
			"value" => "#FFFFFF"
		),
		array(
            "type" => "dropdown",
            "heading" => __("Button animation", "js_composer"),
            "param_name" => "animation",
            "value" => array(
				__("none", "medicenter") => "",
				__("fade in", "medicenter") => "fadeIn",
				__("scale", "medicenter") => "scale",
				__("slide right", "medicenter") => "slideRight",
				__("slide right 200%", "medicenter") => "slideRight200",
				__("slide left", "medicenter") => "slideLeft",
				__("slide left 50%", "medicenter") => "slideLeft50",
				__("slide down", "medicenter") => "slideDown",
				__("slide down 200%", "medicenter") => "slideDown200",
				__("slide up", "medicenter") => "slideUp"
			)
        ),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button animation duration", 'medicenter'),
			"param_name" => "animation_duration",
			"value" => "600"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button animation delay", 'medicenter'),
			"param_name" => "animation_delay",
			"value" => "0"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("Section (large)", 'medicenter') => "page_margin_top_section", __("Page (small)", 'medicenter') => "page_margin_top", __("None", 'medicenter') => "none")
		)
	)
));
?>
