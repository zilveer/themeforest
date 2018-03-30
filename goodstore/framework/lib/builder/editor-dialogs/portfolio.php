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
    'desc' => 'Choose the portfolio categories to be shown in your portfolio.',
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'portfolio-category',
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
    "name" => "Number of Items Per Page",
    "desc" => "Set number of portfolio items per page.",
    "id" => "count",
    "std" => "50",
    "mod" => "medium",
    "type" => "text"
);


$of_options[] = array(
    "name" => "Pagination Style",
    "desc" => "Select the pagination style you prefer.",
    "id" => "pagination",
    "std" => "none",
    "builder" => 'true',
    "type" => "select",
    "options" => array("ajax" => "ajax", "infinite" => "infinite", "infinitemore" => "infinite with more", "none" => "none", "number" => "number", "wordpress" => "wordpress")
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
    'desc' => 'Add fullscreen colored background.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    "name" => "Info box Text Color",
    "desc" => "Pick a color of the info box text which appears when mouse is moved over item (by default: #000000).",
    "id" => "info_text_color",
    "std" => "#000000",
    "type" => "color"
);


$of_options[] = array(
    "name" => "Info Box Color",
    "desc" => "Pick a background color of the info box (by default: #ffffff).",
    "id" => "info_color",
    "std" => "#ffffff",
    "type" => "color"
);


$of_options[] = array(
    'id' => 'info_opacity',
    'type' => 'range',
    'name' => 'Info Box Opacity',
    'desc' => 'Set transparency level for the info box (by default: 90%).',
    'std' => '90',
    'min' => '0',
    'max' => '100',
    'step' => '10',
    'unit' => '%'
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== BAR ==== */
$of_options[] = array(
    "name" => "Bar",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'bar_filter',
    'type' => 'toggle',
    'name' => 'Filtering Options',
    'desc' => 'Decide whether or not to show filtering options in the element&acute;s bar.',
    'std' => '1',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);


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
$jaw_builder_options['portfolio'] = $of_options;
