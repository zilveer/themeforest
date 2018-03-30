<?php

 
 $of_options = array();
        
/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Clip URL",
    "desc" => "Enter URL of a Vimeo video clip.",
    "id" => "clip_id",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");



$of_options[] = array(
    'id' => 'auto_height',
    'type' => 'toggle',
    'name' => 'Automatic height of video',
    'desc' => 'Video will keep ratio 16:9',
    'std' => '1',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'height',
    'type' => 'range',
    'name' => 'Height',  
    'desc' => 'Set height of the video window.',
    'std' => '480',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);


$of_options[] = array(
    'id' => 'autoplay',
    'type' => 'toggle',
    'name' => 'Autoplay',
    'desc' => 'Decide whether or not to allow the video to automatically start playing.'
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
$jaw_builder_options['v_video'] = $of_options;