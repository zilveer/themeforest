<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $url
 * @var $items
 * @var $options
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Wp_Rss
 */
$wtstyle = veda_opts_get('wtitle-style', '');

$before_title = '<h3 class="widgettitle">';
$after_title = '</h3>';

if( $wtstyle == 'type17' ) {
	$before_title = ' <div class="mz-title"> <div class="mz-title-content"> <h3 class="widgettitle">';
	$after_title  = '</h3> </div> </div>';
} elseif( $wtstyle == 'type18' ) {
	$before_title = ' <div class="mz-stripe-title"> <div class="mz-stripe-title-content"> <h3 class="widgettitle">';
	$after_title  = '</h3> </div> </div>';
}

$args = array(
	'before_title' => $before_title,
	'after_title' => $after_title
);

$title = $url = $items = $options = $el_class = '';

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts['url'] = html_entity_decode( $atts['url'], ENT_QUOTES ); // fix #2034
extract( $atts );

if ( '' === $url ) {
	return;
}

$options = explode( ',', $options );
if ( in_array( 'show_summary', $options ) ) {
	$atts['show_summary'] = true;
}
if ( in_array( 'show_author', $options ) ) {
	$atts['show_author'] = true;
}
if ( in_array( 'show_date', $options ) ) {
	$atts['show_date'] = true;
}

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_rss wpb_content_element' . esc_attr( $el_class ) . '">';
$type = 'WP_Widget_RSS';
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	$output .= '</div>';

	echo $output;
} else {
	echo $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_rss' );
}
