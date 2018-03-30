<?php
 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");


$of_options[] = array(
    "name" => '<i class="icon-location"></i> Address',
    "id" => "g_address",
    "std" => "",
    "desc" => "Enter an address and click the button to convert it to its GPS coordinates.",
    "type" => "google_address"
);  
    
$of_options[] = array(
    "name" => '<i class="icon-arrow4 "></i> Latitude',
    "id" => "latitude",
    "std" => "",
    "desc" => "Enter a latitude value in decimal number (if the Address field above is empty).",
    "type" => "text"
);

$of_options[] = array(
    "name" => '<i class="icon-arrow3"></i> Longitude',
    "id" => "longitude",
    "std" => "",
    "desc" => "Enter a longitude value in decimal number (if the Address field above is empty).",
    "type" => "text"
); 

$of_options[] = array(
    'id' => 'zoom',
    'type' => 'range',
    'name' => '<i class="icon-search3 "></i> Zoom',
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
    'name' => '<i class="icon-location"></i> Map Marker',
    'desc' => 'Decide whether or not to show marker on the map.',
    "std" => "0",
);

$of_options[] = array(
    "name" => '<i class=" icon-file-xml "></i> Marker Description',
    "desc" => "Enter your marker description via HTML code.",
    "id" => "description",
    "std" => "",
    "type" => "textarea"
);
$of_options[] = array(
    'id' => 'description_open',
    'type' => 'toggle',
    'name' => '<i class=" icon-info  "></i> Marker Description Opened',
    "desc" => "Decide when the marker description has to be opened.",
    "std" => "start",
    "options" => array("click"=>"After click", "start" => "On start")
);

$of_options[] = array(
    'id' => 'controls',
    'type' => 'toggle',
    'name' => '<i class=" icon-scale-down "></i> Map Controls',
    "desc" => "Decide whether or not to make the map control tools available.",
    "std" => "1",
);

$of_options[] = array(
    'id' => 'disabledoubleclickzoom',
    'type' => 'toggle',
    'name' => '<i class="icon-mouse3 "></i>  Disable Doubleclick Zoom',
    "desc" => "Turn this option on to disable doubleclick zoom feature.",
    "std" => "1",
);

$of_options[] = array(
    'id' => 'scrollwheel',
    'type' => 'toggle',
    'name' => '<i class="icon-mouse2 "></i>  Enable Scrool Wheel',
    "desc" => "Turn this option on to enable using of a mouse scroll wheel on the map.",
    "std" => "0",
);

$of_options[] = array(
    'id' => 'dragable',
    'type' => 'toggle',
    'name' => '<i class="icon-expand "></i> Panning Map',
    'desc' => 'Decide whether or not to allow panning the map using mouse (drag & drop).',
    "std" => "1",
);

$of_options[] = array(
    "name" => '<i class="icon-map"></i> Map Type',
    "id" => "maptype",
    "std" => "ROADMAP",
    "desc" => "Select the map type you prefer.",
    "type" => "select",
    "builder" => 'true',
    "options" => array(
        "" => "Choose",
        "ROADMAP" => "Road Map",
        "SATELLITE" => "Google Earth Map",
        "HYBRID" => "Mixture of normal and satellite",
        "TERRAIN" => "Physical Map"
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
    'desc' => 'Set height of your map.',
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
    'desc' => 'Choose the ON option to add a color background over the entire width of the element. To expand your map only, select the Full-Item option.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On","0" => "Off","full-item" => "full-item")
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
    "options" => array("off"=>"Off", "space" => "Off without space",  "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");


 
 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['google_map'] = $of_options; 