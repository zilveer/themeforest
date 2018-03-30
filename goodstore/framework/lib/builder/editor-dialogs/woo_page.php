<?php

 $of_options = array();


$of_options[] = array(
    "name" => "Page",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'page',
    'type' => 'select',
    'name' => 'Item Type',
    'desc' => 'Select the WooCommerce element to put to your page.',
    'std' => 'date',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array( "cart" => "Cart", 
                        "checkout" => "Checkout",
                        "my_account" => "My Account", 
                        "edit_address" => "Edit address",
                        "change_password" => "Change password", 
                        "view_order" => "View order",
                        "pay" => "Pay", 
                        "thankyou" => "Thank you")
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
$jaw_builder_options['woo_page'] = $of_options; 