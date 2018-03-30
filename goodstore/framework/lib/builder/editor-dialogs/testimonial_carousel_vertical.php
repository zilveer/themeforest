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
    'desc' => 'Choose the categories you want to use in the carousel.',
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'testimonial-category',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    'id' => 'posts',
    'type' => 'text',
    'name' => 'Testimonial Posts',
    'desc' => 'Insert IDs of the testimonial posts you want to show.',
    'std' => ''
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
    'desc' => 'Order posts by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>',
    'std' => 'date',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
        "author" => "Author", "title" => "Title", "modified" => "Modified",
        "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count")
);


$of_options[] = array(
    'id' => 'count_carousel_post',
    'type' => 'range',
    'name' => 'Number of Posts',
    'desc' => 'Set number of testimonial posts per page.',
    'std' => '6',
    'min' => '1',
    'max' => '40',
    'step' => '1',
    'unit' => ''
);
$of_options[] = array(
    'id' => 'post_in_slide',
    'type' => 'range',
    'name' => 'Number of Posts in One Slide',
    'desc' => 'Set number of testimonial posts to be shown in one slide.',
    'std' => '3',
    'min' => '1',
    'max' => '10',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");
$of_options[] = array(
    'id' => 'carousel_style',
    'type' => 'toggle',
    'name' => 'Carousel Navigation Style',
    'desc' => 'Decide where to place the carousel&acute;s navigation arrows.',
    'std' => 'bar',
    "builder" => 'true',
    "options" => array("bar" => "In bar", "side" => "On the sides")
);
$of_options[] = array(
    'id' => 'automatic_slide',
    'type' => 'toggle',
    'name' => 'Automatic sliding',
    'desc' => 'Decide whether or not to allow moving a content of your carousel automatically.',
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
$jaw_builder_options['testimonial_carousel_vertical'] = $of_options; 
