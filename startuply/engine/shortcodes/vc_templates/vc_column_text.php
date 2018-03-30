<?php

$output = $el_class = $text_color = $text_align = $css_animation = '';

extract(shortcode_atts(array(
	'el_class' => '',
	'text_color' => '',
	'text_align' => '',
	'css_animation' => '',
	'css' => ''
), $atts));

if ($text_color != '') {
	$t_color = ' color: ' . $text_color . ';';
}else {
	$t_color = '';
}

/*

$output .= "\n\t".'<div class="'.esc_attr( $css_class ).esc_attr( $text_color ).'">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content , true );
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> ' . $this->endBlockComment('.wpb_text_column');
*/

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_text_column wpb_content_element ' . $text_align . ' ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class .= $this->getCSSAnimation($css_animation);

$output = '<div class="' . $css_class . '">';
$output .= '<div class="wpb_wrapper">';
$output .= '<div class="wpb_text_column-text-style" style="'. esc_attr( $t_color ) .'">'.wpb_js_remove_wpautop( $content , true ).'</div>';
// $output .= wpb_js_remove_wpautop($content, true);
$output .= '	</div>';
$output .= '</div>';
echo $output;
