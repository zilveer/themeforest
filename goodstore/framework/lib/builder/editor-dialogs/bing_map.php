<?php

 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Latitude",
    "id" => "latitude",
    "std" => "",
    "desc" => "Enter a latitude value in decimal number.",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Longtitude",
    "id" => "longitude",
    "std" => "",
    "desc" => "Enter a longitude value in decimal number.",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'zoom',
    'type' => 'range',
    'name' => 'Zoom',
    'desc' => 'Select a zoom level for the map.',
    'std' => '1',
    'value' => "1",
    'min' => '1',
    'max' => '19',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    'id' => 'marker',
    'type' => 'toggle',
    'name' => 'Map Marker',
    'desc' => 'Decide whether or not to show marker on the map.',
    "std" => "0",
);



$of_options[] = array(
    'id' => 'scrollwheel',
    'type' => 'toggle',
    'name' => 'Disable Scroll Wheel',
    'desc' => 'Turn the option on if using of a mouse scroll wheel on the map has to be disabled.',
    "std" => "0",
);

$of_options[] = array(
    'id' => 'dragable',
    'type' => 'toggle',
    'name' => 'Disable Panning the Map',
    "std" => "0",
    'desc' => 'Turn the option on to not to allow panning the map using mouse (drag & drop).'
);

$of_options[] = array(
    "name" => "Map Type",
    "id" => "maptype",
    "std" => "auto",
    "type" => "select",
    'desc' => 'Select the map type you prefer.',
    "builder" => 'true',
    "options" => array(
        "" => "Choose",
        "auto" => "Auto",
        "road" => "Road",
        "aerial" => "Aerial",
        "birdseye" => "Birdseye"
    )
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'height',
    'type' => 'range',
    'name' => 'Height',
    'desc' => 'Set height of your map in pixels.',
    'std' => '600',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    'id' => 'fullwidth',
    'type' => 'toggle',
    'name' => 'Full Width',
    'desc' => 'Choose ON option to add a color background over the entire width of the element. To expand your map only, select the Full-Item option.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off", "full-item" => "Full-Item")
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== BAR ==== */
$of_options[] = array(
    "name" => "Bar",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'bar_type',
    'type' => 'toggle',
    'name' => 'Bar Type',
    'desc' => 'Select this element&acute;s header type.',
    'std' => 'big',
    "builder" => 'true',
    "options" => array("off" => "Off", "space" => "Off without space", "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");

 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['bing_map'] = $of_options; 