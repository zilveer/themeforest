<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $full_width = $el_id = $parallax_image = $parallax = '';
extract( shortcode_atts( array(
	'el_class' => '',
	'bg_image' => '',
	'bg_color' => '',
	'bg_image_repeat' => '',
	'font_color' => '',
	'padding' => '',
	'margin_bottom' => '',
	'full_width' => false,
	'parallax' => false,
	'parallax_image' => false,
	'css' => '',
	'el_id' => '',
	'foundry_background_style' => 'light-wrapper',
	'append_hr' => 'no',
	'foundry_padding' => 'normal-padding',
	'foundry_icons' => 'no',
	'foundry_vertical_align' => 'no',
	'full_height' => false,
	'foundry_parallax' => 'overlay parallax'
), $atts ) );

wp_enqueue_script( 'wpb_composer_front_js' );

//Is this fullscreen?
if ( 'yes' == $full_height ) {
	$foundry_padding = 'fullscreen';
}

//Append background style class
$el_class .= ' ' . $foundry_background_style . ' ' . $foundry_padding;

//Capture background image if set
preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $css, $image);
if(!( isset($image[0][0]) ))
	$image[0][0] = false;
	
$background_image_class = ($image[0][0]) ? 'image-bg ' . $foundry_parallax : false;
$vertical_center = ( 'fullscreen' == $foundry_padding ) ? 'v-align-transform' : false;
$vertical_center_children = ( 'yes' == $foundry_vertical_align ) ? 'v-align-children' : false;

/**
 * Check for scroll id
 */
if(isset( $el_id ) && ! empty( $el_id ))
	$output .= '<a id="'. ebor_sanitize_title($el_id) .'" class="in-page-link" href="#"></a>';
	
/**
 * foundry specific output
 */
if( 'stretch_row' == $full_width ){
	
	$css_classes = array(
		$el_class,
		vc_shortcode_custom_css_class( $css ),
	);
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
	
	$output .= '<div class="row '. $foundry_background_style .' '. $el_class .' '. $css_class .'">' . wpb_js_remove_wpautop($content) . '</div>' . $this->endBlockComment('row');
	
} else {
	
	$css_classes = array(
		'vc_row',
		'wpb_row', //deprecated
		'vc_row-fluid',
		$el_class,
		vc_shortcode_custom_css_class( $css ),
	);
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
	
	$output .= '<section class="'. $background_image_class .' '. $el_class .' '. $css_class .'">';
	
	if( $background_image_class ){
		$output .= '
			<div class="background-image-holder">
			    <img alt="Background" class="background-image" src="'. esc_url($image[0][0]) .'" />
			</div>
		';
	}
	
	$output .= '<div class="container '. $vertical_center .'"><div class="row '. $vertical_center_children .'">';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div>';
	
	if( 'yes' == $foundry_icons ){
		$output .= '
			<div class="embelish-icons">
			    <i class="ti-marker"></i>
			    <i class="ti-layout"></i>
			    <i class="ti-ruler-alt-2"></i>
			    <i class="ti-eye"></i>
			    <i class="ti-signal"></i>
			    <i class="ti-pulse"></i>
			    <i class="ti-marker"></i>
			    <i class="ti-layout"></i>
			    <i class="ti-ruler-alt-2"></i>
			    <i class="ti-eye"></i>
			    <i class="ti-signal"></i>
			    <i class="ti-pulse"></i>
			</div>	
		';	
	}
	
	$output .= '</div></section>'.$this->endBlockComment('row');
	
}

if( 'yes' == $append_hr )
	$output .= '<hr class="mb0">';

echo $output;