<?php

if( ! function_exists('uxbarn_ctmzr_register_readme')) {

    function uxbarn_ctmzr_register_readme($wp_customize) {
        $wp_customize->add_section('uxbarn_sc_readme_section', array(
                'title'    => __('*** Read Me First ***', 'uxbarn'),
                'description' => '',
                'priority' => '1',
            )
        );
        
        // Description
        $wp_customize->add_setting('uxbarn_sc_readme_description', array(
            'default' => '',
        ));
        $wp_customize->add_control(new WP_Customize_Description_Custom_Control($wp_customize, 'uxbarn_sc_readme_description', 
                array(
                    'label' => __('<strong>Welcome to Style Customizer!</strong><p>Here are some guidelines:</p><ul id="ux-customizer-readme"><li>The customizer is categorized into sections. You can use each tab section for customizing the styles and see the preview on the right.</li><li>Some options that end with <strong>(R)</strong> means that they need to reload the preview screen to see your changes. So wait a sec to see the result.</li><li>In case you want to adjust anything more than provided options, please apply your CSS in the "Custom CSS" box on the "Others" section.</li><li>To use Google Fonts, close this customizer then go to "Theme Options > Google Fonts" to add the fonts you like and they will be available in the font select lists in the customizer.</li></ul>', 'uxbarn'),
                    'section' => 'uxbarn_sc_readme_section',
                    'priority' => '31',
                )
            )
        );
        
    }

}
    

?>