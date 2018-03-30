<?php

if( ! function_exists('uxbarn_ctmzr_init_intro_tab')) {

    function uxbarn_ctmzr_init_intro_tab($wp_customize) {
        
        uxbarn_ctmzr_register_intro_section_tab($wp_customize);
        uxbarn_ctmzr_register_intro_styles($wp_customize);
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_intro_section_tab')) {
    
    function uxbarn_ctmzr_register_intro_section_tab($wp_customize) {
            
        $wp_customize->add_section('uxbarn_sc_page_intro_section', array(
                'title'    => __('Page Intro', 'uxbarn'),
                'description' => __('Customize the styles of page intro.', 'uxbarn'),
                'priority' => '30',
            )
        );
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_intro_styles')) {

    function uxbarn_ctmzr_register_intro_styles($wp_customize) {
        
        // Title color
        $wp_customize->add_setting('uxbarn_sc_page_intro_styles[title_color]', array(
                'default'    => '#333333',
                'type' => 'option',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_page_intro_styles[title_color]', array(
                    'label'        => __('Intro Title Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_page_intro_section',
                    'priority' => '5',
                )
            )
        );
        
        // Body color
        $wp_customize->add_setting('uxbarn_sc_page_intro_styles[body_color]', array(
                'default'    => '#555555',
                'type' => 'option',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_page_intro_styles[body_color]', array(
                    'label'        => __('Intro Body Color', 'uxbarn'),
                    'section'    => 'uxbarn_sc_page_intro_section',
                    'priority' => '10',
                )
            )
        );
        
    }

}
    

?>