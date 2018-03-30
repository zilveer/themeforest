<?php
$ecommerce_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_woo_general",
    "name" => __("Woocommerce / General Settings", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Shop Catalog Mode", "mk_framework") ,
            "desc" => __("This option will turn your shop to catalog mode. So users will not be able to shop in your site.", "mk_framework") ,
            "id" => "woocommerce_catalog",
            "default" => 'false',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Shop Loop columns?", "mk_framework") ,
            "desc" => __("How many columns per row in your shop archive loop?", "mk_framework") ,
            "id" => "shop_archive_columns",
            "default" => "default",
            "options" => array(
                "default" => __("Default (4 Columns full layout, 3 columns with sidebar)", "mk_framework") ,
                "1" => __("1", "mk_framework") ,
                "2" => __("2", "mk_framework") ,
                "3" => __("3", "mk_framework") ,
                "4" => __("4", "mk_framework") ,
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "name" => __("Product Loop Image Height", "mk_framework") ,
            "desc" => __("Using this option you can change the product loop image height. default : 330", "mk_framework") ,
            "id" => "woo_loop_img_height",
            "default" => "300",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "type" => "range"
        ) ,
        array(
            "name" => __("Shop Loop Image Size", "mk_framework") ,
            "id" => "woo_loop_image_size",
            "default" => "crop",
            "options" => mk_get_image_sizes(true),
            "type" => "dropdown"
        ) ,

        array(
            "name" => __("Product Category Loop Image Size", "mk_framework") ,
            "id" => "woo_category_image_size",
            "default" => "crop",
            "options" => mk_get_image_sizes(true),
            "type" => "dropdown"
        ) ,

        array(
            "name" => __("Product Category Archive Loop Title", "mk_framework") ,
            "desc" => __("Optionally you can change the product category page title. ", "mk_framework") ,
            "id" => "woocommerce_category_page_title",
            "default" => 'Shop',
            "type" => "text"
        ) ,
        array(
            "name" => __("Show Shopping Cart", "mk_framework") ,
            "desc" => __("Using this option you can remove header shopping cart.", "mk_framework") ,
            "id" => "shopping_cart",
            "default" => 'true',
            "type" => "toggle"
        ) ,

        array(
            "name" => __("Use Product Category Name as Page Title", "mk_framework") ,
            "desc" => __("Show product category name as page title on product category page.", "mk_framework") ,
            "id" => "woocommerce_use_category_title",
            "default" => 'false',
            "type" => "toggle"
        ) ,

        array(
            "name" => __("Use Product Category Name as Product Filter Title", "mk_framework") ,
            "desc" => __("Show product category as filter label for products on product category page.", "mk_framework") ,
            "id" => "woocommerce_use_category_filter_title",
            "default" => 'false',
            "type" => "toggle"
        ) ,

        array(
            "name" => __("Use Product Name as Page Title", "mk_framework") ,
            "desc" => __("Show product name as Product Page title.", "mk_framework") ,
            "id" => "woocommerce_use_product_title",
            "default" => 'false',
            "type" => "toggle"
        ) ,

        array(
            "name" => __("Show Shopping Cart For Mobile devices", "mk_framework") ,
            "desc" => __("You can turn on/off the floating shopping cart link for mobile and tablet devices.", "mk_framework") ,
            "id" => "add_cart_responsive",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        
        array(
            "name" => __("Excerpt For Products Loop", "mk_framework") ,
            "desc" => __("If you would like to show some small description for products loop enable this option.", "mk_framework") ,
            "id" => "woocommerce_loop_show_desc",
            "default" => 'false',
            "type" => "toggle"
        ) ,
    ) ,
);
