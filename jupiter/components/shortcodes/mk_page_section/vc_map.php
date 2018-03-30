<?php
vc_map(array(
    "name" => __("Page Section", "mk_framework") ,
    "base" => "mk_page_section",
    "category" => __('General', 'mk_framework') ,
    "as_parent" => array(
        'only' => 'vc_row',
    ) ,
    'icon' => 'icon-mk-page-section vc_mk_element-icon',
    "content_element" => true,
    "is_container" => true,
    "show_settings_on_create" => true,
    'description' => __('Customisable full width page section.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Section Layout", "mk_framework") ,
            "param_name" => "layout_structure",
            "width" => 300,
            "value" => array(
                __('Full Layout', "mk_framework") => "full",
                __('One Half Layout (Background Image on Left & Content in Right)', "mk_framework") => "half_left",
                __('One Half Layout (Background Image on Right & Content in Left)', "mk_framework") => "half_right"
            ) ,
            "description" => __("If you choose One Half layout, uploaded background image will be displayed in one half of the screen width. The shortcodes placed in this section will occupy the rest of the half (not screen wide, rather it will follow half of the main grid width).", "mk_framework")
        ) ,

        array(
            "type" => "upload",
            "heading" => __("Background Image", "mk_framework") ,
            "param_name" => "bg_image",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,

        array(
            "type" => "upload",
            "heading" => __("Background Image (Portrait)", "mk_framework") ,
            "param_name" => "bg_image_portrait",
            "value" => "",
            "description" => __("Alternatively, this image could be shown in mobile devices with portrait orientation. It is recommended to use images with portrait ratio such as 2:3. ", "mk_framework")
        ) ,

        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework") ,
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Blend Modes", "mk_framework") ,
            "param_name" => "blend_mode",
            "value" => array(
                __('None', "mk_framework") => "none",
                __('Multiply', "mk_framework") => "multiply",
                __('Screen', "mk_framework") => "screen",
                __('Overlay', "mk_framework") => "overlay",
                __('Darken', "mk_framework") => "darken",
                __('Lighten', "mk_framework") => "lighten",
                __('Soft Light', "mk_framework") => "soft-light",
                __('Luminosity', "mk_framework") => "luminosity"
            ) ,
            "description" => __("*Experimental feature. Compatible with Chrome, Opera, Firefox and partially Safari", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Top and Bottom Border Color", "mk_framework") ,
            "param_name" => "border_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Attachment", "mk_framework") ,
            "param_name" => "attachment",
            "width" => 150,
            "value" => array(
                __('Scroll', "mk_framework") => "scroll",
                __('Fixed', "mk_framework") => "fixed"
            ) ,
            "description" => __("This option sets whether the background image is fixed or scrolls with the rest of the page. <a href='http://www.w3schools.com/CSSref/pr_background-attachment.asp'>Read More</a>", "mk_framework") ,
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Position", "mk_framework") ,
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
            ) ,
            "description" => __("First value defines horizontal position and second vertical position.", "mk_framework") ,
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Repeat", "mk_framework") ,
            "param_name" => "bg_repeat",
            "width" => 300,
            "value" => array(
                __('Repeat', "mk_framework") => "repeat",
                __('No Repeat', "mk_framework") => "no-repeat",
                __('Horizontal Repeat', "mk_framework") => "repeat-x",
                __('Vertical Repeat', "mk_framework") => "repeat-y"
            ) ,
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ) ,
        array(
            "type" => "toggle",
            "heading" => __('Cover whole background', 'mk_framework') ,
            "description" => __("Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area.", "mk_framework") ,
            "param_name" => "bg_stretch",
            "value" => "false"
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Parallax Background?", "mk_framework") ,
            "description" => __("Please note that Smooth Scroll option should be enabled for the parallax feature function correctly. Smooth Scroll option is loctated in Theme Options > General Settings > Global > Smooth Scroll.", "mk_framework") ,
            "param_name" => "enable_3d",
            "value" => "false",
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("3D Speed Factor", "mk_framework") ,
            "param_name" => "speed_factor",
            "min" => "-10",
            "max" => "10",
            "step" => "0.1",
            "unit" => 'factor',
            "value" => "0.3",
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Video", "mk_framework") ,
            "param_name" => "bg_video",
            "width" => 300,
            "value" => array(
                __('No', "mk_framework") => "no",
                __('Yes', "mk_framework") => "yes"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Video Source", "mk_framework") ,
            "param_name" => "video_source",
            "width" => 300,
            "value" => array(
                __('Self Hosted', "mk_framework") => "self",
                __('Social Hosted', "mk_framework") => "social"
            ) ,
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_video",
                'value' => array(
                    'yes'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Background Video (.MP4)", "mk_framework") ,
            "param_name" => "mp4",
            "value" => "",
            "description" => __("Upload your video with .MP4 extension. (Compatibility for Safari and IE9)", "mk_framework") ,
            "dependency" => array(
                'element' => "video_source",
                'value' => array(
                    'self'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Background Video (.WebM)", "mk_framework") ,
            "param_name" => "webm",
            "value" => "",
            "description" => __("Upload your video with .WebM extension. (Compatibility for Firefox4, Opera, and Chrome)", "mk_framework") ,
            "dependency" => array(
                'element' => "video_source",
                'value' => array(
                    'self'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("OGV Format", "mk_framework") ,
            "param_name" => "ogv",
            "value" => "",
            "description" => __("Compatibility for older Firefox and Opera versions", "mk_framework") ,
            "dependency" => array(
                'element' => "video_source",
                'value' => array(
                    'self'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Background Video Preview image (fallback image)", "mk_framework") ,
            "param_name" => "poster_image",
            "value" => "",
            "description" => __("This Image will be showed up until video is loaded. If video is not supported or could not load on user's machine, the image will stay in background.", "mk_framework") ,
            "dependency" => array(
                'element' => "video_source",
                'value' => array(
                    'self'
                )
            )
        ) ,
        array(
            "heading" => __("Stream Host Website", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "stream_host_website",
            "value" => array(
                __("Youtube", 'mk_framework') => "youtube",
                __("Vimeo", 'mk_framework') => "vimeo"
            ) ,
            "type" => "dropdown",
            "dependency" => array(
                'element' => "video_source",
                'value' => array(
                    'social'
                )
            ) ,
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Video ID", "mk_framework") ,
            "param_name" => "stream_video_id",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "video_source",
                'value' => array(
                    'social'
                )
            )
        ) ,

        array(
            "type" => "toggle",
            "heading" => __("Video Sound", "mk_framework") ,
            "param_name" => "stream_sound",
            "value" => "false",
            "description" => __("You can turn on/off the sound of the video for streaming videos", "mk_framework") ,
            "dependency" => array(
                'element' => "video_source",
                'value' => array(
                    'social'
                )
            )
        ) ,

        
        array(
            "type" => "toggle",
            "heading" => __("Video Loop?", "mk_framework"),
            "param_name" => "video_loop",
            "value" => "true",
            "description" => __("", "mk_framework"),
        ),
        array(
            "type" => "toggle",
            "heading" => __("Overlay Mask Pattern?", "mk_framework") ,
            "param_name" => "video_mask",
            "description" => __("Creates an overlay repeated pattern on your video background.", "mk_framework") ,
            "value" => "false",
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ) ,

        array(
            "type" => "dropdown",
            "heading" => __("Gradient Overlay Orientation", "mk_framework") ,
            "param_name" => "bg_gradient",
            "width" => 150,
            "value" => array(
                __('-- No Gradient ↓', "mk_framework") => "false",
                __('Vertical ', "mk_framework") => "vertical",
                __('Horizontal →', "mk_framework") => "horizontal",
                __('Diagonal ↘', "mk_framework") => "left_top",
                __('Diagonal ↗', "mk_framework") => "left_bottom",
                __('Radial ○', "mk_framework") => "radial",
            ) ,
            "description" => __("Choose the orientation of gradient overlay", "mk_framework")
        ) ,

        array(
            "type" => "colorpicker",
            "heading" => __("Overlay Color", "mk_framework") ,
            "param_name" => "video_color_mask",
            "value" => "",
            "description" => __("Primary overlay color. Start color if used with gradient option selected.", "mk_framework") ,
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ) ,

        array(
            "type" => "colorpicker",
            "heading" => __("Overlay Color End", "mk_framework") ,
            "param_name" => "gr_end",
            "value" => "",
            "description" => __("The ending color for gradient fill overlay. Use only with gradient option selected.", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_gradient",
                'value' => array(
                    "vertical",
                    "horizontal",
                    "left_top",
                    "left_bottom",
                    "radial"
                )
            )
        ) ,

        array(
            "type" => "range",
            "heading" => __("Overlay Color Mask Opacity", "mk_framework") ,
            "param_name" => "video_opacity",
            "value" => "0.6",
            "min" => "0",
            "max" => "1",
            "step" => "0.1",
            "unit" => 'alpha',
            "description" => __("The opacity of overlay layer which you set above. ", "mk_framework") ,
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Inner Shadow", "mk_framework") ,
            "description" => __("When enabled, a light inner shadow appears inside the page section (below top border).", 'mk_framework') ,
            "param_name" => "top_shadow",
            "value" => "false"
        ) ,
        array(
            "heading" => __("Select Section Layout", 'mk_framework') ,
            "description" => __("If you choose left or right sidebar layout you can then assign a side bar in the next option or create a new custom sidebar in Theme Options", 'mk_framework') ,
            "param_name" => "section_layout",
            "border" => 'false',
            "value" => array(
                "page-layout-full.png" => 'full',
                "page-layout-left.png" => 'left',
                "page-layout-right.png" => 'right'
            ) ,
            "type" => "visual_selector",
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ) ,
        array(
            'type' => 'widgetised_sidebars',
            'heading' => __('Sidebar', 'mk_framework') ,
            'param_name' => 'sidebar',
            'description' => __('Please select the sidebar you would like to show in this page section.', 'mk_framework') ,
            "dependency" => array(
                'element' => "layout_structure",
                'value' => array(
                    'full'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("Page Section Minimum Height", "mk_framework") ,
            "param_name" => "min_height",
            "value" => "100",
            "min" => "0",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Full Width?", "mk_framework") ,
            "description" => __("If you enable this option page section content will be screen width full width.", 'mk_framework') ,
            "param_name" => "full_width",
            "value" => "false"
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Full Screen Height?", "mk_framework") ,
            "param_name" => "full_height",
            "value" => "false",
            "description" => __("Using this option you can make this page section's height to cover the whole visible screen height (Not document height). Please note that if the inner content is larger than the window height, this feature will be disabled. Full height is browser resize sensitive and completely responsive.", "mk_framework")
        ) ,

        array(
            "type" => "toggle",
            "heading" => __("Center Vertically", "mk_framework") ,
            "param_name" => "js_vertical_centered",
            "value" => "false",
            "dependency" => array(
                'element' => "full_height",
                'value' => array(
                    'false'
                )
            )
        ) ,

        array(
            "type" => "dropdown",
            "heading" => __("Page Section Intro Effect", "mk_framework") ,
            "param_name" => "intro_effect",
            "value" => array(
                __('None', "mk_framework") => "false",
                __('Shuffle', "mk_framework") => "shuffle",
                __('Zoom Out', "mk_framework") => "zoom_out",
                __('Fade In', "mk_framework") => "fade"
            ) ,
            "description" => __("Note that this page section must be the first element in the page with full height enabled above.", "mk_framework") ,
            "dependency" => array(
                'element' => "full_height",
                'value' => array(
                    'true'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("Padding Top", "mk_framework") ,
            "param_name" => "padding_top",
            "value" => "10",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("The space between the content and top border of page section", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Padding Bottom", "mk_framework") ,
            "param_name" => "padding_bottom",
            "value" => "10",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("The space between the content and bottom border of page section", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework") ,
            "param_name" => "margin_bottom",
            "value" => "0",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("The space between the bottom border of page section and the next shortcode", "mk_framework")
        ) ,

        array(
            "type" => "dropdown",
            "heading" => __("Scroll to Bottom Arrow", "mk_framework") ,
            "param_name" => "skip_arrow",
            "value" => array(
                __('No', "mk_framework") => "false",
                __('Yes', "mk_framework") => "true"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Scroll to Bottom Arrow Skin", "mk_framework") ,
            "param_name" => "skip_arrow_skin",
            "value" => array(
                __('Light', "mk_framework") => "light",
                __('Dark', "mk_framework") => "dark"
            ) ,
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "skip_arrow",
                'value' => array(
                    'true'
                )
            )
        ) ,


        array(
            "type" => "toggle",
            "heading" => __("Has Top Shape Divider", "mk_framework"),
            "param_name" => "has_top_shape_divider",
            "value" => "false",
            "description" => __("", "mk_framework"),
            "group" => __('Shape Divider ', 'mk_framework') ,
        ),

        array(
            "heading" => __("Choose a Shape Pattern", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "top_shape_style",
            "class" => 'shape-selector',
            "group" => __('Shape Divider ', 'mk_framework') ,
            "value" => array(
                'shape/diagonal-top.png' => "diagonal-top",
                'shape/jagged-top.png' => "jagged-top",
                'shape/jagged-rounded-top.png' => "jagged-rounded-top",
                'shape/folded-top.png' => "folded-top",
                'shape/curve-top.png' => "curve-top",
                'shape/speech-top.png' => "speech-top",
            ) ,
            "type" => "visual_selector"
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Shape Size", "mk_framework") ,
            "param_name" => "top_shape_size",
            "group" => __('Shape Divider ', 'mk_framework') ,
            "value" => array(
                "Big" => "big",
                "Small" => "small"
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Shape Color", "mk_framework") ,
            "param_name" => "top_shape_color",
            "group" => __('Shape Divider ', 'mk_framework') ,
            "value" => '#fff',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework") ,
            "param_name" => "top_shape_bg_color",
            "group" => __('Shape Divider ', 'mk_framework') ,
            "value" => '',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "top_shape_el_class",
            "group" => __('Shape Divider ', 'mk_framework') ,
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ) ,


        array(
            "type" => "toggle",
            "heading" => __("Has Bottom Shape Divider", "mk_framework"),
            "param_name" => "has_bottom_shape_divider",
            "group" => __('Shape Divider ', 'mk_framework') ,
            "value" => "false",
            "description" => __("", "mk_framework"),
        ),

        array(
            "heading" => __("Choose a Shape Pattern", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "bottom_shape_style",
            "group" => __('Shape Divider ', 'mk_framework') ,
            "class" => 'shape-selector',
            "value" => array(
                'shape/diagonal-bottom.png' => "diagonal-bottom",
                'shape/jagged-bottom.png' => "jagged-bottom",
                'shape/jagged-rounded-bottom.png' => "jagged-rounded-bottom",
                'shape/folded-bottom.png' => "folded-bottom",
                'shape/curve-bottom.png' => "curve-bottom",
                'shape/speech-bottom.png' => "speech-bottom",
            ) ,
            "type" => "visual_selector"
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Shape Size", "mk_framework") ,
            "param_name" => "bottom_shape_size",
            "group" => __('Shape Divider ', 'mk_framework') ,
            "value" => array(
                "Big" => "big",
                "Small" => "small"
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Shape Color", "mk_framework") ,
            "param_name" => "bottom_shape_color",
            "group" => __('Shape Divider ', 'mk_framework') ,
            "value" => '#fff',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework") ,
            "param_name" => "bottom_shape_bg_color",
            "group" => __('Shape Divider ', 'mk_framework') ,
            "value" => '',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "bottom_shape_el_class",
            "group" => __('Shape Divider ', 'mk_framework') ,
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ) ,


        array(
            "type" => "textfield",
            "heading" => __("Section ID", "mk_framework") ,
            "param_name" => "section_id",
            "value" => "",
            "description" => __("Give your page section a unique ID. please note that this ID value should be used only once in a page.", "mk_framework")
        ) ,
        $add_device_visibility,
        $add_css_animations,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        ) ,
    ) ,
    "js_view" => 'VcRowView'
));