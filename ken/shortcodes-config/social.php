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
            "heading" => __("Style", "mk_framework"),
            "param_name" => "style",
            "value" => array(
                "Square" => "square",
                "Circle" => "circle",
                "Simple" => "simple"
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Skin", "mk_framework"),
            "param_name" => "skin",
            "value" => array(
                "Dark" => "dark",
                "Light" => "light",
                "Custom" => "custom",
            )
        ),


        array(
            "type" => "colorpicker",
            "heading" => __("Border Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "#ccc",
            "description" => __("(default: #ccc). Doesn't work with Simple Style", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework"),
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("(default: transparent). Doesn't work with Simple Style", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Hover Color", "mk_framework"),
            "param_name" => "bg_hover_color",
            "value" => "#232323",
            "description" => __("(default: #232323). Doesn't work with Simple Style", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Icons Color", "mk_framework"),
            "param_name" => "icon_color",
            "value" => "#ccc",
            "description" => __("(default: #ccc)", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Icons Hover Color", "mk_framework"),
            "param_name" => "icon_hover_color",
            "value" => "#eee",
            "description" => __("(default: #eee)", "mk_framework"),
            "dependency" => array(
                'element' => "skin",
                'value' => array(
                    'custom'
                )
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
            "description" => __("How much distance between icons? this margin will be applied to all directions.", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Icons Align", "mk_framework"),
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('None', "mk_framework") => "none",
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
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Twitter URL", "mk_framework"),
            "param_name" => "twitter",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("RSS URL", "mk_framework"),
            "param_name" => "rss",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Instagram URL", "mk_framework"),
            "param_name" => "instagram",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Dribbble URL", "mk_framework"),
            "param_name" => "dribbble",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
         array(
            "type" => "textfield",
            "heading" => __("Vimeo URL", "mk_framework"),
            "param_name" => "vimeo",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
         array(
            "type" => "textfield",
            "heading" => __("Spotify URL", "mk_framework"),
            "param_name" => "spotify",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Pinterest URL", "mk_framework"),
            "param_name" => "pinterest",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Google Plus URL", "mk_framework"),
            "param_name" => "google_plus",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Linkedin URL", "mk_framework"),
            "param_name" => "linkedin",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Youtube URL", "mk_framework"),
            "param_name" => "youtube",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Tumblr URL", "mk_framework"),
            "param_name" => "tumblr",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),



        array(
            "type" => "textfield",
            "heading" => __("Behance URL", "mk_framework"),
            "param_name" => "behance",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("WhatsApp URL", "mk_framework"),
            "param_name" => "whatsapp",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("qzone URL", "mk_framework"),
            "param_name" => "qzone",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("vk.com URL", "mk_framework"),
            "param_name" => "vkcom",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("IMDb URL", "mk_framework"),
            "param_name" => "imdb",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Renren URL", "mk_framework"),
            "param_name" => "renren",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Wechat URL", "mk_framework"),
            "param_name" => "wechat",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Weibo URL", "mk_framework"),
            "param_name" => "weibo",
            "value" => "",
            "description" => __("Fill this textbox with the full URL of your corresponding social netowork. include (http://). if left blank this social network icon wont be shown.", "mk_framework")
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
    "name" => __("Twitter Feeds", "mk_framework"),
    "base" => "vc_twitter",
    'icon' => 'icon-mk-twitter-feeds vc_mk_element-icon',
    'description' => __( 'Adds Twitter Feeds.', 'mk_framework' ),
    "category" => __('Social', 'mk_framework'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Twitter name", "mk_framework"),
            "param_name" => "twitter_name",
            "value" => "",
            "description" => __("Type in twitter profile name from which load tweets.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Tweets count", "mk_framework"),
            "param_name" => "tweets_count",
            "value" => "5",
            "min" => "1",
            "max" => "30",
            "step" => "1",
            "unit" => 'tweets',
            "description" => __("How many recent tweets to load.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        ),
        array(
            'type' => 'item_id',
            'heading' => __( 'Item ID', 'mk_framework' ),
            'param_name' => "item_id"
        )
    )
));





vc_map(array(
    "name" => __("Video player", "mk_framework"),
    "base" => "vc_video",
    'icon' => 'icon-mk-video-player vc_mk_element-icon',
    'description' => __( 'Youtube, Vimeo,..', 'mk_framework' ),
    "category" => __('Social', 'mk_framework'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Widget Title", "mk_framework"),
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Video link", "mk_framework"),
            "param_name" => "link",
            "value" => "",
            "description" => __('Link to the video. More about supported formats at <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>.', "mk_framework")
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
    "name" => __("Google Maps", "mk_framework"),
    "base" => "mk_gmaps",
    "category" => __('Social', 'mk_framework'),
    'icon' => 'icon-mk-advanced-google-maps vc_mk_element-icon',
    'description' => __( 'Powerful Google Maps element.', 'mk_framework' ),
    "params" => array(
         array(
               "type" => "textfield",
               "heading" => __("Address 1 : Latitude", "mk_framework"),
               "param_name" => "latitude",
               "value" => "",
               "description" => __('', "mk_framework")
          ),
          array(
               "type" => "textfield",
               "heading" => __("Address 1 : Longitude", "mk_framework"),
               "param_name" => "longitude",
               "value" => "",
               "description" => __('', "mk_framework")
          ),
          array(
               "type" => "textfield",
               "heading" => __("Address 1 : Full Address Text (shown in tooltip)", "mk_framework"),
               "param_name" => "address",
               "value" => "",
               "description" => __('', "mk_framework")
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
               "heading" => __("Upload Marker Icon", "mk_framework"),
               "param_name" => "pin_icon",
               "value" => "",
               "description" => __("If left blank Google Default marker will be used.", "mk_framework")
          ),
          array(
               "type" => "range",
               "heading" => __("Map height", "mk_framework"),
               "param_name" => "height",
               "value" => "400",
               "min" => "1",
               "max" => "1000",
               "step" => "1",
               "unit" => 'px',
               "description" => __('Enter map height in pixels. Example: 200).', "mk_framework")
          ),

          array(
               "type" => "toggle",
               "heading" => __("Full Height?", "mk_framework"),
               "param_name" => "full_height",
               "value" => "false",
               "description" => __("", "mk_framework")
          ),

          array(
               "type" => "toggle",
               "heading" => __("Parallax Effect?", "mk_framework"),
               "param_name" => "parallax",
               "value" => "false",
               "description" => __("If you dont want to have parallax effect in this shortcode disable this option.", "mk_framework")
          ),
          array(
               "type" => "range",
               "heading" => __("Zoom", "mk_framework"),
               "param_name" => "zoom",
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
               "heading" => __("Modify Google Maps Hue, Saturation, Lightness", "mk_framework"),
               "param_name" => "modify_coloring",
               "value" => array(
                    __("No", "mk_framework") => "false",
                    __("Yes", "mk_framework") => "true"
               ),
               "description" => __("", "mk_framework")
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
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));



vc_map(array(
    "base" => "vc_flickr",
    "name" => __("Flickr Feeds", "mk_framework"),
    'icon' => 'icon-mk-flickr-feeds vc_mk_element-icon',
    'description' => __( 'Show your Flickr Feeds.', 'mk_framework' ),
    "category" => __('Social', 'mk_framework'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Flickr ID", "mk_framework"),
            "param_name" => "flickr_id",
            "value" => "95572727@N00",
            "description" => __('To find your flickID visit <a href="http://idgettr.com/" target="_blank">idGettr</a>. In order to use Flickr Shortcode you should first obtain an API key from <a href="http://www.flickr.com/services/api/misc.api_keys.html">Flickr The App Garden</a> and update the field in Theme settings => Third Party API => Flickr API Key.', "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Number of photos", "mk_framework"),
            "param_name" => "count",
            "value" => "6",
            "min" => "1",
            "max" => "200",
            "step" => "1",
            "unit" => 'photos'
        ),
        array(
            "type" => "dropdown",
            "heading" => __("How many photos in one row?", "mk_framework"),
            "param_name" => "column",
            "value" => array(
                __("1", "mk_framework") => "one",
                __("2", "mk_framework") => "two",
                __("3", "mk_framework") => "three",
                __("4", "mk_framework") => "four",
                __("5", "mk_framework") => "five",
                __("6", "mk_framework") => "six",
                __("7", "mk_framework") => "seven",
                __("8", "mk_framework") => "eight"
            ),
            "description" => __("", "mk_framework")
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
    "base" => "mk_instagram",
    "name" => __("Instagram Feeds", "mk_framework"),
    "category" => __('Social', 'mk_framework'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Instagram ID", "mk_framework"),
            "param_name" => "instagram_id",
            "value" => "",
            "description" => __('Dont know your user id or token? <a target="_blank" href="https://instagram.com/oauth/authorize/?client_id=12087cfb5d6b4a639e77bb8438c8e47c&redirect_uri=https://www.artbees.net/instagram-api/&response_type=token">Click here</a> to get one.', "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Access Token", "mk_framework"),
            "param_name" => "access_token",
            "value" => "",
            "description" => __('Dont know your user id or token? <a target="_blank" href="https://instagram.com/oauth/authorize/?client_id=12087cfb5d6b4a639e77bb8438c8e47c&redirect_uri=https://www.artbees.net/instagram-api/&response_type=token">Click here</a> to get one.', "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Number of photos", "mk_framework"),
            "param_name" => "count",
            "value" => "6",
            "min" => "1",
            "max" => "60",
            "step" => "1",
            "unit" => 'photos'
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Sort By", "mk_framework"),
            "param_name" => "sort_by",
            "value" => array(
                __("Most Recent", "mk_framework") => "most-recent",
                __("Least Recent", "mk_framework") => "least-recent",
                __("Most Liked", "mk_framework") => "most-liked",
                __("Least Liked", "mk_framework") => "least-liked",
                __("Most Commented", "mk_framework") => "most-commented",
                __("Least Commented", "mk_framework") => "least-commented",
                __("Random", "mk_framework") => "random"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Thumbnail Size", "mk_framework"),
            "param_name" => "size",
            "value" => array(
                __("Thumbnail (150X150)", "mk_framework") => "thumbnail",
                __("Low Resolution (306X306)", "mk_framework") => "low_resolution",
                __("Standard Resolution (612X612)", "mk_framework") => "standard_resolution"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("How many photos in one row?", "mk_framework"),
            "param_name" => "column",
            "value" => array(
                __("1", "mk_framework") => "one",
                __("2", "mk_framework") => "two",
                __("3", "mk_framework") => "three",
                __("4", "mk_framework") => "four",
                __("5", "mk_framework") => "five"
            ),
            "description" => __("", "mk_framework")
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
    "base" => "mk_contact_form",
    "name" => __("Contact Form", "mk_framework"),
    'icon' => 'icon-mk-contact-form vc_mk_element-icon',
    'description' => __( 'Adds Contact form element.', 'mk_framework' ),
    "category" => __('Social', 'mk_framework'),
    "params" => array(


        array(
            "type" => "textfield",
            "heading" => __("Email", "mk_framework"),
            "param_name" => "email",
            "value" => get_bloginfo( 'admin_email' ),
            "description" => sprintf(__('Which email would you like the contacts to be sent, if left empty emails will be sent to admin email : "%s"', "mk_framework"), get_bloginfo('admin_email'))

        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework"),
            "param_name" => "style",
            "value" => array(
                __("Classic", "mk_framework") => "classic",
                __("Modern", "mk_framework") => "modern"
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
                    'classic'
                )
            )
        ),
        array(
               "type" => "colorpicker",
               "heading" => __("Skin Color", "mk_framework"),
               "param_name" => "skin_color",
               "value" => "#000",
               "description" => __("", "mk_framework"),
               "dependency" => array(
                    'element' => "style",
                    'value' => array(
                         'modern'
                    )
               )
        ),

        array(
               "type" => "colorpicker",
               "heading" => __("Button Text Color", "mk_framework"),
               "param_name" => "btn_text_color",
               "value" => "#000",
               "description" => __("", "mk_framework"),
               "dependency" => array(
                    'element' => "style",
                    'value' => array(
                         'modern'
                    )
               )
        ),

        array(
               "type" => "colorpicker",
               "heading" => __("Button Hover Text Color", "mk_framework"),
               "param_name" => "btn_hover_text_color",
               "value" => "#fff",
               "description" => __("", "mk_framework"),
               "dependency" => array(
                    'element' => "style",
                    'value' => array(
                         'modern'
                    )
               )
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
            "heading" => __("Show Captcha?", "mk_framework"),
            "param_name" => "captcha",
            "value" => "true",
            "description" => __("", "mk_framework")
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
    "base" => "mk_contact_info",
    "name" => __("Contact Info", "mk_framework"),
    'icon' => 'icon-mk-contact-info vc_mk_element-icon',
    "category" => __('Social', 'mk_framework'),
    'description' => __( 'Adds Contact info details.', 'mk_framework' ),
    "params" => array(

        array(
            "type" => "dropdown",
            "heading" => __("Skin", "mk_framework"),
            "param_name" => "skin",
            "value" => array(
                __("Dark", "mk_framework") => "dark",
                __("Light", "mk_framework") => "light",
                __("Custom", "mk_framework") => "custom"
            ),
            "description" => __("Choose your contact form style", "mk_framework")
        ),
        array(
             "type" => "colorpicker",
             "heading" => __("Text & Icon Color", "mk_framework"),
             "param_name" => "text_icon_color",
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
             "heading" => __("Border Color", "mk_framework"),
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
            "type" => "textfield",
            "heading" => __("Name", "mk_framework"),
            "param_name" => "name",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Cellphone", "mk_framework"),
            "param_name" => "cellphone",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Phone", "mk_framework"),
            "param_name" => "phone",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address", "mk_framework"),
            "param_name" => "address",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Website", "mk_framework"),
            "param_name" => "website",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Email", "mk_framework"),
            "param_name" => "email",
            "value" => ""
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
