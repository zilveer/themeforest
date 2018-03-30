<?php
/**
 * Video Background function
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_video_bg' ) ) {
	/**
	 * Display a video background
	 *
	 * @param $mp4 string
	 * @param $webm string
	 * @param $ogv string
	 * @param $opacity int
	 * @return $output string
	 */
	function wolf_video_bg( $mp4 = null, $webm = null, $ogv = null, $img = null, $parallax = false ) {

		$output = '';
		$class = 'video-bg-container';
		$output .= "<div class='$class'>";

		if ( $img )
			$output .= "<div class='video-bg-fallback' style='background-image:url($img)'></div>";

		$output .= '<video class="video-bg" preload="auto" autoplay loop="loop" muted volume="0">';

		if ( $webm )
			$output .= '<source src="' . esc_url( $webm ) . '" type="video/webm">';

		if ( $mp4 )
			$output .= '<source src="' . esc_url( $mp4 ) . '" type="video/mp4">';

		if ( $webm )
			$output .= '<source src="' . esc_url( $ogv ) . '" type="video/ogg">';

		$output .= '</video>';
		$output .= '<div class="video-bg-overlay"></div>';
		$output .= '</div>';

		return $output;
	}
}

if ( ! function_exists( 'wolf_youtube_video_bg' ) ) {
	/**
	 * Display a youtube video background
	 *
	 * @param $url string
	 * @return $output string
	 */
	function wolf_youtube_video_bg( $url = null, $img_fallback = null, $parallax = false ) {

		$output = $style = '';
		$img_fallback = ( $img_fallback ) ? esc_url( $img_fallback ) : '';
		$class = 'video-bg-container youtube-video-bg-container';
		$url = esc_url( $url );
		$random_id = rand( 1, 9999 );

		if (
			preg_match( '#youtube(?:\-nocookie)?\.com/watch\?v=([A-Za-z0-9\-_]+)#', $url, $match )
			|| preg_match( '#youtube(?:\-nocookie)?\.com/v/([A-Za-z0-9\-_]+)#', $url, $match )
			|| preg_match( '#youtube(?:\-nocookie)?\.com/embed/([A-Za-z0-9\-_]+)#', $url, $match )
			|| preg_match( '#youtu.be/([A-Za-z0-9\-_]+)#', $url, $match )
		) {

			if ( $match && isset( $match[1] ) ) {

				$youtube_id = $match[1];
				$embed_url = 'https://youtube.com/embed/' . $youtube_id;

				if ( $parallax ) {
					$class .= ' video-bg-container-parallax';
				}

				if ( $img_fallback ) {
					$style .= "background:url('$img_fallback') center center no-repeat;";
					$style .= '-webkit-background-size: 100%;
					-o-background-size: 100%;
					-moz-background-size: 100%;
					background-size: 100%;
					-webkit-background-size: cover;
					-o-background-size: cover;
					background-size: cover;';
					$style = wolf_sanitize_style_attr( $style );
					// debug( $style );
				}

				$output .= "<div class='$class' id='youtube-video-bg-$random_id-container' data-youtube-video-id='$youtube_id' style='$style'>" . "\n";
					$output .= "<div class='youtube-player' id='youtube-player-$random_id'></div>" . "\n";
				$output .= '</div><!-- .youtube-video-bg -->' . "\n";
			}
		}
	return $output;
	}
}