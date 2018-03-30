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
$el_class = $css = $el_id = $match_height = $vertical_center = $bordered = $bordered_color = $anchor = '';
$output = $disable_element = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
$wrapper_attributes = array();
// build attributes for wrapper
// if ( ! empty( $el_id ) ) {
// 	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
// }

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

if (isset( $atts['gap'] ) && !empty($atts['gap'])) {
    $css_class .= ' vc_column-gap-'.$atts['gap'];
}

if ( 'yes' === $disable_element ) {
    if ( vc_is_page_editable() || !wbc_check_inline() ) {
        $css_class .= ' vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
    }
}

if(isset($match_height) && $match_height == 'yes'){
    $css_class .= ' wbc-eq-height';

    if(isset($vertical_center) && $vertical_center == 'yes'){
        $css_class .= ' wbc-vertical-center';
    }
}

if(isset($no_innerpadding) && $no_innerpadding == 'yes'){
    $css_class .= ' no-inner-padding';
}

if( isset($bordered) && $bordered == 'yes'){
	$css_class .= ' wbc-bordered-area';

	if(isset($bordered_color) && !empty($bordered_color)){
		$wrapper_attributes[] = 'style="border-color:'.esc_attr($bordered_color).';"';
	}
}

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if(!empty($anchor)) $output .= '<span class="anchor-link" id="'.esc_attr( $anchor ).'"></span>';
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $after_output;

echo !empty( $output ) ? $output : '';