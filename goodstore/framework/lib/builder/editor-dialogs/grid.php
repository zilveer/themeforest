<?php

global $jaw_builder_options;

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");
    
$of_options[] = array(
    'id' => 'post_type',
    'type' => 'toggle',
    'name' => 'Source',
    'desc' => 'Choose whether to show posts or products in the slider.',
    'std' => 'post',
    "builder" => 'true',
    "options" => array("post" => "Posts", "custom" => "Custom")
);

$of_options[] = array(
    'id' => 'size',
    'name' => 'Size',
    'desc' => 'Number of shown colums. Big image takes 2 columns.',
    'std' => '12',
    'type' => 'layout',
    'class' => 'fullwidth-option',
    "builder" => 'true',
    "options" => array(
        "1" => ADMIN_DIR . 'assets/images/grid/1.png',
        "12" => ADMIN_DIR . 'assets/images/grid/1-2.png',
        "13" => ADMIN_DIR . 'assets/images/grid/1-3.png',
        '14' => ADMIN_DIR . 'assets/images/grid/1-4.png',
        '141' => ADMIN_DIR . 'assets/images/grid/1-4-1.png',
        "2" => ADMIN_DIR . 'assets/images/grid/2.png',
        "21" => ADMIN_DIR . 'assets/images/grid/2-1.png',
        "3" => ADMIN_DIR . 'assets/images/grid/3.png',
        '31' => ADMIN_DIR . 'assets/images/grid/3-1.png',
        '4' => ADMIN_DIR . 'assets/images/grid/4.png',
        "41" => ADMIN_DIR . 'assets/images/grid/4-1.png'
    )
);

$of_options[] = array(
    "type" => "sectionend");
    
/* ==== Posts ==== */
$of_options[] = array(
    "name" => "Posts",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'count',
    'type' => 'text',
    'name' => 'Number of Posts',
    'desc' => 'Set number of posts in whole grid. <strong>Only posts with Featured Image will be shown.</strong>',
    'std' => '10',
);

$of_options[] = array(
    'id' => 'category__in',
    'type' => 'multidropdown',
    'name' => 'Include Category (optional)',
    'desc' => 'Select all the categories you need to fetch posts from.' . ' ' . jwUtils::getHelp("mpb_incl_cat"),
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'cat',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    'id' => 'post__in',
    'type' => 'text',
    'name' => 'Include Posts (optional)',
    'desc' => 'The posts you want to show. Separate their IDs with coma (like 52, 45, 87 etc.). If this field is blank, all posts will be used.' . ' ' . jwUtils::getHelp("mpb_incl_post"),
    "std" => '',
);

$of_options[] = array(
    'id' => 'author__in',
    'type' => 'multidropdown',
    'name' => 'Include Authors (optional)',
    'desc' => 'Select the authors whose posts you want to display. If this field is blank, the posts from all authors will be used.' . ' ' . jwUtils::getHelp("mpb_incl_author"),
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'author',
    "prompt" => "Choose Authors..",
);

$of_options[] = array(
    'id' => 'tag__in',
    'type' => 'multidropdown',
    'name' => 'Include Tags (optional)',
    'desc' => 'Choose the tags which have to be included in the posts you want to fetch.',
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'tag',
    "prompt" => "Choose tag..",
);

$of_options[] = array(
    'id' => 'sticky_posts',
    'type' => 'select',
    'name' => 'Sticky Posts',
    'desc' => 'Choose how to use your sticky posts.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("0" => "Use as classic posts", "ignore_sticky_posts" => "Ignore sticky posts", "show_only_sticky" => "Show only sticky posts")
);

$of_options[] = array(
    "type" => "sectionend");

/* ==== Custom Content ==== */
$of_options[] = array(
    "name" => "Custom Content",
    "type" => "sectionstart");
    
$of_options[] = array(
    "name" => "Content Items",
    "desc" => "Click the [ + ] button to add next item.",
    "id" => "custom_content",
    "std" => "",
    "type" => "grid_content"
);


$of_options[] = array(
    "type" => "sectionend");
    
    
/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");


$of_options[] = array(
    "name" => "Text Color",
    "desc" => "Pick a color for the Title, Line and Description box (by default: #ffffff).",
    "id" => "title_color",
    "std" => "#ffffff",
    "type" => "color"
);

$of_options[] = array("name" => "Overlay Gradient - Upper Color",
"desc" => "",
"id" => "overlay_upper",
"std" => "rgba(0,0,0,0)",
"format" => "rgba",
"type" => "color");

$of_options[] = array("name" => "Overlay Gradient - Bottom Color",
"desc" => "",
"id" => "overlay_bottom",
"std" => "rgba(0,0,0,0.7)",
"format" => "rgba",
"type" => "color");

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
$jaw_builder_options['grid'] = $of_options;
