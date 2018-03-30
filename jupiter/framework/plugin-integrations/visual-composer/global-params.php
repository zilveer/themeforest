<?php
if (!defined('THEME_FRAMEWORK'))
    exit('No direct script access allowed');

/**
 * Options params that are shared among most of the shortcodes. 
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */

$target_arr = array(
    __("Same window", "mk_framework") => "_self",
    __("New window", "mk_framework") => "_blank"
);

$font_weight = array(
    __('Default', "mk_framework") => "inherit",
    __('Lightest', "mk_framework") => "100",
    __('Lighter', "mk_framework") => "200",
    __('Light', "mk_framework") => "300",
    __('Normal', "mk_framework") => "400",
    __('Medium (500)', "mk_framework") => "500",
    __('Semi-Bold (600)', "mk_framework") => "600",
    __('Bold', "mk_framework") => "bold",
    __('Bolder', "mk_framework") => "bolder",
    __('Extra Bold', "mk_framework") => "900"
);

$add_css_animations = array(
    "type" => "dropdown",
    "heading" => __("Viewport Animation", "mk_framework"),
    "param_name" => "animation",
    "value" => array(
        "None" => '',
        "Fade In" => "fade-in",
        "Scale Up" => "scale-up",
        "Right to Left" => "right-to-left",
        "Left to Right" => "left-to-right",
        "Bottom to Top" => "bottom-to-top",
        "Top to Bottom" => "top-to-bottom",
        "Flip Horizontally" => "flip-x",
        "Flip Vertically" => "flip-y"
    ),
    "description" => __("Viewport animation will be triggered when this element is being viewed while you scroll page down. Choose the type of animation from this list. please note that this only works in moderns. This feature is disabled in touch devices to increase browsing speed.", "mk_framework")
);
$add_device_visibility = array(
    "type" => "dropdown",
    "heading" => __("Visibility For devices", "mk_framework"),
    "param_name" => "visibility",
    "value" => array(
        "All" => '',
        "Hidden on Phones (Screens smaller than 765px of width)" => "hidden-sm",
        "Hidden on Tablets (Screens in the range of 768px and 1024px)" => "hidden-tl",
        "Hidden on Mega Tablets (Screens in the range of 768px and 1280px)" => "hidden-tl-v2",
        "Hidden on Netbooks (Screens smaller than 1024px of width)" => "hidden-nb",
        "Hidden on Desktops (Screens wider than 1224px of width)" => "hidden-dt",
        "Hidden on Mega Desktops (Screens wider than 1290px of width)" => "hidden-dt-v2",
        "Visible on Phones (Screens smaller than 765px of width)" => "visible-sm",
        "Visible on Tablets (Screens in the range of 768px and 1024px)" => "visible-tl",
        "Visible on Mega Tablets (Screens in the range of 768px and 1280px)" => "visible-tl-v2",
        "Visible on Netbooks (Screens smaller than 1024px of width)" => "visible-nb",
        "Visible on Desktops (Screens wider than 1224px of width)" => "visible-dt",
        "Visible on Mega Desktops (Screens wider than 1290px of width)" => "visible-dt-v2"
    ),
    "description" => __("You can make this element invisible for a particular device (screen resolution) or set it to All to be visible for all devices.<br> Important : Device detection is based on <strong>Device Screen Width</strong> and we can not clearly define the sort of device whether its a tablet or small laptop. This option mostly helps to organise your content on smaller devices (e.g. remove large content for mobiles) and it does not specifically help you to determine the type of device.", "mk_framework")
);
$mk_orderby = array(
    __("Date", 'mk_framework') => "date",
    __('Menu Order', 'mk_framework') => 'menu_order',
    __("Posts In (manually selected posts)", 'mk_framework') => "post__in",
    __("post id", 'mk_framework') => "id",
    __("title", 'mk_framework') => "title",
    __("Comment Count", 'mk_framework') => "comment_count",
    __("Random", 'mk_framework') => "rand",
    __("Author", 'mk_framework') => "author",
    __("No order", 'mk_framework') => "none"
);
$color_selection_style = array(
    "type" => "dropdown",
    "heading" => __("Text Color Type", "mk_framework"),
    "param_name" => "color_style",
    "default" => "single_color",
    "value" => array(
        __('Single Color', "mk_framework") => "single_color",
        __('Gradient Color', "mk_framework") => "gradient_color"
    ),
    "description" => __("", "mk_framework")
);
$color_selection_single_color = array(
    "type" => "colorpicker",
    "heading" => __("Text Color", "mk_framework"),
    "param_name" => "color",
    "value" => "",
    "description" => __("", "mk_framework"),
    "dependency" => array(
        'element' => "color_style",
        'value' => array(
            'single_color'
        )
    )
);
$color_selection_gradient_color_from  = array(
    "type" => "colorpicker",
    "heading" => __("From", "mk_framework"),
    "param_name" => "grandient_color_from",
    
    //"edit_field_class" => "vc_col-sm-3",
    "value" => "",
    "description" => __("", "mk_framework"),
    "dependency" => array(
        'element' => "color_style",
        'value' => array(
            'gradient_color'
        )
    )
);
$color_selection_gradient_color_to    = array(
    "type" => "colorpicker",
    "heading" => __("To", "mk_framework"),
    "param_name" => "grandient_color_to",
    
    //"edit_field_class" => "vc_col-sm-3",
    "value" => "",
    "description" => __("", "mk_framework"),
    "dependency" => array(
        'element' => "color_style",
        'value' => array(
            'gradient_color'
        )
    )
);
$color_selection_gradient_color_style = array(
    "type" => "dropdown",
    "heading" => __("Style", "mk_framework"),
    "param_name" => "grandient_color_style",
    
    //"edit_field_class" => "vc_col-sm-3",
    "value" => array(
        __('Linear', "mk_framework") => "linear",
        __('Radial', "mk_framework") => "radial"
    ),
    "description" => __("", "mk_framework"),
    "dependency" => array(
        'element' => "color_style",
        'value' => array(
            'gradient_color'
        )
    )
);
$color_selection_gradient_color_angle = array(
    "type" => "dropdown",
    "heading" => __("Angle", "mk_framework"),
    "param_name" => "grandient_color_angle",
    
    //"edit_field_class" => "vc_col-sm-3",
    "value" => array(
        __('Vertical ↓', "mk_framework") => "vertical",
        __('Horizontal →', "mk_framework") => "horizontal",
        __('Diagonal ↘', "mk_framework") => "diagonal_left_bottom",
        __('Diagonal ↗', "mk_framework") => "diagonal_left_top"
    ),
    "description" => __("", "mk_framework"),
    "dependency" => array(
        'element' => "grandient_color_style",
        'value' => array(
            'linear'
        )
    )
);

$color_selection_gradient_color_fallback = array(
    "type" => "colorpicker",
    "heading" => __("Gradient Fallback Color", "mk_framework"),
    "param_name" => "grandient_color_fallback",
    
    //"edit_field_class" => "vc_col-sm-3",
    "value" => "",
    "description" => __("", "mk_framework"),
    "dependency" => array(
        'element' => "color_style",
        'value' => array(
            'gradient_color'
        )
    )
);

$theme_options = get_option(THEME_OPTIONS);
$skin_color = $theme_options['skin_color'];