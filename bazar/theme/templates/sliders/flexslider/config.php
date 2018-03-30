<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
 
yit_register_slider_style(  $slider_type, 'slider-flexslider', 'css/flexslider.css' );
yit_register_slider_style(  $slider_type, 'slider-flexslider-slider', 'css/slider.css' ); 

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = true;

// add support to slide
yit_add_slide_support( $slider_type, 'link' );
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
    array(
        'name' => __( 'Width content', 'yit' ),
        'id' => 'width',
        'type' => 'number',        
        'desc' => __( 'Select the width of container (select 0 if you want to have the same width of site container).', 'yit' ),
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
        'name' => __( 'Control Nav', 'yit' ),
        'id' => 'controlnav',
        'type' => 'onoff',
        'desc' => __( 'Show slides control nav', 'yit' ),
        'std' => false
    )
) );        