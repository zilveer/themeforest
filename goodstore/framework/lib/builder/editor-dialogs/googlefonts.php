<?php

 
 $of_options = array();


/* ==== Content ==== */
$of_options[] = array(
    "name" => "Content",    
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Content",
    "desc" => "Insert a content to be shown using the Google font specified in the Design tab.",
    "id" => "content",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    "type" => "sectionend");



/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'fullwidth',
    'type' => 'toggle',
    'name' => 'Full Width',
    'desc' => 'Decide whether or not to set this element to full width.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'font_family',
    'type' => 'text',
    'name' => 'Font Family',
    'desc' => "Insert the Google font family you need. To get a complete list of fonts visit <a href='http://www.google.com/webfonts' target='_blank'>this Google page</a>.",
    'std' => ''
);

$of_options[] = array(
    'id' => 'font_size',
    'type' => 'range',
    'name' => 'Font Size',
    'desc' => 'Set font size in pixels.',
    'std' => '18',
    'min' => '1',
    'max' => '50',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    "name" => "Font Color",
    "desc" => "Pick a text color (by default: #000000).",
    "id" => "color",
    "std" => "#000000",
    "type" => "color"
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
$jaw_builder_options['googlefonts'] = $of_options; 