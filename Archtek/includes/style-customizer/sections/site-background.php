<?php

if( ! function_exists('uxbarn_ctmzr_init_site_bg_tab')) {

    function uxbarn_ctmzr_init_site_bg_tab($wp_customize) {
        
        uxbarn_ctmzr_register_site_bg_section_tab($wp_customize);
        uxbarn_ctmzr_register_site_bg_background_styles($wp_customize);
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_site_bg_section_tab')) {
    
    function uxbarn_ctmzr_register_site_bg_section_tab($wp_customize) {
            
        $wp_customize->add_section('uxbarn_sc_site_background_styles_section', array(
                'title'    => __('Site Background', 'uxbarn'),
                'description' => __('Customize the styles of site background', 'uxbarn'),
                'priority' => '10',
            )
        );
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_site_bg_background_styles')) {
    
    function uxbarn_ctmzr_register_site_bg_background_styles($wp_customize) {
        
        // Site background color
        $wp_customize->add_setting('uxbarn_sc_site_background_styles[background_color]', array(
                'default'    => '#f5f5f5',
                'type' => 'option',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_site_background_styles[background_color]', array(
                    'label'        => __('Background Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_site_background_styles_section',
                    'priority' => '10',
                )
            )
        );
        
        // Site background image
        $wp_customize->add_setting('uxbarn_sc_site_background_styles[background_image]', array(
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'uxbarn_sc_site_background_styles[background_image]', array(
                    'label'        => __('Background Image', 'uxbarn'),
                    'section'    => 'uxbarn_sc_site_background_styles_section',
                    'priority' => '20',
                )
            )
        );
        
        // Site background attributes's title
        $wp_customize->add_setting('uxbarn_sc_site_background_styles_background_attr_title', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Title_Custom_Control($wp_customize, 'uxbarn_sc_site_background_styles_background_attr_title', 
                array(
                    'label' => __('Background Image Attributes', 'uxbarn'),
                    'section' => 'uxbarn_sc_site_background_styles_section',
                    'priority' => '21',
                )
            )
        );
        
        // Site background repeat 
        $wp_customize->add_setting('uxbarn_sc_site_background_styles[background_repeat]', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_BackgroundRepeat_Custom_Control($wp_customize, 'uxbarn_sc_site_background_styles[background_repeat]', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_site_background_styles_section',
                    'priority' => '22',
                )
            )
        );
        
        // Site background position 
        $wp_customize->add_setting('uxbarn_sc_site_background_styles[background_position]', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_BackgroundPosition_Custom_Control($wp_customize, 'uxbarn_sc_site_background_styles[background_position]', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_site_background_styles_section',
                    'priority' => '23',
                )
            )
        );
        
    }

}
    
?>