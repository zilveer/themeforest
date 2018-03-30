<?php

$args = array(
    "columns"         => "three_columns"
);

$html = "";

extract(shortcode_atts($args, $atts));

$html = '<div class="animated_icons_with_text clearfix '.esc_attr($columns).'">';

$html .= do_shortcode($content);

$html .= '</div>';

print $html;

