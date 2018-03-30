<?php
/**
 * Shortcode attributes
 * @var $cats_title
 * @var $cats_css
 * @var $display_show_all
 * @var $show_all_text
 * @var $width
 * @var $marginb
 * @var $display_filter_as
 * @var $circleimg  ver 1.2.9
 * @var $el_class
 */
wp_enqueue_script('isotope');

$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'theme-menu-filter-container', $el_class );

if( ! empty( $marginb ) ) {
	$css_classes[] = sanitize_html_class($marginb);
}
if( isset( $circleimg ) && $circleimg == 'true' ) {
	$css_classes[] = 'img-with-circle';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

global $vc_menu_filter_col;
$vc_menu_filter_col = 'col-sm-12 col-md-6';
if( empty( $width ) && $width = '1/1' ) {
	$vc_menu_filter_col = 'col-sm-12';
}
$cats_title = explode( ",", $cats_title );
$cats_css = explode( ",", $cats_css );
$menu_bar_css = 'dark';
if( $display_filter_as == 'light' ) {
	$menu_bar_css = 'light';
}
$filter_html = '<div class="menu-bar text-center '. esc_attr( $menu_bar_css ) .'"><ul class="menu-fillter clearfix">';
if( $display_show_all == 'true' && ! empty( $show_all_text ) ) {
	$filter_html .= '<li class="activeFilter"><a rel="nofollow" href="#" data-filter="*">'.esc_attr( $show_all_text ) .'</a></li>';
}
$i = 0;
foreach( $cats_title as $cat_title ) {
	if( ! isset( $cats_css[$i] ) ) {
		$cats_css[$i] = sanitize_html_class($cat_title);
	}
	$filter_html .= '<li><a rel="nofollow" href="#" data-filter=".'. sanitize_html_class($cats_css[$i]) .'">'. esc_attr($cat_title) .'</a></li>';
	$i++;
}
$filter_html .= '</ul></div>';

$id = 'theme-menu-filter-'. rand(1,9999);
$output  = '<div id="'. esc_attr($id) .'" class="'.esc_attr($css_class).'">';
$output	.= $filter_html;
$output .= '<div class="container mt100"><div class="theme-menu-items">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div></div>';
$output .= '</div>';
echo $output;