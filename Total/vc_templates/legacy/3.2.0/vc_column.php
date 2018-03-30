<?php
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

// Declare vars
$output = '';

// Get shortcode attributes
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

// Extract attributes
extract( $atts );

// Get column widths
$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

// Define wrapper attributes
$wrapper_attributes = array();

// Add classes
$css_classes = array(
    $this->getExtraClass( $el_class ),
    'wpb_column',
    'vc_column_container',
    $width,
);
if ( ! empty( $css_animation ) ) {
    $css_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( ! empty( $visibility ) ) {
    $css_classes[] = $visibility;
}
if ( ! empty( $style ) && 'default' != $style ) {
    $css_classes[] = $style .'-column';
}
if ( ! empty( $typo_style ) && empty( $typography_style ) ) {
    $css_classes[] = wpex_typography_style_class( $typo_style  );
} elseif ( empty( $typo_style ) && ! empty( $typography_style ) ) {
    $css_classes[] = wpex_typography_style_class( $typography_style );
}

/**** TOTAL INLINE CSS ***/

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

/*** TOTAL INLINCE CSS END ***/

// Get css class
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

// Add classes to wrap attributes
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
    // CSS classname + min-height is added to wpb_wrapper to fix padding bug from VC/Bootsrap
    $output .= '<div class="wpb_wrapper wpex-vc-column-wrapper wpex-clr '. vc_shortcode_custom_css_class( $css ) .'"'. $inline_style .'>';
    $output .= wpb_js_remove_wpautop( $content );
    $output .= '</div>' . $this->endBlockComment( '.wpb_wrapper' );
$output .= '</div>' . $this->endBlockComment( $this->getShortcode() );

// Echo shortcode attribute
echo $output;