<?php
vc_map(array(
    "name" => __("Advanced Google Maps", "mk_framework"),
    "base" => "mk_advanced_gmaps",
    'icon' => 'icon-mk-advanced-google-maps vc_mk_element-icon',
    "admin_enqueue_js" => THEME_COMPONENTS . "/shortcodes/mk_advanced_gmaps/vc_admin.js",
    "admin_enqueue_css" => THEME_COMPONENTS . "/shortcodes/mk_advanced_gmaps/vc_admin.css",
    'description' => __( 'Powerful Google Maps element.', 'mk_framework' ),
    "category" => __('Social', 'mk_framework'),
    "params" => array(

        array(
            "type" => "toggle",
            "heading" => __("Custom markers?", "mk_framework"),
            "param_name" => "custom_markers",
            "value" => "false",
            "description" => __("Add custom markers per address.", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Address 1 : Latitude", "mk_framework"),
            "param_name" => "latitude",
            "value" => "",
            "description" => __('Example : 40.748829', "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address 1 : Longitude", "mk_framework"),
            "param_name" => "longitude",
            "value" => "",
            "description" => __('Example : -73.984118', "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address 1 : Full Address Text (shown in tooltip)", "mk_framework"),
            "param_name" => "address",
            "value" => "",
            "description" => __('', "mk_framework")
        ),
        array(
            "type" => "upload",
            "heading" => __("Upload Marker Icon for address 1", "mk_framework"),
            "param_name" => "custom_marker_1",
            "value" => "",
            "description" => __("If left blank it will fall back to a default shared marker that you can set below.", "mk_framework"),
            "dependency" => array(
                'element' => "custom_markers",
                'value' => array(
                    'true'
                )
            )
        ),

        array(
            "type" => "textfield",
            "heading" => __("Address 2 : Latitude", "mk_framework"),
            "param_name" => "latitude_2",
            "value" => "",
            "description" => __('', "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address 2 : Longitude", "mk_framework"),
            "param_name" => "longitude_2",
            "value" => "",
            "description" => __('', "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address 2 : Full Address Text (shown in tooltip)", "mk_framework"),
            "param_name" => "address_2",
            "value" => "",
            "description" => __('', "mk_framework")
        ),
        array(
            "type" => "upload",
            "heading" => __("Upload Marker Icon for address 2", "mk_framework"),
            "param_name" => "custom_marker_2",
            "value" => "",
            "description" => __("If left blank it will fall back to a default shared marker that you can set below.", "mk_framework"),
            "dependency" => array(
                'element' => "custom_markers",
                'value' => array(
                    'true'
                )
            )
        ),



        array(
            "type" => "textfield",
            "heading" => __("Address 3 : Latitude", "mk_framework"),
            "param_name" => "latitude_3",
            "value" => "",
            "description" => __('', "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address 3 : Longitude", "mk_framework"),
            "param_name" => "longitude_3",
            "value" => "",
            "description" => __('', "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address 3 : Full Address Text (shown in tooltip)", "mk_framework"),
            "param_name" => "address_3",
            "value" => "",
            "description" => __('', "mk_framework")
        ),
        array(
            "type" => "upload",
            "heading" => __("Upload Marker Icon for address 3", "mk_framework"),
            "param_name" => "custom_marker_3",
            "value" => "",
            "description" => __("If left blank it will fall back to a default shared marker that you can set below.", "mk_framework"),
            "dependency" => array(
                'element' => "custom_markers",
                'value' => array(
                    'true'
                )
            )
        ),



        array(
            "type" => "upload",
            "heading" => __("Upload Default Marker Icon", "mk_framework"),
            "param_name" => "pin_icon",
            "value" => "",
            "description" => __("If left blank Google Default marker will be used.", "mk_framework")
        ),


        array(
            "type" => "gmap_marker",
            "heading" => __("Need More Address?", "mk_framework"),
            "param_name" => "additional_markers",
            "value" => "false",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Content Box Background Color", "mk_framework"),
            "param_name" => "content_bg_color",
            "value" => "#4f4f4f",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Content Box Font Color", "mk_framework"),
            "param_name" => "content_font_color",
            "value" => "#fff",
            "description" => __("", "mk_framework")
        ),

         array(
            "type" => "dropdown",
            "heading" => __("Map Height", "mk_framework"),
            "param_name" => "map_height",
            "value" => array(
                __("Custom (choose from below option)", "mk_framework") => "custom",
                __("Screen Height", "mk_framework") => "full",
            ),

        ),
         array(
            "type" => "range",
            "heading" => __("Custom Map Height", "mk_framework"),
            "param_name" => "height",
            "value" => "300",
            "min" => "1",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __('Enter map height in pixels. Example: 200).', "mk_framework"),
            "dependency" => array(
                'element' => "map_height",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Zoom", "mk_framework"),
            "param_name" => "map_zoom",
            "value" => "14",
            "min" => "1",
            "max" => "19",
            "step" => "1",
            "unit" => '',
            "description" => __('', "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Pan Control", "mk_framework"),
            "param_name" => "pan_control",
            "value" => "true",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Draggable", "mk_framework"),
            "param_name" => "draggable",
            "value" => "true",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Zoom Control", "mk_framework"),
            "param_name" => "zoom_control",
            "value" => "true",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Map Type", "mk_framework"),
            "param_name" => "map_type",
            "value" => array(
                __("ROADMAP (Displays a normal, default 2D map)", "mk_framework") => "ROADMAP",
                __("HYBRID (Displays a photographic map + roads and city names)", "mk_framework") => "HYBRID",
                __("SATELLITE (Displays a photographic map)", "mk_framework") => "SATELLITE",
                __("TERRAIN (Displays a map with mountains, rivers, etc.)", "mk_framework") => "TERRAIN"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Map Type Control", "mk_framework"),
            "param_name" => "map_type_control",
            "value" => "true",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Scale Control", "mk_framework"),
            "param_name" => "scale_control",
            "value" => "true",
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Custom Map Styles", "mk_framework"),
            "param_name" => "modify_json",
            "value" => array(
                __("No", "mk_framework") => "false",
                __("Yes", "mk_framework") => "true"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => __("JSON", "mk_framework"),
            "param_name" => "map_json",
            "holder" => 'div',
            "value" => "",
            "description" => __("Paste your code here", "mk_framework"),
            "dependency" => array(
                'element' => "modify_json",
                'value' => array(
                    'true'
                )
            )
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Modify Google Maps Hue, Saturation, Lightness", "mk_framework"),
            "param_name" => "modify_coloring",
            "value" => array(
                __("No", "mk_framework") => "false",
                __("Yes", "mk_framework") => "true"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "modify_json",
                'value' => array(
                    'false'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Hue", "mk_framework"),
            "param_name" => "hue",
            "value" => "#ccc",
            "description" => __("Sets the hue of the feature to match the hue of the color supplied. Note that the saturation and lightness of the feature is conserved, which means, the feature will not perfectly match the color supplied .", "mk_framework"),
            "dependency" => array(
                'element' => "modify_coloring",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Saturation", "mk_framework"),
            "param_name" => "saturation",
            "value" => "1",
            "min" => "-100",
            "max" => "100",
            "step" => "1",
            "unit" => '',
            "description" => __('Shifts the saturation of colors by a percentage of the original value if decreasing and a percentage of the remaining value if increasing. Valid values: [-100, 100].', "mk_framework"),
            "dependency" => array(
                'element' => "modify_coloring",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Lightness", "mk_framework"),
            "param_name" => "lightness",
            "value" => "1",
            "min" => "-100",
            "max" => "100",
            "step" => "1",
            "unit" => '',
            "description" => __('Shifts lightness of colors by a percentage of the original value if decreasing and a percentage of the remaining value if increasing. Valid values: [-100, 100].', "mk_framework"),
            "dependency" => array(
                'element' => "modify_coloring",
                'value' => array(
                    'true'
                )
            )
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