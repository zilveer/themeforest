<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
 
yit_register_slider_style(  $slider_type, 'slider-flexslider', 'css/flexslider.css' );
yit_register_slider_style(  $slider_type, 'slider-flexslider-elegant-slider', 'css/slider.css' );

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = true;

// add support to slide
yit_add_slide_support( $slider_type, 'title, content-editor, link' );
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
    array(
        'name' => __( 'Width content', 'yit' ),
        'id' => 'width',
        'type' => 'number',        
        'desc' => __( 'Select the width of container (leave 0 to get all container width).', 'yit' ),
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
        'std' => 400
    ),
    array(
        'name' => __( 'Effect', 'yit' ),
        'id' => 'effect',
        'type' => 'select',
        'options' => array(
             'fade' => 'Fade',
             'slide' => 'Slide'
         ),
        'desc' => __( 'The effect used to change slide.', 'yit' ),
        'std' => 'fade',
    ),   
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
    ), 
    array(
        'name' => __( 'Content tooltip position', 'yit' ),
        'id' => 'caption_position',
        'type' => 'select',        
        'desc' => __( 'Define the position of the tooltip of the text.', 'yit' ),
        'options' => array(
            'top' => __( 'Top', 'yit' ),
            'bottom' => __( 'Bottom', 'yit' ),
            'left' => __( 'Left', 'yit' ),
            'right' => __( 'Right', 'yit' ),
        ),
        'std' => 'right'
    ),           
    array(
        'name' => __( 'Caption speed (s)', 'yit' ),
        'id' => 'caption_speed',
        'type' => 'slider',
        'desc' => __( 'The speed animation of caption.', 'yit' ),
        'min' => 0.1,
        'max' => 10,   
        'step' => 0.1,  
        'std' => 0.4
    ), 
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
            'size'   => 17,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'bold',
            'color'  => '#ffffff' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider ul li .slider-caption h2, .slider-%s.slider ul li .slider-caption h2 a',
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
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'regular',
            'color'  => '#ffffff' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider ul li .slider-caption p',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    ),
    array(
        'id'   => 'special-font',
        'type' => 'typography',
        'name' => __( '[special_font]', 'yit' ),
        'desc' => __( 'Configure the [special_font] text.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 24,
            'unit'   => 'px',
            'family' => 'Shadows Into Light',
            'style'  => 'regular',
            'color'  => '#ffffff' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider ul li .slider-caption .special-font',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    )
) );        