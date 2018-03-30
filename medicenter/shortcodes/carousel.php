<?php
function theme_carousel_shortcode($atts)
{
	global $themename;
	global $theme_options;
	extract(shortcode_atts(array(
		"id" => "carousel",
		"header" => "",
		"animation" => 0,
		"carousel_images" => "",
		"lightbox_icon_color" => "blue_light",
		"features_images_loop" => 1,
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
	$images = $carousel_images;
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
			<div class="header_left">' . ($header!="" ? '<h3 class="box_header' . ((int)$animation ? ' animation-slide' : '') . '">' . $header . '</h3>' : '') . '</div>
			<div class="header_right"><a href="#" id="' . $id . '_prev" class="scrolling_list_control_left icon_small_arrow left_black"></a><a href="#" id="' . $id . '_next" class="scrolling_list_control_right icon_small_arrow right_black"></a></div></div>
			<ul class="mc_gallery horizontal_carousel ' . $id . ' id-' . $id . ' autoplay-' . $autoplay . ' pause_on_hover-' . $pause_on_hover . ' scroll-' . $scroll . ' effect-' . $effect . ' easing-' . $newEasing . ' duration-' . $duration . ((int)$ontouch ? ' ontouch' : '') . ((int)$onmouse ? ' onmouse' : '') . '">';
	$images = explode(',', $images);
	if(is_rtl() || $theme_options["direction"]=='rtl')
		$images = array_reverse($images);
	$i=0;
	foreach($images as $attach_id)
	{
		$attachment = get_posts(array('p' => $attach_id, 'post_type' => 'attachment'));
		$output .= '<li class="gallery_box">' . wp_get_attachment_image($attach_id, $themename . "-gallery-thumb-type-2", false, array("alt" => ""/*, "class" => "mc_preload"*/));
		if($atts["image_title" . $i]!="" || $atts["image_subtitle" . $i]!="")
		{
			$output .= '<div class="description">';
			if($atts["image_title" . $i]!="")
				$output .= '<h3>' . $atts["image_title" . $i] . '</h3>';
			if($atts["image_subtitle" . $i]!="")
				$output .= '<h5>' . $atts["image_subtitle" . $i] . '</h5>';
			$output .= '</div>';
		}
		$output .= '<ul class="controls">
				<li>
					<a' . (isset($atts["external_url" . $i]) && $atts["external_url" . $i]!="" ? ' target="_blank"' : '') . ' href="' . (!isset($atts["external_url" . $i]) || $atts["external_url" . $i]=="" ? (isset($atts["iframe_url" . $i]) && $atts["iframe_url" . $i]!="" ? $atts["iframe_url" . $i] : (isset($atts["video_url" . $i]) && $atts["video_url" . $i]!="" ? $atts["video_url" . $i] : $attachment[0]->guid)) : $atts["external_url" . $i]) . '" class="fancybox' . (isset($atts["video_url" . $i]) && $atts["video_url" . $i]!="" ? '-video' : (isset($atts["iframe_url" . $i]) && $atts["iframe_url" . $i]!="" ? '-iframe' : (isset($atts["external_url" . $i]) && $atts["external_url" . $i]!="" ? '-url' : ''))) . ' open' . (isset($atts["video_url" . $i]) && $atts["video_url" . $i]!="" ? '_video' : (isset($atts["iframe_url" . $i]) && $atts["iframe_url" . $i]!="" ? '_iframe' : (isset($atts["external_url" . $i]) && $atts["external_url" . $i]!="" ? '_url' : ''))) . '_lightbox"' . ((!isset($atts["external_url" . $i]) || $atts["external_url" . $i]=="") && (!isset($atts["iframe_url" . $i]) || $atts["iframe_url" . $i]=="") && (!isset($atts["video_url" . $i]) || $atts["video_url" . $i]=="") ? ($features_images_loop==1 ? ' rel="carousel' . $id . '"' : '') : '') . (isset($atts["image_title" . $i]) && $atts["image_title" . $i]!="" ? ' title="' . esc_attr($atts["image_title" . $i]) . '"' : '') . ' style="background-image: url(\'' . get_template_directory_uri() . '/images/icons_media/' . $lightbox_icon_color . '/' . (isset($atts["video_url" . $i]) && $atts["video_url" . $i]!="" ? 'video' : ((isset($atts["iframe_url" . $i]) && $atts["iframe_url" . $i]!="") || (isset($atts["external_url" . $i]) && $atts["external_url" . $i]!="") ? 'url' : 'image')) . '.png\')"></a>
				</li>
			</ul>
		</li>';
		$i++;
	}
	/*foreach($images as $attach_id)
	{
		
		$attachment = get_posts(array('p' => $attach_id, 'post_type' => 'attachment'));
		$output .= '<li class="gallery_box">' . wp_get_attachment_image($attach_id, $themename . "-gallery-thumb-type-2", false, array("alt" => ""/*, "class" => "mc_preload"*//*));
		if($attachment[0]->post_excerpt!="" || $attachment[0]->post_content!="")
		{
			$output .= '<div class="description">';
			if($attachment[0]->post_excerpt!="")
				$output .= '<h3>' . $attachment[0]->post_excerpt . '</h3>';
			if($attachment[0]->post_content!="")
				$output .= '<h5>' . $attachment[0]->post_content . '</h5>';
			$output .= '</div>';
		}
		$output .= '<ul class="controls">
				<li>
					<a href="' . $attachment[0]->guid . '" rel="' . $id . '" class="fancybox open_lightbox"></a>
				</li>
			</ul>
		</li>';
				
	}*/
	$output .= '</ul>';
	return $output;
}
add_shortcode("mc_carousel", "theme_carousel_shortcode");
//visual composer
class WPBakeryShortCode_MC_Carousel extends WPBakeryShortCode {
	public function content( $atts, $content = null ) {
        return theme_carousel_shortcode($atts);
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

        if ( isset($param['holder']) == true && $param['holder'] !== 'hidden' ) {
            $output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
        }
        if($param_name == 'carousel_images') {
            $images_ids = empty($value) ? array() : explode(',', trim($value));
            $output .= '<ul class="attachment-thumbnails'.( empty($images_ids) ? ' image-exists' : '' ).'" data-name="' . $param_name . '">';
            foreach($images_ids as $image) {
                $img = wpb_getImageBySize(array( 'attach_id' => (int)$image, 'thumb_size' => $themename . '-small-thumb' ));
                $output .= ( $img ? '<li>'.$img['thumbnail'].'</li>' : '<li><img width="150" height="150" test="'.$image.'" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail" alt="" title="" /></li>');
            }
            $output .= '</ul>';
            $output .= '<a href="#" class="column_edit_trigger' . ( !empty($images_ids) ? ' image-exists' : '' ) . '">' . __( 'Add images', 'js_composer' ) . '</a>';

        }
        return $output;
   
	   /*global $themename;
        $output = '';
		$output .= "<span>" . print_r($value, true) . "</span>";
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
        if($param_name == 'carousel_images') {
			$output .= "<span>" . print_r($value, true) . "</span>";
            $images_ids = empty($value) ? array() : explode(',', trim($value));
            $output .= '<ul class="attachment-thumbnails'.( empty($images_ids) ? ' image-exists' : '' ).'">';
            foreach($images_ids as $image) {
                $img = wpb_getImageBySize(array( 'attach_id' => (int)$image, 'thumb_size' => $themename . '-small-thumb' ));
                $output .= ( $img ? '<li>'.$img['thumbnail'].'</li>' : '<li><img width="150" height="150" test="'.$image.'" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail" alt="" title="" /></li>');
            }
            $output .= '</ul>';
            $output .= '<a href="#" class="column_edit_trigger' . ( !empty($images_ids) ? ' image-exists' : '' ) . '">' . __( 'Add images', 'js_composer' ) . '</a>';

        }
        return $output;*/
    }
}
$params = array(
	array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Id", 'medicenter'),
		"param_name" => "id",
		"value" => "carousel",
		"description" => __("Please provide unique id for each carousel on the same page/post", 'medicenter')
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
		"type" => "attach_images",
		"class" => "",
		"heading" => __("Images", 'medicenter'),
		"param_name" => "carousel_images",
		"value" => ""
	)
);
for($i=0; $i<30; $i++)
{
	$params[] = array(
		"type" => "textfield",
		"heading" => __("Video url", 'medicenter') . " " . ($i+1),
		"param_name" => "video_url" . $i,
		"value" => "",
		//"dependency" => Array('element' => "images", 'not_empty' => true),
		"description" => __('For Vimeo please use http://player.vimeo.com/video/%video_id% For YouTube: http://youtube.com/embed/%video_id%', 'medicenter')
	);
	$params[] = array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Iframe url", 'medicenter') . " " . ($i+1),
		"param_name" => "iframe_url" . $i,
		"value" => "",
		//"dependency" => Array('element' => "images", 'not_empty' => true)
	);
	$params[] = array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("External url", 'medicenter') . " " . ($i+1),
		"param_name" => "external_url" . $i,
		"value" => "",
		//"dependency" => Array('element' => "images", 'not_empty' => true)
	);
	$params[] = array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Image title", 'medicenter') . " " . ($i+1),
		"param_name" => "image_title" . $i,
		"value" => "",
		//"dependency" => Array('element' => "images", 'not_empty' => true)
	);
	$params[] = array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Image subtitle", 'medicenter') . " " . ($i+1),
		"param_name" => "image_subtitle" . $i,
		"value" => "",
		//"dependency" => Array('element' => "images", 'not_empty' => true)
	);
}
$params = array_merge($params, array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Lightbox images loop", 'medicenter'),
		"param_name" => "features_images_loop",
		"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0),
		"dependency" => Array('element' => "images", 'not_empty' => true)
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Lightbox icon color", 'medicenter'),
		"param_name" => "lightbox_icon_color",
		"value" => array(
			__("light blue", 'medicenter') => 'blue_light', 
			__("dark blue", 'medicenter') => 'blue_dark',
			__("blue", 'medicenter') => 'blue',
			__("black", 'medicenter') => 'black',
			__("gray", 'medicenter') => 'gray',
			__("dark gray", 'medicenter') => 'gray_dark',
			__("light gray", 'medicenter') => 'gray_light',
			__("green", 'medicenter') => 'green',
			__("dark green", 'medicenter') => 'green_dark',
			__("light green", 'medicenter') => 'green_light',
			__("orange", 'medicenter') => 'orange',
			__("dark orange", 'medicenter') => 'orange_dark',
			__("light orange", 'medicenter') => 'orange_light',
			__("red", 'medicenter') => 'red',
			__("dark red", 'medicenter') => 'red_dark',
			__("light red", 'medicenter') => 'red_light',
			__("turquoise", 'medicenter') => 'turquoise',
			__("dark turquoise", 'medicenter') => 'turquoise_dark',
			__("light turquoise", 'medicenter') => 'turquoise_light',
			__("violet", 'medicenter') => 'violet',
			__("dark violet", 'medicenter') => 'violet_dark',
			__("light violet", 'medicenter') => 'violet_light',
			__("white", 'medicenter') => 'white',
			__("yellow", 'medicenter') => 'yellow'
		)
	),
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
	"name" => __("Carousel", 'medicenter'),
	"base" => "mc_carousel",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-carousel",
	"category" => __('MediCenter', 'medicenter'),
	"params" => $params
));
?>
