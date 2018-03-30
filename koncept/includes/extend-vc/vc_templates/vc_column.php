<?php
$output = $el_class = $width = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'width' => '1/1',
    'css' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);

$width = preg_replace('/vc_col\-(xs|sm|md|lg)\-(\d{1,2})/', 'span$2', $width);
$css = str_replace( ' !important', '', preg_replace("/(.+)\{(.+)\}/", "$2", $css ) );

$output .= "\n\t".'<div class="krown-column-container clearfix ' . ( $el_class != '' ? $el_class . ' ' : '' ) . $width . '" style="'. $css . '">';
$output .= "\n\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;