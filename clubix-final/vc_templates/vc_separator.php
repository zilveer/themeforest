<?php
$output = $type = '';
extract( shortcode_atts( array(
    'type' => ''
), $atts ) );

$text = '[clx_divider type="'.$type.'"]';
$output .= do_shortcode($text);

echo($output);