<?php

vc_map(array(
    "name" => __("Fade Text Box", "mk_framework"),
    "base" => "mk_fade_txt_box",
    "content_element" => true,
    'icon' => 'icon-mk-content-box vc_mk_element-icon',
    "as_parent" => array('only' => 'mk_fade_txt_item'),
    "category" => __('Slideshows', 'mk_framework'),
    'params' => array(
        array(
            "type" => "range",
            "heading" => __("Item Padding", "mk_framework"),
            "param_name" => "padding",
            "value" => "20",
            "min" => "5",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
        ),
        array(
            "type" => "range",
            "heading" => __("Animation Speed", "mk_framework"),
            "param_name" => "animation_speed",
            "value" => "700",
            "min" => "100",
            "max" => "3000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework")
        ),
        array(
            "heading" => __("Slideshow Speed", "mk_framework"),
            "param_name" => "slideshow_speed",
            "value" => "5000",
            "min" => "0",
            "max" => "50000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("If set to zero the autoplay will be disabled, any number above zeo will define the delay between each slide transition.", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    ),
    "js_view" => 'VcColumnView'
));

vc_map(array(
    "name" => __("Fade Text Item", "mk_framework"),
    "base" => "mk_fade_txt_item",
    "as_child" => array('only' => 'mk_fade_txt_box'),
    'icon' => 'icon-mk-content-box vc_mk_element-icon',
    "content_element" => true,
    "category" => __('Slideshows', 'mk_framework'),
    'params' => array(
        
        array(
            "type" => "textfield",
            "heading" => __("Text", "mk_framework"),
            "param_name" => "item_txt",
            "value" => "",
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "range",
            "heading" => __("Font Size", "mk_framework"),
            "param_name" => "item_text_size",
            "value" => "16",
            "min" => "10",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Font Weight", "mk_framework"),
            "param_name" => "item_font_weight",
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
            "type" => "dropdown",
            "heading" => __("Text Align", "mk_framework"),
            "param_name" => "item_text_align",
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Center', "mk_framework") => "center",
                __('Right', "mk_framework") => "right"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Font Color", "mk_framework"),
            "param_name" => "item_color",
            "value" => "",
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
    "name" => __("Image Slideshow", "mk_framework"),
    "base" => "mk_image_slideshow",
    'icon' => 'icon-mk-image-slideshow vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Simple image slideshow.', 'mk_framework' ),
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
            "heading" => __("Slideshow Direction", "mk_framework"),
            "param_name" => "direction",
            "width" => 300,
            "value" => array(
                __('horizontal', "mk_framework") => "horizontal",
                __('Vertical', "mk_framework") => "vertical"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "heading" => __("Slideshow Align?", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "slideshow_aligment",
            "value" => array(
                __("Left", 'mk_framework') => "left",
                __("Center", 'mk_framework') => "none",
                __("Right", 'mk_framework') => "right"
            ),
            "type" => "dropdown"
        ),

        array(
            "type" => "range",
            "heading" => __("Width", "mk_framework"),
            "param_name" => "image_width",
            "value" => "770",
            "min" => "100",
            "max" => "1380",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Height", "mk_framework"),
            "param_name" => "image_height",
            "value" => "350",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "range",
            "heading" => __("Animation Speed", "mk_framework"),
            "param_name" => "animation_speed",
            "value" => "700",
            "min" => "100",
            "max" => "3000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "range",
            "heading" => __("Slideshow Speed", "mk_framework"),
            "param_name" => "slideshow_speed",
            "value" => "7000",
            "min" => "1000",
            "max" => "20000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Direction Nav", "mk_framework"),
            "param_name" => "direction_nav",
            "value" => "true",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Pagination", "mk_framework"),
            "param_name" => "pagination",
            "value" => "false",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework"),
            "param_name" => "margin_bottom",
            "value" => "20",
            "min" => "0",
            "max" => "500",
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
        )

    )
));


vc_map( array(
        "name"      => __( "Tablet Slideshow", "mk_framework" ),
        "base"      => "mk_tablet_slideshow",
        'icon' => 'icon-mk-image-slideshow vc_mk_element-icon',
        "category" => __('Slideshows', 'mk_framework'),
        'description' => __( 'Slideshow inside a tablet.', 'mk_framework' ),
        "params"    => array(
            array(
                "heading" => __( "Tablet Color", 'mk_framework' ),
                "description" => __( "", 'mk_framework' ),
                "param_name" => "tablet_color",
                "value" => array(
                    __( "Black", 'mk_framework' )  =>  "black",
                    __( "White", 'mk_framework' ) =>  "white",
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "attach_images",
                "heading" => __( "Add Images", "mk_framework" ),
                "param_name" => "images",
                "value" => "",
                "description" => __( "", "mk_framework" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Animation Speed", "mk_framework" ),
                "param_name" => "animation_speed",
                "value" => "700",
                "min" => "100",
                "max" => "3000",
                "step" => "1",
                "unit" => 'ms',
                "description" => __( "", "mk_framework" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Slideshow Speed", "mk_framework" ),
                "param_name" => "slideshow_speed",
                "value" => "7000",
                "min" => "1000",
                "max" => "20000",
                "step" => "1",
                "unit" => 'ms',
                "description" => __( "", "mk_framework" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Pause on Hover", "mk_framework" ),
                "param_name" => "pause_on_hover",
                "value" => "false",
                "description" => __( "Pause the slideshow when hovering over slider, then resume when no longer hovering", "mk_framework" )
            ),


            array(
                "type" => "dropdown",
                "heading" => __( "Viewport Animation", "mk_framework" ),
                "param_name" => "animation",
                "value" => $css_animations,
                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "mk_framework" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework" )
            )

        )
    )
);

vc_map( array(
        "name"      => __( "Mobile Slideshow", "mk_framework" ),
        "base"      => "mk_mobile_slideshow",
        'icon' => 'icon-mk-image-slideshow vc_mk_element-icon',
        "category" => __('Slideshows', 'mk_framework'),
        'description' => __( 'Slideshow inside a mobile.', 'mk_framework' ),
        "params"    => array(
            array(
                "heading" => __( "Orientation", 'mk_framework' ),
                "description" => __( "", 'mk_framework' ),
                "param_name" => "orientation",
                "value" => array(
                    __( "Landscape", 'mk_framework' )  =>  "landscape",
                    __( "Portrait", 'mk_framework' ) =>  "portrait",
                ),
                "type" => "dropdown"
            ),

            array(
                "heading" => __( "Mobile Color", 'mk_framework' ),
                "description" => __( "", 'mk_framework' ),
                "param_name" => "mobile_color",
                "value" => array(
                    __( "Black", 'mk_framework' )  =>  "black",
                    __( "White", 'mk_framework' ) =>  "white",
                ),
                "type" => "dropdown"
            ),
            array(
                "type" => "attach_images",
                "heading" => __( "Add Images", "mk_framework" ),
                "param_name" => "images",
                "value" => "",
                "description" => __( "", "mk_framework" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Animation Speed", "mk_framework" ),
                "param_name" => "animation_speed",
                "value" => "700",
                "min" => "100",
                "max" => "3000",
                "step" => "1",
                "unit" => 'ms',
                "description" => __( "", "mk_framework" )
            ),
            array(
                "type" => "range",
                "heading" => __( "Slideshow Speed", "mk_framework" ),
                "param_name" => "slideshow_speed",
                "value" => "7000",
                "min" => "1000",
                "max" => "20000",
                "step" => "1",
                "unit" => 'ms',
                "description" => __( "", "mk_framework" )
            ),

            array(
                "type" => "toggle",
                "heading" => __( "Pause on Hover", "mk_framework" ),
                "param_name" => "pause_on_hover",
                "value" => "false",
                "description" => __( "Pause the slideshow when hovering over slider, then resume when no longer hovering", "mk_framework" )
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Viewport Animation", "mk_framework" ),
                "param_name" => "animation",
                "value" => $css_animations,
                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework" )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", "mk_framework" ),
                "param_name" => "el_class",
                "value" => "",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework" )
            )

        )
    )
);


vc_map(array(
    "name" => __("Edge Slider", "mk_framework"),
    "base" => "mk_edge_slider",
    'icon' => 'icon-mk-edge-slider vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Powerful Edge Slider.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "toggle",
            "heading" => __("First Element?", "mk_framework"),
            "param_name" => "first_el",
            "value" => "true",
            "description" => __("If you are not using this slideshow as first element in content then disable this option. This option only useful when Transparent Header style is enabled in this page, having this option enabled will allow the header skin follow slide item's => header skin.", "mk_framework")
        ),
        array(
            "type" => "multiselect",
            "heading" => __("Select specific slides", "mk_framework"),
            "param_name" => "slides",
            "value" => '',
            "options" => $edge_posts,
            "description" => __("", "mk_framework")
        ),

        array(
            "heading" => __("Order", 'mk_framework'),
            "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework'),
            "param_name" => "order",
            "value" => array(
                __("DESC (descending order)", 'mk_framework') => "DESC",
                __("ASC (ascending order)", 'mk_framework') => "ASC",
            ),
            "type" => "dropdown"
        ),
        array(
            "heading" => __("Orderby", 'mk_framework'),
            "description" => __("Sort retrieved slides items by parameter.", 'mk_framework'),
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ),
        array(
            "type" => "toggle",
            "heading" => __("Full Height?", "mk_framework"),
            "param_name" => "full_height",
            "value" => "true",
            "description" => __("If you dont want full screen height slideshow disable this option. If you disable this option set the height of slideshow using below option.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Slideshow Height", "mk_framework"),
            "param_name" => "height",
            "value" => "700",
            "min" => "100",
            "max" => "2000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("This option only works when above option is disabled.", "mk_framework")
        ),
        array(
            "heading" => __("Animation Effect", 'mk_framework'),
            "description" => __("Note that Horizontal Curtain is reverted to Slide effect for Internet Explorer.", 'mk_framework'),
            "param_name" => "animation_effect",
            "value" => array(
                __("Slide", 'mk_framework') => "slide",
                __("Slide Vertical", 'mk_framework') => "vertical_slide",
                __("Zoom", 'mk_framework') => "zoom",
                __("Zoom Out", 'mk_framework') => "zoom_out",
                __("Horizontal Curtain", 'mk_framework') => "horizontal_curtain",
                __("Fade", 'mk_framework') => "fade",
                __("Perspective Flip", 'mk_framework') => "perspective_flip"
            ),
            "type" => "dropdown"
        ),
        array(
            "type" => "range",
            "heading" => __("Animation Speed", "mk_framework"),
            "param_name" => "animation_speed",
            "value" => "700",
            "min" => "100",
            "max" => "3000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Pause Time", "mk_framework"),
            "param_name" => "slideshow_speed",
            "value" => "7000",
            "min" => "1000",
            "max" => "20000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("How long each slide will show.", "mk_framework")
        ),


        array(
            "type" => "dropdown",
            "heading" => __("Direction Nav", "mk_framework"),
            "param_name" => "direction_nav",
            "width" => 300,
            "value" => array(
                __('Classic', "mk_framework") => "classic",
                __('Bar', "mk_framework") => "bar",
                __('Round', "mk_framework") => "round",
                __('Flip', "mk_framework") => "flip",
                __('-- No Pagination', "mk_framework") => "false"
            ),
            "description" => __("", "mk_framework"),
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "mk_framework"),
            "param_name" => "pagination",
            "width" => 300,
            "value" => array(
                __('-- No Pagination', "mk_framework") => "",
                __('Small Stroke', "mk_framework") => "small_stroke",
                __('Rounded Underline', "mk_framework") => "rounded",
                __('Underline', "mk_framework") => "underline",
                __('Square', "mk_framework") => "square",

            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Parallax", "mk_framework"),
            "param_name" => "parallax",
            "value" => "false",
            "description" => __("Add parallax effect to your slider", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Loop?", "mk_framework"),
            "param_name" => "edge_slider_loop",
            "value" => "false",
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
    "name" => __("Tab Slider", "mk_framework"),
    "base" => "mk_tab_slider",
    'icon' => 'icon-mk-edge-slider vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Powerful Tab Slider.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "multiselect",
            "heading" => __("Select specific slides", "mk_framework"),
            "param_name" => "slides",
            "value" => '',
            "options" => $tab_posts,
            "description" => __("", "mk_framework")
        ),
        array(
            "heading" => __("Order", 'mk_framework'),
            "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework'),
            "param_name" => "order",
            "value" => array(
                __("DESC (descending order)", 'mk_framework') => "DESC",
                __("ASC (ascending order)", 'mk_framework') => "ASC",
            ),
            "type" => "dropdown"
        ),
        array(
            "heading" => __("Orderby", 'mk_framework'),
            "description" => __("Sort retrieved slides items by parameter.", 'mk_framework'),
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ),
        array(
            "type" => "toggle",
            "heading" => __("Full Height?", "mk_framework"),
            "param_name" => "full_height",
            "value" => "true",
            "description" => __("If you dont want full screen height slideshow disable this option. If you disable this option set the height of slideshow using below option.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Slideshow Height", "mk_framework"),
            "param_name" => "height",
            "value" => "700",
            "min" => "100",
            "max" => "2000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("This option only works when above option is disabled.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Animation Speed", "mk_framework"),
            "param_name" => "animation_speed",
            "value" => "700",
            "min" => "100",
            "max" => "3000",
            "step" => "1",
            "unit" => 'ms',
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
    "name" => __("Edge One Pager", "mk_framework"),
    "base" => "mk_edge_one_pager",
    'icon' => 'icon-mk-edge-one-pager vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Converts Edge Slider to vertical scroll.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "multiselect",
            "heading" => __("Select specific slides", "mk_framework"),
            "param_name" => "slides",
            "value" => '',
            "options" => $edge_posts,
            "description" => __("", "mk_framework")
        ),

        array(
            "heading" => __("Order", 'mk_framework'),
            "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework'),
            "param_name" => "order",
            "value" => array(
                __("DESC (descending order)", 'mk_framework') => "DESC",
                __("ASC (ascending order)", 'mk_framework') => "ASC",
            ),
            "type" => "dropdown"
        ),
        array(
            "heading" => __("Orderby", 'mk_framework'),
            "description" => __("Sort retrieved slides items by parameter.", 'mk_framework'),
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ),
        array(
            "type" => "toggle",
            "heading" => __("Pagination?", "mk_framework"),
            "param_name" => "navigation",
            "value" => "true",
            "description" => __("", "mk_framework")
        ),
        
        array(
            "type" => "dropdown",
            "heading" => __("Pagination Style", "mk_framework"),
            "param_name" => "pagination",
            "width" => 300,
            "value" => array(
                __('Square', "mk_framework") => "square",
                __('Small Stroke', "mk_framework") => "small_stroke",
                __('Rounded Underline', "mk_framework") => "rounded",
                __('Underline', "mk_framework") => "underline",

            ),
            "dependency" => array(
                "element" => "navigation",
                "value" => array(
                    "true"
                )
            ),
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
    "name" => __("Content Scroller", "mk_framework"),
    "base" => "vc_content_scroller",
    "as_parent" => array('only' => 'vc_content_scroller_item'),
    "content_element" => true,
    'icon' => 'icon-mk-image-slideshow vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Swiper enabled content slideshow.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "colorpicker",
            "heading" => __("Border Top and Bottom Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "#eee",
            "description" => __("", "mk_framework")
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
            "type" => "dropdown",
            "heading" => __("Background Attachment", "mk_framework"),
            "param_name" => "attachment",
            "width" => 150,
            "value" => array(
                __('Scroll', "mk_framework") => "scroll",
                __('Fixed', "mk_framework") => "fixed"
            ),
            "description" => __("The background-attachment property sets whether a background image is fixed or scrolls with the rest of the page. <a href='http://www.w3schools.com/CSSref/pr_background-attachment.asp'>Read More</a>", "mk_framework")
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
            "type" => "toggle",
            "heading" => __('Cover whole background', 'mk_framework'),
            "description" => __("Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area.", "mk_framework"),
            "param_name" => "bg_stretch",
            "value" => "false",
        ),
        array(
            "heading" => __("Slide Direction", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "slide_direction",
            "value" => array(
                __("Horizontal", 'mk_framework') => "horizontal",
                __("Vertical", 'mk_framework') => "vertical"
            ),
            "dependency" => array(
                'element' => "effect",
                'value' => array(
                    'slide'
                )
            ),
            "type" => "dropdown"
        ),

        array(
            "type" => "range",
            "heading" => __("Animation Speed", "mk_framework"),
            "param_name" => "animation_speed",
            "value" => "700",
            "min" => "100",
            "max" => "3000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Slideshow Speed", "mk_framework"),
            "param_name" => "slideshow_speed",
            "value" => "7000",
            "min" => "1000",
            "max" => "20000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Padding", "mk_framework"),
            "param_name" => "padding",
            "value" => "0",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "toggle",
            "heading" => __("Direction Nav", "mk_framework"),
            "param_name" => "direction_nav",
            "value" => "true",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    ),
     "js_view" => 'VcColumnView'
));

vc_map(array(
    "name" => __("Content Scroller Item", "mk_framework"),
    "base" => "vc_content_scroller_item",
     'icon' => 'icon-mk-image-slideshow vc_mk_element-icon',
    "content_element" => true,
    "as_child" => array('only' => 'vc_content_scroller'),
    "is_container" => true,

    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework"),
            "param_name" => "title",
            "description" => __("Content Scroller section title.", "mk_framework")
        )
    ),
     "js_view" => 'VcColumnView'
));



vc_map(array(
    "name" => __("Testimonials", "mk_framework"),
    "base" => "mk_testimonials",
    'icon' => 'icon-mk-testimonial-slideshow vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Shows Testimonials in multiple styles.', 'mk_framework' ),
    "params" => array(


        array(
            "heading" => __("Style", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "style",
            "value" => array(
                __("Boxed Style", 'mk_framework') => "boxed",
                __("Quotation Style", 'mk_framework') => "quote",
                __("Modern Style", 'mk_framework') => "modern"
            ),
            "type" => "dropdown"
        ),
        array(
            "type" => "range",
            "heading" => __("Count", "mk_framework"),
            "param_name" => "count",
            "value" => "4",
            "min" => "-1",
            "max" => "50",
            "step" => "1",
            "unit" => 'testimonial',
            "description" => __("How many testimonial you would like to show? (-1 means unlimited)", "mk_framework")
        ),
        array(
            "type" => "multiselect",
            "heading" => __("Select specific testimonials", "mk_framework"),
            "param_name" => "testimonials",
            "value" => '',
            "options" => $testimonials,
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "theme_fonts",
            "heading" => __("Font Family", "mk_framework"),
            "param_name" => "font_family",
            "value" => "",
            "description" => __("You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Font Size?", "mk_framework"),
            "param_name" => "font_size",
            "value" => "14",
            "min" => "10",
            "max" => "30",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Line Height?", "mk_framework"),
            "param_name" => "line_height",
            "value" => "26",
            "min" => "15",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Font Color?", "mk_framework"),
            "param_name" => "font_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'boxed',
                    'modern',
                )
            ),
        ),
        array(
            "type" => "hidden_input",
            "param_name" => "font_type",
            "value" => "",
            "description" => __("", "mk_framework")
        ),

        array(
            "heading" => __("Skin", 'mk_framework'),
            "description" => __("Please note that this option will only work in \"Quotation Style\"", 'mk_framework'),
            "param_name" => "skin",
            "value" => array(
                __("Dark", 'mk_framework') => "dark",
                __("Light", 'mk_framework') => "light"
            ),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'quote'
                )
            ),
            "type" => "dropdown"
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
            "description" => __("Sort retrieved client items by parameter.", 'mk_framework'),
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ),



        array(
            "heading" => __("Slides animation", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "animation_effect",
            "value" => array(
                __("Slide", 'mk_framework') => "slide",
                __("Fade", 'mk_framework') => "fade"
            ),
            "type" => "dropdown"
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
    "name" => __("Window Scroller", "mk_framework"),
    "base" => "mk_window_scroller",
    'icon' => 'icon-mk-image-slideshow vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Vertical widnow scroll in a frame.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "upload",
            "heading" => __("Uplaod Your image", "mk_framework"),
            "param_name" => "src",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Window Height", "mk_framework"),
            "param_name" => "height",
            "value" => "300",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "range",
            "heading" => __("Animation Speed", "mk_framework"),
            "param_name" => "speed",
            "value" => "2000",
            "min" => "100",
            "max" => "10000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link", "mk_framework"),
            "param_name" => "link",
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
    "name" => __("Theatre Slider", "mk_framework"),
    "base" => "mk_theatre_slider",
    'icon' => 'vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( '', 'mk_framework' ),
    "params" => array(
        array(
            "heading" => __("Background Style", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "background_style",
            "value" => array(
                __("Desktop", 'mk_framework') => "desktop_style",
                __("Laptop", 'mk_framework') => "laptop_style"
            ),
            "type" => "dropdown"
        ),
        array(
            "type" => "range",
            "heading" => __("Slider Max Width", "mk_framework"),
            "param_name" => "max_width",
            "value" => "900",
            "min" => "320",
            "max" => "920",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "heading" => __("Video Host", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "host",
            "value" => array(
                __("Self Hosted", 'mk_framework') => "self_hosted",
                __("Social Hosted", 'mk_framework') => "social_hosted"
            ),
            "type" => "dropdown"
        ), 
        array(
            "type" => "upload",
            "heading" => __("MP4 Format", "mk_framework"),
            "param_name" => "mp4",
            "value" => "",
            "description" => __("Compatibility for Safari, IE9", "mk_framework"),
            "dependency" => array(
                'element' => "host",
                'value' => array(
                    'self_hosted'
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
                'element' => "host",
                'value' => array(
                    'self_hosted'
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
                'element' => "host",
                'value' => array(
                    'self_hosted'
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
                'element' => "host",
                'value' => array(
                    'self_hosted'
                )
            )
        ),
        array(
            "heading" => __("Stream Host Website", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "stream_host_website",
            "value" => array(
                __("Youtube", 'mk_framework') => "youtube",
                __("Vimeo", 'mk_framework') => "vimeo"
            ),
            "type" => "dropdown",
            "dependency" => array(
                'element' => "host",
                'value' => array(
                    'social_hosted'
                )
            ),
        ),
        array(
            "type" => "toggle",
            "heading" => __("Show Social Video Controls", "mk_framework"),
            "param_name" => "video_controls",
            "value" => "true",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "stream_host_website",
                'value' => array(
                    'youtube'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Autoplay?", "mk_framework"),
            "param_name" => "autoplay",
            "value" => "false",
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "toggle",
            "heading" => __("Loop?", "mk_framework"),
            "param_name" => "loop",
            "value" => "false",
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Video ID", "mk_framework"),
            "param_name" => "stream_video_id",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "host",
                'value' => array(
                    'social_hosted'
                )
            )
        ),
        array(
            "heading" => __("Slider Align", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "align",
            "value" => array(
                __("Left", 'mk_framework') => "left",
                __("Center", 'mk_framework') => "center",
                __("Right", 'mk_framework') => "right"
            ),
            "type" => "dropdown"
        ),
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework"),
            "param_name" => "margin_bottom",
            "value" => "25",
            "min" => "10",
            "max" => "250",
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
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));
