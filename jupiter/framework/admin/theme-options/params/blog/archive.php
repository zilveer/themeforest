<?php
$blog_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_archive_posts",
    "name" => __("Blog & News / Archive", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Blog Archive Layout", "mk_framework") ,
            "desc" => __("This option allows you to define the layout of blog Archive page as full width without sidebar, left sidebar or right sidebar.", "mk_framework") ,
            "id" => "archive_page_layout",
            "default" => "right",
            "options" => array(
                "left" => __("Left Sidebar", "mk_framework") ,
                "right" => __("Right Sidebar", "mk_framework") ,
                "full" => __("Full Layout", "mk_framework")
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "name" => __("Archive Loop Style", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "archive_loop_style",
            "default" => 'modern',
            "options" => array(
                "modern" => __("Modern", "mk_framework"),
                "classic" => __("Classic", "mk_framework"),
                "newspaper" => __("Newspaper", "mk_framework"),
                "spotlight" => __("Spotlight", "mk_framework"),
                "thumbnail" => __("Thumbnail", "mk_framework"),
                "magazine" => __("Magazine", "mk_framework"),
                "grid" => __("Grid", "mk_framework")
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "name" => __("Archive Page Title", "mk_framework") ,
            "desc" => __("Using this option you can add a title to archive page.", "mk_framework") ,
            "id" => "archive_page_title",
            "default" => __("Archives", "mk_framework") ,
            "type" => "text"
        ) ,
        array(
            "name" => __("Archive Page Subtitle", "mk_framework") ,
            "desc" => __("You can disable or enable Archive page Subtitle.", "mk_framework") ,
            "id" => "archive_disable_subtitle",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Archive Loop Image Height", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "archive_blog_image_height",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "default" => "350",
            "unit" => 'px',
            "type" => "range"
        ) ,
        array(
            "name" => __("Show Blog Meta?", "mk_framework") ,
            "desc" => __("This option will let you disable meta in archive loop", "mk_framework") ,
            "id" => "archive_blog_meta",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        
        array(
            "name" => __("Pagination Style", "mk_framework") ,
            "id" => "archive_pagination_style",
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
