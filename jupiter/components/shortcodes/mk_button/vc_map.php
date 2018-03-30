<?php
vc_map(array(
    "name" => __("Button", "mk_framework") ,
    "base" => "mk_button",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-button vc_mk_element-icon',
    'description' => __('Powerful & versatile button shortcode', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "dimension",
            "value" => array(
                __("3D", "mk_framework") => "three",
                __("2D", "mk_framework") => "two",
                __("Flat", "mk_framework") => "flat",
                __("Outline", "mk_framework") => "outline",
                __("Savvy", "mk_framework") => "savvy",
                __("Double Outline ", "mk_framework") => "double-outline"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => __("Button Text", "mk_framework") ,
            "param_name" => "content",
            "rows" => 1,
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        
        //new added
        array(
            "type" => "dropdown",
            "heading" => __("Corner style", "mk_framework") ,
            "param_name" => "corner_style",
            "value" => array(
                "Pointed" => "pointed",
                "Rounded" => "rounded",
                "Full Rounded" => "full_rounded"
            ) ,
            "description" => __("How will your button corners look like?", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Size", "mk_framework") ,
            "param_name" => "size",
            "value" => array(
                "Small" => "small",
                "Medium" => "medium",
                "Large" => "large",
                "X-Large" => "x-large",
                "XX-Large" => "xx-large"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Button Text Letter spacing", "mk_framework") ,
            "param_name" => "letter_spacing",
            "value" => "0",
            "min" => "0",
            "max" => "20",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Using this option you can add space between each character.", "mk_framework"),
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Animate Icon?", "mk_framework") ,
            "param_name" => "icon_anim",
            "value" => array(
                __('No animation', "mk_framework") => "none",
                __('Side animation', "mk_framework") => "side",
                __('Vertical animation ', "mk_framework") => "vertical"
            ) ,
            "description" => __("Button icon animates once the user's mouse rolls over the button", "mk_framework") ,
            "dependency" => array(
                'element' => 'dimension',
                'value' => array(
                    'two',
                    'three',
                    'flat',
                    'outline'
                )
            )
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Button URL", "mk_framework") ,
            "param_name" => "url",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Target", "mk_framework") ,
            "param_name" => "target",
            "width" => 200,
            "value" => $target_arr,
            "description" => __("", "mk_framework")
        ) ,
         array(
            "type" => "toggle",
            "heading" => __("Add rel:nofollow to the Link?", "mk_framework") ,
            "param_name" => "nofollow",
            "value" => "false",
            "description" => __("Nofollow provides a way for you to tell search engines \"Don't follow this specific link.\". So you instruct search engines that the hyperlink should not influence the ranking of the link's target in the search engine's index.", "mk_framework") 
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework") ,
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center",
                __('None', "mk_framework") => "none",
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Full width button?", "mk_framework") ,
            "param_name" => "fullwidth",
            "value" => "false",
            "description" => __("Using this option you can make the button full width and cover one row.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Custom Button Width", "mk_framework") ,
            "param_name" => "button_custom_width",
            "value" => "0",
            "min" => "0",
            "max" => "1500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "fullwidth",
                'value' => array(
                    'false',
                )
            )
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Button ID", "mk_framework") ,
            "param_name" => "id",
            "value" => "",
            "description" => __("If your want to use id for this button to refer it in your custom JS, fill this textbox.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Top", "mk_framework") ,
            "param_name" => "margin_top",
            "value" => "0",
            "min" => "-30",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework") ,
            "param_name" => "margin_bottom",
            "value" => "15",
            "min" => "-30",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Right", "mk_framework") ,
            "param_name" => "margin_right",
            "value" => "15",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        $add_css_animations,
        $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Button Skin", "mk_framework") ,
            "param_name" => "outline_skin",
            "value" => array(
                "Dark Color" => "dark",
                "Light Color" => "light",
                "Custom Color" => "custom"
            ) ,
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "dimension",
                'value' => array(
                    'outline',
                    'savvy',
                    'double-outline',
                )
            ) ,
            "group" => __('Colors', 'mk_framework')
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Button Background Color", "mk_framework") ,
            "param_name" => "outline_active_color",
            "value" => "",
            "description" => __("The background and border color of button", "mk_framework") ,
            "dependency" => array(
                'element' => "outline_skin",
                'value' => array(
                    'custom'
                )
            ) ,
            "group" => __('Colors', 'mk_framework')
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Button Text Color", "mk_framework") ,
            "param_name" => "outline_active_text_color",
            "value" => "",
            "description" => __("The text color of button", "mk_framework") ,
            "dependency" => array(
                'element' => "outline_skin",
                'value' => array(
                    'custom'
                )
            ) ,
            "group" => __('Colors', 'mk_framework')
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Button Hover Background Color", "mk_framework") ,
            "param_name" => "outline_hover_bg_color",
            "value" => "",
            "description" => __("The background color when hovered on button", "mk_framework") ,
            "dependency" => array(
                'element' => "outline_skin",
                'value' => array(
                    'custom'
                )
            ) ,
            "group" => __('Colors', 'mk_framework')
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Button Hover Text Color", "mk_framework") ,
            "param_name" => "outline_hover_color",
            "value" => "",
            "description" => __("The text color when hovered on button", "mk_framework") ,
            "dependency" => array(
                'element' => "outline_skin",
                'value' => array(
                    'custom'
                )
            ) ,
            "group" => __('Colors', 'mk_framework')
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Button Background Color", "mk_framework") ,
            "param_name" => "bg_color",
            "value" => '',
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "dimension",
                'value' => array(
                    'two',
                    'three',
                    'flat'
                )
            ) ,
            "group" => __('Colors', 'mk_framework')
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Button Background Color (Hover)", "mk_framework") ,
            "param_name" => "btn_hover_bg",
            "value" => '',
            "description" => __("Please note that this option is only for Flat style", "mk_framework") ,
            "dependency" => array(
                'element' => "dimension",
                'value' => array(
                    'flat'
                )
            ) ,
            "group" => __('Colors', 'mk_framework')
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Button Text Color", "mk_framework") ,
            "param_name" => "text_color",
            "value" => array(
                "Light" => "light",
                "Dark" => "dark"
            ) ,
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "dimension",
                'value' => array(
                    'two',
                    'three',
                    'flat'
                )
            ) ,
            "group" => __('Colors', 'mk_framework')
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Button Text Color (Hover)", "mk_framework") ,
            "param_name" => "btn_hover_txt_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "dimension",
                'value' => array(
                    'flat'
                )
            ) ,
            "group" => __('Colors', 'mk_framework')
        ) ,
    )
));