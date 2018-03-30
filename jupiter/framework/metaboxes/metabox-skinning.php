<?php
$config = array(
    'title' => sprintf('%s Styling Options', THEME_NAME) ,
    'id' => 'mk-metaboxes-styling',
    'pages' => array(
        'page',
        'portfolio',
        'post',
        'news'
    ) ,
    'callback' => '',
    'context' => 'normal',
    'priority' => 'default'
);
$options = array(
    
    array(
        "name" => __("Override Global Settings", "mk_framework") ,
        "desc" => __("You should enable this option if you want to override global background values defined in Theme Options.", "mk_framework") ,
        "id" => "_enable_local_backgrounds",
        "default" => 'false',
        "type" => "toggle"
    ) ,
    
    array(
        "name" => __("Header Styles", "mk_framework") ,
        "desc" => __("Using this option you can choose your header style, elements align and toggle off/on header toolbar.", "mk_framework") ,
        "id" => "theme_header_style",
        "default" => '1',
        "type" => 'header_styles',
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    array(
        "id" => "theme_header_align",
        "default" => "left",
        "type" => 'hidden_input'
    ) ,
    array(
        "id" => "theme_toolbar_toggle",
        "default" => "true",
        "type" => 'hidden_input'
    ) ,
    
    array(
        "name" => __("Upload Logo (Dark & default)", "mk_framework") ,
        "desc" => __("This logo will be used when transparent header is enabled and your header skin is dark.", "mk_framework") ,
        "id" => "logo",
        "default" => "",
        "type" => "upload",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    array(
        "name" => __("Upload Logo (Light Skin)", "mk_framework") ,
        "desc" => __("This logo will be used when transparent header is enabled and your header is light skin.", "mk_framework") ,
        "id" => "light_logo",
        "default" => "",
        "type" => "upload",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    array(
        "name" => __("Upload Logo (Header Sticky State)", "mk_framework") ,
        "desc" => __("Use this option upload the sticky header logo.", "mk_framework") ,
        "id" => "sticky_header_logo",
        "default" => "",
        "type" => "upload",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    array(
        "name" => __("Upload Logo (Mobile Version)", "mk_framework") ,
        "desc" => __("Use this option to change your logo for mobile devices if your logo width is quite long to fit in mobile device screen.", "mk_framework") ,
        "id" => "responsive_logo",
        "default" => "",
        "type" => "upload",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Transparent Header", "mk_framework") ,
        "desc" => __("You can Enable/Disable transparent header capability using this option.", "mk_framework") ,
        "id" => "_transparent_header",
        "default" => 'false',
        "type" => "toggle",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    array(
        "name" => __("Enable Transparent Header Skin", "mk_framework") ,
        "desc" => __("If this option is enabled, transparent header background will be removed, main navigation as well as other header elements will be controlled by below option. Edge Slider and Edge One Pager shortcodes slides will also be able to control header skin. If disabled none of these will be applied to header background and its elements.", "mk_framework") ,
        "id" => "_trans_header_remove_bg",
        "default" => 'true',
        "type" => "toggle",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    array(
        "name" => __("Transparent header Skin", 'mk_framework') ,
        "desc" => __("Use this option to decide about the skin of transparent header.", 'mk_framework') ,
        "id" => "_transparent_header_skin",
        "default" => "light",
        "options" => array(
            "light" => __("Light", "mk_framework") ,
            "dark" => __("Dark", "mk_framework") ,
        ) ,
        "type" => "select",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    
    array(
        "name" => __('Transparent Header Bottom Border Color', 'mk_framework') ,
        "desc" => __("This border will appear in the bottom of the transparent header. Please note that this options has nothing to do with \"header bottom border\" and \"Header Border Bottom Color\" and this border will only appear in transparent header (will disappear in sticky header).", "mk_framework") ,
        "id" => "_trans_header_border_bottom",
        "default" => "",
        "type" => "color",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    array(
        "name" => __("Sticky Header Offset", "mk_framework") ,
        "desc" => __("Set this option to decide when the sticky state of header will trigger. This option does not apply to header style No2.", "mk_framework") ,
        "id" => "_sticky_header_offset",
        "default" => 'header',
        "options" => array(
            "header" => __('Header height', "mk_framework") ,
            "25%" => __('25% Of Viewport', "mk_framework") ,
            "30%" => __('30% Of Viewport', "mk_framework") ,
            "40%" => __('40% Of Viewport', "mk_framework") ,
            "50%" => __('50% Of Viewport', "mk_framework") ,
            "60%" => __('60% Of Viewport', "mk_framework") ,
            "70%" => __('70% Of Viewport', "mk_framework") ,
            "80%" => __('80% Of Viewport', "mk_framework") ,
            "90%" => __('90% Of Viewport', "mk_framework") ,
            "100%" => __('100% Of Viewport', "mk_framework") ,
        ) ,
        "type" => "select",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Choose between boxed and full width layout", 'mk_framework') ,
        "desc" => __("Choose between a full or a boxed layout to set how your website's layout will look like.", 'mk_framework') ,
        "id" => "background_selector_orientation",
        "default" => "full_width_layout",
        "options" => array(
            "boxed_layout" => 'boxed-layout',
            "full_width_layout" => 'full-width-layout'
        ) ,
        "type" => "visual_selector",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
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
        "type" => "range",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
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
        "type" => "range",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Background color & texture", 'mk_framework') ,
        "desc" => __("Please click on the different sections to modify their backgrounds.", 'mk_framework') ,
        "id" => 'general_backgounds',
        "type" => "general_background_selector",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    
    array(
        "id" => "body_color",
        "default" => "",
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
        "id" => "body_parallax",
        "default" => "false",
        "type" => 'hidden_input'
    ) ,
    
    array(
        "id" => "page_color",
        "default" => "",
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
        "id" => "page_parallax",
        "default" => "false",
        "type" => 'hidden_input'
    ) ,
    
    array(
        "id" => "header_color",
        "default" => "",
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
        "id" => "header_size",
        "default" => "false",
        "type" => 'hidden_input'
    ) ,    
    array(
        "id" => "header_image",
        "default" => "",
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
        "id" => "header_parallax",
        "default" => "false",
        "type" => 'hidden_input'
    ) ,
    
    array(
        "id" => "banner_color",
        "default" => "",
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
        "default" => "false",
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
        "id" => "banner_parallax",
        "default" => "false",
        "type" => 'hidden_input'
    ) ,
    
    array(
        "id" => "footer_color",
        "default" => "",
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
    array(
        "id" => "footer_parallax",
        "default" => "false",
        "type" => 'hidden_input'
    ) ,
    
    array(
        "name" => __('Page Title Color', 'mk_framework') ,
        "desc" => __("You can set the page title text color here.", "mk_framework") ,
        "id" => "_page_title_color",
        "default" => "",
        "type" => "color",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    
    array(
        "name" => __('Page Subtitle Color', 'mk_framework') ,
        "desc" => __("You can set the page subtitle text color here.", "mk_framework") ,
        "id" => "_page_subtitle_color",
        "default" => "",
        "type" => "color",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Breadcrumb Skin", "mk_framework") ,
        "desc" => __("You can set breadcrumbs skin for dark or light backgrounds.", "mk_framework") ,
        "id" => "_breadcrumb_skin",
        "default" => '',
        "options" => array(
            "light" => __('For Light Background', "mk_framework") ,
            "dark" => __('For Dark Background', "mk_framework")
        ) ,
        "type" => "select",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    ) ,
    
    array(
        "name" => __('Header Border Bottom Color', 'mk_framework') ,
        "desc" => __("You can set the color of bottom border of banner section.", "mk_framework") ,
        "id" => "_banner_border_color",
        "default" => "",
        "type" => "color",
        "dependency" => array(
            'element' => "_enable_local_backgrounds",
            'value' => array(
                'true',
            )
        ) ,
    )
);
new mkMetaboxesGenerator($config, $options);
