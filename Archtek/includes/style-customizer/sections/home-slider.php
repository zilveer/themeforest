<?php

if( ! function_exists('uxbarn_ctmzr_init_homeslider_tab')) {

    function uxbarn_ctmzr_init_homeslider_tab($wp_customize) {
        
        uxbarn_ctmzr_register_homeslider_section_tab($wp_customize);
        uxbarn_ctmzr_register_homeslider_caption_styles($wp_customize);
        uxbarn_ctmzr_register_homeslider_controller_styles($wp_customize);
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_homeslider_section_tab')) {
    
    function uxbarn_ctmzr_register_homeslider_section_tab($wp_customize) {
            
        $wp_customize->add_section('uxbarn_sc_home_slider_section', array(
                'title'    => __('Home Slider', 'uxbarn'),
                'description' => __('Customize the styles of basic home slider.', 'uxbarn'),
                'priority' => '25',
            )
        );
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_homeslider_caption_styles')) {
    
    function uxbarn_ctmzr_register_homeslider_caption_styles($wp_customize) {
        
        // Special desc
        $wp_customize->add_setting('uxbarn_sc_home_slider_section_special_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_home_slider_section_special_desc', 
                array(
                    'label' => __('<strong>Note:</strong> These options work with "Basic Slider" type only.', 'uxbarn'),
                    'section' => 'uxbarn_sc_home_slider_section',
                    'priority' => '1',
                )
            )
        );
        
        // Caption title
        $wp_customize->add_setting('uxbarn_sc_home_slider_styles[title_color]', array(
                'default'    => '#ffffff',
                'type' => 'option',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_home_slider_styles[title_color]', array(
                    'label'        => __('Caption Title Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_home_slider_section',
                    'priority' => '5',
                )
            )
        );
        
        // Caption body
        $wp_customize->add_setting('uxbarn_sc_home_slider_styles[body_color]', array(
                'default'    => '#ffffff',
                'type' => 'option',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_home_slider_styles[body_color]', array(
                    'label'        => __('Caption Body Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_home_slider_section',
                    'priority' => '10',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting('uxbarn_sc_home_slider_section_divider1', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Divider_Custom_Control($wp_customize, 'uxbarn_sc_home_slider_section_divider1', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_home_slider_section',
                    'priority' => '11',
                )
            )
        );
        
    }

}



if( ! function_exists('uxbarn_ctmzr_register_homeslider_controller_styles')) {

    function uxbarn_ctmzr_register_homeslider_controller_styles($wp_customize) {
        
        // Controller color
        $wp_customize->add_setting('uxbarn_sc_home_slider_styles[controller_color]', array(
                'default'    => '#000000',
                'type' => 'option',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_home_slider_styles[controller_color]', array(
                    'label'        => __('Controller Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_home_slider_section',
                    'priority' => '15',
                )
            )
        );
        
    }
	
}
    

?>