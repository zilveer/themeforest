<?php

 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Gallery",
    "desc" => "Click the button to add/edit your gallery.",
    "id" => "gallery",
    "type" => "media_picker"
);



$of_options[] = array(
    'id' => 'lightbox',
    'type' => 'toggle',
    'name' => 'Lightbox',
    'desc' => 'Decide whether or not to open images using lightbox.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    "type" => "sectionend");



/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'class',
    'type' => 'text',
    'name' => 'Custom Class',
    'desc' => 'Insert your custom class for this element.',
    'std' => ''
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
    'desc' => 'Decide whether or not to set this element to full width.',
    'std' => 'big',
    "builder" => 'true',
    "options" => array( "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");

 
 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['gallery'] = $of_options; 