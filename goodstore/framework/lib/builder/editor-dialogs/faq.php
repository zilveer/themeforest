<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'cats',
    'type' => 'multidropdown',
    'name' => 'Include Category',
    'desc' => 'Choose your FAQ categories.',
    "page" => null,
    "chosen" => "true",
    "target" => 'faq-category',
    "prompt" => "Choose category..",
    "builder" => "true"
);

$of_options[] = array(
    'id' => 'count',
    'type' => 'range',
    'name' => 'Number of Posts',
    'desc' => 'Set number of posts per page.',
    'std' => '6',
    'min' => '1',
    'max' => '40',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    'id' => 'order',
    'type' => 'select',
    'name' => 'Post Order',
    'desc' => 'Posts order (ascending or descending).',
    'std' => 'desc',
    'mod' => 'small',
    "builder" => 'true',
    'options' => array("desc" => "Desc", "asc" => "Asc")
);

$of_options[] = array(
    'id' => 'orderby',
    'type' => 'select',
    'name' => 'Post Order by',
    'desc' => 'Order posts by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>.',
    'std' => 'date',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
        "author" => "Author", "title" => "Title", "modified" => "Modified",
        "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count")
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
$jaw_builder_options['faq'] = $of_options; 