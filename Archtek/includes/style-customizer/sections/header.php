<?php

if( ! function_exists('uxbarn_ctmzr_init_header_tab')) {
    
    function uxbarn_ctmzr_init_header_tab($wp_customize) {
        
        uxbarn_ctmzr_register_header_section_tab($wp_customize);
        uxbarn_ctmzr_register_header_logo($wp_customize);
        uxbarn_ctmzr_register_header_background($wp_customize);
        uxbarn_ctmzr_register_header_text($wp_customize);
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_header_section_tab')) {
    
    function uxbarn_ctmzr_register_header_section_tab($wp_customize) {
            
        $wp_customize->add_section('uxbarn_sc_header_section', array(
                'title'    => __('Header', 'uxbarn'),
                'description' => __('Customize the header styles', 'uxbarn'),
                'priority' => '15',
            )
        );
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_header_logo')) {
    
    function uxbarn_ctmzr_register_header_logo($wp_customize) {
        
        // Logo image upload
        $wp_customize->add_setting('uxbarn_sc_header_site_logo', array(
                'default' => '',
                'type' => 'option',
        )); 
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'uxbarn_sc_header_site_logo', array(
                'label'        => __('Site Logo (R)', 'uxbarn'),
                'section'    => 'uxbarn_sc_header_section',
                'priority' => '5',
        )));
        // Description
        $wp_customize->add_setting('uxbarn_sc_header_styles_logo_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_header_styles_logo_desc', 
                array(
                    'label' => __('If not set, site name will display.', 'uxbarn'),
                    'section' => 'uxbarn_sc_header_section',
                    'priority' => '6',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting('uxbarn_sc_header_section_divider1', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Divider_Custom_Control($wp_customize, 'uxbarn_sc_header_section_divider1', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_header_section',
                    'priority' => '7',
                )
            )
        );
        
    }

}


if( ! function_exists('uxbarn_ctmzr_register_header_background')) {
    
    function uxbarn_ctmzr_register_header_background($wp_customize) {
        
        // Header bg color
        $wp_customize->add_setting('uxbarn_sc_header_styles[background_color]', array(
                'default'    => '#000000',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_header_styles[background_color]', array(
                    'label'        => __('Header Background Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_header_section',
                    'priority' => '10',
                )
            )
        );
        
        // Bg color opacity
        $wp_customize->add_setting('uxbarn_sc_header_styles_background_opacity', array(
                'default' => '0.8',
                'type' => 'option',
                'transport' => 'postMessage',
        )); 
        $wp_customize->add_control('uxbarn_sc_header_styles_background_opacity', array(
            'label'   => __('Header Background Color Opacity', 'uxbarn'),
            'section' => 'uxbarn_sc_header_section',
            'type'    => 'select',
            'choices'    => uxbarn_ctmzr_get_opacity_array(),
            'priority' => '15',
        ));
        
        
        // Header bg image
        $wp_customize->add_setting('uxbarn_sc_header_styles[background_image]', array(
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'uxbarn_sc_header_styles[background_image]', array(
                    'label'        => __('Header Background Image', 'uxbarn'),
                    'section'    => 'uxbarn_sc_header_section',
                    'priority' => '20',
                )
            )
        );
        
        // Header bg attributes's title
        $wp_customize->add_setting('uxbarn_sc_header_styles_background_attr_title', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Title_Custom_Control($wp_customize, 'uxbarn_sc_header_styles_background_attr_title', 
                array(
                    'label' => __('Header Background Image Attributes', 'uxbarn'),
                    'section' => 'uxbarn_sc_header_section',
                    'priority' => '21',
                )
            )
        );
        
        // Header bg repeat 
        $wp_customize->add_setting('uxbarn_sc_header_styles[background_repeat]', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_BackgroundRepeat_Custom_Control($wp_customize, 'uxbarn_sc_header_styles[background_repeat]', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_header_section',
                    'priority' => '22',
                )
            )
        );
        
        // Header bg position 
        $wp_customize->add_setting('uxbarn_sc_header_styles[background_position]', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_BackgroundPosition_Custom_Control($wp_customize, 'uxbarn_sc_header_styles[background_position]', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_header_section',
                    'priority' => '23',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting('uxbarn_sc_header_section_divider2', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Divider_Custom_Control($wp_customize, 'uxbarn_sc_header_section_divider2', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_header_section',
                    'priority' => '26',
                )
            )
        );
        
    }

}


if( ! function_exists('uxbarn_ctmzr_register_header_text')) {
    
    function uxbarn_ctmzr_register_header_text($wp_customize) {
        
        // Header text color
        $wp_customize->add_setting('uxbarn_sc_header_styles[text_color]', array(
                'default'    => '#ffffff',
                'type' => 'option',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_header_styles[text_color]', array(
                    'label'        => __('Header Text Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_header_section',
                    'priority' => '30',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_header_styles_text_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_header_styles_text_color_desc', 
                array(
                    'label' => __('This color is for site name (if not use logo image) and tagline only. For menu text color, please use "Menu" tab.', 'uxbarn'),
                    'section' => 'uxbarn_sc_header_section',
                    'priority' => '31',
                )
            )
        );
        
    }

}
    