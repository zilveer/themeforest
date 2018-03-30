<?php
$output = '';
extract(shortcode_atts(array(
	'type'					=>'inline',
	'video_embed'			=>'',
), $atts));
if(!empty($video_embed)){
	$video_id = uniqid('video-featured-');
	$video = '';
	$video .= '<div class="video-embed-shortcode'.($type == 'popup'?' mfp-hide ':'').'">';
	$video .= '<div id="'.esc_attr($video_id).'" class="embed-wrap">';
	$video .= apply_filters('dh_embed_video', $video_embed);
	$video .= '</div>';
	$video .= '</div>';
	if($type == 'inline'){
		echo ($video);
	}elseif($type == 'popup'){
		/**
		 * script
		 * {{
		 */
		wp_enqueue_style('vendor-magnific-popup');
		wp_enqueue_script('vendor-magnific-popup');
		
		echo '<div class="video-embed-shortcode">';
		echo ($video);
		echo '<a class="video-embed-action" data-video-inline="'.esc_attr($video).'" href="#'.esc_attr($video_id).'" data-rel="magnific-popup-video"><i class="fa fa-play"></i></a>';
		echo '</div>';
	}
}