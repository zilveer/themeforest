<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$output = $title = $link = $size = $el_class = $video_thumb_image = $video_thumb_html = $video_module_mode = $video_source = $video_id = $video_title = $description = $wrapper_extra_class = $module_alignment = $label_background = $label_css = $icon_color = $icon_css = '';
extract( shortcode_atts( array(
	//'title' => '',
	'video_module_mode' => 'simple',
	'link' => 'http://vimeo.com/92033601',
	'size' => ( isset( $content_width ) ) ? $content_width : 500,
	'video_source' => 'youtube',
	'video_id' => '',
	'el_class' => '',
	'video_thumb_image' => '',
	'video_title' => '',
	'description' => '',
	'module_alignment' => 'text-left',
	'icon_color' => '',
	'label_background' => '',
	'css' => ''

), $atts ) );

$unique_id = uniqid('module_video_');

if ( $link == '' ) {
	return null;
}
$el_class = $this->getExtraClass( $el_class );

$video_w = ( isset( $content_width ) ) ? $content_width : 500;
$video_h = $video_w / 1.61; //1.61 golden ratio

$embed = '';

if(strcmp($video_module_mode, 'simple') === 0) {
	/** @var WP_Embed $wp_embed  */
	global $wp_embed;
	$embed .= $wp_embed->run_shortcode( '[embed width="' . $video_w . '"' . $video_h . ']' . $link . '[/embed]' );
	if(isset($video_thumb_image) && !empty($video_thumb_image)) {
		$thumb_image_url = wp_get_attachment_image_src($video_thumb_image, 'full');
		$image_src = dfd_aq_resize($thumb_image_url[0], $video_w, $video_h, true, true, true);
		if(!$image_src) {
			$image_src = $thumb_image_url[0];
		}
		$video_thumb_html .= '<a href="#" class="dfd-video-image-thumb" title="'.__('Play video','dfd').'"><i class="dfd-icon-play"></i><img src="'.esc_url($image_src).'" alt="" /></a>';
	}
}

if(strcmp($video_module_mode, 'full_screen') === 0) {
	if($label_background != '' || $icon_color != '') {
		$icon_css .= 'style="';
		if($label_background != '') {
			$icon_css .= 'background: '.esc_attr($label_background).';';
		}
		if($icon_color != '') {
			$icon_css .= 'color: '.esc_attr($icon_color).';';
		}
		$icon_css .= '"';
	}
	$wrapper_extra_class .= ' dfd-fullscreen-video '.$module_alignment;
	$embed .= '<a href="#show-video" data-video-source="'.esc_attr($video_source).'" data-video-id="'.esc_attr($video_id).'">'
			. '<i class="dfd-icon-play" '.$icon_css.'></i>';
			if($video_title != '') {
				$embed .= '<span class="box-name">'.$video_title.'</span>';
			}
			if($description != '') {
				$embed .= '<span class="subtitle">'.$description.'</span>';
			}
			$embed .= '</a>';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'dfd_video_widget wpb_content_element' . $el_class . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$output .= "\n\t" . '<div id="'.$unique_id.'" class="' . $css_class . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_video_heading' ) );
$output .= '<div class="dfd-video-box">';
$output .= $video_thumb_html;
$output .= '<div class="wpb_video_wrapper '.$wrapper_extra_class.'">' . $embed . '</div>';
$output .= '</div>';
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_video_widget' );
if($video_thumb_html != '' && strcmp($video_module_mode, 'simple') === 0) {
	$output .= '<script>
					(function($) {
						"use strict";
						$(document).ready(function() {
							var video_box = $("#'. esc_js($unique_id) .'");
							var button = video_box.find(".dfd-video-image-thumb");
							button.click(function(e) {
								var player = video_box.find("iframe");
								$(this).fadeOut("slow");
								e.preventDefault();
								player[0].src += "&autoplay=1";
							});
						});
					})(jQuery);
				</script>';
}

if(strcmp($video_module_mode, 'full_screen') === 0) {
	wp_enqueue_script('fullscreenvideo');
}

echo $output;