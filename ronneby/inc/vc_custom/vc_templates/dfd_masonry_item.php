<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$output = $data_category = "";

extract(shortcode_atts(array(
	'data_category' => '',
	'el_class' => '',
), $atts));

$output .= '<div class="dfd-isotope-item" data-category="'.esc_attr($data_category).'">';
$output .= do_shortcode($content);
$output .= '</div>';

print $output;

