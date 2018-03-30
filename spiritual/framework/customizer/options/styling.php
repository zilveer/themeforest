<?php

/* ************************************************************************************** 
Styling
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_styling', array(
    'title'    => __( 'Styling', 'swmtranslate' ),
    'priority' => 30
));

$wp_customize->add_setting( 'swm_customizer_styling_settings' );

/* Primary Skin Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_primary_skin_color', array(
    'default' => '#da5455'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_primary_skin_color', array(
        'label'    => __( 'Primary Skin Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_primary_skin_color',
        'priority' => 1
    ))
);

/* Secondary Skin Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_secondary_skin_color', array(
'default' => '#2e2e2e'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_secondary_skin_color', array(
        'label'    => __( 'Secondary Skin Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_secondary_skin_color',
        'priority' => 2
    ))
);


/* Text Color on Skin Color Background -------------------------------------------------- */

$wp_customize->add_setting( 'swm_text_color_on_skin_color_bg', array(
'default' => '#ffffff'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'text_color_on_skin_color_bg', array(
        'label'    => __( 'Text Color on Primary Skin Color Background', 'swmtranslate' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_text_color_on_skin_color_bg',
        'priority' => 3
    ))
);

/* ************************************************************************************** 
Background
************************************************************************************** */


$wp_customize->add_setting( 'swm_body_background' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_body_background', array(
        'label'    => __( 'Body Background', 'swmtranslate' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_body_background',
        'priority' => 10
    ))
);


/* Background Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_body_bg_color', array(
    'default' => '#606060'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_body_bg_color', array(
        'label'    => __( 'Body Background Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_body_bg_color',
        'priority' => 11
    ))
);


/* Background Image -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_body_bg_image' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_body_bg_image', array(
        'label'    => __( 'Background Image', 'swmtranslate' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_body_bg_image',
        'priority' => 12
    ))
);

/* Background Image Position -------------------------------------------------- */

$wp_customize->add_setting( 'swm_body_bg_position', array(
    'default' => 'center'
));

$wp_customize->add_control( 'swm_body_bg_position', array(
    'type'     => 'select',
    'label'    => __( 'Image Position', 'swmtranslate' ),
    'section'  => 'swm_customizer_styling',
    'priority' => 13,
    'choices'  => array(
        "left-top"      => __( 'Left Top', 'swmtranslate' ),
        "left-center"   => __( 'Left Center', 'swmtranslate' ),
        "left-bottom"   => __( 'Left Bottom', 'swmtranslate' ),
        "right-top"     => __( 'Right Top', 'swmtranslate' ),
        "right-center"  => __( 'Right Center', 'swmtranslate' ),
        "right-bottom"  => __( 'Right Bottom', 'swmtranslate' ),
        "center-top"    => __( 'Center Top', 'swmtranslate' ),
        "center-center" => __( 'Center Center', 'swmtranslate' ),
        "center-bottom" => __( 'Center Bottom', 'swmtranslate' )
    )
));

/* Background Image Repeat -------------------------------------------------- */

$wp_customize->add_setting( 'swm_body_bg_repeat', array(
    'default' => 'repeat'
));

$wp_customize->add_control( 'swm_body_bg_repeat', array(
    'type'     => 'select',
    'label'    => __( 'Image Repeat', 'swmtranslate' ),
    'section'  => 'swm_customizer_styling',
    'priority' => 14,
    'choices'  => array(
        'repeat'    => __( 'Repeat', 'swmtranslate' ),
        'no-repeat' => __( 'No Repeat', 'swmtranslate' ),
        'repeat-x'  => __( 'Repeat X', 'swmtranslate' ),
        'repeat-y'  => __( 'Repeat Y', 'swmtranslate' )       
    )
));

/* Background Image Attachment -------------------------------------------------- */

$wp_customize->add_setting( 'swm_body_bg_attachment', array(
    'default' => 'scroll'
));

$wp_customize->add_control( 'swm_body_bg_attachment', array(
    'type'     => 'select',
    'label'    => __( 'Attachment', 'swmtranslate' ),
    'section'  => 'swm_customizer_styling',
    'priority' => 15,
    'choices'  => array(
        'scroll' => __( 'Scroll', 'swmtranslate' ),
        'fixed'      => __( 'Fixed', 'swmtranslate' )
    )
));

$wp_customize->add_setting( 'swm_body_bg_stretch', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_body_bg_stretch', array(
    'type'     => 'checkbox',
    'label'    => __( '100% Background Image Width', 'swmtranslate' ),
    'section'  => 'swm_customizer_styling',
    'priority' => 15 
));