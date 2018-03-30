<?php

 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'number',
    'type' => 'range',
    'name' => 'Number of Comments',
    'desc' => 'Set number of comments to show.',
    'std' => '6',
    'min' => '1',
    'max' => '50',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    'id' => 'offset',
    'type' => 'range',
    'name' => 'Offset Comments',
    'desc' => 'Set number of comments to be skipped.',
    'std' => '0',
    'min' => '0',
    'max' => '50',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    'id' => 'post_id',
    'type' => 'text',
    'name' => 'Post IDs',
    'desc' => 'Enter post IDs separated by commas.',
    'std' => ''
);

$of_options[] = array(
    'id' => 'post_type',
    'type' => 'select',
    'name' => 'Post Type',
    'desc' => 'Select a post type from the list.',
    'std' => 'post',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => get_post_types(array('public' => true)),
);

$of_options[] = array(
    'id' => 'status',
    'type' => 'select',
    'name' => 'Status',
    'desc' => 'Set status selecting an appropriate item from the list.',
    'std' => 'approve',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("hold" => "unapproved comments", "approve" => "approved comments", "spam" => "spam comments", "trash" => "trash comments"),
);

$of_options[] = array(
    'id' => 'order',
    'type' => 'select',
    'name' => 'Comments Order',
    'desc' => 'Comments order (ascending or descending).',
    'std' => 'DESC',
    'mod' => 'small',
    "builder" => 'true',
    'options' => array("DESC" => "Desc", "ASC" => "Asc")
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
$jaw_builder_options['comments'] = $of_options; 