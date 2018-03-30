<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Tabs",
    "desc" => "Open up the Content item and fill in the tab&acute;s title and description fields.<br><br>To add a new tab, click the Add New Tab button.",
    "id" => "tabs",
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
    'id' => 'style',
    'type' => 'toggle',
    'name' => 'Style',
    'desc' => 'Select the tab style you prefer.',
    'std' => 'light',
    "builder" => 'true',
    "options" => array("light" => "Light", "colored" => "Colored")
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
$jaw_builder_options['tabs'] = $of_options; 