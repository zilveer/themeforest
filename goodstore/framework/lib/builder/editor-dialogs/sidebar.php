<?php
 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Sidebar",
    "desc" => 'Choose a sidebar from the list of your custom ones.',
    "id" => "build_sidebar",
    "type" => "sidebar_select",
    'mod' => 'medium',
    'builder' => 'true'
);

$of_options[] = array(
    'id' => 'sidebars',
    'type' => 'sidebars',
    'name' => 'Sidebar Manager',
    'desc' => 'Here you can add or remove your optional sidebars. To add new sidebar, fill in the field with a name you want and click the Add New Sidebar button.' ,
    'std' => jwOpt::get_option('sidebars')
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
    'desc' => 'Select this element&acute;s header type.',
    'std' => 'big',
    "builder" => 'true',
    "options" => array("off"=>"Off", "space" => "Off without space",  "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");

 
 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['sidebar'] = $of_options; 