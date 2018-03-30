<?php

/* ************************************************************************************** 
Sermons
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_sermons', array(
    'title'    => __( 'Sermons Single Page', 'swmtranslate' ),
    'priority' => 91
));

$wp_customize->add_setting( 'swm_sermons_page_title', array(
'default' => 'Sermons'
));

$wp_customize->add_control( 'swm_sermons_page_title', array(
'type'     => 'text',
'label'    => __( 'Sermons Page Title', 'swmtranslate' ),
'section'  => 'swm_customizer_sermons',
'priority' => 10
));

$wp_customize->add_setting( 'swm_sermons_page_title_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_sermons_page_title_info', array(
      'label'    => __( 'Enter Sermons page title to display in Sermons single page breadcrumbs section.', 'swmtranslate'),
      'settings' => 'swm_sermons_page_title_info',
      'section'  => 'swm_customizer_sermons',
      'priority' => 11
    ))
);

$wp_customize->add_setting( 'swm_sermons_page_url', array(
'default' => '#'
));

$wp_customize->add_control( 'swm_sermons_page_url', array(
'type'     => 'text',
'label'    => __( 'Sermons Page URL', 'swmtranslate' ),
'section'  => 'swm_customizer_sermons',
'priority' => 20
));

$wp_customize->add_setting( 'swm_sermons_page_title_url_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_sermons_page_title_url_info', array(
      'label'    => __( 'Enter the URL to Sermons  main page to use in breadcrumbs. ', 'swmtranslate'),
      'settings' => 'swm_sermons_page_title_url_info',
      'section'  => 'swm_customizer_sermons',
      'priority' => 21
    ))
);

$wp_customize->add_setting( 'swm_sermons_comments', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_sermons_comments', array(
    'type'     => 'checkbox',
    'label'    => __( 'Display Comments', 'swmtranslate' ),
    'section'  => 'swm_customizer_sermons',
    'priority' => 31
));

$wp_customize->add_setting( 'swm_sermons_single_image', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_sermons_single_image', array(
    'type'     => 'checkbox',
    'label'    => __( 'Display Featured Image', 'swmtranslate' ),
    'section'  => 'swm_customizer_sermons',
    'priority' => 32
));