<?php
$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_blog_skin",
    "name" => __("Styling & Coloring / Blog Colors", "mk_framework") ,
    "desc" => __("These options defines your site's blog colors.", "mk_framework") ,
    "fields" => array(
        array(
            "heading" => __("", "mk_framework") ,
            "title" => __("Blog Body Color Options", "mk_framework") ,
            "type" => "groupset",
            "styles" => "border-bottom:1px solid #d9d9d9; margin-top:-40px;",
            "fields" => array(
                array(
                    "name" => __('Blog Body Color', "mk_framework") ,
                    "desc" => __("", "mk_framework") ,
                    "id" => "blog_body_color",
                    "default" => "",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Blog Body Links Color', "mk_framework") ,
                    "id" => "blog_body_a_color",
                    "default" => "",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Blog Body Links Hover Color', "mk_framework") ,
                    "id" => "blog_body_a_color_hover",
                    "default" => "",
                    "type" => "color"
                ) ,
                array( 
                    "name" => __('Blog Body Strong tag Color', "mk_framework") ,
                    "id" => "blog_body_strong_tag_color",
                    "default" => "",
                    "type" => "color"
                ) ,
            )
        ) ,
        array(
            "heading" => __("", "mk_framework") ,
            "title" => __("Blog Heading Color Options", "mk_framework") ,
            "type" => "groupset",
            "styles" => "border-bottom:1px solid #d9d9d9;border-top:1px solid #d9d9d9; margin-top:50px;",
            "fields" => array(
                array(
                    "name" => __('Blog Heading Color', "mk_framework") ,
                    "id" => "blog_heading_color",
                    "default" => "",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Blog Body Heading 1', "mk_framework") ,
                    "id" => "blog_body_h1_color",
                    "default" => "",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Blog Body Heading 2', "mk_framework") ,
                    "id" => "blog_body_h2_color",
                    "default" => "",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Blog Body Heading 3', "mk_framework") ,
                    "id" => "blog_body_h3_color",
                    "default" => "",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Blog Body Heading 4', "mk_framework") ,
                    "id" => "blog_body_h4_color",
                    "default" => "",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Blog Body Heading 5', "mk_framework") ,
                    "id" => "blog_body_h5_color",
                    "default" => "",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Blog Body Heading 6', "mk_framework") ,
                    "id" => "blog_body_h6_color",
                    "default" => "",
                    "type" => "color"
                ) ,
            )
        ) ,
    ) ,
);
