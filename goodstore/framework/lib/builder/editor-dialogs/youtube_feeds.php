<?php

 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "YouTube User Name",
    "desc" => 'Fill in the field with the name of the YouTube user you want to fetch content from.',
    "id" => "user_name",
    "type" => "text",
);

$of_options[] = array(
    'id' => 'count',
    'type' => 'range',
    'name' => 'Number of Videos',
    'desc' => 'Set number of videos in the feed.',
    'std' => '6',
    'min' => '1',
    'max' => '40',
    'step' => '1',
    'unit' => ''
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
$jaw_builder_options['youtube_feeds'] = $of_options; 