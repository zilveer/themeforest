<?php
 
 $of_options = array();



/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Content of QR Code",
    "desc" => "Fill in the field with the content to be displayed in a QR reader when the code is being readed.",
    "id" => "qrcode",
    "std" => "",
    "type" => "textarea"
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
$jaw_builder_options['qrcode'] = $of_options; 