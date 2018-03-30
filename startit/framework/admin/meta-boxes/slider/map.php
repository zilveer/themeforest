<?php

//Slider

$slider_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Background Type',
        'name' => 'slides_type'
    )
);

    qode_startit_add_meta_box_field(
        array(
            'name'          => 'qodef_slide_background_type',
            'type'          => 'imagevideo',
            'default_value' => 'image',
            'label'         => 'Slide Background Type',
            'description'   => 'Do you want to upload an image or video?',
            'parent'        => $slider_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "#qodef-meta-box-qodef_slides_video_settings",
                "dependence_show_on_yes" => "#qodef-meta-box-qodef_slides_image_settings"
            )
        )
    );


//Slide Image

$slider_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Background Image',
        'name' => 'qodef_slides_image_settings',
        'hidden_property' => 'qodef_slide_background_type',
        'hidden_values' => array('video')
    )
);

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_image',
            'type'        => 'image',
            'label'       => 'Slide Image',
            'description' => 'Choose background image',
            'parent'      => $slider_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_overlay_image',
            'type'        => 'image',
            'label'       => 'Overlay Image',
            'description' => 'Choose overlay image (pattern) for background image',
            'parent'      => $slider_meta_box
        )
    );


//Slide Video

$video_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Background Video',
        'name' => 'qodef_slides_video_settings',
        'hidden_property' => 'qodef_slide_background_type',
        'hidden_values' => array('image')
    )
);

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_video_webm',
            'type'        => 'text',
            'label'       => 'Video - webm',
            'description' => 'Path to the webm file that you have previously uploaded in Media Section',
            'parent'      => $video_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_video_mp4',
            'type'        => 'text',
            'label'       => 'Video - mp4',
            'description' => 'Path to the mp4 file that you have previously uploaded in Media Section',
            'parent'      => $video_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_video_ogv',
            'type'        => 'text',
            'label'       => 'Video - ogv',
            'description' => 'Path to the ogv file that you have previously uploaded in Media Section',
            'parent'      => $video_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_video_image',
            'type'        => 'image',
            'label'       => 'Video Preview Image',
            'description' => 'Choose background image that will be visible until video is loaded. This image will be shown on touch devices too.',
            'parent'      => $video_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name' => 'qodef_slide_video_overlay',
            'type' => 'yesempty',
            'default_value' => '',
            'label' => 'Video Overlay Image',
            'description' => 'Do you want to have a overlay image on video?',
            'parent' => $video_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "",
                "dependence_show_on_yes" => "#qodef_qodef_slide_video_overlay_container"
            )
        )
    );

    $slide_video_overlay_container = qode_startit_add_admin_container(array(
        'name' => 'qodef_slide_video_overlay_container',
        'parent' => $video_meta_box,
        'hidden_property' => 'qodef_slide_video_overlay',
        'hidden_values' => array('','no')
    ));

        qode_startit_add_meta_box_field(
            array(
                'name'        => 'qodef_slide_video_overlay_image',
                'type'        => 'image',
                'label'       => 'Overlay Image',
                'description' => 'Choose overlay image (pattern) for background video.',
                'parent'      => $slide_video_overlay_container
            )
        );


//Slide General

$general_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide General',
        'name' => 'qodef_slides_general_settings'
    )
);

    qode_startit_add_admin_section_title(
        array(
            'parent' => $general_meta_box,
            'name' => 'qodef_text_content_title',
            'title' => 'Slide Text Content'
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name' => 'qodef_slide_hide_title',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => 'Hide Slide Title',
            'description' => 'Do you want to hide slide title?',
            'parent' => $general_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "#qodef_qodef_slide_hide_title_container",
                "dependence_show_on_yes" => ""
            )
        )
    );

    $slide_hide_title_container = qode_startit_add_admin_container(array(
        'name' => 'qodef_slide_hide_title_container',
        'parent' => $general_meta_box,
        'hidden_property' => 'qodef_slide_hide_title',
        'hidden_value' => 'yes'
    ));

        $group_title_link = qode_startit_add_admin_group(array(
            'title' => 'Title Link',
            'name' => 'group_title_link',
            'description' => 'Define styles for title',
            'parent' => $slide_hide_title_container
        ));

            $row1 = qode_startit_add_admin_row(array(
                'name' => 'row1',
                'parent' => $group_title_link
            ));

                qode_startit_add_meta_box_field(
                    array(
                        'name'        => 'qodef_slide_title_link',
                        'type'        => 'textsimple',
                        'label'       => 'Link',
                        'parent'      => $row1
                    )
                );

                qode_startit_add_meta_box_field(
                    array(
                        'parent' => $row1,
                        'type' => 'selectsimple',
                        'name' => 'qodef_slide_title_target',
                        'default_value' => '_self',
                        'label' => 'Target',
                        'options' => array(
                            "_self" => "Self",
                            "_blank" => "Blank"
                        )
                    )
                );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_subtitle',
            'type'        => 'text',
            'label'       => 'Subtitle Text',
            'description' => 'Enter text for subtitle',
            'parent'      => $general_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_text',
            'type'        => 'text',
            'label'       => 'Body Text',
            'description' => 'Enter slide body text',
            'parent'      => $general_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_button_label',
            'type'        => 'text',
            'label'       => 'Button 1 Text',
            'description' => 'Enter text to be displayed on button 1',
            'parent'      => $general_meta_box
        )
    );

    $group_button1 = qode_startit_add_admin_group(array(
        'title' => 'Button 1 Link',
        'name' => 'group_button1',
        'parent' => $general_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $group_button1
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_button_link',
                    'type'        => 'textsimple',
                    'label'       => 'Link',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'parent' => $row1,
                    'type' => 'selectsimple',
                    'name' => 'qodef_slide_button_target',
                    'default_value' => '_self',
                    'label' => 'Target',
                    'options' => array(
                        "_self" => "Self",
                        "_blank" => "Blank"
                    )
                )
            );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_button_label2',
            'type'        => 'text',
            'label'       => 'Button 2 Text',
            'description' => 'Enter text to be displayed on button 2',
            'parent'      => $general_meta_box
        )
    );

    $group_button2 = qode_startit_add_admin_group(array(
        'title' => 'Button 2 Link',
        'name' => 'group_button2',
        'parent' => $general_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $group_button2
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_button_link2',
                    'type'        => 'textsimple',
                    'label'       => 'Link',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'parent' => $row1,
                    'type' => 'selectsimple',
                    'name' => 'qodef_slide_button_target2',
                    'default_value' => '_self',
                    'label' => 'Target',
                    'options' => array(
                        "_self" => "Self",
                        "_blank" => "Blank"
                    )
                )
            );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_text_content_top_margin',
            'type'        => 'text',
            'label'       => 'Text Content Top Margin',
            'description' => 'Enter top margin for text content',
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_text_content_bottom_margin',
            'type'        => 'text',
            'label'       => 'Text Content Bottom Margin',
            'description' => 'Enter bottom margin for text content',
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    qode_startit_add_admin_section_title(
        array(
            'parent' => $general_meta_box,
            'name' => 'qodef_graphic_title',
            'title' => 'Slide Graphic'
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_thumbnail',
            'type'        => 'image',
            'label'       => 'Slide Graphic',
            'description' => 'Choose slide graphic',
            'parent'      => $general_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_thumbnail_link',
            'type'        => 'text',
            'label'       => 'Graphic Link',
            'description' => 'Enter URL to link slide graphic',
            'parent'      => $general_meta_box
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_graphic_top_padding',
            'type'        => 'text',
            'label'       => 'Graphic Top Padding',
            'description' => 'Enter top padding for slide graphic',
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name'        => 'qodef_slide_graphic_bottom_padding',
            'type'        => 'text',
            'label'       => 'Graphic Bottom Padding',
            'description' => 'Enter bottom padding for slide graphic',
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    qode_startit_add_admin_section_title(
        array(
            'parent' => $general_meta_box,
            'name' => 'qodef_general_styling_title',
            'title' => 'General Styling'
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'parent' => $general_meta_box,
            'type' => 'selectblank',
            'name' => 'qodef_slide_header_style',
            'default_value' => '',
            'label' => 'Header and Navigation Style',
            'description' => 'Header and navigation style will be applied when this slide is in focus',
            'options' => array(
                "light" => "Light",
                "dark" => "Dark"
            )
        )
    );

//Slide Behaviour

$behaviours_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Behaviours',
        'name' => 'qodef_slides_behaviour_settings'
    )
);

    qode_startit_add_admin_section_title(
        array(
            'parent' => $behaviours_meta_box,
            'name' => 'qodef_image_animation_title',
            'title' => 'Slide Image Animation'
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name' => 'qodef_enable_image_animation',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => 'Enable Image Animation',
            'description' => 'Enabling this option will turn on a motion animation on the slide image',
            'parent' => $behaviours_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "",
                "dependence_show_on_yes" => "#qodef_qodef_enable_image_animation_container"
            )
        )
    );

    $enable_image_animation_container = qode_startit_add_admin_container(array(
        'name' => 'qodef_enable_image_animation_container',
        'parent' => $behaviours_meta_box,
        'hidden_property' => 'qodef_enable_image_animation',
        'hidden_value' => 'no'
    ));

        qode_startit_add_meta_box_field(
            array(
                'parent' => $enable_image_animation_container,
                'type' => 'select',
                'name' => 'qodef_enable_image_animation_type',
                'default_value' => 'zoom_center',
                'label' => 'Animation Type',
                'options' => array(
                    "zoom_center" => "Zoom In Center",
                    "zoom_top_left" => "Zoom In to Top Left",
                    "zoom_top_right" => "Zoom In to Top Right",
                    "zoom_bottom_left" => "Zoom In to Bottom Left",
                    "zoom_bottom_right" => "Zoom In to Bottom Right"
                )
            )
        );

    qode_startit_add_admin_section_title(
        array(
            'parent' => $behaviours_meta_box,
            'name' => 'qodef_content_animation_title',
            'title' => 'Slide Content Entry Animations'
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'parent' => $behaviours_meta_box,
            'type' => 'select',
            'name' => 'qodef_slide_thumbnail_animation',
            'default_value' => 'flip',
            'label' => 'Graphic Entry Animation',
            'description' => 'Choose entry animation for graphic',
            'options' => array(
                "flip" => "Flip",
                "fade" => "Fade In",
                "from_bottom" => "From Bottom",
                "from_top" => "From Top",
                "from_left" => "From Left",
                "from_right" => "From Right",
                "clip_anim_hor" => "Clip Animation Horizontal",
                "clip_anim_ver" => "Clip Animation Vertical",
                "clip_anim_puzzle" => "Clip Animation Puzzle",
                "without_animation"	=>	"No Animation"
            )
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'parent' => $behaviours_meta_box,
            'type' => 'select',
            'name' => 'qodef_slide_content_animation',
            'default_value' => 'all_at_once',
            'label' => 'Content Entry Animation',
            'description' => 'Choose entry animation for whole slide content group (title, subtitle, text, button)',
            'options' => array(
                "all_at_once" => "All At Once",
                "one_by_one" => "One By One",
                "without_animation"	=>	"No Animation"
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "all_at_once"=>"",
                    "one_by_one"=>"",
                    "without_animation"=>"#qodef_qodef_slide_content_animation_container"),
                "show" => array(
                    "all_at_once"=>"#qodef_qodef_slide_content_animation_container",
                    "one_by_one"=>"#qodef_qodef_slide_content_animation_container",
                    "without_animation"=>""
                )
            )
        )
    );

    $slide_content_animation_container = qode_startit_add_admin_container(array(
        'name' => 'qodef_slide_content_animation_container',
        'parent' => $behaviours_meta_box,
        'hidden_property' => 'qodef_slide_content_animation',
        'hidden_value' => 'without_animation'
    ));

        qode_startit_add_meta_box_field(
            array(
                'parent' => $slide_content_animation_container,
                'type' => 'select',
                'name' => 'qodef_slide_content_animation_direction',
                'default_value' => 'from_bottom',
                'label' => 'Animation Direction',
                'options' => array(
                    "from_bottom" => "From Bottom",
                    "from_top" => "From Top",
                    "from_left" => "From Left",
                    "from_right" => "From Right",
                    "fade" => "Fade In"
                )
            )
        );

//Slide Content Positioning

$content_positioning_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Content Positioning',
        'name' => 'qodef_content_positioning_settings'
    )
);

    qode_startit_add_meta_box_field(
        array(
            'parent' => $content_positioning_meta_box,
            'type' => 'selectblank',
            'name' => 'qodef_slide_content_alignment',
            'default_value' => '',
            'label' => 'Text Alignment',
            'description' => 'Choose an alignment for the slide text',
            'options' => array(
                "left" => "Left",
                "center" => "Center",
                "right" => "Right"
            )
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'parent' => $content_positioning_meta_box,
            'type' => 'selectblank',
            'name' => 'qodef_slide_separate_text_graphic',
            'default_value' => 'no',
            'label' => 'Separate Graphic and Text Positioning',
            'description' => 'Do you want to separately position graphic and text?',
            'options' => array(
                "no" => "No",
                "yes" => "Yes"
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "" => "#qodef_qodef_slide_graphic_positioning_container",
                    "no" => "#qodef_qodef_slide_graphic_positioning_container, #qodef_qodef_content_vertical_positioning_group_container"
                ),
                "show" => array(
                    "yes" => "#qodef_qodef_slide_graphic_positioning_container, #qodef_qodef_content_vertical_positioning_group_container"
                )
            )
        )
    );

    qode_startit_add_meta_box_field(
        array(
            'name' => 'qodef_slide_content_vertical_middle',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => 'Vertically Align Content to Middle',
            'parent' => $content_positioning_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "#qodef_qodef_slide_content_vertical_middle_no_container",
                "dependence_show_on_yes" => "#qodef_qodef_slide_content_vertical_middle_yes_container"
            )
        )
    );

    $slide_content_vertical_middle_yes_container = qode_startit_add_admin_container(array(
        'name' => 'qodef_slide_content_vertical_middle_yes_container',
        'parent' => $content_positioning_meta_box,
        'hidden_property' => 'qodef_slide_content_vertical_middle',
        'hidden_value' => 'no'
    ));

        qode_startit_add_meta_box_field(
            array(
                'parent' => $slide_content_vertical_middle_yes_container,
                'type' => 'selectblank',
                'name' => 'qodef_slide_content_vertical_middle_type',
                'default_value' => '',
                'label' => 'Align Content Vertically Relative to the Height Measured From',
                'options' => array(
                    "bottom_of_header" => "Bottom of Header",
                    "window_top" => "Window Top"
                )
            )
        );

        qode_startit_add_meta_box_field(
            array(
                'name' => 'qodef_slide_vertical_content_full_width',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => 'Content Holder Full Width',
                'description' => 'Do you want to set slide content holder to full width?',
                'parent' => $slide_content_vertical_middle_yes_container
            )
        );

        qode_startit_add_meta_box_field(
            array(
                'name'        => 'qodef_slide_vertical_content_width',
                'type'        => 'text',
                'label'       => 'Content Width',
                'description' => 'Enter Width for Content Area',
                'parent'      => $slide_content_vertical_middle_yes_container,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => '%'
                )
            )
        );

        $group_space_around_content = qode_startit_add_admin_group(array(
            'title' => 'Space Around Content in Slide',
            'name' => 'group_space_around_content',
            'parent' => $slide_content_vertical_middle_yes_container
        ));

            $row1 = qode_startit_add_admin_row(array(
                'name' => 'row1',
                'parent' => $group_space_around_content
            ));

                qode_startit_add_meta_box_field(
                    array(
                        'name'        => 'qodef_slide_vertical_content_left',
                        'type'        => 'textsimple',
                        'label'       => 'From Left',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                qode_startit_add_meta_box_field(
                    array(
                        'name'        => 'qodef_slide_vertical_content_right',
                        'type'        => 'textsimple',
                        'label'       => 'From Right',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

    $slide_content_vertical_middle_no_container = qode_startit_add_admin_container(array(
        'name' => 'qodef_slide_content_vertical_middle_no_container',
        'parent' => $content_positioning_meta_box,
        'hidden_property' => 'qodef_slide_content_vertical_middle',
        'hidden_value' => 'yes'
    ));

        qode_startit_add_meta_box_field(
            array(
                'name' => 'qodef_slide_content_full_width',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => 'Content Holder Full Width',
                'description' => 'Do you want to set slide content holder to full width?',
                'parent' => $slide_content_vertical_middle_no_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#qodef_qodef_slide_content_width_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $slide_content_width_container = qode_startit_add_admin_container(array(
            'name' => 'qodef_slide_content_width_container',
            'parent' => $slide_content_vertical_middle_no_container,
            'hidden_property' => 'qodef_slide_content_full_width',
            'hidden_value' => 'yes'
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_content_width',
                    'type'        => 'text',
                    'label'       => 'Content Holder Width',
                    'description' => 'Enter Width for Content Holder Area',
                    'parent'      => $slide_content_width_container,
                    'args' => array(
                        'col_width' => 2,
                        'suffix' => '%'
                    )
                )
            );

        $group_space_around_content = qode_startit_add_admin_group(array(
            'title' => 'Space Around Content in Slide',
            'name' => 'group_space_around_content',
            'parent' => $slide_content_vertical_middle_no_container
        ));

            $row1 = qode_startit_add_admin_row(array(
                'name' => 'row1',
                'parent' => $group_space_around_content
            ));

                qode_startit_add_meta_box_field(
                    array(
                        'name'        => 'qodef_slide_content_top',
                        'type'        => 'textsimple',
                        'label'       => 'From Top',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                qode_startit_add_meta_box_field(
                    array(
                        'name'        => 'qodef_slide_content_left',
                        'type'        => 'textsimple',
                        'label'       => 'From Left',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                qode_startit_add_meta_box_field(
                    array(
                        'name'        => 'qodef_slide_content_bottom',
                        'type'        => 'textsimple',
                        'label'       => 'From Bottom',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                qode_startit_add_meta_box_field(
                    array(
                        'name'        => 'qodef_slide_content_right',
                        'type'        => 'textsimple',
                        'label'       => 'From Right',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

            $row2 = qode_startit_add_admin_row(array(
                'name' => 'row2',
                'parent' => $group_space_around_content
            ));

                $content_vertical_positioning_group_container = qode_startit_add_admin_container_no_style(array(
                    'name' => 'qodef_content_vertical_positioning_group_container',
                    'parent' => $row2,
                    'hidden_property' => 'qodef_slide_separate_text_graphic',
                    'hidden_value' => 'no'
                ));

                    qode_startit_add_meta_box_field(
                        array(
                            'name'        => 'qodef_slide_text_width',
                            'type'        => 'textsimple',
                            'label'       => 'Text Holder Width',
                            'parent'      => $content_vertical_positioning_group_container,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

        $slide_graphic_positioning_container = qode_startit_add_admin_container(array(
            'name' => 'qodef_slide_graphic_positioning_container',
            'parent' => $slide_content_vertical_middle_no_container,
            'hidden_property' => 'qodef_slide_separate_text_graphic',
            'hidden_value' => 'no'
        ));

            qode_startit_add_meta_box_field(
                array(
                    'parent' => $slide_graphic_positioning_container,
                    'type' => 'selectblank',
                    'name' => 'qodef_slide_graphic_alignment',
                    'default_value' => 'left',
                    'label' => 'Choose an alignment for the slide graphic',
                    'options' => array(
                        "left" => "Left",
                        "center" => "Center",
                        "right" => "Right"
                    )
                )
            );

            $group_graphic_positioning = qode_startit_add_admin_group(array(
                'title' => 'Graphic Positioning',
                'description' => 'Positioning for slide graphic',
                'name' => 'group_graphic_positioning',
                'parent' => $slide_graphic_positioning_container
            ));

                $row1 = qode_startit_add_admin_row(array(
                    'name' => 'row1',
                    'parent' => $group_graphic_positioning
                ));

                    qode_startit_add_meta_box_field(
                        array(
                            'name'        => 'qodef_slide_graphic_top',
                            'type'        => 'textsimple',
                            'label'       => 'From Top',
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

                    qode_startit_add_meta_box_field(
                        array(
                            'name'        => 'qodef_slide_graphic_left',
                            'type'        => 'textsimple',
                            'label'       => 'From Left',
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

                    qode_startit_add_meta_box_field(
                        array(
                            'name'        => 'qodef_slide_graphic_bottom',
                            'type'        => 'textsimple',
                            'label'       => 'From Bottom',
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

                    qode_startit_add_meta_box_field(
                        array(
                            'name'        => 'qodef_slide_graphic_right',
                            'type'        => 'textsimple',
                            'label'       => 'From Right',
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

            $row2 = qode_startit_add_admin_row(array(
                'name' => 'row2',
                'parent' => $group_graphic_positioning
            ));

                qode_startit_add_meta_box_field(
                    array(
                        'name'        => 'qodef_slide_graphic_width',
                        'type'        => 'textsimple',
                        'label'       => 'Graphic Holder Width',
                        'parent'      => $row2,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );
//Slide Title Styles

$title_style_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Title Style',
        'name' => 'qodef_slides_title',
        'hidden_property' => 'qodef_slide_hide_title',
        'hidden_values' => array('yes')
    )
);

    $title_text_group = qode_startit_add_admin_group(array(
        'title' => 'Title Text Style',
        'description' => 'Define styles for title text',
        'name' => 'qodef_title_text_group',
        'parent' => $title_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $title_text_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_color',
                    'type'        => 'colorsimple',
                    'label'       => 'Font Color',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_font_size',
                    'type'        => 'textsimple',
                    'label'       => 'Font Size (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_line_height',
                    'type'        => 'textsimple',
                    'label'       => 'Line Height (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_letter_spacing',
                    'type'        => 'textsimple',
                    'label'       => 'Letter Spacing (px)',
                    'parent'      => $row1
                )
            );

        $row2 = qode_startit_add_admin_row(array(
            'name' => 'row2',
            'parent' => $title_text_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_font_family',
                    'type'        => 'fontsimple',
                    'label'       => 'Font Family',
                    'parent'      => $row2
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_font_style',
                    'type'        => 'selectblanksimple',
                    'label'       => 'Font Style',
                    'parent'      => $row2,
                    'options'     => $qode_startit_options_fontstyle
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_font_weight',
                    'type'        => 'selectblanksimple',
                    'label'       => 'Font Weight',
                    'parent'      => $row2,
                    'options'     => $qode_startit_options_fontweight
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_text_transform',
                    'type'        => 'selectblanksimple',
                    'label'       => 'Text Transform',
                    'parent'      => $row2,
                    'options'       => $qode_startit_options_texttransform
                )
            );

    $title_background_group = qode_startit_add_admin_group(array(
        'title' => 'Background',
        'description' => 'Define background for title',
        'name' => 'qodef_title_background_group',
        'parent' => $title_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $title_background_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_background_color',
                    'type'        => 'colorsimple',
                    'label'       => 'Background Color',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_bg_color_transparency',
                    'type'        => 'textsimple',
                    'label'       => 'Background Color Transparency (values 0-1)',
                    'parent'      => $row1
                )
            );

    $title_margin_group = qode_startit_add_admin_group(array(
        'title' => 'Margin Bottom (px)',
        'description' => 'Enter value for title bottom margin (default value is 20)',
        'name' => 'qodef_title_margin_group',
        'parent' => $title_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $title_margin_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_margin_bottom',
                    'type'        => 'textsimple',
                    'label'       => '',
                    'parent'      => $row1
                )
            );

    $title_padding_group = qode_startit_add_admin_group(array(
        'title' => 'Padding',
        'description' => 'Define padding for title',
        'name' => 'qodef_title_padding_group',
        'parent' => $title_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $title_padding_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_padding_top',
                    'type'        => 'textsimple',
                    'label'       => 'Top Padding (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_padding_right',
                    'type'        => 'textsimple',
                    'label'       => 'Right Padding (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_padding_bottom',
                    'type'        => 'textsimple',
                    'label'       => 'Bottom Padding (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_title_padding_left',
                    'type'        => 'textsimple',
                    'label'       => 'Left Padding (px)',
                    'parent'      => $row1
                )
            );

//Slide Subtitle Styles

$subtitle_style_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Subtitle Style',
        'name' => 'qodef_slides_subtitle'
    )
);

    $subtitle_text_group = qode_startit_add_admin_group(array(
        'title' => 'Subtitle Text Style',
        'description' => 'Define styles for subtitle text',
        'name' => 'qodef_subtitle_text_group',
        'parent' => $subtitle_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $subtitle_text_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_color',
                    'type'        => 'colorsimple',
                    'label'       => 'Font Color',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_font_size',
                    'type'        => 'textsimple',
                    'label'       => 'Font Size (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_line_height',
                    'type'        => 'textsimple',
                    'label'       => 'Line Height (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_letter_spacing',
                    'type'        => 'textsimple',
                    'label'       => 'Letter Spacing (px)',
                    'parent'      => $row1
                )
            );

        $row2 = qode_startit_add_admin_row(array(
            'name' => 'row2',
            'parent' => $subtitle_text_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_font_family',
                    'type'        => 'fontsimple',
                    'label'       => 'Font Family',
                    'parent'      => $row2
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_font_style',
                    'type'        => 'selectblanksimple',
                    'label'       => 'Font Style',
                    'parent'      => $row2,
                    'options'     => $qode_startit_options_fontstyle
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_font_weight',
                    'type'        => 'selectblanksimple',
                    'label'       => 'Font Weight',
                    'parent'      => $row2,
                    'options'     => $qode_startit_options_fontweight
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_text_transform',
                    'type'        => 'selectblanksimple',
                    'label'       => 'Text Transform',
                    'parent'      => $row2,
                    'options'       => $qode_startit_options_texttransform
                )
            );

    $subtitle_background_group = qode_startit_add_admin_group(array(
        'title' => 'Background',
        'description' => 'Define background for subtitle',
        'name' => 'qodef_subtitle_background_group',
        'parent' => $subtitle_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $subtitle_background_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_background_color',
                    'type'        => 'colorsimple',
                    'label'       => 'Background Color',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_bg_color_transparency',
                    'type'        => 'textsimple',
                    'label'       => 'Background Color Transparency (values 0-1)',
                    'parent'      => $row1
                )
            );

    $subtitle_margin_group = qode_startit_add_admin_group(array(
        'title' => 'Margin Bottom (px)',
        'description' => 'Enter value for subtitle bottom margin (default value is 22)',
        'name' => 'qodef_subtitle_margin_group',
        'parent' => $subtitle_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $subtitle_margin_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_margin_bottom',
                    'type'        => 'textsimple',
                    'label'       => '',
                    'parent'      => $row1
                )
            );

    $subtitle_padding_group = qode_startit_add_admin_group(array(
        'title' => 'Padding',
        'description' => 'Define padding for subtitle',
        'name' => 'qodef_subtitle_padding_group',
        'parent' => $subtitle_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $subtitle_padding_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_padding_top',
                    'type'        => 'textsimple',
                    'label'       => 'Top Padding (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_padding_right',
                    'type'        => 'textsimple',
                    'label'       => 'Right Padding (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_padding_bottom',
                    'type'        => 'textsimple',
                    'label'       => 'Bottom Padding (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_subtitle_padding_left',
                    'type'        => 'textsimple',
                    'label'       => 'Left Padding (px)',
                    'parent'      => $row1
                )
            );

//Slide Text Styles

$text_style_meta_box = qode_startit_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Text Style',
        'name' => 'qodef_slides_text'
    )
);

    $text_text_group = qode_startit_add_admin_group(array(
        'title' => 'Text Style',
        'description' => 'Define styles for text',
        'name' => 'qodef_text_text_group',
        'parent' => $text_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $text_text_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_color',
                    'type'        => 'colorsimple',
                    'label'       => 'Font Color',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_font_size',
                    'type'        => 'textsimple',
                    'label'       => 'Font Size (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_line_height',
                    'type'        => 'textsimple',
                    'label'       => 'Line Height (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_letter_spacing',
                    'type'        => 'textsimple',
                    'label'       => 'Letter Spacing (px)',
                    'parent'      => $row1
                )
            );

        $row2 = qode_startit_add_admin_row(array(
            'name' => 'row2',
            'parent' => $text_text_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_font_family',
                    'type'        => 'fontsimple',
                    'label'       => 'Font Family',
                    'parent'      => $row2
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_font_style',
                    'type'        => 'selectblanksimple',
                    'label'       => 'Font Style',
                    'parent'      => $row2,
                    'options'     => $qode_startit_options_fontstyle
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_font_weight',
                    'type'        => 'selectblanksimple',
                    'label'       => 'Font Weight',
                    'parent'      => $row2,
                    'options'     => $qode_startit_options_fontweight
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_text_transform',
                    'type'        => 'selectblanksimple',
                    'label'       => 'Text Transform',
                    'parent'      => $row2,
                    'options'       => $qode_startit_options_texttransform
                )
            );

    $text_background_group = qode_startit_add_admin_group(array(
        'title' => 'Background',
        'description' => 'Define background for text',
        'name' => 'qodef_text_without_separator_background_group',
        'parent' => $text_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $text_background_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_background_color',
                    'type'        => 'colorsimple',
                    'label'       => 'Background Color',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_bg_color_transparency',
                    'type'        => 'textsimple',
                    'label'       => 'Background Color Transparency (values 0-1)',
                    'parent'      => $row1
                )
            );

    $text_padding_group = qode_startit_add_admin_group(array(
        'title' => 'Padding',
        'description' => 'Define padding for text',
        'name' => 'qodef_text_padding_group',
        'parent' => $text_style_meta_box
    ));

        $row1 = qode_startit_add_admin_row(array(
            'name' => 'row1',
            'parent' => $text_padding_group
        ));

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_padding_top',
                    'type'        => 'textsimple',
                    'label'       => 'Top Padding (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_padding_right',
                    'type'        => 'textsimple',
                    'label'       => 'Right Padding (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_padding_bottom',
                    'type'        => 'textsimple',
                    'label'       => 'Bottom Padding (px)',
                    'parent'      => $row1
                )
            );

            qode_startit_add_meta_box_field(
                array(
                    'name'        => 'qodef_slide_text_padding_left',
                    'type'        => 'textsimple',
                    'label'       => 'Left Padding (px)',
                    'parent'      => $row1
                )
            );