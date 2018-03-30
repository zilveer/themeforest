<?php
$captcha_plugin_status = '';
if(!Mk_Theme_Captcha::is_plugin_active()) {
    $captcha_plugin_status = '<span style="color:red">Artbees Themes Captcha plugin is not activated! <a href="'.admin_url('themes.php?page=tgmpa-install-plugins').'">Click here</a> to begin installing.</span>';
}

 vc_map(array(
    "base" => "mk_contact_form",
    "name" => __("Contact Form", "mk_framework"),
    'icon' => 'icon-mk-contact-form vc_mk_element-icon',
    'description' => __( 'Adds Contact form element.', 'mk_framework' ),
    "category" => __('Social', 'mk_framework'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Heading Title", "mk_framework"),
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework"),
            "param_name" => "style",
            "value" => array(
                __("Outline", "mk_framework") => "outline",
                __("Modern", "mk_framework") => "modern",
                __("Classic", "mk_framework") => "classic",
                __("Corporate", "mk_framework") => "corporate",
                __("Line", "mk_framework") => "line"
            ),
            "description" => __("Choose your contact form style", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Skin", "mk_framework"),
            "param_name" => "skin",
            "value" => array(
                __("Dark", "mk_framework") => "dark",
                __("Light", "mk_framework") => "light"
            ),
            "description" => __("Choose your contact form style", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'modern',
                    'outline'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button Text", "mk_framework"),
            "param_name" => "button_text",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework"),
            "param_name" => "bg_color",
            "description" => __("", "mk_framework"),
            "value" => "#f6f6f6",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'corporate'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Border Color", "mk_framework"),
            "param_name" => "border_color",
            "description" => __("", "mk_framework"),
            "value" => "#f6f6f6",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'corporate'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Font Color", "mk_framework"),
            "param_name" => "font_color",
            "description" => __("", "mk_framework"),
            "value" => "#373737",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'corporate'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Button Background Color", "mk_framework"),
            "param_name" => "button_color",
            "description" => __("", "mk_framework"),
            "value" => "#373737",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'corporate'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Button Font Color", "mk_framework"),
            "param_name" => "button_font_color",
            "description" => __("", "mk_framework"),
            "value" => "#fff",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'corporate'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Skin Color", "mk_framework"),
            "param_name" => "line_skin_color",
            "description" => __("", "mk_framework"),
            "value" => "#eee",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'line'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Button Text Color", "mk_framework"),
            "param_name" => "line_button_text_color",
            "value" => array(
                __("Dark", "mk_framework") => "dark",
                __("Light", "mk_framework") => "light"
            ),
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'line'
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Email", "mk_framework"),
            "param_name" => "email",
            "value" => get_bloginfo( 'admin_email' ),
            "description" => sprintf(__('Which email would you like the contacts to be sent, if left empty emails will be sent to admin email : "%s"', "mk_framework"), get_bloginfo('admin_email'))
        ),
        array(
            "type" => "toggle",
            "heading" => __("Show Phone Number Field?", "mk_framework"),
            "param_name" => "phone",
            "value" => "false",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Captcha authentication?", "mk_framework"),
            "param_name" => "captcha",
            "value" => "true",
            "description" => __("Keep away spam bots. " . $captcha_plugin_status , "mk_framework"),

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