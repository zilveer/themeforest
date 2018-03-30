<?php

$args = array(
    "columns"     => "four_columns",
    "circle_line" => "no_line",
);

$html = "";

extract(shortcode_atts($args, $atts));

$html = '<ul class="q_circles_holder '.$columns.' '.$circle_line.'">';

$html .= do_shortcode($content);

$html .= '</ul>';

echo $html;