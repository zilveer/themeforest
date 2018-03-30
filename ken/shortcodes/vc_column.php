<?php
$output = $el_class = $width = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'offset' => '',
    'border_color' => '',
    'bg_color' => '',
    'css' => '',
    'width' => '1/1',
    'visibility' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = vc_column_offset_class_merge($offset, $width);

$el_class .= ' wpb_column column_container';

$border_color = ($border_color != '') ? ('border:1px solid '.$border_color.';') : '';
$bg_color = ($bg_color != '') ? ('background-color:'.$bg_color.';') : '';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'],  $atts);
$output .= "\n\t".'<div style="'.$border_color.$bg_color.'" class="'.$css_class.' '.$visibility.'">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t".'</div>';

echo $output;