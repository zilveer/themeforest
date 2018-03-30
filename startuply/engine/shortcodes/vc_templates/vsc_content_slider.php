<?php
$output = $slider_options = $speed = $autoplay_delay = $css = $el_class = $attrs = $autoplay = $pagination = $arrows = $loop = '';
extract( shortcode_atts( array(
	'slider_options' => '',
	'speed' => '500',
	'autoplay_delay' => '4000',
	'css' => '',
	'el_class' => ''
), $atts ) );

wp_enqueue_script('vsc-content-slider');

$el_class = $this->getExtraClass( $el_class );

$autoplay = $pagination = $arrows = $loop = 'false';

$slider_options = explode( ',', $slider_options );
if ( in_array( 'autoplay', $slider_options ) ) $autoplay = 'true';
if ( in_array( 'pagination', $slider_options ) ) $pagination = 'true';
if ( in_array( 'arrows', $slider_options ) ) $arrows = 'true';
if ( in_array( 'loop', $slider_options ) ) $loop = 'true';

$attrs .= ' data-pagination="' . $pagination . '" data-arrows="' . $arrows . '" data-autoplay="' . $autoplay . '" data-loop="' . $loop . '" data-speed="' . intval($speed) . '" data-interval="' . intval($autoplay_delay) . '"';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( ' wpb_content_element ' . $el_class ) . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$output .= '<div class="vsc_content_slider ' . $css_class . '"' . $attrs . '>';
$output .= "\n\t" . '<div class="slider-content">';

$output .= "\n\t\t\t" . '<div class="bx-slider ' . $css_class . '">';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "\n\t\t\t" . "</div>";

$output .= "\n\t" . "</div>";
$output .= '</div> ';

echo $output;
