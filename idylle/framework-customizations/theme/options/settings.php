<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(

    /*Main Settings*/
    'general'    => array(
        'title'  => esc_html__('Main Settings','idylle'),
        'type'  => 'tab',
        'options' => array(
            'preloader'    => array(
                'type'  => 'image-picker',
                'label' => esc_html__('Preloader', 'idylle'),
                'value' => 'pr1',
                'choices' => array(
                    'no_pr' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/pr0.jpg',
                    'pr1' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/pr1.jpg',
                )
            ),
            'petals' => array(
                'type'  => 'switch',
                'label' => esc_html__('Disable Petals', 'idylle')
            ),
            'petals_inside' => array(
                'type'  => 'switch',
                'label' => esc_html__('Disable Petals on Inside Pages', 'idylle')
            ),
            'petals_mobile' => array(
                'type'  => 'switch',
                'label' => esc_html__('Disable Petals on Mobile', 'idylle')
            ),
            'flowers'    => array(
                'type'  => 'image-picker',
                'label' => esc_html__('Theme Color', 'idylle'),
                'value' => 'fl1',
                'choices' => array(
                    'fl1' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/fl1.jpg',
                    'fl2' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/fl2.jpg',
                    'fl3' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/fl3.jpg',
                )
            ),
            'rounds'    => array(
                'type'  => 'image-picker',
                'label' => esc_html__('Rounds Decoration', 'idylle'),
                'value' => 'r0',
                'choices' => array(
                    'r0' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/fl0.jpg',
                    'r1' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/r1.jpg',
                    'r2' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/r2.jpg',
                )
            ),

            'music' => array(
                'type'  => 'switch',
                'label' => esc_html__('Music', 'idylle')
            ),
            'music_share' => array(
                'type'  => 'textarea',
                'label' => esc_html__('Music Source', 'idylle')
            ),
            
        )
    ),

    /*Header Settings*/
    'header'    => array(
        'title'  => esc_html__('Header Settings','idylle'),
        'type'  => 'tab',
        'options' => array(
            'idylle_slider_title'   => array(
                'label' => esc_html__( 'Title', 'idylle' ),
                'type'  => 'text'
            ),
            'idylle_slider_date'   => array(
                'label' => esc_html__( 'Date', 'idylle' ),
                'type'  => 'text'
            ),
            'idylle_slider_names'   => array(
                'label' => esc_html__( 'Names', 'idylle' ),
                'type'  => 'text'
            ),
            'idylle_slider_background_image' => array(
                'label' => esc_html__( 'Background Image', 'idylle' ),
                'type'  => 'upload'
            ),
            'idylle_inside_header_featured' => array(
                'type'  => 'switch',
                'label' => esc_html__( 'Inside Header Featured Image', 'idylle' ),
            ),
            'idylle_inside_header_image' => array(
                'label' => esc_html__( 'Inside Header Image', 'idylle' ),
                'type'  => 'upload'
            ) 
        )
    ),

    /*Slider Settings*/
    'slider'    => array(
        'title'  => esc_html__('Slider Settings','idylle'),
        'type'  => 'tab',
        'options' => array(
            'idy_switch' => array(
                'type'  => 'switch',
                'label' => esc_html__('Slider', 'idylle')
            ), 
            'idylle_slider' => array(
                'label'         => esc_html__( 'Slider Content', 'idylle' ),
                'type'          => 'addable-popup',
                'template' => 'Image',
                'popup-options' => array(
                    'idylle_slider_background_image' => array(
                        'label' => esc_html__( 'Background Image', 'idylle' ),
                        'type'  => 'upload'
                    )
                )
            )
            /*Slider End*/
        )
    ),

    /*Footer Settings*/
    'footer'    => array(
        'title'  => esc_html__('Footer Settings','idylle'),
        'type'  => 'tab',
        'options' => array(
            'footer_text'   => array(
                'label' => esc_html__( 'Text', 'idylle' ),
                'type'  => 'text'
            ),
            'footer_thanks_text'   => array(
                'label' => esc_html__( 'Thanks Text', 'idylle' ),
                'type'  => 'text'
            ),
            'background_image' => array(
                'label' => esc_html__( 'Background Image', 'idylle' ),
                'type'  => 'upload'
            ),
            'parallax' => array(
                'type'  => 'switch',
                'label' => esc_html__('Parallax', 'idylle')
            ),
            'over_display' => array(
                'type'  => 'switch',
                'label' => esc_html__('Display Over', 'idylle')
            ),
            'over_color' => array(
                'type'  => 'color-picker',
                'value' => '#000',
                'label' => esc_html__('Over Color', 'idylle')
            ),
            'over_opacity'   => array(
                'label' => esc_html__( 'Opacity', 'idylle' ),
                'desc'  => esc_html__('0.0-1', 'idylle'),
                'type'  => 'text',
                'value' => '0.3'
            )       
            
        )
    )
    
  
);
