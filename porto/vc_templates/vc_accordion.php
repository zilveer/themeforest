<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $collapsible
 * @var $disable_keyboard : removed
 * @var $active_tab
 * @var $content - shortcode content
 *
 * Extra Params
 * @var $type
 * @var $size
 * @var $skin : 'custom',
 * @var $heading_color
 * @var $heading_bg_color
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Accordion
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

//wp_enqueue_script('jquery-ui-accordion');

$id = 'accordion' . rand();
$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel-group '.$el_class.' '.$type.($type == 'custom' && $skin != 'custom' ? ' panel-group-' . $skin . ' ' : '') . ' ' . $size, $this->settings['base']);

if ($type == 'custom' && $skin == 'custom' && ($heading_color || $heading_bg_color)) {
    $output .= '<style type="text/css">';
    if ($heading_color) $output .= '#' . $id . '.panel-group .panel-heading a { color: ' . $heading_color . ' }';
    if ($heading_bg_color) $output .= '#' . $id . '.panel-group .panel-heading { background-color: ' . $heading_bg_color . ' }';
    $output .= '</style>';
}

$output .= '<div class="' . esc_attr( $css_class ) . '" id="' . $id . '" data-collapsible="' . esc_attr( $collapsible ) . '" data-active-tab="' . $active_tab . '">'; //data-interval="'.$interval.'"
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));

$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';

echo $output;