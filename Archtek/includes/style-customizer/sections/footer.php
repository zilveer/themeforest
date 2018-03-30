<?php

if( ! function_exists('uxbarn_ctmzr_init_footer_tab')) {
    
    function uxbarn_ctmzr_init_footer_tab($wp_customize) {
        
        uxbarn_ctmzr_register_footer_section_tab($wp_customize);
        uxbarn_ctmzr_register_footer_body_styles($wp_customize);
        uxbarn_ctmzr_register_footer_background_styles($wp_customize);
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_footer_section_tab')) {
    
    function uxbarn_ctmzr_register_footer_section_tab($wp_customize) {
            
        $wp_customize->add_section('uxbarn_sc_footer_section', array(
                'title'    => __('Footer', 'uxbarn'),
                'description' => __('Customize the styles of footer area.', 'uxbarn'),
                'priority' => '40',
            )
        );
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_footer_body_styles')) {

    function uxbarn_ctmzr_register_footer_body_styles($wp_customize) {
        
        // Heading color
        $wp_customize->add_setting('uxbarn_sc_footer_body_styles[heading_color]', array(
                'default'    => '#ffffff',
                'type' => 'option',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_footer_body_styles[heading_color]', array(
                    'label'        => __('Footer Heading Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_footer_section',
                    'priority' => '5',
                )
            )
        );
        
        // Text color
        $wp_customize->add_setting('uxbarn_sc_footer_body_styles[text_color]', array(
                'default'    => '#aaaaaa',
                'type' => 'option',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_footer_body_styles[text_color]', array(
                    'label'        => __('Footer Text Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_footer_section',
                    'priority' => '10',
                )
            )
        );
        
        // Link color
        $wp_customize->add_setting('uxbarn_sc_footer_body_styles[link_color]', array(
                'default'    => '#ffffff',
                'type' => 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_footer_body_styles[link_color]', array(
                    'label'        => __('Footer Link Color (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_footer_section',
                    'priority' => '15',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_footer_body_styles_link_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_footer_body_styles_link_color_desc', 
                array(
                    'label' => __('Only apply to general text hyperlinks.', 'uxbarn'),
                    'section' => 'uxbarn_sc_footer_section',
                    'priority' => '16',
                )
            )
        );
        
        // Hovered link color
        $wp_customize->add_setting('uxbarn_sc_footer_body_styles[link_hover_color]', array(
                'default'    => '#ffffff',
                'type' => 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_footer_body_styles[link_hover_color]', array(
                    'label'        => __('Footer Hovered Link Color (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_footer_section',
                    'priority' => '20',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_footer_body_styles_link_hover_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_footer_body_styles_link_hover_color_desc', 
                array(
                    'label' => __('Only apply to general text hyperlinks.', 'uxbarn'),
                    'section' => 'uxbarn_sc_footer_section',
                    'priority' => '21',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting('uxbarn_sc_footer_section_divider1', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Divider_Custom_Control($wp_customize, 'uxbarn_sc_footer_section_divider1', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_footer_section',
                    'priority' => '22',
                )
            )
        );
        
    }

}


if( ! function_exists('uxbarn_ctmzr_register_footer_background_styles')) {

    function uxbarn_ctmzr_register_footer_background_styles($wp_customize) {
        
        // Footer background color
        $wp_customize->add_setting('uxbarn_sc_footer_background_styles[background_color]', array(
                'default'    => '#383838',
                'type' => 'option',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_footer_background_styles[background_color]', array(
                    'label'        => __('Footer Background Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_footer_section',
                    'priority' => '25',
                )
            )
        );
        
        // Footer background image
        $wp_customize->add_setting('uxbarn_sc_footer_background_styles[background_image]', array(
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'uxbarn_sc_footer_background_styles[background_image]', array(
                    'label'        => __('Footer Background Image', 'uxbarn'),
                    'section'    => 'uxbarn_sc_footer_section',
                    'priority' => '30',
                )
            )
        );
        
        // Footer background attributes's title
        $wp_customize->add_setting('uxbarn_sc_footer_background_styles_background_attr_title', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Title_Custom_Control($wp_customize, 'uxbarn_sc_footer_background_styles_background_attr_title', 
                array(
                    'label' => __('Footer Background Image Attributes', 'uxbarn'),
                    'section' => 'uxbarn_sc_footer_section',
                    'priority' => '31',
                )
            )
        );
        
        // Footer background repeat 
        $wp_customize->add_setting('uxbarn_sc_footer_background_styles[background_repeat]', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_BackgroundRepeat_Custom_Control($wp_customize, 'uxbarn_sc_footer_background_styles[background_repeat]', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_footer_section',
                    'priority' => '32',
                )
            )
        );
        
        // Footer background position 
        $wp_customize->add_setting('uxbarn_sc_footer_background_styles[background_position]', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_BackgroundPosition_Custom_Control($wp_customize, 'uxbarn_sc_footer_background_styles[background_position]', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_footer_section',
                    'priority' => '33',
                )
            )
        );
        
    }
    
}

?>