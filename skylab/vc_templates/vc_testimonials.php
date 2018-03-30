<?php

$output = $el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
	'dot_navigation_color' => '',
	'randomize_testimonial_order' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class, $this->settings['base']);

if ( ! empty( $dot_navigation_color ) ) {
    $data_dot_navigation_color = 'data-dot-navigation-color="'.$dot_navigation_color.'"';
} else {
	$data_dot_navigation_color = '';
}

if ( ! empty( $randomize_testimonial_order ) ) {
    $randomize_testimonial_order = 'true';
} else {
	$randomize_testimonial_order = 'false';
}

wp_enqueue_script('flexslider');

$output .= "\n\t".'<div class="testimonialsslider '.$css_class.'" data-randomize-testimonial-order="'.$randomize_testimonial_order.'" '.$data_dot_navigation_color.'>';
$output .= "\n\t\t".'<ul class="slides">';

$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</ul> '.$this->endBlockComment('.slides');
$output .= "\n\t".'</div> '.$this->endBlockComment('.testimonialsslider');

echo $output;