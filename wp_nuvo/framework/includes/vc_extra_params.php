<?php
add_action('init', 'cshero_vc_extra_param');

/* add extra param for vc shortcodes */
function cshero_vc_extra_param()
{
    // Adding stripes to rows
    vc_add_param("vc_row", array(
        "type" => "checkbox",
        "heading" => __('Responsive utilities', 'wp_nuvo'),
        "param_name" => "row_responsive_large",
        "value" => array(
            __("Hidden (Large devices)", 'wp_nuvo') => true
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    vc_add_param("vc_row", array(
        "type" => "checkbox",
        "heading" => '',
        "param_name" => "row_responsive_medium",
        "value" => array(
            __("Hidden (Medium devices)", 'wp_nuvo') => true
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    vc_add_param("vc_row", array(
        "type" => "checkbox",
        "heading" => '',
        "param_name" => "row_responsive_small",
        "value" => array(
            __("Hidden (Small devices)", 'wp_nuvo') => true
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    vc_add_param("vc_row", array(
        "type" => "checkbox",
        "heading" => '',
        "param_name" => "row_responsive_extra_small",
        "value" => array(
            __("Hidden (Extra small devices)", 'wp_nuvo') => true
        ),
        "description" => __("For faster mobile-friendly development, use these utility classes for showing and hiding content by device via media query.", 'wp_nuvo'),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    vc_add_param("vc_row", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("ID Name for Navigation", 'wp_nuvo'),
        "param_name" => "dt_id",
        "value" => "",
        "description" => __("If this row wraps the content of one of your sections, set an ID. You can then use it for navigation. Ex: work", 'wp_nuvo'),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    vc_add_param("vc_row", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Row style", 'wp_nuvo'),
        "admin_label" => true,
        "param_name" => "type",
        "value" => array(
            "Default" => "",
            "Custom" => "ww-custom",
            "Row Border" => "row-border",
            "Row Border Top" => "row-border-top",
            "Row Border Bottom" => "row-border-bottom",
            "Column No Padding" => "col-no-padding",
            "Border Column Gray" => "cs-border-column",
            "Cover Slider" => "cs-cover-slider-events"
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    vc_add_param("vc_row", array(
        "type" => "checkbox",
        "heading" => __('Effect Backgound', 'wp_nuvo'),
        "param_name" => "row_effect_backgound",
        "value" => array(
            __("Effect backgound", 'wp_nuvo') => true
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    vc_add_param('vc_row', array(
        'type' => 'dropdown',
        'heading' => "Full Width",
        'param_name' => 'full_width',
        'value' => array(
            "No" => "false",
            "Yes" => "true"
        ),
        'description' => "Only activated on main layout full width",
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Heading color", 'wp_nuvo'),
        "param_name" => "row_head_color",
        "value" => "",
        "description" => __("Select color for head.", 'wp_nuvo'),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Link color", 'wp_nuvo'),
        "param_name" => "row_link_color",
        "value" => "",
        "description" => __("Select color for link.", 'wp_nuvo'),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Link color hover", 'wp_nuvo'),
        "param_name" => "row_link_color_hover",
        "value" => "",
        "description" => __("Select color for link hover.", 'wp_nuvo'),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row", array(
        "type" => "checkbox",
        "class" => "",
        "heading" => __("Same height", 'wp_nuvo'),
        "param_name" => "same_height",
        "value" => array(
            "" => 'true'
        ),
        "description" => __("Set the same hight for all column in this row.", 'wp_nuvo'),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row_inner", array(
        "type" => "checkbox",
        "class" => "",
        "heading" => __("Same height", 'wp_nuvo'),
        "param_name" => "same_height",
        "value" => array(
            "" => 'true'
        ),
        "description" => __("Set the same hight for all column in this row.", 'wp_nuvo'),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Animation", 'wp_nuvo'),
        "admin_label" => true,
        "param_name" => "animation",
        "value" => array(
            "None" => "",
            "Left" => "right-to-left",
            "Right" => "left-to-right",
            "Top" => "bottom-to-top",
            "Bottom" => "top-to-bottom",
            "Scale" => "scale-up",
            "Fade" => "fade-in"
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row", array(
        "type" => "checkbox",
        "class" => "",
        "heading" => __("Enable parallax", 'wp_nuvo'),
        "param_name" => "enable_parallax",
        "value" => array(
            "" => "false"
        ),
        "dependency" => array(
            "element" => "type",
            "value" => array(
                "ww-custom"
            )
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Background ratio", 'wp_nuvo'),
        "param_name" => "parallax_speed",
        "value" => "0.8",
        "dependency" => array(
            "element" => "type",
            "value" => array(
                "ww-custom"
            )
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Overlay Color", 'wp_nuvo'),
        "param_name" => "bg_video_color",
        "value" => "",
        "dependency" => array(
            "element" => "type",
            "not_empty" => true
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Overlay Opacity", 'wp_nuvo'),
        "param_name" => "bg_video_transparent",
        "value" => "0",
        "dependency" => array(
            "element" => "type",
            "not_empty" => true
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Video background (mp4)", 'wp_nuvo'),
        "param_name" => "bg_video_src_mp4",
        "value" => "",
        "dependency" => array(
            "element" => "type",
            "not_empty" => true
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Video background (ogv)", 'wp_nuvo'),
        "param_name" => "bg_video_src_ogv",
        "value" => "",
        "dependency" => array(
            "element" => "type",
            "not_empty" => true
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    
    vc_add_param("vc_row", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Video background (webm)", 'wp_nuvo'),
        "param_name" => "bg_video_src_webm",
        "value" => "",
        "dependency" => array(
            "element" => "type",
            "not_empty" => true
        ),
        'group' => esc_html__('Theme Options', 'wp_nuvo')
    ));
    /* vc column */
    vc_add_param("vc_column", array(
        "type" => "checkbox",
        "heading" => __('Responsive utilities', 'wp_nuvo'),
        "param_name" => "column_responsive_large",
        "value" => array(
            __("Hidden (Large devices)", 'wp_nuvo') => true
        )
    ));
    vc_add_param("vc_column", array(
        "type" => "checkbox",
        "heading" => '',
        "param_name" => "column_responsive_medium",
        "value" => array(
            __("Hidden (Medium devices)", 'wp_nuvo') => true
        )
    ));
    vc_add_param("vc_column", array(
        "type" => "checkbox",
        "heading" => '',
        "param_name" => "column_responsive_small",
        "value" => array(
            __("Hidden (Small devices)", 'wp_nuvo') => true
        )
    ));
    vc_add_param("vc_column", array(
        "type" => "checkbox",
        "heading" => '',
        "param_name" => "column_responsive_extra_small",
        "value" => array(
            __("Hidden (Extra small devices)", 'wp_nuvo') => true
        ),
        "description" => __("For faster mobile-friendly development, use these utility classes for showing and hiding content by device via media query.", 'wp_nuvo')
    ));
    vc_add_param("vc_column", array(
        "type" => "checkbox",
        "heading" => 'VC Row 2 Column',
        "param_name" => "column_2_responsive",
        "value" => array(
            __("Yes", 'wp_nuvo') => true
        )
    ));
    vc_add_param("vc_column", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Animation", 'wp_nuvo'),
        "admin_label" => true,
        "param_name" => "animation",
        "value" => array(
            "None" => "",
            "Left" => "right-to-left",
            "Right" => "left-to-right",
            "Top" => "bottom-to-top",
            "Bottom" => "top-to-bottom",
            "Scale" => "scale-up",
            "Fade" => "fade-in"
        )
    ));
    
    vc_add_param("vc_column", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Text Align", 'wp_nuvo'),
        "admin_label" => true,
        "param_name" => "text_align",
        "value" => array(
            "None" => "",
            "Inherit" => "inherit",
            "Initial" => "initial",
            "Justify" => "justify",
            "Left" => "left",
            "Right" => "right",
            "Center" => "center",
            "Start" => "start",
            "End" => "end"
        )
    ));
    vc_add_param("vc_column", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Column Heading Style", 'wp_nuvo'),
        "admin_label" => true,
        "param_name" => "column_style",
        "value" => array(
            "Default" => "",
            "Title Primary Color" => "title-preset1",
            "Title Secondary Color" => "title-preset2",
            "Title Line Bottom" => "title-line-bottom"
        ),
        "description" => __("Add some styles to column", 'wp_nuvo')
    ));
    /*
     * Separator
     */
    vc_remove_param('vc_separator', 'el_class');
    vc_add_param("vc_separator", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Style Border Width", 'wp_nuvo'),
        "param_name" => "border_width",
        "value" => "1",
        "description" => "Defualt 1"
    ));
    vc_add_param("vc_separator", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Show Arrow", 'wp_nuvo'),
        "param_name" => "separator_arrow",
        "value" => array(
            "No" => "no",
            "Yes" => "yes"
        )
    ));
    vc_add_param("vc_separator", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Arrow Width", 'wp_nuvo'),
        "param_name" => "arrow_width",
        "value" => "12",
        "description" => "Set Width for Arrow (Defualt 12)"
    ));
    vc_add_param("vc_separator", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Arrow Color", 'wp_nuvo'),
        "param_name" => "arrow_color",
        "value" => ""
    ));
    /* accordion */
    vc_add_param("vc_accordion_tab", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Icon", 'wp_nuvo'),
        "param_name" => "icon",
        "value" => "",
        "description" => __('You can find icon class at here: <a target="_blank" href="http://fontawesome.io/icons/">"http://fontawesome.io/icons/</a>. For example, fa fa-heart', 'wp_nuvo')
    ));
    vc_add_param("vc_accordion", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Style", 'wp_nuvo'),
        "param_name" => "style",
        "value" => array(
            'Style 1' => 'style1',
            'Style 2' => 'style2',
            'Style 3' => 'style3',
            'Style 4' => 'style4',
            'Style 5' => 'style5'
        )
    ));
    /* VC Button */
    vc_remove_param('vc_button', 'color');
    vc_remove_param('vc_button', 'icon');
    vc_remove_param('vc_button', 'size');
    vc_add_param("vc_button", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Button Type", 'wp_nuvo'),
        "param_name" => "type",
        "value" => array(
            'Button Default' => 'btn btn-default',
            'Button Primary' => 'btn btn-primary',
            'Button Default Alt' => 'btn btn-default-alt',
            'Button Primary Alt' => 'btn btn-primary-alt',
            'Button Warning' => 'btn btn-warning',
            'Button Danger' => 'btn btn-danger',
            'Button Success' => 'btn btn-success',
            'Button Info' => 'btn btn-info',
            'Button Inverse' => 'btn btn-inverse'
        )
    ));
    $size_arr = array(
        __('Default', 'wp_nuvo') => '',
        __('Large', 'wp_nuvo') => 'btn-large',
        __('Medium', 'wp_nuvo') => 'btn-medium',
        __('Small', 'wp_nuvo') => "btn-small"
    );
    vc_add_param("vc_button", array(
        'type' => 'dropdown',
        'heading' => __('Size', 'wp_nuvo'),
        'param_name' => 'size',
        'value' => $size_arr,
        'description' => __('Button size.', 'wp_nuvo')
    ));
    vc_add_param("vc_button", array(
        "type" => "checkbox",
        "class" => "",
        "heading" => __("Button Block", 'wp_nuvo'),
        "param_name" => "button_block",
        "value" => array(
            "" => "true"
        ),
        "description" => __("Yes, please.", 'wp_nuvo')
    ));
}
/*
 * Contact form-7
 */
if (shortcode_exists('contact-form-7')) {
    vc_add_param("contact-form-7", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Contact Style", 'wp_nuvo'),
        "param_name" => "html_class",
        "value" => array(
            'Style 1' => 'contact-style-1',
            'Style 2' => 'contact-style-2'
        )
    ));
}
