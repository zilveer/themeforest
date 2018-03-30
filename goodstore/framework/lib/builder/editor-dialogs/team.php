<?php

 
 $of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'cats',
    'type' => 'multidropdown',
    'name' => 'Include Team Category',
    'desc' => 'Select the team categories you need.',
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'team-category',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    "name" => "Order",
    "desc" => "Portfolio items order (ascending or descending).",
    "id" => "order",
    "std" => "ASC",
    "type" => "select",
    "builder" => 'true',
    'options' => array("desc" => "Desc", "asc" => "Asc")
);

$of_options[] = array(
    "name" => "Order By",
    "desc" => "Order portfolio items by parameters.",
    "id" => "orderby",
    "std" => "date",
    "type" => "select",
    "builder" => 'true',
    "options" => array("id" => "ID", "none" => "none", "author" => "author", "title" => "title", "date" => "date", "modified" => "modified", "parent" => "parent", "rand" => "rand", "comment_count" => "comment_count", "menu_order" => "menu_order")
);



$of_options[] = array(
    "type" => "sectionend");

/* ==== TEXT SETTING ==== */
$of_options[] = array(
    "name" => "Format",
    "type" => "sectionstart");

$of_options[] = array("name" => "Number of Characters in Excerpt",
    "desc" => "Enter a number of characters to be shown in excerpt.",
    "id" => "letter_excerpt",
    "std" => 0,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
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
    'id' => 'clickable_title',
    'type' => 'toggle',
    'name' => 'Clickable Title',
    'desc' => 'Decide whether or not to make the team titles clickable.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
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
$jaw_builder_options['team'] = $of_options; 