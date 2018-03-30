<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */

// VC CORE
$el_class = $width = $css = $offset = $output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

// Define wrapper attributes
$wrapper_attributes = array(); // Important define early for Total

// Add classes
$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

// TOTAL => CS animation
if ( ! empty( $css_animation ) ) {
	$css_classes[] = $this->getCSSAnimation( $css_animation );
}

// TOTAL => Visibility
if ( ! empty( $visibility ) ) {
	$css_classes[] = $visibility;
}

// TOTAL => Style fallback
if ( ! empty( $style ) && 'default' != $style ) {
	$css_classes[] = $style .'-column';
}

// TOTAL => Typography Style
if ( ! empty( $typo_style ) && empty( $typography_style ) ) {
	$css_classes[] = wpex_typography_style_class( $typo_style  );
} elseif ( empty( $typo_style ) && ! empty( $typography_style ) ) {
	$css_classes[] = wpex_typography_style_class( $typography_style );
}

/*** TOTAL => START Inline CSS ***/

	// Generate inline CSS
	$inline_style = '';

	// Min Height
	if ( $min_height ) {
		$inline_style .= 'min-height:'. $min_height .';';
	}

	// Inline css styles => Fallback For OLD Total Params
	if ( empty( $css ) && function_exists( 'vcex_parse_deprecated_row_css' ) ) {
		$inline_style .= vcex_parse_deprecated_row_css( $atts, 'inline_css' );
	}

	// Add inline style to wrapper attributes
	if ( $inline_style ) {
		$inline_style = ' style="'. $inline_style .'"';
	}

/*** TOTAL => END Inline CSS  ***/

// VC CORE => Generate css class
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

// TOTAl => Create design class
if ( $css ) {
	$design_class = ' '. trim( vc_shortcode_custom_css_class( $css ) );
} else {
	$design_class = '';
}

// COMBINED => Output
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
// CSS classname + min-height is added to vc_column-inner to fix padding bug from VC/Bootsrap
$output .= '<div class="vc_column-inner wpex-clr">';
// Custom CSS styles MUST be added to the wpb_wrapper to prevent issues with the negative margins and offsets
$output .= '<div class="wpb_wrapper wpex-vc-column-wrapper wpex-clr '.  esc_attr( $design_class )  .'"'. $inline_style .'>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;