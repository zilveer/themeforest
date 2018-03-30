<?php

$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_main_navigation_skin",
    "name" => __("Styling & Coloring / Main Navigation", "mk_framework") ,
    "desc" => __("In this section you can modify the coloring of Main Navigation Section.", "mk_framework") ,
    "fields" => array(
       array(
        "name" => __("Header Main Navigation Hover Style", "mk_framework"),
        "desc" => __("Please note that hover style 5 does not work in header style 4.", "mk_framework"),
        "id" => "main_nav_hover",
        "default" => "5",
        "options" => array(
            "1" => 'header-hover-1.jpg',
            "2" => 'header-hover-2.jpg',
            "3" => 'header-hover-3.jpg',
            "4" => 'header-hover-4.jpg',
            "5" => 'header-hover-5.jpg',
        ),
        "type" => "visual_selector"
    ),
        array(
        "name" => __('Container Color Background Color', "mk_framework"),
        "desc" => __("This option will put your main navigation in a colored container. Use this option in header style #2", "mk_framework"),
        "id" => "main_nav_bg_color",
        "default" => "",
        "type" => "color"
    ),
    array(
        "name" => __('Top Level Text Color', "mk_framework"),
        "id" => "main_nav_top_text_color",
        "default" => "#444444",
        "type" => "color"
    ),
    array(
        "name" => __('Top Level Hover & Current Skin Color', "mk_framework"),
        "desc" => __("The Main Menu hover & current menu item hover skin color. This color will be applied to the hover style you have chosen in above option (Header Main Navigation Hover Style).", "mk_framework"),
        "id" => "main_nav_top_hover_skin",
        "default" => "#f97352",
        "type" => "color"
    ),
    array(
        "name" => __('Top Level Hover & Current Text Color (Hover Style 3 & 4 Only)', "mk_framework"),
        "desc" => __("This option will only work for main navigation hover style 3 current item text color and style 4 current & hover text color.", "mk_framework"),
        "id" => "main_nav_top_hover_txt_color",
        "default" => "#fff",
        "type" => "color"
    ),
    array(
        "name" => __('Sub Level Box Width', "mk_framework"),
        "desc" => __("", "mk_framework"),
        "id" => "main_nav_sub_width",
        "min" => "100",
        "max" => "500",
        "step" => "1",
        "unit" => 'px',
        "default" => "230",
        "type" => "range"
    ),
    array(
        "name" => __('Sub Level Box Border Top Color', "mk_framework"),
        "desc" => __("If you want to remove this border leave this option empty.", "mk_framework"),
        "id" => "main_nav_sub_border_top_color",
        "default" => "#f97352",
        "type" => "color"
    ),
    array(
        "name" => __('Sub Level Background Color', "mk_framework"),
        "id" => "main_nav_sub_bg_color",
        "default" => "#333333",
        "type" => "color"
    ),
    array(
        "name" => __('Sub Level Text Color', "mk_framework"),
        "id" => "main_nav_sub_text_color",
        "default" => "#b3b3b3",
        "type" => "color"
    ),

    array(
        "name" => __('Sub Level Text Hover & Current Menu Item Color', "mk_framework"),
        "id" => "main_nav_sub_text_color_hover",
        "default" => "#ffffff",
        "type" => "color"
    ),
    array(
        "name" => __('Sub Level Icon Color', "mk_framework"),
        "id" => "main_nav_sub_icon_color",
        "default" => "#e0e0e0",
        "type" => "color"
    ),
    array(
        "name" => __('Sub Level Hover & Current Menu Item Background Color', "mk_framework"),
        "id" => "main_nav_sub_hover_bg_color",
        "default" => "",
        "type" => "color"
    ),
    array(
        "name" => __('Mega menu title color ', "mk_framework"),
        "id" => "main_nav_mega_title_color",
        "default" => "#ffffff",
        "type" => "color"
    ),
     array(
        "name" => __("Sub Level Box Shadow", "mk_framework"),
        "desc" => __("This option will add shadow to menu sub level boxes.", "mk_framework"),
        "id" => "nav_sub_shadow",
        "default" => 'false',
        "type" => "toggle"
    ),
     array(
        "name" => __('Sub Level Box Border Color', "mk_framework"),
        "id" => "sub_level_box_border_color",
        "default" => "",
        "type" => "color"
    ),
    array(
        "name" => __("Mega Menu column Vertical Divders Color", "mk_framework"),
        "desc" => __("Using this option you can change mega menu vertical dividers color. If you dont want those dividers simply clear the option value.", "mk_framework"),
        "id" => "mega_menu_divider_color",
        "default" => '',
        "type" => "color"
    ),
    array(
        "name" => __('Mobile Menu Trigger Icon Color', "mk_framework"),
        "desc" => __("If this option left blank 'Top Level Text Color' option will be used instead. This option is useful for header style 2.", "mk_framework"),
        "id" => "responsive_icon_text_color",
        "default" => "#444444",
        "type" => "color"
    ),
    

    ) ,
);