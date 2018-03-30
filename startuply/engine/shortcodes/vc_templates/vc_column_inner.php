<?php
$output = $el_class = $el_align = $css_animation = $width = $offset = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'width' => '1/1',
    'css' => '',
    'offset' => '',
    'css_animation' => '',
    'height' => '',
    'el_align' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = vc_column_offset_class_merge( $offset, $width );

$el_class .= ' wpb_column column_container ';

if ( $height == 'full_height' ) $el_class .= $height;

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class.vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base']);
$css_class .= $this->getCSSAnimation($css_animation);
$output .= "\n\t".'<div class="'.$css_class.' '.$el_align.'">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;
