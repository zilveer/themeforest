<?php

if( ! function_exists('uxbarn_ctmzr_init_others_tab')) {
    
    function uxbarn_ctmzr_init_others_tab($wp_customize) {
        
        uxbarn_ctmzr_register_others_section_tab($wp_customize);
        uxbarn_ctmzr_register_others_text_selection($wp_customize);
        uxbarn_ctmzr_register_others_custom_css($wp_customize);
        uxbarn_ctmzr_register_others_reset_styles($wp_customize);
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_others_section_tab')) {
    
    function uxbarn_ctmzr_register_others_section_tab($wp_customize) {
            
        // Other Styles section
        $wp_customize->add_section('uxbarn_sc_other_styles_section', array(
                'title'    => __('Others', 'uxbarn'),
                'description' => __('Customize the any other styles', 'uxbarn'),
                'priority' => '100',
            )
        );
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_others_text_selection')) {
    
    function uxbarn_ctmzr_register_others_text_selection($wp_customize) {
        
        // Text selection
        $wp_customize->add_setting('uxbarn_sc_other_styles[text_selection_color]', array(
                'default'    => uxbarn_ctmzr_get_default_color_by_scheme(),
                'type' => 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'uxbarn_sc_other_styles[text_selection_color]', array(
                    'label'        => __('Text Selection Color (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_other_styles_section',
                    'priority' => '5',
                )
            )
        );
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_register_others_custom_css')) {
    
    function uxbarn_ctmzr_register_others_custom_css($wp_customize) {
        
        // Custom CSS
        $wp_customize->add_setting('uxbarn_sc_other_styles_custom_css', array(
                'default'    => '',
                'type' => 'option',
                'sanitize_callback' => 'uxbarn_ctmzr_sanitize_custom_css',
                //'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Textarea_Custom_Control($wp_customize, 'uxbarn_sc_other_styles_custom_css', array(
                    'label'        => __('Custom CSS (R)', 'uxbarn'),
                    'section'    => 'uxbarn_sc_other_styles_section',
                    'priority' => '10',
                )
            )
        );
        // Description
        $wp_customize->add_setting('uxbarn_sc_other_styles_custom_css_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_other_styles_custom_css_desc', 
                array(
                    'label' => __('<strong>Tip:</strong> If you are using a correct CSS selector but your custom CSS still doesn\'t work, try putting "!important" tag right after your CSS property. <a href="http://webdesign.about.com/od/css/f/blcssfaqimportn.htm" target="_blank">Click here to learn more about "!important"</a>.<p><strong>Note:</strong> After entering the custom CSS, wait for the preview screen to refresh to see your changes.</p>', 'uxbarn'),
                    'section' => 'uxbarn_sc_other_styles_section',
                    'priority' => '15',
                )
            )
        );
        
        
        // Divider
        $wp_customize->add_setting('uxbarn_sc_other_styles_divider1', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control(new WP_Customize_Divider_Custom_Control($wp_customize, 'uxbarn_sc_other_styles_divider1', array(
                    'label'        => '',
                    'section'    => 'uxbarn_sc_other_styles_section',
                    'priority' => '20',
                )
            )
        );
        
        
    }
    
}
    
    
if( ! function_exists('uxbarn_ctmzr_register_others_reset_styles')) {

    function uxbarn_ctmzr_register_others_reset_styles($wp_customize) {
    	
        // Reset to default styles
        $wp_customize->add_setting('uxbarn_sc_reset_to_default', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'wp_strip_all_tags',
        )); 
        $wp_customize->add_control('uxbarn_sc_reset_to_default', array(
            'label'   => __('Reset Box (R)', 'uxbarn'),
            'section' => 'uxbarn_sc_other_styles_section',
            'type'    => 'text',
            'priority' => '25',
        ));
        
        // Description
        $wp_customize->add_setting('uxbarn_sc_other_styles_use_default_styles', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_other_styles_use_default_styles', 
                array(
                    'label' => __('If you want to reset all styles to the default, type "<strong>reset_styles</strong>" into the textbox above and wait until you notice the preview is refreshed. <p><strong style="color: red">*** After finished typing, the styles will be reset immediately so please be careful using this!</strong></p><p><strong>Note:</strong> The style options and preview screen will not be updated immediately after you finished typing or save, please reload the page or close this Style Customizer and re-open it again.</p>', 'uxbarn'),
                    'section' => 'uxbarn_sc_other_styles_section',
                    'priority' => '30',
                )
            )
        );
    }

}
    

?>