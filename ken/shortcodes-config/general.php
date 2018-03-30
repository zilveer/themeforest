<?php

vc_map(array(
    "name" => __("Row", "mk_framework"),
    'base' => 'vc_row',
    'is_container' => true,
    'icon' => 'icon-mk-row vc_mk_element-icon',
    'show_settings_on_create' => false,
    "category" => __('General', 'mk_framework'),
    'description' => __( 'Place content elements inside the row', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "toggle",
            "heading" => __("Fullwidth Row?.", "mk_framework"),
            "param_name" => "fullwidth",
            "value" => "false",
            "description" => __("If you enable this option, this row will no longer follow the main grid width and will stretch 100% to screen width.", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Attached Colums", "mk_framework"),
            "param_name" => "attached",
            "value" => "false",
            "description" => __("This option will attach child column to each other. In other words columns inside this row will be stick to each other.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Column Paddings", "mk_framework"),
            "param_name" => "padding",
            "value" => "0",
            "min" => "0",
            "max" => "5",
            "step" => "1",
            "unit" => '%',
            "description" => __("This option will create padding space inside columns to allow. mostly useful when 'Attached Colums' option is enabled. Please note that padding unit is by percent and will be applied to all directions.", "mk_framework")
        ),
        array(
            'type' => 'checkbox',
            'heading' => __( 'Equal height', 'js_composer' ),
            'param_name' => 'equal_height',
            'description' => __( 'If checked columns will be set to equal height.', 'js_composer' ),
            'value' => array( __( 'Yes', 'js_composer' ) => 'yes' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Content position', 'js_composer' ),
            'param_name' => 'content_placement',
            'value' => array(
                __( 'Default', 'js_composer' ) => '',
                __( 'Top', 'js_composer' ) => 'top',
                __( 'Middle', 'js_composer' ) => 'middle',
                __( 'Bottom', 'js_composer' ) => 'bottom',
            ),
            'description' => __( 'Select content position within columns.', 'js_composer' ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Row ID", "mk_framework"),
            "param_name" => "id",
            "description" => __("This ID is useful when you are going to make a single page website.", "mk_framework")
        ),
        $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'js_composer' ),
            'param_name' => 'css',
            'group' => __( 'Design Options', 'js_composer' ),
        ),
    ),
    "js_view" => 'VcRowView'
));
vc_map(array(
    "name" => __("Row", "mk_framework"),
    "base" => "vc_row_inner",
    "content_element" => false,
    "is_container" => true,
    "show_settings_on_create" => false,
    'icon' => 'icon-mk-row vc_mk_element-icon',
    'description' => __( 'Place content elements inside the row', 'mk_framework' ),
    "params" => array(
        $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    ),
    "js_view" => 'VcRowView'
));
$column_width_list = array(
    __('1 column - 1/12', 'mk_framework') => '1/12',
    __('2 columns - 1/6', 'mk_framework') => '1/6',
    __('3 columns - 1/4', 'mk_framework') => '1/4',
    __('4 columns - 1/3', 'mk_framework') => '1/3',
    __('5 columns - 5/12', 'mk_framework') => '5/12',
    __('6 columns - 1/2', 'mk_framework') => '1/2',
    __('7 columns - 7/12', 'mk_framework') => '7/12',
    __('8 columns - 2/3', 'mk_framework') => '2/3',
    __('9 columns - 3/4', 'mk_framework') => '3/4',
    __('10 columns - 5/6', 'mk_framework') => '5/6',
    __('11 columns - 11/12', 'mk_framework') => '11/12',
    __('12 columns - 1/1', 'mk_framework') => '1/1'
);
vc_map(array(
    "name" => __("Column", "mk_framework"),
    "base" => "vc_column",
    "is_container" => true,
    "content_element" => false,
    "params" => array(
        array(
            "type" => "colorpicker",
            "heading" => __("Column Border Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "",
            "description" => __("You can optionally add border color to columns.", "mk_framework")
        ),
        $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        ),
         array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'mk_framework' ),
            'param_name' => 'css',
            // 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'mk_framework' ),
            'group' => __( 'Design options', 'mk_framework' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Width', 'mk_framework' ),
            'param_name' => 'width',
            'value' => $column_width_list,
            'group' => __( 'Width & Responsiveness', 'mk_framework' ),
            'description' => __( 'Select column width.', 'mk_framework' ),
            'std' => '1/1'
        ),
        array(
            'type' => 'column_offset',
            'heading' => __('Responsiveness', 'mk_framework'),
            'param_name' => 'offset',
            'group' => __( 'Width & Responsiveness', 'mk_framework' ),
            'description' => __('Adjust column for different screen sizes. Control width, offset and visibility settings.', 'mk_framework')
        )
    ),
    "js_view" => 'VcColumnView'
));

vc_map( array(
    "name" => __( "Column", "mk_framework" ),
    "base" => "vc_column_inner",
    "class" => "",
    "icon" => "",
    "wrapper_class" => "",
    "controls" => "full",
    "allowed_container_element" => false,
    "content_element" => false,
    "is_container" => true,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __( "Extra class name", "mk_framework" ),
            "param_name" => "el_class",
            "value" => "",
            "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework" )
        ),
         array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'mk_framework' ),
            'param_name' => 'css',
            // 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'mk_framework' ),
            'group' => __( 'Design options', 'mk_framework' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Width', 'mk_framework' ),
            'param_name' => 'width',
            'value' => $column_width_list,
            'group' => __( 'Width & Responsiveness', 'mk_framework' ),
            'description' => __( 'Select column width.', 'mk_framework' ),
            'std' => '1/1'
        ),
    ),
    "js_view" => 'VcColumnView'
) );

vc_map(array(
    "name" => __("Page Section", "mk_framework"),
    "base" => "mk_page_section",
    "category" => __('General', 'mk_framework'),
    "as_parent" => array('only' => 'vc_row',),
    'icon' => 'icon-mk-page-section vc_mk_element-icon',
    "content_element" => true,
    "show_settings_on_create" => true,
    "is_container" => true,
    'description' => __( 'Customisable full width page section.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Section Structure", "mk_framework"),
            "param_name" => "layout_structure",
            "width" => 300,
            "value" => array(
                __('Full Layout', "mk_framework") => "full",
                __('One Half (Background Image on Left & Content in Right)', "mk_framework") => "half_left",
                __('One Half (Background Image on Right & Content in Left)', "mk_framework") => "half_right"
            ),
            "description" => __("If chosen One Half layouts, uploaded background image will be displyed in one half of the screen width. the shortcodes placed in this section will occupy the rest of the half(not screen wide, rather it will follow half of the main grid width).", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Box Background Color", "mk_framework"),
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "upload",
            "heading" => __("Background Image", "mk_framework"),
            "param_name" => "bg_image",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Border Top and Bottom Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Background Attachment", "mk_framework"),
            "param_name" => "attachment",
            "width" => 150,
            "value" => array(
                __('Scroll', "mk_framework") => "scroll",
                __('Fixed', "mk_framework") => "fixed"
            ),
            "description" => __("The background-attachment property sets whether a background image is fixed or scrolls with the rest of the page. <a href='http://www.w3schools.com/CSSref/pr_background-attachment.asp'>Read More</a>", "mk_framework"),
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Background Position", "mk_framework"),
            "param_name" => "bg_position",
            "width" => 300,
            "value" => array(
                __('Left Top', "mk_framework") => "left top",
                __('Center Top', "mk_framework") => "center top",
                __('Right Top', "mk_framework") => "right top",
                __('Left Center', "mk_framework") => "left center",
                __('Center Center', "mk_framework") => "center center",
                __('Right Center', "mk_framework") => "right center",
                __('Left Bottom', "mk_framework") => "left bottom",
                __('Center Bottom', "mk_framework") => "center bottom",
                __('Right Bottom', "mk_framework") => "right bottom"
            ),
            "description" => __("First value defines horizontal position and second vertical positioning.", "mk_framework"),
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Background Repeat", "mk_framework"),
            "param_name" => "bg_repeat",
            "width" => 300,
            "value" => array(
                __('Repeat', "mk_framework") => "repeat",
                __('No Repeat', "mk_framework") => "no-repeat",
                __('Horizontally repeat', "mk_framework") => "repeat-x",
                __('Vertically Repeat', "mk_framework") => "repeat-y"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __('Cover whole background', 'mk_framework'),
            "description" => __("Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area.", "mk_framework"),
            "param_name" => "bg_stretch",
            "value" => "false"
        ),
        array(
            "type" => "toggle",
            "heading" => __("Enable Parallax background", "mk_framework"),
            "param_name" => "parallax",
            "description" => __("Please not that parallax works better with Background Attachement set to scroll. Background Attachement fixed is also possible but make sure to choose repeating background as well.", "mk_framework"),
            "value" => "false",
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Parallax Direction", "mk_framework"),
            "param_name" => "parallax_direction",
            "width" => 300,
            "value" => array(
                __('Vertical trigger on page scroll', "mk_framework") => "vertical",
                __('Vertical trigger on mouse move', "mk_framework") => "vertical_mouse",
                __('Horizontal trigger on page scroll', "mk_framework") => "horizontal",
                __('Horizontal trigger on mouse move', "mk_framework") => "horizontal_mouse",
                __('Horizontal & Vertical trigger on mouse move', "mk_framework") => "both_axis_mouse"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Background Video?", "mk_framework"),
            "param_name" => "bg_video",
            "width" => 300,
            "value" => array(
                __('No', "mk_framework") => "no",
                __('Yes', "mk_framework") => "yes"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "upload",
            "heading" => __("MP4 Format", "mk_framework"),
            "param_name" => "mp4",
            "value" => "",
            "description" => __("Compatibility for Safari, IE9", "mk_framework"),
            "dependency" => array(
                'element' => "bg_video",
                'value' => array(
                    'yes'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("WebM Format", "mk_framework"),
            "param_name" => "webm",
            "value" => "",
            "description" => __("Compatibility for Firefox4, Opera, and Chrome", "mk_framework"),
            "dependency" => array(
                'element' => "bg_video",
                'value' => array(
                    'yes'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("OGV Format", "mk_framework"),
            "param_name" => "ogv",
            "value" => "",
            "description" => __("Compatibility for older Firefox and Opera versions", "mk_framework"),
            "dependency" => array(
                'element' => "bg_video",
                'value' => array(
                    'yes'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Background Video Preview image (and fallback image)", "mk_framework"),
            "param_name" => "poster_image",
            "value" => "",
            "description" => __("This Image will shown until video load. in case of video is not supported or did not load the image will remain as fallback.", "mk_framework"),
            "dependency" => array(
                'element' => "bg_video",
                'value' => array(
                    'yes'
                )
            )
        ),

        array(
            "type" => "toggle",
            "heading" => __("Mask Pattern? (optional)", "mk_framework"),
            "param_name" => "mask",
            "description" => __("If you enable this option a pattern will overlay the section.", "mk_framework"),
            "value" => "false",
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Color Mask (optional)", "mk_framework"),
            "param_name" => "color_mask",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Color Mask Opacity", "mk_framework"),
            "param_name" => "mask_opacity",
            "value" => "0.6",
            "min" => "0",
            "max" => "1",
            "step" => "0.1",
            "unit" => 'alpha',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Expandable Page Section", "mk_framework"),
            "param_name" => "expandable",
            "width" => 300,
            "value" => array(
                __('No', "mk_framework") => "false",
                __('Yes', "mk_framework") => "true"
            ),
            "description" => __("If you want to have your page section content in a toggle that can be clicked to expand/collapse, Choose Yes and customize below options. This option will not work if \"Full Height\" option is enabled.", "mk_framework")
        ),


        array(
            "type" => "textfield",
            "heading" => __("Expandable Page Section Text", "mk_framework"),
            "param_name" => "expandable_txt",
            "value" => "",
            "description" => __("e.g. Click here to see more.", "mk_framework"),
            "dependency" => array(
                'element' => "expandable",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Expandable Page Section Hover Image", "mk_framework"),
            "param_name" => "expandable_image",
            "value" => "",
            "description" => __("If this option left blank font icon option (below) will be used instead. So if you would like to use font icon library simply leave this option empty.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Expandable Page Section Hover Icon", "mk_framework"),
            "param_name" => "expandable_icon",
            "value" => "mk-theme-icon-plus",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework"),
        ),
        array(
            "type" => "range",
            "heading" => __("Expandable Page Section Icon Size", "mk_framework"),
            "param_name" => "expandable_icon_size",
            "value" => "16",
            "min" => "16",
            "max" => "300",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "expandable",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Expandable Page Section Text Align", "mk_framework"),
            "param_name" => "expandable_txt_align",
            "width" => 300,
            "value" => array(
                __('Center', "mk_framework") => "center",
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "expandable",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Expandable Page Section Text & Arrow Color", "mk_framework"),
            "param_name" => "expandable_txt_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "expandable",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Expandable Page Section Text Size", "mk_framework"),
            "param_name" => "expandable_txt_size",
            "value" => "16",
            "min" => "12",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "expandable",
                'value' => array(
                    'true'
                )
            )
        ),

        array(
            "type" => "range",
            "heading" => __("Padding Top & Bottom", "mk_framework"),
            "param_name" => "padding",
            "value" => "20",
            "min" => "0",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("This option defines how much top & bottom distance you need to have inside this section", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Full Height?", "mk_framework"),
            "param_name" => "full_height",
            "description" => __("Using this option you can make this page section full height and it's height will follow screen height that is visible in browser. Please note that if the content is larger than the window height, the full height feature will be disabled. Full height is browser resize sensetive and completely resposnive. This option will not work if you have enabled \"Expandable Page Section\" option above.", "mk_framework"),
            "value" => "false",
            "dependency" => array(
                'element' => "expandable",
                'value' => array(
                    'false'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Full Width?", "mk_framework"),
            "param_name" => "full_width",
            "value" => "false",
            "description" => __("If you want to make this section's content 100% full width enable this option.", "mk_framework"),
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Page Section Intro Effect", "mk_framework"),
            "param_name" => "intro_effect",
            "value" => array(
                __('None', "mk_framework") => "false",
                __('Shuffle', "mk_framework") => "shuffle",
                __('Zoom Out', "mk_framework") => "zoom_out",
                __('Fade In', "mk_framework") => "fade"
            ),
            "description" => __("Note that this page section must be the first element in the page with full height enabled above.", "mk_framework"),
            "dependency" => array(
                'element' => "expandable",
                'value' => array(
                    'false'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Section ID", "mk_framework"),
            "param_name" => "section_id",
            "value" => "",
            "description" => __("You can user this field to give your page section a unique ID. please note that this should be used only once in a page.", "mk_framework")
        ),
        $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )

    ),
    "js_view" => 'VcRowView'
));

vc_map(array(
    "name" => __("Custom Box", "mk_framework"),
    "base" => "mk_custom_box",
    "as_parent" => array('except' => 'vc_row,mk_page_section'),
    "content_element" => true,
    "show_settings_on_create" => false,
    "description" => __("Custom Box For your contents.","mk_framework"),
    'icon' => 'icon-mk-custom-box vc_mk_element-icon',
    "category" => __('General', 'mk_framework'),
    "params" => array(

        array(
            "type" => "colorpicker",
            "heading" => __("Border Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework"),
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Drop Outer Shadow", "mk_framework"),
            "param_name" => "drop_shadow",
            "value" => "false"
        ),
        array(
            "type" => "upload",
            "heading" => __("Background Image", "mk_framework"),
            "param_name" => "bg_image",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Background Position", "mk_framework"),
            "param_name" => "bg_position",
            "width" => 300,
            "value" => array(
                __('Left Top', "mk_framework") => "left top",
                __('Center Top', "mk_framework") => "center top",
                __('Right Top', "mk_framework") => "right top",
                __('Left Center', "mk_framework") => "left center",
                __('Center Center', "mk_framework") => "center center",
                __('Right Center', "mk_framework") => "right center",
                __('Left Bottom', "mk_framework") => "left bottom",
                __('Center Bottom', "mk_framework") => "center bottom",
                __('Right Bottom', "mk_framework") => "right bottom"
            ),
            "description" => __("First value defines horizontal position and second vertical positioning.", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Background Repeat", "mk_framework"),
            "param_name" => "bg_repeat",
            "width" => 300,
            "value" => array(
                __('Repeat', "mk_framework") => "repeat",
                __('No Repeat', "mk_framework") => "no-repeat",
                __('Horizontally repeat', "mk_framework") => "repeat-x",
                __('Vertically Repeat', "mk_framework") => "repeat-y"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Cover Whole Background", "mk_framework"),
            "param_name" => "bg_stretch",
            "value" => "false"
        ),

        array(
            "type" => "range",
            "heading" => __("Padding Top and Bottom", "mk_framework"),
            "param_name" => "padding_vertical",
            "value" => "30",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Padding Left and Right", "mk_framework"),
            "param_name" => "padding_horizental",
            "value" => "20",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework"),
            "param_name" => "margin_bottom",
            "value" => "20",
            "min" => "-50",
            "max" => "300",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework"),
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ),
        $add_device_visibility,

        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    ),
    "js_view" => 'VcColumnView'
));

vc_map(array(
    "name" => __("Image", "mk_framework"),
    "base" => "mk_image",
    "category" => __('General', 'mk_framework'),
    'description' => __( 'Adds Image element with many styles.', 'mk_framework' ),
    'icon' => 'icon-mk-image vc_mk_element-icon',
    "params" => array(
        array(
            "type" => "upload",
            "heading" => __("Upload Your image", "mk_framework"),
            "param_name" => "src",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "range",
            "heading" => __("Image Width", "mk_framework"),
            "param_name" => "image_width",
            "value" => "500",
            "min" => "10",
            "max" => "2600",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Image Height", "mk_framework"),
            "param_name" => "image_height",
            "value" => "350",
            "min" => "10",
            "max" => "5000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Image Cropping?", "mk_framework"),
            "param_name" => "crop",
            "value" => "true",
            "description" => __("If you dont want to crop your image based on the dimensions you defined above disable this option. Only wdith will be used to give the image container max-width property.", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Image Hover?", "mk_framework"),
            "param_name" => "hover",
            "value" => "true",
            "description" => __("If you disable this option the image hover layer including the 'click to open in lightbox' and 'image title' will be removed from this image.", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Image Circular?", "mk_framework"),
            "param_name" => "circular",
            "value" => "false",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Hover Style", "mk_framework"),
            "param_name" => "hover_style",
            "width" => 150,
            "value" => array(
                __('Style 1', "mk_framework") => "style1",
                __('Style 2', "mk_framework") => "style2"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Custom URL", "mk_framework"),
            "param_name" => "custom_url",
            "value" => "",
            "description" => __("use this option if you want to link to a webpage instead of 'click to open in lightbox'", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Custom LightBox URL", "mk_framework"),
            "param_name" => "custom_lightbox_url",
            "value" => "",
            "description" => __("If you want to load custom image, video in lightbox then fill this form with the URL of the image or video(e.g. youtube, vimeo)'", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Lightbox iFrame Mode", "mk_framework"),
            "param_name" => "lightbox_ifarme",
            "value" => "false",
            "description" => __("If you are using a custom ligthbox url and the content you would like to show is webpage, google maps or flash content, enable this option.", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Custom URL Target", "mk_framework"),
            "param_name" => "target",
            "width" => 200,
            "value" => $target_arr,
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework"),
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Lightbox Group rel", "mk_framework"),
            "param_name" => "group",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework"),
            "param_name" => "margin_bottom",
            "value" => "10",
            "min" => "-50",
            "max" => "300",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework"),
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ),
        $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )



    )
));


vc_map(array(
    "name" => __("Image Box", "mk_framework"),
    "base" => "mk_image_box",
    "category" => __('General', 'mk_framework'),
    'description' => __( 'A custom box with image and content.', 'mk_framework' ),
    'icon' => 'icon-mk-content-box vc_mk_element-icon',
    "params" => array(
         array(
            "type" => "textfield",
            "heading" => __("Box Title", "mk_framework"),
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

         array(
            "type" => "textarea",
            "heading" => __("Box Description", "mk_framework"),
            "param_name" => "content",
            "holder" => "div",
            "value" => "",
            "description" => __("This field accepts HTML tags.", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Media Type", "mk_framework"),
            "param_name" => "media_type",
            "width" => 150,
            "value" => array(
                __('Image', "mk_framework") => "image",
                __('Video', "mk_framework") => "video"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Autoplay?", "mk_framework"),
            "param_name" => "autoplay",
            "value" => "false",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "media_type",
                'value' => array(
                    'video'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Video Host?", "mk_framework"),
            "param_name" => "video_host",
            "width" => 150,
            "value" => array(
                __('Self Hosted', "mk_framework") => "self_hosted",
                __('Social Hosted', "mk_framework") => "social_hosted"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "media_type",
                'value' => array(
                    'video'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Video Host?", "mk_framework"),
            "param_name" => "video_host_social",
            "width" => 150,
            "value" => array(
                __('Youtube', "mk_framework") => "social_hosted_youtube",
                __('Vimeo', "mk_framework") => "social_hosted_vimeo"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "video_host",
                'value' => array(
                    'social_hosted'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Video ID?", "mk_framework"),
            "param_name" => "social_youtube_id",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "video_host_social",
                'value' => array(
                    'social_hosted_youtube'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Video ID?", "mk_framework"),
            "param_name" => "social_vimeo_id",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "video_host_social",
                'value' => array(
                    'social_hosted_vimeo'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Background Video (.MP4)", "mk_framework"),
            "param_name" => "mp4",
            "value" => "",
            "description" => __("Upload your video with .MP4 extension. (Compatibility for Safari and IE9)", "mk_framework"),
            "dependency" => array(
                'element' => "video_host",
                'value' => array(
                    'self_hosted'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Background Video (.WebM)", "mk_framework"),
            "param_name" => "webm",
            "value" => "",
            "description" => __("Upload your video with .WebM extension. (Compatibility for Firefox4, Opera, and Chrome)", "mk_framework"),
            "dependency" => array(
                'element' => "video_host",
                'value' => array(
                    'self_hosted'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Background Video (.OGV)", "mk_framework"),
            "param_name" => "ogv",
            "value" => "",
            "description" => __("Upload preview image for mobile devices", "mk_framework"),
            "dependency" => array(
                'element' => "video_host",
                'value' => array(
                    'self_hosted'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Preview Image", "mk_framework"),
            "param_name" => "preview_image",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "video_host",
                'value' => array(
                    'self_hosted'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Upload Your image", "mk_framework"),
            "param_name" => "src",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "media_type",
                'value' => array(
                    'image'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Box Width", "mk_framework"),
            "param_name" => "media_width",
            "value" => "500",
            "min" => "10",
            "max" => "2600",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            // "dependency" => array(
            //     "element" => "media_type",
            //     "value" => array(
            //         "image"
            //     )
            // )
        ),
        array(
            "type" => "range",
            "heading" => __("Image Height", "mk_framework"),
            "param_name" => "media_height",
            "value" => "350",
            "min" => "10",
            "max" => "5000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                "element" => "media_type",
                "value" => array(
                    "image"
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Image Cropping?", "mk_framework"),
            "param_name" => "crop",
            "value" => "true",
            "description" => __("If you dont want to crop your image based on the dimensions you defined above disable this option. Only wdith will be used to give the image container max-width property.", "mk_framework"),
            "dependency" => array(
                "element" => "media_type",
                "value" => array(
                    "image"
                )
            )

        ),

        array(
            "type" => "dropdown",
            "heading" => __("Image Link?", "mk_framework"),
            "param_name" => "image_link",
            "width" => 200,
            "value" => array(
                __('Lightbox', "mk_framework") => "lightbox",
                __('Url', "mk_framework") => "url"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                "element" => "media_type",
                "value" => array(
                    "image"
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link (optional)", "mk_framework"),
            "param_name" => "url",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "image_link",
                'value' => array(
                    'url'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("URL Target", "mk_framework"),
            "param_name" => "target",
            "width" => 200,
            "value" => $target_arr,
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "image_link",
                'value' => array(
                    'url'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework"),
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Box Background Color", "mk_framework"),
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Border Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "",
            "description" => __("If left blank no border will be added.", "mk_framework"),
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Text Color", "mk_framework"),
            "param_name" => "text_color",
            "value" => "",
            "description" => __("This option will apply to title and description", "mk_framework"),
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Title Color", "mk_framework"),
            "param_name" => "title_color",
            "value" => "",
            "description" => __("This option will apply to title and description", "mk_framework"),
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Title Text Transform", "mk_framework"),
            "param_name" => "title_text_transform",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "",
                __('None', "mk_framework") => "none",
                __('Uppercase', "mk_framework") => "uppercase",
                __('Lowercase', "mk_framework") => "lowercase",
                __('Capitalize', "mk_framework") => "capitalize"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Title Font Weight", "mk_framework"),
            "param_name" => "title_font_weight",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Semi Bold', "mk_framework") => "600",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Normal', "mk_framework") => "normal",
                __('Light', "mk_framework") => "300"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Rounded Corners?", "mk_framework"),
            "param_name" => "rounded_corner",
            "value" => "false",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "media_type",
                'value' => array(
                    'image'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework"),
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ),
       $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )



    )
));

vc_map(array(
    "name" => __("Moving Image", "mk_framework"),
    "base" => "mk_moving_image",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-moving-image vc_mk_element-icon',
    'description' => __( 'Images powered by CSS3 moving animations.', 'mk_framework' ),
    "params" => array(

        array(
            "type" => "upload",
            "heading" => __("Upload Your image", "mk_framework"),
            "param_name" => "src",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework"),
            "param_name" => "style",
            "value" => $infinite_animation,
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework"),
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title & Alt", "mk_framework"),
            "param_name" => "title",
            "value" => "",
            "description" => __("For SEO purposes you may need to fill out the title and alt property for this image", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework"),
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )

    )
));



vc_map(array(
    "name" => __("Image Gallery", "mk_framework"),
    "base" => "mk_gallery",
    'icon' => 'icon-mk-image-gallery vc_mk_element-icon',
    'description' => __( 'Adds images in grids in many styles.', 'mk_framework' ),
    "category" => __('General', 'mk_framework'),
    "params" => array(
        array(
            "type" => "attach_images",
            "heading" => __("Add Images", "mk_framework"),
            "param_name" => "images",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework"),
            "param_name" => "style",
            "value" => array(
                "Grid" => "grid",
                "Slider with Thumbnails" => "thumb",
                "Masonry" => "masonry",

            ),
            "description" => __("Please choose how would you like to show you gallery images?", "mk_framework")
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Structure", "mk_framework"),
            "param_name" => "structure",
            "value" => array(
                "Column Base" => "column",
                "scroller" => "scroller"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid'
                )
            )
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Masonry Style", "mk_framework"),
            "param_name" => "masonry_style",
            "value" => array(
                "Style 1" => "style1",
                "Style 2" => "style2",
                "Style 3" => "style3",
                "Style 4" => "style4"
            ),
            "description" => __("Mansory Styles Structure see below image :</br><img src='".THEME_ADMIN_ASSETS_URI."/img/gallery-mansory-styles.png' /><br>", 'mk_framework'),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'masonry'
                )
            )
        ),
        array(
            "heading" => __("Image Size", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "image_size",
            "value" => array(
                __("Resize & Crop", 'mk_framework') => "crop",
                __("Original Size", 'mk_framework') => "full",
                __("Large Size", 'mk_framework') => "large",
                __("Medium Size", 'mk_framework') => "medium"
            ),
            "type" => "dropdown",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid'
                )
            )
        ),
        array(
            "heading" => __("Item Spacing", 'mk_framework'),
            "description" => __("Space between items.", 'mk_framework'),
            "param_name" => "item_spacing",
            "value" => "8",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "type" => "range",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'masonry'
                )
            )
        ),

        array(
            "type" => "range",
            "heading" => __("How many Columns?", "mk_framework"),
            "param_name" => "column",
            "value" => "4",
            "min" => "1",
            "max" => "6",
            "step" => "1",
            "unit" => 'column',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "structure",
                'value' => array(
                    'column'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Image Dimension", "mk_framework"),
            "param_name" => "scroller_dimension",
            "value" => "400",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("This width will be applied to both height and width.", "mk_framework"),
            "dependency" => array(
                'element' => "structure",
                'value' => array(
                    'scroller'
                )
            )
        ),

        array(
            "type" => "range",
            "heading" => __("Preview Image Width", "mk_framework"),
            "param_name" => "thumb_style_width",
            "value" => "700",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'thumb'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Preview Image Height", "mk_framework"),
            "param_name" => "thumb_style_height",
            "value" => "380",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'thumb'
                )
            )
        ),
        array(
            "heading" => __("Hover Scenarios", 'mk_framework'),
            "description" => __("This is what happens when user hovers over a gallery item.", 'mk_framework'),
            "param_name" => "hover_scenarios",
            "value" => array(
                __("Overlay Layer", 'mk_framework') => "overlay",
                __("Gradient Layer", 'mk_framework') => 'gradient'
            ),
            "type" => "dropdown",
        ),
        array(
            "type" => "toggle",
            "heading" => __("Image Title", "mk_framework"),
            "param_name" => "enable_title",
            "value" => "true",
            "description" => __("If you dont want to show image title disable this option.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid'
                )
            )
        ),

        array(
            "type" => "range",
            "heading" => __("Image Height", "mk_framework"),
            "param_name" => "height",
            "value" => "500",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("You can define you gallery image's height from this option. It only works for column structure", "mk_framework"),
            "dependency" => array(
                'element' => "structure",
                'value' => array(
                    'column'
                ),
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Increase Quality of Image", "mk_framework"),
            "param_name" => "image_quality",
            "value" => array(
                __("No Actions", 'mk_framework') => "1",
                __("Images 2 times bigger (retina compatible)", 'mk_framework') => "2",
                __("Images 3 times bigger (fullwidth row compatible)", 'mk_framework') => "3"
            ),
            "description" => __("If you want Gallery images be retina compatible or you just want to use it in fullwidth row, you may consider increasing the image size. This option basically amplifies the image size to not let the browser scale it to fit the column (which is a quality loss).", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework"),
            "param_name" => "margin_bottom",
            "value" => "20",
            "min" => "0",
            "max" => "300",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ),
         array(
            'type' => 'item_id',
            'heading' => __( 'Item ID', 'mk_framework' ),
            'param_name' => "item_id"
        )

    )
));




vc_map(array(
    "name" => __("Button", "mk_framework"),
    "base" => "mk_button",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-button vc_mk_element-icon',
    'description' => __( 'Powerful & versatile button shortcode', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Button Text", "mk_framework"),
            "param_name" => "content",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework"),
            "param_name" => "style",
            "value" => array(
                "Flat" => "flat",
                "3D" => "three-dimension",
                "Outline" => "outline",
                "Line" => "line",
                "Fill" => "fill",
                "Nudge" => "nudge",
                "Radius" => "radius",
                "Fancy Link" => "fancy_link"
            ),
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Corner style", "mk_framework"),
            "param_name" => "corner_style",
            "value" => array(
                "Pointed" => "pointed",
                "Rounded" => "rounded",
                "Full Rounded" => "full_rounded"
            ),
            "description" => __("How will your button corners look like?", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'flat',
                    'three-dimension',
                    'outline',
                    'fill',
                    'nudge'
                )
            )
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Size", "mk_framework"),
            "param_name" => "size",
            "value" => array(
                "Small" => "small",
                "Medium" => "medium",
                "Large" => "large",
                "X Large" => "xlarge",
                "XX Large" => "xxlarge"
            ),
            "description" => __("", "mk_framework")
        ),


        array(
            "type" => "colorpicker",
            "heading" => __("Button Background Color", "mk_framework"),
            "param_name" => "bg_color",
            "value" => "#444444",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'flat',
                    'three-dimension'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Button Text Color", "mk_framework"),
            "param_name" => "txt_color",
            "value" => "#ddd",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'flat',
                    'three-dimension',
                    'fancy_link'
                )
            )
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Underline Color", "mk_framework"),
            "param_name" => "underline_color",
            "value" => "#ddd",
            "description" => __("This option is for outline style.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'fancy_link'
                )
            )
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Outline Button Skin", "mk_framework"),
            "param_name" => "outline_skin",
            "value" => "#444444",
            "description" => __("This option is for outline style.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'outline',
                    'line',
                    'fill',
                    'radius'
                )
            )
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Outline Button Hover Text", "mk_framework"),
            "param_name" => "outline_hover_skin",
            "value" => "#fff",
            "description" => __("This option is for outline style.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'outline',
                    'line',
                    'fill'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Outline Button Border Width", "mk_framework"),
            "param_name" => "outline_border_width",
            "value" => "2",
            "min" => "1",
            "max" => "5",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'outline',
                    'fill'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Nudge Button Skin", "mk_framework"),
            "param_name" => "nudge_skin",
            "value" => "#444444",
            "description" => __("This option is for outline style.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'nudge'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework"),
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework"),
            "dependency" => array(
                "element" => "style",
                "value" => array(
                    'flat',
                    'three-dimension',
                    'outline',
                    'line',
                    'fill',
                    'nudge',
                    'radius'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button URL", "mk_framework"),
            "param_name" => "url",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Target", "mk_framework"),
            "param_name" => "target",
            "width" => 200,
            "value" => $target_arr,
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework"),
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center"
            ),
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Button ID", "mk_framework"),
            "param_name" => "id",
            "value" => "",
            "description" => __("If your want to use id for this button to refer it in your custom JS, fill this textbox.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework"),
            "param_name" => "margin_bottom",
            "value" => "15",
            "min" => "-30",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Infinite Animations", "mk_framework"),
            "param_name" => "infinite_animation",
            "value" => $infinite_animation,
            "description" => __("", "mk_framework"),
            "dependency" => array(
                "element" => "style",
                "value" => array(
                    'flat',
                    'three-dimension',
                    'outline',
                    'line',
                    'fill',
                    'nudge',
                    'radius'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework"),
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )

    )
));


vc_map(array(
    "name" => __("Call to Action", "mk_framework"),
    "base" => "mk_call_to_action",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-mini-callout-box vc_mk_element-icon',
    'description' => __( 'Callout box for important infos.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Box Style", "mk_framework"),
            "param_name" => "style",
            "value" => array(
                "Default" => "default",
                "Custom" => "custom"
            ),

            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Layout Style", "mk_framework"),
            "param_name" => "layout_style",
            "value" => array(
                "Expended" => "expended",
                "Centered" => "centered"
            ),

            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Box Border Width", "mk_framework"),
            "param_name" => "box_border_width",
            "value" => "2",
            "min" => "1",
            "max" => "5",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "range",
            "heading" => __("Button Border Width", "mk_framework"),
            "param_name" => "button_border_width",
            "value" => "2",
            "min" => "1",
            "max" => "5",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Box Background Color", "mk_framework"),
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Box Border Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Text Color", "mk_framework"),
            "param_name" => "text_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Font Size", "mk_framework"),
            "param_name" => "text_size",
            "value" => "18",
            "min" => "12",
            "max" => "70",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Font Weight", "mk_framework"),
            "param_name" => "font_weight",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Semi Bold', "mk_framework") => "600",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Normal', "mk_framework") => "normal",
                __('Light', "mk_framework") => "300"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Text Transform", "mk_framework"),
            "param_name" => "text_transform",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "",
                __('None', "mk_framework") => "none",
                __('Uppercase', "mk_framework") => "uppercase",
                __('Lowercase', "mk_framework") => "lowercase",
                __('Capitalize', "mk_framework") => "capitalize"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Content Text", "mk_framework"),
            "param_name" => "text",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button Text", "mk_framework"),
            "param_name" => "button_text",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Button Style", "mk_framework"),
            "param_name" => "button_style",
            "value" => array(
                "Outline" => "outline",
                "Flat" => "flat"
            ),

            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button URL", "mk_framework"),
            "param_name" => "button_url",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Button Skin", "mk_framework"),
            "param_name" => "outline_skin",
            "value" => "#444",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Hover State Skin", "mk_framework"),
            "param_name" => "outline_hover_skin",
            "value" => "#fff",
            "description" => __("This option is for Text and icon colors.", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Message Box", "mk_framework"),
    "base" => "mk_message_box",
    'icon' => 'icon-mk-message-box vc_mk_element-icon',
    "category" => __('General', 'mk_framework'),
    'description' => __( 'Message Box with multiple types.', 'mk_framework' ),
    "params" => array(

        array(
            "type" => "dropdown",
            "heading" => __("Type", "mk_framework"),
            "param_name" => "type",
            "value" => array(
                "Love Box" => "love",
                "Hint Box" => "hint",
                "Solution Box" => "solution",
                "Alert Box" => "alert",
                "Confirm Box" => "confirm",
                "Warning Box" => "warning",
                "Star Box" => "star",
                "Built It Yourself" => "generic"
            ),

            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework"),
            "param_name" => "style",
            "value" => array(
                "Pointed Style" => "pointed",
                "Rounded Style" => "rounded"
            ),

            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Add Box Icon Class Name", "mk_framework"),
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework"),
            "dependency" => array(
                'element' => "type",
                'value' => array(
                    'generic'
                )
            )
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Box Color", "mk_framework"),
            "param_name" => "box_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "type",
                'value' => array(
                    'generic'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Border Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "type",
                'value' => array(
                    'generic'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Content Color", "mk_framework"),
            "param_name" => "content_color",
            "value" => "",
            "description" => __("This option affects icon, vertical separator and text color.", "mk_framework"),
            "dependency" => array(
                'element' => "type",
                'value' => array(
                    'generic'
                )
            )
        ),

        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Write your message in this textarea.", "mk_framework"),
            "param_name" => "content",
            "value" => __("", "mk_framework"),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )

    )
));

vc_map(array(
    "name" => __("Icon Box", "mk_framework"),
    "base" => "mk_icon_box",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-icon-box vc_mk_element-icon',
    'description' => __( 'Powerful & versatile Icon Boxes.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Box Style", "mk_framework"),
            "param_name" => "style",
            "width" => 300,
            "value" => array(
                __('Style 1', "mk_framework") => "style1",
                __('Style 2', "mk_framework") => "style2",
                __('Style 3', "mk_framework") => "style3",
                __('Style 4', "mk_framework") => "style4",
                __('Style 5', "mk_framework") => "style5",
                __('Style 6', "mk_framework") => "style6",
                __('Style 7 (new)', "mk_framework") => "style7"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Icon Type", "mk_framework"),
            "param_name" => "icon_type",
            "value" => array(
                __('Icon', "mk_framework") => "icon",
                __('Image', "mk_framework") => "image"
            ),
            "description" => __("", "mk_framework"),
        ),

        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework"),
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework"),
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'icon'
                )
            )
        ),

        array(
            "type" => "upload",
            "heading" => __("Icon Image", "mk_framework"),
            "param_name" => "icon_image",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'image'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Icon Container Circle?", "mk_framework"),
            "param_name" => "rounded",
            "value" => "true",
            "description" => __("If you disable this option the icon container will not be rounded.", "mk_framework"),
        ),
        array(
            "type" => "toggle",
            "heading" => __("Icon Container Frame?", "mk_framework"),
            "param_name" => "icon_frame",
            "value" => "true",
            "description" => __("If disabed, icon frame will be removed and box background color will be given to icon color. This option only works for Style 7.", "mk_framework"),
             "dependency" => array(
                'element' => "style",
                'value' => array(
                    'style7'
                )
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Icon Align", "mk_framework"),
            "param_name" => "icon_align",
            "width" => 300,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Top (Style7)', "mk_framework") => "top"
            ),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'style2',
                    'style7'
                )
            ),
            "description" => __("Please note that this option only works with Style 2 and 7. Top option only works for style 7.", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Icon Size (Style 7 only)", "mk_framework"),
            "param_name" => "icon_size",
            "value" => array(
                __('Large (64px)', "mk_framework") => "large",
                __('Medium (48px)', "mk_framework") => "medium",
                __('Small (32px)', "mk_framework") => "small",
            ),
            "description" => __("Please note that this option will not work for image type icon.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'style7'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework"),
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Description", "mk_framework"),
            "param_name" => "content",
            "value" => __("", "mk_framework"),
            "description" => __("Enter your content.", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Read More Text", "mk_framework"),
            "param_name" => "read_more_txt",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Read More URL", "mk_framework"),
            "param_name" => "read_more_url",
            "value" => "",
            "description" => __("", "mk_framework")
        ),



        array(
            "type" => "colorpicker",
            "heading" => __("Icon Skin", "mk_framework"),
            "param_name" => "icon_color",
            "value" => "",
            "description" => __("Icon color for style 1, style 2, style 3, style 5 means the icon color. For style 4, style 6 and style 7 icon frame fill color.", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Title Color", "mk_framework"),
            "param_name" => "title_color",
            "value" => "",
            "description" => __("Optionally you can modify Title color inside this shortcode.", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Paragraph Color", "mk_framework"),
            "param_name" => "txt_color",
            "value" => "",
            "description" => __("Optionally you can modify text color inside this shortcode.", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Button Skin Color", "mk_framework"),
            "param_name" => "btn_skin",
            "value" => "",
            "description" => __("This option is for outline style.", "mk_framework"),
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Button Hover Text Color", "mk_framework"),
            "param_name" => "btn_hover_skin",
            "value" => "",
            "description" => __("This option is for outline style.", "mk_framework"),
        ),

        array(
            "type" => "range",
            "heading" => __("Paragraph Text Line Height", "mk_framework"),
            "param_name" => "p_line_height",
            "value" => "26",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework"),
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));







vc_map(array(
    "name" => __("Divider", "mk_framework"),
    "base" => "mk_divider",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-divider vc_mk_element-icon',
    'description' => __( 'Dividers with many styles & options.', 'mk_framework' ),
    "params" => array(

        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework"),
            "param_name" => "style",
            "value" => array(
                "Line" => 'single',
                "Dotted" => 'dotted',
                "Dashed" => 'dashed',
                "Thick" => 'thick'
            ),
            "description" => __("Please Choose the style of the line of divider.", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Divider Color (optional)", "mk_framework"),
            "param_name" => "divider_color",
            "value" => '',
            "description" => __("This option will not affect fancy divider border color. default color : #e4e4e4", "mk_framework")
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Divider Width", "mk_framework"),
            "param_name" => "divider_width",
            "value" => array(
                "Full Width" => "full_width",
                "One Half" => "one_half",
                "One Third" => "one_third",
                "One Fourth" => "one_fourth",
                "Custom Width" => "custom_width"
            ),
            "description" => __("There are 5 widths you can define for each of your divider styles.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Divider Custom Width", "mk_framework"),
            "param_name" => "custom_width",
            "value" => "10",
            "min" => "1",
            "max" => "900",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Choose any custom width for divider", "mk_framework"),
            "dependency" => array(
                'element' => "divider_width",
                'value' => array(
                    'custom_width'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework"),
            "param_name" => "align",
            "value" => array(
                "Center" => "center",
                "Left" => "left",
                "Right" => "right",
            ),
            "dependency" => array(
                'element' => "divider_width",
                'value' => array(
                    'custom_width'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Divider Thickness", "mk_framework"),
            "param_name" => "thickness",
            "value" => "2",
            "min" => "1",
            "max" => "20",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'single'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Padding Top", "mk_framework"),
            "param_name" => "margin_top",
            "value" => "20",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("How much space would you like to have before divider? this value will be applied to top.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Padding Bottom", "mk_framework"),
            "param_name" => "margin_bottom",
            "value" => "20",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("How much space would you like to have after divider? this value will be applied to bottom.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )

    )
));






vc_map(array(
    "name" => __("Table", "mk_framework"),
    "base" => "mk_table",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-table vc_mk_element-icon',
    'description' => __( 'Adds styles to your data tables.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Table HTML content. You can use below sample and create your own data tables.", "mk_framework"),
            "param_name" => "content",
            "value" => '<table width="100%">
<thead>
<tr>
<th>Column 1</th>
<th>Column 2</th>
<th>Column 3</th>
<th>Column 4</th>
</tr>
</thead>
<tbody>
<tr>
<td>Item #1</td>
<td>Description</td>
<td>Subtotal:</td>
<td>$3.00</td>
</tr>
<tr>
<td>Item #2</td>
<td>Description</td>
<td>Discount:</td>
<td>$4.00</td>
</tr>
<tr>
<td>Item #3</td>
<td>Description</td>
<td>Shipping:</td>
<td>$7.00</td>
</tr>
<tr>
<td>Item #4</td>
<td>Description</td>
<td>Tax:</td>
<td>$6.00</td>
</tr>
<tr>
<td><strong>All Items</strong></td>
<td><strong>Description</strong></td>
<td><strong>Your Total:</strong></td>
<td><strong>$20.00</strong></td>
</tr>
</tbody>
</table>',
            "description" => __("Please paste your table html code here.", "mk_framework")
        ),


        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Skill Meter", "mk_framework"),
    "base" => "mk_skill_meter",
    'icon' => 'icon-mk-skill-meter vc_mk_element-icon',
    'description' => __( 'Show skills in bars by percent.', 'mk_framework' ),
    "params" => array(

        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework"),
            "param_name" => "title",
            "value" => "",
            "description" => __("What skill are you demonstrating?", "mk_framework")
        ),

        array(
            "type" => "range",
            "heading" => __("Percent", "mk_framework"),
            "param_name" => "percent",
            "value" => "50",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => '%',
            "description" => __("How many percent would you like to show from this skill?", "mk_framework")
        ),

        array(
            "type" => "range",
            "heading" => __("Progress Bar Height?", "mk_framework"),
            "param_name" => "height",
            "value" => "17",
            "min" => "5",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Title Color", "mk_framework"),
            "param_name" => "title_color",
            "value" => '#777',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Progress Bar Background Color", "mk_framework"),
            "param_name" => "progress_bar_color",
            "value" => $skin_color,
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Track Bar Background Color", "mk_framework"),
            "param_name" => "track_bar_color",
            "value" => '#eee',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )

    )
));




vc_map(array(
    "name" => __("Chart", "mk_framework"),
    "base" => "mk_chart",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-chart vc_mk_element-icon',
    'description' => __( 'Powerful & versatile Chart element.', 'mk_framework' ),
    "params" => array(

        array(
            "type" => "range",
            "heading" => __("Percent", "mk_framework"),
            "param_name" => "percent",
            "value" => "50",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => '%',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Bar Color", "mk_framework"),
            "param_name" => "bar_color",
            "value" => $skin_color,
            "description" => __("The color of the circular bar.", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Track Color", "mk_framework"),
            "param_name" => "track_color",
            "value" => "#fafafa",
            "description" => __("The color of the track for the bar.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Line Width", "mk_framework"),
            "param_name" => "line_width",
            "value" => "15",
            "min" => "1",
            "max" => "20",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Width of the bar line.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Bar Size", "mk_framework"),
            "param_name" => "bar_size",
            "value" => "170",
            "min" => "1",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("The Diameter of the bar.", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Content", "mk_framework"),
            "param_name" => "content_type",
            "width" => 200,
            "value" => array(
                "Percent" => "percent",
                "Icon" => "icon",
                "Custom Text" => "custom_text"
            ),
            "description" => __("The content inside the bar. If you choose icon, you should select your icon from below list. if you have selected custom text, then you should fill out the 'custom text' option below.", "mk_framework")
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Icon Size", "mk_framework"),
            "param_name" => "icon_size",
            "width" => 200,
            "value" => array(
                "Small (16px)" => "16px",
                "Medium (32px)" => "32px",
                "Large (64px)" => "64px",
                "X Large (128px)" => "128px"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "content_type",
                'value' => array(
                    'icon'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Font Size?", "mk_framework"),
            "param_name" => "font_size",
            "value" => "18",
            "min" => "15",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "content_type",
                'value' => array(
                    'custom_text',
                    'percent'
                )
            )
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Font Weight", "mk_framework"),
            "param_name" => "font_weight",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Semi Bold', "mk_framework") => "600",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Normal', "mk_framework") => "normal",
                __('Light', "mk_framework") => "300"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "content_type",
                'value' => array(
                    'custom_text',
                    'percent'
                )
            )
        ),

        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework"),
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework"),
            "dependency" => array(
                'element' => "content_type",
                'value' => array(
                    'icon'
                )
            )
        ),

        array(
            "type" => "textfield",
            "heading" => __("Custom Text", "mk_framework"),
            "param_name" => "custom_text",
            "value" => "",
            "description" => __("Description will appear below each chart.", "mk_framework"),
            "dependency" => array(
                'element' => "content_type",
                'value' => array(
                    'custom_text'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Description", "mk_framework"),
            "param_name" => "desc",
            "value" => "",
            "description" => __("Description will appear below each chart.", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Description Color", "mk_framework"),
            "param_name" => "desc_color",
            "value" => "",
            "description" => __("The color of the description.", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework"),
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )

    )
));




vc_map(array(
    "name" => __("Padding Divider", "mk_framework"),
    "base" => "mk_padding_divider",
   'icon' => 'icon-mk-padding-space vc_mk_element-icon',
    "category" => __('General', 'mk_framework'),
    'description' => __( 'Adds space between elements', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "range",
            "heading" => __("Padding Size (Px)", "mk_framework"),
            "param_name" => "size",
            "value" => "40",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("How much space would you like to drop in this specific padding shortcode?", "mk_framework")
        ),
        $add_device_visibility
    )
));

vc_map(array(
    "name" => __("Animated Columns", "mk_framework"),
    "base" => "mk_animated_columns",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-animated-columns vc_mk_element-icon',
    'description' => __( 'Columns with cool animations.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "range",
            "heading" => __("Column Height", "mk_framework"),
            "param_name" => "column_height",
            "value" => "500",
            "min" => "100",
            "max" => "1200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Set the columns height", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("How many Columns in One Row?", "mk_framework"),
            "param_name" => "column_number",
            "value" => "4",
            "min" => "1",
            "max" => "8",
            "step" => "1",
            "unit" => 'columns',
            "description" => __("How many columns would you like to show in one row?", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Item Spacing", "mk_framework"),
            "param_name" => "item_spacing",
            "value" => "0",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Space between items.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework"),
            "param_name" => "item_margin_bottom",
            "value" => "0",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "multiselect",
            "heading" => __("Choose the Animated Columns", "mk_framework"),
            "param_name" => "columns",
            "value" => '',
            "options" => $animated_columns,
            "description" => __("", "mk_framework")
        ),

        array(
            "heading" => __("Order", 'mk_framework'),
            "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework'),
            "param_name" => "order",
            "value" => array(
                __("DESC (descending order)", 'mk_framework') => "DESC",
                __("ASC (ascending order)", 'mk_framework') => "ASC"
            ),
            "type" => "dropdown"
        ),
        array(
            "heading" => __("Orderby", 'mk_framework'),
            "description" => __("Sort retrieved pricing items by parameter.", 'mk_framework'),
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Column Styles", "mk_framework"),
            "param_name" => "style",
            "value" => array(
                "Simple Icon (Icon+Title)" => "simple",
                "Simple Text (Text+Title)" => "simple_text",
                "Full Featured (All)" => "full",
            ),
            "description" => __("Please choose your columns styles. In each style the feeding content and hover scenarios will be different.", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Cover Whole with Link?", "mk_framework"),
            "param_name" => "cover_link",
            "value" => "false",
            "description" => __("If you wish the whole area to be covered with a link, enable this option.", "mk_framework"),
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Columns Border Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "#ccc",
            "description" => __("The column box color.", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Columns Hover Border Color", "mk_framework"),
            "param_name" => "border_hover_color",
            "value" => "#ccc",
            "description" => __("The column box color.", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Columns background Color", "mk_framework"),
            "param_name" => "bg_color",
            "value" => "#fff",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Columns background Hover Color", "mk_framework"),
            "param_name" => "bg_hover_color",
            "value" => "#333333",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Icon Size", "mk_framework"),
            "param_name" => "icon_size",
            "value" => array(
                __('16px', "mk_framework") => "16",
                __('32px', "mk_framework") => "32",
                __('48px', "mk_framework") => "48",
                __('64px', "mk_framework") => "64",
                __('128px', "mk_framework") => "128"
            ),
            "description" => __("Choose the icon sizes.", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Icon / Text Color", "mk_framework"),
            "param_name" => "icon_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Icon / Text Hover Color", "mk_framework"),
            "param_name" => "icon_hover_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Text Color (Active)", "mk_framework"),
            "param_name" => "txt_color",
            "value" => "#444",
            "description" => __("This color will be used for title and description normal color. Description will have 70% opacity.", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Text Color (Hover)", "mk_framework"),
            "param_name" => "txt_hover_color",
            "value" => "#fff",
            "description" => __("This color will be used for title and description hover color.", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Button Color (Active)", "mk_framework"),
            "param_name" => "btn_color",
            "value" => "#444",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Button Color (Hover)", "mk_framework"),
            "param_name" => "btn_hover_color",
            "value" => "#fff",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework"),
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )

    )
));



vc_map(array(
    "name" => __("Milestones", "mk_framework"),
    "base" => "mk_milestone",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-milestone vc_mk_element-icon',
    'description' => __( 'Milestone numbers to show statistics.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Milestones Style?", "mk_framework"),
            "param_name" => "style",
            "width" => 200,
            "value" => array(
                "Classic" => "classic",
                "Modern" => "modern"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Number Start at", "mk_framework"),
            "param_name" => "start",
            "value" => "0",
            "min" => "0",
            "max" => "100000",
            "step" => "1",
            "unit" => '',
            "description" => __("Please choose in which number it should start.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Number Stop at", "mk_framework"),
            "param_name" => "stop",
            "value" => "100",
            "min" => "0",
            "max" => "100000",
            "step" => "1",
            "unit" => '',
            "description" => __("Please choose in which number it should Stop.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Speed", "mk_framework"),
            "param_name" => "speed",
            "value" => "2000",
            "min" => "0",
            "max" => "10000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("Speed of the animation from start to stop in milliseconds.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Number Text Size", "mk_framework"),
            "param_name" => "number_size",
            "value" => "46",
            "min" => "10",
            "max" => "60",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Content Below Numbers?", "mk_framework"),
            "param_name" => "type",
            "width" => 200,
            "value" => array(
                "Icon" => "icon",
                "Text" => "text",
                "No Content" => "none"
            ),
            "description" => __("Using icon or text would you prefer to represent this milestone?", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework"),
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework"),
             "dependency" => array(
                'element' => "type",
                'value' => array(
                    'icon'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Icon Size?", "mk_framework"),
            "param_name" => "icon_size",
            "width" => 200,
            "value" => array(
                __('16px', "mk_framework") => "16",
                __('32px', "mk_framework") => "32",
                __('48px', "mk_framework") => "48",
                __('64px', "mk_framework") => "64",
                __('128px', "mk_framework") => "128"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "type",
                'value' => array(
                    'icon'
                )
            )
        ),

        array(
            "type" => "textfield",
            "heading" => __("Text Below Numbers", "mk_framework"),
            "param_name" => "text",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "type",
                'value' => array(
                    'text'
                )
            )
        ),

        array(
            "type" => "textfield",
            "heading" => __("Number Suffix", "mk_framework"),
            "param_name" => "text_suffix",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'modern'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Number Suffix Text Size", "mk_framework"),
            "param_name" => "number_suffix_text_size",
            "value" => "12",
            "min" => "10",
            "max" => "60",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'modern'
                )
            )
        ),

        array(
            "type" => "range",
            "heading" => __("Text Size", "mk_framework"),
            "param_name" => "text_size",
            "value" => "12",
            "min" => "10",
            "max" => "60",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "type",
                'value' => array(
                    'text'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Skin color", "mk_framework"),
            "param_name" => "color",
            "value" => "#919191",
            "description" => __("", "mk_framework")
        ),

         array(
            "type" => "colorpicker",
            "heading" => __("Border Bottom color", "mk_framework"),
            "param_name" => "border_bottom",
            "value" => "#eee",
            "description" => __("", "mk_framework"),
             "dependency" => array(
                'element' => "style",
                'value' => array(
                    'classic'
                )
            )
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Text/Icon Color", "mk_framework"),
            "param_name" => "text_icon_color",
            "value" => "",
            "description" => __("", "mk_framework"),
        ),

        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )

    )
));


vc_map(array(
    "name" => __("Audio Player", "mk_framework"),
    "base" => "mk_audio",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-audio-player vc_mk_element-icon',
    'description' => __( 'Adds player to your audio files.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Audio Title", "mk_framework"),
            "param_name" => "file_title",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "upload",
            "heading" => __("Upload MP3 file format", "mk_framework"),
            "param_name" => "mp3_file",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "upload",
            "heading" => __("Upload OGG file format", "mk_framework"),
            "param_name" => "ogg_file",
            "value" => "",
            "description" => __("", "mk_framework")
        ),


        array(
            "type" => "toggle",
            "heading" => __("For small container?", "mk_framework"),
            "param_name" => "small_version",
            "value" => "false",
            "description" => __("If you want to use this player in a small container enable this option. This option will force player controls to below progress bar.", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));





vc_map(array(
    "name" => __("Process Steps", "mk_framework"),
    "base" => "mk_process_steps",
    "as_parent" => array('only' => 'mk_step'),
    "content_element" => true,
    'icon' => 'icon-mk-process-builder vc_mk_element-icon',
    'description' => __( 'Adds process steps element.', 'mk_framework' ),
    "category" => __('Content', 'mk_framework'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Orientation", "mk_framework"),
            "param_name" => "orientation",
            "value" => array(
                "Vertical" => "vertical",
                "Horizontal" => "horizontal"

            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Skin", "mk_framework"),
            "param_name" => "skin",
            "value" => array(
                "dark" => "dark",
                "Light" => "light",
                "Custom" => "custom"

            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color?", "mk_framework"),
            "param_name" => "background_color",
            "value" => "#fff",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Border Color?", "mk_framework"),
            "param_name" => "border_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Color?", "mk_framework"),
            "param_name" => "icon_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Hover Color?", "mk_framework"),
            "param_name" => "icon_hover_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Title Color?", "mk_framework"),
            "param_name" => "title_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Description Color?", "mk_framework"),
            "param_name" => "description_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    ),
 "js_view" => 'VcColumnView'
));



vc_map(array(
    "name" => __("Step", "mk_framework"),
    "base" => "mk_step",
    "content_element" => true,
    "as_child" => array('only' => 'mk_process_steps'),
    "is_container" => true,
    'icon' => 'icon-mk-process-builder vc_mk_element-icon',
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework"),
            "param_name" => "title",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "range",
            "heading" => __("Title Font Size?", "mk_framework"),
            "param_name" => "font_size",
            "value" => "16",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "range",
            "heading" => __("Title Line Height?", "mk_framework"),
            "param_name" => "line_height",
            "value" => "16",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "range",
            "heading" => __("Title Margin Bottom?", "mk_framework"),
            "param_name" => "margin_bottom",
            "value" => "10",
            "min" => "5",
            "max" => "25",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Title Font Weight", "mk_framework"),
            "param_name" => "font_weight",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Semi Bold', "mk_framework") => "600",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Normal', "mk_framework") => "normal",
                __('Light', "mk_framework") => "300"
            ),
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "textarea",
            "heading" => __("Short Description", "mk_framework"),
            "param_name" => "desc",
            "description" => __("", "mk_framework")
        ),


        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework"),
            "param_name" => "icon",
            "value" => "mk-li-smile",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework"),
        ),
    ),
    "js_view" => 'VcColumnView'
));




vc_map(array(
    "name" => __("Icon Text", "mk_framework"),
    "base" => "mk_icon_text",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-icon-box vc_mk_element-icon',
    'description' => __( 'Powerful & versatile Icon Text.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Skin", "mk_framework"),
            "param_name" => "skin",
            "width" => 300,
            "value" => array(
                __('Dark', "mk_framework") => "dark",
                __('Light', "mk_framework") => "light",
                __('Custom', "mk_framework") => "custom"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Custom Color?", "mk_framework"),
            "param_name" => "custom_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Default Text", "mk_framework"),
            "param_name" => "default_txt",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Default Text Font Weight", "mk_framework"),
            "param_name" => "default_txt_font_weight",
            "width" => 200,
            "default" => 'bold',
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Light', "mk_framework") => "300",
                __('Normal', "mk_framework") => "normal",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Extra Bold', "mk_framework") => "900",
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Default Text Font Size?", "mk_framework"),
            "param_name" => "font_size",
            "value" => "30",
            "min" => "15",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
        ),

        array(
            "type" => "textfield",
            "heading" => __("On Hover Text", "mk_framework"),
            "param_name" => "hover_txt",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "heading" => __("On Hover Text Font Size", "mk_framework"),
            "param_name" => "hover_font_size",
            "value" => "16",
            "min" => "15",
            "max" => "30",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "heading" => __("On Hover Text Line Height", "mk_framework"),
            "param_name" => "hover_line_height",
            "value" => "18",
            "min" => "15",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "type" => "dropdown",
            "heading" => __("On Hover Text Font Weight", "mk_framework"),
            "param_name" => "hover_txt_font_weight",
            "width" => 200,
            "default" => 'bold',
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Light', "mk_framework") => "300",
                __('Normal', "mk_framework") => "normal",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Extra Bold', "mk_framework") => "900",
            ),
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Link (optional)", "mk_framework"),
            "param_name" => "link",
            "value" => "",
            "description" => __("Will convert the icon to a link.", "mk_framework")
        ),
         array(
            "type" => "dropdown",
            "heading" => __("Link Target", "mk_framework"),
            "param_name" => "target",
            "width" => 200,
            "value" => $target_arr,
            "description" => __("", "mk_framework")
        ),


        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework"),
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework"),
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Icon Size", "mk_framework"),
            "param_name" => "icon_size",
            "width" => 300,
            "value" => array(
                __('48px', "mk_framework") => "48",
                __('64px', "mk_framework") => "64",
                __('128px', "mk_framework") => "128"
            ),
            "description" => __("", "mk_framework")
        ),


        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework"),
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Secondary Header", "mk_framework"),
    "base" => "mk_header",
    "category" => __('General', 'mk_framework'),
    "params" => array(

        array(
            "type" => "dropdown",
            "heading" => __("Menu Location", "mk_framework"),
            "param_name" => "menu_location",
            "width" => 150,
            "value" => array(
                __('Primary Navigation', "mk_framework") => "primary-menu",
                __('Second Navigation', "mk_framework") => "second-menu",
                __('Third Navigation', "mk_framework") => "third-menu",
                __('Fourth Navigation', "mk_framework") => "fourth-menu",
                __('Fifth Navigation', "mk_framework") => "fifth-menu",
                __('Sixth Navigation', "mk_framework") => "sixth-menu",
                __('Seventh Navigation', "mk_framework") => "seventh-menu"
            ),

            "description" => __("Please choose which menu location you would like to assign to this header.", "mk_framework")
        ),
         array(
            "type" => "toggle",
            "heading" => __("Squeeze Header?", "mk_framework"),
            "param_name" => "squeeze",
            "value" => "true",
            "description" => __("If you disable this option header height will be in normal height rather than being in sticky state.", "mk_framework")
        ),

         array(
            "type" => "toggle",
            "heading" => __("Header Logo?", "mk_framework"),
            "param_name" => "show_logo",
            "value" => "true",
            "description" => __("If you dont want to show logo in secondary header, disable this option.", "mk_framework")
        ),
         array(
            "type" => "toggle",
            "heading" => __("Header Search Icon?", "mk_framework"),
            "param_name" => "show_search",
            "value" => "true",
            "description" => __("If you dont want to show search icon in secondary header, disable this option.", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Header Cart?", "mk_framework"),
            "param_name" => "show_cart",
            "value" => "true",
            "description" => __("If you dont want to show cart section in secondary header, disable this option.", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Header Wpml?", "mk_framework"),
            "param_name" => "show_wpml",
            "value" => "true",
            "description" => __("If you dont want to show wpml section in secondary header, disable this option.", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Header Border Top?", "mk_framework"),
            "param_name" => "show_border",
            "value" => "true",
            "description" => __("If you dont want to show border top in secondary header, disable this option.", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Header Dashboard Trigger Icon?", "mk_framework"),
            "param_name" => "show_dashboard_trigger",
            "value" => "true",
            "description" => __("If you dont want to show dashboard trigger icon, disable this option.", "mk_framework")
        ),
         array(
            "type" => "dropdown",
            "heading" => __("Header Align", "mk_framework"),
            "param_name" => "align",
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Center', "mk_framework") => "center",
                __('Right', "mk_framework") => "right",
            ),

            "description" => __("", "mk_framework")
        ),
         array(
            "type" => "dropdown",
            "heading" => __("Header Wideness", "mk_framework"),
            "param_name" => "wideness",
            "value" => array(
                __('Boxed Layout', "mk_framework") => "boxed",
                __('Screen Wide Full', "mk_framework") => "full",
            ),

            "description" => __("", "mk_framework")
        ),
          array(
            "heading" => __("Header Custom Height", "mk_framework"),
            "param_name" => "custom_header_height",
            "value" => "0",
            "min" => "0",
            "max" => "300",
            "step" => "1",
            "unit" => 'px',
            "description" => __("If you want to inherit from default value you have for regular menu set the option value to zero. Its recommended to use this option when you disable logo for this header.", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color?", "mk_framework"),
            "param_name" => "background_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "group" => "Styling Settings",
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Link Color?", "mk_framework"),
            "param_name" => "link_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "group" => "Styling Settings",
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Link Hover Color?", "mk_framework"),
            "param_name" => "link_hover_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "group" => "Styling Settings",
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Border Top Color?", "mk_framework"),
            "param_name" => "border_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "group" => "Styling Settings",
        ),
        array(
            "heading" => __("Main Navigation Top Level Font Size", "mk_framework"),
            "param_name" => "top_level_item_size",
            "value" => "0",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("If you want to inherit from default value you set it for main header set the value to zero.", "mk_framework"),
            'type' => 'range',
            "group" => "Styling Settings",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        ),


    )
));


vc_map(array(
    "name" => __("Event Countdown", "mk_framework"),
    "base" => "mk_countdown",
    "category" => __('General', 'mk_framework'),
    'icon' => 'icon-mk-event-countdown vc_mk_element-icon',
    'description' => __( 'Countdown module for your events.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Upcoming Event Date", "mk_framework"),
            "param_name" => "date",
            "value" => "",
            "description" => __("Please fill this field with expect date. eg : 12/24/2016 12:00:00 => month/day/year hour:minute:second", "mk_framework")
        ),

        array(
            "heading" => __("UTC Timezone", "mk_framework"),
            "param_name" => "offset",
            "value" => array(
                "-12" => "-12",
                "-11" => "-11",
                "-10" => "-10",
                "-9" => "-9",
                "-8" => "-8",
                "-7" => "-7",
                "-6" => "-6",
                "-5" => "-5",
                "-4" => "-4",
                "-3" => "-3",
                "-2" => "-2",
                "-1" => "-1",
                "0" => "0",
                "+1" => "+1",
                "+2" => "+2",
                "+3" => "+3",
                "+4" => "+4",
                "+5" => "+5",
                "+6" => "+6",
                "+7" => "+7",
                "+8" => "+8",
                "+9" => "+9",
                "+10" => "+10",
                "+12" => "+12"
            ),
            "type" => "dropdown"
        ),


        array(
            "heading" => __("Skin", "mk_framework"),
            "param_name" => "skin",
            "value" => array(
                __("Dark", "mk_framework") => 'dark',
                __("Light", "mk_framework") => 'light',
                __("Accent Color", "mk_framework") => 'accent',
                __("Custom", "mk_framework") => 'custom'
            ),
            "type" => "dropdown"
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Custom Color?", "mk_framework"),
            "param_name" => "custom_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),


        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));



vc_map(array(
    "name" => __("Widgetized Sidebar", "mk_framework"),
    "base" => "mk_custom_sidebar",
    'icon' => 'icon-mk-custom-sidebar vc_mk_element-icon',
    'description' => __( 'Place Widgetized sidebar', 'mk_framework' ),
    "category" => __('Structure', 'mk_framework'),
    "params" => array(
        array(
          'type' => 'widgetised_sidebars',
          'heading' => __( 'Sidebar', 'mk_framework' ),
          'param_name' => 'sidebar',
          'description' => __( 'Select the widget area to be shown in this sidebar.', 'mk_framework' )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Flip Box", "mk_framework"),
    "base" => "mk_flipbox",
    'icon' => 'icon-mk-tab-slider vc_mk_element-icon',
    "category" => __('General', 'mk_framework'),
    'description' => __( 'Flip based boxes.', 'mk_framework' ),
    'params' => array(
        array(
            "type" => "dropdown",
            "heading" => __("Flip Direction", "mk_framework"),
            "param_name" => "flip_direction",
            "width" => 300,
            "value" => array(
                __('Horizontal', "mk_framework") => "horizontal",
                __('Vertical', "mk_framework") => "vertical"
            ),
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Front Background Color", "mk_framework"),
            "param_name" => "front_background_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Back Background Color", "mk_framework"),
            "param_name" => "back_background_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Front Side Opacity?", "mk_framework"),
            "param_name" => "front_opacity",
            "value" => "1",
            "min" => "0.1",
            "max" => "1",
            "step" => "0.1",
            "unit" => 'alpha',
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "range",
            "heading" => __("Back Side Opacity?", "mk_framework"),
            "param_name" => "back_opacity",
            "value" => "1",
            "min" => "0.1",
            "max" => "1",
            "step" => "0.1",
            "unit" => 'alpha',
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Front Aligment", "mk_framework"),
            "param_name" => "front_align",
            "width" => 200,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Center', "mk_framework") => "center",
                __('Right', "mk_framework") => "right"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Back Aligment", "mk_framework"),
            "param_name" => "back_align",
            "width" => 200,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Center', "mk_framework") => "center",
                __('Right', "mk_framework") => "right"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Front Vertical Aligment", "mk_framework"),
            "param_name" => "front_vertical_align",
            "width" => 200,
            "value" => array(
                __('Middle', "mk_framework") => "middle",
                __('Top', "mk_framework") => "top",
                __('Bottom', "mk_framework") => "bottom"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Back Vertical Aligment", "mk_framework"),
            "param_name" => "back_vertical_align",
            "width" => 200,
            "value" => array(
                __('Middle', "mk_framework") => "middle",
                __('Top', "mk_framework") => "top",
                __('Bottom', "mk_framework") => "bottom"
            ),
            "description" => __("", "mk_framework")
        ),

        array(
            "heading" => __("Minimum Height", "mk_framework"),
            "param_name" => "min_height",
            "value" => "300",
            "min" => "250",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "heading" => __("Max Width", "mk_framework"),
            "param_name" => "max_width",
            "value" => "500",
            "min" => "250",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "heading" => __("Left / Right Padding", "mk_framework"),
            "param_name" => "box_padding",
            "value" => "20",
            "min" => "10",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "type" => "toggle",
            "heading" => __('Border Radius?', 'mk_framework'),
            "description" => __("", "mk_framework"),
            "param_name" => "box_radius",
            "value" => "false"
        ),

        array(
            "type" => "textfield",
            "heading" => __("Front Title", "mk_framework"),
            "param_name" => "front_title",
            "value" => "",
            "description" => __("", "mk_framework"),
        ),
        array(
            "heading" => __("Front Title Font Size", "mk_framework"),
            "param_name" => "front_title_size",
            "value" => "20",
            "min" => "15",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Front Title Font Weight", "mk_framework"),
            "param_name" => "front_title_font_weight",
            "width" => 200,
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Light', "mk_framework") => "300",
                __('Normal', "mk_framework") => "normal",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Extra Bold', "mk_framework") => "900",
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Front Title Font Color", "mk_framework"),
            "param_name" => "front_title_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "textarea",
            "heading" => __("Front Description", "mk_framework"),
            "param_name" => "front_desc",
            "value" => "",
            "description" => __("", "mk_framework"),
        ),
        array(
            "heading" => __("Front Description Font Size", "mk_framework"),
            "param_name" => "front_desc_size",
            "value" => "20",
            "min" => "15",
            "max" => "30",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "heading" => __("Front Description Line Height", "mk_framework"),
            "param_name" => "front_desc_line_height",
            "value" => "26",
            "min" => "15",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Front Description Font Color", "mk_framework"),
            "param_name" => "front_desc_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Back Title", "mk_framework"),
            "param_name" => "back_title",
            "value" => "",
            "description" => __("", "mk_framework"),
        ),
        array(
            "heading" => __("Back Title Font Size", "mk_framework"),
            "param_name" => "back_title_size",
            "value" => "20",
            "min" => "15",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Back Title Font Color", "mk_framework"),
            "param_name" => "back_title_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Back Title Font Weight", "mk_framework"),
            "param_name" => "back_title_font_weight",
            "width" => 200,
            "value" => array(
                 __('Default', "mk_framework") => "inherit",
                __('Light', "mk_framework") => "300",
                __('Normal', "mk_framework") => "normal",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Extra Bold', "mk_framework") => "900",
            ),
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "textarea",
            "heading" => __("Back Description", "mk_framework"),
            "param_name" => "back_desc",
            "value" => "",
            "description" => __("", "mk_framework"),
        ),
        array(
            "heading" => __("Back Description Font Size", "mk_framework"),
            "param_name" => "back_desc_size",
            "value" => "20",
            "min" => "15",
            "max" => "30",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "heading" => __("Back Description Line Height", "mk_framework"),
            "param_name" => "back_desc_line_height",
            "value" => "26",
            "min" => "15",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Back Description Font Color", "mk_framework"),
            "param_name" => "back_desc_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Button Text", "mk_framework"),
            "param_name" => "button_text",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Button Url", "mk_framework"),
            "param_name" => "button_url",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "heading" => __("Button Size", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "button_size",
            "value" => array(
                __("Medium", 'mk_framework') => "medium",
                __("Small", 'mk_framework') => "small",
                __("Large", 'mk_framework') => "large"
            ),
            "type" => "dropdown"
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Button Corner Style", "mk_framework"),
            "param_name" => "button_corner_style",
            "value" => array(
                "Pointed" => "pointed",
                "Rounded" => "rounded",
                "Full Rounded" => "full_rounded"
            ),
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Button Skin Color", "mk_framework"),
            "param_name" => "btn_skin_1",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Button Hover Color", "mk_framework"),
            "param_name" => "btn_skin_2",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "heading" => __("Button Alignment", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "btn_alignment",
            "value" => array(
                __("Left", 'mk_framework') => "left",
                __("Center", 'mk_framework') => "center",
                __("Right", 'mk_framework') => "right"
            ),
            "type" => "dropdown"
        ),

        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));
