<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_id
 * @var $content - shortcode content
 *
 * Extra Params
 * @var $show_icon
 * @var $icon_type
 * @var $icon_image
 * @var $icon
 * @var $icon_simpleline
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Accordion_tab
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$col_id = 'collapse' . rand();

switch ($icon_type) {
    case 'simpleline': $icon_class = $icon_simpleline; break;
    case 'image': $icon_class = 'icon-image'; break;
    default: $icon_class = $icon;
}
if (!$show_icon)
    $icon_class = '';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel panel-default', $this->settings['base']);
$output .= '<div class="' . esc_attr( $css_class ) . '">';
$output .= '<div class="panel-heading"><h4 class="panel-title">';
$output .= '<a class="accordion-toggle" data-toggle="collapse" href="#' . $col_id . '">';
if ($icon_class) {
    $output .= '<i class="' . $icon_class . '">';
    if ($icon_class == 'icon-image' && $icon_image) {
        $icon_image = preg_replace('/[^\d]/', '', $icon_image);
        $image_url = wp_get_attachment_url($icon_image);
        $image_url = str_replace(array('http:', 'https:'), '', $image_url);
        if ($image_url)
            $output .= '<img alt="" src="' . esc_url($image_url) . '">';
    }
    $output .= '</i>';
}
$output .= $title;
$output .= '</a>';
$output .= '</h4></div>';

$output .= '<div id="' . $col_id . '" class="accordion-body collapse">';
$output .= '<div class="panel-body">';
$output .= ( '' !== trim( $content ) ) ? wpb_js_remove_wpautop($content, false) : __("Empty section. Edit page to add content here.", "js_composer");
$output .= '</div>';
$output .= '</div>';

$output .= '</div> ';

echo $output;