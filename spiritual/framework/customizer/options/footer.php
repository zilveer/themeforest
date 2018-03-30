<?php

/* ************************************************************************************** 
Footer
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_footer', array(
'title'    => __( 'Footer', 'swmtranslate' ),
'priority' => 70
));

$wp_customize->add_setting( 'swm_customizer_footer_settings' );

/* Large Footer -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_large_footer', array(
'default' => 1
));

$wp_customize->add_control( 'swm_large_footer', array(
    'type'     => 'checkbox',
    'label'    => __( 'Display Large Footer', 'swmtranslate' ),
    'section'  => 'swm_customizer_footer',
    'priority' => 1
));

/* Footer Column -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_footer_column', array(
    'default' => '3'
));

$footer_column = array(
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5"    
);

$wp_customize->add_control( 'swm_footer_column', array(
    'type'     => 'select',
    'label'    => __( 'Footer Column', 'swmtranslate' ),
    'section'  => 'swm_customizer_footer',
    'priority' => 2,
    'choices'  => $footer_column
));



/* Background Image and Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_footer_bg_color', array(
    'default' => '#2e2e2e'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_footer_bg_color', array(
        'label'    => __( 'Primary Background Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_footer_bg_color',
        'priority' => 11
    ))
);

$wp_customize->add_setting( 'swm_footer_bg_color_two', array(
    'default' => '#191919'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_footer_bg_color_two', array(
        'label'    => __( 'Secondary Background Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_footer_bg_color_two',
        'priority' => 12
    ))
);

$wp_customize->add_setting( 'swm_footer_bg_image' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_footer_bg_image', array(
        'label'    => __( 'Background Image', 'swmtranslate' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_footer_bg_image',
        'priority' => 13
    ))
);

$wp_customize->add_setting( 'swm_footer_bg_position', array(
    'default' => 'center-top'
));

$wp_customize->add_control( 'swm_footer_bg_position', array(
    'type'     => 'select',
    'label'    => __( 'Image Position', 'swmtranslate' ),
    'section'  => 'swm_customizer_footer',
    'priority' => 14,
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

$wp_customize->add_setting( 'swm_footer_bg_repeat', array(
    'default' => 'repeat'
));

$wp_customize->add_control( 'swm_footer_bg_repeat', array(
    'type'     => 'select',
    'label'    => __( 'Image Repeat', 'swmtranslate' ),
    'section'  => 'swm_customizer_footer',
    'priority' => 15,
    'choices'  => array(
        'repeat'    => __( 'Repeat', 'swmtranslate' ),
        'no-repeat' => __( 'No Repeat', 'swmtranslate' ),
        'repeat-x'  => __( 'Repeat X', 'swmtranslate' ),
        'repeat-y'  => __( 'Repeat Y', 'swmtranslate' ),
        'fixed'     => __( 'Fixed', 'swmtranslate' )
    )
));


$wp_customize->add_setting( 'swm_footer_border_color', array(
    'default' => '#353535'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_footer_border_color', array(
        'label'    => __( 'Footer Borders Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_footer_border_color',
        'priority' => 21
    ))
);

$wp_customize->add_setting( 'swm_footer_links_hover_color', array(
    'default' => '#da5455'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_footer_links_hover_color', array(
        'label'    => __( 'Footer Links Hover Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_footer_links_hover_color',
        'priority' => 21
    ))
);

/* Small Footer -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_small_footer_heading' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_small_footer_heading', array(
        'label'    => __( 'Small Footer', 'swmtranslate' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_small_footer_heading',
        'priority' => 50
    ))
);

$wp_customize->add_setting( 'swm_small_footer', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_small_footer', array(
    'type'     => 'checkbox',
    'label'    => __( 'Display Small Footer', 'swmtranslate' ),
    'section'  => 'swm_customizer_footer',
    'priority' => 51
));

$wp_customize->add_setting( 'swm_footer_copyright', array(
    'default' => 'Add copyright text from WordPress Admin > Customizer > Footer > Small Footer'
));  

$wp_customize->add_control(
    new SWM_Customize_Control_Textarea( $wp_customize, 'swm_footer_copyright', array(
      'label'    => __( 'Copyright Info', 'swmtranslate' ),
      'section'  => 'swm_customizer_footer',
      'settings' => 'swm_footer_copyright',
      'priority' => 60
    ))
);