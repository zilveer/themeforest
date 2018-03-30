<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $label_links
 * @var $id_links
 * @var $el_class
 */

$output = $html_ul_menu = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if( empty( $label_links ) || empty( $id_links )  ) {
	return;
}

$el_class = $this->getExtraClass( $el_class );

$html_ul_menu = '<ul id="menu-scroll">';
$label_links = explode( ',', $label_links );
$id_links = explode( ',', $id_links );
$i = - 1;
foreach ( $label_links as $label ){
	$i++;
	if( ! empty( $label ) ) {
		$html_ul_menu .= '<li><a href="#'. esc_attr( $id_links[$i] ) .'" rel="nofollow">'. esc_attr( $label ) .'</a></li>';
	}
}
$html_ul_menu .= '</ul>';
$output .= '<div class="menu-bar theme-menu-scroll dark'. esc_attr( $el_class ) .'">'. $html_ul_menu .'</div>';
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );