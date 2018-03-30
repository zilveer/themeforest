<?php
vc_map(array(
    "name" => __("Social Networks", "mk_framework"),
    "base" => "mk_social_networks",
    'icon' => 'icon-mk-social-networks vc_mk_element-icon',
    'description' => __( 'Adds social network icons.', 'mk_framework' ),
    "category" => __('Social', 'mk_framework'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Size", "mk_framework"),
            "param_name" => "size",
            "value" => array(
                "Small" => "small",
                "Medium" => "medium",
                "Large" => "large",
                "X Large" => "x-large",
                "XX Large" => "xx-large"
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework"),
            "param_name" => "style",
            "value" => array(
                "Rounded" => "rounded",
                "Circle" => "circle",
                "Simple" => "simple",
                "Simple Rounded" => "simple-rounded",
                "Square Pointed Corner" => "square-pointed",
                "Square Rounded Corner" => "square-rounded"

            )
        ),

        array(
            "type" => "range",
            "heading" => __("Margin", "mk_framework"),
            "param_name" => "margin",
            "value" => "4",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("The distance between icons. This margin will be applied to all directions.", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Border Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "#ccc",
            "description" => __("(default: #ccc)", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'square-pointed',
                    'square-rounded',
                    'simple-rounded'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework"),
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("(default: transparent)", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'simple-rounded',
                    'square-pointed',
                    'square-rounded'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Hover Color", "mk_framework"),
            "param_name" => "bg_hover_color",
            "value" => "#232323",
            "description" => __("(default: #232323)", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'simple-rounded',
                    'square-pointed',
                    'square-rounded'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Icons Color", "mk_framework"),
            "param_name" => "icon_color",
            "value" => "#ccc",
            "description" => __("(default: #ccc)", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Icons Hover Color", "mk_framework"),
            "param_name" => "icon_hover_color",
            "value" => "#eee",
            "description" => __("(default: #eee)", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Icons Align", "mk_framework"),
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
            "heading" => __("Facebook URL", "mk_framework"),
            "param_name" => "facebook",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Twitter URL", "mk_framework"),
            "param_name" => "twitter",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("RSS URL", "mk_framework"),
            "param_name" => "rss",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Dribbble URL", "mk_framework"),
            "param_name" => "dribbble",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Digg URL", "mk_framework"),
            "param_name" => "digg",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Pinterest URL", "mk_framework"),
            "param_name" => "pinterest",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Flickr URL", "mk_framework"),
            "param_name" => "flickr",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Google Plus URL", "mk_framework"),
            "param_name" => "google_plus",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Skype URL", "mk_framework"),
            "param_name" => "skype",
            "value" => "",
            "description" => __("Enter the full URL including 'http://'' for profile page or 'skype:USERNAME?call' for direct call (replace USERNAME with your own). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Instagram URL", "mk_framework"),
            "param_name" => "instagram",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Linkedin URL", "mk_framework"),
            "param_name" => "linkedin",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Blogger URL", "mk_framework"),
            "param_name" => "blogger",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Youtube URL", "mk_framework"),
            "param_name" => "youtube",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Last-fm URL", "mk_framework"),
            "param_name" => "last_fm",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Stumble-upon URL", "mk_framework"),
            "param_name" => "stumble_upon",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Sound Cloud URL", "mk_framework"),
            "param_name" => "soundcloud",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Tumblr URL", "mk_framework"),
            "param_name" => "tumblr",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Vimeo URL", "mk_framework"),
            "param_name" => "vimeo",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("WordPress URL", "mk_framework"),
            "param_name" => "wordpress",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Yelp URL", "mk_framework"),
            "param_name" => "yelp",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Reddit URL", "mk_framework"),
            "param_name" => "reddit",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Xing URL", "mk_framework"),
            "param_name" => "xing",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
            //  "dependency" => array(
            //     'element' => "style",
            //     'value' => array(
            //         'rounded',
            //         'circle',
            //     )
            // )
        ),
        array(
            "type" => "textfield",
            "heading" => __("IMDB URL", "mk_framework"),
            "param_name" => "imdb",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Qzone URL", "mk_framework"),
            "param_name" => "qzone",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Renren URL", "mk_framework"),
            "param_name" => "renren",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("VK.com URL", "mk_framework"),
            "param_name" => "vk",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Wechat URL", "mk_framework"),
            "param_name" => "wechat",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Weibo URL", "mk_framework"),
            "param_name" => "weibo",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Whatsapp URL", "mk_framework"),
            "param_name" => "whatsapp",
            "value" => "",
            "description" => __("Enter the full URL of your corresponding social network. Include (http://). If left blank, this social network icon will not be shown.", "mk_framework")
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