<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");


$of_options[] = array(
    "name" => "Data",
    "desc" => "Name your progress bar and enter a value in percentage (0 - 100).<br><br>To add a new progress bar, click the [ + ] button.",    
    "id" => "chart",
    "std" => "",
    "type" => "circle_chart"
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'animate',
    'type' => 'toggle',
    'name' => 'Animate',
    'desc' => 'Choose whether or not to animate the progress bar.',
    'std' => '1',
    "builder" => 'true',
    "options" => array( "1" => "On","0" => "Off")
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
$jaw_builder_options['progressbar'] = $of_options;