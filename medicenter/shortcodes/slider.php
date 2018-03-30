<?php
//slider
/*function theme_slider($atts)
{
	//global $theme_options;
	extract(shortcode_atts(array(
		"id" => "slider",
		"slider_images" => "",
		"autoplay" => 0,
		"interval" => 5000,
		"pause_on_hover" => 1,
		"scroll" => 1,
		"effect" => "scroll",
		"easing" => "swing",
		"duration" => 500,
		"top_margin" => "page_margin_top_section"
	), $atts));
	$images = $slider_images;
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
	$output = '<ul class="slider ' . $id . ' id-' . $id . ' autoplay-' . $autoplay . ' pause_on_hover-' . $pause_on_hover . ' scroll-' . $scroll . ' effect-' . $effect . ' easing-' . $newEasing . ' duration-' . $duration . ((int)$ontouch ? ' ontouch' : '') . ((int)$onmouse ? ' onmouse' : '') . ($top_margin!="none" ? ' ' . $top_margin : '') . '">';
	$images = explode(',', $images);
	$i=0;
	foreach($images as $attach_id)
	{
		$attachment = get_posts(array('p' => $attach_id, 'post_type' => 'attachment'));
		$output .= '<li id="slide_' . $i . '" style="background-image: url(' . $attachment[0]->guid . ');' . ($atts["image_url" . $i]!="" ? ' cursor: pointer;' : '') . '"' . ($atts["image_url" . $i]!="" ? ' onclick="javascript:window.location.href=\'' . $atts["image_url" . $i] . '\'; return false;"' : '') . '>
				&nbsp;</li>';
		$i++;
	}
	$output .= '</ul>';
	return $output;
}
add_shortcode("slider", "theme_slider");*/

//slider
function theme_slider($atts)
{
	extract(shortcode_atts(array(
		"id" => ""
	), $atts));
	$slider_options = theme_stripslashes_deep(get_option($id));
	if($slider_options)
	{
		$output = '';
		$slides_count = count($slider_options["slider_image_url"]);
		if(count($slides_count))
		{
			$output .= '<ul class="slider ' . $id . ' id-' . $id . ' autoplay-' . $slider_options['slider_autoplay'] . ' interval-' . $slider_options['slide_interval'] . ' effect-' . $slider_options['slider_effect'] . ' easing-' . $slider_options['slider_transition'] . ' duration-' . $slider_options['slider_transition_speed'] . /*((int)$ontouch ? ' ontouch' : '') . ((int)$onmouse ? ' onmouse' : '') .*/ '">';
			for($i=0; $i<$slides_count; $i++)
			{
				
				$output .= '<li id="slide_' . $i . '" style="background-image: url(' . $slider_options["slider_image_url"][$i] . ');' . (isset($slider_options["slider_image_link"][$i]) && $slider_options["slider_image_link"][$i]!="" ? ' cursor: pointer;' : '') . '"' . (isset($slider_options["slider_image_link"][$i]) && $slider_options["slider_image_link"][$i]!="" ? ' onclick="javascript:window.location.href=\'' . $slider_options["slider_image_link"][$i] . '\'; return false;"' : '') . '>
					&nbsp;</li>';
			}
			$output .= '</ul>';
		}
		
		$output .= '<style>';
		$slider_styles = array();
		if(!empty($slider_options["slider_height"]) && $slider_options["slider_height"]!=670) {
			$proportion = $slider_options["slider_height"]/670;
			$slider_styles = array(				
				"height" => array(
					$slider_options["slider_height"], 
					floor(520*$proportion), 
					floor(315*$proportion), 
					floor(210*$proportion)),
				"margin-top" => array(
					floor(577*$proportion), 
					floor(488*$proportion), 
					floor(285*$proportion), 
					floor(195*$proportion)),
				"min-height" =>array(
					floor((577*$proportion)-210),
					floor((488*$proportion)-200),
					floor((285*$proportion)-55),
					floor((195*$proportion)-20),
				),				
			);
			$output .= '
				.slider li { 
					height: ' . $slider_styles["height"][0] . 'px;
				}
				.slider_content_box
				{
					margin-top: -' . $slider_styles["margin-top"][0] . 'px;
					min-height: ' . $slider_styles["min-height"][0] . 'px;
				}
				@media screen and (max-width: 1009px) {
					.slider li { 
						height: ' . $slider_styles["height"][1] . 'px;
					}
					.slider_content_box
					{
						margin-top: -' . $slider_styles["margin-top"][1] . 'px;
						min-height: ' . $slider_styles["min-height"][1] . 'px;
					}
				}
				@media screen and (max-width: 767px) {
					.slider li { 
						height: ' . $slider_styles["height"][2] . 'px; 
					}
					.slider_content_box
					{
						margin-top: -' . $slider_styles["margin-top"][2] . 'px;
						min-height: ' . $slider_styles["min-height"][2] . 'px;
					}	
				}
				@media screen and (max-width: 479px) {
					.slider li { 
						height: ' . $slider_styles["height"][3] . 'px; 
					}
					.slider_content_box
					{
						margin-top: -' . $slider_styles["margin-top"][3] . 'px;
						min-height: ' . $slider_styles["min-height"][3] . 'px;
					}
				}';
		}
		if(isset($slider_options['slider_navigation'])) {
			$display = $slider_options['slider_navigation']==1 ? "block" : "none";
			$output .= '
				.slider_navigation {
					display: ' . $display . '
				}';
		}
		$output .= '</style>';
	}
	return $output;
}
add_shortcode("slider", "theme_slider");

//slider content
function theme_slider_content($atts)
{
	extract(shortcode_atts(array(
		"id" => ""
	), $atts));
	$slider_options = theme_stripslashes_deep(get_option($id));
	if($slider_options)
	{
		$output = "";
		$slides_count = count($slider_options["slider_image_url"]);
		if(count($slides_count))
		{
			$output .= '<div class="slider_content_box clearfix">';
			for($i=0; $i<$slides_count; $i++)
			{
				if(isset($slider_options["slider_image_title"][$i]) || isset($slider_options["slider_image_subtitle"][$i]))
				{
					$output .= '<div id="slide_' . $i . '_content" class="slider_content"' . ($i==0 || (isset($slider_options["slider_image_link"][$i]) && $slider_options["slider_image_link"][$i]!="") ? ' style="' . ($i==0 ? 'display: block;' : '') . (isset($slider_options["slider_image_link"][$i]) && $slider_options["slider_image_link"][$i]!="" ? ' cursor: pointer;' : '') . '"' : '') . (isset($slider_options["slider_image_link"][$i]) && $slider_options["slider_image_link"][$i]!="" ? ' onclick="javascript:window.location.href=\'' . $slider_options["slider_image_link"][$i] . '\'; return false;"' : '') . '>';
					if(isset($slider_options["slider_image_title"][$i]))
						$output .= '<h1 class="title">' . $slider_options["slider_image_title"][$i] . '</h1>';
					if(isset($slider_options["slider_image_subtitle"][$i]))
						$output .= '<h2 class="subtitle">' . $slider_options["slider_image_subtitle"][$i] . '</h2>';
					$output .= '</div>';
				}
			}
			$output .= '</div>';
		}
	}
	return $output;
}
add_shortcode("slider_content", "theme_slider_content");

//visual composer
/*function theme_slider_vc_init()
{
	class WPBakeryShortCode_Slider extends WPBakeryShortCode {
		public function content( $atts, $content = null ) {
			return theme_slider($atts);
		}
	   public function singleParamHtmlHolder($param, $value) {
		   global $themename;
			$output = '';
			// Compatibility fixes
			$old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
			$new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
			$value = str_ireplace($old_names, $new_names, $value);
			//$value = __($value, "js_composer");
			//
			$param_name = isset($param['param_name']) ? $param['param_name'] : '';
			$type = isset($param['type']) ? $param['type'] : '';
			$class = isset($param['class']) ? $param['class'] : '';

			if ( isset($param['holder']) == false || $param['holder'] == 'hidden' ) {
				$output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
			}
			else {
				$output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
			}
			if($param_name == 'slider_images') {
				$images_ids = empty($value) ? array() : explode(',', trim($value));
				$output .= '<ul class="attachment-thumbnails'.( empty($images_ids) ? ' image-exists' : '' ).'">';
				foreach($images_ids as $image) {
					$img = wpb_getImageBySize(array( 'attach_id' => (int)$image, 'thumb_size' => $themename . '-small-thumb' ));
					$output .= ( $img ? '<li>'.$img['thumbnail'].'</li>' : '<li><img width="150" height="150" test="'.$image.'" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail" alt="" title="" /></li>');
				}
				$output .= '</ul>';
				$output .= '<a href="#" class="column_edit_trigger' . ( !empty($images_ids) ? ' image-exists' : '' ) . '">' . __( 'Add images', 'js_composer' ) . '</a>';

			}
			return $output;
		}
	}
	$params = array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Id", 'medicenter'),
			"param_name" => "id",
			"value" => "slider",
			"description" => __("Please provide unique id for each slider on the same page/post", 'medicenter')
		),
		array(
			"type" => "attach_images",
			"class" => "",
			"heading" => __("Images", 'medicenter'),
			"param_name" => "slider_images",
			"value" => ""
		)
	);
	for($i=0; $i<30; $i++)
	{
		$params[] = array(
			"type" => "textfield",
			"heading" => __("Image title", 'medicenter') . " " . ($i+1),
			"param_name" => "image_title" . $i,
			"value" => "",
			"dependency" => Array('element' => "images", 'not_empty' => true)
		);
		$params[] = array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Image subtitle", 'medicenter') . " " . ($i+1),
			"param_name" => "image_subtitle" . $i,
			"value" => "",
			"dependency" => Array('element' => "images", 'not_empty' => true)
		);
		$params[] = array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Image url", 'medicenter') . " " . ($i+1),
			"param_name" => "image_url" . $i,
			"value" => "",
			"dependency" => Array('element' => "images", 'not_empty' => true)
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
			"type" => "textfield",
			"class" => "",
			"heading" => __("Slide interval", 'medicenter'),
			"param_name" => "interval",
			"value" => 5000,
			"dependency" => Array('element' => "autoplay", 'value' => 1)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Pause on hover", 'medicenter'),
			"param_name" => "pause_on_hover",
			"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0),
			"dependency" => Array('element' => "autoplay", 'value' => 1)
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
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'medicenter') => "none", __("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section")
		)
	));
	vc_map( array(
		"name" => __("Slider", 'medicenter'),
		"base" => "slider",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-shape-text",
		"category" => __('MediCenter', 'medicenter'),
		"params" => $params
	));
}
add_action("init", "theme_slider_vc_init");*/
?>
