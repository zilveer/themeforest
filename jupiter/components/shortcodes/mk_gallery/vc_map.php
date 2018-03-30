<?php
vc_map(array(
    "name" => __("Image Gallery", "mk_framework") ,
    "base" => "mk_gallery",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-image-gallery vc_mk_element-icon',
    'description' => __('Adds images in grids in many styles.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Heading Title", "mk_framework") ,
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "attach_images",
            "heading" => __("Add Images", "mk_framework") ,
            "param_name" => "images",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Custom Links", "mk_framework") ,
            "param_name" => "custom_links",
            "value" => "",
            "description" => __("Please add your links, If you use custom links the lightbox will be converted to external links. separate your URLs with comma ','", "mk_framework")
        ) ,
        array(
            "heading" => __("Gallery Style", 'mk_framework') ,
            "description" => __("In grid style you will need to set column and image heights. For Mansory Styles Structure see below image :</br><img src='" . THEME_ADMIN_ASSETS_URI . "/images/gallery-mansory-styles.png' /><br>", 'mk_framework') ,
            "param_name" => "style",
            "value" => array(
                __("Grid", 'mk_framework') => "grid",
                __("Masonry Style 1", 'mk_framework') => "style1",
                __("Masonry Style 2", 'mk_framework') => "style2",
                __("Masonry Style 3", 'mk_framework') => "style3"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "type" => "range",
            "heading" => __("How many Column?", "mk_framework") ,
            "param_name" => "column",
            "value" => "3",
            "min" => "1",
            "max" => "8",
            "step" => "1",
            "unit" => 'column',
            "description" => __("How many columns would you like to appear in one row?", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid'
                )
            )
        ) ,
        array(
            "heading" => __("Image Size", 'mk_framework') ,
            "description" => __("<span style='color:red'>Please note that in Masonry styles, image width and height must be equal(square). So if you will use image sizes other than Resize & Crop, make sure those images are arranged to be square shaped images.</span>", 'mk_framework') ,
            "param_name" => "image_size",
            "value" => mk_get_image_sizes(),
            "type" => "dropdown",
        ) ,
        array(
            "type" => "range",
            "heading" => __("Image Heights", "mk_framework") ,
            "param_name" => "height",
            "value" => "500",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Define your gallery image's height.", "mk_framework") ,
            "dependency" => array(
                'element' => "image_size",
                'value' => array(
                    'crop'
                )
            )
        ) ,
        array(
            "heading" => __("Hover Scenarios", 'mk_framework') ,
            "description" => __("This is what happens when user hovers over a gallery item.", 'mk_framework') ,
            "param_name" => "hover_scenarios",
            "value" => array(
                __("Fade Box", 'mk_framework') => "fadebox",
                __("Grayscale to Color", 'mk_framework') => "grayscale",
                __("Blur", 'mk_framework') => "blur",
                __("Slow Zoom", 'mk_framework') => "slow_zoom",
                __("Overlay Layer", 'mk_framework') => "overlay_layer",
                __("No Overlay", 'mk_framework') => "none",
            ) ,
            "type" => "dropdown",
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Overlay Color", "mk_framework") ,
            "param_name" => "overlay_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "hover_scenarios",
                'value' => array(
                    'fadebox',
                    'blur',
                    'overlay_layer',
                    'grayscale'
                )
            )
        ) ,
        array(
            "heading" => __("Item Spacing", 'mk_framework') ,
            "description" => __("Space between items.", 'mk_framework') ,
            "param_name" => "item_spacing",
            "value" => "8",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "type" => "range",
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework") ,
            "param_name" => "margin_bottom",
            "value" => "20",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Image Frame Style", "mk_framework") ,
            "param_name" => "frame_style",
            "value" => array(
                "No Frame" => "simple",
                "Grid" => "grid",
                "Rounded Frame" => "rounded",
                "Gray Border Frame" => "gray_border"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Collection Title", "mk_framework") ,
            "param_name" => "collection_title",
            "value" => "",
            "description" => __("This title will be replaced with all captions you define in Wordpress media. If you just want to give one title for all gallery images you can use this option. Image alt tag will still follow the media section image alt field.", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Hover Captions", "mk_framework") ,
            "param_name" => "disable_title",
            "value" => "false",
            "description" => __("Using this option you can enable / disable image hover captions. This option is disabled by default.", "mk_framework") ,
            "dependency" => array(
                'element' => "hover_scenarios",
                'value' => array(
                    'fadebox'
                )
            )
        ) ,
        /*array(
            "type" => "dropdown",
            "heading" => __("Increase Quality of Image", "mk_framework") ,
            "param_name" => "image_quality",
            "value" => array(
                __("Normal Quality", 'mk_framework') => "1",
                __("Images 2 times bigger (retina compatible)", 'mk_framework') => "2",
                __("Images 3 times bigger (fullwidth row compatible)", 'mk_framework') => "3"
            ) ,
            "description" => __("If you want gallery images to be retina compatible or you just want to use it in full width row, you may consider increasing the image size. This option will help you to manually define the image quality.", "mk_framework")
        ) ,*/
        array(
            "heading" => __("Pagination?", 'mk_framework') ,
            "description" => __("Enable / Disable pagination for this image loop.", 'mk_framework') ,
            "param_name" => "pagination",
            "value" => 'false',
            "type" => "toggle"
        ) ,
        
        array(
            "heading" => __("Pagination Style", 'mk_framework') ,
            "description" => __("Select which pagination style you would like to use on this loop.", 'mk_framework') ,
            "param_name" => "pagination_style",
            "value" => array(
                __("Classic Pagination Navigation", 'mk_framework') => "1",
                __("Load more button", 'mk_framework') => "2",
                __("Load more on page scroll", 'mk_framework') => "3"
            ) ,
            "type" => "dropdown",
            "dependency" => array(
                'element' => "pagination",
                'value' => array(
                    "true"
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("How many Images per page?", "mk_framework") ,
            "param_name" => "count",
            "value" => "10",
            "min" => "1",
            "max" => "50",
            "step" => "1",
            "unit" => 'images',
            "description" => __("How many Image would you like to show per page?", "mk_framework") ,
            "dependency" => array(
                'element' => "pagination",
                'value' => array(
                    "true"
                )
            )
        ) ,
        array(
            "heading" => __("Order", 'mk_framework') ,
            "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework') ,
            "param_name" => "order",
            "value" => array(
                __("ASC (ascending order)", 'mk_framework') => "ASC",
                __("DESC (descending order)", 'mk_framework') => "DESC"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "heading" => __("Orderby", 'mk_framework') ,
            "description" => __("Sorts retrieved gallery items by parameter.", 'mk_framework') ,
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ) ,
    )
));
