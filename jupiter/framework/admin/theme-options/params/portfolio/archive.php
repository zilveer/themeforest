<?php
$portfolio_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_portfolio_archive",
    "name" => __("Portfolio / Archive", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Portfolio Archive Layout", "mk_framework") ,
            "desc" => __("This option allows you to define the layout of Portfolio Archive page as full width without sidebar, left sidebar or right sidebar.", "mk_framework") ,
            "id" => "archive_portfolio_layout",
            "default" => "right",
            "options" => array(
                "left" => __("Left Sidebar", "mk_framework") ,
                "right" => __("Right Sidebar", "mk_framework") ,
                "full" => __("Full Layout", "mk_framework")
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "name" => __("Portfolio Style", "mk_framework") ,
            "id" => "archive_portfolio_style",
            "default" => 'classic',
            "options" => array(
                "classic" => __('Classic', "mk_framework") ,
                "grid" => __('Grid', "mk_framework")
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "name" => __("Columns", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "archive_portfolio_column",
            "min" => "1",
            "max" => "6",
            "step" => "1",
            "default" => "3",
            "unit" => 'column',
            "type" => "range"
        ) ,
        array(
            "name" => __("Featured Image Height", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "archive_portfolio_image_height",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "default" => "400",
            "unit" => 'px',
            "type" => "range"
        ) ,
        array(
            "name" => __("Pagination Style", "mk_framework") ,
            "id" => "archive_portfolio_pagination_style",
            "default" => '1',
            "options" => array(
                "1" => __('Pagination Nav', "mk_framework") ,
                "2" => __('Load More Button', "mk_framework") ,
                "3" => __('Load on Page Scroll', "mk_framework")
            ) ,
            "type" => "radio"
        ) ,
    ) ,
);
