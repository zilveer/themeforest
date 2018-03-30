<?php
$general_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_header_section",
    "name" => __("General / Header", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Header Styles", "mk_framework") ,
            "desc" => __("using this option you can choose your header style, elements align and toggle off/on header toolbar.", "mk_framework") ,
            "id" => "theme_header_style",
            "default" => '1',
            "type" => 'header_styles',
        ) ,
        array(
            "id" => "theme_header_align",
            "default" => "left",
            "type" => 'hidden_input',
        ) ,
        array(
            "id" => "theme_toolbar_toggle",
            "default" => "true",
            "type" => 'hidden_input',
        ) ,
         array(
            "heading" => __("", "mk_framework") ,
            "title" => __("Secondary Menu Settings", "mk_framework") ,
            "type" => "groupset",
            'styles' => 'margin-top:-21px;border-bottom:1px solid #d9d9d9;border-top:1px solid #d9d9d9;',
            "dependency" => array(
                   'element' => "theme_header_style",
                   'value' => array(
                       '1',
                       '2',
                       '3'
                   )
            ),
            "fields" => array(
                array(
                    "name" => __("Style", "mk_framework") ,
                    "desc" => __("Side Dashboard Style is managed from Widgets and you should add your content into Side Dashboard widget area. However the Fullscreen Menu feeds from appearance > Menus. You need build a menu and assign it to fullscreen location. Be noted that you can not completely disable secondary navigation in header style 3!", "mk_framework") ,
                    "id" => "secondary_menu",
                    "default" => 'fullscreen',
                    "options" => array(
                        "fullscreen" => __('Full Screen Navigation', "mk_framework") ,
                        "dashboard" => __('Side Dashboard', "mk_framework") ,
                    ) ,
                    "type" => "dropdown",
                ) ,

                 array(
                    "name" => __("Burger Icon Size", "mk_framework") ,
                    "desc" => __("", "mk_framework") ,
                    "id" => "header_burger_size",
                    "default" => 'small',
                    "options" => array(
                        "small" => __('Small', "mk_framework") ,
                        "big" => __('Big', "mk_framework") ,
                    ) ,
                    "type" => "dropdown",
                ) ,
                 array(
                    "name" => __("Show Secondary Menu for Header Style 1 & 2", "mk_framework") ,
                    "desc" => __("Enable this option if you would like to have secondary menu in both header style 1 & 2.", "mk_framework") ,
                    "id" => "seondary_header_for_all",
                    "default" => 'false',
                    "type" => "toggle",
                ) ,
            )
        ) ,
        array(
            "heading" => __("", "mk_framework") ,
            "title" => __("Vertical Header Settings", "mk_framework") ,
            "type" => "groupset",
            'styles' => 'border-bottom:1px solid #d9d9d9;border-top:1px solid #d9d9d9;',
            "dependency" => array(
                   'element' => "theme_header_style",
                   'value' => array(
                       '4'
                   )
            ),        
            "fields" => array(
                array(
                    "name" => __("Navigation Animation", "mk_framework") ,
                    "desc" => __("Animation to show sub menu items.", "mk_framework") ,
                    "id" => "vertical_menu_anim",
                    "default" => '1',
                    "options" => array(
                        "1" => __('Style 1', "mk_framework") ,
                        "2" => __('Style 2', "mk_framework") ,
                    ) ,
                    "type" => "dropdown",
                ) ,
                
                array(
                    "name" => __("Logo Align", "mk_framework") ,
                    "desc" => __("", "mk_framework") ,
                    "id" => "vertical_header_logo_align",
                    "default" => 'center',
                    "options" => array(
                        "left" => __('Left', "mk_framework") ,
                        "center" => __('Center', "mk_framework") ,
                        "right" => __('Right', "mk_framework") ,
                    ) ,
                    "type" => "dropdown",
                ) ,
                
                array(
                    "name" => __("Logo Top & Bottom padding", "mk_framework") ,
                    "desc" => __("", "mk_framework") ,
                    "id" => "vertical_header_logo_padding",
                    "default" => "10",
                    "min" => "0",
                    "max" => "400",
                    "step" => "1",
                    "unit" => 'px',
                    "type" => "range",
                ) ,
                
                array(
                    "name" => __("Text Align", "mk_framework") ,
                    "desc" => __("", "mk_framework") ,
                    "id" => "vertical_header_align",
                    "default" => 'left',
                    "options" => array(
                        "left" => __('Left', "mk_framework") ,
                        "center" => __('Center', "mk_framework") ,
                        "right" => __('Right', "mk_framework") ,
                    ) ,
                    "type" => "dropdown",
                ) ,
                
                array(
                    "name" => __("Copyright Text", "mk_framework") ,
                    "desc" => __("", "mk_framework") ,
                    "rows" => 2,
                    "id" => "vertical_menu_copyright",
                    "default" => 'Copyright All Rights Reserved &copy; 2015',
                    "type" => "textarea",
                ) ,
            )
        ) ,
        array(
            "name" => __("Boxed Header?", "mk_framework") ,
            "desc" => __("This option will fit the header and header toolbar into main grid container which you define in global settings.", "mk_framework") ,
            "id" => "header_grid",
            "default" => 'true',
            "type" => "toggle",
        ) ,

        array(
            "name" => __("Show Logo?", "mk_framework") ,
            "desc" => __("Using this option you can hide logo for header.", "mk_framework") ,
            "id" => "hide_header_logo",
            "default" => 'true',
            "type" => "toggle",
        ) ,

        array(
            "name" => __("Show Main Navigation", "mk_framework") ,
            "desc" => __("You may need to hide Main Navigation and this option will give you this power.", "mk_framework") ,
            "id" => "hide_header_nav",
            "default" => 'true',
            "type" => "toggle",
        ) ,

        array(
            "name" => __("Logo in the Middle", "mk_framework") ,
            "desc" => __("If enabled logo will be in the middle of the navigation. make sure you have \"even\" main menu items for correct alignment. This option will be only working with header style 1", "mk_framework") ,
            "id" => "logo_in_middle",
            "default" => 'false',
            "type" => "toggle",
        ) ,
        
        array(
            "name" => __("Header Height", "mk_framework") ,
            "desc" => __("You can change header height using this option. (default:100px).", "mk_framework") ,
            "id" => "header_height",
            "default" => "90",
            "min" => "50",
            "max" => "800",
            "step" => "1",
            "unit" => 'px',
            "type" => "range",
        ) ,

        array(
            "name" => __("Sticky Header Height", "mk_framework") ,
            "desc" => __("Using this option you can decide how long header should be on sticky state. (default:50px).", "mk_framework") ,
            "id" => "header_scroll_height",
            "default" => "55",
            "min" => "20",
            "max" => "400",
            "step" => "1",
            "unit" => 'px',
            "type" => "range",
        ) ,
        
        array(
            "name" => __("Responsive Header Height", "mk_framework") ,
            "desc" => __("You can change responsive header height using this option (default:90px). This option will only change the header height on screen width you define in Theme Settings => Global Settings => Main Navigation Threshold Width.", "mk_framework") ,
            "id" => "res_header_height",
            "default" => "90",
            "min" => "50",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "type" => "range",
        ) ,

         array(
            "name" => __("Sticky header behavior", "mk_framework") ,
            "desc" => __("Using this option you can define how you would like the header transform from normal to sticky state. If 'Slide Down' is selected, then you can choose the offset location where the sticky header will be revealed while scrolling down (Check option below).", "mk_framework") ,
            "id" => "header_sticky_style",
            "default" => 'fixed',
            "options" => array(
                "false" => __('Disable Sticky Header', "mk_framework") ,
                "fixed" => __('Fixed Sticky', "mk_framework") ,
                "slide" => __('Slide Down', "mk_framework") ,
                "lazy" => __('Lazy', "mk_framework") ,
            ) ,
            "type" => "dropdown",
        ) ,
        
        array(
            "name" => __("Sticky Header Offset", "mk_framework") ,
            "desc" => __("Set this option to decide when the sticky state of header will trigger. This option does not apply to header style No2.", "mk_framework") ,
            "id" => "sticky_header_offset",
            "default" => 'header',
            "options" => array(
                "header" => __('Header height', "mk_framework") ,
                "25%" => __('25% Of Viewport', "mk_framework") ,
                "30%" => __('30% Of Viewport', "mk_framework") ,
                "40%" => __('40% Of Viewport', "mk_framework") ,
                "50%" => __('50% Of Viewport', "mk_framework") ,
                "60%" => __('60% Of Viewport', "mk_framework") ,
                "70%" => __('70% Of Viewport', "mk_framework") ,
                "80%" => __('80% Of Viewport', "mk_framework") ,
                "90%" => __('90% Of Viewport', "mk_framework") ,
                "100%" => __('100% Of Viewport', "mk_framework") ,
            ) ,
            "type" => "dropdown",
        ) ,
        
       
        
        array(
            "name" => __("Search Form in Header?", "mk_framework") ,
            "desc" => __("Please choose the header search form location/style.", "mk_framework") ,
            "id" => "header_search_location",
            "default" => 'fullscreen_search',
            "options" => array(
                "disable" => __('No Thanks!', "mk_framework") ,
                "toolbar" => __('Header Toolbar (toolbar must be enabled)', "mk_framework") ,
                "header" => __('Header Main Area (only in header style 1)', "mk_framework") ,
                "beside_nav" => __('Inside Main Navigation with Tooltip', "mk_framework") ,
                "fullscreen_search" => __('Inside Main Navigation With Fullscreen layer', "mk_framework") ,
            ) ,
            "type" => "dropdown",
        ) ,

        
       
        array(
            "heading" => __("", "mk_framework") ,
            "title" => __("Header Start Tour Link", "mk_framework") ,
            "type" => "groupset",
            'styles' => 'border-bottom:1px solid #d9d9d9;border-top:1px solid #d9d9d9;',
            "fields" => array(
                array(
                    "name" => __("Start Tour Text", "mk_framework") ,
                    "desc" => __("If you dont want to show sart a tour link leave this field blank. This link will be added to the header right section in header style 1", "mk_framework") ,
                    "id" => "header_start_tour_text",
                    "default" => __("", "mk_framework"),
                    "type" => "text",
                ) ,
                array(
                    "name" => __("Start Tour URL", "mk_framework") ,
                    "desc" => __("The URL where this will be linked with. inluding http://", "mk_framework") ,
                    "id" => "header_start_tour_page",
                    "default" => '',
                    "type" => "text",
                ) ,
            )
        ) ,
    )
);
