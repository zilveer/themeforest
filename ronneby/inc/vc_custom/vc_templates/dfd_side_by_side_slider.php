<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$el_class = '';
$args = array(
    'el_class' => ''
);
extract(shortcode_atts($args, $atts));

wp_enqueue_script('dfd-multislider');
wp_enqueue_style('dfd-multislider-css');

$output = '';

$output .= '<div class="dfd-side-by-side-slider '.esc_attr($el_class).'">';
$output .= do_shortcode($content);
$output .= '</div>';

print $output;

