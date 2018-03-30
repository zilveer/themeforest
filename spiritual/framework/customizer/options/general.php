<?php

/* ************************************************************************************** 
General
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_general', array(
'title'    => __( 'General', 'swmtranslate' ),
'priority' => 10
));

$wp_customize->add_setting( 'swm_customizer_general_settings' );

/* Site Layout -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_website_layout', array(
'default' => 'wide'
));

$wp_customize->add_control( 'swm_website_layout', array(
'type'     => 'select',
'label'    => __( 'Site Layout', 'swmtranslate' ),
'section'  => 'swm_customizer_general',
'priority' => 20,
'choices'  => array(
  'wide' => __( 'Wide (Full Width)', 'swmtranslate' ),
  'boxed' => __( 'Boxed', 'swmtranslate' )
)
));

/* Google Analytical -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_google_analytical');

$wp_customize->add_control( 'swm_google_analytical', array(
'type'     => 'text',
'label'    => __( 'Google Analytical Code', 'swmtranslate' ),
'section'  => 'swm_customizer_general',
'priority' => 30
));

/* Display Hide -------------------------------------------------- */

$wp_customize->add_setting( 'swm_show_hide_subtitle' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_show_hide_subtitle', array(
        'label'    => __( 'On / Off ( Enable / Disable )', 'swmtranslate' ),
        'section'  => 'swm_customizer_general',
        'settings' => 'swm_show_hide_subtitle',
        'priority' => 50
    ))
);

$wp_customize->add_setting( 'swm_customizer_show_hide_settings' );

$swm_show_hide = array(
    "swm_display_sticky_nav"    =>  __('Enable Sticky Main Navigation', 'swmtranslate' ),
    "swm_topbar_cart_icon"      =>  __('Display Cart Icon in Logo Section', 'swmtranslate' ),
    "swm_topbar_email_phone"    =>  __('Display Logo Section Contact Menu', 'swmtranslate' ),
    "swm_scroll_top_arrow"      =>  __('Display Scroll To Top Arrow Icon', 'swmtranslate' ),      
    "swm_breadcrumbs"           =>  __('Display Breadcrumbs Section', 'swmtranslate' ),
    "swm_search_on"             =>  __('Display Search Icon in Breadcrumbs', 'swmtranslate' ),
    "swm_commnets_in_pages"     =>  __('Display Comments in Pages', 'swmtranslate' )
);

$sm_show_hide_number = 51;

$default_show_hides = array(0,1,1,1,1,1,0);

$default_sh_no = 0;

foreach ($swm_show_hide as $section_name => $section_details) {

    $sm_show_hide_number++;

    $wp_customize->add_setting( $section_name, array(
        'default' => $default_show_hides[$default_sh_no]
    ));

    $wp_customize->add_control( $section_name, array(
        'type'     => 'checkbox',
        'label'    => $section_details,
        'section'  => 'swm_customizer_general',
        'priority' => $sm_show_hide_number
    )); 

    $default_sh_no++;

}    

