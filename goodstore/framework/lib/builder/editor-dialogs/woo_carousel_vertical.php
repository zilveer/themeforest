<?php
 
 $of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'product_cat',
    'type' => 'text',
    'name' => 'Include Product Category',
    'desc' => 'Select the WooCommerce product categories SLUGs devided by comma.',
    "page" => null,
    "chosen" => "true",
    "target" => 'product_cat',
    "prompt" => "Choose category..",
    "builder" => "true"
);

$of_options[] = array(
    'id' => 'count',
    'type' => 'range',
    'name' => 'Number of Products',
    'desc' => 'Set number of products per page.',
    'std' => '8',
    'min' => '1',
    'max' => '40',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array("name" => "Number of Products in one slide",
    "desc" => "Set number of products to be shown in one slide.",
    "id" => "post_in_slide",
    "mod" => 'micro',
    "type" => "range",
    'std' => '4',
    'min' => '1',
    'max' => '40',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    'id' => 'order',
    'type' => 'select',
    'name' => 'Products Order',
    'desc' => 'Products order (ascending or descending).',
    'std' => 'desc',
    'mod' => 'small',
    "builder" => 'true',
    'options' => array("desc" => "Desc", "asc" => "Asc")
);

$of_options[] = array(
    'id' => 'orderby',
    'type' => 'select',
    'name' => 'Products Order by',
    'desc' => 'Order Products by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>',
    'std' => 'date',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
        "author" => "Author", "title" => "Title", "modified" => "Modified",
        "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count","menu_order" => "Menu Order")
);
$of_options[] = array(
    'id' => 'on_sale',
    'type' => 'toggle',
    'name' => 'Show On Sale Products',
    'desc' => '',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);
$of_options[] = array(
    "type" => "sectionend");


/* ==== TEXT SETTING ==== */
$of_options[] = array(
    "name" => "Format",
    "type" => "sectionstart");

$of_options[] = array("name" => "Number of Characters - Excerpt in Main Post",
    "desc" => "Enter a number of characters in the preview content.",
    "id" => "letter_excerpt",
    "std" => 300,
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
    'id' => 'carousel_style',
    'type' => 'toggle',
    'name' => 'Carousel Navigation Style',
    'desc' => 'Decide where to place the carousel&acute;s navigation arrows.',
    'std' => 'bar',
    "builder" => 'true',
    "options" => array("bar" => "In bar", "side" => "On sides")
);

$of_options[] = array(
    'id' => 'automatic_slide',
    'type' => 'toggle',
    'name' => 'Automatic Sliding',
    'desc' => 'Decide whether or not to allow moving a content of your carousel automatically.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'box_style',
    'name' => 'Product Box Style',
    'desc' => 'Select the product box style you prefer.',
    'std' => '0',
    'mod' => 'small',
    "builder" => 'true',
    "type" => "layout",
    "options" => array(
        '0' => ADMIN_DIR . 'assets/images/product_boxees/product-light.png',
        '1' => ADMIN_DIR . 'assets/images/product_boxees/product-color.png',
        '2' => ADMIN_DIR . 'assets/images/product_boxees/product-boxed.png'
    )
);

$of_options[] = array(
    'id' => 'catalog_mode',
    'type' => 'select',
    'name' => 'Catalog mode',
    'desc' => 'Show items as catalog.',
    'std' => 'off',
    'mod' => 'small',
    "builder" => 'true',
    'options' => array("off" => "Off", "on" => "On")
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
$jaw_builder_options['woo_carousel_vertical'] = $of_options; 
