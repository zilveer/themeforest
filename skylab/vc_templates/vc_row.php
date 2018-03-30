<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $bg_parallax_scrolling = $bg_video = $bg_overlay_color = $fallback_image = $bg_overlay_opacity = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
	'css' => '',
	'bg_parallax_scrolling'   => '',
	'bg_video'   => '',
	'bg_overlay_color'   => '',
	'bg_overlay_opacity'   => '.8',
	'fallback_image'   => ''
), $atts));

//wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
//wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row ' . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
if ( $bg_parallax_scrolling != 'yes' ) {
	if ( ! empty( $bg_video ) ) {
		if ( ! empty( $fallback_image ) ) {
			$fallback_image_url = wp_get_attachment_url( $fallback_image, 'full' );
		} else {
			$fallback_image_url = '';
		}
		$output .= '<div class="'.$css_class.' clearfix"'.$style.'>';
			$output .= '<div class="covervid-wrapper">';
				if ( ! empty( $bg_overlay_color ) ) {
					$output .= '<div class="bg-overlay-color" style="background-color: '.$bg_overlay_color.'; opacity: '.$bg_overlay_opacity.';"></div>';
				}
				$output .= '<video class="covervid-video" autoplay loop poster="'.$fallback_image_url.'">';
					$output .= '<source src="'.$bg_video.'" type="video/webm">';
					//$output .= '<source src="'.$bg_video.'" type="video/mp4">';
				$output .= '</video>';
			$output .= '</div>';
	} else {
		$output .= '<div class="'.$css_class.' clearfix"'.$style.'>';
			if ( ! empty( $bg_overlay_color ) ) {
				$output .= '<div class="bg-overlay-color-wrapper">';
					$output .= '<div class="bg-overlay-color" style="background-color: '.$bg_overlay_color.'; opacity: '.$bg_overlay_opacity.';"></div>';
				$output .= '</div>';
			}
	}
} else {
	$output .= '<div class="'.$css_class.' clearfix parallax"'.$style.' data-600-top="background-position:50% 75%;" data--600-top="background-position:50% 25%;" data-smooth-scrolling="on">';
	if ( ! empty( $bg_overlay_color ) ) {
		$output .= '<div class="bg-overlay-color-wrapper">';
			$output .= '<div class="bg-overlay-color" style="background-color: '.$bg_overlay_color.'; opacity: '.$bg_overlay_opacity.';"></div>';
		$output .= '</div>';
	}
}
$output .= '<div class="wrapper clearfix">';
$output .= '<div class="inner-wrapper clearfix">';	
$output .= wpb_js_remove_wpautop($content);
$output .= '</div></div></div>'.$this->endBlockComment('row');

echo $output;