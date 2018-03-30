<?php
wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
//
extract(shortcode_atts(array(
    'title' => '',
    'el_class' => '',
    'type' => 'accordion',
    'size' => 'large',
    'active_tab' => '0',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-accordion clearfix '. $type . ' ' . $size . $el_class.' not-column-inherit', $this->settings['base']);

$output = '<div data-opened="' . $active_tab . '" class="' . $css_class . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . '>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';

echo $output;