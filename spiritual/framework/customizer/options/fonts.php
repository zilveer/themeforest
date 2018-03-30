<?php
$google_font_family_list = array();
$swm_google_fonts_weight = array();
$all_google_fonts = file( get_template_directory() . '/framework/customizer/options/googlefonts.json' );
$google_fonts = implode( '', $all_google_fonts );
$swm_font_list_json_decode = json_decode( $google_fonts, true );

foreach ( $swm_font_list_json_decode['items'] as $key => $value ) 
{
    $item_family = $swm_font_list_json_decode['items'][$key]['family'];
    $google_font_family_list[$item_family] = $item_family; 
    $swm_google_fonts_weight[$item_family] = $swm_font_list_json_decode['items'][$key]['variants'];
}

$list_all_font_weights = array(
    '100'       => __( 'Thin', 'swmtranslate' ),
    '100italic' => __( 'Thin Italic', 'swmtranslate' ),
    '200'       => __( 'Light', 'swmtranslate' ),
    '200italic' => __( 'Light Italic', 'swmtranslate' ),
    '300'       => __( 'Book', 'swmtranslate' ),
    '300italic' => __( 'Book Italic', 'swmtranslate' ),
    '400'       => __( 'Regular', 'swmtranslate' ),
    '400italic' => __( 'Regular Italic', 'swmtranslate' ),
    '500'       => __( 'Medium', 'swmtranslate' ),
    '500italic' => __( 'Medium Italic', 'swmtranslate' ),
    '600'       => __( 'Semi-Bold', 'swmtranslate' ),
    '600italic' => __( 'Semi-Bold Italic', 'swmtranslate' ),
    '700'       => __( 'Bold', 'swmtranslate' ),
    '700italic' => __( 'Bold Italic', 'swmtranslate' ),
    '800'       => __( 'Extra Bold', 'swmtranslate' ),
    '800italic' => __( 'Extra Bold Italic', 'swmtranslate' ),
    '900'       => __( 'Ultra Bold', 'swmtranslate' ),
    '900italic' => __( 'Ultra Bold Italic', 'swmtranslate' )
);

$wp_customize->add_section( 'swm_customizer_fonts', array(
    'title'    => __( 'Fonts', 'swmtranslate' ),
    'priority' => 60
));

$wp_customize->add_setting( 'swm_google_fonts_title' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_google_fonts_title', array(
        'label'    => __( 'Google Fonts', 'swmtranslate' ),
        'section'  => 'swm_customizer_fonts',
        'settings' => 'swm_google_fonts_title',
        'priority' => 10
    ))
);

$wp_customize->add_setting( 'swm_google_font_weight_list', array(
    'default' => $swm_google_fonts_weight
));

$wp_customize->add_setting( 'swm_google_fonts', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_google_fonts', array(
    'type'     => 'checkbox',
    'label'    => __( 'Activate Google Fonts', 'swmtranslate' ),
    'section'  => 'swm_customizer_fonts',
    'priority' => 20
));

// Sub Sets

$wp_customize->add_setting( 'swm_google_font_subset', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_google_font_subset', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Subsets', 'swmtranslate' ),
    'section'  => 'swm_customizer_fonts',
    'priority' => 30
));

$wp_customize->add_setting( 'swm_google_font_subset_cyrillic', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_google_font_subset_cyrillic', array(
    'type'     => 'checkbox',
    'label'    => __( 'Cyrillic', 'swmtranslate' ),
    'section'  => 'swm_customizer_fonts',
    'priority' => 31
));

$wp_customize->add_setting( 'swm_google_font_subset_greek', array(
'default' => 0
));

$wp_customize->add_control( 'swm_google_font_subset_greek', array(
    'type'     => 'checkbox',
    'label'    => __( 'Greek', 'swmtranslate' ),
    'section'  => 'swm_customizer_fonts',
    'priority' => 32
));

$wp_customize->add_setting( 'swm_google_font_subset_vietnamese', array(
'default' => 0
));

$wp_customize->add_control( 'swm_google_font_subset_vietnamese', array(
    'type'     => 'checkbox',
    'label'    => __( 'Vietnamese', 'swmtranslate' ),
    'section'  => 'swm_customizer_fonts',
    'priority' => 33
));

// Font Family

$swm_google_font_famalies = array(
    "swm_body_font_family"       =>  __('Body ', 'swmtranslate' ),
    "swm_top_nav_font_family"    =>  __('Top Navigation', 'swmtranslate' ),
    "swm_headings_font_family"   =>  __('Headings (H1,H2,H3...)', 'swmtranslate' )    
);

$swm_gff_number = 50;

foreach ($swm_google_font_famalies as $family_control => $family_label) 
{

    $swm_gff_number = $swm_gff_number + 2;

    $wp_customize->add_setting( $family_control, array(
        'default' => 'Open Sans'
    ));

    $wp_customize->add_control( $family_control, array(
        'type'     => 'select',
        'label'    => $family_label,
        'section'  => 'swm_customizer_fonts',
        'choices'  => $google_font_family_list,
        'priority' => $swm_gff_number
    )); 
}  


// Font Weight

$swm_fonts_weight = array( "swm_body_font_weight","swm_top_nav_font_weight","swm_headings_font_weight");

$sm_font_weight_number = 51;

foreach ($swm_fonts_weight as $font_weight) 
{

    $sm_font_weight_number = $sm_font_weight_number + 2;

    $wp_customize->add_setting( $font_weight, array(
        'default' => 'regular'
    ));

    $wp_customize->add_control( $font_weight, array(
        'type'     => 'radio',
        'label'    => '',
        'section'  => 'swm_customizer_fonts',
        'priority' => $sm_font_weight_number,
        'choices'  => $list_all_font_weights
    )); 
}

// Standard Fonts ==========================================================================================

$wp_customize->add_setting( 'swm_standard_fonts_title' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_standard_fonts_title', array(
        'label'    => __( 'Standard Fonts', 'swmtranslate' ),
        'section'  => 'swm_customizer_fonts',
        'settings' => 'swm_standard_fonts_title',
        'priority' => 99
    ))
);

$wp_customize->add_setting( 'swm_standard_fonts_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_standard_fonts_info', array(
      'label'    => __( 'If you don\'t want to use Google fonts for body, top navigation or headings then select system\'s standard fonts and font weight.', 'swmtranslate' ),
      'section'  => 'swm_customizer_fonts',
      'settings' => 'swm_standard_fonts_info',
      'priority' => 100
    ))
);


// Font Family and Weight

$swm_standard_fonts_list = array(
    'none' => 'Select a Font',
    'Arial' => 'Arial',
    'Arial Black' => 'Arial Black',
    'Georgia' => 'Georgia',         
    'Impact' => 'Impact',       
    'MS Sans Serif' => 'MS Sans Serif',
    'Palatino Linotype' => 'Palatino Linotype',
    'Trebuchet MS' => 'Trebuchet MS',      
    'Times' => 'Times New Roman',
    'Tahoma' => 'Tahoma',
    'Verdana' => 'Verdana',
);

$swm_standard_fonts_weight = array(
    '400' => 'Regular',
    '400italic' => 'Italic',
    '700' => 'Bold',    
    '700italic' => 'Bold Italic'
);

$swm_standard_font_famalies = array(
    "swm_body_sf"       =>  __('Body ', 'swmtranslate' ),
    "swm_top_nav_sf"    =>  __('Top Navigation', 'swmtranslate' ),
    "swm_headings_sf"   =>  __('Headings (H1,H2,H3...)', 'swmtranslate' )    
);

$swm_sff_number = 101;

foreach ($swm_standard_font_famalies as $family_control => $family_label) 
{

    $swm_sff_number = $swm_sff_number + 2;

    $wp_customize->add_setting( $family_control, array(
        'default' => 'none'
    ));

    $wp_customize->add_control( 
         new SWM_Customize_Control_Mini_Select( $wp_customize, $family_control, array(
            'type'     => 'miniselect',
            'label'    => $family_label,
            'section'  => 'swm_customizer_fonts',          
            'choices'  => $swm_standard_fonts_list,
            'priority' => $swm_sff_number
        ))
    );
} 

$swm_standard_font_famalies_weight = array( "swm_body_sw", "swm_top_nav_sw", "swm_headings_sw" );

$swm_sfw_number = 102;

foreach ($swm_standard_font_famalies_weight as $family_control) 
{

    $swm_sfw_number = $swm_sfw_number + 2;

    $wp_customize->add_setting( $family_control, array(
        'default' => 'regular'
    ));

    $wp_customize->add_control( 
        new SWM_Customize_Control_Mini_Select( $wp_customize, $family_control, array(
            'type'     => 'miniselect',
            'label'    => '&nbsp;',
            'section'  => 'swm_customizer_fonts',           
            'choices'  => $swm_standard_fonts_weight,
            'priority' => $swm_sfw_number
        ))
    );
} 

// Font size and color ==========================================================================================

$wp_customize->add_setting( 'swm_font_size_color_title' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_font_size_color_title', array(
        'label'    => __( 'Font Size and Color', 'swmtranslate' ),
        'section'  => 'swm_customizer_fonts',
        'settings' => 'swm_font_size_color_title',
        'priority' => 200
    ))
);

$swm_font_size_sections = array(
    "swm_body_sc"       =>  __('Body', 'swmtranslate' ),
    "swm_top_nav_sc"       =>  __('Main Navigation', 'swmtranslate' ),
    "swm_top_bar_sc"       =>  __('Logo Section Small Navigation', 'swmtranslate' ),
    "swm_page_title_sc"    =>  __('Page Title (Header Section)', 'swmtranslate' ),
    "swm_sidebar_h2_sc"    =>  __('Sidebar Widget Title', 'swmtranslate' ),
    "swm_footer_h2_sc"     =>  __('Footer Widget Title', 'swmtranslate' ),
    "swm_footer_text_sc"     =>  __('Footer Text', 'swmtranslate' ),
    "swm_small_footer_sc"  =>  __('Small Footer', 'swmtranslate' ),
    "swm_blog_post_sc"     =>  __('Blog Post Title', 'swmtranslate' ),
    "swm_h1_sc"            =>  __('Heading H1', 'swmtranslate' ),
    "swm_h2_sc"            =>  __('Heading H2', 'swmtranslate' ),
    "swm_h3_sc"            =>  __('Heading H3', 'swmtranslate' ),
    "swm_h4_sc"            =>  __('Heading H4', 'swmtranslate' ),
    "swm_h5_sc"            =>  __('Heading H5', 'swmtranslate' ),
    "swm_h6_sc"            =>  __('Heading H6', 'swmtranslate' )    
);

$swm_color_number = 202;

$default_font_colors = array('#606060','#ffffff','#ffffff','#ffffff','#333333','#ffffff','#cecece','#ffffff','#222222','#222222','#222222','#222222','#222222','#222222','#222222');

$default_fz_no = 0;


foreach ($swm_font_size_sections as $control_name => $section_label) 
{

    $swm_color_number = $swm_color_number + 2;


    $wp_customize->add_setting( $control_name . '_color', array(
        'default' => $default_font_colors[$default_fz_no]
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control( $wp_customize, $control_name . '_color', array(
          'label'    => $section_label,
          'section'  => 'swm_customizer_fonts',
          'settings' => $control_name . '_color',
          'priority' => $swm_color_number
        ))
    );

    $default_fz_no++;
} 


for ( $i = 8; $i<73; $i++ ) { $swm_font_size_count[$i . 'px'] = $i . 'px'; } 

$swm_size_number = 203;

$default_font_sizes = array('13px','14px','13px','40px','15px','18px','13px','12px','18px','27px','24px','20px','18px','16px','14px');

$default_fz_no = 0;

foreach ( $swm_font_size_sections as $control_name  => $section_label ) 
{

    $swm_size_number = $swm_size_number + 2;

    $wp_customize->add_setting( $control_name . '_size', array(
        'default' => $default_font_sizes[$default_fz_no]
    ));

    $wp_customize->add_control( 
         new SWM_Customize_Control_Mini_Select( $wp_customize, $control_name . '_size', array(
            'type'     => 'miniselect',
            'label'    => '&nbsp;',
            'section'  => 'swm_customizer_fonts',          
            'choices'  => $swm_font_size_count,
            'priority' => $swm_size_number
        ))
    );

    $default_fz_no++;
}