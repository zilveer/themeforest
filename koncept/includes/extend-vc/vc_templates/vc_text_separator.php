<?php
$output = $title = $subtitle = $align = $style = $height = $margin = $el_class = '';
extract(shortcode_atts(array(
    'title' => __("Title", "krown"),
    'subtitle' => "",
    'margin' => '50',
    'align' => 'left',
    'el_class' => '',
    'style' => 'large'
), $atts));
$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-section-title clearfix ' . $align . ' style-normal'. $el_class, $this->settings['base']);

$output .= '<div class="krown-section-title clearfix ' . $style . ' ' . $el_class . ' align-' . $align . '" style="margin-bottom:' . $margin . 'px;text-align:' . $align . '">';

$output .= '<h3>' . $title . '</h3>';

if ( isset( $atts['subtitle'] ) && $atts['subtitle'] != '' ) {
	$output .= '<h5>' . $subtitle . '</h5>';
}

$output .= '</div>';

echo $output;