<?php

/* ************************************************************************************** 
Cause
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_cause', array(
    'title'    => __( 'Cause Single Page', 'swmtranslate' ),
    'priority' => 91
));

$wp_customize->add_setting( 'swm_cause_page_title', array(
'default' => 'Cause'
));

$wp_customize->add_control( 'swm_cause_page_title', array(
'type'     => 'text',
'label'    => __( 'Cause Page Title', 'swmtranslate' ),
'section'  => 'swm_customizer_cause',
'priority' => 10
));

$wp_customize->add_setting( 'swm_cause_page_title_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_cause_page_title_info', array(
      'label'    => __( 'Enter cause page title to display in cause single page breadcrumbs section.', 'swmtranslate'),
      'settings' => 'swm_cause_page_title_info',
      'section'  => 'swm_customizer_cause',
      'priority' => 11
    ))
);

$wp_customize->add_setting( 'swm_cause_page_url', array(
'default' => '#'
));

$wp_customize->add_control( 'swm_cause_page_url', array(
'type'     => 'text',
'label'    => __( 'Cause Page URL', 'swmtranslate' ),
'section'  => 'swm_customizer_cause',
'priority' => 20
));

$wp_customize->add_setting( 'swm_cause_page_title_url_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_cause_page_title_url_info', array(
      'label'    => __( 'Enter the URL to cause  main page to use in breadcrumbs. ', 'swmtranslate'),
      'settings' => 'swm_cause_page_title_url_info',
      'section'  => 'swm_customizer_cause',
      'priority' => 21
    ))
);

$wp_customize->add_setting( 'swm_cause_comments', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_cause_comments', array(
    'type'     => 'checkbox',
    'label'    => __( 'Display Comments in Cause Single', 'swmtranslate' ),
    'section'  => 'swm_customizer_cause',
    'priority' => 31
));

$wp_customize->add_setting( 'swm_cause_single_image', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_cause_single_image', array(
    'type'     => 'checkbox',
    'label'    => __( 'Display Featured Image', 'swmtranslate' ),
    'section'  => 'swm_customizer_cause',
    'priority' => 32
));