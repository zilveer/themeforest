<?php
$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_general_skin",
    "name" => __("Styling & Coloring / General Colors", "mk_framework") ,
    "desc" => __("These options defines your site's general colors.", "mk_framework") ,
    "fields" => array(
        array(
            "heading" => __("", "mk_framework") ,
            "title" => __("Theme General Color Options", "mk_framework") ,
            "type" => "groupset",
            "styles" => "border-bottom:1px solid #d9d9d9; margin-top:-40px;",
            "fields" => array(
                array(
                    "name" => __('Theme Accent Color', "mk_framework") ,
                    "desc" => __("The theme main color that will be applied to some elements.", "mk_framework") ,
                    "id" => "skin_color",
                    "default" => "#f97352",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Body Text Color', "mk_framework") ,
                    "id" => "body_text_color",
                    "default" => "#777777",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Paragraph (p)', "mk_framework") ,
                    "id" => "p_color",
                    "default" => "#777777",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Content Links Color', "mk_framework") ,
                    "id" => "a_color",
                    "default" => "#2e2e2e",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Content Links Hover Color', "mk_framework") ,
                    "id" => "a_color_hover",
                    "default" => "#f97352",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Content Strong tag Color', "mk_framework") ,
                    "id" => "strong_color",
                    "default" => "#f97352",
                    "type" => "color"
                ) ,
            )
        ) ,
        array(
            "heading" => __("", "mk_framework") ,
            "title" => __("Theme Headings Color Options", "mk_framework") ,
            "type" => "groupset",
            "styles" => "border-bottom:1px solid #d9d9d9;border-top:1px solid #d9d9d9; margin-top:50px;",
            "fields" => array(
                array(
                    "name" => __('Heading 1', "mk_framework") ,
                    "id" => "h1_color",
                    "default" => "#404040",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Heading 2', "mk_framework") ,
                    "id" => "h2_color",
                    "default" => "#404040",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Heading 3', "mk_framework") ,
                    "id" => "h3_color",
                    "default" => "#404040",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Heading 4', "mk_framework") ,
                    "id" => "h4_color",
                    "default" => "#404040",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Heading 5', "mk_framework") ,
                    "id" => "h5_color",
                    "default" => "#404040",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Heading 6', "mk_framework") ,
                    "id" => "h6_color",
                    "default" => "#404040",
                    "type" => "color"
                ) ,
            )
        ) ,
    ) ,
);
