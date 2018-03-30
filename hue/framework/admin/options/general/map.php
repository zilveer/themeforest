<?php

if(!function_exists('hue_mikado_general_options_map')) {
    /**
     * General options page
     */
    function hue_mikado_general_options_map() {

        hue_mikado_add_admin_page(
            array(
                'slug'  => '',
                'title' => esc_html__('General', 'hue'),
                'icon'  => 'icon_building'
            )
        );

        $panel_logo = hue_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_logo',
                'title' => esc_html__('Branding', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'parent'        => $panel_logo,
                'type'          => 'yesno',
                'name'          => 'hide_logo',
                'default_value' => 'no',
                'label'         => esc_html__('Hide Logo', 'hue'),
                'description'   => esc_html__('Enabling this option will hide logo image', 'hue'),
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "#mkd_hide_logo_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_logo_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_logo,
                'name'            => 'hide_logo_container',
                'hidden_property' => 'hide_logo',
                'hidden_value'    => 'yes'
            )
        );

        hue_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'standard_minimal_logo_title',
                'title'  => esc_html__('Standard, Minimal & Boxed Header Logo', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Default', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_black.png",
                'label'         => esc_html__('Logo Image - Dark', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_white.png",
                'label'         => esc_html__('Logo Image - Light', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Sticky', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'divided_logo_title',
                'title'  => esc_html__('Divided Header Logo', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided.png",
                'label'         => esc_html__('Logo Image - Divided', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided_dark.png",
                'label'         => esc_html__('Logo Image - Divided Dark', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided_light.png",
                'label'         => esc_html__('Logo Image - Divided Light', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided.png",
                'label'         => esc_html__('Logo Image - Divided Sticky', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'centered_logo_title',
                'title'  => esc_html__('Centered Header Logo', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered.png",
                'label'         => esc_html__('Logo Image - Centered', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered_dark.png",
                'label'         => esc_html__('Logo Image - Centered Dark', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered_light.png",
                'label'         => esc_html__('Logo Image - Centered Light', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered.png",
                'label'         => esc_html__('Logo Image - Centered Sticky', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'vertical_logo_title',
                'title'  => esc_html__('Vertical Header Logo', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_vertical',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_white.png",
                'label'         => esc_html__('Logo Image - Vertical Header', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display on vertilcal header', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        hue_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'mobile_logo_title',
                'title'  => esc_html__('Mobile Header Logo', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_mobile',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Mobile', 'hue'),
                'description'   => esc_html__('Choose a default logo image to display ', 'hue'),
                'parent'        => $hide_logo_container
            )
        );

        $panel_design_style = hue_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_design_style',
                'title' => esc_html__('Appearance', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue'),
                'description'   => esc_html__('Choose a default Google font for your site', 'hue'),
                'parent'        => $panel_design_style
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Additional Google Fonts', 'hue'),
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_design_style,
                'name'            => 'additional_google_fonts_container',
                'hidden_property' => 'additional_google_fonts',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue'),
                'description'   => esc_html__('Choose additional Google font for your site', 'hue'),
                'parent'        => $additional_google_fonts_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue'),
                'description'   => esc_html__('Choose additional Google font for your site', 'hue'),
                'parent'        => $additional_google_fonts_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue'),
                'description'   => esc_html__('Choose additional Google font for your site', 'hue'),
                'parent'        => $additional_google_fonts_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue'),
                'description'   => esc_html__('Choose additional Google font for your site', 'hue'),
                'parent'        => $additional_google_fonts_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'hue'),
                'description'   => esc_html__('Choose additional Google font for your site', 'hue'),
                'parent'        => $additional_google_fonts_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'first_color',
                'type'        => 'color',
                'label'       => esc_html__('First Main Color', 'hue'),
                'description' => esc_html__('Choose the most dominant theme color. Default color is #d4145a', 'hue'),
                'parent'      => $panel_design_style
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'page_background_color',
                'type'        => 'color',
                'label'       => esc_html__('Page Background Color', 'hue'),
                'description' => esc_html__('Choose the background color for page content. Default color is #ffffff', 'hue'),
                'parent'      => $panel_design_style
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'selection_color',
                'type'        => 'color',
                'label'       => esc_html__('Text Selection Color', 'hue'),
                'description' => esc_html__('Choose the color users see when selecting text', 'hue'),
                'parent'      => $panel_design_style
            )
        );

        $group_gradient = hue_mikado_add_admin_group(array(
            'name'        => 'group_gradient',
            'title'       => esc_html__('Gradient Colors', 'hue'),
            'description' => esc_html__('Define colors for gradient styles', 'hue'),
            'parent'      => $panel_design_style
        ));

        $row_gradient_style1 = hue_mikado_add_admin_row(array(
            'name'   => 'row_gradient_style1',
            'parent' => $group_gradient
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style1_start_color',
            'default_value' => '#e14b4f',
            'label'         => esc_html__('Style 1 - Start Color (def. #e14b4f)', 'hue'),
            'parent'        => $row_gradient_style1
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style1_end_color',
            'default_value' => '#58b0e3',
            'label'         => esc_html__('Style 1 - End Color (def. #58b0e3)', 'hue'),
            'parent'        => $row_gradient_style1
        ));

        $row_gradient_style2 = hue_mikado_add_admin_row(array(
            'name'   => 'row_gradient_style2',
            'parent' => $group_gradient
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style2_start_color',
            'default_value' => '#d4145a',
            'label'         => esc_html__('Style 2 - Start Color (def. #d4145a)', 'hue'),
            'parent'        => $row_gradient_style2
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style2_end_color',
            'default_value' => '#e8664a',
            'label'         => esc_html__('Style 2 - End Color (def. #e8664a)', 'hue'),
            'parent'        => $row_gradient_style2
        ));

        $row_gradient_style3 = hue_mikado_add_admin_row(array(
            'name'   => 'row_gradient_style3',
            'parent' => $group_gradient
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style3_start_color',
            'default_value' => '#0caaaa',
            'label'         => esc_html__('Style 3 - Start Color (def. #0caaaa)', 'hue'),
            'parent'        => $row_gradient_style3
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style3_end_color',
            'default_value' => '#63aed3',
            'label'         => esc_html__('Style 3 - End Color (def. #63aed3)', 'hue'),
            'parent'        => $row_gradient_style3
        ));

        $row_gradient_style4 = hue_mikado_add_admin_row(array(
            'name'   => 'row_gradient_style4',
            'parent' => $group_gradient
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style4_start_color',
            'default_value' => '#f5bd24',
            'label'         => esc_html__('Style 4 - Start Color (def. #f5bd24)', 'hue'),
            'parent'        => $row_gradient_style4
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style4_end_color',
            'default_value' => '#ffd33c',
            'label'         => esc_html__('Style 4 - End Color (def. #ffd33c)', 'hue'),
            'parent'        => $row_gradient_style4
        ));

        $row_gradient_style5 = hue_mikado_add_admin_row(array(
            'name'   => 'row_gradient_style5',
            'parent' => $group_gradient
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style5_start_color',
            'default_value' => '#48316b',
            'label'         => esc_html__('Style 5 - Start Color (def. #48316b)', 'hue'),
            'parent'        => $row_gradient_style5
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style5_end_color',
            'default_value' => '#913156',
            'label'         => esc_html__('Style 5 - End Color (def. #913156)', 'hue'),
            'parent'        => $row_gradient_style5
        ));

        $row_gradient_style6 = hue_mikado_add_admin_row(array(
            'name'   => 'row_gradient_style6',
            'parent' => $group_gradient
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style6_start_color',
            'default_value' => '#3a3897',
            'label'         => esc_html__('Style 6 - Start Color (def. #3a3897)', 'hue'),
            'parent'        => $row_gradient_style6
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'gradient_style6_end_color',
            'default_value' => '#00ffee',
            'label'         => esc_html__('Style 6 - End Color (def. #00ffee)', 'hue'),
            'parent'        => $row_gradient_style6
        ));

        hue_mikado_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Boxed Layout', 'hue'),
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_boxed_container"
                )
            )
        );

        $boxed_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_design_style,
                'name'            => 'boxed_container',
                'hidden_property' => 'boxed',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'page_background_color_in_box',
                'type'        => 'color',
                'label'       => esc_html__('Page Background Color', 'hue'),
                'description' => esc_html__('Choose the page background color outside box.', 'hue'),
                'parent'      => $boxed_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'boxed_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'hue'),
                'description' => esc_html__('Choose an image to be displayed in background', 'hue'),
                'parent'      => $boxed_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'boxed_pattern_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Pattern', 'hue'),
                'description' => esc_html__('Choose an image to be used as background pattern', 'hue'),
                'parent'      => $boxed_container
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment', 'hue'),
                'description'   => esc_html__('Choose background image attachment', 'hue'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'  => 'Fixed',
                    'scroll' => 'Scroll'
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'initial_content_width',
                'type'          => 'select',
                'default_value' => 'grid-1300',
                'label'         => esc_html__('Initial Width of Content', 'hue'),
                'description'   => esc_html__('Choose the initial width of content which is in grid. Applies to pages set to "Default Template" and rows set to "In Grid"', 'hue'),
                'parent'        => $panel_design_style,
                'options'       => array(
                    "grid-1300" => esc_html__("1300px - default", 'hue'),
                    "grid-1200" => "1200px",
                    ""          => "1100px",
                    "grid-1000" => "1000px",
                    "grid-800"  => "800px"
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'preload_pattern_image',
                'type'        => 'image',
                'label'       => esc_html__('Preload Pattern Image', 'hue'),
                'description' => esc_html__('Choose preload pattern image to be displayed until images are loaded', 'hue'),
                'parent'      => $panel_design_style
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'element_appear_amount',
                'type'        => 'text',
                'label'       => esc_html__('Element Appearance', 'hue'),
                'description' => esc_html__('For animated elements, set distance (related to browser bottom) to start the animation', 'hue'),
                'parent'      => $panel_design_style,
                'args'        => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                )
            )
        );

        $panel_settings = hue_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => esc_html__('Behavior', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'smooth_scroll',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Smooth Scroll', 'hue'),
                'description'   => esc_html__('Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'hue'),
                'parent'        => $panel_settings
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'smooth_page_transitions',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Smooth Page Transitions', 'hue'),
                'description'   => esc_html__('Enabling this option will perform a smooth transition between pages when clicking on links.', 'hue'),
                'parent'        => $panel_settings,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_page_transitions_container, #mkd_smooth_pt_spinner_gradient_container"
                )
            )
        );

        $page_transitions_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_settings,
                'name'            => 'page_transitions_container',
                'hidden_property' => 'smooth_page_transitions',
                'hidden_value'    => 'no'
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'   => 'smooth_pt_bgnd_color',
                'type'   => 'color',
                'label'  => esc_html__('Page Loader Background Color', 'hue'),
                'parent' => $page_transitions_container
            )
        );

        $group_pt_spinner_animation = hue_mikado_add_admin_group(array(
            'name'        => 'group_pt_spinner_animation',
            'title'       => esc_html__('Loader Style', 'hue'),
            'description' => esc_html__('Define styles for loader spinner animation', 'hue'),
            'parent'      => $page_transitions_container
        ));

        $row_pt_spinner_animation = hue_mikado_add_admin_row(array(
            'name'   => 'row_pt_spinner_animation',
            'parent' => $group_pt_spinner_animation
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'selectsimple',
            'name'          => 'smooth_pt_spinner_type',
            'default_value' => 'cube',
            'label'         => esc_html__('Spinner Type', 'hue'),
            'parent'        => $row_pt_spinner_animation,
            'options'       => array(
                'pulse'                 => esc_html__('Pulse', 'hue'),
                'double_pulse'          => esc_html__('Double Pulse', 'hue'),
                'cube'                  => esc_html__('Cube', 'hue'),
                'rotating_cubes'        => esc_html__('Rotating Cubes', 'hue'),
                'stripes'               => esc_html__('Stripes', 'hue'),
                'wave'                  => esc_html__('Wave', 'hue'),
                'two_rotating_circles'  => esc_html__('2 Rotating Circles', 'hue'),
                'five_rotating_circles' => esc_html__('5 Rotating Circles', 'hue'),
                'atom'                  => esc_html__('Atom', 'hue'),
                'clock'                 => esc_html__('Clock', 'hue'),
                'mitosis'               => esc_html__('Mitosis', 'hue'),
                'lines'                 => esc_html__('Lines', 'hue'),
                'fussion'               => esc_html__('Fussion', 'hue'),
                'wave_circles'          => esc_html__('Wave Circles', 'hue'),
                'pulse_circles'         => esc_html__('Pulse Circles', 'hue'),
            ),
            'args'          => array(
                "dependence" => true,
                'show'       => array(
                    "pulse"                 => "#mkd_smooth_pt_spinner_gradient_container",
                    "double_pulse"          => "",
                    "cube"                  => "#mkd_smooth_pt_spinner_gradient_container",
                    "rotating_cubes"        => "",
                    "stripes"               => "",
                    "wave"                  => "",
                    "two_rotating_circles"  => "",
                    "five_rotating_circles" => "",
                    "atom"                  => "",
                    "clock"                 => "",
                    "mitosis"               => "",
                    "lines"                 => "",
                    "fussion"               => "",
                    "wave_circles"          => "",
                    "pulse_circles"         => ""
                ),
                'hide'       => array(
                    "pulse"                 => "",
                    "double_pulse"          => "#mkd_smooth_pt_spinner_gradient_container",
                    "cube"                  => "",
                    "rotating_cubes"        => "#mkd_smooth_pt_spinner_gradient_container",
                    "stripes"               => "#mkd_smooth_pt_spinner_gradient_container",
                    "wave"                  => "#mkd_smooth_pt_spinner_gradient_container",
                    "two_rotating_circles"  => "#mkd_smooth_pt_spinner_gradient_container",
                    "five_rotating_circles" => "#mkd_smooth_pt_spinner_gradient_container",
                    "atom"                  => "#mkd_smooth_pt_spinner_gradient_container",
                    "clock"                 => "#mkd_smooth_pt_spinner_gradient_container",
                    "mitosis"               => "#mkd_smooth_pt_spinner_gradient_container",
                    "lines"                 => "#mkd_smooth_pt_spinner_gradient_container",
                    "fussion"               => "#mkd_smooth_pt_spinner_gradient_container",
                    "wave_circles"          => "#mkd_smooth_pt_spinner_gradient_container",
                    "pulse_circles"         => "#mkd_smooth_pt_spinner_gradient_container"
                )
            )
        ));

        hue_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'smooth_pt_spinner_color',
            'default_value' => '',
            'label'         => esc_html__('Spinner Color', 'hue'),
            'parent'        => $row_pt_spinner_animation
        ));


        $smooth_pt_spinner_gradient_container = hue_mikado_add_admin_container(
            array(
                'parent'          => $panel_settings,
                'name'            => 'smooth_pt_spinner_gradient_container',
                'hidden_property' => 'smooth_pt_spinner_type',
                'hidden_value'    => '',
                'hidden_values'   => array(
                    "double_pulse",
                    "rotating_cubes",
                    "stripes",
                    "wave",
                    "two_rotating_circles",
                    "five_rotating_circles",
                    "atom",
                    "clock",
                    "mitosis",
                    "lines",
                    "fussion",
                    "wave_circles",
                    "pulse_circles"
                )
            )
        );

        hue_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'smooth_pt_spinner_gradient',
                'default_value' => 'mkd-type2-gradient-left-bottom-to-right-top',
                'label'         => 'Spinner Gradient Color',
                'parent'        => $smooth_pt_spinner_gradient_container,
                'options'       => hue_mikado_get_gradient_left_bottom_to_right_top_styles('', false)
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'elements_animation_on_touch',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Elements Animation on Mobile/Touch Devices', 'hue'),
                'description'   => esc_html__('Enabling this option will allow elements (shortcodes) to animate on mobile / touch devices', 'hue'),
                'parent'        => $panel_settings
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Show "Back To Top Button"', 'hue'),
                'description'   => esc_html__('Enabling this option will display a Back to Top button on every page', 'hue'),
                'parent'        => $panel_settings
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Responsiveness', 'hue'),
                'description'   => esc_html__('Enabling this option will make all pages responsive', 'hue'),
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = hue_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => esc_html__('Custom Code', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'custom_css',
                'type'        => 'textarea',
                'label'       => esc_html__('Custom CSS', 'hue'),
                'description' => esc_html__('Enter your custom CSS here', 'hue'),
                'parent'      => $panel_custom_code
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'custom_js',
                'type'        => 'textarea',
                'label'       => esc_html__('Custom JS', 'hue'),
                'description' => esc_html__('Enter your custom Javascript here', 'hue'),
                'parent'      => $panel_custom_code
            )
        );

        $panel_google_api = hue_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_google_api',
                'title' => esc_html__('Google API', 'hue')
            )
        );

        hue_mikado_add_admin_field(
            array(
                'name'        => 'google_maps_api_key',
                'type'        => 'text',
                'label'       => esc_html__('Google Maps Api Key', 'hue'),
                'description' => esc_html__('Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'hue'),
                'parent'      => $panel_google_api
            )
        );
    }

    add_action('hue_mikado_options_map', 'hue_mikado_general_options_map', 1);

}