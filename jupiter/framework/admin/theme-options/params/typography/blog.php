<?php

$typography_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_blog_typography",
    "name" => __("Typography / Blog Typography", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
       array(
        "name" => __('Blog Body Text Size', "mk_framework"),
        "desc" => __("If zero chosen the default body text size will be used.", "mk_framework"),
        "id" => "blog_body_font_size",
        "min" => "0",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "0",
        "type" => "range"
    ),
    array(
        "name" => __('Blog Body Text Line Height', "mk_framework"),
        "desc" => __("This option will let you change the line height of texts in site. Please note that some elements has their own direct line height property, so you can not change them from here. The unit is in 'em'.<br />If zero chosen the default body line height size will be used. ", "mk_framework"),
        "id" => "blog_body_line_height",
        "min" => "0",
        "max" => "4",
        "step" => "0.01",
        "unit" => 'em',
        "default" => "0",
        "type" => "range"
    ),
    array(
        "name" => __('Blog Body Text Weight', "mk_framework"),
        "id" => "blog_body_weight",
        "default" => 400,
        "type" => "font_weight"
    ),

    array(
        "name" => __('Blog Heading Text Size', "mk_framework"),
        "id" => "blog_heading_size",
        "desc" => __("If zero chosen the default body text size will be used.", "mk_framework"),
        "min" => "0",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "0",
        "type" => "range"
    ),

    array(
        "name" => __('Blog Heading Text Weight', "mk_framework"),
        "id" => "blog_heading_weight",
        "default" => 600,
        "type" => "font_weight"
    ),
    array(
        "name" => __('Blog Heading Text Case', "mk_framework"),
        "id" => "blog_heading_transform",
        "default" => '',
        "options" => array(
            "none" => __('None', "mk_framework"),
            "uppercase" => __('Uppercase', "mk_framework"),
            "capitalize" => __('Capitalize', "mk_framework"),
            "lowercase" => __('Lower case', "mk_framework")
        ),
        "type" => "dropdown"
    ),
    ) ,
);