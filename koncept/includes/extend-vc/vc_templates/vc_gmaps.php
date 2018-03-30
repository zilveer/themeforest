<?php
$output = $title = $link = $size = $zoom = $type = $bubble = $el_class = '';
extract(shortcode_atts(array(
    'link' => '',
    'size' => 200,
    'zoom' => 14,
    'type' => 'default',
    'map_lat' => '',
    'map_long' => '',
    'map_img' => '',
    'el_class' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);

$img = wp_get_attachment_image_src( $map_img, 'full' );

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gmaps_widget wpb_content_element'.$el_class, $this->settings['base']);
$output .= "\n\t".'<div class="'.$css_class.'" style="height:' . $size . 'px">';
$output .= "\n\t\t".'<div id="map-' . rand(0, 10000) . '" class="insert-map" data-map-lat="' . $map_lat . '" data-map-long="' . $map_long . '" data-marker-img="' . $img[0] . '" data-zoom="' . $zoom . '" data-greyscale="d-' . $type . '" data-marker="d-' . ( $map_img != '' ? 'true' : 'false' ) . '">';
$output .= "\n\t\t".'</div> ';
$output .= "\n\t".'</div> ';

echo $output;