<?php

if( ! function_exists('uxbarn_ctmzr_init_menu_tab')) {

    function uxbarn_ctmzr_init_menu_tab($wp_customize) {
        
        uxbarn_ctmzr_register_menu_section_tab($wp_customize);
        uxbarn_ctmzr_register_menu($wp_customize);
        uxbarn_ctmzr_register_submenu($wp_customize);
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_menu_section_tab')) {
    
    function uxbarn_ctmzr_register_menu_section_tab($wp_customize) {
            
        $wp_customize->add_section('uxbarn_sc_menu_section', array(
                'title'    => __('Menu', 'uxbarn'),
                'description' => __('Customize the menu styles', 'uxbarn'),
                'priority' => '20',
            )
        );
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_menu')) {
    
    function uxbarn_ctmzr_register_menu($wp_customize) {
        
        // Menu color
        $wp_customize->add_setting('uxbarn_sc_menu_styles[color]', array(
                'default'    => '#a9a9a9',
                'type' => 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_menu_styles[color]', array(
                    'label'        => __('Menu Color (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_menu_section',
                    'priority' => '5',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_menu_styles_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_menu_styles_color_desc', 
                array(
                    'label' => __('Adjust text color for menu items.', 'uxbarn'),
                    'section' => 'uxbarn_sc_menu_section',
                    'priority' => '6',
                )
            )
        );
        
        // Menu hover color
        $wp_customize->add_setting('uxbarn_sc_menu_styles[hover_color]', array(
                'default'    => '#444444',
                'type' => 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_menu_styles[hover_color]', array(
                    'label'        => __('Hovered Menu Color (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_menu_section',
                    'priority' => '10',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_menu_styles_hover_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_menu_styles_hover_color_desc', 
                array(
                    'label' => __('Adjust text color for hovered menu items.', 'uxbarn'),
                    'section' => 'uxbarn_sc_menu_section',
                    'priority' => '11',
                )
            )
        );
        
        // Menu active color
        $wp_customize->add_setting('uxbarn_sc_menu_styles[active_color]', array(
                'default'    => '#ffffff',
                'type' => 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_menu_styles[active_color]', array(
                    'label'        => __('Active Menu Color (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_menu_section',
                    'priority' => '15',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_menu_styles_active_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_menu_styles_active_color_desc', 
                array(
                    'label' => __('Adjust text color for active menu items.', 'uxbarn'),
                    'section' => 'uxbarn_sc_menu_section',
                    'priority' => '16',
                )
            )
        );
        
        // Hovered active menu color
        $wp_customize->add_setting('uxbarn_sc_menu_styles[hover_active_color]', array(
                'default'    => '#000000',
                'type' => 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_menu_styles[hover_active_color]', array(
                    'label'        => __('Hovered Active Menu Color (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_menu_section',
                    'priority' => '17',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_menu_styles_active_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_menu_styles_active_color_desc', 
                array(
                    'label' => __('Adjust text color for active menu items when hovered.', 'uxbarn'),
                    'section' => 'uxbarn_sc_menu_section',
                    'priority' => '18',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting('uxbarn_sc_menu_section_divider1', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Divider_Custom_Control($wp_customize, 'uxbarn_sc_menu_section_divider1', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_menu_section',
                    'priority' => '19',
                )
            )
        );
        
        
    }

}


if( ! function_exists('uxbarn_ctmzr_register_submenu')) {

    function uxbarn_ctmzr_register_submenu($wp_customize) {
        
        // Submenu panel color
        $wp_customize->add_setting('uxbarn_sc_submenu_styles[background_color]', array(
                'default'    => '#dfdee4',
                'type' => 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_submenu_styles[background_color]', array(
                    'label'        => __('Submenu Background Color (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_menu_section',
                    'priority' => '20',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_submenu_styles_panel_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_submenu_styles_panel_color_desc', 
                array(
                    'label' => __('Adjust the background color of submenu panel.', 'uxbarn'),
                    'section' => 'uxbarn_sc_menu_section',
                    'priority' => '21',
                )
            )
        );
        
        
        // Submenu color
        $wp_customize->add_setting('uxbarn_sc_submenu_styles[color]', array(
                'default'    => '#5A5858',
                'type' => 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_submenu_styles[color]', array(
                    'label'        => __('Submenu Color (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_menu_section',
                    'priority' => '25',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_submenu_styles_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_submenu_styles_color_desc', 
                array(
                    'label' => __('Adjust text color for submenu items.', 'uxbarn'),
                    'section' => 'uxbarn_sc_menu_section',
                    'priority' => '26',
                )
            )
        );
        
        // Submenu hover color
        $wp_customize->add_setting('uxbarn_sc_submenu_styles[hover_color]', array(
                'default'    => uxbarn_ctmzr_get_default_color_by_scheme(),
                'type' => 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_submenu_styles[hover_color]', array(
                    'label'        => __('Hovered Submenu Color (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_menu_section',
                    'priority' => '30',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_submenu_styles_hover_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_submenu_styles_hover_color_desc', 
                array(
                    'label' => __('Adjust text color for hovered submenu items.', 'uxbarn'),
                    'section' => 'uxbarn_sc_menu_section',
                    'priority' => '31',
                )
            )
        );
        
    }

}
    