<?php

/* ************************************************************************************** 
Portfolio
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_portfolio', array(
    'title'    => __( 'Portfolio', 'swmtranslate' ),
    'priority' => 90
));

$wp_customize->add_setting( 'swm_portfolio_page_title', array(
'default' => 'Portfolio'
));

$wp_customize->add_control( 'swm_portfolio_page_title', array(
'type'     => 'text',
'label'    => __( 'Portfolio Page Title', 'swmtranslate' ),
'section'  => 'swm_customizer_portfolio',
'priority' => 10
));

$wp_customize->add_setting( 'swm_portfolio_page_title_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_portfolio_page_title_info', array(
      'label'    => __( 'Enter portfolio page title to display in portfolio single page breadcrumbs section.', 'swmtranslate'),
      'settings' => 'swm_portfolio_page_title_info',
      'section'  => 'swm_customizer_portfolio',
      'priority' => 11
    ))
);

$wp_customize->add_setting( 'swm_portfolio_page_url', array(
'default' => '#'
));

$wp_customize->add_control( 'swm_portfolio_page_url', array(
'type'     => 'text',
'label'    => __( 'Portfolio Page URL', 'swmtranslate' ),
'section'  => 'swm_customizer_portfolio',
'priority' => 20
));

$wp_customize->add_setting( 'swm_portfolio_page_title_url_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_portfolio_page_title_url_info', array(
      'label'    => __( 'Enter the URL to portfolio main page to use in breadcrumbs. ', 'swmtranslate'),
      'settings' => 'swm_portfolio_page_title_url_info',
      'section'  => 'swm_customizer_portfolio',
      'priority' => 21
    ))
);

$wp_customize->add_setting( 'swm_portfolio_comments', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_portfolio_comments', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Comments in Portfolio Single', 'swmtranslate' ),
    'section'  => 'swm_customizer_portfolio',
    'priority' => 31
));


