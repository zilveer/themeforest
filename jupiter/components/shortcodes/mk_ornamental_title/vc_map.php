<?php
vc_map(array(
    "name" => __("Ornamental Title", "mk_framework") ,
    "base" => "mk_ornamental_title",
    'icon' => 'icon-mk-fancy-title vc_mk_element-icon',
    "category" => __('Typography', 'mk_framework') ,
    'description' => __('Advanced headings with cool styles.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Content.", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "title_as",
                'value' => array(
                    'text'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Tag Name", "mk_framework") ,
            "param_name" => "tag_name",
            "value" => array(
                "h2" => "h2",
                "h3" => "h3",
                "h4" => "h4",
                "h5" => "h5",
                "h6" => "h6",
                "h1" => "h1"
            ) ,
            "description" => __("For SEO reasons you might need to define your titles tag names according to priority. Please note that H1 can only be used only once in a page due to the SEO reasons. So try to use lower than H2 to meet SEO best practices.", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Title as", "mk_framework") ,
            "param_name" => "title_as",
            "value" => array(
                __('Text', "mk_framework") => "text",
                __('Image', "mk_framework") => "image",
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Title Image", "mk_framework") ,
            "param_name" => "title_image",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "title_as",
                'value' => array(
                    'image'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Text Color", "mk_framework") ,
            "param_name" => "text_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "title_as",
                'value' => array(
                    'text'
                )
            )
        ) ,
        array(
            "type" => "theme_fonts",
            "heading" => __("Font Family", "mk_framework") ,
            "param_name" => "font_family",
            "value" => "",
            "description" => __("You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "mk_framework"),
            "dependency" => array(
                'element' => "title_as",
                'value' => array(
                    'text'
                )
            )
        ) ,
        array(
            "type" => "hidden_input",
            "param_name" => "font_type",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Font Size", "mk_framework") ,
            "param_name" => "font_size",
            "value" => "14",
            "min" => "12",
            "max" => "70",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "title_as",
                'value' => array(
                    'text'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Font Weight", "mk_framework") ,
            "param_name" => "font_weight",
            "value" => $font_weight,
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "title_as",
                'value' => array(
                    'text'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Font Style", "mk_framework") ,
            "param_name" => "font_style",
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Normal', "mk_framework") => "normal",
                __('Italic', "mk_framework") => "italic",
            ) ,
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "title_as",
                'value' => array(
                    'text'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Text Transform", "mk_framework") ,
            "param_name" => "txt_transform",
            "value" => array(
                __('Default', "mk_framework") => "initial",
                __('None', "mk_framework") => "none",
                __('Uppercase', "mk_framework") => "uppercase",
                __('Lowercase', "mk_framework") => "lowercase",
                __('Capitalize', "mk_framework") => "capitalize"
            ) ,
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "title_as",
                'value' => array(
                    'text'
                )
            )
        ) ,
        array(
            "heading" => __("Ornamental Style", 'mk_framework') ,
            "description" => __("You can optionally select a pattern for this section background. This option only works when background image field is empty.", 'mk_framework') ,
            "param_name" => "ornament_style",
            "border" => 'true',
            "value" => array(
                'ornamental-style/1.png' => "rovi-single",
                'ornamental-style/2.png' => "rovi-double",
                'ornamental-style/3.png' => "norman-single",
                'ornamental-style/4.png' => "norman-double",
                'ornamental-style/5.png' => "norman-short-single",
                'ornamental-style/6.png' => "norman-short-double",
                'ornamental-style/7.png' => "lemo-single",
                'ornamental-style/8.png' => "lemo-double",
            ) ,
            "type" => "visual_selector"
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Norman Short Style and Lemo Style Align", "mk_framework") ,
            "param_name" => "nss_align",
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Center', "mk_framework") => "center",
                __('Right', "mk_framework") => "right",
            ) ,
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "ornament_style",
                'value' => array(
                    'norman-short-single',
                    'norman-short-double',
                    'lemo-single',
                    'lemo-double'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Ornament Color", "mk_framework") ,
            "param_name" => "ornament_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Ornament Thickness", "mk_framework") ,
            "param_name" => "ornament_thickness",
            "value" => "1",
            "min" => "1",
            "max" => "4",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Top", "mk_framework") ,
            "param_name" => "margin_top",
            "value" => "0",
            "min" => "-40",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
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
        $add_css_animations,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));