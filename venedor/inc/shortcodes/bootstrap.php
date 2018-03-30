<?php

// Register Easy Bootstrap Shortcodes in Visual Composer Editor / Venedor Category
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_bootstrap() {

        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        // Row / Column
        $vc_icon = venedor_vc_icon().'bs_columns.png';

        vc_map( array(
            "name" => "Row",
            "base" => "row",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'column'),
            "params" => array(
                $custom_class
            )
        ) );

        $vc_icon = venedor_vc_icon().'bs_columns.png';

        vc_map( array(
            "name" => "Column",
            "base" => "column",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_child" => array('only' => 'row'),
            "params" => array(
                array(
                    "type" => "label",
                    "heading" => "Large Screen (window width >= 1200)",
                    "param_name" => "label"
                ),
                array(
                    "type" => "yes_no",
                    "heading" => "Hide",
                    "param_name" => "lghide",
                    "value" => "no"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Columns",
                    "param_name" => "lg",
                    "value" => "12",
                    "admin_label" => true
                ),
                array(
                    "type" => "yes_no",
                    "heading" => "Clear Left",
                    "param_name" => "lgclear",
                    "value" => "no"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Offset",
                    "param_name" => "lgoffset",
                    "value" => "0",
                    "admin_label" => true
                ),
                array(
                    "type" => "label",
                    "heading" => "Medium Screen (992 <= window width < 1200)",
                    "param_name" => "label"
                ),
                array(
                    "type" => "yes_no",
                    "heading" => "Hide",
                    "param_name" => "mdhide",
                    "value" => "no"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Columns",
                    "param_name" => "md",
                    "value" => "12",
                    "admin_label" => true
                ),
                array(
                    "type" => "yes_no",
                    "heading" => "Clear Left",
                    "param_name" => "mdclear",
                    "value" => "no"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Offset",
                    "param_name" => "mdoffset",
                    "value" => "0",
                    "admin_label" => true
                ),
                array(
                    "type" => "label",
                    "heading" => "Small Screen (768 <= window width < 991)",
                    "param_name" => "label"
                ),
                array(
                    "type" => "yes_no",
                    "heading" => "Hide",
                    "param_name" => "smhide",
                    "value" => "no"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Columns",
                    "param_name" => "sm",
                    "value" => "12",
                    "admin_label" => true
                ),
                array(
                    "type" => "yes_no",
                    "heading" => "Clear Left",
                    "param_name" => "smclear",
                    "value" => "no"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Offset",
                    "param_name" => "smoffset",
                    "value" => "0",
                    "admin_label" => true
                ),
                array(
                    "type" => "label",
                    "heading" => "X-small Screen (480 <= window width < 768)",
                    "param_name" => "label"
                ),
                array(
                    "type" => "yes_no",
                    "heading" => "Hide",
                    "param_name" => "xshide",
                    "value" => "no"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Columns",
                    "param_name" => "xs",
                    "value" => "12",
                    "admin_label" => true
                ),
                array(
                    "type" => "yes_no",
                    "heading" => "Clear Left",
                    "param_name" => "xsclear",
                    "value" => "no"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Offset",
                    "param_name" => "xsoffset",
                    "value" => "0",
                    "admin_label" => true
                )
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Row extends WPBakeryShortCodesContainer {
            }

            class WPBakeryShortCode_Column extends WPBakeryShortCodesContainer {
            }
        }

        // Toggles/Accordion
        $vc_icon = venedor_vc_icon().'bs_toggles.png';

        vc_map( array(
            "name" => "Toggles/Accordions",
            "base" => "toggles",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'toggle'),
            "params" => array(
                $custom_class
            )
        ) );

        $vc_icon = venedor_vc_icon().'bs_toggles.png';

        vc_map( array(
            "name" => "Toggle/Accordion",
            "base" => "toggle",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_child" => array('only' => 'toggles'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Toggles extends WPBakeryShortCodesContainer {
            }

            class WPBakeryShortCode_Toggle extends WPBakeryShortCodesContainer {
            }
        }

        // Tabs
        $vc_icon = venedor_vc_icon().'bs_tabs.png';

        vc_map( array(
            "name" => "Tabs",
            "base" => "tabs",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'tab'),
            "params" => array(
                $custom_class
            )
        ) );

        $vc_icon = venedor_vc_icon().'bs_tabs.png';

        vc_map( array(
            "name" => "Tab",
            "base" => "tab",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_child" => array('only' => 'toggles'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Active",
                    'param_name' => 'active',
                    'value' => array("" => '', "Active" => "active"),
                    "admin_label" => true
                )
            )
        ));

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Tabs extends WPBakeryShortCodesContainer {
            }

            class WPBakeryShortCode_Tab extends WPBakeryShortCodesContainer {
            }
        }

        // Progressbar
        $vc_icon = venedor_vc_icon().'bs_progressbar.png';

        vc_map( array(
            "name" => "Progress Bar",
            "base" => "progressbar",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    'type' => 'dropdown',
                    'heading' => "Bar Type",
                    'param_name' => 'bartype',
                    'value' => array("" => "", "Success" => "progress-bar-success", "Info" => "progress-bar-info", "Warning" => "progress-bar-warning", "Danger" =>"progress-bar-danger")
                ),
                array(
                    'type' => 'textfield',
                    'heading' => "Label",
                    'param_name' => 'label',
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Value",
                    "param_name" => "value",
                    "value" => "50",
                    "admin_label" => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Bar Style",
                    'param_name' => 'barstyle',
                    'value' => array("" => "", "Striped" => "progress-striped", "Striped and Active" => "progress-striped active")
                ),
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Progressbar extends WPBakeryShortCodes {
            }
        }
    }
}

