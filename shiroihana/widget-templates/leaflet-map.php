<?php

$leaflet_options = array(
	'center'             => array( $center_lat, $center_lng ), 
	'zoom'               => absint( $zoom ), 
	'zoomControl'        => in_array( 'zoom', $controls ), 
	'attributionControl' => in_array( 'attribution', $controls ), 
	'scaleControl'       => in_array( 'scale', $controls ), 
	'markers'            => $markers
);

$leaflet_options_json = json_encode( $leaflet_options );

$aspect_ratio_value = 75;
if( isset( $aspect_ratio['w'], $aspect_ratio['h'] ) ) {
	$ratio_w = floatval( $aspect_ratio['w'] );
	$ratio_h = floatval( $aspect_ratio['h'] );
	if( $ratio_w != 0 && $ratio_h != 0 ) {
		$aspect_ratio_value = 100.0 / ( $ratio_w / $ratio_h );
	}
}

echo '<div class="leaflet-map-holder" style="position: relative; padding-top: ' . esc_attr( $aspect_ratio_value ) . '%">' . 
	'<div class="leaflet-map" data-leaflet-options="' . esc_attr( $leaflet_options_json ) . '"' . 
	' data-mapbox-access-token="' . esc_attr( $access_token ) . '"' . 
	' style="position: absolute; left: 0; top: 0; width: 100%; height: 100%;"></div></div>';