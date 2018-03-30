<?php

 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Custom Text",
    "desc" => "Insert your custom text or create and format it using this editor.",
    "id" => "custom_text",
    "std" => "",
    "type" => "tinymce_editor"
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
    "name" => "Fullwidth Background Color",
    "desc" => "Pick a color of background to be applied in full width mode (by default: #000000).",
    "id" => "full_back_color",
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
 



/* ==== Background ==== */
$of_options[] = array(
    "name" => "Background",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'use_bg',
    'type' => 'toggle',
    'name' => 'Background',
    'desc' => 'Decide whether or not to use background.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);


$of_options[] = array(
    "name" => "Background Color",
    "desc" => "Pick a background color (by default: #000000).",
    "id" => "bg_color",
    "std" => "#000000",
    "type" => "color"
);


$of_options[] = array(
    "name" => "Background Image",
    "desc" => "Choose a background image.",
    "id" => "bg_image",
    "type" => "simple_media_picker",
    'std' => ''
);


$of_options[] = array(
    'id' => 'height',
    'type' => 'range',
    'name' => 'Height',
    'desc' => 'Set height of the custom text element.',
    'std' => '50',
    'min' => '0',
    'max' => '500',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    'id' => 'padding-top',
    'type' => 'range',
    'name' => 'Text Top Margin',
    'desc' => 'Set a top margin value for your text.',
    'std' => '0',
    'min' => '0',
    'max' => '500',
    'step' => '1',
    'unit' => 'px'
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
$jaw_builder_options['custom_text'] = $of_options; 