<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
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
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	'mkdf-section',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

$css_inner_classes = array('clearfix');

$wrapper_attributes = array();
$inner_attributes = array();
$wrapper_style = '';
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if(!empty($anchor)){
	$wrapper_attributes[] = 'data-mkdf-anchor="' . esc_attr($anchor ) . '"';
}

/*** Additional Options ***/

if( ! empty($row_type) && $row_type == 'parallax'){
	$css_classes[] = 'mkdf-parallax-section-holder';

	if(hashmag_mikado_options()->getOptionValue('parallax_on_off') == 'off'){
		$css_classes[] = 'mkdf-parallax-section-holder-touch-disabled';
	}
	if($parallax_speed != ''){
		$wrapper_attributes[] =  'data-mkdf-parallax-speed="'.$parallax_speed.'"';
	}
	else{
		$wrapper_attributes[] =  'data-mkdf-parallax-speed="1"';
	}
}

if( ! empty($content_aligment)){
	$css_classes[] = 'mkdf-content-aligment-' . $content_aligment;
}

if($content_width == 'grid'){
	$css_classes[] =  'mkdf-grid-section';
	$css_inner_classes[] = 'mkdf-section-inner';
	$inner_start .= '<div class="mkdf-section-inner-margin clearfix">';
	$inner_end .= '</div>';
} else{
	$css_inner_classes[] = 'mkdf-full-section-inner';
}

if($row_type == 'row' && $css_animation != ''){
	$inner_start .= '<div class="mkdf-row-animations-holder '. $css_animation .'" data-animation="'.$css_animation.'">';
	if($transition_delay !== ''){
		$animation_styles = array();
		$animation_styles[] = 'transition-delay: '.$transition_delay.'ms';
		$animation_styles[] = '-webkit-animation-delay: '.$transition_delay.'ms';
		$animation_styles[] = 'animation-delay: '.$transition_delay.'ms';
		$inner_start .= '<div '.hashmag_mikado_get_inline_style($animation_styles).'>';
		$inner_end .= '</div>';
	}else{
		$inner_start .= '<div>';
		$inner_end .= '</div>';
	}
	$inner_end .= '</div>';
}

if($parallax_background_image != ''){

	$parallax_image_link =  wp_get_attachment_url($parallax_background_image);
	$wrapper_style .= 'background-image:url('.$parallax_image_link.');';

}

if($video == 'show_video'){

	$video_overlay_class = 'mkdf-video-overlay';
	$video_overlay_style = '';
	$video_mobile_style = '';
	$video_attrs = '';
	$v_image = '';
	if($video_overlay == "show_video_overlay"){
		$video_overlay_class .= ' mkdf-video-overlay-active';
	}
	if($video_image) {
		$v_image = wp_get_attachment_url($video_image);
		$video_mobile_style = 'background-image:url("'. $v_image . '");';
		$video_attrs = $v_image;
	}
	if($video_overlay_image) {
		$v_overlay_image = wp_get_attachment_url($video_overlay_image);
		$video_overlay_style = 'background-image:url("'. $v_overlay_image . '");';
	}
	if($video_image) {
		$video_output .= '<div class="mkdf-mobile-video-image" ' . hashmag_mikado_get_inline_attr($video_mobile_style, 'style') . ')"></div>';
	}
	
	$video_output .= '<div ' . hashmag_mikado_get_class_attribute($video_overlay_class) . hashmag_mikado_get_inline_attr($video_overlay_style, 'style') . '></div>';
	$video_output .= '<div class="mkdf-video-wrap">';
	$video_output .= '<video class="mkdf-video" width="1920" height="800" '. hashmag_mikado_get_inline_attr($video_attrs, 'poster')  .' controls="controls" preload="auto" loop autoplay muted>';
	if(!empty($video_webm)) { $video_output .= '<source type="video/webm" src="'.$video_webm.'">'; }
	if(!empty($video_mp4)) { $video_output .= '<source type="video/mp4" src="'.$video_mp4.'">'; }
	if(!empty($video_ogv)) { $video_output .= '<source type="video/ogg" src="'. $video_ogv.'">'; }
	$video_output .='<object width="320" height="240" type="application/x-shockwave-flash" data="flashmediaelement.swf">';
		$video_output .='<param name="movie" value="flashmediaelement.swf" />';
		if(!empty($video_mp4)) {
			$video_output .= '<param name="flashvars" value="controls=true&amp;file=' . $video_mp4 . '" />';
		}
	if($v_image) {
		$video_output .= '<img ' . hashmag_mikado_get_inline_attr($v_image, 'src') . ' width="1920" height="800" title="No video playback capabilities" alt="<?php esc_html__("Video thumb","hashmag"); ?>" />';
	}
	$video_output .='</object>';
	$video_output .='</video>';
	$video_output .='</div>';

	$after_wrapper_open .= $video_output;
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$css_inner_classes = preg_replace( '/\s+/', ' ', implode( ' ', $css_inner_classes ));
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$wrapper_attributes[] = 'style="' . $wrapper_style . '"';
$inner_attributes[] = 'class="' . esc_attr( trim( $css_inner_classes ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
	$output .= $after_wrapper_open;
	$output .= '<div ' . implode( ' ', $inner_attributes ) . '>';
	$output .= $inner_start;
	$output .= wpb_js_remove_wpautop( $content );
	$output .= $inner_end;
	$output .= '</div>';
$output .= $before_wrapper_close;
$output .= '</div>';
$output .= $after_output;

print $output;