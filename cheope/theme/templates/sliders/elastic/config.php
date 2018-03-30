<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
                              
yit_register_slider_style(  $slider_type, 'slider-elastic', 'css/elastic.css' );
yit_register_slider_script( $slider_type, 'jquery-eislideshow', 'js/jquery.eislideshow.js' );

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = true;
                                                                                      
// add image size
add_image_size( 'thumb-slider-elastic', 150, 59, true );

// add support to slide
yit_add_slide_support( $slider_type, 'title, subtitle, link' );
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
    array(
        'name' => __( 'Width', 'yit' ),
        'id' => 'width',
        'type' => 'number',
        'desc' => __( 'Select the width of the slider, in base of the images that you want to add (Set 0 if you want it full width).', 'yit' ),
        'min' => 0,
        'max' => 2000,
        'std' => 0,
    ),
    array(
        'name' => __( 'Height', 'yit' ),
        'id' => 'height',
        'type' => 'number',
        'desc' => __( 'Select the height of the slider, in base of the images that you want to add.', 'yit' ),
        'std' => 338,
        'min' => 200,
        'max' => 2000
    ),
    array(
        'name' => __( 'Autoplay', 'yit' ),
        'id' => 'autoplay',
        'type' => 'onoff',
        'desc' => __( 'Select if you want that the slider change the slide automatically.', 'yit' ),
        'std' => 1
        
    ),
    array(
        'name' => __( 'Animation', 'yit' ),
        'id' => 'animation',
        'type' => 'select',
        'options' => array(
            'sides' => __( 'Sides', 'yit' ),
            'center' => __( 'Center', 'yit' ),
        ),
        'desc' => __( 'Animation types -> "sides" : new slides will slide in from left / right; "center": new slides will appear in the center.', 'yit' ),
        'std' => 'sides'
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
            'size'   => 40,
            'unit'   => 'px',
            'family' => 'Playfair Display',
            'style'  => 'italic',
            'color'  => '#000000' 
        ),
        'style' => array(
			'selectors' => '.slider-%s .ei-title h2, .slider-%s .ei-title h2 a',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    ),
    array(
        'id'   => 'subtitle-font',
        'type' => 'typography',
        'name' => __( 'Subitle', 'yit' ),
        'desc' => __( 'Configure the subtitle.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 40,
            'unit'   => 'px',
            'family' => 'Open Sans Condensed:300',
            'style'  => 'regular',
            'color'  => '#4D4C4C' 
        ),
        'style' => array(
			'selectors' => '.slider-%s .ei-title h3, .slider-%s .ei-title h3 a',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    )
) );        