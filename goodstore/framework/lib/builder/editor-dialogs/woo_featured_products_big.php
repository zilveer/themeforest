<?php

$of_options = array();

$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'per_page',
    'type' => 'range',
    'name' => 'Number of Products',
    'desc' => 'Set number of products per page.',
    'std' => '12',
    'min' => '1',
    'max' => '40',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    'id' => 'orderby',
    'type' => 'select',
    'name' => 'Products Order by',
    'desc' => 'Order products by the item parameters.',
    'std' => 'date',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
        "author" => "Author", "title" => "Title", "modified" => "Modified",
        "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count")
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
    "type" => "sectionend");


$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'columns',
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
    'type' => 'toggle',
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
    'id' => 'woo_bar_sort',
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
    "options" => array("off" => "Off", "space" => "Off without space", "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");


/* Settings */
global $jaw_builder_options;
$jaw_builder_options['woo_featured_products_big'] = $of_options;
