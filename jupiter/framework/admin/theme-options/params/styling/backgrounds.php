<?php
$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_backgrounds_skin",
    "name" => __("Styling / Backgrounds", "mk_framework") ,
    "desc" => __("In this section you can modify all the backgrounds of your site including header, page, body, footer. Here, you can set the layout you would like your site to look like, then click on different layout sections to add/create different backgrounds.", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Choose between boxed and full width layout", 'mk_framework') ,
            "desc" => __("Choose between a full or a boxed layout to set how your website's layout will look like.", 'mk_framework') ,
            "id" => "background_selector_orientation",
            "default" => "full_width_layout",
            "item_padding" => "0px 30px 20px 0",
            "options" => array(
                "boxed_layout" => 'boxed-layout.png',
                "full_width_layout" => 'full-width-layout.png'
            ) ,
            "type" => "visual_selector"
        ) ,
        array(
            "name" => __("Boxed Layout Outer Shadow Size", "mk_framework") ,
            "desc" => __("You can have a outer shadow around the box. using this option you in can modify its range size", "mk_framework") ,
            "id" => "boxed_layout_shadow_size",
            "default" => "0",
            "min" => "0",
            "max" => "60",
            "step" => "1",
            "unit" => 'px',
            "type" => "range"
        ) ,
        array(
            "name" => __("Boxed Layout Outer Shadow Intensity", "mk_framework") ,
            "desc" => __("determines how darker the shadow to be.", "mk_framework") ,
            "id" => "boxed_layout_shadow_intensity",
            "default" => "0",
            "min" => "0",
            "max" => "1",
            "step" => "0.01",
            "unit" => 'alpha',
            "type" => "range"
        ) ,
        array(
            "name" => __("Background color & texture", 'mk_framework') ,
            "desc" => __("Please click on the different sections to modify their backgrounds.", 'mk_framework') ,
            "id" => 'general_backgounds',
            "type" => "background_selector"
        ) ,
        array(
            "id" => "body_color",
            "default" => "#fff",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "body_color_gradient",
            "default" => "single",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "body_color_2",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "body_color_gradient_style",
            "default" => "linear",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "body_color_gradient_angle",
            "default" => "vertical",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "body_image",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "body_size",
            "default" => "false",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "body_position",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "body_attachment",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "body_repeat",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "body_source",
            "default" => "no-image",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_color",
            "default" => "#fff",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_color_gradient",
            "default" => "single",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_color_2",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_color_gradient_style",
            "default" => "linear",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_color_gradient_angle",
            "default" => "vertical",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_image",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_size",
            "default" => "false",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_position",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_attachment",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_repeat",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "page_source",
            "default" => "no-image",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_color",
            "default" => "#fff",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_color_gradient",
            "default" => "single",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_color_2",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_color_gradient_style",
            "default" => "linear",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_color_gradient_angle",
            "default" => "vertical",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_image",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_size",
            "default" => "false",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_position",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_attachment",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_repeat",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "header_source",
            "default" => "no-image",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_color",
            "default" => "#f7f7f7",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_color_gradient",
            "default" => "single",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_color_2",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_color_gradient_style",
            "default" => "linear",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_color_gradient_angle",
            "default" => "vertical",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_image",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_size",
            "default" => "true",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_position",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_attachment",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_repeat",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "banner_source",
            "default" => "no-image",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_color",
            "default" => "#3d4045",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_color_gradient",
            "default" => "single",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_color_2",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_color_gradient_style",
            "default" => "linear",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_color_gradient_angle",
            "default" => "vertical",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_image",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_size",
            "default" => "false",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_position",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_attachment",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_repeat",
            "default" => "",
            "type" => 'hidden_input'
        ) ,
        array(
            "id" => "footer_source",
            "default" => "no-image",
            "type" => 'hidden_input'
        ) ,
    ) ,
);
