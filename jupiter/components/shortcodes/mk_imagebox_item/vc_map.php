<?php
vc_map(array(
    "name" => __("Imagebox Item", "mk_framework"),
    "base" => "mk_imagebox_item",
    "as_child" => array('only' => 'mk_imagebox'),
    'icon' => 'icon-mk-content-box vc_mk_element-icon',
    "content_element" => true,
    "category" => __('Slideshows', 'mk_framework'),
    'params' => array(
        array(
            "type" => "dropdown",
            "heading" => __("Icon Type", "mk_framework"),
            "param_name" => "icon_type",
            "value" => array(
                __('Image', "mk_framework") => "image",
                __('Video', "mk_framework") => "video"
            ),
            "description" => __("Choose Box Type.", "mk_framework")
        ),
        array(
            "type" => "upload",
            "heading" => __("Background Video (.MP4)", "mk_framework"),
            "param_name" => "mp4",
            "value" => "",
            "description" => __("Upload your video with .MP4 extension. (Compatibility for Safari and IE9)", "mk_framework"),
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'video'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Background Video (.WebM)", "mk_framework"),
            "param_name" => "webm",
            "value" => "",
            "description" => __("Upload your video with .WebM extension. (Compatibility for Firefox4, Opera, and Chrome)", "mk_framework"),
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'video'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Background Video (.OGV)", "mk_framework"),
            "param_name" => "ogv",
            "value" => "",
            "description" => __("Upload your video with .OGV extension. (Compatibility for Firefox, Opera, and Chrome)", "mk_framework"),
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'video'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Preview Image", "mk_framework"),
            "param_name" => "preview_image",
            "value" => "",
            "description" => __("Upload preview image for mobile devices", "mk_framework"),
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'video'
                )
            )
        ),
        array(
            "type" => "upload",
            "heading" => __("Item Image", "mk_framework"),
            "param_name" => "item_image",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'image'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Add Padding to Image?", "mk_framework"),
            "param_name" => "image_padding",
            "value" => "true",
            "description" => __("", "mk_framework"),
            // "dependency" => array(
            //     'element' => "icon_type",
            //     'value' => array(
            //         'image'
            //     )
            // )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework"),
            "param_name" => "background_color",
            "value" => "#eaeaea",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item Title", "mk_framework"),
            "param_name" => "item_title",
            "value" => "",
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "range",
            "heading" => __("Title Font Size", "mk_framework"),
            "param_name" => "title_text_size",
            "value" => "16",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Title Font Weight", "mk_framework"),
            "param_name" => "title_font_weight",
            "value" => $font_weight,
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Title Color", "mk_framework"),
            "param_name" => "title_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textarea",
            "heading" => __("Description", "mk_framework"),
            "param_name" => "content",
            "holder" => 'div',
            "value" => "",
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Description Color", "mk_framework"),
            "param_name" => "text_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button Text", "mk_framework"),
            "param_name" => "btn_text",
            "value" => "",
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button Url", "mk_framework"),
            "param_name" => "btn_url",
            "value" => "",
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Button Background Color", "mk_framework"),
            "param_name" => "btn_background_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Button Text Color", "mk_framework"),
            "param_name" => "btn_text_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Button Hover Background Color", "mk_framework"),
            "param_name" => "btn_hover_background_color",
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