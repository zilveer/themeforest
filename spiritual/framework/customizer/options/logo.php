<?php

/* ************************************************************************************** 
Logo
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_logo', array(
    'title'    => __( 'Logo Section', 'swmtranslate' ),
    'priority' => 20
));

$wp_customize->add_setting( 'swm_customizer_logo_settings' );

$wp_customize->add_setting( 'swm_logo_section_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_logo_section_info', array(
      'label'    => __( 
        'Upload standard and retina logo. Retina logo should be double of standard logo. For example standard logo size is 100x50 then retina logo size should be 200x100. If you do not want to add retina logo then use standard logo in retina logo upload section. Standard logo width is necessary to adjust size in retina display.', 'swmtranslate' ),
      'section'  => 'swm_customizer_logo',
      'settings' => 'swm_logo_section_info',
      'priority' => 1
    ))
);

/* Logo Width -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_logo_width', array(
'default' => '142'
));

$wp_customize->add_control( 'swm_logo_width', array(
'type'     => 'text',
'label'    => __( 'Standard Logo Width ( Only Number)', 'swmtranslate' ),
'section'  => 'swm_customizer_logo',
'priority' => 2
));


/* Logo Standard -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_logo_standard' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_logo_standard', array(
        'label'    => __( 'Standard Logo Image', 'swmtranslate' ),
        'section'  => 'swm_customizer_logo',
        'settings' => 'swm_logo_standard',
        'priority' => 5
    ))
);


/* Logo Retina -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_logo_retina' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_logo_retina', array(
        'label'    => __( 'Retina Logo Image', 'swmtranslate' ),
        'section'  => 'swm_customizer_logo',
        'settings' => 'swm_logo_retina',
        'priority' => 6
    ))
);

/* Logo Background Image and Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_logo_bg_color', array(
    'default' => '#2e2e2e'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_logo_bg_color', array(
        'label'    => __( 'Logo Section Background Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_logo',
        'settings' => 'swm_logo_bg_color',
        'priority' => 7
    ))
);

$wp_customize->add_setting( 'swm_logo_bg_image' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_logo_bg_image', array(
        'label'    => __( 'Logo Section Background Image', 'swmtranslate' ),
        'section'  => 'swm_customizer_logo',
        'settings' => 'swm_logo_bg_image',
        'priority' => 8
    ))
);



/* Background Image Position -------------------------------------------------- */

$wp_customize->add_setting( 'swm_logo_bg_position', array(
    'default' => 'left-top'
));

$wp_customize->add_control( 'swm_logo_bg_position', array(
    'type'     => 'select',
    'label'    => __( 'Image Position', 'swmtranslate' ),
    'section'  => 'swm_customizer_logo',
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

$wp_customize->add_setting( 'swm_logo_bg_repeat', array(
    'default' => 'repeat'
));

$wp_customize->add_control( 'swm_logo_bg_repeat', array(
    'type'     => 'select',
    'label'    => __( 'Image Repeat', 'swmtranslate' ),
    'section'  => 'swm_customizer_logo',
    'priority' => 14,
    'choices'  => array(
        'repeat'    => __( 'Repeat', 'swmtranslate' ),
        'no-repeat' => __( 'No Repeat', 'swmtranslate' ),
        'repeat-x'  => __( 'Repeat X', 'swmtranslate' ),
        'repeat-y'  => __( 'Repeat Y', 'swmtranslate' )       
    )
));

/* Background Image Attachment -------------------------------------------------- */

$wp_customize->add_setting( 'swm_logo_bg_attachment', array(
    'default' => 'scroll'
));

$wp_customize->add_control( 'swm_logo_bg_attachment', array(
    'type'     => 'select',
    'label'    => __( 'Attachment', 'swmtranslate' ),
    'section'  => 'swm_customizer_logo',
    'priority' => 15,
    'choices'  => array(
        'scroll' => __( 'Scroll', 'swmtranslate' ),
        'fixed'      => __( 'Fixed', 'swmtranslate' )
    )
));

$wp_customize->add_setting( 'swm_logo_bg_stretch', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_logo_bg_stretch', array(
    'type'     => 'checkbox',
    'label'    => __( '100% Background Image Width', 'swmtranslate' ),
    'section'  => 'swm_customizer_logo',
    'priority' => 16
));

/* ************************************************************************************** 
Donate Button
************************************************************************************** */

$wp_customize->add_setting( 'swm_logo_section_donate' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_logo_section_donate', array(
        'label'    => __( 'Donate Button', 'swmtranslate' ),
        'section'  => 'swm_customizer_logo',
        'settings' => 'swm_logo_section_donate',
        'priority' => 90
    ))
);

$wp_customize->add_setting( 'swm_onoff_donate_button', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_onoff_donate_button', array(
    'type'     => 'checkbox',
    'label'    => __( 'Display Donate Button', 'swmtranslate' ),
    'section'  => 'swm_customizer_logo',
    'priority' => 100
));

$wp_customize->add_setting( 'swm_donate_link', array(
'default' => '#'
));

$wp_customize->add_control( 'swm_donate_link', array(
'type'     => 'text',
'label'    => __( 'Donate Button Link', 'swmtranslate' ),
'section'  => 'swm_customizer_logo',
'priority' => 101
));

$wp_customize->add_setting( 'swm_donate_link_window', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_donate_link_window', array(
    'type'     => 'checkbox',
    'label'    => __( 'Open link page in new window', 'swmtranslate' ),
    'section'  => 'swm_customizer_logo',
    'priority' => 102
));

$wp_customize->add_setting( 'swm_donate_button_text', array(
    'default' => '#ffffff'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_donate_button_text', array(
        'label'    => __( 'Donate Button Text Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_logo',
        'settings' => 'swm_donate_button_text',
        'priority' => 103
    ))
);





