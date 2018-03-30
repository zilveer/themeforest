<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
wp_enqueue_script( 'jquery-ui-accordion' );
$output = $title = $interval = $el_class = $collapsible = $disable_keyboard = $active_tab = $titles_alignment = $item_animation = '';
//
extract( shortcode_atts( array(
	'title' => '',
	'interval' => 0,
	'item_animation' => '',
	'el_class' => '',
	'collapsible' => 'no',
	'disable_keyboard' => 'no',
	'active_tab' => '1',
	'titles_alignment' => 'text-left'
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion wpb_content_element ' . $el_class . ' not-column-inherit', $this->settings['base'], $atts );

$animate = $animation_data = '';

if ( ! ( $item_animation == '' ) ) {
	$animate        .= ' cr-animate-gen';
	$animation_data .= 'data-animate-type = "' . esc_attr($item_animation) . '" ';
}

$output .= "\n\t" . '<div class="' . esc_attr($css_class) . ' '.esc_attr($animate).'" '.$animation_data.'  data-collapsible="' . esc_attr($collapsible) . '" data-vc-disable-keydown="' . ( esc_attr( ( 'yes' == $disable_keyboard ? 'true' : 'false' ) ) ) . '" data-active-tab="' . $active_tab . '">'; //data-interval="'.$interval.'"
$output .= "\n\t\t" . '<div class="wpb_wrapper wpb_accordion_wrapper ui-accordion '.esc_attr($titles_alignment).'">';
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_accordion_heading' ) );

$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_accordion' );

echo $output;