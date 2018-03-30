<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'css' => '',
    //attributes related with parallax section
    'parallax_section' => '',
	'parallax_id'		=> '',
	'parallax_overlay_color' => '#FFFFFF',
    'parallax_overlay_color_opacity' => '0.0',
	'parallax_padding_top' => '',
	'parallax_padding_bottom' => ''
), $atts));

// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
if( $parallax_section == "yes" ){
	
	$css_class .= ' parallax';
	$parallax_padding_style = '';
	if( $parallax_padding_top != '' ){
		$parallax_padding_style .= ' padding-top: ' . $parallax_padding_top . 'px;';
	}
	if( $parallax_padding_bottom != '' ){
		$parallax_padding_style .= ' padding-bottom: ' . $parallax_padding_bottom . 'px;';
	}
	
	require_once ( get_template_directory() . '/include/util_functions.php');
    $overlay_rgba    = hex2rgba( $parallax_overlay_color, $parallax_overlay_color_opacity );
}
$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

$row_id = '';
if( !empty( $parallax_id ) ){
	
	$row_id = 'id="' . $parallax_id . '"';	
}

$output .= '<div '. $row_id .'  class="'.$css_class.'"'.$style.'>';
if( $parallax_section == "yes" ){
	$output .= '<div class="overlay" style="background-color:' . $overlay_rgba . '; ' . $parallax_padding_style . '">';
}
$output .= wpb_js_remove_wpautop($content);
if( $parallax_section == "yes" ){
	$output .= '</div>';	// overlay
}
$output .= '</div>'.$this->endBlockComment('row');

echo $output;