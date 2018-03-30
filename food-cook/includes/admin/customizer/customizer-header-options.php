<?php

/**==========================================================
* Header Options Sections
*==========================================================**/
$wp_manager->add_section( 'df_customizer_header_section', array(
    'title'    => __( 'Header', 'woothemes' ),
    'priority' => 10
));

/* Site Logo */
$wp_manager->add_setting( 'df_options[logo]' );

$wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'df_options[logo]', array(
    'label'    => __( 'Upload Your Logo', 'woothemes' ),
    'section'  => 'df_customizer_header_section',
    'settings' => 'df_options[logo]',
    'priority' => 0
) ) );

/* Retina Logo */
$wp_manager->add_setting( 'df_retina_logo_description' );

$wp_manager->add_control( new Text_Description_Custom_Control( $wp_manager, 'df_retina_logo_description', array(
    'label'    => __( 'Upload your Retina Logo. This should be your Logo in double size (If your logo is 100 x 20px, it should be 200 x 40px)', 'woothemes' ),
    'section'  => 'df_customizer_header_section',
    'settings' => 'df_retina_logo_description',
    'priority' => 10
) ) );

$wp_manager->add_setting( 'df_options[retina_logo]' );

$wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'df_options[retina_logo]', array(
    'label'    => __('Upload Your Retina Logo', 'woothemes'),
    'section'  => 'df_customizer_header_section',
    'settings' => 'df_options[retina_logo]',
    'priority' => 20
) ) );

/* Original Logo */
$wp_manager->add_setting( 'df_logo_width_height_description' );

$wp_manager->add_control( new Text_Description_Custom_Control( $wp_manager, 'df_logo_width_height_description', array(
    'label'    => __( 'If Retina Logo uploaded, please enter the width and height of the Standard Logo you\'ve uploaded (not the Retina Logo)', 'woothemes' ),
    'section'  => 'df_customizer_header_section',
    'settings' => 'df_logo_width_height_description',
    'priority' => 30
) ) );

$wp_manager->add_setting( 'df_options[width_logo]' );

$wp_manager->add_control( 'df_options[width_logo]', array(
    'label'    => __('Original Logo Width', 'woothemes'),
    'section'  => 'df_customizer_header_section',
    'type'     => 'text',
    'priority' => 40
) );

$wp_manager->add_setting( 'df_options[height_logo]' );

$wp_manager->add_control( 'df_options[height_logo]', array(
    'label'    => __('Original Logo Height', 'woothemes'),
    'section'  => 'df_customizer_header_section',
    'type'     => 'text',
    'priority' => 50
) );


/* Top Bar */
$wp_manager->add_setting( 'df_options[check_callus]' );

$wp_manager->add_control( 'df_options[check_callus]', array(
    'label'    => __('Show Call Us Text','woothemes'),
    'section'  => 'df_customizer_header_section',
    'type'     => 'checkbox',
    'priority' => 60
) );

$wp_manager->add_setting( 'df_options[text_callus]');

$wp_manager->add_control( new Textarea_Custom_Control( $wp_manager, 'df_options[text_callus]', array(
    'label'    => __('Call Us Text','woothemes'),
    'section'  => 'df_customizer_header_section',
    'settings' => 'df_options[text_callus]',
    'priority' => 70
) ) );