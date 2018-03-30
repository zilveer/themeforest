<?php
$output = $el_class = $width = $el_position = '';
extract(shortcode_atts(array(
'el_class' => '',
'el_position' => '',
'width' => '1/2'
), $atts));

$el_class = $this->getExtraClass($el_class);
$el_class .= ' wpb_raw_html';
$content =  rawurldecode(base64_decode(strip_tags($content)));
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_raw_code wpb_content_element'.$el_class, $this->settings['base']);
$output .= $content;

echo $output;