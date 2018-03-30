<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Accordion",
    "desc" => "Open the Content 1 dropdown item and fill in the accordion&acute;s title and description fields with your content.<br><br>To add another slide, click the Add New Slide.",
    "id" => "accordion",
    "std" => "",
    "type" => "tabs"
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

 
$of_options[] = array(
    'id' => 'open_first',
    'type' => 'toggle',
    'name' => 'Open First Item as Default',
    'desc' => 'Decide whether or not to open the first item as default.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1"=>"On", "0" => "Off")
);

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
    'desc' => 'Select this element&acute;s header type.',
    'std' => 'big',
    "builder" => 'true',
    "options" => array("off"=>"Off", "space" => "Off without space",  "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");

 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['accordion'] = $of_options; 