<?php
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_button2");
add_action('init', 'cshero_vc_extra_param');

/* add extra param for vc shortcodes */
function cshero_vc_extra_param()
{
    global $post, $button_type;

    if (function_exists('vc_add_param')) {
        /* remove default vc params */
        vc_remove_param('vc_row','gap');
        vc_remove_param('vc_row','full_height');
        vc_remove_param('vc_row','equal_height');
        vc_remove_param('vc_row','content_placement');
        vc_remove_param('vc_row','video_bg');
        vc_remove_param('vc_row','parallax');
        vc_remove_param('vc_row','parallax_image');
        vc_remove_param('vc_row','columns_placement');
        vc_remove_param('vc_row','video_bg_url');
        vc_remove_param('vc_row','video_bg_parallax');
        vc_remove_param('vc_row','el_id');
        // Adding stripes to rows
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "heading" => __('Responsive utilities', THEMENAME),
            "param_name" => "row_responsive_large",
            "value" => array(
                __("Hidden (Large devices)", THEMENAME) => true
            ),
            "group" => __("Responsive", THEMENAME)
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "heading" => '',
            "param_name" => "row_responsive_medium",
            "value" => array(
                __("Hidden (Medium devices)", THEMENAME) => true
            ),
            "group" => __("Responsive", THEMENAME)
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "heading" => '',
            "param_name" => "row_responsive_small",
            "value" => array(
                __("Hidden (Small devices)", THEMENAME) => true
            ),
            "group" => __("Responsive", THEMENAME)
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "heading" => '',
            "param_name" => "row_responsive_extra_small",
            "value" => array(
                __("Hidden (Extra small devices)", THEMENAME) => true
            ),
            "group" => __("Responsive", THEMENAME),
            "description" => __("For faster mobile-friendly development, use these utility classes for showing and hiding content by device via media query.", THEMENAME)
        ));
        vc_add_param("vc_row", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("ID Name for Navigation", THEMENAME),
            "param_name" => "dt_id",
            "value" => "",
            "group" => __("One Page", THEMENAME),
            "description" => __("If this row wraps the content of one of your sections, set an ID. You can then use it for navigation. Ex: work", THEMENAME)
        ));
        vc_add_param('vc_row', array(
            'type' => 'dropdown',
            'heading' => "Full Width",
            'param_name' => 'full_width',
            'value' => array(
                "No" => "false",
                "Yes" => "true"
            ),
            'description' => "Only activated on main layout full width"
        ));
        vc_add_param("vc_row", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color", THEMENAME),
            "param_name" => "row_text_color",
            "value" => "",
            "description" => __("Select color for text.", THEMENAME)
        ));
        vc_add_param("vc_row", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading color", THEMENAME),
            "param_name" => "row_head_color",
            "value" => "",
            "description" => __("Select color for head.", THEMENAME)
        ));
        vc_add_param("vc_row", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Link color", THEMENAME),
            "param_name" => "row_link_color",
            "value" => "",
            "description" => __("Select color for link.", THEMENAME)
        ));
        vc_add_param("vc_row", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Link color hover", THEMENAME),
            "param_name" => "row_link_color_hover",
            "value" => "",
            "description" => __("Select color for link hover.", THEMENAME)
        ));

        vc_add_param("vc_row_inner", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Same height", THEMENAME),
            "param_name" => "same_height",
            "value" => array(
                "" => 'true'
            ),
            "description" => __("Set the same hight for all column in this row.", THEMENAME)
        ));

        vc_add_param("vc_row", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Animation", THEMENAME),
            "admin_label" => true,
            "param_name" => "animation",
            "value" => array(
                "None" => "",
                "Right To Left" => "right-to-left",
                "Left To Right" => "left-to-right",
                "Bottom To Top" => "bottom-to-top",
                "Top To Bottom" => "top-to-bottom",
                "Scale Up" => "scale-up",
                "Fade In" => "fade-in"
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Row style", THEMENAME),
            "admin_label" => true,
            "param_name" => "type",
            "value" => array(
                "Default" => "",
                "Custom" => "ww-custom"
            ),
            "group" => __("Style", THEMENAME)
        ));
        vc_add_param("vc_row", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Enable Triangle", THEMENAME),
            "param_name" => "enable_triangle",
            "value" => array(
                'No' => '0',
                'Yes' => '1' 
            ),
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Triangle Position", THEMENAME),
            "param_name" => "triangle_pos",
            "value" => array(
                'Top Center' => 'top',
                'Bottom Center' => 'bottom',
                'Top & Bottom Center' => 'top bottom'
            ),
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "enable_triangle",
                "value" => array(
                    "1"
                )
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Triangle Color", THEMENAME),
            "param_name" => "triangle_color",
            "value" => '',
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "enable_triangle",
                "value" => array(
                    "1"
                )
            )
        ));

        vc_add_param("vc_row", array(
            "type" => "dropdown",
            "heading" => __("Background Attachment", THEMENAME),
            "param_name" => "bg_attachment",
            "value" => array(''=>'', 'Scroll' => 'scroll', 'Fixed' => 'fixed', 'Local' => 'local','Initial' => 'initial','Inherit' => 'inherit'),
            "group" => __("Design Options", THEMENAME),
        ));
        
        vc_add_param("vc_row", array(
            "type" => "dropdown",
            "heading" => __("Background Repeat", THEMENAME),
            "param_name" => "bg_repeat",
            "value" => array(''=>'', 'No-Repeat' => 'no-repeat', 'Repeat' => 'repeat', 'Repeat-X' => 'repeat-x','Repeat-Y' => 'repeat-y'),
            "group" => __("Design Options", THEMENAME),
        ));
        
        

        vc_add_param("vc_row", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Overlay Color", THEMENAME),
            "param_name" => "bg_video_color",
            "value" => "",
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));

        vc_add_param("vc_row", array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __("Video poster", THEMENAME),
            "param_name" => "poster",
            "value" => "",
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Loop", THEMENAME),
            "param_name" => "loop",
            "value" => array(
                __("Yes, please", THEMENAME) => true
            ),
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Autoplay", THEMENAME),
            "param_name" => "autoplay",
            "value" => array(
                __("Yes, please", THEMENAME) => true
            ),
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Muted", THEMENAME),
            "param_name" => "muted",
            "value" => array(
                __("Yes, please", THEMENAME) => true
            ),
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Controls", THEMENAME),
            "param_name" => "controls",
            "value" => array(
                __("Yes, please", THEMENAME) => true
            ),
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Show Button Play", THEMENAME),
            "param_name" => "show_btn",
            "value" => array(
                __("Yes, please", THEMENAME) => true
            ),
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Video background (mp4)", THEMENAME),
            "param_name" => "bg_video_src_mp4",
            "value" => "",
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));

        vc_add_param("vc_row", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Video background (ogv)", THEMENAME),
            "param_name" => "bg_video_src_ogv",
            "value" => "",
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));

        vc_add_param("vc_row", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Video background (webm)", THEMENAME),
            "param_name" => "bg_video_src_webm",
            "value" => "",
            "group" => __("Style", THEMENAME),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));
        /* vc column */
        vc_add_param("vc_column", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Animation", THEMENAME),
            "admin_label" => true,
            "param_name" => "animation",
            "value" => array(
                "None" => "",
                "Right To Left" => "right-to-left",
                "Left To Right" => "left-to-right",
                "Bottom To Top" => "bottom-to-top",
                "Top To Bottom" => "top-to-bottom",
                "Scale Up" => "scale-up",
                "Fade In" => "fade-in"
            )
        ));

        vc_add_param("vc_column", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Text Align", THEMENAME),
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
            "heading" => __("Column Heading Style", THEMENAME),
            "admin_label" => true,
            "param_name" => "column_style",
            "value" => array(
                "Default" => "",
                "Title Primary Color" => "title-preset1",
                "Title Secondary Color" => "title-preset2",
                "Title Feature Box" => "title-feature-box"
            ),
            "description" => __("Add some styles to column", THEMENAME)
        ));

        vc_add_param("vc_column", array(
            "type" => "dropdown",
            "heading" => __("Background Attachment", THEMENAME),
            "param_name" => "bg_attachment",
            "value" => array(''=>'', 'scroll' => 'Scroll', 'fixed' => 'Fixed', 'local' => 'Local','initial' => 'Initial','inherit' => 'Inherit'),
            "group" => __("Design Options", THEMENAME),
        ));
        
        vc_add_param("vc_column", array(
            "type" => "dropdown",
            "heading" => __("Background Repeat", THEMENAME),
            "param_name" => "bg_repeat",
            "value" => array(''=>'', 'no-repeat' => 'No-Repeat', 'repeat' => 'Repeat', 'repeat-x' => 'Repeat-X','repeat-y' => 'Repeat-Y'),
            "group" => __("Design Options", THEMENAME),
        ));
        // Pie chart
        vc_add_param("vc_pie", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Heading size", THEMENAME),
            "param_name" => "heading_size",
            "value" => array(
                "Default" => "h4",
                "Heading 1" => "h1",
                "Heading 2" => "h2",
                "Heading 3" => "h3",
                "Heading 4" => "h4",
                "Heading 5" => "h5",
                "Heading 6" => "h6"
            ),
            "description" => 'Select your heading size for title.',
            'group' => 'Extra Option'
        ));
        vc_add_param("vc_pie", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __('Title Color', THEMENAME),
            "param_name" => "title_color",
            'group' => 'Extra Option'
        ));
        vc_add_param("vc_pie", array(
            'type' => 'textfield',
            'heading' => __('Pie icon', THEMENAME),
            'param_name' => 'icon',
            'value' => '',
            'admin_label' => true,
            'group' => 'Extra Option'
        ));
        vc_add_param("vc_pie", array(
            'type' => 'textfield',
            'heading' => __('Icon Size', THEMENAME),
            'param_name' => 'icon_size',
            'description' => __('Font size of icon', THEMENAME),
            'value' => '24',
            'admin_label' => true,
            'group' => 'Extra Option'
        ));
        vc_add_param("vc_pie", array(
            'type' => 'colorpicker',
            'heading' => __('Icon Color', THEMENAME),
            'param_name' => 'icon_color',
            'value' => '#888',
            'admin_label' => true,
            'group' => 'Extra Option'
        ));
        vc_remove_param("vc_pie", "color");
        vc_add_param("vc_pie", array(
            'type' => 'colorpicker',
            'heading' => __('Bar color ', THEMENAME),
            'param_name' => 'color',
            'value' => '',
            'description' => __('Select pie chart color.', THEMENAME),
            'group' => 'Extra Option'
        ));
        vc_add_param("vc_pie", array(
            'type' => 'colorpicker',
            'heading' => __('Bar color background', THEMENAME),
            'param_name' => 'color_bg',
            'value' => '',
            'description' => __('Select pie chart color background.', THEMENAME),
            'group' => 'Extra Option'
        ));
        vc_add_param("vc_pie", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bar Width", THEMENAME),
            "param_name" => "pie_width",
            "value" => "12",
            'group' => 'Extra Option'
        ));
        vc_add_param("vc_pie", array(
            "type" => "textarea",
            "class" => "",
            "heading" => __("Description", THEMENAME),
            "param_name" => "desc",
            "value" => "",
            'group' => 'Extra Option'
        ));
        vc_add_param("vc_pie", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Style", THEMENAME),
            "param_name" => "style",
            "value" => array(
                "Style 1" => "1",
                "Style 2" => "2",
                "Style 3" => "3"
            ),
            "description" => __("Select style for pie.", THEMENAME),
            "admin_label" => true,
            'group' => 'Extra Option'
        ));
        vc_add_param("vc_pie", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Icon", THEMENAME),
            "param_name" => "icon",
            "value" => "",
            "description" => __('You can find icon class at here: <a target="_blank" href="http://fontawesome.io/icons/">"http://fontawesome.io/icons/</a>. For example, fa fa-heart', THEMENAME),
            'group' => 'Extra Option'
        ));
        /*
         * Separator
         */
        vc_remove_param('vc_separator', 'el_class');
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Style Border Width", THEMENAME),
            "param_name" => "border_width",
            "value" => "1",
            "description" => "Defualt 1"
        ));
        vc_add_param("vc_separator", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Show Arrow", THEMENAME),
            "param_name" => "separator_arrow",
            "value" => array(
                "No" => "no",
                "Yes" => "yes"
            ),
            "group" => __("Arrow", THEMENAME)
        ));
        vc_add_param("vc_separator", array(
            "type" => "dropdown",
            "heading" => __("Arrow Type", THEMENAME),
            "param_name" => "separator_arrow_type",
            "value" => array(
                "Border" => "border",
                "Image" => "image",
                "Icon" => "icon"
            ),
            "group" => __("Arrow", THEMENAME),
            "dependency" => array(
                "element" => 'separator_arrow',
                "value" => array(
                    "yes"
                )
            )
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Arrow Width", THEMENAME),
            "param_name" => "arrow_width",
            "value" => "12",
            "group" => __("Arrow", THEMENAME),
            "dependency" => array(
                "element" => 'separator_arrow',
                "value" => array(
                    "yes"
                )
            ),
            "description" => "Set Width for Arrow (Default 12)"
        ));
        vc_add_param("vc_separator", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Arrow Color", THEMENAME),
            "param_name" => "arrow_color",
            "dependency" => array(
                "element" => 'separator_arrow',
                "value" => array(
                    "yes"
                )
            ),
            "group" => __("Arrow", THEMENAME)
        ));
        vc_add_param("vc_separator", array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __("Arrow Image", THEMENAME),
            "param_name" => "arrow_image",
            "value" => "",
            "group" => __("Arrow", THEMENAME),
            "dependency" => array(
                "element" => 'separator_arrow_type',
                "value" => array(
                    "image"
                )
            )
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Icon Class", THEMENAME),
            "param_name" => "icon_class",
            "group" => __("Arrow", THEMENAME),
            "dependency" => array(
                "element" => 'separator_arrow_type',
                "value" => array(
                    "icon"
                )
            )
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Width (px)", THEMENAME),
            "param_name" => "icon_width",
            "group" => __("Arrow", THEMENAME)
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Height (px)", THEMENAME),
            "param_name" => "icon_height",
            "group" => __("Arrow", THEMENAME)
        ));
        vc_add_param("vc_separator", array(
            "type" => "colorpicker",
            "heading" => __("Background Color", THEMENAME),
            "param_name" => "icon_bg",
            "group" => __("Arrow", THEMENAME)
        ));
        vc_add_param("vc_separator", array(
            "type" => "colorpicker",
            "heading" => __("Border Color", THEMENAME),
            "param_name" => "icon_border_color",
            "group" => __("Arrow", THEMENAME)
        ));
        vc_add_param("vc_separator", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Border Style", THEMENAME),
            "param_name" => "icon_border_style",
            "value" => array(
                "none" => "none",
                "dotted" => "dotted",
                "dashed" => "dashed",
                "solid" => "solid",
                "double" => "double"
            ),
            "group" => __("Arrow", THEMENAME)
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Border Width (px)", THEMENAME),
            "param_name" => "icon_border_width",
            "group" => __("Arrow", THEMENAME)
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Border Radius (px)", THEMENAME),
            "param_name" => "icon_border_radius",
            "group" => __("Arrow", THEMENAME)
        ));
        vc_add_param("vc_separator", array(
            "type" => "dropdown",
            "heading" => __("Enable Back To Top", THEMENAME),
            "param_name" => "separator_arrow_type_link",
            "group" => __("Extra", THEMENAME),
            "value" => array(
                "No" => "0",
                "Yes" => "1",
            )
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Back to section ID", THEMENAME),
            "param_name" => "separator_arrow_type_link_id",
            "group" => __("Extra", THEMENAME),
            "description" => "Enter section ID name you want back link to.",
            "dependency" => array(
                "element" => 'separator_arrow_type_link',
                "value" => array(
                    "1"
                )
            )
        ));
        /*
         * Separator with Text
         */
        vc_add_param("vc_text_separator", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Style Border Width", THEMENAME),
            "param_name" => "border_width",
            "value" => "1px 0 0 0",
            "description" => "Enter border width style for Top/Right/Bottom/Left. Default is 1px 0 0 0"
        ));

        vc_add_param("vc_text_separator", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading Color", THEMENAME),
            "param_name" => "heading_font_color",
            "value" => "",
            "description" => ""
        ));
        vc_add_param("vc_text_separator", array(
            "type" => "dropdown",
            "heading" => __("Heading size", THEMENAME),
            "param_name" => "heading_size",
            "value" => array(
                "Heading 1" => "h1",
                "Heading 2" => "h2",
                "Heading 3" => "h3",
                "Heading 4" => "h4",
                "Heading 5" => "h5",
                "Heading 6" => "h6",
                "Div"       => 'div'
            ),
            "description" => 'Select your heading size for text.'
        ));
        vc_add_param("vc_text_separator", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Heading Font size", THEMENAME),
            "param_name" => "heading_font_size",
            "value" => "",
            "description" => ""
        ));
        vc_add_param("vc_text_separator", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Text Transform", THEMENAME),
            "param_name" => "text_transform",
            "value" => array(
                "None" => "",
                "Lowercase" => "lowercase",
                "Uppercase" => "uppercase"
            ),
            "description" => "Uppercase & Lowercase for Text"
        ));

        vc_add_param("vc_text_separator", array(
            "type" => "textarea_html",
            "class" => "",
            "heading" => __("Description", THEMENAME),
            "param_name" => "desc",
            "value" => "",
            "description" => ""
        ));
        /* accordion */
        vc_add_param("vc_accordion_tab", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Icon", THEMENAME),
            "param_name" => "icon",
            "value" => "",
            "description" => __('You can find icon class at here: <a target="_blank" href="http://fontawesome.io/icons/">"http://fontawesome.io/icons/</a>. For example, fa fa-heart', THEMENAME)
        ));
        vc_add_param("vc_accordion_tab", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title Color", THEMENAME),
            "param_name" => "title_color"
        ));
        vc_add_param("vc_accordion_tab", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background Tab", THEMENAME),
            "param_name" => "background_tab"
        ));
        vc_add_param("vc_accordion_tab", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background Content", THEMENAME),
            "param_name" => "background_content"
        ));
        vc_add_param("vc_accordion_tab", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title Active Color", THEMENAME),
            "param_name" => "title_active_color"
        ));
        vc_add_param("vc_accordion_tab", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background Tab Active", THEMENAME),
            "param_name" => "background_tab_active"
        ));
        vc_add_param("vc_accordion", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Item Margin Bottom", THEMENAME),
            "param_name" => "item_margin_bottom",
            "value" => '',
            "description" => __('margin bottom each accordion tab. Ex: 10px', THEMENAME)
        ));
        vc_add_param("vc_accordion", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Item Border", THEMENAME),
            "param_name" => "item_border",
            "value" => '',
            "description" => __('Border of each accordion tab. Ex: 1px solid #444', THEMENAME)
        ));
        vc_add_param("vc_accordion", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Title Align", THEMENAME),
            "param_name" => "title_align",
            "value" => array(
                'Left' => 'left',
                'Right' => 'right',
                'Center' => 'center'
            )
        ));

        /* VC Button */            
        vc_remove_param('vc_button', 'color');
        vc_remove_param('vc_button', 'icon');
        vc_remove_param('vc_button', 'size');
        
        vc_add_param("vc_button", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Button Type", THEMENAME),
            "param_name" => "type",
            "value" => $button_type,
            "admin_label" => true
        ));
        $size_arr = array(
            __('Default', THEMENAME) => 'btn btn-default',
            __('Large', THEMENAME) => 'btn-lg btn-large',
            __('Medium', THEMENAME) => 'btn-md btn-medium',
            __('Small', THEMENAME) => 'btn-sm btn-small',
            __('Mini', THEMENAME) => "btn-xs btn-mini"
        );
        vc_add_param("vc_button", array(
            'type' => 'dropdown',
            'heading' => __('Size', THEMENAME),
            'param_name' => 'size',
            'value' => $size_arr,
            'description' => __('Button size.', THEMENAME)
        ));
        vc_add_param("vc_button", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Button Block", THEMENAME),
            "param_name" => "button_block",
            "value" => array(
                __('No', THEMENAME) => '0',
                __('Yes', THEMENAME) => '1'
                
            ),
        ));
        /* VC Tab */
        vc_add_param("vc_tab", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Icon", THEMENAME),
            "param_name" => "icon_title",
            "value" => "",
            "description"=>__('You can find icon class at here: <a target="_blank" href="http://fontawesome.io/icons/">"http://fontawesome.io/icons/</a>. For example, fa fa-heart', THEMENAME)
        ));

        /*
         * Contact form-7
         */
        vc_add_param("contact-form-7", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Contact Style", THEMENAME),
            "param_name" => "html_class",
            "value" => array(
                'Default' => 'default',
                'Style 1' => 'contact-style-1',
                'Style 2' => 'contact-style-2',
                'Style 3' => 'contact-style-3',
                'Style 4' => 'contact-style-4',
                'Style 5' => 'contact-style-5'
            )
        ));
    }
}
// intergrate VC
cs_integrateWithVC();

function cs_integrateWithVC()
{
    $vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;
    /*
     * Tabs ----------------------------------------------------------
     */
    $tab_id_1 = time() . '-1-' . rand(0, 100);
    $tab_id_2 = time() . '-2-' . rand(0, 100);
    vc_map(array(
        "name" => __('Tabs', THEMENAME),
        'base' => 'vc_tabs',
        'show_settings_on_create' => false,
        'is_container' => true,
        'icon' => 'icon-wpb-ui-tab-content',
        'category' => __('Content', THEMENAME),
        'description' => __('Tabbed content', THEMENAME),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Widget title', THEMENAME),
                'param_name' => 'title',
                'description' => __('Enter text which will be used as widget title. Leave blank if no title is needed.', THEMENAME)
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Auto rotate tabs', THEMENAME),
                'param_name' => 'interval',
                'value' => array(
                    __('Disable', THEMENAME) => 0,
                    3,
                    5,
                    10,
                    15
                ),
                'std' => 0,
                'description' => __('Auto rotate tabs each X seconds.', THEMENAME)
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Tab Color', THEMENAME),
                'param_name' => 'tab_color',
                'std' => '#444'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Tab Color Active', THEMENAME),
                'param_name' => 'tab_color_active',
                'std' => '#444'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Tab Background Color', THEMENAME),
                'param_name' => 'tab_background_color'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Tab Background Color Active', THEMENAME),
                'param_name' => 'tab_background_color_active'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', THEMENAME),
                'param_name' => 'el_class',
                'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', THEMENAME)
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'heading' => __('Style', THEMENAME),
                'value' => array(
                    "Style 1" => "style1",
                    "Style 2" => "style2",
                    "Style 3" => "style3",
                    "Style 4" => "style4",
                    "Style 5" => "style5",
                ),
                'std' => 'style1'
            )
        ),
        'custom_markup' => '
	<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
	<ul class="tabs_controls">
	</ul>
	%content%
	</div>',
        'default_content' => '
	[vc_tab title="' . __('Tab 1', THEMENAME) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
	[vc_tab title="' . __('Tab 2', THEMENAME) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
	',
        'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35'
    ));
    /*
     * Call to Action Button ----------------------------------------------------------
     */
    $target_arr = array(
        __('Same window', THEMENAME) => '_self',
        __('New window', THEMENAME) => "_blank"
    );
    $button_type = array(
        __('Button Default', THEMENAME) => 'btn btn-default',
        __('Button Default Alt', THEMENAME) => 'btn btn-default-alt',
        __('Button Default White', THEMENAME) => 'btn btn-white',
        __('Button Border', THEMENAME) => 'btn btn-border',
        __('Button Border White', THEMENAME) => 'btn btn-border-white',
        __('Button Primary', THEMENAME) => 'btn btn-primary',
        __('Button Primary Alt', THEMENAME) => 'btn btn-primary-alt',
        __('Button Primary Alt White', THEMENAME) => 'btn btn-primary-alt btn-white',
        __('Button Warning', THEMENAME) => 'btn btn-warning',
        __('Button Danger', THEMENAME) => 'btn btn-danger',
        __('Button Success', THEMENAME) => 'btn btn-success',
        __('Button Info', THEMENAME) => 'btn btn-info',
        __('Button Inverse', THEMENAME) => 'btn btn-inverse' 
    );

    $size_arr = array(
        __('Default', THEMENAME) => 'btn btn-default',
        __('Large', THEMENAME) => 'btn-lg btn-large',
        __('Medium', THEMENAME) => 'btn-md btn-medium',
        __('Small', THEMENAME) => 'btn-sm btn-small',
        __('Mini', THEMENAME) => "btn-xs btn-mini"
    );
    vc_map(array(
        'name' => __('Call to Action Button', THEMENAME),
        'base' => 'vc_cta_button',
        'icon' => 'icon-wpb-call-to-action',
        'category' => __('Content', THEMENAME),
        'description' => __('Catch visitors attention with CTA block', THEMENAME),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Icon', THEMENAME),
                'param_name' => 'call_icon',
                'description' => __('Font Awesome.', THEMENAME)
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Icon size', THEMENAME),
                'param_name' => 'call_icon_size',
                'description' => __('Icon on font size px.', THEMENAME)
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Icon color', THEMENAME),
                'param_name' => 'call_icon_color',
                'description' => __('Icon on color.', THEMENAME)
            ),
            array(
                'type' => 'textarea',
                'admin_label' => true,
                'heading' => __('Title', THEMENAME),
                'param_name' => 'call_text',
                'value' => __('Click edit button to change this text.', THEMENAME),
                'description' => __('Enter your content.', THEMENAME)
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Title heading size', THEMENAME),
                'param_name' => 'call_text_heading_size',
                'description' => __('Choose heading style.', THEMENAME),
                'value'  => array(
                    'Span' => 'span',
                    'H1' => 'h1',
                    'H2' => 'h2',
                    'H3' => 'h3',
                    'H4' => 'h4',
                    'H5' => 'h5',
                    'H6' => 'h6',
                    'Div' => 'div',
                    'Span' => 'span',
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title font size', THEMENAME),
                'param_name' => 'call_text_font_size',
                'description' => __('Text on font size px.', THEMENAME)
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title color', THEMENAME),
                'param_name' => 'call_text_color',
                'description' => __('Text on color.', THEMENAME)
            ),
            array(
                'type' => 'textarea',
                'admin_label' => true,
                'heading' => __('Sub Text', THEMENAME),
                'param_name' => 'call_sub_text',
                'value' => __('Click edit button to change this text.', THEMENAME),
                'description' => __('Enter your content.', THEMENAME)
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Text on the button', THEMENAME),
                'param_name' => 'title',
                'value' => __('Text on the button', THEMENAME),
                'description' => __('Text on the button.', THEMENAME)
            ),
            array(
                'type' => 'textfield',
                'heading' => __('URL (Link)', THEMENAME),
                'param_name' => 'href',
                'description' => __('Button link.', THEMENAME)
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Target', THEMENAME),
                'param_name' => 'target',
                'value' => $target_arr,
                'dependency' => array(
                    'element' => 'href',
                    'not_empty' => true
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Button Type ', THEMENAME),
                'param_name' => 'button_type',
                'value' => $button_type,
                'description' => __('Button Type.', THEMENAME),
                'param_holder_class' => 'vc-button-type-dropdown'
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Button size', THEMENAME),
                'param_name' => 'size',
                'value' => $size_arr,
                'description' => __('Button size.', THEMENAME)
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Button align', THEMENAME),
                'param_name' => 'position',
                'value' => array(
                    __('Align right', THEMENAME) => 'cs_align_right',
                    __('Align left', THEMENAME) => 'cs_align_left'
                ),
                'description' => __('Select button alignment.', THEMENAME)
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', THEMENAME),
                'param_name' => 'el_class',
                'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', THEMENAME)
            )
        ),
        'js_view' => 'VcCallToActionView'
    ));
}
