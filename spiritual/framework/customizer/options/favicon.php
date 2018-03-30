<?php

/* ************************************************************************************** 
Favicon
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_favicon', array(
    'title'    => __( 'Favicon', 'swmtranslate' ),
    'priority' => 100
));


$wp_customize->add_setting( 'swm_favicon_section_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_favicon_section_info', array(
      'label'    => __( 
        'Upload 32x32 size favicon.ico image from admin > media section and get favicion.ico image URL to paste in "Favicon .ico image URL" section.', 'swmtranslate' ),
      'section'  => 'swm_customizer_favicon',
      'settings' => 'swm_favicon_section_info',
      'priority' => 1
    ))
);


/* Standard Icon  -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_standard_favicon', array(
    'default' => ''
));

$wp_customize->add_control( 'swm_standard_favicon', array(
    'type'     => 'text',
    'label'    => __( 'Favicon ".ico" image URL - 32x32', 'swmtranslate' ),
    'section'  => 'swm_customizer_favicon',
    'priority' => 5
));

/* Touch Icon (iOS and Android)  -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_favicon_touch' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_favicon_touch', array(
        'label'    => __( 'Touch Icon (iOS &amp; Android) - 152x152', 'swmtranslate' ),
        'section'  => 'swm_customizer_favicon',
        'settings' => 'swm_favicon_touch',
        'priority' => 6
    ))
);

/* Tile Icon (Microsoft) -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_favicon_ms_tile' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_favicon_ms_tile', array(
        'label'    => __( 'Tile Icon (Microsoft) - 144x144', 'swmtranslate' ),
        'section'  => 'swm_customizer_favicon',
        'settings' => 'swm_favicon_ms_tile',
        'priority' => 7
    ))
);

/* Tile Icon Background Color  -------------------------------------------------- */

$wp_customize->add_setting( 'swm_favicon_tile_bg_color', array(
'default' => '#f3f3f3'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_favicon_tile_bg_color', array(
        'label'    => __( 'Tile Icon Background Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_favicon',
        'settings' => 'swm_favicon_tile_bg_color',
        'priority' => 8
    ))
);