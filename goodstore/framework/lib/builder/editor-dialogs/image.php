<?php

$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Image",
    "desc" => "Choose the image you need or remove it clicking the Remove button. ",
    "id" => "image",
    "type" => "simple_media_picker",
    'std' => '',
    'mod' => 'image',
    'multiple' => false
);


$of_options[] = array(
    'id' => 'lightbox',
    'type' => 'toggle',
    'name' => 'Lightbox',
    'desc' => 'Decide whether or not to open the image using lightbox.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);


$of_options[] = array(
    "name" => "Target Link",
    "desc" => "Insert a target URL of your image.<br><br><strong>Works only when the lightbox is disabled</strong>.",
    "id" => "link",
    "std" => "http://",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'target',
    'type' => 'select',
    'name' => 'Link Target',
    'desc' => 'Specify where to open the image.<br><br><strong>Works only when the lightbox is disabled</strong>.',
    'std' => '_self',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self")
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== Hover ==== */
$of_options[] = array(
    "name" => "Hover",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Hover Image URL",
    "desc" => "Choose the image you want to appear when mouse is moved over the main one.",
    "id" => "hover_image",
    "type" => "simple_media_picker",
    'std' => ''
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
    "options" => array("1" => "On", "0" => "Off", "full-item" => "Full-Item")
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
    "options" => array("off" => "Off", "space" => "Off without space", "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");

/* Settings */
global $jaw_builder_options;
$jaw_builder_options['image'] = $of_options;
