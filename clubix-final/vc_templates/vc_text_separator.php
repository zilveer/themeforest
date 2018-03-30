<?php
$output = $title = '';
extract(shortcode_atts(array(
    'title' => '',
    'el_class' => ''
), $atts));

$text = '[clx_text_divider text="'.$title.'"]';
$output .= do_shortcode($text);

$output .= $this->endBlockComment('separator')."\n";

echo $output;