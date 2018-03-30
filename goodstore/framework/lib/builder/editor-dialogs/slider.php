<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'post_type',
    'type' => 'toggle',
    'name' => 'Post Type',
    'desc' => 'Choose whether to show posts or products in the slider.',
    'std' => 'post',
    "builder" => 'true',
    "options" => array("post" => "Posts", "product" => "Products")
);

$of_options[] = array(
    'id' => 'posts_per_page',
    'type' => 'range',
    'name' => 'Number of Items',
    'desc' => 'Set a number of items for your slider.',
    'std' => '6',
    'min' => '5',
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
    'desc' => 'Order posts by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>',
    'std' => 'date',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
        "author" => "Author", "title" => "Title", "modified" => "Modified",
        "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count")
);



$of_options[] = array(
    "type" => "sectionend");



/* ==== Posts ==== */
$of_options[] = array(
    "name" => "Posts",
    "type" => "sectionstart");

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

/* ==== Products ==== */
$of_options[] = array(
    "name" => "Products",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'featured_products',
    'type' => 'toggle',
    'name' => 'Show Only Featured Products',
    'desc' => 'Show only the featured products in your slider. If this option is set off, all your products will be displayed.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("0" => "Off", "1" => "On")
);

$of_options[] = array(
    'id' => 'lookbook_products',
    'type' => 'toggle',
    'name' => 'Show as lookbook',
    'desc' => 'Show slider as lookbook.',
    'std' => 'off',
    "builder" => 'true',
    "options" => array("off" => "Off", "on" => "On")
);

$of_options[] = array(
    'id' => 'woo_category__in',
    'type' => 'multidropdown',
    'name' => 'Include Product Category (optional)',
    'desc' => 'Choose the product categories you want to fetch products from.' . ' ' . jwUtils::getHelp("mpb_incl_cat"),
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'product_cat',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    'id' => 'woo_post__in',
    'type' => 'text',
    'name' => 'Include Products (optional)',
    'desc' => 'The specific posts you want to display (in format 52, 45, 87).' . ' ' . jwUtils::getHelp("mpb_incl_post"),
    "std" => '',
);

$of_options[] = array(
    'id' => 'woo_tag__in',
    'type' => 'multidropdown',
    'name' => 'Include Products Tags (optional)',
    'desc' => 'Choose the tags which have to be included in the products you want to fetch.',
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'product_tag',
    "prompt" => "Choose tag..",
);



$of_options[] = array(
    "type" => "sectionend");




/* ==== Animation ==== */
$of_options[] = array(
    "name" => "Animation",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'animate_latency',
    'type' => 'range',
    'name' => 'Animation Latency',
    'desc' => 'Set a speed value of changing slides in your slider.',
    'std' => '5000',
    'min' => '1000',
    'max' => '10000',
    'step' => '500',
    'unit' => 'ms'
);

$of_options[] = array(
    'id' => 'animate_duration',
    'type' => 'range',
    'name' => 'Animation Speed',
    'desc' => 'Depending on this value, slides and descriptions move more or less slowly and smoothly. This only affects the animation effect.',
    'std' => '1500',
    'min' => '100',
    'max' => '3000',
    'step' => '100',
    'unit' => 'ms'
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
    'desc' => 'Choose ON option to add a color background over the entire width of the element. To expand your slider only, select the Full-Item option.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On","0" => "Off",  "full-item" => "Full-Item")
);
$of_options[] = array(
    "name" => "Full Width Background Color",
    "desc" => "Pick a background color.",
    "id" => "full_back_color",
    "std" => "#000000",
    "type" => "color"
);


$of_options[] = array(
    "name" => "Info Box Text Color",
    "desc" => "Pick a color of your text content of the info box (by default: #000000).",
    "id" => "info_text_color",
    "std" => "#000000",
    "type" => "color"
);


$of_options[] = array(
    "name" => "Info Box Color",
    "desc" => "Pick a background color for the info box (by default: #ffffff).",
    "id" => "info_color",
    "std" => "#ffffff",
    "type" => "color"
);


$of_options[] = array(
    'id' => 'info_opacity',
    'type' => 'range',
    'name' => 'Info Box Opacity',
    'desc' => 'Set an opacity level.',
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
$jaw_builder_options['slider'] = $of_options; 