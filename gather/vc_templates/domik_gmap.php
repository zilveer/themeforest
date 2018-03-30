<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $zoom
 * @var $latitude
 * @var $longitude
 * @var $address
 * @var $add_address
 * @var $marker
 * @var $mapheight
 * @var $colorbg
 * Shortcode class
 * @var $this WPBakeryShortCode_Domik_Gmap
 */
$el_class = $zoom = $latitude = $longitude = $address = $add_address = $marker = $mapheight = $colorbg = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(!empty($marker)){
	$marker = wp_get_attachment_url($marker );
}else{
	$marker = get_template_directory_uri() ."/images/marker.png";
}

// wp_enqueue_script('gathergmap-api', 'https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places', array('jquery'), false, true);
// wp_enqueue_script("gatherinfobox-js", get_template_directory_uri() . "/js/plugins/infobox.js", array('gathergmap-api'), false, true);
// wp_enqueue_script("gathergoogle-map-js", get_template_directory_uri() . "/js/plugins/google-map.js", array('gatherinfobox-js'), false, true);
wp_enqueue_script("gathergoogle-hotel-map-js");
?>
<!-- 
 Location Map
 ====================================== -->
<div class="g-maps <?php echo esc_attr($el_class ); ?>" id="venue">
    <!-- Tip:  You can change location, zoom, color theme, height, image and Info text by changing data-* attribute below. -->
    <!-- Available Colors:    red, orange, yellow, green, mint, aqua, blue, purple, pink, white, grey, black, invert -->
    <div class="map" id="map_canvas" data-maplat="<?php echo esc_attr($latitude );?>" data-maplon="<?php echo esc_attr($longitude);?>" data-mapzoom="<?php echo esc_attr($zoom);?>" data-color="<?php echo esc_attr($colorbg );?>" data-height="<?php echo esc_attr($mapheight );?>" data-img="<?php echo esc_url($marker );?>" data-info="<?php echo esc_attr($address);?>"></div>
</div>
<!-- end div.g-maps -->