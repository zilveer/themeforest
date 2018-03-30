<?php
 $of_options = array();


$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'ids',
    'type' => 'text',
    'name' => 'Categories',
    'desc' => 'Choose the product categories you want to fetch products from.' . ' ' . jwUtils::getHelp("mpb_incl_cat") . ' '. jwUtils::getHelp("help", "", "http://support.jawtemplates.com/goodstore/web/?p=1112"),
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'product_cat_id',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    'id' => 'hide_empty',
    'type' => 'toggle',
    'name' => 'Hide Empty Categories',
    'std' => 'true',
    "builder" => 'true',
    'options' => array("false" => "Off", "true" => "On")
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
    "options" => array("off" => "Off", "space" => "Off without space", "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");
 
 
 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['woo_product_categories'] = $of_options;