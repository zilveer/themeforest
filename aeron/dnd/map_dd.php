<?php

/*********** Shortcode: Google Map ************************************************************/

$ABdevDND_shortcodes['map_dd'] = array(
	'attributes' => array(
		'h' => array(
			'default' => '400px',
			'description' => __('Height', 'dnd-shortcodes'),
		),
		'map_type' => array(
			'type' => 'select',
			'default' => 'ROADMAP',
			'description' => __('Map Type', 'dnd-shortcodes'),
			'values' => array(
				'ROADMAP' => __('ROADMAP', 'dnd-shortcodes'),
				'SATELLITE' => __('SATELLITE', 'dnd-shortcodes'),
				'HYBRID' => __('HYBRID', 'dnd-shortcodes'),
				'TERRAIN' => __('TERRAIN', 'dnd-shortcodes'),
			),
		),

		'lat' => array(
			'default' => '40.7782201',
			'description' => __('Map Center Latitude', 'dnd-shortcodes'),
		),
		'lng' => array(
			'default' => '-73.9733317',
			'description' => __('Map Center Longitude', 'dnd-shortcodes'),
		),
		'zoom' => array(
			'type' => 'select',
			'default' => '16',
			'description' => __('Zoom Level', 'dnd-shortcodes'),
			'values' => array(
				'1' => __('1', 'dnd-shortcodes'),
				'2' => __('2', 'dnd-shortcodes'),
				'3' => __('3', 'dnd-shortcodes'),
				'4' => __('4', 'dnd-shortcodes'),
				'5' => __('5', 'dnd-shortcodes'),
				'6' => __('6', 'dnd-shortcodes'),
				'7' => __('7', 'dnd-shortcodes'),
				'8' => __('8', 'dnd-shortcodes'),
				'9' => __('9', 'dnd-shortcodes'),
				'10' => __('10', 'dnd-shortcodes'),
				'11' => __('11', 'dnd-shortcodes'),
				'12' => __('12', 'dnd-shortcodes'),
				'13' => __('13', 'dnd-shortcodes'),
				'14' => __('14', 'dnd-shortcodes'),
				'15' => __('15', 'dnd-shortcodes'),
				'16' => __('16', 'dnd-shortcodes'),
				'17' => __('17', 'dnd-shortcodes'),
				'18' => __('18', 'dnd-shortcodes'),
				'19' => __('19', 'dnd-shortcodes'),
				'20' => __('20', 'dnd-shortcodes'),
				'21' => __('21', 'dnd-shortcodes'),
			),
		),
		'scrollwheel' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Enable Scrollweel', 'dnd-shortcodes'),
		),
		'maptypecontrol' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => __('Show Map Type Controls', 'dnd-shortcodes'),
		),
		'pancontrol' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => __('Show Pan Controls', 'dnd-shortcodes'),
		),
		'zoomcontrol' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => __('Show Zoom Controls', 'dnd-shortcodes'),
		),
		'scalecontrol' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => __('Show Scale Controls', 'dnd-shortcodes'),
		),
		'markertitle' => array(
			'default' => 'Our Company',
			'description' => __('Marker Title', 'dnd-shortcodes'),
		),
		'markericon' => array(
			'type' => 'image',
			'description' => __('Custom Marker Image', 'dnd-shortcodes'),
		),
		'markercontent' => array(
			'default' => 'Our Address',
			'description' => __('Marker Content', 'dnd-shortcodes'),
		),
		'markerlat' => array(
			'default' => '40.7782201',
			'description' => __('Marker Latitude', 'dnd-shortcodes'),
		),
		'markerlng' => array(
			'default' => '-73.973331',
			'description' => __('Marker Longitude', 'dnd-shortcodes'),
		),
	),
	'description' => __('Google Map', 'dnd-shortcodes' )
);
function ABdevDND_map_dd_shortcode( $attributes ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('map_dd'), $attributes));
	static $i = 0;
	$i++;
	
	$map_data = '
		data-map_type="'.$map_type.'" 
		data-lat="'.$lat.'" 
		data-lng="'.$lng.'" 
		data-zoom="'.$zoom.'" 
		data-scrollwheel="'.$scrollwheel.'" 
		data-maptypecontrol="'.$maptypecontrol.'" 
		data-pancontrol="'.$pancontrol.'" 
		data-zoomcontrol="'.$zoomcontrol.'" 
		data-scalecontrol="'.$scalecontrol.'" 
		data-markertitle="'.$markertitle.'" 
		data-markericon="'.$markericon.'" 
		data-markercontent="'.$markercontent.'" 
		data-markerlat="'.$markerlat.'" 
		data-markerlng="'.$markerlng.'" 
	';

	return '<div id="dnd_google_map_'.$i.'" '.$map_data.' class="dnd_google_map" style="height:'.$h.';width:100%;"></div>';
}

