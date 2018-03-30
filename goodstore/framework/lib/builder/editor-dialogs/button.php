<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Label",
    "desc" => "Fill in the button label.",
    "id" => "title",
    "std" => "Button",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Target Link",
    "desc" => "Insert a target URL for your button.",
    "id" => "link",
    "std" => "http://",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'target',
    'type' => 'select',
    'name' => 'Link Target',
    'desc' => 'Specify where to open a target link.',
    'std' => '_self',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self")
);

$of_options[] = array(
    "type" => "sectionend");

/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'button_size',
    'type' => 'toggle',
    'name' => 'Button Size',
    'desc' => 'Select the button size you prefer.',
    'std' => 'default',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("btn-xs" => "Extra Small", "btn-sm" => "Small", "default" => "Default", "btn-lg" => "Large")
);

$of_options[] = array(
    'id' => 'button_bg_color',
    'type' => 'color',
    'name' => 'Button Background Color',
    'desc' => 'Pick a color of the button background (by default: #EFEFEF).',
    'std' => '#EFEFEF',
    "builder" => 'true',
    'format' => 'rgba'
);

$of_options[] = array(
    'id' => 'button_border_color',
    'type' => 'color',
    'name' => 'Button Border Color',
    'desc' => 'Pick a color of the button border (by default: #5E605F).',
    'std' => '#5E605F',
    "builder" => 'true',
);

$of_options[] = array(
    'id' => 'button_font_color',
    'type' => 'color',
    'name' => 'Custom Button Font Color',
    'desc' => 'Pick a color of the button label text (by default: #5E605F).',
    'std' => '#5E605F',
    "builder" => 'true',
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
$jaw_builder_options['button'] = $of_options; 