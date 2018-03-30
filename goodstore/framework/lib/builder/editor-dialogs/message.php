<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Message Text",
    "desc" => "Fill in the field with your message.",
    "id" => "message_text",
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
    'desc' => 'Select a type of message. Depending on the selected item, the look of your message will vary while being formatted using the options below.',
    'std' => 'success',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array( "success" => "Success","info" => "Info", "warning" => "Warning", "danger" => "Danger"),
);


$of_options[] = array(
    'id' => 'show_icon',
    'type' => 'toggle',
    'name' => 'Show Icons',
    'desc' => '',
    'std' => '1',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'show_close',
    'type' => 'toggle',
    'name' => 'Show Close button',
    'desc' => 'Decide whether or not to use icons before your messages.',
    'std' => '1',
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
$jaw_builder_options['message'] = $of_options; 