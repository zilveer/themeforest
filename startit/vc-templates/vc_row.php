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
$output = $after_output = $inner_start = $inner_end = $video_output = $after_wrapper_open = $before_wrapper_close = $svg_top_output = $svg_bottom_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	'qodef-section',
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
	$wrapper_attributes[] = 'data-qodef-anchor="' . esc_attr($anchor ) . '"';
}
/*** This functionality is disabled from vc row ***/
/*
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = ' vc_row-o-full-height';
	if ( ! empty( $content_placement ) ) {
		$css_classes[] = ' vc_row-o-content-' . $content_placement;
	}
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_image = $video_bg_url;
	$css_classes[] = ' vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( strpos( $parallax, 'fade' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( strpos( $parallax, 'fixed' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty ( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
*/

/*** Additional Options ***/

if( ! empty($content_aligment)){
	$css_classes[] = 'qodef-content-aligment-' . $content_aligment;
}
if( ! empty($row_type) && $row_type == 'parallax'){
	$css_classes[] = 'qodef-parallax-section-holder';

	if(qode_startit_options()->getOptionValue('parallax_on_off') == 'off'){
		$css_classes[] = 'qodef-parallax-section-holder-touch-disabled';
	}
}
if($content_width == 'grid'){
	$css_classes[] =  'qodef-grid-section';
	$css_inner_classes[] = 'qodef-section-inner';
	$inner_start .= '<div class="qodef-section-inner-margin clearfix">';
	$inner_end .= '</div>';
} else{
	$css_inner_classes[] = 'qodef-full-section-inner';
}

if($row_type == 'row' && $css_animation != ''){
	$inner_start .= '<div class="'. $css_animation .'">';
	if($transition_delay !== ''){
		$inner_start .= '<div style="transition-delay:' . $transition_delay . 'ms;">';
		$inner_end .= '</div>';
	}else{
		$inner_start .= '<div>';
		$inner_end .= '</div>';
	}
	$inner_end .= '</div>';
}

if($header_style != ''){
	$wrapper_attributes[] = 'data-qodef_header_style="'.$header_style.'"';
}

if($row_type == 'parallax' && $parallax_speed != ''){
	$wrapper_attributes[] =  'data-qodef-parallax-speed="'.$parallax_speed.'"';
}
else if($row_type == 'parallax' && $parallax_speed == ''){
	$wrapper_attributes[] =  'data-qodef-parallax-speed="0.5"';
}
if($parallax_background_image != ''){

	$parallax_image_link =  wp_get_attachment_url($parallax_background_image);
	$wrapper_style .= 'background-image:url('.$parallax_image_link.');';

}
if($section_height != ''){
	$wrapper_style .= 'min-height:'.$section_height.'px;height:auto;';
}

if($full_screen_section_height == 'yes'){
	$css_classes[] =  'qodef-full-screen-height-parallax';
	$after_wrapper_open .= '<div class="qodef-parallax-content-outer">';
	$before_wrapper_close .= '</div>';

	if($vertically_align_content_in_middle == 'yes'){
		$css_classes[] = 'qodef-vertical-middle-align';
	}
}


if($angled_shape == 'yes') {
	if($angled_shape_background != ""){
		$angled_shape_style = 'style="fill:'.$angled_shape_background.';"';
	}
	else {
		$angled_shape_style = '';
	}
}

if($angled_shape == 'yes' && $angled_shape_top == 'yes') {
	$svg_top_output .= '<svg class="qodef_angled_shape qodef_svg_top" preserveAspectRatio="none" viewBox="0 0 86 86" width="100%" height="180">';
	if($angled_shape_top_direction == 'from_left_to_right_top'){
		$svg_top_output .= '<polygon points="0,0 0,86 86,86" ' . $angled_shape_style . ' />';
	}
	if($angled_shape_top_direction == 'from_right_to_left_top'){
		$svg_top_output .= '<polygon points="0,86 86,0 86,86" ' . $angled_shape_style . ' />';
	}
	$svg_top_output .= '</svg>';
	$after_wrapper_open .= $svg_top_output;
}

if($angled_shape == 'yes' && $angled_shape_bottom == 'yes') {
	$svg_bottom_output .= '<svg class="qodef_angled_shape qodef_svg_bottom" preserveAspectRatio="none" viewBox="0 0 86 86" width="100%" height="180">';
	if($angled_shape_bottom_direction == 'from_left_to_right_bottom'){
		$svg_bottom_output .= '<polygon points="0,0 86,0 86,86" ' . $angled_shape_style . ' />';
	}
	if($angled_shape_bottom_direction == 'from_right_to_left_bottom'){
		$svg_bottom_output .= '<polygon points="0,0 0,86 86,0" ' . $angled_shape_style . ' />';
	}
	$svg_bottom_output .= '</svg>';
	$before_wrapper_close .= $svg_bottom_output;
}

if($video == 'show_video'){
	$video_overlay_class = 'qodef-video-overlay';
	$video_overlay_style = '';
	$video_mobile_style = '';
	$video_attrs = '';
	$v_image = '';
	if($video_overlay == "show_video_overlay"){
		$video_overlay_class .= ' qodef-video-overlay-active';
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
		$video_output .= '<div class="qodef-mobile-video-image" ' . qode_startit_get_inline_attr($video_mobile_style, 'style') . ')"></div>';
	}
	$video_output .= '<div ' . qode_startit_get_class_attribute($video_overlay_class) .  qode_startit_get_inline_attr($video_overlay_style, 'style') . '></div>';
	$video_output .= '<div class="qodef-video-wrap">';
	$video_output .= '<video class="qodef-video" width="1920" height="800" '. qode_startit_get_inline_attr($video_attrs, 'poster')  .' controls="controls" preload="auto" loop autoplay muted>';
	if(!empty($video_webm)) { $video_output .= '<source type="video/webm" src="'.$video_webm.'">'; }
	if(!empty($video_mp4)) { $video_output .= '<source type="video/mp4" src="'.$video_mp4.'">'; }
	if(!empty($video_ogv)) { $video_output .= '<source type="video/ogg" src="'. $video_ogv.'">'; }
	$video_output .='<object width="320" height="240" type="application/x-shockwave-flash" data="flashmediaelement.swf">';
		$video_output .='<param name="movie" value="flashmediaelement.swf" />';
		if(!empty($video_mp4)) {
			$video_output .= '<param name="flashvars" value="controls=true&amp;file=' . $video_mp4 . '" />';
		}
	if($v_image) {
		$video_output .= '<img ' . qode_startit_get_inline_attr($v_image, 'src') . ' width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />';
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