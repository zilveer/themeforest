<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $enable_live_search
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Wp_Search
 */
$title = $el_class = $enable_live_search = '';
$output = '';

extract(shortcode_atts(array(
    'title' => '',
    'enable_live_search' => '',
    'el_class' => '',
), $atts));

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_search wpb_content_element' . esc_attr( $el_class ) . (($enable_live_search === 'yes') ? ' qodef-search-element qodef-live-search-enabled' : ' qodef-search-element') . '">';
$type = 'WP_Widget_Search';
$args = array();
global $wp_widget_factory, $use_live_search;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
    ob_start();
    if ($enable_live_search === 'yes') {
        $use_live_search = true;
    }
    the_widget( $type, $atts, $args );
    $output .= ob_get_clean();
    $use_live_search = false;

	$output .= '</div>';

	echo $output;
} else {
	echo $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_search' );
}
// TODO: make more informative if wp is in debug mode
