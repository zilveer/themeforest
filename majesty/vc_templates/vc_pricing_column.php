<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'pricing_table', $el_class );

if( ! empty( $column_style ) ) {
	$column_style = ' ' . $column_style;
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$output = '<div class="'. esc_attr( $css_class ) .'"><div class="price_block'. esc_attr( $column_style ) .'">';
if( ! empty( $title ) ) {
	$output .= '<h3>'. esc_attr( $title ) .'</h3>';
}
if( !empty( $price ) ) {
	$output .= '<div class="price_head"><div class="price_figure">
					<span class="price_number">'. esc_attr( $price ) .' <small>'. esc_attr( $currency ) .'</small></span>';
					if( !empty( $price_subtitle ) ) {
                        $output .= '<span class="price_tenure">'. esc_attr( $price_subtitle ) .'</span>';
					}
    $output .= '</div></div>';
}
$output .= '<ul class="features">';
$column_features = explode( ",", $features );
foreach ( $column_features as $feature ) {
	$output .= '<li>'. esc_attr( $feature ) .'</li>';
}
$output .= '</ul>';

if( !empty( $url ) ) {
	$title_attr_link = '';
	if( ! empty ( $title_attr ) ) {
		$title_attr_link = ' title="'. esc_attr( $title_attr ) .'"';
	} else {
		$title_attr_link = ' title="'. esc_attr( strip_tags ( $title )) .'"';
	}
	$output .= '<div class="footer"><a class="action_button" href="'.esc_url( $url ) .'" target="'. esc_attr( $target ) .'"'. $title_attr_link .'>'. esc_attr( $btn_text ) .'</a></div>';
}

$output .= '</div></div>';
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );