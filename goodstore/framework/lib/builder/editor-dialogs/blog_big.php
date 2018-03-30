<?php

 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'cats',
    'type' => 'multidropdown',
    'name' => 'Include Blog Category',
    'desc' => '',
    "page" => null,
    "chosen" => "true",
    "target" => 'cat',
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
    'id' => 'pagination',
    'type' => 'select',
    'name' => 'Pagination Style',
    'desc' => 'Choose the pagination style you prefer.',
    'std' => 'ajax',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("ajax" => "ajax", "infinite" => "infinite", "infinitemore" => "infinite with more", "none" => "none", "number" => "number", "wordpress" => "wordpress"),
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
    'id' => 'blog_metadate',
    'type' => 'toggle',
    'name' => 'Meta Date',
     "builder" => 'true',
    'desc' => 'Choose whether or not to show date in a post preview.',
    'std' => '1'
);

$of_options[] = array(
    'id' => 'blog_ratings',
    'type' => 'toggle',
    'name' => 'Ratings',
     "builder" => 'true',
    'desc' => 'Choose whether or not to show ratings in a post preview.',
    'std' => '1'
);

$of_options[] = array(
    'id' => 'blog_meta_type_icon',
    'type' => 'toggle',
    'name' => 'Meta post type icon',
    'desc' => 'Choose whether or not to show post type icon in the post preview.',
    'std' => '1'
);

$of_options[] = array(
    'id' => 'blog_meta_author',
    'type' => 'toggle',
    'name' => 'Meta author',
    'desc' => 'Choose whether or not to show author in the post preview.',
    'std' => '1'
);

$of_options[] = array(
    'id' => 'blog_comments_count',
    'type' => 'toggle',
    'name' => 'Meta commets count',
    'desc' => 'Choose whether or not to show commets count in the post preview.',
    'std' => '1'
);

$of_options[] = array(
    'id' => 'blog_meta_category',
    'type' => 'toggle',
    'name' => 'Meta category',
    'desc' => 'Choose whether or not to show category in the post preview.',
    'std' => '1'
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== TEXT SETTING ==== */
$of_options[] = array(
    "name" => "Format",
    "type" => "sectionstart");

$of_options[] = array("name" => "Number of Characters - Excerpt in Main Post",
    "desc" => "Enter a number of characters in a preview content.",
    "id" => "letter_excerpt",
    "std" => 275,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);

$of_options[] = array("name" => "Number of Characters - Post Titles",
    "desc" => "Enter a number of characters for your post titles.",
    "id" => "letter_excerpt_title",
    "std" => 60,
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
    'id' => 'type',
    'name' => 'Blog Type',
    'desc' => 'Select the blog type you prefer.',
    'std' => 'classical',
    'mod' => 'small',
    "builder" => 'true',
    "type" => "layout",
    "options" => array(
        'classical' => ADMIN_DIR . 'assets/images/blog_boxes/classical.png',
        'big' => ADMIN_DIR . 'assets/images/blog_boxes/big.png'
    )
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
    'id' => 'bar_sort',
    'type' => 'toggle',
    'name' => 'Show Sorting',
    'desc' => 'Decide whether or not to show sorting.',
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
    "options" => array("off"=>"Off", "space" => "Off without space",  "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");

 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['blog_big'] = $of_options; 