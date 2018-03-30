<?php

if(!function_exists('hue_mikado_title_options_map')) {

    function hue_mikado_title_options_map() {

        hue_mikado_add_admin_page(
            array(
                'slug'  => '_title_page',
                'title' => esc_html__('Title', 'hue'),
                'icon'  => 'icon_archive_alt'
            )
        );

        $panel_title = hue_mikado_add_admin_panel(
            array(
                'page'  => '_title_page',
                'name'  => 'panel_title',
                'title' => esc_html__('Title Settings', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'show_title_area',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Show Title Area', 'hue'),
                'description'   => esc_html__('This option will enable/disable Title Area', 'hue'),
                'parent'        => $panel_title,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_show_title_area_container"
                )
            )
        );

        $show_title_area_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_title,
                'name'            => 'show_title_area_container',
                'hidden_property' => 'show_title_area',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'title_area_type',
                'type'          => 'select',
                'default_value' => 'breadcrumb',
                'label'         => esc_html__('Title Area Type', 'hue'),
                'description'   => esc_html__('Choose title type', 'hue'),
                'parent'        => $show_title_area_container,
                'options'       => array(
                    'standard'   => esc_html__('Standard', 'hue'),
                    'breadcrumb' => esc_html__('Breadcrumb', 'hue')
                ),
                'args'          => array(
                    "dependence" => true,
                    "hide"       => array(
                        "standard"   => "",
                        "breadcrumb" => "#mkd_title_area_type_container"
                    ),
                    "show"       => array(
                        "standard"   => "#mkd_title_area_type_container",
                        "breadcrumb" => ""
                    )
                )
            )
        );

        $title_area_type_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $show_title_area_container,
                'name'            => 'title_area_type_container',
                'hidden_property' => 'title_area_type',
                'hidden_value'    => '',
                'hidden_values'   => array('breadcrumb'),
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'title_area_enable_breadcrumbs',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Breadcrumbs', 'hue'),
                'description'   => esc_html__('This option will display Breadcrumbs in Title Area', 'hue'),
                'parent'        => $title_area_type_container,
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'title_area_gradient_overaly_animation',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Animated Gradient Overlay', 'hue'),
                'description'   => esc_html__('Show animated gradient overlay for Title Area', 'hue'),
                'parent'        => $show_title_area_container,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_title_area_gradient_overaly_animation_container"
                )
            )
        );

        $title_area_gradient_overaly_animation_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $show_title_area_container,
                'name'            => 'title_area_gradient_overaly_animation_container',
                'hidden_property' => 'title_area_gradient_overaly_animation',
                'hidden_value'    => 'no'
            )
        );

        $group_title_area_gradient_overlay = hue_mikado_add_admin_group(array(
            'name'        => 'group_page_title_styles',
            'title'       => esc_html__('Animated Gradient Overlay Colors', 'hue'),
            'description' => esc_html__('Define colors for gradient overlay', 'hue'),
            'parent'      => $title_area_gradient_overaly_animation_container
        ));

        $row_gradient_overlay = hue_mikado_add_admin_row(array(
            'name'   => 'row_gradient_overlay',
            'parent' => $group_title_area_gradient_overlay
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'title_gradient_overlay_color1',
            'default_value' => '#e14b4f',
            'label'         => esc_html__('Color 1 (def. #e14b4f)', 'hue'),
            'parent'        => $row_gradient_overlay
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'title_gradient_overlay_color2',
            'default_value' => '#58b0e3',
            'label'         => esc_html__('Color 2 (def. #58b0e3)', 'hue'),
            'parent'        => $row_gradient_overlay
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'title_gradient_overlay_color3',
            'default_value' => '#48316b',
            'label'         => esc_html__('Color 3 (def. #48316b)', 'hue'),
            'parent'        => $row_gradient_overlay
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'title_gradient_overlay_color4',
            'default_value' => '#913156',
            'label'         => esc_html__('Color 4 (def. #913156)', 'hue'),
            'parent'        => $row_gradient_overlay
        ));

        hue_mikado_add_admin_field(
            array(
                'name'          => 'title_area_animation',
                'type'          => 'select',
                'default_value' => 'no',
                'label'         => esc_html__('Animations', 'hue'),
                'description'   => esc_html__('Choose an animation for Title Area', 'hue'),
                'parent'        => $show_title_area_container,
                'options'       => array(
                    'no'         => esc_html__('No Animation', 'hue'),
                    'right-left' => esc_html__('Text right to left', 'hue'),
                    'left-right' => esc_html__('Text left to right', 'hue')
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'title_area_vertial_alignment',
                'type'          => 'select',
                'default_value' => 'header_bottom',
                'label'         => esc_html__('Vertical Alignment', 'hue'),
                'description'   => esc_html__('Specify title vertical alignment', 'hue'),
                'parent'        => $show_title_area_container,
                'options'       => array(
                    'header_bottom' => esc_html__('From Bottom of Header', 'hue'),
                    'window_top'    => esc_html__('From Window Top', 'hue')
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'title_area_content_alignment',
                'type'          => 'select',
                'default_value' => 'left',
                'label'         => esc_html__('Horizontal Alignment', 'hue'),
                'description'   => esc_html__('Specify title horizontal alignment', 'hue'),
                'parent'        => $show_title_area_container,
                'options'       => array(
                    'left'   => esc_html__('Left', 'hue'),
                    'center' => esc_html__('Center', 'hue'),
                    'right'  => esc_html__('Right', 'hue')
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'title_area_background_color',
                'type'        => 'color',
                'label'       => esc_html__('Background Color', 'hue'),
                'description' => esc_html__('Choose a background color for Title Area', 'hue'),
                'parent'      => $show_title_area_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'title_area_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'hue'),
                'description' => esc_html__('Choose an Image for Title Area', 'hue'),
                'parent'      => $show_title_area_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'title_area_background_image_responsive',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Background Responsive Image', 'hue'),
                'description'   => esc_html__('Enabling this option will make Title background image responsive', 'hue'),
                'parent'        => $show_title_area_container,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "#mkd_title_area_background_image_responsive_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $title_area_background_image_responsive_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $show_title_area_container,
                'name'            => 'title_area_background_image_responsive_container',
                'hidden_property' => 'title_area_background_image_responsive',
                'hidden_value'    => 'yes'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'title_area_background_image_parallax',
                'type'          => 'select',
                'default_value' => 'no',
                'label'         => esc_html__('Background Image in Parallax', 'hue'),
                'description'   => esc_html__('Enabling this option will make Title background image parallax', 'hue'),
                'parent'        => $title_area_background_image_responsive_container,
                'options'       => array(
                    'no'       => esc_html__('No', 'hue'),
                    'yes'      => esc_html__('Yes', 'hue'),
                    'yes_zoom' => esc_html__('Yes, with zoom out', 'hue')
                )
            )
        );

        hue_mikado_add_admin_field(array(
            'name'        => 'title_area_height',
            'type'        => 'text',
            'label'       => esc_html__('Height', 'hue'),
            'description' => esc_html__('Set a height for Title Area', 'hue'),
            'parent'      => $title_area_background_image_responsive_container,
            'args'        => array(
                'col_width' => 2,
                'suffix'    => 'px'
            )
        ));


        $panel_typography = hue_mikado_add_admin_panel(
            array(
                'page'  => '_title_page',
                'name'  => 'panel_title_typography',
                'title' => esc_html__('Typography', 'hue')
            )
        );

        $group_page_title_styles = hue_mikado_add_admin_group(array(
            'name'        => 'group_page_title_styles',
            'title'       => esc_html__('Title', 'hue'),
            'description' => esc_html__('Define styles for page title', 'hue'),
            'parent'      => $panel_typography
        ));

        $row_page_title_styles_1 = hue_mikado_add_admin_row(array(
            'name'   => 'row_page_title_styles_1',
            'parent' => $group_page_title_styles
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'page_title_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'hue'),
            'parent'        => $row_page_title_styles_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_title_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_title_styles_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_title_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_title_styles_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_title_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'hue'),
            'options'       => hue_mikado_get_text_transform_array(),
            'parent'        => $row_page_title_styles_1
        ));

        $row_page_title_styles_2 = hue_mikado_add_admin_row(array(
            'name'   => 'row_page_title_styles_2',
            'parent' => $group_page_title_styles,
            'next'   => true
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'page_title_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'hue'),
            'parent'        => $row_page_title_styles_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_title_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'hue'),
            'options'       => hue_mikado_get_font_style_array(),
            'parent'        => $row_page_title_styles_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_title_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'hue'),
            'options'       => hue_mikado_get_font_weight_array(),
            'parent'        => $row_page_title_styles_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_title_letter_spacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_title_styles_2
        ));

        $group_page_subtitle_styles = hue_mikado_add_admin_group(array(
            'name'        => 'group_page_subtitle_styles',
            'title'       => esc_html__('Subtitle', 'hue'),
            'description' => esc_html__('Define styles for page subtitle', 'hue'),
            'parent'      => $panel_typography
        ));

        $row_page_subtitle_styles_1 = hue_mikado_add_admin_row(array(
            'name'   => 'row_page_subtitle_styles_1',
            'parent' => $group_page_subtitle_styles
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'page_subtitle_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'hue'),
            'parent'        => $row_page_subtitle_styles_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_subtitle_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_subtitle_styles_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_subtitle_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_subtitle_styles_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_subtitle_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'hue'),
            'options'       => hue_mikado_get_text_transform_array(),
            'parent'        => $row_page_subtitle_styles_1
        ));

        $row_page_subtitle_styles_2 = hue_mikado_add_admin_row(array(
            'name'   => 'row_page_subtitle_styles_2',
            'parent' => $group_page_subtitle_styles,
            'next'   => true
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'page_subtitle_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'hue'),
            'parent'        => $row_page_subtitle_styles_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_subtitle_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'hue'),
            'options'       => hue_mikado_get_font_style_array(),
            'parent'        => $row_page_subtitle_styles_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_subtitle_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'hue'),
            'options'       => hue_mikado_get_font_weight_array(),
            'parent'        => $row_page_subtitle_styles_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_subtitle_letter_spacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_subtitle_styles_2
        ));

        $group_page_breadcrumbs_styles = hue_mikado_add_admin_group(array(
            'name'        => 'group_page_breadcrumbs_styles',
            'title'       => esc_html__('Breadcrumbs', 'hue'),
            'description' => esc_html__('Define styles for page breadcrumbs', 'hue'),
            'parent'      => $panel_typography
        ));

        $row_page_breadcrumbs_styles_1 = hue_mikado_add_admin_row(array(
            'name'   => 'row_page_breadcrumbs_styles_1',
            'parent' => $group_page_breadcrumbs_styles
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'page_breadcrumb_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'hue'),
            'parent'        => $row_page_breadcrumbs_styles_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_breadcrumb_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_breadcrumbs_styles_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_breadcrumb_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_breadcrumbs_styles_1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_breadcrumb_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'hue'),
            'options'       => hue_mikado_get_text_transform_array(),
            'parent'        => $row_page_breadcrumbs_styles_1
        ));

        $row_page_breadcrumbs_styles_2 = hue_mikado_add_admin_row(array(
            'name'   => 'row_page_breadcrumbs_styles_2',
            'parent' => $group_page_breadcrumbs_styles,
            'next'   => true
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'page_breadcrumb_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'hue'),
            'parent'        => $row_page_breadcrumbs_styles_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_breadcrumb_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'hue'),
            'options'       => hue_mikado_get_font_style_array(),
            'parent'        => $row_page_breadcrumbs_styles_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_breadcrumb_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'hue'),
            'options'       => hue_mikado_get_font_weight_array(),
            'parent'        => $row_page_breadcrumbs_styles_2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_breadcrumb_letter_spacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'hue'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_breadcrumbs_styles_2
        ));

        $row_page_breadcrumbs_styles_3 = hue_mikado_add_admin_row(array(
            'name'   => 'row_page_breadcrumbs_styles_3',
            'parent' => $group_page_breadcrumbs_styles,
            'next'   => true
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'page_breadcrumb_hovercolor',
            'default_value' => '',
            'label'         => esc_html__('Hover/Active Color', 'hue'),
            'parent'        => $row_page_breadcrumbs_styles_3
        ));

    }

    add_action('hue_mikado_options_map', 'hue_mikado_title_options_map', 7);

}