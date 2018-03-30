<?php

/* ************************************************************************************** 
Custom CSS Javascripts
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_scripts', array(
    'title'    => __( 'Custom CSS Javascripts', 'swmtranslate' ),
    'priority' => 140
));

$wp_customize->add_setting( 'swm_scripts_section_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_scripts_section_info', array(
      'label'    => __('You can use this section to add quick css and javascripts for minor changes. Please use custom.css for major portions css changes.', 'swmtranslate' ),
      'section'  => 'swm_customizer_scripts',
      'settings' => 'swm_scripts_section_info',
      'priority' => 1
    ))
);

$wp_customize->add_setting( 'swm_custom_css');  

$wp_customize->add_control(
    new SWM_Customize_Control_Textarea( $wp_customize, 'swm_custom_css', array(
      'label'    => __( 'CSS', 'swmtranslate' ),
      'section'  => 'swm_customizer_scripts',
      'settings' => 'swm_custom_css',
      'priority' => 2
    ))
);

$wp_customize->add_setting( 'swm_custom_js');  

$wp_customize->add_control(
    new SWM_Customize_Control_Textarea( $wp_customize, 'swm_custom_js', array(
      'label'    => __( 'Javascript', 'swmtranslate' ),
      'section'  => 'swm_customizer_scripts',
      'settings' => 'swm_custom_js',
      'priority' => 3
    ))
);