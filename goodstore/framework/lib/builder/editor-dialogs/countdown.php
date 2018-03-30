<?php
 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "End Date & Time",
    "desc" => "Enter date and time in format YYYY-MM-DD-hh-mm-ss (e.g. 2015-05-30-16-50-00)",
    "id" => "datetime",
    "std" => "YYYY-MM-DD-hh-mm-ss",
    "type" => "text"
);

$of_options[] = array(
    "type" => "sectionend");



/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'count_style',
    'type' => 'toggle',
    'name' => 'Style',
    'desc' => 'Choose a style of the countdown element.',
    'std' => 'boxed',
    "builder" => 'true',
    "options" => array("boxed" => "Boxed", "wide" => "Wide")
);

$of_options[] = array(
    "name" => "Text Color",
    "desc" => "Pick a color of the countdown text.",
    "id" => "color",
    "std" => "#000000",
    "type" => "color"
);

$of_options[] = array(
    'id' => 'hide_days',
    'type' => 'toggle',
    'name' => 'Days',
    'desc' => 'Decide whether or not to show days in your countdown.',
    'std' => 'show-days',
    "builder" => 'true',
    "options" => array("show-days" => "Show", "hide-days" => "Hide")
);
$of_options[] = array(
    'id' => 'hide_sec',
    'type' => 'toggle',
    'name' => 'Seconds',
    'desc' => 'Decide whether or not to show seconds in your countdown.',
    'std' => 'show-sec',
    "builder" => 'true',
    "options" => array("show-sec" => "Show", "hide-sec" => "Hide")
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
$jaw_builder_options['countdown'] = $of_options;