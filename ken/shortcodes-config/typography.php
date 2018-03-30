<?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
vc_map(array(
    "name" => __("Text block", "mk_framework") ,
    "base" => "vc_column_text",
    "wrapper_class" => "clearfix",
    "category" => __('Typography', 'mk_framework') ,
    'icon' => 'icon-mk-text-block vc_mk_element-icon',
    'description' => __('A block of text with WYSIWYG editor', 'mk_framework') ,
    "params" => array(
        
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Text", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("Enter your content.", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Tablet & Mobile Align.", "mk_framework") ,
            "param_name" => "responsive_align",
            "value" => array(
                __('Center', "mk_framework") => "center",
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
            ) ,
            "description" => __("In some cases your text align for text may not look good in tablet and mobile devices. you can control align for tablet portrait and all mobile devices using this option. It will be center align by default!", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework") ,
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ) ,
        $add_device_visibility,
        
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Fancy Title", "mk_framework") ,
    "base" => "mk_fancy_title",
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
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "value" => array(
                "Simple Title" => "simple",
                "Stroke" => "stroke",
                "Standard" => "standard",
                "Avantgarde" => "avantgarde",
                "Alternative" => "alt",
                "Underline" => "underline"
            ) ,
            "description" => __("Please note that Alternative style will work only in page content and page sections with solid backgrounds.", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Corner style", "mk_framework") ,
            "param_name" => "corner_style",
            "value" => array(
                "Pointed" => "pointed",
                "Rounded" => "rounded",
                "Full Rounded" => "full_rounded"
            ) ,
            "description" => __("How will your button corners look like?", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'stroke'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Tag Name", "mk_framework") ,
            "param_name" => "tag_name",
            "value" => array(
                "h3" => "h3",
                "h2" => "h2",
                "h4" => "h4",
                "h5" => "h5",
                "h6" => "h6",
                "h1" => "h1"
            ) ,
            "description" => __("For SEO reasons you might need to define your titles tag names according to priority. Please note that H1 can only be used once in a page due to the SEO reasons. So try to use lower than H2 to meet SEO best practices.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Stroke Style Border Width", "mk_framework") ,
            "param_name" => "border_width",
            "value" => "3",
            "min" => "1",
            "max" => "5",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Changes border thickness. Please note that this option only works for Stroke style.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'stroke',
                    'standard',
                    'avantgarde',
                    'alt',
                    'underline'
                )
            ) ,
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Stroke Style Border Color", "mk_framework") ,
            "param_name" => "border_color",
            "value" => "",
            "description" => __("If left blank given text color will be applied to border color. Please note that this option only works for Stroke style.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'stroke'
                )
            ) ,
        ) ,
        array(
            "type" => "range",
            "heading" => __("Font Size", "mk_framework") ,
            "param_name" => "size",
            "value" => "14",
            "min" => "12",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Text Line Height", "mk_framework") ,
            "param_name" => "line_height",
            "value" => "24",
            "min" => "12",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Please note that this value should be more than font size. if less than font size line height value will be 100% to prevent reading issues.", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Text Color", "mk_framework") ,
            "param_name" => "color",
            "value" => "#393836",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Font Weight", "mk_framework") ,
            "param_name" => "font_weight",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Semi Bold', "mk_framework") => "600",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Normal', "mk_framework") => "normal",
                __('Light', "mk_framework") => "300"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Text Transform", "mk_framework") ,
            "param_name" => "text_transform",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "",
                __('None', "mk_framework") => "none",
                __('Uppercase', "mk_framework") => "uppercase",
                __('Lowercase', "mk_framework") => "lowercase",
                __('Capitalize', "mk_framework") => "capitalize"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Letter Spacing", "mk_framework") ,
            "param_name" => "letter_spacing",
            "value" => "0",
            "min" => "0",
            "max" => "10",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Space between each character.", "mk_framework")
        ) ,
        
        array(
            "type" => "theme_fonts",
            "heading" => __("Font Family", "mk_framework") ,
            "param_name" => "font_family",
            "value" => "",
            "description" => __("You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "mk_framework")
        ) ,
        array(
            "type" => "hidden_input",
            "param_name" => "font_type",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Top", "mk_framework") ,
            "param_name" => "margin_top",
            "value" => "10",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework") ,
            "param_name" => "margin_bottom",
            "value" => "10",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework") ,
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Tablet & Mobile Align.", "mk_framework") ,
            "param_name" => "responsive_align",
            "value" => array(
                __('Center', "mk_framework") => "center",
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
            ) ,
            "description" => __("In some cases your text align for text may not look good in tablet and mobile devices. you can control align for tablet portrait and all mobile devices using this option. It will be center align by default!", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework") ,
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Fancy Text", "mk_framework") ,
    "base" => "mk_fancy_text",
    "category" => __('Typography', 'mk_framework') ,
    'icon' => 'icon-mk-title-box vc_mk_element-icon',
    'description' => __('Adds title text into a highlight box.', 'mk_framework') ,
    "params" => array(
        
        array(
            "type" => "textarea_html",
            "rows" => 2,
            "holder" => "div",
            "heading" => __("Content.", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("Allowed Tags [em] [del] [i] [b] [strong] [u] [span] [small] [large] [sub] [sup]. Please note that [p] tags will be striped out.", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Text Color", "mk_framework") ,
            "param_name" => "color",
            "value" => "#393836",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Hightlight Background Color", "mk_framework") ,
            "param_name" => "highlight_color",
            "value" => "#000",
            "description" => __("The Hightlight Background color. you can change color opacity from below option.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Hightlight Color Opacity", "mk_framework") ,
            "param_name" => "highlight_opacity",
            "value" => "0.3",
            "min" => "0",
            "max" => "1",
            "step" => "0.01",
            "unit" => 'px',
            "description" => __("The Opacity of the hightlight background", "mk_framework")
        ) ,
        
        array(
            "type" => "range",
            "heading" => __("Font Size", "mk_framework") ,
            "param_name" => "size",
            "value" => "18",
            "min" => "12",
            "max" => "70",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Line Height (Important)", "mk_framework") ,
            "param_name" => "line_height",
            "value" => "34",
            "min" => "12",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Since every font family with differnt sizes need different line heights to get a nice looking highlighted titles you should set them manually. as a hint generally (font-size * 2) - 2 works in many cases, but you may need to give more space in between, so we opened your hands with this option. :) ", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Font Weight", "mk_framework") ,
            "param_name" => "font_weight",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Medium', "mk_framework") => "500",
                __('Semi Bold', "mk_framework") => "600",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Normal', "mk_framework") => "normal",
                __('Light', "mk_framework") => "300"
            ) ,
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
            "description" => __("In some ocasions you may on need to define a top margin for this title.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Buttom", "mk_framework") ,
            "param_name" => "margin_bottom",
            "value" => "20",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "theme_fonts",
            "heading" => __("Font Family", "mk_framework") ,
            "param_name" => "font_family",
            "value" => "",
            "description" => __("You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "mk_framework")
        ) ,
        array(
            "type" => "hidden_input",
            "param_name" => "font_type",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework") ,
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center",
                __('Justify', "mk_framework") => "justify"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework") ,
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Blockquote", "mk_framework") ,
    "base" => "mk_blockquote",
    "category" => __('Typography', 'mk_framework') ,
    'icon' => 'icon-mk-blockquote vc_mk_element-icon',
    'description' => __('Blockquote modules', 'mk_framework') ,
    "params" => array(
        
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Blockquote Message", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "width" => 150,
            "value" => array(
                __('Classic', "mk_framework") => "classic",
                __('Modern', "mk_framework") => "modern"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework") ,
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework") ,
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Dropcaps", "mk_framework") ,
    "base" => "mk_dropcaps",
    'icon' => 'icon-mk-dropcaps vc_mk_element-icon',
    "category" => __('Typography', 'mk_framework') ,
    'description' => __('Dropcaps element shortcode.', 'mk_framework') ,
    "params" => array(
        
        array(
            "type" => "textfield",
            "heading" => __("Dropcaps Character", "mk_framework") ,
            "param_name" => "char",
            "value" => __("", "mk_framework") ,
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "width" => 150,
            "value" => array(
                __('Square Default Color', "mk_framework") => "square-default",
                __('Circle default Color', "mk_framework") => "circle-default",
                __('Square Custom Color', "mk_framework") => "square-custom",
                __('Circle Custom Color', "mk_framework") => "circle-custom"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Fill Color", "mk_framework") ,
            "param_name" => "fill_color",
            "value" => $skin_color,
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'square-custom',
                    'circle-custom'
                )
            )
        ) ,
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Paragraph", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("Enter your content.", "mk_framework")
        ) ,
        
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Gradient Text", "mk_framework") ,
    "base" => "mk_gradient_text",
    'icon' => '',
    "category" => __('Typography', 'mk_framework') ,
    'description' => __('', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Gradient Text", "mk_framework") ,
            "param_name" => "text",
            "value" => __("", "mk_framework") ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Align.", "mk_framework") ,
            "param_name" => "text_align",
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Center', "mk_framework") => "center",
                __('Right', "mk_framework") => "right",
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "theme_fonts",
            "heading" => __("Font Family", "mk_framework") ,
            "param_name" => "font_family",
            "value" => "",
            "description" => __("You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "mk_framework")
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
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Font Weight", "mk_framework") ,
            "param_name" => "font_weight",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Semi Bold', "mk_framework") => "600",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Normal', "mk_framework") => "normal",
                __('Light', "mk_framework") => "300"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Gradient Style Orientation", "mk_framework") ,
            "param_name" => "gradient_style",
            "width" => 150,
            "value" => array(
                __('Vertical ', "mk_framework") => "vertical",
                __('Horizontal →', "mk_framework") => "horizontal",
                __('Radial ○', "mk_framework") => "radial",
            ) ,
            "description" => __("Choose the orientation of gradient style", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Start Color", "mk_framework") ,
            "param_name" => "start_color",
            "value" => $skin_color,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("End Color", "mk_framework") ,
            "param_name" => "end_color",
            "value" => '#ccc',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Highlight Text", "mk_framework") ,
    "base" => "mk_highlight",
    'icon' => 'icon-mk-highlight vc_mk_element-icon',
    "category" => __('Typography', 'mk_framework') ,
    'description' => __('adds highlight to an inline text.', 'mk_framework') ,
    "params" => array(
        
        array(
            "type" => "textfield",
            "heading" => __("Highlight Text", "mk_framework") ,
            "param_name" => "text",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "width" => 150,
            "value" => array(
                __('Default Color', "mk_framework") => "default",
                __('Custom Color', "mk_framework") => "custom"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Fill Color", "mk_framework") ,
            "param_name" => "fill_color",
            "value" => $skin_color,
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Custom List", "mk_framework") ,
    "base" => "mk_custom_list",
    "category" => __('Typography', 'mk_framework') ,
    'icon' => 'icon-mk-custom-list vc_mk_element-icon',
    'description' => __('Powerful list styles with icons.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Add your unordered list into this textarea. Allowed Tags : [ul][li][strong][i][em][u][b][a][small]", "mk_framework") ,
            "param_name" => "content",
            "value" => "<ul><li>List Item</li><li>List Item</li><li>List Item</li><li>List Item</li><li>List Item</li></ul>",
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Character Code", "mk_framework") ,
            "param_name" => "style",
            "value" => "f00c",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon Character code.", "mk_framework")
        ) ,
        
        array(
            "type" => "colorpicker",
            "heading" => __("Icons Color", "mk_framework") ,
            "param_name" => "icon_color",
            "value" => $skin_color,
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework") ,
            "param_name" => "margin_bottom",
            "value" => "30",
            "min" => "-30",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework") ,
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ) ,
        
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Font icons", "mk_framework") ,
    "base" => "mk_font_icons",
    'icon' => 'icon-mk-font-icon vc_mk_element-icon',
    "category" => __('Typography', 'mk_framework') ,
    'description' => __('Advanced font icon element', 'mk_framework') ,
    "params" => array(
        
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework") ,
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "value" => array(
                __("Fefault", "mk_framework") => "default",
                __("Filled", "mk_framework") => "filled",
                __("Generic (customise yourself)", "mk_framework") => "custom"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", "mk_framework") ,
            "param_name" => "color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom',
                    'filled'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework") ,
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Frame Border Color", "mk_framework") ,
            "param_name" => "border_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Hover Color", "mk_framework") ,
            "param_name" => "hover_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Background Hover Color", "mk_framework") ,
            "param_name" => "bg_hover_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Frame Border Hover Color", "mk_framework") ,
            "param_name" => "border_hover_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Icon Size", "mk_framework") ,
            "param_name" => "size",
            "value" => array(
                "16px" => "small",
                "32px" => "medium",
                "48px" => "large",
                "64px" => "x-large",
                "128px" => "xx-large",
                "256px" => "xxx-large"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "toggle",
            "heading" => __("Remove Frame from icon?", "mk_framework") ,
            "param_name" => "remove_frame",
            "value" => "false",
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "range",
            "heading" => __("Frame Border Width", "mk_framework") ,
            "param_name" => "border_width",
            "value" => "2",
            "min" => "1",
            "max" => "20",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'custom',
                    'default'
                )
            )
        ) ,
        
        array(
            "type" => "range",
            "heading" => __("Horizontal Padding", "mk_framework") ,
            "param_name" => "padding_horizental",
            "value" => "4",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("You can give padding to the icon. this padding will be applied to left and right side of the icon", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Vertical Padding", "mk_framework") ,
            "param_name" => "padding_vertical",
            "value" => "4",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("You can give padding to the icon. this padding will be applied to top and bottom of them icon", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Icon Align", "mk_framework") ,
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('- No Align - ', "mk_framework") => "none",
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Link", "mk_framework") ,
            "param_name" => "link",
            "value" => "",
            "description" => __("You can optionally link your icon. please provide full URL including http://", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Infinite Animations", "mk_framework") ,
            "param_name" => "infinite_animation",
            "value" => $infinite_animation,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Viewport Animation", "mk_framework") ,
            "param_name" => "animation",
            "value" => $css_animations,
            "description" => __("Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));

vc_map(array(
    "name" => __("Toggle", "mk_framework") ,
    "base" => "mk_toggle",
    "wrapper_class" => "clearfix",
    'icon' => 'icon-mk-toggle vc_mk_element-icon',
    "category" => __('Typography', 'mk_framework') ,
    'description' => __('Expandable toggle element', 'mk_framework') ,
    "params" => array(
        
        array(
            "type" => "textfield",
            "heading" => __("Toggle Title", "mk_framework") ,
            "param_name" => "title",
            "value" => ""
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name (Icon For title)", "mk_framework") ,
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework") ,
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Custom Icon Color", "mk_framework") ,
            "param_name" => "icon_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Toggle Content.", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "colorpicker",
            "heading" => __("Pane Background Color", "mk_framework") ,
            "param_name" => "pane_bg",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));

$tab_id_1 = time() . '-1-' . rand(0, 100);
$tab_id_2 = time() . '-2-' . rand(0, 100);
vc_map(array(
    "name" => __("Tabs", "mk_framework") ,
    "base" => "vc_tabs",
    "show_settings_on_create" => false,
    "is_container" => true,
    'icon' => 'icon-mk-tabs vc_mk_element-icon',
    "category" => __('Content', 'mk_framework') ,
    'description' => __('Tabbed content', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "value" => array(
                "Style 1" => "style1",
                "Style 2" => "style2",
                "Style 3" => "style3",
            ) ,
            "description" => __("Choose your tabs style.", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Orientation", "mk_framework") ,
            "param_name" => "orientation",
            "value" => array(
                "Horizontal" => "horizontal",
                "Vertical" => "vertical"
            ) ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'style1',
                    'style2'
                )
            ) ,
            "description" => __("Choose tabs orientation. Please note that this option will only work for style 1 and 2.", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Container Background Color", "mk_framework") ,
            "param_name" => "container_bg_color",
            "value" => "#fafafa",
            "description" => __("", "mk_framework")
        ) ,

        array(
            "type" => "dropdown",
            "heading" => __("Mobile Friendly Tabs?", "mk_framework"),
            "description" => __("If enabled tabs functionality will removed in mobile devices, each tab and its content will be inserted below each other.", "mk_framework"),
            "param_name" => "responsive",
            "value" => array(
                "Yes please!" => "true",
                "No!" => "false"
            ),
        ),
        
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    ) ,
    "custom_markup" => '
  <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>',
    'default_content' => '
  [vc_tab title="' . __('Tab 1', 'mk_framework') . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
  [vc_tab title="' . __('Tab 2', 'mk_framework') . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
  ',
    "js_view" => ('VcTabsView')
));

vc_map(array(
    "name" => __("Tab", "mk_framework") ,
    "base" => "vc_tab",
    "allowed_container_element" => 'vc_row',
    "is_container" => true,
    "content_element" => false,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework") ,
            "param_name" => "title",
            "description" => __("Tab title.", "mk_framework")
        ) ,
        
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework") ,
        ) ,
        
        array(
            "type" => "colorpicker",
            "heading" => __("Custom Icon Color", "mk_framework") ,
            "param_name" => "icon_color",
            "value" => "",
            "description" => __("", "mk_framework")
        )
    ) ,
    'js_view' => ('VcTabView')
));

vc_map(array(
    "name" => __("Accordion", "mk_framework") ,
    "base" => "vc_accordions",
    "show_settings_on_create" => false,
    "is_container" => true,
    'icon' => 'icon-mk-accordion vc_mk_element-icon',
    'description' => __('Collapsible content panels', 'mk_framework') ,
    "category" => __('Content', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "width" => 150,
            "value" => array(
                __('Simple', "mk_framework") => "simple",
                __('Boxed', "mk_framework") => "boxed"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Container Background Color", "mk_framework") ,
            "param_name" => "container_bg_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "range",
            "heading" => __("Initial Open Item", "mk_framework") ,
            "param_name" => "open_toggle",
            "value" => "0",
            "min" => "-1",
            "max" => "30",
            "step" => "1",
            "unit" => 'index',
            "description" => __("Specify which item to be open by default when The page loads. please note that this value is zero based therefore zero is the first item. -1 will close all accordions on page load.", "mk_framework") ,
        ) ,

        array(
            "type" => "dropdown",
            "heading" => __("Mobile Friendly Accordions?", "mk_framework"),
            "description" => __("If enabled accordion functionality will removed in mobile devices, each toggle and its content will be inserted below each other.", "mk_framework"),
            "param_name" => "responsive",
            "value" => array(
                "Yes please!" => "true",
                "No!" => "false"
            ),
            ),
        
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    ) ,
    "custom_markup" => '
  <div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
  %content%
  </div>
  <div class="tab_controls">
  <a class="add_tab" title="' . __('Add section', 'mk_framework') . '"><span class="vc_icon"></span> <span class="tab-label">' . __('Add section', 'mk_framework') . '</span></a>
  </div>
  ',
    'default_content' => '
  [vc_accordion_tab title="' . __('Section 1', "mk_framework") . '"][/vc_accordion_tab]
  [vc_accordion_tab title="' . __('Section 2', "mk_framework") . '"][/vc_accordion_tab]
  ',
    'js_view' => 'VcAccordionView'
));
vc_map(array(
    "name" => __("Accordion Section", "mk_framework") ,
    "base" => "vc_accordion_tab",
    "allowed_container_element" => 'vc_row',
    "is_container" => true,
    "content_element" => false,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework") ,
            "param_name" => "title",
            "description" => __("Accordion section title.", "mk_framework")
        ) ,
        
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name (optional)", "mk_framework") ,
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework") ,
        ) ,
        
        array(
            "type" => "colorpicker",
            "heading" => __("Custom Icon Color", "mk_framework") ,
            "param_name" => "icon_color",
            "value" => "",
            "description" => __("", "mk_framework")
        )
    ) ,
    'js_view' => 'VcAccordionTabView'
));

