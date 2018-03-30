<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'additional_markers' 	=> '',
	'custom_markers'		=> 'false',
	'latitude' 				=> '',
	'longitude' 			=> '',
	'address' 				=> '',
	'custom_marker_1'		=> '',

	'latitude_2' 			=> '',
	'longitude_2' 			=> '',
	'address_2' 			=> '',
	'custom_marker_2'		=> '',

	'latitude_3'			=> '',
	'longitude_3'			=> '',
	'address_3' 			=> '',
	'custom_marker_3'		=> '',

	'height' 				=> '300',
	'map_height' 			=> 'custom',
	'map_type' 				=> 'ROADMAP',
	'map_zoom' 				=> '14',
	'draggable' 			=> 'true',
	'pan_control'			=> 'true',
	'zoom_control' 			=> 'true',
	'map_type_control' 		=> 'true',
	'scale_control' 		=> 'true',
	'pin_icon' 				=> '',
	'modify_json'			=> 'false',
	'map_json' 				=> '',
	'modify_coloring' 		=> 'false',
	'hue' 					=> '#ccc',
	'saturation' 			=> '1',
	'lightness'				=> '1',
	'content_bg_color'		=> '#4f4f4f',
	'content_font_color'	=> '#fff',
), $atts ) );
Mk_Static_Files::addAssets('mk_advanced_gmaps');