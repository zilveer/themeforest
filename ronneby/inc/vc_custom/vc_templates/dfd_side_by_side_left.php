<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$output = $el_class = '';
$args = array(
    'el_class' => ''
);
extract(shortcode_atts($args, $atts));

$output .= '<div class="ms-left '.esc_attr($el_class).'">';
$output .= do_shortcode($content);
$output .= '</div>';

print $output;

