<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $zoom
 * @var $latitude
 * @var $longitude
 * @var $mapheight
 * @var $distance
 * @var $types
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Hotel_Search
 */
$el_class = $zoom = $latitude = $longitude = $mapheight = $distance = $types = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// wp_enqueue_script('gathergmap-api', 'https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places', array('jquery'), false, true);
// wp_enqueue_script("gatherinfobox-js", get_template_directory_uri() . "/js/plugins/infobox.js", array('gathergmap-api'), false, true);
// wp_enqueue_script("gatherhotel-map-js", get_template_directory_uri() . "/js/plugins/hotel-map.js", array('gatherinfobox-js'), false, true);
wp_enqueue_script("gathergoogle-hotel-map-js");
?>
<div class="hotel_map wow fadeInUp" style="margin-bottom:50px;">
    <div id="hotel_mapcanvas" class="hotel-map" data-maplat="<?php echo esc_attr($latitude );?>" data-maplon="<?php echo esc_attr($longitude);?>" data-mapzoom="<?php echo esc_attr($zoom);?>" data-height="<?php echo esc_attr($mapheight );?>"  data-distance="<?php echo esc_attr($distance );?>" data-types="<?php echo esc_attr($types );?>"></div>
</div>