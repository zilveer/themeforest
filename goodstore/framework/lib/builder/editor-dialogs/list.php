<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Title",
    "desc" => "Title of your list.",
    "id" => "title",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'type',
    'type' => 'toggle',
    'name' => 'List Type',
    'desc' => '',
    'std' => 'bullet',
    "builder" => 'true',
    "options" => array("bullet" => "Bulleted", "number" => "Numbered")
);


$of_options[] = array(
    'id' => 'icon',
    'type' => 'icon',
    'name' => 'Bullet Icon',
    'desc' => 'Works only with Bulleted type. Open this <a href="' . THEME_URI . '/help/icons/icons.html?amp;TB_iframe=true" class="thickbox" target="_blank">list of classes</a>, choose the bullet icon you prefer and copy/paste or write down its class name to this field.',
    'std' => 'icon-circle-small',
);

$of_options[] = array(
    "name" => "List Items",
    "desc" => "Fill in the list item field with your text and click the [ + ] button to add next item.<br><br>The trash option removes the item.",
    "id" => "list",
    "std" => "",
    "type" => "list"
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
    "options" => array("off" => "Off", "space" => "Off without space", "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");
 
 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['list'] = $of_options; 