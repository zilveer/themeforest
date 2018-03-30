<?php
$output = $font_color = $el_class = $width = $offset = $bg_image_postions = $bg_image_attach = $parallax_img = $parallax_repeat = $border_color = $bg_color = $margin_array = $padding_array = $content_align = '';
extract(shortcode_atts(array(
	'font_color'    => '',
	'el_class'      => '',
	'width'         => '1/1',
	'css'           => '',
	'offset'        => '',
	'content_align' => '',

	//img
	'bg_image_postions' => '',
	'bg_image_attach'   => '',
	'bg_color'          =>'',
	'parallax_img'      => '',
	'parallax_repeat'   => '',

	//Animation
	'wbc_animation' => '',
	'wbc_duration'  => '',
	'wbc_delay'     => '',
	'wbc_offset'    => '',
	'wbc_iteration' => '',

	'color_overlay' => '',

	//padding
    'p_top'    => '',
    'p_bottom' => '',
    'p_left'   => '',
    'p_right'  => '',

    //margin
    'm_top'    => '',
    'm_bottom' => '',
    'm_left'   => '',
    'm_right'  => '',
), $atts));

$padding_array = array(
    'padding-top'    => $p_top,
    'padding-bottom' => $p_bottom,
    'padding-left'   => $p_left,
    'padding-right'  => $p_right,
    );

$margin_array = array(
    'margin-top'    => $m_top,
    'margin-bottom' => $m_bottom,
    'margin-left'   => $m_left,
    'margin-right'  => $m_right,
    );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

$data_tags = '';
if( !empty($wbc_animation) ){
	wp_enqueue_style( 'wbc907-animated' );
	wp_enqueue_script( 'wbc-wow' );
	
	$el_class .= ' wow '.$wbc_animation;

	if(!empty($wbc_duration)){
		$data_tags .=' data-wow-duration="'.esc_attr( $wbc_duration ).'"';
	}
	if(!empty($wbc_delay)){
		$data_tags .=' data-wow-delay="'.esc_attr( $wbc_delay ).'"';
	}
	if(!empty($wbc_offset)){
		$data_tags .=' data-wow-offset="'.esc_attr( $wbc_offset ).'"';
	}
	if(!empty($wbc_iteration)){
		$data_tags .=' data-wow-iteration="'.esc_attr( $wbc_iteration ).'"';
	}
}
// $style = $this->buildStyle( $font_color );

$style = wbc907buildStyle($parallax_img, $bg_color, $parallax_repeat, $font_color, $padding_array, $margin_array, $bg_image_postions, $bg_image_attach, $border_color);

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$output .= "\n\t".'<div class="'.$css_class.' '.$content_align.'"'.$data_tags.'>';

$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '" '.$style.'>';
if( isset($color_overlay) && !empty($color_overlay) ){
	$output .= "\n\t\t".'<div class="section-overlay" style="background-color:'. esc_attr( $color_overlay ).'"></div>';
}
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= '</div>';
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";
echo !empty( $output ) ? $output : '';