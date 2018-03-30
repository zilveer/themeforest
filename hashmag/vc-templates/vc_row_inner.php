<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$output = $after_output = $inner_start = $inner_end = $after_wrapper_open = $before_wrapper_close = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_inner',
	'vc_row-fluid',
	'mkdf-section',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
$wrapper_attributes = array();
$inner_attributes = array();
$wrapper_style = '';
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

/*** Additional Options ***/

if( ! empty($row_type) && $row_type == 'parallax'){
	$css_classes[] = 'mkdf-parallax-section-holder';

	if(hashmag_mikado_options()->getOptionValue('parallax_on_off') == 'off'){
		$css_classes[] = 'mkdf-parallax-section-holder-touch-disabled';
	}
	if($parallax_speed != ''){
		$wrapper_attributes[] =  'data-mkdf-parallax-speed="'.$parallax_speed.'"';
	}
	else{
		$wrapper_attributes[] =  'data-mkdf-parallax-speed="1"';
	}
}

if( ! empty($content_aligment)){
	$css_classes[] = 'mkdf-content-aligment-' . $content_aligment;
}

if($content_width == 'grid'){
	$css_classes[] =  'mkdf-grid-section';
	$css_inner_classes[] = 'mkdf-section-inner';
	$inner_start .= '<div class="mkdf-section-inner-margin clearfix">';
	$inner_end .= '</div>';
} else{
	$css_inner_classes[] = 'mkdf-full-section-inner';
}

if($row_type == 'row' && $css_animation != ''){
	$inner_start .= '<div class="mkdf-row-animation-inner '. $css_animation .'" data-animation="'.$css_animation.'">';
	if($transition_delay !== ''){
		$animation_styles = array();
		$animation_styles[] = 'transition-delay: '.$transition_delay.'ms';
		$animation_styles[] = '-webkit-animation-delay: '.$transition_delay.'ms';
		$animation_styles[] = 'animation-delay: '.$transition_delay.'ms';
		$inner_start .= '<div '.hashmag_mikado_get_inline_style($animation_styles).'>';
		$inner_end .= '</div>';
	}else{
		$inner_start .= '<div>';
		$inner_end .= '</div>';
	}
	$inner_end .= '</div>';
}

if($parallax_background_image != ''){

	$parallax_image_link =  wp_get_attachment_url($parallax_background_image);
	$wrapper_style .= 'background-image:url('.$parallax_image_link.');';

}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$css_inner_classes = preg_replace( '/\s+/', ' ', implode( ' ', $css_inner_classes ));
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$wrapper_attributes[] = 'style="' . $wrapper_style . '"';
$inner_attributes[] = 'class="' . esc_attr( trim( $css_inner_classes ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $after_wrapper_open;
$output .= '<div ' . implode( ' ', $inner_attributes ) . '>';
$output .= $inner_start;
$output .= wpb_js_remove_wpautop( $content );
$output .= $inner_end;
$output .= '</div>';
$output .= $before_wrapper_close;
$output .= '</div>';
$output .= $after_output;

print $output;
