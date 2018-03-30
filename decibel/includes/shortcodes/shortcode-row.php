<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_columns_shortcode' ) ) {
	/**
	 * Columns shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function wolf_row_shortcode( $atts, $content = null ) {
		$output = $el_class = $custom_class = $style = '';
		extract( shortcode_atts( array(
			'el_class' => '',
			'font_type' => 'dark',
			'background_color' => '',
			'background_type' => '',
			'background_image' => '',
			'background_position' => '',
			'background_attachment' => '',
			'background_repeat' => '',
			'background_size' => '',
			'video_bg_type' => '',
			'video_bg_youtube_url' => '',
			'video_bg_mp4' => '',
			'video_bg_webm' => '',
			'video_bg_ogv' => '',
			'video_opacity' => '100',
			'video_bg_img' => '',
			'content_type' => 'standard',
			'no_padding' => '',
			'padding_top' => '',
			'padding_bottom' => '',
			'parallax' => '',
			'full_screen' => '',
			'anchor' => '',
			'overlay' => '',
			'overlay_image' => '',
			'overlay_color' => '',
			'overlay_opacity' => '100',
			'inline_style' => '',
			'hide_class' => '',
		), $atts ) );

		$style = '';
		$overlay_style = '';
		$video_opacity = 100;
		$overlay_opacity = ( $overlay_opacity ) ? absint( $overlay_opacity ) / 100 : .4;

		$custom_class .= 'wolf-row clearfix content-' . $font_type . '-font' . ' wolf-row-' . $content_type . '-width';

		if ( $hide_class )
			$custom_class .= ' ' . $hide_class;

		if ( $video_bg_mp4 || $video_bg_youtube_url )
			$custom_class .= ' wolf-row-video-bg';

		if ( $no_padding )
			$custom_class .=  ' wolf-row-no-padding';

		if ( $full_screen )
			$custom_class .= ' section-full-screen';

		wp_enqueue_script( 'wpb_composer_front_js' );

		$el_class = $this->getExtraClass( $el_class );

		$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row section ' . $custom_class . ' '.get_row_css_class().$el_class, $this->settings['base']);

		$_image = '';
		if ( $background_image != ' ' ) {
			$_image = wolf_get_url_from_attachment_id( $background_image, 'extra-large' );
		}

		if ( $parallax && 'image' == $background_type && $_image ) {
			$css_class .= ' section-parallax';
		}

		if ( $background_color ) {
			$style .= "background-color:$background_color;";
		}

		if ( 'image' == $background_type ) {

			if ( $background_image ) {
				$style .= "background-image:url($_image);";
			}

			if ( $background_position ) {

				$style .= "background-position:$background_position;";
			}

			if ( $background_repeat ) {
				$style .= "background-repeat:$background_repeat;";
			}

			if ( $background_size == 'cover' ) {

				$style .= "-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;";
			}

			if ( $background_size == 'resize' ) {

				$style .= "-webkit-background-size: 100%; -o-background-size: 100%;-moz-background-size: 100%; background-size: 100%;";
			}

		} // endif image background



		if ( $overlay && ( 'image' == $background_type && $_image || 'video' == $background_type && ( $video_bg_mp4 || $video_bg_youtube_url )  ) ) {
			$_overlay_image = '';
			if ( $overlay_image != ''  ) {
				$_overlay_image = wolf_get_url_from_attachment_id( $overlay_image, 'extra-large' );
			}
			
			if ( $overlay_color ) {
				$overlay_style .= "background-color:$overlay_color;";
			}
			
			if ( $overlay_image ) {
				$overlay_style .= "background-image:url($_overlay_image);";
			}
			
			$overlay_style .= "opacity:$overlay_opacity;";
		}

		$_style = ( $style ) ? ' style="' . wolf_compact_css( $style ) . '"' : '';

		$_overlay_style = ( $overlay_style ) ? ' style="' . wolf_compact_css( $overlay_style ) . '"' : '';

		$section_id = ( $anchor ) ? ' id="' . $anchor . '"' : '';

		$output .= '<div' . $_style . $section_id . ' class="' . $css_class . '">';

		$inner_style = '';

		if ( '' != $padding_top ) {
			$padding_top = ( is_numeric( $padding_top ) ) ? $padding_top .'px' : $padding_top;
			$inner_style .= "padding-top:$padding_top;";
		}

		if ( '' != $padding_bottom ) {
			$padding_bottom = ( is_numeric( $padding_bottom ) ) ? $padding_bottom .'px' : $padding_bottom;
			$inner_style .= "padding-bottom:$padding_bottom;";
		}

		if ( $video_bg_mp4 && 'video' == $background_type && 'selhosted' == $video_bg_type ) {
			$video_bg_img = ( $video_bg_img ) ? wolf_get_url_from_attachment_id( absint( $video_bg_img ), 'extra-large' ) : null;
			$output .= wolf_video_bg( $video_bg_mp4, $video_bg_webm, $video_bg_ogv, $video_opacity, $video_bg_img, $parallax );
		}
		//elseif( $video_bg_youtube_url && 'video' == $background_type && 'youtube' == $video_bg_type ) {
			$output .= wolf_youtube_video_bg( $video_bg_youtube_url );
		//}

		if ( $overlay )
			$output .= '<div class="row-overlay"' . $_overlay_style . '></div>';

		$output .= "<div class='wolf-row-inner' style='$inner_style'>";

		$output .= '<div class="wrap">';
		$output .= wpb_js_remove_wpautop( $content );
		$output .= '</div><!--.wrap-->';
		$output .= "\n";

		$output .= '</div><!--.wolf-row-inner-->';
		$output .= "\n"; // end row inner
		$output .= '</div><!--.wolf-row-->';
		return $output;
	}
	// add_shortcode( 'vc_row', 'wolf_row_shortcode'  );
}
