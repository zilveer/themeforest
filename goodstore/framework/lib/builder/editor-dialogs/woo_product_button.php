<?php
 
 $of_options = array();

$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Product ID",
    "desc" => "Select ID of the product to be associated with the &acute;Add to card&acute; button.",
    "id" => "id",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "SKU - Stock Keeping Unit",
    "desc" => "Enter a SKU identifier of the product to be associated with the &acute;Add to card&acute; button.",
    "id" => "sku",
    "std" => "",
    "type" => "text"
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
$jaw_builder_options['woo_product_button'] = $of_options; 