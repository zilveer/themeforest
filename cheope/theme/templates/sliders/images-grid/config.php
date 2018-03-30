<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
 
global $yit;
 
yit_register_slider_style(  $slider_type, 'jquery-dynamic-grid', 'css/dynamic.grid.css' );
yit_register_slider_script( $slider_type, 'jquery-dynamic-grid', 'js/dynamic.grid.gallery.js' );
yit_register_slider_script( $slider_type, 'jquery-black-and-white', 'js/jquery.BlackAndWhite.min.js' );

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = true;

// add support to slide
yit_add_slide_support( $slider_type, 'title, content, link' );
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
    array(
        'name' => __( 'Width content', 'yit' ),
        'id' => 'width',
        'type' => 'number',        
        'desc' => __( 'Select the width of container (leave 0 if you want it fullwidth).', 'yit' ),
        'min' => 0,
        'max' => 2000,
        'std' => 0
    ),
    array(
        'name' => __( 'Height content', 'yit' ),
        'id' => 'height',
        'type' => 'number',        
        'desc' => __( 'Select the height of container.', 'yit' ),
        'min' => 10,
        'max' => 2000,
        'std' => 500
    ),
    array(
        'name' => __( 'Number of columns', 'yit' ),
        'id' => 'cols',
        'type' => 'slider',
        'min' => 1,
        'max' => 20,
        'step' => 1,
        'desc' => __( 'The number of columns. Default: 3.', 'yit' ),
        'std' => 4,
    ),
    array(
        'name' => __( 'Min rows', 'yit' ),
        'id' => 'min_rows',
        'type' => 'slider',
        'min' => 1,
        'max' => 20,
        'step' => 1,
        'desc' => __( 'The minimum number of visible cells at any time. The script generates a random number between this parameter and max_rows. Default: 2.', 'yit' ),
        'std' => 2,
    ),
    array(
        'name' => __( 'Max rows', 'yit' ),
        'id' => 'max_rows',
        'type' => 'slider',
        'min' => 1,
        'max' => 20,
        'step' => 1,
        'desc' => __( 'The maximum number of visible cells at any time. The script generates a random number between this parameter and min_rows. Default: 3', 'yit' ),
        'std' => 3,
    ),
//     array(
//         'name' => __( 'Random Heights', 'yit' ),
//         'id' => 'random_heights',
//         'type' => 'onoff',
//         'desc' => __( 'Set this to "true" if you want the heights of cells to be random. Set it to "false" if you want the cells to have equal width. Default: YES', 'yit' ),
//         'std' => 0,
//     ),
    array(
        'name' => __( 'Padding', 'yit' ),
        'id' => 'padding',
        'type' => 'slider',
        'min' => 2,
        'max' => 50,
        'step' => 1,
        'desc' => __( 'The padding between the cells (in pixels). Default: 1', 'yit' ),
        'std' => 1,
    ),        
    array(
        'name' => __( 'Easing', 'yit' ),
        'id' => 'easing',
        'type' => 'select',
        'options' => $yit->getConfigEasings(),
        'desc' => __( 'The easing effect for the animation.', 'yit' ),
        'std' => '',
    ),
    array( 'type' => 'sep' ),
    array(
        'name' => __( 'Pause between slides (s)', 'yit' ),
        'id' => 'interval',
        'type' => 'slider',        
        'desc' => __( 'Select the delay between slides, expressed in seconds.', 'yit' ),
        'min' => 0.1,
        'max' => 20,
        'step' => 0.1,
        'std' => 3
    ),
    array(
        'name' => __( 'Animation speed (s)', 'yit' ),
        'id' => 'speed',
        'type' => 'slider',
        'desc' => __( 'The speed of the animation between two slide, expressed in seconds.', 'yit' ),
        'min' => 0.1,
        'max' => 20,   
        'step' => 0.1,  
        'std' => 0.8
    )
) );          
 
// add the slider fields for the admin
yit_slider_typography_options( $slider_type, array(
    array(
        'id'   => 'title-font',
        'type' => 'typography',
        'name' => __( 'Title', 'yit' ),
        'desc' => __( 'Configure the title.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 24,
            'unit'   => 'px',
            'family' => 'Muli',
            'style'  => 'regular',
            'color'  => '#ffffff' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider .dg-add-content-wrap .dg-image-title, .slider-%s.slider .dg-add-content-wrap .dg-image-title a',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    ),
    array(
        'id'   => 'paragraphs-font',
        'type' => 'typography',
        'name' => __( 'Paragraphs', 'yit' ),
        'desc' => __( 'Configure the paragraphs.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 18,
            'unit'   => 'px',
            'family' => 'Muli',
            'style'  => 'regular',
            'color'  => '#ffffff' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider .dg-add-content-wrap .dg-image-description',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    )
) );        