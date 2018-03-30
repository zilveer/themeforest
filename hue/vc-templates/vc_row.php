<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$output = $after_output = $inner_start = $inner_end = $video_output = $after_wrapper_open = $before_wrapper_close = '';
$atts   = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
extract(hue_mikado_animated_gradient_overlay($animated_gradient_overlay_color1,$animated_gradient_overlay_color2,$animated_gradient_overlay_color3,$animated_gradient_overlay_color4));


wp_enqueue_script('wpb_composer_front_js');

$el_class = $this->getExtraClass($el_class);

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	'mkd-section',
	$el_class,
	vc_shortcode_custom_css_class($css),
);

$css_inner_classes = array('clearfix');

$wrapper_attributes = array();
$inner_attributes   = array();
$wrapper_style      = '';
// build attributes for wrapper
if(!empty($el_id)) {
	$wrapper_attributes[] = 'id="'.esc_attr($el_id).'"';
}
if(!empty($anchor)) {
	$wrapper_attributes[] = 'data-mkd-anchor="'.esc_attr($anchor).'"';
}

/*** Additional Options ***/

if(!empty($content_aligment)) {
	$css_classes[] = 'mkd-content-aligment-'.$content_aligment;
}
if(!empty($row_type) && $row_type == 'parallax') {
	$css_classes[] = 'mkd-parallax-section-holder';

	if(hue_mikado_options()->getOptionValue('parallax_on_off') == 'off') {
		$css_classes[] = 'mkd-parallax-section-holder-touch-disabled';
	}
	if($parallax_speed != '') {
		$wrapper_attributes[] = 'data-mkd-parallax-speed="'.$parallax_speed.'"';
	} else {
		$wrapper_attributes[] = 'data-mkd-parallax-speed="1"';
	}
}
if(!empty($row_type) && $row_type == 'intro_section') {
    $css_classes[] = 'mkd-intro-section-section-holder';

    $after_wrapper_open .= '<div class="mkd-intro-section-content-outer-fixed"><div class="mkd-intro-section-content-outer"><div class="mkd-intro-section-content-inner">';
    $before_wrapper_close .= '</div></div></div>';
}
if($content_width == 'grid') {
	$css_classes[]       = 'mkd-grid-section';
	$css_inner_classes[] = 'mkd-section-inner';
	$inner_start .= '<div class="mkd-section-inner-margin clearfix">';
	$inner_end .= '</div>';
} else {
	$css_inner_classes[] = 'mkd-full-section-inner';
}

if($row_type == 'row' && $css_animation != '') {
	$inner_start .= '<div class="mkd-row-animations-holder '.$css_animation.'" data-animation="'.$css_animation.'">';
	if($transition_delay !== '') {
		$animation_styles   = array();
		$animation_styles[] = 'transition-delay: '.$transition_delay.'ms';
		$animation_styles[] = '-webkit-animation-delay: '.$transition_delay.'ms';
		$animation_styles[] = 'animation-delay: '.$transition_delay.'ms';
		$inner_start .= '<div '.hue_mikado_get_inline_style($animation_styles).'>';
		$inner_end .= '</div>';
	} else {
		$inner_start .= '<div>';
		$inner_end .= '</div>';
	}
	$inner_end .= '</div>';
}

if($header_style != '') {
	$wrapper_attributes[] = 'data-mkd_header_style="'.$header_style.'"';
}

if($parallax_background_image != '') {

	$parallax_image_link = wp_get_attachment_url($parallax_background_image);
	$wrapper_style .= 'background-image:url('.$parallax_image_link.');';
}

if($intro_section_background_image !== ''){
    $intro_section_image_link = wp_get_attachment_url($intro_section_background_image);
    $after_wrapper_open .= "<div class='mkd-intro-section-background' style='background-image:url(".$intro_section_image_link.");'></div>";
}

if($section_height != '') {
	$wrapper_style .= 'min-height:'.$section_height.'px;height:auto;';
}

if(in_array($row_type,array('row','parallax'))){
    if ($gradient_overlay != '' && $animated_gradient_overlay == 'no') {

        $custom_gradient_style = '';
        if($gradient_overlay == 'mkd-custom-gradient-top-to-bottom'){
            $custom_gradient_style = 'style="'.
                'background: -webkit-linear-gradient(top, '.$custom_gradient_gradient_overlay_color_top.', '.$custom_gradient_gradient_overlay_color_bottom.');'.
                'background: -o-linear-gradient(bottom, '.$custom_gradient_gradient_overlay_color_top.', '.$custom_gradient_gradient_overlay_color_bottom.');'.
                'background: -moz-linear-gradient(bottom, '.$custom_gradient_gradient_overlay_color_top.', '.$custom_gradient_gradient_overlay_color_bottom.');'.
                'background: linear-gradient(to bottom, '.$custom_gradient_gradient_overlay_color_top.', '.$custom_gradient_gradient_overlay_color_bottom.');'.
                '"';
        }

        $after_wrapper_open .= '<div class="' . $gradient_overlay . ' mkd-gradient-overlay" '.$custom_gradient_style.'></div>';
    }

    if ($animated_gradient_overlay == 'yes') {
        $after_wrapper_open .= '<div class="mkd-gradient-overlay-animation" data-gradient-color1="' . $gradient_overlay_color1_data . '" data-gradient-color2="' . $gradient_overlay_color2_data . '" data-gradient-color3="' . $gradient_overlay_color3_data . '" data-gradient-color4="' . $gradient_overlay_color4_data . '"></div>';
    }
}

if($full_screen_section_height == 'yes') {
	$css_classes[] = 'mkd-full-screen-height-parallax';
	$after_wrapper_open .= '<div class="mkd-parallax-content-outer">';
	$before_wrapper_close .= '</div>';

	if($vertically_align_content_in_middle == 'yes') {
		$css_classes[] = 'mkd-vertical-middle-align';
	}

}

if($video == 'show_video') {
	$css_classes[]       = 'mkd-video';
	$video_overlay_class = 'mkd-video-overlay';
	$video_overlay_style = '';
	$video_mobile_style  = '';
	$video_attrs         = '';
	$v_image             = '';
	if($video_overlay == "show_video_overlay") {
		$video_overlay_class .= ' mkd-video-overlay-active';
	}
	if($video_image) {
		$v_image            = wp_get_attachment_url($video_image);
		$video_mobile_style = 'background-image:url("'.$v_image.'");';
		$video_attrs        = $v_image;
	}
	if($video_overlay_image) {
		$v_overlay_image     = wp_get_attachment_url($video_overlay_image);
		$video_overlay_style = 'background-image:url("'.$v_overlay_image.'");';
	}
	if($video_image) {
		$video_output .= '<div class="mkd-mobile-video-image" '.hue_mikado_get_inline_attr($video_mobile_style, 'style').')"></div>';
	}
	$video_output .= '<div '.hue_mikado_get_class_attribute($video_overlay_class).hue_mikado_get_inline_attr($video_overlay_style, 'style').'></div>';
	$video_output .= '<div class="mkd-video-wrap">';
	$video_output .= '<video class="mkd-video" width="1920" height="800" '.hue_mikado_get_inline_attr($video_attrs, 'poster').' controls="controls" preload="auto" loop autoplay muted>';
	if(!empty($video_webm)) {
		$video_output .= '<source type="video/webm" src="'.$video_webm.'">';
	}
	if(!empty($video_mp4)) {
		$video_output .= '<source type="video/mp4" src="'.$video_mp4.'">';
	}
	if(!empty($video_ogv)) {
		$video_output .= '<source type="video/ogg" src="'.$video_ogv.'">';
	}
	$video_output .= '<object width="320" height="240" type="application/x-shockwave-flash" data="'.MIKADO_ASSETS_ROOT.'/js/flashmediaelement.swf">';
	$video_output .= '<param name="movie" value="'.MIKADO_ASSETS_ROOT.'/js/flashmediaelement.swf" />';
	if(!empty($video_mp4)) {
		$video_output .= '<param name="flashvars" value="controls=true&amp;file='.$video_mp4.'" />';
	}
	if($v_image) {
		$video_output .= '<img '.hue_mikado_get_inline_attr($v_image, 'src').' width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />';
	}
	$video_output .= '</object>';
	$video_output .= '</video>';
	$video_output .= '</div>';

	$after_wrapper_open .= $video_output;
}


$css_class            = preg_replace('/\s+/', ' ', apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', array_filter($css_classes)), $this->settings['base'], $atts));
$css_inner_classes    = preg_replace('/\s+/', ' ', implode(' ', $css_inner_classes));
$wrapper_attributes[] = 'class="'.esc_attr(trim($css_class)).'"';
$wrapper_attributes[] = 'style="'.$wrapper_style.'"';
$inner_attributes[]   = 'class="'.esc_attr(trim($css_inner_classes)).'"';

$output .= '<div '.implode(' ', $wrapper_attributes).'>';
$output .= $after_wrapper_open;
$output .= '<div '.implode(' ', $inner_attributes).'>';
$output .= $inner_start;
$output .= wpb_js_remove_wpautop($content);
$output .= $inner_end;
$output .= '</div>';
$output .= $before_wrapper_close;
$output .= '</div>';
$output .= $after_output;

print $output;