<?php

/* ************************************************************************************** 
Image Height
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_image_height', array(
    'title'    => __( 'Image Height', 'swmtranslate' ),
    'priority' => 120
));


$wp_customize->add_setting( 'swm_image_height_section_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_image_height_section_info', array(
      'label'    => __( 'Note: After changing the image heights, rebuild all thumbnails with "Regenerate Thumbnails" plugin', 'swmtranslate' ),
      'section'  => 'swm_customizer_image_height',
      'settings' => 'swm_image_height_section_info',
      'priority' => 1
    ))
);


$swm_image_height_sections = array(
    "swm_img_pt_2col"						      =>  __('Portfolio 2 Column', 'swmtranslate' ),
    "swm_img_pt_3col"            			=>  __('Portfolio 3 Column', 'swmtranslate' ),
    "swm_img_pt_4col"            		  =>  __('Portfolio 4 Column', 'swmtranslate' ),    
    "swm_img_pt_blog_featured"        =>  __('Blog with Sidebar Post', 'swmtranslate' ),    
    "swm_img_pt_blog_grid_featured"   =>  __('Blog Grid Post', 'swmtranslate' ),
    "swm_img_pt_blog_fullwidth_featured" =>  __('Blog Fullwidth Post', 'swmtranslate' ),
);

$sm_links_number = 2;

$default_image_heights = array(310,250,250,400,250,500);

$default_img_no = 0;

foreach ($swm_image_height_sections as $section_name => $section_details) 
{
    $sm_links_number++;    

    $nav_link_number = 'nav_link_icon' . $i;
    $nav_link_icon = sprintf( __( 'Link %s Icon','swmtranslate' ) ,$i );

    $wp_customize->add_setting( $section_name, array(
        'default' => $default_image_heights[$default_img_no]
    ));

   $wp_customize->add_control(
        new SWM_Customize_Control_Mini_Text( $wp_customize, $section_name, array(
            'type'     => 'minitext',
            'label'    => $section_details,
            'section'  => 'swm_customizer_image_height',
            'priority' => $sm_links_number
        ))
    );

   $default_img_no++;
        
}