<?php

 
 $of_options = array();


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'type',
    'type' => 'toggle',
    'name' => 'Title Type',
    'desc' => 'Select the title type you prefer.',
    'std' => 'big',
    "builder" => 'true',
    "options" => array("like_divider" => "Divider",  "line" => "Line", "box" => "Box", "big" => "Big title")
);


$of_options[] = array(
    "name" => "Text Color",
    "desc" => "Pick a color of your title (by default: #000000).",
    "id" => "text_color",
    "std" => "#000000",
    "type" => "color"
);

$of_options[] = array(
    "name" => "Line Color",
    "desc" => "Pick a color of the line below your title (by default: #000000).",
    "id" => "line_color",
    "std" => "#000000",
    "type" => "color"
);

$of_options[] = array(
    'id' => 'bar_h',
    'type' => 'toggle',
    'name' => 'H tag type',
    'desc' => '',
    'std' => '3',
    "builder" => 'true',
    "options" => array("1" => "h1", "2" => "h2", "3" => "h3")
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

 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['title'] = $of_options; 