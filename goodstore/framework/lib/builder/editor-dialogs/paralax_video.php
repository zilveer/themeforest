<?php

 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Custom Text",
    "desc" => "Your custom content field.",
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
    "name" => "Video MP4",
    "desc" => "Choose a background video in MP4 format.",
    "id" => "bg_video_mp4_src",
    "type" => "simple_media_picker",
    'std' => ''
);

$of_options[] = array(
    "name" => "Video WebM/Ogg",
    "desc" => "Choose a background video in WebM or Ogg format.",
    "id" => "bg_video_ogg_src",
    "type" => "simple_media_picker",
    'std' => ''
);


$of_options[] = array(
    "name" => "Substitute image for phones",
    "desc" => "",
    "id" => "bg_video_image",
    "type" => "simple_media_picker",
    'std' => ''
);


$of_options[] = array(
    "name" => "Background Color",
    "desc" => "",
    "id" => "bg_video_color",
    "std" => "#000000",
    "type" => "color"
);


$of_options[] = array(
    'id' => 'sticky_background',
    'type' => 'toggle',
    'name' => 'Background withour border',
    'desc' => 'Video without top space (use for more paralax in row)',
    'std' => 'off',
    "builder" => 'true',
    "options" => array("off"=>"Off", "on" => "On")
);



$of_options[] = array(
    'id' => 'pattern',
    'type' => 'toggle',
    'name' => 'Use Pattern',
    'desc' => 'Decide whether or not to use pattern. ',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'padding',
    'type' => 'range',
    'name' => 'Top and Bottom Padding',
    'desc' => 'Set the top and bottom padding value.',
    'std' => '50',
    'min' => '0',
    'max' => '200',
    'step' => '1',
    'unit' => 'px'
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
$jaw_builder_options['paralax_video'] = $of_options; 