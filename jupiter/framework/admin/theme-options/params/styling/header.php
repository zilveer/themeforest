<?php
$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_backgrounds_header",
    "name" => __("Styling / Header", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Header Background Opacity", "mk_framework") ,
            "desc" => __("You can change the opacity of your header section.", "mk_framework") ,
            "id" => "header_opacity",
            "min" => "0",
            "max" => "1",
            "step" => "0.1",
            "unit" => 'opacity',
            "default" => "1",
            "type" => "range"
        ) ,
        array(
            "name" => __("Sticky Header Background Opacity", "mk_framework") ,
            "desc" => __("The opacity of the sticky header section (after scroll header will be fixed to the top of window).", "mk_framework") ,
            "id" => "header_sticky_opacity",
            "min" => "0",
            "max" => "1",
            "step" => "0.1",
            "unit" => 'opacity',
            "default" => "1",
            "type" => "range"
        ) ,
        array(
            "name" => __("Header Bottom Border Thickness", "mk_framework") ,
            "desc" => __("This option will set the header bottom border thickness.", "mk_framework") ,
            "id" => "header_btn_border_thickness",
            "min" => "0",
            "max" => "10",
            "step" => "1",
            "unit" => 'px',
            "default" => "1",
            "type" => "range"
        ) ,
        array(
            "name" => __('Header Bottom Border Color', "mk_framework") ,
            "desc" => __("In all header styles this option will add/remove border bottom color to header section. This option will also add Main Navigation wrapper top border in header style 2.", "mk_framework") ,
            "id" => "header_border_color",
            "default" => "#ededed",
            "type" => "color"
        ) ,
        array(
            "name" => __('Sticky Header Bottom Border Color', "mk_framework") ,
            "desc" => __("This border color will be used for sticky header border color. If left blank above option will used instead.", "mk_framework") ,
            "id" => "sticky_header_border_color",
            "default" => "",
            "type" => "color"
        ) ,
        array(
            "name" => __('Header Start Tour Link Color', "mk_framework") ,
            "id" => "start_tour_color",
            "default" => "#333",
            "type" => "color"
        ) ,
        array(
            "name" => __('Header Burger Icon Color', "mk_framework") ,
            "id" => "header_burger_color",
            "default" => "",
            "type" => "color"
        ) ,
        
        array(
            "heading" => __("", "mk_framework") ,
            "title" => __("Header Social Networks Color Options", "mk_framework") ,
            "type" => "groupset",
            "styles" => 'border-bottom:1px solid #d9d9d9; margin-top:-20px;',
            "fields" => array(
                array(
                    "name" => __('Icon Color', "mk_framework") ,
                    "id" => "header_social_color",
                    "default" => "#999999",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Icon Hover Color', "mk_framework") ,
                    "id" => "header_social_hover_color",
                    "default" => "#ccc",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Border Color', "mk_framework") ,
                    "id" => "header_social_border_color",
                    "default" => "#999999",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Background Color', "mk_framework") ,
                    "id" => "header_social_bg_main_color",
                    "default" => "#232323",
                    "type" => "color"
                ) ,
                array(
                    "name" => __('Hover Background Color', "mk_framework") ,
                    "id" => "header_social_bg_color",
                    "default" => "#232323",
                    "type" => "color"
                ) ,
            )
        ) ,
    ) ,
);
