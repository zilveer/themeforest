<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "desc" => "Insert HTML code of your carousel&acute;s item.",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "HTML Content",
    "desc" => "Click the <strong>[ + ]</strong> button to add new item to your carousel. The trash button removes the item.",
    "id" => "content",
    "std" => "",
    "mod" => "textarea",
    "type" => "list"
);


$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'carousel_style',
    'type' => 'toggle',
    'name' => 'Carousel Navigation Style',
    'desc' => 'Decide where to place the carousel&acute;s navigation arrows.',
    'std' => 'bar',
    "builder" => 'true',
    "options" => array("bar" => "In Bar", "side" => "On Sides")
);

$of_options[] = array(
    'id' => 'automatic_slide',
    'type' => 'toggle',
    'name' => 'Automatic Sliding',
    'desc' => 'Decide whether or not to allow moving a content of your carousel automatically.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'size',
    'type' => 'range',
    'name' => 'Size of One Element',
    'desc' => 'Specify the size of one element (12 is full width).',
    'std' => '3',
    'min' => '2',
    'max' => '12',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    'id' => 'post_in_slide',
    'type' => 'range',
    'name' => 'Number of Posts in One Slide',
    'desc' => 'Set number of posts to be shown in one slide.',
    'std' => '4',
    'min' => '1',
    'max' => '10',
    'step' => '1',
    'unit' => ''
);

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
$jaw_builder_options['html_carousel'] = $of_options; 