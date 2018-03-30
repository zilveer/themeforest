<?php
$output = $height = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'height'        => '50',
    'height_2'        => '0',
    'show_border'   => 'no_border'
), $atts));

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-divider', $this->settings['base']);
$output .= '<div class="'.$css_class. ' ' . $show_border . '" style="margin-top:' . $height_2 . 'px;margin-bottom:' . $height . 'px"></div>'.$this->endBlockComment('separator')."\n";

echo $output;