<div class="bg-section map contact-intro-map" id="map"></div>
<div class="buttons-map">
	<div class="show-map-btn non-active-map" data-hidden-text="<?php echo __('Hide map', 'BERG') ;?>" data-shown-text="<?php echo __('Show map', 'BERG') ;?>"><a href="" class="btn btn-xs btn-dark"><?php echo __('Show map', 'BERG') ;?></a></div>
</div>
<?php
$locations = YSettings::g("multiple_contact_map_div"); 
$tmp = $locations['multiple_contact_locations'];
$tmp = explode("|", $tmp);

$mapLocations = array();
foreach ($tmp as $key => $value) {
	$image = $locations["multiple_contact_map_marker_image_" . $value];
	$mapLocations[] = array(
		'uuid' => $value,
		'lat' => (float)$locations["multiple_contact_map_lat_" . $value],
		'lng' => (float)$locations["multiple_contact_map_lng_" . $value],
		'marker' => ($image == '') ? false : $image,
		'markerHeight' => $locations["multiple_contact_marker_height_" . $value],
		'markerWidth' => $locations["multiple_contact_marker_width_" . $value],
		'header' => $locations["multiple_contact_address_header_" . $value],
		'desc' => $locations["multiple_contact_address_desc_" . $value],
		'address' => $locations["multiple_contact_map_address_" . $value]
	);
}

wp_register_script('contact', THEME_DIR_URI . '/js/contact.js', array('jquery'), '1.0', true);
wp_localize_script('contact', 'contactOptions', array(
	'mapLocations' => array('locations' => $mapLocations),
	'mapType'	=> YSettings::g('contact_map_type'),
	'mapStyle' => YSettings::g('contact_map_styles'),
));
wp_enqueue_script('contact');

?>

<div class="mapMarkerColor"></div>