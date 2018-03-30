<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Title",
    "desc" => "Insert title of your info box.",
    "id" => "title",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    "name" => "Content",
    "desc" => "Fill in the field with your text.",
    "id" => "text_content",
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
    'id' => 'message_style',
    'type' => 'select',
    'name' => 'Message Type',
    'desc' => 'Select a type of message. Depending on the selected item, the look of your message will vary.',
    'std' => 'success',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array( "success" => "Success","info" => "Info", "warning" => "Warning", "danger" => "Danger"),
);

$of_options[] = array(
    'id' => 'class',
    'type' => 'text',
    'name' => 'Custom class',
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
$jaw_builder_options['panel_box'] = $of_options; 